<?php if (!defined('BASEPATH'))  exit('No direct script access allowed');
		
class MY_Controller extends CI_Controller {

    protected $_container;
    protected $_modules;
    protected $_viewPath;
    protected $_adminViewPath;
    protected $_loadedModule;
    protected $_adminContainer;
	protected $data = [];
	protected $defaultDateFormat; 

	protected $adveritserPrefix 	= ""; 
	protected $withdrawPrefix 		= "";
	protected $userPrefix 			= "";
	protected $siteCurrencySymbol 	= "";


	
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('output');
		
        $this->load->config('ci_my_admin');
		$this->_loadedModule = CI::$APP->router->fetch_module();
	    // Set container variable
        $this->_adminContainer 	= $this->config->item('admin_container');
        $this->_frontContainer 	= $this->config->item('front_container');
        $this->_apiContainer 	= $this->config->item('api_container');
        $this->_my_account_container 	= $this->config->item('my_account_container');


        $this->_modules 		= $this->config->item('modules_locations');
		$this->_viewPath 		= $this->config->item('module_path').'/'.$this->_loadedModule.'/views/';
		$this->_viewPathApi 	= $this->config->item('module_path').'/Api/'.$this->_loadedModule.'/views/';

		$this->adveritserPrefix 		= get_meta_value("advertiser_prefix"); 
		$this->userPrefix 				= get_meta_value("appuser_prefix");
		$this->siteCurrencySymbol 		= site_currency_symbol();


		$this->defaultDateFormat = date_out();
		$this->data['useDataTables'] = false;
		$this->data['useDataTablesLocal'] = false;
		$this->data['useEditor'] = false;
		$this->data['show_promotion'] = false;

		
		$language = $this->session->userdata('language');
		if($language == ""){
			$language = "english";
		}
		$this->lang->load('front',$language);
        $this->config->set_item('language', $language);


        log_message('debug', 'CI My Admin : MY_Controller class loaded');
    }

    protected function ajaxSubCategoryList($model, $columns, $searchableFields, $options='', $imageColumns=[], $where = []){
		$join['tbl_home_category']['onCloumn'] 	= 'category_id';
	    $join['tbl_home_category']['selfCloumn'] 	= 'category_id';
        $join['tbl_home_category']['type'] = 'inner'; //inner, left, right

        
        $select['main_table'] = ['sub_category_id'=>'sub_category_id','sub_category_name'=>'sub_category_name','is_active'=>'is_active','created_at'=>'created_at'];

		$select['tbl_home_category'] = ['category_name'=>'category_name'];
      	$model->init()->setJoin($join)->setWhere($where);
		$totalData = $model->getCountJoin();
		$totalFiltered = $totalData;
		$requestData = $this->input->get();
		$limit = $requestData['length'];
		$start = $requestData['start'];
		$sort = $requestData['order'];
		$dir = $sort[0]['dir'];
		$order = $requestData['columns'][$sort[0]['column']]['data'];

		if(empty($requestData['search']['value'])){
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setWhere($where)->setSelect($select)->setJoin($join);
			$elements = $model->getRecordsJoin();
		} else {
			$search = $requestData['search']['value'];
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setSearchable($searchableFields)->setSearchTerm($search)->setWhere($where)->setSelect($select)->setJoin($join);
			$elements =  $model->getFilteredRecordsJoin();
			$model->init()->setSearchable($searchableFields)->setSearchTerm($search)->setWhere($where)->setJoin($join);
			$totalFiltered = $model->getFilteredRecordCountJoin();
		}


		for ($i=0; $i < count($elements); $i++) { 
			$options = "";

          	if($elements[$i]->is_active != "Active"){
          		$options .= '<input type="button" class="btn-xs btn btn-success" onclick="performAction(\''.base_url().'ajax/updatestatus/tbl_product_sub_category/Active/'.$elements[$i]->sub_category_id.'\',\'Sub Category Activation\',\'Are you sure want to activate this sub category?\',\'sub category activate successfully\')"  value="Active" />';
          	}else{
          		$options .= '<input type="button"  class="btn-xs btn btn-danger" onclick="performAction(\''.base_url().'ajax/updatestatus/tbl_product_sub_category/Inactive/'.$elements[$i]->sub_category_id.'\',\'Block Sub Category\',\'Are you sure want to inactive this sub category?\',\'sub category inactive successfully\')" value="Inactive" />';
          	} 


          	$options .= '<input type="button"  class="btn-xs btn btn-danger" onclick="performAction(\''.base_url().'ajax/updatestatus/tbl_product_sub_category/Deleted/'.$elements[$i]->sub_category_id.'\',\'Delete Sub Category\',\'Are you sure want to delete this sub category?\',\'sub category deleted successfully\')" value="Delete" />';





          	$options .= '<a href="'.site_url('admin/editsubcategory/'.$elements[$i]->sub_category_id).'" title="Edit" class="btn-xs btn btn-primary">Edit</a>&nbsp;';
          	$elements[$i]->option 	= $options;
		}
		
		$json_data = array(
				"draw"            => intval($this->input->get('draw')),
				"recordsTotal"    => intval($totalData),
				"recordsFiltered" => intval($totalFiltered),
				"data"            => $elements
		);

		return json_encode($json_data);
    }



	protected function ajaxPorductList($model, $columns, $searchableColumns, $options='', $imageColumns=[], $where = []){
		
    	$totalData = $model->init()->setWhere($where)->getCount();
		$totalFiltered = $totalData;
		$requestData = $this->input->get();
		$limit = $requestData['length'];
		$start = $requestData['start'];
		$sort = $requestData['order'];
		$dir = $sort[0]['dir'];
		$order = $requestData['columns'][$sort[0]['column']]['data'];
		if($order == 'store_name'){
			$order = 'store_id';
		}
		//print_r($where);die;
		if(empty($requestData['search']['value'])){
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setWhere($where);
			
			$elements = $model->getRecords();
		}else{
			$search = $requestData['search']['value'];
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$elements =  $model->getFilteredRecords();
			$model->init()->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$totalFiltered = $model->getFilteredRecordCount();
		}


		for ($i=0; $i < count($elements); $i++) { 
			$options = "";

          	if($elements[$i]->is_active != "Active"){
          		$options .= '<input type="button" class="btn-xs btn btn-success" onclick="performAction(\''.base_url().'ajax/updatestatus/tbl_products/Active/'.$elements[$i]->product_id.'\',\'Home Product\',\'Are you sure want to activate this Product?\',\'Home Product successfully\')"  value="Active" />';
          	}else{
          		$options .= '<input type="button"  class="btn-xs btn btn-danger" onclick="performAction(\''.base_url().'ajax/updatestatus/tbl_products/Inactive/'.$elements[$i]->product_id.'\',\'Block Product\',\'Are you sure want to inactive this Product?\',\'Product inactive successfully\')" value="Inactive" />';
          	}  	

          	$options .= '<input type="button"  class="btn-xs btn btn-danger" onclick="performAction(\''.base_url().'ajax/updatestatus/tbl_products/Deleted/'.$elements[$i]->product_id.'\',\'Delete Product\',\'Are you sure want to delete this Product?\',\'Product deleted successfully\')" value="Delete" />';

          	$check = $elements[$i]->visible_to_home;
          	$checked = "";
          	if($check == "Y"){
          		$checked = "checked";
          	}

          	$elements[$i]->store_name = store_name_by_id($elements[$i]->store_id);

          	$elements[$i]->visible_to_home = '<input '.$checked.' type="checkbox" class="btn-xs btn btn-success" onclick="productCheck(this)"  value="'.$elements[$i]->product_id.'" />';
          	$elements[$i]->option 	= $options;

          	$elements[$i]->option 	= $options;
		
		}


		$json_data = array(
				"draw"            => intval($this->input->get('draw')),
				"recordsTotal"    => intval($totalData),
				"recordsFiltered" => intval($totalFiltered),
				"data"            => $elements
		);

		return json_encode($json_data);

    }	


    protected function ajaxBrandList($model, $columns, $searchableColumns, $options='', $imageColumns=[], $where = []){
		
    	$totalData = $model->init()->setWhere($where)->getCount();
		$totalFiltered = $totalData;
		$requestData = $this->input->get();
		$limit = $requestData['length'];
		$start = $requestData['start'];
		$sort = $requestData['order'];
		$dir = $sort[0]['dir'];
		$order = $requestData['columns'][$sort[0]['column']]['data'];
		if(empty($requestData['search']['value'])){
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setWhere($where);
			$elements = $model->getRecords();
		}else{
			$search = $requestData['search']['value'];
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$elements =  $model->getFilteredRecords();
			$model->init()->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$totalFiltered = $model->getFilteredRecordCount();
		}

		for ($i=0; $i < count($elements); $i++) { 
			$options = "";

          	if($elements[$i]->is_active != "Active"){
          		$options .= '<input type="button" class="btn-xs btn btn-success" onclick="performAction(\''.base_url().'ajax/updatestatus/tbl_brands/Active/'.$elements[$i]->brand_id.'\',\'Home Brand\',\'Are you sure want to activate this Brand?\',\'Home Brand successfully\')"  value="Active" />';
          	}else{
          		$options .= '<input type="button"  class="btn-xs btn btn-danger" onclick="performAction(\''.base_url().'ajax/updatestatus/tbl_brands/Inactive/'.$elements[$i]->brand_id.'\',\'Block Brand\',\'Are you sure want to inactive this Brand?\',\'Brand inactive successfully\')" value="Inactive" />';
          	}  	
          	
          	$options .= '<a href="'.site_url('admin/editbrands/'.$elements[$i]->brand_id).'" title="Edit" class="btn-xs btn btn-primary">Edit</a>&nbsp;';

          	if($elements[$i]->brand_image != ""){
          		$elements[$i]->brand_image = '<img src="'.base_url().IMAGE_PATH_URL.HOME_CATEGORY_FOLDER.$elements[$i]->brand_image.'" alt="" border=3 height=100 width=100/>';
          	}

          	
          	$check = $elements[$i]->visible_to_home;
          	$checked = "";
          	if($check == "Y"){
          		$checked = "checked";
          	}

          	$elements[$i]->visible_to_home = '<input '.$checked.' type="checkbox" class="btn-xs btn btn-success" onclick="brandCheck(this)"  value="'.$elements[$i]->brand_id.'" />';
          	$elements[$i]->option 	= $options;
		}

		$json_data = array(
				"draw"            => intval($this->input->get('draw')),
				"recordsTotal"    => intval($totalData),
				"recordsFiltered" => intval($totalFiltered),
				"data"            => $elements
		);

		return json_encode($json_data);

    }


 	
 	protected function ajaxHomeCategoryList($model, $columns, $searchableColumns, $options='', $imageColumns=[], $where = []){
		
    	$totalData = $model->init()->setWhere($where)->getCount();
		$totalFiltered = $totalData;
		$requestData = $this->input->get();
		$limit = $requestData['length'];
		$start = $requestData['start'];
		$sort = $requestData['order'];
		$dir = $sort[0]['dir'];
		$order = $requestData['columns'][$sort[0]['column']]['data'];
		if(empty($requestData['search']['value'])){
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setWhere($where);
			$elements = $model->getRecords();
		}else{
			$search = $requestData['search']['value'];
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$elements =  $model->getFilteredRecords();
			$model->init()->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$totalFiltered = $model->getFilteredRecordCount();
		}

		for ($i=0; $i < count($elements); $i++) { 
			$options = "";

          	if($elements[$i]->is_active != "Active"){
          		$options .= '<input type="button" class="btn-xs btn btn-success" onclick="performAction(\''.base_url().'ajax/updatestatus/tbl_home_category/Active/'.$elements[$i]->category_id.'\',\'Home Category Activation\',\'Are you sure want to activate this Home Category?\',\'Home Category activate successfully\')"  value="Active" />';
          	}else{
          		$options .= '<input type="button"  class="btn-xs btn btn-danger" onclick="performAction(\''.base_url().'ajax/updatestatus/tbl_home_category/Inactive/'.$elements[$i]->category_id.'\',\'Block  Home Category\',\'Are you sure want to inactive this Home Category?\',\'Home Category inactive successfully\')" value="Inactive" />';
          	}  	
          	

          	


          	$options .= '<a href="'.site_url('admin/edithomecategory/'.$elements[$i]->category_id).'" title="Edit" class="btn-xs btn btn-primary">Edit</a>&nbsp;';

          	if($elements[$i]->category_image != ""){
          		$elements[$i]->category_image = '<img src="'.base_url().IMAGE_PATH_URL.HOME_CATEGORY_FOLDER.$elements[$i]->category_image.'" alt="" border=3 height=100 width=100/>';
          	}


          	$check = $elements[$i]->visible_to_home;
          	$checked = "";
          	if($check == "Y"){
          		$checked = "checked";
          	}
          	
          	$elements[$i]->visible_to_home = '<input '.$checked.' type="checkbox" class="btn-xs btn btn-success" onclick="categoryCheck(this)"  value="'.$elements[$i]->category_id.'" />';

          	

          	$elements[$i]->option 	= $options;
		
		}


		$json_data = array(
				"draw"            => intval($this->input->get('draw')),
				"recordsTotal"    => intval($totalData),
				"recordsFiltered" => intval($totalFiltered),
				"data"            => $elements
		);

		return json_encode($json_data);

    }

    protected function ajaxBannerListSearch($model, $columns, $searchableColumns, $options='', $imageColumns=[], $where = []){
		
    	$totalData = $model->init()->setWhere($where)->getCount();
		$totalFiltered = $totalData;
		$requestData = $this->input->get();
		$limit = $requestData['length'];
		$start = $requestData['start'];
		$sort = $requestData['order'];
		$dir = $sort[0]['dir'];
		$order = $requestData['columns'][$sort[0]['column']]['data'];
		if(empty($requestData['search']['value'])){
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setWhere($where);
			$elements = $model->getRecords();
		}else{
			$search = $requestData['search']['value'];
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$elements =  $model->getFilteredRecords();
			$model->init()->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$totalFiltered = $model->getFilteredRecordCount();
		}

		for ($i=0; $i < count($elements); $i++) { 
			$options = "";

			

          	$options .= '<a href="'.site_url('admin/editbanner/'.$elements[$i]->banner_id).'" title="Edit" class="btn-xs btn btn-primary">Edit</a>&nbsp;';

          	if($elements[$i]->banner_image != ""){
          		$elements[$i]->banner_image = '<img src="'.base_url().IMAGE_PATH_URL.BANNER_FOLDER.$elements[$i]->banner_image.'" alt="" border=3 height=100 width=100/>';
          	}

          	$elements[$i]->option 	= $options;
		
		}


		$json_data = array(
				"draw"            => intval($this->input->get('draw')),
				"recordsTotal"    => intval($totalData),
				"recordsFiltered" => intval($totalFiltered),
				"data"            => $elements
		);

		return json_encode($json_data);

    }

    protected function ajaxBannerList($model, $columns, $searchableColumns, $options='', $imageColumns=[], $where = []){
		
    	$totalData = $model->init()->setWhere($where)->getCount();
		$totalFiltered = $totalData;
		$requestData = $this->input->get();
		$limit = $requestData['length'];
		$start = $requestData['start'];
		$sort = $requestData['order'];
		$dir = $sort[0]['dir'];
		$order = $requestData['columns'][$sort[0]['column']]['data'];
		if(empty($requestData['search']['value'])){
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setWhere($where);
			$elements = $model->getRecords();
		}else{
			$search = $requestData['search']['value'];
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$elements =  $model->getFilteredRecords();
			$model->init()->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$totalFiltered = $model->getFilteredRecordCount();
		}

		for ($i=0; $i < count($elements); $i++) { 
			$options = "";

			


			$options .= '<input type="button" class="btn-xs btn btn-danger" onclick="performAction(\''.base_url().'CommonCtrl/updateStatus/tbl_banner/banner_id/'.$elements[$i]->banner_id.'/D'.'\',\'Banner Delete\',\'Are you sure want to delete this banner?\',\'banner deleted successfully\')"  value="Delete" />';


          	if($elements[$i]->is_active != "Active"){
          		$options .= '<input type="button" class="btn-xs btn btn-success" onclick="performAction(\''.base_url().'ajax/updatestatus/tbl_banner/Active/'.$elements[$i]->banner_id.'\',\'Banner Activation\',\'Are you sure want to activate this  Banner?\',\'Banner activate successfully\')"  value="Active" />';
          	}else{
          		$options .= '<input type="button"  class="btn-xs btn btn-danger" onclick="performAction(\''.base_url().'ajax/updatestatus/tbl_banner/Inactive/'.$elements[$i]->banner_id.'\',\'Block  Banner\',\'Are you sure want to inactive this Banner?\',\'Banner inactive successfully\')" value="Inactive" />';
          	}  	
          	
          	$options .= '<a href="'.site_url('admin/editbanner/'.$elements[$i]->banner_id).'" title="Edit" class="btn-xs btn btn-primary">Edit</a>&nbsp;';

          	if($elements[$i]->banner_image != ""){
          		$elements[$i]->banner_image = '<img src="'.base_url().IMAGE_PATH_URL.BANNER_FOLDER.$elements[$i]->banner_image.'" alt="" border=3 height=100 width=100/>';
          	}

          	$elements[$i]->option 	= $options;
		
		}


		$json_data = array(
				"draw"            => intval($this->input->get('draw')),
				"recordsTotal"    => intval($totalData),
				"recordsFiltered" => intval($totalFiltered),
				"data"            => $elements
		);

		return json_encode($json_data);

    }

	


    protected function ajaxParticipateList($model, $columns, $searchableColumns, $options='', $imageColumns=[], $where = []){
		
		$totalData = $model->setWhere($where)->getCount();
		$totalFiltered = $totalData;
		$requestData = $this->input->get();
		$limit = $requestData['length'];
		$start = $requestData['start'];
		$sort = $requestData['order'];
		$dir = $sort[0]['dir'];
		$order = $requestData['columns'][$sort[0]['column']]['data'];
		if(empty($requestData['search']['value'])){
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setWhere($where);
			$elements = $model->getRecords();
		}else{
			$search = $requestData['search']['value'];
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$elements =  $model->getFilteredRecords();
			$model->init()->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$totalFiltered = $model->getFilteredRecordCount();
		}

		$adminRole = get_admin_role();

		for ($i=0; $i < count($elements); $i++) {

         	$userDetails = $this->Common->_get_all_records("tbl_advert_viewer",array("id"=>$elements[$i]->user_id));    

		  	$options = "";	
		  	$options .= '<a href="'.site_url('admin/user/view/'.$elements[$i]->user_id).'" title="User Details"  class="btn-xs btn btn-primary">User Details</a>&nbsp;';

		  	$elements[$i]->option 	= $options;
		
		  	$elements[$i]->username 		= $userDetails[0]->username;
		  	$elements[$i]->email 			= $userDetails[0]->email;
		  	$elements[$i]->contact_number 	= $userDetails[0]->contact_number;
		  	
		  	$elements[$i]->created_at 		= 	 date($this->defaultDateFormat,strtotime($elements[$i]->created_at));
		}
		

		$json_data = array(
				"draw"            => intval($this->input->get('draw')),
				"recordsTotal"    => intval($totalData),
				"recordsFiltered" => intval($totalFiltered),
				"data"            => $elements
		);
		return json_encode($json_data);
    }



    protected function ajaxPricetableListAdvert($model, $columns, $searchableColumns, $options='', $imageColumns=[], $where = []){
		
		$totalData = $model->setWhere($where)->getCount();
		$totalFiltered = $totalData;
		$requestData = $this->input->get();
		$limit = $requestData['length'];
		$start = $requestData['start'];
		$sort = $requestData['order'];
		$dir = $sort[0]['dir'];
		$order = $requestData['columns'][$sort[0]['column']]['data'];
		if(empty($requestData['search']['value'])){
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setWhere($where);
			$elements = $model->getRecords();
		}else{
			$search = $requestData['search']['value'];
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$elements =  $model->getFilteredRecords();
			$model->init()->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$totalFiltered = $model->getFilteredRecordCount();
		}

		$adminRole = get_admin_role();

		for ($i=0; $i < count($elements); $i++) { 
		  	$options = "";	

		  	//if(in_array("manage withdraw", $adminRole)){
		    	$options .= '<a href="'.site_url('admin/pricetableadvert/edit/'.$elements[$i]->id).'" title="View Invoice"  class="btn-xs btn btn-success">Edit</a>&nbsp;';
			//}

            
          	$elements[$i]->earning_per_view_green	= $this->siteCurrencySymbol.show_two_decimal_number($elements[$i]->earning_per_view_green);
          	$elements[$i]->earning_per_view_silver 	= $this->siteCurrencySymbol.show_two_decimal_number($elements[$i]->earning_per_view_silver);
          	$elements[$i]->earning_per_view_gold  	= $this->siteCurrencySymbol.show_two_decimal_number($elements[$i]->earning_per_view_gold);
          	
          	$elements[$i]->option 	= $options;


      	}



		$json_data = array(
				"draw"            => intval($this->input->get('draw')),
				"recordsTotal"    => intval($totalData),
				"recordsFiltered" => intval($totalFiltered),
				"data"            => $elements
		);
		return json_encode($json_data);
    }





    protected function ajaxPricetableList($model, $columns, $searchableColumns, $options='', $imageColumns=[], $where = []){
		
		$totalData = $model->setWhere($where)->getCount();
		$totalFiltered = $totalData;
		$requestData = $this->input->get();
		$limit = $requestData['length'];
		$start = $requestData['start'];
		$sort = $requestData['order'];
		$dir = $sort[0]['dir'];
		$order = $requestData['columns'][$sort[0]['column']]['data'];
		if(empty($requestData['search']['value'])){
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setWhere($where);
			$elements = $model->getRecords();
		}else{
			$search = $requestData['search']['value'];
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$elements =  $model->getFilteredRecords();
			$model->init()->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$totalFiltered = $model->getFilteredRecordCount();
		}

		$adminRole = get_admin_role();

		for ($i=0; $i < count($elements); $i++) { 
		  	$options = "";	

		  	if(in_array("manage withdraw", $adminRole)){
		    	$options .= '<a href="'.site_url('admin/pricetable/edit/'.$elements[$i]->id).'" title="View Invoice"  class="btn-xs btn btn-success">Edit</a>&nbsp;';
			}

            $elements[$i]->pricetable_cpv_normal_advertiser 	= $this->siteCurrencySymbol.show_two_decimal_number($elements[$i]->pricetable_cpv_normal_advertiser); 
          	$elements[$i]->pricetable_cpv_partner_advertiser	= $this->siteCurrencySymbol.show_two_decimal_number($elements[$i]->pricetable_cpv_partner_advertiser);
          	$elements[$i]->pricetable_ppv_user 					= $this->siteCurrencySymbol.show_two_decimal_number($elements[$i]->pricetable_ppv_user);
          	$elements[$i]->id 	= $elements[$i]->id;
          	$elements[$i]->option 	= $options;


      	}



		$json_data = array(
				"draw"            => intval($this->input->get('draw')),
				"recordsTotal"    => intval($totalData),
				"recordsFiltered" => intval($totalFiltered),
				"data"            => $elements
		);
		return json_encode($json_data);
    }




    protected function ajaxEventsList($model, $columns, $searchableColumns, $options='', $imageColumns=[], $where = []){
		
		$totalData = $model->setWhere($where)->getCount();
		$totalFiltered = $totalData;
		$requestData = $this->input->get();
		$limit = $requestData['length'];
		$start = $requestData['start'];
		$sort = $requestData['order'];
		$dir = $sort[0]['dir'];
		$order = $requestData['columns'][$sort[0]['column']]['data'];
		if(empty($requestData['search']['value'])){
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setWhere($where);
			$elements = $model->getRecords();
		}else{
			$search = $requestData['search']['value'];
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$elements =  $model->getFilteredRecords();
			$model->init()->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$totalFiltered = $model->getFilteredRecordCount();
		}

		$adminRole = get_admin_role();

		for ($i=0; $i < count($elements); $i++) { 
		  	$options = "";	
		     

		     if($elements[$i]->status != "Closed" || $elements[$i]->status != "Winner-anounced"){
		     	$options .= '<a href="'.site_url('admin/editevents/'.$elements[$i]->id).'" title="View Invoice"  class="btn-xs btn btn-primary">Edit</a>&nbsp;';


		     	if($elements[$i]->status == "Active"){
		     		$options .= '<input type="button" class="btn-xs btn btn-danger" onclick="performAction(\''.base_url().'events/updatestatus/Inactive/'.$elements[$i]->id.'\',\'Deactivate Event?\',\'Are you sure you want to deactivate the event?\',\'Event deactivated successfully\')" value="Deactivate" />&nbsp;';	
		     	}else{

		     		$options .= '<input type="button" class="btn-xs btn btn-success" onclick="performAction(\''.base_url().'events/updatestatus/Active/'.$elements[$i]->id.'\',\'Activate Event?\',\'Are you sure you want to activate the event?\',\'Event activated successfully\')" value="Activate"/>&nbsp;';	
		     	}
		     }

		    $options .= '<a href="'.site_url('admin/viewparticipate/'.$elements[$i]->id).'" title="View Participate"  class="btn-xs btn btn-warning">View Participants</a>&nbsp;';

		    if($elements[$i]->status == "Winner-anounced"){
		     	$options .= '<a href="'.site_url('/user/view/'.$elements[$i]->winner_id).'" title="Winner Details"  class="btn-xs btn btn-primary">Winner Details</a>&nbsp;';
		    } 


		  $options .= '<input type="button" class="btn-xs btn btn-danger" onclick="performAction(\''.base_url().'events/updatestatus/Closed/'.$elements[$i]->id.'\',\'Delete Event?\',\'Are you sure you want to delete the event?\',\'Event deleted successfully\')" value="Delete"/>&nbsp;';	



          	$elements[$i]->option 	= $options;
          	$elements[$i]->start_date 	=  date($this->defaultDateFormat,strtotime($elements[$i]->start_date));


		}



		$json_data = array(
				"draw"            => intval($this->input->get('draw')),
				"recordsTotal"    => intval($totalData),
				"recordsFiltered" => intval($totalFiltered),
				"data"            => $elements
		);
		return json_encode($json_data);
    }



     protected function ajaxInvoiceList($model, $columns, $searchableColumns, $options='', $imageColumns=[], $where = []){
		
		$totalData = $model->setWhere($where)->getCount();
		$totalFiltered = $totalData;
		$requestData = $this->input->get();
		$limit = $requestData['length'];
		$start = $requestData['start'];
		$sort = $requestData['order'];
		$dir = $sort[0]['dir'];
		$order = $requestData['columns'][$sort[0]['column']]['data'];
		if(empty($requestData['search']['value'])){
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setWhere($where);
			$elements = $model->getRecords();
		}else{
			$search = $requestData['search']['value'];
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$elements =  $model->getFilteredRecords();
			$model->init()->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$totalFiltered = $model->getFilteredRecordCount();
		}

		$adminRole = get_admin_role();


		for ($i=0; $i < count($elements); $i++) { 
		  	$options = "";	
		     
		     $options .= '<a href="'.site_url('admin/invoice/view/'.$elements[$i]->order_id.'/'.$elements[$i]->id).'" title="View Invoice"  class="btn-xs btn btn-success">View</a>&nbsp;';
		  	

          	$elements[$i]->option 	= $options;
          	$elements[$i]->created 	=  date($this->defaultDateFormat,strtotime($elements[$i]->created));
          	$elements[$i]->id 					=  get_invoice_id($elements[$i]->order_id);
          	$elements[$i]->order_id 			=  get_order_id($elements[$i]->order_id);
          	$elements[$i]->user_id 				=  $this->adveritserPrefix.$elements[$i]->user_id;
          	
          	$elements[$i]->total 				=  $this->siteCurrencySymbol.$elements[$i]->total;
     
		}



		$json_data = array(
				"draw"            => intval($this->input->get('draw')),
				"recordsTotal"    => intval($totalData),
				"recordsFiltered" => intval($totalFiltered),
				"data"            => $elements
		);
		return json_encode($json_data);
    }




    protected function ajaxAdvertiserTransactionList($model, $columns, $searchableColumns, $options='', $imageColumns=[], $where = []){
		
		$totalData = $model->setWhere($where)->getCount();
		$totalFiltered = $totalData;
		$requestData = $this->input->get();
		$limit = $requestData['length'];
		$start = $requestData['start'];
		$sort = $requestData['order'];
		$dir = $sort[0]['dir'];
		$order = $requestData['columns'][$sort[0]['column']]['data'];
		if(empty($requestData['search']['value'])){
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setWhere($where);
			$elements = $model->getRecords();
		}else{
			$search = $requestData['search']['value'];
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$elements =  $model->getFilteredRecords();
			$model->init()->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$totalFiltered = $model->getFilteredRecordCount();
		}

		$adminRole = get_admin_role();


		for ($i=0; $i < count($elements); $i++) { 
		  	$options = "";	
		  

		  	if($elements[$i]->transaction_type == "payment"){
		  			$options .= '<a href="'.site_url('viewinvoice/'.$elements[$i]->order_id.'/'.$elements[$i]->transaction_id).'" title="View Invoice"  class="green-bg text-white radius pt-1 pb-1 pl-3 pr-3">View Invoice</a>&nbsp;';
		  	}else if($elements[$i]->transaction_type == "refund"){

		  		$options .= '<a href="'.site_url('viewrefund/'.$elements[$i]->order_id).'" title="View Invoice"  class="green-bg text-white radius pt-1 pb-1 pl-3 pr-3">View Refund</a>&nbsp;';
		  	}

          	$elements[$i]->option 	= $options;
          	$elements[$i]->date 	=  date($this->defaultDateFormat,strtotime($elements[$i]->date));


          	$elements[$i]->order_id 			=  get_order_id($elements[$i]->order_id);
          	
          	if($elements[$i]->transaction_type == "payment"){
          		$elements[$i]->refund_amount = 0;
          	}

          	if($elements[$i]->transaction_type == "refund"){
          		$elements[$i]->amount = 0;
          	}

          	
          	if($elements[$i]->amount <= 0){
          		$elements[$i]->amount = "";
          	}

          	if($elements[$i]->refund_amount <= 0){
          		$elements[$i]->refund_amount = "";
          	}


          	if($elements[$i]->amount != ""){
          		$elements[$i]->amount 				=  $this->siteCurrencySymbol.$elements[$i]->amount;
          	}

          	
          	if($elements[$i]->refund_amount != ""){
          		$elements[$i]->refund_amount 		=  $this->siteCurrencySymbol.$elements[$i]->refund_amount;
          	}

          	
          	



		}



		$json_data = array(
				"draw"            => intval($this->input->get('draw')),
				"recordsTotal"    => intval($totalData),
				"recordsFiltered" => intval($totalFiltered),
				"data"            => $elements
		);
		return json_encode($json_data);
    }



    protected function ajaxTranactionList($model, $columns, $searchableColumns, $options='', $imageColumns=[], $where = []){
		
    	$totalData = $model->setWhere($where)->getCount();
		$totalFiltered = $totalData;
		$requestData = $this->input->get();
		$limit = $requestData['length'];
		$start = $requestData['start'];
		$sort = $requestData['order'];
		$dir = $sort[0]['dir'];
		$order = $requestData['columns'][$sort[0]['column']]['data'];
		if(empty($requestData['search']['value'])){
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setWhere($where);
			$elements = $model->getRecords();
		}else{
			$search = $requestData['search']['value'];
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$elements =  $model->getFilteredRecords();
			$model->init()->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$totalFiltered = $model->getFilteredRecordCount();
		}

		$adminRole = get_admin_role();

		for ($i=0; $i < count($elements); $i++) { 
			$options = "";
			
			if($elements[$i]->transaction_type == "refund"){
				$elements[$i]->amount = "0";
				$options .= '<a href="'.site_url('admin/refund/view/'.$elements[$i]->order_id).'" title="View" class="btn-xs btn btn-success">View</a>&nbsp;';
			}else{
				$elements[$i]->refund_amount = "0";
				$options .= '<a href="'.site_url('admin/invoice/view/'.$elements[$i]->order_id.'/'.$elements[$i]->refund_invoice_id).'" title="View" class="btn-xs btn btn-success">View</a>&nbsp;';
			}
          
			$elements[$i]->option 	= $options;
			$elements[$i]->order_id = get_order_id($elements[$i]->order_id);
			$elements[$i]->date = date($this->defaultDateFormat,strtotime($elements[$i]->date));
		}


		$json_data = array(
				"draw"            => intval($this->input->get('draw')),
				"recordsTotal"    => intval($totalData),
				"recordsFiltered" => intval($totalFiltered),
				"data"            => $elements
		);

		return json_encode($json_data);

    }


    protected function ajaxPageListRetail($model, $columns, $searchableColumns, $options='', $imageColumns=[], $where = []){
		
		$totalData = $model->setWhere($where)->getCount();
		$totalFiltered = $totalData;
		$requestData = $this->input->get();
		$limit = $requestData['length'];
		$start = $requestData['start'];
		$sort = $requestData['order'];
		$dir = $sort[0]['dir'];
		$order = $requestData['columns'][$sort[0]['column']]['data'];
		if(empty($requestData['search']['value'])){
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setWhere($where);
			$elements = $model->getRecords();
		}else{
			$search = $requestData['search']['value'];
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$elements =  $model->getFilteredRecords();
			$model->init()->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$totalFiltered = $model->getFilteredRecordCount();
		}

		$adminRole = get_admin_role();


		for ($i=0; $i < count($elements); $i++) { 
		  	$options = "";	
		  	$options .= '<a href="'.site_url('editpage/'.$elements[$i]->id).'" title="Edit" class="btn-xs btn btn-primary">Edit</a>&nbsp;';
		  	$elements[$i]->description 	= substr($elements[$i]->description, 0,50);
          	$elements[$i]->option 	= $options;
          	
		}


		$json_data = array(
				"draw"            => intval($this->input->get('draw')),
				"recordsTotal"    => intval($totalData),
				"recordsFiltered" => intval($totalFiltered),
				"data"            => $elements
		);
		return json_encode($json_data);
    }

    protected function ajaxPageList($model, $columns, $searchableColumns, $options='', $imageColumns=[], $where = []){
		
		$totalData = $model->setWhere($where)->getCount();
		$totalFiltered = $totalData;
		$requestData = $this->input->get();
		$limit = $requestData['length'];
		$start = $requestData['start'];
		$sort = $requestData['order'];
		$dir = $sort[0]['dir'];
		$order = $requestData['columns'][$sort[0]['column']]['data'];
		if(empty($requestData['search']['value'])){
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setWhere($where);
			$elements = $model->getRecords();
		}else{
			$search = $requestData['search']['value'];
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$elements =  $model->getFilteredRecords();
			$model->init()->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$totalFiltered = $model->getFilteredRecordCount();
		}

		$adminRole = get_admin_role();


		for ($i=0; $i < count($elements); $i++) { 
		  $options = "";	

		  $options .= '<a href="'.site_url('editpage/'.$elements[$i]->id).'" title="Edit" class="btn-xs btn btn-primary">Edit</a>&nbsp;';

		  $options .= '<a href="'.site_url('home/'.$elements[$i]->slug).'" title="View" class="btn-xs btn btn-success">View</a>&nbsp;';
		 
        //  $options .= '<a href="'.site_url('admin/order/view/[id]').'" title="View" class="btn-xs btn btn-success">View</a>';
        //  $options .= '<a href="#" title="View" class="btn-xs btn btn-danger">Delete</a>';
		//$elements[$i]->username = $elements[$i]->username;
        //   	$elements[$i]->created 	=  date($this->defaultDateFormat,strtotime($elements[$i]->created));

		  	$elements[$i]->description 	= substr($elements[$i]->description, 0,50);

          	$elements[$i]->option 	= $options;
          	
		}


		$json_data = array(
				"draw"            => intval($this->input->get('draw')),
				"recordsTotal"    => intval($totalData),
				"recordsFiltered" => intval($totalFiltered),
				"data"            => $elements
		);
		return json_encode($json_data);
    }
    

   /*here */
   
   protected function userWidthdrawRequestAjax($model, $columns, $searchableFields, $options='', $imageColumns=[], $where = []){
		

		$join['tbl_advert_viewer']['onCloumn'] 	= 'user_id';
	    $join['tbl_advert_viewer']['selfCloumn'] 	= 'id';
        $join['tbl_advert_viewer']['type'] = 'inner'; //inner, left, right
	


		$join['tbl_advert_viewer_bank']['onCloumn'] 	= 'user_id';
	    $join['tbl_advert_viewer_bank']['selfCloumn'] 	= 'user_id';
        $join['tbl_advert_viewer_bank']['type'] = 'inner'; //inner, left, right
                


        


        $select['main_table'] = ['user_id'=>'user_id','id'=>'id','amount'=>'amount','payment_mode'=>'payment_mode','user_bank_info'=>'user_bank_info','transaction_details_by_admin'=>'transaction_details_by_admin','status'=>'status','created'=>'created'];


        $select['tbl_advert_viewer'] = ['username'=>'username'];
        $select['tbl_advert_viewer_bank'] = ['account_number'=>'account_number','account_holder_name'=>'account_holder_name','bank_name'=>'bank_name','payment_mobile_number'=>'payment_mobile_number'];

      	$model->init()->setJoin($join)->setWhere($where);


		$totalData = $model->getCountJoin();

		$totalFiltered = $totalData;

		$requestData = $this->input->get();
		
		$limit = $requestData['length'];
		$start = $requestData['start'];
		
		$sort = $requestData['order'];
		
		$dir = $sort[0]['dir'];
		$order = $requestData['columns'][$sort[0]['column']]['data'];

		if(empty($requestData['search']['value']))
		{
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setWhere($where)->setSelect($select)->setJoin($join);
			$elements = $model->getRecordsJoin();
		}
		else {
			$search = $requestData['search']['value'];
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setSearchable($searchableFields)->setSearchTerm($search)->setWhere($where)->setSelect($select)->setJoin($join);
			$elements =  $model->getFilteredRecordsJoin();
			$model->init()->setSearchable($searchableFields)->setSearchTerm($search)->setWhere($where)->setJoin($join);
			$totalFiltered = $model->getFilteredRecordCountJoin();
		}




		/*
		$totalData = $model->setWhere($where)->getCount();
		$totalFiltered = $totalData;
		$requestData = $this->input->get();
		$limit = $requestData['length'];
		$start = $requestData['start'];
		$sort = $requestData['order'];
		$dir = $sort[0]['dir'];
		$order = $requestData['columns'][$sort[0]['column']]['data'];
		if(empty($requestData['search']['value'])){
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setWhere($where);
			$elements = $model->getRecords();
		}else{
			$search = $requestData['search']['value'];
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$elements =  $model->getFilteredRecords();
			$model->init()->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$totalFiltered = $model->getFilteredRecordCount();
		}
		*/
 



		$adminRole = get_admin_role();


		for ($i=0; $i < count($elements); $i++) { 
			$options = "";
			
			//$options = '<a href="'.site_url('admin/user/comments/'.$elements[$i]->id).'" title="Widthdraw Commments" class="btn-xs btn btn-success">Commments</a>&nbsp;';

			$options = '<a href="'.site_url('admin/user/view/'.$elements[$i]->user_id).'" title="User details" class="btn-xs btn btn-primary">user details</a>&nbsp;';

			$elements[$i]->check = "";

			if(in_array("manage withdraw", $adminRole)){

	          	if($elements[$i]->status == "Requested"){
					$elements[$i]->check = '<input value="'.$elements[$i]->id.'" type="checkbox" name="actions[]"/>';
		        }else if($elements[$i]->status == "Approved"){
					$elements[$i]->check = '<input value="'.$elements[$i]->id.'" type="checkbox" name="actionapprove[]"/>';
		        }



	          	if($elements[$i]->status == "Requested"){
	          		
	          	$options .= '<input type="button" class="btn-xs btn btn-success" onclick="performAction(\''.base_url().'ajax/updatewidthdrawstatus/'.$elements[$i]->id.'/Approved\',\''.WITHDRAW_REQUEST_APPROVE_TITLE.'\',\''.WITHDRAW_REQUEST_APPROVE_MSG_TITLE.'\',\''.WITHDRAW_REQUEST_APPROVE_SUCCESS_MSG.'\')" value="Approve"/>&nbsp;';

	          		$options .= '<input type="button" class="btn-xs btn btn-danger" onclick="performAction(\''.base_url().'ajax/updatewidthdrawstatus/'.$elements[$i]->id.'/Cancelled\',\'Cancel Withdraw Request\',\'Are you sure want to cancel withdraw request?\',\'Are you sure want to cancel withdraw request?\')" value="Cancel"/>&nbsp;';


	          	}else if($elements[$i]->status == "Approved"){

                    /*You want to paid this widthdraw request ,\''.WITHDRAW_REQUEST_PAID_MSG_TITLE.'\'	*/
	          		$options .= '<input type="button" class="btn-xs btn btn-success" onclick="performAction(\''.base_url().'ajax/updatewidthdrawstatus/'.$elements[$i]->id.'/Paid\',\'Withdraw Request\',\''.WITHDRAW_REQUEST_PAID_MSG_TITLE.'\',\''.WITHDRAW_REQUEST_PAID_SUCCESS_MSG.'\')" value="Paid" />&nbsp;';

	          	}

          	}

          	if($elements[$i]->status == "Requested"){
          		$elements[$i]->status = '<p class="text-warning"><b>'.$elements[$i]->status.'</b></p>';
          	}else if($elements[$i]->status == "Approved" || $elements[$i]->status == "Paid"){
          		$elements[$i]->status = '<p class="text-success"><b>'.$elements[$i]->status.'</b></p>';
          	}else if($elements[$i]->status == "Cancelled"){
          		$elements[$i]->status = '<p class="text-danger"><b>'.$elements[$i]->status.'</b></p>';
          	}
          	
			//$elements[$i]->username =  app_user_name_by_id($elements[$i]->user_id);
          	$elements[$i]->created 	=  date($this->defaultDateFormat,strtotime($elements[$i]->created));
          	$elements[$i]->option 	= $options;
		}


		$json_data = array(
				"draw"            => intval($this->input->get('draw')),
				"recordsTotal"    => intval($totalData),
				"recordsFiltered" => intval($totalFiltered),
				"data"            => $elements
		);

		return json_encode($json_data);
    }



    protected function ajaxRefundsList($model, $columns, $searchableColumns, $options='', $imageColumns=[], $where = []){
		
    	  $columns = [0 =>'check',1 =>'order_id',2 =>'advertiser_name',3=> 'refunded_amount', 4=> 'details', 5 =>'created', 6 =>'refund_process_date', 7=>'status', 8=>'option'];

    	$join['tbl_advertiser']['onCloumn'] 	= 'user_id';
	    $join['tbl_advertiser']['selfCloumn'] 	= 'id';
        $join['tbl_advertiser']['type'] = 'inner'; //inner, left, right

        $select['main_table'] = ['check'=>'check', 'id'=>'id','order_id'=>'order_id','refunded_amount'=>'refunded_amount','details'=>'details','created'=>'created','refund_process_date'=>'refund_process_date','status'=>'status','user_id'=>'user_id'];
        $select['tbl_advertiser'] = ['fname'=>'fname'];


      	$model->init()->setJoin($join)->setWhere($where);
		$totalData = $model->getCountJoin();

		$totalFiltered = $totalData;

		$requestData = $this->input->get();
		
		$limit = $requestData['length'];
		$start = $requestData['start'];
		
		$sort = $requestData['order'];
		
		$dir = $sort[0]['dir'];
		$order = $requestData['columns'][$sort[0]['column']]['data'];

		if(empty($requestData['search']['value'])){
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setWhere($where)->setSelect($select)->setJoin($join);
			$elements = $model->getRecordsJoin();
		}
		else {
			$search = $requestData['search']['value'];
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setSearchable($searchableFields)->setSearchTerm($search)->setWhere($where)->setSelect($select)->setJoin($join);
			$elements =  $model->getFilteredRecordsJoin();
			$model->init()->setSearchable($searchableFields)->setSearchTerm($search)->setWhere($where)->setJoin($join);
			$totalFiltered = $model->getFilteredRecordCountJoin();
		}



    	/*
    	$totalData = $model->setWhere($where)->getCount();
		$totalFiltered = $totalData;
		$requestData = $this->input->get();
		$limit = $requestData['length'];
		$start = $requestData['start'];
		$sort = $requestData['order'];
		$dir = $sort[0]['dir'];
		$order = $requestData['columns'][$sort[0]['column']]['data'];
		if(empty($requestData['search']['value'])){
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setWhere($where);
			$elements = $model->getRecords();
		}else{
			$search = $requestData['search']['value'];
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$elements =  $model->getFilteredRecords();
			$model->init()->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$totalFiltered = $model->getFilteredRecordCount();
		}*/







		$adminRole = get_admin_role();
		for ($i=0; $i < count($elements); $i++) { 
			$options = "";
			

			$options = '<a href="'.site_url('admin/order/view/'.$elements[$i]->order_id).'" title="Advertiser details" class="btn-xs btn btn-success">Order details</a>&nbsp;';

			if(in_array("manage refunds", $adminRole)){

	          	if($elements[$i]->status == "in-progress" || $elements[$i]->status == "requested"){
	          		$options .= '<input type="button" class="btn-xs btn btn-success" onclick="performAction(\''.base_url().'ajax/completerefund/'.$elements[$i]->id.'\',\''.ACTION_COMPLETE_REFUND_TITLE.'\',\''.ACTION_COMPLETE_REFUND_HEADING.'\',\''.ACTION_COMPLETE_REFUND_SUCCESS_MSG.'\')" value="Complete Refund"/>&nbsp;';
	          	}
          	}
          	
          	$elements[$i]->created 				=  date($this->defaultDateFormat,strtotime($elements[$i]->created));

          	if($elements[$i]->refund_process_date !=  ""){
          		$elements[$i]->refund_process_date 	=  date($this->defaultDateFormat,strtotime($elements[$i]->refund_process_date));	
          	}else{
          		$elements[$i]->refund_process_date 	= "NIL";
          	}
          	
          	/*
          	$adveritserDetails = get_adveritser_details_by_id($elements[$i]->user_id);
          	$elements[$i]->advertiser_name 	=  $adveritserDetails[0]->fname." ".$adveritserDetails[0]->lname;
          	*/
         	$elements[$i]->option 	= $options;
			$elements[$i]->order_id = get_order_id($elements[$i]->order_id);
			
			$elements[$i]->check = "";
			if($elements[$i]->status == "in-progress" || $elements[$i]->status == "requested"){
				$elements[$i]->check = '<input value="'.$elements[$i]->id.'" type="checkbox" name="actions[]"/>';	
			}
		}


		$json_data = array(
				"draw"            => intval($this->input->get('draw')),
				"recordsTotal"    => intval($totalData),
				"recordsFiltered" => intval($totalFiltered),
				"data"            => $elements
		);
		return json_encode($json_data);
    }





    protected function ajaxOrderList($model, $columns, $searchableColumns, $options='', $imageColumns=[], $where = []){
		

    	$totalData = $model->setWhere($where)->getCount();
		$totalFiltered = $totalData;
		$requestData = $this->input->get();
		$limit = $requestData['length'];
		$start = $requestData['start'];
		$sort = $requestData['order'];
		$dir = $sort[0]['dir'];
		$order = $requestData['columns'][$sort[0]['column']]['data'];
		if(empty($requestData['search']['value'])){
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setWhere($where);
			$elements = $model->getRecords();
		}else{
			$search = $requestData['search']['value'];
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$elements =  $model->getFilteredRecords();
			$model->init()->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$totalFiltered = $model->getFilteredRecordCount();
		}

		$adminRole = get_admin_role();

		for ($i=0; $i < count($elements); $i++) { 
			$options = "";
			
		
			$options .= '<a href="'.site_url('admin/order/view/'.$elements[$i]->order_id).'" title="View" class="btn-xs btn btn-success">View</a>&nbsp;';


          	if(in_array("manage orders", $adminRole)){

	          	

	          

	          	$whereOrderId   = array("order_id"=>$elements[$i]->order_id);	
	          	/*$options .=  '<a href="javascript:void(0)" title="Total view" class="btn-xs btn btn-primary">Total View 
	          	: '.$this->Common->getTotalViewOrderById($whereOrderId).'</a>&nbsp;';*/


	          	//$this->Common->getTotalViewOrderById($whereOrderId);
          		
          	}
          	
          	$elements[$i]->user_id = store_owner_first_name($elements[$i]->user_id);
          	$elements[$i]->store_id = store_name_by_id($elements[$i]->store_id);
         
			$elements[$i]->option 	= $options;
			$elements[$i]->order_id = $elements[$i]->order_id;
		}


		$json_data = array(
				"draw"            => intval($this->input->get('draw')),
				"recordsTotal"    => intval($totalData),
				"recordsFiltered" => intval($totalFiltered),
				"data"            => $elements
		);
		return json_encode($json_data);
    }



    protected function ajaxNewsletter($model, $columns, $searchableFields, $options='', $imageColumns=[], $where = []){
		

	    
        $totalData = $model->setWhere($where)->getCount();
		$totalFiltered = $totalData;
		$requestData = $this->input->get();
		$limit = $requestData['length'];
		$start = $requestData['start'];
		$sort = $requestData['order'];
		$dir = $sort[0]['dir'];
		$order = $requestData['columns'][$sort[0]['column']]['data'];
		if(empty($requestData['search']['value'])){
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setWhere($where);
			$elements = $model->getRecords();
		}else{
			$search = $requestData['search']['value'];
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$elements =  $model->getFilteredRecords();
			$model->init()->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$totalFiltered = $model->getFilteredRecordCount();
		}



		

		for ($i=0; $i < count($elements); $i++) { 
			$options = "";
			$options .= '<input type="button"  class="btn-xs btn btn-danger" onclick="performAction(\''.base_url().'newsletters/delete/'.$elements[$i]->id.'\',\'Delete newsletter?\',\'Are you sure you want to block the newsletter?\',\'Newsletter deleted successfully\')"  value="Delete" />&nbsp;';

			
			$elements[$i]->id 			=  $i+1;
			$elements[$i]->created_at 			=  date($this->defaultDateFormat,strtotime($elements[$i]->created_at));
			$elements[$i]->modified_at 			=  date($this->defaultDateFormat,strtotime($elements[$i]->modified_at));

			$elements[$i]->option 			= $options;
		}
		

		$json_data = array(
				"draw"            => intval($this->input->get('draw')),
				"recordsTotal"    => intval($totalData),
				"recordsFiltered" => intval($totalFiltered),
				"data"            => $elements
		);

		return json_encode($json_data);

    }



    protected function ajaxStoreList($model, $columns, $searchableFields, $options='', $imageColumns=[], $where = []){
		
	    
        $totalData = $model->setWhere($where)->getCount();
		$totalFiltered = $totalData;
		$requestData = $this->input->get();
		$limit = $requestData['length'];
		$start = $requestData['start'];
		$sort = $requestData['order'];
		$dir = $sort[0]['dir'];
		$order = $requestData['columns'][$sort[0]['column']]['data'];
		if(empty($requestData['search']['value'])){
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setWhere($where);
			$elements = $model->getRecords();
		}else{
			$search = $requestData['search']['value'];
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$elements =  $model->getFilteredRecords();
			$model->init()->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$totalFiltered = $model->getFilteredRecordCount();
		}



		

		for ($i=0; $i < count($elements); $i++) { 
			$options = "";
			
			// $options .= '<a href="'.site_url('editstore/'.$elements[$i]->store_id).'" title="Edit" class="btn-xs btn btn-primary">Edit</a>&nbsp;';

			 $user  = "User";
			 if($elements[$i]->user_type != "U"){
			 	$user  = "Store";
			 }

			 if($elements[$i]->status == "A"){
          		
          		$options .= '<input type="button"  class="btn-xs btn btn-danger" onclick="performAction(\''.base_url().'stores/inactive/'.$elements[$i]->store_id.'\',\'Block '.$user.'?\',\'Are you sure you want to block the '.$user.'?\',\''.$user.' blocked successfully\')"  value="Block" />&nbsp;';
          		

          	}else if($elements[$i]->status == "I"){
          		$options .= '<input type="button"  class="btn-xs btn btn-primary" onclick="performAction(\''.base_url().'stores/approve/'.$elements[$i]->store_id.'\',\'Activate '.$user.'?\',\'Are you sure you want to activate the '.$user.'?\',\''.$user.' activated successfully\')" value="Activate" />&nbsp;';
          	} 
          	

          	$options .= '<input type="button"  class="btn-xs btn btn-danger" onclick="performAction(\''.base_url().'stores/delete/'.$elements[$i]->store_id.'\',\'Delete '.$user.'?\',\'Are you sure you want to delete the '.$user.'?\',\''.$user.' deleted successfully\')"  value="Delete" />&nbsp;';


          	if($elements[$i]->status == "D"){
          		$elements[$i]->status = '<p class="text-danger"><b>'.$elements[$i]->status.'</b></p>';
          	}else if($elements[$i]->status == "A"){
          		$elements[$i]->status = '<p class="text-success"><b>'.$elements[$i]->status.'</b></p>';
          	}else if($elements[$i]->status == "I"){
          		$elements[$i]->status = '<p class="text-muted"><b>'.$elements[$i]->status.'</b></p>';
          	} 
          	if($elements[$i]->vat_verified == "N"){
          		$elements[$i]->vat_verified = '<p class="text-danger"><b>'.$elements[$i]->vat_verified.'</b></p>';
          		$options .= '<input type="button"  class="btn-xs btn btn-success" onclick="performAction(\''.base_url().'stores/activevat/'.$elements[$i]->store_id.'\',\'Approve the Vat Of '.$user.'?\',\'Are you sure you want to Approve Vat Of the '.$user.'?\',\''.$user.' Vat Approved successfully\')"  value="VatApprove" />&nbsp;';
          	}else if($elements[$i]->vat_verified == "Y"){
          		$elements[$i]->vat_verified = '<p class="text-success"><b>'.$elements[$i]->vat_verified.'</b></p>';
          		$options .= '<input type="button"  class="btn-xs btn btn-danger" onclick="performAction(\''.base_url().'stores/inactivevat/'.$elements[$i]->store_id.'\',\'Reject the Vat Of '.$user.'?\',\'Are you sure you want to Reject Vat of the '.$user.'?\',\''.$user.' Vat Rejected successfully\')"  value="VatReject" />&nbsp;';
          	}
          	

          	$elements[$i]->created_at 			=  date($this->defaultDateFormat,strtotime($elements[$i]->created_at));
			$elements[$i]->option 			= $options;
	
			

			$check = $elements[$i]->visible_to_home;
          	$checked = "";
          	if($check == "Y"){
          		$checked = "checked";
          	}

          	$elements[$i]->visible_to_home = '<input '.$checked.' type="checkbox" class="btn-xs btn btn-success" onclick="storeCheck(this)"  value="'.$elements[$i]->store_id.'" />';


		}


		$json_data = array(
				"draw"            => intval($this->input->get('draw')),
				"recordsTotal"    => intval($totalData),
				"recordsFiltered" => intval($totalFiltered),
				"data"            => $elements
		);

		return json_encode($json_data);

    }




    protected function ajaxAppUserList($model, $columns, $searchableFields, $options='', $imageColumns=[], $where = []){
		
	    $join['tbl_advert_viewer_bank']['onCloumn'] 	= 'id';
	    $join['tbl_advert_viewer_bank']['selfCloumn'] 	= 'user_id';
        $join['tbl_advert_viewer_bank']['type'] = 'inner'; //inner, left, right

        $select['main_table'] = ['id'=>'id','contact_number'=>'contact_number','email'=>'email','postal_code'=>'postal_code','package_id'=>'package_id','self_referral_code'=>'self_referral_code','created'=>'created','payment_mode'=>'payment_mode','status'=>'status'];
        $select['tbl_advert_viewer_bank'] = ['account_holder_name'=>'account_holder_name','account_number'=>'account_number','bank_name'=>'bank_name','payment_mobile_number'=>'payment_mobile_number'];


      	$model->init()->setJoin($join)->setWhere($where);
		$totalData = $model->getCountJoin();

		$totalFiltered = $totalData;

		$requestData = $this->input->get();
		
		$limit = $requestData['length'];
		$start = $requestData['start'];
		
		$sort = $requestData['order'];
		
		$dir = $sort[0]['dir'];
		$order = $requestData['columns'][$sort[0]['column']]['data'];

		if(empty($requestData['search']['value']))
		{
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setWhere($where)->setSelect($select)->setJoin($join);
			$elements = $model->getRecordsJoin();
		}
		else {
			$search = $requestData['search']['value'];
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setSearchable($searchableFields)->setSearchTerm($search)->setWhere($where)->setSelect($select)->setJoin($join);
			$elements =  $model->getFilteredRecordsJoin();
			$model->init()->setSearchable($searchableFields)->setSearchTerm($search)->setWhere($where)->setJoin($join);
			$totalFiltered = $model->getFilteredRecordCountJoin();
		}

		
    	/*$totalData = $model->setWhere($where)->getCount();
		$totalFiltered = $totalData;
		$requestData = $this->input->get();
		$limit = $requestData['length'];
		$start = $requestData['start'];
		$sort = $requestData['order'];
		$dir = $sort[0]['dir'];
		$order = $requestData['columns'][$sort[0]['column']]['data'];
		if(empty($requestData['search']['value'])){
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setWhere($where);
			$elements = $model->getRecords();
		}else{
			$search = $requestData['search']['value'];
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$elements =  $model->getFilteredRecords();
			$model->init()->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$totalFiltered = $model->getFilteredRecordCount();
		}
		*/


		$adminRole = get_admin_role();

		for ($i=0; $i < count($elements); $i++) { 
			$options = "";
			$options .= '<a href="'.site_url('admin/user/view/'.$elements[$i]->id).'" title="View" class="btn-xs btn btn-success">View</a>&nbsp;';


			if(in_array("manage app user",$adminRole)){
				$options .= '<a href="'.site_url('edituser/'.$elements[$i]->id).'" title="Edit" class="btn-xs btn btn-primary">Edit</a>&nbsp;';


				 if($elements[$i]->status == "Approved"){
	          		if($elements[$i]->status != "Deleted"){
	          			$options .= '<input type="button"  class="btn-xs btn btn-danger" onclick="performAction(\''.base_url().'users/inactive/'.$elements[$i]->id.'\',\'Block User?\',\'Are you sure you want to block the user?\',\'User blocked successfully\')"  value="Block" />&nbsp;';
	          		}

	          	}else if($elements[$i]->status == "Pending"){
	          		$options .= '<input type="button"  class="btn-xs btn btn-primary" onclick="performAction(\''.base_url().'users/approve/'.$elements[$i]->id.'\',\'Approve User\',\'Are you sure want to approve user?\',\'user approve successfully\')" value="Approve" />&nbsp;';
	          	
	          	}else if($elements[$i]->status == "Inactive"){
	          		$options .= '<input type="button"  class="btn-xs btn btn-primary" onclick="performAction(\''.base_url().'users/approve/'.$elements[$i]->id.'\',\'Activate User?\',\'Are you sure you want to activate the user?\',\'User activated successfully\')" value="Activate" />&nbsp;';

	          	} 
          	}

			
          
          	$options .= '<a href="'.site_url('admin/user/withdrawrequest/'.$elements[$i]->id).'" title="withdrawrequest" class="btn-xs btn btn-warning">Withdraw Requests</a>&nbsp;';


          	$elements[$i]->check = '<input value="'.$elements[$i]->id.'" type="checkbox" name="actions[]"/>';

          	if($elements[$i]->status == "Deleted"){
          		$elements[$i]->status = '<p class="text-danger"><b>'.$elements[$i]->status.'</b></p>';
          	}else if($elements[$i]->status == "Approved"){
          		$elements[$i]->status = '<p class="text-success"><b>'.$elements[$i]->status.'</b></p>';
          		

          	}else if($elements[$i]->status == "Pending"){
          		$elements[$i]->status = '<p class="text-info"><b>'.$elements[$i]->status.'</b></p>';
          		
          	
          	}else if($elements[$i]->status == "Inactive"){
          		$elements[$i]->status = '<p class="text-muted"><b>'.$elements[$i]->status.'</b></p>';
          		

          	} 

          	/*
         	 $dataBank = $this->Common->_get_all_records("tbl_advert_viewer_bank",array("user_id"=>$elements[$i]->id));     
          	 if(sizeof($dataBank) > 0){
          		$elements[$i]->account_holder_name  = $dataBank[0]->account_holder_name;
          		$elements[$i]->account_number		= $dataBank[0]->account_number;
          		$elements[$i]->bank_name 			= $dataBank[0]->bank_name;	
          		$elements[$i]->payment_mobile_number = $dataBank[0]->payment_mobile_number;
          	}else{
          		$elements[$i]->account_holder_name = "";
          		$elements[$i]->account_number = "";
          		$elements[$i]->bank_name = "";
          		$elements[$i]->payment_mobile_number = "";
          	}
          	*/

          	$elements[$i]->created 			=  date($this->defaultDateFormat,strtotime($elements[$i]->created));
			$elements[$i]->option 			= $options;
			$elements[$i]->id 				= $this->userPrefix.$elements[$i]->id;
			$elements[$i]->package_id 		= get_packages_level_from_id($elements[$i]->package_id);

			
		}


		$json_data = array(
				"draw"            => intval($this->input->get('draw')),
				"recordsTotal"    => intval($totalData),
				"recordsFiltered" => intval($totalFiltered),
				"data"            => $elements
		);

		return json_encode($json_data);

    }

    

    protected function ajaxPromoList($model, $columns, $searchableColumns, $options='', $imageColumns=[], $where = []){
		
    	$totalData = $model->setWhere($where)->getCount();
		$totalFiltered = $totalData;
		$requestData = $this->input->get();
		$limit = $requestData['length'];
		$start = $requestData['start'];
		$sort = $requestData['order'];
		$dir = $sort[0]['dir'];
		$order = $requestData['columns'][$sort[0]['column']]['data'];
		if(empty($requestData['search']['value'])){
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setWhere($where);
			$elements = $model->getRecords();
		}else{
			$search = $requestData['search']['value'];
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$elements =  $model->getFilteredRecords();
			$model->init()->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$totalFiltered = $model->getFilteredRecordCount();
		}




		for ($i=0; $i < count($elements); $i++) { 
			$options = "";
			
			
		

			$options = '<a href="'.site_url('admin/editpromo/'.$elements[$i]->promo_id).'" title="Edit" class="btn-xs btn btn-primary">Edit</a>&nbsp;';


			$options .= '<input type="button" class="btn-xs btn btn-danger" onclick="performAction(\''.base_url().'CommonCtrl/updateStatus/tbl_promo/promo_id/'.$elements[$i]->promo_id.'/D'.'\',\'Promo Delete\',\'Are you sure want to delete this promo?\',\'promo deleted successfully\')"  value="Delete" />';



          	if($elements[$i]->status != "active"){
          		$options .= '<input type="button" class="btn-xs btn btn-success" onclick="performAction(\''.base_url().'CommonCtrl/updateStatus/tbl_promo/promo_id/'.$elements[$i]->promo_id.'/active'.'\',\'Promo Activation\',\'Are you sure want to activate this promo?\',\'promo activate successfully\')"  value="Activate" />';
          	}else{

          		$options .= '<input type="button" class="btn-xs btn btn-success" onclick="performAction(\''.base_url().'CommonCtrl/updateStatus/tbl_promo/promo_id/'.$elements[$i]->promo_id.'/inactive'.'\',\'Promo Deactivation\',\'Are you sure want to deactivate this promo?\',\'promo deactivated successfully\')"  value="Disable" />';

          		
          	} 
		
			if($elements[$i]->status != "active"){
	          		$elements[$i]->status = '<p class="text-danger"><b>'.$elements[$i]->status.'</b></p>';
          	}else{
          		$elements[$i]->status = '<p class="text-success"><b>'.$elements[$i]->status.'</b></p>';
          	} 

	

            $elements[$i]->created_at 	=  ($i + 1);

          	$elements[$i]->option 	= $options;

          	
          
          	$count = 0;
          	
		
		}


		$json_data = array(
				"draw"            => intval($this->input->get('draw')),
				"recordsTotal"    => intval($totalData),
				"recordsFiltered" => intval($totalFiltered),
				"data"            => $elements
		);

		return json_encode($json_data);

    }



    protected function ajaxAdminList($model, $columns, $searchableColumns, $options='', $imageColumns=[], $where = []){
		
    	$totalData = $model->init()->setWhere($where)->getCount();
		$totalFiltered = $totalData;
		$requestData = $this->input->get();
		$limit = $requestData['length'];
		$start = $requestData['start'];
		$sort = $requestData['order'];
		$dir = $sort[0]['dir'];
		$order = $requestData['columns'][$sort[0]['column']]['data'];
		if(empty($requestData['search']['value'])){
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setWhere($where);
			$elements = $model->getRecords();
		}else{
			$search = $requestData['search']['value'];
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$elements =  $model->getFilteredRecords();
			$model->init()->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$totalFiltered = $model->getFilteredRecordCount();
		}



		for ($i=0; $i < count($elements); $i++) { 
			$options = "";
			
			
			if($elements[$i]->is_superadmin == "yes"){
				$options = '<a href="javascript:void(0)" title="super admin" class="btn-xs btn btn-primary">super admin</a>&nbsp;';
			}else{

				$options = '<a href="'.site_url('admin/editadmin/'.$elements[$i]->admin_id).'" title="Edit" class="btn-xs btn btn-primary">Edit</a>&nbsp;';

	          	if($elements[$i]->status != "active"){
	          		$options .= '<input type="button" class="btn-xs btn btn-success" onclick="performAction(\''.base_url().'admindashboard/activeadmin/'.$elements[$i]->admin_id.'\',\'User Activation\',\'Are you sure want to activate user?\',\'admin activate successfully\')"  value="Activate" />';
	          		

	          	}else{
	          		$options .= '<input type="button"  class="btn-xs btn btn-danger" onclick="performAction(\''.base_url().'admindashboard/blockadmin/'.$elements[$i]->admin_id.'\',\'Block Admin\',\'Are you sure want to block the user?\',\'Admin block successfully\')" value="Block" />';
	          	} 
			}	
			

			if($elements[$i]->status != "active"){
	          		$elements[$i]->status = '<p class="text-danger"><b>'.$elements[$i]->status.'</b></p>';
          	}else{
          		$elements[$i]->status = '<p class="text-success"><b>'.$elements[$i]->status.'</b></p>';
          	} 

          	$elements[$i]->created_at 	=  date($this->defaultDateFormat,strtotime($elements[$i]->created_at));
          	$elements[$i]->option 	= $options;

          	$role  = json_decode($elements[$i]->roles,true);
          	$roleString = "";
          	$count = 0;
          	foreach ($role as $result) {
          		if($count == 0){
          			$roleString = 	$result;
          		}else{
          			$roleString = 	$roleString.",".$result;
          		}
          		$count++;
          	}	
          	$elements[$i]->roles 	= $roleString;
		
		}


		$json_data = array(
				"draw"            => intval($this->input->get('draw')),
				"recordsTotal"    => intval($totalData),
				"recordsFiltered" => intval($totalFiltered),
				"data"            => $elements
		);

		return json_encode($json_data);

    }



    protected function ajaxAdvertiserList($model, $columns, $searchableColumns, $options='', $imageColumns=[], $where = []){
		
    	$totalData = $model->setWhere($where)->getCount();
		$totalFiltered = $totalData;
		$requestData = $this->input->get();
		$limit = $requestData['length'];
		$start = $requestData['start'];
		$sort = $requestData['order'];
		$dir = $sort[0]['dir'];
		$order = $requestData['columns'][$sort[0]['column']]['data'];
		if(empty($requestData['search']['value'])){
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setWhere($where);
			$elements = $model->getRecords();
		}else{
			$search = $requestData['search']['value'];
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$elements =  $model->getFilteredRecords();
			$model->init()->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$totalFiltered = $model->getFilteredRecordCount();
		}

		$adminRole = get_admin_role();

		for ($i=0; $i < count($elements); $i++) { 
			$options = "";
			
			

          	$options .= '<a href="'.site_url('admin/advertiser/view/'.$elements[$i]->id).'" title="View" class="btn-xs btn btn-success">View</a>&nbsp;';

          	if(in_array("manage advertiser",$adminRole)){



          	$options .= '<a href="'.site_url('editadvertiser/'.$elements[$i]->id).'" title="Edit" class="btn-xs btn btn-primary">Edit</a>&nbsp;';
          

          	if($elements[$i]->status == "Deleted"){
          		$elements[$i]->status = '<p class="text-danger"><b>'.$elements[$i]->status.'</b></p>';
          	}else if($elements[$i]->status == "Approved"){
          		$elements[$i]->status = '<p class="text-success"><b>'.$elements[$i]->status.'</b></p>';
          		if($elements[$i]->status != "Deleted"){
          			$options .= '<input type="button" class="btn-xs btn btn-danger" onclick="performAction(\''.base_url().'advertisers/inactive/'.$elements[$i]->id.'\',\'Block Advertiser?\',\'Are you sure you want to block the Advertiser?\',\'Advertiser blocked successfully\')" value="Block"/>';
          		}

          	}else if($elements[$i]->status == "Pending"){
          		$elements[$i]->status = '<p class="text-info"><b>'.$elements[$i]->status.'</b></p>';
          		$options .= '<input type="button" class="btn-xs btn btn-primary" onclick="performAction(\''.base_url().'advertisers/approve/'.$elements[$i]->id.'\',\'Approve Advertiser?\',\'Are you sure want to approve Advertiser?\',\'Advertiser approved successfully\')" value="Approve"/>';
          	
          	}else if($elements[$i]->status == "Inactive"){
          		$elements[$i]->status = '<p class="text-muted"><b>'.$elements[$i]->status.'</b></p>';
          		$options .= '<input type="button" class="btn-xs btn btn-primary" onclick="performAction(\''.base_url().'advertisers/approve/'.$elements[$i]->id.'\',\'Activate Advertiser?\',\'Are you sure you want to activate the Advertiser?\',\'Advertiser activated successfully\')"   value="Activate"/>';

          	} 

	          	if($elements[$i]->is_partner == "no"){
	          		$options .= '<input type="button" class="btn-xs btn btn-success" onclick="performAction(\''.base_url().'advertisers/assignpartner/'.$elements[$i]->id.'\',\'Assign as Partner?\',\'Are you sure you want to assign this advertiser as your partner?\',\'Advertiser has been assigned as your partner successfully\')"  value="Assign partner"/>';
	          	}else{
	          		$options .= '<input type="button" class="btn-xs btn btn-danger" onclick="performAction(\''.base_url().'advertisers/unassignpartner/'.$elements[$i]->id.'\',\'Remove as partner?\',\'Are you sure you want to remove this advertiser as your partner?\',\'Advertiser has been removed as your partner successfully\')" value="Remove partner"/>';
	          	}

          	}

          	$elements[$i]->check = '<input value="'.$elements[$i]->id.'" type="checkbox" name="actions[]"/>';


          	$elements[$i]->created 	=  date($this->defaultDateFormat,strtotime($elements[$i]->created));
			$elements[$i]->option 	= $options;
			$elements[$i]->id 		= $this->adveritserPrefix.$elements[$i]->id;
		}


		$json_data = array(
				"draw"            => intval($this->input->get('draw')),
				"recordsTotal"    => intval($totalData),
				"recordsFiltered" => intval($totalFiltered),
				"data"            => $elements
		);

		return json_encode($json_data);

    }




    
    
    protected function paginate($model, $columns, $searchableColumns, $options='', $imageColumns=[], $where = [],$oldValue="",$newValue="",$matchKey="",$matchValue=""){

		$totalData = $model->setWhere($where)->getCount();

		$totalFiltered = $totalData;
		
		$requestData = $this->input->get();
		
		$limit = $requestData['length'];
		$start = $requestData['start'];
		
		$sort = $requestData['order'];
		
		$dir = $sort[0]['dir'];
		$order = $requestData['columns'][$sort[0]['column']]['data'];
		

		if(empty($requestData['search']['value']))
		{
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setWhere($where);
			$elements = $model->getRecords();
		}
		else {
			
			$search = $requestData['search']['value'];
			
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$elements =  $model->getFilteredRecords();
			
			$model->init()->setSearchable($searchableColumns)->setSearchTerm($search)->setWhere($where);
			$totalFiltered = $model->getFilteredRecordCount();
		}

		$data = array();
	
		
		if(!empty($elements)){
		
			foreach ($elements as $element)
			{
				$optionUpdated = '';
				foreach($element as $k=>$v){
					if(in_array($k, $columns)){
							
						if(count($imageColumns)){
							
							if(array_key_exists($k, $imageColumns)){
								if($v!=''){
									$src = base_url().ltrim($imageColumns[$k]['upload_path'], './').$v;
								
									$width = '';
									$height = '';
									if(isset($imageColumns[$k]['width'])){
										$width = 'width="'.$imageColumns[$k]['width'].'"';
									}
									if(isset($imageColumns[$k]['height'])){
										$height = 'height="'.$imageColumns[$k]['height'].'"';
									}	
									$nestedData[$k] = '<img src="'.$src.'" '.$width.' '.$height.'>';	
								}
								else{
									$nestedData[$k] = $v;
								}	
							}
							elseif($k=='created' || $k=='modified' || $k=='start_date' || $k=='end_date'){
							
								$nestedData[$k] = date($this->defaultDateFormat,strtotime($v));
							}
							else{
								$nestedData[$k] = $v;
							}			
						}
						elseif($k=='created' || $k=='modified' || $k=='start_date' || $k=='end_date'){
							
								$nestedData[$k] = date($this->defaultDateFormat,strtotime($v));
						}
						else{	
							$nestedData[$k] = $v;
						}
					}
					 		
					if(preg_match('/\['.$k.'\]/',$options)){
						$optionUpdated .= str_replace('['.$k.']',$v, $options);

						if($oldValue != "" && $newValue != "" && $matchKey != "" && $matchValue != ""){
							if($k == $matchKey && $v == $matchValue){

								$optionUpdated = str_replace($oldValue, $newValue, $optionUpdated);	
							}
						}	
					}
				}

				if(in_array('option',$columns) && $optionUpdated!=''){
					$nestedData['option'] = $optionUpdated;
				}			

				$data[] = $nestedData;

			}
		}
		
		$json_data = array(
				"draw"            => intval($this->input->get('draw')),
				"recordsTotal"    => intval($totalData),
				"recordsFiltered" => intval($totalFiltered),
				"data"            => $data
		);

		return json_encode($json_data);
	}







	
	protected function paginateJoin($model, $join, $select, $columns, $searchableFields, $options='', $imageColumns=[], $where = []){
		
		$model->init()->setJoin($join)->setWhere($where);
		$totalData = $model->getCountJoin();

		$totalFiltered = $totalData;

		$requestData = $this->input->get();
		
		$limit = $requestData['length'];
		$start = $requestData['start'];
		
		$sort = $requestData['order'];
		
		$dir = $sort[0]['dir'];
		$order = $requestData['columns'][$sort[0]['column']]['data'];

		if(empty($requestData['search']['value']))
		{
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setWhere($where)->setSelect($select)->setJoin($join);
			$elements = $model->getRecordsJoin();
		}
		else {
			$search = $requestData['search']['value'];
			
			$model->init()->setStart($start)->setLimit($limit)->setOrder($order)->setDirection($dir)->setSearchable($searchableFields)->setSearchTerm($search)->setWhere($where)->setSelect($select)->setJoin($join);
			$elements =  $model->getFilteredRecordsJoin();
			
			$model->init()->setSearchable($searchableFields)->setSearchTerm($search)->setWhere($where)->setJoin($join);
			$totalFiltered = $model->getFilteredRecordCountJoin();
		}

		$data = array();
		

		if(!empty($elements)){
		
			foreach ($elements as $element)
			{
				$optionUpdated = '';
				foreach($element as $k=>$v){
					if(in_array($k, $columns)){
							
						if(count($imageColumns)){
							
							if(array_key_exists($k, $imageColumns)){
								if($v!=''){
									$src = base_url().ltrim($imageColumns[$k]['upload_path'], './').$v;
								
									$width = '';
									$height = '';
									if(isset($imageColumns[$k]['width'])){
										$width = 'width="'.$imageColumns[$k]['width'].'"';
									}
									if(isset($imageColumns[$k]['height'])){
										$height = 'height="'.$imageColumns[$k]['height'].'"';
									}	
									$nestedData[$k] = '<img src="'.$src.'" '.$width.' '.$height.'>';	
								}
								else{
									$nestedData[$k] = $v;
								}	
							}
							elseif($k=='created' || $k=='modified'){
							
								$nestedData[$k] = date($this->defaultDateFormat,strtotime($v));
							}
							else{
								$nestedData[$k] = $v;
							}			
						}
						elseif($k=='created' || $k=='modified'){
							
								$nestedData[$k] = date($this->defaultDateFormat,strtotime($v));
						}
						else{	
							$nestedData[$k] = $v;
						}
					}
					 		
					if(preg_match('/\['.$k.'\]/',$options)){
						$optionUpdated .= str_replace('['.$k.']',$v, $options);
					}
							
				}

				if(in_array('option',$columns) && $optionUpdated!=''){
					$nestedData['option'] = $optionUpdated;
				}			

				$data[] = $nestedData;

			}
		}
		

		$json_data = array(
				"draw"            => intval($this->input->get('draw')),
				"recordsTotal"    => intval($totalData),
				"recordsFiltered" => intval($totalFiltered),
				"data"            => $data
		);

		return json_encode($json_data);
	}
		
}
