<?php

namespace PD\ACF\Menus\Main;

function init () {
  acf_add_local_field_group([
    'key' => 'group_main_menu',
    'title' => 'Main Menu',
    'fields' => [
      array(
        'key' => 'field_main_menu_featured_image',
        'label' => 'Featured Image',
        'name' => 'featured_image',
        'aria-label' => '',
        'type' => 'image',
        'instructions' => '',
        'required' => 0,
        'conditional_logic' => 0,
        'wrapper' => [
          'width' => '',        
        ],
        'show_in_graphql' => 1,
        'return_format' => 'array',
        'library' => 'all',        
        'preview_size' => 'original',
      ),
    ],
    'location' => array(
      array(
        array(
          'param' => 'nav_menu_item',
          'operator' => '==',
          'value' => 'location/main',
        ),
      ),
    ),
    'menu_order' => 0,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'active' => true,  
    'show_in_graphql' => 1,
    'graphql_field_name' => 'mainMenu',
  
  ]);
}

add_action('acf/init', __NAMESPACE__ . '\\init');