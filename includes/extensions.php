<?php
/**
 * Extension functions for the theme
 *
 * Available theme extensions
 *
 * @package foto
 * @since foto 0.0.1
 */

/**
 * Custom author bio widget
 *
 * @package foto
 * @since foto 0.0.1
 */
class foto_author_bio extends WP_Widget
{
	function foto_author_bio()
	{
		$widget_ops = array('classname' => 'foto_author_bio', 'description' => 'Display your biographical info' );
		$this->WP_Widget('foto_author_bio', '&raquo; Foto Author Bio', $widget_ops);
	}
 
	function form($instance)
	{
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = $instance['title'];
	?>
		<p><?php printf( __('Please complete your bio information on the <a href="%s">Profile Page</a> <em>(fill the nickname, twitter and Biographical Info)</em>', 'foto'), admin_url('profile.php') ); ?></p>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'foto' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>
	<?php
	}
 
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		return $instance;
	}
 
	function widget($args, $instance)
	{
		extract($args, EXTR_SKIP);
 
		$title = apply_filters('widget_title', empty($instance['title']) ? __('Social', 'foto') : $instance['title'], $instance, $this->id_base);
		
		echo $before_widget;
 
		if (!empty($title))
			echo $before_title . $title . $after_title;
		?>
		
		<div class="widget-author-info">
			<p class="author-desc"><?php the_author_meta( 'description' ); ?></p>
			<div class="author-detail">
				<span>
					<p class="author-name"><?php echo get_the_author(); ?></p>
					<p class="author-twitter">
						<a href="<?php echo the_author_meta( 'twitter' ) ?>" class="twitter-follow-button" data-show-count="false">Follow me</a>
						<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
					</p>
				</span>
				<figure class="author-img"><?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'foto_author_bio_avatar_size', 60 ) ); ?></figure>
			</div>
		</div>
		
		<?php
		echo $after_widget;
	}
 
}
 
 
?>