<div class="CLayout-contentInner">
   <div id="BreadCrumbs">
      <div class="BreadCrumbs">
         <div class="BreadCrumbs-inner" itemscope="" itemtype="">
            <div class="BreadCrumbs-crumb BreadCrumbs-crumb--back"> <a href="javascript:history.back()">‹ back</a> </div>
            <div class="BreadCrumbs-crumb"> <a href="<?php echo base_url();?>">Home / Favourite</a> </div>
         </div>
      </div>
   </div>
   <div data-react-class="FlashMessage" data-react-props="{}" data-react-cache-id="FlashMessage-0"></div>
   <div class="Layout Layout--background">
      <div class="Layout-contentInner">
         
               
               
               <div class="CLayout-fixedWidth clearfix">
                  <div class="page-header">
                     <h1 class="h2">My Wish List</h1> </div>
                  <div class="layout-withRightSidebar-content">
                     <div >
                        <div class="AdvertTilesContainer AdvertTilesContainer--list">
                           
                           <?php
                              foreach ($result_data as $prodObj){ 
                                 $storeImage = $prodObj->store_image;  
                                 if($storeImage != ""){
                                    $storeImage = base_url().IMAGE_PATH_URL.STORES_FOLDER.$storeImage;
                                 }else{
                                    $storeImage =  base_url().IMAGE_PATH_URL."img_place.jpg";
                                 }
                                 

                              ?>

                              <div class="WishList-item-container_<?php echo $prodObj->product_id; ?>">
                               <div id="WishList-item-108634366" class="WishList-item">
                                 <div class="AdvertTile advert" id="advert_108634366">

                                    <div id="wish_<?php echo $prodObj->product_id; ?>" onclick="addWishList('<?php echo $prodObj->product_id;?>',this)"  class="AddToWishList btn btn-tag t-addToWishList AddToWishList--inWishList t-addToWishList--inWishList">
                                          <i class="AddToWishList-icon AddToWishList-icon--large TegIcon-largeForButton"></i>
                                    </div>

                                    <a class="AdvertTile-imageBoxContainer t-advertTileLink" href="<?php echo base_url().'productdetails/'.$prodObj->product_id?>">
                                       <div class="AdvertTile-imageBox AdvertTile-imageBox--padded" style="background-image: url(<?php echo base_url().IMAGE_PATH_URL.PRODUCT_FOLDER.$prodObj->product_image;?>?auto=format&amp;fm=pjpg&amp;fit=max&amp;w=640&amp;h=576&amp;s=f0937af91bc1a40869d8683120c6116f)"></div>
                                    </a>
                                    <div class="AdvertTile-content">
                                       <div class="AdvertTile-content--brandImage"> <img src="<?php echo $storeImage;?>"> </div>
                                       <div class="AdvertTile-priceTitleLogo">
                                          <div class="AdvertTile-price"><span class="Price-regular"> <?php echo $prodObj->price; ?></span></div>
                                          <a class="AdvertTile-title" href="javascript:void(0)"> <?php echo $prodObj->product_name; ?></a> </div>
                                       <div class="AdvertTile-description"> <?php echo $prodObj->description; ?> </div>
                                       <div class="AdvertTile-seller">
                                          <div class="AdvertTile-shippingDetails"> <i class="ricon-truck AdvertTile-highlight-icon"></i><?php echo $prodObj->shipping; ?> </div>
                                          
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>



                           <?php   }
                           ?>

                          






                        
                  </div>
                  <div class="layout-withRightSidebar-sidebar"> </div>
               </div>
            </div>
         </div>
      </div>