<!-- 搜索结果列表 -->
<?php get_header(); ?>
<main> 
    <section class="content">
            <article class="mt20"> 
                <section class="p20 bgff p-r br10">
                    <section class="search-result-box">
                        <p class="f16 cor66 mtb25"> 关于 “<?php echo $s; ?>” <?php global $wp_query; echo '共搜到 ' . $wp_query->found_posts . ' 篇文章';?></p>
                        <?php if ( !have_posts() ) : ?>
                        <h2 class="f24 text-center mtb25">姿势不对？换个词搜一下~</h2>
                        <aside class="search-result border-bottom">
                            <form method="get" class="search-form inline" action="<?php bloginfo('url'); ?>">
                                <input class="search-field" placeholder="输入关键词进行搜索…" autocomplete="off" value="" name="s" required="true" type="search">
                                <button type="submit" class="search-submit"><i class="iconfont icon-sousuo"></i> 搜</button>
                            </form>
                        </aside>
                        <?php else: ?>
                        <div class="post-list">
                        <ul>
                        <?php while( have_posts() ): the_post(); $p_id = get_the_ID(); ?>
                        <?php get_template_part( 'tool/loop' ); ?>
                        <?php endwhile; ?>
                        </ul>
                        </div>
                        <div class="navigation">
                            <!-- 超过页面设置最大显示长度出现 分页 -->
                            <?php pageNavLink();?> 
                        </div>
                        <?php endif; ?>
                    </section>
        </section>
        </article>
    </section>
</main>
<?php get_footer(); ?>