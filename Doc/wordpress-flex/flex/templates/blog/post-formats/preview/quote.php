<?php $quote_author = get_post_meta($post->ID, 'post-quote-author', true); ?>

<div class="post-quote"><div class="quote"><?php the_content(); ?></div><span class="post-quote-author">- <?php echo $quote_author; ?> - <a href="<?php get_permalink();?>">#</a></span></div>