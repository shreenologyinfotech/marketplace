<div class="LeadPanel has-bg40 is-textCentered">
   <div class="LeadPanel-text is-shade100">
      Create a private account with us
   </div>
</div>
<div class="CLayout-fixedWidth clearfix">
   <div class="row">
     <!--  <div class="col-sm-4">
         <div data-react-class="RegisterPanel" data-react-props="{&quot;oauthSignup&quot;:false,&quot;showFacebookOAuthButton&quot;:true,&quot;}" data-react-cache-id="RegisterPanel-0">
            <div>
             
               <section class="DisplayPanel has-extraPadding">
                  <p class="has-smallPadding is-textCentered"><strong style="text-transform: uppercase;">Are you a retail store?</strong></p>
                  <a class="btn btn-primary is-wide" href="<?php echo base_url()?>private-buy-sell"  >Create a retail store account</a>
               </section>
            </div>
         </div>
      </div> -->
      <div class="col-sm-8 col-xs-offset-2">
         <section class="DisplayPanel">
            <div class="is-textCentered">
               <div class="Circle has-bottomMargin-small has-topMargin-large has-localeBgColor is-shade100">
                  <div class="Circle-text">
                     <i class="fa fa-user"></i>
                  </div>
               </div>
               <h1 class="has-noTopMargin">
                  Let's get started
               </h1>
               <p>
                  Creating a private account with us has never been easier.
               </p>
               <br>
            </div>
            <form class="new_email" id="new_email" autocomplete="off" action="<?php echo base_url();?>myaccount/new" accept-charset="UTF-8" method="post">

               <div class="MField">
                  <label for="user_name">Name</label>
                  <input required="required" type="text" name="user_name" id="user_name">
                  <input  type="hidden" name="store_id" id="store_id">
               </div>

               <div class="MField">
                  <label for="user_name">Surname</label>
                  <input required="required" type="text" name="last_name" id="last_name">
               </div>

               <div class="MField">
                  <label for="user_name">Telephone</label>
                  <input required="" type="number" name="store_mobile" id="store_mobile">
               </div>

               

               <div class="MField">
                  <label for="user_email">Email</label>
                  <input required="required" type="email" name="user_email" id="user_email">
               </div>
              
               <div class="MField">
                  <label for="email_user_attributes_password">Password</label>
                   <input required="required" type="password" name="user_password" id="user_password">
                   <div class="MField-note">Min 8 characters. Screened against a list of commonly-used and compromised passwords.</div>
               </div>

               <div class="MField">
                  <label for="user_cpassword">Confirm</label>
                  <input required="required" type="password" name="user_cpassword" id="user_cpassword">
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
                  <label for="street_number">Street and Number</label>
                  <input required="required" type="text" name="street_number" id="street_number">
               </div>



               


               <!-- <div class="MField">
                  <label for="address">Location</label>
                  <textarea required="required" rows="5" name="address" id="address"></textarea>
               </div> -->

               <div class="MField">
                  <label for="cp">CP</label>
                  <input type="text" name="cp" id="cp">
               </div>

               



             <!--   <div class="MField">
                  <div class="MCheckbox">
                     <input name="check_accept_terms" type="hidden" value="0"><input type="checkbox" value="1" name="check_accept_terms" id="check_accept_terms"><label class="MCheckbox-label" for="check_accept_terms"><span class="t-terms-and-conditions">Accept our</span> <a target="_blank" rel="noopener" href="<?php echo base_url();?>home/terms-conditions">Terms &amp; Conditions</a></label></div>
               </div> -->
               
               <!-- <p>If you change your mind, you can opt-out of these e-mails at any time by using the unsubscribe function in the e-mails you receive. For further details on how we use your personal data, and your privacy rights, please see our <a href="<?php echo base_url();?>home/privacy-policy">Privacy Policy</a>.</p> -->

               <div class="error-signup-store"></div>

               <button type="button" onclick="signupstore()" class="g-recaptcha btn btn-large btn-primary has-horizontalInputWidth">Register</button>

            </form>
         </section>
      </div>
   </div>
</div>

