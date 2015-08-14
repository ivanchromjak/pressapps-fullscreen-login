<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://pressapps.co/
 * @since             1.0.0
 * @package           Pressapps_Fullscreen_Login
 *
 * @wordpress-plugin
 * Plugin Name:       Fullscreen Login
 * Plugin URI:        http://pressapps.co/fullscreen-login/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            PressApps Team
 * Author URI:        http://pressapps.co/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       pressapps-fullscreen-login
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Skelet Config Path
 */

$skelet_paths[] = array(
    'prefix'      => 'pafl',
    'dir'         => wp_normalize_path(  plugin_dir_path( __FILE__ ).'/admin/' ),
    'uri'         => plugin_dir_url( __FILE__ ).'/admin/skelet',
);


/**
 * Load Skelet Framework
 */
if( ! class_exists( 'Skelet_LoadConfig' ) ){
        include_once dirname( __FILE__ ) .'/admin/skelet/skelet.php';
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-pressapps-fullscreen-login-activator.php
 */
function activate_pressapps_fullscreen_login() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pressapps-fullscreen-login-activator.php';
	Pressapps_Fullscreen_Login_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-pressapps-fullscreen-login-deactivator.php
 */
function deactivate_pressapps_fullscreen_login() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-pressapps-fullscreen-login-deactivator.php';
	Pressapps_Fullscreen_Login_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_pressapps_fullscreen_login' );
register_deactivation_hook( __FILE__, 'deactivate_pressapps_fullscreen_login' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-pressapps-fullscreen-login.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_pressapps_fullscreen_login() {

	$plugin = new Pressapps_Fullscreen_Login();
	$plugin->run();

}
run_pressapps_fullscreen_login();
