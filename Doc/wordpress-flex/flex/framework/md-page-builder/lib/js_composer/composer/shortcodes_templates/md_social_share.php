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

$class  = setClass(array('md-social-share', $animated, $css_animation, $class));
$id 	= setId($id);


$share_count = new shareCount("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");

$output .= '<div'.$class.$id.$css_animation_delay.'>';
if($facebook == 'yes')
$output .= '<div class="item share-facebook"><a href="#" class="md-social-share-facebook"><i class="icon-facebook"></i><span class="social">Facebook</span></a><span class="count">'.$share_count->get_fb().'</span></div>';

if($twitter == 'yes')
$output .= '<div class="item share-twitter"><a href="#" class="md-social-share-twitter"><i class="icon-twitter"></i><span class="social">Twitter</span></a><span class="count">'.$share_count->get_tweets().'</span></div>';

if($googleplus == 'yes')
$output .= '<div class="item share-google"><a href="#" class="md-social-share-google"><i class="icon-google-plus"></i><span class="social">Google+</span></a><span class="count">'.$share_count->get_plusones().'</span></div>';

if($pinterest == 'yes')
$output .= '<div class="item share-pinterest"><a href="#" class="md-social-share-pinterest"><i class="icon-pinterest"></i><span class="social">Pinterest</span></a><span class="count">'.$share_count->get_pinterest().'</span></div>';

$output .= '</div>';

echo $output;

?>