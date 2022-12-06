<?php
/**
 * Plugin Name:       Time Lords
 * Description:       Ever found it hard to track how long you spend on a given Wordpress project? Well all you have to do now is clock in and out in the plugins menu and it will keep track of your hours for you. On top of that you can then enter in your hourly rates to determine how much it cost to make the website!
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


