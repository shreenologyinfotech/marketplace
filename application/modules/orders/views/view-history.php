<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Reward Payment</h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><?php echo SITE_TITLE ;?></a></li>
            <li class="active">Reward Payment</li>
        </ol>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row 
            [0 =>'username',1=> 'email', 2=> 'contact_number', 3 =>'company_name', 4=>'order_type', 5=>'reward_earned'];
 /.row -->
  <div class="amount-show"><b>Total Paid : <?php echo $total_paid;?></b></div>

<div class="row white-box">
   
   <div class="table-responsive">
            <table class="table table-bordered main-datatable" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Viewer Name</th>
                        <th>Email</th>
                        <th>Viewer Contact</th>
                        <th>Company Name</th>
                        <th>Order Type</th>
                        <th>Reward Paid</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Viewer Name</th>
                        <th>Email</th>
                        <th>Viewer Contact</th>
                        <th>Company Name</th>
                        <th>Order Type</th>
                        <th>Reward Paid</th>
                    </tr>
                </tfoot>
            </table>
        </div> 
</div>