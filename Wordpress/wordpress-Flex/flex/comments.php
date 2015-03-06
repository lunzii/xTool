<?php
/*-----------------------------------------------------------------------------------*/
/*  Begin processing our comments
/*-----------------------------------------------------------------------------------*/


    /* Password protected? ----------------------------------------------------------*/
    if ( post_password_required() ) 
        return;
?>

<div id="comments">

<?php 

/*-----------------------------------------------------------------------------------*/
/*  Display the Comments & Pings
/*-----------------------------------------------------------------------------------*/

    if ( have_comments() ) :
    
        /* Display Comments ---------------------------------------------------------*/    
        if ( ! empty($comments_by_type['comment']) ) : // if there are normal comments ?>
            <h4 class="comment-title"><?php comments_number(__('0 Comments', MD_THEME_NAME), __('1 Comment', MD_THEME_NAME), __('% Comments', MD_THEME_NAME)); ?></h4>
    
            <ol class="commentlist">
            <?php wp_list_comments( 'type=comment&callback=md_comment' ); ?>
            </ol>
        <?php endif; // end normal comments 
        /* Display Pings -------------------------------------------------------------*/
        if ( ! empty($comments_by_type['pings']) ) : // if there are pings ?>
        
            <h4 class="comment-title" class="pings-title"><?php _e('Trackbacks for this post', MD_THEME_NAME) ?></h4>
        
            <ol class="pinglist">
            <?php wp_list_comments( 'type=pings&callback=md_pings' ); ?>
            </ol>

        <?php endif; // end pings 

        /* Display Comment Navigation -----------------------------------------------*/
        if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
            <div class="comment-navigation">
                <div class="nav-previous"><?php previous_comments_link( sprintf( '&larr; %s', __('Older Comments', MD_THEME_NAME) ) ); ?></div>
                <div class="nav-next"><?php next_comments_link( sprintf( '%s &rarr; ', __('Newer Comments', MD_THEME_NAME) ) ); ?></div>
            </div>
        <?php endif; // end comment pagination check ?>
        
        <?php
        /* If there are no comments and comments are closed, let's leave a little note, shall we?
         * But we only want the note on posts and pages that had comments in the first place.
         */
        if ( ! comments_open() && get_comments_number() ) : ?>
        <p class="nocomments"><?php _e('Comments are closed.', MD_THEME_NAME) ?></p>
        <?php endif; ?>
        
    <?php else: ?>
            <h4 class="comment-title"><?php _e('Submit a comment', MD_THEME_NAME); ?></h4>
    <?php endif; ?>

        

<?php 
    /*-----------------------------------------------------------------------------------*/
    /*  Comment Form
    /*-----------------------------------------------------------------------------------*/
    
    if ( comments_open() ) :

        $fields = array(
            'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="40" rows="10" aria-required="true"></textarea></p>',
            'must_log_in' => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', MD_THEME_NAME ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
            'logged_in_as' => '',
            'comment_notes_before' => '',
            'comment_notes_after' => '',
            'title_reply' => '',
            'title_reply_to' => '',
            'cancel_reply_link' => 'Cancel reply',
            'label_submit' => __('Submit Comment', MD_THEME_NAME)
        );
                
        comment_form($fields); 

     endif; // end if comments open check ?>
</div>
