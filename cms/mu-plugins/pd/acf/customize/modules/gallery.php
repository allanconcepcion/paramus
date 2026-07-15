<?php

namespace PD\ACF\Customize\Modules\Gallery;

use function PD\ACF\Utils\acf_typography_fields;
use function PD\ACF\Utils\acf_cta_icon_fields;
use function PD\ACF\Utils\acf_background_position_field;

function fields ( $key, $label ) {
  return [
    [
      'key' => "field_modules_gallery_accordion_{$key}",
      'label' => "Gallery - {$label}",
      'type' => 'accordion',
      'open' => 0,
      'multi_expand' => 1,
      'show_in_graphql' => 1,
    ],
    [
      'key' => "field_modules_gallery_group_{$key}",
      'name' => "gallery_{$key}",
      'type' => 'group',
      'show_in_graphql' => 1,
      'layout' => 'block',
      'sub_fields' => [
        [
          'key' => "field_modules_gallery_text_tab_{$key}",
          'label' => 'Text',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => "field_modules_gallery_text_style_accordion_{$key}",
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
          'key' => "field_modules_gallery_style_headline_color_{$key}",
          'label' => 'Headline Color',
          'name' => "modules_gallery_style_headline_color_{$key}",
          'graphql_field_name' => 'headlineColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 25
          ],
        ],
        [
          'key' => "field_modules_gallery_style_headline_color_bold_{$key}",
          'label' => "Headline Color (Bold)",
          'name' => "modules_gallery_style_headline_color_bold_{$key}",
          'graphql_field_name' => 'headlineColorBold',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 25,	  
          ],
        ],         
        [
          'key' => "field_modules_gallery_style_text_color_{$key}",
          'label' => 'Text Color',
          'name' => "modules_gallery_style_text_color_{$key}",
          'graphql_field_name' => 'textColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 25
          ],
        ],        
        [
          'key' => "field_modules_gallery_text_style_accordion_end_{$key}",
          'label' => 'Style',
          'type' => 'accordion',
          'endpoint' => 1,
        ],        
        [
          'key' => "field_modules_gallery_navigation_tab_{$key}",
          'label' => 'Navigation',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => "field_modules_gallery_navigation_style_accordion_{$key}",
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
          'key' => "field_modules_gallery_navigation_border_color_{$key}",
          'label' => 'Border Color',
          'name' => "modules_gallery_navigation_border_color_{$key}",
          'graphql_field_name' => 'navigationBorderColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 25,
          ],
        ],          
        [
          'key' => "field_modules_gallery_navigation_style_desktop_{$key}",
	        'name' => "modules_gallery_navigation_style_desktop_{$key}",
          'graphql_field_name' => 'navigationStyleDesktop',
          'label' => 'Desktop',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
            ...acf_typography_fields([
              'key' => "field_modules_gallery_navigation_regular_typography_desktop_{$key}",
              'name' => "modules_gallery_navigation_regular_typography_desktop_{$key}",
              'graphql_field_name' => 'regular',
              'label' => 'Regular',
              'defaults' => [
                'font_family' => 'primary',
                'font_size' => 22,
                'letter_spacing' => 0,
                'line_height' => 1,
                'font_weight' => 'normal',
                'text_transform' => 'none'
              ]                       
            ]),
            ...acf_typography_fields([
              'key' => "field_modules_gallery_navigation_bold_typography_desktop_{$key}",
              'name' => "modules_gallery_navigation_bold_typography_desktop_{$key}",
              'graphql_field_name' => 'bold',
              'label' => 'Bold',
              'defaults' => [
                'font_family' => 'primary',
                'font_size' => 22,
                'letter_spacing' => 0,
                'line_height' => 1,
                'font_weight' => '900',
                'text_transform' => 'none'
              ]                       
            ]),            
          ]
        ],
        [
          'key' => "field_modules_gallery_navigation_style_mobile_{$key}",
	        'name' => "modules_gallery_navigation_style_mobile_{$key}",
          'graphql_field_name' => 'navigationStyleMobile',
          'label' => 'Mobile',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
           ...acf_typography_fields([
             'key' => "field_modules_gallery_navigation_regular_typography_mobile_{$key}",
             'name' => "modules_gallery_navigation_regular_typography_mobile_{$key}",
             'graphql_field_name' => 'regular',
             'label' => 'Regular',
             'defaults' => [
               'font_family' => 'primary',
               'font_size' => 22,
               'letter_spacing' => 0,
               'line_height' => 1,
               'font_weight' => 'normal',
               'text_transform' => 'none'
             ]                       
           ]),
           ...acf_typography_fields([
             'key' => "field_modules_gallery_navigation_bold_typography_mobile_{$key}",
             'name' => "modules_gallery_navigation_bold_typography_mobile_{$key}",
             'graphql_field_name' => 'bold',
             'label' => 'Bold',
             'defaults' => [
               'font_family' => 'primary',
               'font_size' => 22,
               'letter_spacing' => 0,
               'line_height' => 1,
               'font_weight' => 900,
               'text_transform' => 'none'
             ]                       
           ]),           
          ]
        ],
        [
          'key' => "field_modules_gallery_navigation_style_accordion_end_{$key}",
          'label' => 'Accordion End',
          'type' => 'accordion',
          'endpoint' => 1,            
        ],
        [
          'key' => "field_modules_gallery_items_tab_{$key}",
          'label' => 'Items',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],        
        [
          'key' => "field_modules_gallery_items_style_accordion_{$key}",
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
          'key' => "field_modules_gallery_items_tool_border_color_{$key}",
          'label' => 'Tool Border Color',
          'name' => "modules_gallery_items_tool_border_color_{$key}",
          'graphql_field_name' => 'toolBorderColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 25,
          ],
        ],
        [
          'key' => "field_modules_gallery_items_tool_icon_color_{$key}",
          'label' => 'Tool Icon Color',
          'name' => "modules_gallery_items_tool_icon_color_{$key}",
          'graphql_field_name' => 'toolIconColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 25,
          ],
        ],
        [
          'key' => "field_modules_gallery_items_tool_outer_background_color_{$key}",
          'label' => 'Tool Outer Background Color',
          'name' => "modules_gallery_items_tool_outer_background_color_{$key}",
          'graphql_field_name' => 'toolOuterBackgroundColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 25,
          ],
        ],
        [
          'key' => "field_modules_gallery_items_tool_inner_background_color_{$key}",
          'label' => 'Tool Inner Background Color',
          'name' => "modules_gallery_items_tool_inner_background_color_{$key}",
          'graphql_field_name' => 'toolInnerBackgroundColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 25,
          ],
        ],
        [
          'key' => "field_modules_gallery_items_label_color_{$key}",
          'label' => 'Label Color',
          'name' => "modules_gallery_items_label_color_{$key}",
          'graphql_field_name' => 'labelColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 25,
          ],
        ],                
        [
          'key' => "field_modules_gallery_items_label_background_color_{$key}",
          'label' => 'Label Background Color',
          'name' => "modules_gallery_items_label_background_color_{$key}",
          'graphql_field_name' => 'labelBackgroundColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 25,
          ],
        ],        
        [
          'key' => "field_modules_gallery_items_style_desktop_{$key}",
	        'name' => "modules_gallery_items_style_desktop_{$key}",
          'graphql_field_name' => 'itemsStyleDesktop',
          'label' => 'Desktop',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
           ...acf_typography_fields([
             'key' => "field_modules_gallery_items_label_typography_desktop_{$key}",
             'name' => "modules_gallery_items_label_typography_desktop_{$key}",
             'graphql_field_name' => 'label',
             'label' => 'Label',
             'defaults' => [
               'font_family' => 'primary',
               'font_size' => 8,
               'letter_spacing' => 0,
               'line_height' => 1,
               'font_weight' => 'normal',
               'text_transform' => 'uppercase'
             ]                       
           ]),
          ]
        ],
        [
          'key' => "field_modules_gallery_items_style_mobile_{$key}",
	        'name' => "modules_gallery_items_style_mobile_{$key}",
          'graphql_field_name' => 'itemsStyleMobile',
          'label' => 'Mobile',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
            ...acf_typography_fields([
              'key' => "field_modules_gallery_items_label_typography_mobile_{$key}",
              'name' => "modules_gallery_items_label_typography_mobile_{$key}",
              'graphql_field_name' => 'label',
              'label' => 'Label',
              'defaults' => [
                'font_family' => 'primary',
                'font_size' => 8,
                'letter_spacing' => 0,
                'line_height' => 1,
                'font_weight' => 'normal',
                'text_transform' => 'uppercase'
              ]                       
            ]),
          ]
        ],                                   
        [
          'key' => "field_modules_gallery_items_style_accordion_end_{$key}",
          'label' => 'Accordion End',
          'type' => 'accordion',
          'endpoint' => 1,            
        ],
        [
          'key' => "field_modules_gallery_cta_tab_{$key}",
          'label' => 'CTA',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => "field_modules_gallery_cta_style_accordion_{$key}",
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        ...acf_cta_icon_fields([
          'key' => "field_modules_gallery_cta_{$key}",
          'name' => "modules_gallery_{$key}",
        ]),        
        [
          'key' => "field_modules_gallery_cta_style_accordion_end_{$key}",
          'label' => 'Accordion End',
          'type' => 'accordion',
          'endpoint' => 1,            
        ],
        [
          'key' => "field_modules_gallery_background_tab_{$key}",
          'label' => 'Background',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => "field_modules_gallery_background_style_accordion_{$key}",
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
          'key' => "field_modules_gallery_style_background_color_{$key}",
          'label' => 'Background Color',
          'name' => "modules_gallery_style_background_color_{$key}",
          'graphql_field_name' => 'backgroundColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 25
          ],
        ],
        [
          'key' => "field_modules_gallery_background_style_desktop_{$key}",
          'name' => "background_desktop",
          'label' => 'Desktop',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
            [
              'key' => "field_modules_gallery_style_desktop_background_image_{$key}",
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
          'key' => "field_modules_gallery_background_style_mobile_{$key}",
          'name' => 'background_mobile',
          'label' => 'Mobile',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
            [
              'key' => "field_modules_gallery_style_mobile_background_image_{$key}",
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
      ]
    ],
    [
      'key' => "field_modules_gallery_accordion_end_{$key}",
      'label' => 'Accordion End',
      'type' => 'accordion',
      'endpoint' => 1,            
    ],
  ];
}
