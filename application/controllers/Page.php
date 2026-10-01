<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->lang->load('main','english');
		$this->load->model('page_model');
		if($this->session->userdata('language_id')){
			$this->language_id = $this->session->userdata('language_id');
		}else{
			$this->language_id = 1;
		}
		
	}
	public function index(){
		$page_url = $this->uri->segment(2);
		if(trim($page_url) == 'accounts-departmental-files' || trim($page_url) == 'treasury-inspection'){
			if(!$this->session->userdata('admin_details')){
				show_404();
			}
		}
		$data['row'] = $this->page_model->getPageByURL($this->language_id,$page_url,'AGAE');
		$data['breadcrumb'] = array();
		$breadcrumb_str = $this->input->get('c',true);
		if($breadcrumb_str != ''){
			$data['breadcrumb'] = explode('@',$breadcrumb_str);
		}
		if(empty($data['row'])){
			show_404();
		}
		$this->load->view('layout/header');
		$this->load->view('pages/page',$data);
		$this->load->view('layout/footer');
	}

}// End of Class
