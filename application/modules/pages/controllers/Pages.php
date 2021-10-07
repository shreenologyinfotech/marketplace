<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//require_once(BASEPATH.'core/MY_Controller.php');
class Pages extends MY_Controller {
  function __construct() {
        parent::__construct();
        $this->load->model('Page');
        $this->load->model('PageRetails');
        $this->load->library('form_validation');    
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->Common->is_admin_login();
    }
    


    function index() {
        $columns = [0 =>'title',1 =>'slug',2=> 'description', 3=> 'meta_keywords', 4 =>'meta_description', 5=>'status', 6=>'option'];
        $imageColumns = [];
        $searchableColumns = [0 =>'title'];
        
        $colDef['title'] =  ['target' => 0, 'visible' => true, 'searchable' => true];
        
        if($this->input->get('ajax')==1){
          //Row action options
          $options = '<a href="'.site_url('editpage/[id]').'" title="Edit" class="btn-xs btn btn-primary">Edit</a>';
          $options .= '<a href="'.site_url('admin/order/view/[id]').'" title="View" class="btn-xs btn btn-success">View</a>';
          $options .= '<a href="#" title="View" class="btn-xs btn btn-danger">Delete</a>';
          //get paginated records for jquery datatables
          $data = $this->ajaxPageList($this->Page, $columns, $searchableColumns, $options, $imageColumns, []);
          echo $data;exit;
        }
        else{
          $paginationConfig = $this->config->item('pagination');
          $this->data['page_title'] = SITE_TITLE.' :: Pages list';
          $this->data['page'] = $this->_viewPath . "pages.php";
          $this->data['useDataTables'] = true;
          $this->data['columns'] = $columns;
          $this->data['colDef'] = $colDef;
          $this->data['default_order_col'] = 3;
          $this->data['default_order_dir'] = $paginationConfig['default_order_dir'];
          $this->data['default_page_length'] = 10;//$paginationConfig['default_page_length'];
          $this->load->view($this->_adminContainer, $this->data);
        }
    }



    function retail(){

          if(count($_POST) > 0){
            $where  = array("id"=>$this->input->post("id"));
            $update = array(
                "description"=>$this->input->post("description"),
                "modified"=>date("Y-m-d")
            ); 

            if (isset($_FILES['banner_image']) && $_FILES['banner_image']['name']!=""){
                
              
                
                
                $update["banner_image"]  =  upload_image('banner_image',IMAGE_PATH_ABSULATE.BANNER_FOLDER);
            }
            
        
            

            if($this->Common->_update("tbl_page_retail",$update,$where)){
                
               
                
               $this->session->set_userdata(GLOBAL_MSG,"page update successfully!!!");
            }
          }

          $this->data['page_title'] = SITE_TITLE.' :: Retail Page Content';
          $this->data['page'] = $this->_viewPath."retail.php";
          $this->data['data'] = $this->Common->_get_all_records("tbl_page_retail",[]);
          $this->data['useEditor'] = true;
          $this->load->view($this->_adminContainer, $this->data);

    }



    function loadAddView($data = array()){
          $this->data['page_title'] = SITE_TITLE.' :: Pages';
          $this->data['page'] = $this->_viewPath."add.php";
          $this->data['data'] = $data;
          $this->data['useEditor'] = true;
          $this->load->view($this->_adminContainer, $this->data);
    }


    function managefooterblock(){
      if(count($_POST) > 0){
        $insArray = array(
          "block_one"=>$this->input->post("block_one"),
          "block_two"=>$this->input->post("block_two"),
          "block_three"=>$this->input->post("block_three")
        );
        $this->db->update("tbl_footer_block",$insArray);
        $this->session->set_userdata(GLOBAL_MSG,"settings update successfully!!!");
      }

      $data =  $this->Common->get_all_record("tbl_footer_block",array());
      $this->data['page_title'] = SITE_TITLE.' :: Manage Footer Block';
      $this->data['page'] = $this->_viewPath."manage-footer-block.php";
      $this->data['data'] = $data;
      $this->data['useEditor'] = true;
      $this->load->view($this->_adminContainer, $this->data);
    }




    function setRules($options){
        if($options == "ADD_PAGE"){
            $this->form_validation->set_rules('title', 'Title','trim|required');
            $this->form_validation->set_rules('slug', 'Slug','trim|required');
            $this->form_validation->set_rules('meta_keywords', 'Meta Key Word','trim|required');
            $this->form_validation->set_rules('meta_description', 'Meta Description','trim|required');
            $this->form_validation->set_rules('description', 'Description','trim|required');
            $this->form_validation->set_rules('status', 'status','trim|required');
           
        }
    }

    function editpage(){
      $Id = $this->uri->segment(2);
      if($Id != ""){
        $where = array("id"=>$Id);
        $data = $this->Common->get_all_record("tbl_page",$where);
        $this->loadAddView($data);
      }else{
        echo show_404();
      }
    }


    function addpage(){
      $id  = "";
      if(count($_POST)){
        $this->setRules("ADD_PAGE");
        $id      = $this->input->post('id');

        if($this->form_validation->run()){
          $title              = $this->input->post('title');
          $slug               = $this->input->post('slug');
          $meta_keywords      = $this->input->post('meta_keywords');
          $meta_description   = $this->input->post('meta_description');
          $description        = $this->input->post('description');
          $status              = $this->input->post('status');
        
          $where = array("title"=>$title);
          
          if($id != ""){
            $where["id !="] = $id;
          }

          if($this->Common->_is_record_exits("tbl_page",$where)){
              $this->session->set_userdata(GLOBAL_MSG,"this page already used!!!");
          }else{


            $insArray =  array(
                "title" =>$title,
                "slug" =>$slug,
                "meta_keywords" =>$meta_keywords,
                "meta_description" =>$meta_description,
                "description" =>$description,
                "status" =>$status,
                "modified"=>date("Y-m-d"),
            );


            if($id == ""){
               $insArray["created"]                = date("Y-m-d");
                 if($this->Common->_insert("tbl_page",$insArray)){
                    $this->session->set_userdata(GLOBAL_MSG,"page added successfully");
                 }else{
                    $this->session->set_userdata(GLOBAL_MSG,"Something went wrong please try again later");
                 } 
            }else{
              $this->db->where(array("id"=>$id));
              $this->db->update("tbl_page",$insArray);
              if($this->db->affected_rows() > 0){
                 $this->session->set_userdata(GLOBAL_MSG,"page update successfully"); 
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
        redirect("./editpage/".$id);
     }
    }



}
