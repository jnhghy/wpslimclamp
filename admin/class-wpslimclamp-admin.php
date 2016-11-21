<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Wpslimclamp
 * @subpackage Wpslimclamp/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wpslimclamp
 * @subpackage Wpslimclamp/admin
 * @author     Alexandru Jantea <jnhghy@gmail.com>
 */
class Wpslimclamp_Admin {

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
     * The options name to be used in this plugin
     *
     * @since   1.0.0
     * @access  private
     * @var     string      $option_name    Option name of this plugin
     */
    private $option_name = 'wpslimclamp';

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
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

        if ( $_GET['page'] == 'wpslimclamp' ) {
            wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wpslimclamp-admin.css', array(), $this->version, 'all' );
        }

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {

        if ( $_GET['page'] == 'wpslimclamp' ) {
            wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wpslimclamp-admin.js', array( 'jquery' ), $this->version, true );
        }

    }

    /* Add an options page under the Settings submenu
     *
     * @since  1.0.0
     */
    public function add_wpslimclamp_options_page() {
    
        $this->plugin_screen_hook_suffix = add_options_page(
            __( 'WPSlimClamp', 'wpslimclamp' ),
            __( 'WPSlimClamp', 'wpslimclamp' ),
            'manage_options',
            $this->plugin_name,
            array( $this, 'display_options_page' )
        );
    
    }

    /**
     * Render the options page for plugin
     *
     * @since  1.0.0
     */
    public function display_options_page() {
        include_once 'partials/wpslimclamp-admin-display.php';
    }

    /*
     * Settings Registration
     *
     * @since 1.0.0
     */
    public function register_setting() {
        // Add a General section
        add_settings_section(
            $this->option_name . '_general',
            __( 'Settings', 'wpslimclamp' ),
            array( $this, $this->option_name . '_general_cb' ),
            $this->plugin_name
        );

        add_settings_field(
            $this->option_name . '_selector',
            __( 'Selector: ', 'wpslimclamp' ),
            array( $this, $this->option_name . '_selector_cb' ),
            $this->plugin_name,
            $this->option_name . '_general',
            array( 'label_for' => $this->option_name . '_selector' )
        );


        register_setting( $this->plugin_name, $this->option_name . '_selector' );
    }

    /**
     * Render the text for the general section
     *
     * @since  1.0.0
     */
    public function wpslimclamp_general_cb() {
        $selectors_array = get_option( $this->option_name . '_selector' );
        ?>
        <p><?php _e( 'Add or remove clamps.', 'wpslimclamp' ); ?></p>
        <script>
            var clamps =  <?php echo json_encode( $selectors_array, JSON_HEX_TAG); ?>;
        </script>
        <?php

    }

    /**
     * Render the treshold selector input for this plugin
     *
     * @since  1.0.0
     */
    public function wpslimclamp_selector_cb() {
        echo '<input type="text" name="' . $this->option_name . '_selector[selector]' . '" id="' . $this->option_name . '_selector' . '" class="clamp-selector">';
    }



}
