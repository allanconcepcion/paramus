<?php

namespace PD\Admin;

use WebPExpress\Config as WebPExpressConfig;

// Ensure base content is present for frontend API requests

function init() {    
  // Create home and assign to static front
  if ( get_page_by_path('/home') == NULL ) {
    $home = array(
      'post_title' => 'Home',
      'post_status' => 'publish',
      'post_date' => date('Y-m-d H:i:s'),
      'post_type' => 'page'
    );

    $home_id = wp_insert_post($home);
    update_option('page_on_front', $home_id);
    update_option('show_on_front', 'page');
  }

  // Create blog and assign to posts page
  if ( get_page_by_path('/blog') == NULL ) {
    $blog = array(
      'post_title' => 'Blog',
      'post_status' => 'publish',
      'post_date' => date('Y-m-d H:i:s'),
      'post_type' => 'page'
    );
    
    $blog_id = wp_insert_post($blog);    
    update_option('page_for_posts', $blog_id);    
  }  

  if ( get_option('category_base') === '' ) {
    update_option('category_base', 'category');
  }  

  /* global $wp_rewrite;
  $wp_rewrite->set_permalink_structure('/blog/%postname%/');
  $wp_rewrite->flush_rules();   */

  // Force certain plugins to be "must use" (always active)
  $activate = [
    'wp-schema-pro/wp-schema-pro.php', 
    'advanced-custom-fields-font-awesome/acf-font-awesome.php', 
    'wpgraphql-smart-cache/wp-graphql-smart-cache.php', 
    'eps-301-redirects/eps-301-redirects.php', 
    'webp-express/webp-express.php', 
    'acf-better-search/acf-better-search.php', 
    'simple-local-avatars/simple-local-avatars.php'
  ];

  foreach ( $activate as $plugin ){
    if ( function_exists('activate_plugin') ) {
      activate_plugin($plugin);
    }    
  }  

  // force object caching to be ON  
  $graphql_cache_section = get_option('graphql_cache_section');  
  if ( $graphql_cache_section ) {
    $graphql_cache_section['cache_toggle'] = 'on';
    update_option('graphql_cache_section', $graphql_cache_section, true);  
  } else {
    add_option('graphql_cache_section', ['cache_toggle' => 'on'], true);
  }

  if ( is_admin() ) {    
    $config = WebPExpressConfig::loadConfig();  
    // force auto webp gen to be ON
    $config['convert-on-upload'] = true;            
    // force destination to be mingled    
    $config['destination-folder'] = 'mingled';    
    // scope
    $config['scope'] = ['uploads'];
    WebPExpressConfig::saveConfigurationFile($config);
  }  

  add_theme_support( 'post-thumbnails' );    
}

add_action('init', __NAMESPACE__ . '\\init');

function admin_menu () {
  /**
	 * Global submenu data
	 *
	 * @var array
	 */
	global $submenu;

	// Remove Appearance > Themes.
	remove_submenu_page( 'themes.php', 'themes.php' );

	// Remove Appearance > Theme Editor.
	remove_submenu_page( 'themes.php', 'theme-editor.php' );

	// Remove Appearance > Editor.
	remove_submenu_page( 'themes.php', 'site-editor.php' );

	// Remove Appearance > Widgets.
	remove_submenu_page( 'themes.php', 'widgets.php' );

	/**
	 * Remove features that require the Customizer.
	 * Loop through the themes.php submenu to remove features in Customizer
	 * since there's no direct way to remove them via the submenu_slug.
	 * Targeting 'hide-if-no-customize' removes all the features that
	 * rely on the Customizer. Otherwise you must target each one
	 * specifically by name (which might be a good idea?).
	 */
	if ( isset( $submenu['themes.php'] ) ) {
		foreach ( $submenu['themes.php'] as $key => $item ) {
			if ( in_array( 'hide-if-no-customize', $item, true ) ) {
				unset( $submenu['themes.php'][ $key ] );
			}
		}
	}
}

add_action('admin_menu', __NAMESPACE__ . '\\admin_menu', 1000);

function wp_before_admin_bar_render() {
	/**
	 * WP Admin Bar global
	 *
	 * @var WP_Admin_Bar $wp_admin_bar
	 */
	global $wp_admin_bar;	

	$wp_admin_bar->remove_menu( 'customize' );
	$wp_admin_bar->remove_node( 'themes' );
	$wp_admin_bar->remove_node( 'site-editor' );
	$wp_admin_bar->remove_node( 'widgets' );
}

add_action('wp_before_admin_bar_render', __NAMESPACE__ . '\\wp_before_admin_bar_render' );

function current_screen() {	
	$disabled_screens = array(
		'site-editor',
		'themes',
	);

	$screen = get_current_screen();

	if ( is_object( $screen ) && in_array( $screen->id, $disabled_screens, true ) ) {
		wp_safe_redirect( admin_url() );
		exit;
	}
}

add_action('current_screen', __NAMESPACE__ . '\\current_screen' );

// Ensure Posts Page is treated like a normal page in Graphql, not a 'CustomContent' type

function graphql_pre_resolve_uri ( $null, $uri, $context, $wp ) {
  $page_for_posts = get_option( 'page_for_posts', 0 );

  if ( empty( $page_for_posts ) ) {
    return $null;
  }

  $permalink = get_permalink( (int) $page_for_posts );

  if ( empty( $permalink ) || is_wp_error( $permalink ) ) {
    return $null;
  }

  $parsed_permalink = wp_parse_url( $permalink );
  $parsed_uri = wp_parse_url( $uri );

  if ( ! isset( $parsed_permalink['path'] ) || ! isset( $parsed_uri['path'] )) {
    return $null;
  }

  $trimmed_uri_path = rtrim( ltrim( $parsed_uri['path'], '/' ), '/' );
  $trimmed_permalink_path = rtrim( ltrim( $parsed_permalink['path'], '/' ), '/' );

  if ( $trimmed_permalink_path === $trimmed_uri_path ) {
    return new \WPGraphQL\Model\Post( get_post( (int) $page_for_posts ) );
  }

  return $null;
}

add_filter('graphql_pre_resolve_uri', __NAMESPACE__ . '\\graphql_pre_resolve_uri' , 10, 4 );


// Custom styles

function admin_enqueue_scripts () {
  wp_enqueue_style('pd-admin', PD_PLUGIN_URL . 'pd/assets/css/admin.css');
  wp_enqueue_script('pd-admin', PD_PLUGIN_URL . 'pd/assets/js/admin.js');
}

add_action('admin_enqueue_scripts', __NAMESPACE__ . '\\admin_enqueue_scripts');

// Add SVG to allowed upload types

function upload_mimes ( $mimes ) {
  $mimes['svg'] = 'image/svg+xml';
  $mimes['ttf'] = 'font/ttf';
  $mimes['woff'] = 'font/woff';
  $mimes['woff2'] = 'font/woff2';
  $mimes['eot'] = 'application/vnd.ms-fontobject';
  
  return $mimes;  
}

add_filter('upload_mimes', __NAMESPACE__ . '\\upload_mimes');

// Add SVG to allowed upload types

function wp_check_filetype_and_ext( $types, $file, $filename, $mimes ) {
  if ( false !== strpos( $filename, '.svg' ) ) {
      $types['ext'] = 'svg';
      $types['type'] = 'image/svg+xml';
  }

  if ( false !== strpos( $filename, '.ttf' ) ) {
    $types['ext'] = 'ttf';
    $types['type'] = 'font/ttf';
  }

  if ( false !== strpos( $filename, '.woff' ) ) {
    $types['ext'] = 'woff';
    $types['type'] = 'font/woff';
  }

  if ( false !== strpos( $filename, '.woff2' ) ) {
    $types['ext'] = 'woff2';
    $types['type'] = 'font/woff2';
  }

  if ( false !== strpos( $filename, '.eot' ) ) {
    $types['ext'] = 'eot';
    $types['type'] = 'font/eot';
  }

  return $types;
}

add_filter('wp_check_filetype_and_ext', __NAMESPACE__ . '\\wp_check_filetype_and_ext', 10, 4);

// Gravity Forms: remove advanced fields

function gform_add_field_buttons ( $field_groups ) {
  $standard_field_index = -1;
  $advanced_field_index = -1;
  $post_field_index     = -1;
  $pricing_field_index  = -1;
  
  // Find group indexes  
  foreach ( $field_groups as $index => $group ) {
    if ( $group['name'] == 'standard_fields' ) {
      $standard_field_index = $index;
    } elseif ( $group['name'] == 'advanced_fields' ) {
      $advanced_field_index = $index;
    } elseif ( $group['name'] == 'post_fields' ) {
      $post_field_index = $index;
    } elseif ( $group['name'] == 'pricing_fields' ) {
      $pricing_field_index = $index;
    }    
  }

  if ( $standard_field_index >= 0 ) {
    $page_field_index = -1;
    $section_field_index = -1;    
    $checkboxes_field_index = -1;

    foreach ( $field_groups[$standard_field_index]['fields'] as $index => $field ) {
      if ( $field['value'] == 'Page' ) {
        $page_field_index = $index;
      }

      if ( $field['value'] == 'Section' ) {
        $section_field_index = $index;
      }      

      unset($field_groups[$standard_field_index]['fields'][$page_field_index]);
      unset($field_groups[$standard_field_index]['fields'][$section_field_index]);      
      unset($field_groups[$standard_field_index]['fields'][$checkboxes_field_index]);
    }
  }  
  
  if ( $advanced_field_index >= 0 ) {
    foreach ( $field_groups[$advanced_field_index]['fields'] as $index => $field ) {
      if (
        $field['value'] != 'Email' &&
        $field['value'] != 'File Upload' && 
        $field['value'] != 'Date' &&
        $field['value'] != 'CAPTCHA'
      ) {
        unset($field_groups[$advanced_field_index]['fields'][$index]);
      }
    }
  }

  if ( $post_field_index >= 0 ) {
    unset($field_groups[$post_field_index]);
  }

  if ( $pricing_field_index >= 0 ) {
    unset($field_groups[$pricing_field_index]);
  }
  
  return $field_groups;
}

add_filter('gform_add_field_buttons', __NAMESPACE__ . '\\gform_add_field_buttons');

function gform_form_settings_fields ( $fields, $form ) {
  unset($fields['form_layout']);
  unset($fields['form_button']);
  unset($fields['save_and_continue']);
  unset($fields['restrictions']);
  unset($fields['form_options']);
    
  return $fields;
}

add_filter('gform_form_settings_fields', __NAMESPACE__ . '\\gform_form_settings_fields', 10, 2);

function gform_confirmation_settings_fields ( $fields, $confirmation, $form ) {
  $confirmation_type_index = -1;

  if ( is_array($fields[0]) ) {
    foreach ( $fields[0]['fields'] as $index => $group ) {
      if ( $group['name'] == 'type' ) {
        $confirmation_type_index = $index;
      }    
    }
  }  
  
  if ( $confirmation_type_index >= 0 ) {
    $page_index = -1;
    foreach ( $fields[0]['fields'][$confirmation_type_index]['choices'] as $index => $choice ) {
      if ( $choice['value'] == 'page' ) {
        $page_index = $index;
      }
    }

    if ( $page_index >= 0 ) {
      unset($fields[0]['fields'][$confirmation_type_index]['choices'][$page_index]);
    }
  }
  
  return $fields;
}

add_filter('gform_confirmation_settings_fields', __NAMESPACE__ . '\\gform_confirmation_settings_fields', 10, 3);

function gform_form_post_get_meta ( $form ) {
  $found = false;
  
  foreach ( $form['fields'] as $field ) {
    if ( $field->label === 'query_string' ) {
      $found = true;
    }
  }

  if ( !$found ) {
    $query_string = \GF_Fields::create( array(
      'type'   => 'hidden',    
      'id'     => 100001,
      'label' => 'query_string',
      'formId' => $form['id'],        
      'pageNumber'  => 1
    ));
  
    $form['fields'][] = $query_string;
  }  

  return $form;
}

add_filter('gform_form_post_get_meta', __NAMESPACE__ . '\\gform_form_post_get_meta');

add_filter('gform_field_container', __NAMESPACE__ . '\\gform_field_container', 10, 6 );

function gform_field_container ( $field_container, $field, $form, $css_class, $style, $field_content ) {
  if ( $field->type == 'hidden' && $field->label == 'query_string' ) {
    return str_replace( ' class="', 'style="display: none;" class="', $field_container );    
  }
  
  return $field_container;
}

add_action('gform_editor_js', function () {
  echo <<<DOC
    <script type="text/javascript">
      function SetDefaultValues_date ( field ) {         
        field.dateType = "datedropdown"   
      }
    </script>
  DOC;  
} );

/**
 * Stop Distributor from changing the canonical links.
 *
 * This removes Distributor's canonical functionality from
 * both Internal and External Connections and for those sites
 * that use Yoast SEO.
 */

function template_redirect () {
  remove_filter( 'get_canonical_url', array( '\Distributor\InternalConnections\NetworkSiteConnection', 'canonical_url' ), 10, 2 );
  remove_filter( 'wpseo_canonical', array( '\Distributor\InternalConnections\NetworkSiteConnection', 'wpseo_canonical_url' ) );
  remove_filter( 'get_canonical_url', array( '\Distributor\ExternalConnections\WordPressExternalConnection', 'canonical_url' ), 10, 2 );
  remove_filter( 'wpseo_canonical', array( '\Distributor\ExternalConnections\WordPressExternalConnection', 'wpseo_canonical_url' ) );
}

add_action('template_redirect', __NAMESPACE__ . '\\template_redirect', 20);

add_filter('preview_post_link', __NAMESPACE__ . '\\preview_post_link', 10, 2);

function preview_post_link ( $preview_link, $post ) {
  return get_home_url() . '/api/preview?url=' . get_the_permalink($post->ID);
}

add_filter('rest_url', __NAMESPACE__ . '\\rest_url');
function rest_url() {  
  return get_site_url() . '/wp-json/';
}

add_action('wp_ajax_clear_graphql_cache', __NAMESPACE__ . '\\clear_graphql_cache');
add_action('wp_ajax_nopriv_clear_graphql_cache', __NAMESPACE__ . '\\clear_graphql_cache');
function clear_graphql_cache () {
  do_action('wpgraphql_cache_purge_all');
  wp_send_json(['status' => 'ok']);
}

// Add site url to allowed hosts
function allowed_redirect_hosts( $allowed_hosts ) {
  $site_url_host = parse_url( site_url(), PHP_URL_HOST );
  
  if ( ! in_array( $site_url_host, $allowed_hosts ) ) {
      $allowed_hosts[] = $site_url_host;
  }
  
  return $allowed_hosts;
}

add_filter('allowed_redirect_hosts', __NAMESPACE__ . '\\allowed_redirect_hosts');