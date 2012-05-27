<?php
/**
 * The Sidebar containing the main widget areas on footer.
 *
 * @package foto
 * @since foto 0.0.1
 */
?>

	<footer id="colophon" class="site-footer clearfix" role="contentinfo">
		
		<div class="footer-1 col-8">
			<?php if ( ! dynamic_sidebar( 'Footer Left Widget' ) ) : ?>
			<?php endif; ?>
		</div><!-- end .footer-1 -->
		
		<div class="footer-2 col-8">
			<?php if ( ! dynamic_sidebar( 'Footer Center Widget' ) ) : ?>
			<?php endif; ?>
		</div><!-- end .footer-2 -->
		
		<div class="footer-3 col-8 last">
			<?php if ( ! dynamic_sidebar( 'Footer Right Widget' ) ) : ?>
			<?php endif; ?>
		</div><!-- end .footer-3 -->
		
	</footer><!-- end #colophon .site-footer -->