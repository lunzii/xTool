<?php global $theme_options; ?>
<?php get_template_part( '/templates/blog/pagination-pages' ); ?>
<div class="post-share">
<?php  echo do_shortcode('[md_social_share_classic facebook="yes" twitter="yes" googleplus="yes" pinterest="yes"]'); ?>
</div>

<?php if($theme_options['post-show-author']) : ?>
<div class="post-author">
	<?php
		$author_name = __('About', MD_THEME_NAME).' '.get_the_author_meta('nickname', $post->author);
		$author_avatar = get_avatar(  get_the_author_meta('user_email', $post->author) );
		
		if(get_the_author_meta('user_url', $post->author) != ''){
			$author_name = '<a href="'.get_the_author_meta('user_url', $post->author).'">'.$author_name.'</a>';
			$author_avatar = '<a href="'.get_the_author_meta('user_url', $post->author).'">'.$author_avatar.'</a>';
		}
	?>
	<div class="author-avatar"><?php echo $author_avatar ?></div>

	<div class="author-info">
		<h4><?php echo $author_name; ?></h4>
		<?php if (get_the_author_meta('description', $post->author)) {?>
		<?php echo get_the_author_meta('description', $post->author); ?>
		<?php } else { ?>
		Nullam vel sem vel felis egestas lobortis. Nunc lobortis tellus vitae mattis malesuada. Nullam sed sagittis nisl. Proin hendrerit hendrerit eros, vitae iaculis nisl mattis at. Etiam facilisis erat velit, et aliquet tellus ullamcorper in. Vivamus eget massa id nunc egestas consequat a a libero.
		<?php } ?>
	</div>
</div>
<?php endif; ?>