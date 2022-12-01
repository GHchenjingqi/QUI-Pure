init();
//初始化函数
async function init(){
    quiZan();
    quiCang();
    quiGuan();
    quiDie();
    seach();
    wapMenu();
    shareClose();
    marqueeUp("parent","list","list1",40);
    hideBoom($(".qui-close-btn"),$(".web-center-boom"));
    hideBoom($(".reward-close"),$(".reward-slide"));
  
}
function ablog(){ // 谷歌谷歌判断
    setTimeout(function() {
      let txt =  $(".adsbygoogle").attr("data-ad-status");
      if(txt == 'unfilled'){
          $(".adsbygoogle").css({"display":"none","overflow":"hidden","height":"0px"})
          console.log('谷歌加载失败'+txt)
      }
    }, 2000);
}
// 点赞js
function quiZan(){
    $.fn.postLike = function() {
    if ($(this).hasClass('done')) {
    return false;
    } else {
        $(this).addClass('done');
        var id = $(this).data("id"),
        action = $(this).data('action'),
        rateHolder = $(this).children('.count');
        var ajax_data = {
        action: "bigfa_like",
        um_id: id,
        um_action: action
    };
    $.post("/wp-admin/admin-ajax.php", ajax_data,
    function(data) {
        $(rateHolder).html(data);
    });
      return false;
    }
   };
   $(document).on("click", ".favorite",function() {
    $(this).postLike();
   }); 
}

// 收藏
function quiCang(){
    $('a.shoucang').click(function(){
        var id = $(this).data("id");
        $.ajax({
            url: "/wp-admin/admin-ajax.php",
            type:'post',
            dataType:'json',
            data:{action:'post_shoucang',id:id},
            success: function(data){
                if(data == false) {
                    alert('请先登录。');
                    location.href = "<?php echo get_bloginfo('url'); ?>/wp-login.php"; //跳转到登录页面
                }else{
                    
                    if(data.msg !== '已取消收藏' && data.msg !== '请先登录才能收藏哦!'){
                        $("a.shoucang span").text(data.msg);
                        $("a.shoucang").addClass('done');
                    }else{
                        $("a.shoucang span").text('收藏');
                        $("a.shoucang").removeClass('done')
                    }
                    alert(data.msg);
                } 
            } 
        });
            
    });
    // 取消收藏
    $(".cancleCang").click(function(){
        var id = $(this).data("id");
        $.ajax({
            url: "/wp-admin/admin-ajax.php",
            type:'post',
            dataType:'json',
            data:{action:'post_shoucang',id:id},
            success: function(data){
                alert(data.msg);
                window.location.reload();
            } 
        });
    })
}

// 点击关注
function quiGuan(){
    $(".guan_zu").click(function(){
        var uid = this.id;
        alert(uid)
        $.ajax({
            url: "http://wp.com/wp-content/themes/qui/author_fanc.php", //php处理文件
            type:'post',
            data:{ uid:uid,action:'add_fanc' },
            success:function(e){
                if(e=='false'){
                alert('请先登录。');
                location.href = "<?php echo get_bloginfo('url'); ?>/wp-login.php"; //跳转到登录页面
                return;
                }else{
                location.href=location.href;
                }
            }
        })
    })
}

// 标签折叠
function quiDie(){
    $(".open-tag").click(function(){
		$(this).hide();
		$(".more-tag").show();
        $(".tab-cat-tag").removeClass("close");
    })
    $(".more-tag").click(function(){
        $(this).hide();
    	$(".open-tag").show();
        $(".tab-cat-tag").addClass("close");
    })
}

// 搜索框
function seach(){
    $(".topSearchIcon").click(function(){
        $(".qui-boom-bai").fadeIn(500);
        $("body").addClass("disScroll");
        $(".search-input").focus();
    })
    $(".colse-bai svg").click(function(){
		$(".qui-boom-bai").fadeOut(500);
        $("body").removeClass("disScroll");
	})
}

// 移动菜单
function wapMenu(){
    $(".wap_mune").click(function(){
 		$(".wapSlider").show();
 	})
 	$(".wapclose").click(function(){
 		$(".wapSlider").hide();
 	})
}

// 文章分享关闭
function shareClose(){
    $(".close-boom").click(function(){
     	$(".canvas-baner").hide();
    }) 
}

// 打赏无缝上滚	
function marqueeUp(a,b,c,d){
    if(  $("#"+a).length > 0 ){
        let parent = document.getElementById(a);
        let child1 = document.getElementById(b);
        let child2 = document.getElementById(c);
        child2.innerHTML = child1.innerHTML;
        let timer = setInterval(function() {
        if(parent.scrollTop >= child1.scrollHeight) {
           parent.scrollTop = 0;
        } else {
           parent.scrollTop++;
        }
        }, d);
        parent.onmouseenter = function() {
        clearTimeout(timer)
        }
        parent.onmouseleave = function() {
        marqueeUp("parent","list","list1",40)
        }
    }
}

//弹框隐藏
function hideBoom(a,b){
    a.click(function(){
    	b.fadeOut(500);
    })
}

function goto(id){
	let ids = document.getElementById(id);
	ids.scrollIntoView({behavior:"smooth",block:"start",inline:"nearest"})
}