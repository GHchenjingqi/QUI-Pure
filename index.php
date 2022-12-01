    <?php get_header(); ?>
    <main>
        <div class="content">
            <div class="main  mt20"><!--顶部幻灯片 start-->
                 <?php if( get_option("bannerFlag") == 1 ){ //判断是否开启banner
                         get_template_part( 'tool/slider' );  
                  } ?>
                 <!-- 幻灯片END --><!-- 置顶推荐 -->
                  <?php 
                   get_template_part( 'tool/top' ); 
                  ?> 
                  <div class="p20 bgff mb20 br10 shadow">
                      <div class="tab">
            			<div class="tab-title">
            			    <a class="active" href="/">最新</a>
            				<a href="/hot">热门</a>
            			</div>
            			<div class="tab-content">
            			    <div class="tab-panle">
            				    <div class="list-box"> 
                                   <ul>
                                  <?php
                                        $args=array(
                                        'post_status' => 'publish',
                                        'paged' => $paged,
                                        'ignore_sticky_posts' => 1,
                                        'post__not_in' => get_option( 'sticky_posts' ) 
                                        );
                                        query_posts($args);
                                        global $i;
                                        $i = 0;
                                        // 主循环
                                        if ( have_posts() ) : while ( have_posts() ) : the_post();
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
            <div class="sidebar <?php if( get_option("bannerStyle") == 2){ echo "mt360"; }else { echo "mt20" ;} ?>" > 
                <?php get_sidebar(); ?> 
                <div id="qui-tool-start"></div> 
            </div>
            <?php  } ?> 
        </div>
    </main>
     <?php get_footer(); ?>
