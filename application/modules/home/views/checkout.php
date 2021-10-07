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
                        <h1 class="Cart-header-title h2"><span>Select your shipping address </span></h1>
                        <?php
                             if(!is_user_login()){ ?>
                        <p class="has-topMargin-normal"> Have an account with us?
                           <a href="javascript:void(0)" onclick='showSignInModel()'> <strong> Log in </strong></a>or
                           <a href="javascript:void(0)" onclick='showRegisterModel()' > <strong> Register </strong></a>for a quick checkout. It has never been easier.</p>
                        <?php } ?>   
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-8">
                        <div>
                           <?php 
                                 $shipping_amount                 = 0;
                                 $free_delivery_after_payment     = 0;
                                 $shipping_delivery               = "";
                                 $total                           = 0;
                                 $total_vat                       = 0;
                                 $cod_charges                     = 0;
                                 $store_cart_id = 0;
                                 
                                 foreach($result_data as $cart){
                                    if($total == 0){
                                       $shipping_amount     = $cart->shipping_amount;
                                       $shipping_delivery   = $cart->shipping_delivery;
                                       $free_delivery_after_payment = free_delivery_after_payment($cart->store_id);

                                       $cod_charges = cod_charges($cart->store_id);
                                    }
                                    $store_cart_id =$cart->store_id;

                                    $total = $total + ($cart->price * $cart->qty);
                                    $total_vat = $total_vat + get_vat_amount($cart->price,$cart->vat_percentage);
                                 }
                                 $store_detail  =  '';
                                 $CODAVAILABLE  = 'Y';
                                 if($store_cart_id != 0 && $store_cart_id != ''){
                                    $store_detail = store_details_by_id($store_cart_id);
                                    if($store_detail->cod_available == 'N'){
                                       $CODAVAILABLE  = 'N';
                                    }                                    
                                 }
                                  ?>
                                 


                           <div class="checkForm">


                              <section class="DisplayPanel">
                                    <?php 
                                       $couter  = 0;
                                       $class = '';
                                       foreach($my_address as $address) { 
                                          if($address->is_default == "Y"){
                                             $class = 'red-border';
                                          }else{
                                             $class = '';      
                                          }
                                       ?>

                                       <div  onclick="selectAddress(this,'<?php echo $address->address_id;?>')" id="address-book-entry" class="address-book-entry a-spacing-double-large address-book-new-row <?php echo $class;?>">
                                       <ul class="displayAddressUL" style="list-style: none;">

                                       
                                       <li class="displayAddressLI displayAddressFullName"><b><?php echo login_user_name();?></b></li>
                                       <li class="displayAddressLI displayAddressAddressLine1"><?php echo $address->flat_house_building_company_apartment;?></li>
                                       <li class="displayAddressLI displayAddressAddressLine2"><?php echo $address->area_street_sector_village;?></li>
                                       <li class="displayAddressLI displayAddressCityStateOrRegionPostalCode"><?php echo $address->town_city;?></li>
                                       <li class="displayAddressLI displayAddressCountryName"><?php echo get_country_by_id($address->country_id);?></li>
                                       <li class="displayAddressLI displayAddressCountryName"><?php echo get_state_by_id($address->state_id);?></li>

                                       
                                          
                                       </ul>

                                       
                                    </div>

                                    <?php
                                       $couter++;
                                     } ?>    
                                 </section>



                              <h1 class="Cart-header-title h2"><span>Add New Address</span></h1>

                              <div class="MField">
                                 <label for="order_first_name">Flat / House / Building / Company / Apartment</label>
                                 <input required="" class="TallInput" type="text" name="flat_house_building_company_apartment" id="flat_house_building_company_apartment" value="">
                              </div> 

                              <div class="MField">
                                 <label for="order_first_name">Area / Street / Sector / Village</label>
                                 <input required="" class="TallInput" type="text" name="area_street_sector_village" id="area_street_sector_village" value="">
                              </div> 

                              <div class="MField">
                                 <label for="order_first_name">Land Mark</label>
                                 <input required="" class="TallInput" type="text" name="land_mark" id="land_mark" value="">
                              </div> 

                              <div class="MField">
                                 <label for="country">Country</label>
                                 <select required="required" name="country" id="country" onchange="countryChange()">
                                    <option value="">Select Country</option>
                                    <?php
                                       $countries = get_all_countries();
                                       foreach ($countries as $country) { ?>
                                         <option value="<?php echo $country->id; ?>"><?php echo $country->name; ?></option>
                                    <?php  
                                       }     
                                    ?>
                                 </select>
                              </div>

                              <div class="MField">
                                 <label for="state">State</label>
                                 <select required="required" name="state" id="state" onchange="stateChange()">
                                    <option value="">Select State</option>
                                 </select>
                              </div>


                              <div class="MField">
                                 <label for="city">City</label>
                                 <select required="required" name="city" id="city">
                                    <option value="">Select City</option>
                                 </select>
                              </div>


                              <div class="MField">
                                 <label for="order_first_name">Postal Code</label>
                                 <input required="" class="TallInput" type="text" name="postal_code" id="postal_code" value="">
                              </div> 


                              
                              <p class="error-address"></p>

                              <button onclick="addNewAddress();" style="float: right" type="button" class="btn btn-go btn-large" data-disable-with="Add"> Add</form>




                          </div> 


                        </div>
                        <div class="Cart-buttons clearfix hide is-visibleInWide"><a class="btn" href="<?php echo base_url();?>">Continue Shopping</a></div>
                     </div>
                     <?php
                        if($free_delivery_after_payment <= $total){
                           $shipping_amount = 0.00;
                        }
                     ?>
                     <div class="col-sm-4">
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

                        <!-- <div>
                           <div class="Cart-totalRow Cart-shippingRow">
                              <div class="Cart-totalLeft">Pago por contra reembolso</div>
                              <div class="Cart-totalRight"><?php //echo CURRENCY.$cod_charges;?></div>
                           </div>
                        </div> -->
                        

                      

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
                                 <?php
                                    if(is_user_login()){ ?>


                                       <button onclick="openbankmodel();" class="btn btn-go btn-medium is-wide  Cart-checkoutButton has-topMargin-normal">Pay Via Bank <i class="fa fa-arrow-right"></i></button>

                                       <?php if($CODAVAILABLE == 'Y'){ ?> 
                                       <form action="<?php echo base_url()?>checkout-confirm/cod" accept-charset="UTF-8" method="post">

                                          <button class="btn btn-go btn-medium is-wide  Cart-checkoutButton has-topMargin-normal">COD <i class="fa fa-arrow-right"></i></button>
                                      </form>
                                      <?php } ?>
                                     <form action="<?php echo base_url()?>checkout-confirm/paypal" accept-charset="UTF-8" method="post">
                                          <button style="background:#00A8EA" class="btn btn-go btn-medium is-wide  Cart-checkoutButton has-topMargin-normal">Paypal <i class="fa fa-arrow-right"></i></button>
                                     </form>
                                     
                                     <form action="<?php echo base_url()?>checkout-confirm/stripe" accept-charset="UTF-8" method="post">
                                          <button style="background:#00A8EA" class="btn btn-go btn-medium is-wide  Cart-checkoutButton has-topMargin-normal">Stripe <i class="fa fa-arrow-right"></i></button>
                                    
                                       </form>   

                                 <?   }else{ ?>

                                    <button  onclick='showSignInModel()' class="btn btn-go btn-medium is-wide  Cart-checkoutButton has-topMargin-normal">Login To Checkout <i class="fa fa-arrow-right"></i></button>

                                 <?php }
                                 ?>
                                 
                              </div>
                           </div>
                           <div class="ReassuranceLogos">
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