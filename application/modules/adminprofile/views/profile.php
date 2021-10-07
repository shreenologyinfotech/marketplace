<?php
   $title     = "Admin Detail";
   $listTitle = "Admin Profile";
   $submit    = "Update";
   
   

   if(count($data) > 0){
          $name          = $data[0]->admin_name;
          $email          = $data[0]->admin_email;
   }
?>


<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo $title;?></h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><?php echo SITE_TITLE ;?></a></li>
            <li class="active"><?php echo $listTitle;?></li>
        </ol>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<!-- /.row -->
<div class="row white-box col-sm-6 col-xs-12">
  
  <div class="col-sm-12">
    <form method="post" action="<?php echo base_url()?>admin/profile">
     
      <div class="form-group">
        <label class="control-label">Name</label>
        <input type="text" value="<?php echo $name;?>" required id="name" name="name" class="form-control" placeholder="Admin Name">
      </div>

      <div class="form-group">
        <label class="control-label">Email</label>
        <input type="email" value="<?php echo $email;?>" required id="email" name="email" class="form-control" placeholder="Email">
      </div>

      <div class="form-group">
          <button type="submit" class="btn btn-success waves-effect waves-light m-r-10"><?php echo $submit;?></button>
          <a href="<?php echo base_url()?>admin/dashboard" class="btn btn-inverse waves-effect waves-light">Cancel</a>
      </div>    


    </form>
  </div>
</div>