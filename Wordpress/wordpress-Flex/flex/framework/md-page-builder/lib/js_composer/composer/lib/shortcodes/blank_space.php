<?php
/**
 *
 * MD Shortcodes Blank Space
 *
 */

$md_shortcodes['md_blank_space'] = array(
  "name"            => __("Blank Space", "js_composer"),
  "base"            => "md_blank_space",
  "modal"           => true,
  "params"          => array(
    array(
      "type"        => "slider",
      "heading"     => __("Height", "js_composer"),
      "param_name"  => "height",
      "default"     => "30"
    ),
    $element_options['class'],
    $element_options['id'],
  )
);

vc_map( $md_shortcodes['md_blank_space'] );

class WPBakeryShortCode_MD_Blank_space extends WPBakeryShortCode {}