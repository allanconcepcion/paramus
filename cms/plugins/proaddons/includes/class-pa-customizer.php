<?php
/**
 * Adds options to the customizer for ProAddons.
 *
 * @version 1.0.0
 * @package ProAddons
 */

if( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

/**
 * PA_Customizer class.
 */
class PA_Customizer {

  /**
   * Main PA_Customizer Instance.
   *
   * Ensures only one instance of PA_Customizer is loaded or can be loaded.
   *
   * @since 1.0.0
   * @static
   * @return PA_Customizer Main instance
   */
  public static function instance() {
    if ( is_null( self::$_instance ) ) {
      self::$_instance = new self();
    }
    return self::$_instance;
  }

  /**
   * Constructor.
   */
  public function __construct() {
    //require_once PA_ABSPATH . 'includes/libraries/class-kirki-installer-section.php';

    $this->build_typgography_controls();
  }

  /**
   * Require Theme Specific Configurationn Customizer Panels / Fields
   */
  public function build_typgography_controls() {

    // Default Options
    //include_once dirname( __FILE__ ) . '/panels/panel-default.php';

    // Theme-specific Options: Theme 4 (Mueller)
    //include_once dirname( __FILE__ ) . '/panels/panel-theme4.php';

    // Theme-specific Options: Theme 7 (New Theme Name Here)
    //include_once dirname( __FILE__ ) . '/panels/panel-theme7.php';

  }
}

new PA_Customizer();