<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//require_once(BASEPATH.'core/MY_Controller.php');
class Dashboard extends MY_Controller {
		
    function __construct() {
        parent::__construct();
        log_message('debug', 'CI My Admin : Auth class loaded');
    }

    function index() {
		$this->data['page_title'] = 'Dashboard';
        $this->data['page'] = $this->_viewPath . "dashboard.php";
        $this->load->view($this->_adminContainer, $this->data);
        //$this->load->view('login');
    }
}
