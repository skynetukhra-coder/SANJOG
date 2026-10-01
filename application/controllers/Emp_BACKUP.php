<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emp extends CI_Controller {
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
						$this->session->set_flashdata('success',$this->lang->line('successfully_logged_in'));
						redirect('emp/information');
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
					redirect('emp/login');
			//	}
			}
		}
		//$data['cap'] = get_captcha();
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
		$this->load->view('layout/header');
		$this->load->view('pages/emp/dashboard',$data);
		$this->load->view('layout/footer');
	}

	public function information(){
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['header']['empid'] = $data['emp_data']['empid'];
		$data['profile'] = $this->emp_model->employee_details($data['emp_data']['empid']);
		$data['section_list'] = $this->emp_model->get_all_section_list();
		if($this->input->post()){
			$is_uopdate = $this->emp_model->update_employee($data['emp_data']['empid']);
			$this->session->set_flashdata('success',$this->lang->line('successfully_updated'));
			redirect('emp/information');
		}

		$this->load->view('layout/header');
		$this->load->view('pages/emp/information',$data);
		$this->load->view('layout/footer');
	}


	public function profile(){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->helper('security');
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['profile'] = $this->emp_model->employee_details($data['emp_data']['empid']);
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
						redirect('emp/information');
					}
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
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['office_orders'] = $this->emp_model->get_employee_office_orders($data['emp_data']['empid']);
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
					redirect('emp/application');
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/application',$data);
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
		$data['profile'] = $this->emp_model->employee_details($data['emp_data']['empid']);

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
			$data['leave_credit'] = $this->emp_model->get_employee_leave_credit($empid,$leave_type);
		}else{			
		// Code
		}
		
		$rh_for = date('Y-m-d',strtotime($this->input->post('leave_from')));
		$leave_applied = date('Y-m-d',strtotime($this->input->post('application_dt')));		
			

		$data['leave_application'] = $this->emp_model->fetch_employee_leave_application($data['emp_data']['empid']);
		if($this->input->post()){
			$this->form_validation->set_rules('balance_leave', 'Balance Leave', 'required|xss_clean',array('required'=> 'Insufficent Leave Balance.'));
			$this->form_validation->set_rules('c_image', 'Image Code', 'required|xss_clean',array('required'=> 'Please write image code'));
			if ($this->form_validation->run() == FALSE){
				$data['error'] = validation_errors();
			}else{				
				$cap_code = $this->session->userdata('cap_data');
				if($cap_code != $this->input->post('c_image')){
					$data['error'] = $this->lang->line('image_code_not_matched');
				}else{
					if(!empty($id)){ // edit
						$balance = $this->emp_model->update_employee_leave_debit($id);
						$cb_id = $this->emp_model->emp_leave_current_balance($data['emp_data']['empid'],$leave_type,$balance);
						$this->session->set_flashdata('success','Successfully updated.');
					}else{ // add
						if( $this->input->post('balance_leave') > 0 && $this->input->post('leave_day_no') > 0){
							if( $this->input->get('leave_type') == 'Restricted Holiday' &&  $leave_applied>$rh_for ){
								$this->session->set_flashdata('success','You cannot submit Restricted Holiday for previous day.');
							}else{
								$balance = $id = $this->emp_model->emp_leave_application($data['emp_data']['empid']);
								$cb_id = $this->emp_model->emp_leave_current_balance($data['emp_data']['empid'],$leave_type,$balance);
								$cr_id = $this->emp_model->emp_clrh_current_balance($data['emp_data']['empid'],$leave_type,$leave_cr_year,$balance);
								$this->session->set_flashdata('success','Successfully submitted.');
							}						
						}else{
							$this->session->set_flashdata('success','Insufficient Leave Balance OR enter No of Days to be deducted.');
						}
					}
					redirect(SITE_BASE_URL.'emp/leave_application_clrh');
				}
			}
		
		}			
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_application_clrh',$data);
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
		$data['authority'] = $this->emp_model->employee_details($data['emp_data']['empid']);
		$data['profile'] = $this->emp_model->employee_details($empid);	

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
						if($data['emp_data']['desig'] == 'SR. ACCOUNTS OFFICER' || $data['emp_data']['desig'] == 'DY. ACCOUNTANT GENERAL'){
							if(!empty($id)){ // edit
								$balance = $this->emp_model->update_employee_leave_debit($id);
								$cb_id = $this->emp_model->emp_leave_current_balance($empid,$leave_type,$balance);
								$this->session->set_flashdata('success','Successfully updated.');
							}else{ // add
								if( $this->input->post('balance_leave')>0 && $this->input->post('balance_leave')>=$this->input->post('leave_day_no')){
									$balance = $this->emp_model->emp_cl_leave_deduction($empid);
									$cb_id = $this->emp_model->emp_leave_current_balance($this->input->post('empid'),$leave_type,$balance);
									$this->session->set_flashdata('success','Successfully deducted.');
								}else{
									$this->session->set_flashdata('success','Insufficient Leave Balance.');
								}
							}
						}else{
							$this->session->set_flashdata('success','You are not authorised to deduct Casual Leave.');
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
		$this->load->model('emp_model');
		
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
			
		$id = $this->uri->segment(3);
		$data['error'] = '';
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['profile'] = $this->emp_model->employee_details($data['emp_data']['empid']);
		
		
		
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
		$leave_cr_year = $this->emp_model->fetch_employee_leave_application_leave_year($data['emp_data']['empid'],$id);
		$data['leave_balance'] = $this->emp_model->get_clrh_closing_balance($data['emp_data']['empid'],$leave_type,$leave_cr_year);

		if($this->input->post()){
			$balance = $this->input->post('balance_leave') - $this->input->post('leave_day_no');	
			$cb = $this->emp_model->update_employee_clrh_debit($id);
			$cb_id = $this->emp_model->emp_leave_current_balance($data['emp_data']['empid'],$leave_type,$balance);
			$cr_id = $this->emp_model->emp_clrh_current_balance($data['emp_data']['empid'],$leave_type,$leave_cr_year,$balance);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(SITE_BASE_URL.'emp/information');
		}	
	
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_application_clrh_edit',$data);
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
		
		if($this->input->post()){	
			$this->emp_model->emp_leave_sanction_clrh($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(SITE_BASE_URL.'emp/information');
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_sanction_clrh',$data);
		$this->load->view('layout/footer');
	}
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
			$data['leave_records'] = $this->emp_model->get_leave_pending_clrh($empid,$leave_type,$leave_dr_year);
		}else{			
//			$data['subs_details'] =[];		
		}	
		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_pending_clrh',$data);
		$this->load->view('layout/footer');
	}
	
	public function leave_application_clrh_print(){
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
		$data['profile'] = $this->emp_model->employee_details($data['emp_data']['empid']);
		$first_second_child = $this->input->get('first_second_child');
		$data['employees'] = $this->emp_model->get_authority_list();
		$data['members'] = $this->emp_model->get_family_member($data['emp_data']['empid'],$first_second_child);
//		print_r($data['members']);
//		exit;
		
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
		if($this->input->get('leave_type')){		
			$leave_type = $this->input->get('leave_type',true);			
			$data['leave_debits'] = $this->emp_model->get_employee_leave_debit($empid,$leave_type);
			$data['leave_balance'] = $this->emp_model->get_leave_current_balance($empid,$leave_type);
			$data['leave_credit'] = $this->emp_model->get_employee_leave_credit($empid,$leave_type);
		}else{			
		// Code
		}

		$data['leave_application'] = $this->emp_model->fetch_employee_leave_application($data['emp_data']['empid']);
			
		if($this->input->post()){
//		echo "<pre>";
//		print_r($_FILES);
//		print_r($_POST);
//		exit;
			$this->form_validation->set_rules('balance_leave', 'Balance Leave', 'required|xss_clean',array('required'=> 'Insufficent Leave Balance.'));
			$this->form_validation->set_rules('c_image', 'Image Code', 'required|xss_clean',array('required'=> 'Please write image code'));
			if ($this->form_validation->run() == FALSE){
				$data['error'] = validation_errors();
			}else{				
				$cap_code = $this->session->userdata('cap_data');
				if($cap_code != $this->input->post('c_image')){
					$data['error'] = $this->lang->line('image_code_not_matched');
				}else{
					
//-------------------------					
					if(isset($_FILES['link_file']) && $_FILES['link_file']['size'] > 0){
					//upload file
					$upload_details = $this->common_model->upload_file('link_file');
					
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
					}else{
//						$this->input->post('link_file',$upload_details['filename']);
						$_POST['link_file'] = $upload_details['filename'];
					}
					}					
//----------------------------	

$leave_applied=$this->input->post('leave_type');
$leave_days=$this->input->post('leave_day_no');
$leave_ground=$this->input->post('ground');
$leave_balan=$this->input->post('balance_leave');
$balance_left=$this->input->post('balance_leave')-$this->input->post('leave_day_no');
$leave_start= date('Y-m-d',strtotime($this->input->post('leave_from')));
$leave_end=date('Y-m-d',strtotime($this->input->post('leave_to')));
$avail_start=date('Y-m-d',strtotime($this->input->post('avail_from')));
$avail_by=date('Y-m-d',strtotime($this->input->post('avail_by')));
/*
//echo ($leave_start);
echo ($leave_end);			
//echo ($avail_start);
echo ($avail_by);

if(!empty($leave_days)){$leave_days=$leave_days;}else{$leave_days=0;};
if($leave_days<=0){
		echo 'can not submit';
//	$this->session->set_flashdata('success','Leave cannot be submitted without deduction value in Nos of Days.');
	}else{
		echo 'submit';
	}
exit;

if($avail_start <= $leave_start){
	echo 'can ';
}else{
	echo 'can not';
}

if($leave_end < $avail_by){
	echo 'can ';
}else{
	echo 'can not';
}
exit;
*/	
		
					if(!empty($id)){ // edit
						$balance=$this->emp_model->update_employee_leave_debit($id,$data['emp_data']['empid']);	
						// updating another table						
						$cb_id = $this->emp_model->emp_leave_current_balance($data['emp_data']['empid'],$leave_type,$balance);
						$this->session->set_flashdata('success','Successfully updated.');
					}else{ // add
						if($leave_balan > 0 && $leave_balan > $leave_days){
							if($leave_ground ='Leave Encashment' && $balance_left >= 30){
								if($leave_applied =='Child Care Leave' || $leave_applied =='Paternity Leave' || $leave_applied =='Maternity Leave'){
									if($avail_start <= $leave_start && $leave_end < $avail_by){
										//insert for above leave types
										$balance = $this->emp_model->emp_leave_application($data['emp_data']['empid']);
										// inserting to another table
										$cb_id = $this->emp_model->emp_leave_current_balance($data['emp_data']['empid'],$leave_type,$balance);
										$this->session->set_flashdata('success','Successfully submitted.');
									}else{
										$this->session->set_flashdata('success','Apply for the leave within the permissible period.');
									}
								}else{
									//insert for other leave types
									$balance = $this->emp_model->emp_leave_application($data['emp_data']['empid']);
									// inserting to another table
									$cb_id = $this->emp_model->emp_leave_current_balance($data['emp_data']['empid'],$leave_type,$balance);
									$this->session->set_flashdata('success','Successfully submitted.');
								}
							}else{
								$this->session->set_flashdata('success','Minimum 30 days of balance must be maintained after Leave Encashment');
							}
						}else{
							$this->session->set_flashdata('success','Insufficient Leave Balance.');
						}
					}
					redirect(SITE_BASE_URL.'emp/leave_application');
				}
			}
		
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_application',$data);
		$this->load->view('layout/footer');
	}
	
	public function leave_application_edit(){
		$this->load->model('emp_model');
		
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
			
		$id = $this->uri->segment(3);
		$data['error'] = '';
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['profile'] = $this->emp_model->employee_details($data['emp_data']['empid']);
		
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
//-------------------------					
					if(isset($_FILES['link_file']) && $_FILES['link_file']['size'] > 0){
					//upload file
					$upload_details = $this->common_model->upload_file('link_file');
					
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
					}else{
//						$this->input->post('link_file',$upload_details['filename']);
						$_POST['link_file'] = $upload_details['filename'];
					}
					}					
//----------------------------	
		$leave_type = $this->emp_model->fetch_employee_leave_application_leave_type($data['emp_data']['empid'],$id);
		$data['leave_balance'] = $this->emp_model->get_leave_current_balance($data['emp_data']['empid'],$leave_type);

		if($this->input->post()){	
			$balance = $this->emp_model->update_employee_leave_debit($id);
			$cb_id = $this->emp_model->emp_leave_current_balance($data['emp_data']['empid'],$leave_type,$balance);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(SITE_BASE_URL.'emp/information');
		}


		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_application_edit',$data);
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

		$data['row'] = array();
		$data['asign_emp'] = array();
		$data['leaves']=array();		
		if(!empty($id)){		
			$data['leaves'] = $this->emp_model->fetch_employee_leave_application_sanction($data['emp_data']['empid'],$id);
//print_r($data['leaves']);

			if(empty($data['leaves'])){
				show_404('admin');
			}
		}
		else{
			show_404('admin');
		}		
//echo $this->db->last_query();
//print_r($data);
		
		if($this->input->post()){	
			$this->emp_model->update_leave_application_sanction($id);
			$this->session->set_flashdata('success','Successfully updated.');
//			redirect(SITE_BASE_URL.'emp/leave_pending_sanction_all');
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
			$data['leaves'] = $this->emp_model->fetch_employee_leave_application_reco($data['emp_data']['empid'],$id);			
//  print_r($data['leaves']);
//  exit;
		if(empty($data['leaves'])){
				show_404('admin');
			}
		}
		else{
			echo "else";
			show_404('admin');
		}		
//	echo $this->db->last_query();
//	print_r($data);

		if($this->input->post()){	
			$this->emp_model->update_leave_application_recommendation($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(SITE_BASE_URL.'emp/information');
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_application_recommendation',$data);
		$this->load->view('layout/footer');
	}


	public function leave_application_print(){
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
			$data['subs_details'] =[];		
		}	
		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_pending_recommendation',$data);
		$this->load->view('layout/footer');
	}
	
	public function leave_pending_recommendation_all(){
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
	public function leave_pending_sanction_all(){
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
			$data['subs_details'] =[];		
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
			$data['subs_details'] =[];		
		}	
		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_joining_report',$data);
		$this->load->view('layout/footer');
	}
	
	public function leave_joining(){
		$this->load->model('emp_model');
		
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
			
		$id = $this->uri->segment(3);
		$data['error'] = '';
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['profile'] = $this->emp_model->employee_details($data['emp_data']['empid']);
		
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
			redirect(SITE_BASE_URL.'emp/information');
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_joining_approval',$data);
		$this->load->view('layout/footer');
	}
	public function leave_all(){
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
//		$empid= $this->input->get('empid');
$id = $this->uri->segment(3);
echo $id;
//exit;
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$empid=$data['emp_data']['empid'];
		$data['results'] = $this->emp_model->get_employee_all_leaves($empid);
		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_all',$data);
		$this->load->view('layout/footer');
	}
	
	public function leave_history(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_employee_leave_history($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'emp/leave_history';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;

		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		$this->load->view('layout/header');
		$this->load->view('pages/emp/leave_history',$data);
		$this->load->view('layout/footer');
	}	
	
	public function encashment_application(){
		$this->load->helper('security');
		
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
				
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['profile'] = $this->emp_model->employee_details($data['emp_data']['empid']);
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
		$this->load->helper('security');
		
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
				
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['profile'] = $this->emp_model->employee_details($data['emp_data']['empid']);
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
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['profile'] = $this->emp_model->employee_details($data['emp_data']['empid']);
		$data['bill_submit'] = $this->emp_model->get_employee_bill_submit($data['emp_data']['empid']);
		if($this->input->post()){
			$this->form_validation->set_rules('c_image', 'Image Code', 'required|xss_clean',array('required'=> 'Please write image code'));
			if ($this->form_validation->run() == FALSE){
               $data['error'] = validation_errors();
            }else{
				$cap_code = $this->session->userdata('cap_data');
				if($cap_code != $this->input->post('c_image')){
					$data['error'] = $this->lang->line('image_code_not_matched');
				}else{
					$reg_status = $this->emp_model->emp_bill_submit($data['emp_data']['empid']);
					$this->session->set_flashdata('success','Your application successfully sent.');
					redirect('emp/bill_submit');
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/bill_submit',$data);
		$this->load->view('layout/footer');
	}
	
	
	
//--------------------TEST APPLICATION

public function test_application(){
		$this->load->helper('security');
		
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
				
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['profile'] = $this->emp_model->employee_details($data['emp_data']['empid']);
		$data['test_application'] = $this->emp_model->get_test_application($data['emp_data']['empid']);
		
		if($this->input->post()){
			$this->form_validation->set_rules('c_image', 'Image Code', 'required|xss_clean',array('required'=> 'Please write image code'));
			if ($this->form_validation->run() == FALSE){
               $data['error'] = validation_errors();
            }else{
				$cap_code = $this->session->userdata('cap_data');
				if($cap_code != $this->input->post('c_image')){
					$data['error'] = $this->lang->line('image_code_not_matched');
				}else{
					$reg_status = $this->emp_model->emp_test_application($data['emp_data']['empid']);
					$this->session->set_flashdata('success','Your application successfully sent.');
					redirect('emp/test_application');
				}
			}
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp/test_application',$data);
		$this->load->view('layout/footer');
	}
//-------------------
	
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

	public function circular(){
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
	public function epabx(){
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

	public function leave_credit(){
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
		$this->load->view('pages/emp/leave_credit',$data);
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
			$data['subs_details'] =[];		
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
			$data['subs_details'] =[];		
		}		
		$this->load->view('layout/header');
		$this->load->view('pages/emp/bill_details',$data);
		$this->load->view('layout/footer');
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
			$data['subs_details'] =[];		
		}		
		$this->load->view('layout/header');
		$this->load->view('pages/emp/training_details',$data);
		$this->load->view('layout/footer');
	}
	
	public function training_details_all(){
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
//echo $this->db->last_query();
//print_r($data);
//exit;
		$config['base_url'] = base_url().'emp/training_details_all';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;

		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		$this->load->view('layout/header');
		$this->load->view('pages/emp/training_details_all',$data);
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
			$data['subs_details'] =[];		
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
		$arr_feed['id'] 	= $this->session->userdata('emp_data')['empid'];
		$arr_feed['name'] 	= $this->session->userdata('emp_data')['empname'];
		$arr_feed['mobile'] = $this->session->userdata('emp_data')['mbno'];
		$arr_feed['email']  = trim($this->session->userdata('emp_data')['nicmail']) == '' ? $this->session->userdata('emp_data')['email'] : $this->session->userdata('emp_data')['nicmail'];
		$this->session->set_userdata('user_details_for_feedback',$arr_feed);
		$this->session->unset_userdata('emp_data');
		$this->session->set_flashdata('success',$this->lang->line('give_your_feedback'));
		redirect('feedback');
		$this->load->view('layout/header');
		$this->load->view('pages/emp/login',$data);
		$this->load->view('layout/footer');
	}
	
/*	-----For training order PDF dwonload

	public function training_order_print() { 
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
		
		$html = $this->load->view('pages/emp/training_order_print',$data,true);//load the pdf_output.php by passing our data and get all data in $html varriable.
		$pdfFilePath ="Training_Order".time().".pdf";
		$pdf = $this->m_pdf->generate();
		
		$pdf->WriteHTML($html);
		$pdf->Output($pdfFilePath, "D");
		//$pdf->Output();
    }
*/		
	public function training_order_print(){
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
	
	public function incometax(){
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
		$data['profile'] = $this->emp_model->employee_details($data['emp_data']['empid']);
		
		
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
	
}// End of Class
