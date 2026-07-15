<?php

namespace PD\ACF\Page\Hero;

use function PD\ACF\Utils\acf_typography_fields;
use function PD\ACF\Utils\acf_background_position_field;

function init()
{
    acf_add_local_field_group([
        "key" => "group_hero",
        "title" => "Hero",
        "fields" => [
            [
                "key" => "field_hero_content_tab",
                "label" => "Content",
                "type" => "tab",
                "show_in_graphql" => 1,
                "placement" => "top",
            ],
            [
                "key" => "field_hero_content_type",
                "label" => "Type",
                "name" => "content_type",
                "type" => "select",
                "wrapper" => [
                    "width" => "25",
                ],
                "show_in_graphql" => 1,
                "choices" => [
                    "copy" => "Copy",
                    "image" => "Image",
                ],
                "default_value" => "copy",
                "allow_null" => 0,
                "multiple" => 0,
                "ui" => 1,
                "return_format" => "value",
            ],
            [
                "key" => "field_content_content_accordion",
                "label" => "Content",
                "type" => "accordion",
                "open" => 1,
                "multi_expand" => 1,
            ],
            [
                "key" => "field_hero_eyebrow",
                "label" => "Eyebrow",
                "name" => "eyebrow",
                "type" => "text",
                "required" => 1,
                "conditional_logic" => [
                    [
                        [
                            "field" => "field_hero_content_type",
                            "operator" => "==",
                            "value" => "copy",
                        ],
                    ],
                ],
                "show_in_graphql" => 1,
            ],
            [
                "key" => "field_hero_headline",
                "label" => "Headline",
                "name" => "headline",
                "type" => "wysiwyg",
                "required" => 1,
                "tabs" => "visual",
                "toolbar" => "bare",
                "media_upload" => 0,
                "conditional_logic" => [
                    [
                        [
                            "field" => "field_hero_content_type",
                            "operator" => "==",
                            "value" => "copy",
                        ],
                    ],
                ],
                "wrapper" => [
                    "class" => "wysiwyg-short",
                ],
            ],
            [
                "key" => "field_hero_image",
                "label" => "Image",
                "name" => "image",
                "type" => "image",
                "required" => 1,
                "conditional_logic" => [
                    [
                        [
                            "field" => "field_hero_content_type",
                            "operator" => "==",
                            "value" => "image",
                        ],
                    ],
                ],
                "show_in_graphql" => 1,
                "return_format" => "array",
                "preview_size" => "medium",
                "library" => "all",
            ],
            [
                'key' => 'field_hero_linklist_enabled',
                'label' => 'Linklist Enabled',
                'name' => 'linklist_enabled',
                'type' => 'true_false',
                'wrapper' => [
                    'width' => 100
                ],
                'show_in_graphql' => 1,
                'default_value' => 0,
                'ui' => 1
            ],
            [            
                'key' => 'field_hero_linklist',
                'label' => 'Linklist',
                'name' => 'hero_linklist',
                'graphql_field_name' => 'linklist',
                'type' => 'repeater',
                'show_in_graphql' => 1,
                'layout' => 'block',
                'button_label' => 'Add a link',
                'sub_fields' => [
                    [
                        'key' => 'field_hero_linklist_link',
                        'label' => 'Link',
                        'name' => 'link',
                        'type' => 'link',
                        'show_in_graphql' => 1,
                        'return_format' => 'array',
                    ] ,  

                ],
                "conditional_logic" => [
                    [
                        [
                            "field" => "field_hero_linklist_enabled",
                            "operator" => "==",
                            "value" => 1,
                        ],
                    ],
                ],
              ],
            [
                "key" => "field_content_content_accordion_end",
                "label" => "Accordion End",
                "type" => "accordion",
                "endpoint" => 1,
            ],
            [
                "key" => "field_content_style_accordion",
                "label" => "Style",
                "type" => "accordion",
                "open" => 1,
                "multi_expand" => 1,
            ],
            [
                "key" => "field_hero_content_height",
                "label" => "Height",
                "name" => "hero_content_height",
                "graphql_field_name" => "height",
                "type" => "select",
                "show_in_graphql" => 1,
                "choices" => [
                    "full" => "Full",
                    "auto" => "Auto",
                ],
                "default_value" => "full",
                "ui" => 1,
                "return_format" => "value",
                "wrapper" => [
                    "width" => 20,
                ],
            ],
            [
                "key" => "field_hero_copy_alignment_desktop",
                "label" => "Copy Alignment - Desktop",
                "name" => "hero_copy_alignment_desktop",
                "graphql_field_name" => "copyAlignmentDesktop",
                "type" => "select",
                "show_in_graphql" => 1,
                "choices" => [
                    "left" => "Left",
                    "center" => "Center",
                ],
                "default_value" => "left",
                "ui" => 1,
                "return_format" => "value",
                "wrapper" => [
                    "width" => 20,
                ],
                "conditional_logic" => [
                    [
                        [
                            "field" => "field_hero_content_type",
                            "operator" => "==",
                            "value" => "copy",
                        ],
                    ],
                ],
            ],
            [
                "key" => "field_hero_min_height_mobile",
                "label" => "Min Height - Mobile",
                "name" => "hero_min_height_mobile",
                "graphql_field_name" => "minHeightMobile",
                "type" => "range",
                "wrapper" => [
                    "width" => 20,
                ],
                "show_in_graphql" => 1,
                "default_value" => 90,
                "min" => 0,
                "max" => 100,
                "append" => "%",
                "instructions" => "A percentage of window height.",
            ],
            [
                "key" => "field_image_width",
                "label" => "Image Max Width",
                "name" => "image_max_width",
                "type" => "range",
                "wrapper" => [
                    "width" => 20,
                ],
                "show_in_graphql" => 1,
                "default_value" => 100,
                "min" => 100,
                "max" => 1200,
                "conditional_logic" => [
                    [
                        [
                            "field" => "field_hero_content_type",
                            "operator" => "==",
                            "value" => "image",
                        ],
                    ],
                ],
            ],
            [
                "key" => "field_image_width_mobile",
                "label" => "Image Max Width - Mobile",
                "name" => "image_max_width_mobile",
                "type" => "range",
                "wrapper" => [
                    "width" => 20,
                ],
                "show_in_graphql" => 1,
                "default_value" => 200,
                "min" => 100,
                "max" => 600,
                "conditional_logic" => [
                    [
                        [
                            "field" => "field_hero_content_type",
                            "operator" => "==",
                            "value" => "image",
                        ],
                        [
                            "field" => "field_hero_mobile_show_image",
                            "operator" => "==",
                            "value" => 1,
                        ],
                    ],
                ],
            ],
            [
                "key" => "field_hero_mobile_show_image",
                "label" => "Show Image - Mobile",
                "name" => "show_image_mobile",
                "type" => "true_false",
                "show_in_graphql" => 1,
                "default_value" => 0,
                "ui" => 1,
                "wrapper" => [
                    "width" => 20,
                ],
                "conditional_logic" => [
                    [
                        [
                            "field" => "field_hero_content_type",
                            "operator" => "==",
                            "value" => "image",
                        ],
                    ],
                ],
            ],
            [
                "key" => "field_hero_text_background_image",
                "label" => "Text Background Image - Mobile",
                "name" => "hero_text_background_image",
                "graphql_field_name" => "textBackgroundImageMobile",
                "type" => "image",
                "conditional_logic" => [
                    [
                        [
                            "field" => "field_hero_content_type",
                            "operator" => "==",
                            "value" => "copy",
                        ],
                    ],
                ],
                "show_in_graphql" => 1,
                "return_format" => "array",
                "preview_size" => "medium",
                "library" => "all",
                "wrapper" => [
                    "width" => 20,
                ],
                "instructions" =>
                    "Can be set globally in Customize -> Modules -> Hero. If set, this field overrides the global setting.",
            ],
            [
                "key" => "field_content_style_accordion_end",
                "label" => "Accordion End",
                "type" => "accordion",
                "endpoint" => 1,
            ],
            [
                "key" => "field_hero_video_tab",
                "label" => "Video",
                "type" => "tab",
                "show_in_graphql" => 1,
                "placement" => "top",
                "endpoint" => 0,
            ],
            [
                "key" => "field_hero_video_enabled",
                "label" => "Video Enabled",
                "name" => "video_enabled",
                "type" => "true_false",
                "show_in_graphql" => 1,
                "default_value" => 0,
                "ui" => 1,
            ],
            [
                "key" => "field_hero_video_title",
                "label" => "Title",
                "name" => "video_title",
                "type" => "textarea",
                "show_in_graphql" => 1,
                "rows" => 2,
                "conditional_logic" => [
                    [
                        [
                            "field" => "field_hero_video_enabled",
                            "operator" => "==",
                            "value" => "1",
                        ],
                    ],
                ],
            ],
            [
                "key" => "field_hero_video_poster_image",
                "label" => "Poster Image",
                "name" => "video_poster_image",
                "type" => "image",
                "required" => 1,
                "conditional_logic" => [
                    [
                        [
                            "field" => "field_hero_video_enabled",
                            "operator" => "==",
                            "value" => "1",
                        ],
                    ],
                ],
                "wrapper" => [
                    "width" => "50",
                ],
                "show_in_graphql" => 1,
                "return_format" => "array",
                "preview_size" => "medium",
                "library" => "all",
            ],
            [
                "key" => "field_hero_video_poster_video",
                "label" => "Poster Video",
                "name" => "video_poster_video",
                "type" => "file",
                "conditional_logic" => [
                    [
                        [
                            "field" => "field_hero_video_enabled",
                            "operator" => "==",
                            "value" => "1",
                        ],
                    ],
                ],
                "wrapper" => [
                    "width" => "50",
                ],
                "show_in_graphql" => 1,
                "return_format" => "array",
                "library" => "all",
                "mime_types" => "mp4",
            ],
            [
                "key" => "field_hero_video_url",
                "label" => "Video",
                "name" => "video_url",
                "type" => "url",
                "instructions" => "YouTube or Vimeo Url",
                "conditional_logic" => [
                    [
                        [
                            "field" => "field_hero_video_enabled",
                            "operator" => "==",
                            "value" => "1",
                        ],
                    ],
                ],
                "show_in_graphql" => 1,
            ],
            [
                "key" => "field_hero_link_tab",
                "label" => "Link",
                "type" => "tab",
                "show_in_graphql" => 1,
                "placement" => "top",
                "endpoint" => 0,
            ],
            [
                "key" => "field_override_hero_link",
                "label" => "Override Global Link",
                "name" => "link_override",
                "type" => "true_false",
                "wrapper" => [
                    "width" => 25,
                ],
                "show_in_graphql" => 1,
                "default_value" => 0,
                "ui" => 1,
            ],
            [
                "key" => "field_override_hero_link_enabled",
                "label" => "Link Enabled",
                "name" => "link_enabled",
                "type" => "true_false",
                "wrapper" => [
                    "width" => "25",
                ],
                "conditional_logic" => [
                    [
                        [
                            "field" => "field_override_hero_link",
                            "operator" => "==",
                            "value" => "1",
                        ],
                    ],
                ],
                "show_in_graphql" => 1,
                "default_value" => 0,
                "ui" => 1,
            ],
            [
                "key" => "field_override_hero_link_link",
                "label" => "Link",
                "name" => "link",
                "type" => "link",
                "wrapper" => [
                    "width" => "50",
                ],
                "conditional_logic" => [
                    [
                        [
                            "field" => "field_override_hero_link_enabled",
                            "operator" => "==",
                            "value" => "1",
                        ],
                    ],
                ],
                "show_in_graphql" => 1,
                "return_format" => "array",
            ],
            [
                "key" => "field_hero_cta_tab",
                "label" => "CTA",
                "type" => "tab",
                "show_in_graphql" => 1,
                "placement" => "top",
                "endpoint" => 0,
            ],
            [
                "key" => "field_override_hero_cta",
                "label" => "Override Global CTA",
                "name" => "cta_override",
                "type" => "true_false",
                "wrapper" => [
                    "width" => 25,
                ],
                "show_in_graphql" => 1,
                "default_value" => 0,
                "ui" => 1,
            ],
            [
                "key" => "field_override_hero_cta_enabled",
                "label" => "CTA Enabled",
                "name" => "cta_enabled",
                "type" => "true_false",
                "wrapper" => [
                    "width" => "25",
                ],
                "conditional_logic" => [
                    [
                        [
                            "field" => "field_override_hero_cta",
                            "operator" => "==",
                            "value" => "1",
                        ],
                    ],
                ],
                "show_in_graphql" => 1,
                "default_value" => 0,
                "ui" => 1,
            ],
            [
                "key" => "field_override_hero_cta_cta",
                "label" => "CTA",
                "name" => "cta",
                "type" => "link",
                "wrapper" => [
                    "width" => "50",
                ],
                "conditional_logic" => [
                    [
                        [
                            "field" => "field_override_hero_cta_enabled",
                            "operator" => "==",
                            "value" => "1",
                        ],
                    ],
                ],
                "show_in_graphql" => 1,
                "return_format" => "array",
            ],
            [
                "key" => "field_hero_background_tab",
                "label" => "Background",
                "type" => "tab",
                "show_in_graphql" => 1,
                "placement" => "top",
                "endpoint" => 0,
            ],
            [
                "key" => "field_background_content_accordion",
                "label" => "Content",
                "type" => "accordion",
                "open" => 1,
                "multi_expand" => 1,
            ],
            [
                "key" => "field_hero_image_desktop",
                "label" => "Image - Desktop",
                "name" => "background_image_desktop",
                "type" => "image",
                "required" => 1,
                "wrapper" => [
                    "width" => "50",
                ],
                "show_in_graphql" => 1,
                "return_format" => "array",
                "preview_size" => "medium",
                "library" => "all",
            ],
            [
                "key" => "field_hero_image_mobile",
                "label" => "Image - Mobile",
                "name" => "background_image_mobile",
                "type" => "image",
                "required" => 1,
                "wrapper" => [
                    "width" => "50",
                ],
                "show_in_graphql" => 1,
                "return_format" => "array",
                "preview_size" => "medium",
                "library" => "all",
            ],
            [
                "key" => "field_hero_video_desktop",
                "label" => "Video - Desktop",
                "name" => "background_video_desktop",
                "type" => "file",
                "mime_types" => "mp4",
                "wrapper" => [
                    "width" => "50",
                ],
                "show_in_graphql" => 1,
                "return_format" => "array",
                "library" => "all",
            ],
            [
                "key" => "field_hero_video_mobile",
                "label" => "Video - Mobile",
                "name" => "background_video_mobile",
                "mime_types" => "mp4",
                "type" => "file",
                "wrapper" => [
                    "width" => "50",
                ],
                "show_in_graphql" => 1,
                "return_format" => "array",
                "library" => "all",
            ],
            [
                "key" => "field_background_style_accordion",
                "label" => "Style",
                "type" => "accordion",
                "open" => 0,
                "multi_expand" => 1,
            ],
            [
                "key" => "field_global_background_overlay_override",
                "label" => "Global Background Overlay Override",
                "name" => "global_background_overlay_override",
                "type" => "true_false",
                "wrapper" => [
                    "width" => 100,
                ],
                "show_in_graphql" => 1,
                "default_value" => 0,
                "ui" => 1,
            ],
            [
                "key" => "field_background_overlay_desktop",
                "label" => "Background Overlay - Desktop",
                "name" => "background_overlay_desktop",
                "type" => "color_picker",
                "enable_opacity" => 1,
                "show_in_graphql" => 1,
                "default_value" => "rgba(0,0,0,.5)",
                "wrapper" => [
                    "width" => "50",
                ],
                "conditional_logic" => [
                    [
                        [
                            "field" =>
                                "field_global_background_overlay_override",
                            "operator" => "==",
                            "value" => "1",
                        ],
                    ],
                ],
            ],
            [
                "key" => "field_background_overlay_mobile",
                "label" => "Background Overlay - Mobile",
                "name" => "background_overlay_mobile",
                "type" => "color_picker",
                "enable_opacity" => 1,
                "show_in_graphql" => 1,
                "default_value" => "rgba(0,0,0,.5)",
                "wrapper" => [
                    "width" => "50",
                ],
                "conditional_logic" => [
                    [
                        [
                            "field" =>
                                "field_global_background_overlay_override",
                            "operator" => "==",
                            "value" => "1",
                        ],
                    ],
                ],
            ],
            ...acf_background_position_field([
                "key" => "field_hero_background_position_desktop",
                "label" => "Background Position - Desktop",
                "name" => "background_position_desktop",
                "graphql_field_name" => "backgroundPositionDesktop",
                "wrapper" => [
                    "width" => 50,
                ],
            ]),
            ...acf_background_position_field([
                "key" => "field_hero_background_position_mobile",
                "label" => "Background Position - Mobile",
                "name" => "background_position_mobile",
                "graphql_field_name" => "backgroundPositionMobile",
                "wrapper" => [
                    "width" => 50,
                ],
            ]),
        ],
        "location" => [
            [
                [
                    "param" => "post_type",
                    "operator" => "==",
                    "value" => "page",
                ],
            ],
        ],
        "menu_order" => 2,
        "position" => "acf_after_title",
        "style" => "default",
        "label_placement" => "top",
        "instruction_placement" => "label",
        "hide_on_screen" => [
            0 => "the_content",
        ],
        "active" => true,
        "show_in_rest" => 0,
        "show_in_graphql" => 1,
        "graphql_field_name" => "hero",
        "map_graphql_types_from_location_rules" => 0,
        "graphql_types" => "",
    ]);
}

add_action("acf/init", __NAMESPACE__ . "\\init");
