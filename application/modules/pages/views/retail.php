<?php
   $title     = "Add Page";
   $listTitle = "Add New";
   $submit    = "Submit";
   
   $description        = "";
   $status             = "";
   $id                 = "";
   $banner_image       = base_url().IMAGE_PATH_URL."img_place.jpg";


   if(count($data) > 0){
      $title     = "Edit Page Retail";
      $listTitle = "Edit Page Retail";
      $submit    = "Update";
      $description        = $data[0]->description;
      $status            = $data[0]->status;
      $id                = $data[0]->id;

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
<div class="row white-box col-sm-12 col-xs-12">
  
  <div class="col-sm-12">
    <form method="post" action="<?php echo base_url()?>pages/retail" enctype="multipart/form-data">
      <?php if($id != ""){ ?>  
      <input type="hidden" name="id" value="<?php echo $id;?>"/>
      <?php } ?>
      

      <div class="form-group">
        <label class="control-label">Banner Image</label>
        <image id="banner_image"  class="banner_image img-responsive" src="<?php echo $banner_image; ?>" />
        <input name="banner_image" onchange="readURL(this,'banner_image')"  id="imageUpload" class="imageUpload" type="file" name="profile_photo" placeholder="Photo" >
      </div>  


      <div class="form-group">
        <label class="control-label">Description</label>
        <textarea id="editor" rows="10" required name="description" class="form-control" placeholder="Description"><?php echo $description;?></textarea>
      </div>
      

      <div class="form-group">
          <button type="submit" class="btn btn-success waves-effect waves-light m-r-10"><?php echo $submit;?></button>
      </div>    
    </form>
  </div>
</div>