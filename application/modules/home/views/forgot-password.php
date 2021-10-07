<div class="CLayout-contentInner">
   <div class="HeaderBanner" id="HeaderAdvert">
      <div data-react-class="Banner"  class="BannerComponentWrapper"></div>
   </div>
  
   <div class="CLayout-fixedWidth">
      <div class="page-header">
         <h1 class="is-textCentered">Forgot Password</h1>
      </div>
      <div class="row">
         <div class="col-sm-8 col-sm-offset-2">
            <div class="DisplayPanel DisplayPanel--withShadow DisplayPanel--withBorder">
               <p class="lead">
                  Please enter your email to receive forgot password instructions.
               </p>
                  <form class="new_password_reset" id="new_password_reset" action="<?php echo base_url()?>forgotpassword/<?php echo $this->uri->segment(2); ?>" accept-charset="UTF-8" method="post">
                  

                  <div class="MField">
                     <label for="user_email">Email</label>
                     <input required="required" type="email" name="user_email" id="user_email">
                     <input required="required" type="hidden" name="user_type" id="user_type" value="<?php echo $this->uri->segment(2); ?>">
                  </div>
                  <input type="submit" name="commit" value="Submit" class="btn btn-large btn-primary">
               </form>
            </div>
         </div>
      </div>
   </div>
</div>






 