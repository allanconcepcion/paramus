<?php

namespace PD\ACF\Customize\SEO;

function init () {
  acf_add_local_field_group([
    'key' => 'group_seo',
    'title' => 'SEO',
    'location' => [
      [
        [
          'param' => 'options_page',
          'operator' => '==',
          'value' => 'customize',
        ],
      ],
    ],
    'menu_order' => 7,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'active' => true,
    'show_in_graphql' => 1,
    'graphql_field_name' => 'seo',
    'map_graphql_types_from_location_rules' => 0,
    'fields' => [
      [
        'key' => 'field_seo_tab_general',
        'label' => 'General',
        'type' => 'tab',
        'show_in_graphql' => 1,
      ],
      [
        'key' => 'field_seo_favicon',
        'label' => 'Favicon',
        'name' => 'favicon',
        'type' => 'image',
        'wrapper' => [
	        'width' => '25'
        ],
        'show_in_graphql' => 1,        
        'return_format' => 'array',
        'preview_size' => 'medium',
        'library' => 'all'
      ],      
      [
        'key' => 'field_seo_tab_tracking',
        'label' => 'Tracking',
        'type' => 'tab',
        'show_in_graphql' => 1,
      ],
      [
        'key' => 'field_seo_gtm_containers',
        'label' => 'GTM Containers',
        'name' => 'seo_gtm_containers',
        'type' => 'repeater',
        'layout' => 'block',
        'button_label' => 'Add container',
        'graphql_field_name' => 'gtmContainers',
      	'sub_fields' => [
          [
            'key' => 'field_seo_gtm_container_name',
            'label' => 'Name',
            'name' => 'seo_gtm_container_name',
            'type' => 'text',
            'instructions' => 'For reference only.',
            'required' => 1,
            'placeholder' => 'Name or description',
            'graphql_field_name' => 'name',
            'wrapper' => [
	            'width' => 50,
	          ],
	        ],
	        [
            'key' => 'field_seo_gtm_container_id',
            'label' => 'ID',
            'name' => 'seo_gtm_container_id',
            'type' => 'text',
            'instructions' => 'The GTM container ID',
            'required' => 1,
            'conditional_logic' => 0,
            'graphql_field_name' => 'id',
	          'wrapper' => [
	            'width' => 50,
	          ],
	          'placeholder' => 'GTM-XXXXXX',
	        ],
	      ],
      ],
      [
        'key' => 'field_seo_tab_custom_code',
        'label' => 'Custom Code',
        'type' => 'tab',
        'show_in_graphql' => 1,
      ],
      [
        'key' => 'field_seo_header_html',
        'label' => 'Header HTML',
        'name' => 'seo_header_html',
        'type' => 'textarea',
        'graphql_field_name' => 'headerHtml',
      ], 
      [
        'key' => 'field_seo_footer_html',
        'label' => 'Footer HTML',
        'name' => 'seo_footer_html',
        'type' => 'textarea',
        'graphql_field_name' => 'footerHtml',
      ]
    ]
  ]);  
}

add_action('acf/init', __NAMESPACE__ . '\\init');