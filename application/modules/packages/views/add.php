<?php
   $title     = "Add User Tier";
   $listTitle = "Add New";
   $submit    = "Submit";
    
    $level             = "";
    $tier              = "";
    $per_flyer         = "";
    $status            = "";
    $id                = "";


   if(count($data) > 0){
      $title     = "Edit User Tier";
      $listTitle = "Edit User Tier";
      $submit    = "Update";
          
      $level             = $data[0]->level;
      $tier              = $data[0]->tier;
      $per_flyer         = $data[0]->per_flyer;
      $status            = $data[0]->status;
      $id                = $data[0]->id;
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
    <form method="post" action="<?php echo base_url()?>addpackage">
      <?php if($id != ""){ ?>  
      <input type="hidden" name="id" value="<?php echo $id;?>"/>
      <?php } ?>
      <div class="form-group">
        <label class="control-label">Level Name</label>
        <input type="text" value="<?php echo $level;?>" required id="level" name="level" class="form-control" placeholder="Level">
      </div>
    
    <?php /*
      <div class="form-group">
        <label class="control-label">Tier</label>
        <input type="text" value="<?php echo $tier;?>" required id="tier" name="tier" class="form-control" placeholder="Tier">
      </div>
   

      <div class="form-group">
        <label class="control-label">Per Flyer</label>
        <input type="text" value="<?php echo $per_flyer;?>" required id="per_flyer" name="per_flyer" class="form-control" placeholder="Per Flyer">
      </div>

 

      <div class="form-group">
        <label class="control-label">Status</label>
        <select   id="status" name="status" class="form-control">
          <option <?php if($status == "Active"){echo "selected";}?>  value="Active">Active</option>
          <option <?php if($status == "Inactive"){echo "selected";}?>  value="Inactive">Inactive</option>
        </select>
      </div>
      */ ?>


      <div class="form-group">
          <button type="submit" class="btn btn-success waves-effect waves-light m-r-10"><?php echo $submit;?></button>
          <a href="<?php echo base_url()?>packages" class="btn btn-inverse waves-effect waves-light">Cancel</a>
      </div>    


    </form>
  </div>
</div>