<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Users extends MY_Controller {
  function __construct() {
        parent::__construct();
        $this->load->model('Store');
       	$this->load->library('form_validation');    
  		  $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->Common->is_admin_login();
    }

    function setRules($options){
        
    }

    function index() {
        $columns =  [0 =>'store_id',1 =>'store_name',3 =>'store_email',4=> 'store_mobile', 5=> 'store_image', 6=> 'owner_first_name', 7=>'address',8=>'status', 9=> 'created_at', 10 =>'vat_number',11 =>'vat_verified',12=>'option'];
        
        $imageColumns = [];
        $searchableColumns = [0 =>'store_id',1 =>'store_name',3 =>'store_email',4=> 'store_mobile', 5=> 'store_image', 6=> 'owner_first_name', 7=>'address',8=>'status', 9=> 'created_at', 10 =>'vat_number',11 =>'vat_verified',12=>'option'];

        $colDef['store_email'] =  ['target' => 0, 'visible' => true, 'searchable' => true];


        
        if($this->input->get('ajax')==1){

         
          $data = $this->ajaxStoreList($this->Store, $columns, $searchableColumns, "", $imageColumns, array("status <> "=>"D","user_type"=>"U"));

          echo $data;exit;
        }
        else{
          $paginationConfig = $this->config->item('pagination');
          $this->data['page_title'] = SITE_TITLE.' :: Users list';
          $this->data['page'] = $this->_viewPath . "users.php";
          $this->data['useDataTables'] = true;
          $this->data['columns'] = $columns;
          $this->data['colDef'] = $colDef;
          $this->data['default_order_col'] = 1;
          $this->data['default_order_dir'] = $paginationConfig['default_order_dir'];
          $this->data['default_page_length'] = 10;//$paginationConfig['default_page_length'];
          $this->load->view($this->_adminContainer, $this->data);
        }
    }




}



