<?php
/**
 * Plugin Name: ProAddons
 * Description: ProAddons helps streamline the way you and your team work. This plugin aims to make web designing processes as efficient as possible. Customize the themes colors and fonts, w3c validate pages, broken link checks, add meta data, update alt tags, export/import page templates, and install themes.
 * Plugin URI: https://progressivedental.com/
 * Author: Progressive Dental
 * Version: 1.0.19
 * Author URI: https://progressivedental.com/
 *
 * Text Domain: pro-addons
*/

if( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}

//require_once('wp-updates-plugin.php');
//new WPUpdatesPluginUpdater_2053( 'http://wp-updates.com/api/2/plugin', plugin_basename(__FILE__));

// Define PA_PLUGIN_FILE.
if ( ! defined( 'PA_PLUGIN_FILE' ) ) {
  define( 'PA_PLUGIN_FILE', __FILE__ );
}

// Include the main ProAddons class.
if( ! class_exists( 'ProAddons' ) ) {
  include_once dirname( __FILE__ ) . '/includes/class-proaddons.php';
}

/**
 * Main instance of ProAddons.
 *
 * Returns the main instance of PA to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return ProAddons
 */
function pa() {
  return ProAddons::instance();
}

$GLOBALS['proaddons'] = pa();
