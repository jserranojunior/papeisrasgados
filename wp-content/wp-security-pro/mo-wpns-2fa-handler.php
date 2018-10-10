<?php
/** Copyright (C) 2015  miniOrange

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>
* @package 		miniOrange OAuth
* @license		http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
*
**/

class Mo_WPNS_2fa_Handler{
	
	function getstatus(){
		if ( ! function_exists( 'get_plugins' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}
	    $all_plugins = get_plugins();
		$status = 'NOT_INSTALLED';
		if(isset($all_plugins['miniorange-2-factor-authentication/miniorange_2_factor_settings.php'])){
			$status = 'INSTALLED';
			if(is_plugin_active('miniorange-2-factor-authentication/miniorange_2_factor_settings.php'))
				$status = 'ACTIVE';	
		}
		return $status;
	}
	
	function update2faConfiguration(){
		
		if(!get_option( 'mo2f_customerKey') || !get_option( 'mo2f_api_key') || !get_option( 'mo2f_customer_token') || !get_option( 'mo2f_app_secret')){
			
			global $current_user;
			update_option('mo2f_email',get_option( 'mo_wpns_admin_email'));
			update_option('mo2f_host_name',get_option( 'mo_wpns_host_name'));
			update_option('mo2f_phone',get_option( 'mo_wpns_admin_phone'));
			update_option( 'mo2f_customerKey', get_option( 'mo_wpns_admin_customer_key'));
			update_option( 'mo2f_api_key', get_option( 'mo_wpns_admin_api_key'));
			update_option( 'mo2f_customer_token', get_option( 'mo_wpns_customer_token'));
			update_option( 'mo2f_app_secret', get_option( 'mo_wpns_app_secret') );
			update_option( 'mo2f_miniorange_admin', $current_user->ID);
			update_option( 'mo2f_new_customer',true);
			update_option( 'mo_2factor_admin_registration_status','MO_2_FACTOR_CUSTOMER_REGISTERED_SUCCESS');
			update_user_meta($current_user->ID,'mo_2factor_user_registration_with_miniorange','SUCCESS');
			update_user_meta($current_user->ID,'mo_2factor_map_id_with_email',get_option( 'mo_wpns_admin_email'));
			update_user_meta($current_user->ID,'mo_2factor_user_registration_status','MO_2_FACTOR_PLUGIN_SETTINGS');
			
			$this->mo2f_update_userinfo(get_user_meta($current_user->ID,'mo_2factor_map_id_with_email',true), 'OUT OF BAND EMAIL',null,'API_2FA',true);
			update_user_meta($current_user->ID,'mo2f_email_verification_status',true);
			
		}
		
	}
	
	
	function mo2f_update_userinfo($email,$authType,$phone,$tname,$enableAdminSecondFactor){
		if(!Mo_WPNS_Util::is_curl_installed()) {
			return json_encode(array("status"=>'CURL_ERROR','statusMessage'=>'<a href="http://php.net/manual/en/curl.installation.php">PHP cURL extension</a> is not installed or disabled.'));
		}
		
		$url = get_option('mo2f_host_name') . '/moas/api/admin/users/update';
		$ch = curl_init($url);
		
		/* The customer Key provided to you */
		$customerKey = get_option('mo2f_customerKey');
	
		/* The customer API Key provided to you */
		$apiKey = get_option('mo2f_api_key');
	
		/* Current time in milliseconds since midnight, January 1, 1970 UTC. */
		$currentTimeInMillis = round(microtime(true) * 1000);
	
		/* Creating the Hash using SHA-512 algorithm */
		$stringToHash = $customerKey . number_format($currentTimeInMillis, 0, '', '') . $apiKey;
		$hashValue = hash("sha512", $stringToHash);
	
		$customerKeyHeader = "Customer-Key: " . $customerKey;
		$timestampHeader = "Timestamp: " . number_format($currentTimeInMillis, 0, '', '');
		$authorizationHeader = "Authorization: " . $hashValue;
		if($authType == 'PUSH'){
			$authType = 'PUSH NOTIFICATIONS';
		}
		
		$fields = array(
			'customerKey' => $customerKey,
			'username' => $email,
			'phone' => $phone,
			'authType' => $authType,
			'transactionName' => $tname,
			'adminLoginSecondFactor' => $enableAdminSecondFactor
		);
		
		$field_string = json_encode($fields);

		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, false );
		curl_setopt( $ch, CURLOPT_ENCODING, "" );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );    # required for https urls

		curl_setopt( $ch, CURLOPT_MAXREDIRS, 10 );
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", $customerKeyHeader, 
											$timestampHeader, $authorizationHeader));
		curl_setopt( $ch, CURLOPT_POST, true);
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $field_string);
		curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt( $ch, CURLOPT_TIMEOUT, 20);
		$content = curl_exec($ch);

		if(curl_errno($ch)){
			return null;
		}
		curl_close($ch);
		return $content;
	}
	
	
} ?>