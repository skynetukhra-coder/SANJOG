<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends CI_Controller {
	function __construct() {
        parent::__construct();
		$this->load->model('common_model');
		$this->load->model('gallery_model');
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
		$response = $this->gallery_model->get_admin_office_gallery($limit_to,'AGAE');
		$data['results'] = $response['results'];
		
		$config['base_url'] = ADMIN_BASE_URL.'gallery';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gallery/list',$data);
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
			$data['row'] = $this->gallery_model->get_office_gallery_by_id($id,'AGAE');
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		if($this->input->post()){
				$update = array(
							'office'	=> 'AGAE',
							'title'=> $this->input->post('title',true),
							'title_hindi'=> $this->input->post('title_hindi',true),
							'title_bengali'=> $this->input->post('title_bengali',true),
							'status'	=> 'ACTIVE'
				);
				if(isset($_FILES['image']) && $_FILES['image']['size'] > 0){
					//upload file
					$upload_type = 'JPG|jpg|PNG|png';
					$path = 'galleryIMG';
					$upload_details = $this->common_model->upload_file('image',$upload_type,$path);
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
					}else{
						$update['image'] = $upload_details['filename'];
						$this->common_model->image_resize_thumb($path,$update['image']);
						$this->common_model->image_resize_medium($path,$update['image']);
					}
				}
				if(!empty($id)){ // edit
					$update['update_date'] = date('Y-m-d H:i:s');
					$result = $this->gallery_model->update_gallery($id,$update);
					$this->session->set_flashdata('success','Successfully updated.');
				}else{
					$update['create_date'] = date('Y-m-d H:i:s');
					$update['update_date'] = date('Y-m-d H:i:s');
					$id = $this->gallery_model->add_gallery($update);
					$this->session->set_flashdata('success','Successfully added.');
				}
				
				redirect(ADMIN_BASE_URL.'gallery');
		}
		
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gallery/add',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->gallery_model->get_office_gallery_by_id($id,'AGAE');
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->gallery_model->delete_gallery($id);
				if(isset($data['row']['image'])){
					@unlink('galleryIMG/'.$data['row']['image']);
					@unlink('galleryIMG/thumb/'.$data['row']['image']);
					@unlink('galleryIMG/medium/'.$data['row']['image']);
				}
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'gallery');
	}
	
	public function aggssa(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->gallery_model->get_admin_office_gallery($limit_to,'AGGSSA');
		$data['results'] = $response['results'];
		
		$config['base_url'] = ADMIN_BASE_URL.'gallery/aggssa';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gallery/aggssa',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function aggssa_add(){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->gallery_model->get_office_gallery_by_id($id,'AGGSSA');
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		if($this->input->post()){
				$update = array(
							'office'	=> 'AGGSSA',
							'title'=> $this->input->post('title',true),
							'title_hindi'=> $this->input->post('title_hindi',true),
							'status'	=> 'ACTIVE'
				);
				if(isset($_FILES['image']) && $_FILES['image']['size'] > 0){
					//upload file
					$upload_type = 'JPG|jpg|PNG|png';
					$path = 'galleryIMG';
					$upload_details = $this->common_model->upload_file('image',$upload_type,$path);
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
					}else{
						$update['image'] = $upload_details['filename'];
						$this->common_model->image_resize_thumb($path,$update['image']);
						$this->common_model->image_resize_medium($path,$update['image']);
					}
				}
				if(!empty($id)){ // edit
					$update['update_date'] = date('Y-m-d H:i:s');
					$result = $this->gallery_model->update_gallery($id,$update);
					$this->session->set_flashdata('success','Successfully updated.');
				}else{
					$update['create_date'] = date('Y-m-d H:i:s');
					$update['update_date'] = date('Y-m-d H:i:s');
					$id = $this->gallery_model->add_gallery($update);
					$this->session->set_flashdata('success','Successfully added.');
				}
				
				redirect(ADMIN_BASE_URL.'gallery/aggssa');
		}
		
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gallery/aggssa_add',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function aggssa_delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->gallery_model->get_office_gallery_by_id($id,'AGGSSA');
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->gallery_model->delete_gallery($id);
				if(isset($data['row']['image'])){
					@unlink('galleryIMG/'.$data['row']['image']);
					@unlink('galleryIMG/thumb/'.$data['row']['image']);
					@unlink('galleryIMG/medium/'.$data['row']['image']);
				}
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'gallery/aggssa');
	}
	public function agersa(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->gallery_model->get_admin_office_gallery($limit_to,'AGERSA');
		$data['results'] = $response['results'];
		
		$config['base_url'] = ADMIN_BASE_URL.'gallery/agersa';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gallery/agersa',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function agersa_add(){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->gallery_model->get_office_gallery_by_id($id,'AGERSA');
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		if($this->input->post()){
				$update = array(
							'office'	=> 'AGERSA',
							'title'=> $this->input->post('title',true),
							'title_hindi'=> $this->input->post('title_hindi',true),
							'status'	=> 'ACTIVE'
				);
				if(isset($_FILES['image']) && $_FILES['image']['size'] > 0){
					//upload file
					$upload_type = 'JPG|jpg|PNG|png';
					$path = 'galleryIMG';
					$upload_details = $this->common_model->upload_file('image',$upload_type,$path);
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
					}else{
						$update['image'] = $upload_details['filename'];
						$this->common_model->image_resize_thumb($path,$update['image']);
						$this->common_model->image_resize_medium($path,$update['image']);
					}
				}
				if(!empty($id)){ // edit
					$update['update_date'] = date('Y-m-d H:i:s');
					$result = $this->gallery_model->update_gallery($id,$update);
					$this->session->set_flashdata('success','Successfully updated.');
				}else{
					$update['create_date'] = date('Y-m-d H:i:s');
					$update['update_date'] = date('Y-m-d H:i:s');
					$id = $this->gallery_model->add_gallery($update);
					$this->session->set_flashdata('success','Successfully added.');
				}
				
				redirect(ADMIN_BASE_URL.'gallery/agersa');
		}
		
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/gallery/agersa_add',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function agersa_delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->gallery_model->get_office_gallery_by_id($id,'AGERSA');
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->gallery_model->delete_gallery($id);
				if(isset($data['row']['image'])){
					@unlink('galleryIMG/'.$data['row']['image']);
					@unlink('galleryIMG/thumb/'.$data['row']['image']);
					@unlink('galleryIMG/medium/'.$data['row']['image']);
				}
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'gallery/aggssa');
	}
	
} // End of Class
