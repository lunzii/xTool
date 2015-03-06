<?php

extract(shortcode_atts(array(
    'class' 		        => '',
    'id'			        => '',
    'css_animation'         => '',
    'css_animation_delay'   => '',
    'list_type'             => '',
    'font_size'             => '',
    'icon_color'            => '',
    'icon_family'           => '',
    'icon_fontawesome'      => '',
    'icon_typicons'         => '',
    'icon_lineicons'        => '',
    'icon_entypo'           => '',
), $atts));


$animated = ($css_animation) ? 'animate' : '';
$css_animation_delay = ($css_animation) ? ' data-delay="'.$css_animation_delay.'"' : '';

$class  = setClass(array('md-list', $animated, $css_animation, $list_type, $font_size));
$id     = setId($id);

$list_el = ($list_type == 'ordered') ? 'ol' : 'ul';


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
$content = rawurldecode(base64_decode(strip_tags($content)));

$output = '<'.$list_el.''.$class.$id.$css_animation_delay.'>';

if($list_type == 'list-icon'){
    $icon = '<i class="'.$icon.' icon" style="color:'.$icon_color.'"></i>';
    $content = preg_replace('/<li>(.*?)<\/li>/s', '<li>'.$icon.'${1}</li>', $content);
}

$output .= $content;

$output .= '</'.$list_el.'>';

echo $output;

