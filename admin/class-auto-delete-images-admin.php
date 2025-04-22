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
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
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
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */

	public function add_plugin_admin_menu() {
		add_menu_page(
			'Auto Delete Images', // Título de la página
			'Auto Delete Images', // Título del menú
			'manage_options',     // Capacidad requerida
			'auto-delete-images', // Slug del menú
			array( $this, 'display_plugin_admin_page' ), // Callback del contenido
			'dashicons-trash',    // Icono del menú
			81                    // Posición del menú
		);
	}

	/**
	 * Contenido de la página de administración.
	 */
	public function display_plugin_admin_page() {
		include_once plugin_dir_path( __FILE__ ) . 'partials/auto-delete-images-admin-display.php';
	}

	
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Auto_Delete_Images_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Auto_Delete_Images_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/auto-delete-images-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Auto_Delete_Images_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Auto_Delete_Images_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/auto-delete-images-admin.js', array( 'jquery' ), $this->version, false );

	}

}
