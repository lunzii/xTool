<?php
/**
 *
 * MD Shortcodes Text
 *
 */


$md_shortcodes['md_text'] = array(
  "name"            => __("Text Block", "js_composer"),
  "base"            => "md_text",
  "modal"           => true,
  "params"          => array(
    array(
      "type"        => "textarea_html",
      "heading"     => __("Text", "js_composer"),
      "param_name"  => "content",
      "shortcode_btn"  => true,
      "value"       => ""
    ),
    $element_options['class'],
    $element_options['id'],
    $element_options['css_animation'],
    $element_options['css_animation_delay'],
  )
);


vc_map( $md_shortcodes['md_text'] );

class WPBakeryShortCode_MD_Text extends WPBakeryShortCode {}
