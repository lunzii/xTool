<?php
/**
 *
 * MD Shortcodes Button
 *
 */

$md_shortcodes['md_button'] = array(
  "name"            => __("Button", "js_composer"),
  "base"            => "md_button",
  "modal"           => true,
  "params"          => array(
    array(
      "type"        => "textfield",
      "heading"     => __("Text", "js_composer"),
      "param_name"  => "content",
      "value"       => ""
    ),
    $element_options['href'],
    $element_options['target'],
    $element_options['button_size'],
    $element_options['button_style'],
    $element_options['button_color'],
    $element_options['button_color_hover'],
    $element_options['button_bgcolor'],
    $element_options['button_icon_show'],
    $element_options['icon_family'],
    $element_options['icon_fontawesome'],
    $element_options['icon_typicons'],
    $element_options['icon_entypo'],
    $element_options['icon_lineicons'],
    $element_options['class'],
    $element_options['id'],
    $element_options['css_animation'],
    $element_options['css_animation_delay'],
  )
);


vc_map( $md_shortcodes['md_button'] );

class WPBakeryShortCode_MD_Button extends WPBakeryShortCode {}