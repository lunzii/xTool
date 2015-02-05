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
    'carousel'				=> '',
    'carousel_navigation'	=> '',
    'carousel_pagination'	=> '',
    'carousel_autoplay'		=> '',
), $atts));

$animated = ($css_animation) ? 'animate' : '';
$css_animation_delay = ($css_animation) ? ' data-delay="'.$css_animation_delay.'"' : '';
$grid = ($carousel) ? '' : 'grid';

$class  = setClass(array('md-testimonials', $animated, $css_animation, $class, $grid));
$id 	= setId($id);


$orderby = ($orderby) ? $orderby : '-1';
if ($category == "All") { $category = ''; }
if ($category == "all") { $category = ''; }


$args = array(
	'post_type' 				=> 'testimonials',
	'post_status' 				=> 'publish',
	'order'						=> $order,
	'orderby'					=> $orderby,
	'posts_per_page'			=> $posts_per_page,
	'testimonials-categories'	=> $category
);

$items = get_posts( $args );

$output = '<div'.$class.$id.$css_animation_delay.'>';

	$output .= '<div class="row">';

	$item_class = 'col-md-'.$items_cols.' item';

	if($carousel){
		switch ($items_cols):
			case 12:
				$items_cols = 1;
			break;

			case 6:
				$items_cols = 2;
			break;

			case 4:
				$items_cols = 3;
			break;

			case 3:
				$items_cols = 4;
			break;

			case 2:
				$items_cols = 6;
			break;

		endswitch;

		$output .= '<div class="md-carousel" data-items="'.$items_cols.'" data-navigation="'.$carousel_navigation.'" data-pagination="'.$carousel_pagination.'" data-autoplay="'.$carousel_autoplay.'">';

		$item_class = 'item';
	}

	foreach($items as $item):
		$testimonial_custom = get_post_custom( $item->ID );
		$output .= '<div class="'.$item_class.'"><div class="md-testimonial"><div class="testimonial-content"><p class="testimonial-quote">'.$testimonial_custom['testimonial_cite_text'][0].'</p></div><div class="testimonial-image">'.get_the_post_thumbnail($item->ID, 'full').'</div><div class="testimonial-info"><span class="testimonial-author">'.$testimonial_custom['testimonial_cite_name'][0].'</span><span class="testimonial-company"><a href="'.$testimonial_custom['testimonial_company_url'][0].'" target="_blank">'.$testimonial_custom['testimonial_company'][0].'</a></span></div></div></div>';
	endforeach;

	if($carousel){
		$output .= '</div>';
	}

	$output .= '</div>';
$output .= '</div>';

echo $output;
?>