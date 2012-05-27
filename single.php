<?php
/**
 * The Template for displaying all single posts
 *
 * @package foto
 * @since foto 0.0.1
 */

get_header(); ?>
		
		<?php do_action( 'foto_before_content_singular' ); ?>
		
		<section id="content" class="site-content" role="main">
			
			<?php do_action( 'foto_before_article_singular' ); ?>
			
			<?php while ( have_posts() ) : the_post(); ?>
				
				<?php foto_setPostViews(get_the_ID()); ?>
				<?php get_template_part( 'content', 'single' ); ?>

			<?php endwhile; // end of the loop. ?>
			
			<?php do_action( 'foto_after_article_singular' ); ?>
			
		</section><!-- end #content .site-content -->
		
		<?php do_action( 'foto_after_content_singular' ); ?>
		
<?php get_footer(); ?>