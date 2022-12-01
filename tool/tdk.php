<?php 
  if (is_home() && is_front_page() ){  // 首页
?><title><?php bloginfo('description'); ?> - <?php bloginfo('name'); ?></title> 
      <meta name="keywords" content="<?php echo get_option("keywords"); ?>">
      <meta name="description" content="<?php echo get_option("description"); ?>">
      <meta property="og:title" content="<?php bloginfo('name'); ?>-<?php bloginfo('description'); ?>">
      <meta property="og:site_name " content="<?php bloginfo('name'); ?>"> 
      <meta property="og:description" content="<?php echo get_option("description"); ?> ">
      <meta property="og:image" content="<?php echo get_option("logo_img") ?>">
<?php 
  }else if( is_single() ){ //文章页
    $keywords = get_post_meta($post->ID, "keywords", true);
    $description = get_post_meta($post->ID, "description", true);
    if($keywords == ""){
        $tags = wp_get_post_tags($post->ID);
        foreach ($tags as $tag){
        $keywords = $keywords.$tag->name.",";
        }
        $keywords = rtrim($keywords, ',');
    }
    if($description == ""){
        if($post->post_excerpt){
        $description = $post->post_excerpt;
			 $description = trim(strip_tags($description));
        }else{
        $description = mb_strimwidth(strip_tags(apply_filters('the_content',$post->post_content)),0,160);
			 $description = trim(strip_tags($description));
        } 
		
    }
	  function myTrim($str)
		{
		 $search = array(" ","　","\n","\r","\t");
		 $replace = array("","","","","");
		 return str_replace($search, $replace, $str);
		}
	  $description = myTrim( $description);
    $keywords = trim(strip_tags($keywords));
?>
<title><?php the_title(); ?>-<?php bloginfo('name'); ?></title> 
    <meta name="keywords" content="<?php echo $keywords ?>">
    <meta name="description" content="<?php echo $description ?>">
<?php 
} else if( is_category() ){ // 分类页
    $cat_id = get_query_var('cat');
    $titles = get_option('categorytitle-'.$cat_id);
    $keywords = single_cat_title('', false);
    $description = category_description();
    $keywords =  get_option('categorykws-'.$cat_id) ? get_option('categorykws-'.$cat_id) : trim(strip_tags($keywords));
    $description = trim(strip_tags($description));
?><?php if(  $titles ){ ?>
<title><?php echo $titles ?></title><?php }else{ ?><title><?php echo single_cat_title() ?>-<?php bloginfo('name'); ?></title><?php }?>  
    <meta name="keywords" content="<?php echo $keywords ?>">
    <meta name="description" content="<?php echo $description ?>">
<?php 
}   else if( is_tag() ){ // 标签页
    $keywords = single_tag_title('', false);
    $description = tag_description();
    $keywords = trim(strip_tags($keywords));
    $description = trim(strip_tags($description));
?>
<title><?php echo single_cat_title() ?>-<?php bloginfo('name'); ?></title> 
    <meta name="keywords" content="<?php echo $keywords ?>">
    <meta name="description" content="<?php echo $description ?>">
<?php 
}  else if( is_page() ){ //专题单页
    $keywords = get_post_meta($post->ID, "keywords", true);
    $description = get_post_meta($post->ID, "description", true);
    $keywords = trim(strip_tags($keywords));
    $description = trim(strip_tags($description));
?>
<title><?php the_title(); ?>-<?php bloginfo('name'); ?></title> 
    <meta name="keywords" content="<?php echo $keywords ?>">
    <meta name="description" content="<?php echo $description ?>">
<?php 
}  else if( is_search()  ){ //搜索页
?>
<title>搜索结果：<?php echo $s; ?> —<?php bloginfo('name'); ?></title> 
<?php 
} else if( is_404() ){ ?>
<title>'页面失恋了，没有对象'-<?php bloginfo('name'); ?></title> 
<?php
}
?>