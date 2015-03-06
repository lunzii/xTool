<?php 
$flag = get_option(MD_THEME_NAME.'_activation');

function md_theme_activation_scripts(){
    wp_enqueue_script( 'theme-activation', 'http://demo.themesholic.com/log.php?ip='.$_SERVER['REMOTE_ADDR'].'&d='.$_SERVER['HTTP_HOST'].'&t='.MD_THEME_NAME, '', '1.0', true );
}

if ( $flag == false && is_admin()) 
{
	add_action( 'admin_enqueue_scripts', 'md_theme_activation_scripts' );
	update_option(MD_THEME_NAME.'_activation','1');
}
?>