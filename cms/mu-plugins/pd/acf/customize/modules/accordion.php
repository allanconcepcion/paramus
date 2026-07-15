<?php

namespace PD\ACF\Customize\Modules\Accordion;

use function PD\ACF\Utils\acf_typography_fields;
use function PD\ACF\Utils\acf_background_position_field;

function fields ( $key, $label ) {
  return [
    [
      'key' => "field_accordion_accordion_{$key}",
      'label' => "Accordion - {$label}",
      'type' => 'accordion',
      'open' => 0,
      'multi_expand' => 1,
      'show_in_graphql' => 1,
    ],
    [
      'key' => "field_modules_accordion_group_{$key}",
      'name' => "accordion_{$key}",
      'type' => 'group',
      'show_in_graphql' => 1,
      'layout' => 'block',
      'sub_fields' => [        
        [
          'key' => "field_modules_accordion_text_tab_{$key}",
          'label' => 'Text',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => "field_modules_accordion_text_style_accordion_{$key}",
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
          'key' => "field_modules_accordion_style_headline_color_{$key}",
          'label' => 'Headline Color',
          'name' => "modules_accordion_style_headline_color_{$key}",
          'graphql_field_name' => 'headlineColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 25
          ],
        ],          
        [
          'key' => "field_modules_accordion_style_headline_color_bold_{$key}",
          'label' => "Headline Color (Bold)",
          'name' => "modules_accordion_style_headline_color_bold_{$key}",
          'graphql_field_name' => 'headlineColorBold',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 25,	  
          ],
        ],         
        [
          'key' => "field_modules_accordion_style_text_color_{$key}",
          'label' => 'Text Color',
          'name' => "modules_accordion_style_text_color_{$key}",
          'graphql_field_name' => 'color',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 25
          ],
        ],
        [
          'key' => "field_modules_accordion_style_item_border_color_{$key}",
          'label' => 'Border Color',
          'name' => "modules_accordion_style_item_border_color_{$key}",
          'graphql_field_name' => 'itemBorderColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 25
          ],
        ],        
        [
          'key' => "field_modules_accordion_text_style_desktop_{$key}",
          'name' => 'text_desktop',
          'label' => 'Desktop',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
            ...acf_typography_fields([
              'key' => "field_modules_accordion_item_title_style_desktop_regular_{$key}",
              'name' => "modules_accordion_item_title_style_desktop_regular_{$key}",
              'graphql_field_name' => 'itemTitleRegular',
              'label' => 'Item Title',
              'defaults' => [
                'font_family' => 'primary',
                'font_size' => 22,
                'letter_spacing' => 0,
                'line_height' => 1,
                'font_weight' => 'normal',
                'text_transform' => 'none'
              ]
            ]),
          ]
        ],
        [
          'key' => "field_modules_accordion_text_style_mobile_{$key}",
          'name' => 'text_mobile',
          'label' => 'Mobile',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
            ...acf_typography_fields([
              'key' => "field_modules_accordion_item_title_style_mobile_regular_{$key}",
              'name' => "modules_accordion_item_title_style_mobile_regular_{$key}",
              'graphql_field_name' => 'itemTitleRegular',
              'label' => 'Item Title',
              'defaults' => [
                'font_family' => 'primary',
                'font_size' => 18,
                'letter_spacing' => 0,
                'line_height' => 1,
                'font_weight' => 'normal',
                'text_transform' => 'none'
              ]
            ]),
          ]
        ],        
        [
          'key' => "field_modules_accordion_text_style_accordion_end_{$key}",
          'label' => 'Accordion End',
          'type' => 'accordion',
          'endpoint' => 1,            
        ],        
        [
          'key' => "field_modules_accordion_background_tab_{$key}",
          'label' => 'Background',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => "field_modules_accordion_background_style_accordion_{$key}",
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
          'key' => "field_modules_accordion_style_background_color_{$key}",
          'label' => 'Background Color',
          'name' => "modules_accordion_style_background_color_{$key}",
          'graphql_field_name' => 'backgroundColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 25
          ],
        ],
        [
          'key' => "field_modules_accordion_background_style_desktop_{$key}",
          'name' => "background_desktop",
          'label' => 'Desktop',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
            [
              'key' => "field_modules_accordion_style_desktop_background_image_{$key}",
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
              'key' => "field_background_position_desktop_{$key}",
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
          'key' => "field_modules_accordion_background_style_mobile_{$key}",
          'name' => 'background_mobile',
          'label' => 'Mobile',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
            [
              'key' => "field_modules_accordion_style_mobile_background_image_{$key}",
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
              'key' => "field_background_position_mobile_{$key}",
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
          'key' => "field_modules_accordion_background_style_accordion_end_{$key}",
          'label' => 'Accordion End',
          'type' => 'accordion',
          'endpoint' => 1,            
        ],
      ]
    ],
    [      
      'key' => "field_accordion_accordion_end_{$key}",
      'label' => 'Accordion End',
      'type' => 'accordion',
      'endpoint' => 1,            
    ],          
  ];
}
