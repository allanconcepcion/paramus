<?php

namespace PD\ACF\Page\Layout\CardTabs;

function fields () {
  return [
    [
      'key' => "field_card_tabs_content",
      'label' => 'Content',
      'type' => 'accordion',
      'open' => 1,
      'multi_expand' => 1,
      'endpoint' => 0,
    ],
    [
      'key' => "field_card_tabs_eyebrow_enabled_{$key}",
      'label' => 'Eyebrow Enabled',
      'name' => "card_tabs_eyebrow_enabled_{$key}",
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
      'key' => "field_card_tabs_eyebrow_{$key}",
      'label' => 'Eyebrow',
      'name' => "card_tabs_eyebrow_{$key}",
      'graphql_field_name' => 'eyebrow',
      'type' => 'text',
      'show_in_graphql' => 1,
      'conditional_logic' => [
        [
          [
            'field' => "field_card_tabs_eyebrow_enabled_{$key}",
            'operator' => '==',
            'value' => '1'
          ],
        ],
      ],
    ],
    [
      'key' => "field_card_tabs_eyebrow_tag_{$key}",
      'label' => 'Eyebrow Tag',
      'name' => "card_tabs_eyebrow_tag_{$key}",
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
            'field' => "field_card_tabs_eyebrow_enabled_{$key}",
            'operator' => '==',
            'value' => '1'
          ],
        ],
      ],
    ],  
    [
      'key' => "field_card_tabs_headline",
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
      'key' => "field_card_tabs_headline_tag",
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
      'key' => "field_card_tabs_body",
      'label' => 'Body',
      'name' => "card_tabs_body",
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
      'key' => "field_card_tabs_cards",
      'label' => 'Cards',
      'name' => "card_tabs_cards",
      'graphql_field_name' => "cardTabs",
      'type' => 'repeater',
      'show_in_graphql' => 1,
      'layout' => 'table',
      'required' => 1,
      'button_label' => 'Add Card',
      'sub_fields' => [        
        [
          'key' => "field_card_tabs_card_image",
          'label' => 'Image',
          'name' => "card_tabs_card_image",
          'graphql_field_name' => 'image',
          'type' => 'image',     
          'show_in_graphql' => 1,
          'return_format' => 'array',
          'preview_size' => 'medium',
          'library' => 'all',
          'required' => 1,
        ],
        [
          'key' => "field_card_tabs_card_title",
          'label' => 'Title',
          'name' => "cards_card_tabs_title",
          'graphql_field_name' => 'title',
          'type' => 'text',
          'show_in_graphql' => 1,
          'required' => 1,
        ],
        [
	        'key' => "field_card_tabs_card_body",
	        'label' => 'Body',
	        'name' => "card_tabs_card_body",
          'graphql_field_name' => 'body',
	        'type' => 'textarea',
	        'show_in_graphql' => 1,
          'rows' => 3
        ],
        [
          'key' => "field_card_tabs_card_cta_link",
          'label' => 'CTA Link',
          'name' => "card_tabs_card_cta_link",
          'graphql_field_name' => 'ctaLink',
          'type' => 'link',	 
          'show_in_graphql' => 1,
          'return_format' => 'array'
        ],                            
      ],      
    ],
    [
      'key' => "field_card_tabs_content_end",
      'label' => 'Content End',
      'type' => 'accordion',
      'endpoint' => 1,
    ],
    [
      'key' => "field_card_tabs_style_accordion",
      'label' => 'Style',
      'type' => 'accordion',
      'open' => 0,
      'multi_expand' => 1,
    ],    
    [
      'key' => "field_card_tabs_background_image_enabled",
      'name' => "card_tabs_background_image_enabled",
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
      'key' => "field_card_tabs_visible_on_desktop",
      'name' => "card_tabs_visible_on_desktop",
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
      'key' => "field_card_tabs_visible_on_mobile",
      'name' => "card_tabs_visible_on_mobile",
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
      'key' => "field_card_tabs_customize_layout",
      'label' => 'Customize Theme',
      'name' => "card_tabs_customize_layout",
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
      'key' => "field_card_tabs_style_accordion_end",
      'label' => 'Style',
      'type' => 'accordion',
      'endpoint' => 1
    ],
  ];
}          