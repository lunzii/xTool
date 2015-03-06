<?php 
/*-----------------------------------------------------------------------------------*/
/*	Set Shortcodes
/*-----------------------------------------------------------------------------------*/
$required_shortcodes = array(
	'accordions',
	'alert',
	'audio_hosted',
	'blank_space',
	'blockquote',
	'box',
	'box_icon',
	'button',
	'call_to_action',
	'clearfix',
	'clients',
	'counter',
	'custom_css',
	'custom_html',
	'custom_js',
	'divider',
	'dropcap',
	'flip_box',
	'gallery',
	'gmap',
	'heading',
	'heading_custom',
	'highlight',
	'icon',
	'list',
	'lightbox_image',
	'lightbox_gallery',
	'lightbox_video',
	'lightbox_map',
	'row',
	'row_inner',
	'portfolio',
	'progress_bar',
	'progress_circular',
	'recent_posts',
	'column',
	'column_inner',
	'shortcode_manual',
	'slider',
	'social_share',
	'social_share_classic',
	'special_heading',
	'single_image',
	'tabs',
	'team',
	'testimonials',
	'testimonials_minimal',
	'text',
	'text_rotator',
	'tooltip',
	'toggles',
	'tours',
	'video',
	'video_hosted',
);

include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); 
(is_plugin_active('contact-form-7/wp-contact-form-7.php')) ? $required_shortcodes[] = 'contact_form_7' : '';
(is_plugin_active('revslider/revslider.php')) ? $required_shortcodes[] = 'revslider' : '';
(is_plugin_active('oauth-twitter-feed-for-developers/twitter-feed-for-developers.php')) ? $required_shortcodes[] = 'twitter_feed' : '';


?>