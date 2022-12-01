<!DOCTYPE html>
<html  <?php bloginfo('language'); ?>>
<head>
     <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset'); ?>">
     <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
      <?php get_template_part( '/tool/tdk' );?>
      <?php if (is_single()) { ?>
      <?php } ?><meta name="renderer" content="webkit"/>
	  <meta name="force-rendering" content="webkit"/>
	  <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1"/>
	  <?php if( get_option("logo_f_img") ){  ?> <link rel="shortcut icon" href="<?php echo get_option("logo_f_img") ;?>"><link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_option("logo_f_img") ;?>" />
      <link rel="Bookmark" href="<?php echo get_option("logo_f_img") ;?>">
      <?php } ?>
      <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>?Version=<?php $theme = wp_get_theme(); echo $theme->get( 'Version' ); ?>">
	  <?php if( get_option("bannerFlag") == 1 ){  ?><link rel="stylesheet" href="<?php bloginfo('template_url');?>/static/css/swiper.min.css"> 
	  <?php } ?> <style> <?php if ( get_option("colors") ) { ?>  :root{   --main-color: <?php echo get_option("colors"); ?> !important } <?php }  
	    if ( get_option("blackM")==1 ) {   get_template_part( 'static/css/black' );  } 
	    if ( get_option("grayCopy") ) { ?> html{filter: grayscale(100%); -webkit-filter: grayscale(100%);-moz-filter: grayscale(100%); -ms-filter: grayscale(100%);-o-filter: grayscale(100%); filter: url("data:image/svg+xml;utf8,#grayscale");filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=1);-webkit-filter: grayscale(1);}
      <?php } ?>
      </style>
     <?php if(!is_home()){  wp_head();  } ?> <?php if(!is_home()){ ?> 
      <?php }else { ?>  <script src="https://cdn.bootcdn.net/ajax/libs/jquery/3.6.0/jquery.min.js"></script>  <?php } ?>
    
</head>
<body <?php body_class(); ?> id="top">
	<?php if( is_home() ){ if( get_option("topImg") == 1 ){ ?> <div class="header-img">
	    <?php  if(  !get_option('header_img') ){  ?> 
	    <img  src="<?php bloginfo('template_url');?>/images/header.jpg" alt="顶部广告" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>">
	    <?php  } else { ?>
	    <img  src="<?php echo get_option('header_img'); ?>" alt="顶部广告" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>">
	    <?php }  ?>
    </div> <?php }  } ?>
    <?php if( get_option("boomSwitch") == 1 ){ ?>
     <!--弹框-->
    <style type="text/css">
    	html .web-center-boom img{width: min(500px,60vw);border-radius: 12px;-webkit-filter: grayscale(0);filter: grayscale(0);-moz-filter: grayscale(0); -ms-filter: grayscale(0);-o-filter: grayscale(0); filter: url("data:image/svg+xml;utf8,#grayscale");filter:progid:DXImageTransform.Microsoft.BasicImage(grayscale=0);-webkit-filter: grayscale(0);}
    </style>
    <div class="qui-boom web-center-boom">	
    	<div class="qui-boom-center text-center">
    	    <?php if( get_option("boomLink01") ) { ?>
    	        <a href="<?php echo get_option("boomLink01"); ?>" target="_blank">
    	            <img src="<?php echo get_option("boom_01");  ?>" alt="qui-pure居中弹框图"/>
    	        </a>
    	    <?php }else{ ?>
    	         <img src="<?php echo get_option("boom_01");  ?>" alt="qui-pure居中弹框图"/>
    	    <?php } ?>
    		<br />
    		<svg t="1620778756487" class="icon hand qui-close-btn" style="opacity: 0.6" viewBox="0 0 1025 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="2750" width="44" height="44"><path d="M874.020877 874.019125c-199.931835 199.974501-524.106414 199.974501-724.038249 0-199.974501-199.931835-199.974501-524.106414 0-724.03825 199.931835-199.974501 524.106414-199.974501 724.038249 0 199.974501 199.931835 199.974501 524.106414 0 724.03825zM813.691467 210.310285C647.081605 43.700423 376.9219 43.700423 210.312037 210.310285 43.702175 376.920147 43.702175 647.079853 210.312037 813.689715c166.609862 166.609862 436.769567 166.609862 603.37943 0 166.609862-166.609862 166.609862-436.769567 0-603.37943zM726.951941 719.398346l-7.551843 7.551843a37.28989 37.28989 0 0 1-52.777567 0l-154.620779-154.620779-150.86619 150.86619a42.665778 42.665778 0 0 1-60.32941-60.372075l150.86619-150.823525-154.620778-154.620779a37.28989 37.28989 0 0 1 0-52.777567l7.551842-7.551843a37.28989 37.28989 0 0 1 52.777567 0l154.620779 154.620779 150.866191-150.86619a42.665778 42.665778 0 0 1 60.329409 60.32941l-150.86619 150.86619 154.620779 154.620779a37.28989 37.28989 0 0 1 0 52.777567z" p-id="2751" fill="#ffffff"></path></svg>
    	</div>
    </div>
    <?php } ?>
    <!-- header start -->
    <div class="header shadow">
        <div class="content">
            <div class="logo-box"><?php if( get_option("logo_img") ) { ?>
				<a class="logo-a" href="<?php bloginfo('url'); ?>" rel="home" alt="<?php echo bloginfo( 'name' ); ?>" title="<?php echo bloginfo( 'name' ); ?>"> <img alt="<?php echo bloginfo( 'name' ); ?>官网Logo"  src="<?php echo get_option("logo_img") ?>"></a>
				<?php }else{ ?><a class="logo-a" href="<?php bloginfo('url'); ?>" rel="home" alt="<?php echo bloginfo( 'name' ); ?>" title="<?php echo bloginfo( 'name' ); ?>"><?php bloginfo('name'); ?></a><?php }?></div>
            <nav class="nav">
                <div id="menu-primary" class="nav-list u-plain-list"> <?php if(function_exists('wp_nav_menu')) wp_nav_menu(array('container' => false, 'theme_location' => 'main-nav')); ?></div>
            </nav>
            <div class="wap_mune">
					<svg t="1595571870180" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="2900" width="34" height="34"><path d="M455.212 532.79c56.378 110.245 191.453 153.914 301.699 97.536 110.246-56.378 153.914-191.454 97.536-301.7-56.378-110.245-191.453-153.914-301.699-97.536-110.246 56.378-153.914 191.454-97.536 301.7z m115.372-266.821c90.983-46.528 202.458-10.49 248.985 80.494 46.528 90.983 10.489 202.457-80.494 248.985-90.983 46.527-202.458 10.488-248.985-80.495-46.528-90.983-10.489-202.458 80.494-248.984z m308.508 535.75L815.74 677.836c-6.982-13.654-23.711-19.062-37.366-12.08l-6.445 3.296c-13.654 6.982-19.062 23.712-12.08 37.366L823.2 830.3c6.983 13.654 23.713 19.063 37.367 12.08l6.445-3.295c13.654-6.984 19.063-23.713 12.08-37.367z m-744.79-550.117h302.591c12.177 0 22.048-9.87 22.048-22.047s-9.871-22.047-22.048-22.047H134.302c-12.177 0-22.047 9.87-22.047 22.047s9.87 22.047 22.047 22.047z m0 197.711h224.027c12.176 0 22.047-9.87 22.047-22.047s-9.87-22.047-22.047-22.047H134.302c-12.177 0-22.047 9.87-22.047 22.047s9.87 22.047 22.047 22.047z m0 197.711H423.29c12.176 0 22.047-9.87 22.047-22.047 0-12.176-9.871-22.047-22.047-22.047H134.302c-12.177 0-22.047 9.87-22.047 22.047-0.001 12.175 9.87 22.047 22.047 22.047zM729.027 802.43H132.512c-11.189 0-20.258 9.07-20.258 20.258s9.07 20.258 20.258 20.258h596.515c11.189 0 20.258-9.07 20.258-20.258s-9.07-20.258-20.258-20.258z" fill="" p-id="2901"></path></svg>
				 </div>
				 <?php   if( get_option("hidelogin") == 0 ) { ?>
            <div class="login-box">
                <?php if (is_user_logged_in()){ ?><aside class="loginout-box">
                        <a href="/user/?pd=info" class="loginout-ava">
                            <?php global $current_user;wp_get_current_user();echo get_avatar( $current_user->user_email, 32); ?>
                        </a> 
                        <ul class="loginpout-list">
                             <li><a href="/user?pd=info"><?php global $current_user; echo esc_attr( $current_user->nickname ) ?></a></li>
                             <?php if( is_administrator() ) { ?>
                             <li><a href="/wp-admin/">管理后台</a></li>
                             <?php } ?>
                             <li><a href="/user?pd=cang">我的收藏</a></li>
                             <li><a href="/user?pd=money">我的金币</a></li>
                             <li><a href="/user?pd=pass">修改密码</a></li>
                             <li><?php $url_this = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"]; ?> <a href="<?php echo wp_logout_url($url_this); ?>">退出登录</a></li>
                        </ul>
                    </div>
                <?php  }else{ ?>
                    <div class="login-box-init">
                         <a href="<?php echo wp_login_url( home_url(add_query_arg(array(),$wp->request)) ); ?>">登录</a>
                         <a class="active" href="/wp-login.php?action=register">注册</a> 
                    </div>
                <?php  }  ?>
            </div>
             <?php  }  ?>
            <div class="topSearch">
                <div class="topSearchIcon">
					   <svg t="1598263540799" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="2165" width="40" height="40"><path d="M352.256 684.544c-7.68 0-14.848-3.072-20.48-8.704-58.368-58.368-82.432-141.312-64.512-222.208 3.584-15.872 19.456-25.6 34.816-22.016 15.872 3.584 25.6 18.944 22.016 34.816-13.824 60.928 4.608 123.904 48.64 167.936 11.264 11.264 11.264 30.208 0 41.472C367.104 681.472 359.936 684.544 352.256 684.544z" p-id="2166" fill="#8a8a8a"></path><path d="M494.592 229.376c74.24 0 143.872 28.672 196.096 81.408 52.224 52.224 81.408 121.856 81.408 196.096 0 74.24-28.672 143.872-81.408 196.096-52.224 52.224-121.856 81.408-196.096 81.408-74.24 0-143.872-28.672-196.096-81.408-108.032-108.032-108.032-284.16 0-392.192C351.232 258.048 420.864 229.376 494.592 229.376M494.592 171.008c-86.016 0-172.032 32.768-237.568 98.304-131.072 131.072-131.072 343.552 0 474.624 65.536 65.536 151.552 98.304 237.568 98.304 86.016 0 172.032-32.768 237.568-98.304 131.072-131.072 131.072-343.552 0-475.136C666.624 203.776 580.608 171.008 494.592 171.008L494.592 171.008z" p-id="2167" fill="#8a8a8a"></path><path d="M903.68 926.72c-7.68 0-14.848-3.072-20.48-8.704L706.56 741.888c-11.264-11.264-11.264-30.208 0-41.472 11.264-11.264 30.208-11.264 41.472 0l176.128 176.128c11.264 11.264 11.264 30.208 0 41.472C918.528 923.648 910.848 926.72 903.68 926.72z" p-id="2168" fill="#8a8a8a"></path>
					   </svg>
                </div> 
            </div>
         </div>
    </div>
    
    <div class="qui-boom-bai">
			<div class="content">
				<div class="seach-boom">
					<h2>嗖一下，答案就来了！</h2>
	                <form method="get" class="search-boom-form" action="<?php bloginfo('url'); ?>">
	                    <input class="search-input"  placeholder="输入关键词进行搜索…" autocomplete="off" value="" name="s" autofocus required="true" type="search">
	                    <button type="submit" class="search-boom-submit">
	                        <svg t="1621995565350" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="4653" width="44" height="44">
	                        	<path d="M472.615385 905.846154a433.230769 433.230769 0 1 0 0-866.461539 433.230769 433.230769 0 0 0 0 866.461539z m0-78.769231a354.461538 354.461538 0 1 1 0-708.923077 354.461538 354.461538 0 0 1 0 708.923077z"  p-id="4654"></path>
	                        	<path d="M715.697231 755.081846a39.384615 39.384615 0 0 1 55.689846 0l167.069538 167.069539a39.384615 39.384615 0 1 1-55.689846 55.689846l-167.069538-167.069539a39.384615 39.384615 0 0 1 0-55.689846z m55.689846 55.689846a39.384615 39.384615 0 0 0 0-55.689846l167.069538 167.069539a39.384615 39.384615 0 1 0-55.689846 55.689846l-167.069538-167.069539a39.384615 39.384615 0 0 0 55.689846 0z"  p-id="4655"></path>
	                        </svg>
	                    </button>
	                </form>
	                <div class="colse-bai">
	                	<svg t="1621998821855" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="2363" width="44" height="44"><path d="M587.19 506.246l397.116-397.263a52.029 52.029 0 0 0 0-73.143l-2.194-2.194a51.98 51.98 0 0 0-73.143 0l-397.068 397.8-397.068-397.8a51.98 51.98 0 0 0-73.143 0l-2.146 2.194a51.054 51.054 0 0 0 0 73.143l397.069 397.263L39.544 903.461a52.029 52.029 0 0 0 0 73.142l2.146 2.195a51.98 51.98 0 0 0 73.143 0L511.9 581.583l397.068 397.215a51.98 51.98 0 0 0 73.143 0l2.194-2.146a52.029 52.029 0 0 0 0-73.143L587.19 506.246z" p-id="2364"></path></svg>
	                </div>
				</div>
			</div>
    </div>