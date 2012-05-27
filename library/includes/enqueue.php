<?php 
/**
 * Enqueue scripts and styles.
 * 
 * This template file contains all the enqueue scripts and styles for the theme
 * also for deregistering scripts & styles.
 * 
 * @package foto
 * @since foto 0.0.1
 */

add_action('wp_enqueue_scripts', 'foto_enqueue_styles');
add_action('wp_enqueue_scripts', 'foto_enqueue_scripts');
add_action( 'wp_print_styles', 'foto_deregister_styles', 100 );

/**
 * Function to call the main style file
 *
 * @since foto 0.0.1
 */
function foto_enqueue_styles() {
	wp_enqueue_style( 'style', get_stylesheet_uri(), '', '0.0.1', 'all' );
}

/**
 * Deregistering default wp-pagenavi style
 *
 * @since foto 0.0.1
 */
function foto_deregister_styles() {
	wp_deregister_style( 'wp-pagenavi' );
}

/**
 * Call all requirement js files
 *
 * @since foto 0.0.1
 */
function foto_enqueue_scripts() {
	global $post;
	wp_enqueue_script( 'jquery' );
	
	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/library/modernizr-2.5.3.min.js', array('jquery'), '2.5.3' );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	if ( is_home() || is_front_page() ) {
		wp_enqueue_script( 'responsiveslide', get_template_directory_uri() . '/js/library/responsiveslides.min.js', array( 'jquery' ), '20120524', true );
	}
	
	if ( is_single() ) {
		wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/js/library/jquery.fancybox-1.3.4.pack.js', array( 'jquery' ), '20120524', true );
	}
	
	wp_enqueue_script( 'plugins', get_template_directory_uri() . '/js/plugins.js', array('jquery'), '20120524', true );
	
	wp_enqueue_script( 'methods', get_template_directory_uri() . '/js/methods.js', array('jquery'), '20120524', true );
	
}

?>