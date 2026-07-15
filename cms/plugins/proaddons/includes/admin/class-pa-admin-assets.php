<?php
/**
 * Load admin assets
 *
 * @package ProAddons/Admin
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

if ( ! class_exists( 'PA_Admin_Assets', false ) ) :

  /**
   * PA_Admin_Assets class.
   */
  class PA_Admin_Assets {

    /**
     * Constructor
     */
    public function __construct() {
      add_action( 'admin_enqueue_scripts', [ $this, 'admin_styles' ] );
      add_action( 'admin_enqueue_scripts', [ $this, 'admin_scripts' ] );
      add_action( 'wp_enqueue_scripts', [ $this, 'frontend_proaddons_scripts' ] );
    }

    /**
     * Enqueue styles.
     */
    public function admin_styles() {
      wp_enqueue_style( 'proaddons_animate', PA()->plugin_url() . '/assets/css/animate.css', array(), PA_VERSION );
      wp_enqueue_style( 'proaddons_select2', PA()->plugin_url() . '/assets/css/select2.min.css', array(), PA_VERSION );
      wp_enqueue_style( 'proaddons_swiper', PA()->plugin_url() . '/assets/css/swiper.min.css', array(), PA_VERSION );
      wp_enqueue_style( 'proaddons_admin', PA()->plugin_url() . '/assets/css/1551361924-proaddons-admin.css', array(), PA_VERSION );
    }

    /**
     * Enqueue scripts.
     */
    public function admin_scripts() {
      wp_enqueue_script( 'proaddons_mustache', PA()->plugin_url() . '/assets/js/mustache.js', array( 'jquery' ), PA_VERSION );
      wp_enqueue_script( 'proaddons_select2', PA()->plugin_url() . '/assets/js/select2.min.js', array( 'jquery' ), PA_VERSION );
      wp_enqueue_script( 'proaddons_swiper', PA()->plugin_url() . '/assets/js/swiper.min.js', array( 'jquery' ), PA_VERSION );
      wp_enqueue_script( 'proaddons_admin', PA()->plugin_url() . '/assets/js/1551361924-proaddons-admin.js', array( 'jquery' ), PA_VERSION );
      wp_localize_script( 'proaddons_admin', 'proaddons_ajax', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
    }
    
    public function frontend_proaddons_scripts() {
      wp_enqueue_script( 'proaddons_js', PA()->plugin_url() . '/assets/js/1551361924-proaddons.js', array( 'jquery' ), PA_VERSION, true );
    }
  }
endif;

return new PA_Admin_Assets();
