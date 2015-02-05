<?php while ( have_posts() ) : the_post(); ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php the_content(); ?>
		<?php get_template_part( '/templates/blog/pagination-pages' ); ?>
	</div>
<?php endwhile; ?>