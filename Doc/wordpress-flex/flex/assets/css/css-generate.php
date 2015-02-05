<?php 
header("Content-type: text/css; charset=utf-8"); 

$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];
require_once( $path_to_wp . '/wp-load.php' );
?>

.accent-color{
	color: <?php echo $theme_options['accent-color']; ?> !important;
}

.accent-bgcolor{
	background-color: <?php echo $theme_options['accent-color']; ?> !important;
}

.accent-bordercolor{
	border-color: <?php echo $theme_options['accent-color']; ?> !important;
}

body{
	color: <?php echo $theme_options['font-body']['color']; ?>;
	font-family: <?php echo $theme_options['font-body']['font-family']; ?>;
	font-size: <?php echo $theme_options['font-body']['font-size']; ?>;
	font-weight: <?php echo $theme_options['font-body']['font-weight']; ?>;
	<?php if(isset($theme_options['font-body']['font-style']) && ($theme_options['font-body']['font-style'])): ?>
	font-style: <?php echo $theme_options['font-body']['font-style']; ?>;
	<?php endif; ?>	
	background-color: <?php echo $theme_options['body-bgcolor']; ?>;
	<?php if($theme_options['body-bgimage']['url']): ?>
	background-image: url(<?php echo $theme_options['body-bgimage']['url']; ?>);
	background-attachment: fixed;
	<?php endif; ?>	
}

a{
	color: <?php echo $theme_options['accent-color']; ?>;
}


::selection{
	color: #fff;
	background: <?php echo $theme_options['accent-color']; ?>;
}
::-moz-selection{
	color: #fff;
	background: <?php echo $theme_options['accent-color']; ?>;
}

.special-font{
	font-family: <?php echo $theme_options['font-special']['font-family']; ?>;
}

h1{
	color: <?php echo $theme_options['font-h1']['color']; ?>;
	font-family: <?php echo $theme_options['font-h1']['font-family']; ?>;
	font-size: <?php echo $theme_options['font-h1']['font-size']; ?>;
	font-weight: <?php echo $theme_options['font-h1']['font-weight']; ?>;
	line-height: <?php echo $theme_options['font-h1']['line-height']; ?>;
	<?php if(isset($theme_options['font-h1']['font-style']) && ($theme_options['font-h1']['font-style'])): ?>
	font-style: <?php echo $theme_options['font-h1']['font-style']; ?>;
	<?php endif; ?>	
}

h2{
	color: <?php echo $theme_options['font-h2']['color']; ?>;
	font-family: <?php echo $theme_options['font-h2']['font-family']; ?>;
	font-size: <?php echo $theme_options['font-h2']['font-size']; ?>;
	font-weight: <?php echo $theme_options['font-h2']['font-weight']; ?>;
	line-height: <?php echo $theme_options['font-h2']['line-height']; ?>;
	<?php if(isset($theme_options['font-h2']['font-style']) && ($theme_options['font-h2']['font-style'])): ?>
	font-style: <?php echo $theme_options['font-h2']['font-style']; ?>;
	<?php endif; ?>	
}

h3{
	color: <?php echo $theme_options['font-h3']['color']; ?>;
	font-family: <?php echo $theme_options['font-h3']['font-family']; ?>;
	font-size: <?php echo $theme_options['font-h3']['font-size']; ?>;
	font-weight: <?php echo $theme_options['font-h3']['font-weight']; ?>;
	line-height: <?php echo $theme_options['font-h3']['line-height']; ?>;
	<?php if(isset($theme_options['font-h3']['font-style']) && ($theme_options['font-h3']['font-style'])): ?>
	font-style: <?php echo $theme_options['font-h3']['font-style']; ?>;
	<?php endif; ?>	
}

h4{
	color: <?php echo $theme_options['font-h4']['color']; ?>;
	font-family: <?php echo $theme_options['font-h4']['font-family']; ?>;
	font-size: <?php echo $theme_options['font-h4']['font-size']; ?>;
	font-weight: <?php echo $theme_options['font-h4']['font-weight']; ?>;
	line-height: <?php echo $theme_options['font-h4']['line-height']; ?>;
	<?php if(isset($theme_options['font-h4']['font-style']) && ($theme_options['font-h4']['font-style'])): ?>
	font-style: <?php echo $theme_options['font-h4']['font-style']; ?>;
	<?php endif; ?>	
}

h5{
	color: <?php echo $theme_options['font-h5']['color']; ?>;
	font-family: <?php echo $theme_options['font-h5']['font-family']; ?>;
	font-size: <?php echo $theme_options['font-h5']['font-size']; ?>;
	font-weight: <?php echo $theme_options['font-h5']['font-weight']; ?>;
	line-height: <?php echo $theme_options['font-h5']['line-height']; ?>;
	<?php if(isset($theme_options['font-h5']['font-style']) && ($theme_options['font-h5']['font-style'])): ?>
	font-style: <?php echo $theme_options['font-h5']['font-style']; ?>;
	<?php endif; ?>	
}

h6{
	color: <?php echo $theme_options['font-h6']['color']; ?>;
	font-family: <?php echo $theme_options['font-h6']['font-family']; ?>;
	font-size: <?php echo $theme_options['font-h6']['font-size']; ?>;
	font-weight: <?php echo $theme_options['font-h6']['font-weight']; ?>;
	line-height: <?php echo $theme_options['font-h6']['line-height']; ?>;
	<?php if(isset($theme_options['font-h6']['font-style']) && ($theme_options['font-h6']['font-style'])): ?>
	font-style: <?php echo $theme_options['font-h6']['font-style']; ?>;
	<?php endif; ?>	
}

.md-special-heading{
	font-family: <?php echo $theme_options['font-h1']['font-family']; ?>;
}

header .header-content{
	background: <?php echo $theme_options['header-bgcolor']; ?>;
}

header .header-top{
	background:<?php echo $theme_options['header-top-bgcolor']; ?>;
	color: <?php echo $theme_options['header-top-font']['color']; ?>;
	font-family: <?php echo $theme_options['header-top-font']['font-family']; ?>;
	font-size: <?php echo $theme_options['header-top-font']['font-size']; ?>;
	font-weight: <?php echo $theme_options['header-top-font']['font-weight']; ?>;
	<?php if(isset($theme_options['header-top-font']['font-style']) && ($theme_options['header-top-font']['font-style'])): ?>
	font-style: <?php echo $theme_options['header-top-font']['font-style']; ?>;
	<?php endif; ?>	
}

header .header-top #header-top-menu li a,
header .header-top .header-social a{
	color: <?php echo $theme_options['header-top-font']['color']; ?>;
}


.header-menu ul.menu li,
.header-menu ul.menu li a,
.header-menu ul.menu > li.simple > ul > li a,
.header-menu ul.menu > li.megamenu > ul > li > a,
.header-menu ul.menu > li.megamenu > ul > li > ul > li > a{
	color: <?php echo $theme_options['menu-font']['color']; ?>;
	font-family: <?php echo $theme_options['menu-font']['font-family']; ?>;
	font-size: <?php echo $theme_options['menu-font']['font-size']; ?>;
	font-weight: <?php echo $theme_options['menu-font']['font-weight']; ?>;
}

#search-open{
	color: <?php echo $theme_options['menu-font']['color']; ?>;
}


#page-header h2{
	font-family: <?php echo $theme_options['page-header-title']['font-family']; ?>;
	font-size: <?php echo $theme_options['page-header-title']['font-size']; ?>;
	font-weight: <?php echo $theme_options['page-header-title']['font-weight']; ?>;
	line-height: <?php echo $theme_options['page-header-title']['line-height']; ?>;
}

#page-header h3{
	font-family: <?php echo $theme_options['page-header-subtitle']['font-family']; ?>;
	font-size: <?php echo $theme_options['page-header-subtitle']['font-size']; ?>;
	font-weight: <?php echo $theme_options['page-header-subtitle']['font-weight']; ?>;
	line-height: <?php echo $theme_options['page-header-subtitle']['line-height']; ?>;
}

footer{
	background: <?php echo $theme_options['footer-bgcolor']; ?>;
}

#copyright{
	background: <?php echo $theme_options['copyright-bgcolor']; ?>;
}

.page-content{
	background-color: <?php echo $theme_options['body-bgcolor']; ?>;
}


.md-portfolio.default .md-work .work-title a,
.widget_md_widget_twitter ul li{
	color: <?php echo $theme_options['font-body']['color']; ?>;
}


a:hover,
header .header-top .header-slogan a,
header .header-top #header-top-menu li a:hover,
.header-menu.menu-style-1 ul.menu > li.current_page_item > a,
.header-menu.menu-style-1 ul.menu > li.current_page_parent > a,
.header-menu.menu-style-3 ul li.current_page_item > a,
.header-menu.menu-style-3 ul li.current_page_parent > a,
.header-menu ul.menu > li:hover > a,
.header-menu ul.menu > li.megamenu > ul > li:hover > a,
.header-menu ul.menu > li.current_page_item > a,
.header-menu ul.menu > li.simple > ul > li a:hover,
.header-menu ul.menu > li.megamenu > ul > li > ul > li > a:hover,
#menu-mobile-trigger.open:after,
#menu-mobile-trigger:hover:after,
.header-mobile .menu li a:hover,
.md-portfolio .md-work .work-thumb .mask a:hover,
.md-blog .post .post-title a:hover,
.md-blog .post .post-header a:hover,
.md-blog .post .post-author .author-info h4 a:hover,
#comments .commentlist li .comment-cont .comment-meta a:hover,
#comments .commentlist li .comment-cont .comment-author a:hover,
.md-pagination li.active a,
.md-pagination.pagination-page span,
.md-pagination.pagination-page a:hover span,
.widget_calendar table #today a,
.widget_calendar table a:hover,
.widget > ul > li a:hover,
.widget .tagcloud a:hover,
footer .widget_calendar table #today a,
footer .widget_calendar table a:hover,
footer .widget ul li a:hover,
footer .widget .tagcloud a:hover,
#copyright-menu li a:hover,
.search-title span,
.md-portfolio.default .md-work .work-title a:hover,
.md-portfolio-filter a.active,
.md-button.style-2.standard,
.md-pagination li a:hover,
.md-recent-posts .item h2 a:hover,
.woocommerce-pagination ul li a:hover,
.woocommerce-pagination ul li span,
.woocommerce .products .product:hover h3 a,
.woocommerce-tabs .comment-form-rating .stars a:hover,
.woocommerce-tabs .comment-form-rating .stars a.active,
.widget_shopping_cart .cart_list > li a:hover,
.widget_products .product_list_widget > li a:hover,
.widget_recently_viewed_products .product_list_widget > li a:hover,
.widget_recent_reviews .product_list_widget > li a:hover,
.widget_top_rated_products .product_list_widget > li a:hover{
	color: <?php echo $theme_options['accent-color']; ?>;
}

#shop-button,
header .header-cart span,
.header-menu.menu-style-1 ul.menu > li > a:after,
.header-menu.menu-style-1 ul.menu > li:hover > a:after,
.header-menu.menu-style-1 ul.menu > li.current_page_item > a:after,
.header-menu.menu-style-1 ul.menu > li.current_page_parent > a:after,
.header-menu.menu-style-2 ul.menu > li > a:after,
.header-menu.menu-style-2 ul.menu > li.current_page_item > a:after,
.header-menu.menu-style-2 ul.menu > li.current_page_parent > a:after,
.header-menu.menu-style-4 ul.menu > li > a:hover,
.header-menu.menu-style-4 ul.menu > li:hover > a,
.header-menu.menu-style-4 ul.menu > li.current_page_item > a,
.header-menu.menu-style-4 ul.menu > li.current_page_parent > a,
.header-menu.menu-style-5 ul.menu > li > a:hover,
.header-menu.menu-style-5 ul.menu > li:hover > a,
.header-menu.menu-style-5 ul.menu > li.current_page_item > a,
.header-menu.menu-style-5 ul.menu > li.current_page_parent > a,
section.bg-accent-color,
.widget_shopping_cart .button:hover,
.widget_price_filter .ui-slider .ui-slider-handle,
.md-accordions .panel .panel-heading a,
.md-tabs .nav.nav-tabs li.active a,
.md-button.style-1.standard,
.md-button.style-2.standard:hover,
.wpcf7 .wpcf7-submit,
.mejs-overlay:hover .mejs-overlay-button,
.mejs-controls .mejs-time-rail .mejs-time-current,
.mejs-controls .mejs-volume-button .mejs-volume-slider .mejs-volume-current,
.mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current,
.md-blog .post .post-link,
.md-blog .post .post-quote,
.md-blog .post .post-aside,
.md-blog .post .post-status,
.comment-respond input#submit:hover,
.widget_md_widget_social_profiles a:hover,
.woocommerce .products .product .button,
.woocommerce .onsale,
.woocommerce .woocommerce-message,
.woocommerce .woocommerce-info,
.woocommerce .cart-empty,
.woocommerce.widget_price_filter .ui-slider .ui-slider-handle,
.woocommerce.widget_price_filter .ui-slider .ui-slider-range{
	background-color: <?php echo $theme_options['accent-color']; ?>;
}


.md-portfolio-filter .current,
.md-tooltip,
.md-clients .list .md-client:hover,
.md-testimonials .md-testimonial .testimonial-image,
.md-button.style-1.standard,
.md-button.style-2.standard,
.md-blog .post.sticky,
blockquote.style-2,
.md-blog .post .post-author,
.widget_md_widget_dribbble ul li:hover,
.widget_md_widget_pinterest ul li:hover,
.widget_md_widget_flickr .flickr_badge_image:hover,
.woocommerce .products .product .added_to_cart,
.woocommerce .products .product:hover .button{
	border-color: <?php echo $theme_options['accent-color']; ?>;
}


.md-portfolio.alternative .md-work .work-thumb .mask,
.md-portfolio.masonry .md-work .work-thumb .mask{
	background-color: <?php echo hex2rgb($theme_options['accent-color'], '0.85') ?>;
}

.header-menu ul.menu > li.simple ul,
.header-menu ul.menu > li.megamenu > ul{
	border-top-color: <?php echo $theme_options['accent-color']; ?>;
}


#twitter-footer,
#twitter-footer .md-carousel:after{
	background-color: <?php echo $theme_options['footer-twitter-bgcolor']; ?>;
}


.md-revslider div,
.md-revslider a{
	font-family: <?php echo $theme_options['font-body']['font-family']; ?> !important;
}


.page-section.bg-default.arrow-down .section-arrow-left,
.page-section.bg-default.arrow-down .section-arrow-right{
	border-top-color: <?php echo $theme_options['body-bgcolor']; ?>;
	border-bottom-color: <?php echo $theme_options['body-bgcolor']; ?>;
}

.page-section.bg-default.arrow-down .section-arrow-left,
.page-section.bg-default.arrow-up .section-arrow-right{
	border-left-color: <?php echo $theme_options['body-bgcolor']; ?>;
}

.page-section.bg-default.arrow-down .section-arrow-right,
.page-section.bg-default.arrow-up .section-arrow-left{
	border-right-color: <?php echo $theme_options['body-bgcolor']; ?>;
}

/* CUSTOM CSS STARTS HERE */
<?php if(isset($theme_options['custom-css'])) echo $theme_options['custom-css']; ?>
