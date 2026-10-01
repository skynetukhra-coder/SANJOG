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
$request_uri = $_SERVER['REQUEST_URI'] ?? '';
if(substr_count($request_uri, "/".ADMIN_BASE) > 0 ){
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
$route['content/(:any)'] = "content/index/$1";
$route[AGAE_BASE.'/*'] = "agae/*";
$route['emp/form-16'] = 'emp/form_sixteen_redirect';
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
$route[ADMIN_BASE.'/profile'] = "agadmin/profile";
$route[ADMIN_BASE.'/profile/change_password'] = "agadmin/profile/change_password";
$route[ADMIN_BASE.'/members'] = "agadmin/members";
$route[ADMIN_BASE.'/members/add'] = "agadmin/members/add";
$route[ADMIN_BASE.'/members/edit/(:any)'] = "agadmin/members/add/$1";
$route[ADMIN_BASE.'/members/delete/(:any)'] = "agadmin/members/delete/$1";

$route[ADMIN_BASE.'/dashboard'] = "agadmin/dashboard";

$route[ADMIN_BASE.'/test1'] = "agadmin/pages/test1";

$route[ADMIN_BASE.'/contents/agae'] = "agadmin/pages";
$route[ADMIN_BASE.'/pages/add_agae'] = "agadmin/pages/add";
$route[ADMIN_BASE.'/pages/edit_agae/(:any)'] = "agadmin/pages/add/$1";
$route[ADMIN_BASE.'/pages/delete_agae/(:any)'] = "agadmin/pages/delete/$1";

$route[ADMIN_BASE.'/contents/aggssa'] = "agadmin/pages/aggssa";
$route[ADMIN_BASE.'/pages/add_aggssa'] = "agadmin/pages/add_aggssa";
$route[ADMIN_BASE.'/pages/edit_aggssa/(:any)'] = "agadmin/pages/add_aggssa/$1";
$route[ADMIN_BASE.'/pages/delete_aggssa/(:any)'] = "agadmin/pages/delete_aggssa/$1";

$route[ADMIN_BASE.'/contents/agersa'] = "agadmin/pages/agersa";
$route[ADMIN_BASE.'/pages/add_agersa'] = "agadmin/pages/add_agersa";
$route[ADMIN_BASE.'/pages/edit_agersa/(:any)'] = "agadmin/pages/add_agersa/$1";
$route[ADMIN_BASE.'/pages/delete_agersa/(:any)'] = "agadmin/pages/delete_agersa/$1";

$route[ADMIN_BASE.'/pages/check_url_exists'] = "agadmin/pages/check_url_exists";

$route[ADMIN_BASE.'/footer_pages'] = "agadmin/cms";
$route[ADMIN_BASE.'/footer_pages/add'] = "agadmin/cms/add";
$route[ADMIN_BASE.'/footer_pages/edit/(:any)'] = "agadmin/cms/add/$1";
$route[ADMIN_BASE.'/footer_pages/delete/(:any)'] = "agadmin/cms/delete/$1";

$route[ADMIN_BASE.'/blocks'] = "agadmin/blocks";
$route[ADMIN_BASE.'/blocks/add'] = "agadmin/blocks/add";
$route[ADMIN_BASE.'/blocks/edit/(:any)'] = "agadmin/blocks/add/$1";

$route[ADMIN_BASE.'/links_agae'] = "agadmin/links_agae";
$route[ADMIN_BASE.'/links/add_agae'] = "agadmin/links/add_agae";
$route[ADMIN_BASE.'/links/edit_agae/(:any)'] = "agadmin/links/add_agae/$1";

$route[ADMIN_BASE.'/links_aggssa'] = "agadmin/links_aggssa";
$route[ADMIN_BASE.'/links/add_aggssa'] = "agadmin/links/add_aggssa";
$route[ADMIN_BASE.'/links/edit_aggssa/(:any)'] = "agadmin/links/add_aggssa/$1";

$route[ADMIN_BASE.'/links_agersa'] = "agadmin/links_agersa";
$route[ADMIN_BASE.'/links/add_agersa'] = "agadmin/links/add_agersa";
$route[ADMIN_BASE.'/links/edit_agersa/(:any)'] = "agadmin/links/add_agersa/$1";

$route[ADMIN_BASE.'/menu/ag-ae'] = "agadmin/menu/ag_ae";
$route[ADMIN_BASE.'/menu/ag-ae-add'] = "agadmin/menu/ag_ae_add";
$route[ADMIN_BASE.'/menu/ag-ae-edit/(:any)'] = "agadmin/menu/ag_ae_add/$1";
$route[ADMIN_BASE.'/menu/ag-ae-delete/(:any)'] = "agadmin/menu/ag_ae_delete/$1";

$route[ADMIN_BASE.'/menu/ag-gssa'] = "agadmin/menu/ag_gssa";
$route[ADMIN_BASE.'/menu/ag-gssa-add'] = "agadmin/menu/ag_gssa_add";
$route[ADMIN_BASE.'/menu/ag-gssa-edit/(:any)'] = "agadmin/menu/ag_gssa_add/$1";
$route[ADMIN_BASE.'/menu/ag-gssa-delete/(:any)'] = "agadmin/menu/ag_gssa_delete/$1";

$route[ADMIN_BASE.'/menu/ag-ersa'] = "agadmin/menu/ag_ersa";
$route[ADMIN_BASE.'/menu/ag-ersa-add'] = "agadmin/menu/ag_ersa_add";
$route[ADMIN_BASE.'/menu/ag-ersa-edit/(:any)'] = "agadmin/menu/ag_ersa_add/$1";
$route[ADMIN_BASE.'/menu/ag-ersa-delete/(:any)'] = "agadmin/menu/ag_ersa_delete/$1";

$route[ADMIN_BASE.'/menu/tender-notice'] = "agadmin/menu/tender_notice";
$route[ADMIN_BASE.'/menu/tender-notice-add'] = "agadmin/menu/tender_notice_add";
$route[ADMIN_BASE.'/menu/tender-notice-edit/(:any)'] = "agadmin/menu/tender_notice_add/$1";
$route[ADMIN_BASE.'/menu/tender-notice-delete/(:any)'] = "agadmin/menu/tender_notice_delete/$1";

$route[ADMIN_BASE.'/menu/contact-us'] = "agadmin/menu/contact_us";
$route[ADMIN_BASE.'/menu/contact-us-add'] = "agadmin/menu/contact_us_add";
$route[ADMIN_BASE.'/menu/contact-us-edit/(:any)'] = "agadmin/menu/contact_us_add/$1";
$route[ADMIN_BASE.'/menu/contact-us-delete/(:any)'] = "agadmin/menu/contact_us_delete/$1";

#$route[ADMIN_BASE.'/gpf'] = "agadmin/gpf";
$route[ADMIN_BASE.'/administration/multi_upload'] = "agadmin/administration/multi_upload";
$route[ADMIN_BASE.'/administration/multi_upload_edit/(:any)'] = "agadmin/administration/multi_upload/$1";
$route[ADMIN_BASE.'/administration/multi_upload_delete/(:any)'] = "agadmin/administration/multi_upload_delete/$1";
$route[ADMIN_BASE.'/administration/multi_rows_csv'] = "agadmin/administration/multi_rows_csv";

$route[ADMIN_BASE.'/administration/employee'] = "agadmin/administration/employee";
$route[ADMIN_BASE.'/administration/employee_edit/(:any)'] = "agadmin/administration/employee_edit/$1";
$route[ADMIN_BASE.'/administration/employee_edit_pdf/(:any)'] = "agadmin/administration/employee_edit_pdf/$1";
$route[ADMIN_BASE.'/administration/employee_edit_sec/(:any)'] = "agadmin/administration/employee_edit_sec/$1";
$route[ADMIN_BASE.'/administration/employee_upload'] = "agadmin/administration/employee_upload";
$route[ADMIN_BASE.'/administration/employee_ajax_upload'] = "agadmin/administration/employee_ajax_upload";
$route[ADMIN_BASE.'/administration/employee_details_upload'] = "agadmin/administration/employee_details_upload";
$route[ADMIN_BASE.'/administration/employee_details_ajax_upload'] = "agadmin/administration/employee_details_ajax_upload";
$route[ADMIN_BASE.'/administration/employee_application'] = "agadmin/administration/employee_application";
$route[ADMIN_BASE.'/administration/period_employees_application'] = "agadmin/administration/period_employees_application";
$route[ADMIN_BASE.'/administration/employees_application'] = "agadmin/administration/employees_application";
$route[ADMIN_BASE.'/administration/employee_login'] = "agadmin/administration/employee_login";
$route[ADMIN_BASE.'/administration/employee_pan/(:any)'] = "agadmin/administration/employee_pan/$1";

$route[ADMIN_BASE.'/praggssa/employee'] = "agadmin/praggssa/employee";
$route[ADMIN_BASE.'/praggssa/employee_edit/(:any)'] = "agadmin/praggssa/employee_edit/$1";
$route[ADMIN_BASE.'/praggssa/employee_upload'] = "agadmin/praggssa/employee_upload";
$route[ADMIN_BASE.'/praggssa/employee_ajax_upload'] = "agadmin/praggssa/employee_ajax_upload";
$route[ADMIN_BASE.'/praggssa/employee_details_upload'] = "agadmin/praggssa/employee_details_upload";
$route[ADMIN_BASE.'/praggssa/employee_details_ajax_upload'] = "agadmin/praggssa/employee_details_ajax_upload";
$route[ADMIN_BASE.'/praggssa/employee_application'] = "agadmin/praggssa/employee_application";
$route[ADMIN_BASE.'/praggssa/all_employees_application'] = "agadmin/praggssa/all_employees_application";

$route[ADMIN_BASE.'/agersa/employee'] = "agadmin/agersa/employee";
$route[ADMIN_BASE.'/agersa/employee_edit/(:any)'] = "agadmin/agersa/employee_edit/$1";
$route[ADMIN_BASE.'/agersa/employee_upload'] = "agadmin/agersa/employee_upload";
$route[ADMIN_BASE.'/agersa/employee_ajax_upload'] = "agadmin/agersa/employee_ajax_upload";
$route[ADMIN_BASE.'/agersa/employee_details_upload'] = "agadmin/agersa/employee_details_upload";
$route[ADMIN_BASE.'/agersa/employee_details_ajax_upload'] = "agadmin/agersa/employee_details_ajax_upload";
$route[ADMIN_BASE.'/agersa/employee_application'] = "agadmin/agersa/employee_application";
$route[ADMIN_BASE.'/agersa/all_employees_application'] = "agadmin/agersa/all_employees_application";


$route[ADMIN_BASE.'/agersa/office_order'] = "agadmin/agersa/office_order";
$route[ADMIN_BASE.'/agersa/office_order_add'] = "agadmin/agersa/office_order_add";
$route[ADMIN_BASE.'/agersa/office_order_edit/(:any)'] = "agadmin/agersa/office_order_add/$1";
$route[ADMIN_BASE.'/agersa/office_order_delete/(:any)'] = "agadmin/agersa/office_order_delete/$1";


$route[ADMIN_BASE.'/accounts/da_cadare'] = "agadmin/accounts/da_cadare";
$route[ADMIN_BASE.'/accounts/da_cadare_edit/(:any)'] = "agadmin/accounts/da_cadare_edit/$1";
$route[ADMIN_BASE.'/accounts/da_cadare_upload'] = "agadmin/accounts/da_cadare_upload";
$route[ADMIN_BASE.'/accounts/da_cadare_ajax_upload'] = "agadmin/accounts/da_cadare_ajax_upload";
$route[ADMIN_BASE.'/accounts/da_cadare_details_upload'] = "agadmin/accounts/da_cadare_details_upload";
$route[ADMIN_BASE.'/accounts/da_cadare_details_ajax_upload'] = "agadmin/accounts/da_cadare_details_ajax_upload";

$route[ADMIN_BASE.'/administration/office_order'] = "agadmin/administration/office_order";
$route[ADMIN_BASE.'/administration/office_order_add'] = "agadmin/administration/office_order_add";
$route[ADMIN_BASE.'/administration/office_order_edit/(:any)'] = "agadmin/administration/office_order_edit/$1";
$route[ADMIN_BASE.'/administration/office_order_delete/(:any)'] = "agadmin/administration/office_order_delete/$1";
$route[ADMIN_BASE.'/administration/office_order/(:any)'] = "agadmin/administration/office_order/$1";


$route[ADMIN_BASE.'/administration/apar_booklet'] = "agadmin/administration/apar_booklet";
$route[ADMIN_BASE.'/administration/apar_booklet_add'] = "agadmin/administration/apar_booklet_add";
$route[ADMIN_BASE.'/administration/apar_booklet_edit/(:any)'] = "agadmin/administration/apar_booklet_add/$1";
$route[ADMIN_BASE.'/administration/apar_booklet_delete/(:any)'] = "agadmin/administration/apar_booklet_delete/$1";
$route[ADMIN_BASE.'/administration/service_book'] = "agadmin/administration/service_book";
$route[ADMIN_BASE.'/administration/service_book_edit/(:any)'] = "agadmin/administration/service_book_add/$1";

$route[ADMIN_BASE.'/administration/charge_master'] = "agadmin/administration/charge_master";
$route[ADMIN_BASE.'/administration/charge_master_add'] = "agadmin/administration/charge_master_add";
$route[ADMIN_BASE.'/administration/charge_master_edit/(:any)'] = "agadmin/administration/charge_master_edit/$1";
$route[ADMIN_BASE.'/administration/charge_master_delete/(:any)'] = "agadmin/administration/charge_master_delete/$1";

$route[ADMIN_BASE.'/administration/property_st_list'] = "agadmin/administration/property_st_list";
$route[ADMIN_BASE.'/administration/asset_declarations_download'] = "agadmin/administration/asset_declarations_download";
$route[ADMIN_BASE.'/administration/asset_declarations_pdf/(:any)'] = "agadmin/administration/asset_declarations_pdf/$1";
$route[ADMIN_BASE.'/administration/property_st_admn'] = "agadmin/administration/property_st_admn";
$route[ADMIN_BASE.'/administration/property_st_edit/(:any)'] = "agadmin/administration/property_st_edit/$1";


$route[ADMIN_BASE.'/administration/document_order'] = "agadmin/administration/document_order";
$route[ADMIN_BASE.'/administration/document_order_add'] = "agadmin/administration/document_order_add";
$route[ADMIN_BASE.'/administration/document_order_edit/(:any)'] = "agadmin/administration/document_order_add/$1";
$route[ADMIN_BASE.'/administration/document_order_delete/(:any)'] = "agadmin/administration/document_order_delete/$1";

$route[ADMIN_BASE.'/administration/order_employee'] = "agadmin/administration/order_employee";
$route[ADMIN_BASE.'/administration/order_employee_delete/(:any)'] = "agadmin/administration/order_employee_delete/$1";
$route[ADMIN_BASE.'/administration/training_employee'] = "agadmin/administration/training_employee";
$route[ADMIN_BASE.'/administration/training_employee_delete/(:any)'] = "agadmin/administration/training_employee_delete/$1";
$route[ADMIN_BASE.'/administration/all_office_order'] = "agadmin/administration/all_office_order";
$route[ADMIN_BASE.'/administration/all_office_order_edit/(:any)'] = "agadmin/administration/all_office_order_add/$1";
$route[ADMIN_BASE.'/administration/all_office_order_delete/(:any)'] = "agadmin/administration/all_office_order_delete/$1";
$route[ADMIN_BASE.'/administration/employee_download'] = "agadmin/administration/employee_download";
$route[ADMIN_BASE.'/administration/all_office_order_flag/(:any)'] = "agadmin/administration/all_office_order_flag/$1";
$route[ADMIN_BASE.'/administration/all_office_order_flagoff/(:any)'] = "agadmin/administration/all_office_order_flagoff/$1";

$route[ADMIN_BASE.'/administration/circular_office_order'] = "agadmin/administration/circular_office_order";
$route[ADMIN_BASE.'/administration/circular_office_order_add'] = "agadmin/administration/circular_office_order_add";
$route[ADMIN_BASE.'/administration/circular_office_order_edit/(:any)'] = "agadmin/administration/circular_office_order_add/$1";
$route[ADMIN_BASE.'/administration/circular_office_order_delete/(:any)'] = "agadmin/administration/circular_office_order_delete/$1";
$route[ADMIN_BASE.'/administration/circular_office_order_upload'] = "agadmin/administration/circular_office_order_upload";
$route[ADMIN_BASE.'/administration/circular_office_order_ajax_upload'] = "agadmin/administration/circular_office_order_ajax_upload";

$route[ADMIN_BASE.'/administration/tender_notice'] = "agadmin/administration/tender_notice";
$route[ADMIN_BASE.'/administration/tender_notice_add'] = "agadmin/administration/tender_notice_add";
$route[ADMIN_BASE.'/administration/tender_notice_edit/(:any)'] = "agadmin/administration/tender_notice_add/$1";
$route[ADMIN_BASE.'/administration/tender_notice_delete/(:any)'] = "agadmin/administration/tender_notice_delete/$1";
$route[ADMIN_BASE.'/administration/tender_notice_upload'] = "agadmin/administration/tender_notice_upload";
$route[ADMIN_BASE.'/administration/tender_notice_ajax_upload'] = "agadmin/administration/tender_notice_ajax_upload";

$route[ADMIN_BASE.'/administration/exam_result'] = "agadmin/administration/exam_result";
$route[ADMIN_BASE.'/administration/exam_result_add'] = "agadmin/administration/exam_result_add";
$route[ADMIN_BASE.'/administration/exam_result_edit/(:any)'] = "agadmin/administration/exam_result_add/$1";
$route[ADMIN_BASE.'/administration/exam_result_delete/(:any)'] = "agadmin/administration/exam_result_delete/$1";
$route[ADMIN_BASE.'/administration/exam_result_upload'] = "agadmin/administration/exam_result_upload";
$route[ADMIN_BASE.'/administration/exam_result_ajax_upload'] = "agadmin/administration/exam_result_ajax_upload";

$route[ADMIN_BASE.'/administration/training'] = "agadmin/administration/training";
$route[ADMIN_BASE.'/administration/training_edit/(:any)'] = "agadmin/administration/training_edit/$1";
$route[ADMIN_BASE.'/administration/training_delete/(:any)'] = "agadmin/administration/training_delete/$1";
$route[ADMIN_BASE.'/administration/training_upload'] = "agadmin/administration/training_upload";
$route[ADMIN_BASE.'/administration/training_ajax_upload'] = "agadmin/administration/training_ajax_upload";
$route[ADMIN_BASE.'/administration/training_master_upload'] = "agadmin/administration/training_master_upload";
$route[ADMIN_BASE.'/administration/training_master_ajax_upload'] = "agadmin/administration/training_master_ajax_upload";
$route[ADMIN_BASE.'/administration/training_program'] = "agadmin/administration/training_program";
$route[ADMIN_BASE.'/administration/training_assignment/(:any)'] = "agadmin/administration/training_assignment/$1";
$route[ADMIN_BASE.'/administration/all_employees_trainings'] = "agadmin/administration/all_employees_trainings";
$route[ADMIN_BASE.'/administration/training_order_download'] = "agadmin/administration/training_order_download";
$route[ADMIN_BASE.'/administration/trg_feedback_download'] = "agadmin/administration/trg_feedback_download";

$route[ADMIN_BASE.'/administration/faculty'] = "agadmin/administration/faculty";
$route[ADMIN_BASE.'/administration/faculty_edit/(:any)'] = "agadmin/administration/training_edit/$1";
$route[ADMIN_BASE.'/administration/faculty_assignment/(:any)'] = "agadmin/administfacultyration/faculty_assignment/$1";
$route[ADMIN_BASE.'/administration/all_training_faculties'] = "agadmin/administration/all_training_faculties";
$route[ADMIN_BASE.'/administration/faculty_order_download'] = "agadmin/administration/faculty_order_download";

$route[ADMIN_BASE.'/administration/signature_master_new'] = "agadmin/administration/signature_master_new";
$route[ADMIN_BASE.'/administration/signature_master'] = "agadmin/administration/signature_master";
$route[ADMIN_BASE.'/administration/signature_master_edit/(:any)'] = "agadmin/administration/signature_master_edit/$1";
$route[ADMIN_BASE.'/administration/signature_master_delete/(:any)'] = "agadmin/administration/signature_master_delete/$1";

$route[ADMIN_BASE.'/administration/feedback'] = "agadmin/administration/feedback";
$route[ADMIN_BASE.'/administration/feedback_action/(:any)'] = "agadmin/administration/feedback_action/$1";
$route[ADMIN_BASE.'/administration/feedback_download'] = "agadmin/administration/feedback_download";
$route[ADMIN_BASE.'/administration/feedback_download_pdf/(:any)'] = "agadmin/administration/feedback_download_pdf/$1";
$route[ADMIN_BASE.'/administration/feedback_review/(:any)'] = "agadmin/administration/feedback_review/$1";
$route[ADMIN_BASE.'/feedback/all_feedback_status'] = "agadmin/feedback/all_feedback_status";
$route[ADMIN_BASE.'/administration/epabx_list'] = "agadmin/administration/epabx_list";
$route[ADMIN_BASE.'/administration/epabx_list_edit/(:any)'] = "agadmin/administration/epabx_list_edit/$1";
$route[ADMIN_BASE.'/administration/application_passport_list'] = "agadmin/administration/application_passport_list";
$route[ADMIN_BASE.'/administration/application_passport_edit/(:any)'] = "agadmin/administration/application_passport_edit/$1"; 
$route[ADMIN_BASE.'/administration/application_passport_delete/(:any)'] = "agadmin/administration/application_passport_delete/$1";
$route[ADMIN_BASE.'/administration/all_passport_applications'] = "agadmin/administration/all_passport_applications";

$route[ADMIN_BASE.'/administration/application_exam_add'] = "agadmin/administration/application_exam_add";
$route[ADMIN_BASE.'/administration/application_exam_edit/(:any)'] = "agadmin/administration/application_exam_add/$1";
$route[ADMIN_BASE.'/administration/application_invite'] = "agadmin/administration/application_invite";
$route[ADMIN_BASE.'/administration/application_invite_update/(:any)'] = "agadmin/administration/application_invite_update/$1"; 
$route[ADMIN_BASE.'/administration/application_invited'] = "agadmin/administration/application_invited";
$route[ADMIN_BASE.'/administration/application_invited_update/(:any)'] = "agadmin/administration/application_invited_update/$1"; 

$route[ADMIN_BASE.'/administration/sections'] = "agadmin/administration/sections";
$route[ADMIN_BASE.'/administration/section'] = "agadmin/administration/section";
$route[ADMIN_BASE.'/administration/section_br'] = "agadmin/administration/section_br";
$route[ADMIN_BASE.'/administration/section_branch_add'] = "agadmin/administration/section_branch_add";
$route[ADMIN_BASE.'/administration/section_branch_edit/(:any)'] = "agadmin/administration/section_branch_edit/$1";
$route[ADMIN_BASE.'/administration/section_delete/(:any)'] = "agadmin/administration/section_delete/$1";
$route[ADMIN_BASE.'/administration/section_assignment/(:any)'] = "agadmin/administration/section_assignment/$1";
$route[ADMIN_BASE.'/administration/section_branch_link/(:any)'] = "agadmin/administration/section_branch_link/$1";

$route[ADMIN_BASE.'/administration/section_transfer_new'] = "agadmin/administration/section_transfer_new";
$route[ADMIN_BASE.'/administration/section_transfer'] = "agadmin/administration/section_transfer";
$route[ADMIN_BASE.'/administration/section_transfer_assignment/(:any)'] = "agadmin/administration/section_transfer_assignment/$1";
$route[ADMIN_BASE.'/administration/section_transfer_record'] = "agadmin/administration/section_transfer_record";
$route[ADMIN_BASE.'/administration/section_transfer_record_edit/(:any)'] = "agadmin/administration/section_transfer_record_edit/$1";
$route[ADMIN_BASE.'/administration/all_employees_transfer'] = "agadmin/administration/all_employees_transfer";
$route[ADMIN_BASE.'/administration/transfer_order_download'] = "agadmin/administration/transfer_order_download";
$route[ADMIN_BASE.'/administration/section_allotment'] = "agadmin/administration/section_allotment";
$route[ADMIN_BASE.'/administration/section_allotment_edit/(:any)'] = "agadmin/administration/section_allotment_edit/$1";

$route[ADMIN_BASE.'/administration/section_charge'] = "agadmin/administration/section_charge";
$route[ADMIN_BASE.'/administration/section_charge_edit/(:any)'] = "agadmin/administration/section_charge_edit/$1";
$route[ADMIN_BASE.'/administration/section_bo_incharge'] = "agadmin/administration/section_bo_incharge";

$route[ADMIN_BASE.'/administration/hw_inventory'] = "agadmin/administration/hw_inventory";
$route[ADMIN_BASE.'/administration/hw_inventory_edit/(:any)'] = "agadmin/administration/hw_inventory_edit/$1";
$route[ADMIN_BASE.'/administration/hw_inventory_upload'] = "agadmin/administration/hw_inventory_upload";
$route[ADMIN_BASE.'/administration/hw_inventory_ajax_upload'] = "agadmin/administration/hw_inventory_ajax_upload";


$route[ADMIN_BASE.'/administration/notice_flash'] = "agadmin/administration/notice_flash";
$route[ADMIN_BASE.'/administration/notice'] = "agadmin/administration/notice";
$route[ADMIN_BASE.'/administration/notice_add'] = "agadmin/administration/notice_add";
$route[ADMIN_BASE.'/administration/notice_edit/(:any)'] = "agadmin/administration/notice_add/$1";
$route[ADMIN_BASE.'/administration/notice_delete/(:any)'] = "agadmin/administration/notice_delete/$1";

$route[ADMIN_BASE.'/training/training'] = "agadmin/training/training";
$route[ADMIN_BASE.'/training/training_edit/(:any)'] = "agadmin/training/training_edit/$1";
$route[ADMIN_BASE.'/training/training_delete/(:any)'] = "agadmin/training/training_delete/$1";
$route[ADMIN_BASE.'/training/training_master_add'] = "agadmin/training/training_master_add";
$route[ADMIN_BASE.'/training/training_upload'] = "agadmin/training/training_upload";
$route[ADMIN_BASE.'/training/training_ajax_upload'] = "agadmin/training/training_ajax_upload";
$route[ADMIN_BASE.'/training/training_master_upload'] = "agadmin/training/training_master_upload";
$route[ADMIN_BASE.'/training/training_master_ajax_upload'] = "agadmin/training/training_master_ajax_upload";
$route[ADMIN_BASE.'/training/training_program'] = "agadmin/training/training_program";
$route[ADMIN_BASE.'/training/training_program_edit/(:any)'] = "agadmin/training/training_program_edit/$1";
$route[ADMIN_BASE.'/training/training_assignment/(:any)'] = "agadmin/training/training_assignment/$1";
$route[ADMIN_BASE.'/training/all_employees_trainings'] = "agadmin/training/all_employees_trainings";
$route[ADMIN_BASE.'/training/training_order_print'] = "agadmin/training/training_order_print";
$route[ADMIN_BASE.'/training/training_order_download'] = "agadmin/training/training_order_download";
$route[ADMIN_BASE.'/training/trg_feedback_download'] = "agadmin/training/trg_feedback_download";
$route[ADMIN_BASE.'/training/office_order'] = "agadmin/training/office_order";
$route[ADMIN_BASE.'/training/office_order_add'] = "agadmin/training/office_order_add";
$route[ADMIN_BASE.'/training/office_order_edit/(:any)'] = "agadmin/training/office_order_edit/$1";
$route[ADMIN_BASE.'/training/office_order_delete/(:any)'] = "agadmin/training/office_order_delete/$1";
$route[ADMIN_BASE.'/training/office_order/(:any)'] = "agadmin/training/office_order/$1";
$route[ADMIN_BASE.'/training/document_order'] = "agadmin/training/document_order";
$route[ADMIN_BASE.'/training/document_order_add'] = "agadmin/training/document_order_add";
$route[ADMIN_BASE.'/training/document_order_edit/(:any)'] = "agadmin/training/document_order_edit/$1";
$route[ADMIN_BASE.'/training/document_order_delete/(:any)'] = "agadmin/training/document_order_delete/$1";
$route[ADMIN_BASE.'/training/faculty'] = "agadmin/training/faculty";
$route[ADMIN_BASE.'/training/faculty_edit/(:any)'] = "agadmin/training/faculty_edit/$1";
$route[ADMIN_BASE.'/training/faculty_assignment/(:any)'] = "agadmin/training/faculty_assignment/$1";
$route[ADMIN_BASE.'/training/all_training_faculties'] = "agadmin/training/all_training_faculties";
$route[ADMIN_BASE.'/training/faculty_order_print'] = "agadmin/training/faculty_order_print";
$route[ADMIN_BASE.'/training/faculty_order_download'] = "agadmin/training/faculty_order_download";
$route[ADMIN_BASE.'/training/application_exam_list'] = "agadmin/training/application_exam_list";
$route[ADMIN_BASE.'/training/application_exam_list_edit/(:any)'] = "agadmin/training/application_exam_list_edit/$1"; 
$route[ADMIN_BASE.'/training/application_exam_delete/(:any)'] = "agadmin/training/application_exam_delete/$1";
$route[ADMIN_BASE.'/training/application_exam_other_list'] = "agadmin/training/application_exam_other_list";
$route[ADMIN_BASE.'/training/application_exam_other_list_edit/(:any)'] = "agadmin/training/application_exam_other_list_edit/$1"; 
$route[ADMIN_BASE.'/training/application_exam_other_delete/(:any)'] = "agadmin/training/application_exam_other_delete/$1";
$route[ADMIN_BASE.'/training/all_employees_application'] = "agadmin/training/all_employees_application";
$route[ADMIN_BASE.'/training/all_employees_application_other'] = "agadmin/training/all_employees_application_other";

$route[ADMIN_BASE.'/training/application_exam_add'] = "agadmin/training/application_exam_add";
$route[ADMIN_BASE.'/training/application_exam_edit/(:any)'] = "agadmin/training/application_exam_add/$1";
$route[ADMIN_BASE.'/training/application_invite'] = "agadmin/training/application_invite";
$route[ADMIN_BASE.'/training/application_invite_update/(:any)'] = "agadmin/training/application_invite_update/$1"; 
$route[ADMIN_BASE.'/training/application_invited'] = "agadmin/training/application_invited";
$route[ADMIN_BASE.'/training/application_invited_update/(:any)'] = "agadmin/training/application_invited_update/$1"; 

$route[ADMIN_BASE.'/grievance/feedback'] = "agadmin/grievance/feedback";
$route[ADMIN_BASE.'/grievance/feedback_review/(:any)'] = "agadmin/grievance/feedback_review/$1";
$route[ADMIN_BASE.'/grievance/admin_feedback_close/(:any)'] = "agadmin/grievance/admin_feedback_close/$1";
$route[ADMIN_BASE.'/grievance/feedback_gen'] = "agadmin/grievance/feedback_gen";
$route[ADMIN_BASE.'/grievance/feedback_admn'] = "agadmin/grievance/feedback_admn";
$route[ADMIN_BASE.'/grievance/feedback_acs'] = "agadmin/grievance/feedback_acs";
$route[ADMIN_BASE.'/grievance/feedback_fnd'] = "agadmin/grievance/feedback_fnd";
$route[ADMIN_BASE.'/grievance/feedback_pen'] = "agadmin/grievance/feedback_pen";
$route[ADMIN_BASE.'/grievance/feedback_action/(:any)'] = "agadmin/grievance/feedback_action/$1";
$route[ADMIN_BASE.'/grievance/feedback_griev'] = "agadmin/grievance/feedback_griev";
$route[ADMIN_BASE.'/grievance/grievance_add'] = "agadmin/grievance/grievance_add";
$route[ADMIN_BASE.'/grievance/grievance_edit/(:any)'] = "agadmin/grievance/grievance_edit/$1";

$route[ADMIN_BASE.'/admin_ii/form_sixteen'] = "agadmin/admin_ii/form_sixteen";
$route[ADMIN_BASE.'/admin_ii/form_sixteen_add'] = "agadmin/admin_ii/form_sixteen_add";
$route[ADMIN_BASE.'/admin_ii/form_sixteen_edit/(:any)'] = "agadmin/admin_ii/form_sixteen_add/$1";
$route[ADMIN_BASE.'/admin_ii/form_sixteen_delete/(:any)'] = "agadmin/admin_ii/form_sixteen_delete/$1";
$route[ADMIN_BASE.'/admin_ii/office_order'] = "agadmin/admin_ii/office_order";
$route[ADMIN_BASE.'/admin_ii/office_order_add'] = "agadmin/admin_ii/office_order_add";
$route[ADMIN_BASE.'/admin_ii/office_order_edit/(:any)'] = "agadmin/admin_ii/office_order_edit/$1";
$route[ADMIN_BASE.'/admin_ii/office_order_delete/(:any)'] = "agadmin/admin_ii/office_order_delete/$1";
$route[ADMIN_BASE.'/admin_ii/document_order'] = "agadmin/admin_ii/document_order";
$route[ADMIN_BASE.'/admin_ii/document_order_add'] = "agadmin/admin_ii/document_order_add";
$route[ADMIN_BASE.'/admin_ii/document_order_edit/(:any)'] = "agadmin/admin_ii/document_order_add/$1";
$route[ADMIN_BASE.'/admin_ii/document_order_delete/(:any)'] = "agadmin/admin_ii/document_order_delete/$1";

$route[ADMIN_BASE.'/admin_ii/loan'] = "agadmin/admin_ii/loan";
$route[ADMIN_BASE.'/admin_ii/loan_edit/(:any)'] = "agadmin/admin_ii/loan_edit/$1";
$route[ADMIN_BASE.'/admin_ii/loan_upload'] = "agadmin/admin_ii/loan_upload";
$route[ADMIN_BASE.'/admin_ii/loan_ajax_upload'] = "agadmin/admin_ii/loan_ajax_upload";
$route[ADMIN_BASE.'/admin_ii/all_employees_loans'] = "agadmin/admin_ii/all_employees_loans";

$route[ADMIN_BASE.'/admin_ii/encashment'] = "agadmin/admin_ii/encashment";
$route[ADMIN_BASE.'/admin_ii/encashment_edit/(:any)'] = "agadmin/admin_ii/encashment_edit/$1";
$route[ADMIN_BASE.'/admin_ii/encashment_upload'] = "agadmin/admin_ii/encashment_upload";
$route[ADMIN_BASE.'/admin_ii/encashment_ajax_upload'] = "agadmin/admin_ii/encashment_ajax_upload";
$route[ADMIN_BASE.'/admin_ii/all_employees_encashment'] = "agadmin/admin_ii/all_employees_encashment";

$route[ADMIN_BASE.'/admin_ii/bills'] = "agadmin/admin_ii/bills";
$route[ADMIN_BASE.'/admin_ii/bills_edit/(:any)'] = "agadmin/admin_ii/bills_edit/$1";
$route[ADMIN_BASE.'/admin_ii/bills_upload'] = "agadmin/admin_ii/bills_upload";
$route[ADMIN_BASE.'/admin_ii/bills_ajax_upload'] = "agadmin/admin_ii/bills_ajax_upload";
$route[ADMIN_BASE.'/admin_ii/all_employees_bills'] = "agadmin/admin_ii/all_employees_bills";

$route[ADMIN_BASE.'/admin_ii/income_tax'] = "agadmin/admin_ii/income_tax";

$route[ADMIN_BASE.'/admin_iii/employee'] = "agadmin/admin_iii/employee";
$route[ADMIN_BASE.'/admin_iii/employee_edit/(:any)'] = "agadmin/admin_iii/employee_edit/$1";
$route[ADMIN_BASE.'/admin_iii/employee_print/(:any)'] = "agadmin/admin_iii/employee_print/$1";

$route[ADMIN_BASE.'/admin_iii/circular_office_order'] = "agadmin/admin_iii/circular_office_order";
$route[ADMIN_BASE.'/admin_iii/circular_office_order_add'] = "agadmin/admin_iii/circular_office_order_add";
$route[ADMIN_BASE.'/admin_iii/circular_office_order_edit/(:any)'] = "agadmin/admin_iii/circular_office_order_add/$1";
$route[ADMIN_BASE.'/admin_iii/service_book'] = "agadmin/admin_iii/service_book";
$route[ADMIN_BASE.'/admin_iii/service_book_add'] = "agadmin/admin_iii/service_book_add";
$route[ADMIN_BASE.'/admin_iii/service_book_edit/(:any)'] = "agadmin/admin_iii/service_book_add/$1";
$route[ADMIN_BASE.'/admin_iii/service_book_delete/(:any)'] = "agadmin/admin_iii/service_book_delete/$1";

$route[ADMIN_BASE.'/admin_iii/leave_debit'] = "agadmin/admin_iii/leave_debit";
$route[ADMIN_BASE.'/admin_iii/leave_debit_edit/(:any)'] = "agadmin/admin_iii/leave_debit_edit/$1";
$route[ADMIN_BASE.'/admin_iii/leave_debit_sec_edit/(:any)'] = "agadmin/admin_iii/leave_debit_sec_edit/$1";
$route[ADMIN_BASE.'/admin_iii/leave_encashment'] = "agadmin/admin_iii/leave_encashment";
$route[ADMIN_BASE.'/admin_iii/leave_debit_cancel'] = "agadmin/admin_iii/leave_debit_cancel";
$route[ADMIN_BASE.'/admin_iii/leave_debit_upload'] = "agadmin/admin_iii/leave_debit_upload";
$route[ADMIN_BASE.'/admin_iii/leave_debit_ajax_upload'] = "agadmin/admin_iii/leave_debit_ajax_upload";
$route[ADMIN_BASE.'/admin_iii/all_employees_leaves'] = "agadmin/admin_iii/all_employees_leaves";
$route[ADMIN_BASE.'/admin_iii/leave_application_clrh_print/(:any)'] = "agadmin/admin_iii/leave_application_clrh_print/$1";
$route[ADMIN_BASE.'/admin_iii/leave_application_print/(:any)'] = "agadmin/admin_iii/leave_application_print/$1";

$route[ADMIN_BASE.'/admin_iii/leave_credit'] = "agadmin/admin_iii/leave_credit";
$route[ADMIN_BASE.'/admin_iii/leave_credit_edit/(:any)'] = "agadmin/admin_iii/leave_credit_edit/$1";
$route[ADMIN_BASE.'/admin_iii/leave_credit_upload'] = "agadmin/admin_iii/leave_credit_upload";
$route[ADMIN_BASE.'/admin_iii/leave_credit_upload_auto'] = "agadmin/admin_iii/leave_credit_upload_auto";
$route[ADMIN_BASE.'/admin_iii/leave_credit_ajax_upload'] = "agadmin/admin_iii/leave_credit_ajax_upload";
$route[ADMIN_BASE.'/admin_iii/leave_credit_ajax_upload_auto'] = "agadmin/admin_iii/leave_credit_ajax_upload_auto";
$route[ADMIN_BASE.'/admin_iii/leave_credit_ajax_upload_auto_view'] = "agadmin/admin_iii/leave_credit_ajax_upload_auto_view";

$route[ADMIN_BASE.'/admin_iii/family_member'] = "agadmin/admin_iii/family_member";
$route[ADMIN_BASE.'/admin_iii/family_member_edit/(:any)'] = "agadmin/admin_iii/family_member_edit/$1";
$route[ADMIN_BASE.'/admin_iii/family_member_upload'] = "agadmin/admin_iii/family_member_upload";
$route[ADMIN_BASE.'/admin_iii/family_member_ajax_upload'] = "agadmin/admin_iii/family_member_ajax_upload";

$route[ADMIN_BASE.'/admin_iii/leave_balance'] = "agadmin/admin_iii/leave_balance";
$route[ADMIN_BASE.'/admin_iii/leave_balance_edit/(:any)'] = "agadmin/admin_iii/leave_balance_edit/$1";
$route[ADMIN_BASE.'/admin_iii/leave_balance_upload'] = "agadmin/admin_iii/leave_balance_upload";
$route[ADMIN_BASE.'/admin_iii/leave_balance_ajax_upload'] = "agadmin/admin_iii/leave_balance_ajax_upload";
$route[ADMIN_BASE.'/admin_iii/leave_current_balance'] = "agadmin/admin_iii/leave_current_balance";
$route[ADMIN_BASE.'/admin_iii/leave_current_balance_clrh'] = "agadmin/admin_iii/leave_current_balance_clrh";
$route[ADMIN_BASE.'/admin_iii/leave_current_balance_clrh_admin'] = "agadmin/admin_iii/leave_current_balance_clrh_admin";
$route[ADMIN_BASE.'/admin_iii/leave_clrh_balance_update/(:any)'] = "agadmin/admin_iii/leave_clrh_balance_update/$1";

$route[ADMIN_BASE.'/admin_iii/leave_current_balance_other_admin'] = "agadmin/admin_iii/leave_current_balance_other_admin";
$route[ADMIN_BASE.'/admin_iii/leave_other_balance_update/(:any)'] = "agadmin/admin_iii/leave_other_balance_update/$1";

$route[ADMIN_BASE.'/admin_iii/office_order'] = "agadmin/admin_iii/office_order";
$route[ADMIN_BASE.'/admin_iii/office_order_add'] = "agadmin/admin_iii/office_order_add";
$route[ADMIN_BASE.'/admin_iii/office_order_edit/(:any)'] = "agadmin/admin_iii/office_order_edit/$1";
$route[ADMIN_BASE.'/admin_iii/office_order_delete/(:any)'] = "agadmin/admin_iii/office_order_delete/$1";

$route[ADMIN_BASE.'/admin_iii/document_order'] = "agadmin/admin_iii/document_order";
$route[ADMIN_BASE.'/admin_iii/document_order_add'] = "agadmin/admin_iii/document_order_add";
$route[ADMIN_BASE.'/admin_iii/document_order_edit/(:any)'] = "agadmin/admin_iii/document_order_add/$1";
$route[ADMIN_BASE.'/admin_iii/document_order_delete/(:any)'] = "agadmin/admin_iii/document_order_delete/$1";
$route[ADMIN_BASE.'/admin_iii/leave_credit_admin'] = "agadmin/admin_iii/leave_credit_admin";
$route[ADMIN_BASE.'/admin_iii/leave_credit_admin_edit/(:any)'] = "agadmin/admin_iii/leave_credit_admin_edit/$1";
$route[ADMIN_BASE.'/admin_iii/leave_debit_admin'] = "agadmin/admin_iii/leave_debit_admin";
$route[ADMIN_BASE.'/admin_iii/leave_debit_admin_edit/(:any)'] = "agadmin/admin_iii/leave_debit_admin_edit/$1";

$route[ADMIN_BASE.'/record/office_order'] = "agadmin/record/office_order";
$route[ADMIN_BASE.'/record/office_order_add'] = "agadmin/record/office_order_add";
$route[ADMIN_BASE.'/record/office_order_edit/(:any)'] = "agadmin/record/office_order_edit/$1";
$route[ADMIN_BASE.'/record/office_order_delete/(:any)'] = "agadmin/record/office_order_delete/$1";
$route[ADMIN_BASE.'/record/order_employee'] = "agadmin/record/order_employee";
$route[ADMIN_BASE.'/record/order_employee_delete/(:any)'] = "agadmin/record/order_employee_delete/$1";
$route[ADMIN_BASE.'/record/office_order/(:any)'] = "agadmin/record/office_order/$1";

$route[ADMIN_BASE.'/record/circular_office_order'] = "agadmin/record/circular_office_order";
$route[ADMIN_BASE.'/record/circular_office_order_add'] = "agadmin/record/circular_office_order_add";
$route[ADMIN_BASE.'/record/circular_office_order_edit/(:any)'] = "agadmin/record/circular_office_order_add/$1";
$route[ADMIN_BASE.'/record/circular_office_order_delete/(:any)'] = "agadmin/record/circular_office_order_delete/$1";
$route[ADMIN_BASE.'/record/circular_office_order_upload'] = "agadmin/record/circular_office_order_upload";
$route[ADMIN_BASE.'/record/circular_office_order_ajax_upload'] = "agadmin/record/circular_office_order_ajax_upload";

$route[ADMIN_BASE.'/record/tender_notice'] = "agadmin/record/tender_notice";
$route[ADMIN_BASE.'/record/tender_notice_add'] = "agadmin/record/tender_notice_add";
$route[ADMIN_BASE.'/record/tender_notice_edit/(:any)'] = "agadmin/record/tender_notice_add/$1";
$route[ADMIN_BASE.'/record/tender_notice_delete/(:any)'] = "agadmin/record/tender_notice_delete/$1";
$route[ADMIN_BASE.'/record/tender_notice_upload'] = "agadmin/record/tender_notice_upload";
$route[ADMIN_BASE.'/record/tender_notice_ajax_upload'] = "agadmin/record/tender_notice_ajax_upload";

$route[ADMIN_BASE.'/record/document_order'] = "agadmin/record/document_order";
$route[ADMIN_BASE.'/record/document_order_add'] = "agadmin/record/document_order_add";
$route[ADMIN_BASE.'/record/document_order_edit/(:any)'] = "agadmin/record/document_order_add/$1";
$route[ADMIN_BASE.'/record/document_order_delete/(:any)'] = "agadmin/record/document_order_delete/$1";

$route[ADMIN_BASE.'/record/epabx_list'] = "agadmin/record/epabx_list";
$route[ADMIN_BASE.'/record/epabx_list_edit/(:any)'] = "agadmin/record/epabx_list_edit/$1";
$route[ADMIN_BASE.'/record/epabxno'] = "agadmin/record/epabxno";
$route[ADMIN_BASE.'/record/epabxno_ajax_upload'] = "agadmin/record/epabxno_ajax_upload";

$route[ADMIN_BASE.'/praggssa/office_order'] = "agadmin/praggssa/office_order";
$route[ADMIN_BASE.'/praggssa/office_order_add'] = "agadmin/praggssa/office_order_add";
$route[ADMIN_BASE.'/praggssa/office_order_edit/(:any)'] = "agadmin/praggssa/office_order_add/$1";
$route[ADMIN_BASE.'/praggssa/office_order_delete/(:any)'] = "agadmin/praggssa/office_order_delete/$1";


$route[ADMIN_BASE.'/praggssa/circular_office_order'] = "agadmin/praggssa/circular_office_order";
$route[ADMIN_BASE.'/praggssa/circular_office_order_add'] = "agadmin/praggssa/circular_office_order_add";
$route[ADMIN_BASE.'/praggssa/circular_office_order_edit/(:any)'] = "agadmin/praggssa/circular_office_order_add/$1";
$route[ADMIN_BASE.'/praggssa/circular_office_order_delete/(:any)'] = "agadmin/praggssa/circular_office_order_delete/$1";
$route[ADMIN_BASE.'/praggssa/circular_office_order_upload'] = "agadmin/praggssa/circular_office_order_upload";
$route[ADMIN_BASE.'/praggssa/circular_office_order_ajax_upload'] = "agadmin/praggssa/circular_office_order_ajax_upload";

$route[ADMIN_BASE.'/praggssa/tender_notice'] = "agadmin/praggssa/tender_notice";
$route[ADMIN_BASE.'/praggssa/tender_notice_add'] = "agadmin/praggssa/tender_notice_add";
$route[ADMIN_BASE.'/praggssa/tender_notice_edit/(:any)'] = "agadmin/praggssa/tender_notice_add/$1";
$route[ADMIN_BASE.'/praggssa/tender_notice_delete/(:any)'] = "agadmin/praggssa/tender_notice_delete/$1";
$route[ADMIN_BASE.'/praggssa/tender_notice_upload'] = "agadmin/praggssa/tender_notice_upload";
$route[ADMIN_BASE.'/praggssa/tender_notice_ajax_upload'] = "agadmin/praggssa/tender_notice_ajax_upload";

$route[ADMIN_BASE.'/agersa/circular_office_order'] = "agadmin/agersa/circular_office_order";
$route[ADMIN_BASE.'/agersa/circular_office_order_add'] = "agadmin/agersa/circular_office_order_add";
$route[ADMIN_BASE.'/agersa/circular_office_order_edit/(:any)'] = "agadmin/agersa/circular_office_order_add/$1";
$route[ADMIN_BASE.'/agersa/circular_office_order_delete/(:any)'] = "agadmin/agersa/circular_office_order_delete/$1";
$route[ADMIN_BASE.'/agersa/circular_office_order_upload'] = "agadmin/agersa/circular_office_order_upload";
$route[ADMIN_BASE.'/agersa/circular_office_order_ajax_upload'] = "agadmin/agersa/circular_office_order_ajax_upload";

$route[ADMIN_BASE.'/agersa/tender_notice'] = "agadmin/agersa/tender_notice";
$route[ADMIN_BASE.'/agersa/tender_notice_add'] = "agadmin/agersa/tender_notice_add";
$route[ADMIN_BASE.'/agersa/tender_notice_edit/(:any)'] = "agadmin/agersa/tender_notice_add/$1";
$route[ADMIN_BASE.'/agersa/tender_notice_delete/(:any)'] = "agadmin/agersa/tender_notice_delete/$1";
$route[ADMIN_BASE.'/agersa/tender_notice_upload'] = "agadmin/agersa/tender_notice_upload";
$route[ADMIN_BASE.'/agersa/tender_notice_ajax_upload'] = "agadmin/agersa/tender_notice_ajax_upload";

$route[ADMIN_BASE.'/pao/gpf_statement'] = "agadmin/pao/gpf_statement";
$route[ADMIN_BASE.'/pao/gpf_statement_add'] = "agadmin/pao/gpf_statement_add";
$route[ADMIN_BASE.'/pao/gpf_statement_edit/(:any)'] = "agadmin/pao/gpf_statement_add/$1";
$route[ADMIN_BASE.'/pao/gpf_statement_delete/(:any)'] = "agadmin/pao/gpf_statement_delete/$1";

$route[ADMIN_BASE.'/accounts/treasury'] = "agadmin/accounts/treasury";
$route[ADMIN_BASE.'/accounts/treasury_edit/(:any)'] = "agadmin/accounts/treasury_edit/$1";
$route[ADMIN_BASE.'/accounts/treasury_files/(:any)'] = "agadmin/accounts/treasury_files/$1";
$route[ADMIN_BASE.'/accounts/treasury_upload'] = "agadmin/accounts/treasury_upload";
$route[ADMIN_BASE.'/accounts/treasury_ajax_upload'] = "agadmin/accounts/treasury_ajax_upload";
$route[ADMIN_BASE.'/accounts/treasury_orders'] = "agadmin/accounts/treasury_orders";
$route[ADMIN_BASE.'/accounts/treasury_document'] = "agadmin/accounts/treasury_document";
$route[ADMIN_BASE.'/accounts/treasury_document_add'] = "agadmin/accounts/treasury_document_add";
$route[ADMIN_BASE.'/accounts/treasury_document_edit/(:any)'] = "agadmin/accounts/treasury_document_edit/$1";
$route[ADMIN_BASE.'/accounts/treasury_document_delete/(:any)'] = "agadmin/accounts/treasury_document_delete/$1";
$route[ADMIN_BASE.'/accounts/treasury_order_add'] = "agadmin/accounts/treasury_order_add";
$route[ADMIN_BASE.'/accounts/treasury_order_edit/(:any)'] = "agadmin/accounts/treasury_order_add/$1";
$route[ADMIN_BASE.'/accounts/treasury_order_delete/(:any)'] = "agadmin/accounts/treasury_order_delete/$1";

$route[ADMIN_BASE.'/accounts/treasury_reports'] = "agadmin/accounts/treasury_reports";
$route[ADMIN_BASE.'/accounts/treasury_reports_download'] = "agadmin/accounts/treasury_reports_download";
$route[ADMIN_BASE.'/accounts/treasury_currection_slip'] = "agadmin/accounts/treasury_currection_slip";
$route[ADMIN_BASE.'/accounts/treasury_currection_slip_edit/(:any)'] = "agadmin/accounts/treasury_currection_slip_edit/$1";
$route[ADMIN_BASE.'/accounts/treasury_correctionslip_download'] = "agadmin/accounts/treasury_correctionslip_download";
$route[ADMIN_BASE.'/accounts/treasury_outsttanding_paras'] = "agadmin/accounts/treasury_outsttanding_paras";
$route[ADMIN_BASE.'/accounts/treasury_outsttanding_para_edit/(:any)'] = "agadmin/accounts/treasury_outsttanding_para_edit/$1";
$route[ADMIN_BASE.'/accounts/treasury_outstanding_para_upload'] = "agadmin/accounts/treasury_outstanding_para_upload";
$route[ADMIN_BASE.'/accounts/treasury_outstanding_para_ajax_upload'] = "agadmin/accounts/treasury_outstanding_para_ajax_upload";
$route[ADMIN_BASE.'/accounts/treasury_outstandingparas_download'] = "agadmin/accounts/treasury_outstandingparas_download";

$route[ADMIN_BASE.'/accounts/treasury_obsuspense'] = "agadmin/accounts/treasury_obsuspense";
$route[ADMIN_BASE.'/accounts/treasury_obsuspense_upload'] = "agadmin/accounts/treasury_obsuspense_upload";
$route[ADMIN_BASE.'/accounts/treasury_obsuspense_ajax_upload'] = "agadmin/accounts/treasury_obsuspense_ajax_upload";
$route[ADMIN_BASE.'/accounts/treasury_misclassification'] = "agadmin/accounts/treasury_misclassification";
$route[ADMIN_BASE.'/accounts/treasury_misclassification_upload'] = "agadmin/accounts/treasury_misclassification_upload";
$route[ADMIN_BASE.'/accounts/treasury_misclassification_ajax_upload'] = "agadmin/accounts/treasury_misclassification_ajax_upload";
$route[ADMIN_BASE.'/accounts/treasury_misclassification_download'] = "agadmin/accounts/treasury_misclassification_download";
$route[ADMIN_BASE.'/accounts/training'] = "agadmin/accounts/training";

$route[ADMIN_BASE.'/accounts/department'] = "agadmin/accounts/department";
$route[ADMIN_BASE.'/accounts/department_edit/(:any)'] = "agadmin/accounts/department_edit/$1";
$route[ADMIN_BASE.'/accounts/department_upload'] = "agadmin/accounts/department_upload";
$route[ADMIN_BASE.'/accounts/department_ajax_upload'] = "agadmin/accounts/department_ajax_upload";
$route[ADMIN_BASE.'/accounts/department_order_add'] = "agadmin/accounts/department_order_add";
$route[ADMIN_BASE.'/accounts/department_order_edit/(:any)'] = "agadmin/accounts/department_order_add/$1";
$route[ADMIN_BASE.'/accounts/department_order_delete/(:any)'] = "agadmin/accounts/department_order_delete/$1";
$route[ADMIN_BASE.'/accounts/department_files'] = "agadmin/accounts/department_files";
$route[ADMIN_BASE.'/accounts/department_files_add'] = "agadmin/accounts/department_files_add";
$route[ADMIN_BASE.'/accounts/department_files_edit/(:any)'] = "agadmin/accounts/department_files_edit/$1";
$route[ADMIN_BASE.'/accounts/department_files_print/(:any)'] = "agadmin/accounts/department_files_print/$1";
$route[ADMIN_BASE.'/accounts/department_files_delete/(:any)'] = "agadmin/accounts/department_files_delete/$1";
$route[ADMIN_BASE.'/accounts/department_investment'] = "agadmin/accounts/department_investment";
$route[ADMIN_BASE.'/accounts/department_investment_edit/(:any)'] = "agadmin/accounts/department_investment_edit/$1";
$route[ADMIN_BASE.'/accounts/department_investment_upload'] = "agadmin/accounts/department_investment_upload";
$route[ADMIN_BASE.'/accounts/department_investment_ajax_upload'] = "agadmin/accounts/department_investment_ajax_upload";
$route[ADMIN_BASE.'/accounts/department_investment_delete/(:any)'] = "agadmin/accounts/department_investment_delete/$1";
$route[ADMIN_BASE.'/accounts/investment_download'] = "agadmin/accounts/investment_download";
$route[ADMIN_BASE.'/accounts/department_gia'] = "agadmin/accounts/department_gia";
$route[ADMIN_BASE.'/accounts/department_gia_upload'] = "agadmin/accounts/department_gia_upload";
$route[ADMIN_BASE.'/accounts/department_gia_ajax_upload'] = "agadmin/accounts/department_gia_ajax_upload";
$route[ADMIN_BASE.'/accounts/department_gia_delete/(:any)'] = "agadmin/accounts/department_gia_delete/$1";
$route[ADMIN_BASE.'/accounts/department_acdc'] = "agadmin/accounts/department_acdc";
$route[ADMIN_BASE.'/accounts/department_acdc_update/(:any)'] = "agadmin/accounts/department_acdc_update/$1";

$route[ADMIN_BASE.'/accounts/department_acdc_upload'] = "agadmin/accounts/department_acdc_upload";
$route[ADMIN_BASE.'/accounts/department_acdc_ajax_upload'] = "agadmin/accounts/department_acdc_ajax_upload";
$route[ADMIN_BASE.'/accounts/department_acdc_delete/(:any)'] = "agadmin/accounts/department_acdc_delete/$1";
$route[ADMIN_BASE.'/accounts/gia_download'] = "agadmin/accounts/gia_download";
$route[ADMIN_BASE.'/accounts/department_loan_advance'] = "agadmin/accounts/department_loan_advance";
$route[ADMIN_BASE.'/accounts/department_loan_advance_edit/(:any)'] = "agadmin/accounts/department_loan_advance_edit/$1";
$route[ADMIN_BASE.'/accounts/department_loan_advance_upload'] = "agadmin/accounts/department_loan_advance_upload";
$route[ADMIN_BASE.'/accounts/department_loan_advance_ajax_upload'] = "agadmin/accounts/department_loan_advance_ajax_upload";
$route[ADMIN_BASE.'/accounts/department_loan_advance_delete/(:any)'] = "agadmin/accounts/ddepartment_loan_advance_delete/$1";
$route[ADMIN_BASE.'/accounts/loan_advance_download'] = "agadmin/accounts/loan_advance_download";


$route[ADMIN_BASE.'/accounts/treasury_inspection_new'] = "agadmin/accounts/treasury_inspection_new";
$route[ADMIN_BASE.'/accounts/treasury_inspection'] = "agadmin/accounts/treasury_inspection";
$route[ADMIN_BASE.'/accounts/treasury_inspection_edit/(:any)'] = "agadmin/accounts/treasury_inspection_edit/$1";
$route[ADMIN_BASE.'/accounts/treasury_inspection_delete/(:any)'] = "agadmin/accounts/treasury_inspection_delete/$1";
$route[ADMIN_BASE.'/accounts/treasury_inspection_upload'] = "agadmin/accounts/treasury_inspection_upload";
$route[ADMIN_BASE.'/accounts/treasury_inspection_ajax_upload'] = "agadmin/accounts/treasury_inspection_ajax_upload";
$route[ADMIN_BASE.'/accounts/treasury_inspection_assignment/(:any)'] = "agadmin/accounts/treasury_inspection_assignment/$1";
$route[ADMIN_BASE.'/accounts/treasury_inspector_record'] = "agadmin/accounts/treasury_inspector_record";
$route[ADMIN_BASE.'/accounts/treasury_inspector_record_edit/(:any)'] = "agadmin/accounts/treasury_inspector_record_edit/$1";
$route[ADMIN_BASE.'/accounts/all_employees_try_inspection'] = "agadmin/accounts/all_employees_try_inspection";
$route[ADMIN_BASE.'/accounts/treasury_inspection_order_print'] = "agadmin/accounts/treasury_inspection_order_print";

$route[ADMIN_BASE.'/accounts/da_cadre'] = "agadmin/accounts/da_cadre";
$route[ADMIN_BASE.'/accounts/da_cadre_upload'] = "agadmin/accounts/da_cadre_upload";
$route[ADMIN_BASE.'/accounts/da_cadre_ajax_upload'] = "agadmin/accounts/da_cadre_ajax_upload";

$route[ADMIN_BASE.'/accounts/monthly_file'] = "agadmin/accounts/monthly_file";
$route[ADMIN_BASE.'/accounts/monthly_file_upload'] = "agadmin/accounts/monthly_file_upload";
$route[ADMIN_BASE.'/accounts/monthly_file_ajax_upload'] = "agadmin/accounts/monthly_file_ajax_upload";

$route[ADMIN_BASE.'/accounts/quarterly_file'] = "agadmin/accounts/quarterly_file";
$route[ADMIN_BASE.'/accounts/quarterly_file_upload'] = "agadmin/accounts/quarterly_file_upload";
$route[ADMIN_BASE.'/accounts/quarterly_file_ajax_upload'] = "agadmin/accounts/quarterly_file_ajax_upload";

$route[ADMIN_BASE.'/accounts/yearly_file'] = "agadmin/accounts/yearly_file";
$route[ADMIN_BASE.'/accounts/yearly_file_upload'] = "agadmin/accounts/yearly_file_upload";
$route[ADMIN_BASE.'/accounts/yearly_file_ajax_upload'] = "agadmin/accounts/yearly_file_ajax_upload";


$route[ADMIN_BASE.'/accounts/upload_files'] = "agadmin/accounts/upload_files";

$route[ADMIN_BASE.'/accounts/ddo'] = "agadmin/accounts/ddo";
$route[ADMIN_BASE.'/accounts/ddo_edit/(:any)'] = "agadmin/accounts/ddo_edit/$1";
$route[ADMIN_BASE.'/accounts/ddo_upload'] = "agadmin/accounts/ddo_upload";
$route[ADMIN_BASE.'/accounts/ddo_ajax_upload'] = "agadmin/accounts/ddo_ajax_upload";

$route[ADMIN_BASE.'/accounts/section_transfer_new'] = "agadmin/accounts/section_transfer_new";
$route[ADMIN_BASE.'/accounts/section_transfer'] = "agadmin/accounts/section_transfer";
$route[ADMIN_BASE.'/accounts/section_transfer_assignment/(:any)'] = "agadmin/accounts/section_transfer_assignment/$1";
$route[ADMIN_BASE.'/accounts/section_transfer_record'] = "agadmin/accounts/section_transfer_record";
$route[ADMIN_BASE.'/accounts/section_transfer_record_edit/(:any)'] = "agadmin/accounts/section_transfer_record_edit/$1";
$route[ADMIN_BASE.'/accounts/all_employees_transfer'] = "agadmin/accounts/all_employees_transfer";
$route[ADMIN_BASE.'/accounts/transfer_order_download'] = "agadmin/accounts/transfer_order_download";
$route[ADMIN_BASE.'/accounts/section_allotment'] = "agadmin/accounts/section_allotment";
$route[ADMIN_BASE.'/accounts/section_allotment_edit/(:any)'] = "agadmin/accounts/section_allotment_edit/$1";

$route[ADMIN_BASE.'/accounts/circular_office_order'] = "agadmin/accounts/circular_office_order";
$route[ADMIN_BASE.'/accounts/circular_office_order_add'] = "agadmin/accounts/circular_office_order_add";
$route[ADMIN_BASE.'/accounts/circular_office_order_edit/(:any)'] = "agadmin/accounts/circular_office_order_add/$1";
$route[ADMIN_BASE.'/accounts/circular_office_order_delete/(:any)'] = "agadmin/accounts/circular_office_order_delete/$1";
$route[ADMIN_BASE.'/accounts/circular_office_order_upload'] = "agadmin/accounts/circular_office_order_upload";
$route[ADMIN_BASE.'/accounts/circular_office_order_ajax_upload'] = "agadmin/accounts/circular_office_order_ajax_upload";

$route[ADMIN_BASE.'/accounts/office_order'] = "agadmin/accounts/office_order";
$route[ADMIN_BASE.'/accounts/office_order_add'] = "agadmin/accounts/office_order_add";
$route[ADMIN_BASE.'/accounts/office_order_edit/(:any)'] = "agadmin/accounts/office_order_edit/$1";
$route[ADMIN_BASE.'/accounts/office_order_delete/(:any)'] = "agadmin/accounts/office_order_delete/$1";
$route[ADMIN_BASE.'/accounts/office_order/(:any)'] = "agadmin/accounts/office_order/$1";

$route[ADMIN_BASE.'/accounts/charge_master'] = "agadmin/accounts/charge_master";
$route[ADMIN_BASE.'/accounts/charge_master_add'] = "agadmin/accounts/charge_master_add";
$route[ADMIN_BASE.'/accounts/charge_master_edit/(:any)'] = "agadmin/accounts/charge_master_edit/$1";
$route[ADMIN_BASE.'/accounts/charge_master_delete/(:any)'] = "agadmin/accounts/charge_master_delete/$1";

$route[ADMIN_BASE.'/accounts/order_employee'] = "agadmin/accounts/order_employee";
$route[ADMIN_BASE.'/accounts/order_employee_delete/(:any)'] = "agadmin/accounts/order_employee_delete/$1";

$route[ADMIN_BASE.'/accounts/document_order'] = "agadmin/accounts/document_order";
$route[ADMIN_BASE.'/accounts/document_order_add'] = "agadmin/accounts/document_order_add";
$route[ADMIN_BASE.'/accounts/document_order_edit/(:any)'] = "agadmin/accounts/document_order_add/$1";
$route[ADMIN_BASE.'/accounts/document_order_delete/(:any)'] = "agadmin/accounts/document_order_delete/$1";

$route[ADMIN_BASE.'/accounts/exam_result'] = "agadmin/accounts/exam_result";
$route[ADMIN_BASE.'/accounts/exam_result_add'] = "agadmin/accounts/exam_result_add";
$route[ADMIN_BASE.'/accounts/exam_result_edit/(:any)'] = "agadmin/accounts/exam_result_add/$1";
$route[ADMIN_BASE.'/accounts/exam_result_delete/(:any)'] = "agadmin/accounts/exam_result_delete/$1";
$route[ADMIN_BASE.'/accounts/exam_result_upload'] = "agadmin/accounts/exam_result_upload";
$route[ADMIN_BASE.'/accounts/exam_result_ajax_upload'] = "agadmin/accounts/exam_result_ajax_upload";

$route[ADMIN_BASE.'/accounts/feedback'] = "agadmin/accounts/feedback";
$route[ADMIN_BASE.'/accounts/feedback_action/(:any)'] = "agadmin/accounts/feedback_action/$1";
$route[ADMIN_BASE.'/accounts/feedback_download'] = "agadmin/accounts/feedback_download";
$route[ADMIN_BASE.'/accounts/feedback_download_pdf/(:any)'] = "agadmin/accounts/feedback_download_pdf/$1";
$route[ADMIN_BASE.'/accounts/epabx_list'] = "agadmin/accounts/epabx_list";
$route[ADMIN_BASE.'/accounts/epabx_list_edit/(:any)'] = "agadmin/accounts/epabx_list_edit/$1";

$route[ADMIN_BASE.'/wm/da_cadare'] = "agadmin/wm/da_cadare";
$route[ADMIN_BASE.'/wm/da_cadare_edit/(:any)'] = "agadmin/wm/da_cadare_edit/$1";
$route[ADMIN_BASE.'/wm/da_cadare_upload'] = "agadmin/wm/da_cadare_upload";
$route[ADMIN_BASE.'/wm/da_cadare_ajax_upload'] = "agadmin/wm/da_cadare_ajax_upload";
$route[ADMIN_BASE.'/wm/da_cadare_details_upload'] = "agadmin/wm/da_cadare_details_upload";
$route[ADMIN_BASE.'/wm/da_cadare_details_ajax_upload'] = "agadmin/wm/da_cadare_details_ajax_upload";
$route[ADMIN_BASE.'/wm/employee_download'] = "agadmin/wm/employee_download";

$route[ADMIN_BASE.'/wm/office_order'] = "agadmin/wm/office_order";
$route[ADMIN_BASE.'/wm/office_order_add'] = "agadmin/wm/office_order_add";
$route[ADMIN_BASE.'/wm/office_order_edit/(:any)'] = "agadmin/wm/office_order_edit/$1";
$route[ADMIN_BASE.'/wm/office_order_delete/(:any)'] = "agadmin/wm/office_order_delete/$1";

$route[ADMIN_BASE.'/wm/order_employee'] = "agadmin/wm/order_employee";
$route[ADMIN_BASE.'/wm/order_employee_delete/(:any)'] = "agadmin/wm/order_employee_delete/$1";
$route[ADMIN_BASE.'/wm/office_order/(:any)'] = "agadmin/wm/office_order/$1";

$route[ADMIN_BASE.'/wm/document_order'] = "agadmin/wm/document_order";
$route[ADMIN_BASE.'/wm/document_order_add'] = "agadmin/wm/document_order_add";
$route[ADMIN_BASE.'/wm/document_order_edit/(:any)'] = "agadmin/wm/document_order_add/$1";
$route[ADMIN_BASE.'/wm/document_order_delete/(:any)'] = "agadmin/wm/document_order_delete/$1";

$route[ADMIN_BASE.'/wm/exam_result'] = "agadmin/wm/exam_result";
$route[ADMIN_BASE.'/wm/exam_result_add'] = "agadmin/wm/exam_result_add";
$route[ADMIN_BASE.'/wm/exam_result_edit/(:any)'] = "agadmin/wm/exam_result_add/$1";
$route[ADMIN_BASE.'/wm/exam_result_delete/(:any)'] = "agadmin/wm/exam_result_delete/$1";
$route[ADMIN_BASE.'/wm/exam_result_upload'] = "agadmin/wm/exam_result_upload";
$route[ADMIN_BASE.'/wm/exam_result_ajax_upload'] = "agadmin/wm/exam_result_ajax_upload";

$route[ADMIN_BASE.'/wm/circular_office_order'] = "agadmin/wm/circular_office_order";
$route[ADMIN_BASE.'/wm/circular_office_order_add'] = "agadmin/wm/circular_office_order_add";
$route[ADMIN_BASE.'/wm/circular_office_order_edit/(:any)'] = "agadmin/wm/circular_office_order_add/$1";
$route[ADMIN_BASE.'/wm/circular_office_order_delete/(:any)'] = "agadmin/wm/circular_office_order_delete/$1";
$route[ADMIN_BASE.'/wm/circular_office_order_upload'] = "agadmin/wm/circular_office_order_upload";
$route[ADMIN_BASE.'/wm/circular_office_order_ajax_upload'] = "agadmin/wm/circular_office_order_ajax_upload";


$route[ADMIN_BASE.'/pension/pension'] = "agadmin/pension/pension";
$route[ADMIN_BASE.'/pension/pension_upload'] = "agadmin/pension/pension_upload";
$route[ADMIN_BASE.'/pension/pension_ajax_upload'] = "agadmin/pension/pension_ajax_upload";

$route[ADMIN_BASE.'/pension/pensioner_spouse'] = "agadmin/pension/pensioner_spouse";
$route[ADMIN_BASE.'/pension/pensioner_spouse_upload'] = "agadmin/pension/pensioner_spouse_upload";
$route[ADMIN_BASE.'/pension/pensioner_spouse_ajax_upload'] = "agadmin/pension/pensioner_spouse_ajax_upload";

$route[ADMIN_BASE.'/pension/case_status'] = "agadmin/pension/case_status";
$route[ADMIN_BASE.'/pension/case_status_details/(:any)'] = "agadmin/pension/case_status_details/$1";
$route[ADMIN_BASE.'/pension/case_status_upload'] = "agadmin/pension/case_status_upload";
$route[ADMIN_BASE.'/pension/case_status_ajax_upload'] = "agadmin/pension/case_status_ajax_upload";

$route[ADMIN_BASE.'/pension/case_dispatched'] = "agadmin/pension/case_dispatched";
$route[ADMIN_BASE.'/pension/case_dispatched_details/(:any)/(:any)'] = "agadmin/pension/case_dispatched_details/$1/$2";
$route[ADMIN_BASE.'/pension/case_dispatched_upload'] = "agadmin/pension/case_dispatched_upload";
$route[ADMIN_BASE.'/pension/case_dispatched_ajax_upload'] = "agadmin/pension/case_dispatched_ajax_upload";

$route[ADMIN_BASE.'/pension/case_return'] = "agadmin/pension/case_return";
$route[ADMIN_BASE.'/pension/case_return_upload'] = "agadmin/pension/case_return_upload";
$route[ADMIN_BASE.'/pension/case_return_ajax_upload'] = "agadmin/pension/case_return_ajax_upload";

$route[ADMIN_BASE.'/pension/ppo'] = "agadmin/pension/ppo";
$route[ADMIN_BASE.'/pension/upppogpocpo'] = "agadmin/pension/upppogpocpo";
$route[ADMIN_BASE.'/pension/ppo_upload'] = "agadmin/pension/ppo_upload";
$route[ADMIN_BASE.'/pension/ppo_ajax_upload'] = "agadmin/pension/ppo_ajax_upload";
$route[ADMIN_BASE.'/pension/upload_ppogpocpo'] = "agadmin/pension/upload_ppogpocpo";
$route[ADMIN_BASE.'/pension/ppo_delete/(:any)'] = "agadmin/pension/ppo_delete/$1";
$route[ADMIN_BASE.'/pension/ppo_duplicate'] = "agadmin/pension/ppo_duplicate";

$route[ADMIN_BASE.'/pension/section_transfer_new'] = "agadmin/pension/section_transfer_new";
$route[ADMIN_BASE.'/pension/section_transfer'] = "agadmin/pension/section_transfer";
$route[ADMIN_BASE.'/pension/section_transfer_assignment/(:any)'] = "agadmin/pension/section_transfer_assignment/$1";
$route[ADMIN_BASE.'/pension/section_transfer_record'] = "agadmin/pension/section_transfer_record";
$route[ADMIN_BASE.'/pension/section_transfer_record_edit/(:any)'] = "agadmin/pension/section_transfer_record_edit/$1";
$route[ADMIN_BASE.'/pension/all_employees_transfer'] = "agadmin/pension/all_employees_transfer";
$route[ADMIN_BASE.'/pension/transfer_order_download'] = "agadmin/pension/transfer_order_download";
$route[ADMIN_BASE.'/pension/section_allotment'] = "agadmin/pension/section_allotment";
$route[ADMIN_BASE.'/pension/section_allotment_edit/(:any)'] = "agadmin/pension/section_allotment_edit/$1";

$route[ADMIN_BASE.'/pension/circular_office_order'] = "agadmin/pension/circular_office_order";
$route[ADMIN_BASE.'/pension/circular_office_order_add'] = "agadmin/pension/circular_office_order_add";
$route[ADMIN_BASE.'/pension/circular_office_order_edit/(:any)'] = "agadmin/pension/circular_office_order_add/$1";
$route[ADMIN_BASE.'/pension/circular_office_order_delete/(:any)'] = "agadmin/pension/circular_office_order_delete/$1";
$route[ADMIN_BASE.'/pension/circular_office_order_upload'] = "agadmin/pension/circular_office_order_upload";
$route[ADMIN_BASE.'/pension/circular_office_order_ajax_upload'] = "agadmin/pension/circular_office_order_ajax_upload";

$route[ADMIN_BASE.'/pension/office_order'] = "agadmin/pension/office_order";
$route[ADMIN_BASE.'/pension/office_order_add'] = "agadmin/pension/office_order_add";
$route[ADMIN_BASE.'/pension/office_order_edit/(:any)'] = "agadmin/pension/office_order_edit/$1";
$route[ADMIN_BASE.'/pension/office_order_delete/(:any)'] = "agadmin/pension/office_order_delete/$1";
$route[ADMIN_BASE.'/pension/office_order/(:any)'] = "agadmin/pension/office_order/$1";

$route[ADMIN_BASE.'/pension/charge_master'] = "agadmin/pension/charge_master";
$route[ADMIN_BASE.'/pension/charge_master_add'] = "agadmin/pension/charge_master_add";
$route[ADMIN_BASE.'/pension/charge_master_edit/(:any)'] = "agadmin/pension/charge_master_edit/$1";
$route[ADMIN_BASE.'/pension/charge_master_delete/(:any)'] = "agadmin/pension/charge_master_delete/$1";


$route[ADMIN_BASE.'/pension/order_employee'] = "agadmin/pension/order_employee";
$route[ADMIN_BASE.'/pension/order_employee_delete/(:any)'] = "agadmin/pension/order_employee_delete/$1";
$route[ADMIN_BASE.'/pension/training'] = "agadmin/pension/training";

$route[ADMIN_BASE.'/pension/pension_payment'] = "agadmin/pension/pension_payment";
$route[ADMIN_BASE.'/pension/payment_records_download'] = "agadmin/pension/payment_records_download";

$route[ADMIN_BASE.'/pension/document_order'] = "agadmin/pension/document_order";
$route[ADMIN_BASE.'/pension/document_order_add'] = "agadmin/pension/document_order_add";
$route[ADMIN_BASE.'/pension/document_order_edit/(:any)'] = "agadmin/pension/document_order_add/$1";
$route[ADMIN_BASE.'/pension/document_order_delete/(:any)'] = "agadmin/pension/document_order_delete/$1";

$route[ADMIN_BASE.'/pension/feedback'] = "agadmin/pension/feedback";
$route[ADMIN_BASE.'/pension/feedback_action/(:any)'] = "agadmin/pension/feedback_action/$1";
$route[ADMIN_BASE.'/pension/feedback_download'] = "agadmin/pension/feedback_download";
$route[ADMIN_BASE.'/pension/feedback_download_pdf/(:any)'] = "agadmin/pension/feedback_download_pdf/$1";
$route[ADMIN_BASE.'/pension/epabx_list'] = "agadmin/pension/epabx_list";
$route[ADMIN_BASE.'/pension/epabx_list_edit/(:any)'] = "agadmin/pension/epabx_list_edit/$1";

$route[ADMIN_BASE.'/gpf/part_1'] = "agadmin/gpf/part_1";
$route[ADMIN_BASE.'/gpf/part_1_upload'] = "agadmin/gpf/part_1_upload";
$route[ADMIN_BASE.'/gpf/part_1_ajax_upload'] = "agadmin/gpf/part_1_ajax_upload";

$route[ADMIN_BASE.'/gpf/part_1_temp'] = "agadmin/gpf/part_1_temp";
$route[ADMIN_BASE.'/gpf/part_1_upload_temp'] = "agadmin/gpf/part_1_upload_temp";
$route[ADMIN_BASE.'/gpf/part_1_ajax_upload_temp'] = "agadmin/gpf/part_1_ajax_upload_temp";

$route[ADMIN_BASE.'/gpf/part_2'] = "agadmin/gpf/part_2";
$route[ADMIN_BASE.'/gpf/part_2_upload'] = "agadmin/gpf/part_2_upload";
$route[ADMIN_BASE.'/gpf/part_2_ajax_upload'] = "agadmin/gpf/part_2_ajax_upload";

$route[ADMIN_BASE.'/gpf/part_2_temp'] = "agadmin/gpf/part_2_temp";
$route[ADMIN_BASE.'/gpf/part_2_upload_temp'] = "agadmin/gpf/part_2_upload_temp";
$route[ADMIN_BASE.'/gpf/part_2_ajax_upload_temp'] = "agadmin/gpf/part_2_ajax_upload_temp";
$route[ADMIN_BASE.'/gpf/part_2_temp_delete/(:any)'] = "agadmin/gpf/part_2_temp_delete/$1";

$route[ADMIN_BASE.'/gpf/part_3'] = "agadmin/gpf/part_3";
$route[ADMIN_BASE.'/gpf/part_3_upload'] = "agadmin/gpf/part_3_upload";
$route[ADMIN_BASE.'/gpf/part_3_ajax_upload'] = "agadmin/gpf/part_3_ajax_upload";

$route[ADMIN_BASE.'/gpf/part_3_temp'] = "agadmin/gpf/part_3_temp";
$route[ADMIN_BASE.'/gpf/part_3_upload_temp'] = "agadmin/gpf/part_3_upload_temp";
$route[ADMIN_BASE.'/gpf/part_3_ajax_upload_temp'] = "agadmin/gpf/part_3_ajax_upload_temp";

$route[ADMIN_BASE.'/gpf/part_4'] = "agadmin/gpf/part_4";
$route[ADMIN_BASE.'/gpf/part_4_upload'] = "agadmin/gpf/part_4_upload";
$route[ADMIN_BASE.'/gpf/part_4_ajax_upload'] = "agadmin/gpf/part_4_ajax_upload";

$route[ADMIN_BASE.'/gpf/part_4_temp'] = "agadmin/gpf/part_4_temp";
$route[ADMIN_BASE.'/gpf/part_4_upload_temp'] = "agadmin/gpf/part_4_upload_temp";
$route[ADMIN_BASE.'/gpf/part_4_ajax_upload_temp'] = "agadmin/gpf/part_4_ajax_upload_temp";

$route[ADMIN_BASE.'/gpf/part_5'] = "agadmin/gpf/part_5";
$route[ADMIN_BASE.'/gpf/part_5_upload'] = "agadmin/gpf/part_5_upload";
$route[ADMIN_BASE.'/gpf/part_5_ajax_upload'] = "agadmin/gpf/part_5_ajax_upload";

$route[ADMIN_BASE.'/gpf/part_5_temp'] = "agadmin/gpf/part_5_temp";
$route[ADMIN_BASE.'/gpf/part_5_upload_temp'] = "agadmin/gpf/part_5_upload_temp";
$route[ADMIN_BASE.'/gpf/part_5_ajax_upload_temp'] = "agadmin/gpf/part_5_ajax_upload_temp";

$route[ADMIN_BASE.'/gpf/tax_nontax'] = "agadmin/gpf/tax_nontax";
$route[ADMIN_BASE.'/gpf/tax_nontax_upload'] = "agadmin/gpf/tax_nontax_upload";
$route[ADMIN_BASE.'/gpf/tax_nontax_ajax_upload'] = "agadmin/gpf/tax_nontax_ajax_upload";

$route[ADMIN_BASE.'/gpf/subscriber'] = "agadmin/gpf/subscriber";
$route[ADMIN_BASE.'/gpf/subscriber_edit/(:any)/(:any)'] = "agadmin/gpf/subscriber_edit/$1/$2";
$route[ADMIN_BASE.'/gpf/subscriber_upload'] = "agadmin/gpf/subscriber_upload";
$route[ADMIN_BASE.'/gpf/subscriber_ajax_upload'] = "agadmin/gpf/subscriber_ajax_upload";
$route[ADMIN_BASE.'/gpf/subscribers_profile_download'] = "agadmin/gpf/subscribers_profile_download";
$route[ADMIN_BASE.'/gpf/gpf_preview'] = "agadmin/gpf/gpf_preview";
$route[ADMIN_BASE.'/gpf/view_ac_slip'] = "agadmin/gpf/view_ac_slip";
$route[ADMIN_BASE.'/gpf/view_fpa_pdf'] = "agadmin/gpf/view_fpa_pdf";
$route[ADMIN_BASE.'/gpf/subscriber_active/(:any)'] = "agadmin/gpf/subscriber_active/$1";
$route[ADMIN_BASE.'/gpf/subscriber_deactive/(:any)'] = "agadmin/gpf/subscriber_deactive/$1";


$route[ADMIN_BASE.'/gpf/ledger'] = "agadmin/gpf/ledger";
$route[ADMIN_BASE.'/gpf/ledger_upload'] = "agadmin/gpf/ledger_upload";
$route[ADMIN_BASE.'/gpf/ledger_ajax_upload'] = "agadmin/gpf/ledger_ajax_upload";

$route[ADMIN_BASE.'/gpf/case_status'] = "agadmin/gpf/case_status";
$route[ADMIN_BASE.'/gpf/case_status_upload'] = "agadmin/gpf/case_status_upload";
$route[ADMIN_BASE.'/gpf/case_status_ajax_upload'] = "agadmin/gpf/case_status_ajax_upload";

$route[ADMIN_BASE.'/gpf/mjh_head'] = "agadmin/gpf/mjh_head";
$route[ADMIN_BASE.'/gpf/mjh_head_edit/(:any)'] = "agadmin/gpf/mjh_head_edit/$1";
$route[ADMIN_BASE.'/gpf/mjh_head_upload'] = "agadmin/gpf/mjh_head_upload";
$route[ADMIN_BASE.'/gpf/mjh_head_ajax_upload'] = "agadmin/gpf/mjh_head_ajax_upload";

$route[ADMIN_BASE.'/gpf/rate_of_interest'] = "agadmin/gpf/rate_of_interest";
$route[ADMIN_BASE.'/gpf/rate_of_interest_ajax_upload'] = "agadmin/gpf/rate_of_interest_ajax_upload";

$route[ADMIN_BASE.'/gpf/fp_authority'] = "agadmin/gpf/fp_authority";
$route[ADMIN_BASE.'/gpf/fp_authority_edit/(:any)'] = "agadmin/gpf/fp_authority_edit/$1";
$route[ADMIN_BASE.'/gpf/fp_authority_upload'] = "agadmin/gpf/fp_authority_upload";
$route[ADMIN_BASE.'/gpf/fp_authority_ajax_upload'] = "agadmin/gpf/fp_authority_ajax_upload";
$route[ADMIN_BASE.'/gpf/fp_authority_details/(:any)'] = "agadmin/gpf/fp_authority_details/$1";

$route[ADMIN_BASE.'/gpf/missingcr'] = "agadmin/gpf/missingcr";
$route[ADMIN_BASE.'/gpf/missingcr_edit/(:any)'] = "agadmin/gpf/missingcr_edit/$1";
$route[ADMIN_BASE.'/gpf/missingcr_delete/(:any)'] = "agadmin/gpf/missingcr_delete/$1";
$route[ADMIN_BASE.'/gpf/missingcr_upload'] = "agadmin/gpf/missingcr_upload";
$route[ADMIN_BASE.'/gpf/missingcr_ajax_upload'] = "agadmin/gpf/missingcr_ajax_upload";
$route[ADMIN_BASE.'/gpf/missingcr_details/(:any)'] = "agadmin/gpf/missingcr_details/$1";

$route[ADMIN_BASE.'/gpf/missingcract_all'] = "agadmin/gpf/missingcract_all";
$route[ADMIN_BASE.'/gpf/missingcract/(:any)'] = "agadmin/gpf/missingcract/$1";

$route[ADMIN_BASE.'/gpf/missingcract'] = "agadmin/gpf/missingcract";
$route[ADMIN_BASE.'/gpf/missingcract_edit/(:any)'] = "agadmin/gpf/missingcract_edit/$1";
$route[ADMIN_BASE.'/gpf/missingcract_upload'] = "agadmin/gpf/missingcract_upload";
$route[ADMIN_BASE.'/gpf/missingcract_ajax_upload'] = "agadmin/gpf/missingcract_ajax_upload";
$route[ADMIN_BASE.'/gpf/missingcract_details/(:any)'] = "agadmin/gpf/missingcract_details/$1";
$route[ADMIN_BASE.'/gpf/missing_reports_download'] = "agadmin/gpf/missing_reports_download";

$route[ADMIN_BASE.'/gpf/section_transfer_new'] = "agadmin/gpf/section_transfer_new";
$route[ADMIN_BASE.'/gpf/section_transfer'] = "agadmin/gpf/section_transfer";
$route[ADMIN_BASE.'/gpf/section_transfer_assignment/(:any)'] = "agadmin/gpf/section_transfer_assignment/$1";
$route[ADMIN_BASE.'/gpf/section_transfer_record'] = "agadmin/gpf/section_transfer_record";
$route[ADMIN_BASE.'/gpf/section_transfer_record_edit/(:any)'] = "agadmin/gpf/section_transfer_record_edit/$1";
$route[ADMIN_BASE.'/gpf/all_employees_transfer'] = "agadmin/gpf/all_employees_transfer";
$route[ADMIN_BASE.'/gpf/transfer_order_download'] = "agadmin/gpf/transfer_order_download";
$route[ADMIN_BASE.'/gpf/section_allotment'] = "agadmin/gpf/section_allotment";
$route[ADMIN_BASE.'/gpf/section_allotment_edit/(:any)'] = "agadmin/gpf/section_allotment_edit/$1";

$route[ADMIN_BASE.'/gpf/circular_office_order'] = "agadmin/gpf/circular_office_order";
$route[ADMIN_BASE.'/gpf/circular_office_order_add'] = "agadmin/gpf/circular_office_order_add";
$route[ADMIN_BASE.'/gpf/circular_office_order_edit/(:any)'] = "agadmin/gpf/circular_office_order_add/$1";
$route[ADMIN_BASE.'/gpf/circular_office_order_delete/(:any)'] = "agadmin/gpf/circular_office_order_delete/$1";
$route[ADMIN_BASE.'/gpf/circular_office_order_upload'] = "agadmin/gpf/circular_office_order_upload";
$route[ADMIN_BASE.'/gpf/circular_office_order_ajax_upload'] = "agadmin/gpf/circular_office_order_ajax_upload";

$route[ADMIN_BASE.'/gpf/office_order'] = "agadmin/gpf/office_order";
$route[ADMIN_BASE.'/gpf/office_order_add'] = "agadmin/gpf/office_order_add";
$route[ADMIN_BASE.'/gpf/office_order_edit/(:any)'] = "agadmin/gpf/office_order_edit/$1";
$route[ADMIN_BASE.'/gpf/office_order_delete/(:any)'] = "agadmin/gpf/office_order_delete/$1";
$route[ADMIN_BASE.'/gpf/office_order/(:any)'] = "agadmin/gpf/office_order/$1";

$route[ADMIN_BASE.'/gpf/order_employee'] = "agadmin/gpf/order_employee";
$route[ADMIN_BASE.'/gpf/order_employee_delete/(:any)'] = "agadmin/gpf/order_employee_delete/$1";

$route[ADMIN_BASE.'/gpf/training'] = "agadmin/gpf/training";
$route[ADMIN_BASE.'/gpf/document_order'] = "agadmin/gpf/document_order";
$route[ADMIN_BASE.'/gpf/document_order_add'] = "agadmin/gpf/document_order_add";
$route[ADMIN_BASE.'/gpf/document_order_edit/(:any)'] = "agadmin/gpf/document_order_add/$1";
$route[ADMIN_BASE.'/gpf/document_order_delete/(:any)'] = "agadmin/gpf/document_order_delete/$1";

$route[ADMIN_BASE.'/gpf/ddo_document'] = "agadmin/gpf/ddo_document";
$route[ADMIN_BASE.'/gpf/ddo_document_edit/(:any)'] = "agadmin/gpf/ddo_document_edit/$1";
$route[ADMIN_BASE.'/gpf/ddo_document_delete/(:any)'] = "agadmin/gpf/ddo_document_delete/$1";

$route[ADMIN_BASE.'/gpf/feedback'] = "agadmin/gpf/feedback";
$route[ADMIN_BASE.'/gpf/feedback_action/(:any)'] = "agadmin/gpf/feedback_action/$1";
$route[ADMIN_BASE.'/gpf/feedback_download'] = "agadmin/gpf/feedback_download";
$route[ADMIN_BASE.'/gpf/feedback_download_pdf/(:any)'] = "agadmin/gpf/feedback_download_pdf/$1";
$route[ADMIN_BASE.'/gpf/epabx_list'] = "agadmin/gpf/epabx_list";
$route[ADMIN_BASE.'/gpf/epabx_list_edit/(:any)'] = "agadmin/gpf/epabx_list_edit/$1";

$route[ADMIN_BASE.'/gpf/charge_master'] = "agadmin/gpf/charge_master";
$route[ADMIN_BASE.'/gpf/charge_master_add'] = "agadmin/gpf/charge_master_add";
$route[ADMIN_BASE.'/gpf/charge_master_edit/(:any)'] = "agadmin/gpf/charge_master_edit/$1";
$route[ADMIN_BASE.'/gpf/charge_master_delete/(:any)'] = "agadmin/gpf/charge_master_delete/$1";

$route[ADMIN_BASE.'/gpf/signature_master_new'] = "agadmin/gpf/signature_master_new";
$route[ADMIN_BASE.'/gpf/signature_master'] = "agadmin/gpf/signature_master";
$route[ADMIN_BASE.'/gpf/signature_master_edit/(:any)'] = "agadmin/gpf/signature_master_edit/$1";
$route[ADMIN_BASE.'/gpf/signature_master_delete/(:any)'] = "agadmin/gpf/signature_master_delete/$1";

$route[ADMIN_BASE.'/faq'] = "agadmin/faq/index";
$route[ADMIN_BASE.'/faq/add'] = "agadmin/faq/add";
$route[ADMIN_BASE.'/faq/edit/(:any)'] = "agadmin/faq/add/$1";
$route[ADMIN_BASE.'/faq/delete/(:any)'] = "agadmin/faq/delete/$1";

$route[ADMIN_BASE.'/faq/aggssa'] = "agadmin/faq/aggssa";
$route[ADMIN_BASE.'/faq/aggssa_add'] = "agadmin/faq/aggssa_add";
$route[ADMIN_BASE.'/faq/aggssa_edit/(:any)'] = "agadmin/faq/aggssa_add/$1";
$route[ADMIN_BASE.'/faq/aggssa_delete/(:any)'] = "agadmin/faq/aggssa_delete/$1";

$route[ADMIN_BASE.'/faq/agersa'] = "agadmin/faq/agersa";
$route[ADMIN_BASE.'/faq/agersa_add'] = "agadmin/faq/agersa_add";
$route[ADMIN_BASE.'/faq/agersa_edit/(:any)'] = "agadmin/faq/agersa_add/$1";
$route[ADMIN_BASE.'/faq/agersa_delete/(:any)'] = "agadmin/faq/agersa_delete/$1";

$route[ADMIN_BASE.'/whats_new'] = "agadmin/whats_new/index";
$route[ADMIN_BASE.'/whats_new/add'] = "agadmin/whats_new/add";
$route[ADMIN_BASE.'/whats_new/edit/(:any)'] = "agadmin/whats_new/add/$1";
$route[ADMIN_BASE.'/whats_new/delete/(:any)'] = "agadmin/whats_new/delete/$1";

$route[ADMIN_BASE.'/whats_new/aggssa'] = "agadmin/whats_new/aggssa";
$route[ADMIN_BASE.'/whats_new/aggssa_add'] = "agadmin/whats_new/aggssa_add";
$route[ADMIN_BASE.'/whats_new/aggssa_edit/(:any)'] = "agadmin/whats_new/aggssa_add/$1";
$route[ADMIN_BASE.'/whats_new/aggssa_delete/(:any)'] = "agadmin/whats_new/aggssa_delete/$1";

$route[ADMIN_BASE.'/whats_new/agersa'] = "agadmin/whats_new/agersa";
$route[ADMIN_BASE.'/whats_new/agersa_add'] = "agadmin/whats_new/agersa_add";
$route[ADMIN_BASE.'/whats_new/agersa_edit/(:any)'] = "agadmin/whats_new/agersa_add/$1";
$route[ADMIN_BASE.'/whats_new/agersa_delete/(:any)'] = "agadmin/whats_new/agersa_delete/$1";

$route[ADMIN_BASE.'/feedback'] = "agadmin/feedback/index";
$route[ADMIN_BASE.'/feedback/update/(:any)'] = "agadmin/feedback/update/$1";
$route[ADMIN_BASE.'/feedback/admin_feedback_close/(:any)'] = "agadmin/feedback/admin_feedback_close/$1";
$route[ADMIN_BASE.'/feedback/delete/(:any)'] = "agadmin/feedback/delete/$1";
$route[ADMIN_BASE.'/feedback/aggssa'] = "agadmin/feedback/aggssa";
$route[ADMIN_BASE.'/feedback/aggssa_delete/(:any)'] = "agadmin/feedback/aggssa_delete/$1";
$route[ADMIN_BASE.'/feedback/agersa'] = "agadmin/feedback/agersa";
$route[ADMIN_BASE.'/feedback_active'] = "agadmin/feedback/feedback_active";

$route[ADMIN_BASE.'/feedback/agersa_delete/(:any)'] = "agadmin/feedback/agersa_delete/$1";

$route[ADMIN_BASE.'/gallery'] = "agadmin/gallery";
$route[ADMIN_BASE.'/gallery/add'] = "agadmin/gallery/add";
$route[ADMIN_BASE.'/gallery/edit/(:any)'] = "agadmin/gallery/add/$1";
$route[ADMIN_BASE.'/gallery/delete/(:any)'] = "agadmin/gallery/delete/$1";

$route[ADMIN_BASE.'/gallery/aggssa'] = "agadmin/gallery/aggssa";
$route[ADMIN_BASE.'/gallery/aggssa_add'] = "agadmin/gallery/aggssa_add";
$route[ADMIN_BASE.'/gallery/aggssa_edit/(:any)'] = "agadmin/gallery/aggssa_add/$1";
$route[ADMIN_BASE.'/gallery/aggssa_delete/(:any)'] = "agadmin/gallery/aggssa_delete/$1";

$route[ADMIN_BASE.'/gallery/agersa'] = "agadmin/gallery/agersa";
$route[ADMIN_BASE.'/gallery/agersa_add'] = "agadmin/gallery/agersa_add";
$route[ADMIN_BASE.'/gallery/agersa_edit/(:any)'] = "agadmin/gallery/agersa_add/$1";
$route[ADMIN_BASE.'/gallery/agersa_delete/(:any)'] = "agadmin/gallery/agersa_delete/$1";

$route[ADMIN_BASE.'/video'] = "agadmin/video";
$route[ADMIN_BASE.'/video/add'] = "agadmin/video/add";
$route[ADMIN_BASE.'/video/delete/(:any)'] = "agadmin/video/delete/$1";

$route[ADMIN_BASE.'/video/aggssa'] = "agadmin/video/aggssa";
$route[ADMIN_BASE.'/video/aggssa_add'] = "agadmin/video/aggssa_add";
$route[ADMIN_BASE.'/video/aggssa_delete/(:any)'] = "agadmin/video/aggssa_delete/$1";

$route[ADMIN_BASE.'/video/agersa'] = "agadmin/video/agersa";
$route[ADMIN_BASE.'/video/agersa_add'] = "agadmin/video/agersa_add";
$route[ADMIN_BASE.'/video/agersa_delete/(:any)'] = "agadmin/video/agersa_delete/$1";

$route[ADMIN_BASE.'/contact'] = "agadmin/contact";

$route[ADMIN_BASE.'/grievances'] = "agadmin/grievances";

$route[ADMIN_BASE.'/logout'] = "agadmin/adminlogin/logout";
/************************
	End Back End
************************/


$route['translate_uri_dashes'] = FALSE;