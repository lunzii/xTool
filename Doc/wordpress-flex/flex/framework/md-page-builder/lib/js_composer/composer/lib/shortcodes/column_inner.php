<?php
/**
 * WPBakery Visual Composer shortcodes Colum Inner
 *
 * @package WPBakeryVisualComposer
 *
 */

class WPBakeryShortCode_VC_Column_Inner extends WPBakeryShortCode_VC_Column {}

vc_map( array(
  "name"                          => __("Column", "js_composer"),
  "base"                          => "vc_column_inner",
  "class"                         => "",
  "wrapper_class"                 => "",
  "controls"                      => "full",
  "allowed_container_element"     => false,
  "content_element"               => false,
  "is_container"                  => true,
  "params"                        => array(
    $element_options['text_align'],
    array(
      "type"        => "dropdown",
      "heading"     => __("Background", "js_composer"),
      "param_name"  => "bgtype",
      "value"       => array(
        __('Default', "js_composer")  => "", 
        __('Custom Color', "js_composer") => "bg-custom-color",
      ),
      "description" => __("Choose Background.", "js_composer")
    ),
    array(
      "type"        => "colorpicker",
      "class"       => "color",
      "heading"     => __("Custom Background Color", "js_composer"),
      "param_name"  => "bgcolor",
      "description" => __("Set custom background color.", "js_composer"),
      "value"       => "#ffffff",
      "dependency"  => array('element' => "bgtype", 'value' => array('bg-custom-color'))
    ),
    array(
      "type"        => "slider",
      "heading"     => __("Custom Background Color Transparency", "js_composer"),
      "param_name"  => "bgcolor_transparency",
      "min"         => "1",
      "max"         => "100",
      "default"     => "100",
      "suffix"      => "%",
      "dependency"  => array('element' => "bgtype", 'value' => array('bg-custom-color'))
    ),
    array(
      "type"        => "dropdown",
      "heading"     => __("Padding", "js_composer"),
      "param_name"  => "padding",
      "value"       => array(
        __('No Padding', "js_composer")   => "padding-no", 
        __('Custom', "js_composer")       => "padding-custom",
      ),
      "description" => __("Choose Padding Top / Bottom.", "js_composer")
    ),
    array(
      "type"        => "slider",
      "heading"     => __("Custom Padding", "js_composer"),
      "param_name"  => "padding_custom",
      "default"     => "0",
      "dependency"  => array('element' => "padding", 'value' => array('padding-custom'))
    ),
    $element_options['class'],
    $element_options['id'],
    $element_options['css_animation'],
    $element_options['css_animation_delay'],
  ),
  "js_view"                       => 'VcColumnView'
) );