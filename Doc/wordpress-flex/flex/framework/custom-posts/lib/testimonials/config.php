<?php

/*
*	
*	CUSTOM POST TYPE: TESTIMONIALS
*
*
*/

add_action('init', 'testimonials_register');
function testimonials_register(){
	$labels = array(
		'name' 					=> __('Testimonials', MD_THEME_NAME),
		'singular_name' 		=> __('Testimonial', MD_THEME_NAME),
		'menu_name'          	=> __('Testimonials', MD_THEME_NAME),
		'all_items'          	=> __('All Testimonials', MD_THEME_NAME),
		'add_new' 				=> __('Add New Testimonial', MD_THEME_NAME),
		'add_new_item' 			=> __('Add New Testimonial', MD_THEME_NAME),
		'edit_item' 			=> __('Edit Testimonial', MD_THEME_NAME),
		'new_item'				=> __('New Testimonial', MD_THEME_NAME),
		'view_item'				=> __('View Testimonial', MD_THEME_NAME),
		'search_items' 			=> __('Search Testimonial', MD_THEME_NAME),
		'not_found' 			=> __('No Testimonial Found', MD_THEME_NAME),
		'not_found_in_trash' 	=> __('No Testimonial Found in Trash', MD_THEME_NAME),
		'parent_item_colon' 	=> __('Parent', MD_THEME_NAME),
	);

	$args = array(
		'labels'              	=> $labels,
		'public'             	=> true,
		'supports'            	=> array( 'title', 'thumbnail'),
		'menu_icon'				=> 'dashicons-testimonial',
		'exclude_from_search'	=> true
	);
	register_post_type( 'testimonials', $args );
}


register_taxonomy('testimonials-categories', 'testimonials', array(
	'hierarchical' 			=> true,
	'query_var' 			=> true,
	'show_admin_column'		=> true,
	'labels' 				=> array(
		'name' 				=> __('Testimonials Categories', MD_THEME_NAME),
		'singular_name' 	=> __('Category', MD_THEME_NAME),
		'search_items'		=> __('Search Categories', MD_THEME_NAME),
		'all_items' 		=> __('All Categories', MD_THEME_NAME),
		'parent_item' 		=> __('Parent Category', MD_THEME_NAME),
		'parent_item_colon' => __('Parent Category:', MD_THEME_NAME),
		'edit_item' 		=> __('Edit Category', MD_THEME_NAME),
		'update_item' 		=> __('Update Category', MD_THEME_NAME),
		'add_new_item' 		=> __('Add New Category', MD_THEME_NAME),
		'new_item_name' 	=> __('New Category Name', MD_THEME_NAME),
		'menu_name' 		=> __('Categories', MD_THEME_NAME)
	),
));


if(isset($_REQUEST['post_type']) && $_REQUEST['post_type'] == 'testimonials' ):
	add_filter('manage_posts_columns', 'testimonials_columns', 5);  
	add_action('manage_posts_custom_column', 'testimonials_columns_thumb', 5, 2);  
	  
	function testimonials_columns($defaults){  
	    $defaults['testimonials_thumb'] = __('Thumb');  
	    return $defaults;  
	}  
	  
	function testimonials_columns_thumb($column_name, $id){  
	    if($column_name === 'testimonials_thumb'){  
	        echo the_post_thumbnail( 'thumb' );  
	    }  
	}
endif;






function testimonials_metabox(){

	global $md_metabox;

	$fields = array(
		array(
			'name'  => 'testimonial_cite_text',
			'label' => 'Text',
			'type'  => 'textarea'
		),
		array(
			'name'  => 'testimonial_cite_name',
			'label' => 'Author',
			'type'  => 'textfield'
		),
		array(
			'name'  => 'testimonial_company',
			'label' => 'Author Company',
			'type'  => 'textfield'
		),
		array(
			'name'  => 'testimonial_company_url',
			'label' => 'Company URL',
			'type'  => 'textfield'
		),
	);

	$md_metabox['testimonials']['order'] 	= 1;
	$md_metabox['testimonials']['id']		= 'meta-testimonials';
	$md_metabox['testimonials']['title'] 	= 'Testimonial Options';
	$md_metabox['testimonials']['icon'] 	= 'group';
	$md_metabox['testimonials']['class'] 	= 'blocked disable-others';
	$md_metabox['testimonials']['fields'] 	= $fields;
}

if(isset($_REQUEST['post_type']) && $_REQUEST['post_type'] == 'testimonials' ):

	testimonials_metabox();

elseif (isset($_GET['post']) || isset($_POST['post_ID'])):
	$post_id = isset($_GET['post']) ? $_GET['post'] : $_POST['post_ID'];

	if('testimonials' == get_post_type($post_id)):
	
		testimonials_metabox();
	
	endif;

endif;


?>