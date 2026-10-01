<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ersa extends CI_Controller {
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
	public function index(){
		redirect(base_url());
	}
	public function page(){
		$page_url = $this->uri->segment(3);
		$data['row'] = $this->page_model->getPageByURL($this->language_id,$page_url,'AGERSA');
		$data['breadcrumb'] = array();
		$breadcrumb_str = $this->input->get('c',true);
		if($breadcrumb_str != ''){
			$data['breadcrumb'] = explode('@',$breadcrumb_str);
		}
		if(empty($data['row'])){
			show_404();
		}else if($data['row']['page_office_code'] != 'AGERSA'){
			show_404();
		}
		$this->load->view('layout/header');
		$this->load->view('pages/page_ersa',$data);
		$this->load->view('layout/footer');
	}
	
	public function circular_office_order(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->wing_model->get_circular_office_order($page_no,'AGERSA');
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/ersa/circular_office_order';
		$config['total_rows'] = $response['total'];
		
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		redirect('https://agwb.cag.gov.in');
		$this->load->view('layout/header');
		$this->load->view('pages/circular_office_order/ersa',$data);
		$this->load->view('layout/footer');
	}
	public function tender_notice(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->wing_model->get_tender_notice($page_no,'AGERSA');
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/ersa/tender_notice';
		$config['total_rows'] = $response['total'];
		
		$this->pagination->initialize($config);
		$data['language_id']=$this->language_id;
		redirect('https://agwb.cag.gov.in');
		$this->load->view('layout/header');
		$this->load->view('pages/tender_notice/ersa',$data);
		$this->load->view('layout/footer');
	}


}// End of Class
