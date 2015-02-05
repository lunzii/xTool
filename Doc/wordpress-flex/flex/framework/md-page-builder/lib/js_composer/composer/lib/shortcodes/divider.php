<?php
/**
 *
 * MD Shortcodes Divider
 *
 */

$md_shortcodes['md_divider'] = array(
  "name"            => __("Divider", "js_composer"),
  "base"            => "md_divider",
  "modal"           => true,
  "params"          => array(
    array(
      "type"        => "dropdown",
      "heading"     => __("Layout", "js_composer"),
      "param_name"  => "layout",
      "value" => array(
        __('Thick Solid', "js_composer")    => "thick-solid", 
        __('Center Thick Solid', "js_composer")  => "thick-solid-center", 
        __('Thin Solid', "js_composer")     => "thin-solid", 
        __('Center Thin Solid', "js_composer")  => "thin-solid-center", 
        __('Single Dotted', "js_composer")  => "single-dotted", 
        __('Double Dotted', "js_composer")  => "double-dotted", 
        __('Single Dashed', "js_composer")  => "single-dashed", 
        __('Double Dashed', "js_composer")  => "double-dashed", 
      ),
      "description" => __("Select layout style.", "js_composer")
    ),
    array(
      "type"        => "radio",
      "heading"     => __("Margin", "js_composer"),
      "param_name"  => "margin",
      "value"       => array(
        __('Default Theme', "js_composer") => "", 
        __('Custom', "js_composer") => "custom", 
      ),
      "default"     => ""
    ),
    array(
      "type"        => "slider",
      "heading"     => __("Custom Margin Top", "js_composer"),
      "param_name"  => "margin_top",
      "default"     => "0",
      "dependency"  => array('element' => 'margin', 'value' => 'custom')
    ),
    array(
      "type"        => "slider",
      "heading"     => __("Custom Margin Bottom", "js_composer"),
      "param_name"  => "margin_bottom",
      "default"     => "0",
      "dependency"  => array('element' => 'margin', 'value' => 'custom')
    ),
    array(
      "type"        => "colorpicker",
      "heading"     => __("Color", "js_composer"),
      "param_name"  => "color",
      "value"       => '#e5e5e5',
    ),
    $element_options['class'],
    $element_options['id'],
    $element_options['css_animation'],
    $element_options['css_animation_delay'],
  )
);

vc_map( $md_shortcodes['md_divider'] );

class WPBakeryShortCode_MD_Divider extends WPBakeryShortCode {}
