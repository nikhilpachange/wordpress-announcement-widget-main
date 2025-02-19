<?php

if(!defined("ABSPATH")) die("Access denied");

// Method #2
include_once ABSPATH . "wp-load.php";

class App_Announcement extends WP_Widget{

    public function __construct(){
        
        parent::__construct("wpa_announcement", "WPA Announcement", [
            "description" => "This is a custom widget for wordpress announcements"
        ]);
    }

    // Create widget Admin view
    public function form( $instance ) {

        $old_title = isset($instance['wpa_title']) ? $instance['wpa_title'] : "";
        $old_description = isset($instance['wpa_description']) ? $instance['wpa_description'] : "";
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('wpa_title') ?>">Title</label>
            <input class="widefat" type="text" 
            name="<?php echo $this->get_field_name('wpa_title') ?>" value="<?php echo $old_title; ?>" id="<?php echo $this->get_field_id('wpa_title') ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('wpa_description') ?>">Description</label>
            <textarea class="widefat" name="<?php echo $this->get_field_name('wpa_description') ?>" id="<?php echo $this->get_field_id('wpa_description') ?>" cols="30" rows="10"><?php echo $old_description; ?></textarea>
        </p>
        <?php
    }

    // To save form data
    public function update( $new_instance, $old_instance ) {

        $instance = [];

        $instance['wpa_title'] = isset($new_instance['wpa_title']) ? sanitize_text_field($new_instance['wpa_title']) : "";

        $instance['wpa_description'] = isset($new_instance['wpa_description']) ? sanitize_textarea_field($new_instance['wpa_description']) : "";

        return $instance;
    }

    // Render Widget to Frontend
    public function widget( $args, $instance ) {

        ?>
        <style>
            /* CSS for the Announcement Widget */

            /* Widget Container */
            .widget_wpa_announcement {
                background-color: #f9f9f9;
                padding: 20px;
                border: 1px solid #ddd;
                margin-bottom: 25px;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                text-align: center;
            }

            /* Widget Title */
            .widget_wpa_announcement h2 {
                margin-top: 0;
                font-size: 24px;
                color: #333;
            }

            /* Banner Image */
            .widget_wpa_announcement img {
                max-width: 47%;
                height: auto;
                margin-bottom: 15px;
            }

            /* Description */
            .widget_wpa_announcement .widget-description {
                font-size: 16px;
                line-height: 1.5;
                color: #666;
            }
        </style>
        <?php
        
        echo $args['before_widget'];
        
            echo $args['before_title'];

                echo $instance['wpa_title'];

            echo $args['after_title'];

            echo '<img src="'.WPA_PLUGIN_URL.'images/sound.png" style="width: 130px;"/>';

            echo '<div class="widget-description">'.wpautop($instance['wpa_description']).'</div>';

        echo $args['after_widget'];
    }
}