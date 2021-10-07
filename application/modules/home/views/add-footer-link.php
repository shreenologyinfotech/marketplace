

<?php
   $title     = "Add Footer links";
   $listTitle = "Add New";
   $submit    = "Submit";
    
    $footertitle       = "";
    $pageId            = "";
    $id                = "";
   
   if(count($rec) > 0){
      $title     = "Edit Footer links";
      $listTitle = "Edit Footer links";
      $submit    = "Update";
          
      $footertitle       = $rec[0]->title;
      $pageId            = $rec[0]->page_id;
      $id                = $rec[0]->id;
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
    <form method="post" action="<?php echo base_url()?>admin/addfooterlink">
      <?php if($id != ""){ ?>  
      <input type="hidden" name="id" value="<?php echo $id;?>"/>
      <?php } ?>
      
      <div class="form-group">
        <label class="control-label">Visible link</label>
        <input type="text" value="<?php echo $footertitle;?>" required id="title" name="title" class="form-control" placeholder="Title">
      </div>

 

      
      <div class="form-group">
        <label class="control-label">page</label>
        <select required=""  id="page_id" name="page_id" class="form-control">
          <option value="">Select page</option>  
          <?php foreach ($data as $results) { ?>
             <option <?php if($pageId == $results->id){echo "selected";}?>  value="<?php echo $results->id;?>"><?php echo $results->title;?></option>
          <?php   
            }
          ?>
        </select>
      </div>


      <div class="form-group">
          <button type="submit" class="btn btn-success waves-effect waves-light m-r-10"><?php echo $submit;?></button>
          <a href="<?php echo base_url()?>admin/managefooter" class="btn btn-inverse waves-effect waves-light">Cancel</a>
      </div>    


    </form>
  </div>
</div>





