<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Treasury extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->lang->load('main','english');
		$this->load->model('accounts_model');
		$this->load->model('wing_model');
		$this->load->model('common_model');
		$this->load->model('page_model');
		if($this->session->userdata('language_id')){
			$this->language_id = $this->session->userdata('language_id');
		}else{
			$this->language_id = 1;
		}
		
	}
	public function login(){
		if($this->session->userdata('treasury_data')){
			redirect('treasury/dashboard');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		if($this->input->post()){
			$this->form_validation->set_rules('users', 'Treasury User Id', 'required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
			$this->form_validation->set_rules('c_image', 'Image Code', 'required|xss_clean',array('required'=> 'Please write image code'));
			if ($this->form_validation->run() == FALSE){
               $data['error'] = validation_errors();
            }else{
				$cap_code = $this->session->userdata('cap_data');
				if($cap_code != $this->input->post('c_image')){
					$data['error'] = $this->lang->line('image_code_not_matched');
				}else{
					$code = $this->input->post('users',true);
					$pass = $this->input->post('password',true);
					$login_details = $this->accounts_model->treasury_login($code,$pass);
					if(empty($login_details)){
						$data['error'] = $this->lang->line('wrong_credentials');
					}else{
						$this->session->set_userdata('treasury_data',$login_details);
						$is_uopdate = $this->accounts_model->update_treasury_last_login($code);
						$this->session->set_flashdata('success',$this->lang->line('successfully_logged_in'));
						redirect('treasury/dashboard');
					}
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/treasury/login',$data);
		$this->load->view('layout/footer');
	}
	
	public function registration(){
		if($this->session->userdata('treasury_data')){
			redirect('treasury/dashboard');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		if($this->input->post()){
			$this->form_validation->set_rules('users', 'Treasury User Id', 'required|xss_clean');
			$this->form_validation->set_rules('mobile', 'Mobile', 'required|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'xss_clean');
			$this->form_validation->set_rules('c_image', 'Image Code', 'required|xss_clean',array('required'=> 'Please write image code'));
			if ($this->form_validation->run() == FALSE){
               $data['error'] = validation_errors();
            }else{
				$cap_code = $this->session->userdata('cap_data');
				if($cap_code != $this->input->post('c_image')){
					$data['error'] = $this->lang->line('image_code_not_matched');
				}else{
					$reg_status = $this->accounts_model->treasury_registration();
					if($reg_status['success'] === false){
						$data['error'] = $reg_status['msg'];
					}else{
						$trs_details = $reg_status['details'];
						$this->session->set_userdata('trs_reg',$trs_details['users']);
						$email = '';
						$mobile = '';
						if(!empty($trs_details['emailid'])){
							$email = $trs_details['emailid'];
						}
						if(!empty($trs_details['mb_no'])){
							$mobile = $trs_details['mb_no'];
						}
						send_OTP($email,$mobile); // from helper
						$this->session->set_flashdata('success',$this->lang->line('OTP_sent_to_mobile_email'));
						redirect('treasury/otp');
					}
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/treasury/registration',$data);
		$this->load->view('layout/footer');
	}
	public function forgot_password(){
		if($this->session->userdata('treasury_data')){
			redirect('treasury/dashboard');
		}
		$this->load->helper('security');
		
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		if($this->input->post()){
			$this->form_validation->set_rules('users', 'Treasury Code', 'required|xss_clean');
			$this->form_validation->set_rules('mobile', 'Mobile', 'required|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'xss_clean');
			$this->form_validation->set_rules('c_image', 'Image Code', 'required|xss_clean',array('required'=> 'Please write image code'));
			if ($this->form_validation->run() == FALSE){
               $data['error'] = validation_errors();
            }else{
				$cap_code = $this->session->userdata('cap_data');
				if($cap_code != $this->input->post('c_image')){
					$data['error'] = $this->lang->line('image_code_not_matched');
				}else{
					$reg_status = $this->accounts_model->treasury_forgot_password();
					if($reg_status['success'] === false){
						$data['error'] = $reg_status['msg'];
					}else{
						$trs_details = $reg_status['details'];
						$this->session->set_userdata('trs_reg',$trs_details['users']);
						$email = '';
						$mobile = '';
						if(!empty($trs_details['emailid'])){
							$email = $trs_details['emailid'];
						}
						if(!empty($trs_details['mb_no'])){
							$mobile = $trs_details['mb_no'];
						}
						send_OTP($email,$mobile); // from helper
						$this->session->set_flashdata('success',$this->lang->line('OTP_sent_to_mobile_email'));
						redirect('treasury/otp');
					}
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/treasury/forgot_password',$data);
		$this->load->view('layout/footer');
	}
	public function otp(){
		if($this->session->userdata('treasury_data')){
			redirect('treasury/dashboard');
		}
		if(!$this->session->userdata('trs_reg')){
			show_404();
		}
		if(!$this->session->has_userdata('agot')){
			show_404();
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		if($this->input->post()){
			$this->form_validation->set_rules('otp', 'OTP', 'required|xss_clean');
			//$this->form_validation->set_rules('c_image', 'Image Code', 'required|xss_clean',array('required'=> 'Please write image code'));
			if ($this->form_validation->run() == FALSE){
               $data['error'] = validation_errors();
            }else{
				//$cap_code = $this->session->userdata('cap_data');
				//if($cap_code != $this->input->post('c_image')){
				//	$data['error'] = $this->lang->line('image_code_not_matched');
				//}else{
					$otp = $this->input->post('otp',true);
					$is_validate = validate_OTP($otp); // from helper
					if($is_validate){
						$this->session->set_userdata('nxt_pg','trs_re_pass');
						$this->session->set_flashdata('success',$this->lang->line('OTP_matched_reset_pass'));
						redirect('treasury/reset_password');
					}
				//}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/treasury/otp',$data);
		$this->load->view('layout/footer');
	
	}
	public function reset_password(){
		if($this->session->userdata('treasury_data')){
			redirect('treasury/dashboard');
		}
		if(!$this->session->userdata('trs_reg')){
			show_404();
		}
		if($this->session->userdata('nxt_pg') && $this->session->userdata('nxt_pg') == 'trs_re_pass'){
			
		}else{
			show_404();
		}
		$this->load->helper('security');
		
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		if($this->input->post()){
			$this->form_validation->set_rules('pass', 'Password', 'required|xss_clean');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[pass]|xss_clean');
			//$this->form_validation->set_rules('c_image', 'Image Code', 'required|xss_clean',array('required'=> 'Please write image code'));
			if ($this->form_validation->run() == FALSE){
               $data['error'] = validation_errors();
            }else{
				//$cap_code = $this->session->userdata('cap_data');
				//if($cap_code != $this->input->post('c_image')){
				//	$data['error'] = $this->lang->line('image_code_not_matched');
				//}else if( ! $this->session->userdata('emp_reg')){
				//	$data['error'] = 'Opps! Try again.';
			//	}else{
					$users = $this->session->userdata('trs_reg');
					$pass = $this->input->post('pass',true);
					$this->accounts_model->treasury_reset_password($users,$pass);
					$this->session->set_flashdata('success',$this->lang->line('password_updated_login_now'));
					$this->session->unset_userdata('nxt_pg');
					redirect('treasury/login');
			//	}
			}
		}
		//$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/treasury/reset_password',$data);
		$this->load->view('layout/footer');
	}
	
/*
//--------------------------------------
//FILES_ORIGINAL----Dashboard
	public function dashboard(){
		$this->load->model('wing_model');
		if(!$this->session->userdata('treasury_data')){
			redirect('treasury/login');
		}
		$data['treasury_data'] = $this->session->userdata('treasury_data');
		$data['header']['users'] = $data['treasury_data']['users'];
		$data['header']['user_name'] = $data['treasury_data']['user_name'];
		
		$data['details'] = $this->wing_model->get_treasury_files($data['treasury_data']['tr_cd']);
		$this->load->view('layout/header');
		$this->load->view('pages/treasury/dashboard',$data);
		$this->load->view('layout/footer');
	}
*/
//--------------------------------------
//PAGE_VIEW -----Dashboard

	public function dashboard(){
		if(!$this->session->userdata('treasury_data')){
			redirect('treasury/login');
		}
		$this->load->model('wing_model');
		$data['treasury_data'] = $this->session->userdata('treasury_data');
		$data['header']['users'] = $data['treasury_data']['users'];
		$data['header']['user_name'] = $data['treasury_data']['user_name'];

		$page_url = 'treasury-accounts-status';
		$data['details'] = $this->page_model->getPageByURL($this->language_id,$page_url);

		$this->load->view('layout/header');
		if ($data['header']['users'] =='AUDIT1'){
			redirect(SITE_BASE_URL.'treasury/audit_matrix');
		}else{
			$this->load->view('pages/treasury/dashboard',$data);
		}
		$this->load->view('layout/footer');	
	}
	

/*
//--------------------------------------
// AUTO COUNTING PAGE VIEW---Dashboard

	public function dashboard(){
		if(!$this->session->userdata('treasury_data')){
			redirect('treasury/login');
		}
		
		$data['treasury_data'] = $this->session->userdata('treasury_data');
		$data['header']['users'] = $data['treasury_data']['users'];
		$data['header']['user_name'] = $data['treasury_data']['user_name'];
		$users = $data['treasury_data']['users'];;
/*
// add Treasury List to Treasury_Status Table
		$try_list = array();
		$data['try_list'] = $this->accounts_model->get_treasury_status_try_list();
		$try_list = array_column($data['try_list'],'tr_nm','tr_cd');
		$id=$this->accounts_model->add_Try_list_ToTreasuryStatus($try_list);

// update data of  Treasury_Status Table
		$misclass = array();
		$data['misclass'] = $this->accounts_model->get_treasury_status_misclass();
		$misclass = array_column($data['misclass'],'misc','tr_cd');
		$id=$this->accounts_model->update_misclass_ToTreasuryStatus($misclass);
		$obsuspens = array();
		$data['obsuspens'] = $this->accounts_model->get_treasury_status_obsuspense();
		$obsuspens = array_column($data['obsuspens'],'obsc','tr_cd');
		$id=$this->accounts_model->update_obsuspens_ToTreasuryStatus($obsuspens);
		$irparas = array();
		$data['irparas'] = $this->accounts_model->get_treasury_status_paras();
		$irparas = array_column($data['irparas'],'parac','tr_cd');
		$id=$this->accounts_model->update_irparas_ToTreasuryStatus($irparas);
		$cmemos = array();
		$data['cmemos'] = $this->accounts_model->get_treasury_status_cmomos();
		$cmemos = array_column($data['cmemos'],'memos','tr_cd');
		$id=$this->accounts_model->update_cmemos_ToTreasuryStatus($cmemos);
// dashboard data from Treasury_Status Table
		$data['results'] = $this->accounts_model->get_treasury_status_dashboard();

		$this->load->view('layout/header');
		$this->load->view('pages/treasury/dashboard',$data);
		$this->load->view('layout/footer');
	}
*/	

	public function profile(){
		if(!$this->session->userdata('treasury_data')){
			redirect('treasury/login');
		}
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->helper('security');
		$data['treasury_data'] = $this->session->userdata('treasury_data');
		$data['header']['users'] = $data['treasury_data']['users'];
		$data['header']['user_name'] = $data['treasury_data']['user_name'];
		
		$data['profile'] = $this->accounts_model->get_treasury_profile($data['treasury_data']['users']);
		if($this->input->post()){
			$this->form_validation->set_rules('email', 'Email Id', 'required|valid_email|xss_clean');
			$this->form_validation->set_rules('phone', 'Phone', 'required|xss_clean');
			if($this->input->post('password') != '' || $this->input->post('confirm_password') != ''){
				$this->form_validation->set_rules('password', 'Password', 'xss_clean');
				$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'xss_clean|matches[password]');
			}
			$this->form_validation->set_rules('c_image', 'Image Code', 'required|xss_clean',array('required'=> 'Please write image code'));
			if ($this->form_validation->run() == FALSE){
               $data['error'] = validation_errors();
            }else{
				$cap_code = $this->session->userdata('cap_data');
				if($cap_code != $this->input->post('c_image')){
					$data['error'] = $this->lang->line('image_code_not_matched');
				}else{
					$is_uopdate = $this->accounts_model->update_treasury_profile($data['treasury_data']['users']);
					if($is_uopdate){
						$this->session->set_flashdata('success',$this->lang->line('successfully_updated'));
						redirect('treasury/dashboard');
					}
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/treasury/profile',$data);
		$this->load->view('layout/footer');
	}
	public function logout(){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$arr_feed['tryid'] 	= $this->session->userdata('treasury_data')['users'];
		$arr_feed['name'] 	= $this->session->userdata('treasury_data')['tr_nm'];
		$arr_feed['mobile'] = $this->session->userdata('treasury_data')['mb_no'];
		$arr_feed['email']  = $this->session->userdata('treasury_data')['emailid'];
		$this->session->set_userdata('user_details_for_feedback',$arr_feed);
		if(!$this->session->userdata('treasury_data')){
			redirect('treasury/login');
		}else{
			$this->session->unset_userdata('treasury_data');
			$this->session->set_flashdata('success',$this->lang->line('give_your_feedback'));
			redirect('feedback');
		}
		$this->load->view('layout/header');
		$this->load->view('pages/treasury/login',$data);
		$this->load->view('layout/footer');
	}
	
	public function treasury_review_report(){
		if(!$this->session->userdata('treasury_data')){
			redirect('treasury/login');
		}
		$this->load->library('pagination');
		$data['treasury_data'] = $this->session->userdata('treasury_data');
		$data['header']['users'] = $data['treasury_data']['users'];
		$data['header']['user_name'] = $data['treasury_data']['user_name'];

		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;		
		$response = $this->accounts_model->get_treasury_review_report($page_no);
		$data['results'] = $response['results'];

		$config['base_url'] = base_url().'treasury/orders';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;	
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		$this->load->view('layout/header');
		$this->load->view('pages/treasury/treasury_review_report',$data);
		$this->load->view('layout/footer');
	}
	
	public function orders(){
		if(!$this->session->userdata('treasury_data')){
			redirect('treasury/login');
		}
		$this->load->library('pagination');
		$data['treasury_data'] = $this->session->userdata('treasury_data');
		$data['header']['users'] = $data['treasury_data']['users'];
		$data['header']['user_name'] = $data['treasury_data']['user_name'];

		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;		
		$response = $this->accounts_model->get_treasury_office_orders($page_no);
		$data['results'] = $response['results'];

		$config['base_url'] = base_url().'treasury/orders';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;	
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		$this->load->view('layout/header');
		$this->load->view('pages/treasury/orders',$data);
		$this->load->view('layout/footer');
	}
	
	public function documents(){
		if(!$this->session->userdata('treasury_data')){
			redirect('treasury/login');
		}
		$this->load->library('pagination');
		$data['treasury_data'] = $this->session->userdata('treasury_data');
		$data['header']['users'] = $data['treasury_data']['users'];
		$data['header']['user_name'] = $data['treasury_data']['user_name'];
		
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;		
		$response = $this->accounts_model->get_treasury_office_documents($page_no, $data['treasury_data']['users']);	
		$data['results'] = $response['results'];
//		echo $this->db->last_query();
//		exit;
		$config['base_url'] = base_url().'treasury/documents';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;	
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		
		$this->load->view('layout/header');
		$this->load->view('pages/treasury/documents',$data);
		$this->load->view('layout/footer');
	}
	public function audit_matrix(){
		if(!$this->session->userdata('treasury_data')){
			redirect('treasury/login');
		}
		$this->load->library('pagination');
		$data['treasury_data'] = $this->session->userdata('treasury_data');
		$data['header']['users'] = $data['treasury_data']['users'];
		$data['header']['user_name'] = $data['treasury_data']['user_name'];
		
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;		
		$response = $this->accounts_model->get_treasury_office_matrix($page_no, $data['treasury_data']['users']);	
		$data['results'] = $response['results'];
//		echo $this->db->last_query();
//		exit;
		$config['base_url'] = base_url().'treasury/audit_matrix';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;	
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		
		$this->load->view('layout/header');
		$this->load->view('pages/treasury/audit_matrix',$data);
		$this->load->view('layout/footer');
	}
	public function treasury_ir(){
		if(!$this->session->userdata('treasury_data')){
			redirect('treasury/login');
		}
		$this->load->library('pagination');
		$data['treasury_data'] = $this->session->userdata('treasury_data');
		$data['header']['users'] = $data['treasury_data']['users'];
		$data['header']['user_name'] = $data['treasury_data']['user_name'];
		
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;		
		$response = $this->accounts_model->get_treasury_office_inspection_report($page_no, $data['treasury_data']['users']);	
		$data['results'] = $response['results'];

		$config['base_url'] = base_url().'treasury/treasury_ir';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;	
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		
		$this->load->view('layout/header');
		$this->load->view('pages/treasury/treasury_ir',$data);
		$this->load->view('layout/footer');
	}
	public function treasury_reports_all(){
		if(!$this->session->userdata('treasury_data')){
			redirect('treasury/login');
		}
		$this->load->library('pagination');
		$data['treasury_data'] = $this->session->userdata('treasury_data');
		$data['header']['users'] = $data['treasury_data']['users'];
		$data['header']['user_name'] = $data['treasury_data']['user_name'];
		
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;		
		$response = $this->accounts_model->get_treasury_reports_all($page_no, $data['treasury_data']['users']);	
		$data['results'] = $response['results'];

		$config['base_url'] = base_url().'treasury/treasury_reports_all';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;	
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		
		$this->load->view('layout/header');
		$this->load->view('pages/treasury/treasury_reports_all',$data);
		$this->load->view('layout/footer');
	}
	public function ob_suspense(){
		if(!$this->session->userdata('treasury_data')){
			redirect('treasury/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['treasury_data'] = $this->session->userdata('treasury_data');
		$data['header']['users'] = $data['treasury_data']['users'];
		$data['header']['user_name'] = $data['treasury_data']['user_name'];
		
		$data['fin_yr_list'] = $this->accounts_model->get_all_obsuspense_fin_yr_list();
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;		
		$response = $this->accounts_model->get_tresury_obsuspense_records($page_no, $data['treasury_data']['users']);	
		$data['results'] = $response['results'];

		$config['base_url'] = base_url().'treasury/ob_suspense';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;	
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		
		$this->load->view('layout/header');
		$this->load->view('pages/treasury/ob_suspense',$data);
		$this->load->view('layout/footer');
	}
	
	public function ob_suspense_upload(){
		if(!$this->session->userdata('treasury_data')){
			redirect('treasury/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		$data['treasury_data'] = $this->session->userdata('treasury_data');
		$data['header']['users'] = $data['treasury_data']['users'];
		$data['header']['user_name'] = $data['treasury_data']['user_name'];
		$data['profile'] = $data['treasury_data'];
		$users= $data['treasury_data']['users'];
		$id = $this->uri->segment(3);
		$action_status=$this->input->post('action_status');
		$data['row'] = array();
		$data['records']=array();		
		if(!empty($id)){		
			$data['records'] = $this->accounts_model->fetch_try_obsuspense_records_by_id($id);		
			if(empty($data['records'])){
				show_404('admin');
			}
		}
		else{
			show_404('admin');
		}

		if($this->input->post()){
//------------------- upload file				
						if(isset($_FILES['try_attachment']) && $_FILES['try_attachment']['size'] > 0){
						//upload file
						$upload_details = $this->common_model->upload_department_files('try_attachment'); //SINGLE FILE UPLOAD
						//print_r ($upload_details);										
						if(!$upload_details['is_success']){
							$this->session->set_flashdata('error',$upload_details['message']);
							$error = $upload_details['message'];
						}else{
//							$this->input->post('try_attachment',$upload_details['filename']);
							$_POST['try_attachment'] = $upload_details['filename'];
						}
						}					
			$this->accounts_model->update_try_obsuspense_records($id,$users );
			$this->session->set_flashdata('success','Successfully submitted.');
			redirect(SITE_BASE_URL.'treasury/ob_suspense');
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/treasury/ob_suspense_upload',$data);
		$this->load->view('layout/footer');
	}

	public function treasury_report(){
		if(!$this->session->userdata('treasury_data')){
			redirect('treasury/login');
		}
		$this->load->model('wing_model');
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		$data['treasury_data'] = $this->session->userdata('treasury_data');
		$data['header']['users'] = $data['treasury_data']['users'];
		$data['header']['user_name'] = $data['treasury_data']['user_name'];
		$data['profile'] = $data['treasury_data'];
		$users= $data['treasury_data']['users'];
//		$data['treasury_list'] = $this->accounts_model->get_treasury_name($users);
		
		$id = $this->uri->segment(4);
		$data['row'] = array();
		$data['asign_try'] = array();
		if(!empty($id)){
			$data['row'] = $this->wing_model->getTreasuryReportByID($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}

		$error = '';
		if($this->input->post()){
			$this->form_validation->set_rules('report_desc', 'Report_desc', 'required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				$update = array(
							'tr_cd'		=> $users,
							'tr_nm'		=> $this->input->post('tr_nm',true),
							'report_year'		=> $this->input->post('report_year',true),
							'report_month'		=> $this->input->post('report_month',true),
							'report_type'		=> $this->input->post('report_type',true),
							'report_desc'	=> $this->input->post('report_desc'),
							'report_due_date'	=>  date('Y-m-d',strtotime($this->input->post('report_due_date'))),
							'try_official_name'	=> $this->input->post('try_official_name'),
							'try_official_desig'	=> $this->input->post('try_official_desig'),
							'try_official_contact'	=> $this->input->post('try_official_contact'),
							'report_status'	=> 'Submitted',
							'update_dt'	=> date('Y-m-d H:i:s')
						);
				//------------------- upload file				
						if(isset($_FILES['try_attachment']) && $_FILES['try_attachment']['size'] > 0){
						//upload file
						$upload_details = $this->common_model->upload_department_files('try_attachment'); //SINGLE FILE UPLOAD
						//print_r ($upload_details);										
						if(!$upload_details['is_success']){
							$this->session->set_flashdata('error',$upload_details['message']);
							$error = $upload_details['message'];
						}else{
//							$this->input->post('try_attachment',$upload_details['filename']);
							$update['try_attachment'] = $upload_details['filename'];
						}
						}

				if($error == ''){
					if(!empty($id)){ // edit
						$result = $this->wing_model->update_treasury_report($id,$update);
						$this->session->set_flashdata('success','Successfully updated.');
					}else{ // add
						$update['upload_dt'] = date('Y-m-d H:i:s');
						$id = $this->wing_model->add_treasury_report($update);
						$this->session->set_flashdata('success','Successfully added.');
					}
					redirect(SITE_BASE_URL.'treasury/treasury_reports_all');
				}
			}
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/treasury/treasury_report',$data);
		$this->load->view('layout/footer');
	}
	
	public function misclassification(){
		if(!$this->session->userdata('treasury_data')){
			redirect('treasury/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['treasury_data'] = $this->session->userdata('treasury_data');
		$data['header']['users'] = $data['treasury_data']['users'];
		$data['header']['user_name'] = $data['treasury_data']['user_name'];
		
		$data['fin_yr_list'] = $this->accounts_model->get_all_misclassification_fin_yr_list();
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;		
		$response = $this->accounts_model->get_tresury_misclassification_records($page_no, $data['treasury_data']['users']);	
		$data['results'] = $response['results'];

		$config['base_url'] = base_url().'treasury/misclassification';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;	
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		
		$this->load->view('layout/header');
		$this->load->view('pages/treasury/misclassification',$data);
		$this->load->view('layout/footer');
	}
	
	public function all_correction_slips(){
		if(!$this->session->userdata('treasury_data')){
			redirect('treasury/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['treasury_data'] = $this->session->userdata('treasury_data');
		$data['header']['users'] = $data['treasury_data']['users'];
		$data['header']['user_name'] = $data['treasury_data']['user_name'];
		
		$data['fin_yr_list'] = $this->accounts_model->get_all_misclassification_fin_yr_list();
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;		
		$response = $this->accounts_model->get_tresury_all_correctionslip_records($page_no, $data['treasury_data']['users']);	
		$data['results'] = $response['results'];

		$config['base_url'] = base_url().'treasury/all_correction_slips';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;	
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		
		$this->load->view('layout/header');
		$this->load->view('pages/treasury/all_correction_slips',$data);
		$this->load->view('layout/footer');
	}
	public function correction_slip_issue(){
		if(!$this->session->userdata('treasury_data')){
			redirect('treasury/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);

		$data['error'] = '';
		$data['treasury_data'] = $this->session->userdata('treasury_data');
		$data['header']['users'] = $data['treasury_data']['users'];
		$data['header']['user_name'] = $data['treasury_data']['user_name'];
		$data['profile'] = $data['treasury_data'];
		$users= $data['treasury_data']['users'];
		
		$data['row'] = array();

		if($this->input->post()){
						//------------------- upload file				
						if(isset($_FILES['try_attachment']) && $_FILES['try_attachment']['size'] > 0){
						//upload file
						$upload_details = $this->common_model->upload_department_files('try_attachment'); //SINGLE FILE UPLOAD
						//print_r ($upload_details);										
						if(!$upload_details['is_success']){
							$this->session->set_flashdata('error',$upload_details['message']);
							$error = $upload_details['message'];
						}else{
//							$this->input->post('try_attachment',$upload_details['filename']);
							$_POST['try_attachment'] = $upload_details['filename'];
//							$update['try_attachment'] = $upload_details['filename'];
						}
						}
			$this->accounts_model->add_try_correction_slip($users );
			$this->session->set_flashdata('success','Successfully submitted.');
			redirect(SITE_BASE_URL.'treasury/all_correction_slips');
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/treasury/correction_slip_issue',$data);
		$this->load->view('layout/footer');
	}
	
	public function correction_slip_view(){
		if(!$this->session->userdata('treasury_data')){
			redirect('treasury/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);

		$data['error'] = '';
		$data['treasury_data'] = $this->session->userdata('treasury_data');
		$data['header']['users'] = $data['treasury_data']['users'];
		$data['header']['user_name'] = $data['treasury_data']['user_name'];
		$data['profile'] = $data['treasury_data'];
		$users= $data['treasury_data']['users'];
		$id = $this->uri->segment(3);

		$data['row'] = array();
		$data['records']=array();

		if(!empty($id)){		
			$data['records'] = $this->accounts_model->fetch_try_correction_slip_records_by_id($id);		
			if(empty($data['records'])){
				show_404('admin');
			}
		}
		else{
			show_404('admin');
		}

		if($this->input->post()){			
			$this->accounts_model->update_try_obsuspense_records($id,$users );
			$this->session->set_flashdata('success','Successfully submitted.');
			redirect(SITE_BASE_URL.'treasury/dashboard');
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/treasury/correction_slip_view',$data);
		$this->load->view('layout/footer');
	}	
	public function correction_slip_misclassification(){
		if(!$this->session->userdata('treasury_data')){
			redirect('treasury/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);

		$data['error'] = '';
		$data['treasury_data'] = $this->session->userdata('treasury_data');
		$data['header']['users'] = $data['treasury_data']['users'];
		$data['header']['user_name'] = $data['treasury_data']['user_name'];
		$data['profile'] = $data['treasury_data'];
		$users= $data['treasury_data']['users'];
		$id = $this->uri->segment(3);
		$action_status=$this->input->post('action_status');
		$data['row'] = array();
		$data['records']=array();
		
		if(!empty($id)){		
			$data['records'] = $this->accounts_model->fetch_try_misclassification_records_by_id($id);		
			if(empty($data['records'])){
				show_404('admin');
			}
		}
		else{
			show_404('admin');
		}

		if($this->input->post()){					
			$this->accounts_model->update_try_misclassification_records($id,$users );
			$this->session->set_flashdata('success','Successfully submitted.');
			redirect(SITE_BASE_URL.'treasury/misclassification');
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/treasury/correction_slip_misclassification',$data);
		$this->load->view('layout/footer');
	}

	public function correction_slip_misclassification_view(){
		if(!$this->session->userdata('treasury_data')){
			redirect('treasury/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);

		$data['error'] = '';
		$data['treasury_data'] = $this->session->userdata('treasury_data');
		$data['header']['users'] = $data['treasury_data']['users'];
		$data['header']['user_name'] = $data['treasury_data']['user_name'];
		$data['profile'] = $data['treasury_data'];
		$users= $data['treasury_data']['users'];
		$id = $this->uri->segment(3);
		$action_status=$this->input->post('action_status');
		$data['row'] = array();
		$data['records']=array();
		
		if(!empty($id)){		
			$data['records'] = $this->accounts_model->fetch_try_misclassification_records_by_id($id);		
			if(empty($data['records'])){
				show_404('admin');
			}
		}
		else{
			show_404('admin');
		}

		if($this->input->post()){					
			$this->accounts_model->update_try_obsuspense_records($id,$users );
			$this->session->set_flashdata('success','Successfully submitted.');
			redirect(SITE_BASE_URL.'treasury/misclassification');
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/treasury/correction_slip_misclassification_view',$data);
		$this->load->view('layout/footer');
	}
	public function outstanding_paras(){
		if(!$this->session->userdata('treasury_data')){
			redirect('treasury/login');
		}
		$this->load->library('pagination');

		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['treasury_data'] = $this->session->userdata('treasury_data');
		$data['header']['users'] = $data['treasury_data']['users'];
		$data['header']['user_name'] = $data['treasury_data']['user_name'];
		
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;		
		$response = $this->accounts_model->get_tresury_outsttanding_paras($page_no, $data['treasury_data']['users']);	
		$data['results'] = $response['results'];

		$config['base_url'] = base_url().'treasury/outstanding_paras';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;	
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		
		$this->load->view('layout/header');
		$this->load->view('pages/treasury/outstanding_paras',$data);
		$this->load->view('layout/footer');
	}
	
	
}// End of Class
