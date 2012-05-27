<?php
/**
 * The template for displaying search form
 *
 * @package foto
 * @since foto 0.0.1
 */
?>

<form method="get" id="searchform" class="col-6 last" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
	<label for="s" class="assistive-text"><?php _e( 'Search', 'foto' ); ?></label>
	<input type="text" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search &hellip;', 'foto' ); ?>">
	<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'foto' ); ?>">
</form><!-- end #searchform -->
