<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback extends CI_Controller {
	public function index(){
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['error'] = '';
		
		$data['user'] = array();
		if($this->input->get('ref') && $this->input->get('ref')=='remove'){
			$this->session->unset_userdata('user_details_for_feedback');
		}
		if($this->session->has_userdata('user_details_for_feedback')){
			$data['user'] = $this->session->userdata('user_details_for_feedback');
		}
		if($this->input->post()){
			$this->form_validation->set_rules('name', 'Name', 'required|xss_clean');
			$this->form_validation->set_rules('mobile', 'Mobile', 'required|xss_clean');
			$this->form_validation->set_rules('feed', 'Feedback', 'required|xss_clean');
			$this->form_validation->set_rules('c_image', 'Image Code', 'required|xss_clean',array('required'=> 'Please write image code'));
			if ($this->form_validation->run() == FALSE){
               $data['error'] = validation_errors();
            }else{
				$cap_code = $this->session->userdata('cap_data');
				if($cap_code != $this->input->post('c_image')){
					$data['error'] = $this->lang->line('image_code_not_matched');
				}else{
					$this->session->unset_userdata('user_details_for_feedback');
					$is_sebmited = $this->common_model->submit_feedback();
//echo $this->db->last_query();
					if($is_sebmited){
						$this->session->set_flashdata('success',$this->lang->line('thank_you_for_feedback'));
					}else{
						$this->session->set_flashdata('error',$this->lang->line('feedback_already_given_err'));
					}
					redirect('feedback'); 
				}
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('layout/header');
		$this->load->view('pages/feedback',$data);
		$this->load->view('layout/footer');
	}
}
