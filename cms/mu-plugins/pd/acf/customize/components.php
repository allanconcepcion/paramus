<?php

namespace PD\ACF\Customize\Components;

require WPMU_PLUGIN_DIR . '/pd/acf/customize/components/map.php';
require WPMU_PLUGIN_DIR . '/pd/acf/customize/components/form.php';
require WPMU_PLUGIN_DIR . '/pd/acf/customize/components/post.php';
require WPMU_PLUGIN_DIR . '/pd/acf/customize/components/pagination.php';
require WPMU_PLUGIN_DIR . '/pd/acf/customize/components/video-modal.php';
require WPMU_PLUGIN_DIR . '/pd/acf/customize/components/video.php';

use function PD\ACF\Customize\Components\Form\fields as form_fields;
use function PD\ACF\Customize\Components\Post\fields as post_fields;
use function PD\ACF\Customize\Components\Pagination\fields as pagination_fields;
use function PD\ACF\Customize\Components\VideoModal\fields as video_modal_fields;
use function PD\ACF\Customize\Components\Video\fields as video_fields;

function init () {
  acf_add_local_field_group([
    'key' => 'group_components',
    'title' => 'Components',
    'location' => [
      [
        [
          'param' => 'options_page',
          'operator' => '==',
          'value' => 'customize',
        ],
      ],
    ],
    'menu_order' => 4,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_rest' => 0,
    'show_in_graphql' => 1,
    'graphql_field_name' => 'components',
    'map_graphql_types_from_location_rules' => 0,
    'graphql_types' => '',
    'fields' => [
      ...form_fields(),
      ...post_fields(),
      ...pagination_fields(), 
      ...video_modal_fields(),
      ...video_fields()
    ]
  ]);   
}

add_action('acf/init', __NAMESPACE__ . '\\init');

