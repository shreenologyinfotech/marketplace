<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//require_once(BASEPATH.'core/MY_Controller.php');
class Orders extends MY_Controller {
  function __construct() {
        parent::__construct();
        $this->load->model('Order');
        $this->load->model('Store');
        $this->load->model('OrderViewHistory');
        $this->load->model('Transactions');
       	$this->load->library('form_validation');    
  		  $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->Common->is_admin_login();
    }
    


    function transactions(){
        

        $columns = [0 =>'order_id',1=> 'date', 2=> 'amount', 3 =>'refund_amount', 4=>'option'];
        $imageColumns = [];
        $searchableColumns = [0 =>'date'];
        $colDef['order_id'] =  ['target' => 0, 'visible' => true, 'searchable' => true];
        if($this->input->get('ajax')==1){
          $options = '<a href="'.site_url('admin/invoice/view/[order_id]').'" title="View" class="btn-xs btn btn-success">Invoice</a>';
          //get paginated records for jquery datatables
          $where = array();
          $data = $this->ajaxTranactionList($this->Transactions, $columns, $searchableColumns, $options, $imageColumns, $where);
          echo $data;exit;
        }
        else{
          $paginationConfig = $this->config->item('pagination');
          $this->data['page_title'] = SITE_TITLE.' :: Transaction history';
          $this->data['page'] = $this->_viewPath . "transactions.php";
          $this->data['useDataTables'] = true;
          $this->data['columns'] = $columns;
          $this->data['colDef'] = $colDef;
          $this->data['default_order_col'] = 1;
          $this->data['default_order_dir'] = $paginationConfig['default_order_dir'];
          $this->data['default_page_length'] = 10;//$paginationConfig['default_page_length'];
          $this->load->view($this->_adminContainer, $this->data);
        }



    }


    function ordersubmit(){
      //$filter =  $this->input->post("order-filter");
       $storefilter =  $this->input->post("store-order-filter");
      if( $storefilter != ''){
        redirect("./admin/orders/".$storefilter);
      }else{
        redirect("./admin/orders");
      }

    }



    function index() {
       // $this->db->update("tbl_orders",array("seen_status"=>"true"));
        $columns = [
          0 =>'order_id',
          1=> 'user_id',
          2=> 'store_id',
          5=>'payment_mode',
          6=>'cod_charges',
          7=>'shipping_charges',
          8=>'payment_status',
          9=>'total_amount',
          10=>'status',
          11=>'option'
        ];


        $imageColumns = [];
        $searchableColumns = [0 =>'order_id',
        1=> 'user_id',
        2=> 'store_id',        
        5=>'payment_mode',
        6=>'cod_charges',
        7=>'shipping_charges',
        8=>'payment_status',
        9=>'total_amount',
        10=>'status'];

        
        $colDef['store_id'] =  ['target' => 0, 'visible' => true, 'searchable' => true];
       
        
        if($this->input->get('ajax')==1){
          //$options = '<a href="'.site_url('admin/order/edit/[id]').'" title="Edit" class="btn-xs btn btn-primary">Edit</a>';
          $options = '<a href="'.site_url('admin/order/view/[id]').'" title="View" class="btn-xs btn btn-success">View</a>';
          $options .= '<a href="'.site_url('admin/order/viewhistory/[id]').'" title="Advert view history" class="btn-xs btn btn-primary">View History</a>';
          //get paginated records for jquery datatables
          
          $where = array("tbl_order.status <> "=> "Deleted");
          $status ='';// $this->uri->segment(3);
          $storefilter = $this->uri->segment(3);
         

          if($status != ""){
            $status = str_replace("+", " ", $status);
            $where = array("tbl_order.status"=>  $status , "tbl_order.status <> "=> "Deleted");
          }
          if($storefilter != ''){
            $where = array("tbl_order.store_id"=> str_replace("%20", " ", $storefilter));
          }

          $data = $this->ajaxOrderList($this->Order, $columns, $searchableColumns, $options, $imageColumns, $where);
          echo $data;exit;
        }
        else{
          $paginationConfig = $this->config->item('pagination');
          $this->data['page_title'] = SITE_TITLE.' :: Order list';
          $this->data['page'] = $this->_viewPath . "orders.php";
          $this->data['useDataTables'] = true;
          $this->data['columns'] = $columns;
          $this->data['colDef'] = $colDef;
          $this->data['default_order_col'] = 0;
          $this->data['default_order_dir'] = $paginationConfig['default_order_dir'];
          $this->data['default_page_length'] = 10;//$paginationConfig['default_page_length'];

          $this->data['segment'] =  str_replace("+", " ", $this->uri->segment(3));
          $this->data['segment'] =  str_replace("%20", " ", $this->data['segment']);
          $this->data['storesegment'] =  str_replace("+", " ", $this->uri->segment(3));
          $this->data['storesegment'] =  str_replace("%20", " ", $this->data['storesegment']);
          
          $this->load->view($this->_adminContainer, $this->data);
        }
    }



  function viewhistory(){
        $orderId = $this->uri->segment("4");
        $columns = [0 =>'username',1=> 'email', 2=> 'contact_number', 3 =>'company_name', 4=>'order_type', 5=>'reward_earned'];
        $whereOrder   = array("tbl_order_view_history.order_id"=>$orderId);
        
        $imageColumns = [];
        $searchableColumns = [0 =>'username'];
        
        $colDef['invoice_number'] =  ['target' => 0, 'visible' => true, 'searchable' => true];

        //Join Table
        $join['tbl_orders']['onCloumn'] = 'order_id';
        $join['tbl_orders']['type'] = 'inner'; //inner, left, right

        //Join Table
        $join['tbl_advert_viewer']['onCloumn'] = 'user_id';
        $join['tbl_advert_viewer']['joinTable'] = 'tbl_order_view_history';
        $join['tbl_advert_viewer']['type'] = 'inner'; //inner, left, right

        
        //Join Selectable columns
        $select['main_table'] = ['order_id'=>'order_id','reward_earned'=>'reward_earned'];
        $select['tbl_advert_viewer'] = ['username'=>'username','email'=>'email','contact_number'=>'contact_number','company_name'=>'company_name'];

        $select['tbl_orders'] = ['order_type'=>'order_type','id'=>'order_id'];

       
        if($this->input->get('ajax')==1){
          //Row action options
          $options = '<a href="'.site_url('admin/invoice/view/[order_id]').'" title="View" class="btn-xs btn btn-success">View</a>';
          //get paginated records for jquery datatables
          $data = $this->paginateJoin($this->OrderViewHistory, $join, $select, $columns, $searchableColumns, $options, $imageColumns,$whereOrder);
          echo $data;exit;
        }else{


          $paginationConfig = $this->config->item('pagination');
          $this->data['page_title'] = SITE_TITLE.' :: Order view list';
          $this->data['page'] = $this->_viewPath . "view-history.php";
          $this->data['useDataTables'] = true;
          $this->data['columns'] = $columns;
          $this->data['colDef'] = $colDef;
          $this->data['default_order_col'] = 3;
          $this->data['default_order_dir'] = $paginationConfig['default_order_dir'];
          $this->data['default_page_length'] = 10;//$paginationConfig['default_page_length'];
          $this->data['total_paid'] = $this->Common->getTotalPaidToAdvertViewerByOrderId($orderId);

          $this->load->view($this->_adminContainer, $this->data);
        }
    }


    function loadAddOrderView($data,$orderData = array(),$area = array(), $zip = array()){
       $this->data['page_title'] = SITE_TITLE.' :: Edit Order';
       $this->data['page'] = $this->_viewPath . "edit-order.php";
       $this->data['region'] = $data;
       $this->data['area'] = $area;
       $this->data['zip'] = $zip;
       $this->data['order_details'] = $orderData;
       $this->load->view($this->_adminContainer, $this->data);
    }

    public function editorders(){

        $data = $this->Common->getAllActiveRegion();
        $orderId      = $this->uri->segment(4);
        $whereOrder   = array("tbl_orders.id"=>$orderId);
        $area = array();
        $zip  = array();

        if($orderId != ""){
            $orderData = $this->Common->getOrderDetails("tbl_orders",$whereOrder);
            if($orderData[0]->order_type != "Whole Country"){
                $areaId = $orderData[0]->area_id;
                $zipId = $orderData[0]->pincode;
                
                $whereArea = array("area_id"=>$areaId);
                $whereZip = array("id"=>$zipId);
                $area = $this->Common->_get_all_records("tbl_area",$whereArea);
                $zip = $this->Common->_get_all_records("tbl_zipcode",$whereZip);
            }
            $this->loadAddOrderView($data,$orderData,$area,$zip);
        }else{
          show_404();
        } 

    }

    function setRules($options){
        if($options == "ADD_ORDER"){
            $this->form_validation->set_rules('startDate', 'Start date','trim|required');
            $this->form_validation->set_rules('endDate', 'End date','trim|required');
            $this->form_validation->set_rules('qty', 'quantity','trim|required');
            $radioSelected  = $this->input->post("customRadio");
            
            if($radioSelected != "Whole Country"){
              $this->form_validation->set_rules('dl_central', 'select central','trim|required');
              $this->form_validation->set_rules('dl_area', 'Select Area','trim|required');
              $this->form_validation->set_rules('dl_postal_code', 'Select Postal Code','trim|required');
            }
        }
    }



    function doeditorder(){
      $data = $this->Common->getAllActiveRegion();
      if(count($_POST) > 0){
          $this->setRules("ADD_ORDER");
          $orderId = $this->input->post('order_id');
          $country_id = "1";
          $pincode    = "0";
          if($this->input->post("dl_central") != ""){
            $country_id = $this->Common->get_country_from_region_id($this->input->post("dl_central"));
          }

          if($this->input->post("dl_central") != ""){
              $pincode = $this->input->post("dl_postal_code");
          }

          if($this->form_validation->run()){
              if (isset($_FILES['ads_image']) && $_FILES['ads_image']['name']!=""){
                  $file_name  = $_FILES['ads_image']['name'];
                  $ext    =   pathinfo($file_name, PATHINFO_EXTENSION);
                  $filename   =   date("Y_m_d_H_i_s").'_ads.'.$ext;
                  $config['overwrite']      = TRUE;
                  $config['upload_path']          = './uploads/ads';
                  $config['allowed_types']        = 'gif|jpg|png|jpeg';
                  $config['max_size']             = 20048;
                  $config['file_name']      = $filename;
                  $this->load->library('upload', $config);
                  if($this->upload->do_upload('ads_image')){
                    $insArray['image_path']    =   $filename;
                  }else{
                    $this->session->set_userdata(GLOBAL_MSG,"Error occured in upload image");
                    if($orderId != ""){
                      redirect('./admin/order/edit/'.$orderId);
                    }else{
                      $this->loadAddOrderView($data);
                    }
                  }
              }
              


              $insArray["start_date"]=$this->input->post('startDate');
              $insArray["end_date"]=$this->input->post('endDate');
              $insArray["quantity"]=$this->input->post('qty');
              $insArray["order_type"]=$this->input->post('customRadio');
              $insArray["advert_display_time"]=$this->input->post("advert_display_time");
              $insArray["advertise_per_view_cost"]=$this->input->post("advertise_per_view_cost");
              $insArray["details"]="";
              $insArray["country_id"]=$country_id;
              $insArray["radius" ]= "500";
              $insArray["pincode" ]= $pincode;
              $insArray["discount_amount"]="0.00";
              $insArray["modified"]=date("Y-m-d");
              
              $this->db->where(array("id"=>$orderId));
              $this->db->update("tbl_orders",$insArray);
              if($this->db->affected_rows() > 0){
                 $this->session->set_userdata(GLOBAL_MSG,"Order updated successfully");
              }else{
                  $this->session->set_userdata(GLOBAL_MSG,"Something went wrong please try again later");
              }
              redirect('./admin/order/edit/'.$orderId);
          }else{
              redirect('./admin/order/edit/'.$orderId);
          }
      }else{
         $this->loadAddOrderView($data); 
      } 
    }



    function vieworder(){

      if($this->uri->segment(4) != ""){
          $orderId      = $this->uri->segment(4);
          $whereOrder   = array("order_id"=>$orderId);
          //$whereOrderId   = array("order_id"=>$orderId);
          $data = $this->Common->getRecordById("tbl_order",$whereOrder);
          $pin  = "0";
          /*if($data[0]->order_type != "Whole Country"){
            $pincode = $data[0]->pincode;
            $where = array("id"=>$pincode);
            $dataPin = $this->Common->getRecordById("tbl_zipcode",$where);
            $pin = $dataPin[0]->zip_code;
          }*/ 

          $this->data['view_count'] =0;// $this->Common->getTotalViewOrderById($whereOrderId);
         
          $this->data['page_title'] = SITE_TITLE.' :: View order';
          $this->data['page'] = $this->_viewPath . "view-order.php";
          $this->data['order_details'] = $data;
          $this->data['pin'] = $pin;
          $this->load->view($this->_adminContainer, $this->data);

       

      }else{
        echo show_404();
      }
    }

}
