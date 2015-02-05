<?php 
/**
 * Adds MD_Widget_Flickr widget.
 */
class MD_Widget_Flickr extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'md_widget_flickr', // Base ID
			__('MD Flickr Widget', 'text_domain'), // Name
			array( 'description' => __( 'Show photos from specified Flickr account.', 'text_domain' ), ) // Args
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

			echo '<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count='.$instance['photos'].'&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user='.$instance['userid'].'"></script>';

    	?>

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
			$title = __('FLICKR WIDGET', MD_THEME_NAME);
		}

		if ( isset( $instance[ 'userid' ] ) ) {
			$userid = $instance[ 'userid' ];
		}
		else {
			$userid = '52617155@N08';
		}

		if ( isset( $instance[ 'photos' ] ) ) {
			$photos = $instance[ 'photos' ];
		}
		else {
			$photos = '9';
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', MD_THEME_NAME ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'userid' ); ?>"><?php _e( 'User ID:', MD_THEME_NAME ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'userid' ); ?>" name="<?php echo $this->get_field_name( 'userid' ); ?>" type="text" value="<?php echo esc_attr( $userid ); ?>">
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'photos' ); ?>"><?php _e( 'Photos Count:', MD_THEME_NAME ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'photos' ); ?>" name="<?php echo $this->get_field_name( 'photos' ); ?>" type="text" value="<?php echo esc_attr( $photos ); ?>">
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
		$instance['userid'] = ( ! empty( $new_instance['userid'] ) ) ? strip_tags( $new_instance['userid'] ) : '';
		$instance['photos'] = ( ! empty( $new_instance['photos'] ) ) ? strip_tags( $new_instance['photos'] ) : '';

		return $instance;
	}

} // class MD_Widget_Flickr

// register MD_Widget_Flickr widget
function register_MD_Widget_Flickr() {
    register_widget( 'MD_Widget_Flickr' );
}
add_action( 'widgets_init', 'register_MD_Widget_Flickr' );
?>