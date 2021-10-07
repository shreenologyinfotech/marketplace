<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//require_once(BASEPATH.'core/MY_Controller.php');
class Login extends MY_Controller {
		
		
    function __construct() {
        parent::__construct();
  		$this->load->library('form_validation');    
        $this->load->Model('EmailTemplate');    
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->Common->redirect_advertiser();
    }


    function index() {
        if(count($_POST) > 0){
                $this->setRules("USER_LOGIN");
                if($this->form_validation->run()){
                   $email       = $this->input->post("email");
                   $password    = $this->input->post("password");
                   $where = array("email"=>$email,"password"=>md5($password),"status <> "=>"Deleted");

                   if($this->Common->_is_record_exits("tbl_advertiser",$where)){
                        $userData = $this->Common->_get_all_records("tbl_advertiser",$where);
                        if($userData[0]->is_email_verified == "No"){
                            $this->EmailTemplate->sendVerificationEmailAdvertiser($userData[0]->id,$userData[0]->email,$userData[0]->fname);    
                            $this->session->set_userdata(GLOBAL_MSG_FRONT,LOGIN_VERIFICATION_EMAIL_SEND);
                            $this->loadloginview($_POST);  

                        }else if($userData[0]->status == "Pending"){
                            
                            $this->session->set_userdata(GLOBAL_MSG_FRONT,ACCOUNT_NOT_APPROVED_PLEASE_WAIT);
                            $this->loadloginview($_POST);  
                        
                        }else if($userData[0]->status == "Inactive"){
                            
                            $this->session->set_userdata(GLOBAL_MSG_FRONT,ACCOUNT_BLOCK_BY_ADMIN);
                            $this->loadloginview($_POST);  
                       
                        }else{
                            
                            $this->session->set_userdata(CASHVERTISE_ADVERTISER_ID,$userData[0]->id);
                            $this->session->set_userdata(GLOBAL_MSG_FRONT,LOGIN_SUCCESS);
                            redirect("/welcome");
                        
                        }    
                   }else{
                        $this->session->set_userdata(GLOBAL_MSG_FRONT,NOT_VALID_CREDENTIALS);
                       $this->loadloginview($_POST);  
                       
                   }
                }else{
                    $this->session->set_userdata(GLOBAL_MSG_FRONT,filter_validation_errors());
                   $this->loadloginview($_POST);  
                }

        }else{
          $this->loadloginview($_POST);  
        }
    }



    function loadloginview($post){
        $this->data['page_title'] = SITE_TITLE.' :: Login';
        $this->data['page'] = $this->_viewPath . "login.php";
        $this->data['post'] = $post;
        $this->load->view($this->_frontContainer, $this->data);
    }


   


    function setRules($options){
        if($options == "USER_LOGIN"){
            $this->form_validation->set_rules('email', 'email','trim|required');
            $this->form_validation->set_rules('password', 'password','trim|required');
        }
    }
    

    function loginuser(){
        $this->setRules("USER_LOGIN");
        if($this->form_validation->run()){
           $email       = $this->input->post("email");
           $password    = $this->input->post("password");
           $where = array("email"=>$email,"password"=>md5($password),"status <> "=>"Deleted");

           if($this->Common->_is_record_exits("tbl_advertiser",$where)){
                $userData = $this->Common->_get_all_records("tbl_advertiser",$where);
                if($userData[0]->is_email_verified == "No"){
                    $this->EmailTemplate->sendVerificationEmailAdvertiser($userData[0]->id,$userData[0]->email,$userData[0]->fname);    
                    $this->session->set_userdata(GLOBAL_MSG_FRONT,LOGIN_VERIFICATION_EMAIL_SEND);
                    redirect("/login");

                }else if($userData[0]->status == "Pending"){
                    
                    $this->session->set_userdata(GLOBAL_MSG_FRONT,ACCOUNT_NOT_APPROVED_PLEASE_WAIT);
                    redirect("/login");
                
                }else if($userData[0]->status == "Inactive"){
                    
                    $this->session->set_userdata(GLOBAL_MSG_FRONT,ACCOUNT_BLOCK_BY_ADMIN);
                    redirect("/login");
               
                }else{
                    
                    $this->session->set_userdata(CASHVERTISE_ADVERTISER_ID,$userData[0]->id);
                    $this->session->set_userdata(GLOBAL_MSG_FRONT,LOGIN_SUCCESS);
                    redirect("/welcome");
                
                }    
           }else{
                $this->session->set_userdata(GLOBAL_MSG_FRONT,NOT_VALID_CREDENTIALS);
                $this->loadloginview($_POST);
              //  redirect("/login",$_POST);
               
           }
        }else{
            $this->session->set_userdata(GLOBAL_MSG_FRONT,filter_validation_errors());
            redirect("/login");
        }
    } 
	
	 	
}
