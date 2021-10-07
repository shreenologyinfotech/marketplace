<?php
   $title     = "User Details";
   $listTitle = "User Details";
   
   $fName          = "";
   $lName          = "";
   $username       = "";
   $email          = "";
   $companyName    = "";
   $contact        = ""; 
   $id             = "";
   $payment_mode   = "";
   $gender         = "";
   $date_of_birth  = "";
   $employment_status_id = "";
   $martial_status = "";
   $unit_number    = "";
   $package_id     = "";
   $status         = "";



   if(count($data) > 0){
          $fName          = $data[0]->fname;
          $lName          = $data[0]->lname;
          $email          = $data[0]->email;
          $contact        = $data[0]->contact_number;
          $companyName    = $data[0]->company_name;
          $id             = $data[0]->id;

          $payment_mode   = $data[0]->payment_mode; 
          $gender         = $data[0]->gender;
          $username       = $data[0]->username;
          $date_of_birth  = $data[0]->date_of_birth;
          $employment_status_id = $data[0]->employment_status_id;
          $martial_status = $data[0]->martial_status;
          $unit_number    = $data[0]->unit_number;
          $package_id     = $data[0]->package_id;
          $status         = $data[0]->status;
   }
?>


<div class="row bg-title">
    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
        <h4 class="page-title"><?php echo $title;?></h4> </div>
    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url()?>admin/dashboard"><?php echo SITE_TITLE ;?></a></li>
            <li class="active"><?php echo $listTitle;?></li>
        </ol>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<!-- /.row -->


<div class="form-group">
          <?php /*
            if($status == "Pending"){
          ?>
              <button onclick="performAction('<?php echo base_url()?>users/approve/<?php echo  $id;?>','Are you sure!','You want to Approve this user!!','user approved successfullly')" type="submit" class="btn btn-success waves-effect waves-light m-r-10">Approve</button>
          <?php
              }
              if($status != "Deleted"){
           ?> 
           <button onclick="performAction('<?php echo base_url()?>users/delete/<?php echo  $id;?>','Are you sure!','You want to Delete this user!!','user Deleted successfullly')" type="submit" class="btn btn-danger waves-effect waves-light m-r-10">Delete</button>

           <?php
              }else if($status == "Deleted"){
            ?>    
            <button onclick="performAction('<?php echo base_url()?>users/approve/<?php echo  $id;?>','Are you sure!','You want to active this user!!','user active successfullly')" type="submit" class="btn btn-success waves-effect waves-light m-r-10">Activate</button>
          <?php  }
          
          */
          ?>
          <a href="<?php echo base_url()?>admin/users" class="btn btn-inverse waves-effect waves-light">Back</a>
      </div>


<div class="row white-box col-sm-10 col-xs-12">
  
  <div class="col-sm-12">

                        <div class="white-box">
                            <?php
                              $packagesDetails = get_packages_from_id($package_id);
                              if(sizeof($packagesDetails) > 0){
                            ?>
                              <div class="row">
                                <div class="col-sm-3 col-xs-12"><h3 class="box-title"><?php echo "User Name     : ".$username;?></h3>
                                </div>
                                <div class="col-sm-3 col-xs-12"><h3 class="box-title"><?php echo "Level     : ".$packagesDetails[0]->level;?></h3>
                                </div>
                                <div class="col-sm-3 col-xs-12"><h3 class="box-title"><?php echo "Tier      : ".$packagesDetails[0]->tier;?></h3>
                                </div>
                                <div class="col-sm-3 col-xs-12"><h3 class="box-title"><?php echo "Per Flyer : ".$packagesDetails[0]->per_flyer;?></h3></div>
                                </div>
                              </div>
                                
                            <?php }?>

                            <!-- Nav tabs -->
                            <ul class="nav customtab nav-tabs" role="tablist">
                                <li role="presentation" class="nav-item"><a href="#home1" class="nav-link active" aria-controls="home" role="tab" data-toggle="tab" aria-expanded="true"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">Profile</span></a></li>
                                <li role="presentation" class="nav-item"><a href="#profile1" class="nav-link" aria-controls="profile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-user"></i></span> <span class="hidden-xs">Payment details</span></a></li>
                                <li role="presentation" class="nav-item"><a href="#messages1" class="nav-link" aria-controls="messages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-email"></i></span> <span class="hidden-xs">Interests</span></a></li>

                                <?php /*
                                <li role="presentation" class="nav-item"><a href="#settings1" class="nav-link" aria-controls="settings" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-settings"></i></span> <span class="hidden-xs">Address</span></a></li>
                                */ ?>

                                <!-- <li role="presentation" class="nav-item"><a href="#mobile" class="nav-link" aria-controls="mobile" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-settings"></i></span> <span class="hidden-xs">Mobile</span></a></li> -->
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade active in" id="home1">
                                  <div class="col-sm-12">
                                      
                                      <div class="form-group">
                                        <label class="control-label">User Name </label>
                                        <input readonly type="text" value="<?php echo $username?>" required id="username" name="username" class="form-control" placeholder="User Name">
                                      </div>


                                      <div class="form-group">
                                        <label class="control-label">First Name</label>
                                        <input readonly  type="text" value="<?php echo $fName;?>" required id="firstName" name="firstName" class="form-control" placeholder="First Name">
                                      </div>
                                      
                                      <div class="form-group">
                                        <label class="control-label">Last Name</label>
                                        <input readonly  type="text" value="<?php echo $lName;?>" required id="lastName" name="lastName" class="form-control" placeholder="Last Name">
                                      </div>

                                      <div class="form-group">
                                        <label class="control-label">Email</label>
                                        <input readonly  type="email" value="<?php echo $email;?>" required id="email" name="email" class="form-control" placeholder="Email">
                                      </div>

                                      <div class="form-group">
                                        <label class="control-label">Gender</label>
                                         <input readonly  type="text" value="<?php echo $gender;?>" required id="email" name="email" class="form-control" placeholder="Email">
                                      </div>


                                       <div class="form-group">
                                        <label class="control-label">Dob</label>
                                        <input readonly type="text" value="<?php echo $date_of_birth;?>" required id="date_of_birth" name="date_of_birth" class="form-control dob" placeholder="Date Of Birth">
                                      </div>


                                      <div class="form-group">
                                        <label class="control-label">Martial Status</label>
                                        <input type="text" readonly value="<?php echo $martial_status;?>" required class="form-control">
                                    
                                      </div>

                                       <div class="form-group">
                                        <label class="control-label">Payment Mode</label>
                                         <input type="text" readonly value="<?php echo $payment_mode;?>" required class="form-control">
                                      </div>


                                      <div class="form-group">
                                          <label class="control-label">Employment</label>
                                          <input type="text" readonly value="<?php echo get_employement_from_id($employment_status_id);?>" required class="form-control">
                                      </div>

                                      <div class="form-group">
                                        <label class="control-label">Unit Number</label>
                                        <input type="text" readonly  value="<?php echo $unit_number;?>" required id="unit_number" name="unit_number" class="form-control" placeholder="Unit Number">
                                      </div>


                                      <div class="form-group">
                                        <label class="control-label">Company Name</label>
                                        <input type="text" readonly  value="<?php echo $companyName;?>" required id="companyName" name="companyName" class="form-control" placeholder="Company Name">
                                      </div>

                                      <div class="form-group">
                                        <label class="control-label">Contact Number</label>
                                        <input type="text" readonly  value="<?php echo $contact;?>" required id="contact" name="contact" class="form-control" placeholder="Contact Number">
                                      </div>
                                    </div>

                                   <div class="clearfix"></div>
                                
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="profile1">




                                    <!--bank details--> 
                                    <div class="row white-box">
                                         <div class="table-responsive">
                                                  <table class="table table-bordered main-datatable" id="dataTable" width="100%" cellspacing="0">
                                                          <tr>
                                                              <th><strong>S No</strong></th>
                                                              <th><strong>Account Number</strong></th>
                                                              <th><strong>Account Holder Name</strong></th>
                                                              <th><strong>Account Holder Name</strong></th>
                                                              <th><strong>IFSC Code</strong></th>
                                                              <th><strong>Payment Mobile</strong></th>
                                                              <th><strong>Is Default</strong></th>
                                                              <th><strong>Created</strong></th>
                                                          </tr>
                                                      <tbody>
                                                        <?php
                                                          $count = 1;
                                                          foreach ($bank_details as $result) {
                                                         ?>
                                                          <tr>
                                                              <td><?php echo $count; ?></td>
                                                              <td><?php echo $result->account_number; ?></td>
                                                              <td><?php echo $result->account_holder_name; ?></td>
                                                              <td><?php echo $result->account_holder_name; ?></td>
                                                              <td><?php echo $result->ifsc_code; ?></td>
                                                              <td><?php echo $result->payment_mobile_number; ?></td>
                                                              <td><?php  
                                                                $class = 'label-danger';
                                                                if($result->is_default == "Yes"){
                                                                  $class = 'label-success';  
                                                                }
                                                                echo '<div class="label label-table '.$class.'">'.$result->is_default.'</div>';
                                                              ?>
                                                              </td>
                                                              <td><?php echo $result->created; ?></td>
                                                          </tr>
                                                         <?php 
                                                            $count = $count+1;
                                                          } ?> 
                                                      </tbody>
                                                          <tr>
                                                              <th><strong>S No</strong></th>
                                                              <th><strong>Account Number</strong></th>
                                                              <th><strong>Account Holder Name</strong></th>
                                                              <th><strong>Account Holder Name</strong></th>
                                                              <th><strong>IFSC Code</strong></th>
                                                              <th><strong>Is Default</strong></th>
                                                              <th><strong>Created</strong></th>
                                                          </tr>
                                                  </table>
                                              </div> 
                                      </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div role="tabpanel" class="tab-pane fade" id="messages1">
                                     <div class="row white-box">
                                         <div class="table-responsive">
                                                  <table class="table table-bordered main-datatable" id="dataTable" width="100%" cellspacing="0">
                                                          <tr>
                                                              <th><strong>S No</strong></th>
                                                              <th><strong>Interest</strong></th>
                                                          </tr>
                                                      <tbody>
                                                        <?php
                                                          $count = 1;
                                                          foreach ($user_interest as $result) {
                                                         ?>
                                                          <tr>
                                                              <td><?php echo $count; ?></td>
                                                              <td><?php echo interest_from_id($result->interest_id);?></td>
                                                           </tr>
                                                         <?php 
                                                            $count = $count+1;
                                                          } ?> 
                                                      </tbody>
                                                          <tr>
                                                              <th><strong>S No</strong></th>
                                                              <th><strong>Interest</strong></th>
                                                          </tr>
                                                  </table>
                                              </div> 
                                      </div>  
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <?php /* 
                                <div role="tabpanel" class="tab-pane fade" id="settings1">
                                    
                                    <div class="row white-box">
                                         <div class="table-responsive">
                                                  <table class="table table-bordered main-datatable" id="dataTable" width="100%" cellspacing="0">
                                                          <tr>
                                                              <th><strong>S No</strong></th>
                                                              <th><strong>Address Line 1</strong></th>
                                                              <th><strong>Address Line 2</strong></th>
                                                              <th><strong>Country</strong></th>
                                                              <th><strong>City</strong></th>
                                                              <th><strong>Is Default</strong></th>
                                                              <th><strong>Created</strong></th>
                                                          </tr>
                                                      <tbody>
                                                        <?php
                                                          $count = 1;
                                                          foreach ($user_address as $result) {
                                                         ?>
                                                          <tr>
                                                              <td><?php echo $count; ?></td>
                                                              <td><?php echo $result->address_line_1; ?></td>
                                                              <td><?php echo $result->address_line_2; ?></td>
                                                              <td><?php echo $result->country; ?></td>
                                                              <td><?php echo $result->city; ?></td>
                                                              <td><?php  
                                                                $class = 'label-danger';
                                                                if($result->is_default == "Yes"){
                                                                  $class = 'label-success';  
                                                                }
                                                                echo '<div class="label label-table '.$class.'">'.$result->is_default.'</div>';
                                                              ?>
                                                              </td>
                                                              <td><?php echo $result->created_by; ?></td>
                                                          </tr>
                                                         <?php 
                                                            $count = $count+1;
                                                          } ?> 
                                                      </tbody>
                                                          <tr>
                                                              <th><strong>S No</strong></th>
                                                              <th><strong>Address Line 1</strong></th>
                                                              <th><strong>Address Line 2</strong></th>
                                                              <th><strong>Country</strong></th>
                                                              <th><strong>City</strong></th>
                                                              <th><strong>Is Default</strong></th>
                                                              <th><strong>Created</strong></th>
                                                          </tr>
                                                  </table>
                                              </div> 
                                      </div>
                                    <div class="clearfix"></div>
                                </div>



                                
                                <div role="tabpanel" class="tab-pane fade" id="mobile">
                                    
                                    <div class="row white-box">
                                         <div class="table-responsive">
                                                  <table class="table table-bordered main-datatable" id="dataTable" width="100%" cellspacing="0">
                                                          <tr>
                                                              <th><strong>S No</strong></th>
                                                              <th><strong>Mobile</strong></th>
                                                              <th><strong>Status</strong></th>
                                                              <th><strong>Is Default</strong></th>
                                                              <th><strong>Created</strong></th>
                                                          </tr>
                                                      <tbody>
                                                        <?php
                                                          $count = 1;
                                                          foreach ($user_mobile as $result) {
                                                         ?>
                                                          <tr>
                                                              <td><?php echo $count; ?></td>
                                                              <td><?php echo $result->mobile; ?></td>
                                                              <td><?php echo $result->status; ?></td>
                                                              <td><?php  
                                                                $class = 'label-danger';
                                                                if($result->is_default == "Yes"){
                                                                  $class = 'label-success';  
                                                                }
                                                                echo '<div class="label label-table '.$class.'">'.$result->is_default.'</div>';
                                                              ?>
                                                              </td>
                                                              <td><?php echo $result->created; ?></td>
                                                          </tr>
                                                         <?php 
                                                            $count = $count+1;
                                                          } ?> 
                                                      </tbody>
                                                          <tr>
                                                              <th><strong>S No</strong></th>
                                                              <th><strong>Mobile</strong></th>
                                                              <th><strong>Status</strong></th>
                                                              <th><strong>Is Default</strong></th>
                                                              <th><strong>Created</strong></th>
                                                          </tr>
                                                  </table>
                                              </div> 
                                      </div>
                                    <div class="clearfix"></div>
                                </div>

                                */?>





                                
                            </div>
                        </div>




     
  </div>
</div>