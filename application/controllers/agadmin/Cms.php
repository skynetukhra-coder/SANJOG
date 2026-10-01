<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cms extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('common_model');
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
		$response = $this->page_model->getFooterPages($limit_to);
		$data['results'] = $response['results'];
		$config['base_url'] = ADMIN_BASE_URL.'footer_pages';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/cms/list',$data);
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
			$data['row'] = $this->page_model->getFooterPageById($id);
			$page_details = $this->page_model->getFooterPageDetailsById($id);
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
			$this->form_validation->set_rules('status', 'Status', 'xss_clean|required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				$update = array(
							'page_url'			=> $this->input->post('page_url',true),
							'page_name'			=> $this->input->post('page_name',true),
							//'sort'				=> $this->input->post('sort',true),
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
					$result = $this->page_model->updateFooterPage($id,$update);
					foreach($page_details as $language_id=>$page){
						$page['page_id'] = $id;
						$result = $this->page_model->updateFooterPageDetails($id,$language_id,$page);
					}
					$this->session->set_flashdata('success','Successfully updated.');
				}else{
					$update['page_create_date'] = date('Y-m-d H:i:s');
					$id = $this->page_model->addFooterPage($update);
					foreach($page_details as $page){
						$page['page_id'] = $id;
						$result = $this->page_model->addFooterPageDetails($page);
					}
					$this->session->set_flashdata('success','Successfully added.');
				}
				
				redirect(ADMIN_BASE_URL.'footer_pages');
			}
			
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/cms/add',$data);
		$this->load->view('agadmin/layout/footer');
	}
	function pageurl_check($str){
		$id = $this->uri->segment(4);
		if($id){ // edit
			$res = $this->db->get_where('page_common_cms',array('page_url'=>$str,'page_id !='=>$id));
			if($res->num_rows() > 0){
			 	$this->form_validation->set_message('pageurl_check', $str.' already exists! use another.');
          		return FALSE;
			}else{
				return true;
			}
		}else{
			$res = $this->db->get_where('page_common_cms',array('page_url'=>$str));
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
			$data['row'] = $this->page_model->getFooterPageById($id);
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->page_model->deleteFooterPage($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'footer_pages');
	}
	public function check_url_exists(){
		$id = $this->uri->segment(4);
		$str = $this->input->get('url');
		$status =  FALSE;
		if($id){ // edit
			$res = $this->db->get_where('page_common_cms',array('page_url'=>$str,'page_id !='=>$id));
			if($res->num_rows() > 0){
          		$status =  TRUE;
			}else{
				$status =  FALSE;;
			}
		}else{
			$res = $this->db->get_where('page_common_cms',array('page_url'=>$str));
			if($res->num_rows() > 0){
          		$status =  TRUE;;
			}else{
				$status =  FALSE;;
			}
		}
		echo json_encode(array('status'=>$status));
	}
	
} // End of Class
