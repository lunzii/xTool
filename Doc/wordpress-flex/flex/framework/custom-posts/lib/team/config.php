<?php

/*
*	
*	CUSTOM POST TYPE: TEAM
*
*
*/

add_action('init', 'team_register');
function team_register(){
	$labels = array(
		'name' 					=> __('Team', MD_THEME_NAME),
		'singular_name' 		=> __('Member', MD_THEME_NAME),
		'menu_name'          	=> __('Team', MD_THEME_NAME),
		'all_items'          	=> __('All Members', MD_THEME_NAME),
		'add_new' 				=> __('Add New Member', MD_THEME_NAME),
		'add_new_item' 			=> __('Add New Member', MD_THEME_NAME),
		'edit_item' 			=> __('Edit Member', MD_THEME_NAME),
		'new_item'				=> __('New Member', MD_THEME_NAME),
		'view_item'				=> __('View Member', MD_THEME_NAME),
		'search_items' 			=> __('Search Member', MD_THEME_NAME),
		'not_found' 			=> __('No Member Found', MD_THEME_NAME),
		'not_found_in_trash' 	=> __('No Member Found in Trash', MD_THEME_NAME),
		'parent_item_colon' 	=> __('Parent', MD_THEME_NAME),
	);

	$args = array(
		'labels'              	=> $labels,
		'public'             	=> true,
		'supports'            	=> array( 'title', 'thumbnail', 'editor'),
		'menu_icon'				=> 'dashicons-groups',
		'exclude_from_search'	=> true
	);
	register_post_type( 'team', $args );
}


register_taxonomy('team-categories', 'team', array(
	'hierarchical' 			=> true,
	'query_var' 			=> true,
	'show_admin_column'		=> true,
	'labels' 				=> array(
		'name' 				=> __('Team Categories', MD_THEME_NAME),
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


if(isset($_REQUEST['post_type']) && $_REQUEST['post_type'] == 'team' ):
	add_filter('manage_posts_columns', 'team_columns', 5);  
	add_action('manage_posts_custom_column', 'team_columns_thumb', 5, 2);  
	  
	function team_columns($defaults){  
	    $defaults['team_thumb'] = __('Thumb');  
	    return $defaults;  
	}  
	  
	function team_columns_thumb($column_name, $id){  
	    if($column_name === 'team_thumb'){  
	        echo the_post_thumbnail( 'thumb' );  
	    }  
	}
endif;






function team_metabox(){

	global $md_metabox;

	md_disable_metabox(array('meta-page-header'));

	$fields = array(
		array(
			'name'  => 'member_link',
			'label' => 'Link to profile',
			'type'  => 'toggle'
		),
		array(
			'name'  => 'member_presentation',
			'label' => 'Presentation',
			'type'  => 'textarea'
		),
		array(
			'name'  => 'member_role',
			'label' => 'Role',
			'type'  => 'textfield'
		),
		array(
			'name'  => 'member_social_email',
			'label' => 'Email',
			'type'  => 'textfield'
		),
		array(
			'name'  => 'member_social_facebook',
			'label' => 'Facebook',
			'type'  => 'textfield'
		),
		array(
			'name'  => 'member_social_twitter',
			'label' => 'Twitter',
			'type'  => 'textfield'
		),
		array(
			'name'  => 'member_social_google_plus',
			'label' => 'Google Plus',
			'type'  => 'textfield'
		),
		array(
			'name'  => 'member_social_youtube',
			'label' => 'Youtube',
			'type'  => 'textfield'
		),
		array(
			'name'  => 'member_social_linkedin',
			'label' => 'Linkedin',
			'type'  => 'textfield'
		),
		array(
			'name'  => 'member_social_pinterest',
			'label' => 'Pinterest',
			'type'  => 'textfield'
		),
		array(
			'name'  => 'member_social_flickr',
			'label' => 'Flickr',
			'type'  => 'textfield'
		),
		array(
			'name'  => 'member_social_instagram',
			'label' => 'Instagram',
			'type'  => 'textfield'
		),
		array(
			'name'  => 'member_social_tumblr',
			'label' => 'Tumblr',
			'type'  => 'textfield'
		),
		array(
			'name'  => 'member_social_dribbble',
			'label' => 'Dribbble',
			'type'  => 'textfield'
		),
		array(
			'name'  => 'member_social_apple',
			'label' => 'Apple',
			'type'  => 'textfield'
		),
		array(
			'name'  => 'member_social_android',
			'label' => 'Android',
			'type'  => 'textfield'
		),
	);

	$md_metabox['team']['order'] 	= 1;
	$md_metabox['team']['id']		= 'meta-team';
	$md_metabox['team']['title'] 	= 'Member Options';
	$md_metabox['team']['icon'] 	= 'group';
	$md_metabox['team']['class'] 	= 'blocked';
	$md_metabox['team']['fields'] 	= $fields;
}

if(isset($_REQUEST['post_type']) && $_REQUEST['post_type'] == 'team' ):

	team_metabox();

elseif (isset($_GET['post']) || isset($_POST['post_ID'])):
	$post_id = isset($_GET['post']) ? $_GET['post'] : $_POST['post_ID'];

	if('team' == get_post_type($post_id)):
	
		team_metabox();
	
	endif;

endif;


?>