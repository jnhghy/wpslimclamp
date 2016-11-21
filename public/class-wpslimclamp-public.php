<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Wpslimclamp
 * @subpackage Wpslimclamp/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wpslimclamp
 * @subpackage Wpslimclamp/public
 * @author     Alexandru Jantea <jnhghy@gmail.com>
 */
class Wpslimclamp_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wpslimclamp-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( 'slimclampjs', plugin_dir_url( __FILE__ ) . 'js/slimclamp.min.js', array( 'jquery' ), $this->version, false );
		
		wp_register_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wpslimclamp-public.js', array( 'jquery', 'slimclampjs' ), $this->version, false );

		$currentClamps = array(
			'clamps' => get_option( 'wpslimclamp_selector' ),
		);

		wp_localize_script( $this->plugin_name, 'currentClumps', $currentClamps );

		wp_enqueue_script( $this->plugin_name );

	}

}
