<?php
/**
 *
 * MD Shortcodes Progress Circular
 *
 */


$md_shortcodes['md_progress_circular'] = array(
  "name"            => __("Progress Circular", "js_composer"),
  "base"            => "md_progress_circular",
  "modal"           => true,
  "params"          => array(
    array(
      "type"        => "slider",
      "heading"     => __("Percent", "js_composer"),
      "param_name"  => "percent",
      "min"         => "0",
      "max"         => "100",
      "suffix"      => "%",
      "default"     => "0",
      "description" => __("Set the percent value.", "js_composer")
    ),
    array(
      "type"        => "textfield",
      "heading"     => __("Label", "js_composer"),
      "param_name"  => "content",
      "value"       => "",
      "description" => __("Set the label.", "js_composer")
   ),
    array(
      "type"        => "colorpicker",
      "heading"     => __("Background", "js_composer"),
      "param_name"  => "bgcolor",
      "value"       => $theme_options['accent-color'],
      "description" => __("Select background color.", "js_composer"),
   ),
    array(
      "type"        => "colorpicker",
      "heading"     => __("Track Color", "js_composer"),
      "param_name"  => "color",
      "value"       => '#ffffff',
      "description" => __("Select track color.", "js_composer"),
   ),
    array(
      "type"        => "slider",
      "heading"     => __("Diameter", "js_composer"),
      "param_name"  => "diameter",
      "min"         => "0",
      "max"         => "1000",
      "suffix"      => "px",
      "default"     => "220",
      "description" => __("Set the diameter width.", "js_composer")
    ),
    array(
      "type"        => "slider",
      "heading"     => __("Track Width", "js_composer"),
      "param_name"  => "track_width",
      "min"         => "1",
      "max"         => "100",
      "suffix"      => "px",
      "default"     => "20",
      "description" => __("Set the track width.", "js_composer")
    ),
    $element_options['class'],
    $element_options['id'],
    $element_options['css_animation'],
    $element_options['css_animation_delay'],
  )
);


vc_map( $md_shortcodes['md_progress_circular'] );

class WPBakeryShortCode_MD_Progress_Circular extends WPBakeryShortCode {}