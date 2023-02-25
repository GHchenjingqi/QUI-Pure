<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url');?>/admin/admin.css"/>
<?php include(TEMPLATEPATH.'/admin/admin.php'); ?>
<form action="" method="post" enctype="multipart/form-data">
<div class="pavilion-container" id="app" v-cloak>
	<div class="layer-title">{{title}}</div>
	<div class="pavilion-inner">
		<ul class="tabs overflow-hide">
			<li :class="navCur===index?'on':''"  :style="{ background: navCur===index? curCor : '' }" v-for="(item,index) in navs" :key="index" @click="tabClick(index)">{{item.title}}</li>
		</ul>
        <div class="tab-content-wrap">
			<div class="tab-content overflow-hide" v-show="navCur===0">
                <dl>
                    <dt>网站Logo：—— 建议尺寸120px*44px</dt> 
                    <dd>  <div class="flex">  
                    <label type="button" class="qui-btn" style="background-color:<?php if ( get_option("colors") ){  echo get_option("colors");  } else { ?>  #0000CD <?php } ?>;">
                		<span>选择图片</span>
                		<input type="file" name="logo" id="upbottom">   
                	</label>
                    <img src="<?php echo $logo_img; ?>" height=50 >
					<?php if( get_option("logo_img") ) { ?>
                    <span class="clear" data-name="logo_img" @click="clearImg('logo_img')">清空</span>
                     <?php } ?> 
                     </div>
                    </dd>
                </dl> 
                <dl>
                    <dt>网站favicon：—— 建议尺寸16px*16px，必须是ico格式</dt>
                    <dd> <div class="flex">
                         <label type="button" class="qui-btn" style="background-color:<?php if ( get_option("colors") ){  echo get_option("colors");  } else { ?>  #0000CD <?php } ?>;">
                    		<span>选择图片</span>
                    	   <input type="file" name="logo_f" id="upbottom">   
                    	</label> 
                        <img src="<?php echo $logo_f_img; ?>" height=50 >
						<?php if( get_option("logo_f_img") ) { ?>
                        <span class="clear" data-name="logo_f_img"  @click="clearImg('logo_f_img')">清空</span>
                        <?php } ?>
                         </div>
                    </dd>
                </dl> 
                <dl>
                    <dt>暗黑模式：
                     <span>
                        <input type="radio" name="blackM" value="1" @click="choseLabel('blackM','1')" <?php if( get_option("blackM") == 1 ){ echo 'checked'; } ?> id="open_black">
                        <label for="open_black">开启</label>
                        <input type="radio" name="blackM" @click="choseLabel('blackM','0')"  value="0"  <?php  if( get_option("blackM") == 0 ){ echo 'checked'; } ?> id="close_black">
                        <label for="close_black" >关闭</label>
                     </span>
                    </dt>
                </dl>
                <dl>
                    <dt>网站主色调：—— 选择颜色之后，一定要记得保存设置哦！</dt>
                    <dd><input type="color"  name="colors" value="<?php echo get_option("colors"); ?>"><span class="selColor">当前色：<b id="color" style="background: <?php
                    if ( get_option("colors") ){
                    ?>
                    <?php echo get_option("colors"); } else {  ?> #0000CD  <?php }  ?> ">
                    <?php if ( get_option("colors") ){   echo get_option("colors");  } else {
                    ?> #0000CD <?php }  ?> 
                    </b></span></dd>
                </dl> 
                <dl>
                    <dt>网站备案号：—— 例如：“豫备案号：1234560001号”</dt>
                    <dd><input type="text" name="beian" value="<?php echo get_option("beian"); ?>"></dd>
                </dl>
                <dl>
                    <dt>公安备案号：—— 例如：“豫备案号：1234560001号”</dt>
                    <dd><input type="text" name="gongan" value="<?php echo get_option("gongan"); ?>"></dd>
                </dl>
			</div>
			<div class="tab-content overflow-hide" v-show="navCur===1">
			     <dl>
                    <dt>顶部图片(建议尺寸：1920*120 像素)：
                        <input type="radio" name="topImg" value="1" @click="choseLabel('topImg','1')"  <?php if( get_option("topImg") == 1 ){  echo 'checked'; } ?> id="opens">
                        <label for="opens">开启</label>
                        <input type="radio" name="topImg"  value="0" @click="choseLabel('topImg','0')" <?php  if( get_option("topImg") == 0 ){ echo 'checked'; } ?> id="closes"> 
                        <label for="closes" >关闭</label>
                     </span>
                    </dt>
                    <?php  if( get_option("topImg") == 1 ){ ?>
                    <dd>  
                        <div class="flex">
                         <label type="button" class="qui-btn" style="background-color:<?php if ( get_option("colors") ){  echo get_option("colors");  } else { ?>  #0000CD <?php } ?>;">
                    		<span>选择图片</span> 
                            <input type="file" name="header"> 
                    	</label> 
                        <img src="<?php   if( $header_img ){ echo $header_img;  }else{  echo get_template_directory_uri().'/images/header.jpg'; } ?>
                        " width='500' height='50' > 
                        <?php if( get_option("header_img") ) { ?>
                        <span class="clear" data-name="header_img" @click="clearImg('header_img')">清空</span>
                         </div>
                        <?php } ?> 
                    </dd>
                    <?php } ?>
                </dl> 
                 <dl>
                    <dt>首页置顶滚动：
                     <span>
                        <input type="radio" name="indexScroll" value="1" @click="choseLabel('indexScroll','1')"  <?php   if( get_option("indexScroll") == 1 ){  echo 'checked'; } ?> id="open_tag"><label for="open_tag">开启</label>
                        <input type="radio" name="indexScroll"  value="0" @click="choseLabel('indexScroll','0')"  <?php  if( get_option("indexScroll") == 0 ){  echo 'checked'; } ?> id="close_tag"> <label for="close_tag" >关闭</label>
                     </span>
                    </dt>
                </dl> 
                <dl>
                    <dt>导航下显示7~10个标签：
                     <span>
                        <input type="radio" name="listtag" value="1" @click="choseLabel('listtag','1')"  <?php   if( get_option("listtag") == 1 ){  echo 'checked'; } ?> id="open_tag"><label for="open_tag">开启</label>
                        <input type="radio" name="listtag"  value="0" @click="choseLabel('listtag','0')"  <?php  if( get_option("listtag") == 0 ){  echo 'checked'; } ?> id="close_tag"> <label for="close_tag" >关闭</label>
                     </span>
                    </dt>
                </dl> 
			    <dl>
                    <dt>列表图-默认左图，抓取文章第一张图片：
                     <span><input type="radio" name="listimg" value="1" @click="choseLabel('listimg','1')" <?php  if( get_option("listimg") == 1 ){ echo 'checked'; } ?> id="open_list"><label for="open_list">开启</label>
                        <input type="radio" name="listimg"  value="0" @click="choseLabel('listimg','0')" <?php  if( get_option("listimg") == 0 ){   echo 'checked'; } ?> id="close_list"><label for="close_list" >关闭</label>
                     </span>
                    </dt>
                     <?php  if( get_option("listimg") == 1 ){   ?>
                    <dt>———切换右图：
                    <span><input type="radio" name="listimgr" value="1" @click="choseLabel('listimgr','1')" <?php  if( get_option("listimgr") == 1 ){ echo 'checked'; } ?> id="open_listr"><label for="open_listr">开启</label>
                        <input type="radio" name="listimgr"  value="0" @click="choseLabel('listimgr','0')" <?php  if( get_option("listimgr") == 0 ){  echo 'checked'; } ?> id="close_listr"><label for="close_listr" >关闭</label>
                     </span>
                    </dt>
                     <dt>文章相关推荐是否卡片化(请先开启列表图)：
                     <span>
                        <input type="radio" name="artCardRec" value="1" @click="choseLabel('artCardRec','1')" <?php  if( get_option("artCardRec") == 1 ){  echo 'checked'; } ?> id="open_artCardRec"><label for="open_artCardRec">开启</label>
                        <input type="radio" name="artCardRec"  value="0" @click="choseLabel('artCardRec','0')" <?php  if( get_option("artCardRec") == 0 ){  echo 'checked'; } ?> id="close_artCardRec"><label for="close_artCardRec" >关闭</label>
                     </span>
                    </dt>
                     <?php   } ?>
                </dl> 
                <dl>
                    <dt>隐藏注册登录：
                     <span>
                        <input type="radio" name="hidelogin" value="1" @click="choseLabel('hidelogin','1')"  <?php   if( get_option("hidelogin") == 1 ){  echo 'checked'; } ?> id="open_hidelogin"><label for="open_hidelogin">隐藏</label>
                        <input type="radio" name="hidelogin"  value="0" @click="choseLabel('hidelogin','0')"  <?php  if( get_option("hidelogin") == 0 ){  echo 'checked'; } ?> id="close_hidelogin"> <label for="close_hidelogin" >显示</label>
                     </span>
                    </dt>
                </dl> 
            </div>
            <div class="tab-content overflow-hide" v-show="navCur===2">    
                 <dl>
                    <dt>轮播图：
                     <span>
                        <input type="radio" name="bannerFlag" value="1" @click="choseLabel('bannerFlag','1')" <?php  if( get_option("bannerFlag") == 1 ){ echo 'checked'; } ?> id="open"><label for="open">开启</label>
                        <input type="radio" name="bannerFlag"  value="0" @click="choseLabel('bannerFlag','0')" <?php  if( get_option("bannerFlag") == 0 ){  echo 'checked'; } ?> id="close"><label for="close" >关闭</label>
                     </span>
                     <span class="banner-info">banner轮播图建议尺寸940px*280px</span>
                    </dt>
                </dl>
                <?php  if( get_option("bannerFlag") == 1 ){ ?>
                 <div class="bannerbox">
                    <dl>
                        <dt>轮播图一：</dt>
                        <dd>
                             <div class="flex"> 
                            <label type="button" class="qui-btn" style="background-color:<?php if ( get_option("colors") ){  echo get_option("colors");  } else { ?>  #0000CD <?php } ?>;">
                        		<span>选择图片</span> 
                                <input type="file" name="banner1">
                        	</label> 
                            <img src="<?php echo $banner_01; ?>" height=50 >
                            <?php if( get_option("banner_01") ) { ?>
                                <span class="clear" data-name="banner_01" @click="clearImg('banner_01')">清空</span>
                            <?php } ?>
                             </div>
                            <label for="weblink">链接：</label>
                            <input type="text" name="banner_link_01" value="<?php echo get_option("bannerLink01"); ?>">
                        </dd>
                    </dl> 
                    <dl>
                        <dt>轮播图二：</dt>
                        <dd>
                            <div class="flex">
                            <label type="button" class="qui-btn" style="background-color:<?php if ( get_option("colors") ){  echo get_option("colors");  } else { ?>  #0000CD <?php } ?>;">
                        		<span>选择图片</span> 
                                <input type="file" name="banner2">
                        	</label> 
                            <img src="<?php echo $banner_02; ?>" height=50 >
                            <?php if( get_option("banner_02") ) { ?>
                                <span class="clear" data-name="banner_02" @click="clearImg('banner_02')">清空</span>
                            <?php } ?> </div>
                            <label for="weblink">链接：</label>
                            <input type="text" name="banner_link_02" value="<?php echo get_option("bannerLink02"); ?>">
                        </dd>
                    </dl> 
                    <dl>
                        <dt>轮播图三：</dt>
                        <dd><div class="flex">
                            <label type="button" class="qui-btn" style="background-color:<?php if ( get_option("colors") ){  echo get_option("colors");  } else { ?>  #0000CD <?php } ?>;">
                        		<span>选择图片</span> 
                                <input type="file" name="banner3">
                        	</label> 
                            <img src="<?php echo $banner_03; ?>" height=50 ><?php if( get_option("banner_03") ) { ?>
                                <span class="clear" data-name="banner_03"  @click="clearImg('banner_03')">清空</span>
                            <?php } ?> </div>
                            <label for="weblink">链接：</label>
                            <input type="text" name="banner_link_03" value="<?php echo get_option("bannerLink03"); ?>">
                        </dd>
                    </dl> 
                    <dl>
                        <dt>轮播图四：</dt>
                        <dd><div class="flex">
                            <label type="button" class="qui-btn" style="background-color:<?php if ( get_option("colors") ){  echo get_option("colors");  } else { ?>  #0000CD <?php } ?>;">
                        		<span>选择图片</span> 
                                <input type="file" name="banner4">
                        	</label> 
                            <img src="<?php echo $banner_04; ?>" height=50 ><?php if( get_option("banner_04") ) { ?>
                                <span class="clear" data-name="banner_04"  @click="clearImg('banner_04')">清空</span>
                            <?php } ?> </div>
                            <label for="weblink">链接：</label>
                            <input type="text" name="banner_link_04" value="<?php echo get_option("bannerLink04"); ?>">
                        </dd>
                    </dl> 
                    <dl>
                        <dt>轮播图五：</dt>
                        <dd><div class="flex">
                            <label type="button" class="qui-btn" style="background-color:<?php if ( get_option("colors") ){  echo get_option("colors");  } else { ?>  #0000CD <?php } ?>;">
                        		<span>选择图片</span> 
                                <input type="file" name="banner5">
                        	</label> 
                            <img src="<?php echo $banner_05; ?>" height=50 ><?php if( get_option("banner_05") ) { ?>
                                <span class="clear" data-name="banner_05"  @click="clearImg('banner_05')">清空</span>
                            <?php } ?> </div>
                            <label for="weblink">链接：</label>
                            <input type="text" name="banner_link_05" value="<?php echo get_option("bannerLink05"); ?>">
                        </dd>
                    </dl> 
                 </div> 
                 <?php 
                    }
                 ?>
			</div>
			<div class="tab-content overflow-hide" v-show="navCur===3">
                <dl>
                    <dt>网站首页关键词：—— 用英文“,”或者“|”分割多个关键词！</dt>
                    <dd><input type="text" name="keywords" value="<?php echo get_option("keywords"); ?>"></dd>
                </dl>
                <dl>
                    <dt>网站首页描述：—— 网站描述尽量不要超过64个汉字！</dt>
                    <dd>
                        <textarea name="description"  @blur="changeTextarea('description',description)" v-model="description"></textarea>
                    </dd>
                </dl>
                <dl>
                    <dt>网站地图：—— 建议是html/xml/txt格式链接</dt>
                    <dd>
                        <input type="text" name="siteMap" value="<?php echo get_option("siteMap"); ?>"></input>
                    </dd>
                </dl>
                <dl>
                    <dt>友链：
                     <span>
                        <input type="radio" name="weblink" value="1" @click="choseLabel('weblink','1')"  <?php  if( get_option("weblink") == 1 ){  echo 'checked'; }
                        ?> id="open"><label for="open">开启</label>
                        <input type="radio" name="weblink"  value="0" @click="choseLabel('weblink','0')"  <?php  if( get_option("weblink") == 0 ){ echo 'checked'; }
                        ?> id="close"> <label for="close" >关闭</label>
                     </span>
                    </dt>
                </dl>
                <dl>
                    <dt>统计代码：—— 必须带上&lt;script&gt;统计代码&lt;/script&gt;</dt>
                    <dd>
                        <textarea  name="web_static"><?php echo get_option("web_static"); ?></textarea>
                    </dd>
                </dl>
            </div>
			<div class="tab-content overflow-hide" v-show="navCur===4">
                <dl>
                    <dt>客服热线/电话：</dt>
                    <dd><input type="text" name="phone_num" value="<?php echo get_option("phone_num"); ?>"> </dd>
                </dl>
                <dl>
                    <dt>全站/客服QQ：</dt>
                    <dd><input type="text" name="qq_num" value="<?php echo get_option("qq_num"); ?>"> </dd>
                </dl>
                <dl>
                    <dt>微信二维码</dt>
                    <dd> 
                         <div class="flex">
                            <label type="button" class="qui-btn" style="background-color:<?php if ( get_option("colors") ){  echo get_option("colors");  } else { ?>  #0000CD <?php } ?>;">
                        		<span>选择图片</span> 
                                <input type="file" name="wx" id="upbottom"> 
                        	</label> 
                            <img src="<?php echo get_option("wx_img") ?>" height=50 ><?php if( get_option("wx_img") ) { ?>
                                <span class="clear" data-name="wx_img"  @click="clearImg('wx_img')">清空</span>
                            <?php } ?> 
                        </div>  
                </dl>
                <dl>
                    <dt>QQ群二维码</dt>
                    <dd> 
                         <div class="flex">
                            <label type="button" class="qui-btn" style="background-color:<?php if ( get_option("colors") ){  echo get_option("colors");  } else { ?>  #0000CD <?php } ?>;">
                        		<span>选择图片</span> 
                                <input type="file" name="qq" id="upbottom"> 
                        	</label> 
                            <img src="<?php echo get_option("qq_img") ?>" height=50 ><?php if( get_option("qq_img") ) { ?>
                                <span class="clear" data-name="qq_img" @click="clearImg('qq_img')">清空</span>
                            <?php } ?> 
                        </div>
                    </dd>
                </dl>
            </div>
            <div class="tab-content overflow-hide" v-show="navCur===5">
				<dl> 
				     <dt>文章开启打赏：
                     <span>
                        <input type="radio" name="sangFlag" value="1" @click="choseLabel('sangFlag','1')"  <?php  if( get_option("sangFlag") == 1 ){ echo 'checked';} ?> id="sangFlagopen"><label for="sangFlagopen">开启</label>
                        <input type="radio" name="sangFlag"  value="0" @click="choseLabel('sangFlag','0')"  <?php  if( get_option("sangFlag") == 0 ){  echo 'checked';  } ?> id="sangFlagclose"><label for="sangFlagyclose" >关闭</label>
                     </span>
                    </dt>
				</dl>
				<?php  if( get_option("sangFlag") == 1 ){ ?>
				<dl>
                    <dt>支付宝收款二维码：</dt>
                    <dd> 
                         <div class="flex">
                            <label type="button" class="qui-btn" style="background-color:<?php if ( get_option("colors") ){  echo get_option("colors");  } else { ?>  #0000CD <?php } ?>;">
                        		<span>选择图片</span> 
                                <input type="file" name="sang" id="upbottom"> 
                        	</label> 
                            <img src="<?php echo get_option("sang_img") ?>" height=50 ><?php if( get_option("sang_img") ) { ?>
                                <span class="clear" data-name="sang_img" @click="clearImg('sang_img')">清空</span>
                            <?php } ?> 
                        </div>
                    </dd>
                </dl>
                <dl>
                    <dt>微信收款二维码：</dt>
                    <dd> 
                         <div class="flex">
                            <label type="button" class="qui-btn" style="background-color:<?php if ( get_option("colors") ){  echo get_option("colors");  } else { ?>  #0000CD <?php } ?>;">
                        		<span>选择图片</span> 
                                <input type="file" name="sangwx" id="upbottom"> 
                        	</label> 
                            <img src="<?php echo get_option("sangwx_img") ?>" height=50 ><?php if( get_option("sangwx_img") ) { ?>
                                <span class="clear" data-name="sangwx_img" @click="clearImg('sangwx_img')">清空</span>
                            <?php } ?> 
                        </div>
                    </dd>
                </dl>
                <dl>
                    <dt>打赏提示文字：</dt>
                    <dd><input type="text" name="sang_txt" value="<?php echo get_option("sang_txt"); ?>"> </dd>
                </dl>
                <?php } ?>
            </div>
			<div class="tab-content overflow-hide" v-show="navCur===6">
				<dl> 
				      <dt>代码一键复制（PS:该功能只针对复制代码有效）：
                     <span>
                        <input type="radio" name="codeCopy" value="1" @click="choseLabel('codeCopy','1')" <?php  if( get_option("codeCopy") == 1 ){ echo 'checked';} ?> id="codeCopyopen"><label for="codeCopyopen">开启</label>
                        <input type="radio" name="codeCopy"  value="0" @click="choseLabel('codeCopy','0')"  <?php  if( get_option("codeCopy") == 0 ){ echo 'checked'; } ?> id="codeCopyclose"><label for="codeCopyclose" >关闭</label>
                     </span>
                    </dt>
                </dl>
                <dl> 
				     <dt>网站一键变灰：
                     <span>
                        <input type="radio" name="grayCopy" value="1" @click="choseLabel('grayCopy','1')"  <?php   if( get_option("grayCopy") == 1 ){ echo 'checked';} ?> id="grayCopyopen"><label for="grayCopyopen">开启</label> 
                        <input type="radio" name="grayCopy"  value="0" @click="choseLabel('grayCopy','0')"  <?php  if( get_option("grayCopy") == 0 ){  echo 'checked'; } ?> id="grayCopyclose"><label for="grayCopyclose" >关闭</label>
                     </span>
                    </dt>
                </dl>
                <dl> 
				      <dt>网站居中弹框：
                     <span>
                        <input type="radio" name="boomSwitch" value="1" @click="choseLabel('boomSwitch','1')"  <?php  if( get_option("boomSwitch") == 1 ){ echo 'checked';} ?> id="boomOpen"><label for="boomOpen">开启</label>
                        <input type="radio" name="boomSwitch"  value="0"  @click="choseLabel('boomSwitch','0')" <?php  if( get_option("boomSwitch") == 0 ){  echo 'checked'; } ?> id="boomClose"><label for="boomClose" >关闭</label>
                     </span>
                    </dt>
                </dl>
                <?php if( get_option("boomSwitch") == 1 ){ ?>
                <dl>
                        <dt>居中弹框广告：</dt>
                        <dd>
                             <div class="flex"> 
                            <label type="button" class="qui-btn" style="background-color:<?php if ( get_option("colors") ){  echo get_option("colors");  } else { ?>  #0000CD <?php } ?>;">
                        		<span>选择图片</span> 
                                <input type="file" name="boom1">
                        	</label> 
                            <img src="<?php echo $boom_01; ?>" height=50 >
                            <?php if( get_option("boom_01") ) { ?>
                                <span class="clear" data-name="boom_01" @click="clearImg('boom_01')">清空</span>
                            <?php } ?>
                             </div>
                            <label for="weblink">链接：</label>
                            <input type="text" name="boom_link_01" value="<?php echo get_option("boomLink01"); ?>">
                        </dd>
                </dl><?php } ?>
                <dl>
                   <dt>文字公告：—— 简述通知的内容</dt>
                      <dd><textarea name="noticeText"><?php echo get_option("noticeText"); ?></textarea></dd>
                   </dl>
                <dl>
                    <dt>文章广告代码：修改后请保存</dt>
                    <dd>
                        <textarea name="ad_single"><?php echo get_option("ad_single"); ?></textarea>
                    </dd>
                </dl>
            </div>
        </div>
    </div>   
    <div class="view-go">
         <input type="submit" name="theme_set" style="background:<?php if ( get_option("colors") ){  ?> <?php echo get_option("colors"); } else { ?> #0000CD <?php }  ?> "  value="保存设置">
          <p style="color:#999;font-size:12px">保存之后立即生效，无缓存写入数据库！</p>
	</div>
</div>
</form>
<!-- end -->
<!-- 引入js -->
<script src="https://cdn.bootcdn.net/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/vue/2.6.12/vue.min.js"></script>
<script type="text/javascript">
	$(function() {
	    var app,curColor;
	    let Description="<?php echo get_option("description"); ?>";
	    init();
	    function init(){
	        jqueryCode();
	        vueCode();
	    }
	    function vueCode(){
	        app = new Vue({
                el:'#app',
                data:{
                    title:'QUI-Pure主题设置',
                    navs:[
                     {title:'基础设置'},{title:'布局设置'},{title:'轮播图设置'},{title:'SEO设置'},{title:'联系方式'},{title:'打赏功能'},{title:'其他'}
                    ],
                    navCur:0,
                    curCor: curColor,
                    description:Description
                },
                methods:{
                    tabClick:function(i){
						this.navCur = i
					},
					changeTextarea:function(name,val){
					    let names = name;
                        $.ajax({
                            type: "post",
                            url: "<?php bloginfo('template_url'); ?>/admin/ajaxPost.php",
                            data: "do=textarea&text_name="+names+"&text_val="+val,
                            dataType: "text",
                            success: function (data) {
                                console.log("修改成功！")
                            },
                            error: function (err) {
                                console.log("修改失败！"+err)
                            }
            			})
					},
					choseLabel:function(name,val){
					    let names = name;
                        $.ajax({
                            type: "post",
                            url: "<?php bloginfo('template_url'); ?>/admin/ajaxPost.php",
                            data: "do=chose&chose_name="+names+"&chose_val="+val,
                            dataType: "text",
                            success: function (data) {
                                console.log("切换设置成功！")
                            },
                            error: function (err) {
                                console.log("切换设置失败！"+err)
                            }
            			})
					},
					clearImg:function(name){
					    let names = name;
                        $.ajax({
                            type: "post",
                            url: "<?php bloginfo('template_url'); ?>/admin/ajaxPost.php",
                            data: "do=clear&clear_name="+names,
                            dataType: "text",
                            success: function (data) {
                                alert("图片清除成功！");
                                location.reload();
                            },
                            error: function () {
                                alert("图片清除失败！"+err)
                            }
            			})
					}
                }
            })
	    }
	    function jqueryCode(){
            color();
	    }
	    function color(){
	        curColor =  $("#color").html()
	    }
		
	})
</script>