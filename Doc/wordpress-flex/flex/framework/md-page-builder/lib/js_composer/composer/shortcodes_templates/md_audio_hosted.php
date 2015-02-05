<?php



extract(shortcode_atts(array(
    'class' 				=> '',
    'id' 					=> '',
    'css_animation' => '',
    'css_animation_delay' => '',
    'audio_mp3'				=> '',
), $atts));


$animated = ($css_animation) ? 'animate' : '';
$css_animation_delay = ($css_animation) ? ' data-delay="'.$css_animation_delay.'"' : '';

$class  = setClass(array('md-audio-hosted', $class, $animated, $css_animation));
$id 	= setId($id);


$output = '<div'.$class.$id.$css_animation_delay.'>';
$output .= '<audio>';
$output .= '<source src="'.$audio_mp3.'" type="audio/mpeg">';
$output .= '</audio>';
$output .= '</div>';



echo $output;
