<?php global $theme_options; ?>
<?php get_header(); ?>

	<div class="page-content padding-small" id="woocommerce-container">
		<div class="container">
		<?php

			if($theme_options['woocommerce-sidebar'] == "left"):
				do_action( 'woocommerce_archive_description' );
				
				echo '<div class="row">';
					echo '<div class="md-column col-main col-md-9 col-md-right col-sm-left content-full">
						<section class="woocommerce-content columns-'.$theme_options['woocommerce-products-cols'].'">';

						get_template_part('woocommerce/loop-shop');

						echo '</section>
					</div>';

					echo '<div class="md-column col-side col-md-3 col-md-left col-sm-right">';
						get_sidebar('shop');
					echo '</div>';

				echo '</div>';
				
			elseif ($theme_options['woocommerce-sidebar'] == "right"):
				do_action( 'woocommerce_archive_description' );
				echo '<div class="row">';
					echo '<div class="md-column col-main col-md-9 col-md-left col-sm-left content-full">
						<section class="woocommerce-content columns-'.$theme_options['woocommerce-products-cols'].'">';

						get_template_part('woocommerce/loop-shop');

						echo '</section>
					</div>';

					echo '<div class="md-column col-side col-md-3 col-md-right col-sm-right">';
						get_sidebar('shop');
					echo '</div>';
				echo '</div>';


			else:
				echo '<section class="woocommerce-content columns-'.$theme_options['woocommerce-products-cols'].'">';
				
				do_action( 'woocommerce_archive_description' );

				get_template_part('woocommerce/loop-shop');

				echo '</section>';
			endif;

		?>
		</div>
	</div>
	
<?php get_footer(); ?>