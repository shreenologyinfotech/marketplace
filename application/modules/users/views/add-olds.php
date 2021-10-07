<?php
   $title     = "Add User";
   $listTitle = "Add New";
   $submit    = "Submit";
   

   $fName          = "";
   $lName          = "";
   $username       = "";
   $email          = "";
   $password       = "";
   $companyName    = "";
   $contact        = ""; 
   $id             = "";
   $payment_mode   = "";
   $gender         = "";
   $date_of_birth  = "";
   $employment_status_id = "";
   $martial_status = "";
   $unit_number    = "";



   if(count($data) > 0){
      $title     = "Edit User";
      $listTitle = "Edit User";
      $submit    = "Update";
          
          $fName          = $data[0]->fname;
          $lName          = $data[0]->lname;
          $email          = $data[0]->email;
          $contact        = $data[0]->contact_number;
          $password       = base64_decode($data[0]->enk_key);
          $companyName    = $data[0]->company_name;
          $id             = $data[0]->id;

          $payment_mode   = $data[0]->payment_mode; 
          $gender         = $data[0]->gender;
          $username       = $data[0]->username;
          $date_of_birth  = $data[0]->date_of_birth;
          $employment_status_id = $data[0]->employment_status_id;
          $martial_status = $data[0]->martial_status;
          $unit_number    = $data[0]->unit_number;
  


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
        <label class="control-label">User Name</label>
        <input type="text" value="<?php echo $username;?>" required id="username" name="username" class="form-control" placeholder="User Name">
      </div>

      <div class="form-group">
        <label class="control-label">Gender</label>
        <select id="gender" name="gender" class="form-control">
          <option <?php if($gender == "Male"){echo "selected";}?>  value="Male">Male</option>
          <option <?php if($gender == "Female"){echo "selected";}?>  value="Female">Female</option>
          <option <?php if($gender == "Transgender"){echo "selected";}?>  value="Transgender">Transgender</option>
        </select>
      </div>


      <div class="form-group">
        <label class="control-label">Dob</label>
        <input type="text" value="<?php echo $date_of_birth;?>" required id="date_of_birth" name="date_of_birth" class="form-control dob" placeholder="Date Of Birth">
      </div>


      <div class="form-group">
        <label class="control-label">Martial Status</label>
        <select id="martial_status" name="martial_status" class="form-control">
          <option <?php if($martial_status == "Single"){echo "selected";}?>  value="Single">Single</option>
          <option <?php if($martial_status == "Married"){echo "selected";}?>  value="Married">Married</option>
          <option <?php if($martial_status == "Widow"){echo "selected";}?>  value="Widow">Widow</option>
          <option <?php if($martial_status == "Divorced"){echo "selected";}?>  value="Divorced">Divorced</option>
        </select>
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
        <input type="number" value="<?php echo $contact;?>" required id="contact" name="contact" class="form-control" placeholder="Contact Number">
      </div>


      <div class="form-group">
        <label class="control-label">Payment Mode</label>
        <select id="payment_mode" name="payment_mode" class="form-control">
          <option <?php if($payment_mode == "Bank Account"){echo "selected";}?>  value="Bank Account">Bank Account</option>
          <option <?php if($payment_mode == "Register Mobile Number"){echo "selected";}?>  value="Register Mobile Number">Register Mobile Number</option>
        </select>
      </div>


      <div class="form-group">
        <label class="control-label">Employment</label>
        <select id="employment_status_id" name="employment_status_id" class="form-control">
          <option value="">Select Employement</option>
          <?php
            foreach ($employement as $result) {
            ?>
              <option <?php if($employment_status_id == $result->id;){echo "selected";}?>  value="<?php echo $result->id;?>"><?php echo $result->value;?></option>    
          <?php  }
          ?>
        </select>
      </div>

      <div class="form-group">
        <label class="control-label">Unit Number</label>
        <input type="number" value="<?php echo $unit_number;?>" required id="unit_number" name="unit_number" class="form-control" placeholder="Unit Number">
      </div>

      <div class="form-group">
          <button type="submit" class="btn btn-success waves-effect waves-light m-r-10"><?php echo $submit;?></button>
          <a href="<?php echo base_url()?>admin/advertisers" class="btn btn-inverse waves-effect waves-light">Cancel</a>
      </div>    


    </form>
  </div>
</div>