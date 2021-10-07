<?php

  // `sub_category_id`, `sub_category_name`, `category_id`, `is_active`, `created_at`, `modified_at`

  $categoryArray = get_all_active_category();
  $title         = "Add Sub Category";
  $listTitle     = "Add New";
  $submit        = "Submit";
    
  $sub_category_id     = "";
  $category_id         = "";
  $sub_category_name   = "";
  $is_active           = "";

   if(count($data) > 0){
      $title     = "Edit Sub Category";
      $listTitle = "Edit Sub Category";
      $submit    = "Update";
      
      $category_id        = $data[0]->category_id;
      $sub_category_id    = $data[0]->sub_category_id;
      $sub_category_name  = $data[0]->sub_category_name;
      $is_active          = $data[0]->is_active;


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
    <form method="post" action="<?php echo base_url()?>admin/doaddsubcategory">
      <?php if($sub_category_id != ""){ ?>  
      <input type="hidden" name="sub_category_id" value="<?php echo $sub_category_id;?>"/>
      <?php } ?>


      <div class="form-group">
        <label class="control-label">Category Name</label>
        <select class="form-control" name="category_id" id="category_id" required="">
          <option value="">Select Category</option> 
          <?php foreach ($categoryArray as $category) { ?>
             <option <?php if($category_id == $category->category_id){ echo "selected";  } ?> value="<?php echo $category->category_id; ?>"><?php echo $category->category_name; ?></option> 
          <?php } ?>
        </select>
      </div>

     
      <div class="form-group">
        <label class="control-label">Sub Category Name</label>
        <input type="text" value="<?php echo $sub_category_name;?>" required id="sub_category_name" name="sub_category_name" class="form-control" placeholder="Name">
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
          <a href="<?php echo base_url()?>admin/subcategorylist" class="btn btn-inverse waves-effect waves-light">Cancel</a>
      </div>    


    </form>
  </div>
</div>