<?php

extract(shortcode_atts(array(
    'class' 		=> '',
    'id' 			=> '',
    'css_animation' => '',
    'css_animation_delay' => '',
    'expanded' 		=> '',
    'color_scheme' 		=> '',
), $atts));

$animated = ($css_animation) ? 'animate' : '';
$css_animation_delay = ($css_animation) ? ' data-delay="'.$css_animation_delay.'"' : '';

$class  = setClass(array('md-accordions', $animated, $css_animation, $class, $expanded, $color_scheme));
$id 	= setId($id);

$output = '<div'.$class.$id.$css_animation_delay.'>';
$output .= '<div class="panel-group">';
$output .= wpb_js_remove_wpautop($content, true);
$output .= '</div>';
$output .= '</div>';

echo $output;