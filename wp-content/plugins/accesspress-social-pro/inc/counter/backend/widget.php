<?php
defined('ABSPATH') or die("No script kiddies please!");

/**
 * Adds AccessPress Social Icons Widget
 */
class APSC_PRO_Widget extends WP_Widget {

    /**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
                'aps_widget', // Base ID
                __('AccessPress Social Counter Pro', 'ap-social-pro'), // Name
                array('description' => __('AccessPress Social Counter Pro Widget', 'ap-social-pro')) // Args
        );
    }

    /**
     * Front-end display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args     Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance) {

        echo $args['before_widget'];
        if (!empty($instance['title'])) {
            echo $args['before_title'] . apply_filters('widget_title', $instance['title']) . $args['after_title'];
        }
        $theme_atts = (!empty($instance['theme']) && $instance['theme'] != '')?' theme="' . $instance['theme'] . '"':'';
        $profiles_atts = (!empty($instance['profiles']) && $instance['profiles'] != '')?' profiles="' . $instance['profiles'] . '"':'';
        $counter_format_atts = (!empty($instance['counter_format']) && $instance['counter_format'] != '')?' counter_format="' . $instance['counter_format'] . '"':'';
        $animation_atts = (!empty($instance['animation']) && $instance['animation'] != '')?' animation="' . $instance['animation'] . '"':'';
        
        
        echo do_shortcode('[aps-counter-pro'.$theme_atts.$profiles_atts.$counter_format_atts.$animation_atts.']');
        

        echo $args['after_widget'];
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance) {
        $title = isset($instance['title']) ? $instance['title'] : '';
        $theme = isset($instance['theme']) ? $instance['theme'] : '';
        $profiles = isset($instance['profiles']) ? $instance['profiles'] : '';
        $animation = isset($instance['animation']) ? $instance['animation'] : '';
        $counter_format = isset($instance['counter_format']) ? $instance['counter_format'] : '';
        $screen = get_current_screen();
        ?>

        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:',  'ap-social-pro'); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">

        </p>
        <p>
            <label for="<?php echo $this->get_field_id('profiles'); ?>"><?php _e('Social Profiles',  'ap-social-pro'); ?></label>
            <textarea class="widefat" id="<?php echo $this->get_field_id('profiles') ?>" name="<?php echo $this->get_field_name('profiles') ?>" rows="5"><?php echo $profiles; ?></textarea>
            <span class="apsc-option-note"><i><?php _e('Please enter comma separated profiles names.Profiles from plugin social profiles will be shown if kept blank',  'ap-social-pro'); ?></i></span>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('theme'); ?>"><?php _e('Theme',  'ap-social-pro'); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('theme'); ?>" name="<?php echo $this->get_field_name('theme'); ?>">
                <option value="">Default</option>
                <?php
                for ($i = 1; $i <= 20; $i++) {
                    ?>
                    <option value="theme-<?php echo $i; ?>" <?php selected('theme-' . $i, $theme); ?>>Theme <?php echo $i; ?></option>
                    <?php
                }
                ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('animation'); ?>"><?php _e('Animation',  'ap-social-pro'); ?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('animation'); ?>" name="<?php echo $this->get_field_name('animation');?>">
                <option value="default" <?php selected($animation,'default');?>><?php _e('Default',  'ap-social-pro'); ?></option>
                <option value=""><?php _e('No animation',  'ap-social-pro'); ?></option>
                <?php
                for ($i = 1; $i <= 5; $i++) {
                    ?>
                    <option value="animation-<?php echo $i; ?>" <?php selected('animation-' . $i, $animation); ?>>Animation <?php echo $i; ?></option>
                    <?php
                }
                ?>
            </select>
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id('counter-format');?>"><?php _e('Counter Format', 'ap-social-pro');?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('counter-format');?>" name="<?php echo $this->get_field_name('counter_format');?>">
                <option value=""><?php _e('Choose Count Format', 'ap-social-pro');?></option>
                <option value="default" <?php selected($counter_format,'default');?>>12300</option>
                <option value="comma" <?php selected($counter_format,'comma');?>>12,300</option>
                <option value="short" <?php selected($counter_format,'short');?>>12.3K</option>
            </select>
        </p>


        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    public function update($new_instance, $old_instance) {
        //die(print_r($new_instance));
        $instance = array();
        $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
        $instance['theme'] = (!empty($new_instance['theme']) ) ? strip_tags($new_instance['theme']) : '';
        $instance['profiles'] = (!empty($new_instance['profiles']) ) ? strip_tags($new_instance['profiles']) : '';
        $instance['animation'] = (!empty($new_instance['animation']) ) ? strip_tags($new_instance['animation']) : '';
        $instance['counter_format'] = (!empty($new_instance['counter_format']) ) ? strip_tags($new_instance['counter_format']) : '';
        return $instance;
    }

}

// class APS_PRO_Widget
?>