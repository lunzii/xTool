<?php
/**
 *
 * MD Shortcodes Lighbox Map
 *
 */


$sizes = get_intermediate_image_sizes();
$sizes_options = array();

foreach($sizes as $size):

  $sizes_options[$size] = $size;

endforeach;

$md_shortcodes['md_lightbox_map'] = array(
  "name"            => __("Lightbox Map", "js_composer"),
  "base"            => "md_lightbox_map",
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
      "type"        => "textarea",
      "heading"     => __("Lightbox Map Url", "js_composer"),
      "param_name"  => "map",
      "description" => __("Insert the complete url of the Google Map.", "js_composer")
    ),
    $element_options['class'],
    $element_options['id'],
    $element_options['css_animation'],
    $element_options['css_animation_delay'],
  )
);


vc_map( $md_shortcodes['md_lightbox_map'] );

class WPBakeryShortCode_MD_Lightbox_Map extends WPBakeryShortCode {}