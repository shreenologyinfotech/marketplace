<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
/***
 * File: (Codeigniterapp)/libraries/Controllerlist.php
 * 
 * A simple library to list al your controllers with their methods.
 * This library will return an array with controllers and methods
 * 
 * The library will scan the "controller" directory and (in case of) one (1) subdirectory level deep
 * for controllers
 * 
 * Usage in one of your controllers:
 * 
 * $this->load->library('controllerlist');
 * print_r($this->controllerlist->getControllers());
 * 
 * @author Peter Prins 
 */
class ControllerList {
	
	/**
	 * Codeigniter reference 
	 */
	private $CI;
	
	/**
	 * Array that will hold the controller names and methods
	 */
	private $aControllers;
	
	// Construct
	function __construct() {
		// Get Codeigniter instance 
		$this->CI = get_instance();
		
		// Get all controllers 
		$this->setControllers();
	}
	
	/**
	 * Return all controllers and their methods
	 * @return array
	 */
	public function getControllers() {
		return $this->aControllers;
	}
	
	/**
	 * Set the array holding the controller name and methods
	 */
	public function setControllerMethods($p_sModuleName, $p_sControllerName, $p_aControllerMethods) {
		$this->aControllers[$p_sModuleName][$p_sControllerName] = $p_aControllerMethods;
	}
	
	/**
	 * Search and set controller and methods.
	 */
	private function setControllers() {
		$moduleList = [];
		// Loop through the controller directory
		foreach (glob(APPPATH . 'modules/*') as $module){
			$moduleName = basename($module);
			$moduleList[$moduleName] = $module;
		
			foreach(glob(APPPATH .'modules/'.$moduleName.'/controllers/*') as $controller) {
				
				// if the value in the loop is a directory loop through that directory
				if(is_dir($controller)) {
					// Get name of directory
					$dirname = basename($controller, EXT);
					
					// Loop through the subdirectory
					foreach(glob(APPPATH .$moduleName.'modules/'.'/controllers/'.$dirname.'/*') as $subdircontroller) {
						// Get the name of the subdir
						$subdircontrollername = basename($subdircontroller, EXT);
						
						// Load the controller file in memory if it's not load already
						if(!class_exists($subdircontrollername)) {				
							$this->CI->load->file($subdircontroller);
						}					
						// Add the controllername to the array with its methods
						$aMethods = get_class_methods($subdircontrollername);
						$aUserMethods = array();
						foreach($aMethods as $method) {
							if($method != '__construct' && $method != 'get_instance' && $method != $subdircontrollername) {
								$aUserMethods[] = $method;
							}
						}
						$this->setControllerMethods($subdircontrollername, $aUserMethods);					 					
					}
				}
				else if(pathinfo($controller, PATHINFO_EXTENSION) == "php"){
					// value is no directory get controller name				
					$controllername = basename($controller, EXT);
										
					// Load the class in memory (if it's not loaded already)
					if(!class_exists($controllername)) {
						$this->CI->load->file($controller);
					}				
						
					// Add controller and methods to the array
					$aMethods = get_class_methods($controllername);
					$aUserMethods = array();
					if(is_array($aMethods)){
						foreach($aMethods as $method) {
							if($method != '__construct' && $method != 'get_instance' && $method != $controllername) {
								$aUserMethods[] = $method;
							}
						}
					}
										
					$this->setControllerMethods($moduleName , $controllername, $aUserMethods);								
				}
			}
		
		}
			
	}
	
	/**
	 * Return all controllers and their methods
	 * @return array
	 */
	public function getModules($exceptionalMVC=[]) {
		$moduleList = [];
		// Loop through the controller directory
		foreach (glob(APPPATH . 'modules/*') as $module){
			$leaveModule = false; 
			$moduleName = $originalName = basename($module);
			$moduleName = str_replace('_', ' ',$moduleName);
			$moduleName = ucwords($moduleName);
			
			if(count($exceptionalMVC)){
				if(isset($exceptionalMVC[$originalName])){
					if($exceptionalMVC[$originalName] == '*'){
						$leaveModule = true;
					}		
				}	
			}
			
			if(!$leaveModule){ 
				$moduleList[$originalName] = $moduleName;
			}
			
		}
		return 	$moduleList;
	}
	
	/**
	 * Search and set controller and methods.
	 */
	public function getModuleControllers($moduleName) {
		$controllers = [];
		
		foreach(glob(APPPATH .'modules/'.$moduleName.'/controllers/*') as $controller) {
			
			// if the value in the loop is a directory loop through that directory
			if(is_dir($controller)) {
				// Get name of directory
				$dirname = basename($controller, EXT);
				
				// Loop through the subdirectory
				foreach(glob(APPPATH .$moduleName.'modules/'.'/controllers/'.$dirname.'/*') as $subdircontroller) {
					// Get the name of the subdir
					$subdircontrollername = basename($subdircontroller, EXT);
					
					// Load the controller file in memory if it's not load already
					if(!class_exists($subdircontrollername)) {				
						$this->CI->load->file($subdircontroller);
					}
					
					$subDirControllerName = str_replace('_', ' ',$subdircontrollername);
					$subDirControllerName = ucwords($subDirControllerName);					
					$controllers[$subdircontrollername] = $subDirControllerName;
								
				}
			}
			else if(pathinfo($controller, PATHINFO_EXTENSION) == "php"){
				// value is no directory get controller name				
				$controllername = $originalName = basename($controller, EXT);
									
				// Load the class in memory (if it's not loaded already)
				if(!class_exists($controllername)) {
					$this->CI->load->file($controller);
				}				
					
				$controllerName = str_replace('_', ' ',$controllername);
				$controllerName = ucwords($controllerName);					
				$controllers[$controllername] = $controllerName;								
			}
		}
			
		return $controllers;
	}
	
	/**
	 * Search and set controller and methods.
	 */
	public function getActions($moduleName, $controllerName, $exceptionalMVC) {
		$aUserMethods = [];
		// Loop through the controller directory
		
		$controller = APPPATH .'modules/'.$moduleName.'/controllers/'.$controllerName.EXT;
		
		// value is no directory get controller name				
		$controllername = basename($controller, EXT);
							
		// Load the class in memory (if it's not loaded already)
		if(!class_exists($controllername)) {
			$this->CI->load->file($controller);
		}				
			
		// Add controller and methods to the array
		$aMethods = get_class_methods($controllername);
		$aUserMethods = array();
		if(is_array($aMethods)){
			foreach($aMethods as $method) {
				
				if($method != '__construct' && $method != 'get_instance' && $method != $controllername) {
					$methodName = str_replace('_', ' ',$method);
					$methodName = ucwords($methodName);	
					if(!isset($exceptionalMVC[$moduleName][$controllerName])){
						$aUserMethods[$method] = $methodName;
					}
					else{
						if(!in_array($method, $exceptionalMVC[$moduleName][$controllerName])){	
							$aUserMethods[$method] = $methodName;
						}
					}	
				}
			}
		}
		return 	$aUserMethods;
	}
	
}
// EOF
