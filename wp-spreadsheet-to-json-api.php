<?php

/**
 * Plugin Name: Spreadsheet to JSON API
 * Plugin URI: https://ansoncheung.me
 * Description: Convert your excel spreadsheet to a JSON object and exposes APIs
 * Version: 0.0.1
 * Author: Anson Cheung
 * Author URI:  https://ansoncheung.me
 * License: GPLv3
 */
 
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,strpos( $_SERVER["SERVER_PROTOCOL"],'/'))).'://';
define('SITE_URL', $protocol . $_SERVER['SERVER_NAME']);
include(plugin_dir_path(__FILE__) . "/classes/Sheet2JSON.php");

new Sheet2JSON();