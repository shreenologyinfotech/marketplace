<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url()?>assets/plugins/images/favicon.png">
    <title><?php echo SITE_TITLE;?> : Reply Contact Us</title>
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
                                            <p style="text-align: left" class="text-left">Hi {{contact.name}},</p>
                                            <p style="text-align: left" class="text-left">{{contact.message}}</p>
                                            <p style="text-align: left" class="text-left"><?php echo YOURS_SINCERELY;?></p>
                                            <p style="text-align: left" class="text-left"><?php echo CASHVERTISE_SUPPORT_TEAM;?></p>

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
    <script src="<?php echo base_url()?>assets/plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url()?>assets/admin/bootstrap/dist/js/tether.min.js"></script>
    <script src="<?php echo base_url()?>assets/admin/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>assets/plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="<?php echo base_url()?>assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="<?php echo base_url()?>assets/admin/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo base_url()?>assets/admin/js/waves.js"></script>
    <!--Morris JavaScript -->
    <script src="<?php echo base_url()?>assets/plugins/bower_components/raphael/raphael-min.js"></script>
    <script src="<?php echo base_url()?>assets/plugins/bower_components/morrisjs/morris.js"></script>
    <!-- Sparkline chart JavaScript -->
    <script src="<?php echo base_url()?>assets/plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="<?php echo base_url()?>assets/plugins/bower_components/jquery-sparkline/jquery.charts-sparkline.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url()?>assets/admin/js/custom.min.js"></script>
    <script src="<?php echo base_url()?>assets/admin/js/dashboard1.js"></script>
    <!--Style Switcher -->
    <script src="<?php echo base_url()?>assets/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>