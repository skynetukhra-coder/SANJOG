<?php
class Video_model extends CI_Model {

function __construct(){
    parent::__construct();
	if($this->session->userdata('language_id')){
		$this->language_id = $this->session->userdata('language_id');
	}else{
		$this->language_id = 1;
	}
}
public function get_admin_office_video($limit_to=0,$office = 'AGAE'){
   	$this->db->select('*')
				 ->from('video')
				 ->where('office',$office)
				 ->order_by('video_id','desc');
	$total_records = $this->db->count_all_results('', FALSE);
	$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
						->get()
						->result_array();
	return array('total'=>$total_records,'results'=>$results);
}
public function get_office_video_by_id($id=0,$office = 'AGAE'){
   	$result   = $this->db->select('*')
						 ->from('video')
						 ->where('office',$office)
						 ->where('video_id',$id)
						 ->get()
						 ->row_array();
	return $result;
}
public function add_video($update_data = array()){
	$res = $this->db->insert('video',$update_data);
	$id = $this->db->insert_id();
	return $id;
}
public function update_video($id='', $update_data = array()){
    $res = $this->db->where('video_id',$id)->update('video',$update_data);
	return $id;
}
public function delete_video($id=''){
    $res = $this->db->where('video_id',$id)->delete('video');
	return $id;
}
public function get_office_video($office = 'AGAE'){
   	$results =  $this->db->select('file_name')
						 ->from('video')
						 ->where('office',$office)
						 ->order_by('video_id','desc')
						 ->get()
						 ->result_array();
	return $results;
}
}// End of class