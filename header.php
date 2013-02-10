<?php
/**
 * Header Template Part
 * 
 * Template part file that contains the HTML document head and 
 * opening HTML body elements, as well as the site header
 *
 * @package foto
 * @author	Satrya
 * @license	license.txt
 * @since 	0.0.1
 *
 */
?>
<!DOCTYPE html>
<!--[if IE 8 ]>    <html class="ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?>> <!--<![endif]-->
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<title><?php wp_title(); ?></title>

<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed container">
	<?php do_action( 'foto_before' ); ?>
	
	<header id="masthead" class="site-header clearfix" role="banner">
	
		<div class="site-branding col-8">
			<?php if( of_get_option('foto_custom_logo') ) :
					
				$logotag  = (is_home() || is_front_page())? 'h1':'div';?>
					<<?php echo $logotag; ?> class="site-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img alt="<?php bloginfo('name'); ?>" src="<?php echo esc_url( of_get_option('foto_custom_logo') ); ?>"><span><?php bloginfo('name'); ?></span></a></<?php echo $logotag; ?>>
				<?php
				
			else :
			
				$titletag  = (is_home() || is_front_page())? 'h1':'div'; // only display h1 tag on home page, SEO reason ?>
					<<?php echo $titletag; ?> class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></<?php echo $titletag; ?>>
					<div class="site-tagline"><?php bloginfo( 'description' ); ?></div>
					
			<?php endif; ?>
		</div><!-- end .site-branding -->
			
		<div class="header-right-area col-16 last">
			<div class="site-social col-10">
				<?php if( of_get_option('foto_rss_custom') ) { ?>
					<span class="feed"><a href="<?php echo esc_url( of_get_option('foto_rss_custom') ); ?>" title="<?php esc_attr_e('Subscribe our rss feed', 'foto'); ?>"><?php _e('Rss Feed', 'foto'); ?></a></span>
				<?php } else { ?>
					<span class="feed"><a href="<?php echo get_feed_link( 'rss2' ); ?>" title="<?php esc_attr_e('Subscribe our rss feed', 'foto'); ?>"><?php _e('Rss Feed', 'foto'); ?></a></span>
				<?php }
				
				if( of_get_option('foto_gplus_username') ) { ?>
					<span class="gplus"><a href="<?php echo esc_url( of_get_option('foto_gplus_username') ); ?>" title="<?php esc_attr_e('Add me to your circle', 'foto'); ?>"><?php _e('Google Plus', 'foto'); ?></a></span>
				<?php } if( of_get_option('foto_fb_username') ) { ?>
					<span class="fb"><a href="<?php echo esc_url( of_get_option('foto_fb_username') ); ?>" title="<?php esc_attr_e('Add me as your friend', 'foto'); ?>"><?php _e('Facebook', 'foto'); ?></a></span>
				<?php } if( of_get_option('foto_twitter_username') ) { ?>
					<span class="tw"><a href="<?php echo esc_url( of_get_option('foto_twitter_username') ); ?>" title="<?php esc_attr_e('Follow Me', 'foto'); ?>"><?php _e('Twitter', 'foto'); ?></a></span>
				<?php } ?>
			</div><!-- end .site-social -->
			
			<?php get_search_form(); ?>
		</div><!-- end .header-right-area -->
		
		<?php do_action( 'foto_header' ); ?>
		
	</header><!-- #masthead .site-header -->
	
	<?php do_action( 'foto_after_header' ); ?>
	
	<section class="header-text">
	
		<?php 
			$tag  	= ( is_home() || is_front_page() )? 'p':'h1'; 
			$class  = ( is_singular() )? 'entry-title':'page-title'; 
		?>
		<<?php echo $tag; ?> class="<?php echo $class; ?> col-18">
			<?php foto_page_title(); ?>
		</<?php echo $tag; ?>>
		
	</section><!-- end .header-text -->
	
	<?php do_action( 'foto_before_main' ); ?>
	
	<div id="main" class="main-content clearfix">
		
		<?php do_action( 'foto_main' ); ?>