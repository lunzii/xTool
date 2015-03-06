<?php
/**
 *
 * MD Shortcodes Social Share Classic
 *
 */



$md_shortcodes['md_social_share_classic'] = array(
  "name"            => __("Social Share Classic", "js_composer"),
  "base"            => "md_social_share_classic",
  "modal"           => true,
  "params"          => array(
    array(
      "type"        => "radio",
      "heading"     => __("Facebook", "js_composer"),
      "param_name"  => "facebook",
      "value"       => array(
        'No'        => 'no',
        'Yes'       => 'yes',
      ),
      "default"     => ""
    ),
    array(
      "type"        => "radio",
      "heading"     => __("Twitter", "js_composer"),
      "param_name"  => "twitter",
      "value"       => array(
        'No'        => 'no',
        'Yes'       => 'yes',
      ),
      "default"     => ""
    ),
    array(
      "type"        => "radio",
      "heading"     => __("Google Plus", "js_composer"),
      "param_name"  => "googleplus",
      "value"       => array(
        'No'        => 'no',
        'Yes'       => 'yes',
      ),
      "default"     => ""
    ),
    array(
      "type"        => "radio",
      "heading"     => __("Pinterest", "js_composer"),
      "param_name"  => "pinterest",
      "value"       => array(
        'No'        => 'no',
        'Yes'       => 'yes',
      ),
      "default"     => ""
    ),
    $element_options['class'],
    $element_options['id'],
    $element_options['css_animation'],
    $element_options['css_animation_delay'],
  )
);



vc_map( $md_shortcodes['md_social_share_classic'] );

class WPBakeryShortCode_MD_Social_Share_Classic extends WPBakeryShortCode {}

