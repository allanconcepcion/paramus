<?php

namespace PD\ACF\Customize\Globals;

use function PD\ACF\Utils\acf_typography_fields;

function init () {
  acf_add_local_field_group([
    'key' => 'group_global',
    'title' => 'Global',
    'location' => [
      [
        [
	  'param' => 'options_page',
	  'operator' => '==',
	  'value' => 'customize',
        ],
      ],
    ],
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
    'show_in_graphql' => 1,
    'graphql_field_name' => 'global',
    'map_graphql_types_from_location_rules' => 0,
    'graphql_types' => '',
    'fields' => [
      [
        'key' => 'field_global_colors_tab',
        'label' => 'Colors',
        'type' => 'tab',
        'show_in_graphql' => 1,
      ],
      [
        'key' => 'field_global_global_colors_accordion',
        'label' => 'Global',
        'type' => 'accordion',
        'open' => 0,
        'multi_expand' => 1
      ],
      [
        'key' => 'field_global_colors',
        'label' => '',
        'name' => 'colors',
        'type' => 'repeater',
        'show_in_graphql' => 1,
        'layout' => 'table',
        'button_label' => 'Add color',
        'sub_fields' => [
          [
            'key' => 'field_global_colors_name',
            'label' => 'Name',
            'name' => 'name',
            'type' => 'text',
            'instructions' => '',
            'required' => 1,
            'wrapper' => [
              'width' => '50',
            ],
            'show_in_graphql' => 1,
          ],
          [
            'key' => 'field_global_colors_color',
            'label' => 'Color',
            'name' => 'color',
            'type' => 'color_picker',
            'required' => 1,
            'wrapper' => [
              'width' => '50',
            ],
            'show_in_graphql' => 1,
            'enable_opacity' => 1,
            'return_format' => 'string',
          ],
        ],
      ],
      [
        'key' => 'field_global_colors_accordion_end',
        'label' => 'Accordion End',
        'type' => 'accordion',
        'endpoint' => 1,            
      ],
      [
        'key' => 'field_global_default_styles_accordion',
        'label' => 'Default Styles',
        'type' => 'accordion',
        'open' => 0,
        'multi_expand' => 1
      ],
      [
        'key' => 'field_global_default_styles_hyperlinks_tab',
        'label' => 'Hyperlinks',
        'type' => 'tab',
        'show_in_graphql' => 1,
      ],
      [
        'key' => 'field_global_default_styles_hyperlink_color',
        'label' => 'Color',
        'name' => 'global_default_styles_hyperlink_color',
        'graphql_field_name' => 'hyperlinkColor',
	      'type' => 'select',
	      'show_in_graphql' => 1,
        'ui' => 1,
        'wrapper' => [
	        'width' => 25,
	      ],
      ],      
      [
        'key' => 'field_global_defauly_styles_accordion_end',
        'label' => 'Accordion End',
        'type' => 'accordion',
        'endpoint' => 1,            
      ],
      [
        'key' => 'field_global_typography_tab',
        'label' => 'Typography',
        'type' => 'tab',
        'show_in_graphql' => 1,
      ],
      [
        'key' => 'field_global_typography_font_family_accordion',
        'label' => 'Font Families',
        'type' => 'accordion',
        'open' => 0,
        'multi_expand' => 1
      ],
      [
        'key' => 'field_global_font_families',
        'label' => '',
        'name' => 'font_families',
        'type' => 'repeater',
        'show_in_graphql' => 1,
        'layout' => 'table',
        'button_label' => 'Add font family',
        'sub_fields' => [
          [
            'key' => 'field_global_font_family_label',
            'label' => 'Label',
            'name' => 'label',
            'type' => 'text',
            'required' => 1,
            'wrapper' => [
              'width' => '50',
            ],
            'show_in_graphql' => 1,
          ],
          [
            'key' => 'field_global_font_family_family',
            'label' => 'Family',
            'name' => 'family',
            'type' => 'text',
                  'required' => 1,
            'wrapper' => [
              'width' => '50',
            ],
            'show_in_graphql' => 1,
            'enable_opacity' => 0,
            'return_format' => 'string',
          ],
        ],
      ],
      [
        'key' => 'field_global_typography_embed',
        'label' => 'Embed HTML',
        'name' => 'typography_embed',
        'type' => 'textarea',
        'show_in_graphql' => 1,
        'rows' => 3,
        'default_value' => <<<EOD
          <link rel="preconnect" href="https://fonts.googleapis.com">
          <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
          <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">
        EOD
      ],
      [
        'key' => 'field_global_typography_font_family_accordion_end',
        'label' => 'Accordion End',
        'type' => 'accordion',
        'endpoint' => 1,            
      ],
      [
        'key' => 'field_global_typography_default_styles_accordion',
        'label' => 'Default Styles',
        'type' => 'accordion',
        'open' => 0,
        'multi_expand' => 1
      ],
      [
        'key' => 'field_global_typography_h1_tab',
        'label' => 'H1',
        'type' => 'tab',
        'show_in_graphql' => 1,
      ],
      [
        'key' => 'field_global_typography_h1_desktop',
        'name' => 'h1_desktop',
        'label' => 'Desktop',
        'type' => 'group',
        'show_in_graphql' => 1,
        'layout' => 'block',
        'sub_fields' => [
          ...acf_typography_fields([
            'key' => 'field_global_typography_h1_desktop_regular',
            'name' => 'global_typography_h1_desktop_regular',
            'graphql_field_name' => 'regular',
            'label' => 'Regular',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 13,
              'letter_spacing' => .1,
              'line_height' => 1,
              'font_weight' => 'normal',
              'text_transform' => 'uppercase'
            ]
          ]),
        ]
      ],
      [
        'key' => 'field_global_typography_h1_mobile',
        'name' => 'h1_mobile',
        'label' => 'Mobile',
        'type' => 'group',
        'show_in_graphql' => 1,
        'layout' => 'block',
        'sub_fields' => [
          ...acf_typography_fields([
            'key' => 'field_global_typography_h1_mobile_regular',
            'name' => 'global_typography_h1_mobile_regular',
            'graphql_field_name' => 'regular',
            'label' => 'Regular',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 12,
              'letter_spacing' => .1,
              'line_height' => 1,
              'font_weight' => 'normal',
              'text_transform' => 'uppercase'
            ]
          ]),
        ]
      ],                  
      [
        'key' => 'field_global_typography_h2_tab',
        'label' => 'H2',
        'type' => 'tab',
        'show_in_graphql' => 1,
      ],
      [
        'key' => 'field_global_typography_h2_desktop',
        'name' => 'h2_desktop',
        'label' => 'Desktop',
        'type' => 'group',
        'show_in_graphql' => 1,
        'layout' => 'block',
        'sub_fields' => [
          ...acf_typography_fields([
            'key' => 'field_global_typography_h2_desktop_regular',
            'name' => 'global_typography_h2_desktop_regular',
            'graphql_field_name' => 'regular',
            'label' => 'Regular',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 44,
              'letter_spacing' => 0,
              'line_height' => 1.2,
              'font_weight' => 300,
              'text_transform' => 'none'
            ]            
          ]),
          ...acf_typography_fields([
            'key' => 'field_global_typography_h2_desktop_bold',
            'name' => 'global_typography_h2_desktop_bold',
            'graphql_field_name' => 'bold',
            'label' => 'Bold',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 44,
              'letter_spacing' => 0,
              'line_height' => 1.2,
              'font_weight' => 600,
              'text_transform' => 'none'
            ]            
          ]),
        ]
      ],
      [
        'key' => 'field_global_typography_h2_mobile',
        'name' => 'h2_mobile',
        'label' => 'Mobile',
        'type' => 'group',
        'show_in_graphql' => 1,
        'layout' => 'block',
        'sub_fields' => [
          ...acf_typography_fields([
            'key' => 'field_global_typography_h2_mobile_regular',
            'name' => 'global_typography_h2_mobile_regular',
            'graphql_field_name' => 'regular',
            'label' => 'Regular',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 30,
              'letter_spacing' => 0,
              'line_height' => 1.2,
              'font_weight' => 300,
              'text_transform' => 'none'
            ]                       
          ]),
          ...acf_typography_fields([
            'key' => 'field_global_typography_h2_mobile_bold',
            'name' => 'global_typography_h2_mobile_bold',
            'graphql_field_name' => 'bold',
            'label' => 'Bold',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 30,
              'letter_spacing' => 0,
              'line_height' => 1.2,
              'font_weight' => 600,
              'text_transform' => 'none'
            ]                       
          ]),          
        ]
      ],                      
      [
        'key' => 'field_global_typography_h3_tab',
        'label' => 'H3',
        'type' => 'tab',
        'show_in_graphql' => 1,
      ],      
      [
        'key' => 'field_global_typography_h3_desktop',
        'name' => 'h3_desktop',
        'label' => 'Desktop',
        'type' => 'group',
        'show_in_graphql' => 1,
        'layout' => 'block',
        'sub_fields' => [
          ...acf_typography_fields([
            'key' => 'field_global_typography_h3_desktop_regular',
            'name' => 'global_typography_h3_desktop_regular',
            'graphql_field_name' => 'regular',
            'label' => 'Regular',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 30,
              'letter_spacing' => 0,
              'line_height' => 1.2,
              'font_weight' => 300,
              'text_transform' => 'none'
            ]                       
          ]),          
          ...acf_typography_fields([
            'key' => 'field_global_typography_h3_desktop_bold',
            'name' => 'global_typography_h3_desktop_bold',
            'graphql_field_name' => 'bold',
            'label' => 'Bold',
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
            'key' => 'field_global_typography_h3_desktop_extra_bold',
            'name' => 'global_typography_h3_desktop_extra_bold',
            'graphql_field_name' => 'extraBold',
            'label' => 'Extra Bold',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 30,
              'letter_spacing' => 0,
              'line_height' => 1.2,
              'font_weight' => 600,
              'text_transform' => 'none'
            ]                       
          ]),                              
        ]
      ],
      [
        'key' => 'field_global_typography_h3_mobile',
        'name' => 'h3_mobile',
        'label' => 'Mobile',
        'type' => 'group',
        'show_in_graphql' => 1,
        'layout' => 'block',
        'sub_fields' => [
          ...acf_typography_fields([
            'key' => 'field_global_typography_h3_mobile_regular',
            'name' => 'global_typography_h3_mobile_regular',
            'graphql_field_name' => 'regular',
            'label' => 'Regular',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 22,
              'letter_spacing' => 0,
              'line_height' => 1.2,
              'font_weight' => 300,
              'text_transform' => 'none'
            ]                       
          ]),          
          ...acf_typography_fields([
            'key' => 'field_global_typography_h3_mobile_bold',
            'name' => 'global_typography_h3_mobile_bold',
            'graphql_field_name' => 'bold',
            'label' => 'Bold',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 22,
              'letter_spacing' => 0,
              'line_height' => 1.2,
              'font_weight' => 'normal',
              'text_transform' => 'none'
            ]                       
          ]),
          ...acf_typography_fields([
            'key' => 'field_global_typography_h3_mobile_extra_bold',
            'name' => 'global_typography_h3_mobile_extra_bold',
            'graphql_field_name' => 'extraBold',
            'label' => 'Extra Bold',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 22,
              'letter_spacing' => 0,
              'line_height' => 1.2,
              'font_weight' => 600,
              'text_transform' => 'none'
            ]                       
          ]),                              
        ]
      ],
      [
        'key' => 'field_global_typography_h4_tab',
        'label' => 'H4',
        'type' => 'tab',
        'show_in_graphql' => 1,
      ],
      [
        'key' => 'field_global_typography_h4_desktop',
        'name' => 'h4_desktop',
        'label' => 'Desktop',
        'type' => 'group',
        'show_in_graphql' => 1,
        'layout' => 'block',
        'sub_fields' => [
          ...acf_typography_fields([
            'key' => 'field_global_typography_h4_desktop_light',
            'name' => 'global_typography_h4_desktop_light',
            'graphql_field_name' => 'light',
            'label' => 'Light',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 24,
              'letter_spacing' => 0,
              'line_height' => 1,
              'font_weight' => 300,
              'text_transform' => 'none'
            ]
          ]),
         ...acf_typography_fields([
           'key' => 'field_global_typography_h4_desktop_regular',
           'name' => 'global_typography_h4_desktop_regular',
           'graphql_field_name' => 'regular',
           'label' => 'Regular',
           'defaults' => [
             'font_family' => 'primary',
             'font_size' => 24,
             'letter_spacing' => 0,
             'line_height' => 1,
             'font_weight' => 'normal',
             'text_transform' => 'none'
           ]
         ]),
         ...acf_typography_fields([
          'key' => 'field_global_typography_h4_desktop_bold',
          'name' => 'global_typography_h4_desktop_bold',
          'graphql_field_name' => 'bold',
          'label' => 'Bold',
          'defaults' => [
            'font_family' => 'primary',
            'font_size' => 24,
            'letter_spacing' => 0,
            'line_height' => 1,
            'font_weight' => 'bold',
            'text_transform' => 'none'
          ]
        ]),
        ]
      ],
      [
        'key' => 'field_global_typography_h4_mobile',
        'name' => 'h4_mobile',
        'label' => 'Mobile',
        'type' => 'group',
        'show_in_graphql' => 1,
        'layout' => 'block',
        'sub_fields' => [
          ...acf_typography_fields([
            'key' => 'field_global_typography_h4_mobile_light',
            'name' => 'global_typography_h4_mobile_light',
            'graphql_field_name' => 'light',
            'label' => 'Light',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 18,
              'letter_spacing' => 0,
              'line_height' => 1,
              'font_weight' => 300,
              'text_transform' => 'none'
            ]
          ]),
         ...acf_typography_fields([
           'key' => 'field_global_typography_h4_mobile_regular',
           'name' => 'global_typography_h4_mobile_regular',
           'graphql_field_name' => 'regular',
           'label' => 'Regular',
           'defaults' => [
             'font_family' => 'primary',
             'font_size' => 18,
             'letter_spacing' => 0,
             'line_height' => 1,
             'font_weight' => 'normal',
             'text_transform' => 'none'
           ]
         ]),
         ...acf_typography_fields([
          'key' => 'field_global_typography_h4_mobile_bold',
          'name' => 'global_typography_h4_mobile_bold',
          'graphql_field_name' => 'bold',
          'label' => 'Bold',
          'defaults' => [
            'font_family' => 'primary',
            'font_size' => 18,
            'letter_spacing' => 0,
            'line_height' => 1,
            'font_weight' => 'bold',
            'text_transform' => 'none'
          ]
        ]),
        ]
      ],      
      [
        'key' => 'field_global_typography_h5_tab',
        'label' => 'H5',
        'type' => 'tab',
        'show_in_graphql' => 1,
      ],
      [
        'key' => 'field_global_typography_h5_desktop',
        'name' => 'h5_desktop',
        'label' => 'Desktop',
        'type' => 'group',
        'show_in_graphql' => 1,
        'layout' => 'block',
        'sub_fields' => [
          ...acf_typography_fields([
            'key' => 'field_global_typography_h5_desktop_regular',
            'name' => 'global_typography_h5_desktop_regular',
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
        'key' => 'field_global_typography_h5_mobile',
        'name' => 'h5_mobile',
        'label' => 'Mobile',
        'type' => 'group',
        'show_in_graphql' => 1,
        'layout' => 'block',
        'sub_fields' => [
          ...acf_typography_fields([
            'key' => 'field_global_typography_h5_mobile_regular',
            'name' => 'global_typography_h5_mobile_regular',
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
        'key' => 'field_global_typography_h6_tab',
        'label' => 'H6',
        'type' => 'tab',
        'show_in_graphql' => 1,
      ],
      [
        'key' => 'field_global_typography_h6_desktop',
        'name' => 'h6_desktop',
        'label' => 'Desktop',
        'type' => 'group',
        'show_in_graphql' => 1,
        'layout' => 'block',
        'sub_fields' => [
          ...acf_typography_fields([
            'key' => 'field_global_typography_h6_desktop_light',
            'name' => 'global_typography_h6_desktop_light',
            'graphql_field_name' => 'light',
            'label' => 'Light',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 16,
              'letter_spacing' => 0,
              'line_height' => 1,
              'font_weight' => 300,
              'text_transform' => 'none'
            ]
          ]),                    
          ...acf_typography_fields([
            'key' => 'field_global_typography_h6_desktop_regular',
            'name' => 'global_typography_h6_desktop_regular',
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
        'key' => 'field_global_typography_h6_mobile',
        'name' => 'h6_mobile',
        'label' => 'Mobile',
        'type' => 'group',
        'show_in_graphql' => 1,
        'layout' => 'block',
        'sub_fields' => [
          ...acf_typography_fields([
            'key' => 'field_global_typography_h6_mobile_light',
            'name' => 'global_typography_h6_mobile_light',
            'graphql_field_name' => 'light',
            'label' => 'Light',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 16,
              'letter_spacing' => 0,
              'line_height' => 1,
              'font_weight' => 300,
              'text_transform' => 'none'
            ]
          ]),                              
          ...acf_typography_fields([
            'key' => 'field_global_typography_h6_mobile_regular',
            'name' => 'global_typography_h6_mobile_regular',
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
        'key' => 'field_global_typography_body_tab',
        'label' => 'Body',
        'type' => 'tab',
        'show_in_graphql' => 1,
      ],    
      [
        'key' => "field_global_typography_override_list_bullet_color",
        'label' => 'Override List Bullet Color',
        'name' => "global_typography_override_list_bullet_color",
        'graphql_field_name' => 'overrideListBulletColor',
        'type' => 'true_false',
        'wrapper' => [
	        'width' => 25
        ],
        'show_in_graphql' => 1,
        'default_value' => 0,
        'ui' => 1
      ],
      [
        'key' => 'field_global_typography_list_bullet_color',
        'label' => 'List Bullet Color',
        'name' => 'global_typography_list_bullet_color',
        'graphql_field_name' => 'listBulletColor',
        'type' => 'select',
        'show_in_graphql' => 1, 
        'ui' => 1,
        'wrapper' => [
          'width' => 25,	  
        ],
        'conditional_logic' => [
          [
            [
              'field' => 'field_global_typography_override_list_bullet_color',
              'operator' => '==',
              'value' => 1
            ],
          ],
        ],        
      ],
      [
        'key' => 'field_global_typography_body_desktop',
        'name' => 'body_desktop',
        'label' => 'Desktop',
        'type' => 'group',
        'show_in_graphql' => 1,
        'layout' => 'block',
        'sub_fields' => [
          ...acf_typography_fields([
            'key' => 'field_global_typography_body_desktop_regular',
            'name' => 'global_typography_body_desktop_regular',
            'graphql_field_name' => 'regular',
            'label' => 'Regular',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 17,
              'letter_spacing' => 0,
              'line_height' => 1.6,
              'font_weight' => 'normal',
              'text_transform' => 'none'
            ]                       
          ]),
        ]
      ],
      [
        'key' => 'field_global_typography_body_mobile',
        'name' => 'body_mobile',
        'label' => 'Mobile',
        'type' => 'group',
        'show_in_graphql' => 1,
        'layout' => 'block',
        'sub_fields' => [
          ...acf_typography_fields([
            'key' => 'field_global_typography_body_mobile_regular',
            'name' => 'global_typography_body_mobile_regular',
            'graphql_field_name' => 'regular',
            'label' => 'Regular',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 16,
              'letter_spacing' => 0,
              'line_height' => 1.6,
              'font_weight' => 'normal',
              'text_transform' => 'none'
            ]                       
          ]),          
        ]
      ],
      [
        'key' => 'field_global_typography_hyperlinks_tab',
        'label' => 'Hyperlinks',
        'type' => 'tab',
        'show_in_graphql' => 1,
      ],     
      [
        'key' => "field_global_hyperlink_font_weight",
        'label' => "Font Weight",
        'name' => "global_hyperlink_font_weight",
        'graphql_field_name' => "hyperlinkFontWeight",
        'type' => 'select',
        'wrapper' => array(
          'width' => 100/6,
        ),
        'show_in_graphql' => 1,
        'choices' => array(
          100 => 100,
          200 => 200,
          300 => 300,
          'normal' => 'Normal',
          500 => 500,
          600 => 600,
          'bold' => 'Bold',
          800 => 800,
          900 => 900
        ),
        'default_value' => 'normal',
        'ui' => 1,
        'return_format' => 'value'        
      ],
      [
        'key' => 'field_global_typography_buttons_tab',
        'label' => 'Buttons',
        'type' => 'tab',
        'show_in_graphql' => 1,
      ],      
      [
        'key' => 'field_global_typography_buttons_desktop',
        'name' => 'button_desktop',
        'label' => 'Desktop',
        'type' => 'group',
        'show_in_graphql' => 1,
        'layout' => 'block',
        'sub_fields' => [
          ...acf_typography_fields([
            'key' => 'field_global_typography_buttons_desktop_regular',
            'name' => 'global_typography_buttons_desktop_regular',
            'graphql_field_name' => 'regular',
            'label' => 'Regular',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 17,
              'letter_spacing' => .01,
              'line_height' => 1.6,
              'font_weight' => 600,
              'text_transform' => 'uppercase'
            ]                       
          ]),       
          ...acf_typography_fields([
            'key' => 'field_global_typography_buttons_desktop_large',
            'name' => 'global_typography_buttons_desktop_large',
            'graphql_field_name' => 'large',
            'label' => 'Large',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 24,
              'letter_spacing' => .01,
              'line_height' => 1.6,
              'font_weight' => 600,
              'text_transform' => 'uppercase'
            ]                       
          ]),       
        ]
      ],
      [
        'key' => 'field_global_typography_buttons_mobile',
        'name' => 'button_mobile',
        'label' => 'Mobile',
        'type' => 'group',
        'show_in_graphql' => 1,
        'layout' => 'block',
        'sub_fields' => [
          ...acf_typography_fields([
            'key' => 'field_global_typography_buttons_mobile_regular',
            'name' => 'global_typography_buttons_mobile_regular',
            'graphql_field_name' => 'regular',
            'label' => 'Regular',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 17,
              'letter_spacing' => .01,
              'line_height' => 1.6,
              'font_weight' => 600,
              'text_transform' => 'uppercase'
            ]                       
          ]),                                 
          ...acf_typography_fields([
            'key' => 'field_global_typography_buttons_mobile_large',
            'name' => 'global_typography_buttons_mobile_large',
            'graphql_field_name' => 'large',
            'label' => 'Large',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 24,
              'letter_spacing' => .01,
              'line_height' => 1.6,
              'font_weight' => 600,
              'text_transform' => 'uppercase'
            ]                       
          ]),       
        ]
      ],
      [
        'key' => 'field_global_typography_image_captions_tab',
        'label' => 'Image Captions',
        'type' => 'tab',
        'show_in_graphql' => 1,
      ],      
      [
        'key' => 'field_global_typography_image_captions_desktop',
        'name' => 'image_captions_desktop',
        'label' => 'Desktop',
        'type' => 'group',
        'show_in_graphql' => 1,
        'layout' => 'block',
        'sub_fields' => [
         ...acf_typography_fields([
           'key' => 'field_global_typography_image_captions_desktop_regular',
           'name' => 'global_typography_image_captions_desktop_regular',
           'graphql_field_name' => 'regular',
           'label' => 'Regular',
           'defaults' => [
             'font_family' => 'primary',
             'font_size' => 17,
             'letter_spacing' => .01,
             'line_height' => 1.6,
             'font_weight' => 600,
             'text_transform' => 'uppercase'
           ]                       
         ]),       
        ]
      ],
      [
        'key' => 'field_global_typography_image_captions_mobile',
        'name' => 'image_captions_mobile',
        'label' => 'Mobile',
        'type' => 'group',
        'show_in_graphql' => 1,
        'layout' => 'block',
        'sub_fields' => [
         ...acf_typography_fields([
           'key' => 'field_global_typography_image_captions_mobile_regular',
           'name' => 'global_typography_image_captions_mobile_regular',
           'graphql_field_name' => 'regular',
           'label' => 'Regular',
           'defaults' => [
             'font_family' => 'primary',
             'font_size' => 17,
             'letter_spacing' => .01,
             'line_height' => 1.6,
             'font_weight' => 600,
             'text_transform' => 'uppercase'
           ]                       
         ]),                                 
        ]
      ],      
      [
        'key' => 'field_global_typography_default_styles_accordion_end',
        'label' => 'Accordion End',
        'type' => 'accordion',
        'endpoint' => 1,            
      ],      
    ],    
  ]);   
}

add_action('acf/init', __NAMESPACE__ . '\\init');