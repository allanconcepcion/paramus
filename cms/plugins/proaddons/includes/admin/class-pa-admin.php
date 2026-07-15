<?php
/**
 * ProAddons Admin
 *
 * @class    PA_Admin
 * @author   Progressive Dental
 * @category Admin
 * @package  ProAddons/Admin
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

/**
 * PA_Admin class.
 */
class PA_Admin {

  /**
   * Constructor
   */
  public function __construct() {
    add_action( 'init', [ $this, 'includes' ] );
  }

  /**
   * Include any classes we need within admin.
   */
  public function includes() {
    include_once PA_ABSPATH . 'includes/admin/class-pa-admin-assets.php';
    include_once PA_ABSPATH . 'includes/admin/class-pa-admin-menus.php';
    include_once PA_ABSPATH . 'includes/admin/class-pa-sitemap-reader.php';
    include_once PA_ABSPATH . 'includes/admin/class-pa-importer.php';
    include_once PA_ABSPATH . 'includes/admin/class-pa-search-and-replace.php';
    include_once PA_ABSPATH . 'includes/admin/class-pa-dev-and-seo-qc.php';
    //include_once PA_ABSPATH . 'includes/admin/class-wc-admin-menus.php';
  }
}

return new PA_Admin();