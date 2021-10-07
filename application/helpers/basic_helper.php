<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


if(!function_exists('product_sku_by_id')){
    function product_sku_by_id($product_id){
       $ciObj =& get_instance();
       $data = $ciObj->Common->_get_all_records("tbl_products",["product_id"=>$product_id]); 
       if(sizeof($data) >0){
            return $data[0]->sku;
       }
       return "";
       
    }   
}



if(!function_exists('get_search_banner')){
    function get_search_banner($position=0){
       $ciObj =& get_instance();
       if($position == 0){
        $data = $ciObj->Common->_get_all_records("tbl_banner",["is_search_category"=>"Y"]); 
       }else{        
        $data = $ciObj->Common->_get_all_records("tbl_banner",["is_search_category"=>"Y","slider_banner"=>$position]); 
       }
       return base_url().IMAGE_PATH_URL.BANNER_FOLDER.$data[0]->banner_image;
    }   
}



if(!function_exists('is_eligible_for_shipping')){
    function is_eligible_for_shipping($store_id,$amount){
       $ciObj =& get_instance();
       $data = $ciObj->Common->_get_all_records("tbl_stores",["store_id"=>$store_id]); 
       $freeShippingMax = $data[0]->free_delivery_after_payment;
       if($freeShippingMax <= $amount){
        return true;
       }
       return false;
    }   
}


if(!function_exists('get_all_brands_with_counter')){
    function get_all_brands_with_counter(){
       $ciObj   =& get_instance();
       $sql     = "select * from tbl_brands where is_active = 'Active' ORDER BY brand_name ";
       $data    = $ciObj->Common->get_all_record_custom($sql); 

       foreach($data as $categoryObj){
            $brand_id = $categoryObj->brand_id;
            $sql        = "select count(*) as total_count from tbl_products where brand_id = '$brand_id'";    
            $dataProd   = $ciObj->Common->get_all_record_custom($sql);
            $categoryObj->number = "0";
            if(sizeof($dataProd) > 0){
                $categoryObj->number = $dataProd[0]->total_count;
            }
       }
       return $data;
    }   
}


if(!function_exists('get_all_category_by_brand')){
    function get_all_category_by_brand($brand_id = ""){
       $ciObj =& get_instance();

       $sql = "select * from tbl_home_category where is_active = 'Active'  ";
       $sql = $sql." AND brand_id = '$brand_id' "; 
      

       $sql = $sql." ORDER BY category_id DESC";
       $data   = $ciObj->Common->get_all_record_custom($sql);
       
       return $data;
    }   
}



if(!function_exists('get_all_category_with_counter')){
    function get_all_category_with_counter($brand_id = ""){
       $ciObj =& get_instance();

       $sql = "select * from tbl_home_category where is_active = 'Active'  ";
       if($brand_id != "0" && $brand_id != ""){
        $sql = $sql." AND brand_id = '$brand_id' "; 
       }

       $sql = $sql." ORDER BY category_name ";
       $data   = $ciObj->Common->get_all_record_custom($sql);


       foreach($data as $categoryObj){
            $categoryId = $categoryObj->category_id;
            $sql        = "select count(*) as total_count from tbl_products where category_id = '$categoryId' ";    
            $dataProd   = $ciObj->Common->get_all_record_custom($sql);
            $categoryObj->number = "0";
            if(sizeof($dataProd) > 0){
                $categoryObj->number = $dataProd[0]->total_count;
            }
       }
       return $data;
    }   
}



if(!function_exists('get_all_sub_category_with_counter')){
    function get_all_sub_category_with_counter($category_id = ""){
       $ciObj =& get_instance();

       $sql = "select * from tbl_product_sub_category where is_active = 'Active'  ";
       if($category_id != "0" && $category_id != ""){
        $sql = $sql." AND category_id = '$category_id' "; 
        $sql = $sql." ORDER BY sub_category_name";
       }else{
        $sql = $sql." ORDER BY sub_category_name";
        $sql = $sql." LIMIT 0 , 15";
       }

       

       $data   = $ciObj->Common->get_all_record_custom($sql);


       foreach($data as $subcategoryObj){
            $subcategoryId = $subcategoryObj->sub_category_id;
            $sql        = "select count(*) as total_count from tbl_products where subcategory_id = '$subcategoryId' ";    
            $dataProd   = $ciObj->Common->get_all_record_custom($sql);
            $subcategoryObj->number = "0";
            if(sizeof($dataProd) > 0){
                $subcategoryObj->number = $dataProd[0]->total_count;
            }
       }
       return $data;
    }   
}

        
if(!function_exists('get_product_name_by_id')){
    function get_product_name_by_id($product_id){
       $ciObj =& get_instance();
       $data = $ciObj->Common->_get_all_records("tbl_products",["product_id"=>$product_id]); 
       if(sizeof($data) > 0){
            return $data[0]->product_name;
       }
       return '';
    }   
}

if(!function_exists('is_user_have_vat')){
    function is_user_have_vat($user_id){
       /*
       $ciObj =& get_instance();
       $data = $ciObj->Common->_get_all_records("tbl_stores",["store_id"=>$user_id]); 
       if(sizeof($data) > 0){
            if($data[0]->vat_number != ""){
                return true;
            }
       }
       */
       return false;
    }   
}

if(!function_exists('free_delivery_after_payment')){
    function free_delivery_after_payment($store_id){
       $ciObj =& get_instance();
       $data = $ciObj->Common->_get_all_records("tbl_stores",["store_id"=>$store_id]); 
       return $data[0]->free_delivery_after_payment;
    }   
}

if(!function_exists('cod_charges')){
    function cod_charges($store_id){
       $ciObj =& get_instance();
       $data = $ciObj->Common->_get_all_records("tbl_stores",["store_id"=>$store_id]); 
       return $data[0]->cod_charges;
    }   
}
if(!function_exists('store_shipping_amount')){
    function store_shipping_amount($store_id){
       $ciObj =& get_instance();
       $data = $ciObj->Common->_get_all_records("tbl_stores",["store_id"=>$store_id]); 
       return $data[0]->shipping_amount;
    }   
}


if(!function_exists('is_store_have_vat')){
    function is_store_have_vat($store_id){
       $ciObj =& get_instance();
       $data = $ciObj->Common->_get_all_records("tbl_stores",["store_id"=>$store_id]); 
       if(sizeof($data) > 0){
            if($data[0]->vat_number != ""){
                return true;
            }
       }
       return false;
    }   
}






if(!function_exists('get_country_by_id')){
    function get_country_by_id($country_id){
       $ciObj =& get_instance();
       $data = $ciObj->Common->_get_all_records("countries",["id"=>$country_id]); 
       if(sizeof($data) > 0){
            return $data[0]->name;
       }
       return '';
    }   
} 


 if(!function_exists('get_state_by_id')){
    function get_state_by_id($state_id){
       $ciObj =& get_instance();
       $data = $ciObj->Common->_get_all_records("states",["id"=>$state_id]); 
       if(sizeof($data) > 0){
            return $data[0]->name;
       }
       return '';
    }   
} 


 if(!function_exists('get_city_by_id')){
    function get_city_by_id($id){
       $ciObj =& get_instance();
       $data = $ciObj->Common->_get_all_records("cities",["id"=>$id]); 
       if(sizeof($data) > 0){
            return $data[0]->name;
       }
       return '';
    }   
}


 if(!function_exists('get_all_countries')){
    function get_all_countries(){
       $ciObj =& get_instance();
       $data = $ciObj->Common->_get_all_records("countries",[]); 
       return $data;
    }   
}

 if(!function_exists('get_user_default_address')){
    function get_user_default_address(){
       $ciObj =& get_instance();
       $data = $ciObj->Common->_get_all_records("tbl_address",["is_default"=>"Y","user_id"=>get_store_id()]); 
       return $data[0];
    }   
}


 if(!function_exists('save_user_order')){
    function save_user_order($pay_mode ='COD'){
       $ciObj =& get_instance();
       $user_agent = get_user_agent();
       $sql        =  "select *,tbl_products.store_id as store_id from tbl_user_has_cart 
                      LEFT JOIN tbl_products ON tbl_user_has_cart.product_id = tbl_products.product_id
                      LEFT JOIN tbl_home_category ON tbl_products.category_id = tbl_home_category.category_id
                      LEFT JOIN tbl_product_sub_category ON tbl_products.subcategory_id = tbl_product_sub_category.sub_category_id
                      LEFT JOIN tbl_stores ON tbl_products.store_id = tbl_stores.store_id
                      LEFT JOIN tbl_brands ON tbl_products.brand_id = tbl_brands.brand_id
                      where http_user_agent = '$user_agent' ORDER BY cart_id DESC ";


       

       $data      =  $ciObj->Common->get_all_record_custom($sql);

       $fineArray = array();

       $orderTotal = 0;
      $proorderTotal = 0;
       $store_id   =  "";
       foreach ($data as $row) {
          $obj = new stdClass(); 
          $obj->user_id             = get_store_id();
          $obj->product_id          = $row->product_id;
          $obj->product_title       = $row->product_name;
          $obj->product_qty         = $row->qty;
          $obj->vat_percentage      = $row->vat_percentage;
          $obj->product_price       = $row->price;
          $obj->created_at          = date('Y-m-d H:i:s');
          $obj->updated_at          = date('Y-m-d H:i:s');
          $obj->store_id            = $row->store_id;
          $store_id                 = $row->store_id;
          $producttotal             = $row->price * $row->qty;
          

          $vatAmount                =  get_vat_amount($producttotal,$obj->vat_percentage);
          $producttotalwithvat      = $producttotal + $vatAmount;  
          $orderTotal               = $orderTotal+$producttotalwithvat;
          $proorderTotal  = $proorderTotal + $producttotal;
          array_push($fineArray,$obj);
       }
       //echo is_eligible_for_shipping(get_store_id(),$proorderTotal);die;
       
       
       if(is_eligible_for_shipping($row->store_id,$proorderTotal)){        
            $shipping_charges=0;
       }else{            
            $shipping_charges=store_shipping_amount($row->store_id); 
       }
       $codCharges  = 0;
       // If  COD is  Availble For Store Or Not  
        $store_detail = store_details_by_id($store_id);
        if($store_detail->cod_available == 'N'){
           $codCharges  = 0;
        }else{
            $codCharges  = cod_charges($store_id);
        }                                    
         
       
       $orderTotal = $orderTotal + $codCharges + $shipping_charges;

       
       $insArray = array(
          "user_id"=>get_store_id(),
          "store_id"=>$store_id,
          "cart_data"=>json_encode($fineArray),
          "created_at"=>date('Y-m-d H:i:s'),
          "updated_at"=>date('Y-m-d H:i:s'),
          "payment_mode"=>$pay_mode,
          "payment_status"=>"pending",
          "cod_charges"=>$codCharges,
          "shipping_charges"=>$shipping_charges,
          "total_amount"=>$orderTotal,
          "address_details"=>json_encode(get_user_default_address())
       );
       
       if($ciObj->Common->_insert("tbl_order",$insArray)){
          /*
          $user_agent = get_user_agent();
          $where = array(
              "http_user_agent"=>$user_agent
          );
          $ciObj->Common->_delete("tbl_user_has_cart",$where);
          */
          return true;
       }else{
          return false;
       }
    }
}   


 if(!function_exists('sku_by_product_id')){
    function sku_by_product_id($product_id){
       $ciObj =& get_instance();
       $sql = 'select sku from tbl_products where product_id = "'.$product_id.'"';
       $data = $ciObj->db->query($sql)->result(); 
       if(sizeof($data) > 0){
        return $data[0]->sku;
       }
       return "";

    }
}


 if(!function_exists('vat_percentage_by_product_id')){
    function vat_percentage_by_product_id($product_id){
       $ciObj =& get_instance();
       $sql = 'select vat_percentage from tbl_products where product_id = "'.$product_id.'"';
       $data = $ciObj->db->query($sql)->result(); 
       if(sizeof($data) > 0){
        return $data[0]->vat_percentage;
       }
       return "0";

    }
}

 if(!function_exists('get_products_name_and_cart_total')){
    function get_products_name_and_cart_total($dataArray){
      $productName = "";
      $cartTotal   = 0;

      foreach ($dataArray as $row){
        $cartTotal   = $cartTotal+$row->product_price;


        if($productName != ""){
          $productName = $productName.",".$row->product_title;
        }else{
          $productName = $productName.$row->product_title; 
        }
      }

      $myObj = new stdClass();
      $myObj->product_name = $productName;
      $myObj->cart_total   = $cartTotal;

      return $myObj;
    }
 }







 if(!function_exists('get_stores_by_limit')){
    function get_stores_by_limit($start_limit,$keyword){
       
       $ciObj =& get_instance();
       $sql = 'select * from tbl_stores  where status  = "A" AND user_type = "S" ';

       if($keyword != ""){
        $sql = $sql." AND store_name  LIKE '%".$keyword."%'";
       }
       $sql = $sql." ORDER BY tbl_stores.store_id DESC";
       $sql = $sql." LIMIT $start_limit,10 ";

       $data = $ciObj->db->query($sql)->result(); 

       return $data;
    }   
}

 if(!function_exists('get_stores_by_limit_count')){
    function get_stores_by_limit_count($keyword){
       
       $ciObj =& get_instance();
       $sql = 'select *,IF(tbl_stores.store_image  != "", CONCAT("'.base_url().IMAGE_PATH_ABSULATE.STORES_FOLDER.'", tbl_stores.store_image , ""), "") as store_image   from tbl_stores  where status  = "A" AND user_type = "S" ';
       if($keyword != ""){
        $sql = $sql." AND store_name  LIKE '%".$keyword."%'";
       }
       
       return $ciObj->db->query($sql)->num_rows();
    }   
}




if(!function_exists('get_user_agent')){
    function get_user_agent(){
      return $_SERVER['HTTP_USER_AGENT']; 
    }   
}

function getStoreCount() {
    $obj =& get_instance();
    $where         = array("status"=>"A","user_type"=>"S");
    return           $obj->Common->total_count("tbl_stores","*",$where);
}  

function clearUserCart() {
    $obj =& get_instance();
    $http_user_agent       = get_user_agent();
    $where         = array("http_user_agent"=>$http_user_agent);
    $obj->db->delete("tbl_user_has_cart",$where);
}



function getCartCount() {
    $obj =& get_instance();
    $http_user_agent       = get_user_agent();
    $where         = array("http_user_agent"=>$http_user_agent);
    return           $obj->Common->total_count("tbl_user_has_cart","*",$where);
}  

  

 function getUserBadges($isObj = false) {
    $obj =& get_instance();
    $http_user_agent       = get_user_agent();
    $where         = array("http_user_agent"=>$http_user_agent);
    $wish          = $obj->Common->total_count("tbl_user_has_wishlist","*",$where);

    $myObj         = new stdClass();
    $myObj->cart = getCartCount();
    $myObj->wish = $wish;
    if($isObj){
      return $myObj;
    }
    $obj->Common->showObjectResponse(GLOBAL_RESULT_YES,"Success",$myObj);

  }  




if(!function_exists('is_wishlist_product')){
    function is_wishlist_product($product_id){

      $http_user_agent  = get_user_agent();
      $where            = array("http_user_agent"=>$http_user_agent,"product_id"=>$product_id);
      $obj =& get_instance();
      $data = $obj->Common->get_all_record("tbl_user_has_wishlist",$where);
      if(sizeof($data) > 0){
        return true;
      }
        return false;
    }   
}


  
if(!function_exists('store_name_by_id')){
    function store_name_by_id($id){
      $obj =& get_instance();
      $data = $obj->Common->get_all_record("tbl_stores",array("store_id"=>$id));
      if(sizeof($data) > 0){
        return $data[0]->store_name;
      }
     return ""; 
    }   
}


if(!function_exists('store_owner_first_name')){
    function store_owner_first_name($userId){
      $obj      = &get_instance();
      $data     = $obj->Common->get_all_record("tbl_stores",array("store_id"=>$userId));
      if(sizeof($data) > 0){
        
        
        if($data[0]->user_type == "S"){
            return $data[0]->store_name; 
        }else{
            return $data[0]->owner_first_name." ".$data[0]->owner_last_name;      
        }
      }
     return ""; 
    }   
}



if(!function_exists('login_user_details')){
    function login_user_details(){
      $obj      = &get_instance();
      $storeId  = $obj->session->userdata(FRONT_USER_ID);
      $data     = store_details_by_id($storeId);
      return $data;
     
    }   
}


if(!function_exists('login_user_type')){
    function login_user_type(){
      $obj      = &get_instance();
      $storeId  = $obj->session->userdata(FRONT_USER_ID);
      $data     = $obj->Common->get_all_record("tbl_stores",array("store_id"=>$storeId));
      if(sizeof($data) > 0){
        return $data[0]->user_type;
      }
     return ""; 
    }   
}


if(!function_exists('login_user_name')){
    function login_user_name(){
      $obj      = &get_instance();
      $storeId  = $obj->session->userdata(FRONT_USER_ID);
      $data     = $obj->Common->get_all_record("tbl_stores",array("store_id"=>$storeId));
      if(sizeof($data) > 0){
        
        
        if($data[0]->user_type == "S"){
            return $data[0]->store_name; 
        }else{
            return $data[0]->owner_first_name." ".$data[0]->owner_last_name;      
        }
      }
     return ""; 
    }   
}




if(!function_exists('store_details_by_id')){
    function store_details_by_id($id){
      $obj =& get_instance();
      $data = $obj->Common->get_all_record("tbl_stores",array("store_id"=>$id));
      return $data[0];
     
    }   
}



if(!function_exists('brand_name_by_id')){
    function brand_name_by_id($id){
      $obj =& get_instance();
      $data = $obj->Common->get_all_record("tbl_brands",array("brand_id"=>$id));
      if(sizeof($data) > 0){
        return $data[0]->brand_name;
      }
     return ""; 
    }   
}

if(!function_exists('category_name_by_id')){
    function category_name_by_id($id){
      $obj =& get_instance();
      $data = $obj->Common->get_all_record("tbl_home_category",array("category_id"=>$id));
      if(sizeof($data) > 0){
        return $data[0]->category_name;
      }
     return ""; 
    }   
}

if(!function_exists('subcategory_name_by_id')){
    function subcategory_name_by_id($id){
      $obj =& get_instance();
      $data = $obj->Common->get_all_record("tbl_product_sub_category",array("sub_category_id"=>$id));
      if(sizeof($data) > 0){
        return $data[0]->sub_category_name;
      }
     return ""; 
    }   
}



if(!function_exists('get_product_list')){
    function get_product_list($brand_id,$store_id,$category_id,$subcategory_id,$search_keyword = "",$product_id = "",$zipCountry = "",$min_price = "",$max_price = "",$sort = ""){
        
        $CI   = get_instance();
        $sql  = "select * from tbl_products
                LEFT JOIN tbl_home_category ON tbl_products.category_id = tbl_home_category.category_id
                LEFT JOIN tbl_product_sub_category ON tbl_products.subcategory_id = tbl_product_sub_category.sub_category_id
                LEFT JOIN tbl_stores ON tbl_products.store_id = tbl_stores.store_id
                LEFT JOIN tbl_brands ON tbl_products.brand_id = tbl_brands.brand_id
                WHERE tbl_products.is_active = 'Active '
        ";

        $sql  = $sql." AND tbl_brands.is_active  = 'Active '";
        $sql  = $sql." AND tbl_home_category.is_active  = 'Active '";
        $sql  = $sql." AND tbl_product_sub_category.is_active  = 'Active '";

        if($brand_id != "" && $brand_id != "0"){
              $sql  = $sql." AND tbl_products.brand_id =  '".$brand_id."'";
        }

        if($store_id != "" && $search_keyword == "" && $store_id != "0"){
              $sql  = $sql." AND tbl_products.store_id =  '".$store_id."'";
        }


        if($category_id != "" && $category_id != "0"){
              $sql  = $sql." AND tbl_products.category_id =  '".$category_id."'";
        }


        if($subcategory_id != "" && $subcategory_id != "0"){
              $sql  = $sql." AND tbl_products.subcategory_id =  '".$subcategory_id."'";
        }

        if($product_id != "" && $product_id != "0"){
              $sql  = $sql." AND tbl_products.product_id =  '".$product_id."'";
        }


        if($search_keyword != "" && $search_keyword != "0"){
              $sql  = $sql." AND (tbl_products.product_name LIKE '%".$search_keyword."%' OR tbl_home_category.category_name  LIKE '%".$search_keyword."%' OR tbl_brands.brand_name LIKE '%".$search_keyword."%'  )";

        }
        if($min_price != "" && $max_price != ""){
            if(($min_price != "0" || $max_price != "0") ){          
           
                  $sql  = $sql." AND tbl_products.price >=  '".$min_price."' AND tbl_products.price <=  '".$max_price."' ";
            }
        } 
        


        if($sort != ""){
          if($sort == "latest"){
              $sql  = $sql." ORDER BY product_id DESC ";   
          }else if($sort == "cheapest"){
              $sql  = $sql." ORDER BY price  ";     
          }else if($sort == "expensive"){  
            $sql  = $sql." ORDER BY price DESC ";     
          }           
        }       
        return $CI->db->query($sql)->result();
    }   
}




if(!function_exists('get_store_id')){
    function get_store_id(){
        $CI = get_instance();
        $storeId = $CI->session->userdata(FRONT_USER_ID);
        return $storeId;
    }   
}


if(!function_exists('is_store_login')){
    function is_store_login(){
        $CI = get_instance();
        $storeId = $CI->session->userdata(FRONT_USER_ID);
        if($storeId == ""){
           return false;
        }
        return true;
    }   
}



if(!function_exists('is_user_login')){
    function is_user_login(){
        $CI = get_instance();
        $storeId = $CI->session->userdata(FRONT_USER_ID);
        if($storeId == ""){
           return false;
        }else{
          if(user_type_by_id($storeId) == "U"){
            return true;
          }else{
            return false;
          }
        }
    }   
}

if(!function_exists('login_user_type')){
    function login_user_type(){
        $CI = get_instance();
        $storeId = $CI->session->userdata(FRONT_USER_ID);
        return user_type_by_id($storeId);
    }   
}


if(!function_exists('user_type_by_id')){
    function user_type_by_id($id){
      $obj =& get_instance();
      $data = $obj->Common->get_all_record("tbl_stores",array("store_id"=>$id));
      if(sizeof($data) > 0){
        return $data[0]->user_type;
      }
     return ""; 
    }   
}


if(!function_exists('brand_image_by_id')){
    function brand_image_by_id($id){
      $obj =& get_instance();
      $data = $obj->Common->get_all_record("tbl_brands",array("brand_id"=>$id));
      if(sizeof($data) > 0){
        return $data[0]->brand_image;
      }

     return ""; 

    }   
}



if(!function_exists('brand_name_by_id')){
    function brand_name_by_id($id){
      $obj =& get_instance();
      $data = $obj->Common->get_all_record("tbl_brands",array("brand_id"=>$id));
      if(sizeof($data) > 0){
        return $data[0]->brand_name;
      }

     return ""; 

    }   
}


if(!function_exists('is_store_details_updated')){
    function is_store_details_updated(){
      $obj =& get_instance();
      $data = $obj->Common->get_all_record("tbl_stores",array("store_id"=>get_store_id()));
      if(sizeof($data) > 0){
         if($data[0]->owner_first_name == ""){
          return false; 
         } 
      }else{
         return false; 
     }

     return true; 

    }   
}



if(!function_exists('get_store_key_value')){
    function get_store_key_value($detail){
      $obj =& get_instance();
      $data = $obj->Common->get_all_record("tbl_stores",array("store_id"=>get_store_id()));
      if(sizeof($data) > 0){
         return $data[0]->$detail; 
      }else{
         return ""; 
     }

    }   
}

if(!function_exists('redirect_if_store_not_login')){
    function redirect_if_store_not_login(){
        $CI = get_instance();
        $storeId = $CI->session->userdata(FRONT_USER_ID);
        if($storeId == ""){
           redirect("../"); 
        }
    }   
}


if(!function_exists('get_home_products')){
    function get_home_products(){
        $CI = get_instance();
        $sql = "select * from tbl_products where is_active = 'Active' AND visible_to_home = 'Y' order by product_id DESC LIMIT 0,20 ";

        //return $CI->Common->_get_all_records_limit_desc("tbl_products",["is_active"=>"Active"],20, 0,"product_id");
        return $CI->Common->get_all_record_custom($sql);
    }   
}


if(!function_exists('get_subcategory_by_category_id')){
    function get_subcategory_by_category_id($category_id){
        $CI = get_instance();
        return $CI->Common->get_all_record("tbl_product_sub_category",["is_active"=>"Active","category_id"=>$category_id]);
    }   
}


if(!function_exists('upload_image')){
    function upload_image($fileName,$uploadDir){
       
        $CI = get_instance();
        $file_name  =   $_FILES[$fileName]['name'];
        $ext        =   pathinfo($file_name, PATHINFO_EXTENSION);
        $filename   =   time().'_'.APP_NAME.'.'.$ext;
        $config['overwrite']            = TRUE;
        $config['upload_path']          = $uploadDir;
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $config['max_size']             = 20048;
        $config['file_name']            = $filename;
        
        $CI->load->library('upload', $config);
        $finalFileName = "";    
        if($CI->upload->do_upload($fileName)){
            $finalFileName = $filename;
        }
        return $finalFileName;
    }   
}


if(!function_exists('get_home_category_menu')){
    function get_home_category_menu(){
        $obj =& get_instance();
        $data = $obj->Common->get_all_record("tbl_home_category",array("is_active"=>"Active","is_menu_category"=>"yes"));
        return $data;
        
    }
}

if(!function_exists('get_all_active_category')){
    function get_all_active_category(){
    $CI = get_instance();
        return $CI->Common->get_all_record("tbl_home_category",["is_active"=>"Active"]);
    }   
}

if(!function_exists('get_home_stores')){
    function get_home_stores(){
        $obj =& get_instance();
        $data = $obj->Common->get_all_record("tbl_stores",array("status"=>"A","user_type"=>"S","visible_to_home"=>"Y"));

       
        return $data;
        
    }
}

if(!function_exists('get_stores')){
    function get_stores(){
        $obj =& get_instance();
        $data = $obj->Common->get_all_record("tbl_stores",array("status"=>"A","user_type"=>"S"));
        return $data;
        
    }
}


if(!function_exists('get_home_category_images')){
    function get_home_category_images(){
        $obj =& get_instance();
        $data = $obj->Common->get_all_record("tbl_home_category",array("is_active"=>"Active","is_menu_category"=>"yes"));
        return $data;
        
    }
}


if(!function_exists('get_home_category')){
    function get_home_category(){
        $obj =& get_instance();
        $data = $obj->Common->get_all_record("tbl_home_category",array("is_active"=>"Active","visible_to_home"=>"Y"));
        return $data;
        
    }
}




if(!function_exists('get_banners')){
    function get_banners($type='Home'){
        $obj =& get_instance();
        $data = $obj->Common->get_all_record("tbl_banner",array("is_active"=>"Active","banner_page_type"=>$type));
        return $data;
        
    }
}

if(!function_exists('get_home_brands')){
    function get_home_brands(){
        $obj =& get_instance();
        $data = $obj->Common->get_all_record("tbl_brands",array("is_active"=>"Active","visible_to_home"=>"Y"));
        return $data;
        
    }
}

if(!function_exists('get_brands')){
    function get_brands(){
        $obj =& get_instance();
        $sql = "select * from tbl_brands where is_active = 'Active' ORDER BY brand_name  ";
        $data = $obj->Common->get_all_record_custom($sql);
        //$data = $obj->Common->get_all_record("tbl_brands",array("is_active"=>"Active"));
        return $data;
        
    }
}




if(!function_exists('get_promotions')){
    function get_promotions(){
        $obj =& get_instance();
        $data = $obj->Common->get_all_record("tbl_promo",array("status"=>"active"));
        return $data;
        
    }
}



if (!function_exists('sendNotification')) {
 function sendNotification($registratoin_ids,$message,$topics = false){

    $url = 'https://fcm.googleapis.com/fcm/send';
    $obj =& get_instance();
    $server_key =FIREBASE_PUSH_KEY;
    $fields = array();
    $fields['notification'] = $message;
    if($topics){
      $fields['to'] = "/topics/cashvertise_notification";
    }else{
      $fields['registration_ids'] = $registratoin_ids;
    }

    $fields['data'] = $message;
//header with content_type api key
    $headers = array(
        'Content-Type:application/json',
        'Authorization:key='.$server_key
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);


    if ($result === FALSE) {
       // die('FCM Send Error: ' . curl_error($ch));
    }
    curl_close($ch);
 }
}



if (!function_exists('get_cropped_image')) {
   function get_cropped_image($height,$width,$url){
      return base_url().'uploads/image_crop.php?image=/'.$url.'&width='.$width.'&height='.$height;
   }
}



if (!function_exists('postal_form_lat_lng')) {
   function postal_form_lat_lng($lat,$lng){
      $postal_code = "";
      $obj =& get_instance();
      $wherePostal  = ["lat"=>$lat,"lng"=>$lng];    
      if($obj->Common->_is_record_exits("tbl_postal_location",$wherePostal)){
          $data = $obj->Common->_get_all_records("tbl_postal_location",$wherePostal);
          $postal_code = $data[0]->postal_code;
      }

      return $postal_code;
   }
}










if (!function_exists('getUnreadNotificationCountByUserId')) {
   function getUnreadNotificationCountByUserId($userid){
     $obj =& get_instance();
     $currentDate = date("Y-m-d")." 00:00:00";

     $myNotification = $this->db->query("select * from tbl_notification where user_id = '0' AND  created >= '$currentDate' AND FIND_IN_SET('$userid',seen_ids) <= 0 ")->num_rows();     

     $allNotification = $obj->Common->total_count("tbl_notification", "user_id",array("is_read"=>"false","user_id"=>$userid,"created >= "=>$currentDate));     
     return $myNotification + $allNotification;
   }
}


if (!function_exists('sendNotificationToUserId')) {
   function sendNotificationToUserId($userid,$messageString){
      $obj =& get_instance();
      $message  =   array(
              "title"=>NOTIFICATION_TITLE,
              "body"=>$messageString,
              "sound"=>"default",
              "new_ads"=>newadscount($userid),
              "badge"=>getUnreadNotificationCountByUserId($userid)
      );
      $registrationId = $obj->Common->getUserFirebaseTokenBoth($userid);


      sendNotification($registrationId,$message);
   }
}



function newadscount($user_id){

          $obj =& get_instance();
          $userPostalCodeActual = $obj->Common->getUserPostalCodeById($user_id);
          $userPostalCode  = substr($userPostalCodeActual, 0, 2);
          $mySeenAds       = $obj->Common->getUserSeenAdsArrayByUserId($user_id); 
          $myseenAdsString = implode($mySeenAds,",");
          $user_lat = 0.00;
          $user_lng = 0.00;
          $distance = RADIUS_DISTENCE;

          $wherePostal = ["postal_code"=>$userPostalCodeActual];
          $dataPostal  =  $obj->Common->_get_all_records("tbl_postal_location",$wherePostal);
          if(sizeof($dataPostal) > 0){
               $user_lat = $dataPostal[0]->lat;
               $user_lng = $dataPostal[0]->lng;
          }


          $sql = 'select *, 111.111 * DEGREES(ACOS(LEAST(1.0, COS(RADIANS(order_lat)) * COS(RADIANS('.$user_lat.')) * COS(RADIANS(order_lng - '.$user_lng.')) + SIN(RADIANS(order_lat)) * SIN(RADIANS('.$user_lat.'))))) AS distance,tbl_orders.id as id,IF(tbl_orders.image_single != "", CONCAT("'.base_url().'uploads/ads/", tbl_orders.image_single, ""), "") as image_single, IF(tbl_orders.image_single != "", CONCAT("'.base_url().'uploads/ads/thumb/", tbl_orders.image_single, ""), "") as image_path_thumb,tbl_orders.image_path from tbl_orders LEFT JOIN tbl_order_zipcodes ON  tbl_orders.id = tbl_order_zipcodes.order_id '; 
                
          $sql = $sql.'where 
          case 
           when ( tbl_orders.order_type = "Specific Postal Code" ) then tbl_order_zipcodes.zipcode = "'.$userPostalCode.'" 
          
           else 1 = 1 
          end ';

          $sql = $sql.' AND tbl_orders.status =  "In Progress" AND tbl_orders.start_date <= CURDATE() AND tbl_orders.end_date >= CURDATE() ';

          if($myseenAdsString != ""){
               $sql = $sql.' AND  tbl_orders.id NOT IN ('.$myseenAdsString.')';
          }

          $sql = $sql.' having
          case 
           when ( tbl_orders.order_type = "Specific Radius" ) then  distance <= ('.$distance.'/ 1000 ) 
           else 1 = 1 
          end ';
          

          $sql = $sql." ORDER BY tbl_orders.id DESC";


          return $obj->db->query($sql)->num_rows();

}


if (!function_exists('sendTopicNotification')) {
   function sendTopicNotification($messageString){
      $obj =& get_instance();
      $message  =   array(
              "title"=>NOTIFICATION_TITLE,
              "body"=>$messageString,
              "sound"=>"default",
              "type"=>"topic_notification",
              "badge"=>"1"
              
      );
      $registrationId = array();
      sendNotification($registrationId,$message,true);
   }
}


if (!function_exists('get_spaces_by_count')) {
   function get_spaces_by_count($number){
     $fineString = "";
     for ($i=0; $i < $number; $i++) { 
       $fineString = $fineString." ";
     }
     return $fineString;
   }
}






if (!function_exists('sendNewAdsNotification')) {
   function sendNewAdsNotification($orderId,$Type){
      $obj =& get_instance();
      $message  =   array(
              "title"=>NOTIFICATION_TITLE,
              "body"=>NEW_AD_POSTED,
              "sound"=>"default",
              "type"=>"topic_notification_new_ad",
              "badge"=>"1"
      );
      
      $registrationId = array();
      if($Type == "Whole Country"){
        sendNotification($registrationId,$message,true);
      }else if($Type == "Specific Postal Code"){
        $orderZip = $obj->Common->_get_all_records("tbl_order_zipcodes",["order_id"=>$orderId]);
        if(sizeof($orderZip) > 0){
          $sql = "select * from tbl_advert_viewer where 1 = 1 ";
          $count =  0;
          foreach ($orderZip as $result) {
            if($count == 0){
              $sql =  $sql." AND  postal_code like '$result->zipcode%'  ";
            }else{
              $sql =  $sql." OR postal_code like '$result->zipcode%'  ";
            }
            $count++;
          }



         
          $data = $obj->db->query($sql)->result();
          for ($i=0; $i <count($data) ; $i++) { 
              if($data[$i]->android_token != ""){
                array_push($registrationId, $data[$i]->android_token);
              }

              if($data[$i]->ios_token != ""){
                array_push($registrationId, $data[$i]->ios_token);
              }
          }

          
          if(sizeof($registrationId) > 0){
            sendNotification($registrationId,$message,false);
          }
        }
      }else{
      
        $orderData = $obj->Common->_get_all_records("tbl_orders",["id"=>$orderId]);
        $distance = RADIUS_DISTENCE;
        if(sizeof($orderData) > 0){
          $order_lat = $orderData[0]->order_lat;
          $order_lng = $orderData[0]->order_lng;
          
          $sql = 'select * , 111.111 * DEGREES(ACOS(LEAST(1.0, COS(RADIANS('.$order_lat.')) * COS(RADIANS(lat)) * COS(RADIANS('.$order_lng.' - lng)) + SIN(RADIANS('.$order_lat.')) * SIN(RADIANS(lat))))) AS distance from tbl_advert_viewer LEFT JOIN tbl_postal_location ON  tbl_advert_viewer.postal_code = tbl_postal_location.postal_code where tbl_advert_viewer.status = "Approved"  having distance <= ('.$distance.' / 1000) ';

          $data = $obj->db->query($sql)->result();
          if(sizeof($data) > 0){
            for ($i=0; $i <count($data) ; $i++) { 
              if($data[$i]->android_token != ""){
                array_push($registrationId, $data[$i]->android_token);
              }

              if($data[$i]->ios_token != ""){
                array_push($registrationId, $data[$i]->ios_token);
              }
            }
          }
          if(sizeof($registrationId) > 0){
            sendNotification($registrationId,$message,false);
          }

        }
        die();
      }
      
   }
}


if(!function_exists('get_new_ads_sql')){
    function get_new_ads_sql($user_lat,$user_lng,$userPostalCode,$myseenAdsString){
      $distance = RADIUS_DISTENCE;

      $sql = 'select *, 111.111 * DEGREES(ACOS(LEAST(1.0, COS(RADIANS(order_lat)) * COS(RADIANS('.$user_lat.')) * COS(RADIANS(order_lng - '.$user_lng.')) + SIN(RADIANS(order_lat)) * SIN(RADIANS('.$user_lat.'))))) AS distance,tbl_orders.id as id,IF(tbl_orders.image_single != "", CONCAT("'.base_url().'uploads/ads/", tbl_orders.image_single, ""), "") as image_single, IF(tbl_orders.image_single != "", CONCAT("'.base_url().'uploads/ads/thumb/", tbl_orders.image_single, ""), "") as image_path_thumb,tbl_orders.image_path from tbl_orders LEFT JOIN tbl_order_zipcodes ON  tbl_orders.id = tbl_order_zipcodes.order_id '; 
      
      $sql = $sql.'where tbl_orders.status =  "In Progress" AND tbl_orders.start_date <= CURDATE() AND tbl_orders.end_date >= CURDATE() AND  
      case 
       when ( tbl_orders.order_type = "Specific Postal Code" ) then tbl_order_zipcodes.zipcode = "'.$userPostalCode.'" 
       else 1 = 1 
      end ';


      if($myseenAdsString != ""){
           $sql = $sql.' AND  tbl_orders.id NOT IN ('.$myseenAdsString.')';
      }

      $sql = $sql.' having
      case 
       when ( tbl_orders.order_type = "Specific Radius" ) then  distance <= ('.$distance.'/ 1000 ) 
       else 1 = 1 
      end ';

      $sql = $sql." ORDER BY tbl_orders.id DESC";


      return $sql;

    }
}

if(!function_exists('complete_refund_by_refund_id')){
    function complete_refund_by_refund_id($refundId){
        $obj =& get_instance();
        $obj->db->where(array("id"=>$refundId));
        $updateArray = array("status"=>"completed","refund_process_date"=>date("Y-m-d H:i:s"));
        $obj->db->update("tbl_advertiser_orders_refund",$updateArray);
        

        $dataRefund = $obj->Common->_get_all_records("tbl_advertiser_orders_refund",array("id"=>$refundId));


        // update order status to refund too
        $where = array("id"=>$dataRefund[0]->order_id);
        $updateArray = array("status"=>"Refunded");
        $obj->db->where($where);
        $obj->db->update("tbl_orders",$updateArray);

        $where = array("id"=>$dataRefund[0]->order_id);
        $obj->db->where($where);
        $orderDetails = $obj->Common->_get_all_records("tbl_orders",$where);
   
        $insTranactionArray = array(
            "user_id"          => $dataRefund[0]->user_id,
            "order_id"         => $dataRefund[0]->order_id,
            "amount"           => $orderDetails[0]->total_cost,
            "refund_amount"    => $orderDetails[0]->remaining_balance,
            "transaction_type" => "refund", 
            "status"           => "completed", 
            "date"             => date("Y-m-d H:i:s"),
            "remark"           => "refund done by admin"
        );

        $obj->db->insert("tbl_transactions",$insTranactionArray);

        $advertiserDetails = $obj->Common->_get_all_records("tbl_advertiser",array("id"=>$dataRefund[0]->user_id));
        if(sizeof($advertiserDetails) > 0){
          $obj->EmailTemplate->sendRefundCompleteMail($dataRefund[0]->order_id,$advertiserDetails[0]->fname,$advertiserDetails[0]->email);
        }
    }
}


if(!function_exists('get_zeros')){
    function get_zeros($number){
      $fineString = "";
      for ($i=0; $i <=$number ; $i++) { 
        $fineString .= "0";
      }
      return $fineString;
    }
}





if(!function_exists('get_order_id')){
    function get_order_id($id){
      $length = 6 - strlen($id);
      return  get_meta_value("order_prefix").get_zeros($length).$id;
    }
}


if(!function_exists('get_invoice_id')){
    function get_invoice_id($id){
      $length = 6 - strlen($id);
      return  get_meta_value("invoice_prefix").get_zeros($length).$id;
    }
}

if(!function_exists('get_withdraw_id')){
    function get_withdraw_id($id){
      $length = 6 - strlen($id);
      return  get_meta_value("withdraw_prefix").get_zeros($length).$id;
    }
}


if(!function_exists('get_refund_id')){
    function get_refund_id($id){
      $length = 6 - strlen($id);
      return  get_meta_value("refund_prefix").get_zeros($length).$id;
    }
}








if(!function_exists('show_two_decimal_number')){
    function show_two_decimal_number($number){
      return  number_format((float)$number, 2, '.', '');
    }
}



if(!function_exists('total_distributed_by_order_id')){
    function total_distributed_by_order_id($orderId){
        $obj =& get_instance();
        return $obj->Common->getTotalViewOrderById(array("order_id"=>$orderId));
    }
}


if(!function_exists('total_view_by_order_id')){
    function total_view_by_order_id($orderId){
        $obj =& get_instance();
        return $obj->Common->getTotalViewOrderById(array("order_id"=>$orderId));
    }
}


if(!function_exists('total_click_through_order_id')){
    function total_click_through_order_id($orderId){
        $obj =& get_instance();
        return $obj->Common->getTotalClick(array("order_id"=>$orderId));
    }
}





if(!function_exists('get_refund_amount_from_order_id')){
    function get_refund_amount_from_order_id($orderId){
        $obj =& get_instance();
        $data = $obj->Common->get_all_record("tbl_advertiser_orders_refund",array("order_id"=>$orderId));
        if(sizeof($data) > 0){
           return $data[0]->refunded_amount;         
        }else{
           return "";
        }
    }
}



if(!function_exists('get_refund_id_from_order_id')){
    function get_refund_id_from_order_id($orderId){
        $obj =& get_instance();
        $data = $obj->Common->get_all_record("tbl_advertiser_orders_refund",array("order_id"=>$orderId));
        if(sizeof($data) > 0){
           return $data[0]->id;         
        }else{
           return "";
        }
    }
}



    

if(!function_exists('per_view_cost_by_number_of_images')){
    function per_view_cost_by_number_of_images($numberOfImages){
        $obj =& get_instance();
        $data = $obj->Common->get_all_record("tbl_advertiser",array("id"=>$obj->Common->get_advertiser_id()));
        if(sizeof($data) > 0){
           $ispartner =  $data[0]->is_partner;
           $sql = "select pricetable_cpv_normal_advertiser as price from tbl_pricetable order by id";
           if($ispartner == "yes"){
             $sql = "select pricetable_cpv_partner_advertiser as price from tbl_pricetable order by id";
           }
           $data = $obj->db->query($sql)->result(); 
           $actualImage = $numberOfImages - 1; 
           return $data[$actualImage]->price;         
        }else{
           return "0.00";
        }
    }
}


   

if(!function_exists('application_user_name_by_id')){
    function application_user_name_by_id($id){
        $obj =& get_instance();
        $data = $obj->Common->get_all_record("tbl_advert_viewer",array("id"=>$id));
        
        if(sizeof($data) > 0){
           if($data[0]->username != ""){
            return  $data[0]->username;
          }else{
            return  $data[0]->fname;
          } 
           
        }else{
           return "User Deleted";
        }
    }
}  



if(!function_exists('advertiser_name_by_id')){
    function advertiser_name_by_id($id){
        $obj =& get_instance();
        $data = $obj->Common->get_all_record("tbl_advertiser",array("id"=>$id));
        if(sizeof($data) > 0){
           return  $data[0]->fname;
        }else{
           return "";
        }
    }
}  

if(!function_exists('getorderid')){
    function getorderid($id){
        $obj =& get_instance();
        $data = $obj->Common->get_all_record("tbl_orders",array("id"=>$id));
        if(sizeof($data) > 0){
           return  $data[0]->order_id;
        }else{
           return "";
        }
    }
}  







        

if(!function_exists('get_pricing')){
    function get_pricing(){
        $obj =& get_instance();
        $data = $obj->Common->get_all_record("tbl_advertiser",array("id"=>$obj->Common->get_advertiser_id()));
        if(sizeof($data) > 0){
           $ispartner =  $data[0]->is_partner;
           $sql = "select pricetable_cpv_normal_advertiser as price from tbl_pricetable order by id";
           if($ispartner == "yes"){
             $sql = "select pricetable_cpv_partner_advertiser as price from tbl_pricetable order by id";
           }
           return $obj->db->query($sql)->result(); 
        }else{
           return array();
        }
    }
}  



if(!function_exists('validate_date')){
    function validate_date($date){
        $format = date_out();
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }
}


if(!function_exists('upload_ad_thumb')){
function upload_ad_thumb($tagName,$source_folder,$filename){
        $obj =& get_instance();
        $file_name      =   $filename;
        // The file supplied is valid...Set up some variables for the location and name of the file.
        $obj->load->library('image_lib');
        $path = $source_folder;
        $source_path = $path.'/'.$file_name;
        $medium_image_path = $path.'/thumb/'.$file_name;
     
        $config['image_library'] = 'gd2';
        $config['source_image'] = $source_path;
        $config['create_thumb'] = FALSE;
        $config['maintain_ratio'] = TRUE;
        // medium size image
        $config['new_image'] = $medium_image_path;
        $config['width']     = 400;
        $config['height']    = 400;
        $config['file_name'] = $filename;
        
        $obj->image_lib->initialize($config);
        
        if (!$obj->image_lib->resize()) {
            echo $obj->image_lib->display_errors();
        }
        // end resize
        return $file_name;
    }
 }   




if(!function_exists('get_adveritser_details_by_id')){
    function get_adveritser_details_by_id($id){
        $obj =& get_instance();
        $data = $obj->Common->get_all_record("tbl_advertiser",array("id"=>$id));
        if(sizeof($data) > 0){
            return $data;
        }else{
           return "";
        }
        
    }
}

if (!function_exists('get_refund_amount_from_order_id')) {
    function get_refund_amount_from_order_id($order_id){
            $obj =& get_instance();
            $data = $obj->Common->get_all_record("tbl_transactions",array("order_id"=>$order_id,"transaction_type"=>"refund"));
            if(sizeof($data) > 0){
               return $data[0]->refund_amount; 
            }

            return "";
    }
}




if (!function_exists('get_earning_by_images')) {
    function get_earning_by_images($imageCount){
            $obj =& get_instance();
            $data = $obj->Common->get_all_record("tbl_price_table_advert_viewer",array("number_of_image"=>$imageCount));
            
            
            
            if(sizeof($data) > 0){
                return $data[0];
            }else{
               $myObj = new stdClass();
               $myObj->earning_per_view_green = 0;
               $myObj->earning_per_view_silver = 0;
               $myObj->earning_per_view_gold = 0;
               return $myObj;
            }
    }
}




if (!function_exists('advertview_earn_by_package_id')) {
    function advertview_earn_by_package_id($package_id,$orderArray){
            $obj =& get_instance();
            $data = $obj->Common->get_all_record("tbl_package",array("id"=>$package_id));
            if(sizeof($data) > 0){
               if($data[0]->type == "Green"){
                  return $orderArray[0]->earning_per_view_green;
               }else if($data[0]->type == "Silver"){
                  return $orderArray[0]->earning_per_view_silver;
               }else{
                  return $orderArray[0]->earning_per_view_gold;
               } 
            }
            return "0.00";
    }
}





if (!function_exists('get_remark_from_order_id')) {
    function get_remark_from_order_id($order_id){
            $obj =& get_instance();
            $data = $obj->Common->get_all_record("tbl_transactions",array("order_id"=>$order_id,"transaction_type"=>"refund"));
            if(sizeof($data) > 0){
               return $data[0]->remark; 
            }

            return "";
    }
}



if (!function_exists('get_admin_role')) {
    function get_admin_role(){
            $obj =& get_instance();
            $data = $obj->Common->get_all_record("tbl_admin",array("admin_id"=>$obj->Common->get_admin_id()));
            if(sizeof($data) > 0){
               return json_decode($data[0]->roles,true); 
            }else{
               return array(); 
           }
    }
}




if (!function_exists('app_user_name_by_id')) {
    function app_user_name_by_id($user_id){
            $obj =& get_instance();
            $data = $obj->Common->get_all_record("tbl_advert_viewer",array("id"=>$user_id));
            if(sizeof($data) > 0){
              return  $data[0]->username;
            }else{
               return "";
           }
    }
}


if(!function_exists('zipcode_by_order_id')){
    function zipcode_by_order_id($order_id){
       $obj =& get_instance();
       $data = $obj->Common->get_all_record("tbl_order_zipcodes",array("order_id"=>$order_id));
       $typeValue = "";


      

       if(sizeof($data) > 0){
           foreach ($data as $value) {
              if($typeValue == ""){
                  $typeValue =   $value->zipcode; 
              }else{
                  $typeValue =  $typeValue.",".$value->zipcode;
              }  
           } 
           
       }
       if($typeValue != ""){
            $typeValue = '('.$typeValue.')';
       }
       return $typeValue;
    }
}





if(!function_exists('get_area_region_by_order_id')){
    function get_area_region_by_order_id($order_id,$type){
       $obj =& get_instance();
       $data = $obj->Common->get_all_record("tbl_order_zipcodes",array("order_id"=>$order_id));
       $typeValue = "";

       if(sizeof($data) > 0){
          $zipCode = $data[0]->zipcode;
          $sql = "select * from tbl_zipcode LEFT JOIN tbl_area on tbl_zipcode.area_id = tbl_area.area_id  where tbl_zipcode.zip_code = '".$zipCode."'";  

          $data = $obj->db->query($sql)->result();
          if(sizeof($data) > 0){
              $typeValue = $data[0]->$type;
          }
          
          return $typeValue;

        }else{
           return "";
        }
    }
}

 


if(!function_exists('get_zip_code_by_order_id')){
    function get_zip_code_by_order_id($order_id){
        $obj =& get_instance();
        $data = $obj->Common->get_all_record("tbl_order_zipcodes",array("order_id"=>$order_id));
       

       if(sizeof($data) > 0){
            $zipCode  = "";
            $count = 0;
            foreach ($data as $result) {
                if($count == 0){
                   $zipCode  = $result->zipcode; 
                }else{
                   $zipCode  =  $zipCode.", ".$result->zipcode;
                }
                $count++;
            }
           
            
            return $zipCode;

        }else{
           return "";
        }
    }
}

 



if(!function_exists('get_footer_block')){
    function get_footer_block($block_name){
        $obj =& get_instance();
        $data = $obj->Common->get_all_record("tbl_footer_block",array());
        if(sizeof($data) > 0){
            return   str_replace("{{base_url}}", base_url(), $data[0]->$block_name);
        }else{
           return "";
        }
        
    }
}



if(!function_exists('get_login_adveritser_details')){
    function get_login_adveritser_details($details){
        $obj =& get_instance();
        $data = $obj->Common->get_all_record("tbl_advertiser",array("id"=>$obj->Common->get_advertiser_id()));
        if(sizeof($data) > 0){
            return $data[0]->$details;
        }else{
           return "";
        }
        
    }
}


if(!function_exists('get_vat_amount')){
    function get_vat_amount($amount,$vat_percent){
        $vatAmount = ($amount * $vat_percent) / 100;
        return strval(number_format((float)$vatAmount, 2, '.', ''));
    }
}


if(!function_exists('get_meta_value')){
    function get_meta_value($key){
        $obj =& get_instance();
        $sql = "select meta_value from tbl_setting where meta_key = '$key' "; 
        $data =  $obj->Common->get_all_record_custom($sql);
        return $data[0]->meta_value;
    }
}



if(!function_exists('get_login_adveritser_details')){
    function get_login_adveritser_details($details){
        $obj =& get_instance();
        $data = $obj->Common->get_all_record("tbl_advertiser",array("id"=>$obj->Common->get_advertiser_id()));
        if(sizeof($data) > 0){
            return $data[0]->$details;
        }else{
           return "";
        }
        
    }
}

if(!function_exists('paypal_business')){
    function paypal_business(){
        $obj =& get_instance();
        $sql = "select meta_value from tbl_setting where meta_key = 'paypal_business' "; 
        $data =  $obj->Common->get_all_record_custom($sql);
        return $data[0]->meta_value;
    }
}


if(!function_exists('date_out')){
    function date_out(){
        $obj =& get_instance();
        $sql = "select meta_value from tbl_setting where meta_key = 'date_out' "; 
        $data =  $obj->Common->get_all_record_custom($sql);
        return $data[0]->meta_value;
    }
}



if(!function_exists('site_currency_symbol')){
    function site_currency_symbol(){
        $obj =& get_instance();
        $sql = "select meta_value from tbl_setting where meta_key = 'site_currency_symbol' "; 
        $data =  $obj->Common->get_all_record_custom($sql);
        return $data[0]->meta_value;
    }
}


if(!function_exists('paypal_sandbox')){
    function paypal_sandbox(){
        $obj =& get_instance();
        $sql = "select meta_value from tbl_setting where meta_key = 'paypal_sandbox' "; 
        $data =  $obj->Common->get_all_record_custom($sql);
        if( $data[0]->meta_value == 'false'){
      return false;
    }else if( $data[0]->meta_value == 'true'){
      return true;
    } 
    }
}


if(!function_exists('advert_display_time')){
    function advert_display_time(){
        $obj =& get_instance();
        $sql = "select meta_value from tbl_setting where meta_key = 'advert_display_time' "; 
        $data =  $obj->Common->get_all_record_custom($sql);
        return $data[0]->meta_value;
    }
}

 

if(!function_exists('site_currency')){
    function site_currency(){
        $obj =& get_instance();
        $sql = "select meta_value from tbl_setting where meta_key = 'site_currency' "; 
        $data =  $obj->Common->get_all_record_custom($sql);
        return $data[0]->meta_value;
    }
}


if(!function_exists('order_prefix')){
    function order_prefix(){
        $obj =& get_instance();
        $sql = "select meta_value from tbl_setting where meta_key = 'order_prefix' "; 
        $data =  $obj->Common->get_all_record_custom($sql);
        return $data[0]->meta_value;
    }
}



if(!function_exists('transaction_fee')){
    function transaction_fee(){
        $obj =& get_instance();
        $sql = "select meta_value from tbl_setting where meta_key = 'transaction_fee' "; 
        $data =  $obj->Common->get_all_record_custom($sql);
        return show_two_decimal_number($data[0]->meta_value);
    }
}


if(!function_exists('advert_per_view_earning')){
    function advert_per_view_earning(){
        $obj =& get_instance();
        $sql = "select meta_value from tbl_setting where meta_key = 'advert_per_view_earning' "; 
        $data =  $obj->Common->get_all_record_custom($sql);
        return $data[0]->meta_value;
    }
}


if(!function_exists('advertise_perview_cost')){
    function advertise_perview_cost(){
        $obj =& get_instance();
        $sql = "select meta_value from tbl_setting where meta_key = 'advertise_per_view_cost' "; 
        $data =  $obj->Common->get_all_record_custom($sql);
        return $data[0]->meta_value;
    }
}


if(!function_exists('get_footer_page')){
    function get_footer_page(){
        $obj =& get_instance();
        $sql = "select * from tbl_page where status = 'Active' AND is_footer_link = 'YES'"; 
        $data =  $obj->Common->get_all_record_custom($sql);
        return $data;
    }
}



if(!function_exists('get_user_id_from_withdraw')){
    function get_user_id_from_withdraw($id){
        $obj =& get_instance();
        $data =  $obj->Common->get_all_record("tbl_advert_viewer_withdraw",array("id"=>$id));

        if(sizeof($data) > 0){
            return $data[0]->user_id;
        }else{
           return "";
        }
    }
}

if(!function_exists('get_login_adveritser_details_array')){
    function get_login_adveritser_details_array(){
        $obj =& get_instance();
        return $obj->Common->get_all_record("tbl_advertiser",array("id"=>$obj->Common->get_advertiser_id()));
    }
}

if (!function_exists('get_admin_details')) {
    function get_admin_details($detail){
            $obj =& get_instance();
            $data = $obj->Common->get_all_record("tbl_admin",array("admin_id"=>$obj->Common->get_admin_id()));
            if(sizeof($data) > 0){
               return $data[0]->$detail; 
            }else{
               return ""; 
           }
            
    }
}


if (!function_exists('get_employement_from_id')) {
    function get_employement_from_id($id){
            $obj =& get_instance();
            $data = $obj->Common->get_all_record("tbl_employment_status",array("id"=>$id));
             if(sizeof($data) > 0){
               return $data[0]->employment_text; 
             }else{
               return ""; 
             }

    }
}


if (!function_exists('get_packages_from_id')) {
    function get_packages_from_id($id){
            $obj =& get_instance();
            $data = $obj->Common->get_all_record("tbl_package",array("id"=>$id));
            return $data;
    }
}

if (!function_exists('get_packages_level_from_id')) {
    function get_packages_level_from_id($id){
            $obj =& get_instance();
            $data = $obj->Common->get_all_record("tbl_package",array("id"=>$id));
            if(sizeof($data) > 0){
              return $data[0]->level;
            } 
            return "";
    }
}


if (!function_exists('interest_from_id')) {
    function interest_from_id($id){
            $obj =& get_instance();
            $data = $obj->Common->get_all_record("tbl_interests",array("id"=>$id));
            if(sizeof($data) > 0){
               return $data[0]->interests_text; 
             }else{
               return ""; 
             }
            
    }
}


if (!function_exists('getSessionFlashDataSamePage')) {
    function getSessionFlashDataSamePage($key)
    {
        $data = getSessionUserData($key);
        setSessionUserData(array($key => ''));
        return $data;
    }
}

if (!function_exists('assets_url')) {
    function assets_url($folder, $path)
    {
        $url = base_url() . 'assets/' . $folder . '/' . $path;
        return $url;
    }
}


if (!function_exists('_inputPost')) {
    function _inputPost($elementName)
    {
        $CI =& get_instance();
        return $CI->input->post($elementName);
    }
}

if (!function_exists('_inputGet')) {
    function _inputGet($elementName)
    {
        $CI =& get_instance();
        return $CI->input->get($elementName);
    }
}

if (!function_exists('getSessionUserData')) {
    function getSessionUserData($key)
    {
        $CI =& get_instance();
        return $CI->session->userdata($key);
    }
}

if (!function_exists('setSessionUserData')) {
    function setSessionUserData($key, $val = '')
    {
        $CI =& get_instance();
        if (is_array($key)) {
            $CI->session->set_userdata($key);
        } else {
            $CI->session->set_userdata($key, $val);
        }
    }
}

if (!function_exists('getSessionFlashData')) {
    function getSessionFlashData($key)
    {
        $CI =& get_instance();
        return $CI->session->flashdata($key);
    }
}

if (!function_exists('randomGenerateString')) {
    function randomGenerateString($length = 6)
    {
        $vowels = 'AEUY123456789';
        $consonants = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        //$consonants  .= '!@#$%^&*_-()';
        $password = '';
        $alt = time() % 2;
        for ($i = 0; $i < $length; $i++) {
            if ($alt == 1) {
                $password .= $consonants[(rand() % strlen($consonants))];
                $alt = 0;
            } else {
                $password .= $vowels[(rand() % strlen($vowels))];
                $alt = 1;
            }
        }

        $obj =& get_instance();
        $data = $obj->Common->get_all_record("tbl_advert_viewer",array("self_referral_code"=>$password));
        if(sizeof($data) > 0){
            randomGenerateString(REFER_CODE_LENGTH);
        }

        return $password;
    }
}


if (!function_exists('randomGenerateNumber')) {
    function randomGenerateNumber($length = 4)
    {
        $digits = $length;
        return rand(pow(10, $digits-1), pow(10, $digits)-1);
        
    }
}



if (!function_exists('validateURI')) {
    function validateURI($uriSegment)
    {
        $CI =& get_instance();
        return trim($CI->uri->segment($uriSegment)) != '' && is_numeric($CI->uri->segment($uriSegment)) && $CI->uri->segment($uriSegment) > 0 ? $CI->uri->segment($uriSegment) : '';
    }
}

if (!function_exists('getStringSegment')) {
    function getStringSegment($segment)
    {
        $CI =& get_instance();
        return $CI->uri->segment($segment);
    }
}

if (!function_exists('printArray')) {
    function printArray($arr, $isDie = false)
    {
        echo '<pre>';
        print_r($arr);
        if ($isDie == true) {
            die;
        }
    }
}

if (!function_exists('pr')) {
    function pr($data, $die=0)
    {
        if(!empty($data))
        {
            if(!empty($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] === '115.112.59.162' || strpos($_SERVER['REMOTE_ADDR'],'192.168') == 0)
            {
                echo '<pre style="text-align: left; display: block; background-color:#f1acb1; text-transform: none; ">';
                print_r($data);
                echo '</pre>';

                if($die)
                {
                    exit('जब तुम पैदा हुए थे तो तुम रोए थे जबकि पूरी दुनिया ने जश्न मनाया था| अपना जीवन ऐसे जियो कि तुम्हारी मौत पर पूरी दुनिया रोए और तुम जश्न मनाओ');
                }
            }

        }

    }
}

if (!function_exists('getConfigValues')) {
    function getConfigValues($key)
    {
        $CI =& get_instance();
        return $CI->config->item($key);
    }
}

if (!function_exists('createPagination')) {
    function createPagination($url, $totalRows, $perPage, $segment, $queryString = '', $config = array(), $extraParameter = '')
    {
        $CI =& get_instance();
        $CI->load->library('pagination');
        $config['base_url'] = base_url() . $url;
        $config['total_rows'] = $totalRows;
        $config['per_page'] = $perPage;
        $config['uri_segment'] = $segment;
        $config['extraParameter'] = $extraParameter;
        if (!empty($queryString) && count($queryString) > 0) $config['suffix'] = '?' . http_build_query($queryString, '', "&");
        $CI->pagination->initialize($config);
        return $CI->pagination->create_links();
    }
}
function customPagination()
{
    $CI =& get_instance();
    $CI->load->library('pagination');
    $config['full_tag_open'] = '<ul class="pagination  pagination-sm m-t-none m-b-none">';
    $config['full_tag_close'] = '</ul>';
    $config['prev_link'] = '<i class="fa fa-chevron-left"></i>';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';
    $config['next_link'] = '<i class="fa fa-chevron-right"></i>';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><a href="#">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';

    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';

    $config['first_link'] = '<i class="fa fa-chevron-left"></i> <i class="fa fa-chevron-left"></i>';
    $config['last_link'] = '<i class="fa fa-chevron-right"></i><i class="fa fa-chevron-right"></i>';
    $CI->pagination->initialize($config);
}

if (!function_exists('sendMail')) {
    function sendMail($subject, $mailContent, $mailTo, $mailFromId, $mailFromName)
    {
        $mailTo=implode(',',$mailTo);
        $CI =& get_instance();
        $CI->load->library('email');
        $config['priority'] = '1';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        $CI->email->clear(TRUE);
        $CI->email->initialize($config);
        $CI->email->from($mailFromId, $mailFromName);
        $CI->email->to($mailTo);
        $CI->email->subject($subject);
        $CI->email->message($mailContent);
        $CI->email->send();
    }
}

if (!function_exists('setSessionFlashData')) {
    function setSessionFlashData($key, $val = '')
    {
        $CI =& get_instance();
        if (is_array($key)) {
            $CI->session->set_flashdata($key);
        } else {
            $CI->session->set_flashdata($key, $val);
        }
    }
}
if (!function_exists('SendEmailByTemplate')) {
    function SendEmailByTemplate($template_id, $email_keywords = array(), $mailTo, $mailFrom, $mailFromName)
    {
        $obj =& get_instance();
        $strSQL = "SELECT * FROM tbl_email_templates WHERE id =" . $template_id;
        $resSQL = $obj->db->query($strSQL);
        if ($resSQL->num_rows() > 0) {
            $result = $resSQL->result_array();
            $msg_body = $result[0]['email_content'];
            $msg_subject = $result[0]['email_subject'];
            if (is_array($email_keywords)) {
                foreach ($email_keywords as $key => $value) {
                    $msg_body = str_replace("[" . $key . "]", $value, $msg_body);
                    $msg_subject = str_replace("[" . $key . "]", $value, $msg_subject);
                }
            }
            $CI =& get_instance();
            $CI->load->library('email');
            $config['priority'] = '3';
            $config['charset'] = 'iso-8859-1';
            $config['wordwrap'] = TRUE;
            $config['mailtype'] = 'html';
            $CI->email->initialize($config);
            $CI->email->from($mailFrom, $mailFromName);
            $CI->email->to($mailTo);
            $CI->email->subject($msg_subject);
            $CI->email->message($msg_body);
            @$CI->email->send();
            return true;
        } else {

            return false;
        }

    }
}
if (!function_exists('SendNotificationByTemplate')) {
    function SendNotificationByTemplate($template_id, $email_keywords = array())
    {
        $obj =& get_instance();
        $strSQL = "SELECT * FROM tbl_email_templates WHERE id =" . $template_id;
        $resSQL = $obj->db->query($strSQL);
        if ($resSQL->num_rows() > 0) {
            $result = $resSQL->result_array();
            $msg_content = $result[0]['email_content'];
            if (is_array($email_keywords)) {
                foreach ($email_keywords as $key => $value) {
                    $msg_content = str_replace("[" . $key . "]", $value, $msg_content);
                }
            }
            return $msg_content;
        } else {

            return false;
        }

    }
}
//if (!function_exists('encrypt')) {
//    function encrypt($decrypted, $password, $salt = 'otMiEQuHHyugzoK2wHopDxNthWfiJnsWL9lCC')
//    {
//        // Build a 256-bit $key which is a SHA256 hash of $salt and $password.
//        $key = hash('SHA256', $salt . $password, true);
//        // Build $iv and $iv_base64.  We use a block size of 128 bits (AES compliant) and CBC mode.  (Note: ECB mode is inadequate as IV is not used.)
//        srand();
//        $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC), MCRYPT_RAND);
//        if (strlen($iv_base64 = rtrim(base64_encode($iv), '=')) != 22) return false;
//        // Encrypt $decrypted and an MD5 of $decrypted using $key.  MD5 is fine to use here because it's just to verify successful decryption.
//        $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $decrypted . md5($decrypted), MCRYPT_MODE_CBC, $iv));
//        // We're done!
//        return $iv_base64 . $encrypted;
//    }
//}


//if (!function_exists('encrypt')) {
//    function encrypt($decrypted, $password, $salt = 'otMiEQuHHyugzoK2wHopDxNthWfiJnsWL9lCC')
//    {
//        // Build a 256-bit $key which is a SHA256 hash of $salt and $password.
//        $key = hash('SHA256', $salt . $password, true);
//        // Build $iv and $iv_base64.  We use a block size of 128 bits (AES compliant) and CBC mode.  (Note: ECB mode is inadequate as IV is not used.)
//        srand();
//        $iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC), MCRYPT_RAND);
//        if (strlen($iv_base64 = rtrim(base64_encode($iv), '=')) != 22) return false;
//        // Encrypt $decrypted and an MD5 of $decrypted using $key.  MD5 is fine to use here because it's just to verify successful decryption.
//        $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $decrypted . md5($decrypted), MCRYPT_MODE_CBC, $iv));
//        // We're done!
//        return $iv_base64 . $encrypted;
//    }
//}


//function decrypt($encrypted, $salt = 'otMiEQuHHyugzoK2wHopDxNthWfiJnsWL9lCC')
//{
//    $password = ENCY_PASSWORD;
//    // Build a 256-bit $key which is a SHA256 hash of $salt and $password.
//    $key = hash('SHA256', $salt . $password, true);
//    // Retrieve $iv which is the first 22 characters plus ==, base64_decoded.
//    $iv = base64_decode(substr($encrypted, 0, 22) . '==');
//    // Remove $iv from $encrypted.
//    $encrypted = substr($encrypted, 22);
//    // Decrypt the data.  rtrim won't corrupt the data because the last 32 characters are the md5 hash; thus any \0 character has to be padding.
//    $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, base64_decode($encrypted), MCRYPT_MODE_CBC, $iv), "\0\4");
//    // Retrieve $hash which is the last 32 characters of $decrypted.
//    $hash = substr($decrypted, -32);
//    // Remove the last 32 characters from $decrypted.
//    $decrypted = substr($decrypted, 0, -32);
//    // Integrity check.  If this fails, either the data is corrupted, or the password/salt was incorrect.
//    if (md5($decrypted) != $hash) return false;
//    // Yay!
//    return $decrypted;
//}

function encrypt($value){
    $obj =& get_instance();
    $obj->load->library('encryption');
    $encrypted=$obj->encryption->encrypt($value);
    return $encrypted;
}
function decrypt($value){
    $obj =& get_instance();
    $obj->load->library('encryption');
    $decrypted=$obj->encryption->decrypt($value);
    return $decrypted;
}

if (!function_exists('get_local_time')) {
    function get_local_time($value = '', $row, $format = 'dS M, Y', $timezone = 'UP55')
    {
        if ($row == 'added_on') {
            $value = date($format, gmt_to_local(strtotime($value), $timezone));
        } elseif ($row == 'created_on') {
            $value = date($format, gmt_to_local(strtotime($value), $timezone));
        } elseif ($row == 'timestamp') {
            $value = date($format, gmt_to_local(strtotime($value), $timezone));
        } elseif ($row == 'last_login') {
            $value = date($format, gmt_to_local(strtotime($value), $timezone));
        } elseif ($row == 'expire_on') {
            $value = date($format, gmt_to_local(strtotime($value), $timezone));
        }
        return $value;
    }
}
if (!function_exists('get_status')) {
    function get_status($value, $row)
    {
        switch ($row->status) {
            case '0':
                return '<span title="Active" class="label bg-warning">Inactive</span>';
            case '1':
                return '<span title="Active" class="label bg-success">Active</span>';
        }
    }
}

if (!function_exists('set_local_to_gmt')) {
    function set_local_to_gmt($time = '')
    {
        if ($time == '') {
            $time = time();
        }
        $value = date('Y-m-d H:i:s', local_to_gmt($time));
        return $value;
    }
}


if (!function_exists('isLoggedIn')) {
    function isLoggedIn($type = 'user')
    {
        $CI =& get_instance();
        $CI->load->library('auth');
        if (!$CI->auth->loggedin($type)) {
            if ($type == 'admin') {
                setSessionFlashData('error', 'Whoops! This is a secure panel, Please login to access Admin Panel.');
                redirect(base_url('admin/login'));
            }
            else if ($type == 'salon') {
                setSessionFlashData('error', 'Whoops! This is a secure panel, Please login to access Salon Panel.');
                redirect(base_url('salon/login'));
            }
            else {
                setSessionFlashData('error', 'Whoops! Please login to access member area.');
                redirect(base_url('user/login'));
            }
        }

        $id = $CI->auth->userid($type);
        if ($type == 'admin') {
            $CI->load->model('admin_model');
            $user = $CI->admin_model->get('id', $id);
        }
       else if ($type == 'salon') {
            $CI->load->model('salon_model');
            $user = $CI->salon_model->getData($id);
        }
        else {
            $CI->load->model('user_model');
            $user = $CI->user_model->get('id', $id);
        }
        $CI->session->set_userdata(array('auth_' . $type . '_data' => $user));
    }
}



if (!function_exists('get_lat_long')) {
    function get_lat_long($postal_code) {
        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode("singapore ".$postal_code)."&sensor=false&key=".GOOGLE_MAP_API_KEY;
        $result_string = file_get_contents($url);
        $result = json_decode($result_string, true);
        
        $zipLat = 0.00;
        $ziplng = 0.00; 
        
        if(!empty($result['results'])){
            $zipLat = $result['results'][0]['geometry']['location']['lat'];
            $ziplng = $result['results'][0]['geometry']['location']['lng'];
        }

        $data["lat"] = $zipLat;
        $data["lng"] = $ziplng;
        return  $data;

    }
}

if (!function_exists('convert_time_to_second')) {
    function convert_time_to_second($time)
    {
        if($time)
        {
            $time_array = explode(':',$time);
            $timeinSec = $time_array[0]*60*60+$time_array[1]*60;
            return $timeinSec;
        }else{
            return 0;
        }

    }

}
if (!function_exists('convert_second_to_time')) {
    function convert_second_to_time($time,$f=':')
    {
        return sprintf("%02d%s%02d", floor($time/3600), $f, ($time/60)%60);

    }

}

if (!function_exists('convert_seconds')) {
    function convert_seconds($seconds)
    {
        $dt1 = new DateTime("@0");
        $dt2 = new DateTime("@$seconds");
        $diff = $dt1->diff($dt2);
        //printArray($diff->i,1);
        if($diff->h)
        {
            return $diff->format('%h h, %i min');
        }else if($diff->i)
        {
            return $diff->format('%i min, %s sec');
        }

    }
}
if(!function_exists('time_format'))
{
    function time_format($seconds){
        $hours = floor($seconds / 3600);
        $mins = floor(($seconds - $hours*3600) / 60);
        $s = $seconds - ($hours*3600 + $mins*60);

        $mins = ($mins<10?"0".$mins:"".$mins);
        $s = ($s<10?"0".$s:"".$s);

        $time = ($hours>0?$hours.":":"").$mins.":".$s;
        return $time;
    }
}

if (!function_exists('day_index')) {
    function day_index($date)
    {
        $day_number = date('w', strtotime($date));
        return $day_number;

    }
}




if(!function_exists('get_Address')){

    function get_Address($lat, $lon) {

        $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$lon&sensor=false&key=AIzaSyA7Cl0a7Gcuqxvvl9TnXH-xrBm8yOdu6aM";
// Make the HTTP request
        $data = @file_get_contents($url);
// Parse the json response
        $jsondata = json_decode($data,true);

// If the json data is invalid, return empty array
        if($jsondata["status"] == "OK") {
            return $jsondata["results"][0]["formatted_address"];
        }
        else{
            return array();
        }


    }

}
if (!function_exists('genRandomBytes')) {
    function genRandomBytes($length = 16)
    {
        $sslStr = '';
        /*
         * if a secure randomness generator exists and we don't
         * have a buggy PHP version use it.
         */
        if (function_exists('openssl_random_pseudo_bytes')
            && (version_compare(PHP_VERSION, '5.3.4') >= 0 || IS_WIN)
        ) {
            $sslStr = openssl_random_pseudo_bytes($length, $strong);
            if ($strong) {
                return $sslStr;
            }
        }

        /*
         * Collect any entropy available in the system along with a number
         * of time measurements of operating system randomness.
         */
        $bitsPerRound = 2;
        $maxTimeMicro = 400;
        $shaHashLength = 20;
        $randomStr = '';
        $total = $length;

        // Check if we can use /dev/urandom.
        $urandom = false;
        $handle = null;

        // This is PHP 5.3.3 and up
        if (function_exists('stream_set_read_buffer') && @is_readable('/dev/urandom')) {
            $handle = @fopen('/dev/urandom', 'rb');
            if ($handle) {
                $urandom = true;
            }
        }

        while ($length > strlen($randomStr)) {
            $bytes = ($total > $shaHashLength) ? $shaHashLength : $total;
            $total -= $bytes;
            /*
             * Collect any entropy available from the PHP system and filesystem.
             * If we have ssl data that isn't strong, we use it once.
             */
            $entropy = rand() . uniqid(mt_rand(), true) . $sslStr;
            $entropy .= implode('', @fstat(fopen(__FILE__, 'r')));
            $entropy .= memory_get_usage();
            $sslStr = '';
            if ($urandom) {
                stream_set_read_buffer($handle, 0);
                $entropy .= @fread($handle, $bytes);
            } else {
                /*
                 * There is no external source of entropy so we repeat calls
                 * to mt_rand until we are assured there's real randomness in
                 * the result.
                 *
                 * Measure the time that the operations will take on average.
                 */
                $samples = 3;
                $duration = 0;
                for ($pass = 0; $pass < $samples; ++$pass) {
                    $microStart = microtime(true) * 1000000;
                    $hash = sha1(mt_rand(), true);
                    for ($count = 0; $count < 50; ++$count) {
                        $hash = sha1($hash, true);
                    }
                    $microEnd = microtime(true) * 1000000;
                    $entropy .= $microStart . $microEnd;
                    if ($microStart > $microEnd) {
                        $microEnd += 1000000;
                    }
                    $duration += $microEnd - $microStart;
                }
                $duration = $duration / $samples;

                /*
                 * Based on the average time, determine the total rounds so that
                 * the total running time is bounded to a reasonable number.
                 */
                $rounds = (int)(($maxTimeMicro / $duration) * 50);

                /*
                 * Take additional measurements. On average we can expect
                 * at least $bitsPerRound bits of entropy from each measurement.
                 */
                $iter = $bytes * (int)ceil(8 / $bitsPerRound);
                for ($pass = 0; $pass < $iter; ++$pass) {
                    $microStart = microtime(true);
                    $hash = sha1(mt_rand(), true);
                    for ($count = 0; $count < $rounds; ++$count) {
                        $hash = sha1($hash, true);
                    }
                    $entropy .= $microStart . microtime(true);
                }
            }

            $randomStr .= sha1($entropy, true);
        }

        if ($urandom) {
            @fclose($handle);
        }

        return substr($randomStr, 0, $length);
    }
}
if (!function_exists('genRandomPassword')) {
    function genRandomPassword($length = 8)
    {
        $salt = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $base = strlen($salt);
        $makepass = '';

        /*
         * Start with a cryptographic strength random string, then convert it to
         * a string with the numeric base of the salt.
         * Shift the base conversion on each character so the character
         * distribution is even, and randomize the start shift so it's not
         * predictable.
         */
        $random = genRandomBytes($length + 1);
        $shift = ord($random[0]);
        for ($i = 1; $i <= $length; ++$i) {
            $makepass .= $salt[($shift + ord($random[$i])) % $base];
            $shift += ord($random[$i]);
        }

        return $makepass;
    }
}



if(!function_exists('getLanguageValue')){
    function getLanguageValue($key,$lang_id=1)
    {
        $data = '';
        $obj =&get_instance();
        $obj->db->select('lv.*');
        $obj->db->from('tbl_language_values as lv');
        $obj->db->join('tbl_language_keys as lk','lv.lang_keyid = lk.id','INNER');
        $obj->db->where(array('lk.title'=>$key,'lv.lang_id'=>$lang_id));
        $resSQL = $obj->db->get('tbl_language_values');
        $result=array();
        if ($resSQL->num_rows() > 0)
        {
            $data = $resSQL->row_array()['lang_value'];
        }
        return $data;
    }
}

if(!function_exists('getLanguageByCode')){
    function getLanguageByCode($languageCode)
        {
            $return = array();
            $obj =&get_instance();
            $obj->db->select('lk.title as LangKey,lv.lang_value as LangValue');
            $obj->db->from('tbl_languages as l');
            $obj->db->join('tbl_language_values as lv','l.id = lv.lang_id','INNER');
            $obj->db->join('tbl_language_keys as lk','lv.lang_keyid = lk.id','INNER');
            $obj->db->where(array('l.shortcode'=>$languageCode));
            $resSQL = $obj->db->get();
            if ($resSQL->num_rows() > 0)
                {
                    foreach ($resSQL->result_array() as $row)
                        {
                            $return[trim($row['LangKey'])] = trim($row['LangValue']);
                        }
                }
            return $return;
        }
}

if(!function_exists('refineSearchString')) {
    function refineSearchString($strForRefine)
    {

        $srcName = '';
        $refinedString = '';
        $disAllowChars = array(';', ':', '/', ',', '>', '<', '!', '@', '#', '$', '%', '^', '&', '*', '(', ')', '\'', '_', '=', '"');
        $refinedString = str_replace($disAllowChars, ' ', preg_replace('/[^A-Za-z0-9\-\.\']/', ' ', $strForRefine));
        //$refinedString = str_replace('-',' ',preg_replace('/[^A-Za-z0-9\-\']/',' ', $strForRefine));
        if (strlen(trim($refinedString)) > 0) {
            $srcNam_old = explode(' ', $refinedString);
            if ($srcNam_old) {
                foreach ($srcNam_old as $s) {
                    if (strlen($s) >= 1) {
                        $srcName[] = $s;
                    }
                }
            }
        }
        return $srcName;

    }
}

if(!function_exists('MakeSearchqry')) {
    function MakeSearchqry($field_name = array(), $value)
    {
        $obj = &get_instance();
        $BeforeRefinedString = $value;
        $if_condition = '';
        $refinedStringArr = refineSearchString($value);
        if ($field_name && $refinedStringArr) {
            $value = implode(' ', $refinedStringArr);
            $f = 0;
            $count = 1;
            $finalElseClause = "0";
            $if_condition = '';
            $brackitclosecount = '';


            foreach ($field_name as $field) {
                if (count($refinedStringArr)) {
                    //$this->db->escape($BeforeRefinedString)
                    $if_condition .= "if( " . $field . " = " . $obj->db->escape($BeforeRefinedString) . " ," . $count . ",if( " . $field . " LIKE " . $obj->db->escape($BeforeRefinedString . '%') . "," . ($count + 1) . ",if( " . $field . " LIKE " . $obj->db->escape('%' . $BeforeRefinedString . '%') . "," . ($count + 2) . ",";
                    $brackitclosecount = $brackitclosecount + 3;
                    $count = $count + 2;
                    $count++;


                    if (count($refinedStringArr) > 0) {
                        $array_and = array();
                        foreach ($refinedStringArr as $StringArr) {
                            $array_and[] = ' ' . $field . ' LIKE "%' . $StringArr . '%" ';
                        }
                        if (!empty($array_and)) {
                            $if_condition .= " if(" . implode(' AND ', $array_and) . ", " . $count . ", ";
                            $brackitclosecount++;
                            $count++;
                        }
                    }

                    if (count($refinedStringArr) > 1) {
                        $innerCount = $count;
                        for ($i = 0; $i < count($refinedStringArr); $i++) {
                            $if_condition .= " if(" . $field . " LIKE '%" . $refinedStringArr[$i] . "%', " . $innerCount . ", ";
                            $brackitclosecount++;
                            $innerCount++;
                        }
                        $count++;
                    }
                }

                if (count($field_name) == ($f + 1)) {
                    $if_condition .= $finalElseClause . str_repeat(" ) ", $brackitclosecount);
                }

                $f++;
            }
        }

        return $if_condition;

    }
}


if(!function_exists('refine_input_data')) {
    function refine_input_data($input_data) {
        if(is_array($input_data)) {
            array_walk_recursive($input_data, function(&$val) {
                $val = htmlentities($val, ENT_QUOTES, "UTF-8") ;
            });
        }else{
            htmlentities($input_data, ENT_QUOTES, "UTF-8");
        }
        return $input_data;
    }
}
if (!function_exists('id_from_slug')) {
    function id_from_slug($slug = '')
    {
        $id = false;
        if ($slug !== '') {
            $keywords = preg_split("/[,]+/", $slug);
            $count = count($keywords);
            $offset = $count - 1;
            $id = (int)$keywords[$offset];
        }
        return $id;
    }
}


if (!function_exists('getLastNumber')) {
    function getLastNumber($string)
    {
        $value = false;
        if (!is_numeric($string)) {
            $rawArray = explode('-', $string);
            $total = count($rawArray);
            $offset = $total - 1;
            if (is_numeric($rawArray[$offset])) {
                $value = $rawArray[$offset];
            }
        } else {
            $value = $string;
        }
        return $value;
    }
}


if (!function_exists('create_breadcrumb')) {
    function create_breadcrumb()
    {
        $ci = &get_instance();
        $i = 1;
        $uri = $ci->uri->segment($i);
        $link = '<div class="nav">
        <ul class="nav nav-pills">
        <li>
        <a href="' . base_url() . '" title="Grofer Home">
        <i class="fa fa-home"></i>Home <i class="fa fa-caret-right"></i>
        </a>
        </li>
        ';
        while ($uri != '') {
            $prep_link = '';
            for ($j = 1; $j <= $i; $j++) {
                $prep_link .= $ci->uri->segment($j) . '/';
            }
            if ($ci->uri->segment($i + 1) == '') {
                $link .= '<li><a class="current" href="' . base_url($prep_link) . '">';
                $link .= ucfirst($ci->uri->segment($i)) . '</a> </li>';
            } else {
                $link .= '<li> <a href="' . base_url($prep_link) . '">';
                $link .= ucfirst($ci->uri->segment($i)) . ' <i class="fa fa-caret-right"></i></a> </li>';
            }
            $i++;
            $uri = $ci->uri->segment($i);
        }
        $link .= '</ul></div>';
        return $link;
    }
}


if (!function_exists('custom_breadcrumb')) {
    function custom_breadcrumb($breadArray = array())
    {
        if (empty($breadArray)) {
            return create_breadcrumb();
        } else {
            $ci = &get_instance();
            $i = 1;
            $uri = $ci->uri->segment($i);
            $link = '<div class="nav">
        <ul class="nav nav-pills">
        <li>
        <a href="' . base_url() . '" title="Grofer Home">
        <i class="fa fa-home"></i>Home <i class="fa fa-caret-right"></i>
        </a>
        </li>
        ';
            $count = count($breadArray);
            $i = 1;
            foreach ($breadArray AS $key => $value) {
                if ($count == $i) {
                    $link .= '<li><a class="current" href="' . strtolower($value) . '">';
                    $link .= ucfirst($key) . '</a> </li>';
                } else {
                    $link .= '<li> <a href="' . strtolower($value) . '">';
                    $link .= ucfirst($key) . ' <i class="fa fa-caret-right"></i></a> </li>';
                }
                $i++;
            }
            $link .= '</ul></div>';
            return $link;
        }
    }
}

if (!function_exists('PageDetailById')) {
    function PageDetailById($id)
    {
        $ci = &get_instance();
        $query = $ci->db->get_where('tbl_pages', array('id' => $id));
        return $query->row_array();
    }
}

if (!function_exists('filter_params')) {
    function filter_params($paramsRaw, $dbParams)
    {
        if (array_key_exists('format', $paramsRaw)) {
            unset($paramsRaw['format']);
        }
        $filterArray = array();
        if (!empty($paramsRaw)) {
            foreach ($paramsRaw AS $key => $value) {
                if (array_key_exists($key, $dbParams)) {
                    $filterArray[$dbParams[$key]] = $value;
                }
            }
        }
        return $filterArray;
    }
}

if (!function_exists('filter_validation_errors')) {
    function filter_validation_errors()
    {
        $rawMsg = validation_errors();
        $errorMsg = '';
        if ($rawMsg) {
            $errorMsg = strip_tags(validation_errors(), '\n');
        }
        return $errorMsg;
    }
}
if (!function_exists('isValidToken')) {
    function isValidToken($token,$params = array()){
        $obj =& get_instance();
        $device_id=$obj->input->get_post('Device-Id');
        $device_type=$obj->input->get_post('Device-Type');
        $device_type = isset($device_type) ? $device_type : $obj->input->get_request_header('Device-Type');
        $device_id = isset($device_id) ? $device_id : $obj->input->get_request_header('Device-Id');
        $obj->load->model('common_model');
        $return = false;
        $token = str_replace(' ', '+', $token);
        if($token !=''){
            $rawData = decrypt($token);
            if($rawData != false){
                $data = json_decode($rawData);

                if (empty($params)) {
                    $select = 'id,status,password';
                } else {
                    $select = implode(',', $params);

                }

                unset($data->timestamp);
                $conditions = array();
                foreach($data as $filed => $value) {

                        $conditions[$filed] = $value;

                }
                if(isset($conditions['merchant_id'])){
                    unset($conditions['merchant_id']);
                }

                if (isset($data)) {
                    $current_controller = $obj->uri->segment(4);

                    if($current_controller!='login') {
                        if ($device_type == 'a') {
                            $conditions['android_id'] = $device_id;
                            $conditions['device_type'] = 'a';
                        } else {
                            $conditions['iphone_id'] = $device_id;
                            $conditions['device_type'] = 'i';
                        }
                    }
                    $userData = $obj->common_model->_select('users', $select,$conditions,'id','desc');
                    
                   
                   /* echo $obj->db->last_query();
                    die;*/

                    if (!empty($userData)) {
                        $return = $userData[0];
                    }
                }
            }
        }
        return $return;
    }
}

if (!function_exists('getCategoryServices')) {
    function getCategoryServices($cat_id)
    {
        $obj =& get_instance();
        $table = 'tbl_services';
        $select = array('id','service_name_en','service_name_ar');
        $conditions = array('cat_id'=>$cat_id);
        $catServiceData = $obj->common_model->_select($table, $select,$conditions,'id','desc');

        return $catServiceData;
    }
}



if (!function_exists('dateFormat')) {
    function dateFormat($date_value)
    {
        $formatted_date = date('Y-m-d', strtotime($date_value));
        return $formatted_date;
    }
}


if (!function_exists('is_group_allowed')) {
    function is_group_allowed($perm_par, $type = 'read', $group_par = FALSE)
    {
        $ci = & get_instance();
        $ci->load->model('role_model');
        $return = $ci->role_model->is_group_allowed($perm_par, $type, $group_par);
        return $return;
    }
}
if (!function_exists('getRadius')) {
    function getRadius($lat,$lng)
    {
        $result=[];
        $rad=ADMIN_LAT_LONG_REDIUS; // circle radius in km
        $R=6371;//earth radius in km always fixed
        $maxLat = $lat + rad2deg($rad/$R);
        $minLat = $lat - rad2deg($rad/$R);
        $maxLon = $lng + rad2deg(asin($rad/$R) / cos(deg2rad($lat)));
        $minLon = $lng - rad2deg(asin($rad/$R) / cos(deg2rad($lat)));
        $result['maxLat']=$maxLat;
        $result['minLat']=$minLat;
        $result['maxLon']=$maxLon;
        $result['minLon']=$minLon;
        return $result;
    }
}
if (!function_exists('GetTemplate')) {
    function GetTemplate($template_id, $keywords = array())
    {

        $obj =& get_instance();
        $strSQL = "SELECT * FROM tbl_email_templates WHERE id =" . $template_id;
        $resSQL = $obj->db->query($strSQL);
        if ($resSQL->num_rows() > 0) {
            $result = $resSQL->result_array();
            $msg_body = $result[0]['email_content'];
            if (is_array($keywords)) {
                foreach ($keywords as $key => $value) {
                    $msg_body = str_replace("[" . $key . "]", $value, $msg_body);
                }
            }

            return $msg_body;
        } else {
            return false;
        }

    }
}
if( !function_exists('convert_sqltime_to_calnderdate'))
{
    function convert_sqltime_to_calnderdate($datetimestamp)
    {
        return  date("M d, Y", strtotime($datetimestamp));
    }
}
if( !function_exists('convert_sqltime_to_calnderdatetime'))
{
    function convert_sqltime_to_calnderdatetime($datetimestamp)
    {
        return  date("h:i a", strtotime($datetimestamp));
    }
}
if (!function_exists('SetCondition')) {
    function SetCondition($key,$condition=true)
    {
        if(!empty($key)) {
            $CI =& get_instance();
            if (is_array($key)) {
                if (!empty($key['like']) && isset($key['like'])) {
                        $CI->db->like($key['like']);
                    }
                }
                if (!empty($key['equal']) && isset($key['equal'])) {
                       $CI->db->where($key['equal']);
                }
                if (!empty($key['in']) && isset($key['in'])) {
                    foreach($key['in'] as $keyin=>$value){
                        $CI->db->where_in($keyin,$value);
                    }
                      //  $CI->db->where_in($key['column'],$key['in']);
                }
                if (!empty($key['range']) && isset($key['range'])) {
                    if(isset($key['range']['pointmin'])){
                        $column=$key['range']['point'];
                        $min=$key['range']['pointmin'];
                        $max=$key['range']['pointmax'];
                        $CI->db->where($column.' BETWEEN "'. $min. '" and "'. $max.'"');
                    }
                    if(isset($key['range']['amountmin'])){
                        $column=$key['range']['amount'];
                        $min=$key['range']['amountmin'];
                        $max=$key['range']['amountmax'];
                        $CI->db->where($column.' BETWEEN "'. $min. '" and "'. $max.'"');
                    }
                    if(isset($key['range']['datemin'])){
                        $column='tb.added_on';
                        $min=$key['range']['datemin'];
                        $max=$key['range']['datemax'];
                        $CI->db->where($column.' BETWEEN "'. $min. '" and "'. $max.'"');
                    }
                    if(isset($key['range']['bookingdatemin'])){
                        $column='tb.booking_date';
                        $min=$key['range']['bookingdatemin'];
                        $max=$key['range']['bookingdatemax'];
                        $CI->db->where($column.' BETWEEN "'. $min. '" and "'. $max.'"');
                    }
                }
            if($condition==true){
                if (!empty($key['sort']) && isset($key['sort'])) {
                    $CI->db->order_by($key['sort']['field'], $key['sort']['order']);

                } else {
                    $CI->db->order_by('id', 'desc');
                }
            }

        }
        else {
                return false;
        }
    }
}
if (!function_exists('ModifyCondition')) {
    function ModifyCondition($FormData)
    {
       // printArray($FormData,1);
        $ConditionArray=array();
        if (!empty($FormData) && isset($FormData['like']) && $FormData['like'] != '') {
            foreach ($FormData['like'] as $likeKey => $like) {
                if (strpos($likeKey, '.') !== false){
                    $likeKey=str_replace(".","-",$likeKey);
                }
                if ($FormData['like'][$likeKey] != '') {
                    $ConditionArray['like'][$likeKey] = trim($like);
                }
            }
        }
        if (!empty($FormData) && isset($FormData['range']) && $FormData['range'] != '') {
            foreach ($FormData['range'] as $likeKey => $like) {
                if (strpos($likeKey, '.') !== false){
                    $likeKey=str_replace(".","-",$likeKey);
                }
                if ($FormData['range'][$likeKey] != '') {
                    $ConditionArray['range'][$likeKey] = trim($like);
                }
            }
        }
        if (!empty($FormData) && isset($FormData['equal']) && $FormData['equal'] != '') {
            foreach ($FormData['equal'] as $key => $status) {
                if (strpos($key, '.') !== false){
                    $key=str_replace(".","-",$key);
                }
                if($key=='status' || $key=='type' || $key=='r-status' || $key=='a-vehicle_type' || $key=='r-ride_type'){
                    if ($status == '0' || $status == '1' || $status == '2' || $status == '3' || $status == '4' ) {
                        $ConditionArray['equal'][$key] = $status;
                    }
                }
                else if($status!='') {
                    $ConditionArray['equal'][$key] = $status;
                }
            }
        }
        if (!empty($FormData) && isset($FormData['sort']) && $FormData['sort'] != '') {
            foreach ($FormData['sort'] as $equalKey => $equal) {
                if (strpos($equalKey, '.') !== false){
                    $equalKey=str_replace(".","-",$equalKey);
                }
                if ($equal != '') {
                    $ConditionArray['sort'][$equalKey] = trim($equal);
                }
            }
        }
        if (!empty($FormData) && isset($FormData['in']) && $FormData['in'] != '') {
            foreach ($FormData['in'] as $inKey => $in) {
                if (strpos($inKey, '.') !== false){
                    $inKey=str_replace(".","-",$inKey);
                }
                if ($in != '') {
                    $ConditionArray['in'][$inKey] = $in;
                }
            }
        }
        return $ConditionArray;
    }
}

if (!function_exists('send_notification')) {
    function send_notification($registatoin_ids, $message)
    {
        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'passphrase', '');
        stream_context_set_option($ctx, 'ssl', 'local_cert', 'cert/ETAUser.pem');

        try {
            $fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);
        } catch (Exception $e) {
            $fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT, $ctx);

        }
        stream_set_blocking($fp, 1);
        if (!$fp) {
            echo "Failed to connect (stream_socket_client): $err $errstr";
        } else {
            $apple_expiry = time() + (90 * 24 * 60 * 60);
            foreach ($registatoin_ids as $key => $value) {
                $apple_identifier = $key;
                $deviceToken = $value;
                $payload = json_encode($message);
                $msg = pack("C", 1) . pack("N", $apple_identifier) . pack("N", $apple_expiry) . pack("n", 32) . pack('H*', str_replace(' ', '', $deviceToken)) . pack("n", strlen($payload)) . $payload;
                fwrite($fp, $msg);
            }
        }
        usleep(500000);
        fclose($fp);
        return true;
    }
}



function getAreaDetalisByPostalCode($postalCode){
    $url = SG_LOCATE_API_URL;
    
    $fields = array();
    $fields['APIKey']       = SG_LOCATE_API_KEY;
    $fields['APISecret']    = SG_LOCATE_API_SECRET;
    $fields['Postcode']     = $postalCode;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    $result = curl_exec($ch);
    curl_close($ch);
    return  $result;
}


function sendVerificationCode($verificationCode,$mobileNumber){
    $mobile_number = $mobileNumber;    
    $sms = urlencode("CASHVERTISE: Your verification code is ".$verificationCode); 
    $mobile = urlencode("+65".$mobile_number) ; 
    /*$url = "https://mx.fortdigital.net/http/send-message?username=83782&password=6yhn7ujm&to=".$mobile."&from=Cashvertise&message=".$sms;*/
     $url = "https://mx.fortdigital.net/http/send-message?username=83782&password=124563Abc&to=".$mobile."&from=Cashvertise&message=".$sms;
    
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($ch);
    curl_close($ch);
    return  $result;
}
 

if (!function_exists('getUrl')) {
    function getUrl($url){
        if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!='')
        {
            $url=$_SERVER['HTTP_REFERER'];
        }
        return $url;

    }

}

if(!function_exists("check_merchant_user")) {
    function check_merchant_user($id, &$message) {
        $Ci = &get_instance();
        $user_info = $Ci->common_model->_selectById("users","*", array("id" => $id));
        if($user_info) {
            if($user_info['status'] == '3') {
                $message = "User's account has been deleted.";
                return false;
            } elseif($user_info['status'] == '2') {
                $message = "User's account has been blocked. Please contact to administrator";
                return false;
            } elseif($user_info['status'] == '0') {
                $message = "User's account not activated yet. please activated your account first.";
                return false;
            } else if($user_info['user_type'] == 2) {
                $message = "User is not a merchant.";
                return false;
            } else{
                return true;
            }
        }else{
            $message = "User not found.";
            return false;
        }
    }
}


if(!function_exists("get_user_type")) {
    function get_user_type($type = 0) {
        $user_types = array("","Driver","User");
        return $user_types[$type];
    }
}
if(!function_exists("generateToken")) {

    /**
     * @desc generate token
     * @param $user
     * @return bool|string
     */
    function generateToken($user) {
        $tokenRaw = array(
            'email' =>  $user['email'],
            'status' =>  $user['status'],
            'timestamp' =>  time()
        );
        if(isset($user['merchant_id'])){
            $tokenRaw['merchant_id'] = $user['merchant_id'];    
        }   
        return encrypt(json_encode($tokenRaw), ENCY_PASSWORD);
    }
}
if (!function_exists('GetDrivingDistance')) {
    function GetDrivingDistance($lat1, $lat2, $long1, $long2)
    {
        $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=" . $lat1 . "," . $long1 . "&destinations=" . $lat2 . "," . $long2 . "&key=AIzaSyDa0547ic2xY3KU2UIl2mPR9dtW_hiVE64&mode=driving&language=en-EN";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $response_a = json_decode($response, true);
        //printArray($response_a,1);
        if( $response_a['rows'][0]['elements'][0]['status']=='OK') {
            $dist = $response_a['rows'][0]['elements'][0]['distance']['text'];

            $time = $response_a['rows'][0]['elements'][0]['duration']['text'];

            $time_value = $response_a['rows'][0]['elements'][0]['duration']['value'];

            return array('distance' => $dist, 'time' => $time, 'time_value' => round($time_value / 60));
        }
        else{
            return false;
        }
    }
}


if (!function_exists('getAddress')) {
    function getAddress($latitude, $longitude)
    {
        if (!empty($latitude) && !empty($longitude)) {
            //Send request and receive json data by address
            $geocodeFromLatLong = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng=' . trim($latitude) . ',' . trim($longitude) . '&sensor=false&key=AIzaSyDa0547ic2xY3KU2UIl2mPR9dtW_hiVE64');
            $output = json_decode($geocodeFromLatLong);
            $status = $output->status;
            //Get address from json data
            $address = ($status == "OK") ? $output->results[0]->formatted_address : '';
            //Return address of the given latitude and longitude
            if (!empty($address)) {
                //printArray($output);
                return $address;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
if (!function_exists('formattedAmount')) {
    function formattedAmount($amount, $precision = 2)
    {
        $sign = '';
        if ($amount < 0) {
            $sign = '-';
        }
        if ($amount == '') {
            $amount = 0;
        }

        // Remove anything that isn't a number or decimal point.
        $amount = trim(preg_replace('/([^0-9\.])/i', '', $amount));

        return $sign .  number_format($amount, $precision, '.', ',').' '.lang('bd');
    }
}
if (!function_exists('getSalonImages')) {
    function getSalonImages($salonId){
        $obj =& get_instance();
        $obj->load->model('common_model');
        $result = $obj->common_model->_select('tbl_media', '*', array('salon_id' => $salonId));
        if($result){
            return $result;
        }
        else{
            return false;
        }

    }

}
if (!function_exists('getServicePrice')) {
    function getServicePrice($serviceId){
        $obj =& get_instance();
        $obj->load->model('common_model');
        $result = $obj->common_model->_selectbyId('tbl_services', ' salon_price as price ', array('id' => $serviceId));
        if($result){
            return $result['price'];
        }
        else{
            return false;
        }

    }

}

if (!function_exists('getSalonServices')) {
    function getSalonServices($salon_id,$language,$serviceSearch='',$user_id='',$service_type=''){
        $conditionQry='';
        $currentDate=strtotime("now");
        $category=($language == 'arabic')?'cat_name_ar':'cat_name_en';
        $service=($language == 'arabic')?'service_name_ar':'service_name_en';
        $desp=($language == 'arabic')?'description_ar':'description_en';
        $obj =& get_instance();
        $obj->db->select("s.id,s.salon_id,s.cat_id,$service as service_name,$desp as description,$category as cat_name,salon_price as price,home_price as homeprice,s.time,s.status,s.added_on,service_type");
        $obj->db->from('tbl_services as s');
        $obj->db->join('tbl_categories as c','c.id=s.cat_id');
        $obj->db->where(array('salon_id'=>$salon_id,'s.status'=>'1'));
        if($service_type=='1'){
            $conditionQry="(service_type='1' OR service_type='3')";
        }
        else if($service_type=='2'){
            $conditionQry="(service_type='2' OR service_type='3')";
        }
        if($conditionQry!=''){
            $obj->db->where($conditionQry);
        }
        if($serviceSearch!=''){
            $subquery1="($service like '%$serviceSearch%' OR $service like '%$serviceSearch' OR $service like '$serviceSearch%')";
            $obj->db->where($subquery1);
        }
        $query=$obj->db->get();
        /*$sql=$obj->db->last_query();
        echo $sql;*/
        if($query->num_rows()>0){
            $services=$query->result_array();
            $categories=array();
            if($services){
                $i=0;
                foreach($services as $service){
                    //check service added in cart or not
                    if($user_id!='' && $service_type!='') {
                        $obj->db->select('ci.service_id');
                        $obj->db->from('tbl_cart as c');
                        $obj->db->join('tbl_cart_items as ci', 'ci.cart_id=c.id');
                        $obj->db->where(array('c.user_id' => $user_id,'service_id'=>$service['id'],'category_id'=>$service['cat_id'],'service_type'=>$service_type));
                        $query1=$obj->db->get();
                        if($query1->num_rows()>0){
                            $service['in_cart']=true;
                        }
                        else{
                            $service['in_cart']=false;
                        }

                    }


                    $services[$i]['offer']='';
                    $services[$i]['offer_price']='';
                    //get offer related to service
                    $obj->db->select('discount,offer_type');
                    $obj->db->from('tbl_offers as o');
                    $obj->db->join('tbl_offer_services as s','s.offer_id=o.id','left');
                    $obj->db->where(array('service_id'=>$service['id'],'salon_id'=>$salon_id));
                    $substring="start_date<=$currentDate and expire_date>=$currentDate";
                    $obj->db->where($substring);
                    $query1=$obj->db->get();

                    if($query1->num_rows()>0){
                        $data=$query1->row_array();
                        if($data){
                            $service['offer_type'] = $data['offer_type'];
                            if($data['offer_type']=='1'){
                                $service['offer'] = $data['discount'];
                                $service['offer_price'] = $data['discount'];
                            }
                            else {
                                $service['offer'] = $data['discount'];
                                $service['offer_price'] = $service['price'] - ($service['price'] * $data['discount'] / 100);
                            }
                            }
                        else{
                            $service['offer_type']='';
                            $service['offer']='';
                            $service['offer_price']='';
                        }
                    }
                    else{
                        $service['offer_type']='';
                        $service['offer']='';
                        $service['offer_price']='';
                    }
                    if (!isset($categories[$service['cat_id']])) {
                        $categories[$service['cat_id']]['id']=$service['cat_id'];
                        $categories[$service['cat_id']]['cat_name']=$service['cat_name'];
                        $categories[$service['cat_id']]['cat_services'][]=$service;

                    }
                    else{
                        $categories[$service['cat_id']]['cat_services'][]=$service;
                    }
                    $i++;
                }
                $rawArray = array();
                foreach ($categories as $filter) {
                    $rawArray[] = $filter;
                }

            }
            return $rawArray;
        }
        else{
            return false;
        }

    }
}
if (!function_exists('getOfferServices')) {
    //exclusive offer services
    function getOfferServices($offer_id,$salon_id,$language,$serviceSearch='',$user_id=''){
        $conditionQry='';
        $currentDate=strtotime("now");
        $category=($language == 'arabic')?'cat_name_ar':'cat_name_en';
        $service=($language == 'arabic')?'service_name_ar':'service_name_en';
        $desp=($language == 'arabic')?'description_ar':'description_en';
        $obj =& get_instance();
        $obj->db->select("s.id,s.salon_id,s.cat_id,$service as service_name,$desp as description,f.discount,$category as cat_name,price,s.time,s.status,s.added_on,service_type");
        $obj->db->from('tbl_exclusive_offers as f');
        $obj->db->join('tbl_exclusive_offer_categories as ec','f.id=ec.offer_id');
        $obj->db->join('tbl_services as s','s.id=ec.service_id');
        $obj->db->join('tbl_categories as c','c.id=s.cat_id');
        $obj->db->where(array('f.salon_id'=>$salon_id,'s.status'=>'1','f.id'=>$offer_id));
        if($conditionQry!=''){
            $obj->db->where($conditionQry);
        }
        if($serviceSearch!=''){
            $subquery1="($service like '%$serviceSearch%' OR $service like '%$serviceSearch' OR $service like '$serviceSearch%')";
            $obj->db->where($subquery1);
        }
        $query=$obj->db->get();

        if($query->num_rows()>0){
            $services=$query->result_array();
            $categories=array();
            if($services){
                $i=0;
                foreach($services as $service){
                    $discount=$service['price']*($service['discount']/100);
                    $service['service_price']=$service['price'];
                    $service['price']=$service['price']-$discount;
                    //check service added in cart or not
                    if($user_id!='') {
                        $obj->db->select('ci.service_id');
                        $obj->db->from('tbl_cart as c');
                        $obj->db->join('tbl_cart_items as ci', 'ci.cart_id=c.id');
                        $obj->db->where(array('c.user_id' => $user_id,'service_id'=>$service['id'],'category_id'=>$service['cat_id'],'service_type'=>'2'));
                        $query1=$obj->db->get();
                        if($query1->num_rows()>0){
                            $service['in_cart']=true;
                        }
                        else{
                            $service['in_cart']=false;
                        }

                    }

                    if (!isset($categories[$service['cat_id']])) {
                        $categories[$service['cat_id']]['id']=$service['cat_id'];
                        $categories[$service['cat_id']]['cat_name']=$service['cat_name'];
                        $categories[$service['cat_id']]['cat_services'][]=$service;

                    }
                    else{
                        $categories[$service['cat_id']]['cat_services'][]=$service;
                    }
                    $i++;
                }
                $rawArray = array();
                foreach ($categories as $filter) {
                    $rawArray[] = $filter;
                }

            }
            return $rawArray;
        }
        else{
            return false;
        }

    }
}
if(!function_exists('isFavoriteSalon')){
    function isFavoriteSalon($salon_id,$user_id){
        $obj =& get_instance();
        if ($obj->common_model->_selectById('tbl_user_favourite_salon', 'id', array('salon_id' => $salon_id, 'user_id' => $user_id))) {
            return true;
        }
        else{
            return false;
        }
    }
}
if(!function_exists('getSalonTiming')){
    function getSalonTiming($salon_id,$language='english',$daySearch=''){
        $day='d.day';
        if($language=='arabic'){
            $day='d.day_arabic';
        }
        $obj =& get_instance();
        $obj->db->select("st.*,$day as day");
        $obj->db->from('tbl_salontime as st');
        $obj->db->join('tbl_days as d','d.index=st.day');
        $obj->db->where(array('salon_id'=>$salon_id));
        if($daySearch!=''){
            $obj->db->where(array('st.id'=>$daySearch));
        }
        $query=$obj->db->get();
        if($query->num_rows()>0){
            $timing=$query->result_array();
            if($timing){
                $i=0;
                foreach($timing as $time){
                    $timing[$i]['start_time']=date('h:i a',strtotime(convert_second_to_time($time['work_start_time'])));
                    $timing[$i]['end_time']=date('h:i a',strtotime(convert_second_to_time($time['work_end_time'])));
                    $timing[$i]['break_start']=date('h:i a',strtotime(convert_second_to_time($time['break_start_time'])));
                    $timing[$i]['break_end']=date('h:i a',strtotime(convert_second_to_time($time['break_end_time'])));
                    $i++;
                }
                return $timing;

            }
            else{
                return false;
            }

        }
        else{
            return false;
        }
    }
}
if(!function_exists('getSalonPackages')){
    function getSalonPackages($salon_id,$language='english',$status=array(),$activeFlag=0,$user_id=''){
        /*$currentDate=strtotime("now");*/
        
        $currentDate=date("Y-m-d");
        $name='p.name_en';
        $service='s.service_name_en';
        $category='c.cat_name_en';
        if($language=='arabic'){
            $name='p.name_ar';
            $service='s.service_name_ar';
            $category='c.cat_name_ar';
        }
        $obj =& get_instance();
        $obj->db->select("p.id,$name as name,p.offer_type,p.discount,p.offer_price,p.service_price,p.start_date,p.expire_date,p.status");
        $obj->db->from('tbl_packages as p');
        $obj->db->where(array('p.salon_id'=>$salon_id));
        if($status) {
            $obj->db->where($status);
        }
        if($activeFlag) {
            /*$substring = "start_date<=$currentDate and expire_date>=$currentDate";*/
            $substring = "start_date<='".$currentDate."' and expire_date>='".$currentDate."'";
            $obj->db->where($substring);
        }
        $query=$obj->db->get();
        $sql=$obj->db->last_query();
       /*echo "<br/>".$sql;*/
        if($query->num_rows()>0){
            $packages=$query->result_array();
            if($packages){
                $i=0;
                foreach($packages as $package){
                    if($user_id!=''){
                        $obj->db->select('cp.package_id');
                        $obj->db->from('tbl_cart as c');
                        $obj->db->join('tbl_cart_packages as cp', 'cp.cart_id=c.id');
                        $obj->db->where(array('c.user_id' => $user_id,'package_id'=>$package['id']));
                        $query1=$obj->db->get();
                        if($query1->num_rows()>0){
                            $packages[$i]['in_cart']=true;
                        }
                        else{
                            $packages[$i]['in_cart']=false;
                        }
                    }

                   /*
                    $packages[$i]['start_date']=date('Y-m-d',$package['start_date']);
                    $packages[$i]['expire_date']=date('Y-m-d',$package['expire_date']);
                    */
                    $packages[$i]['start_date']=date('Y-m-d');
                    $packages[$i]['expire_date']=date('Y-m-d');
                    //get services
                    $obj->db->select("ps.service_id,ps.price,$service as service_name,$category as category_name");
                    $obj->db->from('tbl_package_services as ps');
                    $obj->db->join('tbl_services as s','s.id=ps.service_id','left');
                    $obj->db->join('tbl_categories as c','c.id=s.cat_id','left');
                    $obj->db->where(array('package_id'=>$package['id'],'s.status'=>'1','c.status'=>'1',));
                    $query1=  $obj->db->get();

                    if($query1->num_rows()>0){
                        $packages[$i]['services']= $query1->result_array();
                        $i++;
                    }

                }
                return $packages;

            }
            else{
                return false;
            }

        }
        else{
            return false;
        }
    }
}
if(!function_exists('getSalonOffers')){
    function getSalonOffers($salon_id,$language='english',$status=array(),$activeFlag=0){
        $currentDate=strtotime("now");
        $name='f.offer_title_en';
        $service='s.service_name_en';
        $category='c.cat_name_en';
        if($language=='arabic') {
            $name = 'f.offer_title_ar';
            $service='s.service_name_ar';
            $category='c.cat_name_ar';
        }
        $OffersFields  = "f.id,f.salon_id,f.offer_type,$name as name,f.offer_title_ar,f.discount,f.start_date,
                          f.expire_date,f.status,f.added_on,f.modified_on,
                          DATE_FORMAT(f.expire_date,'%m/%d/%Y') as format_expire_date,
                          DATE_FORMAT(f.start_date,'%m/%d/%Y')  as  format_start_date
                          ";
        $obj =& get_instance();
        /*$obj->db->select("f.id,$name as name,f.offer_type,f.discount,f.start_date,f.expire_date,f.status");*/
        $obj->db->select($OffersFields);
        $obj->db->from('tbl_offers as f');
        $obj->db->where(array('f.salon_id'=>$salon_id));
        if($status) {
            $obj->db->where($status);
        }
        if($activeFlag) {
            $substring = "start_date<=$currentDate and expire_date>=$currentDate";
            $obj->db->where($substring);
        }
        $query=$obj->db->get();
        if($query->num_rows()>0){
            $offers=$query->result_array();
            if($offers){
                $i=0;
                foreach($offers as $offer){
                    /*
                    $offers[$i]['start_date']=date('Y-m-d',$offer['start_date']);
                    $offers[$i]['expire_date']=date('Y-m-d',$offer['expire_date']);
                    */
                    $offers[$i]['start_date']= $offer['format_start_date'] ;
                    $offers[$i]['expire_date']= $offer['format_expire_date'] ;
                    //get services
                    $obj->db->select("ps.service_id,$service as service_name,$category as category_name");
                    $obj->db->from('tbl_offer_services as ps');
                    $obj->db->join('tbl_services as s','s.id=ps.service_id','left');
                    $obj->db->join('tbl_categories as c','c.id=s.cat_id','left');
                    $obj->db->where(array('offer_id'=>$offer['id'],'s.status'=>'1','c.status'=>'1',));
                    $query1=  $obj->db->get();

                    if($query1->num_rows()>0){
                        $packages[$i]['services']= $query1->result_array();
                        $i++;
                    }
                }
                return $offers;

            }
        }
        else{
            return false;
        }

    }
}
function randomColor ($minVal = 0, $maxVal = 255)
{

    // Make sure the parameters will result in valid colours
    $minVal = $minVal < 0 || $minVal > 255 ? 0 : $minVal;
    $maxVal = $maxVal < 0 || $maxVal > 255 ? 255 : $maxVal;

    // Generate 3 values
    $r = mt_rand($minVal, $maxVal);
    $g = mt_rand($minVal, $maxVal);
    $b = mt_rand($minVal, $maxVal);

    // Return a hex colour ID string
    return sprintf('#%02X%02X%02X', $r, $g, $b);

}

function getDatesFromRange($start, $end, $format = 'Y-m-d') {
        $array = "";
        $interval = new DateInterval('P1D');

        $realEnd = new DateTime($end);
        $realEnd->add($interval);

        $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

        foreach($period as $date) { 
            $array .= "'".$date->format($format)."',"; 
        }

        return $array;
    }

if (!function_exists('assignSystemReward')) {
    function assignSystemReward($user_id, $actionTriggered, $occurance)
    {   
        //occurance - expcated values occurance_time, occurance_firsttime, occurance_always
        $CI =& get_instance();
        $CI->load->model('Systemquestaction', 'systemquestaction', TRUE);
        $CI->load->model('Questuser', 'questuser', TRUE);
        $CI->load->model('Rewardslog', 'rewardslog', TRUE);
        $CI->load->model('quests/Quest', 'quest', TRUE);
        if($CI->systemquestaction->isCodeExists($actionTriggered)){
            $where = ['is_system'=>1, 'action'=>$actionTriggered, 'occurance' => $occurance ];
            $systemQuests = $CI->quest->getRecordsByCondition($where);
            if(!empty($systemQuests)){
                foreach($systemQuests as $systemQuest){
                    $insert = [];
                    $insertUser = [];
                    switch ($systemQuest->occurance) {
                        case 'occurance_time':
                            $date = date('Y-m-d H:i:s');
                            if($date >= $systemQuest->start_time && $date <= $systemQuest->end_time){
                                $insertUser['user_id'] = $insert['user_id'] = $user_id;
                                $insert['entity_id'] = $insertUser['quest_id'] = $systemQuest->id;
                                $insertUser['reward_points'] =$insert['reward_points'] = $systemQuest->reward;
                                $insert['entity'] = 'quest';
                                $insert['description'] = 'Reward Awarded for quest '.$systemQuest->title;
                                $CI->questuser->insertQuestUser($insertUser);
                                $CI->rewardslog->insertRewardLog($insert);
                                return true;
                            }   
                            break;
                        case 'occurance_firsttime':
                            if(!$CI->questuser->isUsed($user_id, $systemQuest->id)){
                                $insertUser['user_id'] = $insert['user_id'] = $user_id;
                                $insert['entity_id'] = $insertUser['quest_id'] = $systemQuest->id;
                                $insertUser['reward_points'] =$insert['reward_points'] = $systemQuest->reward;
                                $insert['entity'] = 'quest';
                                $insert['description'] = 'Reward Awarded for quest '.$systemQuest->title;
                                $CI->questuser->insertQuestUser($insertUser);
                                $CI->rewardslog->insertRewardLog($insert);
                                return true;
                            }       
                            break;
                        case 'occurance_always':
                            $insertUser['user_id'] = $insert['user_id'] = $user_id;
                            $insert['entity_id'] = $insertUser['quest_id'] = $systemQuest->id;
                            $insertUser['reward_points'] =$insert['reward_points'] = $systemQuest->reward;
                            $insert['entity'] = 'quest';
                            $insert['description'] = 'Reward Awarded for quest '.$systemQuest->title;
                            $CI->questuser->insertQuestUser($insertUser);
                            $CI->rewardslog->insertRewardLog($insert);
                            return true;
                            break;
                    }   
                }       
            }
            else {
                return false;   
            }       
        }
        else {
            return false;   
        }   
    }
}

if (!function_exists('isMerchant')) {
    function isMerchant($userId, $resource = ''){
        $CI =& get_instance();
        $CI->load->model('Userrole');
        if($CI->Userrole->checkUserRoles($userId, 6)){
            return true;    
        }
        elseif($CI->Userrole->checkUserRoles($userId, 7) && $resource!=''){
            if(isset($_REQUEST['user_token'])){
                $rawData = decrypt($_REQUEST['user_token']);
                if($rawData != false){
                    $data = json_decode($rawData);
                    if(isset($data['merchant_id'])){
                        $CI->load->model('MerchantUserroleResources');
                        if($res = $CI->MerchantUserroleResources->getResources($userId,$data['merchant_id'])){
                            $resources = unserialize($res->resources);
                            if($res->status==1){
                                if(in_array($resource, $resources)){
                                    return true;    
                                }
                                else{
                                    return false;
                                }
                            }
                            else{
                                return false;
                            }       
                        }
                        else{
                            return false;
                        }   
                    }
                    else{
                        return false;   
                    }
                }
                else{
                    return false;
                }   
            }
            else{
                return false;   
            }     
        }
        else{
            return false;   
        }           
    }   
}       
