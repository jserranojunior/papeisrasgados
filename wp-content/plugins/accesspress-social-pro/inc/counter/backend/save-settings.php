<?php
defined('ABSPATH') or die("No script kiddies please!");
/**
 * Posted Data
 *  
 *  [action] => apsc_settings_action
    [social_profile] => Array
        (
            [facebook] => Array
                (
                    [page_id] => 
                )

            [twitter] => Array
                (
                    [username] => 
                    [consumer_key] => 
                    [consumer_secret] => 
                    [access_token] => 
                    [access_token_secret] => 
                )

            [googlePlus] => Array
                (
                    [page_id] => 
                    [api_key] => 
                )

            [instagram] => Array
                (
                    [username] => 
                    [user_id] => 
                    [access_token] => 
                )

            [youtube] => Array
                (
                    [username] => 
                    [channel_url] => 
                )

            [soundcloud] => Array
                (
                    [username] => 
                    [client_id] => 
                )

            [dribbble] => Array
                (
                    [username] => 
                )

            [steam] => Array
                (
                    [group_name] => 
                )

            [vimeo] => Array
                (
                    [username] => 
                )

            [pinterest] => Array
                (
                    [profile_url] => 
                )

            [forrst] => Array
                (
                    [username] => 
                )

            [vk] => Array
                (
                    [group_id] => 
                )

            [flickr] => Array
                (
                    [group_id] => 
                    [api_key] => 
                )

            [behance] => Array
                (
                    [username] => 
                )

            [github] => Array
                (
                    [username] => 
                )

        )

    [profile_order] => Array
        (
            [0] => facebook
            [1] => twitter
            [2] => googlePlus
            [3] => instagram
            [4] => youtube
            [5] => soundcloud
            [6] => dribbble
            [7] => steam
            [8] => vimeo
            [9] => pinterest
            [10] => forrst
            [11] => vk
            [12] => flickr
            [13] => behance
            [14] => github
            [15] => posts
            [16] => comments
        )

    [social_profile_theme] => theme-1
    [floating_sidebar] => Array
        (
            [active] => 1
            [show] => only_homepage
            [theme] => theme-4
            [bg_color] => #cecece
            [text_color] => #81d742
        )

    [cache_period] => 
    [apsc_settings_nonce] => 698af85d0a
    [_wp_http_referer] => /accesspress-social-counter-pro/wp-admin/admin.php?page=ap-social-counter-pro
    [ap_settings_submit] => Save all changes
 */
//$this->print_array($_POST);die();
foreach($_POST as $key=>$val)
{
    $$key = $val;
}
$apsc_settings = array();//array for saving all the settings
$apsc_settings['social_profile'] = $social_profile;
$apsc_settings['floating_sidebar'] = $floating_sidebar;
$apsc_settings['profile_order'] = $profile_order;
$apsc_settings['icon_hover_animation'] = $icon_hover_animation;
$apsc_settings['icon_hover_color'] = $icon_hover_color;
$apsc_settings['cache_period'] = $cache_period;
$apsc_settings['social_profile_theme'] = $social_profile_theme;
$apsc_settings['counter_format'] = $counter_format;
$apsc_settings['sidebar_counter_format'] = $sidebar_counter_format;
$apsc_settings['floatbar_profiles'] = sanitize_text_field($floatbar_profiles);
$apsc_settings['total_count'] = isset($total_count)?1:0;
update_option('apsc_settings', $apsc_settings);
$_SESSION['apsc_message'] = __('Settings Saved Successfully', 'ap-social-pro');
wp_redirect(admin_url().'admin.php?page=ap-social-counter-pro');



