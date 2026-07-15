<?php

namespace PD\ACF\Customize\Components\Video;

function fields () {
  return [
    [
      'key' => 'field_components_video_accordion',
      'label' => 'Video',
      'type' => 'accordion',
      'open' => 0,
      'multi_expand' => 1,
      'show_in_graphql' => 1,
    ],
    [
      'key' => 'field_components_video_group',
      'name' => 'video',
      'type' => 'group',
      'show_in_graphql' => 1,
      'layout' => 'block',
      'sub_fields' => [
        [
          'key' => 'field_components_video_play_button_tab',
          'label' => 'Play Button',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => 'field_components_video_play_button_style_accordion',
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
          'key' => "field_components_video_play_button_accent_color",
          'label' => 'Accent Color',
          'name' => "components_video_play_button_accent_color",
          'graphql_field_name' => 'accentColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 25
          ],
        ],                
        [
          'key' => 'field_modules_video_play_button_style_accordion_end',
          'label' => 'Accordion End',
          'type' => 'accordion',
          'endpoint' => 1,            
        ],
      ]
    ], 
  ];
}
