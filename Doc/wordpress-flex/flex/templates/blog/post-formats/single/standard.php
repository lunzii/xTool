<?php
	global $theme_options;
	$page_options = get_post_custom($post->ID);
?>

<?php md_thumbnail($theme_options['blog-images-size'], $post->ID, false, false); ?>

<div class="post-body">
	
	<h2 class="post-title"><?php the_title(); ?></h2>
	
	<?php get_template_part('/templates/blog/meta-header'); ?>

	<div class="post-content"><?php the_content(); ?></div>

</div>

<?php get_template_part('/templates/blog/meta-footer'); ?>