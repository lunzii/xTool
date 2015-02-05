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
    'preview_image'			=> '',
    'show_title'			=> '',
    'show_filter'			=> '',
    'filter_style'			=> 'light',
    'style'					=> 'default',
), $atts));

$animated = ($css_animation) ? 'animate' : '';
$css_animation_delay = ($css_animation) ? ' data-delay="'.$css_animation_delay.'"' : '';
$grid = ($carousel) ? '' : 'grid';
$masonry = ($style == 'masonry') ? 'alternative' : '';

$class  = setClass(array('md-portfolio', $animated, $css_animation, $class, $style, $masonry, $grid));
$id 	= setId($id);


$orderby = ($orderby) ? $orderby : '-1';
if ($category == "All") { $category = ''; }
if ($category == "all") { $category = ''; }

$args = array(
	'post_type' 				=> 'portfolio',
	'post_status' 				=> 'publish',
	'order'						=> $order,
	'orderby'					=> $orderby,
	'posts_per_page'			=> $posts_per_page,
	'portfolio-categories'		=> $category
);

$items = get_posts( $args );

$output = '';

if($show_filter && !$carousel && $style!= 'masonry'){
	$args = array(
		'taxonomy' => 'portfolio-categories',
		'type'	   => 'custom_post_type'
	);
	$categories = get_categories($args); 

	$output .= '<div class="md-portfolio-filter '.$filter_style.' '.$style.'"><span class="current">All</span><span class="lbl">Filter:</span>';
			$output .= '<a href="#" data-filter="*" class="active">All</a>';
		foreach($categories as $category):

			$output .= '<a href="#" data-filter=".'.$category->slug.'">'.($category->name).'</a>';

		endforeach;
	$output .= '</div>';
}

$uniqid = uniqid();

$thumb_size = 'md-half';

$filter = ($show_filter && !$carousel && $style != 'masonry') ? true : false;

$item_class = 'col-md-'.$items_cols.' item';

if($style == 'default'){
	$output .= '<div class="row">';
}
	
	$output .= '<div'.$class.$id.$css_animation_delay.'>';

		if($carousel){
			$item_class = 'item';

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
		}

		if($filter){
			$output .= '<div class="portfolio-filtered">';
		}

		foreach($items as $item):

			$item_cats = wp_get_post_terms($item->ID, 'portfolio-categories');
			$s_class = '';
			foreach($item_cats as $item_cat):
				$s_class .= ' '.$item_cat->slug;
			endforeach;
			
			$work_custom = get_post_custom( $item->ID );
			$work_thumb	= get_the_post_thumbnail($item->ID, $thumb_size);
			$work_expand = wp_get_attachment_image_src( get_post_thumbnail_id( $item->ID ), 'full' );
			if($masonry){
				$work_thumb = get_the_post_thumbnail($item->ID, 'md-'.$work_custom['work_masonry_size'][0]);
				$item_class = 'item item-'.$work_custom['work_masonry_size'][0];
			}


			$output .= '<div class="'.$item_class.$s_class.'">';
				$output .= '<div class="md-work">';
					$output .= '<a href="'.get_permalink($item->ID).'" class="full"></a>';
					$output .= '<div class="work-thumb">';
						$output .= '<a href="'.get_permalink($item->ID).'" class="work-direct">'.$work_thumb.'</a>';
						$output .= '<div class="mask">';
							$output .= '<a href="'.$work_expand[0].'" class="work-expand fancybox" title="'.esc_attr(get_the_title($item->ID)).'" data-fancybox-group="fancy-'.$uniqid.'">'.__("View Larger", MD_THEME_NAME).'</a>';

							$output .= '<a href="'.get_permalink($item->ID).'" class="work-direct">'.__("View Project", MD_THEME_NAME).'</a>';
						$output .= '</div>';
					$output .= '</div>';
					
					$output .= '<div class="work-info">';
						$output .= '<h3 class="work-title"><a href="'.get_permalink($item->ID).'">'.get_the_title($item->ID).'</a></h3>';

						$cats = get_the_terms( $item->ID, 'portfolio-categories' );

						$comma = false;
						$output .= '<div class="work-categories">';
						foreach($cats as $cat){
							if($comma) $output .=', ';
							
							$output .= '<a href="'.get_term_link($cat->term_id, 'portfolio-categories').'">'.$cat->name.'</a>';

							$comma = true;
						}
						$output .= '</div>';
					$output .= '</div>';

				$output .= '</div>';
			$output .= '</div>';

		endforeach;
		
		if($filter){
			$output .= '</div>';
		}

		if($carousel){
			$output .= '</div>';
		}


	$output .= '</div>';

if($style == 'default'){
	$output .= '</div>';
}
echo $output;
?>