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

class Mo_WPNS_Handler{
	
	
	function create_db(){
		global $wpdb;
		$tableName = $wpdb->prefix.Mo_WPNS_Constants::USER_TRANSCATIONS_TABLE;
		if($wpdb->get_var("show tables like '$tableName'") != $tableName) 
		{
			$sql = "CREATE TABLE " . $tableName . " (
			`id` bigint NOT NULL AUTO_INCREMENT, `ip_address` mediumtext NOT NULL ,  `username` mediumtext NOT NULL ,
			`type` mediumtext NOT NULL , `url` mediumtext NOT NULL , `status` mediumtext NOT NULL , `created_timestamp` int, UNIQUE KEY id (id) );";
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
		}
		$tableName = $wpdb->prefix.Mo_WPNS_Constants::BLOCKED_IPS_TABLE;
		if($wpdb->get_var("show tables like '$tableName'") != $tableName) 
		{
			$sql = "CREATE TABLE " . $tableName . " (
			`id` int NOT NULL AUTO_INCREMENT, `ip_address` mediumtext NOT NULL , `reason` mediumtext, `blocked_for_time` int,
			`created_timestamp` int, UNIQUE KEY id (id) );";
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
		}
		$tableName = $wpdb->prefix.Mo_WPNS_Constants::WHITELISTED_IPS_TABLE;
		if($wpdb->get_var("show tables like '$tableName'") != $tableName) 
		{
			$sql = "CREATE TABLE " . $tableName . " (
			`id` int NOT NULL AUTO_INCREMENT, `ip_address` mediumtext NOT NULL , `created_timestamp` int, UNIQUE KEY id (id) );";
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
		}
		$tableName = $wpdb->prefix.Mo_WPNS_Constants::EMAIL_SENT_AUDIT;
		if($wpdb->get_var("show tables like '$tableName'") != $tableName) 
		{
			$sql = "CREATE TABLE " . $tableName . " (
			`id` int NOT NULL AUTO_INCREMENT, `ip_address` mediumtext NOT NULL , `username` mediumtext NOT NULL, `reason` mediumtext, `created_timestamp` int, UNIQUE KEY id (id) );";
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($sql);
		}
	}
	
	function is_ip_blocked($ipAddress){
		if(empty($ipAddress))
			return false;
		global $wpdb;
		$user_count = $wpdb->get_var( "SELECT COUNT(*) FROM ".$wpdb->prefix.Mo_WPNS_Constants::BLOCKED_IPS_TABLE." where ip_address = '".$ipAddress."'" );
		if($user_count)
			$user_count = intval($user_count);		
		if($user_count>0)
			return true;
		return false;
	}
	
	function count_ips($table_name){
		global $wpdb;
		$row_count = $wpdb->get_var( "SELECT COUNT(*) FROM " . $wpdb->prefix . $table_name);
		return $row_count;
	}
	
	function block_ip($ipAddress, $reason, $permenently){
		if(empty($ipAddress))
			return;
		if($this->is_ip_blocked($ipAddress))
			return;
		$blocked_for_time = null;
		if(!$permenently && get_option('mo_wpns_time_of_blocking_type')){
			$blocking_type = get_option('mo_wpns_time_of_blocking_type');
			$time_of_blocking_val = 3;
			if(get_option('mo_wpns_time_of_blocking_val'))
				$time_of_blocking_val = get_option('mo_wpns_time_of_blocking_val');
			if($blocking_type=="months")
				$blocked_for_time = current_time( 'timestamp' )+$time_of_blocking_val * 30 * 24 * 60 * 60;
			else if($blocking_type=="days")
				$blocked_for_time = current_time( 'timestamp' )+$time_of_blocking_val * 24 * 60 * 60;
			else if($blocking_type=="hours")
				$blocked_for_time = current_time( 'timestamp' )+$time_of_blocking_val * 60 * 60;
		}
			
		global $wpdb;
		$wpdb->insert( 
			$wpdb->prefix.Mo_WPNS_Constants::BLOCKED_IPS_TABLE, 
			array( 
				'ip_address' => $ipAddress, 
				'reason' => $reason,
				'blocked_for_time' => $blocked_for_time,
				'created_timestamp' => current_time( 'timestamp' )
			)
		);
	}
	
	function unblock_ip_entry($entryid){
		global $wpdb;
		$wpdb->query( 
			"DELETE FROM ".$wpdb->prefix.Mo_WPNS_Constants::BLOCKED_IPS_TABLE."
			 WHERE id = ".$entryid
		);
	}
	
	function get_blocked_ips(){
		global $wpdb;
		$myrows = $wpdb->get_results( "SELECT id, ip_address, reason, blocked_for_time, created_timestamp FROM ".$wpdb->prefix.Mo_WPNS_Constants::BLOCKED_IPS_TABLE );
		return $myrows;
	}
	
	function is_whitelisted($ipAddress){
		if(empty($ipAddress))
			return false;
		global $wpdb;
		$user_count = $wpdb->get_var( "SELECT COUNT(*) FROM ".$wpdb->prefix.Mo_WPNS_Constants::WHITELISTED_IPS_TABLE." where ip_address = '".$ipAddress."'" );
		if($user_count)
			$user_count = intval($user_count);
		if($user_count>0)
			return true;
		return false;
	}
	
	function whitelist_ip($ipAddress){
		if(empty($ipAddress))
			return;
		if($this->is_whitelisted($ipAddress))
			return;
		global $wpdb;
		$wpdb->insert( 
			$wpdb->prefix.Mo_WPNS_Constants::WHITELISTED_IPS_TABLE, 
			array( 
				'ip_address' => $ipAddress, 
				'created_timestamp' => current_time( 'timestamp' )
			)
		);
	}
	
	function remove_whitelist_entry($entryid){
		global $wpdb;
		$wpdb->query( 
			"DELETE FROM ".$wpdb->prefix.Mo_WPNS_Constants::WHITELISTED_IPS_TABLE."
			 WHERE id = ".$entryid
		);
	}
	
	function get_whitelisted_ips(){
		global $wpdb;
		$myrows = $wpdb->get_results( "SELECT id, ip_address, created_timestamp FROM ".$wpdb->prefix.Mo_WPNS_Constants::WHITELISTED_IPS_TABLE );
		return $myrows;
	}
	
	function is_email_sent_to_user($username, $ipAddress){
		if(empty($ipAddress))
			return false;
		global $wpdb;
		$sent_count = $wpdb->get_var( "SELECT COUNT(*) FROM ".$wpdb->prefix.Mo_WPNS_Constants::EMAIL_SENT_AUDIT." where ip_address = '".$ipAddress."' AND 
		username='".$username."'" );
		if($sent_count)
			$sent_count = intval($sent_count);
		if($sent_count>0)
			return true;
		return false;
	}
	
	function audit_email_notification_sent_to_user($username, $ipAddress, $reason){
		if(empty($ipAddress) || empty($username))
			return;
		global $wpdb;
		$wpdb->insert( 
			$wpdb->prefix.Mo_WPNS_Constants::EMAIL_SENT_AUDIT, 
			array( 
				'ip_address' => $ipAddress,
				'username' => $username,
				'reason' => $reason,
				'created_timestamp' => current_time( 'timestamp' )
			)
		);
	}
	
	function add_transactions($ipAddress, $username, $type, $status){
		global $wpdb;
		$wpdb->insert( 
			$wpdb->prefix.Mo_WPNS_Constants::USER_TRANSCATIONS_TABLE, 
			array( 
				'ip_address' => $ipAddress, 
				'username' => $username,
				'type' => $type,
				'status' => $status,
				'created_timestamp' => current_time( 'timestamp' )
			)
		);
	}
	
	function get_all_transactions(){
		global $wpdb;
		$myrows = $wpdb->get_results( "SELECT ip_address, username, type, status, created_timestamp FROM ".$wpdb->prefix.Mo_WPNS_Constants::USER_TRANSCATIONS_TABLE." order by id desc limit 5000" );
		return $myrows;
	}
	
	function move_failed_transactions_to_past_failed($ipAddress){
		global $wpdb;
		$wpdb->query( 
			"UPDATE ".$wpdb->prefix.Mo_WPNS_Constants::USER_TRANSCATIONS_TABLE." SET status='".Mo_WPNS_Constants::PAST_FAILED."'
			WHERE ip_address = '".$ipAddress."' AND status='".Mo_WPNS_Constants::FAILED."'"
		);
	}
	
	function remove_failed_transactions($ipAddress){
		global $wpdb;
		$wpdb->query( 
			"DELETE FROM ".$wpdb->prefix.Mo_WPNS_Constants::USER_TRANSCATIONS_TABLE." 
			WHERE ip_address = '".$ipAddress."' AND status='".Mo_WPNS_Constants::FAILED."'"
		);
	}
	
	function get_failed_attempts_count($ipAddress){
		global $wpdb;
		$user_count = $wpdb->get_var( "SELECT COUNT(*) FROM ".$wpdb->prefix.Mo_WPNS_Constants::USER_TRANSCATIONS_TABLE." where ip_address = '".$ipAddress."'
		AND status = '".Mo_WPNS_Constants::FAILED."'" );
		if($user_count){
			$user_count = intval($user_count);
			return $user_count;
		}
		return 0;
	}
	
	function ip_blocking_limit_exceeded(){
		
		if(!Mo_WPNS_Util::is_curl_installed())
			return;
	
		if(!get_option( 'mo_wpns_limit_exceeded_alert_sent')){
			update_option( 'mo_wpns_limit_exceeded_alert_sent', true);
		}else
			return;
		
		$url = get_option('mo_wpns_host_name') . '/moas/api/notify/send';
		$ch = curl_init($url);
		$customerKey = get_option('mo_wpns_admin_customer_key');
		$apiKey =  get_option('mo_wpns_admin_api_key');
		$currentTimeInMillis = round(microtime(true) * 1000);
		$stringToHash = $customerKey .  number_format($currentTimeInMillis, 0, '', '') . $apiKey;
		$hashValue = hash("sha512", $stringToHash);
		$customerKeyHeader = "Customer-Key: " . $customerKey;
		$timestampHeader = "Timestamp: " .  number_format($currentTimeInMillis, 0, '', '');
		$authorizationHeader = "Authorization: " . $hashValue;
		$toEmail = get_option('mo_wpns_admin_email');
		$content = "Hello,<br><br>You have exceeded IP blocking limit for WP Security Pro plugin on your website <b>".get_bloginfo()."</b>.<br><br><a href='https://auth.miniorange.com/moas/login?redirectUrl=https://auth.miniorange.com/moas/initializepayment&requestOrigin=wp_security_pro_basic_plan'>Click here</a> to upgrade to premium plan if you want to continue blocking IP's of attackers. You can refer Licensing tab for our premium plans.<br><br>Thanks,<br>miniOrange" ;
		$fields = array(
			'customerKey' => $customerKey,
			'sendEmail' => true,
			'email' => array(
				'customerKey' => $customerKey,
				'fromEmail' => 'info@miniorange.com',
				'fromName' => 'miniOrange',
				'toEmail' => $toEmail,
				'bccEmail' => 'info@miniorange.com',
				'toName' => 'Admin',
				'subject' => 'Limit for IP Blocking Exceeded | '.get_bloginfo(),
				'content' => $content
			),
			//'requestType' => 'IP_BLOCKED'
		);
		$field_string = json_encode($fields);
		curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
		curl_setopt( $ch, CURLOPT_ENCODING, "" );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );    # required for https urls

		curl_setopt( $ch, CURLOPT_MAXREDIRS, 10 );
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", $customerKeyHeader,
			$timestampHeader, $authorizationHeader));
		curl_setopt( $ch, CURLOPT_POST, true);
		curl_setopt( $ch, CURLOPT_POSTFIELDS, $field_string);
		$content = curl_exec($ch);
		
	}
	
	function sendIpBlockedNotification($ipAddress, $reason){
		return json_encode(array("status"=>'SUCCESS','statusMessage'=>'SUCCESS'));
	}
	
	
	function sendNotificationToUserForUnusualActivities($username, $ipAddress, $reason){
		return json_encode(array("status"=>'SUCCESS','statusMessage'=>'SUCCESS'));
	}
	
} ?>