<?php

namespace PD\ACF\Customize\Components\VideoModal;

function fields () {
  return [
    [
      'key' => 'field_components_video_modal_accordion',
      'label' => 'Video Modal',
      'type' => 'accordion',
      'open' => 0,
      'multi_expand' => 1,
      'show_in_graphql' => 1,
    ],
    [
      'key' => 'field_components_video_modal_group',
      'name' => 'video_modal',
      'type' => 'group',
      'show_in_graphql' => 1,
      'layout' => 'block',
      'sub_fields' => [
        [
          'key' => 'field_components_video_modal_buttons_tab',
          'label' => 'Buttons',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => 'field_components_video_modal_buttons_style_accordion',
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
          'key' => "field_components_video_modal_buttons_close_color",
          'label' => 'Close Color',
          'name' => "components_video_modal_buttons_close_color",
          'graphql_field_name' => 'closeColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 25
          ],
        ],                
        [
          'key' => 'field_modules_video_modal_buttons_style_accordion_end',
          'label' => 'Accordion End',
          'type' => 'accordion',
          'endpoint' => 1,            
        ],
      ]
    ], 
  ];
}
