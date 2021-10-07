<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo SITE_TITLE ;?> Dashboard</h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><?php echo SITE_TITLE ;?></a></li>
            <li class="active">Dashboard</li>
        </ol>
    </div>
    <!-- /.col-lg-12 -->
</div>




<div class="row">


    <div class="col-md-3 col-sm-6">
   
            <div class="white-box">
                <div class="r-icon-stats">
                    <i class="ti-user bg-megna"></i>
                    <div class="bodystate">
                        <h4><?php echo $total_store;?></h4>
                        <span class="text-muted">Total Stores</span>
                    </div>
                </div>
            </div>
    
    </div>


    <div class="col-md-3 col-sm-6">
            <div class="white-box">
                <div class="r-icon-stats">
                    <i class="ti-wallet bg-inverse"></i>
                    <div class="bodystate">
                        <h4><?php echo $total_products;?></h4>
                        <span class="text-muted">Total Products</span>
                    </div>
                </div>
            </div>
    
    </div>
    
</div>


