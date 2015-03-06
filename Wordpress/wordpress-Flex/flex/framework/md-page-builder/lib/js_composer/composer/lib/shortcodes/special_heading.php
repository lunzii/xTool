<?php
/**
 *
 * MD Shortcodes Special Heading
 *
 */
$md_shortcodes['md_special_heading'] = array(
  "name"                => __("Special Heading", "js_composer"),
  "base"                => "md_special_heading",
  "modal"               => true,
  "params"              => array(
    array(
          "type"        => "textfield",
          "heading"     => __("Text", "js_composer"),
          "param_name"  => "content",
          "value"       => ""
    ),
    array(
      "type"        => "radio",
      "heading"     => __("Style", "js_composer"),
      "param_name"  => "style",
      "value"       => array(
        __('Thin Left', "js_composer") => "style-1", 
        __('Thick Left', "js_composer") => "style-2", 
        __('Thin Center', "js_composer") => "style-3", 
        __('Thick Center', "js_composer") => "style-4", 
        __('Wrapped', "js_composer") => "style-5", 
        __('Thin Left Full', "js_composer") => "style-6", 
        __('Thin Center Full', "js_composer") => "style-7", 
      ),
      "default"     => ""
    ),
    array(
      "type"        => "radio",
      "heading"     => __("Border Color", "js_composer"),
      "param_name"  => "border_color",
      "value"       => array(
        __('Dark', "js_composer") => "dark", 
        __('Light', "js_composer") => "light", 
        __('Black', "js_composer") => "black", 
        __('White', "js_composer") => "white", 
      ),
      "default"     => "dark"
    ),
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
      "type"        => "slider",
      "heading"     => __("Font Size", "js_composer"),
      "param_name"  => "fontsize",
      "default"       => '30',
    ),
    array(
      "type"        => "slider",
      "heading"     => __("Line Height", "js_composer"),
      "param_name"  => "lineheight",
      "default"       => '36',
    ),
    array(
      "type"        => "textfield",
      "heading"     => __("Font Weight", "js_composer"),
      "param_name"  => "fontweight",
      "value"       => '500',
      "description" => 'Insert font weight (eg. 100, 500, 800 or bold, normal)'
    ),
    array(
      "type"        => "colorpicker",
      "heading"     => __("Color", "js_composer"),
      "param_name"  => "color",
      "value"       => $theme_options['font-h1']['color'],
    ),
    $element_options['class'],
    $element_options['id'],
    $element_options['css_animation'],
    $element_options['css_animation_delay'],
  )
);

vc_map( $md_shortcodes['md_special_heading'] );

class WPBakeryShortCode_MD_Special_heading extends WPBakeryShortCode {}