<?php
global $theme_options;

if(is_home()):
	
	if(get_option('page_for_posts')){
		$page_id = get_option('page_for_posts');
	}
	else return;

elseif (class_exists('Woocommerce') && is_shop()):

	$page_id = woocommerce_get_page_id( 'shop' );

else:

	if(is_404() || is_search() || is_archive()){ return; }
	$page_id = get_the_id();

endif;

$page_options = get_post_custom($page_id);

if (!isset($page_options['page-header-enabled']) || !filter_var($page_options['page-header-enabled'][0], FILTER_VALIDATE_BOOLEAN)) return;


// Check Background Color
if ($page_options['page-header-bgcolor'][0] == $theme_options['accent-color']):

	$page_header_bg = 'accent-bgcolor';
	$page_header_bg_color = '';

else:

	$page_header_bg = 'custom-bgcolor';
	$page_header_bg_color = 'background-color:'.$page_options['page-header-bgcolor'][0].';';

endif;


// Check Background Image
if ($page_options['page-header-bgimage'][0]):

	$img = wp_get_attachment_image_src( $page_options['page-header-bgimage'][0], 'full');
	
	$page_header_bg_image = 'background-image:url('.$img[0].');';

else:

	$page_header_bg_image = '';

endif;



// Check Background Parallax
if($page_options['page-header-bgimage-attach'][0] == 'bg-parallax'):
	$bg_parallax = ' data-type="background" data-speed="3"';
else:
	$bg_parallax = '';
endif;


if(!isset($page_options['page-header-bgimage-type']))
$page_options['page-header-bgimage-type'][0] = 'full-image';

// Set Class
$class = setClass(array('border-'.$theme_options['header-border'], $page_options['page-header-align'][0], $page_header_bg, $page_options['page-header-bgimage-attach'][0], $page_options['page-header-bgimage-type'][0]));


// Set Style
if($page_options['page-header-bgcolor'][0] || $page_options['page-header-bgimage'][0]):

	$style = ' style="'.$page_header_bg_color.$page_header_bg_image.'"';

else:

	$style = false;

endif;




$page_header_title = ($page_options['page-header-title'][0]) ? $page_options['page-header-title'][0] : get_the_title($page_id);
$page_header_title_animation = ($page_options['page-header-title-animation'][0]) ? ' class="animated '.$page_options['page-header-title-animation'][0].'"' : '';
$page_header_subtitle_animation = ($page_options['page-header-subtitle-animation'][0]) ? ' class="animated '.$page_options['page-header-subtitle-animation'][0].'"' : '';
?>
<div id="page-header"<?php echo $class.$style.$bg_parallax; ?>>

	<?php 
		if(filter_var($page_options['page-header-mask'][0], FILTER_VALIDATE_BOOLEAN)){

			if ($page_options['page-header-mask-bgimage'][0]):

				$img = wp_get_attachment_image_src( $page_options['page-header-mask-bgimage'][0], 'full');
				
				$page_header_mask_bgimage = 'background-image:url('.$img[0].');';

			else:

				$page_header_mask_bgimage = '';

			endif;

			echo '<div class="mask" style="background-color:'.hex2rgb($page_options['page-header-mask-bgcolor'][0], $page_options['page-header-mask-opacity'][0]).';'.$page_header_mask_bgimage.'"></div>';
		}
	?>

	<div class="container <?php echo $page_options['page-header-padding'][0]; ?>">
		
		<h2<?php echo $page_header_title_animation;?> style="color:<?php echo $page_options['page-header-title-color'][0];?>"><?php echo $page_header_title; ?></h2>
		
		<?php if($page_options['page-header-subtitle'][0]): ?>
			<h3<?php echo $page_header_subtitle_animation;?> style="color:<?php echo $page_options['page-header-subtitle-color'][0];?>"><?php echo $page_options['page-header-subtitle'][0]; ?></h3>
		<?php endif; ?>
	

	    <?php if(function_exists('bcn_display')) { ?>
	        <div class="breadcrumbs">
	        	<?php bcn_display(); ?>
	    	</div>
	    <?php } ?>

	</div>

</div>