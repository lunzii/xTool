<?php 

/*-----------------------------------------------------------------------------------

	Here we have all the custom functions for the theme
	Please be extremely cautious editing this file,
	When things go wrong, they tend to go wrong in a big way.
	You have been warned!

-------------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
/*	Theme Admin Scripts
/*-----------------------------------------------------------------------------------*/
if(!function_exists('md_admin_styles')) {
	
	function md_admin_styles() {

		global $pagenow;

		wp_register_style('admin', get_template_directory_uri() . '/framework/assets/css/style.css');
		wp_enqueue_style('admin');

		wp_register_style('fontawesome', get_template_directory_uri() . '/framework/assets/fonts/fontawesome/font-awesome.css');
		wp_enqueue_style('fontawesome');

		wp_register_style('lineicons', get_template_directory_uri() . '/framework/assets/fonts/lineicons/lineicons.css');
		wp_enqueue_style('lineicons');

		wp_register_style('typicons', get_template_directory_uri() . '/framework/assets/fonts/typicons/typicons.css');
		wp_enqueue_style('typicons');	

		wp_register_style('entypo', get_template_directory_uri() . '/framework/assets/fonts/entypo/entypo.css');
		wp_enqueue_style('entypo');	


		if($pagenow == 'post-new.php' || $pagenow == 'post.php'){

			wp_register_style('chosen', get_template_directory_uri() . '/framework/assets/css/chosen.css');
			wp_enqueue_style('chosen');

			wp_register_script('chosen', get_template_directory_uri() . '/framework/assets/js/libs/chosen.jquery.min.js', array('jquery'), '0.9.15', true);
			wp_enqueue_script('chosen');

			wp_register_script('admin', get_template_directory_uri() . '/framework/assets/js/admin.js', array('jquery'), '1.0', true);
			wp_enqueue_script('admin');
		}
	}
	add_action( 'admin_init', 'md_admin_styles' );
}



/*-----------------------------------------------------------------------------------*/
/*	Theme Fonts
/*-----------------------------------------------------------------------------------*/
if(!function_exists('md_theme_fonts')) {
	function md_theme_fonts() {
		wp_register_style('fontawesome', get_template_directory_uri() . '/framework/assets/fonts/fontawesome/font-awesome.css');
		wp_enqueue_style('fontawesome');

		wp_register_style('lineicons', get_template_directory_uri() . '/framework/assets/fonts/lineicons/lineicons.css');
		wp_enqueue_style('lineicons');

		wp_register_style('typicons', get_template_directory_uri() . '/framework/assets/fonts/typicons/typicons.css');
		wp_enqueue_style('typicons');	

		wp_register_style('entypo', get_template_directory_uri() . '/framework/assets/fonts/entypo/entypo.css');
		wp_enqueue_style('entypo');	
	}
	add_action( 'wp_enqueue_scripts', 'md_theme_fonts' );
}

/*-----------------------------------------------------------------------------------*/
/*	Theme Helpers
/*-----------------------------------------------------------------------------------*/
if ( file_exists( dirname( __FILE__ ) . '/lib/helpers.php' ) ) {
    require_once(dirname( __FILE__ ) . '/lib/helpers.php' );
}


/*-----------------------------------------------------------------------------------*/
/*	TGM Plugin Activation
/*-----------------------------------------------------------------------------------*/
if ( file_exists( dirname( __FILE__ ) . '/lib/tgm-plugin-activation.php' ) ) {
    require_once(dirname( __FILE__ ) . '/lib/tgm-plugin-activation.php' );
}


/*-----------------------------------------------------------------------------------*/
/*	Required Plugins
/*-----------------------------------------------------------------------------------*/
if ( file_exists( dirname( __FILE__ ) . '/plugins/config.php' ) ) {
    require_once(dirname( __FILE__ ) . '/plugins/config.php' );
}


/*-----------------------------------------------------------------------------------*/
/*	Theme Options
/*-----------------------------------------------------------------------------------*/
if ( !isset( $theme_options ) && file_exists( dirname( __FILE__ ) . '/theme-options/config.php' ) ) {
	$theme_options = get_option(MD_THEME_NAME);
    require_once(dirname( __FILE__ ) . '/theme-options/config.php' );
}


/*-----------------------------------------------------------------------------------*/
/*	Metabox
/*-----------------------------------------------------------------------------------*/
if ( file_exists( dirname( __FILE__ ) . '/metabox/config.php' ) ) {
    require_once(dirname( __FILE__ ) . '/metabox/config.php' );
}


/*-----------------------------------------------------------------------------------*/
/*	Custom Posts
/*-----------------------------------------------------------------------------------*/
if ( file_exists( dirname( __FILE__ ) . '/custom-posts/config.php' ) ) {
    require_once(dirname( __FILE__ ) . '/custom-posts/config.php' );
}


/*-----------------------------------------------------------------------------------*/
/*	MD Page Builder
/*-----------------------------------------------------------------------------------*/
if ( file_exists( dirname( __FILE__ ) . '/md-page-builder/config.php' ) ) {
    require_once(dirname( __FILE__ ) . '/md-page-builder/config.php' );
}


/*-----------------------------------------------------------------------------------*/
/*	Demo Pages
/*-----------------------------------------------------------------------------------*/
if ( file_exists( dirname( __FILE__ ) . '/md-page-builder/templates-demo/import.php' ) ) {
    require_once(dirname( __FILE__ ) . '/md-page-builder/templates-demo/import.php' );
}


/*-----------------------------------------------------------------------------------*/
/*	MD Mega Menu
/*-----------------------------------------------------------------------------------*/
if ( file_exists( dirname( __FILE__ ) . '/md-megamenu/config.php' ) ) {
    require_once(dirname( __FILE__ ) . '/md-megamenu/config.php' );
}


/*-----------------------------------------------------------------------------------*/
/*	WooCommerce Integration
/*-----------------------------------------------------------------------------------*/
if ( file_exists( dirname( __FILE__ ) . '/woocommerce/config.php' ) ) {
    require_once(dirname( __FILE__ ) . '/woocommerce/config.php' );
}


/*-----------------------------------------------------------------------------------*/
/*	MD Widgets
/*-----------------------------------------------------------------------------------*/
if ( file_exists( dirname( __FILE__ ) . '/md-widgets/config.php' ) ) {
    require_once(dirname( __FILE__ ) . '/md-widgets/config.php' );
}


/*-----------------------------------------------------------------------------------*/
/*	Force View (For Demo)
/*-----------------------------------------------------------------------------------*/
if ( file_exists( dirname( __FILE__ ) . '/lib/force.php' ) && MD_DEBUG) {
    require_once(dirname( __FILE__ ) . '/lib/force.php' );
}


/*-----------------------------------------------------------------------------------*/
/*	Theme Activation
/*-----------------------------------------------------------------------------------*/
if ( file_exists( dirname( __FILE__ ) . '/lib/activation.php' )) {
    require_once(dirname( __FILE__ ) . '/lib/activation.php' );
}


/*-----------------------------------------------------------------------------------*/
/*	MD Updater
/*-----------------------------------------------------------------------------------*/
if ( file_exists( dirname( __FILE__ ) . '/md-updater/config.php' )) {
    require_once(dirname( __FILE__ ) . '/md-updater/config.php' );
}


/*-----------------------------------------------------------------------------------*/
/*	MD Themes
/*-----------------------------------------------------------------------------------*/
if ( file_exists( dirname( __FILE__ ) . '/md-themes/config.php' )) {
    require_once(dirname( __FILE__ ) . '/md-themes/config.php' );
}

?>