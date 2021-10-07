<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//require_once(BASEPATH.'core/MY_Controller.php');
class Banners extends MY_Controller {
  function __construct() {
      parent::__construct();
  		$this->load->library('form_validation');    
      $this->load->model('Bannermodel');    
		  $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
      $this->Common->is_admin_login();
    }

    
    function setRules($options){
        if($options == "ADD_BANNER"){
           // $this->form_validation->set_rules('banner_link', 'Banner Link','trim|required');
            $this->form_validation->set_rules('is_active', 'Status','trim|required');
        } 
    }



      function bannerlistsearch(){
        $columns = [0 =>'banner_image',1 =>'created_at',2=> 'is_active',3=> 'option'];
        $imageColumns = [];
        $searchableColumns =  [0 =>'created_at'];
        $colDef['created_at'] =  ['target' => 0, 'visible' => true, 'searchable' => true];
        $where = ["is_search_category"=>"Y"];

        if($this->input->get('ajax')==1){
          $data = $this->ajaxBannerListSearch($this->Bannermodel, $columns, $searchableColumns, [], $imageColumns, $where);
          echo $data;exit;
        }else{
          $paginationConfig                  = $this->config->item('pagination');
          $this->data['page_title']          = SITE_TITLE.' :: Search Banner list';
          $this->data['page']                = $this->_viewPath . "search-list.php";
          $this->data['useDataTables']       = true;
          $this->data['columns']             = $columns;
          $this->data['colDef']              = $colDef;
          $this->data['default_order_col']   = 0;
          $this->data['default_order_dir']   = $paginationConfig['default_order_dir'];
          $this->data['default_page_length'] = 10;
          $this->load->view($this->_adminContainer, $this->data);
        }
    }


     function bannerlist(){
        $columns = [0 =>'banner_image',1 =>'banner_link',2=>'banner_page_type',3=> 'is_active',4=> 'option'];
        $imageColumns = [];
        $searchableColumns =  [0 =>'banner_link'];
        $colDef['banner_link'] =  ['target' => 0, 'visible' => true, 'searchable' => true];
        $where = ["is_search_category"=>"N"];

        if($this->input->get('ajax')==1){
          $data = $this->ajaxBannerList($this->Bannermodel, $columns, $searchableColumns, [], $imageColumns, $where);
          echo $data;exit;
        }else{
          $paginationConfig                  = $this->config->item('pagination');
          $this->data['page_title']          = SITE_TITLE.' :: Banner list';
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

    function addbanner($data = array()){
       $this->data['page_title'] = SITE_TITLE.' :: Manage Banner';
       $this->data['page']  = $this->_viewPath . "add.php";
       $this->data['data']  = $data;
       $this->load->view($this->_adminContainer, $this->data);
    }


    function editbanner(){
        $banner_id = $this->uri->segment(3);
        if($banner_id != ""){
           $data = $this->Common->_get_all_records("tbl_banner",array("banner_id"=>$banner_id));
           $this->addbanner($data);

        }else{
          echo show_404();
        }

    }


    function doaddbanner(){
       $data = array(); 
      if(count($_POST) > 0){
        $this->setRules("ADD_BANNER");
        if($this->form_validation->run()){
          $banner_link      = $this->input->post("banner_link");  
          $is_active        = $this->input->post("is_active");  
          $banner_id        = $this->input->post("banner_id");  
          
          
          $insArray = array(
             "banner_page_type"=>$this->input->post("banner_page_type"),
              "banner_link"=>$this->input->post("banner_link"),
              "is_active"=>$this->input->post("is_active"),
              "modified_at"=>date("Y-m-d H:i:s")
          );  


          if (isset($_FILES['banner_image']) && $_FILES['banner_image']['name']!=""){
                $insArray["banner_image"]  =  upload_image('banner_image',IMAGE_PATH_ABSULATE.BANNER_FOLDER);
          }


          if($banner_id != ""){  
              $insArray["created_at"]  =  date("Y-m-d H:i:s");
              $this->db->where(array("banner_id"=>$banner_id));
              $this->db->update("tbl_banner",$insArray);
              $this->session->set_userdata(GLOBAL_MSG,"banner updated successfully");
              redirect("./admin/editbanner/".$banner_id);
              
          }else{
              if($this->db->insert("tbl_banner",$insArray)){
                $this->session->set_userdata(GLOBAL_MSG,"banner added successfully");
              }else{
                $this->session->set_userdata(GLOBAL_MSG,"something went wrong please try again later");
              }
          }  
         }else{
            $this->session->set_userdata(GLOBAL_MSG,filter_validation_errors());
         }
        
      }
      $this->addbanner($data);
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
