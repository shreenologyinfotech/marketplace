<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Stores list</h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <?php /*     
        <a href="<?php echo base_url();?>admin/adduser"  class="btn btn-info pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Add New</a>
        */ ?>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><?php echo SITE_TITLE ;?></a></li>
            <li class="active">Store list</li>
        </ol>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row white-box">
   <div class="table-responsive">
            <table class="table table-bordered main-datatable" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Store Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Image</th>
                        <th>User Name</th>
                        <th>Address</th>
                        <th>Visible To Home</th>
                        <th>Status</th>
                        <th>Joining Date</th>
                        <th>Vat Number</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Store Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Image</th>
                        <th>User Name</th>
                        <th>Address</th>
                        <th>Visible To Home</th>
                        <th>Status</th>
                        <th>Joining Date</th>
                        <th>Vat Number</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
            </table>
        </div> 
</div>
