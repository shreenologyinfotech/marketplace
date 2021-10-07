      <footer class='ManagedFooter ManagedFooter--themed'>
                  <div class='ManagedFooter-inner row'>
                     <div class='ManagedFooter-column col-6 col-sm-4'>
                        <h4 class='ManagedFooter-columnHeading'><?php echo lang('Useful Links');?></h4>
                        <div class='ManagedFooter-list'>
                           <div class="inhalt strich">
                              <ul>
                                 <li><a onclick='showSignInModel("buy")' href="javascript:void(0)">To buy</a></li>
                                 <li><a onclick='showSignInModel("sell")' href="javascript:void(0)">To sell</a></li>
                                 <li><a href="<?php echo base_url();?>contact-us">Contact Us</a></li>
                                 <!-- <li><a href="<?php // echo base_url();?>private-buy-sell">Place an ad</a></li> -->
                              </ul>
                           </div>
                        </div>
                     </div>
                     <div class='ManagedFooter-column col-6 col-sm-4'>
                        <h4 class='ManagedFooter-columnHeading'><?php echo lang('About Marketplacephones'); ?></h4>
                        <div class='ManagedFooter-list'>
                           <div class="inhalt strich">
                              <ul>
                                 <?php
                                    $footerLinks = get_footer_page();
                                    foreach ($footerLinks as $footerLink) { ?>
                                   <li><a href="<?php echo base_url();?>home/<?php echo $footerLink->slug;?>"><?php echo $footerLink->title;?></a></li>     
                                 <?php
                                  }
                                 ?>   

                              </ul>
                           </div>
                        </div>
                     </div>
                     <div class='ManagedFooter-column col-6 col-sm-4'>
                        <h4 class='ManagedFooter-columnHeading'><?php echo lang('Social Connections');?></h4>
                        <div class='ManagedFooter-list'>
                           <div class="inhalt" >
                              <ul>
                                 <!-- <li><a href='<?php // echo get_meta_value("facebook_link"); ?>' rel='' target='_blank'><i class='fa fa-facebook-square'></i> Facebook</a></li>
                                 <li><a href='<?php //  echo get_meta_value("twitter_link"); ?>' rel='' target='_blank'><i class='fa fa-twitter'></i> Twitter </a></li>
                                 <li><a href='<?php //  echo get_meta_value("instagram_link"); ?>' rel='' target='_blank'><i class='fa fa-instagram'></i> Instagram </a></li>
                                 <li><a href='<?php  // echo get_meta_value("youtube_link"); ?>' rel='' target='_blank'><i class='fa fa-youtube'></i> You tube</a></li> -->

                                 <li><a href='<?php echo get_meta_value("youtube_link"); ?>' rel='' target='_blank'><i class='fa fa-linkedin'></i> Linked In</a></li>
                              </ul>
                           </div>
                        </div>
                     </div>
                  </div>
               </footer>
               <div class='PostFooter'>
                  <div class='PostFooter-inner'>
                     <div class='PostFooter-column PostFooter-column--widgets'>

                        <div class="PostFooter-widgetitem PostFooter-widgetitem--countryPicker">
                    <div  class="CountryPicker CountryPicker-position--top">

                    <div class="CountryPickerDropdown t-countryPicker">

                     <?php
                        $language = $this->session->userdata('language');
                        if($language == ""){
                           $language = "english";
                        }
                     ?>
                      <button onclick="showlanguage()" type="button" class="CountryPickerDropdown-itemLink is-selected"><img src="<?php echo base_url();?>uploads/<?php echo $language;?>.png" class="CountryPickerDropdown-icon" alt="Colombia">
                        <span class="CountryPickerDropdown-name"><?php 
                           echo strtoupper($language);
                            ?></span>
                        <i class="fa fa-caret-down"></i>
                      </button>

                      <ul class="CountryPickerDropdown-items">
                          

                       <li class="CountryPickerDropdown-item">
                          <a href="<?php echo base_url()?>switchlanguage/english" class="CountryPickerDropdown-itemLink"><img src="<?php echo base_url();?>uploads/english.png" class="CountryPickerDropdown-icon" ><span class="CountryPickerDropdown-name">English</span></a>
                        </li>
                           

                        <li class="CountryPickerDropdown-item">
                          <a href="<?php echo base_url()?>switchlanguage/spanish" class="CountryPickerDropdown-itemLink"><img src="<?php echo base_url();?>uploads/spanish.png" class="CountryPickerDropdown-icon" ><span class="CountryPickerDropdown-name">Spanish</span></a>
                        </li>


                        <li class="CountryPickerDropdown-item">
                          <a href="<?php echo base_url()?>switchlanguage/french" class="CountryPickerDropdown-itemLink"><img src="<?php echo base_url();?>uploads/french.png" class="CountryPickerDropdown-icon" ><span class="CountryPickerDropdown-name">French</span></a>
                        </li>
                        
                       
                      </ul>
                    </div>
                  </div>
                </div>





                        
                     </div>
                     <div class='PostFooter-column PostFooter-column--poweredby'>
                        <?php echo lang('Powered by'); ?><a target="" class="PostFooter-logo PostFooter-logo--marketplacer" rel="noopener" href="javascript:void(0)"><img src="<?php echo base_url()?>uploads/logo.png" /></a>
                     </div>
                  </div>
                  <div class='PostFooter-copyright'>
                     <div class='PostFooter-copyright-inner'>
                        <p><?php echo get_meta_value("copy_right_content"); ?></p>
                     </div>
                  </div>
               </div>
            </div>

            <div class="SignupRegister">
               <div class="Modal">
                  <div class="Modal-outer">
                     <div class="Modal-header">
                        <button onclick="hideRegisterModel();" type="button" class="Modal-close t-modalClose">close ✕</button>
                     </div>
                     <div class="Modal-inner">
                        <div class="SignInRegister-modal"><span>
                           <div class="">
                              <div class="oauth-buttons"><p><strong> CREATE AN ACCOUNT WITH US </strong></p><a href="<?php echo base_url();?>myaccount/new" class="btn btn-primary btn-block has-bottomMargin-large" data-provider="email">Register with Email</a><p><strong> OR REGISTER WITH </strong></p>
                              <!-- <div>
                                 <div><a href="/client/auth/facebook" class="btn btn-fb-oauth btn-block has-bottomMargin-normal" data-provider="facebook">Facebook</a>
                              </div> 
                              <div>
                                 <a href="/client/auth/strava" class="btn btn-strava-oauth btn-block has-bottomMargin-normal" data-provider="strava">Strava</a>
                              </div>
                              -->
                              </div></div><p class="has-topMargin-large">Are you a retail store? <a href="<?php echo base_url();?>private-buy-sell">Create a retail store account</a></p></div></span></div></div></div></div></div>




            <div class="SigninRegister">
               <div class="Modal">
                  <div class="Modal-outer">
                     <div class="Modal-header">
                        <button onclick="hideSignInModel();" type="button" class="Modal-close t-modalClose">close ✕</button>
                     </div>
                     <div class="Modal-inner">
                        <div class="SignInRegister-modal">
                           <span>
                              <div class="">
                                 <div class="SignInForm">
                                 <form class="login-form has-bottomMargin-large">
                                    <div class="has-bottomMargin-normal">
                                       <label for="login_username">Email / Username</label>
                                       <p>
                                          <span class="input">
                                             <input name="login_username" id="login_username" type="text" value="">
                                             <input name="user_type" id="user_type" type="hidden" value="">
                                          </span>
                                       </p>
                                       <label for="login_password">Password</label>
                                       <p>
                                          <span class="input">
                                             <input name="login_password" id="login_password" type="password" value="">
                                          </span>
                                       </p>
                                    </div>

                                    

                                    <input id="btmLogin"  onclick="loginStore();" type="button" class="SignInForm-loginBtn btn btn-primary" value="Log in">

                                    <div class="has-bottomMargin-normal">
                                       <div class="error-login"></div>
                                    </div>

                                 </form>
                                 <div class="clearfix">
                                    <span class="pull-left">
                                       <a id="forgot_link" href="<?php echo base_url();?>forgotpassword">Forgot Password?</a>
                                    </span>


                                    <span id="user_register" class="pull-right">New here? &nbsp;<a href="<?php echo base_url();?>myaccount/new">Register</a></span>

                                    <span id="seller_register" class="pull-right">New here? &nbsp;<a href="<?php echo base_url();?>new-retailer-signup">Register</a></span>


                                 </div>
                              </div>
                           </div>
                        </span>
                     </div>
                  </div>
               </div>
            </div>
         </div>




         <div class="pay-by-bank-model" style="display: none">
               <div class="Modal">
                  <div class="Modal-outer">
                     <div class="Modal-header">
                        <button onclick="hideBankModel();" type="button" class="Modal-close t-modalClose">close ✕</button>
                     </div>
                     <div class="Modal-inner">
                        <div class="SignInRegister-modal">
                           <span>
                              <div class="">
                                 <div class="SignInForm">
                                 <form class="login-form has-bottomMargin-large">
                                    <div class="has-bottomMargin-normal">
                                       <label for="login_password">Make the transfer to the bank account and send the receipt to the email</label>
                                       <label for="login_password">Company Name</label>
                                       <p>MERCADITEL S.L</p>
                                       <label for="login_password">Bank Name</label>
                                       <p>Cajamar</p>
                                       <label for="login_username">IBAN</label>
                                       <p>ES50 3058 0990 2127 5375 7000</p>
                                       <label for="login_username">Email To Sent Receipt</label>
                                       <p>info@marketplacephones.com</p>

                                    </div>
                                 </form>
                              </div>
                           </div>
                        </span>
                     </div>
                  </div>
               </div>
            </div>
         </div>


         </div>
      </div>


      <script src="<?php echo base_url()?>assets/front/assets/marketplace-aa528beba0e981eca1a71c4c508ce4594d0a17fb53d12b5d10fa7826b06f981f.js"></script>
      <script src="<?php echo base_url()?>assets/front/webpack/en-US-be-kp0WWX7fPGGLWQG-9Kc8iZXCpTI.js"></script>
      <script src="<?php echo base_url()?>assets/front/webpack/common-2f168f6f03bef8c48148.js"></script>
      <script src="<?php echo base_url()?>assets/front/webpack/marketplace-40c079ffea6f07376767.js"></script>
      <script src="<?php echo base_url()?>assets/front/webpack/ux_utils-6dafa136240feab56e84.js"></script>
      <script src="<?php echo base_url()?>assets/front/webpack/outdated_browser-9ca176c295dc08f5f564.js"></script>

      <script src="<?php echo base_url()?>assets/plugins/bower_components/sweetalert/sweetalert.min.js"></script>
      <script src="<?php echo base_url()?>assets/plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js"></script>
      <script src="<?php echo base_url()?>assets/jquery.blockUI.js"></script>
      <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>      



       <script>
           $( function() {
             $( "#slider-range" ).slider({
               range: true,
               min: 0,
               max: 10000,
               values: [ 0, 500 ],
               slide: function( event, ui ) {

                 $( "#RefineBox-minPrice" ).val(ui.values[0]);
                 $( "#RefineBox-maxPrice" ).val(ui.values[1]);
               }
             });



             $( "#RefineBox-minPrice" ).val($( "#slider-range" ).slider( "values", 0 ));
             $( "#RefineBox-maxPrice" ).val($( "#slider-range" ).slider( "values", 1 ));

           } );
           </script>

      <script>
         //<![CDATA[
         if (typeof M === 'undefined') { global.M = { config: {} }}
         M.config.theme = {};
         M.config.theme.gallery = { hasBorder: true};
         M.config.googleMapsApiKey = "AIzaSyCW_7KInI-_qSlu-xi5NK7QkVXwGAgRFyA";
         M.config.siteCountryDisplayStates = true;
         M.config.siteHasInternationalShipping = true;
         M.config.verticalCurrencySymbol = "$";
         M.config.disambiguatedVerticalCurrencySymbol = "US$";
         M.config.verticalCurrency = "USD";
         M.config.sessionCurrencySymbol = "$";
         M.config.headerAutoCollapseDisabled = false;
         M.config.distanceMultiplier = 1609.34;
         M.config.distanceUnit = "mi";
         M.config.editingCustomisations = false;
         I18n.locale = "en-US-be";
         
         //]]>
      </script>
      <script>
         MGA.AdvertTileTracking.processTiles('[data-advert-tracking-data]');
      </script>
      <script>
         $('.HeroSliderContainer-inner.is-loading[data-controls], .ContentBlockContainer-inner.is-loading').each(function(_i, slider) {
           setTimeout(function () {
             M.TileSlider({
               selector: "#" + slider.id,
               sliderType: 'hero',
               autoplay: slider.dataset["autoplay"] !== undefined,
               sliderSpeed: Number(slider.dataset["sliderSpeed"]),
             });
           }, 200);
         });


         $('.AdvertTilesContainer-inner.is-loading[data-controls], .ContentBlockContainer-inner.is-loading').each(function(_i, slider) {
           setTimeout(function () {
             M.TileSlider({
               selector: "#" + slider.id,
               sliderType: 'hero',
               autoplay: slider.dataset["autoplay"] !== undefined,
               sliderSpeed: Number(slider.dataset["sliderSpeed"]),
             });
           }, 200);
         });


      </script>
      <script>
         //new M.Header();
         new M.Accordion();
         MUX.UxTrackingEvents();
         M.TileSlider({ selector: '.TileSliderContainer',autoplay:true,sliderSpeed: 2000 });
      </script>


      <script>



          

        
         function openbankmodel(){
            $(".pay-by-bank-model").show();
         }
         function hideBankModel(){
            $(".pay-by-bank-model").hide();
         }
         

         function showRegisterModel(){
               $(".SignupRegister").show();
            }

            function hideRegisterModel(){
               $(".SignupRegister").hide();
            }

            function showSignInModel(user_type){
              console.log(user_type);

              $("#user_type").val(user_type);
              if(user_type == "sell"){
                $("#user_register").hide();
                $("#seller_register").show();

              }else{
                $("#user_register").show();
                $("#seller_register").hide();
              }

              var _href = $("#forgot_link").attr("href");
              $("#forgot_link").attr("href", _href +"/"+user_type);

              $(".SigninRegister").show();
            }

            function hideSignInModel(){
               $(".SigninRegister").hide();
            }

            function validateEmail(email) {
                const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(String(email).toLowerCase());
            }

            


            function updatepassoworduser(){

               $(".error-signup-store").html(""); 

               var old_password        = $("#old_password").val(); 
               var user_password       = $("#password").val(); 
               var confirm_password       = $("#confirm_password").val(); 
               var store_id            = $("#store_id").val();

               if(old_password == ""){
                 $(".error-signup-store").html("<p class='alert alert-danger'>Please enter old password</p>"); 
                 return;
               }else if(user_password == ""){
                 $(".error-signup-store").html("<p class='alert alert-danger'>Please enter password</p>"); 
                 return;
               }else if(user_password.length < 8){
                 $(".error-signup-store").html("<p class='alert alert-danger'>Password must be 8 character long</p>"); 
                 return;
               }else if(confirm_password == ""){
                 $(".error-signup-store").html("<p class='alert alert-danger'>Please enter confirm password</p>"); 
                 return;
               }else if(confirm_password != user_password){
                  console.log(confirm_password);
                  console.log(user_password);
                 $(".error-signup-store").html("<p class='alert alert-danger'>Password not match</p>"); 
                 return;
               }else{
                
                  var formdata = {
                     "old_password":old_password,
                     "user_password":user_password,
                     "store_id":store_id
                  };
                  $.ajax({
                       url: '<?php echo base_url();?>'+"ajax/updatepassoworduser",
                       method:"POST",
                       data:formdata,
                       success:function(data){
                          var data     =  JSON.parse(data);
                          $(".error-signup-store").html(data.Message); 
                          
                       }
                   });




               }
            }



            function signupstore(){

               $(".error-signup-store").html(""); 

               var user_password       = "";
               var user_cpassword      = "";
               var check_accept_terms      = "";
               

               var user_name           = $("#user_name").val();
               var user_email          = $("#user_email").val();

               if ($('#user_password').length){
                 user_password       = $("#user_password").val(); 
               }
               
               if ($('#user_cpassword').length){
                 user_cpassword      = $("#user_cpassword").val(); 
               }
              

               var last_name           = $("#last_name").val();
               var store_mobile        = $("#store_mobile").val();
               var street_number        = $("#street_number").val();
               var city                = $("#city").val();
               var address             = "";
               var cp                  = $("#cp").val();

               var country              = $("#country").val();
               var state                = $("#state").val();
               var city                 = $("#city").val();
               var vat_number                 = $("#vat_number").val();


               // if ($('#check_accept_terms').length){
               //  check_accept_terms  = $("#check_accept_terms").val();  
               // }
               
               var store_id            = $("#store_id").val();

               if(user_name == ""){
                  $(".error-signup-store").html("<p class='alert alert-danger'>Please enter username</p>"); 
                  return;
               }else if(user_email == ""){
                 $(".error-signup-store").html("<p class='alert alert-danger'>Please enter email</p>"); 
                 return;
               }else if(!validateEmail(user_email)){
                 $(".error-signup-store").html("<p class='alert alert-danger'>Please enter valid email</p>"); 
                 return;
               }else if(user_password == "" && store_id == ""){
                 $(".error-signup-store").html("<p class='alert alert-danger'>Please enter password</p>"); 
                 return;
               }else if(user_password.length < 8 && store_id == ""){
                 $(".error-signup-store").html("<p class='alert alert-danger'>Password must be 8 character long</p>"); 
                 return;
               }else if(user_cpassword == "" && store_id == ""){
                 $(".error-signup-store").html("<p class='alert alert-danger'>Please enter confirm password</p>"); 
                 return;
               }else if(user_cpassword != user_password){
                 $(".error-signup-store").html("<p class='alert alert-danger'>Password not match</p>"); 
                 return;
               }else if(street_number == ""){
                 $(".error-signup-store").html("<p class='alert alert-danger'>Please enter street and number</p>"); 
                 return;
               }else if(country == ""){
                 $(".error-signup-store").html("<p class='alert alert-danger'>Please select country</p>"); 
                 return;
               }else if(state == ""){
                 $(".error-signup-store").html("<p class='alert alert-danger'>Please select state</p>"); 
                 return;
               }else if(city == ""){
                 $(".error-signup-store").html("<p class='alert alert-danger'>Please select city</p>"); 
                 return;
               }
               /*else if(address == ""){
                 $(".error-signup-store").html("<p class='alert alert-danger'>Please enter address</p>"); 
                 return;
               }
               else if (check_accept_terms.checked == false && store_id == ""){
                $(".error-signup-store").html("<p class='alert alert-danger'>Please accept terms and condition</p>"); 
                 return;
              }*/else{
                
                  var formdata = {
                     "user_name":user_name,
                     "user_email":user_email,
                     "user_password":user_password,
                     "last_name":last_name,
                     "store_mobile":store_mobile,
                     "street_number":street_number,
                     "city":city,
                     "address":address,
                     "cp":cp,
                     "store_id":store_id,
                     "country":country,
                     "state":state,
                     "vat_number":vat_number

                  };
                  $.ajax({
                       url: '<?php echo base_url();?>'+"ajax/signupstore",
                       method:"POST",
                       data:formdata,
                       success:function(data){
                          var data     =  JSON.parse(data);
                          $(".error-signup-store").html(data.Message); 
                          if(data.RESULT == "YES"){

                           if(store_id != ""){
                              $(".error-signup-store").html("Profile updated successfully"); 
                           }else{

                              // setTimeout(function(){
                              //    window.open(
                              //      '<?php // echo base_url();?>profile/editprofile',
                              //    );
                              //    location.reload();
                              // }, 1000);

                           }
                           

                             
                          }
                       }
                   });




               }
            }
            function changevat(){

               $(".error-signup-store").html(""); 

               var user_password       = "";
               var user_cpassword      = "";
               var check_accept_terms      = "";
               

               var user_name           = $("#user_name").val();
               var user_email          = $("#user_email").val();

               

               var vat_number                 = $("#vat_number").val();

               var store_id            = $("#store_id").val();

               if(user_email == ""){
                 $(".error-signup-store").html("<p class='alert alert-danger'>Please enter email</p>"); 
                 return;
               }else if(!validateEmail(user_email)){
                 $(".error-signup-store").html("<p class='alert alert-danger'>Please enter valid email</p>"); 
                 return;
               }else{
                
                  var formdata = {
                     "user_email":user_email,
                     "store_id":store_id,
                     "vat_number":vat_number

                  };
                  $.ajax({
                       url: '<?php echo base_url();?>'+"ajax/signupvatchange",
                       method:"POST",
                       data:formdata,
                       success:function(data){
                          var data     =  JSON.parse(data);
                          $(".error-signup-store").html(data.Message); 
                          if(data.RESULT == "YES"){

                           if(store_id != ""){
                              $(".error-signup-store").html("Vat updated successfully. Excutive will check and give approval of it."); 
                           }else{

                             

                           }
                           

                             
                          }
                       }
                   });




               }
            }

            function loginStore(){

               $(".error-login").html(""); 
               var login_username = $("#login_username").val();
               var login_password = $("#login_password").val();
               var user_type      = $("#user_type").val();

               if(login_username == ""){
                  $(".error-login").html("<p class='alert alert-danger'>Please enter username</p>"); 
                  return;
               }else if(login_password == ""){
                 $(".error-login").html("<p class='alert alert-danger'>Please enter password</p>"); 
                 return;
               }else{
                  
                  var formdata = {
                     "store_name":login_username,
                     "password":login_password,
                     "user_type":user_type
                  };

                  $.ajax({
                       url: '<?php echo base_url();?>'+"ajax/loginstore",
                       method:"POST",
                       data:formdata,
                       success:function(data){
                          var data     =  JSON.parse(data);
                          $(".error-login").html(data.Message); 
                          if(data.RESULT == "YES"){
                           if (data.Data.user_type == "U") {
                              window.location = '<?php echo base_url(); ?>profile/editprofile';
                           } else {
                              window.location = '<?php echo base_url(); ?>myaccount';

                           }/*
                           if(data.Data.user_type == "U"){
                                 setTimeout(function(){
                                    window.location = '<?php echo base_url();?>profile/editprofile';
                                    
                                 }, 1000);
                           }else{
                                 setTimeout(function(){
                                    window.open(
                                      '<?php echo base_url();?>myaccount',
                                      '_blank' // <- This is what makes it open in a new window.
                                    );
                                    location.reload(); 
                                    
                                 }, 1000);
                              
                           }*/

                           
                             
                          }
                       }
                   });




               }
            }



            function addWishList(productId,element){
                  var formdata = {
                     "product_id":productId,
                     "table":"tbl_user_has_wishlist"
                  };
                  $.ajax({
                       url: '<?php echo base_url();?>'+"ajax/addCartAndWishList",
                       method:"POST",
                       data:formdata,
                       success:function(data){
                          var data     =  JSON.parse(data);
                          if(data.RESULT == "YES"){
                            if(data.Message == "remove"){
                              $(element).removeClass("AddToWishList--inWishList t-addToWishList--inWishList"); 
                            }else{
                              $(element).addClass("AddToWishList--inWishList t-addToWishList--inWishList"); 
                            }
                            
                           $(".t-wishListCount").html(data.Data.wish);   
                           $(".t-cartItemCount").html(data.Data.cart);   
                           
                           

                          }
                       }
                   });
            }


         

            

           
             $(".MQuantitySelector-incrementButton").click(function(){
               if($('#CProductVariantSelectQuantity').val() <= 10){
                 var $n = $("#CProductVariantSelectQuantity");
                 $n.val(Number($n.val())+1);
                 var value = $n.val();
                 $("#number").val(value);
               }
            }); 

      $(".MQuantitySelector-decrementButton").click(function(){
         if($('#CProductVariantSelectQuantity').val() > 1){
              var $n = $("#CProductVariantSelectQuantity");
              $n.val(Number($n.val())-1);
              var value = $n.val();
              $("#number").val(value);
          }
      });
      
      
      function sentMessageToSeller(){
         $("#enquiery-email").attr("disabled", true);
         $("#data-message").html("");
         
         var product_id    = $("#product_id").val();
         var first_name    = $("#first_name").val();
         var message       = $("#message").val();
         var email_address = $("#email_address").val();
         var phone         = $("#phone").val();

         var errorMessage = "";
         if(first_name == ""){
               errorMessage = "Please enter your name !";
         }else if(message == ""){
               errorMessage = "Please enter message !";

         }else if(email_address == ""){
               errorMessage = "Please enter email !";
         }else if(phone == ""){
               errorMessage = "Please enter phone number !";
         }

         if(errorMessage == ""){
                  var formdata = {
                           "product_id":product_id,
                           "first_name":first_name,
                           "message":message,
                           "email_address":email_address,
                           "phone":phone
                  };
                  $.ajax({
                       url: '<?php echo base_url();?>'+"ajax/sentMessageToSeller",
                       method:"POST",
                       data:formdata,
                       success:function(data){
                         $("#enquiery-email").attr("disabled", false);
                          var data     =  JSON.parse(data);
                          if(data.RESULT == "YES"){
                                 $("#product_id").val("");
                                 $("#first_name").val("");
                                 $("#message").val("");
                                 $("#email_address").val("");
                                 $("#phone").val("");
                                 $(".data-message").html("<p class='alert alert-success'>Enquiery sent successfully</p>"); 

                          }
                       }
                   });
         }else{
         $("#enquiery-email").attr("disabled", false);
            $(".data-message").html("<p class='alert alert-danger'>"+errorMessage+"</p>"); 
        
         }


      }


      function dosubscribe(){

           //$(".error-login").html(""); 
           var user_email = $("#user_email").val();
           if(user_email == ""){
               $(".error-newsletter").html("<p class='alert alert-success'>Please enter email address</p>");  
               return;
           }

           var formdata = {
            'user_email':user_email
           };


            $.ajax({
                  url : '<?php echo base_url();?>'+"ajax/subscribenewsletter",
                  type : "POST",
                  data : formdata,
                  success:function(data){
                     var data     =  JSON.parse(data);
                     if(data.RESULT == "YES"){
                         $(".error-newsletter").html("<p class='alert alert-success'>You have successfully subscribed newsletters</p>");   
                     }else{
                        $(".error-newsletter").html("<p class='alert alert-danger'>"+data.Message+"</p>");
                     }
                  },
                  error : function(jqXHR, textStatus, errorThrown) {
                      $(".error-newsletter").html("<p class='alert alert-danger'>Oops ! Something went wrong. Please login agin then try</p>");
                  }
              });
      }
      

      function removeCartItem(cartId){
         swal({
                  title: 'Are you sure?',
                  text: "You want to remove this cart item?",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: "btn-danger",
                  confirmButtonText: "Yes",
                  showLoaderOnConfirm: true,
                  closeOnConfirm: false
                },
                function() {
                    var formData = {
                     "cart_id":cartId
                    };
                    $.ajax({
                        url : '<?php echo base_url();?>'+"ajax/removeCartItem",
                        type : "POST",
                        data : formData,
                        success : function(data, textStatus, jqXHR) {
                            if(data=="NO"){
                                swal({
                                  text: "Oops ! Something went wrong. Please login agin then try",
                                },
                                function(){
                                    window.location.reload();
                                });
                            }else{
                                swal({
                                  title: "Success!",
                                  text: "item removed successfully",
                                  type: "success",
                                },
                                function(){
                                    window.location.reload();
                                });
                            }
                        },
                        error : function(jqXHR, textStatus, errorThrown) {
                            swal({
                              title: "Error!",
                              text: "Oops ! Something went wrong. Please login agin then try",
                              type: "error",
                              confirmButtonText: "Ok"
                            });
                        }
                    });
                });
       
      }      

      
      function addToCart(storeId,productId,qty){
                  var formdata = {
                        "store_id":storeId,
                        "product_id":productId,
                        "table":"tbl_user_has_cart",
                        "qty":qty
                  };
                  $.ajax({
                       url: '<?php echo base_url();?>'+"ajax/addToCart",
                       method:"POST",
                       data:formdata,
                       success:function(data){
                          var data     =  JSON.parse(data);
                          if(data.RESULT == "YES"){
                           $(".t-wishListCount").html(data.Data.wish);   
                           $(".t-cartItemCount").html(data.Data.cart);   

                           swal({
                               title: "Success",
                               text: 'Successfully added to cart!',
                               type: "info",
                               confirmButtonText: "Ok"
                             });   

                           
                          }else{
                              $(".t-wishListCount").html(data.Data.wish);   
                              $(".t-cartItemCount").html(data.Data.cart); 

                              swal({
                               title: "Caution",
                               text: data.Message,
                               type: "info",
                               confirmButtonText: "Ok"
                             });   

                          }
                       }
                   });
            }


       function getsubcategory(){
        var dl_category_id =  $("#dl_category_id").val();
        var formdata = {
           "category_id":dl_category_id,
        };
        
       $.ajax({
               url: '<?php echo base_url();?>'+"ajax/getsubcategorydl",
               method:"POST",
               data:formdata,
               success:function(data){
                  var data     =  JSON.parse(data);
                  if(data.RESULT == "YES"){
                      $("#sub_category_id").html(data.Data);
                  }
               }
           });
       }

       function getcategory(){
        var brand_id =  $("#brand_id").val();
        var formdata = {
           "brand_id":brand_id,
        };
        
       $.ajax({
               url: '<?php echo base_url();?>'+"ajax/getcategorydl",
               method:"POST",
               data:formdata,
               success:function(data){
                  var data     =  JSON.parse(data);
                  if(data.RESULT == "YES"){
                      $("#dl_category_id").html(data.Data);
                  }
               }
           });
       }

       

            
      function showlanguage(){
        if($(".CountryPickerDropdown-items").css("opacity") == 1){
          $(".CountryPickerDropdown-items").css( "opacity", 0);
        }else{
          $(".CountryPickerDropdown-items").css( "opacity", 1);
        }
        $(".CountryPickerDropdown-items").css( "visibility", 'visible');
      }       


      </script>
     
<script language="javascript" type="text/javascript">
   $( window ).load(function() {
   if ($('#frm-payment').length){
         $("#frm-payment").submit();
   }   
   });



   
   function stateChange(){
      var tempResponseCity  = '<option value="">Select City</option>';
      $("#city").html(tempResponseCity);

      var formdata = {
         "state":$("#state").val(),
      };
      $.ajax({
           url: '<?php echo base_url();?>'+"ajax/getcitybystateid",
           method:"POST",
           data:formdata,
           success:function(data){
              var data     =  JSON.parse(data);
              $("#city").html(data.Data);
           }
       });
   }


   function countryChange(){
      var tempResponseState = '<option value="">Select State</option>';
      var tempResponseCity  = '<option value="">Select City</option>';
      $("#state").html(tempResponseState);
      $("#city").html(tempResponseCity);

      var formdata = {
         "country":$("#country").val(),
      };
      $.ajax({
           url: '<?php echo base_url();?>'+"ajax/getstatesbycountry",
           method:"POST",
           data:formdata,
           success:function(data){
              var data     =  JSON.parse(data);
              $("#state").html(data.Data);
           }
       });
   }


   function selectAddress(element,address_id){
      $.blockUI();
      var formdata = {
         "address_id":address_id
      };
      $.ajax({
           url: '<?php echo base_url();?>'+"ajax/updateuserdefaultaddress",
           method:"POST",
           data:formdata,
           success:function(data){
              $.unblockUI(); 
              var data = JSON.parse(data); 
              if(data.RESULT == "YES"){
                  $(".DisplayPanel").find(".address-book-entry").removeClass("red-border");
                  $(element).addClass("red-border");
              }else{
                  swal({
                     title: "Error!",
                     text: "Oops ! Something went wrong. Please login agin then try",
                     type: "error",
                     confirmButtonText: "Ok"
                   });
              }
           }
       });
   }

   function addNewAddress(){
      $(".error-address").html("");   

      var flat_house_building_company_apartment  = $("#flat_house_building_company_apartment").val();
      var area_street_sector_village             = $("#area_street_sector_village").val();
      var land_mark                              = $("#land_mark").val();
      var country                                = $("#country").val();
      var state                                  = $("#state").val();
      var city                                   = $("#city").val();     
      var postal_code                                   = $("#postal_code").val();     

      if(flat_house_building_company_apartment == ""){
         $(".error-address").html("<p class='alert alert-danfer'>Please enter Flat / House / Building / Company / Apartment</p>");   

      }else if(area_street_sector_village == ""){
         $(".error-address").html("<p class='alert alert-danfer'>Please enter Area / Street / Sector / Village</p>");   

      }else if(land_mark == ""){
         $(".error-address").html("<p class='alert alert-danfer'>Please enter Landmark</p>");   

      }else if(country == ""){
         $(".error-address").html("<p class='alert alert-danfer'>Please select country</p>");   
      }else if(state == ""){
         $(".error-address").html("<p class='alert alert-danfer'>Please select state</p>");   
      }else if(city == ""){
         $(".error-address").html("<p class='alert alert-danfer'>Please select city</p>");   
      }else if(postal_code == ""){
         $(".error-address").html("<p class='alert alert-danfer'>Please enter postal code</p>");   
      }else{

      var formdata = {
         "flat_house_building_company_apartment":flat_house_building_company_apartment,
         "area_street_sector_village":area_street_sector_village,
         "land_mark":land_mark,
         "country":country,
         "state":state,
         "city":city,
         "postal_code":postal_code,
      };

      $.ajax({
           url: '<?php echo base_url();?>'+"ajax/addShippingAddress",
           method:"POST",
           data:formdata,
           success:function(data){
              var data     =  JSON.parse(data);
              if(data.RESULT == "YES"){
                  location.reload()
              }else{
               $(".error-address").html("<p class='alert alert-danfer'>"+data.Message+"</p>");   
              }
              
           }
       });

      }
   }

   
    function performAction(actionUrl,title,message,successTitle){    
            var headingTitle = "Success!";
            if(title == "Activate Advertiser?"){
                headingTitle = "Activated!";
            }else if(title == "Remove as partner?"){
               headingTitle = "Partnership Terminated";
            }else if(title ==  "Cancel Order?"){
              headingTitle = "Order Cancelled";
            }else if(title ==  "Block User?"){
              headingTitle = "Block!";
            }else if(title ==  "Activate User?" || title == "Activate Event?"){
              headingTitle = "Activated!";
            }else if(title ==  "Deactivate Event?"){
              headingTitle = "Deactivated!";
            }else if(title ==  "Block Advertiser?"){
              headingTitle = "Block!";
            }else if(title ==  "Assign as Partner?"){
              headingTitle = "Partnership Formed";
            }else if(title ==  "Delete Event?"){
              headingTitle = "Deleted!";
            }

            









            swal({
                  title: title,
                  text: message,
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: "btn-danger",
                  confirmButtonText: "Yes",
                  showLoaderOnConfirm: true,
                  closeOnConfirm: false,
                },
                function() {
                    var formData = {
                    };
                    $.ajax({
                        url : actionUrl,
                        type : "POST",
                        data : formData,
                        success : function(data, textStatus, jqXHR) {
                            if(data=="NO"){
                                swal({
                                  text: "Oops ! Something went wrong. Please login agin then try",
                                },
                                function(){
                                    window.location.reload();
                                });
                            }else{
                                swal({
                                  title: headingTitle,
                                  text: successTitle,
                                  type: "success",
                                },
                                function(){
                                    window.location.reload();
                                });
                            }
                        },
                        error : function(jqXHR, textStatus, errorThrown) {
                            swal({
                              title: "Error!",
                              text: "Oops ! Something went wrong. Please login agin then try",
                              type: "error",
                              confirmButtonText: "Ok"
                            });
                        }
                    });
                });
}



function getUserBadge(){
   var formdata = {};
   $.ajax({
           url: '<?php echo base_url();?>'+"ajax/getUserBadges",
           method:"POST",
           data:formdata,
           success:function(data){
              var data     =  JSON.parse(data);
              if(data.RESULT == "YES"){
               $(".t-wishListCount").html(data.Data.wish);   
               $(".t-cartItemCount").html(data.Data.cart);   
              }
           }
       });

}


    $( window ).on( "load", function() {
        setInterval(function(){ getUserBadge(); }, 3000);
    });



   // "#searchmobile"
   function toggleMenu(){
      $('#searchmobile').toggleClass('is-mobileOpenActive');
      $('#searchmobile').toggleClass('is-openMobile');
   }

</script>
 
   </body>
</html>