<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//require_once(BASEPATH.'core/MY_Controller.php');
class Contacts extends MY_Controller {
  function __construct() {
        parent::__construct();
        $this->load->model('Contact');
        $this->load->model('EmailTemplate');
       	$this->load->library('form_validation');    
  		  $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->Common->is_admin_login();
    }
    

     function setRules($options){
        if($options == "REPLY_CONTACT"){
            $this->form_validation->set_rules('id', 'Contact id','trim|required');
            $this->form_validation->set_rules('email', 'Email','trim|required');
            $this->form_validation->set_rules('message', 'message','trim|required');
        }
    }

    function index() {
		/* $this->db->delete("tbl_contact_form_data",array("id"=>8));*/
        $this->db->update("tbl_contact_form_data",array("seen_status"=>"true"));
        
        $columns = [0 =>'fname',1=> 'lname', 2=> 'email', 3=> 'contact_number',4 =>'is_read', 5=>'created', 6=>'option'];
        $imageColumns = [];
        $searchableColumns =  [0 =>'fname',1=> 'lname', 2=> 'email',3 =>'contact_number',4 =>'is_read', 5=>'created'];
        
        $colDef['fname'] =  ['target' => 0, 'visible' => true, 'searchable' => true];
        
        if($this->input->get('ajax')==1){
          //Row action options
           $options = '<a href="'.site_url('admin/contact/reply/[id]').'" title="Reply" class="btn-xs btn btn-primary">Reply</a>';
      //    $options .= '<a href="'.site_url('admin/contact/view/[id]').'" title="View" class="btn-xs btn btn-success">View</a>';
        //  $options .= '<a href="#" title="View" class="btn-xs btn btn-danger">Delete</a>';
        
          //get paginated records for jquery datatables
          $data = $this->paginate($this->Contact, $columns, $searchableColumns, $options, $imageColumns, []);
          echo $data;exit;
        }
        else{
          $paginationConfig = $this->config->item('pagination');
          $this->data['page_title'] = SITE_TITLE.' :: contact list';
          $this->data['page'] = $this->_viewPath . "contacts.php";
          $this->data['useDataTables'] = true;
          $this->data['columns'] = $columns;
          $this->data['colDef'] = $colDef;
          $this->data['default_order_col'] =5;
          $this->data['default_order_dir'] = $paginationConfig['default_order_dir'];
          $this->data['default_page_length'] = 10;//$paginationConfig['default_page_length'];
          $this->load->view($this->_adminContainer, $this->data);
        }
    }


    function mereplycontact(){
       $id = $this->input->post("id");
       $this->setRules("REPLY_CONTACT");
        if($this->form_validation->run()){
           $data = $this->Common->_get_all_records("tbl_contact_form_data",array("id"=>$id));
           $email     = $this->input->post("email");
           $message   = $this->input->post("message");
           $userName  = $data[0]->fname;
          
           $this->db->where(array("id"=>$id));
           $updateArray = array("is_read"=>"Yes");
           $this->db->update("tbl_contact_form_data",$updateArray);

           if($this->EmailTemplate->contactusreplymail($email,$message,$userName)){
             $this->session->set_userdata(GLOBAL_MSG,REPLY_SENT_SUCCESS);
             redirect("./admin/contacts");
           }else{
             $this->session->set_userdata(GLOBAL_MSG,"something went wrong please try again later");
             redirect("./admin/contact/reply/".$id);
           }
        }else{
            $this->session->set_userdata(GLOBAL_MSG,filter_validation_errors());
            redirect("./admin/contact/reply/".$id);
        }
       
    }


    function replycontact(){
       $contactId =  $this->uri->segment("4");
       if($contactId != ""){
          $data = $this->Common->_get_all_records("tbl_contact_form_data",array("id"=>$contactId));
          $this->data['page_title'] = SITE_TITLE.' :: reply contact form';
          $this->data['page'] = $this->_viewPath . "reply-contacts.php"; 
          $this->data['data'] =  $data; 
          $this->load->view($this->_adminContainer, $this->data); 
       }else{
          echo show_404();
       }
    }
}
