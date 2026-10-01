<?php
class Faq_model extends CI_Model {

function __construct(){
    parent::__construct();
	if($this->session->userdata('language_id')){
		$this->language_id = $this->session->userdata('language_id');
	}else{
		$this->language_id = 1;
	}
}
public function get_admin_faq($limit_to=0,$wing = ''){
	$get = $this->input->get(array('wing','search'), TRUE);
   	$this->db->select('*')
				 ->from('faq f')
				 ->join('faq_details fd','f.faq_id = fd.faq_id')
				 ->where('language_id','1')
				 ->order_by('f.faq_id','desc');
	if($get['search'] != ''){
		$this->db->group_start();
			$this->db->like('category',$get['search']);
			$this->db->or_like('question',$get['search']);
			$this->db->or_like('answer',$get['search']);
		$this->db->group_end();
	}
	if($wing != ''){
		$this->db->where('wing',$wing);
	}else{
		$this->db->where('wing !=','E&RSA');
		$this->db->where('wing !=','G&SSA');
		$wing = $this->session->userdata('admin_details')['admin_type_name'];
		if($wing != 'superadmin'){
			$this->db->group_start();
				$this->db->where('wing',$wing);
				$this->db->or_where('wing','all');
			$this->db->group_end();
		}else{
			if($get['wing'] != '' && $get['wing'] != 'all'){
					$this->db->like('wing',$get['wing']);
			}
		}
	}
	$total_records = $this->db->count_all_results('', FALSE);
	$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
						->group_by('f.faq_id')
						->get()
						->result_array();
	return array('total'=>$total_records,'results'=>$results);
}
public function addFAQ($update_data = array()){
	$res = $this->db->insert('faq',$update_data);
	$id = $this->db->insert_id();
	return $id;
}
public function updateFAQ($id='', $update_data = array()){
    $res = $this->db->where('faq_id',$id)->update('faq',$update_data);
	return $id;
}
public function deleteFAQById($id=''){
    $res = $this->db->where('faq_id',$id)->delete('faq');
    $res = $this->db->where('faq_id',$id)->delete('faq_details');
	return $id;
}
public function updateFAQDetails($id='', $language_id = '', $update_data = array()){
	$res = $this->db->where('faq_id',$id)->where('language_id',$language_id)->update('faq_details',$update_data);
	return ;
}

public function addFAQDetails($update_data = array()){
    $res = $this->db->insert('faq_details',$update_data);
	$id = $this->db->insert_id();
	return $id;
}
public function getAdminFAQById($id = '',$wing=''){
    $res = $this->db->select('*')
					->from('faq')
					->where('faq_id',$id);
	if($wing != ''){
			$this->db->where('wing',$wing);
	}
	$res = $this->db->get()
					->row_array();
	return $res;
}

public function getAdminFAQDetailsById($id = ''){
    $res = $this->db->select('*')
					->from('faq_details')
					->where('faq_id',$id)
					->get()
					->result_array();
	return $res;
}
public function get_FAQs($limit_to = 0){
	$results = 	$this->db->select('*')
						 ->from('faq f')
						 ->join('faq_details fd','f.faq_id = fd.faq_id')
						 ->where('language_id',$this->language_id)
						 ->group_by('fd.category')
						 ->order_by('fd.category')
						 ->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
						 ->get()
						 ->result_array();
	foreach($results as $key=>$row){
		$cat = $row['category'];
		$res = 	$this->db->select('*')
						 ->from('faq f')
						 ->join('faq_details fd','f.faq_id = fd.faq_id')
						 ->where('language_id',$this->language_id)
						 ->where('fd.category',$cat)
						 ->get()
						 ->result_array();
		$results[$key]['faqs'] = $res;
	}
	return $results;
}
public function get_TotalFAQs(){
	$results = 		$this->db->select('count(*) as total')
							 ->from('faq f')
							 ->join('faq_details fd','f.faq_id = fd.faq_id')
							 ->where('language_id',$this->language_id)
							 ->group_by('fd.category')
							 ->get()
							 ->row_array();
	return isset($results['total']) ? $results['total'] : 0;
}

public function get_Fund_FAQs($limit_to = 0){
	$results = 	$this->db->select('*')
						 ->from('faq f')
						 ->join('faq_details fd','f.faq_id = fd.faq_id')
						 ->where('language_id',$this->language_id)
						 ->where('wing','fund')
						 ->group_by('fd.category')
						 ->order_by('fd.category')
						 ->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
						 ->get()
						 ->result_array();
	foreach($results as $key=>$row){
		$cat = $row['category'];
		$res = 	$this->db->select('*')
						 ->from('faq f')
						 ->join('faq_details fd','f.faq_id = fd.faq_id')
						 ->where('language_id',$this->language_id)
						 ->where('wing','fund')
						 ->where('fd.category',$cat)
						 ->get()
						 ->result_array();
		$results[$key]['faqs'] = $res;
	}
	return $results;
}
public function get_Fund_TotalFAQs(){
	$results = 		$this->db->select('count(*) as total')
							 ->from('faq f')
							 ->join('faq_details fd','f.faq_id = fd.faq_id')
							 ->where('language_id',$this->language_id)
							 ->where('wing','fund')
							 ->group_by('fd.category')
							 ->get()
							 ->row_array();
	return isset($results['total']) ? $results['total'] : 0;
}

public function get_Pensoins_FAQs($limit_to = 0){
	$results = 	$this->db->select('*')
						 ->from('faq f')
						 ->join('faq_details fd','f.faq_id = fd.faq_id')
						 ->where('language_id',$this->language_id)
						 ->where('wing','pension')
						 ->group_by('fd.category')
						 ->order_by('f.faq_id')
						 ->order_by('fd.category')
						 ->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
						 ->get()
						 ->result_array();
	foreach($results as $key=>$row){
		$cat = $row['category'];
		$res = 	$this->db->select('*')
						 ->from('faq f')
						 ->join('faq_details fd','f.faq_id = fd.faq_id')
						 ->where('language_id',$this->language_id)
						 ->where('wing','pension')
						 ->where('fd.category',$cat)
						 ->get()
						 ->result_array();
		$results[$key]['faqs'] = $res;
	}
	return $results;
}
public function get_Pensoins_TotalFAQs(){
	$results = 		$this->db->select('count(*) as total')
							 ->from('faq f')
							 ->join('faq_details fd','f.faq_id = fd.faq_id')
							 ->where('language_id',$this->language_id)
							 ->where('wing','pension')
							 ->group_by('fd.category')
							 ->get()
							 ->row_array();
	return isset($results['total']) ? $results['total'] : 0;
}

public function get_Dacadre_FAQs($limit_to = 0){
	$results = 	$this->db->select('*')
						 ->from('faq f')
						 ->join('faq_details fd','f.faq_id = fd.faq_id')
						 ->where('language_id',$this->language_id)
						 ->where('wing','da_cadre')
						 ->group_by('fd.category')
						 ->order_by('fd.category')
						 ->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
						 ->get()
						 ->result_array();
	foreach($results as $key=>$row){
		$cat = $row['category'];
		$res = 	$this->db->select('*')
						 ->from('faq f')
						 ->join('faq_details fd','f.faq_id = fd.faq_id')
						 ->where('language_id',$this->language_id)
						 ->where('wing','da_cadre')
						 ->where('fd.category',$cat)
						 ->get()
						 ->result_array();
		$results[$key]['faqs'] = $res;
	}
	return $results;
}
public function get_Dacadre_TotalFAQs(){
	$results = 		$this->db->select('count(*) as total')
							 ->from('faq f')
							 ->join('faq_details fd','f.faq_id = fd.faq_id')
							 ->where('language_id',$this->language_id)
							 ->where('wing','da_cadre')
							 ->group_by('fd.category')
							 ->get()
							 ->row_array();
	return isset($results['total']) ? $results['total'] : 0;
}

public function get_Accounts_FAQs($limit_to = 0){
	$results = 	$this->db->select('*')
						 ->from('faq f')
						 ->join('faq_details fd','f.faq_id = fd.faq_id')
						 ->where('language_id',$this->language_id)
						 ->where('wing','accounts')
						 ->group_by('fd.category')
						 ->order_by('f.faq_id')
						 ->order_by('fd.category')
						 ->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
						 ->get()
						 ->result_array();
	foreach($results as $key=>$row){
		$cat = $row['category'];
		$res = 	$this->db->select('*')
						 ->from('faq f')
						 ->join('faq_details fd','f.faq_id = fd.faq_id')
						 ->where('language_id',$this->language_id)
						 ->where('wing','accounts')
						 ->where('fd.category',$cat)
						 ->get()
						 ->result_array();
		$results[$key]['faqs'] = $res;
	}
	return $results;
}
public function get_Accounts_TotalFAQs(){
	$results = 		$this->db->select('count(*) as total')
							 ->from('faq f')
							 ->join('faq_details fd','f.faq_id = fd.faq_id')
							 ->where('language_id',$this->language_id)
							 ->where('wing','accounts')
							 ->group_by('fd.category')
							 ->get()
							 ->row_array();
	return isset($results['total']) ? $results['total'] : 0;
}

public function get_Administrator_FAQs($limit_to = 0){
	$results = 	$this->db->select('*')
						 ->from('faq f')
						 ->join('faq_details fd','f.faq_id = fd.faq_id')
						 ->where('language_id',$this->language_id)
						 ->where('wing','administration')
						 ->group_by('fd.category')
						 ->order_by('f.faq_id')
						 ->order_by('fd.category')
						 ->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
						 ->get()
						 ->result_array();
	foreach($results as $key=>$row){
		$cat = $row['category'];
		$res = 	$this->db->select('*')
						 ->from('faq f')
						 ->join('faq_details fd','f.faq_id = fd.faq_id')
						 ->where('language_id',$this->language_id)
						 ->where('wing','administration')
						 ->where('fd.category',$cat)
						 ->get()
						 ->result_array();
		$results[$key]['faqs'] = $res;
	}
	return $results;
}
public function get_Administrator_TotalFAQs(){
	$results = 		$this->db->select('count(*) as total')
							 ->from('faq f')
							 ->join('faq_details fd','f.faq_id = fd.faq_id')
							 ->where('language_id',$this->language_id)
							 ->where('wing','administration')
							 ->group_by('fd.category')
							 ->get()
							 ->row_array();
	return isset($results['total']) ? $results['total'] : 0;
}
public function get_gssa_FAQs($limit_to = 0){
	$results = 	$this->db->select('*')
						 ->from('faq f')
						 ->join('faq_details fd','f.faq_id = fd.faq_id')
						 ->where('language_id',$this->language_id)
						 ->where('wing','G&SSA')
						 ->group_by('fd.category')
						 ->order_by('fd.category')
						 ->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
						 ->get()
						 ->result_array();
	foreach($results as $key=>$row){
		$cat = $row['category'];
		$res = 	$this->db->select('*')
						 ->from('faq f')
						 ->join('faq_details fd','f.faq_id = fd.faq_id')
						 ->where('language_id',$this->language_id)
						 ->where('wing','G&SSA')
						 ->where('fd.category',$cat)
						 ->get()
						 ->result_array();
		$results[$key]['faqs'] = $res;
	}
	return $results;
}
public function get_gssa_TotalFAQs(){
	$results = 		$this->db->select('count(*) as total')
							 ->from('faq f')
							 ->join('faq_details fd','f.faq_id = fd.faq_id')
							 ->where('language_id',$this->language_id)
							 ->where('wing','G&SSA')
							 ->group_by('fd.category')
							 ->get()
							 ->row_array();
	return isset($results['total']) ? $results['total'] : 0;
}
public function get_ersa_FAQs($limit_to = 0){
	$results = 	$this->db->select('*')
						 ->from('faq f')
						 ->join('faq_details fd','f.faq_id = fd.faq_id')
						 ->where('language_id',$this->language_id)
						 ->where('wing','E&RSA')
						 ->group_by('fd.category')
						 ->order_by('fd.category')
						 ->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
						 ->get()
						 ->result_array();
	foreach($results as $key=>$row){
		$cat = $row['category'];
		$res = 	$this->db->select('*')
						 ->from('faq f')
						 ->join('faq_details fd','f.faq_id = fd.faq_id')
						 ->where('language_id',$this->language_id)
						 ->where('wing','E&RSA')
						 ->where('fd.category',$cat)
						 ->get()
						 ->result_array();
		$results[$key]['faqs'] = $res;
	}
	return $results;
}
public function get_ersa_TotalFAQs(){
	$results = 		$this->db->select('count(*) as total')
							 ->from('faq f')
							 ->join('faq_details fd','f.faq_id = fd.faq_id')
							 ->where('language_id',$this->language_id)
							 ->where('wing','E&RSA')
							 ->group_by('fd.category')
							 ->get()
							 ->row_array();
	return isset($results['total']) ? $results['total'] : 0;
}
	
}// End of class