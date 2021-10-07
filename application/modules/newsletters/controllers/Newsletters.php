<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Newsletters extends MY_Controller {
  function __construct() {
        parent::__construct();
        $this->load->model('Newsletter');
       	$this->load->library('form_validation');    
  		  $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->Common->is_admin_login();
    }

    function setRules($options){
        
    }


    function delete(){
        $id = $this->uri->segment(3);
        $this->db->delete("tbl_newsletter",array("id"=>$id));
        if($this->db->affected_rows() > 0){
            echo "YES";
        }else{
            echo "NO";
        } 
    }



    function index() {
        $columns =  [0 =>'id', 1 =>'email_address',2 =>'created_at',3 =>'modified_at',4 =>"option"];
        
        $imageColumns = [];
        $searchableColumns = [0 =>'email_address',1 =>'created_at',2 =>'modified_at'];;

        $colDef['email_address'] =  ['target' => 0, 'visible' => true, 'searchable' => true];


        
        if($this->input->get('ajax')==1){

         
          $data = $this->ajaxNewsletter($this->Newsletter, $columns, $searchableColumns, "", $imageColumns, array());

          echo $data;exit;
        }
        else{
          $paginationConfig = $this->config->item('pagination');
          $this->data['page_title'] = SITE_TITLE.' :: Newsletter list';
          $this->data['page'] = $this->_viewPath . "newsletter.php";
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



