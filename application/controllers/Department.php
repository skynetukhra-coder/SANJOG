<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->lang->load('main','english');
		$this->load->model('accounts_model');
		$this->load->model('page_model');
		if($this->session->userdata('language_id')){
			$this->language_id = $this->session->userdata('language_id');
		}else{
			$this->language_id = 1;
		}
		
	}
	public function login(){
		if($this->session->userdata('department_data')){
			redirect('department/dashboard');
		}
		$this->load->helper('security');
		
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		if($this->input->post()){
			$this->form_validation->set_rules('users', 'Department User Id', 'required|xss_clean');
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
					$login_details = $this->accounts_model->department_login($code,$pass);
					if(empty($login_details)){
						$data['error'] = $this->lang->line('wrong_credentials');
					}else{
						$this->session->set_userdata('department_data',$login_details);
						$is_uopdate = $this->accounts_model->update_department_last_login($code);
						$this->session->set_flashdata('success',$this->lang->line('successfully_logged_in'));
						redirect('department/dashboard');
					}
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/department/login',$data);
		$this->load->view('layout/footer');
	}
	
	public function registration(){
		if($this->session->userdata('department_data')){
			redirect('department/dashboard');
		}
		$this->load->helper('security');
		
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		if($this->input->post()){
			$this->form_validation->set_rules('users', 'Department Code', 'required|xss_clean');
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
					$reg_status = $this->accounts_model->department_registration();
					if($reg_status['success'] === false){
						$data['error'] = $reg_status['msg'];
					}else{
						$dept_details = $reg_status['details'];
						$this->session->set_userdata('dept_reg',$dept_details['users']);
						$email = '';
						$mobile = '';
						if(!empty($dept_details['emailid'])){
							$email = $dept_details['emailid'];
						}
						if(!empty($dept_details['mb_no'])){
							$mobile = $dept_details['mb_no'];
						}
						send_OTP($email,$mobile); // from helper
						$this->session->set_flashdata('success',$this->lang->line('OTP_sent_to_mobile_email'));
						redirect('department/otp');
					}
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/department/registration',$data);
		$this->load->view('layout/footer');
	}
	public function forgot_password(){
		if($this->session->userdata('department_data')){
			redirect('department/dashboard');
		}
		$this->load->helper('security');
		
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		if($this->input->post()){
			$this->form_validation->set_rules('users', 'Department User Id', 'required|xss_clean');
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
					$reg_status = $this->accounts_model->department_forgot_password();
					if($reg_status['success'] === false){
						$data['error'] = $reg_status['msg'];
					}else{
						$dept_details = $reg_status['details'];
						$this->session->set_userdata('dept_reg',$dept_details['users']);
						$email = '';
						$mobile = '';
						if(!empty($dept_details['emailid'])){
							$email = $dept_details['emailid'];
						}
						if(!empty($dept_details['mb_no'])){
							$mobile = $dept_details['mb_no'];
						}
						send_OTP($email,$mobile); // from helper
						$this->session->set_flashdata('success',$this->lang->line('OTP_sent_to_mobile_email'));
						redirect('department/otp');
					}
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/department/forgot_password',$data);
		$this->load->view('layout/footer');
	}
	public function otp(){
		if($this->session->userdata('department_data')){
			redirect('department/dashboard');
		}
		if(!$this->session->userdata('dept_reg')){
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
						$this->session->set_userdata('nxt_pg','dept_re_pass');
						$this->session->set_flashdata('success',$this->lang->line('OTP_matched_reset_pass'));
						redirect('department/reset_password');
					}
				//}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/department/otp',$data);
		$this->load->view('layout/footer');
	
	}
	public function reset_password(){
		if($this->session->userdata('department_data')){
			redirect('department/dashboard');
		}
		if(!$this->session->userdata('dept_reg')){
			show_404();
		}
		if($this->session->userdata('nxt_pg') && $this->session->userdata('nxt_pg') == 'dept_re_pass'){
			
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
					$users = $this->session->userdata('dept_reg');
					$pass = $this->input->post('pass',true);
					$this->accounts_model->department_reset_password($users,$pass);
					$this->session->set_flashdata('success',$this->lang->line('password_updated_login_now'));
					$this->session->unset_userdata('nxt_pg');
					redirect('department/login');
			//	}
			}
		}
		//$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/department/reset_password',$data);
		$this->load->view('layout/footer');
	}
	
	public function dashboard(){
		if(!$this->session->userdata('department_data')){
			redirect('department/login');
		}
		$data['department_data'] = $this->session->userdata('department_data');
		$data['header']['users'] = $data['department_data']['users'];
		$data['header']['user_name'] = $data['department_data']['user_name'];
		$data['header']['grnt_cd'] = $data['department_data']['grnt_cd'];
		$page_url = 'reconciliation-status';
		$data['details'] = $this->page_model->getPageByURL($this->language_id,$page_url);
		$this->load->view('layout/header');
		$this->load->view('pages/department/dashboard',$data);
		$this->load->view('layout/footer');
	}
	
	//---report function to to the page
	public function report(){
		if(!$this->session->userdata('department_data')){
			redirect('department/login');
		}
		$data['department_data'] = $this->session->userdata('department_data');
		$data['header']['users'] = $data['department_data']['users'];
		$data['header']['user_name'] = $data['department_data']['user_name'];
		$data['header']['grnt_cd'] = $data['department_data']['grnt_cd'];
		$page_url = 'accounts-departmental-files';
		$data['details'] = $this->page_model->getPageByURL($this->language_id,$page_url);
		$this->load->view('layout/header');
		$this->load->view('pages/department/report',$data);
		$this->load->view('layout/footer');
	}
		
	public function profile(){
		if(!$this->session->userdata('department_data')){
			redirect('department/login');
		}
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->helper('security');
		$data['department_data'] = $this->session->userdata('department_data');
		$data['header']['users'] = $data['department_data']['users'];
		$data['header']['user_name'] = $data['department_data']['user_name'];
		$data['header']['grnt_cd'] = $data['department_data']['grnt_cd'];
		$data['profile'] = $this->accounts_model->get_department_profile($data['department_data']['grnt_cd']);
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
					$is_uopdate = $this->accounts_model->update_department_profile($data['department_data']['grnt_cd']);
					if($is_uopdate){
						$this->session->set_flashdata('success',$this->lang->line('successfully_updated'));
						redirect('department/dashboard');
					}
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/department/profile',$data);
		$this->load->view('layout/footer');
	}
	public function logout(){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$arr_feed['deptid'] 	= $this->session->userdata('department_data')['users'];
		$arr_feed['name'] 	= $this->session->userdata('department_data')['user_name'];
		$arr_feed['mobile'] = $this->session->userdata('department_data')['mb_no'];
		$arr_feed['email']  = $this->session->userdata('department_data')['emailid'];
		$this->session->set_userdata('user_details_for_feedback',$arr_feed);
		if(!$this->session->userdata('department_data')){
			redirect('department/login');
		}else{
			$this->session->unset_userdata('department_data');
			$this->session->set_flashdata('success',$this->lang->line('give_your_feedback'));
			redirect('feedback');
		}
		$this->session->set_flashdata('success',$this->lang->line('give_your_feedback'));
		redirect('feedback');
		$this->load->view('layout/header');
		$this->load->view('pages/department/login',$data);
		$this->load->view('layout/footer');
	}
	
	public function orders(){
		if(!$this->session->userdata('department_data')){
			redirect('department/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['department_data'] = $this->session->userdata('department_data');
		$data['header']['users'] = $data['department_data']['users'];
		$data['header']['user_name'] = $data['department_data']['user_name'];
		$data['header']['grnt_cd'] = $data['department_data']['grnt_cd'];
		
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->accounts_model->get_department_office_orders($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'department/orders';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;
		
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		$this->load->view('layout/header');
		$this->load->view('pages/department/orders',$data);
		$this->load->view('layout/footer');
	}	
	public function civil_accounts(){
		if(!$this->session->userdata('department_data')){
			redirect('department/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['department_data'] = $this->session->userdata('department_data');
		$data['header']['users'] = $data['department_data']['users'];
		$data['header']['user_name'] = $data['department_data']['user_name'];
		$data['header']['grnt_cd'] = $data['department_data']['grnt_cd'];
		
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->accounts_model->get_department_civil_accounts($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'department/orders';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;
		
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		$this->load->view('layout/header');
		$this->load->view('pages/department/civil_accounts',$data);
		$this->load->view('layout/footer');
	}	
	public function expenditure_report(){
		if(!$this->session->userdata('department_data')){
			redirect('department/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['department_data'] = $this->session->userdata('department_data');
		$data['header']['users'] = $data['department_data']['users'];
		$data['header']['user_name'] = $data['department_data']['user_name'];
		$data['header']['grnt_cd'] = $data['department_data']['grnt_cd'];
		
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->accounts_model->get_department_expenditure_report($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'department/orders';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;
		
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		$this->load->view('layout/header');
		$this->load->view('pages/department/expenditure_report',$data);
		$this->load->view('layout/footer');
	}	
	public function appreciation_note(){
		if(!$this->session->userdata('department_data')){
			redirect('department/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['department_data'] = $this->session->userdata('department_data');
		$data['header']['users'] = $data['department_data']['users'];
		$data['header']['user_name'] = $data['department_data']['user_name'];
		$data['header']['grnt_cd'] = $data['department_data']['grnt_cd'];
		
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->accounts_model->get_department_appreciation_note($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'department/orders';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;
		
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		$this->load->view('layout/header');
		$this->load->view('pages/department/appreciation_note',$data);
		$this->load->view('layout/footer');
	}	
	public function documents(){
		if(!$this->session->userdata('department_data')){
			redirect('department/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['department_data'] = $this->session->userdata('department_data');
		$data['header']['users'] = $data['department_data']['users'];
		$data['header']['user_name'] = $data['department_data']['user_name'];
		$data['header']['grnt_cd'] = $data['department_data']['grnt_cd'];
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;		
		$response = $this->accounts_model->get_department_office_documents($page_no, $data['department_data']['users']);	
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'department/documents';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;	
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		
		$this->load->view('layout/header');
		$this->load->view('pages/department/documents',$data);
		$this->load->view('layout/footer');
	}
	
//echo $this->db->last_query();
//print_r ($response);
//exit;	
	
	public function reconciliation(){
		if(!$this->session->userdata('department_data')){
			redirect('department/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['department_data'] = $this->session->userdata('department_data');
		$data['header']['users'] = $data['department_data']['users'];
		$data['header']['user_name'] = $data['department_data']['user_name'];
		$data['header']['grnt_cd'] = $data['department_data']['grnt_cd'];
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;		
		$response = $this->accounts_model->get_department_reconciliaion_documents($page_no, $data['department_data']['users']);	
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'department/reconciliation';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;	
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		
		$this->load->view('layout/header');
		$this->load->view('pages/department/reconciliation',$data);
		$this->load->view('layout/footer');
	}
	
	public function department_reconciliation(){
		if(!$this->session->userdata('department_data')){
			redirect('department/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		$data['department_data'] = $this->session->userdata('department_data');
		$data['header']['users'] = $data['department_data']['users'];
		$data['header']['user_name'] = $data['department_data']['user_name'];
		$data['header']['grnt_cd'] = $data['department_data']['grnt_cd'];
		$data['profile'] = $data['department_data'];
		$users= $data['department_data']['users'];
		$grnt_cd = $data['department_data']['grnt_cd'];
		$id = $this->uri->segment(3);
		$action_status=$this->input->post('action_status');
		$data['row'] = array();
		$data['records']=array();		
		if(!empty($id)){		
			$data['records'] = $this->accounts_model->fetch_dept_records_by_id($id);		
			if(empty($data['records'])){
				show_404('admin');
			}
		}
		else{
			show_404('admin');
		}

//echo $this->db->last_query();

		if($this->input->post()){
//------------------- upload file				
						if(isset($_FILES['dept_attachment']) && $_FILES['dept_attachment']['size'] > 0){
						//upload file
						$upload_details = $this->common_model->upload_department_files('dept_attachment'); //SINGLE FILE UPLOAD
						//print_r ($upload_details);										
						if(!$upload_details['is_success']){
							$this->session->set_flashdata('error',$upload_details['message']);
							$error = $upload_details['message'];
						}else{
//							$this->input->post('dept_attachment',$upload_details['filename']);
							$_POST['dept_attachment'] = $upload_details['filename'];
						}
						}					
			$this->accounts_model->update_dept_reconciliation_records($id,$users,$grnt_cd );
			$this->session->set_flashdata('success','Successfully submitted.');
			redirect(SITE_BASE_URL.'department/reconciliation');
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/department/department_reconciliation',$data);
		$this->load->view('layout/footer');
	}
	
	public function warning_slip(){
		if(!$this->session->userdata('department_data')){
			redirect('department/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['department_data'] = $this->session->userdata('department_data');
		$data['header']['users'] = $data['department_data']['users'];
		$data['header']['user_name'] = $data['department_data']['user_name'];
		$data['header']['grnt_cd'] = $data['department_data']['grnt_cd'];
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;		
		$response = $this->accounts_model->get_department_warnings_documents($page_no, $data['department_data']['users']);	
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'department/warning_slip';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;	
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		
		$this->load->view('layout/header');
		$this->load->view('pages/department/warning_slip',$data);
		$this->load->view('layout/footer');
	}
	public function department_warning_slip(){
		if(!$this->session->userdata('department_data')){
			redirect('department/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		$data['department_data'] = $this->session->userdata('department_data');
		$data['header']['users'] = $data['department_data']['users'];
		$data['header']['user_name'] = $data['department_data']['user_name'];
		$data['header']['grnt_cd'] = $data['department_data']['grnt_cd'];
		$data['profile'] = $data['department_data'];
		$users= $data['department_data']['users'];
		$grnt_cd = $data['department_data']['grnt_cd'];
		$id = $this->uri->segment(3);
		$action_status=$this->input->post('action_status');
		$data['row'] = array();
		$data['records']=array();		
		if(!empty($id)){		
			$data['records'] = $this->accounts_model->fetch_dept_records_by_id($id);		
			if(empty($data['records'])){
				show_404('admin');
			}
		}
		else{
			show_404('admin');
		}

//echo $this->db->last_query();

		if($this->input->post()){
//------------------- upload file				
						if(isset($_FILES['dept_attachment']) && $_FILES['dept_attachment']['size'] > 0){
						//upload file
						$upload_details = $this->common_model->upload_department_files('dept_attachment'); //SINGLE FILE UPLOAD
						//print_r ($upload_details);										
						if(!$upload_details['is_success']){
							$this->session->set_flashdata('error',$upload_details['message']);
							$error = $upload_details['message'];
						}else{
//							$this->input->post('dept_attachment',$upload_details['filename']);
							$_POST['dept_attachment'] = $upload_details['filename'];
						}
						}					
			$this->accounts_model->update_dept_reconciliation_records($id,$users,$grnt_cd );
			$this->session->set_flashdata('success','Successfully submitted.');
			redirect(SITE_BASE_URL.'department/warning_slip');
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/department/department_warning_slip',$data);
		$this->load->view('layout/footer');
	}
	public function ac_dc_bills(){
		if(!$this->session->userdata('department_data')){
			redirect('department/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['department_data'] = $this->session->userdata('department_data');
		$data['header']['users'] = $data['department_data']['users'];
		$data['header']['user_name'] = $data['department_data']['user_name'];
		$data['header']['grnt_cd'] = $data['department_data']['grnt_cd'];
		$data['fin_yr_list'] = $this->accounts_model->get_all_acdc_fin_yr_list();
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;		
		$response = $this->accounts_model->get_department_acdc_bills_documents($page_no, $data['department_data']['grnt_cd']);	
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'department/ac_dc_bills';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;	
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		
		$this->load->view('layout/header');
		$this->load->view('pages/department/ac_dc_bills',$data);
		$this->load->view('layout/footer');
	}
	public function investment(){
		if(!$this->session->userdata('department_data')){
			redirect('department/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['department_data'] = $this->session->userdata('department_data');
		$data['header']['users'] = $data['department_data']['users'];
		$data['header']['user_name'] = $data['department_data']['user_name'];
		$data['header']['grnt_cd'] = $data['department_data']['grnt_cd'];
		$grnt_cd = $data['department_data']['grnt_cd'];
		$data['fin_yr_list'] = $this->accounts_model->get_all_invst_fin_yr_list();
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;		
		$response = $this->accounts_model->get_department_investment($page_no,$grnt_cd);	
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'department/investment';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;	
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		
		$this->load->view('layout/header');
		$this->load->view('pages/department/investment',$data);
		$this->load->view('layout/footer');
	}
	
	public function department_invesment_update(){
		if(!$this->session->userdata('department_data')){
			redirect('department/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		$data['department_data'] = $this->session->userdata('department_data');
		$data['header']['users'] = $data['department_data']['users'];
		$data['header']['user_name'] = $data['department_data']['user_name'];
		$data['header']['grnt_cd'] = $data['department_data']['grnt_cd'];
		$data['profile'] = $data['department_data'];
		$users= $data['department_data']['users'];
		$id = $this->uri->segment(3);
		$action_status=$this->input->post('action_status');
		$data['row'] = array();
		$data['records']=array();		
		if(!empty($id)){		
			$data['records'] = $this->accounts_model->fetch_dept_investment_by_id($id);		
			if(empty($data['records'])){
				show_404('admin');
			}
		}
		else{
			show_404('admin');
		}

//echo $this->db->last_query();

		if($this->input->post()){		
			$this->accounts_model->update_dept_investment_records($id,$users);
			$this->session->set_flashdata('success','Successfully submitted.');
			redirect(SITE_BASE_URL.'department/investment');
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/department/department_invesment_update',$data);
		$this->load->view('layout/footer');
	}
	public function gia_uc(){
		if(!$this->session->userdata('department_data')){
			redirect('department/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['department_data'] = $this->session->userdata('department_data');
		$data['header']['users'] = $data['department_data']['users'];
		$data['header']['user_name'] = $data['department_data']['user_name'];
		$data['header']['grnt_cd'] = $data['department_data']['grnt_cd'];
		$grnt_cd = $data['department_data']['grnt_cd'];
		$data['fin_yr_list'] = $this->accounts_model->get_all_gia_fin_yr_list();
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;		
		$response = $this->accounts_model->get_department_gia_uc($page_no,$grnt_cd);	
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'department/gia_uc';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;	
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		
		$this->load->view('layout/header');
		$this->load->view('pages/department/gia_uc',$data);
		$this->load->view('layout/footer');
	}
	
	public function department_gia_update(){
		if(!$this->session->userdata('department_data')){
			redirect('department/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);

		$data['error'] = '';
		$data['department_data'] = $this->session->userdata('department_data');
		$data['header']['users'] = $data['department_data']['users'];
		$data['header']['user_name'] = $data['department_data']['user_name'];
		$data['header']['grnt_cd'] = $data['department_data']['grnt_cd'];
		$data['profile'] = $data['department_data'];
		$users= $data['department_data']['users'];
		$id = $this->uri->segment(3);
		$action_status=$this->input->post('action_status');
		$data['row'] = array();
		$data['records']=array();		
		if(!empty($id)){		
			$data['records'] = $this->accounts_model->fetch_dept_gia_by_id($id);		
			if(empty($data['records'])){
				show_404('admin');
			}
		}
		else{
			show_404('admin');
		}

//echo $this->db->last_query();

		if($this->input->post()){				
			$this->accounts_model->update_dept_gia_records($id,$users);
			$this->session->set_flashdata('success','Successfully submitted.');
			redirect(SITE_BASE_URL.'department/gia_uc');
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/department/department_gia_update',$data);
		$this->load->view('layout/footer');
	}
	
	public function loan_advance(){
		if(!$this->session->userdata('department_data')){
			redirect('department/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['department_data'] = $this->session->userdata('department_data');
		$data['header']['users'] = $data['department_data']['users'];
		$data['header']['user_name'] = $data['department_data']['user_name'];
		$data['header']['grnt_cd'] = $data['department_data']['grnt_cd'];		
		$grnt_cd = $data['department_data']['grnt_cd'];
		
		$data['fin_yr_list'] = $this->accounts_model->get_all_invst_fin_yr_list();
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;		
		$response = $this->accounts_model->get_department_loan_advance($page_no,$grnt_cd);
		$data['results'] = $response['results'];		

		$config['base_url'] = base_url().'department/loan_advance';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;	
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		
		$this->load->view('layout/header');
		$this->load->view('pages/department/loan_advance',$data);
		$this->load->view('layout/footer');
	}
	
	public function loan_advance_upload(){
		if(!$this->session->userdata('department_data')){
			redirect('department/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		$data['department_data'] = $this->session->userdata('department_data');
		$data['header']['users'] = $data['department_data']['users'];
		$data['header']['user_name'] = $data['department_data']['user_name'];
		$data['header']['grnt_cd'] = $data['department_data']['grnt_cd'];
		$data['profile'] = $data['department_data'];
		$users= $data['department_data']['grnt_cd'];
		$id = $this->uri->segment(3);
		$action_status=$this->input->post('action_status');
		$data['row'] = array();
		$data['records']=array();		

		if(!empty($id)){		
			$data['records'] = $this->accounts_model->fetch_dept_loan_advance_by_id($id);		
			if(empty($data['records'])){
				show_404('admin');
			}
		}
		else{
			show_404('admin');
		}

		if($this->input->post()){
//------------------- upload file				
						if(isset($_FILES['dept_attachment']) && $_FILES['dept_attachment']['size'] > 0){
						//upload file
						$upload_details = $this->common_model->upload_department_files('dept_attachment'); //SINGLE FILE UPLOAD
						//print_r ($upload_details);										
						if(!$upload_details['is_success']){
							$this->session->set_flashdata('error',$upload_details['message']);
							$error = $upload_details['message'];
						}else{
//							$this->input->post('dept_attachment',$upload_details['filename']);
							$_POST['dept_attachment'] = $upload_details['filename'];
						}
						}					
			$this->accounts_model->update_dept_loan_adv_records($id,$users );
			$this->session->set_flashdata('success','Successfully submitted.');
			redirect(SITE_BASE_URL.'department/loan_advance');
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/department/loan_advance_upload',$data);
		$this->load->view('layout/footer');
	}

	
	
}// End of Class
