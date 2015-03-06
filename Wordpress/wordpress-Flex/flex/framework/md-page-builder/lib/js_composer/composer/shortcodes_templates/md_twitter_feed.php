<?php

extract(shortcode_atts(array(
    'class' 		=> '',
    'id' 			=> '',
    'css_animation' => '',
    'css_animation_delay' => '',
    'carousel' 		=> '',
    'color' 		=> '',
    'user' 			=> '',
    'tweets' 		=> ''
), $atts));

$animated = ($css_animation) ? 'animate' : '';
$css_animation_delay = ($css_animation) ? ' data-delay="'.$css_animation_delay.'"' : '';

$class  = setClass(array('md-tweets', 'md-carousel', $animated, $css_animation, $class, $carousel));
$id 	= setId($id);

$output .= '<div'.$class.$id.$css_animation_delay.' data-items="1" data-items-tablet="1" data-items-mobile="1" data-autoplay="1" data-pagination="1">';
$tweets = getTweets($user, $tweets);
	foreach($tweets as $tweet):
	  $output .= '
	  		<div class="md-tweet" style="color:'.$color.'">
                <div class="tweet-content">
                    <div class="tweet-text">' . TwitterFilter($tweet['text']) . '</div>
                </div>
                <div class="tweet-info">
                    <span class="tweet-time"><a href="'.'https://twitter.com/' . $user . '/status/' . $tweet['id_str'] . '" target="_blank">' . date('j F o \a\t g:i A', strtotime($tweet['created_at'])) . '</a></span>
                </div>
			</div>';
	endforeach;
$output .= '</div>';

$output .= '<style type="text/css">.md-tweet a{color:'.$color.';}</style>';

echo $output;