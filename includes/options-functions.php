<?php
/**
 * Option Functions
 *
 * @package foto
 * @author	Satrya
 * @license	license.txt
 * @since 	0.0.1
 */

/**
 * Output Custom CSS from theme options
 *
 * @since 0.0.1
 */
 
function foto_custom_css() {
	
	if (of_get_option('foto_custom_css')) {
		echo "<!-- Custom Styling -->\n<style type=\"text/css\">\n" . esc_html( of_get_option( 'foto_custom_css' ) ) . "\n</style>\n";
	}

}
add_action('wp_head', 'foto_custom_css', 10);

/**
 * Output favicon from theme options
 *
 * @since 0.0.1
 */
function foto_custom_favicon() {
	if ( of_get_option( 'foto_custom_favicon' ) )
		echo '<link rel="shortcut icon" href="'. esc_url( of_get_option( 'foto_custom_favicon' ) ) .'">'."\n";
}
add_action( 'wp_head', 'foto_custom_favicon', 5 );

/**
 * Output analytics code in footer from theme options
 *
 * @since 0.0.1
 */

function foto_analytics(){
	$output = of_get_option( 'foto_analytic_code' );
	if ( $output ) 
		echo "\n" . stripslashes($output) . "\n";
}
add_action( 'wp_footer','foto_analytics' );

/*
 * for 'textarea' sanitization and $allowedposttags + embed and script.
 *
 * @since 0.0.1
 */
function foto_change_santiziation() {

    remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
    add_filter( 'of_sanitize_textarea', 'foto_sanitize_textarea' );
    
}
add_action( 'admin_init', 'foto_change_santiziation', 100 );

function foto_sanitize_textarea($input) {

    global $allowedposttags;

    $custom_allowedtags["embed"] = array(
		"src" => array(),
		"type" => array(),
		"allowfullscreen" => array(),
		"allowscriptaccess" => array(),
		"height" => array(),
		"width" => array()
	);

	$custom_allowedtags["script"] = array(
		"src" => array(), 
		"type" => array()
	);

	$custom_allowedtags["meta"] = array(
		"name" => array(), 
		"content" => array()
	);

	$custom_allowedtags["link"] = array(
		"href" => array(), 
		"rel" => array(),
		"type" => array()
	);

	$custom_allowedtags = array_merge($custom_allowedtags, $allowedposttags);
	$output = wp_kses( $input, $custom_allowedtags);
    return $output;

}
?>