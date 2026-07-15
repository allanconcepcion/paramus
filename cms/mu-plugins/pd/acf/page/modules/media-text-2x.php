<?php

namespace PD\ACF\Page\Layout\MediaText2x;

function fields ( $key ) {
  $config = [
    [
      'key' => "field_media_text_2x_content_{$key}",
      'label' => 'Content',
      'type' => 'accordion',
      'open' => 1,
      'multi_expand' => 1,
      'endpoint' => 0,
    ],
    [
      'key' => "field_media_text_2x_row_a_{$key}",
      'name' => "media_text_2x_row_a_{$key}",
      'graphql_field_name' => "rowA",
      'label' => 'Row A',
      'type' => 'group',
      'show_in_graphql' => 1,
      'layout' => 'block',
      'sub_fields' => [
        [
          'key' => "field_media_text_text_2x_media_type_a_{$key}",
          'label' => 'Media Type',
          'name' => "field_media_text_text_2x_media_type_a_{$key}",
          'graphql_field_name' => 'mediaType',
          'type' => 'select',
          'show_in_graphql' => 1,
          'choices' => [
            'imageVideo' => 'Image/Video',
            'iframeEmbed' => 'Iframe Embed',
          ],
          'default_value' => 'imageVideo',
          'ui' => 1,
          'return_format' => 'value',
          'wrapper' => [
	          'width' => 100
          ],
        ],
        [
          'key' => "field_media_text_2x_image_a_{$key}",
          'name' => "media_text_2x_image_a_{$key}",
          'label' => 'Image',
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
                'field' => "field_media_text_text_2x_media_type_a_{$key}",
                'operator' => '==',
                'value' => 'imageVideo'
              ],
            ],
          ],
        ],
        [
          'key' => "field_media_text_video_a_{$key}",
          'name' => "media_text_2x_video_a_{$key}",
          'label' => 'Video',
          'graphql_field_name' => 'video',
          'type' => 'file',
          'mime_types' => 'mp4',
          'show_in_graphql' => 1,
          'return_format' => 'array',
          'library' => 'all',
          'wrapper' => [
            'width' => 50
          ],
          'conditional_logic' => [
            [
              [
                'field' => "field_media_text_text_2x_media_type_a_{$key}",
                'operator' => '==',
                'value' => 'imageVideo'
              ],
            ],
          ],
        ],
        [
          'key' => "field_media_text_iframe_embed_a_{$key}",
          'label' => 'Iframe Embed',
          'name' => "field_media_text_iframe_embed_a_{$key}",
          'graphql_field_name' => 'iframeEmbed',        
          'type' => 'textarea',
          'instructions' => 'HTML embed code',
          'required' => 1,          
          'show_in_graphql' => 1,
          'rows' => 4, 
          'conditional_logic' => [
            [
              [
                'field' => "field_media_text_text_2x_media_type_a_{$key}",
                'operator' => '==',
                'value' => 'iframeEmbed'
              ],
            ],
          ],
        ],
        [
          'key' => "field_media_text_2x_eyebrow_enabled_a_{$key}",
          'label' => 'Eyebrow Enabled',
          'name' => "media_text_2x_eyebrow_enabled_a_{$key}",
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
          'key' => "field_media_text_2x_eyebrow_a_{$key}",
          'label' => 'Eyebrow',
          'name' => "media_text_2x_eyebrow_a_{$key}",
          'graphql_field_name' => 'eyebrow',
          'type' => 'text',
          'show_in_graphql' => 1,
          'conditional_logic' => [
            [
              [
                'field' => "field_media_text_2x_eyebrow_enabled_a_{$key}",
                'operator' => '==',
                'value' => '1'
              ],
            ],
          ],
        ],
        [
          'key' => "field_media_text_2x_eyebrow_tag_a_{$key}",
          'label' => 'Eyebrow Tag',
          'name' => "media_text_2x_eyebrow_tag_a_{$key}",
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
                'field' => "field_media_text_2x_eyebrow_enabled_a_{$key}",
                'operator' => '==',
                'value' => '1'
              ],
            ],
          ],
        ],  
        [
          'key' => "field_media_text_2x_headline_a_{$key}",
          'name' => "media_text_2x_headline_a_{$key}",
          'label' => 'Headline',
          'graphql_field_name' => 'headline',
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
          'key' => "field_media_text_2x_headline_tag_a_{$key}",
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
          'key' => "field_media_text_2x_body_a_{$key}",
          'name' => "media_text_2x_body_a_{$key}",
          'label' => 'Body',
          'graphql_field_name' => 'body',
          'type' => 'wysiwyg',
          'required' => 1,
          'show_in_graphql' => 1,
          'default_value' => '',
          'tabs' => 'visual',
          'toolbar' => 'basic',
          'media_upload' => 0,
          'delay' => 0,
        ],
        [
          'key' => "field_media_text_text_2x_text_alignment_mobile_b_{$key}",
          'label' => 'Text Alignment - Mobile',
          'name' => "field_media_text_text_2x_text_alignment_mobile_b_{$key}",
          'graphql_field_name' => 'textAlignmentMobile',
          'type' => 'select',
          'show_in_graphql' => 1,
          'choices' => [
            'center' => 'Center',
            'left' => 'Left',
          ],
          'default_value' => 'center',
          'ui' => 1,
          'return_format' => 'value',
          'wrapper' => [
	          'width' => 25
          ],
        ],
      ]
    ],
    [
      'key' => "field_media_text_2x_row_b_{$key}",
      'name' => "media_text_2x_row_b_{$key}",
      'graphql_field_name' => "rowB",
      'label' => 'Row B',
      'type' => 'group',
      'show_in_graphql' => 1,
      'layout' => 'block',
      'sub_fields' => [
        [
          'key' => "field_media_text_text_2x_media_type_b_{$key}",
          'label' => 'Media Type',
          'name' => "field_media_text_text_2x_media_type_b_{$key}",
          'graphql_field_name' => 'mediaType',
          'type' => 'select',
          'show_in_graphql' => 1,
          'choices' => [
            'imageVideo' => 'Image/Video',
            'iframeEmbed' => 'Iframe Embed',
          ],
          'default_value' => 'imageVideo',
          'ui' => 1,
          'return_format' => 'value',
          'wrapper' => [
	          'width' => 100
          ],
        ],
        [
          'key' => "field_media_text_2x_image_b_{$key}",
          'name' => "media_text_2x_image_b_{$key}",
          'label' => 'Image',
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
                'field' => "field_media_text_text_2x_media_type_b_{$key}",
                'operator' => '==',
                'value' => 'imageVideo'
              ],
            ],
          ],
        ],
        [
          'key' => "field_media_text_video_b_{$key}",
          'name' => "media_text_2x_video_b_{$key}",
          'label' => 'Video',
          'graphql_field_name' => 'video',
          'type' => 'file',
          'mime_types' => 'mp4',
          'show_in_graphql' => 1,
          'return_format' => 'array',
          'library' => 'all',
          'wrapper' => [
            'width' => 50
          ],
          'conditional_logic' => [
            [
              [
                'field' => "field_media_text_text_2x_media_type_b_{$key}",
                'operator' => '==',
                'value' => 'imageVideo'
              ],
            ],
          ],
        ],
        [
          'key' => "field_media_text_iframe_embed_b_{$key}",
          'label' => 'Iframe Embed',
          'name' => "field_media_text_iframe_embed_b_{$key}",
          'graphql_field_name' => 'iframeEmbed',        
          'type' => 'textarea',
          'instructions' => 'HTML embed code',
          'required' => 1,          
          'show_in_graphql' => 1,
          'rows' => 4, 
          'conditional_logic' => [
            [
              [
                'field' => "field_media_text_text_2x_media_type_b_{$key}",
                'operator' => '==',
                'value' => 'iframeEmbed'
              ],
            ],
          ],
        ],
        [
          'key' => "field_media_text_2x_eyebrow_enabled_b_{$key}",
          'label' => 'Eyebrow Enabled',
          'name' => "media_text_2x_eyebrow_enabled_b_{$key}",
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
          'key' => "field_media_text_2x_eyebrow_b_{$key}",
          'label' => 'Eyebrow',
          'name' => "media_text_2x_eyebrow_b_{$key}",
          'graphql_field_name' => 'eyebrow',
          'type' => 'text',
          'show_in_graphql' => 1,
          'conditional_logic' => [
            [
              [
                'field' => "field_media_text_2x_eyebrow_enabled_b_{$key}",
                'operator' => '==',
                'value' => '1'
              ],
            ],
          ],
        ],
        [
          'key' => "field_media_text_2x_eyebrow_tag_b_{$key}",
          'label' => 'Eyebrow Tag',
          'name' => "media_text_2x_eyebrow_tag_b_{$key}",
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
                'field' => "field_media_text_2x_eyebrow_enabled_b_{$key}",
                'operator' => '==',
                'value' => '1'
              ],
            ],
          ],
        ],
        [
          'key' => "field_media_text_2x_headline_b_{$key}",
          'name' => "media_text_2x_headline_b_{$key}",
          'label' => 'Headline',
          'graphql_field_name' => 'headline',
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
          'key' => "field_media_text_2x_headline_tag_b_{$key}",
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
          'key' => "field_media_text_2x_body_b_{$key}",
          'name' => "media_text_2x_body_b_{$key}",
          'label' => 'Body',
          'graphql_field_name' => 'body',
          'type' => 'wysiwyg',
          'required' => 1,
          'show_in_graphql' => 1,
          'default_value' => '',
          'tabs' => 'visual',
          'toolbar' => 'basic',
          'media_upload' => 0,
          'delay' => 0,
        ],
        [
          'key' => "field_media_text_text_2x_text_alignment_mobile_b_{$key}",
          'label' => 'Text Alignment - Mobile',
          'name' => "field_media_text_text_2x_text_alignment_mobile_b_{$key}",
          'graphql_field_name' => 'textAlignmentMobile',
          'type' => 'select',
          'show_in_graphql' => 1,
          'choices' => [
            'center' => 'Center',
            'left' => 'Left',
          ],
          'default_value' => 'center',
          'ui' => 1,
          'return_format' => 'value',
          'wrapper' => [
	          'width' => 25
          ],
        ],        
      ]
    ],  
    [
      'key' => "field_media_text_2x_content_accordion_end_{$key}",
      'label' => 'Style',
      'type' => 'accordion',
      'endpoint' => 1
    ],
    [
      'key' => "field_media_text_2x_style_accordion_{$key}",
      'label' => 'Style',
      'type' => 'accordion',
      'open' => 0,
      'multi_expand' => 1,
    ],   
    [
      'key' => "field_media_text_2x_background_image_enabled_{$key}",
      'name' => "media_text_2x_background_image_enabled_{$key}",
      'label' => 'Background Image Enabled',
      'graphql_field_name' => 'backgroundImageEnabled',      
      'type' => 'true_false',
      'instructions' => "Image is a global setting for `media text 2x` modules.",
      'wrapper' => [
        'width' => 100
      ],
      'show_in_graphql' => 1,
      'default_value' => 0,
      'ui' => 1
    ],   
    [
      'key' => "field_media_text_2x_visible_on_desktop_{$key}",
      'name' => "media_text_2x_visible_on_desktop_{$key}",
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
      'key' => "field_media_text_2x_visible_on_mobile_{$key}",
      'name' => "media_text_2x_visible_on_mobile_{$key}",
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
    $key === 'a' ? [
      'key' => "field_media_text_2x_customize_layout",
      'label' => 'Customize Theme',
      'name' => "media_text_2x_customize_layout",
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
    ] : null,                    
    [
      'key' => "field_media_text_2x_style_accordion_end_{$key}",
      'label' => 'Style',
      'type' => 'accordion',
      'endpoint' => 1
    ],
  ];  

  return $config;
}
