<?php

extract(shortcode_atts(array(
    'class' 		=> '',
    'id' 			=> '',
    'css_animation' => '',
    'css_animation_delay' => '',
    'special_font'  => '',
    'fontsize'      => '',
    'lineheight'    => '',
    'fontweight'    => '',
    'color'         => '',
    'style'         => '',
    'border_color'  => '',
), $atts));

$animated = ($css_animation) ? 'animate' : '';
$css_animation_delay = ($css_animation) ? ' data-delay="'.$css_animation_delay.'"' : '';

$class  = setClass(array('md-special-heading', $animated, $css_animation, $class, $special_font, $style, $border_color));
$id 	= setId($id);

$style = ' style="font-size:'.$fontsize.'px; line-height:'.$lineheight.'px; font-weight:'.$fontweight.'; color:'.$color.';"';

$output = '<div'.$class.$id.$css_animation_delay.'>';
$output .= '<span'.$style.'>'.wpb_js_remove_wpautop($content).'</span>';
$output .= '</div>';

echo $output;