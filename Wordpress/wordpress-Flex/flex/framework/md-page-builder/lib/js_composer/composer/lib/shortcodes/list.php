<?php
/**
 *
 * MD Shortcodes List
 *
 */


$md_shortcodes['md_list'] = array(
  "name"            => __("List", "js_composer"),
  "base"            => "md_list",
  "modal"           => true,
  "params"          => array(
    array(
      "type"        => "textarea_raw_html",
      "heading"     => __("Text", "js_composer"),
      "param_name"  => "content",
      "value"       => "",
      "description" => "Insert &lt;li&gt;your content&lt;/li&gt; for each list element"
    ),
    array(
      "type"        => "radio",
      "heading"     => __("Type", "js_composer"),
      "param_name"  => "list_type",
      "value"       => array(
            __('Normal', "js_composer")   => "normal", 
            __('Bullet', "js_composer")   => "bullet", 
            __('Ordered', "js_composer")  => "ordered", 
            __('Icon', "js_composer")     => "list-icon", 
      ),
      "description" => __("Select list type.", "js_composer"),
    ),
    array(
      "type"        => "radio",
      "heading"     => __("Font Size", "js_composer"),
      "param_name"  => "font_size",
      "value"       => array(
            __('Normal', "js_composer")   => "", 
            __('Mini', "js_composer")     => "mini", 
            __('Big', "js_composer")      => "big", 
      ),
      "description" => __("Select font size.", "js_composer"),
    ),
    $element_options['icon_color'],
    $element_options['icon_family'],
    $element_options['icon_fontawesome'],
    $element_options['icon_typicons'],
    $element_options['icon_entypo'],
    $element_options['icon_lineicons'],
    $element_options['class'],
    $element_options['id'],
    $element_options['css_animation'],
    $element_options['css_animation_delay'],
  )
);


vc_map( $md_shortcodes['md_list'] );

class WPBakeryShortCode_MD_List extends WPBakeryShortCode {}