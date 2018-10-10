<div class="apsc-boards-tabs" id="apsc-board-float-sidebar-settings" style="display:none">
    <div class="apsc-option-inner-wrapper">
        <label><?php _e('Enable Floating Sidebar',  'ap-social-pro'); ?></label>
        <div class="apsc-option-field">
            <label>
                <input type="checkbox" name="floating_sidebar[active]" value="1" <?php echo (isset($apsc_settings['floating_sidebar']['active']) && $apsc_settings['floating_sidebar']['active']=='1')?'checked="checked"':'';?>/><div class="apsc-option-side-note"><?php _e('Check if you want to show floating sidebar in the frontend',  'ap-social-pro'); ?></div>
            </label>
        </div>
    </div>
    <div class="apsc-option-innner-wrapper">
        <label><?php _e('Show sidebar in',  'ap-social-pro'); ?> :</label>
        <div class="apsc-option-field">
            <select name="floating_sidebar[show]">
                <option value="all" <?php echo ($apsc_settings['floating_sidebar']['show']=='all')?'selected="selected"':'';?>><?php _e('All pages',  'ap-social-pro'); ?></option>
                <option value="only_homepage" <?php echo ($apsc_settings['floating_sidebar']['show']=='only_homepage')?'selected="selected"':'';?>><?php _e('Only on homepage',  'ap-social-pro'); ?></option>
                <option value="except_homepage" <?php echo ($apsc_settings['floating_sidebar']['show']=='except_homepage')?'selected="selected"':'';?>><?php _e('Except homepage',  'ap-social-pro'); ?></option>
            </select>
        </div>
    </div>
    <div class="apsc-option-inner-wrapper apsc-chose-theme">
        <label><?php _e('Choose Theme',  'ap-social-pro'); ?></label>
        <div class="apsc-option-field">
            <label>
                <input type="radio" name="floating_sidebar[theme]" value="theme-1" <?php echo ($apsc_settings['floating_sidebar']['theme']=='theme-1')?'checked="checked"':'';?>/><?php _e('Theme 1', 'ap-social-pro');?>
                <div class="apsc-floatbar-image"><img src="<?php echo SC_PRO_IMAGE_DIR . '/floating-bar/floatingbar1.jpg '?>"/></div>
            </label>
            <label>
                <input type="radio" name="floating_sidebar[theme]" value="theme-2" <?php echo ($apsc_settings['floating_sidebar']['theme']=='theme-2')?'checked="checked"':'';?>/><?php _e('Theme 2', 'ap-social-pro');?>
                <div class="apsc-floatbar-image"><img src="<?php echo SC_PRO_IMAGE_DIR . '/floating-bar/floatingbar2.jpg '?>"/></div>
            </label>
            <label>
                <input type="radio" name="floating_sidebar[theme]" value="theme-3" <?php echo ($apsc_settings['floating_sidebar']['theme']=='theme-3')?'checked="checked"':'';?>/><?php _e('Theme 3', 'ap-social-pro');?>
                <div class="apsc-floatbar-image"><img src="<?php echo SC_PRO_IMAGE_DIR . '/floating-bar/floatingbar3.jpg '?>"/></div>
            </label>
            <label>
                <input type="radio" name="floating_sidebar[theme]" value="theme-4" <?php echo ($apsc_settings['floating_sidebar']['theme']=='theme-4')?'checked="checked"':'';?>/><?php _e('Theme 4', 'ap-social-pro');?>
                <div class="apsc-floatbar-image"><img src="<?php echo SC_PRO_IMAGE_DIR . '/floating-bar/floatingbar4.jpg '?>"/></div>
            </label>
            <label>
                <input type="radio" name="floating_sidebar[theme]" value="theme-5" <?php echo ($apsc_settings['floating_sidebar']['theme']=='theme-5')?'checked="checked"':'';?>/><?php _e('Theme 5', 'ap-social-pro');?>
                <div class="apsc-floatbar-image"><img src="<?php echo SC_PRO_IMAGE_DIR . '/floating-bar/floatingbar5.jpg '?>"/></div>
            </label>
        </div>
    </div>
    <?php /*<!--<div class="apsc-option-inner-wrapper">
        <label><?php _e('Show Tooltip', 'ap-social-pro');?></label>
        <div class="apsc-option-field">
            <label><input type="checkbox" name="floating_sidebar[tooltip]" value="1" <?php echo (isset($apsc_settings['floating_sidebar']['tooltip']) && $apsc_settings['floating_sidebar']['tooltip']=='1')?'checked="checked"':'';?>/><div class="apsc-option-side-note"><?php _e('Check if you want to show tooltip', 'ap-social-pro');?></div></label>
        </div>
    </div>
    <div class="apsc-option-inner-wrapper">
        <label><?php _e('Tooltip Background Color', 'ap-social-pro');?></label>
        <div class="apsc-option-field">
            <label><input type="text" name="floating_sidebar[bg_color]" class="apsc-colorpicker"  value="<?php echo $apsc_settings['floating_sidebar']['bg_color']?>"/></label>
        </div>
    </div>
    <div class="apsc-option-inner-wrapper">
        <label><?php _e('Tooltip Text Color', 'ap-social-pro');?></label>
        <div class="apsc-option-field">
            <input type="text" name="floating_sidebar[text_color]" class="apsc-colorpicker" value="<?php echo $apsc_settings['floating_sidebar']['text_color']?>"/>
        </div>
    </div>--> */?>
    <div class="apsc-option-inner-wrapper apsc-hover-side-bg">
        <label><?php _e('Hover Background Color', 'ap-social-pro');?></label>
        <div class="apsc-option-field">
            <input type="text" name="floating_sidebar[hover_color]" class="apsc-colorpicker" value="<?php echo isset($apsc_settings['floating_sidebar']['hover_color'])?$apsc_settings['floating_sidebar']['hover_color']:'';?>"/>
            <div class="apsc-option-note"><?php _e('Please keep blank if you don\'t want to change the background color of icon on mouser hover.', 'ap-social-pro');?></div>
        </div>
    </div>
    <div class="apsc-option-inner-wrapper">
        <label><?php _e('Floating Sidebar Position', 'ap-social-pro');?></label>
        <div class="apsc-option-field">
            <select name="floating_sidebar[position]">
                <option value="left-top" <?php echo (isset($apsc_settings['floating_sidebar']['position']) && $apsc_settings['floating_sidebar']['position']=='left-top')?'selected="selected"':'';?>><?php _e('Left Top', 'ap-social-pro');?></option>
                <option value="left-middle" <?php echo (isset($apsc_settings['floating_sidebar']['position']) && $apsc_settings['floating_sidebar']['position']=='left-middle')?'selected="selected"':'';?>><?php _e('Left Middle', 'ap-social-pro');?></option>
                <option value="left-bottom" <?php echo (isset($apsc_settings['floating_sidebar']['position']) && $apsc_settings['floating_sidebar']['position']=='left-bottom')?'selected="selected"':'';?>><?php _e('Left Bottom', 'ap-social-pro');?></option>
                <option value="right-top" <?php echo (isset($apsc_settings['floating_sidebar']['position']) && $apsc_settings['floating_sidebar']['position']=='right-top')?'selected="selected"':'';?>><?php _e('Right Top', 'ap-social-pro');?></option>
                <option value="right-middle" <?php echo (isset($apsc_settings['floating_sidebar']['position']) && $apsc_settings['floating_sidebar']['position']=='right-middle')?'selected="selected"':'';?>><?php _e('Right Middle', 'ap-social-pro');?></option>
                <option value="right-bottom" <?php echo (isset($apsc_settings['floating_sidebar']['position']) && $apsc_settings['floating_sidebar']['position']=='right-bottom')?'selected="selected"':'';?>><?php _e('Right Bottom', 'ap-social-pro');?></option>
            </select> 
        </div>
    </div>
    <div class="apsc-option-inner-wrapper">
            <label><?php _e('Counter Format', 'ap-social-pro');?></label>
            <div class="apsc-option-field">
                <label><input type="radio" name="sidebar_counter_format" value="default" <?php echo (isset($apsc_settings['sidebar_counter_format']) && $apsc_settings['sidebar_counter_format']=='default')?'checked="checked"':'';?>/>12300</label>
                <label><input type="radio" name="sidebar_counter_format" value="comma" <?php echo (isset($apsc_settings['sidebar_counter_format']) && $apsc_settings['sidebar_counter_format']=='comma')?'checked="checked"':'';?>/>12,300</label>
                <label><input type="radio" name="sidebar_counter_format" value="short" <?php echo (isset($apsc_settings['sidebar_counter_format']) && $apsc_settings['sidebar_counter_format']=='short')?'checked="checked"':'';?>/>12.3K</label>
            </div>
    </div>
    <div class="apsc-option-inner-wrapper">
        <label><?php _e('Social Profiles', 'ap-social-pro');?></label>
        <div class="apsc-option-field">
          <textarea name="floatbar_profiles" rows="8"><?php echo (isset($apsc_settings['floatbar_profiles']))?$apsc_settings['floatbar_profiles']:'';?></textarea>
          <div class="apsc-option-note"><?php _e('Please enter the social profiles by separating with comma if you want to override the social profiles choosen from above social profiles section.Please refer to About Section for the available social profiles.', 'ap-social-pro');?></div>
        </div>
    </div>
</div>