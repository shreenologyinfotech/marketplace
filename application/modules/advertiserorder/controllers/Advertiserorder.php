<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//require_once(BASEPATH.'core/MY_Controller.php');
class Advertiserorder extends MY_Controller {
    function __construct() {
        parent::__construct();
        header('Cache-Control: no-cache, must-revalidate, max-age=0');
        header('Cache-Control: post-check=0, pre-check=0');

        $this->load->library(array('form_validation','upload'));
        $rootPath   = APPPATH;
        $ActualRootPath = str_replace('\\', '/', $rootPath);
        require_once($ActualRootPath.'libraries/ImageManipulator.php');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        log_message('debug', 'CI My Admin : Auth class loaded');
        $this->Common->is_adveritser_login();
    }
 

    function setRules($options){
        if($options == "ADD_ORDER"){
            $this->form_validation->set_rules('startDate', 'Start date','trim|required');
            $this->form_validation->set_rules('endDate', 'End date','trim|required');
            $this->form_validation->set_rules('qty', 'quantity','trim|required');
            $radioSelected  = $this->input->post("customRadio");
           


            if($radioSelected == "Specific Postal Code"){
               $this->form_validation->set_rules('by_postal_selector', 'Enter postal code','trim|required');
            }else if($radioSelected == "Specific Radius"){
               $this->form_validation->set_rules('txt_key_postal', 'Enter postal code','trim|required');
            }

            /*
            if($radioSelected != "Whole Country"){
              $this->form_validation->set_rules('dl_central', 'select central','trim|required');
              $this->form_validation->set_rules('dl_area', 'Select Area','trim|required');
              //$this->form_validation->set_rules('dl_postal_code', 'Select Postal Code','trim|required');
            } */ 
        }
    }


    function applyorderfilter(){
      if(count($_POST) > 0){
        $filterValue = $this->input->post("filter");
          redirect('trackyourorders/'.urlencode($filterValue));
      }else{
        echo show_404();
      }
    }



    function deleteorder(){
          $orderId = $this->uri->segment(2);
          $this->db->where(array("id"=>$orderId));
          $updateArray = array("status"=>"Deleted");
          $this->db->update("tbl_orders",$updateArray);
          if($this->db->affected_rows() > 0){
              echo "YES";
          }else{
              echo "NO";
          }
        
    }
 

     function cancellorder(){
        if(count($_POST) > 0){
          $orderId = $this->input->post("order_id");
          $reason = $this->input->post("reason");

          $this->db->where(array("id"=>$orderId));
          $updateArray = array("status"=>"Cancelled Order","cancelled_reason"=>$reason,"cancelled_request_date"=>date("Y-m-d H:i:s"));
           $this->db->update("tbl_orders",$updateArray);
           
           if($this->db->affected_rows() > 0){
                 /*
                 $whereOrder   = array("tbl_orders.id"=>$orderId); 
                 $orderData = $this->Common->getOrderDetails("tbl_orders",$whereOrder);
       
                 $insArray = array(
                  "user_id"         => $this->Common->get_advertiser_id(),
                  "order_id"        => $orderId,
                  "refunded_amount" => $orderData[0]->remaining_balance,
                  "details"         => "Advertiser cancell his order", 
                  "status"          => "requested", 
                  "initate_from"    => "self"
                  );

                 $this->db->insert("tbl_advertiser_orders_refund",$insArray);
                 */

                 /*
                 $insTranactionArray = array(
                  "user_id"         => $this->Common->get_advertiser_id(),
                  "order_id"        => $orderId,
                  "amount"          => 0,
                  "refund_amount"   => $orderData[0]->remaining_balance,
                  "transaction_type" => "refund", 
                  "status"          => "completed", 
                  "date"            => date("Y-m-d H:i:s"),
                  "remark"          => "refund initiated by self");

                  $this->db->insert("tbl_transactions",$insTranactionArray);
                 */   


              echo "YES";
          }else{
              echo "NO";
          }
        }else{
          echo "NO";
        }
    }



    function vieworder(){
        
        $orderId      = $this->uri->segment(2);
        $advertiserId = $this->Common->get_advertiser_id();
        $where        = array("user_id"=>$advertiserId,"id"=>$orderId);
        $whereOrder   = array("id"=>$orderId);
        

        if($this->Common->isRecordExits("tbl_orders",$where)){
          $data = $this->Common->getRecordById("tbl_orders",$whereOrder);
          $pin  = "0";
          
          /*if($data[0]->order_type != "Whole Country"){
           // $pincode = $data[0]->pincode;
           // $where = array("id"=>$pincode);
           // $dataPin = $this->Common->getRecordById("tbl_zipcode",$where);
           // $pin = $dataPin[0]->zip_code;
          } */

          $this->data['page_title'] = SITE_TITLE.' :: View order';
          $this->data['page'] = $this->_viewPath . "view-order.php";
          $this->data['order_details'] = $data;
          $this->data['pin'] = $pin;
          $this->load->view($this->_frontContainer, $this->data);


        }else{
          echo show_404(); 
        }
    }



    function makeorderpayment(){
       /*if(count($_POST) > 0){
          $orderId = $this->input->post("orderId");
       }else{
          show_404();
       }*/
       $this->loadPayView();  
    }



    function loadPayView(){
      $where               =  array("id"=>$this->Common->get_advertiser_id());
      $advertiser_details  = $this->Common->getRecordById("tbl_advertiser",$where);
     
      $where       =  array("user_id"=>$this->Common->get_advertiser_id(),"status"=>"Pending Payment");
      $orderData   =  $this->Common->_get_all_records("tbl_orders",$where,$orderBy = "");
      
      $this->data['page_title'] = SITE_TITLE.' :: Order Payment';
      $this->data['page'] = $this->_viewPath . "order-payment.php";
      $this->data['order_details'] = $orderData;
      $this->data['advertiser_details'] = $advertiser_details;
      $this->load->view($this->_frontContainer, $this->data);
      
    }



    function editorder(){
        $data = $this->Common->getAllActiveRegion();
        $orderId      = $this->uri->segment(2);
        $advertiserId = $this->Common->get_advertiser_id();
        $where        = array("user_id"=>$advertiserId,"tbl_orders.id"=>$orderId);
        $whereOrder   = array("tbl_orders.id"=>$orderId);
        $area = array();
        $zip  = array();

        if($this->Common->isRecordExits("tbl_orders",$where)){
            $orderData = $this->Common->getOrderDetails("tbl_orders",$whereOrder);

            if($orderData[0]->status == "Pending Distribution" || $orderData[0]->status == "Pending Approval" || $orderData[0]->status == "Pending Payment"){

                $updateArray = ["delete_images"=>"[]"];
                $this->Common->_update("tbl_orders", $updateArray, $whereOrder);

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
            
        }else{
          show_404();
        } 

    }


    private function set_upload_options($filename){   
        //upload an image options
        $config = array();
        $config['overwrite']            = TRUE;
        $config['upload_path']          = './uploads/ads';
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 20048;
        $config['file_name']            = $filename;
        return $config;
    }



    public function ResizeImage($target,$fileName,$width,$height,$tmpName,$degrees,$ext){
        $manipulator = new ImageManipulator($tmpName);
        // resizing to dimension
        $newImage = $manipulator->resample($width, $height);
        // saving file to uploads folder
        $type="IMAGETYPE_JPEG";
        if($ext=='png'){
            $type="IMAGETYPE_PNG";
        }else if($ext=='gif'){
            $type="IMAGETYPE_GIF";
        }
        $manipulator->save($target . $fileName,$type,$degrees);
    }


    function index() {
      $data = $this->Common->getAllActiveRegion();

      if(count($_POST) > 0){
          $this->setRules("ADD_ORDER");
          $orderId = $this->input->post('order_id');
          $numberOfImages = $this->input->post('numberOfImages');
          $radioSelected  = $this->input->post("customRadio");


          if($radioSelected == "Specific Postal Code"){
             $checkZipRadius = $this->input->post('by_postal_selector');
          }else if($radioSelected == "Specific Radius"){
             $checkZipRadius = $this->input->post('txt_key_postal');
          }
          
          $country_id = "1";
          $pincode    = "0";
          if($this->input->post("dl_central") != ""){
            $country_id = $this->Common->get_country_from_region_id($this->input->post("dl_central"));
          }

          /*if($this->input->post("dl_central") != ""){
              $pincode = $this->input->post("dl_postal_code");
          }*/

          if($this->form_validation->run()){
                $pathOriginal   =   "uploads/ads/";
                $pathThumb      =   "uploads/ads/thumb/";
                $pathMedium     =   "uploads/alaa_images/medium/";
                
                $file_name      = implode(',', $_FILES['ads_image']['name']);
                $filenameexp    = explode(',', $file_name);
                $tmpfile_name   = implode(',', $_FILES['ads_image']['tmp_name']);
                $tmpfilenameexp = explode(',', $tmpfile_name);
                $imgArr = array();
                $k = 0;
                for ($i = 0;$i < count($filenameexp);$i++) {
                    if($numberOfImages == $i){
                      break;
                    }
                    
                    if ($filenameexp[$i] != '' || $filenameexp[$i] != 0) {
                        $filename = 'ads_' . date('YmdHis') . '_' . $filenameexp[$i];
                        $ext    =   $filenameexp[$i];
                        $degree     =   "0";
                        
                        $chkfile = move_uploaded_file($tmpfilenameexp[$i], $pathOriginal.$filename);
                        if ($chkfile) {
                            $filenameFull               =   $pathOriginal.$filename;
                            $thumbImageUpload           =   $this->ResizeImage($pathThumb,$filename,$this->config->item('ad_image_thumb_width'),'0',$filenameFull,$degree,$ext);
                            $filename = $filename;
                        } else {
                            $filename = '';
                            $Primary_filename = '';
                        }
                        $imgArr[] = $filename;
                        $k = 1;
                    }
              }
             
              $insArray["user_id"]    = $this->Common->get_advertiser_id();
              $insArray["start_date"] = date("Y-m-d",strtotime($this->input->post('startDate')));
              $insArray["end_date"]   = date("Y-m-d",strtotime($this->input->post('endDate')));
              $insArray["quantity"]   = $this->input->post('qty');
              $insArray["order_type"] = $this->input->post('customRadio');
              $insArray["advert_display_time"]=advert_display_time();
              $insArray["refer_link"] = $this->input->post('referlink');
              $insArray["details"]="";
              $insArray["country_id"]=$country_id;
              $insArray["radius" ]= "500";
             // $insArray["pincode" ]= $pincode;
              $insArray["discount_amount"]="0.00";

              $insArray["transaction_fee"]=transaction_fee();
              $insArray["modified"]=date("Y-m-d");

              if($orderId == ""){
                 $insArray["created"]=date("Y-m-d");
                 $insArray["order_id"]=$this->Common->get_order_id();
              }

            

              /*update lat and long */
              if($this->input->post('customRadio') == "Specific Radius"){
                    $postal_code   =  $this->input->post('txt_key_postal');
                    $wherePostal  =  ["postal_code"=>$postal_code];
                    
                    if(!$this->Common->_is_record_exits("tbl_postal_location",$wherePostal)){
                          $dataPostalCode = get_lat_long($postal_code);

                          $insArray["order_lat"]         = $dataPostalCode["lat"];
                          $insArray["order_lng"]         = $dataPostalCode["lng"];

                          $insPostal = ["lat"=>$dataPostalCode["lat"],"lng"=>$dataPostalCode["lng"],"postal_code"=>$postal_code,"created_at"=>date("Y-m-d")];
                          $this->db->insert("tbl_postal_location",$insPostal);
                     }else{
                          $dataPostal = $this->Common->_get_all_records("tbl_postal_location",$wherePostal);
                          $insArray["order_lat"]         = $dataPostal[0]->lat;
                          $insArray["order_lng"]         = $dataPostal[0]->lng;
                     }

              }


              if($orderId != ""){
                 $whereOrder = array("id"=>$orderId);
                 $orderData = $this->Common->_get_all_records("tbl_orders",$whereOrder);
                 
                 if($orderData[0]->status == "Pending Distribution"){
                    $insArray["start_date"] = $orderData[0]->start_date;
                    $insArray["end_date"]   = $orderData[0]->end_date;
                    $insArray["quantity"]   = $orderData[0]->quantity;
                    $insArray["refer_link"] = $orderData[0]->refer_link;
                 }else if($orderData[0]->status == "Pending Approval"){
                   $insArray["quantity"]   = $orderData[0]->quantity;
                 }

                 $existingArray = array();
                 $existingArrayTemp = json_decode($orderData[0]->image_path);
                 $deleteArray   = json_decode($orderData[0]->delete_images);

                 foreach ($existingArrayTemp as $value) {
                   if(!in_array($value, $deleteArray)){
                      array_push($existingArray, $value);
                   }
                 } 
                 foreach ($imgArr as $value) {
                     array_push($existingArray, $value);    
                 }
                 if(sizeof($existingArray) > 0){
                   $insArray["image_single"]     = $existingArray[0];
                 }
                 $fineArray = array();
                 for ($i=0; $i < $numberOfImages; $i++) { 
                      array_push($fineArray, $existingArray[$i]);
                 }

                 $insArray["image_path"]       = json_encode($fineArray);
                 $insArray["image_path_thumb"] = json_encode($fineArray);
                 
                 $earningObj                           = get_earning_by_images(count($fineArray));
                 $insArray["earning_per_view_green"]   = $earningObj->earning_per_view_green;
                 $insArray["earning_per_view_silver"]  = $earningObj->earning_per_view_silver;
                 $insArray["earning_per_view_gold"]    = $earningObj->earning_per_view_gold;

                 $insArray["advertise_per_view_cost"] = per_view_cost_by_number_of_images(count($fineArray));
                 $insArray["total_cost"]         = ($this->input->post('qty')* per_view_cost_by_number_of_images(count($fineArray)));
                 $insArray["remaining_balance"]  = ($this->input->post('qty')* per_view_cost_by_number_of_images(count($fineArray))); 

                 $this ->db->where('order_id', $orderId);
                 $this->db->delete("tbl_order_zipcodes");


                if($this->input->post('customRadio') == "Specific Postal Code"){
                    if($checkZipRadius != ""){
                      $checkZipRadius = explode(",", $checkZipRadius);
                      foreach ($checkZipRadius as $value) {
						$value = trim($value);
						if( $value != "" ){  
							$orderZipArray = array("country_id"=>"0","order_id"=>$orderId,"zipcode"=>$value); 
							$this->db->insert("tbl_order_zipcodes",$orderZipArray);
						}
                      }
                    }
                 }

                 $this->db->where(array("id"=>$orderId));
                 $this->db->update("tbl_orders",$insArray);
                 $this->session->set_userdata(GLOBAL_MSG_FRONT,"Order updated successfully");
                 redirect('./trackyourorders','refresh');
              
              }else{
                  if(sizeof($imgArr) > 0){
                     $insArray["image_single"] = $imgArr[0];
                  }
                  
                  $insArray["image_path"] = json_encode($imgArr);
                  $insArray["image_path_thumb"] = json_encode($imgArr);
                  
                  $earningObj                           = get_earning_by_images(count($imgArr));
                  $insArray["earning_per_view_green"]   = $earningObj->earning_per_view_green;
                  $insArray["earning_per_view_silver"]  = $earningObj->earning_per_view_silver;
                  $insArray["earning_per_view_gold"]    = $earningObj->earning_per_view_gold;

                  $insArray["advertise_per_view_cost"] = per_view_cost_by_number_of_images(count($imgArr));
                  $insArray["total_cost"]              = ($this->input->post('qty')* per_view_cost_by_number_of_images(count($imgArr)));
                  $insArray["remaining_balance"]       = ($this->input->post('qty')* per_view_cost_by_number_of_images(count($imgArr)));

                  if($this->db->insert("tbl_orders",$insArray)){
                     $orderId = $this->db->insert_id();
                     $this ->db->where('order_id', $orderId);
                     $this->db->delete("tbl_order_zipcodes");



                   if($this->input->post('customRadio') == "Specific Postal Code"){
                      if($checkZipRadius != ""){
                        $checkZipRadius = explode(",", $checkZipRadius);
                        foreach ($checkZipRadius as $value) {
							$value = trim($value);
							if( $value != "" ){
								$orderZipArray = array("country_id"=>"0","order_id"=>$orderId,"zipcode"=>$value); 
								$this->db->insert("tbl_order_zipcodes",$orderZipArray);
							}
                        }
                      }
                   }
                   
                    
                    redirect('./makeorderpayment');
                  }else{
                    $this->session->set_userdata(GLOBAL_MSG_FRONT,"Something went wrong please try again later");
                    $this->loadAddOrderView($data);
                  }
              }
          }else{
            $this->session->set_userdata(GLOBAL_MSG_FRONT,"Please fill in all required feilds");
            if($orderId != ""){
              redirect('./editorder/'.$orderId);
            }else{
              $this->loadAddOrderView($data);
            }
          }
      }else{
         $this->loadAddOrderView($data); 
      } 
    }
    

    /*here comes*/
    function getpinbyarea(){
      $fineArray = array();
      if(count($_POST) > 0){
        $area_id = $_POST["area_id"];
        $this->Common->ajaxPostalByAreaId($area_id);
      }else{
        echo "NO";
      }
    }

    function getareabycentral(){
      $fineArray = array();
      if(count($_POST) > 0){
        $central_id = $_POST["central_id"];
        $this->Common->ajaxAreaByCentralId($central_id);
      }else{
        echo "NO";
      }
    }


    function loadAddOrderView($data,$orderData = array(),$area = array(), $zip = array()){
       if(count($orderData) > 0){
          $this->data['page_title'] = SITE_TITLE.' :: Edit Order';
       }else{
          $this->data['page_title'] = SITE_TITLE.' :: Create Order';
       }

       $this->data['price_table'] = $this->Common->_get_all_records("tbl_pricetable",array());
       $this->data['page'] = $this->_viewPath . "create-order.php";
       $this->data['region'] = $data;
       $this->data['area'] = $area;
       $this->data['zip'] = $zip;
       $this->data['zip'] = $zip;


       $this->data['Central'] = $this->Common->getAllZipCodes("",["cetral_location"=>"Central"]);
       $this->data['East'] = $this->Common->getAllZipCodes("",["cetral_location"=>"East"]);
       $this->data['North'] = $this->Common->getAllZipCodes("",["cetral_location"=>"North"]);
       $this->data['West'] = $this->Common->getAllZipCodes("",["cetral_location"=>"West"]);
       
       $this->data['order_details'] = $orderData;
       $this->load->view($this->_frontContainer, $this->data);
    }


    
}
