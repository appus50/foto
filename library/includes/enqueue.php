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
add_action( 'wp_footer', 'foto_js_ie' );
add_action( 'comment_form_before', 'foto_enqueue_comment_reply_script' );

/**
 * Function to call the main style file
 *
 * @since foto 0.0.1
 */
function foto_enqueue_styles() {
	wp_enqueue_style( 'foto-style', get_stylesheet_uri(), '', '0.0.4', 'all' );
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
	
	wp_enqueue_script( 'foto-modernizr', get_template_directory_uri() . '/js/vendor/modernizr-2.6.1.min.js', array('jquery'), '2.6.1' );
	
	wp_enqueue_script( 'foto-nwmathcer', get_template_directory_uri() . '/js/vendor/nwmatcher-1.2.5-min.js', array('jquery'), '1.2.5', true );
	
	if ( is_singular() && wp_attachment_is_image( $post->ID ) ) {
		wp_enqueue_script( 'foto-keyboard-image-navigation', get_template_directory_uri() . '/js/vendor/keyboard-image-navigation.js', array( 'jquery' ), '20120615' );
	}
	
	if ( is_home() || is_front_page() ) {
		wp_enqueue_script( 'foto-responsiveslide', get_template_directory_uri() . '/js/vendor/responsiveslides.min.js', array( 'jquery' ), '20120524', true );
	}
	
	wp_enqueue_script( 'foto-plugins', get_template_directory_uri() . '/js/plugins.js', array('jquery'), '20120524', true );
	
	wp_enqueue_script( 'foto-methods', get_template_directory_uri() . '/js/methods.js', array('jquery'), '20120524', true );
	
}

/**
 * JS library only for IE
 *
 * @since foto 0.0.1
 */
function foto_js_ie() { ?>
	<!--[if (gte IE 6)&(lte IE 8)]>
		<script src="<?php echo get_template_directory_uri(); ?>/js/vendor/selectivizr-min.js"></script>
	<![endif]-->
	
<?php 
}

/**
 * Comment reply js
 *
 * @since foto 0.0.4
 */
function foto_enqueue_comment_reply_script() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
?>