<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//require_once(BASEPATH.'core/MY_Controller.php');
class Subcategory extends MY_Controller {
  function __construct() {
      parent::__construct();
  		$this->load->library('form_validation');    
      $this->load->model('Subcategorymodel');    
		  $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
      $this->Common->is_admin_login();
    }

    
    function setRules($options){
        if($options == "ADD_SUB_Category"){
            $this->form_validation->set_rules('sub_category_name', 'Sub Category Name','trim|required');
        } 
    }

     function subcategorylist(){
        $columns = [0 =>'category_name',1 =>'sub_category_name',2=> 'is_active',3=> 'option'];
        $imageColumns = [];
        $searchableColumns =  [0 =>'sub_category_name'];
        $colDef['category_name'] =  ['target' => 0, 'visible' => true, 'searchable' => true];
        $where = ["tbl_product_sub_category.is_active <>"=>"Deleted"];

        if($this->input->get('ajax')==1){
          $data = $this->ajaxSubCategoryList($this->Subcategorymodel, $columns, $searchableColumns, [], $imageColumns, $where);
          echo $data;exit;
        }else{
          $paginationConfig                  = $this->config->item('pagination');
          $this->data['page_title']          = SITE_TITLE.' :: Sub category list';
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

    function addsubcategory($data = array()){
       $this->data['page_title'] = SITE_TITLE.' :: Manage Sub Category';
       $this->data['page']  = $this->_viewPath . "add.php";
       $this->data['data']  = $data;
       $this->load->view($this->_adminContainer, $this->data);
    }


    function editsubcategory(){
        $sub_category_id = $this->uri->segment(3);
        if($sub_category_id != ""){
           $data = $this->Common->_get_all_records("tbl_product_sub_category",array("sub_category_id"=>$sub_category_id));
           $this->addsubcategory($data);

        }else{
          echo show_404();
        }

    }


    function doaddsubcategory(){
       $data = array(); 
      if(count($_POST) > 0){
        $this->setRules("ADD_SUB_Category");
        $sub_category_id      = $this->input->post('sub_category_id');

         if($this->form_validation->run()){
          
          $sub_category_name      = $this->input->post("sub_category_name");  
          $category_id            = $this->input->post("category_id");  
          $is_active              = $this->input->post("is_active");  
          
          $insArray = array("sub_category_name"=>$sub_category_name,"category_id"=>$category_id,"is_active"=>$is_active,"modified_at"=>date("Y-m-d H:i:s"));


          if($sub_category_id != ""){
            $data = $this->Common->_get_all_records("tbl_product_sub_category",array("sub_category_id"=>$sub_category_id));
          }else{
            $insArray["created_at"]     = date("Y-m-d H:i:s");
          }


          if($sub_category_id != ""){  
              $this->db->where(array("sub_category_id"=>$sub_category_id));
              $this->db->update("tbl_product_sub_category",$insArray);
              $this->session->set_userdata(GLOBAL_MSG,"sub category updated successfully");
              redirect("./admin/editsubcategory/".$sub_category_id);
              
          }else{
              if($this->db->insert("tbl_product_sub_category",$insArray)){
                $this->session->set_userdata(GLOBAL_MSG,"sub category added successfully");
              }else{
                $this->session->set_userdata(GLOBAL_MSG,"something went wrong please try again later");
              }
          }  
         }else{
            $this->session->set_userdata(GLOBAL_MSG,filter_validation_errors());
         }
        
      }
      $this->addsubcategory($data);


    }


    
   



    function udpatecategorystatus(){
            $categoryStatus = $this->uri->segment(3);
            $categoryId = $this->uri->segment(4);
            $where = ["category_id"=>$categoryId];
            $udpateArray = ["modified_at"=>date("Y-m-d H:i:s"),"is_active"=>$categoryStatus];
            if($this->Common-> _update("tbl_product_category", $udpateArray, $where)){
              echo "YES";
            }else{
              echo "NO";
            }
            die;
    }

    function udpateuserstatus(){
      $userStatus = $this->uri->segment(3);
      $userId = $this->uri->segment(4);
      $where = ["user_id"=>$userId];
      $udpateArray = ["modified_at"=>date("Y-m-d H:i:s"),"status"=>$userStatus];
      if($this->Common-> _update("tbl_users", $udpateArray, $where)){
        echo "YES";
      }else{
        echo "NO";
      }
      die;
    }

   // addcategory



}
