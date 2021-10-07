<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Order list</h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

        <!--  <a href="<?php echo base_url();?>exportorder"  class="btn btn-info pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Export Order</a>

         <a href="<?php echo base_url();?>exportorderstatus"  class="btn btn-info pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Export Order Status</a>
 -->


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
 <form name="" method="post" action="<?php echo base_url()?>orders/ordersubmit">
   <!-- <div class="col-sm-6 row">
            <label>Search By Order Status</label>
              <select onchange="submit()" id="order-filter" name="order-filter" class="pull-right  mb-sm-4">
                  <option value="">All Orders Status</option>  
                  <option <?php if($segment == "Pending"){ echo "selected"; } ?>  value="Pending">Pending</option>
                  <option <?php if($segment == "Dispatch"){ echo "selected"; } ?>  value="Dispatch">Dispatch</option>
                  <option <?php if($segment == "Refunded"){ echo "selected"; } ?>  value="Refunded">Refunded</option>
                  <option <?php if($segment == "Shipped"){ echo "selected"; } ?>  value="Shipped">Shipped</option>
                  <option <?php if($segment == "Delivered"){ echo "selected"; } ?>  value="Delivered">Delivered</option>                
              
              </select>           


              

   </div> -->
   <div class="col-sm-12">
            <label>Search By Store</label>
            <?php  
                $allStores  = get_stores();
            ?>
              <select onchange="submit()" id="store-order-filter" name="store-order-filter" class="pull-right  mb-sm-4">
                  <option value="">All Stores</option>  
                    <?php
                        if(!empty($allStores)){
                            foreach ($allStores as $keyStore => $valueStore) {
                                // code...
                                $classSelected = '';
                              if($segment == $valueStore->store_id ){
                                $classSelected = 'selected';
                              }  
                    ?>
                        <option <?php echo $classSelected; ?>  value="<?php echo $valueStore->store_id; ?>"><?php echo $valueStore->store_name; ?></option>
                    <?php
                            }
                        }
                   ?>
              </select>           


              

   </div>
</form> 
   <div class="table-responsive">
            <table class="table table-bordered main-datatable" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Order Id</th>
                        <th>User</th>
                        <th>Store</th>                        
                        <th>Payment Mode</th>
                        <th>COD Charges</th>
                        <th>Shipping Charges</th>
                        <th>Payment Status</th>
                        <th>Total Amount</th>                        
                        <th>Order Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Order Id</th>
                        <th>User</th>
                        <th>Store</th>
                        <th>Payment Mode</th>
                        <th>COD Charges</th>
                        <th>Shipping Charges</th>
                        <th>Payment Status</th>
                        <th>Total Amount</th>                        
                        <th>Order Status</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
            </table>
        </div> 
</div>