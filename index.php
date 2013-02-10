<?php
/**
 * Index Template
 * 
 * This is the default template. It is used when a more specific template can't be found to display
 * posts.
 *
 * @package foto
 * @author	Satrya
 * @license	license.txt
 * @since 	1.0
 */

get_header(); ?>
		
		<?php get_template_part( 'content', 'featured' ); ?>
		
		<?php do_action( 'foto_before_content' ); ?>
		
		<section id="content" class="site-content" role="main">
			
			<?php do_action( 'foto_before_article' ); ?>
			
				<?php
			  	$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			  	
		        $args = array(
	                'paged' => $paged,
					'post__not_in' => get_option( 'sticky_posts' )		
		        );

		        $post_query = new WP_Query( $args );

					if ( $post_query->have_posts() ) : ?>

					<?php while ( $post_query->have_posts() ) : $post_query->the_post(); ?>

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