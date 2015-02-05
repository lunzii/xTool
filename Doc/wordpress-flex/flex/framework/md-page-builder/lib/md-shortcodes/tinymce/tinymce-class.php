<?php
/*-----------------------------------------------------------------------------------*/
/*	TinyMCE Shortcode Button
/*-----------------------------------------------------------------------------------*/
function md_tiny() {	
	if ( ( current_user_can('edit_posts') || current_user_can('edit_pages') ) && get_user_option('rich_editing') ) {
     	add_filter("mce_external_plugins", "add_js_plugin");
     	add_filter('mce_buttons', 'register_md_tinymce_button');
   } 
}

add_action('init', 'md_tiny');


function add_js_plugin( $plugin_array ) {
   $plugin_array['md_buttons'] = MD_SHORTCODES_URI . 'tinymce/md.tinymce.js';
   return $plugin_array;
}

function register_md_tinymce_button( $buttons ) {
	array_push( $buttons, "shortcodebtns" );
	return $buttons; 
}

?>