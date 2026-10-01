<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testajax extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->lang->load('main','english');
		$this->load->model('page_model');
		$this->load->model('wing_model');
		if($this->session->userdata('language_id')){
			$this->language_id = $this->session->userdata('language_id');
		}else{
			$this->language_id = 1;
		}
	}
	public function index($theam){
		$this->load->view('layout/header');
		$this->load->view('pages/testajax/call');
		$this->load->view('layout/footer');
		
	}
}// End of Class
