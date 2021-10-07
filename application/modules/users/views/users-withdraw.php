<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Users withdraw list</h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

         <a href="<?php echo base_url();?>exportwithdraw"  class="btn btn-info pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Export Withdraw</a>
         
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><?php echo SITE_TITLE ;?></a></li>
            <li class="active">Users withdraw list</li>
        </ol>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<div class="white-box">
<form method="post" action="<?php echo base_url();?>users/updatestaus">
    <div class="col-sm-12">
       <input type="hidden" name="user_id" value="<?php echo $this->uri->segment(4);?>">
       <input name="actionButton" type="submit" class="btn btn-info pull-right mb-sm-3" value="Paid"/>
       <input name="actionButton" type="submit" class="btn btn-info pull-right mb-sm-3" value="Approve"/>
    </div>  

     <div class="table-responsive">
            <table class="table table-bordered main-datatable" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Select</th>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Payment Mode</th>
                        <th>User Bank Info</th>
                        <th>Admin Remark</th>
                        <th>Account Number</th>
                        <th>Account Holder Name</th>
                        <th>Bank Name</th>
                        <th>Payment Mobile Number</th>
                        <th>Status</th>
                        <th>Created On</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Select</th>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Payment Mode</th>
                        <th>User Bank Info</th>
                        <th>Admin Remark</th>
                        <th>Account Number</th>
                        <th>Account Holder Name</th>
                        <th>Bank Name</th>
                        <th>Payment Mobile Number</th>
                        <th>Status</th>
                        <th>Created On</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
            </table>
        </div> 
 </form>       
</div>
