<?php
	$userDetaisObj = login_user_details();

   $countryId = $userDetaisObj->country;
   $stateId   = $userDetaisObj->state;
      
   $states  = $this->Common->_get_all_records("states",["country_id"=>$countryId]);
   $cities  = $this->Common->_get_all_records("cities",["state_id"=>$stateId]);



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

            	<input value="<?php echo $userDetaisObj->store_id;?>" required="required" type="hidden" name="store_id" id="store_id">

               <div class="MField">
                  <label for="user_name">Name</label>
                  <input value="<?php echo $userDetaisObj->owner_first_name;?>" required="required" type="text" name="user_name" id="user_name">
               </div>

               <div class="MField">
                  <label for="user_name">Surname</label>
                  <input value="<?php echo $userDetaisObj->owner_last_name;?>" required="required" type="text" name="last_name" id="last_name">
               </div>

               <div class="MField">
                  <label for="user_name">Telephone</label>
                  <input value="<?php echo $userDetaisObj->store_mobile;?>" required="" type="number" name="store_mobile" id="store_mobile">
               </div>

               

               <div class="MField">
                  <label for="user_email">Email</label>
                  <input  value="<?php echo $userDetaisObj->store_email;?>" required="required" type="email" name="user_email" id="user_email">
               </div>
              
               


               <div class="MField">
                  <label for="street_number">Street and Number</label>
                  <input  value="<?php echo $userDetaisObj->street_number;?>"  type="text" name="street_number" id="street_number">
               </div>


 

               <div class="MField">
                  <label for="country">Country</label>
                  <select required="required" name="country" id="country" onchange="countryChange()">
                     <option value="">Select Country</option>
                     <?php
                        $countries = get_all_countries();
                        foreach ($countries as $country) { ?>
                          <option <?php if($country->id == $userDetaisObj->country){ echo 'selected';}?> value="<?php echo $country->id; ?>"><?php echo $country->name; ?></option>
                     <?php  
                        }     
                     ?>
                  </select>
               </div>

               <div class="MField">
                  <label for="state">State</label>
                  <select required="required" name="state" id="state" onchange="stateChange()">
                     <option value="">Select State</option>
                     <?php
                        
                        foreach ($states as $state) { ?>
                          <option <?php if($state->id == $userDetaisObj->state){ echo 'selected';}?> value="<?php echo $state->id; ?>"><?php echo $state->name; ?></option>
                     <?php  
                        }     
                     ?>

                     
                  </select>
               </div>


               <div class="MField">
                  <label for="city">City</label>
                  <select required="required" name="city" id="city">
                     <option value="">Select City</option>
                     <?php
                        
                        foreach ($cities as $city) { ?>
                          <option <?php if($city->id == $userDetaisObj->city){ echo 'selected';}?> value="<?php echo $city->id; ?>"><?php echo $city->name; ?></option>
                     <?php  
                        }     
                     ?>
                  </select>
               </div>




               <div class="MField">
                  <label for="address">Location</label>
                  <textarea rows="5" name="address" id="address"><?php echo $userDetaisObj->address;?></textarea>
               </div>

               <div class="MField">
                  <label for="cp">CP</label>
                  <input  value="<?php echo $userDetaisObj->cp;?>" type="text" name="cp" id="cp">
               </div>


               <div class="MField">
                  <label for="cp">VAT Number</label>
                  <input  value="<?php echo $userDetaisObj->vat_number;?>" type="text" name="vat_number" id="vat_number">
                  <?php 
                     if($userDetaisObj->vat_number != '' && $userDetaisObj->vat_verified == 'Y'){
                        echo '<div class="alert alert-success">Vat is verified.</div>';
                     }elseif($userDetaisObj->vat_number != '' && $userDetaisObj->vat_verified == 'N'){
                        echo '<div class="alert alert-danger">Vat is not verified.</div>';
                     }
                  ?>
               </div>


               <div class="error-signup-store"></div>

               <button type="button" onclick="signupstore()" class="g-recaptcha btn btn-large btn-primary has-horizontalInputWidth">Update</button>
                <button type="button" onclick="changevat()" class="g-recaptcha btn btn-large btn-primary has-horizontalInputWidth">Update Vat Only</button>

            </form>
         </section>
	</div>
</div>






   </div>
</div>