<?php
/**
 * The template used for displaying the main content
 *
 * @package foto
 * @since foto 0.0.1
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class('home-content col-6'); ?>>
		
		<?php do_action( 'foto_before_entry' ); ?>
		
		<?php if( has_post_thumbnail() ) : ?>
			<figure class="entry-thumbnail">
				<a href="<?php the_permalink() ?>">
					<?php the_post_thumbnail('foto-home-thumbnail', array( 'class' => 'photo thumbnail', 'alt' => get_the_title(), 'title' => get_the_title()));?>
				</a>
			</figure>
		<?php endif; ?>
		
		<div class="entry-detail">
			<h2 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'foto' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h2>
			
			<div class="entry-meta">
				<?php foto_entry_info(); ?>
			</div>
			
		</div><!-- end .entry-detail -->
		
		<?php do_action( 'foto_after_entry' ); ?>
		
	</article><!-- #post-<?php the_ID(); ?> -->
