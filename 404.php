<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package foto
 * @since foto 0.0.1
 */

get_header(); ?>
	
	<?php do_action( 'foto_before_404_content' ); ?>
	
	<section id="content" class="site-content" role="main">
		<?php do_action( 'foto_before_404_article' ); ?>
		
			<article id="post-0" class="post error404 not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'Oops! That page can&rsquo;t be found', 'foto' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try you can try to search ?', 'foto' ); ?></p>

					<?php get_search_form(); ?>

				</div><!-- .entry-content -->
				
				<?php do_action( 'foto_after_404_entry' ); ?>
			</article><!-- #post-0 -->
		
		<?php do_action( 'foto_after_404_article' ); ?>
	</section><!-- end #content .site-content -->
	
	<?php do_action( 'foto_after_404_content' ); ?>
	
<?php get_footer(); ?>