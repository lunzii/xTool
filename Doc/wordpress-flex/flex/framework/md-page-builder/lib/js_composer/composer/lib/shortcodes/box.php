<?php
/**
 *
 * MD Shortcodes Box
 *
 */



global $theme_options;

$md_shortcodes['md_box'] = array(
  "name"            => __("Box Content", "js_composer"),
  "base"            => "md_box",
  "modal"           => false,
  "params"          => array(
    array(
      "type"        => "textarea_html",
      "heading"     => __("Text", "js_composer"),
      "param_name"  => "content",
      "shortcode_btn"  => true,
      "value"       => ""
    ),
    array(
      "type"        => "colorpicker",
      "heading"     => __("Background Color", "js_composer"),
      "param_name"  => "bgcolor",
      "value"       => '#ffffff'
    ),
    array(
      "type"        => "colorpicker",
      "heading"     => __("Border Color", "js_composer"),
      "param_name"  => "bordercolor",
      "value"       => $theme_options['accent-color']
    ),
    $element_options['class'],
    $element_options['id'],
    $element_options['css_animation'],
    $element_options['css_animation_delay'],
  )
);


vc_map( $md_shortcodes['md_box'] );

class WPBakeryShortCode_MD_Box extends WPBakeryShortCode {}