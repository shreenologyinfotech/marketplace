<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//require_once(BASEPATH.'core/MY_Controller.php');
class Errors extends MY_Controller {
		
    function __construct() {
        parent::__construct();
        log_message('debug', 'CI My Admin : Auth class loaded');
    }

    function notfound() {
		$this->data['page_title'] = 'Error 404 Not Found';
        $this->data['page'] = $this->_viewPath . "404.php";
        $this->load->view($this->_adminContainer, $this->data);
        //$this->load->view('login');
    }
    function notallowed() {
		$this->data['page_title'] = 'Error 403 Forbidden';
        $this->data['page'] = $this->_viewPath . "403.php";
        $this->load->view($this->_adminContainer, $this->data);
        //$this->load->view('login');
    }
}
