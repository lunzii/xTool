<?php 
	$video_source = get_post_meta($post->ID, 'post-video-source', true); 

	$video_poster = get_post_meta($post->ID, 'post-video-poster', true); 
	$video_poster = wp_get_attachment_url( $video_poster );
	$video_mp4 = get_post_meta($post->ID, 'post-video-mp4', true); 
	$video_mp4 = wp_get_attachment_url( $video_mp4 );
	$video_webm = get_post_meta($post->ID, 'post-video-webm', true); 
	$video_webm = wp_get_attachment_url( $video_webm );
	$video_ogv = get_post_meta($post->ID, 'post-video-ogv', true); 
	$video_ogv = wp_get_attachment_url( $video_ogv );

	$video_youtube = get_post_meta($post->ID, 'post-video-youtube', true); 
	$video_vimeo = get_post_meta($post->ID, 'post-video-vimeo', true); 

	$page_options = get_post_custom($post->ID);
?>

<div class="post-video">
	<?php 

	switch ($video_source){

		case 'self':
			echo do_shortcode('[md_video_hosted video_poster_src="'.$video_poster.'" video_mp4="'.$video_mp4.'" video_webm="'.$video_webm.'" video_ogv="'.$video_ogv.'" controls="yes"]' );
		break;

		case 'youtube':
			echo do_shortcode('[md_video type="youtube" video_id="'.$video_youtube.'"]' );
		break;

		case 'vimeo':
			echo do_shortcode('[md_video type="vimeo" video_id="'.$video_vimeo.'"]' );
		break;

	}
	?>
</div>

<div class="post-body">
	
	<h2 class="post-title"><?php the_title(); ?></h2>
	
	<?php get_template_part('/templates/blog/meta-header'); ?>

	<div class="post-content"><?php the_content(); ?></div>

</div>

<?php get_template_part('/templates/blog/meta-footer'); ?>