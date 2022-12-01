<?php 
//主题后台设置
//删除仪表盘模块
function qui_remove_dashboard_widgets() {
    global $wp_meta_boxes;
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
}
add_action('wp_dashboard_setup', 'qui_remove_dashboard_widgets' );
remove_action('welcome_panel', 'wp_welcome_panel');



//后台显示选项功能修复
function qui_remove_help_tabs($old_help, $screen_id, $screen){
    $screen->remove_help_tabs();
    return $old_help;
}
function qui_dashboard_meta() {
    remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');//3.8版开始
}
add_action( 'admin_init', 'qui_dashboard_meta' );
// 去除wp字样
add_filter('admin_title', function ($admin_title, $title){
    return $title.' &lsaquo; '.get_bloginfo('name');
}, 10, 2);
//禁止代码标点转换
remove_filter('the_content', 'wptexturize');


//谷歌字体
function qui_remove_open_sans() {
    wp_deregister_style( 'open-sans' );
    wp_register_style( 'open-sans', false );
    wp_enqueue_style('open-sans','');
}
add_action( 'init', 'qui_remove_open_sans' );
add_filter('gettext_with_context', 'qui_disable_open_sans', 888, 4 );
function qui_disable_open_sans( $translations, $text, $context, $domain )
        {
        if ( 'Open Sans font: on or off' == $context && 'on' == $text ) {
        $translations = 'off';
        }
        return $translations;
}


function annointed_admin_bar_remove() {
    global $wp_admin_bar;
    /* Remove their stuff */
    $wp_admin_bar->remove_menu('wp-logo');
}
add_action('wp_before_admin_bar_render', 'annointed_admin_bar_remove', 0);
function change_footer_admin () {return '51Qux.com';}
add_filter('admin_footer_text', 'change_footer_admin', 9999);
function change_footer_version() {return 'Qui-Pure主题';}
// add_filter( 'update_footer', 'change_footer_version', 9999);

?>