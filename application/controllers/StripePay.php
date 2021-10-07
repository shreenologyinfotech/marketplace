<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH.'libraries/stripe-php/init.php');
class StripePay extends MY_Controller {
    function __construct() {
        parent::__construct();
    }

    public function index(){

       

        if(save_user_order('Stipe')){
          $orderId       = $this->db->insert_id();
          $total       = $this->input->post('total');


          $where         =  array("user_id"=>get_store_id(),"payment_status"=>"pending","order_id"=>$orderId);
          $orderData     =  $this->Common->_get_all_records("tbl_order",$where,"");
          $orderData["orderData"] = $orderData;  
          $orderData["total"] = $total;  
          $this->load->view("stripe-pay",$orderData);


        }else{
            echo show_404();
        }
    }

    public function payment(){
        $amount     = $this->input->post("amount");    
        $user_id    = $this->input->post("user_id");  
        $order_id    = $this->input->post("order_id");  

        \Stripe\Stripe::setApiKey($this->config->item('stripe_secret'));
        \Stripe\Charge::create ([
                "amount" => 100 * $amount,
                "currency" => site_currency(),
                "source" => $this->input->post('stripeToken'),
                "description" => "Test payment from itsolutionstuff.com." 
        ]);




        clearUserCart();

        $data       = array("payment_status"=>"success","payment_mode"=>"STRIPE");
        
        $condition  = array("order_id"=>$order_id);
        $orderData = $this->Common->getRecordById('tbl_order',$condition);  
        $insArray =  array("order_id"=>$order_id,"date"=>date("Y-m-d H:i:s"),"amount"=>$amount,"  user_id"=>$user_id,"paypal_transaction_id"=>rand(1111111,999999999)); 
        $this->db->insert("tbl_transactions",$insArray);               
        $this->Common->_update("tbl_order", $data, $condition);


        redirect('/paypal/success', 'refresh');
    }

 
}
