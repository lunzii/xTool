<?php
/**
 *
 * MD Shortcodes Revolution Slider
 *
 */

global $wpdb;
$rs = $wpdb->get_results( 
	"
	SELECT id, title, alias
	FROM ".$wpdb->prefix."revslider_sliders
	ORDER BY id ASC LIMIT 100
	"
);
$revsliders = array();
if ($rs) {
  foreach ( $rs as $slider ) {
    $revsliders[$slider->title] = $slider->alias;
  }
} else {
  $revsliders["No sliders found"] = 0;
}



$md_shortcodes['md_revslider'] = array(
  "name"            => __("Revolution Slider", "js_composer"),
  "base"            => "md_revslider",
  "modal"           => true,
  "params"          => array(
      array(
        "type" => "dropdown",
        "heading" => __("Revolution Slider", "js_composer"),
        "param_name" => "alias",
        "admin_label" => false,
        "value" => $revsliders,
        "description" => __("Select your Revolution Slider.", "js_composer")
      ),
      $element_options['class'],
      $element_options['id'],
  )
);


vc_map( $md_shortcodes['md_revslider'] );

class WPBakeryShortCode_MD_Revslider extends WPBakeryShortCode {}

