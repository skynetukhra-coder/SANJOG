<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Video extends CI_Controller {
	function __construct() {
        parent::__construct();
		$this->load->model('common_model');
		$this->load->model('video_model');
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
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->video_model->get_admin_office_video($limit_to,'AGAE');
		$data['results'] = $response['results'];
		
		$config['base_url'] = ADMIN_BASE_URL.'video';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/video/list',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function add(){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->video_model->get_office_video_by_id($id,'AGAE');
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		if(isset($_FILES['video']) && $_FILES['video']['size'] > 0){
				$update = array(
							'office'	=> 'AGAE',
							'status'	=> 'ACTIVE'
				);
				$error = '';
				if(isset($_FILES['video']) && $_FILES['video']['size'] > 0){
					//upload file
					$upload_type = 'mp4|MP4';
					$path = 'videogallery';
					$upload_details = $this->common_model->upload_file('video',$upload_type,$path);
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
					}else{
						$update['file_name'] = $upload_details['filename'];
					}
				}
				if($error != ''){
					$this->session->set_flashdata('error',$error);
				}else{
					if(!empty($id)){ // edit
						$update['update_date'] = date('Y-m-d H:i:s');
						$result = $this->video_model->update_video($id,$update);
						$this->session->set_flashdata('success','Successfully updated.');
					}else{
						$update['create_date'] = date('Y-m-d H:i:s');
						$update['update_date'] = date('Y-m-d H:i:s');
						$id = $this->video_model->add_video($update);
						$this->session->set_flashdata('success','Successfully added.');
					}
					
					redirect(ADMIN_BASE_URL.'video');
				}
		}
		
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/video/add',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->video_model->get_office_video_by_id($id,'AGAE');
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->video_model->delete_video($id);
				if(isset($data['row']['file_name'])){
					@unlink('videogallery/'.$data['row']['file_name']);
				}
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'video');
	}
	
	public function aggssa(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->video_model->get_admin_office_video($limit_to,'AGGSSA');
		$data['results'] = $response['results'];
		
		$config['base_url'] = ADMIN_BASE_URL.'video/aggssa';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/video/aggssa',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function aggssa_add(){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$error = '';
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->video_model->get_office_video_by_id($id,'AGGSSA');
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		if(isset($_FILES['video']) && $_FILES['video']['size'] > 0){
				$update = array(
							'office'	=> 'AGGSSA',
							'status'	=> 'ACTIVE'
				);
				if(isset($_FILES['video']) && $_FILES['video']['size'] > 0){
					//upload file
					$upload_type = 'mp4|MP4';
					$path = 'videogallery';
					$upload_details = $this->common_model->upload_file('video',$upload_type,$path);
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
					}else{
						$update['file_name'] = $upload_details['filename'];
					}
				}
				if($error != ''){
					$this->session->set_flashdata('error',$error);
				}else{
					if(!empty($id)){ // edit
						$update['update_date'] = date('Y-m-d H:i:s');
						$result = $this->video_model->update_video($id,$update);
						$this->session->set_flashdata('success','Successfully updated.');
					}else{
						$update['create_date'] = date('Y-m-d H:i:s');
						$update['update_date'] = date('Y-m-d H:i:s');
						$id = $this->video_model->add_video($update);
						$this->session->set_flashdata('success','Successfully added.');
					}
					
					redirect(ADMIN_BASE_URL.'video/aggssa');
				}
		}
		
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/video/aggssa_add',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function aggssa_delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->video_model->get_office_video_by_id($id,'AGGSSA');
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->video_model->delete_video($id);
				if(isset($data['row']['file_name'])){
					@unlink('videogallery/'.$data['row']['file_name']);
				}
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'video/aggssa');
	}
	public function agersa(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->video_model->get_admin_office_video($limit_to,'AGERSA');
		$data['results'] = $response['results'];
		
		$config['base_url'] = ADMIN_BASE_URL.'video/agersa';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/video/agersa',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function agersa_add(){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$error = '';
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->video_model->get_office_video_by_id($id,'AGERSA');
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		if(isset($_FILES['video']) && $_FILES['video']['size'] > 0){
				$update = array(
							'office'	=> 'AGERSA',
							'status'	=> 'ACTIVE'
				);
				if(isset($_FILES['video']) && $_FILES['video']['size'] > 0){
					//upload file
					$upload_type = 'mp4|MP4';
					$path = 'videogallery';
					$upload_details = $this->common_model->upload_file('video',$upload_type,$path);
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
					}else{
						$update['file_name'] = $upload_details['filename'];
					}
				}
				if($error != ''){
					$this->session->set_flashdata('error',$error);
				}else{
					if(!empty($id)){ // edit
						$update['update_date'] = date('Y-m-d H:i:s');
						$result = $this->video_model->update_video($id,$update);
						$this->session->set_flashdata('success','Successfully updated.');
					}else{
						$update['create_date'] = date('Y-m-d H:i:s');
						$update['update_date'] = date('Y-m-d H:i:s');
						$id = $this->video_model->add_video($update);
						$this->session->set_flashdata('success','Successfully added.');
					}
					
					redirect(ADMIN_BASE_URL.'video/agersa');
				}
		}
		
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/video/agersa_add',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function agersa_delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->video_model->get_office_video_by_id($id,'AGERSA');
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->video_model->delete_video($id);
				if(isset($data['row']['file_name'])){
					@unlink('videogallery/'.$data['row']['file_name']);
				}
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'video/aggssa');
	}
	
} // End of Class
