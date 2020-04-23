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

include(plugin_dir_path(__FILE__) . "/classes/Sheet2JSON.php");
include(plugin_dir_path(__FILE__) . "/classes/CustomFields.php");

new Sheet2JSON();
new CustomFields();