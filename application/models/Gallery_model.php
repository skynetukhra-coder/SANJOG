<?php
class Gallery_model extends CI_Model {

function __construct(){
    parent::__construct();
	if($this->session->userdata('language_id')){
		$this->language_id = $this->session->userdata('language_id');
	}else{
		$this->language_id = 1;
	}
}
public function get_admin_office_gallery($limit_to=0,$office = 'AGAE'){
   	$this->db->select('*')
				 ->from('gallery')
				 ->where('office',$office)
				 ->order_by('gallery_id','desc');
	$total_records = $this->db->count_all_results('', FALSE);
	$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
						->get()
						->result_array();
	return array('total'=>$total_records,'results'=>$results);
}
public function get_office_gallery_by_id($id=0,$office = 'AGAE'){
   	$result   = $this->db->select('*')
						 ->from('gallery')
						 ->where('office',$office)
						 ->where('gallery_id',$id)
						 ->get()
						 ->row_array();
	return $result;
}
public function add_gallery($update_data = array()){
	$res = $this->db->insert('gallery',$update_data);
	$id = $this->db->insert_id();
	return $id;
}
public function update_gallery($id='', $update_data = array()){
    $res = $this->db->where('gallery_id',$id)->update('gallery',$update_data);
	return $id;
}
public function delete_gallery($id=''){
    $res = $this->db->where('gallery_id',$id)->delete('gallery');
	return $id;
}
public function get_office_gallery($office = 'AGAE'){
	if($this->language_id == 1){
		$select = 'title,image';
	}
	else if($this->language_id == 2){
		$select = 'title_hindi as title,image';
	}
	else{
		$select = 'title_bengali as title,image';
	}
   	$results =  $this->db->select($select)
						 ->from('gallery')
						 ->where('office',$office)
						 ->order_by('gallery_id','desc')
						 ->get()
						 ->result_array();
	return $results;
}
}// End of class