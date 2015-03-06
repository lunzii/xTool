<?php get_header(); ?>


	<?php
		$page_options = get_post_custom($post->ID);

		$section_padding = '';
		if(isset($page_options['page-sidebar'][0])):
			if($page_options['page-sidebar'][0] == 'no'):
				$section_padding = ' padding-no';
			else:
				$section_padding = '';
			endif;
		endif;
	?>

	<div class="page-content<?php echo $section_padding;?>" id="page-container">

	<?php
		
		if(isset($page_options['page-sidebar'][0]) && $page_options['page-sidebar'][0] == "left"):

			echo '<div class="container">';
				echo '<div class="row">';
					echo '<div class="col-md-9 col-md-right col-sm-left content-full">';
							get_template_part( '/templates/page/content-page-body' );
					echo '</div>';

					echo '<div class="col-md-3 col-md-left col-sm-right">';
							get_sidebar('page');
					echo '</div>';
				echo '</div>';
			echo '</div>';
			
		elseif (isset($page_options['page-sidebar'][0]) && $page_options['page-sidebar'][0] == "right"):
			
			echo '<div class="container">';
				echo '<div class="row">';
					echo '<div class="col-md-9 col-md-left col-sm-left content-full">';
							get_template_part( '/templates/page/content-page-body' );
					echo '</div>';

					echo '<div class="col-md-3 col-md-right col-sm-right">';
							get_sidebar('page');
					echo '</div>';
				echo '</div>';
			echo '</div>';


		elseif (isset($page_options['page-centered'][0]) && filter_var($page_options['page-centered'][0], FILTER_VALIDATE_BOOLEAN)):
			
			echo '<div class="container">';
				echo '<div class="row">';
					echo '<div class="col-md-1 visible-md visible-lg"></div>';

					echo '<div class="col-md-10 col-sm-12 content-full">';
							get_template_part( '/templates/page/content-page-body' );
					echo '</div>';

					echo '<div class="col-md-1 visible-md visible-lg"></div>';
				echo '</div>';
			echo '</div>';

		else:
			get_template_part( '/templates/page/content-page-body' );
		endif;
	?>
	
	</div>

<?php get_footer(); ?>