<?php
/**
 * Register our sidebars and widgetized areas
 * 
 * @package foto
 * @since foto 0.0.1
 */
 
add_action( 'widgets_init', 'foto_widgets_init' );
function foto_widgets_init() {
	
	register_widget('foto_Twitter_Widget');
	
	register_widget('foto_author_bio');
	
    register_sidebar(array(
		'name'          => __( 'Home Widget', 'foto'),
		'description'   => __('This sidebar appears on the right side of your site on home page', 'foto'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title">',
		'after_title'   => '</div>',
	));
	
	register_sidebar(array(
		'name'          => __( 'Footer Left Widget', 'foto'),
		'description'   => __('This sidebar appears on the footer of your site', 'foto'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title">',
		'after_title'   => '</div>',
	));
	
	register_sidebar(array(
		'name'          => __( 'Footer Center Widget', 'foto'),
		'description'   => __('This sidebar appears on the footer of your site', 'foto'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title">',
		'after_title'   => '</div>',
	));
	
	register_sidebar(array(
		'name'          => __( 'Footer Right Widget', 'foto'),
		'description'   => __('This sidebar appears on the footer of your site', 'foto'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title">',
		'after_title'   => '</div>',
	));
	
	register_sidebar(array(
		'name'          => __( 'Page Widget', 'foto'),
		'description'   => __('This sidebar appears on the footer of your site', 'foto'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-title">',
		'after_title'   => '</div>',
	));
	
}

?>