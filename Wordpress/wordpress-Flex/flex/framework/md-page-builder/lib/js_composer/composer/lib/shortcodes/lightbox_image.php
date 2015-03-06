<?php
/**
 *
 * MD Shortcodes Lighbox Image
 *
 */


$sizes = get_intermediate_image_sizes();
$sizes_options = array();

foreach($sizes as $size):

  $sizes_options[$size] = $size;

endforeach;

$md_shortcodes['md_lightbox_image'] = array(
  "name"            => __("Lightbox Image", "js_composer"),
  "base"            => "md_lightbox_image",
  "modal"           => false,
  "params"          => array(
    array(
      "type"        => "attach_image",
      "heading"     => __("Thumb", "js_composer"),
      "param_name"  => "thumb",
      "description" => __("Choose your thumb.", "js_composer")
    ),
    array(
      "type"        => "dropdown",
      "heading"     => __("Thumb Size", "js_composer"),
      "param_name"  => "thumb_size",
      "value"       => $sizes_options
    ),
    array(
      "type"        => "attach_image",
      "heading"     => __("Big Image", "js_composer"),
      "param_name"  => "image",
      "description" => __("Choose your lightbox Big Image.", "js_composer")
    ),
    array(
      "type"        => "dropdown",
      "heading"     => __("Big Image Size", "js_composer"),
      "param_name"  => "image_size",
      "value"       => $sizes_options
    ),
    $element_options['class'],
    $element_options['id'],
    $element_options['css_animation'],
    $element_options['css_animation_delay'],
  )
);


vc_map( $md_shortcodes['md_lightbox_image'] );

class WPBakeryShortCode_MD_Lightbox_Image extends WPBakeryShortCode {}