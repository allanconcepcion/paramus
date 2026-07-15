<?php

namespace PD\ACF\Customize\Menu;
 

use function PD\ACF\Utils\acf_typography_fields;

function init () {
  acf_add_local_field_group([
    'key' => 'group_menu',
    'title' => 'Menu',
    'location' => [
      [
        [
          'param' => 'options_page',
          'operator' => '==',
          'value' => 'customize',
        ],
      ],
    ],
    'menu_order' => 2,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_graphql' => 1,
    'graphql_field_name' => 'menu',
    'map_graphql_types_from_location_rules' => 0,
    'graphql_types' => '',
    'fields' => [
      [
        'key' => 'field_menu_desktop_format',
        'label' => 'Format - Desktop',
        'name' => 'menu_desktop_format',
        'graphql_field_name' => 'formatDesktop',
        'type' => 'select',
        'show_in_graphql' => 1,
        'ui' => 1,            
        'choices' => [
          'flyout' => 'Flyout', 
          'dropdown' => 'Dropdown'
        ], 
        'default_value' => 'flyout', 
        'wrapper' => [
          'width' => 25
        ],
      ],
      [
        'key' => 'field_menu_colors_tab',
        'label' => 'General',
        'type' => 'tab',
      ],
      [
        'key' => 'field_menu_overlay_color',
        'label' => 'Overlay Color',
        'name' => 'menu_overlay_color',
        'graphql_field_name' => 'overlayColor',
        'type' => 'select',
        'show_in_graphql' => 1, 
        'ui' => 1,
        'wrapper' => [
      	  'width' => 25,	  
	      ],        
      ],
      [
        'key' => 'field_menu_background_color',
        'label' => 'Background Color',
        'name' => 'menu_background_color',
        'graphql_field_name' => 'backgroundColor',
        'type' => 'select',
        'show_in_graphql' => 1, 
        'ui' => 1,
        'wrapper' => [
      	  'width' => 25,	  
	      ],
      ],      
      [
        'key' => 'field_menu_background_image_desktop',
        'label' => 'Background Image - Desktop',
        'name' => 'menu_background_image_desktop',
        'graphql_field_name' => 'backgroundImageDesktop',
        'type' => 'image',
        'wrapper' => [
	        'width' => 25
        ],
        'show_in_graphql' => 1,        
        'return_format' => 'array',
        'preview_size' => 'medium',
        'library' => 'all'
      ],
      [
        'key' => 'field_menu_background_image_mobile',
        'label' => 'Background Image - Mobile',
        'name' => 'menu_background_image_mobile',
        'graphql_field_name' => 'backgroundImageMobile',
        'type' => 'image',
        'wrapper' => [
	        'width' => 25
        ],
        'show_in_graphql' => 1,        
        'return_format' => 'array',
        'preview_size' => 'medium',
        'library' => 'all'
      ],
      [
        'key' => 'field_menu_tab_hamburger',
        'label' => 'Hamburger',
        'type' => 'tab',
        'show_in_graphql' => 1,
      ],
      [
        'key' => 'field_menu_tab_hamburger_content',
        'label' => 'Content',
        'type' => 'accordion',
        'open' => 1,
        'multi_expand' => 1
      ],
      [
				'key' => 'field_menu_tab_hamburger_label',
				'label' => 'Label',
				'name' => 'menu_tab_hamburger_label',
        'graphql_field_name' => 'hamburgerLabel',
				'type' => 'text',        
				'show_in_graphql' => 1,
        'wrapper' => [
          'width' => 25
        ]
      ],    
      [
        'key' => 'field_menu_tab_content_end',
        'label' => 'Content',
        'type' => 'accordion',
        'endpoint' => 1
      ],      
      [
        'key' => 'field_menu_accordion_logo_style',
        'label' => 'Style',
        'type' => 'accordion',
        'endpoint' => 0
      ], 
      [
        'key' => 'field_menu_icon_color',
        'label' => 'Color',
        'name' => 'menu_icon_color',
        'graphql_field_name' => 'iconColor',
        'type' => 'select',
        'show_in_graphql' => 1, 
        'ui' => 1,
        'wrapper' => [
      	  'width' => 20,	  
	      ],
      ],
      [
        'key' => 'field_menu_icon_background_color',
        'label' => 'Background Color',
        'name' => 'menu_icon_background_color',
        'graphql_field_name' => 'iconBackgroundColor',
        'type' => 'select',
        'show_in_graphql' => 1, 
        'ui' => 1,
        'wrapper' => [
      	  'width' => 20,	  
	      ],
      ],
      [
        'key' => 'field_menu_icon_border_color_desktop',
        'label' => 'Border Color - Desktop',
        'name' => 'menu_icon_border_color_desktop',
        'graphql_field_name' => 'iconBorderColorDesktop',
        'type' => 'select',
        'show_in_graphql' => 1, 
        'ui' => 1,
        'wrapper' => [
      	  'width' => 20
	      ],
      ],     
      [
        'key' => 'field_menu_icon_color_mobile',
        'label' => 'Color - Mobile',
        'name' => 'menu_icon_color_mobile',
        'graphql_field_name' => 'iconColorMobile',
        'type' => 'select',
        'show_in_graphql' => 1, 
        'ui' => 1,
        'wrapper' => [
      	  'width' => 20,	  
	      ],
      ],
      [
        'key' => 'field_menu_icon_background_color_mobile',
        'label' => 'Background Color - Mobile',
        'name' => 'menu_icon_background_color_mobile',
        'graphql_field_name' => 'iconBackgroundColorMobile',
        'type' => 'select',
        'show_in_graphql' => 1, 
        'ui' => 1,
        'wrapper' => [
      	  'width' => 20
	      ],
      ],           
      ...acf_typography_fields([
        'key' => 'field_menu_typography_hamburger_label_regular',
        'name' => 'menu_typography_hamburger_label_regular',
        'graphql_field_name' => 'hamburgerLabelRegular',
        'label' => 'Label',
        'defaults' => [
          'font_family' => 'primary',
          'font_size' => 13,
          'letter_spacing' => .03,
          'line_height' => 1,
          'font_weight' => 500,
          'text_transform' => 'uppercase'
        ]                       
      ]), 
      [
        'key' => 'field_menu_tab_style_end',
        'label' => 'Style',
        'type' => 'accordion',
        'endpoint' => 1
      ],
      [
        'key' => 'field_menu_tab_logo',
        'label' => 'Logo',
        'type' => 'tab',
        'show_in_graphql' => 1,
      ],
      [
        'key' => 'field_menu_accordion_logo_content',
        'label' => 'Content',
        'type' => 'accordion',
        'open' => 1,
        'multi_expand' => 1
      ],
      [
        'key' => 'field_menu_logo_desktop',
        'label' => 'Logo - Desktop',
        'name' => 'menu_logo_desktop',
        'graphql_field_name' => 'logoDesktop',
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
        'key' => 'field_menu_logo_mobile',
        'label' => 'Logo - Mobile',
        'name' => 'menu_logo_mobile',
        'graphql_field_name' => 'logoMobile',
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
        'key' => 'field_menu_accordion_logo_style',
        'label' => 'Style',
        'type' => 'accordion',
        'open' => 0,
        'multi_expand' => 1
      ],
      [
        'key' => 'field_menu_logo_width_desktop',
        'label' => 'Logo Width - Desktop',
        'name' => 'menu_logo_width_desktop',
        'graphql_field_name' => 'logoWidthDesktop',
        'type' => 'range',
        'wrapper' => [
	        'width' => '50'
        ],
        'show_in_graphql' => 1,
        'default_value' => 250,
        'min' => 100,
        'max' => 400,
      ],
      [
        'key' => 'field_menu_logo_width_mobile',
        'label' => 'Logo Width - Mobile',
        'name' => 'menu_logo_width_mobile',
        'graphql_field_name' => 'logoWidthMobile',
        'type' => 'range',
        'wrapper' => [
	        'width' => '50'
        ],
        'show_in_graphql' => 1,
        'default_value' => 250,
        'min' => 100,
        'max' => 400,
      ],
      [
        'key' => 'field_menu_accordion_logo_style_end',
        'label' => 'Style',
        'type' => 'accordion',
        'endpoint' => 1
      ],      
      [
        'key' => 'field_menu_typography_tab',
        'label' => 'Main Links',
        'type' => 'tab',
        'show_in_graphql' => 1,
      ],      
      [
        'key' => 'field_menu_color',
        'label' => 'Color',
        'name' => 'menu_color',
        'graphql_field_name' => 'color',
        'type' => 'select',
        'show_in_graphql' => 1, 
        'ui' => 1,
        'wrapper' => [
          'width' => 25,	  
	      ],
      ],
      [
        'key' => 'field_menu_accent_color',
        'label' => 'Accent Color',
        'name' => 'menu_accent_color',
        'graphql_field_name' => 'accentColor',
        'type' => 'select',
        'show_in_graphql' => 1, 
        'ui' => 1,
        'wrapper' => [
      	  'width' => 25,
	      ],
      ],            
      [
        'key' => 'field_menu_hover_color',
        'label' => 'Hover Color',
        'name' => 'menu_hover_color',
        'graphql_field_name' => 'hoverColor',
        'type' => 'select',
        'show_in_graphql' => 1, 
        'ui' => 1,
        'wrapper' => [
      	  'width' => 25,
	      ],
      ],            
      [
        'key' => 'field_menu_typography_desktop',
        'name' => 'menu_typography_desktop',
        'graphql_field_name' => 'desktop',
        'label' => 'Desktop',
        'type' => 'group',
        'show_in_graphql' => 1,
        'layout' => 'block',
        'sub_fields' => [
          ...acf_typography_fields([
            'key' => 'field_menu_typography_links_desktop_regular',
            'name' => 'menu_typography_links_desktop_regular',
            'graphql_field_name' => 'regular',
            'label' => 'Link',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 17,
              'letter_spacing' => 0,
              'line_height' => 1,
              'font_weight' => 'normal',
              'text_transform' => 'none'
            ]                       
          ]),          
        ]
      ],
      [
        'key' => 'field_menu_typography_mobile',
        'name' => 'menu_typography_mobile',
        'graphql_field_name' => 'mobile',
        'label' => 'Mobile',
        'type' => 'group',
        'show_in_graphql' => 1,
        'layout' => 'block',
        'sub_fields' => [
          ...acf_typography_fields([
            'key' => 'field_menu_typography_links_mobile_regular',
            'name' => 'menu_typography_links_mobile_regular',
            'graphql_field_name' => 'regular',
            'label' => 'Link',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 17,
              'letter_spacing' => 0,
              'line_height' => 1,
              'font_weight' => 'normal',
              'text_transform' => 'none'
            ]                       
          ]),          
        ]
      ],
      [
        'key' => 'field_menu_cta_tab',
        'label' => 'CTA Links',
        'type' => 'tab',
        'show_in_graphql' => 1,
      ],
      [
        'key' => 'field_menu_tab_cta_links_content',
        'label' => 'Content',
        'type' => 'accordion',
        'open' => 1,
        'multi_expand' => 1
      ],
      [
        'key' => 'field_header_cta_links',
        'name' => 'cta_links',
        'type' => 'repeater',
        'show_in_graphql' => 1,
        'layout' => 'table',
        'button_label' => 'Add link',        
        'sub_fields' => [          
	        [
            'key' => 'field_header_cta_links_link',
            'label' => 'Link',
            'name' => 'link',
            'type' => 'link',
            'show_in_graphql' => 1,
            'return_format' => 'array',
	        ]          
        ],
      ],
      [
        'key' => 'field_menu_tab_cta_links_content_end',
        'label' => 'Content',
        'type' => 'accordion',
        'endpoint' => 1,        
      ],
      [
        'key' => 'field_menu_tab_cta_links_style',
        'label' => 'Style',
        'type' => 'accordion',
        'open' => 1,
        'multi_expand' => 1
      ],
      [
        'key' => 'field_menu_tab_cta_links_color',
        'label' => 'Color',
        'name' => 'menu_tab_cta_links_color',
        'graphql_field_name' => 'ctaLinksColor',
        'type' => 'select',
        'show_in_graphql' => 1, 
        'ui' => 1,
        'wrapper' => [
      	  'width' => 25,
	      ],
      ],            
      [
        'key' => 'field_menu_cta_links_typography_desktop',
        'name' => 'menu_cta_links_typography_desktop',
        'graphql_field_name' => 'ctaLinksDesktop',
        'label' => 'Desktop',
        'type' => 'group',
        'show_in_graphql' => 1,
        'layout' => 'block',
        'sub_fields' => [
          ...acf_typography_fields([
            'key' => 'field_menu_typography_cta_links_desktop_regular',
            'name' => 'menu_typography_cta_links_desktop_regular',
            'graphql_field_name' => 'regular',
            'label' => 'Link',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 17,
              'letter_spacing' => 0,
              'line_height' => 1,
              'font_weight' => 'normal',
              'text_transform' => 'none'
            ]                       
          ]),          
        ]
      ],
      [
        'key' => 'field_menu_cta_links_typography_mobile',
        'name' => 'menu_typography_cta_links_mobile',
        'graphql_field_name' => 'ctaLinksMobile',
        'label' => 'Mobile',
        'type' => 'group',
        'show_in_graphql' => 1,
        'layout' => 'block',
        'sub_fields' => [
          ...acf_typography_fields([
            'key' => 'field_menu_typography_cta_links_mobile_regular',
            'name' => 'menu_typography_cta_links_mobile_regular',
            'graphql_field_name' => 'regular',
            'label' => 'Link',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 17,
              'letter_spacing' => 0,
              'line_height' => 1,
              'font_weight' => 'normal',
              'text_transform' => 'none'
            ]                       
          ]),          
        ]
      ],      
      [
        'key' => 'field_menu_tab_cta_links_style_end',
        'label' => 'style',
        'type' => 'accordion',
        'endpoint' => 1,        
      ],
      [
        'key' => 'field_menu_social_tab',
        'label' => 'Social Links',
        'type' => 'tab',
        'show_in_graphql' => 1,
      ],
      [
        'key' => "field_menu_social_enabled",
        'label' => 'Enabled',
        'name' => "menu_social_enabled",
        'graphql_field_name' => 'socialEnabled',
        'type' => 'true_false',
        'wrapper' => [
	        'width' => 25
        ],
        'show_in_graphql' => 1,
        'default_value' => 0,
        'ui' => 1
      ],
      [
        'key' => 'field_menu_cta_button_tab',
        'label' => 'CTA Button',
        'type' => 'tab',
        'show_in_graphql' => 1,
        'conditional_logic' => [
          [
            [
              'field' => 'field_menu_desktop_format',
              'operator' => '==',
              'value' => 'flyout'
            ],
          ],
        ],        
      ],
      [
        'key' => 'field_menu_tab_cta_button_content',
        'label' => 'Content',
        'type' => 'accordion',
        'open' => 1,
        'multi_expand' => 1
      ],
      [
        'key' => 'field_menu_cta_button_link',
        'label' => 'Link',
        'name' => 'menu_cta_button_link',
        'graphql_field_name' => 'ctaButtonLink',
        'type' => 'link',
        'show_in_graphql' => 1,
        'return_format' => 'array',
      ],  
      [
        'key' => 'field_menu_tab_cta_button_content_end',
        'label' => 'Content',
        'type' => 'accordion',
        'endpoint' => 1,        
      ],
      [
        'key' => 'field_menu_tab_cta_button_style',
        'label' => 'Style',
        'type' => 'accordion',
        'open' => 1,
        'multi_expand' => 1
      ],         
      [
        'key' => 'field_menu_cta_button_color',
        'label' => 'Color',
        'name' => 'menu_cta_button_color',
        'graphql_field_name' => 'ctaButtonColor',
        'type' => 'select',
        'show_in_graphql' => 1, 
        'ui' => 1,
        'wrapper' => [
          'width' => 25,	  
        ],
      ],
      [
        'key' => 'field_menu_cta_button_typography_desktop',
        'name' => 'menu_cta_button_typography_desktop',
        'graphql_field_name' => 'ctaButtonDesktop',
        'label' => 'Desktop',
        'type' => 'group',
        'show_in_graphql' => 1,
        'layout' => 'block',
        'sub_fields' => [
          ...acf_typography_fields([
            'key' => 'field_menu_typography_cta_button_desktop_regular',
            'name' => 'menu_typography_cta_button_desktop_regular',
            'graphql_field_name' => 'regular',
            'label' => 'Button',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 17,
              'letter_spacing' => 0,
              'line_height' => 1,
              'font_weight' => 'normal',
              'text_transform' => 'none'
            ]                       
          ]),          
        ]
      ],
      [
        'key' => 'field_menu_cta_button_typography_mobile',
        'name' => 'menu_typography_cta_button_mobile',
        'graphql_field_name' => 'ctaButtonMobile',
        'label' => 'Mobile',
        'type' => 'group',
        'show_in_graphql' => 1,
        'layout' => 'block',
        'sub_fields' => [
          ...acf_typography_fields([
            'key' => 'field_menu_typography_cta_button_mobile_regular',
            'name' => 'menu_typography_cta_button_mobile_regular',
            'graphql_field_name' => 'regular',
            'label' => 'Button',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 17,
              'letter_spacing' => 0,
              'line_height' => 1,
              'font_weight' => 'normal',
              'text_transform' => 'none'
            ]                       
          ]),          
        ]
      ],      
      [
        'key' => 'field_menu_tab_cta_button_style_end',
        'label' => 'style',
        'type' => 'accordion',
        'endpoint' => 1,        
      ],              
      [
        'key' => 'field_menu_close_tab',
        'label' => 'Close Button',
        'type' => 'tab',
        'show_in_graphql' => 1,
      ],
      [
        'key' => 'field_menu_close_button_icon_color',
        'label' => 'Icon Color',
        'name' => 'menu_close_button_icon_color',
        'graphql_field_name' => 'closeButtonIconColor',
        'type' => 'select',
        'show_in_graphql' => 1, 
        'ui' => 1,
        'wrapper' => [
      	  'width' => 25,	  
	      ],
      ],
      [
        'key' => 'field_menu_close_button_border_color',
        'label' => 'Border Color',
        'name' => 'menu_close_button_border_color',
        'graphql_field_name' => 'closeButtonBorderColor',
        'type' => 'select',
        'show_in_graphql' => 1, 
        'ui' => 1,
        'wrapper' => [
      	  'width' => 25,	  
	      ],
      ],
    ],    
  ]);   
}

add_action('acf/init', __NAMESPACE__ . '\\init');
