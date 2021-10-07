<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//require_once(BASEPATH.'core/MY_Controller.php');
class Notifications extends MY_Controller {
  function __construct() {
        parent::__construct();
        $this->load->model('Notification');
       	$this->load->library('form_validation');    
  		  $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->Common->is_admin_login();
    }
    

    function index() {
        $columns = [0=> 'title', 1=> 'msg', 2=> 'created', 3=>'option'];
        $imageColumns = [];
        $searchableColumns =  [0=> 'title', 1=> 'msg', 2=> 'created'];
        $colDef['created'] =  ['target' => 0, 'visible' => true, 'searchable' => true];
        
        if($this->input->get('ajax')==1){
          //Row action options
          $options = '<a href="admin/notification/send/[id]" title="View" class="btn-xs btn btn-success">View</a>';
          //get paginated records for jquery datatables
          
          $options .= '<input type="button" class="btn-xs btn btn-danger" onclick="performAction(\''.base_url().'admin/notification/delete/[id]\',\'Delete Notification\',\'Are you sure you want to delete the notification?\',\'Notification deleted successfully\')" value="Delete"/>&nbsp;';


          $data = $this->paginate($this->Notification, $columns, $searchableColumns, $options, $imageColumns, array("user_id"=>'0'));

          echo $data;exit;
        }
        else{
          $paginationConfig = $this->config->item('pagination');
          $this->data['page_title'] = SITE_TITLE.' :: Notification list';
          $this->data['page'] = $this->_viewPath . "notifications.php";
          $this->data['useDataTables'] = true;
          $this->data['columns'] = $columns;
          $this->data['colDef'] = $colDef;
          $this->data['default_order_col'] = 2;
          $this->data['default_order_dir'] = $paginationConfig['default_order_dir'];
          $this->data['default_page_length'] = 10;//$paginationConfig['default_page_length'];
          $this->load->view($this->_adminContainer, $this->data);
        }
    }



    function delete(){
          $id = $this->uri->segment(4);
          $this->Common->_delete("tbl_notification", array("id"=>$id));
          echo "YES";
    }


    public function addnotification(){
       if(count($_POST) > 0){
          $notificaionId = $this->input->post("id");
          $title         = $this->input->post("title");
          $message       = $this->input->post("msg");

          $array = array("title"=>$title,"msg"=>$message);

          
          if($this->db->insert("tbl_notification",$array)){
            sendTopicNotification($message);
            $this->session->set_userdata(GLOBAL_MSG,"Notification sent successfully");
            redirect("notifications");
          }else{
            $this->session->set_userdata(GLOBAL_MSG,"something went wrong please try again later");
          }
          
          $this->loadNotificationView(array());
       
       }else{
          $data = array();
          if($this->uri->segment(4) != ""){
            $notificationId =  $this->uri->segment(4);
            $where = array("id"=>$notificationId);
            $data = $this->Common->get_all_record("tbl_notification",$where);
          }
          $this->loadNotificationView($data);
       }
    }


    function loadNotificationView($data = array()){
      $this->data['page_title'] = SITE_TITLE.' :: Send Notification';
      $this->data['page'] = $this->_viewPath . "add.php";
      $this->data['data'] = $data;
      $this->load->view($this->_adminContainer, $this->data);
    }






}
