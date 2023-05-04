<?php
/**
 * Theme functions and definitions
 *
 * @package Bloghunt
 */

if ( ! function_exists( 'bloghunt_enqueue_styles' ) ) :
	/**
	 * @since 0.1
	 */
	function bloghunt_enqueue_styles() {
		wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css');
		wp_enqueue_style( 'blogus-style-parent', get_template_directory_uri() . '/style.css' );
		wp_enqueue_style( 'bloghunt-style', get_stylesheet_directory_uri() . '/style.css', array( 'blogus-style-parent' ), '1.0' );
		wp_dequeue_style( 'blogus-default',get_template_directory_uri() .'/css/colors/default.css');
		wp_enqueue_style( 'bloghunt-default-css', get_stylesheet_directory_uri()."/css/colors/default.css" );
		//wp_enqueue_style( 'bloghunt-dark', get_template_directory_uri() . '/css/colors/dark.css');

		if(is_rtl()){
		wp_enqueue_style( 'blogus_style_rtl', trailingslashit( get_template_directory_uri() ) . 'style-rtl.css' );
	    }
		
	}

endif;
add_action( 'wp_enqueue_scripts', 'bloghunt_enqueue_styles', 9999 );

add_action( 'customize_register', 'bloghunt_customizer_rid_values', 1000 );
function bloghunt_customizer_rid_values($wp_customize) {

  $wp_customize->remove_control('blogus_content_layout');   

 }


 function bloghunt_theme_setup() {

//Load text domain for translation-ready
load_theme_textdomain('bloghunt', get_stylesheet_directory() . '/languages');

require( get_stylesheet_directory() . '/hooks/hook-front-page-main-banner-section.php' );
require( get_stylesheet_directory() . '/customizer-default.php' );
require( get_stylesheet_directory() . '/frontpage-options.php' );

} 
add_action( 'after_setup_theme', 'bloghunt_theme_setup' );


if (!function_exists('bloghunt_get_block')) :
    /**
     *
     *
     * @since Bloghunt 1.0.0
     *
     */
    function bloghunt_get_block($block = 'grid', $section = 'post')
    {

        get_template_part('hooks/blocks/block-' . $section, $block);

    }
endif;