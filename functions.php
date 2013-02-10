<?php
/**
 * Theme functions file
 *
 * Contains all of the Theme's setup functions, custom functions,
 * custom hooks and Theme settings.
 *
 * @package foto
 * @author	Satrya
 * @license	license.txt
 * @since 	0.0.1
 */

/* Loads the Options Settings. */
if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/' );
	require_once dirname( __FILE__ ) . '/admin/options-framework.php';
}

/**
 * Define Theme setup
 * 
 * @since 0.0.1
 */
add_action( 'after_setup_theme', 'foto_setup' );
function foto_setup() {
	
	/* Set the content width based on the theme's design and stylesheet. */
	global $content_width;
	if ( ! isset( $content_width ) ) $content_width = 700;
	
	/* Make foto available for translation. */
	load_theme_textdomain( 'foto', get_template_directory() . '/languages' );
			
	/* WordPress theme support. */
	add_editor_style();
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'custom-background' );
	register_nav_menus( array(
			'primary' => __( 'Footer Navigation', 'foto' )
		) );
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'foto-featured' , 700, 300, true );
	add_image_size( 'foto-home-thumbnail' , 220, 150, true );
	add_image_size( 'foto-single-thumbnail' , 700, 350, true );

	/* Enqueue styles & scripts. */
	add_action( 'wp_enqueue_scripts', 'foto_enqueue_scripts' );

	/* Deregister wp-pagenavi style. */
	add_action( 'wp_print_styles', 'foto_deregister_styles', 100 );

	/* Comment reply script. */
	add_action( 'comment_form_before', 'foto_enqueue_comment_reply_script' );
	
	/**
	 * Load all library files
	 */
	require( get_template_directory() . '/includes/extensions.php' );
	require( get_template_directory() . '/includes/filters.php' );
	require( get_template_directory() . '/includes/options-functions.php' );
	require( get_template_directory() . '/includes/templates.php' );
	require( get_template_directory() . '/includes/widgets.php' );
	require( get_template_directory() . '/includes/options-sidebar.php' ); // load sidebar for theme options

} // end foto_setup

/**
 * Enqueue styles & scripts.
 *
 * @since 0.0.1
 */
function foto_enqueue_scripts() {
	global $post;

	wp_enqueue_style( 'foto-fonts', 'http://fonts.googleapis.com/css?family=Lato:400,700,400italic|Oswald:300', '', '1.0', 'all' );

	wp_enqueue_style( 'foto-style', get_stylesheet_uri(), false, '1.1', 'all' );

	wp_enqueue_script( 'jquery' );

	if ( is_singular() && wp_attachment_is_image( $post->ID ) ) {
		wp_enqueue_script( 'foto-keyboard-image-navigation', get_template_directory_uri() . '/js/vendor/keyboard-image-navigation.js', array( 'jquery' ), '1.0' );
	}
	
	wp_enqueue_script( 'foto-plugins', get_template_directory_uri() . '/js/plugins.js', array( 'jquery' ), '1.0', true );
	
	wp_enqueue_script( 'foto-methods', get_template_directory_uri() . '/js/methods.js', array( 'jquery' ), '1.0', true );
	
}

/**
 * Deregister default wp-pagenavi style
 *
 * @since 0.0.1
 */
function foto_deregister_styles() {
	wp_deregister_style( 'wp-pagenavi' );
}

/**
 * Comment reply js
 *
 * @since 0.0.4
 */
function foto_enqueue_comment_reply_script() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
?>