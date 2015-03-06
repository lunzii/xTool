<?php
/**
 *
 * MD Shortcodes Contact Form 7
 *
 */

global $wpdb;
$cf7 = $wpdb->get_results( 
	"
	SELECT ID, post_title 
	FROM $wpdb->posts
	WHERE post_type = 'wpcf7_contact_form' 
	"
);
$contact_forms = array();
if ($cf7) {
	foreach ( $cf7 as $cform ) {
	  $contact_forms[$cform->post_title] = $cform->ID;
	}
} else {
	$contact_forms["No contact forms found"] = 0;
}


$md_shortcodes['md_contact_form_7'] = array(
  "name"            => __("Contact Form 7", "js_composer"),
  "base"            => "contact-form-7",
  "modal"           => true,
  "params"          => array(
    array(
      "type"        => "dropdown",
      "heading"     => __("Select Form", "js_composer"),
      "param_name"  => "id",
      "value"       => $contact_forms,
      "description" => __("Select your Contact Form 7.", "js_composer")
    ),
  )
);


vc_map( $md_shortcodes['md_contact_form_7'] );

class WPBakeryShortCode_MD_Contact_form_7 extends WPBakeryShortCode {}