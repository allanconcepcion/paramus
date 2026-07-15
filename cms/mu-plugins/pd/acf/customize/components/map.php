<?php

namespace PD\ACF\Customize\Components\Map;

function fields () {
    return [
        [
            'key' => 'field_components_map_accordion',
            'label' => 'Map',
            'type' => 'accordion',
            'open' => 0,
            'multi_expand' => 1,
            'show_in_graphql' => 1,
        ],
        [
            'key' => 'field_components_map_group',
            'name' => 'map',
            'type' => 'group',
            'show_in_graphql' => 1,
            'layout' => 'block',
            'sub_fields' => [
                [
                    'key' => 'field_components_map_google_tab',
                    'label' => 'Google',
                    'type' => 'tab',
                    'show_in_graphql' => 1,
                ],
                [
                    'key' => 'field_components_map_google_api_key',
                    'label' => 'API Key',
                    'name' => 'google_maps_api_key',
                    'type' => 'text',
                    'show_in_graphql' => 1, 
                    'instructions' => 'Ensure the following API\'s are enabled: Maps JavaScript API, Maps Embed API, Geocoding API and Places API'
                ],                                
            ]
        ], 
    ];
}

