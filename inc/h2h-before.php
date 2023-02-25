<?php 
//主题前台设置
// 移除无效head文件
function qui_disable_emojis() {
    remove_action( 'wp_head', 'wp_generator' ); //移除WordPress版本
	remove_action( 'wp_head', 'rsd_link' ); //移除离线编辑器开放接口
	remove_action( 'wp_head', 'wlwmanifest_link' ); //移除离线编辑器开放接口
    remove_action( 'wp_head', 'index_rel_link' ); //去除本页唯一链接信息
    remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); //清除前后文信息
    remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); //清除前后文信息
    remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); //清除前后文信息
    remove_action( 'wp_head', 'rest_output_link_wp_head', 10 ); //移除wp-json链
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 ); //头部的JS代码
	remove_action( 'wp_print_styles', 'print_emoji_styles');
    remove_action( 'wp_head', 'rel_canonical' ); //rel=canonical
    remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 ); //rel=shortlink wp_site_icon
    remove_action('wp_head', 'wp_site_icon',99);
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
    remove_action('wp_head','_admin_bar_bump_cb'); 
    remove_action('admin_init', '_maybe_update_core'); // 禁止 WordPress 检查更新
    remove_action('admin_init', '_maybe_update_plugins'); // 禁止 WordPress 更新插件
    remove_action('admin_init', '_maybe_update_themes'); // 禁止 WordPress 更新主题
    add_filter( 'wp_resource_hints', 'qui_remove_dns_prefetch', 10, 2 ); //头部加载DNS预获取（dns-prefetch）
	
}
function qui_buffer_end() {
    if (ob_get_level() > 0) {
        ob_end_flush();
    }
}
add_action('shutdown', 'qui_buffer_end'); 
add_filter( 'show_admin_bar', '__return_false');
add_action( 'init', 'qui_disable_emojis' );


function custom_jquery_enqueue() {    
    if( !is_admin()){
        wp_deregister_script('jquery');    // 移除默认加载的 jQuery
        wp_register_script('jquery','https://cdn.bootcdn.net/ajax/libs/jquery/3.6.0/jquery.min.js', false);   // 加载自定义的 jQuery，这段代码表示加载主题下的 js/jquery.js，并且版本号使用的是 WordPress 当前的版本
        wp_enqueue_script('jquery');
    }
}
add_action( 'wp_enqueue_scripts', 'custom_jquery_enqueue' );



//移除WordPress头部加载DNS预获取（dns-prefetch）
function qui_remove_dns_prefetch( $hints, $relation_type ) {
    if ( 'dns-prefetch' === $relation_type ) {
    return array_diff( wp_dependencies_unique_hosts(), $hints );
    }
    return $hints;
}
function qui_remove_block_library_css() { //移除古登堡css
wp_dequeue_style( 'wp-block-library' );
}
add_action( 'wp_enqueue_scripts', 'qui_remove_block_library_css', 100 );

// 删除 wp_head 输入到模板中的feed地址链接
add_action( 'wp_head', 'qui_wp_head', 1 );
function qui_wp_head() {
    remove_action( 'wp_head', 'feed_links', 2 );
    remove_action( 'wp_head', 'feed_links_extra', 3 );
} 
foreach( array( 'rdf', 'rss', 'rss2', 'atom' ) as $feed ) {
    add_action( 'do_feed_' . $feed, 'qui_remove_feeds', 1 );
}
unset( $feed );

// 当执行 do_feed action 时重定向到首页
function qui_remove_feeds() {
    wp_redirect( home_url(), 302 );
    exit();
} 
// 删除feed的重定向规则
add_action( 'init', 'qui_kill_feed_endpoint', 99 );

function qui_kill_feed_endpoint() {
    global $wp_rewrite;
    $wp_rewrite->feeds = array(); 
}
//删除分类标题中的“分类：”
function qui_theme_archive_title( $title ) {
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif ( is_post_type_archive() ) {
        $title = post_type_archive_title( '', false );
    } elseif ( is_tax() ) {
        $title = single_term_title( '', false );
    }
 
    return $title;
}
 
add_filter( 'get_the_archive_title', 'qui_theme_archive_title' );

//自定义顶部1920*120图片
$args = array(
    'flex-width'    => true,
    'width'         => 1920,
    'flex-height'   => true,
    'flex-width' => false,
    'height'        => 120,
    'default-image' => get_template_directory_uri() .'/images/header.jpg',//  设置默认顶部图像为空，也可以/images/header.jpg 代替！
    'random-default' => false, //是否默认随机

);
add_theme_support( 'custom-header', $args );

//分类小工具只显示一级主分类
function wptoutiao_widget_categories_args($cat_args){
    $cat_args['parent'] = 0;
    return $cat_args;
}
add_filter('widget_categories_args', 'wptoutiao_widget_categories_args');


//自定义菜单及名字
register_nav_menus( array( 
    'main-nav' => __('主导航菜单'), ) 
);


// 注册 小工具 页面 侧栏模块

function QUI_widgets_init() {
    register_sidebar(array(
        'name'			=> esc_html__( '首页侧栏', 'QUI' ),
        'id'			=> 'widget_left_index',
        'description'   => esc_html__( '首页侧栏小工具', 'QUI' ),
        'before_widget'	=> '<section id="%1$s" class="widget %2$s">', 
        'after_widget'	=> '</section>', 
        'before_title'	=> '<h3 class="widget-title">', 
        'after_title'	=> '</h3>' ,
    ));
    register_sidebar(array(
    	'name'			=> esc_html__( '列表页侧栏', 'QUI' ),
    	'id'			=> 'widget_left_list',
    	'description'   => esc_html__( '列表页侧栏', 'QUI' ),
        'before_widget'	=> '<section id="%1$s" class="widget %2$s">', 
        'after_widget'	=> '</section>', 
        'before_title'	=> '<h3 class="widget-title">', 
        'after_title'	=> '</h3>' ,
    ));
    
    register_sidebar(array(
    	'name'			=> esc_html__( '文章页侧栏', 'QUI' ),
    	'id'			=> 'widget_left_article',
    	'description'   => esc_html__( '文章页侧栏', 'QUI' ),
        'before_widget'	=> '<section id="%1$s" class="widget %2$s">', 
        'after_widget'	=> '</section>', 
        'before_title'	=> '<h3 class="widget-title">', 
        'after_title'	=> '</h3>' ,
    ));
    
    register_sidebar(array(
    	'name'			=> esc_html__( '标签归档侧栏', 'QUI' ),
    	'id'			=> 'widget_left_tag',
    	'description'   => esc_html__( '标签归档侧栏', 'QUI' ),
        'before_widget'	=> '<section id="%1$s" class="widget %2$s">', 
        'after_widget'	=> '</section>', 
        'before_title'	=> '<h3 class="widget-title">', 
        'after_title'	=> '</h3>' ,
    ));
    
    register_sidebar(array(
    	'name'			=> esc_html__( '分类页侧栏', 'QUI' ),
    	'id'			=> 'widget_left_cate',
    	'description'   => esc_html__( '分类页侧栏', 'QUI' ),
        'before_widget'	=> '<section id="%1$s" class="widget %2$s">', 
        'after_widget'	=> '</section>', 
        'before_title'	=> '<h3 class="widget-title">', 
        'after_title'	=> '</h3>' ,
    ));
    register_sidebar(array(
    	'name'			=> esc_html__( '其他页侧栏', 'QUI' ),
    	'id'			=> 'widget_left_other',
    	'description'   => esc_html__( '其他页侧栏', 'QUI' ),
        'before_widget'	=> '<section id="%1$s" class="widget %2$s">', 
        'after_widget'	=> '</section>', 
        'before_title'	=> '<h3 class="widget-title">', 
        'after_title'	=> '</h3>' ,
    ));

}
add_action( 'widgets_init', 'QUI_widgets_init' );
//删除Class选择器
add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);
function my_css_attributes_filter($var) {
return is_array($var) ? array_intersect($var, array('current-menu-item','current-post-ancestor','current-menu-ancestor','current-menu-parent')) : '';
}



//面包屑功能
function qui_breadcrumb() {
    if( is_single() ){
        $categorys = get_the_category();
        $category = $categorys[0];
        echo( get_category_parents($category->term_id,true,'/  ') );
        the_title();
        } elseif ( is_page() ){
        the_title();
        } elseif ( is_category() ){
        single_cat_title();
        } elseif ( is_tag() ){
        single_tag_title();
        } elseif ( is_day() ){
        the_time('Y年Fj日');
        } elseif ( is_month() ){
        the_time('Y年F');
        } elseif ( is_year() ){
        the_time('Y年');
        }
}


// 文章链接添加title
add_filter('the_content', function ($content) {
    global $post;
    $pattern		= "/<a(.*?)href=('|\")(.*?).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>/i";
    $replacement	= '<a$1href=$2$3.$4$5 alt="'.$post->post_title.'" title="'.$post->post_title.'"$6>';
    $content = preg_replace($pattern, $replacement, $content);
    return $content;
});

//动态img加描述
function image_alt_tag($content){
    global $post;preg_match_all('/<img (.*?)\/>/', $content, $images);
    if(!is_null($images)) {foreach($images[1] as $index => $value)
    {$new_img = str_replace('<img', '<img  alt="'.get_the_title().'-'.get_bloginfo('name').'"   title="'.get_the_title().'-'.get_bloginfo('name').'"', $images[0][$index]);
    $content = str_replace($images[0][$index], $new_img, $content);}}
    return $content;
}
add_filter('the_content', 'image_alt_tag', 99999);



// 标签云 字体样式
function theme_tag_cloud_args($args){
    $newargs=array(
    'smallest' => 14,
    'largest'  => 14,
    'unit' =>'px',   //字号单位,可以是pt、px、em或%默认为pt；
    'number' =>72,   //显示个数，默认为45；
    'format' =>'',   //列表格式可以是flat、list或array默认为flat；
    'separator' =>"\n",   //分隔每一项的分隔符
    'orderby' =>'count',   //排序方式 name或count(按标签使用次数排列)默认为name；
    'order' =>'DESC',   //升序或降序ASC或DESC默认为ASC
    'exclude' =>null,   //结果中排除某些标签
    'include' =>null,   //结果中只包含某些标签
    'link' =>'view' ,   //taxonomy链接，view或edit默认为view
    'taxonomy' =>'post_tag',   //调用哪些分类法作为标签云
    );
    $return=array_merge($args,$newargs);
    return $return;
}
add_filter('widget_tag_cloud_args','theme_tag_cloud_args');
// 分享代码

//年月日
function timeago( $ptime ) {
global $post;
	    $date = $post->post_date;
	    $time = get_post_time('G', true, $post);
	    $time_diff = time() - $time;
	    if ( $time_diff > 0 && $time_diff < 24*60*60 )
	        $display = sprintf( __('%s ago'), human_time_diff( $time ) );
	    else
	        $display = date(get_option('date_format'), strtotime($date) );	 
	    return $display;
}


function search_word_replace($buffer){
    if(is_search()){
        $arr = explode(" ", get_search_query());
        $arr = array_unique($arr);
        foreach($arr as $v)
            if($v)
                $buffer = preg_replace("/(".$v.")/i", "<em>$1</em>", $buffer);
    }
    return $buffer;
}
add_filter("the_title", "search_word_replace", 200);
add_filter("the_excerpt", "search_word_replace", 200);
add_filter("the_content", "search_word_replace", 200);

?>