<?php
/**
 * Template Name: Full Width Template
 * Description: A Page Template for displaying a full width content
 *
 * @package foto
 * @since foto 0.0.1
 */
get_header(); ?>
	
	<section id="content" class="site-content" role="main">
		
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'page' ); ?>

			<?php comments_template( '', true ); ?>

		<?php endwhile; // end of the loop. ?>
		
	</section><!-- end #content .site-content -->
	
<?php get_footer(); ?>