<?php get_header(); ?>

	<?php
		if(get_post_field('post_content', get_option('page_for_posts'))){
			echo apply_filters('the_content', get_post_field('post_content', get_option('page_for_posts')));
		}
	?>

	<div class="page-content" id="blog-container">
		<div class="container">
			<?php get_template_part('/templates/blog/blog-layout');?>
		</div>
	</div>
	
<?php get_footer(); ?>