<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//require_once(BASEPATH.'core/MY_Controller.php');
class Packages extends MY_Controller {
  function __construct() {
        parent::__construct();
        $this->load->model('Package');
       	$this->load->library('form_validation');    
  		  $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->Common->is_admin_login();
    }
    

    function index() {
        $columns = [0 =>'level',1=> 'tier', 2 =>'status', 3=>'created', 4=>'option'];
        $imageColumns = [];
        $searchableColumns = [0 =>'level'];
        
        $colDef['level'] =  ['target' => 0, 'visible' => true, 'searchable' => true];
        
        if($this->input->get('ajax')==1){
          //Row action options
          $options = '<a href="'.site_url('editpackage/[id]').'" title="Edit" class="btn-xs btn btn-primary">Edit</a>';
          //$options .= '<a href="'.site_url('admin/order/view/[id]').'" title="View" class="btn-xs btn btn-success">View</a>';
        //  $options .= '<a href="#" title="View" class="btn-xs btn btn-danger">Delete</a>';
          //get paginated records for jquery datatables
          $data = $this->paginate($this->Package, $columns, $searchableColumns, $options, $imageColumns, []);
          echo $data;exit;
        }
        else{
          $paginationConfig = $this->config->item('pagination');
          $this->data['page_title'] = SITE_TITLE.' :: Packages list';
          $this->data['page'] = $this->_viewPath . "packages.php";
          $this->data['useDataTables'] = true;
          $this->data['columns'] = $columns;
          $this->data['colDef'] = $colDef;
          $this->data['default_order_col'] = 3;
          $this->data['default_order_dir'] = $paginationConfig['default_order_dir'];
          $this->data['default_page_length'] = 10;//$paginationConfig['default_page_length'];
          $this->load->view($this->_adminContainer, $this->data);
        }
    }



     function loadAddView($data = array()){
          $this->data['page_title'] = SITE_TITLE.' :: Locations';
          $this->data['page'] = $this->_viewPath."add.php";
          $this->data['data'] = $data;
          $this->load->view($this->_adminContainer, $this->data);
    }


    function setRules($options){
        if($options == "ADD_PACKAGE"){
            $this->form_validation->set_rules('level', 'Level','trim|required');
           
          
        }
    }

    function editpackage(){
      $Id = $this->uri->segment(2);
      if($Id != ""){
        $where = array("id"=>$Id);
        $data = $this->Common->get_all_record("tbl_package",$where);
        $this->loadAddView($data);
      }else{
        echo show_404();
      }
    }


    function addpackage(){
      $id  = "";
     
      if(count($_POST)){
        $this->setRules("ADD_PACKAGE");
        $id      = $this->input->post('id');

        if($this->form_validation->run()){
          
          $this->form_validation->set_rules('level', 'Level','trim|required');
          // $this->form_validation->set_rules('tier', 'Tier','trim|required');
          // $this->form_validation->set_rules('per_flyer', 'Per Flyer','trim|required');
          

          $level                = $this->input->post('level');
          //$tier                 = $this->input->post('tier');
          //$per_flyer            = $this->input->post('per_flyer');
          $status               = "Active";
          

          $where = array("level"=>$level);
          
          if($id != ""){
            $where["id !="] = $id;
          }

          if($this->Common->_is_record_exits("tbl_package",$where)){
              $this->session->set_userdata(GLOBAL_MSG,"This level already used!!!");
          }else{


            $insArray =  array(
                "level" =>$level,
                "status" =>$status,
                "modified"=>date("Y-m-d"),
            );


            if($id == ""){
               $insArray["created"]                = date("Y-m-d");
                 if($this->Common->_insert("tbl_package",$insArray)){
                    $this->session->set_userdata(GLOBAL_MSG,"Package added successfully");
                 }else{
                    $this->session->set_userdata(GLOBAL_MSG,"Something went wrong please try again later");
                 } 
            }else{

              $this->db->where(array("id"=>$id));
              $this->db->update("tbl_package",$insArray);
              if($this->db->affected_rows() > 0){
                 $this->session->set_userdata(GLOBAL_MSG,"package update successfully"); 
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
        redirect("./editpackage/".$id);
     }
    }


}
