<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//require_once(BASEPATH.'core/MY_Controller.php');
class Admindashboard extends MY_Controller {
  function __construct() {
      parent::__construct();
  		$this->load->library('form_validation');    
      $this->load->model('Promo');    
		  $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
      $this->Common->is_admin_login();
    }

    function index() {
        $endLimit = get_meta_value("dashboard_data_listing_limit");
      	$this->data['page_title']       = SITE_TITLE.' :: Admin Dashboard';
        $this->data['page']             = $this->_viewPath . "admin-dashboard.php";
        $this->data["total_store"]      = $this->Common->total_count("tbl_stores", "store_id", ["user_type"=>"S","status"=>"A"]);
        $this->data["total_products"]   = $this->Common->total_count("tbl_products", "product_id", ["is_active"=>"Active"]);


        $this->load->view($this->_adminContainer, $this->data);
    }
    
    function setRules($options){
        if($options == "ADD_ADMIN"){
            $this->form_validation->set_rules('admin_name', 'Admin Name','trim|required');
            $this->form_validation->set_rules('admin_email', 'Admin Email','trim|required');
            if($this->input->post("id") == ""){
              $this->form_validation->set_rules('admin_password', 'Admin Password','trim|required');
            }
        }else if($options == "ADD_PROMO"){
            $this->form_validation->set_rules('promo_text', 'Promo Text','trim|required');
            //$this->form_validation->set_rules('promo_link', 'Promo Link','trim|required');
            $this->form_validation->set_rules('status', 'Status','trim|required');
        } 
    }


    function addPromoView($data = array()){
       $this->data['page_title'] = SITE_TITLE.' :: Add Promo';
       $this->data['page']  = $this->_viewPath . "addpromotions.php";
       $this->data['data']  = $data;
       $this->load->view($this->_adminContainer, $this->data);
    }

    function editpromo(){
        $promoId = $this->uri->segment(3);
        if($promoId != ""){
           $data = $this->Common->_get_all_records("tbl_promo",array("promo_id"=>$promoId));
           $this->addPromoView($data);

        }else{
          echo show_404();
        }
    }



    


    
    function addpromo(){
       $data = array(); 
      if(count($_POST) > 0){

        $this->setRules("ADD_PROMO");


        $promo_id      = $this->input->post('promo_id');

         if($this->form_validation->run()){
          $promo_text      = $this->input->post("promo_text");  
          $promo_link     = $this->input->post("promo_link");  
          $status  = $this->input->post("status");  
          
          $insArray = array("promo_text"=>$promo_text,"promo_link"=>$promo_link,"modified_at"=>date("Y-m-d H:i:s"),"status"=>$status);


          if($promo_id != ""){
            $data = $this->Common->_get_all_records("tbl_promo",array("promo_id"=>$promo_id));
          }else{
            $insArray["created_at"]     = date("Y-m-d H:i:s");
          }
          
          if($promo_id != ""){  
              $this->db->where(array("promo_id"=>$promo_id));
              $this->db->update("tbl_promo",$insArray);
              $this->session->set_userdata(GLOBAL_MSG,"promo updated successfully");
              redirect("./admin/editpromo/".$promo_id);
              
          }else{
              if($this->db->insert("tbl_promo",$insArray)){
                $this->session->set_userdata(GLOBAL_MSG,"promo added successfully");
              }else{
                $this->session->set_userdata(GLOBAL_MSG,"something went wrong please try again later");
              }
          }  
         }else{
    
       

            $this->session->set_userdata(GLOBAL_MSG,filter_validation_errors());
         }
        // roles,admin_password,admin_email,admin_name
      }
      $this->addPromoView($data); 


    }


    /**/
    function managepromo(){

      $columns = [0 =>'created_at',1 =>'promo_text',2=> 'promo_link',3=> 'status', 4=> 'option'];
      $imageColumns = [];
      $searchableColumns =  [0 =>'created_at',1 =>'promo_text',2=> 'promo_link',3=> 'status', 4=> 'option'];
      
      $colDef['promo_text'] =  ['target' => 0, 'visible' => true, 'searchable' => true];
      $where = array();


      if($this->input->get('ajax')==1){
        $data = $this->ajaxPromoList($this->Promo, $columns, $searchableColumns, [], $imageColumns, $where);
        echo $data;exit;
      
      }else{
        $paginationConfig = $this->config->item('pagination');
        $this->data['page_title'] = SITE_TITLE.' :: Admin list';
        $this->data['page'] = $this->_viewPath . "promotions.php";
        $this->data['useDataTables'] = true;
        $this->data['columns'] = $columns;
        $this->data['colDef'] = $colDef;
        $this->data['default_order_col'] = 0;
        $this->data['default_order_dir'] = $paginationConfig['default_order_dir'];
        $this->data['default_page_length'] = 10;//$paginationConfig['default_page_length'];
        $this->load->view($this->_adminContainer, $this->data);
      }


    }



    function activeadmin(){

      $adminId = $this->uri->segment(3);
      $this->db->where(array("admin_id"=>$adminId));
      $updateArray = array("status"=>"active");
      $this->db->update("tbl_admin",$updateArray);
      if($this->db->affected_rows() > 0){
          echo "YES";
      }else{
          echo "NO";
      }

    }

    function blockadmin(){
      $adminId = $this->uri->segment(3);
      $this->db->where(array("admin_id"=>$adminId));
      $updateArray = array("status"=>"inactive");
      $this->db->update("tbl_admin",$updateArray);
      if($this->db->affected_rows() > 0){
          echo "YES";
      }else{
          echo "NO";
      }
    }

   

    function logout(){
      $this->session->sess_destroy();
      redirect("./adminlogin");
    }

    function loadAddAdminView(){
      $data = array(); 
      if(count($_POST) > 0){
        $this->setRules("ADD_ADMIN");
        $id      = $this->input->post('id');

         if($this->form_validation->run()){
          $adminName      = $this->input->post("admin_name");  
          $adminEmail     = $this->input->post("admin_email");  
          $adminPassword  = $this->input->post("admin_password");  
          
          $insArray = array("admin_name"=>$adminName,"admin_email"=>$adminEmail,"modified_at"=>date("Y-m-d H:i:s"),"roles"=>json_encode($this->input->post("roles"),true));


          if($id != ""){
            $data = $this->Common->_get_all_records("tbl_admin",array("admin_id"=>$id));
          }else{
            $insArray["admin_password"] = md5($adminPassword);
            $insArray["enk_key"]        =  base64_encode($adminPassword);
            $insArray["created_at"]     = date("Y-m-d H:i:s");
          }

          if($id != ""){  
              $this->db->where(array("admin_id"=>$id));
              $this->db->update("tbl_admin",$insArray);
              $this->session->set_userdata(GLOBAL_MSG,"admin updated successfully");
              redirect("./admin/editadmin/".$id);
              
          }else{
              if($this->db->insert("tbl_admin",$insArray)){
                $this->session->set_userdata(GLOBAL_MSG,"admin added successfully");
              }else{
                $this->session->set_userdata(GLOBAL_MSG,"something went wrong please try again later");
              }
          }  
         }else{
            $this->session->set_userdata(GLOBAL_MSG,filter_validation_errors());
         }
        // roles,admin_password,admin_email,admin_name
      }
      $this->addadmin($data);
    }

    function addadmin($data = array()){
       $this->data['page_title'] = SITE_TITLE.' :: Add admin';
       $this->data['page']  = $this->_viewPath . "add.php";
       $this->data['data']  = $data;
       $this->data['roles'] = $this->Common->_get_all_records("tbl_admin_roles",array());
       $this->load->view($this->_adminContainer, $this->data);
    }

    function editadmin(){
        $adminId = $this->uri->segment(3);
        if($adminId != ""){
           $data = $this->Common->_get_all_records("tbl_admin",array("admin_id"=>$adminId));
           $this->addadmin($data);

        }else{
          echo show_404();
        }
    }


    function manageadmin(){
        $columns = [0 =>'admin_name',1 =>'admin_email',2=> 'roles',3=> 'status', 4=> 'option'];
        $imageColumns = [];
        $searchableColumns =  [0 =>'admin_name',1 =>'admin_email',2=> 'roles',3=> 'status'];
        
        $colDef['admin_name'] =  ['target' => 0, 'visible' => true, 'searchable' => true];
        $where = array();

        if($this->input->get('ajax')==1){
          $data = $this->ajaxAdminList($this->Admin, $columns, $searchableColumns, [], $imageColumns, $where);
          echo $data;exit;
        
        }else{
          $paginationConfig = $this->config->item('pagination');
          $this->data['page_title'] = SITE_TITLE.' :: Admin list';
          $this->data['page'] = $this->_viewPath . "admins.php";
          $this->data['useDataTables'] = true;
          $this->data['columns'] = $columns;
          $this->data['colDef'] = $colDef;
          $this->data['default_order_col'] = 0;
          $this->data['default_order_dir'] = $paginationConfig['default_order_dir'];
          $this->data['default_page_length'] = 10;//$paginationConfig['default_page_length'];
          $this->load->view($this->_adminContainer, $this->data);
        }

    }


}
