<?php
   $title     = "Add Location";
   $listTitle = "Add New";
   $submit    = "Submit";
    
    $country           = "";
    $short_name        = "";
    $code              = "";
    $dialing_code      = "";
    $currency          = "";
    $currency_symbol   = "";
    $status            = "";
    $id                = "";
    $class             = "";
    if($is_view){
      $class             = "readonly";
    } 

   if(count($data) > 0){
      $title     = "Edit Location";
      $listTitle = "Edit Location";
      $submit    = "Update";
          
      $country           = $data[0]->country;
      $short_name        = $data[0]->short_name;
      $code              = $data[0]->code;
      $dialing_code      = $data[0]->dialing_code;
      $currency          = $data[0]->currency;
      $currency_symbol   = $data[0]->currency_symbol;
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
    <form method="post" action="<?php echo base_url()?>addlocation">
      <?php if($id != ""){ ?>  
      <input type="hidden" name="id" value="<?php echo $id;?>"/>
      <?php } ?>
      <div class="form-group">
        <label class="control-label">Country</label>
        <input type="text"  <?php echo $class ;?> value="<?php echo $country;?>" required id="country" name="country" class="form-control" placeholder="Country">
      </div>


      <div class="form-group">
        <label class="control-label">Short Name</label>
        <input type="text" <?php echo $class ;?> value="<?php echo $short_name;?>" required id="short_name" name="short_name" class="form-control" placeholder="Short Name">
      </div>
      
      <div class="form-group">
        <label class="control-label">Code</label>
        <input type="text" <?php echo $class ;?> value="<?php echo $code;?>" required id="code" name="code" class="form-control" placeholder="Code">
      </div>

      <div class="form-group">
        <label class="control-label">Dialing Code</label>
        <input type="text" <?php echo $class ;?> value="<?php echo $dialing_code;?>" required id="dialing_code" name="dialing_code" class="form-control" placeholder="Dialing Code">
      </div>


      <div class="form-group">
        <label class="control-label">Currency</label>
        <input type="text" <?php echo $class ;?> value="<?php echo $currency;?>" required id="currency" name="currency" class="form-control" placeholder="Currency">
      </div>


      <div class="form-group">
        <label class="control-label">Currency Symbol</label>
        <input type="text" <?php echo $class ;?> value="<?php echo $currency_symbol;?>" required id="currency_symbol" name="currency_symbol" class="form-control" placeholder="Currency Symbol">
      </div>

      
      <div class="form-group">
        <label class="control-label">Status</label>
        <select <?php echo $class ;?>   id="status" name="status" class="form-control">
          <option <?php if($status == "Active"){echo "selected";}?>  value="Active">Active</option>
          <option <?php if($status == "Inactive"){echo "selected";}?>  value="Inactive">Inactive</option>
        </select>
      </div>

      <?php if(!$is_view) {?>
      <div class="form-group">
          <button type="submit" class="btn btn-success waves-effect waves-light m-r-10"><?php echo $submit;?></button>
          <a href="<?php echo base_url()?>locations" class="btn btn-inverse waves-effect waves-light m-r-10">Cancel</a>
          <?php 
          if($id  != ""){
          if($status == "Active"){ ?>
             <a href="javascript:void(0)" onclick="performAction('<?php echo base_url()?>ajax/deactivelocation/<?php echo  $id;?>','Are you sure!','You want to deactive this location!!','location deactivate successfullly')" class="btn btn-danger waves-effect waves-light">Deactivate</a>
          <?php }else{ ?>
             <a href="javascript:void(0)" onclick="performAction('<?php echo base_url()?>ajax/activelocation/<?php echo $id;?>','Are you sure!','You want to activcate this location!!','location activate successfullly')" class="btn btn-success waves-effect waves-light">Activate</a>
          <?php } 
          }
          ?>
      </div>
    <?php } ?>

    </form>
  </div>
</div>