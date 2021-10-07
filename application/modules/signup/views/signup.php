<?php
  $fname = "";
  $lname = "";
  $email = "";
  $contact = "";
  $companyName = "";
 

  if(count($post) > 0){
      $fname        = $post["fname"];
      $lname        = $post["lname"];
      $email        = $post["email"];
      $contact      = $post["contact"];
      $companyName  = $post["companyName"];
  }
?>
 <div class="innerpages bg-light">
   <div class="container">
     <div class="row justify-content-center">
       <div class="col col-md-5 col-12">
         <div class="bg-white shadow-sm signup-ac mt-5 mb-5 rounded">
          <div class="mb-5 text-center">
           <h4 class="mb-4"><strong>Create an Account</strong></h4>
           <p>Already have an account? <a href="<?php echo base_url()?>login">Login</a>.</p>  
          </div>    
            <form id="form-adveritser-signup" action="<?php echo base_url()?>signup" method="post">
             

              <div class="form-group">
               <div class="row">
                 <div class="col col-6">
                   <input value="<?php echo $fname;?>" id="fname"  name="fname" required="" type="text" class="form-control radius" aria-describedby="emailHelp" placeholder="First Name">
                 </div>
                 <div class="col col-6">
                   <input value="<?php echo $lname;?>" id="lname" name="lname" required="" type="text" class="form-control radius" aria-describedby="emailHelp" placeholder="Last Name">
                 </div>
               </div> 
              </div>
              <div class="form-group">                
                <input value="<?php echo $email;?>"  id="email" name="email" required="" type="email" class="form-control radius" aria-describedby="emailHelp" placeholder="Email Address">                
              </div>

              <div class="form-group">
                <input value="<?php echo $contact;?>" id="contact"  name="contact" required="" type="text" class="form-control radius" placeholder="Contact Number">
              </div>
              <div class="form-group">
                <input  value="<?php echo $companyName;?>" id="companyName" required="" name="companyName" type="text" class="form-control radius" placeholder="Company Name*">
                <span class="txt_sub">*Enter "Not Applicable" if you do not have a company</span>
              </div>


              <div class="form-group">
               <div class="row">
                 <div class="col col-6">
                  
                   <input id="password" required="" name="password" type="password" class="form-control radius" aria-describedby="emailHelp" placeholder="Password">
                 </div>
                 <div class="col col-6">
                   <input id="cpassword" name="cpassword" required="" type="password" class="form-control radius" aria-describedby="emailHelp" placeholder="Confirm Password">
                 </div>
               </div> 
              </div>
               <div class="form-group">
                 <div class="row"><div id="resultDiv" class="col col-12"></div></div> 
              </div>
              <div class="form-check">
                <input required="" type="checkbox" class="form-check-input" id="checkTerms">
                <label class="form-check-label d-inline" for="checkTerms">I agree to Cashvertise's <a href="<?php echo base_url()?>home/terms-of-use" target="_blank">Terms of Use</a> and <a  target="_blank" href="<?php echo base_url()?>home/privacy-policy">Privacy & Cookies Policy</a></label>
              </div>

              
<!--          <div class="form-check">
                  <div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI" data-callback="verifyRecaptchaCallback" data-expired-callback="expiredRecaptchaCallback"></div>
                  <input class="form-control d-none" data-recaptcha="true" required data-error="Please complete the Captcha">
                  <div class="help-block with-errors"></div>
              </div>
 -->
             <!--  <div class="captcha mt-4"><img src="images/captcha-robort.png"></div> -->
              
             

              <div align="center">  
                  <input onclick="validatesignup();" id="btnsignup" type="button" class="btn text-white pl-5 pr-5 mt-5 mb-5 radius green-bg" value="Sign Up"/>
              </div>
            </form>           
         </div>
       </div>
     </div>
   </div>
 </div>