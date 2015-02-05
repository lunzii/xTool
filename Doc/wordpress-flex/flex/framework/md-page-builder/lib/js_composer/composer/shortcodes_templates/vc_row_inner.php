<?php
extract(shortcode_atts(array(
    'class' 		=> '',
    'id' 			=> '',
    'css_animation' => '',
    'css_animation_delay' => '',
    'text_align' 	=> '',
), $atts));

$animated = ($css_animation) ? 'animate' : '';
$css_animation_delay = ($css_animation) ? ' data-delay="'.$css_animation_delay.'"' : '';

$class  = setClass(array('row', $animated, $css_animation, $class, $text_align));
$id 	= setId($id);

$output .= "\n\t\t\t".'<div'.$class.$id.$css_animation_delay.'>';
$output .= wpb_js_remove_wpautop($content);
$output .= "\n\t\t\t".'</div>';

echo $output;

