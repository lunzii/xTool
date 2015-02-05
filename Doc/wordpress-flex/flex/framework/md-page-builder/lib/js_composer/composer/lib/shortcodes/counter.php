<?php
/**
 *
 * MD Shortcodes Counter
 *
 */



$md_shortcodes['md_counter'] = array(
  "name"            => __("Counter", "js_composer"),
  "base"            => "md_counter",
  "modal"           => true,
  "params"          => array(
    array(
      "type"        => "slider",
      "heading"     => __("Start Delay", "js_composer"),
      "param_name"  => "start_delay",
      "default"     => "0",
      "max"         => "2000",
      "suffix"      => "ms",
      "description" => __("Insert start delay in ms (eg: 200).", "js_composer"),
    ),
    array(
      "type"        => "slider",
      "heading"     => __("Start", "js_composer"),
      "param_name"  => "start",
      "default"     => "0",
      "max"         => "9999",
      "suffix"      => '',
      "description" => __("Insert start number.", "js_composer"),
    ),
    array(
      "type"        => "slider",
      "heading"     => __("End", "js_composer"),
      "param_name"  => "end",
      "default"     => "100",
      "max"         => "999999",
      "suffix"      => '',
      "description" => __("Insert End number.", "js_composer"),
   ),
    array(
      "type"        => "slider",
      "heading"     => __("Speed", "js_composer"),
      "param_name"  => "speed",
      "default"     => "1000",
      "max"         => "2000",
      "suffix"      => "ms",
      "description" => __("Insert Speed time.", "js_composer"),
   ),
    array(
      "type"        => "colorpicker",
      "heading"     => __("Number Color", "js_composer"),
      "param_name"  => "number_color",
      "value"       => $theme_options['accent-color'],
      "default"     => $theme_options['accent-color']
    ),
    array(
      "type"        => "slider",
      "heading"     => __("Number Font Size", "js_composer"),
      "param_name"  => "number_font_size",
      "default"     => "80",
    ),
    array(
      "type"        => "textfield",
      "heading"     => __("Label", "js_composer"),
      "param_name"  => "label_text"
    ),
    array(
      "type"        => "colorpicker",
      "heading"     => __("Label Color", "js_composer"),
      "param_name"  => "label_color",
      "value"       => $theme_options['accent-color'],
      "default"     => $theme_options['accent-color']
    ),
    array(
      "type"        => "slider",
      "heading"     => __("Label Font Size", "js_composer"),
      "param_name"  => "label_font_size",
      "default"     => "48",
    ),
    array(
      "type"        => "radio",
      "heading"     => __("Show Icon?", "js_composer"),
      "param_name"  => "icon_show",
      "value"       => array(
            __('No', "js_composer")  => "", 
            __('Yes', "js_composer")     => "yes", 
      ),
      "default"     => ""
    ),
    $element_options['icon_family'],
    $element_options['icon_fontawesome'],
    $element_options['icon_typicons'],
    $element_options['icon_entypo'],
    $element_options['icon_lineicons'],
    $element_options['icon_size'],
    $element_options['icon_style'],
    $element_options['icon_color'],
    $element_options['icon_bg_color'],
    $element_options['icon_border_color'],
    $element_options['class'],
    $element_options['id'],
    $element_options['css_animation'],
    $element_options['css_animation_delay'],
  )
);


vc_map( $md_shortcodes['md_counter'] );

class WPBakeryShortCode_MD_Counter extends WPBakeryShortCode {}