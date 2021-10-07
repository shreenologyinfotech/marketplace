<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends MY_Controller{

    public function __construct(){
        parent::__construct();
        $this->load->Model("EmailTemplate");
    }



    function test(){
       $data =  get_lat_long("921428");
       print_r($data);
       die;
    }



    function setRules($options){
        if($options == "USER_LOGIN"){
            $this->form_validation->set_rules('email', 'Email','trim|required');
            $this->form_validation->set_rules('password', 'Password','trim|required');
            $this->form_validation->set_rules('device_type', 'Device Type','trim|required');
        
        }else if($options == "USER_SIGNOUT" || $options == "USER_PROFILE_BY_ID"   || $options == "EMP_STATUS_INTREST"){
        	$this->form_validation->set_rules('user_id', 'User id','trim|required');
        
        }else if($options == "USER_TRANSACTION_HISTORY" || $options == "USER_NOTIFICATION" ){
            $this->form_validation->set_rules('user_id', 'User id','trim|required');
            $this->form_validation->set_rules('start_limit', 'Start Limit','trim|required');
        
        }else if($options == "UPDATE_TOKEN"){

        	$this->form_validation->set_rules('user_id', 'User id','trim|required');
        	$this->form_validation->set_rules('device_type', 'Device type','trim|required');
        	$this->form_validation->set_rules('device_token', 'Device token','trim|required');
       
        }else if($options == "CHANGE_PASSWORD"){

        	$this->form_validation->set_rules('user_id', 'User id','trim|required');
        	$this->form_validation->set_rules('old_password', 'Old Password','trim|required');
        	$this->form_validation->set_rules('new_password', 'New Password','trim|required');
        }else if($options == "CONTACT_US"){
        	
        	$this->form_validation->set_rules('user_id', 'User id','trim|required');
        	$this->form_validation->set_rules('name', 'User name','trim|required');
        	$this->form_validation->set_rules('subject', 'Subject','trim|required');
        	$this->form_validation->set_rules('email', 'Email','trim|required');
        	$this->form_validation->set_rules('message', 'Message','trim|required');
        

        }else if($options == "USER_SIGNUP"){
            $this->form_validation->set_rules('username', 'User Nmae','trim|required');
            $this->form_validation->set_rules('mobile_number', 'Mobile Number','trim|required');
            $this->form_validation->set_rules('email', 'Email Address','trim|required');
            $this->form_validation->set_rules('password', 'Password','trim|required');
            $this->form_validation->set_rules('postal_code', 'Postal Code','trim|required');
          //  $this->form_validation->set_rules('unit_number', 'Unit Number','trim|required');
          //  $this->form_validation->set_rules('floor_number', 'Floor Number','trim|required');
        
        }else if($options == "UPDATE_USER_PROFILE_BY_ID"){
            $this->form_validation->set_rules('user_name', 'User Name','trim|required');
            $this->form_validation->set_rules('mobile', 'Mobile Number','trim|required');
            $this->form_validation->set_rules('postal_code', 'Postal Code','trim|required');
           // $this->form_validation->set_rules('unit_number', 'Unit Number','trim|required');
            $this->form_validation->set_rules('user_id', 'User Id','trim|required');
           // $this->form_validation->set_rules('floor_number', 'Floor Number','trim|required');

        }else if($options == "UPDATE_USER_QUESTIONATY_BY_ID"){
            $this->form_validation->set_rules('user_id', 'User Id','trim|required');
            $this->form_validation->set_rules('dob', 'Dob','trim|required');
            $this->form_validation->set_rules('gender', 'Gender','trim|required');
            $this->form_validation->set_rules('employeement_status', 'Employeement Status','trim|required');
            $this->form_validation->set_rules('marital_status', 'Marital Status','trim|required');
            $this->form_validation->set_rules('interest', 'Inerest','trim|required');

        }else if($options == "UPDATE_USER_BANK_DETAILS"){
            $this->form_validation->set_rules('user_id', 'User Id','trim|required');
            $this->form_validation->set_rules('payment_mode', 'Payment mode','trim|required');

            if($this->input->post("payment_mode") == "Bank Account"){
                $this->form_validation->set_rules('account_number', 'Account Number','trim|required');
                $this->form_validation->set_rules('account_holder_name', 'Account Holder Name','trim|required');
                $this->form_validation->set_rules('bank_name', 'Bank Name','trim|required');
            }else{
                $this->form_validation->set_rules('payment_mobile_number', 'Payment Mobile Number','trim|required');
            }

        }else if($options == "WITHDRAW_REQUEST"){
            $this->form_validation->set_rules('user_id', 'User Id','trim|required');
            $this->form_validation->set_rules('amount', 'Amount','trim|required');
        
        }else if($options == "GET_ALL_ADS"){
            $this->form_validation->set_rules('user_id', 'User Id','trim|required');
            $this->form_validation->set_rules('start_limit', 'Start Limit','trim|required');
        
        }else if($options == "GET_LATEST_ADS"){
            $this->form_validation->set_rules('user_id', 'User Id','trim|required');
        
        }else if($options == "SEEN_ADS"){
            $this->form_validation->set_rules('user_id', 'User Id','trim|required');
            $this->form_validation->set_rules('order_id', 'Order Id','trim|required');
        }else if($options == "FORGOT_PASSWORD"){
            $this->form_validation->set_rules('email', 'Email','trim|required');
        
        }else if($options == "SUBMIT_EVENT"){
            $this->form_validation->set_rules('user_id', 'User Id','trim|required');
            $this->form_validation->set_rules('event_id', 'Event Id','trim|required');
            $this->form_validation->set_rules('event_answer', 'Event Answer','trim|required');
        }else if($options == "GET_EVENT"){
            $this->form_validation->set_rules('user_id', 'User Id','trim|required');
        }else if($options == "VERIFICATION_MOBILE"){
            $this->form_validation->set_rules('user_id', 'User Id','trim|required');
            $this->form_validation->set_rules('verification_code', 'Verification Code','trim|required');
            $this->form_validation->set_rules('mobile', 'Mobile','trim|required');
        }else if($options == "RESEND_VERIFICATION_CODE"){
            $this->form_validation->set_rules('user_id', 'User Id','trim|required');
            $this->form_validation->set_rules('mobile', 'Mobile','trim|required');
           
        }else if($options == "ORDER_MORE_INFO_CLICK"){
            $this->form_validation->set_rules('user_id', 'User Id','trim|required');
            $this->form_validation->set_rules('order_id', 'Order Id','trim|required');
           
        }else if($options == "GET_PRICETABLE_ADVERISER"){
            $this->form_validation->set_rules('user_id', 'User Id','trim|required');
        }

    }


     public function getpricetableadvertiser(){
        $dataArray = array();
        if(count($_POST) > 0){
           $this->setRules("GET_PRICETABLE_ADVERISER");
           if($this->form_validation->run()){
            
                $user_id = $this->input->post("user_id");
                $data = $this->Common->_get_all_records("tbl_price_table_advert_viewer",[]);

                $this->Common->showArrayRespose(GLOBAL_RESULT_YES,"Success",$data,$user_id);
           }else{
            $this->Common->showArrayRespose(GLOBAL_RESULT_NO,filter_validation_errors(),$dataArray);
           }
        }else{
             $this->Common->showArrayRespose(GLOBAL_RESULT_NO,GLOBAL_VALIDATION_ERROR,$dataArray); 
        }
    }

   

    public function faq(){
        /*
        $this->data['page_title'] = SITE_TITLE.' :: Faq';
        $this->data['page'] = $this->_viewPathApi . "faq";
        $orderBy = "faq_id";
        $this->data['data'] = $this->Common->_get_all_records("tbl_faq",array(),$orderBy);
        $this->load->view($this->_apiContainer, $this->data);
        */

        $this->data['page_title'] = SITE_TITLE.' :: Faq';
        $this->data['page'] = $this->_viewPathApi . "dynamic-content.php";
        $this->data['data'] =  $data = $this->Common->_get_all_records("tbl_dynamic_pages",array("type"=>"app-faq"));
        $this->load->view($this->_apiContainer, $this->data);
    }


    public function aboutus(){
        $this->data['page_title'] = SITE_TITLE.' :: About-us';
        $this->data['page'] = $this->_viewPathApi . "dynamic-content.php";
        $this->data['data'] =  $data = $this->Common->_get_all_records("tbl_dynamic_pages",array("type"=>"app-about-us"));



        $this->load->view($this->_apiContainer, $this->data);

    }

 //SEEN_ADS  user_id order_id

    

    public function onderinfoclick(){
        if(count($_POST) > 0){
           $this->setRules("ORDER_MORE_INFO_CLICK");
           if($this->form_validation->run()){
                $data = array();
                $user_id = $this->input->post("user_id");
                $order_id = $this->input->post("order_id");

                $where = array("user_id"=>$user_id,"order_id"=>$order_id);
                if($this->Common->_is_record_exits("tbl_order_click_info",$where)){
                        $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"Fail",$data);
                }else{
                    $where["date"] = date("Y-m-d H:i:s");
                    if($this->Common->_insert("tbl_order_click_info", $where)){
                      $this->Common->showObjectResponse(GLOBAL_RESULT_YES,"Success",$data);
                    }else{
                        $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"Fail",$data);
                    }
                }

                
           }else{
            $this->Common->showObjectResponse(GLOBAL_RESULT_NO,filter_validation_errors(),$dataArray);
           }
        }else{
             $this->Common->showObjectResponse(GLOBAL_RESULT_NO,GLOBAL_VALIDATION_ERROR,$dataArray); 
        }
    }


    public function updateadtoseen(){
        $dataArray = array();
        if(count($_POST) > 0){
           $this->setRules("SEEN_ADS");
           if($this->form_validation->run()){
                $data = array();
                $user_id = $this->input->post("user_id");
                $order_id = $this->input->post("order_id");
                $advertViewerDetail  = $this->Common->_get_all_records("tbl_advert_viewer",array("id"=>$user_id));
                /*deduct advertiser credits*/
                $orderDetail    = $this->Common->_get_all_records("tbl_orders",array("id"=>$order_id));
                
                

               
                
               

                $advertiserId   = $orderDetail[0]->user_id;
                $perViewCost    = $orderDetail[0]->advertise_per_view_cost;    
                $creditsRemains = $orderDetail[0]->remaining_balance;    
                if($creditsRemains >= $perViewCost){

                   /*insert views */
                   $insArray = array("order_id"=>$order_id,"user_id"=>$user_id,"reward_earned"=>advertview_earn_by_package_id($advertViewerDetail[0]->package_id,$orderDetail) ,"is_clicked"=>"no","created"=>date("Y-m-d H:i:s"));
                   $this->db->insert("tbl_order_view_history",$insArray);
                   /*insert views */
                 

                   $updateCreditsRemains =  $creditsRemains - $perViewCost;
                   $updateAdArray = array("remaining_balance"=>$updateCreditsRemains);
                   $this->db->where(array("id"=>$order_id));
                   $this->db->update("tbl_orders",$updateAdArray);

                   if($updateCreditsRemains < $perViewCost){
                        $updateAdArray = array("status"=>"Completed");
                        $this->db->where(array("id"=>$order_id));
                        $this->db->update("tbl_orders",$updateAdArray);
                   } 
                }else{
                    $updateAdArray = array("status"=>"Completed");
                    $this->db->where(array("id"=>$order_id));
                    $this->db->update("tbl_orders",$updateAdArray);
                }


                /*
                $advertiserDetail  = $this->Common->_get_all_records("tbl_advertiser",array("id"=>$advertiserId));
                $walletBalance     = $advertiserDetail[0]->wallet_balance;
                if($walletBalance >= $perViewCost){
                    $walletBalance =  $walletBalance-$perViewCost;    
                }else{
                    $walletBalance =  0;
                    $updateAdArray = array("status"=>"Deleted");
                    $this->db->where(array("id"=>$order_id));
                    $this->db->update("tbl_orders",$updateAdArray);
                }
                $this->db->where(array("id"=>$advertiserId));
                $updateWallet = array("wallet_balance"=>$walletBalance);
                $this->db->update("tbl_advertiser",$updateWallet);
                */

                /*update self user wallet*/
                $viewerBalance       = $advertViewerDetail[0]->wallet_balance + advertview_earn_by_package_id($advertViewerDetail[0]->package_id,$orderDetail); 


                $this->db->where(array("id"=>$user_id));
                $updateWalletAdvertViewer = array("wallet_balance"=>$viewerBalance);
                $this->db->update("tbl_advert_viewer",$updateWalletAdvertViewer);    


                $data = $this->Common->getads($user_id,false,0);
              
                $this->Common->showArrayRespose(GLOBAL_RESULT_YES,"Success",$data,$user_id);
           }else{
            $this->Common->showArrayRespose(GLOBAL_RESULT_NO,filter_validation_errors(),$dataArray);
           }
        }else{
             $this->Common->showArrayRespose(GLOBAL_RESULT_NO,GLOBAL_VALIDATION_ERROR,$dataArray); 
        }
    }


    public function getlastestads(){
        $dataArray = array();
        if(count($_POST) > 0){
           $this->setRules("GET_LATEST_ADS");
           if($this->form_validation->run()){
                $data = array();
                $user_id = $this->input->post("user_id");
                $data = $this->Common->getads($user_id,false,0);
                $this->Common->showArrayRespose(GLOBAL_RESULT_YES,"Success",$data,$user_id);
           }else{
            $this->Common->showArrayRespose(GLOBAL_RESULT_NO,filter_validation_errors(),$dataArray);
           }
        }else{
             $this->Common->showArrayRespose(GLOBAL_RESULT_NO,GLOBAL_VALIDATION_ERROR,$dataArray); 
        }
    }

    public function getallads(){
        $dataArray = array();
        if(count($_POST) > 0){
           $this->setRules("GET_ALL_ADS");
           if($this->form_validation->run()){
                $user_id = $this->input->post("user_id");
                $start_limit = $this->input->post("start_limit");
                $dataArray = $this->Common->getmyads($user_id,true,$start_limit);
                
                $this->Common->showArrayRespose(GLOBAL_RESULT_YES,"Success",$dataArray);

           }else{
            $this->Common->showArrayRespose(GLOBAL_RESULT_NO,filter_validation_errors(),$dataArray);
           }
        }else{
             $this->Common->showArrayRespose(GLOBAL_RESULT_NO,GLOBAL_VALIDATION_ERROR,$dataArray); 
        }
    }


    public function forgotpassword(){
        $object = new stdClass();
        if(count($_POST) > 0){
            $this->setRules("FORGOT_PASSWORD");
            if($this->form_validation->run()){
                $email = $this->input->post("email");
                $where = array("email"=>$email);
                $data = $this->Common->_get_all_records("tbl_advert_viewer",$where);
                if(sizeof($data) > 0){
                     if($this->EmailTemplate->sendForgotPasswordEmail($data[0]->username,$data[0]->email,base64_decode($data[0]->enk_key))){

                        $this->Common->showObjectResponse(GLOBAL_RESULT_YES,"Your password has been sent to your email",$object);

                     }else{
                       $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"This email is not registerd with us!!",$object); 
                     }
                }else{
                    $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"This email is not registerd with us!!",$object);
                }
                
            }else{
                $this->Common->showObjectResponse(GLOBAL_RESULT_NO,filter_validation_errors(),$object);
            }
        }else{
            $this->Common->showObjectResponse(GLOBAL_RESULT_NO,GLOBAL_VALIDATION_ERROR,$object);    
        }
        
        
    
    }

   
    public function singupuser(){
        // 408600
        $object = new stdClass();
        if(count($_POST) > 0){
            $this->setRules("USER_SIGNUP");
            if($this->form_validation->run()){
                $mobile_number = $this->input->post("mobile_number");
                $username = $this->input->post("username");
                $email = $this->input->post("email");
                $password = $this->input->post("password");
                $postal_code = $this->input->post("postal_code");
                $unit_number = $this->input->post("unit_number");
                $refer_code = $this->input->post("refer_code");
                $floor_number = $this->input->post("floor_number");

                $wherePhone = array("contact_number"=>$mobile_number,"status <> "=>"Deleted");
                $whereEmail = array("email"=>$email,"status <> "=>"Deleted");

                if($this->Common->_is_record_exits("tbl_advert_viewer",$wherePhone)){
                    $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"Mobile number is already registered",$object);

                }else if($this->Common->_is_record_exits("tbl_advert_viewer",$whereEmail)){
                    $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"Email address is already registered",$object);

                }else{
                     $wherePostal  = ["postal_code"=>$postal_code];    
                     if(!$this->Common->_is_record_exits("tbl_postal_location",$wherePostal)){
                        $dataPostalCode = get_lat_long($postal_code);
                         
                        if($dataPostalCode["lat"] == 0.00 || $dataPostalCode["lng"] == 0.00){
                            $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"Sorry unable to find this postal code ",$object);
                        }    

                        $insPostal = ["lat"=>$dataPostalCode["lat"],"lng"=>$dataPostalCode["lng"],"postal_code"=>$postal_code,"created_at"=>date("Y-m-d")];
                        $this->db->insert("tbl_postal_location",$insPostal);
                     }    


                    // delete noon verified user add new register with same details
                    $whereDelete = array("contact_number"=>$mobile_number);
                    $this->db->where($whereDelete);
                    $this->db->delete("tbl_advert_viewer");
                    
                    $whereDelete = array("email"=>$email);
                    $this->db->where($whereDelete);
                    $this->db->delete("tbl_advert_viewer");
                    // delete user details 


                    $insArray = array();
                    /*
                    $result =  json_decode(getAreaDetalisByPostalCode($postal_code),true) ;
                  
                    if($result["IsSuccess"]){
                           $postalCode                      =   $result["Postcodes"];
                           $Floors                          =   $postalCode[0]["Floors"];
                           $unitArray   = array();
                           $floorArray   = array();
                           
                           for($i=0;$i<count($Floors);$i++){
                                $unitsArray = $Floors[$i]["Units"];
                                foreach ($unitsArray as $result) {
                                    array_push($unitArray, $result["UnitNumber"]);
                                }
                                array_push($floorArray,$Floors[$i]["FloorNumber"]);
                           }

                           if(in_array($unit_number,$unitArray) && in_array($floor_number,$floorArray)){
                               $insArray["latitude"]            = $postalCode[0]["Latitude"];
                               $insArray["longitude"]           = $postalCode[0]["Longitude"];
                               $insArray["is_valid_unit_code"]  = "yes";
                           }
                           
                    }
                    */    


                    $myReferCode = randomGenerateString(REFER_CODE_LENGTH);
                    $insArray["is_valid_unit_code"]  = "yes";
                    $insArray["floor_number"] = $floor_number;
                    $insArray["contact_number"] = $mobile_number;
                    $insArray["username"] = $username;
                    $insArray["email"] = $email;
                    $insArray["password"] = md5($password);
                    $insArray["enk_key"] = base64_encode($password);
                    $insArray["postal_code"] = $postal_code;
                    $insArray["unit_number"] = $unit_number;
                    $insArray["is_phone_verified"] = "No";
                    $insArray["verification_code"]          = randomGenerateNumber(4);
                    $insArray["registration_referral_code"] = $refer_code;
                    $insArray["self_referral_code"]         = $myReferCode;
                    $insArray["user_unique_code"]           = $myReferCode;
                    $insArray["package_id"]                 = "1";
                    $insArray["created"]                    = date("Y-m-d H:i:s");
                    $insArray["modified"]                   = date("Y-m-d H:i:s");
                    $insArray["status"]                     = "Deleted";
                    $insArray["seen_status"]                = "true";
                  
                    if($this->db->insert("tbl_advert_viewer",$insArray)){
                        $userId =  $this->db->insert_id();
                        
                        

                         
                         

                        /*other user refer increase*/
                        if($refer_code != ""){
                          $otherUserDetail = $this->Common->_get_all_records("tbl_advert_viewer",array("self_referral_code"=>$refer_code));
                          if(sizeof($otherUserDetail) > 0){
                            $otherUserId = $otherUserDetail[0]->id;
                            $total_refer_earn = $otherUserDetail[0]->total_refer_earn + 1;
                            $otherUpdateArray["total_refer_earn"]         = $total_refer_earn;
                            if($total_refer_earn == 5){
                                 $otherUpdateArray["package_id"]         = "2";
                            }else if($total_refer_earn == 10){
                                 $otherUpdateArray["package_id"]         = "3";
                            }
                            $this->db->where(array("id"=>$otherUserId));
                            $this->db->update("tbl_advert_viewer",$otherUpdateArray);
                          }
                        } 
                        /*other user refer increase*/
                        
                          
                        $insArraypayment = array(
                            "payment_mobile_number"=>$mobile_number,
                            "user_id"=>$userId
                        );
                        $this->db->insert("tbl_advert_viewer_bank",$insArraypayment);
                        /*update refer code*/
                        $myReferCode = $myReferCode.$userId;
                        $updateArray = array("self_referral_code"=> $myReferCode,"user_unique_code"=> $myReferCode);
                        $this->db->where(array("id"=>$userId));
                        $this->db->update("tbl_advert_viewer",$updateArray);


                       // not need to send verification email client says this  $this->EmailTemplate->sendVerificationEmailAppUser($userId,$email,$username);
                       // if($_SERVER['HTTP_HOST'] !='localhost'  && $_SERVER['HTTP_HOST'] != '192.168.43.30' ){
                            sendVerificationCode($insArray["verification_code"],$mobile_number);
                       // }

                        $object->verification_code = $insArray["verification_code"];
                        $object->user_id = $userId;
                        $this->Common->showObjectResponse(GLOBAL_RESULT_YES,"Signup successfully",$object);

                    }else{
                         $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"Something went wrong please try again later",$object); 
                    }
                }
            }else{
                $this->Common->showObjectResponse(GLOBAL_RESULT_NO,filter_validation_errors(),$object);
            }
        }else{
            $this->Common->showObjectResponse(GLOBAL_RESULT_NO,GLOBAL_VALIDATION_ERROR,$object);    
        }
    }


    public function resendotpcode(){
        $object = new stdClass();
        if(count($_POST) > 0){
            $this->setRules("RESEND_VERIFICATION_CODE");
            if($this->form_validation->run()){
                $user_id        = $this->input->post("user_id");
                $mobile         = $this->input->post("mobile");
                $whereMobile    = array("status <> "=>"Deleted","id <> "=>$user_id,"contact_number"=>$mobile);

                if($this->Common->_is_record_exits("tbl_advert_viewer",$whereMobile)){

                     $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"This mobile number is already registerd with us.",$object);
                }else{
                    $where = array("id"=>$user_id);
                    $userDetails = $this->Common->_get_all_records("tbl_advert_viewer",$where);
                    if(sizeof($userDetails) > 0){
                        $verificationCode = randomGenerateNumber(4);
                        $updateArray = array("verification_code"=>$verificationCode,"contact_number"=>$mobile);
                        
                        $this->db->where(array("id"=>$user_id));
                        $this->db->update("tbl_advert_viewer",$updateArray);


                        $object->verification_code = $verificationCode;
                        $object->user_id = $user_id;
                        sendVerificationCode($verificationCode,$mobile);
                       
                        $this->Common->showObjectResponse(GLOBAL_RESULT_YES,"Verification code sent successfully",$object);
                       
                    }else{
                        $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"Invalid user id",$object);    
                    }

                }

                
            }else{
               $this->Common->showObjectResponse(GLOBAL_RESULT_NO,filter_validation_errors(),$object); 
            }
        }else{
            $this->Common->showObjectResponse(GLOBAL_RESULT_NO,GLOBAL_VALIDATION_ERROR,$object);    
        }

    }



    public function optverification(){
        $object = new stdClass();
        if(count($_POST) > 0){
            $this->setRules("VERIFICATION_MOBILE");
            if($this->form_validation->run()){
                $user_id = $this->input->post("user_id");
                $verification_code = $this->input->post("verification_code");
                $mobile         = $this->input->post("mobile");
                $android_token  = $this->input->post("android_token");
                $ios_token      = $this->input->post("ios_token");



                $where = array("id"=>$user_id);    
                $userDetails = $this->Common->_get_all_records("tbl_advert_viewer",$where);
                if(sizeof($userDetails) > 0){
                   if($userDetails[0]->verification_code == $verification_code){
                        $updateArray = array("contact_number"=>$mobile ,"seen_status"=>"false","is_phone_verified"=>"Yes","status"=>"Approved");
                        $this->db->where(array("id"=>$user_id));

                        if($android_token != ""){
                            $updateArray["android_token"] = $android_token;
                        }
                        
                        if($ios_token != ""){
                            $updateArray["ios_token"] = $ios_token;
                        }

                        $this->db->update("tbl_advert_viewer",$updateArray);


                        $this->Common->showObjectResponse(GLOBAL_RESULT_YES,"Thank you! Your mobile number has been verified.", $this->Common->getUserDetailsById($user_id));

                       // $this->Common->showObjectResponse(GLOBAL_RESULT_YES,"Phone verification done successfully",$object);     

                   }else{
                        $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"Verification code does not match",$object);     
                   }
                }else{
                    $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"Invalid user id",$object);    
                }
            }else{
               $this->Common->showObjectResponse(GLOBAL_RESULT_NO,filter_validation_errors(),$object); 
            }
        }else{
            $this->Common->showObjectResponse(GLOBAL_RESULT_NO,GLOBAL_VALIDATION_ERROR,$object);    
        }
    }
  
    public function login(){
    	$object = new stdClass();
    	if(count($_POST) > 0){
    		$this->setRules("USER_LOGIN");
    		if($this->form_validation->run()){
    			$email 				= $this->input->post("email");
    			$password 			= $this->input->post("password");
    			$device_type 		= $this->input->post("device_type");
    			$device_token 		= $this->input->post("device_token");

    			$this->db->select("*");
    			$this->db->where("(email = '$email' OR contact_number = '$email')");
                
                $this->db->where(array("password"=>md5($password)));
    			$this->db->where(array("status <> "=>"Deleted"));


    			$viewerData = $this->db->get("tbl_advert_viewer")->result();

               
    			if(sizeof($viewerData) > 0){
    				/*
                    if($viewerData[0]->is_email_verified == "No"){

                      $this->EmailTemplate->sendVerificationEmailAppUser($viewerData[0]->id,$viewerData[0]->email,$viewerData[0]->username);
         			  $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"We hav send verfication link to your email please verify first",$object);
    				}else
                    */
                    if($viewerData[0]->status == "Pending"){
    					$this->Common->showObjectResponse(GLOBAL_RESULT_NO,"Your account not approved yet please wait",$object);
    				}else if($viewerData[0]->status == "Deleted"){
    					$this->Common->showObjectResponse(GLOBAL_RESULT_NO,"This account has been deleted",$object);
  					}else if($viewerData[0]->status == "Inactive"){
  					  	$this->Common->showObjectResponse(GLOBAL_RESULT_NO,"Your account has been blocked please contact to site administrator",$object);					
    				}else {

    					$updateArray = array("is_login"=>"Yes","last_login"=>date("Y-m-d H:i:s"),"enk_key"=>base64_encode($password),"device_type"=>$device_type);

    					if($device_type == "Android"){
    						$updateArray["android_token"] = $device_token;
    					}else if($device_type == "IOS"){
    						$updateArray["ios_token"] = $device_token;
    					}
    					$this->db->where(array("id"=>$viewerData[0]->id));
    					$this->db->update("tbl_advert_viewer",$updateArray);

    					$this->Common->showObjectResponse(GLOBAL_RESULT_YES,"success", $this->Common->getUserDetailsById($viewerData[0]->id));
    				}

    			}else{
    				$this->Common->showObjectResponse(GLOBAL_RESULT_NO,"Invalid login details",$object);	
    			}	
    		}else{
				$this->Common->showObjectResponse(GLOBAL_RESULT_NO,filter_validation_errors(),$object);	
    		}
    	}else{
    		$this->Common->showObjectResponse(GLOBAL_RESULT_NO,GLOBAL_VALIDATION_ERROR,$object);	
    	}
    }

    public function updatedevicetoken(){
    	$object = new stdClass();
    	if(count($_POST) > 0){
			$this->setRules("UPDATE_TOKEN");
			if($this->form_validation->run()){
				$userId = $this->input->post("user_id");
				$device_type = $this->input->post("device_type");
				$device_token = $this->input->post("device_token");

				$this->db->where(array("id"=>$userId));
				if($device_type == "Android"){
					$updateArray["android_token"] = $device_token;
				}else if($device_type == "IOS"){
					$updateArray["ios_token"] = $device_token;
				}
				$this->db->update("tbl_advert_viewer",$updateArray);
			}else{
				$this->Common->showObjectResponse(GLOBAL_RESULT_NO,filter_validation_errors(),$object);
			}
    	}else{
    		$this->Common->showObjectResponse(GLOBAL_RESULT_NO,GLOBAL_VALIDATION_ERROR,$object);	
    	}
    }
    
     
    public function updateuserprofile(){
        $object = new stdClass();
        if(count($_POST) > 0){
            $this->setRules("UPDATE_USER_PROFILE_BY_ID");
            if($this->form_validation->run()){
               $user_name = $this->input->post("user_name");
               $mobile = $this->input->post("mobile");
               $postal_code = $this->input->post("postal_code");
               $floor_number = $this->input->post("floor_number");
               $unit_number = $this->input->post("unit_number");
               $userId = $this->input->post("user_id");
               
               if($mobile != ""){
                    // chech already exits
                    $whereMobile = array("contact_number"=>$mobile,"id <> "=>$userId,"status <> "=>"Deleted");
                    if($this->Common->_is_record_exits("tbl_advert_viewer",$whereMobile)){
                        $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"Mobile number is already registered",$object);
                    }
               }


                $wherePostal  = ["postal_code"=>$postal_code];    
                if(!$this->Common->_is_record_exits("tbl_postal_location",$wherePostal)){
                    $dataPostalCode = get_lat_long($postal_code);
                    
                    if($dataPostalCode["lat"] == 0.00 || $dataPostalCode["lng"] == 0.00){
                        $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"Sorry unable to find this postal code ",$object);
                    }

                    $insPostal = ["lat"=>$dataPostalCode["lat"],"lng"=>$dataPostalCode["lng"],"postal_code"=>$postal_code,"created_at"=>date("Y-m-d")];
                    $this->db->insert("tbl_postal_location",$insPostal);
                }


               $where = array("id"=>$userId);
               $userDetails = $this->Common->_get_all_records("tbl_advert_viewer",$where);
               if(sizeof($userDetails) > 0){
                     $updateArray =array(
                              "username"=>$user_name,
                             // "contact_number"=>$mobile,
                              "unit_number"=>$unit_number,
                              "postal_code"=>$postal_code,
                              "is_valid_unit_code"=>"yes",
                              "floor_number"=>$floor_number
                            );

                     if($userDetails[0]->contact_number != $mobile){
                       // $updateArray["is_phone_verified"] = "No";
                        $verificationCode = randomGenerateNumber(4);
                        $updateArray["verification_code"] = $verificationCode;
                        sendVerificationCode($verificationCode,$mobile);
                     }


                    
                         

                      $insArray = array();
                      /* $result =  json_decode(getAreaDetalisByPostalCode($postal_code),true) ;
                       if($result["IsSuccess"]){
                                   $postalCode               =   $result["Postcodes"];
                                   $Floors                   =   $postalCode[0]["Floors"];
                                   
                                   $unitArray   = array();
                                   $floorArray   = array();

                                   for($i=0;$i<count($Floors);$i++){
                                        $unitsArray = $Floors[$i]["Units"];
                                        foreach ($unitsArray as $result) {
                                            array_push($unitArray, $result["UnitNumber"]);
                                        }
                                        array_push($floorArray,$Floors[$i]["FloorNumber"]);
                                   }
                                   
                                   if(in_array($unit_number,$unitArray) && in_array($floor_number,$floorArray)){
                                       $updateArray["latitude"]     = $postalCode[0]["Latitude"];
                                       $updateArray["longitude"]    = $postalCode[0]["Longitude"];
                                       $updateArray["is_valid_unit_code"]  = "yes";
                                       $this->db->where($where);
                                       $this->db->update("tbl_advert_viewer",$updateArray);
                                       $this->Common->showObjectResponse(GLOBAL_RESULT_YES,"Profile update successfully",$this->Common->getUserDetailsById($userId));
                                   }else{
                                    $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"Not a valid unit code",$object);
                                   }
                       }else{
                         $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"Not a valid unit code",$object);
                       }
                       */


                       $this->db->where($where);
                       $this->db->update("tbl_advert_viewer",$updateArray);
                       $response =  $this->Common->getUserDetailsById($userId);
                       if($userDetails[0]->contact_number != $mobile){
                        $response->is_phone_verified = "No"; 
                       }
                       $this->Common->showObjectResponse(GLOBAL_RESULT_YES,PROFILE_UPDATE_SUCCESS,$response);

               }else{
                    $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"Something went wrong please try again later.",$object);
               }
            }else{
                $this->Common->showObjectResponse(GLOBAL_RESULT_NO,filter_validation_errors(),$object);
            }
        }else{
            $this->Common->showObjectResponse(GLOBAL_RESULT_NO,GLOBAL_VALIDATION_ERROR,$object);    
        }
    }


    public function getuserprofilebyid(){
    	$object = new stdClass();
    	if(count($_POST) > 0){
    		$this->setRules("USER_PROFILE_BY_ID");
    		if($this->form_validation->run()){
    			$userId = $this->input->post("user_id");
    			$where = array("id"=>$userId);
    			if($this->Common->_is_record_exits("tbl_advert_viewer",$where)){
    				
    				$this->Common->showObjectResponse(GLOBAL_RESULT_YES,"success",$this->Common->getUserDetailsById($userId));

    			}else{
    				$this->Common->showObjectResponse(GLOBAL_RESULT_NO,"Not a valid user",$object);
    			}
    		}else{
    			$this->Common->showObjectResponse(GLOBAL_RESULT_NO,filter_validation_errors(),$object);
    		}
    	}else{
    		$this->Common->showObjectResponse(GLOBAL_RESULT_NO,GLOBAL_VALIDATION_ERROR,$object);	
    	}
    }

    public function signout(){
    	$object = new stdClass();
    	if(count($_POST) > 0){
    		$this->setRules("USER_SIGNOUT");
    		if($this->form_validation->run()){
    			$userId = $this->input->post("user_id");
    			$where = array("id"=>$userId);
    			if($this->Common->_is_record_exits("tbl_advert_viewer",$where)){
    				$this->db->where($where);
    				$updateArray = array("android_token"=>"","ios_token"=>"");
    				$this->db->update("tbl_advert_viewer",$updateArray);
    				$this->Common->showObjectResponse(GLOBAL_RESULT_YES,"success",$object);
    			
    			}else{
    				$this->Common->showObjectResponse(GLOBAL_RESULT_NO,"Not a valid user",$object);
    			}
    		}else{
    			$this->Common->showObjectResponse(GLOBAL_RESULT_NO,filter_validation_errors(),$object);
    		}
    	}else{
    		$this->Common->showObjectResponse(GLOBAL_RESULT_NO,GLOBAL_VALIDATION_ERROR,$object);	
    	}
    }

    public function getusernotification(){
		$data = array();
    	if(count($_POST) > 0){
    		$this->setRules("USER_NOTIFICATION");
    		if($this->form_validation->run()){
                $currentDate = date("Y-m-d")." 00:00:00";
                $userId = $this->input->post("user_id");
                $start_limit = $this->input->post("start_limit");
    			
                $sql = "select * from tbl_notification where (user_id = '$userId' OR user_id = '0' ) AND created >= '$currentDate' ORDER BY created DESC LIMIT ".$start_limit." , ".END_LIMIT." ";
                
                /*
                $where = array("user_id"=>$userId,"created >= "=> $currentDate);
                // $whereOr = array("user_id"=>"0");
    		    $this->db->where($where);
                $this->db->or_where($whereOr);
    			$this->db->select("*");
    			$this->db->limit(END_LIMIT,$start_limit);
                $this->db->order_by("created",'DESC');   */    

    		    $data = $this->db->query($sql)->result();
                for ($i=0; $i < count($data); $i++) { 
                    $idsArray  = explode(",", $data[$i]->seen_ids);
                    if(!in_array($userId,$idsArray)){
                        $updateId = $data[$i]->seen_ids.",".$userId;
                        $id = $data[$i]->id;
                        $sql = "update tbl_notification set seen_ids = '$updateId' where id = $id ";
                        $this->db->query($sql);
                    }    
                    
                }
                $this->Common->_update("tbl_notification",array("is_read"=>"true"),array("user_id"=>$userId));

                //$data = $this->db->get("tbl_notification")->result();
    			$this->Common->showArrayRespose(GLOBAL_RESULT_YES,"success",$data,$userId);
    		}else{
    			$this->Common->showArrayRespose(GLOBAL_RESULT_NO,filter_validation_errors(),$data);
    		}
    	}else{
    		$this->Common->showArrayRespose(GLOBAL_RESULT_NO,GLOBAL_VALIDATION_ERROR,$data);	
    	}
    }


    public function getusertranactionhistory(){
    	$data = array();
    	if(count($_POST) > 0){
    		$this->setRules("USER_TRANSACTION_HISTORY");
    		if($this->form_validation->run()){
                $filter = $this->input->post("filter");
    			if($filter == ""){
                   $filter = "id"; 
                }
                $userId = $this->input->post("user_id");
                $start_limit = $this->input->post("start_limit");
    			$where = array("user_id"=>$userId);
    			$this->db->where($where);
    			$this->db->select("*");
    			$this->db->order_by($filter,'DESC');    					
    			$this->db->limit(END_LIMIT,$start_limit);
                $data = $this->db->get("tbl_advert_viewer_withdraw")->result();


    			$this->Common->showArrayRespose(GLOBAL_RESULT_YES,"success",$data);
    		}else{
    			$this->Common->showArrayRespose(GLOBAL_RESULT_NO,filter_validation_errors(),$data);
    		}
    	}else{
    		$this->Common->showArrayRespose(GLOBAL_RESULT_NO,GLOBAL_VALIDATION_ERROR,$data);	
    	}
    }


    public function getallpackages(){
      	$this->db->select("*");
		$this->db->where(array("status"=>"Active"));
		$data = $this->db->get("tbl_package")->result();
		$this->Common->showArrayRespose(GLOBAL_RESULT_YES,"success",$data);
    }


    public function changeuserpassword(){
    	$object = new stdClass();
    	if(count($_POST) > 0){
    		$this->setRules("CHANGE_PASSWORD");
    		if($this->form_validation->run()){
    			$userId 		= $this->input->post("user_id");
    			$oldPassword 	= $this->input->post("old_password");
    			$newPassword 	= $this->input->post("new_password");

    			$where = array("id"=>$userId,"password"=>md5($oldPassword));
    			if($this->Common->_is_record_exits("tbl_advert_viewer",$where)){
    				
    				$this->db->where($where);
    				$updateArray = array("password"=>md5($newPassword),"enk_key"=>base64_encode($newPassword));
    				$this->db->update("tbl_advert_viewer",$updateArray);

    				$this->Common->showObjectResponse(GLOBAL_RESULT_YES,"Password has been changed successfully",$object);

    			}else{
    				$this->Common->showObjectResponse(GLOBAL_RESULT_NO,"Your current password is incorrect",$object);
    			}
    		}else{
    			$this->Common->showObjectResponse(GLOBAL_RESULT_NO,filter_validation_errors(),$object);
    		}
    	}else{
    		$this->Common->showObjectResponse(GLOBAL_RESULT_NO,GLOBAL_VALIDATION_ERROR,$object);	
    	}
 	}


    public function contactus(){

    	$object = new stdClass();
    	if(count($_POST) > 0){
    		$this->setRules("CONTACT_US");
    		if($this->form_validation->run()){
    			$user_id 	= $this->input->post("user_id");
    			$name 		= $this->input->post("name");
    			$subject 	= $this->input->post("subject");
    			$email 		= $this->input->post("email");
    			$message 	= $this->input->post("message");

    			$this->db->where(array("id"=>$user_id));
    			$this->db->select("*");
    			$data = $this->db->get("tbl_advert_viewer")->result();
    			$contact = $data[0]->contact_number;
    			$fname = $data[0]->fname;
    			$lname = $data[0]->lname;

    			$insArray = array("fname"=>$fname,"lname"=>$lname,"email"=>$email,"msg"=>$message,"contact_number"=>$contact);
    			if($this->db->insert("tbl_contact_form_data",$insArray)){
    				$this->Common->showObjectResponse(GLOBAL_RESULT_YES,"Your message has been sent successfully.",$object);
    			}else{
    				$this->Common->showObjectResponse(GLOBAL_RESULT_NO,"something went wrong please try again later",$object);	
    			}
    		}else{
    			$this->Common->showObjectResponse(GLOBAL_RESULT_NO,filter_validation_errors(),$object);
    		}
    	}else{
    		$this->Common->showObjectResponse(GLOBAL_RESULT_NO,GLOBAL_VALIDATION_ERROR,$object);	
    	}
    }

    public function deleteaccount(){
    	$object = new stdClass();
    	if(count($_POST) > 0){
    		$this->setRules("USER_SIGNOUT");
    		if($this->form_validation->run()){
    			$userId = $this->input->post("user_id");
    			$where = array("id"=>$userId);
    			if($this->Common->_is_record_exits("tbl_advert_viewer",$where)){
    				$this->db->where($where);
    				$updateArray = array("status"=>"Deleted");
    				$this->db->update("tbl_advert_viewer",$updateArray);
    				$this->Common->showObjectResponse(GLOBAL_RESULT_YES,"success",$object);
    			
    			}else{
    				$this->Common->showObjectResponse(GLOBAL_RESULT_NO,"Not a valid user",$object);
    			}
    		}else{
    			$this->Common->showObjectResponse(GLOBAL_RESULT_NO,filter_validation_errors(),$object);
    		}
    	}else{
    		$this->Common->showObjectResponse(GLOBAL_RESULT_NO,GLOBAL_VALIDATION_ERROR,$object);	
    	}
    }

    public function getemployementstatusandintrest(){
        $object = new stdClass();
        $dataObj = new stdClass();
        $whereAllIntrest = array("status"=>"Active");
        $allInterst = $this->Common->_get_all_records("tbl_interests",$whereAllIntrest);
       
        $whereAllEmpStatus = array("status"=>"Active");
        $allEmpStatus = $this->Common->_get_all_records("tbl_employment_status",$whereAllEmpStatus);

        $dataObj->employee_status_data =  $allEmpStatus;
        $dataObj->interest_data         =  $allInterst;

        $this->Common->showObjectResponse(GLOBAL_RESULT_YES,"success",$dataObj);
        
    }



    public function updateuserquestionary(){
        $object = new stdClass();
        if(count($_POST) > 0){
            $this->setRules("UPDATE_USER_QUESTIONATY_BY_ID");
            if($this->form_validation->run()){
                $userId                 = $this->input->post("user_id");
                $dob                    = $this->input->post("dob");
                $gender                 = $this->input->post("gender");
                $employeement_status    = $this->input->post("employeement_status");
                $marital_status         = $this->input->post("marital_status");
                $interest               = $this->input->post("interest");

                $where = array("id"=>$userId);
                $updateArray = array(
                    "date_of_birth"=>$dob ,
                    "employment_status_id"=>$employeement_status,
                    "martial_status"=>$marital_status,
                    "gender"=>$gender
                );

                $this->db->where($where);
                $this->db->update("tbl_advert_viewer",$updateArray);

                $wheredelete = array("user_id"=>$userId);
                $this->db->delete("tbl_user_interests",$wheredelete);

                $instestArray = explode("#:#", $interest);
                $flag = true;
                for ($i=0; $i < count($instestArray) ; $i++) {
                    $insArray = array("user_id"=>$userId,"interest_id"=>$instestArray[$i],"created"=>date("Y-m-d H:i:s"),"modified"=>date("Y-m-d H:i:s"));
                    if(!$this->db->insert("tbl_user_interests",$insArray)){
                        $flag = false; 
                    }
                }

                if($this->db->affected_rows() > 0 || $flag){
                     $this->Common->showObjectResponse(GLOBAL_RESULT_YES,"success", $this->Common->getUserDetailsById($userId));
                }else{
                    $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"something went wrong please try again later",$object);
                }
            }else{
                $this->Common->showObjectResponse(GLOBAL_RESULT_NO,filter_validation_errors(),$object);
            }
        }else{
            $this->Common->showObjectResponse(GLOBAL_RESULT_NO,GLOBAL_VALIDATION_ERROR,$object);    
        }
    }





    public function udpateuserbankdetails(){
        $object = new stdClass();
        if(count($_POST) > 0){
            $this->setRules("UPDATE_USER_BANK_DETAILS");
            if($this->form_validation->run()){
                $userId                    = $this->input->post("user_id");
                $account_number            = $this->input->post("account_number");
                $account_holder_name       = $this->input->post("account_holder_name");
                $bank_name                 = $this->input->post("bank_name");
                $payment_mobile_number     = $this->input->post("payment_mobile_number");
                $payment_mode              = $this->input->post("payment_mode");
              
                $where = array("user_id"=>$userId);
                $updateArray = array(
                    "account_number"=>$account_number ,
                    "account_holder_name"=>$account_holder_name,
                    "bank_name"=>$bank_name,
                    "payment_mobile_number"=>$payment_mobile_number
                );

                $this->db->where($where);
                $this->db->update("tbl_advert_viewer_bank",$updateArray);
                
                $whereadvertiser = array("id"=>$userId);
                $this->db->where($whereadvertiser);
                $this->db->update("tbl_advert_viewer",array("payment_mode"=>$payment_mode));


                $this->Common->showObjectResponse(GLOBAL_RESULT_YES,"Payment details updated successfully", $this->Common->getUserDetailsById($userId));

            }else{
                $this->Common->showObjectResponse(GLOBAL_RESULT_NO,filter_validation_errors(),$object);
            }
        }else{
            $this->Common->showObjectResponse(GLOBAL_RESULT_NO,GLOBAL_VALIDATION_ERROR,$object);    
        }
    }
    

    /*update order status cron  every hour*/
    public function updateorderstatuscron(){

         $whereOrder = array(
            "status"=>"Pending Distribution",
            "start_date <= "=> date("Y-m-d"),
            "end_date >= "=> date("Y-m-d")
        );
        $this->db->where($whereOrder);
        $updateOrderArray = array("status"=>"In Progress");
        $this->db->update("tbl_orders",$updateOrderArray);

        $whereOrder = array(
            "status "=>"In Progress",
            "end_date < "=> date("Y-m-d")
        );
        $this->db->where($whereOrder);
        $updateOrderArray = array("status"=>"Completed");
        $this->db->update("tbl_orders",$updateOrderArray);
    }
  

    /*update order status cron add 12:10*/
    public function updatecounterevent(){
        /**/
        $where = array("status"=>"Active");
        $data =  $this->Common->_get_all_records("tbl_events",$where); 
        for ($i=0; $i < count($data); $i++) { 
            if($data[$i]->start_date <= date("Y-m-d")){

               $wordArray           = str_split($data[$i]->shuffle_word);
               $visiblePositionsDb  = explode("#:#", $data[$i]->visible_positions);
               

               if(count($visiblePositionsDb) >= count($wordArray)){
                    //finish
                    $updateArray["status"] = "Inactive";
               }else{
                    $RemainPositionArray = array();
                    for ($j=0; $j < count($wordArray); $j++) { 
                        if(!in_array($j, $visiblePositionsDb)){
                            array_push($RemainPositionArray, $j);
                        }
                    }


                    $updateArray["reward_amount"] = $data[$i]->reward_amount + 10;
                    $position    = rand(0,(count($RemainPositionArray)-1));

                  

                    array_push($visiblePositionsDb, $RemainPositionArray[$position]);
                    $updateArray["visible_positions"] = implode("#:#", $visiblePositionsDb);

                    
               }
               
               $this->db->where("id",$data[$i]->id);
               $this->db->update("tbl_events",$updateArray);
            }
        }
    }
   /*update order status cron add 12:10*/


    public function getevents(){
        $data = array();
        if(count($_POST) > 0){
            $this->setRules("GET_EVENT");
            if($this->form_validation->run()){
                $user_id            = $this->input->post("user_id");
                $where = array("status"=>"Active");
                $this->db->where($where);
                $this->db->where("start_date <=",date("Y-m-d"));
                
                $data =  $this->Common->_get_all_records("tbl_events",$where); 
                foreach ($data as $result) {
                    $result->visible_positions = explode("#:#",  $result->visible_positions);
                }

                $this->Common->showObjectResponse(GLOBAL_RESULT_YES,"success",$data);    
            }else{
                $this->Common->showObjectResponse(GLOBAL_RESULT_NO,filter_validation_errors(),$data);
            }
        }else{
            $this->Common->showObjectResponse(GLOBAL_RESULT_NO,GLOBAL_VALIDATION_ERROR,$data);    
        }

    }


     public function sendeventresult(){
       $data = array();
        if(count($_POST) > 0){
            $this->setRules("SUBMIT_EVENT");
            if($this->form_validation->run()){
                $user_id            = $this->input->post("user_id");
                $event_id            = $this->input->post("event_id");
                $event_answer      = $this->input->post("event_answer");

                $where = array("id"=>$event_id,"status"=>"Active");

                  $insArray = array(
                                "user_id"=>$user_id,
                                "event_id"=>$event_id,
                                "user_answer"=>$event_answer,
                                "is_winner"=>"no",
                                "created_at"=>date("Y-m-d H:i:s"),
                            ); 


                if($this->Common->_is_record_exits("tbl_events",$where)){

                   $whereParticipate = array("user_id"=>$user_id,"event_id"=>$event_id);
                   if($this->Common->_is_record_exits("tbl_event_participaters",$whereParticipate)){
                     //$this->Common->showObjectResponse(GLOBAL_RESULT_NO,"You already participated for this event!",$data);
                        $this->Common->_delete("tbl_event_participaters", $whereParticipate);
                   }

                  /// else{



                       $data =  $this->Common->_get_all_records("tbl_events",$where); 

                       if($data[0]->winner_id != 0){
                            $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"The Cash-phrase for the day has already been guessed correctly, please come back again tomorrow!",array());
                       }


                       if(trim(strtolower($event_answer)) == trim(strtolower($data[0]->event_word))){
                            $updateArray = array("winner_id"=>$user_id);
                            $this->db->where($where);        
                            $this->db->update("tbl_events",$updateArray);
                            $data[0]->winner_id = $user_id;
                            $data[0]->visible_positions =  explode("#:#",  $data[0]->visible_positions);
                           

                            $insArray["is_winner"] = "yes";
                            /*get user details*/
                             $userData =  $this->Common->_get_all_records("tbl_advert_viewer",array("id"=>$user_id));
                             $updatedBalance = $userData[0]->wallet_balance+$data[0]->reward_amount;      
                            /*update user balance*/
                            $updateUserArray = array("wallet_balance"=>$updatedBalance);
                            $this->Common->_update("tbl_advert_viewer",$updateUserArray,array("id"=>$user_id));
                            /*update user balance*/
                            if($this->db->insert("tbl_event_participaters",$insArray)){
                                $this->Common->showObjectResponse(GLOBAL_RESULT_YES,"success",$data);
                            }else{
                                $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"Something went wrong please try again later!",array());
                            }  

                       }else{
                          if($this->db->insert("tbl_event_participaters",$insArray)){
                            $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"Your answer is incorrect. Please try again.",array());
                          }else{
                            $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"Something went wrong please try again later!",array());
                          }
                       }


                //   }

                }else{
                     $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"This event no longer active!",$data);
                }

            }else{
                $this->Common->showObjectResponse(GLOBAL_RESULT_NO,filter_validation_errors(),$data);
            }
        }else{
            $this->Common->showObjectResponse(GLOBAL_RESULT_NO,GLOBAL_VALIDATION_ERROR,$data);    
        }

    }   


    public function sendwithdrawrquest(){
       $object = new stdClass();
        if(count($_POST) > 0){
            $this->setRules("WITHDRAW_REQUEST");
            if($this->form_validation->run()){
                $userId            = $this->input->post("user_id");
                $amount            = $this->input->post("amount");
                // check user exits or not 
                $where = array("id"=>$userId);
                if($this->Common->_is_record_exits("tbl_advert_viewer",$where)){
                   $userDetailsObj = $this->Common->getUserDetailsById($userId);

                   if($userDetailsObj->is_email_verified == "Yes"){

                                if($userDetailsObj->wallet_balance >= $amount){
                                $currentBalance = $userDetailsObj->wallet_balance;
                                $updateBalance  = $currentBalance - $amount;

                                $updateArray =  array('wallet_balance' => $updateBalance);   
                                $whereUpdate =  array('id' => $userId); 
                                $this->db->where($whereUpdate);
                                $this->db->update("tbl_advert_viewer",$updateArray);
                                $userDetailsObj->wallet_balance = $updateBalance;
                               
                               /*insert notification*/
                               // $message = WIDTHDRAW_REQUEST_SEND_NOTIFCATION_MSG." ".$amount;
                               // $insNotification = array('user_id' => $userId,'title' => "Withdraw request",'msg'=>$message,'created'=>date("Y-m-d"));


                               // $this->db->insert("tbl_notification",$insNotification);  
                               // sendNotificationToUserId($userId,$message);    
                               
                                /*insert notification*/    
                                $insArray = array(
                                        "user_id"=>$userId,
                                        "user_bank_id"=>$userDetailsObj->bank_id,
                                        "amount"=>$amount,
                                        "payment_mode"=>$userDetailsObj->payment_mode,
                                        "user_bank_info"=>$userDetailsObj->bank_name,
                                        "status"=>"Requested",
                                        "created"=>date("Y-m-d H:i:s"),
                                        "modified"=>date("Y-m-d H:i:s"),
                                );   

                                if($this->db->insert("tbl_advert_viewer_withdraw",$insArray)){
                                    $this->Common->showObjectResponse(GLOBAL_RESULT_YES,"Withdraw request has been sent successfully. Once payment is successful, we will notify you through email within 3 working days.",$userDetailsObj);
                                }else{
                                    $this->Common->showObjectResponse(GLOBAL_RESULT_No,"Something went wrong please try again later",$object);
                                }
                           }else{
                              $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"Insufficient funds",$object);
                           }
                   }else{

                        $this->EmailTemplate->sendVerificationEmailAppUser($userId,$userDetailsObj->email,$userDetailsObj->username);    
                        $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"For 1st time withdrawal, an email has been sent to verify your email address.\n\nKindly click on the link in the email before returning here to cash out your money.",$object);
                   
                   }
                }else{
                     $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"Not a valid user",$object);
                }
            }else{
                $this->Common->showObjectResponse(GLOBAL_RESULT_NO,filter_validation_errors(),$object);
            }
        }else{
            $this->Common->showObjectResponse(GLOBAL_RESULT_NO,GLOBAL_VALIDATION_ERROR,$object);    
        }

    }


  function sendemailDirect(){
      $status = $this->EmailTemplate->sendVerificationEmailAppUser(60,"sandeepdcte@gmail.com","sandeep");
      var_dump( $status);
  }



			
}

/* End of file Users.php */
/* Location: ./application/controllers/api/Users.php */
