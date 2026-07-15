<?php

namespace PD\ACF\Customize\Components\Pagination;

use function PD\ACF\Utils\acf_typography_fields;

function fields () {
  return [
    [
      'key' => 'field_components_pagination_accordion',
      'label' => 'Pagination',
      'type' => 'accordion',
      'open' => 0,
      'multi_expand' => 1,
      'show_in_graphql' => 1,
    ],
    [
      'key' => 'field_components_pagination_group',
      'name' => 'pagination',
      'type' => 'group',
      'show_in_graphql' => 1,
      'layout' => 'block',
      'sub_fields' => [
        [
          'key' => 'field_components_pagination_links_tab',
          'label' => 'Links',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => 'field_components_pagination_links_style_accordion',
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
	  'key' => 'field_components_pagination_links_desktop',
	  'name' => 'desktop',
          'label' => 'Desktop',
	  'type' => 'group',
	  'show_in_graphql' => 1,
	  'layout' => 'block',
	  'sub_fields' => [
            ...acf_typography_fields([
              'key' => 'field_components_pagination_links_desktop_regular',
              'name' => 'components_pagination_links_desktop_regular',
              'graphql_field_name' => 'regular',
              'label' => 'Regular',
              'defaults' => [
                'font_family' => 'primary',
                'font_size' => 15,
                'letter_spacing' => 0,
                'line_height' => 1.6,
                'font_weight' => 300,
                'text_transform' => 'none'
              ]                       
            ]),
          ]
        ],
        [
	  'key' => 'field_components_pagination_links_mobile',
	  'name' => 'mobile',
          'label' => 'Mobile',
	  'type' => 'group',
	  'show_in_graphql' => 1,
	  'layout' => 'block',
	  'sub_fields' => [
            ...acf_typography_fields([
              'key' => 'field_components_pagination_links_mobile_regular',
              'name' => 'components_pagination_links_mobile_regular',
              'graphql_field_name' => 'regular',
              'label' => 'Regular',
              'defaults' => [
                'font_family' => 'primary',
                'font_size' => 15,
                'letter_spacing' => 0,
                'line_height' => 1.6,
                'font_weight' => 300,
                'text_transform' => 'none'
              ]                       
            ]),
          ]
        ],                      
        [
          'key' => 'field_modules_pagination_links_style_accordion_end',
          'label' => 'Accordion End',
          'type' => 'accordion',
          'endpoint' => 1,            
        ],
      ]
    ], 
  ];
}
