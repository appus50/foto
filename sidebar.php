<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package foto
 * @since foto 0.0.1
 */
?>
	<aside id="sidebar" class="widget-area col-6 last" role="complementary">
		<?php do_action( 'before_sidebar' ); ?>
		
		<?php if ( ! dynamic_sidebar( 'Page Widget' ) ) : ?>
		<?php endif; // end sidebar widget area ?>
		
	</aside><!-- #sidebar .widget-area -->
