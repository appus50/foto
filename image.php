<?php
/**
 * The template for displaying image attachments.
 *
 * @package Foto
 * @since Foto 0.0.2
 */

get_header(); ?>

		<?php do_action( 'foto_before_content_singular' ); ?>
		
		<section id="content" class="site-content" role="main">
			
			<?php do_action( 'foto_before_article_singular' ); ?>
			
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'image' ); ?>

			<?php endwhile; // end of the loop. ?>
			
			<?php do_action( 'foto_after_article_singular' ); ?>
			
		</section><!-- end #content .site-content -->
		
		<?php do_action( 'foto_after_content_singular' ); ?>
		
<?php get_footer(); ?>