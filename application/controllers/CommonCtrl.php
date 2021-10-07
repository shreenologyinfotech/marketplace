<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//require_once(BASEPATH.'core/MY_Controller.php');
class CommonCtrl extends MY_Controller {
  function __construct() {
        parent::__construct();
        //$this->load->model('Export');
    }


    function updateStatus() {
        $table    = $this->uri->segment("3");
        $key      = $this->uri->segment("4");
        $value    = $this->uri->segment("5");
        $status   = $this->uri->segment("6");


        if($status == "" || $key == "" || $value == "" || $table == ""){
            echo "NO";
        }else{
            $where = [$key=>$value];
            
            if($status == "D"){
                if($this->Common->_delete($table, $where)){
                    echo "YES";
                }else{
                    echo "NO";
                }
            }else{  
                
                $updateArray = ["status"=>$status];
                if($this->Common->_update($table, $updateArray, $where)){
                    echo "YES";
                }else{
                    echo "NO";
                }
            }

               
        }

        
        exit();

    }

    function test(){
        $this->EmailTemplate->sendmail("govindarchive@gmail.com","govind","subject","test message");
    }

    
    function exportcontact(){
        $this->Export->exportcontact();
    }
    
    
    function exportuser(){
        $this->Export->exportUsers();
    }


    function exportadvertiser(){
        $this->Export->exportAdvertiser();
    }

    function exportorder(){
        $this->Export->exportOrders();
    }


    function refundexport(){
        $this->Export->refundExport();
    }

    function exporttransaction(){
        $this->Export->exporttransaction(); 
    }


    function exportorderstatus(){
        $this->Export->exportorderstatus(); 
    }

    function exportwithdraw(){
        $this->Export->exportwithdraw(); 
    }
    

    public function verifyappuser(){
         if($this->uri->segment(2) != ""){
             $decodeId = base64_decode($this->uri->segment(2));
             $userId   = $decodeId-APP_ID_SALT;
             $updateArray = array("is_email_verified"=>"yes");
             $this->db->update("tbl_advert_viewer",$updateArray);
             $this->data["showLogin"] = false;
             $this->load->view("email-template/email-thankyou",$this->data);
         }else{
            echo show_404();
         }
     }


  public function verifyadvertiser(){
     if($this->uri->segment(2) != ""){
         $decodeId = base64_decode($this->uri->segment(2));
         $userId   = $decodeId-APP_ID_SALT;
         $updateArray = array("is_email_verified"=>"yes");
         $this->db->update("tbl_advertiser",$updateArray);
         $this->data["showLogin"] = true;
         $this->load->view("email-template/email-thankyou",$this->data);
     }else{
        echo show_404();
     }
 }
 
}
