<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://helloeveryone.me/
 * @since      1.0.0
 *
 * @package    Auto_Delete_Images
 * @subpackage Auto_Delete_Images/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Auto_Delete_Images
 * @subpackage Auto_Delete_Images/includes
 * @author     HelloEveryone <hola@helloeveryone.me>
 */
class Auto_Delete_Images_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'auto-delete-images',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
