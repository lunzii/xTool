<?php

/*
*	
*	PAGE GENERAL METABOX
*
*/

global $theme_options;
global $md_metabox;


$fields = array(
	/*
	array(
		'name'  => 'page-loading-enabled',
		'label' => __('Loading', MD_THEME_NAME),
		'type'  => 'dropdown',
		'options' => array(
			array(
				'label' => 'No',
				'value' => 'false'
			),
			array(
				'label' => 'Yes',
				'value' => 'true'
			),
		),
	),
	*/
	array(
		'name'  => 'force-boxed',
		'label' => __('Force Layout Boxed', MD_THEME_NAME),
		'type'  => 'dropdown',
		'options' => array(
			array(
				'label' => 'No',
				'value' => 'false'
			),
			array(
				'label' => 'Yes',
				'value' => 'true'
			),
		),
		'desc' => 'Force Boxed Layout in this page',
	),

	array(
		'name'  => 'page-bgimage',
		'label' => __('Page Background Image', MD_THEME_NAME),
		'type'  => 'upload',
		'media' => 'image',
		'desc' => 'Force Background Image in this page',
	),

	array(
		'name'  => 'page-bgcolor',
		'label' => __('Page Background Color', MD_THEME_NAME),
		'type'  => 'colorpicker',
		'default' => $theme_options['body-bgcolor']
	),

	array(
		'name'  => 'show-header',
		'label' => __('Header', MD_THEME_NAME),
		'type'  => 'dropdown',
		'options' => array(
			array(
				'label' => 'Yes',
				'value' => 'true'
			),
			array(
				'label' => 'No',
				'value' => 'false'
			),
		),
		'desc' => 'Enable/Disable Header in this page',
	),

	array(
		'name'  => 'page-sidebar',
		'label' => __('Sidebar', MD_THEME_NAME),
		'type'  => 'dropdown',
		'options' => array(
			array(
				'label' => 'No',
				'value' => 'no'
			),
			array(
				'label' => 'Left',
				'value' => 'left'
			),
			array(
				'label' => 'Right',
				'value' => 'right'
			),
		),
		'class' => 'hide-post'
	),
	array(
		'name'  => 'page-centered',
		'label' => __('Page Centered*', MD_THEME_NAME),
		'type'  => 'dropdown',
		'options' => array(
			array(
				'label' => 'No',
				'value' => 'false'
			),
			array(
				'label' => 'Yes',
				'value' => 'true'
			),
		),
		'desc' => '*NOTICE: Set Sidebar to No',
		'class' => 'hide-post'
	),
	array(
		'name'  => 'show-footer',
		'label' => __('Footer', MD_THEME_NAME),
		'type'  => 'dropdown',
		'options' => array(
			array(
				'label' => 'Yes',
				'value' => 'true'
			),
			array(
				'label' => 'No',
				'value' => 'false'
			),
		),
		'desc' => 'Enable/Disable Footer in this page',
	),
);

$md_metabox['general']['order'] 	= 2;
$md_metabox['general']['title'] 	= 'General Settings';
$md_metabox['general']['id'] 		= 'meta-page-general';
$md_metabox['general']['icon'] 		= 'magic';
$md_metabox['general']['class'] 	= 'blocked';
$md_metabox['general']['fields'] 	= $fields;
