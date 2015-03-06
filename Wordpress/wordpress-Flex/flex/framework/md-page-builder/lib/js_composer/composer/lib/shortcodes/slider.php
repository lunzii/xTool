<?php
/**
 *
 * MD Shortcodes Slider
 *
 */



$sizes = get_intermediate_image_sizes();
$sizes_options = array();

foreach($sizes as $size):

  $sizes_options[$size] = $size;

endforeach;

$md_shortcodes['md_slider'] = array(
  "name"            => __("Slider Images", "js_composer"),
  "base"            => "md_slider",
  "modal"           => false,
  "params"          => array(
    array(
      "type"        => "attach_images",
      "heading"     => __("Slider Images", "js_composer"),
      "param_name"  => "images",
      "description" => __("Choose your images.", "js_composer")
    ),
    array(
      "type"        => "dropdown",
      "heading"     => __("Image Size", "js_composer"),
      "param_name"  => "size",
      "value"       => $sizes_options
    ),

    array(
      "type"        => "dropdown",
      "heading"     => __("Slider Effect", "js_composer"),
      "param_name"  => "effect",
      "value"       => array(
            __('Fade', "js_composer")     => "fade", 
            __('Slide', "js_composer")    => "slide", 
      ),
      "default"     => "default"
    ),
    array(
      "type"        => "dropdown",
      "heading"     => __("Show Navigation", "js_composer"),
      "param_name"  => "navigation",
      "value"       => array(
            __('No', "js_composer")     => "", 
            __('Yes', "js_composer")    => "true", 
      ),
      "default"     => ""
    ),
    array(
      "type"        => "dropdown",
      "heading"     => __("Show Pagination", "js_composer"),
      "param_name"  => "pagination",
      "value"       => array(
            __('No', "js_composer")     => "", 
            __('Yes', "js_composer")    => "true", 
      ),
      "default"     => ""
    ),
    $element_options['class'],
    $element_options['id'],
    $element_options['css_animation'],
    $element_options['css_animation_delay'],
  )
);



vc_map( $md_shortcodes['md_slider'] );

class WPBakeryShortCode_MD_Slider extends WPBakeryShortCode {}