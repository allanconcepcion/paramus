<?php

namespace PD\ACF\Customize\Header;

use function PD\ACF\Utils\acf_typography_fields;
use function PD\ACF\Utils\acf_svg_icon_field;


function init () {
  acf_add_local_field_group([
    'key' => 'group_header',
    'title' => 'Header',
    'location' => [
      [
        [
          'param' => 'options_page',
          'operator' => '==',
          'value' => 'customize',
        ],
      ],
    ],
    'menu_order' => 1,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_graphql' => 1,
    'graphql_field_name' => 'header',
    'map_graphql_types_from_location_rules' => 0,
    'graphql_types' => '',
    'fields' => [  
      [
        'key' => 'field_header_general',
        'label' => 'General',
        'type' => 'tab',
        'show_in_graphql' => 1,
      ],
      [
        'key' => 'field_header_general_style_accordion',
        'label' => 'Style',
        'type' => 'accordion',
        'open' => 1,
        'multi_expand' => 1
      ],    
      [
        'key' => 'field_header_general_style_accordion_end',
        'label' => 'Accordion End',
        'type' => 'accordion',
        'endpoint' => 1,
      ],            
      [
        'key' => "field_header_general_sticky_desktop",
        'label' => 'Sticky - Desktop',
        'name' => "header_general_sticky_desktop",
        'graphql_field_name' => 'stickyDesktop',
        'type' => 'true_false',
        'wrapper' => [
      	  'width' => 100
        ],
        'show_in_graphql' => 1,
        'default_value' => 1,
        'ui' => 1
      ],
      [
        'key' => 'field_header_logo',
        'label' => 'Logo',
        'type' => 'tab',
        'show_in_graphql' => 1,
      ],
      [
        'key' => 'field_header_content_accordion',
        'label' => 'Content',
        'type' => 'accordion',
        'open' => 1,
        'multi_expand' => 1
      ],
      [
        'key' => 'field_header_logo_desktop',
        'label' => 'Logo - Desktop',
        'name' => 'logo_desktop',
        'type' => 'image',
        'wrapper' => [
	        'width' => '50'
        ],
        'show_in_graphql' => 1,        
        'return_format' => 'array',
        'preview_size' => 'medium',
        'library' => 'all'
      ],
      [
        'key' => 'field_header_logo_mobile',
        'label' => 'Logo - Mobile',
        'name' => 'logo_mobile',
        'type' => 'image',
        'wrapper' => [
	        'width' => '50'
        ],
        'show_in_graphql' => 1,
        'return_format' => 'array',
        'preview_size' => 'medium',
        'library' => 'all',
      ],
      [
        'key' => 'field_header_style_accordion',
        'label' => 'Style',
        'type' => 'accordion',
        'open' => 0,
        'multi_expand' => 1
      ],
      [
        'key' => "field_header_logo_visible_load_desktop",
        'label' => 'Visible On Load - Desktop',
        'name' => "header_logo_visible_load_desktop",
        'graphql_field_name' => 'visibleOnLoadDesktop',
        'type' => 'true_false',
        'wrapper' => [
      	  'width' => 100
        ],
        'show_in_graphql' => 1,
        'default_value' => 0,
        'ui' => 1
      ],
      [
        'key' => 'field_header_logo_width_desktop',
        'label' => 'Logo Width - Desktop',
        'name' => 'logo_width_desktop',
        'type' => 'range',
        'wrapper' => [
	        'width' => '50'
        ],
        'show_in_graphql' => 1,
        'default_value' => 100,
        'min' => 100,
        'max' => 400,
      ],
      [
        'key' => 'field_header_logo_width_mobile',
        'label' => 'Logo Width - Mobile',
        'name' => 'logo_width_mobile',
        'type' => 'range',
        'wrapper' => [
	        'width' => '50'
        ],
        'show_in_graphql' => 1,
        'default_value' => 100,
        'min' => 100,
        'max' => 400,
      ],      
      [
	      'key' => 'field_header_logo_background_color_desktop',
	      'label' => 'Background Color - Desktop',
	      'name' => 'header_logo_background_color_desktop',
        'graphql_field_name' => 'backgroundColorDesktop',
        'type' => 'select',
        'show_in_graphql' => 1,
        'ui' => 1,
        'wrapper' => [
          'width' => 33,
        ],
      ],
      [
	      'key' => 'field_header_logo_background_color_desktop_scroll',
	      'label' => 'Background Color - Desktop (Scroll)',
	      'name' => 'header_logo_background_color_desktop_scroll',
        'graphql_field_name' => 'backgroundColorDesktopScroll',
        'type' => 'select',
        'show_in_graphql' => 1,
        'ui' => 1,
        'wrapper' => [
          'width' => 33,
        ],
      ],
      [
	      'key' => 'field_header_logo_background_color_mobile',
	      'label' => 'Background Color - Mobile',
	      'name' => 'header_logo_background_color_mobile',
        'graphql_field_name' => 'backgroundColorMobile',
        'type' => 'select',
        'show_in_graphql' => 1,
        'ui' => 1,
        'wrapper' => [
          'width' => 33,
        ],
      ],
      [
        'key' => 'field_header_logo_position_desktop',
        'label' => 'Position - Desktop',
        'name' => 'header_logo_position_desktop',
        'graphql_field_name' => 'positionDesktop',
        'type' => 'select',
        'show_in_graphql' => 1,
        'ui' => 1,            
        'choices' => [
          'center' => 'Center', 
          'left' => 'Left'
        ], 
        'default_value' => 'center', 
        'wrapper' => [
          'width' => 25
        ],
      ],
      [
        'key' => 'field_logo_style_accordion_end',
        'label' => 'Accordion End',
        'type' => 'accordion',
        'endpoint' => 1,
      ],      
      [
        'key' => 'field_header_left_links_tab',
        'label' => 'Left Links',
        'type' => 'tab',        
      ],
      [
        'key' => 'field_left_links_content_accordion',
        'label' => 'Content',
        'type' => 'accordion',
        'open' => 1,
        'multi_expand' => 1
      ],
      [
        'key' => 'field_header_left_links_format',
        'label' => 'Format',
        'name' => 'header_left_links_format',
        'graphql_field_name' => 'leftLinksFormat',
        'type' => 'select',
        'show_in_graphql' => 1,
        'ui' => 1,            
        'choices' => [
          'normal' => 'Normal', 
          'expanded' => 'Expanded'
        ], 
        'default_value' => 'normal', 
        'wrapper' => [
          'width' => 25
        ],
      ],
      [
        'key' => 'field_header_left_links',
        'name' => 'left_links',
        'type' => 'repeater',
        'show_in_graphql' => 1,
        'layout' => 'table',
        'button_label' => 'Add link',
        'max' => 3,
        'sub_fields' => [
          [
            'key' => 'field_header_left_links_label',
            'label' => 'Label',
            'name' => 'label',
            'type' => 'text',	    
            'show_in_graphql' => 1,
            'conditional_logic' => [
              [
                [
                  'field' => 'field_header_left_links_format',
                  'operator' => '==',
                  'value' => 'expanded'
                ],
              ],
            ],
	        ],
          ...acf_svg_icon_field([
            'key' => "field_header_left_links_icon",
            'label' => 'Icon',
            'name' => 'icon',
            'graphql_field_name' => 'icon',
            'required' => 0,
          ]),
	        [
            'key' => 'field_header_left_links_link',
            'label' => 'Link',
            'name' => 'link',
            'type' => 'link',
            'show_in_graphql' => 1,
            'return_format' => 'array',
          ], 
          [
            "key" => "field_header_left_links_button", 
            "label" => "Button?", 
            "name" => "button", 
            "type" => "true_false", 
            'conditional_logic' => [
              [
                [
                  'field' => 'field_header_left_links_format',
                  'operator' => '==',
                  'value' => 'normal'
                ],
              ],
            ],
          ]        
        ],
      ],
      [
        'key' => 'field_left_links_style_accordion',
        'label' => 'Style',
        'type' => 'accordion',
        'open' => 0,
        'multi_expand' => 1
      ],
      [
        'key' => 'field_header_left_links_expanded_typography_desktop',
        'name' => 'header_left_links_expanded_typography_desktop',
        'graphql_field_name' => 'leftLinksExpandedTypographyDesktop',
        'label' => 'Desktop',
        'type' => 'group',
        'show_in_graphql' => 1,
        'layout' => 'block',
        'sub_fields' => [          
          ...acf_typography_fields([
            'key' => 'field_header_left_links_typography_desktop_label',
            'name' => 'header_left_links_typography_desktop_label',
            'graphql_field_name' => 'label',
            'label' => 'Label',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 16,
              'letter_spacing' => .1,
              'line_height' => 1,
              'font_weight' => 'normal',
              'text_transform' => 'uppercase'
            ]                       
          ]),
          ...acf_typography_fields([
            'key' => 'field_header_left_links_typography_desktop_link',
            'name' => 'header_left_links_typography_desktop_link',
            'graphql_field_name' => 'link',
            'label' => 'Link',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 24,
              'letter_spacing' => 0,
              'line_height' => 1,
              'font_weight' => 600,
              'text_transform' => 'none'
            ]                       
          ]),      
          [
            'key' => 'field_header_left_links_label_color',
            'label' => 'Label Color',
            'name' => 'header_left_links_label_color',
            'graphql_field_name' => 'labelColor',
            'type' => 'select',
            'show_in_graphql' => 1,
            'ui' => 1,            'wrapper' => [
              'width' => 25,
            ],
          ],       
          [
            'key' => 'field_header_left_links_label_color_scroll',
            'label' => 'Label Color (Scroll)',
            'name' => 'header_left_links_label_color_scroll',
            'graphql_field_name' => 'labelColorScroll',
            'type' => 'select',
            'show_in_graphql' => 1,
            'ui' => 1,
            'wrapper' => [
              'width' => 25,
            ],
          ],      
          [
            'key' => 'field_header_left_links_link_color',
            'label' => 'Link Color',
            'name' => 'header_left_links_link_color',
            'graphql_field_name' => 'linkColor',
            'type' => 'select',
            'show_in_graphql' => 1,
            'ui' => 1,
            'wrapper' => [
              'width' => 25,
            ],
          ],
          [
            'key' => 'field_header_left_links_link_color_scroll',
            'label' => 'Link Color (Scroll)',
            'name' => 'header_left_links_link_color_scroll',
            'graphql_field_name' => 'linkColorScroll',
            'type' => 'select',
            'show_in_graphql' => 1,
            'ui' => 1,
            'wrapper' => [
              'width' => 25,
            ],
          ],
        ], 
        'conditional_logic' => [
          [
            [
              'field' => 'field_header_left_links_format',
              'operator' => '==',
              'value' => 'expanded'
            ],
          ],
        ],
      ],    
      [
        'key' => 'field_header_left_links_normal_typography_desktop',
        'name' => 'header_left_links_normal_typography_desktop',
        'graphql_field_name' => 'leftLinksNormalTypographyDesktop',
        'label' => 'Desktop',
        'type' => 'group',
        'show_in_graphql' => 1,
        'layout' => 'block',
        'sub_fields' => [
          ...acf_typography_fields([
            'key' => 'field_header_left_links_typography_desktop_regular',
            'name' => 'header_left_links_typography_desktop_regular',
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
          [
            'key' => 'field_header_left_links_color',
            'label' => 'Color',
            'name' => 'header_left_links_color',
            'graphql_field_name' => 'color',
            'type' => 'select',
            'show_in_graphql' => 1,
            'ui' => 1,
            'wrapper' => [
              'width' => 25,
            ],
          ],       
          [
            'key' => 'field_header_left_links_color_scroll',
            'label' => 'Color (Scroll)',
            'name' => 'header_left_links_color_scroll',
            'graphql_field_name' => 'colorScroll',
            'type' => 'select',
            'show_in_graphql' => 1,
            'ui' => 1,
            'wrapper' => [
              'width' => 25,
            ],
          ],               
        ], 
        'conditional_logic' => [
          [
            [
              'field' => 'field_header_left_links_format',
              'operator' => '==',
              'value' => 'normal'
            ],
          ],
        ],
      ],            
      [
        'key' => 'field_left_links_style_accordion_end',
        'label' => 'Accordion End',
        'type' => 'accordion',
        'endpoint' => 1,
      ],   
      
      [
        'key' => 'field_header_right_links_tab',
        'label' => 'Right Links',
        'type' => 'tab',        
      ],
      [
        'key' => 'field_right_links_content_accordion',
        'label' => 'Content',
        'type' => 'accordion',
        'open' => 1,
        'multi_expand' => 1
      ],
      [
        'key' => 'field_header_right_links_format',
        'label' => 'Format',
        'name' => 'header_right_links_format',
        'graphql_field_name' => 'rightLinksFormat',
        'type' => 'select',
        'show_in_graphql' => 1,
        'ui' => 1,            
        'choices' => [
          'normal' => 'Normal', 
          'expanded' => 'Expanded'
        ], 
        'default_value' => 'normal', 
        'wrapper' => [
          'width' => 25
        ],
      ],      
      [
        'key' => 'field_header_right_links',
        'name' => 'right_links',
        'type' => 'repeater',
        'show_in_graphql' => 1,
        'layout' => 'table',
        'button_label' => 'Add link',
        'max' => 3,
        'sub_fields' => [
          [
            'key' => 'field_header_right_links_label',
            'label' => 'Label',
            'name' => 'label',
            'type' => 'text',	    
            'show_in_graphql' => 1,
            'conditional_logic' => [
              [
                [
                  'field' => 'field_header_right_links_format',
                  'operator' => '==',
                  'value' => 'expanded'
                ],
              ],
            ],
	        ],
          ...acf_svg_icon_field([
            'key' => "field_header_right_links_icon",
            'label' => 'Icon',
            'name' => 'icon',
            'graphql_field_name' => 'icon',
            'required' => 0,
          ]),
	        [
            'key' => 'field_header_right_links_link',
            'label' => 'Link',
            'name' => 'link',
            'type' => 'link',
            'show_in_graphql' => 1,
            'return_format' => 'array',
          ], 
          [
            "key" => "field_header_right_links_button", 
            "label" => "Button?", 
            "name" => "button", 
            "type" => "true_false", 
            'conditional_logic' => [
              [
                [
                  'field' => 'field_header_right_links_format',
                  'operator' => '==',
                  'value' => 'normal'
                ],
              ],
            ],
          ]          
        ],
      ],
      [
        'key' => 'field_right_links_style_accordion',
        'label' => 'Style',
        'type' => 'accordion',
        'open' => 0,
        'multi_expand' => 1
      ],
      [
        'key' => 'field_header_right_links_expanded_typography_desktop',
        'name' => 'header_right_links_expanded_typography_desktop',
        'graphql_field_name' => 'rightLinksExpandedTypographyDesktop',
        'label' => 'Desktop',
        'type' => 'group',
        'show_in_graphql' => 1,
        'layout' => 'block',
        'sub_fields' => [
          ...acf_typography_fields([
            'key' => 'field_header_right_links_typography_desktop_label',
            'name' => 'header_right_links_typography_desktop_label',
            'graphql_field_name' => 'label',
            'label' => 'Label',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 16,
              'letter_spacing' => .1,
              'line_height' => 1,
              'font_weight' => 'normal',
              'text_transform' => 'uppercase'
            ]                       
          ]),
          ...acf_typography_fields([
            'key' => 'field_header_right_links_typography_desktop_link',
            'name' => 'header_right_links_typography_desktop_link',
            'graphql_field_name' => 'link',
            'label' => 'Link',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 24,
              'letter_spacing' => 0,
              'line_height' => 1,
              'font_weight' => 600,
              'text_transform' => 'none'
            ]                       
          ]),   
          [
            'key' => 'field_header_right_links_label_color',
            'label' => 'Label Color',
            'name' => 'header_right_links_label_color',
            'graphql_field_name' => 'labelColor',
            'type' => 'select',
            'show_in_graphql' => 1,
            'ui' => 1,
            'wrapper' => [
              'width' => 25,
            ],
          ],       
          [
            'key' => 'field_header_right_links_label_color_scroll',
            'label' => 'Label Color (Scroll)',
            'name' => 'header_right_links_label_color_scroll',
            'graphql_field_name' => 'labelColorScroll',
            'type' => 'select',
            'show_in_graphql' => 1,
            'ui' => 1,
            'wrapper' => [
              'width' => 25,
            ],
          ],       
          [
            'key' => 'field_header_right_links_link_color',
            'label' => 'Link Color',
            'name' => 'header_right_links_link_color',
            'graphql_field_name' => 'linkColor',
            'type' => 'select',
            'show_in_graphql' => 1,
            'ui' => 1,
            'wrapper' => [
              'width' => 25,
            ],
          ],       
          [
            'key' => 'field_header_right_links_link_color_scroll',
            'label' => 'Link Color (Scroll)',
            'name' => 'header_right_links_link_color_scroll',
            'graphql_field_name' => 'linkColorScroll',
            'type' => 'select',
            'show_in_graphql' => 1,
            'ui' => 1,
            'wrapper' => [
              'width' => 25,
            ],
          ],       
        ],         
        'conditional_logic' => [
          [
            [
              'field' => 'field_header_right_links_format',
              'operator' => '==',
              'value' => 'expanded'
            ],
          ],
        ],
      ],    
      [
        'key' => 'field_header_right_links_normal_desktop',
        'name' => 'header_right_links_normal_desktop',
        'graphql_field_name' => 'rightLinksNormalTypographyDesktop',
        'label' => 'Desktop',
        'type' => 'group',
        'show_in_graphql' => 1,
        'layout' => 'block',
        'sub_fields' => [
          ...acf_typography_fields([
            'key' => 'field_header_right_links_typography_desktop_regular',
            'name' => 'header_right_links_typography_desktop_regular',
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
          [
            'key' => 'field_header_right_links_color',
            'label' => 'Color',
            'name' => 'header_right_links_color',
            'graphql_field_name' => 'color',
            'type' => 'select',
            'show_in_graphql' => 1,
            'ui' => 1,
            'wrapper' => [
              'width' => 25,
            ],
          ],       
          [
            'key' => 'field_header_right_links_color_scroll',
            'label' => 'Color (Scroll)',
            'name' => 'header_right_links_color_scroll',
            'graphql_field_name' => 'colorScroll',
            'type' => 'select',
            'show_in_graphql' => 1,
            'ui' => 1,
            'wrapper' => [
              'width' => 25,
            ],
          ],                    
        ], 
        'conditional_logic' => [
          [
            [
              'field' => 'field_header_right_links_format',
              'operator' => '==',
              'value' => 'normal'
            ],
          ],
        ],
      ],            
      [
        'key' => 'field_right_links_style_accordion_end',
        'label' => 'Accordion End',
        'type' => 'accordion',
        'endpoint' => 1,
      ],   
      [
        'key' => 'field_icon_link_accordion',
        'label' => 'Icon Link',
        'type' => 'tab',
      ],
      [
        'key' => 'field_icon_link_content_accordion',
        'label' => 'Content',
        'type' => 'accordion',
        'open' => 1,
        'multi_expand' => 1
      ],
      [
        'key' => 'field_icon_link_icon',
        'label' => 'Icon',
        'name' => 'icon_link_icon',
        'type' => 'image',
        'show_in_graphql' => 1,
        'wrapper' => [
          'width' => '50',
        ],
        'return_format' => 'array',
      ],            
      [
        'key' => 'field_icon_link',
        'label' => 'Link',
        'name' => 'icon_link',
        'type' => 'link',
        'show_in_graphql' => 1,
        'wrapper' => [
          'width' => '50',
        ],
	      'return_format' => 'array',
      ],
      [
        'key' => 'field_icon_link_style_accordion',
        'label' => 'Style',
        'type' => 'accordion',
        'open' => 0,
        'multi_expand' => 1
      ],
      [
        'key' => 'field_header_icon_link_typography_mobile',
        'name' => 'icon_link_typography_mobile',
        'label' => 'Mobile',
        'type' => 'group',
        'show_in_graphql' => 1,
        'layout' => 'block',
        'sub_fields' => [
          ...acf_typography_fields([
            'key' => 'field_header_icon_link_mobile_regular',
            'name' => 'header_icon_link_typography_mobile_regular',
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
          [
            'key' => 'field_header_icon_link_color_mobile',
            'label' => 'Color',
            'name' => 'header_icon_link_color_mobile',
            'graphql_field_name' => 'colorMobile',
            'type' => 'select',
            'show_in_graphql' => 1,
            'ui' => 1,
            'wrapper' => [
              'width' => 25,
            ],
          ],
          [
            'key' => 'field_header_icon_link_background_color_mobile',
            'label' => 'Background Color',
            'name' => 'header_icon_link_background_color_mobile',
            'graphql_field_name' => 'backgroundColorMobile',
            'type' => 'select',
            'show_in_graphql' => 1,
            'ui' => 1,
            'wrapper' => [
              'width' => 25,
            ],
          ],
        ],         
      ],                  
      [
        'key' => 'field_icon_link_style_accordion_end',
        'label' => 'Accordion End',
        'type' => 'accordion',
        'endpoint' => 1,
      ],               
    ],    
  ]);   
}

add_action('acf/init', __NAMESPACE__ . '\\init');
