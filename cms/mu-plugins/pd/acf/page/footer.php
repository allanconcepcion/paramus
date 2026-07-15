<?php

namespace PD\ACF\Page\Footer;

use function PD\ACF\Utils\acf_cta_icon_fields;
use function PD\ACF\Utils\acf_footer_ctas_fields;

function init () {
  acf_add_local_field_group([
    'key' => 'group_page_footer',
    'title' => 'Footer',
    'fields' => [
      ...acf_footer_ctas_fields()
    ],
    'location' => [
      [
	[
	  'param' => 'post_type',
	  'operator' => '==',
	  'value' => 'page',
	],
      ],
    ],
    'menu_order' => 4,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => [
      0 => 'the_content',
    ],
    'active' => true,
    'show_in_rest' => 0,
    'show_in_graphql' => 1,
    'graphql_field_name' => 'pageFooter',
    'map_graphql_types_from_location_rules' => 0,
    'graphql_types' => '',
  ]);
}

add_action('acf/init', __NAMESPACE__ . '\\init');

