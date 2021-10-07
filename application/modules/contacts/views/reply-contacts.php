<?php
   $title     = "Reply contact form";
   $listTitle = "Reply contact";
   $submit    = "Submit";

   $id = "";
   $email = "";
   $message = "";
   
   if(sizeof($data) > 0){
       $id         =  $data[0]->id;
       $email      = $data[0]->email;
       $message    = $data[0]->msg;

   }

?>


<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo $title;?></h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/contacts"><?php echo SITE_TITLE ;?></a></li>
            <li class="active"><?php echo $listTitle;?></li>
        </ol>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<!-- /.row -->
<div class="row white-box col-sm-6 col-xs-12">
  
  <div class="col-sm-12">
    <form method="post" action="<?php echo base_url()?>admin/contact/doreply">
      <?php if($id != ""){ ?>  
      <input type="hidden" name="id" value="<?php echo $id;?>"/>
      <?php } ?>
     

      <div class="form-group">
        <label class="control-label">Email</label>
        <input readonly type="email" value="<?php echo $email;?>"  id="email" name="email" class="form-control" placeholder="Email">
      </div>

 

      <div class="form-group">
        <label class="control-label">User Message</label>
        <textarea readonly="" rows="10" class="form-control" required placeholder="Message"><?php echo $message;?></textarea>
      </div>





      <div class="form-group">
        <label class="control-label">Message</label>
        <textarea id="message" name="message" rows="10" class="form-control" required placeholder="Message"></textarea>
      </div>


      

      <div class="form-group">
          <button type="submit" class="btn btn-success waves-effect waves-light m-r-10"><?php echo $submit;?></button>
          <a href="<?php echo base_url()?>admin/contacts" class="btn btn-inverse waves-effect waves-light">Cancel</a>
      </div>    


    </form>
  </div>
</div>