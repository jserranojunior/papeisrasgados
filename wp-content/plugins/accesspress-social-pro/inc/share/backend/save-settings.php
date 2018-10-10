<?php
defined('ABSPATH') or die('No script kiddies please!'); ?>
<?php
var_dump($_POST);
$apss_share_settings = array();
if ($_POST['action'] == 'apss_save_options') {
    $share_options = array();
    foreach ($_POST['apss_share_settings']['share_options'] as $key => $value) {
        $share_options[] = $value;
    }
    
    $apss_share_settings['share_options'] = $share_options;
    $apss_share_settings['social_icon_set'] = $_POST['apss_share_settings']['social_icon_set'];
    $apss_share_settings['share_positions'] = $_POST['apss_share_settings']['social_share_position_options'];
    
    $floating_sidebar = array();
    foreach ($_POST['apss_share_settings']['floating_sidebar'] as $key => $value) {
        $floating_sidebar[$key] = $value;
    }
    
    $apss_share_settings['floating_sidebar'] = $floating_sidebar;

    $social_networks = array();
    $apss_social_newtwork_order = explode(',', $_POST['apss_social_newtwork_order']);
    $social_network_array = array();
    foreach ($apss_social_newtwork_order as $social_network) {
        $social_network_array[$social_network] = (isset($_POST['social_networks'][$social_network])) ? 1 : 0;
    }
    
    $apss_share_settings['social_networks'] = $social_network_array;
    
    foreach ($_POST['pinit_options'] as $key => $value) {
        $pinit_options[$key] = $value;
    }
    
    $apss_share_settings['pin_it_button_options'] = $pinit_options;
    
    $popup_options=array();
    foreach ($_POST['apss_share_settings']['popup_options'] as $key => $value) {
        $popup_options[$key]=$value;
    }


    $apss_share_settings['popup_options']=$popup_options;

    $apss_share_settings['twitter_username'] = stripslashes_deep($_POST['apss_share_settings']['twitter_username']);
    $apss_share_settings['counter_enable_options'] = $_POST['apss_share_settings']['counter_enable_options'];
    $apss_share_settings['counter_type_options'] = $_POST['apss_share_settings']['counter_type_options'];


    $share_texts =array();
    foreach ($_POST['apss_share_settings']['share_texts'] as $key => $value) {
        $share_texts[$key]=$value;
    }

    $apss_share_settings['share_texts'] = $share_texts;
    
    $apss_social_networks_naming = array();
    foreach ($_POST['apss_share_settings']['apss_social_networks_naming'] as $key => $value) {
        $apss_social_networks_naming[$key] = $value;
    }

    $apss_share_settings['apss_social_networks_naming'] = $apss_social_networks_naming;

    $apss_share_settings['cache_period'] = is_numeric($_POST['apss_share_settings']['cache_settings']) ? $_POST['apss_share_settings']['cache_settings'] : '24';
    $apss_share_settings['dialog_box_options'] = $_POST['apss_share_settings']['dialog_box_options'];
    $apss_share_settings['apss_email_subject'] = stripslashes_deep($_POST['apss_share_settings']['apss_email_subject']);
    $apss_share_settings['apss_email_body'] = stripslashes_deep($_POST['apss_share_settings']['apss_email_body']);
    
    //var_dump($apss_share_settings);
    
    // The option already exists, so we just update it.
    update_option(APSS_SETTING_NAME, $apss_share_settings);
    $_SESSION['apss_message'] = __('Settings Saved Successfully.', APSS_TEXT_DOMAIN);
    wp_redirect(admin_url() . 'admin.php?page=apss-share-pro');
    exit;
}

