    <?php 
    // page页面
    get_header();
    ?> 
     <main>
         <section class="content">
             <!-- 二级页面包屑 -->
            <div class="breadwrap text-h1">导航：<a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>/<?php  qui_breadcrumb(); ?></div>   
            <article class="main  mt20"> 
                <section class="p20 bgff p-r shadow">
                <?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?> 
                    <div class="post"  id="post-<?php the_ID(); ?>">
                        <h2><?php the_title(); ?></h2>
                        <div class="post-info border-bottom">
                            <span><i class="gg-bookmark tc8 qui-icons-info mr5"></i><q><?php the_author(); ?></q></span> <span><i class="gg-alarm tc7 qui-icons-info mr5"></i> <time><?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ) ?></time> </span> <span><i class="gg-read tc7 qui-icons-info"></i> <b class="ml10"><?php  get_post_views($post -> ID); ?>人阅读</b>  </span>
                        </div> 
                        <div class="post-content">
                            <!-- 文章广告 start -->
                            <?php 
                                if( get_option("ad_single") ) {
                            ?>
                            <?php echo get_option("ad_single"); ?>
                            <?php 
                            }
                            ?>
                            <!-- 文章广告 end -->
                            <?php the_content(); ?> 
                        </div>
                    </div>
                    <div class="post-like text-center">
                            <!-- 点赞 --><a href="javascript:;" data-action="ding" data-id="<?php the_ID(); ?>" class="favorite<?php if(isset($_COOKIE['bigfa_ding_'.$post->ID])) echo ' done';?>">赞<span class="count">
                                    <?php 
                                        if( get_post_meta($post->ID,'bigfa_ding',true) ){
                                            echo get_post_meta($post->ID,'bigfa_ding',true);
                                        } else {
                                            echo '0';
                                        }
                                    ?>
                                </span>
                            </a>
                            <!-- 收藏 -->
                            <?php
                            $shoucang1 = explode(',',get_post_meta(get_the_ID(),'shoucang',true));
                            $shoucang = array_filter($shoucang1);
                            $user = get_current_user_id();
                            ?>
                            <a class="shoucang <?php if(in_array($user,$shoucang)){ foreach($shoucang as $k=>$v){if($v==$user){echo "done";}}} ;?>" data-id="<?php the_ID();?>" href="javascript:;">
                            <span><?php if(in_array($user,$shoucang)){ foreach($shoucang as $k=>$v){if($v==$user){echo "收藏成功";}}}else{ echo '收藏';} ;?></span>
                            </a>
                    </div>
                    <!-- 标签 -->
                    <?php
                            if(get_the_tag_list()) {
                                echo get_the_tag_list('<div class="post-tags"><p>标签:','','</p>
                                </div>');
                            }
                    ?>
                <?php endwhile; ?>
                <?php endif; ?>
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
       