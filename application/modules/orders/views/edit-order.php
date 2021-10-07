<?php
  $orderId                    = "";
  $orderPreId                = "";
  $totalCost                  = site_currency_symbol()."0.00";
  $totalCostWithTransaction   = site_currency_symbol()."0.00";
  $remainBalance              = site_currency_symbol()."0.00";
  $transactionFee             = site_currency_symbol()."0.00";
  $startDate    = "";
  $endDate      = "";
  $qty          = "";
  $orderType    = "";
 
  $orderImage   = "uploads/ads/"."add-image.jpg";
  $date = date_out();

  $regionId     = "";
  $areaId       = "";
  $zipId        = "";
  $advert_display_time = "";
  $advertise_per_view_cost = "";


  if(sizeof($order_details) > 0){
     $result    = $order_details[0];
     $orderId   = $result->id;
     $orderPreId   = $result->order_id;
     $totalCost = site_currency_symbol().$result->total_cost;
     $totalCostWithTransaction = site_currency_symbol().($result->total_cost+$result->transaction_fee);
     $remainBalance = site_currency_symbol().$result->remaining_balance;
     $transactionFee = site_currency_symbol().$result->transaction_fee;
     
     $startDate    = date("Y-m-d",strtotime($result->start_date));
     $endDate      = date("Y-m-d",strtotime($result->end_date));
     $qty          = $result->quantity;
     $orderType    = $result->order_type;
     $regionId    = $result->region_id;

     $areaId       = $result->area_id;
     $zipId        = $result->pincode;
     $advert_display_time       = $result->advert_display_time;
     $advertise_per_view_cost   = $result->advertise_per_view_cost;

     if($result->image_path != ""){
        $orderImage   = "uploads/ads/".$result->image_path;
     }

  }

?>



<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Edit Order</h4> </div>
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



<div class="bg-white innerpages pt-5 pb-5">
   <div class="container">
      



<form method="POST" action="<?php echo base_url()?>doeditorder" enctype="multipart/form-data">
<div class="bg-white">
 <div class="innerpages pt-5 pb-5">
   <div class="container">
     <div class="row">
       <div class="col col-6">
       <div class="order-top mb-4">
         <div class="row">
          <div class="col col-6">
            <div>
              
              <span class="d-inline">Image to upload:</span>
              <br>
              <span class="d-inline text-danger">Please upload image file in respect of 760 * 760</span>
            </div>
          </div>
          <div class="col col-6 text-right">
            <div class="fileUpload btn btn-outline-dark rounded-0 pl-4 pr-4 m-0">
                <span>Browse</span>

                <input onchange="readURL(this);" <?php if($orderId == ""){ echo 'required'; }?>  id="ads_image" name="ads_image" data-text="Select your add image" data-dragdrop="true" type="file" class="upload" />
               </div>
               <!-- <button class="btn btn btn-outline-secondary rounded-0 pl-4 pr-4 ml-3">Preview</button> -->
          </div>
         </div>
        </div>     
         <div class="mx-auto d-block text-center product-image">
           <img id="add-image-file" class="img-fluid order-image" src="<?php echo base_url().$orderImage;?>" alt="">
         </div>
       </div>
       <div class="col col-6">
         <div class="order-summery">
           <?php if($orderId != ""){?>
               <h3>Edit Order : Order Id <?php echo  $orderPreId;?></h3>
           <?php }else{?>
              <h3>Create New Order</h3>
           <?php } ?>


           <span class="border-top d-block">&nbsp;</span>
        
             <div class="row">
               <div class="col col-6">
               <div class="form-group">
                 <label>Select Start Date</label>
                 <div class="date">
                      <input required name="startDate" type="text" class="datepicker form-control radius" placeholder="Select Date" value="<?php echo $startDate;?>">
                    </div>                
               </div>
               </div>
               <div class="col col-6">
               <div class="form-group">
                 <label>Select End Date</label>
                 <div class="date">
                      <input required name="endDate" type="text" class="datepicker form-control radius" placeholder="Select Date" value="<?php echo $endDate;?>">
                    </div>                 
               </div>
               </div>
               <div class="col col-12">
            <label class="mt-4 mb-4">Select Area</label>
            

            <div class="col-12 mb-3">             
              <input value="Whole Country" <?php if($orderType == "" || $orderType =="Whole Country"){ ?> checked="true" <?php } ?> onclick="clickRadio()" type="radio" id="customRadio1" name="customRadio" class="">
              <label class="custom-control-label" for="customRadio1">Whole Singapore</label>
            </div>
            
            <div class="form-row mb-3 ">
              <div class="col col-9">
                <div class="">
              <input <?php if($orderType == "Specific Postal Code"){ ?> checked="true" <?php } ?> value="Specific Postal Code" type="radio" onclick="clickRadio2()" id="customRadio2" name="customRadio" class="">
              <label class="custom-control-label" for="customRadio2">By Postal Sector</label>
            </div>
              </div>
            </div>
            <div class="form-row mb-3 ">
              <div class="col col-9">
                <div class="">
              <input <?php if($orderType == "Specific Radius"){ ?> checked="true" <?php } ?> value="Specific Radius" type="radio" onclick="clickRadio3()"  id="customRadio3" name="customRadio" class="">
              <label class="custom-control-label" for="customRadio3">Within 500m Radius of Postal Code:</label> 
            </div>
              </div>
            </div>
            </div>
             <div class="" id="zip-postal-area" <?php if($orderType == "" || $orderType =="Whole Country"){ ?> style="display: none" <?php } ?>>
                <div class="col col-12 mb-3">
                      <select onchange="dlChange('<?php echo base_url()?>getareabycentral','central')" id="dl_central"  name="dl_central" class="form-control form-control-user form-control select2">
                        <option value="">Select Central Region</option>
                        <?php
                          foreach ($region as $result) {
                        ?>
                          <option <?php if($regionId == $result->region_id){ echo 'selected';}?>  value="<?php echo $result->region_id;?>"><?php echo $result->name;?></option>
                        <?php
                          }
                        ?>
                      </select>
                </div>
                <div class="col col-12 mb-3">
                      <select onchange="dlChange('<?php echo base_url()?>getpinbyarea','area')" id="dl_area" name="dl_area" class="form-control select2">
                        <option value = ''>Select Area</option>
                        <?php
                          foreach ($area as $result) {
                        ?>
                          <option <?php if($areaId == $result->area_id){ echo 'selected';}?>  value="<?php echo $result->area_id;?>"><?php echo $result->area_name;?></option>
                        <?php
                          }
                        ?>

                      </select>
                </div>

                <div class="col col-12 mb-3">
                      <select id="dl_postal_code" name="dl_postal_code" name="" class="form-control select2">
                        <option value = ''>Select Postal Code</option>
                        
                        <?php
                          foreach ($zip as $result) {
                        ?>
                          <option <?php if($zipId == $result->id){ echo 'selected';}?>  value="<?php echo $result->id;?>"><?php echo $result->zip_code;?></option>
                        <?php
                          }
                        ?>


                      </select>
                </div> 
             </div>
             <div class="col col-12">
             <label class="mt-4 mb-4">Quantity: </label>
             <div class="form-group mt-2 col- col-6">                
               <div class="date">
                    <input required="" value="<?php echo $qty;?>" id="qty" name="qty"  onkeypress="return isNumberKey(event)"  type="text" class="form-control radius" placeholder="Key in Quantity">
                  </div>                
             </div>
             </div>


             <div class="col col-12">
             <label class="mt-4 mb-4">Advert Display Time(Sec): </label>
             <div class="form-group mt-2 col- col-6">                
               <div class="date">
                    <input required="" value="<?php echo $advert_display_time;?>" id="advert_display_time" name="advert_display_time"  onkeypress="return isNumberKey(event)"  type="text" class="form-control radius" placeholder="Advert Display Time">
                  </div>                
             </div>
             </div>


             <div class="col col-12">
             <label class="mt-4 mb-4">Advert Per View Cost: </label>
             <div class="form-group mt-2 col- col-6">                
               <div class="date">
                    <input required="" value="<?php echo $advertise_per_view_cost;?>" id="advertise_per_view_cost" name="advertise_per_view_cost"  onkeypress="return isNumberKey(event)"  type="text" class="form-control radius" placeholder="Advert Per View Cost">
                  </div>                
             </div>
             </div>


             <div class="col col-12">
             <input type="hidden" name="order_id" value="<?php echo $orderId ;?>"/>
             <div align="center" class="col col-12 mt-5">
               <button type="submit" class="btn btn-success waves-effect waves-light m-r-10">UPDATE ORDER</button>
             </div>
            </div>
         </div>
       </div>
     </div>
   </div>
 </div>
  </div>
</form>


 </div>
</div>
</div>
 