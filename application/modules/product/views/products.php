
<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Product list</h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
    <!--    <a href="<?php  // echo base_url()?>addpage"  class="btn btn-info pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Add New Product</a>
    -->
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><?php echo SITE_TITLE ;?></a></li>
            <li class="active">Products list</li>
        </ol>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<!-- /.row -->
<div class="row white-box">
 
   <div class="col-sm-3">
        <form id="form-store" method="post" action="<?php echo base_url()?>product/productlist">
            <label>Search By Store</label>
            <?php  
                $allStores  = get_stores();
            ?>
              <select onchange="submitAction()" id="store-order-filter" name="store-order-filter" class="pull-right  mb-sm-4">
                  <option value="">All Stores</option>  
                    <?php
                        if(!empty($allStores)){
                            foreach ($allStores as $keyStore => $valueStore) {
                                // code...
                                $classSelected = '';
                              if($storesegment == $valueStore->store_id ){
                                $classSelected = 'selected';
                              }  
                    ?>
                        <option <?php echo $classSelected; ?>  value="<?php echo $valueStore->store_id; ?>"><?php echo $valueStore->store_name; ?></option>
                    <?php
                            }
                        }
                   ?>
              </select>           
        </form> 

   </div>
</div>
<!-- /.row -->
<div class="row white-box">
   <div class="table-responsive">
            <table class="table table-bordered main-datatable" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Store Name</th>
                        <th>SKU</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Shipping</th>
                        <th>Last Edited</th>
                        <th>Visible To Home</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Store Name</th>
                        <th>SKU</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Shipping</th>
                        <th>Last Edited</th>
                        <th>Visible To Home</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
            </table>
        </div> 
</div>
<script type="text/javascript">
    function submitAction(){
        var CurVal  = $('#store-order-filter').val();
        $('#form-store').attr('action','<?php echo base_url()?>product/productlist/'+CurVal);        
        $('#form-store').submit();
    }
</script>