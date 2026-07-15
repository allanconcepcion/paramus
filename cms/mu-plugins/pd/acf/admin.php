<?php

namespace PD\ACF\Admin;

function after_setup_theme () {
  if ( function_exists('acf_add_options_page') ) {
    acf_add_options_page([
      'page_title'    => 'Customize',
      'menu_title'    => 'Customize',
      'menu_slug'     => 'customize',
      'capability'    => 'administrator',
      'redirect'      => false,
      'show_in_graphql' => true,      
    ]);
  }
}

add_action('after_setup_theme', __NAMESPACE__ . '\\after_setup_theme');

function toolbars ( $toolbars ) {
  $toolbars['Link'] = [];
  $toolbars['Link'][1] = ['link']; 
  
  $toolbars['Bare'] = [];
  $toolbars['Bare'][1] = ['bold', 'italic', 'link', 'bullist', 'numlist']; 

  write_log($toolbars);
    
  $toolbars['Basic'] = [];
  $toolbars['Basic'][1] = [        
    'formatselect',
    'forecolor',
    'bold',
    'italic',
    'alignleft', 
    'aligncenter',
    'underline',
    'strikethrough',
    'bullist',
    'numlist',
    'link',     
  ];  
  
  return $toolbars;  
} 

add_filter('acf/fields/wysiwyg/toolbars', __NAMESPACE__ . '\\toolbars');

function acf_google_map_api ( $api ) {
  $map = get_field('map', 'option');

  if ( isset($map['google_maps_api_key']) ) {
    $api['key'] = $map['google_maps_api_key'];
  }  

  return $api;
}

add_filter('acf/fields/google_map/api', __NAMESPACE__ . '\\acf_google_map_api');

function submitbox_before_major_actions () {
  $home = get_page_by_title('Home');
  $home_preview_link = esc_url(get_preview_post_link($home->ID));
  $pages = get_pages([
    'exclude' => $home->ID
  ]);
?>
  <div id="minor-publishing-actions">
    <div id="misc-publishing-actions" class="customize-publishing-actions">
      <select>
        <option data-id="<?php echo $home->ID; ?>" value="<?php echo $home_preview_link; ?>">
          <?php echo $home->post_title; ?>
        </option>
        <?php foreach ( $pages as $k => $page ) : ?>
          <option data-id="<?php echo $page->ID; ?>" value="<?php echo esc_url(get_preview_post_link($page->ID)); ?>">
            <?php echo $page->post_title; ?>
          </option>
        <?php endforeach; ?>
      </select>
      <a class="preview button"
         href="<?php echo $home_preview_link; ?>"
         target="wp-preview-<?php echo $home->ID; ?>"
      >
        View Changes
      </a>
    </div>
    
    <div class="clear"></div>
    <p>You must update before viewing changes.</p>    
  </div>
<?php ;
}

add_action('acf/options_page/submitbox_before_major_actions', __NAMESPACE__ . '\\submitbox_before_major_actions');

function acf_options_page_save ($post_id) {
  if ( $post_id === 'options' ) {
    do_action('wpgraphql_cache_purge_all');
  }  
}

add_action('acf/save_post', __NAMESPACE__ . '\\acf_options_page_save', 10, 1);

/* Global Settings  */

function acf_load_field_colors( $field ) {  
  $field['choices'] = [];
  $field['choices'][''] = '';
  
  if( have_rows('colors', 'option') ) {    
    while ( have_rows('colors', 'option') ) {            
      the_row();      
      $color = get_sub_field('color');
      $name = get_sub_field('name');      
      $field['choices'][$name] = $name . ' (' . $color . ')';
    }        
  }

  $field['choices']['transparent'] = 'Transparent';
  
  return $field;    
}

add_filter('acf/load_field/name=global_default_styles_hyperlink_color',                                                  __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=global_typography_list_bullet_color',                                                    __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=header_logo_background_color_mobile',                                                    __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=header_logo_background_color_desktop',                                                   __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=header_logo_background_color_desktop_scroll',                                            __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=header_icon_link_background_color_mobile',                                               __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=header_icon_link_color_mobile',                                                          __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=header_left_links_color',                                                                __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=header_left_links_color_scroll',                                                         __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=header_left_links_label_color',                                                          __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=header_left_links_link_color',                                                           __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=header_left_links_label_color_scroll',                                                   __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=header_left_links_link_color_scroll',                                                    __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=header_right_links_color',                                                               __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=header_right_links_color_scroll',                                                        __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=header_right_links_label_color',                                                         __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=header_right_links_link_color',                                                          __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=header_right_links_label_color_scroll',                                                  __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=header_right_links_link_color_scroll',                                                   __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=menu_overlay_color',                                                                     __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=menu_background_color',                                                                  __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=menu_color',                                                                             __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=menu_accent_color',                                                                      __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=menu_hover_color',                                                                       __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=menu_icon_color',                                                                        __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=menu_icon_background_color',                                                             __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=menu_icon_color_mobile',                                                                 __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=menu_icon_background_color_mobile',                                                      __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=menu_tab_cta_links_color',                                                               __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=menu_cta_button_color',                                                                  __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=menu_close_button_icon_color',                                                           __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=menu_close_button_border_color',                                                         __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=menu_icon_border_color_desktop',                                                         __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=mobile_menu_button_background_color',                                                    __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=mobile_menu_item_background_color',                                                      __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=modules_hero_copy_background_color_mobile',                                              __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_hero_link_background_color',                                                     __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_hero_link_color',                                                                __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_hero_cta_icon_background_color',                                                 __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_hero_cta_icon_color',                                                            __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_hero_cta_title_background_color',                                                __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_hero_cta_title_color',                                                           __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_hero_cta_title_color_hover',                                                     __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=modules_text_headline_style_color',                                                      __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_text_headline_style_color_bold',                                                 __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=modules_gallery_style_headline_color_a',                                                 __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_style_headline_color_bold_a',                                            __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_style_text_color_a',                                                     __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_navigation_border_color_a',                                              __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_items_tool_border_color_a',                                              __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_items_tool_icon_color_a',                                                __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_items_tool_outer_background_color_a',                                    __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_items_tool_inner_background_color_a',                                    __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_items_label_background_color_a',                                         __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_items_label_color_a',                                                    __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_a_cta_icon_color',                                                       __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_a_cta_icon_background',                                                  __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_a_cta_icon_border',                                                      __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_a_cta_icon_color_hover',                                                 __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_a_cta_icon_background_hover',                                            __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_a_cta_icon_border_hover',                                                __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_style_background_color_a',                                               __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=modules_gallery_style_headline_color_b',                                                 __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_style_headline_color_bold_b',                                            __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_style_text_color_b',                                                     __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_navigation_border_color_b',                                              __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_items_tool_border_color_b',                                              __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_items_tool_icon_color_b',                                                __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_items_tool_outer_background_color_b',                                    __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_items_tool_inner_background_color_b',                                    __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_items_label_background_color_b',                                         __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_items_label_color_b',                                                    __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_b_cta_icon_color',                                                       __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_b_cta_icon_background',                                                  __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_b_cta_icon_border',                                                      __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_b_cta_icon_color_hover',                                                 __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_b_cta_icon_background_hover',                                            __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_b_cta_icon_border_hover',                                                __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_style_background_color_b',                                               __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=modules_gallery_style_headline_color_c',                                                 __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_style_headline_color_bold_c',                                            __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_style_text_color_c',                                                     __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_navigation_border_color_c',                                              __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_items_tool_border_color_c',                                              __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_items_tool_icon_color_c',                                                __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_items_tool_outer_background_color_c',                                    __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_items_tool_inner_background_color_c',                                    __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_items_label_background_color_c',                                         __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_items_label_color_c',                                                    __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_c_cta_icon_color',                                                       __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_c_cta_icon_background',                                                  __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_c_cta_icon_border',                                                      __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_c_cta_icon_color_hover',                                                 __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_c_cta_icon_background_hover',                                            __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_c_cta_icon_border_hover',                                                __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_gallery_style_background_color_c',                                               __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=modules_text_cta_icon_color',                                                            __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_text_cta_icon_background',                                                       __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_text_cta_icon_border',                                                           __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_text_cta_icon_color_hover',                                                      __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_text_cta_icon_background_hover',                                                 __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_text_cta_icon_border_hover',                                                     __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=modules_horizontal_accordion_header_color_a',                                            __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_header_color_bold_a',                                       __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_header_body_color_a',                                       __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_header_background_color_a',                                 __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_header_border_color_a',                                     __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_desktop_default_color_a',                       __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_desktop_default_border_color_a',                __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_desktop_default_icon_color_a',                  __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_desktop_default_icon_background_color_a',       __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_desktop_default_icon_border_color_a',           __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_desktop_default_icon_color_hover_a',            __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_desktop_default_icon_background_color_hover_a', __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_desktop_default_icon_border_color_hover_a',     __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_desktop_closed_color_a',                        __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_desktop_closed_background_color_a',             __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_desktop_closed_border_color_a',                 __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_desktop_open_color_a',                          __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_mobile_closed_text_color_a',                    __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_mobile_closed_background_color_a',              __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_mobile_closed_border_color_a',                  __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_mobile_closed_icon_color_a',                    __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_mobile_closed_icon_background_color_a',         __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_mobile_closed_icon_border_color_a',             __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_mobile_open_text_color_a',                      __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_mobile_open_background_color_a',                __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_mobile_open_border_color_a',                    __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_mobile_open_icon_color_a',                      __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_mobile_open_icon_background_color_a',           __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_mobile_open_icon_border_color_a',               __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=modules_horizontal_accordion_header_color_b',                                            __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_header_color_bold_b',                                       __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_header_body_color_b',                                       __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_header_background_color_b',                                 __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_header_border_color_b',                                     __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_desktop_default_color_b',                       __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_desktop_default_border_color_b',                __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_desktop_default_icon_color_b',                  __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_desktop_default_icon_background_color_b',       __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_desktop_default_icon_border_color_b',           __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_desktop_default_icon_color_hover_b',            __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_desktop_default_icon_background_color_hover_b', __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_desktop_default_icon_border_color_hover_b',     __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_desktop_closed_color_b',                        __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_desktop_closed_background_color_b',             __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_desktop_closed_border_color_b',                 __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_desktop_open_color_b',                          __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_mobile_closed_text_color_b',                    __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_mobile_closed_background_color_b',              __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_mobile_closed_border_color_b',                  __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_mobile_closed_icon_color_b',                    __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_mobile_closed_icon_background_color_b',         __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_mobile_closed_icon_border_color_b',             __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_mobile_open_text_color_b',                      __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_mobile_open_background_color_b',                __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_mobile_open_border_color_b',                    __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_mobile_open_icon_color_b',                      __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_mobile_open_icon_background_color_b',           __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_horizontal_accordion_items_style_mobile_open_icon_border_color_b',               __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=modules_accordion_style_headline_color_a',                                               __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_accordion_style_headline_color_bold_a',                                          __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_accordion_style_text_color_a',                                                   __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_accordion_style_background_color_a',                                             __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_accordion_style_item_border_color_a',                                            __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=modules_accordion_style_headline_color_b',                                               __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_accordion_style_headline_color_bold_b',                                          __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_accordion_style_text_color_b',                                                   __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_accordion_style_background_color_b',                                             __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_accordion_style_item_border_color_b',                                            __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=modules_accordion_style_headline_color_c',                                               __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_accordion_style_headline_color_bold_c',                                          __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_accordion_style_text_color_c',                                                   __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_accordion_style_background_color_c',                                             __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_accordion_style_item_border_color_c',                                            __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=modules_video_headline_color_a',                                                         __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_video_headline_color_bold_a',                                                    __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_video_body_color_a',                                                             __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=modules_video_carousel_style_desktop_background_color_a',                                __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_video_carousel_style_mobile_background_color_a',                                 __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_video_carousel_style_text_color_a',                                              __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_video_carousel_style_text_color_bold_a',                                         __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_video_carousel_style_border_color_a',                                            __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_video_carousel_a_cta_icon_color',                                                __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_video_carousel_a_cta_icon_background',                                           __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_video_carousel_a_cta_icon_border',                                               __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_video_carousel_a_cta_icon_color_hover',                                          __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_video_carousel_a_cta_icon_background_hover',                                     __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_video_carousel_a_cta_icon_border_hover',                                         __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_video_carousel_style_cta_text_color_a',                                          __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_video_carousel_style_social_links_eyebrow_color_a',                              __NAMESPACE__ . '\\acf_load_field_colors');
 
add_filter('acf/load_field/name=modules_video_carousel_style_desktop_background_color_b',                                __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_video_carousel_style_mobile_background_color_b',                                 __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_video_carousel_style_text_color_b',                                              __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_video_carousel_style_text_color_bold_b',                                         __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_video_carousel_style_border_color_b',                                            __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_video_carousel_b_cta_icon_color',                                                __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_video_carousel_b_cta_icon_background',                                           __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_video_carousel_b_cta_icon_border',                                               __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_video_carousel_b_cta_icon_color_hover',                                          __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_video_carousel_b_cta_icon_background_hover',                                     __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_video_carousel_b_cta_icon_border_hover',                                         __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_video_carousel_style_cta_text_color_b',                                          __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_video_carousel_style_social_links_eyebrow_color_b',                              __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=modules_video_gallery_headline_color_a',                                                 __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_video_gallery_headline_color_bold_a',                                            __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_video_gallery_text_color_a',                                                     __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=modules_timeline_style_background_color_a',                                              __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_timeline_style_mobile_background_color_a',                                       __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_timeline_headline_color_a',                                                      __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_timeline_headline_color_bold_a',                                                 __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_timeline_body_color_a',                                                          __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_timeline_cards_style_background_color_a',                                        __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_timeline_cards_style_color_a',                                                   __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_timeline_cards_style_title_color_a',                                             __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_timeline_timeline_style_progress_color_a',                                       __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_timeline_timeline_style_accent_color_a',                                         __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_timeline_timeline_style_text_color_a',                                           __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=modules_timeline_style_background_color_b',                                              __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_timeline_style_mobile_background_color_b',                                       __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_timeline_headline_color_b',                                                      __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_timeline_headline_color_bold_b',                                                 __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_timeline_body_color_b',                                                          __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_timeline_cards_style_background_color_b',                                        __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_timeline_cards_style_color_b',                                                   __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_timeline_cards_style_title_color_b',                                             __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_timeline_timeline_style_progress_color_b',                                       __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_timeline_timeline_style_accent_color_b',                                         __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_timeline_timeline_style_text_color_b',                                           __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=modules_timeline_style_background_color_c',                                              __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_timeline_style_mobile_background_color_c',                                       __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_timeline_headline_color_c',                                                      __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_timeline_headline_color_bold_c',                                                 __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_timeline_body_color_c',                                                          __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_timeline_cards_style_background_color_c',                                        __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_timeline_cards_style_color_c',                                                   __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_timeline_cards_style_title_color_c',                                             __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_timeline_timeline_style_progress_color_c',                                       __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_timeline_timeline_style_accent_color_c',                                         __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_timeline_timeline_style_text_color_c',                                           __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=modules_media_text_style_desktop_background_color_a',                                    __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_style_mobile_background_color_a',                                     __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_style_text_color_a',                                                  __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_style_headline_color_a',                                              __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_style_headline_color_bold_a',                                         __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_style_border_color_a',                                                __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_a_cta_icon_color',                                                    __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_a_cta_icon_background',                                               __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_a_cta_icon_border',                                                   __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_a_cta_icon_color_hover',                                              __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_a_cta_icon_background_hover',                                         __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_a_cta_icon_border_hover',                                             __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_alt_a_cta_icon_color',                                                __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_alt_a_cta_icon_background',                                           __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_alt_a_cta_icon_border',                                               __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_alt_a_cta_icon_color_hover',                                          __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_alt_a_cta_icon_background_hover',                                     __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_alt_a_cta_icon_border_hover',                                         __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_hotspots_button_icon_color_a',                                        __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_hotspots_button_background_color_a',                                  __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_hotspots_label_color_a',                                              __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_hotspots_label_background_color_a',                                   __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=modules_media_text_style_desktop_background_color_b',                                    __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_style_mobile_background_color_b',                                     __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_style_headline_color_b',                                              __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_style_headline_color_bold_b',                                         __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_style_text_color_b',                                                  __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_style_border_color_b',                                                __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_b_cta_icon_color',                                                    __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_b_cta_icon_background',                                               __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_b_cta_icon_border',                                                   __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_b_cta_icon_color_hover',                                              __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_b_cta_icon_background_hover',                                         __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_b_cta_icon_border_hover',                                             __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_alt_b_cta_icon_color',                                                __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_alt_b_cta_icon_background',                                           __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_alt_b_cta_icon_border',                                               __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_alt_b_cta_icon_color_hover',                                          __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_alt_b_cta_icon_background_hover',                                     __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_alt_b_cta_icon_border_hover',                                         __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_hotspots_button_icon_color_b',                                        __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_hotspots_button_background_color_b',                                  __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_hotspots_label_color_b',                                              __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_hotspots_label_background_color_b',                                   __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=modules_media_text_style_desktop_background_color_c',                                    __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_style_mobile_background_color_c',                                     __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_style_headline_color_c',                                              __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_style_headline_color_bold_c',                                         __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_style_text_color_c',                                                  __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_style_border_color_c',                                                __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_c_cta_icon_color',                                                    __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_c_cta_icon_background',                                               __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_c_cta_icon_border',                                                   __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_c_cta_icon_color_hover',                                              __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_c_cta_icon_background_hover',                                         __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_c_cta_icon_border_hover',                                             __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_alt_c_cta_icon_color',                                                __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_alt_c_cta_icon_background',                                           __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_alt_c_cta_icon_border',                                               __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_alt_c_cta_icon_color_hover',                                          __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_alt_c_cta_icon_background_hover',                                     __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_alt_c_cta_icon_border_hover',                                         __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_hotspots_button_icon_color_c',                                        __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_hotspots_button_background_color_c',                                  __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_hotspots_label_color_c',                                              __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_hotspots_label_background_color_c',                                   __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=modules_media_text_2x_style_headline_color_a',                                           __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_2x_style_headline_color_bold_a',                                      __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_2x_style_text_color_a',                                               __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_2x_style_border_color_a',                                             __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_2x_style_icon_background_color_a',                                    __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_2x_style_icon_border_color_a',                                        __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_2x_style_desktop_background_color_a',                                 __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_2x_style_mobile_background_color_a',                                  __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=modules_media_text_2x_style_headline_color_b',                                           __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_2x_style_headline_color_bold_b',                                      __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_2x_style_text_color_b',                                               __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_2x_style_border_color_b',                                             __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_2x_style_icon_background_color_b',                                    __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_2x_style_icon_border_color_b',                                        __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_2x_style_desktop_background_color_b',                                 __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_2x_style_mobile_background_color_b',                                  __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=modules_media_text_2x_style_headline_color_c',                                           __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_2x_style_headline_color_bold_c',                                      __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_2x_style_text_color_c',                                               __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_2x_style_border_color_c',                                             __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_2x_style_icon_background_color_c',                                    __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_2x_style_icon_border_color_c',                                        __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_2x_style_desktop_background_color_c',                                 __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_media_text_2x_style_mobile_background_color_c',                                  __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=modules_cards_style_headline_color_a',                                                   __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_cards_style_headline_color_bold_a',                                              __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_cards_style_text_color_a',                                                       __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_cards_icon_style_accent_color_a',                                                __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_cards_icon_style_text_color_a',                                                  __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_cards_style_desktop_background_color_a',                                         __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_cards_style_mobile_background_color_a',                                          __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=modules_cards_style_headline_color_b',                                                   __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_cards_style_headline_color_bold_b',                                              __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_cards_style_text_color_b',                                                       __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_cards_icon_style_accent_color_b',                                                __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_cards_icon_style_text_color_b',                                                  __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_cards_style_desktop_background_color_b',                                         __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_cards_style_mobile_background_color_b',                                          __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=modules_cards_style_headline_color_c',                                                   __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_cards_style_headline_color_bold_c',                                              __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_cards_style_text_color_c',                                                       __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_cards_icon_style_accent_color_c',                                                __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_cards_icon_style_text_color_c',                                                  __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_cards_style_desktop_background_color_c',                                         __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_cards_style_mobile_background_color_c',                                          __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=modules_card_carousel_style_headline_color_a',                                           __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_card_carousel_style_headline_color_bold_a',                                      __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_card_carousel_style_text_color_a',                                               __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_card_carousel_icon_style_accent_color_a',                                        __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_card_carousel_background_color_a',                                               __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=modules_card_carousel_style_headline_color_b',                                           __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_card_carousel_style_headline_color_bold_b',                                      __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_card_carousel_style_text_color_b',                                               __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_card_carousel_icon_style_accent_color_b',                                        __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_card_carousel_background_color_b',                                               __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=modules_card_carousel_style_headline_color_c',                                           __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_card_carousel_style_headline_color_bold_c',                                      __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_card_carousel_style_text_color_c',                                               __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_card_carousel_icon_style_accent_color_c',                                        __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_card_carousel_background_color_c',                                               __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=modules_card_tabs_style_headline_color_a',                                               __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_card_tabs_style_headline_color_bold_a',                                          __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_card_tabs_style_text_color_a',                                                   __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_card_tabs_tab_style_accent_color_a',                                             __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_card_tabs_background_color_a',                                                   __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_card_tabs_card_background_color_a',                                              __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=modules_card_tabs_style_headline_color_b',                                               __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_card_tabs_style_headline_color_bold_b',                                          __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_card_tabs_style_text_color_b',                                                   __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_card_tabs_tab_style_accent_color_b',                                             __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_card_tabs_background_color_b',                                                   __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_card_tabs_card_background_color_b',                                              __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=modules_card_tabs_style_headline_color_c',                                               __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_card_tabs_style_headline_color_bold_c',                                          __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_card_tabs_style_text_color_c',                                                   __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_card_tabs_tab_style_accent_color_c',                                             __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_card_tabs_background_color_c',                                                   __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_card_tabs_card_background_color_c',                                              __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=modules_html_headline_color_a',                                                          __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_html_headline_color_bold_a',                                                     __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_html_body_color_a',                                                              __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_html_background_color_a',                                                        __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=modules_html_headline_color_b',                                                          __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_html_headline_color_bold_b',                                                     __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_html_body_color_b',                                                              __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_html_background_color_b',                                                        __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=modules_html_headline_color_c',                                                          __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_html_headline_color_bold_c',                                                     __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_html_body_color_c',                                                              __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=modules_html_background_color_c',                                                        __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=components_form_submit_cta_icon_color',                                                  __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=components_form_submit_cta_icon_background',                                             __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=components_form_submit_cta_icon_border',                                                 __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=components_form_submit_cta_icon_color_hover',                                            __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=components_form_submit_cta_icon_background_hover',                                       __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=components_form_submit_cta_icon_border_hover',                                           __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=components_post_date_border_color',                                                      __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=components_post_author_color',                                                           __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=components_post_author_background_color',                                                __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=components_post_author_cta_color',                                                       __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=components_post_author_cta_background_color',                                            __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=components_post_author_cta_color_hover',                                                 __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=components_post_author_cta_background_color_hover',                                      __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=components_video_modal_buttons_close_color',                                             __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=components_video_play_button_accent_color',                                              __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=footer_cta_basic_text_color',                                                            __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=footer_cta_basic_border_color',                                                          __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=footer_cta_basic_background_color',                                                      __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=footer_cta_basic_cta_icon_color',                                                        __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=footer_cta_basic_cta_icon_background',                                                   __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=footer_cta_basic_cta_icon_border',                                                       __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=footer_cta_basic_cta_icon_color_hover',                                                  __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=footer_cta_basic_cta_icon_background_hover',                                             __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=footer_cta_basic_cta_icon_border_hover',                                                 __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=footer_cta_basic_space_background_color',                                                __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=footer_cta_html_embed_text_color',                                                       __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=footer_cta_html_embed_border_color',                                                     __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=footer_cta_html_embed_embed_background_color',                                           __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=footer_cta_html_embed_background_color',                                                 __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=footer_cta_html_embed_space_background_color',                                           __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=footer_cta_checklist_html_embed_text_color',                                             __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=footer_cta_checklist_html_embed_border_color',                                           __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=footer_cta_checklist_html_embed_accent_color',                                           __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=footer_cta_checklist_html_embed_embed_background_color',                                 __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=footer_cta_checklist_html_embed_background_color',                                       __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=footer_cta_checklist_html_embed_space_background_color',                                 __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=footer_blocks_background_color_desktop',                                                 __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=footer_blocks_color_desktop',                                                            __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=footer_blocks_background_color_mobile',                                                  __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=footer_blocks_color_mobile',                                                             __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=footer_kicker_background_color_desktop',                                                 __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=footer_kicker_color_desktop',                                                            __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=footer_kicker_background_color_mobile',                                                  __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=footer_kicker_color_mobile',                                                             __NAMESPACE__ . '\\acf_load_field_colors');

/* Module Settings  */
  
add_filter('acf/load_field/name=icon_blocks_icon_color',                                                                 __NAMESPACE__ . '\\acf_load_field_colors');
  
add_filter('acf/load_field/name=cta_style_color',                                                                        __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=cta_style_background_color',                                                             __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=cta_cta_icon_color',                                                                     __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=cta_cta_icon_background',                                                                __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=cta_cta_icon_border',                                                                    __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=cta_cta_icon_color_hover',                                                               __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=cta_cta_icon_background_hover',                                                          __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=cta_cta_icon_border_hover',                                                              __NAMESPACE__ . '\\acf_load_field_colors');

add_filter('acf/load_field/name=video_text_color',                                                                       __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=video_text_color_bold',                                                                  __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=video_body_color',                                                                       __NAMESPACE__ . '\\acf_load_field_colors');
add_filter('acf/load_field/name=video_background_color',                                                                 __NAMESPACE__ . '\\acf_load_field_colors');


function acf_load_field_font_families( $field ) {  
  $field['choices'] = [];
  
  if( have_rows('font_families', 'option') ) {    
    while ( have_rows('font_families', 'option') ) {            
      the_row();
      
      $label = get_sub_field('label');            
      $field['choices'][$label] = $label;
    }        
  }
  
  return $field;    
}

add_filter('acf/load_field/name=global_typography_h1_desktop_regular_font_family',                                     __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=global_typography_h1_mobile_regular_font_family',                                      __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=global_typography_h2_desktop_regular_font_family',                                     __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=global_typography_h2_desktop_bold_font_family',                                        __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=global_typography_h2_mobile_regular_font_family',                                      __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=global_typography_h2_mobile_bold_font_family',                                         __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=global_typography_h3_desktop_regular_font_family',                                     __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=global_typography_h3_desktop_bold_font_family',                                        __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=global_typography_h3_desktop_extra_bold_font_family',                                  __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=global_typography_h3_mobile_regular_font_family',                                      __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=global_typography_h3_mobile_bold_font_family',                                         __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=global_typography_h3_mobile_extra_bold_font_family',                                   __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=global_typography_h4_desktop_light_font_family',                                       __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=global_typography_h4_desktop_regular_font_family',                                     __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=global_typography_h4_desktop_bold_font_family',                                        __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=global_typography_h4_mobile_light_font_family',                                        __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=global_typography_h4_mobile_regular_font_family',                                      __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=global_typography_h4_mobile_bold_font_family',                                         __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=global_typography_h5_desktop_regular_font_family',                                     __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=global_typography_h5_mobile_regular_font_family',                                      __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=global_typography_h6_desktop_light_font_family',                                       __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=global_typography_h6_desktop_regular_font_family',                                     __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=global_typography_h6_mobile_light_font_family',                                        __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=global_typography_h6_mobile_regular_font_family',                                      __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=global_typography_body_desktop_regular_font_family',                                   __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=global_typography_body_mobile_regular_font_family',                                    __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=global_typography_buttons_desktop_regular_font_family',                                __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=global_typography_buttons_desktop_large_font_family',                                  __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=global_typography_buttons_mobile_regular_font_family',                                 __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=global_typography_buttons_mobile_large_font_family',                                   __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=global_typography_image_captions_desktop_regular_font_family',                         __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=global_typography_image_captions_mobile_regular_font_family',                          __NAMESPACE__ . '\\acf_load_field_font_families');
                                                                                                                       
add_filter('acf/load_field/name=menu_typography_links_desktop_regular_font_family',                                    __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=menu_typography_links_mobile_regular_font_family',                                     __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=menu_typography_cta_links_desktop_regular_font_family',                                __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=menu_typography_cta_links_mobile_regular_font_family',                                 __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=menu_typography_cta_button_desktop_regular_font_family',                               __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=menu_typography_cta_button_mobile_regular_font_family',                                __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=menu_typography_hamburger_label_regular_font_family',                                  __NAMESPACE__ . '\\acf_load_field_font_families');
                                                                                                                       
add_filter('acf/load_field/name=mobile_menu_typography_mobile_regular_font_family',                                    __NAMESPACE__ . '\\acf_load_field_font_families');
                                                                                                                       
add_filter('acf/load_field/name=header_icon_link_typography_mobile_regular_font_family',                               __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=header_left_links_typography_desktop_label_font_family',                               __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=header_left_links_typography_desktop_link_font_family',                                __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=header_left_links_typography_desktop_regular_font_family',                             __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=header_right_links_typography_desktop_label_font_family',                              __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=header_right_links_typography_desktop_link_font_family',                               __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=header_right_links_typography_desktop_regular_font_family',                            __NAMESPACE__ . '\\acf_load_field_font_families');
                                                                                                                       
add_filter('acf/load_field/name=modules_hero_copy_headline_desktop_typography_regular_font_family',                    __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_hero_copy_headline_desktop_typography_bold_font_family',                       __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_hero_copy_headline_mobile_typography_regular_font_family',                     __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_hero_copy_headline_mobile_typography_bold_font_family',                        __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_hero_cta_bar_typography_desktop_regular_font_family',                          __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_hero_cta_bar_typography_mobile_regular_font_family',                           __NAMESPACE__ . '\\acf_load_field_font_families');
                                                                                                                       
add_filter('acf/load_field/name=modules_icon_blocks_blocks_label_typography_desktop_font_family',                      __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_icon_blocks_blocks_body_typography_desktop_font_family',                       __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_icon_blocks_blocks_label_typography_mobile_font_family',                       __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_icon_blocks_blocks_body_typography_mobile_font_family',                        __NAMESPACE__ . '\\acf_load_field_font_families');
                                                                                                                       
add_filter('acf/load_field/name=modules_video_carousel_nav_style_desktop_regular_a_font_family',                       __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_video_carousel_nav_style_mobile_regular_a_font_family',                        __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_video_carousel_video_titles_regular_typography_desktop_a_font_family',         __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_video_carousel_video_titles_regular_typography_mobile_a_font_family',          __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_video_carousel_social_links_eyebrow_regular_typography_desktop_a_font_family', __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_video_carousel_social_links_eyebrow_regular_typography_mobile_a_font_family',  __NAMESPACE__ . '\\acf_load_field_font_families');
        
add_filter('acf/load_field/name=modules_video_carousel_nav_style_desktop_regular_b_font_family',                       __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_video_carousel_nav_style_mobile_regular_b_font_family',                        __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_video_carousel_video_titles_regular_typography_desktop_b_font_family',         __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_video_carousel_video_titles_regular_typography_mobile_b_font_family',          __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_video_carousel_social_links_eyebrow_regular_typography_desktop_b_font_family', __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_video_carousel_social_links_eyebrow_regular_typography_mobile_b_font_family',  __NAMESPACE__ . '\\acf_load_field_font_families');

add_filter('acf/load_field/name=modules_media_text_video_titles_regular_typography_desktop_a_font_family',             __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_media_text_video_titles_regular_typography_mobile_a_font_family',              __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_media_text_video_titles_regular_typography_desktop_b_font_family',             __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_media_text_video_titles_regular_typography_mobile_b_font_family',              __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_media_text_video_titles_regular_typography_desktop_c_font_family',             __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_media_text_video_titles_regular_typography_mobile_c_font_family',              __NAMESPACE__ . '\\acf_load_field_font_families');

add_filter('acf/load_field/name=modules_timeline_timeline_style_desktop_regular_a_font_family',                        __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_timeline_timeline_style_mobile_regular_a_font_family',                         __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_timeline_timeline_style_desktop_regular_b_font_family',                        __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_timeline_timeline_style_mobile_regular_b_font_family',                         __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_timeline_timeline_style_desktop_regular_c_font_family',                        __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_timeline_timeline_style_mobile_regular_c_font_family',                         __NAMESPACE__ . '\\acf_load_field_font_families');
                                                                                                                       
add_filter('acf/load_field/name=modules_cards_icon_style_desktop_regular_a_font_family',                               __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_cards_icon_style_mobile_regular_a_font_family',                                __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_cards_icon_style_desktop_regular_b_font_family',                               __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_cards_icon_style_mobile_regular_b_font_family',                                __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_cards_icon_style_desktop_regular_c_font_family',                               __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_cards_icon_style_mobile_regular_c_font_family',                                __NAMESPACE__ . '\\acf_load_field_font_families');

add_filter('acf/load_field/name=modules_card_carousel_navigation_regular_typography_desktop_a_font_family',            __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_card_carousel_navigation_regular_typography_desktop_b_font_family',            __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_card_carousel_navigation_regular_typography_desktop_c_font_family',            __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_card_carousel_navigation_regular_typography_mobile_a_font_family',             __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_card_carousel_navigation_regular_typography_mobile_b_font_family',             __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_card_carousel_navigation_regular_typography_mobile_c_font_family',             __NAMESPACE__ . '\\acf_load_field_font_families');
                                                                                                                       
add_filter('acf/load_field/name=modules_accordion_item_title_style_desktop_regular_a_font_family',                     __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_accordion_item_title_style_mobile_regular_a_font_family',                      __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_accordion_item_title_style_desktop_regular_b_font_family',                     __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_accordion_item_title_style_mobile_regular_b_font_family',                      __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_accordion_item_title_style_desktop_regular_c_font_family',                     __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_accordion_item_title_style_mobile_regular_c_font_family',                      __NAMESPACE__ . '\\acf_load_field_font_families');
                                                                                                                       
add_filter('acf/load_field/name=modules_gallery_navigation_regular_typography_desktop_a_font_family',                  __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_gallery_navigation_regular_typography_mobile_a_font_family',                   __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_gallery_navigation_bold_typography_desktop_a_font_family',                     __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_gallery_navigation_bold_typography_mobile_a_font_family',                      __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_gallery_items_label_typography_desktop_a_font_family',                         __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_gallery_items_label_typography_mobile_a_font_family',                          __NAMESPACE__ . '\\acf_load_field_font_families');
                                                                                                                       
add_filter('acf/load_field/name=modules_gallery_navigation_regular_typography_desktop_b_font_family',                  __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_gallery_navigation_regular_typography_mobile_b_font_family',                   __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_gallery_navigation_bold_typography_desktop_b_font_family',                     __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_gallery_navigation_bold_typography_mobile_b_font_family',                      __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_gallery_items_label_typography_desktop_b_font_family',                         __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_gallery_items_label_typography_mobile_b_font_family',                          __NAMESPACE__ . '\\acf_load_field_font_families');
                                                                                                                       
add_filter('acf/load_field/name=modules_gallery_navigation_regular_typography_desktop_c_font_family',                  __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_gallery_navigation_regular_typography_mobile_c_font_family',                   __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_gallery_navigation_bold_typography_desktop_c_font_family',                     __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_gallery_navigation_bold_typography_mobile_c_font_family',                      __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_gallery_items_label_typography_desktop_c_font_family',                         __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_gallery_items_label_typography_mobile_c_font_family',                          __NAMESPACE__ . '\\acf_load_field_font_families');
                                                                                                                       
add_filter('acf/load_field/name=modules_video_gallery_video_titles_regular_typography_desktop_a_font_family',          __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=modules_video_gallery_video_titles_regular_typography_mobile_a_font_family',           __NAMESPACE__ . '\\acf_load_field_font_families');
                                                                                                                       
add_filter('acf/load_field/name=components_post_date_desktop_regular_font_family',                                     __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=components_post_date_mobile_regular_font_family',                                      __NAMESPACE__ . '\\acf_load_field_font_families');
                                                                                                                       
add_filter('acf/load_field/name=components_pagination_links_desktop_regular_font_family',                              __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=components_pagination_links_mobile_regular_font_family',                               __NAMESPACE__ . '\\acf_load_field_font_families');
                                                                                                                       
add_filter('acf/load_field/name=footer_blocks_label_typography_desktop_font_family',                                   __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=footer_blocks_body_typography_desktop_font_family',                                    __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=footer_blocks_locations_hidden_label_typography_mobile_font_family',                   __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=footer_kicker_tagline_typography_desktop_font_family',                                 __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=footer_kicker_cta_typography_desktop_font_family',                                     __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=footer_kicker_copyright_typography_desktop_font_family',                               __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=footer_blocks_label_typography_mobile_font_family',                                    __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=footer_blocks_body_typography_mobile_font_family',                                     __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=footer_kicker_tagline_typography_mobile_font_family',                                  __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=footer_kicker_cta_typography_mobile_font_family',                                      __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=footer_kicker_copyright_typography_mobile_font_family',                                __NAMESPACE__ . '\\acf_load_field_font_families');

add_filter('acf/load_field/name=footer_phone_label_typography_desktop_font_family',                                    __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=footer_phone_number_typography_desktop_font_family',                                   __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=footer_phone_label_typography_mobile_font_family',                                     __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=footer_phone_number_typography_mobile_font_family',                                    __NAMESPACE__ . '\\acf_load_field_font_families');

add_filter('acf/load_field/name=footer_ctas_checklist_html_embed_typography_desktop_headline_regular_font_family',     __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=footer_ctas_checklist_html_embed_typography_desktop_headline_bold_font_family',        __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=footer_ctas_checklist_html_embed_typography_desktop_checklist_regular_font_family',    __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=footer_ctas_checklist_html_embed_typography_desktop_checklist_bold_font_family',       __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=footer_ctas_checklist_html_embed_typography_mobile_headline_regular_font_family',      __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=footer_ctas_checklist_html_embed_typography_mobile_headline_bold_font_family',         __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=footer_ctas_checklist_html_embed_typography_mobile_checklist_regular_font_family',     __NAMESPACE__ . '\\acf_load_field_font_families');
add_filter('acf/load_field/name=footer_ctas_checklist_html_embed_typography_mobile_checklist_bold_font_family',        __NAMESPACE__ . '\\acf_load_field_font_families');

function acf_load_field_footer_cta_select( $field ) {  
  $field['choices'] = [];

  $field['choices']['None'] = 'None';
  
  if ( have_rows('footer_ctas', 'option') ) {    
    while ( have_rows('footer_ctas', 'option') ) {            
      the_row();
      
      $label = get_sub_field('title');
      $field['choices'][$label] = $label;
    }        
  }
  
  return $field;    
}

add_filter('acf/load_field/name=footer_default_cta', __NAMESPACE__ . '\\acf_load_field_footer_cta_select');
add_filter('acf/load_field/name=footer_cta',         __NAMESPACE__ . '\\acf_load_field_footer_cta_select');


function acf_load_field_form_select ( $field ) {
  $field['choices'] = [];

  $field['choices']['None'] = 'None';

  if ( class_exists('GFAPI') ) {
    $forms = \GFAPI::get_forms();

    foreach ( $forms as $form ) {
      $field['choices'][$form['id']] = $form['title'];
    }
  }

  return $field;
}

add_filter('acf/load_field/name=contact_form_forms_form', __NAMESPACE__ . '\\acf_load_field_form_select');
add_filter('acf/load_field/name=modals_form_form',        __NAMESPACE__ . '\\acf_load_field_form_select');



