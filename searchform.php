<form class="searchForm" role="search" method="get" action="<?php echo home_url('/'); ?>">
  <input class="form-control" type="search" name="s" value="<?php if (is_search()) { echo get_search_query(); } ?>" placeholder="<?php _e('搜一下惊喜!', 'lerm');?>">
  <input type="submit" value="搜索">
</form>