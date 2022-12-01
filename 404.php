<?php
/**
 * The template for displaying 404 pages (not found)
 * 
 */
get_header(); ?>

<main>
        <section class="content">
            <article class="bgff mt20 shadow"> 
                <section class="p20">
                    <div class="page404">
                        <img src="<?php bloginfo('template_url'); ?>/images/404.png" alt="404页面无法找到！">
                        <h1>页面无法追踪到，还是看看其他的吧！</h1>
                    </div>
                </section>
             </article>
        </section>
</main>
<?php get_footer();?>