<?php
/**
 * Custom template tags for this theme
 *
 * This file contains the template custom functions that add functionality to the theme
 *
 * @package foto
 * @since foto 0.0.1
 */

/**
 * Adding the Open Graph in the Language Attributes
 *
 * @since foto 0.0.1
 */
add_filter('language_attributes', 'foto_add_opengraph_doctype');
function foto_add_opengraph_doctype( $output ) {
		return $output . ' xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml"';
	}

/**
 * Prints the Facebook open-graph meta
 *
 * @since foto 0.0.1
 */
add_action('wp_head', 'foto_open_graph', 1);
function foto_open_graph() {
	global $post;
	$thumbsfb = of_get_option('foto_og_thumb');
	
	$excerpt = ""; 
		if (has_excerpt($post->ID)) {
			$excerpt = esc_attr(strip_tags(get_the_excerpt($post->ID)));
		} else {
			$excerpt = esc_attr(str_replace("\r\n",' ',substr(strip_tags(strip_shortcodes($post->post_content)), 0, 160)));
		}
?>
	<!-- Open Graph Tags -->
	<meta property="og:type" content="<?php if (is_single() || is_page()) { echo "article"; } else { echo "website";} ?>">
	<meta property="og:title" content="<?php if (is_single() || is_page()) { echo esc_attr( get_the_title() ); } else { echo get_bloginfo('name'); } ?>">
	<meta property="og:url" content="<?php if (is_single() || is_page()) { echo esc_url( get_permalink() ); } else { echo esc_url( home_url( '/' ) ); } ?>">
	<meta property="og:description" content="<?php
		if (is_single() || is_page()) {
			if ( function_exists('wpseo_get_value') ) {
				echo wpseo_get_value('metadesc'); // get meta descriptions from WordPress SEO plugin
			} else {
				echo $excerpt;
			}
		} else {
			echo get_bloginfo('description');
		}
	?>">
	<meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>">
	<meta property="og:image" content="<?php if ( is_single() ) { echo foto_fb_image(); } else { echo esc_url( $thumbsfb ); } ?>">
	<!-- End Open Graph Tags -->
<?php
	
} //end foto_open_graph()


/**
 * Get image for facebook open-graph
 *
 * @since foto 0.0.1
 */
function foto_fb_image() {
	global $post;
	$thumbsfb = of_get_option('foto_og_thumb');
	$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '', '' );
	
	if ( has_post_thumbnail($post->ID) ) {
		$fbimage = $src[0];
	} else {
		global $post, $posts;
		$fbimage = '';
		ob_start();
		ob_end_clean();
		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
		if (array_key_exists(1, $matches)) {
			if (array_key_exists(0, $matches[1])) {
				$fbimage  = $matches [1] [0];
			}
		}
	}
	if(empty($fbimage)) {
		$fbimage = esc_url( $thumbsfb );
	}
	
	return $fbimage;
}


/**
 * Dynamic page title
 *
 * @since foto 0.0.1
 */
if ( ! function_exists( 'foto_page_title' ) ):
function foto_page_title() {
	if ( is_home() || is_front_page() ) { 
		echo esc_attr( of_get_option('foto_welcome_text') );
		
	} elseif ( is_single() || is_page() ) {
		printf( __('<a href="%1$s" title="%2$s" rel="bookmark">%3$s</a>', 'foto'),
			esc_url( get_permalink() ),
			esc_attr( sprintf( __( 'Permalink to %s', 'foto' ), the_title_attribute( 'echo=0' ) ) ),
			esc_attr( get_the_title() )
		);
		
	} elseif ( is_author() ) {
		/* Queue the first post, that way we know
		 * what author we're dealing with (if that is the case).
		*/
		the_post();
		printf( __( 'Author Archives: %s', 'foto' ), '<span class="vcard"><a class="url fn n" href="' . get_author_posts_url( get_the_author_meta( "ID" ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );
		/* Since we called the_post() above, we need to
		 * rewind the loop back to the beginning that way
		 * we can run the loop properly, in full.
		 */
		rewind_posts();
		
	} elseif ( is_404() ) {
		_e( '404 Not Found', 'foto' );
		
	} elseif ( is_search() ) {
		printf( __( 'Search Results for: %s', 'foto' ), '<span>' . get_search_query() . '</span>' );
		
	} elseif ( is_category() ) {
		printf( __( 'Category Archives: %s', 'foto' ), '<span>' . single_cat_title( '', false ) . '</span>' );

	} elseif ( is_tag() ) {
		printf( __( 'Tag Archives: %s', 'foto' ), '<span>' . single_tag_title( '', false ) . '</span>' );

	} elseif ( is_day() ) {
		printf( __( 'Daily Archives: %s', 'foto' ), '<span>' . get_the_date() . '</span>' );

	} elseif ( is_month() ) {
		printf( __( 'Monthly Archives: %s', 'foto' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

	} elseif ( is_year() ) {
		printf( __( 'Yearly Archives: %s', 'foto' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

	} else {
		_e( 'Archives', 'foto' );

	}
}
endif; // foto_page_title()


/**
 * Display navigation to next/previous pages when applicable
 *
 * @since foto 0.0.1
 */
if ( ! function_exists( 'foto_content_nav' ) ):
function foto_content_nav( $nav_id ) {
	global $wp_query;

	$nav_class = 'site-navigation paging-navigation clearfix';
	if ( is_single() )
		$nav_class = 'site-navigation post-navigation clearfix';

	?>
	<nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">
		<h1 class="assistive-text"><?php _e( 'Post navigation', 'foto' ); ?></h1>

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'foto' ) . '</span> %title' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'foto' ) . '</span>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>
		
		<?php if(function_exists('wp_pagenavi')) : wp_pagenavi(); else : // integrate wp-pagenavi ?>
			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( 'Older', 'foto' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer ', 'foto' ) ); ?></div>
			<?php endif; ?>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo $nav_id; ?> -->
	<?php
}
endif; // foto_content_nav()
 
 
/**
 * Prints HTML with meta information for the comments and views.
 *
 * @since foto 0.0.1
 */
if ( ! function_exists( 'foto_entry_info' ) ) :
function foto_entry_info() {
	if ( comments_open() && ! post_password_required() ) : ?>
		<?php comments_popup_link( '0', '1', '%', 'entry-comment', ''); ?>
	<?php endif; ?>
	
	<a class="entry-view" href="<?php echo esc_url( get_permalink() ); ?>" title="<?php _e('Post view', 'foto'); ?>"><?php echo foto_getPostViews(get_the_ID()); ?></a>
	
	<a class="entry-permalink" href="<?php echo esc_url( get_permalink() ); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'foto' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php _e('Permalink', 'foto'); ?></a>
<?php 
}
endif; // foto_entry_info()


/**
 * Prints HTML with meta information for the current post-date/time, author, category and tag.
 *
 * @since foto 0.0.1
 */
if ( ! function_exists( 'foto_entry_meta' ) ) :
function foto_entry_meta() {
	?>
	
	<ul class="content-data">
		<li>
			<span class="data-left"><?php _e('Author', 'foto'); ?></span>
			<span class="separator">:</span>
			<span class="data-right"><span class="author vcard"><a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo esc_attr( sprintf( __( 'View all posts by %s', 'foto' ), get_the_author() ) ); ?>" rel="author"><?php echo esc_html( get_the_author() ); ?></a></span></span>
		</li>
		<li>
			<span class="data-left"><?php _e('Published', 'foto'); ?></span>
			<span class="separator">:</span>
			<span class="data-right"><time class="entry-date published" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" pubdate><?php echo esc_html( get_the_date() ); ?></time></span>
		</li>
		<li>
			<span class="data-left"><?php _e('Category', 'foto'); ?></span>
			<span class="separator">:</span>
			<?php 
				$categories_list = get_the_category_list(', ');
					printf( __( '<span class="%1$s category">%2$s</span>', 'foto' ), 'entry-utility-prep entry-utility-prep-cat-links data-right', $categories_list );
			?>
		</li>
		<li>
			<span class="data-left"><?php _e('Tagged', 'foto'); ?></span>
			<span class="separator">:</span>
			<?php
				$tags_list = get_the_tag_list( '', ', ' );
					printf( __( '<span class="%1$s">%2$s</span>', 'foto' ), 'entry-utility-prep entry-utility-prep-tag-links data-right', $tags_list );
			?>
		</li>
		<li>
			<span class="data-right"><?php edit_post_link( __( 'Edit', 'foto' ) ); ?></span>
		</li>
	</ul>
	
<?php 
}
endif; // foto_entry_meta()


/**
 * Display the view/s counter
 * http://wp-snippets.com/post-views-without-plugin/
 * http://wpsnipp.com/index.php/functions-php/track-post-views-without-a-plugin-using-post-meta/
 *
 * @since foto 0.0.1
 */
// function to display number of posts.
function foto_getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return __('0 View', 'foto');
    }
    return $count.' Views';
}

// function to count views.
function foto_setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

// Add it to a column in WP-Admin
add_filter('manage_posts_columns', 'foto_posts_column_views');
add_action('manage_posts_custom_column', 'foto_posts_custom_column_views', 5, 2);
function foto_posts_column_views($defaults){
    $defaults['post_views'] = __('Views', 'foto');
    return $defaults;
}
function foto_posts_custom_column_views($column_name, $id){
	if($column_name === 'post_views'){
        echo foto_getPostViews(get_the_ID());
    }
}

remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

/**
 * This function removes default styles set by WordPress recent comments widget.
 *
 * @since foto 0.0.1
 */
add_action( 'widgets_init', 'foto_remove_recent_comments_style' );
function foto_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
} // end foto_remove_recent_comments_style()


/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since foto 1.0
 */
if ( ! function_exists( 'foto_comment' ) ) :
function foto_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'foto' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( 'Edit', 'foto' ), '<span class="edit-link">', '</span>' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer class="comment-meta">
				<div class="comment-author vcard">
					<?php
						$avatar_size = 48;
						if ( '0' != $comment->comment_parent )
							$avatar_size = 40;

						echo get_avatar( $comment, $avatar_size );

						/* translators: 1: comment author, 2: date and time */
						printf( __( '%1$s on %2$s <span class="says">said:</span>', 'foto' ),
							sprintf( '<span class="fn">%s</span>', get_comment_author_link() ),
							sprintf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								sprintf( __( '%1$s at %2$s', 'foto' ), get_comment_date(), get_comment_time() )
							)
						);
					?>

					<?php edit_comment_link( __( 'Edit', 'foto' ), '<span class="edit-comment-link">', '</span>' ); ?>
					
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'foto' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- .comment-author .vcard -->

				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'foto' ); ?></em>
				<?php endif; ?>

			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for foto_comment()


/**
 * Display custom breadcrumbs
 *
 * @since foto 0.0.1
 */
if ( ! function_exists( 'foto_do_breadrumbs' ) ) :
function foto_do_breadrumbs() {

	// If you installed wordpress seo or yoast breadcrumbs plugin, this function will automatically
	// display the yoast breadcrumbs, but if you're not. The custom breadcrumbs will change it
	if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<div id="breadcrumbs">','</div>');
	} else {
		echo foto_breadcrumbs();
	}
}
endif; // foto_do_breadrumbs()


/**
 * Display navigation to next/previous comments pages when applicable
 *
 * @since foto 0.0.1
 */
if ( ! function_exists( 'foto_comment_nav' ) ) :
function foto_comment_nav() {
	if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
	<nav role="navigation" id="comment-nav" class="site-navigation comment-navigation clearfix">
		<h1 class="assistive-text"><?php _e( 'Comment navigation', 'foto' ); ?></h1>
		<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'foto' ) ); ?></div>
		<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'foto' ) ); ?></div>
	</nav>
	<?php endif; // check for comment navigation
}
endif; // foto_comment_nav()

?>