<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://helloeveryone.me/
 * @since             1.0.0
 * @package           Auto_Delete_Images
 *
 * @wordpress-plugin
 * Plugin Name:       Auto Delete Images
 * Plugin URI:        https://github.com/nach94/auto-delete-images/
 * Description:       This plugin allows you to automatically remove images from products or posts you delete, as long as the images aren't used elsewhere.
 * Version:           1.0.0
 * Author:            HelloEveryone
 * Author URI:        https://helloeveryone.me//
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       auto-delete-images
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'AUTO_DELETE_IMAGES_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-auto-delete-images-activator.php
 */
function activate_auto_delete_images() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-auto-delete-images-activator.php';
	Auto_Delete_Images_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-auto-delete-images-deactivator.php
 */
function deactivate_auto_delete_images() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-auto-delete-images-deactivator.php';
	Auto_Delete_Images_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_auto_delete_images' );
register_deactivation_hook( __FILE__, 'deactivate_auto_delete_images' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-auto-delete-images.php';
require_once plugin_dir_path(__FILE__) . 'includes/class-auto-delete-images-cleanup.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_auto_delete_images() {

	$plugin = new Auto_Delete_Images();
	$plugin->run();

}
run_auto_delete_images();
