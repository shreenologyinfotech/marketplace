<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//require_once(BASEPATH.'core/MY_Controller.php');
class Signup extends MY_Controller {
		
		
    function __construct() {
      parent::__construct();
  		$this->load->library('form_validation');    
      $this->load->Model('EmailTemplate');    
	   	$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
    }

    function test(){
      // $this->load->view("email-template/email-verification-appuser");
    }

    function index() {
      if(count($_POST) > 0){
          $this->setRules("SIGN_UP");
      if($this->form_validation->run()){
          $fName          = $this->input->post('fname');
          $lName          = $this->input->post('lname');
          $email          = $this->input->post('email');
          $password       = $this->input->post('password');
          $companyName    = $this->input->post('companyName');
          $contact        = $this->input->post('contact');

          $where          = array("email"=>$email,"status <> "=>'Deleted');
          $whereContact   = array("contact_number"=>$contact,"status <> "=>'Deleted');

          if($this->Common->_is_record_exits("tbl_advertiser",$where)){
              $this->session->set_userdata(GLOBAL_MSG_FRONT,ADVERTISER_EMAIL_ALREADY_REGISTERED);
          }else if($this->Common->_is_record_exits("tbl_advertiser",$whereContact)){
              $this->session->set_userdata(GLOBAL_MSG_FRONT,ADVERTISER_PHONE_ALREADY_REGISTERED);
          }else{
                $insArray =  array(
                  "fname" =>$fName,
                  "lname" =>$lName,
                  "email" =>$email,
                  "contact_number" =>$contact,
                  "company_name" =>$companyName,
                  "password" =>md5($password),
                  "enk_key" =>base64_encode($password),
                  "modified"=>date("Y-m-d"),
                );
                
               $insArray["status"]                 =  "Approved";
               $insArray["is_email_verified"]      =  "No";
               $insArray["is_mobile_verified"]     =  "No";  
               $insArray["created"]                = date("Y-m-d");
               $insArray["created_by"]             = "0"; 
               if($this->Common->_insert("tbl_advertiser",$insArray)){
                  $userId = $this->db->insert_id();
                  $this->EmailTemplate->sendVerificationEmailAdvertiser($userId,$email,$fName);
                  $this->session->set_userdata(GLOBAL_MSG_FRONT,ADVERTISER_SIGN_UP_SUCCESS);
                  redirect("./login");
               }else{
                  $this->session->set_userdata(GLOBAL_MSG_FRONT,SOMETHING_WENT_WRONG_PLEASE_TRY_LATER);
               }
          }
      }else{
          $this->session->set_userdata(GLOBAL_MSG_FRONT,filter_validation_errors());
      }
    }
      $this->loadsignupview($_POST);
    }


    function loadsignupview($post){
      $this->data['page_title'] = SITE_TITLE.' :: signup';
      $this->data['post'] = $post;
      $this->data['page'] = $this->_viewPath . "signup.php";
      $this->load->view($this->_frontContainer, $this->data);
    }



    function advertisewithus(){
      $this->data['page_title'] = SITE_TITLE.' :: advertise with us';
      $this->data['page'] = $this->_viewPath . "advertisewithus.php";
      $this->data['is_home_page'] = true;
      $this->load->view($this->_frontContainer, $this->data);
    }

    function setRules($options){
        if($options == "SIGN_UP"){
            $this->form_validation->set_rules('email', 'email','trim|required');
            $this->form_validation->set_rules('fname', 'first name','trim|required');
            $this->form_validation->set_rules('lname', 'last name','trim|required');
            $this->form_validation->set_rules('contact', 'contact','trim|required');
            $this->form_validation->set_rules('companyName', 'company name','trim|required');
            $this->form_validation->set_rules('password', 'password','trim|required');
        }
    }

    
    function doadveritsersignup(){
      
    }
}
