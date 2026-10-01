<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Feedback extends CI_Controller {
	function __construct() {
        parent::__construct();
		$this->load->model('common_model');
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
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		if($this->admin_type == "g&ssa" || $this->admin_type == "e&rsa"){
			show_404();
		}
		$this->load->library('pagination');
		$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->common_model->get_all_feeedback($limit_to);
//echo $this->db->last_query();
//print_r ($data['total']['retn_total']);	
//exit;		
		$data['results'] = $response['results'];
		
		$config['base_url'] = ADMIN_BASE_URL.'feedback';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/feedback/list',$data);
		$this->load->view('agadmin/layout/footer');
	}

	public function update($id=''){
		if($this->admin_type == "g&ssa" || $this->admin_type == "e&rsa"){
			show_404();
		}
		$visit_for = $this->input->post('visit_for',true);
		$this->db->where('feed_id',$id)->update('feedback',array('visit_for'=>$visit_for));
		$res = array('msg'=>'Successfully updated');
		echo json_encode($res);
	}
	public function delete(){
		if($this->admin_type == "g&ssa" || $this->admin_type == "e&rsa"){
			show_404();
		}
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->common_model->get_feedback_by_id($id);
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->common_model->delete_feedback($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'feedback');
	}
	public function aggssa(){
		if($this->admin_type != "g&ssa" && $this->admin_type != "superadmin"){
			show_404();
		}
		$this->load->library('pagination');
		$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->common_model->get_all_feeedback($limit_to,'AGGSSA');
		$data['results'] = $response['results'];
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$config['base_url'] = ADMIN_BASE_URL.'feedback/aggssa';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/feedback/aggssa',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function aggssa_update($id=''){
		if($this->admin_type != "g&ssa" && $this->admin_type != "superadmin"){
			show_404();
		}
		$visit_for = $this->input->post('visit_for',true);
		$this->db->where('feed_id',$id)->update('feedback',array('visit_for'=>$visit_for));
		$res = array('msg'=>'Successfully updated');
		echo json_encode($res);
	}
	public function aggssa_delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->common_model->get_feedback_by_id($id,'AGGSSA');
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->common_model->delete_feedback($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'feedback/aggssa');
	}
	public function agersa(){
		if($this->admin_type != "e&rsa" && $this->admin_type != "superadmin"){
			show_404();
		}
		$this->load->library('pagination');
		$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->common_model->get_all_feeedback($limit_to,'AGERSA');
		$data['results'] = $response['results'];
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$config['base_url'] = ADMIN_BASE_URL.'feedback/agersa';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/feedback/agersa',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function agersa_update($id=''){
		if($this->admin_type != "e&rsa" && $this->admin_type != "superadmin"){
			show_404();
		}
		$visit_for = $this->input->post('visit_for',true);
		$this->db->where('feed_id',$id)->update('feedback',array('visit_for'=>$visit_for));
		$res = array('msg'=>'Successfully updated');
		echo json_encode($res);
	}
	public function agersa_delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->common_model->get_feedback_by_id($id,'AGERSA');
			if(empty($data['row'])){
				show_404('admin');
			}else{
				$this->common_model->delete_feedback($id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'feedback/agersa');
	}
	
	public function all_feedback_status(){
		$this->load->model('common_model');
		$headings = array();
		$firstrow = array();
		$all_application = $this->common_model->all_feedback_download();
		if(!empty($all_application)){
			unset($all_application[0]['feed_id']);
			foreach( $all_application[0] as $k => $v ) {
					$headings[] = strtoupper($k);
					$firstrow[] = $v;
			}
			unset($all_application[0]);
		}
		$excel_data[] = $headings;
		$excel_data[1] = $firstrow;
		foreach( $all_application as $row ) {
			unset($row['feed_id']);
			$row['feed_date'] = date('d-m-Y h:i:s A',strtotime($row['feed_date']));
			$excel_data[] = $row;
		}
		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Application of employees');
		$this->excel->getActiveSheet()->fromArray($excel_data);
		 
		$filename='Feedback_status'.time().'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache
					
		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5'); 
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');
	}
	public function admin_feedback_close(){
		$this->load->model('emp_model');
		$id = $this->uri->segment(4);
		echo $id;
		if(!empty($id)){
			$this->emp_model->FeedbackClosedByID($id);
			$this->session->set_flashdata('success','The Grievance / feedback is closed successfully.');
		}
		redirect(ADMIN_BASE_URL.'/feedback_active');
	}
	
	public function feedback_active(){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		if($this->admin_type == "g&ssa" || $this->admin_type == "e&rsa"){
			show_404();
		}
		$this->load->library('pagination');
		$limit_to = $this->input->get('per_page') ? intval($this->input->get('per_page',true)) : 0;
		$response = $this->common_model->get_all_active_feeedback($limit_to);
		$data['results'] = $response['results'];
		
		$config['base_url'] = ADMIN_BASE_URL.'feedback_active';
		$config['total_rows'] = $response['total'];
		$config['per_page'] = ADMIN_PAGINATION_DATA_PER_PAGE;
		$this->pagination->initialize($config);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/feedback/feedback_active',$data);
		$this->load->view('agadmin/layout/footer');
	}
	
} // End of Class
