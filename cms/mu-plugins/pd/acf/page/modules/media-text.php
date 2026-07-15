<?php

namespace PD\ACF\Page\Layout\MediaText;

function fields ( $key ) {
  return [
    [
      'key' => "field_media_text_content_{$key}",
      'label' => 'Content',
      'type' => 'accordion',
      'open' => 1,
      'multi_expand' => 1,
      'endpoint' => 0,
    ],    
    [
      'key' => "field_media_text_image_{$key}",
      'name' => "media_text_image_{$key}",
      'label' => 'Image',
      'graphql_field_name' => "image",
      'type' => 'image',     
      'show_in_graphql' => 1,
      'return_format' => 'array',
      'preview_size' => 'medium',
      'library' => 'all',
      'required' => 1,
      'wrapper' => [
        'width' => 33.33
      ],
    ],
    [
      'key' => "field_media_text_video_{$key}",
      'name' => "media_text_video_{$key}",
      'label' => 'Video',
      'graphql_field_name' => "video",
      'type' => 'file',
      'mime_types' => 'mp4',
      'show_in_graphql' => 1,
      'return_format' => 'array',
      'library' => 'all',
      'wrapper' => [
        'width' => 33.33
      ],
    ],
    [
      'key' => "field_media_text_video_url_{$key}",
      'label' => 'Video',
      'name' => "video_url_{$key}",
      'graphql_field_name' => 'videoUrl',
      'type' => 'url',
      'instructions' => '(YouTube Url)',	  
      'show_in_graphql' => 1,
      'wrapper' => [
        'width' => 33.33
      ],
    ],                    
    [
      'key' => "field_media_text_caption_enabled_{$key}",
      'name' => "media_text_caption_enabled_{$key}",
      'label' => 'Caption Enabled',
      'graphql_field_name' => 'captionEnabled',
      'type' => 'true_false',
      'show_in_graphql' => 1,
      'default_value' => 0,
      'ui' => 1
    ],        
    [
      'key' => "field_media_text_caption_{$key}",
      'label' => 'Caption',
      'name' => "media_text_caption_{$key}",
      'graphql_field_name' => 'caption',
      'type' => 'text',
      'show_in_graphql' => 1,
      'conditional_logic' => [
        [
          [
            'field' => "field_media_text_caption_enabled_{$key}",
            'operator' => '==',
            'value' => '1'
          ],
        ],
      ],
    ],    
    [
      'key' => "field_media_text_hotspots_enabled_{$key}",
      'name' => "media_text_hotspots_enabled_{$key}",
      'label' => 'Hotspots Enabled',
      'graphql_field_name' => 'hotspotsEnabled',
      'type' => 'true_false',
      'show_in_graphql' => 1,
      'default_value' => 0,
      'ui' => 1
    ],    
    [
      'key' => "field_media_text_hotspots_{$key}",
      'label' => 'Hotspots',
      'name' => "media_text_hotspots__{$key}",
      'graphql_field_name' => "hotspots",
      'type' => 'repeater',
      'conditional_logic' => [
        [
          [
            'field' => "field_media_text_hotspots_enabled_{$key}",
            'operator' => '==',
            'value' => '1'
          ],
        ],
      ],
      'show_in_graphql' => 1,
      'layout' => 'table',
      'button_label' => 'Add hotspot',
      'sub_fields' => [
        [
          'key' => "field_media_text_hotspot_label_{$key}",
          'label' => 'Label',
          'name' => "media_text_hotspot_label_{$key}",
          'graphql_field_name' => 'label',
          'type' => 'text',
          'show_in_graphql' => 1,
          'wrapper' => [
            'width' => 75
          ]
        ],
        [
          'key' => "field_media_text_hotspot_position_top_{$key}",
          'label' => 'Top',
          'name' => "media_text_hotspot_position_top_{$key}",
          'graphql_field_name' => 'positionTop',
          'type' => 'number',
          'append' => '%',
          'show_in_graphql' => 1,
        ],
        [
          'key' => "field_media_text_hotspot_position_left_{$key}",
          'label' => 'Left',
          'name' => "media_text_hotspot_position_left_{$key}",
          'graphql_field_name' => 'positionLeft',
          'type' => 'number',
          'append' => '%',
          'show_in_graphql' => 1,
        ],
      ]
    ],  
    [
      'key' => "field_media_text_eyebrow_enabled_{$key}",
      'label' => 'Eyebrow Enabled',
      'name' => "media_text_eyebrow_enabled_{$key}",
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
      'key' => "field_media_text_eyebrow_{$key}",
      'label' => 'Eyebrow',
      'name' => "media_text_eyebrow_{$key}",
      'graphql_field_name' => 'eyebrow',
      'type' => 'text',
      'show_in_graphql' => 1,
      'conditional_logic' => [
        [
          [
            'field' => "field_media_text_eyebrow_enabled_{$key}",
            'operator' => '==',
            'value' => '1'
          ],
        ],
      ],
    ],
    [
      'key' => "field_media_text_eyebrow_tag_{$key}",
      'label' => 'Eyebrow Tag',
      'name' => "media_text_eyebrow_tag_{$key}",
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
            'field' => "field_media_text_eyebrow_enabled_{$key}",
            'operator' => '==',
            'value' => '1'
          ],
        ],
      ],
    ],  
    [
      'key' => "field_media_text_headline_{$key}",
      'label' => 'Headline',
      'name' => "media_text_headline_{$key}",
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
      'key' => "field_media_text_headline_tag_{$key}",
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
      'key' => "field_media_text_body_{$key}",
      'label' => 'Body',
      'name' => "media_text_body_{$key}",
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
      'key' => "field_media_text_cta_enabled_{$key}",
      'label' => 'CTA Enabled',
      'name' => "media_text_cta_enabled_{$key}",
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
      'key' => "field_media_text_cta_{$key}",
      'label' => 'CTA',
      'name' => "media_text_cta_{$key}",
      'graphql_field_name' => "cta",
      'type' => 'link',
      'wrapper' => [
	      'width' => '50'
      ],
      'conditional_logic' => [
        [
          [
            'field' => "field_media_text_cta_enabled_{$key}",
            'operator' => '==',
            'value' => '1'
          ],
        ],
      ],
      'show_in_graphql' => 1,
      'return_format' => 'array',
    ],
    [
      'key' => "field_media_text_style_{$key}",
      'label' => 'Style',
      'type' => 'accordion',
      'open' => 0,
      'multi_expand' => 1,
    ],
    [
      'key' => "field_media_text_media_max_width_desktop_{$key}",
      'label' => 'Media Max Width - Desktop',
      'name' => "media_text_media_max_width_desktop_{$key}",
      'graphql_field_name' => 'mediaMaxWidthDesktop',
      'type' => 'range',
      'wrapper' => [
	      'width' => '50'
      ],
      'append' => '%',
      'show_in_graphql' => 1,
      'default_value' => 100,
      'min' => 10,
      'max' => 100,
    ],
    [
      'key' => "field_media_text_media_max_width_mobile_{$key}",
      'label' => 'Media Max Width - Mobile',
      'name' => "media_text_media_max_width_mobile_{$key}",
      'graphql_field_name' => 'mediaMaxWidthMobile',
      'type' => 'range',
      'wrapper' => [
	      'width' => '50'
      ],
      'append' => '%',
      'show_in_graphql' => 1,
      'default_value' => 100,
      'min' => 10,
      'max' => 100,
    ],
    [
      'key' => "field_media_text_text_max_width_desktop_{$key}",
      'label' => 'Text Max Width - Desktop',
      'name' => "media_text_text_max_width_desktop_{$key}",
      'graphql_field_name' => 'textMaxWidthDesktop',
      'type' => 'range',
      'wrapper' => [
	      'width' => '50'
      ],
      'append' => '%',
      'show_in_graphql' => 1,
      'default_value' => 100,
      'min' => 10,
      'max' => 100,
    ],
    [
      'key' => "field_media_text_text_max_width_mobile_{$key}",
      'label' => 'Text Max Width - Mobile',
      'name' => "media_text_text_max_width_mobile_{$key}",
      'graphql_field_name' => 'textMaxWidthMobile',
      'type' => 'range',
      'wrapper' => [
	      'width' => '50'
      ],
      'append' => '%',
      'show_in_graphql' => 1,
      'default_value' => 100,
      'min' => 10,
      'max' => 100,
    ],    
    [
      'key' => "field_media_text_media_position_desktop_{$key}",
      'label' => 'Media Position - Desktop',
      'name' => "media_text_media_position_desktop_{$key}",
      'graphql_field_name' => 'mediaPositionDesktop',
      'type' => 'select',
      'show_in_graphql' => 1,
      'choices' => [
        'left' => 'Left',
        'right' => 'Right',
      ],
      'default_value' => 'left',
      'ui' => 1,
      'return_format' => 'value',
      'wrapper' => [
	      'width' => 50
      ],
    ],    
    [
      'key' => "field_media_text_text_alignment_mobile_{$key}",
      'label' => 'Text Alignment - Mobile',
      'name' => "media_text_text_alignment_mobile_{$key}",
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
	      'width' => 50
      ],
    ],
    [
      'key' => "field_media_text_cta_icon_style_{$key}",
      'label' => 'CTA Icon Style',
      'name' => "media_text_cta_icon_style_{$key}",
      'graphql_field_name' => 'ctaIconStyle',
      'type' => 'select',
      'show_in_graphql' => 1,
      'choices' => [
        'default' => 'Default',
        'alt' => 'Alt',
      ],
      'default_value' => 'default',
      'ui' => 1,
      'return_format' => 'value',
      'wrapper' => [
	      'width' => 50
      ],
    ],    
    [
      'key' => "field_media_text_background_image_enabled_{$key}",
      'name' => "media_text_background_image_enabled_{$key}",
      'label' => 'Background Image Enabled',
      'graphql_field_name' => 'backgroundImageEnabled',      
      'type' => 'true_false',
      'instructions' => "Image is a global setting for `media text` modules.",
      'wrapper' => [
	      'width' => 100
      ],
      'show_in_graphql' => 1,
      'default_value' => 0,
      'ui' => 1
    ],   
    [
      'key' => "field_media_text_visible_on_desktop_{$key}",
      'name' => "media_text_visible_on_desktop_{$key}",
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
      'key' => "field_media_text_visible_on_mobile_{$key}",
      'name' => "media_text_visible_on_mobile_{$key}",
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
      'key' => "field_media_text_customize_layout",
      'label' => 'Customize Theme',
      'name' => "media_text_customize_layout",
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
  ];
}
