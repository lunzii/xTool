<?php
	global $theme_options;
	$link = get_post_meta($post->ID, 'post-link-url', true);
	$label = get_post_meta($post->ID, 'post-link-label', true);
	$target = get_post_meta($post->ID, 'post-link-target', true);

	$page_options = get_post_custom($post->ID);
?>

<div class="post-link">
	<h2 class="post-title"><a href="<?php echo $link;?>" title="<?php esc_attr($label) ?>"><?php echo $label; ?></a></h2>
	<div class="post-link-label"><a href="<?php echo $link;?>" target="<?php echo $target;?>"><?php echo $link; ?></a></div>
</div>

<?php md_thumbnail($theme_options['blog-images-size'], $post->ID, false, false); ?>

<div class="post-body">
	
	<h2 class="post-title"><?php the_title(); ?></h2>
	
	<?php get_template_part('/templates/blog/meta-header'); ?>

	<div class="post-content"><?php the_content(); ?></div>

</div>

<?php get_template_part('/templates/blog/meta-footer'); ?>