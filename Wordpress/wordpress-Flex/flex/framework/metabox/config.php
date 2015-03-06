<?php 
	$md_metabox = array();
	
	if ( file_exists( dirname( __FILE__ ) . '/lib/form.class.php' ) ) {
	    require_once(dirname( __FILE__ ) . '/lib/form.class.php' );
	}

	if ( file_exists( dirname( __FILE__ ) . '/lib/metabox.class.php' ) ) {
	    require_once(dirname( __FILE__ ) . '/lib/metabox.class.php' );
	}


	$metabox = array(
		'page-header',
		'page-general',
		'post'
	);

	foreach ($metabox as $m):
		if ( file_exists( dirname( __FILE__ ) . '/meta/'.$m.'.php' ) ) {
		    require_once(dirname( __FILE__ ) . '/meta/'.$m.'.php' );
		}
	endforeach;

	$theme_metabox = new METABOX_HELPER();
	
	$theme_metabox->init();


?>