<?php
/**
 *
 * MD Shortcodes Custom CSS
 *
 */



$md_shortcodes['md_raw_css'] = array(
  "name"            => __("Custom CSS", "js_composer"),
  "base"            => "md_raw_css",
  "modal"           => false,
  "params"          => array(
    array(
      "type"        => "textarea_raw_html",
      "heading"     => __("CSS", "js_composer"),
      "param_name"  => "content",
      "value"       => "",
      "description" => __("Put your CSS Here.", "js_composer")
    )
  )
);


vc_map($md_shortcodes['md_raw_css'] );

class WPBakeryShortCode_MD_Raw_css extends WPBakeryShortCode {}