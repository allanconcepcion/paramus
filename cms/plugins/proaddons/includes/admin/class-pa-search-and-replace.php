<?php
/**
 * Progressive Search & Replace
 *
 * Updates URLS when switching environments.
 *
 * @author      Progressive
 * @category    Admin
 * @package     Progressive/Admin/Search & Replace
 * @version     1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}

/**
 * Progressive_Url_Updater
 */
class Progressive_Search_And_Replace {

  const NONCE = 'progressive-search-and-replace';

  public $usebanda = true;
  public $dentistname = false;
  public $city = false;
  public $state = false;
  public $street = false;
  public $appt = false;
  public $zip = false;
  public $npnumber = false;
  public $cpnumber = false;
  public $newdentistname = false;
  public $newcity = false;
  public $newstate = false;
  public $newstreet = false;
  public $newappt = false;
  public $newzip = false;
  public $newnpnumber = false;
  public $newcpnumber = false;
  public $updateseo = false;
  public $updatecontent = false;
  public $updatealt = false;
  public $updateslug = false;

  /**
   * Constructor
   */
  public function __construct() {
    add_action( 'wp_ajax_nopriv_run_search_and_replace', array( $this, 'maybe_update_content' ) );
    add_action( 'wp_ajax_run_search_and_replace', array( $this, 'maybe_update_content' ) );
  }

  // public function sar_admin_menu() {
  //   add_management_page( 'Search & Replace', 'Search & Replace', 'manage_options', 'progressive-search-and-replace', array( $this, 'sar_admin_page' ) );
  // }

  // public function sar_admin_page() {
  //   require( PROGRESSIVE_VIEWS_DIR . 'html-admin-search-and-replace.php' );
  // }

  public function maybe_update_content() {
    // if( !wp_verify_nonce( $_POST[ self::NONCE ], self::NONCE ) ){
    //   wp_die( __('Ouch! That hurt! You should not be here!', 'progressive' ) );
    // }

    // Before variables
    $this->practicename = trim( strip_tags( $_POST[ 'practicename' ] ) );
    $this->dentistname = trim( strip_tags( $_POST[ 'dentistname'] ) );
    $this->city = trim( strip_tags( $_POST[ 'city'] ) );
    $this->state = trim( strip_tags( $_POST[ 'state'] ) );
    $this->street = trim( strip_tags( $_POST[ 'street' ] ) );
    $this->appt = trim( strip_tags( $_POST[ 'appt' ] ) );
    $this->zip = trim( strip_tags( $_POST[ 'zip' ] ) );
    $this->npnumber = trim( strip_tags( $_POST[ 'npnumber' ] ) );
    $this->cpnumber = trim( strip_tags( $_POST[ 'cpnumber' ] ) );

    // After variables
    $this->newpracticename = trim( strip_tags( $_POST[ 'newpracticename' ] ) );
    $this->newdentistname = trim( strip_tags( $_POST[ 'newdentistname'] ) );
    $this->newcity = trim( strip_tags( $_POST[ 'newcity'] ) );
    $this->newstate = trim( strip_tags( $_POST[ 'newstate'] ) );
    $this->newstreet = trim( strip_tags( $_POST[ 'newstreet' ] ) );
    $this->newappt = trim( strip_tags( $_POST[ 'newappt' ] ) );
    $this->newzip = trim( strip_tags( $_POST[ 'newzip' ] ) );
    $this->newnpnumber = trim( strip_tags( $_POST[ 'newnpnumber' ] ) );
    $this->newcpnumber = trim( strip_tags( $_POST[ 'newcpnumber' ] ) );

    // Update variables
    $this->usebanda = true;
    $this->updateseo = trim( strip_tags( $_POST['updateseo'] ) );
    $this->updatealt = trim( strip_tags( $_POST['updatealt'] ) );
    $this->updateslug = trim( strip_tags( $_POST['updateslug'] ) );
    $this->updatecontent = trim( strip_tags( $_POST['updatecontent'] ) );

    $this->update_seo_data();
    $this->update_alt_tags();
    $this->update_page_slugs();
    $this->update_page_content();

    $data = array(
      'success' => 1,
    );

    wp_send_json_success( $data );

    // if( $this->update_alt_tags() ){
    //   add_action( 'admin_notices', array( $this, 'sar_success' ) );
    // } else {
    //   add_action( 'admin_notices', array( $this, 'sar_fail' ) );
    // }
  }

  /**
   * Send success message back to the interface
   * @return string Success message
   */
  public function sar_success() {
    $message = apply_filters( 'progressive-sar-success-message', __( 'The fields have been updated.', 'progressive' ) );
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
  public function sar_fail() {
    ?>
    <div id="message" class="error fade">
      <p>
        <strong><?php _e( 'Something went wrong.', 'progressive' ); ?></strong>
      </p>
    </div>
    <?php
  }

  /**
   * Update the location in alt tags
   * @return [type] [description]
   */
  public function update_alt_tags() {
    global $wpdb;

    if( empty( $this->newcity ) || empty( $this->newstate ) || empty( $this->updatealt ) ) {
      return false;
    }

    $args = array(
      'post_type' => 'attachment',
      'post_mime_type' => 'image',
      'post_status' => 'inherit',
      'posts_per_page' => '-1'
    );

    $query_images = new WP_Query( $args );

    foreach( $query_images->posts as $post ) {
 
      $imageAlt = get_post_meta( $post->ID, '_wp_attachment_image_alt', true );
      $replace = "[city] [state]";

      if( "true" == $this->usebanda ) {

        // error if city and state are empty
        if( empty( $this->city ) || empty( $this->state ) ) {
          return false;
        }
        $replace = $this->city . ' ' . $this->state;
      }

      // If string exists, replace with new city and state
      if( stripos( $imageAlt, $replace ) !== false ) {

        $imageAlt = str_replace( $replace, $this->newcity . ' ' . $this->newstate, $imageAlt );
      }

      // Set the new image alt text
      update_post_meta( $post->ID, '_wp_attachment_image_alt', $imageAlt );
    }
    
    return true;

  }

  /**
   * Update the page slug location
   * @return boolean
   */
  public function update_page_slugs() {

    if( empty( $this->newcity ) || empty( $this->newstate ) || empty( $this->updateslug ) ) {
      return false;
    }
    
    $args = array(
      'post_type' => 'page',
      'post_status' => 'publish'
    );

    $pages = get_pages( $args );

    foreach( $pages as $page ) {

      $replace = "city-state";

      if( "true" == $this->usebanda ) {

        // error if city and state are empty
        if( empty( $this->city ) || empty( $this->state ) ) {
          return false;
        }
        $replace = strtolower( $this->city ) . '-' . strtolower( $this->state );
      }

      if( stripos( $page->post_name, $replace ) !== false ) {
        $slug = str_replace( $replace, strtolower( $this->newcity ) . '-' . strtolower( $this->newstate ), $page->post_name );
        wp_update_post( array(
          'ID' => $page->ID,
          'post_name' => $slug
        ) );
      }
    }

    return true;
  }

  public function update_seo_data() {      
    if( empty( $this->updateseo ) ) {
      return false;
    }

    $args = array(
      'post_type' => 'page',
      'post_status' => 'publish'
    );

    $pages = get_pages( $args );
    
    foreach( $pages as $page ) {

      $title = get_post_meta( $page->ID, '_yoast_wpseo_title', true );      
      $description = get_post_meta( $page->ID, '_yoast_wpseo_metadesc', true );
      
      if( !empty( $title ) ) {
        $this->replace_seo_title( $page, $title );
      }

      if( !empty( $description ) ) {
        $this->replace_seo_description( $page, $description );
      }
    }

    return true;
  }

  public function replace_seo_title( $page, $title ) {

    if( !empty( $this->newcity ) || !empty( $this->newstate ) ) {
      $replace = '[city], [state]';

      if( "true" == $this->usebanda ) {

        // error if city and state are empty
        if( empty( $this->city ) || empty( $this->state ) ) {
          return false;
        }
        $replace = $this->city . ', ' . $this->state;
      }

      if( stripos( $title, $replace ) !== false ) {
        $title = str_replace( $replace, ucwords( $this->newcity ) . ', ' . strtoupper( $this->newstate ), $title );
        update_post_meta( $page->ID, '_yoast_wpseo_title', $title );
      }
      $replace = false;
    }

    if( !empty( $this->newdentistname ) ) {
      $replace = '[dentistname]';

      if( "true" == $this->usebanda ) {

        // error if city and state are empty
        if( empty( $this->dentistname ) ) {
          return false;
        }
        $replace = $this->dentistname;
      }

      if( stripos( $title, $replace ) !== false ) {
        $title = str_replace( $replace, $this->newdentistname, $title );
        update_post_meta( $page->ID, '_yoast_wpseo_title', $title );
      }
      $replace = false;
    }

    if( !empty( $this->newpracticename )  ) {
      $replace = '[practicename]';

      if( "true" == $this->usebanda ) {

        // error if city and state are empty
        if( empty( $this->practicename ) ) {
          return false;
        }
        $replace = $this->practicename;
      }

      if( stripos( $title, $replace ) !== false ) {
        $title = str_replace( $replace, $this->newpracticename, $title );
        update_post_meta( $page->ID, '_yoast_wpseo_title', $title );
      }
      $replace = false;
    }

    
  }

  public function replace_seo_description( $page, $description ) {

    if( !empty( $this->newcity ) || !empty( $this->newstate ) ) {
      $replace = '[city], [state]';

      if( "true" == $this->usebanda ) {

        // error if city and state are empty
        if( empty( $this->city ) || empty( $this->state ) ) {
          return false;
        }
        $replace = $this->city . ', ' . $this->state;
      }

      if( stripos( $description, $replace ) !== false ) {
        $description = str_replace( $replace, ucwords( $this->newcity ) . ', ' . strtoupper( $this->newstate ), $description );
        update_post_meta( $page->ID, '_yoast_wpseo_metadesc', $description );
      }
      $replace = false;
    }

    if( !empty( $this->newdentistname ) ) {
      $replace = '[dentistname]';

      if( "true" == $this->usebanda ) {

        // error if city and state are empty
        if( empty( $this->dentistname ) ) {
          return false;
        }
        $replace = $this->dentistname;
      }

      if( stripos( $description, $replace ) !== false ) {
        $description = str_replace( $replace, $this->newdentistname, $description );
        update_post_meta( $page->ID, '_yoast_wpseo_metadesc', $description );
      }
      $replace = false;
    }

    if( !empty( $this->newpracticename )  ) {
      $replace = '[practicename]';

      if( "true" == $this->usebanda ) {

        // error if city and state are empty
        if( empty( $this->practicename ) ) {
          return false;
        }
        $replace = $this->practicename;
      }

      if( stripos( $description, $replace ) !== false ) {
        $description = str_replace( $replace, $this->newpracticename, $description );
        update_post_meta( $page->ID, '_yoast_wpseo_metadesc', $description );
      }
      $replace = false;
    }

    
  }

  function localize_us_number($phone) {
    $numbers_only = preg_replace("/[^\d]/", "", $phone);
    return preg_replace("/^1?(\d{3})(\d{3})(\d{4})$/", "$1-$2-$3", $numbers_only);
  }

  public function update_page_content() {
    global $wpdb;

    if( empty( $this->updatecontent ) ) {
      return false;
    }

    $query = "SELECT `meta_id`,`post_id`, `meta_value` FROM `wp_postmeta` WHERE `meta_key` = '_elementor_data';";

    foreach( $wpdb->get_results( $query ) as $key => $row) {

      // Update city and state in content
      if( !empty( $this->newcity ) || !empty( $this->newstate ) ) {
        $replace = '[city], [state]';

        if( "true" == $this->usebanda ) {

          // error if city and state are empty
          if( empty( $this->city ) || empty( $this->state ) ) {
            return false;
          }
          $replace = $this->city . ', ' . $this->state;
        }

        if( stripos( $row->meta_value, $replace ) !== false ) {

          $row->meta_value = str_replace( $replace, ucwords( $this->newcity ) . ', ' . strtoupper( $this->newstate ), $row->meta_value );
          $wpdb->update( 'wp_postmeta', array( 'meta_value' => $row->meta_value),array('meta_id'=>$row->meta_id));
        }
      }

      // update dentist name in content
      if( !empty( $this->newdentistname ) ) {
        $replace = '[dentistname]';

        if( "true" == $this->usebanda ) {

          // error if city and state are empty
          if( empty( $this->dentistname ) ) {
            return false;
          }
          $replace = $this->dentistname;
        }

        if( stripos( $row->meta_value, $replace ) !== false ) {

          $row->meta_value = str_replace( $replace, $this->newdentistname, $row->meta_value );
          $wpdb->update( 'wp_postmeta', array( 'meta_value' => $row->meta_value),array('meta_id'=>$row->meta_id));
        }
      }

      // update practice name in content
      if( !empty( $this->newpracticename ) ) {
        $replace = '[practicename]';

        if( "true" == $this->usebanda ) {

          // error if city and state are empty
          if( empty( $this->practicename ) ) {
            return false;
          }
          $replace = $this->practicename;
        }

        if( stripos( $row->meta_value, $replace ) !== false ) {

          $row->meta_value = str_replace( $replace, $this->newpracticename, $row->meta_value );
          $wpdb->update( 'wp_postmeta', array( 'meta_value' => $row->meta_value),array('meta_id'=>$row->meta_id));
        }
      }

      // update new patient number
      if( !empty( $this->newnpnumber ) ) {
        $replace = '[npnumber]';

        if( "true" == $this->usebanda ) {

          // error if city and state are empty
          if( empty( $this->npnumber ) ) {
            return false;
          }
          $replace = $this->npnumber;
          $replace2 = $this->localize_us_number( $this->npnumber );
        }

        if( stripos( $row->meta_value, $replace ) !== false ) {

          $row->meta_value = str_replace( $replace, $this->newnpnumber, $row->meta_value );
          $wpdb->update( 'wp_postmeta', array( 'meta_value' => $row->meta_value),array('meta_id'=>$row->meta_id));
        }

        if( !empty( $replace2 ) ) {
          if( stripos( $row->meta_value, $replace2 ) !== false ) {
            $row->meta_value = str_replace( $replace2, $this->localize_us_number( $this->newnpnumber ), $row->meta_value );
            $wpdb->update( 'wp_postmeta', array( 'meta_value' => $row->meta_value),array('meta_id'=>$row->meta_id));
          }
        }
        $replace2 = false;
      }

      // update current patient number
      if( !empty( $this->newcpnumber ) ) {
        $replace = '[npnumber]';

        if( "true" == $this->usebanda ) {

          // error if city and state are empty
          if( empty( $this->cpnumber ) ) {
            return false;
          }
          $replace = $this->cpnumber;
        }

        if( stripos( $row->meta_value, $replace ) !== false ) {

          $row->meta_value = str_replace( $replace, $this->newcpnumber, $row->meta_value );
          $wpdb->update( 'wp_postmeta', array( 'meta_value' => $row->meta_value),array('meta_id'=>$row->meta_id));
        }
      }

      // update street
      if( !empty( $this->newstreet ) ) {
        $replace = '[street]';

        if( "true" == $this->usebanda ) {

          // error if city and state are empty
          if( empty( $this->street ) ) {
            return false;
          }
          $replace = $this->street;
        }

        if( stripos( $row->meta_value, $replace ) !== false ) {

          $row->meta_value = str_replace( $replace, $this->newstreet, $row->meta_value );
          $wpdb->update( 'wp_postmeta', array( 'meta_value' => $row->meta_value),array('meta_id'=>$row->meta_id));
        }
      }

      // update zip
      if( !empty( $this->newzip ) ) {
        $replace = '[zip]';

        if( "true" == $this->usebanda ) {

          // error if city and state are empty
          if( empty( $this->zip ) ) {
            return false;
          }
          $replace = $this->zip;
        }

        if( stripos( $row->meta_value, $replace ) !== false ) {

          $row->meta_value = str_replace( $replace, $this->newzip, $row->meta_value );
          $wpdb->update( 'wp_postmeta', array( 'meta_value' => $row->meta_value),array('meta_id'=>$row->meta_id));
        }
      }

      
    }

    wp_cache_flush();
  }

  public function update_urls() {
    global $wpdb;

    if( empty( $this->oldurl ) || empty( $this->newurl ) ) {
      return false;
    }

    $redux = get_option( 'progressive' );

    if( $redux !== false ) {
      foreach( $redux as $key => $value ) {
        $redux[$key] = str_replace( urlencode( $this->oldurl ), urlencode( $this->newurl ), $value );
        $redux[$key] = str_replace( $this->oldurl, $this->newurl, $value );
      }
      
      update_option( 'progressive', $redux );
    }

    $query = "SELECT ID,post_content FROM `wp_posts` WHERE `post_type` = 'page';";

    foreach( $wpdb->get_results( $query ) as $key => $row) {
      $row->post_content = str_replace( urlencode( $this->oldurl ), urlencode( $this->newurl ), $row->post_content );
      $row->post_content = str_replace( $this->oldurl, $this->newurl, $row->post_content );

      $new_post = array(
        'ID' => $row->ID,
        'post_content' => $row->post_content
      );
      wp_update_post( $new_post );
    }

    wp_cache_flush();

    return true;

  }
  function makeTheUpdates(){
        global $wpdb;

      if( empty( $this->oldurl ) || empty( $this->newurl ) ){
        return false;
      }

        @set_time_limit( 0 );
        @ini_set( 'memory_limit', '256M' );
        @ini_set( 'max_input_time', '-1' );

        $updaters = (array)Go_Live_Update_Urls_Container::get_instance()->get_updaters()->get_updaters();

        // If the new domain is the old one with a new sub-domain like www
        if( strpos( $this->newurl, $this->oldurl ) !== false ){
            list( $subdomain ) = explode( '.', $this->newurl );
            $this->double_subdomain = $subdomain . '.' . $this->newurl;
        }

        $serialized_tables = $this->getSerializedTables();

        //Go through each table sent to be updated
        foreach( array_keys( $this->tables ) as $table ){
          //backward compatibility with pro
          if( $table == 'submit' && $table == 'oldurl' && $table == 'newurl' ){
            continue;
          }

            if( in_array( $table, array_keys( $serialized_tables ) ) ){
                if( is_array( $serialized_tables[ $table ] ) ){
                    foreach( $serialized_tables[ $table ] as $column ){
                        $this->UpdateSeralizedTable( $table, $column );
                    }
                } else {
                    $this->UpdateSeralizedTable( $table, $serialized_tables[ $table ] );
                }
            }

          $column_query = "SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA='" . $wpdb->dbname . "' AND TABLE_NAME='" . $table . "'";
          $columns      = $wpdb->get_col( $column_query );

          foreach( $columns as $_column ){
            $update_query = "UPDATE " . $table . " SET " . $_column . " = replace(" . $_column . ", %s, %s)";
            $wpdb->query( $wpdb->prepare( $update_query, array( $this->oldurl, $this->newurl ) ) );



            //Run each updater
                //@todo convert all the steps to their own updater class
            foreach( $updaters as $_updater_class ){
                if( class_exists( $_updater_class ) ){
                  /** @var \Go_Live_Update_Urls\Updaters\_Updater $_updater */
                  $_updater = new $_updater_class( $table, $_column, $this->oldurl, $this->newurl );
                  $_updater->update_data();
                  //run each updater through double sub-domain if applicable
                  if( $this->double_subdomain ){
                    $_updater = new $_updater_class( $table, $_column, $this->double_subdomain, $this->newurl );
                    $_updater->update_data();
                  }
                }
            }


            //Fix the dub dubs if this was the old domain with a new sub
            if( $this->double_subdomain ){
              $wpdb->query( $wpdb->prepare( $update_query, array(
                $this->double_subdomain,
                $this->newurl,
              ) ) );
              //Fix the emails breaking by being appended the new subdomain
              $wpdb->query( $wpdb->prepare( $update_query, array(
                "@" . $this->newurl,
                "@" . $this->oldurl,
              ) ) );
            }
          }

        }

        wp_cache_flush();

        return true;
    }

}

new Progressive_Search_And_Replace();