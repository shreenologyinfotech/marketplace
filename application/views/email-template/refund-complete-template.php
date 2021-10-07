<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url()?>assets/plugins/images/favicon.png">
    <title><?php echo SITE_TITLE;?> : Refund completed</title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url()?>assets/admin/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="<?php echo base_url()?>assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- Morris CSS -->
    <link href="<?php echo base_url()?>assets/plugins/bower_components/morrisjs/morris.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="<?php echo base_url()?>assets/admin/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url()?>assets/admin/css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="<?php echo base_url()?>assets/admin/css/colors/blue.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
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
                            <div class="row">
                               <nav class="navbar navbar-expand-lg navbar-light top-menu pl-0 pr-0">
                                <a class="navbar-brand" href="javscript:void(0)"><img alt="Logo" src="<?php echo base_url()?>/assets/front/images/logo.jpg"></a>
                               </nav></br>
                                <div class="col-lg-10 col-md-9 col-sm-8 col-xs-12 mail_listing">
                                    <div class="media m-b-30 p-t-20">
                                        <div class="media-body"> 
                                            <p>Dear {{order.user}},</p></br>
                                            <p>We would like to inform you that your refund for Order {{order.order_id}} has been completed. Click the link below to view your order.</p></br>
                                            <a href="<?php echo base_url()?>vieworder/{{order.id}}" class="  btn-green  pl-4 pr-4 green-bg text-white mt-2"  style="color: white;"><strong>View Order</strong></a>
                                            <p><?php echo YOURS_SINCERELY;?></p>
                                            <p><?php echo CASHVERTISE_SUPPORT_TEAM;?></p>  
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
               
                <!-- /.right-sidebar -->
           
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->

        <!-- /#wrapper -->
    <!-- jQuery -->
   
</body>

</html>