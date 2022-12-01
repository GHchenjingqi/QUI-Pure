<?php if( get_post_status( $post->ID )  != 'trash'  ) { ?><?php   $i = get_query_var('i'); if( get_option("listimg") == 1 ){  if (get_content_first_image(get_the_content())) {  ?>
<li class="list-animation-leftIn delay-<?php echo $i; ?>"> 
<?php  if( get_option("listimgr") == 0 ){   ?>  
 <a class="flex aifs jcf p-r" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" >
                <q>
                 <img src="<?php echo get_content_first_image(get_the_content()); ?>" alt="‘<?php the_title(); ?>’的缩略图">
                 <mark class="list-tag"><?php $category = get_the_category();echo $category[0]->cat_name; ?></mark> 
                </q> 
               <div>
                  <h3 class="text-h1"><?php the_title(); ?></h3>
                  <p class="text-h2"><?php echo get_abstract(); ?></p>
                  <p class="f12 cor99 mt5"><span ><?php echo get_the_author() ?></span><time class="ml10"><?php the_time('m-d') ?></time> <span class="ml10" style="max-width:15vw"><?php  get_post_views($post -> ID); ?>人阅读</span></p>
               </div> 
          </a>
<?php   }else { ?>  
 <a class="p-r" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" >
               <div style="margin-left:0 !important;margin-right:15px">
                  <h3 class="text-h1"><?php the_title(); ?></h3>
                  <p class="text-h2"><?php echo get_abstract(); ?></p>
                  <p class="f12 cor99 mt5"><span ><?php echo get_the_author() ?></span><time class="ml10"><?php the_time('m-d') ?></time> <span class="ml10" style="max-width:15vw"><?php get_post_views($post -> ID); ?>人阅读</span></p>
               </div> 
               <q style="float:right;margin-left:auto" class="p-r">
                 <img src="<?php echo get_content_first_image(get_the_content()); ?>" alt="‘<?php the_title(); ?>’的缩略图">
                 <mark class="list-tag"><?php $category = get_the_category();echo $category[0]->cat_name; ?></mark> 
                </q> 
          </a>
<?php   } ?> 
      </li>
      <?php } else { ?><li class="list-animation-leftIn <?php echo 'delay-'.$i; ?>"> 
        <div class="text-h2 ptb10">
            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
        </div>
        <p class="f12 cor99 mt5"><span><?php echo get_the_author() ?></span><span class="ml10"><?php $category = get_the_category();echo $category[0]->cat_name; ?></span><time class="ml10"><?php the_time('Y-m-d') ?></time><span class="ml10" style="max-width:15vw"><?php get_post_views($post -> ID); ?>人阅读</span>
        </p>
    </li><?php } } else { ?><li class="ptb30 list-animation-leftIn <?php echo 'delay-'.$i; ?>"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" >[<?php $category = get_the_category();echo $category[0]->cat_name; ?>]<?php the_title(); ?></a></li><?php } }  ?> 
