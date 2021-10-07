<div class="col col-md-3 col-12 mb-4">
        <a class="green-bg text-white radius pt-3 pb-3 d-block mb-4 text-center h6" href="<?php echo base_url()?>createorder">Create New Order</a>
          <div class="sidebar-link">
           <h4 class="pt-4 pl-3 pb-2"><strong>My Account</strong></h4>
             <ul>
              <?php /*
              <li><a  class="<?php if($this->uri->segment(2) == 'profile'){ echo 'active-tab';}?>" href="<?php echo base_url()?>profile">My Profile</a></li> */ ?>
              
              <li><a href="<?php echo base_url()?>editprofile">Edit Profile</a></li>
              <li><a href="<?php echo base_url()?>transactionhistory">Transaction History</a></li>
              <li><a href="<?php echo base_url()?>trackyourorders">Track Your Orders</a></li>
              <li><a href="<?php echo base_url()?>useraddress">Shipping Address</a></li>
            <?php /*  <li><a href="<?php echo base_url()?>changepassword">Change Password</a></li> */ ?>
              <li><a href="<?php echo base_url()?>logout">Logout</a></li>
             </ul>
           </div>
</div>