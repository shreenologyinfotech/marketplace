<?php
   $title     = "Add Advertiser";
   $listTitle = "Add New";
   $submit    = "Submit";
   

   $fName          = "";
   $lName          = "";
   $email          = "";
   $password       = "";
   $companyName    = "";
   $contact        = ""; 
   $id             = "";

   if(count($data) > 0){
      $title     = "Edit Advertiser";
      $listTitle = "Edit Advertiser";
      $submit    = "Update";
          
          $fName          = $data[0]->fname;
          $lName          = $data[0]->lname;
          $email          = $data[0]->email;
          $password       = base64_decode($data[0]->enk_key);
          $companyName    = $data[0]->company_name;
          $contact        = $data[0]->contact_number; 
          $id             = $data[0]->id;


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
    <form method="post" action="<?php echo base_url()?>admin/addadvertiser">
      <?php if($id != ""){ ?>  
      <input type="hidden" name="id" value="<?php echo $id;?>"/>
      <?php } ?>
      <div class="form-group">
        <label class="control-label">First Name</label>
        <input type="text" value="<?php echo $fName;?>" required id="firstName" name="firstName" class="form-control" placeholder="First Name">
      </div>
      
      <div class="form-group">
        <label class="control-label">Last Name</label>
        <input type="text" value="<?php echo $lName;?>" required id="lastName" name="lastName" class="form-control" placeholder="Last Name">
      </div>

      <div class="form-group">
        <label class="control-label">Email</label>
        <input type="email" value="<?php echo $email;?>" required id="email" name="email" class="form-control" placeholder="Email">
      </div>

      <div class="form-group">
        <label class="control-label">Password</label>
        <input type="password" value="<?php echo $password;?>" required id="password" name="password"  class="form-control" placeholder="Password">
      </div>

      <div class="form-group">
        <label class="control-label">Confirm Password</label>
        <input type="password" value="<?php echo $password;?>" required id="cpassword" name="cpassword" class="form-control" placeholder="Confirm Password">
      </div>
      <div class="form-group">
        <label class="control-label">Company Name</label>
        <input type="text" value="<?php echo $companyName;?>" required id="companyName" name="companyName" class="form-control" placeholder="Company Name">
      </div>

      <div class="form-group">
        <label class="control-label">Contact Number</label>
        <input maxlength="8" type="number" value="<?php echo $contact;?>" required id="contact" name="contact" class="form-control" placeholder="Contact Number">
      </div>

      <div class="form-group">
          <button type="submit" class="btn btn-success waves-effect waves-light m-r-10"><?php echo $submit;?></button>
          <a href="<?php echo base_url()?>admin/advertisers" class="btn btn-inverse waves-effect waves-light">Cancel</a>
      </div>    


    </form>
  </div>
</div>