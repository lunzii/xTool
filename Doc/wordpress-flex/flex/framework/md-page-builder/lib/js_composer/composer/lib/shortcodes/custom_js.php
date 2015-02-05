<?php
/**
 *
 * MD Shortcodes Custom JS
 *
 */



$md_shortcodes['md_raw_js'] = array(
  "name"            => __("Custom Javascript", "js_composer"),
  "base"            => "md_raw_js",
  "modal"           => false,
  "params"          => array(
    array(
      "type"        => "textarea_raw_html",
      "heading"     => __("JavaScript", "js_composer"),
      "param_name"  => "content",
      "value"       => "",
      "description" => __("Put your JavaScript Here.", "js_composer")
    )
  )
);


vc_map($md_shortcodes['md_raw_js'] );

class WPBakeryShortCode_MD_Raw_js extends WPBakeryShortCode {}