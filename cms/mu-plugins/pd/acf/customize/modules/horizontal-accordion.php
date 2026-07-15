<?php

namespace PD\ACF\Customize\Modules\HorizontalAccordion;

use function PD\ACF\Utils\acf_background_position_field;

function fields ( $key, $label ) {
  return [
    [
      'key' => "field_horizontal_accordion_accordion_{$key}",
      'label' => "Horizontal Accordion - {$label}",
      'type' => 'accordion',
      'open' => 0,
      'multi_expand' => 1,
      'show_in_graphql' => 1,
    ],
    [
      'key' => "field_horizontal_accordion_group_{$key}",
      'name' => "horizontal_accordion_{$key}",
      'type' => 'group',
      'show_in_graphql' => 1,
      'layout' => 'block',
      'sub_fields' => [
        [
          'key' => "field_horizontal_accordion_headline_tab_{$key}",
          'label' => 'Header',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => "field_horizontal_accordion_headline_style_accordion_{$key}",
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
          'key' => "field_modules_horizontal_accordion_header_color_{$key}",
          'label' => 'Headline Color',
          'name' => "modules_horizontal_accordion_header_color_{$key}",
          'graphql_field_name' => 'headerColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 25,
          ],
        ],
        [
          'key' => "field_modules_horizontal_accordion_header_color_bold_{$key}",
          'label' => "Headline Color (Bold)",
          'name' => "modules_horizontal_accordion_header_color_bold_{$key}",
          'graphql_field_name' => 'headerColorBold',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 25,	  
          ],
        ],         
        [
          'key' => "field_modules_horizontal_accordion_header_body_color_{$key}",
          'label' => 'Body Color',
          'name' => "modules_horizontal_accordion_header_body_color_{$key}",
          'graphql_field_name' => 'headerBodyColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 25,
          ],
        ],        
        [
          'key' => "field_modules_horizontal_accordion_header_background_color_{$key}",
          'label' => 'Background Color',
          'name' => "modules_horizontal_accordion_header_background_color_{$key}",
          'graphql_field_name' => 'headerBackgroundColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 25,
          ],
        ],
        [
          'key' => "field_modules_horizontal_accordion_header_border_color_{$key}",
          'label' => 'Border Color',
          'name' => "modules_horizontal_accordion_header_border_color_{$key}",
          'graphql_field_name' => 'headerBorderColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 25,
          ],
        ],        
        [
          'key' => "field_horizontal_accordion_headline_style_accordion_end_{$key}",
          'label' => 'Accordion End',
          'type' => 'accordion',
          'endpoint' => 1,            
        ],
        [
          'key' => "field_horizontal_accordion_items_tab_{$key}",
          'label' => 'Items',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => "field_horizontal_accordion_items_style_accordion_{$key}",
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
	        'key' => "field_modules_horizontal_accordion_items_style_desktop_{$key}",
      	  'name' => "items_style_desktop_{$key}",
          'graphql_field_name' => 'itemsStyleDesktop',
          'label' => 'Desktop',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
            [
              'key' => "field_modules_horizontal_accordion_items_style_desktop_default_color_{$key}",
              'label' => 'Default Color',
              'name' => "modules_horizontal_accordion_items_style_desktop_default_color_{$key}",
              'graphql_field_name' => 'defaultColor',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 50
              ],
            ],            
            [
              'key' => "field_modules_horizontal_accordion_items_style_desktop_default_border_color_{$key}",
              'label' => 'Default Border Color',
              'name' => "modules_horizontal_accordion_items_style_desktop_default_border_color_{$key}",
              'graphql_field_name' => 'defaultBorderColor',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 50
              ],
            ],
            [
              'key' => "field_modules_horizontal_accordion_items_style_desktop_default_icon_color_{$key}",
              'label' => 'Default Icon Color',
              'name' => "modules_horizontal_accordion_items_style_desktop_default_icon_color_{$key}",
              'graphql_field_name' => 'defaultIconColor',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 33.33
              ],
            ],
            [
              'key' => "field_modules_horizontal_accordion_items_style_desktop_default_icon_background_color_{$key}",
              'label' => 'Default Icon Background Color',
              'name' => "modules_horizontal_accordion_items_style_desktop_default_icon_background_color_{$key}",
              'graphql_field_name' => 'defaultIconBackgroundColor',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 33.33
              ],
            ],
            [
              'key' => "field_modules_horizontal_accordion_items_style_desktop_default_icon_border_color_{$key}",
              'label' => 'Default Icon Border Color',
              'name' => "modules_horizontal_accordion_items_style_desktop_default_icon_border_color_{$key}",
              'graphql_field_name' => 'defaultIconBorderColor',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 33.33
              ],
            ],
            [
              'key' => "field_modules_horizontal_accordion_items_style_desktop_default_icon_color_hover_{$key}",
              'label' => 'Default Icon Color - Hover',
              'name' => "modules_horizontal_accordion_items_style_desktop_default_icon_color_hover_{$key}",
              'graphql_field_name' => 'defaultIconColorHover',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 33.33
              ],
            ],
            [
              'key' => "field_modules_horizontal_accordion_items_style_desktop_default_icon_background_color_hover_{$key}",
              'label' => 'Default Icon Background Color - Hover',
              'name' => "modules_horizontal_accordion_items_style_desktop_default_icon_background_color_hover_{$key}",
              'graphql_field_name' => 'defaultIconBackgroundColorHover',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 33.33
              ],
            ],
            [
              'key' => "field_modules_horizontal_accordion_items_style_desktop_default_icon_border_color_hover{$key}",
              'label' => 'Default Icon Border Color - Hover',
              'name' => "modules_horizontal_accordion_items_style_desktop_default_icon_border_color_hover_{$key}",
              'graphql_field_name' => 'defaultIconBorderColorHover',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 33.33
              ],
            ],                          
            [
              'key' => "field_modules_horizontal_accordion_items_style_desktop_closed_color_{$key}",
              'label' => 'Closed Color',
              'name' => "modules_horizontal_accordion_items_style_desktop_closed_color_{$key}",
              'graphql_field_name' => 'closedColor',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 33.33
              ],
            ],            
            [
              'key' => "field_modules_horizontal_accordion_items_style_desktop_closed_background_color_{$key}",
              'label' => 'Closed Background Color',
              'name' => "modules_horizontal_accordion_items_style_desktop_closed_background_color_{$key}",
              'graphql_field_name' => 'closedBackgroundColor',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 33.33
              ],
            ],
            [
              'key' => "field_modules_horizontal_accordion_items_style_desktop_closed_border_color_{$key}",
              'label' => 'Closed Border Color',
              'name' => "modules_horizontal_accordion_items_style_desktop_closed_border_color_{$key}",
              'graphql_field_name' => 'closedBorderColor',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 33.33
              ],
            ],
            [
              'key' => "field_modules_horizontal_accordion_items_style_desktop_open_color_{$key}",
              'label' => 'Open Color',
              'name' => "modules_horizontal_accordion_items_style_desktop_open_color_{$key}",
              'graphql_field_name' => 'openColor',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 33.33
              ],
            ],            
          ]
        ],
        [
          'key' => "field_modules_horizontal_accordion_items_style_mobile_{$key}",
          'name' => "items_style_mobile_{$key}",
          'graphql_field_name' => 'itemsStyleMobile',
          'label' => 'Mobile',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
            [
              'key' => "field_modules_horizontal_accordion_items_style_mobile_closed_text_color_{$key}",
              'label' => 'Closed Color',
              'name' => "modules_horizontal_accordion_items_style_mobile_closed_text_color_{$key}",
              'graphql_field_name' => 'closedColor',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 33.33
              ],
            ],
            [
              'key' => "field_modules_horizontal_accordion_items_style_mobile_closed_background_color_{$key}",
              'label' => 'Closed Background Color',
              'name' => "modules_horizontal_accordion_items_style_mobile_closed_background_color_{$key}",
              'graphql_field_name' => 'closedBackgroundColor',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 33.33
              ],
            ],
            [
              'key' => "field_modules_horizontal_accordion_items_style_mobile_closed_border_color_{$key}",
              'label' => 'Closed Border Color',
              'name' => "modules_horizontal_accordion_items_style_mobile_closed_border_color_{$key}",
              'graphql_field_name' => 'closedBorderColor',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 33.33
              ],
            ],           
            [
              'key' => "field_modules_horizontal_accordion_items_style_mobile_closed_icon_color_{$key}",
              'label' => 'Closed Icon Color',
              'name' => "modules_horizontal_accordion_items_style_mobile_closed_icon_color_{$key}",
              'graphql_field_name' => 'closedIconColor',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 33.33
              ],
            ],
            [
              'key' => "field_modules_horizontal_accordion_items_style_mobile_closed_icon_background_color_{$key}",
              'label' => 'Closed Icon Background Color',
              'name' => "modules_horizontal_accordion_items_style_mobile_closed_icon_background_color_{$key}",
              'graphql_field_name' => 'closedIconBackgroundColor',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 33.33
              ],
            ],
            [
              'key' => "field_modules_horizontal_accordion_items_style_mobile_closed_icon_border_color_{$key}",
              'label' => 'Closed Icon Border Color',
              'name' => "modules_horizontal_accordion_items_style_mobile_closed_icon_border_color_{$key}",
              'graphql_field_name' => 'closedIconBorderColor',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 33.33
              ],
            ],
            [
              'key' => "field_modules_horizontal_accordion_items_style_mobile_open_text_color_{$key}",
              'label' => 'Open Color',
              'name' => "modules_horizontal_accordion_items_style_mobile_open_text_color_{$key}",
              'graphql_field_name' => 'openColor',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 33.33
              ],
            ],            
            [
              'key' => "field_modules_horizontal_accordion_items_style_mobile_open_background_color_{$key}",
              'label' => 'Open Background Color',
              'name' => "modules_horizontal_accordion_items_style_mobile_open_background_color_{$key}",
              'graphql_field_name' => 'openBackgroundColor',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 33.33
              ],
            ],
            [
              'key' => "field_modules_horizontal_accordion_items_style_mobile_open_border_color_{$key}",
              'label' => 'Open Border Color',
              'name' => "modules_horizontal_accordion_items_style_mobile_open_border_color_{$key}",
              'graphql_field_name' => 'openBorderColor',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 33.33
              ],
            ],  
            [
              'key' => "field_modules_horizontal_accordion_items_style_mobile_open_icon_color_{$key}",
              'label' => 'Open Icon Color',
              'name' => "modules_horizontal_accordion_items_style_mobile_open_icon_color_{$key}",
              'graphql_field_name' => 'openIconColor',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 33.33
              ],
            ],
            [
              'key' => "field_modules_horizontal_accordion_items_style_mobile_open_icon_background_color_{$key}",
              'label' => 'Open Icon Background Color',
              'name' => "modules_horizontal_accordion_items_style_mobile_open_icon_background_color_{$key}",
              'graphql_field_name' => 'openIconBackgroundColor',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 33.33
              ],
            ],
            [
              'key' => "field_modules_horizontal_accordion_items_style_mobile_open_icon_border_color_{$key}",
              'label' => 'Open Icon Border Color',
              'name' => "modules_horizontal_accordion_items_style_mobile_open_icon_border_color_{$key}",
              'graphql_field_name' => 'openIconBorderColor',
              'type' => 'select',
              'show_in_graphql' => 1,
              'ui' => 1,
              'wrapper' => [
	              'width' => 33.33
              ],
            ],            
          ]
        ],        
        [
          'key' => "field_horizontal_accordion_items_style_accordion_end_{$key}",
          'label' => 'Accordion End',
          'type' => 'accordion',
          'endpoint' => 1,            
        ],
        [
          'key' => "field_modules_horizontal_accordion_background_tab_{$key}",
          'label' => 'Background',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => "field_modules_horizontal_accordion_style_accordion_{$key}",
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],        
        [
          'key' => "field_modules_horizontal_accordion_background_style_desktop_{$key}",
          'name' => "background_desktop",
          'label' => 'Desktop',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
            [
              'key' => "field_modules_horizontal_accordion_style_desktop_background_image_{$key}",
              'label' => 'Background Image',
              'name' => 'background_image',              
              'graphql_field_name' => 'backgroundImage',
              'type' => 'image',
              'instructions' => 'Displays if `Background Image` is enabled at the module level.',
              'show_in_graphql' => 1,
              'return_format' => 'array',
              'preview_size' => 'medium',
              'library' => 'all',
              'wrapper' => [
                'width' => 50
              ],
            ],
            ...acf_background_position_field([
              'key' => "field_background_position_desktop_{$key}",
              'label' => 'Background Position',
              'name' => 'background_position_desktop',
              'graphql_field_name' => 'backgroundPosition',
              'wrapper' => [
                'width' => 50
              ]
            ]),            
          ]
        ],
        [
          'key' => "field_modules_video_background_style_mobile_{$key}",
          'name' => 'background_mobile',
          'label' => 'Mobile',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
            [
              'key' => "field_modules_video_style_mobile_background_image_{$key}",
              'label' => 'Background Image',
              'name' => 'background_image',
              'graphql_field_name' => 'backgroundImage',
              'type' => 'image',
              'instructions' => 'Displays if `Background Image` is enabled at the module level.',
              'show_in_graphql' => 1,
              'return_format' => 'array',
              'preview_size' => 'medium',
              'library' => 'all',
              'wrapper' => [
                'width' => 50
              ],
            ],
            ...acf_background_position_field([
              'key' => "field_background_position_mobile_{$key}",
              'label' => 'Background Position',
              'name' => 'background_position_mobile',
              'graphql_field_name' => 'backgroundPosition',
              'wrapper' => [
                'width' => 50
              ]
            ]),            
          ]
        ],                  
      ]
    ],    
    [      
      'key' => "field_horizontal_accordion_accordion_end_{$key}",
      'label' => 'Accordion End',
      'type' => 'accordion',
      'endpoint' => 1,            
    ],       
  ];
}
