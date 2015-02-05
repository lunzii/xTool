<?php

extract(shortcode_atts(array(
), $atts));


$content =  rawurldecode(base64_decode(strip_tags($content)));

$output = $content;

echo do_shortcode($output);