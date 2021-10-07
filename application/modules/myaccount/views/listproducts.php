<div class="main">
<div class="cl-ViewHeader u-noPrint">
	<h1 class="cl-ViewHeader-title">
		My Advert
	</h1> 
</div>
	
<div class="cl-Container">
	 <?php
	 if($this->session->userdata(GLOBAL_MSG)!='') {
        $message = $this->session->userdata(GLOBAL_MSG); 
        $this->session->set_userdata(GLOBAL_MSG,'');
    ?>
         <div class="MNotificationBanner">
            <div class="MTypography">
               <p><?php echo $message;?></p>
            </div>
         </div>
      <?php   }
      ?>


<div class="MPanelGroup">
	<h1 class="MPanelGroup-heading">Import Products</h1>
	<div>
		<p class="MPanelGroup-subheading">Import an excel file of products</p>
	</div>
	<div class="MImageUploader">
		
			<div class="MPanel MPanel--withLine">
				<div class="row">
					<div class="col-sm-12">
						<form action="<?php echo base_url(); ?>myaccount/importexcelfile" method="post" enctype="multipart/form-data">
						<div class="MFineUploader">
							 <div class="form-group">
						        <input required id="excel_file" name="excel_file" type="file"/>
						    </div>
						</div>
					
						<div class="u-right t-saveOrUpdateAdvert">
							<button type="submit" class="MButton MButton--withSpinner MButton--primary MButton--next">Upload</button>
						</div>

						</form>

						<form action="<?php echo base_url(); ?>myaccount/exportexcelfile" method="post" enctype="multipart/form-data">
							<div class="u-right t-saveOrUpdateAdvert">
								<button type="submit" class="MButton MButton--withSpinner MButton--primary MButton--next">Export</button>
							</div>
						</form>

					</div>
					<div class="col-sm-12">
						<form action="<?php echo base_url(); ?>myaccount/listproducts" method="post" enctype="multipart/form-data">
						<div class="MFineUploader">
							 <div class="form-group">
							 	<label>Search Products</label>
						        <input required id="search_pro" name="search_pro" type="text" value="<?php echo @$search_pro; ?>" placeholder="type product name or SKU" />
						    </div>
						</div>
					
						<div class="u-right t-saveOrUpdateAdvert">
							<button type="submit" class="MButton MButton--withSpinner MButton--primary MButton--next">Search</button>
						</div>

						</form>

						

					</div>
				</div>
			</div>
		</form>


		


	</div>
</div>


<div class="MPanelGroup">
	<h1 class="MPanelGroup-heading">My Products</h1>
</div>
<?php
	foreach($data_product as $row){ 
	$product_image   = base_url().IMAGE_PATH_URL."img_place.jpg";
	if($row->product_image != ""){
		$product_image   = base_url().IMAGE_PATH_ABSULATE.PRODUCT_FOLDER.$row->product_image;
	}
?>





<div class="MPanel MPanel--heading MMyAdvertsListItem-heading"><span class="MPanel-title"><?php echo $row->product_name;?></span>
	<div class="MPanel-headingButtons">
		
		<div class="MTooltipContainer MTooltipContainer--hoverable">
			<a href="<?php echo base_url()?>myaccount/editproducts/<?php echo $row->product_id;?>" class="MPanel-headingIcon MPanel-headingIcon--edit" title="Edit"></a>
		</div>
		
		<div class="MTooltipContainer">
			<a onclick="performAction('<?php echo base_url();?>ajax/updatestatus/tbl_products/Deleted/<?php echo $row->product_id;?>','Delete Product','Are you sure want to delete this Product?','Product deleted successfully')" title="Delete" type="button" href="javascript:void(0)" class="MPanel-headingIcon MPanel-headingIcon--delete"></a>
		</div>
	
	</div>
</div>


<div class="MPanel MPanel--withLine">
   <div class="row grid-top">

      <div class="col-sm-3"><a class="MMyAdvertsListItem-imageLink" href="javascript:void(0)"><img src="<?php echo $product_image; ?>"></a></div>
      <div class="col-sm-5">
         
         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label">ID: </span><span class="MMyAdvertsListItem-content"><?php echo $row->product_id;?></span></p>
         
         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label">Type: </span><span class="MMyAdvertsListItem-content">Frames &amp; Forks - Forks - Cruiser Bike Forks</span></p>
         
         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label">Brand: </span><span class="MMyAdvertsListItem-content"><?php echo brand_name_by_id($row->brand_id);?></span></p>
         
         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label">Price: </span><?php echo $row->price;?></p>
         
         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label">Availability: </span><span class="MMyAdvertsListItem-content"><?php echo $row->is_active;?></span></p>
         

      </div>
      <div class="col-sm-4">
         <p class="MMyAdvertsListItem-row"><span class="MMyAdvertsListItem-label">Created: </span><span class="MMyAdvertsListItem-content"><?php echo $row->created_at;?></span></p>
         
         <div></div>
      </div>
   </div>
</div>


<?php	}
?>			 



		</div>
	</div>
</div>