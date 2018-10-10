<?php
    /*
    Plugin Name: Limit Login Attempts
    Plugin URI: http://miniorange.com
    Description: Limit Login Attempts for wordpress. Brute Force Login Protection with IP blocking. Provides firewall security, database security, backups, antispam.
    Author: miniorange
    Version: 1.4.4
    Author URI: http://miniorange.com
    */

	require_once 'mo_wpns_pages.php';
	require('mo_wpns_support.php');
	require('class-mo-wpns-customer-setup.php');
	require('class-mo-wpns-utility.php');
	require('mo-wpns-handler.php');
	require('mo-wpns-secure-login-handler.php');
	require('mo-wpns-blocking.php');
	require('mo-wpns-2fa-handler.php');
	require('resources/constants.php');
	require('resources/messages.php');
	require('resources/domains.php');
	
	//error_reporting(E_ERROR);
	class WP_Security_Pro{

		function __construct(){
			add_action('admin_menu', array($this, 'mo_wpns_widget_menu'));
			add_action('admin_init', array($this, 'mo_wpns_widget_save_options'));
			add_action('init', array($this, 'mo_wpns_init'));
			add_action( 'admin_enqueue_scripts', array( $this, 'mo_wpns_settings_style' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'mo_wpns_settings_script' ) );

			remove_action( 'admin_notices', array( $this, 'success_message') );
			remove_action( 'admin_notices', array( $this, 'error_message') );
			add_filter('query_vars', array($this, 'plugin_query_vars'));
			register_deactivation_hook(__FILE__, array( $this, 'mo_wpns_deactivate'));
			register_activation_hook( __FILE__, array($this,'mo_wpns_activate')) ;
			
			if(get_option('mo_wpns_enforce_strong_passswords')){
				remove_filter('authenticate', 'wp_authenticate_username_password', 20, 3);
				add_filter('authenticate', array($this, 'custom_login'), 20, 3);
			} else if(get_option('mo_wpns_enable_brute_force')) {
				add_action('wp_login', array($this, 'mo_wpns_login_success'));
				add_action('wp_login_failed', array($this, 'mo_wpns_login_failed'));
				add_action('auth_cookie_bad_username', array($this, 'mo_wpns_login_failed'));
				add_action('auth_cookie_bad_hash', array($this, 'mo_wpns_login_failed'));
			}

			
			add_filter( 'registration_errors', array($this,'mo_wpns_registeration_validations'), 10, 3 );
			
			
			//add_action( 'login_footer', 'mo_wpns_link' );
			/*if(get_option('mo_wpns_authorized_users_only') == 1){
				add_action('wp', array( $this, 'mo_wpns_login_redirect' ) );
			}*/
		}
		
		function mo_wpns_login_redirect(){
			if (!is_user_logged_in()) 
				auth_redirect();
		}

		
		
		function mo_wpns_widget_menu(){
			add_menu_page ('Limit Login Attempts', 'Limit Login Attempts', 'activate_plugins', 'wp_security_pro', array( $this, 'mo_wpns_widget_options'),plugin_dir_url(__FILE__) . 'includes/images/miniorange_icon.png');
		}

		function mo_wpns_widget_options(){
			update_option( 'mo_wpns_host_name', 'https://auth.miniorange.com' );
			mo_wpns_show_settings();
		}

		function mo_wpns_widget_save_options(){
			
			//Check if user has permissions to update plugin options
			if (current_user_can( 'manage_options' )){ 	
			
			if(isset($_POST['option'])){
				if($_POST['option'] == "mo_wpns_register_customer") {		//register the customer
					//validate and sanitize
					$email = '';
					$phone = '';
					$password = '';
					$confirmPassword = '';
					$fname = '';
					$lname = '';
					$companyName = '';
					if( Mo_WPNS_Util::check_empty_or_null( $_POST['email'] ) || Mo_WPNS_Util::check_empty_or_null( $_POST['password'] ) || Mo_WPNS_Util::check_empty_or_null( $_POST['confirmPassword'] ) || Mo_WPNS_Util::check_empty_or_null( $_POST['company'] ) ) {
						update_option( 'mo_wpns_message', 'All the fields are required. Please enter valid entries.');
						$this->show_error_message();
						return;
					} else if( strlen( $_POST['password'] ) < 6 || strlen( $_POST['confirmPassword'] ) < 6){	//check password is of minimum length 6
						update_option( 'mo_wpns_message', 'Choose a password with minimum length 6.');
						$this->show_error_message();
						return;
					} else{
						$email = sanitize_email( $_POST['email'] );
						$phone = sanitize_text_field( $_POST['phone'] );
						$password = sanitize_text_field( $_POST['password'] );
						$confirmPassword = sanitize_text_field( $_POST['confirmPassword'] );
						$fname = sanitize_text_field($_POST['fname']);
						$lname = sanitize_text_field($_POST['lname']);
						$companyName = sanitize_text_field($_POST['company']);
					}

					update_option('mo_wpns_admin_email', $email );
					update_option('mo_wpns_admin_fname', $fname);
					update_option('mo_wpns_admin_lname', $lname);
					update_option('mo_wpns_company', $companyName);
					
					if($phone != '')
						update_option( 'mo_wpns_admin_phone', $phone );

					if( strcmp( $password, $confirmPassword) == 0 ) {
						update_option( 'mo_wpns_password', $password );

						$customer = new Mo_Wpns_Customer();
						$content = json_decode($customer->check_customer(), true);
						if( strcasecmp( $content['status'], 'CUSTOMER_NOT_FOUND') == 0 ){
							$auth_type = 'EMAIL';
							$content = json_decode($customer->send_otp_token($auth_type, null), true);
							if(strcasecmp($content['status'], 'SUCCESS') == 0) {
								
								update_option('mo_wpns_email_count',1);
								update_option( 'mo_wpns_message', 'A One Time Passcode has been sent to <b>' . ( get_option('mo_wpns_admin_email') ) . '</b>. Please enter the OTP below to verify your email. ');
								
								update_option('mo_wpns_transactionId',$content['txId']);
								update_option('mo_wpns_registration_status','MO_OTP_DELIVERED_SUCCESS');

								$this->show_success_message();
							} else {
								update_option('mo_wpns_message','There was an error in sending email. Please click on Resend OTP to try again.');
								update_option('mo_wpns_registration_status','MO_OTP_DELIVERED_FAILURE');
								$this->show_error_message();
							}
						} else if( strcasecmp( $content['status'], 'CURL_ERROR') == 0 ){
							update_option('mo_wpns_message', $content['statusMessage']);
							update_option('mo_wpns_registration_status','MO_OTP_DELIVERED_FAILURE');
							$this->show_error_message();
						} else{
							$content = $customer->get_customer_key();
							$customerKey = json_decode($content, true);
							if(json_last_error() == JSON_ERROR_NONE) {
								$this->save_success_customer_config($customerKey['id'], $customerKey['apiKey'], $customerKey['token'], $customerKey['appSecret'],'Your account has been retrieved successfully.');
								update_option('mo_wpns_password', '');
							} else {
								update_option( 'mo_wpns_message', 'You already have an account with miniOrange. Please enter a valid password.');
								update_option('mo_wpns_verify_customer', 'true');
								delete_option('mo_wpns_new_registration');
								$this->show_error_message();
							}
						}

					} else {
						update_option( 'mo_wpns_message', 'Password and Confirm password do not match.');
						delete_option('mo_wpns_verify_customer');
						$this->show_error_message();
					}
				} else if( $_POST['option'] == "mo_wpns_verify_customer" ) {	//login the admin to miniOrange

					//validation and sanitization
					$email = '';
					$password = '';
					if( Mo_WPNS_Util::check_empty_or_null( $_POST['email'] ) || Mo_WPNS_Util::check_empty_or_null( $_POST['password'] ) ) {
						update_option( 'mo_wpns_message', 'All the fields are required. Please enter valid entries.');
						$this->show_error_message();
						return;
					} else{
						$email = sanitize_email( $_POST['email'] );
						$password = sanitize_text_field( $_POST['password'] );
					}

					update_option( 'mo_wpns_admin_email', $email );
					update_option( 'mo_wpns_password', $password );
					$customer = new Mo_Wpns_Customer();
					$content = $customer->get_customer_key();
					$customerKey = json_decode( $content, true );
					if( strcasecmp( $customerKey['apiKey'], 'CURL_ERROR') == 0) {
						update_option('mo_wpns_message', $customerKey['token']);
						$this->show_error_message();
					} else if( json_last_error() == JSON_ERROR_NONE ) {
						update_option( 'mo_wpns_admin_phone', $customerKey['phone'] );
						$this->save_success_customer_config($customerKey['id'], $customerKey['apiKey'], $customerKey['token'], $customerKey['appSecret'], 'Your account has been retrieved successfully.');
						update_option('mo_wpns_password', '');
					} else {
						update_option( 'mo_wpns_message', 'Invalid username or password. Please try again.');
						$this->show_error_message();
					}
					update_option('mo_wpns_password', '');
				}  else if( $_POST['option'] == "mo_wpns_validate_otp"){		//verify OTP entered by user

					//validation and sanitization
					$otp_token = '';
					if( Mo_WPNS_Util::check_empty_or_null( $_POST['otp_token'] ) ) {
						update_option( 'mo_wpns_message', 'Please enter a value in otp field.');
						update_option('mo_wpns_registration_status','MO_OTP_VALIDATION_FAILURE');
						$this->show_error_message();
						return;
					} else{
						$otp_token = sanitize_text_field( $_POST['otp_token'] );
					}

					$customer = new Mo_Wpns_Customer();
					$content = json_decode($customer->validate_otp_token(get_option('mo_wpns_transactionId'), $otp_token ),true);
					if(strcasecmp($content['status'], 'SUCCESS') == 0) {
						$customerKey = json_decode($customer->create_customer(), true);
						if(strcasecmp($customerKey['status'], 'CUSTOMER_USERNAME_ALREADY_EXISTS') == 0) {	//admin already exists in miniOrange
							$content = $customer->get_customer_key();
							$customerKey = json_decode($content, true);
							if(json_last_error() == JSON_ERROR_NONE) {
								$this->save_success_customer_config($customerKey['id'], $customerKey['apiKey'], $customerKey['token'], $customerKey['appSecret'], 'Your account has been retrieved successfully.');
							} else {
								update_option( 'mo_wpns_message', 'You already have an account with miniOrange. Please enter a valid password.');
								update_option('mo_wpns_verify_customer', 'true');
								delete_option('mo_wpns_new_registration');
								$this->show_error_message();
							}
						} else if(strcasecmp($customerKey['status'], 'SUCCESS') == 0) { 	//registration successful
							$this->save_success_customer_config($customerKey['id'], $customerKey['apiKey'], $customerKey['token'], $customerKey['appSecret'], 'Registration complete!');
						}
						update_option('mo_wpns_password', '');
					} else if( strcasecmp( $content['status'], 'CURL_ERROR') == 0) {
						update_option('mo_wpns_message', $content['statusMessage']);
						update_option('mo_wpns_registration_status','MO_OTP_VALIDATION_FAILURE');
						$this->show_error_message();
					} else{
						update_option( 'mo_wpns_message','Invalid one time passcode. Please enter a valid otp.');
						update_option('mo_wpns_registration_status','MO_OTP_VALIDATION_FAILURE');
						$this->show_error_message();
					}
				} else if( $_POST['option'] == "mo_wpns_resend_otp" ) {			//send OTP to user to verify email
					$customer = new Mo_Wpns_Customer();
					$auth_type = 'EMAIL';
					$content = json_decode($customer->send_otp_token($auth_type, null), true);
					if(strcasecmp($content['status'], 'SUCCESS') == 0) {
							update_option( 'mo_wpns_message', ' A one time passcode is sent to ' . get_option('mo_wpns_admin_email') . ' again. Please enter the OTP recieved.');
							update_option('mo_wpns_transactionId',$content['txId']);
							update_option('mo_wpns_registration_status','MO_OTP_DELIVERED_SUCCESS');
							$this->show_success_message();
					} else if( strcasecmp( $content['status'], 'CURL_ERROR') == 0) {
						update_option('mo_wpns_message', $content['statusMessage']);
						update_option('mo_wpns_registration_status','MO_OTP_DELIVERED_FAILURE');
						$this->show_error_message();
					} else{
							update_option('mo_wpns_message','There was an error in sending email. Please click on Resend OTP to try again.');
							update_option('mo_wpns_registration_status','MO_OTP_DELIVERED_FAILURE');
							$this->show_error_message();
					}
				} else if($_POST['option'] == 'mo_wpns_phone_verification'){
					$phone = sanitize_text_field($_POST['phone_number']);
					$phone = str_replace(' ', '', $phone);
					
					$pattern = "/[\+][0-9]{1,3}[0-9]{10}/";					
					
					if(preg_match($pattern, $phone, $matches, PREG_OFFSET_CAPTURE)){
						$auth_type = 'SMS';
						$customer = new Mo_Wpns_Customer();
						$content = json_decode($customer->send_otp_token($auth_type, $phone), true);
						if(strcasecmp($content['status'], 'SUCCESS') == 0) {
								update_option('mo_wpns_message', 'One Time Passcode has been sent for verification to ' . $phone);
								update_option('mo_wpns_transactionId',$content['txId']);
								$this->show_success_message();
						}
					}else{
						update_option('mo_wpns_message', 'Please enter the phone number in the following format: <b>+##country code## ##phone number##');
						$this->show_error_message();
					}
				} else if($_POST['option'] == "mo_wpns_registeration_back"){
					delete_option('mo_wpns_registration_status');
				} else if($_POST['option'] == 'mo_wpns_cancel'){
					delete_option('mo_wpns_admin_email');
					delete_option('mo_wpns_registration_status');
					delete_option('mo_wpns_verify_customer');
				} else if($_POST['option'] == 'mo_wpns_user_forgot_password'){
					$admin_email = get_option('mo_wpns_admin_email');
					$customer = new Mo_Wpns_Customer();
					$forgot_password_response = json_decode($customer->mo_wpns_forgot_password($admin_email));
					if($forgot_password_response->status == 'SUCCESS'){
						$message = 'You password has been reset successfully. Please enter the new password sent to your registered mail here.';
						update_option('mo_wpns_message', $message);
						$this->show_success_message();
					}
				} else if($_POST['option'] == "mo_wpns_manual_block_ip"){
					if( Mo_WPNS_Util::check_empty_or_null( $_POST['ip'] )) {
						update_option( 'mo_wpns_message', 'Please enter a valid IP address.');
						$this->show_error_message();
						return;
					} else{
						
						$ipAddress = sanitize_text_field( $_POST['ip'] );
						$mo_wpns_config = new Mo_WPNS_Handler();
						$row_count = $mo_wpns_config->count_ips(Mo_WPNS_Constants::BLOCKED_IPS_TABLE);
						
						if(intval($row_count) >= Mo_WPNS_Constants::IP_MAX_COUNT){
							update_option( 'mo_wpns_message', "You have reached to maximum limit for blocking IP's. Please upgrade the plugin if you want to block more IP's.");
							$this->show_error_message();
							return;
						}
						$isWhitelisted = $mo_wpns_config->is_whitelisted($ipAddress);
						if(!$isWhitelisted){
							if($mo_wpns_config->is_ip_blocked($ipAddress)){
								update_option( 'mo_wpns_message', "IP Address is already in blocked IP's list.");
								$this->show_error_message();
							} else{
								$mo_wpns_config->block_ip($ipAddress, Mo_WPNS_Messages::BLOCKED_BY_ADMIN, true);
								update_option( 'mo_wpns_message', 'IP Address is blocked permanently.');
								$this->show_success_message();
							}
						}else{
							update_option( 'mo_wpns_message', "IP Address is in Whitelisted IP's list. Please remove it from whitelisted list first.");
							$this->show_error_message();
						}
					}
				} else if($_POST['option'] == "mo_wpns_unblock_ip"){
					if( Mo_WPNS_Util::check_empty_or_null( $_POST['entryid'] )) {
						update_option( 'mo_wpns_message', 'Error processing your request. Please try again.');
						$this->show_error_message();
						return;
					}else{
						$entryid = sanitize_text_field( $_POST['entryid'] );
						$mo_wpns_config = new Mo_WPNS_Handler();
						$mo_wpns_config->unblock_ip_entry($entryid);
					}
				} else if($_POST['option'] == "mo_wpns_whitelist_ip"){
					if( Mo_WPNS_Util::check_empty_or_null( $_POST['ip'] )) {
						update_option( 'mo_wpns_message', 'Please enter a valid IP address.');
						$this->show_error_message();
						return;
					}else{
						$ipAddress = sanitize_text_field( $_POST['ip'] );
						$mo_wpns_config = new Mo_WPNS_Handler();
						$row_count = $mo_wpns_config->count_ips(Mo_WPNS_Constants::WHITELISTED_IPS_TABLE);
						
						if(intval($row_count) >= Mo_WPNS_Constants::IP_MAX_COUNT){
							update_option( 'mo_wpns_message', "You have reached to maximum limit for whitelisting IP's. Please upgrade the plugin if you want to whitelist more IP's.");
							$this->show_error_message();
							return;
						}
						if($mo_wpns_config->is_whitelisted($ipAddress)){
							update_option( 'mo_wpns_message', "IP Address is already in whitelisted IP's list.");
							$this->show_error_message();
						} else{
							$mo_wpns_config->whitelist_ip($ipAddress);
							update_option( 'mo_wpns_message', 'IP Address is whitelisted.');
							$this->show_success_message();
						}
					}
				} else if($_POST['option'] == "mo_wpns_remove_whitelist"){
					if( Mo_WPNS_Util::check_empty_or_null( $_POST['entryid'] )) {
						update_option( 'mo_wpns_message', 'Error processing your request. Please try again.');
						$this->show_error_message();
						return;
					}else{
						$entryid = sanitize_text_field( $_POST['entryid'] );
						$mo_wpns_config = new Mo_WPNS_Handler();
						$mo_wpns_config->remove_whitelist_entry($entryid);
					}
				} else if($_POST['option'] == "mo_wpns_enable_brute_force"){
					$enable_brute_force_protection = false;
					if(isset($_POST['enable_brute_force_protection'])  && $_POST['enable_brute_force_protection']){
						$enable_brute_force_protection = $_POST['enable_brute_force_protection'];
						update_option( 'mo_wpns_message', 'Brute force protection is enabled.');
						$this->show_success_message();
					}else {
						update_option( 'mo_wpns_message', 'Brute force protection is disabled.');
						$this->show_error_message();
					}
					update_option( 'mo_wpns_enable_brute_force', $enable_brute_force_protection);
				} else if($_POST['option'] == "mo_wpns_brute_force_configuration"){
					update_option( 'mo_wpns_allwed_login_attempts', $_POST['allwed_login_attempts']);
					update_option( 'mo_wpns_time_of_blocking_type', $_POST['time_of_blocking_type']);
					if(isset($_POST['time_of_blocking_val']))
						update_option( 'mo_wpns_time_of_blocking_val', $_POST['time_of_blocking_val']);
					$show_remaining_attempts = false;
					if(isset($_POST['show_remaining_attempts'])  && $_POST['show_remaining_attempts'])
						$show_remaining_attempts = true;
					update_option( 'mo_wpns_show_remaining_attempts', $show_remaining_attempts);
					$slow_down_attacks = false;
					if(isset($_POST['slow_down_attacks'])  && $_POST['slow_down_attacks'])
						$slow_down_attacks = true;
					update_option( 'mo_wpns_message', 'Your configuration has been saved.');
					$this->show_success_message();
				} else if($_POST['option'] == "mo_wpns_send_query"){
					$query = '';
					if( Mo_WPNS_Util::check_empty_or_null( $_POST['query_email'] ) || Mo_WPNS_Util::check_empty_or_null( $_POST['query'] ) ) {
						update_option( 'mo_wpns_message', 'Please submit your query along with email.');
						$this->show_error_message();
						return;
					} else{
						$query = sanitize_text_field( $_POST['query'] );
						$email = sanitize_text_field( $_POST['query_email'] );
						$phone = sanitize_text_field( $_POST['query_phone'] );
						$contact_us = new Mo_Wpns_Customer();
						$submited = json_decode($contact_us->submit_contact_us($email, $phone, $query),true);

						if( strcasecmp( $submited['status'], 'CURL_ERROR') == 0) {
							update_option('mo_wpns_message', $submited['statusMessage']);
							$this->show_error_message();
						} else if(json_last_error() == JSON_ERROR_NONE) {
							if ( $submited == false ) {
								update_option('mo_wpns_message', 'Your query could not be submitted. Please try again.');
								$this->show_error_message();
							} else {
								update_option('mo_wpns_message', 'Thanks for getting in touch! We shall get back to you shortly.');
								$this->show_success_message();
							}
						}

					}
				} else if($_POST['option'] == "mo_wpns_browser_blocking"){
					update_option( 'mo_wpns_block_chrome',  $_POST['mo_wpns_block_chrome']);
					update_option( 'mo_wpns_block_firefox',  $_POST['mo_wpns_block_firefox']);
					update_option( 'mo_wpns_block_ie',  $_POST['mo_wpns_block_ie']);
					update_option( 'mo_wpns_block_safari',  $_POST['mo_wpns_block_safari']);
					update_option( 'mo_wpns_block_opera',  $_POST['mo_wpns_block_opera']);
				} else if($_POST['option'] == "mo_wpns_enforce_strong_passswords"){
					update_option( 'mo_wpns_enforce_strong_passswords',  $_POST['mo_wpns_enforce_strong_passswords']);
					update_option( 'mo_wpns_enforce_strong_passswords_for_accounts',  $_POST['mo_wpns_enforce_strong_passswords_for_accounts']);
					update_option( 'mo_wpns_message', 'Your configuration has been saved.');
					$this->show_success_message();
				} else if($_POST['option'] == "mo_wpns_enforce_strong_passswords_for_registrations"){
					update_option( 'mo_wpns_enforce_strong_passswords_for_registrations',  $_POST['mo_wpns_enforce_strong_passswords_for_registrations']);
					if(get_option( 'mo_wpns_enforce_strong_passswords_for_registrations')){
						update_option( 'mo_wpns_message', 'Strong password enforcement is Enabled.');
						$this->show_success_message();
					}else {
						update_option( 'mo_wpns_message', 'Strong password enforcement is Disabled.');
						$this->show_error_message();
					}
				} else if($_POST['option'] == "mo_wpns_enable_user_agent_blocking"){
					update_option( 'mo_wpns_enable_user_agent_blocking',  $_POST['mo_wpns_enable_user_agent_blocking']);
					if(get_option( 'mo_wpns_enable_user_agent_blocking')){
						update_option( 'mo_wpns_message', 'User agent blocking is Enabled.');
						$this->show_success_message();
					}else {
						update_option( 'mo_wpns_message', 'User agent blocking is Disabled.');
						$this->show_error_message();
					}
				} else if($_POST['option'] == "mo_wpns_enable_2fa"){
					update_option( 'mo_wpns_enable_2fa',  $_POST['mo_wpns_enable_2fa']);
					if(get_option( 'mo_wpns_enable_2fa')){
						update_option( 'mo_wpns_message', 'Two Factor protection is Enabled.');
						$this->show_success_message();
					}else {
						update_option( 'mo_wpns_message', 'Two Factor protection is Disabled.');
						$this->show_error_message();
					}
				} else if($_POST['option'] == 'mo_wpns_reset_password'){
					$admin_email = get_option('mo_wpns_admin_email');
					$customer = new Mo_Wpns_Customer();
					$forgot_password_response = json_decode($customer->mo_wpns_forgot_password($admin_email));
					if($forgot_password_response->status == 'SUCCESS'){
						$message = 'You password has been reset successfully and sent to your registered email. Please check your mailbox.';
						update_option('mo_wpns_message', $message);
						$this->show_success_message();
					}
				}
				
			}
			
			$mo_wpns_2fa_handler = new Mo_WPNS_2fa_Handler();
			$mo_wpns_2fa_handler->update2faConfiguration();
			
		}
			
		}
		
		function mo_wpns_init(){
		
			$userIp = Mo_WPNS_Util::get_client_ip();
			$mo_wpns_config = new Mo_WPNS_Handler();
			$mo_wpns_blocking = new Mo_WPNS_Blocking();
			$isIpBlocked = false;

			if($mo_wpns_config->is_whitelisted($userIp)){
				
			} else if($mo_wpns_config->is_ip_blocked($userIp)){
				$isIpBlocked = true;
			}
			
			if($isIpBlocked){
				require_once 'templates/403.php';
				exit();
			}
			
			if(isset($_POST['option']) && $_POST['option']=="mo_wpns_change_password"){
					$secure_login_handler = new Mo_WPNS_Secure_Login_Handler();
					$username = $_POST['username'];
					if($secure_login_handler->update_strong_passwords($username,$_POST['password'],$_POST['new_password'],$_POST['confirm_password'])=="success"){
						$user = get_user_by("login",$username);
						//$user = wp_signon( $creds, false );
						wp_set_auth_cookie($user->ID,false,false);
						$this->mo_wpns_login_success($username);
						wp_redirect(get_option('siteurl') . '/wp-admin/index.php',301);
					} else 
						exit();
			}
			
		}
		
		function mo_wpns_registeration_validations( $errors, $sanitized_user_login, $user_email ) {
			return $errors;
		}

		
		function custom_login($user, $username, $password){
			if(empty($username) && empty ($password)){
				//bug here...call hook on page load
				$error = new WP_Error();
				return $error;
			} else if(empty($username) || empty ($password)){
				$error = new WP_Error();
				if(empty($username)){ //No email
					$error->add('empty_username', __('<strong>ERROR</strong>: Username field is empty.'));
				}
				if(empty($password)){ //No password
					$error->add('empty_password', __('<strong>ERROR</strong>: Password field is empty.'));
				}
				$this->mo_wpns_login_failed($username);
				return $error;
			}
			
			$user = get_user_by("login",$username);
			$error = new WP_Error();
			if($user){
				if ( $user && wp_check_password( $password, $user->data->user_pass, $user->ID) ){
					$secure_login_handler = new Mo_WPNS_Secure_Login_Handler();
					if($secure_login_handler->enforce_strong_passwords($username,$password,"")=="success"){
						if(get_option('mo_wpns_enable_brute_force'))
							$this->mo_wpns_login_success($username);
						return $user;
					}
					else 
						exit();
				} else
					$error->add('empty_password', __('<strong>ERROR</strong>: Wrong password.'));
			} else
					$error->add('empty_password', __('<strong>ERROR</strong>: User does not exist.'));
			$this->mo_wpns_login_failed($username);
			return $error;
		}

		/*
		 * Save all required fields on customer registration/retrieval complete.
		 */
		function save_success_customer_config($id, $apiKey, $token, $appSecret, $message) {
			update_option( 'mo_wpns_admin_customer_key', $id );
			update_option( 'mo_wpns_admin_api_key', $apiKey );
			update_option( 'mo_wpns_customer_token', $token );
			update_option( 'mo_wpns_app_secret', $appSecret );
			update_option( 'mo_wpns_enable_log_requests', true);
			update_option('mo_wpns_password', '');
			update_option( 'mo_wpns_message', $message);
			delete_option('mo_wpns_verify_customer');
			delete_option('mo_wpns_registration_status');
			$this->show_success_message();
		}

		function mo_wpns_login_failed($username){
			
			if(!get_option('mo_wpns_enable_brute_force'))
				return;
			
			$userIp = Mo_WPNS_Util::get_client_ip();
			if(empty($userIp))
				return;
				
			$mo_wpns_config = new Mo_WPNS_Handler();
			$mo_wpns_config->add_transactions($userIp, $username, Mo_WPNS_Constants::LOGIN_TRANSACTION, Mo_WPNS_Constants::FAILED);
			
			$isWhitelisted = $mo_wpns_config->is_whitelisted($userIp);
			if(!$isWhitelisted){
				
				$row_count = $mo_wpns_config->count_ips(Mo_WPNS_Constants::BLOCKED_IPS_TABLE);
						
				if(intval($row_count) >= Mo_WPNS_Constants::IP_MAX_COUNT){
					$mo_wpns_config->ip_blocking_limit_exceeded();
					return;
				}
				
				$failedAttempts = $mo_wpns_config->get_failed_attempts_count($userIp);
				
				$allowedLoginAttepts = 5;
				if(get_option('mo_wpns_allwed_login_attempts'))
					$allowedLoginAttepts = get_option('mo_wpns_allwed_login_attempts');
				
					
				if($allowedLoginAttepts - $failedAttempts<=0){
					$mo_wpns_config->block_ip($userIp, Mo_WPNS_Messages::LOGIN_ATTEMPTS_EXCEEDED, false);
					require_once 'templates/403.php';
					exit();
				}else {
					if(get_option('mo_wpns_show_remaining_attempts')){
						global $error;
						$diff = $allowedLoginAttepts - $failedAttempts;
						$error = "<br>You have <b>".$diff."</b> login attempts remaining.";
					}
				}
			}
			
		}
		function mo_wpns_login_success($username){
			
			$mo_wpns_config = new Mo_WPNS_Handler();
			$userIp = Mo_WPNS_Util::get_client_ip();
					
			if(!get_option('mo_wpns_enable_brute_force'))
				return;
			$mo_wpns_config->move_failed_transactions_to_past_failed($userIp);
			$mo_wpns_config->add_transactions($userIp, $username, Mo_WPNS_Constants::LOGIN_TRANSACTION, Mo_WPNS_Constants::SUCCESS);
		}
		
		function mo_wpns_settings_style() {
			wp_enqueue_style( 'mo_wpns_admin_settings_style', plugins_url('includes/css/style_settings.css', __FILE__));
			wp_enqueue_style( 'mo_wpns_admin_settings_phone_style', plugins_url('includes/css/phone.css', __FILE__));
			wp_enqueue_style( 'mo_wpns_admin_settings_datatable_style', plugins_url('includes/css/jquery.dataTables.min.css', __FILE__));
		}

		function mo_wpns_settings_script() {
			wp_enqueue_script( 'mo_wpns_admin_settings_phone_script', plugins_url('includes/js/phone.js', __FILE__ ));
			wp_enqueue_script( 'mo_wpns_admin_settings_script', plugins_url('includes/js/settings_page.js', __FILE__ ), array('jquery'));
			wp_enqueue_script( 'mo_wpns_admin_datatable_script', plugins_url('includes/js/jquery.dataTables.min.js', __FILE__ ), array('jquery'));
		}

		function error_message() {
			$class = "error";
			$message = get_option('mo_wpns_message');
			echo "<div class='" . $class . "'> <p>" . $message . "</p></div>";
		}

		function success_message() {
			$class = "updated";
			$message = get_option('mo_wpns_message');
			echo "<div class='" . $class . "'> <p>" . $message . "</p></div>";
		}

		function show_success_message() {
			remove_action( 'admin_notices', array( $this, 'error_message') );
			add_action( 'admin_notices', array( $this, 'success_message') );
		}

		function show_error_message() {
			remove_action( 'admin_notices', array( $this, 'success_message') );
			add_action( 'admin_notices', array( $this, 'error_message') );
		}

		function plugin_query_vars($vars) {
			$vars[] = 'app_name';
			return $vars;
		}

		function mo_wpns_activate() {
			//update_option( 'mo_wpns_register_user',1);
			
			$mo_wpns_config = new Mo_WPNS_Handler();
			$mo_wpns_config->create_db();
			
			update_option( 'mo_wpns_enable_brute_force', true);
			update_option( 'mo_wpns_show_remaining_attempts', true);
			update_option( 'mo_wpns_enable_ip_blocked_email_to_admin', true);
			
		}
		
		function mo_wpns_deactivate() {
			//delete all stored key-value pairs
			if( !Mo_WPNS_Util::check_empty_or_null( get_option('mo_wpns_registration_status') ) ) {
				delete_option('mo_wpns_admin_email');
			}
			delete_option('mo_wpns_admin_customer_key');
			delete_option('mo_wpns_admin_api_key');
			delete_option('mo_wpns_customer_token');
			delete_option('mo_wpns_message');
			delete_option('mo_wpns_transactionId');
			delete_option('mo_wpns_registration_status');
			
		}
	}
	new WP_Security_Pro;