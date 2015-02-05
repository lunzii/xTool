<?php
/**
 *
 * MD Shortcodes Shortcodes Manual
 *
 */



$md_shortcodes['md_shortcode_manual'] = array(
  "name"            => __("Shortcode Manual", "js_composer"),
  "base"            => "md_shortcode_manual",
  "modal"           => true,
  "params"          => array(
    array(
      "type"        => "textarea_raw_html",
      "heading"     => __("Shortcode", "js_composer"),
      "param_name"  => "content",
      "value"       => ""
    ),
  )
);


vc_map( $md_shortcodes['md_shortcode_manual'] );

class WPBakeryShortCode_MD_Shortcode_manual extends WPBakeryShortCode {}