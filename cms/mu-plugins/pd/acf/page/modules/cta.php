<?php

namespace PD\ACF\Page\Layout\Cta;

use function PD\ACF\Utils\acf_cta_icon_fields;

function fields () {
  
  return [
    [
      'key' => 'field_cta_content',
      'label' => 'Content',
      'type' => 'accordion',
      'open' => 1,
      'multi_expand' => 1,
      'endpoint' => 0,
    ],
    [
      'key' => 'field_cta_format',
      'label' => 'Format',
      'name' => 'cta_format',
      'graphql_field_name' => 'format',
      'type' => 'select',
      'show_in_graphql' => 1,
      'choices' => [
	      'mini' => 'Mini',
	      'full' => 'Full',
      ],      
      'default_value' => 'mini',	
      'ui' => 1,
      'return_format' => 'value',
      'wrapper' => [
        'width' => 25
      ],
    ],
    [
      'key' => "field_cta_image",
      'label' => 'Image',
      'name' => "cta_image",              
      'graphql_field_name' => 'image',
      'type' => 'image',
      'show_in_graphql' => 1,
      'return_format' => 'array',
      'preview_size' => 'medium',
      'library' => 'all',
      'required' => 1,
      'wrapper' => [
        'width' => 100
      ],
      'conditional_logic' => [
        [
          [
            'field' => 'field_cta_format',
            'operator' => '==',
            'value' => 'full'
          ],
        ],
      ],
    ],      
    [
      'key' => 'field_cta_headline',
      'label' => 'Headline',
      'name' => 'headline',
      'type' => 'wysiwyg',
      'required' => 1,
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
      'key' => 'field_cta_headline_tag',
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
      'key' => 'field_cta_body',
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
            'field' => 'field_cta_format',
            'operator' => '==',
            'value' => 'full'
          ],
        ],
      ],
    ],    
    [
      'key' => 'field_cta_cta',
      'label' => 'CTA',
      'name' => 'cta',
      'type' => 'link',
      'wrapper' => [
	      'width' => '50'
      ],      
      'show_in_graphql' => 1,
      'return_format' => 'array',
      'required' => 1
    ],
    [
      'key' => "field_cta_style_accordion",
      'label' => 'Style',
      'type' => 'accordion',
      'open' => 0,
      'multi_expand' => 1,
    ],    
    [
      'key' => "field_cta_style_color",
      'label' => 'Color',
      'name' => "cta_style_color",
      'graphql_field_name' => 'color',
      'type' => 'select',
      'show_in_graphql' => 1,
      'ui' => 1,
      'wrapper' => [
	      'width' => 50
      ],
    ],
    [
      'key' => "field_cta_style_background_color",
      'label' => 'Background Color',
      'name' => "cta_style_background_color",
      'graphql_field_name' => 'backgroundColor',
      'type' => 'select',
      'show_in_graphql' => 1,
      'ui' => 1,
      'wrapper' => [
	      'width' => 50
      ],
    ],
    ...acf_cta_icon_fields([
      'key' => 'field_cta',
      'name' => 'cta',
    ]),
    [
      'key' => "field_cta_visible_on_desktop",
      'name' => "cta_visible_on_desktop",
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
      'key' => "field_cta_visible_on_mobile",
      'name' => "cta_visible_on_mobile",
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
      'key' => "field_cta_style_accordion_end",
      'label' => 'Style',
      'type' => 'accordion',
      'endpoint' => 1
    ],
  ];
}
