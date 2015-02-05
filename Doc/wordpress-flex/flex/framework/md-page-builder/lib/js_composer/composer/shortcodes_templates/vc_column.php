<?php
extract(shortcode_atts(array(
    'class' 		=> '',
    'id' 			=> '',
    'css_animation' => '',
    'css_animation_delay' => '',
    'width' 		=> '1/1',
    'text_align' 	=> '',
    'bgtype'		=> '',
    'bgcolor'       => '',
    'bgcolor_transparency'       => '100',
    'padding'		=> '',
    'padding_custom' => ''
), $atts));

$width = wpb_translateColumnWidthToSpan($width);

$animated = ($css_animation) ? 'animate' : '';
$css_animation_delay = ($css_animation) ? ' data-delay="'.$css_animation_delay.'"' : '';

$class  = setClass(array($animated, $css_animation, $class, $text_align));
$id 	= setId($id);
$style 	= '';

if($bgtype || $padding == 'padding-custom'){
	$style = ' style="';

	if($bgtype)
    $style .= ' background-color:'.hex2rgb($bgcolor, $bgcolor_transparency/100).';';

	if($padding && $padding == 'padding-custom')
	$style .= ' padding:'.$padding_custom.'px;';
	
	$style .= '"';
}

$output .= "\n\t\t\t".'<div'.$class.$id.$css_animation_delay.$style.'>';
$output .= wpb_js_remove_wpautop($content);
$output .= "\n\t\t\t".'</div>';

echo $output;