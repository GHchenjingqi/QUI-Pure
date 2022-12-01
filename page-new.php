<?php 
/* Template Name:自定义页面 */ 
?>
<?php get_header(); ?>
 <main>
       <section class="content">
            <!-- 二级页面包屑 -->
            <div class="breadwrap text-h1">导航：<a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>/<?php  qui_breadcrumb(); ?></div>   
            <article class="bgff mt20 shadow"> 
                <section class="p20">
                <?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?> 
                    <div class="post"  id="post-<?php the_ID(); ?>">
                        <h2><?php the_title(); ?></h2>
                        <div class="post-info border-bottom">
                            <span><i class="gg-bookmark tc8 qui-icons-info mr5"></i><q><?php the_author(); ?></q></span> <span><i class="gg-alarm tc7 qui-icons-info mr5"></i> <time><?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ) ?></time> </span> <span><i class="gg-read tc7 qui-icons-info"></i> <b class="ml10"><?php  get_post_views($post -> ID); ?>人阅读</b>  </span>  
                        </div>
                        <div class="post-content" style=" position: relative;">
                            <?php 
                            $cssCode = get_post_meta($post->ID, "cssCode_value", true);
                            echo $cssCode;
                            ?>
                            <!-- 文章广告 end -->
                            <?php the_content(); ?> 
                            <?php $htmlCode = get_post_meta($post->ID, "htmlCode_value", true);
                                echo $htmlCode;?>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php endif; ?>
            </section> 
        </article>
    </section>
</main>
<?php 
   $scriptCode = get_post_meta($post->ID, "scriptCode_value", true);
    echo  $scriptCode;
 ?>
<?php get_footer(); ?>
