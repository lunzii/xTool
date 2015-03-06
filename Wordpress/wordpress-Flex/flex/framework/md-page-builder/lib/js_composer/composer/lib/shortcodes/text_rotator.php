<?php
/**
 *
 * MD Shortcodes Text Rotator
 *
 */

global $theme_options;
$md_shortcodes['md_text_rotator'] = array(
  "name"            => __("Text Rotator", "js_composer"),
  "base"            => "md_text_rotator",
  "modal"           => true,
  "params"          => array(
    array(
      "type"        => "textarea_raw_html",
      "heading"     => __("Text", "js_composer"),
      "param_name"  => "content",
      "shortcode_btn"  => true,
      "value"       => "",
      "description" => "Example: We are &lt;span class=\"rotator\"&gt;Awesome, Incredible, Fantastic&lt;/span&gt;... just like you!"
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


vc_map( $md_shortcodes['md_text_rotator'] );

class WPBakeryShortCode_MD_Text_rotator extends WPBakeryShortCode {}