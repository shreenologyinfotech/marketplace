<?php

	$row = $data_product[0];
	$fineData 		= get_products_name_and_cart_total(json_decode($data_product[0]->cart_data));
	$status    		= $data_product[0]->status;
	$orderStatus 	= $data_product[0]->status;
	$user_id 		= $data_product[0]->user_id;
	$cod_charges 	= $data_product[0]->cod_charges;
	$orderPayMode 	= $data_product[0]->payment_mode;
	$user_details 	=  store_details_by_id($user_id);

	$cartData 			= json_decode($data_product[0]->cart_data);
	$addressDetails 	= json_decode($data_product[0]->address_details);
	
	if($status == "Pending"){
		$orderStatus 	= "NEW";
	}
	
?>

<div class="main">
	<div class="cl-ViewHeader u-noPrint">
		<h1 class="cl-ViewHeader-title">
			View Orders
		</h1> 
	</div>
	<div class="cl-Container">


<div class="MPanel MPanel--heading MMyAdvertsListItem-heading"><span class="MPanel-title"><?php echo $orderStatus;?></span>
</div>


<div class="MPanel MPanel--withLine">
   <div class="row grid-top">
      <div class="col-sm-8">
         
         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label">ID: </span><span class="MMyAdvertsListItem-content"><?php echo "#".$row->order_id;?></span></p>
         
         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label">Products: </span><span class="MMyAdvertsListItem-content"><?php echo $fineData->product_name;?></span></p>
         
         
         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label">Total Price: </span><?php echo $row->total_amount;?></p>
         
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

         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label">First Name: </span><span class="MMyAdvertsListItem-content"><?php echo $user_details->owner_first_name;?></span></p>

         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label">Last Name: </span><span class="MMyAdvertsListItem-content"><?php echo $user_details->owner_last_name;?></span></p>

         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label">Email: </span><span class="MMyAdvertsListItem-content"><?php echo $user_details->store_email;?></span></p>
      </div>

   </div>
</div>

<div class="MPanel MPanel--heading MMyAdvertsListItem-heading"><span class="MPanel-title">Products Details</span></div>

<div class="MPanel MPanel--withLine">
	<?php foreach ($cartData as $cartObj){ ?>
   <div class="row grid-top">
      <div class="col-sm-8">
         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label"></span><span class="MMyAdvertsListItem-content">Product - </span><?php echo $cartObj->product_title;?></p>
         
         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label"></span><span class="MMyAdvertsListItem-content">Qty - </span><?php echo $cartObj->product_qty;?></p>
         
         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label">Price - </span><?php echo $cartObj->product_price;?></p>


         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label">SKU - </span><?php echo sku_by_product_id($cartObj->product_id);?></p>


         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label">VAT % - </span><?php echo vat_percentage_by_product_id($cartObj->product_id);?></p>
      </div>
   </div>
	<?php } ?>
</div>


<div class="MPanel MPanel--heading MMyAdvertsListItem-heading"><span class="MPanel-title">Delivery Address</span>
	</div>

<div class="MPanel MPanel--withLine">
   <div class="row grid-top">
      <div class="col-sm-8">

      	 <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label"></span><span class="MMyAdvertsListItem-content">Name : <?php echo $user_details->owner_first_name." ".$user_details->owner_last_name;?></span></p>

      	 <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label"></span><span class="MMyAdvertsListItem-content">Mobile : <?php echo $user_details->store_mobile;?></span></p>


      	 <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label"></span><span class="MMyAdvertsListItem-content">Email : <?php echo $user_details->store_email;?></span></p>
         
         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label"></span><span class="MMyAdvertsListItem-content"><?php echo $addressDetails->flat_house_building_company_apartment;?></span></p>
         
         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label"></span><span class="MMyAdvertsListItem-content"><?php echo $addressDetails->area_street_sector_village;?></span></p>
         
         
         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label"></span><?php echo $addressDetails->land_mark;?></p>
         
         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label"></span><span class="MMyAdvertsListItem-content"><?php echo $addressDetails->town_city;?> , <?php echo get_state_by_id($addressDetails->state_id);?> , <?php echo get_country_by_id($addressDetails->country_id); ?>, <?php echo $addressDetails->postal_code; ?>.</span></p>
         
      </div>
    

   </div>


	

	


</div>

		</div>
	</div>
</div>