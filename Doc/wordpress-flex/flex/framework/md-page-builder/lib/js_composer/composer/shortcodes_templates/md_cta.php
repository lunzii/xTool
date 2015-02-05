<?php

extract(shortcode_atts(array(
    'class'                 => '',
    'id'                    => '',
    'css_animation'         => '',
    'css_animation_delay'   => '',
    'padding'               => '',
    'cta_color'             => '',
    'cta_bgcolor'           => '',
    'button_label'          => '',
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

$class  = setClass(array('md-cta', $animated, $css_animation, $class, $padding));
$id     = setId($id);


$output = '<div'.$class.$id.$css_animation_delay.' style="background-color:'.$cta_bgcolor.'">';
    $output .= '<div class="container">';
        $output .= '<div class="cta-content" style="color:'.$cta_color.'">'.wpb_js_remove_wpautop($content, true).'</div>';

        $output .= '<div class="cta-button">'.do_shortcode('[md_button style="'.$style.'" href="'.$href.'" target="'.$target.'" bgcolor="'.$bgcolor.'" color="'.$color.'" colorhover= "'.$colorhover.'" icon_show="'.$icon_show.'" icon_family="'.$icon_family.'" icon_fontawesome="'.$icon_fontawesome.'" icon_typicons="'.$icon_typicons.'" icon_lineicons="'.$icon_lineicons.'" icon_entypo="'.$icon_entypo.'"]'.$button_label.'[/md_button]').'</div>';
        $output .= '</div>';
$output .= '</div>';

echo $output;