<?php
/**
 *
 * MD Shortcodes Tooltip
 *
 */


$md_shortcodes['md_tooltip'] = array(
  "name"            => __("Tooltip", "js_composer"),
  "base"            => "md_tooltip",
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
      "type"        => "textfield",
      "heading"     => __("Tooltip Text", "js_composer"),
      "param_name"  => "text",
      "value"       => ""
    ),
    array(
      "type"        => "radio",
      "heading"     => __("Position", "js_composer"),
      "param_name"  => "position",
      "value"       => array(
        __('Top', "js_composer") => "top", 
        __('Right', "js_composer") => "right", 
        __('Bottom', "js_composer") => "bottom", 
        __('Left', "js_composer") => "left", 
      ),
      "default"     => "top"
    ),
    $element_options['class'],
    $element_options['id'],
  )
);

vc_map( $md_shortcodes['md_tooltip'] );

class WPBakeryShortCode_MD_Tooltip extends WPBakeryShortCode {}