<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Office extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('common_model');
		$this->load->model('page_model');
		$this->load->library('form_validation');
		$this->admin = '';
		if($this->session->userdata('admin_details')){
			$this->admin = $this->session->userdata('admin_details');
		}else{
			show_404();
		}
	}
	public function index(){
		$data['results'] = $this->page_model->getAllPages();
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/pages_list',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function ag_ae(){
		$data['wing'] = '';
		if(strtolower($this->session->userdata('admin_type')) != 'administration'){
			$wing = strtolower($this->session->userdata('admin_type'));
			$results = $this->common_model->getOfficeMenu('AGAE',$wing);
		}else{
			$results = $this->common_model->getOfficeMenu('AGAE');
		}
		$data['results'] = array();
		$data['sub'] = array();
		foreach($results as $row){
			if($row['sub_menu_id'] > 0){
				$data['sub'][$row['sub_menu_id']][] = $row;
				//$data['results'][$row['office_menu_id']]['sub'][] = $row;
			}else{
				$data['results'][$row['office_menu_id']] = $row;
			}
		}
		/*foreach($data['results'] as $k=>$r){
			if(isset($data['sub'][$r['']]))
			$data['results'][$k]['sub'] = 
		}*/
		//echo '<pre>';
		//print_r($data);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/office_menu',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function ag_ae_add(){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$results = $this->common_model->getOfficeMenu('AGAE');
		$data['pages'] = $this->page_model->getAllPages();
		$data['results'] = array();
		$data['sub'] = array();
		foreach($results as $row){
			if($row['sub_menu_id'] > 0){
				$data['sub'][$row['sub_menu_id']][] = $row;
			}else{
				$data['results'][$row['office_menu_id']] = $row;
			}
		}
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->common_model->getOfficeMenuById('AGAE',$id);
			$menu_details = $this->common_model->getOfficeMenuDetailsById('AGAE',$id);
			$data['menu_details'] = array();
			foreach($menu_details as $menu){
				$data['menu_details'][$menu['language_id']] = $menu;
			}
			if(empty($data['row'])){
				show_404('admin');
			}
		}
		$data['lang'] = $this->common_model->getAllLang();
		if($this->input->post()){
			$this->form_validation->set_rules('menu_name', 'Menu Name', 'required');
			//$this->form_validation->set_rules('status', 'Status', 'required');
			if ($this->form_validation->run() == FALSE){
				//$this->session->set_flashdata('error',validation_errors());
			}else{
				// Add records
				if(strtolower($this->session->userdata('admin_type')) != 'administration'){
					$wing = strtolower($this->session->userdata('admin_type'));
				}else{
					$wing = $this->input->post('wing');
				}
				$update = array(
							'menu_name'		=> $this->input->post('menu_name'),
							'office_code'	=> 'AGAE',
							'wing'			=> $wing,
							'sub_menu_id'	=> $this->input->post('sub_menu_id'),
							'page_id'		=> $this->input->post('page_id'),
							'sort'			=> $this->input->post('sort'),
				);
				$update_lang = $this->input->post('lang');
				$page_details = array();
				foreach($update_lang as $lang_id=>$l){
					$page_details[$lang_id] = array(
										'language_id'		=> $lang_id,
										'display_name'		=> $l['display_name']
									);
				}
				if(!empty($id)){ // edit
					if($this->input->post('wing')){
						$update['wing'] = $this->input->post('wing');
					}
					$result = $this->common_model->updateMenu($id,$update);
					foreach($page_details as $language_id=>$page){
						$page['office_menu_id'] = $id;
						$result = $this->common_model->updateMenuDetails($id,$language_id,$page);
					}
					$this->session->set_flashdata('success','Successfully updated.');
				}else{
					$update['wing'] = $wing;
					$id = $this->common_model->addMenu($update);
					foreach($page_details as $page){
						$page['office_menu_id'] = $id;
						$result = $this->common_model->addMenuDetails($page);
					}
					$this->session->set_flashdata('success','Successfully added.');
				}
				
				redirect(ADMIN_BASE_URL.'office/ag-ae');
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/office_menu_add',$data);
		$this->load->view('agadmin/layout/footer');
	}
	 function pageurl_check($str){
		$id = $this->uri->segment(4);
		if($id){ // edit
			$res = $this->db->get_where('page',array('page_url'=>$str,'page_id !='=>$id));
			if($res->num_rows() > 0){
			 	$this->form_validation->set_message('pageurl_check', $str.' already exists! use another.');
          		return FALSE;
			}else{
				return true;
			}
		}else{
			$res = $this->db->get_where('page',array('page_url'=>$str));
			if($res->num_rows() > 0){
			 	$this->form_validation->set_message('pageurl_check', $str.' already exists! use another.');
          		return FALSE;
			}else{
				return true;
			}
		}
		
	}
	public function ag_ae_delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->common_model->getOfficeMenuById('AGAE',$id);
			if(empty($data['row'])){
				show_404('admin');
			}else{
				 $this->common_model->deleteOfficeMenuById('AGAE',$id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'office/ag-ae');
	}
	
	public function check_url_exists(){
		$id = $this->uri->segment(4);
		$str = $this->input->get('url');
		$status =  FALSE;
		if($id){ // edit
			$res = $this->db->get_where('page',array('page_url'=>$str,'page_id !='=>$id));
			if($res->num_rows() > 0){
          		$status =  TRUE;
			}else{
				$status =  FALSE;;
			}
		}else{
			$res = $this->db->get_where('page',array('page_url'=>$str));
			if($res->num_rows() > 0){
          		$status =  TRUE;;
			}else{
				$status =  FALSE;;
			}
		}
		echo json_encode(array('status'=>$status));
	}
	
} // End of Class
