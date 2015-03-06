<?php
/**
 *
 * MD Shortcodes Testimonials Minimal
 *
 */

$md_shortcodes['md_testimonials_minimal'] = array(
  "name"            => __("Testimonials Minimal", "js_composer"),
  "base"            => "md_testimonials_minimal",
  "modal"           => true,
  "params"          => array(
    array(
      "type"        => "colorpicker",
      "heading"     => __("Text Color", "js_composer"),
      "param_name"  => "color",
      "value"       => $theme_options['font-body']['color'],
    ),
    $element_options['posts_per_page'],
    $element_options['order_by'],
    $element_options['order'],
    $element_options['items_cols'],
    array(
      "type"        => "dropdown_multiple",
      "heading"     => __("Category", "js_composer"),
      "param_name"  => "category",
      "value"       => get_custom_post_categories('testimonials-categories'),
      "default"     => ""
    ),
    $element_options['carousel'],
    $element_options['carousel_autoplay'],
    $element_options['class'],
    $element_options['id'],
    $element_options['css_animation'],
    $element_options['css_animation_delay'],
  )
);

vc_map($md_shortcodes['md_testimonials_minimal']);

class WPBakeryShortCode_MD_Testimonials_minimal extends WPBakeryShortCode {}