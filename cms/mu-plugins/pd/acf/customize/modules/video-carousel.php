<?php

namespace PD\ACF\Customize\Modules\VideoCarousel;

use function PD\ACF\Utils\acf_typography_fields;
use function PD\ACF\Utils\acf_cta_icon_fields;
use function PD\ACF\Utils\acf_background_position_field;

function fields ( $key, $label ) {
  return [
    [
      'key' => "field_video_carousel_accordion_{$key}",
      'label' => "Video Carousel - {$label}",
      'type' => 'accordion',
      'open' => 0,
      'multi_expand' => 1,
      'show_in_graphql' => 1,
    ],
    [
      'key' => "field_modules_video_carousel_group_{$key}",
      'name' => "video_carousel_{$key}",
      'type' => 'group',
      'show_in_graphql' => 1,
      'layout' => 'block',
      'sub_fields' => [        
        [
          'key' => "field_modules_video_carousel_text_tab_{$key}",
          'label' => 'Text',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => "field_modules_video_carousel_text_style_accordion_{$key}",
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
          'key' => "field_modules_video_carousel_style_text_color_{$key}",
          'label' => 'Color',
          'name' => "modules_video_carousel_style_text_color_{$key}",
          'graphql_field_name' => 'color',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 33.33
          ],
        ],  
        [
          'key' => "field_modules_video_carousel_style_text_color_bold_{$key}",
          'label' => 'Color (Bold)',
          'name' => "modules_video_carousel_style_text_color_bold_{$key}",
          'graphql_field_name' => 'colorBold',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 33.33
          ],
        ],  
        [
          'key' => "field_modules_video_carousel_style_border_color_{$key}",
          'label' => 'Border Color',
          'name' => "modules_video_carousel_style_border_color_{$key}",
          'graphql_field_name' => 'borderColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 33.33
          ],
        ],              
        [
          'key' => "field_modules_video_carousel_text_style_accordion_end_{$key}",
          'label' => 'Accordion End',
          'type' => 'accordion',
          'endpoint' => 1,            
        ],
        [
          'key' => "field_modules_video_carousel_video_titles_tab_{$key}",
          'label' => 'Video Titles',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => "field_modules_video_carousel_video_titles_style_accordion_{$key}",
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
          'key' => "field_modules_video_carousel_video_titles_style_desktop_{$key}",
	        'name' => "modules_video_carousel_video_titles_desktop_{$key}",
          'graphql_field_name' => 'videoTitlesStyleDesktop',
          'label' => 'Desktop',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
            ...acf_typography_fields([
              'key' => "field_modules_video_carousel_video_titles_regular_typography_desktop_{$key}",
              'name' => "modules_video_carousel_video_titles_regular_typography_desktop_{$key}",
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
          'key' => "field_modules_video_carousel_video_titles_style_mobile_{$key}",
	        'name' => "modules_video_carousel_video_titles_style_mobile_{$key}",
          'graphql_field_name' => 'videoTitlesStyleMobile',
          'label' => 'Mobile',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
           ...acf_typography_fields([
             'key' => "field_modules_video_carousel_video_titles_regular_typography_mobile_{$key}",
             'name' => "modules_video_carousel_video_titles_regular_typography_mobile_{$key}",
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
          'key' => "field_modules_video_carousel_video_title_style_accordion_end_{$key}",
          'label' => 'Style',
          'type' => 'accordion',
          'endpoint' => 1,
        ],                        
        [
          'key' => "field_modules_video_carousel_social_links_eyebrow_tab_{$key}",
          'label' => 'Social Links Eyebrow',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => "field_modules_video_carousel_social_links_eyebrow_style_accordion_{$key}",
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
          'key' => "field_modules_video_carousel_social_links_eyebrow_style_desktop_{$key}",
	        'name' => "modules_video_carousel_social_links_eyebrow_desktop_{$key}",
          'graphql_field_name' => 'videoSocialLinksEyebrowDesktop',
          'label' => 'Desktop',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
            ...acf_typography_fields([
              'key' => "field_modules_video_carousel_social_links_eyebrow_regular_typography_desktop_{$key}",
              'name' => "modules_video_carousel_social_links_eyebrow_regular_typography_desktop_{$key}",
              'graphql_field_name' => 'regular',
              'label' => 'Regular',
              'defaults' => [
                'font_family' => 'primary',
                'font_size' => 17,
                'letter_spacing' => 0,
                'line_height' => 1,
                'font_weight' => 500,
                'text_transform' => 'uppercase'
              ]                       
            ]),
          ]
        ],
        [
          'key' => "field_modules_video_carousel_social_links_eyebrow_style_mobile_{$key}",
	        'name' => "modules_video_carousel_social_links_eyebrow_style_mobile_{$key}",
          'graphql_field_name' => 'videoSocialLinksEyebrowMobile',
          'label' => 'Mobile',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
           ...acf_typography_fields([
             'key' => "field_modules_video_carousel_social_links_eyebrow_regular_typography_mobile_{$key}",
             'name' => "modules_video_carousel_social_links_eyebrow_regular_typography_mobile_{$key}",
             'graphql_field_name' => 'regular',
             'label' => 'Regular',
             'defaults' => [
               'font_family' => 'primary',
               'font_size' => 16,
               'letter_spacing' => 0,
               'line_height' => 1,
               'font_weight' => 500,
                'text_transform' => 'uppercase'
             ]                       
           ]),
          ]
        ],   
        [
          'key' => "field_modules_video_carousel_style_social_links_eyebrow_color_{$key}",
          'label' => 'Social Links Eyebrow Color',
          'name' => "modules_video_carousel_style_social_links_eyebrow_color_{$key}",
          'graphql_field_name' => 'socialLinksEyebrowColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 33.33
          ],
        ],               
        [
          'key' => "field_modules_video_carousel_social_links_eyebrow_style_accordion_end_{$key}",
          'label' => 'Style',
          'type' => 'accordion',
          'endpoint' => 1,
        ],                        
        [
          'key' => "field_modules_video_carousel_icon_tab_{$key}",
          'label' => 'CTA',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => "field_modules_video_carousel_icon_style_accordion_{$key}",
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        ...acf_cta_icon_fields([
          'key' => "field_modules_video_carousel_{$key}",
          'name' => "modules_video_carousel_{$key}",
        ]),        
        [
          'key' => "field_modules_video_carousel_style_cta_text_color_{$key}",
          'label' => 'CTA Text Color',
          'name' => "modules_video_carousel_style_cta_text_color_{$key}",
          'graphql_field_name' => 'ctaTextColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'instructions' => 'Applies to the CTA button when `Carousel Layout - Desktop` is set to 70:30 at the module level.',
          'wrapper' => [
	          'width' => 33.33
          ],
        ],  
        [
          'key' => "field_modules_video_carousel_icon_style_accordion_end_{$key}",
          'label' => 'Accordion End',
          'type' => 'accordion',
          'endpoint' => 1,            
        ],
        [
          'key' => "field_modules_video_carousel_nav_tab_{$key}",
          'label' => 'Nav',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => "field_modules_video_carousel_nav_style_accordion_{$key}",
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
          'key' => "field_modules_video_carousel_nav_style_desktop_{$key}",
          'name' => 'nav_desktop',
          'label' => 'Desktop',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
            ...acf_typography_fields([
              'key' => "field_modules_video_carousel_nav_style_desktop_regular_{$key}",
              'name' => "modules_video_carousel_nav_style_desktop_regular_{$key}",
              'graphql_field_name' => 'regular',
              'label' => '',
              'defaults' => [
                'font_family' => 'primary',
                'font_size' => 16,
                'letter_spacing' => .1,
                'line_height' => 1,
                'font_weight' => 'normal',
                'text_transform' => 'uppercase'
              ]
            ]),
          ]
        ],
        [
          'key' => "field_modules_video_carousel_nav_style_mobile_{$key}",
          'name' => 'nav_mobile',
          'label' => 'Mobile',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
            ...acf_typography_fields([
              'key' => "field_modules_video_carousel_nav_style_mobile_regular_{$key}",
              'name' => "modules_video_carousel_nav_style_mobile_regular_{$key}",
              'graphql_field_name' => 'regular',
              'label' => '',
              'defaults' => [
                'font_family' => 'primary',
                'font_size' => 15,
                'letter_spacing' => .1,
                'line_height' => 1,
                'font_weight' => 'normal',
                'text_transform' => 'uppercase'
              ]
            ]),
          ]
        ],
        [
          'key' => "field_modules_video_carousel_nav_style_accordion_end_{$key}",
          'label' => 'Accordion End',
          'type' => 'accordion',
          'endpoint' => 1
        ],
        [
          'key' => "field_modules_video_carousel_background_tab_{$key}",
          'label' => 'Background',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => "field_modules_video_carousel_background_style_accordion_{$key}",
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
          'key' => "field_modules_video_carousel_background_style_desktop_{$key}",
          'name' => 'background_desktop',
          'label' => 'Desktop',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
            [
              'key' => "field_modules_video_carousel_style_desktop_background_color_{$key}",
              'label' => 'Background Color',
              'name' => "modules_video_carousel_style_desktop_background_color_{$key}",
              'graphql_field_name' => 'backgroundColor',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 25
              ],
            ],
            [
              'key' => "field_modules_video_carousel_style_desktop_background_image_{$key}",
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
                'width' => 25
              ],
            ],
            ...acf_background_position_field([
              'key' => "field_modules_vidoe_carousel_background_position_desktop_{$key}",
              'label' => 'Background Position',
              'name' => 'background_position_desktop',
              'graphql_field_name' => 'backgroundPosition',
              'wrapper' => [
                'width' => 25
              ]
            ]),                     
          ]
        ],
        [
          'key' => "field_modules_video_carousel_background_style_mobile_{$key}",
          'name' => 'background_mobile',
          'label' => 'Mobile',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
            [
              'key' => "field_modules_video_carousel_style_mobile_background_color_{$key}",
              'label' => 'Background Color',
              'name' => "modules_video_carousel_style_mobile_background_color_{$key}",
              'graphql_field_name' => 'backgroundColor',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 25
              ],
            ],
            [
              'key' => "field_modules_video_carousel_style_mobile_background_image_{$key}",
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
                'width' => 25
              ],
            ],
            ...acf_background_position_field([
              'key' => "field_modules_vidoe_carousel_background_position_mobile_{$key}",
              'label' => 'Background Position',
              'name' => 'background_position_mobile',
              'graphql_field_name' => 'backgroundPosition',
              'wrapper' => [
                'width' => 25
              ]
            ]),                      
          ]
        ],                              
        [
          'key' => "field_modules_video_carousel_background_style_accordion_end_{$key}",
          'label' => 'Accordion End',
          'type' => 'accordion',
          'endpoint' => 1,            
        ],
      ]
    ],
    [      
      'key' => "field_video_carousel_accordion_end_{$key}",
      'label' => 'Accordion End',
      'type' => 'accordion',
      'endpoint' => 1,            
    ],          
  ];
}
