<?php
define('MD_SHORTCODES_URI', get_template_directory_uri().'/framework/md-page-builder/lib/md-shortcodes/');
define('MD_SHORTCODES_DIR', get_template_directory().'/framework/md-page-builder/lib/md-shortcodes/');


/*-----------------------------------------------------------------------------------*/
/*	Translation
/*-----------------------------------------------------------------------------------*/
load_plugin_textdomain( 'textdomain', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );


/*-----------------------------------------------------------------------------------*/
/*	Shortcodes
/*-----------------------------------------------------------------------------------*/
require_once( MD_SHORTCODES_DIR .'/tinymce/tinymce-class.php' );


/*-----------------------------------------------------------------------------------*/
/*	Register / Enqueue CSS
/*-----------------------------------------------------------------------------------*/
function md_shortcodes_backend() {

}
add_action('admin_init', 'md_shortcodes_backend');


/*-----------------------------------------------------------------------------------*/
/*	Register / Enqueue JS
/*-----------------------------------------------------------------------------------*/
function md_shortcodes_frontend() {
	
	# GOOGLE MAPS #
	/*wp_enqueue_script('google-maps', 'http://maps.google.com/maps/api/js?sensor=false', NULL, NULL, true);*/

	
	# JQUERY EASING #
	wp_enqueue_script('jquery-easing', MD_SHORTCODES_URI.'assets/js/libs/jquery.easing.js', array('jquery'), '1.3.0', true);

	
	# ISOTOPE #
	wp_deregister_script('isotope');
	wp_enqueue_script('isotope', MD_SHORTCODES_URI.'assets/js/libs/jquery.isotope.js', array('jquery'), '1.5.25', true);

	
	# OWL CAROUSEL #
	wp_enqueue_script('owl-carousel', MD_SHORTCODES_URI.'assets/js/libs/owl-carousel/owl.carousel.min.js', array('jquery'), '1.27', true);
	wp_enqueue_style('owl-carousel', MD_SHORTCODES_URI.'assets/js/libs/owl-carousel/owl.carousel.css');


	# FLEXSLIDER #
	wp_enqueue_script('jquery-flexslider', MD_SHORTCODES_URI.'assets/js/libs/jquery.flexslider-min.js', array('jquery'), '2.2.2', true);


	# FANCYBOX 2 #
	wp_enqueue_script('jquery-fancybox', MD_SHORTCODES_URI.'assets/js/libs/fancybox/jquery.fancybox.pack.js', array('jquery'), '2.1.5', true);
	wp_enqueue_script('jquery-fancybox-media', MD_SHORTCODES_URI.'assets/js/libs/fancybox/helpers/jquery.fancybox-media.js', array('jquery'), '1.0.6', true);
	wp_enqueue_style('jquery-fancybox', MD_SHORTCODES_URI.'assets/js/libs/fancybox/jquery.fancybox.css');


	# FITVIDS #
	wp_enqueue_script('jquery-fitvids', MD_SHORTCODES_URI . 'assets/js/libs/jquery.fitvids.js', array('jquery'), '1.0.3', true);

	
	# MEDIAELEMENT #
	wp_deregister_script('mediaelement');
	wp_enqueue_script('md-mediaelement', MD_SHORTCODES_URI . 'assets/js/libs/mediaelement/mediaelement-and-player.min.js', array('jquery'), '2.14.2', true);
	#wp_enqueue_style('md-mediaelement', MD_SHORTCODES_URI . 'assets/js/libs/mediaelement/mediaelementplayer.min.css');


	# COUNT TO #
	wp_enqueue_script('jquery-countTo', MD_SHORTCODES_URI . 'assets/js/libs/jquery.countTo.js', array('jquery'), '1.0', true);


	# VIEWPORT #
	wp_enqueue_script('jquery-viewport', MD_SHORTCODES_URI . 'assets/js/libs/jquery.viewport.js', array('jquery'), '1.0', true);


	# PROGRESS CIRCULAR #
	wp_enqueue_script('jquery-easypiechart', MD_SHORTCODES_URI . 'assets/js/libs/jquery.easypiechart.js', array('jquery'), '1.2.5', true);


	# SIMPLY TEXT ROTATOR #
	wp_enqueue_script('jquery-simple-text-rotator', MD_SHORTCODES_URI.'assets/js/libs/jquery.simple-text-rotator.min.js', array('jquery'), '1.0', true);


	# ANIMATE #
	wp_enqueue_style('animate', MD_SHORTCODES_URI . 'assets/css/animate.css');


	# SHORTCODES #
	wp_enqueue_script('md-shortcodes', MD_SHORTCODES_URI . "assets/js/md-shortcodes.js", array('jquery'), true);		 
}
add_action('wp_enqueue_scripts', 'md_shortcodes_frontend');
?>