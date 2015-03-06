<?php

extract(shortcode_atts(array(
    'class' 				=> '',
    'id' 					=> '',
    'css_animation' 		=> '',
    'css_animation_delay' 	=> '',
    'animate' 				=> '',
    'percent'				=> '',
    'bgcolor'				=> '',
    'trackcolor'			=> '',
    'color'					=> ''
), $atts));

$animated = ($css_animation) ? 'animate' : '';
$css_animation_delay = ($css_animation) ? ' data-delay="'.$css_animation_delay.'"' : '';

$class  = setClass(array('md-progress-bar', $animated, $css_animation, $class, $animate));
$id     = setId($id);

$width = ($animate) ? '' : 'width:'.$percent.'%';

$style = ' style="background-color:'.$trackcolor.'; '.$width.';"';
$color = ' style="color:'.$color.';"';

$output .= '<div'.$class.$id.$css_animation_delay.$color.'>';
$output .= '<div class="bar" style="background-color:'.$bgcolor.'"><span'.$style.' class="increment" data-percent="'.$percent.'"><span class="percent">'.$percent.'%</span></span></div> <span class="lbl">'.wpb_js_remove_wpautop($content).'</span>';
$output .= '</div>';

echo $output;