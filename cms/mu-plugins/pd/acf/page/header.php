<?php

namespace PD\ACF\Page\Header;

function init () {
    acf_add_local_field_group([
        'key' => 'group_page_header',
        'title' => 'Header',
        'fields' => [
            [
                'key' => 'field_header_logo_tab',
                'label' => 'Logo',
                'type' => 'tab',
                'show_in_graphql' => 1,
                'placement' => 'top',
                'endpoint' => 0,
            ],
            [
                'key' => 'field_page_header_override_logo',
                'label' => 'Override Logo',
                'name' => 'override_logo',
                'type' => 'true_false',
                'wrapper' => [
                    'width' => 100
                ],
                'show_in_graphql' => 1,
                'default_value' => 0,
                'ui' => 1
            ],      
            [
                'key' => 'field_header_logo_content_accordion',
                'label' => 'Content',
                'type' => 'accordion',
                'open' => 1,
                'multi_expand' => 1,       
                'conditional_logic' => [
                    [
                        [
                            'field' => 'field_page_header_override_logo',
                            'operator' => '==',
                            'value' => '1'
                        ],
                    ],
                ],
            ],            
            [
                'key' => 'field_page_header_logo_desktop',
                'label' => 'Logo - Desktop',
                'name' => 'page_header_logo_desktop',
                'graphql_field_name' => 'logoDesktop',
                'type' => 'image',                
                'wrapper' => [
                    'width' => 33,
                ],
                'show_in_graphql' => 1,
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',  
                'conditional_logic' => [
                    [
                        [
                            'field' => 'field_page_header_override_logo',
                            'operator' => '==',
                            'value' => '1'
                        ],
                    ],
                ],
            ], 
            [
                'key' => 'field_page_header_logo_mobile',
                'label' => 'Logo - Mobile',
                'name' => 'page_header_logo_mobile',
                'graphql_field_name' => 'logoMobile',
                'type' => 'image',                
                'wrapper' => [
                    'width' => 33,
                ],
                'show_in_graphql' => 1,
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',  
                'conditional_logic' => [
                    [
                        [
                            'field' => 'field_page_header_override_logo',
                            'operator' => '==',
                            'value' => '1'
                        ],
                    ],
                ],
            ],
            [
                'key' => 'field_page_header_logo_link',
                'label' => 'Link',
                'name' => 'page_header_logo_link',
                'graphql_field_name' => 'logoLink',
                'type' => 'link',
                'show_in_graphql' => 1,
                'wrapper' => [
                    'width' => '50',
                ],
                'return_format' => 'array',
            ],
            [
                'key' => 'field_header_logo_style_accordion',
                'label' => 'Style',
                'type' => 'accordion',
                'open' => 1,
                'multi_expand' => 1, 
                'conditional_logic' => [
                    [
                        [
                            'field' => 'field_page_header_override_logo',
                            'operator' => '==',
                            'value' => '1'
                        ],
                    ],
                ],
            ],
            [
                'key' => 'field_page_header_logo_width_desktop',
                'label' => 'Logo Width - Desktop',
                'name' => 'logo_width_desktop',                
                'type' => 'range',
                'wrapper' => [
                    'width' => '50'
                ],
                'show_in_graphql' => 1,
                'default_value' => 100,
                'min' => 100,
                'max' => 400,
                'conditional_logic' => [
                    [
                        [
                            'field' => 'field_page_header_override_logo',
                            'operator' => '==',
                            'value' => '1'
                        ],
                    ],
                ],
            ],
            [
                'key' => 'field_page_header_logo_width_mobile',
                'label' => 'Logo Width - Mobile',
                'name' => 'logo_width_mobile',
                'type' => 'range',
                'wrapper' => [
                    'width' => '50'
                ],
                'show_in_graphql' => 1,
                'default_value' => 100,
                'min' => 100,
                'max' => 400,
                'conditional_logic' => [
                    [
                        [
                            'field' => 'field_page_header_override_logo',
                            'operator' => '==',
                            'value' => '1'
                        ],
                    ],
                ],
            ],
            [
                'key' => 'field_header_logo_content_accordion_end',
                'label' => 'Accordion End',
                'type' => 'accordion',
                'endpoint' => 1,            
            ],
            [
                'key' => 'field_page_header_menu_tab',
                'label' => 'Menu',
                'type' => 'tab',
                'show_in_graphql' => 1,
                'placement' => 'top',
                'endpoint' => 0,
            ],
            [
                'key' => 'field_page_header_menu_enabled',
                'label' => 'Enabled',
                'name' => 'menu_enabled',
                'type' => 'true_false',
                'wrapper' => [
                    'width' => 100
                ],
                'show_in_graphql' => 1,
                'default_value' => 1,
                'ui' => 1
            ], 
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
        'menu_order' => 1,
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
        'graphql_field_name' => 'pageHeader',
        'map_graphql_types_from_location_rules' => 0,
        'graphql_types' => '',
    ]);
}
  
add_action('acf/init', __NAMESPACE__ . '\\init');
  