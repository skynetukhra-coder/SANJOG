<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pension extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('common_model');
		$this->load->model('pension_model');
		$this->load->model('emp_model');
		$this->load->model('wing_model');
		$this->load->library('form_validation');
		$this->load->helper('admin_helper');
		$this->admin = '';
		$this->load->helper('security');	
		if($this->session->userdata('admin_details')){
			$this->admin = $this->session->userdata('admin_details');
		}else{
			redirect('admin');
		}
		$this->admin_type = strtolower($this->admin['admin_type_name']);
		if($this->admin_type == 'superadmin' || $this->admin_type == 'pension'){
			
		}else{
			show_404();
		}
	}
	public function index(){
		
	}
	public function pension(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->pension_model->get_admin_pension($page_no);
		$data['results'] = $response['results'];
		$config['base_url'] = base_url().'/admin/pension/pension';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/pension/pension',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function pension_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/pension/pension_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function pension_ajax_upload(){
		$data['results'] = array();
		$file_name = '';
		if(isset($_FILES) && !empty($_FILES)){
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
		}else{
			$message = 'No file selected.';
			$is_success = false;
		}
		
		if($file_name != ''){
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
			
			$header_security_field =  array('APA_APPLN_PK','APA_PK','PENSION_DATE','EFP_DATE','FP_DATE');
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
			/*$bulk_elem = 10;
			$bulk_upload = array();
			if( count($upload) > $bulk_elem ){
				$bulk_upload = array_chunk($upload,$bulk_elem);
				foreach($bulk_upload as $bulk){
					$this->db->insert_batch('pension',$bulk);
				}
			}else{
				$this->db->insert_batch('pension',$upload);
			}*/
			foreach($upload as $record){
				$id = isset($record['apa_appln_pk']) ? $record['apa_appln_pk'] : 0;
				$id2 = isset($record['apa_pk']) ? $record['apa_pk'] : 0;
				// check records exists
				$res = $this->db->get_where('pension',array('apa_appln_pk'=>$id,'apa_pk'=>$id2));
				if($res->num_rows() > 0){
					@$this->db->where('apa_appln_pk',$id)->where('apa_pk',$id2)->update('pension',$record);
				}else{
					@$this->db->insert('pension',$record);
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
	
	public function pensioner_spouse(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->pension_model->get_admin_pensioner_spouse($page_no);
		$data['results'] = $response['results'];
		$config['base_url'] = base_url().'/admin/pension/pensioner_spouse';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/pension/pensioner_spouse',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function pensioner_spouse_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/pension/pensioner_spouse_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function pensioner_spouse_ajax_upload(){
		$data['results'] = array();
		$file_name = '';
		if(isset($_FILES) && !empty($_FILES)){
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
		}else{
			$message = 'No file selected.';
			$is_success = false;
		}
		
		if($file_name != ''){
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
			
			$header_security_field =  array('APF_APPLN_PK','APF_PK','SPOUSE_NAME','RELATIONSHIP');
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
			/*$bulk_elem = 10;
			$bulk_upload = array();
			if( count($upload) > $bulk_elem ){
				$bulk_upload = array_chunk($upload,$bulk_elem);
				foreach($bulk_upload as $bulk){
					$this->db->insert_batch('pensioner_spouse',$bulk);
				}
			}else{
				$this->db->insert_batch('pensioner_spouse',$upload);
			}*/
			foreach($upload as $record){
				$id = isset($record['apf_appln_pk']) ? $record['apf_appln_pk'] : 0;
				$id2 = isset($record['apf_pk']) ? $record['apf_pk'] : 0;
				// check records exists
				$res = $this->db->get_where('pensioner_spouse',array('apf_appln_pk'=>$id,'apf_pk'=>$id2));
				if($res->num_rows() > 0){
					@$this->db->where('apf_appln_pk',$id)->where('apf_pk',$id2)->update('pensioner_spouse',$record);
				}else{
					@$this->db->insert('pensioner_spouse',$record);
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
	
	public function case_status(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->pension_model->get_admin_case_status($page_no);
		$data['results'] = $response['results'];
		$config['base_url'] = base_url().'/admin/pension/case_status';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/pension/case_status',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function case_status_details($id = ''){
		if($id == ''){
			$res =  array('success'=>false,'msg'=>'No data found!','details'=>array());
			echo json_encode($res);
		}
		$response = $this->pension_model->get_admin_case_status_details($id);
		$res = array('success'=>true,'msg'=>'Case status details','details'=>$response);
		echo json_encode($res);
	}
	public function case_status_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/pension/case_status_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function case_status_ajax_upload(){
		$data['results'] = array();
		$file_name = '';
		if(isset($_FILES) && !empty($_FILES)){
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
		}else{
			$message = 'No file selected.';
			$is_success = false;
		}
		
		if($file_name != ''){
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
			
			$header_security_field =  array('APPLN_PK','FILE_NO','APPLICATION_NO','APPLN_FIRST_NAME','APEN_DOA','APEN_DOB','PNSR_NAME','DESIGNATION','DOR','DOD','DOFIR','PENSION_CLASS','CASE_TYPE','PSA_NAME','TREASURY_PENSION','TREASURY_GRATUITY','INWARD_NO','INWARD_DATE','INOUT_INDX_NO','INOUT_INDX_DATE','REC_DATE','MOBILE_NO','MOBILE_NUM','STATUS_DES','SECTION','MEMO_NO','MEMO_DATE','APEN_BRANCH','APPLN_CHG_NO','F_GET_LOV_NAME_APEN_CATG','UPDATE_DATE');
			foreach($res['header'] as $key => $val){
				if(trim($val) != ''){ // remove empty cel 
					$val = str_replace(array('(',')'),array('_',''),strtoupper($val));
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
			/*$bulk_elem = 10;
			$bulk_upload = array();
			if( count($upload) > $bulk_elem ){
				$bulk_upload = array_chunk($upload,$bulk_elem);
				foreach($bulk_upload as $bulk){
					$this->db->insert_batch('pension_case',$bulk);
				}
			}else{
				$this->db->insert_batch('pension_case',$upload);
			}*/
			$ins = array();
			$ins_count = 0;
			$record_added = 0;
			$record_updated = 0;
			foreach($upload as $record){
				$id = isset($record['appln_pk']) ? $record['appln_pk'] : 0;
				// check records exists
				$res = $this->db->get_where('pension_case',array('appln_pk'=>$id));
				if($res->num_rows() > 0){
					$record_updated++;
					//echo $record_added.' records added. '.$record_updated.' updated.';
					@$this->db->where('appln_pk',$id)->update('pension_case',$record);
					
				}else{
					$ins[] = $record;
					$ins_count++;
					if($ins_count >= 1000){
						$record_added += $ins_count;
						//echo $record_added.' records added. '.$record_updated.' updated.';
						$ins_count = 0;
						@$this->db->insert_batch('pension_case',$ins);
						$ins = array();
						
					}
				}
				
			}
			if(!empty($ins)){
				@$this->db->insert_batch('pension_case',$ins);
				//echo count($ins).' records added. '.$record_updated.' updated.';
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
	
	public function case_dispatched(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->pension_model->get_admin_dispatched_status($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/pension/case_dispatched';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/pension/case_dispatched',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function case_dispatched_details($id = '', $type = ''){
		if($id == '' || $type == ''){
			$res =  array('success'=>false,'msg'=>'No data found!','details'=>array());
			echo json_encode($res);
		}
		$response = $this->pension_model->get_admin_case_dispatched_details($id,$type);
		$res = array('success'=>true,'msg'=>'Case status details','details'=>$response);
		echo json_encode($res);
	}
	public function case_dispatched_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/pension/case_dispatched_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function case_dispatched_ajax_upload(){
		$data['results'] = array();
		$file_name = '';
		if(isset($_FILES) && !empty($_FILES)){
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
		}else{
			$message = 'No file selected.';
			$is_success = false;
		}
		
		if($file_name != ''){
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
			
			$header_security_field =  array('INOUT_APPLN_PK','INOUT_PK','INOUT_NO','INOUT_OUT_TYPE','INOUT_DSPCH_DATE','INOUT_DISPATCH_ARTICAL_NO','F_GET_LOV_NAME_INOUT_DISPATCH_MODE','INOUT_SNDR_NAME','INOUT_OUT_ADDRESS','ADDRESS_1','ADDRESS_2','ADDRESS_3','CITY','PIN');
			
			foreach($res['header'] as $key => $val){
				if(trim($val) != ''){ // remove empty cel 
					$val = str_replace(array('(',')'),array('_',''),strtoupper($val));
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
			/*$bulk_elem = 500;
			$bulk_upload = array();
			if( count($upload) > $bulk_elem ){
				$bulk_upload = array_chunk($upload,$bulk_elem);
				foreach($bulk_upload as $bulk){
					$this->db->insert_batch('pension_case_dispatch',$bulk);
				}
			}else{
				$this->db->insert_batch('pension_case_dispatch',$upload);
			}*/
			$ins = array();
			$ins_count = 0;
			$record_added = 0;
			$record_updated = 0;
			foreach($upload as $record){
				$inout_appln_pk = isset($record['inout_appln_pk']) ? $record['inout_appln_pk'] : 0;
				$inout_out_type = isset($record['inout_out_type']) ? $record['inout_out_type'] : 0;
				// check records exists
				$res = $this->db->get_where('pension_case_dispatch',array('inout_appln_pk'=>$inout_appln_pk,'inout_out_type'=>$inout_out_type));
				if($res->num_rows() > 0){
					$record_updated++;
					//echo $record_added.' records added. '.$record_updated.' updated.';
					@$this->db->where('inout_appln_pk',$inout_appln_pk)->where('inout_out_type',$inout_out_type)->update('pension_case_dispatch',$record);
					
				}else{
					$ins[] = $record;
					$ins_count++;
					if($ins_count >= 1000){
						$record_added += $ins_count;
						//echo $record_added.' records added. '.$record_updated.' updated.';
						$ins_count = 0;
						@$this->db->insert_batch('pension_case_dispatch',$ins);
						$ins = array();
						
					}
				}
				
			}
			if(!empty($ins)){
				@$this->db->insert_batch('pension_case_dispatch',$ins);
				//echo count($ins).' records added. '.$record_updated.' updated.';
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
	
	public function case_return(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->pension_model->get_admin_return_status($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/pension/case_return';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/pension/case_return',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function case_return_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/pension/case_return_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function case_return_ajax_upload(){
		$data['results'] = array();
		$file_name = '';
		if(isset($_FILES) && !empty($_FILES)){
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
		}else{
			$message = 'No file selected.';
			$is_success = false;
		}
		
		if($file_name != ''){
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
			
			$header_security_field =  array('APR_PK','APR_REJECT_REASON','APR_REM','APR_PRIMARY_REASON','APR_APPLN_PK');
			
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
			/*$bulk_elem = 10;
			$bulk_upload = array();
			if( count($upload) > $bulk_elem ){
				$bulk_upload = array_chunk($upload,$bulk_elem);
				foreach($bulk_upload as $bulk){
					@$this->db->insert_batch('pension_case_return_reason',$bulk);
				}
			}else{
				@$this->db->insert_batch('pension_case_return_reason',$upload);
			}*/
			$ins = array();
			$ins_count = 0;
			$record_added = 0;
			$record_updated = 0;
			foreach($upload as $record){
				$id = isset($record['apr_pk']) ? $record['apr_pk'] : 0;
				$id2 = isset($record['apr_appln_pk']) ? $record['apr_appln_pk'] : 0;
				// check records exists
				$res = $this->db->get_where('pension_case_return_reason',array('apr_pk'=>$id,'apr_appln_pk'=>$id2));
				if($res->num_rows() > 0){
					$record_updated++;
					//echo $record_added.' records added. '.$record_updated.' updated.';
					@$this->db->where('apr_pk',$id)->where('apr_appln_pk',$id2)->update('pension_case_return_reason',$record);
					
				}else{
					$ins[] = $record;
					$ins_count++;
					if($ins_count >= 1000){
						$record_added += $ins_count;
						//echo $record_added.' records added. '.$record_updated.' updated.';
						$ins_count = 0;
						@$this->db->insert_batch('pension_case_return_reason',$ins);
						$ins = array();
						
					}
				}
				
			}
			if(!empty($ins)){
				@$this->db->insert_batch('pension_case_return_reason',$ins);
				//echo count($ins).' records added. '.$record_updated.' updated.';
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
	
	public function ppo(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->pension_model->get_admin_pensioner_ppo_no($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/pension/ppo';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/pension/ppo',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function ppo_delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->pension_model->getPPO_ByID($id);
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->pension_model->deletePPO_ByID($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'pension/ppo');
	}
	public function ppo_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/pension/ppo_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function ppo_ajax_upload(){
		$data['results'] = array();
		$file_name = '';
		if(isset($_FILES) && !empty($_FILES)){
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
		}else{
			$message = 'No file selected.';
			$is_success = false;
		}
		
		if($file_name != ''){
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
			
			$header_security_field =  array('APA_APPLN_PK','PPO_NO');
			
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
			/*$bulk_elem = 10;
			$bulk_upload = array();
			if( count($upload) > $bulk_elem ){
				$bulk_upload = array_chunk($upload,$bulk_elem);
				foreach($bulk_upload as $bulk){
					@$this->db->insert_batch('pension_to_ppo',$bulk);
				}
			}else{
				@$this->db->insert_batch('pension_to_ppo',$upload);
			}*/
			foreach($upload as $record){
				$apa_appln_pk = isset($record['apa_appln_pk']) ? $record['apa_appln_pk'] : 0;
				$ppo_no = isset($record['ppo_no']) ? $record['ppo_no'] : 0;
				// check records exists
				$res = $this->db->get_where('pension_to_ppo',array('apa_appln_pk'=>$apa_appln_pk,'ppo_no'=>$ppo_no));
				if($res->num_rows() > 0){
					//$this->db->where('apa_appln_pk',$apa_appln_pk)->update('pension_to_ppo',$record);
				}else{
					$this->db->insert('pension_to_ppo',$record);
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
	public function ppo_duplicate(){
		$this->load->model('pension_model');
		$headings = array();
		$firstrow = array();
		$duplicate_ppo = $this->pension_model->get_duplicate_ppo_list();	
		if(!empty($duplicate_ppo)){
			unset($duplicate_ppo[0]['p_p_id']);
			foreach( $duplicate_ppo[0] as $k => $v ) {
					$headings[] = strtoupper($k);
					$firstrow[] = $v;
			}
			unset($duplicate_ppo[0]);
		}
		$excel_data[] = $headings;
		$excel_data[1] = $firstrow;
		foreach( $duplicate_ppo as $row ) {
			unset($row['p_p_id']);
			$excel_data[] = $row;
		}
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('PPP LIST');
		$this->excel->getActiveSheet()->fromArray($excel_data);
		 
		$filename='Duplicate_PPOs_'.time().'.xls'; //save our workbook as this file name
		header('Content-Type: PPO/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}
		
		
	public function circular_office_order(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->wing_model->get_pension_circular_office_order($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/pension/circular_office_order';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/pension/circular_office_order',$data);
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
			$this->form_validation->set_rules('description_hindi', 'description_hindi', 'required');
			$this->form_validation->set_rules('description_bengali', 'description_bengali', 'required');
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
					redirect(ADMIN_BASE_URL.'pension/circular_office_order');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/pension/circular_office_order_add',$data);
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
		redirect(ADMIN_BASE_URL.'pension/circular_office_order');
	}
	public function circular_office_order_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/pension/circular_office_order_upload',$data);
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
		$response = $this->wing_model->get_pension_office_order($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/pension/office_order';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/pension/office_order',$data);
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
					//$upload_details = $this->common_model->upload_multiple_file('attachment');
					$upload_details = $this->common_model->upload_multiple_order_cicular('attachment');
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
						redirect(ADMIN_BASE_URL.'pension/office_order');
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
					redirect(ADMIN_BASE_URL.'pension/office_order');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/pension/office_order_add',$data);
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
					$upload_details = $this->common_model->upload_multiple_file('attachment');
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
						redirect(ADMIN_BASE_URL.'pension/office_order');
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
					redirect(ADMIN_BASE_URL.'administration/office_order');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/pension/office_order_edit',$data);
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
		redirect(ADMIN_BASE_URL.'pension/office_order');
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
		
		$config['base_url'] = base_url().'/admin/pension/order_employee';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/pension/order_employee',$data);
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
		$response = $this->wing_model->get_pension_all_circular($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/pension/document_order';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/pension/document_order',$data);
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
					//$upload_details = $this->common_model->upload_multiple_file('attachment');
					$upload_details = $this->common_model->upload_multiple_order_cicular('attachment');
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
						redirect(ADMIN_BASE_URL.'pension/document_order');
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
					redirect(ADMIN_BASE_URL.'pension/document_order');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/pension/document_order_add',$data);
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
		redirect(ADMIN_BASE_URL.'pension/document_order');
	}
	
	public function upload_files(){
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/pension/upload_files');
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
		$response = $this->common_model->all_pension_feedback($page_no);
		$data['results'] = $response['results'];
		
		$data['all_groups'] = $this->common_model->get_all_groups();
		
		$config['base_url'] = base_url().'/admin/pension/feedback';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/pension/feedback',$data);
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
			$this->common_model->update_pension_feedback_action($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'pension/feedback');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/pension/feedback_action',$data);
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
		$html = $this->load->view('agadmin/pages/pension/feedback_pdf',$data,true);//load the pdf_output.php by passing our data and get all data in $html varriable.
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
		$response = $this->emp_model->get_epabx_extension_list_pension($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/pension/epabx_list';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/pension/epabx_list',$data);
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
			redirect(ADMIN_BASE_URL.'pension/epabx_list');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/pension/epabx_list_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function training(){
		$this->load->model('pension_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->pension_model->employee_trainings($page_no);
		$data['results'] = $response['results'];
				
		$config['base_url'] = base_url().'/admin/pension/training';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/pension/training',$data);
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
		$response = $this->pension_model->get_transfer_master($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/pension/section_transfer';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/pension/section_transfer',$data);
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
						redirect(ADMIN_BASE_URL.'pension/section_transfer_record');
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
					redirect(ADMIN_BASE_URL.'pension/section_transfer_record');
				}
			}
		}
		
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/pension/section_transfer_assignment',$data);
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
						redirect(ADMIN_BASE_URL.'pension/section_transfer_record');
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
					redirect(ADMIN_BASE_URL.'pension/section_transfer_record');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/pension/section_transfer_assignment',$data);
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
		$response = $this->pension_model->get_employee_transfer_records($page_no,$t_id);
		$data['results'] = $response['results'];
		$config['base_url'] = base_url().'/admin/pension/section_transfer_record';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/pension/section_transfer_record',$data);
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
					redirect(ADMIN_BASE_URL.'pension/section_allotment');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/pension/section_transfer_record_edit',$data);
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
		$response = $this->pension_model->get_admin_section_allotted($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/pension/section_allotment';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/pension/section_allotment',$data);
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
				redirect(ADMIN_BASE_URL.'pension/section_transfer_record');
		}
	
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/pension/section_allotment_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function pension_payment(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->pension_model->get_pension_payment_records($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/pension/pension_payment';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/pension/pension_payment',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function payment_records_download(){
		$this->load->model('pension_model');
		$headings = array();
		$firstrow = array();
		$all_applcations = $this->pension_model->get_payment_records_download();
		if(!empty($all_applcations)){
//			unset($all_applcations[0]['appl_id']);
			foreach( $all_applcations[0] as $k => $v ) {
					$headings[] = strtoupper($k);
					$firstrow[] = $v;
			}
			unset($all_applcations[0]);
		}
		$excel_data[] = $headings;
		$excel_data[1] = $firstrow;
		foreach( $all_applcations as $row ) {
//			unset($row['appl_id']);
			$row['appl_dt'] = date('d-m-Y  A',strtotime($row['appl_dt']));
			$excel_data[] = $row;
		}
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Applications');
		$this->excel->getActiveSheet()->fromArray($excel_data);
		 
		$filename='Payment_appl_'.time().'.xls'; //save our workbook as this file name
		header('Content-Type: Feednacl/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}
	
	public function upppogpocpo(){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		
		$config['base_url'] = base_url().'/admin/pension/upppogpocpo';
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/pension/upppogpocpo',$data);
		$this->load->view('agadmin/layout/footer');
	}

	public function upload_ppogpocpo(){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		
		if($this->input->post()){
				if(isset($_FILES['attachment']) && $_FILES['attachment']['size'][0] > 0){
					//upload file
					$upload_details = $this->common_model->upload_multiple_ppogpocpo('attachment');
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
						redirect(ADMIN_BASE_URL.'admin_ii/form_sixteen');
					}else{
						$this->session->set_flashdata('success',$upload_details['message']);
					}
				}
		}	
		$config['base_url'] = base_url().'/admin/pension/upload_ppogpocpo';
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/pension/upload_ppogpocpo',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
} // End of Class
