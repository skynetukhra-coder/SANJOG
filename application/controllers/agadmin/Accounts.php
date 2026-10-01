<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('common_model');
		 $this->load->model('accounts_model');
		$this->load->model('wing_model');
		$this->load->model('gpf_model');
		$this->load->library('form_validation');
		$this->load->helper('admin_helper');
		$this->load->model('emp_model');
		$this->admin = '';
		if($this->session->userdata('admin_details')){
			$this->admin = $this->session->userdata('admin_details');
		}else{
			redirect('admin');
		}
		$this->admin_type = strtolower($this->admin['admin_type_name']);
		if($this->admin_type == 'superadmin' || $this->admin_type == 'accounts'){
			
		}else{
			show_404();
		}
	}
	
	public function treasury(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->wing_model->get_admin_treasury($limit_to);
		$data['results'] = $response['results'];
		
		$config['base_url'] = ADMIN_BASE_URL.'accounts/treasury';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/treasury',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function treasury_edit(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->wing_model->treasury_details($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
		if($this->input->post()){
			$this->wing_model->update_treasury($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'accounts/treasury');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/treasury_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function treasury_files(){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->wing_model->get_treasury_files($id);
			if(empty($data['row'])){
				$data['row']['tr_cd'] = $id;
			}
		}else{
			show_404('admin');
		}
		if($this->input->post()){
			$update = array(
						'tr_cd'				=> $id,
					);
			if(isset($_FILES['ins_prog_file_1']) && $_FILES['ins_prog_file_1']['size'] > 0){
				//upload file
				$upload_details = $this->common_model->upload_file('ins_prog_file_1');
				if(!$upload_details['is_success']){
					$this->session->set_flashdata('error',$upload_details['message']);
					$error = $upload_details['message'];
				}else{
					$update['ins_prog_file_1'] = $upload_details['filename'];
					$update['ins_prog_year_1'] = $this->input->post('ins_prog_year_1',true);
				}
			}
			if(isset($_FILES['ins_prog_file_2']) && $_FILES['ins_prog_file_2']['size'] > 0){
				//upload file
				$upload_details = $this->common_model->upload_file('ins_prog_file_2');
				if(!$upload_details['is_success']){
					$this->session->set_flashdata('error',$upload_details['message']);
					$error = $upload_details['message'];
				}else{
					$update['ins_prog_file_2'] = $upload_details['filename'];
					$update['ins_prog_year_2'] = $this->input->post('ins_prog_year_2',true);
				}
			}
			if(isset($_FILES['ins_prog_file_3']) && $_FILES['ins_prog_file_3']['size'] > 0){
				//upload file
				$upload_details = $this->common_model->upload_file('ins_prog_file_3');
				if(!$upload_details['is_success']){
					$this->session->set_flashdata('error',$upload_details['message']);
					$error = $upload_details['message'];
				}else{
					$update['ins_prog_file_3'] = $upload_details['filename'];
					$update['ins_prog_year_3'] = $this->input->post('ins_prog_year_3',true);
				}
			}
			if(isset($_FILES['ins_report_file_1']) && $_FILES['ins_report_file_1']['size'] > 0){
				//upload file
				$upload_details = $this->common_model->upload_file('ins_report_file_1');
				if(!$upload_details['is_success']){
					$this->session->set_flashdata('error',$upload_details['message']);
					$error = $upload_details['message'];
				}else{
					$update['ins_report_file_1'] = $upload_details['filename'];
					$update['ins_report_year_1'] = $this->input->post('ins_report_year_1',true);
				}
			}
			if(isset($_FILES['ins_report_file_2']) && $_FILES['ins_report_file_2']['size'] > 0){
				//upload file
				$upload_details = $this->common_model->upload_file('ins_report_file_2');
				if(!$upload_details['is_success']){
					$this->session->set_flashdata('error',$upload_details['message']);
					$error = $upload_details['message'];
				}else{
					$update['ins_report_file_2'] = $upload_details['filename'];
					$update['ins_report_year_2'] = $this->input->post('ins_report_year_2',true);
				}
			}
			if(isset($_FILES['ins_report_file_3']) && $_FILES['ins_report_file_3']['size'] > 0){
				//upload file
				$upload_details = $this->common_model->upload_file('ins_report_file_3');
				if(!$upload_details['is_success']){
					$this->session->set_flashdata('error',$upload_details['message']);
					$error = $upload_details['message'];
				}else{
					$update['ins_report_file_3'] = $upload_details['filename'];
					$update['ins_report_year_3'] = $this->input->post('ins_report_year_3',true);
				}
			}
			if(isset($_FILES['outs_para_file_1']) && $_FILES['outs_para_file_1']['size'] > 0){
				//upload file
				$upload_details = $this->common_model->upload_file('outs_para_file_1');
				if(!$upload_details['is_success']){
					$this->session->set_flashdata('error',$upload_details['message']);
					$error = $upload_details['message'];
				}else{
					$update['outs_para_file_1'] = $upload_details['filename'];
					$update['outs_para_year_1'] = $this->input->post('outs_para_year_1',true);
				}
			}
			if(isset($_FILES['outs_para_file_2']) && $_FILES['outs_para_file_2']['size'] > 0){
				//upload file
				$upload_details = $this->common_model->upload_file('outs_para_file_2');
				if(!$upload_details['is_success']){
					$this->session->set_flashdata('error',$upload_details['message']);
					$error = $upload_details['message'];
				}else{
					$update['outs_para_file_2'] = $upload_details['filename'];
					$update['outs_para_year_2'] = $this->input->post('outs_para_year_2',true);
				}
			}
			if(isset($_FILES['outs_para_file_3']) && $_FILES['outs_para_file_3']['size'] > 0){
				//upload file
				$upload_details = $this->common_model->upload_file('outs_para_file_3');
				if(!$upload_details['is_success']){
					$this->session->set_flashdata('error',$upload_details['message']);
					$error = $upload_details['message'];
				}else{
					$update['outs_para_file_3'] = $upload_details['filename'];
					$update['outs_para_year_3'] = $this->input->post('outs_para_year_3',true);
				}
			}
			if(isset($_FILES['annual_report_file_1']) && $_FILES['annual_report_file_1']['size'] > 0){
				//upload file
				$upload_details = $this->common_model->upload_file('annual_report_file_1');
				if(!$upload_details['is_success']){
					$this->session->set_flashdata('error',$upload_details['message']);
					$error = $upload_details['message'];
				}else{
					$update['annual_report_file_1'] = $upload_details['filename'];
					$update['annual_report_year_1'] = $this->input->post('annual_report_year_1',true);
				}
			}
			if(isset($_FILES['annual_report_file_2']) && $_FILES['annual_report_file_2']['size'] > 0){
				//upload file
				$upload_details = $this->common_model->upload_file('annual_report_file_2');
				if(!$upload_details['is_success']){
					$this->session->set_flashdata('error',$upload_details['message']);
					$error = $upload_details['message'];
				}else{
					$update['annual_report_file_2'] = $upload_details['filename'];
					$update['annual_report_year_2'] = $this->input->post('annual_report_year_2',true);
				}
			}
			if(isset($_FILES['annual_report_file_3']) && $_FILES['annual_report_file_3']['size'] > 0){
				//upload file
				$upload_details = $this->common_model->upload_file('annual_report_file_3');
				if(!$upload_details['is_success']){
					$this->session->set_flashdata('error',$upload_details['message']);
					$error = $upload_details['message'];
				}else{
					$update['annual_report_file_3'] = $upload_details['filename'];
					$update['annual_report_year_3'] = $this->input->post('annual_report_year_3',true);
				}
			}
			$this->wing_model->update_treasury_files($id,$update);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'accounts/treasury');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/treasury_files',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function treasury_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/treasury_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function treasury_ajax_upload(){
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
			
			$header_security_field =  array('USERS','USER_NAME','USER_DESIG','TR_CD','TR_NM','EMAILID','MB_NO');
			
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
//					$this->db->insert_batch('treasury_master',$bulk);
//				}
//			}else{
//				$this->db->insert_batch('treasury_master',$upload);
//			}
			foreach($upload as $record){
				$users = isset($record['users']) ? $record['users'] : 0;
				$record['upload_dt'] = date('Y-m-d H:i:s');
				// check records exists
				$res = $this->db->get_where('treasury_master',array('users'=>$users));
				if($res->num_rows() > 0){
					$this->db->where('users',$users)->update('treasury_master',$record);
				}else{
					$this->db->insert('treasury_master',$record);
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
	public function treasury_obsuspense(){
		$this->load->model('wing_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->wing_model->get_treasury_obsuspense($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/accounts/treasury_obsuspense';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/treasury_obsuspense',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function treasury_obsuspense_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/treasury_obsuspense_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function treasury_obsuspense_ajax_upload(){
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
			
			$header_security_field =  array('TREASURY_CODE','FIN_YEAR','MONTH_TR','MAJOR_HEAD','LOP_CAC','VOUCHER_CHALLAN','GROSS');
			
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
//					$this->db->insert_batch('treasury_obsuspense',$bulk);
//				}
//			}else{
//				$this->db->insert_batch('treasury_obsuspense',$upload);
//			}
			foreach($upload as $record){
				$treasury_code = isset($record['treasury_code']) ? $record['treasury_code'] : 0;
				$fin_year = isset($record['fin_year']) ? $record['fin_year'] : 0;
				$month_tr = isset($record['month_tr']) ? $record['month_tr'] : 0;
				$major_head = isset($record['major_head']) ? $record['major_head'] : 0;
				$lop_cac = isset($record['lop_cac']) ? $record['lop_cac'] : 0;
				$voucher_challan = isset($record['voucher_challan']) ? $record['voucher_challan'] : 0;
				$record['action_status'] = 'Pending';
				$record['upload_dt'] = date('Y-m-d H:i:s');
				// check records exists
				$res = $this->db->get_where('treasury_obsuspense',array('treasury_code'=>$treasury_code,'fin_year'=>$fin_year,'month_tr'=>$month_tr));
				if($res->num_rows() > 0){
					$this->db->where('treasury_code',$treasury_code)
							 ->where('fin_year',$fin_year)
							 ->where('month_tr',$month_tr)
							 ->where('major_head',$major_head)
							 ->where('lop_cac',$lop_cac)
							 ->where('voucher_challan',$voucher_challan)
					->update('treasury_obsuspense',$record);
				}else{
					$this->db->insert('treasury_obsuspense',$record);
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
	public function treasury_currection_slip(){
		$this->load->model('wing_model');
		$this->load->model('accounts_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
	
		$data['treasury_code'] = $this->accounts_model->get_all_treasury_code_list();
		$data['fin_yr_list'] = $this->accounts_model->get_all_misclassification_fin_yr_list();
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->wing_model->get_treasury_treasury_correction_slips($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/accounts/treasury_currection_slip';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/treasury_currection_slip',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	
	public function treasury_misclassification(){
		$this->load->model('wing_model');
		$this->load->model('accounts_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['treasury_code'] = $this->accounts_model->get_all_treasury_code_list();
		$data['fin_yr_list'] = $this->accounts_model->get_all_misclassification_fin_yr_list();
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->wing_model->get_treasury_misclassification($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/accounts/treasury_misclassification';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/treasury_misclassification',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function treasury_misclassification_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/treasury_misclassification_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function treasury_misclassification_ajax_upload(){
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
			
			$header_security_field =  array('TR_CD','YR_TA','TR_MN','GRNT_CD','DDO','MJH_CD','SMJH_CD','MIH_CD','SBH_CD','DTLH_CD','SDTLH_CD','LOP_CAC','TV_TC_NO','AMT_PAID','REASONS');
			
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
//					$this->db->insert_batch('treasury_misclassification',$bulk);
//				}
//			}else{
//				$this->db->insert_batch('treasury_misclassification',$upload);
//			}
			foreach($upload as $record){
				$yr_ta = isset($record['yr_ta']) ? $record['yr_ta'] : 0;
				$tr_mn = isset($record['tr_mn']) ? $record['tr_mn'] : 0;
				$tr_cd = isset($record['tr_cd']) ? $record['tr_cd'] : 0;
				$grnt_cd = isset($record['grnt_cd']) ? $record['grnt_cd'] : 0;
				$lop_cac = isset($record['lop_cac']) ? $record['lop_cac'] : 0;
				$ddo = isset($record['ddo']) ? $record['ddo'] : 0;
				$mjh_cd = isset($record['mjh_cd']) ? $record['mjh_cd'] : 0;
				$tv_tc_no = isset($record['tv_tc_no']) ? $record['tv_tc_no'] : 0;
				$record['action_status'] = 'Pending';
				$record['upload_dt'] = date('Y-m-d H:i:s');
				// check records existstr_mn
				$res = $this->db->get_where('treasury_misclassification',array('yr_ta'=>$yr_ta,'tr_mn'=>$tr_mn,'tr_cd'=>$tr_cd,'grnt_cd'=>$grnt_cd,'lop_cac'=>$lop_cac,'ddo'=>$ddo,'mjh_cd'=>$mjh_cd,'tv_tc_no'=>$tv_tc_no,));
				if($res->num_rows() > 0){
					$this->db->where('yr_ta',$yr_ta)
							 ->where('tr_mn',$tr_mn)
							 ->where('tr_cd',$tr_cd)
							  ->where('grnt_cd',$grnt_cd)
							 ->where('lop_cac',$lop_cac)
							 ->where('ddo',$ddo)
							 ->where('mjh_cd',$mjh_cd)
							 ->where('tv_tc_no',$tv_tc_no)
					->update('treasury_misclassification',$record);
				}else{
					$this->db->insert('treasury_misclassification',$record);
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
	public function department(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->wing_model->get_admin_department($limit_to);
		$data['results'] = $response['results'];
		
		$config['base_url'] = ADMIN_BASE_URL.'accounts/department';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/department',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function department_edit(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->wing_model->department_details($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
		if($this->input->post()){
			$this->wing_model->update_department($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'accounts/department');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/department_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function department_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/department_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function department_ajax_upload(){
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
			
			$header_security_field =  array('USERS','GRNT_CD','GRNT_CODE','GRNT_D','USER_NAME','USER_DESIG','MB_NO','EMAILID');
			
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
//					$this->db->insert_batch('department_master',$bulk);
//				}
//			}else{
//				$this->db->insert_batch('department_master',$upload);
//			}
			foreach($upload as $record){
				$users = isset($record['users']) ? $record['users'] : 0;
				$record['upload_dt'] = date('Y-m-d H:i:s');
				// check records exists
				$res = $this->db->get_where('department_master',array('users'=>$users));
				if($res->num_rows() > 0){
					$this->db->where('users',$users)->update('department_master',$record);
				}else{
					$this->db->insert('department_master',$record);
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
	
	public function da_cadare(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_admin_da_cadare($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/accounts/da_cadare';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/da_cadare',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function da_cadare_edit(){
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
			$this->emp_model->update_employee($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'accounts/da_cadare');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/da_cadare_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function da_cadare_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/da_cadare_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function da_cadare_ajax_upload(){
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
			
			$header_security_field =  array('EMPID','EMPNAME','FATHER_NAME','GENDER','MBNO','CATEGORY','STREAM','DOB','DOR','NICMAIL','NICMAIL_PROPOSED','EMAIL','DOAPP','OFFICE','DEPT_APPT','DOJ_OFF','JONING_TYPE','BLODD_GRP');
																			
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
//					$bulk['da_cadare'] = 1;
//					$this->db->insert_batch('employee_master',$bulk);
//				}
//			}else{
//				$upload['da_cadare'] = 1;
//				$this->db->insert_batch('employee_master',$upload);
//			}
			foreach($upload as $record){
				$empid = isset($record['empid']) ? $record['empid'] : 0;
				$record['upload_dt'] = date('Y-m-d H:i:s');
				// check records exists
				$res = $this->db->get_where('employee_master',array('empid'=>$empid,'da_cadare'=>1));
				if($res->num_rows() > 0){
					$this->db->where('empid',$empid)->where('da_cadare',1)->update('employee_master',$record);
				}else{
					$record['da_cadare'] = 1;
					$this->db->insert('employee_master',$record);
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
	
	public function da_cadare_details_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/da_cadare_details_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function da_cadare_details_ajax_upload(){
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
			
			$header_security_field =  array('EMPID','DESIG','QUALIFI','ADDRESS1','STATE','DISTRICT','POSTOFFICE','PIN','SECTION','GRD_SLNO','GRD_PAGENO','ID_CARDNO','GRATUITY_NOMINATION','GIS_NOMINATION','DO_EXP');
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
			//$bulk_elem = 10;
			//$bulk_upload = array();
			//if( count($upload) > $bulk_elem ){
			//	$bulk_upload = array_chunk($upload,$bulk_elem);
			//	foreach($bulk_upload as $bulk){
			//		$this->db->insert_batch('employee_details',$bulk);
			//		echo $this->db->last_query();
			//	}
			//}else{
			//	$this->db->insert_batch('employee_details',$upload);
			//	echo $this->db->last_query();
			//}
			foreach($upload as $record){
				$empid = isset($record['empid']) ? $record['empid'] : 0;
				$record['upload_dt'] = date('Y-m-d H:i:s');
				// check records exists
				$res = $this->db->get_where('employee_details',array('empid'=>$empid));
				if($res->num_rows() > 0){
					$this->db->where('empid',$empid)->update('employee_details',$record);
				}else{
					$this->db->insert('employee_details',$record);
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
	
	public function monthly_file(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->wing_model->get_admin_monthly_file($limit_to);
		$data['results'] = $response['results'];
		
		$config['base_url'] = ADMIN_BASE_URL.'accounts/monthly_file';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/monthly_file',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function monthly_file_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/monthly_file_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function monthly_file_ajax_upload(){
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
			
			$header_security_field =  array('YEAR','MONTH','FILENAME');
			
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
					$this->db->insert_batch('accounts_monthly',$bulk);
				}
			}else{
				$this->db->insert_batch('accounts_monthly',$upload);
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
	
	public function quarterly_file(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->wing_model->get_admin_quarterly_file($limit_to);
		$data['results'] = $response['results'];
		
		$config['base_url'] = ADMIN_BASE_URL.'accounts/quarterly_file';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/quarterly_file',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function quarterly_file_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/quarterly_file_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function quarterly_file_ajax_upload(){
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
			
			$header_security_field =  array('YEAR','QUARTER','FILENAME');
			
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
					$this->db->insert_batch('accounts_quarterly',$bulk);
				}
			}else{
				$this->db->insert_batch('accounts_quarterly',$upload);
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
	
	public function yearly_file(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->wing_model->get_admin_yearly_file($limit_to);
		$data['results'] = $response['results'];
		
		$config['base_url'] = ADMIN_BASE_URL.'accounts/yearly_file';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/yearly_file',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function yearly_file_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/yearly_file_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function yearly_file_ajax_upload(){
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
			
			$header_security_field =  array('YEAR','FILENAME');
			
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
					$this->db->insert_batch('accounts_yearly',$bulk);
				}
			}else{
				$this->db->insert_batch('accounts_yearly',$upload);
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
		
		$config['base_url'] = ADMIN_BASE_URL.'accounts/ddo';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/ddo',$data);
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
			redirect(ADMIN_BASE_URL.'accounts/ddo');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/ddo_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function ddo_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/ddo_upload',$data);
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
				$record['upload_dt'] = date('Y-m-d H:i:s');
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
	
public function circular_office_order(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->wing_model->get_accounts_circular_office_order($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/accounts/circular_office_order';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/circular_office_order',$data);
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
					//$upload_details = $this->common_model->upload_file('attachment');
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
					redirect(ADMIN_BASE_URL.'accounts/circular_office_order');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/circular_office_order_add',$data);
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
		redirect(ADMIN_BASE_URL.'accounts/circular_office_order');
	}
	public function circular_office_order_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/circular_office_order_upload',$data);
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
		
		$id = $this->uri->segment(4);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		if(!empty($id)){
			$response = $this->wing_model->get_office_order_byId($page_no,$id );
			
		}else{
			$response = $this->wing_model->get_accounts_office_order($page_no);
		}	

//		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
//		$response = $this->wing_model->get_accounts_office_order($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/accounts/office_order';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/office_order',$data);
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
						redirect(ADMIN_BASE_URL.'accounts/office_order');
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
					redirect(ADMIN_BASE_URL.'accounts/office_order');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/office_order_add',$data);
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
					$upload_details = $this->common_model->upload_multiple_file('attachment');
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
						redirect(ADMIN_BASE_URL.'accounts/office_order');
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
					redirect(ADMIN_BASE_URL.'accounts/office_order');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/office_order_edit',$data);
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
		redirect(ADMIN_BASE_URL.'accounts/office_order');
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
		
		$config['base_url'] = base_url().'/admin/accounts/order_employee';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/order_employee',$data);
		$this->load->view('agadmin/layout/footer');
	}
//-----------------files to department

	public function department_files(){
		$this->load->model('wing_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->wing_model->get_department_files($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/accounts/department_files';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/department_files',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function department_files_add(){
		$this->load->model('wing_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['deptusers'] = $this->wing_model->get_all_deprtment_users_list();
		$data['description'] = array();
		foreach($data['deptusers'] as $val){
			if(!in_array($val['grnt_d'],$data['description'])){
				$data['description'][] = $val['grnt_d'];
			}			
		}
		$id = $this->uri->segment(4);
		$data['row'] = array();
		$data['asign_dept'] = array();
		if(!empty($id)){
			$data['row'] = $this->wing_model->getDepartmentFilesByID($id);
			$data['asign_dept'] = $this->wing_model->get_DepartmentFilesToDept($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$error = '';
		
		$action_status = '';
		if($this->input->post('order_type')=='Reconciliation' ||$this->input->post('order_type')=='Warning'){
			$action_status ='Pending';
		}else{
			$action_status ='Not applicable';
		}
		
		
		if($this->input->post()){
			
			$dusers_concerned =  $this->input->post('dusers_concerned');
			foreach($dusers_concerned as $users=>$mb_no){
				$dept_code = $users;
			}

			$this->form_validation->set_rules('title', 'Title', 'required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				$update = array(
							'dept_cd' 	 => $dept_code,
							'order_type' => $this->input->post('order_type',true),
							'dyear'		 => $this->input->post('dyear',true),
							'dmonth'	 => $this->input->post('dmonth',true),
							'title'		 => $this->input->post('title',true),
							'details'	 => $this->input->post('details'),
							'order_date' => date('Y-m-d',strtotime($this->input->post('order_date'))),
							'upload_dt'	 => date('Y-m-d',strtotime($this->input->post('upload_dt'))),
							'action_status'	=> $action_status,
							'update_dt'	 => date('Y-m-d H:i:s')
						);
				if(isset($_FILES['attachment']) && $_FILES['attachment']['size'][0] > 0){
					//upload file
					$upload_details = $this->common_model->upload_department_files_admin('attachment'); //upload multiple files
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
						redirect(ADMIN_BASE_URL.'accounts/department');
					}else{
						$update['attachment'] = implode(';',$upload_details['filenames']);
					}
				}
				$dusers_concerned =  $this->input->post('dusers_concerned');

				if($error == ''){
					if(!empty($id)){ // edit
						$result = $this->wing_model->update_Department_Files($id,$update);
						$this->wing_model->update_DepartmentFilesToDept($id,$dusers_concerned);
						$this->session->set_flashdata('success','Successfully updated and SMS sent.');
					}else{ // add
						$update['update_dt'] = date('Y-m-d H:i:s');
        				$update['upload_dt'] = date('Y-m-d',strtotime($this->input->post('upload_dt')));
						$id = $this->wing_model->add_Department_Files($update);					
						$this->wing_model->add_DepartmentFilesToDept($id,$dusers_concerned);
						$this->session->set_flashdata('success','Successfully added and SMS sent.');
					}
					redirect(ADMIN_BASE_URL.'accounts/department_files');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/department_files_add',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function department_files_edit(){
		$this->load->model('wing_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['deptusers'] = $this->wing_model->get_all_deprtment_users_list();
		$data['description'] = array();
		foreach($data['deptusers'] as $val){
			if(!in_array($val['grnt_d'],$data['description'])){
				$data['description'][] = $val['grnt_d'];
			}			
		}
		$id = $this->uri->segment(4);
		$data['row'] = array();
		$data['asign_dept'] = array();
		if(!empty($id)){
			$data['row'] = $this->wing_model->getDepartmentFilesByID($id);
			$data['asign_dept'] = $this->wing_model->get_DepartmentFilesToDept($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$error = '';
		$action_status = '';
		if($this->input->post('order_type')=='Reconciliation' ||$this->input->post('order_type')=='Warning Slip'){
			$action_status ='Pending';
		}else{
			$action_status ='Not applicable';
		}
		
		if($this->input->post()){
			
			$dusers_concerned =  $this->input->post('dusers_concerned');
			foreach($dusers_concerned as $users=>$mb_no){
				$dept_code = $users;
			}
			
			$this->form_validation->set_rules('title', 'Title', 'required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				$update = array(
							'dept_cd' 	 => $dept_code,
							'order_type' => $this->input->post('order_type',true),
							'dyear'		 => $this->input->post('dyear',true),
							'dmonth'	 => $this->input->post('dmonth',true),
							'title'		 => $this->input->post('title',true),
							'details'	 => $this->input->post('details'),
							'order_date' => date('Y-m-d',strtotime($this->input->post('order_date'))),
							'upload_dt'	 => date('Y-m-d',strtotime($this->input->post('upload_dt'))),
							'action_status'	=> $action_status,
							'update_dt'	 => date('Y-m-d H:i:s')
						);
				if(isset($_FILES['attachment']) && $_FILES['attachment']['size'][0] > 0){
					//upload file
					$upload_details = $this->common_model->upload_department_files_admin('attachment'); //upload multiple files
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
						redirect(ADMIN_BASE_URL.'accounts/department');
					}else{
						$update['attachment'] = implode(';',$upload_details['filenames']);
					}
				}
				$dusers_concerned =  $this->input->post('dusers_concerned');
				if($error == ''){
					if(!empty($id)){ // edit
						$result = $this->wing_model->update_Department_Files($id,$update);
						$this->wing_model->update_DepartmentFilesToDept($id,$dusers_concerned);
						$this->session->set_flashdata('success','Successfully updated.');
					}else{ // add
						$update['update_dt'] = date('Y-m-d H:i:s');
        				$update['upload_dt'] = date('Y-m-d',strtotime($this->input->post('upload_dt')));
						$id = $this->wing_model->add_Department_Files($update);					
						$this->wing_model->add_DepartmentFilesToDept($id,$dusers_concerned);
						$this->session->set_flashdata('success','Successfully added.');
					}
					redirect(ADMIN_BASE_URL.'accounts/department_files');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/department_files_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function department_files_delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->wing_model->getDepartmentFilesByID($id);
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->wing_model->deleteDepartmentFilesByID($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'accounts/department_files');
	}
	public function department_files_print() { 
		$this->load->library('m_pdf');
		$this->load->model('accounts_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
			
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->wing_model->getDepartmentFilesByID($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		
		$dept_cd= $data['row']['dept_cd'];
		$dyear= $data['row']['dyear'];
		$data['dept'] = $this->accounts_model->get_department_recon_file($dept_cd);

		$html = $this->load->view('agadmin/pages/accounts/reconciliation_pdf',$data,true);//load the pdf_output.php by passing our data and get all data in $html varriable.
		$pdfFilePath ="Recon_".$dept_cd."_".$dyear.".pdf";

		$pdf = $this->m_pdf->pdfgenerate();
		$pdf->SetWatermarkText('O/o the Pr. Accountant General (A&E), WB');
		$pdf->watermark_font = 'DejaVuSansCondensed';
		$pdf->watermarkTextAlpha = 0.1;
		$pdf->showWatermarkText = true;
		$pdf->WriteHTML($html);
		$pdf->Output($pdfFilePath, "D");
//		$pdf->Output();
    }

	
	public function department_order_add(){
		$this->load->model('wing_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['deptusers'] = $this->wing_model->get_all_deprtment_users_list();
		$data['description'] = array();
		foreach($data['deptusers'] as $val){
			if(!in_array($val['grnt_d'],$data['description'])){
				$data['description'][] = $val['grnt_d'];
			}			
		}
		$id = $this->uri->segment(4);
		$data['row'] = array();
		$data['asign_dept'] = array();
		if(!empty($id)){
			$data['row'] = $this->wing_model->getDepartmentFilesByID($id);
			$data['asign_dept'] = $this->wing_model->get_DepartmentFilesToDept($id);
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
							'order_type' => $this->input->post('order_type',true),
							'dyear'		=> $this->input->post('dyear',true),
							'dmonth'	=> $this->input->post('dmonth',true),
							'title'		=> $this->input->post('title',true),
							'details'	=> $this->input->post('details'),
							'order_date' => date('Y-m-d',strtotime($this->input->post('order_date'))),
							'upload_dt'	=> date('Y-m-d',strtotime($this->input->post('upload_dt'))),
							'action_status'	=> 'Not applicable',
							'update_dt'	=> date('Y-m-d H:i:s')
						);
				if(isset($_FILES['attachment']) && $_FILES['attachment']['size'][0] > 0){
					//upload file
					$upload_details = $this->common_model->upload_department_files_admin('attachment');
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
						redirect(ADMIN_BASE_URL.'accounts/department');
					}else{
						$update['attachment'] = implode(';',$upload_details['filenames']);
					}
				}
				$dusers_concerned =  $this->input->post('dusers_concerned');
				if($error == ''){
					if(!empty($id)){ // edit
						$result = $this->wing_model->update_Department_Files($id,$update);
						$this->wing_model->update_DepartmentFilesToDept($id,$dusers_concerned);
						$this->session->set_flashdata('success','Successfully updated.');
					}else{ // add
						$update['update_dt'] = date('Y-m-d H:i:s');
        				$update['upload_dt'] = date('Y-m-d',strtotime($this->input->post('upload_dt')));
						$id = $this->wing_model->add_Department_Files($update);					
						$this->wing_model->update_DepartmentFilesToDept($id,$dusers_concerned);
						$this->session->set_flashdata('success','Successfully added.');
					}
					redirect(ADMIN_BASE_URL.'accounts/department_files');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/department_order_add',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function department_order_delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->wing_model->getDepartmentFilesByID($id);
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->wing_model->deleteDepartmentFilesByID($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'accounts/department_files');
	}
	
	public function department_investment(){
		$this->load->model('wing_model');
		$this->load->model('accounts_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['demand_list'] = $this->accounts_model->get_all_demand_no_list();
		$data['fin_yr_list'] = $this->accounts_model->get_all_invst_fin_yr_list();
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->wing_model->get_department_investment($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/accounts/department_investment';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/department_investment',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function department_investment_edit(){
		$this->load->model('wing_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->wing_model->department_investment_record($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}

		if($this->input->post()){
			$this->wing_model->update_department_investment($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'accounts/department_investment');
		}

		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/department_investment_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function department_investment_delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->wing_model->getDepartmentInvstByID($id);
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->wing_model->deleteDepartmentInvestmentByID($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'accounts/department_investment');
	}
	public function department_investment_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/department_investment_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function department_investment_ajax_upload(){
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
			
			$header_security_field =  array('YR_TA','TR_MN','TR_CD','DDO','GRNT_CD','MJH_CD','SMJH_CD','MIH_CD','SBH_CD','DTLH_CD','SDTLH_CD','TV_TC_NO','BILL_NO','BILL_DT','G_PAYMT');
			
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
//					$this->db->insert_batch('department_investment',$bulk);
//				}
//			}else{
//				$this->db->insert_batch('department_investment',$upload);
//			}
			foreach($upload as $record){
				$yr_ta = isset($record['yr_ta']) ? $record['yr_ta'] : 0;
				$grnt_cd = isset($record['grnt_cd']) ? $record['grnt_cd'] : 0;
				$tr_mn = isset($record['tr_mn']) ? $record['tr_mn'] : 0;
				$tr_cd = isset($record['tr_cd']) ? $record['tr_cd'] : 0;
				$ddo = isset($record['ddo']) ? $record['ddo'] : 0;
				$mjh_cd = isset($record['mjh_cd']) ? $record['mjh_cd'] : 0;
				$tv_tc_no = isset($record['tv_tc_no']) ? $record['tv_tc_no'] : 0;
				
				// check records exists
				$res = $this->db->get_where('department_investment',array('yr_ta'=>$yr_ta,'grnt_cd'=>$grnt_cd,'tr_mn'=>$tr_mn,'tr_cd'=>$tr_cd,'ddo'=>$ddo,'mjh_cd'=>$mjh_cd,'tv_tc_no'=>$tv_tc_no));
				if($res->num_rows() > 0){
					$this->db->where('yr_ta',$yr_ta)
							 ->where('grnt_cd',$grnt_cd)
							 ->where('tr_mn',$tr_mn)
							 ->where('tr_cd',$tr_cd)
							 ->where('ddo',$ddo)
							 ->where('mjh_cd',$mjh_cd)
							 ->where('tv_tc_no',$tv_tc_no)
					->update('department_investment',$record);
				}else{
					$this->db->insert('department_investment',$record);
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
	
	public function investment_download(){
		$this->load->model('accounts_model');
		$headings = array();
		$firstrow = array();
		$all_investments = $this->accounts_model->get_investment_download(); 
		if(!empty($all_investments)){
			unset($all_investments[0]['recd_id']);
			unset($all_investments[0]['update_dt']);
			foreach( $all_investments[0] as $k => $v ) {
					$headings[] = strtoupper($k);
					$firstrow[] = $v;
			}
			unset($all_investments[0]);
		}
		$excel_data[] = $headings;
		$excel_data[1] = $firstrow;
		foreach( $all_investments as $row ) {
			unset($row['recd_id']);
			unset($row['update_dt']);
			$excel_data[] = $row;
		}
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Feedback');
		$this->excel->getActiveSheet()->fromArray($excel_data);
		 
		$filename='investment_list_'.time().'.xls'; //save our workbook as this file name
		header('Content-Type: Feednacl/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}
	public function department_gia(){
		$this->load->model('wing_model');
		$this->load->model('accounts_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['demand_list'] = $this->accounts_model->get_all_demand_no_list();
		$data['fin_yr_list'] = $this->accounts_model->get_all_gia_fin_yr_list();
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->wing_model->get_department_gia($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/accounts/department_gia';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/department_gia',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function department_gia_delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->wing_model->getDepartmentGiaByID($id);
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->wing_model->deleteDepartmentGiaByID($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'accounts/department_gia');
	}
	
	public function gia_update($id=''){
	    if($this->admin_type == "g&ssa" || $this->admin_type == "e&rsa"){
			show_404();
		}
		$credit_to_bank = $this->input->post('credit_to_bank',true);
		$gia_amt = $this->input->post('gia_amt',true);
		$bal_amt = $this->input->post('bal_amt',true);
		$this->db->where('recd_id',$id)->update('department_gia',array('credit_to_bank'=>$credit_to_bank,'gia_amt'=>$gia_amt,'bal_amt'=>$bal_amt));

		$res = array('msg'=>'Successfully updated');
		echo json_encode($res);
	}
	
	public function department_gia_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/department_gia_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function department_gia_ajax_upload(){
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
			
			$header_security_field =  array('FIN_YR','TR_MN','TR_CD','DDO','GRNT_CD','MJH_CD','SMJH_CD','MIH_CD','SBH_CD','DTLH_CD','SDTLH_CD','TV_TC_NO','GIA_AMT','BAL_AMT');

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
//					$this->db->insert_batch('department_gia',$bulk);
//				}
//			}else{
//				$this->db->insert_batch('department_gia',$upload);
//			}
			foreach($upload as $record){
				$fin_yr = isset($record['fin_yr']) ? $record['fin_yr'] : 0;
				$tr_mn = isset($record['tr_mn']) ? $record['tr_mn'] : 0;
				$tr_cd = isset($record['tr_cd']) ? $record['tr_cd'] : 0;
				$ddo = isset($record['ddo']) ? $record['ddo'] : 0;
				$mjh_cd = isset($record['mjh_cd']) ? $record['mjh_cd'] : 0;
				$tv_tc_no = isset($record['tv_tc_no']) ? $record['tv_tc_no'] : 0;
				$gia_amt = isset($record['gia_amt']) ? $record['gia_amt'] : 0;
				$record['upload_dt'] = date('Y-m-d H:i:s');
				// check records exists
				$res = $this->db->get_where('department_gia',array('fin_yr'=>$fin_yr,'tr_mn'=>$tr_mn,'tr_cd'=>$tr_cd,'ddo'=>$ddo,'mjh_cd'=>$mjh_cd,'tv_tc_no'=>$tv_tc_no,'gia_amt'=>$gia_amt));
				if($res->num_rows() > 0){
					$this->db->where('fin_yr',$fin_yr)
							 ->where('tr_mn',$tr_mn)
							 ->where('tr_cd',$tr_cd)
							 ->where('ddo',$ddo)
							 ->where('mjh_cd',$mjh_cd)
							 ->where('tv_tc_no',$tv_tc_no)
							 ->where('gia_amt',$gia_amt)
					->update('department_gia',$record);
				}else{
					$this->db->insert('department_gia',$record);
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
	public function gia_download(){
		$this->load->model('accounts_model');
		$headings = array();
		$firstrow = array();
		$all_gias = $this->accounts_model->get_gia_download(); 
		if(!empty($all_gias)){
			unset($all_gias[0]['recd_id']);
			unset($all_gias[0]['update_dt']);
			foreach( $all_gias[0] as $k => $v ) {
					$headings[] = strtoupper($k);
					$firstrow[] = $v;
			}
			unset($all_gias[0]);
		}
		$excel_data[] = $headings;
		$excel_data[1] = $firstrow;
		foreach( $all_gias as $row ) {
			unset($row['recd_id']);
			unset($row['update_dt']);
			$row['uc_ref_date'] = date('d-m-Y',strtotime($row['uc_ref_date']));
			$row['dept_date'] = date('d-m-Y',strtotime($row['dept_date']));
			$excel_data[] = $row;
		}
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Feedback');
		$this->excel->getActiveSheet()->fromArray($excel_data);
		 
		$filename='GIA_list_'.time().'.xls'; //save our workbook as this file name
		header('Content-Type: Feednacl/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}
	public function department_acdc(){
		$this->load->model('wing_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->wing_model->get_department_acdc($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/accounts/department_acdc';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/department_acdc',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function department_acdc_update($id=''){
		$acbl_amt = $this->input->post('acbl_amt',true);
		$amt_bal = $this->input->post('amt_bal',true);
		$this->db->where('recd_id',$id)->update('department_acdc',array('acbl_amt'=>$acbl_amt,'amt_bal'=>$amt_bal));
		$res = array('msg'=>'Successfully updated');
		echo json_encode($res);
	}
	public function department_acdc_delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->wing_model->getDepartmentAcdcByID($id); //getDepartmentFilesByID
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->wing_model->deleteDepartmentAcdcByID($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'accounts/department_acdc');
	}
	public function department_acdc_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/department_acdc_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function department_acdc_ajax_upload(){
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
			
			$header_security_field =  array('FIN_YR','TR_MN','TR_CD','DDO','GRNT_CD','MJH_CD','SMJH_CD','MIH_CD','SBH_CD','DTLH_CD','SDTLH_CD','TV_TC_NO','ACBL_AMT','AMT_BAL');

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
//					$this->db->insert_batch('department_acdc',$bulk);
//				}
//			}else{
//				$this->db->insert_batch('department_acdc',$upload);
//			}
			foreach($upload as $record){
				$fin_yr = isset($record['fin_yr']) ? $record['fin_yr'] : 0;
				$tr_mn = isset($record['tr_mn']) ? $record['tr_mn'] : 0;
				$tr_cd = isset($record['tr_cd']) ? $record['tr_cd'] : 0;
				$ddo = isset($record['ddo']) ? $record['ddo'] : 0;
				$mjh_cd = isset($record['mjh_cd']) ? $record['mjh_cd'] : 0;
				$tv_tc_no = isset($record['tv_tc_no']) ? $record['tv_tc_no'] : 0;
				$record['upload_dt'] = date('Y-m-d H:i:s');
				// check records exists
				$res = $this->db->get_where('department_acdc',array('fin_yr'=>$fin_yr,'tr_mn'=>$tr_mn,'tr_cd'=>$tr_cd,'ddo'=>$ddo,'mjh_cd'=>$mjh_cd,'tv_tc_no'=>$tv_tc_no));
				if($res->num_rows() > 0){
					$this->db->where('fin_yr',$fin_yr)
							 ->where('tr_mn',$tr_mn)
							 ->where('tr_cd',$tr_cd)
							 ->where('ddo',$ddo)
							 ->where('mjh_cd',$mjh_cd)
							 ->where('tv_tc_no',$tv_tc_no)
					->update('department_acdc',$record);
				}else{
					$this->db->insert('department_acdc',$record);
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
	public function department_loan_advance(){
		$this->load->model('wing_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->wing_model->get_department_loan_advance($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/accounts/department_loan_advance';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/department_loan_advance',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function department_loan_advance_edit(){
		$this->load->model('wing_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->wing_model->department_loan_advance_record($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}

		if($this->input->post()){
			$this->wing_model->update_department_loan_advance($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'accounts/department_loan_advance');
		}

		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/department_loan_advance_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function department_loan_advance_delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->wing_model->getDepartmentLoanAdvByID($id); //getDepartmentFilesByID
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->wing_model->deleteDepartmentLoanAdvByID($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'accounts/department_loan_advance');
	}
	public function department_loan_advance_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/department_loan_advance_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function department_loan_advance_ajax_upload(){
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
			
			$header_security_field =  array('YR_TA','TR_MN','TR_CD','DDO','GRNT_CD','MJH_CD','SMJH_CD','MIH_CD','SBH_CD','DTLH_CD','SDTLH_CD','TV_TC_NO','BILL_NO','BILL_DT','N_AMT_SCHD');
			
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
//					$this->db->insert_batch('department_loan_advance',$bulk);
//				}
//			}else{
//				$this->db->insert_batch('department_loan_advance',$upload);
//			}
			foreach($upload as $record){
				$yr_ta = isset($record['yr_ta']) ? $record['yr_ta'] : 0;
				$grnt_cd = isset($record['grnt_cd']) ? $record['grnt_cd'] : 0;
				$tr_mn = isset($record['tr_mn']) ? $record['tr_mn'] : 0;
				$tr_cd = isset($record['tr_cd']) ? $record['tr_cd'] : 0;
				$ddo = isset($record['ddo']) ? $record['ddo'] : 0;
				$mjh_cd = isset($record['mjh_cd']) ? $record['mjh_cd'] : 0;
				$tv_tc_no = isset($record['tv_tc_no']) ? $record['tv_tc_no'] : 0;
				$record['upload_dt'] = date('Y-m-d H:i:s');
				// check records exists
				$res = $this->db->get_where('department_loan_advance',array('yr_ta'=>$yr_ta,'grnt_cd'=>$grnt_cd,'tr_mn'=>$tr_mn,'tr_cd'=>$tr_cd,'ddo'=>$ddo,'mjh_cd'=>$mjh_cd,'tv_tc_no'=>$tv_tc_no));
				if($res->num_rows() > 0){
					$this->db->where('yr_ta',$yr_ta)
							 ->where('grnt_cd',$grnt_cd)
							 ->where('tr_mn',$tr_mn)
							 ->where('tr_cd',$tr_cd)
							 ->where('ddo',$ddo)
							 ->where('mjh_cd',$mjh_cd)
							 ->where('tv_tc_no',$tv_tc_no)
					->update('department_loan_advance',$record);
				}else{
					$this->db->insert('department_loan_advance',$record);
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
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->wing_model->get_accounts_all_circular($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/accounts/document_order';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/document_order',$data);
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
			$this->form_validation->set_rules('wing', 'wing', 'required');
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
						redirect(ADMIN_BASE_URL.'accounts/document_order');
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
					redirect(ADMIN_BASE_URL.'accounts/document_order');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/document_order_add',$data);
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
		redirect(ADMIN_BASE_URL.'accounts/document_order');
	}

//-----------------files to treasury

	public function treasury_orders(){
		$this->load->model('wing_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->wing_model->get_all_treasury_orders($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/accounts/treasury_orders';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/treasury_orders',$data);
		$this->load->view('agadmin/layout/footer');
	}    
	public function treasury_document(){
		$this->load->model('wing_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->wing_model->get_treasury_concerned_orders($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/accounts/treasury_document';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/treasury_document',$data);
		$this->load->view('agadmin/layout/footer');
	}    
	public function treasury_document_add(){
		$this->load->model('wing_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['tryusers'] = $this->wing_model->get_all_treasury_users_list();
		$data['description'] = array();
		foreach($data['tryusers'] as $val){
			if(!in_array($val['tr_nm'],$data['description'])){
				$data['description'][] = $val['tr_nm'];
			}			
		}
		
		$id = $this->uri->segment(4);
		$data['row'] = array();
		$data['asign_try'] = array();
		if(!empty($id)){
			$data['row'] = $this->wing_model->getTreasuryOrdersByID($id);
			$data['asign_try'] = $this->wing_model->get_TreasuryOrddrsToTry($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$error = '';
													
		if($this->input->post()){

			$tusers_concerned =  $this->input->post('tusers_concerned');
			foreach($tusers_concerned as $users=>$mb_no){
				$try_code = $users;
			}
			
			$this->form_validation->set_rules('title', 'Title', 'required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				$update = array(
							'treasury_code' => $try_code ,
							'order_type'	=> $this->input->post('order_type',true),
							'dyear'		=> $this->input->post('dyear',true),
							'dmonth'		=> $this->input->post('dmonth',true),
							'title'		=> $this->input->post('title',true),
							'details'	=> $this->input->post('details'),
							'order_date'	=> date('Y-m-d',strtotime($this->input->post('order_date'))),
							'update_dt'	=> date('Y-m-d H:i:s')
						);

				if(isset($_FILES['attachment']) && $_FILES['attachment']['size'][0] > 0){
					//upload file
					$upload_details = $this->common_model->upload_department_files_admin('attachment');
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
						redirect(ADMIN_BASE_URL.'accounts/treasury_document');
					}else{
						$update['attachment'] = implode(';',$upload_details['filenames']);
					}
				}

			
				if($error == ''){
					if(!empty($id)){ // edit
						$result = $this->wing_model->update_treasury_orders($id,$update);
						$this->wing_model->update_TreasuryOrddrsToTry($id,$tusers_concerned);
						$this->session->set_flashdata('success','Successfully updated.');
					}else{ // add
						$update['upload_dt'] = date('Y-m-d H:i:s');
						$id = $this->wing_model->add_treasury_orders($update);					
						$this->wing_model->add_TreasuryOrddrsToTry($id,$tusers_concerned);
						$this->session->set_flashdata('success','Successfully added.');
					}
					redirect(ADMIN_BASE_URL.'accounts/treasury_document');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/treasury_document_add',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function treasury_document_edit(){
		$this->load->model('wing_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['tryusers'] = $this->wing_model->get_all_treasury_users_list();
		$data['description'] = array();
		foreach($data['tryusers'] as $val){
			if(!in_array($val['tr_nm'],$data['description'])){
				$data['description'][] = $val['tr_nm'];
			}			
		}
		$id = $this->uri->segment(4);
		$data['row'] = array();
		$data['asign_try'] = array();
		if(!empty($id)){
			$data['row'] = $this->wing_model->getTreasuryOrdersByID($id);
			$data['asign_try'] = $this->wing_model->get_TreasuryOrddrsToTry($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$error = '';
		if($this->input->post()){
			
			$tusers_concerned =  $this->input->post('tusers_concerned');
			foreach($tusers_concerned as $users=>$mb_no){
				$try_code = $users;
			}
			
			$this->form_validation->set_rules('title', 'Title', 'required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				$update = array(
							'treasury_code' => $try_code ,
							'order_type'	=> $this->input->post('order_type',true),
							'dyear'		=> $this->input->post('dyear',true),
							'dmonth'	=> $this->input->post('dmonth',true),
							'title'		=> $this->input->post('title',true),
							'details'	=> $this->input->post('details'),
							'order_date'=> date('Y-m-d',strtotime($this->input->post('order_date'))),
							'update_dt'	=> date('Y-m-d H:i:s')
						);
				if(isset($_FILES['attachment']) && $_FILES['attachment']['size'][0] > 0){
					//upload file
					$upload_details = $this->common_model->upload_department_files_admin('attachment');
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
						redirect(ADMIN_BASE_URL.'accounts/treasury_document');
					}else{
						$update['attachment'] = implode(';',$upload_details['filenames']);
					}
				}
				$tusers_concerned =  $this->input->post('tusers_concerned');
				if($error == ''){
					if(!empty($id)){ // edit
						$result = $this->wing_model->update_treasury_orders($id,$update);
						$this->wing_model->update_TreasuryOrddrsToTry($id,$tusers_concerned);
						$this->session->set_flashdata('success','Successfully updated.');
					}else{ // add
						$update['upload_dt'] = date('Y-m-d H:i:s');
						$id = $this->wing_model->add_treasury_orders($update);					
						$this->wing_model->add_TreasuryOrddrsToTry($id,$tusers_concerned);
						$this->session->set_flashdata('success','Successfully added.');
					}
					redirect(ADMIN_BASE_URL.'accounts/treasury_document');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/treasury_document_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function treasury_document_delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->wing_model->getTreasuryOrdersByID($id);
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->wing_model->deleteDepartmentFilesByID($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'accounts/treasury');
	}
		
	public function treasury_order_add(){
		$this->load->model('wing_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['tryusers'] = $this->wing_model->get_all_treasury_users_list();
		$data['description'] = array();
		foreach($data['tryusers'] as $val){
			if(!in_array($val['tr_nm'],$data['description'])){
				$data['description'][] = $val['tr_nm'];
			}			
		}
		$id = $this->uri->segment(4);
		$data['row'] = array();
		$data['asign_try'] = array();
		if(!empty($id)){
			$data['row'] = $this->wing_model->getTreasuryOrdersByID($id);
			$data['asign_try'] = $this->wing_model->get_TreasuryOrddrsToTry($id);
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
							'order_type'		=> $this->input->post('order_type',true),
							'dyear'		=> $this->input->post('dyear',true),
							'dmonth'		=> $this->input->post('dmonth',true),
							'title'		=> $this->input->post('title',true),
							'details'	=> $this->input->post('details'),
							'order_date'	=> date('Y-m-d',strtotime($this->input->post('order_date'))),
							'update_dt'	=> date('Y-m-d H:i:s')
						);
				if(isset($_FILES['attachment']) && $_FILES['attachment']['size'][0] > 0){
					//upload file
					$upload_details = $this->common_model->upload_department_files_admin('attachment');
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
						redirect(ADMIN_BASE_URL.'accounts/treasury_orders');
					}else{
						$update['attachment'] = implode(';',$upload_details['filenames']);
					}
				}
				$tusers_concerned =  $this->input->post('tusers_concerned');
				if($error == ''){
					if(!empty($id)){ // edit
						$result = $this->wing_model->update_treasury_orders($id,$update);
//						$this->wing_model->update_TreasuryOrddrsToTry($id,$tusers_concerned);
						$this->session->set_flashdata('success','Successfully updated.');
					}else{ // add
						$update['upload_dt'] = date('Y-m-d H:i:s');
						$id = $this->wing_model->add_treasury_orders($update);					
//						$this->wing_model->update_TreasuryOrddrsToTry($id,$tusers_concerned);
						$this->session->set_flashdata('success','Successfully added.');
					}
					redirect(ADMIN_BASE_URL.'accounts/treasury_orders');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/treasury_order_add',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	
	public function treasury_order_delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->wing_model->getTreasuryOrdersByID($id);
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->wing_model->deleteDepartmentFilesByID($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'accounts/treasury');
	}
	public function treasury_outsttanding_paras(){
		$this->load->model('accounts_model');
		$this->load->model('wing_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['treasury_code'] = $this->accounts_model->get_all_treasury_code_list();
		$data['report_list'] = $this->accounts_model->get_all_treasury_report_list();
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->wing_model->get_treasury_outstanding_paras($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/accounts/treasury_outsttanding_paras';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/treasury_outsttanding_paras',$data);
		$this->load->view('agadmin/layout/footer');
	}	
	public function treasury_currection_slip_edit(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->wing_model->get_treasury_corrction_memo_id($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
		if($this->input->post()){
			$this->wing_model->update_treasury_correction_momo($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'accounts/treasury_currection_slip');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/treasury_currection_slip_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function treasury_outsttanding_para_edit(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->wing_model->get_treasury_outstanding_paras_id($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
		if($this->input->post()){
			$this->wing_model->update_treasury_outstanding_para($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'accounts/treasury_outsttanding_paras');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/treasury_outsttanding_para_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function treasury_outstanding_para_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/treasury_outstanding_para_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}

	public function treasury_outstanding_para_ajax_upload(){
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
			
			$header_security_field =  array('TR_CD','TR_NM','IR_PERIOD','PARA_YEAR','PARA_MONTH','PARA_NO','PARA_DESC','IR_REF_NO','IR_REF_DATE');
			
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
//					$this->db->insert_batch('treasury_ir_paras',$bulk);
//				}
//			}else{
//				$this->db->insert_batch('treasury_ir_paras',$upload);
//			}
			foreach($upload as $record){
				$tr_cd = isset($record['tr_cd']) ? $record['tr_cd'] : 0;
				$para_year = isset($record['para_year']) ? $record['para_year'] : 0;
				$para_month = isset($record['para_month']) ? $record['para_month'] : 0;
				$record['para_status'] = 'Pending';
				$record['upload_dt'] = date('Y-m-d H:i:s');
				// check records existstr_mn
				$res = $this->db->get_where('treasury_ir_paras',array('tr_cd'=>$tr_cd,'para_year'=>$para_year,'para_month'=>$para_month));
				if($res->num_rows() > 0){
					$this->db->where('tr_cd',$tr_cd)->where('para_year',$para_year)->where('para_month',$para_month)->update('treasury_ir_paras',$record);
				}else{
					$this->db->insert('treasury_ir_paras',$record);
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
	
	public function treasury_reports(){
		$this->load->model('accounts_model');
		$this->load->model('wing_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['report_list'] = $this->accounts_model->get_all_treasury_report_list();
		$data['treasury_list'] = $this->accounts_model->get_all_treasury_list();
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->wing_model->get_treasury_reports($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/accounts/treasury_reports';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/treasury_reports',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function treasury_reports_download(){
		$this->load->model('wing_model');
		$headings = array();
		$firstrow = array();
		$all_reports = $this->wing_model->get_treasury_reports_download();
		if(!empty($all_reports)){
//			unset($all_reports[0]['report_id']);
			foreach( $all_reports[0] as $k => $v ) {
					$headings[] = strtoupper($k);
					$firstrow[] = $v;
			}
			unset($all_reports[0]);
		}
		$excel_data[] = $headings;
		$excel_data[1] = $firstrow;
		foreach( $all_reports as $row ) {
//			unset($row['report_id']);
			$row['report_due_date'] = date('d-m-Y  A',strtotime($row['report_due_date']));
			$row['upload_dt'] = date('d-m-Y  A',strtotime($row['upload_dt']));
			$excel_data[] = $row;
		}
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Reports');
		$this->excel->getActiveSheet()->fromArray($excel_data);
		 
		$filename='Reports_'.time().'.xls'; //save our workbook as this file name
		header('Content-Type: Feednacl/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}	
	public function treasury_misclassification_download(){
		$this->load->model('wing_model');
		$headings = array();
		$firstrow = array();
		$all_misclassificationns = $this->wing_model->get_treasury_misclassification_download();
		if(!empty($all_misclassificationns)){
//			unset($all_misclassificationns[0]['record_id']);
			foreach( $all_misclassificationns[0] as $k => $v ) {
					$headings[] = strtoupper($k);
					$firstrow[] = $v;
			}
			unset($all_misclassificationns[0]);
		}
		$excel_data[] = $headings;
		$excel_data[1] = $firstrow;
		foreach( $all_misclassificationns as $row ) {
//			unset($row['record_id']);
			$row['upload_dt'] = date('d-m-Y  A',strtotime($row['upload_dt']));
			$row['try_date'] = date('d-m-Y  A',strtotime($row['try_date']));
			$excel_data[] = $row;
		}
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Misclassifications');
		$this->excel->getActiveSheet()->fromArray($excel_data);
		 
		$filename='Misclassifications_'.time().'.xls'; //save our workbook as this file name
		header('Content-Type: Feednacl/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}
	public function treasury_correctionslip_download(){
		$this->load->model('wing_model');
		$headings = array();
		$firstrow = array();
		$all_correctionslips = $this->wing_model->get_treasury_correctionslip_download();
		if(!empty($all_correctionslips)){
//			unset($all_correctionslips[0]['record_id']);
			foreach( $all_correctionslips[0] as $k => $v ) {
					$headings[] = strtoupper($k);
					$firstrow[] = $v;
			}
			unset($all_correctionslips[0]);
		}
		$excel_data[] = $headings;
		$excel_data[1] = $firstrow;
		foreach( $all_correctionslips as $row ) {
//			unset($row['record_id']);
			$row['upload_dt'] = date('d-m-Y  A',strtotime($row['upload_dt']));
			$row['try_date'] = date('d-m-Y  A',strtotime($row['try_date']));
			$excel_data[] = $row;
		}
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('CorrectionSlip');
		$this->excel->getActiveSheet()->fromArray($excel_data);
		 
		$filename='CorrectionSlip_'.time().'.xls'; //save our workbook as this file name
		header('Content-Type: Feednacl/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}
	
	public function treasury_outstandingparas_download(){
		$this->load->model('wing_model');
		$headings = array();
		$firstrow = array();
		$all_paras = $this->wing_model->get_treasury_outstanding_paras_download();
		if(!empty($all_paras)){
//			unset($all_paras[0]['para_id']);
			foreach( $all_paras[0] as $k => $v ) {
					$headings[] = strtoupper($k);
					$firstrow[] = $v;
			}
			unset($all_paras[0]);
		}
		$excel_data[] = $headings;
		$excel_data[1] = $firstrow;
		foreach( $all_paras as $row ) {
//			unset($row['para_id']);
			$row['ir_ref_date'] = date('d-m-Y  A',strtotime($row['ir_ref_date']));
			$row['try_ref_date'] = date('d-m-Y  A',strtotime($row['try_ref_date']));
			$row['upload_dt'] = date('d-m-Y  A',strtotime($row['upload_dt']));
			$excel_data[] = $row;
		}
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('OutstandingPara');
		$this->excel->getActiveSheet()->fromArray($excel_data);
		 
		$filename='OutstandingPara_'.time().'.xls'; //save our workbook as this file name
		header('Content-Type: Feednacl/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}
	
	
//-------------------------------	
	public function upload_files(){
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/upload_files');
		$this->load->view('agadmin/layout/footer');
	}
	
	
// exam_result uploading

public function exam_result(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->wing_model->get_exam_result($page_no);
		$data['result'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/accounts/exam_result';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/exam_result',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function exam_result_add(){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->wing_model->getExamResultsByID($id);
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
					$upload_details = $this->common_model->upload_exam_results('attachment');
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
					}else{
						$update['pdf_name'] = $upload_details['filename'];
					}
				}
				if($error == ''){
					if(!empty($id)){ // edit
						$result = $this->wing_model->updateExamResults($id,$update);
						$this->session->set_flashdata('success','Successfully updated.');
					}else{
						$id = $this->wing_model->addExamResults($update);
						$this->session->set_flashdata('success','Successfully added.');
					}
					redirect(ADMIN_BASE_URL.'accounts/exam_result');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/exam_result_add',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function exam_result_delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->wing_model->getExamResultsByID($id);
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->wing_model->deleteExamResultsByID($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'accounts/exam_result');
	}
	public function exam_result_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/exam_result_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function exam_result_ajax_upload(){
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
					$this->db->insert_batch('exam_results',$bulk);
				}
			}else{
				$this->db->insert_batch('exam_results',$upload);
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
	
	
	//------------feedback		
	public function feedback(){
		$this->load->model('common_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->common_model->all_accounts_feedback($page_no);
		$data['results'] = $response['results'];
		
		$data['all_groups'] = $this->common_model->get_all_groups();
		
		$config['base_url'] = base_url().'/admin/accounts/feedback';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/feedback',$data);
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
			$this->common_model->update_accounts_feedback_action($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'accounts/feedback');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/feedback_action',$data);
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
		$html = $this->load->view('agadmin/pages/accounts/feedback_pdf',$data,true);//load the pdf_output.php by passing our data and get all data in $html varriable.
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
		$response = $this->emp_model->get_epabx_extension_list_accounts($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/accounts/epabx_list';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/epabx_list',$data);
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
			redirect(ADMIN_BASE_URL.'accounts/epabx_list');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/epabx_list_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function treasury_inspection(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->accounts_model->get_all_treasury_insp_records($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/accounts/treasury_inspection';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/treasury_inspection',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function treasury_inspection_new(){
		$this->load->model('accounts_model');
		
		$data = $this->accounts_model->get_last_inspection_id();
		if($this->input->post()){
			$ins_id= $this->input->post('try_insp_id',true);
		}else{
			$ins_id= date('Y').date('m').$data['max_id']+1;		
			$this->db->insert('treasury_inspection_master',array('try_insp_id'=>$ins_id));
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
			$data['row'] = $this->accounts_model->getInspectionPrgByID($id);
			$data['asign_emp'] = $this->accounts_model->getInspectionPrgToEmployees($id);
			if(empty($data['row'])){
				show_404('admin');
			}		
		}
		$error = '';
		if($this->input->post()){
			$this->form_validation->set_rules('tr_nm', 'Tr_nm', 'required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				$update = array(
							'tr_nm'		=> $this->input->post('title',true),
							'details'	=> $this->input->post('details'),
							'order_dt'	=> date('Y-m-d',strtotime($this->input->post('order_dt'))),
							'update_dt'	=> date('Y-m-d H:i:s')
						);
				if(isset($_FILES['attachment']) && $_FILES['attachment']['size'][0] > 0){
					//upload file
					$upload_details = $this->common_model->upload_department_files_admin('attachment');		// upload_multiple_file
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
						redirect(ADMIN_BASE_URL.'training/training_program');
					}else{
						$update['attachment'] = implode(';',$upload_details['filenames']);
					}
				}


				$emp_concerned = $this->input->post('emp_concerned');
				$try_insp_prg_id = $this->input->post('try_insp_id',true);

				if($error == ''){
					if(!empty($id)){ // edit
						$this->accounts_model->update_inspection_to_employee($id,$emp_concerned);
						$emp_tr_id = $this->accounts_model->emp_inspection_details_record($try_insp_prg_id, $emp_concerned);
						$this->session->set_flashdata('success','Successfully updated and SMS sent.');						
					}else{ // add
//						$update['order_dt'] = date('Y-m-d H:i:s');
//      				$update['order_dt'] = date('Y-m-d',strtotime($this->input->post('order_dt')));				
						$this->accounts_model->add_inspection_to_employee($id,$emp_concerned);
						$emp_tr_id = $this->accounts_model->emp_inspection_details_record($try_insp_prg_id,$emp_concerned);
						$this->session->set_flashdata('success','Successfully allotted and SMS sent.');
					}
					redirect(ADMIN_BASE_URL.'accounts/treasury_inspection');
				}
			}
		}
		
		
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
				
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/treasury_inspection_assignment',$data);
		$this->load->view('agadmin/layout/footer');
	}	
/*
	public function treasury_inspection_edit(){
		$this->load->model('accounts_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['treasury_list'] = $this->accounts_model->get_all_treasury_list();
		$data['district_list'] = $this->accounts_model->get_all_district_list();
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->accounts_model->get_try_inspection_master_details($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
		if($this->input->post()){
			$this->accounts_model->update_inspection_master_record($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'accounts/treasury_inspection');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/treasury_inspection_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}	
*/	
	
	public function treasury_inspection_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/treasury_inspection_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function treasury_inspection_ajax_upload(){
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
			
			$header_security_field =  array('TRY_INSP_ID','INSP_YEAR','INSP_PARTY_NO');
			
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
				//					$this->db->insert_batch('treasury_inspection_master',$bulk);
				//				}
				//			}else{
				//				$this->db->insert_batch('treasury_inspection_master',$upload);
				//			}
			foreach($upload as $record){
				$try_insp_id = isset($record['try_insp_id']) ? $record['try_insp_id'] : 0;
				$insp_year = isset($record['insp_year']) ? $record['insp_year'] : 0;
				$training_from = isset($record['training_from']) ? $record['training_from'] : 0;
				$record['update_dt'] = date('Y-m-d H:i:s');
				// check records exists
				$res = $this->db->get_where('treasury_inspection_master',array('try_insp_id'=>$try_insp_id,'insp_year'=>$insp_year));
				if($res->num_rows() > 0){
					
					$this->db->where('try_insp_id',$try_insp_id)->where('insp_year',$insp_year)->update('treasury_inspection_master',$record);
				}else{					
					$this->db->insert('treasury_inspection_master',$record);
				}
				$this->db->insert('commutation_factors',$record);
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
	
	public function treasury_inspection_assignment(){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['treasuries'] = $this->accounts_model->get_all_treasury_list();
		$data['districts'] = $this->accounts_model->get_all_district_list();		
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
			$data['row'] = $this->accounts_model->getInspectionPrgByID($id);
			$data['asign_emp'] = $this->accounts_model->getInspectionPrgToEmployees($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$error = '';
		if($this->input->post()){
			$this->form_validation->set_rules('tr_nm', 'Tr_nm', 'required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				$update = array(
							'tr_nm'		=> $this->input->post('title',true),
							'details'	=> $this->input->post('details'),
							'order_dt'	=> date('Y-m-d',strtotime($this->input->post('order_dt'))),
							'update_dt'	=> date('Y-m-d H:i:s')
						);
				if(isset($_FILES['attachment']) && $_FILES['attachment']['size'][0] > 0){
					//upload file
					$upload_details = $this->common_model->upload_department_files_admin('attachment');		// upload_multiple_file
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
						redirect(ADMIN_BASE_URL.'accounts/treasury_inspection');
					}else{
						$update['attachment'] = implode(';',$upload_details['filenames']);
					}
				}


				$emp_concerned = $this->input->post('emp_concerned');
				$try_insp_prg_id = $this->input->post('try_insp_id',true);

				if($error == ''){
					if(!empty($id)){ // edit
						$this->accounts_model->update_inspection_to_employee($id,$emp_concerned);
						$emp_tr_id = $this->accounts_model->emp_inspection_details_record($try_insp_prg_id, $emp_concerned);
						$this->session->set_flashdata('success','Successfully updated and SMS sent.');						
					}else{ // add
//						$update['order_dt'] = date('Y-m-d H:i:s');
//      				$update['order_dt'] = date('Y-m-d',strtotime($this->input->post('order_dt')));				
						$this->accounts_model->add_inspection_to_employee($id,$emp_concerned);
						$emp_tr_id = $this->accounts_model->emp_inspection_details_record($try_insp_prg_id,$emp_concerned);
						$this->session->set_flashdata('success','Successfully allotted and SMS sent.');
					}
					redirect(ADMIN_BASE_URL.'accounts/treasury_inspector_record');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/treasury_inspection_assignment',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function treasury_inspector_record(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->accounts_model->get_employee_inspection_records($page_no);
		$data['results'] = $response['results'];
		
		$data['training_ids'] = $this->accounts_model->get_all_inspection_ids();
		$data['training_types'] = $this->accounts_model->get_all_treasuries_inspected();
		
		$config['base_url'] = base_url().'/admin/accounts/treasury_inspector_record';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/treasury_inspector_record',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function treasury_inspector_record_edit(){
		$this->load->model('accounts_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['treasury_list'] = $this->accounts_model->get_all_treasury_list();
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->accounts_model->get_try_inspection_record_details($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
		if($this->input->post()){
			$this->accounts_model->update_treasury_inspector_record($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'accounts/treasury_inspection');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/treasury_inspector_record_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}	
	public function all_employees_try_inspection(){
		$headings = array();
		$firstrow = array();
		$all_inspctions = $this->accounts_model->get_all_employees_try_inspection('AGAE');
		if(!empty($all_inspctions)){
			unset($all_inspctions[0]['insp_rec_id']);
			foreach( $all_inspctions[0] as $k => $v ) {
					$headings[] = strtoupper($k);
					$firstrow[] = $v;
			}
			unset($all_inspctions[0]);
		}
		$excel_data[] = $headings;
		$excel_data[1] = $firstrow;
		foreach( $all_inspctions as $row ) {
			unset($row['insp_rec_id']);
			$row['try_insp_from'] = date('d-m-Y  A',strtotime($row['try_insp_from']));
			$excel_data[] = $row;
		}
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('TI Inspections');
		$this->excel->getActiveSheet()->fromArray($excel_data);
		 
		$filename='TI_Inspection'.time().'.xls'; //save our workbook as this file name
		header('Content-Type: Training/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}
	
	public function treasury_inspection_order_print(){
		$this->load->library('m_pdf');	
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		
		$id = $this->input->post('try_insp_id');
		
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->accounts_model->get_inspection_order_print($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$data['candidates'] = $this->accounts_model->get_emp_inspectors_list($id);
		$html = $this->load->view('agadmin/pages/accounts/treasury_inspection_order_print',$data,true);

		$img="/usr/local/apache24/htdocs/assets/images/top-head.png";
		$pdfFilePath ="TI_Order".time().".pdf";
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
	
	public function training(){
		$this->load->model('accounts_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->accounts_model->employee_trainings($page_no);
		$data['results'] = $response['results'];
				
		$config['base_url'] = base_url().'/admin/accounts/training';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/training',$data);
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
		$response = $this->accounts_model->get_transfer_master($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/accounts/section_transfer';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/section_transfer',$data);
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
						redirect(ADMIN_BASE_URL.'accounts/section_transfer_record');
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
					redirect(ADMIN_BASE_URL.'accounts/section_transfer_record');
				}
			}
		}
		
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/section_transfer_assignment',$data);
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
						redirect(ADMIN_BASE_URL.'accounts/section_transfer_record');
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
					redirect(ADMIN_BASE_URL.'accounts/section_transfer_record');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/section_transfer_assignment',$data);
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
		$response = $this->accounts_model->get_employee_transfer_records($page_no,$t_id);
		$data['results'] = $response['results'];
		$config['base_url'] = base_url().'/admin/accounts/section_transfer_record';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/section_transfer_record',$data);
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
					redirect(ADMIN_BASE_URL.'accounts/section_allotment');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/section_transfer_record_edit',$data);
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
		$response = $this->accounts_model->get_admin_section_allotted($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/accounts/section_allotment';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/section_allotment',$data);
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
				redirect(ADMIN_BASE_URL.'accounts/section_transfer_record');
		}
	
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/accounts/section_allotment_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	
	
	
	
	
	
	
	
	
	
} // End of Class
