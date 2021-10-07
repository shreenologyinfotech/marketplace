<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//require_once(BASEPATH.'core/MY_Controller.php');
class Brands extends MY_Controller {
  function __construct() {
      parent::__construct();
  		$this->load->library('form_validation');    
      $this->load->model('BrandModel');    
		  $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
      $this->Common->is_admin_login();
    }

    
    function setRules($options){
        if($options == "ADD_BRANDS"){
            $this->form_validation->set_rules('is_active', 'Status','trim|required');
            $this->form_validation->set_rules('brand_name', 'Brands Name','trim|required');
            
        } 
    }



     function brandslist(){
        $columns = [0 =>'brand_name',1 =>'brand_image',2 =>'modified_at',3=> 'visible_to_home',4=> 'is_active',5=> 'option'];

        $imageColumns = [];
        $searchableColumns =  [0 =>'brand_name'];
        $colDef['modified_at'] =  ['target' => 0, 'visible' => true, 'searchable' => true];
        $where = [];

        if($this->input->get('ajax')==1){
          $data = $this->ajaxBrandList($this->BrandModel, $columns, $searchableColumns, [], $imageColumns, $where);
          echo $data;exit;
        }else{
          $paginationConfig                  = $this->config->item('pagination');
          $this->data['page_title']          = SITE_TITLE.' :: Brands list';
          $this->data['page']                = $this->_viewPath . "list.php";
          $this->data['useDataTables']       = true;
          $this->data['columns']             = $columns;
          $this->data['colDef']              = $colDef;
          $this->data['default_order_col']   = 0;
          $this->data['default_order_dir']   = $paginationConfig['default_order_dir'];
          $this->data['default_page_length'] = 10;
          $this->load->view($this->_adminContainer, $this->data);
        }
    }

    function addbrands($data = array()){
       $this->data['page_title'] = SITE_TITLE.' :: Add Brands';
       $this->data['page']  = $this->_viewPath . "add.php";
       $this->data['data']  = $data;
       $this->load->view($this->_adminContainer, $this->data);
    }


    function editbrands(){
        $brand_id = $this->uri->segment(3);
        if($brand_id != ""){
           $data = $this->Common->_get_all_records("tbl_brands",array("brand_id"=>$brand_id));
           $this->addbrands($data);

        }else{
          echo show_404();
        }

    }

    function doaddbrands(){
       $data = array(); 
      if(count($_POST) > 0){
        $this->setRules("ADD_BRANDS");
        if($this->form_validation->run()){
          $is_active            = $this->input->post("is_active");  
          $brand_id          = $this->input->post("brand_id");  
          $brand_name        = $this->input->post("brand_name");  
          
          
          $insArray = array(
              "is_active"=>$is_active,
              "brand_name"=>$brand_name,
              "modified_at"=>date("Y-m-d H:i:s")
          );  

          if (isset($_FILES['brand_image']) && $_FILES['brand_image']['name']!=""){
                $insArray["brand_image"]  =  upload_image('brand_image',IMAGE_PATH_ABSULATE.HOME_CATEGORY_FOLDER);
          }


          if($brand_id != ""){  
              $insArray["created_at"]  =  date("Y-m-d H:i:s");
              $this->db->where(array("brand_id"=>$brand_id));
              $this->db->update("tbl_brands",$insArray);
              $this->session->set_userdata(GLOBAL_MSG,"brand updated successfully");
              redirect("./admin/editbrands/".$brand_id);
              
          }else{
              if($this->db->insert("tbl_brands",$insArray)){
                $this->session->set_userdata(GLOBAL_MSG,"brand added successfully");
              }else{
                $this->session->set_userdata(GLOBAL_MSG,"Something went wrong please try again later");
              }
          }  
         }else{
            $this->session->set_userdata(GLOBAL_MSG,filter_validation_errors());
         }
        
      }
      $this->addbrands($data);
    }


    
   






}
