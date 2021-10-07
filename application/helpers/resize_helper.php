<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('resize'))
{
    function resize($fileName, $source, $destination, $marker = '_thumb', $width=60, $height=60, $maintainRatio = true, $resize = true )
    {
		$error = false;
		$CI = get_instance();
		
		$config_manip = array(
			'image_library' => 'gd2',
			'source_image' => $source.$fileName,
			'new_image' => $destination,
			'maintain_ratio' => $maintainRatio,
			'create_thumb' => $resize,
			'thumb_marker' => $marker,
			'width' => $width,
			'height' => $height
		);

		$CI->load->library('image_lib');
		$CI->image_lib->initialize($config_manip);
		if (!$CI->image_lib->resize()) {
			print_r($CI->image_lib->display_errors());
			error_log($CI->image_lib->display_errors());
			$error = true;
		}
			
		$CI->image_lib->clear();
		
		if($error){
			return '';
		}
		else{
			$xp = $CI->image_lib->explode_name($fileName);
			return $xp['name'].$marker.$xp['ext'];
		}		
		
			
    }   
}
