<?php  
     /** Qui-Pure主题 总配置文件**/
    // 引入主题必备文件 
        include(TEMPLATEPATH.'/admin/function.php');
        $currentUser = wp_get_current_user();
        if(!empty($currentUser->roles) && in_array('administrator', $currentUser->roles)) {//后台新增菜单
            function qui_add_menu_page(){    
                add_menu_page( '主题设置', 'Pure主题设置', 'edit_themes', 'test_slug','callback_function','',61);  
            }
            function callback_function(){
                require get_template_directory()."/admin/qui-admin.php";
            }   
            add_action('admin_menu', 'qui_add_menu_page'); // 加载qui后台配置页面
            return 1;  // 是管理员
        }
        else{
            return 0;  // 非管理员
        }
?>



