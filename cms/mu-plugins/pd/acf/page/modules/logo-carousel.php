<?php

namespace PD\ACF\Page\Layout\LogoCarousel;

function fields () {
  return [
    [
      'key' => "field_logo_carousel_content",
      'label' => 'Content',
      'type' => 'accordion',
      'open' => 1,
      'multi_expand' => 1,
      'endpoint' => 0,
    ],
    [
      'key' => "field_logo_carousel_logos",
      'label' => 'Logos',
      'name' => 'logos',
      'type' => 'gallery',
      'show_in_graphql' => 1,
      'library' => 'all',
      'mime_types' => 'jpg,jpeg,png,gif,webp'
    ],
    [
      'key' => 'field_logo_carousel_logo_width',
      'label' => 'Logo Ratio - Width',
      'name' => 'logo_ratio_width',
      'type' => 'number',
      'show_in_graphql' => 1,
      'default_value' => 3, 
      'wrapper' => [
        'width' => 15
      ]
    ],
    [
      'key' => 'field_logo_carousel_logo_height',
      'label' => 'Logo Ratio - Height',
      'name' => 'logo_ratio_height',
      'type' => 'number',
      'show_in_graphql' => 1,
      'default_value' => 2, 
      'wrapper' => [
        'width' => 15
      ]
    ],
    [
      'key' => "field_logo_carousel_content_end",
      'label' => 'Content End',
      'type' => 'accordion',
      'endpoint' => 1,
    ],
    [
      'key' => "field_logo_carousel_style_accordion",
      'label' => 'Style',
      'type' => 'accordion',
      'open' => 0,
      'multi_expand' => 1,
    ],
    [
      'key' => 'field_logo_carousel_format',
      'label' => 'Format',
      'name' => 'format',
      'type' => 'select',
      'show_in_graphql' => 1,
      'choices' => [
        'carousel' => 'Carousel',
        'grid' => 'Grid'        
      ],
      'default_value' => 'carousel',
      'multiple' => 0,
      'ui' => 1,
      'return_format' => 'value',
      'ajax' => 0,
      'wrapper' => [
        'width' => 100
      ]
    ],
    [
      'key' => "field_logo_carousel_visible_on_desktop",
      'name' => "logo_carousel_visible_on_desktop",
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
      'key' => "field_logo_carousel_visible_on_mobile",
      'name' => "logo_carousel_visible_on_mobile",
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
      'key' => "field_logo_carousel_style_accordion_end",
      'label' => 'Style',
      'type' => 'accordion',
      'endpoint' => 1
    ],
  ];
}
