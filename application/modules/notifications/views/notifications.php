<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title">Notification list</h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <a href="<?php echo base_url();?>admin/notification/send"  class="btn btn-info pull-right m-l-20 btn-rounded btn-outline hidden-xs hidden-sm waves-effect waves-light">Create New</a>
       

        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><?php echo SITE_TITLE ;?></a></li>
            <li class="active">notification list</li>
        </ol>

    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->


<!-- /.row -->
<div class="row white-box">
   <div class="table-responsive">
            <table class="table table-bordered main-datatable" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                       <!--  <th>Id</th> -->
                        <th>Title</th>
                        <th>Message</th>
                        <th>Create At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <!-- <th>Id</th> -->
                        <th>Title</th>
                        <th>Message</th>
                        <th>Create At</th>
                        <th>Actions</th>
                    </tr>
                </tfoot>
            </table>
        </div> 
</div>