<?php
 $adveritserDetails =  get_login_adveritser_details_array(); 
 
    $fname          = "";
    $lname          = "";
    $email          = "";
    $contact_number = "";
    $company_name   = "";

 if(count($adveritserDetails) > 0){
    $fname          = $adveritserDetails[0]->fname;
    $lname          = $adveritserDetails[0]->lname;
    $email          = $adveritserDetails[0]->email;
    $contact_number = $adveritserDetails[0]->contact_number;
    $company_name   = $adveritserDetails[0]->company_name;
 }

?>

<div class="bg-white">
<div class="page-title green-bg pt-3 pb-3">
  <div class="container">
   <div class="row">
    <div class="col col-8">
        <h2 class="text-uppercase text-white">Edit Profile</h2>
    </div>
    <div class="col col-4">
       <a  class="logoutbutton" href="<?php echo base_url()?>logout">Log out</a>
    </div>
   </div>
  </div>
</div>
 
 <div class="innerpages pt-5 pb-5">
   <div class="container">
     <div class="row">
       <?php
        require_once("menus.php");
       ?>
       <div class="col col-md-9 col-12">
         <div class="row">
           <div class="col col-md-8 col-12">
              <div class="edit-form-profile">
                <form method="post" action="<?php echo base_url()?>editprofile">  
              <div class="form-group">
                <input required name="fname" value="<?php echo $fname;?>" type="text" class="form-control radius" placeholder="First Name">
              </div>
              <div class="form-group">
                <input required name="lname"  value="<?php echo $lname;?>" type="text" class="form-control radius" placeholder="Last Name">
              </div>            
              <div class="form-group">                
                <input required name="email" value="<?php echo $email;?>" type="email" class="form-control radius" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email Address">                
              </div>
              <div class="form-group">
                <input required name="contact_number" value="<?php echo $contact_number;?>" type="text" class="form-control radius" placeholder="Contact Number">
              </div>
              <div class="form-group">
                <input required name="comp_name"  value="<?php echo $company_name;?>" type="text" class="form-control radius" placeholder="Company Name">
              </div>
              <div class="profile-btn-link">
              <a class="btn text-white mt-3 radius green-bg" href="<?php echo base_url();?>profile">Cancel</a>
              <button type="submit" class="btn text-white mt-3 radius green-bg">Update</button>     
              <a class="btn text-white mt-3 radius green-bg" href="<?php echo base_url();?>changepassword">Change Password</a>  
              </div>
            </form>
              </div>
           </div>
         </div>
         
       </div>
     </div>
   </div>
 </div>
</div>    

    

  
