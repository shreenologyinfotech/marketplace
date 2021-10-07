<?php
   $title     = "Add Promo";
   $listTitle = "Add New";
   $submit    = "Submit";
    
    $promo_text    = "";
    $promo_link    = "";
    $promo_id      = "";
    $status        = "";

   if(count($data) > 0){
      $title     = "Edit Promo";
      $listTitle = "Edit Admin";
      $submit    = "Update";
      
      $promo_text    = $data[0]->promo_text;
      $promo_link    = $data[0]->promo_link;
      $promo_id      = $data[0]->promo_id;
      $status        = $data[0]->status;

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
    <form method="post" action="<?php echo base_url()?>admin/addpromo">
      <?php if($promo_id != ""){ ?>  
      <input type="hidden" name="promo_id" value="<?php echo $promo_id;?>"/>
      <?php } ?>
     
      <div class="form-group">
        <label class="control-label">Promo Text </label>
        <input type="text" value="<?php echo $promo_text;?>" required id="promo_text" name="promo_text" class="form-control" placeholder="Text">
      </div>

      <div class="form-group">
        <label class="control-label">Promo Link </label>
        <input type="text" value="<?php echo $promo_link;?>"  id="promo_link" name="promo_link" class="form-control" placeholder="Link">
      </div>

        <div class="form-group">
        <label class="control-label">Status</label>
        <select   id="status" name="status" class="form-control">
          <option <?php if($status == "active"){echo "selected";}?>  value="active">Active</option>
          <option <?php if($status == "inactive"){echo "selected";}?>  value="inactive">Inactive</option>
        </select>
      </div>


      <div class="form-group">
          <button type="submit" class="btn btn-success waves-effect waves-light m-r-10"><?php echo $submit;?></button>
          <a href="<?php echo base_url()?>admin/managepromo" class="btn btn-inverse waves-effect waves-light">Cancel</a>
      </div>    


    </form>
  </div>
</div>