<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pension extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->lang->load('main','english');
		$this->load->model('pension_model');
		if($this->session->userdata('language_id')){
			$this->language_id = $this->session->userdata('language_id');
		}else{
			$this->language_id = 1;
		}
		
	}
	public function auth(){
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['row'] = array();
		$data['error'] = '';
		if($this->input->post('c_image')){
			$this->form_validation->set_rules('application_no', 'Application no', 'xss_clean');
			$this->form_validation->set_rules('c_image', 'Image Code', 'required|xss_clean',array('required'=> 'Please write image code'));
			if ($this->form_validation->run() == FALSE){
               $data['error'] = validation_errors();
            }else{
				$cap_code = $this->session->userdata('cap_data');
				if($cap_code != $this->input->post('c_image')){
					$data['error'] = $this->lang->line('image_code_not_matched');
				}else{
					$reg_status = $this->pension_model->pensioner_auth();
					if($reg_status['success'] === false){
						$data['error'] = $reg_status['msg'];
					}else{
						$pension_details = $reg_status['details'];
						$mobile = trim($pension_details['mobile_no']) != '' ? $pension_details['mobile_no'] : $pension_details['mobile_num'];
						$email  = 'karmicksol207@gmail.com';//'berask.wbl.ae@cag.gov.in'; //'itsc-agae-wb@nic.in';
						send_OTP($email,$mobile); // from helper
						$this->session->set_flashdata('success',$this->lang->line('OTP_sent_to_mobile_email'));
						$this->session->set_userdata('pension_auth',$pension_details['application_no']);
						redirect('pension/otp');
					}
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/pension/auth',$data);
		$this->load->view('layout/footer');
	}
	public function otp(){
		if(!$this->session->userdata('pension_auth')){
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
			if ($this->form_validation->run() == FALSE){
               $data['error'] = validation_errors();
            }else{
					$otp = $this->input->post('otp',true);
					$is_validate = validate_OTP($otp); // from helper
					if($is_validate){
						$this->session->set_flashdata('success','Successfully Authenticated.');
						redirect('pension/pensioners_copy_download');
					}else{
						$this->session->set_flashdata('error','OTP not matched.');
						unset($POST);
					}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/pension/otp',$data);
		$this->load->view('layout/footer');
	}
	public function pensioners_copy_download(){
		if(! $this->session->has_userdata('pension_auth')){
			show_404();
		}
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['application_no'] = $this->session->userdata('pension_auth');
		$data['case'] = $this->pension_model->get_pension_case_details($data['application_no']); // T1
		$data['returns'] = $this->pension_model->get_pension_return_details($data['application_no']); // T2
		$data['dispatched'] = $this->pension_model->get_pension_dispatched_details($data['application_no']); // T3
		$data['pension'] = $this->pension_model->get_pension_details($data['application_no']); // T4
		$case_details = $this->pension_model->get_pension_case_details($data['application_no']); // T1
		$data['error'] = '';
		if(empty($data['dispatched'])){
			$data['error'] = 'Dispatched data not found!';
		}else if(isset($data['dispatched']) && ( !isset($data['dispatched'][0]) || !isset($data['dispatched'][1]) ) ){
			$data['error'] = 'Dispatched data not found!';
		}
		if(empty($data['pension'])){
			$data['error'] = 'Data not found!';
		}else if(isset($data['pension']) && !isset($data['pension'][0])){
			$data['error'] = 'Data not found!';
		}
		$case = $case_details[0]; 
		$data['is_ppo'] = false;
		$data['is_fppo'] = false;
		// check PPO
		if(!empty($case)){
			$ppo_class = false;
			$ppo_case_type = false;
			if(isset($case['pension_class']) && trim(strtolower($case['pension_class'])) == 'superannuation pension'){
				$ppo_class = true;
			}
			if(isset($case['case_type']) && trim(strtolower($case['case_type'])) == 'regular case (service pension)'){
				$ppo_case_type = true;
			}
			if($ppo_class && $ppo_case_type){
				$data['is_ppo'] = true;
			}
		}
		if(!empty($case)){
			$fppo_class = false;
			$fppo_case_type = false;
			if(isset($case['pension_class']) && (trim(strtolower($case['pension_class'])) == 'family pension' || trim(strtolower($case['pension_class'])) == 'cp case' || trim(strtolower($case['pension_class'])) == 'ad-hoc family pension')){
				$fppo_class = true;
			}
			if(isset($case['case_type']) && trim(strtolower($case['case_type'])) == 'family pension case'){
				$fppo_case_type = true;
			}
			if($fppo_class && $fppo_case_type){
				$data['is_fppo'] = true;
			}
		}

		$this->load->view('layout/header');
		$this->load->view('pages/pension/pensioners_copy',$data);
		$this->load->view('layout/footer');
	}
	public function ppo_pdf(){
		if(! $this->session->has_userdata('pension_auth')){
			show_404();
		}
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->library('m_pdf');
		$application_no = $this->session->userdata('pension_auth');		
		$data['case'] = $this->pension_model->get_pension_case_details($application_no); // T1
		$data['returns'] = $this->pension_model->get_pension_return_details($application_no); // T2
		$data['dispatched'] = $this->pension_model->get_pension_dispatched_details($application_no); // T3
		$data['pension'] = $this->pension_model->get_pension_details($application_no); // T4
		$case = $data['case'][0]; 
		$data['is_ppo'] = false;
		
		// check PPO
		$data['error'] = '';
		if(empty($data['dispatched'])){
			$data['error'] = 'Dispatched data not found!';
		}else if(isset($data['dispatched']) && ( !isset($data['dispatched'][0]) || !isset($data['dispatched'][1]) ) ){
			$data['error'] = 'Dispatched data not found!';
		}
		if(empty($data['pension'])){
			$data['error'] = 'Data not found!';
		}else if(isset($data['pension']) && !isset($data['pension'][0])){
			$data['error'] = 'Data not found!';
		}
		if(!empty($case)){
			$ppo_class = false;
			$ppo_case_type = false;

			if(isset($case['pension_class']) && trim(strtolower($case['pension_class'])) == 'superannuation pension'){
				$ppo_class = true;
			}
			if(isset($case['case_type']) && trim(strtolower($case['case_type'])) == 'regular case (service pension)'){
				$ppo_case_type = true;
			}
			if($ppo_class && $ppo_case_type){
				$data['is_ppo'] = true;
			}
		}
		if($data['is_ppo'] == false){
			show_404();
		}else{
		$html = $this->load->view('pages/pension/ppo_pdf',$data, true); //load the pdf_output.php by passing our data and get all data in $html varriable.
			$pdfFilePath ='ppo_'.$application_no.".pdf";
			$pdf = $this->m_pdf->generate();
			$pdf->SetWatermarkText('THIS IS FOR INFORMATION ONLY');
			$pdf->watermark_font = 'DejaVuSansCondensed';
			$pdf->showWatermarkText = true;
			$pdf->WriteHTML($html,0);
//			$pdf->Output($pdfFilePath, "D");
			$pdf->Output();
		}
	}
	
	public function fppo_pdf(){
		if(! $this->session->has_userdata('pension_auth')){
			show_404();
		}
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->library('m_pdf');
		$application_no = $this->session->userdata('pension_auth');
		$data = array();
		$data['case'] = $this->pension_model->get_pension_case_details($application_no); // T1
		$data['returns'] = $this->pension_model->get_pension_return_details($application_no); // T2
		$data['dispatched'] = $this->pension_model->get_pension_dispatched_details($application_no); // T3
		$data['pension'] = $this->pension_model->get_pension_details($application_no); // T4
		$data['spouce'] = $this->pension_model->get_spouce_details($application_no); // T5
		$case = $data['case'][0]; 
		$data['is_fppo'] = false;
		
		// check FPPO
		$data['error'] = '';
		if(empty($data['dispatched'])){
			$data['error'] = 'Dispatched data not found!';
		}else if(isset($data['dispatched']) && ( !isset($data['dispatched'][0]) || !isset($data['dispatched'][1]) ) ){
			$data['error'] = 'Dispatched data not found!';
		}
		if(empty($data['pension'])){
			$data['error'] = 'Data not found!';
		}else if(isset($data['pension']) && !isset($data['pension'][0])){
			$data['error'] = 'Data not found!';
		}
		if(!empty($case)){
			$fppo_class = false;
			$fppo_case_type = false;
			if(isset($case['pension_class']) && (trim(strtolower($case['pension_class'])) == 'family pension' || trim(strtolower($case['pension_class'])) == 'cp case' || trim(strtolower($case['pension_class'])) == 'ad-hoc family pension')){
				$fppo_class = true;
			}
			if(isset($case['case_type']) && trim(strtolower($case['case_type'])) == 'family pension case'){
				$fppo_case_type = true;
			}
			if($fppo_class && $fppo_case_type){
				$data['is_fppo'] = true;
			}
		}
		if($data['is_ppo'] == false){
			show_404();
		}else{
			$html = $this->load->view('pages/pension/fppo',$data, true); //load the pdf_output.php by passing our data and get all data in $html varriable.
			$pdfFilePath ='fppo_'.$application_no.".pdf";
			$pdf = $this->m_pdf->generate();
			$pdf->SetWatermarkText('THIS IS FOR INFORMATION ONLY');
			$pdf->watermark_font = 'DejaVuSansCondensed';
			$pdf->showWatermarkText = true;
			$pdf->WriteHTML($html,0);
//			$pdf->Output($pdfFilePath, "D");
			$pdf->Output();
		}
	}

	public function ppo_download(){
		if(! $this->session->has_userdata('pension_auth')){
			show_404();
		}
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->library('m_pdf');
		$application_no = $this->session->userdata('pension_auth');
		$data = array();
		$data['case'] = $this->pension_model->get_pension_case_details($application_no); // T1
		$data['returns'] = $this->pension_model->get_pension_return_details($application_no); // T2
		$data['dispatched'] = $this->pension_model->get_pension_dispatched_details($application_no); // T3
		$data['pension'] = $this->pension_model->get_pension_details($application_no); // T4
		$case = $data['case'][0]; 
		$data['is_ppo'] = false;
		// check PPO
		$data['error'] = '';
		if(empty($data['dispatched'])){
			$data['error'] = 'Dispatched data not found!';
		}else if(isset($data['dispatched']) && ( !isset($data['dispatched'][0]) || !isset($data['dispatched'][1]) ) ){
			$data['error'] = 'Dispatched data not found!';
		}
		if(empty($data['pension'])){
			$data['error'] = 'Data not found!';
		}else if(isset($data['pension']) && !isset($data['pension'][0])){
			$data['error'] = 'Data not found!';
		}
		if(!empty($case)){
			$ppo_class = false;
			$ppo_case_type = false;
			if(isset($case['pension_class']) && trim(strtolower($case['pension_class'])) == 'superannuation pension'){
				$ppo_class = true;
			}
			if(isset($case['case_type']) && trim(strtolower($case['case_type'])) == 'regular case (service pension)'){
				$ppo_case_type = true;
			}
			if($ppo_class && $ppo_case_type){
				$data['is_ppo'] = true;
			}
		}
		if($data['is_ppo'] == false){
			show_404();
		}else{
			$html = $this->load->view('pages/pension/ppo',$data, true); //load the pdf_output.php by passing our data and get all data in $html varriable.
			$pdfFilePath ='ppo_'.$application_no.".pdf";
			$pdf = $this->m_pdf->generate();
			$pdf->SetWatermarkText('THIS IS FOR INFORMATION ONLY');
			$pdf->watermark_font = 'DejaVuSansCondensed';
			$pdf->showWatermarkText = true;
			$pdf->WriteHTML($html,0);
//			$pdf->Output($pdfFilePath, "D");
			$pdf->Output();
			//$this->load->view('pages/pensioners_copy_download/ppo',$data); 
		}
	}
	public function fppo_download(){
		if(! $this->session->has_userdata('pension_auth')){
			show_404();
		}
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->library('m_pdf');
		$application_no = $this->session->userdata('pension_auth');
		$data = array();
		$data['case'] = $this->pension_model->get_pension_case_details($application_no); // T1
		$data['returns'] = $this->pension_model->get_pension_return_details($application_no); // T2
		$data['dispatched'] = $this->pension_model->get_pension_dispatched_details($application_no); // T3
		$data['pension'] = $this->pension_model->get_pension_details($application_no); // T4
		$data['spouce'] = $this->pension_model->get_spouce_details($application_no); // T5
		$case = $data['case'][0]; 
		$data['is_fppo'] = false;
		// check FPPO
		$data['error'] = '';
		if(empty($data['dispatched'])){
			$data['error'] = 'Dispatched data not found!';
		}else if(isset($data['dispatched']) && ( !isset($data['dispatched'][0]) || !isset($data['dispatched'][1]) ) ){
			$data['error'] = 'Dispatched data not found!';
		}
		if(empty($data['pension'])){
			$data['error'] = 'Data not found!';
		}else if(isset($data['pension']) && !isset($data['pension'][0])){
			$data['error'] = 'Data not found!';
		}
		if(!empty($case)){
			$fppo_class = false;
			$fppo_case_type = false;
			if(isset($case['pension_class']) && (trim(strtolower($case['pension_class'])) == 'family pension' || trim(strtolower($case['pension_class'])) == 'cp case' || trim(strtolower($case['pension_class'])) == 'ad-hoc family pension')){
				$fppo_class = true;
			}
			if(isset($case['case_type']) && trim(strtolower($case['case_type'])) == 'family pension case'){
				$fppo_case_type = true;
			}
			if($fppo_class && $fppo_case_type){
				$data['is_fppo'] = true;
			}
		}
		if($data['is_fppo'] == false){
			show_404();
		}else{
			$html = $this->load->view('pages/pension/fppo',$data, true); //load the pdf_output.php by passing our data and get all data in $html varriable.
			$pdfFilePath ='fppo_'.$application_no.".pdf";
			$pdf = $this->m_pdf->generate();
			$pdf->SetWatermarkText('THIS IS FOR INFORMATION ONLY');
			$pdf->watermark_font = 'DejaVuSansCondensed';
			$pdf->showWatermarkText = true;
			$pdf->WriteHTML($html,0);
//			$pdf->Output($pdfFilePath, "D");
			$pdf->Output();
			//$this->load->view('pages/pensioners_copy_download/fppo',$data); 
		}
	}

	public function final_payment_cases(){
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['row'] = array();
		$data['error'] = '';
		$application_no = '';
		$mobile = '';
		$fname = '';
		
		if($this->input->post('c_image')){
			$this->form_validation->set_rules('application_no', 'Application no', 'xss_clean');
			$this->form_validation->set_rules('mobile', 'Pensioner mobile number', 'xss_clean');
			$this->form_validation->set_rules('fname', 'First Name', 'xss_clean');
			$this->form_validation->set_rules('doa', 'Date of Appointment', 'regex_match[/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/]|xss_clean');
			$this->form_validation->set_rules('dob', 'Date of Birth', 'regex_match[/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/]|xss_clean');
			$this->form_validation->set_rules('c_image', 'Image Code', 'required|xss_clean',array('required'=> 'Please write image code'));
			$appli_no = strip_tags($this->input->post('application_no'));
			$mobile_no = strip_tags($this->input->post('mobile'));
			$f_name = strip_tags($this->input->post('fname'));
	
			$application_no = preg_replace("/[^0-9]+/", "",  $appli_no);		
			$mobile = preg_replace("/[^0-9]+/", "",  $mobile_no);	
			$fname = preg_replace("/[^a-zA-Z]+/", "", $f_name);
	
			if(is_numeric($application_no) || is_numeric($mobile) || $fname=''){	
				if ($this->form_validation->run() == FALSE){
				   $data['error'] = validation_errors();
				}else{
					$cap_code = $this->session->userdata('cap_data');
					if($cap_code != $this->input->post('c_image')){
						$data['error'] = $this->lang->line('image_code_not_matched');
					}else{
						$data['results'] = $this->pension_model->get_pension_case_status($application_no,$mobile,$fname);
						foreach($data['results'] as $key => $row){
							if(!empty($row)){
								$case_id = $row['appln_pk'];
								$data['results'][$key]['return'] = $this->pension_model->get_pension_case_return($case_id);
								$data['results'][$key]['dispatched'] = $this->pension_model->get_pension_case_dispatched($case_id);
							}
						}
					}
				}	
			}else{
				redirect('pension/final_payment_cases');
			}
		}
		$data['cap'] = get_captcha();
		
		$this->load->view('layout/header');
		$this->load->view('pages/pension/final_payment_cases',$data);
		$this->load->view('layout/footer');
	}
	public function pension_appl(){
		$this->load->helper('security');	
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		$data['results'] =[];
		if($this->input->post()){
			$cap_code = $this->session->userdata('cap_data');
				if($cap_code != $this->input->post('c_image')){
					$data['error'] = $this->lang->line('image_code_not_matched');
				}else{
					$update = array(
								'full_name'	=> $this->input->post('full_name',true),
								'ppo_no'	=> $this->input->post('ppo_no',true),
								'mobile'	=> $this->input->post('mobile'),
								'email_id'	=> $this->input->post('email_id'),
								'pen_year'	=> $this->input->post('pen_year'),
								'pen_month'	=> $this->input->post('pen_month'),
								'appl_dt'		=> date('Y-m-d'),
								'upload_dt'		=> date('Y-m-d H:i:s'),
							);
					if(isset($_FILES['attachment']) && $_FILES['attachment']['size'] > 0){
						//upload file
						$upload_details = $this->common_model->upload_pen_payment_doc('attachment');
						if(!$upload_details['is_success']){
							$this->session->set_flashdata('error',$upload_details['message']);
							$error = $upload_details['message'];
						}else{
							$update['doc_name'] = $upload_details['filename'];
						}
					}
					if($error == ''){
						$id = $this->pension_model->pension_appli_add($update);
						$this->session->set_flashdata('success','Application submitted successfully .');
						redirect('pension/pension_appl');
					}
				}
		}
		
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/pension/pension_appl',$data);
		$this->load->view('layout/footer');
	}
	
	public function ppogpocpo_view(){	
		if(! $this->session->has_userdata('pension_auth')){
			show_404();
		}
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['user'] = $this->session->userdata('pension_auth');
//print_r($data['user']);
/*
$ppath = '';
		if($this->input->post()){
			$series = $this->input->post('series');
			$accno = $this->input->post('accno');
				$pname=strtolower('ppo_'.$series.$accno).'.pdf';
				$ppath= 'pension/ppo/'.$pname;	
				//$ppath=base_url().'pension/ppo/'.$pname;
				$gname=strtolower('gpo_'.$series.$accno).'.pdf';
				$gpath='ppo/'.$gname;
				$cname=strtolower('cpo_'.$series.$accno).'.pdf';
				
				$cpath='ppo/'.$cname;
				$data['ppo_lnk'] =$ppath.'@@@'.$gpath.'@@@'.$cpath;
				
	//		if(file_exists($ppath)){
	// 			  echo "This File exists------------------";
	//			  echo $ppath;
	//		}else{
	// 			  echo "This File does not exist";
	//		}		
		
		}
*/

		$this->load->view('layout/header');
		$this->load->view('pages/pension/ppogpocpo_view',$data);
		$this->load->view('layout/footer');
	}
	
	
	
	
}// End of Class
