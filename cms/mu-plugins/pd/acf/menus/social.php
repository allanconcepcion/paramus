<?php

namespace PD\ACF\Menus\Social;

function init () {
  acf_add_local_field_group([
    'key' => 'group_social_menu',
    'title' => 'Social Menu',
    'location' => [
      [
        [
          'param' => 'nav_menu_item',
	        'operator' => '==',
      	  'value' => 'location/social',
        ],
      ],
    ],
    'menu_order' => 2,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'hide_on_screen' => '',
    'active' => true,
    'description' => '',
    'show_in_graphql' => 1,
    'graphql_field_name' => 'socialMenu',
    'map_graphql_types_from_location_rules' => 0,
    'graphql_types' => '',
    'fields' => [
      [
	      'key' => 'field_social_menu_icon',
      	'label' => 'Icon',
	      'name' => 'socialsocial_menu_icon',
        'graphql_field_name' => 'icon',
      	'type' => 'select',
	      'show_in_graphql' => 1,
        'ui' => 1,
        'choices' => [
          'facebook' => 'Facebook',
          'instagram' => 'Instagram',
          'tiktok' => 'TikTok',
          'twitter' => 'Twitter',          
          'linkedin' => 'Linkedin',          
          'youtube' => 'YouTube',
          'pinterest' => 'Pinterest',
          'vimeo' => 'Vimeo',          
          'google' => 'Google',
          'tumblr' => 'Tumblr',
          'spotify' => 'Spotify', 
          'yelp' => 'Yelp'
        ]
      ],
    ],    
  ]);   
}

add_action('acf/init', __NAMESPACE__ . '\\init');
