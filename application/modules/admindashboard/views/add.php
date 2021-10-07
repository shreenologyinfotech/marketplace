<?php
   $title     = "Add Admin";
   $listTitle = "Add New";
   $submit    = "Submit";
    
    $admin_name        = "";
    $admin_email       = "";
    $id                = "";
    $admin_roles       = array();

   if(count($data) > 0){
      $title     = "Edit Admin";
      $listTitle = "Edit Admin";
      $submit    = "Update";
      
      $admin_name        = $data[0]->admin_name;
      $admin_email       = $data[0]->admin_email;
      $id                = $data[0]->admin_id;
      $admin_roles       = json_decode($data[0]->roles,true);

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
    <form method="post" action="<?php echo base_url()?>admin/addadmin">
      <?php if($id != ""){ ?>  
      <input type="hidden" name="id" value="<?php echo $id;?>"/>
      <?php } ?>
     
      <div class="form-group">
        <label class="control-label">Admin Name</label>
        <input type="text" value="<?php echo $admin_name;?>" required id="admin_name" name="admin_name" class="form-control" placeholder="Name">
      </div>

      <div class="form-group">
        <label class="control-label">Admin Email</label>
        <input type="text" value="<?php echo $admin_email;?>" required id="admin_email" name="admin_email" class="form-control" placeholder="Email">
      </div>

      <?php if($id == ""){ ?>  
     
      <div class="form-group">
        <label class="control-label">Admin Password</label>
        <input type="password"  required id="admin_password" name="admin_password" class="form-control" placeholder="Password">
      </div>
      <?php }?>

      <div class="form-group">
        <label class="control-label">Roles</label>
        </br>
        <?php foreach ($roles as $result) {  ?>
           <label>
                  <input <?php if(in_array($result->role_name,$admin_roles)){ echo "checked";} ?>  name="roles[]" type="checkbox" value="<?php echo $result->role_name ?>">&nbsp;&nbsp;&nbsp;<?php echo $result->role_name; ?></br>
           </label>
        <?php } ?> 
      </div>

      <div class="form-group">
          <button type="submit" class="btn btn-success waves-effect waves-light m-r-10"><?php echo $submit;?></button>
          <a href="<?php echo base_url()?>admin/manageadmin" class="btn btn-inverse waves-effect waves-light">Cancel</a>
      </div>    


    </form>
  </div>
</div>