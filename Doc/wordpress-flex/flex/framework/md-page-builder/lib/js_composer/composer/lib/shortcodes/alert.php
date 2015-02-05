<?php
/**
 *
 * MD Shortcodes Alert
 *
 */


$md_shortcodes['md_alert'] = array(
  "name"            => __("Alert", "js_composer"),
  "base"            => "md_alert",
  "modal"           => true,
  "params"          => array(
    array(
      "type"        => "textarea_html",
      "heading"     => __("Text", "js_composer"),
      "param_name"  => "content",
      "value"       => ""
    ),
    array(
      "type"        => "radio",
      "heading"     => __("Type", "js_composer"),
      "param_name"  => "kind",
      "value"       => array(
            __('Message', "js_composer")  => "message", 
            __('Info', "js_composer")     => "info", 
            __('Warning', "js_composer")  => "warning", 
            __('Success', "js_composer")  => "success", 
            __('Error', "js_composer")    => "error", 
      ),
      "default"     => "message",
      "description" => __("Select alert type.", "js_composer"),
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
    $element_options['class'],
    $element_options['id'],
    $element_options['css_animation'],
    $element_options['css_animation_delay'],
  )
);

vc_map( $md_shortcodes['md_alert'] );

class WPBakeryShortCode_MD_Alert extends WPBakeryShortCode {}