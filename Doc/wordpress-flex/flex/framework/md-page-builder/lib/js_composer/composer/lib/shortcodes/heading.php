<?php
/**
 *
 * MD Shortcodes Heading
 *
 */

global $theme_options;
$md_shortcodes['md_heading'] = array(
  "name"            => __("Heading", "js_composer"),
  "base"            => "md_heading",
  "modal"           => true,
  "params"          => array(
    array(
      "type"        => "textfield",
      "heading"     => __("Text", "js_composer"),
      "param_name"  => "content",
      "shortcode_btn"  => true,
      "value"       => ""
    ),
    array(
      "type"        => "radio",
      "heading"     => __("Type", "js_composer"),
      "param_name"  => "kind",
      "value"       => array(
        __('H1', "js_composer")    => "h1", 
        __('H2', "js_composer")    => "h2", 
        __('H3', "js_composer")    => "h3", 
        __('H4', "js_composer")    => "h4", 
        __('H5', "js_composer")    => "h5", 
        __('H6', "js_composer")    => "h6", 
      ),
      "default"     => 'h1',
    ),
    $element_options['text_align'],
    array(
      "type"        => "radio",
      "heading"     => __("Special Font", "js_composer"),
      "param_name"  => "special_font",
      "value"       => array(
        __('No', "js_composer") => "", 
        __('Yes', "js_composer") => "special-font", 
      ),
      "default"     => ""
    ),
    array(
      "type"        => "radio",
      "heading"     => __("Color", "js_composer"),
      "param_name"  => "heading_color",
      "value"       => array(
        __('Default', "js_composer") => "", 
        __('Custom', "js_composer") => "custom", 
      ),
      "default"     => ""
    ),
    array(
      "type"        => "colorpicker",
      "heading"     => __("Custom Color", "js_composer"),
      "param_name"  => "color",
      "value"       => $theme_options['font-body']['color'],
      "dependency"  => array('element' => 'heading_color', 'value' => 'custom')
    ),
    $element_options['class'],
    $element_options['id'],
    $element_options['css_animation'],
    $element_options['css_animation_delay'],
  )
);


vc_map( $md_shortcodes['md_heading'] );

class WPBakeryShortCode_MD_Heading extends WPBakeryShortCode {}