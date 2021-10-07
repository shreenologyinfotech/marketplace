<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url()?>assets/plugins/images/favicon.png">
    <title><?php echo SITE_TITLE;?> : {{title}}</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url()?>assets/admin/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
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
        
           
                <!-- row -->
                <div class="row">
                    <!-- Left sidebar -->
                    <div class="col-md-12">
                        <div class="white-box">
                          
                          <nav class="navbar navbar-expand-lg navbar-light top-menu pl-0 pr-0">
                            <a class="navbar-brand" href="javscript:void(0)"><img src="<?php echo base_url()?>assets/front/images/logo.jpg"></a>
                          </nav></br>
                            <div class="row">
                                <div class="col-lg-10 col-md-9 col-sm-8 col-xs-12 mail_listing">
                                    <p>Dear {{to.name}}</p>
                                    <p>{{to.message}}</p>
                                    <p><?php echo YOURS_SINCERELY;?></p>
                                    <p><?php echo CASHVERTISE_SUPPORT_TEAM;?></p>
                                                
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