<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//require_once(BASEPATH.'core/MY_Controller.php');
class Adminlogin extends MY_Controller {
  function __construct() {
    parent::__construct();
  	$this->load->library('form_validation');    
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    }


    function index() {
        $this->Common->redirect_to_admin_dashboard();
    	$this->data['page_title'] = SITE_TITLE.' :: Admin Login';
        $this->data['page'] = $this->_viewPath . "admin-login.php";
        $this->data['login'] = true;
        $this->load->view($this->_adminContainer, $this->data);
    }


    function setRules($options){
        if($options == "ADMIN_LOGIN"){
            $this->form_validation->set_rules('email', 'email','trim|required');
            $this->form_validation->set_rules('password', 'password','trim|required');
        
        }else if($options == "ADMIN_FORGOT"){
            $this->form_validation->set_rules('email', 'email','trim|required');
        }
    }


    function logout(){
        $this->sessoin->destroy();
    }


    function forgot(){
        $this->setRules("ADMIN_FORGOT");
        if($this->form_validation->run()){
          $email       = $this->input->post("email");
          $where       = array("email" =>$email);
          if($this->Common->_is_record_exits("tbl_admin",$where)){

                $data = $this->Common->getRecordById("tbl_admin",$where);
                $password = base64_decode($data[0]->enk_key);
                
                if($this->EmailTemplate->sendForgotPasswordEmail($data[0]->admin_name,$data[0]->admin_email,$password)){
                    $this->session->set_userdata(GLOBAL_MSG,"Your login credentials has been send to your email");
                }else{
                    $this->session->set_userdata(GLOBAL_MSG,"Something went wrong please try again later");
                }
          }else{
              $this->session->set_userdata(GLOBAL_MSG,"Not a valid email");
            
          }
        }else{
            $this->session->set_userdata(GLOBAL_MSG,filter_validation_errors());
           
        }
        redirect("/admin/login"); 
    }
    
    
    function dologin(){
        $this->setRules("ADMIN_LOGIN");
        if($this->form_validation->run()){
           $email       = $this->input->post("email");
           $password    = $this->input->post("password");
           $where = array("admin_email"=>$email,"admin_password"=>md5($password));
           
           if($this->Common->_is_record_exits("tbl_admin",$where)){
                $adminData = $this->Common->_get_all_records("tbl_admin",$where);    
                if($adminData[0]->status == "inactive"){
                    $this->session->set_userdata(GLOBAL_MSG,"Your account is block by super admin please contact site administrator");
                    redirect("/admin/login");
                }else{
                  $this->session->set_userdata(CASHVERTISE_ADMIN_ID,$adminData[0]->admin_id);
                  $this->session->set_userdata(GLOBAL_MSG,LOGIN_SUCCESS);
                  redirect("/admin/dashboard");  
                }
           }else{
                $this->session->set_userdata(GLOBAL_MSG,"Please enter a valid credentials");
                redirect("/admin/login");
           }
        }else{
            $this->session->set_userdata(GLOBAL_MSG,filter_validation_errors());
            redirect("/admin/login");
        }
    }

}
