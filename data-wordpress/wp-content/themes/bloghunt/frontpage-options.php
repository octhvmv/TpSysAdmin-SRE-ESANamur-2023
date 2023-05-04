<?php

/**
 * Option Panel
 *
 * @package Bloghunt
 */

function bloghunt_customize_register($wp_customize) {

$bloghunt_default = bloghunt_get_default_theme_options();


$wp_customize->add_setting(
    'slider_tabs',
    array(
        'default'           => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'esc_attr'
        ));


    $wp_customize->add_control( new Custom_Tab_Control ( $wp_customize,'slider_tabs',
        array(
            'label'                 => '',
            'type' => 'custom-tab-control',
            'section'               => 'frontpage_main_banner_section_settings',
            'controls_general'      => json_encode( array( '#customize-control-show_main_news_section', '#customize-control-main_banner_section_background_image','#customize-control-blogus_slider_image_overlay_color','#customize-control-blogus_slider_layout', '#customize-control-main_slider_section_title', '#customize-control-select_slider_news_category','#customize-control-slider_speed', '#customize-control-recent_post_section_title',  '#customize-control-select_recent_news_category' ) ),
                'controls_design'       => json_encode( array( '#customize-control-slider_overlay_enable','#customize-control-blogus_slider_overlay_color', '#customize-control-blogus_slider_overlay_text_color', '#customize-control-blogus_slider_title_font_size','#customize-control-slider_icon_enable','#customize-control-slider_meta_enable') ),
        )
            
        ));


        // Setting - show_main_news_section.
    $wp_customize->add_setting('show_main_news_section',
        array(
            'default' => $bloghunt_default['show_main_news_section'],
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'blogus_sanitize_checkbox',
        )
    );

    $wp_customize->add_control('show_main_news_section',
        array(
            'label' => esc_html__('Enable Slider Banner Section', 'bloghunt'),
            'section' => 'frontpage_main_banner_section_settings',
            'type' => 'checkbox',
            'priority' => 10,

        )
    ); 

    //section title
    $wp_customize->add_setting('recent_post_section_title',
        array(
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control(
        new Blogus_Section_Title(
            $wp_customize,
            'recent_post_section_title',
            array(
                'label'             => esc_html__( 'Recent Post Section', 'bloghunt' ),
                'section'           => 'frontpage_main_banner_section_settings',
                'priority'          => 100,
                'active_callback' => 'blogus_main_banner_section_status'
            )
        )
    );


    // Setting - drop down category for slider.
    $wp_customize->add_setting('select_recent_news_category',
        array(
            'default' => $bloghunt_default['select_recent_news_category'],
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'absint',
        )
    ); 
    $wp_customize->add_control(new Blogus_Dropdown_Taxonomies_Control($wp_customize, 'select_recent_news_category',
        array(
            'label' => esc_html__('Category', 'blogus'),
            'description' => esc_html__('Posts to be shown on recent 4 Post', 'blogus'),
            'section' => 'frontpage_main_banner_section_settings',
            'type' => 'dropdown-taxonomies',
            'taxonomy' => 'category',
            'priority' => 200,
            'active_callback' => 'blogus_main_banner_section_status',
        )));


    //SLider styling tabs
        $wp_customize->add_setting('slider_overlay_enable',
        array(
            'default' => true,
            'sanitize_callback' => 'blogus_sanitize_checkbox',
        )
        );
        $wp_customize->add_control(new blogus_Toggle_Control( $wp_customize, 'slider_overlay_enable', 
            array(
                'label' => esc_html__('Hide / Show Slider Overlay', 'bloghunt'),
                'type' => 'toggle',
                'section' => 'frontpage_main_banner_section_settings',
            )
        ));

        //slider Overlay 
       $wp_customize->add_setting(
            'blogus_slider_overlay_color', array( 'sanitize_callback' => 'sanitize_text_field','default' => '#00000099',
            
        ) );
        
        $wp_customize->add_control(new Blogus_Customize_Alpha_Color_Control( $wp_customize,'blogus_slider_overlay_color', array(
           'label'      => __('Overlay Color', 'bloghunt' ),
            'palette' => true,
            'section' => 'frontpage_main_banner_section_settings')
        ) );

        $wp_customize->add_setting(
        'blogus_slider_overlay_text_color', array( 'sanitize_callback' => 'sanitize_hex_color',
        
    ) );
    
    $wp_customize->add_control( 'blogus_slider_overlay_text_color', array(
       'label'      => __('Overlay Text Color', 'bloghunt' ),
        'type' => 'color',
        'section' => 'frontpage_main_banner_section_settings')
    );


        $wp_customize->add_setting('blogus_slider_title_font_size',
        array(
            'default'           => 38,
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
        )
    );

    $wp_customize->add_control('blogus_slider_title_font_size',
        array(
            'label'    => esc_html__('Slider title font Size', 'bloghunt'),
            'section'  => 'frontpage_main_banner_section_settings',
            'type'     => 'number',
        )
    );

    
    $wp_customize->add_setting('slider_meta_enable',
    array(
        'default' => true,
        'sanitize_callback' => 'blogus_sanitize_checkbox',
    )
    );
    $wp_customize->add_control(new blogus_Toggle_Control( $wp_customize, 'slider_meta_enable', 
        array(
            'label' => esc_html__('Hide / Show Meta', 'bloghunt'),
            'type' => 'toggle',
            'section' => 'frontpage_main_banner_section_settings',
        )
    ));
}
add_action('customize_register', 'bloghunt_customize_register');