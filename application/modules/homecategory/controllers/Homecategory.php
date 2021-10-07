<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//require_once(BASEPATH.'core/MY_Controller.php');
class Homecategory extends MY_Controller {
  function __construct() {
      parent::__construct();
  		$this->load->library('form_validation');    
      $this->load->model('HomeCategoryModel');    
		  $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
      $this->Common->is_admin_login();
    }

    
    function setRules($options){
        if($options == "ADD_HOME_CATEGORY"){
            $this->form_validation->set_rules('is_active', 'Status','trim|required');
            $this->form_validation->set_rules('category_name', 'Category Name','trim|required');
            $this->form_validation->set_rules('is_home_category', 'Is Home Category','trim|required');
            $this->form_validation->set_rules('is_menu_category', 'Is Menu Category','trim|required');
        } 
    }



     function homecategorylist(){
        $columns = [0 =>'category_name',1 =>'is_menu_category',2 =>'category_image',3 =>'modified_at',4 =>'visible_to_home',5=> 'is_active',6=> 'option'];

        $imageColumns = [];
        $searchableColumns =  [0 =>'category_name'];
        $colDef['modified_at'] =  ['target' => 0, 'visible' => true, 'searchable' => true];
        $where = ["is_active <>"=>"Deleted"];

        if($this->input->get('ajax')==1){
          $data = $this->ajaxHomeCategoryList($this->HomeCategoryModel, $columns, $searchableColumns, [], $imageColumns, $where);
          echo $data;exit;
        }else{
          $paginationConfig                  = $this->config->item('pagination');
          $this->data['page_title']          = SITE_TITLE.' :: Home Category list';
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

    function addhomecategory($data = array()){
       $this->data['page_title'] = SITE_TITLE.' :: Manage Home Category';
       $this->data['page']  = $this->_viewPath . "add.php";
       $this->data['data']  = $data;
       $this->load->view($this->_adminContainer, $this->data);
    }


    function edithomecategory(){
        $category_id = $this->uri->segment(3);
        if($category_id != ""){
           $data = $this->Common->_get_all_records("tbl_home_category",array("category_id"=>$category_id));
           $this->addhomecategory($data);

        }else{
          echo show_404();
        }

    }


    function doaddhomecategory(){
       $data = array(); 
      if(count($_POST) > 0){
        $this->setRules("ADD_HOME_CATEGORY");
        if($this->form_validation->run()){
          $is_active            = $this->input->post("is_active");  
          $category_id          = $this->input->post("category_id");  
          $category_name        = $this->input->post("category_name");  
          $is_home_category     = $this->input->post("is_home_category");  
          $is_menu_category     = $this->input->post("is_menu_category");  
          $brand_id     = $this->input->post("brand_id");  
          
          $insArray = array(
              "is_active"=>$this->input->post("is_active"),
              "brand_id"=>$brand_id,
              "category_name"=>$category_name,
              "is_home_category"=>$is_home_category,
              "is_menu_category"=>$is_menu_category,
              "modified_at"=>date("Y-m-d H:i:s")
          );  

          if (isset($_FILES['category_image']) && $_FILES['category_image']['name']!=""){
                $insArray["category_image"]  =  upload_image('category_image',IMAGE_PATH_ABSULATE.HOME_CATEGORY_FOLDER);
          }


          if($category_id != ""){  
              $insArray["created_at"]  =  date("Y-m-d H:i:s");
              $this->db->where(array("category_id"=>$category_id));
              $this->db->update("tbl_home_category",$insArray);
              $this->session->set_userdata(GLOBAL_MSG,"Category updated successfully");
              redirect("./admin/edithomecategory/".$category_id);
              
          }else{
              if($this->db->insert("tbl_home_category",$insArray)){
                $this->session->set_userdata(GLOBAL_MSG,"Category added successfully");
              }else{
                $this->session->set_userdata(GLOBAL_MSG,"Something went wrong please try again later");
              }
          }  
         }else{
            $this->session->set_userdata(GLOBAL_MSG,filter_validation_errors());
         }
        
      }
      $this->addhomecategory($data);
    }


    
   






}
