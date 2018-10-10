<?php defined('ABSPATH') or die('No script kiddies please!'); ?>
<div class="apss-wrapper-block">
    <div class="apss-setting-header clearfix">
        <div class="apss-headerlogo">
            <img src="<?php echo APSS_IMAGE_DIR; ?>/logo-old.png" alt="<?php esc_attr_e('AccessPress Social Share Pro', APSS_TEXT_DOMAIN); ?>" />
        </div>
        <div class="apss-header-icons">
            <p>Follow us for new updates</p>
            <div class="apss-social-bttns">
                <iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FAccessPress-Themes%2F1396595907277967&amp;width&amp;layout=button&amp;action=like&amp;show_faces=false&amp;share=false&amp;height=35&amp;appId=1411139805828592" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:20px; width:50px " allowtransparency="true"></iframe>
                &nbsp;&nbsp;
                <iframe id="twitter-widget-0" scrolling="no" frameborder="0" allowtransparency="true" src="http://platform.twitter.com/widgets/follow_button.5f46501ecfda1c3e1c05dd3e24875611.en.html#_=1421918256492&amp;dnt=true&amp;id=twitter-widget-0&amp;lang=en&amp;screen_name=apthemes&amp;show_count=false&amp;show_screen_name=true&amp;size=m" class="twitter-follow-button twitter-follow-button" title="Twitter Follow Button" data-twttr-rendered="true" style="width: 126px; height: 20px;"></iframe>
                <script>!function (d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (!d.getElementById(id)) {
                            js = d.createElement(s);
                            js.id = id;
                            js.src = "//platform.twitter.com/widgets.js";
                            fjs.parentNode.insertBefore(js, fjs);
                        }
                    }(document, "script", "twitter-wjs");</script>

            </div>
        </div>
        <div class="apss-header-title">
            <?php _e('AccessPress Social Share Pro', APSS_TEXT_DOMAIN); ?>
        </div>
    </div>
    <?php
    $options = get_option(APSS_SETTING_NAME);
    if (isset($_SESSION['apss_message'])) {
        ?>

        <div class="apss-message">
            <p><?php
                echo $_SESSION['apss_message'];
                unset($_SESSION['apss_message']);
                ?></p>
        </div>
    <?php } ?>

    <div class="apps-wrap">
        <form method="post" action="<?php echo admin_url() . 'admin-post.php' ?>">
            <input type="hidden" name="action" value="apss_save_options" />

            <ul class="apss-setting-tabs clearfix">
                <li><a href="javascript:void(0)" id="apss-social-networks" class="apss-tabs-trigger apss-active-tab	"><?php _e('Social Networks', APSS_TEXT_DOMAIN); ?></a></li>
                <li><a href="javascript:void(0)" id="apss-share-options" class="apss-tabs-trigger "><?php _e('Share Options', APSS_TEXT_DOMAIN) ?></a></li>
                <li><a href="javascript:void(0)" id="apss-display-settings" class="apss-tabs-trigger"><?php _e('Display Settings', APSS_TEXT_DOMAIN); ?></a></li>
                <li><a href="javascript:void(0)" id="apss-floating-sidebar-settings" class="apss-tabs-trigger"><?php _e('Floating Sidebar Settings', APSS_TEXT_DOMAIN); ?></a></li>
                <li><a href="javascript:void(0)" id="apss-miscellaneous" class="apss-tabs-trigger"><?php _e('Miscellaneous', APSS_TEXT_DOMAIN); ?></a></li>
                <li><a href="javascript:void(0)" id="apss-how-to-use" class="apss-tabs-trigger"><?php _e('How To Use', APSS_TEXT_DOMAIN); ?></a></li>
                <li><a href="javascript:void(0)" id="apss-about" class="apss-tabs-trigger"><?php _e('About', APSS_TEXT_DOMAIN); ?></a></li>
            </ul>	
            <div class="apss-wrapper">
                <div class="apss-tab-contents apss-social-networks" id="tab-apss-social-networks" style='display:block'>
                    <h2><?php _e('Social Media chooser:', APSS_TEXT_DOMAIN); ?> </h2>
                    <span class="social-text"><?php _e('Please choose the social media you want to display. Also you can order these social media\'s by drag and drop:', APSS_TEXT_DOMAIN); ?></span>
                    <div class="all_media_chooser">
                        <?php _e('Select all', APSS_TEXT_DOMAIN); ?> <input type='checkbox' name='check_all' class='select_all_media' /> 
                    </div>
                    <div class="apps-opt-wrap clearfix">
                        <?php
                        $label_array = array('facebook' => ' <span class="media-icon"><i class="fa fa-facebook"></i></span> Facebook',
                            'twitter' => ' <span class="media-icon"><i class="fa fa-twitter"></i></span> Twitter',
                            'google-plus' => '<span class="media-icon"><i class="fa fa-google-plus"></i></span> Google Plus',
                            'pinterest' => '<span class="media-icon"> <i class="fa fa-pinterest"></i> </span>Pinterest',
                            'linkedin' => '<span class="media-icon"><i class="fa fa-linkedin"></i></span> Linkedin',
                            'digg' => '<span class="media-icon"><i class="fa fa-digg"></i></span> Digg',
                            'delicious' => '<span class="media-icon"><i class="fa fa-delicious"></i></span> Delicious',
                            'reddit' => ' <span class="media-icon"><i class="fa fa-reddit"></i></span> Reddit',
                            'stumbleupon' => ' <span class="media-icon"><i class="fa fa-stumbleupon"></i></span> StumbleUpon',
                            'tumblr' => '<span class="media-icon"><i class="fa fa-tumblr"></i> </span>Tumblr',
                            'vkontakte' => '<span class="media-icon"><i class="fa fa-vk"></i> </span>VKontakte',
                            'xing' => '<span class="media-icon"><i class="fa fa-xing"></i> </span>Xing',
                            'weibo' => '<span class="media-icon"><i class="fa fa-weibo"></i> </span>Weibo',
                            'buffer' => '<span class="media-icon"><i class="fa fa-buffer"></i> </span>Buffer',
                            'email' => '<span class="media-icon"><i class="fa  fa-envelope"></i></span> Email',
                            'print' => '<span class="media-icon"><i class="fa fa-print"></i> </span>Print',
                        );
                        ?>
                        <?php foreach ($options['social_networks'] as $key => $val) {
                            ?>
                            <div class="apss-option-wrapper">
                                <div class="apss-option-field">
                                    <label class="clearfix"><span class="left-icon"><i class="fa fa-arrows"></i></span><span class="social-name"><?php echo $label_array[$key]; ?></span><input type="checkbox" class='social_networks_class' data-key='<?php echo $key; ?>' name="social_networks[<?php echo $key; ?>]" value="1" <?php
                                        if ($val == '1') {
                                            echo "checked='checked'";
                                        }
                                        ?> /></label>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <input type="hidden" name="apss_social_newtwork_order" id='apss_social_newtwork_order' value="<?php echo implode(',', array_keys($options['social_networks'])); ?>"/>
                </div>

                <div class="apss-tab-contents apss-share-options" id="tab-apss-share-options" style='display:none'>
                    <h2><?php _e('Share options:', APSS_TEXT_DOMAIN); ?> </h2>
                    <span class="social-text"><?php _e('Please choose the options where you want to display social share:', APSS_TEXT_DOMAIN); ?></span>
                    <p><input type="checkbox" id="apss_posts" value="post" name="apss_share_settings[share_options][]" <?php
                        if (in_array("post", $options['share_options'])) {
                            echo "checked='checked'";
                        }
                        ?> ><label for="apss_posts"><?php _e('Posts', APSS_TEXT_DOMAIN); ?> </label></p>
                    <p><input type="checkbox" id="apss_pages" value="page" name="apss_share_settings[share_options][]" <?php
                        if (in_array("page", $options['share_options'])) {
                            echo "checked='checked'";
                        }
                        ?> ><label for="apss_pages"><?php _e('Pages', APSS_TEXT_DOMAIN); ?> </label></p>

                    <p><input type="checkbox" id="apss_front_page" value="front_page" name="apss_share_settings[share_options][]" <?php
                        if (in_array("front_page", $options['share_options'])) {
                            echo "checked='checked'";
                        }
                        ?> ><label for="apss_front_page"><?php _e('Front Page', APSS_TEXT_DOMAIN); ?></label></p>		
                    <p><input type="checkbox" id="apss_archives" value="archives" name="apss_share_settings[share_options][]" <?php
                        if (in_array("archives", $options['share_options'])) {
                            echo "checked='checked'";
                        }
                        ?> ><label for="apss_archives"><?php _e('Archives', APSS_TEXT_DOMAIN); ?></label></p>

                    <p><input type="checkbox" id="apss_categories" value="categories" name="apss_share_settings[share_options][]" <?php
                        if (in_array("categories", $options['share_options'])) {
                            echo "checked='checked'";
                        }
                        ?> ><label for="apss_categories"><?php _e('Categories', APSS_TEXT_DOMAIN); ?></label></p>
                    <p><input type="checkbox" id="apss_all" value="all" name="apss_share_settings[share_options][]" <?php
                        if (in_array("all", $options['share_options'])) {
                            echo "checked='checked'";
                        }
                        ?> ><label for="apss_all"><?php _e('Other (search results, etc)', APSS_TEXT_DOMAIN); ?></label></p>

                    <?php $post_types = self::get_registered_post_types(); ?>
                    <?php if (!empty($post_types)) { ?>
                        <label><?php _e('Available Custom Post types:', APSS_TEXT_DOMAIN); ?></label>
                        <?php foreach ($post_types as $key => $value) { ?>
                            <?php
                            $objects = get_post_type_object($value);
                            ?>
                            <p><input type="checkbox" id="apss_<?php echo $key; ?>" value="<?php echo $value; ?>" name="apss_share_settings[share_options][]" <?php
                                if (in_array($key, $options['share_options'])) {
                                    echo "checked='checked'";
                                }
                                ?> ><label for="apss_<?php echo $key; ?>"><?php _e($objects->labels->name, APSS_TEXT_DOMAIN); ?></label></p>
                            <?php } ?>
                        <?php } ?>

                    <?php $taxonomies = self::get_registered_taxonomies(); ?>

                    <?php if (!empty($taxonomies)) { ?>
                        <label><?php _e('Available Taxonomies:', APSS_TEXT_DOMAIN); ?></label>
                        <?php foreach ($taxonomies as $key => $value) { ?>		
                            <?php $required_tax_objects = $value->labels; ?>
                            <?php $name = $required_tax_objects->name; ?>

                            <p><input type="checkbox" id="apss_<?php echo $value->name; ?>" value="<?php echo $value->name; ?>" name="apss_share_settings[share_options][]" <?php
                                if (in_array($value->name, $options['share_options'])) {
                                    echo "checked='checked'";
                                }
                                ?> ><label for="apss_<?php echo $value->name; ?>"><?php _e($name, APSS_TEXT_DOMAIN); ?></label></p>
                            <?php } ?>
                        <?php } ?>

                    <h2><?php _e('Buddypress Settings: ', APSS_TEXT_DOMAIN ); ?></h2>
                    <p><label><?php _e('Show the social share in buddypress activity and group pages? ', APSS_TEXT_DOMAIN ); ?></label>
                    <input type="checkbox" id="apss_buddypress" value="buddypress" name="apss_share_settings[share_options][]" <?php if (in_array('buddypress', $options['share_options'])) { echo "checked='checked'"; } ?> >
                    </p>

                    <h2 class='apss-pinterest-options'><?php _e('Pinterest Pin It Button Settings:', APSS_TEXT_DOMAIN); ?> </h2>
                    <span class="social-text"><?php _e('Please setup the options for pinterest hover images:', APSS_TEXT_DOMAIN); ?></span>
                    <div class='apss-info'><?php _e("You can disable the pinit hover button by adding the image attributes as data-pin-no-hover='true' or nopin='nopin'", APSS_TEXT_DOMAIN ); ?></div>
                    <p><label for="enable"><?php _e('Enable the Pin It hover button over images? ', APSS_TEXT_DOMAIN); ?> </label><input type="radio" id="pinit-enable_no" name="pinit_options[enabled]" value='0' <?php
                        if ($options['pin_it_button_options']['enabled'] == '0') {
                            echo "checked='checked'";
                        }
                        ?> ><label for='pinit-enable_no'>No</label> <input type="radio" id="pinit-enable_yes" name="pinit_options[enabled]" value='1' <?php
                         if ($options['pin_it_button_options']['enabled'] == '1') {
                             echo "checked='checked'";
                         }
                         ?>><label for='pinit-enable_yes'>Yes</label></p>
                    <p>
                        <label><?php _e('Pin it hover Size:', APSS_TEXT_DOMAIN); ?></label>
                        <select name="pinit_options[icon_size]">
                            <option value='28' <?php
                            if ($options['pin_it_button_options']['icon_size'] == '28') {
                                echo "selected='selected'";
                            }
                            ?>>Small</option>
                            <option value='32' <?php
                            if ($options['pin_it_button_options']['icon_size'] == '32') {
                                echo "selected='selected'";
                            }
                            ?>>Large</option>
                        </select>
                    </p>
                    <p>
                        <label><?php _e('Pin it hover Shape:', APSS_TEXT_DOMAIN); ?></label>
                        <select name="pinit_options[icon_shape]">
                            <option value="round" <?php
                            if ($options['pin_it_button_options']['icon_shape'] == 'round') {
                                echo "selected='selected'";
                            }
                            ?>>Circular</option>
                            <option value="rectangle" <?php
                            if ($options['pin_it_button_options']['icon_shape'] == 'rectangle') {
                                echo "selected='selected'";
                            }
                            ?>>Rectangular</option>
                        </select>
                    </p>
                </div>

                <div class="apss-tab-contents apss-display-settings" id="tab-apss-display-settings" style='display:none'>
                    <div class=' apss-display-positions'>
                        <h2><?php _e('Display positions:', APSS_TEXT_DOMAIN); ?></h2>
                        <span class='social-text'><?php _e('Please choose the option where you want to display the social share:', APSS_TEXT_DOMAIN); ?></span>
                        <p><input type="radio" id="apss_below_content" name="apss_share_settings[social_share_position_options]" value="below_content" <?php
                            if ($options['share_positions'] == 'below_content') {
                                echo "checked='checked'";
                            }
                            ?> /><label for='apss_below_content'><?php _e('Below content', APSS_TEXT_DOMAIN); ?></label></p>
                        <p><input type="radio" id="apss_above_content" name="apss_share_settings[social_share_position_options]"/ value="above_content" <?php
                            if ($options['share_positions'] == 'above_content') {
                                echo "checked='checked'";
                            }
                            ?> /><label for='apss_above_content'><?php _e('Above content', APSS_TEXT_DOMAIN); ?></label></p>
                        <p><input type="radio" id="apss_below_above_content" name="apss_share_settings[social_share_position_options]" value="on_both" <?php
                            if ($options['share_positions'] == 'on_both') {
                                echo "checked='checked'";
                            }
                            ?> /><label for='apss_below_above_content'><?php _e('Both(Below content and Above content)', APSS_TEXT_DOMAIN); ?></label></p>
                    </div>
                    <br />
                    <br />
                    <div class="apss-icon-sets">
                        <h2><?php _e('Social icons sets', APSS_TEXT_DOMAIN); ?> </h2>
                        <?php _e('Please choose any one out of available icon themes:', APSS_TEXT_DOMAIN); ?>
                        <p><input id="apss_icon_set_1" value="1" name="apss_share_settings[social_icon_set]" type="radio" <?php
                            if ($options['social_icon_set'] == '1') {
                                echo "checked='checked'";
                            }
                            ?> ><label for="apss_icon_set_1"><span class="apss_demo_icon apss_demo_icons_1"></span><?php _e('Theme 1', APSS_TEXT_DOMAIN); ?><div class="apss-theme-image"><img src="<?php echo APSS_IMAGE_DIR . '/theme/theme1.png'; ?>"/></div></label></p>
                        <p><input id="apss_icon_set_2" value="2" name="apss_share_settings[social_icon_set]" type="radio" <?php
                            if ($options['social_icon_set'] == '2') {
                                echo "checked='checked'";
                            }
                            ?> ><label for="apss_icon_set_2"><span class="apss_demo_icon apss_demo_icons_2"></span><?php _e('Theme 2', APSS_TEXT_DOMAIN); ?><div class="apss-theme-image"><img src="<?php echo APSS_IMAGE_DIR . '/theme/theme2.png'; ?>"/></div></label></p>
                        <p><input id="apss_icon_set_3" value="3" name="apss_share_settings[social_icon_set]" type="radio" <?php
                            if ($options['social_icon_set'] == '3') {
                                echo "checked='checked'";
                            }
                            ?> ><label for="apss_icon_set_3"><span class="apss_demo_icon apss_demo_icons_3"></span><?php _e('Theme 3', APSS_TEXT_DOMAIN); ?><div class="apss-theme-image"><img src="<?php echo APSS_IMAGE_DIR . '/theme/theme3.png'; ?>"/></div></label></p>
                        <p><input id="apss_icon_set_4" value="4" name="apss_share_settings[social_icon_set]" type="radio" <?php
                            if ($options['social_icon_set'] == '4') {
                                echo "checked='checked'";
                            }
                            ?> ><label for="apss_icon_set_4"><span class="apss_demo_icon apss_demo_icons_4"></span><?php _e('Theme 4', APSS_TEXT_DOMAIN); ?><div class="apss-theme-image"><img src="<?php echo APSS_IMAGE_DIR . '/theme/theme4.png'; ?>"/></div></label></p>
                        <p><input id="apss_icon_set_5" value="5" name="apss_share_settings[social_icon_set]" type="radio" <?php
                            if ($options['social_icon_set'] == '5') {
                                echo "checked='checked'";
                            }
                            ?> ><label for="apss_icon_set_5"><span class="apss_demo_icon apss_demo_icons_5"></span><?php _e('Theme 5', APSS_TEXT_DOMAIN); ?><div class="apss-theme-image"><img src="<?php echo APSS_IMAGE_DIR . '/theme/theme5.png'; ?>"/></div></label></p>
                        <p><input id="apss_icon_set_6" value="6" name="apss_share_settings[social_icon_set]" type="radio" <?php
                            if ($options['social_icon_set'] == '6') {
                                echo "checked='checked'";
                            }
                            ?> ><label for="apss_icon_set_6"><span class="apss_demo_icon apss_demo_icons_6"></span><?php _e('Theme 6', APSS_TEXT_DOMAIN); ?><div class="apss-theme-image"><img src="<?php echo APSS_IMAGE_DIR . '/theme/theme6.png'; ?>"/></div></label></p>
                        <p><input id="apss_icon_set_7" value="7" name="apss_share_settings[social_icon_set]" type="radio" <?php
                            if ($options['social_icon_set'] == '7') {
                                echo "checked='checked'";
                            }
                            ?> ><label for="apss_icon_set_7"><span class="apss_demo_icon apss_demo_icons_7"></span><?php _e('Theme 7', APSS_TEXT_DOMAIN); ?><div class="apss-theme-image"><img src="<?php echo APSS_IMAGE_DIR . '/theme/theme7.png'; ?>"/></div></label></p>
                        <p><input id="apss_icon_set_8" value="8" name="apss_share_settings[social_icon_set]" type="radio" <?php
                            if ($options['social_icon_set'] == '8') {
                                echo "checked='checked'";
                            }
                            ?> ><label for="apss_icon_set_8"><span class="apss_demo_icon apss_demo_icons_8"></span><?php _e('Theme 8', APSS_TEXT_DOMAIN); ?><div class="apss-theme-image"><img src="<?php echo APSS_IMAGE_DIR . '/theme/theme8.png'; ?>"/></div></label></p>
                        <p><input id="apss_icon_set_9" value="9" name="apss_share_settings[social_icon_set]" type="radio" <?php
                            if ($options['social_icon_set'] == '9') {
                                echo "checked='checked'";
                            }
                            ?> ><label for="apss_icon_set_9"><span class="apss_demo_icon apss_demo_icons_9"></span><?php _e('Theme 9', APSS_TEXT_DOMAIN); ?><div class="apss-theme-image"><img src="<?php echo APSS_IMAGE_DIR . '/theme/theme9.png'; ?>"/></div></label></p>
                        <p><input id="apss_icon_set_10" value="10" name="apss_share_settings[social_icon_set]" type="radio" <?php
                            if ($options['social_icon_set'] == '10') {
                                echo "checked='checked'";
                            }
                            ?> ><label for="apss_icon_set_10"><span class="apss_demo_icon apss_demo_icons_10"></span><?php _e('Theme 10', APSS_TEXT_DOMAIN); ?><div class="apss-theme-image"><img src="<?php echo APSS_IMAGE_DIR . '/theme/theme10.png'; ?>"/></div></label></p>
                    </div>

                    <div class='apss-popup-settings'>
                        <h2><?php _e('Popup Settings', APSS_TEXT_DOMAIN); ?> </h2>
                        <span class='hinter'><?php _e('Please enable these options for the popup of the soical share options.', APSS_TEXT_DOMAIN); ?></span>
                        <h4 class='apss-popup'><?php _e('Enable popup on window load?', APSS_TEXT_DOMAIN); ?></h4>
                        <div class="misc-opt"><input type="radio" id='apss_popup_enable_no'  class='popup_enable_disable' name="apss_share_settings[popup_options][enabled]" value="0" <?php
                            if ($options['popup_options']['enabled'] == '0') {
                                echo "checked='checked'";
                            }
                            ?> /><label for="apss_popup_enable_no"><?php _e('No', APSS_TEXT_DOMAIN); ?></label></div>
                        <div class="misc-opt"><input type="radio" id='apss_popup_enable_yes' class='popup_enable_disable' name="apss_share_settings[popup_options][enabled]" value="1" <?php
                            if ($options['popup_options']['enabled'] == '1') {
                                echo "checked='checked'";
                            }
                            ?> /><label for="apss_popup_enable_yes"><?php _e('Yes', APSS_TEXT_DOMAIN); ?></label></div>
                        <br />
                        <h4 class='apss-popup'><?php _e('Share text', APSS_TEXT_DOMAIN); ?></h4>
                        <input type="text" name="apss_share_settings[popup_options][share_text]"  value="<?php
                        if (isset($options['popup_options']['share_text'])) {
                            echo $options['popup_options']['share_text'];
                        }
                        ?>" />
                        
                    </div>
                    <br />
                </div>

                <div class="apss-tab-contents apss-floating-sidebar-settings" id='tab-apss-floating-sidebar-settings' style="display:none;">
                    <div class='apss-floating-options'>
                        <h2><?php _e('Floating options:', APSS_TEXT_DOMAIN); ?></h2>
                        <span class='social-text'><?php _e('Options for display of the floating options:', APSS_TEXT_DOMAIN); ?></span>
                        <h4><?php _e('Floating Social share enable?', APSS_TEXT_DOMAIN); ?> </h4>
                        <div class="misc-opt"><input type="radio" id='apss_floating_enable_no'  class='floating_positions_enable_disable' name="apss_share_settings[floating_sidebar][enabled]" value="0" <?php
                            if ($options['floating_sidebar']['enabled'] == '0') {
                                echo "checked='checked'";
                            }
                            ?> /><label for="apss_floating_enable_no"><?php _e('No', APSS_TEXT_DOMAIN); ?></label></div>
                        <div class="misc-opt"><input type="radio" id='apss_floating_enable_yes' class='floating_positions_enable_disable' name="apss_share_settings[floating_sidebar][enabled]" value="1" <?php
                            if ($options['floating_sidebar']['enabled'] == '1') {
                                echo "checked='checked'";
                            }
                            ?> /><label for="apss_floating_enable_yes"><?php _e('Yes', APSS_TEXT_DOMAIN); ?></label></div>
                        <br />

                        <div class="apss_floating_sidebar_options" <?php
                        if ($options['floating_sidebar']['enabled'] == '1') {
                            echo "style='display:block'";
                        } else {
                            echo "style='display:none'";
                        }
                        ?>>

                            <div class='apss_floating_themes'>
                                <h4><?php _e('Social Icons sets?', APSS_TEXT_DOMAIN); ?> </h4>
                                <p><input id="apss_floating_theme_1" value="1" name="apss_share_settings[floating_sidebar][theme]" type="radio" <?php
                                    if ($options['floating_sidebar']['theme'] == '1') {
                                        echo "checked='checked'";
                                    }
                                    ?> ><label for="apss_floating_theme_1"><span class="apss_demo_icon apss_demo_icons_1"></span><?php _e('Theme 1', APSS_TEXT_DOMAIN); ?><div class="apss-theme-image"><img src="<?php echo APSS_IMAGE_DIR . '/theme/floating-theme1.png'; ?>"/></div></label></p>
                                <p><input id="apss_floating_theme_2" value="2" name="apss_share_settings[floating_sidebar][theme]" type="radio" <?php
                                    if ($options['floating_sidebar']['theme'] == '2') {
                                        echo "checked='checked'";
                                    }
                                    ?> ><label for="apss_floating_theme_2"><span class="apss_demo_icon apss_demo_icons_2"></span><?php _e('Theme 2', APSS_TEXT_DOMAIN); ?><div class="apss-theme-image"><img src="<?php echo APSS_IMAGE_DIR . '/theme/floating-theme2.png'; ?>"/></div></label></p>
                                <p><input id="apss_floating_theme_3" value="3" name="apss_share_settings[floating_sidebar][theme]" type="radio" <?php
                                    if ($options['floating_sidebar']['theme'] == '3') {
                                        echo "checked='checked'";
                                    }
                                    ?> ><label for="apss_floating_theme_3"><span class="apss_demo_icon apss_demo_icons_3"></span><?php _e('Theme 3', APSS_TEXT_DOMAIN); ?><div class="apss-theme-image"><img src="<?php echo APSS_IMAGE_DIR . '/theme/floating-theme3.png'; ?>"/></div></label></p>
                                <p><input id="apss_floating_theme_4" value="4" name="apss_share_settings[floating_sidebar][theme]" type="radio" <?php
                                    if ($options['floating_sidebar']['theme'] == '4') {
                                        echo "checked='checked'";
                                    }
                                    ?> ><label for="apss_floating_theme_4"><span class="apss_demo_icon apss_demo_icons_4"></span><?php _e('Theme 4', APSS_TEXT_DOMAIN); ?><div class="apss-theme-image"><img src="<?php echo APSS_IMAGE_DIR . '/theme/floating-theme4.png'; ?>"/></div></label></p>
                            </div>
                            <div class='apss_floating_position'>
                                <h4><?php _e('Floating positions:', APSS_TEXT_DOMAIN); ?> </h4>
                                <div class="misc-opt"><input type="radio" id='apss_floating_position_1' name="apss_share_settings[floating_sidebar][position]" value="left" <?php
                                    if ($options['floating_sidebar']['position'] == 'left') {
                                        echo "checked='checked'";
                                    }
                                    ?> /><label for="apss_floating_position_1"><?php _e('Left Middle(Vertical)', APSS_TEXT_DOMAIN); ?></label></div>
                                <div class="misc-opt"><input type="radio" id='apss_floating_position_2' name="apss_share_settings[floating_sidebar][position]" value="right" <?php
                                    if ($options['floating_sidebar']['position'] == 'right') {
                                        echo "checked='checked'";
                                    }
                                    ?> /><label for="apss_floating_position_2"><?php _e('Right Middle(Vertical)', APSS_TEXT_DOMAIN); ?></label></div>
                                <div class="misc-opt"><input type="radio" id='apss_floating_position_3' name="apss_share_settings[floating_sidebar][position]" value="bottom_left" <?php
                                    if ($options['floating_sidebar']['position'] == 'bottom_left') {
                                        echo "checked='checked'";
                                    }
                                    ?> /><label for="apss_floating_position_3"><?php _e('Bottom left(Horizontal)', APSS_TEXT_DOMAIN); ?></label></div>
                                <div class="misc-opt"><input type="radio" id='apss_floating_position_4' name="apss_share_settings[floating_sidebar][position]" value="bottom_right" <?php
                                    if ($options['floating_sidebar']['position'] == 'bottom_right') {
                                        echo "checked='checked'";
                                    }
                                    ?> /><label for="apss_floating_position_4"><?php _e('Bottom right(Horizontal)', APSS_TEXT_DOMAIN); ?></label></div>
                            </div>
                            <br />

                            <div class='apss_floating_count'>
                                <h4><?php _e('Floating Social count enable?', APSS_TEXT_DOMAIN); ?> </h4>
                                <div class="misc-opt"><input type="radio" class='floating_count_enabler' id='apss_floating_count_enable_no'  class='floating_count_enable_options' name="apss_share_settings[floating_sidebar][counter]" value="0" <?php
                                    if ($options['floating_sidebar']['counter'] == '0') {
                                        echo "checked='checked'";
                                    }
                                    ?> /><label for="apss_floating_count_enable_no"><?php _e('No', APSS_TEXT_DOMAIN); ?></label></div>
                                <div class="misc-opt"><input type="radio" class='floating_count_enabler' id='apss_floating_count_enable_yes' class='floating_count_enable_options' name="apss_share_settings[floating_sidebar][counter]" value="1" <?php
                                    if ($options['floating_sidebar']['counter'] == '1') {
                                        echo "checked='checked'";
                                    }
                                    ?> /><label for="apss_floating_count_enable_yes"><?php _e('Yes', APSS_TEXT_DOMAIN); ?></label></div>
                            </div>
                            <br />

                        </div>
                    </div>

                </div>

                <div class="apss-tab-contents apss-miscellaneous" id="tab-apss-miscellaneous" style='display:none'>
                    <h2><?php _e('Miscellaneous settings: ', APSS_TEXT_DOMAIN); ?> </h2>
                    <h4><?php _e('Please setup these additional settings:', APSS_TEXT_DOMAIN); ?></h4>
                    <div class="apss-twitter-settings">
                        <?php _e('Twitter username:', APSS_TEXT_DOMAIN); ?> <input type="text" name="apss_share_settings[twitter_username]"  value="<?php echo $options['twitter_username']; ?>" />
                    </div>

                    <div class="apss-counter-settings clearfix">
                        <h4><?php _e('Social share counter enable?', APSS_TEXT_DOMAIN); ?> </h4>
                        <div class="misc-opt"><input type="radio" id='counter_enable_options_no' name="apss_share_settings[counter_enable_options]" value="0" <?php
                            if ($options['counter_enable_options'] == '0') {
                                echo "checked='checked'";
                            }
                            ?> /><label for="counter_enable_options_no"><?php _e('No', APSS_TEXT_DOMAIN); ?></label></div>
                        <div class="misc-opt"><input type="radio" id='counter_enable_options_yes' name="apss_share_settings[counter_enable_options]" value="1" <?php
                            if ($options['counter_enable_options'] == '1') {
                                echo "checked='checked'";
                            }
                            ?> /><label for="counter_enable_options_yes"><?php _e('Yes', APSS_TEXT_DOMAIN); ?></label></div>

                        <br />
                        <h4><?php _e('Counter Display Formats:', APSS_TEXT_DOMAIN); ?> </h4>
                        <div class="misc-opt"><input id='counter_number_options_1' type="radio" name="apss_share_settings[counter_type_options]" value="1" <?php
                            if ($options['counter_type_options'] == '1') {
                                echo "checked='checked'";
                            }
                            ?> /><label for="counter_number_options_1"><?php _e('numbers only(1200)', APSS_TEXT_DOMAIN); ?></label></div>
                        <div class="misc-opt"><input id='counter_number_options_2' type="radio" name="apss_share_settings[counter_type_options]" value="2" <?php
                            if ($options['counter_type_options'] == '2') {
                                echo "checked='checked'";
                            }
                            ?> /><label for="counter_number_options_2"><?php _e('1,200', APSS_TEXT_DOMAIN); ?></label></div>
                        <div class="misc-opt"><input id='counter_number_options_3' type="radio" name="apss_share_settings[counter_type_options]" value="3" <?php
                            if ($options['counter_type_options'] == '3') {
                                echo "checked='checked'";
                            }
                            ?> /><label for="counter_number_options_3"><?php _e('1K', APSS_TEXT_DOMAIN); ?></label></div>
                    </div>

                    <div class="apss-dialog-boxs clearfix">
                        <h4><?php _e('Social share link options:', APSS_TEXT_DOMAIN); ?> </h4>
                        <div class="misc-opt"><input type="radio" id='dialog_box_options_blank' name="apss_share_settings[dialog_box_options]" value="0" <?php
                            if ($options['dialog_box_options'] == '0') {
                                echo "checked='checked'";
                            }
                            ?> /><label for="dialog_box_options_blank"><?php _e('Open in same window', APSS_TEXT_DOMAIN); ?></label></div>
                        <div class="misc-opt"><input type="radio" id='dialog_box_options_new' name="apss_share_settings[dialog_box_options]" value="1" <?php
                            if ($options['dialog_box_options'] == '1') {
                                echo "checked='checked'";
                            }
                            ?> /><label for="dialog_box_options_new"><?php _e('Open in new window/Tab', APSS_TEXT_DOMAIN); ?></label></div>
                    </div>

                    <div class="apss-dialog-boxs clearfix">
                        <h4> <?php _e('Social share text options:', APSS_TEXT_DOMAIN); ?> </h4>
                            <h5 class="apss-long-short-title" for='apss-share-short-text'><?php _e('Short texts:', APSS_TEXT_DOMAIN); ?></h5>
                                <label class="apss-long-short-text" for='apss-share-common-short-text'><?php _e('Common short share text: ', APSS_TEXT_DOMAIN); ?></label>
                                <input class="long-short-input" id='apss-share-common-short-text' type='text' name="apss_share_settings[share_texts][common-short-text]" value="<?php if(isset($options['share_texts']['common-short-text'])){ echo $options['share_texts']['common-short-text']; } ?>" />
                                <br />
                                <label class="apss-long-short-text" for='apss-share-twitter-short-text'><?php _e('Twitter short share text: ', APSS_TEXT_DOMAIN); ?></label>
                                <input class="long-short-input" id= 'apss-share-twitter-short-text' type='text' name="apss_share_settings[share_texts][twitter-short-text]" value="<?php if(isset($options['share_texts']['twitter-short-text'])){ echo $options['share_texts']['twitter-short-text']; } ?>" />
                                <br />
                                <label class="apss-long-short-text" for='apss-share-email-short-text'><?php _e('Email short share text: ', APSS_TEXT_DOMAIN); ?></label>
                                <input class="long-short-input" id= 'apss-share-email-short-text' type='text' name="apss_share_settings[share_texts][email-short-text]" value="<?php if(isset($options['share_texts']['email-short-text'])){ echo $options['share_texts']['email-short-text']; } ?>" />
                                <br />
                                <label class="apss-long-short-text" for='apss-share-print-short-text'><?php _e('Print short share text: ', APSS_TEXT_DOMAIN); ?></label>
                                <input class="long-short-input" id= 'apss-share-print-short-text' type='text' name="apss_share_settings[share_texts][print-short-text]" value="<?php if(isset($options['share_texts']['print-short-text'])){ echo $options['share_texts']['print-short-text']; } ?>" />
                                <br />
                                <div class="apss_notes_cache_settings"><?php _e('You can set the custom short share texts here. If you keep blank the default values will be loaded.', APSS_TEXT_DOMAIN ); ?></div>
                            <h5 class="apss-long-short-title" for='apss-share-short-text'><?php _e('Long texts:', APSS_TEXT_DOMAIN); ?></h5>
                                <label class="apss-long-short-text" for='apss-share-common-long-text'><?php _e('Common long share text: ', APSS_TEXT_DOMAIN); ?></label>
                                <input class="long-short-input" id= 'apss-share-common-long-text' type='text' name="apss_share_settings[share_texts][common-long-text]" value="<?php if(isset($options['share_texts']['common-long-text'])){ echo $options['share_texts']['common-long-text']; } ?>" />
                                <br />
                                <label class="apss-long-short-text" for='apss-share-twitter-long-text'><?php _e('Twitter long share text: ', APSS_TEXT_DOMAIN); ?></label>
                                <input class="long-short-input" id= 'apss-share-twitter-long-text' type='text' name="apss_share_settings[share_texts][twitter-long-text]" value="<?php if(isset($options['share_texts']['twitter-long-text'])){ echo $options['share_texts']['twitter-long-text']; } ?>" />
                                <br />
                                <label class="apss-long-short-text" for='apss-share-email-long-text'><?php _e('Email long share text: ', APSS_TEXT_DOMAIN); ?></label>
                                <input class="long-short-input" id= 'apss-share-email-long-text' type='text' name="apss_share_settings[share_texts][email-long-text]" value="<?php if(isset($options['share_texts']['email-long-text'])){ echo $options['share_texts']['email-long-text']; } ?>" />
                                <br />
                                <label class="apss-long-short-text" for='apss-share-print-long-text'><?php _e('Print long share text: ', APSS_TEXT_DOMAIN); ?></label>
                                <input class="long-short-input" id= 'apss-share-print-long-text' type='text' name="apss_share_settings[share_texts][print-long-text]" value="<?php if(isset($options['share_texts']['print-long-text'])){ echo $options['share_texts']['print-long-text']; } ?>" />
                                <br />
                                <div class="apss_notes_cache_settings"> <?php _e('You can set the custom long share texts here. If you keep blank the default values will be loaded.', APSS_TEXT_DOMAIN ); ?></div>
                            
                    </div>

                    <div class="apss-dialog-boxs clearfix">
                        <h4> <?php _e('Social Networks Custom Names:', APSS_TEXT_DOMAIN); ?> </h4>
                        <?php foreach ($label_array as $key => $val) { ?>
                                <label class="apss-long-short-text apss-social-network-naming" for='apss-share-social-network-naming-<?php echo $key; ?>'><?php _e(ucfirst($key), APSS_TEXT_DOMAIN); ?>: </label>
                                <input class="apss-social-network-naming-input" id='apss-share-social-network-naming-<?php echo $key; ?>' type='text' name="apss_share_settings[apss_social_networks_naming][<?php echo $key; ?>]" value="<?php if(isset($options['apss_social_networks_naming'][$key])){ echo $options['apss_social_networks_naming'][$key]; } ?>" />
                                <br />
                        <?php } ?>
                                <div class="apss_notes_cache_settings"><?php _e('You can set the custom short share texts here. If you keep blank the default values will be loaded.', APSS_TEXT_DOMAIN ); ?></div>
                    </div>

                    <div class='cache-settings'>
                        <h4><?php _e('Cache Settings', APSS_TEXT_DOMAIN); ?> </h4>
                        <label for="apss_cache_settings"><?php _e('Cache Period:', APSS_TEXT_DOMAIN); ?></label>
                        <input type='text' id="apss_cache_period" name='apss_share_settings[cache_settings]' value="<?php
                        if (isset($options['cache_period'])) {
                            echo $options['cache_period'];
                        }
                        ?>" onkeyup="removeMe('invalid_cache_period');"/>
                        <span class="error invalid_cache_period"></span>
                        <div class="apss_notes_cache_settings">
                            <?php _e('Please enter the time in hours in which the social share should be updated. Default is 24 hours', APSS_TEXT_DOMAIN); ?>
                        </div>
                    </div>

                    <div class="apss-email-settings">
                        <h4><?php _e('Email Settings:', APSS_TEXT_DOMAIN); ?></h4>
                        <div class="app-email-sub email-setg">
                            <label for='apss-email-subject'><?php _e('Email subject:', APSS_TEXT_DOMAIN); ?></label>
                            <input type='text' name="apss_share_settings[apss_email_subject]" value="<?php echo $options['apss_email_subject'] ?>" />
                        </div>
                        <div class="app-email-body email-setg">
                            <label for='apss-email-body'><?php _e('Email body:', APSS_TEXT_DOMAIN); ?></label> 
                            <textarea rows='30' cols='30' name="apss_share_settings[apss_email_body]"><?php echo $options['apss_email_body'] ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="apss-tab-contents apss-how-to-use" id="tab-apss-how-to-use" style='display:none' >
                    <?php include_once('how-to-use.php'); ?>
                </div>

                <div class="apss-tab-contents apss-about" id="tab-apss-about" style='display:none' >
                    <?php include('about-apss.php'); ?>

                </div>
                <div class="save-seting">
                <?php wp_nonce_field('apss_nonce_save_settings', 'apss_add_nonce_save_settings'); ?>
                <input type="submit" class="submit_settings button primary-button" value="<?php _e('Save settings', APSS_TEXT_DOMAIN); ?>" name="apss_submit_settings" id="apss_submit_settings"/>
                <?php
                /**
                 * Nonce field
                 * */
                wp_nonce_field('apss_settings_action', 'apss_settings_action');
                ?>
                <?php $nonce = wp_create_nonce('apss-restore-default-settings-nonce'); ?>
                <?php $nonce_clear = wp_create_nonce('apss-clear-cache-nonce'); ?>
                <a href="<?php echo admin_url() . 'admin-post.php?action=apss_restore_default_settings&_wpnonce=' . $nonce; ?>" onclick="return confirm('<?php _e('Are you sure you want to restore default settings?', APSS_TEXT_DOMAIN); ?>')"><input type="button" value="Restore Default Settings" class="apss-reset-button button primary-button"/></a>
                <a href="<?php echo admin_url() . 'admin-post.php?action=apss_clear_cache&_wpnonce=' . $nonce_clear; ?>" onclick="return confirm('<?php _e('Are you sure you want to clear cache share counter?', APSS_TEXT_DOMAIN); ?>')"><input type="button" value="Clear Cache" class="apss-reset-button button primary-button"/></a>
                </div>
            </div>
        </form>
    </div>
</div>