<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends MY_Controller {

    function __construct() {
        parent::__construct();
  		  $this->load->library('form_validation');    
	     	$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        log_message('debug', 'CI My Admin : Auth class loaded');
        if(is_store_login()){ 
          if(login_user_type() == "S"){
            echo show_404();
          }
        }else{
          show_404();
        }
    }


    function setRules($options){
       
    } 
   
    function editprofile(){
      $this->data['page_title'] = SITE_TITLE.' :: Profile';
      $this->data['page'] = $this->_viewPath . "profile.php";
      $this->load->view($this->_frontContainer, $this->data);
    }

    function changepassword(){
      $this->data['page_title'] = SITE_TITLE.' :: Change Passoword';

      $this->data['page'] = $this->_viewPath . "change-password.php";
      $this->load->view($this->_frontContainer, $this->data);
    }
    

    function address(){
      $this->data['page_title']   = SITE_TITLE.' :: My-Address';
      $this->data['page']         = $this->_viewPath . "shipping-address.php";
      $userId                     = $this->session->userdata(FRONT_USER_ID);
      $this->data['my_address']   = $this->Common->_get_all_records("tbl_address",["user_id"=>$userId]);
      $this->load->view($this->_frontContainer, $this->data);
    }
     

    function orders(){
      $this->data['page_title'] = SITE_TITLE.' :: My Orders';
      $this->data['page'] = $this->_viewPath . "my-orders.php";
      $userId                     = $this->session->userdata(FRONT_USER_ID);
      $this->data['data_product']  = $this->Common->_get_all_records("tbl_order",["user_id"=>$userId],"order_id");
      $this->load->view($this->_frontContainer, $this->data);
    }

    function orderdetail(){
      $order_id = $this->uri->segment(3);
     
      if($order_id != ""){
        $this->data['page_title'] = SITE_TITLE.' :: Order Detail';
        $this->data['page'] = $this->_viewPath . "order-details.php";
        $userId                     = $this->session->userdata(FRONT_USER_ID);

        $this->data['data_product']  = $this->Common->_get_all_records("tbl_order",["user_id"=>$userId,"order_id"=>$order_id]);
        $this->load->view($this->_frontContainer, $this->data);
      }
      
      //order-details


    }




	 	
}