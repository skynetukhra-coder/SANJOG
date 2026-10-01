<?php
class Menu_model extends CI_Model {

function __construct(){
    parent::__construct();
	if($this->session->userdata('language_id')){
		$this->language_id = $this->session->userdata('language_id');
	}else{
		$this->language_id = 1;
	}
}
public function getMenu($office_code=''){
    $res = $this->db->select('m.*,p.page_url,p.page_office_code,p.page_name,p.type,p.filename')
					->from('menu m')
					->join('page p','m.page_id = p.page_id','left')
					->where('m.office_code',$office_code)
					->order_by('m.sort')
					->get()
					->result_array();
	return $res;
}
public function getContactUsMenu(){
    $res = $this->db->select('m.*,d.display_name,p.page_url,p.page_office_code,p.page_name,p.type,p.filename')
					->from('menu m')
					->join('page p','m.page_id = p.page_id','left')
					->join('menu_details d','m.menu_id = d.menu_id','left')
					->where('d.language_id',$this->language_id)
					->where('m.office_code','contact_us')
					->where('m.office_code','contact_us')
					->where('m.status','Active')
					->order_by('m.sort')
					->get()
					->result_array();
	return $res;
}
public function getContactUsMenu_admin(){
    $res = $this->db->select('m.*,d.display_name,p.page_url,p.page_office_code,p.page_name,p.type,p.filename')
					->from('menu m')
					->join('page p','m.page_id = p.page_id','left')
					->join('menu_details d','m.menu_id = d.menu_id','left')
					->where('d.language_id',$this->language_id)
					->where('m.office_code','contact_us')
//					->where('m.status','Active')
					->order_by('m.sort')
					->get()
					->result_array();
	return $res;
}
public function getTenderNoticeMenu(){
    $res = $this->db->select('m.*,d.display_name,p.page_url,p.page_office_code,p.page_name,p.type,p.filename')
					->from('menu m')
					->join('page p','m.page_id = p.page_id','left')
					->join('menu_details d','m.menu_id = d.menu_id','left')
					->where('d.language_id',$this->language_id)
					->where('m.office_code','tender_notice')
					->where('m.status','Active')
					->order_by('m.sort')
					->get()
					->result_array();
	return $res;
}
public function getTenderNoticeMenu_admin(){
    $res = $this->db->select('m.*,d.display_name,p.page_url,p.page_office_code,p.page_name,p.type,p.filename')
					->from('menu m')
					->join('page p','m.page_id = p.page_id','left')
					->join('menu_details d','m.menu_id = d.menu_id','left')
					->where('d.language_id',$this->language_id)
					->where('m.office_code','tender_notice')
//					->where('m.status','Active')
					->order_by('m.sort')
					->get()
					->result_array();
	return $res;
}
public function getMenuById($office_code = '', $menu_id = 0){
    $res = $this->db->select('*')
					->from('menu')
					->where('office_code',$office_code)
					->where('menu_id',$menu_id)
					->get()
					->row_array();
	return $res;
}
public function getMenuDetailsById($office_code = '', $menu_id = 0){
    $res = $this->db->select('md.*')
					->from('menu m')
					->join('menu_details md','m.menu_id = md.menu_id')
					->where('m.office_code',$office_code)
					->where('m.menu_id',$menu_id)
					->get()
					->result_array();
	return $res;
}
public function deleteMenuById($office_code = '', $menu_id = 0){
    $this->db->where('office_code',$office_code)
			 ->where('menu_id',$menu_id)
			 ->delete('menu');
	$this->db->where('menu_id',$menu_id)
			 ->delete('menu_details');
	return;
}
public function addMenu($update_data = array()){
    $res = $this->db->insert('menu',$update_data);
	$id = $this->db->insert_id();
	return $id;
}
public function addMenuDetails($update_data = array()){
    $res = $this->db->insert('menu_details',$update_data);
	$id = $this->db->insert_id();
	return $id;
}
public function updateMenu($id='', $update_data = array()){
    $res = $this->db->where('menu_id',$id)->update('menu',$update_data);
	return $id;
}
public function updateMenuDetails($id='', $language_id = '', $update_data = array()){
	//check is exists
	$res = $this->db->get_where('menu_details',array('menu_id'=>$id,'language_id'=>$language_id));
	if($res->num_rows() > 0){
		$res = $this->db->where('menu_id',$id)->where('language_id',$language_id)->update('menu_details',$update_data);
	}else{
		$this->db->insert('menu_details',$update_data);
	}
	return ;
}
public function getOfficeMenu($office_code='AGAE',$wing=''){
    $res = $this->db->select('m.*,d.display_name,p.page_url,p.page_office_code,p.page_name,p.type,p.filename')
					->from('office_menu m')
					->join('page p','m.page_id = p.page_id','left')
					->join('office_menu_details d','m.office_menu_id = d.office_menu_id','left')
					->where('m.status','Active')
					->where('d.language_id',$this->language_id);
	if($wing != ''){
		$res = $this->db->where("(m.wing = '$wing' OR m.wing = 'all wing')");
	}
	$res = $this->db->where('m.office_code',$office_code)
					->order_by('m.sort')
					->get()
					->result_array();
	return $res;
}
public function getOfficeMenu_admin($office_code='AGAE',$wing=''){
    $res = $this->db->select('m.*,d.display_name,p.page_url,p.page_office_code,p.page_name,p.type,p.filename')
					->from('office_menu m')
					->join('page p','m.page_id = p.page_id','left')
					->join('office_menu_details d','m.office_menu_id = d.office_menu_id','left')
//					->where('m.status','Active')
					->where('d.language_id',$this->language_id);
	if($wing != ''){
		$res = $this->db->where("(m.wing = '$wing' OR m.wing = 'all wing')");
	}
	$res = $this->db->where('m.office_code',$office_code)
					->order_by('m.sort')
					->get()
					->result_array();
	return $res;
}

public function getOfficeMenuById($office_code = 'AGAE', $menu_id = 0){
    $res = $this->db->select('*')
					->from('office_menu')
					//->where('office_code',$office_code)
					->where('office_menu_id',$menu_id)
					->get()
					->row_array();
	return $res;
}
public function getOfficeMenuDetailsById($office_code = 'AGAE', $menu_id = 0){
    $res = $this->db->select('md.*')
					->from('office_menu m')
					->join('office_menu_details md','m.office_menu_id = md.office_menu_id')
					//->where('m.office_code',$office_code)
					->where('m.office_menu_id',$menu_id)
					->get()
					->result_array();
	return $res;
}
public function deleteOfficeMenuById($office_code = 'AGAE', $menu_id = 0){
   // $res = $this->db->where('office_code',$office_code)
	$res = $this->db->where('office_menu_id',$menu_id)
					->delete('office_menu');
	$res = $this->db->where('office_menu_id',$menu_id)
					->delete('office_menu_details');
	return;
}
public function addOfficeMenu($update_data = array()){
    $res = $this->db->insert('office_menu',$update_data);
	$id = $this->db->insert_id();
	return $id;
}
public function addOfficeMenuDetails($update_data = array()){
    $res = $this->db->insert('office_menu_details',$update_data);
	$id = $this->db->insert_id();
	return $id;
}
public function updateOfficeMenu($id='', $update_data = array()){
    $res = $this->db->where('office_menu_id',$id)->update('office_menu',$update_data);
	return $id;
}
public function updateOfficeMenuDetails($id='', $language_id = '', $update_data = array()){
	//check is exists
	$res = $this->db->get_where('office_menu_details',array('office_menu_id'=>$id,'language_id'=>$language_id));
	if($res->num_rows() > 0){
		$res = $this->db->where('office_menu_id',$id)->where('language_id',$language_id)->update('office_menu_details',$update_data);
	}else{
		$this->db->insert('office_menu_details',$update_data);
	}
	return ;
}

}// End of class