<?php if ('open' == $post->comment_status) { ?>
            <?php   $current_user = wp_get_current_user();   if ( 0 == $current_user->ID ) {   ?>
              <p class="loginMsg">登录之后才可留言，<a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>">前往登录</a> </p>
            <?php  } else {  ?> 
                <p class="loginMsg">你已经登录，<a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a></p>
                <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
                <div class="p-r">
    				<textarea name="comment" id="comment" cols="60" rows="10" tabindex="4"></textarea>
    				<input name="submit" type="submit" id="submit" tabindex="5" value="提交留言" />
    				<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
    			</div> 
		        <?php do_action('comment_form', $post->ID); ?> 
		        </form>
            <?php  } ?>  
		 
    		<div class ="comment-list box">
    			<?php wp_list_comments(array('style'=>'div','avatar_size' => 40)); ?>
    		</div>
<?php  } wp_reset_query();  ?>
 