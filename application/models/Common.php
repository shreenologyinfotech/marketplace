<?php
class Common extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    
    
    function _update($table, $data, $condition = array()){
        if (count($condition) > 0) {
            $this->db->where($condition);
        }
        if ($this->db->update($table, $data)) {
            return true;
        } else {
            return false;
        }
    }


     public function showObjectResponse($result,$message,$obj){
        echo json_encode(array("RESULT"=>$result,"Message"=>$message,"Data"=>$obj));
        exit();
     }

     public function showArrayRespose($result,$message,$array,$userId = 0){ 
        $notification_count = "0";
        $new_ads            = "0";

        if($userId != 0){
           $currentDate = date("Y-m-d")." 00:00:00";

           $notification_count1 = $this->db->query("select * from tbl_notification where user_id = '0' AND  created >= '$currentDate' AND FIND_IN_SET('$userId',seen_ids) <= 0 ")->num_rows();

           $notification_count2 = $this->total_count("tbl_notification", "user_id",array("user_id"=>$userId,"is_read"=>"false"));
           $notification_count = $notification_count1 + $notification_count2;
           
           $new_ads = newadscount($userId);
        }
        
        echo json_encode(array("RESULT"=>$result,"Message"=>$message,"Data"=>$array,"notification_count"=>$notification_count,"new_ads"=>$new_ads));
        exit();
     }





     public function getUserSeenAdsArrayByUserId($userId){
        $data = $this->db->query("select order_id from tbl_order_view_history where user_id = '".$userId."'")->result_array();    
        $arr = array_map (function($value){
            return $value['order_id'];
        } , $data);

        return $arr;
     }



     public function getOrderPostalCodeBy($order_id){
        $data = $this->db->query("select zipcode from tbl_order_zipcodes where order_id = '".$order_id."'")->result_array();    
        $arr = array_map (function($value){
            return $value['zipcode'];
        } , $data);

        return $arr;
     }



     function getmyads($user_id,$is_custom_limit,$startlimit){
                $userPostalCode  = substr($this->getUserPostalCodeById($user_id), 0, 2);
              //  $userPostalCode  = $this->getOrderPostalCodeBy($user_id);
                $mySeenAds       = $this->getUserSeenAdsArrayByUserId($user_id); 
                
                $myseenAdsString = implode($mySeenAds,",");
                ///first get all ads that belons to whole signpur
                
                $sql = 'select *,tbl_orders.id as id,IF(tbl_orders.image_single != "", CONCAT("'.base_url().'uploads/ads/", tbl_orders.image_single, ""), "") as image_single, IF(tbl_orders.image_single != "", CONCAT("'.base_url().'uploads/ads/thumb/", tbl_orders.image_single, ""), "") as image_path_thumb,tbl_orders.image_path  from tbl_order_view_history 
                        LEFT JOIN tbl_orders ON tbl_orders.id = tbl_order_view_history.order_id
                        where tbl_order_view_history.user_id = "'.$user_id.'" AND end_date >= CURDATE() ';
                $sql = $sql." ORDER BY tbl_orders.id DESC";

                $data = $this->db->query($sql)->result(); 
                foreach ($data as $value) {
                    $value->image_path =  json_decode($value->image_path);
                }

                return $data;
     }





     function getads($user_id,$is_custom_limit,$startlimit){
                $userPostalCodeActual = $this->getUserPostalCodeById($user_id);
                $userPostalCode  = substr($userPostalCodeActual, 0, 2);
                $mySeenAds       = $this->getUserSeenAdsArrayByUserId($user_id); 
                $myseenAdsString = implode($mySeenAds,",");
                $user_lat = 0.00;
                $user_lng = 0.00;


                $wherePostal = ["postal_code"=>$userPostalCodeActual];
                $dataPostal  = $this->_get_all_records("tbl_postal_location",$wherePostal);
                if(sizeof($dataPostal) > 0){
                     $user_lat = $dataPostal[0]->lat;
                     $user_lng = $dataPostal[0]->lng;
                }


                $sql = get_new_ads_sql($user_lat,$user_lng,$userPostalCode,$myseenAdsString);
                
                if(!$is_custom_limit){
                      $sql = $sql.' Limit 1';
                }
                
                $data = $this->db->query($sql)->result(); 

                foreach ($data as $value) {
                    $value->image_path =  json_decode($value->image_path);
                }
                return $data;
     }
   

 


    function getTotalPaidToAdvertViewerByOrderId($orderId){
        $currency = get_meta_value("site_currency_symbol");
        $sql = "select sum(reward_earned) as totalPaid from tbl_order_view_history where order_id = '".$orderId."'";
        $totalData = $this->db->query($sql)->result();
        if($totalData[0]->totalPaid == ""){
            return $currency."0.00";
        }
        return $currency.$totalData[0]->totalPaid;
    }


    function getorderAdvertiserDetails($where){
        $this->db->select("*,tbl_orders.id as order_id");
        $this->db->from("tbl_orders");
        $this->db->join("tbl_advertiser","tbl_orders.user_id = tbl_advertiser.id","left");
        $this->db->where($where);
        return $this->db->get()->result();
    }
    function getAllZipCodes($like = '',$where = array()){
        $this->db->select("*");
        $this->db->from("tbl_zipcode");
        $this->db->join("tbl_area","tbl_zipcode.area_id = tbl_area.area_id","left");
        $this->db->join("tbl_region","tbl_area.region_id = tbl_region.region_id","left");
        if($like != ""){
          $this->db->like('zip_code', $like);  
        }
        $this->db->where($where);
        return $this->db->get()->result();
        
    }

    function ajaxAreaByCentralId($central_id){
      $output = "<option value = ''>Select Area</option>";
      $this->db->select("*");
      $this->db->where(array("region_id"=>$central_id));
      $data =  $this->db->get("tbl_area")->result();
      foreach ($data as $result) {
        $output .= "<option value = '".$result->area_id."'>".$result->area_name."</option>";         
      }
      echo $output;
    }


    function ajaxPostalByAreaId($area_id){
      $output = "<option value = ''>Select Postal Code</option>";
      $this->db->select("*");
      $this->db->where(array("area_id"=>$area_id));
      $data =  $this->db->get("tbl_zipcode")->result();
      foreach ($data as $result) {
        $output .= "<option value = '".$result->id."'>".$result->zip_code."</option>";         
      }
      echo $output;
    }

    
    function getAllActiveZipCode(){
      $this->db->select("*");
      return $this->db->get("tbl_zipcode")->result();
    } 


    function getAllActiveRegion(){
      $this->db->select("*");
      return $this->db->get("tbl_region")->result();
    } 
     

    function getRecordById($table,$where){
        $this->db->select("*");
        $this->db->where($where);
        return $this->db->get($table)->result();
    }


    

    



    function getTopRecordById($table,$where){
        $this->db->select("*");
        $this->db->where($where);
        $this->db->order_by("id", "DESC");
        return $this->db->get($table)->result();
    }


    function _select($table, $column = '*', $condition = array(), $order_by = '', $sort = 'ASC', $start = '0', $perPage = '')
    {
        if (count($condition) > 0 && $condition != '') {
            $this->db->where($condition);
        }
        if ($order_by != '') {
            $this->db->order_by($order_by, $sort);
        }
        if ($perPage != '') {
            $this->db->limit($perPage, $start);
        }
        $this->db->select($column, false);
        $resSQL = $this->db->get($table);
        if ($resSQL->num_rows() > 0) {
            $result = array();
            foreach ($resSQL->result_array() as $row) {
                $result[] = $row;
            }
            return $result;
        } else {
            return false;
        }
    }

    function _selectById($table, $column = '*', $condition = array())
    {
        if (count($condition) > 0) {
            $this->db->where($condition);
        }
        $this->db->select($column, false);
        $resSQL = $this->db->get($table);
       $sql = $this->db->last_query( );
        if ($resSQL->num_rows() > 0) {
            $result = array();
            foreach ($resSQL->result_array() as $row) {
                $result = $row;
            }
            return $result;
        } else {
            return false;
        }
    }


    

    function _insert($table, $data)
    {
        if ($this->db->insert($table, $data)) {
            return true;
        } else {
            return false;
        }
    }

    function insert_batch($table, $data)
    {
        if ($this->db->insert_batch($table, $data)) {
            return true;
        } else {
            return false;
        }
    }

    function _delete($table, $condition = '')
    {
        if ($condition != '') {
            $this->db->where($condition);
        }
        $this->db->delete($table);

        if ($this->db->affected_rows()) {
            return true;
        } else {
            return false;
        }
    }

    function getTotal($table, $column, $condition = array())
    {
        if (is_array($condition) && count($condition) > 0) {
            $this->db->where($condition);
        }
        $this->db->select($column);
        $resSQL = $this->db->get($table);
        if ($resSQL->num_rows() > 0) {
            $total = '';
            foreach ($resSQL->result_array() as $row) {
                $total = $row['total'];
            }
            return $total;
        } else {
            return false;
        }
    }

    function deleteWhereIn($table, $onColumn, $value = array())
    {
        $this->db->where_in($onColumn, $value);
        if ($this->db->delete($table)) {
            return true;
        } else {
            return false;
        }
    }

    function updateWhereIn($table, $data, $onColumn, $id_array)
    {
        $this->db->where_in($onColumn, $id_array);
        if ($this->db->update($table, $data)) {
            return true;
        } else {
            return false;
        }
    }

    function _insertReturnId($table, $data)
    {
        if ($this->db->insert($table, $data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    function _CheckExistence($col,$val, $tbl, $where = array()){
        $this->db->where(array($col => $val));
        $this->db->from($tbl);
        if(!empty($where)){
            $this->db->where($where);
        }
        $count = $this->db->count_all_results();
        if($count > 0){
            return false;
        }else{
            return true;
        }
    }

    public function get_all_record($table,$where = array()){
        $col = '*';
        if(!empty($where)){
            $this->db->where($where);
        }
        $this->db->select($col);
        $result = $this->db->get($table)->result();
        return $result;
    }


    public function isRecordExits($table,$where){  
        $this->db->where($where);
        $data = $this->db->get($table)->result();
        if(sizeof($data) > 0){
            return true;
        }else{
            return false;
        }
    }



     public function getOrderDetails($table,$where){  
        $this->db->select("*,tbl_orders.id as id");
        $this->db->from($table);
        $this->db->join("tbl_zipcode","tbl_orders.pincode = tbl_zipcode.id","left");
        $this->db->join("tbl_area","tbl_zipcode.area_id = tbl_area.area_id","left");
        $this->db->join("tbl_region","tbl_area.region_id = tbl_region.region_id","left");
        $this->db->where($where);
        return $this->db->get()->result();
    }
    

    public function get_all_record_custom($sql){
        $result = $this->db->query($sql)->result();
        return $result;
    }



    function getSeenCount($table){
        $sql  = "select count(*) as totalRec FROM ".$table." where seen_status = 'false' ";
        if($table == "tbl_advertiser" || $table == "tbl_advert_viewer" ){
            $sql  = $sql." AND is_email_verified = 'Yes' ";
        }
        
        $data = $this->db->query($sql)->result();
        if(sizeof($data) > 0){
            return $data[0]->totalRec;
        }
        return "0";

    }
    

    function total_count($table, $column, $condition = array()){
        if (is_array($condition) && count($condition) > 0) {
            $this->db->where($condition);
        }
        $this->db->select($column);
        $this->db->from($table);
        $resSQL = $this->db->count_all_results();
        return $resSQL;
    }


    function getTotalOrderOfMonth(){
        $sql  = "SELECT count(*) as total_order FROM tbl_orders WHERE MONTH(created) = MONTH(CURRENT_DATE());";
        $data = $this->db->query($sql)->result();
        if(sizeof($data) > 0){
          return $data[0]->total_order;   
        }  
         return  0;

    }


    function getTotalIncomeOfMonth(){
        $sql  = "SELECT sum(total_cost) as total_cost FROM tbl_orders WHERE MONTH(created) = MONTH(CURRENT_DATE());";
        $data = $this->db->query($sql)->result();
        if(sizeof($data) > 0){
          if($data[0]->total_cost != ""){
              return $data[0]->total_cost; 
          }  
        }  
         return  0;

    }




    function getTotalWithdrawAmountFromUserId($userId){
        $sql    = "select sum(amount) as total_earn from tbl_advert_viewer_withdraw where user_id = '".$userId."' and status = 'Paid' ";
        $data   = $this->db->query($sql)->result();    
        if($data[0]->total_earn != ""){
            return  show_two_decimal_number($data[0]->total_earn);
        }else{
            return  "0.00";
        }
    }



    function getUserFirebaseTokenBoth($userId){
        $tokenArray = array();
        $this->db->select("android_token,ios_token");
        $this->db->from("tbl_advert_viewer");
        $this->db->where(array("id"=>$userId));
        $data = $this->db->get()->result();  
        if(sizeof($data) > 0){
            if($data[0]->android_token != ""){
               array_push($tokenArray, $data[0]->android_token);   
            }
            if($data[0]->ios_token != ""){
                array_push($tokenArray, $data[0]->ios_token);   
            }
           
        }

        return $tokenArray;


    }


    function getUserDetailsById($userId){
       $this->db->select("*,tbl_advert_viewer.id as id,tbl_advert_viewer_bank.id as bank_id");
       $this->db->from("tbl_advert_viewer");
       $this->db->join("tbl_package","tbl_advert_viewer.package_id = tbl_package.id","left");
       $this->db->join("tbl_employment_status","tbl_advert_viewer.employment_status_id = tbl_employment_status.id","left");
       $this->db->join("tbl_advert_viewer_bank","tbl_advert_viewer.id = tbl_advert_viewer_bank.user_id","left");
       
       $this->db->where(array("tbl_advert_viewer.id"=>$userId));
       $data = $this->db->get()->result();  
       //$data[0]->total_refer_earn = $this->total_count("tbl_advert_viewer", "registration_referral_code",array("registration_referral_code"=>$data[0]->self_referral_code));
       $data[0]->next_level =  $this->getnextlevelDetails($data[0]->tier_level);       
       $data[0]->notification_count =  $this->total_count("tbl_notification", "user_id",array("user_id"=>$data[0]->id,"is_read"=>"false"));     
       $whereIntrest = array("user_id"=>$userId);
       $sql = "select tbl_user_interests.*,tbl_interests.interests_text from tbl_user_interests LEFT JOIN tbl_interests ON tbl_user_interests.interest_id = tbl_interests.id where tbl_user_interests.user_id = '".$userId."'";
       $data[0]->interest_data          =  $this->db->query($sql)->result();     

       $data[0]->total_earn             =  $this->getTotalWithdrawAmountFromUserId($userId);
       $data[0]->min_withdraw_limit     =  show_two_decimal_number(get_meta_value("minimum_withdraw_limit"));
       $data[0]->withdraw_bank_charge   =  show_two_decimal_number(get_meta_value("withdraw_bank_charge"));
       $data[0]->wallet_balance         =  show_two_decimal_number($data[0]->wallet_balance);
       $data[0]->new_ads                =  newadscount($userId);

      

       return $data[0];
    }



    function getUserPostalCodeById($userId){
        $postal_code  = "";
        $this->db->select("postal_code");
        $this->db->where(array("id"=>$userId));
        $data =  $this->db->get("tbl_advert_viewer")->result();
        if(sizeof($data) > 0){
           $postal_code = $data[0]->postal_code;
        }
        return  $postal_code;
    }


    public function getOrdersByPostalCode($postalCode){
       $this->db->select("*,tbl_orders.id as id");
       $this->db->from("tbl_orders");
       $this->db->join("tbl_order_zipcodes","tbl_orders.id = tbl_order_zipcodes.order_id","left");
       $this->db->where(array("tbl_order_zipcodes.zipcode"=>$postalCode));
       $this->db->where(array("tbl_orders.status"=>"In Progress"));
       return $this->db->get()->result();  

    }






    function getnextlevelDetails($level){
        $level = $level+1;
        $this->db->where(array("tier_level"=>$level));
        $this->db->select("*");
        return $this->db->get("tbl_package")->result();
    }


  

    function _is_record_exits($table,$where){  
        $this->db->where($where);
        $data = $this->db->get($table)->result();
        if(sizeof($data) > 0){
            return true;
        }else{
            return false;
        }
    }

    

    function _get_latest_withdraw_request($perPage,$start){  
        $this->db->select("*");
        $this->db->from("tbl_advert_viewer_withdraw");
        $this->db->where(array("status"=>"Requested"));
        $this->db->order_by("id","DESC");
        $this->db->limit($perPage, $start);
        $data = $this->db->get()->result();
        return $data;
    }

     function _get_latest_refund_request($perPage,$start){  
        $this->db->select("*");
        $this->db->from("tbl_advertiser_orders_refund");
        $this->db->where(array("status"=>"requested"));
        $this->db->order_by("id","DESC"); 
        $this->db->limit($perPage, $start);
        $data = $this->db->get()->result();
        return $data;
    }





    function _get_latest_pending_ads($perPage,$start){  
        $this->db->select("*");
        $this->db->from("tbl_orders");
        $this->db->where(array("tbl_orders.status"=>"Pending Approval"));
        $this->db->order_by("id","DESC");
        $this->db->limit($perPage, $start);
        $data = $this->db->get()->result();
        return $data;
    }


   
    function _get_latest_viewed_ads($perPage,$start){  
        $this->db->select("*");
        $this->db->from("tbl_order_view_history");
        $this->db->join("tbl_orders","tbl_orders.id = tbl_order_view_history.order_id","left");
        $this->db->order_by("tbl_order_view_history.id","DESC");
        $this->db->limit($perPage, $start);
        $data = $this->db->get()->result();
        return $data;
    }


     function _get_most_latest_viewed_ads($perPage,$start){  
        $this->db->select("*");
        $this->db->from("tbl_order_view_history");
        $this->db->join("tbl_orders","tbl_orders.id = tbl_order_view_history.order_id","left");
        $this->db->order_by("tbl_order_view_history.id","DESC");
        $this->db->limit($perPage, $start);
        
        $data = $this->db->get()->result();
        return $data;
    }


    function _get_all_records_limit_desc($table,$where,$perPage, $start,$order_by){  
        $this->db->select("*"); 
        $this->db->where($where);
        $this->db->order_by($order_by,"DESC");
        $this->db->limit($perPage, $start);
        
        $data = $this->db->get($table)->result();
        return $data;
    }



    function _get_all_records_limit($table,$where,$perPage, $start){  
        $this->db->select("*"); 
        $this->db->where($where);
        $this->db->limit($perPage, $start);

        $data = $this->db->get($table)->result();
        return $data;
    }

    function _get_all_records($table,$where,$orderBy = ""){  
        $this->db->select("*"); 
        $this->db->where($where);
        if($orderBy != ""){
          $this->db->order_by($orderBy,"DESC");
        }

        $data = $this->db->get($table)->result();
        return $data;
    }
    function getAllProductsInSellerDashboard($table,$where,$orderBy = "",$searchText =''){  
        $this->db->select("*"); 
        $this->db->where($where);
        if($searchText != ''){
            $this->db->group_start();
            $this->db->like('sku',$searchText);
            $this->db->or_like('product_name',$searchText);
            $this->db->group_end();
        }
        if($orderBy != ""){
          $this->db->order_by($orderBy,"DESC");
        }

        $data = $this->db->get($table)->result();
        return $data;
    }

    function _get_select_records($select,$table,$where){  
        $this->db->select($select); 
        $this->db->where($where);
        $data = $this->db->get($table)->result();
        return $data;
    }
   
    function redirect_to_admin_dashboard(){
        $adminId = $this->session->userdata(CASHVERTISE_ADMIN_ID,"");
        if($adminId != ""){
         redirect("admin/dashboard");   
        }
    }

    function get_admin_id(){
        $adminId = $this->session->userdata(CASHVERTISE_ADMIN_ID,"");
        return $adminId;
    }

    function is_admin_login(){
        $adminId = $this->session->userdata(CASHVERTISE_ADMIN_ID);
        if($adminId == ""){
           redirect("adminlogin"); 
        }
    }

    public function sendmail($email,$fname,$lname,$subject,$htmlMessage){
            // send mail            
            $to = $email;
            $to_name = $fname.' '.$lname;
            $from = "noreply@syonserver.com";
            $from_name =  "CashVertise Team";
            $subject = $subject;
            $message = $htmlMessage;
            $this->email->clear();
            $this->email->from($from, $from_name);
            $this->email->to($to,$to_name);
            $this->email->subject($subject);
            $this->email->message($message);
            $this->email->set_mailtype('html');
            $this->email->send();
            return true;
     }


    public function getCountRecords($tbl){
        $this->db->select("*");
        $this->db->from($tbl);
        return $this->db->count_all_results();
    }

    public function get_order_id(){
         return order_prefix()."".$this->get_advertiser_id()."".$this->getCountRecords("tbl_orders");
    }





     function get_country_from_region_id($regionId){
        $this->db->select("country_id");    
        $this->db->where(array("region_id"=>$regionId));
        $data = $this->db->get("tbl_region")->result();
        if(sizeof($data) > 0){
          return $data[0]->country_id;
        }else{
          return "0";      
        }
    }


    function get_advertiser_id(){
        $adminId = $this->session->userdata(CASHVERTISE_ADVERTISER_ID,"");
        return $adminId;
    }



    function redirect_advertiser(){
        $adminId = $this->session->userdata(CASHVERTISE_ADVERTISER_ID);
        if($adminId != ""){
           redirect("./profile"); 
        }
    }

    function is_adveritser_login(){
        $adminId = $this->session->userdata(CASHVERTISE_ADVERTISER_ID);
        if($adminId == ""){
           redirect("./login"); 
        }
    }

}

?>
