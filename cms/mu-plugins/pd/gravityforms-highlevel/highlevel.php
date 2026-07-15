<?php

define('GF_HIGH_LEVEL_VERSION', '1.0');


// After GF is loaded, load the add-on.
add_action('gform_loaded', array('GF_HighLevel_Bootstrap', 'load_addon'), 5 );


/**
 * Loads the Gravity Forms HighLevel Add-On.
 *
 * Includes the main class and registers it with GFAddOn.
 *
 * @since 1.0
 */
class GF_HighLevel_Bootstrap {

  /**
   * Loads the required files.
   *
   * @since 1.0
   * @access public
   * @static
   */
  public static function load_addon() {

    // Requires the class file.
    require_once WPMU_PLUGIN_DIR . '/pd/gravityforms-highlevel/class-gf-highlevel.php';
    
    // Registers the class name with GFAddOn.
    GFAddOn::register('GF_HighLevel');
  }
}

/**
 * Returns an instance of the GF_HighLevel class
 *
 * @since 1.0
 * @return GF_HighLevel An instance of the GF_HighLevel class
 */
function gf_highlevel() {
  return GF_HighLevel::get_instance();
}
