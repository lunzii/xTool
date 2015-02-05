<?php global $theme_options; ?>
<div class="col-md-<?php echo $theme_options['blog-masonry-cols']; ?> col-sm-12 item">
	<article class="post-<?php the_id(); ?> post format-<?php echo $format.$is_sticky;?>">
		<?php get_template_part('/templates/blog/post-formats/preview/'.$format ); ?>
	</article>
</div>