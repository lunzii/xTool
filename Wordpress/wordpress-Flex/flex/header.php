<?php global $theme_options; ?>
<?php

	$body_style = false;
	$body_bgcolor = false;
	$body_bgimage = false;
	$show_header = true;
	if(isset($post)){

		$post_custom = get_post_custom($post->ID);

		if(isset($post_custom['force-boxed']) && filter_var($post_custom['force-boxed'][0], FILTER_VALIDATE_BOOLEAN))
			$theme_options['site-layout'] = 'boxed';

		if(isset($post_custom['page-bgcolor']))
			$body_bgcolor = 'background-color:'.$post_custom['page-bgcolor'][0].';';

		if(isset($post_custom['page-bgimage'])){
			$bg_image = wp_get_attachment_image_src( $post_custom['page-bgimage'][0], 'full');
			$body_bgimage = 'background-image:url('.$bg_image[0].');';
		}

		if($body_bgcolor || $body_bgimage)
		$body_style = ' style="'.$body_bgcolor.$body_bgimage.'"';

		if(isset($post_custom['show-header']) && !filter_var($post_custom['show-header'][0], FILTER_VALIDATE_BOOLEAN))
			$show_header = false; 		
	}

?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>

<!-- Meta Tags -->
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<!-- Mobile Specifics -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<!-- Title -->
<title><?php wp_title('|',true,'right'); ?><?php bloginfo('name'); ?></title>

<!-- Favicon -->
<?php if(!empty($theme_options['favicon']['url'])) { ?>
<link rel="shortcut icon" href="<?php echo $theme_options['favicon']['url'] ?>" />
<?php } else { ?>
<link rel="shortcut icon" href="<?php echo get_template_directory_uri().'/assets/img/placeholder/favicon.png' ?>" />
<?php } ?>

<!-- Apple Touch Icons -->    
<?php if(!empty($theme_options['apple-icon-57']['url'])) { ?>
<link rel="apple-touch-icon" href="<?php echo $theme_options['apple-icon-57']['url']; ?>" />
<?php } ?>
<?php if(!empty($theme_options['apple-icon-72']['url'])) { ?>
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo $theme_options['apple-icon-72']['url']; ?>" />
<?php } ?>
<?php if(!empty($theme_options['apple-icon-114']['url'])) { ?>
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo $theme_options['apple-icon-114']['url']; ?>" />
<?php } ?>
<?php if(!empty($theme_options['apple-icon-144']['url'])) { ?>
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo $theme_options['apple-icon-144']['url']; ?>" />
<?php } ?>

<!-- RSS & Pingbacks -->
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php bloginfo( 'rss2_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri().'/assets/js/html5shiv.min.js' ?>"></script>
<![endif]--> 

<?php wp_head(); ?>
	 
</head>
<?php	$css3_animations = (md_detect_mobile()) ? 'device-mobile' : 'css3-animations-enabled device-desktop'; ?>
<body <?php body_class($css3_animations); ?><?php echo $body_style;?>>
	
<div id="wrap" class="<?php echo $theme_options['site-layout']; ?> border-<?php echo $theme_options['header-border']; ?>">
<?php
	if($show_header){
?>

	<header class="width-<?php echo $theme_options['header-width']; ?> height-<?php echo $theme_options['header-height']; ?> attachment-<?php echo $theme_options['header-attachment']; ?> border-<?php echo $theme_options['header-border']; ?> <?php echo $theme_options['header-scroll-resize']; ?> <?php echo $theme_options['header-scroll-transparent']; ?>">
		
		<?php if($theme_options['header-top']){ ?>
		<div class="header-top">
			<div class="container">
				<?php
					if($theme_options['header-slogan']){ 
						
						get_template_part( '/templates/header/slogan' );

					}
				?>
				<div class="float-right">
				<?php

					if(has_nav_menu("header-top-menu")){
						$args = array( 
							'theme_location' => 'header-top-menu', 
							'depth'          => 1, 
							'container'      => false,
							'menu_id'	 	 => 'header-top-menu',
						);
						wp_nav_menu($args); 
					}

					if($theme_options['header-social']){ 
					
						get_template_part( '/templates/header/social-links' );

					}

				?>
				</div>
			</div>
		</div>
		<?php } ?>



		<div class="header-content" id="header-content">		
			<div class="container">
				<div id="logo">
					<a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>">
						<?php 
							if(isset($theme_options['logo']) && isset($theme_options['logo']['url']) && $theme_options['logo']['url'] != ''){
								echo '<img src="'.$theme_options['logo']['url'].'" alt="" />';
							}
							else{
								echo '<img src="'.get_template_directory_uri().'/assets/img/placeholder/logo.png" alt="" />';
							}
						?>
						
					</a>
				</div>

				<nav class="header-menu menu-style-<?php echo $theme_options['menu-style']; ?> menu-uppercase-<?php echo $theme_options['menu-uppercase']; ?> submenu-<?php echo $theme_options['submenu-version']; ?>">
					<?php 
						$args = array( 
							'theme_location' => 'header-menu', 
							'depth'          => 3, 
							'container'      => false,
							'menu_id'	 	 => 'header-menu',
							'walker'		 => new md_megamenu_walker
						);

						if(has_nav_menu("header-menu")){
							wp_nav_menu($args); 
						} else {
							echo '<span class="menu-fallback">'.__("No menu is found.", MD_THEME_NAME).'</span>';
						}							
					?>
				</nav>

				<?php if (class_exists('Woocommerce')){ ?>
					<?php if($theme_options['header-woocommerce']){ ?>
						<?php get_template_part( '/templates/header/shop-button' ); ?>
					<?php } ?>
				<?php } ?>
				
				<?php
					if($theme_options['header-search']){ 
						get_template_part( '/templates/header/search' );
					}
				?>

				<a href="#" id="menu-mobile-trigger"></a>
			</div>
		</div>

		<div class="header-mobile">
			<div class="container">
				

				<nav class="header-menu-mobile">
					<?php 
						$args = array( 
							'theme_location' => 'header-menu', 
							'depth'          => 3, 
							'container'      => false,
							'menu_id'	 	 => 'header-menu-mobile'
						);

						if(has_nav_menu("header-menu")){
							wp_nav_menu($args); 
						}							
					?>
				</nav>


			</div>
		</div>
	</header>
<?php } ?>

<?php get_template_part( '/templates/page/page-header' ); ?>