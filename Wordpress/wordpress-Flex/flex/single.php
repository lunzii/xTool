<?php get_header(); ?>

	<div class="page-content" id="post-container">
		<div class="container">
		<?php 

			if($theme_options['post-sidebar'] == "left"):
				echo '<div class="row">';
					echo '<div class="col-md-9 col-md-right col-sm-left content-full">';
						get_template_part( '/templates/blog/content-post-body' );
					echo '</div>';
					
					echo '<div class="col-md-3">';
						get_sidebar();
					echo '</div>';
				echo '</div>';
				
			elseif ($theme_options['post-sidebar'] == "right"):
				echo '<div class="row">';
					echo '<div class="col-md-9 col-md-left col-sm-left content-full">';
						get_template_part( '/templates/blog/content-post-body' );
					echo '</div>';

					echo '<div class="col-md-3 col-md-right col-sm-right">';
						get_sidebar();
					echo '</div>';
				echo '</div>';


			else:
					get_template_part( '/templates/blog/content-post-body' );
			endif;


		?>
		</div>
	</div>
	
<?php get_footer(); ?>