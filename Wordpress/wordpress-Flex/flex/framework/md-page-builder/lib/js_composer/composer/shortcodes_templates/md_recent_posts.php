<?php
extract(shortcode_atts(array(
    'class' 				=> '',
    'id' 					=> '',
    'css_animation'			=> '',
    'css_animation_delay'	=> '',
    'items_cols'			=> '',
    'posts_per_page'		=> '-1',
    'orderby'				=> '',
    'order'					=> '',
    'category'				=> '',
    'show_image'			=> ''
), $atts));

$animated = ($css_animation) ? 'animate' : '';
$css_animation_delay = ($css_animation) ? ' data-delay="'.$css_animation_delay.'"' : '';
$show_image = ($show_image) ? 'show-image' : false;


$class  = setClass(array('md-recent-posts md-blog', $animated, $css_animation, $class, $show_image));
$id 	= setId($id);


$orderby = ($orderby) ? $orderby : '-1';
if ($category == "All") { $category = ''; }
if ($category == "all") { $category = ''; }


$args = array(
	'post_status' 			=> 'publish',
	'order'					=> $order,
	'orderby'				=> $orderby,
	'posts_per_page'		=> $posts_per_page,
	//'clients-categories'	=> $category
	'tax_query' => array(
		array(
			'taxonomy' => 'post_format',
			'field' => 'slug',
			'terms' => 'post-format-quote',
			'operator' => 'NOT IN'
		),
		array(
			'taxonomy' => 'post_format',
			'field' => 'slug',
			'terms' => 'post-format-link',
			'operator' => 'NOT IN'
		),
		array(
			'taxonomy' => 'post_format',
			'field' => 'slug',
			'terms' => 'post-format-aside',
			'operator' => 'NOT IN'
		),
		array(
			'taxonomy' => 'post_format',
			'field' => 'slug',
			'terms' => 'post-format-chat',
			'operator' => 'NOT IN'
		)
	)
);

$items = new WP_Query( $args );

$output = '';

$item_class = 'col-md-'.$items_cols;

$output .= '<div class="row">';

	$output .= '<div'.$class.$id.$css_animation_delay.'>';

		while($items->have_posts()) : $items->the_post();

			$post_id = $items->post->ID;

			$format = (get_post_format($post_id)) ? get_post_format($post_id) : 'standard';

			$output .= '<div class="'.$item_class.'">';
				$output .= '<article class="post-'.$post_id.' post format-'.$format.'">';

				if($show_image){
					$output .= '<div class="featured-image"><a href="'.get_permalink().'" title="'.esc_attr(get_the_title()).'">'.get_the_post_thumbnail($post_id, 'md-two-thirds').'</a></div>';
				}

				$output .= '<div class="post-body">';
				
					$output .= '<div class="post-side">';
						$output .= '<div class="meta-date">';
							$output .= '<span class="meta-day">'.get_the_date('d').'</span>';
							$output .= '<span class="meta-month">'.get_the_date('M').'</span>';
						$output .= '</div>';
					$output .= '</div>';

					$output .= '<h3 class="post-title"><a href="'.get_permalink().'" title="'.esc_attr(get_the_title()).'">'.get_the_title().'</a></h3>';

					$output .= substr(get_the_excerpt(), 0, 140).'...';

				$output .= '</div>';

					
				
				$output .= '</article>';
			$output .= '</div>';

		endwhile;

	$output .= '</div>';
	
$output .= '</div>';

wp_reset_query();

echo $output;
?>