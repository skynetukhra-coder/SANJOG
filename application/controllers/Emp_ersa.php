<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emp_ersa extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->lang->load('main','english');
		$this->load->model('emp_model');
		if($this->session->userdata('language_id')){
			$this->language_id = $this->session->userdata('language_id');
		}else{
			$this->language_id = 1;
		}
	}
	public function login(){
		if($this->session->has_userdata('emp_ersa_data')){
			redirect('emp_ersa/information');
		}
		$this->load->helper('security');
		
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
					$login_details = $this->emp_model->employee_ersa_login($emp_id,$pass);
					
					if(empty($login_details)){
						$data['error'] = $this->lang->line('wrong_credentials');
					}else{
						$this->session->set_userdata('emp_ersa_data',$login_details);
						$this->session->set_flashdata('success',$this->lang->line('successfully_logged_in'));
						redirect('emp_ersa/information');
					}
				}
			}
		}
		$data['cap'] = get_captcha();
		// redirect('https://agwb.cag.gov.in');
		$this->load->view('layout/header');
		$this->load->view('pages/emp_ersa/login',$data);
		$this->load->view('layout/footer');
	}
	
	public function registration(){
		if($this->session->has_userdata('emp_ersa_data')){
			redirect('emp_ersa/information');
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
					$reg_status = $this->emp_model->employee_registration('AGERSA');
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
						redirect('emp_ersa/otp');
					}
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp_ersa/registration',$data);
		$this->load->view('layout/footer');
	}
	public function forgot_password(){
		if($this->session->has_userdata('emp_ersa_data')){
			redirect('emp_ersa/information');
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
					$reg_status = $this->emp_model->employee_forgot_password('AGERSA');
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
						redirect('emp_ersa/otp');
					}
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp_ersa/forgot_password',$data);
		$this->load->view('layout/footer');
	}
	public function otp(){
		if($this->session->has_userdata('emp_ersa_data')){
			redirect('emp_ersa/information');
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
						redirect('emp_ersa/reset_password');
					}
				//}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp_ersa/otp',$data);
		$this->load->view('layout/footer');
	
	}
	public function reset_password(){
		
		if($this->session->has_userdata('emp_ersa_data')){
			redirect('emp_ersa/information');
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
					$emp_id = $this->session->userdata('emp_reg');
					$pass = $this->input->post('pass',true);
					$this->emp_model->reset_password($emp_id,$pass);
					$this->session->set_flashdata('success',$this->lang->line('password_updated_login_now'));
					$this->session->unset_userdata('nxt_pg');
					redirect('emp_ersa/login');
			//	}
			}
		}
		//$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp_ersa/reset_password',$data);
		$this->load->view('layout/footer');
	}
	
	public function dashboard(){
		if(!$this->session->has_userdata('emp_ersa_data')){
			redirect('emp_ersa/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_ersa_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$this->load->view('layout/header');
		$this->load->view('pages/emp_ersa/dashboard',$data);
		$this->load->view('layout/footer');
	}
	public function information(){
		if(!$this->session->has_userdata('emp_ersa_data')){
			redirect('emp_ersa/login');
		}
		$this->load->helper('security');
		$data['emp_data'] = $this->session->userdata('emp_ersa_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['profile'] = $this->emp_model->employee_details($data['emp_data']['empid'],'AGERSA');
		$this->load->view('layout/header');
		$this->load->view('pages/emp_ersa/information',$data);
		$this->load->view('layout/footer');
	}
	public function profile(){
		if(!$this->session->has_userdata('emp_ersa_data')){
			redirect('emp_ersa/login');
		}
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->helper('security');
		$data['emp_data'] = $this->session->userdata('emp_ersa_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['profile'] = $this->emp_model->employee_details($data['emp_data']['empid'],'AGERSA');
		if($this->input->post()){
			//$this->form_validation->set_rules('email', 'Email Id', 'required|valid_email|xss_clean');
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
					$is_uopdate = $this->emp_model->update_employee($data['emp_data']['empid']);
					if($is_uopdate){
						$this->session->set_flashdata('success',$this->lang->line('successfully_updated'));
						redirect('emp_ersa/information');
					}
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp_ersa/profile',$data);
		$this->load->view('layout/footer');
	}
	public function documents(){
		if(!$this->session->userdata('emp_ersa_data')){
			redirect('emp_ersa/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_ersa_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['office_orders'] = $this->emp_model->get_employee_office_orders($data['emp_data']['empid']);
		$this->load->view('layout/header');
		$this->load->view('pages/emp_ersa/documents',$data);
		$this->load->view('layout/footer');
	}
	public function application(){
		if(!$this->session->userdata('emp_ersa_data')){
			redirect('emp_ersa/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		$data['emp_data'] = $this->session->userdata('emp_ersa_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['profile'] = $this->emp_model->employee_details($data['emp_data']['empid']);
		$data['application'] = $this->emp_model->get_employee_application($data['emp_data']['empid']);
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
					$reg_status = $this->emp_model->employee_application($data['emp_data']['empid']);
					$this->session->set_flashdata('success','Your application successfully sent.');
					redirect('emp_ersa/application');
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp_ersa/application',$data);
		$this->load->view('layout/footer');
	}
	
	public function service_book(){
		if(!$this->session->userdata('emp_ersa_data')){
			redirect('emp_ersa/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_ersa_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['office_orders'] = $this->emp_model->get_employee_service_book($data['emp_data']['empid']);
		$this->load->view('layout/header');
		$this->load->view('pages/emp_ersa/service_book',$data);
		$this->load->view('layout/footer');
	}
	public function training(){
		if(!$this->session->userdata('emp_ersa_data')){
			redirect('emp_ersa/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_ersa_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$this->load->view('layout/header');
		$this->load->view('pages/emp_ersa/training',$data);
		$this->load->view('layout/footer');
	}
	public function salary(){
		if(!$this->session->userdata('emp_ersa_data')){
			redirect('emp_ersa/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_ersa_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$this->load->view('layout/header');
		$this->load->view('pages/emp_ersa/salary',$data);
		$this->load->view('layout/footer');
	}
	public function leave(){
		if(!$this->session->userdata('emp_ersa_data')){
			redirect('emp_ersa/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_ersa_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$this->load->view('layout/header');
		$this->load->view('pages/emp_ersa/leave',$data);
		$this->load->view('layout/footer');
	}
	public function tour(){
		if(!$this->session->userdata('emp_ersa_data')){
			redirect('emp_ersa/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_ersa_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$this->load->view('layout/header');
		$this->load->view('pages/emp_ersa/tour',$data);
		$this->load->view('layout/footer');
	}
	public function loan(){
		if(!$this->session->userdata('emp_ersa_data')){
			redirect('emp_ersa/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_ersa_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$this->load->view('layout/header');
		$this->load->view('pages/emp_ersa/loan',$data);
		$this->load->view('layout/footer');
	}
	public function gpf(){
		if(!$this->session->userdata('emp_ersa_data')){
			redirect('emp_ersa/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_ersa_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$this->load->view('layout/header');
		$this->load->view('pages/emp_ersa/gpf',$data);
		$this->load->view('layout/footer');
	}
	public function request(){
		if(!$this->session->userdata('emp_ersa_data')){
			redirect('emp_ersa/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_ersa_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$this->load->view('layout/header');
		$this->load->view('pages/emp_ersa/request',$data);
		$this->load->view('layout/footer');
	}
	
	public function logout(){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$arr_feed['id'] 	= $this->session->userdata('emp_ersa_data')['empid'];
		$arr_feed['name'] 	= $this->session->userdata('emp_ersa_data')['empname'];
		$arr_feed['mobile'] = $this->session->userdata('emp_ersa_data')['mbno'];
		$arr_feed['email']  = trim($this->session->userdata('emp_ersa_data')['nicmail']) == '' ? $this->session->userdata('emp_ersa_data')['email'] : $this->session->userdata('emp_ersa_data')['nicmail'];
		$this->session->set_userdata('user_details_for_feedback',$arr_feed);
		$this->session->unset_userdata('emp_ersa_data');
		$this->session->set_flashdata('success',$this->lang->line('give_your_feedback'));
		redirect('feedback');
		$this->load->view('layout/header');
		$this->load->view('pages/emp_ersa/login',$data);
		$this->load->view('layout/footer');
	}
}// End of Class
