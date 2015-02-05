<?php

extract(shortcode_atts(array(
    'class' 		=> '',
    'id' 			=> '',
    'css_animation' => '',
    'css_animation_delay' => '',
    'bgcolor'		=> '',
    'color'			=> ''
), $atts));

$animated = ($css_animation) ? 'animate' : '';
$css_animation_delay = ($css_animation) ? ' data-delay="'.$css_animation_delay.'"' : '';

$class  = setClass(array('md-dropcap', $animated, $css_animation, $class));
$id     = setId($id);

$style = ' style="background-color:'.$bgcolor.'; color:'.$color.'"';


$output = '<span'.$class.$id.$style.$css_animation_delay.'>'.wpb_js_remove_wpautop($content).'</span>';

echo $output;