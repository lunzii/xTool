<?php
/**
 *
 * MD Shortcodes Accordions
 *
 */

$md_shortcodes['md_accordions'] = array(
  "name"            => __("Accordions", "js_composer"),
  "base"            => "md_accordions",
  "modal"           => true,
  "params"          => array(
    array(
      "type"        => "textarea_html",
      "heading"     => __("Content", "js_composer"),
      "param_name"  => "content",
      "disable_modal" => true,
      "shortcode_btn"  => 'only',
      "shortcode"   => "md_accordions",
      "value"       => "",
      "description" => __('Click on <img src="'.get_template_directory_uri().'/framework/md-page-builder/lib/md-shortcodes/tinymce/shortcode_generator/icons/shortcode-icon.png" /> for add new Accordion Element. Highlight content for edit.', "js_composer"),
    ),
    array(
      "type"        => "radio",
      "heading"     => __("First Expanded?", "js_composer"),
      "param_name"  => "expanded",
      "value"       => array(
            __('Yes', "js_composer")     => "expanded", 
            __('No', "js_composer")  => "no-expanded", 
      ),
      "default"     => "expanded"
    ),
    array(
      "type"        => "radio",
      "heading"     => __("Color Scheme", "js_composer"),
      "param_name"  => "color_scheme",
      "value"       => array(
            __('Default', "js_composer")     => "", 
            __('Theme Color', "js_composer")  => "theme-color", 
      ),
      "default"     => ""
    ),
    array(
      "type"        => "custom",
      "param_name"  => "accordion",
      "name"        => "accordion",
    ),
    $element_options['class'],
    $element_options['id'],
    $element_options['css_animation'],
    $element_options['css_animation_delay'],
  )
);


vc_map($md_shortcodes['md_accordions']);

class WPBakeryShortCode_MD_Accordions extends WPBakeryShortCode {}

$md_shortcodes['md_accordion'] = array(
  "name"            => __("accordion", "js_composer"),
  "base"            => "md_accordion",
  "content_element" => false,
  "modal"           => false,
);

vc_map($md_shortcodes['md_accordion']);

class WPBakeryShortCode_MD_Accordion extends WPBakeryShortCode_MD_Accordions {}
