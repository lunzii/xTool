<?php

extract(shortcode_atts(array(
	'title' => ''
), $atts));

$uid = 'tab_'.uniqid();

$bg_tab = (isset($GLOBALS['tog_bg'])) ? ' style="background-color:'.$GLOBALS['tog_bg'].';"' : '';

$output = '<div class="panel">';

$output .= '<div class="panel-heading">';
$output .= '<h4 class="panel-title">';
$output .= '<a data-toggle="collapse" href="#'.$uid.'" class="collapsed"'.$bg_tab.'>'.$title.'</a>';
$output .= '</h4>';
$output .= '</div>';

$output .= '<div id="'.$uid.'" class="panel-collapse collapse">';
$output .= '<div class="panel-body">'.wpb_js_remove_wpautop(nl2br($content), true).'</div>';
$output .= '</div>';

$output .= '</div>';

echo $output;