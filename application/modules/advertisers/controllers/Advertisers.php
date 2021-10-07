<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//require_once(BASEPATH.'core/MY_Controller.php');
class Advertisers extends MY_Controller {
  function __construct() {
        parent::__construct();
        $this->load->model('Advertiser');
       	$this->load->library('form_validation');    
  		  $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->Common->is_admin_login();


    }

    function setRules($options){
        if($options == "ADD_ADVERTISER"){
            $this->form_validation->set_rules('firstName', 'first name','trim|required');
            $this->form_validation->set_rules('lastName', 'last name','trim|required');
            $this->form_validation->set_rules('email', 'email','trim|required');
            $this->form_validation->set_rules('password', 'Password','trim|required');
            $this->form_validation->set_rules('companyName', 'companyName','trim|required');
            $this->form_validation->set_rules('contact', 'contact','trim|required');
        }
    }



    function deleteadvertiser(){

      $delteUserArray =  $this->input->post("actions");
        if(sizeof($delteUserArray) == 0){
            $this->session->set_userdata(GLOBAL_MSG,"Please select atleast one refund !!");
        }else{
            for ($i=0; $i <count($delteUserArray) ; $i++) { 
              $advertiseId =  $delteUserArray[$i];

              $this->db->where(array("id"=>$advertiseId));
              $updateArray = array("status"=>"Deleted");
              
              $this->db->update("tbl_advertiser",$updateArray);
            }

            $this->session->set_userdata(GLOBAL_MSG,"Advertiser deleted successfully");
        }
        
        redirect("./admin/advertisers");

    }




    function delete(){
        $advertiserId = $this->uri->segment(3);
        $this->db->where(array("id"=>$advertiserId));
        $updateArray = array("status"=>"Deleted");
        $this->db->update("tbl_advertiser",$updateArray);
        if($this->db->affected_rows() > 0){
            echo "YES";
        }else{
            echo "NO";
        } 
    }

    
    function assignpartner(){
        $advertiserId = $this->uri->segment(3);
        $this->db->where(array("id"=>$advertiserId));
        $updateArray = array("is_partner"=>"yes");
        $this->db->update("tbl_advertiser",$updateArray);
        if($this->db->affected_rows() > 0){
            echo "YES";
        }else{
            echo "NO";
        } 
    }

    function unassignpartner(){
        $advertiserId = $this->uri->segment(3);
        $this->db->where(array("id"=>$advertiserId));
        $updateArray = array("is_partner"=>"no");
        $this->db->update("tbl_advertiser",$updateArray);
        if($this->db->affected_rows() > 0){
            echo "YES";
        }else{
            echo "NO";
        } 
    }


    function approve(){
        $advertiserId = $this->uri->segment(3);
        $this->db->where(array("id"=>$advertiserId));
        $updateArray = array("status"=>"Approved");
        $this->db->update("tbl_advertiser",$updateArray);
        if($this->db->affected_rows() > 0){
            echo "YES";
        }else{
            echo "NO";
        } 
    }


    function inactive(){
        $advertiserId = $this->uri->segment(3);
        $this->db->where(array("id"=>$advertiserId));
        $updateArray = array("status"=>"Inactive");
        $this->db->update("tbl_advertiser",$updateArray);
        if($this->db->affected_rows() > 0){
            echo "YES";
        }else{
            echo "NO";
        } 
    }

    function index() {

        $this->db->update("tbl_advertiser",array("seen_status"=>"true"));


        $columns = [0 =>'check',1 =>'id',2 =>'fname',3 =>'lname',4=> 'email', 5=> 'contact_number', 6=> 'company_name', 7 =>'created', 8 =>'is_partner',9=>'status', 10=>'option'];
        $imageColumns = [];
        $searchableColumns = [0 =>'id',1 =>'fname',2 =>'lname',3=> 'email', 4=> 'contact_number', 5=> 'company_name', 6 =>'created', 7 =>'is_partner',8=>'status'];
        
        $colDef['fname'] =  ['target' => 0, 'visible' => true, 'searchable' => true];
        if($this->input->get('ajax')==1){
          //Row action options
          $options = '<a href="'.site_url('editadvertiser/[id]').'" title="Edit" class="btn-xs btn btn-primary">Edit</a>';
          $options .= '<a href="'.site_url('admin/advertiser/view/[id]').'" title="View" class="btn-xs btn btn-success">View</a>';
          

          //$options .= '<a href="admin/advertiser/delete/[id]" title="View" class="btn-xs btn btn-danger">Delete</a>';
          //get paginated records for jquery datatables
          $where = array("status <> "=>"Deleted" , "is_email_verified"=>"Yes");
          $data = $this->ajaxAdvertiserList($this->Advertiser, $columns, $searchableColumns, $options, $imageColumns,  $where,"Delete","Active","status","Deleted");
          echo $data;exit;
        }
        else{
          $paginationConfig = $this->config->item('pagination');
          $this->data['page_title'] = SITE_TITLE.' :: Adveritser list';
          $this->data['page'] = $this->_viewPath . "advertiser.php";
          $this->data['useDataTables'] = true;
          $this->data['columns'] = $columns;
          $this->data['colDef'] = $colDef;
          $this->data['default_order_col'] = 1;
          $this->data['default_order_dir'] = $paginationConfig['default_order_dir'];
          $this->data['default_page_length'] = 10;//$paginationConfig['default_page_length'];
          $this->load->view($this->_adminContainer, $this->data);
        }
    }




    function loadAddView($data = array()){
          $this->data['page_title'] = SITE_TITLE.' :: Adveritser';
          $this->data['page'] = $this->_viewPath . "add.php";
          $this->data['data'] = $data;
          $this->load->view($this->_adminContainer, $this->data);
    }


    

    function view(){
      $advertiserId = $this->uri->segment(4);
      if($advertiserId != ""){
        $where = array("id"=>$advertiserId);
        $data = $this->Common->get_all_record("tbl_advertiser",$where);
        $this->data['page_title'] = SITE_TITLE.' :: View Adveritser';
        $this->data['page'] = $this->_viewPath . "view.php";
        $this->data['data'] = $data;
        $this->load->view($this->_adminContainer, $this->data);
      }else{
        echo show_404();
      }
    }

    function editadvertiser(){
      $advertiserId = $this->uri->segment(2);
      if($advertiserId != ""){
        $where = array("id"=>$advertiserId);
        $data = $this->Common->get_all_record("tbl_advertiser",$where);
        $this->loadAddView($data);
      
      }else{
        echo show_404();
      }
    }




    function addadvertiser(){
      $id  = "";
      if(count($_POST)){
        $this->setRules("ADD_ADVERTISER");
        $id      = $this->input->post('id');

        if($this->form_validation->run()){
          $fName          = $this->input->post('firstName');
          $lName          = $this->input->post('lastName');
          $email          = $this->input->post('email');
          $password       = $this->input->post('password');
          $companyName    = $this->input->post('companyName');
          $contact        = $this->input->post('contact');
          $where = array("email"=>$email);
          
          if($id != ""){
            $where["id !="] = $id;
          }

          if($this->Common->_is_record_exits("tbl_advertiser",$where)){
              $this->session->set_userdata(GLOBAL_MSG,"this email is already register with us!!!");
          }else{
            $insArray =  array(
                "fname" =>$fName,
                "lname" =>$lName,
                "email" =>$email,
                "contact_number" =>$contact,
                "company_name" =>$companyName,
                "password" =>md5($password),
                "enk_key" =>base64_encode($password),
                "modified"=>date("Y-m-d H:i:s"),
                "modified_by"=>$this->Common->get_admin_id(),
            );

            if($id == ""){
               $insArray["is_email_verified"]      =  "Yes";
               $insArray["is_mobile_verified"]     =  "Yes";  
               $insArray["status"]                 = "Approved";
               $insArray["created"]                = date("Y-m-d");
               $insArray["created_by"]             = $this->Common->get_admin_id(); 
                 if($this->Common->_insert("tbl_advertiser",$insArray)){
                    $this->session->set_userdata(GLOBAL_MSG,"Advertiser added successfully");
                 }else{
                    $this->session->set_userdata(GLOBAL_MSG,"Something went wrong please try again later");
                 } 
            }else{
              $this->db->where(array("id"=>$id));
              $this->db->update("tbl_advertiser",$insArray);
              if($this->db->affected_rows() > 0){
                 $this->session->set_userdata(GLOBAL_MSG,"Advertiser details updated successfully"); 
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
        redirect("./admin/advertisers");
     }
      
    }

}
