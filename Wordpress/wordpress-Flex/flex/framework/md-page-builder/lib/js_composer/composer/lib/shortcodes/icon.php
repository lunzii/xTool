<?php
/**
 *
 * MD Shortcodes Icon
 *
 */


$element_options['icon_color']['dependency']['element'] = 'icon_scheme';
$md_shortcodes['md_icon'] = array(
  "name"            => __("Icon", "js_composer"),
  "base"            => "md_icon",
  "modal"           => true,
  "params"          => array(
    $element_options['icon_family'],
    $element_options['icon_fontawesome'],
    $element_options['icon_typicons'],
    $element_options['icon_entypo'],
    $element_options['icon_lineicons'],
    $element_options['icon_size'],
    $element_options['icon_style'],
    $element_options['icon_color'],
    $element_options['icon_bg_color'],
    $element_options['icon_border_color'],
    $element_options['icon_margin'],
    $element_options['class'],
    $element_options['id'],
    $element_options['css_animation'],
    $element_options['css_animation_delay'],
  )
);


vc_map( $md_shortcodes['md_icon'] );

class WPBakeryShortCode_MD_Icon extends WPBakeryShortCode {}