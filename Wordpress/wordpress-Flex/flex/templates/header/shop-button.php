<?php global $woocommerce; ?>
<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', MD_THEME_NAME); ?>" id="shop-button" class="cart-contents"><i class="entypo-basket"></i>SHOP <span class="cart-info">(<?php echo $woocommerce->cart->cart_contents_count; ?>)</span></a>
