<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package foto
 * @since foto 0.0.1
 */

get_header(); ?>
		
		<?php do_action( 'foto_before_content_page' ); ?>
		
		<section id="content" class="site-content col-18" role="main">
			
			<?php do_action( 'foto_before_article_page' ); ?>
			
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

				<?php comments_template( '', true ); ?>

			<?php endwhile; // end of the loop. ?>
			
			<?php do_action( 'foto_after_article_page' ); ?>
			
		</section><!-- end #content .site-content -->
		
		<?php do_action( 'foto_after_content_page' ); ?>
		
<?php get_sidebar(); ?>
<?php get_footer(); ?>