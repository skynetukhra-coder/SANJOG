<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagenotfound extends CI_Controller {

	public function index(){
//		redirect('https://agwb.cag.gov.in');
		$this->output->set_status_header(404);
		$this->load->view('layout/header');
		$this->load->view('pages/pagenotfound');
		$this->load->view('layout/footer');
	}
	public function admin(){
		if(!$this->session->userdata('admin_details')){
			redirect('admin');
		}else{
			$this->output->set_status_header(404);
			$this->load->view('agadmin/layout/header');
			$this->load->view('agadmin/pages/pagenotfound');
			$this->load->view('agadmin/layout/footer');
		}
		
	}
	
} // End of Class
