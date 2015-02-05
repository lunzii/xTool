<?php
/**
 *
 * MD Shortcodes Clients
 *
 */

$md_shortcodes['md_clients'] = array(
  "name"            => __("Clients", "js_composer"),
  "base"            => "md_clients",
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
      "value"       => get_custom_post_categories('clients-categories'),
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


vc_map($md_shortcodes['md_clients']);

class WPBakeryShortCode_MD_Clients extends WPBakeryShortCode {}

