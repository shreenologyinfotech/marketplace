<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url()?>assets/plugins/images/favicon.png">
    <title><?php echo SITE_TITLE;?> : Email Verification</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url()?>assets/admin/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/admin/css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="<?php echo base_url()?>assets/admin/css/colors/blue.css" id="theme" rel="stylesheet">
   
   <style>
    .btn-green{
       padding: 10px;
       margin-left: auto;
       margin-right: auto;
       display: block;
       margin-bottom: 0%;
       width: 185px;
       margin-top: 20px !important;
       text-align: center;
       color:white;
       text-decoration:none;
       background:#216C2A;
       color:#fff;
    }
    a.btn-green:visited{ color:#fff}
   </style>
</head>

<body>

    <div id="wrapper">
        
           
                <!-- row -->
                <div class="row">
                    <!-- Left sidebar -->
                    <div class="col-md-12">
                        <div class="white-box">
                          
                          <nav class="navbar navbar-expand-lg navbar-light top-menu pl-0 pr-0">
                            <a class="navbar-brand" href="javscript:void(0)"><img  alt="Logo"  src="<?php echo base_url()?>/assets/front/images/logo.jpg"></a>
                          </nav></br>
                            <div class="row">
                                <div class="col-lg-10 col-md-9 col-sm-8 col-xs-12 mail_listing">
                                    <p>Dear {{to.name}}</p>
                                    <p><?php echo EMAIL_VERIFICATION_TITLE_HEADING_APP_USER; ?></br></p>
                                    <p><?php echo YOURS_SINCERELY;?></p>
                                    <p><?php echo CASHVERTISE_SUPPORT_TEAM;?></p>
                                    <a href="{{verify.link}}" class="btn-green  pl-4 pr-4 green-bg text-white mt-2"  style="color: white;"><strong>Verify Your Email</strong></a>
                               </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
               
                <!-- /.right-sidebar -->
           
        <!-- /#page-wrapper -->
    </div>
</body>

</html>