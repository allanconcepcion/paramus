<?php

namespace PD\ACF\Customize\Footer;

use function PD\ACF\Utils\acf_typography_fields;
use function PD\ACF\Utils\acf_cta_icon_fields;
use function PD\ACF\Utils\acf_footer_ctas_fields;

function init () {
  acf_add_local_field_group([
    'key' => 'group_footer',
    'title' => 'Footer',
    'location' => [
      [
        [
          'param' => 'options_page',
          'operator' => '==',
          'value' => 'customize',
        ],
      ],
    ],
    'menu_order' => 5,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_graphql' => 1,
    'graphql_field_name' => 'footer',
    'map_graphql_types_from_location_rules' => 0,
    'graphql_types' => '',
    'fields' => [                  
      [
        'key' => 'field_footer_logo',
        'label' => 'Logo',
        'type' => 'tab',
        'show_in_graphql' => 1,
      ],
      [
        'key' => 'field_footer_logo_content_accordion',
        'label' => 'Content',
        'type' => 'accordion',
        'open' => 1,
        'multi_expand' => 1
      ],
      [
        'key' => 'field_footer_logo_desktop',
        'label' => 'Logo - Desktop',
        'name' => 'footer_logo_desktop',
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
        'key' => 'field_footer_logo_mobile',
        'label' => 'Logo - Mobile',
        'name' => 'footer_logo_mobile',
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
        'key' => 'field_footer_logo_style_accordion',
        'label' => 'Style',
        'type' => 'accordion',
        'open' => 0,
        'multi_expand' => 1
      ],
      [
        'key' => 'field_footer_logo_width_desktop',
        'label' => 'Logo Width - Desktop',
        'name' => 'footer_logo_width_desktop',
        'graphql_field_name' => 'logoWidthDesktop',
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
        'key' => 'field_footer_logo_width_mobile',
        'label' => 'Logo Width - Mobile',
        'name' => 'footer_logo_width_mobile',
        'graphql_field_name' => 'logoWidthMobile',
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
        'key' => 'field_footer_logo_style_accordion_end',
        'label' => 'Accordion End',
        'type' => 'accordion',
        'endpoint' => 1,
      ],      
      [
        'key' => 'field_footer_phone_tab',
        'label' => 'Phone',
        'type' => 'tab',
      ],
      [
        'key' => 'field_footer_phone_content_accordion',
        'label' => 'Content',
        'type' => 'accordion',
        'open' => 0,
        'multi_expand' => 1
      ],
      [
        'key' => 'field_footer_phone_label',
        'label' => 'Label',
        'name' => 'phone_label',
        'type' => 'text',
        'show_in_graphql' => 1,
        'wrapper' => [
          'width' => 50
        ]
      ],
      [
        'key' => 'field_footer_phone_number',
        'label' => 'Number',
        'name' => 'phone_number',
        'type' => 'text',
        'show_in_graphql' => 1,
        'wrapper' => [
          'width' => 50
        ]
      ],
      [
        'key' => 'field_footer_phone_content_accordion_end',
        'label' => 'Accordion End',
        'type' => 'accordion',
        'endpoint' => 1,
      ],
      [
        'key' => 'field_footer_phone_style_accordion',
        'label' => 'Style',
        'type' => 'accordion',
        'open' => 0,
        'multi_expand' => 1
      ],
      [
	      'key' => 'field_footer_phone_style_desktop',
	      'name' => 'footer_phone_style_desktop',
        'graphql_field_name' => 'phoneStyleDesktop',
        'label' => 'Desktop',
        'type' => 'group',
        'show_in_graphql' => 1,
        'layout' => 'block',
        'sub_fields' => [
          ...acf_typography_fields([
            'key' => 'field_footer_phone_label_typography_desktop',
            'name' => 'footer_phone_label_typography_desktop',
            'graphql_field_name' => 'label',
            'label' => 'Label',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 22,
              'letter_spacing' => 0,
              'line_height' => 1,
              'font_weight' => 'normal',
              'text_transform' => 'none'
            ]                       
          ]),
          ...acf_typography_fields([
            'key' => 'field_footer_phone_number_typography_desktop',
            'name' => 'footer_phone_number_typography_desktop',
            'graphql_field_name' => 'number',
            'label' => 'Number',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 29,
              'letter_spacing' => 0,
              'line_height' => 1,
              'font_weight' => 600,
              'text_transform' => 'none'
            ],                                 
          ]),                    
        ]
      ],
      [
	      'key' => 'field_footer_phone_style_mobile',
	      'name' => 'footer_phone_style_mobile',
        'graphql_field_name' => 'phoneStyleMobile',
        'label' => 'Mobile',
        'type' => 'group',
        'show_in_graphql' => 1,
        'layout' => 'block',
        'sub_fields' => [
          ...acf_typography_fields([
            'key' => 'field_footer_phone_label_typography_mobile',
            'name' => 'footer_phone_label_typography_mobile',
            'graphql_field_name' => 'label',
            'label' => 'Label',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 22,
              'letter_spacing' => 0,
              'line_height' => 1,
              'font_weight' => 'normal',
              'text_transform' => 'none'
            ]                       
          ]),
          ...acf_typography_fields([
            'key' => 'field_footer_phone_number_typography_mobile',
            'name' => 'footer_phone_number_typography_mobile',
            'graphql_field_name' => 'number',
            'label' => 'Number',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 29,
              'letter_spacing' => 0,
              'line_height' => 1,
              'font_weight' => 600,
              'text_transform' => 'none'
            ],                                 
          ]),                    
        ]
      ],
      [
        'key' => 'field_footer_phone_style_accordion_end',
        'label' => 'Accordion End',
        'type' => 'accordion',
        'endpoint' => 1,
      ],
      [
        'key' => 'field_footer_blocks_tab',
        'label' => 'Blocks',
        'type' => 'tab',
      ],      
      [
        'key' => 'field_footer_blocks_format',
        'label' => 'Format',
        'name' => 'footer_blocks_format',
        'graphql_field_name' => 'blocksFormat',
        'type' => 'select',
        'show_in_graphql' => 1,
        'ui' => 1,
        'choices' => [
          'richText' => 'Rich Text', 
          'locations' => 'Locations'
        ],
        'wrapper' => [
          'width' => 25,	  
        ],
      ],
      [
        'key' => 'field_footer_blocks_content_accordion',
        'label' => 'Content',
        'type' => 'accordion',
        'open' => 0,
        'multi_expand' => 1
      ],
      [
        'key' => "field_footer_blocks_grid_size",
        'label' => 'Grid Size',
        'name' => "footer_blocks_grid_size",
        'graphql_field_name' => 'gridSize',
        'type' => 'select',
        'default_value' => '3x',
        'choices' => [
          '2x' => '2x', 
          '3x' => '3x', 
          '4x' => '4x', 
          '5x' => '5x'
        ],
        'instructions' => 'Effects desktop+',
        'show_in_graphql' => 1,
        'ui' => 1,
        'wrapper' => [
          'width' => '25',
        ],
      ],  
      [
        'key' => 'field_footer_blocks',
        'name' => 'footer_blocks',
        'graphql_field_name' => 'blocks',
        'type' => 'repeater',
        'show_in_graphql' => 1,
        'layout' => 'row',
        'button_label' => 'Add block',
        'sub_fields' => [
          [
            'key' => 'field_footer_blocks_label',
            'label' => 'Label',
            'name' => 'label',
            'type' => 'text',
            'required' => 1,
	          'show_in_graphql' => 1,
	        ],
          [
            'key' => 'field_footer_blocks_body',
            'label' => 'Body',
            'name' => 'body',
            'type' => 'wysiwyg',
            'required' => 1,
            'show_in_graphql' => 1,
            'default_value' => '',
            'tabs' => 'visual',
            'toolbar' => 'basic',
            'media_upload' => 0,
            'delay' => 0,
            'wrapper' => [
	            'class' => 'wysiwyg-short'
            ],
            'conditional_logic' => [
              [
                [
                  'field' => 'field_footer_blocks_format',
                  'operator' => '==',
                  'value' => 'richText'
                ],
              ],
            ],
          ],
          [
            'key' => 'field_footer_blocks_locations', 
            'name' => 'footer_blocks_locations', 
            'graphql_field_name' => 'locations',
            'label' => 'Locations', 
            'type' => 'repeater', 
            'show_in_graphql' => 1,
            'layout' => 'table',
            'button_label' => 'Add location',
            'sub_fields' => [                        
              [
                'key' => 'field_footer_blocks_location_link',
                'label' => 'Link',
                'name' => 'link',
                'type' => 'link',
                'required' => 1,
                'show_in_graphql' => 1,                
              ],             
            ], 
            'conditional_logic' => [
              [
                [
                  'field' => 'field_footer_blocks_format',
                  'operator' => '==',
                  'value' => 'locations'
                ],
              ],
            ],
          ],           
        ],        
      ],
      [
        'key' => 'field_footer_blocks_locations_mobile_hidden',
        'label' => 'Hide Locations on Mobile',
        'name' => 'footer_blocks_locations_mobile_hidden',
        'graphql_field_name' => 'blocksHiddenMobile',
        'type' => 'true_false',
        'wrapper' => [
          'width' => 25
        ],
        'show_in_graphql' => 1,
        'default_value' => 0,
        'ui' => 1, 
        'conditional_logic' => [
          [
            [
              'field' => 'field_footer_blocks_format',
              'operator' => '==',
              'value' => 'locations'
            ],
          ],
        ],
      ],
      [
        'key' => 'field_footer_blocks_locations_mobile_hidden_link',
        'label' => 'Mobile Locations Link',
        'name' => 'mobile_locations_link',
        'graphql_field_name' => 'blocksLinkMobile',
        'type' => 'link',
        'required' => 1,
        'show_in_graphql' => 1,
        'wrapper' => [
          'width' => 75
        ],
        'conditional_logic' => [
          [
            [
              'field' => 'field_footer_blocks_locations_mobile_hidden',
              'operator' => '==',
              'value' => 1
            ],
          ],
        ],
      ],
      [
        'key' => 'field_footer_blocks_content_accordion_end',
        'label' => 'Accordion End',
        'type' => 'accordion',
        'endpoint' => 1,
      ],
      [
        'key' => 'field_footer_blocks_style_accordion',
        'label' => 'Style',
        'type' => 'accordion',
        'open' => 0,
        'multi_expand' => 1
      ],
      [
	      'key' => 'field_footer_blocks_style_desktop',
	      'name' => 'footer_blocks_style_desktop',
        'graphql_field_name' => 'blocksStyleDesktop',
        'label' => 'Desktop',
        'type' => 'group',
        'show_in_graphql' => 1,
        'layout' => 'block',
        'sub_fields' => [
          ...acf_typography_fields([
            'key' => 'field_footer_blocks_label_typography_desktop',
            'name' => 'footer_blocks_label_typography_desktop',
            'graphql_field_name' => 'label',
            'label' => 'Label',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 22,
              'letter_spacing' => .05,
              'line_height' => 1,
              'font_weight' => 'normal',
              'text_transform' => 'uppercase'
            ]                       
          ]),
          ...acf_typography_fields([
            'key' => 'field_footer_blocks_body_typography_desktop',
            'name' => 'footer_blocks_body_typography_desktop',
            'graphql_field_name' => 'body',
            'label' => 'Body',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 16,
              'letter_spacing' => .1,
              'line_height' => 1,
              'font_weight' => 300,
              'text_transform' => 'uppercase'
            ], 
            'conditional_logic' => [
              [
                [
                  'field' => 'field_footer_blocks_format',
                  'operator' => '==',
                  'value' => 'richText'
                ],
              ],
            ],                     
          ]),
          [
            'key' => 'field_footer_blocks_background_color_desktop',
            'label' => 'Background Color',
            'name' => 'footer_blocks_background_color_desktop',
            'graphql_field_name' => 'backgroundColor',
            'type' => 'select',
            'show_in_graphql' => 1,
            'ui' => 1,
            'wrapper' => [
	            'width' => 33.33,	  
	          ],
          ],
          [
            'key' => "field_footer_blocks_background_image_desktop",
            'label' => 'Background Image',
            'name' => 'footer_blocks_background_image_desktop',
            'graphql_field_name' => 'backgroundImage',
            'type' => 'image',     
            'show_in_graphql' => 1,
            'return_format' => 'array',
            'preview_size' => 'medium',
            'library' => 'all',
            'wrapper' => [
              'width' => 33.33
            ],
          ],
          [
            'key' => 'field_footer_blocks_color_desktop',
            'label' => 'Color',
            'name' => 'footer_blocks_color_desktop',
            'graphql_field_name' => 'color',
            'type' => 'select',
            'show_in_graphql' => 1,
            'ui' => 1,
            'wrapper' => [
	            'width' => 33.33,	  
	          ],
          ],
        ]
      ],
      [
	      'key' => 'field_footer_blocks_style_mobile',
	      'name' => 'footer_blocks_style_mobile',
        'graphql_field_name' => 'blocksStyleMobile',
        'label' => 'Mobile',
	      'type' => 'group',
	      'show_in_graphql' => 1,
	      'layout' => 'block',
	      'sub_fields' => [
          ...acf_typography_fields([
            'key' => 'field_footer_blocks_label_typography_mobile',
            'name' => 'footer_blocks_label_typography_mobile',
            'graphql_field_name' => 'label',
            'label' => 'Label',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 22,
              'letter_spacing' => .05,
              'line_height' => 1,
              'font_weight' => 'normal',
              'text_transform' => 'uppercase'
            ]                       
          ]),
          ...acf_typography_fields([
            'key' => 'field_footer_blocks_body_typography_mobile',
            'name' => 'footer_blocks_body_typography_mobile',
            'graphql_field_name' => 'body',
            'label' => 'Body',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 16,
              'letter_spacing' => .1,
              'line_height' => 1,
              'font_weight' => 300,
              'text_transform' => 'uppercase'
            ], 
            'conditional_logic' => [
              [
                [
                  'field' => 'field_footer_blocks_format',
                  'operator' => '==',
                  'value' => 'richText'
                ],
              ],
            ],                      
          ]),
          ...acf_typography_fields([
            'key' => 'field_footer_blocks_locations_hidden_label_typography_mobile',
            'name' => 'footer_blocks_locations_hidden_label_typography_mobile',
            'graphql_field_name' => 'locationsLabel',
            'label' => 'Locations Label',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 22,
              'letter_spacing' => .1,
              'line_height' => 1,
              'font_weight' => 300,
              'text_transform' => 'uppercase'
            ], 
            'conditional_logic' => [
              [
                [
                  'field' => 'field_footer_blocks_format',
                  'operator' => '==',
                  'value' => 'locations'
                ],
                [
                  'field' => 'field_footer_blocks_locations_mobile_hidden',
                  'operator' => '==',
                  'value' => 1
                ],
              ],
            ],                      
          ]),
          [
	          'key' => 'field_footer_blocks_background_color_mobile',
      	    'label' => 'Background Color',
      	    'name' => 'footer_blocks_background_color_mobile',
            'graphql_field_name' => 'backgroundColor',
	          'type' => 'select',
	          'show_in_graphql' => 1,
            'ui' => 1,
            'wrapper' => [
	            'width' => 33.33,
	          ],
          ],
          [
            'key' => "field_footer_blocks_background_image_mobile",
            'label' => 'Background Image',
            'name' => 'footer_blocks_background_image_mobile',
            'graphql_field_name' => 'backgroundImage',
            'type' => 'image',     
            'show_in_graphql' => 1,
            'return_format' => 'array',
            'preview_size' => 'medium',
            'library' => 'all',
            'wrapper' => [
              'width' => 33.33
            ],
          ],
          [
            'key' => 'field_footer_blocks_color_mobile',
            'label' => 'Color',
            'name' => 'footer_blocks_color_mobile',
            'graphql_field_name' => 'color',
            'type' => 'select',
            'show_in_graphql' => 1,
            'ui' => 1,
            'wrapper' => [
	            'width' => 33.33,	  
      	    ],
          ],
        ]
      ],
      [
        'key' => 'field_footer_blocks_style_accordion_end',
        'label' => 'Accordion End',
        'type' => 'accordion',
        'endpoint' => 1
      ],      
      [
        'key' => 'field_footer_kicker_tab',
        'label' => 'Kicker',
        'type' => 'tab',
      ],
      [
        'key' => 'field_footer_kicker_content_accordion',
        'label' => 'Content',
        'type' => 'accordion',
        'open' => 0,
        'multi_expand' => 1
      ],
      [
        'key' => 'field_footer_kicker_tagline',
        'label' => 'Tagline',
        'name' => 'footer_kicker_tagline',
        'graphql_field_name' => 'tagline',
        'type' => 'wysiwyg',
        'show_in_graphql' => 1,
        'default_value' => '',
        'tabs' => 'visual',
        'toolbar' => 'link',
        'media_upload' => 0,
        'delay' => 0,
        'wrapper' => [
	        'class' => 'wysiwyg-short'
        ],
      ],
      [
        'key' => 'field_footer_kicker_cta',
        'label' => 'CTA',
        'name' => 'footer_kicker_cta',
        'graphql_field_name' => 'cta',
        'type' => 'wysiwyg',
        'show_in_graphql' => 1,
        'default_value' => '',
        'tabs' => 'visual',
        'toolbar' => 'link',
        'media_upload' => 0,
        'delay' => 0,
        'wrapper' => [
	        'class' => 'wysiwyg-short'
        ],
      ],
      [
        'key' => 'field_footer_copyright',
        'label' => 'Copyright',
        'name' => 'footer_copyright',
        'graphql_field_name' => 'copyright',
        'type' => 'text',
        'show_in_graphql' => 1,
      ],
      [
        'key' => 'field_footer_kicker_style_accordion',
        'label' => 'Style',
        'type' => 'accordion',
        'open' => 0,
        'multi_expand' => 1
      ],
      [
        'key' => 'field_footer_kicker_style_desktop',
        'name' => 'footer_kicker_style_desktop',
        'graphql_field_name' => 'kickerStyleDesktop',
        'label' => 'Desktop',
        'type' => 'group',
        'show_in_graphql' => 1,
        'layout' => 'block',
        'sub_fields' => [
          ...acf_typography_fields([
            'key' => 'field_footer_kicker_tagline_typography_desktop',
            'name' => 'footer_kicker_tagline_typography_desktop',
            'graphql_field_name' => 'tagline',
            'label' => 'Tagline',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 16,
              'letter_spacing' => .1,
              'line_height' => 1,
              'font_weight' => 300,
              'text_transform' => 'uppercase'
            ]                       
          ]),
          ...acf_typography_fields([
            'key' => 'field_footer_kicker_cta_typography_desktop',
            'name' => 'footer_kicker_cta_typography_desktop',
            'graphql_field_name' => 'cta',
            'label' => 'CTA',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 16,
              'letter_spacing' => .1,
              'line_height' => 1,
              'font_weight' => 600,
              'text_transform' => 'uppercase'
            ]                       
          ]),
          ...acf_typography_fields([
            'key' => 'field_footer_kicker_copyright_typography_desktop',
            'name' => 'footer_kicker_copyright_typography_desktop',
            'graphql_field_name' => 'copyright',
            'label' => 'Copyright',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 16,
              'letter_spacing' => .1,
              'line_height' => 1,
              'font_weight' => 300,
              'text_transform' => 'uppercase'
            ]                       
          ]),                   
         [
          'key' => 'field_footer_kicker_background_color_desktop',
          'label' => 'Background Color',
          'name' => 'footer_kicker_background_color_desktop',
          'graphql_field_name' => 'backgroundColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => '50',	  
	        ],
        ],
        [
          'key' => 'field_footer_kicker_color_desktop',
          'label' => 'Color',
          'name' => 'footer_kicker_color_desktop',
          'graphql_field_name' => 'color',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => '50',	  
      	   ],
         ],                  
        ]
      ],
      [
        'key' => 'field_footer_kicker_style_mobile',
        'name' => 'footer_kicker_style_mobile',
        'graphql_field_name' => 'kickerStyleMobile',
        'label' => 'Mobile',
        'type' => 'group',
        'show_in_graphql' => 1,
        'layout' => 'block',
        'sub_fields' => [
          ...acf_typography_fields([
            'key' => 'field_footer_kicker_tagline_typography_mobile',
            'name' => 'footer_kicker_tagline_typography_mobile',
            'graphql_field_name' => 'tagline',
            'label' => 'Tagline',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 16,
              'letter_spacing' => .1,
              'line_height' => 1,
              'font_weight' => 300,
              'text_transform' => 'uppercase'
            ]                       
          ]),
          ...acf_typography_fields([
            'key' => 'field_footer_kicker_cta_typography_mobile',
            'name' => 'footer_kicker_cta_typography_mobile',
            'graphql_field_name' => 'cta',
            'label' => 'CTA',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 15,
              'letter_spacing' => .1,
              'line_height' => 1,
              'font_weight' => 600,
              'text_transform' => 'uppercase'
            ]                       
          ]),
          ...acf_typography_fields([
            'key' => 'field_footer_kicker_copyright_typography_mobile',
            'name' => 'footer_kicker_copyright_typography_mobile',
            'graphql_field_name' => 'copyright',
            'label' => 'Copyright',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 15,
              'letter_spacing' => .1,
              'line_height' => 1,
              'font_weight' => 600,
              'text_transform' => 'uppercase'
            ]                       
          ]),          
          [
            'key' => 'field_footer_kicker_background_color_mobile',
            'label' => 'Background Color',
            'name' => 'footer_kicker_background_color_mobile',
            'graphql_field_name' => 'backgroundColor',
            'type' => 'select',
            'show_in_graphql' => 1,
            'ui' => 1,
            'wrapper' => [
	            'width' => '50',	  
      	    ],
          ],
          [
            'key' => 'field_footer_kicker_color_mobile',
            'label' => 'Color',
            'name' => 'footer_kicker_color_mobile',
            'graphql_field_name' => 'color',
            'type' => 'select',
            'show_in_graphql' => 1,
            'ui' => 1,
            'wrapper' => [
	            'width' => '50',	  
      	    ],
          ],                            
        ],        
      ],   
      [
        'key' => 'field_footer_kicker_style_accordion_end',      
        'type' => 'accordion',
        'open' => 0,
        'endpoint' => 1
      ],                  
      [
        'key' => 'field_footer_ctas_tab',
        'label' => 'CTAs',
        'type' => 'tab',
      ],   
      [
        'key' => 'field_footer_ctas_basic_accordion',
        'label' => 'Basic',
        'type' => 'accordion',
        'open' => 0,
        'multi_expand' => 1
      ],
      [
        'key' => 'field_footer_ctas_basic_cta_enabled',
        'label' => 'Global CTA Enabled',
        'name' => 'global_basic_cta_enabled',
        'type' => 'true_false',
        'wrapper' => [
          'width' => 25
        ],
        'show_in_graphql' => 1,
        'default_value' => 0,
        'ui' => 1
      ],
      [
        'key' => 'field_footer_ctas_basic_cta',
        'label' => 'Global CTA',
        'name' => 'global_basic_cta',
        'type' => 'link',
        'wrapper' => [
          'width' => 75
        ],
        'conditional_logic' => [
          [
            [
              'field' => 'field_footer_ctas_basic_cta_enabled',
              'operator' => '==',
              'value' => '1'
            ],
          ],
        ],
        'show_in_graphql' => 1,
        'return_format' => 'array',
      ],
      [
        'key' => 'field_footer_ctas__html_embed_accordion',
        'label' => 'HTML Embed',
        'type' => 'accordion',
        'open' => 0,
        'multi_expand' => 1
      ],
      [
        'key' => 'field_footer_ctas_html_embed_html_enabled',
        'label' => 'Global HTML Enabled',
        'name' => 'global_html_embed_html_enabled',
        'type' => 'true_false',
        'wrapper' => [
          'width' => 25
        ],
        'show_in_graphql' => 1,
        'default_value' => 0,
        'ui' => 1
      ],
      [
        'key' => 'field_footer_ctas_html_html',
        'label' => 'Html',
        'name' => 'global_html_embed_html',
        'type' => 'textarea',
        'required' => 1,
        'show_in_graphql' => 1,
        'default_value' => '',      
        'wrapper' => [
          'width' => 50
        ],
        'conditional_logic' => [
          [
            [
              'field' => 'field_footer_ctas_html_embed_html_enabled',
              'operator' => '==',
              'value' => '1'
            ],
          ],
        ],
      ],  
      [
        'key' => 'field_footer_ctas_checklist_html_embed_accordion',
        'label' => 'Checklist + HTML Embed',
        'type' => 'accordion',
        'open' => 0,
        'multi_expand' => 1
      ],
      [
        'key' => 'field_footer_ctas_checklist_html_embed_html_enabled',
        'label' => 'Global HTML Enabled',
        'name' => 'global_checklist_html_embed_html_enabled',
        'type' => 'true_false',
        'wrapper' => [
          'width' => 25
        ],
        'show_in_graphql' => 1,
        'default_value' => 0,
        'ui' => 1
      ],
      [
        'key' => 'field_footer_ctas_checklist_html_embed_html',
        'label' => 'Html',
        'name' => 'global_checklist_html_embed_html',
        'type' => 'textarea',
        'required' => 1,
        'show_in_graphql' => 1,
        'default_value' => '',      
        'wrapper' => [
          'width' => 50
        ],
        'conditional_logic' => [
          [
            [
              'field' => 'field_footer_ctas_checklist_html_embed_html_enabled',
              'operator' => '==',
              'value' => '1'
            ],
          ],
        ],
      ],  
      [
        'key' => 'field_footer_ctas_checklist_html_embed_styles_desktop',
        'name' => 'checklist_html_embed_styles_desktop',
        'label' => 'Desktop',
        'type' => 'group',
        'show_in_graphql' => 1,
        'layout' => 'block',
        'sub_fields' => [
          ...acf_typography_fields([
            'key' => 'field_footer_ctas_checklist_html_embed_typography_desktop_headline_regular',
            'name' => 'footer_ctas_checklist_html_embed_typography_desktop_headline_regular',
            'graphql_field_name' => 'headlineRegular',
            'label' => 'Headline - Regular',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 32,
              'letter_spacing' => 0,
              'line_height' => 1.2,
              'font_weight' => 300,
              'text_transform' => 'none'
            ]                       
          ]),          
          ...acf_typography_fields([
            'key' => 'field_footer_ctas_checklist_html_embed_typography_desktop_headline_bold',
            'name' => 'footer_ctas_checklist_html_embed_typography_desktop_headline_bold',
            'graphql_field_name' => 'headlineBold',
            'label' => 'Headline - Bold',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 32,
              'letter_spacing' => 0,
              'line_height' => 1.2,
              'font_weight' => 600,
              'text_transform' => 'none'
            ]                       
          ]), 
          ...acf_typography_fields([
            'key' => 'field_footer_ctas_checklist_html_embed_typography_desktop_checklist_regular',
            'name' => 'footer_ctas_checklist_html_embed_typography_desktop_checklist_regular',
            'graphql_field_name' => 'checklistRegular',
            'label' => 'Checklist - Regular',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 18,
              'letter_spacing' => 0,
              'line_height' => 1.5,
              'font_weight' => 300,
              'text_transform' => 'none'
            ]                       
          ]), 
          ...acf_typography_fields([
            'key' => 'field_footer_ctas_checklist_html_embed_typography_desktop_checklist_bold',
            'name' => 'footer_ctas_checklist_html_embed_typography_desktop_checklist_bold',
            'graphql_field_name' => 'checklistBold',
            'label' => 'Checklist - Bold',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 18,
              'letter_spacing' => 0,
              'line_height' => 1.5,
              'font_weight' => 600,
              'text_transform' => 'none'
            ]                       
          ]), 
        ]
      ],
      [
        'key' => 'field_footer_ctas_checklist_html_embed_styles_mobile',
        'name' => 'checklist_html_embed_styles_mobile',
        'label' => 'Mobile',
        'type' => 'group',
        'show_in_graphql' => 1,
        'layout' => 'block',
        'sub_fields' => [
          ...acf_typography_fields([
            'key' => 'field_footer_ctas_checklist_html_embed_typography_mobile_headline_regular',
            'name' => 'footer_ctas_checklist_html_embed_typography_mobile_headline_regular',
            'graphql_field_name' => 'headlineRegular',
            'label' => 'Headline - Regular',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 32,
              'letter_spacing' => 0,
              'line_height' => 1.2,
              'font_weight' => 300,
              'text_transform' => 'none'
            ]                       
          ]),          
          ...acf_typography_fields([
            'key' => 'field_footer_ctas_checklist_html_embed_typography_mobile_headline_bold',
            'name' => 'footer_ctas_checklist_html_embed_typography_mobile_headline_bold',
            'graphql_field_name' => 'headlineBold',
            'label' => 'Headline - Bold',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 32,
              'letter_spacing' => 0,
              'line_height' => 1.2,
              'font_weight' => 600,
              'text_transform' => 'none'
            ]                       
          ]), 
          ...acf_typography_fields([
            'key' => 'field_footer_ctas_checklist_html_embed_typography_mobile_checklist_regular',
            'name' => 'footer_ctas_checklist_html_embed_typography_mobile_checklist_regular',
            'graphql_field_name' => 'checklistRegular',
            'label' => 'Checklist',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 18,
              'letter_spacing' => 0,
              'line_height' => 1.5,
              'font_weight' => 300,
              'text_transform' => 'none'
            ]                       
          ]), 
          ...acf_typography_fields([
            'key' => 'field_footer_ctas_checklist_html_embed_typography_mobile_checklist_bold',
            'name' => 'footer_ctas_checklist_html_embed_typography_mobile_checklist_bold',
            'graphql_field_name' => 'checklistBold',
            'label' => 'Checklist - Bold',
            'defaults' => [
              'font_family' => 'primary',
              'font_size' => 18,
              'letter_spacing' => 0,
              'line_height' => 1.5,
              'font_weight' => 600,
              'text_transform' => 'none'
            ]                       
          ]), 
        ]
      ],      
    ],        
  ]);   
}

add_action('acf/init', __NAMESPACE__ . '\\init');
