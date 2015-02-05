<?php
/**
 *
 * MD Shortcodes Tabs
 *
 */




$md_shortcodes['md_tabs'] = array(
  "name"            => __("Tabs", "js_composer"),
  "base"            => "md_tabs",
  "modal"           => true,
  "params"          => array(
    array(
      "type"        => "textarea_html",
      "heading"     => __("Content", "js_composer"),
      "param_name"  => "content",
      "disable_modal" => true,
      "shortcode_btn"  => 'only',
      "shortcode"   => "md_tabs",
      "value"       => "",
      "description" => __('Click on <img src="'.get_template_directory_uri().'/framework/md-page-builder/lib/md-shortcodes/tinymce/shortcode_generator/icons/shortcode-icon.png" /> for add new Tab Element. Highlight content for edit.', "js_composer"),
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
      "param_name"  => "tab",
      "name"        => "tab",
    ),
    $element_options['class'],
    $element_options['id'],
    $element_options['css_animation'],
    $element_options['css_animation_delay'],
  )
);



vc_map( $md_shortcodes['md_tabs'] );

class WPBakeryShortCode_MD_Tabs extends WPBakeryShortCode {}




$md_shortcodes['md_tab'] = array(
  "name"            => __("Tab", "js_composer"),
  "base"            => "md_tab",
  "content_element" => false,
  "modal"           => false,
);



vc_map($md_shortcodes['md_tab']);

class WPBakeryShortCode_MD_Tab extends WPBakeryShortCode_MD_Tabs {}
