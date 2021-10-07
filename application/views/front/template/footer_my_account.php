      <script src="<?php echo base_url()?>assets/front/webpack/common-01f573b36e24d06ff953.js"></script>
      <script src="<?php echo base_url()?>assets/front/webpack/client_admin-947d8681772733bfdf6b.js"></script>
      <script src="<?php echo base_url()?>assets/front/webpack/ux_utils-954ae74bc6f3eb877aaf.js"></script>


      <script src="<?php echo base_url()?>assets/plugins/bower_components/sweetalert/sweetalert.min.js"></script>
    <script src="<?php echo base_url()?>assets/plugins/bower_components/sweetalert/jquery.sweet-alert.custom.js"></script>

    <script src="<?php echo base_url()?>assets/admin/js/dashboard1.js"></script>



      <script>
         //<![CDATA[
         if (typeof M === 'undefined') { global.M = { config: {} }}
         M.config.theme = {};
         M.config.theme.gallery = { hasBorder: true};
         M.config.googleMapsApiKey = "AIzaSyCW_7KInI-_qSlu-xi5NK7QkVXwGAgRFyA";
         M.config.siteCountryDisplayStates = true;
         M.config.siteHasInternationalShipping = true;
         M.config.verticalCurrencySymbol = "AU$";
         M.config.disambiguatedVerticalCurrencySymbol = "AU$";
         M.config.verticalCurrency = "AUD";
         M.config.sessionCurrencySymbol = "AU$";
         M.config.headerAutoCollapseDisabled = false;
         M.config.distanceMultiplier = 1000.0;
         M.config.distanceUnit = "km";
         M.config.editingCustomisations = false;
         I18n.locale = "en-AU-be";
         
         //]]>
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
      </script>

      <script>
    

    function getsubcategory(){
      var category_id                  = $("#category_id").val();
      var formdata = {
                      "category_id":category_id
                     };

      $.ajax({
                       url: '<?php echo base_url();?>'+"ajax/getsubcategory",
                       method:"POST",
                       data:formdata,
                       success:function(data){
                          var data     =  JSON.parse(data);
                          if(data.RESULT == "YES"){
                             $("#subcategory_id").html(data.Data.data);
                          }
                       }
                   });

    }



    function updateProfile(){
      var username                  = $("#username").val();
      var old_password             = $("#old_password").val();
      var new_password              = $("#new_password").val();
      var confirm_password          = $("#confirm_password").val();
      var first_name                = $("#first_name").val();
      var last_name                 = $("#last_name").val();
      var email_date_of_birth       = $("#email_date_of_birth").val();
      var unit_level                = $("#unit_level").val();
      var address                   = $("#address").val();
      var address_city              = $("#address-city").val();
      var address_region            = $("#address-region").val();
      var address_postcode          = $("#address-postcode").val();
      var address_country           = $("#address-country").val();
      var email                     = $("#email").val();
      var store_mobile              = $("#store_mobile").val();
      var vat_number              = $("#vat_number").val();
      

      var errorClass                = $(".error-update-class");

      if(username == ""){
        $(errorClass).html("<p class='alert alert-danger'>Please enter username</p>"); 
        return;

      }else if(old_password != ""){

          if(new_password == ""){
            $(errorClass).html("<p class='alert alert-danger'>Please enter password</p>"); 
            return;

          }else if(new_password.length < 8){
            $(errorClass).html("<p class='alert alert-danger'>Password must be 8 character long</p>"); 
            return;

          }else if(confirm_password == ""){
            $(errorClass).html("<p class='alert alert-danger'>Please enter confirm password</p>"); 
            return;

          }else if(new_password != confirm_password){
            $(errorClass).html("<p class='alert alert-danger'>Passoword not match</p>"); 
            return;

          }
      }else if(first_name == ""){
            $(errorClass).html("<p class='alert alert-danger'>Please enter first name</p>"); 
            return;
         
          } else if(address == ""){
            $(errorClass).html("<p class='alert alert-danger'>Please enter address</p>"); 
            return;

          } else if(address_city == ""){
            $(errorClass).html("<p class='alert alert-danger'>Please enter city</p>"); 
            return;

          } else if(address_region == ""){
            $(errorClass).html("<p class='alert alert-danger'>Please enter region</p>"); 
            return;

          } else if(address_postcode == ""){
            $(errorClass).html("<p class='alert alert-danger'>Please enter postcode</p>"); 
            return;

          } else if(email == ""){
            $(errorClass).html("<p class='alert alert-danger'>Please enter email</p>"); 
            return;

          }else {

          
      
              var formdata = {
                   "store_name":username,
                   "old_password":old_password,
                   "new_password":new_password,
                   "owner_first_name":first_name,
                   "owner_last_name":last_name,
                   "owner_dob":email_date_of_birth,
                   "unit_level":unit_level,
                   "city":address_city,
                   "region":address_region,
                   "post_code":address_postcode,
                   "country":address_country,
                   "store_email":email,
                   "vat_number":vat_number,
                   "store_mobile":store_mobile
              };

              $.ajax({
                       url: '<?php echo base_url();?>'+"ajax/updatestore",
                       method:"POST",
                       data:formdata,
                       success:function(data){
                          var data     =  JSON.parse(data);
                          $(errorClass).html(data.Message); 
                          if(data.RESULT == "YES"){
                           setTimeout(function(){
                              location.href="<?php echo base_url();?>myaccount/settings";
                           }, 1000);
                             
                          }
                       }
                   });


          }

     





    }




   
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

   
</script>



<script type="text/javascript">
 $("#banner_image").click(function(e) {
        $("#imageUpload").click();
 });

function readURL(input,element) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#'+element).attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}
</script>

      
   </body>
</html>
