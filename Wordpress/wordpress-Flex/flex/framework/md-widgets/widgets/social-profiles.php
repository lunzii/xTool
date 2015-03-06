<?php 
/**
 * Adds MD_Widget_Social_Profiles widget.
 */
class MD_Widget_Social_Profiles extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'md_widget_social_profiles', // Base ID
			__('MD Social Profiles', 'text_domain'), // Name
			array( 'description' => __( 'Show your social profiles.', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];

		global $theme_options;
		?>

		<?php if(isset($theme_options['social-rss']) && $theme_options['social-rss']): ?>
			<a class="rss" href="<?php echo $theme_options['social-rss']; ?>" title="rss" target="_blank" ><i class="icon-rss"></i></a>
		<?php endif; ?>

		<?php if(isset($theme_options['social-facebook']) && $theme_options['social-facebook']): ?>
			<a class="facebook" href="<?php echo $theme_options['social-facebook']; ?>" title="facebook" target="_blank" ><i class="icon-facebook"></i></a>
		<?php endif; ?>

		<?php if(isset($theme_options['social-twitter']) && $theme_options['social-twitter']): ?>
			<a class="twitter" href="<?php echo $theme_options['social-twitter']; ?>" title="twitter" target="_blank" ><i class="icon-twitter"></i></a>
		<?php endif; ?>

		<?php if(isset($theme_options['social-google-plus']) && $theme_options['social-google-plus']): ?>
			<a class="google" href="<?php echo $theme_options['social-google-plus']; ?>" title="google" target="_blank" ><i class="icon-google-plus"></i></a>
		<?php endif; ?>

		<?php if(isset($theme_options['social-youtube']) && $theme_options['social-youtube']): ?>
			<a class="youtube" href="<?php echo $theme_options['social-youtube']; ?>" title="youtube" target="_blank" ><i class="icon-youtube"></i></a>
		<?php endif; ?>

		<?php if(isset($theme_options['social-linkedin']) && $theme_options['social-linkedin']): ?>
			<a class="linkedin" href="<?php echo $theme_options['social-linkedin']; ?>" title="linkedin" target="_blank" ><i class="icon-linkedin"></i></a>
		<?php endif; ?>

		<?php if(isset($theme_options['social-pinterest']) && $theme_options['social-pinterest']): ?>
			<a class="pinterest" href="<?php echo $theme_options['social-pinterest']; ?>" title="pinterest" target="_blank" ><i class="icon-pinterest"></i></a>
		<?php endif; ?>

		<?php if(isset($theme_options['social-flickr']) && $theme_options['social-flickr']): ?>
			<a class="flickr" href="<?php echo $theme_options['social-flickr']; ?>" title="flickr" target="_blank" ><i class="icon-flickr"></i></a>
		<?php endif; ?>

		<?php if(isset($theme_options['social-instagram']) && $theme_options['social-instagram']): ?>
			<a class="instagram" href="<?php echo $theme_options['social-instagram']; ?>" title="instagram" target="_blank" ><i class="icon-instagram"></i></a>
		<?php endif; ?>

		<?php if(isset($theme_options['social-apple']) && $theme_options['social-apple']): ?>
			<a class="apple" href="<?php echo $theme_options['social-apple']; ?>" title="apple" target="_blank" ><i class="icon-apple"></i></a>
		<?php endif; ?>

		<?php if(isset($theme_options['social-tumblr']) && $theme_options['social-tumblr']): ?>
			<a class="tumblr" href="<?php echo $theme_options['social-tumblr']; ?>" title="tumblr" target="_blank" ><i class="icon-tumblr"></i></a>
		<?php endif; ?>

		<?php if(isset($theme_options['social-dribbble']) && $theme_options['social-dribbble']): ?>
			<a class="dribbble" href="<?php echo $theme_options['social-dribbble']; ?>" title="dribbble" target="_blank" ><i class="icon-dribbble"></i></a>
		<?php endif; ?>

		<?php if(isset($theme_options['social-android']) && $theme_options['social-android']): ?>
			<a class="android" href="<?php echo $theme_options['social-android']; ?>" title="android" target="_blank" ><i class="icon-android"></i></a>
		<?php endif; ?>

		<?php if(isset($theme_options['social-email']) && $theme_options['social-email']): ?>
			<a class="email" href="mailto:<?php echo $theme_options['social-email']; ?>" title="email" target="_self" ><i class="icon-envelope"></i></a>
		<?php endif; ?>	

		<?php	
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __('SOCIAL PROFILES', MD_THEME_NAME);
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', MD_THEME_NAME ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

} // class MD_Widget_Social_Profiles

// register MD_Widget_Social_Profiles widget
function register_MD_Widget_Social_Profiles() {
    register_widget( 'MD_Widget_Social_Profiles' );
}
add_action( 'widgets_init', 'register_MD_Widget_Social_Profiles' );
?>