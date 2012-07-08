<?php
/**
 * The template footer.
 *
 * Display all of the footer contents.
 *
 * @package foto
 * @since foto 0.0.1
 */
?>

	</div><!-- #main -->
	
	<?php do_action( 'foto_after_main' ); ?>
	
	<?php get_sidebar('footer'); ?>
	
	<?php do_action( 'foto_after_footer' ); ?>
	
	<div id="site-credit" class="site-info clearfix">
		<div class="credits col-8">
			<p>&copy; Copyrights <?php echo date('Y'); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></p>
			<p>
				<?php printf( __('Powered by <a href="http://wordpress.org/" title="%1$s" rel="generator">%2$s</a> &middot; Theme by <a href="http://satrya.me/" title="%3$s" rel="designer">%4$s</a>', 'foto'),
					esc_attr( 'A Semantic Personal Publishing Platform'),
					'WordPress',
					esc_attr( 'Satrya'),
					'Satrya'
				); ?>
			</p>
		</div>
		
		<nav class="site-navigation main-navigation col-16 last" role="navigation">
			<?php wp_nav_menu( array (  
						'container' => '',
						'menu_class' => 'main-nav',
						'theme_location' => 'primary' ) 
					); ?>
		</nav> <!-- end .site-navigation .main-navigation -->
	</div><!-- end #site-credit .site-info -->
	
	<?php do_action( 'foto_after' ); ?>
</div><!-- end #page .hfeed -->

<?php wp_footer(); ?>

</body>
</html>