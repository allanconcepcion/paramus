<?php

namespace PD\ACF\Page\Layout\ContactForm;

function fields () {
  return [
    [
      'key' => 'field_contact_form_content',
      'label' => 'Content',
      'type' => 'accordion',
      'open' => 1,
      'multi_expand' => 1,
      'endpoint' => 0,
    ],

    [
      'key' => 'field_contact_forms_eyebrow_enabled',
      'label' => 'Eyebrow Enabled',
      'name' => 'eyebrow_enabled',
      'type' => 'true_false',
      'wrapper' => [
	      'width' => 25
      ],
      'show_in_graphql' => 1,
      'default_value' => 0,
      'ui' => 1
    ],    
    [
      'key' => 'field_contact_forms_eyebrow',
      'label' => 'Eyebrow',
      'name' => 'eyebrow',
      'type' => 'text',
      'show_in_graphql' => 1,
      'conditional_logic' => [
        [
          [
            'field' => 'field_contact_forms_eyebrow_enabled',
            'operator' => '==',
            'value' => '1'
          ],
        ],
      ],
    ],
    [
      'key' => 'field_contact_forms_eyebrow_tag',
      'label' => 'Eyebrow Tag',
      'name' => 'eyebrow_tag',
      'type' => 'select',
      'show_in_graphql' => 1,
      'choices' => [
        'h1' => 'H1',
        'h2' => 'H2',
        'h3' => 'H3',
        'h4' => 'H4',
        'h5' => 'H5',
        'h6' => 'H6',
      ],      
      'default_value' => 'h1',	
      'ui' => 1,
      'return_format' => 'value',
      'conditional_logic' => [
        [
          [
            'field' => 'field_contact_forms_eyebrow_enabled',
            'operator' => '==',
            'value' => '1'
          ],
        ],
      ],
    ],

    [
      'key' => 'field_contact_forms_headline',
      'label' => 'Headline',
      'name' => 'contact_forms_headline',
      'graphql_field_name' => 'headline',
      'type' => 'wysiwyg',
      'wrapper' => [
      	'class' => 'wysiwyg-short'
      ],
      'show_in_graphql' => 1,
      'tabs' => 'visual',
      'toolbar' => 'bare',
      'media_upload' => 0,
      'delay' => 0,
    ],
    [
      'key' => "field_contact_forms_headline_tag",
      'label' => 'Headline Tag',
      'name' => "contact_forms_headline_tag",
      'graphql_field_name' => 'headlineTag',
      'type' => 'select',
      'show_in_graphql' => 1,
      'choices' => [
        'h1' => 'H1',
        'h2' => 'H2',
        'h3' => 'H3',
        'h4' => 'H4',
        'h5' => 'H5',
        'h6' => 'H6',
      ],
      'default_value' => 'h2',
      'multiple' => 0,
      'ui' => 0,
      'return_format' => 'value',
      'ajax' => 0,
    ],
    [
      'key' => 'field_contact_forms_select_label',
      'label' => 'Select Label',
      'name' => 'contact_forms_select_label',
      'graphql_field_name' => 'selectLabel',
      'type' => 'text',
      'instructions' => 'Select label and UI display if more than one form is added.',
      'show_in_graphql' => 1,
    ],
    [
      'key' => 'field_contact_form_forms',
      'name' => 'form_forms',
      'graphql_field_name' => 'forms',
      'type' => 'repeater',
      'show_in_graphql' => 1,
      'layout' => 'row',
      'button_label' => 'Add form',
      'sub_fields' => [
        [
	        'key' => 'field_contact_forms_forms_name',
          'label' => 'Display Name',
          'name' => 'name',
          'type' => 'text',
          'required' => 1,
	        'show_in_graphql' => 1,
      	],        
        [
          'key' => "field_contact_form_forms_form_type",
          'label' => 'Form Type',
          'name' => "contact_form_forms_form_type",
          'graphql_field_name' => 'formType',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
            'width' => 100
          ], 
          'choices' => [
            'gravityForm' => 'Gravity Form', 
            'custom' => 'Custom'
          ], 
          'default_value' => 'gravityForm'
        ],   
        [
          'key' => "field_contact_form_forms_form",
          'label' => 'Form',
          'name' => "contact_form_forms_form",
          'graphql_field_name' => 'formId',
          'type' => 'select',
          'required' => 1,
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
            'width' => 25
          ],
          'conditional_logic' => [
            [
              [
                'field' => 'field_contact_form_forms_form_type',
                'operator' => '==',
                'value' => 'gravityForm'
              ],
            ],
          ],
        ],  
        [
          'key' => 'field_contact_form_forms_html',
          'label' => 'Html',
          'name' => 'contact_form_forms_html',
          'graphql_field_name' => 'html',
          'type' => 'textarea',
          'required' => 1,
          'show_in_graphql' => 1,
          'default_value' => '',      
          'conditional_logic' => [
            [
              [
                'field' => 'field_contact_form_forms_form_type',
                'operator' => '==',
                'value' => 'custom'
              ],
            ],
          ],
        ], 
        [
          'key' => 'field_contact_form_forms_footnote',
          'label' => 'Footnote',
          'name' => 'footnote',
          'type' => 'wysiwyg',
          'wrapper' => [
            'class' => 'wysiwyg-short'
          ],
          'show_in_graphql' => 1,
          'tabs' => 'visual',
          'toolbar' => 'bare',
          'media_upload' => 0,
          'delay' => 0,
        ],
        [
          'key' => "field_contact_form_forms_media_type",
          'label' => 'Media Type',
          'name' => "contact_form_forms_media_type",
          'graphql_field_name' => 'mediaType',
          'type' => 'select',
          'required' => 1,
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
            'width' => 25
          ], 
          'choices' => [
            'map' => 'Map', 
            'image' => 'Image'
          ], 
          'default_value' => 'map'
        ],
        
        [
          'key' => 'field_contact_form_forms_map',
          'label' => 'Map',
          'name' => 'contact_form_forms_map',
          'graphql_field_name' => 'map',        
          'type' => 'textarea',
          'instructions' => 'HTML embed code',
          'required' => 1,          
          'show_in_graphql' => 1,
          'rows' => 4, 
          'conditional_logic' => [
            [
              [
                'field' => 'field_contact_form_forms_media_type',
                'operator' => '==',
                'value' => 'map'
              ],
            ],
          ],
        ],
        [
          'key' => "field_contact_form_forms_image",
          'name' => "contact_form_forms_image",
          'label' => 'Image',
          'graphql_field_name' => "image",
          'type' => 'image',     
          'show_in_graphql' => 1,
          'return_format' => 'array',
          'preview_size' => 'medium',
          'library' => 'all',
          'required' => 1,
          'wrapper' => [
            'width' => 33.33
          ],
          'conditional_logic' => [
            [
              [
                'field' => 'field_contact_form_forms_media_type',
                'operator' => '==',
                'value' => 'image'
              ],
            ],
          ],
        ],
      ]
    ], 
    [
      'key' => "field_contact_form_content_end",
      'label' => 'Content End',
      'type' => 'accordion',
      'endpoint' => 1,
    ],
    [
      'key' => "field_contact_form_style_accordion",
      'label' => 'Style',
      'type' => 'accordion',
      'open' => 0,
      'multi_expand' => 1,
    ],    
    [
      'key' => "field_contact_form_forms_media_position_desktop",
      'label' => 'Media Position (Desktop)',
      'name' => "contact_form_forms_media_position_desktop",
      'graphql_field_name' => 'mediaPositionDesktop',
      'type' => 'select',
      'show_in_graphql' => 1,
      'ui' => 1,
      'wrapper' => [
        'width' => 100
      ], 
      'choices' => [
        'left' => 'Left', 
        'right' => 'Right'
      ], 
      'default_value' => 'left'
    ],      
    [
      'key' => "field_contact_form_visible_on_desktop",
      'name' => "contact_form_visible_on_desktop",
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
      'key' => "field_contact_form_visible_on_mobile",
      'name' => "contact_form_visible_on_mobile",
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
      'key' => "field_contact_form_style_accordion_end",
      'label' => 'Style',
      'type' => 'accordion',
      'endpoint' => 1
    ],
  ];
}
