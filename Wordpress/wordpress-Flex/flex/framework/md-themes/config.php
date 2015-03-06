<?php 

if(!MD_MORE_THEMES)
return;

add_action('admin_menu', 'md_more_themes_menu');

function md_more_themes_menu() {
	add_theme_page('ThemesHolic Themes', 'Get More Themes', 'edit_theme_options', 'md-more-themes', 'md_more_themes');
}

function md_more_themes_script() {
    wp_enqueue_script( 'md-more-themes', MD_THEME_URI.'/framework/md-themes/assets/js/md-themes.js', array('jquery'), '1.0', true );

    wp_enqueue_style( 'md-more-themes', MD_THEME_URI.'/framework/md-themes/assets/css/md-themes.css' );
}
add_action( 'admin_enqueue_scripts', 'md_more_themes_script' );

function md_more_themes(){
	echo '<div id="md-themes">';
	echo '<h2 id="theme-title">Showcase of Our Awesome Themes</h2>';
	echo '<div id="themes-list"></div>';
	echo '<a href="http://www.themesholic.com" target="_blank">ThemesHolic | Premium Wordpress Themes</a>';
	echo '</div>';
}

?>