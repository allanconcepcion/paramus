<?php

namespace PD\ACF\Customize\Modules\MediaText2x;

use function PD\ACF\Utils\acf_typography_fields;
use function PD\ACF\Utils\acf_background_position_field;

function fields ( $key, $label ) {
  return [
    [
      'key' => "field_modules_media_text_2x_accordion_{$key}",
      'label' => "Media Text 2x - {$label}",
      'type' => 'accordion',
      'open' => 0,
      'multi_expand' => 1,
      'show_in_graphql' => 1,
    ],
    [
      'key' => "field_modules_media_text_2x_group_{$key}",
      'name' => "media_text_2x_{$key}",
      'type' => 'group',
      'show_in_graphql' => 1,
      'layout' => 'block',
      'sub_fields' => [
        [
          'key' => "field_modules_media_text_2x_text_tab_{$key}",
          'name' => "modules_media_text_2x_text_tab_{$key}",
          'label' => 'Text',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => "field_modules_media_text_2x_text_style_accordion_{$key}",
          'name' => "modules_media_text_2x_text_style_accordion_{$key}",
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
          'key' => "field_modules_media_text_2x_headline_style_color_{$key}",
          'label' => 'Headline Color',
          'name' => "modules_media_text_2x_style_headline_color_{$key}",
          'graphql_field_name' => 'headlineColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 25
          ],
        ],                  
        [
          'key' => "field_modules_media_text_2x_headline_style_color_bold_{$key}",
          'label' => 'Headline Color (Bold)',
          'name' => "modules_media_text_2x_style_headline_color_bold_{$key}",
          'graphql_field_name' => 'headlineColorBold',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 25
          ],
        ],                  
        [
          'key' => "field_modules_media_text_2x_text_style_color_{$key}",
          'label' => 'Text Color',
          'name' => "modules_media_text_2x_style_text_color_{$key}",
          'graphql_field_name' => 'color',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	         'width' => 25
          ],
        ],  
        [
          'key' => "field_modules_media_text_2x_text_style_border_color_{$key}",
          'label' => 'Border Color',
          'name' => "modules_media_text_2x_style_border_color_{$key}",
          'graphql_field_name' => 'borderColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 25
          ],
        ],            
        [
          'key' => "field_modules_media_text_2x_text_style_accordion_end_{$key}",
          'label' => 'Accordion End',
          'type' => 'accordion',
          'endpoint' => 1,            
        ],        
        [
          'key' => "field_modules_media_text_2x_icon_tab_{$key}",
          'name' => "modules_media_text_2x_icon_tab_{$key}",
          'label' => 'Icon',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => "field_modules_media_text_2x_icon_content_accordion_{$key}",
          'name' => "modules_media_text_2x_icon_content_accordion_{$key}",
          'label' => 'Content',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
          'key' => "field_modules_media_text_2x_icon_content_image_{$key}",
          'label' => 'Image',
          'name' => "media_text_2x_icon_content_image_{$key}",              
          'graphql_field_name' => 'image',
          'type' => 'image',
          'show_in_graphql' => 1,
          'return_format' => 'array',
          'preview_size' => 'medium',
          'library' => 'all',
          'wrapper' => [
            'width' => 50
          ],
        ],        
        [
          'key' => "field_modules_media_text_2x_icon_content_accordion_end_{$key}",
          'label' => 'Accordion End',
          'type' => 'accordion',
          'endpoint' => 1,            
        ],        
        [
          'key' => "field_modules_media_text_2x_icon_style_accordion_{$key}",
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
          'key' => "field_modules_media_text_2x_style_icon_background_color_{$key}",
          'label' => 'Background Color',
          'name' => "modules_media_text_2x_style_icon_background_color_{$key}",
          'graphql_field_name' => 'iconBackgroundColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 50
          ],
        ],
        [
          'key' => "field_modules_media_text_2x_style_icon_border_color_{$key}",
          'label' => 'Border Color',
          'name' => "modules_media_text_2x_style_icon_border_color_{$key}",
          'graphql_field_name' => 'iconBorderColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 50
          ],
        ],  
        [
          'key' => "field_modules_media_text_2x_icon_style_accordion_end_{$key}",
          'type' => 'accordion',
          'endpoint' => 1
        ],        
        [
          'key' => "field_modules_media_text_2x_background_tab_{$key}",
          'label' => 'Background',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => "field_modules_media_text_2x_background_style_accordion_{$key}",
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
          'key' => "field_modules_media_text_2x_background_style_desktop_{$key}",
          'name' => 'background_desktop',
          'label' => 'Desktop',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
            [
              'key' => "field_modules_media_text_2x_style_desktop_background_color_{$key}",
              'label' => 'Background Color',
              'name' => "modules_media_text_2x_style_desktop_background_color_{$key}",
              'graphql_field_name' => 'backgroundColor',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 33.33
              ],
            ],
            [
              'key' => "field_modules_media_text_2x_style_desktop_background_image_{$key}",
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
              'key' => "field_modules_media_text_2x_background_position_desktop_{$key}",
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
          'key' => "field_modules_media_text_2x_background_style_mobile_{$key}",
          'name' => 'background_mobile',
          'label' => 'Mobile',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
            [
              'key' => "field_modules_media_text_2x_style_mobile_background_color_{$key}",
              'label' => 'Background Color',
              'name' => "modules_media_text_2x_style_mobile_background_color_{$key}",
              'graphql_field_name' => 'backgroundColor',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 33.33
              ],
            ],
            [
              'key' => "field_modules_media_text_2x_style_mobile_background_image_{$key}",
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
              'key' => "field_modules_media_text_2x_background_position_mobile_{$key}",
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
