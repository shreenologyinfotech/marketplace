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
                        <h1 class="Cart-header-title h2" align="center"><span>Your Shipping Details </span></h1>

                        <h1 class="Cart-header-title h2" align="center"><span>Payment Mode is - <?php echo strtoupper($pay_mode); ?> </span></h1>


                        <?php
                             if(!is_user_login()){ ?>
                        <p class="has-topMargin-normal"> Have an account with us?
                           <a href="javascript:void(0)" onclick='showSignInModel()'> <strong> Log in </strong></a>or
                           <a href="javascript:void(0)" onclick='showRegisterModel()' > <strong> Register </strong></a>for a quick checkout. It has never been easier.</p>
                        <?php } ?>   
                     </div>
                  </div>
                  <div class="row">
                  
                        <div>
                           <?php 
                                 $shipping_amount                 = 0;
                                 $free_delivery_after_payment     = 0;
                                 $shipping_delivery               = "";
                                 $total                           = 0;
                                 $total_vat                       = 0;
                                 $cod_charges                     = 0;

                                 
                                 foreach($result_data as $cart){
                                    if($total == 0){
                                       $shipping_amount     = $cart->shipping_amount;
                                       $shipping_delivery   = $cart->shipping_delivery;
                                       $free_delivery_after_payment = free_delivery_after_payment($cart->store_id);

                                       $cod_charges = cod_charges($cart->store_id);
                                    }

                                    $total = $total + ($cart->price * $cart->qty);
                                    $total_vat = $total_vat + get_vat_amount($cart->price,$cart->vat_percentage);
                                 } ?>

                        </div>
                    
                
                     <?php
                        if($free_delivery_after_payment <= $total){
                           $shipping_amount = 0.00;
                        }
                     ?>
                     <div class="col-sm-8 col-offset-2">
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

                        <?php if($pay_mode == "cod"){ 
                           $total = $total + $cod_charges;

                        ?>
                        <div>
                           <div class="Cart-totalRow Cart-shippingRow">
                              <div class="Cart-totalLeft">Pago por contra reembolso</div>
                              <div class="Cart-totalRight"><?php echo CURRENCY.$cod_charges;?></div>
                           </div>
                        </div>
                        <?php } ?>

                      

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

                                       <?php if($pay_mode == "cod"){?>
                                    
                                       <form action="<?php echo base_url()?>checkout" accept-charset="UTF-8" method="post">
                                          <button class="btn btn-go btn-medium is-wide  Cart-checkoutButton has-topMargin-normal">Pay Now <i class="fa fa-arrow-right"></i></button>
                                       </form>
                                      <?php } if($pay_mode == "paypal"){ ?> 

                                       <form action="<?php echo base_url()?>paywithpaypal" accept-charset="UTF-8" method="post">

                                          
                                          <input type="hidden" name="total" value="<?php echo $total+$shipping_amount+$total_vat;?>"/>

                                          <button style="background:#00A8EA" class="btn btn-go btn-medium is-wide  Cart-checkoutButton has-topMargin-normal">Pay Now <i class="fa fa-arrow-right"></i></button>
                                       </form>

                                    <?php } if($pay_mode == "stripe"){ ?> 
                                       <form action="<?php echo base_url()?>stripepay" accept-charset="UTF-8" method="post">

                                          <input type="hidden" name="total" value="<?php echo $total+$shipping_amount+$total_vat;?>"/>
                                          <button style="background:#00A8EA" class="btn btn-go btn-medium is-wide  Cart-checkoutButton has-topMargin-normal">Pay Now <i class="fa fa-arrow-right"></i></button>
                                       </form>

                                  <?php } ?>      
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