<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subs extends CI_Controller {
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
/*	
	public function login(){
		if($this->session->userdata('subscribers_data')){
			redirect('subs/dashboard');
		}
		$this->load->helper('security');
		
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		$data['series_codes'] = $this->gpf_model->get_all_series_code();
		if($this->input->post()){
			$this->form_validation->set_rules('series', 'Series Code', 'required|xss_clean');
			$this->form_validation->set_rules('gpf_account', 'GPF No', 'required|integer|xss_clean');
			$this->form_validation->set_rules('dob', 'Date of Birth', 'required|regex_match[/^[0-9]{2}-[0-9]{2}-[0-9]{4}$/]|xss_clean');
			$this->form_validation->set_rules('c_image', 'Image Code', 'required|xss_clean',array('required'=> 'Please write image code'));
			if ($this->form_validation->run() == FALSE){
               $data['error'] = validation_errors();
            }else{
				$cap_code = $this->session->userdata('cap_data');
				if($cap_code != $this->input->post('c_image')){
					$data['error'] = $this->lang->line('image_code_not_matched');
				}else{
					$series = $this->input->post('series');
					$gpf_account = $this->input->post('gpf_account');
					$dob = $this->input->post('dob');
					$res = $this->gpf_model->subscriber_login($gpf_account,$series,$dob);
					if($res['success'] === false){
						$data['error'] = $res['msg'];
					}else{
						$login_details = $res['details'];
						$this->session->set_userdata('subs_login',$login_details['subs_id']);
						$email = '';
						$mobile = '';
						if(!empty($login_details['email_id'])){
							$email = $login_details['email_id'];
						}
						if(!empty($login_details['mobile_no'])){
							$mobile = $login_details['mobile_no'];
						}
						send_OTP($email,$mobile); // from helper
						$this->session->set_flashdata('success',$this->lang->line('OTP_sent_to_mobile_email'));
						redirect('subs/otp');
					}
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/subs/login',$data);
		$this->load->view('layout/footer');
	}
*/
	public function forgot_password(){
		if($this->session->userdata('subscribers_data')){
			redirect('subs/dashboard');
		}
		$this->load->helper('security');
		
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		$data['series_codes'] = $this->gpf_model->get_all_series_code();
		if($this->input->post()){
			$this->form_validation->set_rules('series', 'Series Code', 'required|xss_clean');
			$this->form_validation->set_rules('gpf_account', 'GPF No', 'required|integer|xss_clean');
			$this->form_validation->set_rules('dob', 'Date of Birth', 'required|regex_match[/^[0-9]{2}-[0-9]{2}-[0-9]{4}$/]|xss_clean');
			$this->form_validation->set_rules('c_image', 'Image Code', 'required|xss_clean',array('required'=> 'Please write image code'));
			if ($this->form_validation->run() == FALSE){
               $data['error'] = validation_errors();
            }else{
				$cap_code = $this->session->userdata('cap_data');
				if($cap_code != $this->input->post('c_image')){
					$data['error'] = $this->lang->line('image_code_not_matched');
				}else{
					$series = $this->input->post('series');
					$gpf_account = $this->input->post('gpf_account');
					$dob = $this->input->post('dob');
					$login_allowed = $this->gpf_model->subscriber_login_allowed($gpf_account,$series,$dob);			
					if($login_allowed['account_active'] == 'No'){
						$this->session->set_flashdata('error','You are not allowed to login');
					}else{
						$res = $this->gpf_model->subscriber_login($gpf_account,$series,$dob);
						if($res['success'] === false){
							$data['error'] = $res['msg'];
						}else{
							$login_details = $res['details'];
							$this->session->set_userdata('subs_login',$login_details['subs_id']);
							$email = '';
							$mobile = '';
							if(!empty($login_details['email_id'])){
								$email = $login_details['email_id'];
							}
							if(!empty($login_details['mobile_no'])){
								$mobile = $login_details['mobile_no'];
							}
							send_OTP($email,$mobile); // from helper
							$this->session->set_flashdata('success',$this->lang->line('OTP_sent_to_mobile_email'));
							redirect('subs/otp');
						}
					}
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/subs/forgot_password',$data);
		$this->load->view('layout/footer');
	}
	public function otp(){
		if($this->session->userdata('subscribers_data')){
			redirect('subs/dashboard');
		}
		if(!$this->session->has_userdata('subs_login')){
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
						$subs_id = $this->session->userdata('subs_login');
						$login_details = $this->gpf_model->get_subscriber_details($subs_id);
						$this->session->set_userdata('subscribers_data',$login_details);
						$this->session->set_flashdata('success',$this->lang->line('successfully_logged_in'));
						redirect('subs/profile');
					}
				//}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/subs/otp',$data);
		$this->load->view('layout/footer');
	}
	public function login(){
		if($this->session->userdata('subscribers_data')){
			redirect('subs/dashboard');
		}
		$this->load->helper('security');
/*
		$hrs = date('H');
		if($hrs >= 12 && $hrs <= 16){
			redirect('subs/login_down');
		}
*/
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		$data['series_codes'] = $this->gpf_model->get_all_series_code();
		if($this->input->post()){
			$this->form_validation->set_rules('series', 'Series Code', 'required|xss_clean');
			$this->form_validation->set_rules('gpf_account', 'GPF No', 'required|integer|xss_clean');
			$this->form_validation->set_rules('dob', 'Date of Birth', 'required|regex_match[/^[0-9]{2}-[0-9]{2}-[0-9]{4}$/]|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'required|xss_clean');
			$this->form_validation->set_rules('c_image', 'Image Code', 'required|xss_clean',array('required'=> 'Please write image code'));
			if ($this->form_validation->run() == FALSE){
               $data['error'] = validation_errors();
            }else{
				$cap_code = $this->session->userdata('cap_data');
				if($cap_code != $this->input->post('c_image')){
					$data['error'] = $this->lang->line('image_code_not_matched');
				}else{
					$series = $this->input->post('series',true);
					$gpf_account = $this->input->post('gpf_account',true);
					$dob = $this->input->post('dob',true);
					$pass = $this->input->post('password',true);
					$login_allowed = $this->gpf_model->subscriber_login_allowed($gpf_account,$series,$dob);
					if($login_allowed['account_active'] == 'No'){
						$this->session->set_flashdata('error','You are not allowed to login');
					}else{
						$login_details = $this->gpf_model->subscriber_password_login($gpf_account,$series,$dob,$pass);
						if(empty($login_details )){
						$data['error'] = $this->lang->line('wrong_credentials');
						}else{
							$this->session->set_userdata('subscribers_data',$login_details);
							$is_uopdate = $this->gpf_model->update_subscriber_last_login($gpf_account,$series,$dob);
							$this->session->set_flashdata('success',$this->lang->line('successfully_logged_in'));
							redirect('subs/dashboard');
						}
					}
					
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/subs/login',$data);
		$this->load->view('layout/footer');
	}
	public function login_down(){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		$this->load->view('layout/header');
		$this->load->view('pages/subs/login_down',$data);
		$this->load->view('layout/footer');
	}
	public function profile(){
		if(!$this->session->userdata('subscribers_data')){
			redirect('subs/login');
		}
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->helper('security');
		$data['subscribers_data'] = $this->session->userdata('subscribers_data');
		$series = $data['subscribers_data']['series'];
		$ac_code = $data['subscribers_data']['ac_code'];
		$dob = $data['subscribers_data']['dob'];
		$data['header']['name'] = $data['subscribers_data']['fst_nme'].' '.$data['subscribers_data']['mid_nme'].' '.$data['subscribers_data']['lst_nme'];
		$data['profile'] = $this->gpf_model->get_subscriber_profile($series,$ac_code,$dob);
		if($this->input->post()){
			$this->form_validation->set_rules('mobile_no', 'Mobile No', 'required|xss_clean');
//			$this->form_validation->set_rules('email_id', 'Email Id', 'required|valid_email|xss_clean');
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
					$is_uopdate = $this->gpf_model->update_subscriber_profile($series,$ac_code,$dob);
					if($is_uopdate){
						$this->session->set_flashdata('success',$this->lang->line('successfully_updated'));
						redirect('subs/dashboard');
					}
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/subs/profile',$data);
		$this->load->view('layout/footer');
	}
	public function dashboard(){
		if(!$this->session->userdata('subscribers_data')){
			redirect('subs/login');
		}
		$data['subscribers_data'] = $this->session->userdata('subscribers_data');
		$data['header']['name'] = $data['subscribers_data']['fst_nme'].' '.$data['subscribers_data']['mid_nme'].' '.$data['subscribers_data']['lst_nme'];
		$this->load->view('layout/header');
		$this->load->view('pages/subs/dashboard',$data);
		$this->load->view('layout/footer');
	}
	public function save_download() { 
		if(!$this->session->userdata('subscribers_data')){
			redirect('subs/login');
		}
		$this->load->library('m_pdf');
		$data['subscribers_data'] = $this->session->userdata('subscribers_data');
		$ac_code = $data['subscribers_data']['ac_code'];
		$series = $data['subscribers_data']['series'];
		$year = date('Y-m-d',strtotime($this->input->get('fyear',true)));

		$data['f_year'] = date('d/m/Y',strtotime($year));
		$data['part_1'] = $this->gpf_model->get_subscribers_part_1($ac_code,$series,$year);
		$data['part_2'] = $this->gpf_model->get_subscribers_part_2($ac_code,$series,$year);	
		$data['part_3'] = $this->gpf_model->get_subscribers_part_3($ac_code,$series,$year);
		$data['part_4'] = $this->gpf_model->get_subscribers_part_4($ac_code,$series,$year);
		$data['header']['name'] = $data['subscribers_data']['fst_nme'].' '.$data['subscribers_data']['mid_nme'].' '.$data['subscribers_data']['lst_nme'];
		$data['sign'] = $this->gpf_model->get_branch_officer_sign($series,$year);

		$pdfFilePath ="ac_statement_".$series."_".$ac_code.'_'.str_replace('-','_',$year).'_'.time().".pdf";
		$pdf = $this->m_pdf->generate();	
		if($year == date('Y-m-d',strtotime('2021-03-31'))){	
			$html = $this->load->view('pages/subs/account_statement_pdf_newQR',$data, true); //load the pdf_output.php by passing our data and get all data in $html varriable.
			$pdf->SetWatermarkText('THIS IS FOR INFORMATION ONLY');
			$pdf->watermark_font = 'DejaVuSansCondensed';
//			$pdf->showWatermarkText = true;
			$pdf->SetProtection(array('print'), '', 'Itsc2020');
			$pdf->WriteHTML($html,0);
			$pdf->Output($pdfFilePath, "D");
//			$pdf->Output();
		}else{
			if($year >= date('Y-m-d',strtotime('2022-03-31'))){	
				$html = $this->load->view('pages/subs/account_statement_pdf_22',$data, true); //load the pdf_output.php by passing our data and get all data in $html varriable.
				$pdf->SetWatermarkText('THIS IS FOR INFORMATION ONLY');
				$pdf->watermark_font = 'DejaVuSansCondensed';
//				$pdf->showWatermarkText = true;
				$pdf->SetProtection(array('print'), '', 'Itsc2020');
				$pdf->WriteHTML($html,0);
				$pdf->Output($pdfFilePath, "D");
//				$pdf->Output();
			}else{
				$html = $this->load->view('pages/subs/account_statement_pdf_newQR',$data, true); //load the pdf_output.php by passing our data and get all data in $html varriable.
//				$html = $this->load->view('pages/subs/account_statement_pdf',$data, true); //Original template.
				$pdf->SetWatermarkText('THIS IS FOR INFORMATION ONLY');
				$pdf->watermark_font = 'DejaVuSansCondensed';
				$pdf->showWatermarkText = true;
				$pdf->SetProtection(array('print'), '', 'Itsc2020');			
				$pdf->WriteHTML($html,0);
				$pdf->Output($pdfFilePath, "D");
//				$pdf->Output();
			}
		}
    }
	public function  save_qr() { 
		if(!$this->session->userdata('subscribers_data')){
			redirect('subs/login');
		}
		$this->load->library('m_pdf');
		$data['subscribers_data'] = $this->session->userdata('subscribers_data');
		$ac_code = $data['subscribers_data']['ac_code'];
		$series = $data['subscribers_data']['series'];
//		$year = date('Y-m-d',strtotime($this->input->get('fyear',true)));
		$year = date('Y-m-d', strtotime('2023-03-31'));
		
		$data['f_year'] = date('d/m/Y',strtotime($year));
		$data['part_1'] = $this->gpf_model->get_subscribers_part_1($ac_code,$series,$year);
		$data['part_2'] = $this->gpf_model->get_subscribers_part_2($ac_code,$series,$year);	
		$data['part_3'] = $this->gpf_model->get_subscribers_part_3($ac_code,$series,$year);
		$data['part_4'] = $this->gpf_model->get_subscribers_part_4($ac_code,$series,$year);
		$data['header']['name'] = $data['subscribers_data']['fst_nme'].' '.$data['subscribers_data']['mid_nme'].' '.$data['subscribers_data']['lst_nme'];
		$data['sign'] = $this->gpf_model->get_branch_officer_sign($series,$year);
		
		$pdfFilePath ="ac_statement_".$series."_".$ac_code.'_'.str_replace('-','_',$year).'_'.time().".pdf";
		$pdf = $this->m_pdf->generate();	
		if($year == date('Y-m-d',strtotime('2021-03-31'))){	
			$html = $this->load->view('pages/subs/account_statement_pdf_newQR',$data, true); //load the pdf_output.php by passing our data and get all data in $html varriable.
			$pdf->SetWatermarkText('THIS IS FOR INFORMATION ONLY');
			$pdf->watermark_font = 'DejaVuSansCondensed';
//			$pdf->showWatermarkText = true;
			$pdf->SetProtection(array('print'), '', 'Itsc2020');
			$pdf->WriteHTML($html,0);
			$pdf->Output($pdfFilePath, "D");
//			$pdf->Output();
		}else{
			if($year == date('Y-m-d',strtotime('2022-03-31'))){	
				$html = $this->load->view('pages/subs/account_statement_pdf_22',$data, true); //load the pdf_output.php by passing our data and get all data in $html varriable.
				$pdf->SetWatermarkText('THIS IS FOR INFORMATION ONLY');
				$pdf->watermark_font = 'DejaVuSansCondensed';
//				$pdf->showWatermarkText = true;
				$pdf->SetProtection(array('print'), '', 'Itsc2020');
				$pdf->WriteHTML($html,0);
				$pdf->Output($pdfFilePath, "D");
//				$pdf->Output();
			}else{
				$html = $this->load->view('pages/subs/account_statement_pdf_newQR',$data, true); //load the pdf_output.php by passing our data and get all data in $html varriable.
//				$html = $this->load->view('pages/subs/account_statement_pdf',$data, true); //Original template.
				$pdf->SetWatermarkText('THIS IS FOR INFORMATION ONLY');
				$pdf->watermark_font = 'DejaVuSansCondensed';
				$pdf->showWatermarkText = true;
				$pdf->SetProtection(array('print'), '', 'Itsc2020');			
				$pdf->WriteHTML($html,0);
				$pdf->Output($pdfFilePath, "D");
//				$pdf->Output();
			}
		}
    }
	public function test() { 
		if(!$this->session->userdata('subscribers_data')){
			redirect('subs/login');
		}
		$this->load->library('m_pdf');
		$data['subscribers_data'] = $this->session->userdata('subscribers_data');
//		$ac_code = $data['subscribers_data']['ac_code'];
//		$series = $data['subscribers_data']['series'];
//		$year = date('Y-m-d',strtotime($this->input->get('fyear',true)));
		
		$ac_code = '4464';
		$series = 'JAL';
		$year = date('Y-m-d', strtotime('2013-03-31'));

		$data['f_year'] = date('d/m/Y',strtotime($year));
		$data['part_1'] = $this->gpf_model->get_subscribers_part_1($ac_code,$series,$year);
		$data['part_2'] = $this->gpf_model->get_subscribers_part_2($ac_code,$series,$year);	
		$data['part_3'] = $this->gpf_model->get_subscribers_part_3($ac_code,$series,$year);
		$data['part_4'] = $this->gpf_model->get_subscribers_part_4($ac_code,$series,$year);
		$data['header']['name'] = $data['subscribers_data']['fst_nme'].' '.$data['subscribers_data']['mid_nme'].' '.$data['subscribers_data']['lst_nme'];
		$data['sign'] = $this->gpf_model->get_branch_officer_sign($series,$year);

		$pdfFilePath ="ac_statement_".$series."_".$ac_code.'_'.str_replace('-','_',$year).'_'.time().".pdf";
		$pdf = $this->m_pdf->generate();
		$html = $this->load->view('pages/subs/account_statement_pdf_newQR',$data, true); //load the pdf_output.php by passing our data and get all data in $html varriable.
		$pdf->SetWatermarkText('THIS IS FOR INFORMATION ONLY');
		$pdf->watermark_font = 'DejaVuSansCondensed';
		$pdf->showWatermarkText = true;
		$pdf->WriteHTML($html,0);
		$pdf->Output($pdfFilePath, "D");
//		$pdf->Output();
    }	

/*
	public function test() { 
		if(!$this->session->userdata('emp_data')){
			redirect('emp/login');
		}
		require_once APPPATH.'/third_party/mpdf-master/vendor/autoload.php';
		$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
		$fontDirs = $defaultConfig['fontDir'];
		
		$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
		$fontData = $defaultFontConfig['fontdata'];
		$mpdf = new \Mpdf\Mpdf([
			'fontdata' => $fontData + [
				"arial" => array(
					'R' => "arial.ttf",
					'B' => "Arial Bold.ttf",
					'I' => "Arial Italic.ttf",
					'BI' => "Arial Bold Italic.ttf",
				),
			],
			'default_font' => 'arial',
			'autoLangToFont' => true
		]);
		$data['subscribers_data'] = $this->session->userdata('subscribers_data');
		$ac_code = $data['subscribers_data']['ac_code'];
		$series = $data['subscribers_data']['series'];
		$year = date('Y-m-d',strtotime($this->input->get('fyear',true)));
		$data['f_year'] = date('d/m/Y',strtotime($year));
		$data['part_1'] = $this->gpf_model->get_subscribers_part_1($ac_code,$series,$year);
		$data['part_2'] = $this->gpf_model->get_subscribers_part_2($ac_code,$series,$year);
		$data['part_3'] = $this->gpf_model->get_subscribers_part_3($ac_code,$series,$year);
		$data['part_4'] = $this->gpf_model->get_subscribers_part_4($ac_code,$series,$year);
		$data['header']['name'] = $data['subscribers_data']['fst_nme'].' '.$data['subscribers_data']['mid_nme'].' '.$data['subscribers_data']['lst_nme'];
		$html=$this->load->view('pages/subs/account_statement_pdf',$data, true);
		$mpdf->WriteHTML($html);
		$mpdf->Output();
	}
*/
/*
	public function account_statement(){
		if(!$this->session->userdata('subscribers_data')){
			redirect('subs/login');
		}
		$data['subscribers_data'] = $this->session->userdata('subscribers_data');
		$ac_code = $data['subscribers_data']['ac_code'];
		$series = $data['subscribers_data']['series'];
		$data['header']['name'] = $data['subscribers_data']['fst_nme'].' '.$data['subscribers_data']['mid_nme'].' '.$data['subscribers_data']['lst_nme'];
		$data['subs_details'] = $this->gpf_model->get_subscribers_financial_years($ac_code,$series);
		$this->load->view('layout/header');
		$this->load->view('pages/subs/account_statement',$data);
		$this->load->view('layout/footer');
	}
*/
	public function account_statement(){
		if(!$this->session->userdata('subscribers_data')){
			redirect('subs/login');
		}
		$data['subscribers_data'] = $this->session->userdata('subscribers_data');
		$ac_code = $data['subscribers_data']['ac_code'];
		$series = $data['subscribers_data']['series'];
		$data['header']['name'] = $data['subscribers_data']['fst_nme'].' '.$data['subscribers_data']['mid_nme'].' '.$data['subscribers_data']['lst_nme'];
		
		if($this->input->get('year')){		
			$f_year = intval($this->input->get('year',true));
			$year = date('Y-m-d',strtotime($f_year.'-03-31'));
			$year = date('Y-m-d',strtotime($year));
			$data['subs_details'] = $this->gpf_model->get_subscribers_financial_years($ac_code,$series,$year);
			$data['tax_details'] = $this->gpf_model->get_subscribers_financial_years_TaxNonTax($ac_code,$series,$year);

		}else{			
			$data['subs_details'] =[];		
		}
		$this->load->view('layout/header');
		$this->load->view('pages/subs/account_statement',$data);
		$this->load->view('layout/footer');
	}
	public function tax_nontax_download() { 
		if(!$this->session->userdata('subscribers_data')){
			redirect('subs/login');
		}
		$this->load->library('m_pdf');
		$this->load->model('gpf_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		
		$data['subscribers_data'] = $this->session->userdata('subscribers_data');
		$ac_code = $data['subscribers_data']['ac_code'];
		$series = $data['subscribers_data']['series'];
		$f_year = intval($this->uri->segment(3));
		$year = date('Y-m-d',strtotime($f_year.'-03-31'));
		$data['row'] = array();
		$data['row'] = $this->gpf_model->get_subscribers_financial_years_TaxNonTax_pdf($ac_code,$series,$year);
		if(empty($data['row'])){
			show_404('admin');
		}
		$html = $this->load->view('pages/subs/tax_nontax_pdf',$data,true);//load the pdf_output.php by passing our data and get all data in $html varriable.
		$pdfFilePath ="Non-tax_Tax_".$year."_".$series.$ac_code.".pdf";
		
		$pdf = $this->m_pdf->pdfgenerate();
		$pdf->SetWatermarkText('O/o the Pr. Accountant General (A&E), WB');
		$pdf->watermark_font = 'DejaVuSansCondensed';
		$pdf->watermarkTextAlpha = 0.1;
		$pdf->showWatermarkText = true;
		$pdf->WriteHTML($html);
		$pdf->Output($pdfFilePath, "D");
//		$pdf->Output();
    }
	public function gpf_form(){
		if(!$this->session->userdata('subscribers_data')){
			redirect('subs/login');
		}
		$this->load->library('m_pdf');
		$html = $this->load->view('pages/subs/gpf_form',$data, true); //load the pdf_output.php by passing our data and get all data in $html varriable.
		$pdfFilePath ="gpf_form".time().".pdf";
		$pdf = $this->m_pdf->generate();
		$pdf->SetWatermarkText('THIS IS FOR INFORMATION ONLY');
		$pdf->watermark_font = 'DejaVuSansCondensed';
		$pdf->showWatermarkText = true;
		$pdf->WriteHTML($html,0);
		$pdf->Output($pdfFilePath, "D");
		//$pdf->Output();
	}
/*	
	public function missing_debit_credit(){
		if(!$this->session->userdata('subscribers_data')){
			redirect('subs/login');
		}
		$data['subscribers_data'] = $this->session->userdata('subscribers_data');
		$ac_code = $data['subscribers_data']['ac_code'];
		$series = $data['subscribers_data']['series'];
		$cur_month = date('m');
		$cur_year = date('Y');
		if($cur_month >= 4){ //april onwards
			$year = $cur_year;
		}else{
			$year = $cur_year - 1;
		}
		$f_year = $year.'-03-31';
		$data['header']['name'] = $data['subscribers_data']['fst_nme'].' '.$data['subscribers_data']['mid_nme'].' '.$data['subscribers_data']['lst_nme'];
		$data['missing_credits'] =  $this->gpf_model->get_subscribers_missing_credits($ac_code,$series);
		$this->load->view('layout/header');
		$this->load->view('pages/subs/missing_debit_credit',$data);
		$this->load->view('layout/footer');
	}
*/
	public function missing_debit_credit(){
		if(!$this->session->userdata('subscribers_data')){
			redirect('subs/login');
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		if(!$this->session->userdata('subscribers_data')){
			redirect('subs/login');
		}
		$data['subscribers_data'] = $this->session->userdata('subscribers_data');
		$ac_code = $data['subscribers_data']['ac_code'];
		$series = $data['subscribers_data']['series'];
		$cur_month = date('m');
		$cur_year = date('Y');
		if($cur_month >= 4){ //april onwards
			$year = $cur_year;
		}else{
			$year = $cur_year - 1;
		}
		$f_year = $year.'-03-31';
		$data['header']['name'] = $data['subscribers_data']['fst_nme'].' '.$data['subscribers_data']['mid_nme'].' '.$data['subscribers_data']['lst_nme'];
		$data['missing_credits'] =  $this->gpf_model->get_subscribers_missing_credits($ac_code,$series,$limit_to);
		$this->load->view('layout/header');
		$this->load->view('pages/subs/missing_debit_credit',$data);
		$this->load->view('layout/footer');
	}
	public function debit_credit_bck(){
		if(!$this->session->userdata('subscribers_data')){
			redirect('subs/login');
		}
		$data['subscribers_data'] = $this->session->userdata('subscribers_data');
		$ac_code = $data['subscribers_data']['ac_code'];
		$series = $data['subscribers_data']['series'];
		$data['header']['name'] = $data['subscribers_data']['fst_nme'].' '.$data['subscribers_data']['mid_nme'].' '.$data['subscribers_data']['lst_nme'];
		$data['debit_credit'] = $this->gpf_model->get_subscribers_ledger($ac_code,$series);
		$this->load->view('layout/header');
		$this->load->view('pages/subs/debit_credit',$data);
		$this->load->view('layout/footer');
	}
	public function final_payment_authority(){
		if(!$this->session->userdata('subscribers_data')){
			redirect('subs/login');
		}
		$data['subscribers_data'] = $this->session->userdata('subscribers_data');
		$ac_code = $data['subscribers_data']['ac_code'];
		$series = $data['subscribers_data']['series'];
		$data['header']['name'] = $data['subscribers_data']['fst_nme'].' '.$data['subscribers_data']['mid_nme'].' '.$data['subscribers_data']['lst_nme'];
		$data['results'] =  $this->gpf_model->get_subscribers_final_payment_authority($ac_code,$series);
		if(empty($data['results'])){
			//show_404();
		}
		$this->load->view('layout/header');
		$this->load->view('pages/subs/final_payment_authority',$data);
		$this->load->view('layout/footer');
	}
/*
	public function final_payment_authority_pdf(){
		$this->load->library('m_pdf');if(!$this->session->userdata('subscribers_data')){
			redirect('subs/login');
		}
		$data['subscribers_data'] = $this->session->userdata('subscribers_data');
		$ac_code = $data['subscribers_data']['ac_code'];
		$series = $data['subscribers_data']['series'];
		$data['fpa'] =  $this->gpf_model->get_subscribers_final_payment_authority_group($ac_code,$series);
		if(empty($data['fpa'])){
			show_404();
		}
		$data['fpa1'] = isset($data['fpa'][0]) ? $data['fpa'][0] : array();
		$data['fpa2'] = isset($data['fpa'][1]) ? $data['fpa'][1] : array();
		$data['nominees'] = $this->gpf_model->get_final_payment_nominee($data['fpa1']['authority_no']);
		$html = $this->load->view('pages/subs/final_payment_authority_pdf',$data, true); //load the pdf_output.php by passing our data and get all data in $html varriable.
		$pdfFilePath ="fp_authority".$series.$ac_code.".pdf";
		$pdf = $this->m_pdf->generate();
		$pdf->SetWatermarkText('THIS IS FOR INFORMATION ONLY');
		$pdf->watermark_font = 'DejaVuSansCondensed';
		$pdf->showWatermarkText = true;
		$pdf->WriteHTML($html,0);
		$pdf->Output($pdfFilePath, "D");
		//$pdf->Output();
	}
*/	
	//Hirani
	public function final_payment_authority_pdf(){
		$this->load->library('m_pdf');
		if(!$this->session->userdata('subscribers_data')){
			redirect('subs/login');
		}
		$data['subscribers_data'] = $this->session->userdata('subscribers_data');
		$ac_code = $data['subscribers_data']['ac_code'];
		$series = $data['subscribers_data']['series'];
		$data['fpa'] =  $this->gpf_model->get_subscribers_final_payment_authority_group($ac_code,$series);
		if(empty($data['fpa'])){
			show_404();
		}
		$data['fpa1'] = isset($data['fpa'][0]) ? $data['fpa'][0] : array();
		//$data['fpa2'] = isset($data['fpa'][1]) ? $data['fpa'][1] : array(); //Hirani
		$data['fpa2'] = isset($data['fpa'][0]) ? $data['fpa'][0] : array(); //Hirani
		$data['nominees'] = $this->gpf_model->get_final_payment_nominee($data['fpa1']['authority_no'],$data['fpa1']['series'],$data['fpa1']['ac_code']);
		$html = $this->load->view('pages/subs/final_payment_authority_pdf',$data, true); //load the pdf_output.php by passing our data and get all data in $html varriable.
		//echo $html; //Hirani
		$pdfFilePath ="fp_authority".$series.$ac_code.".pdf";
		echo $pdfFilePath;
		$pdf = $this->m_pdf->generate();
		$pdf->SetWatermarkText('THIS IS FOR INFORMATION ONLY');
		$pdf->watermark_font = 'DejaVuSansCondensed';
		$pdf->showWatermarkText = true;
		$pdf->WriteHTML($html,0);
		$pdf->Output($pdfFilePath, "D")->setContentType('application/pdf'); ;
	}
	//Hirani
	public function logout(){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$arr_feed['id'] 	= $this->session->userdata('subscribers_data')['series'].'/WB/'.$this->session->userdata('subscribers_data')['ac_code'];
		$arr_feed['name'] 	= $this->session->userdata('subscribers_data')['fst_nme'];
		$arr_feed['mobile'] = $this->session->userdata('subscribers_data')['mobile_no'];
		$arr_feed['email']  = $this->session->userdata('subscribers_data')['email_id'];
		$this->session->set_userdata('user_details_for_feedback',$arr_feed);
				
		if(!$this->session->userdata('subscribers_data')){
			redirect('subs/login');
		}else{
			$this->session->unset_userdata('subscribers_data');
			$this->session->set_flashdata('success',$this->lang->line('give_your_feedback'));
			redirect('feedback');
		}
		$this->load->view('layout/header');
		$this->load->view('pages/subs/login',$data);
		$this->load->view('layout/footer');
	}
	public function ddo_file_status(){
		if(!$this->session->userdata('subscribers_data')){
			redirect('subs/login');
		}
		$this->load->library('pagination');
		$data['subscribers_data'] = $this->session->userdata('subscribers_data');
		$data['header']['name'] = $data['subscribers_data']['fst_nme'].' '.$data['subscribers_data']['mid_nme'].' '.$data['subscribers_data']['lst_nme'];
		$series = $data['subscribers_data']['series'];
		$ac_code = $data['subscribers_data']['ac_code'];

		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;		
		$response = $this->gpf_model->get_ddo_files_sub_all($page_no, $series, $ac_code);	
		$data['results'] = $response['results'];

		$config['base_url'] = base_url().'subs/ddo_file_status';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;	
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		
		$this->load->view('layout/header');
		$this->load->view('pages/subs/ddo_file_status',$data);
		$this->load->view('layout/footer');
	}
	public function rates_of_interest(){
		if(!$this->session->userdata('subscribers_data')){
			redirect('subs/login');
		}
		$this->load->model('gpf_model');
		$data['subscribers_data'] = $this->session->userdata('subscribers_data');
		$ac_code = $data['subscribers_data']['ac_code'];
		$series = $data['subscribers_data']['series'];
		$data['header']['name'] = $data['subscribers_data']['fst_nme'].' '.$data['subscribers_data']['mid_nme'].' '.$data['subscribers_data']['lst_nme'];
		
		if($this->input->get('year')){
			$year = intval($this->input->get('year',true));
			$data['results'] = $this->gpf_model->search_rates_of_interest_by_year($year);
		}else{
			$data['results'] =[];// $this->gpf_model->get_rates_of_interest_last_15_years();
		}
		$this->load->view('layout/header');
		$this->load->view('pages/subs/rates_of_interest',$data);
		$this->load->view('layout/footer');
	}
	//Hirani
	public function mhList(){
		if(!$this->session->userdata('subscribers_data')){
			redirect('subs/login');
		}
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$postData = $this->input->post();
		$this->load->model('gpf_model');
		$data = $this->gpf_model->getmh($postData);
		$data['data'] = $data;
		echo json_encode($data);
	}
	public function tryList(){
		if(!$this->session->userdata('subscribers_data')){
			redirect('subs/login');
		}
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$postData = $this->input->post();
		$this->load->model('gpf_model');
		$data = $this->gpf_model->gettry($postData);
		$data['data'] = $data;
		echo json_encode($data);
	}
	public function ddoList(){
		if(!$this->session->userdata('subscribers_data')){
			redirect('subs/login');
		}
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$postData = $this->input->post();
		$this->load->model('gpf_model');
		$data = $this->gpf_model->getddo($postData);
		$data['data'] = $data;
		echo json_encode($data);
	}


}// End of Class
