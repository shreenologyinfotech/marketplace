<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//require_once(BASEPATH.'core/MY_Controller.php');
class Ajax extends MY_Controller {
  function __construct() {
        parent::__construct();
        $this->load->Model("EmailTemplate");
  }

  function addShippingAddress(){
    $flat_house_building_company_apartment  =  $this->input->post('flat_house_building_company_apartment');
    $area_street_sector_village             =  $this->input->post('area_street_sector_village');
    $land_mark                              =  $this->input->post('land_mark');
    $country                                =  $this->input->post('country');
    $state                                  =  $this->input->post('state');
    $city                                   =  $this->input->post('city');
    $postal_code                            =  $this->input->post('postal_code');


    if($flat_house_building_company_apartment == "" || $area_street_sector_village == "" || $land_mark == "" || $country == "" || $state  == "" || $city == "" || $postal_code == ""){

        $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"Please supply all information","");  

    }else{

      $insArray = array(
        "flat_house_building_company_apartment" => $flat_house_building_company_apartment,
        "area_street_sector_village" => $area_street_sector_village,
        "land_mark" => $land_mark,
        "country_id" => $country,
        "state_id" => $state,
        "postal_code" => $postal_code,
        "town_city" => get_city_by_id($city),
        "user_id" => get_store_id(),
        "is_default" => "N",
        "create_at" => date("Y-m-d H:i:s"),
        "modified_at" => date("Y-m-d H:i:s"),
      );

      if($this->Common->_insert("tbl_address",$insArray)){
        $this->Common->showObjectResponse(GLOBAL_RESULT_YES,"Success","");
      }else{
        $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"Something went wrong please try again later","");  
      }
    }
 
  }

  function getcitybystateid() {
    $state     =  $this->input->post('state');
    $where     =  [];

    if($state != ""){
      $where   =  ["state_id"=>$state];
    }

    $cities  =  $this->Common->_get_all_records("cities",$where);
    $html    = '<option value="">Select City</option>';
    
    foreach($cities as $city) {
      $html  = $html.'<option value="'.$city->id.'">'.$city->name.'</option>';
    }
    $this->Common->showObjectResponse(GLOBAL_RESULT_YES,"Succes",$html);  
  }


  function updateuserdefaultaddress(){
    $respObj = new stdClass();
    $address_id =  $this->input->post('address_id');
    $user_id    = get_store_id();

    $where      = array("user_id"=>$user_id); 
    if($this->Common->_update("tbl_address",["is_default"=>"N"],$where)){
        $where["address_id"] = $address_id;
        if($this->Common->_update("tbl_address",["is_default"=>"Y"],$where)){
          $this->Common->showObjectResponse(GLOBAL_RESULT_YES,"Succes",$respObj);
        }
    }
    $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"Fail",$respObj);
    
  }

  function getstatesbycountry() {
    $country =  $this->input->post('country');
    $where   =  ["country_id"=>$country];
    $states  =  $this->Common->_get_all_records("states",$where);
    $html    = '<option value="">Select State</option>';

    foreach($states as $state) {
      $html  = $html.'<option value="'.$state->id.'">'.$state->name.'</option>';
    }
    $this->Common->showObjectResponse(GLOBAL_RESULT_YES,"Succes",$html);  
  }


  function subscribenewsletter(){
    $myObj               = new stdClass();
    $email_address       = $this->input->post("user_email");    
    
    $insArray            = array(
        "email_address"=>$email_address,
        "created_at"=>date("Y-m-d H:i:s"),
        "modified_at"=>date("Y-m-d H:i:s")
    );

    if($this->Common->_is_record_exits("tbl_newsletter",["email_address"=>$email_address])){

      $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"You already subscribe to newsletter",$myObj);  

    }else{

      if($this->Common->_insert("tbl_newsletter",$insArray)){
          $this->Common->showObjectResponse(GLOBAL_RESULT_YES,"Success",$myObj);  
      }else{
        $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"something went wrong please try again",$myObj);  
      }
    }

    

  }


  function sentMessageToSeller(){
    $myObj               = new stdClass();

    $product_id          = $this->input->post("product_id");    
    $message             = $this->input->post("message");    
    $first_name          = $this->input->post("first_name");
    $email_address       = $this->input->post("email_address");    
    $phone               = $this->input->post("phone");    

    $where               = array("product_id"=>$product_id);
    $productData         = $this->Common->_get_all_records("tbl_products",$where);

    if(sizeof($productData) > 0){
        $store_id       =  $productData[0]->store_id;
        
        $insArray            = array(
            "store_id"=>$store_id,
            "product_id"=>$product_id,
            "message"=>$message,
            "name"=>$first_name,
            "email_address"=>$email_address,
            "phone"=>$phone,
            "created_at"=>date("Y-m-d H:i:s"),
            "modified_at"=>date("Y-m-d H:i:s")
        );

        if($this->Common->_insert("tbl_seller_has_enquiery",$insArray)){
            $this->Common->showObjectResponse(GLOBAL_RESULT_YES,"Success",$myObj);  
        }else{
          $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"fail",$myObj);  
        }

    }else{
        $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"fail",$myObj);  
    }  

    

  }


  function removeCartItem(){
    $myObj          = new stdClass();
    $cart_id        = $this->input->post("cart_id");
    $where          = array("cart_id"=>$cart_id);

    $this->Common->_delete("tbl_user_has_cart",$where);
    $myObj = getUserBadges(true);
    $this->Common->showObjectResponse(GLOBAL_RESULT_YES,"Success",$myObj);  

  }
  
  
  function getcategorydl() {
    $myObj            = new stdClass();
    $brand_id      = $this->input->post("brand_id");
    $subCategoryData     = get_all_category_by_brand($brand_id);
    $html = '<option value="">Pick Category</option>';


    foreach ($subCategoryData as $resultObj){ 
      $html = $html.'<option value="'.$resultObj->category_id.'">'.$resultObj->category_name.'</option>';
    }

    
    $this->Common->showObjectResponse(GLOBAL_RESULT_YES,"Success",$html);  



  }


  function getsubcategorydl() {
    $myObj            = new stdClass();
    $category_id      = $this->input->post("category_id");
    $subCategoryData     = get_subcategory_by_category_id($category_id);
    $html = '<option value="">Pick Sub Category</option>';


    foreach ($subCategoryData as $resultObj){ 
      $html = $html.'<option value="'.$resultObj->sub_category_id.'">'.$resultObj->sub_category_name.'</option>';
    }

    
    $this->Common->showObjectResponse(GLOBAL_RESULT_YES,"Success",$html);  



  }

  function addToCart() {
    $flag = true;

    $myObj            = new stdClass();
    $http_user_agent  = get_user_agent();

    $product_id       = $this->input->post("product_id");
    $store_id         = $this->input->post("store_id");
    $table            = $this->input->post("table");
    $qty              = $this->input->post("qty");
    $where            = array("http_user_agent"=>$http_user_agent,"product_id"=>$product_id,"store_id"=>$store_id);

    if($this->Common->_is_record_exits($table,$where)){
        $data       = $this->Common->_get_all_records($table,$where);
        $updateQty  = $data[0]->qty + $qty;

        $updateArray = array(
            "qty"=>$updateQty,
            "modified_at"=>date("Y-m-d H:i:s"),
        );
        $updateWhere = ["cart_id"=>$data[0]->cart_id];
        $this->Common->_update($table,$updateArray,$updateWhere);
    }else{
      $cart_data       = $this->Common->_get_all_records($table,array("http_user_agent"=>$http_user_agent));

      $insArray = array(
              "product_id"=>$product_id,
              "store_id"=>$store_id,
              "var_percentage"=>vat_percentage_by_product_id($product_id),
              "qty"=>$qty,
              "http_user_agent"=>$http_user_agent,
              "created_at"=>date("Y-m-d H:i:s"),
              "modified_at"=>date("Y-m-d H:i:s"),
              "status"=>"A"
          );



      if(sizeof($cart_data)>0){
        if($cart_data[0]->store_id == $store_id){
            $this->Common->_insert($table,$insArray); 
        }else{
            $myObj = getUserBadges(true);
            $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"Another store product already exists in your cart",$myObj);        
        }
      }else{
          $this->Common->_insert($table,$insArray);
      }
    }

    $myObj = getUserBadges(true);
    $this->Common->showObjectResponse(GLOBAL_RESULT_YES,"Success",$myObj);  
    

  }



  function addCartAndWishList() {
    $myObj            = new stdClass();
    $http_user_agent  = get_user_agent();

    $product_id       = $this->input->post("product_id");
    $table            = $this->input->post("table");
    $where            = array("http_user_agent"=>$http_user_agent,"product_id"=>$product_id);
    //get_user_agent()


    if($this->Common->_is_record_exits($table,$where)){
      if($table == "tbl_user_has_wishlist"){

        if($this->Common->_delete($table,$where) == "1"){
          $myObj = getUserBadges(true);
          $this->Common->showObjectResponse(GLOBAL_RESULT_YES,"remove",$myObj);  
          die;
        }
      }

    }else{
      $insArray = array(
          "product_id"=>$product_id,
          "http_user_agent"=>$http_user_agent,
          "created_at"=>date("Y-m-d H:i:s"),
          "modified_at"=>date("Y-m-d H:i:s"),
          "status"=>"A"
      );
      $this->Common->_insert($table,$insArray);
    }

    $myObj = getUserBadges(true);
    $this->Common->showObjectResponse(GLOBAL_RESULT_YES,"Success",$myObj);  


  }


  function getUserBadges() {
     getUserBadges();
  }

 


  function getsubcategory(){
    $html              = '<option value="">Select Sub Category</option>';  
    $object            = new stdClass();
    $category_id       = $this->input->post("category_id");
    $where             = ["category_id"=>$category_id,"is_active"=>"Active"];
    $data              = $this->Common->get_all_record("tbl_product_sub_category",$where);


    foreach($data  as $result){
      $html            = $html.'<option value="'.$result->sub_category_id.'">'.$result->sub_category_name.'</option>';  
    }
    $object->data      = $html;

    $this->Common->showObjectResponse(GLOBAL_RESULT_YES,"Success",$object);

  }  



  function updatestore(){
     $object = new stdClass();

     if(count($_POST) > 0){
        $store_name       = $this->input->post("store_name");
        $old_password     = $this->input->post("old_password");
        $new_password     = $this->input->post("new_password");

        $owner_first_name = $this->input->post("owner_first_name");
        $owner_last_name  = $this->input->post("owner_last_name");
        $owner_dob        = $this->input->post("owner_dob");
        $unit_level       = $this->input->post("unit_level");
        $city             = $this->input->post("city");
        $region           = $this->input->post("region");
        $post_code        = $this->input->post("post_code");
        $country          = $this->input->post("country");
        $store_email      = $this->input->post("store_email");
        $store_mobile     = $this->input->post("store_mobile");
        $vat_number     = $this->input->post("vat_number");
        
        $store_id         = get_store_id();
        $updateWhere      = ["store_id"=>$store_id];

        $whereName        = ["store_id <> "=>$store_id,"store_name"=>$store_name];  
        $whereEmail       = ["store_id <> "=>$store_id,"store_email"=>$store_email];  
        $wherePhone       = ["store_id <> "=>$store_id,"store_mobile"=>$store_mobile];  
        $wherePassword    = ["store_id"=>$store_id,"password"=>md5($old_password)];  


        if($this->Common->_is_record_exits("tbl_stores",$whereEmail)){
          $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"<p class='alert alert-danger'>This email is already registered with us.</p>",$object);

        }else if($this->Common->_is_record_exits("tbl_stores",$whereName)){
          $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"<p class='alert alert-danger'>This user name is already registered with us.</p>",$object);

        }else if($this->Common->_is_record_exits("tbl_stores",$wherePhone)){
          $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"<p class='alert alert-danger'>This mobile is already registered with us.</p>",$object);

        }else{

            $insArray  = array(
              'store_mobile' => $store_mobile, 
              'store_email' => $store_email, 
              'store_name'  => $store_name, 
              'owner_first_name'  => $owner_first_name, 
              'owner_last_name'  => $owner_last_name, 
              'owner_dob'  => $owner_dob, 
              'unit_level'  => $unit_level, 
              'city'  => $city, 
              'region'  => $region, 
              'post_code'  => $post_code, 
              'country'  => $country, 
              'vat_number'  => $vat_number, 
              'modified_at' => date("Y-m-d H:i:s") 
            );


            if($old_password != ""){
              if($this->Common->_is_record_exits("tbl_stores",$wherePassword)){
                $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"<p class='alert alert-danger'>Invaoid current password.</p>",$object);
              }else{
                  if($old_password != "" && $new_password != "" ){
                      $insArray["password"] = md5($new_password);
                      $insArray["enk_key"] = base64_encode($new_password);
                  }

              }
            }

            if($this->Common->_update("tbl_stores",$insArray,$updateWhere)){
              $this->Common->showObjectResponse(GLOBAL_RESULT_YES,"<p class='alert alert-success'>Success</p>",$object);
            }else{
               $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"<p class='alert alert-danger'>Something went wrong please try again later</p>",$object);
                
            }
        }
            
      }else{
        $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"<p class='alert alert-danger'>Something went wrong please try again later</p>",$object);
      }



  }  
    

  function updatepassoworduser(){
     $object = new stdClass();

     if(count($_POST) > 0){
        $old_password   = $this->input->post("old_password");
        $user_password  = $this->input->post("user_password");
        $store_id       = $this->input->post("store_id");

        $wherePassword     = ["store_id"=>$store_id,"password"=>md5($old_password)];
        
        

        if($this->Common->_is_record_exits("tbl_stores",$wherePassword)){
            $insArray  = array(
              'password'    => md5($user_password), 
              'enk_key'    => base64_encode($user_password), 
              'modified_at' => date("Y-m-d H:i:s") 
            ); 

            if($this->Common->_update("tbl_stores",$insArray,["store_id"=>$store_id])){
                $this->Common->showObjectResponse(GLOBAL_RESULT_YES,"<p class='alert alert-success'>Success</p>",$object);
              }else{
                $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"<p class='alert alert-danger'>Something went wrong please try again later</p>",$object);
              }
              

        }else{

            $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"<p class='alert alert-danger'>invalid old password.</p>",$object);
            
        }  
            
      }else{
        $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"<p class='alert alert-danger'>Something went wrong please try again later</p>",$object);
      }


  }

  function signupstore(){
      $object = new stdClass();

      if(count($_POST) > 0){
        $user_name      = $this->input->post("user_name");
        $user_email     = $this->input->post("user_email");
        $user_password  = $this->input->post("user_password");

        $last_name      = $this->input->post("last_name");
        $store_mobile   = $this->input->post("store_mobile");
        $street_number   = $this->input->post("street_number");
        $city           = $this->input->post("city");
        $address        = $this->input->post("address");
        $cp             = $this->input->post("cp");
        $store_id       = $this->input->post("store_id");
        $country        = $this->input->post("country");
        $state          = $this->input->post("state");
        $vat_number     = $this->input->post("vat_number");
        
        if(!isset($vat_number)){
           // $vat_number = "";
        }
        if($vat_number != ""){
          $vat_verified     = 'N';  
        }
        

        $whereEmail     = ["store_email"=>$user_email,"user_type"=>"U"];
        if($store_id != ""){
          $whereEmail["store_id <>"] = $store_id;
        }

        if($store_mobile != ""){
          $whereMobile    = ["street_number"=>$store_mobile,"user_type"=>"U"];
        }else{
          $whereMobile    = [];
        }

        if($store_id != ""){
          $whereMobile["store_id <>"] = $store_id;
        }
        

        if($this->Common->_is_record_exits("tbl_stores",$whereEmail)){
          $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"<p class='alert alert-danger'>This email is already registered with us.</p>",$object);

        }else if($this->Common->_is_record_exits("tbl_stores",$whereMobile)){
          $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"<p class='alert alert-danger'>This mobile number is already registered with us.</p>",$object);

        }else{

            $insArray  = array(
              'store_email' => $user_email, 
              'owner_first_name' => $user_name, 
              'owner_last_name' => $last_name, 
              'store_mobile' => $store_mobile, 
              'street_number' => $street_number, 
              'country' => $country, 
              'state' => $state, 
              'city' => $city, 
              'address' => $address, 
              'cp' => $cp, 
              /*'vat_number' => $vat_number, 
              'vat_verified' => $vat_verified, */
              'password'    => md5($user_password), 
              'enk_key'    => base64_encode($user_password), 
              'modified_at' => date("Y-m-d H:i:s") 
            ); 

            if($store_id != ""){


              if($this->Common->_update("tbl_stores",$insArray,["store_id"=>$store_id])){
                $this->Common->showObjectResponse(GLOBAL_RESULT_YES,"<p class='alert alert-success'>Success</p>",$object);
              }else{
                $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"<p class='alert alert-danger'>Something went wrong please try again later</p>",$object);
              }


            }else{
              $insArray["created_at"] = date("Y-m-d H:i:s");

              if($this->Common->_insert("tbl_stores",$insArray)){

                  /*add default address*/
                  $insAddress = [
                    "user_id"=>$this->db->insert_id(),
                    "flat_house_building_company_apartment"=>$street_number,
                    "area_street_sector_village"=>$street_number,
                    "land_mark"=>"",
                    "town_city"=>get_city_by_id($city),
                    "is_default"=>"Y",
                    "country_id"=>$country,
                    "state_id"=>$state,
                    "create_at"=>date("Y-m-d H:i:s"),
                    "modified_at"=>date("Y-m-d H:i:s"),
                  ];
                  $this->Common->_insert("tbl_address",$insAddress);
                  
                  /*add default address*/
                 $this->Common->showObjectResponse(GLOBAL_RESULT_YES,"<p class='alert alert-success'>Success</p>",$object);
              }else{
                $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"<p class='alert alert-danger'>Something went wrong please try again later</p>",$object);
              }

            }

            
        }  
            
      }else{
        $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"<p class='alert alert-danger'>Something went wrong please try again later</p>",$object);
      }
  }
 function signupvatchange(){
      $object = new stdClass();

      if(count($_POST) > 0){
        
        $user_email     = $this->input->post("user_email");
        $vat_number     = $this->input->post("vat_number");
        $store_id       = $this->input->post("store_id");
        $vat_verified     = 'N';

        $whereEmail     = ["store_email"=>$user_email,"user_type"=>"U"];

        if($store_id != ""){
          $whereEmail["store_id <>"] = $store_id;
        }

        if($store_id != ""){
          $whereMobile["store_id <>"] = $store_id;
        }
        

        if($this->Common->_is_record_exits("tbl_stores",$whereEmail)){
          $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"<p class='alert alert-danger'>This email is already registered with us.</p>",$object);

        }else{

            $insArray  = array(
              'vat_number' => $vat_number, 
              'vat_verified' => $vat_verified,
              'modified_at' => date("Y-m-d H:i:s") 
            ); 

            if($store_id != ""){


              if($this->Common->_update("tbl_stores",$insArray,["store_id"=>$store_id])){
                $this->Common->showObjectResponse(GLOBAL_RESULT_YES,"<p class='alert alert-success'>Success</p>",$object);
              }else{
                $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"<p class='alert alert-danger'>Something went wrong please try again later</p>",$object);
              }


            }

            
        }  
            
      }else{
        $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"<p class='alert alert-danger'>Something went wrong please try again later</p>",$object);
      }
  }

  function loginstore(){
      $object = new stdClass();

      if(count($_POST) > 0){
          $store_name = $this->input->post("store_name");
          $password   = $this->input->post("password");
          $user_type   = $this->input->post("user_type");

          if($user_type == "sell"){
            $user_type   = "S";
          }else{
             $user_type   = "U";
          }

          $this->db->select("*");
          $this->db->where("(store_email = '$store_name' OR store_name = '$store_name')");
          $this->db->where(array("password"=>md5($password)));
          $this->db->where(array("user_type"=>$user_type));

          $storeData = $this->db->get("tbl_stores")->result();
          if(sizeof($storeData) > 0){
            
            if($storeData[0]->status == "D"){
                $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"<p class='alert alert-danger'>Your account has been deleted. Please contact admin</p>",$object);
            }else if($storeData[0]->status == "I"){
              $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"<p class='alert alert-danger'>Your account not approved yet please wait</p>",$object);
            }else{
              $this->session->set_userdata(FRONT_USER_ID,$storeData[0]->store_id);
              $object = $storeData[0];
              $this->Common->showObjectResponse(GLOBAL_RESULT_YES,"<p class='alert alert-success'>Success</p>",$object);
              
            }
          }else{
            $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"<p class='alert alert-danger'>Invalid Details</p>",$object);
          }
      }else{
        $this->Common->showObjectResponse(GLOBAL_RESULT_NO,"<p class='alert alert-danger'>Something went wrong please try again later</p>",$object);
      }
  }

  


  function updateHomeStatus(){
          $table            = $this->input->post("table");
          $visible_to_home  = $this->input->post("visible_to_home");
          $id_key           = $this->input->post("id_key"); 
          $id_value         = $this->input->post("id_value"); 

          $udpateArray = ["visible_to_home"=>$visible_to_home];
          $where = [$id_key=>$id_value];
          $this->Common->_update($table,$udpateArray,$where);
          
          die;
   }


    

  function updatestatus(){
        $table  = $this->uri->segment(3);
        $status = $this->uri->segment(4);
        $id     = $this->uri->segment(5);
        if($table != "" && $status != ""  && $id != "" ){
            $udpateArray = ["modified_at"=>date("Y-m-d H:i:s")];
            

            if($table == "tbl_banner"){
                $udpateArray["is_active"]    = $status;
                $where = ["banner_id"=>$id];
            }else if($table == "tbl_product_sub_category"){
                $udpateArray["is_active"]    = $status;
                $where = ["sub_category_id"=>$id];
            }else if($table ==  "tbl_product_category"){
                $udpateArray["is_active"]    = $status;
                $where = ["category_id"=>$id];
            }else if($table ==  "tbl_users"){
                $udpateArray["status"]    = $status;
                $where = ["user_id"=>$id];
            }else if($table ==  "tbl_home_category"){
                $udpateArray["is_active"]    = $status;
                $where = ["category_id"=>$id];
            }else if($table ==  "tbl_brands"){
                $udpateArray["is_active"]    = $status;
                $where = ["brand_id"=>$id];
            }else if($table ==  "tbl_products"){
                $udpateArray["is_active"]    = $status;
                $where = ["product_id"=>$id];
            }else if($table ==  "tbl_order"){
                $udpateArray["status"]    = $status;
                $where = ["order_id"=>$id];
            }else if($table ==  "tbl_address"){
                $udpateArray["status"]    = $status;
                $where = ["address_id"=>$id];
            }else{
                 echo "NO";die;
            }
            

            if($status == "D"){
                if($this->Common-> _delete($table, $where)){
                  echo "YES";
                }else{
                  echo "NO";
                }
            }else{
                if($this->Common-> _update($table, $udpateArray, $where)){
                  echo "YES";
                }else{
                  echo "NO";
                }  
            }

            
        }else{
            echo "NO";
        }
        die;
   }


    function removeorderimage(){
       if(count($_POST) > 0){
            $orderId     =  $this->input->post("order_id");       
            $imageName   =  $this->input->post("image_name");

            // order details
            $whereOrder   = array("tbl_orders.id"=>$orderId); 
            $orderDetail  = $this->Common->_get_all_records("tbl_orders",$whereOrder);
            $newArray     = array();

            if(sizeof($orderDetail) > 0){
                $deleteImage     = array();
                
                $imageData = json_decode($orderDetail[0]->delete_images,true);
                if(is_array($imageData)){
                  foreach ($imageData as $result) {
                    array_push($deleteImage, $result);           
                   }

                   if(!in_array($imageName, $deleteImage)){
                         array_push($deleteImage, $imageName); 
                   }
                }else{
                    array_push($deleteImage, $imageName); 
                }
                
                $updateArray = array("delete_images"=>json_encode($deleteImage));
                if($this->Common->_update("tbl_orders", $updateArray, $whereOrder)){
                    echo "YES";
                }else{
                    echo "NO";
                }



                /*
                $imageData = json_decode($orderDetail[0]->image_path,true);
                foreach ($imageData as $result) {
                    if($result == $imageName){
                        continue;
                    }
                    array_push($newArray, $result);           
                }
                $updateArray = array("image_path_thumb"=>json_encode($newArray),"image_path"=>json_encode($newArray));
                if($this->Common->_update("tbl_orders", $updateArray, $whereOrder)){
                    echo "YES";
                }else{
                    echo "NO";
                }
                */


                 
            }else{
              echo "NO";
            }
       }else{
           echo "NO";       
       } 
       exit();
    }



    function isvalidpostalcode(){
      $postal_code = $this->input->post("postal_code");
       $wherePostal  = ["postal_code"=>$postal_code];    
       if(!$this->Common->_is_record_exits("tbl_postal_location",$wherePostal)){
            $dataPostalCode = get_lat_long($postal_code);
            if($dataPostalCode["lat"] == 0.00 || $dataPostalCode["lng"] == 0.00){
                echo "NO";
                exit();
            }

            $insPostal = ["lat"=>$dataPostalCode["lat"],"lng"=>$dataPostalCode["lng"],"postal_code"=>$postal_code,"created_at"=>date("Y-m-d")];
            $this->db->insert("tbl_postal_location",$insPostal);
            echo "YES";
            exit();
       }else{
            echo "YES";
            exit();       
       }
        
    }



    function refundrequestbyorderid(){
         $orderId = $this->uri->segment(2);
        

         $whereOrder   = array("tbl_orders.id"=>$orderId); 
         if($this->Common->_is_record_exits("tbl_orders",$whereOrder)){

            $orderData = $this->Common->getOrderDetails("tbl_orders",$whereOrder);

            $updateArray = array("status"=>"Refund Requested"); 
            if($this->Common->_update("tbl_orders",$updateArray,$whereOrder)){
                   $details = ORDER_CANCEL_INITIATED_REFUND_REQUEST_DESCRIPTION; 
                   if($orderData[0]->status == "Completed"){
                    $details = ORDER_COMPLETE_INITIATED_REFUND_REQUEST_DESCRIPTION;
                   }
                   

                   $insArray = array(
                      "user_id"         => $this->Common->get_advertiser_id(),
                      "order_id"        => $orderId,
                      "refunded_amount" => $orderData[0]->remaining_balance,
                      "details"         => $details, 
                      "status"          => "requested", 
                      "initate_from"    => "self"
                    );

                    if($this->db->insert("tbl_advertiser_orders_refund",$insArray)){
                        echo "YES";
                    }else{
                        echo "NO";    
                    }
            }else{
                echo "NO";     
            }
         }else{
            echo "NO";
         }
         exit();

    }


    function getseencount(){
        $advertiserCount =  $this->Common->getSeenCount("tbl_advertiser");   
        $userCount       =  $this->Common->getSeenCount("tbl_advert_viewer");   
        $orderCount      =  $this->Common->getSeenCount("tbl_orders");   
        $widthdrawCount  =  $this->Common->getSeenCount("tbl_advert_viewer_withdraw");   
        $orderRefundCount  =  $this->Common->getSeenCount("tbl_advertiser_orders_refund");   
        $contactCount      =  $this->Common->getSeenCount("tbl_contact_form_data");   

        $myObj = new stdClass(); 
        $myObj->advertiserCount = $advertiserCount;
        $myObj->userCount = $userCount;
        $myObj->orderCount = $orderCount;
        $myObj->widthdrawCount = $widthdrawCount;
        $myObj->orderRefundCount = $orderRefundCount;
        $myObj->contactCount = $contactCount;
        
        echo json_encode(array("RESULT"=>"YES","Data"=>$myObj));
        exit();

    }


    function sendOrderStatusEmail($advertiserId){
        $where = array("id"=>$advertiserId);
        $adveritserData = $this->_get_all_records("tbl_advertiser",$where);
    }


    /*here comes*/
    function activelocation(){
        $orderId = $this->uri->segment(3);
        $this->db->where(array("id"=>$orderId));
        $updateArray = array("status"=>"Active");
        $this->db->update("tbl_advert_location",$updateArray);
        if($this->db->affected_rows() > 0){
            echo "YES";
        }else{
            echo "NO";
        }
    }



    



    function deactivelocation(){
        $orderId = $this->uri->segment(3);
        $this->db->where(array("id"=>$orderId));
        $updateArray = array("status"=>"Inactive");
        $this->db->update("tbl_advert_location",$updateArray);
        if($this->db->affected_rows() > 0){
            echo "YES";
        }else{
            echo "NO";
        }
    }



     function updatewidthdrawstatus(){
        $Id     = $this->uri->segment(3);
        $status = $this->uri->segment(4);
        $where  = array("id"=>$Id);
        $this->db->where($where);
        $updateArray = array("status"=>$status);
        if($status == "Paid"){
             $updateArray["withdraw_process_date"] = date("Y-m-d H:i:s");
        }
        $this->db->update("tbl_advert_viewer_withdraw",$updateArray);
        



        /*insert notification*/
        $widthDrawData = $this->Common->_get_all_records("tbl_advert_viewer_withdraw",$where);
        if(sizeof($widthDrawData) > 0){
            $message =  WITHDRAW_STATUS_UDPATE_NOTIFICATION_MSG.strtolower($status);
            $insArray = array(
                "title"=>WITHDRAW_STATUS_UDPATE_NOTIFICATION_TITLE,
                "msg"=>$message,
                "user_id"=>$widthDrawData[0]->user_id
            );
            $this->db->insert("tbl_notification",$insArray);



            $userId             =  $widthDrawData[0]->user_id;
            $adveretViewerData  = $this->Common->_get_all_records("tbl_advert_viewer",array("id"=>$userId));
            if(sizeof($adveretViewerData)>0){
               
                 if($status == "Cancelled"){
                     $updateBalance =  $adveretViewerData[0]->wallet_balance + $widthDrawData[0]->amount;
                     $this->db->where(array("id"=>$userId));
                     $updateArray = array("wallet_balance"=>$updateBalance);
                     $this->db->update("tbl_advert_viewer",$updateArray);
                 }
               sendNotificationToUserId($userId,$message);


               if($status == "Paid"){
                    $this->EmailTemplate->sendWithdrawStatusPaidMail($adveretViewerData[0]->username,$adveretViewerData[0]->email);
               }else if($status == "Cancelled"){
                  $this->EmailTemplate->sendWithdrawStatusCancelMail($adveretViewerData[0]->username,$adveretViewerData[0]->email);

               }else{
                    $this->EmailTemplate->sendWithdrawStatusApporveMail($adveretViewerData[0]->username,$adveretViewerData[0]->email);
                    
               }

                
               
            }    
        }

        /*insert notification*/
        
        if($this->db->affected_rows() > 0){
            echo "YES";
        }else{
            echo "NO";
        }
    }



    function getpinbyarea(){
      $fineArray = array();
      if(count($_POST) > 0){
       $area_id = $_POST["area_id"];
       //$this->Common->ajaxPostalByAreaId($area_id);
       $where = array("tbl_zipcode.area_id"=>$area_id);
       $zipCodes = $this->Common->getAllZipCodes('',$where);
       $response = "";
       for ($i=0; $i < count($zipCodes); $i++) {
            $zipname = $zipCodes[$i]->zip_code." (".$zipCodes[$i]->area_name.") ";
            $value   = $zipCodes[$i]->zip_code;;
            $response.= '<label class="checkbox-inline">
                            <input name="checkZipRadius[]" style="margin:10px;" type="checkbox" value="'.$value.'">'.$zipname.'
                        </label>';
       }
       echo $response;
       exit;


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

    /*order ajax calls*/
    function approveOrder(){
        $orderId    = $this->uri->segment(3);
        $whereOrder = array("id"=>$orderId);
       
        $updateArray = array("status"=>"Pending Distribution");
        //get order details 
        $orderDetails = $this->Common->_get_all_records("tbl_orders",$whereOrder);
        
        if(count($orderDetails) > 0){
            if($orderDetails[0]->start_date <= date("Y-m-d")){
                $updateArray = array("status"=>"In Progress");
            }
        }
         $this->db->where($whereOrder);
        $this->db->update("tbl_orders",$updateArray);


        if($this->db->affected_rows() > 0){
            $dataOrder = $this->Common->getRecordById("tbl_orders",$whereOrder);
            $whereUser = array("id"=>$dataOrder[0]->user_id); 
            $dataUser  = $this->Common->getRecordById("tbl_advertiser",$whereUser);
            if(sizeof($dataUser) > 0){

               if($orderDetails[0]->start_date <= date("Y-m-d")){
                  sendNewAdsNotification($orderId,$dataOrder[0]->order_type);
               }
               
               $this->EmailTemplate->sendOrderStatusChangeMail($orderId,$dataUser[0]->fname,"Approved",$dataUser[0]->email);  
            }
            echo "YES";
        }else{
            echo "NO";
        }
    }


    function deleteorder(){
        $orderId = $this->uri->segment(3);
        $whereOrder =  array("id"=>$orderId);
        $this->db->where($whereOrder);
        $updateArray = array("status"=>"Deleted");
        $this->db->update("tbl_orders",$updateArray);
        if($this->db->affected_rows() > 0){

            $dataOrder = $this->Common->getRecordById("tbl_orders",$whereOrder);
            $whereUser = array("id"=>$dataOrder[0]->user_id); 
            $dataUser  = $this->Common->getRecordById("tbl_orders",$whereOrder);
            $this->EmailTemplate->sendOrderStatusChangeMail($orderId,$dataUser[0]->fname,"Deleted",$dataUser[0]->email);  

            echo "YES";
        }else{
            echo "NO";
        }
    }



    function completerefund(){
        $refundId = $this->uri->segment(3);
        complete_refund_by_refund_id($refundId);
        echo "YES";
        
    }


    



    function cancelorder(){
        $orderId = $this->uri->segment(3);
        $where = array("id"=>$orderId);
        $this->db->where($where);


        $updateArray = array("status"=>"Refund Requested");
        $this->db->update("tbl_orders",$updateArray);
        if($this->db->affected_rows() > 0){
            $orderDetails = $this->Common->_get_all_records("tbl_orders",$where);
            $insArray = array(
                "user_id"         => $orderDetails[0]->user_id,
                "order_id"        => $orderId,
                "refunded_amount" => $orderDetails[0]->remaining_balance,
                "details"         => ORDER_CANCELLED_BY_ADMIN, 
                "status"          => "requested", 
                "initate_from"    => "admin"
            );
            $this->db->insert("tbl_advertiser_orders_refund",$insArray);
            
            $where = array("id"=>$orderDetails[0]->user_id);
            /*
            $userDetails    = $this->Common->_get_all_records("tbl_advertiser",$where);
            $updateBalance  = $userDetails[0]->wallet_balance + $orderDetails[0]->remaining_balance;

            $this->db->where($where);
            $updateArray = array("wallet_balance"=>$updateBalance);
            $this->db->update("tbl_advertiser",$updateArray);
            */

            $whereUser = array("id"=>$orderDetails[0]->user_id); 
            $dataUser  = $this->Common->getRecordById("tbl_advertiser",$whereUser);
            $this->EmailTemplate->orderCancelledByAdmin($orderId,$dataUser[0]->fname,"Cancelled",$dataUser[0]->email);  


            echo "YES";
        }else{
            echo "NO";
        }
    }


    function acceptcancelrequest(){
        $orderId    = $this->uri->segment(3);
        $whereOrder =  array("id"=>$orderId);
        $this->db->where($whereOrder);
        $updateArray = array("status"=>"Cancelled Order");
        $this->db->update("tbl_orders",$updateArray);
        if($this->db->affected_rows() > 0){

            $dataOrder = $this->Common->getRecordById("tbl_orders",$whereOrder);
            $whereUser = array("id"=>$dataOrder[0]->user_id); 
            $dataUser  = $this->Common->getRecordById("tbl_advertiser",$whereUser);
            $this->EmailTemplate->sendOrderStatusChangeMail($orderId,$dataUser[0]->fname,"Cancel Request Accepted by Admin",$dataUser[0]->email);  

            echo "YES";
        }else{
            echo "NO";
        }
    }



    function getallzipcodes(){
       $search = $_POST["search"]; 
       $zipCodes = $this->Common->getAllZipCodes($search);
       $response = "";
       for ($i=0; $i < count($zipCodes); $i++) {
            $zipname = $zipCodes[$i]->zip_code." (".$zipCodes[$i]->area_name.") ";
            $value   = $zipCodes[$i]->zip_code;;
            $response.= '<label class="checkbox-inline">
                            <input type="checkbox" value="'.$value.'">'.$zipname.'
                        </label>';
       }
       echo $response;
       exit;
    }
    /*order ajax calls*/


    
}
