<?php

namespace PD\SchemaPro;

function graphql_register_types () {        
    register_graphql_object_type( 'SchemaPro', [
        'description' => 'SchemaPro data',
        'fields' => [
            'markup' => [
                'type' => 'String',
                'description' => 'SchemaPro markup',
            ],          
            'location' => [
                'type' => 'String',
                'description' => 'SchemaPro markup',
            ],          
        ],
    ]);

    register_graphql_field( 'RootQuery', 'schemaPro', [
        'type' => 'SchemaPro',
        'args' => [
            'postId' => [
                'type' => 'Integer',
                'description' => 'Page or post ID',
            ],
        ],
        'resolve' => function( $source, $args, $context, $info ) {                           
            if ( !class_exists('BSF_AIOSRS_Pro_Markup') ) {
                return;
            }

            if ( !isset($args['postId'] ) ) {
                return;
            }

            $post_id = $args['postId'];

            // needed to set state for get_the_id() call in schema_markup() below
            global $post;
            $post = get_post($post_id);    
            
            // needed to set state for get_schema_posts() call in schema_markup() below                                                
            global $wp_query;            
            $query_args = [];
            if ( $post->post_type === 'page' ) {
                $query_args['page_id'] = $args['postId'];
            } else {
                $query_args['p'] = $args['postId'];
            }
            $wp_query = new \WP_Query($query_args);
            
            // capture echos from SchemaPro actions
            ob_start();
            $schema_pro = \BSF_AIOSRS_Pro_Markup::get_instance();        
            $schema_pro->schema_markup();
            $schema_pro->global_schemas_markup();
            $markup = ob_get_clean();
            wp_reset_postdata();

            $settings = \BSF_AIOSRS_Pro_Helper::$settings['aiosrs-pro-settings'];
            			            
            return [
                'markup' => $markup, 
                'location' => $settings['schema-location']
            ];            
        }
    ] );
}

add_action('graphql_register_types', __NAMESPACE__ . '\\graphql_register_types');