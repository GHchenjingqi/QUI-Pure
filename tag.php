<!-- 标签归档页面 -->
<?php get_header(); ?>
<main> 
    <div class="content">
        <div class="main mt20"> 
                <div class="p20 bgff br10 shadow">
					<h2 class="title"><?php echo single_cat_title() ?></h2>
					<div class="post-list">
                        <ul>
					<?php  global $i;
                        $i = 0;
                        // 主循环
                        if ( have_posts() ) : while ( have_posts() ) : the_post();
                            set_query_var('i', $i);
                           get_template_part( 'tool/loop' ); 
                        $i++;
                        endwhile; ?>
					</ul>
					</div>
					<div class="navigation">
                        <!-- 超过页面设置最大显示长度出现 分页 -->
                        <?php pageNavLink();?>  
                    </div>
					<?php endif; ?>
						
				</div>
		</div>
        <?php   if( !wp_is_mobile() ) { ?> 
            <div class="sidebar mt20"> 
                <?php get_sidebar(); ?> 
            </div>
        <?php  } ?> 
    </div>
</main>
<?php get_footer(); ?>