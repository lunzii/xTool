<?php 
/**
 * Adds MD_Widget_Dribbble widget.
 */
class MD_Widget_Dribbble extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'md_widget_dribbble', // Base ID
			__('MD Dribbble Widget', 'text_domain'), // Name
			array( 'description' => __( 'Show shots from specified Dribbble account.', 'text_domain' ), ) // Args
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
		?>

		<script type="text/javascript">
			jQuery(function($){
				$(".widget_md_widget_dribbble ul").empty();
				var $i = 1;
				$.getJSON("http://api.dribbble.com/players/<?php echo $instance['username']; ?>/shots?callback=?", function(data) {
					$.each(data.shots, function(index, shot) {
						if(index < <?php echo $instance['shots']; ?>) {
							$('.widget_md_widget_dribbble ul').append('<li style="background-image:url(' + shot.image_teaser_url + ')"><a href="' + shot.image_url + '" target="blank">&nbsp;</a></li>');
							$i++;
						}
					});
				});
			});
		</script>	

		<ul><li></li></ul>

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
			$title = __('DRIBBBLE WIDGET', MD_THEME_NAME);
		}

		if ( isset( $instance[ 'username' ] ) ) {
			$username = $instance[ 'username' ];
		}
		else {
			$username = 'ThemesHolic';
		}

		if ( isset( $instance[ 'shots' ] ) ) {
			$shots = $instance[ 'shots' ];
		}
		else {
			$shots = '9';
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', MD_THEME_NAME ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e( 'Username:', MD_THEME_NAME ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" type="text" value="<?php echo esc_attr( $username ); ?>">
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'shots' ); ?>"><?php _e( 'Shots Count:', MD_THEME_NAME ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'shots' ); ?>" name="<?php echo $this->get_field_name( 'shots' ); ?>" type="text" value="<?php echo esc_attr( $shots ); ?>">
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
		$instance['username'] = ( ! empty( $new_instance['username'] ) ) ? strip_tags( $new_instance['username'] ) : '';
		$instance['shots'] = ( ! empty( $new_instance['shots'] ) ) ? strip_tags( $new_instance['shots'] ) : '';

		return $instance;
	}

} // class MD_Widget_Dribbble

// register MD_Widget_Dribbble widget
function register_MD_Widget_Dribbble() {
    register_widget( 'MD_Widget_Dribbble' );
}
add_action( 'widgets_init', 'register_MD_Widget_Dribbble' );
?>