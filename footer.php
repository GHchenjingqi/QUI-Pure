<?php if(wp_is_mobile()){ ?>
<div class="wapSlider hide">
	<div class="wapclose"></div>
	<div class="wapSlider-box">
 	<div class="wap-menus">
 		<div id="wap-menu-primary" class="nav-list u-plain-list">
          <?php if(function_exists('wp_nav_menu')) wp_nav_menu(array('container' => false, 'theme_location' => 'main-nav')); ?>
      </div>
 	</div>
 	<div class="wap-search" style="margin-top:5vh">
 		<form method="get" class="search-form inline" action="<?php bloginfo('url'); ?>">
            <input class="search-field" placeholder="输入关键词进行搜索…" autocomplete="off" value="" name="s" required="true" type="search">
            <button type="submit" class="search-submit"><i class="iconfont icon-sousuo"></i> 搜</button>
         </form> 
 	</div>
 	<?php   if( get_option("hidelogin") == 0 ) { ?>
 	<div class="wap-login">
 		<?php if (is_user_logged_in()){ ?>
        <div class="wap-loginout-box">
            <a href="/user/?pd=info">
      			<?php echo get_avatar( get_the_author_meta('email'), '48' );?>
            </a>
              <?php wp_loginout(); ?> 
         </div>
         <?php  }else{ ?>
         <div class="login-box-init">
            <a href="/wp-login.php?action=register">注册</a>|  <a href="<?php echo wp_login_url( home_url(add_query_arg(array(),$wp->request)) ); ?>">登录</a>
         </div>
         <?php  }  ?>
 	</div>
 	 <?php  }  ?>
 	
 </div>
</div>
<?php  } ?>
<footer class="bgff mt20" style="padding:20px 0 10px 0"> 
    <div class="content">
        <div class="box mt20">
            <div  class="footer-content left">
                <div class="footer-logo">
                	<?php if(get_option("logo_img") ) { ?> <img src="<?php echo get_option("logo_img") ?>" title="<?php echo bloginfo( 'name' ); ?>官网Logo" alt="<?php echo bloginfo( 'name' ); ?>官网Logo">
                    <?php }else{ ?>
                    	<h3><?php echo bloginfo( 'name' ); ?></h3>
                     <?php } ?>
                    <p><?php echo get_option("description"); ?></p>
                </div>
                <?php wp_reset_query(); if( is_home()&&!is_paged() )   {   if( get_option("weblink") == 1){  ?> <div class="web-link text-left"><p>友情链接: <?php wp_list_bookmarks('title_li=0&categorize=0&before=&nbsp&after=&nbsp;'); ?><a href="http://course.51qux.com" target="_blank">Qux-Pure主题</a> <a href="/link" target="_blank">申请友链</a> </p> </div>   <?php } } ?> 
            </div>
            <div class="footer-img right">
                <?php   if (get_option("qq_img")) { ?>
                   <div class="qq-item text-center">
                       <img src="<?php echo get_option("qq_img") ?>" title="<?php echo bloginfo( 'name' ); ?>官网QQ群" alt="<?php echo bloginfo( 'name' ); ?>官网QQ群" />
                       <P><a>加入QQ群</a></P>
                   </div> 
                   <?php  } ?>
            </div>
        </div>
    </div>
</footer>
<div class="box">
     <div class="content">
          <div class="website-info flex aic jcsb">
                <p> CopyRight © <?php the_time('Y') ?> &nbsp; &nbsp; <?php bloginfo('name'); ?>.All Rights Reserved.
                 <?php if( get_option("gongan") ) { ?><img src="<?php bloginfo('template_url'); ?>/images/gongan.png" style="vertical-align:middle" title="公安备案" alt="公安备案" />
                <a href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=<?php echo preg_replace('/([\x80-\xff]*)/i','',get_option("gongan")) ?>" style="display:inline-block;text-decoration:none;height:20px;line-height:20px;" target="_blank"><?php echo get_option("gongan");?></a><?php  } ?> &nbsp; &nbsp;
                  <?php if( get_option("beian") ) { ?><a rel="nofollow" target="_blank" href="https://beian.miit.gov.cn/#/Integrated/index"><?php echo get_option("beian");?></a><?php  } ?> &nbsp; &nbsp;
                   <?php if( get_option("siteMap") ) { ?><a target="_blank" class="hide" href="<?php echo get_option("siteMap");?>">网站地图</a>  <?php  } ?>  &nbsp; &nbsp;
                   QUI-Pure主题 · Theme By：<a class="cor99" target="_blank" href="https://51qux.com/">QUX</a>&<a class="cor99" target="_blank" href="https://course.51qux.com/">七娃博客&nbsp; &nbsp;
                   网站响应速度<?php timer_stop(1); ?> 
                </p> 
                <p ></a>
                </p> 
           </div>  
     </div>
</div>

<div class="go-top">
		 	<a class="hand" onclick="goto('top')"  title="回到顶部">
		 		<svg t="1604108034346" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="3068" width="48" height="48"><path d="M752.736 431.063C757.159 140.575 520.41 8.97 504.518 0.41V0l-0.45 0.205-0.41-0.205v0.41c-15.934 8.56-252.723 140.165-248.259 430.653-48.21 31.457-98.713 87.368-90.685 184.074 8.028 96.666 101.007 160.768 136.601 157.287 35.595-3.482 25.232-30.31 25.232-30.31l12.206-50.095s52.47 80.569 69.304 80.528c15.114-1.23 87-0.123 95.6 0h0.82c8.602-0.123 80.486-1.23 95.6 0 16.794 0 69.305-80.528 69.305-80.528l12.165 50.094s-10.322 26.83 25.272 30.31c35.595 3.482 128.574-60.62 136.602-157.286 8.028-96.665-42.475-152.617-90.685-184.074z m-248.669-4.26c-6.758-0.123-94.781-3.359-102.891-107.192 2.95-98.714 95.97-107.438 102.891-107.93 6.964 0.492 99.943 9.216 102.892 107.93-8.11 103.833-96.174 107.07-102.892 107.192z m-52.019 500.531c0 11.838-9.42 21.382-21.012 21.382a21.217 21.217 0 0 1-21.054-21.34V821.74c0-11.797 9.421-21.382 21.054-21.382 11.591 0 21.012 9.585 21.012 21.382v105.635z m77.333 57.222a21.504 21.504 0 0 1-21.34 21.626 21.504 21.504 0 0 1-21.34-21.626V827.474c0-11.96 9.543-21.668 21.299-21.668 11.796 0 21.38 9.708 21.38 21.668v157.082z m71.147-82.043c0 11.796-9.42 21.34-21.053 21.34a21.217 21.217 0 0 1-21.013-21.34v-75.367c0-11.755 9.421-21.299 21.013-21.299 11.632 0 21.053 9.544 21.053 21.3v75.366z" fill="" p-id="3069"></path></svg>
		 	</a>
 </div>
    <!-- 引入js -->
    <script src="<?php bloginfo('template_url'); ?>/main.js"></script><!-- 网站统计 -->
    <?php if (get_option("web_static")) { ?><?php echo get_option("web_static");  }  
    wp_reset_query(); 
    if ( is_home() ) {  
       if( get_option("bannerFlag") == 1 ){  ?>
           <script src="<?php bloginfo('template_url');?>/static/js/swiper.min.js"></script>
           <script>
              var swiper = new Swiper('.swiper-container', {
                slidesPerView: '1',
                autoHeight: true,
                autoplay: {
                  delay: 4000,
                  disableOnInteraction: false,
                },
                navigation: { 
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                  el: '.swiper-pagination',
                  dynamicBullets: false,
                  clickable: true,
                },
                effect : 'fade',
                fadeEffect: {
                  crossFade: true,
                },
                zoom: true,
                lazy: true
              }); 
           </script>
<?php }} wp_footer(); ?>
</body>
</html>