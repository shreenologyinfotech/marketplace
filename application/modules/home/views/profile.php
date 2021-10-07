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
        <h2 class="text-uppercase text-white">Welcome!</h2>
    </div>
    <div class="col col-4"> <a  class="logoutbutton" href="<?php echo base_url()?>logout">Log out</a></div>
   </div>
  </div>
</div>
 
 <div class="innerpages pt-5 pb-5">
   <div class="container">
     <div class="row">
       <?php // require_once("menus.php"); ?>
       <div class="col col-md-12 col-12 justify-content-center">
        <!-- <div class="row">
           <div class="col col-md-8 col-12">
              <div class="edit-form-profile">
                <form>  
              <div class="form-group">
                <input readonly value="<?php echo $fname;?>" type="text" class="form-control radius" placeholder="First Name">
              </div>
              <div class="form-group">
                <input  readonly value="<?php echo $lname;?>" type="text" class="form-control radius" placeholder="Last Name">
              </div>            
              <div class="form-group">                
                <input  readonly value="<?php echo $email;?>" type="email" class="form-control radius" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email Address">                
              </div>
              <div class="form-group">
                <input  readonly value="<?php echo $contact_number;?>" type="text" class="form-control radius" placeholder="Contact Number">
              </div>
              <div class="form-group">
                <input  readonly value="<?php echo $company_name;?>" type="text" class="form-control radius" placeholder="Company Name">
              </div>
              
              <a class="btn text-white pl-5 pr-5 mt-3 radius green-bg" href="<?php echo base_url();?>">Cancel</a>
              <div align="left">
              
            </form>
              </div>
           </div>
          -->

          <div class="row">
           <div class="col col-md-3 col-12">
           <a class="link-profile-page" href="<?php echo base_url()?>createorder">  
            <div class="id_icon create_orIcon"> </div>          
            <h4>Create New Order</h4>            
          </a></div>

          <div class="col col-md-3 col-12">
           <a class="link-profile-page" href="<?php echo base_url()?>trackyourorders">  
           <div class="id_icon track_orIcon"></div>      
            <h4>Track Your Order</h4>            
          </a></div>
          

          <div class="col col-md-3 col-12">
           <a class="link-profile-page" href="<?php echo base_url()?>transactionhistory"> 
           <div class="id_icon transaction_orIcon"></div>             
            <h4>Transaction History</h4>            
          </a></div>
          

          <div class="col col-md-3 col-12">            
           <a class="link-profile-page" href="<?php echo base_url()?>editprofile">  
           <div class="id_icon editPR_orIcon"></div>          
            <h4>Edit Profile</h4>           
          </a></div>
         </div>
         
       </div>
     </div>
   </div>
 </div>
</div>    

    

  
