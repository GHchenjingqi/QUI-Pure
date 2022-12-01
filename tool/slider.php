 <div class="banner pr mb20"> 
  <div class="swiper-container">
      <div class="swiper-wrapper">
        <?php 
          $sort = '1 2 3 4 5';
          $sort = array_unique(explode(' ', trim($sort)));
          $i = 0;
          foreach ($sort as $key => $value) {
              if( get_option("banner_0".$value) ){
        ?>
          <div class="swiper-slide">
                <a href="<?php echo get_option("bannerLink0".$value) ;?>" target="_blank">
                    <img src="<?php echo get_option("banner_0".$value) ;?>" alt="">
                </a>
          </div>
        <?php }}?>
      </div>
      <div class="swiper-button-next"></div>
      <div class="swiper-button-prev"></div>
      <div class="swiper-pagination"></div>
</div> 
</div>