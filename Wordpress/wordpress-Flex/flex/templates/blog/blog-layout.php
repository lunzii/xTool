<?php

global $theme_options;

if($theme_options['blog-sidebar'] == "left"):
	echo '<div class="row">';
		echo '<div class="col-md-9 col-md-right col-sm-left">';
			if($theme_options['blog-style'] == 'masonry'):
			echo '<div class="row">';
				get_template_part( '/templates/blog/posts-loop' );
			echo '</div>';
			else:
				get_template_part( '/templates/blog/posts-loop' );
			endif;
		echo '</div>';

		echo '<div class="col-md-3 col-md-left col-sm-right">';
			get_sidebar();
		echo '</div>';
	echo '</div>';
	
elseif ($theme_options['blog-sidebar'] == "right"):
	echo '<div class="row">';
		echo '<div class="col-md-9">';
			if($theme_options['blog-style'] == 'masonry'):
			echo '<div class="row">';
				get_template_part( '/templates/blog/posts-loop' );
			echo '</div>';
			else:
				get_template_part( '/templates/blog/posts-loop' );
			endif;
		echo '</div>';

		echo '<div class="col-md-3 col-side">';
			get_sidebar();
		echo '</div>';
	echo '</div>';


else:

	if($theme_options['blog-style'] == 'masonry'):
		echo '<div class="row">';
			get_template_part( '/templates/blog/posts-loop' );
		echo '</div>';
	else :
		echo '<div class="row">';
			echo '<div class="col-md-12">';
			get_template_part( '/templates/blog/posts-loop' );
			echo '</div>';
		echo '</div>';
	endif;
	
endif;
?>