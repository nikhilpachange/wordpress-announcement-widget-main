<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

include_once ABSPATH . 'wp-load.php';

class App_Announcement extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'wpa_announcement',
            'WPA Announcement',
            [ 'description' => 'Custom widget for WordPress announcements.' ]
        );
    }

    // Admin form
    public function form( $instance ) {
        $title = esc_attr( $instance['wpa_title'] ?? '' );
        $desc  = esc_textarea( $instance['wpa_description'] ?? '' );
        ?>
        <p>
            <label for="<?= $this->get_field_id('wpa_title'); ?>">Title</label>
            <input class="widefat" id="<?= $this->get_field_id('wpa_title'); ?>"
                name="<?= $this->get_field_name('wpa_title'); ?>" type="text" value="<?= $title; ?>">
        </p>
        <p>
            <label for="<?= $this->get_field_id('wpa_description'); ?>">Description</label>
            <textarea class="widefat" id="<?= $this->get_field_id('wpa_description'); ?>"
                name="<?= $this->get_field_name('wpa_description'); ?>" rows="6"><?= $desc; ?></textarea>
        </p>
        <?php
    }

    // Save widget data
    public function update( $new, $old ) {
        return [
            'wpa_title'       => sanitize_text_field( $new['wpa_title'] ?? '' ),
            'wpa_description' => sanitize_textarea_field( $new['wpa_description'] ?? '' ),
        ];
    }

    // Frontend output
    public function widget( $args, $instance ) {
        $title = esc_html( $instance['wpa_title'] ?? '' );
        $desc  = wpautop( esc_html( $instance['wpa_description'] ?? '' ) );

        echo $args['before_widget']; ?>
        <style>
            .widget_wpa_announcement {
                background: #f9f9f9; padding: 20px; border: 1px solid #ddd;
                border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,.1);
                text-align: center; margin-bottom: 25px;
            }
            .widget_wpa_announcement h2 { font-size: 22px; margin: 0 0 10px; color: #333; }
            .widget_wpa_announcement img { width: 120px; margin: 10px 0; }
            .widget_wpa_announcement .widget-description { font-size: 15px; color: #666; }
        </style>
        <div class="widget_wpa_announcement">
            <?= $args['before_title'] . $title . $args['after_title']; ?>
            <img src="<?= esc_url( WPA_PLUGIN_URL . 'images/sound.png' ); ?>" alt="Announcement">
            <div class="widget-description"><?= $desc; ?></div>
        </div>
        <?php
        echo $args['after_widget'];
    }
}
