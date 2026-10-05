<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administration extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('common_model');
		$this->load->model('emp_model');
		$this->load->model('wing_model');
		$this->load->library('form_validation');
		$this->load->helper('admin_helper');
		$this->admin = '';
		if($this->session->userdata('admin_details')){
			$this->admin = $this->session->userdata('admin_details');
		}else{
			redirect('admin');
		}
		$this->admin_type = strtolower($this->admin['admin_type_name']);
		if($this->admin_type == 'administration' || $this->admin_type == 'superadmin'){
			
		}else{
			show_404();
		}
	}
	public function index(){
		$data['results'] = array();
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration',$data);
		$this->load->view('agadmin/layout/footer');
	}	
	public function all_office_order(){
		$this->load->model('wing_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->wing_model->get_all_office_order($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/administration/all_office_order';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/all_office_order',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function all_office_order_flag(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$this->wing_model->all_office_order_flag_update($id);
			$this->session->set_flashdata('success','The Star Icon is off successfully.');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		redirect(ADMIN_BASE_URL.'administration/all_office_order');	
	}
	public function all_office_order_flagoff(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$this->wing_model->all_office_order_flag_off($id);

			$this->session->set_flashdata('success','The Star Icon is on successfully.');
		}
		$data['emp_data'] = $this->session->userdata('emp_data');
		$data['header']['name'] = $data['emp_data']['empname'];		
		redirect(ADMIN_BASE_URL.'administration/all_office_order');	
	}
	public function order_employee(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_employees_issued_office_order($page_no);

		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/administration/order_employee';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/order_employee',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function document_order(){
		$this->load->model('wing_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->wing_model->get_admin_all_circular($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/administration/document_order';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/document_order',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function document_order_add(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['employees'] = $this->emp_model->get_all_employee_list();
	
		$data['designation'] = array();
		foreach($data['employees'] as $val){
			if(!in_array($val['desig'],$data['designation'])){
				$data['designation'][] = $val['desig'];
			}			
		}
		$id = $this->uri->segment(4);
		$data['row'] = array();
		$data['asign_emp'] = array();
		if(!empty($id)){
			$data['row'] = $this->wing_model->getOfficeOrderByID($id);
			$data['asign_emp'] = $this->wing_model->getOfficeOrderToEmployees($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$error = '';
		if($this->input->post()){
			$this->form_validation->set_rules('wing', 'Wing', 'required');
			$this->form_validation->set_rules('title', 'Title', 'required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				$update = array(
							'wing'		=> $this->input->post('wing',true),
							'title'		=> $this->input->post('title',true),
							'details'	=> $this->input->post('details'),
							'status'	=> $this->input->post('status'),
							'order_dt'	=> date('Y-m-d',strtotime($this->input->post('order_dt'))),
							'update_dt'	=> date('Y-m-d H:i:s')
						);
				if(isset($_FILES['attachment']) && $_FILES['attachment']['size'][0] > 0){
					//upload file
					//$upload_details = $this->common_model->upload_multiple_file('attachment');
					$upload_details = $this->common_model->upload_multiple_order_cicular('attachment');
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
						redirect(ADMIN_BASE_URL.'administration/document_order');
					}else{
						$update['attachment'] = implode(';',$upload_details['filenames']);
					}
				}
				$emp_concerned =  $this->input->post('emp_concerned');
				if($error == ''){
					if(!empty($id)){ // edit
						$result = $this->wing_model->updateOfficeOrder($id,$update);
						$this->wing_model->update_office_order_to_employee($id,$emp_concerned);
						$this->session->set_flashdata('success','Successfully updated.');
					}else{ // add
//						$update['order_dt'] = date('Y-m-d H:i:s');
//      				$update['order_dt'] = date('Y-m-d',strtotime($this->input->post('order_dt')));
						$id = $this->wing_model->addOfficeOrder($update);					
						$this->wing_model->add_office_order_to_employee($id,$emp_concerned);
						$this->session->set_flashdata('success','Successfully added.');
					}
					redirect(ADMIN_BASE_URL.'administration/document_order');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/document_order_add',$data);
		$this->load->view('agadmin/layout/footer');
	}

	public function document_order_delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->wing_model->getOfficeOrderByID($id);
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->wing_model->deleteOfficeOrderByID($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'administration/document_order');
	}
		
	public function office_order(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
	
		$id = $this->uri->segment(4);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		if(!empty($id)){
			$response = $this->wing_model->get_office_order_byId($page_no,$id );
			
		}else{
			$response = $this->wing_model->get_office_order($page_no);
		}		
//		echo $this->db->last_query();
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/administration/office_order';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/office_order',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function office_order_add(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['employees'] = $this->emp_model->get_all_employee_list();
		$data['designation'] = array();
		foreach($data['employees'] as $val){
			if(!in_array($val['desig'],$data['designation'])){
				$data['designation'][] = $val['desig'];
			}			
		}
		$id = $this->uri->segment(4);
		$data['row'] = array();
		$data['asign_emp'] = array();
		if(!empty($id)){
			$data['row'] = $this->wing_model->getOfficeOrderByID($id);
			$data['asign_emp'] = $this->wing_model->getOfficeOrderToEmployees($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$error = '';
		if($this->input->post()){
			$this->form_validation->set_rules('wing', 'wing', 'required');
			$this->form_validation->set_rules('title', 'Title', 'required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				$update = array(
							'wing'		=> $this->input->post('wing',true),
							'title'		=> $this->input->post('title',true),
							'details'	=> $this->input->post('details'),
							'attachment'	=> $this->input->post('attachment'),
							'order_dt'	=> date('Y-m-d',strtotime($this->input->post('order_dt'))),
							'update_dt'	=> date('Y-m-d H:i:s')
						);
				if(isset($_FILES['attachment']) && $_FILES['attachment']['size'][0] > 0){
						//upload file
						//$upload_details = $this->common_model->upload_multiple_file('attachment');
						$upload_details = $this->common_model->upload_multiple_order_cicular('attachment');
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
						redirect(ADMIN_BASE_URL.'administration/office_order');
					}else{
						$update['attachment'] = implode(';',$upload_details['filenames']);
					}
				}
				$emp_concerned =  $this->input->post('emp_concerned');
				$title_circular =  $this->input->post('title_circular');
				
				if($error == ''){
					if(!empty($id)){ // if record exist
						if($title_circular !=='All Circular'){// edit
							$result = $this->wing_model->updateOfficeOrder($id,$update);
							$this->wing_model->update_office_order_to_employee($id,$emp_concerned);
							$this->session->set_flashdata('success','Successfully updated and SMS sent.');
						}else{ // exist but add a new record
	//						$update['order_dt'] = date('Y-m-d H:i:s');
	//      				$update['order_dt'] = date('Y-m-d',strtotime($this->input->post('order_dt')));
							$id = $this->wing_model->addOfficeOrder($update);					
							$this->wing_model->add_office_order_to_employee($id,$emp_concerned);
							$this->session->set_flashdata('success','Successfully added and SMS sent.');
						}
					}else{ // if not exist, add record
						$id = $this->wing_model->addOfficeOrder($update);					
						$this->wing_model->add_office_order_to_employee($id,$emp_concerned);
						$this->session->set_flashdata('success','Successfully added and SMS sent.');
					}
					redirect(ADMIN_BASE_URL.'administration/office_order');
				}
				
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/office_order_add',$data);
		$this->load->view('agadmin/layout/footer');
	}	
	public function office_order_edit(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['employees'] = $this->emp_model->get_all_employee_list();
		$data['designation'] = array();
		foreach($data['employees'] as $val){
			if(!in_array($val['desig'],$data['designation'])){
				$data['designation'][] = $val['desig'];
			}			
		}
		$id = $this->uri->segment(4);
		$data['row'] = array();
		$data['asign_emp'] = array();
		if(!empty($id)){
			$data['row'] = $this->wing_model->getOfficeOrderByID($id);
			$data['asign_emp'] = $this->wing_model->getOfficeOrderToEmployees($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$error = '';
		if($this->input->post()){
			$this->form_validation->set_rules('wing', 'wing', 'required');
			$this->form_validation->set_rules('title', 'Title', 'required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				$update = array(
							'wing'		=> $this->input->post('wing',true),
							'title'		=> $this->input->post('title',true),
							'details'	=> $this->input->post('details'),
							'attachment'	=> $this->input->post('attachment'),
							'order_dt'	=> date('Y-m-d',strtotime($this->input->post('order_dt'))),
							'update_dt'	=> date('Y-m-d H:i:s')
						);
				if(isset($_FILES['attachment']) && $_FILES['attachment']['size'][0] > 0){
					//upload file
					//$upload_details = $this->common_model->upload_multiple_file('attachment');
					$upload_details = $this->common_model->upload_multiple_order_cicular('attachment');
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
						redirect(ADMIN_BASE_URL.'administration/office_order');
					}else{
						$update['attachment'] = implode(';',$upload_details['filenames']);
					}
				}
				$emp_concerned =  $this->input->post('emp_concerned');
				$title_circular =  $this->input->post('title_circular');
				
				if($error == ''){
					if(!empty($id)){ // if record exist
						if($title_circular !=='All Circular'){// edit
							$result = $this->wing_model->updateOfficeOrder($id,$update);
							$this->wing_model->update_office_order_to_employee($id,$emp_concerned);
							$this->session->set_flashdata('success','Successfully updated and SMS sent.');
						}else{ // exist but add a new record
	//						$update['order_dt'] = date('Y-m-d H:i:s');
	//      				$update['order_dt'] = date('Y-m-d',strtotime($this->input->post('order_dt')));
							$id = $this->wing_model->addOfficeOrder($update);					
							$this->wing_model->add_office_order_to_employee($id,$emp_concerned);
							$this->session->set_flashdata('success','Successfully added and SMS sent.');
						}
					}else{ // if not exist, add record
						$id = $this->wing_model->addOfficeOrder($update);					
						$this->wing_model->add_office_order_to_employee($id,$emp_concerned);
						$this->session->set_flashdata('success','Successfully added and SMS sent.');
					}
					redirect(ADMIN_BASE_URL.'administration/office_order');
				}
				
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/office_order_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}	
	public function office_order_delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->wing_model->getOfficeOrderByID($id);
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->wing_model->deleteOfficeOrderByID($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'administration/office_order');
	}

	public function order_employee_delete(){
		$this->load->model('wing_model');
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->wing_model->getEmployeeOfficeOrderByID($id);
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->wing_model->delete_employee_office_OrderByID($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'administration/order_employee');
	}
	
	public function apar_booklet(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->wing_model->get_apar_office_order($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/administration/apar_booklet';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/apar_booklet',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function apar_booklet_add(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['employees'] = $this->emp_model->get_all_employee_list();
		$data['designation'] = array();
		foreach($data['employees'] as $val){
			if(!in_array($val['desig'],$data['designation'])){
				$data['designation'][] = $val['desig'];
			}			
		}
		$id = $this->uri->segment(4);
		$data['row'] = array();
		$data['asign_emp'] = array();
		if(!empty($id)){
			$data['row'] = $this->wing_model->getOfficeOrderByID($id);
			$data['asign_emp'] = $this->wing_model->getOfficeOrderToEmployees($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$error = '';
		if($this->input->post()){
			
			$emp_concerned =  $this->input->post('emp_concerned');
				foreach($emp_concerned as $empid=>$mobile){
					$ord_empid = $empid;
			}
			
			$this->form_validation->set_rules('title', 'Title', 'required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				$update = array(
							'ord_empid' => $ord_empid,
							'title'		=> $this->input->post('title',true),
							'details'	=> $this->input->post('details'),
							'order_dt'	=> date('Y-m-d',strtotime($this->input->post('order_dt'))),
							'ord_year'	=> $this->input->post('ord_year'),
							'update_dt'	=> date('Y-m-d H:i:s')
						);
				if(isset($_FILES['attachment']) && $_FILES['attachment']['size'][0] > 0){
					//upload file
					$upload_details = $this->common_model->upload_apar_booklet('attachment');
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
						redirect(ADMIN_BASE_URL.'administration/office_order');
					}else{
						$update['attachment'] = implode(';',$upload_details['filenames']);
					}
				}
				
				if($error == ''){
					if(!empty($id)){ // edit
						$result = $this->wing_model->updateOfficeOrder($id,$update);
						$this->wing_model->update_office_order_to_employee($id,$emp_concerned);
						$this->session->set_flashdata('success','Successfully updated.');
					}else{ // add
//						$update['order_dt'] = date('Y-m-d H:i:s');
//      				$update['order_dt'] = date('Y-m-d',strtotime($this->input->post('order_dt')));
						$id = $this->wing_model->addOfficeOrder($update);					
						$this->wing_model->add_office_order_to_employee($id,$emp_concerned);
						$this->session->set_flashdata('success','Successfully added.');
					}
					redirect(ADMIN_BASE_URL.'administration/apar_booklet');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/apar_booklet_add',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function apar_booklet_delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->wing_model->getOfficeOrderByID($id);
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->wing_model->deleteOfficeOrderByID($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'administration/apar_booklet');
	}
	
	public function employee_login(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_admin_employee_loggedIn($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/administration/employee_login';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/employee_login',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function employee_pan(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->get_employee_master_pan($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
	
		$data['rows'] = $this->emp_model->get_employee_detail_pan($data['row']['office_id']);

		if($this->input->post()){
			$this->emp_model->update_employee_pan_no($data['row']['office_id']);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'administration/employee');
		}
		
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/employee_pan',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function employee(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['section_list'] = $this->emp_model->get_all_section_list();
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_admin_employee($page_no);
		$data['examinations'] = $this->emp_model->get_all_employee_examinations();
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/administration/employee';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/employee',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function employee_edit(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->employee_details($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
		$data['section_list'] = $this->emp_model->get_all_section_list();
		if($this->input->post()){
			$this->emp_model->update_employee($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'administration/employee');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/employee_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	
	
	public function employee_edit_pdf(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->employee_details($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}

		if($this->input->post()){
//-------------------- upload file				
						if(isset($_FILES['nomination']) && $_FILES['nomination']['size'] > 0){
						//upload file		
						$upload_details = $this->common_model->upload_employee_image('nomination'); //SINGLE FILE UPLOAD
						if(!$upload_details['is_success']){
							$this->session->set_flashdata('error',$upload_details['message']);
							$error = $upload_details['message'];
						}else{
//							$this->input->post('nomination',$upload_details['filename']);
							$_POST['nomination'] = $upload_details['filename'];
						}
						}				
//----------Family file upload	start			
				if(isset($_FILES['family_memb']) && $_FILES['family_memb']['size'] > 0){
				//upload file
					$upload_details = $this->common_model->upload_employee_image('family_memb'); //SINGLE FILE UPLOAD					
						if(!$upload_details['is_success']){
							$this->session->set_flashdata('error',$upload_details['message']);
							$error = $upload_details['message'];
						}else{
							//$this->input->post('family_memb',$upload_details['filename']);
							$_POST['family_memb'] = $upload_details['filename'];
						}
				}		
			$this->emp_model->update_employee_nomination($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'administration/employee');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/employee_edit_pdf',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function employee_edit_sec(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		
		$data['sections'] = $this->emp_model->get_all_sections();
		$data['branches'] = $this->emp_model->get_all_branches();
		$data['groups'] = array();
		foreach($data['sections'] as $val){
			if(!in_array($val['sec_br_group'],$data['groups'])){
				$data['groups'][] = $val['sec_br_group'];
			}			
		}
		
		$id = $this->uri->segment(4);
	
		$data['row'] = array();
		$data['emp_section'] = array();

		$data['row'] = array();
		if(!empty($id)){
			$data['emp_section'] = $this->emp_model->getSectionToEmployees($id);
			$data['row'] = $this->emp_model->employee_section_details($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
		
		$emp_section = $this->input->post('emp_section');
		$emp_branch = $this->input->post('emp_branch');
		$staff_type = $this->input->post('staff_type',true);

		if($this->input->post()){
			$this->emp_model->update_employee_section($id,$emp_section, $emp_branch ,$staff_type);
			$this->emp_model->update_section_master_bo_index($emp_branch, $emp_section);
			if($staff_type == 'Incharge'){
				$this->emp_model->add_section_to_employee($id,$emp_section);
			}
			if($staff_type == 'BO'){
				$this->emp_model->add_branch_to_incharge($id,$emp_branch);
			}
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'administration/employee');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/employee_edit_sec',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function employee_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/employee_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function employee_ajax_upload(){
		$data['results'] = array();
		if(isset($_FILES)){
			$path = 'excel';
			$file_name = '';
			$res = $this->common_model->upload_file('file',"*",$path);
			
			if($res['is_success']){
				$file_name = $path.'/'.$res['filename'];
			}else{
				@unlink($file_name);
				$error_msg = $res['message'];
				echo json_encode($res);
				exit();
			}
			$this->load->library('spreadsheet');
			$res = $this->spreadsheet->read_file($file_name);
			if(isset($res['values']) && empty($res['values'])){
				// empty file
				$response = array(
						'is_success'	=> false,
						'message'		=> 'The file is empty'
					);
				@unlink($file_name);
				echo json_encode($response);
				exit();
			}
			$headers = array();
			$upload = array();
			
			$header_security_field =  array('EMPID','OFFICE_ID','EMPNAME','FATHER_NAME','GENDER','BASIC_PAY','MBNO','CATEGORY','STREAM','DOB','DOR','NICMAIL','NICMAIL_PROPOSED','EMAIL','DOAPP','OFFICE','DEPT_APPT','DOJ_OFF','JONING_TYPE','BLODD_GRP');
																			
			foreach($res['header'] as $key => $val){
				if(trim($val) != ''){ // remove empty cel 
					$val = strtoupper($val);
					if(in_array($val,$header_security_field)){
						$headers[$key]	= strtolower($val);
						if (($k = array_search($val, $header_security_field)) !== false) {
							unset($header_security_field[$k]);
						}
					}
				}
			}
			if(!empty($header_security_field)){
				$response = array(
							'is_success'	=> false,
							'message'		=> 'The file has extra field.'
						);
						@unlink($file_name);
						echo json_encode($response);
						exit();
			}
			$i = 0;
			
			foreach($res['values'] as $row => $columns){
				$up_arr = array_fill_keys($headers,"");
				foreach($columns as $key=>$val){
					if(isset($headers[$key])){ // remove empty cel 
						$up_arr[$headers[$key]]	= $val;
					}
				}
				$upload[] = $up_arr;				
			}
				//			$bulk_elem = 10;
				//			$bulk_upload = array();
				//			if( count($upload) > $bulk_elem ){
				//				$bulk_upload = array_chunk($upload,$bulk_elem);
				//				foreach($bulk_upload as $bulk){
				//					$this->db->insert_batch('employee_master',$bulk);
				//				}
				//			}else{
				//				$this->db->insert_batch('employee_master',$upload);
				//			}
			foreach($upload as $record){
				$empid = isset($record['empid']) ? $record['empid'] : 0;
				$offic_id = isset($record['office_id']) ? $record['office_id'] : 0;
				$empdetail = array (
					'empid' => $empid,
					'offic_id' => $offic_id
				);
				$record['upload_dt'] = date('Y-m-d H:i:s');
				// check records exists
				$res = $this->db->get_where('employee_master',array('empid'=>$empid,'office_code'=>'AGAE'));
				if($res->num_rows() > 0){
					$this->db->where('empid',$empid)->update('employee_master',$record);
				}else{
					$record['office_code'] = 'AGAE';
					$record['status'] = 'Active';
					$this->db->insert('employee_master',$record);
					$this->db->insert('employee_details',$empdetail);
				}
				$res_detail = $this->db->get_where('employee_details',array('empid'=>$empid));
				if($res_detail->num_rows() <= 0){
					$this->db->insert('employee_details',$empdetail);
				}
				
			}
			$db_error = $this->db->error();
			if(!empty($db_error) && $db_error['code'] != 0 && trim($db_error['message']) != ''){
				$message = $db_error['code'].' '.$db_error['message'];
				$is_success = false;
				@unlink($file_name);
			}else{
				$message = 'Successfully updated.';
				$is_success = true;
				@unlink($file_name);
			}
		}else{
			$message = 'No file selected.';
			$is_success = false;
		}
		$response = array(
						'is_success'	=> $is_success,
						'message'		=> $message
					);
		echo json_encode($response);
		exit();
	}
	public function all_employees_application(){
		$this->load->model('emp_model');
		$headings = array();
		$firstrow = array();
		$all_application = $this->emp_model->all_employees_application('AGAE');
		if(!empty($all_application)){
			unset($all_application[0]['appl_id']);
			foreach( $all_application[0] as $k => $v ) {
					$headings[] = strtoupper($k);
					$firstrow[] = $v;
			}
			unset($all_application[0]);
		}
		$excel_data[] = $headings;
		$excel_data[1] = $firstrow;
		foreach( $all_application as $row ) {
			unset($row['appl_id']);
			$row['applied_on'] = date('d-m-Y h:i:s A',strtotime($row['applied_on']));
			$excel_data[] = $row;
		}
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Application of employees');
		$this->excel->getActiveSheet()->fromArray($excel_data);
		 
		$filename='application_'.time().'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}
	public function all_employees_application_other(){
		$this->load->model('emp_model');
		$headings = array();
		$firstrow = array();
		$all_application = $this->emp_model->all_employees_application_non_dept();
		if(!empty($all_application)){
			unset($all_application[0]['exam_odr_id']);
			foreach( $all_application[0] as $k => $v ) {
					$headings[] = strtoupper($k);
					$firstrow[] = $v;
			}
			unset($all_application[0]);
		}
		$excel_data[] = $headings;
		$excel_data[1] = $firstrow;
		foreach( $all_application as $row ) {
			unset($row['exam_odr_id']);
			$row['upload_dt'] = date('d-m-Y h:i:s A',strtotime($row['upload_dt']));
			$excel_data[] = $row;
		}
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Application for Non-dept Exam');
		$this->excel->getActiveSheet()->fromArray($excel_data);
		 
		$filename='application_other_'.time().'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}
	public function employee_application(){
		$this->load->model('emp_model');
		$emp_id = $this->input->get('id');
		$application = $this->emp_model->get_employee_application($emp_id);
		unset($application['appl_id']);
		foreach( $application as $k => $v ) {
				$headings[] = strtoupper($k);
				$firstrow[] = $v;
		}
		$excel_data[0] = $headings;
		$excel_data[1] = $firstrow;
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Application of '.$emp_id);
		$this->excel->getActiveSheet()->fromArray($excel_data);
		 
		$filename='application_'.$emp_id.'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}
	public function employee_details_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/employee_details_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function employee_details_ajax_upload(){
		$data['results'] = array();
		if(isset($_FILES)){
			$path = 'excel';
			$file_name = '';
			$res = $this->common_model->upload_file('file',"*",$path);
			
			if($res['is_success']){
				$file_name = $path.'/'.$res['filename'];
			}else{
				@unlink($file_name);
				$error_msg = $res['message'];
				echo json_encode($res);
				exit();
			}
			$this->load->library('spreadsheet');
			$res = $this->spreadsheet->read_file($file_name);
			if(isset($res['values']) && empty($res['values'])){
				// empty file
				$response = array(
						'is_success'	=> false,
						'message'		=> 'The file is empty'
					);
				@unlink($file_name);
				echo json_encode($response);
				exit();
			}
			$headers = array();
			$upload = array();
			
			$header_security_field =  array('EMPID','OFFIC_ID','QUALIFI','ADDRESS1','STATE','DISTRICT','POSTOFFICE','PIN','SECTION','GRD_SLNO','GRD_PAGENO','ID_CARDNO');
			foreach($res['header'] as $key => $val){
				if(trim($val) != ''){ // remove empty cel 
					$val = strtoupper($val);
					if(in_array($val,$header_security_field)){
						$headers[$key]	= strtolower($val);
						if (($k = array_search($val, $header_security_field)) !== false) {
							unset($header_security_field[$k]);
						}
					}
				}
			}
			if(!empty($header_security_field)){
				$response = array(
							'is_success'	=> false,
							'message'		=> 'The file has extra field.'
						);
						@unlink($file_name);
						echo json_encode($response);
						exit();
			}
			$i = 0;
			
			foreach($res['values'] as $row => $columns){
				$up_arr = array_fill_keys($headers,"");
				foreach($columns as $key=>$val){
					if(isset($headers[$key])){ // remove empty cel 
						$up_arr[$headers[$key]]	= $val;
					}
				}
				$upload[] = $up_arr;				
			}
			//$bulk_elem = 10;
			//$bulk_upload = array();
			//if( count($upload) > $bulk_elem ){
			//	$bulk_upload = array_chunk($upload,$bulk_elem);
			//	foreach($bulk_upload as $bulk){
			//		$this->db->insert_batch('employee_details',$bulk);
			//		echo $this->db->last_query();
			//	}
			//}else{
			//	$this->db->insert_batch('employee_details',$upload);
			//	echo $this->db->last_query();
			//}
			foreach($upload as $record){
				$empid = isset($record['empid']) ? $record['empid'] : 0;
				$record['upload_dt'] = date('Y-m-d H:i:s');
				// check records exists
				$res = $this->db->get_where('employee_details',array('empid'=>$empid));
				if($res->num_rows() > 0){
					$this->db->where('empid',$empid)->update('employee_details',$record);
				}else{
					$this->db->insert('employee_details',$record);
				}
				
			}
			$db_error = $this->db->error();
			if(!empty($db_error) && $db_error['code'] != 0 && trim($db_error['message']) != ''){
				$message = $db_error['code'].' '.$db_error['message'];
				$is_success = false;
				@unlink($file_name);
			}else{
				$message = 'Successfully updated.';
				$is_success = true;
				@unlink($file_name);
			}
		}else{
			$message = 'No file selected.';
			$is_success = false;
		}
		$response = array(
						'is_success'	=> $is_success,
						'message'		=> $message
					);
		echo json_encode($response);
		exit();
	}

	public function circular_office_order(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->wing_model->get_admin_circular_office_order($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/administration/circular_office_order';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/circular_office_order',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function circular_office_order_add(){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->wing_model->getCircularOfficeOrderByID($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$error = '';
		if($this->input->post()){
			$this->form_validation->set_rules('description', 'Description', 'required');
			$this->form_validation->set_rules('description_hindi', 'Description_hindi', 'required');
			$this->form_validation->set_rules('description_bengali', 'Description_bengali', 'required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				$update = array(
							'description'	=> $this->input->post('description'),
							'description_hindi'	=> $this->input->post('description_hindi'),
							'description_bengali'	=> $this->input->post('description_bengali'),
							'f_year'		=> date('m') <= 3 ? date('Y').'-03-31' : (date('Y') + 1).'-03-31',
							'date'			=> date('Y-m-d H:i:s'),
							'wing'			=> $this->input->post('wing',true),
							'url_link'		=> $this->input->post('url_link',true),
							'sl_no'			=> $this->input->post('sl_no',true),
						);
				if(isset($_FILES['attachment']) && $_FILES['attachment']['size'] > 0){
					//upload file
					$upload_details = $this->common_model->upload_circular_order('attachment');
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
					}else{
						$update['pdf_name'] = $upload_details['filename'];
					}
				}
				if($error == ''){
					if(!empty($id)){ // edit
						$result = $this->wing_model->updateCircularOfficeOrder($id,$update);
						$this->session->set_flashdata('success','Successfully updated.');
					}else{
						$id = $this->wing_model->addCircularOfficeOrder($update);
						$this->session->set_flashdata('success','Successfully added.');
					}
					redirect(ADMIN_BASE_URL.'administration/circular_office_order');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/circular_office_order_add',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function circular_office_order_delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->wing_model->getCircularOfficeOrderByID($id);
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->wing_model->deleteCircularOfficeOrderByID($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'administration/circular_office_order');
	}
	public function circular_office_order_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/circular_office_order_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function circular_office_order_ajax_upload(){
		$data['results'] = array();
		if(isset($_FILES)){
			$path = 'excel';
			$file_name = '';
			$res = $this->common_model->upload_file('file',"*",$path);
			
			if($res['is_success']){
				$file_name = $path.'/'.$res['filename'];
			}else{
				@unlink($file_name);
				$error_msg = $res['message'];
				echo json_encode($res);
				exit();
			}
			$this->load->library('spreadsheet');
			$res = $this->spreadsheet->read_file($file_name);
			if(isset($res['values']) && empty($res['values'])){
				// empty file
				$response = array(
						'is_success'	=> false,
						'message'		=> 'The file is empty'
					);
				@unlink($file_name);
				echo json_encode($response);
				exit();
			}
			$headers = array();
			$upload = array();
			
			$header_security_field =  array('SL_NO','F_YEAR','DATE','WING','DESCRIPTION','PDF_NAME');
			
			foreach($res['header'] as $key => $val){
				if(trim($val) != ''){ // remove empty cel 
					$val = strtoupper($val);
					if(in_array($val,$header_security_field)){
						$headers[$key]	= strtolower($val);
						if (($k = array_search($val, $header_security_field)) !== false) {
							unset($header_security_field[$k]);
						}
					}
				}
			}
			if(!empty($header_security_field)){
				$response = array(
							'is_success'	=> false,
							'message'		=> 'The file has extra field.'
						);
						@unlink($file_name);
						echo json_encode($response);
						exit();
			}
			$i = 0;
			foreach($res['values'] as $row => $columns){
				$up_arr = array_fill_keys($headers,"");
				foreach($columns as $key=>$val){
					if(isset($headers[$key])){ // remove empty cel 
						$up_arr[$headers[$key]]	= $val;
					}
				}
				$upload[] = $up_arr;				
			}
			$bulk_elem = 10;
			$bulk_upload = array();
			if( count($upload) > $bulk_elem ){
				$bulk_upload = array_chunk($upload,$bulk_elem);
				foreach($bulk_upload as $bulk){
					$this->db->insert_batch('circular_office_order',$bulk);
				}
			}else{
				$this->db->insert_batch('circular_office_order',$upload);
			}
			
			$db_error = $this->db->error();
			if(!empty($db_error) && $db_error['code'] != 0 && trim($db_error['message']) != ''){
				$message = $db_error['code'].' '.$db_error['message'];
				$is_success = false;
				@unlink($file_name);
			}else{
				$message = 'Successfully updated.';
				$is_success = true;
				@unlink($file_name);
			}
		}else{
			$message = 'No file selected.';
			$is_success = false;
		}
		$response = array(
						'is_success'	=> $is_success,
						'message'		=> $message
					);
		echo json_encode($response);
		exit();
	}
	
	public function tender_notice(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->wing_model->get_admin_tender_notice($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/administration/tender_notice';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
//		$data['language_id']=$this->language_id;
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/tender_notice',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function tender_notice_add(){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->wing_model->getTenderNoticeByID($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$error = '';
		if($this->input->post()){
			$this->form_validation->set_rules('description', 'Description', 'required');
			$this->form_validation->set_rules('description_hindi', 'Description_hindi', 'required');
			$this->form_validation->set_rules('description_bengali', 'Description_bengali', 'required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				$update = array(
							'description'	=> $this->input->post('description'),
							'description_hindi'	=> $this->input->post('description_hindi'),
							'description_bengali'	=> $this->input->post('description_bengali'),
							'f_year'		=> date('m') <= 3 ? date('Y').'-03-31' : (date('Y') + 1).'-03-31',
							'date'			=> date('Y-m-d H:i:s'),
							'wing'			=> $this->input->post('wing',true),
							'url_link'		=> $this->input->post('url_link',true),
							'closing_date'	=> date('Y-m-d',strtotime($this->input->post('closing_date'))),
							'closing_time'	=>  $this->input->post('closing_time',true),
							'sl_no'			=> $this->input->post('sl_no',true),
						);
				if(isset($_FILES['attachment']) && $_FILES['attachment']['size'] > 0){
					//upload file
					$upload_details = $this->common_model->upload_tender_notice('attachment');
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
					}else{
						$update['pdf_name'] = $upload_details['filename'];
					}
				}
				if($error == ''){
					if(!empty($id)){ // edit
						$result = $this->wing_model->updateTenderNotice($id,$update);
						$this->session->set_flashdata('success','Successfully updated.');
					}else{
						$id = $this->wing_model->addTenderNotice($update);
						$this->session->set_flashdata('success','Successfully added.');
					}
					redirect(ADMIN_BASE_URL.'administration/tender_notice');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/tender_notice_add',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function tender_notice_delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->wing_model->getTenderNoticeByID($id);
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->wing_model->deleteTenderNoticeByID($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'administration/tender_notice');
	}

// exam_result uploading

	public function exam_result(){
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->wing_model->get_exam_result($page_no);
		$data['result'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/administration/exam_result';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/exam_result',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function exam_result_add(){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->wing_model->getExamResultsByID($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$error = '';
		if($this->input->post()){
			$this->form_validation->set_rules('description', 'Description', 'required');
			$this->form_validation->set_rules('description_hindi', 'Description_hindi', 'required');
			$this->form_validation->set_rules('description_bengali', 'Description_bengali', 'required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				$update = array(
							'description'	=> $this->input->post('description'),
							'description_hindi'	=> $this->input->post('description_hindi'),
							'description_bengali'	=> $this->input->post('description_bengali'),
							'f_year'		=> date('m') <= 3 ? date('Y').'-03-31' : (date('Y') + 1).'-03-31',
							'date'			=> date('Y-m-d H:i:s'),
							'wing'			=> $this->input->post('wing',true),
							'url_link'		=> $this->input->post('url_link',true),
							'sl_no'			=> $this->input->post('sl_no',true),
						);
				if(isset($_FILES['attachment']) && $_FILES['attachment']['size'] > 0){
					//upload file
					$upload_details = $this->common_model->upload_exam_results('attachment');
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
					}else{
						$update['pdf_name'] = $upload_details['filename'];
					}
				}
				if($error == ''){
					if(!empty($id)){ // edit
						$result = $this->wing_model->updateExamResults($id,$update);
						$this->session->set_flashdata('success','Successfully updated.');
					}else{
						$id = $this->wing_model->addExamResults($update);
						$this->session->set_flashdata('success','Successfully added.');
					}
					redirect(ADMIN_BASE_URL.'administration/exam_result');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/exam_result_add',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function exam_result_delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->wing_model->getExamResultsByID($id);
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->wing_model->deleteExamResultsByID($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'administration/exam_result');
	}
	public function exam_result_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/exam_result_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
/*
	public function exam_result_ajax_upload(){
		$data['results'] = array();
		if(isset($_FILES)){
			$path = 'excel';
			$file_name = '';
			$res = $this->common_model->upload_file('file',"*",$path);
			
			if($res['is_success']){
				$file_name = $path.'/'.$res['filename'];
			}else{
				@unlink($file_name);
				$error_msg = $res['message'];
				echo json_encode($res);
				exit();
			}
			$this->load->library('spreadsheet');
			$res = $this->spreadsheet->read_file($file_name);
			if(isset($res['values']) && empty($res['values'])){
				// empty file
				$response = array(
						'is_success'	=> false,
						'message'		=> 'The file is empty'
					);
				@unlink($file_name);
				echo json_encode($response);
				exit();
			}
			$headers = array();
			$upload = array();
			
//			$header_security_field =  array('SL_NO','F_YEAR','DATE','WING','DESCRIPTION','PDF_NAME');
//			$header_security_field =  array('bill_no','bill_dt','fin_yr','vendor_name','dd_no','dd_dt','amount','authority','file_no','emd_bg_no');
//			$header_security_field =  array('sl_no','emdbg_type','entry_dt','fin_yr','niq_no','niq_dt','vend_nm','vend_add','dd_cq_no','dd_cq_dt','bank_mn','bank_add','amt','valid_from','valid_to','pao_letter','pao_letter_dt','status','refund_dt','refund_ref','refund_ref_dt','autho','autho_dt','remk');
//			$header_security_field =  array('comp_no','item','brand','descp','section','mach_no','remk','entry_date','amc_yr');
//			$header_security_field =  array('compt_no','out_date','vendor','vendor_rep_nm','recpt_date','status','standby_info','upload_dt');
//			$header_security_field =  array('bsl_no','fin_yr','buget_ref_no','buget_ref_dt','budgt_catg','budgt_amt','allot_no','allot_dt','allot_amt','descrip');
			$header_security_field =  array('fin_yr','inv_no','inv_dt','bill_no','bill_dt');
			
			foreach($res['header'] as $key => $val){
				if(trim($val) != ''){ // remove empty cel 
//					$val = strtoupper($val);
					$val = strtolower($val);
					if(in_array($val,$header_security_field)){
						$headers[$key]	= strtolower($val);
						if (($k = array_search($val, $header_security_field)) !== false) {
							unset($header_security_field[$k]);
						}
					}
				}
			}
			if(!empty($header_security_field)){
				$response = array(
							'is_success'	=> false,
							'message'		=> 'The file has extra field.'
						);
						@unlink($file_name);
						echo json_encode($response);
						exit();
			}
			$i = 0;
			foreach($res['values'] as $row => $columns){
				$up_arr = array_fill_keys($headers,"");
				foreach($columns as $key=>$val){
					if(isset($headers[$key])){ // remove empty cel 
						$up_arr[$headers[$key]]	= $val;
					}
				}
				$upload[] = $up_arr;				
			}

//uploading without condition
			$bulk_elem = 10;
			$bulk_upload = array();
			if( count($upload) > $bulk_elem ){
				$bulk_upload = array_chunk($upload,$bulk_elem);
				foreach($bulk_upload as $bulk){
//					$this->db->insert_batch('exam_results',$bulk);
//					$this->db->insert_batch('complaint_info',$bulk);
//					$this->db->insert_batch('comp_inout_records',$bulk);
//					$this->db->insert_batch('emd_bg_budget',$bulk);
					$this->db->insert_batch('emd_bg_invoice_details',$bulk);
					
				}
			}else{
//				$this->db->insert_batch('exam_results',$upload);
//				$this->db->insert_batch('complaint_info',$upload);
//				$this->db->insert_batch('comp_inout_records',$upload);
//				$this->db->insert_batch('emd_bg_budget',$upload);
				$this->db->insert_batch('emd_bg_invoice_details',$upload);
				
			}
//uploading end.


//conditional uploading with conditions		
			foreach($upload as $record){
				$fin_yr = isset($record['fin_yr']) ? $record['fin_yr'] : 0;
				$inv_no = isset($record['inv_no']) ? $record['inv_no'] : 0;
				$bill_no = isset($record['bill_no']) ? $record['bill_no'] : 0;
				// check records exists
				$res = $this->db->get_where('emd_bg_invoice_details',array('fin_yr'=>$fin_yr,'inv_no'=>$inv_no,'bill_no'=>$bill_no));
				if($res->num_rows() > 0){
					$this->db->where('fin_yr',$fin_yr)->where('inv_no',$inv_no)->where('bill_no',$bill_no)->update('emd_bg_invoice_details',$record);
				}else{
//					$this->db->insert('emd_bg_invoice_details',$record);
				}
				
			}
// conditional updating end
			$db_error = $this->db->error();
			if(!empty($db_error) && $db_error['code'] != 0 && trim($db_error['message']) != ''){
				$message = $db_error['code'].' '.$db_error['message'];
				$is_success = false;
				@unlink($file_name);
			}else{
				$message = 'Successfully updated.';
				$is_success = true;
				@unlink($file_name);
			}
		}else{
			$message = 'No file selected.';
			$is_success = false;
		}
		$response = array(
						'is_success'	=> $is_success,
						'message'		=> $message
					);
		echo json_encode($response);
		exit();
	}
*/
	public function exam_result_ajax_upload(){
		$data['results'] = array();
		if(isset($_FILES)){
			$path = 'excel';
			$file_name = '';
			$res = $this->common_model->upload_file('file',"*",$path);
			
			if($res['is_success']){
				$file_name = $path.'/'.$res['filename'];
			}else{
				@unlink($file_name);
				$error_msg = $res['message'];
				echo json_encode($res);
				exit();
			}
			$this->load->library('spreadsheet');
			$res = $this->spreadsheet->read_file($file_name);
			
			if(isset($res['values']) && empty($res['values'])){
				// empty file
				$response = array(
						'is_success'	=> false,
						'message'		=> 'The file is empty'
					);
				@unlink($file_name);
				echo json_encode($response);
				exit();
			}
			$headers = array();
			$upload = array();
			$header_security_field =  array('FIN_YR','INV_NO','INV_DT','BILL_NO','BILL_DT');
			foreach($res['header'] as $key => $val){
				if(trim($val) != ''){ // remove empty cel 
					$val = strtoupper($val);
					if(in_array($val,$header_security_field)){
						$headers[$key]	= strtolower($val);
						if (($k = array_search($val, $header_security_field)) !== false) {
							unset($header_security_field[$k]);
						}
					}
				}
			}
			if(!empty($header_security_field)){
				$response = array(
							'is_success'	=> false,
							'message'		=> 'The file has extra field.'
						);
						@unlink($file_name);
						echo json_encode($response);
						exit();
			}
			$i = 0;
			foreach($res['values'] as $row => $columns){
				$up_arr = array_fill_keys($headers,"");
				foreach($columns as $key=>$val){
					if(isset($headers[$key])){ // remove empty cel 
						$up_arr[$headers[$key]]	= $val;
					}
				}
				$upload[] = $up_arr;				
			}
//			$bulk_elem = 10;
//			$bulk_upload = array();
//			if( count($upload) > $bulk_elem ){
//				$bulk_upload = array_chunk($upload,$bulk_elem);
//				foreach($bulk_upload as $bulk){
//					$this->db->insert_batch('gpf_summary',$bulk);
//				}
//			}else{
//				$this->db->insert_batch('gpf_summary',$upload);
//			}
			foreach($upload as $record){
				$fin_yr = isset($record['fin_yr']) ? $record['fin_yr'] : 0;
				$inv_no = isset($record['inv_no']) ? $record['inv_no'] : 0;
				$bill_no = isset($record['bill_no']) ? $record['bill_no'] : 0;
				// check records exists
				$res = $this->db->get_where('emd_bg_invoice_details',array('fin_yr'=>$fin_yr,'inv_no'=>$inv_no,'bill_no'=>$bill_no));
				if($res->num_rows() > 0){
					$this->db->where('fin_yr',$fin_yr)->where('inv_no',$inv_no)->where('bill_no',$bill_no)->update('emd_bg_invoice_details',$record);
				}else{
//					$this->db->insert('gpf_summary',$record);
				}
				
			}
			$db_error = $this->db->error();
			if(!empty($db_error) && $db_error['code'] != 0 && trim($db_error['message']) != ''){
				$message = $db_error['code'].' '.$db_error['message'];
				$is_success = false;
				@unlink($file_name);
			}else{
				$message = 'Successfully updated.';
				$is_success = true;
				@unlink($file_name);
			}
		}else{
			$message = 'No file selected.';
			$is_success = false;
		}
		$response = array(
						'is_success'	=> $is_success,
						'message'		=> $message
					);
		echo json_encode($response);
		exit();
	}
//------------training		
	public function training(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->employee_trainings($page_no);
		$data['results'] = $response['results'];
		
		$data['training_ids'] = $this->emp_model->get_all_training_ids();
		$data['training_types'] = $this->emp_model->get_all_training_types();
		
		$config['base_url'] = base_url().'/admin/administration/training';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/training',$data);
		$this->load->view('agadmin/layout/footer');
	}

	public function training_edit(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->employee_training_details($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
		if($this->input->post()){
			$this->emp_model->update_employee_training($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'administration/training');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/training_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}	

	public function training_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/training_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function training_ajax_upload(){
		$data['results'] = array();
		if(isset($_FILES)){
			$path = 'excel';
			$file_name = '';
			$res = $this->common_model->upload_file('file',"*",$path);
			
			if($res['is_success']){
				$file_name = $path.'/'.$res['filename'];
			}else{
				@unlink($file_name);
				$error_msg = $res['message'];
				echo json_encode($res);
				exit();
			}
			$this->load->library('spreadsheet');
			$res = $this->spreadsheet->read_file($file_name);
			if(isset($res['values']) && empty($res['values'])){
				// empty file
				$response = array(
						'is_success'	=> false,
						'message'		=> 'The file is empty'
					);
				@unlink($file_name);
				echo json_encode($response);
				exit();
			}
			$headers = array();
			$upload = array();
			
			$header_security_field =  array('EMPID','NAME','DESIG','EMP_SECTION','BASIC_PAY','FIN_YEAR','TRAINING_ORDER','ORDER_DATE','TRAINING_TYPE','DESCRIPTION','LOCATION','TRAINING_FROM','TRAINING_TO','TRG_TIME','TRAINING_DAYS','BILL_NO','ADVANCE_BILL_NO');
																			
			foreach($res['header'] as $key => $val){
				if(trim($val) != ''){ // remove empty cel 
					$val = strtoupper($val);
					if(in_array($val,$header_security_field)){
						$headers[$key]	= strtolower($val);
						if (($k = array_search($val, $header_security_field)) !== false) {
							unset($header_security_field[$k]);
						}
					}
				}
			}
			if(!empty($header_security_field)){
				$response = array(
							'is_success'	=> false,
							'message'		=> 'The file has extra field.'
						);
						@unlink($file_name);
						echo json_encode($response);
						exit();
			}
			$i = 0;
			
			foreach($res['values'] as $row => $columns){
				$up_arr = array_fill_keys($headers,"");
				foreach($columns as $key=>$val){
					if(isset($headers[$key])){ // remove empty cel 
						$up_arr[$headers[$key]]	= $val;
					}
				}
				$upload[] = $up_arr;				
			}
				//			$bulk_elem = 10;
				//			$bulk_upload = array();
				//			if( count($upload) > $bulk_elem ){
				//				$bulk_upload = array_chunk($upload,$bulk_elem);
				//				foreach($bulk_upload as $bulk){
				//					$this->db->insert_batch('employee_training',$bulk);
				//				}
				//			}else{
				//				$this->db->insert_batch('employee_training',$upload);
				//			}
			foreach($upload as $record){
				$empid = isset($record['empid']) ? $record['empid'] : 0;
				$training_type = isset($record['training_type']) ? $record['training_type'] : 0;
				$training_from = isset($record['training_from']) ? $record['training_from'] : 0;
				// check records exists
				$res = $this->db->get_where('employee_training',array('empid'=>$empid,'training_type'=>$training_type,'training_from'=>$training_from));
				if($res->num_rows() > 0){
//					'update_dt'	= date('Y-m-d H:i:s');
					$this->db->where('empid',$empid)->where('training_type',$training_type)->where('training_from',$training_from)->update('employee_training',$record);
				}else{
//					'update_dt'	= date('Y-m-d H:i:s')
					$this->db->insert('employee_training',$record);
				}
				
			}
			$db_error = $this->db->error();
			if(!empty($db_error) && $db_error['code'] != 0 && trim($db_error['message']) != ''){
				$message = $db_error['code'].' '.$db_error['message'];
				$is_success = false;
				@unlink($file_name);
			}else{
				$message = 'Successfully updated.';
				$is_success = true;
				@unlink($file_name);
			}
		}else{
			$message = 'No file selected.';
			$is_success = false;
		}
		$response = array(
						'is_success'	=> $is_success,
						'message'		=> $message
					);
		echo json_encode($response);
		exit();
	}
	
		
	
	public function training_master_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/training_master_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function training_master_ajax_upload(){
		$data['results'] = array();
		if(isset($_FILES)){
			$path = 'excel';
			$file_name = '';
			$res = $this->common_model->upload_file('file',"*",$path);
			
			if($res['is_success']){
				$file_name = $path.'/'.$res['filename'];
			}else{
				@unlink($file_name);
				$error_msg = $res['message'];
				echo json_encode($res);
				exit();
			}
			$this->load->library('spreadsheet');
			$res = $this->spreadsheet->read_file($file_name);
			if(isset($res['values']) && empty($res['values'])){
				// empty file
				$response = array(
						'is_success'	=> false,
						'message'		=> 'The file is empty'
					);
				@unlink($file_name);
				echo json_encode($response);
				exit();
			}
			$headers = array();
			$upload = array();
			
			$header_security_field =  array('TRANG_ID','FIN_YEAR','TRAINING_TYPE','TITLE','DESCRIPTION','LOCATION','TRAINING_FROM','TRAINING_TO','TRG_TIME','TRAINING_DAYS','TRAINING_ASSIGN_DT','TRAINING_ORDER','ORDER_DATE');
																			
			foreach($res['header'] as $key => $val){
				if(trim($val) != ''){ // remove empty cel 
					$val = strtoupper($val);
					if(in_array($val,$header_security_field)){
						$headers[$key]	= strtolower($val);
						if (($k = array_search($val, $header_security_field)) !== false) {
							unset($header_security_field[$k]);
						}
					}
				}
			}
			if(!empty($header_security_field)){
				$response = array(
							'is_success'	=> false,
							'message'		=> 'The file has extra field.'
						);
						@unlink($file_name);
						echo json_encode($response);
						exit();
			}
			$i = 0;
			
			foreach($res['values'] as $row => $columns){
				$up_arr = array_fill_keys($headers,"");
				foreach($columns as $key=>$val){
					if(isset($headers[$key])){ // remove empty cel 
						$up_arr[$headers[$key]]	= $val;
					}
				}
				$upload[] = $up_arr;				
			}
				//			$bulk_elem = 10;
				//			$bulk_upload = array();
				//			if( count($upload) > $bulk_elem ){
				//				$bulk_upload = array_chunk($upload,$bulk_elem);
				//				foreach($bulk_upload as $bulk){
				//					$this->db->insert_batch('training_master',$bulk);
				//				}
				//			}else{
				//				$this->db->insert_batch('training_master',$upload);
				//			}
			foreach($upload as $record){
				$trang_id = isset($record['trang_id']) ? $record['trang_id'] : 0;
				// check records exists
				$res = $this->db->get_where('training_master',array('trang_id'=>$trang_id));
				if($res->num_rows() > 0){
//					'update_dt'	= date('Y-m-d H:i:s');
					$this->db->where('trang_id',$trang_id)->update('training_master',$record);
				}else{
//					'update_dt'	= date('Y-m-d H:i:s')
					$this->db->insert('training_master',$record);
				}
				
			}
			$db_error = $this->db->error();
			if(!empty($db_error) && $db_error['code'] != 0 && trim($db_error['message']) != ''){
				$message = $db_error['code'].' '.$db_error['message'];
				$is_success = false;
				@unlink($file_name);
			}else{
				$message = 'Successfully updated.';
				$is_success = true;
				@unlink($file_name);
			}
		}else{
			$message = 'No file selected.';
			$is_success = false;
		}
		$response = array(
						'is_success'	=> $is_success,
						'message'		=> $message
					);
		echo json_encode($response);
		exit();
	}
	
	public function training_program(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_all_trainings($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/administration/training_program';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/training_program',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function training_assignment(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
				
		$data['employees'] = $this->emp_model->get_all_employee_list_training();

		$data['designation'] = array();
		foreach($data['employees'] as $val){
			if(!in_array($val['desig'],$data['designation'])){
				$data['designation'][] = $val['desig'];
			}			
		}
		$id = $this->uri->segment(4);
		
		$data['row'] = array();
		$data['asign_emp'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->getTrainingPrgByID($id);
			$data['asign_emp'] = $this->emp_model->getTrainingPrgToEmployees($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$error = '';
		if($this->input->post()){
			$this->form_validation->set_rules('title', 'Title', 'required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				$update = array(
							'title'		=> $this->input->post('title',true),
							'details'	=> $this->input->post('details'),
							'order_dt'	=> date('Y-m-d',strtotime($this->input->post('order_dt'))),
							'update_dt'	=> date('Y-m-d H:i:s')
						);
				if(isset($_FILES['attachment']) && $_FILES['attachment']['size'][0] > 0){
					//upload file
					$upload_details = $this->common_model->upload_multiple_file('attachment');
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
						redirect(ADMIN_BASE_URL.'administration/training_program');
					}else{
						$update['attachment'] = implode(';',$upload_details['filenames']);
					}
				}

				$empid_data =  $this->input->post('emp_concerned');
		
				$training_id = $this->input->post('trang_id',true);
				$empid=key($empid_data);
				if($error == ''){
					if(!empty($id)){ // edit
						$this->emp_model->update_training_to_employee($id,$this->input->post('emp_concerned'));
						$emp_tr_id = $this->emp_model->emp_training_details_record($empid,$training_id);
						$this->session->set_flashdata('success','Successfully updated and SMS sent.');						
					}else{ // add
//						$update['order_dt'] = date('Y-m-d H:i:s');
//      				$update['order_dt'] = date('Y-m-d',strtotime($this->input->post('order_dt')));				
						$this->emp_model->add_training_to_employee($id,$this->input->post('emp_concerned'));
						$emp_tr_id = $this->emp_model->emp_training_details_record($empid,$training_id);
						$this->session->set_flashdata('success','Successfully allotted and SMS sent.');
					}
					redirect(ADMIN_BASE_URL.'administration/training_program');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/training_assignment',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function training_delete(){
		$this->load->model('emp_model');
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->emp_model->training_details($id);
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->emp_model->deleteTrainingOrderByID($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'administration/training');
	}

	public function all_employees_trainings(){
		$this->load->model('emp_model');
		$headings = array();
		$firstrow = array();
		$all_trainings = $this->emp_model->all_employees_trainings('AGAE');
		if(!empty($all_trainings)){
			unset($all_trainings[0]['training_id']);
			foreach( $all_trainings[0] as $k => $v ) {
					$headings[] = strtoupper($k);
					$firstrow[] = $v;
			}
			unset($all_trainings[0]);
		}
		$excel_data[] = $headings;
		$excel_data[1] = $firstrow;
		foreach( $all_trainings as $row ) {
			unset($row['training_id']);
			$row['training_from'] = date('d-m-Y  A',strtotime($row['training_from']));
			$excel_data[] = $row;
		}
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Training of employees');
		$this->excel->getActiveSheet()->fromArray($excel_data);
		 
		$filename='Trainings'.time().'.xls'; //save our workbook as this file name
		header('Content-Type: Training/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}
	
	public function training_employee(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_employees_issued_training_order($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/administration/training_employee';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/training_employee',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function training_employee_delete(){
		$this->load->model('emp_model');
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->emp_model->getEmployeeTrainingOrderByID($id);
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->emp_model->delete_employees_training_OrderByID($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'administration/training_employee');
	}
	public function training_order_download(){
		$this->load->library('m_pdf');
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
			
		$id = $this->input->post('training_id');
		
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->get_training_order_print($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}

		$data['candidates'] = $this->emp_model->get_trainees_list($id);
		$html = $this->load->view('agadmin/pages/administration/training_order_download',$data,true);//load the pdf_output.php by passing our data and get all data in $html varriable.
		
		$img=FCPATH . "assets/images/top-head.png";
		$pdfFilePath ="Training_Order".time().".pdf";
		$pdf = $this->m_pdf->letterPdfCreate();
		$pdf->SetWatermarkText('O/o the Pr. Accountant General (A&E), WB');
		$pdf->watermark_font = 'DejaVuSansCondensed';
		$pdf->watermarkTextAlpha = 0.1;
		$pdf->showWatermarkText = true;
		$pdf->SetWatermarkImage($img,1,'',array(1,10));
		$pdf->watermarkImageAlpha = 1;
		$pdf->showWatermarkImage =  true;
		$pdf->WriteHTML($html);
		$pdf->Output($pdfFilePath, "D");
//		$pdf->Output();
	}
	
	public function faculty_order_download(){
		$this->load->library('m_pdf');
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
			
		$id = $this->input->post('training_id');
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->get_faculty_order_print($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$data['candidates'] = $this->emp_model->get_faculties_list($id);
		$html = $this->load->view('agadmin/pages/administration/faculty_order_download',$data,true);//load the pdf_output.php by passing our data and get all data in $html varriable.
		
		$img=FCPATH . "assets/images/top-head.png";
		$pdfFilePath ="Faculty_Order".time().".pdf";
		$pdf = $this->m_pdf->letterPdfCreate();
		$pdf->SetWatermarkText('O/o the Pr. Accountant General (A&E), WB');
		$pdf->watermark_font = 'DejaVuSansCondensed';
		$pdf->watermarkTextAlpha = 0.1;
		$pdf->showWatermarkText = true;
		$pdf->SetWatermarkImage($img,1,'',array(1,10));
		$pdf->watermarkImageAlpha = 1;
		$pdf->showWatermarkImage =  true;
		$pdf->WriteHTML($html);
		$pdf->Output($pdfFilePath, "D");
//		$pdf->Output();
	}
	
	public function faculty_assignment(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
				
		$data['employees'] = $this->emp_model->get_all_employee_list();

		$data['designation'] = array();
		foreach($data['employees'] as $val){
			if(!in_array($val['desig'],$data['designation'])){
				$data['designation'][] = $val['desig'];
			}			
		}
		$id = $this->uri->segment(4);
		
		$data['row'] = array();
		$data['asign_emp'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->getTrainingPrgByID($id);
			$data['asign_emp'] = $this->emp_model->getTrainingPrgToFaculties($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$error = '';
		if($this->input->post()){
			$this->form_validation->set_rules('title', 'Title', 'required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				$update = array(
							'title'		=> $this->input->post('title',true),
							'details'	=> $this->input->post('details'),
							'order_dt'	=> date('Y-m-d',strtotime($this->input->post('order_dt'))),
							'update_dt'	=> date('Y-m-d H:i:s')
						);
				if(isset($_FILES['attachment']) && $_FILES['attachment']['size'][0] > 0){
					//upload file
					$upload_details = $this->common_model->upload_multiple_file('attachment');
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
						redirect(ADMIN_BASE_URL.'administration/training_program');
					}else{
						$update['attachment'] = implode(';',$upload_details['filenames']);
					}
				}

				$empid_data =  $this->input->post('emp_concerned');
		
				$training_id = $this->input->post('trang_id',true);
				if($error == ''){
					if(!empty($id)){ // edit
						$this->emp_model->update_training_to_faculties($id,$this->input->post('emp_concerned'));
						$emp_tr_id = $this->emp_model->emp_training_faculties_record($this->input->post('emp_concerned'),$training_id);
						$this->session->set_flashdata('success','Successfully updated and SMS sent.');						
					}else{ // add
//						$update['order_dt'] = date('Y-m-d H:i:s');
//      				$update['order_dt'] = date('Y-m-d',strtotime($this->input->post('order_dt')));				
						$this->emp_model->add_training_to_faculties($id,$this->input->post('emp_concerned'));
						$emp_tr_id = $this->emp_model->emp_training_faculties_record($this->input->post('emp_concerned'),$training_id);
						$this->session->set_flashdata('success','Successfully allotted and SMS sent.');
					}
					redirect(ADMIN_BASE_URL.'administration/training_program');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/faculty_assignment',$data);
		$this->load->view('agadmin/layout/footer');
	}	
	
	//------------feedback		
	public function feedback(){
		$this->load->model('common_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->common_model->all_administration_feedback($page_no);
		$data['results'] = $response['results'];
		
		$data['all_groups'] = $this->common_model->get_all_groups();
		
		$config['base_url'] = base_url().'/admin/administration/feedback';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/feedback',$data);
		$this->load->view('agadmin/layout/footer');
	}

	public function feedback_review(){
		$this->load->model('common_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->common_model->feedback_details($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
		if($this->input->post()){
			$this->common_model->update_all_feedback_action($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'administration/feedback');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/feedback_review',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function feedback_action(){
		$this->load->model('common_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->common_model->feedback_details($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
		if($this->input->post()){
			$this->common_model->update_administration_feedback_action($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'administration/feedback');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/feedback_action',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function feedback_download(){
		$this->load->model('common_model');
		$headings = array();
		$firstrow = array();
		$all_feedbacks = $this->common_model->get_feedback_download('AGAE');
		if(!empty($all_feedbacks)){
//			unset($all_feedbacks[0]['feed_id']);
			foreach( $all_feedbacks[0] as $k => $v ) {
					$headings[] = strtoupper($k);
					$firstrow[] = $v;
			}
			unset($all_feedbacks[0]);
		}
		$excel_data[] = $headings;
		$excel_data[1] = $firstrow;
		foreach( $all_feedbacks as $row ) {
//			unset($row['feed_id']);
			$row['feed_date'] = date('d-m-Y  A',strtotime($row['feed_date']));
			$excel_data[] = $row;
		}
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Feedback');
		$this->excel->getActiveSheet()->fromArray($excel_data);
		 
		$filename='Admin_Feedbacks_'.time().'.xls'; //save our workbook as this file name
		header('Content-Type: Feednacl/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}
	public function feedback_download_pdf() { 
		$this->load->library('m_pdf');
		$this->load->model('common_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->common_model->feedback_details($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$html = $this->load->view('agadmin/pages/administration/feedback_pdf',$data,true);//load the pdf_output.php by passing our data and get all data in $html varriable.
		$pdfFilePath ="Feedback_".$feed_id.".pdf";

		$pdf = $this->m_pdf->generate();
		$pdf->SetWatermarkText('O/o the Pr. Accountant General (A&E), WB');
		$pdf->watermark_font = 'DejaVuSansCondensed';
		$pdf->watermarkTextAlpha = 0.1;
		$pdf->showWatermarkText = true;
		$pdf->WriteHTML($html);
		$pdf->Output($pdfFilePath, "D");
//		$pdf->Output();
    }

	public function trg_feedback_download(){
		$this->load->model('emp_model');
		$headings = array();
		$firstrow = array();
		$all_training_fk = $this->emp_model->get_training_feedback_download('AGAE');
		if(!empty($all_training_fk)){
			unset($all_training_fk[0]['trg_feedback_id']);
			foreach( $all_training_fk[0] as $k => $v ) {
					$headings[] = strtoupper($k);
					$firstrow[] = $v;
			}
			unset($all_training_fk[0]);
		}
		$excel_data[] = $headings;
		$excel_data[1] = $firstrow;
		foreach( $all_training_fk as $row ) {
			$row['trg_feedback_id'];
//			$row['training_from'] = date('d-m-Y  A',strtotime($row['training_from']));
			$excel_data[] = $row;
		}
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Training Feedback of employees');
		$this->excel->getActiveSheet()->fromArray($excel_data);
		 
		$filename='Trg_Feedback'.time().'.xls'; //save our workbook as this file name
		header('Content-Type: Training/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}
	public function employee_download(){
		$this->load->model('emp_model');
		$headings = array();
		$firstrow = array();
		$all_emmployees = $this->emp_model->get_employee_download();
		if(!empty($all_emmployees)){
			unset($all_emmployees[0]['e_id']);
			foreach( $all_emmployees[0] as $k => $v ) {
					$headings[] = strtoupper($k);
					$firstrow[] = $v;
			}
			unset($all_emmployees[0]);
		}
		$excel_data[] = $headings;
		$excel_data[1] = $firstrow;
		foreach( $all_emmployees as $row ) {
			unset($row['e_id']);
//			unset($row['nicmail_proposed']);
//			unset($row['password']);		
//			$row['dor'] = date('d-m-Y  A',strtotime($row['dor']));
			$excel_data[] = $row;
		}
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Feedback');
		$this->excel->getActiveSheet()->fromArray($excel_data);
		 
		$filename='employee_list_'.time().'.xls'; //save our workbook as this file name
		header('Content-Type: Feednacl/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}

	public function property_st_list(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->all_asset_declarations($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/administration/property_st_list';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/property_st_list',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function property_st_admn(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->all_asset_declarations($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/administration/property_st_admn';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/property_st_admn',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function property_st_edit(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();

		if(!empty($id)){
			$data['row'] = $this->emp_model->asset_declarations_ById($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}

		if($this->input->post()){
			$this->emp_model->update_asset_declaration($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'administration/property_st_admn');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/property_st_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function property_st_list_total(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->all_asset_declarations_total($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/administration/property_st_list_total';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/property_st_list_total',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function asset_declarations_download(){
		$this->load->model('emp_model');
		$headings = array();
		$firstrow = array();
		$declarations = $this->emp_model->get_asset_declarations_download();
		if(!empty($declarations)){
			unset($declarations[0]['pst_id']);
			foreach( $declarations[0] as $k => $v ) {
					$headings[] = strtoupper($k);
					$firstrow[] = $v;
			}
			unset($declarations[0]);
		}
		$excel_data[] = $headings;
		$excel_data[1] = $firstrow;
		foreach( $declarations as $row ) {
			unset($row['pst_id']);
			$row['decl_date'] = date('d-m-Y',strtotime($row['decl_date']));
			$excel_data[] = $row;
		}
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Feedback');
		$this->excel->getActiveSheet()->fromArray($excel_data);
		 
		$filename='Asset_Declarations_'.time().'.xls'; //save our workbook as this file name
		header('Content-Type: Feednacl/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}	
	
	public function asset_declarations_pdf() { 
		$this->load->library('m_pdf');
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
			
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->get_property_st_print($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		
		$empid= $data['row']['empid'];
		$pst_year= $data['row']['pst_year'];
		$decl_for= $data['row']['decl_for'];
		
		if($decl_for == 'Self'){
			$html = $this->load->view('agadmin/pages/administration/property_self_pdf',$data,true);//load the pdf_output.php by passing our data and get all data in $html varriable.
			$pdfFilePath ="Asset_Declaration_Self_".$empid."_".$pst_year.".pdf";
		}else{
			$html = $this->load->view('agadmin/pages/administration/property_dependent_pdf',$data,true);//load the pdf_output.php by passing our data and get all data in $html varriable.
			$pdfFilePath ="Asset_Declaration_Dependents_".$empid."_".$pst_year.".pdf";
		}

		$pdf = $this->m_pdf->pdfgenerate();
		$pdf->SetWatermarkText('O/o the Pr. Accountant General (A&E), WB');
		$pdf->watermark_font = 'DejaVuSansCondensed';
		$pdf->watermarkTextAlpha = 0.1;
		$pdf->showWatermarkText = true;
		$pdf->WriteHTML($html);
//		$pdf->Output($pdfFilePath, "D");
		$pdf->Output();
    }
	
	
	
	public function application_exam_list(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$data['examinations'] = $this->emp_model->get_all_employee_examinations_list();
		$response = $this->emp_model->get_application_exam_list($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/administration/application_exam_list';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/application_exam_list',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function application_exam_list_edit(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->get_application_exam_list_edit($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
		if($this->input->post()){
			$this->emp_model->update_application_exam_status($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'administration/application_exam_list');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/application_exam_list_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function application_exam_delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->wing_model->getApplicationExamByID($id);
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->wing_model->deleteApplicationExamByID($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'administration/application_exam_list');
	}
	public function application_exam_other_list(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		
		$response = $this->emp_model->get_application_exam_other_list($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/administration/application_exam_other_list';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/application_exam_other_list',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function application_exam_other_list_edit(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->get_application_exam_other_list_edit($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
		if($this->input->post()){
			$this->emp_model->update_application_exam_other_status($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'administration/application_exam_list');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/application_exam_other_list_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function application_exam_other_delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->wing_model->getApplicationExamByID($id);
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->wing_model->deleteApplicationExamByID($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'administration/application_exam_other_list');
	}
	public function application_invite(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		
		$response = $this->emp_model->get_all_exam_list($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/administration/application_invite';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/application_invite',$data);
		$this->load->view('agadmin/layout/footer');
	}
		
	public function application_exam_add(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->emp_model->getExamNameByID($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$error = '';
		if($this->input->post()){
			$this->form_validation->set_rules('exam_name', 'Title', 'required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				$update = array(
							'exam_name'	=> $this->input->post('exam_name',true),
							'off_on'	=> 'No',
							'update_dt'	=> date('Y-m-d')
						);
				if($error == ''){
					if(!empty($id)){ // edit
						$result = $this->emp_model->updateExamName($id,$update);
						$this->session->set_flashdata('success','Successfully updated.');
						redirect(ADMIN_BASE_URL.'administration/application_invite');
					}else{ // add
						$update['update_dt'] = date('Y-m-d');
						$this->emp_model->addNewExamName($update);
						$this->session->set_flashdata('success','Successfully added.');
						redirect(ADMIN_BASE_URL.'administration/application_invite');
					}
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/application_exam_add',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function application_invited(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		
		$response = $this->emp_model->get_all_invited_exam_list($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/administration/application_invited';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/application_invited',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function application_invite_update(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->get_application_exam_invite_update($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
		if($this->input->post()){
			$this->emp_model->update_exam_invite_status($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'administration/application_invite');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/application_invite_update',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function application_invited_update(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->get_application_exam_invite_update($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
		if($this->input->post()){
			$this->emp_model->update_exam_invite_status($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'administration/application_invited');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/application_invited_update',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function epabx_list(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_epabx_extension_list_admin($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/administration/epabx_list';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/epabx_list',$data);
		$this->load->view('agadmin/layout/footer');
	}

	public function epabx_list_edit(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->epabx_extension_list_edit($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
		$data['section_list'] = $this->emp_model->get_all_section_list();
		if($this->input->post()){
			$this->emp_model->update_epabx_extension($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'administration/epabx_list');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/epabx_list_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}

//------------faculty	
	public function faculty(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
				);
		$data['training_ids'] = $this->emp_model->get_all_training_ids();
		$data['training_types'] = $this->emp_model->get_all_training_types();
		
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->employee_training_faculty_records($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/administration/faculty';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/faculty',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function all_training_faculties(){
		$this->load->model('emp_model');
		$headings = array();
		$firstrow = array();
		$all_trainings = $this->emp_model->all_employees_training_faculties('AGAE');
		if(!empty($all_trainings)){
			unset($all_trainings[0]['training_id']);
			foreach( $all_trainings[0] as $k => $v ) {
					$headings[] = strtoupper($k);
					$firstrow[] = $v;
			}
			unset($all_trainings[0]);
		}
		$excel_data[] = $headings;
		$excel_data[1] = $firstrow;
		foreach( $all_trainings as $row ) {
			unset($row['training_id']);
			$row['training_from'] = date('d-m-Y  A',strtotime($row['training_from']));
			$excel_data[] = $row;
		}
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Training of employees');
		$this->excel->getActiveSheet()->fromArray($excel_data);
		 
		$filename='Faculties'.time().'.xls'; //save our workbook as this file name
		header('Content-Type: Training/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}
	public function service_book(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->wing_model->get_doc_office_order($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/administration/service_book';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/service_book',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function service_book_add(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		
		$data['employees'] = $this->emp_model->get_all_employee_list();
		$data['designation'] = array();
		foreach($data['employees'] as $val){
			if(!in_array($val['desig'],$data['designation'])){
				$data['designation'][] = $val['desig'];
			}			
		}
		$id = $this->uri->segment(4);
		$data['row'] = array();
		$data['asign_emp'] = array();
		if(!empty($id)){
			$data['row'] = $this->wing_model->getOfficeOrderByID($id);
			$data['asign_emp'] = $this->wing_model->getOfficeOrderToEmployees($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$error = '';
		if($this->input->post()){
			
			$emp_concerned =  $this->input->post('emp_concerned');
				foreach($emp_concerned as $empid=>$mobile){
//					$ord_empid = $empid;
					$ord_empid = $empid;
			}
	
			$this->form_validation->set_rules('title', 'Title', 'required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				$update = array(
							'ord_empid' => $ord_empid,
							'title'		=> $this->input->post('title',true),
							'details'	=> $this->input->post('details'),
							'order_dt'	=> date('Y-m-d',strtotime($this->input->post('order_dt'))),
							'sb_upto_dt'	=> date('Y-m-d',strtotime($this->input->post('sb_upto_dt'))),
							'ord_year'	=> date('Y'),
							'update_dt'	=> date('Y-m-d H:i:s')
						);
				if(isset($_FILES['attachment']) && $_FILES['attachment']['size'][0] > 0){
					//upload file
					$upload_details = $this->common_model->upload_service_book('attachment');
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
						redirect(ADMIN_BASE_URL.'administration/service_book');
					}else{
						$update['attachment'] = implode(';',$upload_details['filenames']);
					}
				}			
				if($error == ''){
					if(!empty($id)){ // edit
						$result = $this->wing_model->updateOfficeOrder($id,$update);
						$this->wing_model->update_office_order_to_employee($id,$emp_concerned);
						$this->session->set_flashdata('success','Successfully updated.');
					}else{ // add
//						$update['order_dt'] = date('Y-m-d H:i:s');
//      				$update['order_dt'] = date('Y-m-d',strtotime($this->input->post('order_dt')));
						$id = $this->wing_model->addOfficeOrder($update);					
						$this->wing_model->add_office_order_to_employee($id,$emp_concerned);
						$this->session->set_flashdata('success','Successfully added.');
					}
					redirect(ADMIN_BASE_URL.'administration/service_book');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/service_book_add',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function charge_master(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_admin_charge_records($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/administration/charge_master';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/charge_master',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function charge_master_add(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		
		$data['sections_list'] = $this->emp_model->get_all_sections();
		$data['groups'] = array();
		foreach($data['sections_list'] as $val){
			if(!in_array($val['sec_br_group'],$data['groups'])){
				$data['groups'][] = $val['sec_br_group'];
			}			
		}
		
		$error = '';
		$id = $this->uri->segment(4);
		if($this->input->post()){
			$this->form_validation->set_rules('charge_desc', 'Charge ', 'required');		
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				$post['sec_charge']= $this->input->post('sec_charge');			
				$section = explode('@@@',$post['sec_charge']);
				if(count($section) == 2){
					$sec_indx = isset($section[0]) ? $section[0] : '';
					$section_nm = isset($section[1]) ? $section[1] : '';
				}					
				$update = array(
							'group_nm'	=> $this->input->post('group_nm'),
							'sec_indx'	=> $sec_indx,
							'section_nm'	=> $section_nm,
							'charge_desc'	=> $this->input->post('charge_desc',true),
							'update_dt'		=> date('Y-m-d'),
						);

				if($error == ''){
					if(!empty($id)){ // edit
						$result = $this->emp_model->updateChargeToMaster($id,$update);
						$this->session->set_flashdata('success','Successfully updated.');
					}else{ // add
						$update['upload_dt'] = date('Y-m-d H:i:s');
						$id = $this->emp_model->addChargeToMaster($update);
						$this->session->set_flashdata('success','Successfully added.');
					}
					redirect(ADMIN_BASE_URL.'administration/charge_master');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/charge_master_add',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function charge_master_edit(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		
		$data['sections_list'] = $this->emp_model->get_all_sections();
		$data['groups'] = array();
		foreach($data['sections_list'] as $val){
			if(!in_array($val['sec_br_group'],$data['groups'])){
				$data['groups'][] = $val['sec_br_group'];
			}			
		}
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->emp_model->getChargeDescByID($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}

		$error = '';
		if($this->input->post()){
			$this->form_validation->set_rules('charge_desc', 'Charge ', 'required');		
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				$post['sec_charge']= $this->input->post('sec_charge');			
				$section = explode('@@@',$post['sec_charge']);
				if(count($section) == 2){
					$sec_indx = isset($section[0]) ? $section[0] : '';
					$section_nm = isset($section[1]) ? $section[1] : '';
				}					
				$update = array(
							'group_nm'	=> $this->input->post('group_nm'),
							'sec_indx'	=> $sec_indx,
							'section_nm'	=> $section_nm,
							'charge_desc'	=> $this->input->post('charge_desc',true),
							'update_dt'		=> date('Y-m-d'),
						);

				if($error == ''){
					if(!empty($id)){ // edit
						$result = $this->emp_model->updateChargeToMaster($id,$update);
						$this->session->set_flashdata('success','Successfully updated.');
					}else{ // add
						$update['upload_dt'] = date('Y-m-d H:i:s');
						$id = $this->emp_model->addChargeToMaster($update);
						$this->session->set_flashdata('success','Successfully added.');
					}
					redirect(ADMIN_BASE_URL.'administration/charge_master');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/charge_master_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function charge_master_delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$this->load->model('emp_model');
			$this->emp_model->deleteChargeMaster($id);
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'administration/charge_master');
	}
	public function signature_master(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_all_signature_records($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/administration/signature_master';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/signature_master',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function signature_master_new(){
		$this->load->model('emp_model');
		
		$data = $this->emp_model->get_last_signature_id();
		if($this->input->post()){
			$sign_id= $this->input->post('sign_id',true);
		}else{
			$sign_id= $data['max_id']+1;		
			$this->db->insert('signature_master',array('sign_id'=>$sign_id));
		}

		$id = $sign_id;
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->getSignatureTagByID($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$error = '';
		
		if($this->input->post()){
			$this->form_validation->set_rules('desig_code', 'Desig Code', 'required');			
			$this->form_validation->set_rules('officer_desig', 'Officer-Designation', 'required');
			$this->form_validation->set_rules('officer_name', 'Officer-Name', 'required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				$update = array(
							'desig_code'	=> $this->input->post('desig_code'),
							'officer_desig'	=> $this->input->post('officer_desig'),
							'officer_name'	=> $this->input->post('officer_name',true),
							'update_dt'		=> date('Y-m-d H:i:s'),
						);
						

				if(isset($_FILES['sign_tag']) && $_FILES['sign_tag']['size'][0] > 0){
					//upload file				
					$upload_details = $this->common_model->upload_signature('sign_tag');

					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
						redirect(ADMIN_BASE_URL.'administration/signature_master');
					}else{
						$update['sign_tag'] = implode(';',$upload_details['filenames']);
					}

				}

				if($error == ''){
					if(!empty($id)){ // edit
						$result = $this->emp_model->updateSignatureTag($id,$update);
						$this->session->set_flashdata('success','Successfully updated.');
					}else{
						$id = $this->emp_model->addSignatureTag($update);
						$this->session->set_flashdata('success','Successfully added.');
					}
					redirect(ADMIN_BASE_URL.'administration/signature_master');
				}
			}
		}
		
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/signature_master_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function signature_master_edit(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->getSignatureTagByID($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$error = '';
		
		if($this->input->post()){
			$this->form_validation->set_rules('desig_code', 'Desig Code', 'required');			
			$this->form_validation->set_rules('officer_desig', 'Officer-Designation', 'required');
			$this->form_validation->set_rules('officer_name', 'Officer-Name', 'required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				$update = array(
							'desig_code'	=> $this->input->post('desig_code'),
							'officer_desig'	=> $this->input->post('officer_desig'),
							'officer_name'	=> $this->input->post('officer_name',true),
							'update_dt'		=> date('Y-m-d H:i:s'),
						);
						

				if(isset($_FILES['sign_tag']) && $_FILES['sign_tag']['size'][0] > 0){
					//upload file				
					$upload_details = $this->common_model->upload_signature('sign_tag');

					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
						redirect(ADMIN_BASE_URL.'administration/signature_master');
					}else{
						$update['sign_tag'] = implode(';',$upload_details['filenames']);
					}

				}

				if($error == ''){
					if(!empty($id)){ // edit
						$result = $this->emp_model->updateSignatureTag($id,$update);
						$this->session->set_flashdata('success','Successfully updated.');
					}else{
						$id = $this->emp_model->addSignatureTag($update);
						$this->session->set_flashdata('success','Successfully added.');
					}
					redirect(ADMIN_BASE_URL.'administration/signature_master');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/signature_master_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function signature_master_delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$this->load->model('emp_model');
			$this->emp_model->deleteSignatureTag($id);
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'administration/signature_master');
	}
	
	public function notice(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['results'] = $this->emp_model->get_notice_display();
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/notice',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function notice_add(){
		$this->load->model('emp_model');
		$this->load->library('form_validation');
		$this->load->helper('security');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->get_employee_notice_by_id($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		if($this->input->post()){
			$this->form_validation->set_rules('title', 'Title in English', 'trim|xss_clean|required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				// Add records
				$update = array(
							'title'			=> $this->input->post('title',true),
							'title_hindi'	=> $this->input->post('title_hindi',true),
							'title_bengali'	=> $this->input->post('title_bengali',true),
							'url_link'		=> $this->input->post('url_link',true),
							'display'		=> $this->input->post('display',true),
							'flash'			=> $this->input->post('flash',true),
							'expiry_dt'		=> date('Y-m-d',strtotime($this->input->post('expiry_dt',true))),
							'create_dt'		=> date('Y-m-d H:i:s')
				);
				$error = '';
				if(isset($_FILES['link_file']) && $_FILES['link_file']['size'] > 0){
					//upload file
					$upload_details = $this->common_model->upload_multiple_order_cicular('link_file');
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
					}else{
						$update['link_file'] = $upload_details['filename'];
					}
				}
				if($error == ''){
					if(!empty($id)){ // edit
						$result = $this->emp_model->update_employee_notice($id,$update);
						$this->session->set_flashdata('success','Successfully updated.');
					}else{	// add
						$update['create_dt'] = date('Y-m-d H:i:s');
						$id = $this->emp_model->add_employee_notice($update);
						$this->session->set_flashdata('success','Successfully added.');
					}
					redirect(ADMIN_BASE_URL.'administration/notice');
				}
			}
		}
		
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/notice_add',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function notice_delete(){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->emp_model->get_employee_notice_by_id($id);
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->emp_model->delete_employee_notice($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'administration/notice');
	}
	
	public function notice_flash(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['results'] = $this->emp_model->get_flash_notice_display();
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/notice_flash',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function sections(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_admin_all_sections($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/administration/sections';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/sections',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function section(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_admin_all_sections($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/administration/section';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/section',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function section_delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$this->db->where('sect_idx',$id)->delete('section_master');
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'administration/section');
	}
	public function section_br(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_admin_all_branches($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/administration/section_br';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/section_br',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function section_branch_add(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['branches'] = $this->emp_model->get_all_branches();
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->get_admin_section_by_id($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}

		$error = '';
		if($this->input->post()){
			$this->form_validation->set_rules('sec_index', 'Section Index', 'required');
			$this->form_validation->set_rules('section', 'Section', 'required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				$post['emp_branch']= $this->input->post('emp_branch');
				$branch = explode('@@@',$post['emp_branch']);
				if(count($branch) == 2){
					$sec_indx = isset($branch[0]) ? $branch[0] : '';
					$section_nm = isset($branch[1]) ? $branch[1] : '';
				}	
				$update = array(
							'sec_index'		=> $this->input->post('sec_index', true),
							'sec_br_type'	=> $this->input->post('sec_br_type', true),
							'sec_br_group'	=> $this->input->post('sec_br_group',true),
							'section'		=> $this->input->post('section',true),
							'bo_index'		=> $sec_indx,
							'officer_nm'	=> $this->input->post('officer_nm',true),
							'upload_dt'		=> date('Y-m-d H:i:s'),
						);
				if($error == ''){
					if(!empty($id)){ // edit
						$result = $this->emp_model->updateSection($id,$update);
						$this->session->set_flashdata('success','Successfully updated.');
					}else{
						$id = $this->emp_model->addSection($update);
						$this->session->set_flashdata('success','Successfully added.');
					}
					redirect(ADMIN_BASE_URL.'administration/section');
				}
			}
		}
	
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/section_branch_add',$data);
		$this->load->view('agadmin/layout/footer');
	}	
	public function section_branch_edit(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['branches'] = $this->emp_model->get_all_branches();
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->get_admin_section_by_id($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}

		$error = '';
		if($this->input->post()){
			$this->form_validation->set_rules('sec_index', 'Section Index', 'required');
			$this->form_validation->set_rules('section', 'Section', 'required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				$post['emp_branch']= $this->input->post('emp_branch');
				$branch = explode('@@@',$post['emp_branch']);
				if(count($branch) == 2){
					$sec_indx = isset($branch[0]) ? $branch[0] : '';
					$branch_desc = isset($branch[1]) ? $branch[1] : '';
				}	
			
				$update = array(
							'sec_index'		=> $this->input->post('sec_index', true),
							'sec_br_type'	=> $this->input->post('sec_br_type', true),
							'sec_br_group'	=> $this->input->post('sec_br_group',true),
							'section'		=> $this->input->post('section',true),
							'bo_index'		=> $sec_indx,
							'officer_nm'	=> $this->input->post('officer_nm',true),
							'upload_dt'		=> date('Y-m-d H:i:s'),
						);
				if($error == ''){
					if(!empty($id)){ // edit
						$result = $this->emp_model->updateSection($id,$update);
						$this->session->set_flashdata('success','Successfully updated.');
					}else{
						$id = $this->emp_model->addSection($update);
						$this->session->set_flashdata('success','Successfully added.');
					}
					redirect(ADMIN_BASE_URL.'administration/section');
				}
			}
		}
	
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/section_branch_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function section_branch_link(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['sections'] = $this->emp_model->get_all_sections();
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->get_admin_section_by_id($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$error = '';
		if($this->input->post()){
			$emp_section = $this->input->post('emp_section');
			$bo_index = $this->input->post('sec_index');
				$result = $this->emp_model->update_link_bo_sections($emp_section,$bo_index);
				$this->session->set_flashdata('success','Successfully updated.');
				redirect(ADMIN_BASE_URL.'administration/section_br');
		}
	
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/section_branch_link',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function section_transfer(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_transfer_master($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/administration/section_transfer';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/section_transfer',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function section_transfer_new(){
		$this->load->model('emp_model');
		/*
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		
		*/
		
		$data = $this->emp_model->get_last_transfer_order_id();
				
		if($this->input->post()){
			$ins_id= $this->input->post('trans_ord_id',true);
		}else{
			$ins_id= date('Y').date('m').$data['max_id']+1;		
			$this->db->insert('section_transfer_master',array('transf_order_id'=>$ins_id));
		}
		
		$data['employees'] = $this->emp_model->get_all_employee_list();

		$data['designation'] = array();
		foreach($data['employees'] as $val){
			if(!in_array($val['desig'],$data['designation'])){
				$data['designation'][] = $val['desig'];
			}			
		}
		$id = $ins_id;
		
		$data['row'] = array();
		$data['asign_emp'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->getTransferOrderByID($id);
			$data['asign_emp'] = $this->emp_model->getTransferOrderToEmployees($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}

		$error = '';
		if($this->input->post()){

			$this->form_validation->set_rules('trans_ord_id', 'Transfer Order Id', 'required');
			$this->emp_model->update_transfer_order_master($id);
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				$update = array(
							'trans_ord_id'		=> $this->input->post('trans_ord_id',true),
							'trans_year'	    => $this->input->post('transf_year'),
							'trans_month'	    => $this->input->post('transf_month'),
							'trans_order_no'	=> $this->input->post('transf_order_no'),
							'trans_order_dt'	=> date('Y-m-d',strtotime($this->input->post('transf_order_dt'))),
							'trans_type'	    => $this->input->post('transf_type'),
							'order_group'	    => $this->input->post('transf_group'),
							'description'	    => $this->input->post('description'),
							'update_dt'			=> date('Y-m-d H:i:s')
						);

				if(isset($_FILES['attachment']) && $_FILES['attachment']['size'][0] > 0){
					//upload file
					$upload_details = $this->common_model->upload_department_files_admin('attachment');		// upload_multiple_file
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
						redirect(ADMIN_BASE_URL.'administration/section_transfer_record');
					}else{
						$update['pdf_name'] = implode(';',$upload_details['filenames']);
					}
				}

				$autho = $this->input->post('transf_sign_autho',true);				
				$emp_concerned = $this->input->post('emp_concerned');
				$empid=key($emp_concerned);
	
				if($error == ''){
					
					if(!empty($id)){ // edit
						$this->emp_model->update_transfer_order_to_employee($id,$emp_concerned);
						$emp_tr_id = $this->emp_model->emp_section_transfer_details_record($id,$emp_concerned,$autho);
						$this->session->set_flashdata('success','Successfully updated and SMS sent.');						
					}else{ // add	
						$this->emp_model->add_transfer_order_to_employee($id,$emp_concerned);
						$emp_tr_id = $this->emp_model->emp_section_transfer_details_record($id,$emp_concerned,$autho);
						$this->session->set_flashdata('success','Successfully allotted and SMS sent.');
					}
					redirect(ADMIN_BASE_URL.'administration/section_transfer_record');
				}
			}
		}
		
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/section_transfer_assignment',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function section_transfer_assignment(){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);	
		$data['employees'] = $this->emp_model->get_all_employee_list();
		$data['designation'] = array();
		foreach($data['employees'] as $val){
			if(!in_array($val['desig'],$data['designation'])){
				$data['designation'][] = $val['desig'];
			}			
		}
		$id = $this->uri->segment(4);
		$data['row'] = array();
		$data['asign_emp'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->getTransferOrderByID($id);
			$data['asign_emp'] = $this->emp_model->getTransferOrderToEmployees($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$error = '';
		if($this->input->post()){
			$this->form_validation->set_rules('trans_ord_id', 'Transfer Order Id', 'required');
			$this->emp_model->update_transfer_order_master($id);
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				$update = array(
							'trans_ord_id'		=> $this->input->post('trans_ord_id',true),
							'trans_year'	    => $this->input->post('transf_year'),
							'trans_month'	    => $this->input->post('transf_month'),
							'trans_order_no'	=> $this->input->post('transf_order_no'),
							'trans_order_dt'	=> date('Y-m-d',strtotime($this->input->post('transf_order_dt'))),
							'trans_type'	    => $this->input->post('transf_type'),
							'order_group'	    => $this->input->post('transf_group'),
							'description'	    => $this->input->post('description'),
							'update_dt'			=> date('Y-m-d H:i:s')
						);
				if(isset($_FILES['attachment']) && $_FILES['attachment']['size'][0] > 0){
					//upload file
					$upload_details = $this->common_model->upload_department_files_admin('attachment');		// upload_multiple_file
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
						redirect(ADMIN_BASE_URL.'administration/section_transfer_record');
					}else{
						$update['pdf_name'] = implode(';',$upload_details['filenames']);
					}
				}
				$id = $this->input->post('trans_ord_id',true);
				$autho = $this->input->post('transf_sign_autho',true);
				$emp_concerned = $this->input->post('emp_concerned');
				$empid=key($emp_concerned);
				if($error == ''){
					if(!empty($id)){ // edit
						$this->emp_model->update_transfer_order_to_employee($id,$emp_concerned);
						$emp_tr_id = $this->emp_model->emp_section_transfer_details_record($id,$emp_concerned,$autho);
						$this->session->set_flashdata('success','Successfully updated and SMS sent.');						
					}else{ // add			
						$this->emp_model->add_transfer_order_to_employee($id,$emp_concerned);
						$emp_tr_id = $this->emp_model->emp_section_transfer_details_record($id,$emp_concerned,$autho);
						$this->session->set_flashdata('success','Successfully allotted and SMS sent.');
					}
					redirect(ADMIN_BASE_URL.'administration/section_transfer_record');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/section_transfer_assignment',$data);
		$this->load->view('agadmin/layout/footer');
	}
		
	public function section_transfer_record(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['transf_ids'] = $this->emp_model->get_all_transfer_ids();
		$t_id = $this->emp_model->get_max_transfer_order_id();
		$t_id = $t_id['max_id'];
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_employee_transfer_records($page_no,$t_id);
		$data['results'] = $response['results'];
		$config['base_url'] = base_url().'/admin/administration/section_transfer_record';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/section_transfer_record',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function section_transfer_record_edit(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['sections_list'] = $this->emp_model->get_all_sections();
		$data['branches'] = $this->emp_model->get_all_branches();
		$data['groups'] = array();
		foreach($data['sections_list'] as $val){
			if(!in_array($val['sec_br_group'],$data['groups'])){
				$data['groups'][] = $val['sec_br_group'];
			}			
		}
		$id = $this->uri->segment(4);
		$data['join_officers'] = $this->emp_model->get_joining_authorities();
		$data['jGroup'] = array();
		foreach($data['join_officers'] as $val){
			if(!in_array($val['group_name'],$data['jGroup'])){
				$data['jGroup'][] = $val['group_name'];
			}			
		}
	
		$data['section_list'] = $this->emp_model->get_all_section_list();
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->get_admin_transfer_details_by_id($id);
			$data['asign_emp'] = $this->emp_model->getTransferOrderToEmployees($id);  // required to update
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
		$data['section_group'] = $this->emp_model->getSectionGroupOfEmployeeByID($data['row']['emp_id']);	
		$data['relea_officers'] = $this->emp_model->get_releasing_authorities($data['section_group']['group_name']);
		
		$data['emp_section'] = $this->emp_model->getSection_of_Employees($data['row']['emp_id']);
		$data['emp_branch'] = $this->emp_model->getBranch_BO_Employees($data['row']['emp_id']);

		$error = '';
		if($this->input->post()){
			$this->form_validation->set_rules('emp_id', 'EMP ID', 'required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				
				$emp_section = $this->input->post('emp_section');
				$emp_branch = $this->input->post('emp_branch');
				$empid = $this->input->post('emp_id',true);
				$mobile = $this->input->post('mbno');
				$staff_type = $this->input->post('staff_type',true);
			if($error == ''){
					if(!empty($id)){ // edit
						/*
						if($this->input->post('charge_type')=='Additional'||$this->input->post('charge_type')=='Link'){
							$this->emp_model->add_section_to_employee($empid,$emp_section);
							$this->emp_model->add_branch_to_incharge($empid,$emp_branch);
						}else{
							$this->emp_model->update_section_to_employee($empid,$emp_section);
							$this->emp_model->update_branch_to_incharge($empid,$emp_branch);
						} */
						$this->emp_model->update_section_to_employee($empid,$emp_section);
						$this->emp_model->update_branch_to_incharge($empid,$emp_branch);
						$this->emp_model->update_transfer_order_record($id,$emp_section,$mobile);
						$emp_tr_id = $this->emp_model->emp_section_allotment_details_add($empid,$emp_section,$emp_branch,$staff_type);		//emp_section_allotment_details_update
			
	
						$this->session->set_flashdata('success','Successfully updated.');						
					}else{ // add 	
						$this->emp_model->add_section_to_employee($empid,$emp_section);
						$this->emp_model->add_branch_to_incharge($empid,$emp_branch);
						$emp_tr_id = $this->emp_model->emp_section_allotment_details_add($empid,$emp_section,$emp_branch,$staff_type);
						$this->session->set_flashdata('success','Successfully allotted.');
					}
					redirect(ADMIN_BASE_URL.'administration/section_allotment');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/section_transfer_record_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}	
	
	public function section_charge(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_employee_allotment_records($page_no);
		$data['results'] = $response['results'];
		$config['base_url'] = base_url().'/admin/administration/section_charge';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/section_charge',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function section_charge_edit(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = $this->emp_model->get_admin_allotment_details_by_id($id);
		if($this->input->post()){
			$update= array(
					'charge_from_dt'	=> date('Y-m-d',strtotime($this->input->post('charge_from_dt'))),
					'charge_to_dt'		=> date('Y-m-d',strtotime($this->input->post('charge_to_dt'))),
					'status'			=> $this->input->post('status'),
					'update_dt'			=> date('Y-m-d H:i:s')
					);
			$this->emp_model->emp_section_charge_period_update($id, $update);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'administration/section_allotment');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/section_charge_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}	
	public function all_employees_transfer(){
		$this->load->model('emp_model');
		$headings = array();
		$firstrow = array();
		$all_transfers = $this->emp_model->all_employees_trasfers('AGAE');
		if(!empty($all_transfers)){
			unset($all_transfers[0]['trans_ord_id']);
			foreach( $all_transfers[0] as $k => $v ) {
					$headings[] = strtoupper($k);
					$firstrow[] = $v;
			}
			unset($all_transfers[0]);
		}
		$excel_data[] = $headings;
		$excel_data[1] = $firstrow;
		foreach( $all_transfers as $row ) {
			unset($row['trans_ord_id']);
			$row['trans_order_dt'] = date('d-m-Y  A',strtotime($row['trans_order_dt']));
			$row['order_issue_date'] = date('d-m-Y  A',strtotime($row['order_issue_date']));
			$row['trans_release_dt'] = date('d-m-Y  A',strtotime($row['trans_release_dt']));
			$row['trans_join_dt'] = date('d-m-Y  A',strtotime($row['trans_join_dt']));
			$row['release_autho_rek_dt'] = date('d-m-Y  A',strtotime($row['release_autho_rek_dt']));
			$row['joing_autho_rek_dt'] = date('d-m-Y  A',strtotime($row['joing_autho_rek_dt']));
			$excel_data[] = $row;
		}
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Transfer of employees');
		$this->excel->getActiveSheet()->fromArray($excel_data);
		$filename='Transfer'.time().'.xls'; //save our workbook as this file name
		header('Content-Type: Training/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}
	
	public function transfer_order_download() { 
		$this->load->library('m_pdf');
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->input->post('transf_order_id');
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->get_transfer_order_print($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$data['candidates'] = $this->emp_model->get_transferred_employee_list($id);
		$html = $this->load->view('agadmin/pages/administration/transfer_order_download',$data,true);//load the pdf_output.php by passing our data and get all data in $html varriable.
		$img=FCPATH . "assets/images/top-head.png";
		$pdfFilePath ="Training_Order".time().".pdf";
		$pdf = $this->m_pdf->letterPdfCreate();
		$pdf->SetWatermarkText('O/o the Pr. Accountant General (A&E), WB');
		$pdf->watermark_font = 'DejaVuSansCondensed';
		$pdf->watermarkTextAlpha = 0.1;
		$pdf->showWatermarkText = true;
		$pdf->SetWatermarkImage($img,1,'',array(1,10));
		$pdf->watermarkImageAlpha = 1;
		$pdf->showWatermarkImage =  true;
		$pdf->WriteHTML($html);
//		$pdf->Output($pdfFilePath, "D");
		$pdf->Output();
    }
		
	public function section_allotment(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_admin_section_allotted($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/administration/section_allotment';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/section_allotment',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function section_allotment_edit(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
	
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->get_allotted_section_by_id($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}

		$error = '';
		if($this->input->post()){
				$update = array(
							'charge_type'	=> $this->input->post('charge_type',true),
							'update_dt'		=> date('Y-m-d H:i:s'),
						);
				$result = $this->emp_model->updateSectionAllotmentCharge($id,$update);
				$this->session->set_flashdata('success','Successfully updated.');
				redirect(ADMIN_BASE_URL.'administration/section_transfer_record');
		}
	
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/section_allotment_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
//******************** Initial Section assignment for BO / Section Incharge for more than one charge ******************
	
	public function section_bo_incharge(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->get_admin_branch_officer_list($page_no);	
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/administration/section_bo_incharge';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/section_bo_incharge',$data);
		$this->load->view('agadmin/layout/footer');
	}

	public function section_assignment(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
				
		$data['sections'] = $this->emp_model->get_all_sections();
		$data['branches'] = $this->emp_model->get_all_branches();
		$data['groups'] = array();
		foreach($data['sections'] as $val){
			if(!in_array($val['sec_br_group'],$data['groups'])){
				$data['groups'][] = $val['sec_br_group'];
			}			
		}

		$id = $this->uri->segment(4);
		$data['row'] = array();
		$data['emp_section'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->getBranchOfficerEmployeeByID($id);
			$data['emp_section'] = $this->emp_model->getSectionToEmployees($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}

		$error = '';
		if($this->input->post()){
			$this->form_validation->set_rules('empid', 'EMP ID', 'required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				
				$emp_section = $this->input->post('emp_section');
				$emp_branch = $this->input->post('emp_branch');
				$staff_type = $this->input->post('staff_type',true);

				if($error == ''){
					if(!empty($id)){ // edit
						$this->emp_model->update_section_to_employee($id,$emp_section);
						$this->emp_model->update_branch_to_incharge($id,$emp_branch);
						$emp_tr_id = $this->emp_model->emp_section_allotment_details_add($id,$emp_section,$emp_branch,$staff_type);		//emp_section_allotment_details_update
						$this->session->set_flashdata('success','Successfully updated.');						
					}else{ // add 	
						$this->emp_model->add_section_to_employee($id,$emp_section);
						$this->emp_model->add_branch_to_incharge($id,$emp_branch);
						$emp_tr_id = $this->emp_model->emp_section_allotment_details_add($id,$emp_section,$emp_branch,$staff_type);	
						$this->session->set_flashdata('success','Successfully allotted.');
					}
					redirect(ADMIN_BASE_URL.'administration/section_bo_incharge');
				}
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/section_assignment',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function application_passport_list(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		
		$response = $this->emp_model->get_application_passport_list($page_no);
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/administration/application_passport_list';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/application_passport_list',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function application_passport_edit(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		
		$data['employees'] = $this->emp_model->get_all_employee_list();
		$data['designation'] = array();
		foreach($data['employees'] as $val){
			if(!in_array($val['desig'],$data['designation'])){
				$data['designation'][] = $val['desig'];
			}			
		}
		
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->emp_model->get_application_passport_list_edit($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
		if($this->input->post()){
			$this->emp_model->update_application_passport_status($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'administration/application_passport_list');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/application_passport_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function application_passport_delete(){
		
		$id = $this->uri->segment(4);		
		if(!empty($id)){
			$data['row'] = $this->emp_model->getApplicationPassportByID($id);
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->emp_model->deleteApplicationPassportByID($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'administration/application_passport_list');
	}
	public function all_passport_applications(){
		$this->load->model('emp_model');
		$headings = array();
		$firstrow = array();
		$all_application = $this->emp_model->all_passport_applications_download();
		if(!empty($all_application)){
			unset($all_application[0]['pappl_id']);
			foreach( $all_application[0] as $k => $v ) {
					$headings[] = strtoupper($k);
					$firstrow[] = $v;
			}
			unset($all_application[0]);
		}
		$excel_data[] = $headings;
		$excel_data[1] = $firstrow;
		foreach( $all_application as $row ) {
			unset($row['pappl_id']);
			$row['upload_dt'] = date('d-m-Y h:i:s A',strtotime($row['upload_dt']));
			$excel_data[] = $row;
		}
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Application for Non-dept Exam');
		$this->excel->getActiveSheet()->fromArray($excel_data);
		 
		$filename='Passport_applications_'.time().'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}
	
		
	public function multi_upload(){
		$this->load->model('common_model');
		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		
		$data['row'] = array();
		
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->common_model->get_file_details();
		$data['results'] = $response['results'];
		
		$config['base_url'] = base_url().'/admin/administration/multi_upload';
		$config['total_rows'] = $response['total'];
		
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		
		if(!empty($id)){
			$data['row'] = $this->common_model->get_file_details_by_id($id,'AGAE');
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		
		$error = '';
		if($this->input->post()){
			$this->form_validation->set_rules('wing', 'Wing', 'trim|xss_clean|required');
			if ($this->form_validation->run() == FALSE){
				$this->session->set_flashdata('error',validation_errors());
			}else{
				// Add records
				$update = array(
							'wing'			=> $this->input->post('wing',true),
							'office'		=> 'AGAE',
							'upload_dt'		=> date('Y-m-d',strtotime($this->input->post('upload_dt',true))),
				);
				$error = '';
				
				if(isset($_FILES['file_name']) && $_FILES['file_name']['size'] > 0){
					//upload file
					$upload_details = $this->common_model->upload_file('file_name');
					//pload_details = $this->common_model->upload_multiple_file('file_name');
					if(!$upload_details['is_success']){
						$this->session->set_flashdata('error',$upload_details['message']);
						$error = $upload_details['message'];
					}else{
						$update['file_name'] = $upload_details['filename'];
//						$update['file_size'] =isset($_FILES['file_name']['size']);
//						$update['file_type'] =isset($_FILES['file_name']['type']);
					}
				}
				if($error == ''){
					if(!empty($id)){ // edit
						$result = $this->common_model->update_file_details($id,$update);
						$this->session->set_flashdata('success','Successfully updated.');
					}else{
						$id = $this->common_model->add_file_details($update);
						$this->session->set_flashdata('success','Successfully added.');
					}
//					redirect(ADMIN_BASE_URL.'multi_upload_files');
				}
			}
		}
		
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/multi_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	public function multi_upload_delete(){
		$this->load->model('common_model');
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->common_model->get_file_details_by_id($id);
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->common_model->delete_file_details($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'administration/multi_upload');
	}
	
	public function multi_rows_csv(){
		
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		
		
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/multi_rows_csv',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function test_ajax_upload(){
		$data['results'] = array();
		if(isset($_FILES)){
			$path = 'excel';
			$file_name = '';
			$res = $this->common_model->upload_file('file',"*",$path);
			
			if($res['is_success']){
				$file_name = $path.'/'.$res['filename'];
			}else{
				@unlink($file_name);
				$error_msg = $res['message'];
				echo json_encode($res);
				exit();
			}
			$this->load->library('spreadsheet');
			$res = $this->spreadsheet->read_file($file_name);
			if(isset($res['values']) && empty($res['values'])){
				// empty file
				$response = array(
						'is_success'	=> false,
						'message'		=> 'The file is empty'
					);
				@unlink($file_name);
				echo json_encode($response);
				exit();
			}
			$headers = array();
			$upload = array();
			
			$header_security_field =  array('SL_NO','F_YEAR','DATE','WING','DESCRIPTION','PDF_NAME');
			
			foreach($res['header'] as $key => $val){
				if(trim($val) != ''){ // remove empty cel 
					$val = strtoupper($val);
					if(in_array($val,$header_security_field)){
						$headers[$key]	= strtolower($val);
						if (($k = array_search($val, $header_security_field)) !== false) {
							unset($header_security_field[$k]);
						}
					}
				}
			}
			if(!empty($header_security_field)){
				$response = array(
							'is_success'	=> false,
							'message'		=> 'The file has extra field.'
						);
						@unlink($file_name);
						echo json_encode($response);
						exit();
			}
			$i = 0;
			foreach($res['values'] as $row => $columns){
				$up_arr = array_fill_keys($headers,"");
				foreach($columns as $key=>$val){
					if(isset($headers[$key])){ // remove empty cel 
						$up_arr[$headers[$key]]	= $val;
					}
				}
				$upload[] = $up_arr;				
			}
			$bulk_elem = 10;
			$bulk_upload = array();
			if( count($upload) > $bulk_elem ){
				$bulk_upload = array_chunk($upload,$bulk_elem);
				foreach($bulk_upload as $bulk){
					$this->db->insert_batch('exam_results',$bulk);
				}
			}else{
				$this->db->insert_batch('exam_results',$upload);
			}
			
			$db_error = $this->db->error();
			if(!empty($db_error) && $db_error['code'] != 0 && trim($db_error['message']) != ''){
				$message = $db_error['code'].' '.$db_error['message'];
				$is_success = false;
				@unlink($file_name);
			}else{
				$message = 'Successfully updated.';
				$is_success = true;
				@unlink($file_name);
			}
		}else{
			$message = 'No file selected.';
			$is_success = false;
		}
		$response = array(
						'is_success'	=> $is_success,
						'message'		=> $message
					);
		echo json_encode($response);
		exit();
	}
	
	public function hw_inventory(){
		$this->load->model('emp_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->emp_model->employee_hw_invtentory_list($page_no);
		$data['results'] = $response['results'];
		
		$data['leave_types'] = $this->emp_model->get_all_leave_types();
		
		$config['base_url'] = base_url().'/admin/administration/hw_inventory';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/hw_inventory',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function hw_inventory_edit(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
//			$data['row'] = $this->emp_model->leave_debits($id);
			if(empty($data['row'])){
				show_404('admin');
			}
		}else{
			show_404('admin');
		}
		if($this->input->post()){
			$this->emp_model->leave_application_servicebook_entry($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'administration/hw_inventory');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/hw_inventory_edit',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function hw_inventory_upload(){
		$data['results'] = array();
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/administration/hw_inventory_upload',$data);
		$this->load->view('agadmin/layout/footer');
	}

	public function hw_inventory_ajax_upload(){
		$data['results'] = array();
		if(isset($_FILES)){
			$path = 'excel';
			$file_name = '';
			$res = $this->common_model->upload_file('file',"*",$path);
			
			if($res['is_success']){
				$file_name = $path.'/'.$res['filename'];
			}else{
				@unlink($file_name);
				$error_msg = $res['message'];
				echo json_encode($res);
				exit();
			}
			$this->load->library('spreadsheet');
			$res = $this->spreadsheet->read_file($file_name);
			if(isset($res['values']) && empty($res['values'])){
				// empty file
				$response = array(
						'is_success'	=> false,
						'message'		=> 'The file is empty'
					);
				@unlink($file_name);
				echo json_encode($response);
				exit();
			}
			$headers = array();
			$upload = array();
			
			$header_security_field =  array('id','type','sub_type','categaroy','make','unique_id_no','date_of_purchase','processor','ram','hdd','hw_number','issued_to','working','date_of_issue','purpose','sec_store','placed','additional_info','amc','under_warranty','colour_bw','certifcate','office');

			foreach($res['header'] as $key => $val){
				if(trim($val) != ''){ // remove empty cell 
					$val = strtolower($val);
					if(in_array($val,$header_security_field)){
						$headers[$key]	= strtolower($val);
						if (($k = array_search($val, $header_security_field)) !== false) {
							unset($header_security_field[$k]);
						}
					}
				}
			}
			if(!empty($header_security_field)){
				$response = array(
							'is_success'	=> false,
							'message'		=> 'The file has extra field.'
						);
						@unlink($file_name);
						echo json_encode($response);
						exit();
			}
			$i = 0;
			
			foreach($res['values'] as $row => $columns){
				$up_arr = array_fill_keys($headers,"");
				foreach($columns as $key=>$val){
					if(isset($headers[$key])){ // remove empty cell 
						$up_arr[$headers[$key]]	= $val;
					}
				}
				$upload[] = $up_arr;				
			}
				//			$bulk_elem = 10;
				//			$bulk_upload = array();
				//			if( count($upload) > $bulk_elem ){
				//				$bulk_upload = array_chunk($upload,$bulk_elem);
				//				foreach($bulk_upload as $bulk){
				//					$this->db->insert_batch('emd_hw_inventory',$bulk);	
				//				}
				//			}else{
				//				$this->db->insert_batch('emd_hw_inventory',$upload);
				//			}
			foreach($upload as $record){
				$unique_id_no = isset($record['unique_id_no']) ? $record['unique_id_no'] : 0;
				if($record['office']=="BRANCH: PAG (A&E)- WEST BENGAL- KOLKATA"){
					$record['office_code'] = 'ACEN-KOL-01';
				}else{
					$record['office_code'] = 'ACEN-WB-01';
				}
				$record['upload_dt'] = date('Y-m-d H:i:s');
				// check records exists
				$res = $this->db->get_where('emd_hw_inventory',array('unique_id_no'=>$unique_id_no));
				if($res->num_rows() > 0){
					$this->db->where('unique_id_no',$unique_id_no)->update('emd_hw_inventory',$record);
				}else{
					$this->db->insert('emd_hw_inventory',$record);
				}
				
			}
			$db_error = $this->db->error();
			if(!empty($db_error) && $db_error['code'] != 0 && trim($db_error['message']) != ''){
				$message = $db_error['code'].' '.$db_error['message'];
				$is_success = false;
				@unlink($file_name);
			}else{
				$message = 'Successfully updated.';
				$is_success = true;
				@unlink($file_name);
			}
		}else{
			$message = 'No file selected.';
			$is_success = false;
		}
		$response = array(
						'is_success'	=> $is_success,
						'message'		=> $message
					);
		echo json_encode($response);
		exit();
	}
	
	
} // End of Class