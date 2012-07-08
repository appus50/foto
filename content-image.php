<?php
/**
 * The template used for displaying content in image.php
 *
 * @package Foto
 * @since Foto 0.0.2
 */
?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
			<div class="primary col-18 last">

				<div class="entry-content">

					<div class="entry-attachment">
					
						<div class="attachment">
							<?php
								/**
								 * Grab the IDs of all the image attachments in a gallery so we can get the URL of the next adjacent image in a gallery,
								 * or the first image (if we're looking at the last image in a gallery), or, in a gallery of one, just the link to that image file
								 */
								$attachments = array_values( get_children( array( 'post_parent' => $post->post_parent, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => 'ASC', 'orderby' => 'menu_order ID' ) ) );
								foreach ( $attachments as $k => $attachment ) {
									if ( $attachment->ID == $post->ID )
										break;
								}
								$k++;
								// If there is more than 1 attachment in a gallery
								if ( count( $attachments ) > 1 ) {
									if ( isset( $attachments[ $k ] ) )
										// get the URL of the next image attachment
										$next_attachment_url = get_attachment_link( $attachments[ $k ]->ID );
									else
										// or get the URL of the first image attachment
										$next_attachment_url = get_attachment_link( $attachments[ 0 ]->ID );
								} else {
									// or, if there's only 1 image, get the URL of the image
									$next_attachment_url = wp_get_attachment_url();
								}
								
								$image_src = wp_get_attachment_image_src( $post->ID, 'full' );
							?>

							<a class="fancyimg" href="<?php echo $image_src[0]; ?>" title="<?php echo esc_attr( get_the_title() ); ?>" rel="attachment"><?php
								$attachment_size = apply_filters( 'foto_attachment_size', array( 1200, 1200 ) ); // Filterable image size.
								echo wp_get_attachment_image( $post->ID, $attachment_size );
							?></a>
						</div><!-- .attachment -->

						<?php if ( ! empty( $post->post_excerpt ) ) : ?>
							<div class="entry-caption">
								<?php the_excerpt(); ?>
							</div>
						<?php endif; ?>
						
					</div><!-- .entry-attachment -->

					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'foto' ), 'after' => '</div>' ) ); ?>

				</div><!-- .entry-content -->
				
				<?php comments_template(); ?>
			
			</div><!-- end .primary -->
			
			<aside class="secondary col-6">

				<div class="entry-meta">
					<div class="content-heading"><?php _e('Image Information', 'foto'); ?></div>

					<ul class="content-data">
						<!-- Meta image 
							 Credit: Responsive Theme by Emil -->
						<?php $foto_data = get_post_meta($post->ID, '_wp_attachment_metadata', true); ?>
						
						<li class="full-size">
							<span class="data-left"><?php _e('Full Size','foto'); ?></span>
							<span class="separator">:</span>
							<span class="data-right"><a class="fancyimg" href="<?php echo wp_get_attachment_url($post->ID); ?>"><?php echo $foto_data['width'] . '&#215;' . $foto_data['height']; ?></a> px</span>
						</li>
						
						<?php if ($foto_data['image_meta']['aperture']) { ?>
						<li class="aperture">
							<span class="data-left"><?php _e('Aperture','foto'); ?></span>
							<span class="separator">:</span>
							<span class="data-right">f/<?php echo $foto_data['image_meta']['aperture']; ?></span>
						</li>
						<?php } ?>

						<?php if ($foto_data['image_meta']['focal_length']) { ?>
						<li class="focal-length">
							<span class="data-left"><?php _e('Focal Length','foto'); ?></span>
							<span class="separator">:</span>
							<span class="data-right"><?php echo $foto_data['image_meta']['focal_length']; ?><?php _e('mm','foto'); ?></span>
						</li>
						<?php } ?>

						<?php if ($foto_data['image_meta']['iso']) { ?>
						<li class="iso">
							<span class="data-left"><?php _e('ISO','foto'); ?></span>
							<span class="separator">:</span>
							<span class="data-right"><?php echo $foto_data['image_meta']['iso']; ?></span>
						</li>
						<?php } ?>

						<?php if ($foto_data['image_meta']['shutter_speed']) { ?>
						<li class="shutter">
							<span class="data-left"><?php _e('Shutter','foto'); ?></span>
							<span class="separator">:</span>
							<span class="data-right"><?php
								if ((1 / $foto_data['image_meta']['shutter_speed']) > 1) {
									echo "1/";
								if (number_format((1 / $foto_data['image_meta']['shutter_speed']), 1) == number_format((1 / $foto_data['image_meta']['shutter_speed']), 0)) {
									echo number_format((1 / $foto_data['image_meta']['shutter_speed']), 0, '.', '') . ' sec';
								} else {
									echo number_format((1 / $foto_data['image_meta']['shutter_speed']), 1, '.', '') . ' sec';
								}
								} else {
									echo $foto_data['image_meta']['shutter_speed'] . ' sec';
								}
							?></span>
						</li>
						<?php } ?>

						<?php if ($foto_data['image_meta']['camera']) { ?>
						<li class="camera">
							<span class="data-left"><?php _e('Camera:','foto'); ?></span>
							<span class="separator">:</span>
							<span class="data-right"><?php echo $foto_data['image_meta']['camera']; ?></span>
						</li>
						<?php } ?>
						
					</ul>
					
				</div><!-- end entry-meta -->
				
				<?php do_action( 'foto_after_entry_meta' ); ?>
				
			</aside><!-- end .secondary -->	
			
			<nav class="site-navigation image-navigation" role="navigation">
				<span class="previous-image"><?php previous_image_link( false, __( '&larr; Previous', 'foto' ) ); ?></span>
				<span class="next-image"><?php next_image_link( false, __( 'Next &rarr;', 'foto' ) ); ?></span>
			</nav><!-- .image-navigation -->
			
		</article><!-- #post-<?php the_ID(); ?> -->