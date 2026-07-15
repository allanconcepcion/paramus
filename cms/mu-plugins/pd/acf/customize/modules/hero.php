<?php

namespace PD\ACF\Customize\Modules\Hero;

use function PD\ACF\Utils\acf_typography_fields;

function fields () {  
  return [
    [
      'key' => 'field_hero_accordion',
      'label' => 'Hero',
      'type' => 'accordion',
      'open' => 0,
      'multi_expand' => 1,
      'show_in_graphql' => 1,
    ],
    [
      'key' => 'field_hero_group',
      'name' => 'hero',
      'type' => 'group',
      'show_in_graphql' => 1,
      'layout' => 'block',
      'sub_fields' => [
        [
          'key' => 'field_hero_general_tab',
          'label' => 'General',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],        
        [
          'key' => 'field_hero_general_style_accordion',
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
          'key' => 'field_hero_avoid_header',
          'label' => 'Avoid Header',
          'name' => 'avoid_header',
          'type' => 'true_false',
          'show_in_graphql' => 1,
          'default_value' => 0,
	        'ui' => 1,
          'instructions' => 'If enabled, top of hero will align to the bottom of the header, preventing the header from overlaying the hero.',
          'wrapper' => [
      	    'width' => 25,
	        ],
        ],
        [
          'key' => 'field_hero_general_style_accordion_end',
          'label' => 'Accordion End',
          'type' => 'accordion',
          'endpoint' => 1,            
        ],
        [
          'key' => 'field_hero_copy_tab',
          'label' => 'Copy',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => 'field_hero_copy_style_accordion',
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
	        'key' => 'field_hero_copy_desktop',
      	  'name' => 'copy_desktop',
          'label' => 'Desktop',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
            ...acf_typography_fields([
              'key' => 'field_modules_hero_copy_headline_typography_desktop_regular',
              'name' => 'modules_hero_copy_headline_desktop_typography_regular',
              'graphql_field_name' => 'headlineRegular',
              'label' => 'Headline - Regular',
              'defaults' => [
                'font_family' => 'primary',
                'font_size' => 44,
                'letter_spacing' => 0,
                'line_height' => 1.2,
                'font_weight' => 'normal',
                'text_transform' => 'none'
              ]
            ]),
            ...acf_typography_fields([
              'key' => 'field_modules_hero_copy_headline_typography_desktop_bold',
              'name' => 'modules_hero_copy_headline_desktop_typography_bold',
              'graphql_field_name' => 'headlineBold',
              'label' => 'Headline - Bold',
              'defaults' => [
                'font_family' => 'primary',
                'font_size' => 44,
                'letter_spacing' => 0,
                'line_height' => 1.2,
                'font_weight' => 'bold',
                'text_transform' => 'none'
              ]
            ]),                       
          ]
        ],
        [
          'key' => 'field_hero_copy_mobile',
          'name' => 'copy_mobile',
          'label' => 'Mobile',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
            ...acf_typography_fields([
              'key' => 'field_modules_hero_copy_headline_mobile_typography_regular',
              'name' => 'modules_hero_copy_headline_mobile_typography_regular',
              'graphql_field_name' => 'headlineRegular',
              'label' => 'Headline - Regular',
              'defaults' => [
                'font_family' => 'primary',
                'font_size' => 30,
                'letter_spacing' => 0,
                'line_height' => 1.2,
                'font_weight' => 'normal',
                'text_transform' => 'none'
              ]
            ]),
            ...acf_typography_fields([
              'key' => 'field_modules_hero_copy_headline_mobile_typography_bold',
              'name' => 'modules_hero_copy_headline_mobile_typography_bold',
              'graphql_field_name' => 'headlineBold',
              'label' => 'Headline - Bold',
              'defaults' => [
                'font_family' => 'primary',
                'font_size' => 30,
                'letter_spacing' => 0,
                'line_height' => 1.2,
                'font_weight' => 'bold',
                'text_transform' => 'none'
              ]
            ]),
            [
              'key' => 'field_modules_hero_copy_background_color_mobile',
              'label' => 'Background Color',
              'name' => 'modules_hero_copy_background_color_mobile',
              'graphql_field_name' => 'backgroundColor',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 25,	  
	            ],
            ],
            [
              'key' => 'field_modules_hero_text_background_image',
              'label' => 'Text Background Image - Mobile',
              'name' => 'modules_hero_text_background_image',
              'graphql_field_name' => 'textBackgroundImageMobile',              
              'type' => 'image',              
              'show_in_graphql' => 1,
              'return_format' => 'array',
              'preview_size' => 'medium',
              'library' => 'all',
              'wrapper' => [
                'width' => 25
              ],
              'instructions' => 'Can be overriden at the page level.'
            ],  
          ]
        ],                  
        [
          'key' => 'field_hero_copy_style_accordion_end',
          'label' => 'Accordion End',
          'type' => 'accordion',
          'endpoint' => 1,            
        ],          
        [
          'key' => 'field_hero_bottom_bar_tab',
          'label' => 'Bottom Bar',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => 'field_hero_cta_content_accordion',
          'label' => 'Content',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
          'key' => 'field_hero_link_enabled',
          'label' => 'Link Enabled',
          'name' => 'link_enabled',
          'type' => 'true_false',
          'show_in_graphql' => 1,
          'default_value' => 0,
	        'ui' => 1,
          'wrapper' => [
      	    'width' => 100,
	        ],
        ],
        [
          'key' => 'field_hero_link',
          'label' => 'Link',
          'name' => 'link',
          'type' => 'link',	 
          'wrapper' => [
	          'width' => 100,
      	  ],
          'show_in_graphql' => 1,
          'return_format' => 'array',
          'conditional_logic' => [
	          [
              [
                'field' => 'field_hero_link_enabled',
                'operator' => '==',
                'value' => '1',
              ],
	          ],
	        ],
        ],   
        [
          'key' => 'field_hero_cta_enabled',
          'label' => 'CTA Enabled',
          'name' => 'cta_enabled',
          'type' => 'true_false',
          'show_in_graphql' => 1,
          'default_value' => 0,
	        'ui' => 1,
          'wrapper' => [
      	    'width' => 100,
	        ],
        ],
        [
          'key' => 'field_hero_cta',
          'label' => 'CTA',
          'name' => 'cta',
          'type' => 'link',	 
          'wrapper' => [
	          'width' => 100,
      	  ],
          'show_in_graphql' => 1,
          'return_format' => 'array',
          'conditional_logic' => [
	          [
              [
                'field' => 'field_hero_cta_enabled',
                'operator' => '==',
                'value' => '1',
              ],
	          ],
	        ],
        ],                    
        [
          'key' => 'field_hero_cta_content_accordion_end',
          'label' => 'Accordion End',
          'type' => 'accordion',
          'endpoint' => 1,            
        ],
        [
          'key' => 'field_hero_cta_style_accordion',
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
          'key' => 'field_modules_hero_link_background_color',
          'label' => 'Link Background Color',
          'name' => 'modules_hero_link_background_color',
          'graphql_field_name' => 'linkBackgroundColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
            'width' => 50,	  
          ],
        ],
        [
          'key' => 'field_modules_hero_link_color',
          'label' => 'Link Color',
          'name' => 'modules_hero_link_color',
          'graphql_field_name' => 'linkColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
            'width' => 50,	  
          ],
        ],          
        [
          'key' => 'field_modules_hero_cta_icon_background_color',
          'label' => 'CTA Icon Background Color',
          'name' => 'modules_hero_cta_icon_background_color',
          'graphql_field_name' => 'ctaIconBackgroundColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
            'width' => 20,	  
          ],
        ],
        [
          'key' => 'field_modules_hero_cta_icon_color',
          'label' => 'CTA Icon Color',
          'name' => 'modules_hero_cta_icon_color',
          'graphql_field_name' => 'ctaIconColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
            'width' => 20,	  
          ],
        ],                
        [
          'key' => 'field_modules_hero_cta_title_background_color',
          'label' => 'CTA Title Background Color',
          'name' => 'modules_hero_cta_title_background_color',
          'graphql_field_name' => 'ctaTitleBackgroundColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
            'width' => 20,	  
          ],
        ],        
        [
          'key' => 'field_modules_hero_cta_title_color',
          'label' => 'CTA Title Color',
          'name' => 'modules_hero_cta_title_color',
          'graphql_field_name' => 'ctaTitleColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
            'width' => 20,	  
          ],
        ],        
        [
          'key' => 'field_modules_hero_cta_title_color_hover',
          'label' => 'CTA Title Color (Hover)',
          'name' => 'modules_hero_cta_title_color_hover',
          'graphql_field_name' => 'ctaTitleColorHover',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
            'width' => 20,	  
          ],
        ],        
        [
          'key' => 'field_hero_cta_bar_typography_desktop',
          'name' => 'cta_bar_typography_desktop',
          'label' => 'Desktop',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
            ...acf_typography_fields([
              'key' => 'field_modules_hero_cta_bar_typography_desktop_regular',
              'name' => 'modules_hero_cta_bar_typography_desktop_regular',
              'graphql_field_name' => 'regular',
              'label' => 'Regular',
              'defaults' => [
                'font_family' => 'primary',
                'font_size' => 17,
                'letter_spacing' => .1,
                'line_height' => 1,
                'font_weight' => 'normal',
                'text_transform' => 'uppercase'
              ]
            ]),            
          ]
        ],
        [
          'key' => 'field_hero_cta_bar_typography_mobile',
          'name' => 'cta_bar_typography_mobile',
          'label' => 'Mobile',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
            ...acf_typography_fields([
              'key' => 'field_modules_hero_cta_bar_typography_mobile_regular',
              'name' => 'modules_hero_cta_bar_typography_mobile_regular',
              'graphql_field_name' => 'regular',
              'label' => 'Regular',
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
          'key' => 'field_hero_cta_style_accordion_end',
          'label' => 'Accordion End',
          'type' => 'accordion',
          'endpoint' => 1,            
        ],          
        [
          'key' => 'field_hero_background_tab',
          'label' => 'Background',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => 'field_hero_background_style_accordion',
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
          'key' => 'field_hero_background_overlay_desktop',
          'label' => 'Background Overlay - Desktop',
          'name' => 'background_overlay_desktop',
          'type' => 'color_picker',
          'enable_opacity' => 1,
          'show_in_graphql' => 1,
          'default_value' => 'rgba(0,0,0,.5)',
          'wrapper' => [
            'width' => '50',
          ],          
        ],
        [
          'key' => 'field_hero_background_overlay_mobile',
          'label' => 'Background Overlay - Mobile',
          'name' => 'background_overlay_mobile',
          'type' => 'color_picker',
          'enable_opacity' => 1,
          'show_in_graphql' => 1,
          'default_value' => 'rgba(0,0,0,.5)',
          'wrapper' => [
            'width' => '50',
          ],          
        ],
        [
          'key' => 'field_hero_background_style_accordion_end',
          'label' => 'Accordion End',
          'type' => 'accordion',
          'endpoint' => 1,            
        ], 
      ],      
    ], 
  ];
}
