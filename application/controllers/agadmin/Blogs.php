<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blogs extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('common_model');
		$this->load->model('page_model');
		$this->load->library('form_validation');
		$this->admin = '';
		if($this->session->userdata('admin_details')){
			$this->admin = $this->session->userdata('admin_details');
		}else{
			show_404();
		}
	}
	public function index(){
		$data['results'] = $this->page_model->getAllPages();
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/pages_list',$data);
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
			$this->form_validation->set_rules('page_name', 'Page Name', 'required');
			$this->form_validation->set_rules('status', 'Status', 'required');
			if ($this->form_validation->run() == FALSE){
				//$this->session->set_flashdata('error',validation_errors());
			}else{
				// Add records
				
				$update = array(
							'page_name'		=> $this->input->post('page_name'),
							'type'			=> 'BLOG',
							'status'		=> $this->input->post('status'),
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
				
				redirect(ADMIN_BASE_URL.'contents');
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/blogs_add',$data);
		$this->load->view('agadmin/layout/footer');
	}
	 function pageurl_check($str){
		$id = $this->uri->segment(4);
		if($id){ // edit
			$res = $this->db->get_where('page',array('page_url'=>$str,'page_id !='=>$id));
			if($res->num_rows() > 0){
			 	$this->form_validation->set_message('pageurl_check', $str.' already exists! use another.');
          		return FALSE;
			}else{
				return true;
			}
		}else{
			$res = $this->db->get_where('page',array('page_url'=>$str));
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
				$this->user_model->deletePage($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'contents');
	}
	
	public function check_url_exists(){
		$id = $this->uri->segment(4);
		$str = $this->input->get('url');
		$status =  FALSE;
		if($id){ // edit
			$res = $this->db->get_where('page',array('page_url'=>$str,'page_id !='=>$id));
			if($res->num_rows() > 0){
          		$status =  TRUE;
			}else{
				$status =  FALSE;;
			}
		}else{
			$res = $this->db->get_where('page',array('page_url'=>$str));
			if($res->num_rows() > 0){
          		$status =  TRUE;;
			}else{
				$status =  FALSE;;
			}
		}
		echo json_encode(array('status'=>$status));
	}
	
} // End of Class
