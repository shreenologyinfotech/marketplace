<div class="bg-white">
<div class="page-title green-bg pt-3 pb-3">
  <div class="container">
   <div class="row">
    <div class="col col-8">
        <h2 class="text-uppercase text-white">Transaction History</h2>
    </div>
    <div class="col col-4"> <a  class="logoutbutton" href="<?php echo base_url()?>logout">Log out</a></div>
   </div>
  </div>
</div>
 
 <div class="innerpages pt-5 pb-5">
   <div class="container">
     <div class="row">
       <?php
        require_once("menus.php");
       ?>
       <div class="col col-md-9 col-12">
         <div class="table-responsive">
              <table class="main-datatable" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                          <th>Order Id</th>
                          <th>Date</th>
                          <th>Paid Amount</th>
                          <th>Refund Amount</th>
                          <th>Actions</th>
                      </tr>
                  </thead>
                  <tfoot>
                      <tr>
                          <th>Order Id</th>
                          <th>Date</th>
                          <th>Paid Amount</th>
                          <th>Refund Amount</th>
                          <th>Actions</th>
                      </tr>
                  </tfoot>
              </table>
            </div>
       </div>
     </div>
   </div>
 </div>
</div>    

    

  



 