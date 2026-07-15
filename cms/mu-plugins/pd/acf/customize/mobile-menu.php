<?php

namespace PD\ACF\Customize\MobileMenu;

use function PD\ACF\Utils\acf_typography_fields;

function init () {  
  acf_add_local_field_group([
    'key' => 'group_customize_mobile_menu',
    'title' => 'Mobile Menu',
    'location' => [
      [
        [
	  'param' => 'options_page',
	  'operator' => '==',
	  'value' => 'customize',
        ],
      ],
    ],
    'menu_order' => 3,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_graphql' => 1,
    'graphql_field_name' => 'customizeMobileMenu',
    'map_graphql_types_from_location_rules' => 0,
    'graphql_types' => '',
    'fields' => [
      [
        'key' => "field_mobile_menu_enabled",
        'label' => 'Enabled',
        'name' => "mobile_menu_enabled",
        'graphql_field_name' => 'enabled',
        'type' => 'true_false',
        'wrapper' => [
	        'width' => 25
        ],
        'show_in_graphql' => 1,
        'default_value' => 0,
        'ui' => 1
      ],
      [
        'key' => 'field_mobile_menu_button',
        'label' => 'Button',
        'type' => 'tab',
        'show_in_graphql' => 1,
        'conditional_logic' => [
          [
            [
              'field' => "field_mobile_menu_enabled",
              'operator' => '==',
              'value' => '1'
            ],
          ],
        ],
      ],
      [
	'key' => 'field_mobile_menu_button_background_color',
	'label' => 'Background Color',
	'name' => 'mobile_menu_button_background_color',
        'graphql_field_name' => 'buttonBackgroundColor',
	'type' => 'select',
	'show_in_graphql' => 1,
        'ui' => 1,
        'wrapper' => [
	  'width' => 25,	  
	],
      ],
      [
        'key' => 'field_mobile_menu_button_icon',
        'label' => 'Icon',
        'name' => 'mobile_menu_button_icon',
        'graphql_field_name' => 'icon',
        'type' => 'image',
        'wrapper' => [
	  'width' => 25
        ],
        'show_in_graphql' => 1,        
        'return_format' => 'array',
        'preview_size' => 'medium',
        'library' => 'all'
      ],
      [
        'key' => 'field_mobile_menu_button_close_icon',
        'label' => 'Close Icon',
        'name' => 'mobile_menu_button_close_icon',
        'graphql_field_name' => 'closeIcon',
        'type' => 'image',
        'wrapper' => [
	  'width' => 25
        ],
        'show_in_graphql' => 1,        
        'return_format' => 'array',
        'preview_size' => 'medium',
        'library' => 'all'
      ],            
      [
        'key' => 'field_mobile_menu_typography_tab',
        'label' => 'Typography',
        'type' => 'tab',
        'show_in_graphql' => 1,
        'conditional_logic' => [
          [
            [
              'field' => "field_mobile_menu_enabled",
              'operator' => '==',
              'value' => '1'
            ],
          ],
        ],
      ],      
      [
	'key' => 'field_mobile_menu_typography_mobile',
	'name' => 'mobile_menu_typography_mobile',
        'graphql_field_name' => 'mobile',
        'label' => 'Mobile',
	'type' => 'group',
	'show_in_graphql' => 1,
	'layout' => 'block',
	'sub_fields' => [
          ...acf_typography_fields([
            'key' => 'field_mobile_menu_typography_mobile_regular',
            'name' => 'mobile_menu_typography_mobile_regular',
            'graphql_field_name' => 'regular',
            'label' => 'Link',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 12,
              'letter_spacing' => 0,
              'line_height' => 1.6,
              'font_weight' => 'normal',
              'text_transform' => 'none'
            ]                       
          ]),          
        ]
      ],      
    ],    
  ]);   
}

add_action('acf/init', __NAMESPACE__ . '\\init');
