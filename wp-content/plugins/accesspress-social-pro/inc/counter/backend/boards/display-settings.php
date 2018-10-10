<div class="apsc-boards-tabs" id="apsc-board-display-settings" style="display: none">
    <div class="apsc-tab-wrapper">
        <div class="apsc-option-inner-wrapper">
            <label><?php _e('Social Profile Order',  'ap-social-pro'); ?></label>
            <div class="apsc-option-field">
                <ul class="apsc-sortable">
                    <?php
                    $social_profiles_ref = array('facebook' => 'Facebook',
                        'twitter' => 'Twitter',
                        'googlePlus' => 'Google Plus',
                        'instagram' => 'Instagram',
                        'soundcloud' => 'SoundCloud',
                        'dribbble' => 'Dribbble',
                        'youtube' => 'Youtube',
                        'steam' => 'Steam',
                        'vimeo' => 'Vimeo',
                        'pinterest' => 'Pinterest',
                        'forrst' => 'Forrst',
                        'vk' => 'VK',
                        'flickr' => 'Flickr',
                        'behance' => 'Behance',
                        'github' => 'Github',
                        'envato' => 'Envato',
                        'posts' => 'Posts',
                        'comments' => 'Comments',
                    );
                    //$social_profiles = array('facebook','twitter','googlePlus','instagram','soundcloud','dribbble','youtube','posts','comments');
                    $social_profiles = $apsc_settings['profile_order'];
                    foreach ($social_profiles as $social_profile) {
                        ?>
                        <li><span class="left-icon"><i class="fa fa-arrows"></i></span><span class="social-name"><?php _e($social_profiles_ref[$social_profile],  'ap-social-pro'); ?></span>
                            <input type="hidden" name="profile_order[]" value="<?php echo $social_profile; ?>"/>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div class="apsc-option-inner-wrapper">
            <label><?php _e('Icon Hover Animations',  'ap-social-pro'); ?></label>
            <div class="apsc-option-field">
                <select name="icon_hover_animation">
                    <option value=""><?php _e('No Animation',  'ap-social-pro'); ?></option>
                    <?php for ($i = 1; $i <= 5; $i++) {
                        ?>
                        <option value="apsc-animation-<?php echo $i; ?>" <?php echo (isset($apsc_settings['icon_hover_animation']) && $apsc_settings['icon_hover_animation'] == 'apsc-animation-' . $i) ? 'selected="selected"' : ''; ?>>Animation-<?php echo $i; ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="apsc-option-inner-wrapper">
            <label><?php _e('Counter Format', 'ap-social-pro');?></label>
            <div class="apsc-option-field">
                <label><input type="radio" name="counter_format" value="default" <?php echo (isset($apsc_settings['counter_format']) && $apsc_settings['counter_format']=='default')?'checked="checked"':'';?>/>12300</label>
                <label><input type="radio" name="counter_format" value="comma" <?php echo (isset($apsc_settings['counter_format']) && $apsc_settings['counter_format']=='comma')?'checked="checked"':'';?>/>12,300</label>
                <label><input type="radio" name="counter_format" value="short" <?php echo (isset($apsc_settings['counter_format']) && $apsc_settings['counter_format']=='short')?'checked="checked"':'';?>/>12.3K</label>
            </div>
        </div>
        <div class="apsc-option-inner-wrapper">
            <label><?php _e('Show Total Count', 'ap-social-pro');?></label>
            <div class="apsc-option-field">
                <label>
                    <input type="checkbox" name="total_count" value="1" <?php checked($apsc_settings['total_count'],true);?>/>
                    <div class="apsc-option-note"><?php _e('Check this if you want to show the total number of counts at the end.', 'ap-social-pro');?></div>
                </label>
            </div>
        </div>
        <div class="apsc-option-inner-wrapper">
            <label><?php _e('Choose Theme',  'ap-social-pro'); ?></label>
            <div class="apsc-option-field apsc-theme-block">
            <?php for($i=1;$i<=20;$i++){
                ?>
                <label>
                    <input type="radio" name="social_profile_theme" value="theme-<?php echo $i;?>" <?php checked($apsc_settings['social_profile_theme'],'theme-'.$i);?>/><?php _e('Theme '.$i,  'ap-social-pro'); ?>
                    <div class="apsc-theme-image"><img src="<?php echo SC_PRO_IMAGE_DIR . '/themes/theme-'.$i.'.jpg'; ?>"/></div>
                </label>
                <?php
            }?>
            </div>
        </div>
        
    </div>
</div>