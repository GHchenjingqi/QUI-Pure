<?php 
    // single.php 是文章页面
    get_header(); 
    //发布主题去掉下面和底部对应的括号代码
?>
     <main>
         <div class="content">
            <!--二级页面包屑 -->
            <div class="breadwrap text-h1">导航：<a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>/<?php  qui_breadcrumb(); ?></div>  
            <div class="main  mt20"> 
                <div class="p20 bgff p-r br10 shadow">
                <?php if(have_posts()) : ?><?php while(have_posts()) : the_post(); ?> 
                    <div class="page_tag"><?php the_category(',') ?></div>   
                    <div class="post"  id="post-<?php the_ID(); ?>">
                        <h1><?php the_title(); ?></h1>
                        <div class="post-info border-bottom">
                            <span><i class="gg-bookmark tc8 qui-icons-info mr5"></i><q><?php the_author(); ?></q></span> <span><i class="gg-alarm tc7 qui-icons-info mr5"></i> 
                            <time><?php echo timeago( get_gmt_from_date(get_the_time('Y-m-d G:i:s')) ) ?></time> </span> <span><i class="gg-read tc7 qui-icons-info"></i> <b class="ml10"><?php  get_post_views($post -> ID); ?>人阅读</b>  </span>
                        </div>
                        <div class="post-content"> 
                            <!-- 文章广告 start -->
                            <?php if( get_option("ad_single") ) {   ?><div class="article-gg"><?php echo get_option("ad_single");  ?></div><?php } ?>
                            <!-- 文章广告 end -->
                            <?php the_content(); ?> 
                        </div>
                    </div>
                    <div class="post-like text-center">
                            <!-- 点赞 --><a href="javascript:;" data-action="ding" data-id="<?php the_ID(); ?>" class="favorite<?php if(isset($_COOKIE['bigfa_ding_'.$post->ID])) echo ' done';?>">赞<span class="count"> <?php 
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
                            <span><?php if(in_array($user,$shoucang)){ foreach($shoucang as $k=>$v){if($v==$user){echo "已收藏";}}}else{ echo '收藏';} ;?></span>
                            </a>
                            <!--分享-->
                            <span class="CreatCode">分享</span>    
                        <!--分享海报start-->
                        <div class="qui-boom canvas-baner hide">
                            <div class="qui-boom-center canvas-box">
                        		    <div id="canvas" class="saveImgMsg">
                        				<img class="canvasImg" src="<?php if( get_content_first_image(get_the_content()) ){ echo get_content_first_image(get_the_content());}else{ echo bloginfo('template_url').'/static/img/none.jpg';} ?>" crossorigin="anonymous" alt="" />
                        				<h3><?php the_title(); ?></h3>
                        				<p><?php bloginfo('url'); ?></p>
                        				<div id="qrcode"></div>
                        				<img class="canvasLogo" src="<?php echo get_option("logo_img") ?>" crossorigin="anonymous" alt="" />
                        			</div>
                        	    	<div class="close-boom"><svg t="1614608110914" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1148" width="44" height="44"><path d="M583.168 523.776L958.464 148.48c18.944-18.944 18.944-50.176 0-69.12l-2.048-2.048c-18.944-18.944-50.176-18.944-69.12 0L512 453.12 136.704 77.312c-18.944-18.944-50.176-18.944-69.12 0l-2.048 2.048c-19.456 18.944-19.456 50.176 0 69.12l375.296 375.296L65.536 899.072c-18.944 18.944-18.944 50.176 0 69.12l2.048 2.048c18.944 18.944 50.176 18.944 69.12 0L512 594.944 887.296 970.24c18.944 18.944 50.176 18.944 69.12 0l2.048-2.048c18.944-18.944 18.944-50.176 0-69.12L583.168 523.776z" p-id="1149" fill="#ffffff"></path></svg></div>
                        	    	<p class="tipinfo">点击图片即可下载</p>
                        </div></div></div>
                         <!--分享海报end-->
                    <?php if( get_option("sangFlag") && get_option("sang_txt") && get_option("sang_img") ) { ?>
                    <!--打赏-->
                    <div class="reward-box">
                        <?php if( get_option("sang_txt") ) { ?>
                        <p class="sangp"> <?php echo get_option("sang_txt"); } else{ echo '开源不易，支持一下作者！'; ?></p>
                        <?php } ?>
                        <div class="flex aic jcc"> 
                           <?php if( get_option("sang_img") ) { ?>
                            <div class="text-center">
                                <img class="brzfb" src="<?php echo get_option("sang_img"); ?>" alt=""/>
                                <p class="corzfb">使用支付宝打赏</p> 
                            </div>
                            <?php } if( get_option("sangwx_img") ) { ?>
                            <div class="text-center">
                                <img class="brwx" src="<?php echo get_option("sangwx_img"); ?>" alt=""/>
                                <p class="corwx">使用微信打赏</p> 
                            </div>
                            <?php } ?>
                        </div>
                     </div>
                    <?php } ?>
                    <!-- 标签 -->
                    <?php if(get_the_tag_list()) {
                                echo get_the_tag_list('<div class="post-tags"><p>TAGS:','','</p></div>');
                      } ?>
                    <?php endwhile; ?>
                    <!-- 文章版权信息 -->
                            <?php  $custom_fields = get_post_custom_keys();
                            if (!in_array ('copyright', $custom_fields)) : ?>
                            <div class="postcopyright">
                                <div><strong>版权声明：</strong>原创作品，允许转载，转载时请务必以超链接形式标明文章 <a href="<?php the_permalink() ?>" title="<?php the_title(); ?>" target="_blank" style="color:var(--main-color)" style="text-decoration:underline">原始出处</a> 、作者信息和本声明。否则将追究法律责任。</div>
                                <div style="margin-top:10px">转载请注明来源：<a style="color:var(--main-color)" href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a> - <a style="color:var(--main-color)" href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a></div>
                                <div style="margin-top:10px"><strong>原文地址：</strong> <a style="color:var(--main-color)" target="_blank" rel="nofollow" href="<?php the_permalink() ?>" ><?php the_permalink() ?></a>
                                </div> 
                            </div>
                            <?php else: ?>
                            <?php  $custom = get_post_custom($post_id);
                            $custom_value = $custom['copyright']; ?>
                            <div class="postcopyright">
                                <div><strong>版权声明: </strong>转载作品，本文来源于 <a rel="nofollow" style="color:var(--main-color)" href="/go.php?url=<?php echo $custom_value[0] ?>" target="_blank" style="text-decoration:underline"><?php echo $custom_value[0] ?></a> ，由(<a style="color:var(--main-color)" href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"> <?php the_author(); ?> </a>) 整编而成。</div>
                                <div style="margin-top:10px"><strong>原文地址：</strong> <a style="color:var(--main-color)" target="_blank" rel="nofollow" href="<?php echo $custom_value[0] ?>" ><?php echo $custom_value[0] ?></a></div> 
                            </div>
                            <?php endif; ?>
                            
                        </div>  
                <?php if( get_option("ad_single") ) {   ?><div class="article-gg" style="margin-bottom:10px"><?php echo get_option("ad_single");  ?></div><?php } ?>
                <div class="pagelink bgff box border-top">
                    <div class="pre col2 left">
                        上篇：
                        <?php
                        $prev_post = get_previous_post();
                        if ( ! empty( $prev_post ) ): ?>
                            <a class="text-h1" href="<?php echo get_permalink( $prev_post->ID ); ?>">
                                <?php echo apply_filters( 'the_title', $prev_post->post_title ); ?>
                            </a>
                        <?php else: ?>
                        <span>没有上一篇了</span>
                        <?php endif;?>
                    </div>
                    <div class="next col2 left">
                        下篇：
                        <?php
                        $next_post = get_next_post();
                        if(!empty($next_post)):?>
                            <a class="text-h1" href="<?php echo get_permalink( $next_post->ID ); ?>">
                                <?php echo apply_filters( 'the_title', $next_post->post_title ); ?>
                            </a>
                        <?php else: ?>
                        <span>没有下一篇了</span>
                        <?php endif;?>  
                    </div>     
                </div>
                <?php endif; ?>
            
                <?php  get_template_part( 'tool/relate' ); ?>
            
            <div class="p20 bgff mt20 br10 shadow">
                <!-- 评论 -->
                <div class="comments-template">
                    <h3 class="title">评论 | <?php echo zfunc_comments_users($post->ID); ?> 条评论</h3>
                    <?php comments_template(); ?>
                </div>
            </div> 
        </div>
        <?php   if( !wp_is_mobile() ) { ?> 
            <div class="sidebar mt20"> 
                <?php get_sidebar(); ?> 
            </div>
        <?php  } ?> 
    </div>
</main>
<?php  get_template_part( 'tool/share' ); ?>
<?php   if( get_option("codeCopy") ) {  ?>
  <script type="text/javascript">
	 $("pre").click(function(){
	    var texts = $(this).text();
	    console.log(texts);  
	    var inputs = document.createElement("textarea"); 
	    inputs.setAttribute("id","input_copy");
	    inputs.style = "width:0px;height:0;opacity: 0;";
	　　$("body").append(inputs);  
	    var input = document.getElementById("input_copy");
	    input.value = texts; 
	    input.select(); 
	    document.execCommand("copy");
	    alert("复制成功了，去粘贴吧！")
	}) 
</script>
<?php } ?>
<?php get_footer(); ?>
       