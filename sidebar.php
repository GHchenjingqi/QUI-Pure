<?php 
	if (is_single()){
		if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_left_article')) : endif; 
	} 
	else if (is_home() && is_front_page() ){
		if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_left_index')) : endif; 
	}
	else if (is_search()){
		if (function_exists('dynamic_sidebar') && dynamic_sidebar('')) : endif; 
	}
	else if (is_tag()){
		if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_left_list')) : endif; 
	}
	else if (is_category() ){
		if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_left_cate')) : endif; 
	}
	else {
		if (function_exists('dynamic_sidebar') && dynamic_sidebar('widget_left_other')) : endif; 
	}
?>