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
|	$route['404_override'] = 'errors/page_missing';
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
if(substr_count($_SERVER['REQUEST_URI'],"/".ADMIN_BASE) > 0 ){
  $route[ADMIN_BASE] = "agadmin/Adminlogin";
  $route['404_override'] = "pagenotfound/admin";
}else{
  $route['default_controller'] = "home";
  $route['404_override'] = 'pagenotfound';
} 
/************************
	Front End
************************/
/*$route['agae'] = "home";
$route['page/(:any)'] = "page/index/$1";
$route['fullpage/(:any)'] = "fullpage/index/$1";*/
$route[AGAE_BASE] = "home";
//$route['page/(:any)'] = "page/index/$1";
$route[AGAE_BASE.'/page/rates_of_interest'] = "agae/rates_of_interest";
$route[AGAE_BASE.'/page/(:any)'] = "agae/page/$1";

/************************
	End Front End
************************/
//$route['subs/*'] = "subs/";
/************************
	Back End
************************/
$route[ADMIN_BASE.'/adminlogin'] = "agadmin/adminlogin";
$route[ADMIN_BASE.'/adminlogin/(:any)'] = "agadmin/adminlogin/$1";
$route[ADMIN_BASE.'/adminlogin/(:any)/(:any)'] = "agadmin/adminlogin/$1/$2";
$route[ADMIN_BASE.'/forgot-password'] = "agadmin/adminlogin/forgotpassword";

$route[ADMIN_BASE.'/members'] = "agadmin/members";
$route[ADMIN_BASE.'/members/add'] = "agadmin/members/add";
$route[ADMIN_BASE.'/members/edit/(:any)'] = "agadmin/members/add/$1";
$route[ADMIN_BASE.'/members/delete/(:any)'] = "agadmin/members/delete/$1";

$route[ADMIN_BASE.'/dashboard'] = "agadmin/dashboard";

$route[ADMIN_BASE.'/contents/agae'] = "agadmin/pages";
$route[ADMIN_BASE.'/pages/add'] = "agadmin/pages/add";
$route[ADMIN_BASE.'/pages/edit/(:any)'] = "agadmin/pages/add/$1";
$route[ADMIN_BASE.'/pages/delete/(:any)'] = "agadmin/pages/delete/$1";
$route[ADMIN_BASE.'/pages/check_url_exists'] = "agadmin/pages/check_url_exists";

$route[ADMIN_BASE.'/blocks'] = "agadmin/blocks";
$route[ADMIN_BASE.'/blocks/add'] = "agadmin/blocks/add";
$route[ADMIN_BASE.'/blocks/edit/(:any)'] = "agadmin/blocks/add/$1";

$route[ADMIN_BASE.'/links'] = "agadmin/links";
$route[ADMIN_BASE.'/links/add'] = "agadmin/links/add";
$route[ADMIN_BASE.'/links/edit/(:any)'] = "agadmin/links/add/$1";

$route[ADMIN_BASE.'/menu/ag-ae'] = "agadmin/menu/ag_ae";
$route[ADMIN_BASE.'/menu/ag-ae-add'] = "agadmin/menu/ag_ae_add";
$route[ADMIN_BASE.'/menu/ag-ae-edit/(:any)'] = "agadmin/menu/ag_ae_add/$1";
$route[ADMIN_BASE.'/menu/ag-ae-delete/(:any)'] = "agadmin/menu/ag_ae_delete/$1";

$route[ADMIN_BASE.'/menu/tender-notice'] = "agadmin/menu/tender_notice";
$route[ADMIN_BASE.'/menu/tender-notice-add'] = "agadmin/menu/tender_notice_add";
$route[ADMIN_BASE.'/menu/tender-notice-edit/(:any)'] = "agadmin/menu/tender_notice_add/$1";
$route[ADMIN_BASE.'/menu/tender-notice-delete/(:any)'] = "agadmin/menu/tender_notice_delete/$1";

$route[ADMIN_BASE.'/menu/contact-us'] = "agadmin/menu/contact_us";
$route[ADMIN_BASE.'/menu/contact-us-add'] = "agadmin/menu/contact_us_add";
$route[ADMIN_BASE.'/menu/contact-us-edit/(:any)'] = "agadmin/menu/contact_us_add/$1";
$route[ADMIN_BASE.'/menu/contact-us-delete/(:any)'] = "agadmin/menu/contact_us_delete/$1";

#$route[ADMIN_BASE.'/gpf'] = "agadmin/gpf";

$route[ADMIN_BASE.'/gpf/part_1'] = "agadmin/gpf/part_1";
$route[ADMIN_BASE.'/gpf/part_1_upload'] = "agadmin/gpf/part_1_upload";
$route[ADMIN_BASE.'/gpf/part_1_ajax_upload'] = "agadmin/gpf/part_1_ajax_upload";

$route[ADMIN_BASE.'/gpf/part_2'] = "agadmin/gpf/part_2";
$route[ADMIN_BASE.'/gpf/part_2_upload'] = "agadmin/gpf/part_2_upload";
$route[ADMIN_BASE.'/gpf/part_2_ajax_upload'] = "agadmin/gpf/part_2_ajax_upload";

$route[ADMIN_BASE.'/gpf/part_3'] = "agadmin/gpf/part_3";
$route[ADMIN_BASE.'/gpf/part_3_upload'] = "agadmin/gpf/part_3_upload";
$route[ADMIN_BASE.'/gpf/part_3_ajax_upload'] = "agadmin/gpf/part_3_ajax_upload";

$route[ADMIN_BASE.'/gpf/part_4'] = "agadmin/gpf/part_4";
$route[ADMIN_BASE.'/gpf/part_4_upload'] = "agadmin/gpf/part_4_upload";
$route[ADMIN_BASE.'/gpf/part_4_ajax_upload'] = "agadmin/gpf/part_4_ajax_upload";

$route[ADMIN_BASE.'/gpf/part_5'] = "agadmin/gpf/part_5";
$route[ADMIN_BASE.'/gpf/part_5_upload'] = "agadmin/gpf/part_5_upload";
$route[ADMIN_BASE.'/gpf/part_5_ajax_upload'] = "agadmin/gpf/part_5_ajax_upload";

$route[ADMIN_BASE.'/gpf/subscriber'] = "agadmin/gpf/subscriber";
$route[ADMIN_BASE.'/gpf/subscriber_upload'] = "agadmin/gpf/subscriber_upload";
$route[ADMIN_BASE.'/gpf/subscriber_ajax_upload'] = "agadmin/gpf/subscriber_ajax_upload";

$route[ADMIN_BASE.'/gpf/ledger'] = "agadmin/gpf/ledger";
$route[ADMIN_BASE.'/gpf/ledger_upload'] = "agadmin/gpf/ledger_upload";
$route[ADMIN_BASE.'/gpf/ledger_ajax_upload'] = "agadmin/gpf/ledger_ajax_upload";

$route[ADMIN_BASE.'/gpf/case_status'] = "agadmin/gpf/case_status";
$route[ADMIN_BASE.'/gpf/case_status_upload'] = "agadmin/gpf/case_status_upload";
$route[ADMIN_BASE.'/gpf/case_status_ajax_upload'] = "agadmin/gpf/case_status_ajax_upload";

$route[ADMIN_BASE.'/gpf/rate_of_interest'] = "agadmin/gpf/rate_of_interest";
$route[ADMIN_BASE.'/gpf/rate_of_interest_ajax_upload'] = "agadmin/gpf/rate_of_interest_ajax_upload";

$route[ADMIN_BASE.'/gallery'] = "agadmin/gallery";

$route[ADMIN_BASE.'/contact'] = "agadmin/contact";

$route[ADMIN_BASE.'/grievances'] = "agadmin/grievances";

$route[ADMIN_BASE.'/logout'] = "agadmin/adminlogin/logout";
/************************
	End Back End
************************/


$route['translate_uri_dashes'] = FALSE;