<div class="widget widget_recent_entries">
<h3 class="widget-title">热门文章</h3>
<ul>
<?php query_posts('posts_per_page=6&ignore_sticky_posts=1&orderby=comment_count'); ?>
<?php while (have_posts()) : the_post(); ?>
<li>
<a  href="<?php the_permalink(); ?>" class="text-h1" title="<?php the_title(); ?>"><?php the_title(); ?></a>
</li>
<?php endwhile; ?>
</ul></div>