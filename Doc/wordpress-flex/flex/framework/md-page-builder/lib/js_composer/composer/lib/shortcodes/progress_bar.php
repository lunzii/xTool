<?php
/**
 *
 * MD Shortcodes Progress Bar
 *
 */



$md_shortcodes['md_progress_bar'] = array(
  "name"            => __("Progress Bar", "js_composer"),
  "base"            => "md_progress_bar",
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
      "type"        => "radio",
      "heading"     => __("Animated", "js_composer"),
      "param_name"  => "animate",
      "value"       => array(
        __('No', "js_composer") => "", 
        __('Yes', "js_composer") => "progress-animate", 
      ),
      "default"     => ""
    ),
    array(
      "type"        => "colorpicker",
      "heading"     => __("Track Color", "js_composer"),
      "param_name"  => "trackcolor",
      "value"       => $theme_options['accent-color'],
      "description" => __("Set background color.", "js_composer"),
   ),
  array(
      "type"        => "colorpicker",
      "heading"     => __("Background Color", "js_composer"),
      "param_name"  => "bgcolor",
      "value"       => '#eeeeee',
      "description" => __("Set background color.", "js_composer"),
   ),   
   array(
      "type"        => "colorpicker",
      "heading"     => __("Label Color", "js_composer"),
      "param_name"  => "color",
      "value"       => $theme_options['font-body']['color'],
      "description" => __("Set label color.", "js_composer"),
   ),
    $element_options['class'],
    $element_options['id'],
    $element_options['css_animation'],
    $element_options['css_animation_delay'],
  )
);


vc_map( $md_shortcodes['md_progress_bar'] );

class WPBakeryShortCode_MD_Progress_Bar extends WPBakeryShortCode {}