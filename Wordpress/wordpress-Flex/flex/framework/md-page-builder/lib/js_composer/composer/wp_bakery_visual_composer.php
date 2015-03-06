<?php
/**
 * WPBakery Visual Composer Here includes useful files for plugin
 *
 * @package WPBakeryVisualComposer
 *
 */

$lib_dir 		= $composer_settings['COMPOSER_LIB'];
$shortcodes_dir = $composer_settings['SHORTCODES_LIB'];
$settings_dir 	= $composer_settings['COMPOSER'] . 'settings/';

require_once( $lib_dir . 'attributes.php' );
require_once( $lib_dir . 'wp_autoupdate.php' );
require_once( $lib_dir . 'abstract.php' );
require_once( $lib_dir . 'helpers.php' );
require_once( $lib_dir . 'helpers_api.php' );
require_once( $lib_dir . 'filters.php' );
require_once( $lib_dir . 'params.php' );

require_once( $lib_dir . 'mapper.php' );
require_once( $lib_dir . 'shortcodes.php' );
require_once( $lib_dir . 'composer.php' );

require_once( $settings_dir . 'settings.php');

sort($required_shortcodes);

foreach ($required_shortcodes as $shortcode):
	if(file_exists(MD_THEME_DIR . '/framework/md-page-builder/shortcodes/lib/'.$shortcode . '.php' )){
		require_once( MD_THEME_DIR . '/framework/md-page-builder/shortcodes/lib/'. $shortcode . '.php' );
	}

	else if(file_exists($shortcodes_dir . $shortcode . '.php' )){
		require_once( $shortcodes_dir . $shortcode . '.php' );
	}
endforeach;

require_once( $lib_dir . 'layouts.php' );

require_once( $lib_dir . 'params/load.php');