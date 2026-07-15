<?php
/**
 * ProAddons Sitemap Reader
 *
 * Reads an uploaded xlsx file to retrieve meta data, publish or duplicate pages.
 * Tab must be called 'PermalinkMeta Info'
 *
 * @author      Progressive
 * @category    Admin
 * @package     Progressive/Admin/Sitemap Reader
 * @version     1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

/**
 * Progressive_Url_Updater
 */
class PA_Sitemap_Reader {

  const NONCE = 'pa-sitemap-reader';

  public $sitemap = false;

  public $metadata = false;

  public $items = false;

  /**
   * Constructor
   */
  public function __construct() {

    add_action( 'wp_ajax_nopriv_upload_sitemap', array( $this, 'upload_sitemap' ) );
    add_action( 'wp_ajax_upload_sitemap', array( $this, 'upload_sitemap' ) );

    add_action( 'wp_ajax_nopriv_run_sitemap_update', array( $this, 'run_sitemap_update' ) );
    add_action( 'wp_ajax_run_sitemap_update', array( $this, 'run_sitemap_update' ) );

    add_action( 'wp_ajax_nopriv_run_user_sitemap', array( $this, 'run_user_sitemap' ) );
    add_action( 'wp_ajax_run_user_sitemap', array( $this, 'run_user_sitemap' ) );

    require_once( PA_ABSPATH . '/includes/libraries/XLSXReader.php' );

    if( !empty( $_POST[ 'progressive-devqc-submit' ] ) ) {
      //add_action( 'init', array( $this, 'maybe_update_content' ) );
    }
  }

  public function get_sheet_data() {

    if( $_FILES ) {
      foreach( $_FILES as $file => $array) {

        // error_reporting(E_ALL);
        // ini_set('display_errors', 'On');
        
        $xlsx = new XLSXReader( $array['tmp_name'] );
        $sheetNames = $xlsx->getSheetNames();

        foreach( $sheetNames as $sheetName ) {

          if( $sheetName == 'PermalinkMeta Info' ) {
            $sheet = $xlsx->getSheet($sheetName);
            $metadata = $sheet->getData();

            // remove title row
            unset($metadata[0]);

            foreach( $metadata as $key => $map ) {

              // remove integers and rebases array keys
              $metadata[$key] = array_values( array_filter( $map, 'is_string' ) );
            }

            $this->metadata = $metadata;

          }
          if( $sheetName = 'Sitemap' ) {
            $sheet = $xlsx->getSheet( $sheetName );
            $this->sitemap = $sheet->getData();      
          }
          
        }

      }
    }
  }

  public function get_pages() {

    $args = array(
      'post_status' => 'publish'
    );

    $pages = get_pages( $args );
    return $pages;
  }

  public function trash_draft_pages( $pages ) {
    $args = array(
      'exclude' => $pages
    );

    $unusedPages = get_pages( $args );

    foreach( $unusedPages as $page ) {
      wp_trash_post( $page->ID );
    }
  }

  public function create_navigation_menu() {
    $name = 'Main';
    $menu_exists = wp_get_nav_menu_object( $name );    
    if( $menu_exists ) {
      wp_delete_nav_menu( $menu_exists ); 
    }

    $menu_id = wp_create_nav_menu( $name );
    return $menu_id;
  }

  public function run_user_sitemap() {
    $map = $_POST['sitemap'];
    $meta = $_POST['metadata'];
    $pages = $_POST['pages'];

    foreach( $meta as $key => $m ) {
      if ( $m[1] == "/") {
        $home_id = get_option( 'page_on_front' );
        update_post_meta( $home_id, '_yoast_wpseo_title', $m[2] );
        update_post_meta( $home_id, '_yoast_wpseo_metadesc', $m[3] );
      }

      if ( $m[1] == "/blog/") {
        $blog_id = get_option( 'page_for_posts' );
        update_post_meta( $blog_id, '_yoast_wpseo_title', $m[2] );
        update_post_meta( $blog_id, '_yoast_wpseo_metadesc', $m[3] );
      }
    }

    $top = [];
    $menu_id = $this->create_navigation_menu();
    foreach( $map as $key => $val ) {

      if( empty( $val['parent'] ) && $val['children'] > 0 ) {
        $item_id = wp_update_nav_menu_item( $menu_id, 0, array(
          'menu-item-title' => $val['title'],
          'menu-item-url' => '#',
          'menu-item-status' => 'publish'
        ));
        $top[$val['id']] = $item_id;
      }
    }

    $index = 0;
    foreach( $pages as $key => $page ) {

      if( !empty( $page['blank'] ) ) {
        $pages[$key]['wppage'] = wp_insert_post(
          array(
            'post_title' => $page['post_title'],
            'post_type' => 'page',
            'post_name' => str_replace( '/', '', $page['slug'] ),
            'post_status' => 'publish'
          )
        );

        update_post_meta( $pages[$key]['wppage'], '_yoast_wpseo_title', $page['title'] );
        update_post_meta( $pages[$key]['wppage'], '_yoast_wpseo_metadesc', $page['desc'] );

      }

      if( !empty( $page['create'] ) ) {
        global $wpdb;
        $post = get_post( $page['wppage'] );
        
        $current_user = wp_get_current_user();
        $new_post_author = $current_user->ID;

        if ( isset( $post ) && $post != null && $page['wppage'] != get_option( 'page_for_posts' ) ) {
          $args = array(
            'comment_status' => $post->comment_status,
            'ping_status'    => $post->ping_status,
            'post_author'    => $new_post_author,
            'post_content'   => $post->post_content,
            'post_excerpt'   => $post->post_excerpt,
            'post_name'      => $page['slug'],
            'post_parent'    => $post->post_parent,
            'post_password'  => $post->post_password,
            'post_status'    => 'publish',
            'post_title'     => $page['post_title'],
            'post_type'      => $post->post_type,
            'to_ping'        => $post->to_ping,
            'menu_order'     => $post->menu_order
          );          

          /*
           * insert the post by wp_insert_post() function
           */
          $new_post_id = wp_insert_post( $args );          
          
          $sql = 'SELECT meta_key, meta_value FROM ' . $wpdb->postmeta . ' WHERE post_id=' . $page['wppage'] .';';
          $post_meta_infos = $wpdb->get_results($sql);

          if (count($post_meta_infos)!=0) {
            foreach ($post_meta_infos as $meta_info) {
              $data = [
                'post_id' => $new_post_id,
                'meta_key' => $meta_info->meta_key,
                'meta_value' => $meta_info->meta_value
              ];
              $wpdb->insert( 'wp_postmeta', $data );
            }
          }

          update_post_meta( $new_post_id, '_yoast_wpseo_title', $page['title'] );
          update_post_meta( $new_post_id, '_yoast_wpseo_metadesc', $page['desc'] );
          $page['wppage'] = $new_post_id;
          $pages[$key]['wppage'] = $new_post_id;
        }        
      }
      
      if( !empty( $page['menuId'] ) ) {
        $item_id = wp_update_nav_menu_item( $menu_id, 0, array(
          'menu-item-object' => 'page',
          'menu-item-object-id' => $page['wppage'],
          'menu-item-type' => 'post_type',
          'menu-item-status' => 'publish'
        ));
      }
      $top[$page['menuId']] = $item_id;
      $index++;
    }

    $page_ids = [];

    foreach( $pages as $key => $page ) {
      if( !empty( $page['wppage'] ) && empty( $page['menuId'] ) ) {
        $item_id = wp_update_nav_menu_item( $menu_id, 0, array(
          'menu-item-object' => 'page',
          'menu-item-object-id' => $page['wppage'],
          'menu-item-type' => 'post_type',
          'menu-item-status' => 'publish',
          'menu-item-parent-id' => $top[$page['menuParent']]
        ));

        wp_update_post( 
          array(
            'ID' => $page['wppage'],
            'post_name' => str_replace( '/', '', $page['slug'] ) 
          )
        );

        update_post_meta( $page['wppage'], '_yoast_wpseo_title', $page['title'] );
        update_post_meta( $page['wppage'], '_yoast_wpseo_metadesc', $page['desc'] );
      }
      $page_ids[] = $page['wppage'];
    }

    // add front page to the exclude
    $page_ids[] = get_option( 'page_on_front' );
    // add blog page to the exclude
    $page_ids[] = get_option( 'page_for_posts' );

    $this->trash_draft_pages( $page_ids );
  }

  public function run_sitemap_update() {

    $this->items = $_POST['item'];
    $this->sitemap = $_POST['sitemap'];

    $pages = array();
   
    foreach( $this->items as $page ) {
      $post_id = $page["Select Page"];
      if( !empty( $post_id ) ) {
        wp_update_post( 
          array(
            'ID' => $post_id,
            'post_name' => str_replace( '/', '', $page['Permalink'] ) 
          )
        );

        update_post_meta( $post_id, '_yoast_wpseo_title', $page['Meta Title'] );
        update_post_meta( $post_id, '_yoast_wpseo_metadesc', $page['Meta Description'] );

        $pages[] = $post_id;

        $menu = $this->build_menu_array();

        //$this->trash_unused_pages( $pages );
      }
    }

    $data = array(
      'success' => 1,
    );

    wp_send_json_success( $data );
  }

  public function build_menu_array() {

    $data = $this->sitemap;

    unset( $data[0] ); // Remove Dr. Name
    unset( $data[1] ); // Remove URL
    $menu = [];
    //die( var_dump( $data ) );
    foreach( $data[2] as $key => $value ) {
      if( empty( $value ) ) {
        break;
      }
      array_push( $menu, [
        'title' => $value,
        'id' => $key,
        'parent' => '',
        'children' => 0
      ] );

    }
    unset( $data[2] );
    $count = count( $menu );
    foreach( $data as $key => $row ) {
      
      $row = array_slice( $row, 0, $count );         

      if(!array_filter($row)) {
        break;
      }
      foreach( $row as $key => $value ) {
        // if( empty( $value ) ) {
        //   break;
        // }
        $row = array_filter($row);
        if( ! empty( $value ) ) {
          $menu[$key]['children'] = $menu[$key]['children'] + 1;
          array_push( $menu, [
            'title' => $value,
            'link_type' => 'page',
            'parent' => $key
          ]);
        }
      }
    }

    //die( var_dump( $menu ) );
    return $menu;
    // $menu_id = $this->create_navigation_menu();
    // foreach( $menu as $key => $row ) {
    //   if( count( $row['items'] ) > 0 ) {
    //     wp_update_nav_menu_item( $menu_id, 0, array(
    //       'menu-item-title' => $row['title'],
    //       'menu-item-url' => '#',
    //       'menu-item-status' => 'publish'
    //     ));
    //   }
    // }
    //return $menu;
    // $menu_id = $this->create_navigation_menu();
    // foreach( $mainNav as $key => $name ) {
    //   wp_update_nav_menu_item( $menu_id, 0, array(
    //     'menu-item-object' => 'page',
    //     'menu-item-object-id' => get_page_by_path()->ID,
    //     'menu-item-type' => 'post_type',
    //     'menu-item-status' => 'publish'
    //   ));
    // }
  }

  public function upload_sitemap() {

    $this->get_sheet_data();
    $menu = $this->build_menu_array();
    $pages = $this->get_pages();

    $data = array(
      'success' => 1,
      'metadata' => $this->metadata,
      'sitemap' => $menu,
      'pages' => $pages
    );

    wp_send_json_success( $data );

  }
}
new PA_Sitemap_Reader();