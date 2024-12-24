<?php
/**
 * Plugin Name: JetSmartFilters - Refresh Filter
 * Plugin URI:  
 * Description: 
 * Version:     1.0.1
 * Author:      
 * Author URI:  
 * Text Domain: 
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die();
}

//require_once( 'vendor/autoload.php' );

add_action( 'plugins_loaded', function() {
	require_once trailingslashit( plugin_dir_path( __FILE__ ) ) . 'includes/plugin.php';
	JSF_Refresh_Filter\Plugin::instance();
}, 100 );

if ( ! function_exists( 'jet_smart_filters_refresh_filter' ) ) {
	function jet_smart_filters_refresh_filter() {
		return JSF_Refresh_Filter\Plugin::instance();
	}
}
