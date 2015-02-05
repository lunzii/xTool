<?php
/**
 *
 * MD Shortcodes Call To Action
 *
 */

global $theme_options;
$md_shortcodes['md_cta'] = array(
  "name"            => __("Call To Action", "js_composer"),
  "base"            => "md_cta",
  "modal"           => true,
  "params"          => array(
    array(
      "type"        => "textfield",
      "heading"     => __("Text", "js_composer"),
      "param_name"  => "content",
      "value"       => ""
    ),
    array(
      "type"        => "colorpicker",
      "heading"     => __("Text Color", "js_composer"),
      "param_name"  => "cta_color",
      "value"       => '#ffffff'
    ),

    array(
      "type"        => "radio",
      "heading"     => __("Padding Left/Right", "js_composer"),
      "param_name"  => "padding",
      "value"       => array(
            __('No', "js_composer")  => "", 
            __('Yes', "js_composer") => "padding", 
      ),
      "default"     => ""
    ),
    array(
      "type"        => "colorpicker",
      "heading"     => __("Background Color", "js_composer"),
      "param_name"  => "cta_bgcolor",
      "value"       => $theme_options['accent-color']
    ),

    array(
      "type"        => "textfield",
      "heading"     => __("Button Label", "js_composer"),
      "param_name"  => "button_label",
      "value"       => ""
    ),
    $element_options['href'],
    $element_options['target'],
    $element_options['button_style'],
    $element_options['button_color'],
    $element_options['button_color_hover'],
    $element_options['button_bgcolor'],
    $element_options['button_icon_show'],
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


vc_map( $md_shortcodes['md_cta'] );

class WPBakeryShortCode_MD_Cta extends WPBakeryShortCode {}