<?php 
defined('ABSPATH') or die("No script kiddies please!");
      $apss_share_settings=array();
      $share_options = array('post', 'page');
      $apss_share_settings['share_options']=$share_options;
      $apss_share_settings['social_icon_set']='1';
      $apss_share_settings['share_positions']='below_content';
      $floating_sidebar_options=array(
                                'enabled'=>'0',
                                'theme'=>'1',
                                'position'=>'left',
                                'counter'=>'0',
                                 'counter_type'=>'1',
                                );

      $apss_share_settings['floating_sidebar']=$floating_sidebar_options;
      $social_networks=array('facebook'=>'1',
                            'twitter'=>'1', 
                            'google-plus'=>'1', 
                            'pinterest'=>'1',
                            'linkedin'=>'1',
                            'digg'=>'1',
                            'delicious'=>'0',
                            'reddit'=>'0',
                            'stumbleupon'=>'0',
                            'tumblr'=>'0',
                            'vkontakte'=>'0',
                            'xing'=>'0',
                            'weibo'=>'0',
                            'buffer'=>'0',
                            'email'=>'0',
                            'print'=>'0',
                            );
      $apss_share_settings['social_networks']=$social_networks;

      $pin_it_button_options=array(
                            'enabled'=>'0',
                            'icon_size'=>'28',
                            'icon_shape'=>'round'
                            );

      $apss_share_settings['pin_it_button_options']=$pin_it_button_options;

      $popup_options = array(
                            'enabled'=>'0',
                            'share_text'=>'Share this',
                            );
      $apss_share_settings['popup_options']=$popup_options;
      $apss_share_settings['twitter_username'] = '';
      $apss_share_settings['counter_enable_options']='0';
      $apss_share_settings['counter_type_options']='1';
      $apss_share_settings['cache_period']='24';
      $apss_share_settings['dialog_box_options'] ='1';
      $apss_share_settings['footer_javascript'] = '1';

      $share_texts = array(
                      "common-short-text"=>'Share',
                      "twitter-short-text"=>'Tweet',
                      "email-short-text"=>'Mail',
                      "print-short-text"=>'Print',
                      "common-long-text"=>'Share on',
                      "twitter-long-text"=>'Share on',
                      "email-long-text"=>'Send email',
                      "print-long-text"=>'Print this'
                      );
      $apss_share_settings['share_texts']=$share_texts;
      
      $social_networks_naming = array(
                                'facebook'=>'Facebook',
                                'twitter' => 'Twitter',
                                'google-plus'=>'Google Plus', 
                                'pinterest'=>'Pinterest',
                                'linkedin'=>'Linkedin',
                                'digg'=>'Digg',
                                'delicious'=>'Delicious',
                                'reddit'=>'Reddit',
                                'stumbleupon'=>'Stumbleupon',
                                'tumblr'=>'Tumblr',
                                'vkontakte'=>'Vkontakte',
                                'xing'=>'Xing',
                                'weibo'=>'Weibo',
                                'buffer'=>'Buffer',
                                'email'=>'Email',
                                'print'=>'Print',
                                 );
      $apss_share_settings['apss_social_networks_naming'] = $social_networks_naming;
      $apss_share_settings['apss_email_subject'] = 'Please visit this link %%url%%';
      $apss_share_settings['apss_email_body'] = 'Hey Buddy!, I found this information for you: "%%title%%". Here is the website link: %%permalink%%. Thank you.';
      global $wpdb;
      $transient_tbl_name = $wpdb->prefix.'transients';
      $sql = "CREATE TABLE IF NOT EXISTS $transient_tbl_name 
                                    (
                                    transient_id INT NOT NULL AUTO_INCREMENT, 
                                    PRIMARY KEY(transient_id),
                                    transient_name VARCHAR(255)
                                    )";
        $wpdb->query($sql);

        
      $apss_settings_check = (get_option(APSS_SETTING_NAME)) ? get_option(APSS_SETTING_NAME) : array( 'social_networks'=> array( 'facebook' => '1', 'twitter' => '1' ) );
        
      if(!isset($apss_settings_check['social_networks']['xing'])){
          update_option( APSS_SETTING_NAME, $apss_share_settings);
      }

      if (!get_option(APSS_SETTING_NAME)) {
        update_option( APSS_SETTING_NAME, $apss_share_settings);
      }