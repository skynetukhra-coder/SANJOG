<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Whats_new extends CI_Controller {
	function __construct() {
        parent::__construct();		
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
		$data['results'] = $this->common_model->get_whats_new('AGAE');
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/whats_new/list',$data);
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
			$data['row'] = $this->common_model->get_whats_new_by_id($id,'AGAE');
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		if($this->input->post()){
			$this->form_validation->set_rules('title', 'Title in English', 'trim|xss_clean|required');
			$this->form_validation->set_rules('title_hindi', 'Title in Hindi', 'trim|xss_clean|required');
			$this->form_validation->set_rules('title_bengali', 'Title in Bengali', 'trim|xss_clean|required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				// Add records
				$update = array(
							'title'			=> $this->input->post('title',true),
							'office'		=> 'AGAE',
							'title_hindi'	=> $this->input->post('title_hindi',true),
							'title_bengali'	=> $this->input->post('title_bengali',true),
							'url_link'		=> $this->input->post('url_link',true),
							'display'		=> $this->input->post('display',true),
							'expiry_dt'		=> date('Y-m-d',strtotime($this->input->post('expiry_dt',true))),
				);
				$error = '';
				if(isset($_FILES['link_file']) && $_FILES['link_file']['size'] > 0){
					//upload file
					$upload_details = $this->common_model->upload_tender_notice('link_file');
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
					}else{
						$update['link_file'] = $upload_details['filename'];
					}
				}
				if($error == ''){
					if(!empty($id)){ // edit
						$result = $this->common_model->update_whats_new($id,$update);
						$this->session->set_flashdata('success','Successfully updated.');
					}else{
						$update['create_dt'] = date('Y-m-d H:i:s');
						$id = $this->common_model->add_whats_new($update);
						$this->session->set_flashdata('success','Successfully added.');
					}
					redirect(ADMIN_BASE_URL.'whats_new');
				}
			}
		}
		
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/whats_new/add',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function delete(){
		if($this->admin_type == "g&ssa" || $this->admin_type == "e&rsa"){
			show_404();
		}
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->common_model->get_whats_new_by_id($id,'AGAE');
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->common_model->delete_whats_new($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'whats_new');
	}
	public function aggssa(){
		if($this->admin_type != "g&ssa" && $this->admin_type != "superadmin"){
			show_404();
		}
		$data['results'] = $this->common_model->get_whats_new('AGGSSA');
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/whats_new/aggssa',$data);
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
			$data['row'] = $this->common_model->get_whats_new_by_id($id,'AGGSSA');
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		if($this->input->post()){
			$this->form_validation->set_rules('title', 'Title in English', 'trim|xss_clean|required');
			$this->form_validation->set_rules('title_hindi', 'Title in Hindi', 'trim|xss_clean|required');
			$this->form_validation->set_rules('title_bengali', 'Title in Bengali', 'trim|xss_clean|required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				// Add records
				$update = array(
							'title'			=> $this->input->post('title',true),
							'office'		=> 'AGGSSA',
							'title_hindi'	=> $this->input->post('title_hindi',true),
							'title_bengali'	=> $this->input->post('title_bengali',true),
							'display'		=> $this->input->post('display',true),
							'expiry_dt'		=> date('Y-m-d',strtotime($this->input->post('expiry_dt',true))),
				);
				$error = '';
				if(isset($_FILES['link_file']) && $_FILES['link_file']['size'] > 0){
					//upload file
					$upload_details = $this->common_model->upload_file('link_file');
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
					}else{
						$update['link_file'] = $upload_details['filename'];
					}
				}
				if($error == ''){
					if(!empty($id)){ // edit
						$result = $this->common_model->update_whats_new($id,$update);
						$this->session->set_flashdata('success','Successfully updated.');
					}else{
						$update['create_dt'] = date('Y-m-d H:i:s');
						$id = $this->common_model->add_whats_new($update);
						$this->session->set_flashdata('success','Successfully added.');
					}
					redirect(ADMIN_BASE_URL.'whats_new/aggssa');
				}
			}
		}
		
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/whats_new/aggssa_add',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function aggssa_delete(){
		if($this->admin_type != "g&ssa" && $this->admin_type != "superadmin"){
			show_404();
		}
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->common_model->get_whats_new_by_id($id,'AGGSSA');
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->common_model->delete_whats_new($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'whats_new/aggssa');
	}
	
	public function agersa(){
		if($this->admin_type != "e&rsa" && $this->admin_type != "superadmin"){
			show_404();
		}
		$data['results'] = $this->common_model->get_whats_new('AGERSA');
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/whats_new/agersa',$data);
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
			$data['row'] = $this->common_model->get_whats_new_by_id($id,'AGERSA');
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		if($this->input->post()){
			$this->form_validation->set_rules('title', 'Title in English', 'trim|xss_clean|required');
			$this->form_validation->set_rules('title_hindi', 'Title in Hindi', 'trim|xss_clean|required');
			$this->form_validation->set_rules('title_bengali', 'Title in Hindi', 'trim|xss_clean|required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				// Add records
				$update = array(
							'title'			=> $this->input->post('title',true),
							'office'		=> 'AGERSA',
							'title_hindi'	=> $this->input->post('title_hindi',true),
							'title_bengali'	=> $this->input->post('title_bengali',true),
							'display'		=> $this->input->post('display',true),
							'expiry_dt'		=> date('Y-m-d',strtotime($this->input->post('expiry_dt',true))),
				);
				$error = '';
				if(isset($_FILES['link_file']) && $_FILES['link_file']['size'] > 0){
					//upload file
					$upload_details = $this->common_model->upload_file('link_file');
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
					}else{
						$update['link_file'] = $upload_details['filename'];
					}
				}
				if($error == ''){
					if(!empty($id)){ // edit
						$result = $this->common_model->update_whats_new($id,$update);
						$this->session->set_flashdata('success','Successfully updated.');
					}else{
						$update['create_dt'] = date('Y-m-d H:i:s');
						$id = $this->common_model->add_whats_new($update);
						$this->session->set_flashdata('success','Successfully added.');
					}
					redirect(ADMIN_BASE_URL.'whats_new/agersa');
				}
			}
		}
		
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/whats_new/agersa_add',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function agersa_delete(){
		if($this->admin_type != "e&rsa" && $this->admin_type != "superadmin"){
			show_404();
		}
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->common_model->get_whats_new_by_id($id,'AGERSA');
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->common_model->delete_whats_new($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'whats_new/agersa');
	}
	
} // End of Class
