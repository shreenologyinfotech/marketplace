<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Index
 *  @property booking_model booking_model
 */


class Index extends CI_Controller {

    public $viewData = array();

    public function __construct(){
        parent::__construct();
        
    }

	public function index(){
		$this->load->library('password');
	    $this->viewData['title'] = 'Dalal | Home';
		$this->load->view('Index',$this->viewData);
	}
    
   public function see_gmt_time()
    {
        $date= set_local_to_gmt();
     /*   $scheduled_date='2017-02-17 10:45:20';
        $time = strtotime($scheduled_date);
        $time = $time - (30 * 60);
        $scheduled_date = date("Y-m-d H:i", $time);
        echo $date .'<br/> '.$scheduled_date;*/
        echo $date;
    }
 /*
 * Test cases END
 *
 *
 */

    /**
     * cron for send notification user reached total scans
     *
     */




	

	public function error(){
		echo "ERROR PAGE HERE"; die;
	}

	public function success(){

	}

	public function failed(){
		echo "failed PAGE HERE"; die;
	}

	public function errorpg(){
		echo "errorpg PAGE HERE"; die;
	}


	

}

