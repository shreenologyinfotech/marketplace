<?php 
$homeCagory = get_home_category_images(); 
$homeVisibleCategory = get_home_category();
?>


<!DOCTYPE html>
<html lang='en-US'>
   <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <head itemtype=''>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php if(isset($page_title)){ echo $page_title; }else{ echo "no-title"; }?></title>
    
   <link rel="stylesheet" media="all" href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&amp;family=Montserrat:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&amp;display=swap" />
   <link rel="stylesheet" media="all" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
   <link rel="stylesheet" media="all" href="<?php echo base_url()?>assets/front/assets/consumer-2dbf37c1115357bd22abf0359786a31031e42c62c83814ba0cee1bad4d39f8de.css" />
   <link rel="stylesheet" media="all" href="<?php echo base_url()?>assets/front/webpack/common-2f168f6f03bef8c48148.css" />
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
   <link rel="stylesheet" media="all" href="<?php echo base_url()?>assets/front/webpack/pagebuilder.css" />
   <script src="<?php echo base_url()?>assets/front/webpack/ga_utils-441b0fa97fd6804601fe.js"></script>
   <script type="application/javascript" src="<?php echo base_url()?>assets/front/webpack/pt_config.js"></script>
   <script type="application/javascript" src="<?php echo base_url()?>assets/front/assets/store-js.js"></script>
   <link href="<?php echo base_url()?>assets/plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">

   
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
   <style>


         div[aria-label="Carousel Pagination"] button[data-action="stop"] {
           display: none;
         }

         .CPageContainer.is-searchActiveDesktop .CHeaderSearch-outer{
            height: 70px;
         }
         .bg-white{
            text-align: center;
            padding: 20px;
         }
        .HeroSlide-imageInner {
             max-height: 300px;
         } 
         .PostFooter-logo{
            height: 50px !important;
         }

         .red-border{
            border : 1px solid red;
         }
         .ContentBlock{
            width: 100% !important;
         }


         .TileSliderContainer.is-loading{
           opacity : 1; 
         }

         .PromotionBanner{
            padding : 3px !important;
         }

         .PostFooter-inner{
            background: black !important;
         }

         .PostFooter-column{
            background: black !important;
         }


         #brand_id{
             color: #13c8d1;
         }
         
         .CountryPickerDropdown-itemLink{
            color: #000 !important;
         }

   </style>

   <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/61432b5625797d7a89ff4a65/1ffn62jkg';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->


   
   </head>


   <body class='marketplace t-marketplaceLayout theme-fontFamilies' id='en-US-be'>
      <div class='body'>
          <div class='CPageContainer  is-searchActiveDesktop'>
            <div class='CMasterHeader'>
               <div class='CPreHeader CPreHeader--themed'>
                  <div class='CPreHeader-inner'>
                  
                     <div class='CPreHeader-menu t-navIcon is-activeDesktop' style="">
                        <a class="CPreHeader-logoLink" title="BikeExchange Home Page" href="<?php echo base_url()?>"><img alt="BikeExchange" class="svg CPreHeader-logo" src="<?php echo base_url()?>uploads/logo.png" />
                        </a>
                     </div>
               
                     <div onclick="toggleMenu()" class='CPreHeader-search is-activeDesktop' data-ga-nav-event='toggle-main-nav-search'>
                        <div class='t-preHeaderSearchIcon CPreHeader-searchIcon'></div>
                     </div>
                     <div class='CPreHeader-logoContainer'>
                       <?php /* <a class="CPreHeader-logoLink" title="BikeExchange Home Page" href="<?php echo base_url();?>"><img alt="BikeExchange" class="svg CPreHeader-logo" src="<?php echo base_url()?>uploads/logo.png" />
                        </a>
                       */ ?>
                     </div>
                    
                   
                     <div class='CPreHeader-nav'>
                        <a data-teg-ga-events="private ad link:top navigation" class="btn-sell-bike GAEventClick CPreHeader-navLink CPreHeader-sell" data-ga-nav-event="place-an-ad" href="<?php echo base_url().'new-retailer-account'; ?>"><?php echo $this->lang->line('Create your store'); ?></a>
                        <a class="CPreHeader-navLink" data-ga-nav-event="find-a-store" href="<?php echo base_url();?>storelocator"><?php echo $this->lang->line('Find your provider'); ?></a>
                        <!--<a class="CPreHeader-navLink" data-ga-nav-event="blog" href="javascript:void(0)">Blog</a> -->
                     </div>

                 
                     

                     <div class='CPreHeader-login'>
                        <ul class="MainNav-itemWrapper">
                           <?php
                             if(is_store_login()){ ?>
                                 <?php if(login_user_type() == "S"){ ?>
                                    <li class="MainNav-item"><a class="MainNav-itemLink t-sign-in" href="<?php echo base_url().'myaccount'; ?>"><strong><?php echo $this->lang->line('My Account'); ?></strong></a></li>
                                 <?php }else{ ?>

                                       <li class="MainNav-item"><a class="MainNav-itemLink t-sign-in" href="<?php echo base_url().'profile/editprofile'; ?>"><strong><?php echo $this->lang->line('My Account'); ?></strong></a></li>

                                 <?php }?>
                                 

                                 <li class="MainNav-item"><a class="MainNav-itemLink t-join-us" href="<?php echo base_url().'/myaccount/signout'?>"><strong><?php echo $this->lang->line('Sign out'); ?> (<?php echo login_user_name();?>) </strong></a></li>

                           <?php }else{ ?>

                              <li class="MainNav-item"><a class="MainNav-itemLink t-sign-in" href="javascript:void(0)" onclick='showSignInModel("buy")'><strong> To buy</strong></a></li>

                              <li class="MainNav-item"><a class="MainNav-itemLink t-sign-in" href="javascript:void(0)" onclick='showSignInModel("sell")'><strong> To sell</strong></a></li>

                           <?php /*   
                              <li class="MainNav-item"><a onclick='showRegisterModel()' class="MainNav-itemLink t-join-us" href="javascript:void(0)"><strong>Join us</strong></a></li>
                            */ ?>

                           <?php } ?>
                        </ul>
                     </div>



                     <div class='CPreHeader-utilities'>
                        <div>
                           <a class="CPreHeader-saved CPreHeader-utility" href="<?php echo base_url();?>favourite" title="Wish List"><i class="CPreHeader-savedCounterIcon"><span class="t-wishListCount Bubble">0</span></i></a>
                        </div>
                        <div ><a class="CPreHeader-cart CPreHeader-utility t-cart" href="<?php echo base_url();?>cart" title="Shopping Cart"><i class="CPreHeader-cartCounterIcon"><span class="t-cartItemCount Bubble">0</span></i></a>
                        </div>
                     </div>
                  </div>
               </div>




               <div class='CHeader'>
                  <div id="searchmobile" class='CHeaderSearch is-openDesktop is-desktopOpenActive'>
                     <div class='CHeaderSearch-outer'>
                     <div class='CHeaderSearch-inner'>
                        
                           <form action="<?php echo base_url()?>searchpost" method="post" class="MainSearch MainSearch--productVariation">
                              <div class="MainSearch-inner">
                                 <div class="MainSearchField MainSearchField--location">
                                    <div class="MainSearchField-select">

                                       <label class="MainSearchField-label" id="downshift-1-label" for="x037c8bb6-079e-4a86-8ea4-7b2776e7ae4d"><?php echo $this->lang->line('Brands'); ?></label>

                                       <div role="combobox" aria-haspopup="listbox" aria-owns="downshift-1-menu" aria-expanded="false">

                                          <div class="Select">
                                          <select  onchange="getcategory()" name = "input_cbt" id="brand_id">
                                                <option value=""> Pick a brand</option>
                                                <?php 
                                                   $brands = get_brands();
                                                   foreach ($brands as $resultObj){ ?>

                                                   <option <?php if($resultObj->brand_id == $this->uri->segment(4)){ echo "selected";}?> value="<?php echo $resultObj->brand_id;?>"><?php echo $resultObj->brand_name;?></option>          
                                                <?php 
                                                  }
                                                ?>
                                          </select>
                                       </div>
                                       </div>
                                       
                                    </div>
                                 </div>
                                 <div class="MainSearch-locationAndDistance">
                                    <div class="MainSearchField MainSearchField--location">
                                       <div class="MainSearchField-select">
                                          <label class="MainSearchField-label" id="downshift-3-label" for="xd9654a63-5533-467f-88c9-87b9590b8ff1"><?php echo $this->lang->line('Category'); ?></label>
                                          
                                             <div class="Select">
                                                <select onchange="getsubcategory()" name = "input_csz" id="dl_category_id">
                                                      <option value="">Pick a category</option>
                                                      <?php 

                                                         $brand_id         = "0";
                                                         if($this->uri->segment(1) == "search"){
                                                          $brand_id            = $this->uri->segment(4);
                                                         }

                                                         $category         = get_all_category_by_brand($brand_id);
                                                         foreach ($category as $resultObj){ ?>

                                                         <option <?php if($resultObj->category_id == $this->uri->segment(5)){ echo "selected";}?> value="<?php echo $resultObj->category_id;?>"><?php echo $resultObj->category_name;?></option>          
                                                      <?php 
                                                        }
                                                        
                                                      ?>
                                                </select>
                                          </div>
                                             
                                       </div>
                                    </div>
                                    <div class="MainSearchField MainSearchField--location">
                                       <label class="MainSearchField-label" for="xe4fc65cd-c06e-48a6-8313-28b59d310442"><?php echo $this->lang->line('Sub Category'); ?></label>
                                       <div class="MainSearchField-select">
                                          <div class="Select">
                                             <select id="sub_category_id" name="sub_category_id">
                                                <?php
                                                   $category_id         = $this->uri->segment(5);
                                                   $subCategoryData     = get_subcategory_by_category_id($category_id);
                                                ?>

                                                <option value="">Pick Sub Category</option>
                                                <?php 
                                                   foreach ($subCategoryData as $resultObj){ ?>

                                                   <option <?php if($resultObj->sub_category_id == $this->uri->segment(6)){ echo "selected";}?> value="<?php echo $resultObj->sub_category_id;?>"><?php echo $resultObj->sub_category_name;?></option>          
                                                <?php 
                                                  }
                                                ?>
                                                
                                             </select>
                                          </div>
                                       </div>
                                    </div>

                                    <div class="MainSearchField MainSearchField--keyword">
                                       <div class="MAutoCompleteField">
                                          <label class="MainSearchField-label" id="downshift-3-label" for="x7af654dc-eadc-409b-af36-e3474b81628c"><?php echo $this->lang->line('Product Name'); ?></label>
                                          
                                             <input value="<?php echo urldecode($this->uri->segment(7));?>" name="product_title" id="x7af654dc-eadc-409b-af36-e3474b81628c" aria-autocomplete="list" aria-controls="downshift-3-menu" aria-labelledby="downshift-3-label" autocomplete="off" placeholder="Product Name" type="text" value="">

                                          
                                       </div>
                                    </div>



                                 </div>
                              </div>
                              <div class="MainSearch-buttonWrapper">
                                 <button type="submit" class="btn btn-primary MainSearch-button"><?php echo $this->lang->line('Search'); ?></button>
                              </div>
                           </form>
                        
                     </div>
                  </div>
                  <nav class='CNav' style='display:none'>
                     <div class='CNav-inner is_navActiveDesktop'>

                        <?php
                        //$counter = 1;
                        //foreach ($homeCagory  as $homeCagoryObj){ ?>
                        <div class='CNav-name t-navItem'>
                           <?php //echo $homeCagoryObj->category_name; ?>
                        </div>
                        <?php // } ?>
                     </div>


                  </nav>
               </div>
               <div class='CNavMenu'>
                  <div class='CNavMenu-outer'>
                     <div class='CNavMenu-inner'>

                       
                        
                        
                        <div class='CNavMenu-utilities'>
                           <div class='CNavMenu-login CNavMenu-utility'>
                              <div>
                                 <ul class="MainNav-itemWrapper">
                                    <?php
                                      if(is_store_login()){ ?>

                                          <?php if(login_user_type() == "S"){ ?>
                                             <li class="MainNav-item"><a class="MainNav-itemLink t-sign-in" href="<?php echo base_url().'myaccount'; ?>"><strong><?php echo $this->lang->line('My Account'); ?></strong></a></li>
                                          <?php }else{ ?>
                                               <li class="MainNav-item"><a class="MainNav-itemLink t-sign-in" href="<?php echo base_url().'profile/editprofile'; ?>"><strong><?php echo $this->lang->line('My Account'); ?></strong></a></li>
                                          <?php }?>
                                          
                                          <li class="MainNav-item"><a class="MainNav-itemLink t-join-us" href="<?php echo base_url().'./myaccount/signout'?>"><strong><?php echo $this->lang->line('Sign out'); ?> (<?php echo login_user_name();?>) </strong></a></li>

                                    <?php }else{ ?>

                                       <li class="MainNav-item"><a class="MainNav-itemLink t-sign-in" href="javascript:void(0)" onclick='showSignInModel("buy")'><strong>To buy</strong></a></li>

                                       <li class="MainNav-item"><a class="MainNav-itemLink t-sign-in" href="javascript:void(0)" onclick='showSignInModel("sell")'><strong>To sell</strong></a></li>


                                       <?php /* 
                                       <li class="MainNav-item"><a onclick='showRegisterModel()' class="MainNav-itemLink t-join-us" href="javascript:void(0)"><strong>Join us</strong></a></li>
                                       */ ?>

                                    <?php } ?>
                                 </ul>
                              </div>
                           </div>
                        </div>
                        <div class='CNavMenu-nav'>
                           <a class="CNavMenu-navLink" data-ga-nav-event="find-a-store" href="<?php echo base_url();?>storelocator">Find your provider</a>
                           <!-- <a class="CNavMenu-navLink" data-ga-nav-event="blog" href="javascript:void(0)">Blog</a> -->
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class='CLayout-contentOuter'>
               <div class='CLayout-contentInner'>


<?php
   if($show_promotion){ ?>





<!-- promo text -->                  
                  <div class='PromotionBanner promo-background'>
                     <ul class='PromotionBanner-list'>
                        <li class='PromotionBanner-listItem'>
                           <?php
                             $data = get_promotions();
                             foreach ($data as $promoObj){ ?>
                              <span class='PromotionBanner-listItem-text'>
                                 <a target='_blank' class='PromotionBanner-link' href='<?php echo $promoObj->promo_link; ?>'><?php echo $promoObj->promo_text; ?></a>
                              </span>
                             <?php  } ?>
                        </li>
                     </ul>
                  </div>
 <!-- promo text -->                  

<?php   } ?>



<?php 
        if($this->session->userdata(GLOBAL_MSG)!='') {
        $message = $this->session->userdata(GLOBAL_MSG); 
        $this->session->set_userdata(GLOBAL_MSG,'');
    ?>  
        <div style="margin:5px;" class="alert alert-error"><?php echo $message; ?></div>
    <?php 
        } 
   
        if($this->session->userdata(GLOBAL_MSG_FRONT)!='') {
        $message = $this->session->userdata(GLOBAL_MSG_FRONT); 
        $this->session->set_userdata(GLOBAL_MSG_FRONT,'');
    ?>  
        <div style="margin:5px;" class="alert alert-error"><?php echo $message; ?></div>
    <?php 
        } 
    ?>





    
