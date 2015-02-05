<?php
extract(shortcode_atts(array(
    'class' => '',
    'id' 	=> '',
    'alias' => ''
), $atts));


$class  = setClass(array('md-revslider', $class));
$id     = setId($id);


echo '<div'.$class.$id.'>'.do_shortcode( "[rev_slider ".$alias."]" ).'</div>';