<?php

namespace PD\ACF\Page\Layout\CardCarousel;

function fields () {
  return [
    [
      'key' => "field_card_carousel_content",
      'label' => 'Content',
      'type' => 'accordion',
      'open' => 1,
      'multi_expand' => 1,
      'endpoint' => 0,
    ],
    [
      'key' => "field_card_carousel_eyebrow_enabled",
      'label' => 'Eyebrow Enabled',
      'name' => "card_carousel_eyebrow_enabled",
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
      'key' => "field_card_carousel_eyebrow",
      'label' => 'Eyebrow',
      'name' => "card_carousel_eyebrow",
      'graphql_field_name' => 'eyebrow',
      'type' => 'text',
      'show_in_graphql' => 1,
      'conditional_logic' => [
        [
          [
            'field' => "field_card_carousel_eyebrow_enabled",
            'operator' => '==',
            'value' => '1'
          ],
        ],
      ],
    ],
    [
      'key' => "field_card_carousel_eyebrow_tag",
      'label' => 'Eyebrow Tag',
      'name' => "card_carousel_eyebrow_tag",
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
            'field' => "field_card_carousel_eyebrow_enabled",
            'operator' => '==',
            'value' => '1'
          ],
        ],
      ],
    ],  
    [
      'key' => "field_card_carousel_headline",
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
      'key' => "field_card_carousel_headline_tag",
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
      'key' => "field_card_carousel_body",
      'label' => 'Body',
      'name' => "card_carousel_body",
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
      'key' => "field_card_carousel_cards",
      'label' => 'Cards',
      'name' => "card_carousel_cards",
      'graphql_field_name' => "cards",
      'type' => 'repeater',
      'show_in_graphql' => 1,
      'layout' => 'table',
      'required' => 1,
      'button_label' => 'Add Card',
      'min' => 3,
      'sub_fields' => [        
        [
          'key' => "field_card_carousel_card_image",
          'label' => 'Image',
          'name' => "card_carousel_card_image",
          'graphql_field_name' => 'image',
          'type' => 'image',     
          'show_in_graphql' => 1,
          'return_format' => 'array',
          'preview_size' => 'medium',
          'library' => 'all',
          'required' => 1,
        ],
        [
          'key' => "field_card_carousel_card_title",
          'label' => 'Title',
          'name' => "cards_card_carousel_title",
          'graphql_field_name' => 'title',
          'type' => 'text',
          'show_in_graphql' => 1,
          'required' => 1,
        ],
        [
	        'key' => "field_card_carousel_card_body",
	        'label' => 'Body',
	        'name' => "card_carousel_card_body",
          'graphql_field_name' => 'body',
	        'type' => 'textarea',
	        'show_in_graphql' => 1,
          'rows' => 3
        ],
        [
          'key' => "field_card_carousel_card_cta_link",
          'label' => 'CTA Link',
          'name' => "card_carousel_card_cta_link",
          'graphql_field_name' => 'ctaLink',
          'type' => 'link',	 
          'show_in_graphql' => 1,
          'return_format' => 'array'
        ],                            
      ],             
    ],
    [
      'key' => "field_card_carousel_slides_to_show_desktop",
      'label' => 'Slides To Show - Desktop',
      'name' => "card_carousel_slides_to_show_desktop",
      'graphql_field_name' => 'slidesToShowDesktop',
      'type' => 'select',
      'show_in_graphql' => 1,
      'choices' => [
        '1' => '1',
        '2' => '2'          
      ],
      'default_value' => '2',
      'multiple' => 0,
      'ui' => 0,
      'return_format' => 'value',
      'ajax' => 0,
      'wrapper' => [
	      'width' => 25
      ],
    ],
    [
      'key' => "field_card_carousel_content_end",
      'label' => 'Content End',
      'type' => 'accordion',
      'endpoint' => 1,
    ],
    [
      'key' => "field_card_carousel_style_accordion",
      'label' => 'Style',
      'type' => 'accordion',
      'open' => 0,
      'multi_expand' => 1,
    ],  
    [
      'key' => "field_card_carousel_background_image_enabled",
      'name' => "card_carousel_background_image_enabled",
      'label' => 'Background Image Enabled',
      'graphql_field_name' => 'backgroundImageEnabled',      
      'type' => 'true_false',
      'instructions' => "Image is a global setting for `card carousel` modules.",
      'wrapper' => [
        'width' => 100
      ],
      'show_in_graphql' => 1,
      'default_value' => 0,
      'ui' => 1
    ],     
    [
      'key' => "field_card_visible_on_desktop",
      'name' => "card_visible_on_desktop",
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
      'key' => "field_card_visible_on_mobile",
      'name' => "card_visible_on_mobile",
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
      'key' => "field_card_carousel_customize_layout",
      'label' => 'Customize Theme',
      'name' => "card_carousel_customize_layout",
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
    [
      'key' => "field_card_carousel_style_accordion_end",
      'label' => 'Style',
      'type' => 'accordion',
      'endpoint' => 1
    ],
  ];
}
