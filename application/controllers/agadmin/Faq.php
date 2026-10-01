<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faq extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('faq_model');
		$this->load->model('common_model');
		$this->load->library('form_validation');
		$this->load->helper('admin_helper');
		$this->load->helper('security');	
		$this->admin = '';
		if($this->session->userdata('admin_details')){
			$this->admin = $this->session->userdata('admin_details');
		}else{
			redirect('admin');
		}
		$this->admin_type = strtolower($this->admin['admin_type_name']);
	}
	
	public function index(){
		if($this->admin_type == "g&ssa" || $this->admin_type == "e&rsa"){
			show_404();
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->faq_model->get_admin_faq($limit_to);
		$data['results'] = $response['results'];
		
		$config['base_url'] = ADMIN_BASE_URL.'faq';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/faq/list',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function add(){
		if($this->admin_type == "g&ssa" || $this->admin_type == "e&rsa"){
			show_404();
		}
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->faq_model->getAdminFAQById($id);
			$page_details = $this->faq_model->getAdminFAQDetailsById($id);
			foreach($page_details as $page){
				$data['page_details'][$page['language_id']] = $page;
			}
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$data['lang'] = $this->common_model->getAllLang();
		if($this->input->post()){
			$this->form_validation->set_rules('wing', 'Wing', 'trim|xss_clean|required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				// Add records
				
				$update = array(
							'wing'		=> $this->input->post('wing',true),
							'status'	=> 'ACTIVE'
				);
				$update_lang = $this->input->post('lang');
				$page_details = array();
				foreach($update_lang as $lang_id=>$l){
					$faq_details[$lang_id] = array(
										'language_id'	=> $lang_id,
										'category'		=> $l['category'],
										'question'		=> $l['question'],
										'answer'		=> $l['answer'],
									);
				}
				if(!empty($id)){ // edit
					$update['update_date'] = date('Y-m-d H:i:s');
					$result = $this->faq_model->updateFAQ($id,$update);
					foreach($faq_details as $language_id=>$faq){
						$faq['faq_id'] = $id;
						$result = $this->faq_model->updateFAQDetails($id,$language_id,$faq);
					}
					$this->session->set_flashdata('success','Successfully updated.');
				}else{
					$update['create_date'] = date('Y-m-d H:i:s');
					$update['update_date'] = date('Y-m-d H:i:s');
					$id = $this->faq_model->addFAQ($update);
					foreach($faq_details as $faq){
						$faq['faq_id'] = $id;
						$result = $this->faq_model->addFAQDetails($faq);
					}
					$this->session->set_flashdata('success','Successfully added.');
				}
				
				redirect(ADMIN_BASE_URL.'faq');
			}
		}
		
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/faq/add',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function delete(){
		if($this->admin_type == "g&ssa" || $this->admin_type == "e&rsa"){
			show_404();
		}
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->faq_model->getAdminFAQById($id);
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->faq_model->deleteFAQById($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'faq');
	}
	
	public function aggssa(){
		if($this->admin_type != "g&ssa" && $this->admin_type != "superadmin"){
			show_404();
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->faq_model->get_admin_faq($limit_to,'G&SSA');
		$data['results'] = $response['results'];
		
		$config['base_url'] = ADMIN_BASE_URL.'faq/aggssa';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/faq/aggssa',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function aggssa_add(){
		if($this->admin_type != "g&ssa" && $this->admin_type != "superadmin"){
			show_404();
		}
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->faq_model->getAdminFAQById($id,'G&SSA');
			$page_details = $this->faq_model->getAdminFAQDetailsById($id);
			foreach($page_details as $page){
				$data['page_details'][$page['language_id']] = $page;
			}
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$data['lang'] = $this->common_model->getAllLang();
		if($this->input->post()){
			
				// Add records
				
				$update = array(
							'wing'		=> 'G&SSA',
							'status'	=> 'ACTIVE'
				);
				$update_lang = $this->input->post('lang');
				$page_details = array();
				foreach($update_lang as $lang_id=>$l){
					$faq_details[$lang_id] = array(
										'language_id'	=> $lang_id,
										'category'		=> $l['category'],
										'question'		=> $l['question'],
										'answer'		=> $l['answer'],
									);
				}
				if(!empty($id)){ // edit
					$update['update_date'] = date('Y-m-d H:i:s');
					$result = $this->faq_model->updateFAQ($id,$update);
					foreach($faq_details as $language_id=>$faq){
						$faq['faq_id'] = $id;
						$result = $this->faq_model->updateFAQDetails($id,$language_id,$faq);
					}
					$this->session->set_flashdata('success','Successfully updated.');
				}else{
					$update['create_date'] = date('Y-m-d H:i:s');
					$update['update_date'] = date('Y-m-d H:i:s');
					$id = $this->faq_model->addFAQ($update);
					foreach($faq_details as $faq){
						$faq['faq_id'] = $id;
						$result = $this->faq_model->addFAQDetails($faq);
					}
					$this->session->set_flashdata('success','Successfully added.');
				}
				
				redirect(ADMIN_BASE_URL.'faq/aggssa');
			
		}
		
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/faq/aggssa_add',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function aggssa_delete(){
		if($this->admin_type != "g&ssa" && $this->admin_type != "superadmin"){
			show_404();
		}
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->faq_model->getAdminFAQById($id,'G&SSA');
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->faq_model->deleteFAQById($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'faq/aggssa');
	}
	public function agersa(){
		if($this->admin_type != "e&rsa" && $this->admin_type != "superadmin"){
			show_404();
		}
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->faq_model->get_admin_faq($limit_to,'E&RSA');
		$data['results'] = $response['results'];
		
		$config['base_url'] = ADMIN_BASE_URL.'faq/agersa';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/faq/agersa',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function agersa_add(){
		if($this->admin_type != "e&rsa" && $this->admin_type != "superadmin"){
			show_404();
		}
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->faq_model->getAdminFAQById($id,'E&RSA');
			$page_details = $this->faq_model->getAdminFAQDetailsById($id);
			foreach($page_details as $page){
				$data['page_details'][$page['language_id']] = $page;
			}
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$data['lang'] = $this->common_model->getAllLang();
		if($this->input->post()){
			
				// Add records
				
				$update = array(
							'wing'		=> 'E&RSA',
							'status'	=> 'ACTIVE'
				);
				$update_lang = $this->input->post('lang');
				$page_details = array();
				foreach($update_lang as $lang_id=>$l){
					$faq_details[$lang_id] = array(
										'language_id'	=> $lang_id,
										'category'		=> $l['category'],
										'question'		=> $l['question'],
										'answer'		=> $l['answer'],
									);
				}
				if(!empty($id)){ // edit
					$update['update_date'] = date('Y-m-d H:i:s');
					$result = $this->faq_model->updateFAQ($id,$update);
					foreach($faq_details as $language_id=>$faq){
						$faq['faq_id'] = $id;
						$result = $this->faq_model->updateFAQDetails($id,$language_id,$faq);
					}
					$this->session->set_flashdata('success','Successfully updated.');
				}else{
					$update['create_date'] = date('Y-m-d H:i:s');
					$update['update_date'] = date('Y-m-d H:i:s');
					$id = $this->faq_model->addFAQ($update);
					foreach($faq_details as $faq){
						$faq['faq_id'] = $id;
						$result = $this->faq_model->addFAQDetails($faq);
					}
					$this->session->set_flashdata('success','Successfully added.');
				}
				
				redirect(ADMIN_BASE_URL.'faq/agersa');
			
		}
		
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/faq/agersa_add',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function agersa_delete(){
		if($this->admin_type != "e&rsa" && $this->admin_type != "superadmin"){
			show_404();
		}
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->faq_model->getAdminFAQById($id,'E&RSA');
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->faq_model->deleteFAQById($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'faq/agersa');
	}
	
} // End of Class
