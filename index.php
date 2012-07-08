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
		
		<?php if( of_get_option('foto_show_featured') ) : ?>
			<section id="featured" class="site-featured-content clearfix">
			
				<?php get_template_part( 'content', 'featured' ); ?>
				
			</section><!-- end #featured .site-featured-content -->
		<?php endif; ?>
		
		<?php do_action( 'foto_before_content' ); ?>
		
		<section id="content" class="site-content" role="main">
			
			<?php do_action( 'foto_before_article' ); ?>
			
			<?php
				$paged = 1;
				if ( get_query_var( 'paged' ) ) { $paged = get_query_var( 'paged' ); }
				if ( get_query_var( 'page' ) ) { $paged = get_query_var( 'page' ); }
				$paged = intval( $paged );
				
				if( of_get_option('foto_show_featured') ) {
					$args = array(
						'post__not_in' => get_option('sticky_posts'),
						'paged' => $paged,
					);
					query_posts( $args );
				}
				
				if ( have_posts() ) : 
			?>

				<?php while ( have_posts() ) : the_post(); ?>

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