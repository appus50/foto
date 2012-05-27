<?php
/**
 * The template used for displaying the full content
 *
 * @package foto
 * @since foto 0.0.1
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
		
		<?php do_action( 'foto_before_entry_singular' ); ?>
		
		<div class="primary col-18 last">
		
			<div class="post-content">
			
				<?php if( has_post_thumbnail() ) : ?>
					<figure class="entry-thumbnail">
						<?php $large_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large'); ?>
						<a class="fancyimg" href="<?php echo $large_image[0]; ?>">
							<?php the_post_thumbnail('foto-single-thumbnail', array( 'class' => 'photo thumbnail', 'alt' => get_the_title(), 'title' => get_the_title()));?>
						</a>
					</figure>
				<?php endif; ?>
				
				<div class="entry-content">
					<p class="content-heading"><?php _e('Description', 'foto'); ?></p>
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'foto' ), 'after' => '</div>' ) ); ?>
				</div>
			</div><!-- end .post-content -->
			
			<?php
				// If comments are open, load up the comment template
				if ( comments_open() )
					comments_template( '', true );
			?>
			
		</div><!-- end .primary -->
		
		<aside class="secondary col-6">
			
			<div class="entry-meta">
				<div class="content-heading"><?php _e('Entry Meta', 'foto'); ?></div>
				<?php foto_entry_meta(); ?>
			</div><!-- end entry-meta -->
			
			<?php do_action( 'foto_after_entry_meta' ); ?>
			
		</aside><!-- end .secondary -->	
		
		<?php foto_content_nav( 'nav-below' ); ?>
		
		<?php do_action( 'foto_after_entry_singular' ); ?>
		
	</article><!-- #post-<?php the_ID(); ?> -->
