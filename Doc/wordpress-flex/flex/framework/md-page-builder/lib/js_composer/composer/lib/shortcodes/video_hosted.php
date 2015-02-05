<?php
/**
 *
 * MD Shortcodes Video Self Hosted
 *
 */

$md_shortcodes['md_video_hosted'] = array(
  "name"            => __("Video Self Hosted", "js_composer"),
  "base"            => "md_video_hosted",
  "modal"           => false,
  "params"          => array(
    array(
      "type"        => "textfield",
      "heading"     => __("MP4 Format", "js_composer"),
      "param_name"  => "video_mp4",
      "description" => __("Set Url MP4 ", "js_composer"),
      "value"       => "",
    ),
    array(
      "type"        => "textfield",
      "heading"     => __("WEBM Format", "js_composer"),
      "param_name"  => "video_webm",
      "description" => __("Set Url WEBM ", "js_composer"),
      "value"       => "",
    ),
    array(
      "type"        => "textfield",
      "heading"     => __("OGV Format", "js_composer"),
      "param_name"  => "video_ogv",
      "description" => __("Set Url OGV ", "js_composer"),
      "value"       => "",
    ),
    array(
      "type"        => "attach_image",
      "heading"     => __("Poster", "js_composer"),
      "param_name"  => "video_poster",
      "description" => __("Set Poster Image ", "js_composer"),
      "value"       => "",
    ),
    array(
      "type"        => "radio",
      "heading"     => __("Autoplay", "js_composer"),
      "param_name"  => "autoplay",
      "value"       => array(
        __('Yes', "js_composer") => "yes", 
        __('No', "js_composer") => "no", 
      ),
      "default"     => "yes"
    ),
    array(
      "type"        => "radio",
      "heading"     => __("Controls", "js_composer"),
      "param_name"  => "controls",
      "value"       => array(
        __('Yes', "js_composer") => "yes", 
        __('No', "js_composer") => "no", 
      ),
      "default"     => "yes"
    ),
    $element_options['class'],
    $element_options['id'],
    $element_options['css_animation'],
    $element_options['css_animation_delay'],
  )
);

vc_map( $md_shortcodes['md_video_hosted'] );

class WPBakeryShortCode_MD_Video_hosted extends WPBakeryShortCode {}