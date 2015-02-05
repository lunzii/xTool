<?php 
	$link = get_post_meta($post->ID, 'post-link-url', true);
	$label = get_post_meta($post->ID, 'post-link-label', true);
	$target = get_post_meta($post->ID, 'post-link-target', true);
?>
<div class="post-link">
	<h2 class="post-title"><a href="<?php echo $link;?>" title="<?php esc_attr($label) ?>"><?php echo $label; ?></a></h2>
	<div class="post-link-label"><a href="<?php echo $link;?>" target="<?php echo $target;?>"><?php echo $link; ?></a></div>
</div>