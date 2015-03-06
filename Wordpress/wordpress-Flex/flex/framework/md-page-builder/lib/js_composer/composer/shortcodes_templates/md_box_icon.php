<?php

extract(shortcode_atts(array(
    'class' 		        => '',
    'id'			        => '',
    'css_animation'         => '',
    'css_animation_delay'   => '',
    'title'                 => '',
    'title_color'           => '',
    'style'                 => 'block',
    'icon_position'         => '',
    'icon_family'           => '',
    'icon_fontawesome'      => '',
    'icon_typicons'         => '',
    'icon_lineicons'        => '',
    'icon_entypo'           => '',
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

$icon_box_style = ($icon_style == 'style-normal') ? 'simple-icon' : 'advanced-icon';

$class  = setClass(array('md-box-icon', $animated, $css_animation, 'align-'.$icon_position, $icon_box_style, $style, $icon_style));
$id     = setId($id);
$style  = '';




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


$output = '<div'.$class.$id.$style.$css_animation_delay.'>';


$output .= '<div class="box-text"><h3 class="title" style="color:'.$title_color.'">'.do_shortcode('[md_icon icon="'.$icon.'" icon_style="'.$icon_style.'" icon_color="'.$icon_color.'" icon_color_hover="'.$icon_color_hover.'" icon_border_color="'.$icon_border_color.'" icon_border_color_hover="'.$icon_border_color_hover.'" icon_bg_color="'.$icon_bg_color.'" icon_bg_color_hover="'.$icon_bg_color_hover.'"]').$title.'</h3><div class="text">'.wpb_js_remove_wpautop($content, true).'</div></div>';

$output .= '</div>';
$output .= '<div class="clearfix"></div>';

echo $output;

