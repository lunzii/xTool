<?php

extract(shortcode_atts(array(
), $atts));

$content =  rawurldecode(base64_decode(strip_tags($content)));

$output = '<style type="text/css">'.$content.'</style>';

echo $output;