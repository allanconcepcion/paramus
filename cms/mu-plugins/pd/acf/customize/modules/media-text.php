<?php

namespace PD\ACF\Customize\Modules\MediaText;

use function PD\ACF\Utils\acf_typography_fields;
use function PD\ACF\Utils\acf_cta_icon_fields;
use function PD\ACF\Utils\acf_background_position_field;

function fields ( $key, $label ) {
  return [
    [
      'key' => "field_modules_media_text_accordion_{$key}",
      'label' => "Media Text - {$label}",
      'type' => 'accordion',
      'open' => 0,
      'multi_expand' => 1,
      'show_in_graphql' => 1,
    ],
    [
      'key' => "field_modules_media_text_group_{$key}",
      'name' => "media_text_{$key}",
      'type' => 'group',
      'show_in_graphql' => 1,
      'layout' => 'block',
      'sub_fields' => [
        [
          'key' => "field_modules_media_text_text_tab_{$key}",
          'name' => "modules_media_text_text_tab_{$key}",
          'label' => 'Text',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => "field_modules_media_text_text_style_accordion_{$key}",
          'name' => "modules_media_text_text_style_accordion_{$key}",
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
          'key' => "field_modules_media_text_headline_style_color_{$key}",
          'label' => 'Headline Color',
          'name' => "modules_media_text_style_headline_color_{$key}",
          'graphql_field_name' => 'headlineColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 25
          ],
        ],          
        [
          'key' => "field_modules_media_text_headline_style_color_bold_{$key}",
          'label' => 'Headline Color (Bold)',
          'name' => "modules_media_text_style_headline_color_bold_{$key}",
          'graphql_field_name' => 'headlineColorBold',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 25
          ],
        ],          
        [
          'key' => "field_modules_media_text_text_style_color_{$key}",
          'label' => 'Body Color',
          'name' => "modules_media_text_style_text_color_{$key}",
          'graphql_field_name' => 'color',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 25
          ],
        ],  
        [
          'key' => "field_modules_media_text_text_style_border_color_{$key}",
          'label' => 'Border Color',
          'name' => "modules_media_text_style_border_color_{$key}",
          'graphql_field_name' => 'borderColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 25
          ],
        ],            
        [
          'key' => "field_modules_media_text_text_style_accordion_end_{$key}",
          'label' => 'Accordion End',
          'type' => 'accordion',
          'endpoint' => 1,            
        ],
        [
          'key' => "field_modules_media_text_video_titles_tab_{$key}",
          'label' => 'Video Titles',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => "field_modules_media_text_video_titles_style_accordion_{$key}",
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
          'key' => "field_modules_media_text_video_titles_style_desktop_{$key}",
	        'name' => "modules_media_text_video_titles_desktop_{$key}",
          'graphql_field_name' => 'videoTitlesStyleDesktop',
          'label' => 'Desktop',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
            ...acf_typography_fields([
              'key' => "field_modules_media_text_video_titles_regular_typography_desktop_{$key}",
              'name' => "modules_media_text_video_titles_regular_typography_desktop_{$key}",
              'graphql_field_name' => 'regular',
              'label' => 'Regular',
              'defaults' => [
                'font_family' => 'primary',
                'font_size' => 22,
                'letter_spacing' => 0,
                'line_height' => 1,
                'font_weight' => 600,
                'text_transform' => 'none'
              ]                       
            ]),
          ]
        ],
        [
          'key' => "field_modules_media_text_video_titles_style_mobile_{$key}",
	        'name' => "modules_media_text_video_titles_style_mobile_{$key}",
          'graphql_field_name' => 'videoTitlesStyleMobile',
          'label' => 'Mobile',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
           ...acf_typography_fields([
             'key' => "field_modules_media_text_video_titles_regular_typography_mobile_{$key}",
             'name' => "modules_media_text_video_titles_regular_typography_mobile_{$key}",
             'graphql_field_name' => 'regular',
             'label' => 'Regular',
             'defaults' => [
               'font_family' => 'primary',
               'font_size' => 22,
               'letter_spacing' => 0,
               'line_height' => 1,
               'font_weight' => 600,
               'text_transform' => 'none'
             ]                       
           ]),
          ]
        ],                
        [
          'key' => "field_modules_media_text_video_titles_style_accordion_end_{$key}",
          'label' => 'Style',
          'type' => 'accordion',
          'endpoint' => 1,
        ],                        
        [
          'key' => "field_modules_media_text_icon_tab_{$key}",
          'label' => 'CTA',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => "field_modules_media_text_icon_style_accordion_{$key}",
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        ...acf_cta_icon_fields([
          'key' => "field_modules_media_text_{$key}",
          'name' => "modules_media_text_{$key}",
          'label' => 'Default'
        ]),
        ...acf_cta_icon_fields([
          'key' => "field_modules_media_text_alt_{$key}",
          'name' => "modules_media_text_alt_{$key}",
          'graphql_field_name_prefix' => 'ctaIconAlt',
          'label' => 'Alt'
        ]),                
        [
          'key' => "field_modules_media_text_icon_style_accordion_end_{$key}",
          'label' => 'Accordion End',
          'type' => 'accordion',
          'endpoint' => 1,            
        ],
        [
          'key' => "field_modules_media_text_hotspots_tab_{$key}",
          'label' => 'Hotspots',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],

        [
          'key' => "field_modules_media_text_hotspots_style_accordion_{$key}",
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
          'key' => "field_modules_media_text_hotspots_button_icon_color_{$key}",
          'label' => 'Button Icon Color',
          'name' => "modules_media_text_hotspots_button_icon_color_{$key}",
          'graphql_field_name' => 'buttonIconColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 25
          ],
        ],   
        [
          'key' => "field_modules_media_text_hotspots_button_background_color_{$key}",
          'label' => 'Button Background Color',
          'name' => "modules_media_text_hotspots_button_background_color_{$key}",
          'graphql_field_name' => 'buttonBackgroundColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 25
          ],
        ],   
        [
          'key' => "field_modules_media_text_hotspots_label_color_{$key}",
          'label' => 'Label Color',
          'name' => "modules_media_text_hotspots_label_color_{$key}",
          'graphql_field_name' => 'labelColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 25
          ],
        ],   
        [
          'key' => "field_modules_media_text_hotspots_label_background_color_{$key}",
          'label' => 'Label Background Color',
          'name' => "modules_media_text_hotspots_label_background_color_{$key}",
          'graphql_field_name' => 'labelBackgroundColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 25
          ],
        ],   
        [
          'key' => "field_modules_media_text_hotspots_style_accordion_end_{$key}",
          'label' => 'Accordion End',
          'type' => 'accordion',
          'endpoint' => 1,            
        ],
        [
          'key' => "field_modules_media_text_background_tab_{$key}",
          'label' => 'Background',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => "field_modules_media_text_background_style_accordion_{$key}",
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
          'key' => "field_modules_media_text_background_style_desktop_{$key}",
          'name' => 'background_desktop',
          'label' => 'Desktop',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
            [
              'key' => "field_modules_media_text_style_desktop_background_color_{$key}",
              'label' => 'Background Color',
              'name' => "modules_media_text_style_desktop_background_color_{$key}",
              'graphql_field_name' => 'backgroundColor',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 33.33
              ],
            ],
            [
              'key' => "field_modules_media_text_style_desktop_background_image_{$key}",
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
                'width' => 33.33
              ],
            ],
            ...acf_background_position_field([
              'key' => "field_modules_media_text_background_position_desktop_{$key}",
              'label' => 'Background Position',
              'name' => 'background_position_desktop',
              'graphql_field_name' => 'backgroundPosition',
              'wrapper' => [
                'width' => 33.33
              ]
            ]),            
          ]
        ],
        [
          'key' => "field_modules_media_text_background_style_mobile_{$key}",
          'name' => 'background_mobile',
          'label' => 'Mobile',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
            [
              'key' => "field_modules_media_text_style_mobile_background_color_{$key}",
              'label' => 'Background Color',
              'name' => "modules_media_text_style_mobile_background_color_{$key}",
              'graphql_field_name' => 'backgroundColor',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 33.33
              ],
            ],
            [
              'key' => "field_modules_media_text_style_mobile_background_image_{$key}",
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
                'width' => 33.33
              ],
            ],
            ...acf_background_position_field([
              'key' => "field_modules_media_text_background_position_mobile_{$key}",
              'label' => 'Background Position',
              'name' => 'background_position_mobile',
              'graphql_field_name' => 'backgroundPosition',
              'wrapper' => [
                'width' => 33.33
              ]
            ]),            
          ]
        ],                              
        [
          'key' => "field_modules_media_text_background_style_accordion_end_{$key}",
          'label' => 'Accordion End',
          'type' => 'accordion',
          'endpoint' => 1,            
        ],        
      ]
    ],
    [      
      'key' => "field_modules_media_text_accordion_end_{$key}",
      'label' => 'Accordion End',
      'type' => 'accordion',
      'endpoint' => 1,            
    ],              
  ];
}
