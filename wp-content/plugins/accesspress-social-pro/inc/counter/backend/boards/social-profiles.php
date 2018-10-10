<div class="apsc-boards-tabs" id="apsc-board-social-profile-settings">
    <div class="apsc-tab-wrapper">
        <!---Facebook-->
        <div class="apsc-option-outer-wrapper">
            <h4><?php _e('Facebook', 'ap-social-pro') ?></h4>
            <div class="apsc-option-inner-wrapper">
                <label><?php _e('Display Counter', 'ap-social-pro') ?></label>
                <div class="apsc-option-field"><label><input type="checkbox" name="social_profile[facebook][active]" value="1" class="apsc-counter-activation-trigger" <?php if (isset($apsc_settings['social_profile']['facebook']['active'])) { ?>checked="checked"<?php } ?>/><?php _e('Show/Hide',  'ap-social-pro'); ?></label></div>
            </div>
            <div class="apsc-option-extra">
                <div class="apsc-option-inner-wrapper">
                    <label><?php _e('Facebook Page ID',  'ap-social-pro'); ?></label>
                    <div class="apsc-option-field">
                        <input type="text" name="social_profile[facebook][page_id]" value="<?php echo $apsc_settings['social_profile']['facebook']['page_id']; ?>"/>
                        <div class="apsc-option-note"><?php _e('Please enter the page ID or page name.For example:If your page url is https://www.facebook.com/AccessPressThemes then your page ID is AccessPressThemes',  'ap-social-pro'); ?></div>
                    </div>
                </div>
            </div>
            <div class="apsc-option-extra">
                <div class="apsc-option-inner-wrapper">
                    <label><?php _e('Default Count',  'ap-social-pro'); ?></label>
                    <div class="apsc-option-field">
                        <input type="text" name="social_profile[facebook][default_count]" value="<?php echo $apsc_settings['social_profile']['facebook']['default_count']; ?>"/>
                        <div class="apsc-option-note"><?php _e('Please enter the default count to show instead of 0 when API\'s are not available.',  'ap-social-pro'); ?></div>
                    </div>
                </div>
            </div>

        </div>
        <!---Facebook-->

        <!--Twitter-->
        <div class="apsc-option-outer-wrapper">
            <h4><?php _e('Twitter', 'ap-social-pro') ?></h4>
            <div class="apsc-option-inner-wrapper">
                <label><?php _e('Display Counter', 'ap-social-pro') ?></label>
                <div class="apsc-option-field"><label><input type="checkbox" name="social_profile[twitter][active]" value="1" class="apsc-counter-activation-trigger" <?php if (isset($apsc_settings['social_profile']['twitter']['active'])) { ?>checked="checked"<?php } ?>/><?php _e('Show/Hide',  'ap-social-pro'); ?></label></div>
            </div>
            <div class="apsc-option-extra">
                <div class="apsc-option-inner-wrapper">
                    <label><?php _e('Twitter Username',  'ap-social-pro'); ?></label>
                    <div class="apsc-option-field">
                        <input type="text" name="social_profile[twitter][username]" value="<?php echo $apsc_settings['social_profile']['twitter']['username']; ?>"/>
                        <div class="apsc-option-note"><?php _e('Please enter the twitter username.For example:apthemes',  'ap-social-pro'); ?></div>
                    </div>
                </div>
                <div class="apsc-option-inner-wrapper">
                    <label><?php _e('Twitter Consumer Key',  'ap-social-pro'); ?></label>
                    <div class="apsc-option-field">
                        <input type="text" name="social_profile[twitter][consumer_key]" value="<?php echo $apsc_settings['social_profile']['twitter']['consumer_key']; ?>"/>
                        <div class="apsc-option-note"><?php _e('Please create an app on Twitter through this link:',  'ap-social-pro'); ?> <a href="https://dev.twitter.com/apps" target="_blank">https://dev.twitter.com/apps</a><?php _e(' and get this information.'); ?></div>
                    </div>
                </div>
                <div class="apsc-option-inner-wrapper">
                    <label><?php _e('Twitter Consumer Secret',  'ap-social-pro'); ?></label>
                    <div class="apsc-option-field">
                        <input type="text" name="social_profile[twitter][consumer_secret]" value="<?php echo $apsc_settings['social_profile']['twitter']['consumer_secret']; ?>"/>
                        <div class="apsc-option-note"><?php _e('Please create an app on Twitter through this link:',  'ap-social-pro'); ?> <a href="https://dev.twitter.com/apps" target="_blank">https://dev.twitter.com/apps </a><?php _e(' and get this information.'); ?></div>
                    </div>
                </div>
                <div class="apsc-option-inner-wrapper">
                    <label><?php _e('Twitter Access Token',  'ap-social-pro'); ?></label>
                    <div class="apsc-option-field">
                        <input type="text" name="social_profile[twitter][access_token]" value="<?php echo $apsc_settings['social_profile']['twitter']['access_token']; ?>"/>
                        <div class="apsc-option-note"><?php _e('Please create an app on Twitter through this link:',  'ap-social-pro'); ?> <a href="https://dev.twitter.com/apps" target="_blank">https://dev.twitter.com/apps </a><?php _e(' and get this information.'); ?></div>
                    </div>
                </div>
                <div class="apsc-option-inner-wrapper">
                    <label><?php _e('Twitter Access Token Secret',  'ap-social-pro'); ?></label>
                    <div class="apsc-option-field">
                        <input type="text" name="social_profile[twitter][access_token_secret]" value="<?php echo $apsc_settings['social_profile']['twitter']['access_token_secret']; ?>"/>
                        <div class="apsc-option-note"><?php _e('Please create an app on Twitter through this link:',  'ap-social-pro'); ?> <a href="https://dev.twitter.com/apps" target="_blank">https://dev.twitter.com/apps </a><?php _e(' and get this information.'); ?></div>
                    </div>
                </div>
                <div class="apsc-option-extra">
                    <div class="apsc-option-inner-wrapper">
                        <label><?php _e('Default Count',  'ap-social-pro'); ?></label>
                        <div class="apsc-option-field">
                            <input type="text" name="social_profile[twitter][default_count]" value="<?php echo $apsc_settings['social_profile']['twitter']['default_count']; ?>"/>
                            <div class="apsc-option-note"><?php _e('Please enter the default count to show instead of 0 when API\'s are not available.',  'ap-social-pro'); ?></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--Twitter-->

        <!--Google Plus-->
        <div class="apsc-option-outer-wrapper">
            <h4><?php _e('Google Plus',  'ap-social-pro'); ?></h4>
            <div class="apsc-option-inner-wrapper">
                <label><?php _e('Display Counter', 'ap-social-pro') ?></label>
                <div class="apsc-option-field"><label><input type="checkbox" name="social_profile[googlePlus][active]" value="1" class="apsc-counter-activation-trigger" <?php if (isset($apsc_settings['social_profile']['googlePlus']['active'])) { ?>checked="checked"<?php } ?>/><?php _e('Show/Hide',  'ap-social-pro'); ?></label></div>
            </div>
            <div class="apsc-option-extra">
                <div class="apsc-option-inner-wrapper">
                    <label><?php _e('Google Plus Page Name or Profile ID',  'ap-social-pro'); ?></label>
                    <div class="apsc-option-field">
                        <input type="text" name="social_profile[googlePlus][page_id]" value="<?php echo $apsc_settings['social_profile']['googlePlus']['page_id']; ?>"/>
                        <div class="apsc-option-note"><?php _e('Please enter the page name or profile ID.For example:If your page url is https://plus.google.com/+BBCNews then your page name is +BBCNews',  'ap-social-pro'); ?></div>
                    </div>
                </div>
                <div class="apsc-option-inner-wrapper">
                    <label><?php _e('Google API Key',  'ap-social-pro'); ?></label>
                    <div class="apsc-option-field">
                        <input type="text" name="social_profile[googlePlus][api_key]" value="<?php echo $apsc_settings['social_profile']['googlePlus']['api_key']; ?>"/>
                        <div class="apsc-option-note"><?php _e('To get your API Key, first create a project/app in <a href="https://console.developers.google.com/project" target="_blank">https://console.developers.google.com/project</a> and then turn on Google+ API from "APIs & auth >APIs inside your project.Then again go to "APIs & auth > APIs > Credentials > Public API access" and then click "CREATE A NEW KEY" button, select the "Browser key" option and click in the "CREATE" button, and then copy your API key and paste in above field.',  'ap-social-pro'); ?></div>
                    </div>
                </div>
                <div class="apsc-option-extra">
                    <div class="apsc-option-inner-wrapper">
                        <label><?php _e('Default Count',  'ap-social-pro'); ?></label>
                        <div class="apsc-option-field">
                            <input type="text" name="social_profile[googlePlus][default_count]" value="<?php echo $apsc_settings['social_profile']['googlePlus']['default_count']; ?>"/>
                            <div class="apsc-option-note"><?php _e('Please enter the default count to show instead of 0 when API\'s are not available.',  'ap-social-pro'); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Google Plus-->

        <!--Instagram-->
        <div class="apsc-option-outer-wrapper">
            <h4><?php _e('Instagram', 'ap-social-pro') ?></h4>
            <div class="apsc-option-inner-wrapper">
                <label><?php _e('Display Counter', 'ap-social-pro') ?></label>
                <div class="apsc-option-field"><label><input type="checkbox" name="social_profile[instagram][active]" value="1" class="apsc-counter-activation-trigger" <?php if (isset($apsc_settings['social_profile']['instagram']['active'])) { ?>checked="checked"<?php } ?>/><?php _e('Show/Hide',  'ap-social-pro'); ?></label></div>
            </div>
            <div class="apsc-option-extra">
                <div class="apsc-option-inner-wrapper">
                    <label><?php _e('Instagram Username',  'ap-social-pro'); ?></label>
                    <div class="apsc-option-field">
                        <input type="text" name="social_profile[instagram][username]" value="<?php echo $apsc_settings['social_profile']['instagram']['username']; ?>"/>
                        <div class="apsc-option-note"><?php _e('Please enter the instagram username',  'ap-social-pro'); ?></div>
                    </div>
                </div>
                <div class="apsc-option-inner-wrapper">
                    <label><?php _e('Instagram User ID',  'ap-social-pro'); ?></label>
                    <div class="apsc-option-field">
                        <input type="text" name="social_profile[instagram][user_id]" value="<?php echo $apsc_settings['social_profile']['instagram']['user_id']; ?>"/>
                        <div class="apsc-option-note"><?php _e('Please enter the instagram user ID.You can get this information from <a href="http://www.pinceladasdaweb.com.br/instagram/access-token/" target="_blank">http://www.pinceladasdaweb.com.br/instagram/access-token/</a>',  'ap-social-pro'); ?></div>
                    </div>
                </div>
                <div class="apsc-option-inner-wrapper">
                    <label><?php _e('Instagram Access Token',  'ap-social-pro'); ?></label>
                    <div class="apsc-option-field">
                        <input type="text" name="social_profile[instagram][access_token]" value="<?php echo $apsc_settings['social_profile']['instagram']['access_token']; ?>"/>
                        <div class="apsc-option-note"><?php _e('Please enter the instagram Access Token.You can get this information from <a href="http://www.pinceladasdaweb.com.br/instagram/access-token/" target="_blank">http://www.pinceladasdaweb.com.br/instagram/access-token/</a>',  'ap-social-pro'); ?></div>
                    </div>
                </div>
                <div class="apsc-option-extra">
                    <div class="apsc-option-inner-wrapper">
                        <label><?php _e('Default Count',  'ap-social-pro'); ?></label>
                        <div class="apsc-option-field">
                            <input type="text" name="social_profile[instagram][default_count]" value="<?php echo $apsc_settings['social_profile']['instagram']['default_count']; ?>"/>
                            <div class="apsc-option-note"><?php _e('Please enter the default count to show instead of 0 when API\'s are not available.',  'ap-social-pro'); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Instagram-->

        <!--Youtube-->
        <div class="apsc-option-outer-wrapper">
            <h4><?php _e('Youtube', 'ap-social-pro') ?></h4>
            <div class="apsc-option-inner-wrapper">
                <label><?php _e('Display Counter', 'ap-social-pro') ?></label>
                <div class="apsc-option-field"><label><input type="checkbox" name="social_profile[youtube][active]" value="1" class="apsc-counter-activation-trigger" <?php if (isset($apsc_settings['social_profile']['youtube']['active'])) { ?>checked="checked"<?php } ?>/><?php _e('Show/Hide',  'ap-social-pro'); ?></label></div>
            </div>
            <div class="apsc-option-extra">
                <div class="apsc-option-inner-wrapper">
                    <label><?php _e('Youtube Username',  'ap-social-pro'); ?></label>
                    <div class="apsc-option-field">
                        <input type="text" name="social_profile[youtube][username]" value="<?php echo $apsc_settings['social_profile']['youtube']['username']; ?>"/>
                        <div class="apsc-option-note"><?php _e('Please enter the youtube username.For example:accesspressthemes',  'ap-social-pro'); ?></div>
                    </div>
                </div>
                <div class="apsc-option-inner-wrapper">
                    <label><?php _e('Youtube Channel URL',  'ap-social-pro'); ?></label>
                    <div class="apsc-option-field">
                        <input type="text" name="social_profile[youtube][channel_url]" value="<?php echo $apsc_settings['social_profile']['youtube']['channel_url']; ?>"/>
                        <div class="apsc-option-note"><?php _e('Please enter the youtube channel URL.For example:https://www.youtube.com/user/accesspressthemes',  'ap-social-pro'); ?></div>
                    </div>
                </div>
                <div class="apsc-option-extra">
                    <div class="apsc-option-inner-wrapper">
                        <label><?php _e('Default Count',  'ap-social-pro'); ?></label>
                        <div class="apsc-option-field">
                            <input type="text" name="social_profile[youtube][default_count]" value="<?php echo $apsc_settings['social_profile']['youtube']['default_count']; ?>"/>
                            <div class="apsc-option-note"><?php _e('Please enter the default count to show instead of 0 when API\'s are not available.',  'ap-social-pro'); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Youtube-->

        <!--Sound Cloud-->
        <div class="apsc-option-outer-wrapper">
            <h4><?php _e('Sound Cloud', 'ap-social-pro') ?></h4>
            <div class="apsc-option-inner-wrapper">
                <label><?php _e('Display Counter', 'ap-social-pro') ?></label>
                <div class="apsc-option-field"><label><input type="checkbox" name="social_profile[soundcloud][active]" value="1" class="apsc-counter-activation-trigger" <?php if (isset($apsc_settings['social_profile']['soundcloud']['active'])) { ?>checked="checked"<?php } ?>/><?php _e('Show/Hide',  'ap-social-pro'); ?></label></div>
            </div>
            <div class="apsc-option-extra">
                <div class="apsc-option-inner-wrapper">
                    <label><?php _e('SoundCloud Username',  'ap-social-pro'); ?></label>
                    <div class="apsc-option-field">
                        <input type="text" name="social_profile[soundcloud][username]" value="<?php echo $apsc_settings['social_profile']['soundcloud']['username']; ?>"/>
                        <div class="apsc-option-note"><?php _e('Please enter the SoundCloud username.For example:bchettri',  'ap-social-pro'); ?></div>
                    </div>
                </div>
                <div class="apsc-option-inner-wrapper">
                    <label><?php _e('SoundCloud Client ID',  'ap-social-pro'); ?></label>
                    <div class="apsc-option-field">
                        <input type="text" name="social_profile[soundcloud][client_id]" value="<?php echo $apsc_settings['social_profile']['soundcloud']['client_id']; ?>"/>
                        <div class="apsc-option-note"><?php _e('Please enter the SoundCloud APP Client ID.You can get this information from <a href="http://soundcloud.com/you/apps/new" target="_blank">http://soundcloud.com/you/apps/new</a> after creating a new app',  'ap-social-pro'); ?></div>
                    </div>
                </div>
                <div class="apsc-option-extra">
                    <div class="apsc-option-inner-wrapper">
                        <label><?php _e('Default Count',  'ap-social-pro'); ?></label>
                        <div class="apsc-option-field">
                            <input type="text" name="social_profile[soundcloud][default_count]" value="<?php echo $apsc_settings['social_profile']['soundcloud']['default_count']; ?>"/>
                            <div class="apsc-option-note"><?php _e('Please enter the default count to show instead of 0 when API\'s are not available.',  'ap-social-pro'); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Sound Cloud-->

        <!--Dribbble-->
        <div class="apsc-option-outer-wrapper">
            <h4><?php _e('Dribbble', 'ap-social-pro') ?></h4>
            <div class="apsc-option-inner-wrapper">
                <label><?php _e('Display Counter', 'ap-social-pro') ?></label>
                <div class="apsc-option-field"><label><input type="checkbox" name="social_profile[dribbble][active]" value="1" class="apsc-counter-activation-trigger" <?php if (isset($apsc_settings['social_profile']['dribbble']['active'])) { ?>checked="checked"<?php } ?>/><?php _e('Show/Hide',  'ap-social-pro'); ?></label></div>
            </div>
            <div class="apsc-option-extra">
                <div class="apsc-option-inner-wrapper">
                    <label><?php _e('Dribbble Username',  'ap-social-pro'); ?></label>
                    <div class="apsc-option-field">
                        <input type="text" name="social_profile[dribbble][username]" value="<?php echo $apsc_settings['social_profile']['dribbble']['username']; ?>"/>
                        <div class="apsc-option-note"><?php _e('Please enter your dribbble username.For example:Creativedash',  'ap-social-pro'); ?></div>
                    </div>
                </div>
                <div class="apsc-option-extra">
                    <div class="apsc-option-inner-wrapper">
                        <label><?php _e('Default Count',  'ap-social-pro'); ?></label>
                        <div class="apsc-option-field">
                            <input type="text" name="social_profile[dribbble][default_count]" value="<?php echo $apsc_settings['social_profile']['dribbble']['default_count']; ?>"/>
                            <div class="apsc-option-note"><?php _e('Please enter the default count to show instead of 0 when API\'s are not available.',  'ap-social-pro'); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Dribbble-->

        <!--Steam-->
        <div class="apsc-option-outer-wrapper">
            <h4><?php _e('Steam', 'ap-social-pro') ?></h4>
            <div class="apsc-option-inner-wrapper">
                <label><?php _e('Display Counter', 'ap-social-pro') ?></label>
                <div class="apsc-option-field"><label><input type="checkbox" name="social_profile[steam][active]" value="1" class="apsc-counter-activation-trigger" <?php if (isset($apsc_settings['social_profile']['steam']['active'])) { ?>checked="checked"<?php } ?>/><?php _e('Show/Hide',  'ap-social-pro'); ?></label></div>
            </div>
            <div class="apsc-option-extra">
                <div class="apsc-option-inner-wrapper">
                    <label><?php _e('Steam Group Name',  'ap-social-pro'); ?></label>
                    <div class="apsc-option-field">
                        <input type="text" name="social_profile[steam][group_name]" value="<?php echo $apsc_settings['social_profile']['steam']['group_name']; ?>"/>
                        <div class="apsc-option-note"><?php _e('Please enter your steam group name.For example:BadgesCollectors',  'ap-social-pro'); ?></div>
                    </div>
                </div>
                <div class="apsc-option-extra">
                    <div class="apsc-option-inner-wrapper">
                        <label><?php _e('Default Count',  'ap-social-pro'); ?></label>
                        <div class="apsc-option-field">
                            <input type="text" name="social_profile[steam][default_count]" value="<?php echo $apsc_settings['social_profile']['steam']['default_count']; ?>"/>
                            <div class="apsc-option-note"><?php _e('Please enter the default count to show instead of 0 when API\'s are not available.',  'ap-social-pro'); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Steam-->

        <!--Vimeo-->
        <div class="apsc-option-outer-wrapper">
            <h4><?php _e('Vimeo', 'ap-social-pro') ?></h4>
            <div class="apsc-option-inner-wrapper">
                <label><?php _e('Display Counter', 'ap-social-pro') ?></label>
                <div class="apsc-option-field"><label><input type="checkbox" name="social_profile[vimeo][active]" value="1" class="apsc-counter-activation-trigger" <?php if (isset($apsc_settings['social_profile']['vimeo']['active'])) { ?>checked="checked"<?php } ?>/><?php _e('Show/Hide',  'ap-social-pro'); ?></label></div>
            </div>
            <div class="apsc-option-extra">
                <div class="apsc-option-inner-wrapper">
                    <label><?php _e('Vimeo Username',  'ap-social-pro'); ?></label>
                    <div class="apsc-option-field">
                        <input type="text" name="social_profile[vimeo][username]" value="<?php echo $apsc_settings['social_profile']['vimeo']['username']; ?>"/>
                        <div class="apsc-option-note"><?php _e('Please enter your vimeo channel username.For example:documentaryfilm',  'ap-social-pro'); ?></div>
                    </div>
                </div>
                <div class="apsc-option-extra">
                    <div class="apsc-option-inner-wrapper">
                        <label><?php _e('Default Count',  'ap-social-pro'); ?></label>
                        <div class="apsc-option-field">
                            <input type="text" name="social_profile[vimeo][default_count]" value="<?php echo $apsc_settings['social_profile']['vimeo']['default_count']; ?>"/>
                            <div class="apsc-option-note"><?php _e('Please enter the default count to show instead of 0 when API\'s are not available.',  'ap-social-pro'); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Vimeo-->

        <!--Pinterest-->
        <div class="apsc-option-outer-wrapper">
            <h4><?php _e('Pinterest', 'ap-social-pro') ?></h4>
            <div class="apsc-option-inner-wrapper">
                <label><?php _e('Display Counter', 'ap-social-pro') ?></label>
                <div class="apsc-option-field"><label><input type="checkbox" name="social_profile[pinterest][active]" value="1" class="apsc-counter-activation-trigger" <?php if (isset($apsc_settings['social_profile']['pinterest']['active'])) { ?>checked="checked"<?php } ?>/><?php _e('Show/Hide',  'ap-social-pro'); ?></label></div>
            </div>
            <div class="apsc-option-extra">
                <div class="apsc-option-inner-wrapper">
                    <label><?php _e('Pinterest Profile URL',  'ap-social-pro'); ?></label>
                    <div class="apsc-option-field">
                        <input type="text" name="social_profile[pinterest][profile_url]" value="<?php echo $apsc_settings['social_profile']['pinterest']['profile_url']; ?>"/>
                        <div class="apsc-option-note"><?php _e('Please enter your pinterest profile url.For example:http://www.pinterest.com/froymejia',  'ap-social-pro'); ?></div>
                    </div>
                </div>
                <div class="apsc-option-extra">
                    <div class="apsc-option-inner-wrapper">
                        <label><?php _e('Default Count',  'ap-social-pro'); ?></label>
                        <div class="apsc-option-field">
                            <input type="text" name="social_profile[pinterest][default_count]" value="<?php echo $apsc_settings['social_profile']['pinterest']['default_count']; ?>"/>
                            <div class="apsc-option-note"><?php _e('Please enter the default count to show instead of 0 when API\'s are not available.',  'ap-social-pro'); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Pinterest-->

        <!--Forrst-->
        <div class="apsc-option-outer-wrapper">
            <h4><?php _e('Forrst', 'ap-social-pro') ?></h4>
            <div class="apsc-option-inner-wrapper">
                <label><?php _e('Display Counter', 'ap-social-pro') ?></label>
                <div class="apsc-option-field"><label><input type="checkbox" name="social_profile[forrst][active]" value="1" class="apsc-counter-activation-trigger" <?php if (isset($apsc_settings['social_profile']['forrst']['active'])) { ?>checked="checked"<?php } ?>/><?php _e('Show/Hide',  'ap-social-pro'); ?></label></div>
            </div>
            <div class="apsc-option-extra">
                <div class="apsc-option-inner-wrapper">
                    <label><?php _e('Forrst Username',  'ap-social-pro'); ?></label>
                    <div class="apsc-option-field">
                        <input type="text" name="social_profile[forrst][username]" value="<?php echo $apsc_settings['social_profile']['forrst']['username']; ?>"/>
                        <div class="apsc-option-note"><?php _e('Please enter your forrst username.For example:Ranger',  'ap-social-pro'); ?></div>
                    </div>
                </div>
                <div class="apsc-option-extra">
                    <div class="apsc-option-inner-wrapper">
                        <label><?php _e('Default Count',  'ap-social-pro'); ?></label>
                        <div class="apsc-option-field">
                            <input type="text" name="social_profile[forrst][default_count]" value="<?php echo $apsc_settings['social_profile']['forrst']['default_count']; ?>"/>
                            <div class="apsc-option-note"><?php _e('Please enter the default count to show instead of 0 when API\'s are not available.',  'ap-social-pro'); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Forrst-->

        <!--VK-->
        <div class="apsc-option-outer-wrapper">
            <h4><?php _e('VK', 'ap-social-pro') ?></h4>
            <div class="apsc-option-inner-wrapper">
                <label><?php _e('Display Counter', 'ap-social-pro') ?></label>
                <div class="apsc-option-field"><label><input type="checkbox" name="social_profile[vk][active]" value="1" class="apsc-counter-activation-trigger" <?php if (isset($apsc_settings['social_profile']['vk']['active'])) { ?>checked="checked"<?php } ?>/><?php _e('Show/Hide',  'ap-social-pro'); ?></label></div>
            </div>
            <div class="apsc-option-extra">
                <div class="apsc-option-inner-wrapper">
                    <label><?php _e('Group ID',  'ap-social-pro'); ?></label>
                    <div class="apsc-option-field">
                        <input type="text" name="social_profile[vk][group_id]" value="<?php echo $apsc_settings['social_profile']['vk']['group_id']; ?>"/>
                        <div class="apsc-option-note"><?php _e('Please enter your VK group ID.For example:applevk',  'ap-social-pro'); ?></div>
                    </div>
                </div>
                <div class="apsc-option-extra">
                    <div class="apsc-option-inner-wrapper">
                        <label><?php _e('Default Count',  'ap-social-pro'); ?></label>
                        <div class="apsc-option-field">
                            <input type="text" name="social_profile[vk][default_count]" value="<?php echo $apsc_settings['social_profile']['vk']['default_count']; ?>"/>
                            <div class="apsc-option-note"><?php _e('Please enter the default count to show instead of 0 when API\'s are not available.',  'ap-social-pro'); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--VK-->

        <!--Flickr-->
        <div class="apsc-option-outer-wrapper">
            <h4><?php _e('Flickr', 'ap-social-pro') ?></h4>
            <div class="apsc-option-inner-wrapper">
                <label><?php _e('Display Counter', 'ap-social-pro') ?></label>
                <div class="apsc-option-field"><label><input type="checkbox" name="social_profile[flickr][active]" value="1" class="apsc-counter-activation-trigger" <?php if (isset($apsc_settings['social_profile']['flickr']['active'])) { ?>checked="checked"<?php } ?>/><?php _e('Show/Hide',  'ap-social-pro'); ?></label></div>
            </div>
            <div class="apsc-option-extra">
                <div class="apsc-option-inner-wrapper">
                    <label><?php _e('Group ID',  'ap-social-pro'); ?></label>
                    <div class="apsc-option-field">
                        <input type="text" name="social_profile[flickr][group_id]" value="<?php echo $apsc_settings['social_profile']['flickr']['group_id']; ?>"/>
                        <div class="apsc-option-note"><?php _e('Please enter your Flickr group ID.For example:44124373027@N01.To get your group ID please go to <a href="http://idgettr.com/" target="_blank">http://idgettr.com/</a>',  'ap-social-pro'); ?></div>
                    </div>
                </div>
                <div class="apsc-option-inner-wrapper">
                    <label><?php _e('API Key',  'ap-social-pro'); ?></label>
                    <div class="apsc-option-field">
                        <input type="text" name="social_profile[flickr][api_key]" value="<?php echo $apsc_settings['social_profile']['flickr']['api_key']; ?>"/>
                        <div class="apsc-option-note"><?php _e('Please enter your Flickr API Key.You can get this api key by creating a app from <a href="https://www.flickr.com/services/apps/create/apply/?" target="_blank">https://www.flickr.com/services/apps/create/apply/?</a>.',  'ap-social-pro'); ?></div>
                    </div>
                </div>
                <div class="apsc-option-extra">
                    <div class="apsc-option-inner-wrapper">
                        <label><?php _e('Default Count',  'ap-social-pro'); ?></label>
                        <div class="apsc-option-field">
                            <input type="text" name="social_profile[flickr][default_count]" value="<?php echo $apsc_settings['social_profile']['flickr']['default_count']; ?>"/>
                            <div class="apsc-option-note"><?php _e('Please enter the default count to show instead of 0 when API\'s are not available.',  'ap-social-pro'); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Flickr-->

        <!--Behance-->
        <div class="apsc-option-outer-wrapper">
            <h4><?php _e('Behance', 'ap-social-pro') ?></h4>
            <div class="apsc-option-inner-wrapper">
                <label><?php _e('Display Counter', 'ap-social-pro') ?></label>
                <div class="apsc-option-field"><label><input type="checkbox" name="social_profile[behance][active]" value="1" class="apsc-counter-activation-trigger" <?php if (isset($apsc_settings['social_profile']['behance']['active'])) { ?>checked="checked"<?php } ?>/><?php _e('Show/Hide',  'ap-social-pro'); ?></label></div>
            </div>
            <div class="apsc-option-extra">
                <div class="apsc-option-inner-wrapper">
                    <label><?php _e('Behance Username',  'ap-social-pro'); ?></label>
                    <div class="apsc-option-field">
                        <input type="text" name="social_profile[behance][username]" value="<?php echo $apsc_settings['social_profile']['behance']['username']; ?>"/>
                        <div class="apsc-option-note"><?php _e('Please enter your Behance Username.For example:matiascorea',  'ap-social-pro'); ?></div>
                    </div>

                </div>
                <div class="apsc-option-inner-wrapper">
                    <label><?php _e('Behance API Key',  'ap-social-pro'); ?></label>
                    <div class="apsc-option-field">
                        <input type="text" name="social_profile[behance][api_key]" value="<?php echo $apsc_settings['social_profile']['behance']['api_key']; ?>"/>
                        <div class="apsc-option-note"><?php _e('Please enter your Behance API Key.To get the API key please go to <a href="https://www.behance.net/dev/register" target="_blank">https://www.behance.net/dev/register</a> and register an app and get the API Key.',  'ap-social-pro'); ?></div>
                    </div>
                </div>
                <div class="apsc-option-extra">
                    <div class="apsc-option-inner-wrapper">
                        <label><?php _e('Default Count',  'ap-social-pro'); ?></label>
                        <div class="apsc-option-field">
                            <input type="text" name="social_profile[behance][default_count]" value="<?php echo $apsc_settings['social_profile']['behance']['default_count']; ?>"/>
                            <div class="apsc-option-note"><?php _e('Please enter the default count to show instead of 0 when API\'s are not available.',  'ap-social-pro'); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Behance-->

        <!--Github-->
        <div class="apsc-option-outer-wrapper">
            <h4><?php _e('Github', 'ap-social-pro') ?></h4>
            <div class="apsc-option-inner-wrapper">
                <label><?php _e('Display Counter', 'ap-social-pro') ?></label>
                <div class="apsc-option-field"><label><input type="checkbox" name="social_profile[github][active]" value="1" class="apsc-counter-activation-trigger" <?php if (isset($apsc_settings['social_profile']['github']['active'])) { ?>checked="checked"<?php } ?>/><?php _e('Show/Hide',  'ap-social-pro'); ?></label></div>
            </div>
            <div class="apsc-option-extra">
                <div class="apsc-option-inner-wrapper">
                    <label><?php _e('Github Username',  'ap-social-pro'); ?></label>
                    <div class="apsc-option-field">
                        <input type="text" name="social_profile[github][username]" value="<?php echo $apsc_settings['social_profile']['github']['username']; ?>"/>
                        <div class="apsc-option-note"><?php _e('Please enter your Github Username.For example:SimonEast',  'ap-social-pro'); ?></div>
                    </div>
                </div>
            </div>
            <div class="apsc-option-extra">
                <div class="apsc-option-inner-wrapper">
                    <label><?php _e('Default Count',  'ap-social-pro'); ?></label>
                    <div class="apsc-option-field">
                        <input type="text" name="social_profile[github][default_count]" value="<?php echo $apsc_settings['social_profile']['github']['default_count']; ?>"/>
                        <div class="apsc-option-note"><?php _e('Please enter the default count to show instead of 0 when API\'s are not available.',  'ap-social-pro'); ?></div>
                    </div>
                </div>
            </div>
        </div>
        <!--Github-->

        <!--Envato-->
        <div class="apsc-option-outer-wrapper">
            <h4><?php _e('Envato', 'ap-social-pro') ?></h4>
            <div class="apsc-option-inner-wrapper">
                <label><?php _e('Display Counter', 'ap-social-pro') ?></label>
                <div class="apsc-option-field"><label><input type="checkbox" name="social_profile[envato][active]" value="1" class="apsc-counter-activation-trigger" <?php if (isset($apsc_settings['social_profile']['envato']['active'])) { ?>checked="checked"<?php } ?>/><?php _e('Show/Hide',  'ap-social-pro'); ?></label></div>
            </div>
            <div class="apsc-option-extra">
                <div class="apsc-option-inner-wrapper">
                    <label><?php _e('Envato Username',  'ap-social-pro'); ?></label>
                    <div class="apsc-option-field">
                        <input type="text" name="social_profile[envato][username]" value="<?php echo $apsc_settings['social_profile']['envato']['username']; ?>"/>
                        <div class="apsc-option-note"><?php _e('Please enter your Envato Username.For example:AccessKeys',  'ap-social-pro'); ?></div>
                    </div>
                </div>
                <div class="apsc-option-inner-wrapper">
                    <label><?php _e('Envato Profile URL',  'ap-social-pro'); ?></label>
                    <div class="apsc-option-field">
                        <input type="text" name="social_profile[envato][profile_url]" value="<?php echo $apsc_settings['social_profile']['envato']['profile_url']; ?>"/>
                        <div class="apsc-option-note"><?php _e('Please enter your Envato Profile URL.For example:http://codecanyon.net/user/AccessKeys',  'ap-social-pro'); ?></div>
                    </div>
                </div>
                <div class="apsc-option-extra">
                    <div class="apsc-option-inner-wrapper">
                        <label><?php _e('Default Count',  'ap-social-pro'); ?></label>
                        <div class="apsc-option-field">
                            <input type="text" name="social_profile[envato][default_count]" value="<?php echo $apsc_settings['social_profile']['envato']['default_count']; ?>"/>
                            <div class="apsc-option-note"><?php _e('Please enter the default count to show instead of 0 when API\'s are not available.',  'ap-social-pro'); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Github-->

        <!--Posts-->
        <div class="apsc-option-outer-wrapper">
            <h4><?php _e("Posts", 'ap-social-pro') ?></h4>
            <div class="apsc-option-inner-wrapper">
                <label><?php _e('Display Counter',  'ap-social-pro'); ?></label>
                <div class="apsc-option-field"><label><input type="checkbox" name="social_profile[posts][active]" value="1" class="apsc-counter-activation-trigger" <?php if (isset($apsc_settings['social_profile']['posts']['active'])) { ?>checked="checked"<?php } ?>/><?php _e('Show/Hide',  'ap-social-pro'); ?></label></div>
            </div>
        </div>
        <!--Posts-->

        <!--Comments-->
        <div class="apsc-option-outer-wrapper">
            <h4><?php _e("Comments",  'ap-social-pro'); ?></h4>
            <div class="apsc-option-inner-wrapper">
                <label><?php _e('Display Counter',  'ap-social-pro'); ?></label>
                <div class="apsc-option-field"><label><input type="checkbox" name="social_profile[comments][active]" value="1" class="apsc-counter-activation-trigger" <?php if (isset($apsc_settings['social_profile']['comments']['active'])) { ?>checked="checked"<?php } ?>/><?php _e('Show/Hide',  'ap-social-pro'); ?></label></div>
            </div>
        </div>
        <!--Comments-->

    </div>

</div>
