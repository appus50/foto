<?php
/**
 * Sticky Post Slider Template
 *
 * @package foto
 * @author	Satrya
 * @license	license.txt
 * @since 	1.0
 */
?>

<?php if( of_get_option( 'foto_show_featured' ) ) : ?>
	<section id="featured" class="site-featured-content clearfix">

		<?php 
		$sticky = get_option( 'sticky_posts' );
		if ( ! empty( $sticky ) ) : ?>

		<div class="featured-slider col-18">
			<div class="rslides-container">
			
				<ul class="rslides">
				
					<?php
					global $post;
					$args = array(
						'post__in' => $sticky
					);

					$slides = get_posts( $args ); ?>

					<?php foreach( $slides as $post ) : setup_postdata( $post ); ?>

						<li>
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<?php if( has_post_thumbnail() ) : ?>
									<figure class="entry-image">
										<a href="<?php the_permalink() ?>">
											<?php the_post_thumbnail('foto-featured', array( 'class' => 'photo thumbnail', 'alt' => get_the_title(), 'title' => get_the_title()));?>
										</a>
									</figure>
								<?php endif; ?>
								
								<h2 class="entry-title"><?php the_title(); ?></h2>
							</article><!-- end #post-<?php the_ID(); ?> -->
						</li>

					<?php endforeach; wp_reset_postdata(); ?>
					
				</ul><!-- end .rslides -->
				
			</div><!-- end .rslides-container -->
		</div><!-- end .featured-slider -->

		<?php endif; ?>

		<aside class="featured-sidebar col-6 last">
			<?php do_action( 'before_home_sidebar' ); ?>
			
			<?php if ( ! dynamic_sidebar( 'Home Widget' ) ) : ?>
			<?php endif; ?>
			
		</aside><!-- end .featured-sidebar -->

	</section><!-- end #featured .site-featured-content -->
<?php endif; ?>