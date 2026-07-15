<?php

namespace PD\ACF\Page\Layout\VideoGallery;

function fields ( $key ) {
  return [
    [
      'key' => "field_video_gallery_content_{$key}",
      'label' => 'Content',
      'type' => 'accordion',
      'open' => 1,
      'multi_expand' => 1,
      'endpoint' => 0,
    ],
    [
      'key' => "field_video_gallery_eyebrow_enabled_{$key}",
      'label' => 'Eyebrow Enabled',
      'name' => "video_gallery_eyebrow_enabled_{$key}",
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
      'key' => "field_video_gallery_eyebrow_{$key}",
      'label' => 'Eyebrow',
      'name' => "video_gallery_eyebrow_{$key}",
      'graphql_field_name' => 'eyebrow',
      'type' => 'text',
      'show_in_graphql' => 1,
      'conditional_logic' => [
        [
          [
            'field' => "field_video_gallery_eyebrow_enabled_{$key}",
            'operator' => '==',
            'value' => '1'
          ],
        ],
      ],
    ],
    [
      'key' => "field_video_gallery_eyebrow_tag_{$key}",
      'label' => 'Eyebrow Tag',
      'name' => "video_gallery_eyebrow_tag_{$key}",
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
            'field' => "field_video_gallery_eyebrow_enabled_{$key}",
            'operator' => '==',
            'value' => '1'
          ],
        ],
      ],
    ],
    [
      'key' => "field_video_gallery_headline_{$key}",
      'label' => 'Headline',
      'name' => "video_gallery_headline_{$key}",
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
      'key' => "field_video_gallery_headline_tag_{$key}",
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
      'key' => "field_video_gallery_body_{$key}",
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
      'key' => "field_video_gallery_items_{$key}",
      'label' => 'Items',
      'name' => "video_gallery_items_{$key}",
      'graphql_field_name' => 'items',
      'type' => 'repeater',
      'show_in_graphql' => 1,
      'layout' => 'table',
      'required' => 1,
      'button_label' => 'Add Video',
      'sub_fields' => [        
        [
          'key' => "field_video_gallery_item_poster_image_{$key}",
          'label' => 'Poster - Image',
          'name' => "video_gallery_item_poster_image_{$key}",
          'graphql_field_name' => 'posterImage',
          'type' => 'image',     
          'show_in_graphql' => 1,
          'return_format' => 'array',
          'preview_size' => 'medium',
          'library' => 'all',
          'required' => 1,
        ],
        [
          'key' => "field_video_gallery_item_url_{$key}",
          'label' => 'Video',
          'name' => "video_gallery_item_url_{$key}",
          'graphql_field_name' => 'url',
          'type' => 'url',
          'instructions' => '(YouTube or Vimeo Url)',	  
          'show_in_graphql' => 1,
          'required' => 1,
        ],
        [
          'key' => "field_video_gallery_item_title_{$key}",
          'label' => 'Title',
          'name' => "video_gallery_item_title_{$key}",
          'graphql_field_name' => 'title',
          'type' => 'text',
          'show_in_graphql' => 1,
        ],        
      ],      
    ],                                      
    [
      'key' => "field_video_gallery_content_end_{$key}",
      'label' => 'Content End',
      'type' => 'accordion',
      'endpoint' => 1,
    ],
    [
      'key' => "field_video_gallery_style_accordion_{$key}",
      'label' => 'Style',
      'type' => 'accordion',
      'open' => 0,
      'multi_expand' => 1,
    ],
    [
      'key' => "field_video_gallery_background_image_enabled_{$key}",
      'name' => "video_gallery_background_image_enabled_{$key}",
      'label' => 'Background Image Enabled',
      'graphql_field_name' => 'backgroundImageEnabled',      
      'type' => 'true_false',
      'instructions' => "Image is a global setting for `icon block` modules.",
      'wrapper' => [
	      'width' => 100
      ],
      'show_in_graphql' => 1,
      'default_value' => 0,
      'ui' => 1
    ],  
    [
      'key' => "field_video_gallery_visible_on_desktop_{$key}",
      'name' => "video_gallery_visible_on_desktop_{$key}",
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
      'key' => "field_video_gallery_visible_on_mobile_{$key}",
      'name' => "video_gallery_visible_on_mobile_{$key}",
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
    [
      'key' => "field_video_gallery_style_accordion_end",
      'label' => 'Style',
      'type' => 'accordion',
      'endpoint' => 1
    ],
  ];
}
