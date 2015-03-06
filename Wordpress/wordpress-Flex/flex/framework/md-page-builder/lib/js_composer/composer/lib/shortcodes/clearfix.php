<?php
/**
 *
 * MD Shortcodes Clearfix
 *
 */

$md_shortcodes['md_clearfix'] = array(
  "name" 						=> __("Clearfix", "js_composer"),
  "base" 						=> "md_clearfix",
  "modal"        				=> true,
  "show_settings_on_create" 	=> false,
);


vc_map( $md_shortcodes['md_clearfix'] );

class WPBakeryShortCode_MD_Clearfix extends WPBakeryShortCode {}
