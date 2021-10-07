<?php $proObj=$product_data[0]; 
$brand_image = $proObj->brand_image;  
if($brand_image != ""){
   $brand_image = base_url().IMAGE_PATH_URL.HOME_CATEGORY_FOLDER.$brand_image;
}else{
   $brand_image =  base_url().IMAGE_PATH_URL."img_place.jpg";
}

$productImage = $proObj->product_image;  
if($productImage != ""){
   $productImage = base_url().IMAGE_PATH_URL.PRODUCT_FOLDER.$productImage;
}else{
   $productImage =  base_url().IMAGE_PATH_URL."img_place.jpg";
}

$storeImage = $proObj->store_image;  
if($storeImage != ""){
   $storeImage = base_url().IMAGE_PATH_URL.STORES_FOLDER.$storeImage;
}else{
   $storeImage =  base_url().IMAGE_PATH_URL."img_place.jpg";
}

$userId = $this->session->userdata(FRONT_USER_ID);
if(is_user_have_vat($userId)){
   $proObj->vat_percentage = "0";
}

?>
<div class="CLayout-contentInner">
   <div id="BreadCrumbs">
      <div class="BreadCrumbs">
         <div class="BreadCrumbs-inner">
            <div class="BreadCrumbs-crumb"> <a href="<?php echo base_url();?>">Home</a>
            </div>
            <div class="BreadCrumbs-crumb">
               <a href="<?php echo base_url()?>search/<?php echo $proObj->category_id;?>/category" itemprop="item"> <span itemprop="name"><?php echo category_name_by_id($proObj->category_id);?></span>
               </a>
               <meta content="1" itemprop="position">
            </div>
            <div class="BreadCrumbs-crumb">
               <a href="<?php echo base_url()?>search/<?php echo $proObj->subcategory_id;?>/subcategory" itemprop="item"> <span itemprop="name"><?php echo subcategory_name_by_id($proObj->subcategory_id);?></span>
               </a>
            </div>
         </div>
      </div>
   </div>
   <article class="PageProduct">
      <div class="PageProduct-outer">
         <div class="PageProduct-inner">
            <div class="PageProduct-left">
               <div>
                  <div>
                     <div class="ImageSlider ImageSlider--horizontal">
                       
                        <div class="ImageSlider-siemaContainer ImageSlider-siemaContainer--hasBorder">
                           <div style="overflow: hidden;">
                              <div style="width: 100%; transition: all 200ms ease-out 0s; transform: translate3d(0px, 0px, 0px);">
                                 <div class="ImageSlider-slide" style="float: left; width: 100%;">
                                    <div class="ImageSlider-slideImage" style="background-size: contain; background-image: url(&quot;<?php echo $productImage;?>?auto=format&amp;fm=pjpg&amp;fit=max&amp;w=1215&amp;h=760&amp;s=8c3d14dc5350cad2aa6a6f074700be29&quot;);"></div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div>
                  <div class="PageProduct-details">
                     <div class="PageProduct-u-tabAlignment">
                        <h2 class="h3">Description</h2>
                        <div class="MRevealText">
                           <div class="MAccordionContent" aria-hidden="true" style="height: 78px;">
                              <div class="MAccordionContent-inner">
                                 <div>
                                  <?php echo $proObj->description;?>  
                                 </div>
                              </div>
                           </div>
                        </div>
                           
                           <p> <strong>Brand:</strong>
                           <a href="<?php echo base_url()?>search/<?php echo $proObj->brand_id;?>/brand" title="Bianchi"><?php echo brand_name_by_id($proObj->brand_id);?></a>
                           <br> <strong>Category:</strong>
                           <a href="<?php echo base_url()?>search/<?php echo $proObj->category_id;?>/category" title=""><?php echo category_name_by_id($proObj->category_id);?></a>
                           <br> <strong>Sub Category:</strong>
                           <a href="<?php echo base_url()?>search/<?php echo $proObj->subcategory_id;?>/subcategory" title=""><?php echo subcategory_name_by_id($proObj->subcategory_id);?></a>

                           <br> <strong>Availability:</strong> Enquire Now
                           <br> <strong>ID:</strong> <?php echo $proObj->product_id;?>
                           <br> <strong>SKU:</strong> <?php echo $proObj->sku;?>

                        </p>
                            
                     </div>


                      
                      
                     <div class="PageProduct-requiredSection">
                        <h2 class="h3">Shipping policy</h2>
                        <div>
                              <?php echo $proObj->shipping_policy;?>  
                        </div>
                     </div>
                     <div class="PageProduct-requiredSection">
                        <h2 class="h3">Exchange, Returns, and Refunds Policy</h2>
                        <div>
                           <?php echo $proObj->return_policy;?>  
                        </div>
                     </div>
                     <div class="PageProduct-u-tabAlignment"></div>
                  </div>
               </div>
            </div>
            <div class="PageProduct-right">
               <div class="PageProduct-sidebar--desktop">
                  <div class="CProductHeader t-productHeader">
                     <div class="CProductHeader-outer">
                        <div class="CProductHeader-inner">
                           <div class="CProductHeader-wishlist">
                              <div>
                                 <?php

                                 $class        = "";
                                 if(is_wishlist_product($proObj->product_id)){
                                    $class        = "AddToWishList--inWishList t-addToWishList--inWishList";
                                 }
                                 ?>
                              <div class="PageProduct-wishList">
                                    <div class="PageProduct-wishList-icon t-addToWishList">
                                         <div id="wish_<?php echo $proObj->product_id; ?>" onclick="addWishList('<?php echo $proObj->product_id;?>',this)"  class="AddToWishList btn btn-tag t-addToWishList <?php echo $class;?>">
                                          <i class="AddToWishList-icon AddToWishList-icon--large TegIcon-largeForButton"></i>
                                       </div>
                                    </div>
                                    <div class="PageProduct-wishList-description">Add this item to your wishlist</div>
                                 </div>
                              </div>
                           </div>
                           <div class="CProductHeader-titleAndPrice">
                              <img alt="Bianchi" class="CProductHeader-logo" src="<?php echo $brand_image;?>?auto=format&amp;fm=pjpg&amp;fit=max&amp;w=300&amp;h=225&amp;s=b08d1bbcf1a42ffe2c8173c0a99cf46c">
                              <h1 class="h3 CProductHeader-title t-productHeaderHeading">
                              <?php echo $proObj->product_name;?>
                              </h1>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="PageProduct-deliveryAttributes">
                     <div class="BulletList">
                        <div class="BulletList-item">
                           <div class="BulletList-item-svgBullet">
                              <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 24 24" class="svg_icon">
                                 <path d="M18,18.5A1.5,1.5 0 0,1 16.5,17A1.5,1.5 0 0,1 18,15.5A1.5,1.5 0 0,1 19.5,17A1.5,1.5 0 0,1 18,18.5M19.5,9.5L21.46,12H17V9.5M6,18.5A1.5,1.5 0 0,1 4.5,17A1.5,1.5 0 0,1 6,15.5A1.5,1.5 0 0,1 7.5,17A1.5,1.5 0 0,1 6,18.5M20,8H17V4H3C1.89,4 1,4.89 1,6V17H3A3,3 0 0,0 6,20A3,3 0 0,0 9,17H15A3,3 0 0,0 18,20A3,3 0 0,0 21,17H23V12L20,8Z"></path>
                              </svg>
                           </div><?php echo store_name_by_id($proObj->store_id);?></div>
                           

                           <?php if($proObj->allow_cart == "yes"){ ?>
                           <div class="BulletList-item">
                              <div class="BulletList-item-svgBullet">
                                 <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" viewBox="0 0 24 24" class="svg_icon">
                                    <path d="M21,7L9,19L3.5,13.5L4.91,12.09L9,16.17L19.59,5.59L21,7Z"></path>
                                 </svg>
                              </div>Buy online
                           </div>
                          <?php  } ?>


                     </div>
                  </div>
                  <div class="PageProduct-sidebarGroup-item u-removeBorder">
                     <div>
                        <div class="CProductAddToCart t-productAddToCart">
                           <div class="CProductVariantSelect">
                              <!--<div class="CProductVariantSelect-variant">
                                 <label for="CProductVariantSelectVariant">Select Size, Colour, and Size CM</label>
                                 <div class="CProductVariantSelect-select">
                                    <div class="Select">
                                       <select name="CProductVariantSelectVariant" id="CProductVariantSelectVariant">
                                          <option value="9911383">Large / Celeste / 57cm</option>
                                          <option value="9911384">XL / Celeste / 59cm</option>
                                       </select>
                                    </div>
                                 </div>
                              </div> -->
                              <?php if($proObj->allow_cart == "yes"){ ?>

                              <div class="CProductVariantSelect-quantity">
                                 <label for="CProductVariantSelectQuantity">Quantity</label>
                                 <div class="MQuantitySelector">
                                    <button aria-label="Decrement quantity" class="MButton MQuantityButton MQuantitySelector-decrementButton" > <span aria-hidden="true"></span>
                                    </button>
                                    <input id="CProductVariantSelectQuantity"  min="1" type="number" value="1">
                                    <button aria-label="Increment quantity" class="MButton MQuantityButton MQuantitySelector-incrementButton"> <span aria-hidden="true"></span>
                                    </button>
                                 </div>
                              </div>
                            <?php } ?>


                           </div>
                           <div class="CProductAddToCart-fixedContainer">
                             
                              <p class="CProductAddToCart-subtotal"> <span class="CProductAddToCart--label">Subtotal</span>
                                 <span class="CProductAddToCart--subtotal t-addToCartSubtotal"><?php 
                                 echo CURRENCY.($proObj->price); ?>
                                 </span>
                              </p>

                              <p class="CProductAddToCart-subtotal"> <span class="CProductAddToCart--label">Vat(<?php echo $proObj->vat_percentage.'%';?>)</span>
                                 <span class="CProductAddToCart--subtotal t-addToCartSubtotal"><?php 
                                 $vatAmount =  get_vat_amount($proObj->price,$proObj->vat_percentage);
                                 echo CURRENCY.$vatAmount; ?>
                                 </span>
                              </p>

                              <p class="CProductAddToCart-subtotal"> <span class="CProductAddToCart--label">Total</span>
                                 <span class="CProductAddToCart--subtotal t-addToCartSubtotal"><?php 
                                 echo CURRENCY.($proObj->price + $vatAmount); ?>
                                 </span>
                              </p>

                              
                              <div class="CProductAddToCart-cartButtonContainer">
                                 <button onClick="addToCart('<?php echo $proObj->store_id;?>','<?php echo $proObj->product_id;?>',$('#CProductVariantSelectQuantity').val())" type="button" class="btn btn-primary CProductAddToCart-cartButton t-quickViewAddToCart">Add to Cart</button>
                              </div>


                              
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="PageProduct-sidebarGroup">
                     <div class="PageProduct-sidebarGroup-item">
                        <div class="PageProduct-paddingCompat t-contactSellerSidebar">
                           <div >
                              <div class="MSellerSummary t-sellerSummary">
                                 <a class="t-sellerSummaryLink" href="">
                                    <img src="<?php echo $storeImage;?>" alt="<?php echo $proObj->store_name;?>" class="MSellerSummary-logo">
                                    <h4 class="MSellerSummary-retailerName"><?php echo $proObj->store_name;?></h4>
                                 </a>
                              </div>
                           </div>
                              <?php /*
                              <div class="call-now-form">
                                 <div>
                                    <button class="btn btnCallNow is-wide btn-lead" id="gtm-RevealPhoneButton"> <i class="fa fa-phone" aria-hidden="true"></i><?php echo $proObj->store_mobile ?></button>
                                 </div>
                              </div>
                              */ ?>
                          
                           <div class="PageProduct-emailSeller">
                              <div>
                                 <div class="EmailSellerForm-wrapper">
                                    <h2 class="h4">Have a question on this item?</h2>
                                    <div class="EmailSellerForm">
                                       
                                          <div class="MField">
                                             <input type="hidden" value="<?php echo $proObj->product_id;?>" name="product_id" id="product_id"/>

                                             <label class="MField-label" for="message">What would you like to know? Please include details about size &amp; colour, more information is better.</label>
                                             <textarea id="message" name="message" placeholder="Your message..." required=""></textarea>
                                             <div class="MField-note"></div>
                                          </div>
                                          <div class="MField">
                                             <label class="MField-label" for="first_name">Your name</label>
                                             <input type="text" id="first_name" name="first_name" placeholder="Your full name" required="" >
                                             <div class="MField-note"></div>
                                          </div>
                                          <div class="MField">
                                             <label class="MField-label" for="x3741621a-db38-4cb8-a922-0261a31acc2c">Contact email address</label>
                                             <input type="email" id="email_address" name="email_address" placeholder="Your contact email" required="" value="">
                                             <div class="MField-note"></div>
                                          </div>
                                          <div class="EmailSellerForm-contact">
                                             <div class="MField EmailSellerForm-phone">
                                                <label class="MField-label" for="phone">Contact number</label>
                                                <input type="text" id="phone" name="phone" placeholder="A contact number" value="">
                                                <div class="MField-note"></div>
                                             </div>
                                          </div>
                                          <div class="MField EmailSellerForm-edm">
                                             <label>
                                                <input type="checkbox" class="EmailSellerForm-edm-checkbox" name="edm_enabled" checked="">&nbsp;I would like to receive emails from BikeExchange.</label>
                                          </div>
                                          <div class="EmailSellerForm-privacy-policy">
                                             <p>BikeExchange takes the privacy of your data seriously. To learn more, read our <a href="/article/privacy-and-security" target="_blank">privacy policy</a>.</p>
                                          </div>
                                          <div class="data-message"></div>

                                          <button onclick="sentMessageToSeller()" type="button" id="enquiery-email" class="btn is-wide btn-lead">Send Email</button>

                                          <a style="margin-top:10px;" href="<?php echo $proObj->web_page; ?>" class="btn is-wide btn-lead">Visit Store Website</a>


                                          
                                       
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="ProductShare t-advertShowShareButtons">
                     <h2>Share</h2>
                     <a class="ShareOnButton ShareOnButton-email theme-highlightColor--linkStates GAEventClick" data-teg-ga-events="share:email:click" href="mailto:?subject=BikeExchange: Bianchi Aria Disc - Ultegra&amp;body=Hello, I thought you might like to view this item from the BikeExchange website - https://www.bikeexchange.com.au/a/road-bikes/bianchi/bianchi-aria-disc-ultegra/108867069" rel="nofollow" title="Email to Friend"> <i class="ricon-envelope-alt"></i>
                     </a>
                     <a class="ShareOnButton ShareOnButton-twitter theme-highlightColor--linkStates GAEventClick" data-teg-ga-events="share:twitter:click" href="http://twitter.com/intent/tweet?text=Share+on+Twitter&amp;url=https%3A%2F%2Fwww.bikeexchange.com.au%2Fa%2Froad-bikes%2Fbianchi%2Fbianchi-aria-disc-ultegra%2F108867069&amp;via=bikeExchange" rel="nofollow noopener" target="_blank" title="Share on Twitter"> <i class="ricon-twitter"></i>
                     </a>
                     <a class="ShareOnButton ShareOnButton-facebook theme-highlightColor--linkStates GAEventClick" data-teg-ga-events="share:facebook:click" href="#" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fwww.bikeexchange.com.au%2Fa%2Froad-bikes%2Fbianchi%2Fbianchi-aria-disc-ultegra%2F108867069', 'facebook-share-dialog', 'width=626,height=436'); return false;" title="Share on facebook"> <i class="ricon-facebook"></i>
                     </a>
                     <a class="ShareOnButton ShareOnButton-pinterest theme-highlightColor--linkStates GAEventClick" data-teg-ga-events="share:pinterest:click" href="http://pinterest.com/pin/create/button/?url=https%3A%2F%2Fwww.bikeexchange.com.au%2Fa%2Froad-bikes%2Fbianchi%2Fbianchi-aria-disc-ultegra%2F108867069&amp;media=https%3A%2F%2Fmarketplacer.imgix.net%2FDb%2F6Y3bILKoGHQ5F_qJdfY4tTvm8.jpg%3Fauto%3Dformat%26fm%3Dpjpg%26fit%3Dmax%26w%3D1600%26h%3D1000%26s%3Db8a484230652530e38483c7ed9935f44&amp;description=Bianchi%20Aria%20Disc%20-%20Ultegra" rel="nofollow noopener" target="_blank" title="Pin It on Pinterest"> <i class="ricon-pinterest"></i>
                     </a>
                     <div class="fb-like hide fb_iframe_widget" data-action="like" data-href="https://www.bikeexchange.com.au/a/road-bikes/bianchi/bianchi-aria-disc-ultegra/108867069" data-layout="button" data-send="true" data-share="false" data-show-faces="false" fb-xfbml-state="rendered" fb-iframe-plugin-query="action=like&amp;app_id=832281200141295&amp;container_width=0&amp;href=https%3A%2F%2Fwww.bikeexchange.com.au%2Fa%2Froad-bikes%2Fbianchi%2Fbianchi-aria-disc-ultegra%2F108867069&amp;layout=button&amp;locale=en_US&amp;sdk=joey&amp;send=true&amp;share=false&amp;show_faces=false"> <span style="vertical-align: bottom; width: 60px; height: 28px;"> >
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class=" fuse-ad">
            <div data-react-class="FuseAd" data-react-props="{&quot;fuseAccountId&quot;:&quot;1239&quot;,&quot;adName&quot;:&quot;product_footer&quot;,&quot;targetingArguments&quot;:{&quot;advert_id&quot;:108867069}}" data-react-cache-id="FuseAd-0">
               <div data-fuse="product_footer" data-fuse-code="fuse-slot-21824704139-1" data-fuse-slot="71161633/BE_bikeexchange/product_footer">
                  <div id="fuse-slot-21824704139-1" class="fuse-slot" style="" data-google-query-id="CNqEnbWi_e8CFbqBZgId94MOrA">
                     <div id="google_ads_iframe_71161633/BE_bikeexchange/product_footer_0__container__" style="border: 0pt none; margin: auto; text-align: center;">
                        <iframe id="google_ads_iframe_71161633/BE_bikeexchange/product_footer_0" title="3rd party ad content" name="google_ads_iframe_71161633/BE_bikeexchange/product_footer_0" scrolling="no" marginwidth="0" marginheight="0" style="border: 0px none; vertical-align: bottom;" srcdoc="" data-google-container-id="2" data-load-complete="true" width="970" height="250" frameborder="0"></iframe>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </article>
   <div data-react-class="SingleImageModal" data-react-props="{}" data-react-cache-id="SingleImageModal-0">
      <div class="pswp" tabindex="-1" role="dialog">
         <div class="pswp__bg"></div>
         <div class="pswp__scroll-wrap">
            <div class="pswp__container">
               <div class="pswp__item"></div>
               <div class="pswp__item"></div>
               <div class="pswp__item"></div>
            </div>
            <div class="pswp__ui pswp__ui--hidden">
               <div class="pswp__top-bar">
                  <div class="pswp__counter"></div>
                  <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                  <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                  <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                  <div class="pswp__preloader">
                     <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                           <div class="pswp__preloader__donut"></div>
                        </div>
                     </div>
                  </div>
               </div>
               <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
               <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
            </div>
         </div>
      </div>
   </div>
</div>