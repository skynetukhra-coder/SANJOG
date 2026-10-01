<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gpf extends CI_Controller {
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
		if($this->session->userdata('subscribers_data')){
			//redirect('subs/dashboard');
		}
		$this->load->view('layout/header');
		$this->load->view('pages/gpf/login');
		$this->load->view('layout/footer');
	}
	public function final_payment_cases(){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['row'] = array();
		if($this->input->get('gpf_ac_no')){
			$ac_no = $this->input->get('gpf_ac_no');
			$data['row'] = $this->gpf_model->search_user_case_status($ac_no);
		}
		$this->load->view('layout/header');
		$this->load->view('pages/gpf/final_payment_cases',$data);
		$this->load->view('layout/footer');
	}
	
}// End of Class
