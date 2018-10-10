<?php

/*Main function*/
function mo_wpns_show_settings() {
	if( isset( $_GET[ 'tab' ] ) ) {
		$active_tab = $_GET[ 'tab' ];
	} else {
		$active_tab = 'default';
	}
	
	?>
	<h2>WP Security Pro</h2>
	<?php
		if(!Mo_WPNS_Util::is_curl_installed()) {
			?>
			
			<div id="help_curl_warning_title" class="mo_wpns_title_panel">
				<p><a target="_blank" style="cursor: pointer;"><font color="#FF0000">Warning: PHP cURL extension is not installed or disabled. <span style="color:blue">Click here</span> for instructions to enable it.</font></a></p>
			</div>
			<div hidden="" id="help_curl_warning_desc" class="mo_wpns_help_desc">
					<ul>
						<li>Step 1:&nbsp;&nbsp;&nbsp;&nbsp;Open php.ini file located under php installation folder.</li>
						<li>Step 2:&nbsp;&nbsp;&nbsp;&nbsp;Search for <b>extension=php_curl.dll</b> </li>
						<li>Step 3:&nbsp;&nbsp;&nbsp;&nbsp;Uncomment it by removing the semi-colon(<b>;</b>) in front of it.</li>
						<li>Step 4:&nbsp;&nbsp;&nbsp;&nbsp;Restart the Apache Server.</li>
					</ul>
					For any further queries, please <a href="mailto:info@miniorange.com">contact us</a>.								
			</div>
					
			<?php
		}
		
		if(!Mo_WPNS_Util::is_extension_installed('mcrypt')) {
			?>
			<p><font color="#FF0000">(Warning: <a target="_blank" href="http://php.net/manual/en/mcrypt.installation.php">PHP mcrypt extension</a> is not installed or disabled)</font></p>
			<?php
		}
		
	?>
	<div class="mo2f_container">
		<h2 class="nav-tab-wrapper">
			<a class="nav-tab <?php echo $active_tab == 'account' ? 'nav-tab-active' : ''; ?>" href="<?php echo add_query_arg( array('tab' => 'account'), $_SERVER['REQUEST_URI'] ); ?>">Account</a>
			<a class="nav-tab <?php echo $active_tab == 'default' ? 'nav-tab-active' : ''; ?>" href="<?php echo add_query_arg( array('tab' => 'default'), $_SERVER['REQUEST_URI'] ); ?>">Login Security</a>
			<a class="nav-tab <?php echo $active_tab == 'registeration' ? 'nav-tab-active' : ''; ?>" href="<?php echo add_query_arg( array('tab' => 'registeration'), $_SERVER['REQUEST_URI'] ); ?>">Registration Security</a>
			<a class="nav-tab <?php echo $active_tab == 'blockedips' ? 'nav-tab-active' : ''; ?>" href="<?php echo add_query_arg( array('tab' => 'blockedips'), $_SERVER['REQUEST_URI'] ); ?>">IP Blocking</a>
			<a class="nav-tab <?php echo $active_tab == 'advancedblocking' ? 'nav-tab-active' : ''; ?>" href="<?php echo add_query_arg( array('tab' => 'advancedblocking'), $_SERVER['REQUEST_URI'] ); ?>">Advanced Blocking</a>
			<a class="nav-tab <?php echo $active_tab == 'notifications' ? 'nav-tab-active' : ''; ?>" href="<?php echo add_query_arg( array('tab' => 'notifications'), $_SERVER['REQUEST_URI'] ); ?>">Notifications</a>
			<a class="nav-tab <?php echo $active_tab == 'reports' ? 'nav-tab-active' : ''; ?>" href="<?php echo add_query_arg( array('tab' => 'reports'), $_SERVER['REQUEST_URI'] ); ?>">Reports</a>
			<a class="nav-tab <?php echo $active_tab == 'licencing' ? 'nav-tab-active' : ''; ?>" href="<?php echo add_query_arg( array('tab' => 'licencing'), $_SERVER['REQUEST_URI'] ); ?>">Licensing</a>
			<a class="nav-tab <?php echo $active_tab == 'troubleshooting' ? 'nav-tab-active' : ''; ?>" href="<?php echo add_query_arg( array('tab' => 'troubleshooting'), $_SERVER['REQUEST_URI'] ); ?>">Troubleshooting</a>
					
		</h2>
		<table style="width:100%;">
			<tr>
				<td style="width:75%;vertical-align:top;" id="configurationForm">
					<?php
							if($active_tab == 'registeration'){ 
								mo_wpns_registeration_security();
							} else if($active_tab == 'notifications'){ 
								mo_wpns_notifications();
							} else if($active_tab == 'troubleshooting'){ 
								mo_wpns_troubleshooting();
							} else if($active_tab == 'blockedips'){ 
								mo_wpns_blockedips();
							} else if($active_tab == 'advancedblocking'){ 
								mo_wpns_advancedblocking();
							} else if($active_tab == 'reports'){ 
								mo_wpns_reports();
							}  else if($active_tab == 'licencing'){ 
								mo_wpns_licencing();
							} else if($active_tab == 'account'){ 
								if (get_option ( 'mo_wpns_verify_customer' ) == 'true') {
									mo_wpns_login_page();
								} else if(get_option('mo_wpns_registration_status') == 'MO_OTP_DELIVERED_SUCCESS' || get_option('mo_wpns_registration_status') == 'MO_OTP_VALIDATION_FAILURE' || get_option('mo_wpns_registration_status') == 'MO_OTP_DELIVERED_FAILURE'){
									mo_wpns_show_otp_verification();
								} else if (! Mo_WPNS_Util::is_customer_registered()) {
									mo_wpns_registration_page();
								} else{
									mo_wpns_account_page();
								}
							} else{
									mo_wpns_configuration_page();
							}
					?>
				</td>
				<td style="vertical-align:top;padding-left:1%;">
					<?php echo mo_wpns_support(); ?>
				</td>
			</tr>
		</table>
	</div>
	<?php
}
/*End of main function*/

/* Create Customer function */
function mo_wpns_registration_page(){
	
	?>

<!--Register with miniOrange-->
<form name="f" method="post" action="">
	<input type="hidden" name="option" value="mo_wpns_register_customer" />
	<p>Just complete the short registration below to configure WP Security Pro plugin. Please enter a valid email id that you have access to. You will be able to move forward after verifying an OTP that we will send to this email.</p>
	<div class="mo_wpns_table_layout" style="min-height: 274px;">
		<h3>Register with miniOrange</h3>
		<div id="panel1">
			<table class="mo_wpns_settings_table">
				<tr>
					<td><b><font color="#FF0000">*</font>Website/Company:</b></td>
					<td><input class="mo_wpns_table_textbox" type="tel" id="company"
						name="company"
						title="Website/Company"
						value="<?php echo $_SERVER['SERVER_NAME']; ?>"
						required placeholder="Company Name" />
					</td>
				</tr>
				<tr>
					<td><b><font color="#FF0000">*</font>Email:</b></td>
					<td>
					<?php 	$current_user = wp_get_current_user();
							if(get_option('mo_wpns_admin_email'))
								$admin_email = get_option('mo_wpns_admin_email');
							else
								$admin_email = $current_user->user_email; ?>
					<input class="mo_wpns_table_textbox" type="email" name="email"
						required placeholder="person@example.com"
						value="<?php echo $admin_email;?>" /></td>
				</tr>

				<tr>
					<td><b>CellPhone number:</b></td>
					<td><input class="mo_wpns_table_textbox" type="tel" id="phone"
						pattern="[\+]\d{11,14}|[\+]\d{1,4}([\s]{0,1})(\d{0}|\d{9,10})" name="phone"
						title="Phone with country code eg. +1xxxxxxxxxx"
						placeholder="Phone with country code eg. +1xxxxxxxxxx"
						value="<?php echo get_option('mo_wpns_admin_phone');?>" />
						<i>We will call only if you call for support</i><br><br></td>
				</tr>
				
				<tr>
					<td><b>First Name:</b></td>
					<td><input class="mo_wpns_table_textbox" type="tel" id="fname"
						name="fname"
						title="First Name"
						value="<?php echo $current_user->user_firstname; ?>"
						placeholder="First Name" />
					</td>
				</tr>
				
				<tr>
					<td><b>Last Name:</b></td>
					<td><input class="mo_wpns_table_textbox" type="tel" id="lname"
						name="lname"
						title="Last Name"
						value="<?php echo $current_user->user_lastname; ?>"
						placeholder="Last Name" />
					</td>
				</tr>

				<tr>
					<td><b><font color="#FF0000">*</font>Password:</b></td>
					<td><input class="mo_wpns_table_textbox" required type="password"
						name="password" placeholder="Choose your password (Min. length 6)" />
					</td>
				</tr>
				<tr>
					<td><b><font color="#FF0000">*</font>Confirm Password:</b></td>
					<td><input class="mo_wpns_table_textbox" required type="password"
						name="confirmPassword" placeholder="Confirm your password" /></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><input type="submit" value="Save"
						class="button button-primary button-large" /></td>
				</tr>
			</table>
		</div>
	</div>
</form>
<!--<script>
	jQuery("#phone").intlTelInput();
</script> -->
<?php
}
/* End of Create Customer function */

/* Login for customer*/
function mo_wpns_login_page() {
	?>
		<!--Verify password with miniOrange-->
		<form name="f" method="post" action="">
			<input type="hidden" name="option" value="mo_wpns_verify_customer" />
			<div class="mo_wpns_table_layout">
				<h3>Login with miniOrange</h3>
				<div id="panel1">
					<table class="mo_wpns_settings_table">
						<tr>
							<td><b><font color="#FF0000">*</font>Email:</b></td>
							<td><input class="mo_wpns_table_textbox" type="email" name="email"
								required placeholder="person@example.com"
								value="<?php echo get_option('mo_wpns_admin_email');?>" /></td>
						</tr>
						<tr>
							<td><b><font color="#FF0000">*</font>Password:</b></td>
							<td><input class="mo_wpns_table_textbox" required type="password"
								name="password" placeholder="Enter your miniOrange password" /></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td><input type="submit" class="button button-primary button-large" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a
								href="#cancel_link">Cancel</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<a href="#mo_wpns_forgot_password_link">Forgot
									your password?</a></td>
						</tr>
					</table>
				</div>
			</div>
		</form>
		<form id="forgot_password_form" method="post" action="">
			<input type="hidden" name="option" value="mo_wpns_user_forgot_password" />
		</form>
		<form id="cancel_form" method="post" action="">
			<input type="hidden" name="option" value="mo_wpns_cancel" />
		</form>
		<script>

			jQuery('a[href="#cancel_link"]').click(function(){
				jQuery('#cancel_form').submit();
			});

			jQuery('a[href="#mo_wpns_forgot_password_link"]').click(function(){
				jQuery('#forgot_password_form').submit();
			});
		</script>
	<?php
}
/* End of Login for customer*/

/* Account for customer*/
function mo_wpns_account_page() {
	?>

			<div style="background-color:#FFFFFF; border:1px solid #CCCCCC; padding:0px 0px 0px 10px; width:98%;height:344px">
				<div>
					<h4>Thank You for registering with miniOrange.</h4>
					<h3>Your Profile</h3>
					<table border="1" style="background-color:#FFFFFF; border:1px solid #CCCCCC; border-collapse: collapse; padding:0px 0px 0px 10px; margin:2px; width:85%">
						<tr>
							<td style="width:45%; padding: 10px;">Username/Email</td>
							<td style="width:55%; padding: 10px;"><?php echo get_option('mo_wpns_admin_email')?></td>
						</tr>
						<tr>
							<td style="width:45%; padding: 10px;">Customer ID</td>
							<td style="width:55%; padding: 10px;"><?php echo get_option('mo_wpns_admin_customer_key')?></td>
						</tr>
						<tr>
							<td style="width:45%; padding: 10px;">API Key</td>
							<td style="width:55%; padding: 10px;"><?php echo get_option('mo_wpns_admin_api_key')?></td>
						</tr>
						<tr>
							<td style="width:45%; padding: 10px;">Token Key</td>
							<td style="width:55%; padding: 10px;"><?php echo get_option('mo_wpns_customer_token')?></td>
						</tr>
					</table>
					<br/>
					<p><a href="#mo_wpns_forgot_password_link">Click here</a> if you forgot your password to your miniOrange account.</p>
				</div>
			</div> 
			
			<form id="forgot_password_form" method="post" action="">
				<input type="hidden" name="option" value="mo_wpns_reset_password" />
			</form>
			
			<script>
				jQuery('a[href="#mo_wpns_forgot_password_link"]').click(function(){
					jQuery('#forgot_password_form').submit();
				});
			</script>
			
			<?php
			if( isset($_POST['option']) && ($_POST['option'] == "mo_wpns_verify_customer" ||
					$_POST['option'] == "mo_wpns_register_customer") ){ ?>
				<script>
					window.location.href = "<?php echo add_query_arg( array('tab' => 'licencing'), $_SERVER['REQUEST_URI'] ); ?>";
				</script>
			<?php }
}
/* End of Account for customer*/

function mo_wpns_link() {
	?>
	<a href="http://miniorange.com/cloud-identity-broker-service" style="display:none">Cloud Identity broker service</a>
	<?php
}

/* Configure WPNS function */
function mo_wpns_configuration_page(){
?>
	<div class="mo_wpns_small_layout">		
	
		<?php if (!Mo_WPNS_Util::is_customer_registered()) { ?>
				<div class="warning_div">Please <a href="<?php echo add_query_arg( array('tab' => 'account'), $_SERVER['REQUEST_URI'] ); ?>">Register or Login with miniOrange</a> to configure the WP Security Pro Plugin.</div>
		<?php } ?>
		
		<!-- Brute Force Configuration -->
		<h3>Brute Force Protection ( Login Protection )</h3>
		<div class="mo_wpns_subheading">This protects your site from attacks which tries to gain access / login to a site with random usernames and passwords.</div>
		
		<form id="mo_wpns_enable_brute_force_form" method="post" action="">
			<input type="hidden" name="option" value="mo_wpns_enable_brute_force">
			<input type="checkbox" name="enable_brute_force_protection" <?php if(get_option('mo_wpns_enable_brute_force')) echo "checked";?> onchange="document.getElementById('mo_wpns_enable_brute_force_form').submit();"> Enable Brute force protection
		</form>
		<br>
		<?php if(get_option('mo_wpns_enable_brute_force')){ 
			
			$allwed_login_attempts = 10;
			$time_of_blocking_type = "permanent";
			$time_of_blocking_val = 3;
			if(get_option('mo_wpns_allwed_login_attempts'))
				$allwed_login_attempts = get_option('mo_wpns_allwed_login_attempts');
			if(get_option('mo_wpns_time_of_blocking_type'))
				$time_of_blocking_type = get_option('mo_wpns_time_of_blocking_type');
			if(get_option('mo_wpns_time_of_blocking_val'))
				$time_of_blocking_val = get_option('mo_wpns_time_of_blocking_val');
			
		?>
			<form id="mo_wpns_enable_brute_force_form" method="post" action="">
			<input type="hidden" name="option" value="mo_wpns_brute_force_configuration">
			<table class="mo_wpns_settings_table">
				<tr>
					<td style="width:30%">Allowed login attempts before blocking an IP  : </td>
					<td style="width:25%"><input class="mo_wpns_table_textbox" type="number" id="allwed_login_attempts" name="allwed_login_attempts" required placeholder="10" value="<?php echo $allwed_login_attempts?>" /></td>
					<td style="width:25%"></td>
				</tr>
				<tr>
					<td>Time period for which IP should be blocked  : </td>
					<td>
						<select id="time_of_blocking_type" name="time_of_blocking_type" style="width:100%;">
						  <option value="permanent" <?php if($time_of_blocking_type=="permanent") echo "selected";?>>Permanently</option>
						  <option value="months" <?php if($time_of_blocking_type=="months") echo "selected";?>>Months</option>
						  <option value="days" <?php if($time_of_blocking_type=="days") echo "selected";?>>Days</option>
						  <option value="hours" <?php if($time_of_blocking_type=="hours") echo "selected";?>>Hours</option>
						</select>
					</td>
					<td><input class="mo_wpns_table_textbox <?php if($time_of_blocking_type=="permanent") echo "hidden";?>" type="number" id="time_of_blocking_val" name="time_of_blocking_val" value="<?php echo $time_of_blocking_val?>" placeholder="How many?" /></td>
				</tr>
				<tr>
					<td>Show remaining login attempts to user : </td>
					<td><input type="checkbox" name="show_remaining_attempts" <?php if(get_option('mo_wpns_show_remaining_attempts')) echo "checked";?> ></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td><br><input type="submit" name="submit" style="width:100px;" value="Save" class="button button-primary button-large"></td>
					<td></td>
				</tr>
			</table>
			</form>
		<?php } ?>
	</div>
	

	<div class="mo_wpns_small_layout premium_div">
		<h3>DOS protection - Process Delays</h3>
		<div class="warning_div">This feature is available in <a href="<?php echo add_query_arg( array('tab' => 'licencing'), $_SERVER['REQUEST_URI'] ); ?>">Premium Version</a> of the plugin only for now.</div><br>
		<div class="mo_wpns_subheading">Delays responses in case of an attacks.</div>
		
		<form id="mo_wpns_slow_down_attacks" method="post" action="">
			<input type="hidden" name="option" value="mo_wpns_slow_down_attacks">
			<input type="checkbox" name="mo_wpns_slow_down_attacks"> Enable processing delays for DOS protection
		</form>
		
		
		<br>
		<form id="mo_wpns_slow_down_attacks_config" method="post" action="">
		<input type="hidden" name="option" value="mo_wpns_slow_down_attacks_config">
		<?php
			$mo_wpns_slow_down_attacks_delay = 2;
			if(get_option('mo_wpns_slow_down_attacks_delay'))
				$mo_wpns_slow_down_attacks_delay = get_option('mo_wpns_slow_down_attacks_delay');
		?>
		<table class="mo_wpns_settings_table">
				<tr>
					<td style="width:30%">Increase Delay Time in each request by   : </td>
					<td style="width:25%"><input class="mo_wpns_table_textbox" type="number" id="mo_wpns_slow_down_attacks_delay" name="mo_wpns_slow_down_attacks_delay" required placeholder="delay" value="<?php echo $mo_wpns_slow_down_attacks_delay; ?>" /></td>
					<td style="width:25%"> &nbsp; Seconds</td>
				</tr>
				<tr>
					<td></td>
					<td><br><input type="submit" name="submit" style="width:100px;" value="Save" class="button button-primary button-large"></td>
					<td></td>
				</tr>
		</table>
		</form>
		
	</div>
	
	<div class="mo_wpns_small_layout">		
		<h3>Mobile authentication</h3>
		<div class="mo_wpns_subheading">Rather than relying on a password alone, which can be phished or guessed, Two Factor authentication adds a second layer of security to your WordPress accounts. We support <b>QR code</b>, <b>OTP over SMS</b> and <b>Email</b>, <b>Push</b>, <b>Soft token</b> (15+ methods to choose from). </div>
		
		<form id="mo_wpns_enable_2fa" method="post" action="">
			<input type="hidden" name="option" value="mo_wpns_enable_2fa">
			<input type="checkbox" name="mo_wpns_enable_2fa" <?php if(get_option('mo_wpns_enable_2fa')) echo "checked";?> onchange="document.getElementById('mo_wpns_enable_2fa').submit();"> Enable Mobile Authentication
		</form>
		
		<?php
		if(get_option('mo_wpns_enable_2fa')){
			$mo_wpns_2fa_handler = new Mo_WPNS_2fa_Handler();
			$mo_wpns_2fa_handler->update2faConfiguration();
			if($mo_wpns_2fa_handler->getstatus()=="ACTIVE"){
				//echo "<br><b><span style='font-size:15px;color:rgb(24, 203, 45);'>Active Method : Out Of Band Email</span></b><br>";
				echo "<br><a href='".admin_url('admin.php?page=miniOrange_2_factor_settings&mo2f_tab=mobile_configure')."'>Click here to configure or change your 2nd Factor Method.</a>";
			} else if($mo_wpns_2fa_handler->getstatus()=="INSTALLED"){
				$path = "miniorange-2-factor-authentication/miniorange_2_factor_settings.php";
				$activateUrl = wp_nonce_url(admin_url('plugins.php?action=activate&plugin='.$path), 'activate-plugin_'.$path);
			?>
				<br>For Two Factor authentication you need to have miniOrange 2 Factor plugin activated.<br><a href="<?php echo $activateUrl; ?>">Click here to activate 2 Factor Plugin</a>
			<?php
			} else {
				$action = 'install-plugin';
				$slug = 'miniorange-2-factor-authentication';
				$install_link =  wp_nonce_url(
					add_query_arg( array( 'action' => $action, 'plugin' => $slug ), admin_url( 'update.php' ) ),
					$action.'_'.$slug
				); ?>
				<br>For Two Factor authentication you need to have miniOrange 2 Factor plugin installed.<br><a href="<?php echo $install_link; ?>">Install 2 Factor Plugin</a>
			<?php	
			} 
		}
			?>
		
		<br>
	</div>
	
	<div class="mo_wpns_small_layout">		
		<h3>Enforce Strong Passwords </h3>
		<div class="mo_wpns_subheading">Checks the password strength of admin and other users to enhance login security</div>
		<?php
			$mo_wpns_enforce_strong_passswords_for_accounts = "all";
			if(get_option('mo_wpns_enforce_strong_passswords_for_accounts'))
				$mo_wpns_enforce_strong_passswords_for_accounts = get_option('mo_wpns_enforce_strong_passswords_for_accounts');
		?>
		<form id="mo_wpns_enable_brute_force_form" method="post" action="">
			<input type="hidden" name="option" value="mo_wpns_enforce_strong_passswords">
			<input type="checkbox" name="mo_wpns_enforce_strong_passswords" <?php if(get_option('mo_wpns_enforce_strong_passswords')) echo "checked";?> > Enable strong passwords
			
			<table style="width:100%"><tr><td style="width:50%">Select accounts for which you want to enable password security</td>
			<td><select id="mo_wpns_enforce_strong_passswords_for_accounts" name="mo_wpns_enforce_strong_passswords_for_accounts" style="width:100%;">
			  <option value="all" <?php if($mo_wpns_enforce_strong_passswords_for_accounts=="all") echo "selected";?>>All Accounts</option>
			  <option value="admin" <?php if($mo_wpns_enforce_strong_passswords_for_accounts=="admin") echo "selected";?>>Administrators Account Only</option>
			  <option value="user" <?php if($mo_wpns_enforce_strong_passswords_for_accounts=="user") echo "selected";?>>Users Account Only</option>
			</select></td></tr></table>
			<input type="submit" name="submit" style="width:100px;" value="Save" class="button button-primary button-large">
		</form>
	</div>
	
	<div class="mo_wpns_small_layout premium_div">	
		<h3>Risk Based Access</h3>
		<div class="warning_div">This feature is available in <a href="<?php echo add_query_arg( array('tab' => 'licencing'), $_SERVER['REQUEST_URI'] ); ?>">Premium Version</a> of the plugin only for now.</div><br>
		<div class="">Contextual authentication based on device, location, time of access and user behavior.</div><br>
		
		<form id="mo_wpns_risk_based_access" method="post" action="">
			<input type="hidden" name="option" value="mo_wpns_risk_based_access">
			<input type="checkbox" name="mo_wpns_risk_based_access" <?php if(get_option('mo_wpns_risk_based_access')) echo "checked";?> > Enable risk based access<br><br>
			<br><input type="submit" name="submit" style="width:100px;" value="Save" class="button button-primary button-large">
		</form>
		<br>
	</div>
	
	<script>
		<?php if (!Mo_WPNS_Util::is_customer_registered()) { ?>
			jQuery( document ).ready(function() {
				jQuery("#configurationForm :input").prop("disabled", true);
				jQuery("#configurationForm :input[type=text]").val("");
				jQuery("#configurationForm :input[type=url]").val("");
			});
		<?php } ?>
		jQuery( document ).ready(function() {
			jQuery(".premium_div :input").prop("disabled", true);
		});
		jQuery("#time_of_blocking_type").change(function() {
			if(jQuery(this).val()=="permanent")
				jQuery("#time_of_blocking_val").addClass("hidden");
			else
				jQuery("#time_of_blocking_val").removeClass("hidden");	
		});
		
	</script>
<?php
}
/* End of Configure function */


/* Registeration Security function */
function mo_wpns_registeration_security(){
	?> 
	<div class="mo_wpns_small_layout premium_div">	
		<?php if (!Mo_WPNS_Util::is_customer_registered()) { ?>
				<div class="warning_div">Please <a href="<?php echo add_query_arg( array('tab' => 'account'), $_SERVER['REQUEST_URI'] ); ?>">Register or Login with miniOrange</a> to configure the WP Security Pro Plugin.</div>
		<?php } ?>
		<h3>Block Registerations from fake users</h3>
		<div class="warning_div">This feature is available in <a href="<?php echo add_query_arg( array('tab' => 'licencing'), $_SERVER['REQUEST_URI'] ); ?>">Premium Version</a> of the plugin only for now.</div><br>
		<div class="mo_wpns_subheading">
			<li>Disallow Disposable / Fake / Temporary email addresses</li>
		</div>
		
		<form id="mo_wpns_enable_fake_domain_blocking" method="post" action="">
			<input type="hidden" name="option" value="mo_wpns_enable_fake_domain_blocking">
			<input type="checkbox" name="mo_wpns_enable_fake_domain_blocking" disabled> Enable blocking registrations from fake users.
		</form>
		<br>
	</div>
	
	<div class="mo_wpns_small_layout">	
		<h3>Enforce Strong Passwords</h3>
		<div class="mo_wpns_subheading">Checks the password strength during users registrations to enhance security</div>
		<form id="mo_wpns_enforce_strong_passswords_for_registrations" method="post" action="">
			<input type="hidden" name="option" value="mo_wpns_enforce_strong_passswords_for_registrations">
			<input type="checkbox" name="mo_wpns_enforce_strong_passswords_for_registrations" <?php if(get_option('mo_wpns_enforce_strong_passswords_for_registrations')) echo "checked";?> onchange="document.getElementById('mo_wpns_enforce_strong_passswords_for_registrations').submit();"> Enable strong passwords during users registrations
		</form>
		<br>
	</div>
	
	<div class="mo_wpns_small_layout premium_div">	
		<div class="warning_div">This feature is available in <a href="<?php echo add_query_arg( array('tab' => 'licencing'), $_SERVER['REQUEST_URI'] ); ?>">Premium Version</a> of the plugin only for now.</div>
		<h3>Advanced User Verification</h3>
		<div class="mo_wpns_subheading">Verify identity of user by sending One Time Password ( OTP ) on his phone number or email address.</div>
		
		<form id="mo_wpns_advanced_user_verification" method="post" action="">
			<input type="hidden" name="option" value="mo_wpns_advanced_user_verification">
			<input type="checkbox" name="mo_wpns_enable_advanced_user_verification" <?php if(get_option('mo_wpns_enable_advanced_user_verification')) echo "checked";?> > Enable advanced user verification<br><br>
			
			<table style="width:100%"><tr><td  width="25%">Select user verification method :</td><td width="35%"><input type="radio" name="gender" value="sms"> OTP Over SMS ( Phone ) </td><td><input type="radio" name="gender" value="email"> Otp Over Email</td></tr></table>
			<br><input type="submit" name="submit" style="width:100px;" value="Save" class="button button-primary button-large">
		</form>
		<br>
	</div>
	
	<div class="mo_wpns_small_layout premium_div">	
		<div class="warning_div">This feature is available in <a href="<?php echo add_query_arg( array('tab' => 'licencing'), $_SERVER['REQUEST_URI'] ); ?>">Premium Version</a> of the plugin only for now.</div>
		<h3>Social Login Integration</h3>
		<div class="mo_wpns_subheading">Allow your user to login and auto-register with their favourite social network like Google, Twitter, Facebook, Vkontakte, LinkedIn, Instagram, Amazon, Salesforce, Windows Live.</div>
		
		<form id="mo_wpns_social_integration" method="post" action="">
			<input type="hidden" name="option" value="mo_wpns_social_integration">
			<input type="checkbox" name="mo_wpns_enable_social_integration" <?php if(get_option('mo_wpns_enable_social_integration')) echo "checked";?> > Enable login and registrations with social networks.<br><br>
			<input type="checkbox" name="mo_wpns_enable_social_integration" <?php if(get_option('mo_wpns_enable_social_integration')) echo "checked";?> > Requires admin approval for users created with social networks.<br><br>
			<br><input type="submit" name="submit" style="width:100px;" value="Save" class="button button-primary button-large">
		</form>
		<br>
	</div>
	
	<script>
		<?php if (!Mo_WPNS_Util::is_customer_registered()) {  ?>
			jQuery( document ).ready(function() {
				jQuery("#mo_wpns_enable_fake_domain_blocking :input").prop("disabled", true);
				jQuery("#mo_wpns_enforce_strong_passswords_for_registrations :input").prop("disabled", true);
			});
		<?php } ?>
		jQuery( document ).ready(function() {
			jQuery("#mo_wpns_advanced_user_verification :input").prop("disabled", true);
			jQuery("#mo_wpns_advanced_user_verification :input[type=text]").val("");
			jQuery("#mo_wpns_social_integration :input").prop("disabled", true);
			jQuery("#mo_wpns_social_integration :input[type=text]").val("");
		});
	</script>
	<?php
}
/* End of Registeration Security function */

/* Registeration Security function */
function mo_wpns_notifications(){
	?>
	<div class="mo_wpns_small_layout premium_div">	
		<div class="warning_div">This feature is available in <a href="<?php echo add_query_arg( array('tab' => 'licencing'), $_SERVER['REQUEST_URI'] ); ?>">Premium Version</a> of the plugin only for now.</div>
		<h3>Email Notifications</h3>
		<form id="mo_wpns_enable_ip_blocked_email_to_admin" method="post" action="">
			<input type="hidden" name="option" value="mo_wpns_enable_ip_blocked_email_to_admin">
			<input type="checkbox" name="enable_ip_blocked_email_to_admin" > Notify Administrator if IP address is blocked.
		</form>
		<br>
		<form id="mo_wpns_enable_unusual_activity_email_to_user" method="post" action="">
			<input type="hidden" name="option" value="mo_wpns_enable_unusual_activity_email_to_user">
			<input type="checkbox" name="enable_unusual_activity_email_to_user" > Notify users for unusual activity with their account.
		</form>
		<br>
	</div>
	
	<div class="mo_wpns_small_layout premium_div">	
		<div class="warning_div">This feature is available in <a href="<?php echo add_query_arg( array('tab' => 'licencing'), $_SERVER['REQUEST_URI'] ); ?>">Premium Version</a> of the plugin only for now.</div>
		<h3>Customized Email Templates</h3>
		<div class="mo_wpns_subheading">You can customise email tempates for email notifications sent to User for unusual activities and also Administrator for blocked IP's.</div>
		
		<form id="mo_wpns_customise_email_tempates" method="post" action="">
			<input type="hidden" name="option" value="mo_wpns_customise_email_tempates">
			<input type="checkbox" name="mo_wpns_enable_custom_email_tempates" <?php if(get_option('mo_wpns_enable_custom_email_tempates')) echo "checked";?> > Enable custom email templates<br>
			<br><input type="submit" name="submit" style="width:100px;" value="Save" class="button button-primary button-large">
		</form>
		<br>
	</div>
	
	<script>
	<?php if (!Mo_WPNS_Util::is_customer_registered()) { ?>
		jQuery( document ).ready(function() {
			jQuery("#mo_wpns_enable_ip_blocked_email_to_admin :input").prop("disabled", true);
			jQuery("#mo_wpns_enable_unusual_activity_email_to_user :input").prop("disabled", true);
		});
	<?php } ?>
		jQuery( document ).ready(function() {
			jQuery(".premium_div :input").prop("disabled", true);
			jQuery(".premium_div :input[type=text]").val("");
		});
	</script>
	
	<?php
}
/* End of Registeration Security function */

function mo_wpns_blockedips(){
	$mo_wpns_handler = new Mo_WPNS_Handler();
	$blockedips = $mo_wpns_handler->get_blocked_ips(); ?>
	<div class="mo_wpns_small_layout">
	
		<?php if (!Mo_WPNS_Util::is_customer_registered()) { ?>
				<div class="warning_div">Please <a href="<?php echo add_query_arg( array('tab' => 'account'), $_SERVER['REQUEST_URI'] ); ?>">Register or Login with miniOrange</a> to configure the WP Security Pro Plugin.</div><br>
		<?php } ?>
		<h2>Manual Block IP's</h2>
		<form name="f" method="post" action="" id="manualblockipform" >
			<input type="hidden" name="option" value="mo_wpns_manual_block_ip" />
			<table><tr><td>You can manually block an IP address here: </td>
			<td style="padding:0px 10px"><input class="mo_wpns_table_textbox" type="text" name="ip"
				required placeholder="IP address" value=""  pattern="((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}" /></td>
			<td><input type="submit" class="button button-primary button-large" value="Manual Block IP" /></td></tr></table>
		</form>
		<h2>Blocked IP's</h2>
		<table id="blockedips_table" class="display">
		<thead><tr><th width="15%">IP Address</th><th width="25%">Reason</th><th width="24%">Blocked Until</th><th width="24%">Blocked Date</th><th width="20%">Action</th></tr></thead>
		<tbody>
		<?php foreach($blockedips as $blockedip){
			echo "<tr><td>".$blockedip->ip_address."</td><td>".$blockedip->reason."</td><td>";
			if(empty($blockedip->blocked_for_time)) echo "<span class=redtext>Permanently</span>"; else echo date("M j, Y, g:i:s a",$blockedip->blocked_for_time);
			echo "</td><td>".date("M j, Y, g:i:s a",$blockedip->created_timestamp)."</td><td><a onclick=unblockip('".$blockedip->id."')>Unblock IP</a></td></tr>";
		} ?>
		</tbody>
		</table>
	</div>
	<form class="hidden" id="unblockipform" method="POST">
		<input type="hidden" name="option" value="mo_wpns_unblock_ip" />
		<input type="hidden" name="entryid" value="" id="unblockipvalue" />
	</form>
	
	<?php $whitelisted_ips = $mo_wpns_handler->get_whitelisted_ips(); ?>
	<div class="mo_wpns_small_layout">
		<?php if (!Mo_WPNS_Util::is_customer_registered()) { ?>
				<div class="warning_div">Please <a href="<?php echo add_query_arg( array('tab' => 'account'), $_SERVER['REQUEST_URI'] ); ?>">Register or Login with miniOrange</a> to configure the WP Security Pro Plugin.</div><br>
		<?php } ?>
		<h2>Whitelist IP's</h2>
		<form name="f" method="post" action="" id="whitelistipform">
			<input type="hidden" name="option" value="mo_wpns_whitelist_ip" />
			<table><tr><td>Add new IP address to whitelist : </td>
			<td style="padding:0px 10px"><input class="mo_wpns_table_textbox" type="text" name="ip"
				required placeholder="IP address" value=""  pattern="((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}" /></td>
			<td><input type="submit" class="button button-primary button-large" value="Whitelist IP" /></td></tr></table>
		</form>
		<h2>Whitelisted IP's</h2>
		<table id="whitelistedips_table" class="display">
		<thead><tr><th width="30%">IP Address</th><th width="40%">Whitelisted Date</th><th width="30%">Remove from Whitelist</th></tr></thead>
		<tbody><?php foreach($whitelisted_ips as $whitelisted_ip){
			echo "<tr><td>".$whitelisted_ip->ip_address."</td><td>".date("M j, Y, g:i:s a",$whitelisted_ip->created_timestamp)."</td><td><a onclick=removefromwhitelist('".$whitelisted_ip->id."')>Remove</a></td></tr>";
		} ?></tbody>
		</table>
	</div>
	<form class="hidden" id="removefromwhitelistform" method="POST">
		<input type="hidden" name="option" value="mo_wpns_remove_whitelist" />
		<input type="hidden" name="entryid" value="" id="removefromwhitelistentry" />
	</form>

	<script>
		<?php if (!Mo_WPNS_Util::is_customer_registered()) { ?>
			jQuery( document ).ready(function() {
				jQuery("#manualblockipform :input").prop("disabled", true);
				jQuery("#manualblockipform :input[type=text]").val("");
				jQuery("#whitelistipform :input").prop("disabled", true);
				jQuery("#whitelistipform :input[type=text]").val("");
			});
		<?php } ?>
		function unblockip(entryid){
			jQuery("#unblockipvalue").val(entryid);
			jQuery("#unblockipform").submit();
		}
	</script>
	<script>
		jQuery(document).ready(function() {
			jQuery('#blockedips_table').DataTable({
				"order": [[ 3, "desc" ]]
			});
		} );
	</script>
	<script>
		function removefromwhitelist(entryid){
			jQuery("#removefromwhitelistentry").val(entryid);
			jQuery("#removefromwhitelistform").submit();
		}
	</script>
	<script>
		jQuery(document).ready(function() {
			jQuery('#whitelistedips_table').DataTable({
				"order": [[ 1, "desc" ]]
			});
		} );
	</script>
	<?php
}


function mo_wpns_advancedblocking(){
 ?>
	<div class="mo_wpns_small_layout premium_div">
		<?php if (!Mo_WPNS_Util::is_customer_registered()) { ?>
				<div class="warning_div">Please <a href="<?php echo add_query_arg( array('tab' => 'account'), $_SERVER['REQUEST_URI'] ); ?>">Register or Login with miniOrange</a> to configure the WP Security Pro Plugin.</div><br>
		<?php } ?>
		<h2>IP Address Range Blocking</h2>
		<div class="warning_div">This feature is available in <a href="<?php echo add_query_arg( array('tab' => 'licencing'), $_SERVER['REQUEST_URI'] ); ?>">Premium Version</a> of the plugin only for now.</div><br>
		You can block range of IP addresses here  ( Examples: 192.168.0.100 - 192.168.0.190 )
		<form name="f" method="post" action="" id="iprangeblockingform" >
			<input type="hidden" name="option" value="mo_wpns_block_ip_range" />
			<table id="iprangeblockingtable">
			<?php 
				$range_count = 1;
				if(is_numeric(get_option('mo_wpns_iprange_count')))
					$range_count = intval(get_option('mo_wpns_iprange_count'));
				for($i = 1 ; $i <= $range_count ; $i++){  ?>
				<tr><td style="width:300px"><input style="padding:0px 10px" class="mo_wpns_table_textbox" type="text" name="range_<?php echo $i;?>"
					 value="<?php echo get_option('mo_wpns_iprange_range_'.$i);?>"  placeholder=" e.g 192.168.0.100 - 192.168.0.190" /></td></tr>
			<?php } ?>
			</table>
			<a style="cursor:pointer" id="add_range">Add More Range</a><br><br>
			<input type="submit" class="button button-primary button-large" value="Block IP range" />
		</form>
	</div>
	
	
	<div class="mo_wpns_small_layout premium_div">
		<h2>Country Blocking</h2>
		<div class="warning_div">This feature is available in <a href="<?php echo add_query_arg( array('tab' => 'licencing'), $_SERVER['REQUEST_URI'] ); ?>">Premium Version</a> of the plugin only for now.</div><br>
		<b>Select countries from below which you want to block.</b><br><br>
		<form name="f" method="post" action="" id="countryblockingform" >
			<input type="hidden" name="option" value="mo_wpns_block_countries" />
			<table id="countryblockingtable" style="width:100%">
					<tr><td class="one-third"><input type="checkbox" name="A1">Anonymous Proxy</td>
					<td class="one-third"><input type="checkbox" name="A2" >Satellite Provider</td>
					<td class="one-third"><input type="checkbox" name="O1" >Other Country</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="AD" >Andorra</td>
					<td class="one-third"><input type="checkbox" name="AE" >United Arab Emirates</td>
					<td class="one-third"><input type="checkbox" name="AF" >Afghanistan</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="AG" >Antigua and Barbuda</td>
					<td class="one-third"><input type="checkbox" name="AI" >Anguilla</td>
					<td class="one-third"><input type="checkbox" name="AL" >Albania</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="AM" >Armenia</td>
					<td class="one-third"><input type="checkbox" name="AO" >Angola</td>
					<td class="one-third"><input type="checkbox" name="AP" >Asia/Pacific Region</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="AQ" >Antarctica</td>
					<td class="one-third"><input type="checkbox" name="AR" >Argentina</td>
					<td class="one-third"><input type="checkbox" name="AS" >American Samoa</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="AT" >Austria</td>
					<td class="one-third"><input type="checkbox" name="AU" >Australia</td>
					<td class="one-third"><input type="checkbox" name="AW" >Aruba</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="AX" >Aland Islands</td>
					<td class="one-third"><input type="checkbox" name="AZ" >Azerbaijan</td>
					<td class="one-third"><input type="checkbox" name="BA" >Bosnia and Herzegovina</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="BB" >Barbados</td>
					<td class="one-third"><input type="checkbox" name="BD" >Bangladesh</td>
					<td class="one-third"><input type="checkbox" name="BE" >Belgium</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="BF" >Burkina Faso</td>
					<td class="one-third"><input type="checkbox" name="BG" >Bulgaria</td>
					<td class="one-third"><input type="checkbox" name="BH" >Bahrain</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="BI" >Burundi</td>
					<td class="one-third"><input type="checkbox" name="BJ" >Benin</td>
					<td class="one-third"><input type="checkbox" name="BL" >Saint Bartelemey</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="BM" >Bermuda</td>
					<td class="one-third"><input type="checkbox" name="BN" >Brunei Darussalam</td>
					<td class="one-third"><input type="checkbox" name="BO" >Bolivia</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="BQ" >Bonaire, Saint Eustatius and Saba</td>
					<td class="one-third"><input type="checkbox" name="BR" >Brazil</td>
					<td class="one-third"><input type="checkbox" name="BS" >Bahamas</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="BT" >Bhutan</td>
					<td class="one-third"><input type="checkbox" name="BV" >Bouvet Island</td>
					<td class="one-third"><input type="checkbox" name="BW" >Botswana</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="BY" >Belarus</td>
					<td class="one-third"><input type="checkbox" name="BZ" >Belize</td>
					<td class="one-third"><input type="checkbox" name="CA" >Canada</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="CC" >Cocos (Keeling) Islands</td>
					<td class="one-third"><input type="checkbox" name="CD" >Congo, The Democratic Republic of the</td>
					<td class="one-third"><input type="checkbox" name="CF" >Central African Republic</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="CG" >Congo</td>
					<td class="one-third"><input type="checkbox" name="CH" >Switzerland</td>
					<td class="one-third"><input type="checkbox" name="CI" >Cote d'Ivoire</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="CK" >Cook Islands</td>
					<td class="one-third"><input type="checkbox" name="CL" >Chile</td>
					<td class="one-third"><input type="checkbox" name="CM" >Cameroon</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="CN" >China</td>
					<td class="one-third"><input type="checkbox" name="CO" >Colombia</td>
					<td class="one-third"><input type="checkbox" name="CR" >Costa Rica</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="CU" >Cuba</td>
					<td class="one-third"><input type="checkbox" name="CV" >Cape Verde</td>
					<td class="one-third"><input type="checkbox" name="CW" >Curacao</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="CX" >Christmas Island</td>
					<td class="one-third"><input type="checkbox" name="CY" >Cyprus</td>
					<td class="one-third"><input type="checkbox" name="CZ" >Czech Republic</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="DE" >Germany</td>
					<td class="one-third"><input type="checkbox" name="DJ" >Djibouti</td>
					<td class="one-third"><input type="checkbox" name="DK" >Denmark</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="DM" >Dominica</td>
					<td class="one-third"><input type="checkbox" name="DO" >Dominican Republic</td>
					<td class="one-third"><input type="checkbox" name="DZ" >Algeria</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="EC" >Ecuador</td>
					<td class="one-third"><input type="checkbox" name="EE" >Estonia</td>
					<td class="one-third"><input type="checkbox" name="EG" >Egypt</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="EH" >Western Sahara</td>
					<td class="one-third"><input type="checkbox" name="ER" >Eritrea</td>
					<td class="one-third"><input type="checkbox" name="ES" >Spain</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="ET" >Ethiopia</td>
					<td class="one-third"><input type="checkbox" name="EU" >Europe</td>
					<td class="one-third"><input type="checkbox" name="FI" >Finland</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="FJ" >Fiji</td>
					<td class="one-third"><input type="checkbox" name="FK" >Falkland Islands (Malvinas)</td>
					<td class="one-third"><input type="checkbox" name="FM" >Micronesia, Federated States of</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="FO" >Faroe Islands</td>
					<td class="one-third"><input type="checkbox" name="FR" >France</td>
					<td class="one-third"><input type="checkbox" name="GA" >Gabon</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="GB" >United Kingdom</td>
					<td class="one-third"><input type="checkbox" name="GD" >Grenada</td>
					<td class="one-third"><input type="checkbox" name="GE" >Georgia</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="GF" >French Guiana</td>
					<td class="one-third"><input type="checkbox" name="GG" >Guernsey</td>
					<td class="one-third"><input type="checkbox" name="GH" >Ghana</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="GI" >Gibraltar</td>
					<td class="one-third"><input type="checkbox" name="GL" >Greenland</td>
					<td class="one-third"><input type="checkbox" name="GM" >Gambia</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="GN" >Guinea</td>
					<td class="one-third"><input type="checkbox" name="GP" >Guadeloupe</td>
					<td class="one-third"><input type="checkbox" name="GQ" >Equatorial Guinea</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="GR" >Greece</td>
					<td class="one-third"><input type="checkbox" name="GS" >South Georgia and the South Sandwich Islands</td>
					<td class="one-third"><input type="checkbox" name="GT" >Guatemala</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="GU" >Guam</td>
					<td class="one-third"><input type="checkbox" name="GW" >Guinea-Bissau</td>
					<td class="one-third"><input type="checkbox" name="GY" >Guyana</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="HK" >Hong Kong</td>
					<td class="one-third"><input type="checkbox" name="HM" >Heard Island and McDonald Islands</td>
					<td class="one-third"><input type="checkbox" name="HN" >Honduras</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="HR" >Croatia</td>
					<td class="one-third"><input type="checkbox" name="HT" >Haiti</td>
					<td class="one-third"><input type="checkbox" name="HU" >Hungary</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="ID" >Indonesia</td>
					<td class="one-third"><input type="checkbox" name="IE" >Ireland</td>
					<td class="one-third"><input type="checkbox" name="IL" >Israel</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="IM" >Isle of Man</td>
					<td class="one-third"><input type="checkbox" name="IN" >India</td>
					<td class="one-third"><input type="checkbox" name="IO" >British Indian Ocean Territory</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="IQ" >Iraq</td>
					<td class="one-third"><input type="checkbox" name="IR" >Iran, Islamic Republic of</td>
					<td class="one-third"><input type="checkbox" name="IS" >Iceland</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="IT" >Italy</td>
					<td class="one-third"><input type="checkbox" name="JE" >Jersey</td>
					<td class="one-third"><input type="checkbox" name="JM" >Jamaica</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="JO" >Jordan</td>
					<td class="one-third"><input type="checkbox" name="JP" >Japan</td>
					<td class="one-third"><input type="checkbox" name="KE" >Kenya</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="KG" >Kyrgyzstan</td>
					<td class="one-third"><input type="checkbox" name="KH" >Cambodia</td>
					<td class="one-third"><input type="checkbox" name="KI" >Kiribati</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="KM" >Comoros</td>
					<td class="one-third"><input type="checkbox" name="KN" >Saint Kitts and Nevis</td>
					<td class="one-third"><input type="checkbox" name="KP" >Korea, Democratic People's Republic of</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="KR" >Korea, Republic of</td>
					<td class="one-third"><input type="checkbox" name="KW" >Kuwait</td>
					<td class="one-third"><input type="checkbox" name="KY" >Cayman Islands</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="KZ" >Kazakhstan</td>
					<td class="one-third"><input type="checkbox" name="LA" >Lao People's Democratic Republic</td>
					<td class="one-third"><input type="checkbox" name="LB" >Lebanon</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="LC" >Saint Lucia</td>
					<td class="one-third"><input type="checkbox" name="LI" >Liechtenstein</td>
					<td class="one-third"><input type="checkbox" name="LK" >Sri Lanka</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="LR" >Liberia</td>
					<td class="one-third"><input type="checkbox" name="LS" >Lesotho</td>
					<td class="one-third"><input type="checkbox" name="LT" >Lithuania</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="LU" >Luxembourg</td>
					<td class="one-third"><input type="checkbox" name="LV" >Latvia</td>
					<td class="one-third"><input type="checkbox" name="LY" >Libyan Arab Jamahiriya</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="MA" >Morocco</td>
					<td class="one-third"><input type="checkbox" name="MC" >Monaco</td>
					<td class="one-third"><input type="checkbox" name="MD" >Moldova, Republic of</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="ME" >Montenegro</td>
					<td class="one-third"><input type="checkbox" name="MF" >Saint Martin</td>
					<td class="one-third"><input type="checkbox" name="MG" >Madagascar</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="MH" >Marshall Islands</td>
					<td class="one-third"><input type="checkbox" name="MK" >Macedonia</td>
					<td class="one-third"><input type="checkbox" name="ML" >Mali</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="MM" >Myanmar</td>
					<td class="one-third"><input type="checkbox" name="MN" >Mongolia</td>
					<td class="one-third"><input type="checkbox" name="MO" >Macao</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="MP" >Northern Mariana Islands</td>
					<td class="one-third"><input type="checkbox" name="MQ" >Martinique</td>
					<td class="one-third"><input type="checkbox" name="MR" >Mauritania</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="MS" >Montserrat</td>
					<td class="one-third"><input type="checkbox" name="MT" >Malta</td>
					<td class="one-third"><input type="checkbox" name="MU" >Mauritius</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="MV" >Maldives</td>
					<td class="one-third"><input type="checkbox" name="MW" >Malawi</td>
					<td class="one-third"><input type="checkbox" name="MX" >Mexico</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="MY" >Malaysia</td>
					<td class="one-third"><input type="checkbox" name="MZ" >Mozambique</td>
					<td class="one-third"><input type="checkbox" name="NA" >Namibia</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="NC" >New Caledonia</td>
					<td class="one-third"><input type="checkbox" name="NE" >Niger</td>
					<td class="one-third"><input type="checkbox" name="NF" >Norfolk Island</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="NG" >Nigeria</td>
					<td class="one-third"><input type="checkbox" name="NI" >Nicaragua</td>
					<td class="one-third"><input type="checkbox" name="NL" >Netherlands</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="NO" >Norway</td>
					<td class="one-third"><input type="checkbox" name="NP" >Nepal</td>
					<td class="one-third"><input type="checkbox" name="NR" >Nauru</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="NU" >Niue</td>
					<td class="one-third"><input type="checkbox" name="NZ" >New Zealand</td>
					<td class="one-third"><input type="checkbox" name="OM" >Oman</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="PA" >Panama</td>
					<td class="one-third"><input type="checkbox" name="PE" >Peru</td>
					<td class="one-third"><input type="checkbox" name="PF" >French Polynesia</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="PG" >Papua New Guinea</td>
					<td class="one-third"><input type="checkbox" name="PH" >Philippines</td>
					<td class="one-third"><input type="checkbox" name="PK" >Pakistan</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="PL" >Poland</td>
					<td class="one-third"><input type="checkbox" name="PM" >Saint Pierre and Miquelon</td>
					<td class="one-third"><input type="checkbox" name="PN" >Pitcairn</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="PR" >Puerto Rico</td>
					<td class="one-third"><input type="checkbox" name="PS" >Palestinian Territory</td>
					<td class="one-third"><input type="checkbox" name="PT" >Portugal</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="PW" >Palau</td>
					<td class="one-third"><input type="checkbox" name="PY" >Paraguay</td>
					<td class="one-third"><input type="checkbox" name="QA" >Qatar</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="RE" >Reunion</td>
					<td class="one-third"><input type="checkbox" name="RO" >Romania</td>
					<td class="one-third"><input type="checkbox" name="RS" >Serbia</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="RU" >Russian Federation</td>
					<td class="one-third"><input type="checkbox" name="RW" >Rwanda</td>
					<td class="one-third"><input type="checkbox" name="SA" >Saudi Arabia</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="SB" >Solomon Islands</td>
					<td class="one-third"><input type="checkbox" name="SC" >Seychelles</td>
					<td class="one-third"><input type="checkbox" name="SD" >Sudan</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="SE" >Sweden</td>
					<td class="one-third"><input type="checkbox" name="SG" >Singapore</td>
					<td class="one-third"><input type="checkbox" name="SH" >Saint Helena</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="SI" >Slovenia</td>
					<td class="one-third"><input type="checkbox" name="SJ" >Svalbard and Jan Mayen</td>
					<td class="one-third"><input type="checkbox" name="SK" >Slovakia</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="SL" >Sierra Leone</td>
					<td class="one-third"><input type="checkbox" name="SM" >San Marino</td>
					<td class="one-third"><input type="checkbox" name="SN" >Senegal</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="SO" >Somalia</td>
					<td class="one-third"><input type="checkbox" name="SR" >Suriname</td>
					<td class="one-third"><input type="checkbox" name="SS" >South Sudan</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="ST" >Sao Tome and Principe</td>
					<td class="one-third"><input type="checkbox" name="SV" >El Salvador</td>
					<td class="one-third"><input type="checkbox" name="SX" >Sint Maarten</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="SY" >Syrian Arab Republic</td>
					<td class="one-third"><input type="checkbox" name="SZ" >Swaziland</td>
					<td class="one-third"><input type="checkbox" name="TC" >Turks and Caicos Islands</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="TD" >Chad</td>
					<td class="one-third"><input type="checkbox" name="TF" >French Southern Territories</td>
					<td class="one-third"><input type="checkbox" name="TG" >Togo</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="TH" >Thailand</td>
					<td class="one-third"><input type="checkbox" name="TJ" >Tajikistan</td>
					<td class="one-third"><input type="checkbox" name="TK" >Tokelau</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="TL" >Timor-Leste</td>
					<td class="one-third"><input type="checkbox" name="TM" >Turkmenistan</td>
					<td class="one-third"><input type="checkbox" name="TN" >Tunisia</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="TO" >Tonga</td>
					<td class="one-third"><input type="checkbox" name="TR" >Turkey</td>
					<td class="one-third"><input type="checkbox" name="TT" >Trinidad and Tobago</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="TV" >Tuvalu</td>
					<td class="one-third"><input type="checkbox" name="TW" >Taiwan</td>
					<td class="one-third"><input type="checkbox" name="TZ" >Tanzania, United Republic of</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="UA" >Ukraine</td>
					<td class="one-third"><input type="checkbox" name="UG" >Uganda</td>
					<td class="one-third"><input type="checkbox" name="UM" >United States Minor Outlying Islands</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="US" >United States</td>
					<td class="one-third"><input type="checkbox" name="UY" >Uruguay</td>
					<td class="one-third"><input type="checkbox" name="UZ" >Uzbekistan</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="VA" >Holy See (Vatican City State)</td>
					<td class="one-third"><input type="checkbox" name="VC" >Saint Vincent and the Grenadines</td>
					<td class="one-third"><input type="checkbox" name="VE" >Venezuela</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="VG" >Virgin Islands, British</td>
					<td class="one-third"><input type="checkbox" name="VI" >Virgin Islands, U.S.</td>
					<td class="one-third"><input type="checkbox" name="VN" >Vietnam</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="VU" >Vanuatu</td>
					<td class="one-third"><input type="checkbox" name="WF" >Wallis and Futuna</td>
					<td class="one-third"><input type="checkbox" name="WS" >Samoa</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="YE" >Yemen</td>
					<td class="one-third"><input type="checkbox" name="YT" >Mayotte</td>
					<td class="one-third"><input type="checkbox" name="ZA" >South Africa</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="ZM" >Zambia</td>
					</tr><tr><td class="one-third"><input type="checkbox" name="ZW" >Zimbabwe</td></tr>
			</table><br>
			<input type="submit" class="button button-primary button-large" value="Save" />
		</form>
	</div>
	
	<script>
		<?php if (!Mo_WPNS_Util::is_customer_registered()) { ?>
			jQuery( document ).ready(function() {
				jQuery("#iprangeblockingform :input").prop("disabled", true);
				jQuery("#iprangeblockingform :input[type=text]").val("");
			});
		<?php } ?>
		
	
		jQuery( document ).ready(function() {
			jQuery("#countryblockingform :input").prop("disabled", true);
			jQuery(".premium_div :input").prop("disabled", true);
		});
	</script>
	<?php
}


function mo_wpns_licencing(){
?>
	<div class="mo_wpns_table_layout">
		<table class="mo_wpns_local_pricing_table">
		<h2>Licensing Plans
		<span style="float:right"><input type="button" name="ok_btn" id="ok_btn" class="button button-primary button-large" value="OK, Got It" onclick="window.location.href='admin.php?page=wp_security_pro&tab=default'" /></span>
		</h2><hr>
		<tr style="vertical-align:top;">
		
				<td>
				<div class="mo_wpns_local_thumbnail mo_wpns_local_pricing_free_tab">
				
				<h3 class="mo_wpns_local_pricing_header">Free</h3>
				<h4 class="mo_wpns_local_pricing_sub_header" style="line-height:25px">(You are automatically on this plan)</h4>
				<br>
				<hr>
				<p class="mo_wpns_pricing_text" >$0<br><br><br><br><br></p>
				<p></p>
				<hr>
				<p class="mo_wpns_pricing_text" >
					Brute Force Protection ( Login Security and Monitoring - Limit Login Attempts and track user logins. )<br><br>
					<br><br><br>
					IP Blocking:(manual and automatic) [Blaclisting and whitelisting included]<br><br>
					<br><br><br>
					Mobile authentication based on QR code, OTP over SMS and email, Push, Soft token (15+ methods to choose from)<br>For 1 User<br><br>
					<br><br><br><br>
					Basic activity logs	auditing and reporting<br><br>
					<br><br><br>
					Password protection - Enforce Strong Password : Check Password strength for all users<br><br>
					<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
				<hr>
				</p>
				<p class="mo_wpns_pricing_text">Basic Support by Email</p>
				</td>
				<td>
				<div class="mo_wpns_local_thumbnail mo_wpns_local_pricing_paid_tab" >
				
				<h3 class="mo_wpns_local_pricing_header">Do it yourself</h3>
				<p></p>
				<h4 class="mo_wpns_local_pricing_sub_header" style="padding-bottom:8px !important;"><a class="button button-primary button-large"
				 onclick="upgradeform('wp_security_pro_basic_plan')" >Click here to upgrade</a> *</h4>
				
				<hr>
				<p class="mo_wpns_pricing_text" >$29 / year<br>+ <br>
				<span style="font-size:12px">( Additional Discounts available for<br>multiple instances and years)</span><br><br></p>
				<p></p>
				<hr>
				<p class="mo_wpns_pricing_text" >
					Brute Force Protection ( Login Security and Monitoring - Limit Login Attempts and track user logins. )<br><br>
					User Registration Security - Disallow Disposable / Fake email addresses<br><br>
					IP Blocking:(manual and automatic) [Blaclisting and whitelisting included]<br><br>
					Advanced Blocking - Block users based on: IP range, Country Blocking<br><br>
					Mobile authentication based on QR code, OTP over SMS and email, Push, Soft token (15+ methods to choose from)<br>For Unlimited Users<br><br>
					Notification to admin and end users - Send Email Alerts for IP blocking and unusual activities with user account<br><br>
					Advanced activity logs	auditing and reporting<br><br>
					DOS protection - Process Delays - Delays responses in case of an attack	<br><br>
					Password protection - Enforce Strong Password : Check Password strength for all users<br><br>
					Risk based access - Contextual authentication based on device, location, time of access and user behavior<br><br>
					Icon based Authentication<br><br>
					Honeypot - Divert hackers and bots away from your assets<br><br>
					Advanced User Verification<br><br>
					Social Login Integration<br><br>
					Customized Email Templates<br><br>
					Advanced Reporting<br><br><br>
					<hr>
				</p>

				
				<p class="mo_wpns_pricing_text" >Basic Support by Email</p>
				</div></td>
				<td>
				<div class="mo_wpns_local_thumbnail mo_wpns_local_pricing_free_tab" >
				<h3 class="mo_wpns_local_pricing_header">Premium</h3>
				<p></p>
				<h4 class="mo_wpns_local_pricing_sub_header" style="padding-bottom:8px !important;"><a class="button button-primary button-large"
				 onclick="upgradeform('wp_security_pro_premium_plan')" >Click here to upgrade</a> *</h4>
				 
				<hr>
				<p class="mo_wpns_pricing_text">$29 / year + One Time Setup Fees <br>
				( $45 per hour )<br>+ <br>
				<span style="font-size:12px">( Additional Discounts available for<br>multiple instances and years)</span><br></p>
				<hr>
				
				<p class="mo_wpns_pricing_text">
					Brute Force Protection ( Login Security and Monitoring - Limit Login Attempts and track user logins. )<br><br>
					User Registration Security - Disallow Disposable / Fake email addresses<br><br>
					IP Blocking:(manual and automatic) [Blaclisting and whitelisting included]<br><br>
					Advanced Blocking - Block users based on: IP range, Country Blocking<br><br>
					Mobile authentication based on QR code, OTP over SMS and email, Push, Soft token (15+ methods to choose from)<br>For Unlimited Users<br><br>
					Notification to admin and end users - Send Email Alerts for IP blocking and unusual activities with user account<br><br>
					Advanced activity logs	auditing and reporting<br><br>
					DOS protection - Process Delays - Delays responses in case of an attack	<br><br>
					Password protection - Enforce Strong Password : Check Password strength for all users<br><br>
					Risk based access - Contextual authentication based on device, location, time of access and user behavior<br><br>
					Icon based Authentication<br><br>
					Honeypot - Divert hackers and bots away from your assets<br><br>
					Advanced User Verification<br><br>
					Social Login Integration<br><br>
					Customized Email Templates<br><br>
					Advanced Reporting<br><br>
					End to End Integration Support<br>
					<hr>
				</p>
				
				
				
				<p class="mo_wpns_pricing_text">Premium Support Plans Available</p>
				
				</div></td>
			
		</tr>	
		</table>
		<form style="display:none;" id="loginform" action="<?php echo get_option( 'mo_wpns_host_name').'/moas/login'; ?>" 
		target="_blank" method="post">
		<input type="email" name="username" value="<?php echo get_option('mo_wpns_admin_email'); ?>" />
		<input type="text" name="redirectUrl" value="<?php echo get_option( 'mo_wpns_host_name').'/moas/initializepayment'; ?>" />
		<input type="text" name="requestOrigin" id="requestOrigin"  />
		</form>
		<script>
			function upgradeform(planType){
				jQuery('#requestOrigin').val(planType);
				jQuery('#loginform').submit();
			}
		</script>
		<br>
		<h3>* Steps to upgrade to premium plugin -</h3>
		<p>1. You will be redirected to miniOrange Login Console. Enter your password with which you created an account with us. After that you will be redirected to payment page.</p>
		<p>2. Enter you card details and complete the payment. On successful payment completion, you will see the link to download the premium plugin.</p>
		<p>3. Once you download the premium plugin, just unzip it and replace the folder with existing plugin. </p>
		<b>Note: Do not delete the plugin from the Wordpress Admin Panel and upload the plugin using zip. Your saved settings will get lost.</b>
		<p>4. From this point on, do not update the plugin from the Wordpress store. We will notify you when we upload a new version of the plugin.</p>
		
		<h3>** End to End Integration - We will setup a conference and do end to end configuration for you. We provide services to do the configuration on your behalf. </h3>
		
		<h3>10 Days Return Policy -</h3>
		<p>At miniOrange, we want to ensure you are 100% happy with your purchase. If you feel that the premium plugin you purchased is not the best fit for your requirements or you’ve attempted to resolve any feature issues with our support team, which couldn't get resolved. We will refund the whole amount within 10 days of the purchase. Please email us at <a href="mailto:info@miniorange.com">info@miniorange.com</a> for any queries regarding the return policy.<br><br>
If you have any doubts regarding the licensing plans, you can mail us at <a href="mailto:info@miniorange.com">info@miniorange.com</a> or submit a query using the support form.</p>
		<br>
		
<br><br>	

		</div>
		</div>
		<script>
			jQuery(document).ready(function() {
				jQuery('.mo_wpns_support_layout').hide();
				jQuery('#configurationForm').css("width","100%");
			});
		</script>
<?php
}

function mo_wpns_reports(){
	$mo_wpns_handler = new Mo_WPNS_Handler();
	$usertranscations = $mo_wpns_handler->get_all_transactions(); ?>
<div class="mo_wpns_small_layout">	
	<h2>User Transactions Report</h2>
	
	<div class="mo_wpns_small_layout premium_div">	
		<div class="warning_div">This feature is available in <a href="<?php echo add_query_arg( array('tab' => 'licencing'), $_SERVER['REQUEST_URI'] ); ?>">Premium Version</a> of the plugin only for now.</div>
		<div style="float:right;margin-top:10px">
		<input type="submit" name="printcsv" style="width:100px;" value="Print PDF" class="button button-success button-large">
		<input type="submit" name="printpdf" style="width:100px;" value="Print CSV" class="button button-success button-large">
		</div>
		<h3>Advanced Report</h3>
		
		<form id="mo_wpns_advanced_reports" method="post" action="">
			<input type="hidden" name="option" value="mo_wpns_advanced_reports">
			<table style="width:100%">
			<tr>
			<td width="33%">WordPress Username : <input class="mo_wpns_table_textbox" type="text"  name="username" required="" placeholder="Search by username" value=""></td>
			<td width="33%">IP Address :<input class="mo_wpns_table_textbox" type="text"  name="ip" required="" placeholder="Search by IP" value=""></td>
			<td width="33%">Status : <select name="status" style="width:100%;">
				  <option value="success" selected="">Success</option>
				  <option value="failed">Failed</option>
				</select>
			</td>
			</tr>
			<tr><td><br></td></tr>
			<tr>
			<td width="33%">User Action : <select name="action" style="width:100%;">
				  <option value="login" selected="">User Login</option>
				  <option value="register">User Registeration</option>
				</select>
			</td>
			<td width="33%">From Date : <input class="mo_wpns_table_textbox" type="date"  name="fromdate"></td>
			<td width="33%">To Date :<input class="mo_wpns_table_textbox" type="date"  name="todate"></td>
			</tr>
			</table>
			<br><input type="submit" name="Search" style="width:100px;" value="Search" class="button button-primary button-large">
		</form>
		<br>
	</div>
	
	<table id="reports_table" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>IP Address</th>
				<th>Username</th>
				<th>User Action</th>
				<th>Status</th>
                <th>Created Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($usertranscations as $usertranscation){
			echo "<tr><td>".$usertranscation->ip_address."</td><td>".$usertranscation->username."</td><td>".$usertranscation->type."</td><td>";
			if($usertranscation->status==Mo_WPNS_Constants::FAILED || $usertranscation->status==Mo_WPNS_Constants::PAST_FAILED)
				echo "<span style=color:red>".Mo_WPNS_Constants::FAILED."</span>";
			else if($usertranscation->status==Mo_WPNS_Constants::SUCCESS)
				echo "<span style=color:green>".Mo_WPNS_Constants::SUCCESS."</span>";
			else
				echo "N/A";
			echo "</td><td>".date("M j, Y, g:i:s a",$usertranscation->created_timestamp)."</td></tr>";
			} ?>
        </tbody>
    </table>
</div>
<script>
	jQuery(document).ready(function() {
		jQuery('#reports_table').DataTable({
			"order": [[ 4, "desc" ]]
		});
	} );
	jQuery( document ).ready(function() {
		jQuery(".premium_div :input").prop("disabled", true);
		jQuery(".premium_div :input[type=submit]").prop("disabled", true);
		jQuery(".premium_div :input[type=text]").val("");
		
	});
</script>
<?php	
}

function mo_wpns_troubleshooting(){
	?>
	
	<div class="mo_wpns_table_layout">
		<table class="mo_wpns_help">
					<tbody><tr>
						<td class="mo_wpns_help_cell">
							<div id="mo_wpns_help_curl_title" class="mo_wpns_title_panel">
								<div class="mo_wpns_help_title">How to enable PHP cURL extension? (Pre-requisite)</div>
							</div>
							<div hidden="" id="mo_wpns_help_curl_desc" class="mo_wpns_help_desc" style="display: none;">
								<ul>
									<li>Step 1:&nbsp;&nbsp;&nbsp;&nbsp;Open php.ini file located under php installation folder.</li>
									<li>Step 2:&nbsp;&nbsp;&nbsp;&nbsp;Search for <b>extension=php_curl.dll</b>. </li>
									<li>Step 3:&nbsp;&nbsp;&nbsp;&nbsp;Uncomment it by removing the semi-colon(<b>;</b>) in front of it.</li>
									<li>Step 4:&nbsp;&nbsp;&nbsp;&nbsp;Restart the Apache Server.</li>
								</ul>
								For any further queries, please contact us.								
							</div>
						</td>
					</tr><tr>
						<td class="mo_wpns_help_cell">
							<div id="mo_wpns_help_mobile_auth_title" class="mo_wpns_title_panel">
								<div class="mo_wpns_help_title">How to enable Mobile authentication ( 2 Factor ) ?</div>
							</div>
							<div hidden="" id="mo_wpns_help_mobile_auth_desc" class="mo_wpns_help_desc" style="display: none;">
								<ul>
									<li>Step 1:&nbsp;&nbsp;&nbsp;&nbsp;Go to <b>Login Security</b> Tab and go to <b>Mobile Authentication</b> section.</li>
									<li>Step 2:&nbsp;&nbsp;&nbsp;&nbsp;If you have not installed 2 factor plugin you wil see link <b>"Install 2 Factor Plugin"</b>. Click this link and activate miniOrange 2 factor plugin.</li>
									<li>Step 3:&nbsp;&nbsp;&nbsp;&nbsp;If you already have 2 factor plugin installed and its disable you wil see link <b>"Click here to activate 2 Factor Plugin"</b>. Click this link and activate miniOrange 2 factor plugin.</li>
									<li>Step 4:&nbsp;&nbsp;&nbsp;&nbsp;Go to <b>"miniOrange 2-Factor"</b> tab from wordpress sidebar</li>
									<li>Step 5:&nbsp;&nbsp;&nbsp;&nbsp;Click on <b>"Setup Two-Factor"</b> tab and configure your 2nd factor method which you want to use during login.</li>
								</ul>
								For any further queries, please contact us.								
							</div>
						</td>
					</tr>
					<tr>
						<td class="mo_wpns_help_cell">
							<div id="mo_wpns_help_disposable_title" class="mo_wpns_title_panel">
								<div class="mo_wpns_help_title">What "Block Registerations from fake users" does ? (Premium Feature)</div>
							</div>
							<div hidden="" id="mo_wpns_help_disposable_desc" class="mo_wpns_help_desc" style="display: none;">
								There are many fake email provides which provides dispsable or temporary email address to users which expires in few minutes or few hours. You can block registerations from those email addresses.<br><br>
								
								For any further queries, please contact us.								
							</div>
						</td>
					</tr>
					<tr>
						<td class="mo_wpns_help_cell">
							<div id="mo_wpns_help_strong_pass_title" class="mo_wpns_title_panel">
								<div class="mo_wpns_help_title">What "Enforce Strong Passwords" does ?</div>
							</div>
							<div hidden="" id="mo_wpns_help_strong_pass_desc" class="mo_wpns_help_desc" style="display: none;">
								This feature check if users are having strong passwords for their account. If No, we force users to change their passwords to strong passwords during their login to wordpress.<br><br>
								
								For any further queries, please contact us.								
							</div>
						</td>
					</tr>
					<tr>
						<td class="mo_wpns_help_cell">
							<div id="mo_wpns_help_adv_user_ver_title" class="mo_wpns_title_panel">
								<div class="mo_wpns_help_title">What "Advanced User Verification" does ? (Premium Feature)</div>
							</div>
							<div hidden="" id="mo_wpns_help_adv_user_ver_desc" class="mo_wpns_help_desc" style="display: none;">
								This verifies users phone number or email address before registering users by sending One Time Password ( OTP ) on his phone number or email address. You can avoid fake registerations with it.<br><br>
								
								For any further queries, please contact us.								
							</div>
						</td>
					</tr>
					<tr>
						<td class="mo_wpns_help_cell">
							<div id="mo_wpns_help_social_login_title" class="mo_wpns_title_panel">
								<div class="mo_wpns_help_title">What "Social Login Integration" does ? (Premium Feature)</div>
							</div>
							<div hidden="" id="mo_wpns_help_social_login_desc" class="mo_wpns_help_desc" style="display: none;">
								You can allow your users to login or register to your site with their existing account with supported social networks like Google, Twitter, Facebook, Vkontakte, LinkedIn, Instagram, Amazon, Salesforce, Windows Live. No need to remember multiple account credentials for users.<br><br>
								
								For any further queries, please contact us.								
							</div>
						</td>
					</tr><tr>
						<td class="mo_wpns_help_cell">
							<div id="mo_wpns_help_custom_template_title" class="mo_wpns_title_panel">
								<div class="mo_wpns_help_title">What "Customized Email Templates" does ? (Premium Feature)</div>
							</div>
							<div hidden="" id="mo_wpns_help_custom_template_desc" class="mo_wpns_help_desc" style="display: none;">
								You can customize email templates for emails that are sent to users for unusual activities and also Administrator for blocked IP's. You can add your own subject, from name and email content. Also we support HTML content for email body.<br><br>
								
								For any further queries, please contact us.								
							</div>
						</td>
					</tr>
					
				</tbody></table>
	</div>
	
	
	<?php

}


/* Show OTP verification page*/
function mo_wpns_show_otp_verification(){
	?>
		<div class="mo_wpns_table_layout">
			<div id="panel2">
				<table class="mo_wpns_settings_table">
		<!-- Enter otp -->
				<form name="f" id="back_registration_form" method="post" action="">
							<td>
							<input type="hidden" name="option" value="mo_wpns_registeration_back"/>
							</td>
						</tr>
					</form>
					<form name="f" method="post" id="wpns_form" action="">
						<input type="hidden" name="option" value="mo_wpns_validate_otp" />
						<h3>Verify Your Email</h3>
						<tr>
							<td><b><font color="#FF0000">*</font>Enter OTP:</b></td>
							<td colspan="2"><input class="mo_wpns_table_textbox" autofocus="true" type="text" name="otp_token" required placeholder="Enter OTP" style="width:61%;" pattern="{6,8}"/>
							 &nbsp;&nbsp;<a style="cursor:pointer;" onclick="document.getElementById('resend_otp_form').submit();">Resend OTP over Email</a></td>
						</tr>
						<tr><td colspan="3"></td></tr>
						<tr><td></td><td>
						<a style="cursor:pointer;" onclick="document.getElementById('back_registration_form').submit();"><input type="button" value="Back" id="back_btn" class="button button-primary button-large" /></a>
						<input type="submit" value="Validate OTP" class="button button-primary button-large" />
						</td>
						</form>
						<td><form method="post" action="" id="mo_wpns_cancel_form">
							<input type="hidden" name="option" value="mo_wpns_cancel" />
						</form></td></tr>
					<form name="f" id="resend_otp_form" method="post" action="">
							<td>
							<input type="hidden" name="option" value="mo_wpns_resend_otp"/>
							</td>
						</tr>
					</form>
				</table>
				<br>
				<hr>

				<h3>I did not recieve any email with OTP . What should I do ?</h3>
				<form id="phone_verification" method="post" action="">
					<input type="hidden" name="option" value="mo_wpns_phone_verification" />
					 If you can't see the email from miniOrange in your mails, please check your <b>SPAM Folder</b>. If you don't see an email even in SPAM folder, verify your identity with our alternate method.
					 <br><br>
						<b>Enter your valid phone number here and verify your identity using one time passcode sent to your phone.</b><br><br><input class="mo_wpns_table_textbox" required="true" pattern="[\+]\d{1,3}\d{10}" autofocus="true" type="text" name="phone_number" id="phone" placeholder="Enter Phone Number" style="width:40%;" value="<?php echo get_option('mo_wpns_admin_phone');  ?>" title="Enter phone number without any space or dashes."/>
						<br><input type="submit" value="Send OTP" class="button button-primary button-large" />
				
				</form>
			</div>
		</div>
		<script>
	jQuery("#phone").intlTelInput();
	jQuery('#back_btn').click(function(){
			jQuery('#mo_wpns_cancel_form').submit();
	});
	
</script>
<?php
}
/* End Show OTP verification page*/



?>