<div class="widget widget_recent_entries">
<h3 class="widget-title">点赞排行</h3>
<ul>
<?php
$args = array(
	'ignore_sticky_posts' => 1,
	'meta_key' => 'bigfa_ding',
	'orderby' => 'meta_value_num',
	'showposts' => 10
);	
query_posts($args); if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>
<li>
<a  href="<?php the_permalink(); ?>" class="text-h1" title="<?php the_title(); ?>"><?php the_title(); ?></a>
</li>
<?php endwhile;endif; ?>
</ul>
</div>