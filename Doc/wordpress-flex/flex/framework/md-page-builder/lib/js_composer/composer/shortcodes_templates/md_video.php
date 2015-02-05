<?php

extract(shortcode_atts(array(
    'class' 		=> '',
    'id' 			=> '',
    'css_animation' => '',
    'css_animation_delay' => '',
    'type'	 		=> '',
    'video_id'		=> '',
), $atts));

$animated = ($css_animation) ? 'animate' : '';
$css_animation_delay = ($css_animation) ? ' data-delay="'.$css_animation_delay.'"' : '';

$class  = setClass(array('md-video', $animated, $css_animation, $class));
$id 	= setId($id);

if ($type == 'youtube'){

	$embed = '<iframe src="//www.youtube.com/embed/'.$video_id.'" allowfullscreen></iframe>';

}
else if ($type == 'vimeo'){

	$embed = '<iframe src="//player.vimeo.com/video/'.$video_id.'" allowfullscreen></iframe>';

}


$output .= '<div'.$class.$id.$css_animation_delay.'>'.$embed.'</div>';

echo $output;