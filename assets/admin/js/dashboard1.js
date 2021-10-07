

function submitForm(formId,title,message){

  swal({
        title: title,
        text: message,
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-success",
        confirmButtonText: "Yes",
        showLoaderOnConfirm: true,
        closeOnConfirm: false,
      },
      function() {
          $(formId).submit();
      });
}



function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     /*var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;
     window.print();
     document.body.innerHTML = originalContents;
     */
     w=window.open();
     w.document.write(printContents);
     w.print();
     w.close();
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
    $("#zip-postal-area").hide();    
}



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
               var response = "<option value=''>select postal code</option>";
               $("#dl_postal_code").html(response);
           }else{
               $("#dl_postal_code").html(data);
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


function performActionWithRedirection(actionUrl,title,message,successTitle,redirectUrl){    
            var headingTitle = "Success!";
            if(title == "Activate Advertiser?"){
                headingTitle = "Activated!";
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