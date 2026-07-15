<?php

namespace PD\ACF\Customize\Modules\VideoGallery;

use function PD\ACF\Utils\acf_typography_fields;
use function PD\ACF\Utils\acf_background_position_field;            

function fields ( $key, $label ) {
  return [
    [
      'key' => "field_modules_video_gallery_accordion_{$key}",
      'label' => "Video Gallery",
      'type' => 'accordion',
      'open' => 0,
      'multi_expand' => 1,
      'show_in_graphql' => 1,
    ],
    [
      'key' => "field_modules_video_gallery_group_{$key}",
      'name' => "video_gallery_{$key}",
      'type' => 'group',
      'show_in_graphql' => 1,
      'layout' => 'block',
      'sub_fields' => [
        [
          'key' => "field_modules_video_gallery_text_tab_{$key}",
          'label' => 'Text',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => "field_modules_video_gallery_headline_color_{$key}",
          'label' => 'Headline Color',
          'name' => "modules_video_gallery_headline_color_{$key}",
          'graphql_field_name' => 'headlineColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 33.33
          ],
        ],  
        [
          'key' => "field_modules_video_gallery_headline_color_bold_{$key}",
          'label' => "Headline Color (Bold)",
          'name' => "modules_video_gallery_headline_color_bold_{$key}",
          'graphql_field_name' => 'headlineColorBold',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 33.33,	  
          ],
        ],         
        [
          'key' => "field_modules_video_gallery_text_color_{$key}",
          'label' => 'Text Color',
          'name' => "modules_video_gallery_text_color_{$key}",
          'graphql_field_name' => 'textColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 33.33
          ],
        ],   
        [
          'key' => "field_modules_video_gallery_video_titles_tab_{$key}",
          'label' => 'Video Titles',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => "field_modules_video_gallery_video_titles_style_accordion_{$key}",
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
          'key' => "field_modules_video_gallery_video_titles_style_desktop_{$key}",
	        'name' => "modules_video_gallery_video_titles_desktop_{$key}",
          'graphql_field_name' => 'videoTitlesStyleDesktop',
          'label' => 'Desktop',
	        'type' => 'group',
	        'show_in_graphql' => 1,
      	  'layout' => 'block',
	        'sub_fields' => [
            ...acf_typography_fields([
              'key' => "field_modules_video_gallery_video_titles_regular_typography_desktop_{$key}",
              'name' => "modules_video_gallery_video_titles_regular_typography_desktop_{$key}",
              'graphql_field_name' => 'regular',
              'label' => 'Regular',
              'defaults' => [
                'font_family' => 'primary',
                'font_size' => 18,
                'letter_spacing' => 0,
                'line_height' => 1,
                'font_weight' => 600,
                'text_transform' => 'none'
              ]                       
            ]),
          ]
        ],
        [
          'key' => "field_modules_video_gallery_video_titles_style_mobile_{$key}",
	        'name' => "modules_video_gallery_video_titles_style_mobile_{$key}",
          'graphql_field_name' => 'videoTitlesStyleMobile',
          'label' => 'Mobile',
	        'type' => 'group',
      	  'show_in_graphql' => 1,
	        'layout' => 'block',
      	  'sub_fields' => [
           ...acf_typography_fields([
             'key' => "field_modules_video_gallery_video_titles_regular_typography_mobile_{$key}",
             'name' => "modules_video_gallery_video_titles_regular_typography_mobile_{$key}",
             'graphql_field_name' => 'regular',
             'label' => 'Regular',
             'defaults' => [
               'font_family' => 'primary',
               'font_size' => 17,
               'letter_spacing' => 0,
               'line_height' => 1,
               'font_weight' => 600,
               'text_transform' => 'none'
             ]                       
           ]),
          ]
        ],                
        [
          'key' => "field_modules_video_gallery_video_titles_style_accordion_end_{$key}",
          'label' => 'Style',
          'type' => 'accordion',
          'endpoint' => 1,
        ],  
        [
          'key' => "field_modules_video_gallery_background_tab",
          'label' => 'Background',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => "field_modules_video_gallery_background_style_accordion",
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
          'key' => "field_modules_video_gallery_background_style_desktop",
          'name' => 'background_desktop',
          'label' => 'Desktop',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
            [
              'key' => "field_modules_video_gallery_style_desktop_background_image",
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
          'key' => "field_modules_video_gallery_background_style_mobile",
          'name' => 'background_mobile',
          'label' => 'Mobile',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
            [
              'key' => "field_modules_video_gallery_style_mobile_background_image",
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
          'key' => "field_modules_video_gallery_background_style_accordion_end",
          'label' => 'Accordion End',
          'type' => 'accordion',
          'endpoint' => 1,            
        ],        
      ]
    ],
    [
      'key' => "field_modules_video_gallery_accordion_end_{$key}",
      'label' => 'Accordion End',
      'type' => 'accordion',
      'endpoint' => 1,            
    ],
  ];
}
