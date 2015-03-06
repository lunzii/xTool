<?php

extract(shortcode_atts(array(
    'class'					=> '',
    'id' 					=> '',
    'css_animation' 		=> '',
    'css_animation_delay' 	=> '',
    'items_cols' 			=> '',
	'posts_per_page'		=> '',
    'order' 				=> '',
    'orderby'		 		=> ''
), $atts));

$animated = ($css_animation) ? 'animate' : '';
$css_animation_delay = ($css_animation) ? ' data-delay="'.$css_animation_delay.'"' : '';

$class  = setClass(array('md-blog-grid', $animated, $css_animation, $class));
$id 	= setId($id);

$args = array(
	'post_type'			=> 'post',
	'posts_per_page'	=> $posts_per_page,
	'order'				=> $order,
	'orderby'			=> $orderby,
	'tax_query' => array(
		array(
			'taxonomy' => 'post_format',
			'field' => 'slug',
			'terms' => 'post-format-quote',
			'operator' => 'NOT IN'
		)
	)
);
$items = query_posts( $args );

global $theme_options;
echo '<div'.$class.$id.$css_animation_delay.'>';
	echo '<div id="blog-boxed">';
		echo '<div class="row">';
			while ( have_posts() ) : the_post(); 
				$format = (get_post_format(get_the_id())) ? get_post_format(get_the_id()) : 'standard';
				$is_sticky = (is_sticky()) ? ' sticky' : '';
				echo '<div class="col-md-'.$items_cols.'">';
					include(locate_template('templates/blog/loop/boxed.php'));
				echo '</div>';
			endwhile;
		echo '</div>';
	echo '</div>';
echo '</div>';
wp_reset_query();
