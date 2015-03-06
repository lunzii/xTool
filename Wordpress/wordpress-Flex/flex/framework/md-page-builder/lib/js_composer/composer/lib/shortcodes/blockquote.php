<?php
/**
 *
 * MD Shortcodes Blockquote
 *
 */


$md_shortcodes['md_blockquote'] = array(
  "name"            => __("Blockquote", "js_composer"),
  "base"            => "md_blockquote",
  "modal"           => true,
  "params"          => array(
    array(
      "type"        => "textarea_html",
      "heading"     => __("Text", "js_composer"),
      "param_name"  => "content",
      "value"       => "",
    ),
    $element_options['class'],
    $element_options['id'],
    $element_options['css_animation'],
    $element_options['css_animation_delay'],
  )
);


vc_map( $md_shortcodes['md_blockquote'] );

class WPBakeryShortCode_MD_Blockquote extends WPBakeryShortCode {}

