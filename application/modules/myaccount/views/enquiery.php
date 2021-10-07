<div class="main">
	<div class="cl-ViewHeader u-noPrint">
		<h1 class="cl-ViewHeader-title">
			Enquiery
		</h1> 
	</div>
	
<div class="cl-Container">

<div class="MPanel MPanel--withLine">
 <?php
  	foreach ($list_data as $row){ ?>
   <div class="row grid-top">
      <div class="col-sm-8">
         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label">ID: </span><span class="MMyAdvertsListItem-content"><?php echo "#".$row->enquiery_id;?></span></p>
         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label">Name: </span><span class="MMyAdvertsListItem-content"><?php echo $row->name;?></span></p>
         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label">Email: </span><?php echo $row->email_address;?></p>
         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label">Message: </span><span class="MMyAdvertsListItem-content"><?php echo $row->message;?></span></p>

      </div>
      <div class="col-sm-4">
         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label">Date: </span><span class="MMyAdvertsListItem-content"><?php echo date(date_out(),strtotime($row->created_at));?></span></p>
         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label">Phone: </span><?php echo $row->phone;?></p>
         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label">Product: </span><?php echo get_product_name_by_id($row->product_id);?></p>
      </div>
   </div>

   <?php	}
   ?>


</div>





		</div>
	</div>
</div>