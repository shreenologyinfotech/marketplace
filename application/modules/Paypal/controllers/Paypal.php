<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//require_once(BASEPATH.'core/MY_Controller.php');
class Paypal extends MY_Controller {
	  function __construct() {
        parent::__construct();
    		$this->load->library('form_validation');    
        $this->load->Model('EmailTemplate');    
  		  $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        log_message('debug', 'CI My Admin : Auth class loaded');
    }

    function index() {
     	$this->data['page_title'] = SITE_TITLE.' :: Home';
      $this->data['page'] = $this->_viewPath . "home.php";
      $this->load->view($this->_frontContainer, $this->data);
    }

  
    function ipn(){
      $insArray = array("log"=>print_r($_POST,true)); 
      $this->db->insert("tbl_paypal_log",$insArray);  
      $payment_status = strtolower($_POST["payment_status"]);
      $order_id = strtolower($_POST["item_number"]);
      $ipn_track_id = $_POST["ipn_track_id"];

      if ($payment_status=="completed" ||  $payment_status=="pending") {
          $where    = array('ipn_track_id' => $ipn_track_id);
          if(!$this->Common->isRecordExits("tbl_ipn_track",$where)){
              if($this->db->insert("tbl_ipn_track",$where)){
                $data       = array("payment_status"=>"success","payment_mode"=>"PAYPAL");
                $condition  = array("order_id"=>$order_id);
                $orderData = $this->Common->getRecordById('tbl_order',$condition);  
                $insArray =  array("order_id"=>$order_id,"date"=>date("Y-m-d H:i:s"),"amount"=>$orderData[0]->total_amount,"  user_id"=>$orderData[0]->user_id,"paypal_transaction_id"=>$_POST['txn_id']); 
                $this->db->insert("tbl_transactions",$insArray);               
                $this->Common->_update("tbl_order", $data, $condition);
                
                /*
                $invoiceArray = array(
                  "invoice_number"=>$_POST['txn_id'],
                  "order_id"=>$orderData[0]->id,
                  "unit_price"=>$orderData[0]->advertise_per_view_cost,
                  "quantity"=>"1",
                  "discount"=>"0.00",
                  "total"=>$orderData[0]->total_cost,
                  "status"=>"Active",
                  "created"=>date("Y-m-d H:i:s"),
                  "modified"=>date("Y-m-d H:i:s"),
                  "user_id"=>$orderData[0]->user_id
                );  
                $this->db->insert("tbl_invoice",$invoiceArray);
                */
                // send email 
              }
          } 
      }
    }


    function success(){
      clearUserCart();
      /*
      $advertiserDetalis = $this->Common->getRecordById('tbl_advertiser',array("id"=>$this->Common->get_advertiser_id()));
      if(sizeof($advertiserDetalis)>0){
        $userName = $advertiserDetalis[0]->fname;
        $userEmail = $advertiserDetalis[0]->email;
        $this->EmailTemplate->sendPaymentSuccesMail($userName,$userEmail);
      }
      */


      $this->data['page_title'] = SITE_TITLE.' :: Payment success';
      $this->data['page'] = $this->_viewPath . "success.php";
      $this->load->view($this->_frontContainer, $this->data);
    }

    function cancel(){
      $this->data['page_title'] = SITE_TITLE.' :: Payment cancel';
      $this->data['page'] = $this->_viewPath . "cancel.php";
      $this->load->view($this->_frontContainer, $this->data);
    }


}
