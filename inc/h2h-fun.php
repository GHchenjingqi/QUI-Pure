<?php 
// 功能

$category_meta = array(
    array(
    "name" => "categorytitle",
    "std" => "",
    "title" => __('自定义分类标题', 'qui').'：',
    'desc' => __('在HTML的title标签中，自定义分类标题将覆盖默认分类标题', 'qui')
    ),
    array(
        "name" => "categorykws",
        "std" => "",
        "title" => __('自定义分类关键词', 'qui').'：',
        'desc' => __('在HTML的keywords标签中，自定义分类关键词将覆盖默认分类关键词', 'qui')
    ), 
);
 
function qui_add_category_field(){
    global $category_meta;
    foreach($category_meta as $meta_box) {
        echo '<div class="form-field">
        <label for="'.$meta_box['name'].'">'.$meta_box['title'].'</label>
        <input name="'.$meta_box['name'].'" id="'.$meta_box['name'].'" type="text" value="" size="40">
        <p>'.$meta_box['desc'].'</p>
        </div>';
    }
}
 
function qui_edit_category_field($tag){
    global $category_meta;
        foreach($category_meta as $meta_box) {
        echo '<tr class="form-field">
        <th scope="row"><label for="'.$meta_box['name'].'">'.$meta_box['title'].'</label></th>
        <td>
        <input name="'.$meta_box['name'].'" id="'.$meta_box['name'].'" type="text" value="'; 
        echo get_option(''.$meta_box['name'].'-'.$tag->term_id).'" size="40"/><br>
        <span class="'.$meta_box['name'].'">'.$meta_box['desc'].'</span>
        </td>
        </tr>';
    } 
}
 
function qui_category_save($term_id){
    global $category_meta;
    foreach($category_meta as $meta_box) {
        $data = $_POST[$meta_box['name']];
        if(isset($data)){
            if(!current_user_can('manage_categories')){
                 return $term_id;
            }
            $key = $meta_box['name'].'-'.$term_id;
            update_option( $key, $data );
        }
    }
}
add_action('category_add_form_fields','qui_add_category_field',10,2);
add_action('category_edit_form_fields','qui_edit_category_field',10,2);
add_action('created_category','qui_category_save',10,1);
add_action('edited_category','qui_category_save',10,1);


//新增点击量并允许排序
add_filter('manage_posts_columns', function($columns){
	$columns['views']	= __('点击量');
	return $columns;
});

add_action('manage_posts_custom_column',function($column_name,$id){
	if ($column_name != 'views'){
		return;
	}
	if ( get_post_meta($id, "views",true) == '' ){ //增加没有 views 字段处理，否则 PHP 8 环境会报错
		echo '0';
	} else {
		echo get_post_meta($id, "views",true);
	}
},10,2);

add_filter( 'manage_edit-post_sortable_columns', function ( $columns ) {
    $columns['views'] = 'views';
    return $columns;  
});
add_action( 'load-edit.php', function() {  
    add_filter( 'request', 'theme_admin_sort_views' );  
});
function theme_admin_sort_views( $vars ) {     
 	if ( isset( $vars['orderby'] ) && 'views' == $vars['orderby'] ) {  
		$vars = array_merge(  
			$vars,  
			array(  
				'meta_key' => 'views',  
				'orderby' => 'meta_value_num'  
			)  
		);  
	}   
	return $vars;  
}


function get_current_category_id() {
    $current_category = single_cat_title('', false);//获得当前分类目录名称
    return get_cat_ID($current_category);//获得当前分类目录ID
 }

//新增修改时间
function add_views_column($columns) {  
    $columns['post_modified'] = '修改时间';  
    return $columns;  
}  
add_filter('manage_posts_columns' , 'add_views_column');

//修改时间
function views_column_content($column_name, $post_id) {  
    if ($column_name == 'post_modified') {  
        $views_value = get_the_modified_time('Y-n-j');  
        echo ($views_value );  
    }  
}  
add_action('manage_posts_custom_column', 'views_column_content', 10, 2);

/**  
	*参数$title 字符串 页面标题  
	*参数$slug  字符串 页面别名  
	*参数$page_template 字符串  模板名  
	*无返回值  
	**/  
	function QUI_add_page($title,$slug,$page_template=''){   
	    $allPages = get_pages();//获取所有页面   
	    $exists = false;   
	    foreach( $allPages as $page ){   
	        //通过页面别名来判断页面是否已经存在   
	        if( strtolower( $page->post_name ) == strtolower( $slug ) ){   
	            $exists = true;   
	        }   
	    }   
	    if( $exists == false ) {   
	        $new_page_id = wp_insert_post(   
	            array(   
	                'post_title' => $title,   
	                'post_type'     => 'page',   
	                'post_name'  => $slug,   
	                'comment_status' => 'closed',   
	                'ping_status' => 'closed',   
	                'post_content' => '',   
	                'post_status' => 'publish',   
	                'post_author' => 1,   
	                'menu_order' => 0   
	            )   
	        );   
	        //如果插入成功 且设置了模板   
	        if($new_page_id && $page_template!=''){   
	            //保存页面模板信息   
	            update_post_meta($new_page_id, '_wp_page_template',  $page_template);   
	        }   
	    }   
	}
//创建必备页面
function QUIAddPages() {   
	  global $pagenow;   
	  //判断是否为激活主题页面   
	  if ( 'themes.php' == $pagenow || isset( $_GET['activated'] ) ){   
	    QUI_add_page('热门页面','hot','index_hot.php');
	    QUI_add_page('用户中心','user','user.php');
	    QUI_add_page('友链申请','links','link.php');
	    QUI_add_page('留言板','feed','feed.php');
	   }
}   
add_action( 'load-themes.php', 'QUIAddPages' );  


//开启缩略图
if ( function_exists('add_theme_support') )  add_theme_support('post-thumbnails'); //开启缩略图
//获取第一张图
function get_content_first_image($content){
    if ( $content === false ) $content = get_the_content();
    preg_match_all('|<img.*?src=[\'"](.*?)[\'"].*?>|i', $content, $images);
    if(!empty($images) && is_array($images) && !empty($images[1][0])){
        	$first_img = $images[1][0];
    }else{
        $first_img =  get_stylesheet_directory_uri().'/images/default.png';
    }
	return $first_img;
}
//获取第一张图
function catch_that_image() {
    error_reporting(0);
	global $post;
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<img*.+src=[\'"]([^\'"]+)[\'"].*>/iU', wp_unslash($post->post_content), $matches); 
    if(empty($output) && empty($output[1][0])){
		$first_img = "http://img.netbian.com/file/2022/0523/010947DTqU2.jpg";
	}else {
		$first_img = $matches[1][0];
	}
	return $first_img;
}

// 兼容低版本缩略图
if ( function_exists( 'add_theme_support' ) )  
add_theme_support( 'post-thumbnails' ); 
// 开启友链
add_filter('pre_option_link_manager_enabled','__return_true');

// 去除后台标题 wordpress字样
add_filter('admin_title', function ($admin_title, $title){
    return $title.' &lsaquo; '.get_bloginfo('name');
}, 10, 2);


// 文章 点赞函数
add_action('wp_ajax_nopriv_bigfa_like', 'bigfa_like');
add_action('wp_ajax_bigfa_like', 'bigfa_like');
function bigfa_like(){
    global $wpdb,$post;
    $id = $_POST["um_id"];
    $action = $_POST["um_action"];
    if ( $action == 'ding'){
    $bigfa_raters = get_post_meta($id,'bigfa_ding',true);
    $expire = time() + 99999999;
    $domain = ($_SERVER['HTTP_HOST'] != 'localhost') ? $_SERVER['HTTP_HOST'] : false; // make cookies work with localhost
    setcookie('bigfa_ding_'.$id,$id,$expire,'/',$domain,false);
    if (!$bigfa_raters || !is_numeric($bigfa_raters)) {
    update_post_meta($id, 'bigfa_ding', 1);
    }
    else {
    update_post_meta($id, 'bigfa_ding', ($bigfa_raters + 1));
    }
    echo get_post_meta($id,'bigfa_ding',true);
    }
    die;
}

//文章点击量 start
function get_post_views($post_id) {
    $count_key = 'views';
    $count = get_post_meta($post_id, $count_key, true);
    if ($count == '') {
        delete_post_meta($post_id, $count_key);
        add_post_meta($post_id, $count_key, '0');
        $count = '0';
    }
    echo number_format_i18n($count);
}
function set_post_views() {
    global $post;
    if ( !empty($post)) {
        $post_id = $post->ID ;
        $count_key = 'views';
        $count = get_post_meta($post_id, $count_key, true);
        if (is_single() || is_page()) {
            if ($count == '') {
                delete_post_meta($post_id, $count_key);
                add_post_meta($post_id, $count_key, '0');
            } else {
                update_post_meta($post_id, $count_key, $count + 1);
            }
        }
    }
}
add_action('get_header', 'set_post_views');
//文章点击量 end
 
// 每篇文章评论数量
function zfunc_comments_users($postid=0,$which=0) {
    $comments = get_comments('status=approve&type=comment&post_id='.$postid); //获取文章的所有评论
    if ($comments) {
        $i=0; $j=0; $commentusers=array();
        foreach ($comments as $comment) {
            ++$i;
            if ($i==1) { $commentusers[] = $comment->comment_author_email; ++$j; }
            if ( !in_array($comment->comment_author_email, $commentusers) ) {
                $commentusers[] = $comment->comment_author_email;
                ++$j;
            }
        }
        $output = array($j,$i);
        $which = ($which == 0) ? 0 : 1;
        return $output[$which]; //返回评论人数
    }
    return 0; //没有评论返回 0
}
// 文章收藏
function post_shoucang(){
    if(!get_current_user_id()){
        exit(json_encode(['msg'=>'请先登录才能收藏哦!']));
        wp_redirect( home_url() );   
    }
    $id = $_POST["id"];
    $meta = get_post_meta($id,'shoucang',true);
    $shoucang1 = explode(',',get_post_meta($id,'shoucang',true));
    $shoucang =  array_filter($shoucang1); 
    $user = get_current_user_id();
    if(in_array($user,$shoucang)){ 
        foreach($shoucang as $k=>$v){
            if($v==$user){
                unset($shoucang[$k]);
            }
        }
        update_post_meta($id, 'shoucang', implode(",",$shoucang));
        exit(json_encode(['msg'=>'已取消收藏']));
    }else{
        array_push($shoucang,$user);
        update_post_meta($id, 'shoucang', implode(",",$shoucang));
        exit(json_encode(['msg'=>'收藏成功']));
    }   
}
add_action('wp_ajax_post_shoucang','post_shoucang');
add_action('wp_ajax_nopriv_post_shoucang','post_shoucang');
// 调用当前分类下的标签
function get_category_tags($args) {
    global $wpdb;
    $tags = $wpdb->get_results
    ("
        SELECT DISTINCT terms2.term_id as tag_id, terms2.name as tag_name
        FROM
            $wpdb->posts as p1
            LEFT JOIN $wpdb->term_relationships as r1 ON p1.ID = r1.object_ID
            LEFT JOIN $wpdb->term_taxonomy as t1 ON r1.term_taxonomy_id = t1.term_taxonomy_id
            LEFT JOIN $wpdb->terms as terms1 ON t1.term_id = terms1.term_id,
            $wpdb->posts as p2
            LEFT JOIN $wpdb->term_relationships as r2 ON p2.ID = r2.object_ID
            LEFT JOIN $wpdb->term_taxonomy as t2 ON r2.term_taxonomy_id = t2.term_taxonomy_id
            LEFT JOIN $wpdb->terms as terms2 ON t2.term_id = terms2.term_id
        WHERE
            t1.taxonomy = 'category' AND p1.post_status = 'publish' AND terms1.term_id IN (".$args['categories'].") AND
            t2.taxonomy = 'post_tag' AND p2.post_status = 'publish'
            AND p1.ID = p2.ID
        ORDER by tag_name
    ");
    $count = 0;
    if($tags) {
        foreach ($tags as $tag) {
            $mytag[$count] = get_term_by('id', $tag->tag_id, 'post_tag');
            $count++;
        }
    } else {
      $mytag = NULL;
    }
    return $mytag;
}

//打赏订单查询
function getOrder(){
    global $wpdb;  
    $list = $wpdb->get_results("SELECT * FROM $wpdb->icealipay where ice_success=1 order by ice_time DESC"); 
    if($list) {
    	foreach($list as $value){
    	    echo "<div class='reward-item'>";
    	    echo "<span class='reward-name'>".get_the_author_meta( 'user_login', $value->ice_user_id )."</span> 赞助了<span class='reward-price'>".$value->ice_price."</span> 元";
    	    echo "</div>";	
    	}
    }
}
// 打赏订单列表
function getOrderList(){
    global $wpdb;  
    $list = $wpdb->get_results("SELECT * FROM $wpdb->icealipay where ice_success=1 order by ice_time DESC"); 
    if($list) {
    	foreach($list as $value){
    	    echo "<div class='reward-list-item'>";
    	    echo "<span class='rw-tt text-h1'>".$value->ice_title."</span>";
    	    echo "<span class='rw-name'>".get_the_author_meta( 'user_login', $value->ice_user_id )."</span> 赞助了陈小知 <span class='rw-price'>".$value->ice_price."</span> 元";
    	    echo "<span class='rw-time'>".$value->ice_time."</span>";
    	    echo "</div>";	
    	}
    }
}
//摘要
function get_abstract($content = '',$size = 130){

    if(!$content){
        global $post;
        $excerpt = $post->post_excerpt;
        $content = $excerpt ? $excerpt : $post->post_content;
    }

    return mb_strimwidth(clear_code(strip_tags(strip_shortcodes($content))), 0, $size,'...');

}
/*
* 清除字符串中的标签
*/
function clear_code($string){
    $string = trim($string);
    if(!$string)
        return '';
    $string = preg_replace('/[#][1-9]\d*/','',$string);//清除图片索引（#n）
    $string = str_replace("\r\n",' ',$string);//清除换行符
    $string = str_replace("\n",' ',$string);//清除换行符
    $string = str_replace("\t",' ',$string);//清除制表符
    $pattern = array("/> *([^ ]*) *</","/[\s]+/","/<!--[^!]*-->/","/\" /","/ \"/","'/\*[^*]*\*/'","/\[(.*)\]/");
    $replace = array(">\\1<"," ","","\"","\"","","");
    return preg_replace($pattern,$replace,$string);
}


// 分页
function  pageNavLink( $range = 4 ) {
    global $paged,$wp_query;
    $max_page = "";
    if ( !$max_page ) {
        $max_page = $wp_query->max_num_pages;
    }
    if( $max_page >1 ) {
        echo "<div class='pages'>"; 
        if( !$paged ){
            $paged = 1;
        }
        if( $paged != 1 ) {
            echo "<a href='".get_pagenum_link(1) ."' class='extend' title='跳转到首页'>首页</a>";
        }
        previous_posts_link('上一页');
        if ( $max_page >$range ) {
            if( $paged <$range ) {
                for( $i = 1; $i <= ($range +1); $i++ ) {
                    echo "<a href='".get_pagenum_link($i) ."'";
                if($i==$paged) echo " class='current'";echo ">$i</a>";
                }
            }elseif($paged >= ($max_page -ceil(($range/2)))){
                for($i = $max_page -$range;$i <= $max_page;$i++){
                    echo "<a href='".get_pagenum_link($i) ."'";
                    if($i==$paged)echo " class='current'";echo ">$i</a>";
                    }
                }elseif($paged >= $range &&$paged <($max_page -ceil(($range/2)))){
                    for($i = ($paged -ceil($range/2));$i <= ($paged +ceil(($range/2)));$i++){
                        echo "<a href='".get_pagenum_link($i) ."'";if($i==$paged) echo " class='current'";echo ">$i</a>";
                    }
                }
            }else{
                for($i = 1;$i <= $max_page;$i++){
                    echo "<a href='".get_pagenum_link($i) ."'";
                    if($i==$paged)echo " class='current'";echo ">$i</a>";
                }
            }
        next_posts_link('下一页');
        if($paged != $max_page){
            echo "<a href='".get_pagenum_link($max_page) ."' class='extend' title='跳转到最后一页'>尾页</a>";
        }
        echo '<span>共'.$max_page.'页</span>';
        echo "</div>\n";  
    }
}
 
 
 //前台管理员登录判断
function is_administrator() {
  $currentUser = wp_get_current_user();
  if(!empty($currentUser->roles) && in_array('administrator', $currentUser->roles)) 
    return 1;  // 是管理员
  else
    return 0;  // 非管理员
}
  
 // 登录后跳到首页
 function my_login_redirect($redirect_to, $request){
    if( empty( $redirect_to ) || $redirect_to == 'wp-admin/'  )
    return home_url('');
    else
    return $redirect_to;
}
add_filter('login_redirect', 'my_login_redirect', 10, 3);


// 热门/随机文章——小工具——目前与实时预览冲突
if( function_exists( 'register_sidebar_widget' ) ) { 
    wp_register_sidebar_widget(
	    'wp-hot',      // wpdocs unique widget id
	    '热门文章',        // widget name
	    'mb_hot',    // callback function
	    array(              // options
	        'description' => '热门文章小工具'
	    )
	);
	wp_register_sidebar_widget(
	    'wp-random',      // wpdocs unique widget id
	    '随机文章',        // widget name
	    'mb_random',    // callback function
	    array(              // options
	        'description' => '随机文章小工具'
	    )
	);
	wp_register_sidebar_widget(
	    'wp-zandom',      // wpdocs unique widget id
	    '点赞排行',        // widget name
	    'mb_zandom',    // callback function
	    array(              // options
	        'description' => '点赞排行小工具'
	    )
    );
}
function mb_hot() { include(TEMPLATEPATH . '/tool/hot.php'); }
function mb_random() { include(TEMPLATEPATH . '/tool/random.php'); }
function mb_zandom() { include(TEMPLATEPATH . '/tool/zan.php'); }

//  * 随机文章
//  */
function random_posts($posts_num = 10,$before='<li>',$after='</li>'){
    global $wpdb;
    $sql = "SELECT ID, post_title,guid
            FROM $wpdb->posts
            WHERE post_status = 'publish' ";
    $sql .= "AND post_title != '' ";
    $sql .= "AND post_password ='' ";
    $sql .= "AND post_type = 'post' ";
    $sql .= "ORDER BY RAND() LIMIT 0 , $posts_num ";
    $randposts = $wpdb->get_results($sql);
    $output = '';
    foreach ($randposts as $randpost) {
        $post_title = stripslashes($randpost->post_title);
        $permalink = get_permalink($randpost->ID);
        $output .= $before.'<a class="text-h1" href="'
            . $permalink . '"  rel="bookmark" title="';
        $output .= $post_title . '">' . $post_title . '</a>';
        $output .= $after;
    }
    echo $output;
}

// 过滤非中文评论
function refused_spam_comments( $comment_data ) { 
    $pattern = '/[一-龥]/u'; 
    if(!preg_match($pattern,$comment_data['comment_content'])) { 
    wp_die('评论必须含中文！'); 
    } 
    return( $comment_data ); 
} 
add_filter('preprocess_comment','refused_spam_comments');
 
// 追加评论@回复人
function comment_add_at( $comment_text, $comment = '') { 
    if( $comment->comment_parent > 0) { 
        $comment_text = '<a rel="nofollow" class="comment_at" href="#comment-' . $comment->comment_parent . '">@'.get_comment_author( $comment->comment_parent ) . '：</a> ' . $comment_text; 
    } 
    return $comment_text; 
} 
add_filter( 'comment_text' , 'comment_add_at', 10, 2);

if ( ! function_exists( 'get_cravatar_url' ) ) {
    /**
    *使用Cravatar头像服务替换Gravatar
    * @param string $url
    * @return string
    */
    function get_cravatar_url( $url ) {
        $sources = array(
            'www.gravatar.com',
            '0.gravatar.com',
            '1.gravatar.com',
            '2.gravatar.com',
            'secure.gravatar.com',
            'cn.gravatar.com'
        );
        return str_replace( $sources, 'cravatar.cn', $url );
    }
    add_filter( 'um_user_avatar_url_filter', 'get_cravatar_url', 1 );
    add_filter( 'bp_gravatar_url', 'get_cravatar_url', 1 );
    add_filter( 'get_avatar_url', 'get_cravatar_url', 1 );
}
?>