<?php
/**
 *
 * MD Shortcodes Lighbox Gallery
 *
 */


$sizes = get_intermediate_image_sizes();
$sizes_options = array();

foreach($sizes as $size):

  $sizes_options[$size] = $size;

endforeach;

$md_shortcodes['md_lightbox_gallery'] = array(
  "name"            => __("Lightbox Gallery", "js_composer"),
  "base"            => "md_lightbox_gallery",
  "modal"           => false,
  "params"          => array(
    array(
      "type"        => "attach_images",
      "heading"     => __("Gallery Images", "js_composer"),
      "param_name"  => "images",
      "description" => __("Choose your images.", "js_composer")
    ),
    array(
      "type"        => "dropdown",
      "heading"     => __("Thumb Size", "js_composer"),
      "param_name"  => "thumb_size",
      "value"       => $sizes_options
    ),
    array(
      "type"        => "dropdown",
      "heading"     => __("Big Image Size", "js_composer"),
      "param_name"  => "image_size",
      "value"       => $sizes_options
    ),    array(
      "type"        => "radio",
      "heading"     => __("Preview only first image", "js_composer"),
      "param_name"  => "only_first",
      "value"       => array(
        __('No', "js_composer") => "", 
        __('Yes', "js_composer") => "yes", 
      ),
      "default"     => ""
    ),
    $element_options['items_cols'],
    $element_options['class'],
    $element_options['id'],
    $element_options['css_animation'],
    $element_options['css_animation_delay'],
  )
);


vc_map( $md_shortcodes['md_lightbox_gallery'] );

class WPBakeryShortCode_MD_Lightbox_Gallery extends WPBakeryShortCode {}