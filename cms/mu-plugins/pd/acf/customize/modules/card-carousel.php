<?php

namespace PD\ACF\Customize\Modules\CardCarousel;

use function PD\ACF\Utils\acf_typography_fields;
use function PD\ACF\Utils\acf_background_position_field;

function fields ( $key, $label ) {
  return [
    [
      'key' => "field_card_carousel_accordion_{$key}",
      'label' => "Card Carousel - {$label}",
      'type' => 'accordion',
      'open' => 0,
      'multi_expand' => 1,
      'show_in_graphql' => 1,
    ],
    [
      'key' => "field_modules_card_carousel_group_{$key}",
      'name' => "card_carousel_{$key}",
      'type' => 'group',
      'show_in_graphql' => 1,
      'layout' => 'block',
      'sub_fields' => [        
        [
          'key' => "field_modules_card_carousel_text_tab_{$key}",
          'label' => 'Text',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => "field_modules_card_carousel_text_style_accordion_{$key}",
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
          'key' => "field_modules_card_carousel_style_headline_color_{$key}",
          'label' => 'Headline Color',
          'name' => "modules_card_carousel_style_headline_color_{$key}",
          'graphql_field_name' => 'headlineColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 33.33
          ],
        ],          
        [
          'key' => "field_modules_card_carousel_style_headline_color_bold_{$key}",
          'label' => 'Headline Color (Bold)',
          'name' => "modules_card_carousel_style_headline_color_bold_{$key}",
          'graphql_field_name' => 'headlineColorBold',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 33.33
          ],
        ],          
        [
          'key' => "field_modules_card_carousel_style_text_color_{$key}",
          'label' => 'Text Color',
          'name' => "modules_card_carousel_style_text_color_{$key}",
          'graphql_field_name' => 'color',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 33.33
          ],
        ],  
        [
          'key' => "field_modules_card_carousel_text_style_desktop_{$key}",
	        'name' => "modules_card_carousel_text_style_desktop_{$key}",
          'graphql_field_name' => 'textStylesDesktop',
          'label' => 'Desktop',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
            ...acf_typography_fields([
              'key' => "field_modules_card_carousel_navigation_regular_typography_desktop_{$key}",
              'name' => "modules_card_carousel_navigation_regular_typography_desktop_{$key}",
              'graphql_field_name' => 'regular',
              'label' => 'Regular',
              'defaults' => [
                'font_family' => 'primary',
                'font_size' => 22,
                'letter_spacing' => 0.05,
                'line_height' => 1,
                'font_weight' => 'normal',
                'text_transform' => 'uppercase'
              ]                       
            ]),
          ]
        ],
        [
          'key' => "field_modules_card_carousel_text_style_mobile_{$key}",
	        'name' => "modules_card_carousel_text_style_mobile_{$key}",
          'graphql_field_name' => 'textStylesMobile',
          'label' => 'Mobile',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
           ...acf_typography_fields([
             'key' => "field_modules_card_carousel_navigation_regular_typography_mobile{$key}",
             'name' => "modules_card_carousel_navigation_regular_typography_mobile_{$key}",
             'graphql_field_name' => 'regular',
             'label' => 'Regular',
             'defaults' => [
               'font_family' => 'primary',
               'font_size' => 20,
               'letter_spacing' => 0.05,
               'line_height' => 1,
               'font_weight' => 'normal',
               'text_transform' => 'uppercase'
             ]                       
           ]),
          ]
        ], 

        [
          'key' => "field_modules_card_carousel_text_style_accordion_end_{$key}",
          'label' => 'Accordion End',
          'type' => 'accordion',
          'endpoint' => 1,            
        ],
        [
          'key' => "field_modules_card_carousel_icon_tab_{$key}",
          'label' => 'Icon',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => "field_modules_card_carousel_icon_style_accordion_{$key}",
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
          'key' => "field_modules_card_carousel_icon_style_accent_color_{$key}",
          'label' => 'Accent Color',
          'name' => "modules_card_carousel_icon_style_accent_color_{$key}",
          'graphql_field_name' => 'iconAccentColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 25
          ],
        ],                               
        [      
          'key' => "field_modules_card_carousel_icon_style_accordion_end_{$key}",
          'label' => 'Accordion End',
          'type' => 'accordion',
          'endpoint' => 1,            
        ],                  
        [
          'key' => "field_modules_card_carousel_background_tab_{$key}",
          'label' => 'Background',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => "field_modules_card_carousel_background_style_accordion_{$key}",
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
          'key' => "field_modules_card_carousel_background_color_{$key}",
          'label' => 'Background Color',
          'name' => "modules_card_carousel_background_color_{$key}",
          'graphql_field_name' => 'backgroundColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
            'width' => 25
          ],
        ],
        [
          'key' => "field_modules_card_carousel_background_style_desktop_{$key}",
          'name' => 'background_desktop',
          'label' => 'Desktop',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [            
            [
              'key' => "field_modules_card_carousel_style_desktop_background_image_{$key}",
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
              'key' => "field_modules_card_carousel_background_position_desktop_{$key}",
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
          'key' => "field_modules_card_carousel_background_style_mobile_{$key}",
          'name' => 'background_mobile',
          'label' => 'Mobile',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [            
            [
              'key' => "field_modules_card_carousel_style_mobile_background_image_{$key}",
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
              'key' => "field_modules_card_carousel_background_position_mobile_{$key}",
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
          'key' => "field_modules_card_carousel_background_style_accordion_end_{$key}",
          'label' => 'Accordion End',
          'type' => 'accordion',
          'endpoint' => 1,            
        ],
      ]
    ],
    [      
      'key' => "field_card_carousel_accordion_end_{$key}",
      'label' => 'Accordion End',
      'type' => 'accordion',
      'endpoint' => 1,            
    ],          
  ];
}
