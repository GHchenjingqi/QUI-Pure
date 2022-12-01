
 <?php $cats = wp_get_post_categories($post->ID);
                    if ($cats) {
                ?>
            <div class="p20 bgff mt20 br10 shadow">
                <!--  -->
                <h3 class="title">相关推荐</h3>
                
              <?php  if ( get_option("artCardRec") == 1 ){ ?>
                  <div class="card-rel box">
                      <?php $cat = get_category( $cats[0] );
                    $first_cat = $cat->cat_ID;
                    $args = array(
                            'category__in' => array($first_cat),
                            'post__not_in' => array($post->ID),
                            'showposts' => 9,
                            'ignore_sticky_posts' => 1);
                    query_posts($args);
                    if (have_posts()) : 
                    while (have_posts()) : the_post(); update_post_caches($posts); ?>
                                  <?php  if ( get_content_first_image(get_the_content()) ){ ?>
                        <div class="col4">
                            <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                               <img src="<?php echo get_content_first_image(get_the_content()); ?>" alt="‘<?php the_title(); ?>’的缩略图">
                               <h4 class="text-h2"><?php the_title(); ?></h4>
                            </a>
                        </div>
                        <?php } ?>
                    <?php endwhile; else : ?>
                     <div>暂无相关文章!</div>
                    <?php endif; wp_reset_query(); ?>
                 </div> 
                 <?php } else if(get_option("artCardRec") == 0) { ?>
                <div class="cat_related box">
                   <?php $cat = get_category( $cats[0] );
                    $first_cat = $cat->cat_ID;
                    $args = array(
                            'category__in' => array($first_cat),
                            'post__not_in' => array($post->ID),
                            'showposts' => 6,
                            'ignore_sticky_posts' => 1);
                    query_posts($args);
                    if (have_posts()) : 
                    while (have_posts()) : the_post(); update_post_caches($posts); ?>
                    <div class="col2 text-h1"><a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute();
                    ?>"><?php the_title(); ?></a></div>
                    <?php endwhile; else : ?>
                    <div class="col2">暂无相关文章!</div>
                    <?php endif; wp_reset_query();  ?>
                </div> 
                <?php }  ?>


</div> 
<?php  } ?> 