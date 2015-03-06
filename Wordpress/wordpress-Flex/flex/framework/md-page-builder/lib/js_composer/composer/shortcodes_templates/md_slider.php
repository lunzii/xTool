<?php

extract(shortcode_atts(array(
    'class' 				=> '',
    'id' 					=> '',
    'css_animation' 		=> '',
    'css_animation_delay' 	=> '',
    'images'				=> '',
    'effect'				=> '',
    'navigation'			=> '',
    'pagination'			=> '',
    'size'                  => 'large',    
), $atts));

$animated = ($css_animation) ? 'animate' : '';
$css_animation_delay = ($css_animation) ? ' data-delay="'.$css_animation_delay.'"' : '';

$class  = setClass(array('md-slider', $animated, $css_animation, $class));
$id 	= setId($id);

$images = explode(',', $images);


$output = '<div'.$class.$id.$css_animation_delay.'>';
	$output .= '<div class="flexslider" data-effect="'.$effect.'" data-navigation="'.$navigation.'" data-pagination="'.$pagination.'"><ul class="slides">';
		foreach($images as $image):
			$image_big  = wp_get_attachment_image_src( $image, $size)        ;	
			$alt 	= ( get_post_meta($image, '_wp_attachment_image_alt', true) ) ? get_post_meta($image, '_wp_attachment_image_alt', true) : '';
			$output .= '<li><img src="'.$image_big[0].'" alt="'.esc_attr($alt).'" /></li>';
		endforeach;
	$output .= '</ul></div>';
$output .= '</div>';
echo $output;