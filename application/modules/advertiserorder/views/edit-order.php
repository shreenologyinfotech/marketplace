<?php
  $orderId                    = "";
  $totalCost                  = site_currency_symbol()."0.00";
  $totalCostWithTransaction   = site_currency_symbol()."0.00";
  $remainBalance              = site_currency_symbol()."0.00";
  $transactionFee             = site_currency_symbol()."0.00";
  $startDate    = "";
  $endDate      = "";
  $qty          = "";
  $orderType    = "";
  $orderImage   = $this->config->item('upload_url')."ads/"."add-image.jpg";
  $date = date_out();
  if(sizeof($order_details) > 0){
     $result    = $order_details[0];
     $orderId   = $result->order_id;
     $totalCost = site_currency_symbol().$result->total_cost;
     $totalCostWithTransaction = site_currency_symbol().($result->total_cost+$result->transaction_fee);
     $remainBalance = site_currency_symbol().$result->remaining_balance;
     $transactionFee = site_currency_symbol().$result->transaction_fee;
     
     $startDate    = date($date,strtotime($result->start_date));
     $endDate      = date($date,strtotime($result->end_date));
     $qty          = $result->quantity;
     $orderType    = $result->order_type;

     if($result->image_path != ""){
        $orderImage   = $this->config->item('upload_url')."ads/".$result->image_path;
     }

  }


  
?>

<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Order list</h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <a href="<?php echo base_url()?>orders" class="btn btn-info pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Back</a>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><?php echo SITE_TITLE ;?></a></li>
            <li class="active">orders list</li>
        </ol>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->


<!-- /.row -->
<div class="row white-box">
      <div class="col col-6">         
         <div class="product-image">
           <img class="img-fluid" src="<?php echo base_url().$orderImage;?>" alt="">
         </div>
         
       </div>
       <div class="col col-6">
         <div class="order-summery">
           <h3>Your Order</h3>
           <p class="order-id d-inline-block">Order Id:  <?php echo $orderId; ?></p>
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
                    echo "By Postal Sector ".$pin;  
                  }else{
                    echo "Within 500m Radius of Postal Code ".$pin;
                  }?>
                    

              </label>
            
            </div>
            </div>
               <div class="col col-12">
               <span class="border-top d-block">&nbsp;</span>
               <h6 class="mb-4">Quantity:</h6>
               <div class="form-group mt-2 col- col-6">                
                 <div class="date">
                      <input value="<?php echo $qty;?>" type="text" class="form-control radius" placeholder="200">
                    </div>                
               </div>
               </div>
               <div class="col col-12">
               <h6 class="mt-4 mb-4">Total Cost : <?php echo  $totalCost;?></h6>
               <div class="form-row">                
                 <div class="date d-inline col col-6">
                    <span class="col col-6">*Inclusive of <?php echo  $transactionFee;?> transaction fee</span>             
               </div>
               </div>
            </div>
            
         </div>
       </div>
     </div>
    
</div>

</div>
