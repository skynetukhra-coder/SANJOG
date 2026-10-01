<?php
class Admin_model extends CI_Model {

function __construct(){
    parent::__construct();
}
function my_activity($id){
	$res = $this->db->select('admin_login_time as login_time,admin_login_ip as login_ip')->from('admin')->where('admin_id',$id)->get()->row_array();
	return $res;
}
function all_admin_activity($id){
	$res = $this->db->select('admin_name as name,base_super_admin,admin_type_name as wing, admin_login_time as login_time,admin_login_ip as login_ip')
					->from('admin a')
					->join('admin_type t','t.admin_type_id = a.admin_type_id','left')
					->where('admin_id !=',$id)
					->where('base_super_admin',0)
					->get()
					->result_array();
	return $res;
}
function latest_contents($wing=''){
	$this->db->select('page_id,page_url,page_name,page_office_code,type,filename,status,is_static_page_link')
			 ->from('page')
			 ->order_by('page_id','desc');
	if($wing != ''){
		$this->db->where('wing',$wing);
	}
	$this->db->order_by('page_id','desc');
	$results = $this->db->limit(10)
						->get()
						->result_array();
	return $results;
}
function latest_feedback($limit_to =15,$office='AGAE'){
			$this->db->select('*')
				 ->from('feedback')
				 ->order_by('feed_id','desc');
			if($this->session->has_userdata('admin_details')){
				$wing = $this->session->userdata('admin_details')['admin_type_name'];
				if($wing != 'superadmin'){
					if($office == 'AGAE'){
						if($wing == 'fund'){
							$cat = 'gpf';
						}else if($wing == 'administration'){
							$cat = 'administrative';
							
						}else if($wing == 'accounts'){
							$cat = 'accounts';
						}
						else if($wing == 'pension'){
							$cat = 'pension';
						}
						else if($wing == 'wm'){
							$cat = 'wm';
						}
						else if($wing == 'pao'){
							$cat = 'pao';
						}
						else if($wing == 'admin_ii'){
							$cat = 'admin_ii';
						}
						else if($wing == 'admin_iii'){
							$cat = 'admin_iii';
						}
						else if($wing == 'training'){
							$cat = 'training';
						}
						else if($wing == 'record'){
							$cat = 'record';
						}
						else if($wing == 'grievance'){
							$cat = 'grievance';
						}
						$this->db->group_start();
							$this->db->where('lower(visit_for)',$cat);
							$this->db->or_where('lower(visit_for)','general');
						$this->db->group_end();
						$this->db->where('office','Pr. AG (A&E)');
					}
					else if($office == 'AGGSSA'){
						$this->db->where('office','Pr. AG (G&SSA)');
					}
					else if($office == 'AGERSA'){
						$this->db->where('office','AG (E&RSA)');
					}
				}else{
					if($office == 'AGAE'){
						$this->db->where('office','Pr. AG (A&E)');
					}else if($office == 'AGGSSA'){
						$this->db->where('office','Pr. AG (G&SSA)');
					}
					else if($office == 'AGERSA'){
						$this->db->where('office','AG (E&RSA)');
					}
				}
			}
			$results = $this->db->limit($limit_to) // fron config/constants.php
								->get()
								->result_array();
			return $results;
}
function total_visitors(){
	$res = $this->db->select('*')->from('visitor_tracker')->get();
	return $res->num_rows();
}
function visitors_current_month(){
	$res = $this->db->select('*')->from('visitor_tracker')
								 ->where('MONTH(last_visit)','MONTH(CURRENT_DATE)',false)								 
								 ->get();
	return $res->num_rows();
}
function visitors_last_7_day(){
	$res = $this->db->select('*')->from('visitor_tracker')
								 ->where('date(last_visit) > ','(now() - interval 7 day)',false)								 
								 ->get();
	return $res->num_rows();
}

}// End of class