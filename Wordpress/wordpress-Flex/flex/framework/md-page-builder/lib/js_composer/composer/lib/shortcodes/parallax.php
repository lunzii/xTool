<?php
/**
 *
 * MD Shortcodes Parallax
 *
 */



$md_shortcodes['md_parallax'] = array(
  "name"            => __("Parallax Area", "js_composer"),
  "base"            => "md_parallax",
  "modal"           => false,
  "params"          => array(
    array(
      "type"        => "attach_image",
      "heading"     => __("Background Image", "js_composer"),
      "param_name"  => "bgimage",
    ),
    array(
      "type"        => "radio",
      "heading"     => __("Height", "js_composer"),
      "param_name"  => "height",
      "value"       => array(
        __('Small', "js_composer")        => "small",
        __('Medium', "js_composer")       => "medium", 
        __('Large', "js_composer")        => "large",
      ),
      "default"     => "small"
    ),
    array(
      "type"        => "radio",
      "heading"     => __("Mask", "js_composer"),
      "param_name"  => "mask",
      "value"       => array(
        __("Yes", "js_composer") => "true",
        __("No", "js_composer") => ""
      ),
      "default"     => "true"
    ),
    array(
      "type"        => "colorpicker",
      "heading"     => __("Mask Color", "js_composer"),
      "param_name"  => "maskcolor",
      "value"       => '#000000',
      "dependency"  => array('element' => 'mask', 'value' => 'true')
    ),
    array(
      "type"        => "textarea_html",
      "heading"     => __("Text", "js_composer"),
      "param_name"  => "content",
      "shortcode_btn"  => true,
      "value"       => ''
    ),
    /*
    array(
      "type"        => "dropdown",
      "heading"     => __("Background Attachment", "js_composer"),
      "param_name"  => "bgattachment",
      "value"       => array(
        __('Scroll', "js_composer")      => "scroll",
        __('Fixed', "js_composer")       => "fixed", 
      ),
      "description" => __("Set custom background attachment.", "js_composer")
    ),
    */
    $element_options['class'],
    $element_options['id'],
    $element_options['css_animation'],
    $element_options['css_animation_delay'],
  )
);


vc_map( $md_shortcodes['md_parallax'] );

class WPBakeryShortCode_MD_Parallax extends WPBakeryShortCode {}
