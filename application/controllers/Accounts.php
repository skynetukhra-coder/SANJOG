<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->lang->load('main','english');
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
		$this->load->view('pages/accounts/login');
		$this->load->view('layout/footer');
	}
}// End of Class
