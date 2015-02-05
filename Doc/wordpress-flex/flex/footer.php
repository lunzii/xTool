<?php 
global $theme_options;

$show_footer = true; 
if(isset($post)){
	$post_custom = get_post_custom($post->ID);

	if(isset($post_custom['show-footer']) && !filter_var($post_custom['show-footer'][0], FILTER_VALIDATE_BOOLEAN)){
		$show_footer = false; 
	}
}
?>

<?php if($theme_options['footer-enabled'] && $show_footer) : ?>
<footer>
	<div class="container">
		<div class="row">

			<?php
				switch ($theme_options['footer-layout']){
					case '2':
				?>

						<div class="col-md-6 column">
						<?php if ( function_exists('dynamic_sidebar') ) { ?>
							<?php dynamic_sidebar('footer-area-1'); ?>
						<?php } ?>
						</div>

						<div class="col-md-6 column">
						<?php if ( function_exists('dynamic_sidebar') ) { ?>
							<?php dynamic_sidebar('footer-area-2'); ?>
						<?php } ?>
						</div>
				<?php
					break;
				
					case '3':
				?>

						<div class="col-md-4 column">
						<?php if ( function_exists('dynamic_sidebar') ) { ?>
							<?php dynamic_sidebar('footer-area-1'); ?>
						<?php } ?>
						</div>

						<div class="col-md-4 column">
						<?php if ( function_exists('dynamic_sidebar') ) { ?>
							<?php dynamic_sidebar('footer-area-2'); ?>
						<?php } ?>
						</div>

						<div class="col-md-4 column">
						<?php if ( function_exists('dynamic_sidebar') ) { ?>
							<?php dynamic_sidebar('footer-area-3'); ?>
						<?php } ?>
						</div>
				<?php
					break;

					case '4':
				?>

						<div class="col-md-3 column">
						<?php if ( function_exists('dynamic_sidebar') ) { ?>
							<?php dynamic_sidebar('footer-area-1'); ?>
						<?php } ?>
						</div>

						<div class="col-md-3 column">
						<?php if ( function_exists('dynamic_sidebar') ) { ?>
							<?php dynamic_sidebar('footer-area-2'); ?>
						<?php } ?>
						</div>

						<div class="col-md-3 column">
						<?php if ( function_exists('dynamic_sidebar') ) { ?>
							<?php dynamic_sidebar('footer-area-3'); ?>
						<?php } ?>
						</div>

						<div class="col-md-3 column">
						<?php if ( function_exists('dynamic_sidebar') ) { ?>
							<?php dynamic_sidebar('footer-area-4'); ?>
						<?php } ?>
						</div>
				<?php
					break;
				}
			?>
		</div>
	</div>	
</footer>
<?php endif; ?>


<?php if($theme_options['copyright-enabled'] && $show_footer) : ?>
<div id="copyright">
	<div class="container">
		<div class="copyright-text"><?php echo $theme_options['copyright-text']; ?></div>
		<div class="float-right">
		<?php
			if(has_nav_menu("copyright-menu")){
				$args = array( 
					'theme_location' => 'copyright-menu', 
					'depth'          => 1, 
					'container'      => false,
					'menu_id'	 	 => 'copyright-menu',
				);
				wp_nav_menu($args); 
			}
		?>
		</div>
	</div>
</div>
<?php endif; ?>

</div>
<!-- end wrap -->


<?php 
	if($theme_options['back-top'])
	echo '<a href="#" id="md-back-top"></a>';

	if(isset($theme_options['tracking-code']) && $theme_options['tracking-code'] != '')
	echo '<script type="text/javascript">'.$theme_options['tracking-code'].'</script>';

	if(isset($theme_options['custom-js']) && $theme_options['custom-js'] != '')
	echo '<script type="text/javascript">'.$theme_options['custom-js'].'</script>';
?>



<?php wp_footer(); ?>

</body>
</html>