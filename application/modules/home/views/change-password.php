<div class="bg-white">
<div class="page-title green-bg pt-3 pb-3">
  <div class="container">
   <div class="row">
    <div class="col col-md-8 col-12">
        <h2 class="text-uppercase text-white">Change Password</h2>
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
                <form id="form-change-password" method="post" action="<?php echo base_url()?>changepassword">  
                  <div class="form-group">
                    <input id="old_password" required name="old_password" type="password" class="form-control radius" placeholder="Old Password">
                  </div>
                    <div class="form-group">
                    <input required  id="new_password"  name="new_password" type="password" class="form-control radius" placeholder="New Password">
                  </div>

                  <div class="form-group">
                    <input required id="confirm_password" name="confirm_password" type="password" class="form-control radius" placeholder="Confirm Password">
                  </div>

                  <div class="form-group">
                     <div class="row"><div id="resultDiv" class="col col-12"></div></div> 
                  </div>
              
                  <a class="btn text-white pl-5 pr-5 mt-3 radius green-bg" href="<?php echo base_url();?>profile">Cancel</a>
                  <input type="button" onclick="valdatechangepassword()" class="btn text-white pl-5 pr-5 mt-3 radius green-bg" value="Change"/>
                  <div align="left">
              
            </form>
              </div>
           </div>
         </div>
         
       </div>
     </div>
   </div>
 </div>
</div>    

    

  
