<?php
	
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
			<h1 class="Cart-header-title h2"><span>Add New Address</span></h1>
<form action="addnewaddress">
         <div class="MField">
            <label for="order_first_name">Flat / House / Building / Company / Apartment</label>
            <input required="" class="TallInput" type="text" name="flat_house_building_company_apartment" id="flat_house_building_company_apartment" value="">
         </div> 

         <div class="MField">
            <label for="order_first_name">Area / Street / Sector / Village</label>
            <input required="" class="TallInput" type="text" name="area_street_sector_village" id="area_street_sector_village" value="">
         </div> 

         <div class="MField">
            <label for="order_first_name">Land Mark</label>
            <input required="" class="TallInput" type="text" name="land_mark" id="land_mark" value="">
         </div> 

         <div class="MField">
            <label for="country">Country</label>
            <select required="required" name="country" id="country" onchange="countryChange()">
               <option value="">Select Country</option>
               <?php
                  $countries = get_all_countries();
                  foreach ($countries as $country) { ?>
                    <option value="<?php echo $country->id; ?>"><?php echo $country->name; ?></option>
               <?php  
                  }     
               ?>
            </select>
         </div>

         <div class="MField">
            <label for="state">State</label>
            <select required="required" name="state" id="state" onchange="stateChange()">
               <option value="">Select State</option>
            </select>
         </div>


         <div class="MField">
            <label for="city">City</label>
            <select required="required" name="city" id="city">
               <option value="">Select City</option>
            </select>
         </div>


         <div class="MField">
            <label for="order_first_name">Postal Code</label>
            <input required="" class="TallInput" type="text" name="postal_code" id="postal_code" value="">
         </div> 


         
         <p class="error-address"></p>

         <button onclick="addNewAddress();" type="submit" class="btn btn-go btn-large" data-disable-with="Add"> Add</button>
         </form>
         <br/><br/><hr/>


     		<?php foreach($my_address as $address) { ?>

     			<div id="address-book-entry" class="address-book-entry a-spacing-double-large address-book-new-row">
				<ul class="displayAddressUL" style="list-style: none;">

				<li class="displayAddressLI displayAddressCountryName">
					<div style="float: right;display:flex;">
						<?php if($address->is_default == "Y"){ ?> <div  class="btn btn-primary btn-xs MainSearch-button">Default</div><?php } ?>
						

						<?php if($address->is_default != "Y"){ ?>
							<div style="margin-left: 6px;">
								<img onclick="performAction('<?php echo base_url();?>ajax/updatestatus/tbl_address/D/<?php echo $address->address_id;?>','Delete address','Are you sure want to delete this Address?','Address deleted successfully')" src="<?php echo base_url();?>assets/images/delete.png">		
							</div>
						<?php	 } ?>	
					</div>
				</li>

				<li class="displayAddressLI displayAddressFullName"><b><?php echo login_user_name();?></b></li>
				<li class="displayAddressLI displayAddressAddressLine2"><?php echo $address->area_street_sector_village;?>,<?php echo $address->land_mark;?></li>
				<li class="displayAddressLI displayAddressAddressLine1"><?php echo $address->flat_house_building_company_apartment;?></li>
				<li class="displayAddressLI displayAddressAddressLine1"><?php echo $address->postal_code;?></li>
				<li class="displayAddressLI displayAddressCityStateOrRegionPostalCode"><?php echo $address->town_city;?>,<?php echo get_state_by_id($address->state_id);?>,<?php echo get_country_by_id($address->country_id);?></li>
					
				</ul>

				
			</div>

     		<?php	} ?>    
      </section>
	</div>
</div>






   </div>
</div>