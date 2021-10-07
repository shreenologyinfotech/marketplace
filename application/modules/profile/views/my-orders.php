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
	<div class="cl-ViewHeader u-noPrint">
		<h1 class="cl-ViewHeader-title">
			My Orders
		</h1> 
 </div>

<section class="DisplayPanel">
 

<div class="main">

	
	<div class="cl-Container">
		


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





<div class="MPanel MPanel--withLine" style="border-bottom: 1px solid #e70b31; margin-bottom: 10px">
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


         	
        		<a href="<?php echo base_url()?>profile/orderdetail/<?php echo $row->order_id;?>">
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


      </section>
	</div>
</div>






   </div>
</div>