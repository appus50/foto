<?php
/**
 * The template used for displaying featured content and home sidebar
 *
 * @package foto
 * @since foto 0.0.1
 */
?>

<div class="featured-slider col-18">
	<div class="rslides-container">
	
		<ul class="rslides">
		
			<?php
			// code by justin tadlock & nathan rice 
			// http://justintadlock.com/archives/2009/03/28/get-the-latest-sticky-posts-in-wordpress
			
			$num = of_get_option('foto_featured');
			$featured = get_option( 'sticky_posts' );
			rsort( $featured );
			$featured = array_slice( $featured, 0, $num );
			query_posts( array( 'post__in' => $featured, 'caller_get_posts' => 1 ) );
			?>

			<?php while ( have_posts() ) : the_post(); ?>
			<li>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if( has_post_thumbnail() ) : ?>
						<figure class="entry-image">
							<a href="<?php the_permalink() ?>">
								<?php the_post_thumbnail('foto-featured', array( 'class' => 'photo thumbnail', 'alt' => get_the_title(), 'title' => get_the_title()));?>
							</a>
						</figure>
					<?php endif; ?>
					
					<h2 class="entry-title"><?php the_title(); ?></h2>
				</article><!-- end #post-<?php the_ID(); ?> -->
			</li>
			<?php endwhile; wp_reset_query(); ?>
			
		</ul><!-- end .rslides -->
		
	</div><!-- end .rslides-container -->
</div><!-- end .featured-slider -->

<aside class="featured-sidebar col-6 last">
	<?php do_action( 'before_home_sidebar' ); ?>
	
	<?php if ( ! dynamic_sidebar( 'Home Widget' ) ) : ?>
	<?php endif; ?>
	
</aside><!-- end .featured-sidebar -->