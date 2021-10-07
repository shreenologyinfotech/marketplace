<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//require_once(BASEPATH.'core/MY_Controller.php');
class Adminchangepassword extends MY_Controller {
  
  function __construct() {
        parent::__construct();
        $this->load->model('Admin');
       	$this->load->library('form_validation');    
  		  $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->Common->is_admin_login();
    }

    function setRules($options){
        if($options == "CHANGE_PASSWORD"){
            $this->form_validation->set_rules('old_password', 'Old Password','trim|required');
            $this->form_validation->set_rules('new_password', 'New Password','trim|required');
        }
    }
    

    function index() {
        if(count($_POST) > 0){
            $this->setRules("CHANGE_PASSWORD");
            if($this->form_validation->run()){
                $oldPassword  = $this->input->post("old_password");
                $newPassword   = $this->input->post("new_password");
                $where        = array("admin_id"=>$this->Common->get_admin_id(),"admin_password"=>md5($oldPassword));
                if($this->Common->_is_record_exits("tbl_admin",$where)){

                    $updateArray  = array("admin_password"=>md5($newPassword),"enk_key"=>base64_encode($newPassword));
                    
                    $this->db->where($where);
                    $this->db->update("tbl_admin",$updateArray);
                    
                    if($this->db->affected_rows() > 0){
                       $this->session->set_userdata(GLOBAL_MSG,"Password changed successfully"); 
                    }else{
                       $this->session->set_userdata(GLOBAL_MSG,"Something went wrong please try again later");
                    }
                }else{
                  $this->session->set_userdata(GLOBAL_MSG,"Invalid old password");
                }
            }else{
               $this->session->set_userdata(GLOBAL_MSG,filter_validation_errors()); 
            }
        }
        $this->loadAddView();
    }

    function loadAddView(){
          $this->data['page_title'] = SITE_TITLE.' :: Admin Profile';
          $this->data['page'] = $this->_viewPath."change-password.php";
          $this->data['data'] = $this->Common->get_all_record("tbl_admin",array("admin_id"=>$this->Common->get_admin_id()));
          $this->load->view($this->_adminContainer, $this->data);
    }

}



