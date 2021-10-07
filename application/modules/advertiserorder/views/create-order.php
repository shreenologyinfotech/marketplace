<?php

  $baseUrl                  =  base_url();
  $orderId                  = "";
  $orderPreId               = "";
  $totalCost                = site_currency_symbol()."0.00";
  $totalCostWithTransaction = site_currency_symbol()."0.00";
  $remainBalance            = site_currency_symbol()."0.00";
  $transactionFee           = site_currency_symbol()."0.00";
  $startDate      = "";
  $endDate        = "";
  $qty            = "";
  $orderType      = "";
  $referlink      = "";
  
  $arrPricing     = get_pricing();
  $date           = date_out();

  $regionId       = "";
  $areaId         = "";
  $zipId          = "";
  $zipCodes       = "";

  $onlyTotalCost  = "";
  $status         = "";
  $orderImage     = $defaultImage = $baseUrl."uploads/ad-photo.jpg";

  $imageOne       = $defaultImage;
  $imageTwo       = $defaultImage;
  $imageThree     = $defaultImage;
  $imageFour      = $defaultImage;
  $imageFive      = $defaultImage;
  $imageSix       = $defaultImage;
  $imageSeven     = $defaultImage;
  $imageEight     = $defaultImage;
  $imageNine      = $defaultImage;
  $imageTen       = $defaultImage;
  $imageCounter   = 1;

  $postal_code  = "";

  if(sizeof($order_details) > 0){
     $result    = $order_details[0];
     $orderId   = $this->uri->segment(2);
     $orderPreId   = $result->order_id;
     $totalCost = site_currency_symbol().$result->total_cost;
     $onlyTotalCost = $result->total_cost;
     $totalCostWithTransaction = site_currency_symbol().($result->total_cost+$result->transaction_fee);
     $remainBalance = site_currency_symbol().$result->remaining_balance;
     $transactionFee = site_currency_symbol().$result->transaction_fee;
     
     $startDate    = date("d-m-Y",strtotime($result->start_date));
     $endDate      = date("d-m-Y",strtotime($result->end_date));
     $qty          = $result->quantity;
     $orderType    = $result->order_type;
     $regionId    = $result->region_id;

     $areaId       = $result->area_id;
     $zipId        = $result->pincode;
     $referlink    = $result->refer_link;
     $status       = $result->status;
     $zipCodes     = get_zip_code_by_order_id($orderId);


     if($result->order_lat !=  0 && $result->order_lng != 0){
        $postal_code  = postal_form_lat_lng($result->order_lat,$result->order_lng);
     }
     

     if($result->image_path != ""){
        $orderArray   = json_decode($result->image_path,true);
        $imageCounter = count($orderArray);



        if(isset($orderArray[0])){

          $imageOne  =  $orderImage   =  get_cropped_image(450,500,'uploads/ads/'.$orderArray[0]);

          echo "<script>window.filesToUpload[0] = {'src' : '$imageOne','name'  : '$orderArray[0]','id':'$orderId','position':'0' };</script>";
        }

        if(isset($orderArray[1])){
          $imageTwo     =  get_cropped_image(450,500,'uploads/ads/'.$orderArray[1]);
          echo "<script>window.filesToUpload[1] = {'src' : '$imageTwo','name'  : '$orderArray[1]','id':'$orderId','position':'1' };</script>";
        }

        if(isset($orderArray[2])){
          $imageThree     =  get_cropped_image(450,500,'uploads/ads/'.$orderArray[2]);
          echo "<script>window.filesToUpload[2] = {'src' : '$imageThree','name'  : '$orderArray[2]','id':'$orderId','position':'2' };</script>";
        }

        if(isset($orderArray[3])){
          $imageFour     =  get_cropped_image(450,500,'uploads/ads/'.$orderArray[3]);
          echo "<script>window.filesToUpload[3] = {'src' : '$imageFour','name'  : '$orderArray[3]','id':'$orderId','position':'3' };</script>";
        }

        if(isset($orderArray[4])){
          $imageFive     =   get_cropped_image(450,500,'uploads/ads/'.$orderArray[4]);
          echo "<script>window.filesToUpload[4] = {'src' : '$imageFive','name'  : '$orderArray[4]','id':'$orderId','position':'4' };</script>";
        }

        if(isset($orderArray[5])){
          $imageSix     =   get_cropped_image(450,500,'uploads/ads/'.$orderArray[5]);
          echo "<script>window.filesToUpload[5] = {'src' : '$imageSix','name'  : '$orderArray[5]','id':'$orderId','position':'5' };</script>";
        }

        if(isset($orderArray[6])){
          $imageSeven     =  get_cropped_image(450,500,'uploads/ads/'.$orderArray[6]);
          echo "<script>window.filesToUpload[6] = {'src' : '$imageSeven','name'  : '$orderArray[6]','id':'$orderId','position':'6' };</script>";
        }

        if(isset($orderArray[7])){
          $imageEight     =  get_cropped_image(450,500,'uploads/ads/'.$orderArray[7]);
          echo "<script>window.filesToUpload[7] = {'src' : '$imageEight','name'  : '$orderArray[7]','id':'$orderId','position':'7' };</script>";
        }

        if(isset($orderArray[8])){
          $imageNine     =  get_cropped_image(450,500,'uploads/ads/'.$orderArray[8]);
          echo "<script>window.filesToUpload[8] = {'src' : '$imageNine','name'  : '$orderArray[8]','id':'$orderId','position':'8' };</script>";
        }

        if(isset($orderArray[9])){
          $imageTen     =  get_cropped_image(450,500,'uploads/ads/'.$orderArray[9]);
          echo "<script>window.filesToUpload[9] = {'src' : '$imageTen','name'  : '$orderArray[9]','id':'$orderId','position':'9' };</script>";
        }
     }
  }
?>





<form method="POST" action="<?php echo base_url()?>createorder" enctype="multipart/form-data">
<div class="bg-white">
<div class="page-title green-bg pt-3 pb-3">
  <div class="container">
   <div class="row">
    <div class="col col-8">
        <h2 class="text-uppercase text-white">
        <?php if($orderId != ""){?>
                Edit Order
           <?php }else{?>
             Create New Order
           <?php } ?></h2>
    </div>
    <div class="col col-4"></div>
   </div>
  </div>
</div>




 <div class="innerpages pt-5 pb-5">
   <div class="container">
     <div class="row">
      <input type="hidden" id="1_p_i_c" value="<?php echo $arrPricing[0]->price;?>">
      <input type="hidden" id="2_p_i_c" value="<?php echo $arrPricing[1]->price;?>">
      <input type="hidden" id="3_p_i_c" value="<?php echo $arrPricing[2]->price;?>">
      <input type="hidden" id="4_p_i_c" value="<?php echo $arrPricing[3]->price;?>">
      <input type="hidden" id="5_p_i_c" value="<?php echo $arrPricing[4]->price;?>">
      <input type="hidden" id="6_p_i_c" value="<?php echo $arrPricing[5]->price;?>">
      <input type="hidden" id="7_p_i_c" value="<?php echo $arrPricing[6]->price;?>">
      <input type="hidden" id="8_p_i_c" value="<?php echo $arrPricing[7]->price;?>">
      <input type="hidden" id="9_p_i_c" value="<?php echo $arrPricing[8]->price;?>">
      <input type="hidden" id="10_p_i_c" value="<?php echo $arrPricing[9]->price;?>">

      <?php // require_once("menus.php"); ?>

       <div class="col col-md-5 col-12">
       <div class="order-top mb-4">        
         <div class="row">
          <div class="col col-12">
            <div class="row">
              <div class="col col-sm-9 col-6">
                <select
                <?php
                  if($status == "Pending Distribution" || $status == "Pending Approval"){
                    echo "disabled";
                  }
                 ?>
                id="numberOfImages" name="numberOfImages" onchange="showImages()" required  class="form-control p-0">
                  <option value="">Select Number of Pages</option>
                  <?php for ($i=1; $i < 11 ; $i++) { ?>
                  <option <?php if($imageCounter == $i){ echo "selected"; }?>  value="<?php echo $i; ?>"><?php echo $i;?> Pages</option>
                  <?php } ?>
                </select> 
              </div>
              <div class="col col-sm-3 col-6">
                  <input type="button" class="btn btn btn-outline-secondary rounded-0" data-toggle="modal" data-target="#prview-model" value="Preview">
              </div>
            </div>
          </div>
         </div>
          </div>
             
 
        
         <div class="product-image">
            <div class="row">

                <div class="mt-2 col-sm-6 col-md-3 flag0"><a <?php if($status != "Pending Distribution") { ?> onclick="clickImage(1)" <?php } ?> href="javascript:void(0);" class="ad-photo adPhoto0"><img class="images img0" src="<?php echo $imageOne;?>" alt=""> </a><span class="image-heading">Page 1</span></div>

                <div class="mt-2 col-sm-6 col-md-3 flag1"><a <?php if($status != "Pending Distribution") { ?> onclick="clickImage(2)" <?php } ?> href="javascript:void(0);" class="ad-photo adPhoto1"><img class="images img1" src="<?php echo $imageTwo;?>" alt=""> </a><span class="image-heading">Page 2</span></div>
                
                <div class="mt-2 col-sm-6 col-md-3 flag2"><a <?php if($status != "Pending Distribution") { ?> onclick="clickImage(3)" <?php } ?> href="javascript:void(0);" class="ad-photo adPhoto2"><img class="images img2" src="<?php echo $imageThree;?>" alt=""> </a> <span class="image-heading">Page 3</span></div>
                
                <div class="mt-2 col-sm-6 col-md-3 flag3"><a <?php if($status != "Pending Distribution") { ?> onclick="clickImage(4)" <?php } ?> href="javascript:void(0);" class="ad-photo adPhoto3"><img class="images img3" src="<?php echo $imageFour;?>" alt=""> </a> <span class="image-heading">Page 4</span></div>
                
                <div class="mt-2 col-sm-6 col-md-3 flag4"><a <?php if($status != "Pending Distribution") { ?> onclick="clickImage(5)" <?php } ?> href="javascript:void(0);" class="ad-photo adPhoto4"><img class="images img4" src="<?php echo $imageFive;?>" alt=""></a> <span class="image-heading">Page 5</span></div>
                
                <div class="mt-2 col-sm-6 col-md-3 flag5"><a <?php if($status != "Pending Distribution") { ?> onclick="clickImage(6)" <?php } ?> href="javascript:void(0);" class="ad-photo adPhoto5"><img class="images img5" src="<?php echo $imageSix;?>" alt=""> </a><span class="image-heading">Page 6</span></div>
                
                <div class="mt-2 col-sm-6 col-md-3 flag6"><a <?php if($status != "Pending Distribution") { ?> onclick="clickImage(7)" <?php } ?> href="javascript:void(0);" class="ad-photo adPhoto6"><img class="images img6" src="<?php echo $imageSeven;?>" alt=""> </a><span class="image-heading">Page 7</span></div>
                
                <div class="mt-2 col-sm-6 col-md-3 flag7"><a <?php if($status != "Pending Distribution") { ?> onclick="clickImage(8)"  <?php } ?> href="javascript:void(0);" class="ad-photo adPhoto7"><img class="images img7" src="<?php echo $imageEight;?>" alt=""> </a><span class="image-heading">Page 8</span></div>
                
                <div class="mt-2 col-sm-6 col-md-3 flag8"><a <?php if($status != "Pending Distribution") { ?> onclick="clickImage(9)" <?php } ?> href="javascript:void(0);" class="ad-photo adPhoto8"><img class="images img8" src="<?php echo $imageNine;?>" alt=""></a><span class="image-heading">Page 9</span></div>
                
                <div class="mt-2 col-sm-6 col-md-3 flag9"><a <?php if($status != "Pending Distribution") { ?> onclick="clickImage(10)" <?php } ?> href="javascript:void(0);" class="ad-photo adPhoto9"><img class="images img9" src="<?php echo $imageTen;?>" alt=""></a><span class="image-heading">Page 10</span></div>


                <input type="hidden" id="fileCount" name="fileCount" class="fileCount" value="0">
                <input type="file" position="0" id="my_file1" style="display: none" class="my_file1"  name="ads_image[]" accept="image/*" multiple="multiple">
                <input type="file" position="1" id="my_file2" style="display: none" class="my_file2" name="ads_image[]" accept="image/*" multiple="multiple">
                <input type="file" position="2" id="my_file3" style="display: none" class="my_file3" name="ads_image[]" accept="image/*" multiple="multiple">
                <input type="file" position="3" id="my_file4" style="display: none" class="my_file4" name="ads_image[]" accept="image/*" multiple="multiple">
                <input type="file" position="4" id="my_file5" style="display: none" class="my_file5" name="ads_image[]" accept="image/*" multiple="multiple">
                <input type="file" position="5" id="my_file6" style="display: none" class="my_file6" name="ads_image[]" accept="image/*" multiple="multiple">
                <input type="file" position="6" id="my_file7" style="display: none" class="my_file7" name="ads_image[]" accept="image/*" multiple="multiple">
                <input type="file" position="7" id="my_file8" style="display: none" class="my_file8" name="ads_image[]" accept="image/*" multiple="multiple">
                <input type="file" position="8" id="my_file9" style="display: none" class="my_file9" name="ads_image[]" accept="image/*" multiple="multiple">
                <input type="file" position="9" id="my_file10" style="display: none" class="my_file10" name="ads_image[]" accept="image/*" multiple="multiple">
            </div>


          <?php /* <img id="add-image-file" class="img-fluid" src="<?php echo base_url().$orderImage;?>" alt=""> */?>
         </div>

    





         <div class="mt-4 text-center">
          <p class="small mb-0"><b>We recommend a minimum resolution of 760 by 760 pixels for optimal display quality</b></p>
          
          <input <?php if($status == "Pending Distribution"){echo "readonly"; }?>  value="<?php echo $referlink;?>" name="referlink" type="text" class="<?php if($status == 'Pending Distribution'){echo "disabled"; }?> text-center form-control radius" placeholder="*Reference Link"/>
          
          <p class="small mb-0">*Link for Consumers to click when viewing your CashVertisement</p>
          <p class="small mb-0">(E.g. Webpage/social media links, etc)</p>
          <!--  <button class="btn btn-outline-secondary radius w-100">Reference link</button>--> 
        </div>
       </div>
       
       <div class="col col-md-7 col-12">
       
         <div class="order-summery">
           <?php if($orderId != ""){?>
               <h3>Edit Order </h3>
               <p class="order-id d-inline-block">Order Id <?php echo get_order_id($orderId);?></p>
           <?php }else{?>
              <h3>Create New Order</h3>
           <?php } ?>


           <span class="border-top d-block">&nbsp;</span>
        
             <div class="row">
               <div class="col col-6">
               <div class="form-group">
                 <label>Select Start Date</label>
                 <div class="date">
                      <input autocomplete="off" <?php if($status == "Pending Distribution"){echo "readonly"; } ?>  required name="startDate" id="startDate" type="text" class="<?php if($status != "Pending Distribution"){echo "datepickerstart"; } ?> form-control radius <?php if($status == 'Pending Distribution'){echo "disabled"; }?> " placeholder="Select Date" value="<?php echo $startDate;?>"><span class="input-group-addon">
                      <i class="far fa-calendar-alt"></i></span>
                 </div>                
               </div>
               </div>



               <div class="col col-6">
               <div class="form-group">
                 <label>Select End Date</label>
                     <div class="date">
                      <input  <?php if($status == "Pending Distribution"){echo "readonly"; } ?>  autocomplete="off" required name="endDate" id="endDate" type="text" class="<?php if($status != "Pending Distribution"){echo "datepickerend"; } ?> form-control radius  <?php if($status == 'Pending Distribution'){echo "disabled"; }?> " placeholder="Select Date" value="<?php echo $endDate;?>"><span class="input-group-addon">
                      <i class="far fa-calendar-alt"></i></span>
                    </div>                 
               </div>
               </div>


           <div class="col col-12">
            <h6 class="mt-4 mb-4">Select Area</h6>
            
            <div class="custom-control col-12 mb-3 custom-radio">             
              <input value="Whole Country" <?php if($orderType == "" || $orderType =="Whole Country"){ ?> checked="true" <?php } ?> onclick="clickRadio()" type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadio1">Whole Singapore</label>
            </div>
            
            

            <div class="form-row mb-3">
              <div class="col col-5">
                <div class="custom-control custom-radio">
              <input <?php if($orderType == "Specific Postal Code"){ ?> checked="true" <?php } ?> value="Specific Postal Code" onclick="clickPostalSector()" type="radio"  id="customRadio2" name="customRadio"  class="custom-control-input">

              <label class="custom-control-label" for="customRadio2">By Postal Sector</label>
            </div>
              </div>
              <!-- <div class="col col-4"> <span class="green-bg d-block text-white text-center rounded">Select sector(s)</span> </div> -->
              <div class="col col-7">
                <textarea onfocus="this.blur();"  id="by_postal_selector" name="by_postal_selector" type="text"  class="readonly form-control text-center border-right-0 border-left-0 border-top-0 border-dark border-bottom rounded-0 p-0" placeholder=""><?php if($orderType == "Specific Postal Code"){ echo $zipCodes; } ?></textarea>
              </div>
            </div>
             
            <div class="form-row">
              <div class="col col-9">
                <div class="custom-control custom-radio">
               <input <?php if($orderType == "Specific Radius"){ ?> checked="true" <?php } ?> value="Specific Radius" onclick="onclickCustomRadius3()" type="radio"  id="customRadio3" name="customRadio" class="custom-control-input">
              <label class="custom-control-label" for="customRadio3">Within 500m Radius of Postal Code:</label> 
            </div>
              </div>
              
              <div class="col col-3">
                <input value="<?php if($orderType == "Specific Radius"){ echo $postal_code; } ?>" type="text" id="txt_key_postal" name="txt_key_postal" class="form-control text-center border-right-0 border-left-0 border-top-0 border-dark border-bottom rounded-0 p-0" placeholder="Key in postal code">
              </div>
            </div>
            </div>

             <div class="col col-12">
               <div class="row">
                 <div class="col col-md-6 col-12">
                 <h6 class="mt-4 mb-4">Quantity:</h6>
                 <div class="form-group mt-2 pl-0">                
               <div class="date">
                    <input <?php if($status == "Pending Distribution" || $status == "Pending Approval"){echo "readonly"; }?>  required="" autocomplete="off" value="<?php echo $qty;?>" id="qty-value" name="qty"  type="text" class="form-control radius  <?php if($status == 'Pending Distribution' || $status == 'Pending Approval'){echo 'disabled'; }?>" placeholder="Key in Quantity">
                  </div>                
             </div>
                 </div>
                 <div class="col col-md-6 col-12">
                 <h6 class="mt-4 mb-4">Total Cost :</h6>
                 <div class="form-row">                
                 <div class="date d-inline">
                      <input readonly="" value="<?php echo $onlyTotalCost;?>" id="total-value" type="text" class="form-control radius" placeholder="">
                 </div>
                    <span class="small mb-0">*Inclusive of <?php echo site_currency_symbol().transaction_fee()?> transaction fee 
                    <span id="costValue"></span></span>             
               </div>
                 </div>
               </div>
             </div>            


               <span style="display: none" class="col col-6 text-danger">*Advertise per view cost <?php echo site_currency_symbol(); ?><span id="advertise-perview-cost"><?php echo advertise_perview_cost();?></span></span>
               <input type="hidden" id="transaction_fee" value="<?php echo transaction_fee();?>"/>
               <input type="hidden" id="currency_symbol" value="<?php echo site_currency_symbol();?>"/>
               

               <div class="col col-12">
                   <h6 class="mt-4 mb-4"><a href="javascript:void()" data-toggle="modal" data-target="#price-table-model">Price Table</a></h6>
               </div>             
            <!--   <input data-toggle="modal" data-target="#price-table-model" type="button" class="btn radius green-bg pl-4 pr-4 text-white d-inline-block" name="" value="Price table" /> -->
 

             <input type="hidden" name="order_id" value="<?php echo $orderId ;?>"/>
             <input type="hidden" id="zip_codes" name="zip_codes" value="<?php echo $zipCodes ;?>"/>
             <input type="hidden" id="order_status" name="order_status" value="<?php echo $status ;?>"/>
             
             <div align="center" class="col col-12 mt-3">
              <?php if ($orderId != ""){?>
                <input onclick="return isvalidImage()"  type="submit" class="btn radius green-bg pl-4 pr-4 text-white d-inline-block" name="" value="UPDATE ORDER" />
              <?php }else{ ?>
              <input  onclick="return isvalidImage()"  type="submit" class="btn radius green-bg pl-4 pr-4 text-white d-inline-block" name="" value="CONFIRM ORDER" />
              <?php }?>

              <a href="<?php echo base_url()?>trackyourorders" class="btn radius green-bg pl-4 pr-4 text-white d-inline-block">BACK</a>
              
             </div>
            </div>
         </div>
       </div>
     </div>
   </div>
 </div>
  </div>

<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Please select your preferred postal sector(s)</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">

      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="Central-tab" data-toggle="tab" href="#Central" role="tab" aria-controls="Central" aria-selected="true">Central</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="East-tab" data-toggle="tab" href="#East" role="tab" aria-controls="East" aria-selected="false">East</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="North-tab" data-toggle="tab" href="#North" role="tab" aria-controls="North" aria-selected="false">North</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="West-tab" data-toggle="tab" href="#West" role="tab" aria-controls="contact" aria-selected="false">West</a>
        </li>
      </ul>
      
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="Central" role="tabpanel" aria-labelledby="Central-tab">

            <div style="margin:10px;" class="check-block check-boxes">
             <?php  
              for ($i=0; $i < count($Central); $i++) {
                  $zipname = $Central[$i]->zip_code;
                  $value   = $Central[$i]->zip_code;;
                  $address   = $Central[$i]->address;;
                  echo  '<label class="checkbox-inline">
                                  <input name="checkZipRadius[]" style="margin:10px;" type="checkbox" value="'.$value.'">'.$zipname.' ('.$address.')
                              </label>';
              } ?>
            </div>

          
        </div>
        <div class="tab-pane fade" id="East" role="tabpanel" aria-labelledby="East-tab">

           <div style="margin:10px;" class="check-block check-boxes">
             <?php  
              for ($i=0; $i < count($East); $i++) {
                  $zipname = $East[$i]->zip_code;
                  $value   = $East[$i]->zip_code;
                  $address   = $East[$i]->address;
                  echo  '<label class="checkbox-inline">
                                  <input name="checkZipRadius[]" style="margin:10px;" type="checkbox" value="'.$value.'">'.$zipname.' ('.$address.')
                              </label>';
              } ?>
            </div>
          
        </div>
        <div class="tab-pane fade" id="North" role="tabpanel" aria-labelledby="North-tab">

          <div style="margin:10px;" class="check-block check-boxes">
             <?php  
              for ($i=0; $i < count($North); $i++) {
                  $zipname = $North[$i]->zip_code;
                  $value   = $North[$i]->zip_code;
                  $address   = $North[$i]->address;
                  echo  '<label class="checkbox-inline">
                                  <input name="checkZipRadius[]" style="margin:10px;" type="checkbox" value="'.$value.'">'.$zipname.' ('.$address.')
                              </label>';
              } ?>
            </div>
          
        </div>
        <div class="tab-pane fade" id="West" role="tabpanel" aria-labelledby="West-tab">

           <div style="margin:10px;" class="check-block check-boxes">
             <?php  
              for ($i=0; $i < count($West); $i++) {
                  $zipname = $West[$i]->zip_code;
                  $value   = $West[$i]->zip_code;
                  $address   = $West[$i]->address;
                  echo  '<label class="checkbox-inline">
                                  <input name="checkZipRadius[]" style="margin:10px;" type="checkbox" value="'.$value.'">'.$zipname.' ('.$address.')
                              </label>';
              } ?>
            </div>
          
        </div>
      </div>    



      
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
         <button type="button" onclick="clearAll()" class="btn radius green-bg text-white ">Clear All</button>
          
        <button type="button" onclick="doneRadius()" class="btn radius green-bg text-white " data-dismiss="modal">Done</button>
      </div>
    </div>
  </div>
</div>



<div class="modal cashvertise-modal" id="prview-model">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" style="overflow:inherit">
          <img id="add-image-preview-file" class="img-fluid height-force-100" src="<?php echo $orderImage;?>" alt="" position="0" >
          <a class="carousel-control-prev" onclick="previousImageSlide()" style="left:-55px; cursor:pointer"><span class="carousel-control-prev-icon" aria-hidden="true" style="height:50px; width:50px"></span></a>
          <a class="carousel-control-next" onclick="nextImageSlide()" style="right:-55px; cursor:pointer"><span class="carousel-control-next-icon" aria-hidden="true" style="height:50px; width:50px"></span></a>
         
      </div>
    </div>
  </div>
</div>

<div class="modal" id="price-table-model">
  <div class="modal-dialog">
    <div class="modal-content">
    
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
          <table class="table table-bordered ">
            <tr class="thead-green">
              <td>No. of Images</td>
              <td>Cost Per View</br>(Non-Partner)</td>
              <td>Cost Per View</br>(Partner)</td>
            </tr>
            <?php foreach ($price_table as $result) { ?>
              <tr>
                <td><?php echo $result->pricetable_image;?></td>
                <td><?php echo show_two_decimal_number($result->pricetable_cpv_normal_advertiser);?></td>
                <td><?php echo show_two_decimal_number($result->pricetable_cpv_partner_advertiser);?></td>
              </tr>
            <?php } ?>
          </table>
      </div>
   
    </div>
  </div>
</div>
</form>


