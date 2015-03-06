<?php
/**
 *
 * MD Shortcodes Custom HTML
 *
 */



$md_shortcodes['md_raw_html'] = array(
  "name"            => __("Custom HTML", "js_composer"),
  "base"            => "md_raw_html",
  "modal"           => false,
  "params"          => array(
    array(
      "type"        => "textarea_raw_html",
      "heading"     => __("HTML", "js_composer"),
      "param_name"  => "content",
      "value"       => "",
      "description" => __("Put your HTML Here.", "js_composer")
    )
  )
);


vc_map($md_shortcodes['md_raw_html'] );

class WPBakeryShortCode_MD_Raw_html extends WPBakeryShortCode {}