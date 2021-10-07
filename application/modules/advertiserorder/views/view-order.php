<?php
  $orderId                    = "";
  $orderPId                   = "";
  $totalCost                  = site_currency_symbol()."0.00";
  $totalCostWithTransaction   = site_currency_symbol()."0.00";
  $remainBalance              = site_currency_symbol()."0.00";
  $transactionFee             = site_currency_symbol()."0.00";
  $startDate    = "";
  $endDate      = "";
  $qty          = "";
  $orderType    = "";
  $orderImage   = "";
  $zipCodes     = "";
  $date = date_out();
  $postal_code  = "";
  $strtotalCost = "0.00";


  $totalView            = "NIL";
  $totalClick            = "NIL";
  $totalDistributed     = "NIL";


  if(sizeof($order_details) > 0){
     $result    = $order_details[0];
     $orderId   = $result->order_id;
     $orderPId   = $result->id;
     $totalCost = site_currency_symbol().$result->total_cost;
     $strtotalCost = $result->total_cost;
     $totalCostWithTransaction = site_currency_symbol().($result->total_cost+$result->transaction_fee);
     $remainBalance = site_currency_symbol().$result->remaining_balance;
     $transactionFee = site_currency_symbol().$result->transaction_fee;
     
     $startDate    = date($date,strtotime($result->start_date));
     $endDate      = date($date,strtotime($result->end_date));
     $qty          = $result->quantity;
     $orderType    = $result->order_type;

     if($result->image_path != ""){
        $orderImage   = $result->image_path;
     }

      $zipCodes             = get_zip_code_by_order_id($result->id);
      $totalView            = total_view_by_order_id($result->id);
      $totalClick            = total_click_through_order_id($result->id);
      $totalDistributed     = total_distributed_by_order_id($result->id);

      if($result->order_lat !=  0 && $result->order_lng != 0){
        $postal_code  = postal_form_lat_lng($result->order_lat,$result->order_lng);
      }
  }

  

?>




<div class="bg-white">
<div class="page-title green-bg pt-3 pb-3">
  <div class="container">
   <div class="row">
    <div class="col col-md-8 col-12">
        <h2 class="text-uppercase text-white">Your Order</h2>
    </div>
    <div class="col col-4"></div>
   </div>
  </div>
</div>
 <div class="innerpages pt-5 pb-5">
   <div class="container">
     <div class="row">
       <div class="col col-6">         
         <?php /*<div class="product-image">
           <img class="img-fluid" src="<?php echo base_url().$orderImage;?>" alt="">
         </div> */ ?>
          <?php /*
       <div class="mx-auto d-block text-center product-image">
         <img class="img-fluid order-image" src="<?php echo base_url().$orderImage;?>" alt="">
       </div>

      */
      $ad_image = json_decode($orderImage,true);


      ?>
       <div class="demo">
    <ul id="lightSlider">
       <?php 

       $defaultImage = get_cropped_image(600,600,'uploads/ads/add-image.jpg');

       if(!empty($ad_image)){
          foreach ($ad_image as $image) { 
            if($image != ''){
              $url="uploads/ads/".$image;
              if(file_exists($url)){
                $imgUrl  =   get_cropped_image(600,600,'uploads/ads/'.$image);
              }else{ 
                 $imgUrl = $defaultImage;
              }
            }else{ 
                $imgUrl  = $defaultImage;
            }?>
          <li class="d-flex align-items-center justify-content-center" data-thumb="<?php echo $imgUrl;?>" style="width:100%;height:400px;">
              <img src="<?php echo $imgUrl;?>"/>
           </li>
       <?php }
          }else{?>
            <li class="d-flex align-items-center justify-content-center" style="width:100%;height:400px;" data-thumb="<?php echo base_url()."uploads/ads/add-image.jpg";?>">
              <img src="<?php echo  $defaultImage ?>"/>
           </li>
          <?php 
          } 
      ?> 
    </ul>
</div>
       </div>
       <div class="col col-6">
         <div class="order-summery">
           <h3>Your Order</h3>
           <p class="order-id d-inline-block">Order Id:  <?php echo get_order_id($orderPId);?></p>
           <span class="float-right greentxt">Remaining Balance: <?php echo $remainBalance;?></span>
           <span class="border-top d-block">&nbsp;</span>
             <div class="row">
               <div class="col col-6">
               <div class="form-group">
                 <label>Start Date</label>
                 <div class="date"> <span><?php echo $startDate;?></span> </div>                
               </div>
               </div>
               <div class="col col-6">
               <div class="form-group">
                 <label>End Date</label>
                 <div class="date"> <span><?php echo $endDate;?></span> </div>                 
               </div>
               </div>
               
               
               <div class="col col-12">
               <span class="border-top d-block">&nbsp;</span>
            <h6 class=" mb-4">Selected Area</h6>            
            <div class="custom-control col-12 mb-3 custom-radio">             
              
              <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadio1">
                  <?php if($orderType == "Whole Country"){
                    echo "Whole Singapore";
                  }else if($orderType == "Specific Postal Code"){
                    echo "By Postal Sector ".$zipCodes;  
                  }else{
                    echo "Within 500m Radius of Postal Code ".$postal_code;
                  }?>
                    

              </label>
            
            </div>
            </div>


               <div class="col col-12">
               <div class="row">
                 <div class="col col-md-6 col-12">
                 <h6 class="mt-4 mb-4">Quantity:</h6>
                 <div class="form-group mt-2 pl-0">                
                 <div class="date">
                      <input readonly="" value="<?php echo $qty;?>" type="text" class="disabled form-control radius" placeholder="200">
                    </div>                
             </div>
                 </div>
                 <div class="col col-md-6 col-12">
                 <h6 class="mt-4 mb-4">Total Cost :</h6>
                 <div class="form-row">                
                 <div class="date d-inline col col-6">

                  
                      <input readonly="" type="text" value="<?php echo  $strtotalCost;?>" id="disabledTextInput" class="disabled form-control radius" placeholder=""> </div>   

                     <span class="small mb-0">*Inclusive of <?php echo  $transactionFee;?> transaction fee 
                   </span>  

                    
               </div>
                 </div>
               </div>
             </div>    

             </div>
           

           <div align="center" class="col col-12 mt-3">
                <a href="<?php echo base_url()?>trackyourorders" class="btn radius green-bg pl-4 pr-4 text-white d-inline-block">BACK</a>
           </div>   


            
         </div>
       </div>
     </div>
     <div class="clearfix"></div>
     
     <div class="total-order mt-5">
       <div class="row">
         <div class="col col-md-12 col-12">
           <div class="table-responsive">             
               <table class="table text-center" width="100%" border="0">
                  <tr>
                  <?php /* <td><span class="greentxt">Total Distributed </span> <br /> <?php echo $totalDistributed; ?></td> */ ?>
                    <td><span class="greentxt">Total Viewed </span> <br /> <?php echo $totalView; ?></td>
                    <td><span class="greentxt">Total Click-Through </span> <br /> <?php echo $totalClick; ?></td>
                  </tr>                  
                </table>             
           </div>
         </div>
       </div>
     </div>
   </div>
 </div>
    </div>
 