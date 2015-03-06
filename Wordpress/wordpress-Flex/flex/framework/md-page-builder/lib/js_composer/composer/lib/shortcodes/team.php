<?php
/**
 *
 * MD Shortcodes Team
 *
 */

$md_shortcodes['md_team'] = array(
  "name"            => __("Team", "js_composer"),
  "base"            => "md_team",
  "modal"           => true,
  "params"          => array(
    $element_options['posts_per_page'],
    $element_options['order_by'],
    $element_options['order'],
    $element_options['items_cols'],
    array(
      "type"        => "dropdown_multiple",
      "heading"     => __("Category", "js_composer"),
      "param_name"  => "category",
      "value"       => get_custom_post_categories('team-categories'),
      "default"     => ""
    ),
    array(
      "type"        => "dropdown",
      "heading"     => __("Preview Image", "js_composer"),
      "param_name"  => "preview_image",
      "value"       => array(
            __('Default', "js_composer")     => "default", 
            __('Circle', "js_composer")      => "circle", 
      ),
      "default"     => "default"
    ),
    array(
      "type"        => "dropdown",
      "heading"     => __("Show Name", "js_composer"),
      "param_name"  => "show_name",
      "value"       => array(
            __('No', "js_composer")     => "", 
            __('Yes', "js_composer")    => "true", 
      ),
      "default"     => ""
    ),
    array(
      "type"        => "dropdown",
      "heading"     => __("Show Presentation", "js_composer"),
      "param_name"  => "show_presentation",
      "value"       => array(
            __('No', "js_composer")     => "", 
            __('Yes', "js_composer")    => "true", 
      ),
      "default"     => ""
    ),
    array(
      "type"        => "dropdown",
      "heading"     => __("Show Social", "js_composer"),
      "param_name"  => "show_social",
      "value"       => array(
            __('No', "js_composer")     => "", 
            __('Yes', "js_composer")    => "true", 
      ),
      "default"     => ""
    ),
    $element_options['carousel'],
    $element_options['carousel_navigation'],
    $element_options['carousel_pagination'],
    $element_options['carousel_autoplay'],
    $element_options['class'],
    $element_options['id'],
    $element_options['css_animation'],
    $element_options['css_animation_delay'],
  )
);


vc_map( $md_shortcodes['md_team'] );

class WPBakeryShortCode_MD_Team extends WPBakeryShortCode {}
