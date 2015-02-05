<?php 

/*-----------------------------------------------------------------------------------

	Here we have all the custom functions for the theme
	Please be extremely cautious editing this file,
	When things go wrong, they tend to go wrong in a big way.
	You have been warned!

-------------------------------------------------------------------------------------*/


/*-----------------------------------------------------------------------------------*/
/*	Constant
/*-----------------------------------------------------------------------------------*/
define('MD_THEME_NAME', 'flex');
define('MD_THEME_DIR', get_template_directory());
define('MD_THEME_URI', get_template_directory_uri());
define('MD_DEBUG', false);
define('MD_MORE_THEMES', true);


/*-----------------------------------------------------------------------------------*/
/*  Content Width
/*-----------------------------------------------------------------------------------*/
if ( ! isset( $content_width ) ) {
    $content_width = 1170;
}


/*-----------------------------------------------------------------------------------*/
/*  Theme Support
/*-----------------------------------------------------------------------------------*/
if ( function_exists( 'add_theme_support' ) ) {
    
    // Load Text Domain
    load_theme_textdomain(MD_THEME_NAME, get_template_directory() . '/languages');
    
    // Enable Featured Images
    add_theme_support( 'post-thumbnails');

    // Enable WooCommerce    
    add_theme_support( 'woocommerce' );

    // HTML5 gallery and caption support (3.9 addition)
    add_theme_support( 'html5', array( 'gallery', 'caption' ) );

    // Enable automatic feed links
    add_theme_support( 'automatic-feed-links' );

    // Enable post formats for posts
    add_theme_support( 'post-formats', array( 'aside', 'audio', 'video', 'image', 'gallery', 'link', 'quote', 'status' ) );
    add_post_type_support( 'post', 'post-formats' );

    // Enable automatic feed links
    add_filter('widget_text', 'do_shortcode');

    // Set Thumbs Sizes
    add_image_size( 'md-thumb', 300, 240, true );           // Thumb
    add_image_size( 'md-blog', 800, 480, true );            // Blog
    add_image_size( 'md-half', 585, 456, true );            // Half
    add_image_size( 'md-one-third', 360, 288, true );       // One third
    add_image_size( 'md-two-thirds', 750, 600, true );      // Two thirds
    add_image_size( 'md-full', 1130, 904, true );           // Whole
    add_image_size( 'md-square', 350, 350, true );          // Square
    add_image_size( 'md-square-big', 700, 700, true );    // Square Big
    add_image_size( 'md-wide', 700, 350, true );           // Wide
    add_image_size( 'md-tall', 350, 700, true );           // Tall
}



/*-----------------------------------------------------------------------------------*/
/*	Theme Menus
/*-----------------------------------------------------------------------------------*/
if(!function_exists('md_theme_menu')) {
	
	function md_theme_menu() {
    if ( function_exists( 'register_nav_menu' ) ){
            register_nav_menu('header-menu',__( 'Header Menu' ));
            register_nav_menu('header-top-menu',__( 'Header Top Menu' ));
            register_nav_menu('copyright-menu',__( 'Copyright Menu' ));
        }
	}
	add_action( 'init', 'md_theme_menu' );
}



/*-----------------------------------------------------------------------------------*/
/*	Init ThemesHolic Framework
/*-----------------------------------------------------------------------------------*/
if ( file_exists( dirname( __FILE__ ) . '/framework/init.php' ) ) {
    require_once(dirname( __FILE__ ) . '/framework/init.php' );
}



/*-----------------------------------------------------------------------------------*/
/*  Theme Frontend Scripts
/*-----------------------------------------------------------------------------------*/
if(!function_exists('md_theme_scripts')) {
    
    function md_theme_scripts() {
        wp_enqueue_style( MD_THEME_NAME, get_stylesheet_uri(), '', '', 'all' );

        wp_enqueue_style( MD_THEME_NAME.'-generate', MD_THEME_URI . '/assets/css/css-generate.php', '', '', 'all' );
        wp_enqueue_style( MD_THEME_NAME.'-custom', MD_THEME_URI . '/assets/css/custom.css', '', '', 'all' );

        wp_enqueue_script( MD_THEME_NAME.'-bootstrap', MD_THEME_URI.'/assets/js/vendor/bootstrap.js', array('jquery'), NULL, true );

        wp_enqueue_script( MD_THEME_NAME.'-plugins', MD_THEME_URI.'/assets/js/vendor/plugins.js', array('jquery'), NULL, true );
        wp_enqueue_script( MD_THEME_NAME, MD_THEME_URI.'/assets/js/theme.js', array('jquery'), NULL, true );

        
        if( is_singular() && comments_open() ){
            wp_enqueue_script( 'comment-reply' );   
        }
    }
    add_action( 'wp_enqueue_scripts', 'md_theme_scripts' );

}

/*-----------------------------------------------------------------------------------*/
/*  Register Sidebar
/*-----------------------------------------------------------------------------------*/
if(function_exists('register_sidebar')) {
    function md_register_sidebars(){
        register_sidebar(array(
            'name' => __('Blog Sidebar', MD_THEME_NAME), 
            'description' => __('Widgets area for blog pages.', MD_THEME_NAME),
            'id' => 'sidebar-blog',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  =>
            '<h3 class="widget-title">',
            'after_title'   => '</h3>'
            )
        );


        register_sidebar(array(
            'name' => __('Page Sidebar', MD_THEME_NAME), 
            'description' => __('Widgets area for pages.', MD_THEME_NAME),
            'id' => 'sidebar-page',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  =>
            '<h3 class="widget-title">',
            'after_title'   => '</h3>'
            )
        );

        
        register_sidebar(array(
            'name' => __('Footer Area 1', MD_THEME_NAME), 
            'description' => __('Widgets area for footer area 1.', MD_THEME_NAME),
            'id' => 'footer-area-1',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  =>
            '<h3 class="widget-title">',
            'after_title'   => '</h3>'
            )
        );

        register_sidebar(array(
            'name' => __('Footer Area 2', MD_THEME_NAME), 
            'description' => __('Widgets area for footer area 2.', MD_THEME_NAME),
            'id' => 'footer-area-2',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  =>
            '<h3 class="widget-title">',
            'after_title'   => '</h3>'
            )
        );

        register_sidebar(array(
            'name' => __('Footer Area 3', MD_THEME_NAME), 
            'description' => __('Widgets area for footer area 3.', MD_THEME_NAME),
            'id' => 'footer-area-3',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  =>
            '<h3 class="widget-title">',
            'after_title'   => '</h3>'
            )
        );

        register_sidebar(array(
            'name' => __('Footer Area 4', MD_THEME_NAME), 
            'description' => __('Widgets area for footer area 4.', MD_THEME_NAME),
            'id' => 'footer-area-4',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  =>
            '<h3 class="widget-title">',
            'after_title'   => '</h3>'
            )
        );


        register_sidebar(array(
            'name' => __('Shop Sidebar', MD_THEME_NAME), 
            'description' => __('Widgets area for shop.', MD_THEME_NAME),
            'id' => 'sidebar-shop',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  =>
            '<h3 class="widget-title">',
            'after_title'   => '</h3>'
            )
        );

    }
}
add_action( 'widgets_init', 'md_register_sidebars' );


/*-----------------------------------------------------------------------------------*/
/*  Theme Comment
/*-----------------------------------------------------------------------------------*/
if(!function_exists('md_comment')) {

function md_comment($comment, $args, $depth) {

        $isByAuthor = false;

        if($comment->comment_author_email == get_the_author_meta('email')) {
            $isByAuthor = true;
        }

        $GLOBALS['comment'] = $comment; ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
            <div id="comment-<?php comment_ID(); ?>" class="comment-section">              
                <div class="comment-side">
                    <div class="comment-avatar"><a href="<?php echo get_the_author_meta('user_url'); ?>" target="_blank"><?php echo get_avatar($comment,$size='80'); ?></a></div>
                </div>
            
                <div class="comment-cont">                                        
                    <div class="comment-meta">
                        <?php
                            printf('<span class="comment-author">%1$s</span> <span class="comment-date">%2$s</span>',
                                get_comment_author_link(),
                                human_time_diff( get_comment_time('U'), current_time('timestamp') ));
                        ?>
                        <span class="comment-reply"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span>
                        <span class="comment-edit"><?php edit_comment_link(__('Edit', MD_THEME_NAME), '','') ?></span>
                    </div>
                    <?php if ( $comment -> comment_approved == '0') : ?>
                        <em class="moderation"><?php _e('Your comment is awaiting moderation.', MD_THEME_NAME) ?></em>
                    <?php endif; ?>
                    
                    <div class="comment-body">
                        <?php comment_text() ?>
                    </div>
                </div>
            </div>
    <?php
    }
}

/*-----------------------------------------------------------------------------------*/
/*  MD Pagination
/*-----------------------------------------------------------------------------------*/
if(!function_exists('md_pagination')) {
  function md_pagination() {

    if( is_singular() )
        return;

    global $wp_query;

    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;

    $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    $max   = intval( $wp_query->max_num_pages );

    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;

    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    echo '<div class="md-pagination"><ul>' . "\n";

    /** Previous Post Link */
    if ( get_previous_posts_link() )
        printf( '<li>%s</li>' . "\n", get_previous_posts_link('&laquo;') );

    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';

        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

        if ( ! in_array( 2, $links ) )
            echo '<li>…</li>';
    }

    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
    }

    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li>…</li>' . "\n";

        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
    }

    /** Next Post Link */
    if ( get_next_posts_link() )
        printf( '<li>%s</li>' . "\n", get_next_posts_link('&raquo;') );

    echo '</ul></div>' . "\n";
  }
}

/*-----------------------------------------------------------------------------------*/
/*  Pings
/*-----------------------------------------------------------------------------------*/
if(!function_exists('md_ping')) {
    function md_pings($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment; ?>
        <li id="comment-<?php comment_ID(); ?>"><?php comment_author_link(); ?>
        <?php 
    }
}