<?php

extract(shortcode_atts(array(
    'class' 				=> '',
    'id' 					=> '',
    'css_animation' => '',
    'css_animation_delay' => '',
    'video_mp4'				=> '',
    'video_webm' 			=> '',
    'video_ogv'             => '',
    'video_poster'          => '',
    'video_poster_src'      => '',
    'autoplay'              => '',
    'controls'              => '',
), $atts));


$animated = ($css_animation) ? 'animate' : '';
$css_animation_delay = ($css_animation) ? ' data-delay="'.$css_animation_delay.'"' : '';

$hide_controls = ($controls == 'yes') ? '' : 'hide-controls';

$class  = setClass(array('md-video-hosted', $class, $animated, $css_animation, $hide_controls));
$id 	= setId($id);



$autoplay = ($autoplay == 'yes') ? ' autoplay' : '';
$controls = ($controls == 'yes') ? ' controls' : '';


$poster = ($video_poster) ? $video_poster : '';
if($poster)
{
    $poster = wp_get_attachment_image_src( $poster, 'full');    
    $poster = ' poster="'.$poster[0].'"';
}

if($video_poster_src){
    $poster = ' poster="'.$video_poster_src.'"';
}

$output = '<div'.$class.$id.$css_animation_delay.'>';
$output .= '<video'.$poster.$autoplay.$controls.' style="width: 100%; height: 100%;">';
if($video_mp4)
$output .= '<source type="video/mp4" src="'.$video_mp4.'" />';

if($video_webm)
$output .= '<source type="video/webm" src="'.$video_webm.'" />';

if($video_ogv)
$output .= '<source type="video/ogg" src="'.$video_ogv.'" />';

$output .= '</video>';
$output .= '</div>';

echo $output;

