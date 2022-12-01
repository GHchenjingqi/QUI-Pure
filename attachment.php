<!-- 附件预览页面，例如图片 -->

<?php 
    get_header(); ?> 
     <main>
         <div class="content">
                <div class="p20 bgff mt20 shadow">
                    <?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?>
                    <div class="post"  id="post-<?php the_ID(); ?>">
                        <h2><?php the_title(); ?></h2>
                        <div class="post-info border-bottom">
                            <span><i class="gg-bookmark tc8 qui-icons-info mr5"></i><q><?php the_author(); ?></q></span> <span><i class="gg-alarm tc7 qui-icons-info mr5"></i> <time><?php the_time('Y-m-d h:m:s') ?></time> </span> <span><i class="gg-read tc7 qui-icons-info"></i> <b class="ml10"><?php  get_post_views($post -> ID); ?>人阅读</b>  </span>
                        </div>
                        <div class="post-content">
                            <!--调用附件 -->
                            <img src=" <?php echo wp_get_attachment_url( get_the_ID() ); ?> " alt="<?php the_title(); ?>">
                        </div>
                    </div>
                    <?php endwhile; ?>
                    <?php endif; ?>
            </div>
    </div>
</main>
<?php get_footer(); ?>
       