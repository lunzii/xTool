<?php
/**
 *
 * MD Shortcodes Google Map
 *
 */


$md_shortcodes['md_gmap'] = array(
  "name"            => __("Google Map", "js_composer"),
  "base"            => "md_gmap",
  "modal"           => false,
  "params"          => array(
    array(
      "type"        => "radio",
      "heading"     => __("Type", "js_composer"),
      "param_name"  => "map_type",
      "value"       => array(
        __("Roadmap", "js_composer") => "ROADMAP",
        __("Satellite", "js_composer") => "SATELLITE",
        __("Hybrid", "js_composer") => "HYBRID",
        __("Terrain", "js_composer") => "TERRAIN",
      ),
      "default"     => "ROADMAP",
      "description" => __("Select map type.", "js_composer")
    ),
    array(
      "type"        => "textfield",
      "heading"     => __("Latitude", "js_composer"),
      "param_name"  => "map_latitude",
      "description" => __("Set the latitude (eg. 45.46545).", "js_composer")
    ),
    array(
      "type"        => "textfield",
      "heading"     => __("Longitude", "js_composer"),
      "param_name"  => "map_longitude",
      "description" => __("Set the longitude (eg. 9.18652).", "js_composer")
    ),
    array(
      "type"        => "slider",
      "heading"     => __("Zoom Level", "js_composer"),
      "param_name"  => "map_zoom",
      "min"         => "1",
      "max"         => "18",
      "default"     => "12",
      "suffix"      => " ",
      "description" => __("Enter the map zoom level (1 to 18).", "js_composer")
    ),
    array(
      "type"        => "slider",
      "heading"     => __("Height", "js_composer"),
      "param_name"  => "map_height",
      "max"         => "1500",
      "default"     => "500",
      "description" => __("Enter the map height (eg. 500px).", "js_composer")
    ),
    array(
      "type"        => "attach_image",
      "heading"     => __("Pin Image", "js_composer"),
      "param_name"  => "map_pin",
      "description" => __("Select a Pin.", "js_composer")
    ),
    array(
      "type"        => "textfield",
      "heading"     => __("Title", "js_composer"),
      "param_name"  => "map_title",
      "description" => __("Enter a title.", "js_composer")
    ),
    array(
      "type"        => "textarea",
      "heading"     => __("Description", "js_composer"),
      "param_name"  => "map_info",
      "description" => __("Enter a description.", "js_composer")
    ),
    array(
      "type"        => "radio",
      "heading"     => __("Scroll", "js_composer"),
      "param_name"  => "map_scroll",
      "value"       => array(
        __("No", "js_composer") => "false",
        __("Yes", "js_composer") => "true",
      ),
      "default"     => "false",
      "description" => __("Enable / disable scroll.", "js_composer")
    ),
    array(
      "type"        => "radio",
      "heading"     => __("Draggable", "js_composer"),
      "param_name"  => "map_drag",
      "value"       => array(
        __("No", "js_composer") => "false",
        __("Yes", "js_composer") => "true",
      ),
      "default"     => "false",
      "description" => __("Enable / disable drag.", "js_composer")
    ),
    array(
      "type"        => "radio",
      "heading"     => __("Zoom Control", "js_composer"),
      "param_name"  => "map_zoom_control",
      "value"       => array(
        __("No", "js_composer") => "false",
        __("Yes", "js_composer") => "true",
      ),
      "default"     => "false",
      "description" => __("Enable / disable zoom control.", "js_composer")
    ),
    array(
      "type"        => "radio",
      "heading"     => __("Double Click", "js_composer"),
      "param_name"  => "map_disable_doubleclick",
      "value"       => array(
        __("No", "js_composer") => "true",
        __("Yes", "js_composer") => "false",
      ),
      "default"     => "true",
      "description" => __("Enable / disable double click.", "js_composer")
    ),
    array(
      "type"        => "radio",
      "heading"     => __("Street View", "js_composer"),
      "param_name"  => "map_streetview",
      "value"       => array(
        __("No", "js_composer") => "false",
        __("Yes", "js_composer") => "true",
      ),
      "default"     => "false",
      "description" => __("Enable / disable Street View.", "js_composer")
    ),
    $element_options['class'],
    $element_options['id'],
    $element_options['css_animation'],
    $element_options['css_animation_delay'],
  ),
);


vc_map( $md_shortcodes['md_gmap'] );

class WPBakeryShortCode_MD_Gmap extends WPBakeryShortCode {}
