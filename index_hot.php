   <?php 
    /* Template Name:首页热门 */ 
    ?>
    <?php get_header(); ?>
    <main>
        <div class="content">
            <div class="main  mt20"><!--顶部幻灯片 start-->
                  <?php if( get_option("bannerFlag") == 1 ){ //判断是否开启banner
                      get_template_part( 'tool/slider' );  
                  } ?>
                 <!-- 幻灯片END -->
                  <div class="p20 bgff mb20 br10 shadow">
                      <div class="tab">
            			<div class="tab-title">
            			    <a href="/">最新</a>
            				<a class="active" href="/hot">热门</a>
            			</div>
            			<div class="tab-content">
            				<div class="tab-panle">
            				    <div class="list-box"> 
            				      <ul>
                                    <?php  
                                    query_posts(
                                      array(
                                        'meta_key' => 'views',
                                        'orderby' => 'meta_value_num',
                                        'order' => 'DESC',
                                        'paged' => $paged,
                                        'post__not_in' => get_option( 'sticky_posts')  
                                      )
                                    );
                                     global $i;
                                     $i = 0; 
                                    if ( have_posts() ) : while (have_posts()) : the_post();  
                                        // 主循环
                                           set_query_var('i', $i);
                                           get_template_part( 'tool/loop' ); 
                                        $i++;
                                        endwhile; ?>
                                  </ul>
            				   </div>
            				   <?php pageNavLink();?> 
                                <?php else: ?> 
                                        <p>当前还没有文章！请先发布</p>
                                <?php endif; ?>
                                <?php  wp_reset_query();?>
            				</div>
            				
            			</div>
            		</div>
                  </div>   
            </div>
            <?php   if( !wp_is_mobile() ) { ?> 
            <div class="sidebar mt20"> 
               <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_left_index')) : endif; ?>
            </div>
            <?php  } ?> 
        </div>
    </main>
     <?php get_footer(); ?>
