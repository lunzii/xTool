<?php
/**
 *
 * MD Shortcodes Recent Posts
 *
 */

$md_shortcodes['md_recent_posts'] = array(
  "name"            => __("Recent Posts", "js_composer"),
  "base"            => "md_recent_posts",
  "modal"           => true,
  "params"          => array(
    array(
      "type"        => "radio",
      "heading"     => __("Show Image", "js_composer"),
      "param_name"  => "show_image",
      "value"       => array(
        __('No', "js_composer") => "", 
        __('Yes', "js_composer") => "true", 
      ),
      "default"     => ""
    ),
    $element_options['posts_per_page'],
    $element_options['order_by'],
    $element_options['order'],
    $element_options['items_cols'],
    $element_options['class'],
    $element_options['id'],
    $element_options['css_animation'],
    $element_options['css_animation_delay'],
  )
);


vc_map($md_shortcodes['md_recent_posts']);

class WPBakeryShortCode_MD_recent_posts extends WPBakeryShortCode {}

function get_post_excerpt($post_id){
  $the_post = get_post($post_id); //Gets post ID
  $the_excerpt = $the_post->post_content; //Gets post_content to be used as a basis for the excerpt
  $excerpt_length = 35; //Sets excerpt length by word count
  $the_excerpt = strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images
  $words = explode(' ', $the_excerpt, $excerpt_length + 1);

  if(count($words) > $excerpt_length) :
      array_pop($words);
      array_push($words, '…');
      $the_excerpt = implode(' ', $words);
  endif;

  return $the_excerpt;
}

