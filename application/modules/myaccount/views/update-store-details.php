<?php

	$store_image   								= base_url().IMAGE_PATH_URL."img_place.jpg";
	$shipping_policy							= "";
	$return_policy   							= "";
	$shipping_amount  						= "";
	$shipping_delivery  					= "";
	$free_delivery_after_payment  = 0;
	$cod_charges   								= 0;
	$vat_number   								= "";
	

	if(count($store_details) > 0){
		$shipping_policy	= $store_details[0]->shipping_policy;
		$return_policy   	= $store_details[0]->return_policy;
		$vat_number   	= $store_details[0]->vat_number;

		$shipping_amount  = $store_details[0]->shipping_amount;
		$shipping_delivery = $store_details[0]->shipping_delivery;
		$free_delivery_after_payment = $store_details[0]->free_delivery_after_payment;

		$cod_charges   								= $store_details[0]->cod_charges;
		$cod_available   								= $store_details[0]->cod_available;

		if($store_details[0]->store_image != ""){
			$store_image   = base_url().IMAGE_PATH_ABSULATE.STORES_FOLDER.$store_details[0]->store_image;
		}	
	}

?>

<div class="main">

    <?php 
    if($this->session->userdata(GLOBAL_MSG)!='') {
    $message = $this->session->userdata(GLOBAL_MSG); 
    $this->session->set_userdata(GLOBAL_MSG,'');
    ?>  
      <p class='alert alert-success'><?php echo $message; ?></p>
   <?php } ?>
   

	<div class="cl-ViewHeader u-noPrint">
		<h1 class="cl-ViewHeader-title">
		Store Details
		</h1>
	</div>
	<div class="cl-Container">
		<div class="u-noPrint"> </div>
		<div class="u-noPrint" id="flash"> </div>

			<form method="post" action="<?php echo base_url()?>myaccount/doupdatestoreprofile"  enctype="multipart/form-data"  >		

					<div class="MField">
						<label class="MField-label" for="shipping_policy">Shipping Policy</label>
						<textarea required name="shipping_policy" id="shipping_policy" placeholder="Shipping Policy." class="MInput MInput--7Rows"><?php echo $shipping_policy;?></textarea>
						<div class="MField-note"></div>
					</div>

					<div class="MField">
						<label class="MField-label" for="return_policy">Return Policy</label>
						<textarea required name="return_policy" id="return_policy" placeholder="Return Policy." class="MInput MInput--7Rows"><?php echo $return_policy;?></textarea>
						<div class="MField-note"></div>
					</div>


					<div class="MField">
						<label class="MField-label" for="shipping_amount">Shipping Amount</label>
						<input type="number" required name="shipping_amount" id="shipping_amount" placeholder="Shipping Amount" class="MInput MInput--7Rows" value="<?php echo $shipping_amount; ?>">
						<div class="MField-note"></div>
					</div>

					<div class="MField">
						<label class="MField-label" for="free_delivery_after_payment">Free Delivery After</label>
						<input type="number" required name="free_delivery_after_payment" id="free_delivery_after_payment" placeholder="Free Delivery After" class="MInput MInput--7Rows" value="<?php echo $free_delivery_after_payment; ?>">
						<div class="MField-note"></div>
					</div>
					<div class="MField">
						<label class="MField-label" for="cod_available">COD Available</label>
						<select name="cod_available">
								<option value="Y" <?php if($cod_available == 'Y'){ echo 'selected';} ?>>Yes</option>
								<option value="N" <?php if($cod_available == 'N'){ echo 'selected';} ?>>No</option>
						</select>					
						<div class="MField-note"></div>
					</div>
					<div class="MField">
						<label class="MField-label" for="cod_charges">COD Charges</label>
						<input type="number" required name="cod_charges" id="cod_charges" placeholder="Free Delivery After" class="MInput MInput--7Rows" value="<?php echo $cod_charges; ?>">
						<div class="MField-note"></div>
					</div>

					<div class="MField">
						<label class="MField-label" for="cod_charges">Vat Number</label>
						<input type="number" required name="vat_number" id="vat_number" placeholder="Vat Number" class="MInput MInput--7Rows" value="<?php echo $vat_number; ?>">
						<div class="MField-note"></div>
					</div>
					

					<div class="MField">
						<label class="MField-label" for="shipping_delivery">Shipping Delivery</label>
						<textarea required name="shipping_delivery" id="shipping_delivery" placeholder="Shipping Delivery" class="MInput MInput--7Rows"><?php echo $shipping_delivery;?></textarea>
						<div class="MField-note"></div>
					</div>



					<div class="MPanelGroup">
						<h1 class="MPanelGroup-heading">Store images</h1>
						<div>
							<p class="MPanelGroup-subheading">Adding an image will hike changes to sell more</p>
						</div>
						<div class="MImageUploader">
							<div class="MPanel MPanel--withLine">
								<div class="row">
									<div class="col-sm-12">
										<div class="MFineUploader">
											 <div class="form-group">
										        <image id="banner_image"  class="banner_image img-responsive" src="<?php echo $store_image; ?>" />
										        <input name="store_image" onchange="readURL(this,'banner_image')"  id="imageUpload" class="imageUpload" type="file"  placeholder="Photo" >
										      </div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				
				<div class="u-right t-saveOrUpdateAdvert">
					<button type="submit" class="MButton MButton--withSpinner MButton--primary MButton--next">NEXT: Define your product</button>
				</div>
			</form>
		</div>
	</div>
</div>