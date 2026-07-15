<?php

namespace PD\ACF\Page\Layout\VideoCarousel;

function fields ( $key ) {
  $config = [
    [
      'key' => "field_video_carousel_content_{$key}",
      'label' => 'Content',
      'type' => 'accordion',
      'open' => 1,
      'multi_expand' => 1,
      'endpoint' => 0,
    ],
    [
      'key' => "field_video_carousel_eyebrow_enabled_{$key}",
      'label' => 'Eyebrow Enabled',
      'name' => "video_carousel_eyebrow_enabled_{$key}",
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
      'key' => "field_video_carousel_eyebrow_{$key}",
      'label' => 'Eyebrow',
      'name' => "video_carousel_eyebrow_{$key}",
      'graphql_field_name' => 'eyebrow',
      'type' => 'text',
      'show_in_graphql' => 1,
      'conditional_logic' => [
        [
          [
            'field' => "field_video_carousel_eyebrow_enabled_{$key}",
            'operator' => '==',
            'value' => '1'
          ],
        ],
      ],
    ],
    [
      'key' => "field_video_carousel_eyebrow_tag_{$key}",
      'label' => 'Eyebrow Tag',
      'name' => "video_carousel_eyebrow_tag_{$key}",
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
            'field' => "field_video_carousel_eyebrow_enabled_{$key}",
            'operator' => '==',
            'value' => '1'
          ],
        ],
      ],
    ],
    [
      'key' => "field_video_carousel_headline_{$key}",
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
      'required' => 1,
    ],
    [
      'key' => "field_video_carousel_headline_tag_{$key}",
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
      'key' => "field_video_carousel_items_{$key}",
      'label' => 'Videos',
      'name' => 'video_carousel_videos',
      'graphql_field_name' => "videos",
      'type' => 'repeater',
      'show_in_graphql' => 1,
      'layout' => 'table',
      'required' => 1,
      'button_label' => 'Add video',
      'sub_fields' => [        
        [
          'key' => "field_video_carousel_video_poster_image_{$key}",
          'label' => 'Poster - Image',
          'name' => 'poster_image',
          'type' => 'image',     
          'show_in_graphql' => 1,
          'return_format' => 'array',
          'preview_size' => 'medium',
          'library' => 'all',
          'required' => 1,
        ],
        [
          'key' => "field_video_carousel_video_poster_video_{$key}",
          'label' => 'Poster - Video',
          'name' => 'poster_video',
          'type' => 'file',
          'mime_types' => 'mp4',
          'show_in_graphql' => 1,
          'return_format' => 'array',
          'library' => 'all',
        ],
        [
          'key' => "field_video_carousel_video_url_{$key}",
          'label' => 'Video',
          'name' => 'video_url',        
          'type' => 'url',
          'instructions' => '(YouTube or Vimeo Url)',	  
          'show_in_graphql' => 1,
          'required' => 1,
        ],
        [
          'key' => "field_video_carousel_video_title_{$key}",
          'label' => 'Title',
          'name' => 'video_title',
          'type' => 'text',
          'show_in_graphql' => 1,
        ],        
        [
          'key' => "field_video_carousel_video_background_opacity_{$key}",
          'label' => 'Background Overlay Opacity',
          'name' => "video_carousel_video_background_opacity_{$key}",
          'graphql_field_name' => 'backgroundOverlayOpacity',
          'type' => 'range',          
          'show_in_graphql' => 1,
          'default_value' => 50,
          'min' => 0,
          'max' => 100,
        ],                              
      ],      
    ],    
    [
      'key' => "field_video_carousel_cta_enabled_{$key}",
      'label' => 'CTA Enabled',
      'name' => "video_carousel_cta_enabled_{$key}",
      'graphql_field_name' => "ctaEnabled",
      'type' => 'true_false',
      'wrapper' => [
	      'width' => 25
      ],
      'show_in_graphql' => 1,
      'default_value' => 0,
      'ui' => 1
    ],
    [
      'key' => "field_video_carousel_cta_link_{$key}",
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
            'field' => "field_video_carousel_cta_enabled_{$key}",
            'operator' => '==',
            'value' => '1'
          ],
        ],
      ],
    ],     
    [
      'key' => "field_video_carousel_social_links_enabled_{$key}",
      'label' => 'Social Links Enabled',
      'name' => "video_carousel_social_links_enabled",
      'graphql_field_name' => 'socialLinksEnabled',
      'type' => 'true_false',
      'wrapper' => [
        'width' => 25
      ],
      'show_in_graphql' => 1,
      'default_value' => 0,
      'ui' => 1
    ],                       
    [
      'key' => "field_video_carousel_social_links_eyebrow_{$key}",
      'label' => 'Eyebrow',
      'name' => "video_carousel_eyebrow_{$key}",
      'graphql_field_name' => 'socialLinksEyebrow',
      'type' => 'text',
      'wrapper' => [
        'width' => 25
      ],
      'show_in_graphql' => 1,
      'conditional_logic' => [
        [
          [
            'field' => "field_video_carousel_social_links_enabled_{$key}",
            'operator' => '==',
            'value' => '1'
          ],
        ],
      ],
    ],
    [
      'key' => "field_video_carousel_content_end_{$key}",
      'label' => 'Content End',
      'type' => 'accordion',
      'endpoint' => 1,
    ],
    [
      'key' => "field_video_carousel_style_accordion_{$key}",
      'label' => 'Style',
      'type' => 'accordion',
      'open' => 0,
      'multi_expand' => 1,
    ],        
    [
      'key' => "field_video_carousel_background_image_enabled_{$key}",
      'name' => "video_carousel_background_image_enabled_{$key}",
      'label' => 'Background Image Enabled',
      'graphql_field_name' => 'backgroundImageEnabled',      
      'type' => 'true_false',
      'instructions' => "Image is a global setting for `video carousel {$key}` modules.",
      'wrapper' => [
	      'width' => 25
      ],
      'show_in_graphql' => 1,
      'default_value' => 0,
      'ui' => 1
    ],      
    [
      'key' => "field_video_carousel_carousel_layout_desktop_${key}",
      'label' => 'Carousel Layout - Desktop',
      'name' => 'video_carousel_carousel_layout_desktop',
      'graphql_field_name' => 'carouselLayoutDesktop',
      'type' => 'select',
      'show_in_graphql' => 1,
      'ui' => 1,
      'choices' => [    
        '50:50' => '50/50',
        '70:30' => '70/30',        
      ], 
      'wrapper' => [
        'width' => 25,	  
      ],
    ], 
    [
      'key' => "field_video_carousel_carousel_position_desktop_${key}",
      'label' => 'Carousel Position - Desktop',
      'name' => 'video_carousel_carousel_position_desktop',
      'graphql_field_name' => 'carouselPositionDesktop',
      'type' => 'select',
      'show_in_graphql' => 1,
      'ui' => 1,
      'choices' => [    
        'right' => 'Right',
        'left' => 'Left',        
      ], 
      'wrapper' => [
        'width' => 25,	  
      ],
    ], 
    [
      'key' => "field_video_carousel_slides_to_show_desktop${key}",
      'label' => 'Slides to Show - Desktop',
      'name' => 'field_video_carousel_slides_to_show',
      'graphql_field_name' => 'slidesToShowDesktop',
      'type' => 'select',
      'show_in_graphql' => 1,
      'ui' => 1,
      'default_value' => '1',
      'choices' => [    
        '1' => '1',
        '2' => '2',
      ], 
      'wrapper' => [
        'width' => 25,	  
      ],
    ],         
    [
      'key' => "field_video_carousel_visible_on_desktop_${key}",
      'name' => "video_carousel_visible_on_desktop_${key}",
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
      'key' => "field_video_carousel_visible_on_mobile_${key}",
      'name' => "video_carousel_visible_on_mobile_${key}",
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
      'key' => "field_video_carousel_customize_layout",
      'label' => 'Customize Theme',
      'name' => "video_carousel_customize_layout",
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
        'b' => 'B'        
      ], 
      'default_value' => 'a'
    ] : null,  
    [
      'key' => "field_video_carousel_style_accordion_end_{$key}",
      'label' => 'Style',
      'type' => 'accordion',
      'endpoint' => 1
    ],
  ];
  
  return $config;
}