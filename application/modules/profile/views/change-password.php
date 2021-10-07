<?php
	$userDetaisObj = login_user_details();
?>

<div class="CLayout-contentInner">
   <div class="CLayout-fixedWidth">
 	

 	<div class="row">
	<div class="col-sm-4">
		<section class="DisplayPanel" style="padding:0px;">
			<div>
				<?php
					$tab = $this->uri->segment(2);
					
				?>
					<a href="<?php echo base_url();?>profile/editprofile" class="btn  btn-block <?php if($tab == 'editprofile'){ echo 'btn-primary'; }?>">Profile</a>
					<a href="<?php echo base_url();?>profile/changepassword" class="btn  btn-block <?php if($tab == 'changepassword'){ echo 'btn-primary'; }?>">Change Password</a>
					
					<a href="<?php echo base_url();?>profile/address" class="btn  btn-block <?php if($tab == 'address'){ echo 'btn-primary'; }?>">Address</a>
					
					<a href="<?php echo base_url();?>profile/orders" class="btn  btn-block <?php if($tab == 'orders' || $tab == 'orderdetail'){ echo 'btn-primary'; }?>">My Orders</a>
				
					<a href="<?php echo base_url().'/myaccount/signout'?>" class="btn  btn-block <?php if($tab == 'signout'){ echo 'btn-primary'; }?>">Sign out (<?php echo login_user_name();?>)</a>
			</div>
		</section>
	</div>
	<div class="col-sm-8">
		<section class="DisplayPanel">
            <form class="new_email" id="new_email" autocomplete="off" action="<?php echo base_url();?>myaccount/new" accept-charset="UTF-8" method="post">

               <div class="MField">
                  <label for="email_user_attributes_password">Old Password</label>
                  <input required="required" type="password" name="old_password" id="old_password">
                  <input value="<?php echo $this->session->userdata(FRONT_USER_ID);?>" required="required" type="hidden" name="store_id" id="store_id">
               </div>


            	<div class="MField">
                  <label for="email_user_attributes_password">Password</label>
                  <input required="required" type="password" name="password" id="password">
               </div>

               <div class="MField">
                  <label for="confirm_password">Confirm</label>
                  <input required="required" type="password" name="confirm_password" id="confirm_password">
               </div>



               <div class="error-signup-store"></div>

               <button type="button" onclick="updatepassoworduser()" class="g-recaptcha btn btn-large btn-primary has-horizontalInputWidth">Update</button>

            </form>
         </section>
	</div>
</div>






   </div>
</div>