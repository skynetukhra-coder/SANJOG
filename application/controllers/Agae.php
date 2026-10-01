<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agae extends CI_Controller {
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
	
	public function rates_of_interest(){
		$this->load->model('gpf_model');
		if($this->input->get('year')){
			$year = intval($this->input->get('year',true));
			$data['results'] = $this->gpf_model->search_rates_of_interest_by_year($year);
		}else{
			$data['results'] =[];// $this->gpf_model->get_rates_of_interest_last_15_years();
		}
		$this->load->view('layout/header');
		$this->load->view('pages/rates_of_interest',$data);
		$this->load->view('layout/footer');
	}
	public function circular_office_order(){
		$this->load->model('wing_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
/*		
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->wing_model->get_circular_office_order($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/agae/circular_office_order';
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;
		$config['total_rows'] = $response['total'];
		$this->pagination->initialize($config);
		
		$data['language_id']=$this->language_id;
*/	
		redirect('https://cag.gov.in/ae/west-bengal/en/ae-circulars-office-orders?cat=853');
		$this->load->view('layout/header');
		$this->load->view('pages/circular_office_order/agae',$data);
		$this->load->view('layout/footer');
	}
	public function tender_notice(){
		$this->load->model('wing_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
/*
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->wing_model->get_tender_notice($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/agae/tender_notice';
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;
		$config['total_rows'] = $response['total'];
		$this->pagination->initialize($config);
		
		$data['language_id']=$this->language_id;
*/		
		redirect('https://cag.gov.in/ae/west-bengal/en/tenders');
		$this->load->view('layout/header');
		$this->load->view('pages/tender_notice/agae',$data);
		$this->load->view('layout/footer');
	}

public function exam_result(){
	$this->load->model('wing_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
/*		
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->wing_model->get_exam_result($page_no);
		$data['result'] = $response['results'];
		
		$config['base_url'] = base_url().'/agae/exam_result';
		$config['per_page'] = PAGINATION_DATA_PER_PAGE;
		$config['total_rows'] = $response['total'];
		$this->pagination->initialize($config);		
		$data['language_id']=$this->language_id;
*/
		redirect('https://agwb.cag.gov.in');
		
		$this->load->view('layout/header');
		$this->load->view('pages/exam_result/agae',$data);
		$this->load->view('layout/footer');
}
}// End of Class
