<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ddo extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->lang->load('main','english');
		$this->load->model('gpf_model');
		if($this->session->userdata('language_id')){
			$this->language_id = $this->session->userdata('language_id');
		}else{
			$this->language_id = 1;
		}
		
	}
	public function login(){
		if($this->session->userdata('ddo_data')){
			redirect('ddo/dashboard');
		}
		$this->load->helper('security');
		
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		$data['series_codes'] = $this->gpf_model->get_all_series_code();
		if($this->input->post()){
			$this->form_validation->set_rules('ddo_code', 'DDO User Id', 'required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
			$this->form_validation->set_rules('c_image', 'Image Code', 'required|xss_clean',array('required'=> 'Please write image code'));
			if ($this->form_validation->run() == FALSE){
               $data['error'] = validation_errors();
            }else{
				$cap_code = $this->session->userdata('cap_data');
				if($cap_code != $this->input->post('c_image')){
					$data['error'] = $this->lang->line('image_code_not_matched');
				}else{
					$code = $this->input->post('ddo_code',true);
					$pass = $this->input->post('password',true);
					$login_details = $this->gpf_model->ddo_login($code,$pass);
					if(empty($login_details)){
						$data['error'] = $this->lang->line('wrong_credentials');
					}else{
						$this->session->set_userdata('ddo_data',$login_details);
						$is_uopdate = $this->gpf_model->update_ddo_last_login($code);
						$this->session->set_flashdata('success',$this->lang->line('successfully_logged_in'));
						redirect('ddo/dashboard');
					}
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/ddo/login',$data);
		$this->load->view('layout/footer');
	}
	public function registration(){
		if($this->session->userdata('ddo_data')){
			redirect('ddo/dashboard');
		}
		$this->load->helper('security');
		
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		if($this->input->post()){
			$this->form_validation->set_rules('ddo_code', 'DDO User Id', 'required|xss_clean');
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
					$reg_status = $this->gpf_model->ddo_registration();
					if($reg_status['success'] === false){
						$data['error'] = $reg_status['msg'];
					}else{
						$ddo_details = $reg_status['details'];
						$this->session->set_userdata('ddo_reg',$ddo_details['ddo_cd']);
						$email = '';
						$mobile = '';
						if(!empty($ddo_details['emailid'])){
							$email = $ddo_details['emailid'];
						}
						if(!empty($ddo_details['mb_no'])){
							$mobile = $ddo_details['mb_no'];
						}
						send_OTP($email,$mobile); // from helper
						$this->session->set_flashdata('success',$this->lang->line('OTP_sent_to_mobile_email'));
						redirect('ddo/otp');
					}
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/ddo/registration',$data);
		$this->load->view('layout/footer');
	}
	public function forgot_password(){
		if($this->session->userdata('ddo_data')){
			redirect('ddo/dashboard');
		}
		$this->load->helper('security');
		
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		if($this->input->post()){
			$this->form_validation->set_rules('ddo_code', 'DDO Code', 'required|xss_clean');
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
					$reg_status = $this->gpf_model->ddo_forgot_password();
					if($reg_status['success'] === false){
						$data['error'] = $reg_status['msg'];
					}else{
						$ddo_details = $reg_status['details'];
						$this->session->set_userdata('ddo_reg',$ddo_details['ddo_cd']);
						$email = '';
						$mobile = '';
						if(!empty($ddo_details['emailid'])){
							$email = $ddo_details['emailid'];
						}
						if(!empty($ddo_details['mb_no'])){
							$mobile = $ddo_details['mb_no'];
						}
						send_OTP($email,$mobile); // from helper
						$this->session->set_flashdata('success',$this->lang->line('OTP_sent_to_mobile_email'));
						redirect('ddo/otp');
					}
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/ddo/forgot_password',$data);
		$this->load->view('layout/footer');
	}
	public function otp(){
		if($this->session->userdata('ddo_data')){
			redirect('ddo/dashboard');
		}
		if(!$this->session->userdata('ddo_reg')){
			//show_404();
		}
		if(!$this->session->has_userdata('agot')){
			//show_404();
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
						$this->session->set_userdata('nxt_pg','ddo_re_pass');
						$this->session->set_flashdata('success',$this->lang->line('OTP_matched_reset_pass'));
						redirect('ddo/reset_password');
					}
				//}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/ddo/otp',$data);
		$this->load->view('layout/footer');
	
	}
	public function reset_password(){
		if($this->session->userdata('ddo_data')){
			redirect('ddo/dashboard');
		}
		if(!$this->session->userdata('ddo_reg')){
			//show_404();
		}
		if($this->session->userdata('nxt_pg') && $this->session->userdata('nxt_pg') == 'ddo_re_pass'){
			
		}else{
			//show_404();
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
					$ddo_code = $this->session->userdata('ddo_reg');
					$pass = $this->input->post('pass',true);
					$this->gpf_model->ddo_reset_password($ddo_code,$pass);
					$this->session->set_flashdata('success',$this->lang->line('password_updated_login_now'));
					$this->session->unset_userdata('nxt_pg');
					redirect('ddo/login');
			//	}
			}
		}
		//$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/ddo/reset_password',$data);
		$this->load->view('layout/footer');
	}
	public function dashboard(){
		if(!$this->session->userdata('ddo_data')){
			redirect('ddo/login');
		}
		$data['ddo_data'] = $this->session->userdata('ddo_data');
		$data['header']['name'] = $data['ddo_data']['ddo_cd'];
		$data['subscribers'] = $this->gpf_model->get_ddo_subscribers($data['ddo_data']['ddo_cd']);
		$this->load->view('layout/header');
		$this->load->view('pages/ddo/dashboard',$data);
		$this->load->view('layout/footer');
	}
	
	
	public function acnt_stat() { 
		if(!$this->session->userdata('ddo_data')){
			redirect('ddo/login');
		}
		$this->load->library('m_pdf');
		$ac_code = $this->input->get('ac_code',true);
		$series = $this->input->get('series',true);
		$year = date('Y-m-d',strtotime($this->input->get('fyear',true)));
		$data['f_year'] = date('d/m/Y',strtotime($year));
		$data['subscribers_data'] = $this->gpf_model->get_subscriber_data($ac_code,$series);
		$data['part_1'] = $this->gpf_model->get_subscribers_part_1($ac_code,$series,$year);
		$data['part_2'] = $this->gpf_model->get_subscribers_part_2($ac_code,$series,$year);
		$data['part_3'] = $this->gpf_model->get_subscribers_part_3($ac_code,$series,$year);
		$data['part_4'] = $this->gpf_model->get_subscribers_part_4($ac_code,$series,$year);
		if(empty($data['part_1'])){
			show_404();
		}
		$html = $this->load->view('pages/subs/account_statement_pdf',$data, true); //load the pdf_output.php by passing our data and get all data in $html varriable.
		$pdfFilePath ="ac_statement_".$series."_".$ac_code.'_'.str_replace('-','_',$year).'_'.time().".pdf";
		$pdf = $this->m_pdf->generate();
		$pdf->SetWatermarkText('THIS IS FOR INFORMATION ONLY');
		$pdf->watermark_font = 'DejaVuSansCondensed';
		$pdf->showWatermarkText = true;
		$pdf->WriteHTML($html,0);
		$pdf->Output($pdfFilePath, "D");
		//$pdf->Output();
    }
	public function profile(){
		if(!$this->session->userdata('ddo_data')){
			redirect('ddo/login');
		}
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->helper('security');
		$data['ddo_data'] = $this->session->userdata('ddo_data');
		$data['header']['name'] = $data['ddo_data']['ddo_cd'];
		$data['profile'] = $this->gpf_model->get_ddo_profile($data['ddo_data']['ddo_cd']);
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
					$is_uopdate = $this->gpf_model->update_ddo_profile($data['ddo_data']['ddo_cd']);
					if($is_uopdate){
						$this->session->set_flashdata('success',$this->lang->line('successfully_updated'));
						redirect('ddo/profile');
					}
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/ddo/profile',$data);
		$this->load->view('layout/footer');
	}
	public function fp_authority($series = '',$ac_code=''){
		$this->load->library('m_pdf');
		if(!$this->session->userdata('ddo_data')){
			redirect('ddo/login');
		}
		$data['ddo_data'] = $this->session->userdata('ddo_data');
		// authinticate
		$data['fpa'] = $this->gpf_model->ddo_fp_authority($data['ddo_data']['ddo_cd'],$ac_code,$series);
		if(empty($data['fpa'])){
			show_404();
		}
		$data['fpa1'] = isset($data['fpa'][0]) ? $data['fpa'][0] : array();
		$data['fpa2'] = isset($data['fpa'][1]) ? $data['fpa'][1] : array();
		$data['nominees'] = $this->gpf_model->get_final_payment_nominee($data['fpa1']['authority_no']);
		$html = $this->load->view('pages/subs/final_payment_authority_pdf',$data, true); //load the pdf_output.php by passing our data and get all data in $html varriable.
		$pdfFilePath ="fp_authority_".$series."_".$ac_code."_".time().".pdf";
		$pdf = $this->m_pdf->generate();
		$pdf->SetWatermarkText('THIS IS FOR INFORMATION ONLY');
		$pdf->watermark_font = 'DejaVuSansCondensed';
		$pdf->showWatermarkText = true;
		$pdf->WriteHTML($html,0);
		$pdf->Output($pdfFilePath, "D");
		//$pdf->Output();
	}
	public function logout(){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$arr_feed['id'] 	= $this->session->userdata('ddo_data')['ddo_cd'];
		$arr_feed['name'] 	= $this->session->userdata('ddo_data')['ddo_desc'];
		$arr_feed['mobile'] = $this->session->userdata('ddo_data')['mb_no'];
		$arr_feed['email']  = $this->session->userdata('ddo_data')['emailid'];
		$this->session->set_userdata('user_details_for_feedback',$arr_feed);
		$this->session->unset_userdata('ddo_data');
		$this->session->set_flashdata('success',$this->lang->line('give_your_feedback'));
		redirect('feedback');
		$this->load->view('layout/header');
		$this->load->view('pages/ddo/login',$data);
		$this->load->view('layout/footer');
	}
	
	public function application_document(){
		$this->load->model('wing_model');
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		if(!$this->session->userdata('ddo_data')){
			redirect('ddo/login');
		}
		$data['error'] = '';
		$data['ddo_data'] = $this->session->userdata('ddo_data');
		$data['header']['name'] = $data['ddo_data']['ddo_cd'];
		$data['profile'] = $data['ddo_data'];
		$users= $data['ddo_data']['ddo_cd'];
		$user_desc= $data['ddo_data']['ddo_desc'];
//		$data['treasury_list'] = $this->accounts_model->get_treasury_name($users);
		$data['series_codes'] = $this->gpf_model->get_all_series_code();
			
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
			$this->form_validation->set_rules('sub_series', 'Sub_series', 'required');
			$this->form_validation->set_rules('sub_ac_code', 'Sub_ac_code', 'required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				$update = array(
							'ddo_cd'		=> $users,
							'ddo_desptn'	=> $user_desc,
							'drec_year'		=> $this->input->post('drec_year',true),
							'drec_month'	=> $this->input->post('drec_month',true),
							'sub_ifms_id'	=> $this->input->post('sub_ifms_id',true),
							'sub_name'	=> $this->input->post('sub_name',true),
							'sub_series'	=> $this->input->post('sub_series'),
							'sub_ac_code'	=> $this->input->post('sub_ac_code',true),
							'sub_mbno'		=> $this->input->post('sub_mbno'),
							'drec_type'		=> $this->input->post('drec_type',true),
							'doc_desc'		=> $this->input->post('doc_desc'),
//							'report_due_date'	=>  date('Y-m-d',strtotime($this->input->post('report_due_date'))),
							'ddo_official_name'		=> $this->input->post('ddo_official_name'),
							'ddo_official_desig'	=> $this->input->post('ddo_official_desig'),
							'ddo_official_contact'	=> $this->input->post('ddo_official_contact'),
							'drecd_status'	=> 'Submitted',
							'upload_dt'	=> date('Y-m-d H:i:s')
						);
				//------------------- upload file				
						if(isset($_FILES['ddo_attachment']) && $_FILES['ddo_attachment']['size'] > 0){
						//upload file
						$upload_details = $this->common_model->upload_department_files('ddo_attachment'); //SINGLE FILE UPLOAD
						//print_r ($upload_details);										
						if(!$upload_details['is_success']){
							$this->session->set_flashdata('error',$upload_details['message']);
							$error = $upload_details['message'];
						}else{
//							$this->input->post('ddo_attachment',$upload_details['filename']);
							$update['ddo_attachment'] = $upload_details['filename'];
						}
						}

				if($error == ''){
					if(!empty($id)){ // edit
						$result = $this->gpf_model->update_ddo_files_record($id,$update);
						$this->session->set_flashdata('success','Successfully updated.');
					}else{ // add
						$update['upload_dt'] = date('Y-m-d H:i:s');
						$id = $this->gpf_model->add_ddo_files_record($update);
						$this->session->set_flashdata('success','Successfully added.');
					}
					redirect(SITE_BASE_URL.'ddo/dashboard');
				}
			}
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/ddo/application_document',$data);
		$this->load->view('layout/footer');
	}
		
	public function all_gpf_acnos(){
		$this->load->library('pagination');
		if(!$this->session->userdata('ddo_data')){
			redirect('ddo/login');
		}
		$data['ddo_data'] = $this->session->userdata('ddo_data');
		$data['header']['name'] = $data['ddo_data']['ddo_cd'];
		
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;		
		$response = $this->gpf_model->get_ddo_gpfacno_all($page_no, $data['ddo_data']['ddo_cd']);	
		$data['results'] = $response['results'];

		$config['base_url'] = base_url().'ddo/all_gpf_acnos';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;	
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		
		$this->load->view('layout/header');
		$this->load->view('pages/ddo/all_gpf_acnos',$data);
		$this->load->view('layout/footer');
	}
	public function all_nominations(){
		$this->load->library('pagination');
		if(!$this->session->userdata('ddo_data')){
			redirect('ddo/login');
		}
		$data['ddo_data'] = $this->session->userdata('ddo_data');
		$data['header']['name'] = $data['ddo_data']['ddo_cd'];
		
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;		
		$response = $this->gpf_model->get_ddo_nominations_all($page_no, $data['ddo_data']['ddo_cd']);	
		$data['results'] = $response['results'];

		$config['base_url'] = base_url().'ddo/all_nominations';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;	
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		
		$this->load->view('layout/header');
		$this->load->view('pages/ddo/all_nominations',$data);
		$this->load->view('layout/footer');
	}
	public function all_adjustments(){
		$this->load->library('pagination');
		if(!$this->session->userdata('ddo_data')){
			redirect('ddo/login');
		}
		$data['ddo_data'] = $this->session->userdata('ddo_data');
		$data['header']['name'] = $data['ddo_data']['ddo_cd'];
		
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;		
		$response = $this->gpf_model->get_ddo_missings_all($page_no, $data['ddo_data']['ddo_cd']);	
		$data['results'] = $response['results'];

		$config['base_url'] = base_url().'ddo/all_adjustments';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;	
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		
		$this->load->view('layout/header');
		$this->load->view('pages/ddo/all_adjustments',$data);
		$this->load->view('layout/footer');
	}
	public function subscriber_ddo(){
		$this->load->library('pagination');
		if(!$this->session->userdata('ddo_data')){
			redirect('ddo/login');
		}
		$data['ddo_data'] = $this->session->userdata('ddo_data');
		$data['header']['name'] = $data['ddo_data']['ddo_cd'];
		$response = '';
		$data['series_codes'] = $this->gpf_model->get_all_series_code();
		
		if($this->input->get('series')){		
			$series = $this->input->get('series',true);	
			$ac_code = $this->input->get('ac_code',true);	
			$data['subs_details'] = $this->gpf_model->get_subscriber_cur_ddo($series,$ac_code);
		}

		$this->load->view('layout/header');
		$this->load->view('pages/ddo/subscriber_ddo',$data);
		$this->load->view('layout/footer');
	}
	public function subscriber_ddo_update(){
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->library('pagination');
		if(!$this->session->userdata('ddo_data')){
			redirect('ddo/login');
		}
		$data['ddo_data'] = $this->session->userdata('ddo_data');
		$data['header']['name'] = $data['ddo_data']['ddo_cd'];
		$response = '';
		$data['series_codes'] = $this->gpf_model->get_all_series_code();
		$data['profile'] = $data['ddo_data'];
		$id = $this->uri->segment(3);
		$data['row'] = array();
		$data['records']=array();		
		if(!empty($id)){		
			$data['records'] = $this->gpf_model->get_subscriber_by_id($id);		
			if(empty($data['records'])){
				show_404('admin');
			}
		}
		else{
			show_404('admin');
		}

		if($this->input->post()){		
			$this->gpf_model->updatesubscriber_ddo_record($id,$users);
			$this->session->set_flashdata('success','Successfully submitted.');
			redirect(SITE_BASE_URL.'ddo/subscriber_ddo');
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/ddo/subscriber_ddo_update',$data);
		$this->load->view('layout/footer');
	}
	
}// End of Class
