<?php
class Page_model extends CI_Model {

function __construct(){
    parent::__construct();
	if($this->session->userdata('language_id')){
		$this->language_id = $this->session->userdata('language_id');
	}else{
		$this->language_id = 1;
	}
}
public function getAdminAllContactAllOffice(){
    $results  = $this->db->select('*')
						 ->from('page')
						 ->order_by('page_id','desc')
						 ->get()
						 ->result_array();
	return $results;
}
public function getAdminAllPageList($wing = '',$page_office_code = 'AGAE'){
   	$this->db->select('*')
				 ->from('page')
				 ->order_by('page_id','desc');
	if($wing != ''){
		$this->db->where('wing',$wing);
	}
	$this->db->where('page_office_code',$page_office_code);
	$this->db->order_by('page_id','desc');
	$results = $this->db->get()
						->result_array();
	return $results;
}
public function getAdminAllPages($limit_to=0){
	$get = $this->input->get(array('search', 'wing'), TRUE);
   	$this->db->select('*')
				 ->from('page')
				 ->order_by('updated_on','desc');
	if($get['wing'] != ''&& strtolower($get['wing']) != 'all'){
		$this->db->where('wing',$get['wing']);
	}
	$this->db->where('page_office_code','AGAE');
	if($get['search'] != ''){
		$this->db->group_start();
			$this->db->like('page_name',$get['search']);
			$this->db->or_like('page_url',$get['search']);
		$this->db->group_end();
	}
	$this->db->order_by('page_id','desc');
	$total_records = $this->db->count_all_results('', FALSE);
	$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
						->get()
						->result_array();
	return array('total'=>$total_records,'results'=>$results);
}
public function getFooterPages($limit_to=0){
	$get = $this->input->get(array('search'), TRUE);
   	$this->db->select('*')
				 ->from('page_common_cms')
				 ->order_by('sort');
	if($get['search'] != ''){
		$this->db->group_start();
			$this->db->like('page_name',$get['search']);
			$this->db->or_like('page_url',$get['search']);
		$this->db->group_end();
	}
	$this->db->order_by('page_id','desc');
	$total_records = $this->db->count_all_results('', FALSE);
	$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
						->get()
						->result_array();
	return array('total'=>$total_records,'results'=>$results);
}
public function getAdminOfficePages($office='',$limit_to=0){
	$get = $this->input->get(array('search'), TRUE);
   	$this->db->select('*')
				 ->from('page')
				 ->order_by('updated_on','desc');
	$this->db->where('page_office_code',$office);
	if($get['search'] != ''){
		$this->db->group_start();
			$this->db->like('page_name',$get['search']);
			$this->db->or_like('page_url',$get['search']);
		$this->db->group_end();
	}
	$this->db->order_by('page_id','desc');
	$total_records = $this->db->count_all_results('', FALSE);
	$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
						->get()
						->result_array();
	return array('total'=>$total_records,'results'=>$results);
}
public function getAdminWingAllPages($limit_to=0,$admin_wing = ''){
	$get = $this->input->get(array('search'), TRUE);
   	$this->db->select('*')
				 ->from('page')
				 ->order_by('page_id','desc');
	if($admin_wing != ''){
		$this->db->group_start();
			$this->db->where('wing',$admin_wing);
			$this->db->or_where('wing','all');
		$this->db->group_end();
	}
	if($get['search'] != ''){
		$this->db->group_start();
			$this->db->like('page_name',$get['search']);
			$this->db->or_like('page_url',$get['search']);
		$this->db->group_end();
	}
	$this->db->where('page_office_code','AGAE');
	$this->db->order_by('page_id','desc');
	$total_records = $this->db->count_all_results('', FALSE);
	$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
						->get()
						->result_array();
	return array('total'=>$total_records,'results'=>$results);
}

public function getAllPagesByWing($wing=''){
    $res = $this->db->select('*')
					->from('page');
	if(strtolower($wing) == 'accounts'){
		$res = $this->db->where('wing','accounts');
	}else if(strtolower($wing) == 'fund'){
		$res = $this->db->where('wing','fund');
	}
	else if(strtolower($wing) == 'pension'){
		$res = $this->db->where('wing','pension');
	}else{
		//$wing = admin
	}
	$res = $this->db->order_by('page_id','desc')
					->get()					
					->result_array();
	return $res;
}

public function getPageById($id = ''){
    $res = $this->db->select('*')
					->from('page')
					->where('page_id',$id)
					->get()
					->row_array();
	return $res;
}
public function getFooterPageById($id = ''){
    $res = $this->db->select('*')
					->from('page_common_cms')
					->where('page_id',$id)
					->get()
					->row_array();
	return $res;
}

public function getPageDetailsById($id = ''){
    $res = $this->db->select('*')
					->from('page_details')
					->where('page_id',$id)
					->get()
					->result_array();
	return $res;
}
public function getFooterPageDetailsById($id = ''){
    $res = $this->db->select('*')
					->from('page_details_common_cms')
					->where('page_id',$id)
					->get()
					->result_array();
	return $res;
}

public function addPage($update_data = array()){
    $res = $this->db->insert('page',$update_data);
	$id = $this->db->insert_id();
	return $id;
}
public function addFooterPage($update_data = array()){
    $res = $this->db->insert('page_common_cms',$update_data);
	$id = $this->db->insert_id();
	return $id;
}

public function addPageDetails($update_data = array()){
    $res = $this->db->insert('page_details',$update_data);
	$id = $this->db->insert_id();
	return $id;
}
public function addFooterPageDetails($update_data = array()){
    $res = $this->db->insert('page_details_common_cms',$update_data);
	$id = $this->db->insert_id();
	return $id;
}

public function updatePage($id='', $update_data = array()){
    $res = $this->db->where('page_id',$id)->update('page',$update_data);
	return $id;
}
public function updateFooterPage($id='', $update_data = array()){
    $res = $this->db->where('page_id',$id)->update('page_common_cms',$update_data);
	return $id;
}

public function updatePageDetails($id='', $language_id = '', $update_data = array()){
	//check is exists
	//$res = $this->db->get_where('page_details',array('page_id'=>$id,'language_id'=>$language_id));
		$res = $this->db->where('page_id',$id)->where('language_id',$language_id)->update('page_details',$update_data);
	return ;
}
public function updateFooterPageDetails($id='', $language_id = '', $update_data = array()){
		$res = $this->db->where('page_id',$id)->where('language_id',$language_id)->update('page_details_common_cms',$update_data);
	return ;
}

public function deletePage($page_id = ''){
	$this->db->where('page_id',$page_id)->delete('page');
	$this->db->where('page_id',$page_id)->delete('page_details');
}
public function deleteFooterPage($page_id = ''){
	$this->db->where('page_id',$page_id)->delete('page_common_cms');
	$this->db->where('page_id',$page_id)->delete('page_details_common_cms');
}

public function getPageByURL($language_id = 1,$page_url = '',$office='AGAE'){
	$res = $this->db->select('*')
					->from('page p')
					->join('page_details pd','p.page_id = pd.page_id')
					->where('page_url',$page_url)
					->where('language_id',$language_id)
					->where('page_office_code',$office)
					->get()
					->row_array();
	return $res;
}
public function getFooterPageByURL($language_id = 1,$page_url = ''){
	$res = $this->db->select('*')
					->from('page_common_cms p')
					->join('page_details_common_cms pd','p.page_id = pd.page_id')
					->where('page_url',$page_url)
					->where('language_id',$language_id)
					->get()
					->row_array();
	return $res;
}
public function getAllBlocks($language_id = 1){
	$res = $this->db->select('*')
					->from('page p')
					->join('page_details pd','p.page_id = pd.page_id')
					->where('type','BLOCK')
					->where('language_id',$language_id)
					->get()
					->result_array();
	return $res;
}
}// End of class