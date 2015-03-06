<?php

extract(shortcode_atts(array(
    'class'                 => '',
    'id'                    => '',
    'css_animation'         => '',
    'css_animation_delay'   => '',
    'start_delay' 		    => '',
    'start' 			    => '',
    'end'                   => '',
    'speed'                 => '',
    'number_color'          => '',
    'number_font_size'      => '',
    'label_text'            => '',
    'label_color'           => '',
    'label_font_size'       => '',    
    'icon_show'             => '',
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

$class  = setClass(array('md-counter', $animated, $css_animation, $class));
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

$output .= '<div'.$class.$id.$css_animation_delay.'>';

if($icon_show)
$output .= do_shortcode('[md_icon icon="'.$icon.'" icon_size="'.$icon_size.'" icon_style="'.$icon_style.'" icon_color="'.$icon_color.'" icon_bg_color="'.$icon_bg_color.'" icon_border_color="'.$icon_border_color.'"]');

$output .= '<span class="number" data-delay="'.$start_delay.'" data-from="'.intval($start).'" data-to="'.intval($end).'" data-speed="'.$speed.'" style="color:'.$number_color.'; font-size:'.$number_font_size.'px;">'.$start.'</span>';
$output .= '<span class="label" style="color:'.$label_color.'; font-size:'.$label_font_size.'px;">'.$label_text.'</span>';
$output .= '</div>';

echo $output;

