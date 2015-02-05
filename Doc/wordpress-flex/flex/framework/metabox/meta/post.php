<?php

/*
*	
*	POST METABOX
*
*/



global $md_metabox;


$fields = array(
	array(
		'name'  => 'post-quote-author',
		'label' => __('Quote Author', MD_THEME_NAME),
		'desc'	=> __('Insert the author of your quote.', MD_THEME_NAME),
		'type'  => 'textfield',
	)
);

$md_metabox['post-quote']['order'] 	= 5;
$md_metabox['post-quote']['id']		= 'meta-post-quote';
$md_metabox['post-quote']['title'] 	= 'Quote Options';
$md_metabox['post-quote']['class'] 	= 'md-post-format md-post-quote';
$md_metabox['post-quote']['icon']  	= 'quote-left';
$md_metabox['post-quote']['fields'] = $fields;



$fields = array(
	array(
		'name' 	=> "post-video-source",
		'label' => __('Video Source', MD_THEME_NAME),
		'type'  => 'dropdown',
		'options' => array(
			array(
				'label' => 'Self Hosted',
				'value' => 'self'
			),
			array(
				'label' => 'Youtube',
				'value' => 'youtube'
			),
			array(
				'label' => 'Vimeo',
				'value' => 'vimeo'
			)
		)
	),
	array(
		'name'  => 'post-video-poster',
		'label' => __('Video Poster', MD_THEME_NAME),
		'desc'	=> __('Select Poster video.', MD_THEME_NAME),
		'type'  => 'upload',
		'media' => 'image'
	),
	array(
		'name'  => 'post-video-mp4',
		'label' => __('Video MP4', MD_THEME_NAME),
		'desc'	=> __('Select MP4 video.', MD_THEME_NAME),
		'type'  => 'upload',
		'media' => 'video'
	),
	array(
		'name'  => 'post-video-webm',
		'label' => __('Video WEBM', MD_THEME_NAME),
		'desc'	=> __('Select WEBM video.', MD_THEME_NAME),
		'type'  => 'upload',
		'media' => 'video'
	),
	array(
		'name'  => 'post-video-ogv',
		'label' => __('Video OGV', MD_THEME_NAME),
		'desc'	=> __('Select OGV video.', MD_THEME_NAME),
		'type'  => 'upload',
		'media' => 'video'
	),

	array(
		'name'  => 'post-video-youtube',
		'label' => __('Video Youtube', MD_THEME_NAME),
		'desc'	=> __('Set Video ID (eg.: 4Wkr0eXiUNw).', MD_THEME_NAME),
		'type'  => 'textfield',
	),

	array(
		'name'  => 'post-video-vimeo',
		'label' => __('Video Vimeo', MD_THEME_NAME),
		'desc'	=> __('Set Video Vimeo ( eg.: 7449107).', MD_THEME_NAME),
		'type'  => 'textfield',
	),
);

$md_metabox['post-video']['order'] 	= 5;
$md_metabox['post-video']['id']		= 'meta-post-video';
$md_metabox['post-video']['title'] 	= 'Video Options';
$md_metabox['post-video']['class'] 	= 'md-post-format md-post-video';
$md_metabox['post-video']['icon']  	= 'facetime-video';
$md_metabox['post-video']['fields'] = $fields;



$fields = array(
	array(
		'name'  => 'post-audio-mp3',
		'label' => __('Audio Url', MD_THEME_NAME),
		'desc'	=> __('Pick your MP3.', MD_THEME_NAME),
		'type'  => 'upload',
		'media' => 'audio'
	)
);

$md_metabox['post-audio']['order'] 	= 5;
$md_metabox['post-audio']['id']		= 'meta-post-audio';
$md_metabox['post-audio']['title'] 	= 'Audio Options';
$md_metabox['post-audio']['class'] 	= 'md-post-format md-post-audio';
$md_metabox['post-audio']['icon']  	= 'music';
$md_metabox['post-audio']['fields'] = $fields;



$fields = array(
	array(
		'name'  => 'post-gallery',
		'label' => __('Gallery', MD_THEME_NAME),
		'desc'	=> __('Select your galery.', MD_THEME_NAME),
		'type'  => 'gallery',
	),
	array(
		'name'  => 'post-gallery-animation',
		'label' => __('Slider Animation', MD_THEME_NAME),
		'type'  => 'dropdown',
		'options' => array(
			array(
				'label' => 'Fade',
				'value' => 'fade'
			),
			array(
				'label' => 'Slide',
				'value' => 'slide'
			),
		)
	),
	array(
		'name'  => 'post-gallery-navigation',
		'label' => __('Slider Navigation', MD_THEME_NAME),
		'type'  => 'dropdown',
		'options' => array(
			array(
				'label' => 'Yes',
				'value' => 'true'
			),
			array(
				'label' => 'False',
				'value' => 'false'
			),
		)
	),
	array(
		'name'  => 'post-gallery-pagination',
		'label' => __('Slider Pagination', MD_THEME_NAME),
		'type'  => 'dropdown',
		'options' => array(
			array(
				'label' => 'Yes',
				'value' => 'true'
			),
			array(
				'label' => 'False',
				'value' => 'false'
			),
		)
	),

);

$md_metabox['post-gallery']['order'] 	= 5;
$md_metabox['post-gallery']['id']		= 'meta-post-gallery';
$md_metabox['post-gallery']['title'] 	= 'Gallery Options';
$md_metabox['post-gallery']['class'] 	= 'md-post-format md-post-gallery';
$md_metabox['post-gallery']['icon']		= 'picture';
$md_metabox['post-gallery']['fields'] 	= $fields;


$fields = array(
	array(
		'name'  => 'post-link-url',
		'label' => __('Link Url', MD_THEME_NAME),
		'desc'	=> __('Insert the url for your link.', MD_THEME_NAME),
		'type'  => 'textfield',
	),
	array(
		'name'  => 'post-link-label',
		'label' => __('Link Label', MD_THEME_NAME),
		'desc'	=> __('Insert the label for your link.', MD_THEME_NAME),
		'type'  => 'textfield',
	),
	array(
		'name'  => 'post-link-target',
		'label' => __('Link Target', MD_THEME_NAME),
		'desc' 	=> __("Set the target of the link.", MD_THEME_NAME),
		'type'  => 'dropdown',
		'options' => array(
			array(
				'label' => 'New Page',
				'value' => '_blank'
			),
			array(
				'label' => 'Same Page',
				'value' => '_self'
			),
		)
	),
);

$md_metabox['post-link']['order'] 	= 5;
$md_metabox['post-link']['id']		= 'meta-post-link';
$md_metabox['post-link']['title'] 	= 'Link Options';
$md_metabox['post-link']['class'] 	= 'md-post-format md-post-link';
$md_metabox['post-link']['icon']  	= 'link';
$md_metabox['post-link']['fields'] 	= $fields;

