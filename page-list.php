    <?php 
    /* Template Name: 页面列表*/
    get_header();
    ?> 
     <main>
         <section class="content">
             <!-- 二级页面包屑 -->
            <div class="breadwrap text-h1">导航：<a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>/<?php  qui_breadcrumb(); ?></div>   
            <article class="main  mt20"> 
                <section class="p20 bgff p-r shadow">
                    <div class="list-box">
                   <?php  
                    if($post->post_parent)  
                        $children = wp_list_pages("title_li=&child_of=".$post->post_parent."&echo=0");  
                    else  
                        $children = wp_list_pages("title_li=&child_of=".$post->ID."&echo=0");  
                    if ($children) {  
                        echo '<ul>';  
                            echo $children;  
                        echo '</ul>';  
                    } ?>  
                     </div>
                </section> 
            </article>
        <?php   if( !wp_is_mobile() ) { ?> 
            <aside class="sidebar mt20"> 
                <?php get_sidebar(); ?> 
            </aside>
        <?php  } ?> 
    </section>
</main>
<?php get_footer(); ?>
       