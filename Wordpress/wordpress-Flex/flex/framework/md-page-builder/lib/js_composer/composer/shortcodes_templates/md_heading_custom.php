<?php

extract(shortcode_atts(array(
    'class' 		=> '',
    'id' 			=> '',
    'css_animation' => '',
    'css_animation_delay' => '',
    'kind'          => '',
    'text_align'    => '',
    'special_font'  => '',
    'color'         => '',
    'fontsize'      => '',
    'lineheight'    => '',
    'fontweight'    => '',
), $atts));

$animated = ($css_animation) ? 'animate' : '';
$css_animation_delay = ($css_animation) ? ' data-delay="'.$css_animation_delay.'"' : '';

$class  = setClass(array('md-heading', $animated, $css_animation, $class, $text_align, $special_font));
$id     = setId($id);
$css_animation  = setAnimation($css_animation);

$style = ' style="color:'.$color.'; font-size:'.$fontsize.'px; line-height:'.$lineheight.'px; font-weight:'.$fontweight.';"';

$output .= '<'.$kind.$class.$id.$css_animation_delay.$style.'>';
$output .= wpb_js_remove_wpautop($content);
$output .= '</'.$kind.'>';

echo $output;