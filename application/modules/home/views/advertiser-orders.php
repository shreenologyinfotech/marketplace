<?php
 $adveritserDetails =  get_login_adveritser_details_array(); 
  $fname          = "";
  $lname          = "";
  $email          = "";
  $contact_number = "";
  $company_name   = "";
  $date           = date_out();
 
 if(count($adveritserDetails) > 0){
    $fname          = $adveritserDetails[0]->fname;
    $lname          = $adveritserDetails[0]->lname;
    $email          = $adveritserDetails[0]->email;
    $contact_number = $adveritserDetails[0]->contact_number;
    $company_name   = $adveritserDetails[0]->company_name;
 }
?>


<div class="bg-white">
<div class="page-title green-bg pt-3 pb-3">
  <div class="container">
   <div class="row">
    <div class="col col-8">
        <h2 class="text-uppercase text-white">Track Your Orders</h2>
    </div>
    <div class="col col-4">
      <a  class="logoutbutton" href="<?php echo base_url()?>logout">Log out</a>
    </div>
   </div>
  </div>
</div>
 
 <div class="innerpages pt-5 pb-5">
   <div class="container">
     <div class="row">
       <?php
        require_once("menus.php");
       ?>
       <div class="col col-md-9 col-12">
         <div class="order-filter" style="margin-bottom: 20px;">
           <p class="d-inline h6">All  Orders</p>
           <div class="float-right">
             <form class="form-inline" method="post" action="<?php echo base_url()?>trackyourorders">
              <div class="form-group">
                <label class="mr-2 d-none d-sm-none d-md-block" for="filter">Filter By:</label>
                <select onchange="submit();" name="filter" class="form-control p-0">
                 <option <?php if($filter == "All"){ echo 'selected'; }?> value="All">All Orders</option>
                 <option <?php if($filter == "Pending Payment"){ echo 'selected'; }?> value="Pending Payment">Pending Payment</option>
                 <option <?php if($filter == "Pending Approval"){ echo 'selected'; }?> value="Pending Approval">Pending Approval</option>
                 <option <?php if($filter == "Pending Distribution"){ echo 'selected'; }?> value="Pending Distribution">Pending Distribution</option>
                 <option <?php if($filter == "In Progress"){ echo 'selected'; }?> value="In Progress">In Progress</option>
                 <option <?php if($filter == "Completed"){ echo 'selected'; }?> value="Completed">Completed</option>
                  <?php /*
                 <option <?php if($filter == "Cancelled Request"){ echo 'selected'; }?> value="Cancelled Request">Cancelled Request</option>
                 */ ?>
                 <option <?php if($filter == "Cancelled Order"){ echo 'selected'; }?> value="Cancelled Order">Cancelled Order</option>
                 <option <?php if($filter == "Refund Requested"){ echo 'selected'; }?> value="Refund Requested">Refund Requested</option>
                 <option <?php if($filter == "Refunded"){ echo 'selected'; }?> value="Refunded">Refund Completed</option>
                 <option <?php if($filter == "Deleted"){ echo 'selected'; }?> value="Deleted">Deleted</option>
                </select>
              </div>
            </form>
           </div>
         </div>
        
       <table class="main-datatable" id="dataTable" width="100%" cellspacing="0">  
        <thead style="display: none;">
            <tr>
                <th>Order Id</th>
            </tr>
        </thead>              
        <?php foreach ($order_data as $result) { ?>
        <tr>
          <td>
            



         
         <div class="order-box shadow-sm bg-white">
           <div class="order-detail-in p-3">
             <div class="row">
               <div class="col col-md-2 col-6 mb-3">

                 <?php  $orderImage   = "add-image.jpg";
                  if($result->image_path != ""){
                      $orderArray =  json_decode($result->image_path,true);
                      if($orderArray[0] != ""){
                        $orderImage   = 'thumb/'.$orderArray[0];
                      }
                  }?>

                 <div class="order-picture card-img-top d-flex align-items-center justify-content-center">
                     <img src="<?php echo get_cropped_image(80,120,'uploads/ads/'.$orderImage); ?>" class="mx-auto d-block ad-image" />
                 </div>
                

               </div>
               <div class="col col-md-5 col-6 mb-3">
                 <div class="order-text">
                    <p>Order Id: <?php echo get_order_id($result->id);?></p>
                 </div>
               </div>
               <div class="col col-md-2 col-12">
                 <div class="order-price">
                  <p class="h6"><?php //echo site_currency_symbol().$result->total_cost;?></p>
                 </div>
               </div>

               <div class="col col-md-3 col-12">
                 <div class="order-status">
                  <p>Ordered On <?php echo date($date,strtotime($result->created));?></p>
                  <?php 
                   $class  = "greentxt"; 
                  if($result->status == "Cancelled Request" ||  $result->status == "Cancelled Order" || $result->status == "Deleted"){ 
                      $class  = "text-danger";
                    }else if( $result->status ==  "Pending Payment" ||  $result->status ==  "Pending Approval" ||  $result->status ==  "Pending Distribution" ||  $result->status == "Refund Requested"){
                        $class = " orange-text text-right";
                    }else { 
                        $class = "greentxt";
                    } ?>

                   <p class="<?php echo $class;?>"><?php 
                   $orderStatus = $result->status; 
                   if(strtolower($orderStatus) == "refunded"){
                      $orderStatus = "Refund Completed";
                   }
                   echo $orderStatus; ?></p>  
                 </div>
               </div>
             </div>
           </div>
           
           <span style="line-height:0;" class="border-top d-block m-0">&nbsp;</span>
           <div class="order-bottom-detail p-3">
           <?php 
                $showEdit = false;
                $showMakePayment = false;
                $showDelete = false;
                $showCancel = false;
                $showrefund = false;
                $showView  = true;
           ?> 

           <form method="post" action="<?php echo base_url()?>makeorderpayment">
                  
             <div class="row">
               <div class="col col-md-9 col-12">
              
                 <?php 
                 
                 if($result->status == "Pending Payment"){ 
                      $showEdit         = true;
                      $showMakePayment  = true;
                      $showDelete       = true;
                 } else if($result->status == "Pending Distribution"){ 
                      $showEdit     = true;
                 } else if($result->status == "Pending Approval"){ 
                      $showEdit   = true;
                 } else if($result->status == "In Progress"){ 
                      $showCancel = true;
                 } else if($result->status == "Completed"){ 
                      $showrefund = true;
                 } else if($result->status == "Cancelled Order"){ 
                      $showrefund = true;
                 } /*else if($result->status == "Refunded" || $result->status == "Refund Requested"){ 
                      $showView  = true;
                 }else if($result->status == "Deleted"){
                      $showView  = true;
                 } */
                 
				 ?>  
                

                 <?php if($showEdit){ ?>
                     <a class="bg-white btn text-secondary border mr-2" href="<?php echo base_url()?>editorder/<?php echo $result->id;?>"><i class="fas fa-pencil-alt mr-2"></i> Edit Order</a>
                  <?php } ?> 
                  <?php if($showMakePayment){ ?>
                   <input type="hidden" name="orderId" value="<?php echo $result->id;?>">  
                   <input type="submit" style="font-size: 14px !important" class="bg-white btn text-secondary border mr-2" value="Make Payment">   
                  <?php } ?> 
                  <?php if($showDelete){ ?>
                     <a class="bg-white btn text-secondary border mr-2" href="javascript:void(0)" onclick="deleteRecord('<?php echo base_url()?>deleteorder/<?php echo $result->id;?>','<?php echo ARE_YOU_SURE;?>','<?php echo ORDER_DELETE_ADVERTISER_CONFIRM_MSG;?>','<?php echo ORDER_DELETE_ADVERTISER_SUCCESS_MSG;?>','<?php echo ORDER_DELETE_ADVERTISER_SUCCESS_HEADING;?>')" ><i class="fas fa-times mr-2"></i> Delete Order</a>
                  <?php } ?>  

                  <?php if($showCancel){ ?>
                     <button  onclick="clickCancel('<?php echo $result->id;?>')" type="button" class="cancelModel bg-white btn text-secondary border mr-2" data-toggle="modal" data-target="#myModal"><i class="fas fa-times mr-2"></i>Cancel Order</button>
                  <?php } ?>  
                  <?php if($showrefund && $result->remaining_balance > 0){ 

                      
                      $isRedundInitiate = $this->db->query("select * from tbl_advertiser_orders_refund where order_id = '".$result->id."'")->result();
                      if(sizeof($isRedundInitiate) > 0){ ?>
                        <a class="bg-white text-secondary btn border" href="javascript:void(0)" onclick="alreadyRefundDialogShow()" >Refund Credit</a> 

                    <?php  }else{  
                    ?>
                     <a class="bg-white text-secondary btn border" href="javascript:void(0)" onclick="deleteRecord('<?php echo base_url()?>refundrequestbyorderid/<?php echo $result->id;?>','<?php echo ARE_YOU_SURE;?>','<?php echo ORDER_REFUND_ADVERTISER_CONFIRM_MSG;?>','<?php echo ORDER_REFUND_ADVERTISER_SUCCESS_MSG;?>')" >Refund Credit</a> 

                  <?php 
                        } 
                    } 
                  ?>  
                  <?php if($showView){ ?>

                     <a class="bg-white btn text-secondary border mr-2" href="<?php echo base_url()?>vieworder/<?php echo $result->id;?>">View Order</a>

                  <?php } ?>  
               </div> 


          

               <div class="col col-md-3 col-12 text-right">
                <p class="h6 greentxt">Order Total :   <?php echo site_currency_symbol().$result->total_cost;?></p>
                <?php if($result->status != "Pending Payment"){ ?>
                  <p class="h6 bluetxt">Remaining Balance :   <?php echo site_currency_symbol().$result->remaining_balance;?></p> 
                <?php }?>
               </div>

             </div>
     </form>
    
           </div>
         </div>
           </td>
        </tr>
        
         
      <?php } ?>
       
</table>
         
        
         
       
         
       </div>
     </div>
   </div>
 </div>
<!-- Footer -->    
 
       <div class="col col-9">
         <div class="row">
            <div class="table-responsive">

           <?php         
            /*<table class="table table-bordered main-datatable" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Order Id</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Order Type</th>
                        <th>Total Cost</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Order Id</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Order Type</th>
                        <th>Total Cost</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
            </table>
            */?>
        </div> 
           
         </div>
       </div>
     </div>
   </div>
 </div>
</div>    

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Please provide reason</h4>
      </div>
      <div class="modal-body">
        <p class="text-danger" id="errorReason"></p>  
        <input  type="hidden" name="orderId" id="orderId" value=""/>
        <textarea required="" class="form-control" name="reason" id="reason" rows="5"></textarea>
      </div>
      <div class="modal-footer">
        <button id="btn-cancel" type="button" onclick="cancellOrder('<?php echo base_url()?>cancellorder','self','btn-cancel')" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
