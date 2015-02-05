<?php 

/*-----------------------------------------------------------------------------------

    Here we have all the custom functions for the theme
    Please be extremely cautious editing this file,
    When things go wrong, they tend to go wrong in a big way.
    You have been warned!

-------------------------------------------------------------------------------------*/

if(!function_exists('md_woocommerce')) {    
    function md_woocommerce() {
        global $pagenow;
      
        add_filter( 'woocommerce_enqueue_styles', 'woo_dequeue_styles' );
        function woo_dequeue_styles( $enqueue_styles ) {
            unset( $enqueue_styles['woocommerce-general'] );    // Remove the gloss
            unset( $enqueue_styles['woocommerce-layout'] );     // Remove the layout
            unset( $enqueue_styles['woocommerce-smallscreen'] );    // Remove the smallscreen optimisation
            return $enqueue_styles;
        }

        add_action( 'wp_enqueue_scripts', 'md_remove_woocommerce_scripts', 99 );
        function md_remove_woocommerce_scripts(){
            wp_dequeue_style('woocommerce_chosen_styles');
            wp_dequeue_script('wc-chosen');
        }

        add_filter('add_to_cart_fragments', 'md_add_to_cart_fragments');
        function md_add_to_cart_fragments( $fragments ) {
            global $woocommerce;
            ob_start();
            ?>
            <a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', MD_THEME_NAME); ?>" id="shop-button" class="cart-contents"><i class="entypo-basket"></i>SHOP <span class="cart-info">(<?php echo $woocommerce->cart->cart_contents_count; ?>)</span></a>
            <?php
            
            $fragments['a.cart-contents'] = ob_get_clean();
            
            return $fragments;
        }

        if (!function_exists('custom_loop_columns')) {
            function custom_loop_columns() {
                global $theme_options;
                return $theme_options['woocommerce-products-cols'];
            }
            add_filter('loop_shop_columns', 'custom_loop_columns');
       }


        remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
        add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
         
        /**
         * WooCommerce Loop Product Thumbs
         **/
         
         if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {
         
            function woocommerce_template_loop_product_thumbnail() {
                echo woocommerce_get_product_thumbnail();
            } 
         }
         
         
        /**
         * WooCommerce Product Thumbnail
         **/
         if ( ! function_exists( 'woocommerce_get_product_thumbnail' ) ) {
            
            function woocommerce_get_product_thumbnail( $size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0  ) {
                global $post, $woocommerce;
         
                if ( ! $placeholder_width )
                    $placeholder_width = wc_get_image_size( 'shop_catalog_image_width' );
                if ( ! $placeholder_height )
                    $placeholder_height = wc_get_image_size( 'shop_catalog_image_height' );
                    
                    $output = '<a href="'.get_permalink().'">';
         
                    if ( has_post_thumbnail() ) {
                        
                        $output .= get_the_post_thumbnail( $post->ID, $size ); 
                        
                    } else {
                    
                        $output .= '<img src="'. woocommerce_placeholder_img_src() .'" alt="Placeholder" width="' . $placeholder_width . '" height="' . $placeholder_height . '" />';
                    
                    }
                    
                    $output .= '</a>';
                    
                    return $output;
            }
         }

    }
    md_woocommerce();
}
?>