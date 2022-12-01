<!-- 置顶推荐 -->
                  <?php 
                  if( is_sticky() ){
                      if( get_option("indexScroll")  == 1){
                  ?><div class="p20 bgff mb20 br10 shadow">
                  <h3 class="title pb20">站长推荐</h3>
                  <style type="text/css">
                     .marqueeList{height: 240px;overflow: hidden;}
                     .marqueeList ul li:nth-of-type(3) a,.marqueeList ul li:nth-of-type(1) a,.marqueeList ul li:nth-of-type(2) a{padding-left: 50px;position:relative}
                     .marqueeList ul li:nth-of-type(3) a::before,.marqueeList ul li:nth-of-type(1) a::before,.marqueeList ul li:nth-of-type(2) a::before{content:"置顶";padding:4px 8px;border-radius:4px;background:red;color:#fff;font-size:11px;position:absolute;left:0;top:0}
                     .marqueeList ul li:nth-of-type(2) a::before{ background:var(--main-color)}
                     .marqueeList ul li:nth-of-type(3) a::before{ background:#ff8e3e}
                  </style>
                  <div class="list-box marqueeList" id="parent"> 
                   <ul id="list">
                    <?php
                         $sticky = get_option('sticky_posts');
                                rsort( $sticky );
                                $sticky = array_slice( $sticky, 0, 10); // 调用5条
                                query_posts( array( 'post__in' => $sticky, 'ignore_sticky_posts' => 1 ,'orderby' => 'modified') );
                                if (have_posts()) :while (have_posts()) : the_post();
                    ?>
                    <li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" ><span class="text-h1"><?php the_title(); ?></span><time><?php the_modified_time('Y-m-d'); ?></time>  </a></li>
                    <?php  endwhile;
                    wp_reset_query(); else: ?> 
                        <p>当前还没有指定文章！请先置顶</p>
                    <?php endif; ?></ul><ul id="list1"></ul></div>
                  </div> 
                  <?php }
                  else{
                  ?> 
                  <div class="p20 bgff mb20 br10 shadow">
                  <h3 class="title pb20">站长推荐</h3>
                  <div class="list-box" > 
                   <ul>
                    <?php
                         $sticky = get_option('sticky_posts');
                                rsort( $sticky );
                                $sticky = array_slice( $sticky, 0, 10); // 调用5条
                                query_posts( array( 'post__in' => $sticky, 'ignore_sticky_posts' => 1 ,'orderby' => 'modified') );
                                if (have_posts()) :while (have_posts()) : the_post();
                    ?>
                    <li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" ><span class="text-h1"><?php the_title(); ?></span><time><?php the_modified_time('Y-m-d'); ?></time>  </a></li>
                    <?php  endwhile;
                    wp_reset_query(); else: ?> 
                        <p>当前还没有指定文章！请先置顶</p>
                        
                    <?php endif; ?></ul> </div>  </div> 
                  <?php } }?>