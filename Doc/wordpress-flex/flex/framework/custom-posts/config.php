<?php 
/*-----------------------------------------------------------------------------------*/
/*	Set Custom Posts
/*-----------------------------------------------------------------------------------*/
$custom_posts = array(
	'portfolio',
	'clients',
	'testimonials',
	'team',
);


foreach ($custom_posts as $custom_post):


	if ( file_exists( dirname( __FILE__ ) . '/lib/'.$custom_post.'/config.php' ) ) {
	    require_once(dirname( __FILE__ ) . '/lib/'.$custom_post.'/config.php' );
	}

endforeach;

?>