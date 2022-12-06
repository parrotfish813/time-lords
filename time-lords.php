<?php
/**
 * Plugin Name:       Time Lords
 * Description:       Ever wondered how much time you spend working on a given website. Well wonder no more!
 * Version:           1.0.0
 * Requires at least: 5.2
 * Requires PHP:      8.1
 * Author:            Melina Ramos, Melia Rodriguez, and Brandon Townes
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 *
 * @package timelords
 */

//If someone is trying to access the plugin files without permission, kill the plugin
if(!defined('ABSPATH')) {
    die;
}

include_once ('inc/menu.php');
include_once('inc/visual_menu.php');


