<html class="">
<head>
   <link rel="stylesheet" media="all" href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&amp;family=Montserrat:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&amp;display=swap">
   <link rel="stylesheet" media="all" href="https://fonts.googleapis.com/icon?family=Material+Icons">
   <link rel="stylesheet" media="all" href="<?php echo base_url()?>assets/front/webpack/common-front.css">
   <script src="<?php echo base_url()?>assets/front/webpack/client-js.js"></script>
   <script src="https://d14rc3dywal1lf.cloudfront.net/production/bikeexchange/en-AU-be-WY-gP47Z0Fj6iOjJMUOMdI_Plco.js"></script>

   <link href="<?php echo base_url()?>assets/plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
   


   <title>
      <?php if(isset($page_title)){ echo $page_title; }else{ echo "no-title"; }?>
   </title>
   <link href="/favicon.ico" rel="shortcut icon"> 

   <style>
      
        .banner_image{
          max-height: 300px;
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


      
   </style>

</head>

<body class="loggedin" id="en-AU-be">
   <div class="topbar">
      <div class="row grid-middle">
         <div class="col-xs-6"> <a class="brand logo" href="<?php base_url().'/myaccount'?>"><img class="svg" src="<?php echo base_url()?>uploads/logo.png"></a> </div>
         <div class="col-xs-6 u-right">
            <div class="BusinessNav">
               <div class="BusinessName">
                  <?php echo get_store_key_value("store_name");?>
               </div>
               <div class="ClientSettingsMenu">
                  <div data-react-class="ClientSettingsMenu" data-react-props="{&quot;accountSettingsLink&quot;:&quot;<?php echo base_url().'myaccount/settings'?>&quot;,&quot;displayDeleteAccountLink&quot;:false,&quot;deleteAccountLink&quot;:&quot;/client/email/delete_me&quot;}" >
                     <div>
                        <button class="ClientSettingsMenu-btn ClientSettingsMenu-btn--iconVertical t-ClientSettingsMenuButton" title="Menu"></button>
                        <div class="ClientSettingsMenu-listContainer is-sidebarHidden">
                           <ul class="ClientSettingsMenu-list t-ClientSettingsMenu"> 
                              <a class="ClientSettingsMenu-link" href="<?php echo base_url().'myaccount'?>">Account Settings</a>

                              <a class="ClientSettingsMenu-link" href="/client/email/delete_me">Delete My Account</a> 
                              <hr> 
                              <a class="ClientSettingsMenu-link" href="<?php echo base_url().'/logoutmyaccount'?>" data-method="delete">Logout<span class="clientSettingsMenu-icon clientSettingsMenu-icon--logoutIcon"></span></a> 
                           </ul>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="wrapper">
    

      <div class="aside no-print">
         <ul class="nav nav-list unstyled">
            <li class="nav-header"><a href="<?php echo base_url().'myaccount'?>">Home</a></li>
            
            <?php if(login_user_type() == "S"){ ?>
              <li><a href="<?php echo base_url().'myaccount/updatestoredetails'?>"><?php if(login_user_type() == "S"){ ?>Store <?php } ?>Profile</a></li>
            <?php }else{ ?>

              <li><a href="<?php echo base_url().'myaccount/settings'?>"><?php if(login_user_type() == "S"){ ?>Store <?php } ?>Profile</a></li>



            <?php } ?>
            


            <?php if(login_user_type() == "S"){ ?>
            <li>
               <?php if(!is_store_details_updated()){ ?>
                  <a href="<?php echo base_url().'myaccount/settings'?>">New product advert</a>
               <?php  }else{ ?>
                  <a href="<?php echo base_url().'myaccount/addproducts'?>">New product advert</a>
              <?php } ?>
            </li>

            


            <li>
               <?php if(!is_store_details_updated()){ ?>
                  <a href="<?php echo base_url().'myaccount/settings'?>">My advert</a>
               <?php  }else{ ?>
                  <a href="<?php echo base_url().'myaccount/listproducts'?>">My advert</a>

              <?php } ?>

            </li>

            <li>
                  <a href="<?php echo base_url().'myaccount/myorders'?>">My orders</a>
            </li>

            <li>
                  <a href="<?php echo base_url().'myaccount/enquiery'?>">My Enquiery</a>
            </li>
          
          <?php }?>
          

            <li>
               <hr> </li>
            <!-- <li><a href="/client/consumer_invoices">Purchase history</a></li> -->

            <li class="nav-list-footer"> <span class="nav-list-footerText">Powered by</span> <img alt="Marketplacer" class="nav-list-footerLogo" src="<?php echo base_url()?>uploads/logo.png"> </li>
         </ul>
      </div>




