<?php

namespace PD\ACF\Customize\Modules\IconBlocks;

use function PD\ACF\Utils\acf_typography_fields;
use function PD\ACF\Utils\acf_background_position_field;            

function fields () {
  return [
    [
      'key' => 'field_modules_icon_blocks_accordion',
      'label' => 'Icon Blocks',
      'type' => 'accordion',
      'open' => 0,
      'multi_expand' => 1,
      'show_in_graphql' => 1,
    ],
    [
      'key' => 'field_modules_icon_blocks_group',
      'name' => 'icon_blocks',
      'type' => 'group',
      'show_in_graphql' => 1,
      'layout' => 'block',
      'sub_fields' => [
        [
          'key' => 'field_modules_icon_blocks_blocks_tab',
          'label' => 'Blocks',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => 'field_modules_icon_blocks_blocks_style_accordion',
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
          'key' => 'field_modules_icon_blocks_blocks_style_desktop',
	        'name' => 'modules_icon_blocks_blocks_style_desktop',
          'graphql_field_name' => 'blocksStyleDesktop',
          'label' => 'Desktop',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
            ...acf_typography_fields([
              'key' => 'field_modules_icon_blocks_blocks_label_typography_desktop',
              'name' => 'modules_icon_blocks_blocks_label_typography_desktop',
              'graphql_field_name' => 'label',
              'label' => 'Label',
              'defaults' => [
                'font_family' => 'primary',
                'font_size' => 22,
                'letter_spacing' => .05,
                'line_height' => 1,
                'font_weight' => 'normal',
                'text_transform' => 'uppercase'
              ]                       
            ]),
            ...acf_typography_fields([
              'key' => 'field_modules_icon_blocks_blocks_body_typography_desktop',
              'name' => 'modules_icon_blocks_blocks_body_typography_desktop',
              'graphql_field_name' => 'body',
              'label' => 'Body',
              'defaults' => [
                'font_family' => 'primary',
                'font_size' => 16,
                'letter_spacing' => .1,
                'line_height' => 1,
                'font_weight' => 300,
                'text_transform' => 'uppercase'
              ]                       
            ]),
          ]
        ],
        [
          'key' => 'field_modules_icon_blocks_blocks_style_mobile',
          'name' => 'modules_icon_blocks_blocks_style_mobile',
          'graphql_field_name' => 'blocksStyleMobile',
          'label' => 'Mobile',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
            ...acf_typography_fields([
              'key' => 'field_modules_icon_blocks_blocks_label_typography_mobile',
              'name' => 'modules_icon_blocks_blocks_label_typography_mobile',
              'graphql_field_name' => 'label',
              'label' => 'Label',
              'defaults' => [
                'font_family' => 'primary',
                'font_size' => 22,
                'letter_spacing' => .05,
                'line_height' => 1,
                'font_weight' => 'normal',
                'text_transform' => 'uppercase'
              ]                       
            ]),
            ...acf_typography_fields([
              'key' => 'field_modules_icon_blocks_blocks_body_typography_mobile',
              'name' => 'modules_icon_blocks_blocks_body_typography_mobile',
              'graphql_field_name' => 'body',
              'label' => 'Body',
              'defaults' => [
                'font_family' => 'primary',
                'font_size' => 16,
                'letter_spacing' => .1,
                'line_height' => 1,
                'font_weight' => 300,
                'text_transform' => 'uppercase'
              ]                       
            ]),
          ]
        ],        
        [
          'key' => 'field_modules_icon_blocks_blocks_style_accordion_end',
          'label' => 'Accordion End',
          'type' => 'accordion',
          'endpoint' => 1,            
        ],
        [
          'key' => "field_modules_icon_blocks_background_tab",
          'label' => 'Background',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => "field_modules_icon_blocks_background_style_accordion",
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
          'key' => "field_modules_icon_blocks_background_style_desktop",
          'name' => 'background_desktop',
          'label' => 'Desktop',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
            [
              'key' => "field_modules_icon_blocks_style_desktop_background_image",
              'label' => 'Background Image',
              'name' => 'background_image',              
              'graphql_field_name' => 'backgroundImage',
              'type' => 'image',
              'instructions' => 'Displays if `Background Image` is enabled at the module level.',
              'show_in_graphql' => 1,
              'return_format' => 'array',
              'preview_size' => 'medium',
              'library' => 'all',
              'wrapper' => [
                'width' => 50
              ],
            ],
            ...acf_background_position_field([
              'key' => 'field_background_position_desktop',
              'label' => 'Background Position',
              'name' => 'background_position_desktop',
              'graphql_field_name' => 'backgroundPosition',
              'wrapper' => [
                'width' => 50
              ]
            ]),            
          ]
        ],
        [
          'key' => "field_modules_icon_blocks_background_style_mobile",
          'name' => 'background_mobile',
          'label' => 'Mobile',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
            [
              'key' => "field_modules_icon_blocks_style_mobile_background_image",
              'label' => 'Background Image',
              'name' => 'background_image',
              'graphql_field_name' => 'backgroundImage',
              'type' => 'image',
              'instructions' => 'Displays if `Background Image` is enabled at the module level.',
              'show_in_graphql' => 1,
              'return_format' => 'array',
              'preview_size' => 'medium',
              'library' => 'all',
              'wrapper' => [
                'width' => 50
              ],
            ],
            ...acf_background_position_field([
              'key' => 'field_background_position_mobile',
              'label' => 'Background Position',
              'name' => 'background_position_mobile',
              'graphql_field_name' => 'backgroundPosition',
              'wrapper' => [
                'width' => 50
              ]
            ]),            
          ]
        ],                              
        [
          'key' => "field_modules_icon_blocks_background_style_accordion_end",
          'label' => 'Accordion End',
          'type' => 'accordion',
          'endpoint' => 1,            
        ],
      ]
    ], 
  ];
}
