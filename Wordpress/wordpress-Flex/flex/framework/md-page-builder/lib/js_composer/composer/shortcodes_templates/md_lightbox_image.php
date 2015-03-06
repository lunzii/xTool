<?php

extract(shortcode_atts(array(
    'class' 		=> '',
    'id' 			=> '',
    'css_animation' => '',
    'css_animation_delay' => '',
    'thumb'			=> '',
    'image'			=> '',
    'thumb_size'	=> 'md-thumb',
    'image_size'	=> 'large',    
), $atts));

$animated = ($css_animation) ? 'animate' : '';
$css_animation_delay = ($css_animation) ? ' data-delay="'.$css_animation_delay.'"' : '';

$class  = setClass(array('md-lightbox', 'image', $animated, $css_animation, $class));
$id 	= setId($id);

$alt 	= ( get_post_meta($image, '_wp_attachment_image_alt', true) ) ? get_post_meta($image, '_wp_attachment_image_alt', true) : '';
$thumb  = wp_get_attachment_image_src( $thumb, $thumb_size);
$image  = wp_get_attachment_image_src( $image, $image_size);

$output = '<div'.$class.$id.$css_animation_delay.'>';
$output .= '<span class="mask"><a href="'.$image[0].'" class="fancybox" title="'.esc_attr($alt).'"></a></span>';
$output .= '<img src="'.$thumb[0].'" alt="'.esc_attr($alt).'" />';
$output .= '</div>';

echo $output;