<?php

namespace PD\ACF\Customize\Modals;

use function PD\ACF\Utils\acf_modal_trigger_fields;

function init () {
  acf_add_local_field_group([
    'key' => 'group_modals',
    'title' => 'Modals',
    'location' => [
      [
        [
          'param' => 'options_page',
          'operator' => '==',
          'value' => 'customize',
        ],
      ],
    ],
    'menu_order' => 6,
    'position' => 'normal',
    'style' => 'default',
    'label_placement' => 'top',
    'instruction_placement' => 'label',
    'active' => true,
    'show_in_graphql' => 1,
    'graphql_field_name' => 'modals',
    'map_graphql_types_from_location_rules' => 0,
    'fields' => [
      [
	      'key' => 'field_modals',
      	'label' => '',
	      'name' => 'modals',
        'graphql_field_name' => 'modals',
	      'type' => 'flexible_content',
	      'show_in_graphql' => 1,
        'button_label' => 'Add modal',
	      'layouts' => [          
          // Text 
	        'layout_text' => [
          'key' => 'layout_text',
          'name' => 'text',
          'label' => 'Text',
          'display' => 'block',
          'sub_fields' => [
              [
                'key' => "field_modals_text_id",
                'label' => 'ID',
                'name' => "modals_text_id",
                'graphql_field_name' => "id",
                'type' => 'text',
                'required' => 1,
                'instructions' =>  'Unique identifier.',
                'show_in_graphql' => 1,
                'wrapper' => [
                  'width' => 25
                ]
              ],
              ...acf_modal_trigger_fields([
                'key' => 'field_modals_text_trigger',
                'name' => 'modals_text_trigger',
                'graphql_field_name' => "trigger"
              ]),
              [
                'key' => 'field_modals_text_content_accordion',
                'label' => 'Content',
                'type' => 'accordion',
                'open' => 0,
                'multi_expand' => 1
              ],              
              [
                'key' => "field_modals_text_headline",
                'label' => 'Headline',
                'name' => "modals_text_headline",
                'graphql_field_name' => 'headline',
                'type' => 'wysiwyg',
                'wrapper' => [
	                'class' => 'wysiwyg-short'
                ],
                'show_in_graphql' => 1,
                'tabs' => 'visual',
                'toolbar' => 'bare',
                'media_upload' => 0,                
              ],
              [
                'key' => "field_modals_text_body",
                'label' => 'Body',
                'name' => 'modals_text_body',
                'graphql_field_name' => 'body',
                'type' => 'wysiwyg',
                'show_in_graphql' => 1,
                'default_value' => '',
                'tabs' => 'visual',
                'toolbar' => 'basic',
                'media_upload' => 0,
              ],
              [
                'key' => 'field_modals_text_html',
                'label' => 'Html',
                'name' => 'html',
                'type' => 'textarea',
                'show_in_graphql' => 1,
                'default_value' => '',      
              ], 
              [
                'key' => "field_modals_text_cta_enabled",
                'label' => 'CTA Enabled',
                'name' => "modals_text_cta_enabled",
                'graphql_field_name' => 'ctaEnabled',
                'type' => 'true_false',
                'show_in_graphql' => 1,
                'default_value' => 0,
                'ui' => 1,
                'wrapper' => [
                  'width' => 25
                ],
              ],
              [
                'key' => "field_modals_text_cta_link",
                'label' => 'CTA Link',
                'name' => 'modals_text_cta_link',
                'graphql_field_name' => 'textCtaLink',
                'type' => 'link',	 
                'show_in_graphql' => 1,
                'return_format' => 'array',
                'wrapper' => [
                  'width' => 75
                ],
                'conditional_logic' => [
                  [
                    [
                      'field' => "field_modals_text_cta_enabled",
                      'operator' => '==',
                      'value' => '1'
                    ],
                  ],
                ],
              ],
              [
                'key' => 'field_modals_text_style_accordion',
                'label' => 'Style',
                'type' => 'accordion',
                'open' => 0,
                'multi_expand' => 1
              ],              
            ]
          ],

          // Media + Text 
	        'layout_media_text' => [
          'key' => 'layout_media_text',
          'name' => 'media_text',
          'label' => 'Media + Text',
          'display' => 'block',
          'sub_fields' => [
              [
                'key' => "field_modals_media_text_id",
                'label' => 'ID',
                'name' => "modals_media_text_id",
                'graphql_field_name' => "id",
                'type' => 'text',
                'required' => 1,
                'instructions' =>  'Unique identifier.',
                'show_in_graphql' => 1,
                'wrapper' => [
                  'width' => 25
                ]
              ],
              ...acf_modal_trigger_fields([
                'key' => 'field_modals_media_text_trigger',
                'name' => 'modals_media_text_trigger',
                'graphql_field_name' => "trigger"
              ]),
              [
                'key' => 'field_modals_media_text_content_accordion',
                'label' => 'Content',
                'type' => 'accordion',
                'open' => 0,
                'multi_expand' => 1
              ],              
              [
                'key' => "field_modals_media_text_image",
                'label' => 'Image',
                'name' => "modals_media_text_image",
                'graphql_field_name' => 'mediaTextImage',
                'type' => 'image',     
                'show_in_graphql' => 1,
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
                'required' => 1,
                'wrapper' => [
                  'width' => 100
                ],
              ],
              [
                'key' => "field_modals_media_text_headline",
                'label' => 'Headline',
                'name' => "modals_media_text_headline",
                'graphql_field_name' => 'headline',
                'type' => 'wysiwyg',
                'wrapper' => [
	                'class' => 'wysiwyg-short'
                ],
                'show_in_graphql' => 1,
                'tabs' => 'visual',
                'toolbar' => 'bare',
                'media_upload' => 0,                
              ],
              [
                'key' => "field_modals_media_text_body",
                'label' => 'Body',
                'name' => 'modals_media_text_body',
                'graphql_field_name' => 'body',
                'type' => 'wysiwyg',
                'show_in_graphql' => 1,
                'default_value' => '',
                'tabs' => 'visual',
                'toolbar' => 'basic',
                'media_upload' => 0,
              ],
              [
                'key' => "field_modals_media_text_cta_enabled",
                'label' => 'CTA Enabled',
                'name' => "modals_media_text_cta_enabled",
                'graphql_field_name' => 'ctaEnabled',
                'type' => 'true_false',
                'show_in_graphql' => 1,
                'default_value' => 0,
                'ui' => 1,
                'wrapper' => [
                  'width' => 25
                ],
              ],
              [
                'key' => "field_modals_media_text_cta_link",
                'label' => 'CTA Link',
                'name' => 'modals_media_text_cta_link',
                'graphql_field_name' => 'mediaTextCtaLink',
                'type' => 'link',	 
                'show_in_graphql' => 1,
                'return_format' => 'array',
                'wrapper' => [
                  'width' => 75
                ],
                'conditional_logic' => [
                  [
                    [
                      'field' => "field_modals_media_text_cta_enabled",
                      'operator' => '==',
                      'value' => '1'
                    ],
                  ],
                ],
              ],
              [
                'key' => 'field_modals_media_text_style_accordion',
                'label' => 'Style',
                'type' => 'accordion',
                'open' => 0,
                'multi_expand' => 1
              ],              
            ]
          ],

          // Logo Carousel 
	        'layout_logo_carousel' => [
            'key' => 'layout_logo_carousel',
            'name' => 'logo_carousel',
            'label' => 'Logo Carousel',
            'display' => 'block',
            'sub_fields' => [
              [
                'key' => "field_modals_logo_carousel_id",
                'label' => 'ID',
                'name' => "modals_logo_carousel_id",
                'graphql_field_name' => "id",
                'type' => 'text',
                'required' => 1,
                'instructions' =>  'Unique identifier.',
                'show_in_graphql' => 1,
                'wrapper' => [
                  'width' => 25
                ]
              ],
              ...acf_modal_trigger_fields([
                'key' => 'field_modals_logo_carousel_trigger',
                'name' => 'modals_logo_carousel_trigger',
                'graphql_field_name' => "trigger"
              ]),
              [
                'key' => 'field_modals_logo_carousel_content_accordion',
                'label' => 'Content',
                'type' => 'accordion',
                'open' => 0,
                'multi_expand' => 1
              ],              
              [
                'key' => "field_modals_logo_carousel_image",
                'label' => 'Image',
                'name' => "modals_logo_carousel_image",
                'graphql_field_name' => 'logoCarouselImage',
                'type' => 'image',     
                'show_in_graphql' => 1,
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
                'wrapper' => [
                  'width' => 100
                ],
              ],
              [
                'key' => "field_modals_logo_carousel_headline",
                'label' => 'Headline',
                'name' => "modals_logo_carousel_headline",
                'graphql_field_name' => 'headline',
                'type' => 'wysiwyg',
                'wrapper' => [
	                'class' => 'wysiwyg-short'
                ],
                'show_in_graphql' => 1,
                'tabs' => 'visual',
                'toolbar' => 'bare',
                'media_upload' => 0,                
              ],
              [
                'key' => "field_modals_logo_carousel_body",
                'label' => 'Body',
                'name' => 'modals_logo_carousel_body',
                'graphql_field_name' => 'body',
                'type' => 'wysiwyg',
                'show_in_graphql' => 1,
                'default_value' => '',
                'tabs' => 'visual',
                'toolbar' => 'basic',
                'media_upload' => 0,
              ],
              [
                'key' => "field_modals_logo_carousel_cta_enabled",
                'label' => 'CTA Enabled',
                'name' => "modals_logo_carousel_cta_enabled",
                'graphql_field_name' => 'ctaEnabled',
                'type' => 'true_false',
                'show_in_graphql' => 1,
                'default_value' => 0,
                'ui' => 1,
                'wrapper' => [
                  'width' => 25
                ],
              ],
              [
                'key' => "field_modals_logo_carousel_cta_link",
                'label' => 'CTA Link',
                'name' => 'modals_logo_carousel_cta_link',
                'graphql_field_name' => 'logoCarouselCtaLink',
                'type' => 'link',	 
                'show_in_graphql' => 1,
                'return_format' => 'array',
                'wrapper' => [
                  'width' => 75
                ],
                'conditional_logic' => [
                  [
                    [
                      'field' => "field_modals_logo_carousel_cta_enabled",
                      'operator' => '==',
                      'value' => '1'
                    ],
                  ],
                ],
              ],
              [
                'key' => "field_modals_logo_carousel_logos",
                'label' => 'Logos',
                'name' => 'modals_logo_carousel_logos',
                'graphql_field_name' => 'logoCarouselLogos',
                'type' => 'gallery',
                'show_in_graphql' => 1,
                'library' => 'all',
                'mime_types' => 'jpg,jpeg,png,gif',
              ],
              [
                'key' => 'field_modals_logo_carousel_logo_width',
                'label' => 'Logo Ratio - Width',
                'name' => 'logo_ratio_width',
                'type' => 'number',
                'show_in_graphql' => 1,
                'default_value' => 3, 
                'wrapper' => [
                  'width' => 15
                ],
              ],
              [
                'key' => 'field_modals_logo_carousel_logo_height',
                'label' => 'Logo Ratio - Height',
                'name' => 'logo_ratio_height',
                'type' => 'number',
                'show_in_graphql' => 1,
                'default_value' => 2, 
                'wrapper' => [
                  'width' => 15
                ],
              ],              
              [
                'key' => 'field_modals_logo_carousel_style_accordion',
                'label' => 'Style',
                'type' => 'accordion',
                'open' => 0,
                'multi_expand' => 1
              ],              
            ]
          ],

          // Media
	        'layout_media' => [
            'key' => 'layout_media',
            'name' => 'media',
            'label' => 'Media',
            'display' => 'block',
            'sub_fields' => [
              [
                'key' => "field_modals_media_id",
                'label' => 'ID',
                'name' => "modals_media_id",
                'graphql_field_name' => "id",
                'type' => 'text',
                'required' => 1,
                'instructions' =>  'Unique identifier.',
                'show_in_graphql' => 1,
                'wrapper' => [
                  'width' => 25
                ]
              ],
              ...acf_modal_trigger_fields([
                'key' => 'field_modals_media_trigger',
                'name' => 'modals_media_trigger',
                'graphql_field_name' => "trigger"
              ]),
              [
                'key' => 'field_modals_media_content_accordion',
                'label' => 'Content',
                'type' => 'accordion',
                'open' => 0,
                'multi_expand' => 1
              ],
              [
                'key' => "field_modals_media_image",
                'label' => 'Image',
                'name' => "modals_media_image",
                'graphql_field_name' => 'mediaImage',
                'type' => 'image',     
                'show_in_graphql' => 1,
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
                'required' => 1,
                'wrapper' => [
                  'width' => 100
                ],
              ],
              [
                'key' => 'field_modals_media_style_accordion',
                'label' => 'Style',
                'type' => 'accordion',
                'open' => 0,
                'multi_expand' => 1
              ],              
            ]
          ],

          // Form
          'layout_form' => [
            'key' => 'layout_form',
            'name' => 'form',
            'label' => 'Form',
            'display' => 'block',
            'sub_fields' => [
              [
                'key' => "field_modals_form_id",
                'label' => 'ID',
                'name' => "modals_form_id",
                'graphql_field_name' => "id",
                'type' => 'text',
                'required' => 1,
                'instructions' =>  'Unique identifier.',
                'show_in_graphql' => 1,
                'wrapper' => [
                  'width' => 25
                ]
              ],
              ...acf_modal_trigger_fields([
                'key' => 'field_modals_form_trigger',
                'name' => 'modals_form_trigger',
                'graphql_field_name' => "trigger"
              ]),              
              [
                'key' => 'field_modals_form_content_accordion',
                'label' => 'Content',
                'type' => 'accordion',
                'open' => 0,
                'multi_expand' => 1
              ],
              [
                'key' => "field_modals_form_headline",
                'label' => 'Headline',
                'name' => "modals_form_headline",
                'graphql_field_name' => 'headline',
                'type' => 'wysiwyg',
                'wrapper' => [
	                'class' => 'wysiwyg-short'
                ],
                'show_in_graphql' => 1,
                'tabs' => 'visual',
                'toolbar' => 'bare',
                'media_upload' => 0,                
              ],
              [
                'key' => "field_modals_form_body",
                'label' => 'Body',
                'name' => 'modals_form_body',
                'graphql_field_name' => 'body',
                'type' => 'wysiwyg',
                'show_in_graphql' => 1,
                'default_value' => '',
                'tabs' => 'visual',
                'toolbar' => 'basic',
                'media_upload' => 0,
              ],
              [
                'key' => "field_modals_form_form",
                'label' => 'Form',
                'name' => "modals_form_form",
                'graphql_field_name' => 'formId',
                'type' => 'select',
                'show_in_graphql' => 1,
                'ui' => 1,
                'wrapper' => [
                  'width' => 25
                ]
              ], 
              [
                'key' => 'field_modals_form_style_accordion',
                'label' => 'Style',
                'type' => 'accordion',
                'open' => 0,
                'multi_expand' => 1
              ],
            ]
          ]
        ]
      ]
    ]
  ]);  
}

add_action('acf/init', __NAMESPACE__ . '\\init');

