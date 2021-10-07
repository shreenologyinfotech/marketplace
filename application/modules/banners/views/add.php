<?php

  $title         = "Add Banner";
  $listTitle     = "Add New";
  $submit        = "Submit";

  $banner_id     = "";
  $banner_image  = base_url().IMAGE_PATH_URL."img_place.jpg";
  $banner_link   = "";
  $is_active     = "";
  $banner_page_type ='';



   if(count($data) > 0){
      $title     = "Edit Banner";
      $listTitle = "Edit Banner";
      $submit    = "Update";
      
      $banner_id      = $data[0]->banner_id;
      $banner_link    = $data[0]->banner_link;
      $is_active      = $data[0]->is_active;
      $banner_page_type = $data[0]->banner_page_type;
      
      if($data[0]->banner_image != ""){
        $banner_image   = base_url().IMAGE_PATH_URL.BANNER_FOLDER.$data[0]->banner_image;
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
    <form method="post" action="<?php echo base_url()?>admin/doaddbanner"  enctype="multipart/form-data"  >
      <?php if($banner_id != ""){ ?>  
      <input type="hidden" name="banner_id" value="<?php echo $banner_id;?>"/>
      <?php } ?>

      <div class="form-group">
        <label class="control-label">Banner Image</label>
        <image id="banner_image"  class="banner_image img-responsive" src="<?php echo $banner_image; ?>" />
        <input name="banner_image" onchange="readURL(this,'banner_image')"  id="imageUpload" class="imageUpload" type="file" name="profile_photo" placeholder="Photo" >
      </div>
        <div class="form-group">
        <label class="control-label">Banner Page</label>
        <select name="banner_page_type" class="form-control">
          <option value="Home" <?php  if($banner_page_type =='Home'){echo 'selected';} ?>>Home</option>
          <option value="NewRelatedAccount" <?php  if($banner_page_type =='NewRelatedAccount'){echo 'selected';} ?>>New Related Account</option>
          <option value="Category" <?php  if($banner_page_type =='Category'){echo 'selected';} ?>>Category</option>
          <option value="StoreLocator" <?php  if($banner_page_type =='StoreLocator'){echo 'selected';} ?>>Store Locator</option>
        </select>
    
      </div>
      <div class="form-group">
        <label class="control-label">Banner Link Url</label>
        <input type="text" value="<?php echo $banner_link;?>"  id="banner_link" name="banner_link" class="form-control" placeholder="Name">
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
          <a href="<?php echo base_url()?>admin/bannerlist" class="btn btn-inverse waves-effect waves-light">Cancel</a>
      </div>    


    </form>
  </div>
</div>