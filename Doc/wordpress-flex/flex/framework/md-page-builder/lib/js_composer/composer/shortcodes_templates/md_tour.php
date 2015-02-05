<?php

extract(shortcode_atts(array(
	'title' => ''
), $atts));

$uid = uniqid();

if($GLOBALS['tabs'] == 'nav'){
	$output = '<li><a href="#'.$uid.'" data-toggle="tab">'.$title.'</a></li>';
}

else{
	$output = '<div class="tab-pane">'.wpb_js_remove_wpautop(nl2br($content), true).'</div>';
}

echo $output;