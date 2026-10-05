<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_ii extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('common_model');
		$this->load->model('wing_model');
		$this->load->library('form_validation');
		$this->load->helper('admin_helper');
		$this->admin = '';
		if($this->session->userdata('admin_details')){
			$this->admin = $this->session->userdata('admin_details');
		}else{
			redirect('admin');
		}
		$this->admin_type = strtolower($this->admin['admin_type_name']);
		if($this->admin_type == 'admin_ii' || $this->admin_type == 'superadmin'){
			
		}else{
			show_404();
		}
	}
	public function index(){
		$data['results'] = array();
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_ii',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function document_order(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->wing_model->get_office_order($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/admin_ii/document_order';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_ii/document_order',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	
	public function document_order_add(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['employees'] = $this->emp_model->get_all_employee_list();
		$data['designation'] = array();
		foreach($data['employees'] as $val){
			if(!in_array($val['desig'],$data['designation'])){
				$data['designation'][] = $val['desig'];
			}			
		}
		$id = $this->uri->segment(4);
		$data['row'] = array();
		$data['asign_emp'] = array();
		if(!empty($id)){
			$data['row'] = $this->wing_model->getOfficeOrderByID($id);
			$data['asign_emp'] = $this->wing_model->getOfficeOrderToEmployees($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$error = '';
		if($this->input->post()){
			$this->form_validation->set_rules('title', 'Title', 'required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				$update = array(
							'wing'		=> $this->input->post('wing',true),
							'title'		=> $this->input->post('title',true),
							'details'	=> $this->input->post('details'),
							'order_dt'	=> date('Y-m-d',strtotime($this->input->post('order_dt'))),
							'update_dt'	=> date('Y-m-d H:i:s')
						);
				if(isset($_FILES['attachment']) && $_FILES['attachment']['size'][0] > 0){
					//upload file
					$upload_details = $this->common_model->upload_multiple_order_cicular('attachment');
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
						redirect(ADMIN_BASE_URL.'admin_ii/document_order');
					}else{
						$update['attachment'] = implode(';',$upload_details['filenames']);
					}
				}
				$emp_concerned =  $this->input->post('emp_concerned');
				if($error == ''){
					if(!empty($id)){ // edit
						$result = $this->wing_model->updateOfficeOrder($id,$update);
						$this->wing_model->update_office_order_to_employee($id,$emp_concerned);
						$this->session->set_flashdata('success','Successfully updated.');
					}else{ // add
//						$update['order_dt'] = date('Y-m-d H:i:s');
//      				$update['order_dt'] = date('Y-m-d',strtotime($this->input->post('order_dt')));
						$id = $this->wing_model->addOfficeOrder($update);					
						$this->wing_model->add_office_order_to_employee($id,$emp_concerned);
						$this->session->set_flashdata('success','Successfully added.');
					}
					redirect(ADMIN_BASE_URL.'admin_ii/document_order');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_ii/document_order_add',$data);
		$this->load->view('agadmin/layout/footer');
	}

	public function document_order_delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->wing_model->getOfficeOrderByID($id);
			if(!empty($data['row'])){
				$this->wing_model->deleteOfficeOrderByID($id);
				$this->session->set_flashdata('success','Successfully deleted.');
			}
		}
		redirect(ADMIN_BASE_URL.'admin_ii/document_order');
	}

	public function office_order(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->wing_model->get_office_order($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/admin_ii/office_order';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_ii/office_order',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function office_order_add(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['employees'] = $this->emp_model->get_all_employee_list();
		$data['designation'] = array();
		foreach($data['employees'] as $val){
			if(!in_array($val['desig'],$data['designation'])){
				$data['designation'][] = $val['desig'];
			}			
		}
		$id = $this->uri->segment(4);
		$data['row'] = array();
		$data['asign_emp'] = array();
		if(!empty($id)){
			$data['row'] = $this->wing_model->getOfficeOrderByID($id);
			$data['asign_emp'] = $this->wing_model->getOfficeOrderToEmployees($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$error = '';
		if($this->input->post()){
			$this->form_validation->set_rules('title', 'Title', 'required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				$update = array(
							'wing'		=> $this->input->post('wing',true),
							'title'		=> $this->input->post('title',true),
							'details'	=> $this->input->post('details'),
							'order_dt'	=> date('Y-m-d',strtotime($this->input->post('order_dt'))),
							'update_dt'	=> date('Y-m-d H:i:s')
						);
				if(isset($_FILES['attachment']) && $_FILES['attachment']['size'][0] > 0){
					//upload file
					$upload_details = $this->common_model->upload_multiple_order_cicular('attachment');
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
						redirect(ADMIN_BASE_URL.'admin_ii/office_order');
					}else{
						$update['attachment'] = implode(';',$upload_details['filenames']);
					}
				}
				$emp_concerned =  $this->input->post('emp_concerned');
				if($error == ''){
					if(!empty($id)){ // edit
						$result = $this->wing_model->updateOfficeOrder($id,$update);
						$this->wing_model->update_office_order_to_employee($id,$emp_concerned);
						$this->session->set_flashdata('success','Successfully updated.');
					}else{ // add
//						$update['order_dt'] = date('Y-m-d H:i:s');
//      				$update['order_dt'] = date('Y-m-d',strtotime($this->input->post('order_dt')));
						$id = $this->wing_model->addOfficeOrder($update);					
						$this->wing_model->add_office_order_to_employee($id,$emp_concerned);
						$this->session->set_flashdata('success','Successfully added.');
					}
					redirect(ADMIN_BASE_URL.'admin_ii/office_order');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_ii/office_order_add',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function office_order_edit(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['employees'] = $this->emp_model->get_all_employee_list();
		$data['designation'] = array();
		foreach($data['employees'] as $val){
			if(!in_array($val['desig'],$data['designation'])){
				$data['designation'][] = $val['desig'];
			}			
		}
		$id = $this->uri->segment(4);
		$data['row'] = array();
		$data['asign_emp'] = array();
		if(!empty($id)){
			$data['row'] = $this->wing_model->getOfficeOrderByID($id);
			$data['asign_emp'] = $this->wing_model->getOfficeOrderToEmployees($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$error = '';
		if($this->input->post()){
			$this->form_validation->set_rules('wing', 'wing', 'required');
			$this->form_validation->set_rules('title', 'Title', 'required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				$update = array(
							'wing'		=> $this->input->post('wing',true),
							'title'		=> $this->input->post('title',true),
							'details'	=> $this->input->post('details'),
							'attachment'	=> $this->input->post('attachment'),
							'order_dt'	=> date('Y-m-d',strtotime($this->input->post('order_dt'))),
							'update_dt'	=> date('Y-m-d H:i:s')
						);
				if(isset($_FILES['attachment']) && $_FILES['attachment']['size'][0] > 0){
					//upload file
					//$upload_details = $this->common_model->upload_multiple_file('attachment');
					$upload_details = $this->common_model->upload_multiple_order_cicular('attachment');
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
						redirect(ADMIN_BASE_URL.'admin_ii/office_order');
					}else{
						$update['attachment'] = implode(';',$upload_details['filenames']);
					}
				}
				$emp_concerned =  $this->input->post('emp_concerned');
				$title_circular =  $this->input->post('title_circular');
				
				if($error == ''){
					if(!empty($id)){ // if record exist
						if($title_circular !=='All Circular'){// edit
							$result = $this->wing_model->updateOfficeOrder($id,$update);
							$this->wing_model->update_office_order_to_employee($id,$emp_concerned);
							$this->session->set_flashdata('success','Successfully updated and SMS sent.');
						}else{ // exist but add a new record
	//						$update['order_dt'] = date('Y-m-d H:i:s');
	//      				$update['order_dt'] = date('Y-m-d',strtotime($this->input->post('order_dt')));
							$id = $this->wing_model->addOfficeOrder($update);					
							$this->wing_model->add_office_order_to_employee($id,$emp_concerned);
							$this->session->set_flashdata('success','Successfully added and SMS sent.');
						}
					}else{ // if not exist, add record
						$id = $this->wing_model->addOfficeOrder($update);					
						$this->wing_model->add_office_order_to_employee($id,$emp_concerned);
						$this->session->set_flashdata('success','Successfully added and SMS sent.');
					}
					redirect(ADMIN_BASE_URL.'admin_ii/office_order');
				}
				
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_ii/office_order_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function office_order_delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->wing_model->getOfficeOrderByID($id);
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->wing_model->deleteOfficeOrderByID($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'pao/office_order');
	}
	public function form_sixteen(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_all_form_sixteen($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/admin_ii/form_sixteen';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_ii/form_sixteen',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function form_sixteen_add(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['employees'] = $this->emp_model->get_all_employee_empids();
		$data['designation'] = array();
		foreach($data['employees'] as $val){
			if(!in_array($val['desig'],$data['designation'])){
				$data['designation'][] = $val['desig'];
			}			
		}
		$id = $this->uri->segment(4);
		$data['row'] = array();
		$data['asign_emp'] = array();
		if(!empty($id)){
			$data['row'] = $this->wing_model->getOfficeOrderByID($id);
			$data['asign_emp'] = $this->wing_model->getOfficeOrderToEmployees($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$error = '';
		if($this->input->post()){
			
			$emp_concerned =  $this->input->post('emp_concerned');
				foreach($emp_concerned as $empid=>$mobile){
					$update['ord_empid']=$empid;
			}
			
			$this->form_validation->set_rules('title', 'Title', 'required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				$update = array(
							'ord_empid' => $ord_empid,
							'wing'		=> $this->input->post('wing',true),
							'title'		=> $this->input->post('title',true),
							'details'	=> $this->input->post('details'),
							'order_dt'	=> date('Y-m-d',strtotime($this->input->post('order_dt'))),
							'ord_year'	=> $this->input->post('ord_year'),
							'update_dt'	=> date('Y-m-d H:i:s')
						);
				if(isset($_FILES['attachment']) && $_FILES['attachment']['size'][0] > 0){
					//upload file
					$upload_details = $this->common_model->upload_multiple_form_sixteen('attachment');
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
						redirect(ADMIN_BASE_URL.'admin_ii/form_sixteen');
					}else{
						$update['attachment'] = implode(';',$upload_details['filenames']);
					}
				}
							
				if($error == ''){
					if(!empty($id)){ // edit
						$result = $this->wing_model->updateOfficeOrder($id,$update);
						$this->wing_model->update_office_order_to_employee($id,$emp_concerned);
						$this->session->set_flashdata('success','Successfully updated.');
					}else{ // add
//						$update['order_dt'] = date('Y-m-d H:i:s');
//      				$update['order_dt'] = date('Y-m-d',strtotime($this->input->post('order_dt')));
						$id = $this->wing_model->addOfficeOrder($update);					
						$this->wing_model->add_office_order_to_employee($id,$emp_concerned);
						$this->session->set_flashdata('success','Successfully added.');
					}
					redirect(ADMIN_BASE_URL.'admin_ii/form_sixteen');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_ii/form_sixteen_add',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function form_sixteen_delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->wing_model->getOfficeOrderByID($id);
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->wing_model->deleteOfficeOrderByID($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'admin_ii/form_sixteen');
	}
	
//--------------employee bills

public function bills(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_employee_bills($page_no);
		$data['results'] = $response['results'];
		$data['bill_types'] = $this->emp_model->get_all_bill_types();
		$config['base_url'] = base_url().'/admin/admin_ii/bills';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_ii/bills',$data);
		$this->load->view('agadmin/layout/footer');
	}

	public function bills_edit(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->bill_details($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
		if($this->input->post()){
			$this->emp_model->update_bill_details($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'admin_ii/bills');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_ii/bills_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}	
		
	public function bills_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_ii/bills_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function bills_ajax_upload(){
		$data['results'] = array();
		if(isset($_FILES)){
			$path = 'excel';
			$file_name = '';
			$res = $this->common_model->upload_file('file',"*",$path);
			
			if($res['is_success']){
				$file_name = $path.'/'.$res['filename'];
			}else{
				@unlink($file_name);
				$error_msg = $res['message'];
				echo json_encode($res);
				exit();
			}
			$this->load->library('spreadsheet');
			$res = $this->spreadsheet->read_file($file_name);
			if(isset($res['values']) && empty($res['values'])){
				// empty file
				$response = array(
						'is_success'	=> false,
						'message'		=> 'The file is empty'
					);
				@unlink($file_name);
				echo json_encode($response);
				exit();
			}
			$headers = array();
			$upload = array();
			
			$header_security_field =  array('EMPID','NAME','DESIG','EMP_SECTION','GROUP_NM','OFFICE_NM','BASIC_PAY','BILL_TYPE','DESCRIPTION','BILL_NO','BILL_DATE','BILL_AMOUNT','ADVANCE_BILL_NO','FROM_DATE','TO_DATE','BLOCK','CHILD_NO','CHILD_SELECT','LOCATION','TREATMENT_TYPE','DOCTOR','FIT_UNFIT','AMOUNT_PAID','PAYMENT_DATE','STATUS');

			foreach($res['header'] as $key => $val){
				if(trim($val) != ''){ // remove empty cell 
					$val = strtoupper($val);
					if(in_array($val,$header_security_field)){
						$headers[$key]	= strtolower($val);
						if (($k = array_search($val, $header_security_field)) !== false) {
							unset($header_security_field[$k]);
						}
					}
				}
			}
			if(!empty($header_security_field)){
				$response = array(
							'is_success'	=> false,
							'message'		=> 'The file has extra field.'
						);
						@unlink($file_name);
						echo json_encode($response);
						exit();
			}
			$i = 0;
			
			foreach($res['values'] as $row => $columns){
				$up_arr = array_fill_keys($headers,"");
				foreach($columns as $key=>$val){
					if(isset($headers[$key])){ // remove empty cell 
						$up_arr[$headers[$key]]	= $val;
					}
				}
				$upload[] = $up_arr;				
			}
				//			$bulk_elem = 10;
				//			$bulk_upload = array();
				//			if( count($upload) > $bulk_elem ){
				//				$bulk_upload = array_chunk($upload,$bulk_elem);
				//				foreach($bulk_upload as $bulk){
				//					$this->db->insert_batch('employee_bills',$bulk);
				//				}
				//			}else{
				//				$this->db->insert_batch('employee_bills',$upload);
				//			}
			foreach($upload as $record){
				$empid = isset($record['empid']) ? $record['empid'] : 0;
				$bill_no = isset($record['bill_no']) ? $record['bill_no'] : 0;
				$bill_date = isset($record['bill_date']) ? $record['bill_date'] : 0;
				// check records exists
				$res = $this->db->get_where('employee_bills',array('empid'=>$empid,'bill_no'=>$bill_no,'bill_date'=>$bill_date));
				if($res->num_rows() > 0){
					$this->db->where('empid',$empid)->where('bill_no',$bill_no)->where('bill_date',$bill_date)->update('employee_bills',$record);
				}else{
					
					$this->db->insert('employee_bills',$record);
				}
				
			}
			$db_error = $this->db->error();
			if(!empty($db_error) && $db_error['code'] != 0 && trim($db_error['message']) != ''){
				$message = $db_error['code'].' '.$db_error['message'];
				$is_success = false;
				@unlink($file_name);
			}else{
				$message = 'Successfully updated.';
				$is_success = true;
				@unlink($file_name);
			}
		}else{
			$message = 'No file selected.';
			$is_success = false;
		}
		$response = array(
						'is_success'	=> $is_success,
						'message'		=> $message
					);
		echo json_encode($response);
		exit();
	}
	public function all_employees_bills(){
		$this->load->model('emp_model');
		$headings = array();
		$firstrow = array();
		$all_application = $this->emp_model->all_employees_bills('AGAE');
		if(!empty($all_application)){
			unset($all_application[0]['appl_id']);
			foreach( $all_application[0] as $k => $v ) {
					$headings[] = strtoupper($k);
					$firstrow[] = $v;
			}
			unset($all_application[0]);
		}
		$excel_data[] = $headings;
		$excel_data[1] = $firstrow;
		foreach( $all_application as $row ) {
			unset($row['appl_id']);
			$row['applied_on'] = date('d-m-Y h:i:s A',strtotime($row['applied_on']));
			$excel_data[] = $row;
		}
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Application of employees');
		$this->excel->getActiveSheet()->fromArray($excel_data);
		 
		$filename='application_'.time().'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}


//------------loan		
	public function loan(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->employee_loan($page_no);
		$data['results'] = $response['results'];
		$data['loan_types'] = $this->emp_model->get_all_loan_types();
		$config['base_url'] = base_url().'/admin/admin_ii/loan';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_ii/loan',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function all_employees_loans(){
		$this->load->model('emp_model');
		$headings = array();
		$firstrow = array();
		$all_application = $this->emp_model->all_employees_loans('AGAE');
		if(!empty($all_application)){
			unset($all_application[0]['appl_id']);
			foreach( $all_application[0] as $k => $v ) {
					$headings[] = strtoupper($k);
					$firstrow[] = $v;
			}
			unset($all_application[0]);
		}
		$excel_data[] = $headings;
		$excel_data[1] = $firstrow;
		foreach( $all_application as $row ) {
			unset($row['appl_id']);
			$row['applied_on'] = date('d-m-Y h:i:s A',strtotime($row['applied_on']));
			$excel_data[] = $row;
		}
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Application of employees');
		$this->excel->getActiveSheet()->fromArray($excel_data);
		 
		$filename='application_'.time().'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}

	public function loan_edit(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->loan_details($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
		if($this->input->post()){
			$this->emp_model->update_loan_details($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'admin_ii/loan');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_ii/loan_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}	

	public function loan_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_ii/loan_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function loan_ajax_upload(){
		$data['results'] = array();
		if(isset($_FILES)){
			$path = 'excel';
			$file_name = '';
			$res = $this->common_model->upload_file('file',"*",$path);
			
			if($res['is_success']){
				$file_name = $path.'/'.$res['filename'];
			}else{
				@unlink($file_name);
				$error_msg = $res['message'];
				echo json_encode($res);
				exit();
			}
			$this->load->library('spreadsheet');
			$res = $this->spreadsheet->read_file($file_name);
			if(isset($res['values']) && empty($res['values'])){
				// empty file
				$response = array(
						'is_success'	=> false,
						'message'		=> 'The file is empty'
					);
				@unlink($file_name);
				echo json_encode($response);
				exit();
			}
			$headers = array();
			$upload = array();
			
			$header_security_field =  array('EMPID','NAME','DESIG','EMP_SECTION','GROUP_NM','OFFICE_NM','BASIC_PAY','LOAN_TYPE','DESCRIPTION','INTEREST_TYPE','LOAN_AMOUNT','INSTALLMENT_NO','INTEREST','PAID_LOAN_AMOUNT','LOAN_ORDER_NO','ORDER_DATE','BILL_NO');
																			
			foreach($res['header'] as $key => $val){
				if(trim($val) != ''){ // remove empty cel 
					$val = strtoupper($val);
					if(in_array($val,$header_security_field)){
						$headers[$key]	= strtolower($val);
						if (($k = array_search($val, $header_security_field)) !== false) {
							unset($header_security_field[$k]);
						}
					}
				}
			}
			if(!empty($header_security_field)){
				$response = array(
							'is_success'	=> false,
							'message'		=> 'The file has extra field.'
						);
						@unlink($file_name);
						echo json_encode($response);
						exit();
			}
			$i = 0;
			
			foreach($res['values'] as $row => $columns){
				$up_arr = array_fill_keys($headers,"");
				foreach($columns as $key=>$val){
					if(isset($headers[$key])){ // remove empty cel 
						$up_arr[$headers[$key]]	= $val;
					}
				}
				$upload[] = $up_arr;				
			}
				//			$bulk_elem = 10;
				//			$bulk_upload = array();
				//			if( count($upload) > $bulk_elem ){
				//				$bulk_upload = array_chunk($upload,$bulk_elem);
				//				foreach($bulk_upload as $bulk){
				//					$this->db->insert_batch('employee_loan',$bulk);
				//				}
				//			}else{
				//				$this->db->insert_batch('employee_loan',$upload);
				//			}
			foreach($upload as $record){
				$empid = isset($record['empid']) ? $record['empid'] : 0;
				$loan_type = isset($record['loan_type']) ? $record['loan_type'] : 0;
				$order_date = isset($record['order_date']) ? $record['order_date'] : 0;
				// check records exists-
				$res = $this->db->get_where('employee_loan',array('empid'=>$empid,'loan_type'=>$loan_type,'order_date'=>$order_date));
				if($res->num_rows() > 0){
//					'update_dt'	= date('Y-m-d H:i:s');
					$this->db->where('empid',$empid)->where('loan_type',$loan_type)->where('order_date',$order_date)->update('employee_loan',$record);
				}else{
//					'update_dt'	= date('Y-m-d H:i:s')
					$this->db->insert('employee_loan',$record);
				}
				
			}
			$db_error = $this->db->error();
			if(!empty($db_error) && $db_error['code'] != 0 && trim($db_error['message']) != ''){
				$message = $db_error['code'].' '.$db_error['message'];
				$is_success = false;
				@unlink($file_name);
			}else{
				$message = 'Successfully updated.';
				$is_success = true;
				@unlink($file_name);
			}
		}else{
			$message = 'No file selected.';
			$is_success = false;
		}
		$response = array(
						'is_success'	=> $is_success,
						'message'		=> $message
					);
		echo json_encode($response);
		exit();
	}

//------------encashment		
	public function encashment(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->employee_encashment($page_no);
		$data['results'] = $response['results'];
		$data['encashments'] = $this->emp_model->get_all_encashment_types();
		$config['base_url'] = base_url().'/admin/admin_ii/encashment';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_ii/encashment',$data);
		$this->load->view('agadmin/layout/footer');
	}

	public function encashment_edit(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->encashment_details($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
		if($this->input->post()){
			$this->emp_model->update_encashment_details($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'admin_ii/encashment');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_ii/encashment_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}	

	public function encashment_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_ii/encashment_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function encashment_ajax_upload(){
		$data['results'] = array();
		if(isset($_FILES)){
			$path = 'excel';
			$file_name = '';
			$res = $this->common_model->upload_file('file',"*",$path);
			
			if($res['is_success']){
				$file_name = $path.'/'.$res['filename'];
			}else{
				@unlink($file_name);
				$error_msg = $res['message'];
				echo json_encode($res);
				exit();
			}
			$this->load->library('spreadsheet');
			$res = $this->spreadsheet->read_file($file_name);
			if(isset($res['values']) && empty($res['values'])){
				// empty file
				$response = array(
						'is_success'	=> false,
						'message'		=> 'The file is empty'
					);
				@unlink($file_name);
				echo json_encode($response);
				exit();
			}
			$headers = array();
			$upload = array();
			
			$header_security_field =  array('EMPID','NAME','DESIG','EMP_SECTION','GROUP_NM','OFFICE_NM','BASIC_PAY','DESCRIPTION','LTC_HTC','ENCASHMENT_NO','LEAVE_TYPE','FROM_DATE','TO_DATE','LEAVE_FOR','NO_DAYS_ENCASH','EL_CREDIT','DA_RATE','ENCASH_AMOUNT','INCOME_TAX_AMOUNT','ENCASH_ORDER_NO','ENCASH_ORDER_DATE','BILL_NO','BILL_DATE');
//											empid	name	desig	emp_section	group_nm	office_nm	basic_pay	description	ltc_htc		encashment_no	leave_type	from_date	to_date	 leave_for		no_days_encash	el_credit	da_rate		encash_amount 	income_tax_amount	encash_order_no	encash_order_date	bill_no	bill_date																
			foreach($res['header'] as $key => $val){
				if(trim($val) != ''){ // remove empty cel 
					$val = strtoupper($val);
					if(in_array($val,$header_security_field)){
						$headers[$key]	= strtolower($val);
						if (($k = array_search($val, $header_security_field)) !== false) {
							unset($header_security_field[$k]);
						}
					}
				}
			}
			if(!empty($header_security_field)){
				$response = array(
							'is_success'	=> false,
							'message'		=> 'The file has extra field.'
						);
						@unlink($file_name);
						echo json_encode($response);
						exit();
			}
			$i = 0;
			
			foreach($res['values'] as $row => $columns){
				$up_arr = array_fill_keys($headers,"");
				foreach($columns as $key=>$val){
					if(isset($headers[$key])){ // remove empty cel 
						$up_arr[$headers[$key]]	= $val;
					}
				}
				$upload[] = $up_arr;				
			}
				//			$bulk_elem = 10;
				//			$bulk_upload = array();
				//			if( count($upload) > $bulk_elem ){
				//				$bulk_upload = array_chunk($upload,$bulk_elem);
				//				foreach($bulk_upload as $bulk){
				//					$this->db->insert_batch('employee_leave_encashment',$bulk);
				//				}
				//			}else{
				//				$this->db->insert_batch('employee_leave_encashment',$upload);
				//			}
			foreach($upload as $record){
				$empid = isset($record['empid']) ? $record['empid'] : 0;
				$ltc_htc = isset($record['ltc_htc']) ? $record['ltc_htc'] : 0;
				$from_date = isset($record['from_date']) ? $record['from_date'] : 0;
				// check records exists-
				$res = $this->db->get_where('employee_leave_encashment',array('empid'=>$empid,'ltc_htc'=>$ltc_htc,'from_date'=>$from_date));
				if($res->num_rows() > 0){
//					'update_dt'	= date('Y-m-d H:i:s');
					$this->db->where('empid',$empid)->where('ltc_htc',$ltc_htc)->where('from_date',$from_date)->update('employee_leave_encashment',$record);
				}else{
//					'update_dt'	= date('Y-m-d H:i:s')
					$this->db->insert('employee_leave_encashment',$record);
				}
				
			}
			$db_error = $this->db->error();
			if(!empty($db_error) && $db_error['code'] != 0 && trim($db_error['message']) != ''){
				$message = $db_error['code'].' '.$db_error['message'];
				$is_success = false;
				@unlink($file_name);
			}else{
				$message = 'Successfully updated.';
				$is_success = true;
				@unlink($file_name);
			}
		}else{
			$message = 'No file selected.';
			$is_success = false;
		}
		$response = array(
						'is_success'	=> $is_success,
						'message'		=> $message
					);
		echo json_encode($response);
		exit();
	}
	public function all_employees_encashment(){
		$this->load->model('emp_model');
		$headings = array();
		$firstrow = array();
		$all_application = $this->emp_model->all_employees_encashment('AGAE');
		if(!empty($all_application)){
			unset($all_application[0]['appl_id']);
			foreach( $all_application[0] as $k => $v ) {
					$headings[] = strtoupper($k);
					$firstrow[] = $v;
			}
			unset($all_application[0]);
		}
		$excel_data[] = $headings;
		$excel_data[1] = $firstrow;
		foreach( $all_application as $row ) {
			unset($row['appl_id']);
			$row['application_dt'] = date('d-m-Y h:i:s A',strtotime($row['application_dt']));
			$excel_data[] = $row;
		}
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Application of employees');
		$this->excel->getActiveSheet()->fromArray($excel_data);
		 
		$filename='application_'.time().'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}

	public function income_tax(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_income_tax_particulars($page_no);
		$data['results'] = $response['results'];
		$config['base_url'] = base_url().'/admin/admin_ii/income_tax';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_ii/income_tax',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
} // End of Class