<?php

extract(shortcode_atts(array(
    'class' 		=> '',
    'id' 			=> '',
    'css_animation' => '',
    'css_animation_delay' => '',
    'padding' 		=> '',
    'height'		=> '',
    'bgattachment' 	=> 'scroll',
    'mask' 			=> '',
    'maskcolor' 	=> '',
    'bgimage' 		=> '',
), $atts));


$animated = ($css_animation) ? 'animate' : '';
$css_animation_delay = ($css_animation) ? ' data-delay="'.$css_animation_delay.'"' : '';

$class  = setClass(array('md-parallax', 'bg-parallax', $animated, $css_animation, $padding, $height, $bgattachment, $class));
$id 	= setId($id);

$bgimage = wp_get_attachment_image_src($bgimage, 'full');

$parallax = ($bgattachment == 'scroll') ? ' data-type="background" data-speed="3"' : '';

$output .= '<div'.$class.$id.$css_animation_delay.' style="background-image:url('.$bgimage[0].')"'.$parallax.'>';

if($mask)
$output .= '<div class="mask" style="background-color:'.$maskcolor.'"></div>';

$output .= '<div class="container">';
$output .= wpb_js_remove_wpautop($content);
$output .= '</div>';
$output .= '</div>';

echo $output;