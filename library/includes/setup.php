<?php
/**
 * Theme setup
 *
 * @package foto
 * @since foto 0.0.1
 */
 
add_action( 'after_setup_theme', 'foto_setup' );
if ( ! function_exists( 'foto_setup' ) ):

	function foto_setup() {
		
		/**
		 * Set the content width based on the theme's design and stylesheet.
		 */
		global $content_width;
		if ( ! isset( $content_width ) ) $content_width = 700;
		
		/* Make foto available for translation.
		 * Translations can be added to the /languages/ directory.
		 * If you're building a theme based on foto, use a find and replace
		 * to change 'foto' to the name of your theme in all the template files.
		 */
		 load_theme_textdomain( 'foto', get_template_directory() . '/languages' );
				
		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();
		
		// Add default posts and comments RSS feed links to <head>.
		add_theme_support( 'automatic-feed-links' );
		
		// Add support for custom backgrounds
		add_custom_background();
		
		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus( array(
				'primary' => __( 'Footer Navigation', 'foto' )
			) );
		
		// This theme uses Featured Images (also known as post thumbnails)
		add_theme_support( 'post-thumbnails' );
		// Add custom image sizes
		add_image_size( 'foto-featured' , 700, 300, true ); // 700x300
		add_image_size( 'foto-home-thumbnail' , 220, 150, true ); // 220x150
		add_image_size( 'foto-single-thumbnail' , 700, 9999, true ); // 700 pixels wide (and unlimited height)
		
	}
endif; // end foto_setup