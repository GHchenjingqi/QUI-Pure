<?php
if( !empty( $_POST['theme_set'] ) ){
    $attachment_id = media_handle_upload( 'logo', 0 ); //上传图片，返回的是 附件的ID
    if(gettype($attachment_id)!='object'){
         $logo_url = wp_get_attachment_url($attachment_id); //获取 图片的地址
    } 
    if(!empty( $logo_url )){
        update_option("logo_img",$logo_url); //如果图片地址在在，就将图片的地址写入到数据库
    }

    $attachment_f_id = media_handle_upload( 'logo_f', 0 ); //上传图片，返回的是 附件的ID
    if(gettype($attachment_f_id) !='object'){
        $logo_f_url = wp_get_attachment_url($attachment_f_id); //获取 图片的地址
    }
    if(!empty( $logo_f_url )){
        update_option("logo_f_img",$logo_f_url); //如果图片地址在在，就将图片的地址写入到数据库
    }
    
        $attachment_id_header = media_handle_upload( 'header', 0 ); //上传图片，返回的是 附件的ID
        if(gettype($attachment_id_header)!='object'){
            $header_url = wp_get_attachment_url($attachment_id_header); //获取 图片的地址
        }
       
        if(!empty( $header_url )){
            update_option("header_img",$header_url); //如果图片地址在在，就将图片的地址写入到数据库
        }

    if( get_option("bannerFlag") == 1){
        if(!isset($_POST['banner1'])){
          $attachment_id_header1 = media_handle_upload( 'banner1', 0 ); //上传图片，返回的是 附件的ID
          if(gettype($attachment_id_header1)!='object'){
              $banner01 = wp_get_attachment_url($attachment_id_header1); //获取 图片的地址
          }
          if(!empty( $banner01 )){
              update_option("banner_01",$banner01); //如果图片地址在在，就将图片的地址写入到数据库
          }
        }
        
        if(!isset($_POST['banner2'])){
          $attachment_id_header2 = media_handle_upload( 'banner2', 0 ); //上传图片，返回的是 附件的ID
          if(gettype($attachment_id_header2)!='object'){
             $banner02 = wp_get_attachment_url($attachment_id_header2); //获取 图片的地址
             
              if(!empty( $banner02 )){
                  update_option("banner_02",$banner02); //如果图片地址在在，就将图片的地址写入到数据库
              }
          }
          
          
        }
        
        if(!isset($_POST['banner3'])){
          $attachment_id_header3 = media_handle_upload( 'banner3', 0 ); //上传图片，返回的是 附件的ID
          if(gettype($attachment_id_header3)!='object'){
              $banner03 = wp_get_attachment_url($attachment_id_header3); //获取 图片的地址
              if(!empty( $banner03)){
                  update_option("banner_03",$banner03); //如果图片地址在在，就将图片的地址写入到数据库
              }
          }
          
        }
        
        
        if(!isset($_POST['banner4'])){
          $attachment_id_header4 = media_handle_upload( 'banner4', 0 ); //上传图片，返回的是 附件的ID
          if(gettype($attachment_id_header4)!='object'){
              $banner04 = wp_get_attachment_url($attachment_id_header4); //获取 图片的地址
              if( !empty($banner04)){
                  update_option("banner_04",$banner04); //如果图片地址在在，就将图片的地址写入到数据库
              }
          }
         
        }
        
        
        if(!isset($_POST['banner5'])){
          $attachment_id_header5 = media_handle_upload( 'banner5', 0 ); //上传图片，返回的是 附件的ID
          if(gettype($attachment_id_header5)!='object'){
              $banner05 = wp_get_attachment_url($attachment_id_header5); //获取 图片的地址
              if(!empty($banner05)){
                  update_option("banner_05",$banner05); //如果图片地址在在，就将图片的地址写入到数据库
              }
          }
         
        }
    }
  
    $attachment_id_wx = media_handle_upload( 'wx', 0 ); //上传图片，返回的是 附件的ID
    if(gettype($attachment_id_wx)!='object'){
         $wx_url = wp_get_attachment_url($attachment_id_wx); //获取 图片的地址
         if(!empty($wx_url)){
            update_option("wx_img",$wx_url); //如果图片地址在在，就将图片的地址写入到数据库
         }
    }
    

    $attachment_id_qq = media_handle_upload( 'qq', 0 ); //上传图片，返回的是 附件的ID
    if(gettype($attachment_id_qq)!='object'){
        $qq_url = wp_get_attachment_url($attachment_id_qq); //获取 图片的地址
        if(!empty($qq_url)){
            update_option("qq_img",$qq_url); //如果图片地址在在，就将图片的地址写入到数据库
        }
    }
    
 
    if( get_option("sangFlag") == 1){
      if(!isset($_POST['sang'])){
        $attachment_id_sang = media_handle_upload( 'sang', 0 ); //上传图片，返回的是 附件的ID
        if(gettype($attachment_id_sang)!='object'){
         $sang_url = wp_get_attachment_url($attachment_id_sang); //获取 图片的地址
         if(!empty($sang_url)){
            update_option("sang_img",$sang_url); //如果图片地址在在，就将图片的地址写入到数据库
         }
        }
       
      }
        
      if(!isset($_POST['sangwx'])){
        $attachment_id_sang1 = media_handle_upload( 'sangwx', 0 ); //上传图片，返回的是 附件的ID
        if(gettype($attachment_id_sang1)!='object'){
            $sang_url1 = wp_get_attachment_url($attachment_id_sang1); //获取 图片的地址
            if(!empty($sang_url1)){
                 update_option("sangwx_img",$sang_url1); //如果图片地址在在，就将图片的地址写入到数据库
            }
        }
        
      }  
        
    }
    if( get_option("boomSwitch") == 1){
      if(!isset($_POST['boom1'])){
        $attachment_id_boom1 = media_handle_upload( 'boom1', 0 ); //上传图片，返回的是 附件的ID
        if(gettype($attachment_id_boom1)!='object'){
             $boom01 = wp_get_attachment_url($attachment_id_boom1); //获取 图片的地址
             if(!empty($boom01)){
                update_option("boom_01",$boom01); //如果图片地址在在，就将图片的地址写入到数据库
             }
        }
       
      }
    }
    
        if(!empty( $_POST["beian"] )){
            update_option("beian", $_POST["beian"]); //更新数据表中的备案字段的值
        }
        if(!empty( $_POST["gongan"] )){
            update_option("gongan", $_POST["gongan"]); //更新数据表中的备案字段的值
        }
        if(!empty( $_POST["map"] )){
           update_option("map",$_POST["map"]);
        }
        if(!empty( $_POST["keywords"] )){
           update_option("keywords",$_POST["keywords"]);
        }
        if(!empty( $_POST["description"] )){
           update_option("description",$_POST["description"]);
        }
        if(!empty( $_POST["phone_num"] )){
           update_option("phone_num",$_POST["phone_num"]);
        }
        if(!empty( $_POST["colors"] )){
           update_option("colors",$_POST["colors"]);
        }
        if(!empty( $_POST["qq_num"] )){
            update_option("qq_num",$_POST["qq_num"]);
        }
        if(!empty( $_POST["weblink"] )){
           update_option("weblink",$_POST["weblink"]);
        }
        if(!empty( $_POST["listimg"] )){
           update_option("listimg",$_POST["listimg"]);
        }
        if(!empty( $_POST["listimgr"] )){
           update_option("listimgr",$_POST["listimgr"]);
        }
        if(!empty( $_POST["listtag"] )){
           update_option("listtag",$_POST["listtag"]); 
        }
        if(!empty( $_POST["indexScroll"] )){
           update_option("indexScroll",$_POST["indexScroll"]); 
        }
        if(!empty( $_POST["hidelogin"] )){
          update_option("hidelogin",$_POST["hidelogin"]);
        }
        if(!empty( $_POST["artCardRec"] )){
          update_option("artCardRec",$_POST["artCardRec"]);
        }
        if(!empty( $_POST["codeCopy"] )){
          update_option("codeCopy",$_POST["codeCopy"]);
        }
        if(!empty( $_POST["navtop"] )){
          update_option("navtop",$_POST["navtop"]); 
        }
        if(!empty( $_POST["grayCopy"] )){
          update_option("grayCopy",$_POST["grayCopy"]);
        }
        if(!empty( $_POST["sangFlag"] )){
          update_option("sangFlag",$_POST["sangFlag"]);
        }
        if(!empty( $_POST["sang_txt"] )){
          update_option("sang_txt",$_POST["sang_txt"]);
        }
        if(!empty( $_POST["topImg"] )){
          update_option("topImg",$_POST["topImg"]);
        }
        if(!empty( $_POST["siteMap"] )){
          update_option("siteMap",$_POST["siteMap"]);
        }
        if(!empty( $_POST["web_static"] )){
          update_option("web_static",stripslashes($_POST["web_static"]));
        }
        if(!empty( $_POST["ad_single"] )){
          update_option("ad_single",stripslashes($_POST["ad_single"]));
        }
        if(!empty( $_POST["blackM"] )){
          update_option("blackM",$_POST["blackM"]);
        }
        if(!empty( $_POST["banStyle"] )){
          update_option("bannerStyle",$_POST["banStyle"]);
        }
        if(!empty( $_POST["banner_link_01"] )){
          update_option("bannerLink01",$_POST["banner_link_01"]); 
        }
        if(!empty( $_POST["banner_link_02"] )){
          update_option("bannerLink02",$_POST["banner_link_02"]); 
        }
        if(!empty( $_POST["banner_link_03"] )){
          update_option("bannerLink03",$_POST["banner_link_03"]); 
        }
        if(!empty( $_POST["banner_link_04"] )){
          update_option("bannerLink04",$_POST["banner_link_04"]); 
        }
        if(!empty( $_POST["banner_link_05"] )){
          update_option("bannerLink05",$_POST["banner_link_05"]); 
        }
        if(!empty( $_POST["boomSwitch"] )){
          update_option("boomSwitch",$_POST["boomSwitch"]);
        }
        if(!empty( $_POST["boom_link_01"] )){
          update_option("boomLink01",$_POST["boom_link_01"]); 
        }
        if(!empty( $_POST["bannerFlag"] )){
          update_option("bannerFlag",$_POST["bannerFlag"]);
        }

}
$wx_img = get_option("wx_img");
$qq_img = get_option("qq_img");
$logo_img = get_option("logo_img");
$logo_f_img = get_option("logo_f_img");
$header_img = get_option("header_img");
$banner_01 = get_option("banner_01");
$banner_02 = get_option("banner_02");
$banner_03 = get_option("banner_03");
$banner_04 = get_option("banner_04");
$banner_05 = get_option("banner_05");
$boom_01 = get_option("boom_01");

?>