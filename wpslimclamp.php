<?php

/**
 * The plugin bootstrap file
 *
 * @link              #
 * @since             1.0.0
 * @package           Wpslimclamp
 *
 * @wordpress-plugin
 * Plugin Name:       wpslimclamp
 * Plugin URI:        #
 * Description:       Clamp text to fit containers, easy way to limit text to specific row number.
 * Version:           1.0.0
 * Author:            <a href="mailto:jnhghy@gmail.com">Alexandru Jantea</a>
 * Author URI:        https://wordpress.org/support/users/jnhghy/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wpslimclamp
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wpslimclamp-activator.php
 */
function activate_wpslimclamp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wpslimclamp-activator.php';
	Wpslimclamp_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wpslimclamp-deactivator.php
 */
function deactivate_wpslimclamp() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wpslimclamp-deactivator.php';
	Wpslimclamp_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wpslimclamp' );
register_deactivation_hook( __FILE__, 'deactivate_wpslimclamp' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wpslimclamp.php';

/**
 * Add settings page link to WordPress Plugins list page
 * @since    1.0.0
 */
function plugin_add_settings_link( $links ) {
    $settings_link = '<a href="options-general.php?page=wpslimclamp">' . __( 'Settings' ) . '</a>';
    array_push( $links, $settings_link );
  	return $links;
}
$plugin = plugin_basename( __FILE__ );
add_filter( "plugin_action_links_$plugin", 'plugin_add_settings_link' );

/**
 * @since    1.0.0
 */
function run_wpslimclamp() {

	$plugin = new Wpslimclamp();
	$plugin->run();

}
run_wpslimclamp();
