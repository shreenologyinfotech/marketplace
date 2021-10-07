<div class="Layout ContentBlock ContentBlock--TextBlock">
   <div class="Layout-contentInner"></div>
</div>
<div class="Layout ContentBlock ContentBlock--Slider">
   <div class='HeroSliderContainer'>
      <div class='HeroSliderContainer-outer'>
         <div class='HeroSliderContainer-inner is-loading' data-autoplay data-controls data-slider-speed='5000' id='content_block_slider_2637'>
            <?php
               $banners = get_banners('NewRelatedAccount');
               
               foreach ($banners as $bannersObj) { ?>
               <a target='_blank' class="HeroSlide HeroSlide--center" href="<?php echo $bannersObj->banner_link;?>">
                  <div class='HeroSlide-shimWrapper'>
                     <div class='HeroSlide-shim'></div>
                     <div class='HeroSlide-image'>
                        <img alt="" class="HeroSlide-imageInner" src="<?php echo base_url().IMAGE_PATH_URL.BANNER_FOLDER.$bannersObj->banner_image;?>?auto=format&amp;fm=pjpg&amp;fit=max&amp;q=90&amp;w=1600&amp;h=1000&amp;s=dd7909e73a6b1e7b7c9b0f921aa7b3d4" />
                     </div>
                  </div>
               </a>
            <?php   }
            ?>   
         </div>
      </div>
   </div>
</div>
<div class="CLayout-contentInner">


<!-- <div class="RetailerSplash">
<div class="RetailerSplash-headerPanel has-bottomMargin-xxlarge" style="margin-top:10px;background-image: url(<?php echo base_url().IMAGE_PATH_URL.BANNER_FOLDER.$content[0]->banner_image; ?>)">
<div class="RetailerSplash-headerPanelInner">
<div class="RetailerSplash-headerText">
<h1></h1>
</div>
<div class="RetailerSplash-headerSignupButton">
<a class="btn btn-go btn-large" href="<?php echo base_url();?>new-retailer-signup">Ingresar</a>
</div>
</div>
</div> -->

<?php 
	echo $content[0]->description;
?>
</div>
</div