<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
//require_once(BASEPATH.'core/MY_Controller.php');
require_once FCPATH . '/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Myaccount extends MY_Controller {
    
    var $styleArray = [];

    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');    
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        log_message('debug', 'CI My Admin : Auth class loaded');
        $this->load->model('Order');
        $this->load->model('Footerlink');
        $this->load->model('Transactions');
        $this->load->model('EmailTemplate');



        if(is_store_login()){ 
          if(login_user_type() == "U"){
            echo show_404();
          }
        }else{
          show_404();
        }

         $this->styleArray = array(
            'font' => array(
                'bold' => true,
                ),
            'alignment' => array(
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ),
            'borders' => array(
                'top' => array(
                    'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ),
                ),
            'fill' => array(
                'type' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
                'rotation' => 90,
                'startcolor' => array('argb' => 'FFA0A0A0'),'endcolor' => array('argb' => 'FFFFFFFF')));
    }



  function exportexcelfile(){
    $storeId   = get_store_id();
    $dataArray = $this->db->query("select * from tbl_products where store_id  = '$storeId' ")->result();


    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $spreadsheet->getActiveSheet()->getStyle('A1:V1')->applyFromArray($this->styleArray);
    $spreadsheet->getDefaultStyle()->getAlignment()->setWrapText(true);
    $spreadsheet->setActiveSheetIndex(0)
    ->setCellValue("A1",'Product Name')
    ->setCellValue("B1",'Product Image')
    ->setCellValue("C1",'Brand Id')
    ->setCellValue("D1",'Category Id')
    ->setCellValue("E1",'Subcategory Id')
    ->setCellValue("F1",'Sku')
    ->setCellValue("G1",'Price')
    ->setCellValue("H1",'Vat Percentage')
    ->setCellValue("I1",'Year')
    ->setCellValue("J1",'Weight')
    ->setCellValue("K1",'Weight Type')
    ->setCellValue("L1",'Length')
    ->setCellValue("M1",'Width')
    ->setCellValue("N1",'Depth')
    ->setCellValue("O1",'Dimension Type')
    ->setCellValue("P1",'Shipping')
    ->setCellValue("Q1",'Description')
    ->setCellValue("R1",'Specification')
    ->setCellValue("S1",'Allow_cart')
    ->setCellValue("T1",'Is Home Product')
    ->setCellValue("U1",'Created At')
    ->setCellValue("V1",'Modified At')
    ;
    $x= 2;

    foreach($dataArray as $resultObj){
          $spreadsheet->setActiveSheetIndex(0)
          
          ->setCellValue("A$x",$resultObj->product_name)
          ->setCellValue("B$x",$resultObj->product_image)
          ->setCellValue("C$x",$resultObj->brand_id)
          ->setCellValue("D$x",$resultObj->category_id)
          ->setCellValue("E$x",$resultObj->subcategory_id)
          ->setCellValue("F$x",$resultObj->sku)
          ->setCellValue("G$x",$resultObj->price)
          ->setCellValue("H$x",$resultObj->vat_percentage)
          ->setCellValue("I$x",$resultObj->year)
          ->setCellValue("J$x",$resultObj->weight)
          ->setCellValue("K$x",$resultObj->weight_type)
          ->setCellValue("L$x",$resultObj->length)
          ->setCellValue("M$x",$resultObj->width)
          ->setCellValue("N$x",$resultObj->depth)
          ->setCellValue("O$x",$resultObj->dimension_type)
          ->setCellValue("P$x",$resultObj->shipping)
          ->setCellValue("Q$x",$resultObj->description)
          ->setCellValue("R$x",$resultObj->specification)
          ->setCellValue("S$x",$resultObj->allow_cart)
          ->setCellValue("T$x",$resultObj->is_home_product)
          ->setCellValue("U$x",$resultObj->created_at)
          ->setCellValue("V$x",$resultObj->modified_at)
          ;
          $x++;
      }
      
      $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
      $fileName       =  "Productslist".strtotime(date("Y-m-d H:i:s")).".Xlsx";
      header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
      header('Content-Disposition: attachment; filename="'. urlencode($fileName).'"');
      $writer->save('php://output');

  }  
    

  function importexcelfile(){
        $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        if(isset($_FILES['excel_file']['name']) && in_array($_FILES['excel_file']['type'], $file_mimes)) {
              $arr_file = explode('.', $_FILES['excel_file']['name']);
              $extension = end($arr_file);
              if('csv' == $extension){
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
              } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
              }
              $spreadsheet = $reader->load($_FILES['excel_file']['tmp_name']);
              $sheetData = $spreadsheet->getActiveSheet()->toArray();
              
              if(sizeof($sheetData) > 0){
                if(count($sheetData[0]) == 22){
                  for($i=1;$i<count($sheetData);$i++){
                      $row = $sheetData[$i];

                      $insArray = array(
                        "store_id"=>get_store_id(),
                        "product_name"=>(is_null($row[0])) ? "" : $row[0],
                        "product_image"=>(is_null($row[1])) ? "" : $row[1],
                        "brand_id"=>$row[2],
                        "category_id"=>$row[3],
                        "subcategory_id"=>$row[4],
                        "sku"=>(is_null($row[5])) ? "" : $row[5],
                        "price"=>$row[6],
                        "vat_percentage"=>$row[7],
                        "year"=>(is_null($row[8])) ? "" : $row[8],
                        "weight"=>(is_null($row[9])) ? "" : $row[9],
                        "weight_type"=>(is_null($row[10])) ? "" : $row[10],
                        "length"=>(is_null($row[11])) ? "" : $row[11],
                        "width"=>(is_null($row[12])) ? "" : $row[12],
                        "depth"=>(is_null($row[13])) ? "" : $row[13],
                        "dimension_type"=>(is_null($row[14])) ? "" : $row[14],
                        "shipping"=>(is_null($row[15])) ? "" : $row[15],
                        "description"=>(is_null($row[16])) ? "" : $row[16],
                        "specification"=>(is_null($row[17])) ? "" : $row[17],
                        "allow_cart"=>(is_null($row[18])) ? "yes" : $row[18],
                        "is_home_product"=>(is_null($row[19])) ? "yes" : $row[19],
                        "created_at"=>date("Y-m-d H:i:s"),
                        "modified_at"=>date("Y-m-d H:i:s")
                      );
                      $this->Common->_insert("tbl_products",$insArray);
                  }
                  $this->session->set_userdata(GLOBAL_MSG,"Importing success");  
                }else{
                  $this->session->set_userdata(GLOBAL_MSG,"It seems this excel is invalid");  
                }
              }else{
                $this->session->set_userdata(GLOBAL_MSG,"It seems this excel file is empty");
              }
        }else{
          $this->session->set_userdata(GLOBAL_MSG,"Please select a file to upload");
        }

        redirect("./myaccount/listproducts");
  }


    function setRules($options){
        if($options == "ADD_PRODUCT"){
            $this->form_validation->set_rules('category_id', 'Category Id','trim|required');
            $this->form_validation->set_rules('subcategory_id', 'Sub Category','trim|required');
            $this->form_validation->set_rules('price', 'Price','trim|required');
            $this->form_validation->set_rules('product_name', 'Product Name','trim|required');
            $this->form_validation->set_rules('description', 'Description','trim|required');

        }else if($options == "UPDATE_STORE_PROFILE"){
            $this->form_validation->set_rules('shipping_policy', 'Shipping Policy','trim|required');
            $this->form_validation->set_rules('return_policy', 'Return Policy','trim|required');
            $this->form_validation->set_rules('shipping_delivery', 'Shipping Delivery','trim|required');
            $this->form_validation->set_rules('shipping_amount', 'Shipping Amount','trim|required');
            
        } 
    } 



    
    function vieworder(){
      $order_id = $this->uri->segment(3);
      if($order_id != ""){
        $this->data['page_title'] = SITE_TITLE.' :: View Order';
        $this->data['page'] = $this->_viewPath . "view-order.php";
        $this->data['data_product']  = $this->Common->_get_all_records("tbl_order",["order_id"=>$order_id]);
        $this->load->view($this->_my_account_container, $this->data);
      }
    }


    function myorders(){
      $this->data['page_title'] = SITE_TITLE.' :: List Orders';
      $this->data['page'] = $this->_viewPath . "my-orders.php";

      $this->data['data_product']  = $this->Common->_get_all_records("tbl_order",["store_id"=>get_store_id()],'order_id');
      
      $this->load->view($this->_my_account_container, $this->data);
    }
    

    function enquiery(){
      $this->data['page_title'] = SITE_TITLE.' :: Enquiery';
      $this->data['page'] = $this->_viewPath . "enquiery.php";
      $this->data['list_data']  = $this->Common->_get_all_records("tbl_seller_has_enquiery",["store_id"=>get_store_id()]);
      $this->load->view($this->_my_account_container, $this->data);
    }


    function doupdatestoreprofile(){
      $data = array(); 
      if(count($_POST) > 0){
        $this->setRules("UPDATE_STORE_PROFILE");
        if($this->form_validation->run()){
          $shipping_policy        = $this->input->post("shipping_policy");  
          $return_policy          = $this->input->post("return_policy");  
          $shipping_delivery      = $this->input->post("shipping_delivery");  
          $shipping_amount        = $this->input->post("shipping_amount");  
          $free_delivery_after_payment        = $this->input->post("free_delivery_after_payment");  
          $cod_charges                 = $this->input->post("cod_charges");
          $cod_available                 = $this->input->post("cod_available");
          $vat_number                 = $this->input->post("vat_number");
          
         
          $insArray = array(
              "free_delivery_after_payment"=>$free_delivery_after_payment,
              "shipping_policy"=>$shipping_policy,
              "return_policy"=>$return_policy,
              "shipping_delivery"=>$shipping_delivery,
              "shipping_amount"=>$shipping_amount,
              "cod_charges"=>$cod_charges,
              "cod_available"=>$cod_available,
              "vat_number"=>$vat_number,
              "modified_at"=>date("Y-m-d H:i:s")
          );  



          if (isset($_FILES['store_image']) && $_FILES['store_image']['name']!=""){
                $insArray["store_image"]  =  upload_image('store_image',IMAGE_PATH_ABSULATE.STORES_FOLDER);
          }

          $this->db->where(array("store_id"=>get_store_id()));
          $this->db->update("tbl_stores",$insArray);
          $this->session->set_userdata(GLOBAL_MSG,"Details updated successfully");
          
         }else{
            $this->session->set_userdata(GLOBAL_MSG,filter_validation_errors());
         }
        
      }
      redirect("./myaccount/updatestoredetails");
    }


    function updatestoredetails() {
      $this->data['page_title'] = SITE_TITLE.' :: Update Profile';
      $this->data['page'] = $this->_viewPath . "update-store-details.php";
      $this->data['store_details']  = $this->Common->_get_all_records("tbl_stores",["store_id"=>get_store_id()]);
      $this->load->view($this->_my_account_container, $this->data);
    }
      


    function index() {
      $this->data['page_title'] = SITE_TITLE.' :: Myaccount';
      $this->data['page'] = $this->_viewPath . "myaccount.php";
      $this->load->view($this->_my_account_container, $this->data);
    }



    function updateProfile(){
            $store_name           = $this->input->post("business_name");
            $owner_first_name     = $this->input->post("owner_first_name");
            $owner_last_name      = $this->input->post("owner_last_name");
            $unit_level              = $this->input->post("unit_level");
            $address              = $this->input->post("address");
            $store_email          = $this->input->post("store_email");
            $store_mobile         = $this->input->post("store_mobile");
            $business_name        = $this->input->post("business_name");
           
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
            

            $whereName        = ["store_name"=>$store_name,"store_id <> "=>get_store_id()];  
            $whereEmail       = ["store_email"=>$store_email,"store_id <> "=>get_store_id()];  
            $wherePhone       = ["store_mobile"=>$store_mobile,"store_id <> "=>get_store_id()];  


            

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
                    'account_name'  => $account_name, 
                    'swift_code'  => $swift_code, 
                    'country'  => $country, 
                    'state'  => $state, 
                    'city'  => $city, 
                    'account_number'  => $account_number, 
                    'modified_at' => date("Y-m-d H:i:s") 
                );

                if($this->Common->_update("tbl_stores",$insArray,["store_id"=>get_store_id()])){
                     $this->session->set_userdata(GLOBAL_MSG,"Store created successfully. You will be notified once your account has been verified");
                }else{
                    $this->session->set_userdata(GLOBAL_MSG,"Something went wrong please try again later");
                }
            }
            
          redirect("./myaccount/settings");

    }



    function settings() {
      $this->data['page_title'] = SITE_TITLE.' :: Account Settings';
      $this->data['page']       = $this->_viewPath . "update-profile.php";
      $store_details            = $this->data['store_details']  = $this->Common->_get_all_records("tbl_stores",["store_id"=>get_store_id()]);
      
      $countryId = $store_details[0]->country;
      $stateId   = $store_details[0]->state;

      $this->data['states']  = $this->Common->_get_all_records("states",["country_id"=>$countryId]);
      $this->data['cities']  = $this->Common->_get_all_records("cities",["state_id"=>$stateId]);


      $this->load->view($this->_my_account_container, $this->data);
    }



     function editproducts(){
        $product_id = $this->uri->segment(3);
        if($product_id != ""){
           $data = $this->Common->_get_all_records("tbl_products",array("product_id"=>$product_id));
           $this->addproducts($data);

        }else{
          echo show_404();
        }
    }

    function addproducts($data = array()) {
      $this->data['page_title'] = SITE_TITLE.' :: Add Products';
      $this->data['page'] = $this->_viewPath . "addproducts.php";
      $this->data['data_product']  = $data;
      $this->load->view($this->_my_account_container, $this->data);
    }

    function listproducts() {
      $search_pro ='';
       
      if(isset($_POST['search_pro']) && $_POST['search_pro'] != '' ){
        $search_pro = $_POST['search_pro'];
        $dataOf = $this->Common->getAllProductsInSellerDashboard("tbl_products",
                                    [
                                      "store_id"=>get_store_id(),
                                      "is_active <> "=>"Deleted"
                                    ],"",$search_pro
                                  );
      }else{
         $dataOf = $this->Common->getAllProductsInSellerDashboard("tbl_products",["store_id"=>get_store_id(),"is_active <> "=>"Deleted"]);
      }

      $this->data['page_title'] = SITE_TITLE.' :: My Products';
      $this->data['page'] = $this->_viewPath . "listproducts.php";
      $this->data['data_product']  =$dataOf ; 
      $this->data['search_pro']  =$search_pro ; 
      $this->load->view($this->_my_account_container, $this->data);
    }


    function doaddproduct(){
    
      $data = array(); 
      if(count($_POST) > 0){
        $this->setRules("ADD_PRODUCT");
        if($this->form_validation->run()){
          $product_name            = $this->input->post("product_name");  
          $brand_id        = $this->input->post("brand_id");  
          $category_id     = $this->input->post("category_id");  
          $subcategory_id     = $this->input->post("subcategory_id");  
          $price     = $this->input->post("price");  
          $year     = $this->input->post("year");  
          $weight     = $this->input->post("weight");  
          $weight_type     = $this->input->post("weight_type");  
          $length     = $this->input->post("length");  
          $width     = $this->input->post("width");  
          $depth     = $this->input->post("depth");  
          $dimension_type     = $this->input->post("dimension_type");  
          $description        = $this->input->post("description");  
          $specification      = $this->input->post("specification");  
          $product_id         = $this->input->post("product_id");  
          $sku                = $this->input->post("sku");  
          $is_active          = "Active";  
          $is_home_product    = "yes";  
          $shipping           = "";  

          $vat_percentage = 0;
          if(is_store_have_vat(get_store_id())){
            $vat_percentage = 21;
          }

          $insArray = array(
              "product_name"=>$product_name,
              "brand_id"=>$brand_id,
              "store_id"=>get_store_id(),
              "category_id"=>$category_id,
              "subcategory_id"=>$subcategory_id,
              "price"=>$price,
              "sku"=>$sku,
              "year"=>$year,
              "weight"=>$weight,
              "vat_percentage"=>$vat_percentage,
              "weight_type"=>$weight_type,
              "length"=>$length,
              "width"=>$width,
              "depth"=>$depth,
              "dimension_type"=>$dimension_type,
              "shipping"=>$shipping,
              "description"=>$description,
              "specification"=>$specification,
              "is_active"=>$is_active,
              "is_home_product"=>$is_home_product,
              "modified_at"=>date("Y-m-d H:i:s")
          );  

          if (isset($_FILES['product_image']) && $_FILES['product_image']['name']!=""){
                $insArray["product_image"]  =  upload_image('product_image',IMAGE_PATH_ABSULATE.PRODUCT_FOLDER);
          }

          if($product_id != ""){  
              $this->db->where(array("product_id"=>$product_id));
              $this->db->update("tbl_products",$insArray);
              $this->session->set_userdata(GLOBAL_MSG,"Product updated successfully");
              redirect("./myaccount/editproducts/".$product_id);
          }else{
              $insArray["created_at"]  =  date("Y-m-d H:i:s");
              //$insArray["vat_percentage"]  =  get_meta_value("vat_percentage");
              if($this->db->insert("tbl_products",$insArray)){
                $this->session->set_userdata(GLOBAL_MSG,"Product added successfully");
              }else{
                $this->session->set_userdata(GLOBAL_MSG,"Something went wrong please try again later");
              }
          }  
         }else{
            $this->session->set_userdata(GLOBAL_MSG,filter_validation_errors());
         }
        
      }
      $this->addproducts($data);
    }



    



    function logout(){
      $this->session->sess_destroy();
      redirect("./home");
    }

    
    
}