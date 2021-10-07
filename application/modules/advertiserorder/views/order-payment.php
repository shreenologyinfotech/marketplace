
<div class="bg-white">
 <div class="innerpages pt-5 pb-5">
 <div class="container">

<?php 
  $action = $this->config->item("paypal_live_url");
  if(paypal_sandbox()){
    $action = $this->config->item("paypal_sandbox_url");
  }
  
  $orderImage   = "add-image.jpg";
     

foreach ($order_details as $result) {
    if($result->image_path != ""){
        $orderArray =  json_decode($result->image_path,true);
        if($orderArray[0] != ""){
          $orderImage   = 'thumb/'.$orderArray[0];
        }
    }

?>
<div class="">
  
<form method="POST" action="<?php echo $action;?>">
      <input type="hidden" name="business" value="<?php echo paypal_business(); ?>">
      <input type="hidden" name="cmd" value="_xclick" /> 
      <input type="hidden" name="currency_code" value="<?php echo site_currency();?>" />
      <input type="hidden" name="invoice" id="invoice" value="<?php echo  $result->order_id;  ?>"/>
      <input type="hidden" name="first_name"  id ="first_name" value="<?php echo $advertiser_details[0]->fname;?>" />
      <input type="hidden" name="last_name"  id ="last_name" value="<?php echo $advertiser_details[0]->lname;?>" />
      <input type="hidden" name="email"  id ="email" value="<?php echo $advertiser_details[0]->email;?>" />
      <input type="hidden" name="item_name" value="Cashvertise advert fee">
      <input type="hidden" name="item_number" value="<?php echo  $result->id;?>">
      <input type="hidden" name="user_id"  id ="user_id" value="<?php echo $advertiser_details[0]->id;?>" />
      <input type="hidden" name="amount"  id ="amount" value="<?php echo $result->total_cost+$result->transaction_fee;?>" />
      <input type="hidden" name="return"  id ="return" value="<?php echo base_url()?>paypal/success" />
      <input type="hidden" name="notify_url"  id ="notify_url" value="<?php echo base_url()?>paypal/ipn" />
      <input type="hidden" name="cancel_return"  id ="cancel_return" value="<?php echo base_url()?>paypal/cancel" />

     <div class="row">       
       <div class="col col-md-9 col-12">       
         <h6 class="green-bg text-white d-block p-2 pl-3 mb-0">Order Details</h6>
         <div class="order-box bg-white mb-5">           
             <div class="check-product p-3">
             <div class="row">
               <div class="col col-2">
                  <div class="order-picture card-img-top d-flex align-items-center justify-content-center">
                     <img src="<?php echo get_cropped_image(80,120,'uploads/ads/'.$orderImage); ?>" class="mx-auto d-block ad-image" />
                 </div>
               </div>
               <div class="col col-8">
                 <div class="order-text">
                    <p>Order Id: <?php echo get_order_id($result->id);?></p>
                    <p>Transaction Fees</p>
                 </div>
               </div>
               
               <?php /*
               <div class="col col-2">
                 <div class="text-right">
                  <p class=""><input type="button" class="btn-xs btn btn-danger" onclick="performAction('<?php echo base_url();?>ajax/deleteorder/<?php echo $result->id;?>','Delete Order','Are you sure you want to delete this order?','Order deleted successfully')" value="Delete Order"></p>
                  <p class="">&nbsp;</p>
                 </div>
               </div>
               */ ?>

               <div class="col col-2">
                 <div class="order-price text-right">
                  <p class="h5"><?php echo site_currency_symbol();?><?php echo  $result->total_cost;?></p>
                  <p class="h5"><?php echo site_currency_symbol();?><?php echo  $result->transaction_fee;?></p>
                 </div>
               </div>   
               </div>
               </div>
               <span style="line-height:0;" class="border-top d-block m-0">&nbsp;</span>

               <div class="check-product p-3 row">
               <?php /*
               <div class="col col-md-6 col-12"> <a href="<?php echo base_url()?>createorder" class="btn btn-outline-success text-uppercase">CREATE ANOTHER ORDER</a> </div>
               */ ?>
                <div class="col col-md-12 col-12"> <button type="submit"  class="btn pay-btn green-bg text-white text-uppercase">PROCEED TO PAYMENT</button> </div>
               </div>
         </div>
       </div>
       
       <div class="col col-md-3 col-12">   
         <div class="bg-light summary_box p-3">
           <h4 class="mb-4"><strong>Order Summary</strong></h4>
           <div class="table-responsive">
            <table class="table table-borderless" width="100%" border="0" style="font-size:13px;">
              <tr>
                <td> Total Order Amount :</td>
                <td><?php echo site_currency_symbol();?><?php  echo show_two_decimal_number($result->total_cost) ?></td>
              </tr>

              <tr> 
                <td>Transaction Fee :</td>
                <td><?php 
                $transactionFee =  $result->transaction_fee;;
                echo site_currency_symbol();?><?php echo  show_two_decimal_number($transactionFee)?></td>
              </tr>
              
              <tr style="border-top:2px solid #ccc;">
                <td>Total Amount Payable :</td>
                <td><?php 
                $totalAmount = $result->total_cost + $result->transaction_fee - $result->discount_amount;
                
                echo site_currency_symbol();?><?php echo show_two_decimal_number($totalAmount)?></td>
              </tr>
              
            </table>
          </div>
         </div>      
       </div>
</form>
</div></div>
<?php } ?> 
   </div>
 </div>
</div>
</div>