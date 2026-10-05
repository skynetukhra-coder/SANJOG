<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adminlogin extends CI_Controller {

	/**
	 * Login Page for Administrator.
	 */
	function __construct() {
        parent::__construct();
        $this->load->model('user_model');	
		$this->load->helper('security');	
	}
	public function index(){
		if($this->session->userdata('admin_details')){
			redirect(ADMIN_BASE_URL.'dashboard');
		}
		$this->load->library('form_validation');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['errors'] = '';
		if($this->input->post()){
			$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean',array('required' => 'You must provide a %s.') );
			if ($this->form_validation->run() == FALSE){
				$data['errors'] = validation_errors();
			}else{
				$cap_code = $this->session->userdata('cap_data');
				if($cap_code != $this->input->post('c_image',true)){
					$data['errors'] = 'Image code not matched!';
				}else{
					// Check username
					$result = $this->user_model->getAdminByUsername($this->input->post('username',true));
					if(empty($result)){
						$data['errors'] = '<p>Username and password not matched</p>';
					}else{
						// check password
						$hash = $result['admin_password'];
						$password = $this->input->post('password',true);
						$is_matched = $this->user_model->checkPasswordHashMatched($password,$hash);
						$status = strtolower($result['admin_status']);
						if(!$is_matched){
							$data['errors'] = '<p>Username and password not matched</p>';
						}else if($status != 'active'){
							$data['errors'] = '<p>Your account is '.ucfirst($status).'</p>';
						}else{
							// Store Admin user data
							$admin_data = array(
											'id'	=> $result['admin_id'],
											'name'	=> $result['admin_name'],
											'admin_type_id'		=> $result['admin_type_id'],
											'admin_type_name'	=> $result['admin_type_name'],
							);
							$this->session->set_userdata('admin_details',$admin_data);
							$this->session->set_userdata('admin_type',$admin_data['admin_type_name']);
							if (session_status() === PHP_SESSION_NONE) {
								@session_start();
							}
							$_SESSION['admin_logged_in'] = true;
							$_SESSION['admin_details'] = $admin_data;
							$_SESSION['admin_type'] = $admin_data['admin_type_name'];
							$this->session->set_flashdata('success','Successfully logged in.');
							$this->user_model->updateAdminLogin($result['admin_id']);
							redirect(ADMIN_BASE_URL.'dashboard');
						}
					}
				}				
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('agadmin/layout/login_header');
		$this->load->view('agadmin/pages/login',$data);
		$this->load->view('agadmin/layout/login_footer');
	}
	public function forgotpassword(){
		if($this->session->userdata('admin_details')){
			redirect(ADMIN_BASE_URL.'dashboard');
		}
		$this->load->library('form_validation');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['errors'] = '';
		if($this->input->post()){
			$this->form_validation->set_rules('uname_or_email', 'Username or Email', 'trim|required|xss_clean');
			if ($this->form_validation->run() == FALSE){
				$data['errors'] = validation_errors();
			}
			else{
				$cap_code = $this->session->userdata('cap_data');
				if($cap_code != $this->input->post('c_image',true)){
					$data['errors'] = 'Image code not matched!';
				}
				else{
					// Check username
					$result = $this->user_model->getAdminByUsernameOrEmail($this->input->post('uname_or_email',true));
					if(empty($result)){
						$data['errors'] = '<p>No user found!</p>';
					}
					else{
						// generate new password
						$new_password = $this->randomPassword();
						$new_password_hash = $this->user_model->generatePasswordHash($new_password);
						$status = strtolower($result['admin_status']);
						if($status != 'active'){
							$data['errors'] = '<p>Your account is '.ucfirst($status).'</p>';
						}
						else{
							// Store Admin user data
							$admin_data = array(
											'admin_id'			=> $result['admin_id'],
											'admin_password'	=> $new_password_hash,
							);
							$this->user_model->updateAdmin($result['admin_id'],$admin_data);
							$message = 'Your new password is: '.$new_password;
							$subject = "New password generated!";
							$to = $result['admin_email'];
							send_email($subject,$message,$to);
							$this->session->set_flashdata('success','New password sent to your registered email.');
							$this->user_model->updateAdminLogin($result['admin_id']);
							redirect(ADMIN_BASE_URL);
						}
					}
				}				
			}
		}
		$data['cap'] = get_captcha();
		$this->load->view('agadmin/layout/login_header');
		$this->load->view('agadmin/pages/forgotpassword',$data);
		$this->load->view('agadmin/layout/login_footer');
	}
	function randomPassword($length = 7) {
		$alphabet = '#abcdefghijklmnopqrstuvwxyz!ABCDEFGHIJKLMNOPQRSTUVWXYZ@1234567890$';
		$pass = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < $length; $i++) {
			$n = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}
	public function logout(){
		$this->session->unset_userdata('admin_details');
		$this->session->unset_userdata('admin_type');
		if (session_status() === PHP_SESSION_NONE) {
			@session_start();
		}
		unset($_SESSION['admin_logged_in'], $_SESSION['admin_details'], $_SESSION['admin_type']);
		redirect(ADMIN_BASE_URL);
	}
} // End of Class