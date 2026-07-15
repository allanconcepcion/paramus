<?php

namespace PD;

function graphql_register_types () {
    // Permalinks
    register_graphql_object_type( 'PermalinkSettings', [
        'description' => 'PermalinkSettings data',
        'fields' => [
            'categoryBase' => [
                'type' => 'String',
                'description' => 'category base wp option',
            ],                  
            'permalinkStructure' => [
                'type' => 'String',
                'description' => 'permalink structure wp option',
            ],                  
        ],
    ]);

    register_graphql_field( 'RootQuery', 'permalinkSettings', [
        'type' => 'PermalinkSettings',        
        'resolve' => function( $source, $args, $context, $info ) {                                               			            
            return [
                'categoryBase' => get_option('category_base'), 
                'permalinkStructure' => get_option('permalink_structure'), 
            ];            
        }
    ] );

    // Redirects
    register_graphql_object_type( 'Redirects', [
        'description' => 'Redirect data',
        'fields' => [
            'urlFrom' => [
                'type' => 'String',
                'description' => 'URL From',
            ],                  
            'urlTo' => [
                'type' => 'String',
                'description' => 'URL To',
            ],                  
            'status' => [
                'type' => 'Int',
                'description' => 'Redirect status',
            ],                  
        ],
    ]);

    register_graphql_field( 'RootQuery', 'redirects', [
        'type' => ['list_of' => 'Redirects'],        
        'resolve' => function( $source, $args, $context, $info ) {  
            global $wpdb;
            $results = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}redirects", OBJECT);

            $redirects = [];
            foreach ( $results as $k => $result ) {
                $url_to = $result->url_to;

                switch ( $result->type ) {
                    case 'post':
                        $url_to = get_permalink((int)$result->url_to);
                    break;
                }

                $redirects[]= [
                    'urlFrom' => $result->url_from, 
                    'urlTo' => $url_to, 
                    'status' => $result->status                    
                ];
            }                                            			            

            return $redirects;            
        }
    ] );
}

add_action('graphql_register_types', __NAMESPACE__ . '\\graphql_register_types');

