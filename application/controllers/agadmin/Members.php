<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Members extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('user_model');
		$this->load->library('form_validation');
		$this->load->helper('security');	
		$this->admin = '';
		if($this->session->has_userdata('admin_details') && $this->session->userdata('admin_details')['admin_type_name'] == 'superadmin'){
			$this->admin = $this->session->userdata('admin_details');
		}else{
			redirect('admin');
		}
	}
	public function index(){
		$data['results'] = $this->user_model->getAllOtherAdmins($this->admin['id']);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/members_list',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function add(){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['wings'] = $this->user_model->getAllWings();
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->user_model->getAdminById($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		if($this->input->post()){
			$this->form_validation->set_rules('name', 'Name', 'trim|xss_clean|required|max_length[100]|regex_match[/^[a-zA-Z. ]+$/]',array('regex_match' => '%s has disallowed charecter.'));
			$this->form_validation->set_rules('email', 'Email', 'trim|xss_clean|required|valid_email|callback_member_email_check',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('username', 'Username', 'trim|xss_clean|required|alpha_numeric|max_length[50]|callback_member_check',array('required' => 'You must provide a %s.'));
			if(!empty($id)){
				if($this->input->post('password')){
					$this->form_validation->set_rules('password', 'Password', 'trim|xss_clean|required|min_length[5]|max_length[30]');
					$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'matches[password]');
				}
			}else{
				$this->form_validation->set_rules('password', 'Password', 'trim|xss_clean|required|min_length[5]|max_length[30]',array('required' => 'You must provide a %s.'));
				$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
			}
			$this->form_validation->set_rules('wing', 'Wing', 'trim|xss_clean|required');
			$this->form_validation->set_rules('status', 'Status', 'trim|xss_clean|required|in_list[ACTIVE,INACTIVE,BLOCK,SUSPENDED]');
			if ($this->form_validation->run() == FALSE){
				//$this->session->set_flashdata('error',validation_errors());
			}else{
				// Add records
				
				$update = array(
							'admin_type_id'		=> $this->input->post('wing',true),
							'admin_name'		=> $this->input->post('name',true),
							'admin_username'	=> $this->input->post('username',true),
							'admin_email'		=> $this->input->post('email',true),
							'admin_status'		=> $this->input->post('status',true)
				);
				if($this->input->post('password')){
					$password = $this->user_model->generatePasswordHash($this->input->post('password',true));
					$update['admin_password'] = $password;
				}
				if(!empty($id)){
					$result = $this->user_model->updateAdmin($id,$update);
					$this->session->set_flashdata('success','Successfully updated.');
				}else{
					$update['admin_created_date'] = date('Y-m-d H:i:s');
					$result = $this->user_model->addAdmin($update);
					$this->session->set_flashdata('success','Successfully added.');
				}
				
				redirect(ADMIN_BASE_URL.'members');
			}
		}
		
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/members_add',$data);
		$this->load->view('agadmin/layout/footer');
	}
	function member_check($str){
		$id = $this->uri->segment(4);
		if($id){ // edit
			$res = $this->db->get_where('admin',array('admin_username'=>$str,'admin_id !='=>$id));
			if($res->num_rows() > 0){
			 	$this->form_validation->set_message('member_check', $str.' already exists! use another.');
          		return FALSE;
			}else{
				return true;
			}
		}else{
			$res = $this->db->get_where('admin',array('admin_username'=>$str));
			if($res->num_rows() > 0){
			 	$this->form_validation->set_message('member_check', $str.' already exists! use another.');
          		return FALSE;
			}else{
				return true;
			}
		}
		
	}
	function member_email_check($str){
		$id = $this->uri->segment(4);
		if($id){ // edit
			$res = $this->db->get_where('admin',array('admin_email'=>$str,'admin_id !='=>$id));
			if($res->num_rows() > 0){
			 	$this->form_validation->set_message('member_email_check', $str.' already exists! use another.');
          		return FALSE;
			}else{
				return true;
			}
		}else{
			$res = $this->db->get_where('admin',array('admin_email'=>$str));
			if($res->num_rows() > 0){
			 	$this->form_validation->set_message('member_email_check', $str.' already exists! use another.');
          		return FALSE;
			}else{
				return true;
			}
		}
		
	}
	public function delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			if($id == $this->admin['id'] && !$this->input->get('q')){
				$this->load->view('agadmin/layout/header');
				$this->load->view('agadmin/pages/members_delete_account');
				$this->load->view('agadmin/layout/footer');
			}else{
			
				$data['row'] = $this->user_model->getAdminById($id);
				$is_base_super_admin = $this->user_model->is_base_super_admin($id);
				if(empty($data['row'])){
					show_404('admin');
				}else if($is_base_super_admin){
					show_404('admin');
				}else{
					$this->user_model->deleteAdmin($id);
				}
				$this->session->set_flashdata('success','Successfully deleted.');
				if($id == $this->admin['id']){
					redirect(ADMIN_BASE_URL.'logout');
				}else{
					redirect(ADMIN_BASE_URL.'members');
				}
			}
		}else{
			show_404('admin');
		}
	}
	
} // End of Class
