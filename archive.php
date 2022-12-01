<?php 
    // archive.php 是文章分类归档列表
    get_header();  
    //发布主题去掉下面和底部对应的括号代码 
?> <main> 
     <?php  if( get_option("listtag") == 1 ){   ?> 
			<div class="bgff tab-tags border-top shadow"> 
				<div class="content">
					<?php
						$cat= single_cat_title('', false);
						$args = array( 'categories' => get_cat_ID($cat));
						$tags = get_category_tags($args);
						$content  = "";
						$content .= "<ul class='tab-cat-tag close'><li>推荐</li>";
						if(!empty($tags)) {
							foreach ($tags as $key=> $tag) {
								 if($key>30){break;}
								$content .= "<li><a href=\"".get_tag_link($tag->term_id)."\">".$tag->name."</a></li>";
							}
						}
						$content .= "</ul>";
						echo $content;
					?>
					<span class="open-tag">展开>></span>
        	        <span class="more-tag hide">折叠<<</span>
				 </div>
			  </div>
	 <?php  }  ?> 
			 <div class="content">
			       <!-- 二级页面包屑 -->      
                <?php
                  if( is_category() && is_archive() && is_tag() && is_date() && is_year() && is_month() && is_day() ){
                ?>
                <div class="breadwrap text-h1">导航：<a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>/<?php  qui_breadcrumb(); ?></div>   
                <?php }?>
            <div class="main  mt20"> 
                <div class="p20 bgff p-r br10 shadow"> 
					    <h2 class="title"><?php
					      if( is_tag() ){
					          echo single_cat_title();
					      }
					      if(is_archive()){
					          echo get_the_archive_title();
					      }
					    ?></h2>   
                  
                        <div class="post-list">
                            <ul> 
                            <?php global $i;
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
                     </div>  
                    <?php endif; ?>
                    <?php  wp_reset_query();?>
                 
            </div>  
        </div>
       <?php   if( !wp_is_mobile() ) { ?> 
            <div class="sidebar mt20"> 
                <?php get_sidebar(); ?> 
            </div>
        <?php  } ?> 
    </section>
</main>
<?php get_footer(); ?>

       