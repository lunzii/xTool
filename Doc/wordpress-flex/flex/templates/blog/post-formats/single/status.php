<?php 
	$page_options = get_post_custom($post->ID);
?>

<div class="post-status"><?php the_content(); ?></div>

<?php md_thumbnail($theme_options['blog-images-size'], $post->ID, false, false); ?>

<div class="post-body">
	
	<h2 class="post-title"><?php the_title(); ?></h2>
	
	<?php get_template_part('/templates/blog/meta-header'); ?>

</div>

<?php get_template_part('/templates/blog/meta-footer'); ?>