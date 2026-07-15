<?php

namespace PD\ACF\Utils;

function acf_typography_fields (
  $options
) {  
  [
    'key' => $key,
    'name' => $name,
    'label' => $label,
    'graphql_field_name' => $graphqlFieldName,
    'defaults' => [
      'font_family' => $defaultFontFamily,
      'font_size' => $defaultFontSize,
      'letter_spacing' => $defaultLetterSpacing,
      'line_height' => $defaultLineHeight, 
      'font_weight' => $defaultFontWeight,
      'text_transform' => $defaultTextTransform
    ], 
    'conditional_logic' => $conditionalLogic
  ] = $options;

  if ( !$graphqlFieldName ) {
    $graphqlFieldName = $name;
  }
  
  return [
    array(
      'key' => "field_{$key}_font_family",
      'label' => "$label Font Family",
      'name' => "{$name}_font_family",
      'graphql_field_name' => "{$graphqlFieldName}FontFamily",      
      'type' => 'select',
      'wrapper' => array(
        'width' => 100/6,
      ),
      'show_in_graphql' => 1,
      'default' => $defaultFontFamily,
      'ui' => 1,
      'return_format' => 'value',
      'conditional_logic' => $conditionalLogic
    ),
    array(
      'key' => "field_{$name}_font_size",
      'label' => "$label Font Size",
      'name' => "{$name}_font_size",
      'graphql_field_name' => "{$graphqlFieldName}FontSize",      
      'type' => 'range',
      'wrapper' => array(
        'width' => 100/6,
      ),
      'show_in_graphql' => 1,
      'default_value' => $defaultFontSize,
      'min' => 8,
      'max' => 72,
      'conditional_logic' => $conditionalLogic
    ),
    array(
      'key' => "field_{$name}_letter_spacing",
      'label' => "$label Letter Spacing",
      'name' => "{$name}_letter_spacing",
      'graphql_field_name' => "{$graphqlFieldName}LetterSpacing",      
      'type' => 'range',
      'wrapper' => array(
        'width' => 100/6,
      ),
      'show_in_graphql' => 1,
      'default_value' => $defaultLetterSpacing,
      'min' => 0,
      'max' => 2,
      'step' => '0.01',
      'conditional_logic' => $conditionalLogic
    ),
    array(
      'key' => "field_{$name}_line_height",
      'label' => "$label Line Height",
      'name' => "{$name}_line_height",
      'graphql_field_name' => "{$graphqlFieldName}LineHeight",      
      'type' => 'range',
      'wrapper' => array(
        'width' => 100/6,
      ),
      'show_in_graphql' => 1,
      'default_value' => $defaultLineHeight,
      'min' => 1,
      'max' => 2,
      'step' => '0.01',
      'conditional_logic' => $conditionalLogic
    ),
    array(
      'key' => "field_{$name}_font_weight",
      'label' => "$label Font Weight",
      'name' => "{$name}_font_weight",
      'graphql_field_name' => "{$graphqlFieldName}FontWeight",
      'type' => 'select',
      'wrapper' => array(
        'width' => 100/6,
      ),
      'show_in_graphql' => 1,
      'choices' => array(
        100 => 100,
        200 => 200,
        300 => 300,
        'normal' => 'Normal',
        500 => 500,
        600 => 600,
        'bold' => 'Bold',
        800 => 800,
        900 => 900
      ),
      'default_value' => $defaultFontWeight,
      'ui' => 1,
      'return_format' => 'value',
      'conditional_logic' => $conditionalLogic
    ),
    array(
      'key' => "field_{$name}_text_transform",
      'label' => "$label Text Tranform",
      'name' => "{$name}_text_transform",
      'graphql_field_name' => "{$graphqlFieldName}TextTransform",
      'type' => 'select',
      'wrapper' => array(
        'width' => 100/6,
      ),
      'show_in_graphql' => 1,
      'choices' => array(
        'none' => 'None',
        'uppercase' => 'Uppercase',
        'capitalize' => 'Capitalize',
      ),
      'default_value' => $defaultTextTransform,
      'ui' => 1,
      'return_format' => 'value',
      'conditional_logic' => $conditionalLogic
    ),
  ];  
}

function acf_cta_icon_fields ( $options ) {
  $defaults = [
    'label' => '',
    'graphql_field_name_prefix' => ''
  ];
  
  [
    'key' => $key,
    'name' => $name,
    'label' => $label,
    'graphql_field_name_prefix' => $graphqlFieldNamePrefix
  ] = $options + $defaults;

  if ( !$graphqlFieldNamePrefix ) {
    $graphqlFieldNamePrefix = 'ctaIcon';
  }
    
  return [
    [
      'key' => "{$key}_cta_icon_color",
      'label' => "{$label} CTA Icon Color",
      'name' => "{$name}_cta_icon_color",
      'graphql_field_name' => "{$graphqlFieldNamePrefix}Color",
      'type' => 'select',
      'show_in_graphql' => 1,
      'ui' => 1,
      'wrapper' => [
	      'width' => 33.33,	  
      ],
    ],
    [
      'key' => "{$key}_cta_icon_background",
      'label' => "{$label} CTA Icon Background",
      'name' => "{$name}_cta_icon_background",
      'graphql_field_name' => "{$graphqlFieldNamePrefix}Background",
      'type' => 'select',
      'show_in_graphql' => 1,
      'ui' => 1,
      'wrapper' => [
	      'width' => 33.33,	  
      ],
    ],
    [
      'key' => "{$key}_cta_icon_border",
      'label' => "{$label} CTA Icon Border",
      'name' => "{$name}_cta_icon_border",
      'graphql_field_name' => "{$graphqlFieldNamePrefix}Border",
      'type' => 'select',
      'show_in_graphql' => 1,
      'ui' => 1,
      'wrapper' => [
	      'width' => 33.33,	  
      ],
    ],
    [
      'key' => "{$key}_cta_icon_color_hover",
      'label' => "{$label} CTA Icon Color - Hover",
      'name' => "{$name}_cta_icon_color_hover",
      'graphql_field_name' => "{$graphqlFieldNamePrefix}ColorHover",
      'type' => 'select',
      'show_in_graphql' => 1,
      'ui' => 1,
      'wrapper' => [
	      'width' => 33.33,	  
      ],
    ],
    [
      'key' => "{$key}_cta_icon_background_hover",
      'label' => "{$label} CTA Icon Background - Hover",
      'name' => "{$name}_cta_icon_background_hover",
      'graphql_field_name' => "{$graphqlFieldNamePrefix}BackgroundHover",
      'type' => 'select',
      'show_in_graphql' => 1,
      'ui' => 1,
      'wrapper' => [
	      'width' => 33.33,	  
      ],
    ],
    [
      'key' => "{$key}_cta_icon_border_hover",
      'label' => "{$label} CTA Icon Border - Hover",
      'name' => "{$name}_cta_icon_border_hover",
      'graphql_field_name' => "{$graphqlFieldNamePrefix}BorderHover",
      'type' => 'select',
      'show_in_graphql' => 1,
      'ui' => 1,
      'wrapper' => [
	      'width' => 33.33,	  
      ],
    ],                                         
  ];
}

function acf_background_position_field ( $options ) {
  [
    'key' => $key,
    'name' => $name,
    'label' => $label,
    'graphql_field_name' => $graphqlFieldName,
    'wrapper' => $wrapper
  ] = $options;

  if ( !$graphqlFieldName ) {
    $graphqlFieldName = $name;
  }

  return [
    [
      'key' => $key,
      'label' => $label,
      'name' => $name,
      'graphql_field_name' => $graphqlFieldName,
      'type' => 'select',
      'wrapper' => $wrapper,
      'show_in_graphql' => 1,
      'choices' => [
        'top left' => 'Top Left',
        'top center' => 'Top Center',
        'top right' => 'Top Right',
        'center left' => 'Center Left',
        'center' => 'Center',
        'center right' => 'Center Right',
        'bottom left' => 'Bottom Left',
        'bottom center' => 'Bottom Center',
        'bottom right' => 'Bottom Right',
      ],
      'default_value' => 'center',
      'ui' => 1,
      'return_format' => 'value',
    ]    
  ];
}

function acf_svg_icon_field ( $options ) {
  [
    'key' => $key,
    'name' => $name,
    'label' => $label,
    'graphql_field_name' => $graphqlFieldName,
    'required' => $required
  ] = $options;

  if ( !$graphqlFieldName ) {
    $graphqlFieldName = $name;
  }

  return [
    [
      'key' => $key,
      'label' => $label,
      'name' => $name,
      'graphql_field_name' => $graphqlFieldName,
      'required' => $required,
      'type' => 'select',
      'wrapper' => [
        'width' => 25,
      ],
      'show_in_graphql' => 1,
      'allow_null' => 1,
      'choices' => [      
        'phone' => 'Phone',
        'map-marker' => 'Map Marker',
        'clock' => 'Clock'
      ],
      'ui' => 1,
      'return_format' => 'value',
    ]    
  ];
}

function acf_modal_trigger_fields ( $options ) {
  $defaults = [
    'label' => '',
    'graphql_field_name' => ''
  ];
  
  [
    'key' => $key,
    'name' => $name,
    'label' => $label,
    'graphql_field_name' => $graphqlFieldName,
  ] = $options + $defaults;

  if ( !$graphqlFieldName ) {
    $graphqlFieldName = $name;
  }
   
  $pages = array_reduce(get_pages(), function ($result, $page) {    
    $result[$page->ID] = $page->post_title; 
    return $result;
  });
  
  return [
    [
      'key' => "{$key}_type",
      'label' => 'Trigger',
      'name' => "{$name}_type",
      'graphql_field_name' => "{$graphqlFieldName}Type",
      'type' => 'select',
      'show_in_graphql' => 1,
      'choices' => [
        'click' => 'Click',
        'scrollPosition' => 'Scroll Position',
        'delay' => 'Delay',
      ],
      'instructions' => 'Select trigger type.',
      'default_value' => 'click',
      'ui' => 1,
      'return_format' => 'value',
      'wrapper' => [
        'width' => 25
      ]
    ],    
    [
      'key' => "{$key}_handle",
      'label' => 'Handle',
      'name' => "{$name}_handle",
      'graphql_field_name' => "{$graphqlFieldName}Handle",
      'type' => 'text',
      'required' => 1,
      'wrapper' => [
        'width' => 25
      ],
      'placeholder' => 'handle',
      'instructions' =>  'Used in special url. e.g., #modal-[this handle].',
      'conditional_logic' => [
        [
          [
            'field' => "{$key}_type",
            'operator' => '==',
            'value' => 'click',
          ],
        ],
      ],
      'show_in_graphql' => 1,
    ],
    [
      'key' => "{$key}_scroll_position",
      'label' => 'Scroll Position',
      'name' => "{$name}_scroll_position",
      'graphql_field_name' => "{$graphqlFieldName}ScrollPosition",
      'instructions' => 'As a percentage of page height.',
      'append' => '%',
      'type' => 'number',
      'wrapper' => [
        'width' => 25
      ],
      'min' => 1,
      'max' => 100,
      'default_value' => 10,
      'conditional_logic' => [
        [
          [
            'field' => "{$key}_type",
            'operator' => '==',
            'value' => 'scrollPosition',
          ],
        ],
      ],
      'show_in_graphql' => 1,
    ],
    [
      'key' => "{$key}_delay",
      'label' => 'Delay',
      'name' => "{$name}_delay",
      'graphql_field_name' => "{$graphqlFieldName}Delay",
      'instructions' => 'In seconds after page load.',
      'append' => 'seconds',
      'type' => 'number',
      'wrapper' => [
        'width' => 25
      ],
      'min' => 1,
      'max' => 120,
      'default_value' => 5,
      'conditional_logic' => [
        [
          [
            'field' => "{$key}_type",
            'operator' => '==',
            'value' => 'delay',
          ],
        ],
      ],
      'show_in_graphql' => 1,
    ], 
    [
      'key' => "{$key}_pages",
      'label' => 'Pages',
      'name' => "{$name}_pages",
      'graphql_field_name' => "{$graphqlFieldName}Pages",
      'type' => 'select',
      'show_in_graphql' => 1,
      'choices' => $pages,
      'instructions' => 'Select page(s) for display. Leave blank for all pages.',
      'default_value' => 'all',
      'ui' => 1,
      'multiple' => 1,
      'return_format' => 'value',
      'wrapper' => [
        'width' => 25
      ], 
      'conditional_logic' => [
        [
          [
            'field' => "{$key}_type",
            'operator' => '==',
            'value' => 'delay',
          ],
        ],
        [
          [
            'field' => "{$key}_type",
            'operator' => '==',
            'value' => 'scrollPosition',
          ],
        ],
      ],
    ]    
  ];
}

function acf_footer_ctas_fields () {
  return [
    [
      'key' => 'field_footer_cta_enabled',
      'label' => 'CTA Enabled',
      'name' => 'footer_cta_enabled',
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
      'key' => 'field_footer_ctas',
      'label' => '',
      'name' => 'footer_ctas',
      'graphql_field_name' => 'ctas',
      'type' => 'flexible_content',
      'show_in_graphql' => 1,
      'conditional_logic' => [
        [
          [
            'field' => 'field_footer_cta_enabled',
            'operator' => '==',
            'value' => '1'
          ],
        ],
      ],
      'layouts' => [

        // Basic
        'layout_basic' => [
          'key' => 'layout_basic',
          'name' => 'basic',
          'label' => 'Basic',
          'display' => 'block',
          'sub_fields' => [              
            [
              'key' => 'field_footer_cta_basic_content_accordion',
              'label' => 'Content',
              'type' => 'accordion',
              'open' => 0,
              'multi_expand' => 1
            ],              
            [
              'key' => 'field_footer_cta_basic_image',
              'label' => 'Image',
              'name' => 'footer_cta_basic_image',
              'graphql_field_name' => 'image',        
              'type' => 'image',
              'wrapper' => [
	              'width' => 25
              ],
              'show_in_graphql' => 1,        
              'return_format' => 'array',
              'preview_size' => 'medium',
              'library' => 'all',
              'required' => 1,
            ],
            [
              'key' => "field_footer_cta_basic_headline",
              'label' => 'Headline',
              'name' => "footer_cta_basic_headline",
              'graphql_field_name' => 'headline',
              'type' => 'wysiwyg',
              'wrapper' => [
	              'class' => 'wysiwyg-short',
                'width' => 25
              ],
              'show_in_graphql' => 1,
              'tabs' => 'visual',
              'toolbar' => 'bare',
              'media_upload' => 0,
              'delay' => 0,
              'required' => 1,
            ],
            [
              'key' => 'field_footer_cta_basic_cta_enabled',
              'label' => 'Override Global CTA',
              'name' => 'cta_enabled',
              'type' => 'true_false',
              'wrapper' => [
      	        'width' => 25
              ],
              'show_in_graphql' => 1,
              'default_value' => 0,
              'ui' => 1
            ],
            [
              'key' => 'field_footer_cta_basic_cta',
              'label' => 'CTA',
              'name' => 'cta',
              'type' => 'link',
              'wrapper' => [
	              'width' => 25
              ],
              'conditional_logic' => [
                [
                  [
                    'field' => 'field_footer_cta_basic_cta_enabled',
                    'operator' => '==',
                    'value' => '1'
                  ],
                ],
              ],
              'show_in_graphql' => 1,
              'return_format' => 'array',
            ],              
            [
              'key' => 'field_footer_cta_basic_content_accordion_end',
              'label' => 'End',
              'type' => 'accordion',
              'endpoint' => 1
            ],
            [
              'key' => 'field_footer_cta_basic_styled_accordion',
              'label' => 'Style',
              'type' => 'accordion',
              'open' => 0,
              'multi_expand' => 1
            ],
            [
              'key' => "field_footer_cta_basic_text_color",
              'label' => "Text Color",
              'name' => "footer_cta_basic_text_color",
              'graphql_field_name' => 'textColor',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
      	        'width' => 33.33,	  
              ],
            ],
            [
              'key' => "field_footer_cta_basic_border_color",
              'label' => "Border Color",
              'name' => "footer_cta_basic_border_color",
              'graphql_field_name' => 'borderColor',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 33.33,	  
              ],
            ],
            [
              'key' => "field_footer_cta_basic_background_color",
              'label' => "Background Color",
              'name' => "footer_cta_basic_background_color",
              'graphql_field_name' => 'backgroundColor',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 33.33,	  
              ],
            ],                
            ...acf_cta_icon_fields([
              'key' => 'field_footer_cta_basic',
              'name' => 'footer_cta_basic'
            ]),              
            [
              'key' => "field_footer_cta_basic_space_background_color",
              'label' => "Background Color (Space Around)",
              'name' => "footer_cta_basic_space_background_color",
              'graphql_field_name' => 'backgroundColorSpace',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 33.33,	  
              ],
            ],                            
          ],
        ],

        // HTML Embed        
        'layout_html_embed' => [
          'key' => 'layout_html_embed',
          'name' => 'html_embed',
          'label' => 'HTML Embed',
          'display' => 'block',
          'sub_fields' => [              
            [
              'key' => 'field_footer_cta_html_embed_content_accordion',
              'label' => 'Content',
              'type' => 'accordion',
              'open' => 1,
              'multi_expand' => 1
            ],                          
            [
              'key' => "field_footer_cta_html_embed_headline",
              'label' => 'Headline',
              'name' => "footer_cta_html_embed_headline",
              'graphql_field_name' => 'headline',
              'type' => 'wysiwyg',
              'wrapper' => [
	              'class' => 'wysiwyg-short',
                'width' => 100
              ],
              'show_in_graphql' => 1,
              'tabs' => 'visual',
              'toolbar' => 'bare',
              'media_upload' => 0,
              'delay' => 0,
              'required' => 1,
            ],            
            [
              'key' => 'field_footer_cta_html_embed_image',
              'label' => 'Image',
              'name' => 'footer_cta_html_embed_image',
              'graphql_field_name' => 'htmlImage',        
              'type' => 'image',
              'wrapper' => [
	              'width' => 50
              ],
              'show_in_graphql' => 1,        
              'return_format' => 'array',
              'preview_size' => 'medium',
              'library' => 'all',
              'required' => 1,
            ],  
            [
              'key' => 'field_footer_cta_html_embed_html_enabled',
              'label' => 'Override Global HTML',
              'name' => 'html_enabled',
              'type' => 'true_false',
              'wrapper' => [
      	        'width' => 25
              ],
              'show_in_graphql' => 1,
              'default_value' => 1,
              'ui' => 1
            ],          
            [
              'key' => 'field_footer_cta_html_embed_html',
              'label' => 'Html',
              'name' => 'footer_cta_html_embed_html',
              'graphql_field_name' => 'html',        
              'type' => 'textarea',
              'required' => 1,
              'show_in_graphql' => 1,
              'default_value' => '',      
              'wrapper' => [
	              'width' => 25
              ],
              'conditional_logic' => [
                [
                  [
                    'field' => 'field_footer_cta_html_embed_html_enabled',
                    'operator' => '==',
                    'value' => '1'
                  ],
                ],
              ],
            ],  
            [
              'key' => 'field_footer_cta_html_embed_note',
              'label' => 'Note',
              'name' => 'footer_cta_html_embed_note',
              'graphql_field_name' => 'note',        
              'type' => 'textarea',
              'rows' => 3,              
              'show_in_graphql' => 1,
              'default_value' => '',      
              'wrapper' => [
	              'width' => 100
              ],
            ],                      
            [
              'key' => 'field_footer_cta_html_embed_content_accordion_end',
              'label' => 'End',
              'type' => 'accordion',
              'endpoint' => 1
            ],
            [
              'key' => 'field_footer_cta_html_embed_styled_accordion',
              'label' => 'Style',
              'type' => 'accordion',
              'open' => 0,
              'multi_expand' => 1
            ],
            [
              'key' => "field_footer_cta_html_embed_text_color",
              'label' => "Text Color",
              'name' => "footer_cta_html_embed_text_color",
              'graphql_field_name' => 'textColor',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
      	        'width' => 33.33,	  
              ],
            ],
            [
              'key' => "field_footer_cta_html_embed_border_color",
              'label' => "Border Color",
              'name' => "footer_cta_html_embed_border_color",
              'graphql_field_name' => 'borderColor',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 33.33,	  
              ],
            ],
            [
              'key' => "field_footer_cta_html_embed_embed_background_color",
              'label' => "Embed Background Color",
              'name' => "footer_cta_html_embed_embed_background_color",
              'graphql_field_name' => 'embedBackgroundColor',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 33.33,	  
              ],
            ],
            [
              'key' => "field_footer_cta_html_embed_background_color",
              'label' => "Background Color",
              'name' => "footer_cta_html_embed_background_color",
              'graphql_field_name' => 'backgroundColor',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 33.33,	  
              ],
            ],                            
            [
              'key' => "field_footer_cta_html_embed_space_background_color",
              'label' => "Background Color (Space Around)",
              'name' => "footer_cta_html_embed_space_background_color",
              'graphql_field_name' => 'backgroundColorSpace',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 33.33,	  
              ],
            ],                            
          ],
        ],

        // Checklist + HTML Embed        
        'layout_checklist_html_embed' => [
          'key' => 'layout_checklist_html_embed',
          'name' => 'checklist_html_embed',
          'label' => 'Checklist + HTML Embed',
          'display' => 'block',
          'sub_fields' => [              
            [
              'key' => 'field_footer_cta_checklist_html_embed_content_accordion',
              'label' => 'Content',
              'type' => 'accordion',
              'open' => 1,
              'multi_expand' => 1
            ],                          
            [
              'key' => 'field_footer_cta_checklist_html_embed_image',
              'label' => 'Image',
              'name' => 'footer_cta_checklist_html_embed_image',
              'graphql_field_name' => 'checklistHtmlImage',        
              'type' => 'image',
              'wrapper' => [
	              'width' => 50
              ],
              'show_in_graphql' => 1,        
              'return_format' => 'array',
              'preview_size' => 'medium',
              'library' => 'all',
              'required' => 1,
            ],                
            [
              'key' => 'field_footer_cta_checklist_html_embed_underline_image',
              'label' => 'Underline Image',
              'name' => 'footer_cta_checklist_html_embed_underline_image',
              'graphql_field_name' => 'checklistHtmlUnderlineImage',        
              'type' => 'image',
              'wrapper' => [
	              'width' => 50
              ],
              'show_in_graphql' => 1,        
              'return_format' => 'array',
              'preview_size' => 'medium',
              'library' => 'all',              
            ],                                    
            [
              'key' => "field_footer_cta_checklist_html_embed_headline",
              'label' => 'Headline',
              'name' => "footer_cta_html_embed_headline",
              'graphql_field_name' => 'headline',
              'type' => 'wysiwyg',
              'wrapper' => [
	              'class' => 'wysiwyg-short',
                'width' => 100
              ],
              'show_in_graphql' => 1,
              'tabs' => 'visual',
              'toolbar' => 'bare',
              'media_upload' => 0,
              'delay' => 0,
              'required' => 1,
            ],
            [            
              'key' => 'field_footer_cta_checklist_html_embed_checklist',
              'label' => 'Checklist',
              'name' => 'footer_cta_checklist_html_embed_checklist',
              'graphql_field_name' => 'checklist',
              'type' => 'repeater',
              'show_in_graphql' => 1,
              'layout' => 'block',
              'button_label' => 'Add an item',
              'sub_fields' => [
                [
                  'key' => 'field_checklist_body',
                  'label' => 'Body',
                  'name' => 'body',
                  'type' => 'wysiwyg',
                  'instructions' => '',
                  'required' => 1,
                  'wrapper' => [
                    'class' => 'wysiwyg-short',
                    'width' => 100
                  ],
                  'show_in_graphql' => 1,
                  'tabs' => 'visual',
                  'toolbar' => 'bare',
                  'media_upload' => 0,
                  'delay' => 0,
                  'required' => 1,
                ],            
              ]
            ],
            [
              'key' => 'field_footer_cta_checklist_html_embed_html_enabled',
              'label' => 'Override Global HTML',
              'name' => 'checklist_html_enabled',
              'type' => 'true_false',
              'wrapper' => [
      	        'width' => 25
              ],
              'show_in_graphql' => 1,
              'default_value' => 1,
              'ui' => 1
            ],  
            [
              'key' => 'field_footer_cta_checklist_html_embed_html',
              'label' => 'Html',
              'name' => 'footer_cta_checklist_html_embed_html',
              'graphql_field_name' => 'html',        
              'type' => 'textarea',
              'required' => 1,
              'show_in_graphql' => 1,
              'default_value' => '',      
              'wrapper' => [
	              'width' => 75
              ],
              'conditional_logic' => [
                [
                  [
                    'field' => 'field_footer_cta_checklist_html_embed_html_enabled',
                    'operator' => '==',
                    'value' => '1'
                  ],
                ],
              ],
            ],              
            [
              'key' => 'field_footer_cta_html_embed_content_accordion_end',
              'label' => 'End',
              'type' => 'accordion',
              'endpoint' => 1
            ],
            [
              'key' => 'field_footer_cta_checklist_html_embed_styled_accordion',
              'label' => 'Style',
              'type' => 'accordion',
              'open' => 0,
              'multi_expand' => 1
            ],
            [
              'key' => "field_footer_cta_checklist_html_embed_text_color",
              'label' => "Text Color",
              'name' => "footer_cta_checklist_html_embed_text_color",
              'graphql_field_name' => 'textColor',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
      	        'width' => 33.33,	  
              ],
            ],
            [
              'key' => "field_footer_cta_checklist_html_embed_border_color",
              'label' => "Border Color",
              'name' => "footer_cta_checklist_html_embed_border_color",
              'graphql_field_name' => 'borderColor',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 33.33,	  
              ],
            ],
            [
              'key' => "field_footer_cta_checklist_html_embed_accent_color",
              'label' => "Accent Color",
              'name' => "footer_cta_checklist_html_embed_accent_color",
              'graphql_field_name' => 'accentColor',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 33.33,	  
              ],
            ],
            [
              'key' => "field_footer_cta_checklist_html_embed_embed_background_color",
              'label' => "Embed Background Color",
              'name' => "footer_cta_checklist_html_embed_embed_background_color",
              'graphql_field_name' => 'embedBackgroundColor',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 33.33,	  
              ],
            ],
            [
              'key' => "field_footer_cta_checklist_html_embed_background_color",
              'label' => "Background Color",
              'name' => "footer_cta_checklist_html_embed_background_color",
              'graphql_field_name' => 'backgroundColor',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 33.33,	  
              ],
            ],                            
            [
              'key' => "field_footer_cta_checklist_html_embed_space_background_color",
              'label' => "Background Color (Space Around)",
              'name' => "footer_cta_checklist_html_embed_space_background_color",
              'graphql_field_name' => 'backgroundColorSpace',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 33.33,	  
              ],
            ],                            
          ],
        ],

      ],
      'button_label' => 'Add CTA',
      'min' => '',
      'max' => 1,
    ]
  ];
}
