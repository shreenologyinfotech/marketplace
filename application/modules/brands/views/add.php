<?php

  $title             = "Add Brands";
  $listTitle         = "Add New";
  $submit            = "Submit";

  $brand_id          = "";
  $brand_image       = base_url().IMAGE_PATH_URL."img_place.jpg";
  $is_active         = "";
  $brand_name        = "";

   if(count($data) > 0){
      $title     = "Edit Brands";
      $listTitle = "Edit Brands";
      $submit    = "Update";
      
      $brand_id          = $data[0]->brand_id;
      $is_active         = $data[0]->is_active;
      $brand_name        = $data[0]->brand_name;
      
      if($data[0]->brand_image != ""){
        $brand_image   = base_url().IMAGE_PATH_URL.HOME_CATEGORY_FOLDER.$data[0]->brand_image;
      }
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
    <form onsubmit="return validate();" method="post" action="<?php echo base_url()?>admin/doaddbrands"  enctype="multipart/form-data"  >
      <?php if($brand_id != ""){ ?>  
      <input type="hidden" name="brand_id" value="<?php echo $brand_id;?>"/>
      <?php } ?>

      <div class="form-group">
        <label class="control-label">Brand Image</label>
        <image id="banner_image"  class="banner_image img-responsive" src="<?php echo $brand_image; ?>" />
        <input name="brand_image" onchange="readURL(this,'banner_image')"  id="imageUpload" class="imageUpload" type="file" name="profile_photo" placeholder="Photo" >
      </div>


      <div class="form-group">
        <label class="control-label">Brand Name</label>
        <input type="text" value="<?php echo $brand_name;?>" required id="brand_name" name="brand_name" class="form-control" placeholder="Brand Name">
      </div>

    
      <div class="form-group">
        <label class="control-label">Status</label>
        <select class="form-control" name="is_active" id="is_active">
          <option <?php if($is_active == "Active"){ echo "selected"; }?>  value="Active">Active</option>
          <option <?php if($is_active == "Inactive"){ echo "selected"; }?> value="Inactive">Inactive</option>
        </select>
      </div>

      <div class="form-group">
          <button type="submit" class="btn btn-success waves-effect waves-light m-r-10"><?php echo $submit;?></button>
          <a href="<?php echo base_url()?>admin/brandslist" class="btn btn-inverse waves-effect waves-light">Cancel</a>
      </div>    


    </form>
  </div>
</div>

