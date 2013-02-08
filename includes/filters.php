<?php 
/**
 * Filter Hooks
 * 
 * This file contains all the functions for the theme's filters
 * 
 * @package foto
 * @since foto 0.0.1
 */

/**
 * wp_title filter
 * Credit: Thematic theme
 *
 * @since foto 0.0.1
 */
add_filter( 'wp_title', 'foto_title' );
function foto_title( $wp_doctitle ) {

	if ( is_feed() || !foto_seo() )
    	return $wp_doctitle;
   
	$site_name = get_bloginfo('name' , 'display');
	$separator = apply_filters('foto_doctitle_separator', '|');
			
	if ( is_single() ) {
		$content = single_post_title('', FALSE);
	}
	elseif ( is_home() || is_front_page() ) { 
		$content = get_bloginfo('description', 'display');
	}
	elseif ( is_page() ) { 
		$content = single_post_title('', FALSE); 
	}
	elseif ( is_search() ) { 
		$content = __('Search Results for:', 'foto'); 
		$content .= ' ' . get_search_query();
	}
	elseif ( is_category() ) {
		$content = __('Category Archives:', 'foto');
		$content .= ' ' . single_cat_title('', FALSE);;
	}
	elseif ( is_tag() ) { 
		$content = __('Tag Archives:', 'foto');
		$content .= ' ' . foto_tag_query();
	}
	elseif ( is_404() ) { 
		$content = __('Not Found', 'foto'); 
	}
	else { 
		$content = get_bloginfo('description', 'display');
	}

	if ( get_query_var('paged') ) {
		$content .= ' ' .$separator. ' ';
		$content .= 'Page';
		$content .= ' ';
		$content .= get_query_var('paged');
	}

	if($content) {
		if ( is_home() || is_front_page() ) {
			$elements = array(
				'site_name' => $site_name,
				'separator' => $separator,
				'content' => $content
			);
		}
		else {
			$elements = array(
				'content' => $content
			);
		}  
	} else {
		$elements = array(
			'site_name' => $site_name
		);
	}

	// Filters should return an array
	$elements = apply_filters('foto_doctitle', $elements);
	
	// But if they don't, it won't try to implode
	if( is_array($elements) ) {
		$doctitle = implode(' ', $elements);
	}
	else {
		$doctitle = $elements;
	}
	
	$doctitle = $doctitle;
	
	echo $doctitle;
   
}


/**
 * Create nice multi_tag_title
 * Credit: Thematic theme
 *
 * @since foto 0.0.1
 */
function foto_tag_query() {
	$nice_tag_query = get_query_var( 'tag' ); // tags in current query
	$nice_tag_query = str_replace(' ', '+', $nice_tag_query); // get_query_var returns ' ' for AND, replace by +
	$tag_slugs = preg_split('%[,+]%', $nice_tag_query, -1, PREG_SPLIT_NO_EMPTY); // create array of tag slugs
	$tag_ops = preg_split('%[^,+]*%', $nice_tag_query, -1, PREG_SPLIT_NO_EMPTY); // create array of operators

	$tag_ops_counter = 0;
	$nice_tag_query = '';

	foreach ($tag_slugs as $tag_slug) { 
		$tag = get_term_by('slug', $tag_slug ,'post_tag');
		// prettify tag operator, if any
		if ( isset($tag_ops[$tag_ops_counter])  &&  $tag_ops[$tag_ops_counter] == ',') {
			$tag_ops[$tag_ops_counter] = ', ';
		} elseif ( isset( $tag_ops[$tag_ops_counter])  &&  $tag_ops[$tag_ops_counter] == '+') {
			$tag_ops[$tag_ops_counter] = ' + ';
		}
		// concatenate display name and prettified operators
		if ( isset( $tag_ops[$tag_ops_counter] ) ) {
			$nice_tag_query = $nice_tag_query.$tag->name.$tag_ops[$tag_ops_counter];
			$tag_ops_counter += 1;
		} else {
			$nice_tag_query = $nice_tag_query.$tag->name;
			$tag_ops_counter += 1;
		}
	}
	return $nice_tag_query;
}

/**
 * Switch Foto SEO functions on or off
 * 
 * Provides compatibility with SEO plugins: All in One SEO Pack, HeadSpace, 
 * Platinum SEO Pack, wpSEO and Yoast SEO. Default: ON
 * 
 * Credit: Thematic theme
 * @since foto 0.0.3
 */
function foto_seo() {
	if ( class_exists('All_in_One_SEO_Pack') || class_exists('HeadSpace_Plugin') || class_exists('Platinum_SEO_Pack') || class_exists('wpSEO') || defined('WPSEO_VERSION') ) {
		$content = FALSE;
	} else {
		$content = true;
	}
		return apply_filters( 'foto_seo', $content );
}
 
/**
 * Sets the post excerpt length to 50 words.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since foto 0.0.1
 */
add_filter( 'excerpt_length', 'foto_excerpt_length' );
function foto_excerpt_length( $length ) {
	return 50;
}


/**
 * Returns a "Continue Reading" link for excerpts
 *
 * @since foto 0.0.1
 */
function foto_continue_reading_link() {
	return ' <a href="'. esc_url( get_permalink() ) . '">' . __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'foto' ) . '</a>';
}


/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and foto_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since foto 0.0.1
 */
add_filter( 'excerpt_more', 'foto_auto_excerpt_more' );
function foto_auto_excerpt_more( $more ) {
	return ' &hellip;' . foto_continue_reading_link();
}


/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since foto 0.0.1
 */
add_filter( 'get_the_excerpt', 'foto_custom_excerpt_more' );
function foto_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= foto_continue_reading_link();
	}
	return $output;
}


/**
 * Remove gallery inline style
 *
 * @since foto 0.0.1
 */
add_filter( 'use_default_gallery_style', '__return_false' );


/**
 * Stop more link from jumping to middle of page
 *
 * @since foto 0.0.1
 */
add_filter('the_content_more_link', 'foto_remove_more_jump_link');
function foto_remove_more_jump_link($link) { 
	$offset = strpos($link, '#more-');
	if ($offset) {
		$end = strpos($link, '"',$offset);
	}
	if ($end) {
		$link = substr_replace($link, '', $offset, $end-$offset);
	}
	return $link;
}


/**
 * Adds custom classes to the array of body classes.
 *
 * @since foto 0.0.1
 */
add_filter( 'body_class', 'foto_body_classes' );
function foto_body_classes( $classes ) {
	// Adds a class of group-blog & multi-author to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'multi-author';
	}

	return $classes;
}


/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @since foto 0.0.1
 */
add_filter( 'wp_page_menu_args', 'foto_page_menu_args' );
function foto_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
} // end foto_page_menu_args()


/**
 * Remove div from wp_page_menu() and replace with ul
 *
 * @since foto 0.0.1
 */
add_filter('wp_page_menu', 'foto_wp_page_menu');
function foto_wp_page_menu ($page_markup) {
    preg_match('/^<div class=\"([a-z0-9-_]+)\">/i', $page_markup, $matches);
        $divclass = $matches[1];
        $replace = array('<div class="'.$divclass.'">', '</div>');
        $new_markup = str_replace($replace, '', $page_markup);
        $new_markup = preg_replace('/^<ul>/i', '<ul class="'.$divclass.'">', $new_markup);
        return $new_markup; 
	}


/**
 * Add a twitter contact info
 *
 * @since foto 0.0.1
 */
add_filter('user_contactmethods','foto_new_contactmethods', 10, 1);
function foto_new_contactmethods( $contactmethods ) {
    $contactmethods['twitter'] = 'Twitter'; // Add Twitter
	
    return $contactmethods;
}

/**
 * Customize tag cloud widget
 *
 * @since foto 0.0.1
 */
add_filter( 'widget_tag_cloud_args', 'foto_new_tag_cloud' );
function foto_new_tag_cloud( $args ) {
	$args['largest'] 	= 12;
	$args['smallest'] 	= 12;
	$args['unit'] 		= 'px';
	return $args;
}

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 *
 * @since Foto 0.0.2
 */
add_filter( 'attachment_link', 'foto_enhanced_image_navigation', 10, 2 );
function foto_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
?>