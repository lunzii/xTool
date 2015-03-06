<?php global $theme_options; ?>

<?php md_thumbnail($theme_options['blog-images-size'], $post->ID);  ?>

<div class="post-body">
	
	<h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php esc_attr(the_title()) ?>"><?php the_title(); ?></a></h2>

	<?php get_template_part('/templates/blog/meta-header'); ?>

	<div class="post-content"><?php the_excerpt(); ?></div>

	<?php get_template_part('/templates/blog/read-more'); ?>
</div>