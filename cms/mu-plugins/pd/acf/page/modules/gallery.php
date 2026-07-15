<?php

namespace PD\ACF\Page\Layout\Gallery;

function fields ( $key ) {
  $config = [
    [
      'key' => "field_gallery_content_{$key}",
      'label' => 'Content',
      'type' => 'accordion',
      'open' => 1,
      'multi_expand' => 1,
      'endpoint' => 0,
    ],
    [
      'key' => "field_gallery_eyebrow_enabled_{$key}",
      'label' => 'Eyebrow Enabled',
      'name' => "eyebrow_enabled_{$key}",
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
      'key' => "field_gallery_eyebrow_{$key}",
      'label' => 'Eyebrow',
      'name' => "eyebrow_{$key}",
      'graphql_field_name' => 'eyebrow',
      'type' => 'text',
      'show_in_graphql' => 1,
      'conditional_logic' => [
        [
          [
            'field' => "field_gallery_eyebrow_enabled_{$key}",
            'operator' => '==',
            'value' => '1'
          ],
        ],
      ],
    ],
    [
      'key' => "field_gallery_eyebrow_tag_{$key}",
      'label' => 'Eyebrow Tag',
      'name' => "eyebrow_tag_{$key}",
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
            'field' => "field_gallery_eyebrow_enabled_{$key}",
            'operator' => '==',
            'value' => '1'
          ],
        ],
      ],
    ],
    [
      'key' => "field_gallery_headline_{$key}",
      'label' => 'Headline',
      'name' => "gallery_headline_{$key}",
      'graphql_field_name' => 'headline',
      'type' => 'wysiwyg',
      'wrapper' => [
	      'class' => 'wysiwyg-short'
      ],
      'show_in_graphql' => 1,
      'tabs' => 'visual',
      'toolbar' => 'bare',
      'media_upload' => 0,
      'delay' => 0
    ],
    [
      'key' => "field_gallery_headline_tag_{$key}",
      'label' => 'Headline Tag',
      'name' => "headline_tag_{$key}",
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
      'key' => "field_gallery_body_{$key}",
      'label' => 'Body',
      'name' => 'body',
      'type' => 'wysiwyg',
      'show_in_graphql' => 1,
      'default_value' => '',
      'tabs' => 'visual',
      'toolbar' => 'basic',
      'media_upload' => 0,
      'delay' => 0,
    ],            
    [
      'key' => "field_gallery_navigation_{$key}",
      'label' => 'Navigation',
      'name' => "gallery_navigation_{$key}",
      'graphql_field_name' => "navigation",
      'type' => 'repeater',
      'show_in_graphql' => 1,
      'layout' => 'table',
      'instructions' => '"All" is added by default if any navigation items are present.',
      'button_label' => 'Add Navigation Item',
      'sub_fields' => [        
        [
          'key' => "field_gallery_navigation_item_title_{$key}",
          'label' => 'Title',
          'name' => "gallery_navigation_item_title_{$key}",
          'graphql_field_name' => 'title',
          'type' => 'text',     
          'show_in_graphql' => 1,
          'required' => 1,
        ],
        [
          'key' => "field_gallery_navigation_item_tag_{$key}",
          'label' => 'Tag',
          'name' => "gallery_navigation_item_tag_{$key}",
          'graphql_field_name' => 'tag',
          'type' => 'text',     
          'show_in_graphql' => 1,
          'instructions' => 'Associate this tag with gallery item tags to filter.',
          'required' => 1,
        ],        
      ]
    ],
    [
      'key' => "field_gallery_items_{$key}",
      'label' => 'Items',
      'name' => "gallery_items_{$key}",
      'graphql_field_name' => "items",
      'type' => 'repeater',
      'show_in_graphql' => 1,
      'layout' => 'block',
      'required' => 1,
      'button_label' => 'Add Gallery Item',
      'sub_fields' => [
        [
          'key' => "field_gallery_item_type_{$key}",
          'label' => 'Type',
          'name' => "gallery_item_type_{$key}",
          'graphql_field_name' => 'type',
          'type' => 'select',
          'show_in_graphql' => 1,
          'choices' => [
            'image' => 'Image',
            'beforeAfter' => 'Before/After',
          ],      
          'default_value' => 'image',	
          'ui' => 1,
          'return_format' => 'value',
          'wrapper' => [
            'width' => 25
          ],
        ],        
        [
          'key' => "field_gallery_item_image_{$key}",
          'label' => 'Image',
          'name' => "gallery_item_image_{$key}",
          'graphql_field_name' => 'image',
          'type' => 'image',     
          'show_in_graphql' => 1,
          'return_format' => 'array',
          'preview_size' => 'medium',
          'library' => 'all',
          'required' => 1,
          'wrapper' => [
            'width' => 50
          ],
          'conditional_logic' => [
            [
              [
                'field' => "field_gallery_item_type_{$key}",
                'operator' => '==',
                'value' => 'image'
              ],
            ],
          ],
        ],
        [
          'key' => "field_gallery_item_image_before_{$key}",
          'label' => 'Image (Before)',
          'name' => "gallery_item_image_before_{$key}",
          'graphql_field_name' => 'imageBefore',
          'type' => 'image',     
          'show_in_graphql' => 1,
          'return_format' => 'array',
          'preview_size' => 'medium',
          'library' => 'all',
          'required' => 1,
          'wrapper' => [
            'width' => 25
          ],
          'conditional_logic' => [
            [
              [
                'field' => "field_gallery_item_type_{$key}",
                'operator' => '==',
                'value' => 'beforeAfter'
              ],
            ],
          ],
        ],
        [
          'key' => "field_gallery_item_image_after_{$key}",
          'label' => 'Image (After)',
          'name' => "gallery_item_image_after_{$key}",
          'graphql_field_name' => 'imageAfter',
          'type' => 'image',     
          'show_in_graphql' => 1,
          'return_format' => 'array',
          'preview_size' => 'medium',
          'library' => 'all',
          'required' => 1,
          'wrapper' => [
            'width' => 25
          ],
          'conditional_logic' => [
            [
              [
                'field' => "field_gallery_item_type_{$key}",
                'operator' => '==',
                'value' => 'beforeAfter'
              ],
            ],
          ],
        ],
        [
          'key' => "field_gallery_item_tag_{$key}",
          'label' => 'Tag',
          'name' => "gallery_item_tag_{$key}",
          'graphql_field_name' => 'tag',
          'type' => 'text',     
          'show_in_graphql' => 1,
          'required' => 0,
          'wrapper' => [
            'width' => 25
          ],
        ],                
      ],      
    ],
    [
      'key' => "field_gallery_cta_enabled_{$key}",
      'label' => 'CTA Enabled',
      'name' => "gallery_cta_enabled_{$key}",
      'graphql_field_name' => 'ctaEnabled',
      'type' => 'true_false',
      'wrapper' => [
	      'width' => 25
      ],
      'show_in_graphql' => 1,
      'default_value' => 0,
      'ui' => 1
    ],
    [
      'key' => "field_gallery_cta_link_{$key}",
      'label' => 'CTA Link',
      'name' => 'cta_link',
      'graphql_field_name' => "ctaLink",
      'type' => 'link',	 
      'show_in_graphql' => 1,
      'return_format' => 'array',
      'wrapper' => [
	      'width' => 25
      ],
      'conditional_logic' => [
        [
          [
            'field' => "field_gallery_cta_enabled_{$key}",
            'operator' => '==',
            'value' => '1'
          ],
        ],
      ],
    ],                                
    [
      'key' => "field_gallery_content_end_{$key}",
      'label' => 'Content End',
      'type' => 'accordion',
      'endpoint' => 1,
    ],    
  ];

  $config = array_merge($config, [
    [
      'key' => "field_gallery_style_accordion_{$key}",
      'label' => 'Style',
      'type' => 'accordion',
      'open' => 0,
      'multi_expand' => 1,
    ],  
    [
      'key' => "field_gallery_image_aspect_ratio{$key}",
      'label' => 'Image Aspect Ratio',
      'name' => "image_aspect_ratio_{$key}",
      'graphql_field_name' => 'imageAspectRatio',
      'instructions' => "Applies to image items only.",
      'type' => 'select',
      'show_in_graphql' => 1,
      'choices' => [
        'box_3x2' => 'Box (3x2)',
        'native' => 'Native',        
      ],      
      'default_value' => 'box_3x2',	
      'ui' => 1,
      'return_format' => 'value',
      'wrapper' => [
        'width' => 25
      ],
      'conditional_logic' => [
        [
          [
            'field' => "field_gallery_item_type_{$key}",
            'operator' => '==',
            'value' => 'image'
          ],
        ],
      ],
    ],
    [
      'key' => "field_slide_tag_label_position_{$key}",
      'label' => 'Slide Tag Label',
      'name' => "slide_tag_label_position_{$key}",
      'graphql_field_name' => 'slideTagLabel',
      'type' => 'select',
      'show_in_graphql' => 1,
      'choices' => [
        'off' => 'Off',
        'on' => 'On'        
      ],
      'default_value' => 'off',
      'multiple' => 0,
      'ui' => 1,
      'return_format' => 'value',
      'ajax' => 0,
      'wrapper' => [
        'width' => 25
      ],
    ],    
    [
      'key' => "field_gallery_background_image_enabled_{$key}",
      'name' => "gallery_background_image_enabled_{$key}",
      'label' => 'Background Image Enabled',
      'graphql_field_name' => 'backgroundImageEnabled',      
      'type' => 'true_false',
      'instructions' => "Image is a global setting for `gallery` modules.",
      'wrapper' => [
        'width' => 25
      ],
      'show_in_graphql' => 1,
      'default_value' => 0,
      'ui' => 1
    ],     
    [
      'key' => "field_gallery_cta_size_{$key}",
      'label' => 'CTA Size',
      'name' => "cta_size_{$key}",
      'graphql_field_name' => 'ctaSize',
      'type' => 'select',
      'show_in_graphql' => 1,
      'choices' => [
        'regular' => 'Regular',
        'large' => 'Large'
      ],
      'default_value' => 'regular',
      'multiple' => 0,
      'ui' => 1,
      'return_format' => 'value',
      'ajax' => 0,
      'wrapper' => [
        'width' => 25
      ],
    ],
    [
      'key' => "field_gallery_visible_on_desktop_{$key}",
      'name' => "gallery_visible_on_desktop_{$key}",
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
      'key' => "field_gallery_visible_on_mobile_{$key}",
      'name' => "gallery_visible_on_mobile_{$key}",
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
        'key' => "field_gallery_customize_layout_{$key}",
        'label' => 'Customize Theme',
        'name' => "gallery_customize_layout",
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
      'key' => "field_gallery_style_accordion_end_{$key}",
      'label' => 'Style',
      'type' => 'accordion',
      'endpoint' => 1
    ],                 
  ]);    

  return $config;
}

