<?php
/**
 *
 * MD Shortcodes Heading Custom
 *
 */

global $theme_options;
$md_shortcodes['md_heading_custom'] = array(
  "name"            => __("Heading Custom", "js_composer"),
  "base"            => "md_heading_custom",
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
      "type"        => "colorpicker",
      "heading"     => __("Color", "js_composer"),
      "param_name"  => "color",
      "value"       => $theme_options['font-body']['color'],
    ),
    array(
      "type"        => "slider",
      "heading"     => __("Font Size", "js_composer"),
      "param_name"  => "fontsize",
      "default"     => "24",
    ),
    array(
      "type"        => "slider",
      "heading"     => __("Line Height", "js_composer"),
      "param_name"  => "lineheight",
      "default"     => "24",
    ),
    array(
      "type"        => "textfield",
      "heading"     => __("Font Weight", "js_composer"),
      "param_name"  => "fontweight",
      "value"       => '600',
      "description" => 'Insert font weight (eg. 100, 500, 800 or bold, normal)',
    ),
    $element_options['class'],
    $element_options['id'],
    $element_options['css_animation'],
    $element_options['css_animation_delay'],
  )
);


vc_map( $md_shortcodes['md_heading_custom'] );

class WPBakeryShortCode_MD_Heading_custom extends WPBakeryShortCode {}