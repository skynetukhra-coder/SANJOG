<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Links extends CI_Controller {
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
		$data['results'] = $this->page_model->getAdminAllPageList();
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/pages_list',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function add_agae(){
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
		if($this->input->post()){
			$this->form_validation->set_rules('page_name', 'Link Name', 'trim|xss_clean|required');
			//$this->form_validation->set_rules('page_url', 'Link URL', 'required|callback_pageurl_check',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('wing', 'Wing', 'xss_clean');
			$this->form_validation->set_rules('status', 'Status', 'trim|xss_clean|required');
			if ($this->form_validation->run() == FALSE){
				//$this->session->set_flashdata('error',validation_errors());
			}else{
			
				$update = array(
							//'page_url'		=> $this->input->post('page_url',true),
							'page_name'		=> $this->input->post('page_name',true),
							'type'			=> 'LINK',
							'page_office_code'	=> 'AGAE',
							'wing'			=> $this->input->post('wing',true),
							'status'		=> $this->input->post('status',true),
							'filename'		=> $this->input->post('file_name',true),
				);
				if(isset($_FILES['up_file'])){
					//upload file
					$upload_details = $this->common_model->upload_file('up_file');
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
					}else{
						$update['filename'] = $upload_details['filename'];
					}
				}else{
					$this->session->set_flashdata('error','Please upload file');
				}
				if(!empty($id)){ // edit
					$result = $this->page_model->updatePage($id,$update);
					$this->session->set_flashdata('success','Successfully updated.');
				}else{
					$update['page_create_date'] = date('Y-m-d H:i:s');
					$id = $this->page_model->addPage($update);
					$this->session->set_flashdata('success','Successfully added.');
				}
				
				redirect(ADMIN_BASE_URL.'contents/agae');
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/links/add_agae',$data);
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
		if($this->input->post()){
			$this->form_validation->set_rules('page_name', 'Link Name', 'trim|xss_clean|required');
			//$this->form_validation->set_rules('page_url', 'Link URL', 'required|callback_pageurl_check',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('status', 'Status', 'trim|xss_clean|required');
			if ($this->form_validation->run() == FALSE){
				//$this->session->set_flashdata('error',validation_errors());
			}else{
			
				$update = array(
							//'page_url'		=> $this->input->post('page_url',true),
							'page_name'		=> $this->input->post('page_name',true),
							'type'			=> 'LINK',
							'page_office_code'	=> 'AGGSSA',
							'wing'			=> '',
							'status'		=> $this->input->post('status',true),
							'filename'		=> $this->input->post('file_name',true),
				);
				if(isset($_FILES['up_file'])){
					//upload file
					$upload_details = $this->common_model->upload_file('up_file');
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
					}else{
						$update['filename'] = $upload_details['filename'];
					}
				}else{
					$this->session->set_flashdata('error','Please upload file');
				}
				if(!empty($id)){ // edit
					$result = $this->page_model->updatePage($id,$update);
					$this->session->set_flashdata('success','Successfully updated.');
				}else{
					$update['page_create_date'] = date('Y-m-d H:i:s');
					$id = $this->page_model->addPage($update);
					$this->session->set_flashdata('success','Successfully added.');
				}
				
				redirect(ADMIN_BASE_URL.'contents/aggssa');
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/links/add_aggssa',$data);
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
		if($this->input->post()){
			$this->form_validation->set_rules('page_name', 'Link Name', 'trim|xss_clean|required');
			//$this->form_validation->set_rules('page_url', 'Link URL', 'required|callback_pageurl_check',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('status', 'Status', 'trim|xss_clean|required');
			if ($this->form_validation->run() == FALSE){
				//$this->session->set_flashdata('error',validation_errors());
			}else{
			
				$update = array(
							//'page_url'		=> $this->input->post('page_url',true),
							'page_name'		=> $this->input->post('page_name',true),
							'type'			=> 'LINK',
							'page_office_code'	=> 'AGERSA',
							'wing'			=> '',
							'status'		=> $this->input->post('status',true),
							'filename'		=> $this->input->post('file_name',true),
				);
				if(isset($_FILES['up_file'])){
					//upload file
					$upload_details = $this->common_model->upload_file('up_file');
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
					}else{
						$update['filename'] = $upload_details['filename'];
					}
				}else{
					$this->session->set_flashdata('error','Please upload file');
				}
				if(!empty($id)){ // edit
					$result = $this->page_model->updatePage($id,$update);
					$this->session->set_flashdata('success','Successfully updated.');
				}else{
					$update['page_create_date'] = date('Y-m-d H:i:s');
					$id = $this->page_model->addPage($update);
					$this->session->set_flashdata('success','Successfully added.');
				}
				
				redirect(ADMIN_BASE_URL.'contents/agersa');
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/links/add_agersa',$data);
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
