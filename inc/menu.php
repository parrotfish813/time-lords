<?php

//If someone is trying to access the plugin files without permission, kill the plugin
if(!defined('ABSPATH')) {
    die;
}

// Adds the Rate Calculation menu
function timelords_add_toplevel_menu() {
    add_menu_page(
        'Time Lords',
        'Time Lords',
        'manage_options',
        'timelords',
        'timelords_display_settings_page',
        'dashicons-clock',
        null
    );
}
add_action('admin_menu', 'timelords_add_toplevel_menu');

