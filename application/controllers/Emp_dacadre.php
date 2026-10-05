<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emp_dacadre extends CI_Controller {
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
		if($this->session->has_userdata('emp_dacadre_data')){
			redirect('emp_dacadre/information');
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
					$login_details = $this->emp_model->employee_dacadare_login($emp_id,$pass);
					
					if(empty($login_details)){
						$data['error'] = $this->lang->line('wrong_credentials');
					}else{
						$this->session->set_userdata('emp_dacadre_data',$login_details);
						$is_uopdate = $this->emp_model->update_employee_last_login($emp_id);
						$this->session->set_flashdata('success',$this->lang->line('successfully_logged_in'));
						redirect('emp_dacadre/information');
					}
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp_dacadre/login',$data);
		$this->load->view('layout/footer');
	}
	
	public function registration(){
		if($this->session->has_userdata('emp_dacadre_data')){
			redirect('emp_dacadre/information');
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
					$reg_status = $this->emp_model->employee_registration('AGAE');
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
						redirect('emp_dacadre/otp');
					}
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp_dacadre/registration',$data);
		$this->load->view('layout/footer');
	}
	public function forgot_password(){
		if($this->session->has_userdata('emp_dacadre_data')){
			redirect('emp_dacadre/information');
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
					$reg_status = $this->emp_model->employee_forgot_password('AGAE');
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
						redirect('emp_dacadre/otp');
					}
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp_dacadre/forgot_password',$data);
		$this->load->view('layout/footer');
	}
	public function otp(){
		if($this->session->has_userdata('emp_dacadre_data')){
			redirect('emp_dacadre/information');
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
						redirect('emp_dacadre/reset_password');
					}
				//}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp_dacadre/otp',$data);
		$this->load->view('layout/footer');
	
	}
	public function reset_password(){
		if($this->session->has_userdata('emp_dacadre_data')){
			redirect('emp_dacadre/information');
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
					redirect('emp_dacadre/login');
			//	}
			}
		}
		//$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp_dacadre/reset_password',$data);
		$this->load->view('layout/footer');
	}
	
	public function dashboard(){
		if(!$this->session->has_userdata('emp_dacadre_data')){
			redirect('emp_dacadre/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_dacadre_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$this->load->view('layout/header');
		$this->load->view('pages/emp_dacadre/dashboard',$data);
		$this->load->view('layout/footer');
	}
	public function information(){
		if(!$this->session->has_userdata('emp_dacadre_data')){
			redirect('emp_dacadre/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_dacadre_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['profile'] = $this->emp_model->employee_details($data['emp_data']['empid'],'AGAE');
		$this->load->view('layout/header');
		$this->load->view('pages/emp_dacadre/information',$data);
		$this->load->view('layout/footer');
	}
	public function profile(){
		if(!$this->session->has_userdata('emp_dacadre_data')){
			redirect('emp_dacadre/login');
		}
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->helper('security');
		$data['emp_data'] = $this->session->userdata('emp_dacadre_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['profile'] = $this->emp_model->employee_details($data['emp_data']['empid'],'AGAE');
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
						redirect('emp_dacadre/information');
					}
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp_dacadre/profile',$data);
		$this->load->view('layout/footer');
	}
	
	public function circular(){
		if(!$this->session->has_userdata('emp_dacadre_data')){
			redirect('emp_dacadre/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_dacadre_employee_circular($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'emp_dacadre/circular';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;
		
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		$this->load->view('layout/header');
		$this->load->view('pages/emp_dacadre/circular',$data);
		$this->load->view('layout/footer');
	}	
	
	public function documents(){
		if(!$this->session->userdata('emp_dacadre_data')){
			redirect('emp_dacadre/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_dacadre_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['office_orders'] = $this->emp_model->get_dacadare_employee_office_orders($data['emp_data']['empid']);
		$this->load->view('layout/header');
		$this->load->view('pages/emp_dacadre/documents',$data);
		$this->load->view('layout/footer');
	}
	
	public function service_book(){
		if(!$this->session->userdata('emp_dacadre_data')){
			redirect('emp_dacadre/login');
		}
		$data['emp_data'] = $this->session->userdata('emp_dacadre_data');
		$data['header']['name'] = $data['emp_data']['empname'];
		$data['office_orders'] = $this->emp_model->get_employee_service_book($data['emp_data']['empid']);
		$this->load->view('layout/header');
		$this->load->view('pages/emp_dacadre/service_book',$data);
		$this->load->view('layout/footer');
	}
	
	public function application(){
		if(!$this->session->userdata('emp_dacadre_data')){
			redirect('emp_dacadre/login');
		}
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		$data['emp_data'] = $this->session->userdata('emp_dacadre_data');
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
					redirect('emp_dacadre/application');
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp_dacadre/application',$data);
		$this->load->view('layout/footer');
	}

	
	public function logout(){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$arr_feed['id'] 	= $this->session->userdata('emp_dacadre_data')['empid'];
		$arr_feed['name'] 	= $this->session->userdata('emp_dacadre_data')['empname'];
		$arr_feed['mobile'] = $this->session->userdata('emp_dacadre_data')['mbno'];
		$arr_feed['email']  = trim($this->session->userdata('emp_dacadre_data')['nicmail']) == '' ? $this->session->userdata('emp_dacadre_data')['email'] : $this->session->userdata('emp_dacadre_data')['nicmail'];
		$this->session->set_userdata('user_details_for_feedback',$arr_feed);
		if(!$this->session->userdata('emp_dacadre_data')){
			redirect('emp_dacadre/login');
		}else{
			$this->session->unset_userdata('emp_dacadre_data');
			$this->session->set_flashdata('success',$this->lang->line('give_your_feedback'));
			redirect('feedback');
		}
		$this->session->set_flashdata('success',$this->lang->line('give_your_feedback'));
		redirect('feedback');
		$this->load->view('layout/header');
		$this->load->view('pages/emp_dacadre/login',$data);
		$this->load->view('layout/footer');
	}
	
	public function training_details(){
		if(!$this->session->userdata('emp_dacadre_data')){
			redirect('emp_dacadre/login');
		}
		$data['emp_dacadre_data'] = $this->session->userdata('emp_dacadre_data');
		$data['header']['name'] = $data['emp_dacadre_data']['empname'];		
		$empid = $data['emp_dacadre_data']['empid'];
		if($this->input->get('records')){		
			$training_type = $this->input->get('records',true);			
			$data['office_orders'] = $this->emp_model->get_employee_training_detail($empid,$training_type);
		}else{			
//			$data['subs_details'] =[];		
		}		
		$this->load->view('layout/header');
		$this->load->view('pages/emp_dacadre/training_details',$data);
		$this->load->view('layout/footer');
	}
	public function faculty_details(){
		if(!$this->session->userdata('emp_dacadre_data')){
			redirect('emp_dacadre/login');
		}
		$data['emp_dacadre_data'] = $this->session->userdata('emp_dacadre_data');
		$data['header']['name'] = $data['emp_dacadre_data']['empname'];		
		$empid = $data['emp_dacadre_data']['empid'];
		if($this->input->get('records')){		
			$training_type = $this->input->get('records',true);			
			$data['office_orders'] = $this->emp_model->get_employee_training_faculty_detail($empid,$training_type);
		}else{			
//			$data['subs_details'] =[];		
		}		
		$this->load->view('layout/header');
		$this->load->view('pages/emp_dacadre/faculty_details',$data);
		$this->load->view('layout/footer');
	}
	
	public function training_feedback(){
		if(!$this->session->userdata('emp_dacadre_data')){
			redirect('emp_dacadre/login');
		}
		$this->load->helper('security');
		
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['emp_dacadre_data'] = $this->session->userdata('emp_dacadre_data');
		$data['header']['name'] = $data['emp_dacadre_data']['empname'];
		$data['error'] = '';
		$id = $this->uri->segment(3);
		$data['profile'] = $this->emp_model->employee_details($data['emp_dacadre_data']['empid']);
		$data['details'] = $this->emp_model->training_detail_feedback($id,$data['emp_dacadre_data']['empid']);
		if(empty($data['details'])){
				show_404('admin');
		}

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
					$this->emp_model->emp_training_feedback_status_update($id,$data['emp_dacadre_data']['empid']);
					$this->session->set_flashdata('success','Your feedback successfully submitted.');
					redirect('emp_dacadre/training_details');
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/emp_dacadre/training_feedback',$data);
		$this->load->view('layout/footer');
	}
	
	public function training_order_download() { 
		if(!$this->session->has_userdata('emp_dacadre_data')){
			redirect('emp_dacadre/login');
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
		
		$html = $this->load->view('pages/emp_dacadre/training_order_download',$data,true);//load the pdf_output.php by passing our data and get all data in $html varriable.
		
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
	
	public function faculty_order_download() { 
		if(!$this->session->has_userdata('emp_dacadre_data')){
			redirect('emp_dacadre/login');
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
		$html = $this->load->view('pages/emp_dacadre/faculty_order_download',$data,true);//load the pdf_output.php by passing our data and get all data in $html varriable.
		
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
	
}// End of Class
