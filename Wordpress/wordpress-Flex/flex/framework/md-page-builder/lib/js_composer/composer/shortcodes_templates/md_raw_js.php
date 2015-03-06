<?php

extract(shortcode_atts(array(
), $atts));

$content =  rawurldecode(base64_decode(strip_tags($content)));

$output = '<script type="text/javascript">'.$content.'</script>';

echo $output;