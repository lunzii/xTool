<?php

extract(shortcode_atts(array(
    'class' 				=> '',
    'id' 					=> '',
    'css_animation' 		=> '',
    'css_animation_delay' 	=> '',
    'style' 				=> '',
), $atts));

$animated = ($css_animation) ? 'animate' : '';
$css_animation_delay = ($css_animation) ? ' data-delay="'.$css_animation_delay.'"' : '';

$class  = setClass(array($animated, $css_animation, $class, $style));
$id 	= setId($id);

$output .= '<blockquote'.$class.$id.$css_animation_delay.'>';
$output .= wpb_js_remove_wpautop($content, true);
$output .= '</blockquote>';

echo $output;
