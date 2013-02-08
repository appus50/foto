<?php
/**
 * Options Panel Sidebar
 *
 * @package Foto
 * @since Foto 0.0.2
 */

add_action( 'optionsframework_after','foto_options_sidebar' );
function foto_options_sidebar() { ?>

	<div id="optionsframework-sidebar">
		<div class="metabox-holder">
			
			<div class="foto-ads">
				<a href="<?php echo esc_url( 'http://bit.ly/YVWpF5' ); ?>" target="_blank"><img class="ads-img" width="280" src="<?php echo get_template_directory_uri(); ?>/img/ads.png"></a>
				<p></p>
			</div>
			
		</div>
	</div>
	
<?php }


/**
 * loads an additional CSS file for the options panel
 *
 * @since Foto 0.0.2
 */
 if ( is_admin() ) {
    $of_page= 'appearance_page_options-framework';
    add_action( "admin_print_styles-$of_page", 'foto_optionsframework_custom_css', 100);
}
 
function foto_optionsframework_custom_css () {
	wp_register_style( 'foto_optionsframework_custom_css', get_stylesheet_directory_uri() .'/css/options-custom.css' );
	wp_enqueue_style( 'foto_optionsframework_custom_css' );
}
