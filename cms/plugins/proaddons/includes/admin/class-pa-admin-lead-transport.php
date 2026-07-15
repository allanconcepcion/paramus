<?php
/**
 * ProAddons Lead Transporter
 *
 * Imports pages from another site using the Wordpress REST Api v2.
 *
 * @author      Progressive
 * @category    Admin
 * @package     Progressive/Admin/Importer
 * @version     1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

/**
 * Progressive_Url_Updater
 */
class PA_Lead_Transporter {

  const NONCE = 'pa-importer';

  public $sitemap = false;

  public $metadata = false;

  public $items = false;

  /**
   * Constructor
   */
  public function __construct() {

    add_action( 'wp_ajax_nopriv_pd_receive_lead', array( $this, 'pd_receive_lead' ) );
    add_action( 'wp_ajax_pd_receive_lead', array( $this, 'pd_receive_lead' ) );

    add_action( 'wp_ajax_nopriv_transport_lead', array( $this, 'pd_transport_lead' ) );
    add_action( 'wp_ajax_transport_lead', array( $this, 'pd_transport_lead' ) );

    add_action( 'rest_api_init', array( $this, 'register_custom_rest_endpoint' ) );

    //$this->register_custom_meta_data();

    if( !empty( $_POST[ 'progressive-devqc-submit' ] ) ) {
      //add_action( 'init', array( $this, 'maybe_update_content' ) );
    }
  }

  public function register_custom_rest_endpoint() {
    register_rest_route( 'proaddons/v1', '/leads/create_lead', array(
      'methods' => 'GET',
      'callback' => [ $this, 'pa_receive_lead' ]
    ) );
  }
  

  /**
   * Gets all page metadata for import
   * 
   * @return object
   */
  public function pa_receive_lead() {
    check_ajax_nonce( 'PDLEADTRANSPORT' );

    
  }

  public function pd_transport_lead() {
    global $wpdb;

    $pages = $_POST['pages'];
    $site_url = $_POST['siteUrl'];
    $user_id = get_current_user_id();

    foreach( $pages as $page ) {
    
      $post_data_remote = wp_remote_get( $site_url . '/wp-json/wp/v2/pages/' . $page );
      $post_meta_remote = wp_remote_get( $site_url . '/wp-json/proaddons/v1/pages/' . $page );

      $body = json_decode( wp_remote_retrieve_body( $post_data_remote ) );

      $post_meta_body = wp_remote_retrieve_body( $post_meta_remote );
      $post_meta_body = json_decode( $post_meta_body );

      $args = array(
        'ID' => 0,
        'post_type' => 'page',
        'post_title' => $body->title->rendered,
        'post_content' => $body->content->rendered,
        'post_author' => $user_id
      );
      $new_post = wp_insert_post( $args, true );
      
      if( $new_post != 0 ) {
        foreach( $post_meta_body as $key => $value ) {

          $data = [
            'post_id' => $new_post,
            'meta_key' => $value->meta_key,
            'meta_value' => $value->meta_value
          ];
          $wpdb->insert( 'wp_postmeta', $data );
          //update_post_meta( $new_post, $key, $value );

        }
      }
    }
  }


}
new PA_Lead_Transporter();