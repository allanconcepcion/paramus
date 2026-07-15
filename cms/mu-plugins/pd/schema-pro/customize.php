<?php

/*
 * Version 3.1
 *
 * Change Log:
 *
 *
 * 3.1 Commented out the @type='Dentist' within the nested review. Google's rich snippet tool was reading it as a  * separate Google My Business listing, effectively causing all the listings to be duplicates.
 *
 * 3.0 Removed the Geo coordinates from our custom fields since they have been added into the plugin itself
 *
 *
 *  
 *  - Guru Urulurulru C.U.
 *
 *
 *
 */
// Add Custom Fields to Schema Pro
add_action( 'after_setup_theme', 'add_custom_meta_field' );
function add_custom_meta_field() {
//Removed the line below since the fields are now integrated within the plugin
/*  add_filter( 'wp_schema_pro_schema_meta_fields', 'geo_fields' );     */ 
    add_filter( 'wp_schema_pro_schema_meta_fields', 'review_fields' );
    add_filter( 'wp_schema_pro_schema_meta_fields', 'medical_specialty' );
    add_filter( 'wp_schema_pro_schema_meta_fields', 'social_profiles' );
    add_filter( 'wp_schema_pro_schema_local_business', 'my_extra_schema_field_mapping', 10, 3 );
}

/**
 * Add fields for mapping.
 *
 * @param  array $fields Mapping fields array.
 * @return array
 
function geo_fields( $fields ) {
    $fields['bsf-aiosrs-local-business']['subkeys']['geo-location'] = array(
        'label'    => esc_html__( 'Geo Coordinates:', 'wp-schema-pro' ),
        'type'     => 'none', // text/date/image
        'default'  => 'null',
        'required' => false, // true/false.
    );
    $fields['bsf-aiosrs-local-business']['subkeys']['Latitude'] = array(
        'label'    => esc_html__( 'Latitude', 'wp-schema-pro' ),
        'type'     => 'text', // text/date/image
        'default'  => 'custom-text',
        'required' => true, // true/false.
    );
    $fields['bsf-aiosrs-local-business']['subkeys']['Longitude'] = array(
        'label'    => esc_html__( 'Longitude', 'wp-schema-pro' ),
        'type'     => 'text', // text/date/image
        'default'  => 'custom-text',
        'required' => true, // true/false.
    );
    return $fields;
}
*/ //Removed these fields as they are no longer necessary

function review_fields( $fields ) {
    $fields['bsf-aiosrs-local-business']['subkeys']['review-date'] = array(
        'label'    => esc_html__( 'Date Published', 'wp-schema-pro' ),
        'type'     => 'text', // text/date/image
        'placeholder' => 'YYYY-MM-DD or YYYY-MM',
        'default'  => 'custom-text',
        'required' => true, // true/false.
    );
    $fields['bsf-aiosrs-local-business']['subkeys']['author-name'] = array(
        'label'    => esc_html__( 'Review Author', 'wp-schema-pro' ),
        'type'     => 'text', // text/date/image
        'default'  => 'custom-text',
        'required' => true, // true/false.
    );
    $fields['bsf-aiosrs-local-business']['subkeys']['rating-value'] = array(
        'label'    => esc_html__( 'Review Rating', 'wp-schema-pro' ),
        'type'     => 'text', // text/date/image
        'placeholder' => 'i.e 1-5',
        'default'  => 'custom-text',
        'required' => false, // true/false.
    );
    $fields['bsf-aiosrs-local-business']['subkeys']['highest-rating'] = array(
        'label'    => esc_html__( 'Highest Possible Rating', 'wp-schema-pro' ),
        'type'     => 'text', // text/date/image
        'default'  => 'custom-text',
        'required' => false, // true/false.
    );
    $fields['bsf-aiosrs-local-business']['subkeys']['lowest-rating'] = array(
        'label'    => esc_html__( 'Lowest Possible Rating', 'wp-schema-pro' ),
        'type'     => 'text', // text/date/image
        'default'  => 'custom-text',
        'required' => false, // true/false.
    );
    $fields['bsf-aiosrs-local-business']['subkeys']['review-body'] = array(
        'label'    => esc_html__( 'The Review Body', 'wp-schema-pro' ),
        'type'     => 'text', // text/date/image
        'placeholder' => 'Copy and paste the entire review in here',
        'default'  => 'custom-text',
        'required' => true, // true/false.
    );
    $fields['bsf-aiosrs-local-business']['subkeys']['publisher-name'] = array(
        'label'    => esc_html__( 'Review Publisher', 'wp-schema-pro' ),
        'type'     => 'text', // text/date/image
        'default'  => 'custom-text',
        'required' => false, // true/false.
    );
    $fields['bsf-aiosrs-local-business']['subkeys']['item-reviewed'] = array(
        'label'    => esc_html__( 'Enter Business Name Here', 'wp-schema-pro' ),
        'type'     => 'text', // text/date/image
        'placeholder' => 'Dr Name/Practice Name',
        'default'  => 'custom-text',
        'required' => false, // true/false.
    );
    $fields['bsf-aiosrs-local-business']['subkeys']['phone-number'] = array(
        'label'    => esc_html__( 'Office Number', 'wp-schema-pro' ),
        'type'     => 'text', // text/date/image
        'placeholder' => 'The primary number for the office',
        'default'  => 'custom-text',
        'required' => false, // true/false.
    );
    $fields['bsf-aiosrs-local-business']['subkeys']['review-image'] = array(
        'label'    => esc_html__( 'Review Image', 'wp-schema-pro' ),
        'type'     => 'image', // text/date/image
        'placeholder' => 'Image of what is being reviewed',
        'default'  => 'null',
        'required' => true, // true/false.
    );
    return $fields;
}
function medical_specialty( $fields ) {
    $fields['bsf-aiosrs-local-business']['subkeys']['medical-specialty'] = array(
        'label'    => esc_html__( 'Medical Specialty', 'wp-schema-pro' ),
        'type'     => 'text', // text/date/image
        'placeholder' => 'If Applicable',
        'default'  => 'custom-text',
        'required' => false, // true/false.
    );  
    $fields['bsf-aiosrs-local-business']['subkeys']['listing-description'] = array(
        'label'    => esc_html__( 'Business Description', 'wp-schema-pro' ),
        'type'     => 'text', // text/date/image
        'placeholder' => 'If Applicable',
        'default'  => 'custom-text',
        'required' => false, // true/false.
    );
    return $fields;
}
function social_profiles( $fields ) {
    $fields['bsf-aiosrs-local-business']['subkeys']['youtube-link'] = array(
        'label'    => esc_html__( 'YouTube Link', 'wp-schema-pro' ),
        'type'     => 'text', // text/date/image
        'placeholder' => 'If Applicable',
        'default'  => 'custom-text',
        'required' => false, // true/false.
    );
    $fields['bsf-aiosrs-local-business']['subkeys']['facebook-link'] = array(
        'label'    => esc_html__( 'Facebook Link', 'wp-schema-pro' ),
        'type'     => 'text', // text/date/image
        'placeholder' => 'If Applicable',
        'default'  => 'custom-text',
        'required' => false, // true/false.
    );
    $fields['bsf-aiosrs-local-business']['subkeys']['instagram-link'] = array(
        'label'    => esc_html__( 'Instagram Link', 'wp-schema-pro' ),
        'type'     => 'text', // text/date/image
        'placeholder' => 'If Applicable',
        'default'  => 'custom-text',
        'required' => false, // true/false.
    );
    $fields['bsf-aiosrs-local-business']['subkeys']['yelp-link'] = array(
        'label'    => esc_html__( 'Yelp Link', 'wp-schema-pro' ),
        'type'     => 'text', // text/date/image
        'placeholder' => 'If Applicable',
        'default'  => 'custom-text',
        'required' => false, // true/false.
    );
    $fields['bsf-aiosrs-local-business']['subkeys']['linkedin-link'] = array(
        'label'    => esc_html__( 'LinkedIn Link', 'wp-schema-pro' ),
        'type'     => 'text', // text/date/image
        'placeholder' => 'If Applicable',
        'default'  => 'custom-text',
        'required' => false, // true/false.
    );
    $fields['bsf-aiosrs-local-business']['subkeys']['gmb-link'] = array(
        'label'    => esc_html__( 'Google My Business Map Link', 'wp-schema-pro' ),
        'type'     => 'text', // text/date/image
        'placeholder' => 'If Applicable',
        'default'  => 'custom-text',
        'required' => false, // true/false.
    );
    return $fields;  
}
   
/**
 * Mapping extra field for schema markup.
 *
 * @param  array $schema Schema array.
 * @param  array $data   Mapping fields array.
 * @return array
 */
function my_extra_schema_field_mapping( $schema, $data, $post ) {
/*
 * Geo Location Fields and Mapping
 
    if ( ( isset( $data['Latitude'] ) && ! empty( $data['Latitude'] ) ) ||
    ( isset( $data['Longitude'] ) && ! empty( $data['Longitude'] ) ) ){
        $schema['geo']['@type'] = 'GeoCoordinates';
        $schema['geo']['latitude'] = esc_html( $data['Latitude'] );
        $schema['geo']['longitude'] = esc_html( $data['Longitude'] );
    }
*/ // Removed the above fields as they are no longer necessary
/*
 * Review fields and Mapping
 */
    if ( ( isset( $data['item-reviewed-name']) && ! empty( $data['item-reviewed-name'] ) ) ||
         ( isset( $data['medical-specialty']) && ! empty( $data['medical-specialty'] ) ) ||
         ( isset( $data['phone-number']) && ! empty( $data['phone-number'] ) ) ||
         ( isset( $data['review-date']) && ! empty( $data['review-date'] ) ) ||
         ( isset( $data['author-name']) && ! empty( $data['author-name'] ) ) ||
         ( isset( $data['rating-value']) && ! empty( $data['rating-value'] ) ) ||
         ( isset( $data['highest-rating']) && ! empty( $data['highest-rating'] ) ) ||
         ( isset( $data['lowest-rating']) && ! empty( $data['lowest-rating'] ) ) ||
         ( isset( $data['review-body']) && ! empty( $data['review-body'] ) ) ||
         ( isset( $data['publisher-name']) && ! empty( $data['publisher-name'] ) ) ||
         ( isset( $data['review-image']) && ! empty( $data['review-image'] ) ) ) {
       
            $schema['review']['@type']= 'Review';
       
            if ( isset( $data['review-date']) && ! empty( $data['review-date'] ) ){
                $schema['review']['datePublished']= esc_html( $data['review-date'] );
            }
            if(  ( isset( $data['item-reviewed']) && ! empty( $data['item-reviewed'] ) ) ||
            ( isset( $data['phone-number']) && ! empty( $data['phone-number'] ) ) ||
            ( isset( $data['medical-specialty']) && ! empty( $data['medical-specialty'] )) ){
// Commented out the line below that was causing Google's Rich Results Test to pick up duplicate listings
        /*    $schema['review']['itemReviewed']['@type']= 'Dentist';  */
              $schema['review']['itemReviewed']['name']= esc_html( $data['item-reviewed'] );
            }
            if ( isset( $data['medical-specialty']) && ! empty( $data['medical-specialty'] )){
                $schema['review']['itemReviewed']['medicalSpecialty']= esc_html( $data['medical-specialty'] );
            }
            $schema['review']['itemReviewed']['isAcceptingNewPatients']= 'true';
            if ( isset( $data['phone-number']) && ! empty( $data['phone-number'] ) ) {
                $schema['review']['itemReviewed']['telephone']= esc_html( $data['phone-number'] );
            }

/*
 * Review location mapping
 */
            if ( isset( $data['location-street'] ) && ! empty( $data['location-street'] ) ){

                $schema['review']['itemReviewed']['address']['streetAddress'] = wp_strip_all_tags( $data['location-street'] );

                if ( isset( $data['location-locality'] ) && ! empty( $data['location-locality'] ) ) {
                    $schema['review']['itemReviewed']['address']['addressLocality'] = wp_strip_all_tags( $data['location-locality'] );
                }
                if ( isset( $data['location-postal'] ) && ! empty( $data['location-postal'] ) ) {
                    $schema['review']['itemReviewed']['address']['postalCode'] = wp_strip_all_tags( $data['location-postal'] );
                }
                if ( isset( $data['location-region'] ) && ! empty( $data['location-region'] ) ) {
                    $schema['review']['itemReviewed']['address']['addressRegion'] = wp_strip_all_tags( $data['location-region'] );
                }
                if ( isset( $data['location-country'] ) && ! empty( $data['location-country'] ) ) {
                    $schema['review']['itemReviewed']['address']['addressCountry'] = wp_strip_all_tags( $data['location-country'] );
                }
            }
            if ( isset( $data['image'] ) && ! empty( $data['image'] ) ) {
                $schema['review']['itemReviewed']['image'] = BSF_AIOSRS_Pro_Schema_Template::get_image_schema( $data['image'] );
            }   
            if ( isset( $data['author-name']) && ! empty( $data['author-name'] ) ){
                $schema['review']['author']['@type']= 'Person';
                $schema['review']['author']['name']= esc_html( $data['author-name'] );
            }
/*
 * Review rating mapping
 */
            if ( ( isset( $data['rating-value']) && ! empty( $data['rating-value'] ) ) ||
            ( isset( $data['highest-rating']) && ! empty( $data['highest-rating'] ) ) ||
            ( isset( $data['lowest-rating']) && ! empty( $data['lowest-rating'] ) ) ){
                $schema['review']['reviewRating']['@type']= 'Rating';
                if ( isset( $data['rating-value']) && ! empty( $data['rating-value'] ) ) {
                    $schema['review']['reviewRating']['ratingValue']= esc_html( $data['rating-value'] );
                }
                if ( isset( $data['highest-rating']) && ! empty( $data['highest-rating'] ) ){
                    $schema['review']['reviewRating']['bestRating']= esc_html( $data['highest-rating'] );
                }
                if ( isset( $data['lowest-rating']) && ! empty( $data['lowest-rating'] ) ){
                    $schema['review']['reviewRating']['worstRating']= esc_html( $data['lowest-rating'] );
                }
            }
            if ( isset( $data['review-body']) && ! empty( $data['review-body'] ) ){
                $schema['review']['reviewBody']= esc_html( $data['review-body'] );
            }
/*
 * Review price range/specialty/image addition - added to fix warning that showed in the google structured data testing tool
 */    
            $schema['review']['itemReviewed']['priceRange'] = esc_html( $data['price-range'] );
            if ( isset( $data['publisher-name']) && ! empty( $data['publisher-name'] )){
                $schema['review']['publisher']['@type']= 'Organization';
                $schema['review']['publisher']['name']= esc_html( $data['publisher-name'] );
            }
            if ( isset( $data['medical-specialty']) && ! empty( $data['medical-specialty'] )){
                $schema['medicalSpecialty']= esc_html( $data['medical-specialty'] );
            }
        }
/*
 * "Same As" / a.k.a. Social Profiles
 */
        if ( ( isset( $data['youtube-link'] ) && ! empty( $data['youtube-link'] ) ) ||
        ( isset( $data['facebook-link'] ) && ! empty( $data['facebook-link'] ) ) ||
        ( isset( $data['instagram-link'] ) && ! empty( $data['instagram-link'] ) ) ||
        ( isset( $data['yelp-link'] ) && ! empty( $data['yelp-link'] ) ) ||
        ( isset( $data['gmb-link'] ) && ! empty( $data['gmb-link'] ) ) ) {
            $schema['sameAs'][] = esc_html( $data['youtube-link'] );
            $schema['sameAs'][] = esc_html( $data['facebook-link'] );
            $schema['sameAs'][] = esc_html( $data['instagram-link'] );
            $schema['sameAs'][] = esc_html( $data['yelp-link'] );
            $schema['hasMap'][] = esc_html( $data['gmb-link'] );
        }
   
/*
 * Description Field added to the local business schema
 */
        if ( isset( $data['listing-description'] ) && ! empty( $data['listing-description'] ) ) {
            $schema['description'][] = esc_html( $data['listing-description'] );
        }
    return $schema;
}

/*
 * End Schema Pro Custom Fields
 */