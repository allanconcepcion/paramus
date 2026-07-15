<?php

namespace PD\ACF\Customize\Components\Post;

use function PD\ACF\Utils\acf_typography_fields;

function fields () {
  return [
    [
      'key' => 'field_components_post_accordion',
      'label' => 'Post',
      'type' => 'accordion',
      'open' => 0,
      'multi_expand' => 1,
      'show_in_graphql' => 1,
    ],
    [
      'key' => 'field_components_post_group',
      'name' => 'post',
      'type' => 'group',
      'show_in_graphql' => 1,
      'layout' => 'block',
      'sub_fields' => [
        [
          'key' => 'field_components_post_date_tab',
          'label' => 'Date',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => 'field_components_post_date_style_accordion',
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
          'key' => "field_components_post_date_border_color",
          'label' => 'Border Color',
          'name' => "components_post_date_border_color",
          'graphql_field_name' => 'dateBorderColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
	          'width' => 25
          ],
        ],
        [
          'key' => 'field_components_post_date_desktop',
          'name' => 'desktop',
          'label' => 'Desktop',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
            ...acf_typography_fields([
              'key' => 'field_components_post_date_desktop_regular',
              'name' => 'components_post_date_desktop_regular',
              'graphql_field_name' => 'regular',
              'label' => 'Regular',
              'defaults' => [
                'font_family' => 'primary',
                'font_size' => 15,
                'letter_spacing' => 0,
                'line_height' => 1.6,
                'font_weight' => 300,
                'text_transform' => 'none'
              ]                       
            ]),
          ]
        ],
        [
          'key' => 'field_components_post_date_mobile',
          'name' => 'mobile',
          'label' => 'Mobile',
          'type' => 'group',
          'show_in_graphql' => 1,
          'layout' => 'block',
          'sub_fields' => [
            ...acf_typography_fields([
              'key' => 'field_components_post_date_mobile_regular',
              'name' => 'components_post_date_mobile_regular',
              'graphql_field_name' => 'regular',
              'label' => 'Regular',
              'defaults' => [
                'font_family' => 'primary',
                'font_size' => 15,
                'letter_spacing' => 0,
                'line_height' => 1.6,
                'font_weight' => 300,
                'text_transform' => 'none'
              ]                       
            ]),
          ]
        ],                      
        [
          'key' => 'field_modules_post_date_style_accordion_end',
          'label' => 'Accordion End',
          'type' => 'accordion',
          'endpoint' => 1,            
        ],
        [
          'key' => 'field_components_post_author_tab',
          'label' => 'Author Widget',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => 'field_components_post_author_content_accordion',
          'label' => 'Content',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
          'key' => "field_components_post_author_enabled",
          'label' => 'Enabled',
          'name' => "components)_post_author_enabled",
          'graphql_field_name' => 'authorEnabled',
          'type' => 'true_false',          
          'show_in_graphql' => 1,
          'default_value' => 0,
          'ui' => 1
        ],
        [
          'key' => "field_components_post_author_cta_enabled",
          'label' => 'CTA Enabled',
          'name' => "components)_post_author_cta_enabled",
          'graphql_field_name' => 'authorCtaEnabled',
          'type' => 'true_false',
          'wrapper' => [
            'width' => 25
          ],
          'show_in_graphql' => 1,
          'default_value' => 0,
          'ui' => 1
        ],
        [
          'key' => "field_components_post_author_cta_body",
          'label' => 'CTA Body',
          'name' => 'components_post_author_cta_body',
          'graphql_field_name' => 'authorCtaBody',
          'type' => 'textarea',
          'rows' => '2',
          'show_in_graphql' => 1,
          'default_value' => '', 
          'wrapper' => [
            'width' => 50
          ],
        ],
        [
          'key' => 'field_components_post_author_cta_link',
          'label' => 'CTA Link',
          'name' => 'cta_link',
          'graphql_field_name' => 'authorCtaLink',
          'type' => 'link',
          'show_in_graphql' => 1,
          'return_format' => 'array',
          'wrapper' => [
            'width' => 25
          ],
        ],        
        [
          'key' => 'field_modules_post_author_content_accordion_end',
          'label' => 'Accordion End',
          'type' => 'accordion',
          'endpoint' => 1,            
        ],
        [
          'key' => 'field_components_post_author_style_accordion',
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        [
          'key' => "field_components_post_author_color",
          'label' => 'Text Color',
          'name' => "components_post_author_color",
          'graphql_field_name' => 'authorColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
            'width' => 50
          ],
        ],
        [
          'key' => "field_components_post_author_background_color",
          'label' => 'Background Color',
          'name' => "components_post_author_background_color",
          'graphql_field_name' => 'authorBackgroundColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
            'width' => 50
          ],
        ],
        [
          'key' => "field_components_post_author_cta_color",
          'label' => 'CTA Button Color',
          'name' => "components_post_author_cta_color",
          'graphql_field_name' => 'authorCtaColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
            'width' => 25
          ],
        ],
        [
          'key' => "field_components_post_author_cta_background_color",
          'label' => 'CTA Button Background Color',
          'name' => "components_post_author_cta_background_color",
          'graphql_field_name' => 'authorCtaBackgroundColor',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
            'width' => 25
          ],
        ],
        [
          'key' => "field_components_post_author_cta_color_hover",
          'label' => 'CTA Button Color (Hover)',
          'name' => "components_post_author_cta_color_hover",
          'graphql_field_name' => 'authorCtaColorHover',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
            'width' => 25
          ],
        ],
        [
          'key' => "field_components_post_author_cta_background_color_hover",
          'label' => 'CTA Button Background Color (Hover)',
          'name' => "components_post_author_cta_background_color_hover",
          'graphql_field_name' => 'authorCtaBackgroundColorHover',
          'type' => 'select',
          'show_in_graphql' => 1,
          'ui' => 1,
          'wrapper' => [
            'width' => 25
          ],
        ],
      ]
    ], 
  ];
}
