<?php
/**
 *
 * MD Shortcodes Video
 *
 */

$md_shortcodes['md_video'] = array(
  "name"            => __("Video Youtube / Vimeo", "js_composer"),
  "base"            => "md_video",
  "modal"           => true,
  "params"          => array(
    array(
      "type"        => "radio",
      "heading"     => __("Video Type", "js_composer"),
      "param_name"  => "type",
      "value"       => array(
        __('YouTube', "js_composer")  => "youtube", 
        __('Vimeo', "js_composer")    => "vimeo", 
      ),
      "default"     => "youtube",
      "description" => __("Select Video Type.", "js_composer")
    ),
    array(
      "type"        => "textfield",
      "heading"     => __("Video ID", "js_composer"),
      "param_name"  => "video_id",
      "description" => __("Set Video ID (eg. YouTube: 4Wkr0eXiUNw | eg. Vimeo: 7449107).", "js_composer")
    ),
    $element_options['class'],
    $element_options['id'],
    $element_options['css_animation'],
    $element_options['css_animation_delay'],
  )
);

vc_map( $md_shortcodes['md_video'] );

class WPBakeryShortCode_MD_Video extends WPBakeryShortCode {}
