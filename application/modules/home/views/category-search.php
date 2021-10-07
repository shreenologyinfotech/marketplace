<div class="Layout ContentBlock ContentBlock--TextBlock">
   <div class="Layout-contentInner"></div>
</div>
<div class="Layout ContentBlock ContentBlock--Slider">
   <div class='HeroSliderContainer'>
      <div class='HeroSliderContainer-outer'>
         <div class='HeroSliderContainer-inner is-loading' data-autoplay data-controls data-slider-speed='5000' id='content_block_slider_2637'>
            <?php
               $banners = get_banners('Category');
               
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
<?php

   $brand            = $this->uri->segment(4);
   $category_id         = $this->uri->segment(5);
   $sub_category     = $this->uri->segment(6);
   $search_keyword   = $this->uri->segment(7);
   $min_price        = $this->uri->segment(8);
   $max_price        = $this->uri->segment(9);
   $sort             = $this->uri->segment(10);

   if($min_price == ""){
      $min_price = "0";
   }

   if($max_price == ""){
      $max_price = "0";
   }
   
   

    
?>

<div class="CLayout-contentInner">
<div id="BreadCrumbs">
   <div class="BreadCrumbs">
      <div class="BreadCrumbs-inner" itemscope="" itemtype="">
         <div class="BreadCrumbs-crumb BreadCrumbs-crumb--back">
            <a href="javascript:history.back()">‹ back</a>
         </div>
         <div class="BreadCrumbs-crumb">
            <?php
               $type = $this->uri->segment(3);
               $value = $this->uri->segment(2);
               ?> 
            <a href="<?php echo base_url();?>">Home / <?php echo UCfirst($type)?></a>
         </div>
      </div>
   </div>
</div>
<div data-react-class="FlashMessage" data-react-props="{}" data-react-cache-id="FlashMessage-0"></div>
<div class="Layout Layout--background">
   <div class="Layout-contentInner">
      <div class="AdvertResults">
         <div class="AdvertResults-sidebar">
            <!--filter-->


<div class="RefineBox-taxon RefineBox-collapsible">
   <div class="Collapsible">


       <a class="React-Collapse-toggle" href="javascript:void(0)">
         <div class="Collapsible-heading theme-highlightColor">Brands</div>
      </a>
         <div class="RefineBox-searchSelector">
            <div class="SearchList">
               <div class="">
                  <div class="SearchList-options">
                     <?php
                        $brandsArr = get_all_brands_with_counter();
                        foreach ($brandsArr as $brands) { ?>
                        <div class="SearchList-option has-pointerCursor SearchList-optionWithSuffix">
                           <div class="SearchList-optionCaption">
                              <div class="SearchList-optionCaptionText">
                               
                              <a href="<?php echo base_url();?>search/1/search/<?php echo $brands->brand_id; ?>/0/0"><?php echo $brands->brand_name;?></div>
                              <div class="SearchList-optionCaptionSuffix"><?php echo $brands->number;?></div>
                              </a>

                           </div>
                        </div>      
                     <?php   }
                     ?>
                  </div>
                   
               </div>
            </div>
         </div>



      <?php
         if($brand != "0" && $brand != "" ){ ?>
      <a class="React-Collapse-toggle" href="javascript:void(0)">
         <div class="Collapsible-heading theme-highlightColor">Category</div>
      </a>
         <div class="RefineBox-searchSelector">
            <div class="SearchList">
               <div class="">
                  <div class="SearchList-options">
                     <?php
                        $categoryArr = get_all_category_with_counter($brand);
                        foreach ($categoryArr as $category) { ?>
                        <div class="SearchList-option has-pointerCursor SearchList-optionWithSuffix">
                           <div class="SearchList-optionCaption">
                              <a href="<?php echo base_url();?>search/1/search/<?php echo $brand.'/'.$category->category_id; ?>/0">
                              <div class="SearchList-optionCaptionText"><?php echo $category->category_name;?></div>
                              <div class="SearchList-optionCaptionSuffix"><?php echo $category->number;?></div>
                              </a>
                           </div>
                        </div>      
                     <?php   }
                     ?>
                  </div>
                   
               </div>
            </div>
         </div>
      <?php   } ?>
      
      <?php
         if($category_id != "0" && $category_id != "" ){ ?>
      <a class="React-Collapse-toggle" href="javascript:void(0)">
         <div class="Collapsible-heading theme-highlightColor">Sub Category</div>
      </a>
         <div class="RefineBox-searchSelector">
            <div class="SearchList">
               <div class="">
                  <div class="SearchList-options">
                     <?php
                        $categoryArr = get_all_sub_category_with_counter($category_id);
                        foreach ($categoryArr as $category) { ?>
                        <div class="SearchList-option has-pointerCursor SearchList-optionWithSuffix">
                           <div class="SearchList-optionCaption">
                              <a href="<?php echo base_url();?>search/1/search/<?php echo $brand.'/'.$category->category_id.'/'.$category->sub_category_id; ?>">
                              <div class="SearchList-optionCaptionText"><?php echo $category->sub_category_name;?></div>
                              <div class="SearchList-optionCaptionSuffix"><?php echo $category->number;?></div>
                              </a>
                           </div>
                        </div>      
                     <?php   }
                     ?>
                  </div>
                   
               </div>
            </div>
         </div>
        <?php } ?>

     
         <!-- <a class="React-Collapse-toggle" href="javascript:void(0)">
            <div class="Collapsible-heading theme-highlightColor">Price</div>
         </a>
          <form action="<?php //echo base_url()?>searchpost" method="post">
            

      
         <div class="">

           
               <div class="RefineBox-inputGroup">
                  <div class="RefineBox-price-inputContainer RefineBox-input"><input id="RefineBox-minPrice" name="min_price" class="RefineBox-minPrice" type="search" placeholder="From" value="<?php //echo $min_price ;?>"></div>
                  <div class="RefineBox-price-inputContainer RefineBox-input"><input id="RefineBox-maxPrice" name="max_price" class="RefineBox-maxPrice" type="search" placeholder="To" value="<?php //echo $max_price ;?>"></div>
                  <div class="RefineBox-price-buttonContainer RefineBox-button"><button type="submit" id="RefineBox-priceButton" class="btn btn-primary btn-small"><i class="ricon-arrow-right"></i></button></div>
               </div>
               
               <div id="slider-range" style="width:100%"></div>
            
         </div> -->
       </form>  
      
   </div>
</div>









         </div>
         <div class="AdvertResults-results" id="ResultsContent">
            <div class=" fuse-ad">
               <div >
                  <div data-fuse="category_header"></div>
               </div>
            </div>
            <div class="SearchResults-headerAndTitle">
               <h1 class="h2 SearchResults-heading">
                  <?php
                     $shipping_policy  = "";
                     $return_policy    = "";
                     
                     
                     if($type == "subcategory"){
                        echo subcategory_name_by_id($value);
                     }else if($type == "category"){
                        echo category_name_by_id($value);
                     }else if($type == "brand"){
                        echo brand_name_by_id($value);
                     }else if($type == "store"){ 
                        $resultObject = store_details_by_id($value);
                     
                        $storeImage = $resultObject->store_image;  
                        if($storeImage != ""){
                           $storeImage = base_url().IMAGE_PATH_URL.STORES_FOLDER.$storeImage;
                        }else{
                           $storeImage =  base_url().IMAGE_PATH_URL."img_place.jpg";
                        }
                     
                        $shipping_policy  = $resultObject->shipping_policy;
                        $return_policy    = $resultObject->return_policy;
                     
                     ?>
                  <section class="RetailerInfoPageHeader" id="RetailerInfoPageHeader">
                     <div class="RetailerInfoPageHeader-inner RetailerInfoPageHeader--noImageGallery">
                        <div class="RetailerInfoPageHeader-lhsCol">
                           <div class="RetailerInfoPageHeader-companyLogo"><img src="<?php echo $storeImage; ?>?auto=format&amp;fm=pjpg&amp;fit=max&amp;w=210&amp;h=70&amp;s=4c67c770dcd02c900fdbe6c9d337a3e2" alt="<?php echo $resultObject->store_name; ?>" itemprop="logo"></div>
                           <h1 class="RetailerInfoPageHeader-title"><?php echo $resultObject->store_name; ?></h1>
                           <div class="RetailerInfoPageHeader-ancillaryInfo">
                              <div class="RetailerInfoPageHeader-ancillaryInfoItem RetailerInfoPageHeader-ancillaryInfoItem--abn"><strong><?php echo $resultObject->region.' '.$resultObject->post_code;?></strong></div>
                           </div>

                           <?php /*
                           <div class="RetailerInfoPageHeader-contactButtons">
                              <a class="btn btn-lead RetailerInfoPageHeader-contactButtons--button RetailerInfoPageHeader-emailSeller" href="javascript:void(0)">Email Seller</a>
                              <button class="btn btn-lead RetailerInfoPageHeader-contactButtons--button RetailerInfoPageHeader-showAddress"><i class="fa fa-phone" aria-hidden="true"></i><?php echo $resultObject->store_mobile; ?></button>
                           </div>

                           */ ?>
                           <?php if($shipping_policy != "" && $return_policy != "" ){ ?>
                           <div style="width:100%;margin-top: 20px;line-height: 30px;font-size: 12px;"><b>Shipping Policy : </b><?php echo $shipping_policy; ?></div>
                           <div style="width:100%;line-height: 30px;font-size: 12px;"> <b>Return Policy :  </b><?php echo $return_policy; ?></div>
                           <?php } ?>
                        </div>
                     </div>
                  </section>
                  <?php 
                     //echo store_name_by_id($value);
                     }
                     ?>
               </h1>
               
                  <div class="SearchResults-headerControls">
                     <div class="SearchResults-viewControls">
                     
                        <div class="SearchResults-selectFilters">
                              <div class="SearchResults-selectFilter Select" style="display:none;">


                                 <select onchange="this.options[this.selectedIndex].value && (window.location.href = this.options[this.selectedIndex].value);" name="sort_by" id="sort_by" class="sort-by" data-param="sort-by"><option selected="selected" value="default">Sort by:</option>
                                    <option <?php if($sort == "latest"){ echo 'selected'; }?>   value="<?php echo base_url();?>search/1/search/<?php echo $brand.'/'.$category_id.'/'.$sub_category.'/'.$search_keyword.'/'.$min_price.'/'.$max_price; ?>/latest">Most Recent</option>
                                    <option <?php if($sort == "cheapest"){ echo 'selected'; }?> value="<?php echo base_url();?>search/1/search/<?php echo $brand.'/'.$category_id.'/'.$sub_category.'/'.$search_keyword.'/'.$min_price.'/'.$max_price; ?>/cheapest">Lowest Price</option>
                                    <option <?php if($sort == "expensive"){ echo 'selected'; }?> value="<?php echo base_url();?>search/1/search/<?php echo $brand.'/'.$category_id.'/'.$sub_category.'/'.$search_keyword.'/'.$min_price.'/'.$max_price; ?>/expensive">Highest Price</option>
                                 </select>
                                 </div>
                        </div>
                     </div>
                  </div>
                
            </div>
            <div class="AdvertSearch-header page-header">
               <!-- count 
                  <div class="SearchResults-totalContainer">
                  <div class="SearchResults-total">54069 Ads</div>
                  </div>
                  -->
            </div>
            <div class="AdvertTilesContainer">
               <div class="AdvertTilesContainer-inner">
                  <?php
                     foreach($result_data as $row){
                     
                     $brand_image = $row->brand_image;  
                     if($brand_image != ""){
                        $brand_image = base_url().IMAGE_PATH_URL.HOME_CATEGORY_FOLDER.$brand_image;
                     }else{
                        $brand_image =  base_url().IMAGE_PATH_URL."img_place.jpg";
                     }
                     
                     
                     
                     $productImage = $row->product_image;  
                     if($productImage != ""){
                        $productImage = base_url().IMAGE_PATH_URL.PRODUCT_FOLDER.$productImage;
                     }else{
                        $productImage =  base_url().IMAGE_PATH_URL."img_place.jpg";
                     }
                     
                     ?>
                  <div class="AdvertTile advert featured border-featured promoted ">
                     <div data-react-class="LegacyAddToWishlistButton">
                        <div class="AddToWishList btn btn-tag t-addToWishList"><i class="AddToWishList-icon AddToWishList-icon--large TegIcon-largeForButton"></i></div>
                     </div>
                     <!--<span class="AdvertTile-ribbon ribbon">
                        Pre purchase now
                        </span>-->
                     <a class="AdvertTile-imageBoxContainer t-advertTileLink" href="<?php echo base_url();?>productdetails/<?php echo $row->product_id;?>">
                        <div class="AdvertTile-imageBox AdvertTile-imageBox--padded" style="background-image: url(<?php echo $productImage;?>?auto=format&amp;fm=pjpg&amp;fit=max&amp;w=640&amp;h=576&amp;s=d2e7f856f8d34ffbdff42bd242aa6d44)"></div>
                     </a>
                     <div class="AdvertTile-content">
                        <div class="AdvertTile-content--brandImage">
                           <img src="<?php echo $brand_image;?>?auto=format&amp;fm=pjpg&amp;fit=max&amp;s=61065a6cdc189c1cc9772deddf3301b8">
                        </div>
                        <div class="AdvertTile-priceTitleLogo">
                           <div class="AdvertTile-price"><span class="Price-regular"><?php echo CURRENCY.$row->price; ?></span></div>
                           <a class="AdvertTile-title" href="javascript:void(0)"><?php echo $row->product_name; ?></a>
                        </div>
                        <div class="AdvertTile-seller">
                           <?php
                              $resultObject = store_details_by_id($row->store_id);
                              $storeImage = $resultObject->store_image;  
                              if($storeImage != ""){
                                 $storeImage = base_url().IMAGE_PATH_URL.STORES_FOLDER.$storeImage;
                              }else{
                                 $storeImage =  base_url().IMAGE_PATH_URL."img_place.jpg";
                              }
                           ?>
                           <span class='AdvertTile-location'><img src="<?php echo $storeImage ?>" width="60px" /></span>
                           </br>
                           <a data-event-label="<?php echo $row->store_name; ?>" href="javascript:void(0)">

                            <?php echo $row->store_name; ?></a>
                           
                           
                        <!--   <div class="AdvertTile-shippingDetails">
                              <i class="fa fa-address-card"></i>
                              <?php // echo $row->address; ?>
                           </div>
                        -->
                           <div class="AdvertTile-quickViewButtons">
                              <div class="AdvertTile-button">
                                 <div class="QuickView-button">
                                    <div><a href="<?php echo base_url();?>productdetails/<?php echo $row->product_id;?>" type="button" class="btn btn-block btn-lead"><i class="fa fa-address-book"></i> Contact Seller</a></div>
                                 </div>
                              </div>
                              <!--   <div class="AdvertTile-button QuickView-right">
                                 <div data-react-class="QuickViewButton" class="QuickView-button">
                                    <div><button class="QuickView-button btn btn-block btn-go btn-ecommerce" type="button"><i class="fas fa-shopping-cart"></i>Add to Cart</button></div>
                                 </div>
                                 </div>
                                 
                                 -->
                           </div>
                        </div>
                     </div>
                  </div>
                  <?php
                     }
                     ?>
               </div>
            </div>
            <div style="display: none" role="navigation" aria-label="Pagination" class="pagination CompactPaginator" use_primary_btns="false" optimum_path="/s"><a class="previous_page disabled btn" href="#"><i class="ricon-chevron-left"></i> Prev</a> <span>Page 1 of 2253</span> <a class="next_page btn" rel="next" href="/s?page=2">Next  <i class="ricon-chevron-right"></i></a></div>
            <div class=" fuse-ad">
               <div data-react-class="FuseAd" data-react-props="{&quot;fuseAccountId&quot;:&quot;1239&quot;,&quot;adName&quot;:&quot;category_footer&quot;,&quot;targetingArguments&quot;:{}}" data-react-cache-id="FuseAd-0">
                  <div data-fuse="category_footer"></div>
               </div>
            </div>
            <div class="hide" id="HeaderAdvertReplacement">
               <div class=" fuse-ad">
                  <div data-react-class="FuseAd" data-react-props="{&quot;fuseAccountId&quot;:&quot;1239&quot;,&quot;adName&quot;:&quot;category_header&quot;,&quot;targetingArguments&quot;:{}}" data-react-cache-id="FuseAd-0">
                     <div data-fuse="category_header"></div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="RetailerInfoPageSeoFooter">
         <div></div>
      </div>
   </div>
</div>

