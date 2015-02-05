<?php

extract(shortcode_atts(array(
    'class' 		=> '',
    'id' 			=> '',
    'css_animation' => '',
    'css_animation_delay' => '',
    'color_scheme'	=> ''
), $atts));

$animated = ($css_animation) ? 'animate' : '';
$css_animation_delay = ($css_animation) ? ' data-delay="'.$css_animation_delay.'"' : '';

$class  = setClass(array('md-tabs md-tours', $animated, $css_animation, $class, $color_scheme));
$id 	= setId($id);

$output = '<div'.$class.$id.$css_animation_delay.'>';
$output .= '<ul class="nav nav-tabs">';
$GLOBALS['tabs'] = 'nav';
$output .= wpb_js_remove_wpautop($content);
$output .= '</ul>';
$GLOBALS['tabs'] = 'content';
$output .= '<div class="tab-content">';
$output .= wpb_js_remove_wpautop($content, true);
$output .= '</div>';
$output .= '</div>';


echo $output;