<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**---general config---**/

$config['admin_container'] 					= "admin/template/layout";
$config['front_container'] 					= "front/template/layout";
$config['api_container'] 					= "front/template/layout-plain";
$config['my_account_container'] 			= "front/template/my_account_layout";


$config['upload_url'] 				 		= './uploads/';


$config['module_path'] = APPPATH . "modules";

/**---user image config---**/
$config['user_image']['upload_path'] = './uploads/users/';
$config['user_image']['allowed_types'] = 'gif|jpg|png|jpeg';
$config['user_image']['overwrite'] = true;
$config['user_image']['remove_spaces'] = true;
$config['user_image']['max_size'] = 10000;

/**---pagination config---**/
$config['pagination']['default_order_col'] = 0;
$config['pagination']['default_order_dir'] = 'desc';
$config['pagination']['default_page_length'] = 25;

/**---Auth exceptional modules config---**/
$config['auth_exceptional_mvc'] = ['auth','errors'];

/**---Permission exceptional modules config---**/
$config['permission_exceptional_mvc']['auth'] = '*';
$config['permission_exceptional_mvc']['errors'] = '*';
$config['permission_exceptional_mvc']['users'] = ['Users'=>['profile', 'update_profile', 'update_profile_save']];

/**---Default Date Format---**/
$config['date_format'] = 'M j Y';
$config['date_time_format'] = 'M j Y H:i:s';

/**---Default questcoin value---**/
