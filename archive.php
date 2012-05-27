<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package foto
 * @since foto 0.0.1
 */

get_header(); ?>

		<section id="content" class="site-content" role="main">

			<?php if ( have_posts() ) : ?>
			
				<?php rewind_posts(); ?>
				<?php foto_content_nav( 'nav-above' ); ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content' ); ?>

				<?php endwhile; ?>

				<?php foto_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'archive' ); ?>

			<?php endif; ?>

		</section><!-- end #content .site-content -->

<?php get_footer(); ?>