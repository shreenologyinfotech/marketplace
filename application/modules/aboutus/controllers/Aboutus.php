<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//require_once(BASEPATH.'core/MY_Controller.php');
class Aboutus extends MY_Controller {
  function __construct() {
        parent::__construct();
        $this->load->model('AboutusModel');
       	$this->load->library('form_validation');    
  		  $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->Common->is_admin_login();
    }
    
    function pagecontent(){
      $id  = "";
      if(count($_POST)){
        $id      = $this->input->post('id');
        $description        = $this->input->post('description');
        $insArray =  array(
            "content" =>$description,
        );
        $this->db->where(array("id"=>$id));
        $this->db->update("tbl_dynamic_pages",$insArray);
        if($this->db->affected_rows() > 0){
           $this->session->set_userdata(GLOBAL_MSG,UPDATE_SUCCESS_MSG); 
        }else{
           $this->session->set_userdata(GLOBAL_MSG,"Something went wrong please try again later");
        }
      }

      $data = $this->Common->_get_all_records("tbl_dynamic_pages",array("type"=>"app-about-us"));

      $this->data['page_title'] = SITE_TITLE.' :: App about-us';
      $this->data['page'] = $this->_viewPath."add.php";
      $this->data['data'] = $data;
      $this->data['useEditor'] = true;
      $this->load->view($this->_adminContainer, $this->data);
    }


    function pagefaq(){
      $id  = "";
      if(count($_POST)){
        $id      = $this->input->post('id');
        $description        = $this->input->post('description');
        $insArray =  array(
            "content" =>$description,
            "modified_at" =>date("Y-m-d H:i:s")
        );


        $this->db->where(array("id"=>$id));
        $this->db->update("tbl_dynamic_pages",$insArray);
        if($this->db->affected_rows() > 0){
           $this->session->set_userdata(GLOBAL_MSG,APP_FAQ_UPDATED_SUCCESS_MESSAGE); 
        }else{
           $this->session->set_userdata(GLOBAL_MSG,SOMETHING_WENT_WRONG_PLEASE_TRY_LATER);
        }
      }

      $data = $this->Common->_get_all_records("tbl_dynamic_pages",array("type"=>"app-faq"));

      $this->data['page_title'] = SITE_TITLE.' :: App Faq';
      $this->data['page'] = $this->_viewPath."addfaq.php";
      $this->data['data'] = $data;
      $this->data['useEditor'] = true;
      $this->load->view($this->_adminContainer, $this->data);
    }



    



}
