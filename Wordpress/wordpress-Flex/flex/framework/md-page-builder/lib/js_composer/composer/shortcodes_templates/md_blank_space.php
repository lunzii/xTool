<?php


extract(shortcode_atts(array(
    'class' 		=> '',
    'id' 			=> '',
    'height'  		=> '',
), $atts));

$class  = setClass(array('clearfix', $class));
$id     = setId($id);

$output .= '<div'.$class.$id.' style="height:'.$height.'px"></div>';

echo $output;
