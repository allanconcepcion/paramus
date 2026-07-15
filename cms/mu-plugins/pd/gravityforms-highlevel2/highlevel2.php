<?php

define('GF_HIGH_LEVEL2_VERSION', '2.0');


// After GF is loaded, load the add-on.
add_action('gform_loaded', array('GF_HighLevel2_Bootstrap', 'load_addon'), 5 );


/**
 * Loads the Gravity Forms HighLevel Add-On.
 *
 * Includes the main class and registers it with GFAddOn.
 *
 * @since 2.0
 */
class GF_HighLevel2_Bootstrap {

  /**
   * Loads the required files.
   *
   * @since 2.0
   * @access public
   * @static
   */
  public static function load_addon() {

    // Requires the class file.
    require_once WPMU_PLUGIN_DIR . '/pd/gravityforms-highlevel2/class-gf-highlevel2.php';
    
    // Registers the class name with GFAddOn.
    GFAddOn::register('GF_HighLevel2');
  }
}

/**
 * Returns an instance of the GF_HighLevel class
 *
 * @since 1.0
 * @return GF_HighLevel2 An instance of the GF_HighLevel2 class
 */
function gf_highlevel2() {
  return GF_HighLevel2::get_instance();
}
