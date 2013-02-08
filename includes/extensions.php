<?php
/**
 * Extension functions for the theme
 *
 * Available theme extensions
 *
 * @package foto
 * @since foto 0.0.1
 */
 
/**
 * Custom breadcrumbs function
 *
 * Credit:
 * http://dimox.net/wordpress-breadcrumbs-without-a-plugin/
 * Oenology theme by chip bennet
 *
 * @package foto
 * @since foto 0.0.1
 */

function foto_breadcrumbs() {
 
  	$containerBefore = '<div id="breadcrumbs">';
	$containerAfter = '</div>';
	$containerCrumb = '<div class="crumbs">';
	$containerCrumbEnd = '</div>';
	$delimiter = ' &raquo; ';
	$name = 'Home'; //text for the 'Home' link
	$blogname = 'Blog'; //text for the 'Blog' link
	$baseLink = '';
	$hierarchy = '';
	$currentLocation = '';
	$currentBefore = '<strong>';
	$currentAfter = '</strong>';
	$currentLocationLink = '';
	$crumbPagination = '';

	global $post;
 
	// Start of Container
    echo $containerBefore;
	// Start of Breadcrumbs
	echo $containerCrumb;

	// Output the Base Link	
	if ( is_front_page() ) {
		echo '<strong>' . $name . '</strong>';
	} else {
		$home = home_url('/');
		$baseLink =  '<a href="' . $home . '">' . $name . '</a>';
		echo $baseLink; 
	}
	// If static Page as Front Page, and on Blog Posts Index
	if ( is_home() && ( 'page' == get_option( 'show_on_front' ) ) ) {
		echo $delimiter . '<strong>' . $blogname . '</strong>';
	}
	// If static Page as Front Page, and on Blog, output Blog link
	if ( ! is_home() && ! is_page() && ! is_front_page() && ( 'page' == get_option( 'show_on_front' ) ) ) {
		$blogpageid = get_option( 'page_for_posts' );
		$bloglink = '<a href="' . get_permalink( $blogpageid ) . '">' . $blogname . '</a>';
		echo $delimiter . $bloglink;
	} 
    // Define Category Hierarchy Crumbs for Category Archive
	if ( is_category() ) { 
		global $wp_query;
		$cat_obj = $wp_query->get_queried_object();
		$thisCat = $cat_obj->term_id;
		$thisCat = get_category($thisCat);
		$parentCat = get_category($thisCat->parent);
		if ($thisCat->parent != 0) {
			$hierarchy = ( $delimiter . __( 'Category Archive: ', 'foto' ) . get_category_parents( $parentCat, TRUE, $delimiter ) );
		} else {
			$hierarchy = $delimiter . __( 'Category Archive: ', 'foto' );
		}
			// Set $currentLocation to the current category
			$currentLocation = single_cat_title( '' , FALSE ); 
	} 
	// Define Crumbs for Day/Year/Month Date-based Archives
	elseif ( is_date() ) { 
		// Define Year/Month Hierarchy Crumbs for Day Archive
		if  ( is_day() ) {
			$date_string = '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ' . '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ';
			$date_string .= $delimiter . ' ';
			$currentLocation = get_the_time('d'); 
		} 
		// Define Year Hierarchy Crumb for Month Archive
		elseif ( is_month() ) {
			$date_string = '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ';
			$date_string .= $delimiter . ' ';
			$currentLocation = get_the_time('F'); 
		} 
		// Set CurrentLocation for Year Archive
		elseif ( is_year() ) {
			$date_string = '';
			$currentLocation = get_the_time('Y'); 
		}
		$hierarchy = $delimiter . sprintf( __( 'Posts Published in: %s', 'foto' ), $date_string ); 
    } 
	// Define Category Hierarchy Crumbs for Single Posts
	elseif ( is_single() && !is_attachment() ) { 
		$cat = get_the_category(); 
		$cat = $cat[0];
		$hierarchy = $delimiter . get_category_parents( $cat, TRUE, $delimiter );
		// Note: get_the_title() is filtered to output a
		// default title if none is specified
		$currentLocation = get_the_title();	  
    } 
	// Define Category and Parent Post Crumbs for Post Attachments
	elseif ( is_attachment() ) { 
		$parent = get_post($post->post_parent);
		$cat_parents = '';
		if ( get_the_category($parent->ID) ) {
		$cat = get_the_category($parent->ID); 
		$cat = $cat[0];
		$cat_parents = get_category_parents( $cat, TRUE, $delimiter );
		}
		$hierarchy = $delimiter . $cat_parents . '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter;
		// Note: Titles are forced for attachments; the
		// filename will be used if none is specified
		$currentLocation = get_the_title();  
    } 
	// Define Current Location for Parent Pages
	elseif ( ! is_front_page() && is_page() && ! $post->post_parent ) { 
		$hierarchy = $delimiter;
		// Note: get_the_title() is filtered to output a
		// default title if none is specified
		$currentLocation = get_the_title();	  
    } 
	// Define Parent Page Hierarchy Crumbs for Child Pages
	elseif ( ! is_front_page() && is_page() && $post->post_parent ) { 
		$parent_id  = $post->post_parent;
		$breadcrumbs = array();
		while ($parent_id) {
		$page = get_page($parent_id);
		$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
		$parent_id  = $page->post_parent;
		}
		$breadcrumbs = array_reverse($breadcrumbs);
		foreach ($breadcrumbs as $crumb) {
		$hierarchy = $hierarchy . $delimiter . $crumb;
		}
		$hierarchy = $hierarchy . $delimiter;
		// Note: get_the_title() is filtered to output a
		// default title if none is specified
		$currentLocation = get_the_title(); 
    } 
	// Define current location for Search Results page
	elseif ( is_search() ) { 
		$hierarchy = $delimiter . __('Search Results:', 'foto' ) . ' ';
		$currentLocation = get_search_query();	  
    } 
	// Define current location for Tag Archives
	elseif ( is_tag() ) {	  
		$hierarchy = $delimiter . __( 'Tag Archive:', 'foto' ) . ' ';
		$currentLocation = single_tag_title( '' , FALSE );  
    } 
	// Define current location for Author Archives
	elseif ( is_author() ) { 
		$hierarchy = $delimiter . __( 'Posts Written by:', 'foto' ) . ' ';
		$currentLocation = get_the_author_meta( 'display_name', get_query_var( 'author' ) ); 
    } 
	// Define current location for 404 Error page
	elseif ( is_404() ) { 
		$hierarchy = $delimiter . __( 'Error 404:', 'foto' ) . ' ';
		$currentLocation = __( 'Page Not Found', 'foto' );	  
    } 
	// Define current location for Post Format Archives
	elseif ( get_post_format() && ! is_home() ) { 
		$hierarchy = $delimiter . __( 'Post Format Archive:', 'foto' ) . ' ';
		$currentLocation = get_post_format_string( get_post_format() ) . 's';
	}

	// Build the Current Location Link markup
		$currentLocationLink = $currentBefore . $currentLocation . $currentAfter; 
	 
	// Define breadcrumb pagination
	 
	// Define pagination for paged Archive pages
		if ( get_query_var('paged') && ! function_exists( 'wp_paginate' ) ) {
		  $crumbPagination = ' (Page ' . get_query_var('paged') . ')';
		}
	 
	 // Define pagination for Paged Posts and Pages
		if ( get_query_var('page') ) {
		  $crumbPagination = ' (Page ' . get_query_var('page') . ') ';
		}

	// Output the resulting Breadcrumbs
	
	echo $hierarchy; // Output Hierarchy	
	echo $currentLocationLink; // Output Current Location	
	echo $crumbPagination; // Output page number, if Post or Page is paginated	
	echo $containerCrumbEnd; // End of BreadCrumbs
 
    echo $containerAfter; // End of Container

} // end foto_breadcrumbs()


/**
 * Custom twitter widget function
 *
 * Credit:
 * Jeffrey Way - https://github.com/JeffreyWay/WordPress-Twitter-Widget
 *
 * @package foto
 * @since foto 0.0.1
 */
 
class foto_Twitter_Widget extends WP_Widget {
    function __construct() {
        $params = array(
	    'description' => __('Display your recent tweets to your readers.', 'foto'),
	    'name' => __('&raquo; Foto Twitter Widget', 'foto')
		);
        
        // id, name, params
        parent::__construct('foto_Twitter_Widget', '', $params);
    }
    
    public function form($instance) {
        extract($instance);
        ?>
        
        <p>
			<label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title:', 'foto'); ?> </label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php if ( isset($title) ) echo esc_attr($title); ?>">
        </p>
        
        <p>
			<label for="<?php echo $this->get_field_id('username'); ?>"><?php _e('Twitter Username:', 'foto'); ?></label>
			<input class="widefat" type="text" id="<?php echo $this->get_field_id('username'); ?>" name="<?php echo $this->get_field_name('username'); ?>" value="<?php if ( isset($username) ) echo esc_attr($username); ?>">
        </p>
        
        <p>
			<label for="<?php echo $this->get_field_id('tweet_count'); ?>">
				<?php _e('Number of Tweets to Retrieve:', 'foto'); ?>
			</label>
			<input type="number" class="widefat" style="width: 40px;" id="<?php echo $this->get_field_id('tweet_count');?>" name="<?php echo $this->get_field_name('tweet_count');?>" min="1" max="10" value="<?php echo !empty($tweet_count) ? $tweet_count : 5; ?>" />
        </p>
        <?php
    }
    
    // What the visitor sees...
    public function widget($args, $instance) {
	extract($instance);
        extract( $args );
        
        if ( empty($title) ) $title = 'Recent Tweets';
        
        $data = $this->twitter($tweet_count, $username);
        if ( false !== $data && isset($data->tweets) ) {
            echo $before_widget;
		echo $before_title;
		    echo $title;
		echo $after_title;
		
		echo '<ul><li>' . implode('</li><li>', $data->tweets) . '</li></ul>'; ?>
		<span class="follow-me">
			<a href="https://twitter.com/<?php echo $username; ?>" class="twitter-follow-button" data-show-count="false">Follow @<?php echo $username; ?></a>
			<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</span>
        <?php   echo $after_widget;
        }
    }
    
    private function twitter($tweet_count, $username)
    {
        if ( empty($username) ) return;
        
        $tweets = get_transient('recent_tweets_widget');
        if ( !$tweets ||
	    $tweets->username !== $username ||
	    $tweets->tweet_count !== $tweet_count )
	{
	    return $this->fetch_tweets($tweet_count, $username);
	}
        return $tweets;
    }
    
    private function fetch_tweets($tweet_count, $username)
    {
	$tweets = wp_remote_get("http://twitter.com/statuses/user_timeline/$username.json");
	$tweets = json_decode($tweets['body']);
	
	// An error retrieving from the Twitter API?
	if ( isset($tweets->error) ) return false;
	
	$data = new StdClass();
	$data->username = $username;
	$data->tweet_count = $tweet_count;
	
	foreach($tweets as $tweet) {
	    if ( $tweet_count-- === 0 ) break;
	    $data->tweets[] = $this->filter_tweet( $tweet->text );
	}
	
	set_transient('recent_tweets_widget', $data, 60 * 5); // five minutes
	return $data;
    }

    private function filter_tweet($tweet)
    {
        // Username links
        $tweet = preg_replace('/(http[^\s]+)/im', '<a href="$1">$1</a>', $tweet);
        $tweet = preg_replace('/@([^\s]+)/i', '<a href="http://twitter.com/$1">@$1</a>', $tweet);
        // URL links
        return $tweet;
    }
    
}


/**
 * Custom author bio widget
 *
 * @package foto
 * @since foto 0.0.1
 */
class foto_author_bio extends WP_Widget
{
	function foto_author_bio()
	{
		$widget_ops = array('classname' => 'foto_author_bio', 'description' => 'Display your biographical info' );
		$this->WP_Widget('foto_author_bio', '&raquo; Foto Author Bio', $widget_ops);
	}
 
	function form($instance)
	{
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = $instance['title'];
	?>
		<p><?php printf( __('Please complete your bio information on the <a href="%s">Profile Page</a> <em>(fill the nickname, twitter and Biographical Info)</em>', 'foto'), admin_url('profile.php') ); ?></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'foto' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>
	<?php
	}
 
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		return $instance;
	}
 
	function widget($args, $instance)
	{
		extract($args, EXTR_SKIP);
 
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Social', 'foto') : $instance['title'], $instance, $this->id_base);
		
		echo $before_widget;
 
		if (!empty($title))
			echo $before_title . $title . $after_title;
		?>
		
		<div class="widget-author-info">
			<p class="author-desc"><?php the_author_meta( 'description' ); ?></p>
			<div class="author-detail">
				<span>
					<p class="author-name"><?php echo get_the_author(); ?></p>
					<p class="author-twitter">
						<a href="<?php echo the_author_meta( 'twitter' ) ?>" class="twitter-follow-button" data-show-count="false">Follow me</a>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
					</p>
				</span>
				<figure class="author-img"><?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'foto_author_bio_avatar_size', 60 ) ); ?></figure>
			</div>
		</div>
		
		<?php
		echo $after_widget;
	}
 
}
 
 
?>