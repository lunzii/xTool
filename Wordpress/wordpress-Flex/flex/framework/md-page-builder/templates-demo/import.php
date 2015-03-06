<?php


add_action( 'wp_ajax_add_demo_templates', 'add_demo_templates' );

function add_demo_templates() {


	$dir = dirname(__FILE__).'/templates';

	if ($handle = opendir($dir)) {
	    while (false !== ($entry = readdir($handle))) {
	        if ($entry != "." && $entry != ".." && $entry != ".DS_Store") {

	            $template_name = str_replace('.php', '', $entry);
	            $template_name = str_replace('-', ' ', $template_name);
	            $template_name = ucwords($template_name);
	        	$template = file_get_contents($dir.'/'.$entry);
			    
			    $template_arr = array( "name" => stripslashes($template_name), "template" => stripslashes($template) );
			    $option_name = 'wpb_js_templates';
			    $saved_templates = get_option($option_name);


			    $template_id = sanitize_title($template_name)."_".rand();
			    if ( $saved_templates == false ) {
			        $deprecated = '';
			        $autoload = 'no';
			        //
			        $new_template = array();
			        $new_template[$template_id] = $template_arr;
			        //
			        add_option( $option_name, $new_template, $deprecated, $autoload );
			    } else {
			        $saved_templates[$template_id] = $template_arr;
			        update_option($option_name, $saved_templates);
			    }

	        }
	    }
	    closedir($handle);
	}

	return true;
}

?>