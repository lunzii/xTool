<?php

extract(shortcode_atts(array(
    'class'                 => '',
    'id'                    => '',
    'css_animation'         => '',
    'css_animation_delay'   => '',
    'percent'               => '',
    'bgcolor'               => '',
    'color'                 => '',
    'diameter'              => '',
    'track_width'           => ''
), $atts));

$animated = ($css_animation) ? 'animate' : '';
$css_animation_delay = ($css_animation) ? ' data-delay="'.$css_animation_delay.'"' : '';

$class  = setClass(array('md-progress-circular', $animated, $css_animation, $class));
$id     = setId($id);

$output = '<div'.$class.$id.$css_animation_delay.'>';
$output .= '<div class="circular" data-bgcolor="'.$bgcolor.'" data-trackcolor="'.$color.'" data-size="'.$diameter.'" data-line="'.$track_width.'" data-percent="'.$percent.'">';
$output .= '<div class="cont">';
$output .= '<span class="percent">'.$percent.'</span>';
$output .= '<span class="lbl">'.wpb_js_remove_wpautop($content).'</span>';
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';

echo $output;