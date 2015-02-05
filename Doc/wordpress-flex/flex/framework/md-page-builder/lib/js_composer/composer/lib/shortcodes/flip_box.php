<?php
/**
 *
 * MD Shortcodes Flip Box
 *
 */



global $theme_options;

$md_shortcodes['md_flip_box'] = array(
  "name"            => __("Flip Box", "js_composer"),
  "base"            => "md_flip_box",
  "modal"           => false,
  "params"          => array(
    array(
      "type"        => "textarea_raw_html",
      "heading"     => __("Front Content", "js_composer"),
      "param_name"  => "content_front",
      "shortcode_btn"  => true,
      "value"       => "",
      "description" => "HTML Allowed"
    ),
    array(
      "type"        => "colorpicker",
      "heading"     => __("Color Front", "js_composer"),
      "param_name"  => "color_front",
      "value"       => "#ffffff"
    ),
    array(
      "type"        => "colorpicker",
      "heading"     => __("Background Color Front", "js_composer"),
      "param_name"  => "bgcolor_front",
      "value"       => $theme_options['accent-color']
    ),
    array(
      "type"        => "colorpicker",
      "heading"     => __("Border Color Front", "js_composer"),
      "param_name"  => "bordercolor_front",
      "value"       => $theme_options['accent-color']
    ),
    array(
      "type"        => "textarea_raw_html",
      "heading"     => __("Retro Content", "js_composer"),
      "param_name"  => "content_retro",
      "shortcode_btn"  => true,
      "value"       => "",
      "description" => "HTML Allowed"
    ),
    array(
      "type"        => "colorpicker",
      "heading"     => __("Color Retro", "js_composer"),
      "param_name"  => "color_retro",
      "value"       => '#ffffff'
    ),
    array(
      "type"        => "colorpicker",
      "heading"     => __("Background Color Retro", "js_composer"),
      "param_name"  => "bgcolor_retro",
      "value"       => '#111111'
    ),
    array(
      "type"        => "colorpicker",
      "heading"     => __("Border Color Retro", "js_composer"),
      "param_name"  => "bordercolor_retro",
      "value"       => '#111111'
    ),
    $element_options['class'],
    $element_options['id'],
    $element_options['css_animation'],
    $element_options['css_animation_delay'],
  )
);


vc_map( $md_shortcodes['md_flip_box'] );

class WPBakeryShortCode_MD_Flip_box extends WPBakeryShortCode {}