<?php
/**
 * Theme options
 *
 * Theme options for foto theme
 *
 * @package foto
 * @since foto 0.0.1
 */
 
function optionsframework_option_name() {

	// This gets the theme name from the stylesheet
	$themename = get_option( 'stylesheet' );
	$themename = preg_replace("/\W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 *
 */

function optionsframework_options() {
	
	$background = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' 
	);
	
	$social = array(
		'foto_post' => __('Single post', 'foto'),
		'foto_page' => __('Page', 'foto'),
		'foto_both' => __('Both', 'foto'),
		'foto_none' => __('None', 'foto')
	);
	
	$numbers = array(
		'2' => __('Two', 'foto'), 
		'3' => __('Three', 'foto'), 
		'4' => __('Four', 'foto'), 
		'5' => __('Five', 'foto'), 
		'6' => __('Six', 'foto'), 
		'7' => __('Seven', 'foto'), 
		'8' => __('Eight', 'foto'), 
		'9' => __('Nine', 'foto'), 
		'10' => __('Ten', 'foto') 
	);
	
	$options = array();

	$options[] = array( 
		'name' => __('General Settings', 'foto'),
		'type' => 'heading');
							
	$options[] = array( 
		'name' => __('Custom Logo', 'foto'),
		'desc' => __('Upload a logo for your website, or specify the image address of your online logo. Recommended size is 300x100', 'foto'),
		'id' => 'foto_custom_logo',
		'type' => 'upload');
								
	$options[] = array( 
		'name' => __('Custom Favicon', 'foto'),
		'desc' => __('Upload a favicon for your website, or specify the image address of your online favicon. Recommended size is 16x16', 'foto'),
		'id' => 'foto_custom_favicon',
		'type' => 'upload');
							
	$options[] = array( 
		'name' => __('Custom CSS', 'foto'),
		'desc' => __('Quickly add some CSS rules to your theme by adding it to this box.', 'foto'),
		'id' => 'foto_custom_css',
		'std' => '',
		'type' => 'textarea'); 
						
	$options[] = array( 
		'name' => __('Analytic Code', 'foto'),
		'desc' => __('Paste your Google Analytics (or other) tracking code here. It will be inserted before the closing body tag of your theme.', 'foto'),
		'id' => 'foto_analytic_code',
		'type' => 'textarea');
						
	/* ============================== End General Settings ================================= */	
	
	$options[] = array( 
		'name' => __('Theme Settings', 'foto'),
		'type' => 'heading');
	
	$options[] = array( 
		'name' => __('Facebook open graph default thumb', 'foto'),
		'desc' => __('Upload the default facebook open graph thumbnail', 'foto'),
		'id' => 'foto_og_thumb',
		'type' => 'upload');
		
	$options[] = array(
		'name' =>  __('Custom background', 'foto'),
		'desc' => __('Customize your background', 'foto'),
		'id' => 'foto_custom_bg',
		'std' => $background,
		'type' => 'background' 
	);
		
	$options[] = array( 
		'name' => __('Welcome Text', 'foto'),
		'desc' => __('Put your welcome text here, it only visible on home page', 'foto'),
		'std' => 'Hi! Welcome to my personal photo site. This is just a place for me to share my photos. I hope you&rsquo;t ll enjoy it.',
		'id' => 'foto_welcome_text',
		'type' => 'textarea');
		
	$options[] = array( 
		'name' => __('Select a number of featured posts', 'foto'),
		'desc' => __('How many featured posts you want to show ?', 'foto'),
		'id' => 'foto_featured',
		'type' => 'select',
		'std' => '3',
		'options' => $numbers );
						
	/* $options[] = array( 
		"name" => __('Display social share button', 'foto'),
		"desc" => __('Display social share on single post and page', 'foto'),
		"id" => "foto_social_share",
		"std" => 'foto_post',
		"type" => "radio",
		"options" => $social ); */
	
	/* ============================== End Theme Settings ================================= */	
	
	$options[] = array( 
		'name' => __('Social Settings', 'foto'),
		'type' => 'heading');
		
	$options[] = array( 
		'name' => __('Custom RSS Feed', 'foto'),
		'desc' => __('You can put the feedburner link here', 'foto'),
		'id' => 'foto_rss_custom',
		'type' => 'text');
		
	$options[] = array( 
		'name' => __('Twitter', 'foto'),
		'desc' => __('Twitter url. ex: http://twitter.com/yourusername', 'foto'),
		'id' => 'foto_twitter_username',
		'type' => 'text');
						
	$options[] = array( 
		'name' => __('Facebook', 'foto'),
		'desc' => __('Facebook url. ex: http://www.facebook.com/yourusername', 'foto'),
		'id' => 'foto_fb_username',
		'type' => 'text');
						
	$options[] = array( 
		'name' => __('Google Plus', 'foto'),
		'desc' => __('Google plus url. ex: https://plus.google.com/u/109253446701726260861', 'foto'),
		'id' => 'foto_gplus_username',
		'type' => 'text');
						
	
	/* ============================== End Social Settings ================================= */
	
	return $options;
}