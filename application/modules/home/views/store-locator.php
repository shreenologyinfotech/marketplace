<div class="Layout ContentBlock ContentBlock--TextBlock">
   <div class="Layout-contentInner"></div>
</div>
<div class="Layout ContentBlock ContentBlock--Slider">
   <div class='HeroSliderContainer'>
      <div class='HeroSliderContainer-outer'>
         <div class='HeroSliderContainer-inner is-loading' data-autoplay data-controls data-slider-speed='5000' id='content_block_slider_2637'>
            <?php
               $banners = get_banners('StoreLocator');
               
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
<main data-testid="directory-page-wrapper">
   <nav class="sc-1l0kme9-1 hoaAYF s9r2ax-3 hDbijm" aria-label="Breadcrumb">
      <ol class="sc-1l0kme9-2 gnqGLa">
         <li class="sc-1l0kme9-3 jFdLdZ">
            <svg viewBox="0 0 24 24" height="12.8px" width="12.8px" aria-hidden="true" focusable="false" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="StyledIconBase-ea9ulj-0 cuLlVI sc-1l0kme9-0 cuujWo">
               <path fill="none" d="M0 0h24v24H0z"></path>
               <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"></path>
            </svg>
            <a href="/" class="sc-82gajq-0 sc-1l0kme9-4 bTTSjf gbUqzU">Home</a>
         </li>
         <li class="sc-1l0kme9-3 jFdLdZ">
            <svg viewBox="0 0 24 24" height="12.8px" width="12.8px" aria-hidden="true" focusable="false" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="StyledIconBase-ea9ulj-0 cuLlVI sc-1l0kme9-0 cuujWo">
               <path fill="none" d="M0 0h24v24H0z"></path>
               <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z"></path>
            </svg>
            Store Locator
         </li>
      </ol>
   </nav>
   <div class="sc-1qoenmq-0 dnFhpI">
      <div class="tofc91-1 jcbzal">
         <h1 id="a11y-directory-page-heading" class="tofc91-0 lnIMsc">Marketplacephones</h1>
         <p>Wholesale Directory</p>
      </div>
    <div data-testid="d-search" class="sc-1qoenmq-1 byuVZO">
      <form method="get" action="<?php echo base_url(); ?>storelocator" role="search"><div class="d5csex-4 hFLAAS sc-1qoenmq-2 doYtkt"><div class="d5csex-0 idCVEd"><div class="d5csex-1 bPzCeH"><svg viewBox="0 0 24 24" height="24px" width="24px" aria-hidden="true" focusable="false" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="StyledIconBase-ea9ulj-0 cuLlVI"><path fill="none" d="M0 0h24v24H0z"></path><path d="M15.5 14h-.79l-.28-.27A6.471 6.471 0 0016 9.5 6.5 6.5 0 109.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path></svg></div><input name="keyword" value="<?php echo $keyword; ?>" aria-label="Search by name" placeholder="Search by name" class="d5csex-3 vuBFm" ></div><div class="d5csex-5 fcOkMD"><input type="submit" value="Go" class="sc-1t1jgok-0 eFxQVk"/></div></div></form>


   </div>


   </div>
   
      <div class="s9r2ax-1 gqkaM">
         <nav aria-label="stores" class="sc-1f1af90-0 egvByP">
            <div class="m5k8pg-3 iKMbUO">
               <div class="m5k8pg-0 bcBPjq">
                  <small class="sc-1mfm5g5-10 m5k8pg-1 gvyPuv BEzzn">
                     <?php echo get_stores_by_limit_count($keyword);?> stores
                  </small>
               </div>
            </div>
            <ul aria-labelledby="a11y-directory-page-heading" class="sc-1f1af90-1 dwpgPi">
               <?php foreach ($store_data as $resultObject) { ?>
                   <li data-testid="search-result" class="sc-19qtpww-0 hoCmuy">
                  <article aria-label="Nixeycles" class="sc-1yry0w1-0 iGpTJD">
                     <h2 class="sc-1yry0w1-3 eiwToF">


                        <?php
                           $storeImage = $resultObject->store_image;  
                           
                           if($storeImage != ""){
                              $storeImage = base_url().IMAGE_PATH_URL.STORES_FOLDER.$storeImage;
                           }else{
                              $storeImage =  base_url().IMAGE_PATH_URL."img_place.jpg";
                           }
                        ?>

                        <div class="MSellerSummary t-sellerSummary">
                           <a class="t-sellerSummaryLink" href="">
                              <img src="<?php echo $storeImage;?>" class="MSellerSummary-logo" style="max-height: 70px !important;"/>
                           </a>
                        </div>

                        <button id="store-info-button-U2VsbGVyLTI0ODY0" aria-expanded="false" aria-controls="store-info-section-U2VsbGVyLTI0ODY0" class="sc-1t1jgok-0 hIVDjn sc-1yry0w1-4 kqxnVe" type="button">
                           <div class="sc-1yry0w1-5 cxNXaX">
                              <p class="sc-1yry0w1-1 jrmJpR"><?php echo $resultObject->store_name;?></p>
                              <p class="sc-1yry0w1-2 jYvrRx"><?php echo $resultObject->address;?></p>
                              <p data-testid="state-and-postcode" class="sc-1yry0w1-2 jYvrRx"><?php echo $resultObject->region.' '.$resultObject->post_code;?></p>
                           </div>
                          
                            <div class="sc-1yry0w1-10 ijvsQT">
                           <a data-testid="store-details-link" href="<?php echo base_url()?>search/<?php echo $resultObject->store_id;?>/store" class="sc-82gajq-0 sc-1yry0w1-9 cciqYY lewcFH">
                              <span class="sc-14lfqow-0 cLVRSv">
                                 <svg viewBox="0 0 24 24" height="24px" width="24px" aria-hidden="true" focusable="false" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="StyledIconBase-ea9ulj-0 cuLlVI">
                                    <path fill="none" d="M0 0h24v24H0z"></path>
                                    <path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"></path>
                                 </svg>
                              </span>
                              View store details
                           </a>
                           <?php /*
                           <a target="_blank" href="https://maps.google.com/?q=<?php echo $resultObject->store_lat;?>,<?php echo $resultObject->store_lng;?>" data-testid="google-maps-link" class="sc-82gajq-0 sc-1yry0w1-9 cciqYY lewcFH">
                              <span class="sc-14lfqow-0 cLVRSv">
                                 <svg viewBox="0 0 24 24" height="24px" width="24px" aria-hidden="true" focusable="false" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="StyledIconBase-ea9ulj-0 cuLlVI">
                                    <path fill="none" d="M0 0h24v24H0z"></path>
                                    <path d="M21.71 11.29l-9-9a.996.996 0 00-1.41 0l-9 9a.996.996 0 000 1.41l9 9c.39.39 1.02.39 1.41 0l9-9a.996.996 0 000-1.41zM14 14.5V12h-4v3H8v-4c0-.55.45-1 1-1h5V7.5l3.5 3.5-3.5 3.5z"></path>
                                 </svg>
                              </span>
                              Get directions
                           </a>

                         */ ?>
                        </div>

                        </button>
                     </h2>
                     
                  </article>
               </li>
               <?php   } ?>
            </ul>
            <!--<div class="sc-6hvfza-3 NbokF">
               <button class="sc-1t1jgok-0 hIVDjn sc-6hvfza-1 kfwBzq" type="button">
                  Load more
                  <svg viewBox="0 0 24 24" height="32px" width="32px" aria-hidden="true" focusable="false" fill="currentColor" xmlns="http://www.w3.org/2000/svg" class="StyledIconBase-ea9ulj-0 cuLlVI sc-6hvfza-2 keIzfY">
                     <path fill="none" d="M0 0h24v24H0V0z"></path>
                     <path d="M7.41 8.59L12 13.17l4.59-4.58L18 10l-6 6-6-6 1.41-1.41z"></path>
                  </svg>
               </button>
               <p aria-live="polite" role="status" class="sc-6hvfza-5 jdkHaX">Results loaded</p>
            </div>-->
         </nav>
      </div>
   </div>
</main>

