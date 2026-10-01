<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site extends CI_Controller {
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
	public function accounts_entitlement($seg=''){
		$data['site_for'] = 'main';
		$data['tabs'] = array();
		if($seg == 'accounts'){
			$data['site_for'] = 'Accounts';
			$data['tabs'][0] = array(
								'title'	=> 'Annual Accounts',
								'sub'=>array(
											array(
												'title'		=> 'Monthly Civil Accounts',
												'details'	=> array()
											),
											array(
												'title'		=> 'Finance Accounts Volume - I',
												'details'	=> array()
											),
											array(
												'title'		=> 'Finance Accounts Volume - II',
												'details'	=> array()
											),
											array(
												'title'		=> 'Appropriation Accounts',
												'details'	=> array()
											),
											array(
												'title'		=> 'Accounts at a Glance',
												'details'	=> array()
											)
									)
							);
			$data['tabs'][1] = array(
								'title'	=> 'Annual Review /Reports',
								'sub'=>array(
											array(
												'title'		=> 'AG (A&E), WB',
												'details'	=> array()
											),
											array(
												'title'		=> 'Pr. AG(G&SSA), WB',
												'details'	=> array()
											),
											array(
												'title'		=> 'AG (E&RSA), WB',
												'details'	=> array()
											)
									)
							);
		}
		$this->load->view('layout/header');
		$this->load->view('pages/on_this_site',$data);
		$this->load->view('layout/footer');
	}
	public function on_this_site(){
		$data['about_us'] = $this->page_model->getPageByURL($this->language_id,'about-us');
		$data['blocks'] = $this->page_model->getAllBlocks($this->language_id);
		$this->load->view('layout/header');
		$this->load->view('pages/home',$data);
		$this->load->view('layout/footer');
	}


}// End of Class
