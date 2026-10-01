<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Training extends CI_Controller {
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
		if($this->admin_type == 'training' || $this->admin_type == 'superadmin'){
			
		}else{
			show_404();
		}
	}
	public function index(){
		$data['results'] = array();
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/training',$data);
		$this->load->view('agadmin/layout/footer');
	}	

//------------training		
	public function training(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->employee_trainings($page_no);
		$data['results'] = $response['results'];
		
		$data['training_ids'] = $this->emp_model->get_all_training_ids();
		$data['training_types'] = $this->emp_model->get_all_training_types();
		
		$config['base_url'] = base_url().'/admin/training/training';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/training/training',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function training_master_add(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
/*		
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->get_training_master_details($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
*/		
		
		if($this->input->post()){
			$this->form_validation->set_rules('trang_id', 'Training ID', 'required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				$trg_id =$this->input->post('trang_id');
				$data['row']= $this->emp_model->get_training_master_details($trg_id);
				if(empty($data['row'])){
					$this->emp_model->add_training_master_record();
					$this->session->set_flashdata('success','Successfully added.');
					redirect(ADMIN_BASE_URL.'training/training_program');
				}else{
					$this->session->set_flashdata('error','Duplicate Training ID. Record cannot be added.');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/training/training_master_add',$data);
		$this->load->view('agadmin/layout/footer');
	}	
	public function training_program_edit(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->get_training_master_details($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
		if($this->input->post()){
			$this->emp_model->update_training_master_record($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'training/training_program');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/training/training_program_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}	
	public function training_edit(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->employee_training_details($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
		if($this->input->post()){
			$this->emp_model->update_employee_training($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'training/training');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/training/training_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}	

	public function training_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/training/training_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function training_ajax_upload(){
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
			
			$header_security_field =  array('EMPID','NAME','DESIG','EMP_SECTION','BASIC_PAY','FIN_YEAR','TRAINING_ORDER','ORDER_DATE','TRAINING_MODE','TRAINING_TYPE','DESCRIPTION','LOCATION','TRAINING_FROM','TRAINING_TO','TRG_TIME','TRAINING_DAYS','BILL_NO','ADVANCE_BILL_NO');
																			
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
				//					$this->db->insert_batch('employee_training',$bulk);
				//				}
				//			}else{
				//				$this->db->insert_batch('employee_training',$upload);
				//			}
			foreach($upload as $record){
				$empid = isset($record['empid']) ? $record['empid'] : 0;
				$training_type = isset($record['training_type']) ? $record['training_type'] : 0;
				$training_from = isset($record['training_from']) ? $record['training_from'] : 0;
				$record['upload_dt'] = date('Y-m-d H:i:s');
				// check records exists
				$res = $this->db->get_where('employee_training',array('empid'=>$empid,'training_type'=>$training_type,'training_from'=>$training_from));
				if($res->num_rows() > 0){
//					'update_dt'	= date('Y-m-d H:i:s');
					$this->db->where('empid',$empid)->where('training_type',$training_type)->where('training_from',$training_from)->update('employee_training',$record);
				}else{
//					'update_dt'	= date('Y-m-d H:i:s')
					$this->db->insert('employee_training',$record);
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
	
	public function training_master_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/training/training_master_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function training_master_ajax_upload(){
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
			
			$header_security_field =  array('TRANG_ID','FIN_YEAR','TRAINING_MODE','TRAINING_TYPE','TITLE','DESCRIPTION','LOCATION','TRAINING_FROM','TRAINING_TO','TRG_TIME','TRAINING_DAYS','TRAINING_ASSIGN_DT','TRAINING_ORDER','ORDER_DATE');
																			
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
				//					$this->db->insert_batch('training_master',$bulk);
				//				}
				//			}else{
				//				$this->db->insert_batch('training_master',$upload);
				//			}
			foreach($upload as $record){
				$trang_id = isset($record['trang_id']) ? $record['trang_id'] : 0;
				$training_type = isset($record['training_type']) ? $record['training_type'] : 0;
				$training_from = isset($record['training_from']) ? $record['training_from'] : 0;
				$record['upload_dt'] = date('Y-m-d H:i:s');
				// check records exists
				$res = $this->db->get_where('training_master',array('trang_id'=>$trang_id));
				if($res->num_rows() > 0){
//					'update_dt'	= date('Y-m-d H:i:s');
					$this->db->where('trang_id',$trang_id)->where('training_type',$training_type)->where('training_from',$training_from)->update('training_master',$record);
				}else{
//					'update_dt'	= date('Y-m-d H:i:s')
					$this->db->insert('training_master',$record);
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
	
	public function training_program(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_all_trainings($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/training/training_program';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/training/training_program',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function training_assignment(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
				
		$data['employees'] = $this->emp_model->get_all_employee_list_training();

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
			$data['row'] = $this->emp_model->getTrainingPrgByID($id);
			$data['asign_emp'] = $this->emp_model->getTrainingPrgToEmployees($id);
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
							'title'		=> $this->input->post('title',true),
							'details'	=> $this->input->post('details'),
							'order_dt'	=> date('Y-m-d',strtotime($this->input->post('order_dt'))),
							'update_dt'	=> date('Y-m-d H:i:s')
						);
				if(isset($_FILES['attachment']) && $_FILES['attachment']['size'][0] > 0){
					//upload file
					$upload_details = $this->common_model->upload_multiple_file('attachment');
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
						redirect(ADMIN_BASE_URL.'training/training_program');
					}else{
						$update['attachment'] = implode(';',$upload_details['filenames']);
					}
				}

				$empid_data =  $this->input->post('emp_concerned');
//				echo  key($empid_data);
//				echo  reset($empid_data);
//				$empid=key($empid_data);
//				echo $empid_data['name'];				
//				$mobile='';
//				print_r($this->input->post());
//				echo '<br>';
//				print_r	($empid_data);			
//				echo $empid;
//				echo '<br>';
//				echo $mobile;
//
//exit;			
//				$emp_concerned = $this->input->post('emp_concerned')
				$training_id = $this->input->post('trang_id',true);
//				$empid=key($empid_data);
				if($error == ''){
					if(!empty($id)){ // edit
						$this->emp_model->update_training_to_employee($id,$this->input->post('emp_concerned'));
						$emp_tr_id = $this->emp_model->emp_training_details_record($this->input->post('emp_concerned'),$training_id);
						$this->session->set_flashdata('success','Successfully updated and SMS sent.');						
					}else{ // add
//						$update['order_dt'] = date('Y-m-d H:i:s');
//      				$update['order_dt'] = date('Y-m-d',strtotime($this->input->post('order_dt')));				
						$this->emp_model->add_training_to_employee($id,$this->input->post('emp_concerned'));
						$emp_tr_id = $this->emp_model->emp_training_details_record($this->input->post('emp_concerned'),$training_id);
						$this->session->set_flashdata('success','Successfully allotted and SMS sent.');
					}
					redirect(ADMIN_BASE_URL.'training/training_program');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/training/training_assignment',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function training_delete(){
		$this->load->model('emp_model');
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->emp_model->employee_training_details($id);
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->emp_model->deleteTrainingOrderByID($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'training/training');
	}

	public function all_employees_trainings(){
		$this->load->model('emp_model');
		$headings = array();
		$firstrow = array();
		$all_trainings = $this->emp_model->all_employees_trainings('AGAE');
		if(!empty($all_trainings)){
			unset($all_trainings[0]['training_id']);
			foreach( $all_trainings[0] as $k => $v ) {
					$headings[] = strtoupper($k);
					$firstrow[] = $v;
			}
			unset($all_trainings[0]);
		}
		$excel_data[] = $headings;
		$excel_data[1] = $firstrow;
		foreach( $all_trainings as $row ) {
			unset($row['training_id']);
			$row['training_from'] = date('d-m-Y  A',strtotime($row['training_from']));
			$row['training_to'] = date('d-m-Y',strtotime($row['training_to']));
			$excel_data[] = $row;
		}
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Training of employees');
		$this->excel->getActiveSheet()->fromArray($excel_data);
		 
		$filename='Trainings'.time().'.xls'; //save our workbook as this file name
		header('Content-Type: Training/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}
	public function all_training_faculties(){
		$this->load->model('emp_model');
		$headings = array();
		$firstrow = array();
		$all_trainings = $this->emp_model->all_employees_training_faculties('AGAE');
		if(!empty($all_trainings)){
			unset($all_trainings[0]['training_id']);
			foreach( $all_trainings[0] as $k => $v ) {
					$headings[] = strtoupper($k);
					$firstrow[] = $v;
			}
			unset($all_trainings[0]);
		}
		$excel_data[] = $headings;
		$excel_data[1] = $firstrow;
		foreach( $all_trainings as $row ) {
			unset($row['training_id']);
			$row['training_from'] = date('d-m-Y  A',strtotime($row['training_from']));
			$row['training_to'] = date('d-m-Y',strtotime($row['training_to']));
			$excel_data[] = $row;
		}
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Training of employees');
		$this->excel->getActiveSheet()->fromArray($excel_data);
		 
		$filename='Faculties'.time().'.xls'; //save our workbook as this file name
		header('Content-Type: Training/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}	
	public function trg_feedback_download(){
		$this->load->model('emp_model');
		$headings = array();
		$firstrow = array();
		$all_training_fk = $this->emp_model->get_training_feedback_download('AGAE');
		if(!empty($all_training_fk)){
			unset($all_training_fk[0]['trg_feedback_id']);
			unset($all_training_fk[0]['training_detail_id']);
			foreach( $all_training_fk[0] as $k => $v ) {
					$headings[] = strtoupper($k);
					$firstrow[] = $v;
			}
			unset($all_training_fk[0]);
		}
		$excel_data[] = $headings;
		$excel_data[1] = $firstrow;
		foreach( $all_training_fk as $row ) {
			unset($row['trg_feedback_id']);
			unset($row['training_detail_id']);
			$row['feedback_date'] = date('d-m-Y',strtotime($row['feedback_date']));
			$excel_data[] = $row;
		}
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Training Feedback of employees');
		$this->excel->getActiveSheet()->fromArray($excel_data);
		 
		$filename='Trg_Feedback'.time().'.xls'; //save our workbook as this file name
		header('Content-Type: Training/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}
	public function training_employee(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_employees_issued_training_order($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/training/training_employee';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/training/training_employee',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function training_employee_delete(){
		$this->load->model('emp_model');
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->emp_model->getEmployeeTrainingOrderByID($id);
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->emp_model->delete_employees_training_OrderByID($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'training/training_employee');
	}

//	-----For training order html view

	public function training_order_print(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
			
		$id = $this->input->post('training_id');
		
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->get_training_order_print($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$data['candidates'] = $this->emp_model->get_trainees_list($id);
		$this->load->view('agadmin/pages/training/training_order_print',$data);
	}	
	

//	-----For training order PDF dwonload

	public function training_order_download() { 
		$this->load->library('m_pdf');
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
			
		$id = $this->input->post('training_id');
		
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->get_training_order_print($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}

		$data['candidates'] = $this->emp_model->get_trainees_list($id);
		$html = $this->load->view('agadmin/pages/training/training_order_download',$data,true);//load the pdf_output.php by passing our data and get all data in $html varriable.
		
//		$img="http://localhost/assets/images/top-head.png";
		$img="/usr/local/apache24/htdocs/assets/images/top-head.png";
		$pdfFilePath ="Training_Order".time().".pdf";
		$pdf = $this->m_pdf->letterPdfCreate();
		$pdf->SetWatermarkText('O/o the Pr. Accountant General (A&E), WB');
		$pdf->watermark_font = 'DejaVuSansCondensed';
		$pdf->watermarkTextAlpha = 0.1;
		$pdf->showWatermarkText = true;
		$pdf->SetWatermarkImage($img,1,'',array(1,10));
		$pdf->watermarkImageAlpha = 1;
		$pdf->showWatermarkImage =  true;
		$pdf->WriteHTML($html);
		$pdf->Output($pdfFilePath, "D");
//		$pdf->Output();
    }
		
		
//------------faculty	
	public function faculty(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
				);
		$data['training_ids'] = $this->emp_model->get_all_training_ids();
		$data['training_types'] = $this->emp_model->get_all_training_types();
		
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->employee_training_faculty_records($page_no);
		$data['results'] = $response['results'];
		
		
		
		$config['base_url'] = base_url().'/admin/training/faculty';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/training/faculty',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function faculty_edit(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->faculty_details($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
		if($this->input->post()){
			$this->emp_model->update_employee_faculty_record($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'training/faculty');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/training/faculty_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}	

	public function faculty_assignment(){
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
			$data['row'] = $this->emp_model->getTrainingPrgByID($id);
			$data['asign_emp'] = $this->emp_model->getTrainingPrgToFaculties($id);
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
							'title'		=> $this->input->post('title',true),
							'details'	=> $this->input->post('details'),
							'order_dt'	=> date('Y-m-d',strtotime($this->input->post('order_dt'))),
							'update_dt'	=> date('Y-m-d H:i:s')
						);
				if(isset($_FILES['attachment']) && $_FILES['attachment']['size'][0] > 0){
					//upload file
					$upload_details = $this->common_model->upload_multiple_file('attachment');
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
						redirect(ADMIN_BASE_URL.'training/training_program');
					}else{
						$update['attachment'] = implode(';',$upload_details['filenames']);
					}
				}

				$empid_data =  $this->input->post('emp_concerned');
		
				$training_id = $this->input->post('trang_id',true);
				if($error == ''){
					if(!empty($id)){ // edit
						$this->emp_model->update_training_to_faculties($id,$this->input->post('emp_concerned'));
						$emp_tr_id = $this->emp_model->emp_training_faculties_record($this->input->post('emp_concerned'),$training_id);
						$this->session->set_flashdata('success','Successfully updated and SMS sent.');						
					}else{ // add
//						$update['order_dt'] = date('Y-m-d H:i:s');
//      				$update['order_dt'] = date('Y-m-d',strtotime($this->input->post('order_dt')));				
						$this->emp_model->add_training_to_faculties($id,$this->input->post('emp_concerned'));
						$emp_tr_id = $this->emp_model->emp_training_faculties_record($this->input->post('emp_concerned'),$training_id);
						$this->session->set_flashdata('success','Successfully allotted and SMS sent.');
					}
					redirect(ADMIN_BASE_URL.'training/training_program');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/training/faculty_assignment',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function faculty_order_print(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
			
		$id = $this->input->post('training_id');
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->get_faculty_order_print($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$data['candidates'] = $this->emp_model->get_faculties_list($id);
		$this->load->view('agadmin/pages/training/faculty_order_print',$data);
	}	
	
	//	-----For training order PDF dwonload

	public function faculty_order_download() { 
		$this->load->library('m_pdf');
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
			
		$id = $this->input->post('training_id');
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->get_faculty_order_print($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$data['candidates'] = $this->emp_model->get_faculties_list($id);
		$html = $this->load->view('agadmin/pages/training/faculty_order_download',$data,true);//load the pdf_output.php by passing our data and get all data in $html varriable.

		$img="/usr/local/apache24/htdocs/assets/images/top-head.png";
		$pdfFilePath ="Faculty_Order".time().".pdf";
		$pdf = $this->m_pdf->letterPdfCreate();
		$pdf->SetWatermarkText('O/o the Pr. Accountant General (A&E), WB');
		$pdf->watermark_font = 'DejaVuSansCondensed';
		$pdf->watermarkTextAlpha = 0.1;
		$pdf->showWatermarkText = true;
		$pdf->SetWatermarkImage($img,1,'',array(1,10));
		$pdf->watermarkImageAlpha = 1;
		$pdf->showWatermarkImage =  true;
		$pdf->WriteHTML($html);
		$pdf->Output($pdfFilePath, "D");
//		$pdf->Output();
    }
	
	
	public function application_exam_list(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$data['examinations'] = $this->emp_model->get_all_employee_examinations_list();
		$response = $this->emp_model->get_application_exam_list($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/training/application_exam_list';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/training/application_exam_list',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function application_exam_list_edit(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->get_application_exam_list_edit($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
		if($this->input->post()){
			$this->emp_model->update_application_exam_status($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'training/application_exam_list');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/training/application_exam_list_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function application_exam_delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->wing_model->getApplicationExamByID($id);
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->wing_model->deleteApplicationExamByID($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'training/application_exam_list');
	}
	public function application_exam_other_list(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		
		$response = $this->emp_model->get_application_exam_other_list($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/training/application_exam_other_list';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/training/application_exam_other_list',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function application_exam_other_list_edit(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->get_application_exam_other_list_edit($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
		if($this->input->post()){
			$this->emp_model->update_application_exam_other_status($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'training/application_exam_list');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/training/application_exam_other_list_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function application_exam_other_delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->wing_model->getApplicationExamByID($id);
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->wing_model->deleteApplicationExamByID($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'training/application_exam_other_list');
	}
	public function application_invite(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		
		$response = $this->emp_model->get_all_exam_list($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/training/application_invite';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/training/application_invite',$data);
		$this->load->view('agadmin/layout/footer');
	}
		
	public function application_exam_add(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->emp_model->getExamNameByID($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$error = '';
		if($this->input->post()){
			$this->form_validation->set_rules('exam_name', 'Title', 'required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				$update = array(
							'exam_name'	=> $this->input->post('exam_name',true),
							'off_on'	=> 'No',
							'update_dt'	=> date('Y-m-d')
						);
				if($error == ''){
					if(!empty($id)){ // edit
						$result = $this->emp_model->updateExamName($id,$update);
						$this->session->set_flashdata('success','Successfully updated.');
						redirect(ADMIN_BASE_URL.'training/application_invite');
					}else{ // add
						$update['update_dt'] = date('Y-m-d');
						$this->emp_model->addNewExamName($update);
						$this->session->set_flashdata('success','Successfully added.');
						redirect(ADMIN_BASE_URL.'training/application_invite');
					}
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/training/application_exam_add',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function application_invited(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		
		$response = $this->emp_model->get_all_invited_exam_list($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/training/application_invited';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/training/application_invited',$data);
		$this->load->view('agadmin/layout/footer');
	}

	public function document_order(){
		$this->load->model('wing_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->wing_model->get_admin_all_circular($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/training/document_order';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/training/document_order',$data);
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
						redirect(ADMIN_BASE_URL.'training/document_order');
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
					redirect(ADMIN_BASE_URL.'training/document_order');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/training/document_order_add',$data);
		$this->load->view('agadmin/layout/footer');
	}

	public function document_order_edit(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->wing_model->getOfficeOrderByID($id);
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
							'title'		=> $this->input->post('title',true),
							'details'	=> $this->input->post('details'),
							'attachment'	=> $this->input->post('attachment'),
							'ord_year'	=>  date('Y'),
							'order_dt'	=> date('Y-m-d',strtotime($this->input->post('order_dt'))),
							'update_dt'	=> date('Y-m-d H:i:s')
						);

				$da_cadre_circular =  $this->input->post('da_cadre_circular');
				
				if($error == ''){
					if(!empty($id)){ // if record exist
						if($da_cadre_circular !=='Yes'){// edit
							$result = $this->wing_model->updateOfficeOrder($id,$update);
							$this->session->set_flashdata('success','Successfully updated.');
						}else{ // exist but add a new record
							$update['wing'] = 'da_cadre';
							$id = $this->wing_model->addOfficeOrder($update);					
							$this->session->set_flashdata('success','Successfully added.');
						}
					}else{ // if not exist, add record
						$id = $this->wing_model->addOfficeOrder($update);					
						$this->session->set_flashdata('success','Successfully added.');
					}
					redirect(ADMIN_BASE_URL.'training/document_order');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/training/document_order_edit',$data);
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
		redirect(ADMIN_BASE_URL.'training/document_order');
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
		
		$config['base_url'] = base_url().'/admin/training/office_order';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/training/office_order',$data);
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
						redirect(ADMIN_BASE_URL.'training/office_order');
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
					redirect(ADMIN_BASE_URL.'training/office_order');
				}
				
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/training/office_order_add',$data);
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
						redirect(ADMIN_BASE_URL.'training/office_order');
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
					redirect(ADMIN_BASE_URL.'training/office_order');
				}
				
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/training/office_order_edit',$data);
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
		redirect(ADMIN_BASE_URL.'training/office_order');
	}


} // End of Class