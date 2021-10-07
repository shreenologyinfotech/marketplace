<?php
   $title     = "Advertiser Details";
   $listTitle = "Advertiser Details";

   $fName          = "";
   $lName          = "";
   $email          = "";
   $password       = "";
   $companyName    = "";
   $contact        = ""; 
   $id             = "";
   $status         = "";

   if(count($data) > 0){
          $fName          = $data[0]->fname;
          $lName          = $data[0]->lname;
          $email          = $data[0]->email;
          $password       = base64_decode($data[0]->enk_key);
          $companyName    = $data[0]->company_name;
          $contact        = $data[0]->contact_number; 
          $id             = $data[0]->id;
          $status         = $data[0]->status;
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
 
      <div class="form-group">
        <label class="control-label">First Name</label>
        <input readonly type="text" value="<?php echo $fName;?>" required id="firstName" name="firstName" class="form-control" placeholder="First Name">
      </div>
      
      <div class="form-group">
        <label class="control-label">Last Name</label>
        <input readonly type="text" value="<?php echo $lName;?>" required id="lastName" name="lastName" class="form-control" placeholder="Last Name">
      </div>

      <div class="form-group">
        <label class="control-label">Email</label>
        <input readonly type="email" value="<?php echo $email;?>" required id="email" name="email" class="form-control" placeholder="Email">
      </div>

      <div class="form-group">
        <label class="control-label">Company Name</label>
        <input readonly type="text" value="<?php echo $companyName;?>" required id="companyName" name="companyName" class="form-control" placeholder="Company Name">
      </div>

      <div class="form-group">
        <label class="control-label">Contact Number</label>
        <input  readonly type="text" value="<?php echo $contact;?>" required id="contact" name="contact" class="form-control" placeholder="Contact Number">
      </div>

      <div class="form-group">
        <label class="control-label">Is email verified</label>
        <input  readonly type="text" value="<?php echo $status;?>" required id="status" name="status" class="form-control" placeholder="Status">
      </div>


      <div class="form-group">
        <label class="control-label">Status</label>
        <input  readonly type="text" value="<?php echo $status;?>" required id="status" name="status" class="form-control" placeholder="Status">
      </div>


      <?php if($id != ""){ ?>  
      <input type="hidden" name="id" value="<?php echo $id;?>"/>
      <?php } ?>
       <div class="form-group">
          <?php /*

          <?php
            if($status == "Pending"){
          ?>
              <button onclick="performAction('<?php echo base_url()?>advertisers/approve/<?php echo  $id;?>','Are you sure!','You want to Approve this advertisers!!','advertiser approved successfullly')" type="submit" class="btn btn-success waves-effect waves-light m-r-10">Approve</button>
          <?php
              }
              if($status != "Deleted"){
           ?> 
           <button onclick="performAction('<?php echo base_url()?>advertisers/delete/<?php echo  $id;?>','Are you sure!','You want to Delete this advertisers!!','advertiser Deleted successfullly')" type="submit" class="btn btn-danger waves-effect waves-light m-r-10">Delete</button>

           <?php
              }else if($status == "Deleted"){
            ?>    
            <button onclick="performAction('<?php echo base_url()?>advertisers/approve/<?php echo  $id;?>','Are you sure!','You want to active this advertisers!!','advertiser active successfullly')" type="submit" class="btn btn-success waves-effect waves-light m-r-10">Activate</button>
          <?php  }
          ?>
          */
          ?>
          <a href="<?php echo base_url()?>admin/advertisers" class="btn btn-inverse waves-effect waves-light">Cancel</a>
      </div>    
   </div>
</div>

