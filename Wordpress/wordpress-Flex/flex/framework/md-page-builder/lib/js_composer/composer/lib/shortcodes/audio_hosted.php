<?php
/**
 *
 * MD Shortcodes Audio Self Hosted
 *
 */

$md_shortcodes['md_audio'] = array(
  "name"            => __("Audio Self Hosted", "js_composer"),
  "base"            => "md_audio_hosted",
  "modal"           => false,
  "params"          => array(
    array(
      "type"        => "textfield",
      "heading"     => __("MP3", "js_composer"),
      "param_name"  => "audio_mp3",
      "description" => __("Set Url MP3 ", "js_composer"),
      "value"       => "",
    ),
    $element_options['class'],
    $element_options['id'],
    $element_options['css_animation'],
    $element_options['css_animation_delay'],
  )
);

vc_map( $md_shortcodes['md_audio'] );

class WPBakeryShortCode_MD_Audio_hosted extends WPBakeryShortCode {}