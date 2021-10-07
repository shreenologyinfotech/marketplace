<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('checkActiveModuel'))
{
    function checkActiveModuel($module)
    {
		$CI = get_instance();
		
        $activeModule = $CI->router->fetch_module();
        
        if($module==$activeModule){
			return 'active';	
		}
		else{
			return '';	
		}		
    }   
}
if ( ! function_exists('setCollapsable'))
{
    function setCollapsable($module)
    {
		$CI = get_instance();
		
        $activeModule = $CI->router->fetch_module();
        
        if($module==$activeModule){
			return 'show';	
		}
		else{
			return '';	
		}		
    }   
}
if ( ! function_exists('checkActiveModuelAction'))
{
    function checkActiveModuelAction($module, $action, $segment="")
    {
		$CI = get_instance();
		
        $activeModule = $CI->router->fetch_module();
        $activeModuleAction = $CI->router->fetch_method();

        if($module==$activeModule && $activeModuleAction==$action){
			if($segment != ''){
				$last = $CI->uri->total_segments();
				$currSegment = $CI->uri->segment($last);
				if($segment == $currSegment){
					return 'active';	
				}	
			}
			else{	
				return 'active';	
			}
		}
		elseif($module==$activeModule && $action=='index' && $activeModuleAction=='edit'){
			if($segment != ''){
				$last = $CI->uri->total_segments();
				$currSegment = $CI->uri->segment($last);
				if($segment == $currSegment){
					return 'active';	
				}	
			}
			else{	
				return 'active';	
			}
		}	
		else{
			return '';	
		}		
    }   
}
