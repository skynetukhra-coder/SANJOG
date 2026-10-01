<?php
class Emp_model extends CI_Model {

	function __construct(){
		parent::__construct();
		if($this->session->userdata('language_id')){
			$this->language_id = $this->session->userdata('language_id');
		}else{
			$this->language_id = 1;
		}
	}
	public function get_all_employee_list($office = 'AGAE'){
		$date = date('Y-m-d H:i:s');
		$results =  $this->db->select('e.empid,e.empname,e.desig,e.mbno,e.office_id')
							 ->from('employee_master e')
//							 ->join('employee_details ed','ed.empid = e.empid','left')
							 ->where('office_code',$office)
				 			 ->where('date(dor) >= ',$date)
							 ->where('status','Active')
							 ->where('da_cadare','0')
							 ->order_by('e.empname')
							 ->get()
							 ->result_array();
		return $results;
	}
	public function get_all_da_cadare_list($office = 'AGAE'){
		$date = date('Y-m-d H:i:s');
		$results =  $this->db->select('e.empid,e.empname,e.desig,e.mbno,e.office_id')
							 ->from('employee_master e')
//							 ->join('employee_details ed','ed.empid = e.empid','left')
							 ->where('office_code',$office)
				 			 ->where('date(dor) >= ',$date)
							 ->where('status','Active')
							 ->where('da_cadare','1')
							 ->order_by('e.empname')
							 ->get()
							 ->result_array();
		return $results;
	}
	
	public function get_authority_list($office = 'AGAE',$desig=''){
		$date = date('Y-m-d H:i:s');
		$results =  $this->db->select('e.empid,e.empname,e.desig')
							 ->from('employee_master e')
//							 ->join('employee_details ed','ed.empid = e.empid','left')						 
							 ->where('office_code',$office)
							 ->where('date(dor) >= ',$date)
							 ->order_by('e.empname')
							 ->get()
							 ->result_array();
		return $results;
	}
	public function get_family_member($empid = '',$first_second_child=''){
		$results =  $this->db->select('*')
							 ->from('employee_family e')
//							 ->join('employee_details ed','ed.empid = e.empid','left')						 
							 ->where('empid',$empid)
							 ->where('first_second_child',$first_second_child)
							 ->order_by('e.member_name')
							 ->get()
							 ->row_array();
		return $results;
	}
	public function get_employees_issued_office_order($limit_to=0, $office = 'AGAE'){
//		$order_id ='10';
		$get = $this->input->get(array('search'), TRUE);
		$results =  $this->db->select('e.empid,e.empname,e.desig,ote.eord_id, ote.order_id')
							 ->from('employee_master e')
							 ->join('office_order_to_employee ote','ote.empid = e.empid')						 
							 ->where('e.office_code',$office)
//							 ->where('ote.order_id',$order_id)
							 ->order_by('e.empname');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->or_like('order_id',$get['search']);
			$this->db->group_end();
		}
		$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function get_dacadare_employees_issued_office_order($limit_to=0, $office = 'AGAE',$da_cadare = '1'){
//		$order_id ='10';
		$get = $this->input->get(array('search'), TRUE);
		$results =  $this->db->select('e.empid,e.da_cadare,e.empname,e.desig,ote.eord_id, ote.order_id')
							 ->from('employee_master e')
							 ->join('office_order_to_employee ote','ote.empid = e.empid')						 
							 ->where('e.office_code',$office)
							 ->where('e.da_cadare',$da_cadare)
//							 ->where('ote.order_id',$order_id)
							 ->order_by('e.empname');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->or_like('order_id',$get['search']);
			$this->db->group_end();
		}
		$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	} 
	
	
	public function get_admin_employee($limit_to=0,$office = 'AGAE'){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('employee_master')
				 ->where('office_code',$office)
				 ->order_by('e_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('empid',$get['search']);
				$this->db->or_like('office_id',$get['search']);
				$this->db->or_like('empname',$get['search']);
				$this->db->or_like('father_name',$get['search']);
				$this->db->or_like('mbno',$get['search']);
				$this->db->or_like('nicmail',$get['search']);
				$this->db->or_like('email',$get['search']);
				$this->db->or_like('status',$get['search']);
			$this->db->group_end();
		}
		$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_admin_da_cadare($limit_to=0,$office = 'AGAE'){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('employee_master')
				 ->where('da_cadare','1')
				 ->where('office_code',$office)
				 ->order_by('e_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('empid',$get['search']);
				$this->db->or_like('empname',$get['search']);
				$this->db->or_like('father_name',$get['search']);
				$this->db->or_like('mbno',$get['search']);
				$this->db->or_like('nicmail',$get['search']);
				$this->db->or_like('email',$get['search']);
			$this->db->group_end();
		}
		$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function update_employee($id=0,$office = 'AGAE'){
		$employee = $this->input->post(array('office_id','empname','group_name','section','desig','father_name','gender','mbno','category','stream','dob','dor','nicmail','nicmail_proposed','email','doapp','doj_off','basic_pay','office','dept_appt','joning_type','blodd_grp','password','status','remark'), TRUE);
		$details  = $this->input->post(array('offic_id','qualifi','address1','state','district','postoffice','pin','section','grd_slno','grd_pageno','id_cardno','gratuity_nomination','gis_nomination','do_exp'), TRUE);
		$update = array();
		
		if($employee['office_id'] != ''){$update['office_id'] = $employee['office_id'];}
		if($employee['empname'] != ''){$update['empname'] = $employee['empname'];}
		if($employee['father_name'] != ''){$update['father_name'] = $employee['father_name'];}
		if($employee['group_name'] != ''){$update['group_name'] = $employee['group_name'];}
		if($employee['section'] != ''){$update['section'] = $employee['section'];}
		if($employee['desig'] != ''){$update['desig'] = $employee['desig'];}
		if($employee['gender'] != ''){$update['gender'] = $employee['gender'];}
		if($employee['mbno'] != ''){$update['mbno'] = $employee['mbno'];}
		if($employee['category'] != ''){$update['category'] = $employee['category'];}
		if($employee['stream'] != ''){$update['stream'] = $employee['stream'];}
//		if($employee['dob'] != ''){$update['dob'] = date('Y-m-d H:i:s',strtotime($employee['dob']));}
		if($employee['dob'] != ''){$update['dob'] = date('Y-m-d',strtotime($employee['dob']));}
		if($employee['dor'] != ''){$update['dor'] = date('Y-m-d',strtotime($employee['dor']));}
		if($employee['nicmail'] != ''){$update['nicmail'] = $employee['nicmail'];}
		if($employee['nicmail_proposed'] != ''){$update['nicmail_proposed'] = $employee['nicmail_proposed'];}
		if($employee['email'] != ''){$update['email'] = $employee['email'];}
		if($employee['doapp'] != ''){$update['doapp'] = date('Y-m-d',strtotime($employee['doapp']));}
		if($employee['doj_off'] != ''){$update['doj_off'] = date('Y-m-d',strtotime($employee['doj_off']));}
		if($employee['basic_pay'] != ''){$update['basic_pay'] = $employee['basic_pay'];}
		if($employee['office'] != ''){$update['office'] = $employee['office'];}
		if($employee['dept_appt'] != ''){$update['dept_appt'] = $employee['dept_appt'];}
		if($employee['joning_type'] != ''){$update['joning_type'] = $employee['joning_type'];}
		if($employee['blodd_grp'] != ''){$update['blodd_grp'] = $employee['blodd_grp'];}
		if($employee['password'] != ''){$update['password'] = md5($employee['password']);}
		if($employee['status'] != ''){$update['status'] = $employee['status'];}
		if($details['remark'] != ''){
			$update['remark'] = $details['remark'];
		}else{
			$update['remark'] = 'I Agree';	
		}
		if(!empty($update) && $id != ''){
			$this->db->where('empid',$id)->where('office_code',$office)->update('employee_master',$update);
		}
		// details
		$update = array();
		
		if($details['offic_id'] != ''){$update['offic_id'] = $details['offic_id'];}
		if($details['qualifi'] != ''){$update['qualifi'] = $details['qualifi'];}
		if($details['address1'] != ''){$update['address1'] = $details['address1'];}
		if($details['state'] != ''){$update['state'] = $details['state'];}
		if($details['district'] != ''){$update['district'] = $details['district'];}
		if($details['postoffice'] != ''){$update['postoffice'] = $details['postoffice'];}
		if($details['pin'] != ''){$update['pin'] = $details['pin'];}
		if($details['section'] != ''){$update['section'] = $details['section'];}
		if($details['grd_slno'] != ''){$update['grd_slno'] = $details['grd_slno'];}
		if($details['grd_pageno'] != ''){$update['grd_pageno'] = $details['grd_pageno'];}
		if($details['id_cardno'] != ''){$update['id_cardno'] = $details['id_cardno'];}
		if($details['gratuity_nomination'] != ''){$update['gratuity_nomination'] = $details['gratuity_nomination'];}
		if($details['gis_nomination'] != ''){$update['gis_nomination'] = $details['gis_nomination'];}
		if($details['do_exp'] != ''){$update['do_exp'] = date('Y-m-d',strtotime($details['do_exp']));}
		if(!empty($update) && $id != ''){
			$this->db->where('empid',$id)->update('employee_details',$update);
		}
	}
	
	public function employee_registration($office = 'AGAE'){
		$post =  $this->input->post(array('emp_id','dob','mobile'), TRUE);
		$emp_id = $post['emp_id'];
		$dob  = date('Y-m-d',strtotime($post['dob']));
		$mobile = $post['mobile'];
		$res = $this->db->select('*')
						->from('employee_master')
						->where('empid',$emp_id)
						->where('date(dob)',$dob)
						->where('office_code',$office)
						->get()
						->row_array();
		if(empty($res)){
			return array('success'=>false,'msg'=>'Wrong Credentials!');
		}
		if(isset($res['password']) && !empty($res['password'])){
			$msg = "You have already registered.";
			return array('success'=>false,'msg'=>$msg);
		}	
		if(isset($res['mobile']) && empty($res['mobile'])){
			$msg = "You do not submited your mobile no. Please submit mobile no to itsc-agae-wb@nic.in.";
			return array('success'=>false,'msg'=>$msg);
		}
		return array('success'=>true,'msg'=>"Reset your password",'details'=>$res);
	}
	
	public function employee_forgot_password($office = 'AGAE'){
		$post =  $this->input->post(array('emp_id','dob','mobile'), TRUE);
		$emp_id = $post['emp_id'];
		$dob  = date('Y-m-d',strtotime($post['dob']));
		$mobile = $post['mobile'];
		$res = $this->db->select('*')
						->from('employee_master')
						->where('empid',$emp_id)
						->where('date(dob)',$dob)
						->where('office_code',$office)
						->get()
						->row_array();
		if(empty($res)){
			return array('success'=>false,'msg'=>'Sorry! No records found.');
		}
		if(isset($res['password']) && empty($res['password'])){
			$msg = "Your account is not registered.";
			return array('success'=>false,'msg'=>$msg);
		}	
		if(isset($res['mobile']) && empty($res['mobile'])){
			$msg = "You do not submited your mobile no. Please submit mobile no to itsc-agae-wb@nic.in.";
			return array('success'=>false,'msg'=>$msg);
		}
		return array('success'=>true,'msg'=>"Reset your password",'details'=>$res);
	}
	public function reset_password($empid='',$pass=''){
		$this->db->where('empid',$empid)->update('employee_master',array('password'=>md5($pass)));
	}

	public function employee_agae_login($emp_id = '',$pass='',$office='AGAE',$da_cadare='0',$status='Active'){
		$date = date('Y-m-d H:i:s');
		$res = $this->db->select('*')
						->from('employee_master')
						->where('empid',$emp_id)
						->where('password',md5($pass))
						->where('office_code',$office)
						->where('da_cadare',$da_cadare)
						->where('date(dor) >= ',$date)
						->where('status',$status)
						->get()
						->row_array();
		return $res;
	}
	public function employee_dacadare_login($emp_id = '',$pass='',$office='AGAE',$da_cadare='1',$status='Active'){
		$date = date('Y-m-d H:i:s');
		$res = $this->db->select('*')
						->from('employee_master')
						->where('empid',$emp_id)
						->where('password',md5($pass))
						->where('office_code',$office)
						->where('da_cadare',$da_cadare)
						->where('date(dor) >= ',$date)
						->where('status',$status)
						->get()
						->row_array();
		return $res;
	}
	public function employee_gssa_login($emp_id = '',$pass='',$office='AGGSSA',$da_cadare='0',$status='Active'){
		$date = date('Y-m-d H:i:s');
		$res = $this->db->select('*')
						->from('employee_master')
						->where('empid',$emp_id)
						->where('password',md5($pass))
						->where('office_code',$office)
						->where('da_cadare',$da_cadare)
						->where('date(dor) >= ',$date)
						->where('status',$status)
						->get()
						->row_array();
		return $res;
	}
	public function employee_ersa_login($emp_id = '',$pass='',$office='AGERSA',$da_cadare='0',$status='Active'){
		$date = date('Y-m-d H:i:s');
		$res = $this->db->select('*')
						->from('employee_master')
						->where('empid',$emp_id)
						->where('password',md5($pass))
						->where('office_code',$office)
						->where('da_cadare',$da_cadare)
						->where('date(dor) >= ',$date)
						->where('status',$status)
						->get()
						->row_array();
		return $res;
	}
	
	public function employee_details($empid = '',$office='AGAE'){
		$res = $this->db->select('e.*,ed.*,e.empid')
						->from('employee_master e')
						->join('employee_details ed','e.empid = ed.empid','left')
						->where('e.empid',$empid)
						->where('e.office_code',$office)
						->get()
						->row_array();
		return $res;
	}
	public function get_all_section_list(){
		$res = $this->db->select ('section')
						->from('section_master')
						->order_by('section','asc')
//						->group_by('section')
						->get()
						->result_array();
		return $res;
	}
	public function get_employee_office_orders($empid = ''){
		$res = $this->db->select('*')
						->from('office_order oo')
						->join('office_order_to_employee e','e.order_id = oo.order_id')
						->where('e.empid',$empid)
						->like('oo.title','Office Order')
						->order_by('oo.order_dt','desc')
						->group_by('oo.order_id')
						->get()
						->result_array();
		return $res;
	}
		public function get_dacadare_employee_office_orders($empid = ''){
		$res = $this->db->select('*')
						->from('office_order oo')
						->join('office_order_to_employee e','e.order_id = oo.order_id')
						->where('e.empid',$empid)
						->like('oo.title','Office Order')
						->order_by('oo.order_dt','desc')
						->group_by('oo.order_id')
						->get()
						->result_array();
		return $res;
	}
	public function get_employee_all_leaves($empid = ''){
//		$get = $this->input->get(array('empid'), TRUE);
		$res = $this->db->select('ld.*')
						->from('employee_leave_debit ld')
						->where('ld.empid',$empid)
						->order_by('ld.leave_from','desc')
						->get()
						->result_array();
		return $res;
	}
	public function get_employee_leave_history ($limit_to = 0){
		$get = $this->input->get(array('empid'), TRUE);
		$this->db->select('lh.*')
				 ->from('employee_leave_debit lh');
	
		if($get['empid'] != ''){
			$this->db->where('lh.empid',$get['empid']);
		}
		
		$this->db->order_by('lh.leave_from','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}	
	
	public function get_employee_feedback($empid = '',$status='close'){
		$res = $this->db->select('*')
						->from('feedback e')
						->where('e.empid',$empid)
//						->where('e.status',$status)
						->get()
						->result_array();
		return $res;
	}

	public function get_employee_apar_booklet($empid = ''){
		$res = $this->db->select('*')
						->from('office_order oo')
						->join('office_order_to_employee e','e.order_id = oo.order_id')
						->where('e.empid',$empid)
						->group_start()
						->like('oo.title','APAR Booklet')
						->or_like('oo.details','apr booklet')
						->group_end()
						->get()
						->result_array();
		return $res;
	}
	public function get_employee_service_book($empid = ''){
		$res = $this->db->select('oo.*')
						->from('office_order oo')
						->join('office_order_to_employee e','e.order_id = oo.order_id')
						->where('e.empid',$empid)
						->group_start()
						->like('oo.title','service book')
						->or_like('oo.details','service book')
						->group_end()
						->get()
						->result_array();
		return $res;
	}

	public function get_employee_gpf_statement($empid = ''){
		$res = $this->db->select('*')
						->from('office_order oo')
						->join('office_order_to_employee e','e.order_id = oo.order_id')
						->where('e.empid',$empid)
						->group_start()
						->like('oo.title','gpf statement')
						->or_like('oo.details','gpf statement')
						->group_end()
						->get()
						->result_array();
		return $res;
	}

	public function get_employee_circular($limit_to = 0,$office='AGAE'){
		$get = $this->input->get(array('date_from', 'date_to', 'wing', 'details'), TRUE);
		$this->db->select('*')
				 ->from('office_order')
				 ->where('office',$office)
				 ->where('title','All Circular');
		if($get['date_from'] != ''){
			$f_date = date('Y-m-d',strtotime($get['date_from']));
			$this->db->where('date(order_dt) >= ',$f_date);
		}
		if($get['date_to'] != ''){
			$t_date = date('Y-m-d',strtotime($get['date_to']));
			$this->db->where('date(order_dt) <= ',$t_date);
		}
		if($get['wing'] != ''){
			$this->db->where('wing',$get['wing']);
		}
		if($get['details'] != ''){
			$this->db->like('details',$get['details']);
		}
		$this->db->order_by('order_dt','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}	
	
	public function get_dacadre_employee_circular($limit_to = 0,$office='AGAE', $wing='da_cadre'){
		$get = $this->input->get(array('date_from', 'date_to', 'wing', 'details'), TRUE);
		$this->db->select('*')
				 ->from('office_order')
				 ->where('office',$office)
				 ->where('wing',$wing)
				 ->where('title','All Circular');
		if($get['date_from'] != ''){
			$f_date = date('Y-m-d',strtotime($get['date_from']));
			$this->db->where('date(order_dt) >= ',$f_date);
		}
		if($get['date_to'] != ''){
			$t_date = date('Y-m-d',strtotime($get['date_to']));
			$this->db->where('date(order_dt) <= ',$t_date);
		}
		if($get['wing'] != ''){
			$this->db->where('wing',$get['wing']);
		}
		if($get['details'] != ''){
			$this->db->like('details',$get['details']);
		}
		$this->db->order_by('order_dt','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}	
	
	public function get_gradation_list($limit_to = 0,$office='AGAE'){
		$get = $this->input->get(array('date_from', 'date_to', 'wing', 'details'), TRUE);
		$this->db->select('*')
				 ->from('office_order')
				 ->where('office',$office)
				 ->where('title','Gradation List');
		if($get['date_from'] != ''){
			$f_date = date('Y-m-d',strtotime($get['date_from']));
			$this->db->where('date(order_dt) >= ',$f_date);
		}
		if($get['date_to'] != ''){
			$t_date = date('Y-m-d',strtotime($get['date_to']));
			$this->db->where('date(order_dt) <= ',$t_date);
		}
		if($get['wing'] != ''){
			$this->db->where('wing',$get['wing']);
		}
		if($get['details'] != ''){
			$this->db->like('details',$get['details']);
		}
		$this->db->order_by('order_dt','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_epabx_extension_list($limit_to=0 ,$office='AGAE'){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('epabx_extension')
				 ->where('office_code',$office)
				 ->order_by('exten_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('group_nm',$get['search']);
				$this->db->or_like('section',$get['search']);
				$this->db->or_like('emp_name',$get['search']);
			$this->db->group_end();
		}
		$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}	
	public function get_epabx_extension($limit_to = 0,$office='AGAE'){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('epabx_extension');
	
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('group_nm',$get['search']);
				$this->db->or_like('section',$get['search']);
				$this->db->or_like('emp_name',$get['search']);
		$this->db->group_end();
		}
		$this->db->order_by('group_nm','asc');
		$this->db->order_by('section','asc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function epabx_extension_list_edit($empid = '',$office='AGAE'){
		$res = $this->db->select('*')
						->from('epabx_extension')
						->where('exten_id',$empid)
						->where('office_code',$office)
						->get()
						->row_array();
		return $res;
	}
	public function update_epabx_extension($id=0,$office = 'AGAE'){
		$extension = $this->input->post(array('group_nm','section','emp_name','extension_no'), TRUE);
		$update = array();
		if($extension['group_nm'] != ''){$update['group_nm'] = $extension['group_nm'];}
		if($extension['section'] != ''){$update['section'] = $extension['section'];}
		if($extension['emp_name'] != ''){$update['emp_name'] = $extension['emp_name'];}
		if($extension['extension_no'] != ''){$update['extension_no'] = $extension['extension_no'];}
		
		if(!empty($update) && $id != ''){
			$this->db->where('exten_id',$id)->update('epabx_extension',$update);
		}
	}

	public function get_kms_document($limit_to = 0,$office='AGAE'){
		$get = $this->input->get(array('date_from', 'date_to', 'wing', 'details'), TRUE);
		$this->db->select('*')
				 ->from('office_order')
				 ->where('office',$office)
				 ->where('title','Book and Manual');
		if($get['date_from'] != ''){
			$f_date = date('Y-m-d',strtotime($get['date_from']));
			$this->db->where('date(order_dt) >= ',$f_date);
		}
		if($get['date_to'] != ''){
			$t_date = date('Y-m-d',strtotime($get['date_to']));
			$this->db->where('date(order_dt) <= ',$t_date);
		}
		if($get['wing'] != ''){
			$this->db->where('wing',$get['wing']);
		}
		if($get['details'] != ''){
			$this->db->like('details',$get['details']);
		}
		$this->db->order_by('order_dt','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}	

	public function get_administrative_order($limit_to = 0,$office='AGAE'){
		$get = $this->input->get(array('date_from', 'date_to', 'wing', 'details'), TRUE);
		$this->db->select('*')
				 ->from('office_order')
				 ->where('office',$office)
				 ->where('title','Administrative Order');
		if($get['date_from'] != ''){
			$f_date = date('Y-m-d',strtotime($get['date_from']));
			$this->db->where('date(order_dt) >= ',$f_date);
		}
		if($get['date_to'] != ''){
			$t_date = date('Y-m-d',strtotime($get['date_to']));
			$this->db->where('date(order_dt) <= ',$t_date);
		}
		if($get['wing'] != ''){
			$this->db->where('wing',$get['wing']);
		}
		if($get['details'] != ''){
			$this->db->like('details',$get['details']);
		}
		$this->db->order_by('order_dt','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}	
	
	public function get_training_material($limit_to = 0,$office='AGAE'){
		$get = $this->input->get(array('date_from', 'date_to', 'wing', 'details'), TRUE);
		$this->db->select('*')
				 ->from('office_order')
				 ->where('office',$office)
				 ->where('title','Training Material');
		if($get['date_from'] != ''){
			$f_date = date('Y-m-d',strtotime($get['date_from']));
			$this->db->where('date(order_dt) >= ',$f_date);
		}
		if($get['date_to'] != ''){
			$t_date = date('Y-m-d',strtotime($get['date_to']));
			$this->db->where('date(order_dt) <= ',$t_date);
		}
		if($get['wing'] != ''){
			$this->db->where('wing',$get['wing']);
		}
		if($get['details'] != ''){
			$this->db->like('details',$get['details']);
		}
		$this->db->order_by('order_dt','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}	
		
	public function employee_application($emp_id = 0){
		$post =  $this->input->post(array('exm_nm','exm_month','exm_year','full_name','desig','doa','basic_pay','section_name','group_name','phone_office','father_name','dob','gender','quali','category','gr_serial_no','gr_page_no','mts_exm_month','mts_exm_year','index_no','post_emp','post_doa','break_service','post_length_service','post_length_service_on','break_service_from','break_service_to','is_appeared_in_exam','yr_month_1','index_1','center_1','expt_1','yr_month_2','index_2','center_2','expt_2','addr','email','mobile','hindi_apprd','location_training','training_from','training_to'), TRUE);
		$post['emp_id'] = $emp_id;
		if($post['exm_nm'] == 'Others'){
			$post['exm_nm'] = $this->input->post('other_exam_name',true);
		}
		$post['dob'] = !empty($post['dob']) ? date('Y-m-d',strtotime($post['dob'])) : '';
		$post['doa'] = !empty($post['doa']) ? date('Y-m-d',strtotime($post['doa'])) : '';
		$post['post_doa'] = !empty($post['post_doa']) ? date('Y-m-d',strtotime($post['post_doa'])) : '';
		$post['post_length_service_on'] = !empty($post['post_length_service_on']) ? date('Y-m-d',strtotime($post['post_length_service_on'])) : '';
		$post['break_service_from'] = !empty($post['break_service_from']) ? date('Y-m-d',strtotime($post['break_service_from'])) : '';
		$post['break_service_to'] = !empty($post['break_service_to']) ? date('Y-m-d',strtotime($post['break_service_to'])) : '';
		$post['training_from'] = !empty($post['training_from']) ? date('Y-m-d',strtotime($post['training_from'])) : '';
		$post['training_to'] = !empty($post['training_to']) ? date('Y-m-d',strtotime($post['training_to'])) : '';
		$this->db->insert('employee_application',$post);
		return true;
	}
	public function get_employee_application($emp_id = 0,$office = 'AGAE'){
		$res = $this->db->select('ea.*')
						->from('employee_application ea')
						->join('employee_master e','ea.emp_id = e.empid')
						->where('ea.emp_id',$emp_id)
						->where('e.office_code',$office)
						->order_by('applied_on','desc')
						->get()
						->row_array();
		return $res;
	}
	public function get_all_employee_examinations(){
		$res = $this->db->select('exm_nm')
						->from('employee_application')
						->order_by('exm_nm','desc')
						->group_by('exm_nm')
						->get()
						->result_array();
		return $res;
	}
	public function get_all_loan_types(){
		$res = $this->db->select ('loan_type')
						->from('employee_loan')
						->order_by('loan_type','desc')
						->group_by('loan_type')
						->get()
						->result_array();
		return $res;
	}
	public function all_employees_loans($office = 'AGAE'){
		$post = $this->input->post(array('date_from','date_to', 'loan_type'), TRUE);
		$res = $this->db->select('ea.*')
						->from('employee_loan ea');
		if($post['date_from'] != ''){
			$f_date = date('Y-m-d',strtotime($post['date_from']));
			$this->db->where('date(ea.applied_on) >= ',$f_date);
		}
		if($post['date_to'] != ''){
			$t_date = date('Y-m-d',strtotime($post['date_to']));
			$this->db->where('date(ea.applied_on) <= ',$t_date);
		}
		if($post['loan_type'] != ''){
			$this->db->where('ea.loan_type',$post['loan_type']);
		}							
		$res = $this->db->order_by('ea.applied_on','desc')
						->get()
						->result_array();
		return $res;
	}
	public function get_all_bill_types(){
		$res = $this->db->select ('bill_type')
						->from('employee_bills')
						->order_by('bill_type','desc')
						->group_by('bill_type')
						->get()
						->result_array();
		return $res;
	}
	public function all_employees_bills($office = 'AGAE'){
		$post = $this->input->post(array('date_from','date_to', 'bill_type'), TRUE);
		$res = $this->db->select('ea.*')
						->from('employee_bills ea');
		if($post['date_from'] != ''){
			$f_date = date('Y-m-d',strtotime($post['date_from']));
			$this->db->where('date(ea.applied_on) >= ',$f_date);
		}
		if($post['date_to'] != ''){
			$t_date = date('Y-m-d',strtotime($post['date_to']));
			$this->db->where('date(ea.applied_on) <= ',$t_date);
		}
		if($post['bill_type'] != ''){
			$this->db->where('ea.bill_type',$post['bill_type']);
		}							
		$res = $this->db->order_by('ea.applied_on','desc')
						->get()
						->result_array();
		return $res;
	}
	public function get_all_encashment_types(){
		$res = $this->db->select ('ltc_htc')
						->from('employee_leave_encashment')
						->order_by('ltc_htc','desc')
						->group_by('ltc_htc')
						->get()
						->result_array();
		return $res;
	}
	public function all_employees_encashment($office = 'AGAE'){
		$post = $this->input->post(array('date_from','date_to', 'ltc_htc'), TRUE);
		$res = $this->db->select('ea.*')
						->from('employee_leave_encashment ea');
		if($post['date_from'] != ''){
			$f_date = date('Y-m-d',strtotime($post['date_from']));
			$this->db->where('date(ea.application_dt) >= ',$f_date);
		}
		if($post['date_to'] != ''){
			$t_date = date('Y-m-d',strtotime($post['date_to']));
			$this->db->where('date(ea.application_dt) <= ',$t_date);
		}
		if($post['ltc_htc'] != ''){
			$this->db->where('ea.ltc_htc',$post['ltc_htc']);
		}							
		$res = $this->db->order_by('ea.application_dt','desc')
						->get()
						->result_array();
		return $res;
	}
	
	public function get_all_leave_types(){
		$res = $this->db->select ('leave_type')
						->from('employee_leave_debit')
						->order_by('leave_type','desc')
						->group_by('leave_type')
						->get()
						->result_array();
		return $res;
	}
	
	public function get_all_training_types(){
		$res = $this->db->select ('training_type')
						->from('employee_training')
						->order_by('training_type','desc')
						->group_by('training_type')
						->get()
						->result_array();
		return $res;
	}

	
	public function all_employees_leaves($office = 'AGAE'){
		$post = $this->input->post(array('date_from','date_to', 'leave_type'), TRUE);
		$res = $this->db->select('el.*')
						->from('employee_leave_debit el');
		if($post['date_from'] != ''){
			$f_date = date('Y-m-d',strtotime($post['date_from']));
			$this->db->where('date(el.application_dt) >= ',$f_date);
		}
		if($post['date_to'] != ''){
			$t_date = date('Y-m-d',strtotime($post['date_to']));
			$this->db->where('date(el.application_dt) <= ',$t_date);
		}
		if($post['leave_type'] != ''){
			$this->db->where('el.leave_type',$post['leave_type']);
		}							
		$res = $this->db->order_by('el.application_dt','desc')
						->get()
						->result_array();
		return $res;
	}
	
	public function all_employees_trainings($office = 'AGAE'){
		$post = $this->input->post(array('date_from','date_to', 'training_type'), TRUE);
		$res = $this->db->select('et.*')
						->from('employee_training et');
		if($post['date_from'] != ''){
			$f_date = date('Y-m-d',strtotime($post['date_from']));
			$this->db->where('date(et.training_from) >= ',$f_date);
		}
		if($post['date_to'] != ''){
			$t_date = date('Y-m-d',strtotime($post['date_to']));
			$this->db->where('date(et.training_from) <= ',$t_date);
		}
		if($post['training_type'] != ''){
			$this->db->where('et.training_type',$post['training_type']);
		}							
		$res = $this->db->order_by('et.training_from','desc')
						->get()
						->result_array();
		return $res;
	}
	
	public function get_feedback_download($office = 'AGAE'){
		$post = $this->input->post(array('date_from','date_to', 'visit_for'), TRUE);
		$res = $this->db->select('fb.*')
						->from('feedback fb');
		if($post['date_from'] != ''){
			$f_date = date('Y-m-d',strtotime($post['date_from']));
			$this->db->where('date(fb.feed_date) >= ',$f_date);
		}
		if($post['date_to'] != ''){
			$t_date = date('Y-m-d',strtotime($post['date_to']));
			$this->db->where('date(fb.feed_date) <= ',$t_date);
		}
		if($post['visit_for'] != ''){
			$this->db->where('fb.visit_for',$post['visit_for']);
		}							
		$res = $this->db->order_by('fb.feed_date','desc')
						->get()
						->result_array();
		return $res;
	}
	
	public function all_employees_application($office = 'AGAE'){
		$post = $this->input->post(array('date_from','date_to', 'exam_name'), TRUE);
		$res = $this->db->select('ea.*')
						->from('employee_application ea')
						->join('employee_master e','ea.emp_id = e.empid')
						->where('e.office_code',$office);
		if($post['date_from'] != ''){
			$f_date = date('Y-m-d',strtotime($post['date_from']));
			$this->db->where('date(ea.applied_on) >= ',$f_date);
		}
		if($post['date_to'] != ''){
			$t_date = date('Y-m-d',strtotime($post['date_to']));
			$this->db->where('date(ea.applied_on) <= ',$t_date);
		}
		if($post['exam_name'] != ''){
			$this->db->where('ea.exm_nm',$post['exam_name']);
		}							
		$res = $this->db->order_by('ea.applied_on','desc')
						->get()
						->result_array();
		return $res;
	}
	
	
	public function employees_application($empid = '', $office = 'AGAE'){
		$res = $this->db->select('ea.*')
						->from('employee_application ea')
						->join('employee_master e','ea.emp_id = e.empid')
						->where('e.office_code',$office)
						->order_by('ea.applied_on','desc')
						->get()
						->result_array();
		return $res;
	}	
		
	//---------leave application
	public function get_employee_leave_application($empid = 0,$office = 'AGAE'){
		$res = $this->db->select('la.*')
						->from('employee_leave_debit la')
						->join('employee_master e','la.empid = e.empid')
						->where('la.empid',$empid)
						->where('e.office_code',$office)
						->order_by('application_dt','desc')
						->get()
						->row_array();
		return $res;
	}
	
	public function emp_leave_application($empid = 0){
		$post =  $this->input->post(array('name','desig','leave_basic_pay','section','group_nm','mbno','office_nm','leave_type','leave_dr_year','leave_from','leave_to','leave_day_no','half_cl','balance_leave', 'ground','admissibility','joining_dt','pre_from','pre_to','pre_desc','suff_from','suff_to','suff_desc','leave_address','last_leave_type','last_leave_from','last_leave_to','last_leave_joined_on','application_dt','link_file','block','recommendation','recom_date','recom_autho','recom_autho_desig','recom_autho_pan','sanction_desc','approve_date','sanction_autho','sanction_autho_desig','sanction_autho_pan', 'servicebk_record','servicebk_record_dt','leave_status'), TRUE);
		$post['empid'] = $empid;
//		$post['leave_dr_year'] = date('Y');
		$post['leave_dr_year'] = !empty($post['leave_from']) ? date('Y',strtotime($post['leave_from'])) : '';
		$post['leave_from'] = !empty($post['leave_from']) ? date('Y-m-d',strtotime($post['leave_from'])) : '';
		$post['leave_to'] = !empty($post['leave_to']) ? date('Y-m-d',strtotime($post['leave_to'])) : '';
		
		$post['balance_leave'] = $post['balance_leave']-$post['leave_day_no'];
		
		$post['joining_dt'] = !empty($post['joining_dt']) ? date('Y-m-d',strtotime($post['joining_dt'])) : '';
		$post['application_dt'] = !empty($post['application_dt']) ? date('Y-m-d',strtotime($post['application_dt'])) : '';	
		$post['last_leave_from'] = !empty($post['last_leave_from']) ? date('Y-m-d',strtotime($post['last_leave_from'])) : '';
		$post['last_leave_to'] = !empty($post['last_leave_to']) ? date('Y-m-d',strtotime($post['last_leave_to'])) : '';
		$post['last_leave_joined_on'] = !empty($post['last_leave_joined_on']) ? date('Y-m-d',strtotime($post['last_leave_joined_on'])) : '';
		$post['pre_from'] = !empty($post['pre_from']) ? date('Y-m-d',strtotime($post['pre_from'])) : '';
		$post['pre_to'] = !empty($post['pre_to']) ? date('Y-m-d',strtotime($post['pre_to'])) : '';
		$post['suff_from'] = !empty($post['suff_from']) ? date('Y-m-d',strtotime($post['suff_from'])) : '';
		$post['suff_to'] = !empty($post['suff_to']) ? date('Y-m-d',strtotime($post['suff_to'])) : '';
		$post['recom_date'] = !empty($post['recom_date']) ? date('Y-m-d',strtotime($post['recom_date'])) : '';
		$post['approve_date'] = !empty($post['approve_date']) ? date('Y-m-d',strtotime($post['approve_date'])) : '';
		$post['servicebk_record_dt'] = !empty($post['servicebk_record_dt']) ? date('Y-m-d',strtotime($post['servicebk_record_dt'])) : '';
/*
//-----------------		
		$recom_autho = explode('@@@',$post['recom_autho_pan']);
		$post['recom_autho'] = isset($recom_autho[0]) ? $recom_autho[0] : '';
		$post['recom_autho_desig'] = isset($recom_autho[1]) ? $recom_autho[1] : '';
		$post['recom_autho_pan'] = isset($recom_autho[2]) ? $recom_autho[2] : '';
		
		$sacn_autho = explode('@@@',$post['sanction_autho_pan']);
		$post['sanction_autho'] = isset($sacn_autho[0]) ? $sacn_autho[0] : '';
		$post['sanction_autho_desig'] = isset($sacn_autho[1]) ? $sacn_autho[1] : '';
		$post['sanction_autho_pan'] = isset($sacn_autho[2]) ? $sacn_autho[2] : '';
*/
//------------------		
		if($post['desig'] =='SR. ACCOUNTS OFFICER'||$post['desig'] =='ACCOUNTS OFFICER' ){
		$recom_autho = explode('@@@',$post['recom_autho_pan']);
			$post['recom_autho'] = '';
			$post['recom_autho_desig'] = '';
			$post['recom_autho_pan'] = '';
			$post['sanction_autho'] = isset($recom_autho[0]) ? $recom_autho[0] : '';
			$post['sanction_autho_desig'] = isset($recom_autho[1]) ? $recom_autho[1] : '';
			$post['sanction_autho_pan'] = isset($recom_autho[2]) ? $recom_autho[2] : '';
		}else{
		$recom_autho = explode('@@@',$post['recom_autho_pan']);
			$post['recom_autho'] = isset($recom_autho[0]) ? $recom_autho[0] : '';
			$post['recom_autho_desig'] = isset($recom_autho[1]) ? $recom_autho[1] : '';
			$post['recom_autho_pan'] = isset($recom_autho[2]) ? $recom_autho[2] : '';
		$sacn_autho = explode('@@@',$post['sanction_autho_pan']);
			$post['sanction_autho'] = isset($sacn_autho[0]) ? $sacn_autho[0] : '';
			$post['sanction_autho_desig'] = isset($sacn_autho[1]) ? $sacn_autho[1] : '';
			$post['sanction_autho_pan'] = isset($sacn_autho[2]) ? $sacn_autho[2] : '';
		}
//----------------		
		$post['leave_status'] = 'Submitted';
		$this->db->insert('employee_leave_debit',$post);		
		return $post['balance_leave'];
	}
	public function emp_cl_leave_deduction($empid = 0){
		$post =  $this->input->post(array('name','desig','leave_basic_pay','section','group_nm','mbno','office_nm','leave_type','ground','leave_dr_year','leave_day_no','balance_leave','sanction_desc','approve_date','sanction_autho','sanction_autho_desig','sanction_autho_pan','leave_status'), TRUE);
		$post['empid'] = $empid;
		$post['leave_dr_year'] = date('Y');	
		$post['balance_leave'] = $post['balance_leave']-$post['leave_day_no'];	
		$post['approve_date'] = date('Y-m-d');	
		$post['leave_status'] = 'Deducted';
		$post['joining_status'] = 'Not applicable';
		$post['servicebk_record'] = 'Not applicable';
		$this->db->insert('employee_leave_debit',$post);		
		return $post['balance_leave'];
	}
	
	public function emp_leave_current_balance($empid = 0, $leave_type = '', $balance = 0){
		$res = $this->db->select('bal.*')
						->from('employee_current_leave_balance bal ')
						->where('bal.empid',$empid)
						->where('bal.leave_type',$leave_type)
						->get()->row_array();
		if(!empty($res)){
			$this->db->where('empid',$empid)->where('leave_type',$leave_type)->update('employee_current_leave_balance',array('leave_cb'=>$balance));		
		}else{
			$this->db->insert('employee_current_leave_balance',array('empid'=>$empid,'leave_type'=>$leave_type,'leave_cb'=>$balance));		
		}
		return true;
	}
	public function emp_clrh_current_balance($empid = 0, $leave_type = '',$leave_cr_year, $balance = 0){
		$res = $this->db->select('bal.*')
						->from('employee_leave_credit bal ')
						->where('bal.empid',$empid)
						->where('bal.leave_type',$leave_type)
						->where('bal.leave_cr_year',$leave_cr_year)
						->get()->row_array();
		if(!empty($res)){
			$this->db->where('empid',$empid)->where('leave_type',$leave_type)->where('leave_cr_year',$leave_cr_year)->update('employee_leave_credit',array('leave_cb'=>$balance));			
		}
		return true;
	}


	public function emp_leave_credit_balance($empid = '', $leave_type = '', $credit_balance = 0){
		$res = $this->db->select('bal.*')
						->from('employee_current_leave_balance bal ')
						->where('bal.empid',$empid)
						->where('bal.leave_type',$leave_type)
						->get()->row_array();
// adding credit and current balance		
		if($leave_type == "Earned Leave" && $res['leave_cb']>300){
				$current_balance = 300 + $credit_balance;
			}else{
				if($leave_type == "Casual Leave" || $leave_type == "Restricted Holiday"){
					$current_balance=$credit_balance;
				}else{
					$current_balance=($res['leave_cb'] ?? 0 )+ $credit_balance;
				}
			}
// inserting or updating 		
		if(!empty($res)){
			$this->db->where('empid',$empid)->where('leave_type',$leave_type)->update('employee_current_leave_balance',array('leave_cr'=>$credit_balance, 'leave_cb'=>$current_balance ));	
		}else{
			$this->db->insert('employee_current_leave_balance',array('empid'=>$empid,'leave_type'=>$leave_type,'leave_cr'=>$credit_balance,'leave_cb'=>$current_balance));		
		}
		return true;
	}
	
	public function emp_leave_precredit_balance($empid = '', $leave_type = '', $cr_from_date = ''){
		$res = $this->db->select('no_days')
						->from('employee_leave_credit')
						->where('empid',$empid)
						->where('leave_type',$leave_type)
						->where('cr_from_date',$cr_from_date)
						->get()
						->row_array();
			if(!empty($res)){
				return $res['no_days'];
			}
		return 0;
	}
	
	public function emp_leave_credit_balance_update($empid = '', $leave_type = '', $credit_balance = 0,$pre_credit = 0){
		$res = $this->db->select('bal.*')
						->from('employee_current_leave_balance bal ')
						->where('bal.empid',$empid)
						->where('bal.leave_type',$leave_type)
						->get()->row_array();

		$leave_last_balance = ($res['leave_cb'] ?? 0 );
		$leave_cb = $leave_last_balance - $pre_credit;
		
		if($leave_type == "Earned Leave" && $leave_cb > 300){
			$current_balance = 300 + $credit_balance ;
			}else{
				if($leave_type == "Casual Leave" || $leave_type == "Restricted Holiday"){
					$current_balance=$credit_balance;
				}else{	
					$current_balance  = $leave_cb + $credit_balance;
				}		
			}

		if(!empty($res)){
			$this->db->where('empid',$empid)->where('leave_type',$leave_type)->update('employee_current_leave_balance',array('leave_cb'=>$current_balance ));
// before credit last balance is kept in the "leave_cb" field of "employee_leave_credit" table
			$this->db->where('empid',$empid)->where('leave_type',$leave_type)->update('employee_leave_credit',array('leave_cb'=>$leave_last_balance));
		}else{
			$this->db->insert('employee_current_leave_balance',array('empid'=>$empid,'leave_type'=>$leave_type,'leave_cr'=>$credit_balance,'leave_cb'=>$current_balance));		
		}
		return true;
	}	

	
	public function emp_leave_upload_balance($empid = 0, $leave_type = '', $up_balance = 0){
		$res = $this->db->select('bal.*')
						->from('employee_current_leave_balance bal ')
						->where('bal.empid',$empid)
						->where('bal.leave_type',$leave_type)
						->get()->row_array();
		
		if($leave_type == "Earned Leave" && $up_balance>315){
			$up_balance=315;
		}else{
			$up_balance=$up_balance;
		}
		
		if(!empty($res)){
			$this->db->where('empid',$empid)->where('leave_type',$leave_type)->update('employee_current_leave_balance',array('leave_cb'=>$up_balance));	
		}else{
			$this->db->insert('employee_current_leave_balance',array('empid'=>$empid,'leave_type'=>$leave_type,'leave_cb'=>$up_balance));		
		}
		return true;
	}
	public function fetch_employee_leave_application_leave_type($empid = 0,$id = ''){
		$res = $this->db->select('la.*')
						->from('employee_leave_debit la')
						->where('la.empid',$empid)
						->where('la.leav_id',$id)
						->order_by('application_dt','desc')
						->get()
						->row_array();
		if(!empty($res)){
				return $res['leave_type'];
			}
		return 0;
	}
	public function fetch_employee_leave_application_leave_year($empid = 0,$id = ''){
		$res = $this->db->select('la.*')
						->from('employee_leave_debit la')
						->where('la.empid',$empid)
						->where('la.leav_id',$id)
						->order_by('application_dt','desc')
						->get()
						->row_array();
		if(!empty($res)){
				return $res['leave_dr_year'];
			}
		return 0;
	}	
	
	public function fetch_employee_leave_application($empid = 0,$id = ''){
		$res = $this->db->select('la.*')
						->from('employee_leave_debit la')
						->where('la.empid',$empid)
						->where('la.leav_id',$id)
						->order_by('application_dt','desc')
						->get()
						->row_array();
		return $res;
	}	
	public function fetch_employee_clrh_sanction($empid = 0,$id = ''){
		$res = $this->db->select('la.*')
						->from('employee_leave_debit la')
						->where('la.sanction_autho_pan',$empid)
						->where('la.leav_id',$id)
						->order_by('application_dt','desc')
						->get()
						->row_array();
		return $res;
	}	
	public function fetch_employee_leave_application_reco($empid = 0,$id = ''){
		$res = $this->db->select('la.*')
						->from('employee_leave_debit la')
						->where('la.recom_autho_pan',$empid)
						->where('la.leav_id',$id)
						->order_by('application_dt','desc')
						->get()
						->row_array();
		return $res;
	}
	public function fetch_employee_leave_application_sanction($empid = 0,$id = ''){
		$res = $this->db->select('la.*')
						->from('employee_leave_debit la')
						->where('la.sanction_autho_pan',$empid)
						->where('la.leav_id',$id)
						->order_by('application_dt','desc')
						->get()
						->row_array();
		return $res;
	}
	public function fetch_employee_joining_application($empid = 0,$id = ''){
		$res = $this->db->select('la.*')
						->from('employee_leave_debit la')
						->where('la.joining_autho_pan',$empid)
						->where('la.leav_id',$id)
						->order_by('application_dt','desc')
						->get()
						->row_array();
		return $res;
	}	
	
	public function emp_leave_application_sanction($empid = 0){
		$post =  $this->input->post(array('name','desig','leave_basic_pay','section','group_nm','office_nm','leave_type','leave_from','leave_to','leave_day_no','balance_leave','ground','admissibility','joining_dt','pre_from','pre_to','pre_desc','suff_from','suff_to','suff_desc','leave_address','application_dt','last_leave_type','last_leave_from','last_leave_to','last_leave_joined_on','recom_autho','recom_autho_desig','recom_autho_pan','recommendation','recom_date','sanction_autho','sanction_autho_desig','sanction_autho_pan','sanction_desc','approve_date','leave_status'), TRUE);
		$post['empid'] = $empid;
		$post['leave_from'] = !empty($post['leave_from']) ? date('Y-m-d',strtotime($post['leave_from'])) : '';
		$post['leave_to'] = !empty($post['leave_to']) ? date('Y-m-d',strtotime($post['leave_to'])) : '';
		$post['joining_dt'] = !empty($post['joining_dt']) ? date('Y-m-d',strtotime($post['joining_dt'])) : '';
		$post['application_dt'] = !empty($post['application_dt']) ? date('Y-m-d',strtotime($post['application_dt'])) : '';	
		$post['last_leave_from'] = !empty($post['last_leave_from']) ? date('Y-m-d',strtotime($post['last_leave_from'])) : '';
		$post['last_leave_to'] = !empty($post['last_leave_to']) ? date('Y-m-d',strtotime($post['last_leave_to'])) : '';
		$post['last_leave_joined_on'] = !empty($post['last_leave_joined_on']) ? date('Y-m-d',strtotime($post['last_leave_joined_on'])) : '';
		$post['recom_date'] = !empty($post['recom_date']) ? date('Y-m-d',strtotime($post['recom_date'])) : '';
		$post['approve_date'] = !empty($post['approve_date']) ? date('Y-m-d',strtotime($post['approve_date'])) : '';
		$this->db->insert('employee_leave_debit',$post);
		return true;
	}
	
	
//----loan application
	
	public function get_employee_loan_application($empid = 0,$office = 'AGAE'){
		$res = $this->db->select('la.*')
						->from('employee_loan la')
						->join('employee_master e','la.empid = e.empid')
						->where('la.empid',$empid)
						->where('e.office_code',$office)
						->order_by('applied_on','desc')
						->get()
						->row_array();
		return $res;
	}
	
	public function emp_loan_application($empid = 0){
		$post =  $this->input->post(array('name','desig','emp_section','group_nm','office_nm','basic_pay','loan_type','interest_type','description','loan_amount','installment_no','interest','paid_loan_amount','loan_order_no','order_date','bill_no'), TRUE);
		$post['empid'] = $empid;
		$post['order_date'] = !empty($post['order_date']) ? date('Y-m-d',strtotime($post['order_date'])) : '';
		$this->db->insert('employee_loan',$post);
		return true;
	}
	
	//----encashment application
	
	public function get_employee_encashment_application($empid = 0,$office = 'AGAE'){
		$res = $this->db->select('le.*')
						->from('employee_leave_encashment le')
						->join('employee_master e','le.empid = e.empid')
						->where('le.empid',$empid)
						->where('e.office_code',$office)
						->order_by('encash_order_date','desc')
						->get()
						->row_array();
		return $res;
	}
	
	public function emp_encashment_application($empid = 0){
		$post =  $this->input->post(array('name','desig','emp_section','group_nm','office_nm','basic_pay','description','ltc_htc','encashment_no','leave_type','from_date','to_date','leave_for','no_days_encash','el_credit','encash_order_no','encash_order_date','da_rate','bill_no','bill_date','status'), TRUE);
		$post['empid'] = $empid;
		$post['from_date'] = !empty($post['from_date']) ? date('Y-m-d',strtotime($post['from_date'])) : '';
		$post['to_date'] = !empty($post['to_date']) ? date('Y-m-d',strtotime($post['to_date'])) : '';
		$post['encash_order_date'] = !empty($post['encash_order_date']) ? date('Y-m-d',strtotime($post['encash_order_date'])) : '';
		$post['bill_date'] = !empty($post['bill_date']) ? date('Y-m-d',strtotime($post['bill_date'])) : '';
		$this->db->insert('employee_leave_encashment',$post);
		return true;
	}
//----test application
	
	public function get_test_application($empid = 0,$office = 'AGAE'){
		$res = $this->db->select('ta.*')
						->from('test_application ta')
						->join('employee_master e','ta.empid = e.empid')
						->where('ta.empid',$empid)
						->where('e.office_code',$office)
						->order_by('upload_dt','desc')
						->get()
						->row_array();
		return $res;
	}
	
	public function emp_test_application($empid = 0){
		$post =  $this->input->post(array('name','desig','office','description','date',), TRUE);
		$post['empid'] = $empid;
		$post['date'] = !empty($post['date']) ? date('Y-m-d',strtotime($post['date'])) : '';
		$this->db->insert('test_application',$post);
		return true;
	}


//----bill submit	
	
	public function get_employee_bill_submit($empid = 0,$office = 'AGAE'){
		$res = $this->db->select('bl.*')
						->from('employee_bills bl')
						->join('employee_master e','bl.empid = e.empid')
						->where('bl.empid',$empid)
						->where('e.office_code',$office)
						->order_by('applied_on','desc')
						->get()
						->row_array();
		return $res;
	}
	
	public function emp_bill_submit($empid = 0){
		$post =  $this->input->post(array('name','desig','emp_section','group_nm','office_nm','basic_pay','bill_type','description','bill_no','bill_date','bill_amount','advance_bill_no','from_date','to_date','block','child_no','child_select','location','treatment_type','doctor','fit_unfit','amount_paid','payment_date'), TRUE);
		$post['empid'] = $empid;
		$post['bill_date'] = !empty($post['bill_date']) ? date('Y-m-d',strtotime($post['bill_date'])) : '';
		$post['from_date'] = !empty($post['from_date']) ? date('Y-m-d',strtotime($post['from_date'])) : '';
		$post['to_date'] = !empty($post['to_date']) ? date('Y-m-d',strtotime($post['to_date'])) : '';
		$post['payment_date'] = !empty($post['payment_date']) ? date('Y-m-d',strtotime($post['payment_date'])) : '';
		$this->db->insert('employee_bills',$post);
		return true;
	}
	
	
//-----Leave details
	public function get_employee_leave_credited($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('employee_leave_credit')
				 ->order_by('leavcr_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('empid',$get['search']);
				$this->db->or_like('leave_type',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function leave_credits($id=0){
		return  $this->db->select('*')
						 ->from('employee_leave_credit')
						 ->where('leavcr_id',$id)
						 ->get()
						 ->row_array();
	}
	
	public function update_employee_leave_credit($id=0){
		$post = $this->input->post(array('empid','leave_cr_year','leave_type','cr_from_date','cr_to_date','no_days','credit_date'), TRUE);
		$update = array();
		$update['empid'] = $post['empid'];
		$update['leave_cr_year'] = date('Y');
		$update['leave_type'] = $post['leave_type'];
		$update['cr_from_date'] = $post['cr_from_date'];
		$update['cr_to_date'] = $post['cr_to_date'];
		$update['no_days'] = $post['no_days'];
		$update['credit_date'] = $post['credit_date'];
		
		if(!empty($update) && $id != ''){
			$this->db->where('leavcr_id',$id)->update('employee_leave_credit',$update);
		}
	}
	
	public function employee_leave_debit_list($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('employee_leave_debit')
				 ->order_by('leav_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('empid',$get['search'])
						 ->or_like('name',$get['search'])
						 ->or_like('group_nm ',$get['search'])
						 ->or_like('section',$get['search'])
						 ->or_like('leave_type',$get['search'])
						 ->or_like('servicebk_record',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function leave_debits($id=0){
		return  $this->db->select('*')
						 ->from('employee_leave_debit')
						 ->where('leav_id',$id)
						 ->get()
						 ->row_array();
	}
	
	public function update_employee_leave_debit($id=0,$empid = 0){
		$post = $this->input->post(array('desig','leave_basic_pay','section','group_nm','office_nm','leave_dr_year','leave_type','leave_from','leave_to','leave_day_no','ground','admissibility','joining_dt','pre_from','pre_to','pre_desc','suff_from','suff_to','suff_desc','leave_address','block','application_dt','link_file','approve_date','last_leave_type','last_leave_from','last_leave_to','last_leave_joined_on','recom_autho','recom_autho_desig','recom_autho_pan','sanction_autho','sanction_autho_desig','sanction_autho_pan','leave_status'), TRUE);
		$update = array();
		$update['desig'] = $post['desig'];
		$update['leave_basic_pay'] = $post['leave_basic_pay'];
		$update['section'] = $post['section'];
		$update['group_nm'] = $post['group_nm'];
		$update['office_nm'] = $post['office_nm'];
		$update['leave_dr_year'] = date('Y');
		$update['leave_type'] = $post['leave_type'];
		$update['leave_from'] = !empty($post['leave_from']) ? date('Y-m-d',strtotime($post['leave_from'])) : '';
		$update['leave_to'] = !empty($post['leave_to']) ? date('Y-m-d',strtotime($post['leave_to'])) : '';
		
		if($post['leave_status'] == 'Cancelled'){
			$update['balance_leave'] = $update['balance_leave']+$update['leave_day_no'];
			$update['leave_day_no'] =0;
		}
		else{
			//$update['leave_day_no'] = $post['leave_day_no'];
		}
		
		$update['ground'] = $post['ground'];
		$update['admissibility'] = $post['admissibility'];
		$update['joining_dt'] = !empty($post['joining_dt']) ? date('Y-m-d',strtotime($post['joining_dt'])) : '';
//		$update['joining_dt'] = $post['joining_dt'];
		$update['pre_from'] = !empty($post['pre_from']) ? date('Y-m-d',strtotime($post['pre_from'])) : '';
		$update['pre_to'] = !empty($post['pre_to']) ? date('Y-m-d',strtotime($post['pre_to'])) : '';
		$update['pre_desc'] = $post['pre_desc'];
		$update['suff_from'] = !empty($post['suff_from']) ? date('Y-m-d',strtotime($post['suff_from'])) : '';
		$update['suff_to'] = !empty($post['suff_to']) ? date('Y-m-d',strtotime($post['suff_to'])) : '';
		$update['suff_desc'] = $post['suff_desc'];
		$update['leave_address'] = $post['leave_address'];
		$update['block'] = $post['block'];
		$update['application_dt'] = !empty($post['application_dt']) ? date('Y-m-d',strtotime($post['application_dt'])) : '';
		$update['link_file'] = $post['link_file'];
		$update['approve_date'] = !empty($post['approve_date']) ? date('Y-m-d',strtotime($post['approve_date'])) : '';
		$update['last_leave_type'] = $post['last_leave_type'];
		$update['last_leave_from'] = !empty($post['last_leave_from']) ? date('Y-m-d',strtotime($post['last_leave_from'])) : '';
		$update['last_leave_to'] = !empty($post['last_leave_to']) ? date('Y-m-d',strtotime($post['last_leave_to'])) : '';
		$update['last_leave_joined_on'] = !empty($post['last_leave_joined_on']) ? date('Y-m-d',strtotime($post['last_leave_joined_on'])) : '';
		
		$update['last_leave_joined_on'] = $post['last_leave_joined_on'];
		
		if($update['desig'] =='SR. ACCOUNTS OFFICER'||$update['desig'] =='ACCOUNTS OFFICER' ){
		$recom_autho = explode('@@@',$post['recom_autho_pan']);
			$update['recom_autho'] = '';
			$update['recom_autho_desig'] = '';
			$update['recom_autho_pan'] = '';
			$update['sanction_autho'] = isset($recom_autho[0]) ? $recom_autho[0] : '';
			$update['sanction_autho_desig'] = isset($recom_autho[1]) ? $recom_autho[1] : '';
			$update['sanction_autho_pan'] = isset($recom_autho[2]) ? $recom_autho[2] : '';
		}else{
		$recom_autho = explode('@@@',$post['recom_autho_pan']);
			$update['recom_autho'] = isset($recom_autho[0]) ? $recom_autho[0] : '';
			$update['recom_autho_desig'] = isset($recom_autho[1]) ? $recom_autho[1] : '';
			$update['recom_autho_pan'] = isset($recom_autho[2]) ? $recom_autho[2] : '';
		$sacn_autho = explode('@@@',$post['sanction_autho_pan']);
			$update['sanction_autho'] = isset($sacn_autho[0]) ? $sacn_autho[0] : '';
			$update['sanction_autho_desig'] = isset($sacn_autho[1]) ? $sacn_autho[1] : '';
			$update['sanction_autho_pan'] = isset($sacn_autho[2]) ? $sacn_autho[2] : '';
		}

		if($post['leave_status'] != null){
			$update['leave_status'] = $post['leave_status'];
		}
				
		if(!empty($update) && $id != ''){
			$this->db->where('leav_id',$id)->where('empid',$empid)->update('employee_leave_debit',$update);	
		}
		
		$res = $this->db->select('balance_leave')->from('employee_leave_debit')->where('leav_id',$id)->where('empid',$empid)->get()->row_array();
		if(!empty($res)){
			return $res['balance_leave'];
		}
		return 0;
	}

	
	public function update_leave_application_recommendation($id=0,$empid = 0){
		$post = $this->input->post(array('recommendation','recom_date','sanction_autho','sanction_autho_desig','sanction_autho_pan','leave_status'), TRUE);
		$update = array();

		$update['recommendation'] = $post['recommendation'];
		$update['recom_date'] = !empty($post['recom_date']) ? date('Y-m-d',strtotime($post['recom_date'])) : '';
		
		if($update['desig'] =='SR. ACCOUNTS OFFICER'||$update['desig'] =='ACCOUNTS OFFICER' ){
		$recom_autho = explode('@@@',$post['recom_autho_pan']);
			$update['sanction_autho'] = isset($recom_autho[0]) ? $recom_autho[0] : '';
			$update['sanction_autho_desig'] = isset($recom_autho[1]) ? $recom_autho[1] : '';
			$update['sanction_autho_pan'] = isset($recom_autho[2]) ? $recom_autho[2] : '';
		}else{
		$sacn_autho = explode('@@@',$post['sanction_autho_pan']);
			$update['sanction_autho'] = isset($sacn_autho[0]) ? $sacn_autho[0] : '';
			$update['sanction_autho_desig'] = isset($sacn_autho[1]) ? $sacn_autho[1] : '';
			$update['sanction_autho_pan'] = isset($sacn_autho[2]) ? $sacn_autho[2] : '';
		}
		
		if($post['leave_status'] != null){
			$update['leave_status'] = $post['leave_status'];
		}
				
		if(!empty($update) && $id != ''){
			$this->db->where('leav_id',$id)->where('empid',$empid)->update('employee_leave_debit',$update);	
		}
		
		$res = $this->db->select('balance_leave')->from('employee_leave_debit')->where('leav_id',$id)->where('empid',$empid)->get()->row_array();
		if(!empty($res)){
			return $res['balance_leave'];
		}
		return 0;
	}
	public function update_leave_application_sanction($id=0,$empid = 0){
		$post = $this->input->post(array('sanction_desc','approve_date','leave_status','servicebk_record'), TRUE);
		$update = array();

		$update['sanction_desc'] = $post['sanction_desc'];
		$update['approve_date'] = !empty($post['approve_date']) ? date('Y-m-d',strtotime($post['approve_date'])) : '';
		if($post['leave_status'] != null){
			$update['leave_status'] = $post['leave_status'];
		}
		if($post['leave_status'] == 'Sanctioned'){
			$update['servicebk_record'] = 'Pending';
		}	
		
		if(!empty($update) && $id != ''){
			$this->db->where('leav_id',$id)->where('empid',$empid)->update('employee_leave_debit',$update);	
		}
		
		$res = $this->db->select('balance_leave')->from('employee_leave_debit')->where('leav_id',$id)->where('empid',$empid)->get()->row_array();
		if(!empty($res)){
			return $res['balance_leave'];
		}
		return 0;
	}
	
	public function leave_application_servicebook_entry($id=0,$empid = 0){
		$post = $this->input->post(array('servicebk_record','servicebk_record_dt'), TRUE);
		$update = array();

		$update['servicebk_record'] = $post['servicebk_record'];
		$update['servicebk_record_dt'] = !empty($post['servicebk_record_dt']) ? date('Y-m-d',strtotime($post['servicebk_record_dt'])) : '';
		
		if(!empty($update) && $id != ''){
			$this->db->where('leav_id',$id)->where('empid',$empid)->update('employee_leave_debit',$update);	
		}
		
		$res = $this->db->select('balance_leave')->from('employee_leave_debit')->where('leav_id',$id)->where('empid',$empid)->get()->row_array();
		if(!empty($res)){
			return $res['balance_leave'];
		}
		return 0;
	}
	
	public function update_joining_date($id=0){
		$post = $this->input->post(array('joining_dt','joining_apply_dt','fore_after_noon','joining_autho','joining_autho_desig','joining_autho_pan','joining_status'), TRUE);
		$update = array();
		
		$update['joining_dt'] = !empty($post['joining_dt']) ? date('Y-m-d',strtotime($post['joining_dt'])) : '';
		$update['joining_apply_dt'] = !empty($post['joining_apply_dt']) ? date('Y-m-d',strtotime($post['joining_apply_dt'])) : '';
		$update['fore_after_noon'] = $post['fore_after_noon'];
		$joining_autho = explode('@@@',$post['joining_autho_pan']);
		if(count($joining_autho) == 3){
			$update['joining_autho'] = isset($joining_autho[0]) ? $joining_autho[0] : '';
			$update['joining_autho_desig'] = isset($joining_autho[1]) ? $joining_autho[1] : '';
			$update['joining_autho_pan'] = isset($joining_autho[2]) ? $joining_autho[2] : '';
		}
		$update['joining_status'] = 'Submitted';
		$update['servicebk_record'] = 'Pending';
		if(!empty($update) && $id != ''){
			$this->db->where('leav_id',$id)->update('employee_leave_debit',$update);
		}
	}
	public function update_joining_sanction($id=0){
		$post = $this->input->post(array('joining_desc','joining_approval_dt','joining_status'), TRUE);
		$update = array();
		
		$update['joining_desc'] = $post['joining_desc'];
		$update['joining_approval_dt'] = !empty($post['joining_approval_dt']) ? date('Y-m-d',strtotime($post['joining_approval_dt'])) : '';
		$update['joining_status'] = $post['joining_status'];
		$update['servicebk_record'] = 'Pending';
		if(!empty($update) && $id != ''){
			$this->db->where('leav_id',$id)->update('employee_leave_debit',$update);
		}
	}

    public function employee_leave_balance_list($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('e.*,lb.*')
				 ->from('employee_leave_balance lb')
				 ->join('employee_master e','e.empid = lb.empid')
				 ->order_by('as_on','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('lb.empid',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function employee_current_leave_balance_list($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('e.empid,e.empname,e.desig,lb.leave_type,lb.leave_cb')
				 ->from('employee_current_leave_balance lb')
				 ->join('employee_master e','e.empid = lb.empid')
				 ->order_by('e.empid','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('lb.empid',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function employee_leave_balances($id=0){
		return  $this->db->select('*')
						 ->from('employee_leave_balance')
						 ->where('leavb_id',$id)
						 ->get()
						 ->row_array();
	}
	public function update_employee_leave_balances($id=0){
		$post = $this->input->post(array('empid','leave_type','as_on','leave_ob','leave_cr','leave_dr','leave_cb'), TRUE);
		$update = array();
		$update['empid'] = $post['empid'];
		$update['leave_type'] = $post['leave_type'];
		$update['as_on'] = $post['as_on'];
		$update['leave_ob'] = $post['leave_ob'];
		$update['leave_cr'] = $post['leave_cr'];
		$update['leave_dr'] = $post['leave_dr'];
		$update['leave_cb'] = $post['leave_cb'];
		
		if(!empty($update) && $id != ''){
			$this->db->where('leavb_id',$id)->update('employee_leave_balance',$update);
		}
	}
		public function update_employee_clrh_debit($id=0){
		$post = $this->input->post(array('mbno','leave_dr_year','leave_type','leave_from','leave_to','leave_day_no','balance_leave','half_cl','ground','leave_address','application_dt','sanction_autho','sanction_autho_desig','sanction_autho_pan','leave_status'), TRUE);
		$update = array();
		$update['mbno'] = $post['mbno'];
//		$update['leave_dr_year'] = date('Y');
		$update['leave_dr_year'] = !empty($post['leave_from']) ? date('Y',strtotime($post['leave_from'])) : '';
		$update['leave_type'] = $post['leave_type'];
		$update['leave_from'] = !empty($post['leave_from']) ? date('Y-m-d',strtotime($post['leave_from'])) : '';
		$update['leave_to'] = !empty($post['leave_to']) ? date('Y-m-d',strtotime($post['leave_to'])) : '';
		$update['balance_leave'] = $post['balance_leave']-$post['leave_day_no'];
		
		if($post['leave_status'] == 'Cancelled'){
			$update['leave_day_no'] = 0;
		}
		else{
			$update['leave_day_no'] = $post['leave_day_no'];
		}
		$update['half_cl'] = $post['half_cl'];
		$update['ground'] = $post['ground'];
		$update['leave_address'] = $post['leave_address'];
		$update['application_dt'] = !empty($post['application_dt']) ? date('Y-m-d',strtotime($post['application_dt'])) : '';
		
		$sacn_autho = explode('@@@',$post['sanction_autho_pan']);
		if(count($sacn_autho) == 3){
			$update['sanction_autho'] = isset($sacn_autho[0]) ? $sacn_autho[0] : '';
			$update['sanction_autho_desig'] = isset($sacn_autho[1]) ? $sacn_autho[1] : '';
			$update['sanction_autho_pan'] = isset($sacn_autho[2]) ? $sacn_autho[2] : '';
		}

		if($post['leave_status'] != null){
			$update['leave_status'] = $post['leave_status'];
		}

		if(!empty($update) && $id != ''){
			$this->db->where('leav_id',$id)->update('employee_leave_debit',$update);
		}
	}
	public function emp_leave_sanction_clrh($id=0){
		$post =  $this->input->post(array('sanction_desc','approve_date','leave_status'), TRUE);
		$update = array();
		$update['sanction_desc'] = $post['sanction_desc'];
		$update['approve_date'] = !empty($post['approve_date']) ? date('Y-m-d',strtotime($post['approve_date'])) : '';
		$update['leave_status'] = $post['leave_status'];
		$update['joining_status'] = 'Not applicable';
		$update['servicebk_record'] = 'Not applicable';
		
		
		if(!empty($update) && $id != ''){
			$this->db->where('leav_id',$id)->update('employee_leave_debit',$update);
		}
	}
//--------for employee panel

	public function get_employee_leave_debit($empid = '',$leave_type=''){
		$res = $this->db->select('*')
						->from('employee_leave_debit ld')
						->where('ld.empid',$empid)
						->where('ld.leave_type',$leave_type)
						->order_by('leave_from','desc')
						->get()
						->result_array();
		return $res;
	}
	public function get_employee_clrh_debit($empid = '',$leave_type='',$leave_dr_year=''){
//		$leave_dr_year=Date('Y');
		$res = $this->db->select('*')
						->from('employee_leave_debit ld')
						->where('ld.empid',$empid)
						->where('ld.leave_type',$leave_type)
						->where('ld.leave_dr_year',$leave_dr_year)
						->order_by('leave_from','desc')
						->get()
						->result_array();
		return $res;
	}
	
	
	public function get_leave_pending_clrh($empid = '',$leave_type='',$leave_dr_year=''){
		$res = $this->db->select('ld.*')
						->from('employee_leave_debit ld')
						->where('ld.sanction_autho_pan',$empid)
						->where('ld.leave_type',$leave_type)
						->where('ld.leave_dr_year',$leave_dr_year)
						->like('ld.leave_status','Submitted')
//						->order_by('leave_status','asc')
						->order_by('application_dt','desc')
						->get()
						->result_array();
		return $res;
	}

	public function get_leave_pending_recommendaton($empid = '',$leave_type=''){
		$res = $this->db->select('*')
						->from('employee_leave_debit ld')
						->where('ld.recom_autho_pan',$empid)
						->where('ld.leave_type',$leave_type)
//						->like('ld.leave_status','Submitted')
//						->or_like('ld.leave_status','Recommended')
						->order_by('leave_status','asc')
						->order_by('application_dt','desc')
						->get()
						->result_array();
		return $res;
	}

	public function get_leave_pending_recommendaton_all ($limit_to = 0,$empid = ''){
		$get = $this->input->get(array('leave_type'), TRUE);
		$this->db->select('ld.*')
				 ->from('employee_leave_debit ld')
				 ->where('ld.recom_autho_pan',$empid);
	
		if($get['leave_type'] != ''){
			$this->db->where('ld.leave_type',$get['leave_type']);
		}
		$this->db->order_by('application_dt','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}	


	public function get_leave_pending_sanction($empid = '',$leave_type=''){
		$res = $this->db->select('ld.*')
						->from('employee_leave_debit ld')						
						->where('ld.sanction_autho_pan',$empid)
						->where('ld.leave_type',$leave_type)
						->like('ld.leave_status','Recommended')
//						->or_like('ld.leave_status','Submitted')
						->order_by('leave_status','asc')
						->order_by('application_dt','desc')
						->get()
						->result_array();
		return $res;
	}
	
		public function get_leave_pending_sanction_all ($limit_to = 0,$empid = ''){
		$get = $this->input->get(array('leave_type'), TRUE);
		$this->db->select('ld.*')
				 ->from('employee_leave_debit ld')
				 ->like('ld.leave_status','Recommended')
				 ->or_like('ld.leave_status','Submitted')
				 ->where('ld.sanction_autho_pan',$empid);
	
		if($get['leave_type'] != ''){
			$this->db->where('ld.leave_type',$get['leave_type']);
		}
		$this->db->order_by('application_dt','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function get_leave_pending_joining($empid = '',$leave_type=''){
		$res = $this->db->select('ld.*')
						->from('employee_leave_debit ld')
						->where('ld.joining_autho_pan',$empid)
						->where('ld.leave_type',$leave_type)
						->where('ld.leave_status','Sanctioned')
//						->where('ld.joining_status','Pending')
						->order_by('leave_status','asc')
						->order_by('application_dt','desc')
						->get()
						->result_array();
		return $res;
	}
	
	public function get_employee_leave_credit($empid = '',$leave_type=''){
		$res = $this->db->select('lc.*')
						->from('employee_leave_credit lc')
						->where('lc.empid',$empid)
						->where('lc.leave_type',$leave_type)
						->order_by('lc.cr_from_date','desc')
						->get()
						->result_array();
		return $res;
	}
	
	public function get_employee_clrh_credit($empid = '',$leave_type='',$leave_cr_year=''){
//		$leave_cr_year= Date('Y');
		$res = $this->db->select('lc.*')
						->from('employee_leave_credit lc')
						->where('lc.empid',$empid)
						->where('lc.leave_type',$leave_type)
						->where('lc.leave_cr_year',$leave_cr_year)
						->order_by('lc.cr_from_date','desc')
						->get()
						->result_array();
		return $res;
	}
	public function get_employee_leave_balance($empid = '', $leave_type=''){
		return  $this->db->select('lb.*')
						 ->from('employee_leave_balance lb')
						 ->where('lb.empid',$empid)
						 ->where('lb.leave_type',$leave_type)
						 ->order_by('as_on','desc')
						 ->get()
						 ->result_array();
	}
	
	public function get_leave_current_balance($empid = '',$leave_type=''){
		return  $this->db->select('lb.*')
						 ->from('employee_current_leave_balance lb')
						 ->where('lb.empid',$empid)
						 ->where('lb.leave_type',$leave_type)
//						 ->order_by('as_on','desc')
						 ->get()
						 ->result_array();
	}
	public function get_clrh_closing_balance($empid = '',$leave_type='',$leave_cr_year){
		return  $this->db->select('lc.*')
						 ->from('employee_leave_credit lc')
						 ->where('lc.empid',$empid)
						 ->where('lc.leave_type',$leave_type)
						 ->where('lc.leave_cr_year',$leave_cr_year)
//						 ->order_by('as_on','desc')
						 ->get()
						 ->result_array();
	}
	
	public function get_employee_leave_encashment($empid = '',$status = '' ){
		$res = $this->db->select('lc.*')
						->from('employee_leave_encashment lc')
						->where('lc.empid',$empid)
						->where('lc.status',$status)
						->order_by('lc.encash_order_date','desc')
						->get()
						->result_array();
		return $res;
	}
	public function get_employee_bill_detail($empid = '',$bill_type=''){
		$res = $this->db->select('bd.*')
						->from('employee_bills bd')
						->where('bd.empid',$empid)
						->where('bill_type',$bill_type)
						->order_by('bill_date','desc')
						->get()
						->result_array();
		return $res;
	}
	
	public function getTrainingPrgByID($id,$office='AGAE'){
		$get = $this->input->get(array('search'), TRUE);
		return $this->db->select('*')
				->from('training_master')
				->where('trang_id',$id)
//				->where('office',$office)
				->get()->
				row_array();
	}
	
	public function getTrainingPrgToEmployees($id){
		$res =  $this->db->select('group_concat(empid) as emp_ids')
		     ->from('training_to_employee')
			 ->where('trg_emp_id',$id)
			 ->get()->row_array();
		return !empty($res) ? explode(',',$res['emp_ids']) : array();
	}
	
	
	public function add_training_to_employee($id,$emp_concerned){
		if(is_array($emp_concerned)){
			$email = '';
			foreach($emp_concerned as $empid=>$mobile){
				send_TSMS($mobile); // from helper
				$this->db->insert('training_to_employee',array('training_id'=>$id,'empid'=>$empid));
			}
		}
	}
	
	public function update_training_to_employee($id,$emp_concerned){
		if(is_array($emp_concerned)){
			$this->db->where('training_id',$id)->delete('training_to_employee');
			foreach($emp_concerned as $empid=>$mobile){
				send_TSMS($mobile); // from helper
				$this->db->insert('training_to_employee',array('training_id'=>$id,'empid'=>$empid));
			}
		}
	}
	
	public function emp_training_details_record($empid = 0, $training_id = ''){
// sql 1	
		$res1 = $this->db->select('*')
						 ->from('employee_master')->where('empid',$empid)
						 ->get()
						 ->row_array();
		if(empty($res1)){
			return array($res1);
		}
//print_r ($this->db->last_query());

// sql 2	
		$res2 = $this->db->select('*')
						 ->from('training_master')
						 ->where('trang_id',$training_id)
						 ->get()->row_array();
		if(empty($res2)){
			return array($res2);
		}
//print_r ($this->db->last_query());

//merge sql 1 and sql 2		
		$res = array_merge($res1,$res2);
//insert into table	
				$this->db->insert('employee_training',array('training_id'=>$training_id,'fin_year'=>$res['fin_year'],'training_type'=>$res['training_type'],'training_order'=>$res['training_order'],
				'order_date'=>$res['order_date'],'title'=>$res['title'],'description'=>$res['description'],'location'=>$res['location'],'training_from'=>$res['training_from'],'training_to'=>$res['training_to'],
				'training_days'=>$res['training_days'],'training_assign_dt'=>$res['training_assign_dt'],
				'empid'=>$empid,'name'=>$res['empname'],'desig'=>$res['desig'],'group_nm'=>$res['group_name'],'emp_section'=>$res['section'],'office_nm'=>$res['office'], 'basic_pay'=>$res['basic_pay'] ));
	
	return true;
	}
	
	
	public function get_all_trainings($limit_to=0,$office = 'AGAE',$wing = 'administration'){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('training_master')
//				 ->where('office',$office)
//				 ->where('wing',$wing)
				 ->order_by('order_date','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('title',$get['search']);
				$this->db->or_like('location',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function get_employee_training_detail($empid = '',$training_type=''){
		$res = $this->db->select('*')
				->from('employee_training td')
				->where('td.empid',$empid)
				->where('td.training_type',$training_type)
				->order_by('td.training_from','desc')
				->get()
				->result_array();
		return $res;
	}
	
	public function get_employee_training_detail_all ($limit_to = 0,$empid = ''){
		$get = $this->input->get(array('training_type'), TRUE);
		$this->db->select('*')
				 ->from('employee_training td')
				 ->where('td.empid',$empid);
	
		if($get['training_type'] != ''){
			$this->db->where('td.training_type',$get['training_type']);
		}
		$this->db->order_by('td.upload_dt','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}	
	
	public function get_training_detail($id = 0){
		$res = $this->db->select('*')
				->from('training_master')
				->where('trang_id',$id)
				->get()
				->row_array();
	}

	public function get_training_order_print($id = 0){
		return  $this->db->select('*')
						 ->from('employee_training')
						 ->where('training_id',$id)
						 ->get()
						 ->row_array();
	}
	public function get_trainees_list($id = 0){
		$res = $this->db->select('*')
				->from('employee_training')
				->where('training_id',$id)
				->order_by('name','desc')
				->get()
				->result_array();
		return $res;
	}
	
		public function get_employees_issued_training_order($limit_to=0, $office = 'AGAE'){
//		$training_id ='10';
		$get = $this->input->get(array('search'), TRUE);
		$results =  $this->db->select('e.empid,e.empname,e.desig,ote.trg_emp_id,ote.training_id')
							 ->from('employee_master e')
							 ->join('training_to_employee ote','ote.empid = e.empid')						 
							 ->where('e.office_code',$office)
//							 ->where('ote.training_id',$training_id)
							 ->order_by('e.empname');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->or_like('training_id',$get['search']);
			$this->db->group_end();
		}
		$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	} 
	public function getEmployeeTrainingOrderByID($id = 0){
		$res = $this->db->select('*')->from('training_to_employee')->where('trg_emp_id',$id)->get()->row_array();
		return $res;
	}
	public function delete_employees_training_OrderByID($id = 0){
		$this->db->where('trg_emp_id',$id)->delete('training_to_employee');
	}
	
	public function get_employee_loan_detail($empid = '',$loan_type=''){
		$res = $this->db->select('*')
						->from('employee_loan ln')
						->where('ln.empid',$empid)
						->where('loan_type',$loan_type)
						->order_by('order_date','desc')
						->get()
						->result_array();
		return $res;
	}
	public function get_employee_encashment_detail($empid = ''){
		$res = $this->db->select('*')
						->from('employee_encashment le')
						->where('le.empid',$empid)
						->order_by('encash_order_date','desc')
						->get()
						->result_array();
		return $res;
	}
	
//------ employee bills

	public function get_employee_bills($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('employee_bills')
				 ->order_by('bill_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('empid',$get['search']);
				$this->db->or_like('bill_amount',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function bill_details($id=0){
		return  $this->db->select('*')
						 ->from('employee_bills')
						 ->where('bill_id',$id)
						 ->get()
						 ->row_array();
	}
	public function update_bill_details($id=0){
		$post = $this->input->post(array('empid','name','desig','emp_section','group_nm','office_nm','basic_pay','bill_no','bill_date','bill_type','description','block','from_date','to_date','bill_amount','child_no','child_select','location','treatment_type','doctor','fit_unfit','amount_paid','payment_date','advance_bill_no','status'), TRUE);
		$update = array();
		$update['empid'] = $post['empid'];
		$update['name'] = $post['name'];
		$update['desig'] = $post['desig'];
		$update['emp_section'] = $post['emp_section'];
		$update['group_nm'] = $post['group_nm'];
		$update['office_nm'] = $post['office_nm'];
		$update['basic_pay'] = $post['basic_pay'];
		$update['bill_no'] = $post['bill_no'];
		$update['bill_date'] = $post['bill_date'];
		$update['bill_type'] = $post['bill_type'];
		$update['description'] = $post['description'];
		$update['block'] = $post['block'];
		$update['from_date'] = $post['from_date'];
		$update['to_date'] = $post['to_date'];
		$update['child_no'] = $post['child_no'];
		$update['child_select'] = $post['child_select'];
		$update['location'] = $post['location'];
		$update['treatment_type'] = $post['treatment_type'];
		$update['doctor'] = $post['doctor'];
		$update['fit_unfit'] = $post['fit_unfit'];
		$update['bill_amount'] = $post['bill_amount'];
		$update['amount_paid'] = $post['amount_paid'];
		$update['payment_date'] = $post['payment_date'];
		$update['advance_bill_no'] = $post['advance_bill_no'];
		$update['status'] = $post['status'];
		if(!empty($update) && $id != ''){
			$this->db->where('bill_id',$id)->update('employee_bills',$update);
		}
	}
	
//----employee training details	
	public function employee_training($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('employee_training')
				 ->order_by('training_from','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('empid',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function training_details($id=0){
		return  $this->db->select('*')
						 ->from('employee_training')
						 ->where('trg_detail_id',$id)
						 ->get()
						 ->row_array();
	}
	public function update_employee_training($id=0){
		$post = $this->input->post(array('empid','name','desig','emp_section','basic_pay','fin_year','training_order','order_date','training_type','description','location','training_from','training_to','training_days','bill_no','advance_bill_no'), TRUE);
		$update = array();
		$update['empid'] = $post['empid'];
		$update['name'] = $post['name'];
		$update['desig'] = $post['desig'];
		$update['emp_section'] = $post['emp_section'];
		$update['basic_pay'] = $post['basic_pay'];
		$update['fin_year'] = $post['fin_year'];
		$update['training_order'] = $post['training_order'];
		$update['order_date'] = $post['order_date'];
		$update['training_type'] = $post['training_type'];
		$update['description'] = $post['description'];
		$update['location'] = $post['location'];
		$update['training_from'] = $post['training_from'];
		$update['training_to'] = $post['training_to'];
		$update['training_days'] = $post['training_days'];
		$update['bill_no'] = $post['bill_no'];
		$update['advance_bill_no'] = $post['advance_bill_no'];
		
		if(!empty($update) && $id != ''){
			$this->db->where('trg_detail_id',$id)->update('employee_training',$update);
		}
	}
	
	public function deleteTrainingOrderByID($id = 0){
		$this->db->where('trg_detail_id',$id)->delete('employee_training');
	}
	

//-----employee loan details	
	
	public function employee_loan($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('employee_loan')
				 ->order_by('order_date','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('empid',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function loan_details($id=0){
		return  $this->db->select('*')
						 ->from('employee_loan')
						 ->where('loan_id',$id)
						 ->get()
						 ->row_array();
	}
	public function update_loan_details($id=0){
		$post = $this->input->post(array('empid','name','desig','emp_section','group_nm','office_nm','basic_pay','loan_type','interest_type','description','loan_order_no','order_date','loan_amount','installment_no','interest','paid_loan_amount','bill_no'), TRUE);
		$update = array();
		$update['empid'] = $post['empid'];
		$update['name'] = $post['name'];
		$update['desig'] = $post['desig'];
		$update['emp_section'] = $post['emp_section'];
		$update['group_nm'] = $post['group_nm'];
		$update['office_nm'] = $post['office_nm'];
		$update['basic_pay'] = $post['basic_pay'];
		$update['loan_type'] = $post['loan_type'];
		$update['interest_type'] = $post['interest_type'];
		$update['description'] = $post['description'];
		$update['loan_order_no'] = $post['loan_order_no'];
		$update['order_date'] = $post['order_date'];
		$update['loan_amount'] = $post['loan_amount'];
		$update['installment_no'] = $post['installment_no'];
		$update['interest'] = $post['interest'];
		$update['paid_loan_amount'] = $post['paid_loan_amount'];
		$update['bill_no'] = $post['bill_no'];
		
		if(!empty($update) && $id != ''){
			$this->db->where('loan_id',$id)->update('employee_loan',$update);
		}
	}
	
//-----employee encashment details	
	
	public function employee_encashment($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('employee_leave_encashment')
				 ->order_by('encash_order_date','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('empid',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function encashment_details($id=0){
		return  $this->db->select('*')
						 ->from('employee_leave_encashment')
						 ->where('encash_id',$id)
						 ->get()
						 ->row_array();
	}
	public function update_encashment_details($id=0){
		$post = $this->input->post(array('empid','name','desig','emp_section','group_nm','office_nm','basic_pay','description','encashment_no','from_date','to_date','no_days_encash','da_rate','encash_amount','income_tax_amount','encash_order_no','encash_order_date','bill_no','income_tax_status','status'), TRUE);
		$update = array();
		$update['empid'] = $post['empid'];
		$update['name'] = $post['name'];
		$update['desig'] = $post['desig'];
		$update['emp_section'] = $post['emp_section'];
		$update['group_nm'] = $post['group_nm'];
		$update['office_nm'] = $post['office_nm'];
		$update['basic_pay'] = $post['basic_pay'];
		$update['description'] = $post['description'];
		$update['encashment_no'] = $post['encashment_no'];
		$update['from_date'] = $post['from_date'];
		$update['to_date'] = $post['to_date'];
		$update['no_days_encash'] = $post['no_days_encash'];
		$update['da_rate'] = $post['da_rate'];
		$update['encash_amount'] = $post['encash_amount'];
		$update['income_tax_amount'] = $post['income_tax_amount'];
		$update['encash_order_no'] = $post['encash_order_no'];
		$update['encash_order_date'] = $post['encash_order_date'];
		$update['bill_no'] = $post['bill_no'];
		$update['income_tax_status'] = $post['income_tax_status'];
		$update['status'] = $post['status'];
		if(!empty($update) && $id != ''){
			$this->db->where('encash_id',$id)->update('employee_leave_encashment',$update);
		}
	}
		public function get_incometax_info($empid = 0,$office = 'AGAE'){
		$res = $this->db->select('it.*')
						->from('income_tax it')
						->join('employee_master e','it.empid = e.empid')
						->where('it.empid',$empid)
						->where('e.office_code',$office)
						->order_by('upload_dt','desc')
						->get()
						->row_array();
		return $res;
	}
			
	public function emp_incometax_information($empid = 0){
		$post =  $this->input->post(array('name','desig','office_nm','applied_on'), TRUE);
		$post['empid'] = $empid;
		
		$post['applied_on'] = !empty($post['applied_on']) ? date('Y-m-d',strtotime($post['applied_on'])) : '';
		$this->db->insert('income_tax',$post);
		return true;
	}
	public function get_income_tax_particulars($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('income_tax')
				 ->order_by('itax_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('empid',$get['search']);
				$this->db->or_like('name',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
//  family
	public function get_employee_family_member($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('employee_family')
				 ->order_by('member_name','asc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('empid',$get['search']);
				$this->db->or_like('member_name',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function family_member($id=0){
		return  $this->db->select('*')
						 ->from('employee_family')
						 ->where('family_member_id',$id)
						 ->get()
						 ->row_array();
	}
	
	public function update_family_member($id=0){
		$post = $this->input->post(array('empid','member_name','member_dob','family_relation','first_second_child','ph_status','ph_percentage'), TRUE);
		$update = array();
		$update['empid'] = $post['empid'];
		$update['member_name'] = $post['member_name'];
		$update['member_dob'] = $post['member_dob'];
		$update['family_relation'] = $post['family_relation'];
		$update['first_second_child'] = $post['first_second_child'];
		$update['ph_status'] = $post['ph_status'];
		$update['ph_percentage'] = $post['ph_percentage'];
		
		if(!empty($update) && $id != ''){
			$this->db->where('family_member_id',$id)->update('employee_family',$update);
		}
	}	
	
}// End of class