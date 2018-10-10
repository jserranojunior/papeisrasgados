<?php
defined('ABSPATH') or die("No script kiddies please!");
/**
 * Adds AccessPress Social Share Widget
 */

class APSS_Widget extends WP_Widget {

	/**
     * Register widget with WordPress.
     */
    function __construct() {
        parent::__construct(
                'apss_widget', // Base ID
                __('AccessPress Social Share Pro', APSS_TEXT_DOMAIN), // Name
                array('description' => __('AccessPress Social Share Widget', APSS_TEXT_DOMAIN)) // Args
        );
    }

    /**
     * Back-end widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     */
    public function form($instance) {

        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = '';
        }

        if (isset($instance['theme'])) {
            $theme = $instance['theme'];
        } else {
            $theme = '';
        }

        if (isset($instance['counter'])) {
            $counter = $instance['counter'];
        } else {
            $counter = '0';
        }

        if (isset($instance['widget_color'])) {
            $widget_color = $instance['widget_color'];
        } else {
            $widget_color = '0';
        }

        ?>

        <script type="text/javascript">
        jQuery(document).ready(function($){
            $('.apss_widget_color_picker').wpColorPicker();
        });
        </script>

        <p>

            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title: ', APSS_TEXT_DOMAIN); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
        <label for="<?php echo $this->get_field_id('theme'); ?>"><?php _e('Theme: ', APSS_TEXT_DOMAIN); ?></label> 
        <input class="widefat" id="<?php echo $this->get_field_id('theme'); ?>" name="<?php echo $this->get_field_name('theme'); ?>" type="text" value="<?php echo esc_attr($theme); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('counter'); ?>"><?php _e('Counter Enable ?', APSS_TEXT_DOMAIN); ?></label>
            <input type="radio" name="<?php echo $this->get_field_name('counter'); ?>" <?php if($counter =='1'){echo "checked='checked'"; } ?> value="1">Yes	
			<input type="radio" name="<?php echo $this->get_field_name('counter'); ?>" <?php if($counter =='0'){echo "checked='checked'"; } ?> value="0">No
        </p>

        <p>
            <label for="<?php echo $this->get_field_id('widget_color'); ?>"><?php _e('Widget Background Color: ', APSS_TEXT_DOMAIN); ?></label>
                      <input class="apss_widget_color_picker" id="<?php echo $this->get_field_id('widget_color'); ?>" name="<?php echo $this->get_field_name('widget_color'); ?>" type="text" value="<?php echo esc_attr($widget_color); ?>" />
        </p>

        <?php
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
        global $post;
        if(have_posts()){
            $widget_flag = get_post_meta($post->ID, 'apss_widget_flag', true);
        }else{
            $widget_flag=0;
        }
        if($widget_flag !='1'){
        $color=$instance['widget_color'];
        echo "<div class='apss-widget' style='background-color: $color'>";
        echo do_shortcode("[apss-share theme='{$instance['theme']}' counter='{$instance['counter']}']");
        echo "<div>";
        }
        echo $args['after_widget'];
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
        $instance = array();
        $instance['title'] = (!empty($new_instance['title']) ) ? strip_tags($new_instance['title']) : '';
        $instance['theme'] = (!empty($new_instance['theme']) ) ? strip_tags($new_instance['theme']) : '';
        $instance['counter'] = (!empty($new_instance['counter']) ) ? strip_tags($new_instance['counter']) : '0';
        $instance['widget_color'] =(!empty($new_instance['widget_color'])) ? strip_tags($new_instance['widget_color']) : '';
        return $instance;
    }



}

?>