<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url()?>assets/plugins/images/favicon.png">
    <title><?php echo SITE_TITLE;?> : Thankyou</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url()?>assets/admin/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
  
    <!-- Custom CSS -->
    <link href="<?php echo base_url()?>assets/admin/css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="<?php echo base_url()?>assets/admin/css/colors/blue.css" id="theme" rel="stylesheet">
      
   <style>
    .btn-green{
       background:#32a56f;
       padding: 10px;
       margin-left: auto;
       margin-right: auto;
       display: block;
       margin-bottom: 0%;
       width: 185px;
       margin-top: 20px !important;
       text-align: center;
       color:#fff;

    }
    a.btn-green:visited{ color:#fff}
   </style>
    
</head>

<body>
  
<div id="wrapper">
  <div class="innerpages">
   <div class="container">
     <div class="row justify-content-center">
       <div class="col col-md-7 col-12">
         <div class="bg-light shadow p-5 mt-5 mb-5 rounded">
          <div class="mb-5 text-center">
           <h1 class="mb-4 mt-5 greentxt text-capitalize"><strong><?php echo EMAIL_VERIFICATION_SUCCESS_TITLE;?></strong></h1>
           <p><?php echo EMAIL_VERIFICATION_SUCCESS_SUB_TITLE;?></p>  
           <br>
           <?php if($showLogin) { ?>
              <a href="<?php echo base_url()?>login" class="btn-green  pl-4 pr-4 green-bg text-white mt-2"  style="color: white;"><strong>Login to CashVertise</strong></a>
           <?php } ?>
           </div>    
         </div>
       </div>
     </div>
   </div>
 </div>         
</div>
</body>

</html>