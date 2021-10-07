<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//require_once(BASEPATH.'core/MY_Controller.php');
class Locations extends MY_Controller {
  function __construct() {
        parent::__construct();
        $this->load->model('Location');
       	$this->load->library('form_validation');    
  		  $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->Common->is_admin_login();
    }
    

    function index() {
        $columns = [0 =>'country',1=> 'short_name', 2=> 'code', 3 =>'dialing_code', 4=>'created', 5=>'option'];
        $imageColumns = [];
        $searchableColumns = [0 =>'country'];
        
        $colDef['country'] =  ['target' => 0, 'visible' => true, 'searchable' => true];
        
        if($this->input->get('ajax')==1){
          //Row action options
          $options = '<a href="'.site_url('editlocation/[id]').'" title="Edit" class="btn-xs btn btn-primary">Edit</a>';
          $options .= '<a href="'.site_url('viewlocation/[id]').'" title="View" class="btn-xs btn btn-success">View</a>';
          // $options .= '<a href="#" title="View" class="btn-xs btn btn-danger">Delete</a>';
          //get paginated records for jquery datatables
          $data = $this->paginate($this->Location, $columns, $searchableColumns, $options, $imageColumns, []);
          echo $data;exit;
        }
        else{
          $paginationConfig = $this->config->item('pagination');
          $this->data['page_title'] = SITE_TITLE.' :: Location list';
          $this->data['page'] = $this->_viewPath . "locations.php";
          $this->data['useDataTables'] = true;
          $this->data['columns'] = $columns;
          $this->data['colDef'] = $colDef;
          $this->data['default_order_col'] = 3;
          $this->data['default_order_dir'] = $paginationConfig['default_order_dir'];
          $this->data['default_page_length'] = 10;//$paginationConfig['default_page_length'];
          $this->load->view($this->_adminContainer, $this->data);
        }
    }



    function loadAddView($data = array(),$isView = false){
          $this->data['page_title'] = SITE_TITLE.' :: Locations';
          $this->data['page'] = $this->_viewPath."add.php";
          $this->data['data'] = $data;
          $this->data['is_view'] = $isView;
          $this->load->view($this->_adminContainer, $this->data);
    }


    function setRules($options){
        if($options == "ADD_LOCATION"){
            
            $this->form_validation->set_rules('country', 'Country Name','trim|required');
            $this->form_validation->set_rules('short_name', 'Short Code','trim|required');
            $this->form_validation->set_rules('code', 'code','trim|required');
            $this->form_validation->set_rules('dialing_code', 'Dialing Code','trim|required');
            $this->form_validation->set_rules('currency', 'Currency','trim|required');
            $this->form_validation->set_rules('currency_symbol', 'Currency Symbol','trim|required');
            $this->form_validation->set_rules('status', 'status','trim|required');
           
        }
    }

    function editlocation(){
      $Id = $this->uri->segment(2);
      if($Id != ""){
        $where = array("id"=>$Id);
        $data = $this->Common->get_all_record("tbl_advert_location",$where);
        $this->loadAddView($data);
      }else{
        echo show_404();
      }
    }


    function viewlocation(){
      $Id = $this->uri->segment(2);
      if($Id != ""){
        $where = array("id"=>$Id);
        $data = $this->Common->get_all_record("tbl_advert_location",$where);
        $this->loadAddView($data,true);
      }else{
        echo show_404();
      }
    }


    function addlocation(){
      $id  = "";
      if(count($_POST)){
        $this->setRules("ADD_LOCATION");
        $id      = $this->input->post('id');

        if($this->form_validation->run()){
          $country           = $this->input->post('country');
          $short_name        = $this->input->post('short_name');
          $code              = $this->input->post('code');
          $dialing_code      = $this->input->post('dialing_code');
          $currency          = $this->input->post('currency');
          $currency_symbol   = $this->input->post('currency_symbol');
          $status            = $this->input->post('status');
        
          $where = array("code"=>$code);
          
          if($id != ""){
            $where["id !="] = $id;
          }

          if($this->Common->_is_record_exits("tbl_advert_location",$where)){
              $this->session->set_userdata(GLOBAL_MSG,"this country code already used!!!");
          }else{


            $insArray =  array(
                "country" =>$country,
                "short_name" =>$short_name,
                "code" =>$code,
                "dialing_code" =>$dialing_code,
                "currency" =>$currency,
                "currency_symbol" =>$currency_symbol,
                "status" =>$status,
                "modified"=>date("Y-m-d"),
            );


            if($id == ""){
               $insArray["created"]                = date("Y-m-d");
                 if($this->Common->_insert("tbl_advert_location",$insArray)){
                    $this->session->set_userdata(GLOBAL_MSG,"location added successfully");
                 }else{
                    $this->session->set_userdata(GLOBAL_MSG,"Something went wrong please try again later");
                 } 
            }else{
              $this->db->where(array("id"=>$id));
              $this->db->update("tbl_advert_location",$insArray);
              if($this->db->affected_rows() > 0){
                 $this->session->set_userdata(GLOBAL_MSG,"location update successfully"); 
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
        redirect("./editlocation/".$id);
     }
    }



}
