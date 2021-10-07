<?php
   $title     = "Add Setting";
   $listTitle = "Add";
   $submit    = "Submit";
    
    $meta_key          = "";
    $meta_value        = "";
    $id                = "";


   if(count($data) > 0){
      $title     = "Edit Setting";
      $listTitle = "Edit Setting";
      $submit    = "Update";
          
      $meta_key             = $data[0]->meta_key;
      $meta_value           = $data[0]->meta_value;
      $id                   = $data[0]->id;
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
    <form method="post" action="<?php echo base_url()?>sitesetting/updateSetting">
      <?php if($id != ""){ ?>  
      <input type="hidden" name="id" value="<?php echo $id;?>"/>
      <?php } ?>
     
      <div class="form-group">
        <label class="control-label">Meta Key</label>
        <input readonly="" type="text" value="<?php echo $meta_key;?>" required  name="meta_key" class="form-control" placeholder="Meta Key">
      </div>


      <div class="form-group">
        <label class="control-label">Meta Value</label>
        <input type="text" value="<?php echo $meta_value;?>" required  name="meta_value" class="form-control" placeholder="Meta Value">
      </div>


      <div class="form-group">
          <button type="submit" class="btn btn-success waves-effect waves-light m-r-10"><?php echo $submit;?></button>
          <a href="<?php echo base_url()?>sitesetting" class="btn btn-inverse waves-effect waves-light">Cancel</a>
      </div>


    </form>
  </div>
</div>