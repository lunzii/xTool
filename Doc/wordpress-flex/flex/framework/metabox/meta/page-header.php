<?php

/*
*	
*	PAGE HEADER METABOX
*
*/

global $theme_options;
global $md_metabox;


$fields = array(
	array(
		'name'  => 'page-header-enabled',
		'label' => __('Page Header', MD_THEME_NAME),
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
		'default' => $theme_options['page-header-enabled']
	),
	array(
		'name' 	=> "page-header-class",
		'label' => __('Page Header Class', MD_THEME_NAME),
		'desc' 	=> __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", MD_THEME_NAME),
		'type'  => 'textfield'
	),
	array(
		'name' 	=> "page-header-padding",
		'label' => __('Page Header Padding ', MD_THEME_NAME),
		'type'  => 'dropdown',
		'options' => array(
			array(
				'label' => 'Small',
				'value' => 'padding-small'
			),
			array(
				'label' => 'Medium',
				'value' => 'padding-medium'
			),
			array(
				'label' => 'Large',
				'value' => 'padding-large'
			)
		),
		'default' => $theme_options['page-header-padding']
	),
	array(
		'name'  => 'page-header-title',
		'label' => __('Page Header Title', MD_THEME_NAME),
		'desc'	=> __('Default is the page title.', MD_THEME_NAME),
		'type'  => 'textfield'
	),
	array(
		'name'  => 'page-header-title-color',
		'label' => __('Page Header Title Color', MD_THEME_NAME),
		'type'  => 'colorpicker',
		'default' => $theme_options['page-header-title']['color']
	),
	array(
		'name'  => 'page-header-title-animation',
		'label' => __('Page Header Title Animation', MD_THEME_NAME),
		'type'  => 'animations',
		'default' => $theme_options['page-header-title-animation']
	),
	array(
		'name'  => 'page-header-subtitle',
		'label' => __('Page Header Subtitle', MD_THEME_NAME),
		'type'  => 'textfield'
	),
	array(
		'name'  => 'page-header-subtitle-animation',
		'label' => __('Page Header Subtitle Animation', MD_THEME_NAME),
		'type'  => 'animations',
		'default' => $theme_options['page-header-subtitle-animation']
	),
	array(
		'name'  => 'page-header-subtitle-color',
		'label' => __('Page Header Subtitle Color', MD_THEME_NAME),
		'type'  => 'colorpicker',
		'default' => $theme_options['page-header-subtitle']['color']
	),
	array(
		'name'  => 'page-header-align',
		'label' => __('Page Header Text Align', MD_THEME_NAME),
		'type'  => 'dropdown',
		'options' => array(
			array(
				'label' => 'Left',
				'value' => 'textalignleft'
			),
			array(
				'label' => 'Center',
				'value' => 'textaligncenter'
			),
			array(
				'label' => 'Right',
				'value' => 'textalignright'
			),
		),
		'default' => $theme_options['page-header-align']
	),
	array(
		'name'  => 'page-header-bgcolor',
		'label' => __('Page Header Background Color', MD_THEME_NAME),
		'type'  => 'colorpicker',
		'default' => $theme_options['page-header-bgcolor']
	),
	array(
		'name'  => 'page-header-bgimage-type',
		'label' => __('Page Header Background Image Type', MD_THEME_NAME),
		'type'  => 'dropdown',
		'options' => array(
			array(
				'label' => 'Full Image',
				'value' => 'full-image'
			),
			array(
				'label' => 'Pattern',
				'value' => 'pattern'
			),
		),
		'default' => $theme_options['page-header-bgimage-type']
	),
	array(
		'name'  => 'page-header-bgimage',
		'label' => __('Page Header Background Image', MD_THEME_NAME),
		'type'  => 'upload',
		'media' => 'image'
	),
	array(
		'name'  => 'page-header-bgimage-attach',
		'label' => __('Page Header Background Image Attachment', MD_THEME_NAME),
		'type'  => 'dropdown',
		'options' => array(
			array(
				'label' => 'Parallax',
				'value' => 'bg-parallax'
			),
			array(
				'label' => 'Fixed',
				'value' => 'bg-fixed'
			),
			array(
				'label' => 'Static',
				'value' => 'bg-static'
			),
		),
		'default' => $theme_options['page-header-bgimage-attach']
	),

	array(
		'name'  => 'page-header-mask',
		'label' => __('Page Header Mask', MD_THEME_NAME),
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
		'default' => $theme_options['page-header-mask']
	),
	array(
		'name'  => 'page-header-mask-bgcolor',
		'label' => __('Page Header Mask Background Color', MD_THEME_NAME),
		'type'  => 'colorpicker',
		'default' => $theme_options['page-header-mask-bgcolor']
	),
	array(
		'name'  => 'page-header-mask-bgimage',
		'label' => __('Page Header Mask Background Image', MD_THEME_NAME),
		'type'  => 'upload',
		'media' => 'image'
	),
	array(
		'name'  => 'page-header-mask-opacity',
		'label' => __('Page Header Mask Opacity', MD_THEME_NAME),
		'type'  => 'dropdown',
		'options' => array(
			array(
				'label' => '90%',
				'value' => '0.9'
			),
			array(
				'label' => '80%',
				'value' => '0.8'
			),
			array(
				'label' => '70%',
				'value' => '0.7'
			),
			array(
				'label' => '60%',
				'value' => '0.6'
			),
			array(
				'label' => '50%',
				'value' => '0.5'
			),
			array(
				'label' => '40%',
				'value' => '0.4'
			),
			array(
				'label' => '30%',
				'value' => '0.3'
			),
			array(
				'label' => '20%',
				'value' => '0.2'
			),
			array(
				'label' => '10%',
				'value' => '0.1'
			),
			array(
				'label' => '0%',
				'value' => '0.0'
			),
		),
		'default' => $theme_options['page-header-mask-opacity']
	),
);

$md_metabox['header']['order'] 	= 1;
$md_metabox['header']['title'] 	= 'Page Header';
$md_metabox['header']['id'] 	= 'meta-page-header';
$md_metabox['header']['icon'] 	= 'magic';
$md_metabox['header']['class'] 	= 'blocked';
$md_metabox['header']['fields'] = $fields;
