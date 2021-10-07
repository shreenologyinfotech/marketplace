<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
//$route['404_override'] = 'errors/page_missing';
//$route['404_override'] = 'errors/notfound';
//$route['403-forbidden'] = 'errors/notallowed';
//$route['deletebed/:num'] 				= "bed/Bed/deletebed/$1";


$route['translate_uri_dashes'] 				= FALSE;
$route['default_controller'] 				= 'home';
$route['home/(:any)'] 						= 'home/view/$1';
$route['advertisers/dosignup'] 				= 'signup/doadveritsersignup';
$route['contactus'] 						= 'home/contactus';
$route['faq'] 								= 'home/faq';
$route['newsletter'] 						= 'home/newsletter';
$route['welcome'] 							= 'home/profile';
$route['editprofile'] 						= 'home/editprofile';
$route['trackyourorders'] 					= 'home/myorders';
$route['trackyourorders/(:any)'] 			= 'home/myorders/$1';
$route['changepassword'] 					= 'home/changepassword';
$route['logout'] 							= 'home/logout';
$route['forgotpassword/(:any)'] 			= 'home/forgotpassword/$1/';
$route['viewinvoice/(:any)/(:any)'] 		= 'home/viewinvoice/$1/$2';
$route['viewrefund/(:any)'] 				= 'home/viewrefund/$1';

$route['search/(:any)'] 					= 'home/search/$1';
$route['search/(:any)/(:any)'] 		    	= 'home/search/$1/$2';
$route['search/(:any)/(:any)/(:any)']       = 'home/search/$1/$2/$3';
$route['search/(:any)/(:any)/(:any)/(:any)']= 'home/search/$1/$2/$3/$4';
$route['search/(:any)/(:any)/(:any)/(:any)/(:any)']= 'home/search/$1/$2/$3/$4/$6';
$route['search/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)']= 'home/search/$1/$2/$3/$4/$6/$7';

$route['search/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)']= 'home/search/$1/$2/$3/$4/$6/$7/$8';
$route['search/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)']= 'home/search/$1/$2/$3/$4/$6/$7/$8/$9';

$route['search/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)/(:any)']= 'home/search/$1/$2/$3/$4/$6/$7/$8/$9/$10';

$route['productdetails/(:any)'] 			= 'home/productdetails/$1';
$route['signupretailer'] 					= 'home/signupretailer';
$route['favourite'] 						= 'home/favourite';
$route['cart'] 								= 'home/cart';
$route['private-buy-sell'] 					= 'home/buysellprivate';
$route['storelocator'] 						= 'home/storelocator';
$route['searchpost'] 						= 'home/postsearch';
$route['pre-checkout'] 						= 'home/precheckout';
$route['checkout-confirm/(:any)'] 			= 'home/checkoutconfirm/$1';
$route['switchlanguage/(:any)'] 			= 'home/switchlanguage/$1';

$route['checkout'] 							= 'home/checkout';
$route['checkout-success'] 					= 'home/checkoutSuccess';
$route['new-retailer-account'] 				= 'home/createretaileraccount';
$route['new-retailer-signup'] 				= 'home/retailerSignup';
$route['createNewStoreAccount'] 			= 'home/createNewStoreAccount';
$route['contact-us'] 						= 'home/contactus';
$route['subscribenewsletter'] 				= 'home/subscribenewsletter';

$route['stripepay'] 			        	= 'StripePay';
$route['stripepay/payment'] 			        	= 'StripePay/payment';

 

$route['addsetting'] 						= 'sitesetting/loadsettingview';
$route['admin/login'] 						= 'adminlogin';
$route['admin/dashboard'] 					= 'admindashboard';
$route['admin/profile'] 					= 'adminprofile';


$route['admin/managepromo'] 				= 'admindashboard/managepromo';
$route['admin/addpromo'] 					= 'admindashboard/addpromo';
$route['admin/editpromo/(:any)'] 			= 'admindashboard/editpromo/$1';

	

$route['admin/advertisers'] 				= 'advertisers';
$route['admin/addadvertiser'] 				= 'advertisers/addadvertiser';
$route['admin/user/withdrawrequest/:num'] 	= 'users/withdrawrequest/$1';
$route['admin/user/withdrawrequest'] 		= 'users/withdrawrequest';
//$route['admin/user/withdrawal'] 			= 'users/withdrawal';

$route['admin/user/comments/:num'] 			= 'users/comments/$1';
$route['admin/managefooter'] 				= 'home/footerlinkview';
$route['admin/addfooterlink'] 				= 'home/addfooterlink';
$route['admin/editfooterlink/:num'] 		= 'home/editfooterlink/$1';

$route['myaccount/signout'] 				= 'home/signout';
$route['myaccount/new'] 					= 'home/signupstore';
$route['logoutmyaccount'] 					= 'myaccount/logout';
$route['bikeexchange/logoutmyaccount'] 		= 'myaccount/logout';


$route['admin/manageblockfooter'] 			= 'pages/managefooterblock';
$route['editadvertiser/:num'] 				= 'advertisers/editadvertiser/$1';
$route['admin/adduser'] 					= 'users/adduser';


$route['admin/addstore'] 					= 'stores/addstore';
$route['admin/stores'] 						= 'stores';
$route['admin/users'] 						= 'users';
	
$route['admin/newsletters'] 				= 'newsletters';	

$route['admin/orders'] 						= 'orders';
$route['admin/orders/(:any)'] 				= 'orders';
$route['admin/pricetable'] 					= 'pricetable';
$route['admin/doupdatepricetable'] 			= 'pricetable/doupdatepricetable';
$route['admin/pricetable/edit/:num'] 		= 'pricetable/edit/$1';




$route['edituser/:num'] 					= 'users/edituser/$1';
$route['addlocation'] 						= 'locations/addlocation';
$route['editlocation/:num'] 				= 'locations/editlocation/$1';
$route['viewlocation/:num'] 				= 'locations/viewlocation/$1';
$route['addpackage'] 						= 'packages/addpackage';
$route['editpackage/:num'] 					= 'packages/editpackage/$1';

$route['addpage'] 							= 'pages/addpage';
$route['editpage/:num'] 					= 'pages/editpage/$1';
$route['admin/user/view/:num'] 				= 'users/viewusers/$1';
$route['admin/advertiser/view/:num'] 		= 'advertisers/view/$1';
$route['refundrequestbyorderid/:num'] 		= 'ajax/refundrequestbyorderid/$1';



$route['transactionhistory'] 				= 'home/transactionhistory';
$route['createorder'] 						= 'advertiserorder';
$route['getpinbyarea'] 						= 'ajax/getpinbyarea';
$route['getareabycentral'] 					= 'ajax/getareabycentral';
$route['getseencount'] 						= 'ajax/getseencount';
$route['removeorderimage']      			= 'ajax/removeorderimage';

$route['isvalidpostalcode']      			= 'ajax/isvalidpostalcode';


$route['makeorderpayment'] 					= 'advertiserorder/makeorderpayment';
$route['vieworder/:num'] 					= 'advertiserorder/vieworder/$1';
$route['editorder/:num'] 					= 'advertiserorder/editorder/$1';
$route['cancellorder'] 						= 'advertiserorder/cancellorder';
$route['applyorderfilter'] 					= 'advertiserorder/applyorderfilter';
$route['deleteorder/:num'] 					= 'advertiserorder/deleteorder/$1';
$route['admin/order/view/:num'] 			= 'orders/vieworder/$1';
$route['admin/order/edit/:num'] 			= 'orders/editorders/$1';
$route['doeditorder'] 						= 'orders/doeditorder';
$route['admin/order/viewhistory/:num'] 		= 'orders/viewhistory/$1';
$route['admin/notification/send'] 			= 'notifications/addnotification';
$route['admin/notification/send/:num'] 		= 'notifications/addnotification/$1';
$route['admin/notification/delete/:num'] 	= 'notifications/delete/$1';
$route['admin/invoice/view/(:any)/(:any)'] 	= 'invoices/viewinvoice/$1/$1';
$route['admin/refund/view/(:any)'] 			= 'invoices/viewrefund/$1';


$route['exportappuser'] 					= 'CommonCtrl/exportuser';
$route['exportcontact'] 					= 'CommonCtrl/exportcontact';
$route['exportadvertiser'] 					= 'CommonCtrl/exportadvertiser';
$route['exportorder'] 						= 'CommonCtrl/exportorder';
$route['refundexport'] 						= 'CommonCtrl/refundexport';
$route['exporttransaction'] 				= 'CommonCtrl/exporttransaction';
$route['exportorderstatus'] 				= 'CommonCtrl/exportorderstatus';
$route['exportwithdraw'] 					= 'CommonCtrl/exportwithdraw';

$route['admin/transactions'] 				= 'orders/transactions';
$route['verifyadvertiser/(:any)'] 			= 'CommonCtrl/verifyadvertiser';
$route['verifyappuser/(:any)'] 				= 'CommonCtrl/verifyappuser';
$route['admin/manageadmin'] 				= 'admindashboard/manageadmin';
$route['admin/addadmin'] 					= 'admindashboard/loadAddAdminView';
$route['admin/editadmin/(:num)'] 			= 'admindashboard/editadmin/$1';
$route['admin/contacts'] 					= 'contacts';
$route['admin/contact/reply/(:num)'] 		= 'contacts/replycontact';
$route['admin/contact/doreply'] 			= 'contacts/mereplycontact';
$route['admin/refunds'] 					= 'refunds';
$route['admin/aboutus/pagecontent'] 		= 'aboutus/pagecontent';
$route['admin/faq/pagecontent'] 			= 'aboutus/pagefaq';
$route['admin/sitefaq'] 					= 'faq';


$route['admin/addfaq'] 						= 'faq/addfaq';
$route['admin/editfaq/:num'] 				= 'faq/editfaq/:num';




$route['admin/addinterest'] 				= 'interests/addinterest';
$route['admin/editinterest/:num'] 			= 'interests/editinterest/$1';
$route['admin/interests'] 					= 'interests';


$route['admin/employements'] 				= 'employements';
$route['admin/addemployement'] 				= 'employements/addemployement';
$route['admin/editemployement/:num'] 		= 'employements/editemployement/$1';


$route['admin/addevents'] 					= 'events/addevents';
$route['admin/editevents/:num'] 			= 'events/editevents/$1';
$route['admin/viewparticipate/:num'] 		= 'events/viewparticipate/$1';
$route['admin/events'] 						= 'events';
 

$route['paypal/success'] 					= 'Paypal/success';
$route['paypal/ipn'] 						= 'Paypal/ipn';
$route['paypal/cancel'] 					= 'Paypal/cancel';
$route['advertisewithus'] 					= 'signup/advertisewithus';



$route['admin/pricetableadvert'] 				= 'pricetableadvert';
$route['admin/doupdatepricetableadvert'] 		= 'pricetableadvert/doupdatepricetable';
$route['admin/pricetableadvert/edit/:num'] 		= 'pricetableadvert/edit/$1';



$route['admin/bannerlistsearch'] 			= 'banners/bannerlistsearch';
$route['admin/bannerlist'] 					= 'banners/bannerlist';
$route['admin/addbanner'] 					= 'banners/addbanner';
$route['admin/doaddbanner'] 				= 'banners/doaddbanner';
$route['admin/editbanner/(:num)'] 			= 'banners/editbanner/$1';

$route['admin/homecategorylist'] 				= 'homecategory/homecategorylist';
$route['admin/addhomecategory'] 				= 'homecategory/addhomecategory';
$route['admin/doaddhomecategory'] 				= 'homecategory/doaddhomecategory';
$route['admin/edithomecategory/(:num)'] 		= 'homecategory/edithomecategory/$1';


$route['admin/brandslist'] 				= 'brands/brandslist';
$route['admin/addbrands'] 				= 'brands/addbrands';
$route['admin/doaddbrands'] 				= 'brands/doaddbrands';
$route['admin/editbrands/(:num)'] 		= 'brands/editbrands/$1';


$route['admin/subcategorylist'] 			= 'subcategory/subcategorylist';
$route['admin/addsubcategory'] 				= 'subcategory/addsubcategory';
$route['admin/doaddsubcategory'] 			= 'subcategory/doaddsubcategory';
$route['admin/editsubcategory/(:num)'] 		= 'subcategory/editsubcategory/$1';


$route['admin/productlist'] 			    = 'product/productlist';
$route['admin/productlist/(:any)'] 			= 'product/productlist';
$route['admin/addproduct'] 					= 'product/addproduct';
$route['admin/doaddproduct'] 				= 'product/doaddproduct';
$route['admin/editproduct/(:num)'] 			= 'product/editproduct/$1';
$route['paywithpaypal'] 			= 'home/loadPayView';


/**************Api Module***************/
$route['api/v1/(:any)'] = 'v1/$1';
$route['api/v1/(:any)/(:any)'] = 'v1/$1/$2';
$route['api/v1/(:any)/(:any)/(:any)'] = 'v1/$1/$2/$3';



//$route['([^/]+)/?'] 						= 'home/loadpage/$1'




