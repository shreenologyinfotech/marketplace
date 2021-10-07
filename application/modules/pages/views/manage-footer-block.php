<?php
   $title     = "update footer block";
   $listTitle = "update";
   $submit    = "Submit";
    
    $block_one        = "";
    $block_two        = "";
    $block_three      = "";
   

   if(count($data) > 0){
      $block_one        = $data[0]->block_one;
      $block_two        = $data[0]->block_two;
      $block_three      = $data[0]->block_three;
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
    <form method="post" action="<?php echo base_url()?>admin/manageblockfooter">
     

      <div class="form-group">
        <label class="control-label">Block one</label>
        <textarea id="editor" rows="10" required name="block_one" class="form-control" placeholder="Block One"><?php echo $block_one;?></textarea>
      </div>

      <div class="form-group">
        <label class="control-label">Block two</label>
        <textarea id="editor" rows="10" required name="block_two" class="form-control" placeholder="Block two"><?php echo $block_two;?></textarea>
      </div>

      <div class="form-group">
        <label class="control-label">Block three</label>
        <textarea id="editor" rows="10" required name="block_three" class="form-control" placeholder="Block three"><?php echo $block_three;?></textarea>
      </div>
      
     
      <div class="form-group">
          <button type="submit" class="btn btn-success waves-effect waves-light m-r-10"><?php echo $submit;?></button>
      </div>    
    </form>
  </div>
</div>