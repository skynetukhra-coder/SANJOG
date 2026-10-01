<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Profile extends CI_Controller {

	function __construct() {
        parent::__construct();
        $this->load->model('user_model');	
		$this->load->helper('security');	
	}
	public function index(){
		if(!$this->session->has_userdata('admin_details')){
			redirect(ADMIN_BASE_URL);
		}
		$this->load->library('form_validation');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['errors'] = '';
		$admin_details  = $this->session->userdata('admin_details');
		$id = $admin_details['id'];
		$data['row'] = $this->user_model->getAdminById($id);
		if($this->input->post()){
			$this->form_validation->set_rules('name', 'Name', 'trim|xss_clean|required|max_length[100]|regex_match[/^[a-zA-Z. ]+$/]',array('regex_match' => '%s has disallowed charecter.'));
			$this->form_validation->set_rules('email', 'Email', 'trim|xss_clean|required|valid_email|callback_member_email_check',array('required' => 'You must provide a %s.'));
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				// Add records
				$update = array(
							'admin_name'		=> $this->input->post('name',true),
							'admin_email'		=> $this->input->post('email',true),
				);
				
				if(!empty($id)){
					$result = $this->user_model->updateAdmin($id,$update);
					$admin_data = array(
								'id'	=> $data['row']['admin_id'],
								'name'	=> $this->input->post('name',true),
								'admin_type_id'		=> $data['row']['admin_type_id'],
								'admin_type_name'	=> $data['row']['admin_type_name'],
					);
					$this->session->set_userdata('admin_details',$admin_data);
					$this->session->set_flashdata('success','Successfully updated.');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/profile',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function change_password(){
		if(!$this->session->has_userdata('admin_details')){
			redirect(ADMIN_BASE_URL);
		}
		$this->load->library('form_validation');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['errors'] = '';
		$admin_details  = $this->session->userdata('admin_details');
		$id = $admin_details['id'];
		$data['row'] = $this->user_model->getAdminById($id);
		if($this->input->post()){
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length[5]|max_length[30]',array('required' => 'You must provide a %s.'));
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'matches[password]');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				if($this->input->post('password')){
					$password = $this->user_model->generatePasswordHash($this->input->post('password',true));
					$update['admin_password'] = $password;
				}
				if(!empty($id)){
					$result = $this->user_model->updateAdmin($id,$update);
					$this->session->set_flashdata('success','Successfully updated.');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/change_password',$data);
		$this->load->view('agadmin/layout/footer');
	}
	function member_email_check($str){
		$admin_details  = $this->session->userdata('admin_details');
		$id = $admin_details['id'];
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
} // End of Class
