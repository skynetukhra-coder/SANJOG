<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('common_model');
		$this->load->model('user_model');
		$this->load->model('page_model');
		$this->load->library('form_validation');
		$this->load->helper('security');	
		$this->admin = '';
		if($this->session->userdata('admin_details')){
			$this->admin = $this->session->userdata('admin_details');
		}else{
			redirect('admin');
		}
	}
	public function index(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		if(strtolower($this->session->userdata('admin_type')) != 'superadmin'){
			$wing = strtolower($this->session->userdata('admin_type'));
			$response = $this->page_model->getAdminWingAllPages($limit_to,$wing);
		}else{
			$response = $this->page_model->getAdminAllPages($limit_to);
		}
		$data['results'] = $response['results'];
		$config['base_url'] = ADMIN_BASE_URL.'contents/agae';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/contents/list_agae',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function add(){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		//$data['wings'] = $this->user_model->getAllWings();
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->page_model->getPageById($id);
			$page_details = $this->page_model->getPageDetailsById($id);
			foreach($page_details as $page){
				$data['page_details'][$page['language_id']] = $page;
			}
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$data['lang'] = $this->common_model->getAllLang();
		if($this->input->post()){
			$this->form_validation->set_rules('page_name', 'Page Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('page_url', 'Page URL', 'trim|xss_clean|required|callback_pageurl_check',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('wing', 'Wing', 'xss_clean');
			$this->form_validation->set_rules('status', 'Status', 'xss_clean|required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				// Add records
				if(strtolower($this->session->userdata('admin_type')) != 'superadmin'){
					$wing = strtolower($this->session->userdata('admin_type'));
				}else{
					$wing = $this->input->post('wing',true);
				}
				$update = array(
							'page_url'			=> $this->input->post('page_url',true),
							'page_name'			=> $this->input->post('page_name',true),
							'page_office_code'	=> 'AGAE',
							'wing'				=> $wing,
							'status'			=> $this->input->post('status',true),
							'meta_title'		=> $this->input->post('meta_title',true),
							'meta_keywords'		=> $this->input->post('meta_keywords',true),
							'meta_description'	=> $this->input->post('meta_description',true),
				);
				$update_lang = $this->input->post('lang');
				$page_details = array();
				foreach($update_lang as $lang_id=>$l){
					$page_details[$lang_id] = array(
										'language_id'		=> $lang_id,
										'page_title'		=> $l['page_title'],
										'page_desc'			=> $l['page_desc'],
									);
				}
				if(!empty($id)){ // edit
					$result = $this->page_model->updatePage($id,$update);
					foreach($page_details as $language_id=>$page){
						$page['page_id'] = $id;
						$result = $this->page_model->updatePageDetails($id,$language_id,$page);
					}
					$this->session->set_flashdata('success','Successfully updated.');
				}else{
					$update['page_create_date'] = date('Y-m-d H:i:s');
					$id = $this->page_model->addPage($update);
					foreach($page_details as $page){
						$page['page_id'] = $id;
						$result = $this->page_model->addPageDetails($page);
					}
					$this->session->set_flashdata('success','Successfully added.');
				}
				
				redirect(ADMIN_BASE_URL.'contents/agae');
			}
			
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/contents/add_agae',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function aggssa(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->page_model->getAdminOfficePages('AGGSSA',$limit_to);
		$data['results'] = $response['results'];
		$config['base_url'] = ADMIN_BASE_URL.'contents/aggssa';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/contents/list_aggssa',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function add_aggssa(){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		//$data['wings'] = $this->user_model->getAllWings();
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->page_model->getPageById($id);
			$page_details = $this->page_model->getPageDetailsById($id);
			foreach($page_details as $page){
				$data['page_details'][$page['language_id']] = $page;
			}
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$data['lang'] = $this->common_model->getAllLang();
		if($this->input->post()){
			$this->form_validation->set_rules('page_name', 'Page Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('page_url', 'Page URL', 'trim|xss_clean|required|callback_pageurl_check_aggssa',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('status', 'Status', 'xss_clean|required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				// Add records
				$update = array(
							'page_url'			=> $this->input->post('page_url',true),
							'page_name'			=> $this->input->post('page_name',true),
							'page_office_code'	=> 'AGGSSA',
							'wing'				=> 'G&SSA',
							'status'			=> $this->input->post('status',true),
							'meta_title'		=> $this->input->post('meta_title',true),
							'meta_keywords'		=> $this->input->post('meta_keywords',true),
							'meta_description'	=> $this->input->post('meta_description',true),
				);
				$update_lang = $this->input->post('lang');
				$page_details = array();
				foreach($update_lang as $lang_id=>$l){
					$page_details[$lang_id] = array(
										'language_id'		=> $lang_id,
										'page_title'		=> $l['page_title'],
										'page_desc'			=> $l['page_desc'],
									);
				}
				if(!empty($id)){ // edit
					$result = $this->page_model->updatePage($id,$update);
					foreach($page_details as $language_id=>$page){
						$page['page_id'] = $id;
						$result = $this->page_model->updatePageDetails($id,$language_id,$page);
					}
					$this->session->set_flashdata('success','Successfully updated.');
				}else{
					$update['page_create_date'] = date('Y-m-d H:i:s');
					$id = $this->page_model->addPage($update);
					foreach($page_details as $page){
						$page['page_id'] = $id;
						$result = $this->page_model->addPageDetails($page);
					}
					$this->session->set_flashdata('success','Successfully added.');
				}
				
				redirect(ADMIN_BASE_URL.'contents/aggssa');
			}
			
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/contents/add_aggssa',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function agersa(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->page_model->getAdminOfficePages('AGERSA',$limit_to);
		$data['results'] = $response['results'];
		$config['base_url'] = ADMIN_BASE_URL.'contents/agersa';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/contents/list_agersa',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function add_agersa(){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		//$data['wings'] = $this->user_model->getAllWings();
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->page_model->getPageById($id);
			$page_details = $this->page_model->getPageDetailsById($id);
			foreach($page_details as $page){
				$data['page_details'][$page['language_id']] = $page;
			}
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$data['lang'] = $this->common_model->getAllLang();
		if($this->input->post()){
			$this->form_validation->set_rules('page_name', 'Page Name', 'trim|required|xss_clean');
			$this->form_validation->set_rules('page_url', 'Page URL', 'trim|xss_clean|required|callback_pageurl_check_agersa',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('status', 'Status', 'xss_clean|required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				// Add records
				$update = array(
							'page_url'			=> $this->input->post('page_url',true),
							'page_name'			=> $this->input->post('page_name',true),
							'page_office_code'	=> 'AGERSA',
							'wing'				=> 'E&RSA',
							'status'			=> $this->input->post('status',true),
							'meta_title'		=> $this->input->post('meta_title',true),
							'meta_keywords'		=> $this->input->post('meta_keywords',true),
							'meta_description'	=> $this->input->post('meta_description',true),
				);
				$update_lang = $this->input->post('lang');
				$page_details = array();
				foreach($update_lang as $lang_id=>$l){
					$page_details[$lang_id] = array(
										'language_id'		=> $lang_id,
										'page_title'		=> $l['page_title'],
										'page_desc'			=> $l['page_desc'],
									);
				}
				if(!empty($id)){ // edit
					$result = $this->page_model->updatePage($id,$update);
					foreach($page_details as $language_id=>$page){
						$page['page_id'] = $id;
						$result = $this->page_model->updatePageDetails($id,$language_id,$page);
					}
					$this->session->set_flashdata('success','Successfully updated.');
				}else{
					$update['page_create_date'] = date('Y-m-d H:i:s');
					$id = $this->page_model->addPage($update);
					foreach($page_details as $page){
						$page['page_id'] = $id;
						$result = $this->page_model->addPageDetails($page);
					}
					$this->session->set_flashdata('success','Successfully added.');
				}
				
				redirect(ADMIN_BASE_URL.'contents/agersa');
			}
			
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/contents/add_agersa',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	function pageurl_check($str){
		$id = $this->uri->segment(4);
		if($id){ // edit
			$res = $this->db->get_where('page',array('page_office_code'=>'AGAE','page_url'=>$str,'page_id !='=>$id));
			if($res->num_rows() > 0){
			 	$this->form_validation->set_message('pageurl_check', $str.' already exists! use another.');
          		return FALSE;
			}else{
				return true;
			}
		}else{
			$res = $this->db->get_where('page',array('page_office_code'=>'AGAE','page_url'=>$str));
			if($res->num_rows() > 0){
			 	$this->form_validation->set_message('pageurl_check', $str.' already exists! use another.');
          		return FALSE;
			}else{
				return true;
			}
		}
		
	}
	function pageurl_check_aggssa($str){
		$id = $this->uri->segment(4);
		if($id){ // edit
			$res = $this->db->get_where('page',array('page_office_code'=>'AGGSSA','page_url'=>$str,'page_id !='=>$id));
			if($res->num_rows() > 0){
			 	$this->form_validation->set_message('pageurl_check', $str.' already exists! use another.');
          		return FALSE;
			}else{
				return true;
			}
		}else{
			$res = $this->db->get_where('page',array('page_office_code'=>'AGGSSA','page_url'=>$str));
			if($res->num_rows() > 0){
			 	$this->form_validation->set_message('pageurl_check', $str.' already exists! use another.');
          		return FALSE;
			}else{
				return true;
			}
		}
		
	}
	function pageurl_check_agersa($str){
		$id = $this->uri->segment(4);
		if($id){ // edit
			$res = $this->db->get_where('page',array('page_office_code'=>'AGERSA','page_url'=>$str,'page_id !='=>$id));
			if($res->num_rows() > 0){
			 	$this->form_validation->set_message('pageurl_check', $str.' already exists! use another.');
          		return FALSE;
			}else{
				return true;
			}
		}else{
			$res = $this->db->get_where('page',array('page_office_code'=>'AGERSA','page_url'=>$str));
			if($res->num_rows() > 0){
			 	$this->form_validation->set_message('pageurl_check', $str.' already exists! use another.');
          		return FALSE;
			}else{
				return true;
			}
		}
		
	}
	public function delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->page_model->getPageById($id);
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->page_model->deletePage($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'contents');
	}
	public function delete_aggssa(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->page_model->getPageById($id);
			if(empty($data['row'])){
				show_404('admin');
			}else if($data['row']['page_office_code'] != 'AGGSSA'){
				show_404('admin');
			}else{
				$this->page_model->deletePage($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'contents/aggssa');
	}
	public function delete_agersa(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->page_model->getPageById($id);
			if(empty($data['row'])){
				show_404('admin');
			}else if($data['row']['page_office_code'] != 'AGERSA'){
				show_404('admin');
			}else{
				$this->page_model->deletePage($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'contents/agersa');
	}
	
	public function check_url_exists(){
		$id = $this->uri->segment(4);
		$str = $this->input->get('url');
		$office = $this->input->get('office');
		$status =  FALSE;
		if($id){ // edit
			$res = $this->db->get_where('page',array('page_url'=>$str,'page_office_code'=>$office,'page_id !='=>$id));
			if($res->num_rows() > 0){
          		$status =  TRUE;
			}else{
				$status =  FALSE;;
			}
		}else{
			$res = $this->db->get_where('page',array('page_url'=>$str,'page_office_code'=>$office));
			if($res->num_rows() > 0){
          		$status =  TRUE;;
			}else{
				$status =  FALSE;;
			}
		}
		echo json_encode(array('status'=>$status));
	}
	
} // End of Class
