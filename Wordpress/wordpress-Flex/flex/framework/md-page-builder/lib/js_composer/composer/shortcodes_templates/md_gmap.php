<?php
extract(shortcode_atts(array(
    'class' 		=> '',
    'id' 			=> '',
    'css_animation' => '',
    'css_animation_delay' => '',
    'map_type' 		=> '',
    'map_latitude' 	=> '',
    'map_longitude' => '',
    'map_zoom'	 	=> '',
    'map_pin'	 	=> '',
    'map_title'	 	=> '',
    'map_info'	 	=> '',
    'map_height'	=> '',
    'map_scroll'	=> '',
    'map_drag'		=> '',
    'map_zoom_control'			=> '',
    'map_disable_doubleclick'	=> '',
    'map_streetview'	=> '',
), $atts));


$animated = ($css_animation) ? 'animate' : '';
$css_animation_delay = ($css_animation) ? ' data-delay="'.$css_animation_delay.'"' : '';

$class  = setClass(array('md-map', $animated, $css_animation, $class));
$id 	= setId($id, 'map_'.uniqid());

$map_height =  ' style="height:'.$map_height.'px"';
$map_pin = ($map_pin) ? wp_get_attachment_image_src( $map_pin, 'large') : '';


$output = '<div'.$class.$id.$css_animation_delay.$map_height;

$output .= ' data-map-type="'.$map_type.'"';

if($map_latitude)
$output .= ' data-map-lat="'.$map_latitude.'"';

if($map_longitude)
$output .= ' data-map-lon="'.$map_longitude.'"';

if($map_zoom)
$output .= ' data-map-zoom="'.$map_zoom.'"';

if($map_pin)
$output .= ' data-map-pin="'.$map_pin[0].'"';

if($map_title)
$output .= ' data-map-title="'.$map_title.'"';

if($map_info)
$output .= ' data-map-info="'.$map_info.'"';

$output .= ' data-map-scroll="'.$map_scroll.'"';
$output .= ' data-map-drag="'.$map_drag.'"';
$output .= ' data-map-zoom-control="'.$map_zoom_control.'"';
$output .= ' data-map-disable-doubleclick="'.$map_disable_doubleclick.'"';
$output .= ' data-map-streetview="'.$map_streetview.'"';

$output .= '></div>';

echo $output;