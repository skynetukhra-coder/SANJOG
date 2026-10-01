<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->lang->load('main','english');
		if($this->session->userdata('language_id')){
			$this->language_id = $this->session->userdata('language_id');
		}else{
			$this->language_id = 1;
		}
	}
	public function index(){
		
		redirect('https://cag.gov.in/ae/west-bengal/en/notification');
		$this->load->view('layout/header');
		$this->load->view('pages/news');
		$this->load->view('layout/footer');
	}

}// End of Class
