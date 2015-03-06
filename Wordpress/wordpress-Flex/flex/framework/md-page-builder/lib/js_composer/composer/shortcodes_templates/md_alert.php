<?php



extract(shortcode_atts(array(
    'class' 				=> '',
    'id' 					=> '',
    'css_animation' 		=> '',
    'css_animation_delay'	=> '',
    'kind' 					=> '',
    'icon_show'				=> '',
    'icon_family'           => '',
    'icon_fontawesome'      => '',
    'icon_typicons'         => '',
    'icon_lineicons'        => '',
    'icon_entypo'           => '',

), $atts));

$animated = ($css_animation) ? 'animate' : '';
$css_animation_delay = ($css_animation) ? ' data-delay="'.$css_animation_delay.'"' : '';

$with_icon = ($icon_show) ? 'with-icon' : '';

$class  = setClass(array('md-alert', $animated, $css_animation, $class, $kind, $with_icon));
$id 	= setId($id);


switch($icon_family):
    case 'fontawesome' :
        $icon = $icon_fontawesome;
    break;

    case 'typicons' :
        $icon = $icon_typicons;
    break;

    case 'lineicons' :
        $icon = $icon_lineicons;
    break;

    case 'entypo' :
        $icon = $icon_entypo;
    break;

    default:
        $icon = 'icon-heart';
    break;

endswitch;


$output = '<div class="md-alert-wrap">';
$output .= '<div'.$class.$id.$css_animation_delay.'>';

if($with_icon)
$output .= '<i class="'.$icon.' alert-icon"></i>';


$output .= wpb_js_remove_wpautop($content);
$output .= '<a href="#" class="message-close"><i class="icon-remove"></i></a>';
$output .= '</div>';
$output .= '</div>';

echo $output;
