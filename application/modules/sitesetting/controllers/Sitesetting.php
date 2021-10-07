<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//require_once(BASEPATH.'core/MY_Controller.php');
class SiteSetting extends MY_Controller {
  
  function __construct() {
        parent::__construct();
        $this->load->model('Admin');
        $this->load->model('Site');
       	$this->load->library('form_validation');    
  		  $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->Common->is_admin_login();
    }


    function setRules($options){
        if($options == "ADD_SETTING"){
            $this->form_validation->set_rules('meta_key', 'Setting key','trim|required');
            $this->form_validation->set_rules('meta_value', 'Setting value','trim|required');
        }
    }

    function index() {
        $columns = [0 =>'id',1=> 'meta_key', 2=> 'meta_value', 3 =>'created', 4 =>'option'];
        $imageColumns = [];
        $searchableColumns = [0 =>'meta_key'];
        
        $colDef['meta_key'] =  ['target' => 0, 'visible' => true, 'searchable' => true];
        if($this->input->get('ajax')==1){
          //Row action options
          $options = '<a href="'.site_url('sitesetting/addsetting/[id]').'" title="Edit" class="btn-xs btn btn-primary">Edit</a>';
          $data = $this->paginate($this->Site, $columns, $searchableColumns, $options, $imageColumns, ["status"=>"Active"],"Delete","Active","status","Deleted");
          echo $data;exit;
        }
        else{
          $paginationConfig = $this->config->item('pagination');
          $this->data['page_title'] = SITE_TITLE.' :: Site Setting list';
          $this->data['page'] = $this->_viewPath . "settings.php";
          $this->data['useDataTables'] = true;
          $this->data['columns'] = $columns;
          $this->data['colDef'] = $colDef;
          $this->data['default_order_col'] = 3;
          $this->data['default_order_dir'] = $paginationConfig['default_order_dir'];
          $this->data['default_page_length'] = 10;//$paginationConfig['default_page_length'];
          $this->load->view($this->_adminContainer, $this->data);
        }
    }


    function loadsettingview(){
         $this->data['page_title'] = SITE_TITLE.' :: Add Setting';
         $this->data['page'] = $this->_viewPath."add.php";
         $this->data['data'] = array();
         $this->load->view($this->_adminContainer, $this->data);
    }



    function addsetting(){
          $settingId = $this->uri->segment(3);
          $where = array("id"=>$settingId);    
          $this->data['page_title'] = SITE_TITLE.' :: Update Setting';
          $this->data['page'] = $this->_viewPath."add.php";
          $this->data['data'] = $this->Common->getRecordById("tbl_setting",$where);
          $this->load->view($this->_adminContainer, $this->data);
    }


    function updateSetting(){
         $id  = "";
      if(count($_POST)){
        $this->setRules("ADD_SETTING");
        $id      = $this->input->post('id');

        if($this->form_validation->run()){
          $key                = $this->input->post('meta_key');
          $value               = $this->input->post('meta_value');
          
          $where = array("meta_key"=>$key);
          
          if($id != ""){
            $where["id !="] = $id;
          }

          if($this->Common->_is_record_exits("tbl_setting",$where)){
              $this->session->set_userdata(GLOBAL_MSG,"This setting already used!!!");
          }else{

            $insArray =  array(
                "meta_key" =>$key,
                "meta_value" =>$value,
                "created"=>date("Y-m-d"),
            );


            if($id == ""){
                 if($this->Common->_insert("tbl_setting",$insArray)){
                    $this->session->set_userdata(GLOBAL_MSG,"Setting added successfully");
                 }else{
                    $this->session->set_userdata(GLOBAL_MSG,"Something went wrong please try again later");
                 } 
            }else{
              $this->db->where(array("id"=>$id));
              $this->db->update("tbl_setting",$insArray);
              if($this->db->affected_rows() > 0){
                 $this->session->set_userdata(GLOBAL_MSG,"Setting updated successfully"); 
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
       $this->loadsettingview(); 
     }else{
        redirect("./sitesetting");
     }
  }

}



