<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url()?>assets/plugins/images/favicon.png">
    <title><?php if(isset($page_title)){ echo $page_title; }else{ echo "no-title"; }?></title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url()?>assets/admin/css/lightslider.min.css" id="theme" rel="stylesheet">
     
    <link href="<?php echo base_url()?>assets/admin/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="<?php echo base_url()?>assets/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="<?php echo base_url()?>assets/admin/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url()?>assets/admin/css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="<?php echo base_url()?>assets/admin/css/colors/blue.css" id="theme" rel="stylesheet">
     <link href="<?php echo base_url()?>assets/plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
    <link href="<?php echo base_url()?>assets/plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    
     <link href="<?php echo base_url()?>assets/plugins/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/select2/select2.min.css">

    

    <link href="<?php echo base_url()?>assets/plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">

    <style type="text/css">

        #side-menu {
            padding-bottom: 80px;
        }

        .none-display{
            display: none;
        }

        .badge{
            margin-left: 10px;
            padding: 5px 12px !important;
            font-size: 10px !important;
            background-color: red !important;
            border-radius: 21px !important;
        }
        
        .imageUpload{
            display: none !important;
        }


        .text-align-right{
            text-align: right !important;
        }
      
        .none-display{
            display: none;
        }

        .badge{
            margin-left: 10px;
            padding: 5px 12px !important;
            font-size: 10px !important;
            background-color: red !important;
            border-radius: 21px !important;
        }


        .table td, .table th {
            border-top: 0px solid #eceeef !important;
        }

        .datepicker table tr td.disabled, .datepicker table tr td.disabled:hover {
            color: #c1c1c1 !important;
        }

    </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    
</head>


<body>
    <?php 
     /*   if($this->session->userdata(GLOBAL_MSG)!='') {
    ?>   
   <div id="snackbar"><?php echo $this->session->userdata(GLOBAL_MSG);?></div>
   <script type="text/javascript">
     var snackbar = document.getElementById("snackbar");
     snackbar.className = "show";
     setTimeout(function(){ snackbar.className = snackbar.className.replace("show", ""); }, 6000);
   </script>
   <?php
    $this->session->set_userdata(GLOBAL_MSG,'');    
    }
    */
  ?>
  
    <!-- Preloader -->
    <!-- <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div> -->
    
   


    <div id="wrapper">
        <!-- Navigation -->
    




    <?php include_once("nav-bar.php")?>       
        <!-- Left navbar-header end -->
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">


