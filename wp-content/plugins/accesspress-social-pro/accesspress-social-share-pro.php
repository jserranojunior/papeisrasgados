<?php

//Decleration of the necessary constants for plugin
if (!defined('APSS_IMAGE_DIR')) {
    define('APSS_IMAGE_DIR', plugin_dir_url(__FILE__) . 'images/share');
}

if (!defined('APSS_JS_DIR')) {
    define('APSS_JS_DIR', plugin_dir_url(__FILE__) . 'js/share');
}

if (!defined('APSS_CSS_DIR')) {
    define('APSS_CSS_DIR', plugin_dir_url(__FILE__) . 'css/share');
}



if (!defined('APSS_VERSION')) {
    define('APSS_VERSION', '1.0.2');
}

if (!defined('APSS_TEXT_DOMAIN')) {
    define('APSS_TEXT_DOMAIN', 'ap-social-pro');
}

if (!defined('APSS_SETTING_NAME')) {
    define('APSS_SETTING_NAME', 'apss_share_settings');
}

//Decleration of the class for necessary configuration of a plugin

/**
 * Register of widgets
 * */
include_once('inc/share/backend/widget.php');

if (!class_exists('APSS_Class')) {

    class APSS_Class {

        var $apss_settings;

        function __construct() {
            $this->apss_settings = get_option(APSS_SETTING_NAME);
        
            //register_activation_hook(__FILE__, array($this, 'plugin_activation')); //load the default setting for the plugin while activating
            add_action('init', array($this, 'session_init')); //start the session if not started yet.
            add_action('admin_enqueue_scripts', array($this, 'register_admin_assets')); //registers all the assets required for wp-admin
            add_filter('the_content', array($this, 'apss_the_content_filter'), 12); // add the filter function for display of social share icons in frontend //added 12 priority level at the end to make the plugin compactible with Visual Composer.
            add_filter('the_excerpt', array($this, 'apss_the_content_filter'), 12); // add the filter function for display of social share icons in frontend //added 12 priority level at the end to make the plugin compactible with Visual Composer.
            add_action('wp_enqueue_scripts', array($this, 'register_frontend_assets')); // registers all the assets required for the frontend
            add_action('admin_menu', array($this, 'add_apss_menu')); //register the plugin menu in backend
            add_action('admin_post_apss_save_options', array($this, 'apss_save_options')); //save the options in the wordpress options table.
            add_action('admin_post_apss_restore_default_settings', array($this, 'apss_restore_default_settings')); //restores default settings.
            add_action('admin_post_apss_clear_cache', array($this, 'apss_clear_cache')); //clear the cache of the social share counter.
            add_shortcode('apss-share', array($this, 'apss_shortcode')); //adds a shortcode
            add_action('widgets_init', array($this, 'register_apss_widget'));
            add_action('add_meta_boxes', array($this, 'social_meta_box')); //for providing the option to disable the social share option in each frontend page
            add_action('save_post', array($this, 'save_meta_values')); //function to save the post meta values of a plugin.
            add_action('wp_footer', array($this, 'floating_sidebar')); //function to hook the floating sidebar to the frontend.
            add_action('wp_ajax_frontend_session', array($this, 'frontend_session'));
            add_action('wp_ajax_nopriv_frontend_counter', array($this, 'frontend_counter'));
            add_action('wp_ajax_frontend_counter', array($this, 'frontend_counter'));
            add_action('wp_ajax_nopriv_frontend_session', array($this, 'frontend_session'));
            add_action('wp_ajax_nopriv_frontend_popup_email_send', array($this, 'frontend_email_popup_send'));
            add_action('wp_ajax_frontend_popup_email_send', array($this, 'frontend_email_popup_send'));
            add_action('bp_activity_entry_meta', array($this, 'buddypress_social_share'), 999);
            add_action('wp_footer',array($this,'apss_temp'));
            
        }
        
         //called when plugin is activated
        function plugin_activation() {
                include( 'inc/share/backend/activation.php' );
        }

        //add plugins menu in backend
        function add_apss_menu() {
            //add_submenu_page('ap-social-counter-pro','AccessPress Social Share', 'AccessPress Social Share', 'manage_options', 'apss-share-pro', array($this, 'main_page'), APSS_IMAGE_DIR . '/apss-icon.png');
            
        }

        //plugins backend admin page
        function main_page() {
            include('inc/share/backend/main-page.php');
        }

        //for saving the plugin settings
        function apss_save_options() {
            if (isset($_POST['apss_add_nonce_save_settings']) && isset($_POST['apss_submit_settings']) && wp_verify_nonce($_POST['apss_add_nonce_save_settings'], 'apss_nonce_save_settings')) {
                include( 'inc/share/backend/save-settings.php' );
            } else {
                die('No script kiddies please!');
            }
        }

        //starts the session with the call of init hook
        function session_init() {
            if (!session_id()) {
                session_start();
            }
        }

        //returns the current page url
        function curPageURL() {
            $pageURL = 'http';
            if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
                $pageURL .= "s";
            }
            $pageURL .= "://";
            if ($_SERVER["SERVER_PORT"] != "80") {
                $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
            } else {
                $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
            }
            return $pageURL;
        }

        //returns all the registered post types only
        function get_registered_post_types() {
            $post_types = get_post_types();
            unset($post_types['post']);
            unset($post_types['page']);
            unset($post_types['attachment']);
            unset($post_types['revision']);
            unset($post_types['nav_menu_item']);
            return $post_types;
        }

        // returns all the registered taxonomies
        function get_registered_taxonomies() {
            $output = 'objects';
            $args = '';
            $taxonomies = get_taxonomies($args, $output);
            unset($taxonomies['category']);
            unset($taxonomies['post_tag']);
            unset($taxonomies['nav_menu']);
            unset($taxonomies['link_category']);
            unset($taxonomies['post_format']);
            return $taxonomies;
        }

        /**
         *
         * @param int $count
         * @param string $format
         */
        function get_formatted_count($count, $format) {
            switch ($format) {
                case '2':
                    $count = number_format($count);
                    break;
                case '3':
                    $count = $this->abreviateTotalCount($count);
                    break;
                default:
                    break;
            }
            return $count;
        }

        /**
         *
         * @param integer $value
         * @return string
         */
        function abreviateTotalCount($value) {

            $abbreviations = array(12 => 'T', 9 => 'B', 6 => 'M', 3 => 'K', 0 => '');

            foreach ($abbreviations as $exponent => $abbreviation) {
                if ($value >= pow(10, $exponent)) {
                    return round(floatval($value / pow(10, $exponent)), 1) . $abbreviation;
                }
            }
        }

        //function to return the content filter for the posts and pages
        function apss_the_content_filter($content) {
            global $post;
            $post_content=$content;
            $title = get_the_title();
            $content = strip_tags(get_the_content());
            $excerpt = substr($content, 0, 50);
            ob_start();
            include('inc/share/frontend/content-filter.php');
            $html_content = ob_get_contents();
            ob_get_clean();
           
            $woocommerce_products_enable = in_array('product', $this->apss_settings['share_options']);
            if (class_exists('WooCommerce') && $woocommerce_products_enable) {
                add_action('woocommerce_share', array($this, 'woocommerce_product_share'));
            }

            $content_flag = get_post_meta($post->ID, 'apss_content_flag', true);
            $all = in_array('all', $options['share_options']);
            $is_lists_authorized = (is_search() && $content_flag != '1' ) && $all ? true : false;

            $front_page = in_array('front_page', $options['share_options']);
            $is_front_page = (is_front_page() && $content_flag != '1' ) && $front_page ? true : false;

            $share_shows_in_options = $options['share_options'];
            $is_singular = is_singular($share_shows_in_options) && !is_front_page() && $content_flag != '1' ? true : false;
            if (!empty($share_shows_in_options)) {
                $is_tax = is_tax($share_shows_in_options);
            } else {
                $is_tax = false;
            }

            $is_category = in_array('categories', $options['share_options']);
            $default_category = (is_category()) && $is_category ? true : false;

            $is_default_archive = in_array('archives', $options['share_options']);
            $default_archives = ( (is_archive() && !is_tax() ) && !is_category() ) && $is_default_archive ? true : false;

            $custom_post_types_archives = ((is_post_type_archive() || is_tag()) && $is_tax) ? true : false;

            if ($counter_enable_options == '1') {
                $counter_class = 'counter-enable';
            } else {
                $counter_class = '';
            }



            if(empty($options['share_options'])){
                    return $post_content;

            }else if ($is_lists_authorized || $is_singular || $is_tax || $is_front_page || $default_category || $default_archives || $custom_post_types_archives) {
                    if ($options['share_positions'] == 'below_content') {
                        return $post_content . "<div class='apss-social-share apss-theme-$icon_set_value $counter_class clearfix' >" . $html_content . "</div>";
                    }

                    if ($options['share_positions'] == 'above_content') {
                        return "<div class='apss-social-share apss-theme-$icon_set_value clearfix'>$html_content</div>" . $post_content;
                    }

                    if ($options['share_positions'] == 'on_both') {
                        return "<div class='apss-social-share apss-theme-$icon_set_value clearfix'>$html_content</div>" . $post_content . "<div class='apss-social-share apss-theme-$icon_set_value clearfix'>$html_content</div>";
                    }
                } else {
                return $post_content;
                }
        }

        //function to make the social share compactible with woocommerce
        function woocommerce_product_share() {
            $counter_enable_options = $this->apss_settings['counter_enable_options'];
            if ($counter_enable_options == '1') {
                $counter_class = 'counter-enable';
            } else {
                $counter_class = '';
            }
            $icon_set_value = $this->apss_settings['social_icon_set'];
            echo "<div class='apss-social-share apss-theme-$icon_set_value $counter_class clearfix' >";
            ob_start();
            include('inc/share/frontend/content-filter.php');
            $html_content = ob_get_contents();
            ob_get_clean();
            echo $html_content;
            echo "</div>";
        }

        //functions for registrtion of the admin section for backend
        function register_admin_assets() {
            $screen = get_current_screen();

            /**
             * Backend CSS
             * */
            if ((isset($_GET['page']) && $_GET['page'] == 'apss-share-pro') || $screen->id == 'widgets') {
                wp_enqueue_style('wp-color-picker');
                wp_enqueue_script('wp-color-picker');
                wp_enqueue_style('aps-admin-css', APSS_CSS_DIR . '/backend.css', false, APSS_VERSION); //registering plugin admin css
                wp_enqueue_style('fontawesome-css', APSS_CSS_DIR . '/font-awesome.min.css', false, APSS_VERSION);

                /**
                 * Backend JS
                 * */
                wp_enqueue_script('jquery-ui-sortable');
                wp_enqueue_script('apss-admin-js', APSS_JS_DIR . '/backend.js', array('jquery', 'jquery-ui-sortable', 'wp-color-picker'), APSS_VERSION); //registering plugin's admin js
            }
        }

        /**
         * Registers Frontend Assets
         * */
        function register_frontend_assets() {
            wp_enqueue_style('apss-font-awesome', APSS_CSS_DIR . '/font-awesome.min.css', array(), APSS_VERSION);
            wp_enqueue_style('apss-font-opensans', 'http://fonts.googleapis.com/css?family=Open+Sans', array(), false);
            wp_enqueue_style('apss-frontend-css', APSS_CSS_DIR . '/frontend.css', array('apss-font-awesome'), APSS_VERSION);
            wp_enqueue_script('apss-frontend-mainjs', APSS_JS_DIR . '/frontend.js', array('jquery'), APSS_VERSION, true);
            $ajax_nonce = wp_create_nonce('apss-ajax-nonce');
            wp_localize_script('apss-frontend-mainjs', 'frontend_ajax_object', array('ajax_url' => admin_url() . 'admin-ajax.php', 'ajax_nonce' => $ajax_nonce));
            $options = get_option(APSS_SETTING_NAME);
            $pin_it_opts = $options['pin_it_button_options'];
            if (isset($pin_it_opts['enabled']) && $pin_it_opts['enabled'] == "1") {
                wp_enqueue_script('pinit-js', '//assets.pinterest.com/js/pinit.js', false, null, true);
            }
            add_filter('clean_url', array($this, 'pinit_js_config'));
            if ($options['popup_options']['enabled'] == '1') {
                $current_page_url = $this->curPageURL();
                $popup_urls = isset($_SESSION['apss_popup_urls']) ? $_SESSION['apss_popup_urls'] : array();
                if (!in_array($current_page_url, $popup_urls)) {
                    add_action('wp_footer', array($this, 'popup_share')); //add the action for the footer popup
                }
            }
        }

        /**
         * Funciton to print array in pre format
         * */
        function print_array($array) {
            echo "<pre>";
            print_r($array);
            echo "</pre>";
        }

        //function to restore the default setting of a plugin
        function apss_restore_default_settings() {
            $nonce = $_REQUEST['_wpnonce'];
            if (!empty($_GET) && wp_verify_nonce($nonce, 'apss-restore-default-settings-nonce')) {
                //restore the default plugin activation settings from the activation page.
                include( 'inc/share/backend/activation.php' );
                $_SESSION['apss_message'] = __('Settings restored Successfully.', APSS_TEXT_DOMAIN);
                wp_redirect(admin_url() . 'admin.php?page=apss-share-pro');
                exit;
            } else {
                die('No script kiddies please!');
            }
        }

        function popup_share() {
            include('inc/share/frontend/popup_share.php');
        }

        ////////////////////////////////////for count //////////////////////////////////////////////////////
        //for facebook url share count
        function get_fb($url) {
            $apss_settings = $this->apss_settings;
            $cache_period = $apss_settings['cache_period']*60*60;
            $fb_transient = 'fb_' . md5($url);
            $fb_transient_count = get_transient($fb_transient);
            if (false === $fb_transient_count) {

                $json_string = $this->get_json_values('https://graph.facebook.com/?id=' . $url);
                $json = json_decode($json_string, true);

                $facebook_count = isset($json['shares']) ? intval($json['shares']) : 0;
                set_transient($fb_transient, $facebook_count, $cache_period);
                global $wpdb;
                $transient_tbl_name = $wpdb->prefix . 'transients';
                $wpdb->insert(
                        $transient_tbl_name, array('transient_name' => $fb_transient), array('%s')
                );
            } else {
                $facebook_count = $fb_transient_count;
            }
            
            return $facebook_count;
        }

        //for twitter url share count
        function get_tweets($url) {
            $apss_settings = $this->apss_settings;
            $cache_period = $apss_settings['cache_period']*60*60;
            $twitter_transient = 'twitter_' . md5($url);
            $twitter_transient_count = get_transient($twitter_transient);
            if (false === $twitter_transient_count) {
                $json_string = $this->get_json_values('http://urls.api.twitter.com/1/urls/count.json?url=' . $url);
                $json = json_decode($json_string, true);
                $tweet_count = isset($json['count']) ? intval($json['count']) : 0;
                set_transient($twitter_transient, $tweet_count, $cache_period);
                global $wpdb;
                $transient_tbl_name = $wpdb->prefix . 'transients';
                $wpdb->insert(
                        $transient_tbl_name, array('transient_name' => $twitter_transient), array('%s')
                );
            } else {
                $tweet_count = $twitter_transient_count;
            }
            return $tweet_count;
        }

        //for google plus url share count
        function get_plusones($url) {
            $apss_settings = $this->apss_settings;
            $cache_period = $apss_settings['cache_period']*60*60;
            $googlePlus_transient = 'gp_' . md5($url);
            $googlePlus_transient_count = get_transient($googlePlus_transient);
            if (false === $googlePlus_transient_count) {
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, "https://clients6.google.com/rpc");
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($curl, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"' . rawurldecode($url) . '","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]');
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
                $curl_results = curl_exec($curl);
                curl_close($curl);
                $json = json_decode($curl_results, true);
                $plusones_count = isset($json[0]['result']['metadata']['globalCounts']['count']) ? intval($json[0]['result']['metadata']['globalCounts']['count']) : 0;
                set_transient($googlePlus_transient, $plusones_count, $cache_period);
                global $wpdb;
                $transient_tbl_name = $wpdb->prefix . 'transients';
                $wpdb->insert(
                        $transient_tbl_name, array('transient_name' => $googlePlus_transient), array('%s')
                );
            } else {
                $plusones_count = $googlePlus_transient_count;
            }
            return $plusones_count;
        }

        //for pinterest url share count
        function get_pinterest($url) {
            $apss_settings = $this->apss_settings;
            $cache_period = $apss_settings['cache_period']*60*60;
            $pinterest_transient = 'pinterest_' . md5($url);
            $pinterest_transient_count = get_transient($pinterest_transient);
            if (false === $pinterest_transient_count) {
                $json_string = $this->get_json_values('http://api.pinterest.com/v1/urls/count.json?url=' . $url);
                $json_string = preg_replace('/^receiveCount\((.*)\)$/', "\\1", $json_string);
                $json = json_decode($json_string, true);
                $pinterest_count = isset($json['count']) ? intval($json['count']) : 0;
                set_transient($pinterest_transient, $pinterest_count, $cache_period);
                global $wpdb;
                $transient_tbl_name = $wpdb->prefix . 'transients';
                $wpdb->insert(
                        $transient_tbl_name, array('transient_name' => $pinterest_transient), array('%s')
                );
            } else {
                $pinterest_count = $pinterest_transient_count;
            }
            return $pinterest_count;
        }

        //for linkedin url share count
        function get_linkedin($url) {
            $apss_settings = $this->apss_settings;
            $cache_period = $apss_settings['cache_period']*60*60;
            $linkedin_transient = 'linkedin_' . md5($url);
            $linkedin_transient_count = get_transient($linkedin_transient);
            if (false === $linkedin_transient_count) {

                $json_string = $this->get_json_values("https://www.linkedin.com/countserv/count/share?url=$url&format=json");
                $json = json_decode($json_string, true);
                $linkedin_count = isset($json['count']) ? intval($json['count']) : 0;
                set_transient($linkedin_transient, $linkedin_count, $cache_period);
                global $wpdb;
                $transient_tbl_name = $wpdb->prefix . 'transients';
                $wpdb->insert(
                        $transient_tbl_name, array('transient_name' => $linkedin_transient), array('%s')
                );
            } else {
                $linkedin_count = $linkedin_transient_count;
            }
            return $linkedin_count;
        }

        //for delicious url share count . The API might be depriciated
        function get_delicious($url) {
            $apss_settings = $this->apss_settings;
            $cache_period = $apss_settings['cache_period']*60*60;
            $delicious_transient = 'delicious_' . md5($url);
            $delicious_transient_count = get_transient($delicious_transient);
            if (false === $delicious_transient_count) {
                $json_string = $this->get_json_values('http://feeds.delicious.com/v2/json/urlinfo/data?url=' . $url);
                $json = json_decode($json_string, true);
                $delicious_count = isset($json[0]['total_posts']) ? intval($json[0]['total_posts']) : 0;
                set_transient($delicious_transient, $delicious_count, $cache_period);
                global $wpdb;
                $transient_tbl_name = $wpdb->prefix . 'transients';
                $wpdb->insert(
                        $transient_tbl_name, array('transient_name' => $delicious_transient), array('%s')
                );
            } else {
                $delicious_count = $delicious_transient_count;
            }
            return $delicious_count;
        }

        //for reddit url share count
        function get_reddit($url) {
            $apss_settings = $this->apss_settings;
            $cache_period = $apss_settings['cache_period']*60*60;
             $reddit_transient = 'reddit_' . md5($url);
            $reddit_transient_count = get_transient($reddit_transient);

            if (false === $reddit_transient_count) {
                $json_string = $this->get_json_values('http://www.reddit.com/api/info.json?url=' . $url);
                $json = json_decode($json_string, true);
                $reddit_count = isset($json['data']['children'][0]['data']['score']) ? intval($json['data']['children'][0]['data']['score']) : 0;
                set_transient($reddit_transient, $reddit_count, $cache_period);
                global $wpdb;
                $transient_tbl_name = $wpdb->prefix . 'transients';
                $wpdb->insert(
                        $transient_tbl_name, array('transient_name' => $reddit_transient), array('%s')
                );
            } else {
                $reddit_count = $reddit_transient_count;
            }
            return $reddit_count;
        }

        //for stumbleupon url share count
        function get_stumble($url) {
            $apss_settings = $this->apss_settings;
            $cache_period = $apss_settings['cache_period']*60*60;
            $stumble_transient = 'stumble_' . md5($url);
            $stumble_transient_count = get_transient($stumble_transient);
            if (false === $stumble_transient_count) {

                $json_string = $this->get_json_values('http://www.stumbleupon.com/services/1.01/badge.getinfo?url=' . $url);
                $json = json_decode($json_string, true);
                $stumble_count = isset($json['result']['views']) ? intval($json['result']['views']) : 0;
                set_transient($stumble_transient, $stumble_count, $cache_period);
                global $wpdb;
                $transient_tbl_name = $wpdb->prefix . 'transients';
                $wpdb->insert(
                        $transient_tbl_name, array('transient_name' => $stumble_transient), array('%s')
                );
            } else {
                $stumble_count = $stumble_transient_count;
            }
            return $stumble_count;
        }

        //for VKontakte url share count
        function get_vk($url) {
            $apss_settings = $this->apss_settings;
            $cache_period = $apss_settings['cache_period']*60*60;
            $vk_transient = 'vk_' . md5($url);
            $vk_transient_count = get_transient($vk_transient);
            if (false === $vk_transient_count) {

                $response = $this->get_json_values('http://vk.com/share.php?act=count&url=' . $url);
                // This API does not return JSON. Just plain text JS. Example:
                // 'VK.Share.count(0, 3779);'
                // From documentation, need to just grab the 2nd param: http://vk.com/developers.php?oid=-17680044&p=Share
                $matches = array();
                preg_match('/^VK\.Share\.count\(\d, (\d+)\);$/i', $response, $matches);
                $vk_count = isset($matches[1]) ? intval($matches[1]) : 0;
                set_transient($vk_transient, $vk_count, $cache_period);
                global $wpdb;
                $transient_tbl_name = $wpdb->prefix . 'transients';
                $wpdb->insert(
                        $transient_tbl_name, array('transient_name' => $vk_transient), array('%s')
                );
            } else {
                $vk_count = $vk_transient_count;
            }
            return $vk_count;
        }

        //for Buffer url share count
        function get_buffer($url){
            $apss_settings = $this->apss_settings;
            $cache_period = $apss_settings['cache_period']*60*60;
            $buffer_transient ='buffer_'.md5($url);
            $buffer_transient_count = get_transient( $buffer_transient );

             if (false === $buffer_transient_count) {

                $json_string = $this->get_json_values("https://www.linkedin.com/countserv/count/share?url=$url&format=json");
                $json = json_decode($json_string, true);
                $buffer_count = isset($json['shares']) ? intval($json['shares']) : 0;
                set_transient($buffer_transient, $buffer_count, $cache_period);
                global $wpdb;
                $transient_tbl_name = $wpdb->prefix . 'transients';
                $wpdb->insert(
                        $transient_tbl_name, array('transient_name' => $buffer_transient), array('%s')
                );
            } else {
                $buffer_count = $buffer_transient_count;
            }
            return $buffer_count;

        }

        //function to return json values from social media urls
        private function get_json_values($url) {
            $apss_settings = $this->apss_settings;
            $cache_period = $apss_settings['cache_period']*60*60;
            $args = array('timeout' => 10);
            $response = wp_remote_get($url, $args);
            $json_response = wp_remote_retrieve_body($response);
            return $json_response;
        }

        ////////////////////////////////////for count ends here/////////////////////////////////////////////

        /**
         * Clears the social share counter cache.
         */
        function apss_clear_cache() {
            if (!empty($_GET) && wp_verify_nonce($_GET['_wpnonce'], 'apss-clear-cache-nonce')) {
                global $wpdb;
                $transient_tbl_name = $wpdb->prefix.'transients';
                $transients = $wpdb->get_results("SELECT DISTINCT(transient_name) FROM $transient_tbl_name");
                foreach($transients as $transient){
                    delete_transient($transient->transient_name);
                }
                $wpdb->query("TRUNCATE $transient_tbl_name");

                $_SESSION['apss_message'] = __('Cache cleared Successfully', APSS_TEXT_DOMAIN);
                wp_redirect(admin_url() . 'admin.php?page=apss-share-pro');
            }
        }

        //function for adding shortcode of a plugin
        function apss_shortcode($attr) {
            ob_start();
            include('inc/share/frontend/shortcode.php');
            $html = ob_get_contents();
            ob_get_clean();
            return $html;
        }

        //registration of the social share widget
        function register_apss_widget() {
            register_widget('APSS_Widget');
        }

        //function for the options of pinit over all images
        function pinit_js_config($url) {
            if (FALSE === strpos($url, 'pinit') || FALSE === strpos($url, '.js') || FALSE === strpos($url, 'pinterest.com')) {
                // this isn't a Pinterest URL, ignore it
                return $url;
            }
            $options = get_option(APSS_SETTING_NAME);
            $pin_it_opts = $options['pin_it_button_options'];
            $hover_op = $pin_it_opts['enabled'];
            $return_string = "' async";
            $size_op = $pin_it_opts['icon_size'];
            $shape_op = $pin_it_opts['icon_shape'];

            // if image hover is enabled, append the data-pin-hover attribute
            if (isset($hover_op) && $hover_op == "1") {
                $return_string = "$return_string data-pin-hover='true";
            }

            // add the size only if it's set to something besides small
            if (isset($size_op)) {
                if ($size_op == "28" || $size_op == "32") {
                    $return_string = "$return_string' data-pin-height='$size_op";
                }
            }
            // add the shape
            if (isset($shape_op)) {
                $return_string = "$return_string' data-pin-shape='$shape_op";
            }
            if ($return_string == "") {
                return $url;
            }
            return $url . $return_string;
        }

        //function for adding the floating sidebar
        function floating_sidebar() {
            global $post;
            if (have_posts()) {
                $sidebar_flag = get_post_meta($post->ID, 'apss_sidebar_flag', true);
            } else {
                $sidebar_flag = 0;
            }
            if ($sidebar_flag != '1') {
                include('inc/share/frontend/floating_sidebar.php');
            }
            include('inc/share/frontend/emailshare.php');
            ?>
            <input type="hidden" id="apss-current-url" value="<?php echo $this->curPageURL(); ?>"/>
            <?php
        }

        ///////////////////////////for post meta options//////////////////////////////////
        /**
         * Adds a section in all the post and page section to disable the share options in frontend pages
         */
        function social_meta_box() {
            add_meta_box('ap-share-box', 'AccessPress social share options', array($this, 'metabox_callback'), '', 'side', 'core');
        }

        function metabox_callback($post) {
            wp_nonce_field('save_meta_values', 'ap_share_meta_nonce');
            $content_flag = get_post_meta($post->ID, 'apss_content_flag', true);
            $widget_flag = get_post_meta($post->ID, 'apss_widget_flag', true);
            $sidebar_flag = get_post_meta($post->ID, 'apss_sidebar_flag', true);
            ?>
            <label><input type="checkbox" value="1" name="apss_content_flag" <?php checked($content_flag, true) ?>/><?php _e('Hide share icons in content',  'ap-social-pro'); ?></label><br>
            <label><input type="checkbox" value="1" name="apss_widget_flag" <?php checked($widget_flag, true) ?>/><?php _e('Hide share icons in widget',  'ap-social-pro'); ?></label><br>
            <label><input type="checkbox" value="1" name="apss_sidebar_flag" <?php checked($sidebar_flag, true) ?>/><?php _e('Hide share icons in floating sidebar',  'ap-social-pro'); ?></label>

            <?php
        }

        /**
         * Save Share Flags on post save
         */
        function save_meta_values($post_id) {

            /*
             * We need to verify this came from our screen and with proper authorization,
             * because the save_post action can be triggered at other times.
             */

            // Check if our nonce is set.
            if (!isset($_POST['ap_share_meta_nonce'])) {
                return;
            }

            // Verify that the nonce is valid.
            if (!wp_verify_nonce($_POST['ap_share_meta_nonce'], 'save_meta_values')) {
                return;
            }

            // If this is an autosave, our form has not been submitted, so we don't want to do anything.
            if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
                return;
            }

            // Check the user's permissions.
            if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {

                if (!current_user_can('edit_page', $post_id)) {
                    return;
                }
            } else {

                if (!current_user_can('edit_post', $post_id)) {
                    return;
                }
            }

            /* OK, it's safe for us to save the data now. */
            // Make sure that it is set.
            //$this->print_array($_POST);die();
            $content_flag = (isset($_POST['apss_content_flag']) && $_POST['apss_content_flag'] == 1) ? 1 : 0;
            $widget_flag = (isset($_POST['apss_widget_flag']) && $_POST['apss_widget_flag'] == 1) ? 1 : 0;
            $sidebar_flag = (isset($_POST['apss_sidebar_flag']) && $_POST['apss_sidebar_flag'] == 1) ? 1 : 0;

            // Update the meta field in the database.
            update_post_meta($post_id, 'apss_content_flag', $content_flag);
            update_post_meta($post_id, 'apss_widget_flag', $widget_flag);
            update_post_meta($post_id, 'apss_sidebar_flag', $sidebar_flag);
        }

        ////////////////////////////////////////////////////////////

        function frontend_session() {
            include('inc/share/frontend/popup-session.php');
        }

        function frontend_email_popup_send() {
            include('inc/share/frontend/popup_email_send.php');
        }

        function get_count($profile_name, $url) {
            switch ($profile_name) {
                case 'facebook':
                    $count = $this->get_fb($url);
                    break;

                case 'twitter':
                    $count = $this->get_tweets($url);
                    break;

                case 'google-plus':
                    $count = $this->get_plusones($url);
                    break;

                case 'linkedin':
                    $count = $this->get_linkedin($url);
                    break;

                case 'pinterest':
                    $count = $this->get_pinterest($url);
                    break;

                case 'delicious':
                    $count = $this->get_delicious($url);
                    break;

                case 'stumbleupon':
                    $count = $this->get_stumble($url);
                    break;

                case 'vkontakte':
                    $count = $this->get_vk($url);
                    break;

                case 'reddit':
                    $count = $this->get_reddit($url);
                    break;

                case 'buffer':
                    $count = $this->get_buffer($url);

                default:
                    $count = 0;
                    break;
            }
            return $count;
        }

        function frontend_counter() {
            if (!empty($_GET) && wp_verify_nonce($_GET['_wpnonce'], 'apss-ajax-nonce')) {

                $apss_settings = $this->apss_settings;
                $count_format = $apss_settings['counter_type_options'];
                $new_detail_array = array();
                if (isset($_POST['data'])) {
                    $details = $_POST['data'];
                    foreach ($details as $detail) {
                        $new_detail_array[$detail['network']] = $this->get_formatted_count($this->get_count($detail['network'], $detail['url']), $count_format);
                    }
                } else {
                    $shortcode_data = $_POST['shortcode_data'];
                    foreach ($shortcode_data as $detail) {
                        $detail_array = explode('_', $detail);
                        $url = trim($detail_array[0]);
                        $network = $detail_array[1];
                        $new_detail_array[] = $this->get_formatted_count($this->get_count($network, $url), $count_format);
                    }
                }
                die(json_encode($new_detail_array));
            }
        }

        function buddypress_social_share(){
            if (in_array('buddypress', $this->apss_settings['share_options'])) {
                ob_start();
                include('inc/share/frontend/buddypress-share.php');
                $html_content = ob_get_contents();
                ob_get_clean();
                $icon_set_value = $this->apss_settings['social_icon_set'];

                $counter_enable_options=$this->apss_settings['counter_enable_options'];
                 if ($counter_enable_options == '1') {
                    $counter_class = 'counter-enable';
                } else {
                    $counter_class = '';
                } 
                ?>
                <span class="apss-bp-social-button"><a class="button item-button bp-secondary-action buddypress-social-button" rel="nofollow">Share</a></span>
                <br />
                <div class="apss-social-share-buddypress" style="display:none">
                <?php
                echo "<div class='apss-social-share apss-theme-$icon_set_value $counter_class clearfix' >" . $html_content . "</div>";
                ?>
                </div>
                <?php
            }
                
        }
        function apss_temp(){
            ?>
        <span class="apss-temp" style="font-size:14px;position:relative;z-index:99999;"></span>
            <?php 
        }

    }

    //APSS_Class termination


    $apss_object = new APSS_Class();
}
