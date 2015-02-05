<?php

/*
*	
*	CUSTOM POST TYPE: CLIENTS
*
*
*/

add_action('init', 'clients_register');
function clients_register(){
	$labels = array(
		'name' 					=> __('Clients', MD_THEME_NAME),
		'singular_name' 		=> __('Client', MD_THEME_NAME),
		'menu_name'          	=> __('Clients', MD_THEME_NAME),
		'all_items'          	=> __('All Clients', MD_THEME_NAME),
		'add_new' 				=> __('Add New Client', MD_THEME_NAME),
		'add_new_item' 			=> __('Add New Client', MD_THEME_NAME),
		'edit_item' 			=> __('Edit Client', MD_THEME_NAME),
		'new_item'				=> __('New Client', MD_THEME_NAME),
		'view_item'				=> __('View Client', MD_THEME_NAME),
		'search_items' 			=> __('Search Client', MD_THEME_NAME),
		'not_found' 			=> __('No Client Found', MD_THEME_NAME),
		'not_found_in_trash' 	=> __('No Client Found in Trash', MD_THEME_NAME),
		'parent_item_colon' 	=> __('Parent', MD_THEME_NAME),
	);

	$args = array(
		'labels'              	=> $labels,
		'public'             	=> true,
		'supports'            	=> array( 'title', 'thumbnail'),
		'menu_icon'				=> 'dashicons-businessman',
		'exclude_from_search'	=> true
	);
	register_post_type( 'clients', $args );
}



register_taxonomy('clients-categories', 'clients', array(
	'hierarchical' 			=> true,
	'query_var' 			=> true,
	'show_admin_column'		=> true,
	'labels' 				=> array(
		'name' 				=> __('Clients Categories', MD_THEME_NAME),
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




if(isset($_REQUEST['post_type']) && $_REQUEST['post_type'] == 'clients' ):
	add_filter('manage_posts_columns', 'clients_columns', 5);  
	add_action('manage_posts_custom_column', 'clients_columns_thumb', 5, 2);  
	  
	function clients_columns($defaults){  
	    $defaults['clients_thumb'] = __('Thumb');  
	    return $defaults;  
	}  
	  
	function clients_columns_thumb($column_name, $id){  
	    if($column_name === 'clients_thumb'){  
	        echo the_post_thumbnail( 'thumb' );  
	    }  
	}
endif;




function clients_metabox(){

	global $md_metabox;

	$fields = array(
		array(
			'name'  => 'client_url',
			'label' => 'URL',
			'type'  => 'textfield'
		)
	);

	$md_metabox['clients']['order'] 	= 1;
	$md_metabox['clients']['id']		= 'meta-clients';
	$md_metabox['clients']['title'] 	= 'Client Options';
	$md_metabox['clients']['icon'] 		= 'group';
	$md_metabox['clients']['class'] 	= 'blocked disable-others';
	$md_metabox['clients']['fields'] 	= $fields;
}

if(isset($_REQUEST['post_type']) && $_REQUEST['post_type'] == 'clients' ):

	clients_metabox();

elseif (isset($_GET['post']) || isset($_POST['post_ID'])):
	$post_id = isset($_GET['post']) ? $_GET['post'] : $_POST['post_ID'];

	if('clients' == get_post_type($post_id)):
	
		clients_metabox();
	
	endif;

endif;



?>