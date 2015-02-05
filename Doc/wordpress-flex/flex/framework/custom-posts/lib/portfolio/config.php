<?php

/*
*	
*	CUSTOM POST TYPE: PORTFOLIO
*
*
*/

add_action('init', 'portfolio_register');
function portfolio_register(){
	$labels = array(
		'name' 					=> __('Portfolio', MD_THEME_NAME),
		'singular_name' 		=> __('Work', MD_THEME_NAME),
		'menu_name'          	=> __('Portfolio', MD_THEME_NAME),
		'all_items'          	=> __('All Works', MD_THEME_NAME),
		'add_new' 				=> __('Add New Work', MD_THEME_NAME),
		'add_new_item' 			=> __('Add New Work', MD_THEME_NAME),
		'edit_item' 			=> __('Edit Work', MD_THEME_NAME),
		'new_item'				=> __('New Work', MD_THEME_NAME),
		'view_item'				=> __('View Work', MD_THEME_NAME),
		'search_items' 			=> __('Search Work', MD_THEME_NAME),
		'not_found' 			=> __('No Work Found', MD_THEME_NAME),
		'not_found_in_trash' 	=> __('No Work Found in Trash', MD_THEME_NAME),
		'parent_item_colon' 	=> __('Parent', MD_THEME_NAME),
	);

	$args = array(
		'labels'              	=> $labels,
		'public'             	=> true,
		'supports'            	=> array( 'title', 'thumbnail', 'editor'),
		'menu_icon'				=> 'dashicons-portfolio',
		'exclude_from_search'	=> true
	);
	register_post_type( 'portfolio', $args );
}


register_taxonomy('portfolio-categories', 'portfolio', array(
	'hierarchical' 			=> true,
	'query_var' 			=> true,
	'show_admin_column'		=> true,
	'labels' 				=> array(
		'name' 				=> __('Portfolio Categories', MD_THEME_NAME),
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


if(isset($_REQUEST['post_type']) && $_REQUEST['post_type'] == 'portfolio' ):
	add_filter('manage_posts_columns', 'portfolio_columns', 5);  
	add_action('manage_posts_custom_column', 'portfolio_columns_thumb', 5, 2);  
	  
	function portfolio_columns($defaults){  
	    $defaults['portfolio_thumb'] = __('Thumb');  
	    return $defaults;  
	}  
	  
	function portfolio_columns_thumb($column_name, $id){  
	    if($column_name === 'portfolio_thumb'){  
	        echo the_post_thumbnail( 'thumb' );  
	    }  
	}
endif;





function portfolio_metabox(){
	global $md_metabox;


	$fields = array(
		array(
			'name'  => 'work_masonry_size',
			'label' => 'Masonry Preview Size',
			'type'  => 'dropdown',
			'options' => array(
				array(
					'label' => 'Square',
					'value' => 'square'
				),
				array(
					'label' => 'Square Big',
					'value' => 'square-big'
				),
				array(
					'label' => 'Wide',
					'value' => 'wide'
				),
				array(
					'label' => 'Tall',
					'value' => 'tall'
				)
			)
		),

	);

	$md_metabox['portfolio']['order'] 	= 1;
	$md_metabox['portfolio']['id']		= 'meta-portfolio';
	$md_metabox['portfolio']['title'] 	= 'Portfolio Options';
	$md_metabox['portfolio']['icon'] 	= 'group';
	$md_metabox['portfolio']['class'] 	= 'blocked';
	$md_metabox['portfolio']['fields'] 	= $fields;
}

if(isset($_REQUEST['post_type']) && $_REQUEST['post_type'] == 'portfolio' ):

	portfolio_metabox();

elseif (isset($_GET['post']) || isset($_POST['post_ID'])):
	$post_id = isset($_GET['post']) ? $_GET['post'] : $_POST['post_ID'];

	if('portfolio' == get_post_type($post_id)):
	
		portfolio_metabox();
	
	endif;

endif;

?>