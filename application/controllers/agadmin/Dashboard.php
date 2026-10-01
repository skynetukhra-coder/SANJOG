<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('admin_model');
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
		$id = $this->admin['id'];
		$data['my_activity'] = $this->admin_model->my_activity($id);
		$data['latest_contents'] = $this->admin_model->latest_contents();
		//$data['latest_feedback'] = $this->admin_model->latest_feedback();
		$data_limit = 10;
		if($this->admin_type == "g&ssa"){
			$data['latest_feedback'] = $this->admin_model->latest_feedback($data_limit,'AGGSSA');
		}else if($this->admin_type == "e&rsa"){
			$data['latest_feedback'] = $this->admin_model->latest_feedback($data_limit,'AGERSA');
		}else if($this->admin_type == "superadmin"){
			$data['latest_feedback'] = $this->admin_model->latest_feedback($data_limit,'all');
		}else{
			$data['latest_feedback'] = $this->admin_model->latest_feedback($data_limit);
		}
		
		$data['admin_type'] = $this->admin_type;
		if($this->admin_type == 'superadmin'){
			$data['all_members_activity'] = $this->admin_model->all_admin_activity($id); // Only for Admin
		}
		
		$data['total_visitors'] = $this->admin_model->total_visitors();
		$data['visitors_current_month'] = $this->admin_model->visitors_current_month();
		$data['visitors_last_7_day'] = $this->admin_model->visitors_last_7_day();
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/dashboard',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
} // End of Class
