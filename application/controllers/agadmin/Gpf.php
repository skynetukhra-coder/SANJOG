<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gpf extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('common_model');
		$this->load->model('gpf_model');
		$this->load->model('emp_model');
		$this->load->model('wing_model');
		$this->load->library('form_validation');
		$this->load->helper('admin_helper');
		$this->load->helper('security');	
		$this->admin = '';
		if($this->session->userdata('admin_details')){
			$this->admin = $this->session->userdata('admin_details');
		}else{
			redirect('admin');
		}
		$this->admin_type = strtolower($this->admin['admin_type_name']);
		if($this->admin_type == 'superadmin' || $this->admin_type == 'fund'){
			
		}else{
			show_404();
		}
	}
	public function index(){
		
	}
	public function subscriber(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->gpf_model->get_admin_subscribers($limit_to);
		$data['results'] = $response['results'];
		
		$config['base_url'] = ADMIN_BASE_URL.'gpf/subscriber';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/subscriber',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function subscriber_active(){
		$id = $this->uri->segment(4);
		
		if(!empty($id)){

			$this->gpf_model->update_subscriber_active($id);
			$this->session->set_flashdata('success','The Subscriber is activated successfully.');
		}
		
//		$data['emp_data'] = $this->session->userdata('emp_data');
//		$data['header']['name'] = $data['emp_data']['empname'];		
		redirect(ADMIN_BASE_URL.'gpf/subscriber');	
	}
	public function subscriber_deactive(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$this->gpf_model->update_subscriber_deactive($id);

			$this->session->set_flashdata('success','The Subscriber is deactivated successfully.');
		}
//		$data['emp_data'] = $this->session->userdata('emp_data');
//		$data['header']['name'] = $data['emp_data']['empname'];		
		redirect(ADMIN_BASE_URL.'gpf/subscriber');	
	}
	public function subscriber_edit(){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$series = $this->uri->segment(4);
		$ac_code = $this->uri->segment(5);
		$data['row'] = array();
		if(!empty($ac_code) && !empty($series)){
			$data['row'] = $this->gpf_model->get_subscriber_data($ac_code,$series);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
		if($this->input->post()){
			$this->gpf_model->update_subscribers($ac_code,$series);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'gpf/subscriber');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/subscriber_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function subscriber_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/subscriber_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function subscriber_ajax_upload(){
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
			
			$header_security_field =  array('YEAR_FROM','YEAR_TO','SERIES','AC_CODE','MHCD','EMP_CODE','FST_NME','MID_NME','LST_NME','DOB','SEX','NM_FATHER_E','DATE_O_JOIN','BASIC_PAY','DESIG_CODE','DDOMST_DDO','NOMINATION','IN_STATE','FLAG','MINISTRY','TRY_DIV_CD','AC_STATUS','STATUS','WTH_BAL','NONWTH_BAL','SUB_NME_H','ALLOT_DT','CUR_DDO','FIN_YR','MOBILE_NO','EMAIL_ID','DOR','AUTO_ACCOUNT_NO','NOMINATION_COPY');
			
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
//					$this->db->insert_batch('subscriber_master',$bulk);
//				}
//			}else{
//				$this->db->insert_batch('subscriber_master',$upload);
//			}
			foreach($upload as $record){
				$series = isset($record['series']) ? $record['series'] : 0;
				$ac_code = isset($record['ac_code']) ? $record['ac_code'] : 0;
				// check records exists
				$res = $this->db->get_where('subscriber_master',array('series'=>$series,'ac_code'=>$ac_code));
				if($res->num_rows() > 0){
					$this->db->where('series',$series)->where('ac_code',$ac_code)->update('subscriber_master',$record);
				}else{
					$this->db->insert('subscriber_master',$record);
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
	
	public function subscribers_profile_download(){
		$this->load->model('gpf_model');
		$headings = array();
		$firstrow = array();
		$subs_profile = $this->gpf_model->get_subscribers_profile_download();
		if(!empty($subs_profile)){
			foreach( $subs_profile[0] as $k => $v ) {
					$headings[] = strtoupper($k);
					$firstrow[] = $v;
			}
			unset($subs_profile[0]);
		}
		$excel_data[] = $headings;
		$excel_data[1] = $firstrow;
		foreach( $subs_profile as $row ) {
			$row['profile_updated'] = date('d-m-Y H:i:s',strtotime($row['profile_updated']));
			$excel_data[] = $row;
		}
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Feedback');
		$this->excel->getActiveSheet()->fromArray($excel_data);
		 
		$filename='subs_profile_'.time().'.xls'; //save our workbook as this file name
		header('Content-Type: Feednacl/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}
	
	public function ledger(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->gpf_model->get_admin_ledger($limit_to);
		$data['results'] = $response['results'];
		
		$config['base_url'] = ADMIN_BASE_URL.'gpf/ledger';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/ledger',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function ledger_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/ledger_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function ledger_ajax_upload(){
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
			
			$header_security_field =  array('YEAR','SERIES','AC_CODE','MONTH','YR','SUB_MON','SUB_YEAR','SUBSCRIPTION','REFUND','OTHER','DEBIT');
			
			foreach($res['header'] as $key => $val){
				if(trim($val) != ''){ // remove empty cel 
					$val = str_replace(' ','_',strtoupper($val));
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
//					$this->db->insert_batch('gpf_ledger',$bulk);
//				}
//			}else{
//				$this->db->insert_batch('gpf_ledger',$upload);
//			}
			foreach($upload as $record){
				$series = isset($record['series']) ? $record['series'] : 0;
				$ac_code = isset($record['ac_code']) ? $record['ac_code'] : 0;
				$fyear = isset($record['fyear']) ? $record['fyear'] : 0;
				// check records exists
				$res = $this->db->get_where('gpf_ledger',array('series'=>$series,'ac_code'=>$ac_code,'fyear'=>$fyear));
				if($res->num_rows() > 0){
					$this->db->where('series',$series)->where('ac_code',$ac_code)->where('fyear',$fyear)->delete('gpf_ledger');
				}
				$this->db->insert('gpf_ledger',$record);
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
	
	public function case_status(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->gpf_model->get_admin_case_status($limit_to);
		$data['results'] = $response['results'];
		
		$config['base_url'] = ADMIN_BASE_URL.'gpf/case_status';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/case_status',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function case_status_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/case_status_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function case_status_ajax_upload(){
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
			
			$header_security_field =  array('SL_NO','F_YEAR','GPF_AC_NO','SUBS_NAME','DESIGNATION','CASE_TYPE','DT_RECEIPT','LETTER_NO_DATE','DT_INTIMATION','REFERENCE','AUTHORITY');
			
			foreach($res['header'] as $key => $val){
				if(trim($val) != ''){ // remove empty cel 
					$val = str_replace(' ','_',strtoupper($val));
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
//					$this->db->insert_batch('gpf_case_status',$bulk);
//				}
//			}else{
//				$this->db->insert_batch('gpf_case_status',$upload);
//			}
			foreach($upload as $record){
				$gpf_ac_no = isset($record['gpf_ac_no']) ? $record['gpf_ac_no'] : 0;
				$f_year = isset($record['f_year']) ? $record['f_year'] : 0;
				// check records exists
				$res = $this->db->get_where('gpf_case_status',array('gpf_ac_no'=>$gpf_ac_no,'f_year'=>$f_year));
				if($res->num_rows() > 0){
					$this->db->where('gpf_ac_no',$gpf_ac_no)->where('f_year',$f_year)->update('gpf_case_status',$record);
				}else{
					$this->db->insert('gpf_case_status',$record);
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
	
	public function part_1(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->gpf_model->get_part_1_data($limit_to);
		$data['results'] = $response['results'];
		
		$config['base_url'] = ADMIN_BASE_URL.'gpf/part_1';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/part_1',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function part_1_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/part_1_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function part_1_ajax_upload(){
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
			$header_security_field =  array('FYEAR','SERIES','AC_CODE','TRY','SUB_NAME','INT_RATE','BASIC_PAY','NOMINATION','DDO_NAME','DOB');
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
//					$this->db->insert_batch('gpf',$bulk);
//				}
//			}else{
//				$this->db->insert_batch('gpf',$upload);
//			}
			foreach($upload as $record){
				$series = isset($record['series']) ? $record['series'] : 0;
				$ac_code = isset($record['ac_code']) ? $record['ac_code'] : 0;
				$fyear = isset($record['fyear']) ? $record['fyear'] : 0;
				// check records exists
				$res = $this->db->get_where('gpf',array('series'=>$series,'ac_code'=>$ac_code,'fyear'=>$fyear));
				if($res->num_rows() > 0){
					$this->db->where('series',$series)->where('ac_code',$ac_code)->where('fyear',$fyear)->update('gpf',$record);
				}else{
					$this->db->insert('gpf',$record);
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
	
	public function part_1_temp(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->gpf_model->get_part_1_data($limit_to);
//		$response = $this->gpf_model->get_part_1_data_temp($limit_to);
		$data['results'] = $response['results'];
		
		$config['base_url'] = ADMIN_BASE_URL.'gpf/part_1';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/part_1_temp',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function part_1_upload_temp(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/part_1_upload_temp',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function part_1_ajax_upload_temp(){
		$data['results'] = array();
		if(isset($_FILES)){
			$start = microtime(true);
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
			$ins="truncate table agb_gpf_tmp";
 			$query = $this->db->query($ins);
			$total_row = count(file($file_name));
 			$file_location = str_replace("\\", "/", $file_name);
 			$csvimp = '
 			LOAD DATA LOCAL INFILE "'.$file_location.'" IGNORE 
 			INTO TABLE agb_gpf_tmp 
 			FIELDS TERMINATED BY "," 
 			ENCLOSED BY '.chr(39).chr(34).chr(39).'
 			LINES TERMINATED BY "\r\n" 
 			IGNORE 1 LINES 
			(@fyear,series,ac_code,try,sub_name,int_rate,basic_pay,nomination,ddo_name,@dob)
			set fyear = STR_TO_DATE(@fyear,"%d-%m-%Y"),
			dob = STR_TO_DATE(@dob,"%d-%m-%Y")';
			$query = $this->db->query($csvimp);
			$numrecs = $this->db->count_all("agb_gpf_tmp");
			if ($numrecs==0) {
				$csvimp = '
				LOAD DATA LOCAL INFILE "'.$file_location.'" IGNORE 
				INTO TABLE agb_gpf_tmp
				FIELDS TERMINATED BY "," 
				ENCLOSED BY '.chr(39).chr(34).chr(39).'
				LINES TERMINATED BY "\n" 
				IGNORE 1 LINES 			
				(@fyear,series,ac_code,try,sub_name,int_rate,basic_pay,nomination,ddo_name,@dob)
				set fyear = STR_TO_DATE(@fyear,"%d-%m-%Y"),
				dob = STR_TO_DATE(@dob,"%d-%m-%Y")';
				$query = $this->db->query($csvimp);
			}
		$this->db->select('fyear,series,ac_code');
			$this->db->distinct();
			$this->db->group_by('fyear,series,ac_code'); 
			$query = $this->db->get('gpf_tmp');
			foreach ($query->result() as $row) {
				$fyear=$row->fyear;
				$series=$row->series;
				$ac_code=$row->ac_code;
 			$res = $this->db->delete('agb_gpf',array('series'=>$series,'ac_code'=>$ac_code,'fyear'=>$fyear));
			}
			$ins="replace into agb_gpf (fyear,series,ac_code,try,sub_name,int_rate,basic_pay,nomination,ddo_name,dob) select fyear,series,ac_code,try,sub_name,int_rate,basic_pay,nomination,ddo_name,dob from agb_gpf_tmp";
			$query = $this->db->query($ins);
			$minutes = 0;
			$seconds = 0;
			$end = microtime(true);
			$diff = round($end - $start);
			$minutes = floor($diff / 60);
			$seconds = $diff % 60;
			$message = 'Successfully Inserted <b>'.($total_row-1).'</b> records in '.$minutes.' mintues and '.$seconds.' seconds';
			$is_success = true;
			@unlink($file_name);
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
	
	public function part_2(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->gpf_model->get_part_2_data($limit_to);
		$data['results'] = $response['results'];
		
		$config['base_url'] = ADMIN_BASE_URL.'gpf/part_2';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/part_2',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function part_2_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/part_2_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}

	public function part_2_ajax_upload(){
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
			$header_security_field =  array('FYEAR','SERIES','AC_CODE','MONTH','SUB_YEAR','SUB','USUB','REF','OTH','OTH_CAT','DR','DR_CAT');
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
//					$this->db->insert_batch('gpf_transaction',$bulk);
//				}
//			}else{
//				$this->db->insert_batch('gpf_transaction',$upload);
//			}
			$updated = array();
			foreach($upload as $record){				
				$series = isset($record['series']) ? $record['series'] : 0;
				$ac_code = isset($record['ac_code']) ? $record['ac_code'] : 0;
				$fyear = isset($record['fyear']) ? $record['fyear'] : 0;
                //$month = isset($record['month'])? $record['month'] : 0;
				// check records exists
				$flag = str_replace(' ','_',($series.$ac_code.$fyear));
				if(!in_array($flag,$updated)){
					$updated[]=$flag;
					$res = $this->db->delete('gpf_transaction',array('series'=>$series,'ac_code'=>$ac_code,'fyear'=>$fyear));
				}
				$this->db->insert('gpf_transaction',$record);
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
	public function part_2_delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->gpf_model->getPart2TranByID($id);
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->gpf_model->deletegetPart2TranByID($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'gpf/part_2');
	}
	public function part_2_temp(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->gpf_model->get_part_2_data($limit_to);
		$data['results'] = $response['results'];
		
		$config['base_url'] = ADMIN_BASE_URL.'gpf/part_2_temp';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/part_2_temp',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function part_2_upload_temp(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/part_2_upload_temp',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function part_2_ajax_upload_temp(){
		$data['results'] = array();
		if(isset($_FILES)){
			$start = microtime(true);
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
			$ins="truncate table agb_gpf_transaction_tmp";
 			$query = $this->db->query($ins);
			$total_row = count(file($file_name));
 			$file_location = str_replace("\\", "/", $file_name);
 			$csvimp = '
 			LOAD DATA LOCAL INFILE "'.$file_location.'" IGNORE 
 			INTO TABLE agb_gpf_transaction_tmp
 			FIELDS TERMINATED BY "," 
 			ENCLOSED BY '.chr(39).chr(34).chr(39).'
 			LINES TERMINATED BY "\r\n" 
 			IGNORE 1 LINES 			
			(@fyear,series,ac_code,month,sub_year,sub,usub,ref,oth,oth_cat,dr,dr_cat)
			set fyear = STR_TO_DATE(@fyear,"%d-%m-%Y")';
			$query = $this->db->query($csvimp);
			$numrecs = $this->db->count_all("agb_gpf_transaction_tmp");
			if ($numrecs==0) {
				$csvimp = '
				LOAD DATA LOCAL INFILE "'.$file_location.'" IGNORE 
				INTO TABLE agb_gpf_transaction_tmp
				FIELDS TERMINATED BY "," 
				ENCLOSED BY '.chr(39).chr(34).chr(39).'
				LINES TERMINATED BY "\n" 
				IGNORE 1 LINES 			
				(@fyear,series,ac_code,month,sub_year,sub,usub,ref,oth,oth_cat,dr,dr_cat)
				set fyear = STR_TO_DATE(@fyear,"%d-%m-%Y")';
				$query = $this->db->query($csvimp);
			}

			$this->db->select('fyear,series,ac_code,month');
			$this->db->distinct();
			$this->db->group_by('fyear,series,ac_code,month'); 
			$query = $this->db->get('gpf_transaction_tmp');
			foreach ($query->result() as $row) {
				$fyear=$row->fyear;
				$series=$row->series;
				$ac_code=$row->ac_code;
				$month=$row->month;
				$res = $this->db->delete('agb_gpf_transaction',array('series'=>$series,'ac_code'=>$ac_code,'fyear'=>$fyear,'month'=>$month));
			}	
			$ins="replace into agb_gpf_transaction (fyear,series,ac_code,month,sub_year,sub,usub,ref,oth,oth_cat,dr,dr_cat) select fyear,series,ac_code,month,sub_year,sub,usub,ref,oth,oth_cat,dr,dr_cat from agb_gpf_transaction_tmp";
			$query = $this->db->query($ins);
			$minutes = 0;
			$seconds = 0;
			$end = microtime(true);
			$diff = round($end - $start);
			$minutes = floor($diff / 60);
			$seconds = $diff % 60;
			$message = 'Successfully Inserted <b>'.($total_row-1).'</b> records in '.$minutes.' mintues and '.$seconds.' seconds';
			$is_success = true;
			@unlink($file_name);
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

	public function part_2_temp_delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->gpf_model->getPart2TranByID($id);
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->gpf_model->deletegetPart2TranByID($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'gpf/part_2_temp');
	}
	
	public function part_3(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->gpf_model->get_part_3_data($limit_to);
		$data['results'] = $response['results'];
		
		$config['base_url'] = ADMIN_BASE_URL.'gpf/part_3';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/part_3',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function part_3_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/part_3_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function part_3_ajax_upload(){
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
			$header_security_field =  array('FYEAR','SERIES','AC_CODE','OB','OBUA','DEPOSITS','UADEPOSIT','DEBIT','INTEREST','CB','CBUA','CB_IN_WORD','OBUA_IN_WORD');
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
//					$this->db->insert_batch('gpf_summary',$bulk);
//				}
//			}else{
//				$this->db->insert_batch('gpf_summary',$upload);
//			}
			foreach($upload as $record){
				$series = isset($record['series']) ? $record['series'] : 0;
				$ac_code = isset($record['ac_code']) ? $record['ac_code'] : 0;
				$fyear = isset($record['fyear']) ? $record['fyear'] : 0;
				// check records exists
				$res = $this->db->get_where('gpf_summary',array('series'=>$series,'ac_code'=>$ac_code,'fyear'=>$fyear));
				if($res->num_rows() > 0){
					$this->db->where('series',$series)->where('ac_code',$ac_code)->where('fyear',$fyear)->update('gpf_summary',$record);
				}else{
					$this->db->insert('gpf_summary',$record);
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
	
	public function part_3_temp(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->gpf_model->get_part_3_data($limit_to);
		$data['results'] = $response['results'];
		
		$config['base_url'] = ADMIN_BASE_URL.'gpf/part_3';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/part_3_temp',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function part_3_upload_temp(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/part_3_upload_temp',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function part_3_ajax_upload_temp(){
		$data['results'] = array();
		if(isset($_FILES)){
			$start = microtime(true);
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
			$ins="truncate table agb_gpf_summary_tmp";
 			$query = $this->db->query($ins);
			$total_row = count(file($file_name));
 			$file_location = str_replace("\\", "/", $file_name);
 			$csvimp = '
 			LOAD DATA LOCAL INFILE "'.$file_location.'" IGNORE 
 			INTO TABLE agb_gpf_summary_tmp 
 			FIELDS TERMINATED BY "," 
 			ENCLOSED BY '.chr(39).chr(34).chr(39).'
 			LINES TERMINATED BY "\r\n" 
 			IGNORE 1 LINES 
			(@fyear,series,ac_code,ob,obua,deposits,uadeposit,debit,interest,cb,cbua,cb_in_word,obua_in_word)
			set fyear = STR_TO_DATE(@fyear,"%d-%m-%Y")';
			$query = $this->db->query($csvimp);
			$numrecs = $this->db->count_all("agb_gpf_summary_tmp");
			if ($numrecs==0) {
				$csvimp = '
				LOAD DATA LOCAL INFILE "'.$file_location.'" IGNORE 
				INTO TABLE agb_gpf_summary_tmp
				FIELDS TERMINATED BY "," 
				ENCLOSED BY '.chr(39).chr(34).chr(39).'
				LINES TERMINATED BY "\n" 
				IGNORE 1 LINES 			
				(@fyear,series,ac_code,ob,obua,deposits,uadeposit,debit,interest,cb,cbua,cb_in_word,obua_in_word)
				set fyear = STR_TO_DATE(@fyear,"%d-%m-%Y")';
				$query = $this->db->query($csvimp);
			}
			$this->db->select('fyear,series,ac_code');
			$this->db->distinct();
			$this->db->group_by('fyear,series,ac_code'); 
			$query = $this->db->get('gpf_summary_tmp');
			foreach ($query->result() as $row) {
				$fyear=$row->fyear;
				$series=$row->series;
				$ac_code=$row->ac_code;
 			$res = $this->db->delete('agb_gpf_summary',array('series'=>$series,'ac_code'=>$ac_code,'fyear'=>$fyear));
			}
			$ins="replace into agb_gpf_summary (fyear,series,ac_code,ob,obua,deposits,uadeposit,debit,interest,cb,cbua,cb_in_word,obua_in_word) select fyear,series,ac_code,ob,obua,deposits,uadeposit,debit,interest,cb,cbua,cb_in_word,obua_in_word from agb_gpf_summary_tmp";
			$query = $this->db->query($ins);
			$minutes = 0;
			$seconds = 0;
			$end = microtime(true);
			$diff = round($end - $start);
			$minutes = floor($diff / 60);
			$seconds = $diff % 60;
			$message = 'Successfully Inserted <b>'.($total_row-1).'</b> records in '.$minutes.' mintues and '.$seconds.' seconds';
			$is_success = true;
			@unlink($file_name);
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
	
	public function part_4(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->gpf_model->get_part_4_data($limit_to);
		$data['results'] = $response['results'];
		
		$config['base_url'] = ADMIN_BASE_URL.'gpf/part_4';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/part_4',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function part_4_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/part_4_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function part_4_ajax_upload(){
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
			$header_security_field =  array('FYEAR','SERIES','AC_CODE','MONTH');
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
//					$this->db->insert_batch('gpf_missing_credits',$bulk);
//				}
//			}else{
//				$this->db->insert_batch('gpf_missing_credits',$upload);
//			}
			foreach($upload as $record){
				$series = isset($record['series']) ? $record['series'] : 0;
				$ac_code = isset($record['ac_code']) ? $record['ac_code'] : 0;
				$fyear = isset($record['fyear']) ? $record['fyear'] : 0;
				// check records exists
				$res = $this->db->get_where('gpf_missing_credits',array('series'=>$series,'ac_code'=>$ac_code,'fyear'=>$fyear));
				if($res->num_rows() > 0){
					$this->db->where('series',$series)->where('ac_code',$ac_code)->where('fyear',$fyear)->delete('gpf_missing_credits');
				}
				$this->db->insert('gpf_missing_credits',$record);
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
		
	public function part_4_temp(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->gpf_model->get_part_4_data($limit_to);
//		$response = $this->gpf_model->get_part_4_data_temp($limit_to);
		$data['results'] = $response['results'];
		
		$config['base_url'] = ADMIN_BASE_URL.'gpf/part_4';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/part_4_temp',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function part_4_upload_temp(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/part_4_upload_temp',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function part_4_ajax_upload_temp(){
		$data['results'] = array();
		if(isset($_FILES)){
			$start = microtime(true);
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
			$ins="truncate table agb_gpf_missing_credits_tmp";
 			$query = $this->db->query($ins);
			$total_row = count(file($file_name));
 			$file_location = str_replace("\\", "/", $file_name);
 			$csvimp = '
 			LOAD DATA LOCAL INFILE "'.$file_location.'" IGNORE 
 			INTO TABLE agb_gpf_missing_credits_tmp 
 			FIELDS TERMINATED BY "," 
 			ENCLOSED BY '.chr(39).chr(34).chr(39).'
 			LINES TERMINATED BY "\r\n" 
 			IGNORE 1 LINES 
			(@fyear,series,ac_code,month)
			set fyear = STR_TO_DATE(@fyear,"%d-%m-%Y")';
			$query = $this->db->query($csvimp);
			$numrecs = $this->db->count_all("agb_gpf_missing_credits_tmp");
			if ($numrecs==0) {
				$csvimp = '
				LOAD DATA LOCAL INFILE "'.$file_location.'" IGNORE 
				INTO TABLE agb_gpf_missing_credits_tmp
				FIELDS TERMINATED BY "," 
				ENCLOSED BY '.chr(39).chr(34).chr(39).'
				LINES TERMINATED BY "\n" 
				IGNORE 1 LINES 			
				(@fyear,series,ac_code,month)
				set fyear = STR_TO_DATE(@fyear,"%d-%m-%Y")';
				$query = $this->db->query($csvimp);
			}
			$this->db->select('fyear,series,ac_code');
			$this->db->distinct();
			$this->db->group_by('fyear,series,ac_code'); 
			$query = $this->db->get('gpf_missing_credits_tmp');
			foreach ($query->result() as $row) {
				$fyear=$row->fyear;
				$series=$row->series;
				$ac_code=$row->ac_code;
 			$res = $this->db->delete('agb_gpf_missing_credits',array('series'=>$series,'ac_code'=>$ac_code,'fyear'=>$fyear));
			}
			$ins="replace into agb_gpf_missing_credits (fyear,series,ac_code,month) select fyear,series,ac_code,month from agb_gpf_missing_credits_tmp";
			$query = $this->db->query($ins);
			$minutes = 0;
			$seconds = 0;
			$end = microtime(true);
			$diff = round($end - $start);
			$minutes = floor($diff / 60);
			$seconds = $diff % 60;
			$message = 'Successfully Inserted <b>'.($total_row-1).'</b> records in '.$minutes.' mintues and '.$seconds.' seconds';
			$is_success = true;
			@unlink($file_name);
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
	public function part_5(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->gpf_model->get_part_5_data($limit_to);
		$data['results'] = $response['results'];
		
		$config['base_url'] = ADMIN_BASE_URL.'gpf/part_5';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/part_5',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function part_5_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/part_5_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function part_5_ajax_upload(){
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
			$header_security_field =  array('SERIES','IMG','PATH');
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
//					$this->db->insert_batch('gpf_section',$bulk);
//				}
//			}else{
//				$this->db->insert_batch('gpf_section',$upload);
//			}
			foreach($upload as $record){
				$series = isset($record['series']) ? $record['series'] : 0;
				// check records exists
				$res = $this->db->get_where('gpf_section',array('series'=>$series));
				if($res->num_rows() > 0){
					$this->db->where('series',$series)->update('gpf_section',$record);
				}else{
					$this->db->insert('gpf_section',$record);
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
	public function part_5_temp(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->gpf_model->get_part_5_data($limit_to);
		$data['results'] = $response['results'];
		
		$config['base_url'] = ADMIN_BASE_URL.'gpf/part_5_temp';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/part_5_temp',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function part_5_upload_temp(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/part_5_upload_temp',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function part_5_ajax_upload_temp(){
		$data['results'] = array();
		if(isset($_FILES)){
			$start = microtime(true);
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
			$ins="truncate table agb_gpf_section_tmp";
 			$query = $this->db->query($ins);
			$total_row = count(file($file_name));
 			$file_location = str_replace("\\", "/", $file_name);
 			$csvimp = '
 			LOAD DATA LOCAL INFILE "'.$file_location.'" IGNORE 
 			INTO TABLE agb_gpf_section_tmp 
 			FIELDS TERMINATED BY "$" 
 			ENCLOSED BY '.chr(39).chr(34).chr(39).'
 			LINES TERMINATED BY "\r\n" 
 			IGNORE 1 LINES 
			(@fyear,series,ac_code,month)
			set fyear = STR_TO_DATE(@fyear,"%d-%m-%Y")';
			$query = $this->db->query($csvimp);
			$this->db->select('fyear,series,ac_code');
			$this->db->distinct();
			$this->db->group_by('fyear,series,ac_code'); 
			$query = $this->db->get('gpf_missing_credits_tmp');
			foreach ($query->result() as $row) {
				$fyear=$row->fyear;
				$series=$row->series;
				$ac_code=$row->ac_code;
 			//$res = $this->db->delete('agb_gpf_section',array('series'=>$series,'ac_code'=>$ac_code,'fyear'=>$fyear));
			}
			//$ins="replace into agb_gpf_section (fyear,series,ac_code,month) select fyear,series,ac_code,month from agb_gpf_missing_credits_tmp";
			$query = $this->db->query($ins);
			$minutes = 0;
			$seconds = 0;
			$end = microtime(true);
			$diff = round($end - $start);
			$minutes = floor($diff / 60);
			$seconds = $diff % 60;
			$message = 'Successfully Inserted <b>'.($total_row-1).'</b> records in '.$minutes.' mintues and '.$seconds.' seconds';
			$is_success = true;
			@unlink($file_name);
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
	public function tax_nontax(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->gpf_model->get_gpf_tax_data($limit_to);
		$data['results'] = $response['results'];
		
		$config['base_url'] = ADMIN_BASE_URL.'gpf/tax_nontax';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/tax_nontax',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function tax_nontax_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/tax_nontax_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function tax_nontax_ajax_upload(){
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
			$header_security_field =  array('FYEAR','SERIES','ACCODE','OB_NT','DEP_NT','WITH_NT','INT_NT','CB_NT','OB_T','DEP_T','WITH_T','INT_T','CB_T','TOT_OB','TOT_DEP','TOT_WITH','TOT_INT','TOT_CB','UA_OB','UA_DEP','UA_CB','TOT_CB_IN_WRD','UA_CB_IN_WRD');
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
//					$this->db->insert_batch('gpf_tax_nontax',$bulk);
//				}
//			}else{
//				$this->db->insert_batch('gpf_tax_nontax',$upload);
//			}
			$updated = array();
			foreach($upload as $record){				
				$fyear = isset($record['fyear']) ? $record['fyear'] : 0;
				$series = isset($record['series']) ? $record['series'] : 0;
				$accode = isset($record['accode']) ? $record['accode'] : 0;
                //$month = isset($record['month'])? $record['month'] : 0;
				// check records exists
				$flag = str_replace(' ','_',($series.$accode.$fyear));
				if(!in_array($flag,$updated)){
					$updated[]=$flag;
					$res = $this->db->delete('gpf_tax_nontax',array('fyear'=>$fyear,'series'=>$series,'accode'=>$accode));
				}
				$this->db->insert('gpf_tax_nontax',$record);
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
	
	public function rate_of_interest(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->gpf_model->get_rate_of_interest($limit_to);
		$data['results'] = $response['results'];
		
		$config['base_url'] = ADMIN_BASE_URL.'gpf/rate_of_interest';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/rate_of_interest',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function rate_of_interest_ajax_upload(){
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
			$header_security_field =  array('INTRST_LETTERNO','INTRST_DATE','INTRST_RATE','INTRST_FROM','UPDATE_BY','UPDATE_DATE','AUTHORISED_BY','AUTHORISED_DATE','STATUS','INTRST_TO');
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
//					$this->db->insert_batch('rate_of_interest',$bulk);
//				}
//			}else{
//				$this->db->insert_batch('rate_of_interest',$upload);
//			}
			foreach($upload as $record){
				$intrst_from = isset($record['intrst_from']) ? $record['intrst_from'] : 0;
				// check records exists
				$res = $this->db->get_where('rate_of_interest',array('intrst_from'=>$intrst_from));
				if($res->num_rows() > 0){
					$this->db->where('intrst_from',$intrst_from)->update('rate_of_interest',$record);
				}else{
					$this->db->insert('rate_of_interest',$record);
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
	
	public function ddo(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->gpf_model->get_admin_ddo($limit_to);
		$data['results'] = $response['results'];
		
		$config['base_url'] = ADMIN_BASE_URL.'gpf/ddo';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/ddo',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function ddo_edit(){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->gpf_model->get_ddo_profile($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
		if($this->input->post()){
			$this->gpf_model->update_ddo_profile($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'gpf/ddo');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/ddo_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function ddo_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/ddo_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function ddo_ajax_upload(){
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
			$header_security_field =  array('DDO_CD','DDO_DESC','TR_CD','PASSWORD','EMAILID','MB_NO');
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
//					$this->db->insert_batch('ddo_master',$bulk);
//				}
//			}else{
//				$this->db->insert_batch('ddo_master',$upload);
//			}
			foreach($upload as $record){
				$ddo_cd = isset($record['ddo_cd']) ? $record['ddo_cd'] : 0;
				// check records exists
				$res = $this->db->get_where('ddo_master',array('ddo_cd'=>$ddo_cd));
				if($res->num_rows() > 0){
					$this->db->where('ddo_cd',$ddo_cd)->update('ddo_master',$record);
				}else{
					$this->db->insert('ddo_master',$record);
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
	
	public function fp_authority(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->gpf_model->get_admin_fp_authority($limit_to);
		$data['results'] = $response['results'];
		$config['base_url'] = ADMIN_BASE_URL.'gpf/fp_authority';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/fp_authority',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function fp_authority_edit(){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->gpf_model->get_ddo_profile($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
		if($this->input->post()){
			$this->gpf_model->update_ddo_profile($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'gpf/ddo');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/ddo_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function fp_authority_details($id = ''){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		if($id == ''){
			$res =  array('success'=>false,'msg'=>'No data found!','details'=>array());
			echo json_encode($res);
		}
		$response = $this->gpf_model->get_fp_authority_by_request_no($id);
		$res = array('success'=>true,'msg'=>'Case status details','details'=>$response);
		echo json_encode($res);
	}
	public function fp_authority_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/fp_authority_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
/*
	public function fp_authority_ajax_upload(){
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
			$header_security_field =  array('REQUEST_NO','REQUEST_DATE','AUTHORITY_NO','AUTHORITY_GEN_DATE','SERIES','AC_CODE','SUBSCRIBER_NAME','ALIAS_NAME','SUBSCRIBER_CLAIMANT_ADDRESS','ALOC_SEC','DDO_CODE','DDO_NAME','DDO_ADDRESS','TRY_CODE','TRY_NAME','TRY_ADDRESS','AMT_TOPAY','FP_AMT_WORDS','DRCR_HEAD','NOT_PAYABLEBEFORE_DATE','LETTER_NO','LETTER_DATE','RETIREMENT_TYPE','RULE_NO','NOMINEE_NAME','NOM_SH_DETAILS','NOM_TYPE','NOMINEE_GUARDIAN_NAME','AUTHORISED_BY_DTL','AUTHORISED_DATE_DTL','AUTHORISED_BY','AUTHORISED_DATE');
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
//					$this->db->insert_batch('ddo_master',$bulk);
//				}
//			}else{
//				$this->db->insert_batch('ddo_master',$upload);
//			}
			foreach($upload as $record){
				$cond = array();
				$cond['authority_no'] = isset($record['authority_no']) ? $record['authority_no'] : '';
				if($record['nominee_name'] != ''){
					$cond['nominee_name'] = $record['nominee_name'];
				}
				if($record['nominee_guardian_name'] != ''){
					$cond['nominee_guardian_name'] = $record['nominee_guardian_name'];
				}
				// check records exists
				$res = $this->db->get_where('gpf_fp_authority',$cond);
				if($res->num_rows() > 0){
					$this->db->where($cond)->update('gpf_fp_authority',$record);
				}else{
					$this->db->insert('gpf_fp_authority',$record);
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
*/
	//Hirani
	public function fp_authority_ajax_upload(){
		$data['results'] = array();
		if(isset($_FILES)){
			$start = microtime(true);
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
			//$res = $this->spreadsheet->read_file($file_name);
			$total_row = count(file($file_name));
 			$file_location = str_replace("\\", "/", $file_name);
			$csvimp = '
 			LOAD DATA LOCAL INFILE "'.$file_location.'" IGNORE 
 			INTO TABLE agb_gpf_fp_authority
 			FIELDS TERMINATED BY "," 
 			ENCLOSED BY '.chr(39).chr(34).chr(39).'
 			LINES TERMINATED BY "\r\n" 
 			IGNORE 1 LINES 
			(request_no,@request_date,authority_no,@authority_gen_date,series,ac_code,subscriber_name,alias_name,subscriber_claimant_address,aloc_sec,ddo_code,ddo_name,ddo_address,try_code,try_name,try_address,amt_topay,fp_amt_words,drcr_head,@not_payablebefore_date,letter_no,@letter_date,retirement_type,rule_no,nominee_name,nom_sh_details,nom_type,nominee_guardian_name,authorised_by_dtl,@authorised_date_dtl,authorised_by,@authorised_date,final_amt)
			set request_date = STR_TO_DATE(@request_date,"%d-%m-%Y"),
			authority_gen_date = STR_TO_DATE(@authority_gen_date,"%d-%m-%Y"),
			not_payablebefore_date = STR_TO_DATE(@not_payablebefore_date,"%d-%m-%Y"),
			letter_date = STR_TO_DATE(@letter_date,"%d-%m-%Y"),
			authorised_by_dtl = STR_TO_DATE(@authorised_by_dtl,"%d-%m-%Y"),
			authorised_date = STR_TO_DATE(@authorised_date,"%d-%m-%Y")';
			$query = $this->db->query($csvimp);
			$csvimp = '
 			LOAD DATA LOCAL INFILE "'.$file_location.'" IGNORE 
 			INTO TABLE agb_gpf_fp_authority
 			FIELDS TERMINATED BY "," 
 			ENCLOSED BY '.chr(39).chr(34).chr(39).'
 			LINES TERMINATED BY "\n" 
 			IGNORE 1 LINES 
			(request_no,@request_date,authority_no,@authority_gen_date,series,ac_code,subscriber_name,alias_name,subscriber_claimant_address,aloc_sec,ddo_code,ddo_name,ddo_address,try_code,try_name,try_address,amt_topay,fp_amt_words,drcr_head,@not_payablebefore_date,letter_no,@letter_date,retirement_type,rule_no,nominee_name,nom_sh_details,nom_type,nominee_guardian_name,authorised_by_dtl,@authorised_date_dtl,authorised_by,@authorised_date,final_amt)
			set request_date = STR_TO_DATE(@request_date,"%d-%m-%Y"),
			authority_gen_date = STR_TO_DATE(@authority_gen_date,"%d-%m-%Y"),
			not_payablebefore_date = STR_TO_DATE(@not_payablebefore_date,"%d-%m-%Y"),
			letter_date = STR_TO_DATE(@letter_date,"%d-%m-%Y"),
			authorised_by_dtl = STR_TO_DATE(@authorised_by_dtl,"%d-%m-%Y"),
			authorised_date = STR_TO_DATE(@authorised_date,"%d-%m-%Y")';
			$query = $this->db->query($csvimp);
			$minutes = 0;
			$seconds = 0;
			$end = microtime(true);
			$diff = round($end - $start);
			$minutes = floor($diff / 60);
			$seconds = $diff % 60;
			$message = 'Successfully Inserted <b>'.($total_row-1).'</b> records in '.$minutes.' mintues and '.$seconds.' seconds';
			$is_success = true;
			@unlink($file_name);
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
	//Hirani

	public function circular_office_order(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->wing_model->get_gpf_circular_office_order($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/gpf/circular_office_order';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/circular_office_order',$data);
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
			$this->form_validation->set_rules('description', 'Description', 'required');
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
					redirect(ADMIN_BASE_URL.'gpf/circular_office_order');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/circular_office_order_add',$data);
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
		redirect(ADMIN_BASE_URL.'gpf/circular_office_order');
	}
	public function circular_office_order_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/circular_office_order_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function circular_office_order_ajax_upload(){
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
			
			$header_security_field =  array('SL_NO','F_YEAR','DATE','WING','DESCRIPTION','PDF_NAME');
			
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
			$bulk_elem = 10;
			$bulk_upload = array();
			if( count($upload) > $bulk_elem ){
				$bulk_upload = array_chunk($upload,$bulk_elem);
				foreach($bulk_upload as $bulk){
					$this->db->insert_batch('circular_office_order',$bulk);
				}
			}else{
				$this->db->insert_batch('circular_office_order',$upload);
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
	

	public function office_order(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->wing_model->get_fund_office_order($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/gpf/office_order';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/office_order',$data);
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
			$this->form_validation->set_rules('wing', 'Wing', 'required');
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
					$upload_details = $this->common_model->upload_multiple_order_cicular('attachment');
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
						redirect(ADMIN_BASE_URL.'gpf/office_order');
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
					redirect(ADMIN_BASE_URL.'gpf/office_order');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/office_order_add',$data);
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
			$this->form_validation->set_rules('wing', 'Wing', 'required');
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
					$upload_details = $this->common_model->upload_office_order('attachment');
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
						redirect(ADMIN_BASE_URL.'gpf/office_order');
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
					redirect(ADMIN_BASE_URL.'gpf/office_order');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/office_order_edit',$data);
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
		redirect(ADMIN_BASE_URL.'gpf/office_order');
	}
	public function order_employee(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_employees_issued_office_order($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/gpf/order_employee';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/order_employee',$data);
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
		$response = $this->wing_model->get_fund_all_circular($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/gpf/document_order';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/document_order',$data);
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
					//$upload_details = $this->common_model->upload_office_order('attachment');
					$upload_details = $this->common_model->upload_multiple_order_cicular('attachment');
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
						redirect(ADMIN_BASE_URL.'gpf/document_order');
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
					redirect(ADMIN_BASE_URL.'gpf/document_order');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/document_order_add',$data);
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
		redirect(ADMIN_BASE_URL.'gpf/document_order');
	}
	
	public function upload_files(){
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/upload_files');
		$this->load->view('agadmin/layout/footer');
	}
	
	
	//------------feedback		
	public function feedback(){
		$this->load->model('common_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->common_model->all_fund_feedback($page_no);
		$data['results'] = $response['results'];
		
		$data['all_groups'] = $this->common_model->get_all_groups();
		
		$config['base_url'] = base_url().'/admin/gpf/feedback';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/feedback',$data);
		$this->load->view('agadmin/layout/footer');
	}

	public function feedback_action(){
		$this->load->model('common_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->common_model->feedback_details($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
		if($this->input->post()){
			$this->common_model->update_fund_feedback_action($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'gpf/feedback');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/feedback_action',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function feedback_download(){
		$this->load->model('common_model');
		$headings = array();
		$firstrow = array();
		$all_feedbacks = $this->common_model->get_feedback_download('AGAE');
		if(!empty($all_feedbacks)){
//			unset($all_feedbacks[0]['feed_id']);
			foreach( $all_feedbacks[0] as $k => $v ) {
					$headings[] = strtoupper($k);
					$firstrow[] = $v;
			}
			unset($all_feedbacks[0]);
		}
		$excel_data[] = $headings;
		$excel_data[1] = $firstrow;
		foreach( $all_feedbacks as $row ) {
//			unset($row['feed_id']);
			$row['feed_date'] = date('d-m-Y  A',strtotime($row['feed_date']));
			$excel_data[] = $row;
		}
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Feedback');
		$this->excel->getActiveSheet()->fromArray($excel_data);
		 
		$filename='Feedbacks_'.time().'.xls'; //save our workbook as this file name
		header('Content-Type: Feednacl/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}
		public function feedback_download_pdf() { 
		$this->load->library('m_pdf');
		$this->load->model('common_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->common_model->feedback_details($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$html = $this->load->view('agadmin/pages/gpf/feedback_pdf',$data,true);//load the pdf_output.php by passing our data and get all data in $html varriable.
		$pdfFilePath ="Feedback_".$feed_id.".pdf";

		$pdf = $this->m_pdf->generate();
		$pdf->SetWatermarkText('O/o the Pr. Accountant General (A&E), WB');
		$pdf->watermark_font = 'DejaVuSansCondensed';
		$pdf->watermarkTextAlpha = 0.1;
		$pdf->showWatermarkText = true;
		$pdf->WriteHTML($html);
		$pdf->Output($pdfFilePath, "D");
//		$pdf->Output();
    }

	public function epabx_list(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_epabx_extension_list_fund($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/gpf/epabx_list';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/epabx_list',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function epabx_list_edit(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->epabx_extension_list_edit($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
		$data['section_list'] = $this->emp_model->get_all_section_list();
		if($this->input->post()){
			$this->emp_model->update_epabx_extension($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'gpf/epabx_list');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/epabx_list_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function ddo_document(){
		$this->load->model('gpf_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
//		$data['ddo_list'] = $this->gpf_model->get_all_ddo_list();
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->gpf_model->get_all_ddo_documents($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/gpf/ddo_document';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/ddo_document',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function ddo_document_edit(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->gpf_model->get_ddo_file_by_id($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
		if($this->input->post()){
			$this->gpf_model->update_ddo_files_record_by_id($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'gpf/ddo_document');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/ddo_document_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function signature_master(){
		$this->load->model('gpf_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->gpf_model->get_all_bos_signatures($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/gpf/signature_master';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/signature_master',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function signature_master_new(){
		$this->load->model('gpf_model');
				
		$data = $this->gpf_model->get_last_signature_id();
		if($this->input->post()){
			$sec_off_id= $this->input->post('sec_off_id',true);
		}else{
			$sec_off_id= $data['max_id']+1;		
			$this->db->insert('gpf_series_signature',array('sec_off_id'=>$sec_off_id,'desig_code'=>'BO','officer_desig'=>'Branch Officer'));
		}
		
		$id = $sec_off_id;
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->gpf_model->getSignatureTagByID($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$data['series_codes'] = $this->gpf_model->get_all_series_code();
		$error = '';
		
		if($this->input->post()){
			$this->form_validation->set_rules('desig_code', 'Desig Code', 'required');			
			$this->form_validation->set_rules('officer_desig', 'Officer-Designation', 'required');
			$this->form_validation->set_rules('officer_name', 'Officer-Name', 'required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				$update = array(
							'series'			=> $this->input->post('series',true),
							'statement_year'	=>date('Y-m-d',strtotime($this->input->post('statement_year',true))),
							'officer_name'		=> $this->input->post('officer_name',true),
							'officer_name_hindi'=> $this->input->post('officer_name_hindi',true),
							'update_dt'			=> date('Y-m-d H:i:s'),
						);
						

				if(isset($_FILES['sign_tag']) && $_FILES['sign_tag']['size'][0] > 0){
					//upload file				
					$upload_details = $this->common_model->upload_signature('sign_tag');

					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
						redirect(ADMIN_BASE_URL.'gpf/signature_master');
					}else{
						$update['sign_tag'] = implode(';',$upload_details['filenames']);
					}

				}else{
						$update['sign_tag'] = trim($this->input->post('sign_tag_text',true));
				}

				if($error == ''){
					if(!empty($id)){ // edit
						$result = $this->gpf_model->updateSignatureTag($id,$update);
						$this->session->set_flashdata('success','Successfully updated.');
					}else{
						$id = $this->gpf_model->addSignatureTag($update);
						$this->session->set_flashdata('success','Successfully added.');
					}
					redirect(ADMIN_BASE_URL.'gpf/signature_master');
				}
			}
		}
		
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/signature_master_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}	
		
	public function signature_master_edit(){
		$this->load->model('gpf_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->gpf_model->getSignatureTagByID($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$data['series_codes'] = $this->gpf_model->get_all_series_code();
		$error = '';
		
		if($this->input->post()){
			$this->form_validation->set_rules('desig_code', 'Desig Code', 'required');			
			$this->form_validation->set_rules('officer_desig', 'Officer-Designation', 'required');
			$this->form_validation->set_rules('officer_name', 'Officer-Name', 'required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				$update = array(
							'series'			=> $this->input->post('series',true),
							'statement_year'	=>date('Y-m-d',strtotime($this->input->post('statement_year',true))),
							'officer_name'		=> $this->input->post('officer_name',true),
							'officer_name_hindi'=> $this->input->post('officer_name_hindi',true),
							'update_dt'			=> date('Y-m-d H:i:s'),
						);
						

				if(isset($_FILES['sign_tag']) && $_FILES['sign_tag']['size'][0] > 0){
					//upload file				
					$upload_details = $this->common_model->upload_signature('sign_tag');

					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
						redirect(ADMIN_BASE_URL.'gpf/signature_master');
					}else{
						$update['sign_tag'] = implode(';',$upload_details['filenames']);
					}

				}else{
						$update['sign_tag'] = trim($this->input->post('sign_tag_text',true));
				}

				if($error == ''){
					if(!empty($id)){ // edit
						$result = $this->gpf_model->updateSignatureTag($id,$update);
						$this->session->set_flashdata('success','Successfully updated.');
					}else{
						$id = $this->gpf_model->addSignatureTag($update);
						$this->session->set_flashdata('success','Successfully added.');
					}
					redirect(ADMIN_BASE_URL.'gpf/signature_master');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/signature_master_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function training(){
		$this->load->model('gpf_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->gpf_model->employee_trainings($page_no);
		$data['results'] = $response['results'];
				
		$config['base_url'] = base_url().'/admin/gpf/training';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/training',$data);
		$this->load->view('agadmin/layout/footer');
	}	
	public function section_transfer(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->gpf_model->get_transfer_master($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/gpf/section_transfer';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/section_transfer',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function section_transfer_new(){
		$this->load->model('emp_model');
		/*
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		
		*/
		
		$data = $this->emp_model->get_last_transfer_order_id();
				
		if($this->input->post()){
			$ins_id= $this->input->post('trans_ord_id',true);
		}else{
			$ins_id= date('Y').date('m').$data['max_id']+1;		
			$this->db->insert('section_transfer_master',array('transf_order_id'=>$ins_id));
		}
		
		$data['employees'] = $this->emp_model->get_all_employee_list();

		$data['designation'] = array();
		foreach($data['employees'] as $val){
			if(!in_array($val['desig'],$data['designation'])){
				$data['designation'][] = $val['desig'];
			}			
		}
		$id = $ins_id;
		
		$data['row'] = array();
		$data['asign_emp'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->getTransferOrderByID($id);
			$data['asign_emp'] = $this->emp_model->getTransferOrderToEmployees($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}

		$error = '';
		if($this->input->post()){

			$this->form_validation->set_rules('trans_ord_id', 'Transfer Order Id', 'required');
			$this->emp_model->update_transfer_order_master($id);
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				$update = array(
							'trans_ord_id'		=> $this->input->post('trans_ord_id',true),
							'trans_year'	    => $this->input->post('transf_year'),
							'trans_month'	    => $this->input->post('transf_month'),
							'trans_order_no'	=> $this->input->post('transf_order_no'),
							'trans_order_dt'	=> date('Y-m-d',strtotime($this->input->post('transf_order_dt'))),
							'trans_type'	    => $this->input->post('transf_type'),
							'order_group'	    => $this->input->post('transf_group'),
							'description'	    => $this->input->post('description'),
							'update_dt'			=> date('Y-m-d H:i:s')
						);

				if(isset($_FILES['attachment']) && $_FILES['attachment']['size'][0] > 0){
					//upload file
					$upload_details = $this->common_model->upload_department_files_admin('attachment');		// upload_multiple_file
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
						redirect(ADMIN_BASE_URL.'gpf/section_transfer_record');
					}else{
						$update['pdf_name'] = implode(';',$upload_details['filenames']);
					}
				}

				$autho = $this->input->post('transf_sign_autho',true);				
				$emp_concerned = $this->input->post('emp_concerned');
				$empid=key($emp_concerned);
	
				if($error == ''){
					
					if(!empty($id)){ // edit
						$this->emp_model->update_transfer_order_to_employee($id,$emp_concerned);
						$emp_tr_id = $this->emp_model->emp_section_transfer_details_record($id,$emp_concerned,$autho);
						$this->session->set_flashdata('success','Successfully updated and SMS sent.');						
					}else{ // add	
						$this->emp_model->add_transfer_order_to_employee($id,$emp_concerned);
						$emp_tr_id = $this->emp_model->emp_section_transfer_details_record($id,$emp_concerned,$autho);
						$this->session->set_flashdata('success','Successfully allotted and SMS sent.');
					}
					redirect(ADMIN_BASE_URL.'gpf/section_transfer_record');
				}
			}
		}
		
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/section_transfer_assignment',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function section_transfer_assignment(){
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
			$data['row'] = $this->emp_model->getTransferOrderByID($id);
			$data['asign_emp'] = $this->emp_model->getTransferOrderToEmployees($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$error = '';
		if($this->input->post()){
			$this->form_validation->set_rules('trans_ord_id', 'Transfer Order Id', 'required');
			$this->emp_model->update_transfer_order_master($id);
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				$update = array(
							'trans_ord_id'		=> $this->input->post('trans_ord_id',true),
							'trans_year'	    => $this->input->post('transf_year'),
							'trans_month'	    => $this->input->post('transf_month'),
							'trans_order_no'	=> $this->input->post('transf_order_no'),
							'trans_order_dt'	=> date('Y-m-d',strtotime($this->input->post('transf_order_dt'))),
							'trans_type'	    => $this->input->post('transf_type'),
							'order_group'	    => $this->input->post('transf_group'),
							'description'	    => $this->input->post('description'),
							'update_dt'			=> date('Y-m-d H:i:s')
						);
				if(isset($_FILES['attachment']) && $_FILES['attachment']['size'][0] > 0){
					//upload file
					$upload_details = $this->common_model->upload_department_files_admin('attachment');		// upload_multiple_file
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
						redirect(ADMIN_BASE_URL.'gpf/section_transfer_record');
					}else{
						$update['pdf_name'] = implode(';',$upload_details['filenames']);
					}
				}
				$id = $this->input->post('trans_ord_id',true);
				$autho = $this->input->post('transf_sign_autho',true);
				$emp_concerned = $this->input->post('emp_concerned');
				$empid=key($emp_concerned);
				if($error == ''){
					if(!empty($id)){ // edit
						$this->emp_model->update_transfer_order_to_employee($id,$emp_concerned);
						$emp_tr_id = $this->emp_model->emp_section_transfer_details_record($id,$emp_concerned,$autho);
						$this->session->set_flashdata('success','Successfully updated and SMS sent.');						
					}else{ // add			
						$this->emp_model->add_transfer_order_to_employee($id,$emp_concerned);
						$emp_tr_id = $this->emp_model->emp_section_transfer_details_record($id,$emp_concerned,$autho);
						$this->session->set_flashdata('success','Successfully allotted and SMS sent.');
					}
					redirect(ADMIN_BASE_URL.'gpf/section_transfer_record');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/section_transfer_assignment',$data);
		$this->load->view('agadmin/layout/footer');
	}
		
	public function section_transfer_record(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['transf_ids'] = $this->emp_model->get_all_transfer_ids();
		$t_id = $this->emp_model->get_max_transfer_order_id();
		$t_id = $t_id['max_id'];
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->gpf_model->get_employee_transfer_records($page_no,$t_id);
		$data['results'] = $response['results'];
		$config['base_url'] = base_url().'/admin/gpf/section_transfer_record';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/section_transfer_record',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function section_transfer_record_edit(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['sections_list'] = $this->emp_model->get_all_sections();
		$data['branches'] = $this->emp_model->get_all_branches();
		$data['groups'] = array();
		foreach($data['sections_list'] as $val){
			if(!in_array($val['sec_br_group'],$data['groups'])){
				$data['groups'][] = $val['sec_br_group'];
			}			
		}
		$id = $this->uri->segment(4);
		$data['join_officers'] = $this->emp_model->get_joining_authorities();
		$data['jGroup'] = array();
		foreach($data['join_officers'] as $val){
			if(!in_array($val['group_name'],$data['jGroup'])){
				$data['jGroup'][] = $val['group_name'];
			}			
		}
	
		$data['section_list'] = $this->emp_model->get_all_section_list();
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->get_admin_transfer_details_by_id($id);
			$data['asign_emp'] = $this->emp_model->getTransferOrderToEmployees($id);  // required to update
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
		$data['section_group'] = $this->emp_model->getSectionGroupOfEmployeeByID($data['row']['emp_id']);	
		$data['relea_officers'] = $this->emp_model->get_releasing_authorities($data['section_group']['group_name']);
		
		$data['emp_section'] = $this->emp_model->getSection_of_Employees($data['row']['emp_id']);
		$data['emp_branch'] = $this->emp_model->getBranch_BO_Employees($data['row']['emp_id']);

		$error = '';
		if($this->input->post()){
			$this->form_validation->set_rules('emp_id', 'EMP ID', 'required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				
				$emp_section = $this->input->post('emp_section');
				$emp_branch = $this->input->post('emp_branch');
				$empid = $this->input->post('emp_id',true);
				$mobile = $this->input->post('mbno');
				$staff_type = $this->input->post('staff_type',true);
			if($error == ''){
					if(!empty($id)){ // edit
						/*
						if($this->input->post('charge_type')=='Additional'||$this->input->post('charge_type')=='Link'){
							$this->emp_model->add_section_to_employee($empid,$emp_section);
							$this->emp_model->add_branch_to_incharge($empid,$emp_branch);
						}else{
							$this->emp_model->update_section_to_employee($empid,$emp_section);
							$this->emp_model->update_branch_to_incharge($empid,$emp_branch);
						} */
						$this->emp_model->update_section_to_employee($empid,$emp_section);
						$this->emp_model->update_branch_to_incharge($empid,$emp_branch);
						$this->emp_model->update_transfer_order_record($id,$emp_section,$mobile);
						$emp_tr_id = $this->emp_model->emp_section_allotment_details_add($empid,$emp_section,$emp_branch,$staff_type);		//emp_section_allotment_details_update
			
	
						$this->session->set_flashdata('success','Successfully updated.');						
					}else{ // add 	
						$this->emp_model->add_section_to_employee($empid,$emp_section);
						$this->emp_model->add_branch_to_incharge($empid,$emp_branch);
						$emp_tr_id = $this->emp_model->emp_section_allotment_details_add($empid,$emp_section,$emp_branch,$staff_type);
						$this->session->set_flashdata('success','Successfully allotted.');
					}
					redirect(ADMIN_BASE_URL.'gpf/section_allotment');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/section_transfer_record_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}	
	public function section_allotment(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->gpf_model->get_admin_section_allotted($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/gpf/section_allotment';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/section_allotment',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function section_allotment_edit(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
	
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->get_allotted_section_by_id($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}

		$error = '';
		if($this->input->post()){
				$update = array(
							'charge_type'	=> $this->input->post('charge_type',true),
							'update_dt'		=> date('Y-m-d H:i:s'),
						);
				$result = $this->emp_model->updateSectionAllotmentCharge($id,$update);
				$this->session->set_flashdata('success','Successfully updated.');
				redirect(ADMIN_BASE_URL.'gpf/section_transfer_record');
		}
	
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/section_allotment_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	
	public function missingcr(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->gpf_model->get_missingcr($limit_to);
		$data['results'] = $response['results'];
		$config['base_url'] = ADMIN_BASE_URL.'gpf/missingcr';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/missingcr',$data);
		$this->load->view('agadmin/layout/footer');
	}
	//Hirani
	public function missingcr_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/missingcr_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	//Hirani
/*
	public function missingcr_ajax_upload(){
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
			$ins="truncate table agb_missingcr_tmp";
 			$query = $this->db->query($ins);
			$total_row = count(file($file_name));
 			$file_location = str_replace("\\", "/", $file_name);
 			$csvimp = '
 			LOAD DATA LOCAL INFILE "'.$file_location.'" IGNORE 
 			INTO TABLE agb_missingcr_tmp 
 			FIELDS TERMINATED BY "," 
 			ENCLOSED BY '.chr(39).chr(34).chr(39).'
 			LINES TERMINATED BY "\r\n" 
 			IGNORE 1 LINES ';
			$query = $this->db->query($csvimp);
 			$ins="insert ignore into agb_missingcr (series,accno,misscrdr,misscdmnth,crdr_flag) select series,accno,misscrdr,misscdmnth,crdr_flag from agb_missingcr_tmp";
 			$query = $this->db->query($ins);
 			//$output = array('success' => 'Total <b>'.($total_row-1).'</b> Data imported');
			$message = 'Successfully Inserted <b>'.($total_row-1).'</b> records...';
			$is_success = true;
			@unlink($file_name);
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
	
*/
//Hirani
	public function missingcr_ajax_upload(){
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
			$ins="truncate table agb_missingcr_tmp";
 			$query = $this->db->query($ins);
			$total_row = count(file($file_name));
 			$file_location = str_replace("\\", "/", $file_name);
 			$csvimp = '
 			LOAD DATA LOCAL INFILE "'.$file_location.'" IGNORE 
 			INTO TABLE agb_missingcr_tmp 
 			FIELDS TERMINATED BY "," 
 			ENCLOSED BY '.chr(39).chr(34).chr(39).'
 			LINES TERMINATED BY "\r\n" 
 			IGNORE 1 LINES ';
			$query = $this->db->query($csvimp);
 			$ins="insert ignore into agb_missingcr (series,accno,misscrdr,misscdmnth,crdr_flag) select series,accno,misscrdr,misscdmnth,crdr_flag from agb_missingcr_tmp";
 			$query = $this->db->query($ins);
			$query = $this->db->query($ins);
			$total_row = count(file($file_name));
 			$file_location = str_replace("\\", "/", $file_name);
 			$csvimp = '
 			LOAD DATA LOCAL INFILE "'.$file_location.'" IGNORE 
 			INTO TABLE agb_missingcr_tmp 
 			FIELDS TERMINATED BY "," 
 			ENCLOSED BY '.chr(39).chr(34).chr(39).'
 			LINES TERMINATED BY "\n" 
 			IGNORE 1 LINES ';
			$query = $this->db->query($csvimp);
 			
			$this->db->select('crdr_flag');
			//$this->db->distinct();
			//$this->db->group_by('fyear,series,ac_code,month'); 
			$query = $this->db->get('agb_missingcr_tmp');
			
			foreach ($query->result() as $row) {
				$crdr_flag=$row->crdr_flag;
			}	
			
			if ($crdr_flag=='N') {
				$ins="insert ignore into agb_missingcr (series,accno,misscrdr,misscdmnth,crdr_flag) select series,accno,misscrdr,misscdmnth,crdr_flag from agb_missingcr_tmp";
				$query = $this->db->query($ins);	
			} else {
			
				$this->db->select('series,accno,misscdmnth,crdr_flag');
				//$this->db->distinct();
				//$this->db->group_by('fyear,series,ac_code,month'); 
				$this->db->where('crdr_flag','Y');
				$querY = $this->db->get('agb_missingcr_tmp');
				
				foreach ($querY->result() as $row) {
					$series=$row->series;
					$accno=$row->accno;
					$month=$row->misscdmnth;
					$upd = "update agb_missingcr set crdr_flag='Y' where series='$series' and accno='$accno' and misscdmnth='$month'";		
					$uquery = $this->db->query($upd);
				}	
			}
 			//$output = array('success' => 'Total <b>'.($total_row-1).'</b> Data imported');
			$message = 'Successfully Inserted <b>'.($total_row-1).'</b> records...';
			$is_success = true;
			@unlink($file_name);
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

	//Hirani
	public function missingcr_delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->gpf_model->getMissingCrDrByID($id);
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->gpf_model->deleteMissingCrDrByID($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'gpf/missingcr');
	}
/*	
	public function missingcract(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->gpf_model->get_missingcract($limit_to);
		$data['results'] = $response['results'];
		$config['base_url'] = ADMIN_BASE_URL.'gpf/missingcract';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/missingcract',$data);
		$this->load->view('agadmin/layout/footer');
	}
*/
	public function missingcract(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$reply_date = '';
		$reply_date = $this->uri->segment(4);
		
		if(!empty($reply_date)){
			$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
			$response = $this->gpf_model->get_missingcract_dt($limit_to, $reply_date);
		}else{
			$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
			$response = $this->gpf_model->get_missingcract($limit_to);
		}
		$data['results'] = $response['results'];
		$config['base_url'] = ADMIN_BASE_URL.'gpf/missingcract';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/missingcract',$data);
		$this->load->view('agadmin/layout/footer');
	}

	public function missingcract_all(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->gpf_model->get_missingcract_all($limit_to);
		$data['results'] = $response['results'];
		$config['base_url'] = ADMIN_BASE_URL.'gpf/missingcract_all';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/missingcract_all',$data);
		$this->load->view('agadmin/layout/footer');
	}
	//Hirani
	public function missing_reports_download(){
		$this->load->model('gpf_model');
		$headings = array();
		$firstrow = array();
		$missing = $this->gpf_model->get_missing_reports_download();	
		if(!empty($missing)){
			foreach( $missing[0] as $k => $v ) {
					$headings[] = strtoupper($k);
					$firstrow[] = $v;
			}
			unset($missing[0]);
		}
		$excel_data[] = $headings;
		$excel_data[1] = $firstrow;
		foreach( $missing as $row ) {
			//$row['profile_updated'] = date('d-m-Y H:i:s',strtotime($row['profile_updated']));
			$excel_data[] = $row;
		}
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Missing Credit Action Report');
		$this->excel->getActiveSheet()->fromArray($excel_data);
		 
		$filename='missing_credit_action_'.time().'.xls'; //save our workbook as this file name
		header('Content-Type: Feednacl/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}
	public function mjh_head(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->gpf_model->get_mjh_head_list($limit_to);
		$data['results'] = $response['results'];
		$config['base_url'] = ADMIN_BASE_URL.'gpf/mjh_head';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/mjh_head',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function mjh_head_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/mjh_head_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function mjh_head_ajax_upload(){
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
			$ins="truncate table agb_mjrhead_tmp";
 			$query = $this->db->query($ins);
			$total_row = count(file($file_name));
 			$file_location = str_replace("\\", "/", $file_name);
 			$csvimp = '
 			LOAD DATA LOCAL INFILE "'.$file_location.'" IGNORE 
 			INTO TABLE agb_mjrhead_tmp 
 			FIELDS TERMINATED BY "," 
 			ENCLOSED BY '.chr(39).chr(34).chr(39).'
 			LINES TERMINATED BY "\r\n" 
 			IGNORE 1 LINES ';
			$query = $this->db->query($csvimp);
 			$ins="insert ignore into agb_mjrhead (mjrhd,mjrhddesc) select mjrhd,mjrhddesc from agb_mjrhead_tmp";
 			$query = $this->db->query($ins);
 			//$output = array('success' => 'Total <b>'.($total_row-1).'</b> Data imported');
			$message = 'Successfully Inserted <b>'.($total_row-1).'</b> records...';
			$is_success = true;
			@unlink($file_name);
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
	public function gpf_preview(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['series_codes'] = $this->gpf_model->get_all_series_code();
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gpf/gpf_preview',$data);
		$this->load->view('agadmin/layout/footer');
	}
/*	
	public function view_ac_slip() { 
		$this->load->library('m_pdf');
		$ac_code = $this->input->post('ac_code',true);
		$series = $this->input->post('series',true);
		$year = date('Y-m-d',strtotime($this->input->post('fyear',true)));

		$data['f_year'] = date('d/m/Y',strtotime($year));
		$data['part_1'] = $this->gpf_model->get_subscribers_part_1($ac_code,$series,$year);	
		$data['part_2'] = $this->gpf_model->get_subscribers_part_2($ac_code,$series,$year);	
		$data['part_3'] = $this->gpf_model->get_subscribers_part_3($ac_code,$series,$year);
		$data['part_4'] = $this->gpf_model->get_subscribers_part_4($ac_code,$series,$year);
		$data['subscribers_data'] = $this->gpf_model->get_subscriber_data($ac_code,$series);
//		$data['subscribers_data']['fst_nme'].' '.$data['subscribers_data']['mid_nme'].' '.$data['subscribers_data']['lst_nme'];
		$data['sign'] = $this->gpf_model->get_branch_officer_sign($series,$year);

		$pdfFilePath ="ac_statement_".$series."_".$ac_code.'_'.str_replace('-','_',$year).'_'.time().".pdf";
		$pdf = $this->m_pdf->generate();	
		if($year == date('Y-m-d',strtotime('2021-03-31'))){	
//			$html = $this->load->view('agadmin/pages/gpf/account_statement_pdf_22',$data, true); //load the pdf_output.php by passing our data and get all data in $html varriable.
			$html = $this->load->view('agadmin/pages/gpf/account_statement_pdf_newQR',$data, true); //load the pdf_output.php by passing our data and get all data in $html varriable.
			$pdf->SetWatermarkText('THIS IS FOR INFORMATION ONLY');
			$pdf->watermark_font = 'DejaVuSansCondensed';
//			$pdf->showWatermarkText = true;
			$pdf->SetProtection(array('print'), '', 'Itsc2020');
			$pdf->WriteHTML($html,0);
//			$pdf->Output($pdfFilePath, "D");
			$pdf->Output();
		}else{
			$html = $this->load->view('agadmin/pages/gpf/account_statement_pdf_newQR',$data, true); //load the pdf_output.php by passing our data and get all data in $html varriable.
			$pdf->SetWatermarkText('THIS IS FOR INFORMATION ONLY');
			$pdf->watermark_font = 'DejaVuSansCondensed';
			$pdf->showWatermarkText = true;
			$pdf->SetProtection(array('print'), '', 'Itsc2020');			
			$pdf->WriteHTML($html,0);
//			$pdf->Output($pdfFilePath, "D");
			$pdf->Output();
		}
    }
*/
	public function view_ac_slip() { 
		$this->load->library('m_pdf');
		$ac_code = $this->input->post('ac_code',true);
		$series = $this->input->post('series',true);
		$year = date('Y-m-d',strtotime($this->input->post('fyear',true)));

		$data['f_year'] = date('d/m/Y',strtotime($year));
		$data['part_1'] = $this->gpf_model->get_subscribers_part_1($ac_code,$series,$year);	
		$data['part_2'] = $this->gpf_model->get_subscribers_part_2($ac_code,$series,$year);	
		$data['part_3'] = $this->gpf_model->get_subscribers_part_3($ac_code,$series,$year);
		$data['part_4'] = $this->gpf_model->get_subscribers_part_4($ac_code,$series,$year);
		$data['subscribers_data'] = $this->gpf_model->get_subscriber_data($ac_code,$series);
//		$data['subscribers_data']['fst_nme'].' '.$data['subscribers_data']['mid_nme'].' '.$data['subscribers_data']['lst_nme'];
		$data['sign'] = $this->gpf_model->get_branch_officer_sign($series,$year);

		$pdfFilePath ="ac_statement_".$series."_".$ac_code.'_'.str_replace('-','_',$year).'_'.time().".pdf";
		$pdf = $this->m_pdf->generate();	
		if($year == date('Y-m-d',strtotime('2021-03-31'))){
			$html = $this->load->view('agadmin/pages/gpf/account_statement_pdf_newQR',$data, true); //load the pdf_output.php by passing our data and get all data in $html varriable.
			$pdf->SetWatermarkText('THIS IS FOR INFORMATION ONLY');
			$pdf->watermark_font = 'DejaVuSansCondensed';
//			$pdf->showWatermarkText = true;
			$pdf->SetProtection(array('print'), '', 'Itsc2020');
			$pdf->WriteHTML($html,0);
//			$pdf->Output($pdfFilePath, "D");
			$pdf->Output();
		}else{
			if($year >= date('Y-m-d',strtotime('2022-03-31'))){	
				$html = $this->load->view('agadmin/pages/gpf/account_statement_pdf_22',$data, true); //load the pdf_output.php by passing our data and get all data in $html varriable.
				$pdf->SetWatermarkText('THIS IS FOR INFORMATION ONLY');
				$pdf->watermark_font = 'DejaVuSansCondensed';
//				$pdf->showWatermarkText = true;
				$pdf->SetProtection(array('print'), '', 'Itsc2020');
				$pdf->WriteHTML($html,0);
	//			$pdf->Output($pdfFilePath, "D");
				$pdf->Output();
			}else{
				$html = $this->load->view('agadmin/pages/gpf/account_statement_pdf_newQR',$data, true); //load the pdf_output.php by passing our data and get all data in $html varriable.
				$pdf->SetWatermarkText('THIS IS FOR INFORMATION ONLY');
				$pdf->watermark_font = 'DejaVuSansCondensed';
				$pdf->showWatermarkText = true;
				$pdf->SetProtection(array('print'), '', 'Itsc2020');			
				$pdf->WriteHTML($html,0);
	//			$pdf->Output($pdfFilePath, "D");
				$pdf->Output();
			}
		}
    }

	public function view_fpa_pdf(){
		$this->load->library('m_pdf');
		$ac_code = $this->input->post('ac_code',true);
		$series = $this->input->post('series',true);

		$data['fpa'] =  $this->gpf_model->get_subscribers_final_payment_authority_group($ac_code,$series);
		if(empty($data['fpa'])){
			show_404();
		} 
		$data['fpa1'] = isset($data['fpa'][0]) ? $data['fpa'][0] : array();
		//$data['fpa2'] = isset($data['fpa'][1]) ? $data['fpa'][1] : array(); 
		$data['fpa2'] = isset($data['fpa'][0]) ? $data['fpa'][0] : array(); 
		$data['nominees'] = $this->gpf_model->get_final_payment_nominee($data['fpa1']['authority_no'],$data['fpa1']['series'],$data['fpa1']['ac_code']);
		$html = $this->load->view('agadmin/pages/gpf/final_payment_authority_pdf',$data, true); //load the pdf_output.php by passing our data and get all data in $html varriable.
		$pdfFilePath ="fp_authority".$series.$ac_code.".pdf";
		echo $pdfFilePath;
		$pdf = $this->m_pdf->generate();
		$pdf->SetWatermarkText('THIS IS FOR INFORMATION ONLY');
		$pdf->watermark_font = 'DejaVuSansCondensed';
		$pdf->showWatermarkText = true;
		$pdf->WriteHTML($html,0);
		//$pdf->Output($pdfFilePath, "D")->setContentType('application/pdf');
		$pdf->Output();
	}

} // End of Class
