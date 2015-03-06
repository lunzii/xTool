<?php
if(MD_DEBUG):
	if (isset($_REQUEST['sidebar'])){
		$theme_options['woocommerce-sidebar'] = $_REQUEST['sidebar'];
		$theme_options['blog-sidebar'] = $_REQUEST['sidebar'];
		$theme_options['post-sidebar'] = $_REQUEST['sidebar'];
	}
	
	if (isset($_REQUEST['cols'])){
		$theme_options['woocommerce-products-cols'] = $_REQUEST['cols'];
		$theme_options['blog-masonry-cols'] = $_REQUEST['cols'];
	}

	if (isset($_REQUEST['style'])){
		$theme_options['blog-style'] = $_REQUEST['style'];
	}

	if (isset($_REQUEST['blog-images'])){
		$theme_options['blog-images-size'] = $_REQUEST['blog-images'];
	}


endif;
?>