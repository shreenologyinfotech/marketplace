<?php
   $title     = "Add Page";
   $listTitle = "Add New";
   $submit    = "Submit";
    
    $title              = "";
    $slug               = "";
    $description        = "";
    $meta_keywords      = "";
    $meta_description   = "";
    $status             = "";
    $id                 = "";


   if(count($data) > 0){
      $title     = "Edit Page";
      $listTitle = "Edit Page";
      $submit    = "Update";
          
      $title              = $data[0]->title;
      $slug               = $data[0]->slug;
      $meta_keywords      = $data[0]->meta_keywords;
      $meta_description   = $data[0]->meta_description;
      $description        = $data[0]->description;
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
<div class="row white-box col-sm-12 col-xs-12">
  
  <div class="col-sm-12">
    <form method="post" action="<?php echo base_url()?>addpage">
      <?php if($id != ""){ ?>  
      <input type="hidden" name="id" value="<?php echo $id;?>"/>
      <?php } ?>
      <div class="form-group">
        <label class="control-label">Title</label>
        <input type="text" value="<?php echo $title;?>" required id="title" name="title" class="form-control" placeholder="Title">
      </div>


      <div class="form-group">
        <label class="control-label">Slug</label>
        <input type="text" value="<?php echo $slug;?>" required id="slug" name="slug" class="form-control" placeholder="Slug">
      </div>
     
     
      <div class="form-group">
        <label class="control-label">Meta Keywords</label>
        <input type="text" value="<?php echo $meta_keywords;?>" required id="meta_keywords" name="meta_keywords" class="form-control" placeholder="Meta Keywords">
      </div>

      <div class="form-group">
        <label class="control-label">Meta Description</label>
        <input type="text" value="<?php echo $meta_description;?>" required id="meta_description" name="meta_description" class="form-control" placeholder="Meta Description">
      </div>


      <div class="form-group">
        <label class="control-label">Description</label>
        <textarea id="editor" rows="10" required name="description" class="form-control" placeholder="Description"><?php echo $description;?></textarea>
      </div>
      
      <div class="form-group">
        <label class="control-label">Status</label>
        <select   id="status" name="status" class="form-control">
          <option <?php if($status == "Active"){echo "selected";}?>  value="Active">Active</option>
          <option <?php if($status == "Inactive"){echo "selected";}?>  value="Inactive">Inactive</option>
        </select>
      </div>


      <div class="form-group">
          <button type="submit" class="btn btn-success waves-effect waves-light m-r-10"><?php echo $submit;?></button>
          <a href="<?php echo base_url()?>pages" class="btn btn-inverse waves-effect waves-light">Cancel</a>
      </div>    


    </form>
  </div>
</div>