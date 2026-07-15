<?php

namespace PD\ACF\Menus\Mobile;

function init () {
  acf_add_local_field_group([
    'key' => 'group_mobile_menu',
    'title' => 'Mobile Menu',
    'location' => [
      [
        [
          'param' => 'nav_menu_item',
	        'operator' => '==',
	        'value' => 'location/mobile',
        ],
      ],
    ],
    'menu_order' => 2,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_graphql' => 1,
    'graphql_field_name' => 'mobileMenu',
    'map_graphql_types_from_location_rules' => 0,
    'graphql_types' => '',
    'fields' => [
      [
        'key' => "field_mobile_menu_item_icon",
        'label' => 'Icon',
        'name' => "mobile_menu_item_icon",
        'graphql_field_name' => 'icon',
        'type' => 'image',     
        'show_in_graphql' => 1,
        'return_format' => 'array',
        'preview_size' => 'medium',
        'library' => 'all',
        'required' => 1,
      ],
      [
	      'key' => 'field_mobile_menu_item_background_color',
	      'label' => 'Background Color',
	      'name' => 'mobile_menu_item_background_color',
        'graphql_field_name' => 'backgroundColor',
	      'type' => 'select',
	      'show_in_graphql' => 1,
        'ui' => 1,
      ],
    ],    
  ]);   
}

add_action('acf/init', __NAMESPACE__ . '\\init');
