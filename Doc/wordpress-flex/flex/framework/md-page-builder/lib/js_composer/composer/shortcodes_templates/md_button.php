<?php
extract(shortcode_atts(array(
    'class' 		        => '',
    'id' 			        => '',
    'css_animation'         => '',
    'css_animation_delay'   => '',
    'size'  		        => false,
    'href'                  => '',
    'target'                => '',
    'style'                 => '',
    'bgcolor'               => '',
    'color'                 => '',
    'colorhover'            => '',
    'icon_show'             => '',
    'icon_family'           => '',
    'icon_fontawesome'      => '',
    'icon_typicons'         => '',
    'icon_lineicons'        => '',
    'icon_entypo'           => '',
), $atts));

$animated = ($css_animation) ? 'animate' : '';
$css_animation_delay = ($css_animation) ? ' data-delay="'.$css_animation_delay.'"' : '';

$class  = setClass(array('md-button', $animated, $css_animation, $class, $size, $style, $icon_show));
$id     = setId($id);



if($style == 'style-1'){
    $style = ' style="background-color:'.$bgcolor.'; border-color:'.$bgcolor.'; color:'.$color.';"';
}
else{
    $style = ' style="border-color:'.$color.'; color:'.$color.';"';
}
$data_hover = ' data-color="'.$color.'" data-color-hover="'.$colorhover.'"';


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


$output .= '<a href="'.$href.'"'.$class.$id.$target.$style.$data_hover.$css_animation_delay.'>';
$output .= '<span class="lbl"></span>';
if($icon_show)
$output .= '<i class="'.$icon.'"></i>';

$output .= wpb_js_remove_wpautop($content);
$output .= '</a>';

if($content)
echo $output;

