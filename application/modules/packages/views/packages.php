<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">User Tier Setup</h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
         <a href="<?php  echo base_url()?>pricetableadvert"  class="btn btn-info pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Price Table</a> 
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><?php echo SITE_TITLE ;?></a></li>
            <li class="active">User Tier Setup</li>
        </ol>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row 
$columns = [0 =>'level',1=> 'tier', 2=> 'per_flyer', 3 =>'status', 4=>'created', 5=>'option'];
-->


<!-- /.row -->
<div class="row white-box">
   <div class="table-responsive">
            <table class="table table-bordered main-datatable" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Level</th>
                        <th>Tier</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Level</th>
                        <th>Tier</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
            </table>
        </div> 
</div>