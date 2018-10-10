<?php
defined('ABSPATH') or die("No script kiddies please!");
/**
 * Plugin Name: AccessPress Social Pro (shared on themelot.net)
 * Plugin URI: https://accesspressthemes.com/wordpress-plugins/accesspress-social-pro/
 * Description: AccessPress Social PRO is a Premium WordPress plugin to  allow anyone easily share website content (page, posts, image, media) on major social media and display your social accounts fans, subscribers and followers number on your website! 
 * Version: 1.0.2
 * Author: AccessPress Themes
 * Author URI: http://accesspressthemes.com
 * Domain Path: /languages/
 * Network: false
 * 
 */

if ( ! function_exists( 'is_plugin_active' ) )
     require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
if( is_plugin_active( 'accesspress-social-share/accesspress-social-share.php' ) ) {
	deactivate_plugins( plugin_basename( __FILE__ ) );
	die("Please deactivate the accesspress social share free version first!");
}

include('accesspress-social-share-pro.php');
include('accesspress-social-counter-pro.php');
register_activation_hook(__FILE__, array('SC_PRO_Class', 'load_default_settings'));
register_activation_hook(__FILE__, array('APSS_Class', 'plugin_activation'));
