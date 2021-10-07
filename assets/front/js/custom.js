/*!
 * Start Bootstrap - Agency v4.1.1 (https://startbootstrap.com/template-overviews/agency)
 * Copyright 2013-2018 Start Bootstrap
 * Licensed under MIT (https://github.com/BlackrockDigital/startbootstrap-agency/blob/master/LICENSE)
 */



    function performAction(actionUrl,title,message,successTitle){    
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
                                  title: "Success!",
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

function performActionWithRedirection(actionUrl,title,message,successTitle,redirectUrl){    
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
                                  title: "Success!",
                                  text: successTitle,
                                  type: "success",
                                },
                                function(){
                                    window.location.replace(redirectUrl);
                                   
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




 function valdatechangepassword(){
    var html                  = "";
    var old_password          = $("#old_password").val();
    var new_password          = $("#new_password").val();
    var confirm_password      = $("#confirm_password").val();
      
    if(old_password == ""){
      html = html+'<div class="alert alert-danger">Please enter old password.</div>';
    }else if(new_password == ""){
      html = html+'<div class="alert alert-danger">Please enter new password.</div>';
    }else if(new_password == ""){
      html = html+'<div class="alert alert-danger">Please enter confirm password.</div>';
    }else if(new_password != confirm_password){
      html = html+'<div class="alert alert-danger">Passwords do not match</div>';
    }

    
    $("#resultDiv").html(html);
    if(html == ""){
      $("#form-change-password").submit();
    }

   
   
 
 }


function validatesignup(){
  var html          = "";
  var fname         = $("#fname").val();
  var lname         = $("#lname").val();
  var email         = $("#email").val();
  var contact       = $("#contact").val();
  var companyName   = $("#companyName").val();
  var password      = $("#password").val();
  var cpassword     = $("#cpassword").val();
  var checkTerms    = $("#checkTerms");

  if(fname == ""){
      html = html+'<div class="alert alert-danger">Please enter your first name.</div>';
  }else if(lname== ""){
      html = html+'<div class="alert alert-danger">Please enter your last name.</div>';
  }else if(email== ""){
      html = html+'<div class="alert alert-danger">Please enter your email address.</div>';
  }else if(contact== ""){
      html = html+'<div class="alert alert-danger">Please enter your contact number.</div>';
  }else if(companyName == ""){
      html = html+'<div class="alert alert-danger">Please enter your company name.</div>';
  }else  if(password == ""){
      html = html+'<div class="alert alert-danger">Please enter your password.</div>';
  }else if(password != cpassword){
      html = html+'<div class="alert alert-danger">Passwords do not match.</div>';
  }else if(checkTerms.prop("checked") == false){
      html = html+'<div class="alert alert-danger">Please indicate that you have read and agree to the Terms of Use and Privacy & Cookies Policy.</div>';
  }

  $("#resultDiv").html(html);
  if(html == ""){
    $("#form-adveritser-signup").submit();
  }
}


function alreadyRefundDialogShow(){
    swal({
      title: "Oops!",
      text: "The request to refund your remaining balance has already been initiated.",
      type: "error",
      confirmButtonText: "Ok"
    });
}


function clickPostalSector(){
 // console.log("here comes ");
  $('#by_postal_selector').prop('required',true);
  $('#txt_key_postal').prop('required',false);

  $('#myModal').modal().show()
  

}

function onclickCustomRadius3(){
  $('#by_postal_selector').prop('required',false);
  $('#txt_key_postal').prop('required',true);
  
}


function calculatePrice(){
  // console.log(JSON.stringify(window.filesToUpload));
   var counter = 0;
   for (var i=0;i < window.filesToUpload.length;i++){
      if(!window.filesToUpload[i].src.includes('uploads/ad-photo.jpg')){
        counter = counter + 1;
      }
   }
   
   var cost = "0.00";
   if(counter == 1){
      cost = $("#1_p_i_c").val();
   }else if(counter == 2){
       cost = $("#2_p_i_c").val();
   }else if(counter == 3){
       cost = $("#3_p_i_c").val();
   }else if(counter == 4){
       cost = $("#4_p_i_c").val();
   }else if(counter == 5){
       cost = $("#5_p_i_c").val();
   }else if(counter == 6){
       cost = $("#6_p_i_c").val();
   }else if(counter == 7){
       cost = $("#7_p_i_c").val();
   }else if(counter == 8){
       cost = $("#8_p_i_c").val();
   }else if(counter == 9){
       cost = $("#9_p_i_c").val();
   }else if(counter == 10){
       cost = $("#10_p_i_c").val();
   }

   var qty = $("#qty-value").val();
   var transactionFee = $("#transaction_fee").val();
   //var cost = $("#advertise-perview-cost").html();
   var currency_symbol = $("#currency_symbol").val();
  // console.log("here price"+cost);

   var totalCost = parseFloat(qty * cost);
   if(totalCost > 0 ){
      var finePrice = parseFloat(totalCost)+parseFloat(transactionFee);
      $("#total-value").val(currency_symbol+finePrice.toFixed(2));
   }else{
      $("#total-value").val("");
   }

}



jQuery('#qty-value').on('input', function() {
  calculatePrice();
 });

 /*
 jQuery('#qty-value').on('input', function() {

   var qty = $("#qty-value").val();
   var transactionFee = $("#transaction_fee").val();
   var cost = $("#advertise-perview-cost").html();
   var currency_symbol = $("#currency_symbol").val();
   
   var totalCost = parseFloat(qty * cost);
    if(totalCost > 0 ){
      $("#total-value").val(currency_symbol+totalCost+parseFloat(transactionFee));
    }else{
      $("#total-value").val("");
    }
    
 });
*/

  



$(".datepicker").keypress(function(e){
      return false;
 });


function postalChangeRadius(){
  var url = baseUrl+"ajax/getallzipcodes";
  searchinitiate($("#searchpostalradius").val(),"searchpostalradius",url);
}

function postalChange(){
    var url = baseUrl+"ajax/getallzipcodes";
  searchinitiate($("#searchpostalradius").val(),"searchpostal",url);
}


function clearAll(){

 $("input[name='checkZipRadius[]']:checked").each(function (){
     this.checked = false;
  });

  $("#by_postal_selector").val("");
  $("#zip_codes").val("");

}

function CashvertiseTrim(x) {
  return x.replace(/^\s+|\s+$/gm,'');
}

function doneRadius(){
  var stringZipCode = "";
  $("input[name='checkZipRadius[]']:checked").each(function (){
     console.log(stringZipCode); 
     if(stringZipCode != ""){
        stringZipCode =  stringZipCode+", "+$(this).val();
     }else{ 
		stringZipCode =  $(this).val();
     }  
     stringZipCode = stringZipCode.split(",");//.sort().join(", ");
	 stringZipCode.sort(function(a, b) {
		return a - b;
	 });
	 stringZipCode = stringZipCode.join(",");
  });



  if($('#customRadio2').is(':checked')) { 
    $("#txt_key_postal").val("");
    $("#by_postal_selector").val(stringZipCode);
  }else{
    $("#by_postal_selector").val("");
    $("#txt_key_postal").val(stringZipCode);
  }
  
  $("#zip_codes").val(stringZipCode);
  //console.log("here comes"+stringZipCode);
}






function searchinitiate(searchValue,type,actionUrl){
          var formData = {
            search : searchValue
          };

          $.ajax({
            url : actionUrl,
            type : "POST",
            data : formData,
            success : function(data, textStatus, jqXHR) {
              if(type == "searchpostalradius"){
                $(".radius-check-boxes").html("");
                $(".radius-check-boxes").html("data");

              }else{
                $(".check-boxes").html("");
                $(".check-boxes").html("data");
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

}





/*
!function(a){"use strict";a('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function(){if(location.pathname.replace(/^\//,"")==this.pathname.replace(/^\//,"")&&location.hostname==this.hostname){var o=a(this.hash);if((o=o.length?o:a("[name="+this.hash.slice(1)+"]")).length)return a("html, body").animate({scrollTop:o.offset().top-54},1e3,"easeInOutExpo"),!1}}),a(".js-scroll-trigger").click(function(){a(".navbar-collapse").collapse("hide")}),a("body").scrollspy({target:"#mainNav",offset:56});var o=function(){a("#mainNav").offset().top>100?a("#mainNav").addClass("navbar-shrink"):a("#mainNav").removeClass("navbar-shrink")};o(),a(window).scroll(o),a(".portfolio-modal").on("show.bs.modal",function(o){a(".navbar").addClass("d-none")}),a(".portfolio-modal").on("hidden.bs.modal",function(o){a(".navbar").removeClass("d-none")})}(jQuery);

 $(".scroll_custom").on('click', function(event){
          event.preventDefault();
          var data_target = $(this).attr('data-scrroll-to');
          $("html,body").animate({
              scrollTop: $(data_target).offset().top-80
            },1000);
            return false
      });
	  
$('#myDropdown').on('show.bs.dropdown', function () {
  // do something…
})
*/

      



function clickRefund(values){
   $(".modal-body #remark").html(values);
}




function clickCancel(orderId){
  $(".modal-body #orderId").val(orderId);
  $(".modal-body #reason").val("");
}

function printDiv(divName) {
     /*var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;
     window.print();
     document.body.innerHTML = originalContents;*/
     var printContents = document.getElementById(divName).innerHTML;
     w=window.open();
     w.document.write(printContents);
     w.print();
     w.close();

}



function deleteRecord(actionUrl,title,message,successTitle,successHeading = 'Success!'){  
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
                  title: successHeading,
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


function cancellOrder(baseUrl,cancelBy,btnId){
  if($("#reason").val() != ""){

      var btn = document.getElementById(btnId);
      btn.disabled = true;
      btn.innerText = 'cancelling';


      $("#errorReason").html("");
      var orderId = $(".modal-body #orderId").val();
      var reason  = $("#reason").val();
      
      var formData = { 
        order_id      : orderId,
        reason        : reason,
        cancelledBy   : cancelBy
      };

      $.ajax({
        url : baseUrl,
        type : "POST",
        data : formData,
        success : function(data, textStatus, jqXHR) {
          if(data == "YES"){
              swal({
                  title: "Cancelled",
                  text: "Order cancelled successfully",
                  type: "success",
              },
              function(){
                 window.location.reload(); 
              });
          }else{
              swal({
                  title: "Error!",
                  text: "Oops ! Something went wrong. Please login agin then try",
                  type: "error",
                  confirmButtonText: "Ok"
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


  }else{
    $("#errorReason").html("Please provide us reason");
  }
}





 


function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $('#add-image-file').attr('src', e.target.result);
      $('#add-image-preview-file').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}


/*function checkIfFileExist(){
    if(document.getElementById("ads_image").files.length == 0 ){
        console.log("here comes node");
        return false;
    }
    return true;
}*/

 
function dlChange(baseUrl,requestType){
    if(requestType == "central"){
       var formData = { 
        central_id : $("#dl_central").val()
       };     
    }else if(requestType == "area"){
       var formData = { 
        area_id : $("#dl_area").val()
       };
    }

    $.ajax({
        url : baseUrl,
        type : "POST",
        data : formData,
        success : function(data, textStatus, jqXHR) {
           if(requestType == "central"){
               $("#dl_area").html(data);
              // var response = "<option value=''>select postal code</option>";
               $(".check-boxes").html("");
              // $("#dl_postal_code").html(response);
           }else{
               $(".check-boxes").html(data);
              // $("#dl_postal_code").html(data);

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


}





function clickRadio3(){
     $('#dl_central').attr('required', 'required');
     $('#dl_area').attr('required', 'required');
     $('#dl_postal_code').attr('required', 'required');
     $("#zip-postal-area").show();
     
}

function clickRadio2(){
    $('#dl_central').attr('required', 'required');
    $('#dl_area').attr('required', 'required');
    $('#dl_postal_code').attr('required', 'required');
    $("#zip-postal-area").show();
}


function clickRadio(){
    $('#dl_central').removeAttr('required');
    $('#dl_area').removeAttr('required');
    $('#dl_postal_code').removeAttr('required');
    $('#by_postal_selector').removeAttr('required');
    $('#txt_key_postal').removeAttr('required');
    $("#zip-postal-area").hide();    
}


jQuery(document).ready(function(){
    // This button will increment the value
    $('.qtyplus').click(function(e){
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If is not undefined
        if (!isNaN(currentVal)) {
            // Increment
            $('input[name='+fieldName+']').val(currentVal + 1);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(0);
        }
    });
    // This button will decrement the value till 0
    $(".qtyminus").click(function(e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        fieldName = $(this).attr('field');
        // Get its current value
        var currentVal = parseInt($('input[name='+fieldName+']').val());
        // If it isn't undefined or its greater than 0
        if (!isNaN(currentVal) && currentVal > 0) {
            // Decrement one
            $('input[name='+fieldName+']').val(currentVal - 1);
        } else {
            // Otherwise put a 0 there
            $('input[name='+fieldName+']').val(0);
        }
    });
	
});