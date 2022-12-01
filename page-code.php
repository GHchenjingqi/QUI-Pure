<?php 
/* Template Name:代码展示模板页面 */ 
?>
<?php get_header(); ?>
<style type="text/css">
	.page-code{max-width:1600px;width:100%;margin: 0 auto;height: auto;overflow: hidden;position:relative}
	.width50{max-width:800px;width:100%;float: left;}
	.page-code-box{height:700px;overflow-y:auto}
	.page-code-ct .post-content{height: 500px;overflow-y:auto;}
	.page-code-ct .post-content h3{padding-left:20px;margin-top:40px}
	.page-code-ct .post-content h3:before{left:0px;}
	.page-code-box .post-content{margin-top:-80px;padding-left:20px}
</style>
<div class="page-code">
    <div class="breadwrap text-h1">导航：<a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>/<?php  qui_breadcrumb(); ?></div>   
	<div class="page-code-ct bgff mt10 width50 shadow" >
		<section class="p20">
                <?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?> 
                    <div class="post"  id="post-<?php the_ID(); ?>">
                        <h2><?php the_title(); ?></h2>
                        <div class="post-info border-bottom">
                            <span><i class="gg-bookmark tc8 qui-icons-info mr5"></i><q><?php the_author(); ?></q></span> <span><i class="gg-alarm tc7 qui-icons-info mr5"></i> <time><?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ) ?></time> </span> <span><i class="gg-read tc7 qui-icons-info"></i> <b class="ml10"><?php  get_post_views($post -> ID); ?>人阅读</b>  </span>  
                        </div>
                        <div class="post-content" style="position: relative;">
                            <!-- 文章广告 end -->
                            <?php the_content(); ?>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php endif; ?>
        </section> 
	</div>
	<div class="page-code-box bgee width50 mt10 ">
	    <section class="p20">
	        <section class="post-content">
	        <h3>效果展示：</h3>
    	    <?php  $cssCode = get_post_meta($post->ID, "cssCode_value", true);
                  echo $cssCode; ?>
    	    <?php $htmlCode = get_post_meta($post->ID, "htmlCode_value", true);
                   echo $htmlCode;?>
    		<?php 
               $scriptCode = get_post_meta($post->ID, "scriptCode_value", true);
                echo  $scriptCode;
             ?>
             </section> 
         </section> 
	</div>
</div>


<?php get_footer(); ?>
