<?php
	
?>

<div class="CLayout-contentInner">
   <div class="CLayout-fixedWidth">
 	

 	<div class="row">
	<div class="col-sm-4">
		<section class="DisplayPanel" style="padding:0px;">
			<div>
				<?php
					$tab = $this->uri->segment(2);
					
				?>
					<a href="<?php echo base_url();?>profile/editprofile" class="btn  btn-block <?php if($tab == 'editprofile'){ echo 'btn-primary'; }?>">Profile</a>
					<a href="<?php echo base_url();?>profile/changepassword" class="btn  btn-block <?php if($tab == 'changepassword'){ echo 'btn-primary'; }?>">Change Password</a>
					
					<a href="<?php echo base_url();?>profile/address" class="btn  btn-block <?php if($tab == 'address'){ echo 'btn-primary'; }?>">Address</a>
               
					<a href="<?php echo base_url();?>profile/orders" class="btn  btn-block <?php if($tab == 'orders' || $tab == 'orderdetail'){ echo 'btn-primary'; }?>">My Orders</a>
					
					<a href="<?php echo base_url().'/myaccount/signout'?>" class="btn  btn-block <?php if($tab == 'signout'){ echo 'btn-primary'; }?>">Sign out (<?php echo login_user_name();?>)</a>
			</div>
		</section>
	</div>
	<div class="col-sm-8">

		<div class="main">


<section class="DisplayPanel">
 

<?php

	$row 				= $data_product[0];

	



	$fineData 			= get_products_name_and_cart_total(json_decode($data_product[0]->cart_data));
	$status    			= $data_product[0]->status;
	$orderStatus 		= $data_product[0]->status;
	$user_id 			= $data_product[0]->user_id;
	$cod_charges 		= $data_product[0]->cod_charges;
	$orderPayMode 		= $data_product[0]->payment_mode;
	$user_details 		=  store_details_by_id($user_id);
	$cartData 			= json_decode($data_product[0]->cart_data);
	$addressDetails 	= json_decode($data_product[0]->address_details);
 

	
?>

<div class="main">
		<div class="cl-ViewHeader u-noPrint">
		<h1 class="cl-ViewHeader-title">
			Orders Detail
		</h1> 
 </div>

	<div class="cl-Container">



<div class="MPanel MPanel--withLine">
   <div class="row grid-top">
      <div class="col-sm-8">
         
         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label">ID: </span><span class="MMyAdvertsListItem-content"><?php echo "#".$row->order_id;?></span></p>
         
         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label">Products: </span><span class="MMyAdvertsListItem-content"><?php echo $fineData->product_name;?></span></p>
         
         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label">Total Price: </span><span class="MMyAdvertsListItem-content"><?php echo $row->total_amount;?></span></p>

         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label">Status: </span><span class="MMyAdvertsListItem-content"><?php echo $orderStatus;?></span></p>

         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label">Payment Mode: </span><span class="MMyAdvertsListItem-content"><?php echo $orderPayMode;?></span></p>

          <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label">Shipping Charges: </span><span class="MMyAdvertsListItem-content"><?php echo $row->shipping_charges;?></span></p>

         <?php if($orderPayMode == "COD"){ ?>
        	<p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label">COD Charges: </span><span class="MMyAdvertsListItem-content"><?php echo $cod_charges;?></span></p>
         <?php	} ?>	

         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label">Vat: </span><span class="MMyAdvertsListItem-content"><?php echo $cartData[0]->vat_percentage; ?>%</span></p>
         
         
      </div>
      <div class="col-sm-4">
         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label">Created: </span><span class="MMyAdvertsListItem-content"><?php echo $row->created_at;?></span></p>

         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label">Name: </span><span class="MMyAdvertsListItem-content"><?php echo $user_details->owner_first_name;?> <?php echo $user_details->owner_last_name;?></span></p>

         

         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label">Email: </span><span class="MMyAdvertsListItem-content"><?php echo $user_details->store_email;?></span></p>

         <!-- <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label">Total Amount To Pay: </span><span class="MMyAdvertsListItem-content"><?php // echo $fineData->cart_total;?></span></p> -->
      </div>

   </div>
</div>

<div style="background-color:#e70b31;margin-left: -13px;margin-right: -13px;color:#fff;padding-left: 13px;padding-right: 13px" class="MPanel MPanel--heading MMyAdvertsListItem-heading"><span class="MPanel-title">Products/Store Details</span></div>

<div class="MPanel MPanel--withLine">
	<?php foreach ($cartData as $cartObj){ ?>
   <div class="row grid-top">
      <div class="col-sm-12" style="border-bottom:1px solid red;padding-bottom:5px;margin:5px">

      	<p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label">Store Name - </span><?php echo store_name_by_id($cartObj->store_id);?></p>


         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label"></span><span class="MMyAdvertsListItem-content">Product - </span><?php echo $cartObj->product_title;?></p>

         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label"></span><span class="MMyAdvertsListItem-content">SKU - </span><?php echo product_sku_by_id($cartObj->product_id);?></p>
         
         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label"></span><span class="MMyAdvertsListItem-content">Qty - </span><?php echo $cartObj->product_qty;?></p>
         
         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label">Price - </span><?php echo $cartObj->product_price;?></p>

         



      </div>
   </div>
	<?php } ?>
</div>



		</div>
	</div>
</div>	 



</div>


      </section>
	</div>
</div>






   </div>
</div>