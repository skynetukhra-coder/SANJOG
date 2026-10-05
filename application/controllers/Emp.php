<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emp extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->lang->load('main','english');
		$this->load->model('emp_model');
		$this->load->model('page_model');
		
//		$data['details'] = $this->page_model->getPageByURL($this->language_id,$page_url);
		if($this->session->userdata('language_id')){
			$this->language_id = $this->session->userdata('language_id');
		}else{
			$this->language_id = 1;
		}
	}
	public function login_page(){
		if($this->session->userdata('subscribers_data')){
			//redirect('emp/dashboard');
		}
		$this->load->view('layout/header');
		$this->load->view('pages/emp/login_page');
		$this->load->view('layout/footer');
	}
	public function login_down(){
		if($this->session->userdata('subscribers_data')){
			//redirect('emp/dashboard');
		}
		$this->load->view('layout/header');
		$this->load->view('pages/emp/login_down');
		$this->load->view('layout/footer');
	}
	public function login(){
		if($this->session->userdata('emp_data')){
			redirect('emp/information');
		}
		$this->load->helper('security');
//		redirect('emp/login_down');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		if($this->input->post()){
			$this->form_validation->set_rules('emp_id', 'Employee Id', 'required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
			$this->form_validation->set_rules('c_image', 'Image Code', 'required|xss_clean',array('required'=> 'Please write image code'));
			if ($this->form_validation->run() == FALSE){
               $data['error'] = validation_errors();
            }else{
				$cap_code = $this->session->userdata('cap_data');
				if($cap_code != $this->input->post('c_image')){
					$data['error'] = $this->lang->line('image_code_not_matched');
				}else{
					$emp_id = $this->input->post('emp_id',true);
					$pass = $this->input->post('password',true);
					$login_details = $this->emp_model->employee_agae_login($emp_id,$pass);
					if(empty($login_details)){
						$data['error'] = $this->lang->line('wrong_credentials');
					}else{
						$this->session->set_userdata('emp_data',$login_details);
						$is_uopdate = $this->emp_model->update_employee_last_login($emp_id);
					
						$check_sms = $this->emp_model->check_BirthDaySMS();
						$hour = date('H');
						if((empty($check_sms)) && $hour>=10){
							redirect('emp/BirthDaySMS');
							$this->session->set_flashdata('success','Successfully logged in.  **Please update your information in "My Information."');
							redirect('emp/notice_board');
						}else{
							$this->session->set_flashdata('success','Successfully logged in.  **Please update your information in "My Information."');
							redirect('emp/notice_board');
						}
/*
						$data['notices'] = $this->emp_model->get_employee_notice_board();
						if(empty($data['notices'])){
							$this->session->set_flashdata('success','Successfully logged in.  **Please update your information.');
							redirect('emp/information');
						}else{
							$this->session->set_flashdata('success','Successfully logged in.  **Please update your information in "My Information."');
							redirect('emp/notice_board');
						}
*/
					}
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/login',$data);
		$this->load->view('layout/footer');
	}
	
	public function registration(){
		if($this->session->userdata('emp_data')){
			redirect('emp/information');
		}
		$this->load->helper('security');
		
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		if($this->input->post()){
			$this->form_validation->set_rules('emp_id', 'Employee Id', 'required|xss_clean');
			$this->form_validation->set_rules('dob', 'Date of Birth', 'required|xss_clean');
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
					$reg_status = $this->emp_model->employee_registration();
					if($reg_status['success'] === false){
						$data['error'] = $reg_status['msg'];
					}else{
						$emp_details = $reg_status['details'];
						$this->session->set_userdata('emp_reg',$emp_details['empid']);
						$email = '';
						$mobile = '';
						if(!empty($emp_details['nicmail'])){
							$email = $emp_details['nicmail'];
						}else if(!empty($emp_details['email'])){
							$email = $emp_details['email'];
						}
						if(!empty($emp_details['mbno'])){
							$mobile = $emp_details['mbno'];
						}
						send_OTP($email,$mobile); // from helper
						$this->session->set_flashdata('success',$this->lang->line('OTP_sent_to_mobile_email'));
						redirect('emp/otp');
					}
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/registration',$data);
		$this->load->view('layout/footer');
	}
	public function forgot_password(){
		if($this->session->userdata('emp_data')){
			redirect('emp/information');
		}
		$this->load->helper('security');
		
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		if($this->input->post()){
			$this->form_validation->set_rules('emp_id', 'Employee Id', 'required|xss_clean');
			$this->form_validation->set_rules('dob', 'Date of Birth', 'required|xss_clean');
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
					$reg_status = $this->emp_model->employee_forgot_password();
					if($reg_status['success'] === false){
						$data['error'] = $reg_status['msg'];
					}else{
						$emp_details = $reg_status['details'];
						$this->session->set_userdata('emp_reg',$emp_details['empid']);
						$email = '';
						$mobile = '';
						if(!empty($emp_details['nicmail'])){
							$email = $emp_details['nicmail'];
						}else if(!empty($emp_details['email'])){
							$email = $emp_details['email'];
						}
						if(!empty($emp_details['mbno'])){
							$mobile = $emp_details['mbno'];
						}
						send_OTP($email,$mobile); // from helper
						$this->session->set_flashdata('success',$this->lang->line('OTP_sent_to_mobile_email'));
						redirect('emp/otp');
					}
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/forgot_password',$data);
		$this->load->view('layout/footer');
	}
	public function otp(){
		if($this->session->userdata('emp_data')){
			redirect('emp/information');
		}
		if(!$this->session->userdata('emp_reg')){
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
						$this->session->set_userdata('nxt_pg','emp_re_pass');
						$this->session->set_flashdata('success',$this->lang->line('OTP_matched_reset_pass'));
						redirect('emp/reset_password');
					}
				//}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/otp',$data);
		$this->load->view('layout/footer');
	}
	public function reset_password(){
		if($this->session->userdata('emp_data')){
			redirect('emp/information');
		}
		if(!$this->session->userdata('emp_reg')){
			show_404();
		}
		if($this->session->userdata('nxt_pg') && $this->session->userdata('nxt_pg') == 'emp_re_pass'){
			
		}else{
			show_404();
		}
		$this->load->helper('security');
		
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		$errors = '';
		if($this->input->post()){
			$this->form_validation->set_rules('pass', 'Password', 'required|xss_clean');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[pass]|xss_clean');
			//$this->form_validation->set_rules('c_image', 'Image Code', 'required|xss_clean',array('required'=> 'Please write image code'));
			if ($this->form_validation->run() == FALSE){
               $data['error'] = validation_errors();
            }else{
					$emp_id = $this->session->userdata('emp_reg');
					$pass = $this->input->post('pass',true);
					$this->emp_model->reset_password($emp_id,$pass);
					$this->session->set_flashdata('success',$this->lang->line('password_updated_login_now'));
					$this->session->unset_userdata('nxt_pg');
					redirect('emp/login');
/*					
					$errors = validate_PASS($pass); // from helper
					if(empty($errors)){
						$this->emp_model->reset_password($emp_id,$pass);
						$this->session->set_flashdata('success',$this->lang->line('password_updated_login_now'));
						$this->session->unset_userdata('nxt_pg');
						redirect('emp/login');
					}else{
						$this->session->set_flashdata('error',$errors);
					}
*/					
			}
		}
//		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/reset_password',$data);
		$this->load->view('layout/footer');
	}
	
	public function dashboard(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$page_url = 'exam-application';
		$data['details'] = $this->page_model->getPageByURL($this->language_id,$page_url);
		$this->load->view('layout/header');
		$this->load->view('pages/emp/dashboard',$data);
		$this->load->view('layout/footer');
	}

	public function information(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['header']['empid'] = $data['emp_data']['empid'];
		$data['profile'] = $this->emp_model->get_employee_details($data['emp_data']['empid']);
		$data['section_list'] = $this->emp_model->get_all_section_list();
	
		if($this->input->post()){
//-------------------- upload file				
						if(isset($_FILES['picture']) && $_FILES['picture']['size'] > 0 && $_FILES['picture']['size'] < 70000){
						//upload file		
						$upload_details = $this->common_model->upload_employee_image('picture'); //SINGLE FILE UPLOAD
						//print_r ($upload_details);										
						if(!$upload_details['is_success']){
							$this->session->set_flashdata('error',$upload_details['message']);
							$error = $upload_details['message'];
						}else{
//							$this->input->post('picture',$upload_details['filename']);
							$_POST['picture'] = $upload_details['filename'];
						}
						}	

					$is_uopdate = $this->emp_model->update_employee($data['emp_data']['empid']);
					$this->session->set_flashdata('success',$this->lang->line('successfully_updated'));
					redirect('emp/information');	
		}

		$this->load->view('layout/header');
		$this->load->view('pages/emp/information',$data);
		$this->load->view('layout/footer');
	}

	public function profile(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		
		$this->load->helper('security');
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['profile'] = $this->emp_model->get_employee_details($data['emp_data']['empid']);
		if($this->input->post()){
			//$this->form_validation->set_rules('email', 'Email Id', 'required|valid_email|xss_clean');
			//$this->form_validation->set_rules('phone', 'Phone', 'required|xss_clean');
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
					$is_uopdate = $this->emp_model->update_employee($data['emp_data']['empid']);
					$this->session->set_flashdata('success',$this->lang->line('successfully_updated'));
					redirect('emp/information');
				}
			}
		}
		$data['cap'] = get_captcha();

		$this->load->view('layout/header');
		$this->load->view('pages/emp/profile',$data);
		$this->load->view('layout/footer');
	}

	public function documents(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_employee_office_orders($page_no,$data['emp_data']['empid']);
		$data['results'] = $response['results'];

		$config['base_url'] = base_url().'emp/documents';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;
		
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		$this->load->view('layout/header');
		$this->load->view('pages/emp/documents',$data);
		$this->load->view('layout/footer');
	}
	
	public function application(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';

		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['exam_list'] = $this->emp_model->get_invite_exam_name_list();

		if(empty($data['exam_list'])){
			$page_url = 'exam-application';
			$data['details'] = $this->page_model->getPageByURL($this->language_id,$page_url);
			$this->load->view('layout/header');
			$this->load->view('pages/emp/dashboard',$data);
			$this->load->view('layout/footer');
		}else{

			$data['employees'] = $this->emp_model->get_aao_officer_list();
			$data['profile'] = $this->emp_model->get_employee_details($data['emp_data']['empid']);
			$empid = $data['emp_data']['empid'];
			
			$exm_nm_new = $this->input->post('exm_nm');
			$exm_month_new = $this->input->post('exm_month');
			$exm_year_new = $this->input->post('exm_year');
		
			$data['application'] = $this->emp_model->get_employee_application_submitted($data['emp_data']['empid'],$exm_nm_new,$exm_month_new,$exm_year_new);
/*
			$emp_id_old = $data['application']['emp_id'];
			$exm_nm_old = $data['application']['exm_nm'];
			$exm_month_old = $data['application']['exm_month'];
			$exm_year_old = $data['application']['exm_year'];
		
	//     Joining parameters and used in condition------		

			$apn =$exm_nm_old.$exm_month_old.$exm_year_old;
			$apn_new=$exm_nm_new.$exm_month_new.$exm_year_new;
		
*/
			if($this->input->post()){
				
				$data['exam_closing_dt'] = $this->emp_model->get_exam_apply_closing_dt($exm_nm_new);

				if(!empty($data['exam_closing_dt'])){				
					if(empty($data['application'])){
						$this->form_validation->set_rules('exm_nm', 'Exam Name', 'required|xss_clean',array('required'=> 'Selection of Examination Name is necessary.'));
						$this->form_validation->set_rules('exm_month', 'Exam Month', 'required|xss_clean',array('required'=> 'Selection of Examination Month is necessary.'));
						$this->form_validation->set_rules('exm_year', 'Exam Year', 'required|xss_clean',array('required'=> 'Selection of Examination Year is necessary.'));
						$this->form_validation->set_rules('c_image', 'Image Code', 'required|xss_clean',array('required'=> 'Please write image code'));
						$this->form_validation->set_rules('agree', '', 'required|xss_clean',array('required'=> 'You have to agree the acceptance of the application'));
							if ($this->form_validation->run() == FALSE){
							   $data['error'] = validation_errors();
							}else{
								$cap_code = $this->session->userdata('cap_data');
								if($cap_code != $this->input->post('c_image')){
									$data['error'] = $this->lang->line('image_code_not_matched');
								}else{
									$reg_status = $this->emp_model->add_employee_application($data['emp_data']['empid']);
									$this->session->set_flashdata('success','Your application is submitted successfully.');
									redirect('emp/application_exam_info');
								}
							}
					}else{	
/*			
						if($exm_nm_old !== $exm_nm_new && $exm_month_old !== $exm_month_new && $exm_year_old !== $exm_year_new){
							$this->form_validation->set_rules('exm_nm', 'Exam Name', 'required|xss_clean',array('required'=> 'Selection of Examination Name is necessary.'));
							$this->form_validation->set_rules('exm_month', 'Exam Month', 'required|xss_clean',array('required'=> 'Selection of Examination Month is necessary.'));
							$this->form_validation->set_rules('exm_year', 'Exam Year', 'required|xss_clean',array('required'=> 'Selection of Examination Year is necessary.'));
							$this->form_validation->set_rules('c_image', 'Image Code', 'required|xss_clean',array('required'=> 'Please write image code'));
							$this->form_validation->set_rules('agree', '', 'required|xss_clean',array('required'=> 'You have to agree the acceptance of the application'));
							if ($this->form_validation->run() == FALSE){
							   $data['error'] = validation_errors();
							}else{
								$cap_code = $this->session->userdata('cap_data');
								if($cap_code != $this->input->post('c_image')){
									$data['error'] = $this->lang->line('image_code_not_matched');
								}else{
									$reg_status = $this->emp_model->employee_application($data['emp_data']['empid']);
									$this->session->set_flashdata('success','Your application is submitted successfully.');
									redirect('emp/application');
								}
							}
						}
						else{
						$this->session->set_flashdata('error','NOT SUBMITTED. ! Your have already submitted application for this examination.');
						}
*/				
						$this->session->set_flashdata('error','NOT SUBMITTED. ! Your have already submitted application for this examination.');
						redirect('emp/application_exam_info');
					}
				}else{
					$this->session->set_flashdata('success','LAST DATE OVER. ! You can not submit application now.');
				}
			}
			
			$data['cap'] = get_captcha();
			$this->load->view('layout/header');
			$this->load->view('pages/emp/application',$data);
			$this->load->view('layout/footer');
		}
	}
	public function application_exam_info(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		$empid = $data['emp_data']['empid'];
		
		$data['office_orders'] = $this->emp_model->get_application_exam_info($empid);

		$this->load->view('layout/header');
		$this->load->view('pages/emp/application_exam_info',$data);
		$this->load->view('layout/footer');
	}
	public function application_exam_other_info(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		$empid = $data['emp_data']['empid'];
		
		$data['office_orders'] = $this->emp_model->get_application_exam_other_info($empid);

		$this->load->view('layout/header');
		$this->load->view('pages/emp/application_exam_other_info',$data);
		$this->load->view('layout/footer');
	}
	public function application_pending_recommendation(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		$empid = $data['emp_data']['empid'];
		
		$data['office_orders'] = $this->emp_model->get_application_pending_recommendaton($empid);

		$this->load->view('layout/header');
		$this->load->view('pages/emp/application_pending_recommendation',$data);
		$this->load->view('layout/footer');
	}
/*
	public function application_pending_permission_all(){
		$this->load->library('pagination');
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		$empid = $data['emp_data']['empid'];
		$data['office_orders'] = $this->emp_model->get_application_pending_permission_all();

		$this->load->view('layout/header');
		$this->load->view('pages/emp/application_pending_permission_all',$data);
		$this->load->view('layout/footer');
	}
*/
	public function application_pending_permission_all(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_application_pending_permission_all($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'emp/application_pending_permission_all';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;
		
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		$this->load->view('layout/header');
		$this->load->view('pages/emp/application_pending_permission_all',$data);
		$this->load->view('layout/footer');
	}		

	public function leave_application_chk_all(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		$empid = $data['emp_data']['empid'];
		
		$data['office_orders'] = $this->emp_model->get_leave_on_mc_all();

		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_application_chk_all',$data);
		$this->load->view('layout/footer');
	}
	public function application_pending_recomd(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		$empid = $data['emp_data']['empid'];
		
		$data['office_orders'] = $this->emp_model->get_application_other_pending_recommendaton($empid);

		$this->load->view('layout/header');
		$this->load->view('pages/emp/application_pending_recomd',$data);
		$this->load->view('layout/footer');
	}
	public function application_pending_permission(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		$empid = $data['emp_data']['empid'];
		
		$data['office_orders'] = $this->emp_model->get_application_pending_permission($empid);

		$this->load->view('layout/header');
		$this->load->view('pages/emp/application_pending_permission',$data);
		$this->load->view('layout/footer');
	}
	public function employee_charge_details(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		
		$empid = $this->uri->segment(3);	
		$data['charge_list'] = $this->emp_model->get_employee_charge_details($empid);

		$this->load->view('layout/header');
		$this->load->view('pages/emp/employee_charge_details',$data);
		$this->load->view('layout/footer');
	}
	public function bill_details_all(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		$empid = $data['emp_data']['empid'];
		
		$data['records'] = $this->emp_model->get_bill_details_all($empid);

		$this->load->view('layout/header');
		$this->load->view('pages/emp/bill_details_all',$data);
		$this->load->view('layout/footer');
	}
	public function bill_pending_sanction(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		$empid = $data['emp_data']['empid'];
		
//		$data['records'] = $this->emp_model->get_bill_details_all($empid);
		if(empty($data['records'])){
				show_404('admin');
		}
		
		$this->load->view('layout/header');
		$this->load->view('pages/emp/bill_pending_sanction',$data);
		$this->load->view('layout/footer');
	}
	public function application_recommendation(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['employees'] = $this->emp_model->get_branch_officer_list();
		$id = $this->uri->segment(3);
		$data['row'] = array();	
		
		if(!empty($id)){
			$data['records'] = $this->emp_model->get_employee_application_recomn($id);
			if(empty($data['records'])){
				show_404('admin');
			}
		}
		else{
			show_404('admin');
		}
		if($this->input->post()){	
			$this->emp_model->update_employee_application_recom($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(SITE_BASE_URL.'emp/application_pending_recommendation');
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		
		if($data['emp_data']['desig']=='SR. ACCOUNTS OFFICER' || $data['emp_data']['desig']=='SR. ACCOUNTS OFFICER (Adhoc)'){
			$this->load->view('pages/emp/application_recommendation',$data);
		}else{
			$this->load->view('pages/emp/application_recommendation_sec',$data);
		}
		
		$this->load->view('layout/footer');
	}
	public function leave_application_clrh(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['profile'] = $this->emp_model->get_employee_details($data['emp_data']['empid']);
		$data['employees'] = $this->emp_model->get_authority_list();
		$data['error'] = '';
		$data['designation'] = array();
		foreach($data['employees'] as $val){
			if(!in_array($val['desig'],$data['designation'])){
				$data['designation'][] = $val['desig'];
			}			
		}
		$data['row'] = array();
		$data['asign_emp'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->emp_leave_application($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$empid = $data['emp_data']['empid'];
		if($this->input->get('leave_type')){		
			$leave_type = $this->input->get('leave_type',true);
			$leave_cr_year = $this->input->get('year',true);
			$data['leave_debits'] = $this->emp_model->get_employee_leave_debit($empid,$leave_type);
//			$data['leave_balance'] = $this->emp_model->get_leave_current_balance($empid,$leave_type);
			$data['leave_balance'] = $this->emp_model->get_clrh_closing_balance($empid,$leave_type,$leave_cr_year);
//			$data['leave_credit'] = $this->emp_model->get_employee_leave_credit($empid,$leave_type);
		}else{			
		// Code
		}
		$rh_for = date('Y-m-d',strtotime($this->input->post('leave_from')));
		$leave_applied = date('Y-m-d',strtotime($this->input->post('application_dt')));		
		$data['leave_application'] = $this->emp_model->fetch_employee_leave_application($data['emp_data']['empid']);
		if($this->input->post()){
			$yr = date('Y',strtotime($this->input->post('leave_from')));
	
		if($leave_cr_year == $yr){		
			$this->form_validation->set_rules('balance_leave', 'Balance Leave', 'required|xss_clean',array('required'=> 'Insufficent Leave Balance.'));
			$this->form_validation->set_rules('sanction_autho_pan', 'Authority', 'required|xss_clean',array('required'=> 'Authority not selected.'));
			$this->form_validation->set_rules('c_image', 'Image Code', 'required|xss_clean',array('required'=> 'Please write image code'));
			if ($this->form_validation->run() == FALSE){
				$data['error'] = validation_errors();
			}else{				
				$cap_code = $this->session->userdata('cap_data');
				if($cap_code != $this->input->post('c_image')){
					$data['error'] = $this->lang->line('image_code_not_matched');
				}else{
					if(!empty($id)){ // edit
						$balance = $this->emp_model->update_employee_leave_debit($id,$data['emp_data']['empid']);
						$cb_id = $this->emp_model->emp_leave_current_balance($data['emp_data']['empid'],$leave_type,$balance);
						$cr_id = $this->emp_model->emp_clrh_current_balance($data['emp_data']['empid'],$leave_type,$leave_cr_year,$balance);
						$this->session->set_flashdata('success','Successfully updated.');
					}else{ // add
						if( $this->input->post('balance_leave') > 0 && $this->input->post('leave_day_no') >0 && ($this->input->post('balance_leave') - $this->input->post('leave_day_no'))>= 0){
							if( $this->input->get('leave_type') == 'Restricted Holiday' &&  $leave_applied > $rh_for ){
								$this->session->set_flashdata('error','You cannot submit Restricted Holiday for previous day.');
							}else{
								$balance = $id = $this->emp_model->emp_leave_application($data['emp_data']['empid']);
								$cb_id = $this->emp_model->emp_leave_current_balance($data['emp_data']['empid'],$leave_type,$balance);
								$cr_id = $this->emp_model->emp_clrh_current_balance($data['emp_data']['empid'],$leave_type,$leave_cr_year,$balance);
								$this->session->set_flashdata('success','Successfully submitted. Search to edit before sanction or view the leave application.');
							}						
						}else{
							$this->session->set_flashdata('error','Insufficient Leave Balance OR enter No of Days to be deducted.');
						}
					}
					redirect(SITE_BASE_URL.'emp/leave_clrh');
				}
			}
		}
		else{
			$this->session->set_flashdata('error','Leave is not appilied for year as selected.');
			redirect(SITE_BASE_URL.'emp/leave_application_clrh');
		}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');	
		$data['total'] = $this->emp_model->get_leave_returned_count($empid);
//		print_r ($data['total']['retn_total']);
		if($data['total']['retn_total']>0){		
			$data['leave_debits'] = $this->emp_model->get_employee_leave_debit_returned($empid);
			$this->load->view('pages/emp/leave_clrh_return',$data);
		}else{			
			$this->load->view('pages/emp/leave_application_clrh',$data);
		}
		$this->load->view('layout/footer');
	}
	public function cl_deduction(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security'); 
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);

		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['error'] = '';
		$empid = $this->input->get('empid',true);
		$leave_type = 'Casual Leave';
		$data['leave_balance'] = $this->emp_model->get_leave_current_balance($empid, $leave_type);
		$data['authority'] = $this->emp_model->get_employee_details($data['emp_data']['empid']);
		$data['profile'] = $this->emp_model->get_employee_details($empid);	

//print_r($_post['sanction_autho']);
//echo $autho_desig;
//exit;
/*	
		$id = '';
		if(!empty($id)){
			$data['row'] = $this->emp_model->emp_leave_application($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		  }
*/
			If($this->input->post()){
			$this->form_validation->set_rules('c_image', 'Image Code', 'required|xss_clean',array('required'=> 'Please write image code'));
			if ($this->form_validation->run() == FALSE){
				$data['error'] = validation_errors();
			}else{				
				$cap_code = $this->session->userdata('cap_data');
				if($cap_code != $this->input->post('c_image')){
					$data['error'] = $this->lang->line('image_code_not_matched');
				}else{
						if($data['emp_data']['desig'] == 'SR. ACCOUNTS OFFICER' || $data['emp_data']['desig']=='SR. ACCOUNTS OFFICER (Adhoc)'|| $data['emp_data']['desig'] == 'DY. ACCOUNTANT GENERAL'){
							if(!empty($id)){ // edit
								$balance = $this->emp_model->update_employee_leave_debit($id,$empid);
								$cb_id = $this->emp_model->emp_leave_current_balance($empid,$leave_type,$balance);
								$this->session->set_flashdata('success','Successfully updated.');
							}else{ // add
								if( $this->input->post('balance_leave')>0 && $this->input->post('leave_day_no') > 0 && ($this->input->post('balance_leave') - $this->input->post('leave_day_no'))>= 0){
									$balance = $this->emp_model->emp_cl_leave_deduction($empid);
									$cb_id = $this->emp_model->emp_leave_current_balance($empid,$leave_type,$balance);
									$this->session->set_flashdata('success','Successfully deducted.');
								}else{
									$this->session->set_flashdata('error','Insufficient Leave Balance.');
								}
							}
						}else{
							$this->session->set_flashdata('error','You are not authorised to deduct Casual Leave.');
						}	
						redirect(SITE_BASE_URL.'emp/cl_deduction');
					}
				}
			}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/cl_deduction',$data);
		$this->load->view('layout/footer');
	}
	
	public function leave_application_clrh_edit(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
			
		$id = $this->uri->segment(3);
		$data['error'] = '';
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['profile'] = $this->emp_model->get_employee_details($data['emp_data']['empid']);
		$data['employees'] = $this->emp_model->get_authority_list();
		$data['designation'] = array();
		foreach($data['employees'] as $val){
			if(!in_array($val['desig'],$data['designation'])){
				$data['designation'][] = $val['desig'];
			}			
		}
		$data['row'] = array();
		$data['asign_emp'] = array();

		if(!empty($id)){
			$data['leaves'] = $this->emp_model->fetch_employee_leave_application($data['emp_data']['empid'],$id);
			if(empty($data['leaves'])){
				show_404('admin');
			}
		}
		else{
			show_404('admin');
		}
		$rh_for = date('Y-m-d',strtotime($this->input->post('leave_from')));
		$leave_applied = date('Y-m-d',strtotime($this->input->post('application_dt')));	
		$leave_type = $this->emp_model->fetch_employee_leave_application_leave_type($data['emp_data']['empid'],$id);
		$leave_cr_year = $this->emp_model->fetch_employee_leave_application_leave_year($data['emp_data']['empid'],$id);
		$data['leave_balance'] = $this->emp_model->get_clrh_closing_balance($data['emp_data']['empid'],$leave_type,$leave_cr_year);
		if($this->input->post()){
			if( $this->input->post('balance_leave') > 0 && $this->input->post('leave_day_no') > 0 && ($this->input->post('balance_leave') - $this->input->post('leave_day_no'))>= 0){
				if( $leave_type == 'Restricted Holiday' &&  $leave_applied > $rh_for ){
					$this->session->set_flashdata('error','You cannot submit Restricted Holiday for a previous day.');
				}else{
					$balance = $this->input->post('balance_leave') - $this->input->post('leave_day_no');
					$cb = $this->emp_model->update_employee_clrh_debit($id);
					$cb_id = $this->emp_model->emp_leave_current_balance($data['emp_data']['empid'],$leave_type,$balance);
					$cr_id = $this->emp_model->emp_clrh_current_balance($data['emp_data']['empid'],$leave_type,$leave_cr_year,$balance);
					$this->session->set_flashdata('success','Successfully updated. Search to edit before sanction or view the leave application.');
					redirect(SITE_BASE_URL.'emp/leave_clrh');
				}						
			}else{
				$this->session->set_flashdata('error','Insufficient Leave Balance OR Check "No of Days" to be deducted.');
			}
		}	
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		if ($leave_type == 'Restricted Holiday'){
			$this->load->view('pages/emp/leave_application_clrh_editrh',$data);
		}else{
			$this->load->view('pages/emp/leave_application_clrh_edit',$data);
		}
//		$this->load->view('pages/emp/leave_application_clrh_edit',$data);
		$this->load->view('layout/footer');
	}	
	public function leave_sanction_clrh(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		
		$data['employees'] = $this->emp_model->get_authority_list();
		$data['designation'] = array();
		foreach($data['employees'] as $val){
			if(!in_array($val['desig'],$data['designation'])){
				$data['designation'][] = $val['desig'];
			}			
		}
		$id = $this->uri->segment(3);

		$data['row'] = array();
		$data['asign_emp'] = array();	
		if(!empty($id)){
			$data['leaves'] = $this->emp_model->fetch_employee_clrh_sanction($data['emp_data']['empid'],$id);
			if(empty($data['leaves'])){
				show_404('admin');
			}
		}
		else{
			show_404('admin');
		}		
		
		if(!empty($this->input->post('leave_status'))){
			$empid = $this->input->post('empid');
			$leave_type = $this->input->post('leave_type');
			$leave_cr_year = $this->input->post('leave_dr_year');
			$no_days = $this->input->post('leave_day_no');
			$data['leave_balance'] = $this->emp_model->get_yearwise_closing_clrh_balance($empid,$leave_type,$leave_cr_year);
			$bal_restore = $data['leave_balance']['leave_cb'] + $no_days ; 
			$this->emp_model->emp_leave_sanction_clrh($id,$empid,$leave_type,$leave_cr_year,$bal_restore);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(SITE_BASE_URL.'emp/leave_pending_clrh');
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_sanction_clrh',$data);
		$this->load->view('layout/footer');
	}
/*
	public function leave_pending_clrh(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		
		$empid = $data['emp_data']['empid'];
		$leave_dr_year = $this->input->get('year',true);
		$leave_type = $this->input->get('leave_type',true);	

		if($this->input->get('leave_type')){
			$data['results'] = $this->emp_model->get_leave_pending_clrh($empid,$leave_type,$leave_dr_year);
		}else{			
//			$data['subs_details'] =[];		
		}	
		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_pending_clrh',$data);
		$this->load->view('layout/footer');
	}
*/
	public function leave_pending_clrh(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		$leave_dr_year = $this->input->get('year',true);
		$leave_type = $this->input->get('leave_type',true);	
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response =  $this->emp_model->get_leave_pending_clrh($page_no, $empid);
		$data['results'] = $response['results'];
		$config['base_url'] = base_url().'emp/leave_pending_clrh';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_pending_clrh',$data);
		$this->load->view('layout/footer');
	}
	
	public function leave_application_clrh_print(){

		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(3);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->leave_debits($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$this->load->view('pages/emp/leave_application_clrh_print',$data);
	}	
		
	public function leave_application(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		$this->load->model('common_model');
		
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['profile'] = $this->emp_model->get_employee_details($data['emp_data']['empid']);
		$first_second_child = $this->input->get('first_second_child');
		$data['employees'] = $this->emp_model->get_authority_list();
		$data['members'] = $this->emp_model->get_family_member($data['emp_data']['empid'],$first_second_child);
		$data['error'] = '';
		$data['designation'] = array();
		
		foreach($data['employees'] as $val){
			if(!in_array($val['desig'],$data['designation'])){
				$data['designation'][] = $val['desig'];
			}			
		}
		
		$data['row'] = array();
		$data['asign_emp'] = array();
		
		if(!empty($id)){
			$data['row'] = $this->emp_model->emp_leave_application($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$empid = $data['emp_data']['empid'];
		$leave_type = '';
		$cr_to_date = '';
		$credit_upto = '';
		$data['last_leave_debits'] = array();
		$data['last_credit'] = array();
		

		if($this->input->get('leave_type')){		
			$leave_type = $this->input->get('leave_type',true);			
			$data['leave_debits'] = $this->emp_model->get_employee_leave_debit($empid,$leave_type);   //  Not used
			$data['leave_balance'] = $this->emp_model->get_leave_current_balance($empid,$leave_type);
			$data['leave_credit'] = $this->emp_model->get_employee_leave_credit($empid,$leave_type);	// Not used
			$data['last_credit'] = $this->emp_model->get_employee_el_last_credit($empid,$leave_type);
		}else{			
		// Code
		}

		$data['last_leave_debits'] = $this->emp_model->get_employee_last_leave_debit($empid);
		if(!empty($data['last_leave_debits'])){
			$last_leave_id = implode('',max($data['last_leave_debits']));
			$data['last_leave_taken'] = $this->emp_model->leave_debits($last_leave_id);
		}
		
//		print_r($data['last_credit']);
//		exit;		
//		echo $last_leave_id.'<br>';
//		echo $empid.'<br>';
		$data['leave_application'] = $this->emp_model->fetch_employee_leave_application($data['emp_data']['empid']);
	
		if($this->input->post()){
			$this->form_validation->set_rules('balance_leave', 'Balance Leave', 'required|xss_clean',array('required'=> 'Insufficent Leave Balance.'));
			$this->form_validation->set_rules('recom_autho_pan', 'Authority', 'required|xss_clean',array('required'=> 'Authority not selected.'));
			$this->form_validation->set_rules('c_image', 'Image Code', 'required|xss_clean',array('required'=> 'Please write image code'));
			if ($this->form_validation->run() == FALSE){
				$data['error'] = validation_errors();
			}else{				
				$cap_code = $this->session->userdata('cap_data');
				if($cap_code != $this->input->post('c_image')){
					$data['error'] = $this->lang->line('image_code_not_matched');
				}else{
					if(!empty($data['last_credit'])){			
					$credit_upto =implode('',max($data['last_credit']));
					}
					$leave_applied=$this->input->post('leave_type');
					$leave_days=$this->input->post('leave_day_no');
					$leave_ground=$this->input->post('ground');
					$leave_balan=$this->input->post('balance_leave');
					$balance_left=$this->input->post('balance_leave')-$this->input->post('leave_day_no');
					$leave_start= date('Y-m-d',strtotime($this->input->post('leave_from')));
					$leave_end=date('Y-m-d',strtotime($this->input->post('leave_to')));
					$avail_start=date('Y-m-d',strtotime($this->input->post('avail_from')));
					$avail_by=date('Y-m-d',strtotime($this->input->post('avail_by')));

				if( date('Y',strtotime($this->input->post('application_dt'))) == date('Y',$credit_upto)  && $leave_type == 'Earned Leave' && $leave_balan >= 300 ){
					$this->session->set_flashdata('error','Your credit for the period is yet to be updated. Contact Administration-III to update your Earned Leave credit.');
					}else{
						if(!empty($id)){ // edit
							$balance=$this->emp_model->update_employee_leave_debit($id,$data['emp_data']['empid']);	
							// updating another table						
							$cb_id = $this->emp_model->emp_leave_current_balance($data['emp_data']['empid'],$leave_type,$balance);
							$this->session->set_flashdata('success','Successfully updated.');
						}else{ // add
							if($leave_balan > 0 &&  $leave_days > 0 && $leave_balan - $leave_days >= 0){
									if ($leave_applied == 'Earned Leave' || $leave_applied == 'Half Pay Leave' || $leave_applied == 'Extra Ordinary Leave'|| $leave_applied == 'Study Leave'){
										if($leave_ground !== 'Leave Encashment'){
											
//-----------------------------------------On success file upload	start			
											if(isset($_FILES['link_file']) && $_FILES['link_file']['size'] > 0){
											//upload file
												$upload_details = $this->common_model->upload_leave_documents('link_file');					
												if(!$upload_details['is_success']){
													$this->session->set_flashdata('error',$upload_details['message']);
													$error = $upload_details['message'];
												}else{
													//$this->input->post('link_file',$upload_details['filename']);
													$_POST['link_file'] = $upload_details['filename'];
												}
											}
//------------------------------------------File Upload complete	

											//insert for leave type--> Earned Leave, Half Pay Leave, Extra Ordinary Leave, Study Leave.
											$balance = $this->emp_model->emp_leave_application($data['emp_data']['empid']);
											// inserting to another table
											$cb_id = $this->emp_model->emp_leave_current_balance($data['emp_data']['empid'],$leave_type,$balance);

												$this->session->set_flashdata('success','Successfully submitted. Search to edit before sanction or view the leave application.');
										}else{
											if($leave_ground == 'Leave Encashment' && $balance_left >= 30){
												$balance = $this->emp_model->emp_leave_application($data['emp_data']['empid']);
												$cb_id = $this->emp_model->emp_leave_current_balance($data['emp_data']['empid'],$leave_type,$balance);
												$this->session->set_flashdata('success','Application for Leave Encashment submitted successfully.');
											}else {
												$this->session->set_flashdata('error','Minimum 30 days of balance must be maintained after Leave Encashment');
											}
										}		
									}else{
											if($avail_start <= $leave_start && $leave_end < $avail_by){
																								
//-----------------------------------------On success file upload	start			
											if(isset($_FILES['link_file']) && $_FILES['link_file']['size'] > 0){
											//upload file
												$upload_details = $this->common_model->upload_leave_documents('link_file');					
												if(!$upload_details['is_success']){
													$this->session->set_flashdata('error',$upload_details['message']);
													$error = $upload_details['message'];
												}else{
													//$this->input->post('link_file',$upload_details['filename']);
													$_POST['link_file'] = $upload_details['filename'];
												}
											}
//------------------------------------------File Upload complete	
		
												//insert for leave type--> Child Care Leave, Maternity Leave, Paternity Leave
												$balance = $this->emp_model->emp_leave_application($data['emp_data']['empid']);
												// inserting to another table
												$cb_id = $this->emp_model->emp_leave_current_balance($data['emp_data']['empid'],$leave_type,$balance);
										
												$this->session->set_flashdata('success','Successfully submitted. Search to edit before sanction or view the leave application.');
											}else{
												$this->session->set_flashdata('error','Apply for the leave within the permissible period.');
											}
										}
								
							}else{
								$this->session->set_flashdata('error','Insufficient Leave Balance.');
							}
						}
						redirect(SITE_BASE_URL.'emp/leave_debit');
					}
				}
			}
		
		}		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_application',$data);
		$this->load->view('layout/footer');
	}
	
	public function leave_application_edit(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(3);
		$data['error'] = '';
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['profile'] = $this->emp_model->get_employee_details($data['emp_data']['empid']);
		$data['employees'] = $this->emp_model->get_authority_list();
		$data['designation'] = array();
		foreach($data['employees'] as $val){
			if(!in_array($val['desig'],$data['designation'])){
				$data['designation'][] = $val['desig'];
			}			
		}
		$data['row'] = array();
		$data['asign_emp'] = array();	
		if(!empty($id)){
			$data['leaves'] = $this->emp_model->fetch_employee_leave_application($data['emp_data']['empid'],$id);
			if(empty($data['leaves'])){
				show_404('admin');
			}
		}
		else{
			show_404('admin');
		}		

		$leave_type = $this->emp_model->fetch_employee_leave_application_leave_type($data['emp_data']['empid'],$id);
		$data['leave_balance'] = $this->emp_model->get_leave_current_balance($data['emp_data']['empid'],$leave_type);
		$leave_days=$this->input->post('leave_day_no');
		$leave_ground=$this->input->post('ground');
		$leave_balan=$this->input->post('balance_leave');
		$balance_left=$this->input->post('balance_leave')-$this->input->post('leave_day_no');
		$leave_start= date('Y-m-d',strtotime($this->input->post('leave_from')));
		$leave_end=date('Y-m-d',strtotime($this->input->post('leave_to')));
		$avail_start=date('Y-m-d',strtotime($this->input->post('avail_from')));
		$avail_by=date('Y-m-d',strtotime($this->input->post('avail_by')));

		if($this->input->post()){
			if($leave_balan > 0 &&  $leave_days > 0 && $leave_balan - $leave_days >= 0){
				if ($leave_type == 'Earned Leave' || $leave_type == 'Half Pay Leave' || $leave_type == 'Extra Ordinary Leave'|| $leave_type == 'Study Leave'){
					if($leave_ground !== 'Leave Encashment'){					
//-----------------------------------------On success file upload	start			
											if(isset($_FILES['link_file']) && $_FILES['link_file']['size'] > 0){
											//upload file
												$upload_details = $this->common_model->upload_leave_documents('link_file');					
												if(!$upload_details['is_success']){
													$this->session->set_flashdata('error',$upload_details['message']);
													$error = $upload_details['message'];
												}else{
													//$this->input->post('link_file',$upload_details['filename']);
													$_POST['link_file'] = $upload_details['filename'];
												}
											}
//------------------------------------------File Upload complete
							$balance = $this->emp_model->update_employee_leave_debit($id,$data['emp_data']['empid']);
						    $cb_id = $this->emp_model->emp_leave_current_balance($data['emp_data']['empid'],$leave_type,$balance);
							$this->session->set_flashdata('success','Successfully updated. Search to edit before sanction or view the leave application.');
							redirect(SITE_BASE_URL.'emp/leave_debit');
					}else{
						if($leave_ground == 'Leave Encashment' && $balance_left >= 30){
							$balance = $this->emp_model->update_employee_leave_debit($id,$data['emp_data']['empid']);
							$cb_id = $this->emp_model->emp_leave_current_balance($data['emp_data']['empid'],$leave_type,$balance);
							$this->session->set_flashdata('success','Application for Leave Encashment updated successfully.');
						}else {
							$this->session->set_flashdata('error','Minimum 30 days of balance must be maintained after Leave Encashment');
						}
					}
				}else{
						if($avail_start <= $leave_start && $leave_end < $avail_by){					
//-----------------------------------------On success file upload	start			
											if(isset($_FILES['link_file']) && $_FILES['link_file']['size'] > 0){
											//upload file
												$upload_details = $this->common_model->upload_leave_documents('link_file');					
												if(!$upload_details['is_success']){
													$this->session->set_flashdata('error',$upload_details['message']);
													$error = $upload_details['message'];
												}else{
													//$this->input->post('link_file',$upload_details['filename']);
													$_POST['link_file'] = $upload_details['filename'];
												}
											}
//------------------------------------------File Upload complete	
						$balance = $this->emp_model->update_employee_leave_debit($id,$data['emp_data']['empid']);
						$cb_id = $this->emp_model->emp_leave_current_balance($data['emp_data']['empid'],$leave_type,$balance);
						$this->session->set_flashdata('success','Successfully updated. Search to edit before sanction or view the leave application.');
						redirect(SITE_BASE_URL.'emp/leave_debit');
						}else{
							$this->session->set_flashdata('error','Apply for the leave within the permissible period.');
						}
					}
			}else{
				$this->session->set_flashdata('error','Insufficient Leave Balance.');
			}
		}

		$data['cap'] = get_captcha();
		$this->load->view('layout/header');	
		if ($leave_type == 'Earned Leave' || $leave_type =='Half Pay Leave' || $leave_type =='Extra Ordinary Leave'|| $leave_type =='Study Leave'){
			$this->load->view('pages/emp/leave_application_edit',$data);
		}else{
			$this->load->view('pages/emp/leave_application_edit_other',$data);
		}		
//		$this->load->view('pages/emp/leave_application_edit',$data);
		$this->load->view('layout/footer');
	}	
	public function leave_application_hold(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(3);
		$data['error'] = '';
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		$data['profile'] = $this->emp_model->get_employee_details($empid);

		if(!empty($id)){		
			$data['leaves'] = $this->emp_model->fetch_employee_leave_application($empid,$id);

			if(empty($data['leaves'])){
				show_404('admin');
			}
		}
		$leave_type = $data['leaves']['leave_type'];
		$no_days = $data['leaves']['leave_day_no'];
		
		$data['leave_balance'] = $this->emp_model->get_elhpl_closing_balance($empid,$leave_type);
		if($leave_type == 'Earned Leave' && $data['leave_balance']['leave_cb']<=315 ){
			$bal_restore = $data['leave_balance']['leave_cb'] + $no_days ; 
			if($bal_restore>315){
				$bal_restore = 315;
			}
		}
		if($leave_type == 'Half Pay Leave'){
			$bal_restore = $data['leave_balance']['leave_cb'] + $no_days ; 
		}
		if(!empty($id)){
			$this->emp_model->update_employee_other_leave_debit_hold($id,$empid,$leave_type,$bal_restore);	
			$this->session->set_flashdata('success','Leave is held for submission later.');
			redirect(SITE_BASE_URL.'emp/leave_debit');
		}
		$this->load->view('layout/header');			
		$this->load->view('pages/emp/leave_debit',$data);
		$this->load->view('layout/footer');
	}	
	public function leave_application_hold_clrh(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(3);
		$data['error'] = '';
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		$data['profile'] = $this->emp_model->get_employee_details($empid);
		if(!empty($id)){		
			$data['leaves'] = $this->emp_model->fetch_employee_leave_application($empid,$id);

			if(empty($data['leaves'])){
				show_404('admin');
			}
		}
		$leave_type = $data['leaves']['leave_type'];
		$leave_cr_year = $data['leaves']['leave_dr_year'];
		$no_days = $data['leaves']['leave_day_no'];
		
		$data['leave_balance'] = $this->emp_model->get_yearwise_closing_clrh_balance($empid,$leave_type,$leave_cr_year);
		$bal_restore = $data['leave_balance']['leave_cb'] + $no_days ; 
		if(!empty($id)){
			$this->emp_model->update_employee_clrh_leave_debit_hold($id,$empid,$leave_type,$leave_cr_year,$bal_restore);	
			$this->session->set_flashdata('success','Leave is held for submission later.');
			redirect(SITE_BASE_URL.'emp/leave_clrh');
		}
		$this->load->view('layout/header');			
		$this->load->view('pages/emp/leave_clrh',$data);
		$this->load->view('layout/footer');
	}
	public function leave_convert(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$id = $this->uri->segment(3);
		if(!empty($id)){
			$this->emp_model->leave_convertByID($id);
			$this->session->set_flashdata('success','Leave converted successfully.');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		redirect(SITE_BASE_URL.'emp/leave_application_clrh');	
	}	
	public function leave_improper(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
//		$response = $this->emp_model->get_employee_office_orders($page_no,$data['emp_data']['empid']);
//		$data['leave_debits'] = $this->emp_model->get_employee_clrh_debit($empid,$leave_type,$leave_dr_year);
		$response = $this->emp_model->get_employee_leave_debit_improper($page_no, $data['emp_data']['empid']);
		$data['results'] = $response['results'];

		$config['base_url'] = base_url().'emp/leave_improper';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;
		
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_improper',$data);
		$this->load->view('layout/footer');
	}
	public function leave_application_sectcheck(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		
		$data['employees'] = $this->emp_model->get_authority_list();
		$data['designation'] = array();
		foreach($data['employees'] as $val){
			if(!in_array($val['desig'],$data['designation'])){
				$data['designation'][] = $val['desig'];
			}			
		}
		$id = $this->uri->segment(3);

		$data['row'] = array();
		$data['asign_emp'] = array();
		$data['leaves']=array();
		
		if(!empty($id)){
			$data['leaves'] = $this->emp_model->fetch_employee_leave_application_check($data['emp_data']['empid'],$id);			

		if(empty($data['leaves'])){
				show_404('admin');
			}
		}
		else{
			echo "else";
			show_404('admin');
		}		
//	echo $this->db->last_query();
//  print_r($data['leaves']);
		if($this->input->post()){	
			$this->emp_model->update_leave_application_varification($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(SITE_BASE_URL.'emp/leave_pending_check_all');
		}
	
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_application_sectcheck',$data);
		$this->load->view('layout/footer');
	}
	public function leave_application_sanction(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		
		$data['employees'] = $this->emp_model->get_authority_list();
		$data['designation'] = array();
		foreach($data['employees'] as $val){
			if(!in_array($val['desig'],$data['designation'])){
				$data['designation'][] = $val['desig'];
			}			
		}
		$id = $this->uri->segment(3);
		$leave_type=$this->input->post('leave_type');
		$leave_day_no=$this->input->post('leave_day_no');
		$leave_status=$this->input->post('leave_status');
		$data['row'] = array();
		$data['asign_emp'] = array();
		$data['leaves']=array();		
		if(!empty($id)){		
			$data['leaves'] = $this->emp_model->fetch_employee_leave_application_sanction($data['emp_data']['empid'],$id);

			if(empty($data['leaves'])){
				show_404('admin');
			}
		}
		else{
			show_404('admin');
		}		
		if($this->input->post()){
			$empid=$this->input->post('empid');
			$cur_balance=$this->emp_model->update_leave_application_sanction($id,$empid,$leave_type);
			if($leave_status == 'Cancelled'){
				$update_bal=$cur_balance + $leave_day_no ;
				if($update_bal >= 315 && $leave_type == 'Earned Leave'){
					$update_balance = 315 ;
				}else{
					$update_balance = $update_bal ;
				}
				$cb_id = $this->emp_model->emp_leave_current_balance($empid,$leave_type,$update_balance);
			}
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(SITE_BASE_URL.'emp/leave_pending_sanction_all');
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_application_sanction',$data);
		$this->load->view('layout/footer');
	}
	
	public function leave_application_recommendation(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		
		$data['employees'] = $this->emp_model->get_recomm_list();
		$data['designation'] = array();
		foreach($data['employees'] as $val){
			if(!in_array($val['desig'],$data['designation'])){
				$data['designation'][] = $val['desig'];
			}			
		}
		$id = $this->uri->segment(3);

		$data['row'] = array();
		$data['asign_emp'] = array();
		$data['leaves']=array();
		
		if(!empty($id)){
			$data['leaves'] = $this->emp_model->fetch_employee_leave_application_reco($data['emp_data']['empid'],$id);			

		if(empty($data['leaves'])){
				show_404('admin');
			}
		}
		else{
			echo "else";
			show_404('admin');
		}		
//	echo $this->db->last_query();
//  print_r($data['leaves']);
		if($this->input->post()){	
			$this->emp_model->update_leave_application_recommendation($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(SITE_BASE_URL.'emp/leave_pending_recommendation_all');
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_application_recommendation',$data);
		$this->load->view('layout/footer');
	}

	public function leave_application_print(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
			
		$id = $this->uri->segment(3);
		
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->leave_debits($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$this->load->view('pages/emp/leave_application_print',$data);
	}

	public function leave_pending_recommendation(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		$empid = $data['emp_data']['empid'];
		if($this->input->get('leave_type')){		
			$leave_type = $this->input->get('leave_type',true);			
			$data['office_orders'] = $this->emp_model->get_leave_pending_recommendaton($empid,$leave_type);
		}else{			
//			$data['details'] =[];		
		}	
		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_pending_recommendation',$data);
		$this->load->view('layout/footer');
	}	
	public function leave_pending_recommendation_all(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_leave_pending_recommendaton_all($page_no, $empid);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'emp/leave_pending_recommendation_all';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;

		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_pending_recommendation_all',$data);
		$this->load->view('layout/footer');
	}
	public function leave_pending_check_all(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_leave_pending_check_all($page_no, $empid);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'emp/leave_pending_check_all';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;

		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_pending_check_all',$data);
		$this->load->view('layout/footer');
	}
	public function leave_pending_sanction_all(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_leave_pending_sanction_all($page_no, $empid);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'emp/leave_pending_sanction_all';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;

		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_pending_sanction_all',$data);
		$this->load->view('layout/footer');
	}
	public function leave_sanctioned_all(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->leave_sanctioned_all_view($page_no, $empid);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'emp/leave_sanctioned_all';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;

		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_sanctioned_all',$data);
		$this->load->view('layout/footer');
	}	
	public function leave_all_emp(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		if($this->input->get('search')){
			$search_id = $this->input->get('search',true);
			$leave_type = $this->input->get('leave_type',true);
			$leave_year = $this->input->get('leave_year',true);
			$data['results'] = $this->emp_model->employee_leave_list($search_id,$leave_type,$leave_year);
		}
		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_all_emp',$data);
		$this->load->view('layout/footer');
	}
	public function leave_pending_sanction(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		$empid = $data['emp_data']['empid'];
		if($this->input->get('leave_type')){		
			$leave_type = $this->input->get('leave_type',true);			
			$data['office_orders'] = $this->emp_model->get_leave_pending_sanction($empid,$leave_type);
		}else{			
//			$data['subs_details'] =[];		
		}	
		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_pending_sanction',$data);
		$this->load->view('layout/footer');
	}
	public function leave_joining_report(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		$empid = $data['emp_data']['empid'];
		if($this->input->get('leave_type')){		
			$leave_type = $this->input->get('leave_type',true);			
			$data['office_orders'] = $this->emp_model->get_leave_pending_joining($empid,$leave_type);
		}else{			
//			$data['subs_details'] =[];		
		}	
		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_joining_report',$data);
		$this->load->view('layout/footer');
	}
	
	public function leave_joining_report_all(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_leave_pending_joining_all($page_no, $empid);
		$data['results'] = $response['results'];

		$config['base_url'] = base_url().'emp/leave_joining_report_all';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;

		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_joining_report_all',$data);
		$this->load->view('layout/footer');
	}	
	public function leave_joining(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->model('emp_model');
		$this->load->model('common_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
			
		$id = $this->uri->segment(3);
		$data['error'] = '';
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['profile'] = $this->emp_model->get_employee_details($data['emp_data']['empid']);
		
		$data['employees'] = $this->emp_model->get_authority_list();
		$data['designation'] = array();
		
		foreach($data['employees'] as $val){
			if(!in_array($val['desig'],$data['designation'])){
				$data['designation'][] = $val['desig'];
			}			
		}


		$data['row'] = array();
		$data['asign_emp'] = array();	
		if(!empty($id)){
			$data['leaves'] = $this->emp_model->fetch_employee_leave_application($data['emp_data']['empid'],$id);
			if(empty($data['leaves'])){
				show_404('admin');
			}
		}
		else{
			show_404('admin');
		}		
		
		if($this->input->post()){
			//-----------------------------------------On success file upload	start			
				if(isset($_FILES['linkmc_file']) && $_FILES['linkmc_file']['size'] > 0){
					//upload file
					$upload_details = $this->common_model->upload_leave_documents('linkmc_file');					
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
					}else{
						//$this->input->post('linkmc_file',$upload_details['filename']);
						$_POST['linkmc_file'] = $upload_details['filename'];
					}
				}
			
			//------------------------------------------File Upload complete	
			$this->emp_model->update_joining_date($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(SITE_BASE_URL.'emp/information');
		}	
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_joining',$data);
		$this->load->view('layout/footer');
	}	

	public function leave_joining_approval(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		
		$data['employees'] = $this->emp_model->get_authority_list();
		$data['designation'] = array();
		foreach($data['employees'] as $val){
			if(!in_array($val['desig'],$data['designation'])){
				$data['designation'][] = $val['desig'];
			}			
		}
		$id = $this->uri->segment(3);

		$data['row'] = array();
		$data['asign_emp'] = array();	
		if(!empty($id)){
			$data['leaves'] = $this->emp_model->fetch_employee_joining_application($data['emp_data']['empid'],$id);
			if(empty($data['leaves'])){
				show_404('admin');
			}
		}
		else{
			show_404('admin');
		}		
		
		if($this->input->post()){	
			$this->emp_model->update_joining_sanction($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(SITE_BASE_URL.'emp/leave_joining_report_all');
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_joining_approval',$data);
		$this->load->view('layout/footer');
	}
	public function leave_history_clrh_all(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_employee_clrh_history_all($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'emp/leave_history_clrh_all';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;

		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_history_clrh_all',$data);
		$this->load->view('layout/footer');
	}
	public function leave_history_clrh(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
//		$empid = $data['emp_data']['empid'];
		if($this->input->get('leave_type')){
			$empid = $this->input->get('empid',true);
			$leave_type = $this->input->get('leave_type',true);
			$leave_dr_year = $this->input->get('leave_dr_year',true);
			$data['leaves'] = $this->emp_model->get_employee_clrh_history($empid,$leave_type,$leave_dr_year);
		}else{			
//			$data['subs_details'] =[];		
		}	
		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_history_clrh',$data);
		$this->load->view('layout/footer');
	}
	
	public function leave_history_all(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_employee_leave_history_all($page_no);
		$data['results'] = $response['results'];
		$config['base_url'] = base_url().'emp/leave_history_all';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_history_all',$data);
		$this->load->view('layout/footer');
	}
	public function leave_history(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		$empid = $data['emp_data']['empid'];
		if($this->input->get('leave_type')){		
			$leave_type = $this->input->get('leave_type',true);			
			$data['leaves'] = $this->emp_model->get_employee_leave_history($empid,$leave_type);
		}else{			
//			$data['subs_details'] =[];		
		}	
		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_history',$data);
		$this->load->view('layout/footer');
	}
	
	public function encashment_application(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['profile'] = $this->emp_model->get_employee_details($data['emp_data']['empid']);
		$data['loan_application'] = $this->emp_model->get_employee_encashment_application($data['emp_data']['empid']);
		if($this->input->post()){
			$this->form_validation->set_rules('c_image', 'Image Code', 'required|xss_clean',array('required'=> 'Please write image code'));
			if ($this->form_validation->run() == FALSE){
               $data['error'] = validation_errors();
            }else{
				$cap_code = $this->session->userdata('cap_data');
				if($cap_code != $this->input->post('c_image')){
					$data['error'] = $this->lang->line('image_code_not_matched');
				}else{
					$reg_status = $this->emp_model->emp_encashment_application($data['emp_data']['empid']);
					$this->session->set_flashdata('success','Your application successfully sent.');
					redirect('emp/encashment_application');
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/encashment_application',$data);
		$this->load->view('layout/footer');
	}
	
	public function loan_application(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');	
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['profile'] = $this->emp_model->get_employee_details($data['emp_data']['empid']);
		$data['loan_application'] = $this->emp_model->get_employee_loan_application($data['emp_data']['empid']);
		
		if($this->input->post()){
			$this->form_validation->set_rules('c_image', 'Image Code', 'required|xss_clean',array('required'=> 'Please write image code'));
			if ($this->form_validation->run() == FALSE){
               $data['error'] = validation_errors();
            }else{
				$cap_code = $this->session->userdata('cap_data');
				if($cap_code != $this->input->post('c_image')){
					$data['error'] = $this->lang->line('image_code_not_matched');
				}else{
					$reg_status = $this->emp_model->emp_loan_application($data['emp_data']['empid']);
					$this->session->set_flashdata('success','Your application successfully sent.');
					redirect('emp/loan_application');
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/loan_application',$data);
		$this->load->view('layout/footer');
	}

	public function bill_submit(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		$data['bill_tot'] = $this->emp_model->get_empployee_bill_count();
		
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		$data['profile'] = $this->emp_model->get_employee_details($empid);
		$data['employees'] = $this->emp_model->get_bo_dag_list();
//echo $this->db->last_query();
		$data['members'] = $this->emp_model->family_member_details_edu_allowance($empid);

		if($this->input->post()){
			$this->form_validation->set_rules('c_image', 'Image Code', 'required|xss_clean',array('required'=> 'Please write image code'));
			if ($this->form_validation->run() == FALSE){
               $data['error'] = validation_errors();
            }else{
				$cap_code = $this->session->userdata('cap_data');
				if($cap_code != $this->input->post('c_image')){
					$data['error'] = $this->lang->line('image_code_not_matched');
				}else{
					$bill_type = $this->input->post('bill_type');
					if($bill_type != 'Education Allowance Bill' || $bill_type != 'News Paper Bill' || $bill_type != 'LTC Bill' || $bill_type != 'HTC Bill'){
						$reg_status = $this->emp_model->emp_bill_submit($empid);
						$this->session->set_flashdata('success','Your application successfully sent.');
						redirect('emp/bill_details');
					} else{
						
						$data['bills'] = $this->emp_model->get_employee_bill_count($empid); 
						if($data['bills'] < 1 ){
							$reg_status = $this->emp_model->emp_bill_submit($empid);
							$this->session->set_flashdata('success','Your application successfully sent.');
							redirect('emp/bill_details');
						}else{
							$this->session->set_flashdata('error','REJECTED. ! Your have already submitted aplications.');
							redirect('emp/bill_details');
						}
					}
				}
			}
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/bill_submit',$data);
		$this->load->view('layout/footer');
	}
//----------------Messages 

//For autocomplete employee list with checkbox
	public function message_box(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');		
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['profile'] = $this->emp_model->get_employee_details($data['emp_data']['empid']);
		$data['emp_messages'] = $this->emp_model->get_employee_all_messages($data['emp_data']['empid']);
		$data['employees'] = $this->emp_model->get_authority_list();
		
		if($this->input->post()){
				$empid = $data['emp_data']['empid'];
				$ename = $data['emp_data']['empname'];
				$receiver_id = $this->input->post('receiver_id',true);
				$received_by = $this->input->post('received_by',true);
				$message = $this->input->post('message',true);
				$this->emp_model->emp_message_application($empid,$ename,$receiver_id,$received_by,$message);
				$this->session->set_flashdata('success','Successfully sent.');
				redirect('emp/message_box');
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/message_box',$data);
		$this->load->view('layout/footer');
	}
/*
	public function empList(){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$postData = $this->input->post();
		$this->load->model('emp_model');
		$data = $this->emp_model->postMessageBoxEmp($postData);
		$data['data'] = $data;
		echo json_encode($data);
	}
*/
	public function empList(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$postData = $this->input->get();
		$data = $this->emp_model->getMessageBoxEmp($postData);
		echo json_encode($data);
	}

/*
//For employee list with checkbox
	public function message_box(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
				
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['profile'] = $this->emp_model->get_employee_details($data['emp_data']['empid']);
		$data['emp_messages'] = $this->emp_model->get_employee_all_messages($data['emp_data']['empid']);
		$data['employees'] = $this->emp_model->get_authority_list();
		
		if($this->input->post()){
				$empid = $data['emp_data']['empid'];
				$ename = $data['emp_data']['empname'];
				$receiver_id = $this->input->post('receiver_id',true);
				$message = $this->input->post('message',true);
				$this->emp_model->emp_message_application($empid,$ename,$receiver_id,$message);
				$this->session->set_flashdata('success','Successfully sent.');
				redirect('emp/message_box');
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/message_box',$data);
		$this->load->view('layout/footer');
	}
*/
	public function message_read(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$id = $this->uri->segment(3);
		echo $id;
		if(!empty($id)){
			$this->emp_model->readMessageByID($id);
			$this->session->set_flashdata('success','Marked as read.');
		}
		redirect(SITE_BASE_URL.'emp/message_box');
	}
	
	public function message_delete(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$id = $this->uri->segment(3);
		if(!empty($id)){
			$this->emp_model->deleteMessageByID($id);
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(SITE_BASE_URL.'emp/message_box');
	}

	public function clock(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
//		$data['office_orders'] = $this->emp_model->get_employee_service_book($data['emp_data']['empid']);
		$this->load->view('layout/header');
		$this->load->view('pages/emp/clock',$data);
		$this->load->view('layout/footer');
	}
//--------------------TEST APPLICATION

	public function test_application(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');		
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['profile'] = $this->emp_model->get_employee_details($data['emp_data']['empid']);
		$data['employees'] = $this->emp_model->get_authority_list();
		
		if($this->input->post()){
				$reg_status = $this->emp_model->emp_test_application($data['emp_data']['empid']);
				$this->session->set_flashdata('success','Successfully sent.');
				redirect('emp/test_application');
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/test_application',$data);
		$this->load->view('layout/footer');
	}
//-------------------
	public function notice_board(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['language_id']=$this->language_id;
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		
		$data['mesg'] = $this->emp_model->get_message_count($data['emp_data']['empid']);
		$data['reco_pendings'] = $this->emp_model->get_leave_pending_recommendaton_count($data['emp_data']['empid']);
		$data['check_pendings'] = $this->emp_model->get_leave_pending_check_count($data['emp_data']['empid']);
		$data['sanc_pendings'] = $this->emp_model->get_leave_pending_sanction_count($data['emp_data']['empid']);
		$data['join_pendings'] = $this->emp_model->get_application_pending_joining_report_count($data['emp_data']['empid']);
		$data['clrh_pendings'] = $this->emp_model->get_leave_pending_clrh_count($data['emp_data']['empid']);
		$data['appli_pendings'] = $this->emp_model->get_application_pending_recommendaton_count($data['emp_data']['empid']);
		$data['non_dept_recds'] = $this->emp_model->get_application_nondept_recommendaton_count($data['emp_data']['empid']);
		$data['non_dept_procs'] = $this->emp_model->get_application_nondept_process_count($data['emp_data']['empid']);
		$data['pp_recds'] = $this->emp_model->get_application_passport_recommendaton_count($data['emp_data']['empid']);
		$data['pp_procs'] = $this->emp_model->get_application_passport_process_count($data['emp_data']['empid']);
		$data['release_pendings'] = $this->emp_model->get_release_pending_transfer_count($data['emp_data']['empid']);
		$data['join_trnasfer'] = $this->emp_model->get_joining_pending_transfer_count($data['emp_data']['empid']);
		$data['results'] = $this->emp_model->get_employee_loggedIn_count();
		$data['notices'] = $this->emp_model->get_employee_notice_board();
		$data['flashes'] = $this->emp_model->get_employee_notice_board_flash();
		$data['flash_word'] = $this->emp_model->get_employee_notice_board_flash_word();
	
		$this->load->view('layout/header');
		$this->load->view('pages/emp/notice_board',$data);
		$this->load->view('layout/footer');
	}
	
	public function service_book(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['office_orders'] = $this->emp_model->get_employee_service_book($data['emp_data']['empid']);
		$this->load->view('layout/header');
		$this->load->view('pages/emp/service_book',$data);
		$this->load->view('layout/footer');
	}
	public function training_video(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['office_orders'] = $this->emp_model->get_employee_service_book($data['emp_data']['empid']);
		$this->load->view('layout/header');
		$this->load->view('pages/emp/training_video',$data);
		$this->load->view('layout/footer');
	}
	public function apar_booklet(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['office_orders'] = $this->emp_model->get_employee_apar_booklet($data['emp_data']['empid']);
		$this->load->view('layout/header');
		$this->load->view('pages/emp/apar_booklet',$data);
		$this->load->view('layout/footer');
	}
	public function gpf_statement(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['office_orders'] = $this->emp_model->get_employee_gpf_statement($data['emp_data']['empid']);
		$this->load->view('layout/header');
		$this->load->view('pages/emp/gpf_statement',$data);
		$this->load->view('layout/footer');
	}
	public function emp_form_sixteen(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['office_orders'] = $this->emp_model->get_employee_form_sixteen($data['emp_data']['empid']);
		$this->load->view('layout/header');
		$this->load->view('pages/emp/emp_form_sixteen',$data);
		$this->load->view('layout/footer');
	}
	public function form_sixteen_redirect(){
		header('Location: ' . SITE_BASE_URL . 'form-16.php');
		exit;
	}

	public function circular(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_employee_circular($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'emp/circular';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;
		
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		$this->load->view('layout/header');
		$this->load->view('pages/emp/circular',$data);
		$this->load->view('layout/footer');
	}	
	public function gradation(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_gradation_list($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'emp/gradation';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;
		
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		$this->load->view('layout/header');
		$this->load->view('pages/emp/gradation',$data);
		$this->load->view('layout/footer');
	}
	public function employee_search(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
	
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_employee_search_result($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'emp/employee_search';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;
		
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		
		$this->load->view('layout/header');
		$this->load->view('pages/emp/employee_search',$data);
		$this->load->view('layout/footer');
	}
	public function employee_charge(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		
		if($this->input->get('search')){		
			$response = $this->emp_model->get_employee_charge_result($page_no);
			$data['results'] = $response['results'];
		}else{			
			$response = $this->emp_model->get_employee_charge_result($page_no);
			$data['results'] =[];		
		}
		$empid = $this->input->get('search');
		$data['emp_sections'] = $this->emp_model->get_transferred_to_sections($empid);
		
		$config['base_url'] = base_url().'emp/employee_charge';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;
		
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		
		$this->load->view('layout/header');
		$this->load->view('pages/emp/employee_charge',$data);
		$this->load->view('layout/footer');
	}
	public function employee_charge_sec(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['section_list'] = $this->emp_model->get_all_section_list();
		
		if($this->input->get('search')){
			$data['results'] = $this->emp_model->get_employee_charge_by_section($this->input->get('search'));		
		}
		
		$this->load->view('layout/header');
		$this->load->view('pages/emp/employee_charge_sec',$data);
		$this->load->view('layout/footer');
	}
	public function achievement(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
	
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_employee_notice_board_achievement($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'emp/achievement';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;
		
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		
		$this->load->view('layout/header');
		$this->load->view('pages/emp/achievement',$data);
		$this->load->view('layout/footer');
	}
	public function performance(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
	
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_employee_notice_board_digitization($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'emp/performance';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;
		
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		
		$this->load->view('layout/header');
		$this->load->view('pages/emp/performance',$data);
		$this->load->view('layout/footer');
	}	
	
	public function login_emp(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
	
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_employee_loggedIn_details($page_no);
//		$response = $this->emp_model->get_employee_loggedIn_count($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'emp/login_emp';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;
		
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		
		$this->load->view('layout/header');
		$this->load->view('pages/emp/login_emp',$data);
		$this->load->view('layout/footer');
	}		
	public function appointment(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
	
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_new_appointment_list($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'emp/appointment';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;
		
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		
		$this->load->view('layout/header');
		$this->load->view('pages/emp/appointment',$data);
		$this->load->view('layout/footer');
	}		
	public function promotion(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
	
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_new_promotion_list($page_no);

		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'emp/promotion';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;
		
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		
		$this->load->view('layout/header');
		$this->load->view('pages/emp/promotion',$data);
		$this->load->view('layout/footer');
	}	
	public function transfer(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
	
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_new_transferred_list($page_no);

		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'emp/transfer';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;
		
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		
		$this->load->view('layout/header');
		$this->load->view('pages/emp/transfer',$data);
		$this->load->view('layout/footer');
	}		
	public function birthday_list(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);

		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['empid'] = $data['emp_data']['empid'];
		$data['check_sms'] = $this->emp_model->check_BirthDaySMS();	
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_employee_birthday_list($page_no);
		$data['results'] = $response['results'];		
		$config['base_url'] = base_url().'emp/birthday_list';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;
		
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		
		$this->load->view('layout/header');
		$this->load->view('pages/emp/birthday_list',$data);
		$this->load->view('layout/footer');
	}
	public function BirthDaySMS(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		$sms_count = 0;
		if(!empty($data['emp_data']['empid'])){	
//		if($data['emp_data']['empid'] == 'ASPPG2056D' || $data['emp_data']['empid'] == 'CJAPM2653Q' || $data['emp_data']['empid'] == 'ASGPG7501A'){	
			$check_sms = $this->emp_model->check_BirthDaySMS();
			if(empty($check_sms)){
				$emp_sms = $this->emp_model->SendBirthDaySMS();
				foreach($emp_sms as $emp_bd){
					$emp_name = $emp_bd['empname'];
					$emp_mobile = trim($emp_bd['mbno']);
					send_BSMS($emp_name,$emp_mobile); // from helper											
					$sms_count = $sms_count +1;
				}		
				$post = array(
							'sms_no'	=> $sms_count,
//							'sender_id'	=> $empid,
							'sender_id'	=> 'AUMPB6168Q',
							'sent_dt'	=> date('Y-m-d H:i:s')
				);
				$this->emp_model->add_bsms_tracker($post);
//				$this->session->set_flashdata('success',$sms_count.' number(s) of Birthday SMSs are sent successfully.');
				redirect('emp/birthday_list');				
			}else{
//				$this->session->set_flashdata('error','Birthday SMSs have already been sent.');
				redirect('emp/notice_board');
			}
		}else{
//			$this->session->set_flashdata('error','You are not authorised to send Birthday SMSs.');
			redirect('emp/notice_board');
		}
		$this->load->view('layout/header');
		$this->load->view('pages/emp/birthday_list',$data);
		$this->load->view('layout/footer');
	}
	public function retirement_list(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
	
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_employee_retirement_list($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'emp/retirement_list';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;
		
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		
		$this->load->view('layout/header');
		$this->load->view('pages/emp/retirement_list',$data);
		$this->load->view('layout/footer');
	}			
		
	public function epabx(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_epabx_extension($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'emp/epabx';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;
		
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		$this->load->view('layout/header');
		$this->load->view('pages/emp/epabx',$data);
		$this->load->view('layout/footer');
	}		
	public function kms_document(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_kms_document($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'emp/kms_document';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;
		
		$this->pagination->initialize($config);
		
		$this->load->view('layout/header');
		$this->load->view('pages/emp/kms_document',$data);
		$this->load->view('layout/footer');
	}	
	public function administrative_order(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_administrative_order($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'emp/administrative_order';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;
		
		$this->pagination->initialize($config);
		
		$this->load->view('layout/header');
		$this->load->view('pages/emp/administrative_order',$data);
		$this->load->view('layout/footer');
	}	
	
	public function training_material(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_training_material($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'emp/training_material';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;
		
		$this->pagination->initialize($config);
		
		$this->load->view('layout/header');
		$this->load->view('pages/emp/training_material',$data);
		$this->load->view('layout/footer');
	}	
	public function leave_clrh(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		$empid = $data['emp_data']['empid'];
		
		$leave_dr_year = $this->input->get('year',true);
		$leave_cr_year = $this->input->get('year',true);		
		if($this->input->get('leave_type')){		
			$leave_type = $this->input->get('leave_type',true);			
			$data['leave_debits'] = $this->emp_model->get_employee_clrh_debit($empid,$leave_type,$leave_dr_year);
			$data['leave_balance'] = $this->emp_model->get_employee_leave_balance($empid,$leave_type);
			$data['leave_credit'] = $this->emp_model->get_employee_clrh_credit($empid,$leave_type,$leave_cr_year);
		}else{			
//			$data['subs_details'] =[];		
		}	
	
		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_clrh',$data);
		$this->load->view('layout/footer');
	}
	
	public function leave_debit(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		$empid = $data['emp_data']['empid'];
		if($this->input->get('leave_type')){		
			$leave_type = $this->input->get('leave_type',true);	
			$data['leave_debits'] = $this->emp_model->get_employee_leave_debit($empid,$leave_type);
			$data['upload_balance'] = $this->emp_model->get_employee_leave_balance($empid,$leave_type);
			$data['current_balance'] = $this->emp_model->get_leave_current_balance($empid,$leave_type);
			$data['leave_credit'] = $this->emp_model->get_employee_leave_credit($empid,$leave_type);
		}else{			
//			$data['subs_details'] =[];		
		}	
	
		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_debit',$data);
		$this->load->view('layout/footer');
	}

	public function leave_credit_clrh(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		$empid = $data['emp_data']['empid'];
		if($this->input->get('leave_type')){		
			$leave_type = $this->input->get('leave_type',true);			
			$data['office_orders'] = $this->emp_model->get_employee_leave_credit($empid,$leave_type);
		}else{			
			$data['subs_details'] =[];		
		}	

		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_credit_clrh',$data);
		$this->load->view('layout/footer');
	}
	
	public function leave_credit_others(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		$empid = $data['emp_data']['empid'];
		if($this->input->get('leave_type')){		
			$leave_type = $this->input->get('leave_type',true);			
			$data['office_orders'] = $this->emp_model->get_employee_leave_credit($empid,$leave_type);
		}else{			
			$data['subs_details'] =[];		
		}	

		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_credit_others',$data);
		$this->load->view('layout/footer');
	}
	public function leave_balances(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		if($this->input->get('leave_type')){		
			$leave_type = $this->input->get('leave_type',true);	
			$data['all_balances'] = $this->emp_model->get_employee_leave_balance($empid, $leave_type);
		}else{			
//			$data['subs_details'] =[];		
		}	
		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_balances',$data);
		$this->load->view('layout/footer');
	}
	public function leave_encashment(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		$empid = $data['emp_data']['empid'];
		$status = $this->input->get('year',true);
/*		
		if($this->input->get('year')){		
			$leave_type = $this->input->get('year',true);			
			$data['office_orders'] = $this->emp_model->get_employee_leave_encashment($empid);
		}else{			
			$data['subs_details'] =[];		
		}
*/		
		$data['office_orders'] = $this->emp_model->get_employee_leave_encashment($empid,$status);
		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_encashment',$data);
		$this->load->view('layout/footer');
	}
	public function leave_report_emp(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		

		if($this->input->get('emp_id')){		
			$emp_id = $this->input->get('emp_id',true);
			$leave_type = $this->input->get('leave_type',true);	
			$year = $this->input->get('year',true);		
				$data['leave_credit'] = $this->emp_model->get_employee_clrh_credit($emp_id,$leave_type,$year);
				$data['leave_debits'] = $this->emp_model->get_employee_clrh_rept($emp_id,$leave_type,$year);
//				$this->load->view('pages/emp/leave_report_emp',$data);
			}	
		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_report_emp',$data);
		$this->load->view('layout/footer');
	}
	public function leave_report(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		$empid = $data['emp_data']['empid'];
		$desig = $data['emp_data']['desig'];
		$data['section_list'] = $this->emp_model->get_all_section_list();
		
		if(($data['emp_data']['desig'] == 'SR. ACCOUNTS OFFICER'|| $data['emp_data']['desig']=='SR. ACCOUNTS OFFICER (Adhoc)' ||$data['emp_data']['desig'] == 'ASSTT. ACCOUNTS OFFICER' || $data['emp_data']['desig'] == 'SUPERVISOR' || $data['emp_data']['desig'] == 'WELFARE ASSISTANT' || $data['emp_data']['desig']=='HINDI OFFICER') && $data['emp_data']['section'] == $this->input->get('section') ){
			if($this->input->get('section')){		
			$section = $this->input->get('section',true);
			$leave_type = $this->input->get('leave_type',true);	
			$year = $this->input->get('year',true);			
				$data['section_employee'] = $this->emp_model->get_sectional_employee($section);
				$data['leave_debits'] = $this->emp_model->get_employee_sectional_clrh($section,$leave_type,$year);
//				echo $this->db->last_query();
//				data['section'] = $section;
//				exit;
				$this->load->view('pages/emp/leave_report_print',$data);
			}else{
			$this->load->view('layout/header');
			$this->load->view('pages/emp/leave_report',$data);
			$this->load->view('layout/footer');
			}	
		}else{
			$this->load->view('layout/header');
			$this->load->view('pages/emp/leave_report',$data);
			$this->load->view('layout/footer');
			$this->session->set_flashdata('error','View is for Sectional In-chanrge only.');
		}
	}
	public function bill_details(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		if($this->input->get('records')){		
			$bill_type = $this->input->get('records',true);			
			$data['office_orders'] = $this->emp_model->get_employee_bill_detail($empid,$bill_type);
		}else{			
//			$data['subs_details'] =[];		
		}		
		$this->load->view('layout/header');
		$this->load->view('pages/emp/bill_details',$data);
		$this->load->view('layout/footer');
	}
	public function treasury_insp_details(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		$empid = $data['emp_data']['empid'];
		if($this->input->get('try_insp_year')){		
			$try_insp_year = $this->input->get('try_insp_year',true);
//echo ($try_insp_year);		
//exit;	
			$data['office_orders'] = $this->emp_model->get_employee_inspection_detail($empid,$try_insp_year);
		}else{			
//			$data['subs_details'] =[];		
		}		
		$this->load->view('layout/header');
		$this->load->view('pages/emp/treasury_insp_details',$data);
		$this->load->view('layout/footer');
	}
	
	public function treasury_inspection_order_print(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('m_pdf');	
		$this->load->model('accounts_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
			
		$id = $this->uri->segment(3);
//echo ($id);	
		if(!empty($id)){
			$data['row'] = $this->accounts_model->get_inspection_order_print($id);
//print_r ($this->db->last_query());
			if(empty($data['row'])){
				show_404('admin');
			}
		}
//print_r($data['row']);		
		$data['candidates'] = $this->accounts_model->get_emp_inspectors_list($id);
		
		
		$html = $this->load->view('pages/emp/treasury_inspection_order_print',$data,true);
		
		$img=FCPATH . "assets/images/top-head.png";
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
	
	public function training_details(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		$empid = $data['emp_data']['empid'];
		if($this->input->get('records')){		
			$training_type = $this->input->get('records',true);			
			$data['office_orders'] = $this->emp_model->get_employee_training_detail($empid,$training_type);
		}else{			
//			$data['subs_details'] =[];		
		}		
		$this->load->view('layout/header');
		$this->load->view('pages/emp/training_details',$data);
		$this->load->view('layout/footer');
	}
	public function faculty_details(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		$empid = $data['emp_data']['empid'];
		if($this->input->get('records')){		
			$training_type = $this->input->get('records',true);			
			$data['office_orders'] = $this->emp_model->get_employee_training_faculty_detail($empid,$training_type);
		}else{			
//			$data['subs_details'] =[];		
		}		
		$this->load->view('layout/header');
		$this->load->view('pages/emp/faculty_details',$data);
		$this->load->view('layout/footer');
	}
	public function training_details_all(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_employee_training_detail_all($page_no, $empid);
		$data['results'] = $response['results'];

		$config['base_url'] = base_url().'emp/training_details_all';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;

		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		$this->load->view('layout/header');
		$this->load->view('pages/emp/training_details_all',$data);
		$this->load->view('layout/footer');
	}	
   
    public function transfer_order(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_employee_transfer_order($page_no, $empid);
		$data['results'] = $response['results'];
//echo $this->db->last_query();
//print_r($data);
//exit;
		$config['base_url'] = base_url().'emp/transfer_order';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;

		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		$this->load->view('layout/header');
		$this->load->view('pages/emp/transfer_order',$data);
		$this->load->view('layout/footer');
	}
	
	public function loan_details(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		$empid = $data['emp_data']['empid'];
		if($this->input->get('records')){		
			$leave_type = $this->input->get('records',true);			
			$data['office_orders'] = $this->emp_model->get_employee_loan_detail($empid,$leave_type);
		}else{			
//			$data['subs_details'] =[];		
		}		
		$this->load->view('layout/header');
		$this->load->view('pages/emp/loan_details',$data);
		$this->load->view('layout/footer');
	}	
	
	
	public function request(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		
		
		$this->load->view('layout/header');
		$this->load->view('pages/emp/request',$data);
		$this->load->view('layout/footer');
	}
	
	public function logout(){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$arr_feed['empid'] 	= $this->session->userdata('emp_data')['empid'];
		$arr_feed['name'] 	= $this->session->userdata('emp_data')['empname'];
		$arr_feed['mobile'] = $this->session->userdata('emp_data')['mbno'];
		$arr_feed['email']  = trim($this->session->userdata('emp_data')['nicmail']) == '' ? $this->session->userdata('emp_data')['email'] : $this->session->userdata('emp_data')['nicmail'];
		$this->session->set_userdata('user_details_for_feedback',$arr_feed);
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}else{
			$this->session->unset_userdata('emp_data');
			$this->session->set_flashdata('success',$this->lang->line('give_your_feedback'));
			redirect('feedback');
		}
		$this->session->set_flashdata('success',$this->lang->line('give_your_feedback'));
		redirect('feedback');
		$this->load->view('layout/header');
		$this->load->view('pages/emp/login',$data);
		$this->load->view('layout/footer');
	}

	
//	-----For training order PDF dwonload

	public function training_order_download() { 
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('m_pdf');
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
			
		$id = $this->uri->segment(3);
	
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->get_training_order_print($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$data['candidates'] = $this->emp_model->get_trainees_list($id);
		
		$html = $this->load->view('pages/emp/training_order_download',$data,true);//load the pdf_output.php by passing our data and get all data in $html varriable.
		
		$img=FCPATH . "assets/images/top-head.png";
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

//	-----For training order html view	
	public function training_order_print(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
			
		$id = $this->uri->segment(3);
		
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->get_training_order_print($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$data['candidates'] = $this->emp_model->get_trainees_list($id);
		$this->load->view('pages/emp/training_order_print',$data);
	}
	
	public function training_feedback(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['error'] = '';
		$id = $this->uri->segment(3);
		$data['profile'] = $this->emp_model->get_employee_details($data['emp_data']['empid']);
		$data['details'] = $this->emp_model->training_detail_feedback($id,$data['emp_data']['empid']);
		if(empty($data['details'])){
				show_404('admin');
		}
//		echo $id;
//		echo $this->db->last_query();
//		print_r($data['details']);
//		exit;
		
		if($this->input->post()){
			$this->form_validation->set_rules('c_image', 'Image Code', 'required|xss_clean',array('required'=> 'Please write image code'));
			$this->form_validation->set_rules('agree', '', 'required|xss_clean',array('required'=> 'You have to agree the acceptance of the application'));
			if ($this->form_validation->run() == FALSE){
               $data['error'] = validation_errors();
            }else{
				$cap_code = $this->session->userdata('cap_data');
				if($cap_code != $this->input->post('c_image')){
					$data['error'] = $this->lang->line('image_code_not_matched');
				}else{
					$this->emp_model->add_employee_training_feedback($id);
					$this->emp_model->emp_training_feedback_status_update($id,$data['emp_data']['empid']);
					$this->session->set_flashdata('success','Your feedback successfully submitted.');
					redirect('emp/training_details');
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/training_feedback',$data);
		$this->load->view('layout/footer');
	}
	public function faculty_order_download() { 
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('m_pdf');
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
			
		$id = $this->uri->segment(3);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->get_faculty_order_print($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$data['candidates'] = $this->emp_model->get_faculties_list($id);
		$html = $this->load->view('pages/emp/faculty_order_download',$data,true);//load the pdf_output.php by passing our data and get all data in $html varriable.
		
		$img=FCPATH . "assets/images/top-head.png";
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
	
	public function faculty_order_print(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
			
		$id = $this->uri->segment(3);
		
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->get_faculty_order_print($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$data['candidates'] = $this->emp_model->get_faculties_list($id);
		$this->load->view('pages/emp/faculty_order_print',$data);
	}
	public function incometax(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		$data['profile'] = $this->emp_model->get_employee_details($data['emp_data']['empid']);
		
		
		$data['incometax_info'] = $this->emp_model->get_incometax_info($data['emp_data']['empid']);
		
		if($this->input->post()){
			$this->form_validation->set_rules('c_image', 'Image Code', 'required|xss_clean',array('required'=> 'Please write image code'));
			if ($this->form_validation->run() == FALSE){
               $data['error'] = validation_errors();
            }else{
				$cap_code = $this->session->userdata('cap_data');
				if($cap_code != $this->input->post('c_image')){
					$data['error'] = $this->lang->line('image_code_not_matched');
				}else{
					$reg_status = $this->emp_model->emp_incometax_information($data['emp_data']['empid']);
					$this->session->set_flashdata('success','Information submitted successfully.');
					redirect('emp/incometax');
				}
			}
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/incometax',$data);
		$this->load->view('layout/footer');
	}	

	public function feedback_status(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['feedbacks'] = $this->emp_model->get_employee_feedback($data['emp_data']['empid']);
		
		$this->load->view('layout/header');
		$this->load->view('pages/emp/feedback_status',$data);
		$this->load->view('layout/footer');
	}
	public function feedback_filt(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->all_feedback_view($page_no, $empid);

		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'emp/feedback_filt';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;

		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		$this->load->view('layout/header');
		$this->load->view('pages/emp/feedback_filt',$data);
		$this->load->view('layout/footer');
	}	
	public function feedback_filter(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$id = $this->uri->segment(3);
		if(!empty($id)){
			$this->emp_model->FeedbackFilterByID($id);
			$this->session->set_flashdata('success','The Grievance / feedback is initiated for processing.');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		redirect(SITE_BASE_URL.'emp/feedback_filt');	
	}
	public function feedback_all(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->all_feedback_monitor($page_no, $empid);

		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'emp/feedback_all';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;

		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		$this->load->view('layout/header');
		$this->load->view('pages/emp/feedback_all',$data);
		$this->load->view('layout/footer');
	}	
	public function grievance_all(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->all_grievance_monitor($page_no, $empid);

		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'emp/grievance_all';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;

		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		$this->load->view('layout/header');
		$this->load->view('pages/emp/grievance_all',$data);
		$this->load->view('layout/footer');
	}	
	public function feedback_update(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->model('common_model');
		$this->load->library('pagination');
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['profile'] = $this->emp_model->get_employee_details($data['emp_data']['empid']);
		$data['error'] = '';
		$id = $this->uri->segment(3);
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
			$this->form_validation->set_rules('status', 'Status', 'required|xss_clean');
			$this->form_validation->set_rules('status', 'status', 'required|xss_clean',array('required'=> 'Select Feedback Status'));
			if ($this->form_validation->run() == FALSE){
               $data['error'] = validation_errors();
            }else{
				$cap_code = $this->session->userdata('cap_data');
				if($cap_code != $this->input->post('c_image')){
					$data['error'] = $this->lang->line('image_code_not_matched');
				}else{
					$this->emp_model->update_dag_feedback_action($id);
					$this->session->set_flashdata('success','Successfully updated.');
					redirect(SITE_BASE_URL.'emp/feedback_all');
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/feedback_update',$data);
		$this->load->view('layout/footer');
	}
	public function feedback_filt_close(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$id = $this->uri->segment(3);
		if(!empty($id)){
			$this->emp_model->FeedbackClosedByID($id);
			$this->session->set_flashdata('success','The Grievance / feedback is closed successfully.');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		redirect(SITE_BASE_URL.'emp/feedback_filt');	
	}
	public function feedback_close(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$id = $this->uri->segment(3);
		if(!empty($id)){
			$this->emp_model->FeedbackClosedByID($id);
			$this->session->set_flashdata('success','The Grievance / feedback is closed successfully.');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		redirect(SITE_BASE_URL.'emp/feedback_all');	
	}
	public function grievance_close(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$id = $this->uri->segment(3);
		if(!empty($id)){
			$this->emp_model->FeedbackClosedByID($id);
			$this->session->set_flashdata('success','The Grievance / feedback is closed successfully.');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		redirect(SITE_BASE_URL.'emp/grievance_all');	
	}
	public function property_statement(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		$empid = $data['emp_data']['empid'];
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_employee_property_decla_all($page_no, $empid);
		$data['results'] = $response['results'];

		$config['base_url'] = base_url().'emp/training_details_all';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;

		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;	
		$this->load->view('layout/header');
		$this->load->view('pages/emp/property_statement',$data);
		$this->load->view('layout/footer');
	}
	
	public function property_st_self(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$emp_id = $data['emp_data']['empid'];
		$data['error'] = '';
		$data['profile'] = $this->emp_model->get_employee_details($data['emp_data']['empid']);
		
		$pst_year = $this->input->post('pst_year');
		$pst_as_on = $this->input->post('pst_as_on');
		$decl_for = $this->input->post('decl_for');
		
		$data['statement'] = $this->emp_model->get_employee_pty_statement_submitted($emp_id,$pst_year,$pst_as_on,$decl_for);

		if($this->input->post()){
			$this->form_validation->set_rules('c_image', 'Image Code', 'required|xss_clean',array('required'=> 'Please write image code'));
			$this->form_validation->set_rules('agree', '', 'required|xss_clean',array('required'=> 'You have to agree .'));
			if ($this->form_validation->run() == FALSE){
               $data['error'] = validation_errors();
            }else{
				$cap_code = $this->session->userdata('cap_data');
				if($cap_code != $this->input->post('c_image')){
					$data['error'] = $this->lang->line('image_code_not_matched');
				}else{
					if(empty($data['statement'])){
						$this->emp_model->add_employee_property_statement();
						$this->session->set_flashdata('success','Your Asset Declaration successfully submitted.');
						redirect('emp/property_statement');
					}else{
						$this->session->set_flashdata('error','NOT SUBMITTED. ! Your have already submitted Property Statement (Self) for the year.');
						redirect('emp/application_exam_info');
					}
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/property_st_self',$data);
		$this->load->view('layout/footer');
	}
	
	public function property_st_dependent(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$emp_id = $data['emp_data']['empid'];
		$data['error'] = '';
		$data['profile'] = $this->emp_model->get_employee_details($data['emp_data']['empid']);
		
		$pst_year = $this->input->post('pst_year');
		$pst_as_on = $this->input->post('pst_as_on');
		$decl_for = $this->input->post('decl_for');
		
		$data['statement'] = $this->emp_model->get_employee_pty_statement_submitted($emp_id,$pst_year,$pst_as_on,$decl_for);

		if($this->input->post()){
			$this->form_validation->set_rules('c_image', 'Image Code', 'required|xss_clean',array('required'=> 'Please write image code'));
			$this->form_validation->set_rules('agree', '', 'required|xss_clean',array('required'=> 'You have to agree the acceptance of the application'));
			if ($this->form_validation->run() == FALSE){
               $data['error'] = validation_errors();
            }else{
				$cap_code = $this->session->userdata('cap_data');
				if($cap_code != $this->input->post('c_image')){
					$data['error'] = $this->lang->line('image_code_not_matched');
				}else{
					if(empty($data['statement'])){
						$this->emp_model->add_employee_property_statement();
						$this->session->set_flashdata('success','Your Asset Declaration successfully submitted.');
						redirect('emp/property_statement');
					}else{
						$this->session->set_flashdata('error','NOT SUBMITTED. ! Your have already submitted Property Statement (Dependent) for the year.');
						redirect('emp/application_exam_info');
					}
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/property_st_dependent',$data);
		$this->load->view('layout/footer');
	}
	public function asset_declarations_pdf() { 
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('m_pdf');
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$empid = $data['emp_data']['empid'];
		
		$id = $this->uri->segment(3);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->get_property_st_print($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		
		$pst_year= $data['row']['pst_year'];
		$decl_for= $data['row']['decl_for'];
		
		if($decl_for == 'Self'){
			$html = $this->load->view('pages/emp/property_self_pdf',$data,true);//load the pdf_output.php by passing our data and get all data in $html varriable.
			$pdfFilePath ="Asset_Declaration_Self_".$empid."_".$pst_year.".pdf";
		}else{
			$html = $this->load->view('pages/emp/property_dependent_pdf',$data,true);//load the pdf_output.php by passing our data and get all data in $html varriable.
			$pdfFilePath ="Asset_Declaration_Dependents_".$empid."_".$pst_year.".pdf";
		}

		$pdf = $this->m_pdf->pdfgenerate();
		$pdf->SetWatermarkText('O/o the Pr. Accountant General (A&E), WB');
		$pdf->watermark_font = 'DejaVuSansCondensed';
		$pdf->watermarkTextAlpha = 0.1;
		$pdf->showWatermarkText = true;
		$pdf->WriteHTML($html);
		$pdf->Output($pdfFilePath, "D");
//		$pdf->Output();
    }
	
	public function treasury_ir(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;		
		$response = $this->emp_model->get_treasury_office_inspection_report($page_no);	
		$data['results'] = $response['results'];

		$config['base_url'] = base_url().'emp/treasury_ir';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;	
		$this->pagination->initialize($config);
		
		$data['language_id']=$this->language_id;
		$this->load->view('layout/header');
		$this->load->view('pages/emp/treasury_ir',$data);
		$this->load->view('layout/footer');
	}
	public function apar_calculator(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];

		$this->load->view('layout/header');
		$this->load->view('pages/emp/apar_calculator',$data);
		$this->load->view('layout/footer');
	}
	public function apar_calculator_deo(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];

		$this->load->view('layout/header');
		$this->load->view('pages/emp/apar_calculator_deo',$data);
		$this->load->view('layout/footer');
	}
	public function retirement_pension(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['profile'] = $this->emp_model->get_employee_details($data['emp_data']['empid']);
		$this->load->view('layout/header');
		$this->load->view('pages/emp/retirement_pension',$data);
		$this->load->view('layout/footer');
	}
	public function retirement_gratuity(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['profile'] = $this->emp_model->get_employee_details($data['emp_data']['empid']);
		$this->load->view('layout/header');
		$this->load->view('pages/emp/retirement_gratuity',$data);
		$this->load->view('layout/footer');
	}
	public function retirement_commutation(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['empid'] = $data['emp_data']['empid'];
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['profile'] = $this->emp_model->get_employee_details($data['emp_data']['empid']);
			
		$date1 =date('Y-m-d', strtotime($data['profile']['dor']));
		$date2 = date('Y-m-d', strtotime($data['profile']['dob']));
		$diff =date_diff(new DateTime($date2),new DateTime($date1)); 
		$age = round(intval($diff->format("%a days"))/365)+1;

//		$data['profile']['age']= $age;
		if($this->input->post()){
			$age = $this->input->post('age');
			$data['comm'] = $this->emp_model->get_commutation_factor($age);
			$data['profile']['age']= $this->input->post('age');
		}else{
			$data['profile']['age']= $age;
			$data['comm'] = $this->emp_model->get_commutation_factor($age);	
		}
		$this->load->view('layout/header');
		$this->load->view('pages/emp/retirement_commutation',$data);
		$this->load->view('layout/footer');
	}
	public function encashment_leave(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['profile'] = $this->emp_model->get_employee_details($data['emp_data']['empid']);
		$this->load->view('layout/header');
		$this->load->view('pages/emp/encashment_leave',$data);
		$this->load->view('layout/footer');
	}	
	public function transfer_release(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		$empid = $data['emp_data']['empid'];
		$data['office_orders'] = $this->emp_model->get_transfer_release_records($empid);
		$this->load->view('layout/header');
		$this->load->view('pages/emp/transfer_release',$data);
		$this->load->view('layout/footer');
	} 
	
	public function transfer_release_update(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		$id = $this->uri->segment(3);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->fetch_employee_transfer_release_record($id,$empid);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		else{
			show_404('admin');
		}		
		
		if($this->input->post()){
//echo $empid;
//echo $this->db->last_query();	
//print_r ($data['trans_allot']);
//exit;
//echo (date('Y-m-d',strtotime($this->input->post('order_dt'))));
				$update = array(
						'charge_to_dt'	=> date('Y-m-d',strtotime($this->input->post('trans_release_dt'))),
						'status'			=> 'Close',
						'update_dt'			=> date('Y-m-d H:i:s')
				);	
			
			$this->emp_model->emp_transfer_release_update($id);
			$this->emp_model->get_allotment_details_release_update($empid,$update);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(SITE_BASE_URL.'emp/transfer_release');
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/transfer_release_update',$data);
		$this->load->view('layout/footer');
	}
	
	public function transfer_joining(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		$empid = $data['emp_data']['empid'];
		$data['office_orders'] = $this->emp_model->get_transfer_joining_records($empid);
		$this->load->view('layout/header');
		$this->load->view('pages/emp/transfer_joining',$data);
		$this->load->view('layout/footer');
	}
	public function transfer_joining_update(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		$id = $this->uri->segment(3);	
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->fetch_employee_transfer_join_record($id,$empid);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		else{
			show_404('admin');
		}	
		$data['sections_list'] = $this->emp_model->get_transferred_to_sections($data['row']['emp_id']);
		
		if($this->input->post()){
			$empid = $this->input->post('emp_id');
			$data['allot'] = $this->emp_model->get_last_transfer_allotment_id($empid);
			$allot_id = $data['allot']['max_id'];
			$data['trans_allot'] = $this->emp_model->get_last_transfer_allotment_details($allot_id);
			$sect_idx = explode('@@@',$this->input->post('sect_idx'));
			if(count($sect_idx) == 2){
				$update['sect_idx'] = isset($sect_idx[0]) ? $sect_idx[0] : '';
				$update['section'] = isset($sect_idx[1]) ? $sect_idx[1] : '';
			}
			$update = array(
							'section_inch_pan'	=> $data['trans_allot']['empid_sec'],
							'group_name'		=>$data['trans_allot']['present_group'],
							'sect_idx'			=>$update['sect_idx'],
							'section'			=>$update['section'],
							'branch_inch_pan'	=>$data['trans_allot']['empid_bo'],
							'branch_indx'		=>$data['trans_allot']['branch_indx'],
							'branch_desc'		=>$data['trans_allot']['branch_desc'],
							'staff_type'		=>$data['trans_allot']['staff_type'],
							'trans_from'		=>$this->input->post('trans_from'),
							'trans_order_dt'	=> date('Y-m-d',strtotime($this->input->post('trans_order_dt'))),
//							'update_dt'			=> date('Y-m-d H:i:s')
						);	
			$update_allot = array(
							'charge_from_dt'	=> date('Y-m-d',strtotime($this->input->post('trans_join_dt'))),
							'status'			=> 'Active',
							'update_dt'			=> date('Y-m-d H:i:s')
						);	
			$this->emp_model->emp_transfer_join_update($id);
//			$this->emp_model->get_emp_master_section_update($empid,$update);		//***Un comment to get employee_master update on joining
			$this->emp_model->get_allotment_details_joining_update($allot_id,$update_allot);
			$this->emp_model->get_section_allotment_to_emp_update($empid,$update['sect_idx']);		
			$this->session->set_flashdata('success','Successfully updated.');
//			redirect(SITE_BASE_URL.'emp/transfer_joining');
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/transfer_joining_update',$data);
		$this->load->view('layout/footer');
	}
	public function transfer_charge_allot(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);

		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		$id = $this->uri->segment(3);	
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->fetch_employee_transfer_join_record($id,$empid);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
		$emp_id = $data['row']['emp_id'];
		$data['row_indx'] = $this->emp_model->get_emp_section_index($emp_id);
		$sect_idx = $data['row_indx']['sect_idx'];
		$data['section_charges'] = $this->emp_model->get_section_charge_list($sect_idx);

		if($this->input->post()){
			$chrg_id =  $this->input->post('chrg_id');

			if(!empty($emp_id)){ // delete and insert
				$this->emp_model->update_charge_details_to_employee($emp_id,$chrg_id);
				$this->emp_model->update_charge_allotment_status($id,$emp_id);
				$this->session->set_flashdata('success','Successfully updated.');
			}
			redirect(SITE_BASE_URL.'emp/transfer_joining');
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/transfer_charge_allot',$data);
		$this->load->view('layout/footer');
	}
	public function hierarchy(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['profile'] = $this->emp_model->get_employee_details($data['emp_data']['empid']);
		$data['branch'] = $this->emp_model->get_branch_allotment_record($data['emp_data']['branch_indx']);
		$bo_empid = $data['branch']['empid_bo'];
		$data['bofficer'] = $this->emp_model->employee_heirarchy_details($bo_empid);
		$this->load->view('layout/header');
		$this->load->view('pages/emp/hierarchy',$data);
		$this->load->view('layout/footer');
	}	
	public function hierarchy_bo(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['office_orders'] = $this->emp_model->get_all_branch_allotment_to_bo($data['emp_data']['empid']);
		$this->load->view('layout/header');
		$this->load->view('pages/emp/hierarchy_bo',$data);
		$this->load->view('layout/footer');
	}

	public function hierarchy_bo_staffs(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$branch_indx = $this->uri->segment(3);
		$data['profile'] = $this->emp_model->get_employee_details($data['emp_data']['empid']);
		$data['staff'] = $this->emp_model->employee_bo_staff_details($branch_indx);
		$this->load->view('layout/header');
		$this->load->view('pages/emp/hierarchy_bo_staffs',$data);
		$this->load->view('layout/footer');
	}
	public function hierarchy_bo_incharges(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$branch_indx = $this->uri->segment(3);
		$data['profile'] = $this->emp_model->get_employee_details($data['emp_data']['empid']);
		$data['incharge'] = $this->emp_model->employee_bo_incharges_details($branch_indx);
		$this->load->view('layout/header');
		$this->load->view('pages/emp/hierarchy_bo_incharges',$data);
		$this->load->view('layout/footer');
	}
	public function hierarchy_bo_sections(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$bo_index = $this->uri->segment(3);	
		$data['ocharge'] = $this->emp_model->get_bos_all_sections($bo_index);
		$data['lcharge'] = $this->emp_model->get_branch_officer_link_section($bo_index);
		$this->load->view('layout/header');
		$this->load->view('pages/emp/hierarchy_bo_sections',$data);
		$this->load->view('layout/footer');
	}
	public function hierarchy_incharge(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['profile'] = $this->emp_model->get_employee_details($data['emp_data']['empid']);
		$data['section_inch'] = $this->emp_model->get_section_allotment_record($data['emp_data']['sect_idx']);
		$section_desc = $data['section_inch']['section_desc'];
			if(!empty($section_desc)){ 
				$data['incharge'] = $this->emp_model->employee_sec_incharge_detail($section_desc);
			}else{
				$data['incharge'] = $this->emp_model->employee_sec_incharge_details($data['emp_data']['sect_idx']);
			}
		$this->load->view('layout/header');
		$this->load->view('pages/emp/hierarchy_incharge',$data);
		$this->load->view('layout/footer');
	}
	
	public function hierarchy_section(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['profile'] = $this->emp_model->get_employee_details($data['emp_data']['empid']);
		$data['staff'] = $this->emp_model->employee_sec_staff_details($data['emp_data']['sect_idx']);
		$this->load->view('layout/header');
		$this->load->view('pages/emp/hierarchy_section',$data);
		$this->load->view('layout/footer');
	}
	public function hierarchy_search(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['section_list'] = $this->emp_model->get_all_section_list();
		if($this->input->get('section')){
			$staff_type = $this->input->get('staff_type',true);
			$section = $this->input->get('section',true);
			$data['results'] = $this->emp_model->employee_sec_incharge_bo_search($staff_type,$section);
			if(empty($data['results']) && $staff_type == 'BO'){ 
				$empid_bo = $this->emp_model->get_bo_index_by_sec_index($section);
				$data['results'] = $this->emp_model->employee_bo_staff_details_by_sec_index($empid_bo);	
			}
		}
		$this->load->view('layout/header');
		$this->load->view('pages/emp/hierarchy_search',$data);
		$this->load->view('layout/footer');
	}
	public function hierarchy_search_all(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['section_list'] = $this->emp_model->get_all_section_list();
		if($this->input->get('section')){
			$staff_type = $this->input->get('staff_type',true);
			$section = $this->input->get('section',true);
			$data['results'] = $this->emp_model->employee_sec_incharge_bo_search($staff_type,$section);
			if(empty($data['results']) && $staff_type == 'BO'){ 
				$empid_bo = $this->emp_model->get_bo_index_by_sec_index($section);				
				$data['results'] = $this->emp_model->employee_bo_staff_details_by_sec_index($empid_bo);			
			}
		}
		$this->load->view('layout/header');
		$this->load->view('pages/emp/hierarchy_search_all',$data);
		$this->load->view('layout/footer');
	}
	public function hierarchy_search_emp(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['section_list'] = $this->emp_model->get_all_section_list();
		if($this->input->get('section')){
			$staff_type = $this->input->get('staff_type',true);
			$section = $this->input->get('section',true);
			$data['results'] = $this->emp_model->employee_sec_incharge_bo_search($staff_type,$section);
			if(empty($data['results']) && $staff_type == 'BO'){ 
				$empid_bo = $this->emp_model->get_bo_index_by_sec_index($section);
				$data['results'] = $this->emp_model->employee_bo_staff_details_by_sec_index($empid_bo);	
			}
		}
		$this->load->view('layout/header');
		$this->load->view('pages/emp/hierarchy_search_emp',$data);
		$this->load->view('layout/footer');
	}
	public function transfer_order_download() { 
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('m_pdf');
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
			
		$id = $this->uri->segment(3);
		
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->get_transfer_order_print($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$data['candidates'] = $this->emp_model->get_transferred_employee_list($id);
		$html = $this->load->view('pages/emp/transfer_order_download',$data,true);//load the pdf_output.php by passing our data and get all data in $html varriable.
		$img=FCPATH . "assets/images/top-head.png";
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
//		$pdf->Output($pdfFilePath, "D");
		$pdf->Output();
    }
	public function pending_works(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		
		$data['reco_pendings'] = $this->emp_model->get_leave_pending_recommendaton_count($data['emp_data']['empid']);
		$data['check_pendings'] = $this->emp_model->get_leave_pending_check_count($data['emp_data']['empid']);
		$data['sanc_pendings'] = $this->emp_model->get_leave_pending_sanction_count($data['emp_data']['empid']);
		$data['join_pendings'] = $this->emp_model->get_application_pending_joining_report_count($data['emp_data']['empid']);
		$data['clrh_pendings'] = $this->emp_model->get_leave_pending_clrh_count($data['emp_data']['empid']);
		$data['appli_pendings'] = $this->emp_model->get_application_pending_recommendaton_count($data['emp_data']['empid']);
		$data['non_dept_recds'] = $this->emp_model->get_application_nondept_recommendaton_count($data['emp_data']['empid']);
		$data['non_dept_procs'] = $this->emp_model->get_application_nondept_process_count($data['emp_data']['empid']);
		$data['pp_recds'] = $this->emp_model->get_application_passport_recommendaton_count($data['emp_data']['empid']);
		$data['pp_procs'] = $this->emp_model->get_application_passport_process_count($data['emp_data']['empid']);
		$data['release_pendings'] = $this->emp_model->get_release_pending_transfer_count($data['emp_data']['empid']);
		$data['join_trnasfer'] = $this->emp_model->get_joining_pending_transfer_count($data['emp_data']['empid']);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['office_orders'] = $this->emp_model->get_employee_form_sixteen($data['emp_data']['empid']);
		$this->load->view('layout/header');
		$this->load->view('pages/emp/pending_works',$data);
		$this->load->view('layout/footer');
	}
	
	public function family(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['members'] = $this->emp_model->family_member_details($data['emp_data']['empid']);
		$this->load->view('layout/header');
		$this->load->view('pages/emp/family',$data);
		$this->load->view('layout/footer');
	}
	public function family_member_add(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$emp_id = $data['emp_data']['empid'];
		$data['error'] = '';
		$data['profile'] = $this->emp_model->get_employee_details($data['emp_data']['empid']);
//		$data['members'] = $this->emp_model->family_member_details($data['emp_data']['empid']);

		if($this->input->post()){
			$this->form_validation->set_rules('c_image', 'Image Code', 'required|xss_clean',array('required'=> 'Please write image code'));
			$this->form_validation->set_rules('agree', '', 'required|xss_clean',array('required'=> 'You have to agree .'));
			if ($this->form_validation->run() == FALSE){
               $data['error'] = validation_errors();
            }else{
				$cap_code = $this->session->userdata('cap_data');
				if($cap_code != $this->input->post('c_image')){
					$data['error'] = $this->lang->line('image_code_not_matched');
				}else{
					$this->emp_model->add_new_family_member();
					$this->session->set_flashdata('success','Added successfully.');
					redirect('emp/family');
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/family_member_add',$data);
		$this->load->view('layout/footer');
	}
	public function family_member_edit(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		$data['error'] = '';
		$data['profile'] = $this->emp_model->get_employee_details($data['emp_data']['empid']);
		$id = $this->uri->segment(3);
		$data['members'] = $this->emp_model->family_member_update($data['emp_data']['empid'],$id);

		if($this->input->post()){
			$this->form_validation->set_rules('c_image', 'Image Code', 'required|xss_clean',array('required'=> 'Please write image code'));
			$this->form_validation->set_rules('agree', '', 'required|xss_clean',array('required'=> 'You have to agree .'));
			if ($this->form_validation->run() == FALSE){
               $data['error'] = validation_errors();
            }else{
				$cap_code = $this->session->userdata('cap_data');
				if($cap_code != $this->input->post('c_image')){
					$data['error'] = $this->lang->line('image_code_not_matched');
				}else{
					$d = $this->input->post('member_dob');
					
					$this->emp_model->update_existig_family_member($id,$empid);
					$this->session->set_flashdata('success','Updated successfully.');
					redirect('emp/family');
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/family_member_edit',$data);
		$this->load->view('layout/footer');
	}
	
	public function application_exam_other(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
	$this->load->helper('security');
	$data = $this->emp_model->get_empployee_exam_other_count();
	$exam_sl_no = date('Y').'/'.($data['exam_tot']+1);
	
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		$data['profile'] = $this->emp_model->get_employee_details($empid);
		$data['employees'] = $this->emp_model->get_aao_officer_list();
		
		if($this->input->post()){
			$this->form_validation->set_rules('c_image', 'Image Code', 'required|xss_clean',array('required'=> 'Please write image code'));
			$this->form_validation->set_rules('sec_off_nm', 'Authority', 'required|xss_clean',array('required'=> 'Authority not selected.'));
			$this->form_validation->set_rules('agree', '', 'required|xss_clean',array('required'=> 'You have to agree .'));
			if ($this->form_validation->run() == FALSE){
               $data['error'] = validation_errors();
            }else{
				$cap_code = $this->session->userdata('cap_data');
				if($cap_code != $this->input->post('c_image')){
					$data['error'] = $this->lang->line('image_code_not_matched');
				}else{
					$emp_type = $this->input->post('emp_type');				
					if($emp_type != 'Permanent'){
						//-------------------On success, upload file				
						if(isset($_FILES['attachment']) && $_FILES['attachment']['size'] > 0){
						//upload file
						$upload_details = $this->common_model->upload_exam_results('attachment');
						
						if(!$upload_details['is_success']){
							$this->session->set_flashdata('error',$upload_details['message']);
							$error = $upload_details['message'];
						}else{
	//						$this->input->post('attachment',$upload_details['filename']);
							$_POST['attachment'] = $upload_details['filename'];
						}
						}					
	//-------------------upload file end.	
						
						$this->emp_model->add_exam_application_other($exam_sl_no);
						$this->session->set_flashdata('success','Your application submitted successfully.');
						redirect('emp/application_exam_other_info');
					}else{
						
						$data = $this->emp_model->get_employee_exam_application_other_count($empid); 
					
						if($data['exam_ct'] < 5 ){
		//-------------------On success, upload file				
							if(isset($_FILES['attachment']) && $_FILES['attachment']['size'] > 0){
							//upload file
							$upload_details = $this->common_model->upload_exam_results('attachment');
							
							if(!$upload_details['is_success']){
								$this->session->set_flashdata('error',$upload_details['message']);
								$error = $upload_details['message'];
							}else{
		//						$this->input->post('attachment',$upload_details['filename']);
								$_POST['attachment'] = $upload_details['filename'];
							}
							}					
		//-------------------upload file end.	
							
							$this->emp_model->add_exam_application_other($exam_sl_no);
							$this->session->set_flashdata('success','Your application submitted successfully.');
							redirect('emp/application_exam_other_info');
						}else{
							$this->session->set_flashdata('error','REJECTED. ! Your have already submitted four aplications.');
							redirect('emp/application_exam_other_info');
						}	
					}	
				}
			}
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/application_exam_other',$data);
		$this->load->view('layout/footer');
	}
	public function application_exam_reco(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['profile'] = $this->emp_model->get_employee_details($data['emp_data']['empid']);
		$data['employees'] = $this->emp_model->get_aao_bo_list();
		$data['designation'] = array();
		foreach($data['employees'] as $val){
			if(!in_array($val['desig'],$data['designation'])){
				$data['designation'][] = $val['desig'];
			}			
		}
		$id = $this->uri->segment(3);
		$data['row'] = array();	
		
		if(!empty($id)){
			$data['records'] = $this->emp_model->get_application_exam_other_update($id);
			if(empty($data['records'])){
				show_404('admin');
			}
		}
		if($this->input->post()){	
			$this->emp_model->update_exam_application_other($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(SITE_BASE_URL.'emp/pending_works');
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		if($data['emp_data']['empid'] != ''){
			if($data['emp_data']['desig']=='ASSTT. ACCOUNTS OFFICER' || $data['emp_data']['desig']=='SUPERVISOR' || $data['emp_data']['desig']=='HINDI OFFICER'){
			$this->load->view('pages/emp/application_exam_other_sec_autho',$data);
			}
			if($data['emp_data']['desig']=='SR. ACCOUNTS OFFICER'|| $data['emp_data']['desig']=='SR. ACCOUNTS OFFICER (Adhoc)'){
			$this->load->view('pages/emp/application_exam_other_sec_reco',$data);
			}
		}
		$this->load->view('layout/footer');
	}
	
	public function application_permission(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['profile'] = $this->emp_model->get_employee_details($data['emp_data']['empid']);
		$data['employees'] = $this->emp_model->get_aao_bo_list();
		$data['designation'] = array();
		foreach($data['employees'] as $val){
			if(!in_array($val['desig'],$data['designation'])){
				$data['designation'][] = $val['desig'];
			}			
		}
		$id = $this->uri->segment(3);
		$data['row'] = array();	
		
		if(!empty($id)){
			$data['records'] = $this->emp_model->get_application_exam_other_process($id);
			if(empty($data['records'])){
				show_404('admin');
			}
		}
		if($this->input->post()){	
			$this->emp_model->update_exam_application_other($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(SITE_BASE_URL.'emp/pending_works');
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		if($data['emp_data']['empid'] != 'ACIPN6392E'){
//		if($data['emp_data']['empid'] != 'AUMPB6168Q'){
			if($data['emp_data']['desig']=='ASSTT. ACCOUNTS OFFICER' && $data['emp_data']['section']=='ADMINISTRATION-I'){
			$this->load->view('pages/emp/application_exam_other_sec',$data);
			}
			//if($data['emp_data']['desig']=='SR. ACCOUNTS OFFICER' && $data['emp_data']['empid']=='ACSPC7537J'){
			//if($data['emp_data']['empid']=='ACSPC7537J'){
			if($data['emp_data']['section']=='BRANCH OFFICER (ADMIN-I) [BADM01]'){
			$this->load->view('pages/emp/application_exam_other_bch',$data);
			}
			if($data['emp_data']['desig']=='DY. ACCOUNTANT GENERAL' || $data['emp_data']['desig']=='SR.DY. ACCOUNTANT GENERAL'){
			$this->load->view('pages/emp/application_exam_other_grp',$data);
			}
			if($data['emp_data']['desig']=='PR. ACCOUNTANT GENERAL'){
			$this->load->view('pages/emp/application_exam_other_pag',$data);
			}
		}else{
			$this->load->view('pages/emp/application_exam_other_chk',$data);
		}
		$this->load->view('layout/footer');
	}
	public function application_permission_save(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$id = $this->uri->segment(3);
		if(!empty($id)){
			$this->emp_model->save_exam_application_other($id);
			$this->session->set_flashdata('success','Record saved successfully.');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		redirect(SITE_BASE_URL.'emp/application_pending_permission_all');	
	}
	public function application_exam_other_download() { 
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('m_pdf');
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
			
		$id = $this->uri->segment(3);

		$data['row'] = array();
		if(!empty($id)){
			$data['record'] = $this->emp_model->get_application_exam_other_process($id);
			if(empty($data['record'])){
				show_404('admin');
			}
		}

		$html = $this->load->view('pages/emp/application_exam_other_print',$data,true);//load the pdf_output.php by passing our data and get all data in $html varriable.
		$img=FCPATH . "assets/images/top-head.png";
		$pdfFilePath ="Permission".time().".pdf";
		$pdf = $this->m_pdf->generate();
		$pdf->SetWatermarkText('O/o the Pr. Accountant General (A&E), WB');
		$pdf->watermark_font = 'DejaVuSansCondensed';
		$pdf->watermarkTextAlpha = 0.1;
		$pdf->showWatermarkText = true;
		$pdf->SetWatermarkImage($img,1,'',array(1,10));
		$pdf->watermarkImageAlpha = 1;
//		$pdf->showWatermarkImage =  true;
		$pdf->WriteHTML($html);
//		$pdf->Output($pdfFilePath, "D");
		$pdf->Output();
    }
	public function bill_recommendation(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['profile'] = $this->emp_model->get_employee_details($data['emp_data']['empid']);
		$data['employees'] = $this->emp_model->get_bo_dag_list();
		$data['designation'] = array();
		foreach($data['employees'] as $val){
			if(!in_array($val['desig'],$data['designation'])){
				$data['designation'][] = $val['desig'];
			}			
		}
		$id = $this->uri->segment(3);
		$data['row'] = array();	
		
		if(!empty($id)){
			$data['records'] = $this->emp_model->get_bill_reimbursement_update($id);
			if(empty($data['records'])){
				show_404('admin');
			}
		}
		
		if($this->input->post()){	
			$this->emp_model->update_employee_bill_process($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(SITE_BASE_URL.'emp/pending_works');
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');

		if($data['emp_data']['empid'] !=''){
			if($data['emp_data']['desig']=='ASSTT. ACCOUNTS OFFICER'){
			$this->load->view('pages/emp/bill_process_sec_autho',$data);
			}
			if($data['emp_data']['desig']=='SR. ACCOUNTS OFFICER'|| $data['emp_data']['desig']=='SR. ACCOUNTS OFFICER (Adhoc)'){
			$this->load->view('pages/emp/bill_process_sec_reco',$data);
			}
			$this->load->view('pages/emp/bill_process_sec_chk',$data);
		}

		$this->load->view('layout/footer');
	}
	public function bill_process(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['profile'] = $this->emp_model->get_employee_details($data['emp_data']['empid']);
		$data['employees'] = $this->emp_model->get_bo_dag_list();
		
		$data['designation'] = array();
		foreach($data['employees'] as $val){
			if(!in_array($val['desig'],$data['designation'])){
				$data['designation'][] = $val['desig'];
			}			
		}
		$id = $this->uri->segment(3);
		$data['row'] = array();	
		
		if(!empty($id)){
			$data['records'] = $this->emp_model->get_bill_reimbursement_update($id);
			if(empty($data['records'])){
				show_404('admin');
			}
		}
		
		if($this->input->post()){	
			$this->emp_model->update_employee_bill_process($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(SITE_BASE_URL.'emp/pending_works');
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');

		if($data['emp_data']['empid'] !=='AUMPB6168Q'){
			
			if($data['emp_data']['desig']=='ASSTT. ACCOUNTS OFFICER' && $data['emp_data']['section']=='ADMINISTRATION-I'){
			$this->load->view('pages/emp/bill_process_sec',$data);
			}
			if($data['emp_data']['desig']=='SR. ACCOUNTS OFFICER' || $data['emp_data']['desig']=='SR. ACCOUNTS OFFICER (Adhoc)' && $data['emp_data']['section']=='ADMINISTRATION-I'){
			$this->load->view('pages/emp/bill_process_bch',$data);
			}
			if($data['emp_data']['desig']=='DY. ACCOUNTANT GENERAL' || $data['emp_data']['section']=='SR. DY. ACCOUNTANT GENERAL'){
			$this->load->view('pages/emp/bill_process_grp',$data);
			}
			if($data['emp_data']['desig']=='PR. ACCOUNTANT GENERAL'){
			$this->load->view('pages/emp/bill_process_pag',$data);
			}
		}else{
			$this->load->view('pages/emp/bill_process_sec_chk',$data);
		}

		$this->load->view('layout/footer');
	}
	
	public function employee_bill_download() { 
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		$this->load->library('m_pdf');
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
			
		$date_from = $this->input->post('date_from');
		$date_to = $this->input->post('date_to');
		$data['row'] = array();
		
		if(!empty($date_from)){
			$data['records'] = $this->emp_model->get_bill_reimbursement_download($date_from,$date_to);
			if(empty($data['records'])){
				show_404('admin');
			}
		}

		$html = $this->load->view('pages/emp/bill_emp_download',$data,true);//load the pdf_output.php by passing our data and get all data in $html varriable.
		$img=FCPATH . "assets/images/top-head.png";
		$pdfFilePath ="Permission".time().".pdf";
		$pdf = $this->m_pdf->pdfgenerate();
		$pdf->SetWatermarkText('O/o the Pr. Accountant General (A&E), WB');
		$pdf->watermark_font = 'DejaVuSansCondensed';
		$pdf->watermarkTextAlpha = 0.1;
		$pdf->showWatermarkText = true;
		$pdf->SetWatermarkImage($img,1,'',array(1,10));
		$pdf->watermarkImageAlpha = 1;
//		$pdf->showWatermarkImage =  true;
		$pdf->WriteHTML($html);
//		$pdf->Output($pdfFilePath, "D");
		$pdf->Output();
    }
	
	public function leave_application_mc_update(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['profile'] = $this->emp_model->get_employee_details($data['emp_data']['empid']);
		$id = $this->uri->segment(3);		
		
		$data['row'] = array();			
		if(!empty($id)){
			$data['leaves'] = $this->emp_model->fetch_leave_application_on_mc($id);
			if(empty($data['leaves'])){
				show_404('admin');
			}
		}
		if($this->input->post()){	
			$this->emp_model->update_leave_mc_varification($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(SITE_BASE_URL.'emp/leave_application_chk_all');
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_application_mc_update',$data);
		$this->load->view('layout/footer');
	}

	public function test_page(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['language_id']=$this->language_id;
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['profile'] = $this->emp_model->get_employee_details($data['emp_data']['empid']);
		$data['employees'] = $this->emp_model->get_authority_list();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/test_page',$data);
		$this->load->view('layout/footer');
	}
	
	public function application_passport(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		
		$data = $this->emp_model->get_passport_appli_count();
		$sl_no = date('Y').'/'.($data['pass_tot']+1);
	
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		$data['profile'] = $this->emp_model->get_employee_details($empid);
		$data['employees'] = $this->emp_model->get_aao_bo_list();
		$data['minors'] = $this->emp_model->family_member_minor_details($empid);

		if($this->input->post()){
			$dataP = $this->emp_model->get_emp_passport_application_ByYr($empid);	
			$dataV = $this->emp_model->get_emp_visa_application_ByYr($empid);
			if($dataP['pass_appli_tot'] < 1 || $dataV['visa_appli_tot'] < 1){	
			$this->form_validation->set_rules('c_image', 'Image Code', 'required|xss_clean',array('required'=> 'Please write image code'));
			$this->form_validation->set_rules('sec_off_nm', 'Authority', 'required|xss_clean',array('required'=> 'Authority not selected.'));
			$this->form_validation->set_rules('agree', '', 'required|xss_clean',array('required'=> 'You have to agree .'));
			if ($this->form_validation->run() == FALSE){
               $data['error'] = validation_errors();
            }else{
				$cap_code = $this->session->userdata('cap_data');
				if($cap_code != $this->input->post('c_image')){
					$data['error'] = $this->lang->line('image_code_not_matched');
				}else{
	//-------------------On success, upload file				
						if(isset($_FILES['attachment']) && $_FILES['attachment']['size'] > 0){
						//upload file
						$upload_details = $this->common_model->upload_exam_results('attachment');
						
							if(!$upload_details['is_success']){
								$this->session->set_flashdata('error',$upload_details['message']);
								$error = $upload_details['message'];
							}else{
		//						$this->input->post('attachment',$upload_details['filename']);
								$_POST['attachment'] = $upload_details['filename'];
							}
						}					
	//-------------------upload file end.	
						
						$id = $this->emp_model->add_passport_application($sl_no,$empid);
						$minor_name = $this->input->post('minor_name');
						$this->emp_model->add_pp_minor_employee($id,$empid,$minor_name);
						$this->session->set_flashdata('success','Your application submitted successfully.');
						redirect('emp/application_passport_info');
					}	
				}
			}else{
				$this->session->set_flashdata('error','You have already submitted application.');
				redirect('emp/application_passport_info');
			}
		}
	
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/application_passport',$data);
		$this->load->view('layout/footer');
	}
	public function application_passport_edit(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);

		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		$data['profile'] = $this->emp_model->get_employee_details($empid);
		$data['employees'] = $this->emp_model->get_aao_bo_list();
		$data['minors'] = $this->emp_model->family_member_minor_details($empid);
				
		$id = $this->uri->segment(3);
		
		if(!empty($id)){
			$data['records'] = $this->emp_model->get_passport_application_ById($empid,$id);
			if(empty($data['records'])){
				show_404('admin');
			}
		}

		if($this->input->post()){
			$this->form_validation->set_rules('c_image', 'Image Code', 'required|xss_clean',array('required'=> 'Please write image code'));
			$this->form_validation->set_rules('sec_off_nm', 'Authority', 'required|xss_clean',array('required'=> 'Authority not selected.'));
			$this->form_validation->set_rules('agree', '', 'required|xss_clean',array('required'=> 'You have to agree .'));
			if ($this->form_validation->run() == FALSE){
               $data['error'] = validation_errors();
            }else{
				$cap_code = $this->session->userdata('cap_data');
				if($cap_code != $this->input->post('c_image')){
					$data['error'] = $this->lang->line('image_code_not_matched');
				}else{
	//-------------------On success, upload file				
						if(isset($_FILES['attachment']) && $_FILES['attachment']['size'] > 0){
						//upload file
						$upload_details = $this->common_model->upload_exam_results('attachment');
						
							if(!$upload_details['is_success']){
								$this->session->set_flashdata('error',$upload_details['message']);
								$error = $upload_details['message'];
							}else{
		//						$this->input->post('attachment',$upload_details['filename']);
								$_POST['attachment'] = $upload_details['filename'];
							}
						}					
	//-------------------upload file end.	
				
						$this->emp_model->update_passport_application($id,$empid);
						$minor_name = $this->input->post('minor_name');
						$this->emp_model->add_pp_minor_employee($id,$empid,$minor_name);
						$this->session->set_flashdata('success','Your application submitted successfully.');
						redirect('emp/application_passport_info');
					}	
				}
			}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/application_passport_edit',$data);
		$this->load->view('layout/footer');
	}
	public function application_passport_info(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		$empid = $data['emp_data']['empid'];
		
		$data['office_orders'] = $this->emp_model->get_passport_application_info($empid);

		$this->load->view('layout/header');
		$this->load->view('pages/emp/application_passport_info',$data);
		$this->load->view('layout/footer');
	}	
	public function foreign_visit_records(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['visits'] = $this->emp_model->foreign_vigit_details($data['emp_data']['empid']);
		$this->load->view('layout/header');
		$this->load->view('pages/emp/foreign_visit_records',$data);
		$this->load->view('layout/footer');
	}
	public function foreign_visits(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['visits'] = $this->emp_model->foreign_vigit_details($data['emp_data']['empid']);
		$this->load->view('layout/header');
		$this->load->view('pages/emp/foreign_visits',$data);
		$this->load->view('layout/footer');
	}
	public function foreign_visits_add(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$emp_id = $data['emp_data']['empid'];
		$data['error'] = '';
		$data['profile'] = $this->emp_model->get_employee_details($data['emp_data']['empid']);

		if($this->input->post()){
			$this->form_validation->set_rules('c_image', 'Image Code', 'required|xss_clean',array('required'=> 'Please write image code'));
			$this->form_validation->set_rules('agree', '', 'required|xss_clean',array('required'=> 'You have to agree .'));
			if ($this->form_validation->run() == FALSE){
               $data['error'] = validation_errors();
            }else{
				$cap_code = $this->session->userdata('cap_data');
				if($cap_code != $this->input->post('c_image')){
					$data['error'] = $this->lang->line('image_code_not_matched');
				}else{
					$this->emp_model->add_foreign_visit_record();
					$this->session->set_flashdata('success','Added successfully.');
					redirect('emp/foreign_visits');
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/foreign_visits_add',$data);
		$this->load->view('layout/footer');
	}
	public function foreign_visits_edit(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		$data['error'] = '';
		$data['profile'] = $this->emp_model->get_employee_details($data['emp_data']['empid']);
		$id = $this->uri->segment(3);
		$data['records'] = $this->emp_model->get_foreign_visit_record($data['emp_data']['empid'],$id);
		
		if($this->input->post()){
			$this->form_validation->set_rules('c_image', 'Image Code', 'required|xss_clean',array('required'=> 'Please write image code'));
			$this->form_validation->set_rules('agree', '', 'required|xss_clean',array('required'=> 'You have to agree .'));
			if ($this->form_validation->run() == FALSE){
               $data['error'] = validation_errors();
            }else{
				$cap_code = $this->session->userdata('cap_data');
				if($cap_code != $this->input->post('c_image')){
					$data['error'] = $this->lang->line('image_code_not_matched');
				}else{
					$d = $this->input->post('member_dob');
					
					$this->emp_model->update_foreign_visit_record($id,$empid);
					$this->session->set_flashdata('success','Updated successfully.');
					redirect('emp/foreign_visits');
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/foreign_visits_edit',$data);
		$this->load->view('layout/footer');
	}
	public function application_pending_passport_all(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		$empid = $data['emp_data']['empid'];
		
		$data['office_orders'] = $this->emp_model->get_application_passport_process_all();

		$this->load->view('layout/header');
		$this->load->view('pages/emp/application_pending_passport_all',$data);
		$this->load->view('layout/footer');
	}
	public function application_pending_pr(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		$empid = $data['emp_data']['empid'];
		
		$data['office_orders'] = $this->emp_model->get_application_pending_pr($empid);

		$this->load->view('layout/header');
		$this->load->view('pages/emp/application_pending_pr',$data);
		$this->load->view('layout/footer');
	}
	public function application_pending_pp(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		$empid = $data['emp_data']['empid'];
		
		$data['office_orders'] = $this->emp_model->get_application_pending_apro($empid);

		$this->load->view('layout/header');
		$this->load->view('pages/emp/application_pending_pp',$data);
		$this->load->view('layout/footer');
	}

	public function application_passport_reco(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['profile'] = $this->emp_model->get_employee_details($data['emp_data']['empid']);
		$data['employees'] = $this->emp_model->get_aao_bo_list();
		
		$data['designation'] = array();
		foreach($data['employees'] as $val){
			if(!in_array($val['desig'],$data['designation'])){
				$data['designation'][] = $val['desig'];
			}			
		}
		
		$id = $this->uri->segment(3);
		$data['row'] = array();	
		$data['minors_rec'] = $this->emp_model->get_passport_for_minors($id);
//echo $this->db->last_query();
//print_r ($data['minors_rec']);
//exit;
		if(!empty($id)){
			$data['records'] = $this->emp_model->get_application_pp_update($id);
			if(empty($data['records'])){
				show_404('admin');
			}
		}
		if($this->input->post()){	
			$this->emp_model->update_employee_pp_record($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(SITE_BASE_URL.'emp/pending_works');
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');	
		if($data['emp_data']['empid'] !=''){
			if($data['emp_data']['desig']=='ASSTT. ACCOUNTS OFFICER' || $data['emp_data']['desig']=='SUPERVISOR' || $data['emp_data']['desig']=='HINDI OFFICER'){
			$this->load->view('pages/emp/application_passport_sec_autho',$data);
			}
			if($data['emp_data']['desig']=='SR. ACCOUNTS OFFICER'|| $data['emp_data']['desig']=='SR. ACCOUNTS OFFICER (Adhoc)'){
			$this->load->view('pages/emp/application_passport_sec_reco',$data);
			}
			if($data['emp_data']['desig']=='DY. ACCOUNTANT GENERAL' || $data['emp_data']['desig']=='SR.DY. ACCOUNTANT GENERAL'){
			$this->load->view('pages/emp/application_passport_grp_reco',$data);
			}
		}
		$this->load->view('layout/footer');
	}

	public function application_passport_noc(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['profile'] = $this->emp_model->get_employee_details($data['emp_data']['empid']);
		$data['employees'] = $this->emp_model->get_aao_bo_list();
		
		$data['designation'] = array();
		foreach($data['employees'] as $val){
			if(!in_array($val['desig'],$data['designation'])){
				$data['designation'][] = $val['desig'];
			}			
		}
		$id = $this->uri->segment(3);
		$data['row'] = array();	
		$data['minors_rec'] = $this->emp_model->get_passport_for_minors($id, $data['emp_data']['empid']);
		
		if(!empty($id)){
			$data['records'] = $this->emp_model->get_application_pp_process($id);
			if(empty($data['records'])){
				show_404('admin');
			}
		}
		if($this->input->post()){	
//print_r($this->input->post('appl_flag'));
//echo $this->db->last_query();
//EXIT;
		//-------------------On success, upload file				
						if(isset($_FILES['draft_attachment']) && $_FILES['draft_attachment']['size'] > 0){
						//upload file
						$upload_details = $this->common_model->upload_exam_results('draft_attachment');						
							if(!$upload_details['is_success']){
								$this->session->set_flashdata('error',$upload_details['message']);
								$error = $upload_details['message'];
							}else{
		//						$this->input->post('draft_attachment',$upload_details['filename']);
								$_POST['draft_attachment'] = $upload_details['filename'];
							}
						}					
		//-------------------upload file end.
			$this->emp_model->update_employee_pp_record($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(SITE_BASE_URL.'emp/pending_works');
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
	if($data['emp_data']['empid'] !='BVOPB8179D'){
//		if($data['emp_data']['empid'] !='AUMPB6168Q'){
			if($data['emp_data']['desig']=='ASSTT. ACCOUNTS OFFICER' && $data['emp_data']['section']=='ADMINISTRATION-I'){
			$this->load->view('pages/emp/application_passport_sec',$data);
			}
/*			
			else { 
				//$this->session->set_flashdata('error','You are not authorised.');
				//redirect(SITE_BASE_URL.'emp/application_pending_passport_all');
				//$this->load->view('pages/emp/application_passport_bch',$data);
				$this->load->view('pages/emp/application_passport_grp',$data);
			}
*/
//			if($data['emp_data']['empid']=='ACSPC7537J]'){
			if($data['emp_data']['section']=='BRANCH OFFICER (ADMIN-I) [BADM01]'){
			$this->load->view('pages/emp/application_passport_bch',$data);
			}
			if($data['emp_data']['desig']=='DY. ACCOUNTANT GENERAL' || $data['emp_data']['desig']=='SR.DY. ACCOUNTANT GENERAL'){
			$this->load->view('pages/emp/application_passport_grp',$data);
			}
			if($data['emp_data']['desig']=='PR. ACCOUNTANT GENERAL'){
			$this->load->view('pages/emp/application_passport_pag',$data);
			}
		}else{
			$this->load->view('pages/emp/application_passport_chk',$data);
		}
		$this->load->view('layout/footer');
	}
	public function application_passport_download() { 
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('m_pdf');
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$id = $this->uri->segment(3);

		$data['row'] = array();
		
		if(!empty($id)){
			$data['record'] = $this->emp_model->getApplicationPassportByID($id);
			if(empty($data['record'])){
				show_404('admin');
			}
		}
		$empid = $data['record']['empid'];	
		$data['wives_husb'] = $this->emp_model->family_wives_details($empid);
		$data['wife_hus'] = $this->emp_model->family_wife_detail($empid);
		$data['members'] = $this->emp_model->family_member_details($empid);
		$data['minors'] = $this->emp_model->family_member_minor_passport($id);
		$data['fvigits'] = $this->emp_model->foreing_visit_future_records($empid);
		$data['pvigits'] = $this->emp_model->foreing_visit_fouryr_records($empid);
	
		$html = $this->load->view('pages/emp/application_passport_print',$data,true);//load the pdf_output.php by passing our data and get all data in $html varriable.
		$img=FCPATH . "assets/images/top-head.png";
		$pdfFilePath ="Permission".time().".pdf";
		$pdf = $this->m_pdf->generate();
		$pdf->SetWatermarkText('O/o the Pr. Accountant General (A&E), WB');
		$pdf->watermark_font = 'DejaVuSansCondensed';
		$pdf->watermarkTextAlpha = 0.1;
		$pdf->showWatermarkText = true;
		$pdf->SetWatermarkImage($img,1,'',array(1,10));
		$pdf->watermarkImageAlpha = 1;
//		$pdf->showWatermarkImage =  true;
		$pdf->WriteHTML($html);
//		$pdf->Output($pdfFilePath, "D");
		$pdf->Output();
    }

	public function digi_lib(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		if($this->session->userdata('subscribers_data')){
			//redirect('emp/dashboard');
		}
		$this->load->view('layout/header');
		$this->load->view('pages/emp/digi_lib');
		$this->load->view('layout/footer');
	}
	public function digi_open(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		if($this->session->userdata('subscribers_data')){
			//redirect('emp/dashboard');
		}
		$this->load->view('layout/header');
		$this->load->view('pages/emp/digi_open');
		$this->load->view('layout/footer');
	}
	public function hardware_ser(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		$empid = $data['emp_data']['empid'];
		
		$data['amc_yr'] = $this->emp_model->get_all_finyears();
		$data['vendors'] = $this->emp_model->get_all_amc_vendors();
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_inout_hard_records($page_no);	
		$data['results'] = $response['results'];

		$config['base_url'] = base_url().'emp/hardware_ser';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;
		
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		
		$this->load->view('layout/header');
		$this->load->view('pages/emp/hardware_ser',$data);
		$this->load->view('layout/footer');
	}
	public function hardware_ser_edit(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		$empid = $data['emp_data']['empid'];
		
		$data['amc_yr'] = $this->emp_model->get_all_finyears();
		$data['vendors'] = $this->emp_model->get_all_amc_vendors();
		$data['section_list'] = $this->emp_model->get_all_section_list();
		
		$id = $this->uri->segment(3);
		$data['records'] = $this->emp_model->get_compinfo_record($id);
		$data['details'] = $this->emp_model->get_inout_record($id);
		if(empty($data['records'])){
				show_404('admin');
		}
		if(empty($data['details'])){
				show_404('admin');
		}
		
		if($this->input->post()){	
			$this->emp_model->update_cominfo_inoutrecords($id,$empid);
			$this->session->set_flashdata('success','Updated successfully.');
			redirect('emp/hardware_ser');
		}
				
		$this->load->view('layout/header');
		$this->load->view('pages/emp/hardware_ser_edit',$data);
		$this->load->view('layout/footer');
	}
	public function hardware_compl_add(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];	
		$empid = $data['emp_data']['empid'];
		$data['section_list'] = $this->emp_model->get_all_section_list();
		$data['amc_yr'] = $this->emp_model->get_all_finyears();
		
		if($this->input->post()){	
			$this->emp_model->add_hardware_comp($empid);
			$this->session->set_flashdata('success','Added successfully.');
			redirect('emp/hardware_compl_add');
		}
		$this->load->view('layout/header');
		$this->load->view('pages/emp/hardware_compl_add',$data);
	$this->load->view('layout/footer');
	}
	public function hardware_out_add(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		$data['compno_list'] = $this->emp_model->get_all_compno_list();
		$data['vendors'] = $this->emp_model->get_all_amc_vendors();

		if($this->input->post()){	
			$this->emp_model->add_hardware_inout($empid);
			$this->session->set_flashdata('success','Added successfully.');
			redirect('emp/hardware_out_add');
		}
		$this->load->view('layout/header');
		$this->load->view('pages/emp/hardware_out_add',$data);
	$this->load->view('layout/footer');
	}
	public function emdbg_proc_bill(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		$empid = $data['emp_data']['empid'];
				
		$data['years'] = $this->emp_model->get_all_finyears();
		$data['vendors'] = $this->emp_model->get_all_vendors();
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_invoice_all($page_no);	
		$data['results'] = $response['results'];

		$config['base_url'] = base_url().'emp/emdbg_proc_bill';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;
		
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		
		
		$this->load->view('layout/header');
		$this->load->view('pages/emp/emdbg_proc_bill',$data);
		$this->load->view('layout/footer');
	}
	public function emdbg_proc_add(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		
		$data = $this->emp_model->get_passport_appli_count();
		$sl_no = date('Y').'/'.($data['pass_tot']+1);
	
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		$data['vendors'] = $this->emp_model->get_all_vendors();
		$data['years'] = $this->emp_model->get_all_finyears();
		$data['banks'] = $this->emp_model->get_bank_list($empid);

		if($this->input->post()){
			$bank_nm = $this->input->post('bank_nm');
			$this->emp_model->add_new_invoice_detail($empid, $bank_nm);
			$this->session->set_flashdata('success','Added successfully.');
			redirect('emp/emdbg_proc_add');
		}
	
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/emdbg_proc_add',$data);
		$this->load->view('layout/footer');
	}
	public function emdbg_proc_edit(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);

		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		$data['vendors'] = $this->emp_model->get_all_vendors();
		$data['years'] = $this->emp_model->get_all_finyears();
		$id = $this->uri->segment(3);
		
		if(!empty($id)){
			$data['records'] = $this->emp_model->get_invoice_ById($id);
			if(empty($data['records'])){
				show_404('admin');
			}
		}
		if($this->input->post()){
			$bank_nm = $this->input->post('bank_nm');
			$this->emp_model->update_invoice_detail($id,$empid);
			$this->session->set_flashdata('success','Updated successfully.');
			redirect('emp/emdbg_proc_bill');
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/emdbg_proc_edit',$data);
		$this->load->view('layout/footer');
	}
	public function emdbg_invoice_reg(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		$empid = $data['emp_data']['empid'];
		
		$data['vendors'] = $this->emp_model->get_all_vendors();
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_proc_reg($page_no);		
		$data['results'] = $response['results'];

		$config['base_url'] = base_url().'emp/emdbg_invoice_reg';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;
		
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
				
		$this->load->view('layout/header');
		$this->load->view('pages/emp/emdbg_invoice_reg',$data);
		$this->load->view('layout/footer');
	}
	public function emdbg_cons(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		$empid = $data['emp_data']['empid'];
		
		$data['vendors'] = $this->emp_model->get_all_vendors();
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_emdbg_consu($page_no);		
		
		$data['results'] = $response['results'];

		$config['base_url'] = base_url().'emp/emdbg_cons';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;
		
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
	
		$this->load->view('layout/header');
		$this->load->view('pages/emp/emdbg_cons',$data);
		$this->load->view('layout/footer');
	}
	public function emdbg_cons_add(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);

		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		$data['sl_data'] = $this->emp_model->get_emdbg_consu_slno();
	
		if($this->input->post()){	
			$this->emp_model->add_new_emdbg_consu($empid);
			$this->session->set_flashdata('success','Added successfully.');
			redirect('emp/emdbg_cons');
		}
		
		$this->load->view('layout/header');
		$this->load->view('pages/emp/emdbg_cons_add',$data);
		$this->load->view('layout/footer');
	}
	public function emdbg_cons_edit(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);

		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		
		$id = $this->uri->segment(3);
		if(!empty($id)){
			$data['records'] = $this->emp_model->get_emdbg_consu_ById($id);
			if(empty($data['records'])){
				show_404('admin');
			}
		}
		if($this->input->post()){
			$this->emp_model->update_emdbg_consu_detail($id,$empid);
			$this->session->set_flashdata('success','Updated successfully.');
			redirect('emp/emdbg_cons');
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/emdbg_cons_edit',$data);
		$this->load->view('layout/footer');
	}
	public function emdbg_soft(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		$empid = $data['emp_data']['empid'];
		
		$data['vendors'] = $this->emp_model->get_all_vendors();
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_emdbg_soft($page_no);		
		$data['results'] = $response['results'];

		$config['base_url'] = base_url().'emp/emdbg_soft';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;
		
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		
		
		$this->load->view('layout/header');
		$this->load->view('pages/emp/emdbg_soft',$data);
		$this->load->view('layout/footer');
	}
	public function emdbg_soft_add(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);

		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		$data['sl_data'] = $this->emp_model->get_emdbg_consu_slno();

		if($this->input->post()){	
			$this->emp_model->add_new_emdbg_consu_soft($empid);
			$this->session->set_flashdata('success','Added successfully.');
			redirect('emp/emdbg_soft');
		}
		
		$this->load->view('layout/header');
		$this->load->view('pages/emp/emdbg_soft_add',$data);
		$this->load->view('layout/footer');
	}
	public function emdbg_soft_edit(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);

		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		
		$id = $this->uri->segment(3);
		if(!empty($id)){
			$data['records'] = $this->emp_model->get_emdbg_consu_ById($id);
			if(empty($data['records'])){
				show_404('admin');
			}
		}
		if($this->input->post()){
			$this->emp_model->update_emdbg_consu_detail($id,$empid);
			$this->session->set_flashdata('success','Updated successfully.');
			redirect('emp/emdbg_soft');
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/emdbg_soft_edit',$data);
		$this->load->view('layout/footer');
	}
	public function emdbg_stock(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		$empid = $data['emp_data']['empid'];
		
		$data['vendors'] = $this->emp_model->get_all_vendors();
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_emdbg_stock($page_no);		
		$data['results'] = $response['results'];

		$config['base_url'] = base_url().'emp/emdbg_stock';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;
		
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		
		
		$this->load->view('layout/header');
		$this->load->view('pages/emp/emdbg_stock',$data);
		$this->load->view('layout/footer');
	}
	public function emdbg_stock_add(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);

		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		$data['sl_data'] = $this->emp_model->get_emdbg_stk_slno();
		$data['vendors'] = $this->emp_model->get_all_vendors();
		$data['consitems'] = $this->emp_model->consu_item_details();


		if($this->input->post()){	
			$item_id = $this->input->post('item_id');
			$this->emp_model->add_new_emdbg_stock($empid,$item_id);
			$this->session->set_flashdata('success','Added successfully.');
			redirect('emp/emdbg_stock');
		}
		
		$this->load->view('layout/header');
		$this->load->view('pages/emp/emdbg_stock_add',$data);
		$this->load->view('layout/footer');
	}
	public function emdbg_stock_edit(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);

		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		$data['vendors'] = $this->emp_model->get_all_vendors();
		$data['consitems'] = $this->emp_model->consu_item_details();
		
		$id = $this->uri->segment(3);
		if(!empty($id)){
			$data['records'] = $this->emp_model->get_emdbg_stock_ById($id);
			if(empty($data['records'])){
				show_404('admin');
			}
		}

		if($this->input->post()){
			$this->emp_model->update_emdbg_stock_detail($id,$empid);
			$this->session->set_flashdata('success','Updated successfully.');
			redirect('emp/emdbg_stock');
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/emdbg_stock_edit',$data);
		$this->load->view('layout/footer');
	}
	public function emdbg_issue(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		$empid = $data['emp_data']['empid'];
		
		$data['vendors'] = $this->emp_model->get_all_vendors();
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_emdbg_issue($page_no);		
		$data['results'] = $response['results'];

		$config['base_url'] = base_url().'emp/emdbg_issue';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;
		
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		
		
		$this->load->view('layout/header');
		$this->load->view('pages/emp/emdbg_issue',$data);
		$this->load->view('layout/footer');
	}
	public function emdbg_issue_add(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);

		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		$data['section_list'] = $this->emp_model->get_all_section_list();
		$data['sl_data'] = $this->emp_model->get_emdbg_issue_slno();
		$data['consitems'] = $this->emp_model->consu_item_details();

		if($this->input->post()){	
			$item_id = $this->input->post('item_id');
			$this->emp_model->add_new_emdbg_issue($empid,$item_id);
			$this->session->set_flashdata('success','Added successfully.');
			redirect('emp/emdbg_issue');
		}
		
		$this->load->view('layout/header');
		$this->load->view('pages/emp/emdbg_issue_add',$data);
		$this->load->view('layout/footer');
	}
	public function emdbg_issue_edit(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);

		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		$data['section_list'] = $this->emp_model->get_all_section_list();
		$data['consitems'] = $this->emp_model->consu_item_details();
		
		$id = $this->uri->segment(3);
		if(!empty($id)){
			$data['records'] = $this->emp_model->get_emdbg_issue_ById($id);
			if(empty($data['records'])){
				show_404('admin');
			}
		}
		if($this->input->post()){
			$this->emp_model->update_emdbg_issue_detail($id,$empid);
			$this->session->set_flashdata('success','Updated successfully.');
			redirect('emp/emdbg_issue');
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/emdbg_issue_edit',$data);
		$this->load->view('layout/footer');
	}
	public function emdbg_all(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		$empid = $data['emp_data']['empid'];
		
		$data['vendors'] = $this->emp_model->get_all_vendors();
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_emdbg_all($page_no);		
		$data['results'] = $response['results'];

		$config['base_url'] = base_url().'emp/emdbg_all';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;
		
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		
		
		$this->load->view('layout/header');
		$this->load->view('pages/emp/emdbg_all',$data);
		$this->load->view('layout/footer');
	}
	public function emdbg_add(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		$data = $this->emp_model->get_passport_appli_count();
		$sl_no = date('Y').'/'.($data['pass_tot']+1);
	
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		$data['vendors'] = $this->emp_model->get_all_vendors();
		$data['years'] = $this->emp_model->get_all_finyears();
		$data['banks'] = $this->emp_model->get_bank_list($empid);

		if($this->input->post()){
			$bank_nm = $this->input->post('bank_nm');
			$this->emp_model->add_new_emdbg_detail($empid, $bank_nm);
			$this->session->set_flashdata('success','Added successfully.');
			redirect('emp/emdbg_add');
		}
	
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/emdbg_add',$data);
		$this->load->view('layout/footer');
	}
	public function emdbg_edit(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);

		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		
		$id = $this->uri->segment(3);
		
		if(!empty($id)){
			$data['records'] = $this->emp_model->get_emdbg_ById($id);
			if(empty($data['records'])){
				show_404('admin');
			}
		}
		if($this->input->post()){
			$bank_nm = $this->input->post('bank_nm');
			$this->emp_model->update_emdbg_detail($id,$empid);
			$this->session->set_flashdata('success','Updated successfully.');
			redirect('emp/emdbg_all');
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/emdbg_edit',$data);
		$this->load->view('layout/footer');
	}
	public function emdbg_reg(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		$empid = $data['emp_data']['empid'];
		
		$data['vendors'] = $this->emp_model->get_all_vendors();
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_emdbg_reg($page_no);		
		$data['results'] = $response['results'];

		$config['base_url'] = base_url().'emp/emdbg_reg';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;
		
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		
		
		$this->load->view('layout/header');
		$this->load->view('pages/emp/emdbg_reg',$data);
		$this->load->view('layout/footer');
	}
	public function emdbg_bill_add(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		$data['emdbg_slno'] = $this->emp_model->get_all_emdbgno_list();
		$data['vendors'] = $this->emp_model->get_all_vendors();
		$data['years'] = $this->emp_model->get_all_finyears();
		
		if($this->input->post()){	
			$this->emp_model->add_new_emdbg_bill($empid);
			$this->session->set_flashdata('success','Added successfully.');
			redirect('emp/emdbg_bill_add');
		}
		
		$this->load->view('layout/header');
		$this->load->view('pages/emp/emdbg_bill_add',$data);
		$this->load->view('layout/footer');
	}
	public function emdbg_procbill_add(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		$data['emdbg_slno'] = $this->emp_model->get_all_emdbg_invoiceno_list();
		$data['vendors'] = $this->emp_model->get_all_vendors();
		$data['years'] = $this->emp_model->get_all_finyears();
		
		if($this->input->post()){	
			$this->emp_model->add_new_emdbg_bill($empid);
			$this->session->set_flashdata('success','Added successfully.');
			redirect('emp/emdbg_procbill_add');
		}
		
		$this->load->view('layout/header');
		$this->load->view('pages/emp/emdbg_procbill_add',$data);
		$this->load->view('layout/footer');
	}
	public function emdbg_bill_edit(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);

		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		
		$id = $this->uri->segment(3);
		$data['vendors'] = $this->emp_model->get_all_vendors();
		$data['years'] = $this->emp_model->get_all_finyears();

		if(!empty($id)){
			$data['records'] = $this->emp_model->get_emdbg_reg_ById($id);
			if(empty($data['records'])){
				show_404('admin');
			}
		}
		if($this->input->post()){
			$this->emp_model->update_emdbg_reg_detail($id,$empid);
			$this->session->set_flashdata('success','Updated successfully.');
			redirect('emp/emdbg_reg');
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/emdbg_bill_edit',$data);
		$this->load->view('layout/footer');
	}
	public function emdbg_budget(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		$empid = $data['emp_data']['empid'];
		
		$data['years'] = $this->emp_model->get_all_finyears();
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_emdbg_budget($page_no);		
		$data['results'] = $response['results'];

		$config['base_url'] = base_url().'emp/emdbg_budget';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;
		
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		
		$this->load->view('layout/header');
		$this->load->view('pages/emp/emdbg_budget',$data);
		$this->load->view('layout/footer');
	}
	public function emdbg_budget_add(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		$data['sl_data'] = $this->emp_model->get_emdbg_budget_slno();
		$data['vendors'] = $this->emp_model->get_all_vendors();
		$data['years'] = $this->emp_model->get_all_finyears();
		
		if($this->input->post()){	
			$this->emp_model->add_new_budget_allotment($empid);
			$this->session->set_flashdata('success','Added successfully.');
			redirect('emp/emdbg_budget_add');
		}

		$this->load->view('layout/header');
		$this->load->view('pages/emp/emdbg_budget_add',$data);
		$this->load->view('layout/footer');
	}
	
	public function emdbg_budget_edit(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);

		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid = $data['emp_data']['empid'];
		
		$id = $this->uri->segment(3);
		$data['vendors'] = $this->emp_model->get_all_vendors();
		$data['years'] = $this->emp_model->get_all_finyears();

		if(!empty($id)){
			$data['records'] = $this->emp_model->get_emdbg_budget_ById($id);
			if(empty($data['records'])){
				show_404('admin');
			}
		}
		if($this->input->post()){
			$this->emp_model->update_emdbg_budget_allotment($id,$empid);
			$this->session->set_flashdata('success','Updated successfully.');
//			$this->session->set_flashdata('error','Not Updated.');
			redirect('emp/emdbg_budget');
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/emdbg_budget_edit',$data);
		$this->load->view('layout/footer');
	}
	public function emdbg_budget_rept(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];	
		$data['years'] = $this->emp_model->get_all_finyears();
		$fin_yr = $this->input->get('fin_year',true);

		if($this->input->get()){
			$data['alot_cons'] = $this->emp_model->get_budget_report_alot_cons($fin_yr);
			$data['alot_amc'] = $this->emp_model->get_budget_report_alot_amc($fin_yr);
			$data['alot_hware'] = $this->emp_model->get_budget_report_alot_hw($fin_yr);
			$data['alot_sware'] = $this->emp_model->get_budget_report_alot_sw($fin_yr);
			$data['alot_other'] = $this->emp_model->get_budget_report_alot_other($fin_yr);
			$data['alot_sms'] = $this->emp_model->get_budget_report_alot_sms($fin_yr);
			$data['alot_ict'] = $this->emp_model->get_budget_report_alot_ict($fin_yr);
			$data['alot_oios'] = $this->emp_model->get_budget_report_alot_oios($fin_yr);
			$data['alot_furni'] = $this->emp_model->get_budget_report_alot_furni($fin_yr);
			$data['alot_machi'] = $this->emp_model->get_budget_report_alot_machiry($fin_yr);
		
			$data['cons'] = $this->emp_model->get_budget_report_cons($fin_yr);
			$data['amc'] = $this->emp_model->get_budget_report_amc($fin_yr);
			$data['hware'] = $this->emp_model->get_budget_report_hw($fin_yr);
			$data['sware'] = $this->emp_model->get_budget_report_sw($fin_yr);
			$data['other'] = $this->emp_model->get_budget_report_other($fin_yr);
			$data['sms'] = $this->emp_model->get_budget_report_sms($fin_yr);
			$data['ict'] = $this->emp_model->get_budget_report_ict($fin_yr);
			$data['oios'] = $this->emp_model->get_budget_report_oios($fin_yr);
			$data['furni'] = $this->emp_model->get_budget_report_funi($fin_yr);
			$data['machi'] = $this->emp_model->get_budget_report_machiry($fin_yr);
		}

		$this->load->view('layout/header');
		$this->load->view('pages/emp/emdbg_budget_rept',$data);
		$this->load->view('layout/footer');
	}
	public function emdbg_budget_pdf() { 
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('m_pdf');
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);

		$fin_yr = $this->uri->segment(3);
		$data['rows'] = array();

			$data['alot_cons'] = $this->emp_model->get_budget_report_alot_cons($fin_yr);
			$data['alot_amc'] = $this->emp_model->get_budget_report_alot_amc($fin_yr);
			$data['alot_hware'] = $this->emp_model->get_budget_report_alot_hw($fin_yr);
			$data['alot_sware'] = $this->emp_model->get_budget_report_alot_sw($fin_yr);
			$data['alot_other'] = $this->emp_model->get_budget_report_alot_other($fin_yr);
			$data['alot_sms'] = $this->emp_model->get_budget_report_alot_sms($fin_yr);
			$data['alot_oios'] = $this->emp_model->get_budget_report_alot_oios($fin_yr);
			$data['alot_furni'] = $this->emp_model->get_budget_report_alot_furni($fin_yr);
			$data['alot_machi'] = $this->emp_model->get_budget_report_alot_machiry($fin_yr);
				
			$data['cons'] = $this->emp_model->get_budget_report_cons($fin_yr);
			$data['amc'] = $this->emp_model->get_budget_report_amc($fin_yr);
			$data['hware'] = $this->emp_model->get_budget_report_hw($fin_yr);
			$data['sware'] = $this->emp_model->get_budget_report_sw($fin_yr);
			$data['other'] = $this->emp_model->get_budget_report_other($fin_yr);
			$data['sms'] = $this->emp_model->get_budget_report_sms($fin_yr);
			$data['oios'] = $this->emp_model->get_budget_report_oios($fin_yr);
			$data['furni'] = $this->emp_model->get_budget_report_funi($fin_yr);
			$data['machi'] = $this->emp_model->get_budget_report_machiry($fin_yr);

		$html = $this->load->view('pages/emp/emdbg_budget_pdf',$data,true);//load the pdf_output.php by passing our data and get all data in $html varriable.	
		$pdf = $this->m_pdf->pdfgenerate();
		$pdf->SetWatermarkText('O/o the Pr. Accountant General (A&E), WB');
		$pdf->watermark_font = 'DejaVuSansCondensed';
		$pdf->watermarkTextAlpha = 0.1;
		$pdf->showWatermarkText = true;
		$pdf->WriteHTML($html);
//		$pdf->Output($pdfFilePath, "D");
		$pdf->Output();
    }
	public function emdbg_pending_pdf() { 
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('m_pdf');
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);

		$vendor = $this->uri->segment(3);
		$vendor = str_replace("%20"," ",$vendor);
		
		$data['rows'] = array();
		$data['rows'] = $this->emp_model->get_emdbg_pending_return($vendor);
		
		$html = $this->load->view('pages/emp/emdbg_pending_pdf',$data,true);//load the pdf_output.php by passing our data and get all data in $html varriable.	
		$pdf = $this->m_pdf->generate();
		$pdf->SetWatermarkText('O/o the Pr. Accountant General (A&E), WB');
		$pdf->watermark_font = 'DejaVuSansCondensed';
		$pdf->watermarkTextAlpha = 0.1;
		$pdf->showWatermarkText = true;
		$pdf->WriteHTML($html);
//		$pdf->Output($pdfFilePath, "D");
		$pdf->Output();
    }
	public function emdbg_finyr_add(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];

		if($this->input->post()){	
			$this->emp_model->add_new_fin_year();
			$this->session->set_flashdata('success','Added successfully.');
			redirect('emp/emdbg_finyr_add');
		}
		
		$this->load->view('layout/header');
		$this->load->view('pages/emp/emdbg_finyr_add',$data);
		$this->load->view('layout/footer');
	}
	public function emdbg_bank_add(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		if($this->input->post()){	
			$this->emp_model->add_new_bank_br();
			$this->session->set_flashdata('success','Added successfully.');
			redirect('emp/emdbg_bank_add');
		}
		$this->load->view('layout/header');
		$this->load->view('pages/emp/emdbg_bank_add',$data);
		$this->load->view('layout/footer');
	}
	public function emdbg_vendor_add(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->helper('security');
		
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		if($this->input->post()){	
			$this->emp_model->add_new_vendor();
			$this->session->set_flashdata('success','Added successfully.');
			redirect('emp/emdbg_vendor_add');
		}
		$this->load->view('layout/header');
		$this->load->view('pages/emp/emdbg_vendor_add',$data);
	$this->load->view('layout/footer');
	}
	public function hardware_pdf() { 
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('m_pdf');
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);

		$id = $this->uri->segment(3);
		$data['vendor'] = $this->emp_model->get_vendor_ById($id);
		$vnd = trim($data['vendor']['vendor_nm']);
		$data['rows'] = array();

		$data['rows'] = $this->emp_model->hardware_pending_pdf($vnd);
		if(empty($data['rows'])){
			show_404('admin');
		}
	
		$html = $this->load->view('pages/emp/hardware_pdf',$data,true);//load the pdf_output.php by passing our data and get all data in $html varriable.	
		$pdf = $this->m_pdf->pdfgenerate();
		$pdf->SetWatermarkText('O/o the Pr. Accountant General (A&E), WB');
		$pdf->watermark_font = 'DejaVuSansCondensed';
		$pdf->watermarkTextAlpha = 0.1;
		$pdf->showWatermarkText = true;
		$pdf->WriteHTML($html);
//		$pdf->Output($pdfFilePath, "D");
		$pdf->Output();
    }
	public function hardware_invtry(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		$this->load->library('pagination');
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		$empid = $data['emp_data']['empid'];
		
		$data['locations'] = $this->emp_model->get_hw_location_list();
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_hw_inventory_records($page_no);	
		$data['results'] = $response['results'];

		$config['base_url'] = base_url().'emp/hardware_invtry';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;
		
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		
		$this->load->view('layout/header');
		$this->load->view('pages/emp/hardware_invtry',$data);
		$this->load->view('layout/footer');
	}

}// End of Class
