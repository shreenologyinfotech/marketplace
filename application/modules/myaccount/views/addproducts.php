<?php
	$product_image   = base_url().IMAGE_PATH_URL."img_place.jpg";

	$product_name    = "";  
	$brand_id        = "";  
	$category_id     = "";  
	$subcategory_id  = "";  
	$price     		 = "";  
	$year       	 = "";  
	$weight     	 = "";  
	$weight_type     = "";  
	$length     	 = "";  
	$width     		 = "";  
	$depth     		 = "";  
	$dimension_type  = "";  
	$shipping     	 = "";  
	$description     = "";  
	$specification   = ""; 
	$product_id   	= "";

	$sku  		       = ""; 


	if(count($data_product) > 0){
		

		$product_id    = $data_product[0]->product_id;
		$product_name    = $data_product[0]->product_name;
		$brand_id        = $data_product[0]->brand_id;
		$category_id     = $data_product[0]->category_id;
		$subcategory_id  = $data_product[0]->subcategory_id;
		$price     		 = $data_product[0]->price;
		$year       	 = $data_product[0]->year;
		$weight     	 = $data_product[0]->weight;
		$weight_type     = $data_product[0]->weight_type;
		$length     	 = $data_product[0]->length;
		$width     		 = $data_product[0]->width;
		$depth     		 = $data_product[0]->depth;
		$dimension_type  = $data_product[0]->dimension_type;
		$shipping     	 = $data_product[0]->shipping;
		$description     = $data_product[0]->description;
		$specification   = $data_product[0]->specification;
		$sku 					   = $data_product[0]->sku;

		if($data_product[0]->product_image != ""){
			$product_image   = base_url().IMAGE_PATH_ABSULATE.PRODUCT_FOLDER.$data_product[0]->product_image;
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
Create a New Product Advert

</h1> </div>
	<div class="cl-Container">
		<div class="u-noPrint"> </div>
		<div class="u-noPrint" id="flash"> </div>

			<form method="post" action="<?php echo base_url()?>myaccount/doaddproduct"  enctype="multipart/form-data"  >
				
				<input value="<?php echo $product_id; ?>" name="product_id"  type="hidden" id="product_id" value="">
				<div class="MPanelGroup">
					<h1 class="MPanelGroup-heading">Product details</h1>
					<div>
						<p class="MPanelGroup-subheading">This is how people will find your product on the site. <a href="javascript:void(0)">Sell your advert faster with these pro tips.</a></p>
					</div>
					<div>
						

						<div class="MPanel">
							<div class="row">
								<div class="col-sm-3">
									<div class="MField">
										<label class="MField-label" for="category_id">Category</label>
										<div class="Select">
											<select required onchange="getsubcategory()" id="category_id" name="category_id">
												<option value="">Select Category</option>
												<?php
												$category =  get_all_active_category();
												foreach($category as $row) { ?>
													<option <?php if($category_id == $row->category_id){ echo 'selected'; } ?>  value="<?php echo $row->category_id;?>"><?php echo $row->category_name;?></option>
												<?php } ?>	
											</select>
										</div>
										<div class="MField-note"></div>
									</div>
								</div>



								<div class="col-sm-3">
									<div class="MField">
										<label class="MField-label" for="subcategory_id">Sub Category</label>
										<div class="Select">
											<select  required id="subcategory_id" name="subcategory_id">
												<option value="">Select Sub Category</option>
												<?php
													if($category_id != ""){
														$sub_category_data = get_subcategory_by_category_id($category_id);
														foreach($sub_category_data as $result){ ?>
														<option <?php if($subcategory_id == $result->sub_category_id){ echo 'selected';} ?>  value="<?php echo $result->sub_category_id; ?>"><?php echo $result->sub_category_name; ?></option>		
												<?php }
													}
												?>


												
											</select>
										</div>
										<div class="MField-note"></div>
									</div>
								</div>


								<div class="col-sm-3">
									<div class="MField">
										<label class="MField-label" for="brand_id">Brand</label>
										<div class="Select">
											<select  required id="brand_id" name="brand_id">
												<option value="">Select Brand</option>
												<?php
												$brands =  get_brands();
												foreach($brands as $row) { ?>
													<option <?php if($brand_id == $row->brand_id){ echo 'selected'; } ?>  value="<?php echo $row->brand_id;?>"><?php echo $row->brand_name;?></option>
												<?php } ?>


												
											</select>
										</div>
										<div class="MField-note"></div>
									</div>
								</div>


								<div class="col-sm-3">
									<div class="MField">
										<label class="MField-label" for="sku">Sku</label>
										 <div class="MInputWrapper">
											<input value="<?php echo $sku; ?>" name="sku"  type="text" id="sku" value="">
										</div>
										
										<div class="MField-note"></div>
									</div>
								</div>


								



							</div>
						</div>


					 



						<div class="MPanel">
							<div class="row">
								<div class="col-sm-3">
									<div class="MField">
										<label class="MField-label" for="year">Year<span class="MField-labelNote"> (optional)</span></label>
										<div class="Select">
											<select name="year" id="year">
												<option value="">Select ...</option>
												<?php
												$current_year = date("Y");
												for($i=0;$i<10;$i++){ ?>
													<option <?php if($year == $current_year){ echo 'selected';}?> value="<?php echo $current_year;?>"><?php echo $current_year;?></option>

												<?php	
													$current_year--;
												}
												?>	
											</select>
										</div>
										<div class="MField-note"></div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="MField">
									<label class="MField-label">Weight<span class="MField-labelNote"> (optional)</span></label>
									<div class="MInputWrapper">
										<input type="number"  step="0.01" id="weight" name="weight" value="<?php echo $weight;?>">
										<div class="MInputWrapper-addOn">
											<div class="Select t-selectMassUnit">
												<select id="weight_type" name="weight_type">
													<option <?php if($weight_type == "g"){ echo 'selected'; }?> value="g">g</option>
													<option <?php if($weight_type == "kg"){ echo 'selected'; }?> value="kg">kg</option>
													<option <?php if($weight_type == "oz"){ echo 'selected'; }?> value="oz">oz</option>
													<option <?php if($weight_type == "lb"){ echo 'selected'; }?> value="lb">lb</option>
												</select>
											</div>
										</div>
									</div>
									<div class="MField-note"></div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="MField">
									<label class="MField-label">Dimensions (length x width x depth)<span class="MField-labelNote"> (optional)</span></label>
									<div class="MInputWrapper">
										<input type="number" step="0.01" min="0" name="length" id="length" name="length" value="<?php echo $length;?>">
										<input type="number" step="0.01" min="0" name="width"  id="width" value="<?php echo $width;?>">
										<input type="number" step="0.01" min="0" name="depth" id="depth" value="<?php echo $depth;?>">
										
										<div class="MInputWrapper-addOn">
											<div class="Select t-selectDistanceUnit">
												<select id="dimension_type" name="dimension_type">
													<option <?php if($dimension_type == "cm"){echo "selected";}?> value="cm">cm</option>
													<option <?php if($dimension_type == "mm"){echo "selected";}?> value="mm">mm</option>
													<option <?php if($dimension_type == "m"){echo "selected";}?> value="m">m</option>
													<option <?php if($dimension_type == "in"){echo "selected";}?> value="in">in</option>
													<option <?php if($dimension_type == "ft"){echo "selected";}?> value="ft">ft</option>
													<option <?php if($dimension_type == "yd"){echo "selected";}?> value="yd">yd</option>
												</select>
											</div>
										</div>
									</div>
									<div class="MField-note"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="MPanel MPanel--withLine">
						<div class="row grid-top"></div>
					</div>
				</div>
				<div class="MPanelGroup">
					<h1 class="MPanelGroup-heading">Pricing</h1>
					<p class="MPanelGroup-subheading">Know your product! Be sure to keep your price competitive.</p>
					<section>
						<div class="MPanel MPanel--accountForInescapableFieldBottomMargin MPanel--withLine">
							<div class="row grid-top">
								<div class="col-sm-3">
									<div class="MField">
										<label class="MField-label" for="price">Price</label>
										<div class="MInputWrapper">
											<input required value="<?php echo $price; ?>" name="price"  type="text" id="price" value="">
										</div>
										<div class="MField-note"></div>
									</div>
								</div>
							</div>
						</div>
					</section>
				</div>
				<div class="MPanelGroup">
					<h1 class="MPanelGroup-heading">Advert details</h1>
					<p class="MPanelGroup-subheading">This information will appear in the advert listing and advert details.</p>
					<div>
						<div class="MPanel MPanel--withLine">
							<div class="MField">
								<label class="MField-label" for="title">Title</label>
								<input required type="text" id="product_name" name="product_name"  placeholder="Enter the advert title." value="<?php echo $product_name;?>">
								<div class="MField-note"></div>
							</div>
							
							<div class="MField">
								<label class="MField-label" for="description">Description</label>
								<textarea required name="description" id="description" placeholder="Be creative! Unique, original and detailed descriptions help make your product stand out in online searches." class="MInput MInput--7Rows"><?php echo $description;?></textarea>
								<div class="MField-note"></div>
							</div>
							<div class="MPanel-help">A longer description will help people find your advert faster.</div>
							<div class="MField u-noMarginBottom">
								<label class="MField-label" for="specification">Specifications</label>
								<textarea id="specification" name="specification" placeholder="Enter the product specification." class="MInput MInput--7Rows"><?php echo $specification;?></textarea>
								<div class="MField-note"></div>
							</div>
						</div>
					</div>
				</div>
				<div>




					<div class="MPanelGroup">
						<h1 class="MPanelGroup-heading">Product images</h1>
						<div>
							<p class="MPanelGroup-subheading">Make your advert stand out! <a href="#">Here are some tips on selecting the right image.</a></p>
						</div>
						<div class="MImageUploader">
							<div class="MPanel MPanel--withLine">
								<div class="row">
									<div class="col-sm-12">
										<div class="MFineUploader">
											 <div class="form-group">
										        <image id="banner_image"  class="banner_image img-responsive" src="<?php echo $product_image; ?>" />
										        <input name="product_image" onchange="readURL(this,'banner_image')"  id="imageUpload" class="imageUpload" type="file"  placeholder="Photo" >
										      </div>
										</div>
										<div class="MPanel--uploadWarning">
											<div class="MPanel-help">
												<p>Acceptable image formats are: .PNG, .GIF, .JPG, and .JPEG and we recommend image dimensions of 784 x 480 pixels or at a similar ratio. Ensure the file size is lower than 32MB. Images with text may be rejected by Google.</p>
												<p>Images with text may be rejected by Google.</p>
											</div>
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