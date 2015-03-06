<?php
/**
 *
 * MD Shortcodes Lighbox Video
 *
 */


$sizes = get_intermediate_image_sizes();
$sizes_options = array();

foreach($sizes as $size):

  $sizes_options[$size] = $size;

endforeach;

$md_shortcodes['md_lightbox_video'] = array(
  "name"            => __("Lightbox Video", "js_composer"),
  "base"            => "md_lightbox_video",
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
      "type"        => "textfield",
      "heading"     => __("Video Url", "js_composer"),
      "param_name"  => "video",
      "description" => __("Insert the complete url of the video (Youtube/Vimeo).", "js_composer")
    ),
    $element_options['class'],
    $element_options['id'],
    $element_options['css_animation'],
    $element_options['css_animation_delay'],
  )
);


vc_map( $md_shortcodes['md_lightbox_video'] );

class WPBakeryShortCode_MD_Lightbox_Video extends WPBakeryShortCode {}