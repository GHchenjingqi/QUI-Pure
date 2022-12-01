<?php 
/* Template Name:打赏排行榜 */ 
?>
<?php 
get_header(); 
// Require login for site
get_currentuserinfo();
global $user_ID;
if ($user_ID == '') {
    header('Location: /wp-login.php'); 
    exit();
}
?>
 <main>
     <style>
         .rewardbg{width:100%;height:auto;min-height:640px;background:url("https://course.51qux.com/wp-content/themes/qui/images/rewordbg.png") no-repeat;border-radius: 10px;background-position: top center;background-size: cover;}
         .reward-list-item{width: 94%;height:auto;overflow:hidden;line-height:2.8;padding:0 3%;border-bottom:1px solid #f5f5f5;}
         .rw-tt{width: 45%;float:left}
         .rw-name{width: 10%;float: left;margin-left:5%}
         .rw-price{width: 10%;margin-left:5%}
         .rw-time{margin-left:5%;color:#999;}
         .rw-table{height:auto;font-size:16px;width:86%;overflow:hidden;background:rgba(252,231,215,.8);border-radius:12px;margin-left:7%}
         .rw-list{max-height:280px;overflow:hidden;}
         .rw-table .tit{height: 50px;line-height:50px;background: #f7a773;color: #fff;font-weight: 600;overflow:hidden;display:block;border-radius:12px 12px 0 0}
         .width45{width:48%;float:left;padding-left:3%}
         .width15{width:9.5%;float:left;}.width16{width:13%;float:left;}
         .width10{width:9%;float:left}.tab{height:auto;overflow:hidden;}
         .tabTitle{font-size:36px;font-weight:600;color:#13568d;}.mt30{margin-top:30px;}
         .tabPanle .left{width:93%;height:auto;overflow:hidden;padding-top:30px;margin-left:7%}
         .tabPan1{width:120px;height:36px;line-height:36px;text-align:center;border-radius:8px;border:1px solid var(--main-color);margin-top:20px;float:left;margin-right:16px}
         .tabPan1 a{display:block;color:var(--main-color);font-size:18px;}
         .tabPan1 a:hover{color:#fff;background:var(--main-color);border-radius:8px;overflow:hidden;}
     </style>
       <section class="content">
            <!-- 二级页面包屑 -->
            <div class="breadwrap text-h1">导航：<a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a>/ 打赏榜</div>   
            <article class="rewardbg mt20"> 
                <section class="p20">
                    <div class="tab p20">
            			<div class="tabTitle fw6 text-center mt5">主题不错，鼓励一下作者！</div>
            		</div>
                    <div class="rw-table mt30">
                        <div class="tit">
                            <span class="width45">站内打赏</span>
                            <span class="width15">打赏者</span>
                            <span class="width16">作者</span>
                            <span class="width10">打赏金额</span>
                            <span class="width20">时间</span>
                        </div>
                        <div class="rw-list" id="parent">
                            <div class="slider" id="list">
                                <?php
                                    if(getOrderList()){
                                       getOrderList();
                                    }
                                ?>
                            </div>
                             <div class="slider2" id="list1"></div>
                        </div>
                    </div>
                    	<div class="tabPanle">
            			    <div class="left">
            			        <p class="f16">我也支持一下：</p>  
            			        
            			        <div class="tabPan1">
                                    <a href="https://course.51qux.com/wp-content/plugins/erphpdown/payment/f2fpay.php?ice_money=11.8" target="_blank">加个鸡腿</a>
                				</div>
                				<div class="tabPan1">
                                    <a href="https://course.51qux.com/wp-content/plugins/erphpdown/payment/f2fpay.php?ice_money=19.8" target="_blank">来碗面条</a>
                				</div>
                				<div class="tabPan1">
                                    <a href="https://course.51qux.com/wp-content/plugins/erphpdown/payment/f2fpay.php?ice_money=32" target="_blank">喝杯咖啡</a>
                				</div>
                				<div class="tabPan1">
                                    <a href="https://course.51qux.com/wp-content/plugins/erphpdown/payment/f2fpay.php?ice_money=98.8" target="_blank">今晚吃鸡</a>
                				</div>
                				<div class="tabPan1">
                                    <a href="https://course.51qux.com/wp-content/plugins/erphpdown/payment/f2fpay.php?ice_money=128" target="_blank">支持正版</a>
                				</div>
                				<div class="tabPan1">
                                    <a href="https://course.51qux.com/wp-content/plugins/erphpdown/payment/f2fpay.php?ice_money=198" target="_blank">火箭起飞</a>
                				</div>
            			    </div>
            			  </div>
                </section> 
            </article>
         </section>
</main>
<?php  wp_reset_query();  get_footer(); ?>
