<?php
/**
 *
 * MD Shortcodes HighLight
 *
 */


$md_shortcodes['md_highlight'] = array(
  "name"            => __("Highlight", "js_composer"),
  "base"            => "md_highlight",
  "modal"           => true,
  "content_element" => false,
  "params"          => array(
    array(
      "type"        => "textfield",
      "heading"     => __("Text", "js_composer"),
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


vc_map( $md_shortcodes['md_highlight'] );

class WPBakeryShortCode_MD_Highlight extends WPBakeryShortCode {}