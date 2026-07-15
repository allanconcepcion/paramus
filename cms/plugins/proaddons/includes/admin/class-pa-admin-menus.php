<?php
/**
 * Setup menus in WP Admin
 *
 * @package ProAddons\Admin
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

/**
 * PA_Admin_Menus class.
 */
class PA_Admin_Menus {

  /**
   * Constructor
   */
  public function __construct() {
    add_action( 'admin_menu', [ $this, 'admin_menu' ], 9 );
    add_action( 'admin_menu', [ $this, 'sitemap_reader_menu' ], 20 );
    add_action( 'admin_menu', [ $this, 'importer_menu' ], 20 );
    add_action( 'admin_menu', [ $this, 'search_and_replace_menu' ], 20 );
    add_action( 'admin_menu', [ $this, 'dev_seo_qc_menu' ], 20 );
    add_action( 'admin_init', [ $this, 'sitemap_reader_page' ] );
    add_action( 'admin_init', [ $this, 'pa_importer_page' ] );
    add_action( 'admin_init', [ $this, 'pa_search_and_replace_page' ] );
    add_action( 'admin_init', [ $this, 'pa_dev_seo_qc_page' ] );
  }

  /**
   * Add menu item.
   */
  public function admin_menu() {
    add_menu_page(
      __( 'ProAddons', 'proaddons' ), // Page Title
      __( 'ProAddons', 'proaddons' ), // Menu Title
      'manage_options', // Capability
      'proaddons', // Menu Slug
      null, // Function
      'dashicons-heart', // Icon Url
      '55.5' // Position
    );
  }

  /**
   * Add menu item.
   */
  public function sitemap_reader_menu() {
    $sitemap_reader_page = add_submenu_page(
      'proaddons',
      __( 'Sitemap Reader', 'proaddons' ),
      __( 'Sitemap Reader', 'proaddons' ),
      'manage_options', 
      'pa-sitemap-reader',
      function() {}
    );
    add_action('load-' . $sitemap_reader_page, [ $this, 'sitemap_reader_page' ]);
  }

  /**
   * Add menu item.
   */
  public function importer_menu() {
   
    $sitemap_reader_page = add_submenu_page(
      'proaddons',
      __( 'Import/Export', 'proaddons' ),
      __( 'Import/Export', 'proaddons' ),
      'manage_options', 
      'pa-importer',
      function() {}
    );
    add_action('load-' . $sitemap_reader_page, [ $this, 'pa_importer_page' ]);
  }

  /**
   * Add menu item.
   */
  public function search_and_replace_menu() {
   
    $search_and_replace_page = add_submenu_page(
      'proaddons',
      __( 'Search and Replace', 'proaddons' ),
      __( 'Search and Replace', 'proaddons' ),
      'manage_options', 
      'pa-search-and-replace',
      function() {}
    );
    add_action('load-' . $search_and_replace_page, [ $this, 'pa_search_and_replace_page' ]);
  }

  /**
   * Add menu item.
   */
  public function dev_seo_qc_menu() {
   
    $dev_seo_qc_page = add_submenu_page(
      'proaddons',
      __( 'Dev & SEO QC', 'proaddons' ),
      __( 'Dev & SEO QC', 'proaddons' ),
      'manage_options', 
      'pa-dev-and-seo-qc',
      function() {}
    );
    add_action('load-' . $dev_seo_qc_page, [ $this, 'pa_dev_seo_qc_page' ]);
  }


  /**
   * Load sitemap reader page.
   */
  public function sitemap_reader_page() {
    if ( empty( $_GET['page'] ) || 'pa-sitemap-reader' !== $_GET['page'] ) { // WPCS: CSRF ok, input var ok.
      return;
    }
    ob_start();
    $this->setup_wizard_header();
    require( PA_ABSPATH . 'includes/admin/views/html-admin-sitemap-reader.php' );
    //$this->setup_wizard_steps();
    //$this->setup_wizard_content();
    $this->setup_wizard_footer();
    exit;
  }

  /**
   * Load sitemap reader page.
   */
  public function pa_importer_page() {
    if ( empty( $_GET['page'] ) || 'pa-importer' !== $_GET['page'] ) { // WPCS: CSRF ok, input var ok.
      return;
    }
    ob_start();
    $this->setup_wizard_header();
    require( PA_ABSPATH . 'includes/admin/views/html-admin-importer.php' );
    //$this->setup_wizard_steps();
    //$this->setup_wizard_content();
    $this->setup_wizard_footer();
    exit;
  }

  /**
   * Load sitemap reader page.
   */
  public function pa_search_and_replace_page() {
    if ( empty( $_GET['page'] ) || 'pa-search-and-replace' !== $_GET['page'] ) { // WPCS: CSRF ok, input var ok.
      return;
    }
    ob_start();
    $this->setup_wizard_header();
    require( PA_ABSPATH . 'includes/admin/views/html-admin-search-and-replace.php' );
    //$this->setup_wizard_steps();
    //$this->setup_wizard_content();
    $this->setup_wizard_footer();
    exit;
  }

  /**
   * Load sitemap reader page.
   */
  public function pa_dev_seo_qc_page() {
    if ( empty( $_GET['page'] ) || 'pa-dev-and-seo-qc' !== $_GET['page'] ) { // WPCS: CSRF ok, input var ok.
      return;
    }
    ob_start();
    $this->setup_wizard_header();
    require( PA_ABSPATH . 'includes/admin/views/html-admin-dev-and-seo-qc.php' );
    //$this->setup_wizard_steps();
    //$this->setup_wizard_content();
    $this->setup_wizard_footer();
    exit;
  }

  /**
   * Setup Wizard Header.
   */
  public function setup_wizard_header() {
    set_current_screen();
    ?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
    <head>
      <meta name="viewport" content="width=device-width" />
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title><?php esc_html_e( 'WooCommerce &rsaquo; Setup Wizard', 'woocommerce' ); ?></title>
      <?php do_action( 'admin_enqueue_scripts' ); ?>
      <?php wp_print_scripts( 'wc-setup' ); ?>
      <?php do_action( 'admin_print_styles' ); ?>
      <?php do_action( 'admin_head' ); ?>
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,700i|Raleway:400,500,700" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css?family=Raleway:400,500,700" rel="stylesheet">
    </head>
    <body class="pa-setup wp-core-ui">
    <?php
  }

  /**
   * Setup Wizard Footer.
   */
  public function setup_wizard_footer() {
    ?>
      <?php if ( 'store_setup' === $this->step ) : ?>
        <a class="wc-setup-footer-links" href="<?php echo esc_url( admin_url() ); ?>"><?php esc_html_e( 'Not right now', 'woocommerce' ); ?></a>
      <?php elseif ( 'recommended' === $this->step || 'activate' === $this->step ) : ?>
        <a class="wc-setup-footer-links" href="<?php echo esc_url( $this->get_next_step_link() ); ?>"><?php esc_html_e( 'Skip this step', 'woocommerce' ); ?></a>
      <?php endif; ?>
      <?php do_action( 'admin_print_footer_scripts' ); ?>
      </body>
    </html>
    <?php
  }

}

return new PA_Admin_Menus();