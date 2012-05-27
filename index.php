<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package foto
 * @since foto 0.0.1
 */

get_header(); ?>
		
		<section id="featured" class="site-featured-content clearfix">
		
			<?php get_template_part( 'content', 'featured' ); ?>
			
		</section><!-- end #featured .site-featured-content -->
		
		<?php do_action( 'foto_before_content' ); ?>
		
		<section id="content" class="site-content" role="main">
			
			<?php do_action( 'foto_before_article' ); ?>
			
			<?php query_posts( array(
					"post__not_in" =>get_option("sticky_posts")
				));
				if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content' ); ?>

				<?php endwhile; ?>

				<?php foto_content_nav( 'nav-below' ); ?>

			<?php elseif ( current_user_can( 'edit_posts' ) ) : ?>

				<?php get_template_part( 'no-results', 'index' ); ?>

			<?php endif; ?>
			
			<?php do_action( 'foto_after_article' ); ?>
			
		</section><!-- end #content .site-content -->
		
		<?php do_action( 'foto_after_content' ); ?>
		
<?php get_footer(); ?>