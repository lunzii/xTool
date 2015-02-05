<?php
/**
 *
 * MD Shortcodes Box Icon
 *
 */

global $theme_options;

$md_shortcodes['md_box_icon'] = array(
  "name"            => __("Box Icon", "js_composer"),
  "base"            => "md_box_icon",
  "modal"           => true,
  "params"          => array(
    array(
      "type"        => "textfield",
      "heading"     => __("Title", "js_composer"),
      "param_name"  => "title",
      "value"       => ""
    ),
    array(
      "type"        => "colorpicker",
      "heading"     => __("Title Color", "js_composer"),
      "param_name"  => "title_color",
      "value"       => $theme_options['font-body']['color'],
    ),
    array(
      "type"        => "textarea_html",
      "heading"     => __("Text", "js_composer"),
      "param_name"  => "content",
      "value"       => ""
    ),
    $element_options['icon_family'],
    $element_options['icon_fontawesome'],
    $element_options['icon_typicons'],
    $element_options['icon_entypo'],
    $element_options['icon_lineicons'],
    array(
      "type"        => "radio",
      "heading"     => __("Icon Position", "js_composer"),
      "param_name"  => "icon_position",
      "value"       => array(
        __('Top', "js_composer")   => "top", 
        __('Left', "js_composer")    => "left", 
        __('Right', "js_composer")    => "right", 
      ),
      "default"     => 'top',
    ),
    $element_options['icon_style'],
    array(
      "type"        => "radio",
      "heading"     => __("Box Style", "js_composer"),
      "param_name"  => "style",
      "value"       => array(
        __('Indent', "js_composer")   => "indent", 
        __('Block', "js_composer")    => "block", 
      ),
      "default"     => 'block',
      "dependency"  => array('element' => "icon_style", 'value' => array('style-normal')),
    ),
    $element_options['icon_color'],
    $element_options['icon_color_hover'],
    $element_options['icon_border_color'],
    $element_options['icon_border_color_hover'],
    $element_options['icon_bg_color'],
    $element_options['icon_bg_color_hover'],
    $element_options['id'],
    $element_options['css_animation'],
    $element_options['css_animation_delay'],
  )
);


vc_map( $md_shortcodes['md_box_icon'] );

class WPBakeryShortCode_MD_Box_Icon extends WPBakeryShortCode {}