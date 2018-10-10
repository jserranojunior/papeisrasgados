<?php 
defined('ABSPATH') or die("No script kiddies please!");

$apsc_settings = $this->apsc_settings;
    //$this->print_array($apsc_settings);
?>
<div class="wrap">
    <div class="apsc-add-set-wrapper clearfix">
        <div class="apsc-panel">
            <div class="apsc-settings-header">
                <div class="apsc-logo">
                    <img src="<?php echo SC_PRO_IMAGE_DIR; ?>/logo.png" alt="<?php esc_attr_e('AccessPress Social Counter Pro',  'ap-social-pro'); ?>" />
                </div>

                <div class="apsc-socials">
                    <p><?php _e('Follow us for new updates', 'ap-social-pro') ?></p>
                    <div class="ap-social-bttns">

                        <iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FAccessPress-Themes%2F1396595907277967&amp;width&amp;layout=button&amp;action=like&amp;show_faces=false&amp;share=false&amp;height=35&amp;appId=1411139805828592" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:20px; width:50px " allowTransparency="true"></iframe>
                        &nbsp;&nbsp;
                        <a href="https://twitter.com/apthemes" class="twitter-follow-button" data-show-count="false" data-lang="en">Follow @apthemes</a>
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

                <div class="apsc-title"><?php _e('AccessPress Social Counter Pro', 'ap-social-pro'); ?></div>
            </div>
            <?php if(isset($_SESSION['apsc_message'])){?><div class="apsc-success-message"><p><?php echo $_SESSION['apsc_message'];unset($_SESSION['apsc_message']);?></p></div><?php }?>
            <div class="apsc-boards-wrapper">
                <ul class="apsc-settings-tabs">
                    <li><a href="javascript:void(0)" id="social-profile-settings" class="apsc-tabs-trigger apsc-active-tab"><?php _e('Social Profiles', 'ap-social-pro') ?></a></li>
                    <li><a href="javascript:void(0)" id="display-settings" class="apsc-tabs-trigger"><?php _e('Display Settings',  'ap-social-pro'); ?></a></li>
                    <li><a href="javascript:void(0)" id="float-sidebar-settings" class="apsc-tabs-trigger"><?php _e('Floating Sidebar Settings', 'ap-social-pro');?></a></li>
                    <li><a href="javascript:void(0)" id="cache-settings" class="apsc-tabs-trigger"><?php _e('Cache Settings',  'ap-social-pro'); ?></a></li>
                    <li><a href="javascript:void(0)" id="how_to_use-settings" class="apsc-tabs-trigger"><?php _e('How to use',  'ap-social-pro'); ?></a></li>
                    <li><a href="javascript:void(0)" id="about-settings" class="apsc-tabs-trigger"><?php _e('About', 'ap-social-pro'); ?></a></li>
                </ul>
                <div class="metabox-holder">
                    <div id="optionsframework" class="postbox" style="float: left;">
                        <form class="apsc-settings-form" method="post" action="<?php echo admin_url() . 'admin-post.php' ?>">
                            <input type="hidden" name="action" value="apsc_settings_action"/>
                            <?php
                                /**
                                 * Social Profiles
                                 * */
                                include_once('boards/social-profiles.php');
                            ?>

                    <?php
                    /**
                     * Display Settings
                     * */
                    include_once('boards/display-settings.php');
                    ?>

                    <?php
                    /**
                     * Floating Sidebar Settings
                     * */
                    include_once('boards/floating-sidebar.php');
                    ?>
                    
                    <?php
                    /**
                     * Cache Settings
                     * */
                    include_once('boards/cache-settings.php');
                    ?>
                    
                    

                    <?php
                    /**
                     * How to use 
                     * */
                    include_once('boards/how-to-use.php');
                    ?>


                    <?php
                    /**
                     * About Tab
                     * */
                    include_once('boards/about.php');
                    ?>
                    <?php
                    /**
                     * Nonce field
                     * */
                    wp_nonce_field('apsc_settings_action', 'apsc_settings_nonce');
                    ?>
                    <div id="optionsframework-submit" class="ap-settings-submit">
                    <input type="submit" class="button button-primary" value="Save all changes" name="ap_settings_submit"/>
                        <?php
                        $nonce = wp_create_nonce('apsc-restore-default-nonce');
                        $cache_nonce = wp_create_nonce('apsc-cache-nonce');
                        ?>
                        <a href="<?php echo admin_url() . 'admin-post.php?action=apsc_restore_default&_wpnonce=' . $nonce; ?>" onclick="return confirm('<?php _e('Are you sure you want to restore default settings?',  'ap-social-pro'); ?>')"><input type="button" value="<?php _e('Restore Default Settings', 'ap-social-pro');?>" class="ap-reset-button button button-primary"/></a>
                        <a href="<?php echo admin_url() . 'admin-post.php?action=apsc_delete_cache&_wpnonce=' . $cache_nonce; ?>" onclick="return confirm('<?php _e('Are you sure you want to delete cache? W P L O C K E R .C O M',  'ap-social-pro'); ?>')"><input type="button" value="<?php _e('Delete Cache', 'ap-social-pro');?>" class="ap-reset-button button button-primary"/></a>
                    </div>
                </form>   
            </div><!--optionsframework-->

        </div>
    </div>
</div>
</div>