<?php 
/**
 * This file contains all shortcodes
 *
 * @package foto
 * @since foto 0.0.1
 */

add_shortcode( 'notice', 'foto_notice' );
add_shortcode( 'button', 'foto_button' );
add_shortcode( 'fancybox', 'foto_fancybox' );
 
/**
 * Shortcode to create a notice box
 *
 * Optional arguments:
 * class: normal, warning, tip, info, error, 
 * download, success, help, delete
 *
 * @since foto 0.0.1
 */
function foto_notice($atts, $content = null) {
	extract( shortcode_atts( array(
			'class' => 'normal'
			), $atts ) 
		);
	
	$output = '<span class="notice '. $class .'">' . $content . '</span>';
	return $output;
}
 
/**
 * Shortcode to create an anchor tag with a class of button
 *
 * Optional arguments:
 * link: URI
 * size: btn-small, btn-normal, btn-large and btn-xlarge
 * class: color class (btn-black, btn-red, btn-yellow, btn-green, btn-blue and btn-purple,)
 * target: anchor tag target(_self as default)
 *
 * @since foto 0.0.1
 *
 */

function foto_button( $atts, $content = null ) {
	extract( shortcode_atts( array(
			'link' => '',
			'class' => '',
			'size' => 'btn-normal',
			'style' => '',
			'target' => '_self'
			), $atts)
		);
   	
   	$output = '<a href="' . $link . '" class="button '. $class .' '. $size .'" style="'. $style .'" target="' .$target. '">' . $content . '</a>';
   	return $output;
}

/**
 * Shortcode to create an image with fancybox effect
 *
 * Info:
 * title: the title for the image
 * alt: the image alt attribute
 * thumb: the image thumbnail
 *
 * @since foto 0.0.1
 */
function foto_fancybox( $atts, $content = null ) {
	extract( shortcode_atts( array(
			'title' => '',
			'alt' => '',
			'thumb' => ''
			), $atts ) 
		);
	
	$output = '<a class="fancyimg" href="'. $content .'" title="'. $title .'"><img alt="'.  $alt .'" src="'. $thumb .'"></a>';
	return $output;
}

?>