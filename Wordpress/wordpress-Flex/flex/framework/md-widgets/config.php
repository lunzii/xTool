<?php 
	$widgets = array(
		'social-profiles',
		'twitter',
		'dribbble',
		'flickr',
		'pinterest',
	);

	foreach ($widgets as $w):
		if ( file_exists( dirname( __FILE__ ) . '/widgets/'.$w.'.php' ) ) {
		    require_once(dirname( __FILE__ ) . '/widgets/'.$w.'.php' );
		}
	endforeach;
 ?>