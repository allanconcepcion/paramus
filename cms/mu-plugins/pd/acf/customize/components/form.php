<?php

namespace PD\ACF\Customize\Components\Form;

use function PD\ACF\Utils\acf_typography_fields;
use function PD\ACF\Utils\acf_cta_icon_fields;

function fields () {
  return [
    [
      'key' => 'field_components_form_accordion',
      'label' => 'Form',
      'type' => 'accordion',
      'open' => 0,
      'multi_expand' => 1,
      'show_in_graphql' => 1,
    ],
    [
      'key' => 'field_components_form_group',
      'name' => 'form',
      'type' => 'group',
      'show_in_graphql' => 1,
      'layout' => 'block',
      'sub_fields' => [
        [
          'key' => 'field_components_form_buttons_tab',
          'label' => 'Buttons',
          'type' => 'tab',
          'show_in_graphql' => 1,
        ],
        [
          'key' => 'field_components_form_buttons_style_accordion',
          'label' => 'Style',
          'type' => 'accordion',
          'open' => 0,
          'multi_expand' => 1,
        ],
        ...acf_cta_icon_fields([
          'key' => "field_components_form_submit",
          'name' => "components_form_submit",
          'graphql_field_name_prefix' => 'submitButton',
          'label' => 'Submit'
        ]),
        [
          'key' => 'field_modules_form_buttons_style_accordion_end',
          'label' => 'Accordion End',
          'type' => 'accordion',
          'endpoint' => 1,            
        ],
      ]
    ], 
  ];
}
