<?php

namespace PD\ACF\Customize\Modules\Text;

use function PD\ACF\Utils\acf_cta_icon_fields;
use function PD\ACF\Utils\acf_background_position_field;            

function fields () {
  return [
    [
      'key' => 'field_modules_text_accordion',
      'label' => 'Text',
      'type' => 'accordion',
      'open' => 0,
      'multi_expand' => 1,
      'show_in_graphql' => 1,
    ],
    [
      'key' => 'field_modules_text_group',
      'name' => 'text',
      'type' => 'group',
      'show_in_graphql' => 1,
      'layout' => 'block',
      'sub_fields' => [
        [
          'key' => 'field_modules_text_headline_tab',
          'label' => 'Headline',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => 'field_modules_text_headline_style_accordion',
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
          'key' => "field_modules_text_headline_style_color",
          'label' => "Color",
          'name' => "modules_text_headline_style_color",
          'graphql_field_name' => 'headlineColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 33.33,	  
          ],
        ],        
        [
          'key' => "field_modules_text_headline_style_color_bold",
          'label' => "Color (Bold)",
          'name' => "modules_text_headline_style_color_bold",
          'graphql_field_name' => 'headlineColorBold',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 33.33,	  
          ],
        ],        
        [
          'key' => 'field_modules_text_headline_style_accordion_end',
          'label' => 'Accordion End',
          'type' => 'accordion',
          'endpoint' => 1,            
        ],        
        [
          'key' => 'field_modules_text_cta_tab',
          'label' => 'Cta',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => 'field_modules_text_cta_style_accordion',
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        ...acf_cta_icon_fields([
          'key' => 'field_modules_text',
          'name' => 'modules_text'
        ]),
        [
          'key' => 'field_modules_text_cta_style_accordion_end',
          'label' => 'Accordion End',
          'type' => 'accordion',
          'endpoint' => 1,            
        ],
        [
          'key' => "field_modules_text_background_tab",
          'label' => 'Background',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => "field_modules_text_background_style_accordion",
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
          'key' => "field_modules_text_background_style_desktop",
          'name' => 'background_desktop',
          'label' => 'Desktop',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
            [
              'key' => "field_modules_text_style_desktop_background_image",
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
              'key' => 'field_modules_text_style_background_position_desktop',
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
          'key' => "field_modules_text_background_style_mobile",
          'name' => 'background_mobile',
          'label' => 'Mobile',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
            [
              'key' => "field_modules_text_style_mobile_background_image",
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
              'key' => 'field_modules_text_style_background_position_mobile',
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
          'key' => "field_modules_text_background_style_accordion_end",
          'label' => 'Accordion End',
          'type' => 'accordion',
          'endpoint' => 1,            
        ],
      ]
    ], 
  ];
}
