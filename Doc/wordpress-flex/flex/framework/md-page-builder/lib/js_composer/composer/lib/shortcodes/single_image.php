<?php
/**
 *
 * MD Shortcodes Single Image
 *
 */



$sizes = get_intermediate_image_sizes();
$sizes_options = array();

foreach($sizes as $size):

  $sizes_options[$size] = $size;

endforeach;

$md_shortcodes['md_single_image'] = array(
  "name"            => __("Single Image", "js_composer"),
  "base"            => "md_single_image",
  "modal"           => false,
  "params"          => array(
    array(
      "type"        => "attach_image",
      "heading"     => __("Image", "js_composer"),
      "param_name"  => "image",
      "description" => __("Select image from media library.", "js_composer")
    ),
    array(
      "type"        => "dropdown",
      "heading"     => __("Image Size", "js_composer"),
      "param_name"  => "size",
      "value"       => $sizes_options
    ),

    array(
      "type"        => "radio",
      "heading"     => __("Full Responsive", "js_composer"),
      "param_name"  => "full_responsive",
      "value"       => array(
        __('No', "js_composer") => "", 
        __('Yes', "js_composer") => "img-full-responsive", 
      ),
      "default"     => ""
    ),

    array(
      "type"        => "textfield",
      "heading"     => __("Image link", "js_composer"),
      "param_name"  => "href",
      "description" => __("Enter url if you want this image to have link.", "js_composer")
    ),
    $element_options['target'],
    $element_options['class'],
    $element_options['id'],
    $element_options['css_animation'],
    $element_options['css_animation_delay'],
  )
);


vc_map( $md_shortcodes['md_single_image'] );

class WPBakeryShortCode_MD_Single_image extends WPBakeryShortCode {}
