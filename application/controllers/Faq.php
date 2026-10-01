<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends CI_Controller {
	function __construct() {
       parent::__construct();
		$this->lang->load('main','english');
		$this->load->model('faq_model');
		if($this->session->userdata('language_id')){
			$this->language_id = $this->session->userdata('language_id');
		}else{
			$this->language_id = 1;
		}
	}
	public function index(){
		$this->load->library('pagination');
		$data['results'] = array();
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$data['results'] = $this->faq_model->get_FAQs($page_no);
		$config['base_url'] = base_url().'/faq/index';
		$config['total_rows'] = $this->faq_model->get_TotalFAQs();
		$this->pagination->initialize($config);
		redirect('https://agwb.cag.gov.in');
		$this->load->view('layout/header');
		$this->load->view('pages/faq',$data);
		$this->load->view('layout/footer');
	}
	public function fund(){
		$this->load->library('pagination');
		$data['results'] = array();
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$data['results'] = $this->faq_model->get_Fund_FAQs($page_no);
		$config['base_url'] = base_url().'/faq/fund';
		$config['total_rows'] = $this->faq_model->get_Fund_TotalFAQs();
		$this->pagination->initialize($config);
		redirect('https://agwb.cag.gov.in');
		$this->load->view('layout/header');
		$this->load->view('pages/faq',$data);
		$this->load->view('layout/footer');
	}
	public function pension(){
		$this->load->library('pagination');
		$data['results'] = array();
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$data['results'] = $this->faq_model->get_Pensoins_FAQs($page_no);
		$config['base_url'] = base_url().'/faq/pension';
		$config['total_rows'] = $this->faq_model->get_Pensoins_TotalFAQs();
		$this->pagination->initialize($config);
		redirect('https://agwb.cag.gov.in');
		$this->load->view('layout/header');
		$this->load->view('pages/faq',$data);
		$this->load->view('layout/footer');
	}
	public function accounts(){
		$this->load->library('pagination');
		$data['results'] = array();
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$data['results'] = $this->faq_model->get_Accounts_FAQs($page_no);
		$config['base_url'] = base_url().'/faq/accounts';
		$config['total_rows'] = $this->faq_model->get_Accounts_TotalFAQs();
		$this->pagination->initialize($config);
		redirect('https://agwb.cag.gov.in');
		$this->load->view('layout/header');
		$this->load->view('pages/faq',$data);
		$this->load->view('layout/footer');
	}
	public function administrator(){
		$this->load->library('pagination');
		$data['results'] = array();
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$data['results'] = $this->faq_model->get_Administrator_FAQs($page_no);
		$config['base_url'] = base_url().'/faq/administrator';
		$config['total_rows'] = $this->faq_model->get_Administrator_TotalFAQs();
		$this->pagination->initialize($config);
		redirect('https://agwb.cag.gov.in');
		$this->load->view('layout/header');
		$this->load->view('pages/faq',$data);
		$this->load->view('layout/footer');
	}
	public function dacadre(){
		$this->load->library('pagination');
		$data['results'] = array();
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$data['results'] = $this->faq_model->get_Dacadre_FAQs($page_no);
		$config['base_url'] = base_url().'/faq/dacadre';
		$config['total_rows'] = $this->faq_model->get_Dacadre_TotalFAQs();
		$this->pagination->initialize($config);
		redirect('https://agwb.cag.gov.in');
		$this->load->view('layout/header');
		$this->load->view('pages/faq',$data);
		$this->load->view('layout/footer');
	}
	public function gssa(){
		$this->load->library('pagination');
		$data['results'] = array();
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$data['results'] = $this->faq_model->get_gssa_FAQs($page_no);
		$config['base_url'] = base_url().'/faq/gssa';
		$config['total_rows'] = $this->faq_model->get_gssa_TotalFAQs();
		$this->pagination->initialize($config);
		redirect('https://agwb.cag.gov.in');
		$this->load->view('layout/header');
		$this->load->view('pages/faq',$data);
		$this->load->view('layout/footer');
	}
	public function ersa(){
		$this->load->library('pagination');
		$data['results'] = array();
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$data['results'] = $this->faq_model->get_ersa_FAQs($page_no);
		$config['base_url'] = base_url().'/faq/ersa';
		$config['total_rows'] = $this->faq_model->get_ersa_TotalFAQs();
		$this->pagination->initialize($config);
		redirect('https://agwb.cag.gov.in');
		$this->load->view('layout/header');
		$this->load->view('pages/faq',$data);
		$this->load->view('layout/footer');
	}
}
