<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//require_once(BASEPATH.'core/MY_Controller.php');
class Adminprofile extends MY_Controller {
  
  function __construct() {
        parent::__construct();
        $this->load->model('Admin');
       	$this->load->library('form_validation');    
  		  $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->Common->is_admin_login();
    }

    function setRules($options){
        if($options == "UPDATE_PROFILE"){
            $this->form_validation->set_rules('name', 'Admin Name','trim|required');
            $this->form_validation->set_rules('email', 'Admin Email','trim|required');
        }
    }
    

    function index() {
        if(count($_POST) > 0){
            $this->setRules("UPDATE_PROFILE");
            if($this->form_validation->run()){
                $adminName    = $this->input->post("name");
                $adminEmail   = $this->input->post("email");
                $where        = array("admin_id"=>$this->Common->get_admin_id());
                $updateArray  = array("admin_email"=>$adminEmail,"admin_name"=>$adminName);
                $this->db->where($where);
                $this->db->update("tbl_admin",$updateArray);
                
                if($this->db->affected_rows() > 0){
                   $this->session->set_userdata(GLOBAL_MSG,"Admin details update successfully"); 
                }else{
                   $this->session->set_userdata(GLOBAL_MSG,"Something went wrong please try again later");
                }
            }else{
               $this->session->set_userdata(GLOBAL_MSG,filter_validation_errors()); 
            }
        }
        $this->loadAddView();
    }

    function loadAddView(){
          $this->data['page_title'] = SITE_TITLE.' :: Admin Profile';
          $this->data['page'] = $this->_viewPath."profile.php";
          $this->data['data'] = $this->Common->get_all_record("tbl_admin",array("admin_id"=>$this->Common->get_admin_id()));
          $this->load->view($this->_adminContainer, $this->data);
    }

}



