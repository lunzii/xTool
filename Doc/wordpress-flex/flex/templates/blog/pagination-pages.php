<?php 
 	$defaults = array(
		'before'           => '<div class="md-pagination pagination-page"><strong class="lbl">' . __('Pages:', MD_THEME_NAME).'</strong>',
		'after'            => '</div>',
		'link_before'      => '<span>',
		'link_after'       => '</span>',
		'next_or_number'   => 'number',
	);

	wp_link_pages($defaults);
?>
