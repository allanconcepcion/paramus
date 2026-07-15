<?php

namespace PD\ACF\Page\Layout\Text;

function fields () {
  return [
    [
      'key' => 'field_text_content',
      'label' => 'Content',
      'type' => 'accordion',
      'open' => 1,
      'multi_expand' => 1,
      'endpoint' => 0,
    ],
    [
      'key' => 'field_text_eyebrow_enabled',
      'label' => 'Eyebrow Enabled',
      'name' => 'eyebrow_enabled',
      'type' => 'true_false',
      'wrapper' => [
	      'width' => 25
      ],
      'show_in_graphql' => 1,
      'default_value' => 0,
      'ui' => 1
    ],    
    [
      'key' => 'field_text_eyebrow',
      'label' => 'Eyebrow',
      'name' => 'eyebrow',
      'type' => 'text',
      'show_in_graphql' => 1,
      'conditional_logic' => [
        [
          [
            'field' => 'field_text_eyebrow_enabled',
            'operator' => '==',
            'value' => '1'
          ],
        ],
      ],
    ],
    [
      'key' => 'field_text_eyebrow_tag',
      'label' => 'Eyebrow Tag',
      'name' => 'eyebrow_tag',
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
            'field' => 'field_text_eyebrow_enabled',
            'operator' => '==',
            'value' => '1'
          ],
        ],
      ],
    ],
    [
      'key' => 'field_text_headline',
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
      'key' => 'field_text_headline_tag',
      'label' => 'Headline Tag',
      'name' => 'headline_tag',
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
      'key' => 'field_text_body',
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
    ],
    [
      'key' => 'field_text_cta_enabled',
      'label' => 'CTA Enabled',
      'name' => 'cta_enabled',
      'type' => 'true_false',
      'wrapper' => [
	      'width' => 25
      ],
      'show_in_graphql' => 1,
      'default_value' => 0,
      'ui' => 1
    ],
    [
      'key' => 'field_text_cta',
      'label' => 'CTA',
      'name' => 'cta',
      'graphql_field_name' => 'textCta',
      'type' => 'link',
      'wrapper' => [
	      'width' => '50'
      ],
      'conditional_logic' => [
        [
          [
            'field' => 'field_text_cta_enabled',
            'operator' => '==',
            'value' => '1'
          ],
        ],
      ],
      'show_in_graphql' => 1,
      'return_format' => 'array',
    ],
    [
      'key' => "field_text_style_accordion",
      'label' => 'Style',
      'type' => 'accordion',
      'open' => 0,
      'multi_expand' => 1,
    ],
    [
      'key' => "field_text_background_image_enabled",
      'name' => "text_background_image_enabled",
      'label' => 'Background Image Enabled',
      'graphql_field_name' => 'backgroundImageEnabled',      
      'type' => 'true_false',
      'instructions' => "Image is a global setting for `text` modules.",
      'wrapper' => [
	      'width' => 100
      ],
      'show_in_graphql' => 1,
      'default_value' => 0,
      'ui' => 1
    ], 
    [
      'key' => "field_text_visible_on_desktop",
      'name' => "text_visible_on_desktop",
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
      'key' => "field_text_visible_on_mobile",
      'name' => "text_visible_on_mobile",
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
      'key' => "field_text_style_accordion_end",
      'label' => 'Style',
      'type' => 'accordion',
      'endpoint' => 1
    ],
  ];
}
