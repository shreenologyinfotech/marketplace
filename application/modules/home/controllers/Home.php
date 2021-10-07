<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//require_once(BASEPATH.'core/MY_Controller.php');
class Home extends MY_Controller {
		
		
    function __construct() {
        parent::__construct();
  		$this->load->library('form_validation');    
	    $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        log_message('debug', 'CI My Admin : Auth class loaded');
        $this->load->model('Order');
        $this->load->model('Footerlink');
        $this->load->model('Transactions');
        $this->load->model('EmailTemplate');


        
    

    }


    function switchlanguage(){
        $this->session->set_userdata('language', $this->uri->segment(2));
        redirect('./home');

    }




    function setRules($options){
        if($options == "USER_CCONTACT"){
            $this->form_validation->set_rules('fname', 'First Name','trim|required');
            $this->form_validation->set_rules('lname', 'Last Name','trim|required');
            $this->form_validation->set_rules('email', 'email','trim|required');
            $this->form_validation->set_rules('contact', 'contact','trim|required');
            $this->form_validation->set_rules('message', 'message','trim|required');
       
        }else if($options == "USER_EDITPROFILE"){
            $this->form_validation->set_rules('fname', 'First Name','trim|required');
            $this->form_validation->set_rules('lname', 'Last Name','trim|required');
            $this->form_validation->set_rules('email', 'Email','trim|required');
            $this->form_validation->set_rules('contact_number', 'Contact Number','trim|required');
            $this->form_validation->set_rules('comp_name', 'Company Name','trim|required');
        
        }else if($options == "CHANGE_PASSWORD"){
            $this->form_validation->set_rules('old_password', 'Old Password','trim|required');
            $this->form_validation->set_rules('new_password', 'New Password','trim|required');
        }else if($options == "FOOTER_LINK"){

            $this->form_validation->set_rules('page_id', 'Page Id','trim|required');
            $this->form_validation->set_rules('title', 'title','trim|required');

        }else if($options == "NEWS_LETTER"){
            $this->form_validation->set_rules('news_email', 'Email','trim|required');
        }else if($options == "SIGNUP_AS_RETAILER"){
            $this->form_validation->set_rules('business_name', 'Business Name','trim|required');
            $this->form_validation->set_rules('address', 'Address','trim|required');
            $this->form_validation->set_rules('email', 'Email','trim|required');
            $this->form_validation->set_rules('phone', 'Phone','trim|required');
            $this->form_validation->set_rules('user_name', 'User Name','trim|required');
            $this->form_validation->set_rules('password', 'Password','trim|required');
        }
    }


    function subscribenewsletter(){
       $this->data['page_title'] = SITE_TITLE.' :: Subscribe Newsletter';
       $this->data['page'] = $this->_viewPath . "subscribe-newsletter.php";
       $this->load->view($this->_frontContainer, $this->data); 

    }




    function checkoutconfirm(){
      $modeOfPayment = $this->uri->segment(2);
      if($modeOfPayment == "cod" || $modeOfPayment == "paypal"  || $modeOfPayment == "stripe" ){


          $user_agent = get_user_agent();
          $sql        =  "select * from tbl_user_has_cart 
                          LEFT JOIN tbl_products ON tbl_user_has_cart.product_id = tbl_products.product_id
                          LEFT JOIN tbl_home_category ON tbl_products.category_id = tbl_home_category.category_id
                          LEFT JOIN tbl_product_sub_category ON tbl_products.subcategory_id = tbl_product_sub_category.sub_category_id
                          LEFT JOIN tbl_stores ON tbl_products.store_id = tbl_stores.store_id
                          LEFT JOIN tbl_brands ON tbl_products.brand_id = tbl_brands.brand_id
                          where http_user_agent = '$user_agent' ORDER BY cart_id DESC ";
           $data      =  $this->Common->get_all_record_custom($sql);
           $userId                     = $this->session->userdata(FRONT_USER_ID);

           $this->data['my_address']   = $this->Common->_get_all_records("tbl_address",["user_id"=>$userId]);

           $this->data['page_title'] = SITE_TITLE.' :: Check Out Confirm';
           $this->data['pay_mode'] = $modeOfPayment;

           $this->data['page'] = $this->_viewPath ."checkout-confirm.php";
           $this->data['result_data'] = $data;
           $this->load->view($this->_frontContainer, $this->data);

      }else{
        echo show_404();
      }
      
        

      
    }



    function precheckout(){

      $user_agent = get_user_agent();
      $sql        =  "select * from tbl_user_has_cart 
                      LEFT JOIN tbl_products ON tbl_user_has_cart.product_id = tbl_products.product_id
                      LEFT JOIN tbl_home_category ON tbl_products.category_id = tbl_home_category.category_id
                      LEFT JOIN tbl_product_sub_category ON tbl_products.subcategory_id = tbl_product_sub_category.sub_category_id
                      LEFT JOIN tbl_stores ON tbl_products.store_id = tbl_stores.store_id
                      LEFT JOIN tbl_brands ON tbl_products.brand_id = tbl_brands.brand_id
                      where http_user_agent = '$user_agent' ORDER BY cart_id DESC ";
       $data      =  $this->Common->get_all_record_custom($sql);
       $userId                     = $this->session->userdata(FRONT_USER_ID);
       $this->data['my_address']   = $this->Common->_get_all_records("tbl_address",["user_id"=>$userId]);
       $this->data['page_title'] = SITE_TITLE.' :: Check Out';
       $this->data['page'] = $this->_viewPath ."checkout.php";
       $this->data['result_data'] = $data;
       
       $this->load->view($this->_frontContainer, $this->data);
    }


    function loadPayView(){
        if(save_user_order("Paypal")){

              $orderId       = $this->db->insert_id();
              $where         =  array("store_id"=>get_store_id());
              $store_details  = $this->Common->getRecordById("tbl_stores",$where);

              $where         =  array("user_id"=>get_store_id(),"payment_status"=>"pending","order_id"=>$orderId);
              $orderData     =  $this->Common->_get_all_records("tbl_order",$where,"");

              $this->data['page_title'] = SITE_TITLE.' :: Order Payment';
              $this->data['page'] = $this->_viewPath . "order-payment.php";
              $this->data['order_details'] = $orderData;
              $this->data['store_details'] = $store_details;
              $total       = $this->input->post('total');
              $this->data["total"] = $total;  

            

              $this->load->view($this->_frontContainer, $this->data);
        }else{
            echo show_404();
        }
    }

    function createNewStoreAccount(){
      if(count($_POST) > 0){
        $this->setRules("SIGNUP_AS_RETAILER");

        if($this->form_validation->run()){
            $store_name           = $this->input->post("business_name");
            $owner_first_name     = $this->input->post("first_name");
            $owner_last_name      = $this->input->post("sur_name");
            $unit_level              = $this->input->post("unit_level");
            $address              = $this->input->post("address");
            $store_email          = $this->input->post("email");
            $store_mobile         = $this->input->post("phone");
            $business_name        = $this->input->post("user_name");
            $password             = $this->input->post("password");

            $account_name         = $this->input->post("account_name");
            $swift_code           = $this->input->post("swift_code");
            $account_number       = $this->input->post("account_number");


            $address              = $this->input->post("address");
            $cif                  = $this->input->post("cif");
            $region               = $this->input->post("region");
            $web_page             = $this->input->post("web_page");
            $position             = $this->input->post("position");
            $idiom                = $this->input->post("idiom");
            $mobile_number        = $this->input->post("mobile_number");

            $country              = $this->input->post("country");
            $state                = $this->input->post("state");
            $city                 = $this->input->post("city");



            $whereName        = ["store_name"=>$store_name];  
            $whereEmail       = ["store_email"=>$store_email];  
            $wherePhone       = ["store_mobile"=>$store_mobile];  


            

            if($this->Common->_is_record_exits("tbl_stores",$whereEmail)){
                $this->session->set_userdata(GLOBAL_MSG,"This email is already registered with us");

            }else if($this->Common->_is_record_exits("tbl_stores",$whereName)){
                $this->session->set_userdata(GLOBAL_MSG,"This user name is already registered with us.");

            }else if($this->Common->_is_record_exits("tbl_stores",$wherePhone)){
                $this->session->set_userdata(GLOBAL_MSG,"This mobile is already registered with us.");
           
            }else{

                $insArray  = array(
                    'store_mobile' => $store_mobile, 
                    'unit_level' => $unit_level, 
                    'address' => $address, 
                    'cif' => $cif, 
                    'region' => $region, 
                    'web_page' => $web_page, 
                    'position' => $position, 
                    'idiom' => $idiom, 
                    'mobile_number' => $mobile_number, 
                    'store_email' => $store_email, 
                    'store_name'  => $store_name, 
                    'owner_first_name'  => $owner_first_name, 
                    'owner_last_name'  => $owner_last_name, 
                    'address'  => $address, 
                    'business_name'  => $business_name, 
                    'password'  => md5($password), 
                    'enk_key'  => base64_encode($password), 
                    'account_name'  => $account_name, 
                    'swift_code'  => $swift_code, 
                    'country'  => $country, 
                    'state'  => $state, 
                    'city'  => $city, 
                    'account_number'  => $account_number, 
                    'user_type'  => "S", 
                    'status'  => "I", 
                    'created_at' => date("Y-m-d H:i:s"),
                    'modified_at' => date("Y-m-d H:i:s") 
                );
                

                if (isset($_FILES['company_logo']) && $_FILES['company_logo']['name']!=""){
                    $insArray["store_image"]  =  upload_image('company_logo',IMAGE_PATH_ABSULATE.STORES_FOLDER);
                }


                if($this->Common->_insert("tbl_stores",$insArray)){
                     $this->session->set_userdata(GLOBAL_MSG,"Store created successfully. You will be notified once your account has been verified");
                }else{
                    $this->session->set_userdata(GLOBAL_MSG,"Something went wrong please try again later");
                  
                }
            }
        }else{
             $this->session->set_userdata(GLOBAL_MSG,"Validation failed");
        }

      }

       $this->retailerSignup();
    }

    
      
    function retailerSignup(){
       $this->data['page_title'] = SITE_TITLE.' :: retailer-singup';
       $this->data['page'] = $this->_viewPath ."new-retailer-signup.php";
       $this->load->view($this->_frontContainer, $this->data);
    }



    function createretaileraccount(){
       $this->data['page_title'] = SITE_TITLE.' :: new-retailer-account';
       $this->data['page'] = $this->_viewPath ."new-retailer-account.php";
       $this->data['content'] = $this->Common->_get_all_records("tbl_page_retail",array(),"id");
       $this->load->view($this->_frontContainer, $this->data);
    }
    

    function checkoutSuccess(){
       clearUserCart();
       $this->data['page_title'] = SITE_TITLE.' :: Check out Success';
       $this->data['page'] = $this->_viewPath ."checkout-success.php";
       $this->load->view($this->_frontContainer, $this->data);
    }


    function checkout(){
     if(save_user_order()){
        redirect('./checkout-success');
      }else{
        redirect('./cart');
      }
    }



    function storelocator(){
       $start_limit = $this->input->get('start_limit');
       $keyword     = $this->input->get('keyword');
       if($start_limit == ""){
          $start_limit = "0";
       }

      


       $this->data['page_title'] = SITE_TITLE.' :: Store Locator';
       $this->data['page'] = $this->_viewPath ."store-locator.php";
       $this->data['store_data'] = get_stores_by_limit($start_limit,$keyword);
       $this->data['start_limit'] = $start_limit;
       $this->data['keyword'] = $keyword;

       $this->load->view($this->_frontContainer, $this->data);
    }


    function buysellprivate(){
       $this->data['page_title'] = SITE_TITLE.' :: Private-buy-sell';
       $this->data['page'] = $this->_viewPath ."buy-sell-private.php";
       $this->load->view($this->_frontContainer, $this->data);
    }



    

    function cart(){
      $user_agent = get_user_agent();
      $sql        =  "select * from tbl_user_has_cart 
                      LEFT JOIN tbl_products ON tbl_user_has_cart.product_id = tbl_products.product_id
                      LEFT JOIN tbl_home_category ON tbl_products.category_id = tbl_home_category.category_id
                      LEFT JOIN tbl_product_sub_category ON tbl_products.subcategory_id = tbl_product_sub_category.sub_category_id
                      LEFT JOIN tbl_stores ON tbl_products.store_id = tbl_stores.store_id
                      LEFT JOIN tbl_brands ON tbl_products.brand_id = tbl_brands.brand_id
                      where http_user_agent = '$user_agent' ORDER BY cart_id DESC ";
       $data      =  $this->Common->get_all_record_custom($sql);
       

       $this->data['page_title'] = SITE_TITLE.' :: Cart';
       $this->data['page'] = $this->_viewPath ."cart.php";
       $this->data['result_data'] = $data;
       $this->load->view($this->_frontContainer, $this->data);


    }


    function favourite(){
      $user_agent = get_user_agent();
      $sql        =  "select * from tbl_user_has_wishlist 
                      LEFT JOIN tbl_products ON tbl_user_has_wishlist.product_id = tbl_products.product_id
                      LEFT JOIN tbl_home_category ON tbl_products.category_id = tbl_home_category.category_id
                      LEFT JOIN tbl_product_sub_category ON tbl_products.subcategory_id = tbl_product_sub_category.sub_category_id
                      LEFT JOIN tbl_stores ON tbl_products.store_id = tbl_stores.store_id
                      LEFT JOIN tbl_brands ON tbl_products.brand_id = tbl_brands.brand_id
                      where http_user_agent = '$user_agent' ORDER BY wishlist_id DESC ";


       $data      =  $this->Common->get_all_record_custom($sql);


       $this->data['page_title'] = SITE_TITLE.' :: Favourite';
       $this->data['page'] = $this->_viewPath ."favourite.php";
       $this->data['result_data'] = $data;
       $this->load->view($this->_frontContainer, $this->data);


    }




    function postsearch(){
        
        $input_cbt  = $this->input->post('input_cbt');
        $input_csz  = $this->input->post('input_csz');
        $sub_category_id  = $this->input->post('sub_category_id');
        $product_title  = $this->input->post('product_title');

        $min_price  = $this->input->post('min_price');
        $max_price  = $this->input->post('max_price');
        $sort       = $this->input->post('sort');

        if($input_cbt == ""){
          $input_cbt = "0";
        }
        
        if($input_csz == ""){
          $input_csz = "0";
        }
        
        if($sub_category_id == ""){
          $sub_category_id = "0";
        }

        if($product_title == ""){
            $product_title = "0";
        }

        redirect(base_url("search/1/search/".$input_cbt."/".$input_csz."/".$sub_category_id."/".$product_title."/".$min_price."/".$max_price."/".$sort));
    }



    function search(){
        $value = $this->uri->segment(2);
        $type  = $this->uri->segment(3);
        $cityStateZip        = $this->uri->segment(5);
        $categoryBrandTitle  =  urldecode($this->uri->segment(7));

        $min_price           = $this->uri->segment(8);
        $max_price           = $this->uri->segment(9);
        $sort                = $this->uri->segment(10);

       
        $brand_id               = "";
        $store_id               = "";  
        $category_id            = "";
        $subcategory_id         = "";
        $data  = array();

        if($type == "subcategory"){
            $subcategory_id = $value;
            $data = get_product_list($brand_id,$store_id,$category_id,$subcategory_id);
        }else if($type == "category"){
          $category_id = $value;
          $data = get_product_list($brand_id,$store_id,$category_id,$subcategory_id);
        }else if($type == "brand"){
          $brand_id = $value;
          $data = get_product_list($brand_id,$store_id,$category_id,$subcategory_id);
        }else if($type == "store"){
          $store_id = $value;
          $data = get_product_list($brand_id,$store_id,$category_id,$subcategory_id);

        }else if($type == "search"){
          //$store_id = $value;
          $brand_id               = $this->uri->segment(4);
          $category_id            = $this->uri->segment(5);
          $subcategory_id         = $this->uri->segment(6);

          

          $data = get_product_list($brand_id,$store_id,$category_id,$subcategory_id,$categoryBrandTitle,"","",$min_price,$max_price,$sort);
        }

        $this->data['page_title'] = SITE_TITLE.' :: Search';
        $this->data['page'] = $this->_viewPath . "category-search.php";
        $this->data['result_data'] = $data;


        $this->load->view($this->_frontContainer, $this->data);
    }


    function signupretailer(){
     


      $this->data['page_title'] = SITE_TITLE.' :: Retails Signup';
      $this->data['page'] = $this->_viewPath . "retailer-signup.php";
      $this->load->view($this->_frontContainer, $this->data);
    }




   
    function productdetails(){
        $productId = $this->uri->segment("2");
        $data = get_product_list("","","","","",$productId);

        $dataSet = array();
        // GEt Product Compare Detail
        if($productId != NULL &&  $productId > 0){
            $this->db->select('tbl_products.*');
            $this->db->from('tbl_products');
            $this->db->where(array("tbl_products.product_id"  => $productId));
            $productInfo=$this->db->get()->result_array();        
            
            $this->db->select('tbl_products.*,tbl_stores.store_name,tbl_stores.store_image');
            $this->db->from('tbl_products');
            $this->db->join('tbl_stores', 'tbl_stores.store_id = tbl_products.store_id');
            $this->db->where(array("tbl_products.brand_id"  =>$productInfo[0]['brand_id'],
               "tbl_products.category_id"  => $productInfo[0]['category_id'],
            "tbl_products.subcategory_id"  =>  $productInfo[0]['subcategory_id']));
            $this->db->where('tbl_products.product_id !=',$productId);
            $dataSet['compare_list'] =$this->db->get()->result_array();
            //echo '<prE>';print_r($data);
        }         
       
        
        if(sizeof($data) > 0){
          $this->data['page_title'] = SITE_TITLE.' :: Product details';
          $this->data['page'] = $this->_viewPath . "product-details.php";
          $this->data['product_data'] = $data;
          $this->data['compare_list'] = $dataSet['compare_list'];
          $this->load->view($this->_frontContainer, $this->data);
        }else{
          echo show_404(); 
        }

    }




    function signupstore(){
        $this->data['page_title'] = SITE_TITLE.' :: Retailer Signup';
        $this->data['page'] = $this->_viewPath . "retailer-signup.php";
        $this->load->view($this->_frontContainer, $this->data);
    }


    function signout(){
      $this->session->sess_destroy();
      redirect("./home");
    }



    function index() {

    	$this->data['is_home_page'] = 'Yes';
    	$this->data['page_title'] = SITE_TITLE.' :: Home';
      $this->data['page'] = $this->_viewPath . "home.php";
      $this->data['show_promotion'] = true;
      $this->load->view($this->_frontContainer, $this->data);
    }


    function view(){
       $slug = $this->uri->segment(2);  
       $data =  $this->Common->get_all_record("tbl_page",array("slug"=>$slug));
       $title = "";
       if( !empty( $data )){
          $title = SITE_TITLE.' '.$data[0]->page_title;
          /*
          if($slug=="terms-of-use"){
            $title = "CashVertise Terms of Use";
          }else if($slug=="privacy-policy"){
            $title = "CashVertise Privacy & Cookies Policy";
          }else{
               
          }
          */
       }else{
          $title = "Page Not Found";
       }
       
       $this->data['page_title'] = $title;
       $this->data['data_page'] = $data;
       $this->data['page'] = $this->_viewPath . "dynamic-page.php";
       $this->load->view($this->_frontContainer, $this->data);
    }


    function loaddynamicpage(){
        $linkUrl = $this->uri->segment(4);
    }


    function footerlinkview(){
            $columns = [0 =>'title',1 =>'slug', 2=>'meta_keywords', 3=>'status', 4=>'option'];
            $imageColumns = [];
            $searchableColumns = [0 =>'title'];
            $colDef['title'] =  ['target' => 0, 'visible' => true, 'searchable' => true];
            $join['tbl_page']['onCloumn'] = 'page_id';
            $join['tbl_page']['type'] = 'inner'; //inner, left, right
            $select['main_table'] = ['id'=>'id','title'=>'title'];
            $select['tbl_page'] = ['slug'=>'slug','meta_keywords'=>'meta_keywords','status'=>'status'];
            if($this->input->get('ajax')==1){
              $options = '<a href="'.site_url('admin/editfooterlink/[id]').'" title="Edit" class="btn-xs btn btn-warning">Edit</a>';
              $data = $this->paginateJoin($this->Footerlink, $join, $select, $columns, $searchableColumns, $options, $imageColumns);
              echo $data;exit;
            }else{
                $paginationConfig = $this->config->item('pagination');
                $this->data['page_title'] = SITE_TITLE.' :: Manage footer link';
                $this->data['page'] = $this->_viewPath . "view-footer-link.php";
                $this->data['useDataTables'] = true;
                $this->data['columns'] = $columns;
                $this->data['colDef'] = $colDef;
                $this->data['default_order_col'] = 3;
                $this->data['default_order_dir'] = $paginationConfig['default_order_dir'];
                $this->data['default_page_length'] = 10;//$paginationConfig['default_page_length'];
                $this->load->view($this->_adminContainer, $this->data);

            }
    }


     


    function addfooterlinkview($id=""){
            $where = array("id"=>$id);
            $this->data['data'] = $this->Common->get_all_record("tbl_page",array());
            if($id != ""){
              $this->data['rec'] =    $this->Common->get_all_record("tbl_footer_links",$where);  
            }else{
              $this->data['rec'] =    array(); 
            }

            $this->data['page_title'] = SITE_TITLE.' :: Add footer link';
            $this->data['page'] = $this->_viewPath . "add-footer-link.php";
            $this->load->view($this->_adminContainer, $this->data); 
 
    }





    function editfooterlink(){
        $id = $this->uri->segment(3);
        if($id != ""){
            $this->addfooterlinkview($id);
        }else{
            echo show_404();
        }
    }


    function addfooterlink(){
        if(count($_POST) > 0){
            $this->setRules("FOOTER_LINK");
            $id      = $this->input->post('id');
            if($this->form_validation->run()){
                 $pageId                = $this->input->post('page_id');
                 $title               = $this->input->post('title');
                 $where = array("title"=>$title);
                 if($id != ""){
                   $where["id !="] = $id;
                 }
                 
                 if($this->Common->_is_record_exits("tbl_footer_links",$where)){
                    $this->session->set_userdata(GLOBAL_MSG,"This link already used!!!");
                 }else{
                    $insArray =  array(
                        "page_id" =>$pageId,
                        "title" =>$title
                    );

                    if($id == ""){
                        $insArray["created"]                = date("Y-m-d");
                         if($this->Common->_insert("tbl_footer_links",$insArray)){
                            $this->session->set_userdata(GLOBAL_MSG,"Page link added successfully");
                         }else{
                            $this->session->set_userdata(GLOBAL_MSG,SOMETHING_WENT_WRONG_PLEASE_TRY_LATER);
                         }
                     }else{
                         $this->db->where(array("id"=>$id));
                          $this->db->update("tbl_footer_links",$insArray);
                          if($this->db->affected_rows() > 0){
                             $this->session->set_userdata(GLOBAL_MSG,"Page link update successfully"); 
                          }else{
                             $this->session->set_userdata(GLOBAL_MSG,SOMETHING_WENT_WRONG_PLEASE_TRY_LATER);
                          }
                     }
                 }

            }else{
                 $this->session->set_userdata(GLOBAL_MSG,filter_validation_errors());
            }

            if($id == ""){
               $this->addfooterlinkview(); 
             }else{
                redirect("./admin/editfooterlink/".$id);
             }

        }else{
            $this->addfooterlinkview();    
        }
    }





    function viewinvoice(){
        $orderId      = $this->uri->segment(2);
        $invoiceId      = $this->uri->segment(3);
        $advertiserId = $this->Common->get_advertiser_id();
        $where        = array("user_id"=>$advertiserId);
        $whereOrder   = array("tbl_orders.id"=>$orderId);
 
        if($this->Common->isRecordExits("tbl_orders",$where)){
          $data = $this->Common->getorderAdvertiserDetails($whereOrder);

          $this->data['page_title'] = SITE_TITLE.' :: View Invoice';
          $this->data['page'] = $this->_viewPath . "invoice.php";
          $this->data['details'] = $data;
          $this->data['invoice_id'] = $invoiceId;
          $this->load->view($this->_frontContainer, $this->data);
          
        }else{
          echo show_404();
        } 
    }


     function viewrefund(){
        $orderId      = $this->uri->segment(2);
        $advertiserId = $this->Common->get_advertiser_id();
        $where        = array("user_id"=>$advertiserId);
        $whereOrder   = array("tbl_orders.id"=>$orderId);
 
        if($this->Common->isRecordExits("tbl_orders",$where)){
          $data = $this->Common->getorderAdvertiserDetails($whereOrder);

          $this->data['page_title'] = SITE_TITLE.' :: View Refunds';
          $this->data['page'] = $this->_viewPath . "refund.php";
          $this->data['details'] = $data;
          $this->load->view($this->_frontContainer, $this->data);
          
        }else{
          echo show_404();
        } 
    }


  

    public function logout(){
        $this->session->sess_destroy();
        redirect('/');
    }


    function forgotpassword(){
            $this->form_validation->set_rules('user_email', 'User email','trim|required');
            $this->form_validation->set_rules('user_type', 'User type','trim|required');
            if($this->form_validation->run()) {
                $user_email         = $this->input->post("user_email");
                $user_type          = $this->input->post("user_type");


                if($user_type == "sell"){
                    $user_type = "S";
                }else{
                    $user_type = "U";
                }
                $where = array(
                        "store_email" =>$user_email,
                        "user_type" =>$user_type
                );

                
                if($this->Common->_is_record_exits("tbl_stores",$where)){
                        $data = $this->Common->getRecordById("tbl_stores",$where);
                        $password = base64_decode($data[0]->enk_key);
                        
                        if($this->EmailTemplate->sendForgotPasswordEmail($data[0]->store_name,$user_email,$password)){
                            $this->session->set_userdata(GLOBAL_MSG_FRONT,LOGIN_CREDENTIALS_SENT_TO_EMAIL);
                        }else{
                            $this->session->set_userdata(GLOBAL_MSG_FRONT,SOMETHING_WENT_WRONG_PLEASE_TRY_LATER);
                        }
                }else{
                    $this->session->set_userdata(GLOBAL_MSG_FRONT,EMAIL_NOT_REGISTER_WITH_US);                      
                }
            }else{
                $this->session->set_userdata(GLOBAL_MSG_FRONT,filter_validation_errors());                   
            }

            $this->data['page_title'] = SITE_TITLE.' :: Forgot password';
            $this->data['page'] = $this->_viewPath . "forgot-password.php";
            $this->load->view($this->_frontContainer, $this->data); 
    }


    function changepassword(){
        $this->Common->is_adveritser_login();
        if(count($_POST) > 0){
             $this->setRules("CHANGE_PASSWORD");
             if($this->form_validation->run()){

                $oldPassword = $this->input->post("old_password");
                $newPassword = $this->input->post("new_password");
                $where = array("id"=>$this->Common->get_advertiser_id(),"password"=>md5($oldPassword));

                if($this->Common->_is_record_exits("tbl_advertiser",$where)){

                    $insArray = array(
                        "password"  =>  md5($newPassword),
                        "enk_key"   =>  base64_encode($newPassword),
                        "modified"   =>  date("Y-m-d H:i:s")
                    );
                    
                    $this->db->where(array("id"=>$this->Common->get_advertiser_id()));  
                    $this->db->update("tbl_advertiser",$insArray);
                    if($this->db->affected_rows() > 0){
                       $this->session->set_userdata(GLOBAL_MSG_FRONT,PASSWORD_CHANGE_SUCCESS);
                    }else{
                       $this->session->set_userdata(GLOBAL_MSG_FRONT,SOMETHING_WENT_WRONG_PLEASE_TRY_LATER); 
                    }

                }else{
                   $this->session->set_userdata(GLOBAL_MSG_FRONT,INVALID_OLD_PASSWORD); 
                }
            }else{
                $this->session->set_userdata(GLOBAL_MSG_FRONT,filter_validation_errors());
            }
         }

        $this->data['page_title'] = SITE_TITLE.' :: Change password';
        $this->data['page'] = $this->_viewPath . "change-password.php";
        $this->load->view($this->_frontContainer, $this->data); 

    }
 
    function faq(){
        $this->data['page_title'] = SITE_TITLE.' :: Faq';
        $this->data['page'] = $this->_viewPath . "faq.php";
        $orderBy = "modified_at";
        $this->data['data'] = $this->Common->_get_all_records("tbl_faq",array(),$orderBy);
        $this->load->view($this->_frontContainer, $this->data);
    }


    function loadContactView(){
        $this->data['page_title'] = SITE_TITLE.' :: Contact us';
        $this->data['page'] = $this->_viewPath . "contact-us.php";
        $this->load->view($this->_frontContainer, $this->data);
    }


    function profile(){
        $this->Common->is_adveritser_login();
        $this->data['page_title'] = SITE_TITLE.' :: Welcome';
        $this->data['page'] = $this->_viewPath . "profile.php";
        $this->load->view($this->_frontContainer, $this->data);
    }

    function editprofile(){
        $this->Common->is_adveritser_login();
         if(count($_POST) > 0){
             $this->setRules("USER_EDITPROFILE");
             if($this->form_validation->run()){
                $email    = $this->input->post("email");
                $contact  = $this->input->post("contact_number");

                $where          = array("email"=>$email,"status <> "=>'Deleted',"id <>"=>$this->Common->get_advertiser_id());
                $whereContact   = array("contact_number"=>$contact,"status <> "=>'Deleted',"id <>"=>$this->Common->get_advertiser_id());


                if($this->Common->_is_record_exits("tbl_advertiser",$where)){
                    $this->session->set_userdata(GLOBAL_MSG_FRONT,"This email is already register with us!!!");
                }else if($this->Common->_is_record_exits("tbl_advertiser",$whereContact)){
                    $this->session->set_userdata(GLOBAL_MSG_FRONT,"This phone number is already register with us!!!");
                }else{
                      $insArray = array(
                        "fname"=>$this->input->post("fname"),
                        "lname"=>$this->input->post("lname"),
                        "email"=>$this->input->post("email"),
                        "contact_number"=>$this->input->post("contact_number"),
                        "company_name"=>$this->input->post("comp_name")
                    );

                    $this->db->where(array("id"=>$this->Common->get_advertiser_id()));  
                    
                    
                    if($this->db->update("tbl_advertiser",$insArray)){
                       $this->session->set_userdata(GLOBAL_MSG_FRONT,PROFILE_UPDATE_SUCCESS);
                    }else{
                       $this->session->set_userdata(GLOBAL_MSG_FRONT,"Something went wrong please try again later"); 
                    }
                }


                
            }else{
                $this->session->set_userdata(GLOBAL_MSG_FRONT,filter_validation_errors());
            }
         }

        $this->data['page_title'] = SITE_TITLE.' :: Edit Profile';
        $this->data['page'] = $this->_viewPath . "edit-profile.php";
        $this->load->view($this->_frontContainer, $this->data);
    }
    






    function contactus() {
        if(count($_POST) > 0){
            $this->setRules("USER_CCONTACT");
            if($this->form_validation->run()){
                $email = $this->input->post("email");
                $userName = $this->input->post("fname");

                $insArray = array(
                    "fname"=>$this->input->post("fname"),
                    "lname"=>$this->input->post("lname"),
                    "email"=>$this->input->post("email"),
                    "contact_number"=>$this->input->post("contact"),
                    "msg"=>$this->input->post("message")
                );

                if($this->db->insert("tbl_contact_form_data",$insArray)){
                   //$this->EmailTemplate->contactusreplymail($email,AUTO_REPLY_EMAIL_MESSAGE,$userName);
                   $this->session->set_userdata(GLOBAL_MSG_FRONT,"Enquiry sent successfully");
                }else{
                   $this->session->set_userdata(GLOBAL_MSG_FRONT,"Something went wrong please try again later"); 
                }
            }else{
                $this->session->set_userdata(GLOBAL_MSG_FRONT,filter_validation_errors());
            }
        }
        $this->loadContactView();
    }

	 	
}