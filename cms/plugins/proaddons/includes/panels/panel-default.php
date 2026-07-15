<?php

    /**
     * Add the theme configuration
     */
    
    Kirki::add_config( 'strappress_theme', array(
      'option_type' => 'theme_mod',
      'capability'  => 'edit_theme_options',
    ) );

    /**
     * Add the typography panels
     */
    Kirki::add_panel( 'typography', array(
      'title'      => esc_attr__( 'Typography', 'strappress' ),
      'priority'   => 2,
      'capability' => 'edit_theme_options',
    ) );

    Kirki::add_panel( 'colors', array(
      'title'      => esc_attr__( 'Colors', 'strappress' ),
      'priority'   => 2,
      'capability' => 'edit_theme_options',
    ) );

    Kirki::add_panel( 'theme', array(
      'priority'    => 3,
      'title'       => esc_html( __( 'Theme Options', 'strappress' ) ),
      'description' => esc_html( __( 'Add site/theme specific options', 'strappress' ) ),
    ) );

    /**
     * Add the typography sections
     */
    Kirki::add_section( 'typography_body_section', array(
      'title'      => esc_attr__( 'Body', 'strappress' ),
      'priority'   => 2,
      'capability' => 'edit_theme_options',
      'panel' => 'typography'
    ) );

    Kirki::add_section( 'typography_masthead_h2_section', array(
      'title'      => esc_attr__( 'Masthead', 'strappress' ),
      'priority'   => 2,
      'capability' => 'edit_theme_options',
      'panel' => 'typography'
    ) );

    Kirki::add_section( 'typography_h1_section', array(
      'title'      => esc_attr__( 'H1', 'strappress' ),
      'priority'   => 2,
      'capability' => 'edit_theme_options',
      'panel' => 'typography'
    ) );

    Kirki::add_section( 'typography_h2_section', array(
      'title'      => esc_attr__( 'H2', 'strappress' ),
      'priority'   => 2,
      'capability' => 'edit_theme_options',
      'panel' => 'typography'
    ) );

    Kirki::add_section( 'typography_h3_section', array(
      'title'      => esc_attr__( 'H3', 'strappress' ),
      'priority'   => 2,
      'capability' => 'edit_theme_options',
      'panel' => 'typography'
    ) );

    Kirki::add_section( 'typography_h4_section', array(
      'title'      => esc_attr__( 'H4', 'strappress' ),
      'priority'   => 2,
      'capability' => 'edit_theme_options',
      'panel' => 'typography'
    ) );

    Kirki::add_section( 'typography_h5_section', array(
      'title'      => esc_attr__( 'H5', 'strappress' ),
      'priority'   => 2,
      'capability' => 'edit_theme_options',
      'panel' => 'typography'
    ) );

    Kirki::add_section( 'typography_h5_section', array(
      'title'      => esc_attr__( 'H5', 'strappress' ),
      'priority'   => 2,
      'capability' => 'edit_theme_options',
      'panel' => 'typography'
    ) );

    Kirki::add_section( 'typography_button_section', array(
      'title'      => esc_attr__( 'H5', 'strappress' ),
      'priority'   => 2,
      'capability' => 'edit_theme_options',
      'panel' => 'typography'
    ) );

    Kirki::add_section( 'colors_page_section', array(
      'title'      => esc_attr__( 'Page', 'strappress' ),
      'priority'   => 2,
      'capability' => 'edit_theme_options',
      'panel' => 'colors'
    ) );

    Kirki::add_section( 'colors_buttons_section', array(
      'title'      => esc_attr__( 'Buttons', 'strappress' ),
      'priority'   => 2,
      'capability' => 'edit_theme_options',
      'panel' => 'colors'
    ) );



    /**
     * Add site sections 
     */
    Kirki::add_section( 'theme_select', array(
      'title'    => esc_html( __( 'Theme: Master 4 (Mueller)', 'strappress' ) ),
      'panel'    => 'theme',
      'priority' => 1,
    ) );

    /**
     * Add the body-typography control
     */
    Kirki::add_field( 'strappress_theme', array(
      'type'        => 'typography',
      'settings'    => 'body_typography',
      'label'       => esc_attr__( 'Desktop / Tablet', 'strappress' ),
      // 'description' => esc_attr__( 'Select the main typography options for your site.', 'strappress' ),
      // 'help'        => esc_attr__( 'The typography options you set here apply to all content on your site.', 'strappress' ),
      'section'     => 'typography_body_section',
      'priority'    => 10,
      'default'     => array(
        'font-family'    => 'Roboto',
        'variant'        => '400',
        'font-size'      => '16px',
        'line-height'    => '1.5',
        'letter-spacing' => '0',
        'color'          => '#333333',
        'text-transform' => ''
      ),
      'output' => array(
        array(
          'element' => 'body',
        ),
      ),
    ) );
    /**
     * Add the body-typography control
     */
    Kirki::add_field( 'strappress_theme', array(
      'type'        => 'typography',
      'settings'    => 'body_typography_mobile',
      'label'       => esc_attr__( 'Mobile', 'strappress' ),
      // 'description' => esc_attr__( 'Select the typography options for your headers.', 'strappress' ),
      // 'help'        => esc_attr__( 'The typography options you set here will override the Body Typography options for all headers on your site (post titles, widget titles etc).', 'strappress' ),
      'section'     => 'typography_body_section',
      'priority'    => 10,
      'default'     => array(
        'font-family'    => 'Roboto',
        'variant'        => '400',
        'font-size'      => '16px',
        'line-height'    => '1.5',
        'letter-spacing' => '0',
        'color'          => '#333333',
        'text-transform' => ''
      ),
      'output' => array(
        array(
          'element' => array( 'body' ),
          'media_query' => '@media (max-width: 768px)'
        ),
      ),
    ) );

    Kirki::add_field( 'strappress_theme', array(
      'type'        => 'typography',
      'settings'    => 'masthead_h2_typography',
      'label'       => esc_attr__( 'Desktop / Tablet', 'strappress' ),
      // 'description' => esc_attr__( 'Select the main typography options for your site.', 'strappress' ),
      // 'help'        => esc_attr__( 'The typography options you set here apply to all content on your site.', 'strappress' ),
      'section'     => 'typography_masthead_h2_section',
      'priority'    => 10,
      'default'     => array(
        'font-family'    => 'Roboto',
        'variant'        => '400',
        'font-size'      => '16px',
        'line-height'    => '1.5',
        'letter-spacing' => '0',
        'color'          => '#333333',
        'text-transform' => ''
      ),
      'output' => array(
        array(
          'element' => array( '.elementor-section-wrap > .elementor-section:first-child .elementor-widget-heading h2.elementor-heading-title' ),
        ),
      ),
    ) );
    /**
     * Add the body-typography control
     */
    Kirki::add_field( 'strappress_theme', array(
      'type'        => 'typography',
      'settings'    => 'masthead_h2_typography_mobile',
      'label'       => esc_attr__( 'Mobile', 'strappress' ),
      // 'description' => esc_attr__( 'Select the typography options for your headers.', 'strappress' ),
      // 'help'        => esc_attr__( 'The typography options you set here will override the Body Typography options for all headers on your site (post titles, widget titles etc).', 'strappress' ),
      'section'     => 'typography_masthead_h2_section',
      'priority'    => 10,
      'default'     => array(
        'font-family'    => 'Roboto',
        'variant'        => '400',
        'font-size'      => '16px',
        'line-height'    => '1.5',
        'letter-spacing' => '0',
        'color'          => '#333333',
        'text-transform' => ''
      ),
      'output' => array(
        array(
          'element' => array( '.elementor-section-wrap > .elementor-section:first-child .elementor-widget-heading h2.elementor-heading-title' ),
          'media_query' => '@media (max-width: 768px)'
        ),
      ),
    ) );

    /**
     * Add the body-typography control
     */
    Kirki::add_field( 'strappress_theme', array(
      'type'        => 'typography',
      'settings'    => 'h1_typography',
      'label'       => esc_attr__( 'Desktop / Tablet', 'strappress' ),
      // 'description' => esc_attr__( 'Select the main typography options for your site.', 'strappress' ),
      // 'help'        => esc_attr__( 'The typography options you set here apply to all content on your site.', 'strappress' ),
      'section'     => 'typography_h1_section',
      'priority'    => 10,
      'default'     => array(
        'font-family'    => 'Roboto',
        'variant'        => '400',
        'font-size'      => '16px',
        'line-height'    => '1.5',
        'letter-spacing' => '0',
        'color'          => '#333333',
        'text-transform' => ''
      ),
      'output' => array(
        array(
          'element' => array( 'h1', '.elementor-widget-heading h1.elementor-heading-title' ),
        ),
      ),
    ) );
    /**
     * Add the body-typography control
     */
    Kirki::add_field( 'strappress_theme', array(
      'type'        => 'typography',
      'settings'    => 'h1_typography_mobile',
      'label'       => esc_attr__( 'Mobile', 'strappress' ),
      // 'description' => esc_attr__( 'Select the typography options for your headers.', 'strappress' ),
      // 'help'        => esc_attr__( 'The typography options you set here will override the Body Typography options for all headers on your site (post titles, widget titles etc).', 'strappress' ),
      'section'     => 'typography_h1_section',
      'priority'    => 10,
      'default'     => array(
        'font-family'    => 'Roboto',
        'variant'        => '400',
        'font-size'      => '16px',
        'line-height'    => '1.5',
        'letter-spacing' => '0',
        'color'          => '#333333',
        'text-transform' => ''
      ),
      'output' => array(
        array(
          'element' => array( 'h1', '.elementor-widget-heading h1.elementor-heading-title' ),
          'media_query' => '@media (max-width: 768px)'
        ),
      ),
    ) );

  
    Kirki::add_field( 'strappress_theme', array(
      'type'        => 'typography',
      'settings'    => 'h2_typography',
      'label'       => esc_attr__( 'Desktop / Tablet', 'strappress' ),
      // 'description' => esc_attr__( 'Select the main typography options for your site.', 'strappress' ),
      // 'help'        => esc_attr__( 'The typography options you set here apply to all content on your site.', 'strappress' ),
      'section'     => 'typography_h2_section',
      'priority'    => 10,
      'default'     => array(
        'font-family'    => 'Roboto',
        'variant'        => '400',
        'font-size'      => '16px',
        'line-height'    => '1.5',
        'letter-spacing' => '0',
        'color'          => '#333333',
        'text-transform' => ''
      ),
      'output' => array(
        array(
          'element' => array( 'h2', '.elementor-widget-heading h2.elementor-heading-title' ),
        ),
      ),
    ) );
    /**
     * Add the body-typography control
     */
    Kirki::add_field( 'strappress_theme', array(
      'type'        => 'typography',
      'settings'    => 'h2_typography_mobile',
      'label'       => esc_attr__( 'Mobile', 'strappress' ),
      // 'description' => esc_attr__( 'Select the typography options for your headers.', 'strappress' ),
      // 'help'        => esc_attr__( 'The typography options you set here will override the Body Typography options for all headers on your site (post titles, widget titles etc).', 'strappress' ),
      'section'     => 'typography_h2_section',
      'priority'    => 10,
      'default'     => array(
        'font-family'    => 'Roboto',
        'variant'        => '400',
        'font-size'      => '16px',
        'line-height'    => '1.5',
        'letter-spacing' => '0',
        'color'          => '#333333',
        'text-transform' => ''
      ),
      'output' => array(
        array(
          'element' => array( 'h2', '.elementor-widget-heading h2.elementor-heading-title' ),
          'media_query' => '@media (max-width: 768px)'
        ),
      ),
    ) );

  
    Kirki::add_field( 'strappress_theme', array(
      'type'        => 'typography',
      'settings'    => 'h3_typography',
      'label'       => esc_attr__( 'Desktop / Tablet', 'strappress' ),
      // 'description' => esc_attr__( 'Select the main typography options for your site.', 'strappress' ),
      // 'help'        => esc_attr__( 'The typography options you set here apply to all content on your site.', 'strappress' ),
      'section'     => 'typography_h3_section',
      'priority'    => 10,
      'default'     => array(
        'font-family'    => 'Roboto',
        'variant'        => '400',
        'font-size'      => '16px',
        'line-height'    => '1.5',
        'letter-spacing' => '0',
        'color'          => '#333333',
        'text-transform' => ''
      ),
      'output' => array(
        array(
          'element' => array( 'h3', '.elementor-widget-heading h3.elementor-heading-title' ),
        ),
      ),
    ) );
    /**
     * Add the body-typography control
     */
    Kirki::add_field( 'strappress_theme', array(
      'type'        => 'typography',
      'settings'    => 'h3_typography_mobile',
      'label'       => esc_attr__( 'Mobile', 'strappress' ),
      // 'description' => esc_attr__( 'Select the typography options for your headers.', 'strappress' ),
      // 'help'        => esc_attr__( 'The typography options you set here will override the Body Typography options for all headers on your site (post titles, widget titles etc).', 'strappress' ),
      'section'     => 'typography_h3_section',
      'priority'    => 10,
      'default'     => array(
        'font-family'    => 'Roboto',
        'variant'        => '400',
        'font-size'      => '16px',
        'line-height'    => '1.5',
        'letter-spacing' => '0',
        'color'          => '#333333',
        'text-transform' => ''
      ),
      'output' => array(
        array(
          'element' => array( 'h3', '.elementor-widget-heading h3.elementor-heading-title' ),
          'media_query' => '@media (max-width: 768px)'
        ),
      ),
    ) );

      
    Kirki::add_field( 'strappress_theme', array(
      'type'        => 'typography',
      'settings'    => 'h4_typography',
      'label'       => esc_attr__( 'Desktop / Tablet', 'strappress' ),
      // 'description' => esc_attr__( 'Select the main typography options for your site.', 'strappress' ),
      // 'help'        => esc_attr__( 'The typography options you set here apply to all content on your site.', 'strappress' ),
      'section'     => 'typography_h4_section',
      'priority'    => 10,
      'default'     => array(
        'font-family'    => 'Roboto',
        'variant'        => '400',
        'font-size'      => '16px',
        'line-height'    => '1.5',
        'letter-spacing' => '0',
        'color'          => '#333333',
        'text-transform' => ''
      ),
      'output' => array(
        array(
          'element' => array( 'h4', '.elementor-widget-heading h4.elementor-heading-title' ),
        ),
      ),
    ) );
    /**
     * Add the body-typography control
     */
    Kirki::add_field( 'strappress_theme', array(
      'type'        => 'typography',
      'settings'    => 'h4_typography_mobile',
      'label'       => esc_attr__( 'Mobile', 'strappress' ),
      // 'description' => esc_attr__( 'Select the typography options for your headers.', 'strappress' ),
      // 'help'        => esc_attr__( 'The typography options you set here will override the Body Typography options for all headers on your site (post titles, widget titles etc).', 'strappress' ),
      'section'     => 'typography_h4_section',
      'priority'    => 10,
      'default'     => array(
        'font-family'    => 'Roboto',
        'variant'        => '400',
        'font-size'      => '16px',
        'line-height'    => '1.5',
        'letter-spacing' => '0',
        'color'          => '#333333',
        'text-transform' => ''
      ),
      'output' => array(
        array(
          'element' => array( 'h4', '.elementor-widget-heading h4.elementor-heading-title' ),
          'media_query' => '@media (max-width: 768px)'
        ),
      ),
    ) );

     
    Kirki::add_field( 'strappress_theme', array(
      'type'        => 'typography',
      'settings'    => 'h5_typography',
      'label'       => esc_attr__( 'Desktop / Tablet', 'strappress' ),
      // 'description' => esc_attr__( 'Select the main typography options for your site.', 'strappress' ),
      // 'help'        => esc_attr__( 'The typography options you set here apply to all content on your site.', 'strappress' ),
      'section'     => 'typography_h5_section',
      'priority'    => 10,
      'default'     => array(
        'font-family'    => 'Roboto',
        'variant'        => '400',
        'font-size'      => '16px',
        'line-height'    => '1.5',
        'letter-spacing' => '0',
        'color'          => '#333333',
        'text-transform' => ''
      ),
      'output' => array(
        array(
          'element' => array( 'h5', '.elementor-widget-heading h5.elementor-heading-title' ),
        ),
      ),
    ) );
    /**
     * Add the body-typography control
     */
    Kirki::add_field( 'strappress_theme', array(
      'type'        => 'typography',
      'settings'    => 'h5_typography_mobile',
      'label'       => esc_attr__( 'Mobile', 'strappress' ),
      // 'description' => esc_attr__( 'Select the typography options for your headers.', 'strappress' ),
      // 'help'        => esc_attr__( 'The typography options you set here will override the Body Typography options for all headers on your site (post titles, widget titles etc).', 'strappress' ),
      'section'     => 'typography_h5_section',
      'priority'    => 10,
      'default'     => array(
        'font-family'    => 'Roboto',
        'variant'        => '400',
        'font-size'      => '16px',
        'line-height'    => '1.5',
        'letter-spacing' => '0',
        'color'          => '#333333',
        'text-transform' => ''
      ),
      'output' => array(
        array(
          'element' => array( 'h5', '.elementor-widget-heading h5.elementor-heading-title' ),
          'media_query' => '@media (max-width: 768px)'
        ),
      ),
    ) );

  
    Kirki::add_field( 'strappress_theme', array(
      'type'        => 'typography',
      'settings'    => 'h6_typography',
      'label'       => esc_attr__( 'Desktop / Tablet', 'strappress' ),
      // 'description' => esc_attr__( 'Select the main typography options for your site.', 'strappress' ),
      // 'help'        => esc_attr__( 'The typography options you set here apply to all content on your site.', 'strappress' ),
      'section'     => 'typography_h6_section',
      'priority'    => 10,
      'default'     => array(
        'font-family'    => 'Roboto',
        'variant'        => '400',
        'font-size'      => '16px',
        'line-height'    => '1.5',
        'letter-spacing' => '0',
        'color'          => '#333333',
        'text-transform' => ''
      ),
      'output' => array(
        array(
          'element' => array( 'h6', '.elementor-widget-heading h6.elementor-heading-title' ),
        ),
      ),
    ) );
    /**
     * Add the body-typography control
     */
    Kirki::add_field( 'strappress_theme', array(
      'type'        => 'typography',
      'settings'    => 'h6_typography_mobile',
      'label'       => esc_attr__( 'Mobile', 'strappress' ),
      // 'description' => esc_attr__( 'Select the typography options for your headers.', 'strappress' ),
      // 'help'        => esc_attr__( 'The typography options you set here will override the Body Typography options for all headers on your site (post titles, widget titles etc).', 'strappress' ),
      'section'     => 'typography_h6_section',
      'priority'    => 10,
      'default'     => array(
        'font-family'    => 'Roboto',
        'variant'        => '400',
        'font-size'      => '16px',
        'line-height'    => '1.5',
        'letter-spacing' => '0',
        'color'          => '#333333',
        'text-transform' => ''
      ),
      'output' => array(
        array(
          'element' => array( 'h6', '.elementor-widget-heading h6.elementor-heading-title' ),
          'media_query' => '@media (max-width: 768px)'
        ),
      ),
    ) );


    Kirki::add_field( 'strappress_theme', array(
      'type'        => 'typography',
      'settings'    => 'button_typography',
      'label'       => esc_attr__( 'Desktop / Tablet', 'strappress' ),
      // 'description' => esc_attr__( 'Select the main typography options for your site.', 'strappress' ),
      // 'help'        => esc_attr__( 'The typography options you set here apply to all content on your site.', 'strappress' ),
      'section'     => 'typography_button_section',
      'priority'    => 10,
      'default'     => array(
        'font-family'    => 'Roboto',
        'variant'        => '400',
        'font-size'      => '16px',
        'line-height'    => '1.5',
        'letter-spacing' => '0',
        'color'          => '#333333',
        'text-transform' => ''
      ),
      'output' => array(
        array(
          'element' => array( '.elementor-button' ),
        ),
      ),
    ) );
    /**
     * Add the body-typography control
     */
    Kirki::add_field( 'strappress_theme', array(
      'type'        => 'typography',
      'settings'    => 'button_typography_mobile',
      'label'       => esc_attr__( 'Mobile', 'strappress' ),
      // 'description' => esc_attr__( 'Select the typography options for your headers.', 'strappress' ),
      // 'help'        => esc_attr__( 'The typography options you set here will override the Body Typography options for all headers on your site (post titles, widget titles etc).', 'strappress' ),
      'section'     => 'typography_button_section',
      'priority'    => 10,
      'default'     => array(
        'font-family'    => 'Roboto',
        'variant'        => '400',
        'font-size'      => '16px',
        'line-height'    => '1.5',
        'letter-spacing' => '0',
        'color'          => '#333333',
        'text-transform' => ''
      ),
      'output' => array(
        array(
          'element' => array( '.elementor-button' ),
          'media_query' => '@media (max-width: 768px)'
        ),
      ),
    ) );


    Kirki::add_field( 'strappress_theme', array(
      'type'      => 'color',
      'settings'  => 'page_bg_color',
      'label'     => __( 'BG Color', 'mytheme' ),
      'section'   => 'colors_page_section',
      'default'   => '#FFFFFF',
      'priority'  => 10,
      'transport' => 'auto',
      'choices'     => array(
        'alpha' => true,
      ),
      'output'    => array(
        array(
          'element'  => 'body',
          'property' => 'background-color'
        ),
      ),
    ) );

    Kirki::add_field( 'strappress_theme', array(
      'type'      => 'color',
      'settings'  => 'link_color',
      'label'     => __( 'Link Color', 'mytheme' ),
      'section'   => 'colors_page_section',
      'default'   => '',
      'priority'  => 10,
      'transport' => 'auto',
      'choices'     => array(
        'alpha' => true,
      ),
      'output'    => array(
        array(
          'element'  => 'a',
          'property' => 'color'
        ),
      ),
    ) );

    Kirki::add_field( 'strappress_theme', array(
      'type'      => 'color',
      'settings'  => 'link_hover_color',
      'label'     => __( 'Link Hover Color', 'mytheme' ),
      'section'   => 'colors_page_section',
      'default'   => '',
      'priority'  => 10,
      'transport' => 'auto',
      'choices'     => array(
        'alpha' => true,
      ),
      'output'    => array(
        array(
          'element'  => array( 'a:hover', 'a:focus' ),
          'property' => 'color'
        ),
      ),
    ) );

    Kirki::add_field( 'strappress_theme', array(
      'type'      => 'color',
      'settings'  => 'link_hover_color',
      'label'     => __( 'Link Hover Color', 'mytheme' ),
      'section'   => 'colors_page_section',
      'default'   => '',
      'priority'  => 10,
      'transport' => 'auto',
      'choices'     => array(
        'alpha' => true,
      ),
      'output'    => array(
        array(
          'element'  => array( 'a:hover', 'a:focus' ),
          'property' => 'color'
        ),
      ),
    ) );

    Kirki::add_field( 'strappress_theme', array(
      'type'      => 'color',
      'settings'  => 'button_text_color',
      'label'     => __( 'Text Color', 'mytheme' ),
      'section'   => 'colors_buttons_section',
      'default'   => '',
      'priority'  => 10,
      'transport' => 'auto',
      'choices'     => array(
        'alpha' => true,
      ),
      'output'    => array(
        array(
          'element'  => array( '.elementor-button' ),
          'property' => 'color'
        ),
      ),
    ) );

    Kirki::add_field( 'strappress_theme', array(
      'type'      => 'color',
      'settings'  => 'button_hover_text_color',
      'label'     => __( 'Hover Text Color', 'mytheme' ),
      'section'   => 'colors_buttons_section',
      'default'   => '',
      'priority'  => 10,
      'transport' => 'auto',
      'choices'     => array(
        'alpha' => true,
      ),
      'output'    => array(
        array(
          'element'  => array( '.elementor-button:hover', '.elementor-button:focus', '.elementor-button:active' ),
          'property' => 'color'
        ),
      ),
    ) );

    Kirki::add_field( 'strappress_theme', array(
      'type'      => 'color',
      'settings'  => 'button_bg_color',
      'label'     => __( 'BG Color', 'mytheme' ),
      'section'   => 'colors_buttons_section',
      'default'   => '',
      'priority'  => 10,
      'transport' => 'auto',
      'choices'     => array(
        'alpha' => true,
      ),
      'output'    => array(
        array(
          'element'  => array( '.elementor-button' ),
          'property' => 'background-color'
        ),
      ),
    ) );

    Kirki::add_field( 'strappress_theme', array(
      'type'      => 'color',
      'settings'  => 'button_hover_bg_color',
      'label'     => __( 'BG Hover Color', 'mytheme' ),
      'section'   => 'colors_buttons_section',
      'default'   => '',
      'priority'  => 10,
      'transport' => 'auto',
      'choices'     => array(
        'alpha' => true,
      ),
      'output'    => array(
        array(
          'element'  => array( '.elementor-button:hover', '.elementor-button:focus', '.elementor-button:active' ),
          'property' => 'background-color'
        ),
      ),
    ) );
