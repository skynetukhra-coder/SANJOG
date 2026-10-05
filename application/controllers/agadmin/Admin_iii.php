<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_iii extends CI_Controller {
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
		if($this->admin_type == 'admin_iii' || $this->admin_type == 'superadmin'){
			
		}else{
			show_404();
		}
	}	
	public function index(){
		$data['results'] = array();
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_iii',$data);
		$this->load->view('agadmin/layout/footer');
	}	
	public function employee(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_admin_employee($page_no);
		$data['examinations'] = $this->emp_model->get_all_employee_examinations();
		$data['results'] = $response['results'];
		$config['base_url'] = base_url().'/admin/admin_iii/employee';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_iii/employee',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function employee_edit(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->employee_details($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
		if($this->input->post()){
			$this->emp_model->update_employee_peninfo($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'admin_iii/employee');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_iii/employee_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}

	public function service_book(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->wing_model->get_doc_office_order($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/admin_iii/service_book';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_iii/service_book',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function service_book_add(){
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
			$sb_attachment =  $this->input->post('sb_attachment');
			$emp_concerned =  $this->input->post('emp_concerned');
				foreach($emp_concerned as $empid=>$mobile){
					$ord_empid = $empid;
			}
			
			$this->form_validation->set_rules('title', 'Title', 'required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				$update = array(
							'ord_empid' => $ord_empid,
							'title'		=> $this->input->post('title',true),
							'details'	=> $this->input->post('details'),
							'order_dt'	=> date('Y-m-d',strtotime($this->input->post('order_dt'))),
							'sb_upto_dt'	=> date('Y-m-d',strtotime($this->input->post('sb_upto_dt'))),
							'ord_year'	=> date('Y'),
							'update_dt'	=> date('Y-m-d H:i:s')
						);
				if(isset($_FILES['attachment']) && $_FILES['attachment']['size'][0] > 0){
					//upload file
					$upload_details = $this->common_model->upload_service_book('attachment');
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
						redirect(ADMIN_BASE_URL.'admin_iii/service_book');
					}else{
						$attachment_sbook = implode(';',$upload_details['filenames']);
					}
				}
				
				if($error == ''){
					if(!empty($id)){ // edit
						if(!empty($sb_attachment)){
							$update['attachment'] =  $sb_attachment;
						}else{
							$update['attachment'] =  $attachment_sbook;
						}
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
					redirect(ADMIN_BASE_URL.'admin_iii/service_book');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_iii/service_book_add',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function service_book_delete(){
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
		redirect(ADMIN_BASE_URL.'admin_iii/service_book');
	}
	
//--------------------Leave
	public function leave_credit(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['leave_types'] = $this->emp_model->get_all_leave_types();
		
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_employee_leave_credited($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/admin_iii/leave_credit';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_iii/leave_credit',$data);
		$this->load->view('agadmin/layout/footer');
	}

	public function leave_credit_edit(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->leave_credits($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
		if($this->input->post()){
			$this->emp_model->update_employee_leave_credit($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'admin_iii/leave_credit');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_iii/leave_credit_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}	
		
	public function leave_credit_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_iii/leave_credit_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function leave_credit_upload_auto(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_iii/leave_credit_upload_auto',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function leave_credit_ajax_upload(){
		$data['results'] = array();
		$this->load->model('emp_model');
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
			
			$header_security_field =  array('EMPID','LEAVE_CR_YEAR','LEAVE_TYPE','CR_FROM_DATE','CR_TO_DATE','EXOL_DEDUCTION','DIESNON_DEDUCTION','NO_DAYS','CREDIT_DATE');
																			
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
			$pre_credit = 0;
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
				//					$this->db->insert_batch('employee_leave_credit',$bulk);	
				//				}
				//			}else{
				//				$this->db->insert_batch('employee_leave_credit',$upload);
				//			}
			foreach($upload as $record){
				$empid = isset($record['empid']) ? $record['empid'] : 0;
				$leave_type = isset($record['leave_type']) ? $record['leave_type'] : 0;
				$cr_from_date = isset($record['cr_from_date']) ? $record['cr_from_date'] : 0;
				$credit_balance = isset($record['no_days']) ? $record['no_days'] : 0;
				
				// check records exists
				$res = $this->db->get_where('employee_leave_credit',array('empid'=>$empid,'leave_type'=>$leave_type,'cr_from_date'=>$cr_from_date));
				if($res->num_rows() > 0){
					// fetching field value from table before update
					$pre_credit=$this->emp_model->emp_leave_precredit_balance_update($empid,$leave_type,$cr_from_date);
					// updating the credit table
					$this->db->where('empid',$empid)->where('leave_type',$leave_type)->where('cr_from_date',$cr_from_date)->update('employee_leave_credit',$record);
					// updating current_balance table				
					$cr_id = $this->emp_model->emp_leave_credit_balance_update($empid,$leave_type,$cr_from_date,$credit_balance,$pre_credit);	
				}else{
					if($leave_type == 'Casual Leave' || $leave_type == 'Restricted Holiday'){
						$record['leave_cb'] = $credit_balance;
						$record['status'] = 'Active';
						$this->db->insert('employee_leave_credit',$record);
						// inserting to current_balance table					
						$cr_id = $this->emp_model->emp_leave_credit_balance($empid,$leave_type,$credit_balance);
					}else{
						$record['leave_cb'] = $this->emp_model->emp_leave_precredit_balance_insert($empid,$leave_type);
						$this->db->insert('employee_leave_credit',$record);
						// inserting to current_balance table					
						$cr_id = $this->emp_model->emp_leave_credit_balance($empid,$leave_type,$credit_balance);
					}
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
	
	public function leave_credit_ajax_upload_auto(){
		$data['results'] = array();
		$this->load->model('emp_model');
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
			
			$header_security_field =  array('EMPID','LEAVE_TYPE','CR_FROM_DATE');
																			
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
			$pre_credit = 0;
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
				//					$this->db->insert_batch('employee_leave_credit',$bulk);	
				//				}
				//			}else{
				//				$this->db->insert_batch('employee_leave_credit',$upload);
				//			}
			foreach($upload as $record){
				$empid = isset($record['empid']) ? $record['empid'] : 0;
				$leave_type = isset($record['leave_type']) ? $record['leave_type'] : 0;
				$cr_from_date = isset($record['cr_from_date']) ? $record['cr_from_date'] : 0;

	
				$cr_to_date = date('Y-m-t',strtotime("+180 days",strtotime($cr_from_date)));
				$last_period_from = date('Y-m-01',strtotime("-180 days",strtotime($cr_from_date)));
				$last_period_to = date('Y-m-t',strtotime("-15 day",strtotime($cr_from_date)));
				
				$emp_dor = '';
				$sum_exol = 0;
				$sum_diesnon = 0;
				$credit_full = 0;
				$deduction = 0;
				$credit_days = 0;
				$credit_balance = 0 ;
				$datediff = 0;
				
				$emp_dor = $this->emp_model->get_employee_dor($empid);
				$data['last_exol'] = $this->emp_model->get_employee_exol_last_period($empid,$last_period_from,$last_period_to);
				$data['last_diesnon'] = $this->emp_model->get_employee_diesnon_last_period($empid,$last_period_from,$last_period_to);

				if(!empty($data['last_exol'])){
					foreach($data['last_exol'] as $results){
						$sum_exol += $results['leave_day_no']; 
					}
				}else{
					$sum_exol=0;
				}

				if(!empty($data['last_diesnon'])){
					foreach($data['last_diesnon'] as $results){
						$sum_diesnon += $results['leave_day_no']; 
					}
				}else{
					$sum_diesnon=0;
				}

				if( $leave_type == 'Earned Leave'){
					$credit_full = 15;
				}
				else if( $leave_type == 'Half Pay Leave'){
					$credit_full = 10;
				}

				$deduction = ($sum_exol + $sum_diesnon);

				if( $emp_dor <= $cr_to_date ){
					$datediff = (strtotime($emp_dor) - strtotime($cr_from_date))/ (60 * 60 * 24);
					$credit_days = round(($credit_full / 180) * $datediff) - $deduction;
				}else{
					$credit_days = ($credit_full - $deduction);
				}

				$record['exol_deduction'] = $sum_exol;
				$record['diesnon_deduction'] = $sum_diesnon;
				$record['no_days'] = $credit_days;
				$record['leave_cb'] = $credit_days;	
				$credit_balance = $credit_days;
				$record['leave_cr_year'] = date('Y',strtotime($cr_from_date));
				$record['cr_to_date'] = $cr_to_date;
				$record['credit_date'] = date('Y-m-d');
				
				// check records exists
				$res = $this->db->get_where('employee_leave_credit',array('empid'=>$empid,'leave_type'=>$leave_type,'cr_from_date'=>$cr_from_date));
				if($res->num_rows() > 0){
					// fetching field value from table before update
					$pre_credit=$this->emp_model->emp_leave_precredit_balance_update($empid,$leave_type,$cr_from_date);
					// updating the table
					$this->db->where('empid',$empid)->where('leave_type',$leave_type)->where('cr_from_date',$cr_from_date)->update('employee_leave_credit',$record);
					// updating current_balance table				
					$cr_id = $this->emp_model->emp_leave_credit_balance_update($empid,$leave_type,$credit_balance,$pre_credit);	
				}else{
					if($leave_type == 'Casual Leave' || $leave_type == 'Restricted Holiday'){
						$this->db->insert('employee_leave_credit',$record);
						// inserting to current_balance table					
						$cr_id = $this->emp_model->emp_leave_credit_balance($empid,$leave_type,$credit_balance);
					}else{
						$record['leave_cb'] = $this->emp_model->emp_leave_precredit_balance_insert($empid,$leave_type);
						$this->db->insert('employee_leave_credit',$record);
						// inserting to current_balance table					
						$cr_id = $this->emp_model->emp_leave_credit_balance($empid,$leave_type,$credit_balance);
					}
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
//******************** Function for testing auto-credit 	
	public function leave_credit_ajax_upload_auto_view(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		
		$empid ='AUMPB6168Q';
		$leave_type ='Earned Leave';
		$leave_typ ='Half Pay Leave';
		$period_from='2020-01-01';
		
		$period_to= date('Y-m-t',strtotime("+180 days",strtotime($period_from)));
		$last_period_from = date('Y-m-01',strtotime("-180 days",strtotime($period_from)));
		$last_period_to = date('Y-m-t',strtotime("-15 day",strtotime($period_from)));
		// echo ('||  From '.$period_from);
		// echo ('||  To '.$period_to);
		// echo ('||  Last From '.$last_period_from);
		// echo ('||  Last To '.$last_period_to);
		
		
		$emp_dor = $this->emp_model->get_employee_dor($empid);
		$data['last_exol'] = $this->emp_model->get_employee_exol_last_period($empid,$last_period_from,$last_period_to);
//echo $this->db->last_query();
		$data['last_diesnon'] = $this->emp_model->get_employee_diesnon_last_period($empid,$last_period_from,$last_period_to);
//echo $this->db->last_query();
		if(!empty($data['last_exol'])){
			$last_exol =implode('', MAX($data['last_exol']));
		}else{
			$last_exol = 0;
		}
//echo ('||   Max  '.$last_exol);	

		if(!empty($data['last_diesnon'])){
			$last_diesnon =implode('', MIN($data['last_diesnon']));
		}else{
			$last_diesnon = 0;
		}
//echo ('||   Min  '.$last_diesnon);	
//-----------sum of a column

		if(!empty($data['last_exol'])){
				$sum_exol=0;
			foreach($data['last_exol'] as $results){
					$sum_exol += $results['leave_day_no']; 
			}
			}else{
				$sum_exol=0;
			}
		
		if(!empty($data['last_diesnon'])){
				$sum_diesnon=0;
			foreach($data['last_diesnon'] as $results){
					$sum_diesnon += $results['leave_day_no']; 
			}
			}else{
				$sum_diesnon=0;
			}
$cr_from_date='2019-07-01';





echo "<br>";		
//$last_diesnon = array_sum($data['last_diesnon']);
echo $emp_dor;
echo "<br>";
		if( $leave_type == 'Earned Leave'){
			$credit_full = 15;
		}
		else if( $leave_type == 'Half Pay Leave'){
			$credit_full = 10;
		}

		$deduction = ($sum_exol+$sum_diesnon);
		if( $emp_dor <= $period_to ){
			echo 'Proportional Credit';
			$datediff = (strtotime($emp_dor) - strtotime($period_from))/ (60 * 60 * 24);
			$credit_days = round(($credit_full / 180) * $datediff) - $deduction;
			echo "<br>";
			echo ($datediff);
			echo "<br>";
			echo 'Proportional Credit'.$credit_days;
			
		}else{
			$credit_days = ($credit_full - $deduction);
			echo 'Full Credit '.$credit_full.' / ';
			echo 'Deduction '.$deduction .' / ';
			echo 'Credit '.$credit_days;
		}	
//print_r ($data['emp_dor']);
echo "<br>";
//print_r ($data['last_exol']);
echo "<br>";
//		print_r ($data['last_diesnon']);
echo 'Deduction '.$deduction;
echo "<br>";


print_r ($data['last_exol']);
echo "<br>";	
echo 'The Sum of EXOL is : ' .$sum_exol;
echo "<br>";
print_r ($data['last_diesnon']);
echo "<br>";
echo 'The Sum of Dies Non is : ' .$sum_diesnon;
echo "<br>";	
echo 'Count: ' . count($data['last_exol']);
echo "<br>";
$result = array("10", "12", "21", "72", "12");
echo 'Sum: ' . array_sum($result);
exit;

//echo $this->db->last_query();
//------------------------------------
			if( $credit_upto <= date('Y-m-d',strtotime($this->input->post('application_dt')))&& $leave_type == 'Earned Leave' && $leave_balan >= 300 ){
				echo 'No; Credit is to be updated';
			}else{
				echo 'Yes: No preblem with credit';
			}			

//		print_r(max($data['last_credit']));
//		echo "<pre>";
//		print_r($_FILES);
//		print_r($_POST);
//-----------------------------------
//exit;		
		$p = $this->emp_model->emp_el_hpl_auto_credit_exol();
		echo $p;
	
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_employee_leave_credited($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/admin_iii/leave_credit_ajax_upload_auto_view';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);

		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_iii/leave_credit_ajax_upload_auto_view',$data);
		$this->load->view('agadmin/layout/footer');
	}
//***************************************************
	public function leave_credit_admin(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->employee_leave_credit_list($page_no);
		$data['results'] = $response['results'];
		
		$data['leave_types'] = $this->emp_model->get_all_leave_types();
		
		$config['base_url'] = base_url().'/admin/admin_iii/leave_credit_admin';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_iii/leave_credit_admin',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function leave_credit_admin_edit(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);

		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->leave_credits($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		if($this->input->post()){
			$this->emp_model->leave_credit_cl_status_update($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'admin_iii/leave_credit_admin');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_iii/leave_credit_admin_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}	
	public function leave_debit(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->employee_leave_debit_list($page_no);
		$data['results'] = $response['results'];
		
		$data['leave_types'] = $this->emp_model->get_all_leave_types();
		
		$config['base_url'] = base_url().'/admin/admin_iii/leave_debit';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_iii/leave_debit',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function leave_debit_edit(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->leave_debits($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
		if($this->input->post()){
			$this->emp_model->leave_application_servicebook_entry($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'admin_iii/leave_debit');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_iii/leave_debit_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function leave_debit_sec_edit(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['section_list'] = $this->emp_model->get_all_section_list();
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->leave_debits($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		if($this->input->post()){
			$this->emp_model->leave_application_admin_rectification($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'admin_iii/leave_debit');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_iii/leave_debit_sec_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function leave_debit_admin(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->employee_leave_debit_list($page_no);
		$data['results'] = $response['results'];
		
		$data['leave_types'] = $this->emp_model->get_all_leave_types();
		
		$config['base_url'] = base_url().'/admin/admin_iii/leave_debit_admin';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_iii/leave_debit_admin',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function leave_debit_admin_edit(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);

		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->leave_debits($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		if($this->input->post()){
			$this->emp_model->leave_application_admin_rectification($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'admin_iii/leave_debit_admin');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_iii/leave_debit_admin_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}	
	public function leave_debit_cancel(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->employee_leave_debit_cancel_list($page_no);
		$data['results'] = $response['results'];
		
		$data['leave_types'] = $this->emp_model->get_all_leave_types();
		
		$config['base_url'] = base_url().'/admin/admin_iii/leave_debit_cancel';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_iii/leave_debit_cancel',$data);
		$this->load->view('agadmin/layout/footer');
	}	
	public function leave_encashment(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->employee_leave_encashment_list($page_no);
		$data['results'] = $response['results'];
		
		$data['leave_types'] = $this->emp_model->get_all_leave_types();
		
		$config['base_url'] = base_url().'/admin/admin_iii/leave_encashment';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_iii/leave_encashment',$data);
		$this->load->view('agadmin/layout/footer');
	}	
	public function leave_debit_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_iii/leave_debit_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}

	public function leave_debit_ajax_upload(){
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
			
//			$header_security_field =  array('EMPID','NAME','DESIG','LEAVE_BASIC_PAY','SECTION','GROUP_NM','OFFICE_NM','LEAVE_DR_YEAR','LEAVE_TYPE','LEAVE_FROM','LEAVE_TO','LEAVE_DAY_NO','GROUND','ADMISSIBILITY','APPLICATION_DT','SERVICEBK_RECORD','SERVICEBK_RECORD_DT','LEAVE_STATUS');
			$header_security_field =  array('EMPID','NAME','DESIG','LEAVE_BASIC_PAY','SECTION','GROUP_NM','OFFICE_NM','LEAVE_DR_YEAR','LEAVE_TYPE','LEAVE_FROM','LEAVE_TO','LEAVE_DAY_NO','GROUND','ADMISSIBILITY','APPLICATION_JOINING_DT','PRE_FROM','PRE_TO','PRE_DESC','SUFF_FROM','SUFF_TO','SUFF_DESC','LEAVE_ADDRESS','APPLICATION_DT','LAST_LEAVE_TYPE','LAST_LEAVE_FROM','LAST_LEAVE_TO','LAST_LEAVE_JOINED_ON','RECOMMENDATION','RECOM_DATE','RECOM_AUTHO','RECOM_AUTHO_DESIG','RECOM_AUTHO_PAN','SANCTION_DESC','APPROVE_DATE','SANCTION_AUTHO','SANCTION_AUTHO_DESIG','SANCTION_AUTHO_PAN','SERVICEBK_RECORD','SERVICEBK_RECORD_DT','LEAVE_STATUS');

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
				//					$this->db->insert_batch('employee_leave_debit',$bulk);	
				//				}
				//			}else{
				//				$this->db->insert_batch('employee_leave_debit',$upload);
				//			}
			foreach($upload as $record){
				$empid = isset($record['empid']) ? $record['empid'] : 0;
				$leave_type = isset($record['leave_type']) ? $record['leave_type'] : 0;
				$application_dt = isset($record['application_dt']) ? $record['application_dt'] : 0;
				// check records exists
				$res = $this->db->get_where('employee_leave_debit',array('empid'=>$empid,'leave_type'=>$leave_type,'application_dt'=>$application_dt));
				if($res->num_rows() > 0){
					$this->db->where('empid',$empid)->where('leave_type',$leave_type)->where('application_dt',$application_dt)->update('employee_leave_debit',$record);
				}else{
					
					$this->db->insert('employee_leave_debit',$record);
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
		
	public function all_employees_leaves(){
		$this->load->model('emp_model');
		$headings = array();
		$firstrow = array();
		$all_application = $this->emp_model->all_employees_leaves('AGAE');
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
	public function leave_application_print(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
			
		$id = $this->uri->segment(4);
		
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->leave_debits($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$this->load->view('agadmin/pages/admin_iii/leave_application_print',$data);
	}
	
	public function leave_application_clrh_print(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
			
		$id = $this->uri->segment(4);
		
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->leave_debits($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$this->load->view('agadmin/pages/admin_iii/leave_application_clrh_print',$data);
	}
	
	public function leave_current_balance(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->employee_current_leave_balance_list($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/admin_iii/leave_current_balance';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_iii/leave_current_balance',$data);
		$this->load->view('agadmin/layout/footer');
	}	
	public function leave_current_balance_clrh(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['leave_types'] = $this->emp_model->get_all_leave_types();
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->employee_current_leave_balance_clrh($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/admin_iii/leave_current_balance_clrh';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_iii/leave_current_balance_clrh',$data);
		$this->load->view('agadmin/layout/footer');
	}	
	public function leave_current_balance_clrh_admin(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['leave_types'] = $this->emp_model->get_all_leave_types();
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->employee_current_leave_balance_clrh($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/admin_iii/leave_current_balance_clrh_admin';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_iii/leave_current_balance_clrh_admin',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function leave_clrh_balance_update(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->employee_leave_clrh_balances($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
		if($this->input->post()){
			$this->emp_model->update_employee_clrh_leave_balances($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'admin_iii/leave_current_balance_clrh_admin');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_iii/leave_clrh_balance_update',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function leave_other_balance_update(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->employee_leave_other_balances($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
		if($this->input->post()){
			$this->emp_model->update_employee_other_leave_balances($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'admin_iii/leave_current_balance_other_admin');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_iii/leave_other_balance_update',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function leave_balance(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->employee_leave_balance_list($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/admin_iii/leave_balance';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_iii/leave_balance',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function leave_current_balance_other_admin(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['leave_types'] = $this->emp_model->get_all_leave_types();
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->employee_current_leave_balance_other($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/admin_iii/leave_current_balance_other_admin';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_iii/leave_current_balance_other_admin',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function leave_balance_edit(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->employee_leave_balances($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
		if($this->input->post()){
			$this->emp_model->update_employee_leave_balances($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'admin_iii/leave_balance');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_iii/leave_balance_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}	

	public function leave_balance_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_iii/leave_balance_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function leave_balance_ajax_upload(){
		$data['results'] = array();
		$this->load->model('emp_model');
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
			
			$header_security_field =  array('EMPID','LEAVE_TYPE','AS_ON','LEAVE_OB','LEAVE_CR','LEAVE_DR','LEAVE_CB');
																			
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
			$up_balance = 0;
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
				//					$this->db->insert_batch('employee_leave_balance',$bulk);
				//				}
				//			}else{
				//				$this->db->insert_batch('employee_leave_balance',$upload);
				//			}
			foreach($upload as $record){
				$empid = isset($record['empid']) ? $record['empid'] : 0;
				$leave_type = isset($record['leave_type']) ? $record['leave_type'] : 0;
				$up_balance = isset($record['leave_cb']) ? $record['leave_cb'] : 0;
				
				// check records exists
				$res = $this->db->get_where('employee_leave_balance',array('empid'=>$empid,'leave_type'=>$leave_type));
				if($res->num_rows() > 0){
//					'update_dt'	= date('Y-m-d H:i:s');
					$this->db->where('empid',$empid)->where('leave_type',$leave_type)->update('employee_leave_balance',$record);
				}else{
//					'update_dt'	= date('Y-m-d H:i:s')
					$this->db->insert('employee_leave_balance',$record);
					$up_id = $this->emp_model->emp_leave_upload_balance($empid,$leave_type,$up_balance);
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
	
	public function family_member(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_employee_family_member($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/admin_iii/family_member';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_iii/family_member',$data);
		$this->load->view('agadmin/layout/footer');
	}

	public function family_member_edit(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->family_member($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
		if($this->input->post()){
			$this->emp_model->update_family_member($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'admin_iii/family_member');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_iii/family_member_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}	
		
	public function family_member_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_iii/family_member_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function family_member_ajax_upload(){
		$data['results'] = array();
		$this->load->model('emp_model');
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
			
			$header_security_field =  array('EMPID','MEMBER_NAME','MEMBER_DOB','MEMBER_GENDER','FAMILY_RELATION','FIRST_SECOND_CHILD','MERITAL_STATUS','PH_STATUS','PH_PERCENTAGE');
											//empid  member_name   member_dob	family_relation	  first_second_child	ph_status	ph_percentage																			
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
			$pre_credit = 0;
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
				//					$this->db->insert_batch('employee_family',$bulk);	
				//				}
				//			}else{
				//				$this->db->insert_batch('employee_family',$upload);
				//			}
			foreach($upload as $record){
				$empid = isset($record['empid']) ? $record['empid'] : 0;
				$first_second_child = isset($record['first_second_child']) ? $record['first_second_child'] : 0;
				$member_dob = isset($record['member_dob']) ? $record['member_dob'] : 0;
				// check records exists
				$res = $this->db->get_where('employee_family',array('empid'=>$empid,'first_second_child'=>$first_second_child,'member_dob'=>$member_dob));
				if($res->num_rows() > 0){
					// updating the table
					$this->db->where('empid',$empid)->where('first_second_child',$first_second_child)->where('member_dob',$member_dob)->update('employee_family',$record);
				}else{
					$this->db->insert('employee_family',$record);
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
		
	public function document_order(){
		$this->load->model('wing_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->wing_model->get_adminiii_all_circular($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/admin_iii/document_order';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_iii/document_order',$data);
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
			$this->form_validation->set_rules('wing', 'Wing', 'required');
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
					//$upload_details = $this->common_model->upload_multiple_file('attachment');
					$upload_details = $this->common_model->upload_multiple_order_cicular('attachment');
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
						redirect(ADMIN_BASE_URL.'admin_iii/document_order');
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
					redirect(ADMIN_BASE_URL.'admin_iii/document_order');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_iii/document_order_add',$data);
		$this->load->view('agadmin/layout/footer');
	}

	public function document_order_delete(){
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
		redirect(ADMIN_BASE_URL.'admin_iii/document_order');
	}
		
	public function office_order(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->wing_model->get_adminiii_office_order($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/admin_iii/office_order';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_iii/office_order',$data);
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
						redirect(ADMIN_BASE_URL.'admin_iii/office_order');
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
					redirect(ADMIN_BASE_URL.'admin_iii/office_order');
				}
				
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_iii/office_order_add',$data);
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
						redirect(ADMIN_BASE_URL.'admin_iii/office_order');
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
					redirect(ADMIN_BASE_URL.'admin_iii/office_order');
				}
				
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_iii/office_order_edit',$data);
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
		redirect(ADMIN_BASE_URL.'admin_iii/office_order');
	}

public function circular_office_order(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->wing_model->get_admin_circular_office_order($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/admin_iii/circular_office_order';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_iii/circular_office_order',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function circular_office_order_add(){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->wing_model->getCircularOfficeOrderByID($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$error = '';
		if($this->input->post()){
			$this->form_validation->set_rules('description', 'Description', 'required');
			$this->form_validation->set_rules('description_hindi', 'Description_hindi', 'required');
			$this->form_validation->set_rules('description_bengali', 'Description_bengali', 'required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				$update = array(
							'description'	=> $this->input->post('description'),
							'description_hindi'	=> $this->input->post('description_hindi'),
							'description_bengali'	=> $this->input->post('description_bengali'),
							'f_year'		=> date('m') <= 3 ? date('Y').'-03-31' : (date('Y') + 1).'-03-31',
							'date'			=> date('Y-m-d H:i:s'),
							'wing'			=> $this->input->post('wing',true),
							'url_link'		=> $this->input->post('url_link',true),
							'sl_no'			=> $this->input->post('sl_no',true),
						);
				if(isset($_FILES['attachment']) && $_FILES['attachment']['size'] > 0){
					//upload file
					$upload_details = $this->common_model->upload_circular_order('attachment');
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
					}else{
						$update['pdf_name'] = $upload_details['filename'];
					}
				}
				if($error == ''){
					if(!empty($id)){ // edit
						$result = $this->wing_model->updateCircularOfficeOrder($id,$update);
						$this->session->set_flashdata('success','Successfully updated.');
					}else{
						$id = $this->wing_model->addCircularOfficeOrder($update);
						$this->session->set_flashdata('success','Successfully added.');
					}
					redirect(ADMIN_BASE_URL.'admin_iii/circular_office_order');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/admin_iii/circular_office_order_add',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function circular_office_order_delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->wing_model->getCircularOfficeOrderByID($id);
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->wing_model->deleteCircularOfficeOrderByID($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'admin_iii/circular_office_order');
	}
	
	public function employee_print() { 
		$this->load->library('m_pdf');
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$id = $this->uri->segment(4);

		$data['row'] = array();
		
		if(!empty($id)){
			$data['record'] = $this->emp_model->get_employee_details($id);
			if(empty($data['record'])){
				show_404('admin');
			}
		}
		
//echo $this->db->last_query();
//print_r ($data['wives_husb']);
//exit;
	
		$html = $this->load->view('agadmin/pages/admin_iii/employee_print',$data,true);//load the pdf_output.php by passing our data and get all data in $html varriable.
//		$img=FCPATH . "assets/images/top-head.png";
		$pdfFilePath ="Permission".time().".pdf";
		$pdf = $this->m_pdf->generate();
		$pdf->SetWatermarkText('O/o the Pr. Accountant General (A&E), WB');
		$pdf->watermark_font = 'DejaVuSansCondensed';
		$pdf->watermarkTextAlpha = 0.1;
		$pdf->showWatermarkText = true;
		$pdf->SetWatermarkImage($img,1,'',array(1,10));
		$pdf->watermarkImageAlpha = 1;
		$pdf->showWatermarkImage =  true;
		$pdf->WriteHTML($html);
//		$pdf->Output($pdfFilePath, "D");
		$pdf->Output();
    }
	
} // End of Class