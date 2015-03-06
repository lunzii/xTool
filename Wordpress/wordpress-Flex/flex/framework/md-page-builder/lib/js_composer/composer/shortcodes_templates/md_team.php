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
    'show_name'				=> '',
    'show_presentation'		=> '',
    'show_social'			=> '',
), $atts));

$animated = ($css_animation) ? 'animate' : '';
$css_animation_delay = ($css_animation) ? ' data-delay="'.$css_animation_delay.'"' : '';

$class  = setClass(array('md-team', $animated, $css_animation, $class, 'preview-'.$preview_image));
$id 	= setId($id);


$orderby = ($orderby) ? $orderby : '-1';
if ($category == "All") { $category = ''; }
if ($category == "all") { $category = ''; }

$thumb_size = ($preview_image == 'default') ? 'md-half' : 'md-square';

$args = array(
	'post_type' 				=> 'team',
	'post_status' 				=> 'publish',
	'order'						=> $order,
	'orderby'					=> $orderby,
	'posts_per_page'			=> $posts_per_page,
	'team-categories'			=> $category
);

$items = get_posts( $args );

$social_profiles = array ('email', 'facebook', 'twitter', 'google_plus', 'youtube', 'linkedin', 'pinterest', 'flickr', 'instagram', 'tumblr', 'dribbble', 'apple', 'android');

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
		$member_custom = get_post_custom( $item->ID );

		$output .= '<div class="'.$item_class.'"><div class="md-member">';
			
			$member_name = ($member_custom['member_link'][0]) ? '<a href="'.get_permalink($item->ID).'">'.get_the_title($item->ID).'</a>' : get_the_title($item->ID);

			$member_image = ($member_custom['member_link'][0]) ? '<a href="'.get_permalink($item->ID).'">'.get_the_post_thumbnail($item->ID, $thumb_size).'</a>' : get_the_post_thumbnail($item->ID, $thumb_size);
			
		
			$output .= '<div class="member-image">'.$member_image.'</div>';

			if($show_name){
				$output .= '<div class="member-info"><span class="member-name">'.$member_name.'</span><span class="member-role">'.$member_custom['member_role'][0].'</span></div>';
			}

			if($show_presentation)
			$output .= '<div class="member-content"><p class="member-presentation">'.$member_custom['member_presentation'][0].'</p></div>';

			if($show_social){
				$output .= '<div class="member-social">';
				foreach ($social_profiles as $social):

					if($member_custom['member_social_'.$social][0] != ''):

						$output .= '<a href="'.$member_custom['member_social_'.$social][0].'" class="'.$social.'" target="_blank"></a>';

					endif;

				endforeach;
				$output .= '</div>';
			}

		$output .= '</div></div>';

	endforeach;

	if($carousel){
		$output .= '</div>';
	}

	$output .= '</div>';
$output .= '</div>';

echo $output;
?>