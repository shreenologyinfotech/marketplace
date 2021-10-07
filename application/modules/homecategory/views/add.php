<?php

  $title         = "Add Home Category";
  $listTitle     = "Add New";
  $submit        = "Submit";

  $category_id          = "";
  $brand_id          = "";
  $category_image       = base_url().IMAGE_PATH_URL."img_place.jpg";
  $is_active            = "";

  $category_name        = "";
  $is_home_category     = "";
  $is_menu_category     = "";



   if(count($data) > 0){
      $title     = "Edit Home Category";
      $listTitle = "Edit Home Category";
      $submit    = "Update";
      
      $category_id          = $data[0]->category_id;
      $brand_id             = $data[0]->brand_id;
      $is_active            = $data[0]->is_active;

      $category_name        = $data[0]->category_name;
      $is_home_category     = $data[0]->is_home_category;
      $is_menu_category     = $data[0]->is_menu_category;

      
      if($data[0]->category_image != ""){
        $category_image   = base_url().IMAGE_PATH_URL.HOME_CATEGORY_FOLDER.$data[0]->category_image;
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
    <form method="post" action="<?php echo base_url()?>admin/doaddhomecategory"  enctype="multipart/form-data"  >
      <?php if($category_id != ""){ ?>  
      <input type="hidden" name="category_id" value="<?php echo $category_id;?>"/>
      <?php } ?>

      <div class="form-group">
        <label class="control-label">Home Category Image</label>
        <image id="banner_image"  class="banner_image img-responsive" src="<?php echo $category_image; ?>" />
        <input name="category_image" onchange="readURL(this,'banner_image')"  id="imageUpload" class="imageUpload" type="file" name="profile_photo" placeholder="Photo" >
      </div>


      <div class="form-group">
        <label class="control-label">Category Name</label>
        <input type="text" value="<?php echo $category_name;?>" required id="category_name" name="category_name" class="form-control" placeholder="Category Name">
      </div>

      
      <div class="form-group">
        <label class="control-label">Brand Name</label>
        <select class="form-control" name="brand_id" id="brand_id">
          <?php
            $brands = get_brands();
            foreach ($brands as $resultObj){
          ?>
          <option <?php if($brand_id == $resultObj->brand_id){ echo "selected"; }?>  value="<?php echo $resultObj->brand_id; ?>"><?php echo $resultObj->brand_name; ?></option>
          <?php } ?>
        </select>
      </div>


      <div class="form-group">
        <label class="control-label">Display To Home</label>
        <select class="form-control" name="is_home_category" id="is_home_category">
          <option <?php if($is_home_category == "yes"){ echo "selected"; }?>  value="yes">Yes</option>
          <option <?php if($is_home_category == "no"){ echo "selected"; }?> value="no">No</option>
        </select>
      </div>


      <div class="form-group">
        <label class="control-label">Display To Menu</label>
        <select class="form-control" name="is_menu_category" id="is_menu_category">
          <option <?php if($is_menu_category == "yes"){ echo "selected"; }?>  value="yes">Yes</option>
          <option <?php if($is_menu_category == "no"){ echo "selected"; }?> value="no">No</option>
        </select>
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
          <a href="<?php echo base_url()?>admin/homecategorylist" class="btn btn-inverse waves-effect waves-light">Cancel</a>
      </div>    


    </form>
  </div>
</div>