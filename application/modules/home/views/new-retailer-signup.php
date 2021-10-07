<div class="CLayout-contentInner">
   <h1 class="is-textCentered">Create a business account</h1>
   <div class="CLayout-fixedWidth">
      <div class="row">
         <div class="col-sm-8 col-sm-offset-2 DisplayPanel DisplayPanel--withShadow DisplayPanel--withBorder">
            <br>

            <form class="new_email" id="new_email" enctype="multipart/form-data" action="<?php echo base_url();?>createNewStoreAccount" accept-charset="UTF-8" method="post">
               <div class="MField">
                  <label for="business_name">Company Name</label>
                  <input required="required" type="text" value="" name="business_name" id="business_name">
                  <input  type="hidden" value="" name="store_id" id="store_id">
               </div>

               <div class="MField">
                  <label for="company_logo">Company logo</label>
                  <input required id="company_logo" type="file" name="company_logo">
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
                  <label class="MField-label" for="address">Direction</label>
                  <textarea required name="address" id="address" placeholder="Your store address." class="MInput MInput--7Rows"></textarea>
                  <div class="MField-note"></div>
               </div>


                <div class="MField">
                  <label required for="email_address_attributes_subaddress">CIF<span class="MField-labelNote"></span></label>
                  <input placeholder="cif" type="text" value="" name="cif" id="cif">
               </div>


               <div class="MField">
                  <label required for="email_address_attributes_subaddress">Town<span class="MField-labelNote"></span></label>
                  <input required placeholder="region" type="text" value="" name="region" id="region">
               </div>


               

               <div class="MField">
                  <label for="email_address_attributes_subaddress">Unit / Level / Postal Code<span class="MField-labelNote"> (optional)</span></label>
                  <input required placeholder="(por ejemplo, Tienda 4, Unidad 12)" type="text" value="" name="unit_level" id="unit_level">
               </div>


                <div class="MField">
                  <label for="email_address_attributes_subaddress">Webpage<span class="MField-labelNote"> (optional)</span></label>
                  <input placeholder="web page" type="text" value="" name="web_page" id="web_page">
               </div>


               <label for="email_">
                  <h2>Contact person details</h2>
               </label>

               <div class="MField">
                  <label for="first_name">First name<span class="MField-labelNote"> (optional)</span></label>
                  <input type="text" value="" name="first_name" id="first_name">
               </div>


               <div class="MField">
                  <label for="sur_name">Surname<span class="MField-labelNote"> (optional)</span></label>
                  <input type="text" value="" name="sur_name" id="sur_name">
               </div>


               <div class="MField">
                  <label for="email">Email</label>
                  <input required="required" type="email" value="" name="email" id="email">
               </div>

               <div class="MField">
                  <label for="position">Position / Department</label>
                  <input required="required" type="text" value="" name="position" id="position">
               </div>

               
               <div class="MField">
                  <label for="phone">Telephone</label>
                  <input required="required" type="text" value="" name="phone" id="phone">
               </div>


               <div class="MField">
                  <label for="phone">Mobile</label>
                  <input required="required" type="number" value="" name="mobile_number" id="mobile_number">
               </div>


               <div class="MField">
                  <label for="phone">Idiom</label>
                  <input required="required" type="text" value="" name="idiom" id="idiom">
               </div>


                

               <label for="email_">
                  <h2>Login details</h2>
               </label>

               <div class="MField">
                  <label for="user_name">Username</label>
                  <input required="required" type="text" value="" name="user_name" id="user_name">
               </div>
               <div class="MField">
                  <label for="email_user_attributes_password">Password</label>
                  <input required="required" type="password" name="password" id="password">
                  <div class="MField-note">Mínimo 10 caracteres. Screened against a list of commonly-used and compromised passwords.</div>
               </div>
               <div class="MField">
                  <label for="confirm_password">Confirm</label>
                  <input required="required" type="password" name="confirm_password" id="confirm_password">
               </div>
               <label for="email_">
                  <h2>Your bank account details</h2>
                  <p>We need this information so that we can pay you when you sell something</p>
               </label>
               <div class="MField">
                  <label for="account_name">Account name<span class="MField-labelNote"> (optional)</span></label>
                  <input type="text" value="" name="account_name" id="account_name">
               </div>
               <div class="MField">
                  <label for="swift_code">Swift code<span class="MField-labelNote"> (optional)</span></label>
                  <input type="text" value="" name="swift_code" id="swift_code">
               </div>
               <div class="MField">
                  <label for="account_number">Account number<span class="MField-labelNote"> (optional)</span></label>
                  <input type="text" value="" name="account_number" id="account_number">
               </div>
               <!-- <div class="MField">
                  <div class="MCheckbox">
                     <input required type="checkbox" value="1" checked="checked">
                     <label class="MCheckbox-label" for="email_check_accept_terms"><span class="t-terms-and-conditions">Accept our</span> <a target="_blank" rel="noopener" href="/article/terminos-y-condiciones">Terms and Conditions</a></label>
                  </div>
               </div>
               <div class="MField">
                  <div class="MCheckbox">
                     
                     <input required type="checkbox" value="1" checked="checked" name="" id="email_edm_enabled">
                     <label class="MCheckbox-label" for="email_edm_enabled">Receive our communications</label>
                  </div>
               </div>
               <p>If you change your mind, you can unsubscribe from these emails at any time by using the "Unsubscribe" button on the emails you receive. For more information on how we use your personal data, and your privacy rights, please read our <a href="javascript:void(0)" target="_blank"> Privacy Policy</a>.</p>

                -->
               <input type="submit" name="commit" value="Regístrate" class="btn btn-go btn-large" data-disable-with="Regístrate"> </form>
         </div>
      </div>
   </div>
</div>