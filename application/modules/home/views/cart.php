<div class="CLayout-contentInner">
<div id="BreadCrumbs">
   <div class="BreadCrumbs">
      <div class="BreadCrumbs-inner" itemscope="" itemtype="">
         <div class="BreadCrumbs-crumb BreadCrumbs-crumb--back"> <a href="javascript:history.back()">‹ back</a> </div>
         <div class="BreadCrumbs-crumb"> <a href="<?php echo base_url();?>">Home / Favourite</a> </div>
      </div>
   </div>
</div>
<div class="Layout Layout--background">
<div class="Layout-contentInner">
   <div class="CLayout-fixedWidth clearfix">
      <div >
         <div id="#cart">
            <div class="page-header">
               <div>
                  <h1 class="Cart-header-title h2"><span>Select your shipping address </span><span class="Cart-title-number-of-items theme-highlightColor">contains <?php echo getCartCount(); ?> items</span></h1>
                  <?php
                     if(!is_user_login()){ ?>
                  <p class="has-topMargin-normal"> Have an account with us?
                     <a href="javascript:void(0)" onclick='showSignInModel()'> <strong> Log in </strong></a>or
                     <a href="javascript:void(0)" onclick='showRegisterModel()' > <strong> Register </strong></a>for a quick checkout. It has never been easier.
                  </p>
                  <?php } ?>   
               </div>
            </div>
            <div class="row">
               <div class="col-sm-8">
                  <div>
                     <?php 
                        $shipping_amount     = 0;
                        $free_delivery_after_payment     = 0;
                        $shipping_delivery   = "";
                           
                        $total = 0;
                        $total_vat = 0;
                        foreach($result_data as $cart){
                        if($total == 0){
                           $shipping_amount     = $cart->shipping_amount;
                           $shipping_delivery   = $cart->shipping_delivery;
                           $free_delivery_after_payment = free_delivery_after_payment($cart->store_id);
                           
                        } 
                        
                        
                        $total = $total + ($cart->price * $cart->qty);
                        $total_vat = $total_vat + get_vat_amount($cart->price,$cart->vat_percentage);
                        
                        $brand_image = $cart->brand_image;  
                        if($brand_image != ""){
                           $brand_image = base_url().IMAGE_PATH_URL.HOME_CATEGORY_FOLDER.$brand_image;
                        }else{
                           $brand_image =  base_url().IMAGE_PATH_URL."img_place.jpg";
                        }
                        
                        $productImage = $cart->product_image;  
                        if($productImage != ""){
                           $productImage = base_url().IMAGE_PATH_URL.PRODUCT_FOLDER.$productImage;
                        }else{
                           $productImage =  base_url().IMAGE_PATH_URL."img_place.jpg";
                        }
                        
                        $storeImage = $cart->store_image;  
                        if($storeImage != ""){
                           $storeImage = base_url().IMAGE_PATH_URL.STORES_FOLDER.$storeImage;
                        }else{
                           $storeImage =  base_url().IMAGE_PATH_URL."img_place.jpg";
                        }
                        
                        
                        ?>
                     <div class="DisplayPanel Cart-storePanel t-cart-0">
                        <div>
                           <div class="Cart-itemRow t-cartItemRow-0-0">
                              <div class="Cart-ItemContent">
                                 <div class="Cart-itemDetails row">
                                    <div class="col-sm-8 col-md-9">
                                       <div class="row">
                                          <div class="col-sm-4">
                                             <div class="Cart-itemImage"><img src="<?php echo $productImage;?>" title="3T Strada Team Ekar Edition"></div>
                                          </div>
                                          <div class="col-sm-8">
                                             <ul class="unstyled Cart-itemDetailsProperties">
                                                <li><a class="Cart-itemTitle" href="<?php echo base_url();?>productdetails/<?php echo $cart->product_id;?>"><?php echo $cart->product_name;?></a></li>
                                                <!-- <li><strong>Size / Colour /  </strong>Small / Purple / 53cm</li> -->
                                                <li><strong>from: </strong><?php echo $cart->store_name;?></li>
                                             </ul>
                                             <div class="Cart-itemQuantitySelect">
                                                <label for="x8f5d0cab-ff74-4f8f-84a4-54b07bd44f60">Qty: </label>
                                                <div class="MQuantitySelector">
                                                   <!-- <button aria-label="Decrement quantity" class="MButton MQuantityButton MQuantitySelector-decrementButton" disabled=""><span aria-hidden="true"></span></button> -->
                                                   <input id="x8f5d0cab-ff74-4f8f-84a4-54b07bd44f60" max="1" min="1" type="number" value="<?php echo $cart->qty;?>">
                                                   <!-- <button aria-label="Increment quantity" class="MButton MQuantityButton MQuantitySelector-incrementButton" disabled=""><span aria-hidden="true"></span></button> -->
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-sm-4 col-md-3 Cart-itemPriceDetails">
                                       <div class="Cart-itemStoreLogoAndPrice">
                                          <div>
                                             <a href="javascript:void(0)"><img src="<?php echo $storeImage;?>"class="Cart-itemStoreLogo"></a>
                                             <br>
                                          </div>
                                          <?php echo CURRENCY.$cart->price; ?>
                                          <br>
                                          <?php
                                             $vatAmount =  get_vat_amount($cart->price,$cart->vat_percentage);
                                             echo "VAT(".$cart->vat_percentage."%) - ".CURRENCY.$vatAmount; ?>
                                          <br>
                                          <?php echo "TOTAL - ".CURRENCY.(($cart->price * $cart->qty) +$vatAmount); ?>
                                          <div class="Cart-itemRemoveButton"><a onclick="removeCartItem('<?php echo $cart->cart_id; ?>')" class="btn btn--hasOnlyIcon"><i class="fa fa-trash"></i></a></div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <hr class="Cart-itemHr">
                           </div>
                        </div>
                     </div>
                     <?php } 
                     ?>
                     <div class="ShippingSelectorContainer">
                        <div class="has-topMargin-xlarge has-bottomMargin-xlarge">
                           <div class="row has-topMargin-large has-bottomMargin-large">
                              <div class="ShippingSelectionOption-heading has-bottomMargin-small col-sm-3 t-shippingOption">
                                 <div><strong>Standard shipping</strong><strong style="display: block;"><?php echo CURRENCY.$shipping_amount;?></strong></div>
                              </div>
                              <div class="ShippingSelectionOption-description col-sm-9">
                                 <div class="has-bottomMargin-mini"><?php echo $shipping_delivery;?></div>
                              </div>
                           </div>
                        </div>
                        <hr class="Cart-itemHr">
                     </div>
                     
                  </div>
                  <div class="Cart-buttons clearfix hide is-visibleInWide"><a class="btn" href="<?php echo base_url();?>">Continue Shopping</a></div>
               </div>
               <div class="col-sm-4">
                  <?php
                     if($free_delivery_after_payment <= $total){
                        $shipping_amount = 0.00;
                     }
                  ?>
                  <div class="DisplayPanel Cart-totals">
                     <div>
                        <h3 class="DisplayPanel-heading has-noTopMargin">Shopping Cart Total (AUD)</h3>
                        <div class="Cart-totalRow t-cartSubtotalRow">
                           <div class="Cart-totalLeft">Subtotal </div>
                           <div class="Cart-totalRight"><?php echo CURRENCY.$total;?></div>
                        </div>

                        <div class="Cart-totalRow t-cartSubtotalRow">
                           <div class="Cart-totalLeft">VAT </div>
                           <div class="Cart-totalRight"><?php echo CURRENCY.$total_vat;?></div>
                        </div>

                        <div>
                           <div class="Cart-totalRow Cart-shippingRow">
                              <div class="Cart-totalLeft">Shipping</div>
                              <div class="Cart-totalRight"><?php echo CURRENCY.$shipping_amount;?></div>
                           </div>
                        </div>

                         <div>
                           <div class="Cart-totalRow Cart-shippingRow">
                              <div class="Cart-totalLeft">Free Shipping After</div>
                              <div class="Cart-totalRight"><?php echo CURRENCY.$free_delivery_after_payment;?></div>
                           </div>
                        </div>
                        <!--    <div class="Cart-totalRow">
                           <div class="Cart-totalLeft">GST Inc. </div>
                           <div class="Cart-totalRight"> $984.37</div>
                           </div>
                           -->
                        <div class="Cart-grandTotalRow clearfix">
                           <div class="Cart-rhsGrandTotal">
                              <div class="Cart-totalLeft"><strong>Total</strong></div>
                              <div class="Cart-totalRight"> <?php echo CURRENCY.($total+$shipping_amount+$total_vat);?></div>
                           </div>
                        </div>
                     </div>
                     <div>
                        <div>
                           <a href="<?php echo base_url();?>pre-checkout" class="btn btn-go btn-extraLarge is-wide has-bottomMargin-normal Cart-checkoutButton has-topMargin-normal">Check Out <i class="fa fa-arrow-right"></i></a>
                        </div>
                     </div>
                     <div class="ReassuranceLogos">
                        <!-- <div class="is-textCentered">
                           <p class="ReassuranceLogos-anyQuestions small">If you have any questions please give us a call on
                              <br><i class="fa fa-phone"></i><a href="tel: (03) 9257 3200"> (03) 9257 3200</a>
                           </p>
                        </div> -->
                        <div class="ReassuranceLogos-paymentIcons is-textCentered">
                           <img src="<?php echo base_url().IMAGE_PATH_URL;?>icon_mastercard.png">
                           <img src="<?php echo base_url().IMAGE_PATH_URL;?>icon_visa.png">
                           <img src="<?php echo base_url().IMAGE_PATH_URL;?>icon_paypal.jpg">
                           <!-- <p class="small">Redeem E-Gift voucher in payment section</p> -->
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

