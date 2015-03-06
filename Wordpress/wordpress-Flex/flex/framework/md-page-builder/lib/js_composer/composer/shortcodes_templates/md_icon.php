<?php

extract(shortcode_atts(array(
    'class' 		        => '',
    'id'			        => '',
    'css_animation'         => '',
    'css_animation_delay'   => '',
    'icon'                  => '',
    'icon_family'           => '',
    'icon_fontawesome'      => '',
    'icon_typicons'         => '',
    'icon_lineicons'        => '',
    'icon_entypo'           => '',
    'icon_size'             => '',
    'icon_style'            => '',
    'icon_color'            => '',
    'icon_color_hover'      => '',
    'icon_border_color'     => '',
    'icon_border_color_hover' => '',
    'icon_bg_color'         => '',
    'icon_bg_color_hover'   => '',
), $atts));

$animated = ($css_animation) ? 'animate' : '';
$css_animation_delay = ($css_animation) ? ' data-delay="'.$css_animation_delay.'"' : '';

$class  = setClass(array('md-icon', $animated, $css_animation, $icon_style));
$id     = setId($id);
$style  = '';
$style_temp = '';

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
endswitch;

$data_hover = '';
switch ($icon_style){

    case 'style-round':
    case 'style-circle':
    case 'style-square':
    case 'style-rhombus':
       $style_box = ' style="border-color:'.$icon_border_color.';"';
       $data_hover = ' data-color="'.$icon_color.'" data-bg="transparent" data-border="'.$icon_border_color.'" data-color-hover="'.$icon_color_hover.'" data-bg-hover="'.$icon_bg_color_hover.'" data-border-hover="'.$icon_border_color_hover.'"';
    break;

    case 'style-round fill':
    case 'style-circle fill':
    case 'style-square fill':
    case 'style-rhombus fill':
        $style_box = ' style="border-color:'.$icon_border_color.'; background-color:'.$icon_bg_color.';"';
        $data_hover = ' data-color="'.$icon_color.'" data-bg="'.$icon_bg_color.'" data-border="'.$icon_border_color.'" data-color-hover="'.$icon_color_hover.'" data-bg-hover="'.$icon_bg_color_hover.'" data-border-hover="'.$icon_border_color_hover.'"';
    break;

    default:
        $data_hover = ' data-color="'.$icon_color.'" data-color-hover="'.$icon_color_hover.'"';
        $style_box = false;
    break;
}

$style_icon = 'color:'.$icon_color.';';

$icon_size = ($icon_size) ? ' font-size:'.$icon_size.'px; line-height:'.$icon_size.'px;' : '';
$style = ' style="'.$style_icon.$icon_size.'"';


$output = '<div'.$class.$id.$css_animation_delay.$style_box.'><i class="'.$icon.'"'.$style.$data_hover.'></i></div>';

echo $output;