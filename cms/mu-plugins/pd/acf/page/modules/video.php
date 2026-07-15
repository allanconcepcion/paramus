<?php

namespace PD\ACF\Page\Layout\Video;

function fields () {
  return [
    [
      'key' => "field_video_content_accordion",
      'label' => 'Content',
      'type' => 'accordion',
      'open' => 1,
      'multi_expand' => 1,
      'endpoint' => 0,
    ],    
    [
      'key' => "field_video_poster_image",
      'label' => 'Poster - Image',
      'name' => 'video_poster_image',
      'graphql_field_name' => 'posterImage', 
      'type' => 'image',     
      'show_in_graphql' => 1,
      'return_format' => 'array',
      'preview_size' => 'medium',
      'library' => 'all',
      'required' => 1,
      'wrapper' => [
        'width' => 50
      ]
    ],
    [
      'key' => "field_video_poster_video",
      'label' => 'Poster - Video',
      'name' => 'video_poster_video',
      'graphql_field_name' => 'posterVideo', 
      'type' => 'file',
      'mime_types' => 'mp4',
      'show_in_graphql' => 1,
      'return_format' => 'array',
      'library' => 'all',
      'wrapper' => [
        'width' => 50
      ]
    ],
    [
      'key' => "field_video_url",
      'label' => 'Video',
      'name' => 'video_url',
      'graphql_field_name' => 'url',
      'type' => 'url',
      'instructions' => '(YouTube or Vimeo Url)',	  
      'show_in_graphql' => 1,
    ],
    [
      'key' => 'field_video_title',
      'label' => 'Title',
      'name' => 'video_title',
      'graphql_field_name' => 'title', 
      'type' => 'textarea',
      'instructions' => 'Inherits `H3 Extra Bold` styling.',
      'show_in_graphql' => 1,
      'rows' => 2,      
    ],
    [
      'key' => "field_video_text_enabled",
      'name' => "video_text_enabled",
      'label' => 'Text Enabled',
      'graphql_field_name' => 'textEnabled',
      'type' => 'true_false',
      'show_in_graphql' => 1,
      'default_value' => 0,
      'ui' => 1
    ],
    [
      'key' => 'field_video_headline',
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
      'conditional_logic' => [
        [
          [
            'field' => 'field_video_text_enabled',
            'operator' => '==',
            'value' => '1'
          ],
        ],
      ],
    ],
    [
      'key' => 'field_video_body',
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
      'conditional_logic' => [
        [
          [
            'field' => 'field_video_text_enabled',
            'operator' => '==',
            'value' => '1'
          ],
        ],
      ],
    ],    
    [
      'key' => "field_video_content_accordion_end",
      'label' => 'Content End',
      'type' => 'accordion',
      'endpoint' => 1,
    ],
    [
      'key' => "field_video_style_accordion",
      'label' => 'Style',
      'type' => 'accordion',
      'open' => 1,
      'multi_expand' => 1,
      'endpoint' => 0,
    ],
    [
      'key' => "field_video_style_container",
      'name' => "video_style_container",
      'label' => 'Video Container',
      'graphql_field_name' => 'videoContainer',
      'type' => 'group',
      'show_in_graphql' => 1,
      'layout' => 'block',
      'sub_fields' => [
        [
          'key' => 'field_video_container_format',
          'label' => 'Format',
          'name' => 'video_container_format',
          'graphql_field_name' => 'format',
          'type' => 'select',
          'show_in_graphql' => 1,
          'choices' => [
            'fullBleed' => 'Full Bleed',
            'contained' => 'Contained',
          ],
          'default_value' => 'fullBleed',
          'multiple' => 0,
          'ui' => 0,
          'return_format' => 'value',
          'ajax' => 0,
          'wrapper' => [
            'width' => 25
          ]
        ],        
      ]
    ],
    [
      'key' => "field_video_style_colors",
      'name' => "video_style_colors",
      'label' => 'Colors',
      'graphql_field_name' => 'colors',
      'type' => 'group',
      'show_in_graphql' => 1,
      'layout' => 'block',
      'sub_fields' => [
        [
          'key' => "field_video_text_color",
          'label' => 'Headline Color',
          'name' => "video_text_color",
          'graphql_field_name' => 'color',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 20
          ],
        ],
        [
          'key' => "field_video_text_color_bold",
          'label' => 'Headline Color (Bold)',
          'name' => "video_text_color_bold",
          'graphql_field_name' => 'colorBold',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 20
          ],
        ],
        [
          'key' => "field_video_body_color",
          'label' => 'Body Color',
          'name' => "video_body_color",
          'graphql_field_name' => 'bodyColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 20
          ],
        ],
        [
          'key' => "field_video_background_color",
          'label' => 'Background Color',
          'name' => "video_background_color",
          'graphql_field_name' => 'backgroundColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 20
          ],
        ],
        [
          'key' => 'field_video_gradient_overlay_color',
          'label' => 'Overlay Gradient Color',
          'graphql_field_name' => 'gradientColor',
          'name' => 'color',
          'type' => 'color_picker',
          'wrapper' => [
            'width' => 20,
          ],
      	  'show_in_graphql' => 1,
          'default_value' => 'rgba(0,0,0,.6)',
          'enable_opacity' => 1,
          'return_format' => 'string',
	      ],
      ]
    ],    
    [
      'key' => "field_video_style_accordion_end",
      'label' => 'Content End',
      'type' => 'accordion',
      'endpoint' => 1,
    ],
  ];
}
