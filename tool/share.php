        <script src="<?php bloginfo('template_url'); ?>/static/js/jquery.qrcode.js" type="text/javascript" charset="utf-8"></script>
		<script src="<?php bloginfo('template_url'); ?>/static/js/d2i.js" type="text/javascript" charset="utf-8"></script>
		<script src="<?php bloginfo('template_url'); ?>/static/js/save.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			$(function() {
			    $(".CreatCode").click(function(){
			            $("body").addClass("disableScroll");
                        
			            $(".canvas-baner").fadeIn(); 
			            $(".canvas-baner").css({
                            'filter': 'blur(0px)'
                        });
			        	let urls = window.location.href;
        				CreatCode(urls); //生成二维码
			    })
			    function CreatCode(a) {
        					if(a) {
        						$('#qrcode').qrcode({
        							width: 80,
        							height: 80,
        							text: a
        						});
        					}
        		}
			    let flag = false;
        		$(".saveImgMsg").click(function() {
        					if(!flag) {  
                                domtoimage.toBlob(document.getElementById('canvas')).then(function (blob) {
                                        window.saveAs(blob, 'share.png');
                                }); 
        						return flag;
        					}
        		})
			    $(".qui-boom").click(function() {
			         $("body").removeClass("disableScroll");
			        $(".canvas-baner").fadeOut(200);
			    })
			})
		</script>