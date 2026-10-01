<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grievance extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('common_model');
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
		if($this->admin_type == 'grievance' || $this->admin_type == 'superadmin'){
			
		}else{
			show_404();
		}
	}
	public function index(){
		$data['results'] = array();
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/grievance',$data);
		$this->load->view('agadmin/layout/footer');
	}	
	
	public function feedback(){
		$this->load->model('common_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->common_model->all_feedback($page_no);
		$data['results'] = $response['results'];
		
		$data['all_groups'] = $this->common_model->get_all_groups();
		
		$config['base_url'] = base_url().'/admin/grievance/feedback';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/grievance/feedback',$data);
		$this->load->view('agadmin/layout/footer');
	}

	public function feedback_review(){
		$this->load->model('common_model');
		$this->load->library('pagination');
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
			redirect(ADMIN_BASE_URL.'grievance/feedback');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/grievance/feedback_review',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function admin_feedback_close(){
		$this->load->model('emp_model');
		$id = $this->uri->segment(4);
		echo $id;
		if(!empty($id)){
			$this->emp_model->FeedbackClosedByID($id);
			$this->session->set_flashdata('success','The Grievance / feedback is closed successfully.');
		}
		redirect(ADMIN_BASE_URL.'grievance/feedback');
	}
//------------feedback		
	public function feedback_gen(){
		$this->load->model('common_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->common_model->all_general_feedback($page_no);
		$data['results'] = $response['results'];
		
		$data['all_groups'] = $this->common_model->get_all_groups();
		
		$config['base_url'] = base_url().'/admin/grievance/feedback_gen';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/grievance/feedback_gen',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function feedback_admn(){
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
		
		$config['base_url'] = base_url().'/admin/grievance/feedback_admn';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/grievance/feedback_admn',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function feedback_acs(){
		$this->load->model('common_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->common_model->all_accounts_feedback($page_no);
		$data['results'] = $response['results'];
		
		$data['all_groups'] = $this->common_model->get_all_groups();
		
		$config['base_url'] = base_url().'/admin/grievance/feedback_acs';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/grievance/feedback_acs',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function feedback_fnd(){
		$this->load->model('common_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->common_model->all_fund_feedback($page_no);		
//echo $this->db->last_query();
		$data['results'] = $response['results'];
		
		$data['all_groups'] = $this->common_model->get_all_groups();
		
		$config['base_url'] = base_url().'/admin/grievance/feedback_fnd';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/grievance/feedback_fnd',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function feedback_pen(){
		$this->load->model('common_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->common_model->all_pension_feedback($page_no);
		$data['results'] = $response['results'];
		
		$data['all_groups'] = $this->common_model->get_all_groups();
		
		$config['base_url'] = base_url().'/admin/grievance/feedback_pen';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/grievance/feedback_pen',$data);
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
			$this->common_model->update_fund_feedback_action($id);
			$this->session->set_flashdata('success','Successfully updated.');
			redirect(ADMIN_BASE_URL.'grievance/feedback');
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/grievance/feedback_action',$data);
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
		 
		$filename='Feedbacks_'.time().'.xls'; //save our workbook as this file name
		header('Content-Type: Feednacl/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}
	public function feedback_griev(){
		$this->load->model('common_model');
		$this->load->library('pagination');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$page_no = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->common_model->all_grievance_records($page_no);
		$data['results'] = $response['results'];
		
		$data['all_groups'] = $this->common_model->get_all_groups();
		
		$config['base_url'] = base_url().'/admin/grievance/feedback_griev';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/grievance/feedback_griev',$data);
		$this->load->view('agadmin/layout/footer');
	}

	public function grievance_add(){
		$this->load->model('emp_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['section_list'] = $this->emp_model->get_all_sections();

		$id = $this->uri->segment(4);
		
		if($this->input->post()){
			$this->emp_model->add_new_grievance();
			$this->session->set_flashdata('success','Added successfully.');
			redirect(ADMIN_BASE_URL.'grievance/grievance_add');
		}

		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/grievance/grievance_add',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function grievance_edit(){
		$this->load->model('emp_model');
		$this->load->model('common_model');
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$data['section_list'] = $this->emp_model->get_all_sections();
		$id = $this->uri->segment(4);
		$data['row'] = $this->common_model->feedback_details($id);
		
		if($this->input->post()){
			if (!empty($id)){
				$this->emp_model->update_new_grievance($id);
				echo $this->db->last_query();
				$this->session->set_flashdata('success','Updated successfully.');
				redirect(ADMIN_BASE_URL.'grievance/feedback_griev');
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/grievance/grievance_add',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
	
} // End of Class