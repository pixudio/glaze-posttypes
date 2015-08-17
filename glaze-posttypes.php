<?php
/**
 * Plugin Name: Glaze Post Types
 * Plugin URI: http://pixudio.com
 * Description: Glaze theme's cutom post type.
 * Version: 1.0
 * Author: pixudio.com
 * Author URI: http://pixudio.com
 * Requires at least: 3.4
 * Text Domain: pixudio
 * License: GPL2
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

/**
 * Load posttypes
 *
 * @return null
 **/
foreach ( glob( plugin_dir_path( __FILE__ ) . "posttypes/*.php" ) as $file ){

	include_once $file;
}