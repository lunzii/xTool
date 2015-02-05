<?php

extract(shortcode_atts(array(
    'class' 				=> '',
    'id' 					=> '',
    'css_animation' 		=> '',
    'css_animation_delay' 	=> '',
    'image'					=> '',
    'size'					=> 'full',
    'full_responsive'		=> '',
    'href' 					=> '',
    'target' 				=> '',
), $atts));

$animated = ($css_animation) ? 'animate' : '';
$css_animation_delay = ($css_animation) ? ' data-delay="'.$css_animation_delay.'"' : '';

$class  = setClass(array('md-single-image', $animated, $css_animation, $class, $full_responsive));
$id     = setId($id);

$src    = wp_get_attachment_image_src( $image, $size);
$alt    = ( get_post_meta($image, '_wp_attachment_image_alt', true) ) ? get_post_meta($image, '_wp_attachment_image_alt', true) : '';


$output = '<img src="'.$src[0].'"'.$class.$id.$css_animation_delay.' alt="'.esc_attr($alt).'" />';
if($href){
	($target) ? $target = ' target="_blank"' : $target = '';
	$output = '<a href="'.$href.'"'.$target.'>'.$output.'</a>';
}

echo $output;