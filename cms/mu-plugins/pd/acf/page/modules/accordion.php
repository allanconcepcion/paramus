<?php

namespace PD\ACF\Page\Layout\Accordion;

function fields ( $key ) {
  $config = [
    [
      'key' => "field_accordion_content_{$key}",
      'label' => 'Content',
      'type' => 'accordion',
      'open' => 1,
      'multi_expand' => 1,
      'endpoint' => 0,
    ],    
    [
      'key' => "field_accordion_eyebrow_enabled_{$key}",
      'label' => 'Eyebrow Enabled',
      'name' => "accordion_eyebrow_enabled_{$key}",
      'graphql_field_name' => 'eyebrowEnabled',
      'type' => 'true_false',
      'wrapper' => [
	      'width' => 25
      ],
      'show_in_graphql' => 1,
      'default_value' => 0,
      'ui' => 1
    ],    
    [
      'key' => "field_accordion_eyebrow_{$key}",
      'label' => 'Eyebrow',
      'name' => "accordion_eyebrow_{$key}",
      'graphql_field_name' => 'eyebrow',
      'type' => 'text',
      'show_in_graphql' => 1,
      'conditional_logic' => [
        [
          [
            'field' => "field_accordion_eyebrow_enabled_{$key}",
            'operator' => '==',
            'value' => '1'
          ],
        ],
      ],
    ],
    [
      'key' => "field_accordion_eyebrow_tag_{$key}",
      'label' => 'Eyebrow Tag',
      'name' => "accordion_eyebrow_tag_{$key}",
      'graphql_field_name' => 'eyebrowTag',
      'type' => 'select',
      'show_in_graphql' => 1,
      'choices' => [
        'h1' => 'H1',
        'h2' => 'H2',
        'h3' => 'H3',
        'h4' => 'H4',
        'h5' => 'H5',
        'h6' => 'H6',
      ],      
      'default_value' => 'h1',	
      'ui' => 1,
      'return_format' => 'value',
      'conditional_logic' => [
        [
          [
            'field' => "field_accordion_eyebrow_enabled_{$key}",
            'operator' => '==',
            'value' => '1'
          ],
        ],
      ],
    ],
    [
      'key' => "field_accordion_headline_{$key}",
      'label' => 'Headline',
      'name' => 'headline',
      'type' => 'wysiwyg',
      'wrapper' => [
	      'class' => 'wysiwyg-short'
      ],
      'show_in_graphql' => 1,
      'tabs' => 'visual',
      'toolbar' => 'bare',
      'media_upload' => 0,
      'delay' => 0,
    ],
    [
      'key' => "field_accordion_headline_tag{$key}",
      'label' => 'Headline Tag',
      'name' => "headline_tag",
      'graphql_field_name' => 'headlineTag',
      'type' => 'select',
      'show_in_graphql' => 1,
      'choices' => [
        'h1' => 'H1',
        'h2' => 'H2',
        'h3' => 'H3',
        'h4' => 'H4',
        'h5' => 'H5',
        'h6' => 'H6',
      ],
      'default_value' => 'h2',
      'multiple' => 0,
      'ui' => 0,
      'return_format' => 'value',
      'ajax' => 0,
    ],
    [
      'key' => "field_accordion_body_{$key}",
      'label' => 'Body',
      'name' => "accordion_body_{$key}",
      'graphql_field_name' => 'body',
      'type' => 'wysiwyg',
      'show_in_graphql' => 1,
      'default_value' => '',
      'tabs' => 'visual',
      'toolbar' => 'basic',
      'media_upload' => 0,
      'delay' => 0,
    ],
    [
      'key' => "field_accordion_items_{$key}",
      'label' => 'Items',
      'name' => 'accordion_items',
      'graphql_field_name' => "items",
      'type' => 'repeater',
      'show_in_graphql' => 1,
      'layout' => 'row',
      'required' => 1,
      'button_label' => 'Add item',
      'sub_fields' => [
        [
          'key' => "field_accordion_item_title_{$key}",
          'label' => 'Title',
          'name' => 'title',
          'type' => 'text',
          'required' => 1,
        ],        
        [
          'key' => "field_accordion_body_{$key}",
          'label' => 'Body',
          'name' => 'body',
          'type' => 'wysiwyg',
          'tabs' => 'visual',
          'toolbar' => 'basic',
          'media_upload' => 0,
          'required' => 1,
          'wrapper' => array(
	          'class' => 'wysiwyg-medium'
          ),
        ],
        [
          'key' => "field_accordion_item_image_{$key}",
          'label' => 'Image',
          'name' => 'image',
          'type' => 'image',     
          'show_in_graphql' => 1,
          'return_format' => 'array',
          'preview_size' => 'medium',
          'library' => 'all',
          'required' => 0,
        ],
      ],
    ],
  ];

  $config = array_merge($config, [
    [
      'key' => "field_accordion_style_accordion_{$key}",
      'label' => 'Style',
      'type' => 'accordion',
      'open' => 0,
      'multi_expand' => 1,
    ],  
    [
      'key' => "field_accordion_background_image_enabled_{$key}",
      'name' => "accordion_background_image_enabled_{$key}",
      'label' => 'Background Image Enabled',
      'graphql_field_name' => 'backgroundImageEnabled',      
      'type' => 'true_false',
      'instructions' => "Image is a global setting for `accordion` modules!!.",
      'wrapper' => [
        'width' => 100
      ],
      'show_in_graphql' => 1,
      'default_value' => 0,
      'ui' => 1
    ],         
    [
      'key' => "field_accordion_visible_on_desktop_{$key}",
      'name' => "accordion_visible_on_desktop_{$key}",
      'label' => 'Visible on Desktop?',
      'graphql_field_name' => 'visibleOnDesktop',      
      'type' => 'true_false',      
      'wrapper' => [
	      'width' => 50
      ],
      'show_in_graphql' => 1,
      'default_value' => 1,
      'ui' => 1
    ],            
    [
      'key' => "field_accordion_visible_on_mobile_{$key}",
      'name' => "accordion_visible_on_mobile_{$key}",
      'label' => 'Visible on Mobile?',
      'graphql_field_name' => 'visibleOnMobile',      
      'type' => 'true_false',      
      'wrapper' => [
	      'width' => 50
      ],
      'show_in_graphql' => 1,
      'default_value' => 1,
      'ui' => 1
    ],                           
  ]);

  if ( $key === 'a' ) {
    $config = array_merge($config, [      
      [
        'key' => "field_accordion_customize_layout_{$key}",
        'label' => 'Customize Theme',
        'name' => "accordion_customize_layout",
        'graphql_field_name' => 'customizeLayout',
        'type' => 'select',
        'required' => 1,
        'show_in_graphql' => 1,
        'ui' => 1,
        'wrapper' => [
          'width' => 25
        ], 
        'choices' => [
          'a' => 'A', 
          'b' => 'B', 
          'c' => 'C'
        ], 
        'default_value' => 'a'
      ],                    
    ]);
  }

  $config = array_merge($config, [               
    [
      'key' => "field_accordion_style_accordion_end_{$key}",
      'label' => 'Style',
      'type' => 'accordion',
      'endpoint' => 1
    ],
  ]);

  return $config;
}
