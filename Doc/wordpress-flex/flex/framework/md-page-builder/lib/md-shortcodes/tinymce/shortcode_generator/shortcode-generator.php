<?php

/*-----------------------------------------------------------------------------------*/
/*	Shortcode Generator
/*-----------------------------------------------------------------------------------*/
require_once( 'access-wp.php' );
require_once( 'option-element.php' );

global $md_shortcodes;

$shortcode_list = '<div id="shortcode-list">';
		$shortcode_list .= '<ul id="md-shortcodes">';
		foreach( $md_shortcodes as $shortcode){
			if($shortcode['modal'])
			$shortcode_list .= '<li><a href="#" data-shortcode="'.$shortcode['base'].'"">'.$shortcode['name'].'</a></li>';
		}
		$shortcode_list .= '</ul>';
$shortcode_list .= '</div>';



$shortcode_html = '';
foreach( $md_shortcodes as $shortcode){
	if($shortcode['modal']){
		$shortcode_html .= '<div class="shortcode-options" id="options-'.$shortcode['base'].'" data-name="'.$shortcode['base'].'">';

		if(isset($shortcode['params'])){
			foreach( $shortcode['params'] as $field ){
				if(!isset($field['disable_modal']))
				$shortcode_html .= md_option_element( $shortcode['base'], $field );
			}
		}

		$shortcode_html .= '</div>';
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<title></title>
<link rel="stylesheet" href="<?php echo MD_SHORTCODES_URI; ?>/tinymce/shortcode_generator/css/tinymce.css" />
<script src="<?php echo MD_SHORTCODES_URI; ?>/tinymce/shortcode_generator/js/popup.js"></script>
</head>
<body>	
	<div id="shortcode-generator">
		
		<div id="shortcode-container">
			<div id="shortcode-side">
				<?php echo $shortcode_list;  ?>
			</div>

			<div id="shortcode-content">
				<?php echo $shortcode_html;  ?>
			</div>
		</div>
		<code class="shortcode_storage"><span id="shortcode-storage-o" style=""></span><span id="shortcode-storage-d"></span><span id="shortcode-storage-c" style=""></span></code>
		
		<div id="shortcode-bottom">
			<a id="add-shortcode"><i class="icon-ok"></i></a>
		</div>
	</div>
</body>
</html>