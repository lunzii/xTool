<?php
	global $page_options;
	$audio_mp3 = get_post_meta($post->ID, 'post-audio-mp3', true); 
	$audio_mp3 = wp_get_attachment_url( $audio_mp3 );

	$page_options = get_post_custom($post->ID);
?>

<?php md_thumbnail($theme_options['blog-images-size'], $post->ID, false, false); ?>

<div class="post-audio"> <?php echo do_shortcode('[md_audio_hosted audio_mp3="'.$audio_mp3.'"]' ); ?></div>

<div class="post-body">
	
	<h2 class="post-title"><?php the_title(); ?></h2>
	
	<?php get_template_part('/templates/blog/meta-header'); ?>

	<div class="post-content"><?php the_content(); ?></div>

</div>

<?php get_template_part('/templates/blog/meta-footer'); ?>