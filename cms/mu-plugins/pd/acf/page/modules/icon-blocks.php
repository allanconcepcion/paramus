<?php

namespace PD\ACF\Page\Layout\IconBlocks;

use function PD\ACF\Utils\acf_svg_icon_field;

function fields () {
  return [
    [
      'key' => 'field_icon_blocks_content',
      'label' => 'Content',
      'type' => 'accordion',
      'open' => 1,
      'multi_expand' => 1,
      'endpoint' => 0,
    ],
    [
      'key' => "field_icon_blocks_grid_size",
      'label' => 'Grid Size',
      'name' => "icon_blocks_grid_size",
      'graphql_field_name' => 'gridSize',
      'type' => 'select',
      'choices' => [
        '3x' => '3x', 
        '4x' => '4x'
      ],
      'instructions' => 'Effects desktop+',
      'show_in_graphql' => 1,
      'ui' => 1,
      'wrapper' => [
	      'width' => '25',
	    ],
    ],        
    [
      'key' => 'field_icon_blocks_blocks',
      'name' => 'icon_blocks',
      'graphql_field_name' => 'iconBlocks',
      'type' => 'repeater',
      'show_in_graphql' => 1,
      'layout' => 'block',
      'button_label' => 'Add block',
      'sub_fields' => [
        ...acf_svg_icon_field([
          'key' => "field_icon_blocks_icon",
          'label' => 'Icon',
          'name' => 'icon_blocks_icon',
          'graphql_field_name' => 'icon',
          'required' => 1,
        ]),
        [
          'key' => "field_icon_blocks_icon_color",
          'label' => 'Icon Color',
          'name' => "icon_blocks_icon_color",
          'graphql_field_name' => 'iconColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
        ],        
        [
	        'key' => 'field_icon_blocks_label',
          'label' => 'Label',
          'name' => 'label',
          'type' => 'text',
          'required' => 1,
	        'show_in_graphql' => 1,
      	],
        [
          'key' => 'field_icon_blocks_body',
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
          'wrapper' => [
	          'class' => 'wysiwyg-short'
          ],
        ],
      ],
    ],     
    [
      'key' => "field_icon_block_style_accordion",
      'label' => 'Style',
      'type' => 'accordion',
      'open' => 0,
      'multi_expand' => 1,
    ],
    [
      'key' => "field_icon_block_background_image_enabled",
      'name' => "icon_block_background_image_enabled",
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
      'key' => "field_icon_blocks_visible_on_desktop",
      'name' => "icon_blocks_visible_on_desktop",
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
      'key' => "field_icon_blocks_visible_on_mobile",
      'name' => "icon_blocks_visible_on_mobile",
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
      'key' => "field_icon_block_style_accordion_end",
      'label' => 'Style',
      'type' => 'accordion',
      'endpoint' => 1
    ],
  ];
}
