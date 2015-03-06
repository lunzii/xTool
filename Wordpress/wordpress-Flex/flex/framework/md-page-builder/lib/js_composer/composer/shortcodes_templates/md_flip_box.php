<?php

extract(shortcode_atts(array(
    'class' 				=> '',
    'id'					=> '',
    'css_animation' 		=> '',
    'css_animation_delay' 	=> '',
    'content_front' 		=> '',
    'color_front' 			=> '',
    'bgcolor_front' 		=> '',
    'bordercolor_front' 	=> '',
    'content_retro' 		=> '',
    'color_retro' 			=> '',
    'bgcolor_retro' 		=> '',
    'bordercolor_retro' 	=> '',

), $atts));

$animated = ($css_animation) ? 'animate' : '';
$css_animation_delay = ($css_animation) ? ' data-delay="'.$css_animation_delay.'"' : '';

$class  = setClass(array('md-flipbox', $animated, $css_animation, $class));
$id 	= setId($id);

$style_front =  ' style="color:'.$color_front.'; background-color:'.$bgcolor_front.'; border-color:'.$bordercolor_front.'"'; 

$style_retro =  ' style="color:'.$color_retro.'; background-color:'.$bgcolor_retro.'; border-color:'.$bordercolor_retro.'"'; 

$output .= '<div'.$class.$id.$css_animation_delay.'>';
$output .= '
<div class="flip-container" ontouchstart="this.classList.toggle(\'hover\');">
	<div class="flipper">
		<div class="front"'.$style_front.'>
			<div class="cont">
			'.rawurldecode(base64_decode(strip_tags($content_front))).'
			</div>
		</div>
		<div class="back"'.$style_retro.'>
			<div class="cont">
			'.rawurldecode(base64_decode(strip_tags($content_retro))).'
			</div>
		</div>
	</div>
</div>
';

$output .= '</div>';

echo $output;
