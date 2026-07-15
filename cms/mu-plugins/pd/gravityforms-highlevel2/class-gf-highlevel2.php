<?php

GFForms::include_feed_addon_framework();

class GF_HighLevel2 extends GFFeedAddOn {
  
  protected $_version = GF_HIGH_LEVEL2_VERSION;
  protected $_min_gravityforms_version = '1.9';
  protected $_slug = 'highlevel2';
  protected $_path = 'gravityforms-highlevel2/highlevel2.php';
  protected $_full_path = __FILE__;
  protected $_title = 'High Level 2.0 Add-On';
  protected $_short_title = 'High Level 2.0';

  const CUSTOM_FIELDS_CACHE_KEY = 'highlevel2_custom_fields';
  
  private static $_instance = null;
  
  public static function get_instance() {
    if ( self::$_instance == null ) {
      self::$_instance = new GF_HighLevel2();
    }
    
    return self::$_instance;
  }
  
  public function init() {
    parent::init();  
  }

  public function get_menu_icon() {
    return file_get_contents(WPMU_PLUGIN_DIR . '/pd/gravityforms-highlevel2/images/logo.svg');
  }
  
  public function plugin_settings_fields() {
    $description  = '<p>';
    $description .= esc_html__( 'HighLevel is the all-in-one sales & marketing platform that agencies can white-label and resell to their clients!', 'highlevel' );
    $description .= '</p>';
    $description .= '<p>';
    $description .= esc_html__( 'The Gravity Forms HighLevel 2.0 Add-On connects the power of the world’s leading growth platform - HighLevel - with Gravity Forms so your business can grow better.', 'highlevel' );
    $description .= '</p>';    
    
    $settings =  array(
      array(
	      'title'       => '',
	      'description' => $description,
	      'fields'      => array(
          array(
            'name'              => 'api_key',
            'tooltip'           => esc_html__('Private Integration Token can be found in your High Level account under Settings -> Private Integrations', 'highlevel'),
            'label'             => esc_html__('Private Integration Token', 'highlevel2'),
            'type'              => 'text',
            'input_type'        => 'password',
            'class'             => 'small',
            'required'          => true,
          ),          
          array(
            'name'              => 'location_id',
            'tooltip'           => esc_html__('Location ID can be found in your High Level account under Settings', 'highlevel'),
            'label'             => esc_html__('Location ID', 'highlevel2'),
            'type'              => 'text',
            'input_type'        => 'password',
            'class'             => 'small',
            'required'          => true,
          ),          
	      ),
      ),      
    );
    

    return $settings;
  }

  public function get_custom_fields ( $api_key, $location_id ) {
    $custom_fields = GFCache::get(self::CUSTOM_FIELDS_CACHE_KEY);

    if ( !empty($custom_fields) ) {
      return $custom_fields;
    }
    
    $custom_fields = array();
    
    if ( empty($api_key) || empty($location_id) ) {
      return $custom_fields;
    }    
        
    $custom_fields_response = wp_remote_get('https://services.leadconnectorhq.com/locations/' . $location_id . '/customFields', [
      'headers' => [
        'Authorization' => 'Bearer ' . $api_key,
        'Version' => '2021-07-28'
      ],
    ]);

    if ( is_wp_error($custom_fields_response) ) {
      return $custom_fields;
    }
    
    $custom_fields = json_decode($custom_fields_response['body'])->customFields;
    
    GFCache::set(self::CUSTOM_FIELDS_CACHE_KEY, $custom_fields, true, MINUTE_IN_SECONDS * 1);

    return $custom_fields;
  }
  
  public function feed_settings_fields() {    
    $settings = array(
      'title'  => esc_html__('Feed Settings', 'highlevel'),
      'fields' => array(
        array(
	        'name'          => 'feed_name',
	        'label'         => esc_html__( 'Name', 'highlevel' ),
	        'type'          => 'text',
	        'class'         => 'medium',
	        'required'      => true,
	        'tooltip'       => '<h6>' . esc_html__( 'Name', 'highlevel2' ) . '</h6>' . esc_html__( 'Enter a feed name to uniquely identify this feed.', 'highlevel2' ),
	      ),
        array(
	        'name'          => 'tags',
      	  'label'         => esc_html__( 'Tags', 'highlevel2' ),
	        'type'          => 'text',
      	  'class'         => 'small',
          'tooltip'       => esc_html__( 'A comma separated list of tags to assign to contacts.', 'highlevel2' ),
	      ),
        array(
	        'name'          => 'query_param_tags',
      	  'label'         => esc_html__( 'Tags (Query Parameters)', 'highlevel2' ),
	        'type'          => 'text',
      	  'class'         => 'small',
          'tooltip'       => esc_html__( 'A comma separated list of query string parameters to assign as additional tags on contacts, e.g., "utm_campaign".', 'highlevel2' ),
	      ),
        array(
	        'name'          => 'api_key',
      	  'label'         => esc_html__( 'API Key', 'highlevel2' ),
	        'type'          => 'text',
          'input_type'    => 'text',
      	  'class'         => 'small',
          'tooltip'       => esc_html__('Optional. If present this feed will submit to the account associated with this key. Otherwise it will default to the API Key in the global settings. A reload of this page may be required after updating an api key to see the new custom field selections.', 'highlevel2'),
	      ),         
        array(
	        'name'          => 'location_id',
      	  'label'         => esc_html__( 'Location ID', 'highlevel2' ),
	        'type'          => 'text',
          'input_type'    => 'text',
      	  'class'         => 'small',
          'tooltip'       => esc_html__('Optional. If present this feed will submit to the account associated with this id. Otherwise it will default to the Location ID in the global settings. A reload of this page may be required after updating a location id to see the new custom field selections.', 'highlevel2'),
	      ),         
      ),        
    );

    $api_key = $this->get_plugin_setting('api_key');
    $location_id = $this->get_plugin_setting('location_id');

    // override settings if present on feed
    $feed = $this->get_current_feed();    
    if ( !empty($feed['meta']['api_key']) ) {
      $api_key = $feed['meta']['api_key'];
    }
    if ( !empty($feed['meta']['location_id']) ) {
      $location_id = $feed['meta']['location_id'];
    }
    
    $api_custom_fields = $this->get_custom_fields($api_key, $location_id);
        
    $custom_fields = array_map(function ($field) {
      return [
        'label' => $field->name,
        'value' => $field->id,         
      ];
    }, $api_custom_fields);
    
    $field_mappings = array(
      'title'  => esc_html__('Field Mapping', 'highlevel'),
      'fields' => array(
        array(
          'name'              => 'standard_fields',
          'label'             => 'Standard Fields',
          'type'              => 'dynamic_field_map',
          'key_field_title'   => 'HighLevel',
          'value_field_title' => 'Gravity Forms',
          'enable_custom_key' => false,
          'field_map' => array(
            array(
              'label' => 'First Name',
              'value' => 'firstName'
            ),
            array(
              'label' => 'Last Name',
              'value' => 'lastName'
            ),
            array(
              'label' => 'Full Name',
              'value' => 'name'
            ),
            array(
              'label' => 'Email',
              'value' => 'email'
            ),
            array(
              'label' => 'Phone',
              'value' => 'phone'
            ),
            array(
              'label' => 'Address Line 1',
              'value' => 'address1'
            ),
            array(
              'label' => 'City',
              'value' => 'city'
            ),
            array(
              'label' => 'State',
              'value' => 'state'
            ),
            array(
              'label' => 'Postal Code',
              'value' => 'postalCode'
            ),
            array(
              'label' => 'Website',
              'value' => 'website'
            ),
            array(
              'label' => 'Timezone',
              'value' => 'timezone'
            ),
          )
	      ),          
        array(
          'name'              => 'custom_fields',
          'label'             => 'Custom Fields',
          'type'              => 'dynamic_field_map',
          'key_field_title'   => 'HubSpot',
          'value_field_title' => 'Gravity Forms',
          'enable_custom_key' => false,
          'field_map' => $custom_fields
        ),
      ),
    );    
      
    return array($settings, $field_mappings);
  }

  public function process_feed ( $feed, $entry, $form ) {     
    // Global settings or override with feed level key
    $api_key = $this->get_plugin_setting('api_key');
    $location_id = $this->get_plugin_setting('location_id');

    if ( !empty($feed['meta']['api_key']) ) {
      $api_key = $feed['meta']['api_key'];
    }    

    if ( !empty($feed['meta']['location_id']) ) {
      $location_id = $feed['meta']['location_id'];
    }    

    // Parse all standard fields
    $standard_fields = array();
    if ( is_array($feed['meta']['standard_fields']) ) {
      foreach ( $feed['meta']['standard_fields'] as $field ) {
        $standard_fields[$field['key']] = $entry[$field['value']];
      } 
    }        

    // Parse all custom fields
    $custom_fields = array();    
    if ( is_array($feed['meta']['custom_fields']) ) {
      

      foreach ( $feed['meta']['custom_fields'] as $field ) {                        
        $subfieldMatches = preg_grep("/{$field['value']}\./", array_keys($entry));
        if ( count($subfieldMatches) > 0 ) { 
          $values = [];
          foreach ( $subfieldMatches as $k => $v ) {
            if ( $entry[$v] ) {
              $values[]= $entry[$v];
            }            
          }

          $custom_fields[] = [
            'id' => $field['key'], 
            'value' => $values
          ];                    
        } else {                    
          $custom_fields[] = [
            'id' => $field['key'], 
            'value' => $entry[$field['value']]
          ];
        }        
      } 
    }         

    $standard_fields['customFields'] = $custom_fields;
    $standard_fields['locationId'] = $location_id;
    $body = $standard_fields;       

    // Parse all manually added tags via the feed
    $tags = [];
    if ( strlen($feed['meta']['tags']) > 0 ) {
      $tags = explode(',', $feed['meta']['tags']);     
    }

    // if query param tags are set on the feed, attempt to parse 
    // the selected params as additional tags
    if ( !empty($feed['meta']['query_param_tags']) ) {
      $id = null;
      foreach ( $form['fields'] as $field ) {
        if ( $field->label === 'query_string' ) {
          $id = $field->id;
        }
      }

      if ( isset($entry[$id]) ) {
        parse_str($entry[$id], $query);
        $query_param_tags = explode(',', $feed['meta']['query_param_tags']);       
        foreach ( $query_param_tags as $param  ) {          
          $tags[]= $query[$param];          
        }        
      }      
    }    

    $upsert_response = wp_remote_post('https://services.leadconnectorhq.com/contacts/upsert', [
      'headers' => [
        'Authorization' => 'Bearer ' . $api_key,
        'Version' => '2021-07-28'
      ],
      'body' => $body,
    ]);              

    if ( is_wp_error($upsert_response) ) {
      $this->add_feed_error( sprintf( esc_html__( 'There was an error when creating the contact in HighLevel. %s', 'highlevel2' ), $upsert_response->get_error_message() ), $feed, $entry, $form );
      $this->log_error( __METHOD__ . '(): Unable to create the contact; error data: ' . print_r( $upsert_response->get_error_data(), true ) );
    }

    $upsert_body = json_decode($upsert_response['body']);

    $tags_response = wp_remote_post('https://services.leadconnectorhq.com/contacts/' . $upsert_body->contact->id . '/tags', [
      'headers' => [
        'Authorization' => 'Bearer ' . $api_key,
        'Version' => '2021-07-28'
      ],
      'body' => [
        'tags' => $tags
      ],
    ]);

    if ( $tags_response['response']['code'] != 201 ) {
      $this->add_feed_error( sprintf( esc_html__( 'There was an error when tagging the contact in HighLevel. %s', 'highlevel2' ), $upsert_response->get_error_message() ), $feed, $entry, $form );
      $this->log_error( __METHOD__ . '(): Unable to tag the contact; error data: ' . print_r( $upsert_response->get_error_data(), true ) );
    }    
  }

  public function feed_list_columns() {
    return array(
      'feed_name' => esc_html__( 'Name', 'highlevel2' ),
    );
  }
}
