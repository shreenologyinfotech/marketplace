<?php
  $result = $details[0];
  $date = date_out();
?>


<div class="page-title green-bg pt-3 pb-3">
  <div class="container">
   <div class="row">
    <div class="col col-8">
        <h2 class="text-uppercase text-white">Order Invoice</h2>
    </div>
    <div class="col col-4"></div>
   </div>
  </div>
</div>

 
 <div class="innerpages pt-5 pb-5">
   <div class="container" id="container">
     <div class="row" id="row">
       <div class="col col-md-12 col-12">
         <div class="bg-white p-5">
           <table class="table invoice-data" width="100%" border="0">
              <tr>
                <td style="border:0;" width="67%"><img class="invoiceimage-padding" src="<?php echo base_url();?>uploads/logo.jpg" alt="">
                 <p><?php echo get_meta_value('invoice_company');?><br> UEN: <?php echo get_meta_value('invoice_uen');?></p>
                 </td>
                <td style="border:0;" width="33%">
                 <table class="table table-borderless" align="right" width="100%" border="0">
                  <tr>
                    <td align="right" ><h2>Invoice</h2></td>                    
                  </tr>
                  <tr>
                    <td style="padding:0;"  align="right">Date: <?php echo date('d/m/Y');?></td>
                  </tr>
                  <tr>
                    <td style="padding:0;" align="right">Order ID: <?php echo get_order_id($result->order_id);?></td>
                  </tr>
                  <tr>
                    <td style="padding:0;" align="right">Invoice No: <?php echo get_invoice_id($result->order_id); ?></td>
                  </tr>
                </table>

                </td>
              </tr>
              <tr>
                <td colspan="2">
                 <table class="table-borderless" width="100%" border="0">
                  <tr>
                    <td style="padding:0;"><h5 style="background-color:#dedede; padding:5px 40px 5px 10px; display:inline-block;">Customer Information</h5></td>
                  </tr>
                  <tr>
                    <td>
                     <table width="100%" border="0">
                      <tr>
                        <td style="padding:0;"><strong>Name:</strong>  <?php echo $result->fname.'  '.$result->lname;?></td>
                      </tr>
                      <tr>
                        <td style="padding:0;"><strong>Email Address:</strong>  <?php echo $result->email;?></td>
                      </tr>
                      <tr>
                        <td style="padding:0;"><strong>Contact Number:</strong> <?php echo $result->contact_number;?></td>
                      </tr>
                      <tr>
                        <td style="padding:0;"><strong>Company Name:</strong>  <?php echo $result->company_name;?></td>
                      </tr>
                    </table>
                    </td>
                  </tr>
                </table>

                </td>                
              </tr>
              
              <tr>
                <table class="table" width="100%" border="0">
                  <tr>
                  <thead class="thead-light">
                    <th>No.</th>
                    <th>Order Description</th>
                    <th>Unit Cost ($)</th>
                    <th>Quantity</th>
                    <th>Total ($)</th>
                    </thead>
                  </tr>
                  <tr>
                    <td valign="top">1</td>
                    <td>
                     <table class="table-borderless" width="100%" border="0">
                      <tr>
                        <td style="padding:0;"><strong>Distribution of CashVertisement</strong></td></td>
                      </tr>
                      <tr>
                        <td style="padding:0;"><strong>Start Date</strong>: <?php echo date($date,strtotime($result->start_date));?></td>
                      </tr>
                      <tr>
                        <td style="padding:0;"><strong>End Date:</strong> <?php echo date($date,strtotime($result->end_date));?></td>
                      </tr>
                      <tr>
                        <td style="padding:0;"><strong>Area:</strong> <?php if($result->order_type == "Specific Postal Code"){ echo "By Postal Sector "; } else if($result->order_type == "Specific Radius"){ echo "Within 500m Radius of "; }else { echo $result->order_type; } 
                          if($result->order_type == "Specific Postal Code"){
                            echo zipcode_by_order_id($result->order_id);  
                          }else if($result->order_type == "Specific Radius"){ 
                            if($result->order_lat !=  0 && $result->order_lng != 0){
                              echo postal_form_lat_lng($result->order_lat,$result->order_lng);
                            }
                          }

                        ?></td>
                      </tr>
                    </table>
                    </td>  
                    
                    <td valign="top"><?php echo site_currency_symbol().$result->advertise_per_view_cost; ?></td>
                    <td valign="top"><?php echo $result->quantity; ?></td>
                    <td valign="top"><?php echo site_currency_symbol().$result->total_cost; ?></td>
                  </tr>
                </table>
              </tr>
              <tr>
                <td align="right" colspan="2">
                  <table width="100%" border="0">
                  <tr>
                    <td style="border-top:1px solid #ccc; padding-top:20px;" align="right"><strong>Subtotal (<?php echo site_currency_symbol();?>) : <?php echo show_two_decimal_number($result->total_cost); ?></strong></td>
                  </tr>
                  <tr>
                    <td align="right">Transaction Fess (<?php echo site_currency_symbol();?>) : <?php echo show_two_decimal_number(transaction_fee());?></td>
                  </tr>
                  <tr>
                    <td align="right"><p><strong>Grand Total (<?php echo site_currency_symbol();?>) : <?php echo show_two_decimal_number($result->total_cost+transaction_fee()); ?></strong></p></td>
                  </tr>
                  <tr>
                    <td align="right">&nbsp;</td>
                  </tr>
                </table>
                </td>
              </tr>
            </table>
         </div>
       </div>      
     </div>
     <button  onclick="printDiv('row')" class="printBtn">Print</button>
   </div>
 </div>
    
    