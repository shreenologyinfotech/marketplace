<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Advertiser list</h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

        <a href="<?php echo base_url();?>exportadvertiser"  class="btn btn-info pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Export</a>

          
        <a href="<?php echo base_url();?>admin/addadvertiser"  class="btn btn-info pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Add New</a>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><?php echo SITE_TITLE ;?></a></li>
            <li class="active">advertiser list</li>
        </ol>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<form id="delete_advertiser_form" method="post" action="<?php echo base_url();?>advertisers/deleteadvertiser">

<!-- /.row -->
<div class="row white-box">
    
    <div class="col-sm-12">

      <input onclick="submitForm('#delete_advertiser_form','<?php echo ACTION_COMPLETE_DELETE_ADVERTISER_TITLE ;?>','<?php echo ACTION_COMPLETE_DELETE_ADVERTISER_HEADING ;?>')" type="button" class="btn btn-info pull-right mb-sm-3" value="Delete"/>

       <!--
       <input type="submit" class="btn btn-info pull-right mb-sm-3" value="Delete"/>
       -->
    </div>  


   <div class="table-responsive">
            <table class="table table-bordered main-datatable" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>Adv ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Company</th>
                        <th>Signup date</th>
                        <th>Partner?</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Select</th>
                        <th>User Id</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Contact</th>
                        <th>Company</th>
                        <th>Signup date</th>
                        <th>Partner?</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
            </table>
        </div> 
</div>

</form>