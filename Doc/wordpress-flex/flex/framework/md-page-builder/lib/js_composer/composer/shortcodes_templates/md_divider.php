<?php

extract(shortcode_atts(array(
    'class' 		=> '',
    'id' 			=> '',
    'css_animation' => '',
    'css_animation_delay' => '',
    'layout' 		=> '',
    'margin_top'	=> '',
    'margin_bottom' => '',
    'color' => 		'',
), $atts));

$animated = ($css_animation) ? 'animate' : '';
$css_animation_delay = ($css_animation) ? ' data-delay="'.$css_animation_delay.'"' : '';

$class  = setClass(array('md-divider', $animated, $css_animation, $class, $layout));
$id 	= setId($id);

$margin_top = ($margin_top) ? 'margin-top:'.$margin_top.'px;' : '';
$margin_bottom = ($margin_bottom) ? 'margin-bottom:'.$margin_bottom.'px;' : '';

$style = ' style="border-color:'.$color.';'.$margin_top.$margin_bottom.'"';

$span = ($layout == 'thick-solid-center' || $layout == 'thin-solid-center') ? '<span style="background-color:'.$color.'"></span>' : '';

$output .= '<div'.$class.$id.$style.$css_animation_delay.'>'.$span.'</div><div class="clerfix"></div>';

echo $output;
