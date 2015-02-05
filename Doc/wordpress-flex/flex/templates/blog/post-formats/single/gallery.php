<?php 
	global $theme_options;
	$images = get_post_meta($post->ID, 'post-gallery', true);
	$images = explode(',', $images);
	$effect = get_post_meta($post->ID, 'post-gallery-animation', true);
	$navigation = filter_var(get_post_meta($post->ID, 'post-gallery-navigation', true), FILTER_VALIDATE_BOOLEAN);
	$pagination = filter_var(get_post_meta($post->ID, 'post-gallery-pagination', true), FILTER_VALIDATE_BOOLEAN);
	$page_options = get_post_custom($post->ID);
?>

<div class="post-slider">
	<?php
		$output = '<div class="flexslider" data-effect="'.$effect.'" data-navigation="'.$navigation.'" data-pagination="'.$pagination.'"><ul class="slides">';
			foreach($images as $image):
				$image_big  = wp_get_attachment_image_src( $image, $theme_options['blog-images-size']);	
				$alt 	= ( get_post_meta($image, '_wp_attachment_image_alt', true) ) ? get_post_meta($image, '_wp_attachment_image_alt', true) : '';
				$output .= '<li><img src="'.$image_big[0].'" alt="'.esc_attr($alt).'" /></li>';
			endforeach;
		$output .= '</ul></div>';
		echo $output;
	?>
</div>

<div class="post-body">
	
	<h2 class="post-title"><?php the_title(); ?></h2>
	
	<?php get_template_part('/templates/blog/meta-header'); ?>

	<div class="post-content"><?php the_content(); ?></div>

</div>

<?php get_template_part('/templates/blog/meta-footer'); ?>
