<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://helloeveryone.me/
 * @since      1.0.0
 *
 * @package    Auto_Delete_Images
 * @subpackage Auto_Delete_Images/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * @package    Auto_Delete_Images
 * @subpackage Auto_Delete_Images/admin
 * @author     HelloEveryone <hola@helloeveryone.me>
 */
class Auto_Delete_Images_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param    string $plugin_name The name of this plugin.
	 * @param    string $version     The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	/**
	 * Add a menu item for the plugin settings page.
	 *
	 * @since    1.0.0
	 */
	public function add_plugin_admin_menu() {
		add_menu_page(
			'AutoDelete Img',
			'AutoDelete Img',
			'manage_options',
			'auto-delete-images',
			array( $this, 'display_plugin_admin_page' ),
			'dashicons-admin-generic',
			81
		);
	}

	public function register_settings() {
		register_setting(
			'auto_delete_images_options_group',
			'_activate_for_products'            
		);
	
		register_setting(
			'auto_delete_images_options_group',
			'_activate_for_posts'
		);

		register_setting(
			'auto_delete_images_options_group',
			'_activate_for_pages'
		);
	
		add_settings_section(
			'auto_delete_images_main_section',
			'',
			null,
			'auto-delete-images'
		);
	}
	

	/**
	 * Display the plugin admin page.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_admin_page() {
		include_once plugin_dir_path( __FILE__ ) . 'partials/auto-delete-images-admin-display.php';
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style(
			$this->plugin_name,
			plugin_dir_url( __FILE__ ) . 'css/auto-delete-images-admin.css',
			array(),
			$this->version,
			'all'
		);
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script(
			$this->plugin_name,
			plugin_dir_url( __FILE__ ) . 'js/auto-delete-images-admin.js',
			array( 'jquery' ),
			$this->version,
			false
		);
	}
}