<?php

namespace PD\ACF\Customize\Modules\Timeline;

use function PD\ACF\Utils\acf_typography_fields;
use function PD\ACF\Utils\acf_background_position_field;

function fields ( $key, $label ) {
  return [
    [
      'key' => "field_timeline_accordion_{$key}",
      'label' => "Timeline - {$label}",
      'type' => 'accordion',
      'open' => 0,
      'multi_expand' => 1,
      'show_in_graphql' => 1,
    ],
    [
      'key' => "field_modules_timeline_group_{$key}",
      'name' => "timeline_{$key}",
      'type' => 'group',
      'show_in_graphql' => 1,
      'layout' => 'block',
      'sub_fields' => [        
        [
          'key' => "field_timeline_text_tab_{$key}",
          'label' => 'Text',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => "field_timeline_text_style_accordion_{$key}",
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
          'key' => "field_modules_timeline_headline_color_{$key}",
          'label' => 'Headline Color',
          'name' => "modules_timeline_headline_color_{$key}",
          'graphql_field_name' => 'headlineColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 25,
          ],
        ],
        [
          'key' => "field_modules_timeline_headline_color_bold_{$key}",
          'label' => 'Headline Color (Bold)',
          'name' => "modules_timeline_headline_color_bold_{$key}",
          'graphql_field_name' => 'headlineColorBold',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 25,
          ],
        ],
        [
          'key' => "field_modules_timeline_body_color_{$key}",
          'label' => 'Body Color',
          'name' => "modules_timeline_body_color_{$key}",
          'graphql_field_name' => 'bodyColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 25,
          ],
        ],
        [
          'key' => "field_timeline_headline_style_accordion_end_{$key}",
          'label' => 'Accordion End',
          'type' => 'accordion',
          'endpoint' => 1,            
        ],
        [
          'key' => "field_timeline_cards_tab_{$key}",
          'label' => 'Cards',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => "field_modules_timeline_cards_style_accordion_{$key}",
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
          'key' => "field_modules_timeline_cards_style_background_color_{$key}",
          'label' => 'Background Color',
          'name' => "modules_timeline_cards_style_background_color_{$key}",
          'graphql_field_name' => 'cardsBackgroundColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 33.33
          ],
        ],
        [
          'key' => "field_modules_timeline_cards_style_title_color_{$key}",
          'label' => 'Title Color',
          'name' => "modules_timeline_cards_style_title_color_{$key}",
          'graphql_field_name' => 'cardsTitleColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 33.33
          ],
        ],
        [
          'key' => "field_modules_timeline_cards_style_color_{$key}",
          'label' => 'Body Color',
          'name' => "modules_timeline_cards_style_color_{$key}",
          'graphql_field_name' => 'cardsColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 33.33
          ],
        ],
        [
          'key' => "field_modules_timeline_cards_style_accordion_end_{$key}",
          'label' => 'Accordion End',
          'type' => 'accordion',
          'endpoint' => 1,            
        ],
        [
          'key' => "field_timeline_timeline_tab_{$key}",
          'label' => 'Timeline',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => "field_modules_timeline_timeline_style_accordion_{$key}",
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
          'key' => "field_modules_timeline_timeline_style_progress_color_{$key}",
          'label' => 'Progress Color',
          'name' => "modules_timeline_timeline_style_progress_color_{$key}",
          'graphql_field_name' => 'timelineProgressColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 33.33
          ],
        ],
        [
          'key' => "field_modules_timeline_timeline_style_accent_color_{$key}",
          'label' => 'Accent Color',
          'name' => "modules_timeline_timeline_style_accent_color_{$key}",
          'graphql_field_name' => 'timelineAccentColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 33.33
          ],
        ],
        [
          'key' => "field_modules_timeline_timeline_style_text_color_{$key}",
          'label' => 'Text Color',
          'name' => "modules_timeline_timeline_style_text_color_{$key}",
          'graphql_field_name' => 'timelineTextColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 33.33
          ],
        ],
        [
          'key' => "field_modules_timeline_timeline_style_desktop_{$key}",
          'name' => 'timeline_desktop',
          'label' => 'Desktop',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
           ...acf_typography_fields([
             'key' => "field_modules_timeline_timeline_style_desktop_regular_{$key}",
             'name' => "modules_timeline_timeline_style_desktop_regular_{$key}",
             'graphql_field_name' => 'regular',
             'label' => '',
             'defaults' => [
               'font_family' => 'primary',
               'font_size' => 20,
               'letter_spacing' => 0,
               'line_height' => 1,
               'font_weight' => 600,
               'text_transform' => 'none'
             ]
           ]),
          ]
        ],
        [
          'key' => "field_modules_timeline_timeline_style_mobile_{$key}",
          'name' => 'timeline_mobile',
          'label' => 'Mobile',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
           ...acf_typography_fields([
             'key' => "field_modules_timeline_timeline_style_mobile_regular_{$key}",
             'name' => "modules_timeline_timeline_style_mobile_regular_{$key}",
             'graphql_field_name' => 'regular',
             'label' => '',
             'defaults' => [
               'font_family' => 'primary',
               'font_size' => 20,
               'letter_spacing' => 0,
               'line_height' => 1,
               'font_weight' => 600,
               'text_transform' => 'none'
             ]
           ]),
          ]
        ],                
        [      
          'key' => "field_modules_timeline_timeline_style_accordion_end_{$key}",
          'label' => 'Accordion End',
          'type' => 'accordion',
          'endpoint' => 1,            
        ], 
        [
          'key' => "field_modules_timeline_background_tab_{$key}",
          'label' => 'Background',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => "field_modules_timeline_background_style_accordion_{$key}",
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
          'key' => "field_modules_timeline_style_background_color_{$key}",
          'label' => 'Background Color',
          'name' => "modules_timeline_style_background_color_{$key}",
          'graphql_field_name' => 'backgroundColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 25
          ],
        ], 
        [
          'key' => "field_modules_timeline_background_style_desktop_{$key}",
          'name' => "background_desktop",
          'label' => 'Desktop',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
            [
              'key' => "field_modules_timeline_style_desktop_background_image_{$key}",
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
          'key' => "field_modules_timeline_background_style_mobile_{$key}",
          'name' => 'background_mobile',
          'label' => 'Mobile',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
            [
              'key' => "field_modules_timeline_style_mobile_background_image_{$key}",
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
          'key' => "field_modules_timeline_background_style_accordion_end_{$key}",
          'label' => 'Accordion End',
          'type' => 'accordion',
          'endpoint' => 1,            
        ],         
      ],      
    ],
    [      
      'key' => "field_timeline_accordion_end_{$key}",
      'label' => 'Accordion End',
      'type' => 'accordion',
      'endpoint' => 1,            
    ],          
  ];
}
