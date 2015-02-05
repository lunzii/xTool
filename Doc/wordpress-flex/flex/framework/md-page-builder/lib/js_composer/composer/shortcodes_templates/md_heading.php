<?php

extract(shortcode_atts(array(
    'class' 		=> '',
    'id' 			=> '',
    'css_animation' => '',
    'css_animation_delay' => '',
    'kind'          => '',
    'text_align'    => '',
    'special_font'  => '',
    'heading_color' => '',
    'color'         => '',
), $atts));

$animated = ($css_animation) ? 'animate' : '';
$css_animation_delay = ($css_animation) ? ' data-delay="'.$css_animation_delay.'"' : '';

$class  = setClass(array('md-heading', $animated, $css_animation, $class, $text_align, $special_font));
$id     = setId($id);
$css_animation  = setAnimation($css_animation);

$style = '';

if($heading_color == 'custom'){
    $style = ' style="color:'.$color.';"';
}

$output .= '<'.$kind.$class.$id.$css_animation_delay.$style.'>';
$output .= wpb_js_remove_wpautop($content);
$output .= '</'.$kind.'>';

echo $output;