<?php
/**
 *
 * MD Shortcodes Twitter Feed
 *
 */


global $theme_options;

$md_shortcodes['md_twitter_feed'] = array(
  "name"            => __("Twitter Feed", "js_composer"),
  "base"            => "md_twitter_feed",
  "modal"           => true,
  "params"          => array(
    array(
      "type"        => "textfield",
      "heading"     => __("Username", "js_composer"),
      "param_name"  => "user",
      "value"       => "",
      "description" => __("Set the name of the account Twitter.", "js_composer")
    ),
    array(
      "type"        => "textfield",
      "heading"     => __("Tweets", "js_composer"),
      "param_name"  => "tweets",
      "value"       => "3",
      "description" => __("Set the number of tweets to display.", "js_composer")
    ),
    array(
      "type"        => "colorpicker",
      "heading"     => __("Text Color", "js_composer"),
      "param_name"  => "color",
      "value"       => $theme_options['font-body']['color']
    ),
    $element_options['class'],
    $element_options['id'],
    $element_options['css_animation'],
    $element_options['css_animation_delay'],
  )
);


vc_map( $md_shortcodes['md_twitter_feed'] );

class WPBakeryShortCode_MD_Twitter_Feed extends WPBakeryShortCode {}

// Twitter Filter
function TwitterFilter($string)
{
  $content_array = explode(" ", $string);
  $output = '';

  foreach($content_array as $content)
  {
  //starts with http://
  if(substr($content, 0, 7) == "http://")
  $content = '<a href="' . $content . '">' . $content . '</a>';

  //starts with www.
  if(substr($content, 0, 4) == "www.")
  $content = '<a href="http://' . $content . '">' . $content . '</a>';

  if(substr($content, 0, 8) == "https://")
  $content = '<a href="' . $content . '">' . $content . '</a>';

  if(substr($content, 0, 1) == "#")
  $content = '<a href="https://twitter.com/search?src=hash&amp;q=' . $content . '">' . $content . '</a>';

  if(substr($content, 0, 1) == "@")
  $content = '<a href="https://twitter.com/' . $content . '">' . $content . '</a>';

  $output .= " " . $content;
  }

  $output = trim($output);
  return $output;
}