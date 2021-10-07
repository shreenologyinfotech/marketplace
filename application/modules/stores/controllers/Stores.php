<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//require_once(BASEPATH.'core/MY_Controller.php');
class Stores extends MY_Controller {
  function __construct() {
        parent::__construct();
        $this->load->model('Store');
       	$this->load->library('form_validation');    
  		  $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->Common->is_admin_login();
    }

    function setRules($options){
        if($options == "ADD_USERS"){
            $this->form_validation->set_rules('firstName', 'first name','trim|required');
            $this->form_validation->set_rules('username', 'User name','trim|required');
            $this->form_validation->set_rules('lastName', 'last name','trim|required');
            $this->form_validation->set_rules('email', 'email','trim|required');
            $this->form_validation->set_rules('password', 'Password','trim|required');
            $this->form_validation->set_rules('companyName', 'companyName','trim|required');
            $this->form_validation->set_rules('contact', 'contact','trim|required');
            $this->form_validation->set_rules('payment_mode', 'Payment Mode','trim|required');
            $this->form_validation->set_rules('employment_status_id', 'Employment','trim|required');
            $this->form_validation->set_rules('martial_status', 'Martial Status','trim|required');
            $this->form_validation->set_rules('postal_code', 'Postal Code','trim|required');
            $this->form_validation->set_rules('contact', 'contact','trim|required');
            $this->form_validation->set_rules('gender', 'gender','trim|required');
            $this->form_validation->set_rules('date_of_birth', 'dob','trim|required');
        }
    }

   
    function delete(){
        $storeId = $this->uri->segment(3);
        $this->db->where(array("store_id"=>$storeId));
        $updateArray = array("status"=>"D");
        $this->db->update("tbl_stores",$updateArray);
        if($this->db->affected_rows() > 0){
            echo "YES";
        }else{
            echo "NO";
        } 
    }

    function approve(){
        $storeId = $this->uri->segment(3);
        $this->db->where(array("store_id"=>$storeId));
        $updateArray = array("status"=>"A");
        $this->db->update("tbl_stores",$updateArray);
        if($this->db->affected_rows() > 0){
            echo "YES";
        }else{
            echo "NO";
        } 
    }

     function inactive(){
        $storeId = $this->uri->segment(3);
        $this->db->where(array("store_id"=>$storeId));
        $updateArray = array("status"=>"I");
        $this->db->update("tbl_stores",$updateArray);
        if($this->db->affected_rows() > 0){
            echo "YES";
        }else{
            echo "NO";
        } 
    }
    function activevat(){
        $storeId = $this->uri->segment(3);
        $this->db->where(array("store_id"=>$storeId));
        $updateArray = array("vat_verified"=>"Y");
        $this->db->update("tbl_stores",$updateArray);
        if($this->db->affected_rows() > 0){
            echo "YES";
        }else{
            echo "NO";
        } 
    }

     function inactivevat(){
        $storeId = $this->uri->segment(3);
        $this->db->where(array("store_id"=>$storeId));
        $updateArray = array("vat_verified"=>"N");
        $this->db->update("tbl_stores",$updateArray);
        if($this->db->affected_rows() > 0){
            echo "YES";
        }else{
            echo "NO";
        } 
    }
    
    function deleteusers(){

      $delteUserArray =  $this->input->post("actions");
        if(sizeof($delteUserArray) == 0){
            $this->session->set_userdata(GLOBAL_MSG,"Please select at least one user.");
        }else{
            for ($i=0; $i <count($delteUserArray) ; $i++) { 
              $advertiseId =  $delteUserArray[$i];

              $this->db->where(array("id"=>$advertiseId));
              $updateArray = array("status"=>"Deleted");
              
              $this->db->update("tbl_advert_viewer",$updateArray);
            }

            $this->session->set_userdata(GLOBAL_MSG,"User deleted successfully !!");
        }
        
        redirect("./admin/users");

    }



    function index() {
       $columns =  [0 =>'store_id',1 =>'store_name',3 =>'store_email',4=> 'store_mobile', 5=> 'store_image', 6=> 'owner_first_name', 7=>'address',8=>'visible_to_home',9=>'status', 10=> 'created_at', 11 =>'vat_number',12=>'option'];
        $imageColumns = [];

        $searchableColumns = [0 =>'store_id',1 =>'store_name',3 =>'store_email',4=> 'store_mobile', 5=> 'store_image', 6=> 'owner_first_name', 7=>'address',8=>'status', 9=> 'created_at', 10 =>'vat_number',11=>'option'];

        $colDef['store_email'] =  ['target' => 0, 'visible' => true, 'searchable' => true];


        
        if($this->input->get('ajax')==1){
          //Row action options
          $options = '<a href="'.site_url('editstore/[id]').'" title="Edit" class="btn-xs btn btn-primary">Edit</a>';
          //get paginated records for jquery datatables
          $data = $this->ajaxStoreList($this->Store, $columns, $searchableColumns, $options, $imageColumns, array("status <> "=>"D","user_type"=>"S"));
         

          echo $data;exit;
        }
        else{
          $paginationConfig = $this->config->item('pagination');
          $this->data['page_title'] = SITE_TITLE.' :: Stores list';
          $this->data['page'] = $this->_viewPath . "stores.php";
          $this->data['useDataTables'] = true;
          $this->data['columns'] = $columns;
          $this->data['colDef'] = $colDef;
          $this->data['default_order_col'] = 1;
          $this->data['default_order_dir'] = $paginationConfig['default_order_dir'];
          $this->data['default_page_length'] = 10;//$paginationConfig['default_page_length'];
          $this->load->view($this->_adminContainer, $this->data);
        }
    }



    function updatestaus(){

        $dataArray        =  $this->input->post("actions");
        $dataArrayApprove =  $this->input->post("actionapprove");
        $actionButton     =  $this->input->post("actionButton");
        
        

        if($actionButton == "Paid"){

            if(sizeof($dataArrayApprove) == 0){
                $this->session->set_userdata(GLOBAL_MSG,"Please select at least one approved request.");
            }else{
                for ($i=0; $i <count($dataArrayApprove) ; $i++) { 
                  $Id =  $dataArrayApprove[$i];
                  $status = "Paid";
                  $where = array("id"=>$Id);
                  $where = $this->db->where($where);
                  $updateArray = array("status"=>$status,"withdraw_process_date"=> date("Y-m-d H:i:s"));
                  $this->db->update("tbl_advert_viewer_withdraw",$updateArray);
                   /*insert notification*/
                    $where = array("id"=>$Id);
                    $widthDrawData = $this->Common->_get_all_records("tbl_advert_viewer_withdraw",$where);
                    if(sizeof($widthDrawData) > 0){
                        $msg = WITHDRAW_STATUS_UDPATE_NOTIFICATION_MSG.strtolower($status);
                        $insArray = array(
                            "title"=>WITHDRAW_STATUS_UDPATE_NOTIFICATION_TITLE,
                            "msg"=>$msg,
                            "user_id"=>$widthDrawData[0]->user_id
                        );
                        $this->db->insert("tbl_notification",$insArray);
                        sendNotificationToUserId($widthDrawData[0]->user_id,$msg);

                        $adveretViewerData  = $this->Common->_get_all_records("tbl_advert_viewer",array("id"=>$widthDrawData[0]->user_id));
                        if(sizeof($adveretViewerData)>0){
                          $this->EmailTemplate->sendWithdrawStatusPaidMail($adveretViewerData[0]->username,$adveretViewerData[0]->email);
                         }

                    }

                     
                   /*insert notification*/ 
                }
                $this->session->set_userdata(GLOBAL_MSG,"Approved requests paid successfully.");
            }

        }else if($actionButton == "Approve"){ 

            if(sizeof($dataArray) == 0){
                $this->session->set_userdata(GLOBAL_MSG,"Please select at least one request.");
            }else{
                for ($i=0; $i <count($dataArray) ; $i++) { 
                  $Id =  $dataArray[$i];
                  $status = "Approved";
                  $where = array("id"=>$Id);
                  $this->db->where($where);
                  $updateArray = array("status"=>$status);
                  if($status == "Paid"){
                       $updateArray["withdraw_process_date"] = date("Y-m-d H:i:s");
                  }
                  $this->db->update("tbl_advert_viewer_withdraw",$updateArray);


                  /*insert notification*/
                    $widthDrawData = $this->Common->_get_all_records("tbl_advert_viewer_withdraw",$where);
                    if(sizeof($widthDrawData) > 0){
                        $msg = WITHDRAW_STATUS_UDPATE_NOTIFICATION_MSG.strtolower($status);
                        $insArray = array(
                            "title"=>WITHDRAW_STATUS_UDPATE_NOTIFICATION_TITLE,
                            "msg"=>$msg,
                            "user_id"=>$widthDrawData[0]->user_id
                        );
                        $this->db->insert("tbl_notification",$insArray);
                        sendNotificationToUserId($widthDrawData[0]->user_id,$msg);  
                        $adveretViewerData  = $this->Common->_get_all_records("tbl_advert_viewer",array("id"=>$widthDrawData[0]->user_id));
                        if(sizeof($adveretViewerData)>0){
                          $this->EmailTemplate->sendWithdrawStatusApporveMail($adveretViewerData[0]->username,$adveretViewerData[0]->email);
                         }
                    }
                   /*insert notification*/


                }
                $this->session->set_userdata(GLOBAL_MSG,MSG_REQUEST_APPROVED_SUCCESS);
            }

        }

            
        redirect("./admin/user/withdrawrequest/".$this->input->post('user_id'));

    }



    function loadAddView($data = array()){
          $this->data['page_title'] = SITE_TITLE.' :: Users';
          $this->data['page'] = $this->_viewPath."add.php";
          $this->data['emp'] = $this->Common->get_all_record("tbl_employment_status",array());
          $this->data['data'] = $data;
          $this->load->view($this->_adminContainer, $this->data);
    }


    function viewusers(){
          $userId = $this->uri->segment("4");
          $this->data['page_title'] = SITE_TITLE.' :: User details';
          $this->data['page'] = $this->_viewPath."view.php";
          $this->data['data'] = $this->Common->get_all_record("tbl_advert_viewer",array("id"=>$userId));
          $this->data['bank_details'] = $this->Common->get_all_record("tbl_advert_viewer_bank",array("user_id"=>$userId));
          $this->data['user_interest'] = $this->Common->get_all_record("tbl_user_interests",array("user_id"=>$userId));
          
         //$this->data['user_address'] = $this->Common->get_all_record("tbl_address",array("user_id"=>$userId));
          $this->load->view($this->_adminContainer, $this->data);
    }


    

    function edituser(){
      $userId = $this->uri->segment(2);
      if($userId != ""){
        $where = array("id"=>$userId);
        $data = $this->Common->get_all_record("tbl_advert_viewer",$where);
        $this->loadAddView($data);
      }else{
        echo show_404();
      }
    }


 
    function adduser(){
      $id  = "";
      if(count($_POST)){
        $this->setRules("ADD_USERS");
        $id      = $this->input->post('id');

        if($this->form_validation->run()){
          $fName          = $this->input->post('firstName');
          $lName          = $this->input->post('lastName');
          $email          = $this->input->post('email');
          $password       = $this->input->post('password');
          $companyName    = $this->input->post('companyName');
          $contact        = $this->input->post('contact');

          $date_of_birth        = $this->input->post("date_of_birth"); 
          $gender               = $this->input->post("gender"); 
          $payment_mode         = $this->input->post("payment_mode");
          $employment_status_id = $this->input->post("employment_status_id");
          $martial_status       = $this->input->post("martial_status");
          $postal_code          = $this->input->post("postal_code");
          $username             = $this->input->post("username");

          $where = array("email"=>$email,"status <> "=>"Deleted");
          $wherePhone = array("contact_number"=>$contact,"status <> "=>"Deleted");
        
          
          if($id != ""){
            $where["id !="] = $id;
            $wherePhone["id !="] = $id;
          }

          if($this->Common->_is_record_exits("tbl_advert_viewer",$where)){
              $this->session->set_userdata(GLOBAL_MSG,"This email is already register with us!!!");
          }else if($this->Common->_is_record_exits("tbl_advert_viewer",$wherePhone)){
             $this->session->set_userdata(GLOBAL_MSG,"This phone number is already register with us!!!");
          }else{

            $insArray =  array(
                "fname" =>$fName,
                "lname" =>$lName,
                "email" =>$email,
                "contact_number" =>$contact,
                "company_name" =>$companyName,
                "password" =>md5($password),
                "enk_key" =>base64_encode($password),
                "date_of_birth" =>$date_of_birth,
                "gender" =>$gender,
                "payment_mode" =>$payment_mode,
                "employment_status_id" =>$employment_status_id,
                "martial_status" =>$martial_status,
                "postal_code" =>$postal_code,
                "username" =>$username,
                "modified"=>date("Y-m-d H:i:s"),
                "modified_by"=>$this->Common->get_admin_id(),
            );


            if($id == ""){
               $insArray["is_email_verified"]      =  "Yes";
               $insArray["is_phone_verified"]     =  "Yes";  
               $insArray["status"]                 = "Approved";
               $insArray["created"]                = date("Y-m-d");
               
               $insArray["created_by"]             = $this->Common->get_admin_id(); 
                 if($this->Common->_insert("tbl_advert_viewer",$insArray)){
                    $this->session->set_userdata(GLOBAL_MSG,"User added successfully");
                 }else{
                    $this->session->set_userdata(GLOBAL_MSG,"Something went wrong please try again later");
                 } 
            }else{
              $this->db->where(array("id"=>$id));
              $this->db->update("tbl_advert_viewer",$insArray);

              if($this->db->affected_rows() > 0){
                 $this->session->set_userdata(GLOBAL_MSG,"User's details updated successfully");
                 redirect("./admin/users/");
              }else{
                 $this->session->set_userdata(GLOBAL_MSG,"Something went wrong please try again later");
              } 
            }
          }
        }else{
            $this->session->set_userdata(GLOBAL_MSG,filter_validation_errors());
        }
      }

     if($id == ""){
       $this->loadAddView(); 
     }else{
        redirect("./edituser/".$id);
     }
    }



}



