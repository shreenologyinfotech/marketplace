   
                  <div class="Layout ContentBlock ContentBlock--TextBlock">
                     <div class="Layout-contentInner"></div>
                  </div>
                  <div class="Layout ContentBlock ContentBlock--Slider">
                     <div class='HeroSliderContainer'>
                        <div class='HeroSliderContainer-outer'>
                           <div class='HeroSliderContainer-inner is-loading' data-autoplay data-controls data-slider-speed='5000' id='content_block_slider_2637'>
                              <?php
                                 $banners = get_banners('Home');
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
                  <div class='Layout Layout--background ContentBlock ContentBlock--AdvertSet'>
                     <div class='Layout-contentInner'>
                        <section class='HomePage-section'>
                           <div class='h3'>
                              <h3 style="font-family: Montserrat, 'Open Sans', Sans-Serif; font-weight: 400; text-transform: uppercase; text-align: center; margin: 60px 0 20px 0;"> <?php echo $this->lang->line('Hot Deals'); ?></h3>
                           </div>
                           <div class='AdvertTilesContainer AdvertTilesContainer--slider'>

                              <div class='AdvertTilesContainer-inner is-loading' data-autoplay data-controls data-slider-speed='5000' data-ride="carousel" data-interval="2000" id='content_block_slider_2637987'>
                                 <div class='TileSliderContainer is-loading'>
                                    
                                    <?php
                                       //AddToWishList--inWishList t-addToWishList--inWishList
                                       $homeProducts = get_home_products();
                                       foreach ($homeProducts as $prodObj){ 
                                          $class        = "";
                                          if(is_wishlist_product($prodObj->product_id)){
                                             $class        = "AddToWishList--inWishList t-addToWishList--inWishList";
                                          }

                                          $brand_image = brand_image_by_id($prodObj->brand_id);  
                                          if($brand_image != ""){
                                             $brand_image = base_url().IMAGE_PATH_URL.HOME_CATEGORY_FOLDER.$brand_image;
                                          }else{
                                             $brand_image =  base_url().IMAGE_PATH_URL."img_place.jpg";
                                          }
                                       ?>

                                    <div class='AdvertTile TileSlider-tile advert'>
                                      <div id="wish_<?php echo $prodObj->product_id; ?>" onclick="addWishList('<?php echo $prodObj->product_id;?>',this)"  class="AddToWishList btn btn-tag t-addToWishList <?php echo $class;?>">
                                          <i class="AddToWishList-icon AddToWishList-icon--large TegIcon-largeForButton"></i>
                                       </div>



                                       <a class='AdvertTile-imageBoxContainer t-advertTileLink' href='<?php echo base_url().'productdetails/'.$prodObj->product_id?>'>
                                          <div class='AdvertTile-imageBox AdvertTile-imageBox--padded' style='background-image: url(<?php echo base_url().IMAGE_PATH_URL.PRODUCT_FOLDER.$prodObj->product_image;?>?auto=format&amp;fm=pjpg&amp;fit=max&amp;w=640&amp;h=576&amp;s=f0937af91bc1a40869d8683120c6116f)'></div>
                                       </a>
                                       <div class='AdvertTile-content'>

                                          <div class="AdvertTile-content--brandImage">
                                             <img src="<?php echo $brand_image;?>?auto=format&amp;fm=pjpg&amp;fit=max&amp;s=61065a6cdc189c1cc9772deddf3301b8">
                                          </div>   
                                          <div class='AdvertTile-priceTitleLogo'>
                                             <div class='AdvertTile-price'>
                                                   <span class="Price-sale">Now <?php
                                                   $vatAmount =  get_vat_amount($prodObj->price,$prodObj->vat_percentage);
                                                   echo site_currency_symbol().($prodObj->price); ?></span> 
                                                   <br>
                                                   <span class="Price-sale">VAT <?php
                                                   $vatAmount =  get_vat_amount($prodObj->price,$prodObj->vat_percentage);

                                                   echo site_currency_symbol().($vatAmount); ?></span> 


                                              <?php /*  <span class="Price-was">
                                                   <?php
                                                   $vatAmount =  get_vat_amount($prodObj->price,$prodObj->vat_percentage);
                                                   echo CURRENCY.($prodObj->price + $vatAmount); ?>
                                                </span>

                                              */ ?>
                                                </div>
                                             <a class='AdvertTile-title' href='<?php echo base_url().'productdetails/'.$prodObj->product_id?>'> <?php echo $prodObj->product_name; ?></a>
                                          </div>

                                          <?php

                                             $resultObject = store_details_by_id($prodObj->store_id);
                                             $storeImage = $resultObject->store_image;  
                                             if($storeImage != ""){
                                                $storeImage = base_url().IMAGE_PATH_URL.STORES_FOLDER.$storeImage;
                                             }else{
                                                $storeImage =  base_url().IMAGE_PATH_URL."img_place.jpg";
                                             }

                                          ?>
                                          <div class='AdvertTile-seller'>
                                             <a data-event-label="Wheel &amp; Sprocket - Trek" href="<?php echo base_url().'productdetails/'.$prodObj->product_id?>">
                                             <span class='AdvertTile-location'><img src="<?php echo $storeImage ?>" width="60px" /></span>
                                             <br>   
                                             <?php echo store_name_by_id($prodObj->store_id);?></a>
                                             <div class='AdvertTile-shippingDetails'>
                                                <i class='fa fa-truck'></i>
                                                <?php echo $prodObj->shipping; ?>
                                             </div>
                                             <div class=''>
                                                <div class='AdvertTile-button'>
                                                   <a href='<?php echo base_url().'productdetails/'.$prodObj->product_id?>'>
                                                      <div class='QuickView-button'>
                                                         <div class='btn btn-block btn-ecommerce'>
                                                            <?php echo lang('Buy online'); ?>
                                                         </div>
                                                      </div>
                                                   </a>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                   
                                    <?php
                                       }
                                    ?>
                                 </div>
                                 
                              </div>
                           </div>
                        </section>
                     </div>
                  </div>
                  <div class="Layout ContentBlock ContentBlock--ButtonBlock">
                     <div class="Layout-contentInner">
                        <div class="row grid-center">
                           <div class="col-sm-6"><a class='btn btn-primary btn-large is-wideInNarrow' href='<?php echo base_url()?>search/1/search/0/0/0'>
                              <?php echo lang('Shop Hot Deals'); ?>
                              </a>
                           </div>
                        </div>
                     </div>
                  </div>

            <div class="category--slide" style="display: flex;">      
                  <?php /*
                  <div class="width:18%">
                     <img  src="<?php  echo get_search_banner("1");?>?auto=format&amp;fm=pjpg&amp;fit=max&amp;q=90&amp;&amp;s=dd7909e73a6b1e7b7c9b0f921aa7b3d4">
                  </div>
                  */?>

                  <div class="Layout ContentBlock--SummaryList" style="width:100%">
                     <div class="Layout-contentInner">
                        <section>
                           <div class='grid-center row'>
                              <div class='col-lg-8'>
                                 <h2 class='SummaryList-heading'>
                                    <h3 style="font-family: Montserrat, 'Open Sans', Sans-Serif; font-weight: 400; text-transform: uppercase; text-align: center; margin: 20px 0 20px 0;"><?php lang('Our Top Categories')?></h3>
                                 </h2>
                              </div>
                           </div>
                           <div class='SummaryList SummaryList--itemscount-3 grid-center row'>
                              <?php
                                 foreach ($homeVisibleCategory as $category){ ?>

                                 <div class='SummaryList-item col-xs-4 grid-middle'>
                                    <div class='SummaryList-image'>
                                       <a href="<?php echo base_url()?>search/<?php echo $category->category_id;?>/category"><img height="175px" alt="Road Bikes" src="<?php echo base_url().IMAGE_PATH_URL.HOME_CATEGORY_FOLDER.$category->category_image;?>?auto=format&amp;fm=pjpg&amp;fit=max&amp;s=9f39ed39c010dca68064213f818cbc39" />
                                       </a>
                                       <div class="small"><?php echo $category->category_name;?></div>
                                    </div>
                                 </div>
                              <?php   }
                              ?>
                              
                           </div>
                        </section>
                     </div>
                  </div>
                       <?php /*
                  <div class="width:18%">
                        <img  src="<?php  echo get_search_banner("2");?>?auto=format&amp;fm=pjpg&amp;fit=max&amp;q=90&amp;&amp;s=dd7909e73a6b1e7b7c9b0f921aa7b3d4">

                  </div>
                     */?>

               </div>


                <div class="Layout ContentBlock ContentBlock--SummaryList">
                     <div class="Layout-contentInner">
                        <section>
                           <div class='grid-center row'>
                              <div class='col-lg-8'>
                                 <h2 class='SummaryList-heading'>
                                    <h3 style="font-family: Montserrat, 'Open Sans', Sans-Serif; font-weight: 400; text-transform: uppercase; text-align: center; margin: 0 0 20px 0;">Our Top Brands</h3>
                                 </h2>
                              </div>
                           </div>




                            <div class="Layout Layout--background ContentBlock ContentBlock--TileSet">
                  <div class="Layout-contentInner">

                     

                     <section class="HomePage-section">
                        <div class="CategoryTilesContainer CategoryTilesContainer--slider">
                           <div data-tns-role="wrapper" data-tns-hidden="x">
                              <div data-tns-role="content-wrapper" style="margin: 0px;">
                                 <div class="TileSliderContainer" id="tns2" data-tns-role="content" data-tns-mode="carousel" data-tns-axis="horizontal" style="width: 14670px; transform: translateX(-6825px); transition-duration: 0.3s;">


                                    <?php $brandslist = get_home_brands();
                                    
                                       foreach ($brandslist as $brandslistObj){ ?>
                                    <a class="CategoryTile TileSlider-tile tns-item" href="javascript:void(0)" aria-hidden="true" tabindex="-1" style="width: 305px; margin-right: 20px;">
                                       <div class="CategoryTile-image" style="background-image: url('<?php echo base_url().IMAGE_PATH_URL.HOME_CATEGORY_FOLDER.$brandslistObj->brand_image;?>?auto=format&amp;fm=pjpg&amp;fit=max&amp;w=640&amp;h=576&amp;s=4831ec61ac76d06d75dbd3cbe58c3117')"></div>
                                       
                                    </a>
                                  <?php  } ?>
                                   
                                 </div>
                              </div>
                           </div>
                        </div>
                     </section>



                  </div>
                 </div>

                        </section>
                     </div>
                  </div>


                 
                  <?php
                     $stores  = get_home_stores();
                     if(sizeof($stores) > 0){
                  ?>
                  <div class="Layout ContentBlock ContentBlock--SummaryList">
                     <div class="Layout-contentInner">
                        <section>
                           <div class='grid-center row'>
                              <div class='col-lg-8'>
                                 <h2 class='SummaryList-heading'>
                                    <h3 style="font-family: Montserrat, 'Open Sans', Sans-Serif; font-weight: 400; text-transform: uppercase; text-align: center; margin: 20px 0 20px 0;"><?php  lang('Our Featured Retailers'); ?></h3>
                                 </h2>
                              </div>
                           </div>
                           <div class='SummaryList SummaryList--itemscount-3 grid-center row'>
                              <?php
                                 foreach ($stores as $store) {
                              ?>      
                              <div class='SummaryList-item col-xs-4 grid-middle'>
                                 <div class='SummaryList-image'>
                                    <a href="<?php echo base_url()?>search/<?php echo $store->store_id;?>/store"><img alt="<?php echo $store->store_name;?>" src="<?php echo base_url().IMAGE_PATH_URL.STORES_FOLDER.$store->store_image;?>?auto=format&amp;fm=pjpg&amp;fit=max&amp;s=a2d55acb2fd5c8b0cfa6ce0725bd07db" />
                                    </a>
                                 </div>
                              </div>
                             <?php   }
                              ?>   
 
                              
                           </div>
                        </section>
                     </div>
                  </div>
                    <?php   }
                              ?>   


                 
                  <div class="Layout Layout--hero ContentBlock ContentBlock--TextBlock">
                     <p>
                        <meta charset="UTF-8">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <link href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" rel="stylesheet">
                     </p>
                     <style type="text/css">
                        html{scroll-behavior:smooth}
                        .PromotionBanner-link {text-decoration: none;}  
                        .be-specs {border-collapse:collapse;border-spacing:0;}
                        .be-specs tr {border-bottom: #ebebeb 1px solid;}
                        .be-specs td {font-size: 14px; line-height: 1.2; font-weight: normal; text-align:left; vertical-align:top; padding:10px 5px !important; border-style:solid;border-width:0px;overflow:hidden;word-break:normal;}
                        .be-specs .attribute{font-weight: bold;}
                        .FooterNewsletter {padding: 50px 20px 36px; color: #fff; background-image: linear-gradient(to top, #232a2f 20%, black 100%);}
                        .FooterNewsletter-heading {
                        margin-bottom: 20px;
                        }
                        .SubscribeInput-button {
                        display: inline-block;
                        margin-bottom: 14px;
                        padding: 13px 30px;
                        font-size: 16px;
                        font-weight: 600;
                        line-height: 1;
                        text-transform: none;
                        height: auto;
                        border-radius: 40px;
                        cursor: pointer;
                        }
                        .SubscribeInput-button:hover {
                        background-color: #e70b31;
                        }
                        .read-more-trigger:after, .link-pfeil:after {
                        font-family: 'icomoon';
                        speak: none;
                        font-style: normal;
                        font-weight: normal;
                        font-variant: normal;
                        text-transform: none;
                        line-height: 1;
                        -webkit-font-smoothing: antialiased;
                        -moz-osx-font-smoothing: grayscale;
                        color: #cf0a2c;
                        font-size: 12px;
                        content: "\e602";
                        padding-left: 1px;
                        }
                        .ManagedFooter-column.col-sm-6 {
                        max-width: 100%;
                        flex-basis: 100%;
                        }
                        .row {
                        margin-right: -10px;
                        margin-left: -10px;
                        }
                        .footer-col-12 {
                        -ms-flex: 0 0 100%;
                        flex: 0 0 100%;
                        max-width: 100%;
                        }
                        @media only screen and (min-width: 540px){
                        .footer-col-xs-6 {
                        -ms-flex: 0 0 50%;
                        flex: 0 0 50%;
                        max-width: 50%;}
                        }
                        @media only screen and (min-width: 1040px){
                        .footer-col-md-3 {
                        -ms-flex: 0 0 25%;
                        flex: 0 0 25%;
                        max-width: 25%;}
                        }
                        @media (max-width: 1140px) {
                        .inhalt {
                        max-width: 250px;
                        margin-left: auto;
                        margin-right: auto;}
                        }
                        @media (min-width: 1140px) {
                        .strich {
                        max-width: 300px;
                        margin-bottom: 40px;
                        box-sizing: border-box;
                        position: relative;
                        }
                        .strich:after {
                        content: close-quote;
                        display: block;
                        position: absolute;
                        right: 0;
                        top: 0;
                        height: 100%;
                        width: 1px;
                        background-color: #ebebeb;
                        }
                        }
                        .btn-s {
                        font-size: 14px;
                        padding: 13px 26px;
                        color: #fff;
                        background-color: #cf0a2c;
                        border-radius: 40px;
                        font-weight: 600;}
                        .btn-s:hover {
                        color: #fff;
                        background-color: #e70b31;}
                     </style>
                     <div class="FooterNewsletter">
                        <div class="FooterNewsletter-inner Layout-contentInner">
                           <div class="FooterNewsletter-heading"><?php lang('Discover the latest news, offers and exclusive promotions with our e-newsletter');?></div>
                           <a href="<?php echo base_url();?>subscribenewsletter"><button class="SubscribeInput-button SubscribeInput-link theme-highlightBackgroundColor"><?php echo lang('Sign up');?></button>
                           </a>
                        </div>
                     </div>
                  </div>
               </div>