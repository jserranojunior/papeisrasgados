<?php

	//if uninstall not called from WordPress exit
	if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) 
		exit();
	
	require('class-mo-wpns-utility.php');
	//Delete Server configuration upon uninstall
	if( !Mo_WPNS_Util::check_empty_or_null( get_option('mo_wpns_registration_status') ) ) {
		delete_option('mo_wpns_admin_email');
	}
	delete_option('mo_wpns_admin_customer_key');
	delete_option('mo_wpns_admin_api_key');
	delete_option('mo_wpns_customer_token');
	delete_option('mo_wpns_app_secret');
	delete_option('mo_wpns_message');
	delete_option('mo_wpns_transactionId');
	delete_option('mo_wpns_registration_status');
	
	delete_option('mo_wpns_enable_brute_force');
	delete_option('mo_wpns_show_remaining_attempts');
	delete_option('mo_wpns_enable_ip_blocked_email_to_admin');
	delete_option('mo_wpns_enable_unusual_activity_email_to_user');
	
	delete_option('mo_wpns_admin_fname');
	delete_option('mo_wpns_admin_lname');
	delete_option('mo_wpns_company');
	
	//drop custom db tables
	global $wpdb;
	$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}wpns_transactions" );
	$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}wpns_blocked_ips" );
	$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}wpns_whitelisted_ips" );
	$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}wpns_email_sent_audit" );

	
?>