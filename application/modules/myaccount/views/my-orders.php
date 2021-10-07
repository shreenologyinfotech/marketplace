<div class="main">
	<div class="cl-ViewHeader u-noPrint">
		<h1 class="cl-ViewHeader-title">
			My Orders
		</h1> 
	</div>
	
	<div class="cl-Container">
		<div class="u-noPrint"> </div>
		<div class="u-noPrint" id="flash"> </div>


<?php
	foreach($data_product as $row){ 
	$dataCart = json_decode($row->cart_data);
	$fineData 		= get_products_name_and_cart_total(json_decode($row->cart_data));
	$status    		= $row->status;
	$orderStatus 	= $row->status;

	if($status == "Pending"){
		$orderStatus 	= "NEW";
	}

?>



<div class="MPanel MPanel--heading MMyAdvertsListItem-heading"><span class="MPanel-title"><?php echo $orderStatus;?></span>
	<div class="MPanel-headingButtons">

	<!--	<div class="MTooltipContainer">
			<a title="Delete" type="button" href="#" class="MPanel-headingIcon MPanel-headingIcon--delete"></a>
		</div>
	-->
	</div>
</div>


<div class="MPanel MPanel--withLine">
   <div class="row grid-top">
      <div class="col-sm-8">
         
         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label">ID: </span><span class="MMyAdvertsListItem-content"><?php echo "#".$row->order_id;?></span></p>
         
         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label">Products: </span><span class="MMyAdvertsListItem-content"><?php echo $fineData->product_name;?></span></p>
         

         <?php /*<p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label">Qty * Price: </span><span class="MMyAdvertsListItem-content"><?php echo $dataCart->product_qty." * ".$dataCart->product_price;?></span></p> */ ?>

         
         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label">Total Price: </span><?php echo $row->total_amount;?></p>
         
         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label">Status: </span><span class="MMyAdvertsListItem-content"><?php echo $orderStatus;?></span></p>
         
      </div>
      <div class="col-sm-4">
         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label">Created: </span><span class="MMyAdvertsListItem-content"><?php echo $row->created_at;?></span></p>

         <?php 
         if($status != "Refunded"){ ?>
         		<?php if($status == "Pending"){ ?>
         		<a onclick="performAction('<?php echo base_url();?>ajax/updatestatus/tbl_order/Dispatch/<?php echo $row->order_id;?>','Dispatch Order','Are you sure want to dispatch this Order?','Order dispatched successfully')" title="Dispatch" type="button" href="javascript:void(0)" class="">Dispatch</a>
         	<?php	}else if($status == "Dispatch"){ ?>

         		<a onclick="performAction('<?php echo base_url();?>ajax/updatestatus/tbl_order/Shipped/<?php echo $row->order_id;?>','Ship Order','Are you sure want to ship this Order?','Order Ship successfully')" title="Ship" type="button" href="javascript:void(0)" class="">Dispatch</a>
         	

         	<?php	}else if($status == "Shipped"){ ?>

         		<a onclick="performAction('<?php echo base_url();?>ajax/updatestatus/tbl_order/Delivered/<?php echo $row->order_id;?>','Deliver Order','Are you sure want to deliver this Order?','Order Deliver successfully')" title="Ship" type="button" href="javascript:void(0)" class="">Dispatch</a>


         	<?php } ?>

         	<a onclick="performAction('<?php echo base_url();?>ajax/updatestatus/tbl_order/Refunded/<?php echo $row->order_id;?>','Cancel Order','Are you sure want to cancel this Order?','Order cancelled successfully')" title="Ship" type="button" href="javascript:void(0)" class="">Cancel & Refunded</a>

         <?php } ?>

         

         

         	
        		<a href="<?php echo base_url()?>myaccount/vieworder/<?php echo $row->order_id;?>">
        		 <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-content">View Details</span></p>
        		</a>
      </div>

     

   </div>
</div>


<?php	}
?>			 



		</div>
	</div>
</div>