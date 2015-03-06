<?php

extract(shortcode_atts(array(
    'class' 			=> '',
    'id' 				=> '',
    'css_animation' => '',
    'css_animation_delay' => '',
    'facebook' 			=> '',
    'twitter' 			=> '',
    'googleplus' 		=> '',
    'pinterest' 			=> ''

), $atts));

$animated = ($css_animation) ? 'animate' : '';
$css_animation_delay = ($css_animation) ? ' data-delay="'.$css_animation_delay.'"' : '';

$class  = setClass(array('md-social-share-classic', $animated, $css_animation, $class));
$id 	= setId($id);

$share_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

$output .= '<div'.$class.$id.$css_animation_delay.'>';
if($facebook == 'yes')
$output .= '<div class="item share-fb"><div class="fb-like" data-href="'.$share_url.'" data-width="450" data-layout="button_count" data-show-faces="false" data-send="false"></div></div>';


if($twitter == 'yes')
$output .= '<div class="item"><a href="https://twitter.com/share" class="twitter-share-button" data-url="'.$share_url.'">Tweet</a></div>';

if($googleplus == 'yes')
$output .= '<div class="item"><div class="g-plusone" data-size="medium" data-action="share" data-annotation="bubble"></div></div>';


if($pinterest == 'yes'){
	$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'medium' );
	$output .= '<div class="item"><a class="pinterest-share" href="//www.pinterest.com/pin/create/button/?url='.$share_url.'&media='. esc_attr( $thumbnail[0] ).'&description='.get_the_title().'" data-pin-do="buttonPin" data-pin-config="beside"><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" /></a></div>';
}

$output .= '</div>';


echo $output;