<?php
/**
 * ProAddons setup
 *
 * @package ProAddons
 * @since   1.0.0
 */

if( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

/**
 * Main ProAddons Class.
 *
 * @class ProAddons
 */
final class ProAddons {

  /**
   * WooCommerce version.
   *
   * @var string
   */
  private static $version = '1.0.17';

  /**
   * The single instance of the class.
   *
   * @var WooCommerce
   * @since 1.0.0
   */
  private static $_instance = null;

  /**
   * Instance.
   *
   * Ensures only one instance of the plugin class is loaded or can be loaded.
   *
   * @since 1.0.0
   * @access public
   * @static
   *
   * @return ProAddons Main Instance
   */
  public static function instance() {
    if ( is_null( self::$_instance ) ) {
      self::$_instance = new self();
    }

    return self::$_instance;
  }

  /**
   * Throw error on object clone
   *
   * The whole idea of the singleton design pattern is that there is a single object therefore, we don't want the object to be clones.
   *
   * @since 1.0.0
   *
   * @return void
   */
  public function __clone() {
    // Cloning instances of the class is forbidden
    _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), $this->version );
  }

  /**
   * Disable unserializing of the class
   *
   * @since 1.0.0
   *
   * @return void
   */
  public function __wakeup() {
    // Unserializing instances of the class is forbidden
    _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), $this->version );
  }

  /**
   * Plugin constructor
   */
  private function __construct() {
    $this->define_constants();
    $this->includes();

    /**
     * ProAddons init.
     *
     * Fires on ProAddons load.
     *
     * @since 1.0.0
     */
    do_action( 'proaddons_loaded' );
  }

  /**
   * Define ProAddons Constants
   */
  private function define_constants() {
    $this->define( 'PA_ABSPATH', dirname( PA_PLUGIN_FILE ) . '/' );
    $this->define( 'PA_PLUGIN_BASENAME', plugin_basename( PA_PLUGIN_FILE ) );
    $this->define( 'PA_VERSION', self::$version );
  }

  /**
   * Define constant if not already set.
   *
   * @param string      $name  Constant name.
   * @param string|bool $value Constant value.
   */
  private function define( $name, $value ) {
    if ( ! defined( $name ) ) {
      define( $name, $value );
    }
  }

  public function includes() {
    include_once PA_ABSPATH . 'includes/admin/class-pa-admin.php';
    include_once PA_ABSPATH . 'includes/class-pa-customizer.php';
  }

  /**
   * Init.
   *
   * Initialize ProAddons Plugin. Register ProAddons support for all the
   * supported post types and initialize ProAddons components.
   *
   * @since 1.0.0
   * @access public
   */
  public function init() {

    /**
     * Before ProAddons init.
     *
     * Fires before ProAddons init.
     *
     * @since 1.0.0
     */
    do_action( 'before_proaddons_init' );

    // Set up localisation
    $this->load_plugin_textdomain();

    add_action( 'tgmpa_register', [ $this, 'pa_register_required_plugins' ] );

    /**
     * ProAddons init.
     *
     * Fires on ProAddons init, after ProAddons has finished loading but
     * before any headers are sent.
     *
     * @since 1.0.0
     */
    do_action( 'proaddons_init' );
  }

  /**
   * Load ProAddons textdomain
   *
   * Load gettext translate for ProAddons text domain.
   *
   * @since 1.0.0
   *
   * @return void
   */
  function pro_addons_load_plugin_textdomain() {
    load_plugin_textdomain( 'pro-addons' );
  }

  /**
   * Get the plugin url.
   *
   * @return string
   */
  public function plugin_url() {
    return untrailingslashit( plugins_url( '/', PA_PLUGIN_FILE ) );
  }

  /**
   * Get the plugin path.
   *
   * @return string
   */
  public function plugin_path() {
    return untrailingslashit( plugin_dir_path( PA_PLUGIN_FILE ) );
  }

  /**
   * Get Ajax URL.
   *
   * @return string
   */
  public function ajax_url() {
    return admin_url( 'admin-ajax.php', 'relative' );
  }

  /**
   * Register the required plugins for this plugin.
   */
  function pa_register_required_plugins() {
    $plugins = array(
      // array(
      //   'name'      => 'BuddyPress',
      //   'slug'      => 'buddypress',
      //   'required'  => false,
      // )
    );

    $config = array(
      'id'           => 'pro-addons',
      'default_path' => '',
      'menu'         => 'tgmpa-install-plugins',
      'parent_slug'  => 'plugins.php',
      'capability'   => 'manage_options',
      'has_notices'  => true,
      'dismissable'  => true,
      'dismiss_msg'  => '',
      'is_automatic' => false,
      'message'      => '',
    );

    tgmpa( $plugins, $config );
  }
}
