<nav class="navbar navbar-default navbar-static-top m-b-0">
  <div class="navbar-header">
  <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="ti-menu"></i></a>
    <div class="top-left-part">
    <a class="logo" href="<?php echo base_url()?>admin/dashboard">
    <b><img src="<?php echo base_url()?>assets/plugins/images/eliteadmin-logo.png" alt="" /></b>
    <!--<span class="hidden-xs"><strong>cash </strong>vertise</span>--></a></div>
    
    <ul class="nav navbar-top-links navbar-left hidden-xs">
      <li><a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light"><i class="icon-arrow-left-circle ti-menu"></i></a></li>
      <!-- <li>
        <form role="search" class="app-search hidden-xs">
          <input type="text" placeholder="Search..." class="form-control">
          <a href=""><i class="fa fa-search"></i></a>
        </form>
      </li> -->
    </ul>
    <ul class="nav navbar-top-links navbar-right pull-right">
      <li class="dropdown"> <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <!-- <img src="<?php echo base_url()?>assets/plugins/images/users/1.jpg" alt="user-img" width="36" class="img-circle"> --><b class="hidden-xs"><?php echo  get_admin_details("admin_name");?></b> </a>
        <ul class="dropdown-menu dropdown-user animated flipInY">
          <li><a href="<?php echo base_url()?>admin/profile"><i class="ti-user"></i> My Profile</a></li>
          <li><a href="<?php echo base_url()?>adminchangepassword"><i class="ti-settings"></i> Change password</a></li>
          <li><a href="<?php echo base_url()?>admindashboard/logout"><i class="fa fa-power-off"></i> Logout</a></li>
        </ul>
      </li>
    </ul>
  </div>
  <!-- /.navbar-header --> 
  <!-- /.navbar-top-links --> 
  <!-- /.navbar-static-side --> 
</nav>
<!-- Left navbar-header -->
<div class="navbar-default sidebar" role="navigation">
  <div class="sidebar-nav navbar-collapse slimscrollsidebar">
    <ul class="nav" id="side-menu">
      <!-- <li class="sidebar-search hidden-sm hidden-md hidden-lg"> 
        <div class="input-group custom-search-form">
          <input type="text" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
          <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
          </span> </div>
      </li>
     -->  <!-- <li class="user-pro">
                        <a href="#" class="waves-effect"><img  src="<?php echo base_url()?>assets/plugins/images/users/1.jpg" alt="user-img" class="img-circle"> <span class="hide-menu">Prof. Steve Gection
                        <span class="fa arrow"></span></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li><a href="javascript:void(0)"><i class="ti-user"></i> My Profile</a></li>
                            <li><a href="javascript:void(0)"><i class="ti-settings"></i> Account Setting</a></li>
                            <li><a href="login.html"><i class="fa fa-power-off"></i> Logout</a></li>
                        </ul>
                    </li> -->
      <li> <a href="<?php echo base_url()?>admin/dashboard" class="waves-effect"><i class="linea-icon linea-basic fa-fw" data-icon="v"></i> <span class="hide-menu"> Dashboard </span></a></li>



      <li> <a href="#" class="waves-effect"><i class="fa fa-th-list"></i> <span class="hide-menu">Site Promotion<span class="fa arrow"></span> </span></a>
            <ul class="nav nav-second-level">
                <li><a href="<?php echo base_url()?>admin/addpromo">Add Promtion</a></li>
                <li><a href="<?php echo base_url()?>admin/managepromo">Manage Promtion</a></li>
            </ul>
      </li>

      <li> <a href="#" class="waves-effect"><i class="fa fa-users"></i> <span class="hide-menu">Manage Banners<span class="fa arrow"></span> </span></a>
      
        <ul class="nav nav-second-level">
          <li><a href="<?php echo base_url()?>admin/addbanner">Add New Banner</a></li>
          <li><a href="<?php echo base_url()?>admin/bannerlist">Banner List</a></li>
          <li><a href="<?php echo base_url()?>admin/bannerlistsearch">Home Side Banner</a></li>
        </ul>
     </li>


     <li> <a href="#" class="waves-effect"><i class="fa fa-users"></i> <span class="hide-menu">Brands<span class="fa arrow"></span> </span></a>
      
        <ul class="nav nav-second-level">
          <li><a href="<?php echo base_url()?>admin/addbrands">Add Brands</a></li>
          <li><a href="<?php echo base_url()?>admin/brandslist">Brands List</a></li>
        </ul>
     </li>

    <li> <a href="#" class="waves-effect"><i class="fa fa-users"></i> <span class="hide-menu">Users<span id="advertiserBadge" class="badge none-display"></span><span class="fa arrow"></span> </span></a>
        <ul class="nav nav-second-level">
          <!-- <li><a href="<?php echo base_url()?>admin/addstore">Add Store</a></li> -->
          <li><a href="<?php echo base_url()?>admin/stores">Stores</a></li>
          <li><a href="<?php echo base_url()?>admin/users">Users</a></li>
        </ul>
    </li>

     <li> <a href="#" class="waves-effect"><i class="fa fa-users"></i> <span class="hide-menu">Category<span class="fa arrow"></span> </span></a>
      
        <ul class="nav nav-second-level">
          <li><a href="<?php echo base_url()?>admin/addhomecategory">Add Category</a></li>
          <li><a href="<?php echo base_url()?>admin/homecategorylist">Category List</a></li>
        </ul>
     </li>


     <li> <a href="#" class="waves-effect"><i class="fa fa-users"></i> <span class="hide-menu">Sub Category<span class="fa arrow"></span> </span></a>
        <ul class="nav nav-second-level">
          <li><a href="<?php echo base_url()?>admin/addsubcategory">Add New Sub Category</a></li>
          <li><a href="<?php echo base_url()?>admin/subcategorylist">List Sub Category</a></li>
        </ul>
     </li>


      <li> <a href="#" class="waves-effect"><i class="fa fa-users"></i> <span class="hide-menu">Products<span class="fa arrow"></span> </span></a>
      
        <ul class="nav nav-second-level">
          <!-- <li><a href="<?php // echo base_url()?>admin/addproduct">Add Product</a></li> -->
          <li><a href="<?php echo base_url()?>admin/productlist">Product List</a></li>
        </ul>
     </li>
     
        <li> <a href="<?php echo base_url()?>admin/orders" class="waves-effect"><i class="fa fa-shopping-cart"></i> <span class="hide-menu">Order </span><span id="contactBadge" class="badge none-display"></span></a></li>
     
        <li> <a href="<?php echo base_url()?>admin/contacts" class="waves-effect"><i class="fa fa-comment"></i> <span class="hide-menu">Contact Form </span><span id="contactBadge" class="badge none-display"></span></a></li>
        
 

     <li> <a href="<?php echo base_url()?>admin/newsletters" class="waves-effect"><i class="fa fa-newspaper-o"></i> <span class="hide-menu">New Letter </span></a></li>
      


          <li> <a href="#" class="waves-effect"><i class="fa fa-th-list"></i> <span class="hide-menu">Site Content Settings<span class="fa arrow"></span> </span></a>
                <ul class="nav nav-second-level">
                    <li><a href="<?php echo base_url()?>pages">Webpage Content</a></li>
                    <li><a href="<?php echo base_url()?>pages/retail">Retail Page Content</a></li>
                    
                    <?php /*
                    <li><a href="<?php echo base_url()?>admin/managefooter">Manage Footer</a></li>
                    <li><a href="<?php echo base_url()?>admin/manageblockfooter">Manage Footer Blocks</a></li>
                    <li><a href="<?php echo base_url()?>admin/sitefaq">Manage Site FAQ</a></li>*/ ?> 
                </ul>
          </li>
       
       <li> <a href="<?php echo base_url()?>sitesetting" class="waves-effect"><i class="fa fa-gear"></i> <span class="hide-menu">General settings </span></a></li>
       
       <?php /*
       <li> <a href="#" class="waves-effect"><i class="fa fa-th-list"></i> <span class="hide-menu">Other Settings <span class="fa arrow"></span> </span></a>
            <ul class="nav nav-second-level">
                 <li><a href="<?php echo base_url()?>locations">Advert Locations</a></li>
            </ul>
       </li> 
       */?> 
       
    </ul>
  </div>
</div>

