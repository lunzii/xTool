<?php
/**
 *
 * MD Shortcodes Dropcap
 *
 */


$md_shortcodes['md_dropcap'] = array(
  "name"            => __("Dropcap", "js_composer"),
  "base"            => "md_dropcap",
  "modal"           => true,
  "content_element" => false,
  "params"          => array(
    array(
      "type"        => "textfield",
      "heading"     => __("Letter", "js_composer"),
      "param_name"  => "content",
      "value"       => ""
    ),
    array(
      "type"        => "colorpicker",
      "heading"     => __("Background Color", "js_composer"),
      "param_name"  => "bgcolor",
      "value"       => $theme_options['accent-color']
    ),
    array(
      "type"        => "colorpicker",
      "heading"     => __("Color", "js_composer"),
      "param_name"  => "color",
      "value"       => "#ffffff"
    ),
    $element_options['class'],
    $element_options['id'],
    $element_options['css_animation'],
    $element_options['css_animation_delay'],
  )
);


vc_map( $md_shortcodes['md_dropcap'] );

class WPBakeryShortCode_MD_Dropcap extends WPBakeryShortCode {}