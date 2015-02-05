<?php
/**
 *
 * MD Shortcodes Portfolio
 *
 */


$md_shortcodes['md_portfolio'] = array(
  "name"            => __("Portfolio", "js_composer"),
  "base"            => "md_portfolio",
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
      "value"       => get_custom_post_categories('portfolio-categories'),
      "default"     => ""
    ),
    array(
      "type"        => "radio",
      "heading"     => __("Style", "js_composer"),
      "param_name"  => "style",
      "value"       => array(
        __('Default', "js_composer") => "default", 
        __('Alternative', "js_composer") => "alternative", 
        __('Masonry', "js_composer") => "masonry", 
      ),
      "default"     => "default"
    ),
    array(
      "type"        => "dropdown",
      "heading"     => __("Show Filter", "js_composer"),
      "param_name"  => "show_filter",
      "value"       => array(
            __('No', "js_composer")     => "", 
            __('Yes', "js_composer")    => "true", 
      ),
      "default"     => "",
      "dependency"  => array('element' => "style", 'value' => array('default', 'alternative'))
    ),
    array(
      "type"        => "dropdown",
      "heading"     => __("Filter Style", "js_composer"),
      "param_name"  => "filter_style",
      "value"       => array(
            __('Light', "js_composer")  => "light", 
            __('Dark', "js_composer")   => "dark", 
      ),
      "default"     => "light",
      "dependency"  => array('element' => "show_filter", 'value' => array('true'))
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


vc_map( $md_shortcodes['md_portfolio'] );

class WPBakeryShortCode_MD_Portfolio extends WPBakeryShortCode {}
