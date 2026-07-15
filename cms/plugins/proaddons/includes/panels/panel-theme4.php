<?php

    /**
     * Theme-specific Options: Theme 4 (Mueller)
     */

    // Header background color
    Kirki::add_field( 'strappress_theme', [
      'type'        => 'color',
      'settings'    => 'theme_four_header_color_bg',
      'label'       => __( 'Header: Background Color', 'textdomain' ),
      'description' => esc_html__( 'Change header background color.', 'textdomain' ),
      'section'     => 'theme_select',
      'default'   => '#251d1c',
      'priority'  => 10,
      'transport' => 'auto',
      'choices'     => array(
        'alpha' => true,
      ),
      'output'    => array(
        array(
          'element'  => array('.header', '.nav-desktop .sub-menu', '.nav-desktop .sub-menu__footer', '.nav-mobile'),
          'property' => 'background-color',
          'suffix' => ' ',
        ),
        array(
          'element'  => array('.header--not-transparent'),
          'property' => 'background-color',
          'suffix' => '!important',
        ),
      ),
    ] );

    // Header Link color
    Kirki::add_field( 'strappress_theme', [
      'type'        => 'color',
      'settings'    => 'theme_four_header_links_color',
      'label'       => __( 'Header: Links Color', 'textdomain' ),
      'description' => esc_html__( 'Change header/nav link color.', 'textdomain' ),
      'section'     => 'theme_select',
      'default'   => '#ffffff',
      'priority'  => 10,
      'transport' => 'auto',
      'choices'     => array(
        'alpha' => true,
      ),
      'output'    => array(
        array(
          'element'  => array('.nav__inner li a', '.nav-mobile li a', '.nav-desktop .sub-menu__feat-title', '.nav-desktop .sub-menu h6'),
          'property' => 'color',
          'suffix' => ' !important',
        ),
      ),
    ] );

    // Header Link underline color
    Kirki::add_field( 'strappress_theme', [
      'type'        => 'color',
      'settings'    => 'theme_four_header_links_underline_color',
      'label'       => __( 'Header: Links Underline Color', 'textdomain' ),
      'description' => esc_html__( 'Change header/nav link underline on hover color.', 'textdomain' ),
      'section'     => 'theme_select',
      'default'   => Kirki::get_option( 'button_bg_color' ),
      'priority'  => 10,
      'transport' => 'auto',
      'choices'     => array(
        'alpha' => true,
      ),
      'output'    => array(
        array(
          'element'  => array('.nav__inner li a:before', '.nav__inner li.current-menu-item > a:before', '.elementor-214 .elementor-element.elementor-element-66e172b a:not(.elementor-icon ):before'),
          'property' => 'background-color',
          'suffix' => ' !important',
        ),
      ),
    ] );

    // CTA Button Color
    // Also sets color for ProWidgets Media Carousel
    // Also sets color for ProWidgets Accordion
    // Also sets color for various elementor items (dividers, icons, etc. )
    Kirki::add_field( 'strappress_theme', [
      'type'        => 'color',
      'settings'    => 'theme_four_header_cta_btn_color',
      'label'       => __( 'Header: CTA Button Color', 'textdomain' ),
      'description' => esc_html__( 'The CTA Button in menu. This will also control the various accent colors on global widgets.', 'textdomain' ),
      'section'     => 'theme_select',
      'default'   => Kirki::get_option( 'button_bg_color' ),
      'priority'  => 10,
      'transport' => 'auto',
      'choices'     => array(
        'alpha' => true,
      ),
      'output'    => array(
        array(
          'element'  => array('.sub-menu__footer a, .owl-dot.active'),
          'property' => 'background-color',
          //'suffix' => ' !important',
        ),
        array(
          'element'  => array('.owl-carousel .item .item-icon-wrap i + i, .owl-carousel .item-content-name-person, .owl-carousel .item-content-link, .premium-image-hotspots-icon, .video-broll-caption:before, .video-broll-thumbnail .fa-play, .elementor-widget-premium-addon-image-comparison .elementor-widget-heading:before'),
          'property' => 'color',
          'suffix' => ' !important',
        ),
        array(
          'element'  => array('.accordion-cell.collapsed, .accordion-cell .accordion-cell-btn-wrap:hover, .accordion-cell:hover .accordion-cell-btn-wrap, .accordion-cell .accordion-cell-title--has-hr:after, .premium-twentytwenty-handle'),
          'property' => 'background-color',
          'suffix' => ' !important',
        ),
        array(
          'element'  => array('.elementor-divider-separator'),
          'property' => 'border-top-color',
          'suffix' => ' !important',
        ),
      ),
    ] );

    // Social Media Icons toggle
    Kirki::add_field( 'strappress_theme', [
      'type'        => 'switch',
      'settings'    => 'theme_four_header_toggle_socials',
      'label'       => esc_html__( 'Header: Show Social Media Icons?', 'textdomain' ),
      'description' => esc_html__( 'Add social media icons to header.', 'textdomain' ),
      'section'     => 'theme_select',
      'default'     => 'on',
      'priority'    => 10,
      'choices'     => [
        'on'  => esc_html__( 'Enable', 'textdomain' ),
        'off' => esc_html__( 'Disable', 'textdomain' ),
      ],
    ] );

    // Social Media Icons: Facebook
    Kirki::add_field( 'strappress_theme', [
      'type'     => 'repeater',
      'label'    => esc_html__( 'Social Media Icons', 'textdomain' ),
      'default'  => esc_html__( '', 'textdomain' ),
      'section'  => 'theme_select',
      'priority' => 10,
      'row_label' => [
        'type'  => 'text',
        'value' => esc_html__('Social Icon', 'textdomain' ),
      ],
      'button_label' => esc_html__('Add New Social Icon', 'textdomain' ),
      'settings' => 'theme_four_header_toggle_social_repeater',
      'default'      => [
        [
          'link_text' => esc_html__( 'fa-facebook', 'textdomain' ),
          'link_url'  => 'https://facebook.com/',
        ],
        [
          'link_text' => esc_html__( 'fa-youtube', 'textdomain' ),
          'link_url'  => 'https://youtube.com/',
        ],
        [
          'link_text' => esc_html__( 'fa-google', 'textdomain' ),
          'link_url'  => 'https://google.com/',
        ],
      ],
      'fields' => [
        'link_text' => [
          'type'        => 'text',
          'label'       => esc_html__( 'Social Icon', 'textdomain' ),
          'description' => esc_html__( 'Find your icon code at: https://fontawesome.com/icons?d=gallery Ex. fa-facebook', 'textdomain' ),
          'default'     => 'fa-facebook',
        ],
        'link_url'  => [
          'type'        => 'text',
          'label'       => esc_html__( 'Link URL', 'textdomain' ),
          'description' => esc_html__( 'The URL to the page starting with https://', 'textdomain' ),
          'default'     => 'https://',
        ],
      ],
      'active_callback' => function() {
        $socials_on = get_theme_mod( 'theme_four_header_toggle_socials', false );

        if ($socials_on) {
          return true;
        }
        return false;

      },
    ] );



    // Translate toggle
    Kirki::add_field( 'strappress_theme', [
      'type'        => 'switch',
      'settings'    => 'theme_four_header_toggle_translate',
      'label'       => esc_html__( 'Header: Enable Language Translation?', 'textdomain' ),
      'description' => esc_html__( 'Requires "GTranslate" plugin activated.', 'textdomain' ),
      'section'     => 'theme_select',
      'default'     => 'off',
      'priority'    => 10,
      'choices'     => [
        'on'  => esc_html__( 'Enable', 'textdomain' ),
        'off' => esc_html__( 'Disable', 'textdomain' ),
      ],
    ] );


    // CTA Text
    Kirki::add_field( 'strappress_theme', [
      'type'     => 'text',
      'settings' => 'theme_four_header_cta_text',
      'label'    => esc_html__( 'Header: CTA Text', 'textdomain' ),
      'section'  => 'theme_select',
      'default'  => esc_html__( 'Request your consultation now', 'textdomain' ),
      'priority' => 10,
    ] );

    // CTA Button Text
    Kirki::add_field( 'strappress_theme', [
      'type'     => 'text',
      'settings' => 'theme_four_header_cta_btn_text',
      'label'    => esc_html__( 'Header: CTA Button Text', 'textdomain' ),
      'section'  => 'theme_select',
      'default'  => esc_html__( 'Get Started', 'textdomain' ),
      'priority' => 10,
    ] );


    // CTA Button Link
    Kirki::add_field( 'strappress_theme', [
      'type'     => 'link',
      'settings' => 'theme_four_header_cta_btn_link',
      'label'    => __( 'Header: CTA Button Link', 'textdomain' ),
      'section'  => 'theme_select',
      'default'  => 'https://site.com/contact',
      'priority' => 10,
    ] );
    
    // Media Carousel Logo
    // Set globally, but can override within widget options
    Kirki::add_field( 'strappress_theme', [
      'type'        => 'image',
      'settings'    => 'theme_four_carousel_logo',
      'label'       => esc_html__( 'Media Carousel Logo', 'kirki' ),
      'description' => esc_html__( 'Set the media carousel logo globally.', 'kirki' ),
      'section'     => 'theme_select',
      'default'     => '',
    ] );