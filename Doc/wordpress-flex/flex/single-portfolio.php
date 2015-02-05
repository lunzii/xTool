<?php get_header(); ?>

	<?php
		global $theme_options;
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

	<?php if($theme_options['portfolio-pagination']) { ?>
	<div id="portfolio-pagination" class="page-section padding-small border-top">
		<div class="container">
			<div class="pagination">
			<?php
				$prev_post = get_previous_post();
				if($prev_post) {
					$prev_title = strip_tags(str_replace('"', '', $prev_post->post_title));
					echo "\t" . '<a rel="prev" href="' . get_permalink($prev_post->ID) . '" title="' . $prev_title. '" class=" "><i class="entypo-left-open-big"></i></a>' . "\n";
				}
			?>
			
			<a href="<?php echo $theme_options['portfolio-url']; ?>"><i class="entypo-layout"></i></a>

			<?php
				$next_post = get_next_post();
				if($next_post) {
					$next_title = strip_tags(str_replace('"', '', $next_post->post_title));
					echo "\t" . '<a rel="next" href="' . get_permalink($next_post->ID) . '" title="' . $next_title. '" class=" "><i class="entypo-right-open-big"></i></a>' . "\n";
				}
            ?>
            </div>

    		 <?php  echo do_shortcode('[md_social_share facebook="yes" twitter="yes" googleplus="yes" pinterest="yes"]'); ?>
		</div>
	</div>
	<?php } ?>

<?php get_footer(); ?>