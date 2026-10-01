<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {
	function __construct() {
        parent::__construct();
        $this->load->model('menu_model');
		$this->load->model('page_model');
		$this->load->library('form_validation');
		$this->load->helper('security');	
		$this->admin = '';
		if($this->session->userdata('admin_details')){
			$this->admin = $this->session->userdata('admin_details');
		}else{
			redirect('admin');
		}
	}
	public function index(){
		$data = arary();
		//$data['results'] = $this->page_model->getAdminAllPageList();
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/pages_list',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function ag_ae(){
		$data['wing'] = '';
		if(strtolower($this->session->userdata('admin_type')) != 'superadmin'){
			$wing = strtolower($this->session->userdata('admin_type'));
			$results = $this->menu_model->getOfficeMenu_admin('AGAE',$wing);
		}else{
			$results = $this->menu_model->getOfficeMenu_admin('AGAE');
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
		$this->load->view('agadmin/pages/menu/ae_menu',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function ag_ae_add(){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$results = $this->menu_model->getOfficeMenu('AGAE');
		$data['pages'] = $this->page_model->getAdminAllPageList();
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
			$data['row'] = $this->menu_model->getOfficeMenuById('AGAE',$id);
			$menu_details = $this->menu_model->getOfficeMenuDetailsById('AGAE',$id);
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
			$this->form_validation->set_rules('menu_name', 'Menu Name', 'trim|xss_clean|required');
			//$this->form_validation->set_rules('status', 'Status', 'required');
			if ($this->form_validation->run() == FALSE){
				//$this->session->set_flashdata('error',validation_errors());
			}else{
				// Add records
				if(strtolower($this->session->userdata('admin_type')) != 'superadmin'){
					$wing = strtolower($this->session->userdata('admin_type'));
				}else{
					$wing = $this->input->post('wing',true);
				}
				$update = array(
							'menu_name'		=> $this->input->post('menu_name',true),
							'office_code'	=> 'AGAE',
							'wing'			=> $wing,
							'sub_menu_id'	=> $this->input->post('sub_menu_id',true),
							'page_id'		=> $this->input->post('page_id',true),
							'url_link'		=> $this->input->post('url_link',true),
							'sort'			=> $this->input->post('sort',true),
							'status'			=> $this->input->post('status',true),
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
						$update['wing'] = $this->input->post('wing',true);
					}
					$result = $this->menu_model->updateOfficeMenu($id,$update);
					foreach($page_details as $language_id=>$page){
						$page['office_menu_id'] = $id;
						$result = $this->menu_model->updateOfficeMenuDetails($id,$language_id,$page);
					}
					$this->session->set_flashdata('success','Successfully updated.');
				}else{
					$update['wing'] = $wing;
					$id = $this->menu_model->addOfficeMenu($update);
					foreach($page_details as $page){
						$page['office_menu_id'] = $id;
						$result = $this->menu_model->addOfficeMenuDetails($page);
					}
					$this->session->set_flashdata('success','Successfully added.');
				}
				
				redirect(ADMIN_BASE_URL.'menu/ag-ae');
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/menu/ae_menu_add',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function ag_ae_delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->menu_model->getOfficeMenuById('AGAE',$id);
			if(empty($data['row'])){
				show_404('admin');
			}else{
				 $this->menu_model->deleteOfficeMenuById('AGAE',$id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'menu/ag-ae');
	}
	
	public function ag_gssa(){
		$data['wing'] = '';
		$results = $this->menu_model->getOfficeMenu_admin('AGGSSA');
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
		$this->load->view('agadmin/pages/menu/gssa_menu',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function ag_gssa_add(){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$results = $this->menu_model->getOfficeMenu('AGGSSA');
		$data['pages'] = $this->page_model->getAdminAllPageList('G&SSA','AGGSSA');
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
			$data['row'] = $this->menu_model->getOfficeMenuById('AGGSSA',$id);
			$menu_details = $this->menu_model->getOfficeMenuDetailsById('AGGSSA',$id);
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
			$this->form_validation->set_rules('menu_name', 'Menu Name', 'trim|xss_clean|required');
			//$this->form_validation->set_rules('status', 'Status', 'required');
			if ($this->form_validation->run() == FALSE){
				//$this->session->set_flashdata('error',validation_errors());
			}else{
				// Add records
				$wing = 'G&SSA';
				$update = array(
							'menu_name'		=> $this->input->post('menu_name',true),
							'office_code'	=> 'AGGSSA',
							'wing'			=> $wing,
							'sub_menu_id'	=> $this->input->post('sub_menu_id',true),
							'page_id'		=> $this->input->post('page_id',true),
							'url_link'		=> $this->input->post('url_link',true),
							'sort'			=> $this->input->post('sort',true),
							'status'			=> $this->input->post('status',true),
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
					$result = $this->menu_model->updateOfficeMenu($id,$update);
					foreach($page_details as $language_id=>$page){
						$page['office_menu_id'] = $id;
						$result = $this->menu_model->updateOfficeMenuDetails($id,$language_id,$page);
					}
					$this->session->set_flashdata('success','Successfully updated.');
				}else{
					$id = $this->menu_model->addOfficeMenu($update);
					foreach($page_details as $page){
						$page['office_menu_id'] = $id;
						$result = $this->menu_model->addOfficeMenuDetails($page);
					}
					$this->session->set_flashdata('success','Successfully added.');
				}
				
				redirect(ADMIN_BASE_URL.'menu/ag-gssa');
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/menu/gssa_menu_add',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function ag_gssa_delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->menu_model->getOfficeMenuById('AGGSSA',$id);
			if(empty($data['row'])){
				show_404('admin');
			}else{
				 $this->menu_model->deleteOfficeMenuById('AGGSSA',$id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'menu/ag-gssa');
	}
	
	public function ag_ersa(){
		$data['wing'] = '';
		$results = $this->menu_model->getOfficeMenu_admin('AGERSA');
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
		$this->load->view('agadmin/pages/menu/ersa_menu',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function ag_ersa_add(){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$results = $this->menu_model->getOfficeMenu('AGERSA');
		$data['pages'] = $this->page_model->getAdminAllPageList('E&RSA','AGERSA');
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
			$data['row'] = $this->menu_model->getOfficeMenuById('AGERSA',$id);
			$menu_details = $this->menu_model->getOfficeMenuDetailsById('AGERSA',$id);
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
			$this->form_validation->set_rules('menu_name', 'Menu Name', 'trim|xss_clean|required');
			//$this->form_validation->set_rules('status', 'Status', 'required');
			if ($this->form_validation->run() == FALSE){
				//$this->session->set_flashdata('error',validation_errors());
			}else{
				// Add records
				$wing = 'E&RSA';
				$update = array(
							'menu_name'		=> $this->input->post('menu_name',true),
							'office_code'	=> 'AGERSA',
							'wing'			=> $wing,
							'sub_menu_id'	=> $this->input->post('sub_menu_id',true),
							'page_id'		=> $this->input->post('page_id',true),
							'url_link'		=> $this->input->post('url_link',true),
							'sort'			=> $this->input->post('sort',true),
							'status'		=> $this->input->post('status',true),
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
					$result = $this->menu_model->updateOfficeMenu($id,$update);
					foreach($page_details as $language_id=>$page){
						$page['office_menu_id'] = $id;
						$result = $this->menu_model->updateOfficeMenuDetails($id,$language_id,$page);
					}
					$this->session->set_flashdata('success','Successfully updated.');
				}else{
					$id = $this->menu_model->addOfficeMenu($update);
					foreach($page_details as $page){
						$page['office_menu_id'] = $id;
						$result = $this->menu_model->addOfficeMenuDetails($page);
					}
					$this->session->set_flashdata('success','Successfully added.');
				}
				
				redirect(ADMIN_BASE_URL.'menu/ag-ersa');
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/menu/ersa_menu_add',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function ag_ersa_delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->menu_model->getOfficeMenuById('AGERSA',$id);
			if(empty($data['row'])){
				show_404('admin');
			}else{
				 $this->menu_model->deleteOfficeMenuById('AGERSA',$id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'menu/ag-ersa');
	}
	
	public function tender_notice(){
		$results = $this->menu_model->getTenderNoticeMenu_admin();
		$data['results'] = array();
		$data['sub'] = array();
		foreach($results as $row){
			if($row['sub_menu_id'] > 0){
				$data['sub'][$row['sub_menu_id']][] = $row;
				//$data['results'][$row['office_menu_id']]['sub'][] = $row;
			}else{
				$data['results'][$row['menu_id']] = $row;
			}
		}
		/*foreach($data['results'] as $k=>$r){
			if(isset($data['sub'][$r['']]))
			$data['results'][$k]['sub'] = 
		}*/
		//echo '<pre>';
		//print_r($data);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/menu/tender_notice_menu',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function tender_notice_add(){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$results = $this->menu_model->getTenderNoticeMenu_admin();
		$data['pages'] = $this->page_model->getAdminAllPageList();
		$data['results'] = array();
		$data['sub'] = array();
		foreach($results as $row){
			if($row['sub_menu_id'] > 0){
				$data['sub'][$row['sub_menu_id']][] = $row;
			}else{
				$data['results'][$row['menu_id']] = $row;
			}
		}
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->menu_model->getMenuById('tender_notice',$id);
			$menu_details = $this->menu_model->getMenuDetailsById('tender_notice',$id);
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
			$this->form_validation->set_rules('menu_name', 'Menu Name', 'trim|xss_clean|required');
			//$this->form_validation->set_rules('status', 'Status', 'required');
			if ($this->form_validation->run() == FALSE){
				//$this->session->set_flashdata('error',validation_errors());
			}else{
				// Add records
				
				$update = array(
							'menu_name'		=> $this->input->post('menu_name',true),
							'office_code'	=> 'tender_notice',
							'sub_menu_id'	=> $this->input->post('sub_menu_id',true),
							'page_id'		=> $this->input->post('page_id',true),
							'url_link'		=> $this->input->post('url_link',true),
							'sort'			=> $this->input->post('sort',true),
							'status'		=> $this->input->post('status',true),
				);
				$update_lang = $this->input->post('lang',true);
				$page_details = array();
				foreach($update_lang as $lang_id=>$l){
					$page_details[$lang_id] = array(
										'language_id'		=> $lang_id,
										'display_name'		=> $l['display_name']
									);
				}
				if(!empty($id)){ // edit
					$result = $this->menu_model->updateMenu($id,$update);
					foreach($page_details as $language_id=>$page){
						$page['menu_id'] = $id;
						$result = $this->menu_model->updateMenuDetails($id,$language_id,$page);
					}
					$this->session->set_flashdata('success','Successfully updated.');
				}else{
					$id = $this->menu_model->addMenu($update);
					foreach($page_details as $page){
						$page['menu_id'] = $id;
						$result = $this->menu_model->addMenuDetails($page);
					}
					$this->session->set_flashdata('success','Successfully added.');
				}
				
				redirect(ADMIN_BASE_URL.'menu/tender-notice');
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/menu/tender_notice_add',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function tender_notice_delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->menu_model->getMenuById('tender_notice',$id);
			if(empty($data['row'])){
				show_404('admin');
			}else{
				 $this->menu_model->deleteMenuById('tender_notice',$id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'menu/tender-notice');
	}
	
	public function contact_us(){
		$results = $this->menu_model->getContactUsMenu_admin();
		$data['results'] = array();
		$data['sub'] = array();
		foreach($results as $row){
			if($row['sub_menu_id'] > 0){
				$data['sub'][$row['sub_menu_id']][] = $row;
				//$data['results'][$row['office_menu_id']]['sub'][] = $row;
			}else{
				$data['results'][$row['menu_id']] = $row;
			}
		}
		/*foreach($data['results'] as $k=>$r){
			if(isset($data['sub'][$r['']]))
			$data['results'][$k]['sub'] = 
		}*/
		//echo '<pre>';
		//print_r($data);
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/menu/contact_us_menu',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function contact_us_add(){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		$results = $this->menu_model->getContactUsMenu_admin();
		$data['pages'] = $this->page_model->getAdminAllContactAllOffice();
		$data['results'] = array();
		$data['sub'] = array();
		foreach($results as $row){
			if($row['sub_menu_id'] > 0){
				$data['sub'][$row['sub_menu_id']][] = $row;
			}else{
				$data['results'][$row['menu_id']] = $row;
			}
		}
		$id = $this->uri->segment(4);
		$data['row'] = array();
		if(!empty($id)){
			$data['row'] = $this->menu_model->getMenuById('contact_us',$id);
			$menu_details = $this->menu_model->getMenuDetailsById('contact_us',$id);
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
			$this->form_validation->set_rules('menu_name', 'Menu Name', 'trim|xss_clean|required');
			//$this->form_validation->set_rules('status', 'Status', 'required');
			if ($this->form_validation->run() == FALSE){
				//$this->session->set_flashdata('error',validation_errors());
			}else{
				// Add records
				
				$update = array(
							'menu_name'		=> $this->input->post('menu_name',true),
							'office_code'	=> 'contact_us',
							'sub_menu_id'	=> $this->input->post('sub_menu_id',true),
							'page_id'		=> $this->input->post('page_id',true),
							'url_link'		=> $this->input->post('url_link',true),
							'sort'			=> $this->input->post('sort',true),
							'status'		=> $this->input->post('status',true),
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
					$result = $this->menu_model->updateMenu($id,$update);
					foreach($page_details as $language_id=>$page){
						$page['menu_id'] = $id;
						$result = $this->menu_model->updateMenuDetails($id,$language_id,$page);
					}
					$this->session->set_flashdata('success','Successfully updated.');
				}else{
					$id = $this->menu_model->addMenu($update);
					foreach($page_details as $page){
						$page['menu_id'] = $id;
						$result = $this->menu_model->addMenuDetails($page);
					}
					$this->session->set_flashdata('success','Successfully added.');
				}
				
				redirect(ADMIN_BASE_URL.'menu/contact-us');
			}
		}
		$this->load->view('agadmin/layout/header');
		$this->load->view('agadmin/pages/menu/contact_us_add',$data);
		$this->load->view('agadmin/layout/footer');
	}
	public function contact_us_delete(){
		$id = $this->uri->segment(4);
		if(!empty($id)){
			$data['row'] = $this->menu_model->getMenuById('contact_us',$id);
			if(empty($data['row'])){
				show_404('admin');
			}else{
				 $this->menu_model->deleteMenuById('contact_us',$id);
			}
			$this->session->set_flashdata('success','Successfully deleted.');
		}
		redirect(ADMIN_BASE_URL.'menu/contact-us');
	}
	
	public function pageurl_check($str){
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
