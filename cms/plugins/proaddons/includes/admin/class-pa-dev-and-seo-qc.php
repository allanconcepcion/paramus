<?php
/**
 * Progressive Dev QC
 *
 * Scans the website for development errors.
 *
 * @author      Progressive
 * @category    Admin
 * @package     Progressive/Admin/Dev QC
 * @version     1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

/**
 * Progressive_Url_Updater
 */
class Progressive_Dev_Qc {

  const NONCE = 'progressive-dev-qc';

  public $city = false;

  public $state = false;

  public $output = false;


  /**
   * Constructor
   */
  public function __construct() {

    add_action( 'wp_ajax_nopriv_check_website', array( $this, 'check_website' ) );
    add_action( 'wp_ajax_check_website', array( $this, 'check_website' ) );

    add_action( 'wp_ajax_nopriv_trash_draft_pages', array( $this, 'trash_draft_pages' ) );
    add_action( 'wp_ajax_trash_draft_pages', array( $this, 'trash_draft_pages' ) );

    if( !empty( $_POST[ 'progressive-devqc-submit' ] ) ) {
      add_action( 'init', array( $this, 'maybe_update_content' ) );
    }
  }


  public function check_website() {
    $data = $_GET;

    $this->city = trim( strip_tags( $_GET['city'] ) );
    $this->state = trim( strip_tags( $_GET['state'] ) );

    $links = $this->search_for_links();
    $plugins = $this->check_for_active_plugins();
    $unpublished = $this->check_for_unpuplished_pages();
    $video = $this->check_video_size();
    $pages = $this->check_for_headlines();
    $noindex = $this->search_for_noindex();
    $nofollow = $this->search_for_nofollow();
    $contact = $this->check_for_proper_email();

    $seo = array(
      //$this->remove_seo_schema(),
      $this->check_for_sitemap_xml(),
      //$this->remove_aiseo_data()
    );

    $data = array(
      'success' => 1,
      'links' => $links,
      'plugins' => $plugins,
      'seo' => $seo,
      'unpublished' => $unpublished,
      'video' => $video,
      'pages' => $pages,
      'noindex' => $noindex,
      'nofollow' => $nofollow,
      'contact' => $contact
    );

    wp_send_json_success( $data );
  }

  public function maybe_update_content() {
    if( !wp_verify_nonce( $_POST[ self::NONCE ], self::NONCE ) ){
      wp_die( __('Ouch! That hurt! You should not be here!', 'progressive' ) );
    }


    // Update variables
    //$this->usebanda = trim( strip_tags( $_POST['usebanda'] ) );
    $this->city = trim( strip_tags( $_POST['city'] ) );
    $this->state = trim( strip_tags( $_POST['state'] ) );

    //$this->search_for_links();
    //$this->check_for_active_plugins();
    //$this->remove_seo_schema();
    //$this->check_for_sitemap_xml();
    //$this->remove_aiseo_data();
    //$this->check_for_headlines();
    $this->check_for_unpuplished_pages();
    echo $this->output;
    die();
  }

  /**
   * Send success message back to the interface
   * @return string Success message
   */
  public function devqc_success() {
    $message = apply_filters( 'progressive-devqc-success-message', __( 'The fields have been updated.', 'progressive' ) );
    ?>
    <div id="message" class="updated fade">
      <p>
        <strong>
          <?php echo $message; ?>
        </strong>
      </p>
    </div>
    <?php
  }

  /**
   * Send fail message back to the interface
   * @return string Fail message
   */
  public function devqc_fail() {
    ?>
    <div id="message" class="error fade">
      <p>
        <strong><?php _e( 'Something went wrong.', 'progressive' ); ?></strong>
      </p>
    </div>
    <?php
  }

  public function search_for_links() {
    global $wpdb;

    $query = "SELECT `post_title`,`meta_id`,`post_id`, `meta_value`
    FROM `wp_postmeta` AS `a1`
    INNER JOIN `wp_posts` AS `a2`
    ON `a1`.`post_id` = `a2`.`ID`
    WHERE `meta_key` = '_elementor_data';";

    $html = [];
    foreach( $wpdb->get_results( $query ) as $key => $row) {
      $find = '[link';

      if( stripos( strtolower( $row->meta_value ), strtolower( $find ) ) !== false ) {
        $html[] = array( 'status' => 'error', 'message' => $row->post_title . ' contains a missing link. <a href="' . get_edit_post_link( $row->post_id ) . '" target="_blank">Edit here.</a>' );
      }
    }

    return $html;
  }

  public function search_for_nofollow() {
    global $wpdb;

    $query = "SELECT `post_title`,`meta_id`,`post_id`, `meta_value`
    FROM `wp_postmeta` AS `a1`
    INNER JOIN `wp_posts` AS `a2`
    ON `a1`.`post_id` = `a2`.`ID`
    WHERE `meta_key` = '_yoast_wpseo_meta-robots-nofollow';";

    $html = [];
    foreach( $wpdb->get_results( $query ) as $key => $row) {
      $find = '[link';

      if( $row->meta_value == '1' ) {
        $html[] = array( 'status' => 'error', 'message' => $row->post_title . ' has a nofollow tag on it.' );
      }
    }

    return $html;
  }

  public function check_for_proper_email() {

    global $wpdb;

    $query = "SELECT `post_title`,`meta_id`,`post_id`, `meta_value`
    FROM `wp_postmeta` AS `a1`
    INNER JOIN `wp_posts` AS `a2`
    ON `a1`.`post_id` = `a2`.`ID`
    WHERE `meta_key` = '_mail'
    AND `a2`.`post_type` = 'wpcf7_contact_form';";

    $html = [];
    foreach( $wpdb->get_results( $query ) as $key => $row) {
      $find = 'appointments@lanapmarketing.com';

      if( stripos( strtolower( $row->meta_value ), strtolower( $find ) ) !== false ) {
        $html[] = array( 'status' => 'error', 'message' => $row->post_title . ' is missing appointments@lanapmarketing.com email address.' );
      }
    }

    return $html;

  }

  public function search_for_noindex() {
    global $wpdb;

    $query = "SELECT `post_title`,`meta_id`,`post_id`, `meta_value`
    FROM `wp_postmeta` AS `a1`
    INNER JOIN `wp_posts` AS `a2`
    ON `a1`.`post_id` = `a2`.`ID`
    WHERE `meta_key` = '_yoast_wpseo_meta-robots-noindex';";

    $html = [];
    foreach( $wpdb->get_results( $query ) as $key => $row) {
      $find = '[link';

      if( $row->meta_value == '1' ) {
        $html[] = array( 'status' => 'error', 'message' => $row->post_title . ' has a noindex tag on it.' );
      }
    }

    return $html;
  }

  /**
   * Checks to see if All In One SEO and Brute Force Proection are enabled.
   * @return string Plugin state.
   */
  public function check_for_active_plugins() {
    $plugins = array(
      array(
        'title' => 'Yoast SEO',
        'status' => 'Active'
      ),
      array(
        'title' => 'Limit Attempts',
        'status' => 'Active'
      )
    );
    if( !is_plugin_active( 'wordpress-seo/wp-seo.php' ) ) {
      $plugins[0]['status'] = 'Inactive';
    }

    if( !is_plugin_active( 'limit-attempts/limit-attempts.php' ) ) {
      $plugins[1]['status'] = 'Inactive';
    }

    return $plugins;
  }

  public function check_for_unpuplished_pages() {

    $args = array(
      'post_status' => 'draft',
    );

    $drafts = get_pages( $args );
    $pages = array();

    foreach( $drafts as $page ) {
      $pages[] = array(
        'post_id' => $page->ID,
        'post_title' => $page->post_title,
        'author' => get_the_author_meta( 'user_nicename', $page->post_author ),
      );

    }
    return $pages;
  }

  public function trash_draft_pages( ) {
    $data = $_GET;
    if( wp_trash_post( $data['id'] ) ) {
      wp_send_json_success( );
    }

  }

  public function check_for_sitemap_xml() {
    $filename = 'sitemap.xml';

    $sitemap = array(
      'title' => 'Sitemap.xml',
      'status' => ''
    );

    $handle = curl_init( esc_url( home_url( '/sitemap.xml') ) );
    curl_setopt( $handle, CURLOPT_RETURNTRANSFER, TRUE );

    $response = curl_exec( $handle );
    $httpCode = curl_getinfo( $handle, CURLINFO_HTTP_CODE );

    if( $httpCode == 404 ) {
      $sitemap['status'] = 'Not Found';
    } else {
       $sitemap['status'] = 'Found';
    }

    curl_close( $handle );
    return $sitemap;
  }

  public function remove_seo_schema() {

    $option_name = 'kcseo_wp_schema';

    $seoStatus = array(
      'title' => 'WP SEO Schema',
      'status' => ''
    );

    if( get_option( $option_name ) !== false ) {
      update_option( $option_name, '' );
      $seoStatus['status'] = 'Found and Removed';
    } else {
      $seoStatus['status'] = 'Option not found';
    }

    return $seoStatus;

  }

  public function remove_aiseo_data() {

    $option_name = 'aioseop_options';

    $seoStatus = array(
      'title' => 'WP SEO Schema',
      'status' => ''
    );

    if( get_option( $option_name ) !== false ) {
      update_option( $option_name, '' );
      $seoStatus['status'] = 'Found and Removed';
    } else {
      $seoStatus['status'] = 'Option not found';
    }

    return $seoStatus;
  }

  public function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
  }

  public function check_for_headlines() {

    global $wpdb;


    $query = "
      SELECT `post_title`,`meta_id`,`post_id`, `meta_value`
      FROM `wp_postmeta` AS `a1`
      INNER JOIN `wp_posts` AS `a2`
      ON `a1`.`post_id` = `a2`.`ID`
      WHERE `a1`.`meta_key` = '_elementor_data'
      AND `a2`.`post_type` = 'page';";

      $pages = array();

    foreach( $wpdb->get_results( $query ) as $key => $row) {

      if( empty( $row->post_title ) ) {
        continue;
      }

      $count = substr_count( $row->meta_value, 'h1' );

      $parsed = $this->get_string_between($row->meta_value, 'settings":{"title":"', '","header_size":"h1"');
      $pages[$row->post_id] = array(
        'post_id' => $row->post_id,
        'post_title' => $row->post_title,
        'count' => $count,
        'missing' => ''
      );

      if( !empty( $this->city ) && !empty( $this->state ) ) {

        $searchText = $this->city . ', ' . $this->state;

        if( stripos( strtolower( $parsed ), strtolower( $searchText ) ) == false ) {
          $pages[$row->post_id]['missing'] = 'YES';
        } else {
          $pages[$row->post_id]['missing'] = 'NO';
        }

      }


    }

    return $pages;
  }

  function retrieve_remote_file_size($url){
    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, TRUE);
    curl_setopt($ch, CURLOPT_NOBODY, TRUE);

    $data = curl_exec($ch);
    $size = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);

    curl_close($ch);
    return $size;
  }

  public function check_video_size( ) {

    global $wpdb;


    $query = "
      SELECT `post_title`,`meta_id`,`post_id`, `meta_value`
      FROM `wp_postmeta` AS `a1`
      INNER JOIN `wp_posts` AS `a2`
      ON `a1`.`post_id` = `a2`.`ID`
      WHERE `a1`.`meta_key` = '_elementor_data'
      AND `a2`.`post_type` = 'page';";

    foreach( $wpdb->get_results( $query ) as $key => $row) {

      if( empty( $row->post_title ) ) {
        continue;
      }

      if( $row->post_id == get_option( 'page_on_front' ) ) {


        $parsed = $this->get_string_between( $row->meta_value, 'background_video_link":"', '"');
        $fileSize = $this->retrieve_remote_file_size( stripslashes( $parsed ) );

        $size = round( $fileSize / 1024 / 1024,0 );

        if( $size > 10 ) {
          $video = array(
            'location' => stripslashes( $parsed ),
            'size' => $size . 'MB',
            'status' => 'Needs compression'
          );
        } else {
          $video = array(
            'location' => stripslashes( $parsed ),
            'size' => $size . 'MB',
            'status' => 'Good'
          );
        }
      }
    }

    return $video;

  }


}

new Progressive_Dev_Qc();