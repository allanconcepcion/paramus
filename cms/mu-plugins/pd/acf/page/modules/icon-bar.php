<?php

namespace PD\ACF\Page\Layout\IconBar;

function fields () {
  return [
    [
      'key' => 'field_icon_bar_content',
      'label' => 'Content',
      'type' => 'accordion',
      'open' => 1,
      'multi_expand' => 1,
      'endpoint' => 0,
    ],    
    [
      'key' => 'field_icon_bar_blocks',
      'name' => 'icon_var_block_blocks',
      'graphql_field_name' => 'blocks',
      'type' => 'repeater',
      'show_in_graphql' => 1,
      'layout' => 'block',
      'button_label' => 'Add block',
      'sub_fields' => [                        
        [
          'key' => 'field_icon_bar_blocks_icon',
			    'label' => 'Icon (Class)',
			    'name' => 'icon',
          'placeholder' => 'e.g., fa-light fa-award',
			    'type' => 'text',
			    'instructions' => 'All Font Awesome Pro 6 classes supported',
			    'required' => 0,			    		
			    'show_in_graphql' => 1,			    			    
        ],
        [
	        'key' => 'field_icon_bar_blocks_headline',
          'label' => 'Headline',
          'name' => 'headline',
          'type' => 'text',
          'required' => 0,
	        'show_in_graphql' => 1,
      	],
        [
          'key' => 'field_icon_bar_blocks_body',
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
        [
          'key' => 'field_icon_bar_blocks_text_color',
          'label' => 'Text Color',
          'name' => 'text_color',
          'type' => 'color_picker',
          'required' => 1,
          'wrapper' => [
            'width' => '50',
          ],
          'show_in_graphql' => 1,
          'enable_opacity' => 1,
          'return_format' => 'string',
        ],
        [
          'key' => 'field_icon_bar_blocks_background_color',
          'label' => 'Background Color',
          'name' => 'background_color',
          'type' => 'color_picker',
          'required' => 1,
          'wrapper' => [
            'width' => '50',
          ],
          'show_in_graphql' => 1,
          'enable_opacity' => 1,
          'return_format' => 'string',
        ],
      ],
    ],  
    [
      'key' => "field_icon_bar_style_accordion",
      'label' => 'Style',
      'type' => 'accordion',
      'open' => 0,
      'multi_expand' => 1,
    ],
    [
      'key' => "field_icon_bar_visible_on_desktop",
      'name' => "icon_bar_visible_on_desktop",
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
      'key' => "field_icon_bar_visible_on_mobile",
      'name' => "icon_bar_visible_on_mobile",
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
      'key' => "field_icon_bar_style_accordion_end",
      'label' => 'Style',
      'type' => 'accordion',
      'endpoint' => 1
    ],                   
  ];
}
