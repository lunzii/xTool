<?php


extract(shortcode_atts(array(
    'class' 		=> '',
    'id' 			=> '',
    'css_animation' => '',
    'css_animation_delay' => '',
), $atts));

$animated = ($css_animation) ? 'animate' : '';
$css_animation_delay = ($css_animation) ? ' data-delay="'.$css_animation_delay.'"' : '';

$class  = setClass(array('md-rotator', $animated, $css_animation, $class));
$id 	= setId($id);


$content =  rawurldecode(base64_decode(strip_tags($content)));

$output .= '<div'.$class.$id.$css_animation_delay.'>'.$content.'</div>';

echo $output;