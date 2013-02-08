<?php
/**
 * Helper function to return the theme option value
 *
 * @package foto
 * @since foto 0.0.1
 */

add_action('wp_head', 'foto_custom_favicon', 5);
add_action('wp_head', 'foto_custom_css', 10);
add_action('wp_head', 'foto_custom_background', 10);
add_action('wp_footer','foto_analytics');

/**
 * Output Custom CSS from theme options
 *
 * @since foto 0.0.1
 */
 
function foto_custom_css() {
	
	if (of_get_option('foto_custom_css')) {
		echo "<!-- Custom Styling -->\n<style type=\"text/css\">\n" . esc_attr( of_get_option('foto_custom_css') ) . "\n</style>\n";
	}
}

/**
 * Custom background
 *
 * @since foto 0.0.1
 */
function foto_custom_background() {
	$bg = of_get_option('foto_custom_bg');
	
	if($bg) { ?>
		<style type="text/css">
			<?php if ($bg['image']) {
				echo 'body { background: '.$bg['color'].' url('. esc_url( $bg['image'] ). ') '.$bg['repeat'].' '.$bg['position'].' '.$bg['attachment'].'; }'. "\n";
			} else {
				echo 'body { background: '.$bg['color']. ' }'. "\n";
			} ?>
		</style>
	<?php }
}

/**
 * Output favicon from theme options
 *
 * @since foto 0.0.1
 */

function foto_custom_favicon() {
	if (of_get_option('foto_custom_favicon'))
		echo '<link rel="shortcut icon" href="'. esc_url( of_get_option('foto_custom_favicon') ) .'">'."\n";
}


/**
 * Output analytics code in footer from theme options
 *
 * @since foto 0.0.1
 */

function foto_analytics(){
	$output = of_get_option('foto_analytic_code');
	if ( $output ) 
		echo "\n" . stripslashes($output) . "\n";
}

/*
 * for 'textarea' sanitization and $allowedposttags + embed and script.
 *
 * @since foto 0.0.1
 */
add_action('admin_init', 'foto_change_santiziation', 100);
function foto_change_santiziation() {
    remove_filter( 'of_sanitize_textarea', 'of_sanitize_textarea' );
    add_filter( 'of_sanitize_textarea', 'foto_sanitize_textarea' );
}

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
	$custom_allowedtags["script"] = array();
	$custom_allowedtags = array_merge($custom_allowedtags, $allowedposttags);
	$output = wp_kses( $input, $custom_allowedtags);
    return $output;
}

?>