<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//require_once(BASEPATH.'core/MY_Controller.php');
class Faq extends MY_Controller {
  function __construct() {
        parent::__construct();
        $this->load->model('FaqModel');
        $this->load->library('form_validation');    
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->Common->is_admin_login();
    }
    

    function index() {
        $columns = [0 =>'faq_title',1=> 'faq_description',2 =>'option'];
        $imageColumns = [];
        $searchableColumns = [0 =>'faq_title'];
        $colDef['interests_text'] =  ['target' => 0, 'visible' => true, 'searchable' => true];
        
        if($this->input->get('ajax')==1){
          //Row action options
          $options = '<a href="'.site_url('admin/editfaq/[id]').'" title="Edit" class="btn-xs btn btn-primary">Edit</a>';
         // $options .= '<a href="'.site_url('admin/order/view/[id]').'" title="View" class="btn-xs btn btn-success">View</a>';
         // $options .= '<a href="#" title="View" class="btn-xs btn btn-danger">Delete</a>';
          //get paginated records for jquery datatables
          $data = $this->paginate($this->FaqModel, $columns, $searchableColumns, $options, $imageColumns, []);
          echo $data;exit;
        }
        else{
          $paginationConfig = $this->config->item('pagination');
          $this->data['page_title'] = SITE_TITLE.' :: Faq list';
          $this->data['page'] = $this->_viewPath . "faq.php";
          $this->data['useDataTables'] = true;
          $this->data['columns'] = $columns;
          $this->data['colDef'] = $colDef;
          $this->data['default_order_col'] = 0;
          $this->data['default_order_dir'] = $paginationConfig['default_order_dir'];
          $this->data['default_page_length'] = 10;//$paginationConfig['default_page_length'];
          $this->load->view($this->_adminContainer, $this->data);
        }

        
    }



    function loadAddView($data = array()){
          $this->data['page_title'] = SITE_TITLE.' :: Faq';
          $this->data['page'] = $this->_viewPath."add.php";
          $this->data['data'] = $data;
          $this->load->view($this->_adminContainer, $this->data);
    }


    function setRules($options){
        if($options == "ADD_FAQ"){
            $this->form_validation->set_rules('faq_title', 'title','trim|required');
            $this->form_validation->set_rules('faq_description', 'descripton','trim|required');
        }
    }


    function editfaq(){
      $Id = $this->uri->segment(3);
      if($Id != ""){
        $where = array("id"=>$Id);
        $data = $this->Common->get_all_record("tbl_faq",$where);
        $this->loadAddView($data);
      }else{
        echo show_404();
      }
    }


    function addfaq(){
      $id  = "";
      if(count($_POST)){
        $this->setRules("ADD_FAQ");
        $id      = $this->input->post('id');

        if($this->form_validation->run()){
          $title                = $this->input->post('faq_title');
          $description               = $this->input->post('faq_description');
          
          $where = array("faq_title"=>$title);
          
          if($id != ""){
            $where["id !="] = $id;
          }

          if($this->Common->_is_record_exits("tbl_faq",$where)){
              $this->session->set_userdata(GLOBAL_MSG,"This FAQ already used!!!");
          }else{


            $insArray =  array(
                "faq_title" =>$title,
                "faq_description" =>$description,
                "modified_at" =>date("Y-m-d H:i:s")
            );


            if($id == ""){
                 $insArray["created_at"]                = date("Y-m-d H:i:s");
                 if($this->Common->_insert("tbl_faq",$insArray)){
                    $this->session->set_userdata(GLOBAL_MSG,APP_FAQ_ADD_SUCCESS_MESSAGE);
                 }else{
                    $this->session->set_userdata(GLOBAL_MSG,SOMETHING_WENT_WRONG_PLEASE_TRY_LATER);
                 } 
            }else{

              $this->db->where(array("id"=>$id));
              $this->db->update("tbl_faq",$insArray);
              if($this->db->affected_rows() > 0){
                 $this->session->set_userdata(GLOBAL_MSG,APP_FAQ_UPDATED_SUCCESS_MESSAGE); 
              }else{
                 $this->session->set_userdata(GLOBAL_MSG,SOMETHING_WENT_WRONG_PLEASE_TRY_LATER);
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
        redirect("./admin/editfaq/".$id);
     }
    }



}
