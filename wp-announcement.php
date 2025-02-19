<?php

/*
* Plugin Name: WP Announcement
* Description: This is a wordpress plugin which we can use to give some information to site users
* Author: Nikhil Pachange 
* Version: 1.0
*/

define("WPA_PLUGIN_URL", plugin_dir_url(__FILE__));
define("WPA_PLUGIN_PATH", plugin_dir_path(__FILE__));

include_once WPA_PLUGIN_PATH . 'class/app_announcement.php';

// Action hook for widgets init
add_action("widgets_init", "register_wpa_widget");

// Define a function to register a widget
function register_wpa_widget(){

    // Register widget concept
    register_widget("App_Announcement");
}