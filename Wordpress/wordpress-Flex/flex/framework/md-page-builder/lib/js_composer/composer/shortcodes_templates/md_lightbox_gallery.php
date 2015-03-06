<?php

extract(shortcode_atts(array(
    'class' 				=> '',
    'id' 					=> '',
    'css_animation' 		=> '',
    'css_animation_delay' 	=> '',
    'images'				=> '',
    'only_first'			=> '',
    'items_cols'			=> '',
    'thumb_size'			=> 'md-thumb',
    'image_size'			=> 'large',    
), $atts));

$animated = ($css_animation) ? 'animate' : '';
$css_animation_delay = ($css_animation) ? ' data-delay="'.$css_animation_delay.'"' : '';

$class  = setClass(array('md-lightbox-gallery', $animated, $css_animation, $class));
$id 	= setId($id);

$images = explode(',', $images);
$uniqid = uniqid();

$output = '<div'.$class.$id.$css_animation_delay.'>';
	$output .= '<div class="row">';
		$x = 1;
		foreach($images as $image):
			$hide = ($x!=1 && $only_first) ? ' style="display:none"' : '';
			$x = 2;

			$thumb  = wp_get_attachment_image_src( $image, $thumb_size);	
			$image_big  = wp_get_attachment_image_src( $image, $image_size);	
			$alt 	= ( get_post_meta($image, '_wp_attachment_image_alt', true) ) ? get_post_meta($image, '_wp_attachment_image_alt', true) : '';
			$output .= '<div class="col-md-'.$items_cols.'"'.$hide.'>';
				$output .= '<div class="md-lightbox image">';
					$output .= '<span class="mask"><a href="'.$image_big[0].'" class="fancybox" title="'.esc_attr($alt).'" data-fancybox-group="fancy-gallery-'.$uniqid.'"></a></span>';
					$output .= '<img src="'.$thumb[0].'" alt="'.esc_attr($alt).'" />';
				$output .= '</div>';
			$output .= '</div>';
		endforeach;
	$output .= '</div>';
$output .= '</div>';
echo $output;