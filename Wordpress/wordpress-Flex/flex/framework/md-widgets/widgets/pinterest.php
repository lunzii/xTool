<?php

if(!function_exists('get_pins_feed_list')){
function get_pins_feed_list($username, $count, $boardname = false) {

	$thumbwidth = 80;

	// Get Pinterest Feed(s)
	include_once(ABSPATH . WPINC . '/feed.php');
	if( empty($boardname) ){
		$pinsfeed = 'http://pinterest.com/'.$username.'/feed.rss';
	}
	else $pinsfeed = 'http://pinterest.com/'.$username.'/'.$boardname.'/rss';

	// Get a SimplePie feed object from the Pinterest feed source
	$rss = fetch_feed($pinsfeed);
	if($rss instanceof WP_Error) return '';
	$rss->set_timeout(60);

	// Figure out how many total items there are.               
	$maxitems = $rss->get_item_quantity((int)$count);

	// Build an array of all the items, starting with element 0 (first element).
	$rss_items = $rss->get_items(0,$count);

	$content = '';
	$content .= '<ul>';
		// Loop through each feed item and display each item as a hyperlink.
		foreach ( $rss_items as $item ) : 
				$src = '';

				if ($thumb = $item->get_item_tags(SIMPLEPIE_NAMESPACE_MEDIARSS, 'thumbnail') ) {
					$src = $thumb[0]['attribs']['']['url'];											
				}  else {
					preg_match('/src="([^"]*)"/', $item->get_content(), $matches);
					$src = $matches[1];
				} 
			
			$content .= '<li style="background-image:url('.$src.');">';

				$content .= '<a href="'.$item->get_permalink().'" target="_blank"></a>';

			$content .= '</li>';
		endforeach;
	$content .= '</ul>';

	return $content;

	}
}


/**
 * Adds MD_Widget_Pinterest widget.
 */
class MD_Widget_Pinterest extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'md_widget_pinterest', // Base ID
			__('MD Pinterest Widget', 'text_domain'), // Name
			array( 'description' => __( 'Show photos from specified Pinterest account.', 'text_domain' ), ) // Args
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

			echo get_pins_feed_list($instance['username'], $instance['photos']);

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
			$title = __('PINTEREST WIDGET', MD_THEME_NAME);
		}

		if ( isset( $instance[ 'username' ] ) ) {
			$username = $instance[ 'username' ];
		}
		else {
			$username = 'envato';
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
		<label for="<?php echo $this->get_field_id( 'username' ); ?>"><?php _e( 'Username:', MD_THEME_NAME ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" type="text" value="<?php echo esc_attr( $username ); ?>">
		</p>

		<p>
		<label for="<?php echo $this->get_field_id( 'photos' ); ?>"><?php _e( 'photos Count:', MD_THEME_NAME ); ?></label> 
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
		$instance['username'] = ( ! empty( $new_instance['username'] ) ) ? strip_tags( $new_instance['username'] ) : '';
		$instance['photos'] = ( ! empty( $new_instance['photos'] ) ) ? strip_tags( $new_instance['photos'] ) : '';

		return $instance;
	}

} // class MD_Widget_Pinterest

// register MD_Widget_Pinterest widget
function register_MD_Widget_Pinterest() {
    register_widget( 'MD_Widget_Pinterest' );
}
add_action( 'widgets_init', 'register_MD_Widget_Pinterest' );
?>