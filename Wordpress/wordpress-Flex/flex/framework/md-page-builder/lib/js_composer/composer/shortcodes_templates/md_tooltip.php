<?php

extract(shortcode_atts(array(
    'class' 		=> '',
    'id' 			=> '',
    'text'			=> '',
    'position'		=> ''
), $atts));

$class  = setClass(array('md-tooltip', $class));
$id     = setId($id);

$output = '<span'.$class.$id.' data-toggle="tooltip" data-placement="'.$position.'" title="'.esc_attr($text).'">'.wpb_js_remove_wpautop($content).'</span>';

echo $output;