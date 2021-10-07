
<div class="main">
   <div class="cl-ViewHeader u-noPrint">
      <h1 class="cl-ViewHeader-title">Account settings</h1> </div>
   <div class="cl-Container">
      <?php
         if(!is_store_details_updated()){ ?>
         <div class="MNotificationBanner">
            <div class="MTypography">
               <p>To place an advert, please ensure you've entered your first name and address, then save your details.</p>
            </div>
         </div>
      <?php   }
      ?>
      
      <form class="new_email" id="new_email" enctype="multipart/form-data" action="<?php echo base_url();?>myaccount/updateProfile" accept-charset="UTF-8" method="post">
         <section class="MPanelGroup">
            <h1 class="MPanelGroup-heading">Login Details</h1>
            <div class="MPanel MPanel--withLine">
               <div class="col-sm-6">
                  
                  <div class="MField">
                     <label for="username">Username</label>
                     <input autocomplete="false" readonly onfocus="this.removeAttribute('readonly');" required="required" type="text" value="<?php echo $store_details[0]->store_name;?>" name="store_name" id="store_name">
                  </div>

                  
               </div>
            </div>
         </section>
         <section class="MPanelGroup">
            <h1 class="MPanelGroup-heading">Your information</h1>
            <p class="MPanelGroup-subheading">The contact information below will be used by BikeExchange for internal communications.</p>
            <div class="MPanel">


               <div class="MField">
                  <label for="business_name">Company Name</label>
                  <input value="<?php echo $store_details[0]->business_name;?>" required="required" type="text" value="" name="business_name" id="business_name">
               </div>

            

               <div class="MField">
                  <label for="country">Country</label>
                  <select required="required" name="country" id="country" onchange="countryChange()">
                     <option value="">Select Country</option>
                     <?php
                        $countries = get_all_countries();
                        foreach ($countries as $country) { ?>
                          <option <?php if($country->id == $store_details[0]->country){ echo 'selected';}?> value="<?php echo $country->id; ?>"><?php echo $country->name; ?></option>
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
                          <option <?php if($state->id == $store_details[0]->state){ echo 'selected';}?> value="<?php echo $state->id; ?>"><?php echo $state->name; ?></option>
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
                          <option <?php if($city->id == $store_details[0]->city){ echo 'selected';}?> value="<?php echo $city->id; ?>"><?php echo $city->name; ?></option>
                     <?php  
                        }     
                     ?>
                  </select>
               </div>

               

               <div class="MField">
                  <label class="MField-label" for="address">Direction</label>
                  <textarea required name="address" id="address" placeholder="Your store address." class="MInput MInput--7Rows"><?php echo $store_details[0]->address;?></textarea>
                  <div class="MField-note"></div>
               </div>


                <div class="MField">
                  <label required for="email_address_attributes_subaddress">CIF<span class="MField-labelNote"></span></label>
                  <input value="<?php echo $store_details[0]->cif;?>" placeholder="cif" type="text" value="" name="cif" id="cif">
               </div>


               <div class="MField">
                  <label required for="email_address_attributes_subaddress">Town<span class="MField-labelNote"></span></label>
                  <input  value="<?php echo $store_details[0]->region;?>"  required placeholder="region" type="text" value="" name="region" id="region">
               </div>


               

               <div class="MField">
                  <label for="email_address_attributes_subaddress">Unit / Level / Postal Code<span class="MField-labelNote"> (optional)</span></label>
                  <input required placeholder="(por ejemplo, Tienda 4, Unidad 12)" type="text"   value="<?php echo $store_details[0]->unit_level;?>"  name="unit_level" id="unit_level">
               </div>


                <div class="MField">
                  <label for="email_address_attributes_subaddress">Webpage<span class="MField-labelNote"> (optional)</span></label>
                  <input  value="<?php echo $store_details[0]->web_page;?>" placeholder="web page" type="text" name="web_page" id="web_page">
               </div>


               <label for="email_">
                  <h2>Contact person details</h2>
               </label>

               <div class="MField">
                  <label for="owner_first_name">First name<span class="MField-labelNote"> (optional)</span></label>
                  <input value="<?php echo $store_details[0]->owner_first_name;?>" type="text" value="" name="owner_first_name" id="owner_first_name">
               </div>


               <div class="MField">
                  <label for="owner_last_name">Surname<span class="MField-labelNote"> (optional)</span></label>
                  <input value="<?php echo $store_details[0]->owner_last_name;?>"  type="text" value="" name="owner_last_name" id="owner_last_name">
               </div>


               <div class="MField">
                  <label for="store_email">Email</label>
                  <input  value="<?php echo $store_details[0]->store_email;?>" required="required" type="email" value="" name="store_email" id="store_email">
               </div>

               <div class="MField">
                  <label for="position">Position / Department</label>
                  <input  value="<?php echo $store_details[0]->position;?>" required="required" type="text" value="" name="position" id="position">
               </div>

               
               <div class="MField">
                  <label for="store_mobile">Telephone</label>
                  <input   value="<?php echo $store_details[0]->store_mobile;?>" required="required" type="text" value="" name="store_mobile" id="store_mobile">
               </div>


               <div class="MField">
                  <label for="phone">Mobile</label>
                  <input  value="<?php echo $store_details[0]->mobile_number;?>" required="required" type="number" value="" name="mobile_number" id="mobile_number">
               </div>


               <div class="MField">
                  <label for="phone">Idiom</label>
                  <input value="<?php echo $store_details[0]->idiom;?>" required="required" type="text" value="" name="idiom" id="idiom">
               </div>


                

               
               <label for="email_">
                  <h2>Your bank account details</h2>
                  <p>We need this information so that we can pay you when you sell something</p>
               </label>
               <div class="MField">
                  <label for="account_name">Account name<span class="MField-labelNote"> (optional)</span></label>
                  <input value="<?php echo $store_details[0]->account_name;?>" type="text" value="" name="account_name" id="account_name">
               </div>
               <div class="MField">
                  <label for="swift_code">Swift code<span class="MField-labelNote"> (optional)</span></label>
                  <input  value="<?php echo $store_details[0]->swift_code;?>" type="text" value="" name="swift_code" id="swift_code">
               </div>
               <div class="MField">
                  <label for="account_number">Account number<span class="MField-labelNote"> (optional)</span></label>
                  <input   value="<?php echo $store_details[0]->account_number;?>"  type="text" value="" name="account_number" id="account_number">
               </div>




                
            </div>
         </section>
         
       <div class="cl-Container">
         <div class="error-update-class"></div>
         <div class="MField u-right">
            <input  type="submit" name="commit" value="Update Details" class="MButton MButton--primary MButton--next" data-disable-with="Update Details"> </div>
        </div>    

      </form>
   </div>
</div>
</div>