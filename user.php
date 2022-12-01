<?php 
/*
Template Name: QUI-User
Version: erphpdown_v11.2 + QUI改版
*/
if(!is_user_logged_in()){
	echo "<script>window.location.href='".wp_login_url()."';</script>";
}
get_header(); 
global $wpdb, $erphpdown_version;
$user_info=wp_get_current_user();

function mobantu_paging($type,$paged,$max_page) {
	if ( $max_page <= 1 ) return; 
	if ( empty( $paged ) ) $paged = 1;
	
	echo '<div class="pagination" style="float:left"><ul>';
	echo "<li><a class=extend href='?pd=$type&pp=1'>首页</a></li>";
	if($paged > 1){
		echo '<li class="prev-page"><a href="?pd='.$type.'&pp='.($paged-1).'">上一页</a></li>';
	}
	if ( $paged > 2 ) echo "<li><span> ... </span></li>";
	for( $i = $paged - 1; $i <= $paged + 3; $i++ ) { 
		if ( $i > 0 && $i <= $max_page ) 
		{
			if($i == $paged) 
				print "<li class=\"active\"><span>{$i}</span></li>";
			else
				print "<li><a href='?pd=$type&pp={$i}'><span>{$i}</span></a></li>";
		}
	}
	if ( $paged < $max_page - 3 ) echo "<li><span> ... </span></li>";
	if($paged < $max_page){
		echo '<li class="next-page"><a href="?pd='.$type.'&pp='.($paged+1).'">下一页</a></li>';
	}
	echo "<li><a class=extend href='?pd=$type&pp=$max_page'>尾页</a></li>";
	echo '</ul></div>';
}


if(isset($_POST['ice_alipay'])){
	$fee=get_option("ice_ali_money_site");
	$fee=isset($fee) ?$fee :100;
	$userMoney=$wpdb->get_row("select * from ".$wpdb->iceinfo." where ice_user_id=".$user_info->ID);
	if(!$userMoney){
		$okMoney=0;
	}else{
		$okMoney=$userMoney->ice_have_money - $userMoney->ice_get_money;
	
	}
	$ice_alipay = $wpdb->escape($_POST['ice_alipay']);
	$ice_name   = $wpdb->escape($_POST['ice_name']);
	$ice_money  = isset($_POST['ice_money']) && is_numeric($_POST['ice_money']) ?$_POST['ice_money'] :0;
	$ice_money = $wpdb->escape($ice_money);
	if($ice_money<get_option('ice_ali_money_limit'))
	{
		echo '<div class="alert"><p>提现金额至少得满'.get_option('ice_ali_money_limit').get_option('ice_name_alipay').'</p></div>';
	}
	elseif(empty($ice_name) || empty($ice_alipay))
	{
		echo '<div class="alert"><p>请输入支付宝帐号和姓名</p></div>';
	}
	elseif($ice_money > $okMoney)
	{
		echo '<div class="alert"><p>提现金额大于可提现金额'.$okMoney.'</p></div>';
	}
	else
	{

		$sql="insert into ".$wpdb->iceget."(ice_money,ice_user_id,ice_time,ice_success,ice_success_time,ice_note,ice_name,ice_alipay)values
			('".$ice_money."','".$user_info->ID."','".date("Y-m-d H:i:s")."',0,'".date("Y-m-d H:i:s")."','','$ice_name','$ice_alipay')";
		if($wpdb->query($sql))
		{
			addUserMoney($user_info->ID, '-'.$ice_money);
			echo '<div class="alert"><p>申请成功，等待管理员处理！</p></div>';
		}
		else
		{
			echo '<div class="alert"><p>系统错误，请稍后重试！</p></div>';
		}
	}
}

if(isset($_POST['paytype'])){
	$paytype=intval($_POST['paytype']);
	$doo = 1;
	
	if(isset($_POST['paytype']) && $paytype==1)
	{
		$url=constant("erphpdown")."payment/alipay.php?ice_money=".esc_sql($_POST['ice_money']);
	}
	elseif(isset($_POST['paytype']) && $paytype==5)
	{
		$url=constant("erphpdown")."payment/f2fpay.php?ice_money=".esc_sql($_POST['ice_money']);
	}
	elseif(isset($_POST['paytype']) && $paytype==4)
	{
		if(erphpdown_is_weixin() && get_option('ice_weixin_app')){
			$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid='.get_option('ice_weixin_appid').'&redirect_uri='.urlencode(constant("erphpdown")).'payment%2Fweixin.php%3Fice_money%3D'.esc_sql($_POST['ice_money']).'&response_type=code&scope=snsapi_base&state=STATE&connect_redirect=1#wechat_redirect';
		}else{
			$url=constant("erphpdown")."payment/weixin.php?ice_money=".esc_sql($_POST['ice_money']);
		}
	}
	elseif(isset($_POST['paytype']) && $paytype==7)
	{
		$url=constant("erphpdown")."payment/paypy.php?ice_money=".esc_sql($_POST['ice_money']);
	}
	elseif(isset($_POST['paytype']) && $paytype==8)
	{
		$url=constant("erphpdown")."payment/paypy.php?ice_money=".esc_sql($_POST['ice_money'])."&type=alipay";
	}
	elseif(isset($_POST['paytype']) && $paytype==2)
	{
		$url=constant("erphpdown")."payment/paypal.php?ice_money=".esc_sql($_POST['ice_money']);
	}
    elseif(isset($_POST['paytype']) && $paytype==18)
	{
		$url=constant("erphpdown")."payment/xhpay3.php?ice_money=".esc_sql($_POST['ice_money'])."&type=2";
	}
	elseif(isset($_POST['paytype']) && $paytype==17)
	{
		$url=constant("erphpdown")."payment/xhpay3.php?ice_money=".esc_sql($_POST['ice_money'])."&type=1";
	}
    elseif(isset($_POST['paytype']) && $paytype==13)
    {
        $url=constant("erphpdown")."payment/codepay.php?ice_money=".esc_sql($_POST['ice_money'])."&type=1";
    }elseif(isset($_POST['paytype']) && $paytype==14)
    {
        $url=constant("erphpdown")."payment/codepay.php?ice_money=".esc_sql($_POST['ice_money'])."&type=3";
    }elseif(isset($_POST['paytype']) && $paytype==15)
    {
        $url=constant("erphpdown")."payment/codepay.php?ice_money=".esc_sql($_POST['ice_money'])."&type=2";
    }
	else{
		
	}
	if($doo) echo "<script>location.href='".$url."'</script>";
	exit;
}

if(isset($_POST['userType'])){
	$userType=isset($_POST['userType']) && is_numeric($_POST['userType']) ?intval($_POST['userType']) :0;
	if($userType >5 && $userType < 11){
		$okMoney=erphpGetUserOkMoney();
		$priceArr=array('6'=>'ciphp_day_price','7'=>'ciphp_month_price','8'=>'ciphp_quarter_price','9'=>'ciphp_year_price','10'=>'ciphp_life_price');
		$priceType=$priceArr[$userType];
		$price=get_option($priceType);
		if(empty($price) || $price<1){
			echo "<script>alert('此类型的会员价格错误，请稍候重试！');</script>";
		}elseif($okMoney < $price){
			echo "<script>alert('当前可用余额不足完成此次交易！');</script>";
		}
		elseif($okMoney >=$price){
			if(erphpSetUserMoneyXiaoFei($price)){
				if(userPayMemberSetData($userType)){
					addVipLog($price, $userType);
					$RefMoney=$wpdb->get_row("select * from ".$wpdb->users." where ID=".$user_info->ID);
					if($RefMoney->father_id > 0){
						addUserMoney($RefMoney->father_id,$price*get_option('ice_ali_money_ref')*0.01);
					}
				}else{
					echo "<script>alert('系统发生错误，请联系管理员！');</script>";
				}
			}else{
				echo "<script>alert('系统发生错误，请稍候重试！');</script>";
			}
		}else{
			echo "<script>alert('未定义的操作！');</script>";
		}
	}else{
		echo "<script>alert('会员类型错误！');</script>";
	}
}

if($_POST['action'] == 'card'){
	$cardnum = $wpdb->escape($_POST['epdcardnum']);
	$cardpass = $wpdb->escape($_POST['epdcardpass']);
	$result = checkDoCardResult($cardnum,$cardpass);
	if($result == '5'){
		echo "<script>alert('充值卡不存在！');</script>";
	}elseif($result == '0'){
		echo "<script>alert('充值卡已被使用！');</script>";
	}elseif($result == '2'){
		echo "<script>alert('充值卡密码错误！');</script>";
	}elseif($result == '1'){
		echo "<script>alert('充值成功！');</script>";
	}else{
		echo "<script>alert('系统错误，请稍后重试！');</script>";
	}
}elseif($_POST['action'] == 'mycredto'){
	$epdmycrednum = $wpdb->escape($_POST['epdmycrednum']);
	if(is_numeric($epdmycrednum) && $epdmycrednum > 0 && get_option('erphp_mycred') == 'yes'){
		if(floatval(mycred_get_users_cred( $user_info->ID )) < floatval($epdmycrednum*get_option('erphp_to_mycred'))){
			$mycred_core = get_option('mycred_pref_core');
			echo "<script>alert('mycred剩余".$mycred_core['name']['plural']."不足！');</script>";
		}
		else
		{
			mycred_add( '兑换', $user_info->ID, '-'.$epdmycrednum*get_option('erphp_to_mycred'), '兑换扣除%plural%!', date("Y-m-d H:i:s") );
			$money = $epdmycrednum;
			if(addUserMoney($user_info->ID, $money))
			{
				$sql="INSERT INTO $wpdb->icemoney (ice_money,ice_num,ice_user_id,ice_time,ice_success,ice_note,ice_success_time,ice_alipay)
				VALUES ('$money','".date("ymdhis").mt_rand(10000,99999)."','".$user_info->ID."','".date("Y-m-d H:i:s")."',1,'4','".date("Y-m-d H:i:s")."','')";
				$wpdb->query($sql);
				echo "<script>alert('兑换成功！');</script>";
			}
			else
			{
				echo "<script>alert('兑换失败！');</script>";
			}
		}
	}
}
	
?>

<link rel='stylesheet' href="<?php echo ERPHPDOWN_URL.'/static/profile/erphpdown.css?ver='.$erphpdown_version; ?>" type='text/css' media='all' />
<style>
	.usercheck,.profile-btn{background:var(--main-color) !important;cursor: pointer;}.profile-title,.table strong{color:var(--main-color) !important}.alert{border:none;background:linear-gradient(to right,#E2BC80,#F3D8A8);color:#333;text-shadow:none;font-weight:600;padding:15px 25px}.alert a{color:#333}.pageheader{height:80px;width:100%;padding:0;overflow:hidden;background:url(<?php bloginfo('template_url');?>/images/userbg.png) no-repeat top center;background-size:cover;}.pageheader h1{line-height:80px;color:#fff;font-weight:500;margin-left:25px;text-shadow:0 1px 0 rgba(0,0,0,0.5)}.usercheck{margin-right:25px;margin-top:25px}.pagesider-menu a{padding:15px;text-align:center;border-bottom:none;color:#272727;font-size:15px}.pagesider-menu a:hover,.pagesider-menu li.active a:hover{background:var(--main-color) !important;opacity:0.6;color:#fff}.pagesider-menu li.active a,.pagesider-menu li.current_page_item a,.pagesider-menu li.current-menu-item a{border-left-color:var(--main-color) !important;background:none !important}.pagesidebar{background:#fff;}.pagecontent{font:14px/1.5 "微软雅黑" !important}.dl-horizontal dd{font-size:14px}.profile-btn{width:160px;height:36px;border-radius:6px;overflow:hidden;}#ice_money{width:240px;height:40px;border:1px solid #ddd;font-size:16px;padding:0 10px;border-radius:6px;margin-top:10px;}.profile-box .profile-title ~ p{padding:10px 15px;}.dl-horizontal dt{font-weight:500}.profile-content  table tr th{line-height:2;font-weight:500}@media screen and (max-width:768px){.alert{padding:10px}.pagesider-menu a{padding:12px 5px}.pagecontent{font:12px/1.5 "微软雅黑" !important}#ice_money{width:90%;height:40px;}}
</style>
<main> 
    <section class="content">
            <article class="mt20"> 
	<div class="pagewrapper clearfix shadow" id="profile" >
		<header class="pageheader clearfix">
			<h1>个人中心</h1>
			<?php 
				if(get_option('ice_ali_money_checkin')){
					if(erphpdown_check_checkin($user_info->ID)){
			      		echo '<a href="javascript:;" class="usercheck active">已签到</a>';
			        }else{
			      		echo '<a href="javascript:;" class="usercheck erphp-checkin">今日签到</a>';
			        }
			    }
			?>
		</header>
		<aside class="pagesidebar" style="top:95px;">
			<ul class="pagesider-menu">
				<li <?php if($_GET["pd"]=='info' || !isset($_GET["pd"])){?>class="active"<?php }?> ><a href="?pd=info">个人信息</a></li>
				<li <?php if($_GET["pd"]=='money'){?>class="active"<?php }?> ><a href="?pd=money">我的资产</a></li>
				<li <?php if($_GET["pd"]=='cang'){?>class="active"<?php }?> ><a href="?pd=cang">我的收藏</a></li>
				<li <?php if($_GET["pd"]=='com'){?>class="active"<?php }?> ><a href="?pd=com">我的评论</a></li>
				<!--<li <?php if($_GET["pd"]=='cart'){?>class="active"<?php }?> ><a href="?pd=cart">我的下载</a></li>-->
				<li <?php if($_GET["pd"]=='vip'){?>class="active"<?php }?> ><a href="?pd=vip">VIP记录</a></li>
				<li <?php if($_GET["pd"]=='recharge'){?>class="active"<?php }?> ><a href="?pd=recharge" >充值记录</a></li>
				<li <?php if($_GET["pd"]=='ref'){?>class="active"<?php }?> ><a href="?pd=ref">推广注册</a></li>
				<li <?php if($_GET["pd"]=='ref2'){?>class="active"<?php }?> ><a href="?pd=ref2">推广VIP</a></li>
				<li <?php if($_GET["pd"]=='outmo' || $_GET["pd"]=='tixian'){?>class="active"<?php }?> ><a href="?pd=outmo">站内提现</a></li>
				<li <?php if($_GET["pd"]=='pass'){?>class="active"<?php }?> ><a href="?pd=pass">修改密码</a></li>
				<!-- <li><a href="<?php echo wp_logout_url(home_url());?>">安全退出</a></li> -->
			</ul>
		</aside>
		<div class="pagecontent profile-content">
			<?php if($_GET["pd"]=='info' || !isset($_GET["pd"])){?>
			<div id="infocenter">
				<?php 
					global $current_user;
				?>
				<div class="profile-form">
					<form action="" method="post">
					<dl class="dl-horizontal">
						<dt>登录名</dt>
						<dd><?php echo esc_attr( $current_user->user_login ); ?></dd>
					</dl>
					<dl class="dl-horizontal">
						<dt>注册时间</dt>
						<dd><?php echo get_date_from_gmt( $current_user->user_registered ) ?></dd>
					</dl>
					<dl class="dl-horizontal">
						<dt>昵称</dt>
						<dd>
							<input type="text" class="profile-input" id="mm_name" name="mm_name" value="<?php echo esc_attr( $current_user->nickname ) ?>">
						</dd>
					</dl>
					<dl class="dl-horizontal">
						<dt>邮箱</dt>
						<dd>
							<input type="text" class="profile-input" id="mm_mail" name="mm_mail" value="<?php echo esc_attr( $current_user->user_email ) ?>">
						</dd>
					</dl>
					<dl class="dl-horizontal">
						<dt>网址</dt>
						<dd>
							<input type="text" class="profile-input" id="mm_url" name="mm_url" value="<?php echo esc_attr( $current_user->user_url ) ?>">
						</dd>
					</dl>
					<dl class="dl-horizontal">
						<dt>简介</dt>
						<dd>
							<textarea rows="4" class="profile-input" id="mm_desc" name="mm_desc"><?php echo esc_html( $current_user->description ); ?></textarea>
						</dd>
					</dl>
					<dl class="dl-horizontal">
						<dt></dt>
						<dd>
							<input type="button" id="doprofile" value="保存" class="profile-btn" />  
						</dd>
					</dl>
					</form>
				</div>
			</div>
			<script type="text/javascript">
				jQuery(document).ready(function($){
					$("#doprofile").click(function(){ 
						var reg = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z0-9]+$/ ;
						if($("#mm_name").val().trim().length==0)
						{
							alert("请输入昵称");
						}
						else if(strlen($("#mm_name").val().trim())<4)
						{
							alert("昵称长度至少为4位");
						}
						else if(!reg.test($("#mm_mail").val().trim()))
						{
							alert("请输入正确邮箱，以免忘记密码时无法找回");
						}
						else
						{
							$("#doprofile").val("保存中...");
							$("#doprofile").css("width","80px");
							$.ajax({
								type: "post",
								url: "<?php echo ERPHPDOWN_URL; ?>/admin/action/ajax-profile.php",
								data: "do=profile&mm_name=" + $("#mm_name").val() + "&mm_mail=" + $("#mm_mail").val() + "&mm_url=" + $("#mm_url").val() + "&mm_desc=" + $("#mm_desc").val(),
								dataType: "text",
								success: function (data) {
									$("#doprofile").val("保存");
									$("#doprofile").css("width","60px");
									alert("修改成功");
								},
								error: function () {
								   $("#doprofile").val("保存");
									$("#doprofile").css("width","60px");
									alert("error");
								}
							});
						}
					});
				
				});
			</script>
			<?php }elseif($_GET["pd"]=='cang'){ ?>
				<h2 class="profile-title">我的收藏</h2> 
				<div class="cang-box">
					<ul class="user-cang">
					<?php
							$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
							$args=array(
							'cat' => '', // 分类ID，如果不需要限定是哪个分类，可以不写这个条件
							'posts_per_page' =>10000,
							'paged' => $paged,
							);
							query_posts($args);
							if(have_posts()) : while (have_posts()) : the_post();
							 
							$loveLike = explode(',',get_post_meta($id,'shoucang',true));
							$likes = array_filter($loveLike);
							if(in_array(get_current_user_id(),$likes)) { ?>
								<li>
									<a href="<?php the_permalink();?>" title="<?php the_title();?>">
										<h3 class="text-h1"><?php the_title();?></h3>
										<div class="user-info">
											<span>
												发布时间：<?php the_time('Y-m-d');?>
											</span>
										</div>
									</a>
									<span class="cancleCang"  data-id="<?php the_ID();?>" >取消收藏</span>
								</li>
						    <?php } ?>  
        					<?php endwhile; ?> 
        					<?php else : ?>   
                             <p>收藏夹为空！</p> 
                            <?php endif; ?> 
                            <?php  wp_reset_query(); ?> 
							<!-- 收藏 end -->
					</ul> 	
				</div>
				
			<?php }elseif($_GET["pd"]=='com'){ ?>
				<h2  class="profile-title">我的评论</h2>
				<div class="user-box">
							<ul class="comment-user">	
							<?php
							global $wpdb;
							$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID,comment_post_ID, comment_author, comment_date_gmt, comment_approved,comment_type,comment_author_url,SUBSTRING(comment_content,1,30) AS com_excerpt
							FROM $wpdb->comments
							LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID)
							WHERE  comment_approved = '1' AND comment_type = '' AND post_password = '' AND comment_author = '$current_user->display_name'
							ORDER BY comment_date_gmt DESC   LIMIT 1000";
							$comments = $wpdb->get_results($sql);
							$output = $pre_HTML;
							foreach ($comments as $comment) {
								$output .= "<li><a href=\"". get_permalink($comment->ID) ."#comment-" . $comment->comment_ID . "\" title=\"留言在 " .$comment->post_title . "\"><h3 class=\"text-h1\">《 $comment->post_title 》</h3>
										<p><span>评论内容：</span> <b>“". strip_tags($comment->com_excerpt). "”</b></p></a></li>";
							}
							$output .= $post_HTML;
							echo $output;?>
							</ul>
				</div> 
			<?php }elseif($_GET["pd"]=='recharge'){
				$totallists = $wpdb->get_var("SELECT count(*) FROM $wpdb->icemoney WHERE ice_success=1 and ice_user_id=".$user_info->ID);
				$ice_perpage = 10;
				$pages = ceil($totallists / $ice_perpage);
				$page=isset($_GET['pp']) ?intval($_GET['pp']) :1;
				$offset = $ice_perpage*($page-1);
				$lists = $wpdb->get_results("SELECT * FROM $wpdb->icemoney where ice_success=1 and ice_user_id=".$user_info->ID." order by ice_time DESC limit $offset,$ice_perpage");
				
				?>
				
            	<table class="table table-hover table-striped">
					<thead>
						<tr>
							<th>金额</th>
							<th>方式</th>
							<th>时间</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if($lists) {
								foreach($lists as $value)
								{
									echo "<tr>\n";
									echo "<td>$value->ice_money</td>\n";
									if(intval($value->ice_note)==0)
									{
										echo "<td>在线充值</td>\n";
									}elseif(intval($value->ice_note)==1)
									{
										echo "<td>后台充值</td>\n";
									}
									elseif(intval($value->ice_note)==2)
									{
										echo "<td>转账收</td>\n";
									}
									elseif(intval($value->ice_note)==3)
									{
										echo "<td>转账付</td>\n";
									}elseif(intval($value->ice_note)==4)
									{
										echo "<td>积分兑换</td>\n";
									}elseif(intval($value->ice_note)==6)
									{
										echo "<td>充值卡</td>\n";
									}else{
										echo "<td>未知</td>\n";
									}
									
									echo "<td>$value->ice_time</td>";
									echo "</tr>";
								}
							}
							else
							{
								echo '<tr width=100%><td colspan="3" align="center"><center><strong>没有记录！</strong></center></td></tr>';
							}
						?>
					</tbody>
				</table>
				<?php mobantu_paging('recharge',$page,$pages);?>
			<?php }elseif($_GET["pd"]=='vip'){
				$totallists = $wpdb->get_var("SELECT COUNT(ice_id) FROM $wpdb->vip where ice_user_id=".$user_info->ID);
				$ice_perpage = 10;
				$pages = ceil($totallists / $ice_perpage);
				$page=isset($_GET['pp']) ?intval($_GET['pp']) :1;
				$offset = $ice_perpage*($page-1);
				$lists = $wpdb->get_results("SELECT * FROM $wpdb->vip where ice_user_id=".$user_info->ID." order by ice_time DESC limit $offset,$ice_perpage");
				
				?>
				
            	<table class="table table-hover table-striped">
					<thead>
						<tr>
							<th>VIP类型</th>
							<th>价格</th>
							<th>时间</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if($lists) {
								foreach($lists as $value)
								{
									if($value->ice_user_type == 6) $typeName = '体验';
									else {$typeName=$value->ice_user_type==7 ?'包月' :($value->ice_user_type==8 ?'包季' : ($value->ice_user_type==10 ?'终身' : '包年'));}
									echo "<tr>\n";
									echo "<td>$typeName</td>\n";
									echo "<td>$value->ice_price</td>\n";
									echo "<td>$value->ice_time</td>\n";
									echo "</tr>";
								}
							}
							else
							{
								echo '<tr width=100%><td colspan="3" align="center"><center><strong>没有记录！</strong></center></td></tr>';
							}
						?>
					</tbody>
				</table>
				<?php mobantu_paging('vip',$page,$pages);?>
			<?php }elseif($_GET["pd"]=='ref'){
				$totallists = $wpdb->get_var("SELECT COUNT(ID) FROM $wpdb->users WHERE father_id=".$user_info->ID);
				$ice_perpage = 10;
				$pages = ceil($totallists / $ice_perpage);
				$page=isset($_GET['pp']) ?intval($_GET['pp']) :1;
				$offset = $ice_perpage*($page-1);
				$lists = $wpdb->get_results("SELECT ID,user_login,user_registered FROM $wpdb->users where father_id=".$user_info->ID." limit $offset,$ice_perpage");
				?>
				<div class="alert">推广链接&nbsp;&nbsp;&nbsp;&nbsp;<?php echo esc_url( home_url( '/?aff=' ) ).$user_info->ID; ?></div>
            	<table class="table table-hover table-striped">
					<thead>
						<tr>
							<th>用户ID</th>
							<th>注册时间</th>
							<th>消费额</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if($lists) {
								foreach($lists as $value)
								{
									echo "<tr>\n";
									echo "<td>$value->user_login</td>\n";
									echo "<td>$value->user_registered</td>";
									echo "<td>".erphpGetUserAllXiaofei($value->ID)."</td>";
									echo "</tr>";
								}
							}
							else
							{
								echo '<tr width=100%><td colspan="3" align="center"><center><strong>没有记录！</strong></center></td></tr>';
							}
						?>
					</tbody>
				</table>
				<?php mobantu_paging('ref',$page,$pages);?>
			<?php }elseif($_GET["pd"]=='ref2'){
				$totallists = $wpdb->get_var("SELECT COUNT(ice_id) FROM $wpdb->vip where ice_user_id in (select ID from $wpdb->users where father_id=".$user_info->ID.")");
				$ice_perpage = 10;
				$pages = ceil($totallists / $ice_perpage);
				$page=isset($_GET['pp']) ?intval($_GET['pp']) :1;
				$offset = $ice_perpage*($page-1);
				$lists = $wpdb->get_results("SELECT * FROM $wpdb->vip where ice_user_id in (select ID from $wpdb->users where father_id=".$user_info->ID.") order by ice_time DESC limit $offset,$ice_perpage");
				?>
				<div class="alert">推广链接&nbsp;&nbsp;&nbsp;&nbsp;<?php echo esc_url( home_url( '/?aff=' ) ).$user_info->ID; ?></div>
            	<table class="table table-hover table-striped">
					<thead>
						<tr>
							<th>用户ID</th>
							<th>VIP类型</th>
							<th>价格</th>
							<th>交易时间</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if($lists) {
								foreach($lists as $value)
								{
									if($value->ice_user_type == 6) $typeName = '体验';
									else {$typeName=$value->ice_user_type==7 ?'包月' :($value->ice_user_type==8 ?'包季' : ($value->ice_user_type==10 ?'终身' : '包年'));}
									echo "<tr>\n";
									echo "<td>".get_the_author_meta( 'user_login', $value->ice_user_id )."</td>\n";
									echo "<td>$typeName</td>\n";
									echo "<td>$value->ice_price</td>\n";
									echo "<td>$value->ice_time</td>\n";
									echo "</tr>";
								}
							}
							else
							{
								echo '<tr width=100%><td colspan="4" align="center"><center><strong>没有记录！</strong></center></td></tr>';
							}
						?>
					</tbody>
				</table>
				<?php mobantu_paging('ref2',$page,$pages);?>
            
			<?php }elseif($_GET["pd"]=='outmo'){
				$totallists = $wpdb->get_var("SELECT count(*) FROM $wpdb->iceget WHERE ice_user_id=".$user_info->ID);
				$ice_perpage = 10;
				$pages = ceil($totallists / $ice_perpage);
				$page=isset($_GET['pp']) ?intval($_GET['pp']) :1;
				$offset = $ice_perpage*($page-1);
				$lists = $wpdb->get_results("SELECT * FROM $wpdb->iceget where ice_user_id=".$user_info->ID." order by ice_time DESC limit $offset,$ice_perpage");
				?>
				<div class="alert"><a href="?pd=tixian">有收入了？去申请提现>></a></div>
            	<table class="table table-hover table-striped">
					<thead>
						<tr>
							<th>申请金额</th>
							<th>申请时间</th>
							<th>到账金额</th>
							<th>状态</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if($lists) {
								foreach($lists as $value)
								{
									$result=$value->ice_success==1?'已支付':'--';
									echo "<tr>\n";
									echo "<td>$value->ice_money</td>\n";
									echo "<td>$value->ice_time</td>\n";
									echo "<td>".sprintf("%.2f",(((100-get_option("ice_ali_money_site"))*$value->ice_money)/100))."</td>\n";
									echo "<td>$result</td>\n";
									echo "</tr>";
								}
							}
							else
							{
								echo '<tr><td colspan="4" align="center"><center><strong>没有记录！</strong></center></td></tr>';
							}
						?>
					</tbody>
				</table>
				<?php mobantu_paging('outmo',$page,$pages);?>
			<?php }elseif($_GET["pd"]=='tixian'){
				$fee=get_option("ice_ali_money_site");
				$fee=isset($fee) ?$fee :100;
				$userMoney=$wpdb->get_row("select * from ".$wpdb->iceinfo." where ice_user_id=".$user_info->ID);
				/////////////////////////////////////////////////www.mobantu.com   82708210@qq.com
				if(!$userMoney)
				{
					$okMoney=0;
				}
				else 
				{
					$okMoney=$userMoney->ice_have_money - $userMoney->ice_get_money;
				}
				$userAli=$wpdb->get_row("select * from ".$wpdb->iceget." where ice_user_id=".$user_info->ID);
			?>
				<div class="profile-form">
					<form action="" method="post">
					<dl class="dl-horizontal">
						<dt>支付宝账号</dt>
						<dd><input type="text" id="ice_alipay" name="ice_alipay" value="<?php if($userAli) echo $userAli->ice_alipay;?>"/></dd>
					</dl>
					<dl class="dl-horizontal">
						<dt>支付宝姓名</dt>
						<dd><input type="text" id="ice_name" name="ice_name"  value="<?php if($userAli) echo $userAli->ice_name;?>"/></dd>
					</dl>
					<dl class="dl-horizontal">
						<dt>手续费</dt>
						<dd>
							<?php echo get_option("ice_ali_money_site")?>%
						</dd>
					</dl>
					<dl class="dl-horizontal">
						<dt>提现金额</dt>
						<dd>
							<input type="text" id="ice_money" name="ice_money"  />（余额：<?php echo sprintf("%.2f",$okMoney)?><?php echo get_option('ice_name_alipay')?>）
						</dd>
					</dl>
					<dl class="dl-horizontal">
						<dt></dt>
						<dd>
							<input type="submit" value="提交申请" class="profile-btn" />
						</dd>
					</dl>
					</form>
				</div>
			
			 <?php }elseif($_GET["pd"]=='pass'){?>
			
			<div id="changepass">
				<div class="alert">为了确保安全，密码最好是由“字母+字符+数字”组成！</div>
				<div class="profile-form">
					<form action="" method="post">
                    <dl class="dl-horizontal" style="display:none">
						<dt>用户名</dt>
						<dd>
							<input type="text" id="mm_username" name="log" value="<?php echo esc_attr( $profileuser->user_login ); ?>">
						</dd>
					</dl>
					<dl class="dl-horizontal">
						<dt>新密码</dt>
						<dd>
							<input type="password" id="mm_pass_new" name="mm_pass_new" value="">
						</dd>
					</dl>
					<dl class="dl-horizontal">
						<dt>重复密码</dt>
						<dd>
							<input type="password" id="mm_pass_new2" name="mm_pass_new2" value="">
						</dd>
					</dl>
					<dl class="dl-horizontal">
						<dt></dt>
						<dd>
							<input type="button" id="dopassword" value="保存" class="profile-btn" />
						</dd>
					</dl>
					</form>
				</div>
			</div>
			
			<script type="text/javascript">
				jQuery(document).ready(function($){
				
					$("#dopassword").click(function(){ 
						if($("#mm_pass_new").val().trim().length==0)
						{
							alert("请输入密码");
						}
						else if(strlen($("#mm_pass_new").val().trim())<6)
						{
							alert("密码长度至少为6位");
						}
						else if($("#mm_pass_new2").val().trim() != $("#mm_pass_new").val().trim())
						{
							alert("两次密码不一致");
						}
						else
						{
							$("#dopassword").val("保存中...");
							$.ajax({
								type: "post",
								url: "<?php echo ERPHPDOWN_URL; ?>/admin/action/ajax-profile.php",
								data: "do=password&mm_usrname="+$("#mm_usrname").val()+"&mm_pass_old=" + $("#mm_pass_old").val() + "&mm_pass_new=" + $("#mm_pass_new").val() + "&mm_pass_new2=" + $("#mm_pass_new2").val(),
								dataType: "text",
								success: function (data) {
									$("#dopassword").val("保存");
									alert("修改成功");
								},
								error: function () {
									$("#dopassword").val("保存");
									alert("修改失败");
								}
							});
						}
					});
				
				
				});
			</script>
			<?php }elseif($_GET["pd"]=='cart'){
			$total_trade   = $wpdb->get_var("SELECT COUNT(ice_id) FROM $wpdb->down WHERE ice_success>0 and ice_user_id=".$user_info->ID);
			$ice_perpage = 10;
			$pages = ceil($total_trade / $ice_perpage);
			$page=isset($_GET['pp']) ?intval($_GET['pp']) :1;
			$offset = $ice_perpage*($page-1);
			$list = $wpdb->get_results("SELECT * FROM $wpdb->icealipay where ice_success=1 and ice_user_id=$user_info->ID order by ice_time DESC limit $offset,$ice_perpage");
			?>
			<div id="downlist">
				<table class="table table-hover table-striped">
					<thead>
						<tr>
							<th>订单号</th>
							<th >商品名称</th>
							<th>价格</th>
							<th>交易时间</th>
							<th>下载信息</th>
						</tr>
					</thead>
					<tbody>
						<?php
							if($list) {
								foreach($list as $value)
								{
									echo "<tr>\n";
									echo "<td>$value->ice_num</td>";
									echo "<td><a target=_blank href=".get_permalink($value->ice_post).">$value->ice_title</a></td>\n";
									echo "<td>$value->ice_price</td>\n";
									echo "<td>$value->ice_time</td>\n";
									echo "<td><a href='".get_bloginfo('wpurl').'/wp-content/plugins/erphpdown/download.php?url='.$value->ice_url."' target='_blank'>下载页面</a></td>\n";
									echo "</tr>";
								}
							}
							else
							{
								echo '<tr width=100%><td colspan="5" align="center"><center><strong>没有订单</strong></center></td></tr>';
							}
						?>
					</tbody>
				</table>
                <?php mobantu_paging('cart',$page,$pages);?>
			</div>
		
			<?php }elseif($_GET["pd"]=='money'){ 
					$user_Info   = wp_get_current_user();
					$userMoney=$wpdb->get_row("select * from ".$wpdb->iceinfo." where ice_user_id=".$user_Info->ID);
					if(!$userMoney){
						$okMoney=0;
					}else{
						$okMoney=$userMoney->ice_have_money - $userMoney->ice_get_money;
					}
				?>
				
				<div class="profile-box">
					<h2 class="profile-title">我的资产</h2>
					<p> 消费<?php echo get_option('ice_name_alipay');?>：<?php echo intval($userMoney->ice_get_money)?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;剩余<?php echo get_option('ice_name_alipay');?>：<?php echo $okMoney?><?php if(plugin_check_cred() && get_option('erphp_mycred') == 'yes'){$mycred_core = get_option('mycred_pref_core');?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;剩余<?php echo $mycred_core['name']['plural'];?>：<?php echo mycred_get_users_cred( $user_Info->ID )?><?php }?></p>
				</div>
				
                <div class="profile-box">
                <form action="" method="post" onSubmit="return checkFm();">
                        <h2 class="profile-title">在线充值</h2>
                        <table class="form-table">
                            <tr>
                				<td>
                				<input type="text" id="ice_money" name="ice_money" required="required"/>（请输入充值金额，1人民币 = <?php echo get_option('ice_proportion_alipay').' '.get_option('ice_name_alipay')?>）
                				</td>
                            </tr>
                            <tr>
                                <td>
                                <?php if(get_option('ice_weixin_mchid')){?> 
                                <input type="radio" id="paytype4" class="paytype" checked name="paytype" value="4" />微信&nbsp;
                                <?php }?>
                                <?php if(get_option('ice_ali_partner')){?> 
                                <input type="radio" id="paytype1" class="paytype" checked name="paytype" value="1" />支付宝&nbsp;
                                <?php }?>
                                <?php if(get_option('erphpdown_f2fpay_id')){?> 
								<input type="radio" id="paytype5" class="paytype" checked name="paytype" value="5" />支付宝&nbsp;
								<?php }?>
								<?php if(get_option('erphpdown_xhpay_appid31')){?> 
									<input type="radio" id="paytype18" class="paytype" name="paytype" value="18" checked />微信&nbsp;      
								<?php }?>
								<?php if(get_option('erphpdown_xhpay_appid32')){?> 
									<input type="radio" id="paytype17" class="paytype" name="paytype" value="17" checked />支付宝&nbsp;      
								<?php }?>
				                <?php if(get_option('erphpdown_codepay_appid')){?> 
				                <input type="radio" id="paytype13" class="paytype" name="paytype" value="13" checked />支付宝&nbsp;
				                <input type="radio" id="paytype14" class="paytype" name="paytype" value="14" />微信&nbsp;
				                <input type="radio" id="paytype15" class="paytype" name="paytype" value="15" />QQ钱包&nbsp;        
				                <?php }?>
				                <?php if(get_option('erphpdown_paypy_key')){?> 
									<?php if(!get_option('erphpdown_paypy_wxpay')){?><input type="radio" id="paytype7" class="paytype" name="paytype" value="7" checked />微信&nbsp;<?php }?>    
									<?php if(!get_option('erphpdown_paypy_alipay')){?><input type="radio" id="paytype8" class="paytype" name="paytype" value="8" />支付宝&nbsp;<?php }?>  
								<?php }?> 
                                <?php if(get_option('ice_payapl_api_uid')){?> 
                                <input type="radio" id="paytype2" class="paytype" checked name="paytype" value="2" />PayPal($美元)汇率：
                                 (<?php echo get_option('ice_payapl_api_rmb')?>)&nbsp;  
                                 <?php }?> 
                                </td>
                            </tr>
                     <tr>
                        <td><p class="submit">
                            <input type="submit" name="Submit" value="充值" class="profile-btn"/>
                            </p>
                        </td>
                
                        </tr> 
                        
                        </table>
                
                </form>
                </div>

                <?php if(function_exists("checkDoCardResult")){?>
                <div class="profile-box">
                	<form action="" method="post" onSubmit="return checkFm2();">
                        <h2 class="profile-title">充值卡充值</h2>
                        <table class="form-table">
                        	<tr>
                            	<td>1 元 = <?php echo get_option('ice_proportion_alipay').' '.get_option('ice_name_alipay')?></td>
                            </tr>
                            <tr>
                				<td>
                				充值卡号：<input type="text" id="epdcardnum" name="epdcardnum"  required="required" />
                				</td>
                            </tr>
                            <tr>
                				<td>
                				充值卡密：<input type="text" id="epdcardpass" name="epdcardpass"  required="required"/>
                				</td>
                            </tr>
                            
                    <tr>
                        <td><p class="submit">
                        <input type="hidden" name="action" value="card">
                            <input type="submit" value="充值" class="profile-btn" />
                            </p>
                        </td>
                
                        </tr> 
                        
                        </table>
                
                	</form>
                </div>
                <?php }?>
            	
                <?php if(plugin_check_cred() && get_option('erphp_mycred') == 'yes'){
                	$mycred_core = get_option('mycred_pref_core');
                	?>
                <div class="profile-box">
	                <form action="" method="post" onSubmit="return checkFm3();">
	                	<h1 style="border-bottom:1px solid #999999;width:100%;color:#F04243;"><?php echo $mycred_core['name']['plural'];?>兑换<?php echo get_option('ice_name_alipay')?></h1>
	                	<table class="form-table">
	                            <tr>
	                				<td>
	                				<input type="text" id="epdmycrednum" name="epdmycrednum"  required="required" placeholder="需要兑换的<?php echo get_option('ice_name_alipay')?>数" />（请输入一个整数，<?php echo get_option('erphp_to_mycred').$mycred_core['name']['plural'];?> = 1<?php echo get_option('ice_name_alipay')?>）
	                				</td>
	                            </tr>
	                     <tr>
	                        <td><p class="submit">
	                            <input type="submit" name="Submit" value="兑换" class="profile-btn" onClick="return confirm('确认兑换?');"/>
	                            <input type="hidden" name="action" value="mycredto">
	                            </p>
	                        </td>
	                
	                        </tr> 
	                        
	                        </table>
	                </form>
	            </div>
                <?php }?>

                <div class="profile-box">
                <form action="" method="post">
                <h2 class="profile-title">升级VIP</h2>
                	<table class="form-table">
                        <tr>
                            <td><?php 
							$ciphp_year_price    = get_option('ciphp_year_price');
							$ciphp_quarter_price = get_option('ciphp_quarter_price');
							$ciphp_month_price  = get_option('ciphp_month_price');
							$ciphp_life_price  = get_option('ciphp_life_price');
							$ciphp_day_price  = get_option('ciphp_day_price');
							
                            $userTypeId=getUsreMemberType();
                            if($userTypeId==6)
                            {
                                echo "您目前是体验会员";
                            }
                            elseif($userTypeId==7)
                            {
                                echo "您目前是包月会员";
                            }
                            elseif ($userTypeId==8)
                            {
                                echo "您目前是包季会员";
                            }
                            elseif ($userTypeId==9)
                            {
                                echo "您目前是包年会员";
                            }
							elseif ($userTypeId==10)
                            {
                                echo "您目前是终身会员";
                            }
                            else 
                            {
                                echo '您未购买任何VIP服务';
                            }
                            ?>&nbsp;&nbsp;&nbsp;<?php echo ($userTypeId>0 && $userTypeId<10) ?'到期时间：'.getUsreMemberTypeEndTime() :''?><br /></td>
                        </tr>

                        <tr>
                            <td>
                                <?php if($ciphp_life_price){?><input type="radio" id="userType10" name="userType" value="10" checked />终身会员（<?php echo $ciphp_life_price.get_option('ice_name_alipay')?> ）&nbsp;<?php }?>
                                <?php if($ciphp_year_price){?><input type="radio" id="userType9" name="userType" value="9" />包年会员（<?php echo $ciphp_year_price.get_option('ice_name_alipay')?> ）&nbsp;<?php }?>
                                <?php if($ciphp_quarter_price){?><input type="radio" id="userType8" name="userType" value="8" />包季会员（<?php echo $ciphp_quarter_price.get_option('ice_name_alipay')?> ）&nbsp;<?php }?>
                                <?php if($ciphp_month_price){?><input type="radio" id="userType7" name="userType" value="7" />包月会员（<?php echo $ciphp_month_price.get_option('ice_name_alipay')?> ）&nbsp;<?php }?>
                                <?php if($ciphp_day_price){?><input type="radio" id="userType6" name="userType" value="6" />体验会员（<?php echo $ciphp_day_price.get_option('ice_name_alipay')?> ）<?php }?>
                            </td>
                        </tr>
                        <tr>
                            <td><p class="submit"><input type="submit" name="Submit" value="升级VIP" class="profile-btn" onClick="return confirm('确认升级成为VIP?');"/></p>
                            </td>
                        </tr>
                        
                    </table>
                </form>
                </div>
			<?php } ?>
		</div>
	</div>
</article>
</section>
</main>
<script type="text/javascript">
	function checkFm(){
		if(document.getElementById("ice_money").value=="")
		{
			alert('请输入金额');
			return false;
		}
	}

	function checkFm2(){
		if(document.getElementById("epdcardnum").value=="")
		{
			alert('请输入金额');
			return false;
		}
	}

	function checkFm3(){
		if(document.getElementById("epdmycrednum").value=="")
		{
			alert('请输入兑换的金额');
			return false;
		}
	}

	function strlen(str){
		var len = 0;
		for (var i=0; i<str.length; i++){
			var c = str.charCodeAt(i);
			if ((c >= 0x0001 && c <= 0x007e) || (0xff60<=c && c<=0xff9f)) {
				len++;
			}else {
				len+=2;
			}
		} 
		return len;
	}
</script>
<?php get_footer(); ?>