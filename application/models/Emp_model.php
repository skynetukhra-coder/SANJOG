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
//		$date = date('Y-m-d H:i:s');
		$date = date('Y-m-d');
		$results =  $this->db->select('e.empid,e.empname,e.desig,e.mbno,e.gpf_ac_no,e.office_id,e.section')
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
	public function get_all_employee_empids($office = 'AGAE'){
		$date = date('Y-m-d');
		$results =  $this->db->select('e.empid,e.empname,e.desig,e.mbno,e.office_id,e.section')
							 ->from('employee_master e')
//							 ->join('employee_details ed','ed.empid = e.empid','left')
							 ->where('office_code',$office)
				 			 ->where('date(dor) >= ',$date)
							 ->where('status','Active')
							 ->where('da_cadare','0')
							 ->order_by('e.empid','ásc')
							 ->get()
							 ->result_array();
		return $results;
	}
	public function get_sectional_employee($section=''){
		$date = date('Y-m-d');
		$res = $this->db->select('e.empid,e.empname,e.desig')
						->from('employee_master e')
						->where('office_code','AGAE')
				 		->where('date(dor) >= ',$date)
						->where('section',$section)
						->where('status','Active')
						->order_by('e.empname')
						->get()
					->result_array();
		return $res;
	}
	public function get_all_da_cadare_list($office = 'AGAE'){
		$date = date('Y-m-d');
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
	public function get_all_employee_list_training($office = 'AGAE'){
		$date = date('Y-m-d');
		$results =  $this->db->select('e.empid,e.empname,e.desig,e.mbno,e.office_id,e.section')
							 ->from('employee_master e')
//							 ->join('employee_details ed','ed.empid = e.empid','left')
							 ->where('office_code',$office)
				 			 ->where('date(dor) >= ',$date)
							 ->where('status','Active')
//							 ->where('da_cadare','1')
							 ->order_by('e.empname')
							 ->get()
							 ->result_array();
		return $results;
	}
	public function get_authority_list($office = 'AGAE',$desig=''){
		$date = date('Y-m-d');
		$results =  $this->db->select('e.empid,e.empname,e.desig')
							 ->from('employee_master e')
//							 ->join('employee_details ed','ed.empid = e.empid','left')						 
							 ->where('office_code',$office)
							 ->where('date(dor) >= ',$date)
							 ->where('da_cadare','0')
							 ->where('status','Active')
							 ->order_by('e.empname')
							 ->get()
							 ->result_array();
		return $results;
	}
	public function get_recomm_list($office = 'AGAE',$desig=''){
		$date = date('Y-m-d');
		$results =  $this->db->select('e.empid,e.empname,e.desig')
							 ->from('employee_master e')
//							 ->join('employee_details ed','ed.empid = e.empid','left')						 
							 ->where('office_code',$office)
							 ->where('date(dor) >= ',$date)
							 ->where('da_cadare','0')
							 ->where('status','Active')
							 ->group_start()
							 ->where('desig','SR. ACCOUNTS OFFICER')
							 ->or_where('desig','ACCOUNTANT GENERAL')
							 ->or_where('desig','PR. ACCOUNTANT GENERAL')
							 ->group_end()
							 ->order_by('e.empname')
							 ->get()
							 ->result_array();
		return $results;
	}
	public function get_branch_officer_list($office = 'AGAE',$desig='SR. ACCOUNTS OFFICER'){
		$date = date('Y-m-d');
		$results =  $this->db->select('e.empid,e.empname,e.desig')
							 ->from('employee_master e')
//							 ->join('employee_details ed','ed.empid = e.empid','left')						 
							 ->where('office_code',$office)
							 ->where('date(dor) >= ',$date)
							 ->where('status','Active')
							 ->where('desig','SR. ACCOUNTS OFFICER')
							 ->or_where('desig','SR. ACCOUNTS OFFICER (Adhoc)')
							 ->order_by('e.empname')
							 ->get()
							 ->result_array();
		return $results;
	}
	public function get_aao_bo_list($office = 'AGAE'){
		$date = date('Y-m-d');
		$results =  $this->db->select('e.empid,e.empname,e.desig')
							 ->from('employee_master e')
//							 ->join('employee_details ed','ed.empid = e.empid','left')						 
							 ->where('e.office_code',$office)
							 ->where('date(dor) >= ',$date)
							 ->where('e.status','Active')
/*
							 ->like('e.desig','SUPERVISOR')							 
							 ->or_like('e.desig','ASSTT. ACCOUNTS OFFICER')
							 ->or_like('e.desig','SR. ACCOUNTS OFFICER')
							 ->or_like('e.desig','DY. ACCOUNTANT GENERAL')
							 ->or_like('e.desig','SR.DY. ACCOUNTANT GENERAL')
							 ->or_like('e.desig','ACCOUNTANT GENERAL')
							 ->or_like('e.desig','PR. ACCOUNTANT GENERAL')
*/
							 ->order_by('e.empname')
							 ->get()
							 ->result_array();
		return $results;
	}
	public function get_bo_dag_list($office = 'AGAE'){
		$date = date('Y-m-d');
		$results =  $this->db->select('e.empid,e.empname,e.desig')
							 ->from('employee_master e')
//							 ->join('employee_details ed','ed.empid = e.empid','left')						 
							 ->where('e.office_code',$office)
							 ->where('date(dor) >= ',$date)
							 ->where('e.status','Active')
							 ->like('e.desig','SR. ACCOUNTS OFFICER')								 
							 ->or_like('e.desig','DY. ACCOUNTANT GENERAL')
//							 ->or_like('e.desig','PR. ACCOUNTANT GENERAL')
//							 ->or_like('e.desig','ACCOUNTANT GENERAL')
							 ->order_by('e.empname')
							 ->get()
							 ->result_array();
		return $results;
	}
	public function get_aao_officer_list($office = 'AGAE'){
		$date = date('Y-m-d');
		$results =  $this->db->select('e.empid,e.empname,e.desig')
							 ->from('employee_master e')
//							 ->join('employee_details ed','ed.empid = e.empid','left')						 
							 ->where('office_code',$office)
							 ->where('date(dor) >= ',$date)
							 ->where('status','Active')
							 ->where('desig','ASSTT. ACCOUNTS OFFICER')
							 ->or_where('desig','SUPERVISOR')
							 ->or_where('desig','ASSTT. SUPERVISOR')
							 ->or_where('desig','WELFARE ASSISTANT')
							 ->order_by('e.empname')
							 ->get()
							 ->result_array();
		return $results;
	}
	public function get_all_exam_name_list(){
		$res = $this->db->select ('exam_name')
						->from('employee_application_examlist')
						->where('off_on','On')
						->order_by('exam_name','asc')
						->group_by('exam_name')
						->get()
						->result_array();
		return $res;
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
		$get = $this->input->get(array('search'), TRUE);
		$results =  $this->db->select('e.empid,e.empname,e.desig,ote.eord_id, ote.emp_order_id, od.details, od.order_dt')
							 ->from('employee_master e')
							 ->join('office_order_to_employee ote','ote.empid = e.empid')
							 ->join('office_order od','od.order_id = ote.emp_order_id')							 
							 ->where('e.office_code',$office)
							 ->order_by('ote.emp_order_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->where('ote.emp_order_id',$get['search']);
				$this->db->or_where('ote.empid',$get['search']);
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
		$results =  $this->db->select('e.empid,e.da_cadare,e.empname,e.desig,ote.eord_id, ote.emp_order_id')
							 ->from('employee_master e')
							 ->join('office_order_to_employee ote','ote.empid = e.empid')						 
							 ->where('e.office_code',$office)
							 ->where('e.da_cadare',$da_cadare)
//							 ->where('ote.emp_order_id',$order_id)
							 ->order_by('e.empname');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->or_like('ote.emp_order_id',$get['search']);
			$this->db->group_end();
		}
		$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	} 
	
	public function get_admin_employee_loggedIn($limit_to=0,$office = 'AGAE'){
		$date= Date('Y-m-d');
		$LoginFromDate = date('Y-m-d', strtotime($date. ' - 0 days'));
		$LoginToDate = date('Y-m-d', strtotime($date. ' + 1 days'));
		$da_cadare = '0';
/*		
		$post = $this->input->post(array('date_from','date_to','da_cadare'), TRUE);
		if($post['date_from'] != ''){
			$LoginFromDate = date('Y-m-d',strtotime($post['date_from']));
		}else{
			$LoginFromDate = date('Y-m-d', strtotime($date. ' - 1 days'));
		}
		if($post['date_to'] != ''){
			$LoginToDate = date('Y-m-d',strtotime($post['date_to']));
		}else{
			$LoginToDate = date('Y-m-d', strtotime($date. ' - 0 days'));
		}
		if($post['da_cadare'] != ''){
			$da_cadare = $post['da_cadare'];
		}else{
			$da_cadare = '0';
		}		
*/	
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('employee_master')
				 ->where('office_code',$office)
				 ->where('da_cadare',$da_cadare)
//				 ->where('date(last_login) >= ',$LoginFromDate)
//				 ->where('date(last_login) <= ',$LoginToDate)
				 ->order_by('last_login','desc');
				 
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('empid',$get['search']);
				$this->db->or_like('office_id',$get['search']);
				$this->db->or_like('empname',$get['search']);
			$this->db->group_end();
		}

		$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_employee_loggedIn($limit_to=0,$office = 'AGAE'){
		$date= Date('Y-m-d');
		$LoginFromDate = date('Y-m-d', strtotime($date. ' - 0 days'));
		$LoginToDate = date('Y-m-d', strtotime($date. ' + 1 days'));
		$da_cadare = '0';
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('employee_master')
				 ->where('office_code',$office)
				 ->where('da_cadare',$da_cadare)
				 ->where('date(last_login) >= ',$LoginFromDate)
				 ->where('date(last_login) <= ',$LoginToDate)
				 ->order_by('last_login','desc');
				 
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('empid',$get['search']);
				$this->db->or_like('office_id',$get['search']);
				$this->db->or_like('empname',$get['search']);
				$this->db->or_like('section',$get['search']);
				$this->db->or_like('desig',$get['search']);
				$this->db->or_like('mbno',$get['search']);
				$this->db->or_like('nicmail',$get['search']);
				$this->db->or_like('email',$get['search']);
				$this->db->or_like('status',$get['search']);
			$this->db->group_end();
		}

		$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function get_employee_loggedIn_details($limit_to=0,$office = 'AGAE'){
		$date= Date('Y-m-d');
		$LoginFromDate = date('Y-m-d', strtotime($date. ' - 0 days'));
		$LoginToDate = date('Y-m-d', strtotime($date. ' + 1 days'));
		$da_cadare = '0';
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('employee_master')
				 ->where('office_code',$office)
				 ->where('da_cadare',$da_cadare)
				 ->where('date(last_login) >= ',$LoginFromDate)
				 ->where('date(last_login) <= ',$LoginToDate)
				 ->order_by('last_login','desc');
				 
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('empid',$get['search']);
				$this->db->or_like('office_id',$get['search']);
				$this->db->or_like('empname',$get['search']);
				$this->db->or_like('section',$get['search']);
				$this->db->or_like('desig',$get['search']);
				$this->db->or_like('mbno',$get['search']);
				$this->db->or_like('nicmail',$get['search']);
				$this->db->or_like('email',$get['search']);
				$this->db->or_like('status',$get['search']);
			$this->db->group_end();
		}

		$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function get_employee_loggedIn_count($limit_to=0,$office = 'AGAE'){
		$date= Date('Y-m-d');
		$LoginFromDate = date('Y-m-d', strtotime($date. ' - 0 days'));
		$LoginToDate = date('Y-m-d', strtotime($date. ' + 1 days'));
		$da_cadare = '0';
		$get = $this->input->get(array('search'), TRUE);
		$results = $this->db->select('count(*) emp_usr')
				 ->from('employee_master')
				 ->where('office_code',$office)
				 ->where('da_cadare',$da_cadare)
				 ->where('date(last_login) >= ',$LoginFromDate)
				 ->where('date(last_login) <= ',$LoginToDate)
				 ->order_by('last_login','desc')
			     ->get()
				 ->result_array();
		return $results;
	}
	public function get_admin_employee($limit_to=0,$office = 'AGAE'){
		$get = $this->input->get(array('search','desig','section'), TRUE);
		$this->db->select('*')
				 ->from('employee_master')
				 ->where('office_code',$office)
				 ->order_by('e_id','desc');
		if($get['desig'] != ''){
			$this->db->group_start();
			$this->db->or_like('desig',$get['desig']);
			$this->db->group_end();
		}
		if($get['section'] != ''){
			$this->db->group_start();
			$this->db->or_like('section',$get['section']);
			$this->db->group_end();
		}
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('empid',$get['search']);
				$this->db->or_like('office_id',$get['search']);
				$this->db->or_like('empname',$get['search']);
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
		
	public function update_employee_last_login($emp_id = ''){
		$post = $this->input->post(array('last_login'), TRUE);
		$update = array();
		$update['last_login'] = date('Y-m-d H:i:s');	
		if(!empty($update)){
			$this->db->where('empid',$emp_id)->update('employee_master',$update);
			return true;
		}
		return false;
	}
	
	public function update_employee($id=0,$office = 'AGAE'){
		$employee = $this->input->post(array('empid','office_id','da_cadare','empname','group_name','section','desig','father_name','mother_name','gender','mbno','category','stream','dob','dor','nicmail','nicmail_proposed','email','doapp','doj_off','promotion_dt','promo_from','trans_from','trans_order_dt','level_pay','basic_pay','service_bk_no','gpf_ac_no','deputation_status','office','dept_appt','joning_type','blodd_grp','password','emp_status','status','remark','picture'), TRUE);
		$details  = $this->input->post(array('empid','offic_id','qualifi','address1','state','district','postoffice','pin','section','grd_slno','grd_pageno','id_cardno','aadhaar_cardno','voter_cardno','passport_no','service_type','nomination','family_memb','do_exp'), TRUE);
		
		$update = array();
		
		if($employee['empid'] != ''){$update['empid'] = $employee['empid'];}
		if($employee['office_id'] != ''){$update['office_id'] = $employee['office_id'];}
		if($employee['da_cadare'] != ''){$update['da_cadare'] = $employee['da_cadare'];}
		if($employee['empname'] != ''){$update['empname'] = $employee['empname'];}
		if($employee['father_name'] != ''){$update['father_name'] = $employee['father_name'];}
		if($employee['mother_name'] != ''){$update['mother_name'] = $employee['mother_name'];}
		if($employee['group_name'] != ''){$update['group_name'] = $employee['group_name'];}
		if($employee['section'] != ''){$update['section'] = $employee['section'];}
		if($employee['desig'] != ''){$update['desig'] = $employee['desig'];}
		if($employee['gender'] != ''){$update['gender'] = $employee['gender'];}
		if($employee['mbno'] != ''){$update['mbno'] = $employee['mbno'];}
		if($employee['category'] != ''){$update['category'] = $employee['category'];}
		if($employee['stream'] != ''){$update['stream'] = $employee['stream'];}
		if($employee['dob'] != ''){$update['dob'] = date('Y-m-d',strtotime($employee['dob']));}
		if($employee['dor'] != ''){$update['dor'] = date('Y-m-d',strtotime($employee['dor']));}
		if($employee['nicmail'] != ''){$update['nicmail'] = $employee['nicmail'];}
		if($employee['nicmail_proposed'] != ''){$update['nicmail_proposed'] = $employee['nicmail_proposed'];}
		if($employee['email'] != ''){$update['email'] = $employee['email'];}
		if($employee['doapp'] != ''){$update['doapp'] = date('Y-m-d',strtotime($employee['doapp']));}
		if($employee['doj_off'] != ''){$update['doj_off'] = date('Y-m-d',strtotime($employee['doj_off']));}
		if($employee['promotion_dt'] != ''){$update['promotion_dt'] = date('Y-m-d H:i:s',strtotime($employee['promotion_dt']));}
		if($employee['promo_from'] != ''){$update['promo_from'] = $employee['promo_from'];}
		if($employee['trans_from'] != ''){$update['trans_from'] = $employee['trans_from'];}
		if($employee['trans_order_dt'] != ''){$update['trans_order_dt'] = date('Y-m-d H:i:s',strtotime($employee['trans_order_dt']));}
		if($employee['level_pay'] != ''){$update['level_pay'] = $employee['level_pay'];}
		if($employee['basic_pay'] != ''){$update['basic_pay'] = $employee['basic_pay'];}
		if($employee['service_bk_no'] != ''){$update['service_bk_no'] = $employee['service_bk_no'];}
		if($employee['gpf_ac_no'] != ''){$update['gpf_ac_no'] = $employee['gpf_ac_no'];}
		if($employee['deputation_status'] != ''){$update['deputation_status'] = $employee['deputation_status'];}
		if($employee['office'] != ''){$update['office'] = $employee['office'];}
		if($employee['dept_appt'] != ''){$update['dept_appt'] = $employee['dept_appt'];}
		if($employee['joning_type'] != ''){$update['joning_type'] = $employee['joning_type'];}
		if($employee['blodd_grp'] != ''){$update['blodd_grp'] = $employee['blodd_grp'];}
		if($employee['password'] != ''){$update['password'] = md5($employee['password']);}
		if($employee['emp_status'] != ''){$update['emp_status'] = $employee['emp_status'];}
		if($employee['status'] != ''){$update['status'] = $employee['status'];}
		if($employee['picture'] != ''){$update['picture'] = $employee['picture'];}
		$update['profile_updated'] = date('Y-m-d H:i:s');
/*		if($post['picture'] !== ''){
			$update['picture'] = $post['picture'];
		}
*/
		if($employee['remark'] != ''){
			$update['remark'] = $employee['remark'];
		}else{
			$update['remark'] = 'I Agree';	
		}
		if(!empty($update) && $id != ''){
			$this->db->where('office_code',$office)->where('empid',$id)->update('employee_master',$update);
		}
	
		// details

		$update = array();
		
		if($employee['empid'] != ''){$update['empid'] = $employee['empid'];}
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
		if($details['aadhaar_cardno'] != ''){$update['aadhaar_cardno'] = $details['aadhaar_cardno'];}
		if($details['voter_cardno'] != ''){$update['voter_cardno'] = $details['voter_cardno'];}
		if($details['passport_no'] != ''){$update['passport_no'] = $details['passport_no'];}
		if($details['service_type'] != ''){$update['service_type'] = $details['service_type'];}
		if($details['nomination'] != ''){$update['nomination'] = $details['nomination'];}
		if($details['family_memb'] != ''){$update['family_memb'] = $details['family_memb'];}
		if($details['do_exp'] != ''){$update['do_exp'] = date('Y-m-d',strtotime($details['do_exp']));}

		if(!empty($update) && $id != ''){
			$this->db->where('empid',$id)->update('employee_details',$update);
		}				

		$res1 = $this->db->select('sec_index,bo_index')
						 ->from('section_master')
						 ->where('section',$this->input->post('section'))
						 ->get()
						 ->row_array();
		if(empty($res1)){
			return array($res1);
		}
	
		$update1 = array();
		
		if($res1['sec_index'] != ''){$update1['sect_idx'] = $res1['sec_index'];}
		if($res1['bo_index'] != ''){$update1['branch_indx'] = $res1['bo_index'];}
		if(!empty($update1) && $id != ''){
			$this->db->where('empid',$id)->where('office_code',$office)->update('employee_master',$update1);
		}
		
		$res2 = $this->db->select('section')
						 ->from('section_master')
						 ->where('sec_index',$res1['bo_index'])
						 ->get()
						 ->row_array();
		if(empty($res2)){
			return array($res2);
		}

		$update2 = array();
		
		if($res2['section'] != ''){$update2['branch_desc'] = $res2['section'];}

		if(!empty($update2) && $id != ''){
			$this->db->where('empid',$id)->where('office_code',$office)->update('employee_master',$update2);
		}
	}

	public function update_employee_peninfo($id=0,$office = 'AGAE'){
		$employee  = $this->input->post(array('empid','dob','dor','doapp','doj_off','level_pay','basic_pay'), TRUE);
		$update = array();
		if($employee['dob'] != ''){$update['dob'] = $employee['dob'];}
		if($employee['dor'] != ''){$update['dor'] = $employee['dor'];}
		if($employee['doapp'] != ''){$update['doapp'] = $employee['doapp'];}
		if($employee['doj_off'] != ''){$update['doj_off'] = $employee['doj_off'];}
		if($employee['level_pay'] != ''){$update['level_pay'] = $employee['level_pay'];}
		if($employee['basic_pay'] != ''){$update['basic_pay'] = $employee['basic_pay'];}
		
		if(!empty($update) && $id != ''){
			$this->db->where('empid',$id)->update('employee_master',$update);
		}
		
		$details  = $this->input->post(array('empid','offic_id','net_qservice','emp_pen','pen_resiry','cvp','cvp_bill_no','cvp_bill_mth','cvp_bill_yr','crg','crg_bill_no','crg_bill_mth','crg_bill_yr',
		'cgegis','cgeis_bill_no','cgeis_bill_mth','cgeis_bill_yr','leave_salary','lsalary_bill_no','lsalary_bill_mth','lsalary_bill_yr','gpf','gpf_bill_no','gpf_bill_mth','gpf_bill_yr',
		'fmly_pen_ordi','fmly_pen_dt_from','fmly_pen_dt_to','fmly_pen_enhd','med_option','ppo_no','ppo_dt','pautho','pautho_dt','address1','state','district','postoffice','pin'), TRUE);

		$update = array();
		if($details['net_qservice'] != ''){$update['net_qservice'] = $details['net_qservice'];}
		if($details['emp_pen'] != ''){$update['emp_pen'] = $details['emp_pen'];}
		if($details['pen_resiry'] != ''){$update['pen_resiry'] = $details['pen_resiry'];}
		if($details['cvp'] != ''){$update['cvp'] = $details['cvp'];}
		if($details['cvp_bill_no'] != ''){$update['cvp_bill_no'] = $details['cvp_bill_no'];}
		if($details['cvp_bill_mth'] != ''){$update['cvp_bill_mth'] = $details['cvp_bill_mth'];}
		if($details['cvp_bill_yr'] != ''){$update['cvp_bill_yr'] = $details['cvp_bill_yr'];}
		if($details['crg'] != ''){$update['crg'] = $details['crg'];}
		if($details['crg_bill_no'] != ''){$update['crg_bill_no'] = $details['crg_bill_no'];}
		if($details['crg_bill_mth'] != ''){$update['crg_bill_mth'] = $details['crg_bill_mth'];}
		if($details['crg_bill_yr'] != ''){$update['crg_bill_yr'] = $details['crg_bill_yr'];}
		if($details['cgegis'] != ''){$update['cgegis'] = $details['cgegis'];}
		if($details['cgeis_bill_no'] != ''){$update['cgeis_bill_no'] = $details['cgeis_bill_no'];}
		if($details['cgeis_bill_mth'] != ''){$update['cgeis_bill_mth'] = $details['cgeis_bill_mth'];}
		if($details['cgeis_bill_yr'] != ''){$update['cgeis_bill_yr'] = $details['cgeis_bill_yr'];}
		if($details['leave_salary'] != ''){$update['leave_salary'] = $details['leave_salary'];}
		if($details['lsalary_bill_no'] != ''){$update['lsalary_bill_no'] = $details['lsalary_bill_no'];}
		if($details['lsalary_bill_mth'] != ''){$update['lsalary_bill_mth'] = $details['lsalary_bill_mth'];}
		if($details['lsalary_bill_yr'] != ''){$update['lsalary_bill_yr'] = $details['lsalary_bill_yr'];}
		if($details['gpf'] != ''){$update['gpf'] = $details['gpf'];}
		if($details['gpf_bill_no'] != ''){$update['gpf_bill_no'] = $details['gpf_bill_no'];}
		if($details['gpf_bill_mth'] != ''){$update['gpf_bill_mth'] = $details['gpf_bill_mth'];}
		if($details['gpf_bill_yr'] != ''){$update['gpf_bill_yr'] = $details['gpf_bill_yr'];}
		if($details['fmly_pen_ordi'] != ''){$update['fmly_pen_ordi'] = $details['fmly_pen_ordi'];}
		if($details['fmly_pen_dt_from'] != ''){$update['fmly_pen_dt_from'] = date('Y-m-d',strtotime($details['fmly_pen_dt_from']));}
		if($details['fmly_pen_dt_to'] != ''){$update['fmly_pen_dt_to'] = date('Y-m-d',strtotime($details['fmly_pen_dt_to']));}
		if($details['fmly_pen_enhd'] != ''){$update['fmly_pen_enhd'] = $details['fmly_pen_enhd'];}		
		if($details['address1'] != ''){$update['address1'] = $details['address1'];}
		if($details['state'] != ''){$update['state'] = $details['state'];}
		if($details['district'] != ''){$update['district'] = $details['district'];}
		if($details['postoffice'] != ''){$update['postoffice'] = $details['postoffice'];}
		if($details['pin'] != ''){$update['pin'] = $details['pin'];}		
		if($details['med_option'] != ''){$update['med_option'] = $details['med_option'];}
		if($details['ppo_no'] != ''){$update['ppo_no'] = $details['ppo_no'];}
		if($details['ppo_dt'] != ''){$update['ppo_dt'] = date('Y-m-d',strtotime($details['ppo_dt']));}
		if($details['pautho'] != ''){$update['pautho'] = $details['pautho'];}
		if($details['pautho_dt'] != ''){$update['pautho_dt'] = date('Y-m-d',strtotime($details['pautho_dt']));}	
		if(!empty($update) && $id != ''){
			$this->db->where('empid',$id)->update('employee_details',$update);
		}
	}
	
	public function update_employee_nomination($id=0,$office = 'AGAE'){
		$details  = $this->input->post(array('nomination','family_memb'), TRUE);

		$update = array();

		if($details['nomination'] != ''){$update['nomination'] = $details['nomination'];}
		if($details['family_memb'] != ''){$update['family_memb'] = $details['family_memb'];}
		
		if(!empty($update) && $id != ''){
			$this->db->where('empid',$id)->update('employee_details',$update);
		}
	}
	public function update_employee_section($id=0,$emp_section = '', $emp_branch = '', $staff_type=''){
		$employee = $this->input->post(array('office_id','empname','office','dept_appt','group_name','sect_idx','section','branch_indx','branch_desc','staff_type','status'), TRUE);
		$details  = $this->input->post(array('offic_id','section'), TRUE);
		
		$update = array();
		
		if($employee['office_id'] != ''){$update['office_id'] = $employee['office_id'];}
		if($employee['empname'] != ''){$update['empname'] = $employee['empname'];}
//		if($employee['trans_order_dt'] != ''){$update['trans_order_dt'] = date('Y-m-d H:i:s',strtotime($employee['trans_order_dt']));}
		if($employee['office'] != ''){$update['office'] = $employee['office'];}
		if($employee['dept_appt'] != ''){$update['dept_appt'] = $employee['dept_appt'];}
		if($employee['group_name'] != ''){$update['group_name'] = $employee['group_name'];}
				
		if(is_array($emp_section)){
			foreach($emp_section as $sec_index=>$section){
				$sec_index = $sec_index;
				$sec_desc = $section;
			}
		}
		if(is_array($emp_branch)){
			foreach($emp_branch as $branch_indx=>$section){
				$update['branch_indx'] = $branch_indx;
				$bo_desc = $section;
				$update['branch_desc'] = $bo_desc;
			}
		}		
		if($staff_type == 'BO'){
			$update['sect_idx'] = $branch_indx;
			$update['section'] = $bo_desc;
		}else{
			$update['sect_idx'] = $sec_index;
			$update['section'] = $sec_desc;
		}
	
		if($employee['staff_type'] != ''){$update['staff_type'] = $employee['staff_type'];}	
		if($employee['status'] != ''){$update['status'] = $employee['status'];}	

		if(!empty($update) && $id != ''){
			$this->db->where('empid',$id)->where('office_code','AGAE')->update('employee_master',$update);
		}
		// details
		$update = array();
		
		if(is_array($emp_section)){
			foreach($emp_section as $sec_index=>$section){
				$sec_desc = $section;
			}
		}
		if(is_array($emp_branch)){
			foreach($emp_branch as $branch_indx=>$section){
				$bo_desc = $section;
			}
		}		
		if($staff_type == 'BO'){
			$update['section'] = $bo_desc;
		}else{
			$update['section'] = $sec_desc;
		}
		
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
		$date = date('Y-m-d');
		$res = $this->db->select('*')
						->from('employee_master')
						->where('empid',$emp_id)
						->where('password',md5($pass))
						->where('office_code',$office)
						->where('da_cadare',$da_cadare)
						->where('date(dor) >= ',$date)
						->where('status',$status)
						->group_start()
						->where('emp_status','Working')
						->or_where('emp_status','Deputation')
						->group_end()
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
	public function get_employee_master_pan($e_id = ''){
		$res = $this->db->select('*')
						->from('employee_master e')
						->where('e.e_id',$e_id)
						->get()
						->row_array();
		return $res;
	}
	public function get_employee_detail_pan($offic_id = ''){
		$res = $this->db->select('*')
						->from('employee_details d')
						->where('d.offic_id',$offic_id)
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
	public function get_employee_details($empid = '',$office='AGAE'){
		$res = $this->db->select('e.*,ed.*,e.empid')
						->from('employee_master e')
						->join('employee_details ed','e.empid = ed.empid','left')
						->where('e.empid',$empid)
						->where('e.office_code',$office)
						->get()
						->row_array();
		return $res;
	}
	public function family_member_details($empid = ''){
		$res = $this->db->select('*')
						->from('employee_family')
						->where('empid',$empid)
						->get()
						->result_array();
		return $res;
	}
	public function family_wives_details($empid = ''){
		$res = $this->db->select('*')
						->from('employee_family')
						->where('empid',$empid)
						->group_start()
						->where('family_relation','Wife')
						->or_where('family_relation','Husband')
						->group_end()
						->get()
						->result_array();
		return $res;
	}
	public function family_wife_detail($empid = ''){
		$res = $this->db->select('*')
						->from('employee_family')
						->where('empid',$empid)
						->group_start()
						->where('family_relation','Wife')
						->or_where('family_relation','Husband')
						->group_end()
						->get()
						->row_array();
		return $res;
	}
	public function family_member_minor_details($empid = ''){
		$date = date('Y-m-d', strtotime('-18 years'));
		$res = $this->db->select('*')
						->from('employee_family')
						->where('empid',$empid)
						->where('date(member_dob) >= ',$date)
						->get()
						->result_array();
		return $res;
	} 
	public function consu_item_details(){
		$res = $this->db->select('*')
						->from('emd_bg_consu')
						->where('item_cat','CONSUMABLES')
						->order_by('item_desc','asc')
						->get()
						->result_array();
		return $res;
	} 
	public function family_member_details_edu_allowance($empid = ''){
		$res = $this->db->select('*')
						->from('employee_family')
						->where('empid',$empid)
						->where('first_second_child <>','NA')
						->get()
						->result_array();
		return $res;
	}
	public function family_member_update($empid = '', $id = 0){
		$res = $this->db->select('*')
						->from('employee_family')
						->where('empid',$empid)
						->where('family_member_id',$id)
						->get()
						->row_array();
		return $res;
	} 
	public function employee_section_details($empid = '',$office='AGAE'){
		$res = $this->db->select('e.*')
						->from('employee_master e')
						->where('e.empid',$empid)
						->where('e.office_code',$office)
						->get()
						->row_array();
		return $res;
	}
	public function employee_heirarchy_details($empid = '',$office='AGAE'){
		$res = $this->db->select('e.*,ed.*,e.empid')
						->from('employee_master e')
						->join('employee_details ed','e.empid = ed.empid','left')
						->where('e.empid',$empid)
						->where('e.office_code',$office)
						->order_by('empname','asc')
						->get()
						->result_array();
		return $res;
	}
	public function employee_sec_incharge_detail($section_desc = '',$office='AGAE'){
		$res = $this->db->select('e.*,ed.*,e.empid')
						->from('employee_master e')
						->join('employee_details ed','e.empid = ed.empid','left')
						->where('e.staff_type','Incharge')
						->where('e.office_code',$office)
						->where('e.section',$section_desc)
						->or_where('e.section_addn',$section_desc)
						->order_by('empname','asc')
						->get()
						->result_array();
		return $res;
	}
	public function employee_sec_incharge_details($sect_idx = '',$office='AGAE'){
		$date = date('Y-m-d H:i:s');
		$res = $this->db->select('e.*,ed.*,e.empid')
						->from('employee_master e')
						->join('employee_details ed','e.empid = ed.empid','left')
						->where('date(dor) >= ',$date)
						->where('deputation_status','No')
						->where('status','Active')
						->where('e.sect_idx',$sect_idx)
						->where('e.staff_type','Incharge')
						->where('e.office_code',$office)
						->order_by('empname','asc')
						->get()
						->result_array();
		return $res;
	}
	public function employee_sec_incharge_bo_search($staff_type = '',$section = '',$office='AGAE'){
		$date = date('Y-m-d H:i:s');
		$res = $this->db->select('e.*,ed.*,e.empid')
						->from('employee_master e')
						->join('employee_details ed','e.empid = ed.empid','left')
						->where('date(e.dor) >= ',$date)
						->where('e.deputation_status','No')
						->where('e.status','Active')
						->where('e.staff_type',$staff_type)
						->where('e.office_code',$office)
						->where('e.section',$section)
						->or_where('e.section_addn',$section)
						->order_by('empname','asc')
						->get()
						->result_array();
		return $res;
	}
	public function employee_sec_staff_details($sect_idx = '',$office='AGAE'){
		$date = date('Y-m-d H:i:s');
		$res = $this->db->select('e.*,ed.*,e.empid')
						->from('employee_master e')
						->join('employee_details ed','e.empid = ed.empid','left')
						->where('date(e.dor) >= ',$date)
						->where('e.deputation_status','No')
						->where('e.status','Active')
						->where('e.sect_idx',$sect_idx)
						->where('e.staff_type !=','Incharge')
						->where('e.staff_type !=','BO')
						->where('e.office_code',$office)
						->order_by('empname','asc')
						->get()
						->result_array();
		return $res;
	}
	public function employee_bo_staff_details($branch_indx = '',$office='AGAE'){
		$date = date('Y-m-d H:i:s');
		$res = $this->db->select('e.*,ed.*,e.empid')
						->from('employee_master e')
						->join('employee_details ed','e.empid = ed.empid','left')
						->where('date(e.dor) >= ',$date)
						->where('status','Active')
						->where('e.branch_indx',$branch_indx)
						->where('e.staff_type !=','Incharge')
						->where('e.staff_type !=','BO')
						->where('e.office_code',$office)
						->order_by('e.section','asc')
						->order_by('empname','asc')
						->get()
						->result_array();
		return $res;
	}
	
	public function employee_bo_staff_details_by_sec_index($empid_bo = '',$office='AGAE'){
		$res = $this->db->select('e.*,ed.*,e.empid')
						->from('employee_master e')
						->join('employee_details ed','e.empid = ed.empid','left')
						->where('e.empid',$empid_bo)
						->where('e.staff_type =','BO')
						->where('e.office_code',$office)
						->order_by('e.section','asc')
						->order_by('empname','asc')
						->get()
						->result_array();
		return $res;
	}
	public function employee_bo_incharges_details($branch_indx = '',$office='AGAE'){
		$res = $this->db->select('e.*,ed.*,e.empid')
						->from('employee_master e')
						->join('employee_details ed','e.empid = ed.empid','left')
						->where('e.branch_indx',$branch_indx)
						->where('e.staff_type','Incharge')
						->where('e.office_code',$office)
						->order_by('e.section','asc')
						->order_by('empname','asc')
						->get()
						->result_array();
		return $res;
	}
	public function get_all_section_list(){ // all sections and branches
		$res = $this->db->select ('section')
						->from('section_master')
						->order_by('section','asc')
						->get()
						->result_array();
		return $res;
	}
		
	public function get_all_sections(){  // all sections only
		$res = $this->db->select ('*')
						->from('section_master')
						->where('sec_br_type','section')
						->order_by('section','asc')
//						->group_by('section')
						->get()
						->result_array();
		return $res;
	}
	public function get_all_branches(){  // all branches only
		$res = $this->db->select ('*')
						->from('section_master')
						->where('sec_br_type','branch')
						->order_by('section','asc')
//						->group_by('section')
						->get()
						->result_array();
		return $res;
	}
	public function get_bos_all_sections($bo_index = ''){
		$res = $this->db->select ('*')
						->from('section_master')
						->where('sec_br_type','section')
						->where('bo_index',$bo_index)
						->order_by('section','asc')
						->get()
						->result_array();
		return $res;
	}
	
/*
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
*/	
	public function get_all_branch_allotment_to_bo($empid = ''){
		$res = $this->db->select ('*')
						->from('section_branch_allotment')
						->where('empid_bo',$empid)
						->order_by('sallot_id','desc')
						->get()
						->result_array();
		return $res;
	}
	public function get_branch_officer_link_section($branch_indx = ''){
		$res = $this->db->select ('*')
						->from('section_master')
						->where('sec_br_type','section')
						->where('link_bo_index',$branch_indx)
						->order_by('section','asc')
						->get()
						->result_array();
		return $res;
	}
	public function get_dacadare_employee_office_orders($empid = ''){
		$res = $this->db->select('*')
						->from('office_order oo')
						->join('office_order_to_employee e','e.emp_order_id = oo.order_id')
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
	public function get_employee_clrh_history_all($empid = '', $leave_type = '', $leave_dr_year= '',$limit_to = 0){
		$get = $this->input->get(array('empid'), TRUE);
		$get_type = $this->input->get(array('leave_type'), TRUE);
		$get_year = $this->input->get(array('leave_dr_year'), TRUE);
		
		$this->db->select('lh.*')
				 ->from('employee_leave_debit lh');
	
		if($get['empid'] != ''){
			$this->db->where('lh.empid',$get['empid']);
		}
		if($get_type['leave_type'] != ''){
			$this->db->where('lh.leave_type',$get_type['leave_type']);
		}
		if($get_year['leave_dr_year'] != ''){
			$this->db->where('lh.leave_dr_year',$get_year['leave_dr_year']);
		}

		$this->db->order_by('lh.leave_from','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function get_employee_clrh_history($empid = '',$leave_type='',$leave_dr_year= ''){
		$res = $this->db->select('ld.*')
						->from('employee_leave_debit ld')						
						->where('ld.empid',$empid)
						->where('ld.leave_type',$leave_type)
						->where('ld.leave_dr_year',$leave_dr_year)
						->order_by('leave_from','asc')
						->get()
						->result_array();
		return $res;
	}
	
	public function get_employee_leave_history_all ($limit_to = 0){
		$get = $this->input->get(array('search'), TRUE);
		$get_type = $this->input->get(array('leave_type'), TRUE);
		$this->db->select('lh.*')
				 ->from('employee_leave_debit lh');
	
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('lh.empid',$get['search']);
				$this->db->or_like('lh.name',$get['search']);
			$this->db->group_end();
		}	
		if($get_type['leave_type'] != ''){
			$this->db->where('lh.leave_type',$get_type['leave_type']);
		}
		$this->db->order_by('lh.leave_from','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function get_employee_leave_history($empid = '',$leave_type=''){
		$res = $this->db->select('ld.*')
						->from('employee_leave_debit ld')						
						->where('ld.empid',$empid)
						->where('ld.leave_type',$leave_type)
						->order_by('leave_from','desc')
						->get()
						->result_array();
		return $res;
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
						->join('office_order_to_employee e','e.emp_order_id = oo.order_id')
						->where('e.empid',$empid)
						->group_start()
						->like('oo.title','APAR Booklet')
						->or_like('oo.details','apr booklet')
						->group_end()
						->order_by('order_id','desc')
						->get()
						->result_array();
		return $res;
	}
	public function get_employee_service_book($empid = ''){
		$res = $this->db->select('oo.*')
						->from('office_order oo')
						->join('office_order_to_employee e','e.emp_order_id = oo.order_id')
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
						->join('office_order_to_employee e','e.emp_order_id = oo.order_id')
						->where('e.empid',$empid)
						->group_start()
						->like('oo.title','gpf statement')
						->or_like('oo.details','gpf statement')
						->group_end()
						->get()
						->result_array();
		return $res;
	}
	
	public function get_employee_transfer_order ($limit_to = 0,$empid = ''){
		
		$this->db->select('*')
				 ->from('section_transfer_details')
				 ->where('emp_id',$empid);
	
		$this->db->order_by('update_dt','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}	
	
	
	
	public function get_employee_form_sixteen($empid = ''){
		$res = $this->db->select('*')
						->from('office_order oo')
						->join('office_order_to_employee e','e.emp_order_id = oo.order_id')
						->where('e.empid',$empid)
						->order_by('order_id','desc')
						->group_start()
						->like('oo.title','Form-16')
						->or_like('oo.details','Form-16')
						->group_end()
						->get()
						->result_array();
		return $res;
	}
	public function get_employee_notice_board(){
		$date = date('Y-m-d H:i:s');
		$res = $this->db->select('*')
						->from('employee_notice_board')
						->where('display','yes')
						->where('flash !=','yes')
						->where('flash !=','word')
						->where('date(expiry_dt) >= ',$date)
						->order_by('expiry_dt','asc')					
						->get()
						->result_array();
		return $res;
	}
	public function get_employee_notice_board_flash(){
		$date = date('Y-m-d H:i:s');
		$res = $this->db->select('*')
						->from('employee_notice_board')
						->where('display','yes')
						->where('flash','yes')
						->where('date(expiry_dt) >= ',$date)
						->order_by('expiry_dt','asc')					
						->get()
						->result_array();
		return $res;
	}
	public function get_employee_notice_board_flash_word(){
		$date = date('Y-m-d H:i:s');
		$res = $this->db->select('*')
						->from('employee_notice_board')
						->where('display','yes')
						->where('flash','word')
						->where('date(expiry_dt) >= ',$date)
						->order_by('expiry_dt','asc')					
						->get()
						->result_array();
		return $res;
	}
	public function get_employee_notice_board_achievement($limit_to=0,$office = 'AGAE'){
		
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('employee_notice_board')
				 ->where('display','yes')
				 ->where('flash','acheivement')
				 ->order_by('expiry_dt','desc');
				 
		$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_employee_notice_board_digitization($limit_to=0,$office = 'AGAE'){
		
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('employee_notice_board')
				 ->where('display','yes')
				 ->where('flash','performance')
				 ->order_by('expiry_dt','desc');
				 
		$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_all_form_sixteen($limit_to=0,$office = 'AGAE',$wing = 'administration'){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('office_order')
				 ->where('office',$office)
				 ->where('title','Form-16')
				 ->where('wing',$wing)
				 ->order_by('order_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('ord_empid',$get['search']);
				$this->db->or_like('order_id',$get['search']);
				$this->db->or_like('title',$get['search']);
				$this->db->or_like('attachment',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function get_employee_office_orders($limit_to = 0, $empid = '' ){
		$get = $this->input->get(array('date_from', 'date_to', 'wing', 'details'), TRUE);
		$this->db->select('*')
						->from('office_order ot')
						->join('office_order_to_employee e','e.emp_order_id = ot.order_id')
						->where('e.empid',$empid)
						->where('ot.title','Office Order');
						
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
		
		$this->db->order_by('ot.order_id','desc')
				 ->group_by('e.emp_order_id');
		
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}

	public function get_employee_circular($limit_to = 0,$office='AGAE'){
		$get = $this->input->get(array('date_from', 'date_to', 'wing', 'details'), TRUE);
		$this->db->select('*')
				 ->from('office_order')
				 ->where('office',$office)
				 ->where('status','Active')
				 ->where('title','All Circular')
				 ->where('wing != ','da_cadre');
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
		$this->db->order_by('update_dt','desc');
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
				 ->order_by('group_nm','asc')
				 ->order_by('section','asc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('group_nm',$get['search']);
				$this->db->or_like('section',$get['search']);
				$this->db->or_like('emp_name',$get['search']);
				$this->db->or_like('extension_no',$get['search']);
			$this->db->group_end();
		}
		$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function get_application_exam_list($limit_to = 0 ){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('employee_application')
				 ->where ('application_status <>','Cancelled')
//				 ->order_by('emp_id','desc');
				 ->order_by('applied_on','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->or_like('applied_on',$get['search']);
				$this->db->or_like('emp_id',$get['search']);
				$this->db->or_like('full_name',$get['search']);
				$this->db->or_like('exm_nm',$get['search']);
				$this->db->or_like('phone_office',$get['search']);
			$this->db->group_end();
		}
		$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	} 
	public function get_application_exam_other_list($limit_to = 0 ){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('employee_exam_other')
				 ->where ('appli_status !=','Cancelled')
				 ->order_by('appli_date','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->or_like('appli_date',$get['search']);
				$this->db->or_like('empid ',$get['search']);
				$this->db->or_like('name',$get['search']);
				$this->db->or_like('exam_name',$get['search']);
				$this->db->or_like('conducted_by ',$get['search']);
			$this->db->group_end();
		}
		$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	} 
	public function get_all_exam_list($limit_to = 0 ){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('employee_application_examlist')
				 ->where('off_on','No')
				 ->order_by('exam_name','asc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->or_like('exam_name',$get['search']);
			$this->db->group_end();
		}
		$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	} 
	public function getExamNameByID($id){
		return $this->db->select('exam_name')->from('employee_application_examlist')->where('exam_nm_id',$id)->get()->row_array();
	}
	public function addNewExamName($update){
		$this->db->insert('employee_application_examlist',$update);
		return $this->db->insert_id();
	}
	public function updateExamName($id,$update){
		$this->db->where('exam_nm_id',$id)->update('employee_application_examlist',$update);
		return $this->db->insert_id();
	}
	public function get_all_invited_exam_list($limit_to = 0 ){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('employee_application_examlist')
				 ->where('off_on','Yes')
				 ->order_by('exam_name','asc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->or_like('exam_name',$get['search']);
			$this->db->group_end();
		}
		$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	} 
	
	public function get_invite_exam_name_list(){
		$f_date = date('Y-m-d');
		$res = $this->db->select ('exam_name, exam_month, exam_year, exam_end_dt')
						->from('employee_application_examlist')
						->where ('off_on','Yes')
						->where('date(exam_start_dt) <= ',$f_date)
						->where('date(exam_end_dt) >= ',$f_date)
						->order_by('exam_name','asc')
						->group_by('exam_name')
						->get()
						->result_array();
		return $res;
	}
	
	public function get_exam_apply_closing_dt($exm_nm_new){
		$f_date = date('Y-m-d');
		$res = $this->db->select ('exam_end_dt')
						->from('employee_application_examlist')
						->where ('exam_name',$exm_nm_new)
						->where ('off_on','Yes')
						->where('date(exam_start_dt) <= ',$f_date)
						->where('date(exam_end_dt) >= ',$f_date)
						->group_by('exam_name')
						->get()
						->result_array();
		return $res;
	}
	
	public function get_epabx_extension_list_admin($limit_to=0 ,$office='AGAE', $group_nm = 'ADMINISTRATION'){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('epabx_extension')
				 ->where('office_code',$office)
				 ->where('group_nm',$group_nm)
				 ->order_by('section','asc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->or_like('section',$get['search']);
				$this->db->or_like('emp_name',$get['search']);
				$this->db->or_like('extension_no',$get['search']);
			$this->db->group_end();
		}
		$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}	
	public function get_epabx_extension_list_accounts($limit_to=0 ,$office='AGAE', $group_nm = 'ACCOUNTS'){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('epabx_extension')
				 ->where('office_code',$office)
				 ->where('group_nm',$group_nm)
				 ->order_by('section','asc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->or_like('section',$get['search']);
				$this->db->or_like('emp_name',$get['search']);
				$this->db->or_like('extension_no',$get['search']);
			$this->db->group_end();
		}
		$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}	
	public function get_epabx_extension_list_fund($limit_to=0 ,$office='AGAE', $group_nm = 'FUND'){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('epabx_extension')
				 ->where('office_code',$office)
				 ->where('group_nm',$group_nm)
				 ->order_by('section','asc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->or_like('section',$get['search']);
				$this->db->or_like('emp_name',$get['search']);
				$this->db->or_like('extension_no',$get['search']);
			$this->db->group_end();
		}
		$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}	
	public function get_epabx_extension_list_pension($limit_to=0 ,$office='AGAE', $group_nm = 'PENSION'){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('epabx_extension')
				 ->where('office_code',$office)
				 ->where('group_nm',$group_nm)
				 ->order_by('section','asc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->or_like('section',$get['search']);
				$this->db->or_like('emp_name',$get['search']);
				$this->db->or_like('extension_no',$get['search']);
			$this->db->group_end();
		}
		$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_employee_search_result($limit_to=0 ,$office='AGAE'){
		$date = date('Y-m-d H:i:s');
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('employee_master')
				 ->where('office_code',$office)
//				 ->where('date(dor) >= ',$date)
//				 ->where('status','Active')
				 ->where('da_cadare','0')
//				 ->order_by('desig','asc')
				 ->order_by('empname','asc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('empid',$get['search']);
				$this->db->or_like('empname',$get['search']);
				$this->db->or_like('desig',$get['search']);
				$this->db->or_like('section',$get['search']);
				$this->db->or_like('mbno',$get['search']);
				$this->db->or_like('nicmail',$get['search']);
			$this->db->group_end();
		}
		$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}	
	public function get_employee_charge_result($limit_to=0 ,$office='AGAE'){
		$date = date('Y-m-d H:i:s');
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('e.empid,e.picture,e.gender,e.empname,e.desig,e.mbno,e.nicmail')
				 ->from('employee_master e')
//				 ->join('section_allotment_to_emp es','e.empid = es.empid_inch_bo','right')
				 ->where('e.office_code',$office)
				 ->where('date(e.dor) >= ',$date)
				 ->where('e.status','Active')
				 ->where('e.da_cadare','0')
//				 ->order_by('e.desig','asc')
				 ->order_by('e.empname','asc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('e.empid',$get['search']);
				$this->db->or_like('e.empname',$get['search']);
			$this->db->group_end();
		}
		$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}	
	public function get_employee_charge_by_section($section_desc = ''){
		$date = date('Y-m-d H:i:s');
		$res = $this->db->select ('s.*,e.empid,e.empname,e.picture,e.gender,e.desig,e.mbno,e.nicmail,e.status,e.dor')
						->from('section_allotment_to_emp s')
						->join('employee_master e','e.empid = s.empid_inch_bo','left')						
						->where('s.section_desc', $section_desc)
						->where('e.status','Active')
						->where('date(e.dor) >= ',$date)
						->get()
						->result_array();
		return $res;
	}
	public function get_new_appointment_list($limit_to=0 ,$office='AGAE'){
		$date= Date('Y-m-d');
		$dateApp = date('Y-m-d', strtotime($date. ' - 6 months'));
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('employee_master')
				 ->where('office_code',$office)
				 ->where('date(doj_off) >= ',$dateApp)
				 ->where('status','Active')
				 ->where('da_cadare','0')
//				 ->order_by('desig','asc')
				 ->order_by('empname','asc');
		
		$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}	
	public function get_new_promotion_list($limit_to=0 ,$office='AGAE'){
		$date= Date('Y-m-d');
		$datePro = date('Y-m-d', strtotime($date. ' - 3 months'));
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('employee_master')
				 ->where('office_code',$office)
				 ->where('date(promotion_dt) >= ',$datePro)
				 ->where('status','Active')
				 ->where('da_cadare','0')
//				 ->order_by('desig','asc')
				 ->order_by('empname','asc');
		
		$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_new_transferred_list($limit_to=0 ,$office='AGAE'){
		$date= Date('Y-m-d');
		$datePro = date('Y-m-d', strtotime($date. ' - 1 months'));
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('employee_master')
				 ->where('office_code',$office)
				 ->where('date(trans_order_dt) >= ',$datePro)
				 ->where('status','Active')
				 ->where('da_cadare','0')
//				 ->order_by('desig','asc')
				 ->order_by('empname','asc');
		
		$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_employee_birthday_list($limit_to=0 ,$office='AGAE'){
		$dateMD= Date('m-d');		
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('employee_master')
				 ->where('office_code',$office)
				 ->where('substr(dob,-5) =',$dateMD)
//				 ->like('date_format(date(dob),"m-d")', '01-01')
				 ->where('status','Active')
				 ->where('da_cadare','0')
				 ->order_by('empname','asc');
	
		$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function check_BirthDaySMS($office='AGAE'){
		$dateSMS = Date('Y-m-d');
		$res = $this->db->select('*')
					 ->from('bsms_tracker')
					 ->like('date(sent_dt)',$dateSMS)
					 ->order_by('bsms_id','asc')
					 ->get()
					 ->row_array();
		return $res;
	}
	public function add_bsms_tracker($post){
		$this->db->insert('bsms_tracker',$post);
		return true;
	}
	public function SendBirthDaySMS($office='AGAE'){
		$dateMD= Date('m-d');
		$res = $this->db->select('empname,mbno')
					 ->from('employee_master')
					 ->where('office_code',$office)
					 ->where('substr(dob,-5) =',$dateMD)
					 ->where('status','Active')
					 ->where('da_cadare','0')
					 ->order_by('empname','asc')
					 ->get()
					 ->result_array();
		return $res;
	}
	public function get_employee_retirement_list($limit_to=0 ,$office='AGAE'){
		$d = new DateTime(); 
		$dateR = $d->format('Y-m-t' );
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('employee_master')
				 ->where('office_code',$office)
				 ->where('date(dor) = ',$dateR)
				 ->where('status','Active')
				 ->where('da_cadare','0')
//				 ->order_by('desig','asc')
				 ->order_by('empname','asc');
		
		$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
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
				$this->db->or_like('extension_no',$get['search']);
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
	public function get_application_exam_list_edit($id = '',$office='AGAE'){
		$res = $this->db->select('*')
						->from('employee_application')
						->where('appl_id',$id)
//						->where('office_code',$office)
						->get()
						->row_array();
		return $res;
	}
	public function get_application_exam_other_list_edit($id = '',$office='AGAE'){
		$res = $this->db->select('*')
						->from('employee_exam_other')
						->where('exam_odr_id',$id)
//						->where('office_code',$office)
						->get()
						->row_array();
		return $res;
	}
	public function get_application_exam_invite_update($id = '',$office='AGAE'){
		$res = $this->db->select('*')
						->from('employee_application_examlist')
						->where('exam_nm_id',$id)
						->get()
						->row_array();
		return $res;
	}
	
	public function get_application_exam_other_update($id){
		$res = $this->db->select('*')
						->from('employee_exam_other')
						->where('appl_flag','P')
						->where('exam_odr_id',$id)
						->get()
						->row_array();
		return $res;
	} 
	public function get_application_exam_other_process($id){
		$res = $this->db->select('*')
						->from('employee_exam_other')
						->where('appl_flag','R')
						->where('exam_odr_id',$id)
						->get()
						->row_array();
		return $res;
	} 
	public function get_bill_reimbursement_update($id){
		$res = $this->db->select('*')
						->from('employee_bills')
//						->where('empid',$empid)
						->where('bill_id',$id)
						->get()
						->row_array();
		return $res;
	} 
	public function fetch_leave_application_on_mc($id){
		$res = $this->db->select('*')
						->from('employee_leave_debit')
						->where('mc_varified','Pending')
						->where('leav_id',$id)
						->get()
						->row_array();
		return $res;
	} 
	public function get_bill_reimbursement_download($date_from,$date_to){
		$f_date = date('Y-m-d',strtotime($date_from));
		$t_date = date('Y-m-d',strtotime($date_to));
		$res = $this->db->select('*')
						->from('employee_bills')
						->where('date(dag_dt) >= ',$f_date)
						->where('date(dag_dt) <= ',$t_date)
//						->where('appli_status','Sanctioned')
						->get()
						->result_array();
		return $res;
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
	
	public function update_application_exam_status($id=0,$office = 'AGAE'){
		$post = $this->input->post(array('application_status','result_order_no','result_order_dt','auth_nm','auth_dg','pan_no','pan_update'), TRUE);
		$update = array();
		if($post['application_status'] != ''){$update['application_status'] = $post['application_status'];}
		if($post['result_order_no'] != ''){$update['result_order_no'] = $post['result_order_no'];}
		if($post['result_order_dt'] != ''){$update['result_order_dt'] = date('Y-m-d',strtotime($post['result_order_dt']));}
		
		if($post['pan_update'] != 'NIL'){
			if($post['pan_update'] == 'AAO'){
				$update['sec_autho_nm'] = $post['auth_nm'];
				$update['sec_autho_desig'] = $post['auth_dg'];
				$update['sec_autho_pan'] = $post['pan_no'];
			}
			if($post['pan_update'] == 'SAO'){
				$update['recom_autho'] = $post['auth_nm'];
				$update['recom_autho_desig'] = $post['auth_dg'];
				$update['recom_autho_pan'] = $post['pan_no'];
			}
		}

		if(!empty($update) && $id != ''){
			$this->db->where('appl_id',$id)->update('employee_application',$update);
		}
	}
	public function update_application_exam_other_status($id=0,$office = 'AGAE'){
		$application = $this->input->post(array('appli_status'), TRUE);
		$update = array();
		if($application['appli_status'] != ''){$update['appli_status'] = $application['appli_status'];}
		if(!empty($update) && $id != ''){
			$this->db->where('exam_odr_id',$id)->update('employee_exam_other',$update);
		}
	}
	public function update_exam_invite_status($id=0,$office = 'AGAE'){
		$exams = $this->input->post(array('off_on','exam_month','exam_year','exam_start_dt','exam_end_dt','prevs_end_dt','extn_order','extn_order_dt','status','update_dt'), TRUE);
		$update = array();
		if($exams['off_on'] != ''){$update['off_on'] = $exams['off_on'];}
		if($exams['exam_month'] != ''){$update['exam_month'] = $exams['exam_month'];}
		if($exams['exam_year'] != ''){$update['exam_year'] = $exams['exam_year'];}
		if($exams['off_on'] == 'Yes'){
			if($exams['exam_start_dt'] != ''){$update['exam_start_dt'] = date('Y-m-d',strtotime($exams['exam_start_dt']));}
			if($exams['exam_end_dt'] != ''){$update['exam_end_dt'] = date('Y-m-d',strtotime($exams['exam_end_dt']));}
		}else{
			if($exams['exam_start_dt'] != ''){$update['exam_start_dt'] ='0000-00-00';}
			if($exams['exam_end_dt'] != ''){$update['exam_end_dt'] ='0000-00-00';}
		}
		if($exams['prevs_end_dt'] != ''){$update['prevs_end_dt'] = date('Y-m-d',strtotime($exams['prevs_end_dt']));}
		if($exams['extn_order'] != ''){$update['extn_order'] = $exams['extn_order'];}
		if($exams['extn_order_dt'] != ''){$update['extn_order_dt'] = date('Y-m-d',strtotime($exams['extn_order_dt']));}
		$update['status'] = $exams['status'];
		$update['update_dt'] = date('Y-m-d H:i:s');
		
		if(!empty($update) && $id != ''){
			$this->db->where('exam_nm_id',$id)->update('employee_application_examlist',$update);
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
		
	public function add_employee_application($emp_id = 0){
		$post =  $this->input->post(array('exm_nm','exm_month','exm_year','full_name','desig','doa','basic_pay','section_name','group_name','phone_office','father_name','dob','gender','quali','category','gr_serial_no','gr_page_no','mts_exm_month','mts_exm_year','index_no','post_emp','post_doa','break_service','post_length_service','post_length_service_on','break_service_from','break_service_to','is_appeared_in_exam','yr_month_1','index_1','center_1','expt_1','yr_month_2','index_2','center_2','expt_2','addr','email','mobile','hindi_apprd','st_speed','location_training','training_from','training_to','recom_autho','recom_autho_desig','sec_autho_pan','current_loc'), TRUE);
		$post['emp_id'] = $emp_id;
		if($post['exm_nm'] == 'Others'){
			$post['exm_nm'] = $this->input->post('other_exam_name',true);
		}
//-----------------		
		$sec_autho = explode('@@@',$post['sec_autho_pan']);
		$post['sec_autho_nm'] = isset($sec_autho[0]) ? $sec_autho[0] : '';
		$post['sec_autho_desig'] = isset($sec_autho[1]) ? $sec_autho[1] : '';
		$post['sec_autho_pan'] = isset($sec_autho[2]) ? $sec_autho[2] : '';
		$post['current_loc'] =  isset($sec_autho[2]) ? $sec_autho[2] : '';
//-----------------		
		$post['dob'] = !empty($post['dob']) ? date('Y-m-d',strtotime($post['dob'])) : '';
		$post['doa'] = !empty($post['doa']) ? date('Y-m-d',strtotime($post['doa'])) : '';
		$post['post_doa'] = !empty($post['post_doa']) ? date('Y-m-d',strtotime($post['post_doa'])) : '';
		$post['post_length_service_on'] = !empty($post['post_length_service_on']) ? date('Y-m-d',strtotime($post['post_length_service_on'])) : '';
		$post['break_service_from'] = !empty($post['break_service_from']) ? date('Y-m-d',strtotime($post['break_service_from'])) : '';
		$post['break_service_to'] = !empty($post['break_service_to']) ? date('Y-m-d',strtotime($post['break_service_to'])) : '';
		$post['training_from'] = !empty($post['training_from']) ? date('Y-m-d',strtotime($post['training_from'])) : '';
		$post['training_to'] = !empty($post['training_to']) ? date('Y-m-d',strtotime($post['training_to'])) : '';
		$post['application_status'] = 'Submitted';
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
	public function get_employee_application_submitted($emp_id = 0, $exm_nm_new = '',$exm_month_new = '', $exm_year_new = ''){
		$res = $this->db->select('ea.*')
						->from('employee_application ea')
//						->join('employee_master e','ea.emp_id = e.empid')
						->where('ea.emp_id',$emp_id)
						->where('ea.exm_nm',$exm_nm_new)
						->where('ea.exm_month',$exm_month_new)
						->where('ea.exm_year',$exm_year_new)
						->order_by('applied_on','desc')
						->get()
						->row_array();
		return $res;
	}
	public function get_application_exam_info($empid = ''){
		$res = $this->db->select('*')
						->from('employee_application ld')
						->where('ld.emp_id',$empid)
						->order_by('applied_on','desc')
						->get()
						->result_array();
		return $res;
	}
	public function get_application_exam_other_info($empid = ''){
		$res = $this->db->select('*')
						->from('employee_exam_other ld')
						->where('ld.empid',$empid)
						->order_by('appli_date','desc')
						->get()
						->result_array();
		return $res;
	}
	public function get_application_pending_recommendaton($empid = ''){
		$res = $this->db->select('*')
						->from('employee_application ld')
						->where('ld.current_loc',$empid)
						->order_by('applied_on','asc')
						->get()
						->result_array();
		return $res;
	}	
	public function get_application_pending_recommendaton_count($empid = ''){	
		$results = $this->db->select('count(*) appli_tot')
				 ->from('employee_application ld')
				 ->where('ld.current_loc',$empid)
			     ->get()
				 ->result_array();
		return $results;
	}
	public function get_application_nondept_recommendaton_count($empid = ''){	
		$results = $this->db->select('count(*) nondr_tot')
				 ->from('employee_exam_other ld')
				 ->where('ld.currently_with',$empid)
				 ->where('ld.appl_flag','P')
			     ->get()
				 ->result_array();
		return $results;
	}
	public function get_application_nondept_process_count($empid = ''){	
		$results = $this->db->select('count(*) nondp_tot')
				 ->from('employee_exam_other ld')
				 ->where('ld.currently_with',$empid)
				 ->where('ld.appl_flag','R')
				 ->where('ld.appli_status','Under Process')
			     ->get()
				 ->result_array();
		return $results;
	}
	public function get_application_passport_recommendaton_count($empid = ''){	
		$results = $this->db->select('count(*) ppr_tot')
				 ->from('employee_passport ld')
				 ->where('ld.currently_with',$empid)
				 ->group_start()
				 ->like('ld.appl_flag','S')
				 ->or_like('ld.appl_flag','F')
				 ->group_end()
			     ->get()
				 ->result_array();
		return $results;
	}
	public function get_application_passport_process_count($empid = ''){	
		$results = $this->db->select('count(*) ppp_tot')
				 ->from('employee_passport ld')
				 ->where('ld.appl_flag','A')
				 ->where('ld.currently_with',$empid)
			     ->get()
				 ->result_array();
		return $results;
	}
/*	
	public function get_application_pending_permission_all( $limit_to = 0){
		$res =	$this->db->select('*')
					->from('employee_exam_other ld')
					->where('ld.appl_flag','R')
//					->like('ld.appl_flag','Under Process')
					->order_by('appli_date','desc')
					->get()
					->result_array();
		return $res;
	}
*/
	public function get_application_pending_permission_all( $limit_to = 0){
		$get = $this->input->get(array('search', 'appli_status'), TRUE);
		$this->db->select('*')
			->from('employee_exam_other ld')
			->where('ld.appl_flag','R')
			->order_by('ld.appli_date','desc');
		if($get['search'] != ''){
			$this->db->group_start();
			$this->db->like('ld.name',$get['search']);
			$this->db->group_end();
		}
		if($get['appli_status'] != ''){
			$this->db->group_start();
			$this->db->where('ld.appli_status',$get['appli_status']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}

	public function get_leave_on_mc_all(){
		$res = $this->db->select('*')
						->from('employee_leave_debit ld')
						->where('ld.mc_varified','Pending')
						->where('ld.mc_yes_no','Yes')
						->order_by('application_dt','asc')
						->get()
						->result_array();
		return $res;
	}
	public function get_application_other_pending_recommendaton($empid = ''){
		$res = $this->db->select('*')
						->from('employee_exam_other ld')
						->where('ld.currently_with',$empid)
						->where('ld.appli_status !=','Permitted')
						->where('ld.appl_flag','P')
						->order_by('appli_date','asc')
						->get()
						->result_array();
		return $res;
	}
	public function get_application_pending_permission($empid = ''){
		$res = $this->db->select('*')
						->from('employee_exam_other ld')
						->where('ld.currently_with',$empid)
						->where('ld.appli_status','Under Process')
						->where('ld.appl_flag','R')
						->order_by('appli_date','asc')
						->get()
						->result_array();
		return $res;
	}
	public function get_application_pending_permission_count($empid = ''){	
		$results = $this->db->select('count(*) appli_tot')
				 ->from('employee_exam_other ld')
				 ->where('ld.currently_with',$empid)
			     ->get()
				 ->result_array();
		return $results;
	}
	public function get_bill_details_all($empid = ''){
		$res = $this->db->select('*')
						->from('employee_bills ld')
						->where('ld.appli_status !=','Paid')
						->order_by('bill_id','asc')
						->get()
						->result_array();
		return $res;
	}
	public function get_transfer_release_records($empid = ''){
		$res = $this->db->select('*')
						->from('section_transfer_details')
						->where('release_autho_pan',$empid)
						->where('charge_type','Fresh')
						->like('status','Initiated')
						->order_by('update_dt','asc')
						->get()
						->result_array();
		return $res;
	}
	public function get_release_pending_transfer_count($empid = ''){
		$results = $this->db->select('count(*) relea_tot')
				 ->from('section_transfer_details')
				 ->where('release_autho_pan',$empid)
				 ->where('charge_type','Fresh')
				 ->like('status','Initiated')
				 ->order_by('update_dt','asc')
			     ->get()
				 ->result_array();
		return $results;
	}
	public function get_transfer_joining_records($empid = ''){
		$res = $this->db->select('*')
						->from('section_transfer_details')
						->where('joing_autho_pan',$empid)
						->where('charge_type','Fresh')
						->like('status','Released')
						->or_like('status','Joined')
						->order_by('update_dt','asc')
						->get()
						->result_array();
		return $res;
	}
	public function get_joining_pending_transfer_count($empid = ''){
		$results = $this->db->select('count(*) join_trans')
				 ->from('section_transfer_details')
				 ->where('joing_autho_pan',$empid)
				 ->where('charge_type','Fresh')
				 ->like('status','Released')
				 ->order_by('update_dt','asc')
			     ->get()
				 ->result_array();
		return $results;
	}
	
	public function update_employee_pan_no($office_id = ''){
		$post = $this->input->post(array('empid','office_id','offic_id'), TRUE);
		$update = array();

		$update['empid'] = $post['empid'];
		
		if(!empty($update) && $office_id != ''){
			$this->db->where('office_id',$office_id)->update('employee_master',$update);
			$this->db->where('offic_id',$office_id)->update('employee_details',$update);
		}
	}
	public function update_employee_application_recom($id=0){
		$post = $this->input->post(array('sec_autho_remrk','sec_autho_dt','recom_autho_remark','application_status','recom_date','recom_autho_detail','recom_autho','recom_autho_desig','recom_autho_pan','current_loc'), TRUE);
		$update = array();
		
		$update['sec_autho_remrk'] = $post['sec_autho_remrk'];
		$update['sec_autho_dt'] = !empty($post['sec_autho_dt']) ? date('Y-m-d',strtotime($post['sec_autho_dt'])) : '';
		
		if(!empty($post['recom_autho_detail'])){
			$recom_autho_det = explode('@@@',$post['recom_autho_detail']);
			$update['recom_autho'] = isset($recom_autho_det[0]) ? $recom_autho_det[0] : '' ;
			$update['recom_autho_desig'] = isset($recom_autho_det[1]) ? $recom_autho_det[1] : '' ;
			$update['recom_autho_pan'] = isset($recom_autho_det[2]) ? $recom_autho_det[2] : '' ;
			$update['current_loc'] = isset($recom_autho_det[2]) ? $recom_autho_det[2] : '';
		}else{
			$update['recom_autho'] = $post['recom_autho'];
			$update['recom_autho_desig'] = $post['recom_autho_desig'];
			$update['recom_autho_pan'] = $post['recom_autho_pan'];
			$update['current_loc'] = '';
		}
		
		$update['recom_autho_remark'] = $post['recom_autho_remark'];
		$update['application_status'] = $post['application_status'];
		$update['recom_date'] = !empty($post['recom_date']) ? date('Y-m-d',strtotime($post['recom_date'])) : '';
		
		if(!empty($update) && $id != ''){
			$this->db->where('appl_id',$id)->update('employee_application',$update);
		}
	}
	public function get_employee_application_recomn($id = 0){
		$res = $this->db->select('*')
						->from('employee_application')
						->where('appl_id',$id)
						->order_by('applied_on','desc')
						->get()
						->row_array();
		return $res;
	}
	
	public function get_all_employee_examinations_list(){
		$res = $this->db->select('exm_nm')
						->from('employee_application')
						->order_by('exm_nm','desc')
						->group_by('exm_nm')
						->get()
						->result_array();
		return $res;
	}	
	public function get_all_employee_examinations($limit_to=0 ){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('employee_application')
				 ->order_by('appl_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('emp_id',$get['search']);
				$this->db->or_like('full_name',$get['search']);
				$this->db->or_like('application_status',$get['search']);
			$this->db->group_end();
		}
		
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function all_asset_declarations($limit_to=0 ){
		$get = $this->input->get(array('search','st_year'), TRUE);
		$this->db->select('*')
				 ->from('employee_property_statement')
				 ->order_by('pst_id','desc');
		if($get['st_year'] != ''){
			$this->db->group_start();
				$this->db->where('pst_year',$get['st_year']);
			$this->db->group_end();
		}
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('empid',$get['search']);
				$this->db->or_like('emp_name',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function asset_declarations_ById($id = ''){
		$res = $this->db->select('*')
						->from('employee_property_statement')
						->where('pst_id',$id)
						->get()
						->row_array();
		return $res;
	}
	public function update_asset_declaration($id=0){
		$post = $this->input->post(array('empid','b_pay','pst_as_on','pst_year','decl_for','decl_date','decl_place','proty_location_1',
		'proty_detail_1','prsnt_value_1','proty_owner_1','mode_acquin_1','income_proty_1','remark_1','proty_location_2','proty_detail_2','prsnt_value_2','proty_owner_2','mode_acquin_2','income_proty_2','remark_2',
		'proty_location_3','proty_detail_3','prsnt_value_3','proty_owner_3','mode_acquin_3','income_proty_3','remark_3','proty_location_4','proty_detail_4','prsnt_value_4','proty_owner_4','mode_acquin_4','income_proty_4','remark_4',
		'proty_location_5','proty_detail_5','prsnt_value_5','proty_owner_5','mode_acquin_5','income_proty_5','remark_5','proty_location_6','proty_detail_6','prsnt_value_6','proty_owner_6','mode_acquin_6','income_proty_6','remark_6',
		'proty_location_7','proty_detail_7','prsnt_value_7','proty_owner_7','mode_acquin_7','income_proty_7','remark_7','proty_location_8','proty_detail_8','prsnt_value_8','proty_owner_8','mode_acquin_8','income_proty_8','remark_8',
		'proty_location_9','proty_detail_9','prsnt_value_9','proty_owner_9','mode_acquin_9','income_proty_9','remark_9','proty_location_10','proty_detail_10','prsnt_value_10','proty_owner_10','mode_acquin_10','income_proty_10','remark_10',
		), TRUE);
		$update = array();
		$empid = $post['empid'];
		$property_slno = $post['property_slno'];
		
		if(!empty($post['b_pay'])){$update['b_pay'] =  $post['b_pay'];}		
		$update['pst_as_on'] = $post['pst_as_on'] !='00-00-0000' ? date('Y-m-d',strtotime($post['pst_as_on'])) : '0000-00-00';
		if(!empty($post['pst_year'])){$update['pst_year'] =  $post['pst_year'];}
		if(!empty($post['decl_for'])){$update['decl_for'] =  $post['decl_for'];}
		$update['decl_date'] = $post['decl_date'] !='00-00-0000' ? date('Y-m-d',strtotime($post['decl_date'])) : '0000-00-00';

		if(!empty($post['decl_place'])){$update['decl_place'] =  $post['decl_place'];}
		if(!empty($post['proty_location_1'])){$update['proty_location_1'] =  $post['proty_location_1'];}
		if(!empty($post['proty_detail_1'])){$update['proty_detail_1'] =  $post['proty_detail_1'];}
		if(!empty($post['prsnt_value_1'])){$update['prsnt_value_1'] =  $post['prsnt_value_1'];}
		if(!empty($post['proty_owner_1'])){$update['proty_owner_1'] =  $post['proty_owner_1'];}
		if(!empty($post['mode_acquin_1'])){$update['mode_acquin_1'] =  $post['mode_acquin_1'];}
		if(!empty($post['income_proty_1'])){$update['income_proty_1'] =  $post['income_proty_1'];}
		if(!empty($post['remark_1'])){$update['remark_1'] =  $post['remark_1'];}
		if(!empty($post['proty_location_2'])){$update['proty_location_2'] =  $post['proty_location_2'];}
		if(!empty($post['proty_detail_2'])){$update['proty_detail_2'] =  $post['proty_detail_2'];}
		if(!empty($post['prsnt_value_2'])){$update['prsnt_value_2'] =  $post['prsnt_value_2'];}
		if(!empty($post['proty_owner_2'])){$update['proty_owner_2'] =  $post['proty_owner_2'];}
		if(!empty($post['mode_acquin_2'])){$update['mode_acquin_2'] =  $post['mode_acquin_2'];}
		if(!empty($post['income_proty_2'])){$update['income_proty_2'] =  $post['income_proty_2'];}
		if(!empty($post['remark_2'])){$update['remark_2'] =  $post['remark_2'];}
		if(!empty($post['proty_location_3'])){$update['proty_location_3'] =  $post['proty_location_3'];}
		if(!empty($post['proty_detail_3'])){$update['proty_detail_3'] =  $post['proty_detail_3'];}
		if(!empty($post['prsnt_value_3'])){$update['prsnt_value_3'] =  $post['prsnt_value_3'];}
		if(!empty($post['proty_owner_3'])){$update['proty_owner_3'] =  $post['proty_owner_3'];}
		if(!empty($post['mode_acquin_3'])){$update['mode_acquin_3'] =  $post['mode_acquin_3'];}
		if(!empty($post['income_proty_3'])){$update['income_proty_3'] =  $post['income_proty_3'];}
		if(!empty($post['remark_3'])){$update['remark_3'] =  $post['remark_3'];}
		if(!empty($post['proty_location_4'])){$update['proty_location_4'] =  $post['proty_location_4'];}
		if(!empty($post['proty_detail_4'])){$update['proty_detail_4'] =  $post['proty_detail_4'];}
		if(!empty($post['prsnt_value_4'])){$update['prsnt_value_4'] =  $post['prsnt_value_4'];}
		if(!empty($post['proty_owner_4'])){$update['proty_owner_4'] =  $post['proty_owner_4'];}
		if(!empty($post['mode_acquin_4'])){$update['mode_acquin_4'] =  $post['mode_acquin_4'];}
		if(!empty($post['income_proty_4'])){$update['income_proty_4'] =  $post['income_proty_4'];}
		if(!empty($post['remark_4'])){$update['remark_4'] =  $post['remark_4'];}
		if(!empty($post['proty_location_5'])){$update['proty_location_5'] =  $post['proty_location_5'];}
		if(!empty($post['proty_detail_5'])){$update['proty_detail_5'] =  $post['proty_detail_5'];}
		if(!empty($post['prsnt_value_5'])){$update['prsnt_value_5'] =  $post['prsnt_value_5'];}
		if(!empty($post['proty_owner_5'])){$update['proty_owner_5'] =  $post['proty_owner_5'];}
		if(!empty($post['mode_acquin_5'])){$update['mode_acquin_5'] =  $post['mode_acquin_5'];}
		if(!empty($post['income_proty_5'])){$update['income_proty_5'] =  $post['income_proty_5'];}
		if(!empty($post['remark_5'])){$update['remark_5'] =  $post['remark_5'];}
		if(!empty($post['proty_location_6'])){$update['proty_location_6'] =  $post['proty_location_6'];}
		if(!empty($post['proty_detail_6'])){$update['proty_detail_6'] =  $post['proty_detail_6'];}
		if(!empty($post['prsnt_value_6'])){$update['prsnt_value_6'] =  $post['prsnt_value_6'];}
		if(!empty($post['proty_owner_6'])){$update['proty_owner_6'] =  $post['proty_owner_6'];}
		if(!empty($post['mode_acquin_6'])){$update['mode_acquin_6'] =  $post['mode_acquin_6'];}
		if(!empty($post['income_proty_6'])){$update['income_proty_6'] =  $post['income_proty_6'];}
		if(!empty($post['remark_6'])){$update['remark_6'] =  $post['remark_6'];}
		if(!empty($post['proty_location_7'])){$update['proty_location_7'] =  $post['proty_location_7'];}
		if(!empty($post['proty_detail_7'])){$update['proty_detail_7'] =  $post['proty_detail_7'];}
		if(!empty($post['prsnt_value_7'])){$update['prsnt_value_7'] =  $post['prsnt_value_7'];}
		if(!empty($post['proty_owner_7'])){$update['proty_owner_7'] =  $post['proty_owner_7'];}
		if(!empty($post['mode_acquin_7'])){$update['mode_acquin_7'] =  $post['mode_acquin_7'];}
		if(!empty($post['income_proty_7'])){$update['income_proty_7'] =  $post['income_proty_7'];}
		if(!empty($post['remark_7'])){$update['remark_7'] =  $post['remark_7'];}
		if(!empty($post['proty_location_8'])){$update['proty_location_8'] =  $post['proty_location_8'];}
		if(!empty($post['proty_detail_8'])){$update['proty_detail_8'] =  $post['proty_detail_8'];}
		if(!empty($post['prsnt_value_8'])){$update['prsnt_value_8'] =  $post['prsnt_value_8'];}
		if(!empty($post['proty_owner_8'])){$update['proty_owner_8'] =  $post['proty_owner_8'];}
		if(!empty($post['mode_acquin_8'])){$update['mode_acquin_8'] =  $post['mode_acquin_8'];}
		if(!empty($post['income_proty_8'])){$update['income_proty_8'] =  $post['income_proty_8'];}
		if(!empty($post['remark_8'])){$update['remark_8'] =  $post['remark_8'];}
		if(!empty($post['proty_location_9'])){$update['proty_location_9'] =  $post['proty_location_9'];}
		if(!empty($post['proty_detail_9'])){$update['proty_detail_9'] =  $post['proty_detail_9'];}
		if(!empty($post['prsnt_value_9'])){$update['prsnt_value_9'] =  $post['prsnt_value_9'];}
		if(!empty($post['proty_owner_9'])){$update['proty_owner_9'] =  $post['proty_owner_9'];}
		if(!empty($post['mode_acquin_9'])){$update['mode_acquin_9'] =  $post['mode_acquin_9'];}
		if(!empty($post['income_proty_9'])){$update['income_proty_9'] =  $post['income_proty_9'];}
		if(!empty($post['remark_9'])){$update['remark_9'] =  $post['remark_9'];}
		if(!empty($post['proty_location_10'])){$update['proty_location_10'] =  $post['proty_location_10'];}
		if(!empty($post['proty_detail_10'])){$update['proty_detail_10'] =  $post['proty_detail_10'];}
		if(!empty($post['prsnt_value_10'])){$update['prsnt_value_10'] =  $post['prsnt_value_10'];}
		if(!empty($post['proty_owner_10'])){$update['proty_owner_10'] =  $post['proty_owner_10'];}
		if(!empty($post['mode_acquin_10'])){$update['mode_acquin_10'] =  $post['mode_acquin_10'];}
		if(!empty($post['income_proty_10'])){$update['income_proty_10'] =  $post['income_proty_10'];}
		if(!empty($post['remark_10'])){$update['remark_10'] =  $post['remark_10'];}
		

/*		
		if(!empty($post['decl_place'])){$update['decl_place'] =  $post['decl_place'];}
		if(!empty($post['proty_location_1'])){$update['proty_location_1'] =  $post['proty_location_1'];}
		if(!empty($post['proty_detail_1'])){$update['proty_detail_1'] =  $post['proty_detail_1'];}
		if(!empty($post['prsnt_value_1'])){$update['prsnt_value_1'] =  $post['prsnt_value_1'];}
		if(!empty($post['proty_owner_1'])){$update['proty_owner_1'] =  $post['proty_owner_1'];}
		if(!empty($post['mode_acquin_1'])){$update['mode_acquin_1'] =  $post['mode_acquin_1'];}
		if(!empty($post['income_proty_1'])){$update['income_proty_1'] =  $post['income_proty_1'];}
		if(!empty($post['remark_1'])){$update['remark_1'] =  $post['remark_1'];}
		if(!empty($post['proty_location_2'])){$update['proty_location_2'] =  $post['proty_location_2'];}
		if(!empty($post['proty_detail_2'])){$update['proty_detail_2'] =  $post['proty_detail_2'];}
		if(!empty($post['prsnt_value_2'])){$update['prsnt_value_2'] =  $post['prsnt_value_2'];}
		if(!empty($post['proty_owner_2'])){$update['proty_owner_2'] =  $post['proty_owner_2'];}
		if(!empty($post['mode_acquin_2'])){$update['mode_acquin_2'] =  $post['mode_acquin_2'];}
		if(!empty($post['income_proty_2'])){$update['income_proty_2'] =  $post['income_proty_2'];}
		if(!empty($post['remark_2'])){$update['remark_2'] =  $post['remark_2'];}
*/
		if(!empty($update) && $id != ''){
			$this->db->where('pst_id',$id)->where('empid',$empid)->update('employee_property_statement',$update);
		}
	}
	public function all_asset_declarations_total($limit_to=0 ){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('empid, emp_name,emp_desig, mobile_no,pst_year, count(*) tot')
				 ->from('employee_property_statement')
				 ->order_by('pst_id','desc')
//				 ->order_by('tot','asc')
				 ->group_by('empid')
				 ->group_by('pst_year');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('empid',$get['search']);
				$this->db->or_like('emp_name',$get['search']);
				$this->db->or_like('pst_year',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
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
						->order_by('leave_type','asc')
						->group_by('leave_type')
						->get()
						->result_array();
		return $res;
	}
	public function get_all_training_ids(){
		$res = $this->db->select ('trang_id')
						->from('training_master')
						->order_by('trang_id','desc')
//						->group_by('trang_id')
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
	public function get_all_transfer_ids(){
		$res = $this->db->select ('transf_order_id')
						->from('section_transfer_master')
						->order_by('transf_id','desc')
//						->group_by('transf_id')
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
	public function all_employees_trasfers($office = 'AGAE'){
		$post = $this->input->post(array('date_from','date_to', 'order_group'), TRUE);
		$res = $this->db->select('et.*')
						->from('section_transfer_details et');
		if($post['date_from'] != ''){
			$f_date = date('Y-m-d',strtotime($post['date_from']));
			$this->db->where('date(et.trans_order_dt) >= ',$f_date);
		}
		if($post['date_to'] != ''){
			$t_date = date('Y-m-d',strtotime($post['date_to']));
			$this->db->where('date(et.trans_order_dt) <= ',$t_date);
		}
		if($post['order_group'] != ''){
			$this->db->where('et.order_group',$post['order_group']);
		}							
		$res = $this->db->order_by('et.trans_order_dt','desc')
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
	public function all_employees_training_faculties($office = 'AGAE'){
		$post = $this->input->post(array('date_from','date_to', 'training_type'), TRUE);
		$res = $this->db->select('et.*')
						->from('employee_training_faculty et');
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
	public function add_employee_training_feedback($id = ''){
		$post =  $this->input->post(array('training_detail_id','empid','trg_pname','trg_pdesig','email','mobile_no','training_id','trg_benifit','trg_duration','trg_modification','faculty_approach','topic_coverage','example',
		'faculty_1','date_1','below_1','average_1','good_1','verygood_1','excellent_1',
		'faculty_2','date_2','below_2','average_2','good_2','verygood_2','excellent_2',
		'faculty_3','date_3','below_3','average_3','good_3','verygood_3','excellent_3',
		'faculty_4','date_4','below_4','average_4','good_4','verygood_4','excellent_4',
		'faculty_5','date_5','below_5','average_5','good_5','verygood_5','excellent_5',
		'faculty_6','date_6','below_6','average_6','good_6','verygood_6','excellent_6',
		'faculty_7','date_7','below_7','average_7','good_7','verygood_7','excellent_7',
		'faculty_8','date_8','below_8','average_8','good_8','verygood_8','excellent_8',
		'faculty_9','date_9','below_9','average_9','good_9','verygood_9','excellent_9',
		'faculty_10','date_10','below_10','average_10','good_10','verygood_10','excellent_10',
		'pre_location','pre_trg_from','pre_trg_to','feedback_date'), TRUE);
		
		$post['training_detail_id'] = $id;
		
		$post['date_1'] = !empty($post['date_1']) ? date('Y-m-d',strtotime($post['date_1'])) : '';
		$post['date_2'] = !empty($post['date_2']) ? date('Y-m-d',strtotime($post['date_2'])) : '';
		$post['date_3'] = !empty($post['date_3']) ? date('Y-m-d',strtotime($post['date_3'])) : '';
		$post['date_4'] = !empty($post['date_4']) ? date('Y-m-d',strtotime($post['date_4'])) : '';
		$post['date_5'] = !empty($post['date_5']) ? date('Y-m-d',strtotime($post['date_5'])) : '';
		$post['date_6'] = !empty($post['date_6']) ? date('Y-m-d',strtotime($post['date_6'])) : '';
		$post['date_7'] = !empty($post['date_7']) ? date('Y-m-d',strtotime($post['date_7'])) : '';
		$post['date_8'] = !empty($post['date_8']) ? date('Y-m-d',strtotime($post['date_8'])) : '';
		$post['date_9'] = !empty($post['date_9']) ? date('Y-m-d',strtotime($post['date_9'])) : '';
		$post['date_10'] = !empty($post['date_10']) ? date('Y-m-d',strtotime($post['date_10'])) : '';
		$post['pre_trg_from'] = !empty($post['pre_trg_from']) ? date('Y-m-d',strtotime($post['pre_trg_from'])) : '';
		$post['pre_trg_to'] = !empty($post['pre_trg_to']) ? date('Y-m-d',strtotime($post['pre_trg_to'])) : '';
		$post['feedback_date'] = !empty($post['feedback_date']) ? date('Y-m-d',strtotime($post['feedback_date'])) : '';
		
		$this->db->insert('employee_training_feedback',$post);
		return true;
	}
	public function emp_training_feedback_status_update($id=0, $empid = ''){
		$post = $this->input->post(array('feedback_status'), TRUE);
		$update = array();
		$update['feedback_status'] = 'Submitted';
		
		if(!empty($update) && $id != ''){
			$this->db->where('trg_detail_id',$id)->where('empid',$empid)->update('employee_training',$update);
		}
	}
	public function get_training_feedback_download($office = 'AGAE'){
		$post = $this->input->post(array('training_id'), TRUE);
		$res = $this->db->select('et.*')
						->from('employee_training_feedback et');
		
		if($post['training_id'] != ''){
			$this->db->where('et.training_id',$post['training_id']);
		}							
		$res = $this->db->order_by('et.trg_pname','asc')
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
	
	public function add_employee_property_statement(){
		$post =  $this->input->post(array('empid','emp_name','mobile_no','emp_desig','b_pay','service_belg','pst_year','pst_as_on','decl_for',
		'proty_location_1','proty_detail_1','prsnt_value_1','proty_owner_1','mode_acquin_1','income_proty_1','remark_1',
		'proty_location_2','proty_detail_2','prsnt_value_2','proty_owner_2','mode_acquin_2','income_proty_2','remark_2',
		'proty_location_3','proty_detail_3','prsnt_value_3','proty_owner_3','mode_acquin_3','income_proty_3','remark_3',
		'proty_location_4','proty_detail_4','prsnt_value_4','proty_owner_4','mode_acquin_4','income_proty_4','remark_4',
		'proty_location_5','proty_detail_5','prsnt_value_5','proty_owner_5','mode_acquin_5','income_proty_5','remark_5',
		'proty_location_6','proty_detail_6','prsnt_value_6','proty_owner_6','mode_acquin_6','income_proty_6','remark_6',
		'decl_place','decl_date','upload_dt'), TRUE);
	
		$post['decl_date'] = !empty($post['decl_date']) ? date('Y-m-d',strtotime($post['decl_date'])) : '';
		$post['upload_dt'] = date('Y-m-d H:i:s');
		
		$this->db->insert('employee_property_statement',$post);
		return true;
	}
	
	public function all_employees_application($office = 'AGAE'){
		$post = $this->input->post(array('date_from','date_to', 'exam_name'), TRUE);
		$res = $this->db->select('ea.*')
						->from('employee_application ea')
						->join('employee_master e','ea.emp_id = e.empid')
						->where('ea.application_status <>','Cancelled')
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
	public function all_employees_application_non_dept(){
		$post = $this->input->post(array('date_from','date_to', 'exam_appli_yr'), TRUE);
		$res = $this->db->select('ea.*')
						->from('employee_exam_other ea')
						->where('ea.appli_status =','Submitted');
//						->where('e.office_code',$office);
		if($post['date_from'] != ''){
			$f_date = date('Y-m-d',strtotime($post['date_from']));
			$this->db->where('date(ea.appli_date) >= ',$f_date);
		}
		if($post['date_to'] != ''){
			$t_date = date('Y-m-d',strtotime($post['date_to']));
			$this->db->where('date(ea.appli_date) <= ',$t_date);
		}
		if($post['exam_appli_yr'] != ''){
			$this->db->where('ea.exam_appli_yr',$post['exam_appli_yr']);
		}			
		$res = $this->db->order_by('ea.appli_date','desc')
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
		$post =  $this->input->post(array('name','desig','leave_basic_pay','section','group_nm','mbno','office_nm','leave_type','leave_dr_year','leave_from','leave_to','leave_day_no','leave_commu_days','half_cl','balance_leave', 'ground','admissibility','childname_hospital','dob_mc_date','avail_from','avail_by','joining_dt','pre_from','pre_to','pre_desc','suff_from','suff_to','suff_desc','leave_address','last_leave_type','last_leave_from','last_leave_to','last_leave_joined_on','application_dt','link_file','block','mc_yes_no','mc_varified','recommendation','recom_date','recom_autho','recom_autho_desig','recom_autho_pan','sanction_desc','approve_date','sanction_autho','sanction_autho_desig','sanction_autho_pan', 'servicebk_record','servicebk_record_dt','leave_status'), TRUE);
		$post['empid'] = $empid;
		if($post['mc_yes_no'] = 'Yes'){$post['mc_varified'] = 'Pending';}//		$post['leave_dr_year'] = date('Y');
		$post['leave_dr_year'] = !empty($post['leave_from']) ? date('Y',strtotime($post['leave_from'])) : date('Y',strtotime($post['application_dt']));
		$post['leave_from'] = !empty($post['leave_from']) ? date('Y-m-d',strtotime($post['leave_from'])) : '';
		$post['leave_to'] = !empty($post['leave_to']) ? date('Y-m-d',strtotime($post['leave_to'])) : '';
		
		$post['balance_leave'] = $post['balance_leave']-$post['leave_day_no'];
		
		$post['dob_mc_date'] = !empty($post['dob_mc_date']) ? date('Y-m-d',strtotime($post['dob_mc_date'])) : '';
		$post['avail_from'] = !empty($post['avail_from']) ? date('Y-m-d',strtotime($post['avail_from'])) : '';
		$post['avail_by'] = !empty($post['avail_by']) ? date('Y-m-d',strtotime($post['avail_by'])) : '';
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

		$recom_autho = explode('@@@',$post['recom_autho_pan']);
		$post['recom_autho'] = isset($recom_autho[0]) ? $recom_autho[0] : '';
		$post['recom_autho_desig'] = isset($recom_autho[1]) ? $recom_autho[1] : '';
		$post['recom_autho_pan'] = isset($recom_autho[2]) ? $recom_autho[2] : '';
		
		$sacn_autho = explode('@@@',$post['sanction_autho_pan']);
		$post['sanction_autho'] = isset($sacn_autho[0]) ? $sacn_autho[0] : '';
		$post['sanction_autho_desig'] = isset($sacn_autho[1]) ? $sacn_autho[1] : '';
		$post['sanction_autho_pan'] = isset($sacn_autho[2]) ? $sacn_autho[2] : '';
		
		if(!empty($post['recom_autho_pan'])){
			$post['currently_with'] = $post['recom_autho_pan'];
		}else{
			$post['currently_with'] = $post['sanction_autho_pan'];
		}
/*
//-----------------		
		if(!empty($post['recom_autho_pan']){
			$post['currently_with'] = $post['recom_autho_pan'];
		}else{
			$post['currently_with'] = $post['sanction_autho_pan'];
		}
		
		if($post['leave_type'] =='Casual Leave' && $post['leave_day_no'] >= 5 ){
			$post['recom_autho'] = isset($sacn_autho[0]) ? $sacn_autho[0] : '';
			$post['recom_autho_desig'] = isset($sacn_autho[1]) ? $sacn_autho[1] : '';
			$post['recom_autho_pan'] = isset($sacn_autho[2]) ? $sacn_autho[2] : '';
			$post['sanction_autho'] = '';
			$post['sanction_autho_desig'] = '';
			$post['sanction_autho_pan'] = '';
		}
//----------------

		
		if($post['desig'] =='SR. ACCOUNTS OFFICER'||$post['desig'] =='ACCOUNTS OFFICER' ){
			if(!empty($post['recom_autho_pan'])){
			$recom_autho = explode('@@@',$post['recom_autho_pan']);
				$post['recom_autho'] = '';
				$post['recom_autho_desig'] = '';
				$post['recom_autho_pan'] = '';
				$post['sanction_autho'] = isset($recom_autho[0]) ? $recom_autho[0] : '';
				$post['sanction_autho_desig'] = isset($recom_autho[1]) ? $recom_autho[1] : '';
				$post['sanction_autho_pan'] = isset($recom_autho[2]) ? $recom_autho[2] : '';
			}else{
			$sacn_autho = explode('@@@',$post['sanction_autho_pan']);
				$post['sanction_autho'] = isset($sacn_autho[0]) ? $sacn_autho[0] : '';
				$post['sanction_autho_desig'] = isset($sacn_autho[1]) ? $sacn_autho[1] : '';
				$post['sanction_autho_pan'] = isset($sacn_autho[2]) ? $sacn_autho[2] : '';
			}
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
//------------------	
*/
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
	
	public function emp_leave_current_balance($empid = '', $leave_type = '', $balance = 0){
		$res = $this->db->select('bal.*')
						->from('employee_current_leave_balance bal ')
						->where('bal.empid',$empid)
						->where('bal.leave_type',$leave_type)
						->get()
						->row_array();
		if(!empty($res)){
			$this->db->where('empid',$empid)->where('leave_type',$leave_type)->update('employee_current_leave_balance',array('leave_cb'=>$balance));		
		}else{
			$this->db->insert('employee_current_leave_balance',array('empid'=>$empid,'leave_type'=>$leave_type,'leave_cb'=>$balance));
//echo $this->db->last_query();			
		}
		return true;
	}
	
	public function emp_clrh_current_balance($empid = '', $leave_type = '', $leave_cr_year = '', $balance = 0){
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
	
	public function emp_leave_precredit_balance_update($empid = '', $leave_type = '', $cr_from_date = ''){
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
	public function emp_leave_precredit_balance_insert($empid = '', $leave_type = ''){
		$res = $this->db->select('leave_cb')
						->from('employee_current_leave_balance')
						->where('empid',$empid)
						->where('leave_type',$leave_type)
						->get()
						->row_array();
			if(!empty($res)){
				return $res['leave_cb'];
			}
		return 0;
	}
	
	public function emp_leave_credit_balance_update($empid = '', $leave_type = '', $cr_from_date = '', $credit_balance = 0, $pre_credit = 0){
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
			$this->db->where('empid',$empid)->where('leave_type',$leave_type)->where('cr_from_date',$cr_from_date)->update('employee_leave_credit',array('leave_cb'=>$leave_last_balance));
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
						->group_start()
						->like('la.leave_status','Submitted')
						->or_like('la.leave_status','Returned')
						->group_end()
						->order_by('application_dt','desc')
						->get()
						->row_array();
		return $res;
	}
	public function fetch_employee_leave_application_check($empid = 0,$id = ''){
		$res = $this->db->select('la.*')
						->from('employee_leave_debit la')
						->where('la.sect_check_pan',$empid)
						->where('la.leav_id',$id)
						->like('la.leave_status','Recommended')
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
						->where('la.leave_status =','Checked')
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
	public function get_employee_all_messages($empid = 0){
		$res = $this->db->select('e.empid, e.empname,e.picture,m.*')
						->from('employee_master e')
						->join('employee_messages m','m.sender_id = e.empid','m.receiver_id = e.empid','left')
						->where('sender_id',$empid)
						->or_where('receiver_id',$empid)
						->order_by('msg_id','desc')
						->limit(8)
						->get()
						->result_array();
		return $res;
	}

	public function emp_message_application($empid = '',$ename = '' ,$receiver_id = '', $received_by = '', $message = ''){
		if(!empty($receiver_id)){
			$this->db->insert('employee_messages',array('sender_id'=> $empid,'sent_by'=>$ename,'receiver_id'=>$receiver_id,'received_by'=>$received_by,'message'=>$message,'createdAt'=>date('Y-m-d H:i:s')));
		}
	}
/*	
//For mployee list with checkbox

	public function emp_message_application($empid = '',$ename = '' ,$receiver_id = array(),$message = ''){
		if(is_array($receiver_id)){
			foreach($receiver_id as $receiver=>$empname){
				$this->db->insert('employee_messages',array('sender_id'=> $empid,'sent_by'=>$ename,'receiver_id'=>$receiver,'received_by'=>$empname,'message'=>$message,'createdAt'=>date('Y-m-d H:i:s')));
			}
		}
	}
*/
	public function readMessageByID($id){
		$update['read_unread'] = 'Read';
		$this->db->where('msg_id',$id)->update('employee_messages',$update);
	}
	public function deleteMessageByID($id){
		$this->db->where('msg_id',$id)->delete('employee_messages');
	}
	
//----test application
	
	public function get_test_application($empid = 0,$office = 'AGAE'){
		$res = $this->db->select('ta.*')
						->from('test_application ta')
						->where('ta.empid',$empid)
						->get()
						->row_array();
		return $res;
	}
	
	public function emp_test_application($empid = 0){
		$post =  $this->input->post(array('name','desig_1','desig_2'), TRUE);
		$post['empid'] = $empid;
//		$post['date'] = !empty($post['date']) ? date('Y-m-d',strtotime($post['date'])) : '';
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
		$post =  $this->input->post(array('name','desig','emp_section','group_nm','office_nm','basic_pay','bill_year','bill_type','description','bill_no','bill_date','bill_amount','advance_bill_no','from_date','to_date','block','journey_mode','visit_to','edu_class','child_name','loc_inst_hosp','loc_address','treatment_type','doctor','fit_unfit','attachment','applied_on','amount_paid','payment_date','upload_dt'), TRUE);
		$post['empid'] = $empid;
		
		$autho = explode('@@@',$post['sec_autho']);
		if(count($autho) == 3){
			$update['current_off_nm'] = isset($autho[0]) ? $autho[0] : '';
			$update['current_off_desig'] = isset($autho[1]) ? $autho[1] : '';
			$update['currently_with'] = isset($autho[2]) ? $autho[2] : '';
		}
		
		$post['bill_date'] = !empty($post['bill_date']) ? date('Y-m-d',strtotime($post['bill_date'])) : '';
		$post['from_date'] = !empty($post['from_date']) ? date('Y-m-d',strtotime($post['from_date'])) : '';
		$post['to_date'] = !empty($post['to_date']) ? date('Y-m-d',strtotime($post['to_date'])) : '';
		$post['payment_date'] = !empty($post['payment_date']) ? date('Y-m-d',strtotime($post['payment_date'])) : '';
		$post['applied_on'] = date('Y-m-d');
		$post['upload_dt'] = date('Y-m-d H:i:s');
		$this->db->insert('employee_bills',$post);
		return true;
	}
	
	
//-----Leave details
	public function get_employee_leave_credited($limit_to=0){
		$get = $this->input->get(array('search','leave_year','leave_search'), TRUE);
		$this->db->select('*')
				 ->from('employee_leave_credit')
				 ->order_by('leavcr_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->where('empid',$get['search']);
			$this->db->group_end();
		}
		if($get['leave_search'] != ''){
			$this->db->where('leave_type',$get['leave_search']);
		}
		if($get['leave_year'] != ''){
			$this->db->where('leave_cr_year',$get['leave_year']);
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
	public function leave_credits_for_status($id=0){
		return  $this->db->select('cd.*')
						 ->from('employee_leave_credit cd')
//						 ->join('employee_leave_credit cd','cd.empid = e.empid','right')
						 ->where('cd.leavcr_id',$id)
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
/*	
	public function employee_leave_list($limit_to = 0){
		$get = $this->input->get(array('search_id','leave_type','leave_year'), TRUE);
		$this->db->select('*')
				 ->from('employee_leave_debit')
				 ->order_by('leav_id','desc');
		if($get['search_id'] != ''){
			$this->db->like('empid',$get['search_id']);
		}
		if($get['leave_type'] != ''){
			$this->db->where('leave_type',$get['leave_type']);
		}
		if($get['leave_year'] != ''){
			$this->db->where('leave_dr_year',$get['leave_year']);
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
*/
	public function employee_leave_list($search_id = '', $leave_type = '', $leave_year = ''){
		$res = $this->db->select('*')
				 ->from('employee_leave_debit')
				 ->where('empid',$search_id)
				 ->where('leave_type',$leave_type)
				 ->where('leave_dr_year',$leave_year)
				 ->order_by('leave_from','desc')
				 ->get()
			     ->result_array();
		return $res;
	}
	public function employee_leave_debit_list($limit_to = 0){
		$get = $this->input->get(array('search','leave_search','leave_year','leave_status'), TRUE);
		$this->db->select('*')
				 ->from('employee_leave_debit')
				 ->order_by('leav_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('empid',$get['search']);
				$this->db->or_like('name',$get['search']);
				$this->db->or_like('group_nm ',$get['search']);
				$this->db->or_like('section',$get['search']);
				$this->db->or_like('leave_type',$get['search']);
				$this->db->or_like('servicebk_record',$get['search']);
			$this->db->group_end();
		}
		if($get['leave_search'] != ''){
			$this->db->where('leave_type',$get['leave_search']);
		}
		if($get['leave_year'] != ''){
			$this->db->where('leave_dr_year',$get['leave_year']);
		}
		if($get['leave_status'] != ''){
			$this->db->where('leave_status',$get['leave_status']);
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	} 
	public function employee_leave_credit_list($limit_to = 0){
		$get = $this->input->get(array('search','leave_search','leave_year'), TRUE);
		$this->db->select('e.empid,e.empname,e.desig,cd.*')
				 ->from('employee_master e')
				 ->join('employee_leave_credit cd','cd.empid = e.empid','right')
				 ->order_by('cd.leave_cr_year','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('cd.empid',$get['search']);
				$this->db->or_like('e.empname',$get['search']);
			$this->db->group_end();
		}
		if($get['leave_search'] != ''){
			$this->db->where('cd.leave_type',$get['leave_search']);
		}
		if($get['leave_year'] != ''){
			$this->db->where('cd.leave_cr_year',$get['leave_year']);
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	} 
	public function employee_leave_debit_cancel_list($limit_to=0){
		$get = $this->input->get(array('search','leave_search'), TRUE);
		$this->db->select('*')
				 ->from('employee_leave_debit')
				 ->where('leave_status =','Cancelled')
				 ->where('leave_type !=','Casual Leave')
				 ->where('leave_type !=','Restricted Holiday')
				 ->order_by('leav_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('empid',$get['search'])
						 ->or_like('name',$get['search'])
						 ->or_like('group_nm ',$get['search'])
						 ->or_like('section',$get['search'])
						 ->or_like('leave_type',$get['search'])
						 ->or_like('leave_status',$get['search'])
						 ->or_like('servicebk_record',$get['search']);
			$this->db->group_end();
		}
		if($get['leave_search'] != ''){
			$this->db->where('leave_type',$get['leave_search']);
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	} 
	public function employee_leave_encashment_list($limit_to=0){
		$get = $this->input->get(array('search','leave_search'), TRUE);
		$this->db->select('*')
				 ->from('employee_leave_debit')
				 ->where('ground =','Leave Encashment')
				 ->where('leave_type !=','Casual Leave')
				 ->where('leave_type !=','Restricted Holiday')
				 ->order_by('leav_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('empid',$get['search'])
						 ->or_like('name',$get['search'])
						 ->or_like('group_nm ',$get['search'])
						 ->or_like('section',$get['search'])
						 ->or_like('leave_type',$get['search'])
						 ->or_like('leave_status',$get['search'])
						 ->or_like('servicebk_record',$get['search']);
			$this->db->group_end();
		}
		if($get['leave_search'] != ''){
			$this->db->where('leave_type',$get['leave_search']);
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
		$post = $this->input->post(array('desig','leave_basic_pay','section','group_nm','office_nm','leave_dr_year','leave_type','leave_from','leave_to','leave_commu_days','leave_day_no','balance_leave','ground','admissibility','childname_hospital','dob_mc_date','avail_from','avail_by','joining_dt','pre_from','pre_to','pre_desc','suff_from','suff_to','suff_desc','leave_address','block','application_dt','link_file','mc_yes_no','mc_varified','approve_date','last_leave_type','last_leave_from','last_leave_to','last_leave_joined_on','recom_autho','recom_autho_desig','recom_autho_pan','sanction_autho','sanction_autho_desig','sanction_autho_pan','leave_status'), TRUE);
		$update = array();
		if($post['mc_yes_no'] = 'Yes'){$update['mc_varified'] = 'Pending';}
		$update['desig'] = $post['desig'];
		$update['leave_basic_pay'] = $post['leave_basic_pay'];
		$update['section'] = $post['section'];
		$update['group_nm'] = $post['group_nm'];
		$update['office_nm'] = $post['office_nm'];
		$update['leave_dr_year'] = !empty($post['leave_from']) ? date('Y',strtotime($post['leave_from'])) : date('Y',strtotime($post['application_dt']));
		$update['leave_type'] = $post['leave_type'];
		$update['leave_from'] = !empty($post['leave_from']) ? date('Y-m-d',strtotime($post['leave_from'])) : '';
		$update['leave_to'] = !empty($post['leave_to']) ? date('Y-m-d',strtotime($post['leave_to'])) : '';
		$update['dob_mc_date'] = !empty($post['dob_mc_date']) ? date('Y-m-d',strtotime($post['dob_mc_date'])) : '';
		$update['avail_from'] = !empty($post['avail_from']) ? date('Y-m-d',strtotime($post['avail_from'])) : '';
		$update['avail_by'] = !empty($post['avail_by']) ? date('Y-m-d',strtotime($post['avail_by'])) : '';
		
		if($post['leave_status'] == 'Cancelled'){
			$update['balance_leave'] = $update['balance_leave']+$update['leave_day_no'];
			$update['leave_day_no'] =0;
		}
		else{
			$update['leave_day_no'] = $post['leave_day_no'];
			$update['balance_leave']= $post['balance_leave'] - $post['leave_day_no'];
		}
		$update['leave_commu_days'] = $post['leave_commu_days'];
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
		$update['mc_yes_no'] = $post['mc_yes_no'];
		$update['approve_date'] = !empty($post['approve_date']) ? date('Y-m-d',strtotime($post['approve_date'])) : '';
		$update['last_leave_type'] = $post['last_leave_type'];
		$update['last_leave_from'] = !empty($post['last_leave_from']) ? date('Y-m-d',strtotime($post['last_leave_from'])) : '';
		$update['last_leave_to'] = !empty($post['last_leave_to']) ? date('Y-m-d',strtotime($post['last_leave_to'])) : '';
//		$update['last_leave_joined_on'] = !empty($post['last_leave_joined_on']) ? date('Y-m-d',strtotime($post['last_leave_joined_on'])) : '0000-00-00';
		
		$update['last_leave_joined_on'] = date('Y-m-d',strtotime($post['last_leave_joined_on']));
		
		$recom_autho = explode('@@@',$post['recom_autho_pan']);
		if(!empty($recom_autho)){
			$update['recom_autho'] = isset($recom_autho[0]) ? $recom_autho[0] : '';
			$update['recom_autho_desig'] = isset($recom_autho[1]) ? $recom_autho[1] : '';
			$update['recom_autho_pan'] = isset($recom_autho[2]) ? $recom_autho[2] : '';
		}
		$sacn_autho = explode('@@@',$post['sanction_autho_pan']);
		if(!empty($sacn_autho)){
			$update['sanction_autho'] = isset($sacn_autho[0]) ? $sacn_autho[0] : '';
			$update['sanction_autho_desig'] = isset($sacn_autho[1]) ? $sacn_autho[1] : '';
			$update['sanction_autho_pan'] = isset($sacn_autho[2]) ? $sacn_autho[2] : '';
		}	
		if(!empty($update['recom_autho_pan'])){
			$update['currently_with'] = $update['recom_autho_pan'];
		}else{
			$update['currently_with'] = $update['sanction_autho_pan'];
		}
/*	
//-----------------		
		
		if($update['leave_type'] =='Casual Leave' && $update['leave_day_no'] >= 5 ){
			$update['recom_autho'] = isset($sacn_autho[0]) ? $sacn_autho[0] : '';
			$update['recom_autho_desig'] = isset($sacn_autho[1]) ? $sacn_autho[1] : '';
			$update['recom_autho_pan'] = isset($sacn_autho[2]) ? $sacn_autho[2] : '';
			$update['sanction_autho'] = '';
			$update['sanction_autho_desig'] = '';
			$update['sanction_autho_pan'] = '';
		}

//--------------	
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
*/
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
	public function update_employee_other_leave_debit_hold($id=0,$empid = 0,$leave_type = '', $bal_restore = 0){	
		$update['leave_status'] = 'Held';
		$update['leave_day_no'] = 0;
		
		if(!empty($id)){
			$this->db->where('leav_id',$id)->where('empid',$empid)->update('employee_leave_debit',$update);
			if($empid != '' && $leave_type != '' && $bal_restore > 0){
				$this->db->where('empid',$empid)->where('leave_type',$leave_type)->update('employee_current_leave_balance',array('leave_cb'=>$bal_restore));
//				$this->db->where('empid',$empid)->where('leave_type',$leave_type)->where('leave_cr_year',$leave_cr_year)->update('employee_leave_credit',array('leave_cb'=>$bal_restore));
			}
		}			
	return true;
	}
	
	public function update_employee_clrh_leave_debit_hold($id=0,$empid = 0, $leave_type = '', $leave_cr_year = '', $bal_restore = 0){	
		$update['leave_status'] = 'Held';
		$update['leave_day_no'] = 0;
		if(!empty($id)){
			$this->db->where('leav_id',$id)->where('empid',$empid)->update('employee_leave_debit',$update);	
				if($empid != '' && $leave_type != '' && $leave_cr_year != '' && $bal_restore > 0){
					$this->db->where('empid',$empid)->where('leave_type',$leave_type)->update('employee_current_leave_balance',array('leave_cb'=>$bal_restore));
					$this->db->where('empid',$empid)->where('leave_type',$leave_type)->where('leave_cr_year',$leave_cr_year)->update('employee_leave_credit',array('leave_cb'=>$bal_restore));
				}
		}			
	return true;
	}
	public function leave_convertByID($id){
		$res = $this->db->select('leave_type')->from('employee_leave_debit')->where('leav_id',$id)->get()->row_array();
		$leave_type = $res['leave_type'];

		$update = array();
		if($leave_type == 'Casual Leave'){
			$update['leave_type'] = 'Restricted Holiday';
		}else{
			$update['leave_type'] = 'Casual Leave';
		}
//		$update['ground'] = '';
//		$update['leave_from'] =  '';
//		$update['leave_to'] =  '';
		$update['leave_day_no'] =0;
		if(!empty($id && $leave_type != '')){
			$this->db->where('leav_id',$id)->update('employee_leave_debit',$update);	
		}
	}
	public function update_leave_application_recommendation($id=0,$empid = 0){
		$post = $this->input->post(array('recommendation','recom_date','sect_check_name','sect_check_desig','sect_check_pan','leave_status'), TRUE);

		$update = array();

		$update['recommendation'] = $post['recommendation'];
		$update['recom_date'] = !empty($post['recom_date']) ? date('Y-m-d',strtotime($post['recom_date'])) : '';
		
		$vari_autho = explode('@@@',$post['sect_check_pan']);
		$update['sect_check_name'] = isset($vari_autho[0]) ? $vari_autho[0] : '';
		$update['sect_check_desig'] = isset($vari_autho[1]) ? $vari_autho[1] : '';
		$update['sect_check_pan'] = isset($vari_autho[2]) ? $vari_autho[2] : '';
		$update['currently_with'] = isset($vari_autho[2]) ? $vari_autho[2] : '';
		
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
	public function update_leave_application_varification($id=0,$empid = 0){
		$post = $this->input->post(array('sect_check_desc','sect_check_dt','sanction_autho','sanction_autho_desig','sanction_autho_pan','leave_status'), TRUE);

		$update = array();

		$update['sect_check_desc'] = $post['sect_check_desc'];
		$update['sect_check_dt'] = date('Y-m-d');
		
		$sacn_autho = explode('@@@',$post['sanction_autho_pan']);
		$update['sanction_autho'] = isset($sacn_autho[0]) ? $sacn_autho[0] : '';
		$update['sanction_autho_desig'] = isset($sacn_autho[1]) ? $sacn_autho[1] : '';
		$update['sanction_autho_pan'] = isset($sacn_autho[2]) ? $sacn_autho[2] : '';
		$update['currently_with'] = isset($sacn_autho[2]) ? $sacn_autho[2] : '';
		if($post['leave_status'] == 'AG'){
			$update['leave_status'] = 'Sanctioned';
			$update['sanction_autho'] = 'ATUL PRAKASH';
			$update['sanction_autho_desig'] = 'ACCOUNTANT GENERAL';
			$update['sanction_autho_pan'] = 'AGNPP3502F';
			$update['approve_date'] = !empty($post['sect_check_dt']) ? date('Y-m-d',strtotime($post['sect_check_dt'])) : date('Y-m-d');
		}else{
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
	public function update_leave_application_sanction($id=0, $empid = '', $leave_type=''){
		$post = $this->input->post(array('balance_leave','leave_day_no','sanction_desc','approve_date','leave_status','joining_status','servicebk_record'), TRUE);
		$update = array();

		$update['sanction_desc'] = $post['sanction_desc'];
		$update['approve_date'] = !empty($post['approve_date']) ? date('Y-m-d',strtotime($post['approve_date'])) : '';
		if($post['leave_status'] != null){
			$update['leave_status'] = $post['leave_status'];
		}
		if($post['leave_status'] == 'Sanctioned'){
			$update['servicebk_record'] = 'Pending';
			$update1['leave_cb']= $post['balance_leave'];
		}else{
			if($post['leave_status'] == 'Cancelled' || $post['leave_status'] == 'Returned' || $post['leave_status'] == 'Held'){
				$update_bal = $post['balance_leave']+$post['leave_day_no'];
				if($update_bal >= 315 && $leave_type == 'Earned Leave'){
					$update['balance_leave'] = 315;
					$update1['leave_cb'] = 315;
				}else{
					$update['balance_leave'] = $update_bal;
					$update1['leave_cb']= $update_bal;
				}
				$update['leave_day_no'] =0;
				$update['joining_status'] = 'Not applicable';
				$update['servicebk_record'] = 'Not applicable';
			}
//			else{
//				$update1['leave_cb']= $post['balance_leave'];
//			}
		}
/*		
		if(empty($update['balance_leave'])){
			$update1['leave_cb']= $post['balance_leave'];
		}else{
			$update1['leave_cb'] = $update['balance_leave'];
		}
*/				
		if(!empty($update) && $id != ''){
			$this->db->where('leav_id',$id)->where('empid',$empid)->update('employee_leave_debit',$update);	
			$this->db->where('empid',$empid)->where('leave_type',$leave_type)->update('employee_current_leave_balance',$update1);	
		}
		
		$res = $this->db->select('leave_cb')->from('employee_current_leave_balance')->where('leave_type',$leave_type)->where('empid',$empid)->get()->row_array();
		if(!empty($res)){
			return $res['leave_cb'];
		}
		return 0;
	}
	public function leave_credit_cl_status_update($id=0,$empid = 0){
		$post = $this->input->post(array('status'), TRUE);
		$update = array();
		
		$update['status'] = $post['status'];
		
		if(!empty($update) && $id != ''){
			$this->db->where('leavcr_id',$id)->where('empid',$empid)->where('leave_type','Casual Leave')->update('employee_leave_credit',$update);	
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
/*		
		$res = $this->db->select('balance_leave')->from('employee_leave_debit')->where('leav_id',$id)->where('empid',$empid)->get()->row_array();
		if(!empty($res)){
			return $res['balance_leave'];
		}
*/
		return 0;
	}
	public function leave_application_admin_rectification($id=0,$empid = 0){
		$post = $this->input->post(array('leave_type','leave_dr_year','section','group_nm','leave_from','leave_to','leave_day_no','leave_address','leave_status','joining_status','mc_varified','servicebk_record','pan_update','pan_no','auth_nm','auth_dg','sect_check_pan'), TRUE);
		$update = array();
		if(!empty($post['leave_type'])){
			$update['leave_type'] = $post['leave_type'];
		}
		if(!empty($post['leave_dr_year'])){
			$update['leave_dr_year'] = $post['leave_dr_year'];
		}
		if(!empty($post['section'])){
			$update['section'] = $post['section'];
		}
		if(!empty($post['group_nm'])){
			$update['group_nm'] = $post['group_nm'];
		}
		if(!empty($post['leave_from'])){
			$update['leave_from'] = date('Y-m-d',strtotime($post['leave_from']));
		}
		if(!empty($post['leave_to'])){
			$update['leave_to'] = date('Y-m-d',strtotime($post['leave_to']));
		}
		if(!empty($post['leave_day_no'])){
			$update['leave_day_no'] = $post['leave_day_no'];
		}
		if(!empty($post['leave_address'])){
			$update['leave_address'] = $post['leave_address'];
		}
		if(!empty($post['leave_status'])){
			$update['leave_status'] = $post['leave_status'];
		}
		if($post['leave_status'] == 'Returned' || $post['leave_status'] == 'Held'){
			$update['leave_day_no'] = 0;
		}
		if(!empty($post['joining_status'])){
			$update['joining_status'] = $post['joining_status'];
		}
		if(!empty($post['mc_varified'])){
			$update['mc_varified'] = $post['mc_varified'];
		}
		if(!empty($post['leave_status'])){
			$update['servicebk_record'] = $post['servicebk_record'];
		}
		if($post['pan_update'] != 'NIL'){
			if($post['pan_update'] == 'RECO'){
				$update['recom_autho'] = $post['auth_nm'];
				$update['recom_autho_desig'] = $post['auth_dg'];
				$update['recom_autho_pan'] = $post['pan_no'];
			}
			if($post['pan_update'] == 'SANC'){
				$update['sanction_autho'] = $post['auth_nm'];
				$update['sanction_autho_desig'] = $post['auth_dg'];
				if($post['leave_type'] == 'Casual Leave' ||$post['leave_type'] == 'Restricted Holiday'){
				$update['sanction_autho_pan'] = $post['pan_no'];
				}
				if($post['leave_type']!='Casual Leave' ||$post['leave_type']!='Restricted Holiday'){
					$update['sect_check_name'] = $post['auth_nm'];
					$update['sect_check_desig'] = $post['auth_dg'];
					$update['sect_check_pan'] = $post['pan_no'];
				}
			}
			if($post['pan_update'] == 'JOIN'){
				$update['joining_autho'] = $post['auth_nm'];
				$update['joining_autho_desig'] = $post['auth_dg'];
				$update['joining_autho_pan'] = $post['pan_no'];
			}
		}
		if(!empty($update) && $id != ''){
			$this->db->where('leav_id',$id)->where('empid',$empid)->update('employee_leave_debit',$update);	
		}
		return 0;
	}
	
	public function update_joining_date($id=0){
		$post = $this->input->post(array('joining_dt','linkmc_file','joining_apply_dt','fore_after_noon','joining_autho','joining_autho_desig','joining_autho_pan','joining_status'), TRUE);
		$update = array();
		
		$update['linkmc_file'] = $post['linkmc_file'];
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
//print_r($update);
//exit;
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
				 ->where('leave_type !=','Casual Leave')
				 ->where('leave_type !=','Restricted Holiday')
				 ->join('employee_master e','e.empid = lb.empid')
				 ->order_by('e.empname','asc');
		
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
	public function employee_current_leave_balance_clrh($limit_to=0){
		$get = $this->input->get(array('search','leave_search','leave_year'), TRUE);
		$this->db->select('e.empid,e.empname,e.desig,lc.leavcr_id,lc.leave_cr_year,lc.leave_type,lc.leave_cb,lc.status ')
				 ->from('employee_leave_credit lc')
				 ->join('employee_master e','e.empid = lc.empid')
				 ->order_by('lc.leave_cr_year','desc')
				 ->order_by('e.empname','asc');
		
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('lc.empid',$get['search']);
			$this->db->group_end();
		}
		if($get['leave_search'] != ''){
			$this->db->where('leave_type',$get['leave_search']);
		}
		if($get['leave_year'] != ''){
			$this->db->where('lc.leave_cr_year',$get['leave_year']);
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function employee_current_leave_balance_other($limit_to=0){
		$get = $this->input->get(array('search','leave_search','leave_year'), TRUE);
		$this->db->select('e.empid,e.empname,e.desig,lc.leavecb_id,lc.leave_type,lc.leave_cb')
				 ->from('employee_current_leave_balance lc')
				 ->join('employee_master e','e.empid = lc.empid')
				 ->where('leave_type !=','Casual Leave')
				 ->where('leave_type !=','Restricted Holiday')
				 ->order_by('e.empname','asc');
		
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('lc.empid',$get['search']);
			$this->db->group_end();
		}
		if($get['leave_search'] != ''){
			$this->db->where('leave_type',$get['leave_search']);
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
	public function employee_leave_clrh_balances($id=0){
		return  $this->db->select('*')
						 ->from('employee_leave_credit')
						 ->where('leavcr_id',$id)
						 ->get()
						 ->row_array();
	}
	public function employee_leave_other_balances($id=0){
		return  $this->db->select('*')
						 ->from('employee_current_leave_balance')
						 ->where('leavecb_id',$id)
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
			$this->db->where('leavb_id',$id)->where('empid',$post['empid'])->where('leave_type',$post['leave_type'])->update('employee_leave_balance',$update);
		}
	}
	public function update_employee_clrh_leave_balances($id=0){
		$post = $this->input->post(array('empid','leave_type','leave_cr_year','leave_cb'), TRUE);
		$update = array();
		$update['empid'] = $post['empid'];
		$update['leave_type'] = $post['leave_type'];
		$update['leave_cr_year'] = $post['leave_cr_year'];
		$update['leave_cb'] = $post['leave_cb'];
		
		if(!empty($update) && $id != ''){
			$this->db->where('leavcr_id',$id)->where('empid',$post['empid'])->where('leave_type',$post['leave_type'])->where('leave_cr_year',$post['leave_cr_year'])->update('employee_leave_credit',$update);
		}
	}
	public function update_employee_other_leave_balances($id=0){
		$post = $this->input->post(array('empid','leave_type','leave_cb'), TRUE);
		$update = array();
		$update['empid'] = $post['empid'];
		$update['leave_type'] = $post['leave_type'];
		$update['leave_cb'] = $post['leave_cb'];
		
		if(!empty($update) && $id != ''){
			$this->db->where('leavecb_id',$id)->where('empid',$post['empid'])->where('leave_type',$post['leave_type'])->update('employee_current_leave_balance',$update);
		}
	}
	public function update_employee_clrh_debit($id=0){
		$post = $this->input->post(array('desig','section','mbno','leave_dr_year','leave_type','leave_from','leave_to','leave_day_no','balance_leave','half_cl','ground','leave_address','application_dt','recom_autho','recom_autho_desig','recom_autho_pan','sanction_autho','sanction_autho_desig','sanction_autho_pan','leave_status'), TRUE);
		$update = array();
		
		$update['desig'] = $post['desig'];
		$update['section'] = $post['section'];
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
		
		$recom_autho = explode('@@@',$post['recom_autho_pan']);
			$update['recom_autho'] = isset($recom_autho[0]) ? $recom_autho[0] : '';
			$update['recom_autho_desig'] = isset($recom_autho[1]) ? $recom_autho[1] : '';
			$update['recom_autho_pan'] = isset($recom_autho[2]) ? $recom_autho[2] : '';
		
		$sacn_autho = explode('@@@',$post['sanction_autho_pan']);
		if(count($sacn_autho) == 3){
			$update['sanction_autho'] = isset($sacn_autho[0]) ? $sacn_autho[0] : '';
			$update['sanction_autho_desig'] = isset($sacn_autho[1]) ? $sacn_autho[1] : '';
			$update['sanction_autho_pan'] = isset($sacn_autho[2]) ? $sacn_autho[2] : '';
		}
		
		if(!empty($update['recom_autho_pan'])){
			$update['currently_with'] = $update['recom_autho_pan'];
		}else{
			$update['currently_with'] = $update['sanction_autho_pan'];
		}
		
		if($post['leave_status'] != null){
			$update['leave_status'] = $post['leave_status'];
		}

		if(!empty($update) && $id != ''){
			$this->db->where('leav_id',$id)->update('employee_leave_debit',$update);
		}
	}

	public function emp_leave_sanction_clrh($id=0, $empid = '', $leave_type = '', $leave_cr_year = '', $bal_restore = 0){
		$post =  $this->input->post(array('leave_day_no','sanction_desc','sanction_autho','sanction_autho_desig','sanction_autho_pan','approve_date','leave_status','joining_status','servicebk_record' ), TRUE);
		$update = array();
		
		if($post['leave_status'] == 'Returned' ){
			$update['sanction_desc'] = '';
			$update['sanction_autho'] = '';
			$update['sanction_autho_desig'] = '';
			$update['sanction_autho_pan'] = '';
			$update['leave_status'] = 'Returned';
			$update['leave_day_no'] = 0;
				if($empid != '' && $leave_type != '' && $leave_cr_year != '' && $bal_restore > 0){
					$this->db->where('empid',$empid)->where('leave_type',$leave_type)->update('employee_current_leave_balance',array('leave_cb'=>$bal_restore));
					$this->db->where('empid',$empid)->where('leave_type',$leave_type)->where('leave_cr_year',$leave_cr_year)->update('employee_leave_credit',array('leave_cb'=>$bal_restore));
				}
		}else{
			if($post['leave_status'] == 'Cancelled'){
				$update['leave_status'] = 'Cancelled';
				$update['leave_day_no'] = 0;
				if($empid != '' && $leave_type != '' && $leave_cr_year != '' && $bal_restore > 0){
					$this->db->where('empid',$empid)->where('leave_type',$leave_type)->update('employee_current_leave_balance',array('leave_cb'=>$bal_restore));
					$this->db->where('empid',$empid)->where('leave_type',$leave_type)->where('leave_cr_year',$leave_cr_year)->update('employee_leave_credit',array('leave_cb'=>$bal_restore));
				}
			}else{
				$update['sanction_desc'] = $post['sanction_desc'];
				$update['sanction_autho'] = $post['sanction_autho'];
				$update['sanction_autho_desig'] = $post['sanction_autho_desig'];
				$update['sanction_autho_pan'] = $post['sanction_autho_pan'];
				$update['leave_status'] = $post['leave_status'];
			}
		}
		$update['approve_date'] = !empty($post['approve_date']) ? date('Y-m-d',strtotime($post['approve_date'])) : '';
		$update['joining_status'] = 'Not applicable';
		$update['servicebk_record'] = 'Not applicable';
		
		
		if(!empty($update) && $id != ''){
			$this->db->where('leav_id',$id)->update('employee_leave_debit',$update);
		}
	}
//--------for employee panel
	public function get_leave_returned_count($empid = ''){	
		$yr = date('Y');
		$results = $this->db->select('count(*) retn_total')
				 ->from('employee_leave_debit ld')
				 ->where('ld.empid',$empid)
//				 ->where('ld.leave_dr_year !=',$yr)
				 ->group_start()
				 ->where('leave_type', 'Casual Leave')
				 ->or_where('leave_type', 'Restricted Holiday')
				 ->group_end()
				 ->group_start()
				 ->where('ld.leave_status', 'Returned')
				 ->or_where('ld.leave_status', 'Held')
				 ->group_end()
			     ->get()
				 ->row_array();
		return $results;
	}
	public function get_employee_leave_debit_returned($empid = '' ){	
		$results = $this->db->select('*')
				 ->from('employee_leave_debit')
				 ->where('empid',$empid)
				 ->group_start()
				 ->where('leave_type', 'Casual Leave')
				 ->or_where('leave_type', 'Restricted Holiday')
				 ->group_end()
				 ->group_start()
				 ->where('leave_status', 'Returned')
				 ->or_where('leave_status', 'Held')
				 ->group_end()
			     ->get()
				 ->result_array();
		return $results;
	}
	
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
	
	public function get_employee_last_leave_debit($empid = ''){
		$res = $this->db->select('leav_id')
						->from('employee_leave_debit ld')
						->where('ld.empid',$empid)
						->where('ld.leave_type !=','Casual Leave')
						->where('ld.leave_type !=','Restricted Holiday')
/*						->where('ld.leave_status','Sanctioned')
						->like('ld.leave_type','Earned Leave')
						->or_like('ld.leave_type','Half Pay Leave')
						->or_like('ld.leave_type','Child Care Leave')
						->or_like('ld.leave_type','Paternity Leave')
						->or_like('ld.leave_type','Maternity Leave')
						->or_like('ld.leave_type','Extra Ordinary Leave')
						->or_like('ld.leave_type','Study Leave')
*/						->get()
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
	
	public function get_employee_leave_debit_improper($limit_to = 0, $empid = '' ){
		
		$this->db->select('*')
						->from('employee_leave_debit')
						->where('empid',$empid)
						->where('recom_autho_pan','')
						->where('sanction_autho_pan','')
						->where('leave_status !=','Sanctioned');

		$this->db->order_by('leav_id','desc')
				 ->group_by('leav_id');
		
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_employee_clrh_rept($emp_id = '', $leave_type = '',$leave_dr_year = ''){
		$res = $this->db->select('*')
						->from('employee_leave_debit ld')
						->where('ld.empid',$emp_id)
						->where('ld.leave_type',$leave_type)
						->where('ld.leave_dr_year',$leave_dr_year)
						->order_by('ld.leave_from','asc')
						->get()
						->result_array();
		return $res;
	}
	public function get_employee_sectional_clrh($section = '', $leave_type = '',$leave_dr_year = ''){
		$res = $this->db->select('*')
						->from('employee_leave_debit ld')
						->where('ld.section',$section)
						->where('ld.leave_type',$leave_type)
						->where('ld.leave_dr_year',$leave_dr_year)
						->order_by('name','asc')
						->get()
						->result_array();
		return $res;
	}
/*
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
*/
	public function get_leave_pending_clrh ($limit_to = 0,$empid = ''){
		$get = $this->input->get(array('leave_type', 'leave_dr_year'), TRUE);
		$this->db->select('ld.*')
				 ->from('employee_leave_debit ld')
				 ->where('ld.sanction_autho_pan',$empid)
				 ->where('ld.leave_status','Submitted')
				 ->where('ld.leave_type !=','Earned Leave')
				 ->where('ld.leave_type !=','Half Pay Leave')
				 ->where('ld.leave_type !=','Child Care Leave')
				 ->where('ld.leave_type !=','Maternity Leave')
				 ->where('ld.leave_type !=','Paternity Leave')
				 ->where('ld.leave_type !=','Study Leave')
				 ->where('ld.leave_type !=','Extra Ordinary Leave');;

		if($get['leave_type'] != ''){
			$this->db->where('ld.leave_type',$get['leave_type']);
		}
		if($get['leave_dr_year'] != ''){
			$this->db->where('ld.leave_dr_year',$get['leave_dr_year']);
		}
		
		$this->db->order_by('leave_status','asc');
//				 ->order_by('application_dt','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function get_leave_pending_clrh_count($empid = ''){	
	
		$results = $this->db->select('count(*) clhr_tot')
				 ->from('employee_leave_debit ld')
				 ->where('ld.sanction_autho_pan',$empid)
				 ->where('ld.leave_status','Submitted')
				 ->where('ld.leave_type !=','Earned Leave')
				 ->where('ld.leave_type !=','Half Pay Leave')
				 ->where('ld.leave_type !=','Child Care Leave')
				 ->where('ld.leave_type !=','Maternity Leave')
				 ->where('ld.leave_type !=','Paternity Leave')
				 ->where('ld.leave_type !=','Study Leave')
				 ->where('ld.leave_type !=','Extra Ordinary Leave')
			     ->get()
				 ->result_array();
		return $results;
	}
	
	public function get_leave_pending_recommendaton($empid = '',$leave_type=''){
		$res = $this->db->select('*')
						->from('employee_leave_debit ld')
						->where('ld.recom_autho_pan',$empid)
						->where('ld.leave_type',$leave_type)
						->like('ld.leave_status','Submitted')
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
				 ->where('ld.recom_autho_pan',$empid)
				 ->group_start()
				 ->like('ld.leave_status','Submitted')
				 ->or_like('ld.leave_status','Returned')
				 ->group_end();
	
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
	
	public function get_leave_pending_recommendaton_count($empid = ''){	
	
		$results = $this->db->select('count(*) reco_tot')
				 ->from('employee_leave_debit ld')
				 ->where('ld.recom_autho_pan',$empid)
				 ->where('ld.leave_status','Submitted')
			     ->get()
				 ->result_array();
		return $results;
	}

	public function get_leave_pending_sanction($empid = '',$leave_type=''){
		$res = $this->db->select('ld.*')
						->from('employee_leave_debit ld')						
						->where('ld.sanction_autho_pan',$empid)
						->where('ld.leave_type',$leave_type)
						->like('ld.leave_status','Recommended')
						->order_by('leave_status','asc')
						->order_by('application_dt','desc')
						->get()
						->result_array();
		return $res;
	}
	
	public function get_leave_pending_sanction_count($empid = ''){	
		$results = $this->db->select('count(*) sanc_tot')
				 ->from('employee_leave_debit ld')
				 ->like('ld.leave_status','Recommended')
				 ->where('ld.leave_type !=','Casual Leave')
				 ->where('ld.leave_type !=','Restricted Holiday')
				 ->where('ld.sanction_autho_pan',$empid)
			     ->get()
				 ->result_array();
		return $results;
	}
	public function get_leave_pending_check_count($empid = ''){	
		$results = $this->db->select('count(*) check_tot')
				 ->from('employee_leave_debit ld')
				 ->like('ld.leave_status','Recommended')
				 ->where('ld.leave_type !=','Casual Leave')
				 ->where('ld.leave_type !=','Restricted Holiday')
				 ->where('ld.sect_check_pan',$empid)
			     ->get()
				 ->result_array();
		return $results;
	}
	public function get_message_count($empid = ''){	
		$results = $this->db->select('count(*) mesg_tot')
				->from('employee_messages')
				->where('receiver_id',$empid)
				->where('read_unread','unread')
				->get()
				->result_array();
		return $results;
	}
	public function get_leave_pending_check_all ($limit_to = 0,$empid = ''){
		$get = $this->input->get(array('leave_type'), TRUE);
		$this->db->select('ld.*')
				 ->from('employee_leave_debit ld')
				 ->where('ld.leave_type !=','Casual Leave')
				 ->where('ld.leave_type !=','Restricted Holiday')
				 ->where('ld.sect_check_pan',$empid)
				 ->group_start()
				 ->like('ld.leave_status','Recommended')
				 ->or_like('ld.leave_status','Returned')
				 ->group_end();
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
	public function get_leave_pending_sanction_all ($limit_to = 0,$empid = ''){
		$get = $this->input->get(array('leave_type'), TRUE);
		$this->db->select('ld.*')
				 ->from('employee_leave_debit ld')
				 ->like('ld.leave_status','Checked')
				 ->where('ld.leave_type !=','Casual Leave')
				 ->where('ld.leave_type !=','Restricted Holiday')
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
	
	public function leave_sanctioned_all_view ($limit_to = 0,$empid = ''){
		$get = $this->input->get(array('search'), TRUE);
		$get_type = $this->input->get(array('leave_type'), TRUE);;
		$this->db->select('ld.*')
				 ->from('employee_leave_debit ld')
				 ->like('ld.leave_status','Sanctioned')
				 ->where('ld.sanction_autho_pan',$empid);
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('ld.empid',$get['search']);
				$this->db->or_like('ld.name',$get['search']);
			$this->db->group_end();
		}	
		if($get_type['leave_type'] != ''){
			$this->db->where('ld.leave_type',$get_type['leave_type']);
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
						->where('ld.joining_status','Submitted')
//						->where('ld.joining_status','Pending')
						->order_by('leave_status','asc')
						->order_by('application_dt','desc')
						->get()
						->result_array();
		return $res;
	}
	public function get_application_pending_joining_report_count($empid = ''){	
	
		$results = $this->db->select('count(*) join_tot')
				 ->from('employee_leave_debit ld')
				 ->where('ld.joining_autho_pan',$empid)
				 ->where('ld.leave_status','Sanctioned')
				 ->where('ld.joining_status','Submitted')
			     ->get()
				 ->result_array();
		return $results;
	}
	public function get_leave_pending_joining_all ($limit_to = 0, $empid = ''){
		$get = $this->input->get(array('leave_type'), TRUE);
		$this->db->select('ld.*')
				 ->from('employee_leave_debit ld')
				 ->where('ld.joining_autho_pan',$empid)
				 ->where('ld.leave_status','Sanctioned')
				 ->where('ld.joining_status','Submitted');		 
	
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
	
	public function get_employee_el_last_credit($empid = '',$leave_type=''){
		$res = $this->db->select('cr_to_date')
						->from('employee_leave_credit')
						->where('empid',$empid)
						->where('leave_type',$leave_type)
						->get()
						->result_array();
		return $res;
	}	
		public function get_employee_dor($empid = ''){
		$res = $this->db->select('dor')
						->from('employee_master')
						->where('empid',$empid)
						->get()
						->row_array();
		if(!empty($res)){
			return $res['dor'];
		}
		return 0;
	}
	
	public function get_employee_exol_last_period($empid = '',$last_period_from = '', $last_period_to = ''){
		$leave_type = 'Extra Ordinary Leave';
		$res = $this->db->select('leave_day_no')
						->from('employee_leave_debit')
						->where('empid',$empid)
						->where('leave_type',$leave_type)
						->where('date(leave_from) >= ',$last_period_from)
						->where('date(leave_from) <= ',$last_period_to)
						->get()
						->result_array();
		return $res;
	}
	
	public function get_employee_diesnon_last_period($empid = '', $last_period_from = '', $last_period_to =''){
		$leave_type = 'Dies Non';
		$res = $this->db->select('leave_day_no')
						->from('employee_leave_debit')
						->where('empid',$empid)
						->where('leave_type',$leave_type)
						->where('date(leave_from) >= ',$last_period_from)
						->where('date(leave_from) <= ',$last_period_to)
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
	public function get_clrh_closing_balance($empid = '', $leave_type = '', $leave_cr_year = ''){
		return  $this->db->select('lc.*')
						 ->from('employee_leave_credit lc')
						 ->where('lc.empid',$empid)
						 ->where('lc.leave_type',$leave_type)
						 ->where('lc.leave_cr_year',$leave_cr_year)
						 ->where('lc.status','Active')
//						 ->order_by('as_on','desc')
						 ->get()
						 ->result_array();
	}
	public function get_elhpl_closing_balance($empid = '',$leave_type=''){
		return  $this->db->select('*')
						 ->from('agb_employee_current_leave_balance')
						 ->where('empid',$empid)
						 ->where('leave_type',$leave_type)
						 ->get()
						 ->row_array();
	}

	public function get_yearwise_closing_clrh_balance($empid = '', $leave_type = '', $leave_cr_year = ''){
		return  $this->db->select('lc.*')
						 ->from('employee_leave_credit lc')
						 ->where('lc.empid',$empid)
						 ->where('lc.leave_type',$leave_type)
						 ->where('lc.leave_cr_year',$leave_cr_year)
						 ->where('lc.status','Active')
//						 ->order_by('as_on','desc')
						 ->get()
						 ->row_array();
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
			 ->where('training_id',$id)
			 ->get()->row_array();
		return !empty($res) ? explode(',',$res['emp_ids']) : array();
	}
	
		public function getTrainingPrgToFaculties($id){
		$res =  $this->db->select('group_concat(empid) as emp_ids')
		     ->from('training_to_faculty')
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
	public function add_training_to_faculties($id,$emp_concerned){
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
			foreach($emp_concerned as $empid=>$mobile){
				$this->db->where('training_id',$id)->where('empid',$empid)->delete('training_to_employee');
				send_TSMS($mobile); // from helper
				$this->db->insert('training_to_employee',array('training_id'=>$id,'empid'=>$empid));
			}
		}
	}
	public function update_training_to_faculties($id,$emp_concerned){
		if(is_array($emp_concerned)){
			foreach($emp_concerned as $empid=>$mobile){
				$this->db->where('training_id',$id)->where('empid',$empid)->delete('training_to_faculty');
//				send_TSMS($mobile); // from helper
				$this->db->insert('training_to_faculty',array('training_id'=>$id,'empid'=>$empid));
			}
		}
	}
	public function emp_training_details_record($emp_concerned, $training_id = ''){
	// sql 2	
		$res2 = $this->db->select('*')
						 ->from('training_master')
						 ->where('trang_id',$training_id)
						 ->get()->row_array();
		if(empty($res2)){
			return array($res2);
		}

	if(is_array($emp_concerned)){
		foreach($emp_concerned as $empid=>$mobile){

// sql 1	
		$res1 = $this->db->select('*')
						 ->from('employee_master')
						 ->where('empid',$empid)
						 ->get()
						 ->row_array();
		if(empty($res1)){
			return array($res1);
		}

// sql 3	
		$res3 = $this->db->select('*')
						 ->from('signature_master')
						 ->where('desig_code','dagadmn')
						 ->get()->row_array();
		if(empty($res3)){
			return array($res3);
		}

//merge sql 1  sql 2 and $res3
		$res = array_merge($res1,$res2,$res3);
	
		$res4 = $this->db->select('*')
						 ->from('employee_training')
						 ->where('empid',$empid)
						 ->where('training_id',$training_id)
						 ->get()
						 ->row_array();
		if(empty($res4)){
			$this->db->insert('employee_training',array('training_id'=>$training_id,'fin_year'=>$res['fin_year'],'training_mode'=>$res['training_mode'],'training_type'=>$res['training_type'],'training_order'=>$res['training_order'],
				'order_date'=>$res['order_date'],'title'=>$res['title'],'description'=>$res['description'],'location'=>$res['location'],'training_from'=>$res['training_from'],'training_to'=>$res['training_to'],'trg_time'=>$res['trg_time'],
				'training_days'=>$res['training_days'],'training_assign_dt'=>$res['training_assign_dt'],
				'empid'=>$empid,'name'=>$res['empname'],'desig'=>$res['desig'],'group_nm'=>$res['group_name'],'emp_section'=>$res['section'],'office_nm'=>$res['office'], 'basic_pay'=>$res['basic_pay'],
				'officer_name'=>$res['officer_name'],'officer_desig'=>$res['officer_desig'],'sign_tag'=>$res['sign_tag']));
		}
/*		
//insert into table	
		
				$this->db->insert('employee_training',array('training_id'=>$training_id,'fin_year'=>$res['fin_year'],'training_mode'=>$res['training_mode'],'training_type'=>$res['training_type'],'training_order'=>$res['training_order'],
				'order_date'=>$res['order_date'],'title'=>$res['title'],'description'=>$res['description'],'location'=>$res['location'],'training_from'=>$res['training_from'],'training_to'=>$res['training_to'],'trg_time'=>$res['trg_time'],
				'training_days'=>$res['training_days'],'training_assign_dt'=>$res['training_assign_dt'],
				'empid'=>$empid,'name'=>$res['empname'],'desig'=>$res['desig'],'group_nm'=>$res['group_name'],'emp_section'=>$res['section'],'office_nm'=>$res['office'], 'basic_pay'=>$res['basic_pay'],
				'officer_name'=>$res['officer_name'],'officer_desig'=>$res['officer_desig'],'sign_tag'=>$res['sign_tag']));
*/
		}
	}	
	return true;

	}
	
	public function emp_training_faculties_record($emp_concerned, $training_id = ''){
		// sql 2	
		$res2 = $this->db->select('*')
						 ->from('training_master')
						 ->where('trang_id',$training_id)
						 ->get()->row_array();
		if(empty($res2)){
			return array($res2);
		}

	if(is_array($emp_concerned)){
		foreach($emp_concerned as $empid=>$mobile){

	// sql 1	
		$res1 = $this->db->select('*')
						 ->from('employee_master')->where('empid',$empid)
						 ->get()
						 ->row_array();
		if(empty($res1)){
			return array($res1);
		}

// sql 3	
		$res3 = $this->db->select('*')
						 ->from('signature_master')
						 ->where('desig_code','dagadmn')
						 ->get()->row_array();
		if(empty($res2)){
			return array($res2);
		}

//merge sql 1, sql 2 and sql 3		
		$res = array_merge($res1,$res2,$res3);
//insert into table	
		$res4 = $this->db->select('*')
						 ->from('employee_training_faculty')
						 ->where('empid',$empid)
						 ->where('training_id',$training_id)
						 ->get()
						 ->row_array();
		if(empty($res4)){
				$this->db->insert('employee_training_faculty',array('training_id'=>$training_id,'fin_year'=>$res['fin_year'],'training_mode'=>$res['training_mode'],'training_type'=>$res['training_type'],'training_order'=>$res['training_order'],
				'order_date'=>$res['order_date'],'title'=>$res['title'],'description'=>$res['description'],'location'=>$res['location'],'training_from'=>$res['training_from'],'training_to'=>$res['training_to'],'trg_time'=>$res['trg_time'],
				'training_days'=>$res['training_days'],'training_assign_dt'=>$res['training_assign_dt'],
				'empid'=>$empid,'name'=>$res['empname'],'desig'=>$res['desig'],'group_nm'=>$res['group_name'],'emp_section'=>$res['section'],'office_nm'=>$res['office'], 'basic_pay'=>$res['basic_pay'],'feedback_status'=>'Pending',
				'officer_name'=>$res['officer_name'],'officer_desig'=>$res['officer_desig'],'sign_tag'=>$res['sign_tag']));
		}
		}
	}	
	return true;

	}
	
	public function get_all_trainings($limit_to=0,$office = 'AGAE',$wing = 'administration'){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('training_master')
//				 ->where('office',$office)
//				 ->where('wing',$wing)
				 ->order_by('trg_id','desc');
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
	public function get_employee_inspection_detail($empid = '', $try_insp_year = '' ){
		$res = $this->db->select('*')
				->from('employee_treasury_inspection ti')
				->where('ti.empid',$empid)
				->where('ti.try_insp_year',$try_insp_year)
				->order_by('ti.insp_rec_id','desc')
				->get()
				->result_array();
		return $res;
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
	public function get_employee_training_faculty_detail($empid = '',$training_type=''){
		$res = $this->db->select('*')
				->from('employee_training_faculty td')
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
	public function get_employee_property_decla_all ($limit_to = 0,$empid = ''){
		$get = $this->input->get(array('decl_for','pst_year'), TRUE);
		$this->db->select('*')
				 ->from('employee_property_statement')
				 ->where('empid',$empid);
	
		if($get['decl_for'] != ''){
			$this->db->where('decl_for',$get['decl_for']);
		}
		if($get['pst_year'] != ''){
			$this->db->where('pst_year',$get['pst_year']);
		}
		$this->db->order_by('pst_year','desc');
		$this->db->order_by('decl_for','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}	
	public function get_property_st_print($id = 0){
		return  $this->db->select('*')
						 ->from('employee_property_statement')
						 ->where('pst_id',$id)
						 ->get()
						 ->row_array();
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
	public function get_faculty_order_print($id = 0){
		return  $this->db->select('*')
						 ->from('employee_training_faculty')
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
	public function get_faculties_list($id = 0){
		$res = $this->db->select('*')
				->from('employee_training_faculty')
				->where('training_id',$id)
				->order_by('name','desc')
				->get()
				->result_array();
		return $res;
	}
	
	public function get_transfer_order_print($id = 0){
		return  $this->db->select('*')
						 ->from('section_transfer_details')
						 ->where('trans_ord_id',$id)
						 ->get()
						 ->row_array();
	}
	public function get_transferred_employee_list($id = 0){
		$res = $this->db->select('*')
				->from('section_transfer_details')
				->where('trans_ord_id',$id)
				->order_by('emp_name','desc')
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
//----faculty
	
	public function employee_training_faculty_records($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('employee_training_faculty')
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
	
//----employee training details	
	public function employee_trainings($limit_to = 0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('employee_training')
				 ->order_by('training_from','desc');
		
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('training_id',$get['search']);
				$this->db->or_like('empid',$get['search']);
				$this->db->or_like('name',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_training_master_details($id=0){
		return  $this->db->select('*')
						 ->from('training_master')
						 ->where('trang_id',$id)
						 ->get()
						 ->row_array();
	}
	public function employee_training_details($id=0){
		return  $this->db->select('*')
						 ->from('employee_training')
						 ->where('trg_detail_id',$id)
						 ->get()
						 ->row_array();
	}
	public function faculty_details($id=0){
		return  $this->db->select('*')
						 ->from('employee_training_faculty')
						 ->where('trg_detail_id',$id)
						 ->get()
						 ->row_array();
	}
	public function training_detail_feedback($id='',$empid=''){
		return  $this->db->select('*')
						 ->from('employee_training')
						 ->where('trg_detail_id',$id)
						 ->where('empid',$empid)
						 ->get()
						 ->row_array();
	}
	public function add_training_master_record(){
		$post = $this->input->post(array('trang_id','fin_year','location','training_mode','training_type','title','description','training_from','training_to','training_days','trg_time','training_assign_dt','training_order','order_date'), TRUE);
				
		$post['training_from'] = !empty($post['training_from']) ? date('Y-m-d',strtotime($post['training_from'])) : '';
		$post['training_to'] = !empty($post['training_to']) ? date('Y-m-d',strtotime($post['training_to'])) : '';
		$post['training_assign_dt'] = !empty($post['training_assign_dt']) ? date('Y-m-d',strtotime($post['training_assign_dt'])) : '';
		$post['order_date'] = !empty($post['order_date']) ? date('Y-m-d',strtotime($post['order_date'])) : '';
		
		$this->db->insert('training_master',$post);
		return true;
	}
	public function update_training_master_record($id=0){
		$post = $this->input->post(array('training_mode','training_type','title','description','training_from','training_to','training_days','trg_time','training_assign_dt','training_order','order_date'), TRUE);
		$update = array();
		$update['training_mode'] = $post['training_mode'];
		$update['training_type'] = $post['training_type'];
		$update['title'] = $post['title'];
		$update['description'] = $post['description'];
		$update['training_from'] = !empty($post['training_from']) ? date('Y-m-d',strtotime($post['training_from'])) : '';
		$update['training_to'] = !empty($post['training_to']) ? date('Y-m-d',strtotime($post['training_to'])) : '';
		$update['training_days'] = $post['training_days'];
		$update['trg_time'] = $post['trg_time'];
		$update['training_assign_dt'] = !empty($post['training_assign_dt']) ? date('Y-m-d',strtotime($post['training_assign_dt'])) : '';
		$update['training_order'] = $post['training_order'];
		$update['order_date'] = !empty($post['order_date']) ? date('Y-m-d',strtotime($post['order_date'])) : '';
		
		if(!empty($update) && $id != ''){
			$this->db->where('trang_id',$id)->update('training_master',$update);
		}
	}
	public function update_employee_training($id=0){
		$post = $this->input->post(array('empid','name','desig','emp_section','basic_pay','fin_year','training_order','order_date','training_mode','training_type','description','location','training_from','training_to','training_days','evaluation_link','eval_status','bill_no','advance_bill_no'), TRUE);
		$update = array();
		$update['empid'] = $post['empid'];
		$update['name'] = $post['name'];
		$update['desig'] = $post['desig'];
		$update['emp_section'] = $post['emp_section'];
		$update['basic_pay'] = $post['basic_pay'];
		$update['fin_year'] = $post['fin_year'];
		$update['training_order'] = $post['training_order'];
		$update['order_date'] = $post['order_date'];
		$update['training_mode'] = $post['training_mode'];
		$update['training_type'] = $post['training_type'];
		$update['description'] = $post['description'];
		$update['location'] = $post['location'];
		$update['training_from'] = $post['training_from'];
		$update['training_to'] = $post['training_to'];
		$update['training_days'] = $post['training_days'];
		$update['evaluation_link'] = $post['evaluation_link'];
		$update['eval_status'] = $post['eval_status'];
		$update['bill_no'] = $post['bill_no'];
		$update['advance_bill_no'] = $post['advance_bill_no'];
		
		if(!empty($update) && $id != ''){
			$this->db->where('trg_detail_id',$id)->update('employee_training',$update);
		}
	}
	public function update_employee_faculty_record($id=0){
		$post = $this->input->post(array('no_session','bill_no','bill_amt','advance_bill_no','adv_bill_amt','faculty_trg_dt_from','faculty_trg_dt_to','faculty_trg_time','topic'), TRUE);
		$update = array();
		
		$update['faculty_trg_dt_from'] = !empty($post['faculty_trg_dt_from']) ? date('Y-m-d',strtotime($post['faculty_trg_dt_from'])) : '';
		$update['faculty_trg_dt_to'] = !empty($post['faculty_trg_dt_to']) ? date('Y-m-d',strtotime($post['faculty_trg_dt_to'])) : '';
		$update['faculty_trg_time'] = $post['faculty_trg_time'];
		$update['no_session'] = $post['no_session'];
		$update['topic'] = $post['topic'];
		$update['bill_no'] = $post['bill_no'];
		$update['bill_amt'] = $post['bill_amt'];
		$update['advance_bill_no'] = $post['advance_bill_no'];
		$update['adv_bill_amt'] = $post['adv_bill_amt'];
		
		if(!empty($update) && $id != ''){
			$this->db->where('trg_detail_id',$id)->update('employee_training_faculty',$update);
		}
	}
	
	public function deleteTrainingOrderByID($id = 0){
		$this->db->where('trg_detail_id',$id)->delete('');
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
	
	public function get_employee_download($office_code = 'AGAE',$status='Active'){
		$post = $this->input->post(array('date_from','date_to','da_cadare'), TRUE);
		
//		$res = $this->db->select('em.*')
		$res = $this->db->select('em.e_id,em.empname,em.desig,em.group_name,em.section,em.nicmail,em.mbno')
						->from('employee_master em')
						->where('em.office_code',$office_code)
						->where('em.status',$status);
		if($post['date_from'] != ''){
			$f_date = date('Y-m-d',strtotime($post['date_from']));
			$this->db->where('date(em.dor) >= ',$f_date);
		}
		if($post['date_to'] != ''){
			$t_date = date('Y-m-d',strtotime($post['date_to']));
			$this->db->where('date(em.dor) <= ',$t_date);
		}
		if($post['da_cadare'] != ''){
			$this->db->where('em.da_cadare',$post['da_cadare']);
		}
		$res = $this->db->order_by('em.empname','desc')
						->get()
						->result_array();
		return $res;
	}	
	
	public function get_asset_declarations_download(){
		$post = $this->input->post(array('pst_year'), TRUE);
		$res = $this->db->select('*')
						->from('employee_property_statement');	
		if($post['pst_year'] != ''){
			$this->db->where('pst_year',$post['pst_year']);
		}
		$res = $this->db->order_by('emp_name','desc')
						->get()
						->result_array();
		return $res;
	}	

	public function get_all_signature_records($limit_to=0,$office = 'AGAE',$wing = 'administration'){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('signature_master')
				 ->order_by('sign_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('officer_desig',$get['officer_desig']);
				$this->db->or_like('officer_name',$get['officer_name']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}

	public function getSignatureTagByID($id = 0){
		$res = $this->db->select('*')->from('signature_master')->where('sign_id',$id)->get()->row_array();
		return $res;
	}
	public function addSignatureTag($update_array=array()){
		if(empty($update_array)){return 0;} 
		$this->db->insert('signature_master',$update_array);
		return $this->db->insert_id();
	}
	public function updateSignatureTag($id = 0, $update_array=array()){
		if(empty($update_array)){return $id;} 
		$this->db->where('sign_id',$id)->update('signature_master',$update_array);
		return $id;
	}
	public function deleteExamResultsByID($id = 0){
		$this->db->where('sign_id',$id)->delete('signature_master');
	}
	public function get_last_signature_id(){
		$res = $this->db->select ('max(sign_id) max_id')
						->from('signature_master')
						->get()
						->row_array();
		return $res;
	}
	
	public function get_treasury_office_inspection_report($limit_to = 0){
		$post = $this->input->get(array('dmonth','dyear','details'), TRUE);
		$this->db->select('*')
						->from('treasury_orders ot')
						->join('treasury_orders_to_try e','e.tfiles_id = ot.file_id')
						->where('order_type','Inspection Report');
		if($post['dmonth'] != ''){
			$this->db->where('dmonth',$post['dmonth']);
		}
		if($post['dyear'] != ''){
			$this->db->where('dyear',$post['dyear']);
		}
		if($post['details'] != ''){
			$this->db->like('details',$post['details']);
		}
		$this->db->order_by('dyear','desc')
				 ->order_by('dmonth','desc')
				 ->group_by('ot.file_id');
		
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function get_employee_pty_statement_submitted($emp_id = 0, $pst_year = '',$pst_as_on = '', $decl_for = ''){
		$res = $this->db->select('*')
						->from('employee_property_statement')
						->where('empid',$emp_id)
						->where('pst_year',$pst_year)
//						->where('pst_as_on',$pst_as_on)
						->where('decl_for',$decl_for)
						->order_by('pst_year','desc')
						->get()
						->row_array();
		return $res;
	}
	
	public function get_notice_display(){
		$get = $this->input->get(array('search'), TRUE);
		$results =  $this->db->select('*')
							 ->from('employee_notice_board')
							 ->where('flash !=','yes')
							 ->where('flash !=','word')
							 ->order_by('expiry_dt','desc')
							 ->order_by('display','yes');
							 	
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('title',$get['search']);
//				$this->db->or_like('expiry_dt',$get['search']);
			$this->db->group_end();
		}
		$results =  $this->db->get()
							 ->result_array();
		return $results;
	}
	
	public function get_flash_notice_display(){
		$results =  $this->db->select('*')
							 ->from('employee_notice_board')
							 ->where('flash','yes')
							 ->or_where('flash','word')
							 ->order_by('expiry_dt','desc')
							  ->order_by('display','yes');
							
		$results =  $this->db->get()
							 ->result_array();
		return $results;
	}
	
	public function get_employee_notice_by_id($id){
		$results =  $this->db->select('*')
							 ->from('employee_notice_board')
							 ->where('notice_id',$id);
		$results =  $this->db->get()
							 ->row_array();
		return $results;
	}
	public function add_employee_notice($update_data = array()){
		$res = $this->db->insert('employee_notice_board',$update_data);
		$id = $this->db->insert_id();
		return $id;
	}
	public function update_employee_notice($id='', $update_data = array()){
		$res = $this->db->where('notice_id',$id)->update('employee_notice_board',$update_data);
		return $id;
	}
	public function delete_employee_notice($id=''){
		$res = $this->db->where('notice_id',$id)->delete('employee_notice_board');
		return $id;
	}
	
	public function get_commutation_factor($age = ''){
		$res = $this->db->select('age, factor')
						->from('commutation_factors')
						->where('age',$age)
						->get()
						->row_array();
		return $res;
	}

	public function get_admin_all_sections($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('section_master')
				 ->where('sec_br_type','section')
				 ->order_by('sec_index','asc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('section',$get['search']);
			    $this->db->or_like('sec_br_group',$get['search']);
				$this->db->or_like('bo_index',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_admin_all_branches($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('section_master')
				 ->where('sec_br_type','branch')
				 ->order_by('sec_index','asc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('section',$get['search']);
			    $this->db->or_like('sec_br_group',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_admin_branch_officer_list($limit_to=0,$office = 'AGAE',$id = ''){
		$date = date('Y-m-d H:i:s');
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('e.*')
				 ->from('employee_master e')	
//				 ->where('ed.trans_ord_id',$id)
				 ->where('e.office_code',$office)
				 ->where('e.desig','SR. ACCOUNTS OFFICER')
				 ->or_where('e.desig','ASSTT. ACCOUNTS OFFICER')
				 ->where('date(e.dor) >= ',$date)
				 ->where('e.status','Active')
				 ->order_by('e.empname','asc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('e.empid',$get['search']);
				$this->db->or_like('e.empname',$get['search']);
//				$this->db->or_like('ed.trans_ord_id',$get['search']);
			$this->db->group_end();
		}
		$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function get_admin_section_allotted($limit_to = 0, $office = 'AGAE', $id = ''){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('e.*,a.*')
				 ->from('section_allotment_details e')
				 ->join('section_allotment_to_emp a','a.empid_inch_bo = e.empid','right')
				 ->where('e.present_group','ADMINISTRATION')
				 ->where('e.status','Active')
				 ->order_by('a.sallot_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('e.empid',$get['search']);
				$this->db->or_like('e.empname',$get['search']);
			$this->db->group_end();
		}
		$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function get_releasing_authorities($group = '',$office = 'AGAE'){
		$date = date('Y-m-d H:i:s');
		$results =  $this->db->select('e.empid,e.empname,e.desig,e.mbno,e.gpf_ac_no,e.office_id,e.section')
							 ->from('employee_master e')
//							 ->join('employee_details ed','ed.empid = e.empid','left')
							 ->where('group_name',$group)
							  ->where('e.office_code',$office)
				 			 ->where('date(dor) >= ',$date)
							 ->where('status','Active')
							 ->where('da_cadare','0')
							 ->where('desig','SR. ACCOUNTS OFFICER')
							 ->or_where('desig','DY. ACCOUNTANT GENERAL')
							 ->order_by('e.empname')
							 ->get()
							 ->result_array();
		return $results;
	}
	
	public function get_joining_authorities($office = 'AGAE'){
		$date = date('Y-m-d H:i:s');
		$results =  $this->db->select('e.empid,e.empname,e.desig,e.mbno,e.gpf_ac_no,e.office_id,e.section,e.group_name')
							 ->from('employee_master e')
//							 ->join('employee_details ed','ed.empid = e.empid','left')
							 ->where('office_code',$office)
				 			 ->where('date(dor) >= ',$date)
							 ->where('status','Active')
							 ->where('da_cadare','0')
							 ->where('desig','SR. ACCOUNTS OFFICER')
							 ->or_where('desig','DY. ACCOUNTANT GENERAL')
							 ->order_by('e.empname')
							 ->get()
							 ->result_array();
		return $results;
	}
	
	public function get_transfer_master($limit_to=0,$office = 'AGAE',$wing = 'administration'){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('section_transfer_master')
				 ->where('transf_group','ADMINISTRATION')
//				 ->where('wing',$wing)
				 ->order_by('transf_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
//				$this->db->like('fin_year',$get['search']);
//				$this->db->or_like('tr_nm',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function get_employee_transfer_records($limit_to = 0, $t_id = ''){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('section_transfer_details')
				 ->where('order_group','ADMINISTRATION')
				 ->order_by('sec_tnsf_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('trans_ord_id',$get['search']);
				$this->db->or_like('emp_id',$get['search']);
				$this->db->or_like('emp_name',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function get_employee_allotment_records($limit_to = 0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('section_allotment_details')
				 ->order_by('sallt_id','desc');
		
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('empid',$get['search']);
				$this->db->or_like('empname',$get['search']);
				
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}

	public function get_transferred_to_sections($emp_id = ''){
		$res = $this->db->select ('*')
						->from('section_allotment_to_emp')
						->where('empid_inch_bo',$emp_id)
						->order_by('section_desc','asc')
						->get()
						->result_array();
		return $res;
	}
	
	public function get_last_transfer_order_id(){
		$res = $this->db->select ('upload_dt,max(transf_id) max_id')
						->from('section_transfer_master')
						->get()
						->row_array();
		return $res;
	}
	public function get_max_transfer_order_id(){
		$res = $this->db->select ('max(transf_order_id) max_id')
						->from('section_transfer_master')
						->get()
						->row_array();
		return $res;
	}
	public function get_allotted_section_by_id($id){
		return $this->db->select('e.empid,e.empname,e.desig,a.*')
				 ->from('employee_master e')
				 ->join('section_allotment_to_emp a','a.empid_inch_bo = e.empid','left')
				 ->where('sallot_id',$id)
				 ->order_by('a.sallot_id','desc')
				 ->get()
				 ->row_array();
	}
	public function get_bo_index_by_sec_index($section){
		$res1 = $this->db->select('sec_index,bo_index')
				->from('section_master')
				->where('section',$section)
				->get()
				->row_array();
		$res1['bo_index'];
		$res = $this->db->select('empid_bo,branch_indx')
				->from('section_branch_allotment')
				->where('branch_indx',$res1['bo_index'])
				->get()
				->row_array();
		return $res['empid_bo'];
	}
	public function get_admin_section_by_id($id){
		return $this->db->select('*')
				->from('section_master')
				->where('section_id',$id)
				->get()
				->row_array();
	}
	public function get_admin_section_by_sec_index($id){
		return $this->db->select('*')
				->from('section_master')
				->where('sec_index',$id)
				->get()
				->row_array();
	}
	public function get_transfer_master_by_id($id){
		return $this->db->select('*')
				->from('section_transfer_master')
				->where('transf_order_id',$id)
				->get()
				->row_array();
	}
	public function get_admin_transfer_details_by_id($id){
		return $this->db->select('t.*, e.mbno')
				->from('section_transfer_details t')
				 ->join('employee_master e','e.empid = t.emp_id','left')
				->where('t.sec_tnsf_id',$id)
				->get()
				->row_array();
	}
	public function get_admin_allotment_details_by_id($id){
		return $this->db->select('*')
				->from('section_allotment_details')
				->where('sallt_id',$id)
				->get()
				->row_array();
	}
	
	public function getBranchOfficerEmployeeByID($id, $office = 'AGAE'){
		return $this->db->select('*')
				->from('employee_master')
				->where('empid',$id)
				->get()
				->row_array();
	}
	
	public function getSectionToEmployees($id){
		$res =  $this->db->select('group_concat(empid_inch_bo) as emp_ids')
		     ->from('section_allotment_to_emp')
			 ->where('sallot_id',$id)
			 ->get()->row_array();
		return !empty($res) ? explode(',',$res['emp_ids']) : array();
	}
	public function getSection_of_Employees($id){
		$res =  $this->db->select('group_concat(sectn_indx) as sectn_indx')
		     ->from('section_allotment_to_emp')
			 ->where('empid_inch_bo',$id)
			 ->get()->row_array();
		return !empty($res) ? explode(',',$res['sectn_indx']) : array();
	}
	public function getBranch_BO_Employees($id){
		$res =  $this->db->select('group_concat(branch_indx) as branch_indx')
		     ->from('section_branch_allotment')
			 ->where('empid_bo',$id)
			 ->get()->row_array();
		return !empty($res) ? explode(',',$res['branch_indx']) : array();
	}
	public function getSectionGroupOfEmployeeByID($id, $office = 'AGAE'){
		return $this->db->select('empid,group_name,section')
				->from('employee_master')
				->where('empid',$id)
				->get()
				->row_array();
	}
	public function getTransferOrderByID($id,$office='AGAE'){
		return $this->db->select('*')
				->from('section_transfer_master')
				->where('transf_order_id',$id)
//				->where('office',$office)
				->get()
				->row_array();
	}
	public function getTransferOrderToEmployees($id){
		$res =  $this->db->select('group_concat(empid) as emp_ids')
		     ->from('section_transfer_to_employee')
			 ->where('trans_id',$id)
			 ->get()->row_array();
		return !empty($res) ? explode(',',$res['emp_ids']) : array();
	}
	public function addSection($update_array=array()){
		if(empty($update_array)){return 0;} 
		$this->db->insert('section_master',$update_array);
		return $this->db->insert_id();
	}
	public function updateSection($id = 0, $update_array=array()){
		if(empty($update_array)){return $id;} 
		$this->db->where('section_id',$id)->update('section_master',$update_array);
		return $id;
	}
	public function updateSectionAllotmentCharge($id = 0, $update=array()){
		if(empty($update)){return $id;} 
		$this->db->where('sallot_id',$id)->update('section_allotment_to_emp',$update);
		return $id;
	}
	public function add_transfer_order_to_employee($id,$emp_concerned){
		if(is_array($emp_concerned)){
			$email = '';
			foreach($emp_concerned as $empid=>$mobile){
//				send_OSMS($mobile); // from helper
				$this->db->insert('section_transfer_to_employee',array('trans_order_id'=>$id,'empid'=>$empid));
			}
		}
	}
	public function update_transfer_order_to_employee($id,$emp_concerned){
		if(is_array($emp_concerned)){
			foreach($emp_concerned as $empid=>$mobile){
				$this->db->where('trans_order_id',$id)->where('empid',$empid)->delete('section_transfer_to_employee');
//				send_OSMS($mobile); // from helper
				$this->db->insert('section_transfer_to_employee',array('trans_order_id'=>$id,'empid'=>$empid));
			}
		}
	}
	public function update_section_master_bo_index($emp_branch,$emp_section){
		if(is_array($emp_branch)){
			foreach($emp_branch as $sec_index=>$section){
				$bo_index = $sec_index;
			}
			foreach($emp_section as $sec_index=>$section){
				$update['bo_index'] = $bo_index;
				if(!empty($sec_index)){
					$this->db->where('sec_index',$sec_index)->update('section_master',$update);
				}
			}
		}
	}
	public function update_link_bo_sections($emp_section,$bo_index){
		if(is_array($emp_section)){
			foreach($emp_section as $sec_index=>$section){
				$update['link_bo_index'] = $bo_index;
				if(!empty($sec_index)){
					$this->db->where('sec_index',$sec_index)->update('section_master',$update);
				}
			}
		}
	}
	public function add_section_to_employee($id,$emp_section){
		$this->db->where('empid_inch_bo',$id)->delete('section_allotment_to_emp');
		if(is_array($emp_section)){
			foreach($emp_section as $sec_index=>$section){
				$this->db->insert('section_allotment_to_emp',array('empid_inch_bo'=>$id,'sectn_indx'=>$sec_index,'section_desc'=>$section));
			}
		}
	}
	public function update_section_to_employee($id,$emp_section){
		$this->db->where('empid_inch_bo',$id)->delete('section_allotment_to_emp');
		if(is_array($emp_section)){
			foreach($emp_section as $sec_index=>$section){
				$this->db->insert('section_allotment_to_emp',array('empid_inch_bo'=>$id,'sectn_indx'=>$sec_index,'section_desc'=>$section));
			}
		}
	}		
	public function add_branch_to_incharge($id,$emp_branch){
		$this->db->where('empid_bo',$id)->delete('section_branch_allotment'); 
		if(is_array($emp_branch)){
			foreach($emp_branch as $sec_index=>$section){
				$this->db->insert('section_branch_allotment',array('empid_bo'=>$id,'branch_indx'=>$sec_index,'branch_desc'=>$section));
			}
		}
	}
	public function update_branch_to_incharge($id,$emp_branch){
		$this->db->where('empid_bo',$id)->delete('section_branch_allotment');  
		if(is_array($emp_branch)){
			foreach($emp_branch as $sec_index=>$section){
				$this->db->insert('section_branch_allotment',array('empid_bo'=>$id,'branch_indx'=>$sec_index,'branch_desc'=>$section));
			}
		}
	}		
	public function update_transfer_order_master($id=0){
		$post = $this->input->post(array('transf_year','transf_month','transf_order_no','transf_order_dt','transf_type','transf_group','description','transf_sanct_autho','transf_sanct_autho_dt','transf_sign_autho','order_file_link'), TRUE);
		$update = array();
		$update['transf_year'] = $post['transf_year'];
		$update['transf_month'] = $post['transf_month'];
		$update['transf_order_no'] = $post['transf_order_no'];
		$update['transf_order_dt'] = !empty($post['transf_order_dt']) ? date('Y-m-d',strtotime($post['transf_order_dt'])) : '';
		$update['transf_type'] = $post['transf_type'];
		$update['transf_group'] = $post['transf_group'];
		$update['description'] = $post['description'];
		$update['transf_sanct_autho'] = $post['transf_sanct_autho'];
		$update['transf_sanct_autho_dt'] = !empty($post['transf_sanct_autho_dt']) ? date('Y-m-d',strtotime($post['transf_sanct_autho_dt'])) : '';
		$update['transf_sign_autho'] = $post['transf_sign_autho'];
		$update['order_file_link'] = $post['order_file_link'];
		
		if(!empty($update) && $id != ''){
			$this->db->where('transf_order_id',$id)->update('section_transfer_master',$update);
		}
	}
	public function update_transfer_order_record($id='', $emp_section='', $mobile = ''){
		$post = $this->input->post(array('emp_id','trans_from_grp','trans_from_sec','trans_to_grp','sectn_indx','trans_to_sec','emp_section','charge_type','trans_note','trans_release_dt','trans_join_dt','release_autho_nm','release_autho_desig','release_autho_pan','joing_autho_nm','joing_autho_desig','joing_autho_pan'), TRUE);
		$update = array();
		$emp_id = $post['emp_id'];
		$update['trans_from_grp'] = $post['trans_from_grp'];
		$update['trans_from_sec'] = $post['trans_from_sec'];
		$update['trans_to_grp'] = $post['trans_to_grp'];

		if(is_array($emp_section)){
			foreach($emp_section as $sec_index=>$section){
				$update['sectn_indx'] = $sec_index;
				$update['trans_to_sec'] = $section;
			}
		}		
/*		
		$trans_to = explode('@@@',$post['trans_emp_sec']);
		if(count($trans_to) == 2){
			$update['sectn_indx'] = isset($trans_to[0]) ? $trans_to[0] : '';
			$update['trans_to_sec'] = isset($trans_to[1]) ? $trans_to[1] : '';
		}
*/
		$update['charge_type'] = $post['charge_type'];
		$update['trans_note'] = $post['trans_note'];
		$update['trans_release_dt'] = !empty($post['trans_release_dt']) ? date('Y-m-d',strtotime($post['trans_release_dt'])) : '';
		$update['trans_join_dt'] = !empty($post['trans_join_dt']) ? date('Y-m-d',strtotime($post['trans_join_dt'])) : ''; 
		
		$release_autho = explode('@@@',$post['release_autho_pan']);
		if(count($release_autho) == 3){
			$update['release_autho_nm'] = isset($release_autho[0]) ? $release_autho[0] : '';
			$update['release_autho_desig'] = isset($release_autho[1]) ? $release_autho[1] : '';
			$update['release_autho_pan'] = isset($release_autho[2]) ? $release_autho[2] : '';
		}
		
		$join_autho = explode('@@@',$post['joing_autho_pan']);
		if(count($join_autho) == 3){
			$update['joing_autho_nm'] = isset($join_autho[0]) ? $join_autho[0] : '';
			$update['joing_autho_desig'] = isset($join_autho[1]) ? $join_autho[1] : '';
			$update['joing_autho_pan'] = isset($join_autho[2]) ? $join_autho[2] : '';
		}
		$update['order_issue_date'] = date('Y-m-d');
		$update['update_dt'] = date('Y-m-d H:i:s');
		
		if(!empty($update) && $id != ''){
			send_OSMS($mobile); // from helper
			$this->db->where('sec_tnsf_id',$id)->update('section_transfer_details',$update);
		}
	return true;
	}
	
	public function emp_section_allotment_details_add($empid = '', $emp_section = '', $emp_branch = '', $staff_type=''){
		$post = $this->input->post(array('empid','emp_name','emp_desig','allot_group','allot_order_no','allot_order_dt','charge_from_dt','charge_to_dt','present_group','staff_type','status'), TRUE);
		$post['empid'] = $empid;
		
//		$post['emp_name'] = $this->input->post('emp_name');
		$post['present_group'] = $this->input->post('trans_to_grp');
		$post['allot_order_dt'] = !empty($post['allot_order_dt']) ? date('Y-m-d',strtotime($post['allot_order_dt'])) : '';
		$post['charge_from_dt'] = !empty($post['charge_from_dt']) ? date('Y-m-d',strtotime($post['charge_from_dt'])) : '';
		$post['charge_to_dt'] = !empty($post['charge_to_dt']) ? date('Y-m-d',strtotime($post['charge_to_dt'])) : '';
		$post['status'] = 'Active';
		$post['allotment_dt'] = date('Y-m-d');
		
		if(is_array($emp_section)){
			foreach($emp_section as $sec_index=>$section){
				$post['sectn_indx'] = $sec_index;
				$post['section_desc'] = $section;
			}
		}
		if(is_array($emp_branch)){
			foreach($emp_branch as $branch_indx=>$section){
				$post['branch_indx'] = $branch_indx;
				$post['branch_desc'] = $section;
			}
		}
		$post['update_dt'] = date('Y-m-d H:i:s');
		if(!empty($empid)){
			$this->db->insert('section_allotment_details',$post);
		}
		
		$update = array();
		
		$update['sect_idx'] = $post['sectn_indx'];
		$update['section'] = $post['section_desc'];
		$update['branch_indx'] = $post['branch_indx'];
		$update['branch_desc'] = $post['branch_desc'];
		$update['staff_type'] = $post['staff_type'];
		
		if(!empty($empid)){
//			$this->db->where('empid',$empid)->update('employee_master',$update);
		}
		
	return true;
	
	}
	
	public function emp_section_allotment_details_update($id = '', $emp_section = '', $emp_branch = '', $staff_type = ''){
		$post = $this->input->post(array('allot_group','allot_order_no','allot_order_dt','allot_autho_nm','','charge_from_dt','charge_to_dt','staff_type'), TRUE);

		$update = array();
		$update['allot_order_dt'] = !empty($post['allot_order_dt']) ? date('Y-m-d',strtotime($post['allot_order_dt'])) : '';
		$update['charge_from_dt'] = !empty($post['charge_from_dt']) ? date('Y-m-d',strtotime($post['charge_from_dt'])) : '';
		$update['charge_to_dt'] = !empty($post['charge_to_dt']) ? date('Y-m-d',strtotime($post['charge_to_dt'])) : '';
		$update['update_dt'] = date('Y-m-d H:i:s');
		
		if(!empty($id)){
//			$this->db->where('sec_tnsf_id',$id)->update('section_allotment_details',$update);
		}
		
	return true;
	}
	
	public function emp_section_charge_period_update( $id = '', $update = array() ){	
		if(!empty($id)){
			$this->db->where('sallt_id',$id)->update('section_allotment_details',$update);
		}			
	return true;
	}

	public function emp_section_transfer_details_record( $id = '', $emp_concerned = '', $autho = ''){
	// sql 2	
		$res2 = $this->db->select('*')
						 ->from('section_transfer_master')
						 ->where('transf_order_id',$id)
						 ->get()->row_array();
		if(empty($res2)){
			return array($res2);
		}

	if(is_array($emp_concerned)){
		foreach($emp_concerned as $empid=>$mobile){

	// sql 1	
		$res1 = $this->db->select('*')
						 ->from('employee_master')->where('empid',$empid)
						 ->get()
						 ->row_array();
		if(empty($res1)){
			return array($res1);
		}

   // sql 3	
		$res3 = $this->db->select('*')
						 ->from('signature_master')
						 ->where('desig_code',$autho)
						 ->get()->row_array();
		if(empty($res2)){
			return array($res2);
		}

//merge sql 1  sql 2 and $res3
		$res = array_merge($res1,$res2,$res3);
//insert into table	
		$res4 = $this->db->select('*')
						 ->from('section_transfer_details')
						 ->where('emp_id',$empid)
						 ->where('trans_ord_id',$id)
						 ->get()
						 ->row_array();
		if(empty($res4)){
				$this->db->insert('section_transfer_details',array('trans_ord_id'=>$id,'trans_year'=>$res['transf_year'],'trans_month'=>$res['transf_month'],
				'order_group'=>$res['transf_group'],'trans_type'=>$res['transf_type'], 'trans_order_no'=>$res['transf_order_no'],'trans_order_dt'=>$res['transf_order_dt'],'description'=>$res['description'],
				'emp_id'=>$empid,'emp_name'=>$res['empname'],'emp_desig'=>$res['desig'],'emp_pic'=>$res['picture'],'emp_gender'=>$res['gender'],
				'autho_name'=>$res['officer_name'],'autho_desig'=>$res['officer_desig'],'sign_tag'=>$res['sign_tag'],'status'=>'Initiated','upload_dt'=>date('Y-m-d H:i:s')));
		}
		}
	}	
	return true;
	}
	
	public function fetch_employee_transfer_release_record($id = '',$empid = ''){
		$res = $this->db->select('*')
						->from('section_transfer_details')
						->where('sec_tnsf_id',$id)
						->where('release_autho_pan',$empid)	
						->order_by('trans_order_dt','desc')
						->get()
						->row_array();
		return $res;
	}	
		public function fetch_employee_transfer_join_record($id = '',$empid = ''){
		$res = $this->db->select('*')
						->from('section_transfer_details')
						->where('sec_tnsf_id',$id)
						->where('joing_autho_pan',$empid)	
						->order_by('trans_order_dt','desc')
						->get()
						->row_array();
		return $res;
	}	
	
	public function emp_transfer_release_update($id=0){
		$post =  $this->input->post(array('trans_release_dt','release_autho_remark','release_autho_rek_dt','release_autho_nm','release_autho_desig','release_autho_pan','status' ), TRUE);
		$update = array();
		
		$update['trans_release_dt'] = !empty($post['trans_release_dt']) ? date('Y-m-d',strtotime($post['trans_release_dt'])) : '';
		$update['release_autho_remark'] = $post['release_autho_remark'];
		$update['release_autho_rek_dt'] = !empty($post['release_autho_rek_dt']) ? date('Y-m-d',strtotime($post['release_autho_rek_dt'])) : '';
		$update['release_autho_nm'] = $post['release_autho_nm'];
		$update['release_autho_desig'] = $post['release_autho_desig'];
		$update['release_autho_pan'] = $post['release_autho_pan']; 
		$update['status'] = $post['status'];
		$update['update_dt'] = date('Y-m-d H:i:s');
		
		if(!empty($update) && $id != ''){
			$this->db->where('sec_tnsf_id',$id)->update('section_transfer_details',$update);
		}
	}
	
	public function emp_transfer_join_update($id=0){
		$post =  $this->input->post(array('trans_join_dt','joing_autho_remark','joing_autho_rek_dt','joing_autho_nm','joing_autho_desig','joing_autho_pan','status' ), TRUE);
		$update = array();
		
		$update['trans_join_dt'] = !empty($post['trans_join_dt']) ? date('Y-m-d',strtotime($post['trans_join_dt'])) : '';
		$update['joing_autho_remark'] = $post['joing_autho_remark'];
		$update['joing_autho_rek_dt'] = !empty($post['joing_autho_rek_dt']) ? date('Y-m-d',strtotime($post['joing_autho_rek_dt'])) : '';
		$update['joing_autho_nm'] = $post['joing_autho_nm'];
		$update['joing_autho_desig'] = $post['joing_autho_desig'];
		$update['joing_autho_pan'] = $post['joing_autho_pan'];		
		$update['status'] = 'Joined';
		$update['update_dt'] = date('Y-m-d H:i:s');
		
		if(!empty($update) && $id != ''){
			$this->db->where('sec_tnsf_id',$id)->update('section_transfer_details',$update);
		}
	}
	
	public function get_last_transfer_allotment_id($empid = ''){
		$res = $this->db->select ('max(sallt_id) max_id')
						->from('section_allotment_details')
						->where('empid', $empid)
						->get()
						->row_array();
		return $res;
	}
	public function get_last_transfer_allotment_details($allot_id = ''){
		$res = $this->db->select ('empid_sec,present_group,sectn_indx,section_desc,empid,branch_indx,branch_desc,staff_type')
						->from('section_allotment_details')
						->where('sallt_id', $allot_id)
						->get()
						->row_array();
		return $res;
	}
	
	public function get_emp_master_section_update( $empid = '', $update=array() ){		
		if(!empty($empid) && !empty($update)){
			$this->db->where('empid',$empid)->update('employee_master',$update);
		}
					
	return true;
	}
	
	public function get_allotment_details_release_update( $empid = '', $update =array() ){
		if(!empty($empid)){
			$this->db->where('empid',$empid)->where('status','Active')->update('section_allotment_details',$update);
		}				
	return true;
	}
	
	public function get_allotment_details_joining_update( $allot_id = '', $updat_allot =array() ){	
		if(!empty($allot_id)){
			$this->db->where('sallt_id',$allot_id)->update('section_allotment_details',$updat_allot);
		}			
	return true;
	}
	public function get_section_allotment_to_emp_update( $empid = '', $sectn_indx = '' ){	
		$update = array();
		$update['charge_type'] = 'Primary';
		if(!empty($sectn_indx)){
			$this->db->where('empid_inch_bo',$empid)->where('sectn_indx',$sectn_indx)->update('section_allotment_to_emp',$update);
		}			
	return true;
	}
	public function get_branch_allotment_record($branch_indx = ''){
		$res = $this->db->select ('*')
						->from('section_branch_allotment')
						->where('branch_indx', $branch_indx)
						->get()
						->row_array();
		return $res;
	}
	public function get_section_allotment_record($sectn_indx = ''){
		$res = $this->db->select ('*')
						->from('section_allotment_to_emp')
						->where('sectn_indx', $sectn_indx)
						->get()
						->row_array();
		return $res;
	}
	public function add_new_family_member(){
		$post =  $this->input->post(array('empid','member_name','member_dob','member_bplace','member_gender','memb_fname','memb_mname','member_acard_no','member_vcard_no','member_pp_no','family_relation','first_second_child','marital_status','ph_status','ph_percentage','upload_dt'), TRUE);
	
		$post['member_dob'] = !empty($post['member_dob']) ? date('Y-m-d',strtotime($post['member_dob'])) : '';
		$post['upload_dt'] = date('Y-m-d H:i:s');
		
		$this->db->insert('employee_family',$post);
		return true;
	}
	public function update_existig_family_member($id=0, $empid='' ){
		$post =  $this->input->post(array('member_name','member_dob','member_bplace','member_gender','memb_fname','memb_mname','member_acard_no','member_vcard_no','member_pp_no','family_relation','first_second_child','marital_status','ph_status','ph_percentage'), TRUE);
		$update = array();
		$update['member_name'] = $post['member_name'];
		$update['member_dob'] = !empty($post['member_dob']) ? date('Y-m-d',strtotime($post['member_dob'])) : '';
		$update['member_bplace'] = $post['member_bplace'];
		$update['member_gender'] = $post['member_gender'];
		$update['memb_fname'] = $post['memb_fname'];
		$update['memb_mname'] = $post['memb_mname'];
		$update['member_acard_no'] = $post['member_acard_no'];
		$update['member_vcard_no'] = $post['member_vcard_no'];
		$update['member_pp_no'] = $post['member_pp_no'];
		$update['family_relation'] = $post['family_relation'];
		$update['first_second_child'] = $post['first_second_child'];
		$update['marital_status'] = $post['marital_status'];
		$update['ph_status'] = $post['ph_status'];
		$update['ph_percentage'] = $post['ph_percentage'];

		if(!empty($update) && $id != ''){
			$this->db->where('empid',$empid)->where('family_member_id',$id)->update('employee_family',$update);
		}
	}
	public function get_employee_exam_application_other_count($empid = ''){
		$yr = date('Y');
		$results = $this->db->select('count(*) exam_ct')
				 ->from('employee_exam_other')
				 ->where('empid',$empid)
				 ->where('emp_type', 'Permanent')
				 ->where('exam_appli_yr', $yr)
				 ->order_by('exam_odr_id','desc')
			     ->get()
				 ->row_array();
		return $results;
	}
	public function get_employee_bill_count($empid = ''){
		$results = $this->db->select('count(*) exam_ct')
				 ->from('employee_bills')
				 ->where('empid',$empid)
				 ->order_by('bill_id','desc')
			     ->get()
				 ->row_array();
		return $results;
	}
	public function get_employee_exam_application_other($empid = ''){
		$res = $this->db->select('*')
						->from('employee_exam_other')
						->where('empid',$empid)
						->order_by('exam_odr_id','desc')
						->get()
						->row_array();
		return $res;
	}
	public function add_exam_application_other($exam_sl_no){
		$post =  $this->input->post(array('empid','office_id','name','desig','emp_section','group_nm','office_nm','emp_type','emp_category','basic_pay','emp_qualifi','mbno',
		'dob','doj','dor','service_as_on','exam_sl_no','exam_appli_yr','exam_name','conducted_by','post_applied','post_pay_level','advtiser','govt_foreign',
		'emp_undertking','quali_for_post','expri_for_post','age_as_on','other_qualifi','emp_qualifi','recom_experi','service_period','ser_bk_age',
		'sbk_other_qualifi','eligibility','attachment','appli_status','appli_date','upload_dt','sec_off_nm'), TRUE);
		
		$autho = explode('@@@',$post['sec_off_nm']);
		if(count($autho) == 3){
			$post['sec_off_nm'] = isset($autho[0]) ? $autho[0] : '';
			$post['sec_off_desig'] = isset($autho[1]) ? $autho[1] : '';
			//$post['currently_with'] = isset($autho[2]) ? $autho[2] : '';
			$post['current_off_nm'] = isset($autho[0]) ? $autho[0] : '';
			$post['current_off_desig'] = isset($autho[1]) ? $autho[1] : '';
			$post['currently_with'] = isset($autho[2]) ? $autho[2] : '';
		}
		
		$post['exam_sl_no'] = $exam_sl_no;
		$post['dob'] = !empty($post['dob']) ? date('Y-m-d',strtotime($post['dob'])) : '';
		$post['doj'] = !empty($post['doj']) ? date('Y-m-d',strtotime($post['doj'])) : '';
		$post['dor'] = !empty($post['dor']) ? date('Y-m-d',strtotime($post['dor'])) : '';
		$post['service_as_on'] = !empty($post['service_as_on']) ? date('Y-m-d',strtotime($post['service_as_on'])) : '';
		$post['age_as_on'] = !empty($post['age_as_on']) ? date('Y-m-d',strtotime($post['age_as_on'])) : '';
		$post['service_period'] = getAgeFull($post['doj'],$post['service_as_on']);
		$post['emp_age'] = getAgeFull($post['dob'],$post['age_as_on']);
		$post['exam_appli_yr'] = date('Y');
		$post['appli_status'] = 'Submitted';
		$post['appli_date'] = date('Y-m-d');
		$post['upload_dt'] = date('Y-m-d H:i:s');
		
		$this->db->insert('employee_exam_other',$post);
		return true;
	}
	public function update_exam_application_other($id = ''){
		$post = $this->input->post(array('empid','dob','doj','other_qualifi','govt_foreign','emp_undertking','expri_for_post','recom_experi','age_as_on','emp_age','service_as_on','service_period','sec_off_remrk','sec_off_nm','sec_off_desig','sec_off_dt','bo_remrk','bo_nm','bo_desig','bo_dt',
		'reccomendation','appli_status','reason_recco','checker_nm','checker_desig','checker_dt','aao_name','aao_desig','aao_remrk','aao_dt','sao_name','sao_desig','sao_remrk','sao_dt',
		'dag_name','dag_desig','dag_remrk','dag_dt','pag_name','pag_desig','pag_remrk','pag_dt','reason_rec_seclt','recom_autho','currently_with','current_off_nm','current_off_desig'), TRUE);
		$update = array();
		
		$empid = $post['empid'];	
		$autho = explode('@@@',$post['recom_autho']);
		if(count($autho) == 3){
			$update['current_off_nm'] = isset($autho[0]) ? $autho[0] : '';
			$update['current_off_desig'] = isset($autho[1]) ? $autho[1] : '';
			$update['currently_with'] = isset($autho[2]) ? $autho[2] : '';
		}
		if($post['other_qualifi'] != ''){$update['other_qualifi'] = $post['other_qualifi'];}
		if($post['govt_foreign'] != ''){$update['govt_foreign'] = $post['govt_foreign'];}
		if($post['emp_undertking'] != ''){$update['emp_undertking'] = $post['emp_undertking'];}
		if($post['expri_for_post'] != ''){$update['expri_for_post'] = $post['expri_for_post'];}
		if($post['recom_experi'] != ''){$update['recom_experi'] = $post['recom_experi'];}
		if($post['age_as_on'] != ''){$update['age_as_on'] = date('Y-m-d',strtotime($post['age_as_on']));}
//		if($post['emp_age'] != ''){$update['emp_age'] = $post['emp_age'];}
		if($post['age_as_on'] != ''){
		$update['emp_age'] = getAgeFull(date('Y-m-d',strtotime($post['dob'])),date('Y-m-d',strtotime($post['age_as_on'])));
		}
		if($post['service_as_on'] != ''){$update['service_as_on'] = date('Y-m-d',strtotime($post['service_as_on']));}
//		if($post['service_period'] != ''){$update['service_period'] = $post['service_period'];}
		if($post['service_as_on'] != ''){
		$update['service_period'] = getAgeFull(date('Y-m-d',strtotime($post['doj'])),date('Y-m-d',strtotime($post['service_as_on'])));
		}
		if($post['sec_off_remrk'] != ''){$update['sec_off_remrk'] = $post['sec_off_remrk'];}
		if($post['sec_off_nm'] != ''){$update['sec_off_nm'] = $post['sec_off_nm'];}
		if($post['sec_off_desig'] != ''){$update['sec_off_desig'] = $post['sec_off_desig'];}
		if($post['sec_off_dt'] != ''){$update['sec_off_dt'] = date('Y-m-d',strtotime($post['sec_off_dt']));}
		if($post['bo_remrk'] != ''){$update['bo_remrk'] = $post['bo_remrk'];}
		if($post['bo_nm'] != ''){$update['bo_nm'] = $post['bo_nm'];}
		if($post['bo_desig'] != ''){$update['bo_desig'] = $post['bo_desig'];}
		if($post['bo_dt'] != ''){$update['bo_dt'] = date('Y-m-d',strtotime($post['bo_dt']));}
		if($post['reccomendation'] != ''){$update['reccomendation'] = $post['reccomendation'];}
		if($post['reason_rec_seclt'] != ''){$update['reason_rec_seclt'] = $post['reason_rec_seclt'];}
		if($post['appli_status'] != ''){$update['appli_status'] = $post['appli_status'];}
		if($post['appli_status'] == 'Recommended'){
			$update['appl_flag'] = 'R';
		}else if($post['appli_status'] == 'Not Permitted'){
			$update['appl_flag'] = 'C';
		}else if($post['appli_status'] == 'Returned'){
			$update['appl_flag'] = 'P';
			$update['current_off_nm'] = '';
			$update['current_off_desig'] = '';
			$update['currently_with'] = '';
		}
		if($post['reason_recco'] != ''){$update['reason_recco'] = $post['reason_recco'];}
		if($post['checker_nm'] != ''){$update['checker_nm'] = $post['checker_nm'];}
		if($post['checker_desig'] != ''){$update['checker_desig'] = $post['checker_desig'];}
		if($post['checker_dt'] != ''){$update['checker_dt'] = date('Y-m-d',strtotime($post['checker_dt']));}
		if($post['aao_name'] != ''){$update['aao_name'] = $post['aao_name'];}
		if($post['aao_desig'] != ''){$update['aao_desig'] = $post['aao_desig'];}
		if($post['aao_remrk'] != ''){$update['aao_remrk'] = $post['aao_remrk'];}
		if($post['aao_dt'] != ''){$update['aao_dt'] = date('Y-m-d',strtotime($post['aao_dt']));}
		if($post['sao_name'] != ''){$update['sao_name'] = $post['sao_name'];}
		if($post['sao_desig'] != ''){$update['sao_desig'] = $post['sao_desig'];}
		if($post['sao_remrk'] != ''){$update['sao_remrk'] = $post['sao_remrk'];}
		if($post['sao_dt'] != ''){$update['sao_dt'] = date('Y-m-d',strtotime($post['sao_dt']));}
		if($post['dag_name'] != ''){$update['dag_name'] = $post['dag_name'];}
		if($post['dag_desig'] != ''){$update['dag_desig'] = $post['dag_desig'];}
		if($post['dag_remrk'] != ''){$update['dag_remrk'] = $post['dag_remrk'];}
		if($post['dag_dt'] != ''){$update['dag_dt'] = date('Y-m-d',strtotime($post['dag_dt']));}
		if($post['pag_name'] != ''){$update['pag_name'] = $post['pag_name'];}
		if($post['pag_desig'] != ''){$update['pag_desig'] = $post['pag_desig'];}
		if($post['pag_remrk'] != ''){$update['pag_remrk'] = $post['pag_remrk'];}
		if($post['pag_dt'] != ''){$update['pag_dt'] = date('Y-m-d',strtotime($post['pag_dt']));}
		$update['update_dt'] = date('Y-m-d');
		
		if(!empty($update) && $id != ''){
			$this->db->where('exam_odr_id',$id)->where('empid',$empid)->update('employee_exam_other',$update);
		}
	}
	public function save_exam_application_other($id = ''){
		$post = $this->input->post(array('dob','doj','other_qualifi','govt_foreign','emp_undertking','expri_for_post','recom_experi','age_as_on','emp_age','service_as_on','service_period','sec_off_remrk','sec_off_nm','sec_off_desig','sec_off_dt','bo_remrk','bo_nm','bo_desig','bo_dt',
		'reccomendation','appli_status','reason_recco','checker_nm','checker_desig','checker_dt','aao_name','aao_desig','aao_remrk','aao_dt','sao_name','sao_desig','sao_remrk','sao_dt',
		'dag_name','dag_desig','dag_remrk','dag_dt','pag_name','pag_desig','pag_remrk','pag_dt','reason_rec_seclt','recom_autho','currently_with','current_off_nm','current_off_desig'), TRUE);
		$update = array();
				
		$autho = explode('@@@',$post['recom_autho']);
		if(count($autho) == 3){
			$update['current_off_nm'] = isset($autho[0]) ? $autho[0] : '';
			$update['current_off_desig'] = isset($autho[1]) ? $autho[1] : '';
			$update['currently_with'] = isset($autho[2]) ? $autho[2] : '';
		}
		if($post['other_qualifi'] != ''){$update['other_qualifi'] = $post['other_qualifi'];}
		if($post['govt_foreign'] != ''){$update['govt_foreign'] = $post['govt_foreign'];}
		if($post['emp_undertking'] != ''){$update['emp_undertking'] = $post['emp_undertking'];}
		if($post['expri_for_post'] != ''){$update['expri_for_post'] = $post['expri_for_post'];}
		if($post['recom_experi'] != ''){$update['recom_experi'] = $post['recom_experi'];}
		if($post['age_as_on'] != ''){$update['age_as_on'] = date('Y-m-d',strtotime($post['age_as_on']));}
//		if($post['emp_age'] != ''){$update['emp_age'] = $post['emp_age'];}
		if($post['age_as_on'] != ''){
		$update['emp_age'] = getAgeFull(date('Y-m-d',strtotime($post['dob'])),date('Y-m-d',strtotime($post['age_as_on'])));
		}
		if($post['service_as_on'] != ''){$update['service_as_on'] = date('Y-m-d',strtotime($post['service_as_on']));}
//		if($post['service_period'] != ''){$update['service_period'] = $post['service_period'];}
		if($post['service_as_on'] != ''){
		$update['service_period'] = getAgeFull(date('Y-m-d',strtotime($post['doj'])),date('Y-m-d',strtotime($post['service_as_on'])));
		}
		if($post['sec_off_remrk'] != ''){$update['sec_off_remrk'] = $post['sec_off_remrk'];}
		if($post['sec_off_nm'] != ''){$update['sec_off_nm'] = $post['sec_off_nm'];}
		if($post['sec_off_desig'] != ''){$update['sec_off_desig'] = $post['sec_off_desig'];}
		if($post['sec_off_dt'] != ''){$update['sec_off_dt'] = date('Y-m-d',strtotime($post['sec_off_dt']));}
		if($post['bo_remrk'] != ''){$update['bo_remrk'] = $post['bo_remrk'];}
		if($post['bo_nm'] != ''){$update['bo_nm'] = $post['bo_nm'];}
		if($post['bo_desig'] != ''){$update['bo_desig'] = $post['bo_desig'];}
		if($post['bo_dt'] != ''){$update['bo_dt'] = date('Y-m-d',strtotime($post['bo_dt']));}
		if($post['reccomendation'] != ''){$update['reccomendation'] = $post['reccomendation'];}
		if($post['reason_rec_seclt'] != ''){$update['reason_rec_seclt'] = $post['reason_rec_seclt'];}
		if($post['appli_status'] != ''){$update['appli_status'] = $post['appli_status'];}
		if($post['appli_status'] == 'Recommended'){
			$update['appl_flag'] = 'R';
		}else if($post['appli_status'] == 'Not Permitted'){
			$update['appl_flag'] = 'C';
		}
		if($post['reason_recco'] != ''){$update['reason_recco'] = $post['reason_recco'];}
		if($post['checker_nm'] != ''){$update['checker_nm'] = $post['checker_nm'];}
		if($post['checker_desig'] != ''){$update['checker_desig'] = $post['checker_desig'];}
		if($post['checker_dt'] != ''){$update['checker_dt'] = date('Y-m-d',strtotime($post['checker_dt']));}
		if($post['aao_name'] != ''){$update['aao_name'] = $post['aao_name'];}
		if($post['aao_desig'] != ''){$update['aao_desig'] = $post['aao_desig'];}
		if($post['aao_remrk'] != ''){$update['aao_remrk'] = $post['aao_remrk'];}
		if($post['aao_dt'] != ''){$update['aao_dt'] = date('Y-m-d',strtotime($post['aao_dt']));}
		if($post['sao_name'] != ''){$update['sao_name'] = $post['sao_name'];}
		if($post['sao_desig'] != ''){$update['sao_desig'] = $post['sao_desig'];}
		if($post['sao_remrk'] != ''){$update['sao_remrk'] = $post['sao_remrk'];}
		if($post['sao_dt'] != ''){$update['sao_dt'] = date('Y-m-d',strtotime($post['sao_dt']));}
		if($post['dag_name'] != ''){$update['dag_name'] = $post['dag_name'];}
		if($post['dag_desig'] != ''){$update['dag_desig'] = $post['dag_desig'];}
		if($post['dag_remrk'] != ''){$update['dag_remrk'] = $post['dag_remrk'];}
		if($post['dag_dt'] != ''){$update['dag_dt'] = date('Y-m-d',strtotime($post['dag_dt']));}
		if($post['pag_name'] != ''){$update['pag_name'] = $post['pag_name'];}
		if($post['pag_desig'] != ''){$update['pag_desig'] = $post['pag_desig'];}
		if($post['pag_remrk'] != ''){$update['pag_remrk'] = $post['pag_remrk'];}
		if($post['pag_dt'] != ''){$update['pag_dt'] = date('Y-m-d',strtotime($post['pag_dt']));}
		$update['update_dt'] = date('Y-m-d');
		
		if(!empty($update) && $id != ''){
			$this->db->where('exam_odr_id',$id)->update('employee_exam_other',$update);
		}
	}
	public function update_employee_bill_process($id = ''){
		$post = $this->input->post(array('sec_off_remrk','sec_off_nm','sec_off_desig','sec_off_dt','bo_remrk','bo_nm','bo_desig','bo_dt',
		'appli_status','aao_name','aao_desig','aao_remrk','aao_dt','sao_name','sao_desig','sao_remrk','sao_dt','checker_nm','checker_desig','checker_dt',
		'dag_name','dag_desig','dag_remrk','dag_dt','pag_name','pag_desig','pag_remrk','pag_dt','recom_autho','currently_with','current_off_nm','current_off_desig'), TRUE);
		$update = array();
		
		$autho = explode('@@@',$post['recom_autho']);
		if(count($autho) == 3){
			$update['current_off_nm'] = isset($autho[0]) ? $autho[0] : '';
			$update['current_off_desig'] = isset($autho[1]) ? $autho[1] : '';
			$update['currently_with'] = isset($autho[2]) ? $autho[2] : '';
		}
		
		if($post['sec_off_remrk'] != ''){$update['sec_off_remrk'] = $post['sec_off_remrk'];}
		if($post['sec_off_nm'] != ''){$update['sec_off_nm'] = $post['sec_off_nm'];}
		if($post['sec_off_desig'] != ''){$update['sec_off_desig'] = $post['sec_off_desig'];}
		if($post['sec_off_dt'] != ''){$update['sec_off_dt'] = date('Y-m-d',strtotime($post['sec_off_dt']));}
		if($post['bo_remrk'] != ''){$update['bo_remrk'] = $post['bo_remrk'];}
		if($post['bo_nm'] != ''){$update['bo_nm'] = $post['bo_nm'];}
		if($post['bo_desig'] != ''){$update['bo_desig'] = $post['bo_desig'];}
		if($post['bo_dt'] != ''){$update['bo_dt'] = date('Y-m-d',strtotime($post['bo_dt']));}
		if($post['appli_status'] != ''){$update['appli_status'] = $post['appli_status'];}
		if($post['checker_nm'] != ''){$update['checker_nm'] = $post['checker_nm'];}
		if($post['checker_desig'] != ''){$update['checker_desig'] = $post['checker_desig'];}
		if($post['checker_dt'] != ''){$update['checker_dt'] = date('Y-m-d',strtotime($post['checker_dt']));}
		if($post['aao_name'] != ''){$update['aao_name'] = $post['aao_name'];}
		if($post['aao_desig'] != ''){$update['aao_desig'] = $post['aao_desig'];}
		if($post['aao_remrk'] != ''){$update['aao_remrk'] = $post['aao_remrk'];}
		if($post['aao_dt'] != ''){$update['aao_dt'] = date('Y-m-d',strtotime($post['aao_dt']));}
		if($post['sao_name'] != ''){$update['sao_name'] = $post['sao_name'];}
		if($post['sao_desig'] != ''){$update['sao_desig'] = $post['sao_desig'];}
		if($post['sao_remrk'] != ''){$update['sao_remrk'] = $post['sao_remrk'];}
		if($post['sao_dt'] != ''){$update['sao_dt'] = date('Y-m-d',strtotime($post['sao_dt']));}
		if($post['dag_name'] != ''){$update['dag_name'] = $post['dag_name'];}
		if($post['dag_desig'] != ''){$update['dag_desig'] = $post['dag_desig'];}
		if($post['dag_remrk'] != ''){$update['dag_remrk'] = $post['dag_remrk'];}
		if($post['dag_dt'] != ''){$update['dag_dt'] = date('Y-m-d',strtotime($post['dag_dt']));}
		if($post['pag_name'] != ''){$update['pag_name'] = $post['pag_name'];}
		if($post['pag_desig'] != ''){$update['pag_desig'] = $post['pag_desig'];}
		if($post['pag_remrk'] != ''){$update['pag_remrk'] = $post['pag_remrk'];}
		if($post['pag_dt'] != ''){$update['pag_dt'] = date('Y-m-d',strtotime($post['pag_dt']));}
		$update['update_dt'] = date('Y-m-d');
		
		if(!empty($update) && $id != ''){
			$this->db->where('bill_id',$id)->update('employee_bills',$update);
		}
	}
	
	public function get_empployee_exam_other_count(){	
		$yr = date('Y');
		$res = $this->db->select('count(*) exam_tot')
				 ->from('employee_exam_other')
				 ->where('exam_appli_yr',$yr)
			     ->get()
				 ->row_array();
		return $res;
	}
	public function get_emdbg_consu_slno(){	
		$res = $this->db->select('item_id')
			     ->from('emd_bg_consu')
				 ->order_by('itm_id','desc')
				 ->get()
				 ->row_array();
		return $res;
	}
	public function get_emdbg_budget_slno(){	
		$res = $this->db->select('sl_no')
			     ->from('emd_bg_budget')
				 ->order_by('ballot_id','desc')
				 ->get()
				 ->row_array();
		return $res;
	}
	public function get_emdbg_stk_slno(){	
		$res = $this->db->select('recd_id')
			     ->from('emd_bg_consu_stock')
				 ->order_by('stk_id','desc')
				 ->get()
				 ->row_array();
		return $res;
	}
	public function get_emdbg_issue_slno(){	
		$res = $this->db->select('red_id')
			     ->from('emd_bg_consu_issue')
				 ->order_by('iss_id','desc')
				 ->get()
				 ->row_array();
		return $res;
	}
	public function get_empployee_bill_count(){	
		$yr = date('Y');
		$res = $this->db->select('count(*) bill_tot')
				 ->from('employee_bills')
				 ->where('bill_year',$yr)
			     ->get()
				 ->row_array();
		return $res;
	}
	public function update_leave_mc_varification($id = ''){
		$post = $this->input->post(array('mc_varified','mc_varified_nm','mc_varified_desig','mc_varified_dt'), TRUE);
		
		$update = array();
		if($post['mc_varified'] != ''){$update['mc_varified'] = $post['mc_varified'];}
		if($post['mc_varified_nm'] != ''){$update['mc_varified_nm'] = $post['mc_varified_nm'];}
		if($post['mc_varified_desig'] != ''){$update['mc_varified_desig'] = $post['mc_varified_desig'];}
		if($post['mc_varified_dt'] != ''){$update['mc_varified_dt'] = date('Y-m-d',strtotime($post['mc_varified_dt']));}
		$update['update_dt'] = date('Y-m-d');
		
		if(!empty($update) && $id != ''){
			$this->db->where('leav_id',$id)->update('employee_leave_debit',$update);
		}
	}
	
	public function get_admin_charge_records($limit_to=0,$office = 'AGAE',$wing = 'administration'){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('section_charge_master')
				 ->where('group_nm','ADMINISTRATION')
				 ->order_by('chrg_id','asc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('section_nm',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function getChargeDescByID($id = 0){
		$res = $this->db->select('*')->from('section_charge_master')->where('chrg_id',$id)->get()->row_array();
		return $res;
	}
	public function addChargeToMaster($update_array=array()){
		if(empty($update_array)){return 0;} 
		$this->db->insert('section_charge_master',$update_array);
		return $this->db->insert_id();
	}
	public function updateChargeToMaster($id = 0, $update_array=array()){
		if(empty($update_array)){return $id;} 
		$this->db->where('chrg_id',$id)->update('section_charge_master',$update_array);
		return $id;
	}
	public function get_emp_section_index($empid = ''){
		$res = $this->db->select ('sect_idx')
						->from('employee_master')
						->where('empid',$empid)
						->get()
						->row_array();
		return $res;
	}
	public function get_section_charge_list($sect_idx = ''){
		$res = $this->db->select ('*')
						->from('section_charge_master')
						->where('sec_indx',$sect_idx)
						->order_by('chrg_id','asc')
						->get()
						->result_array();
		return $res;
	}
	public function update_charge_details_to_employee($emp_id,$chrg_id){		
		if(is_array($chrg_id)){
			$this->db->where('empid',$emp_id)->delete('section_charge_to_employee');
			foreach($chrg_id as $chrg_id=>$sec_indx){
				$this->db->insert('section_charge_to_employee',array('empid'=>$emp_id,'charge_id'=>$chrg_id,'sec_index'=>$sec_indx));
			}
		}
	}
	public function update_charge_allotment_status($id = '', $emp_id= ''){
		$post =  $this->input->post(array('status'), TRUE);
		$update = array();

		$update['status'] = 'Charge Allotted';
		$update['update_dt'] = date('Y-m-d H:i:s');
		
		if($id != ''){
			$this->db->where('sec_tnsf_id',$id)->where('emp_id',$emp_id)->update('section_transfer_details',$update);
		}
	}
	public function get_employee_charge_details($empid = ''){
		$res = $this->db->select('e.charge_id,m.charge_desc,')
						->from('section_charge_master m')
						->join('section_charge_to_employee e','e.charge_id = m.chrg_id','left')
						->where('e.empid',$empid)
						->order_by('charge_id','asc')
						->get()
						->result_array();
		return $res;
	}
/*
	public function postMessageBoxEmp($postData =''){
		$response = array();
		if(isset($postData['elist']) ){
			$this->db->select('*');
			$wherecond = "((empid like '%" . $postData['elist'] . "%') OR (empname like '%" . $postData['elist'] . "%'))";
			$this->db->where($wherecond);
			$this->db->where('da_cadare','0');
			$this->db->where('status','Active');
			$records = $this->db->get('employee_master')->result();
			foreach($records as $row ){
				$response[] = array("value"=>$row->empid,"label"=>$row->empname);
			}
		}
		return $response;
	}
*/	
	public function getMessageBoxEmp($postData = ''){
		$response = array();
		if(isset($postData['elist']) ){
			$this->db->select('*');
				$wherecond = "((empid like '%" . $postData['elist'] . "%') OR (empname like '%" . $postData['elist'] . "%'))";
				$this->db->where($wherecond);
				$this->db->where('da_cadare','0');
				$this->db->where('status','Active');
				$records = $this->db->get('employee_master')->result();
				foreach($records as $row ){
					$response[] = array("value"=>$row->empid,"label"=>$row->empname);
				}
		}
		return $response;
	}
		
	public function box_employee_list($postData = '' ){
		$results =  $this->db->select('e.empid,e.empname,')
				->from('employee_master e')
				->where('e.office_code','AGAE')
				->where('e.da_cadare','0')
				->where('e.status','Active')
				->like('e.empname',$postData);
		$results = $this->db->order_by('e.empname','asc')
				->get()
				->result_array();
		return $results;
	}

	public function add_foreign_visit_record(){
		$post =  $this->input->post(array('empid','emp_name','emp_desig','f_country','visit_fm','visit_to','visit_purpose','est_expnd','source_fnd','emp_rmk','upload_dt'), TRUE);
	
		$post['visit_fm'] = !empty($post['visit_fm']) ? date('Y-m-d',strtotime($post['visit_fm'])) : '';
		$post['visit_to'] = !empty($post['visit_to']) ? date('Y-m-d',strtotime($post['visit_to'])) : '';
		$post['upload_dt'] = date('Y-m-d H:i:s');
		
		$this->db->insert('employee_foreign_visit',$post);
		return true;
	}
	public function get_foreign_visit_record($empid = '', $id = 0){
		$res = $this->db->select('*')
						->from('employee_foreign_visit')
						->where('empid',$empid)
						->where('visit_id',$id)
						->get()
						->row_array();
		return $res;
	} 
	public function update_foreign_visit_record($id=0, $empid='' ){
		$post =  $this->input->post(array('emp_name','emp_desig','f_country','visit_fm','visit_to','visit_purpose','est_expnd','source_fnd','emp_rmk','upload_dt'), TRUE);
		$update = array();
		$update['emp_name'] = $post['emp_name'];
		$update['emp_desig'] = $post['emp_desig'];
		$update['f_country'] = $post['f_country'];
		$update['visit_fm'] = !empty($post['visit_fm']) ? date('Y-m-d',strtotime($post['visit_fm'])) : '';
		$update['visit_to'] = !empty($post['visit_to']) ? date('Y-m-d',strtotime($post['visit_to'])) : '';
		$update['visit_purpose'] = $post['visit_purpose'];
		$update['est_expnd'] = $post['est_expnd'];
		$update['source_fnd'] = $post['source_fnd'];
		$update['emp_rmk'] = $post['emp_rmk'];
		$update['update_dt'] = date('Y-m-d');

		if(!empty($update) && $id != ''){
			$this->db->where('empid',$empid)->where('visit_id',$id)->update('employee_foreign_visit',$update);
		}
	}
	public function foreign_vigit_details($empid = ''){
		$res = $this->db->select('*')
						->from('employee_foreign_visit')
						->where('empid',$empid)
						->get()
						->result_array();
		return $res;
	}
	public function get_passport_appli_count(){	
		$yr = date('Y');
		$res = $this->db->select('count(*) pass_tot')
				 ->from('employee_passport')
				 ->where('pappli_yr',$yr)
			     ->get()
				 ->row_array();
		return $res;
	} 
	public function add_passport_application($sl_no = '', $empid = ''){
		$post =  $this->input->post(array('empid','name','f_name','m_name','res_address','dob','desig','emp_section','group_nm','office_nm','emp_type','doj','basic_pay','mbno','id_card_no',
		'v_card_no','adh_card_no','passport_no','pexpiry_dt','psl_no','pappli_yr','reason_pp','period_visit','visit_dt','days_leave','leave_from','leave_to','visit_addr','pass_ren_visa','source_fund',
		'pass_visa_for','cash_doc','discipl_action','pre_visit','attachment','appli_status','appli_date','upload_dt','sec_off_nm'), TRUE);
		
		$autho = explode('@@@',$post['sec_off_nm']);
		if(count($autho) == 3){
			$post['sec_off_nm'] = isset($autho[0]) ? $autho[0] : '';
			$post['sec_off_desig'] = isset($autho[1]) ? $autho[1] : '';
			$post['current_off_nm'] = $post['sec_off_nm'];
			$post['current_off_desig'] = $post['sec_off_desig'];
			$post['currently_with'] = isset($autho[2]) ? $autho[2] : '';
		}
		
		if($post['pass_ren_visa'] == 'VISA'){
			$post['pass_visa_for'] = 'Self';
		}
		
		$post['psl_no'] = $sl_no;
		$post['dob'] = !empty($post['dob']) ? date('Y-m-d',strtotime($post['dob'])) : '';
		$post['doj'] = !empty($post['doj']) ? date('Y-m-d',strtotime($post['doj'])) : '';
		$post['pexpiry_dt'] = !empty($post['pexpiry_dt']) ? date('Y-m-d',strtotime($post['pexpiry_dt'])) : '0000-00-00';
		$post['visit_dt'] = !empty($post['visit_dt']) ? date('Y-m-d',strtotime($post['visit_dt'])) : '0000-00-00';
		$post['leave_from'] = !empty($post['leave_from']) ? date('Y-m-d',strtotime($post['leave_from'])) : '0000-00-00';
		$post['leave_to'] = !empty($post['leave_to']) ? date('Y-m-d',strtotime($post['leave_to'])) : '0000-00-00';
		$post['pappli_yr'] = date('Y');
		$post['appli_status'] = 'Submitted';
		$post['appl_flag'] = 'S';
		$post['appli_date'] = date('Y-m-d');
		$post['upload_dt'] = date('Y-m-d H:i:s');
		
		$id = $this->db->insert('employee_passport',$post);
		return $this->db->insert_id();
	}
	
	public function get_passport_application_ById($empid = '', $id = 0){
		$res = $this->db->select('*')
						->from('employee_passport')
						->where('empid',$empid)
						->where('pappl_id',$id)
						->get()
						->row_array();
		return $res;
	} 
	public function get_emp_passport_application_ByYr($empid = ''){
		$yr = date('Y');
		$res = $this->db->select('count(*) pass_appli_tot')
				 ->from('employee_passport')
				 ->where('empid',$empid)
				 ->where('pappli_yr',$yr)
				 ->group_start()
				 ->where('pass_ren_visa','Passport')
				 ->or_where('pass_ren_visa','Passport Renewal')
				 ->group_end()
			     ->get()
				 ->row_array();
		return $res;
	} 
	public function get_emp_visa_application_ByYr($empid = ''){
		$yr = date('Y');
		$res = $this->db->select('count(*) visa_appli_tot')
				 ->from('employee_passport')
				 ->where('empid',$empid)
				 ->where('pass_ren_visa','VISA')
				 ->where('pappli_yr',$yr)
			     ->get()
				 ->row_array();
		return $res;
	} 
	public function update_passport_application($id = '', $empid = ''){
		$post =  $this->input->post(array('empid','name','f_name','m_name','res_address','dob','desig','emp_section','group_nm','office_nm','emp_type','doj','basic_pay','mbno','id_card_no',
		'v_card_no','adh_card_no','passport_no','pexpiry_dt','psl_no','pappli_yr','reason_pp','period_visit','visit_dt','days_leave','leave_from','leave_to','visit_addr','pass_ren_visa','source_fund',
		'pass_visa_for','cash_doc','discipl_action','pre_visit','attachment','appli_status','appli_date','upload_dt','sec_off_nm'), TRUE);
		
		$update = array();
		
		$autho = explode('@@@',$post['sec_off_nm']);
		if(count($autho) == 3){
			$update['sec_off_nm'] = isset($autho[0]) ? $autho[0] : '';
			$update['sec_off_desig'] = isset($autho[1]) ? $autho[1] : '';
			$update['current_off_nm'] = $update['sec_off_nm'];
			$update['current_off_desig'] = $update['sec_off_desig'];
			$update['currently_with'] = isset($autho[2]) ? $autho[2] : '';
		}
		
		if(!empty($post['f_name'])){$update['f_name'] =  $post['f_name'];}
		if(!empty($post['m_name'])){$update['m_name'] =  $post['m_name'];}
		if(!empty($post['res_address'])){$update['res_address'] =  $post['res_address'];}
		if(!empty($post['desig'])){$update['desig'] =  $post['desig'];}
		if(!empty($post['emp_section'])){$update['emp_section'] =  $post['emp_section'];}
		if(!empty($post['group_nm'])){$update['group_nm'] =  $post['group_nm'];}
		if(!empty($post['emp_type'])){$update['emp_type'] =  $post['emp_type'];}
		if(!empty($post['doj'])){$update['doj'] =  date('Y-m-d',strtotime($post['doj']));}
		if(!empty($post['basic_pay'])){$update['basic_pay'] =  $post['basic_pay'];}
		if(!empty($post['id_card_no'])){$update['id_card_no'] =  $post['id_card_no'];}
		if(!empty($post['v_card_no'])){$update['v_card_no'] =  $post['v_card_no'];}
		if(!empty($post['adh_card_no'])){$update['adh_card_no'] =  $post['adh_card_no'];}
		if(!empty($post['passport_no'])){$update['passport_no'] =  $post['passport_no'];}
		$update['pexpiry_dt'] = $post['pexpiry_dt'] !='00-00-0000' ? date('Y-m-d',strtotime($post['pexpiry_dt'])) : '0000-00-00';
		if(!empty($post['reason_pp'])){$update['reason_pp'] =  $post['reason_pp'];}
		if(!empty($post['period_visit'])){$update['period_visit'] =  $post['period_visit'];}
		if(!empty($post['visit_dt'])){$update['visit_dt'] =  date('Y-m-d',strtotime($post['visit_dt']));}
		$update['visit_dt'] = $post['visit_dt'] !='00-00-0000' ? date('Y-m-d',strtotime($post['visit_dt'])) : '0000-00-00';
		if(!empty($post['visit_addr'])){$update['visit_addr'] =  $post['visit_addr'];}
		If(!empty($post['days_leave'])){$update['days_leave'] =  $post['days_leave'];}
		if(!empty($post['leave_from'])){$update['leave_from'] =  date('Y-m-d',strtotime($post['leave_from']));}
		if(!empty($post['leave_to'])){$update['leave_to'] =  date('Y-m-d',strtotime($post['leave_to']));}
		$update['leave_from'] = $post['leave_from'] !='00-00-0000' ? date('Y-m-d',strtotime($post['leave_from'])) : '0000-00-00';
		$update['leave_to'] = $post['leave_to'] !='00-00-0000' ? date('Y-m-d',strtotime($post['leave_to'])) : '0000-00-00';
		if(!empty($post['pass_ren_visa'])){$update['pass_ren_visa'] =  $post['pass_ren_visa'];}
		if(!empty($post['source_fund'])){$update['source_fund'] =  $post['source_fund'];}
		if($post['pass_ren_visa'] == 'VISA'){
			$update['pass_visa_for'] = 'Self';
		}else{
			$update['pass_visa_for'] = $post['pass_visa_for'];
		}
		if(!empty($post['attachment'])){$update['attachment'] =  $post['attachment'];}
		if(!empty($post['cash_doc'])){$update['cash_doc'] =  $post['cash_doc'];}
		if(!empty($post['discipl_action'])){$update['discipl_action'] =  $post['discipl_action'];}
		if(!empty($post['pre_visit'])){$update['pre_visit'] =  $post['pre_visit'];}

		$update['appli_status'] = 'Submitted';
		$update['appl_flag'] = 'S';
		$update['appli_date'] = date('Y-m-d');

		if(!empty($update) && $id != ''){
			$this->db->where('empid',$empid)->where('pappl_id',$id)->update('employee_passport',$update);
		}
	}
	
	public function add_pp_minor_employee($id, $empid, $minor_name){
		if(is_array($minor_name)){
			foreach($minor_name as $minor_id=>$minor_name){
				$res = $this->db->select('*')
						 ->from('employee_family')
						 ->where('family_member_id',$minor_id)
						 ->get()
						 ->row_array();
				if(empty($res)){
					return array($res);
				} 
				$this->db->where('pp_appli_id',$id)->where('empid',$empid)->delete('employee_passport_minor');
				$this->db->insert('employee_passport_minor',array('pp_appli_id'=>$id,'empid'=>$empid,'family_memb_id'=>$minor_id,'minor_name'=>$minor_name,'minor_dob'=>$res['member_dob'],'minor_pbrith'=>$res['member_bplace']));
			}
		}
	}
	public function get_application_passport_recom(){
		$res = $this->db->select('*')
						->from('employee_passport ld')
						->like('ld.appl_flag','S')
						->order_by('appli_date','desc')
						->get()
						->result_array();
		return $res;
	}
	public function get_application_passport_process_all(){
		$res = $this->db->select('*')
						->from('employee_passport ld')
						->like('ld.appl_flag','R')
						->or_like('ld.appl_flag','A')
						->order_by('appli_date','desc')
						->get()
						->result_array();
		return $res;
	}
	public function get_application_pending_pr($empid = ''){
		$res = $this->db->select('*')
						->from('employee_passport ld')
						->where('ld.currently_with',$empid)
						->group_start()
						->where('ld.appl_flag', 'S')
						->or_where('ld.appl_flag', 'F')
						->group_end()
						->order_by('appli_date','asc')
						->get()
						->result_array();
		return $res;
	}
	
	public function get_application_pending_pp($empid = ''){
		$res = $this->db->select('*')
						->from('employee_passport ld')
						->where('ld.currently_with',$empid)
						->where('ld.appl_flag', 'R')
						->order_by('appli_date','asc')
						->get()
						->result_array();
		return $res;
	}
	public function get_application_pending_apro($empid = ''){
		$res = $this->db->select('*')
						->from('employee_passport ld')
						->where('ld.currently_with',$empid)
						->where('ld.appl_flag', 'A')
						->order_by('appli_date','asc')
						->get()
						->result_array();
		return $res;
	}
	public function get_application_pp_update($id){
		$res = $this->db->select('*')
						->from('employee_passport')
						->group_start()
						->where('appl_flag','S')
						->or_where('appl_flag', 'F')
						->group_end()
						->where('pappl_id',$id)
						->get()
						->row_array();
		return $res;
	} 
	public function get_application_pp_process($id){
		$res = $this->db->select('*')
						->from('employee_passport')
						->group_start()
						->where('appl_flag','A')
						->or_where('appl_flag','R')
						->group_end()
						->where('pappl_id',$id)
						->get()
						->row_array();
		return $res;
	} 
	public function get_passport_application_info($empid = ''){
		$res = $this->db->select('*')
						->from('employee_passport ld')
						->where('ld.empid',$empid)
						->order_by('appli_date','desc')
						->get()
						->result_array();
		return $res;
	}
	public function get_passport_for_minors($id){
		$res = $this->db->select('*')
						->from('employee_passport_minor ld')
						->where('ld.pp_appli_id',$id)
//						->where('ld.empid',$empid)
						->order_by('minor_name','asc')
						->get()
						->result_array();
		return $res;
	}
	public function update_employee_pp_record($id = ''){
		$post = $this->input->post(array('id_card_no','reason_pp','source_fund','period_visit','visit_dt','visit_addr','sec_off_remrk','sec_off_nm','sec_off_desig','sec_off_dt','bo_remrk','bo_nm','bo_desig','bo_dt','dag_remk_rev','dag_name_rev','dag_desig_rev','dag_dt_rev',
		'reccomendation','appli_status','appl_flag','dealing_remrk','draft_attachment','checker_nm','checker_desig','checker_dt','aao_name_dicip','aao_desig_dicip','aao_dt_dicip','aao_remrk_dicip','aao_name','aao_desig','aao_remrk','aao_dt','sao_name','sao_desig','sao_remrk','sao_dt',
		'dag_name','dag_desig','dag_remrk','dag_dt','pag_name','pag_desig','pag_remrk','pag_dt','reason_rec_seclt','recom_autho','currently_with','current_off_nm','current_off_desig'), TRUE);
		

		$update = array();
		
		if($post['id_card_no'] != ''){$update['id_card_no'] = $post['id_card_no'];}
		if($post['reason_pp'] != ''){$update['reason_pp'] = $post['reason_pp'];}
		if($post['source_fund'] != ''){$update['source_fund'] = $post['source_fund'];}
		if($post['period_visit'] != ''){$update['period_visit'] = $post['period_visit'];}
		if($post['visit_dt'] != ''){$update['visit_dt'] = date('Y-m-d',strtotime($post['visit_dt']));}
		if($post['visit_addr'] != ''){$update['visit_addr'] = $post['visit_addr'];}
		
		$autho = explode('@@@',$post['recom_autho']);
		if(count($autho) == 3){
			$update['current_off_nm'] = isset($autho[0]) ? $autho[0] : '';
			$update['current_off_desig'] = isset($autho[1]) ? $autho[1] : '';
			$update['currently_with'] = isset($autho[2]) ? $autho[2] : '';
		}
		
		if($post['sec_off_remrk'] != ''){$update['sec_off_remrk'] = $post['sec_off_remrk'];}
		if($post['sec_off_nm'] != ''){$update['sec_off_nm'] = $post['sec_off_nm'];}
		if($post['sec_off_desig'] != ''){$update['sec_off_desig'] = $post['sec_off_desig'];}
		if($post['sec_off_dt'] != ''){$update['sec_off_dt'] = date('Y-m-d',strtotime($post['sec_off_dt']));}
		if($post['bo_remrk'] != ''){$update['bo_remrk'] = $post['bo_remrk'];}
		if($post['bo_nm'] != ''){$update['bo_nm'] = $post['bo_nm'];}
		if($post['bo_desig'] != ''){$update['bo_desig'] = $post['bo_desig'];}
		if($post['bo_dt'] != ''){$update['bo_dt'] = date('Y-m-d',strtotime($post['bo_dt']));}
		if($post['dag_remk_rev'] != ''){$update['dag_remk_rev'] = $post['dag_remk_rev'];}
		if($post['dag_name_rev'] != ''){$update['dag_name_rev'] = $post['dag_name_rev'];}
		if($post['dag_desig_rev'] != ''){$update['dag_desig_rev'] = $post['dag_desig_rev'];}
		if($post['dag_dt_rev'] != ''){$update['dag_dt_rev'] = date('Y-m-d',strtotime($post['dag_dt_rev']));}
		if($post['reccomendation'] != ''){$update['reccomendation'] = $post['reccomendation'];}		
		if($post['reason_rec_seclt'] != ''){$update['reason_rec_seclt'] = $post['reason_rec_seclt'];}
		if($post['appli_status'] != ''){$update['appli_status'] = $post['appli_status'];}
		if($post['appli_status'] == 'Returned'){$update['appl_flag'] = 'S';}
		if($post['appli_status'] == 'Forwarded'){$update['appl_flag'] = 'F';}
		if($post['appli_status'] == 'Recommended'){$update['appl_flag'] = 'R';}
		if($post['appli_status'] == 'Under Process'){$update['appl_flag'] = 'A';}
		if($post['dealing_remrk'] != ''){$update['dealing_remrk'] = $post['dealing_remrk'];}
		if($post['draft_attachment'] != ''){$update['draft_attachment'] = $post['draft_attachment'];}
		if($post['checker_nm'] != ''){$update['checker_nm'] = $post['checker_nm'];}
		if($post['checker_desig'] != ''){$update['checker_desig'] = $post['checker_desig'];}
		if($post['checker_dt'] != ''){$update['checker_dt'] = date('Y-m-d',strtotime($post['checker_dt']));}
		if($post['aao_name_dicip'] != ''){$update['aao_name_dicip'] = $post['aao_name_dicip'];}
		if($post['aao_desig_dicip'] != ''){$update['aao_desig_dicip'] = $post['aao_desig_dicip'];}
		if($post['aao_remrk_dicip'] != ''){$update['aao_remrk_dicip'] = $post['aao_remrk_dicip'];}
		if($post['aao_dt_dicip'] != ''){$update['aao_dt_dicip'] = date('Y-m-d',strtotime($post['aao_dt_dicip']));}
		if($post['aao_name'] != ''){$update['aao_name'] = $post['aao_name'];}
		if($post['aao_desig'] != ''){$update['aao_desig'] = $post['aao_desig'];}
		if($post['aao_remrk'] != ''){$update['aao_remrk'] = $post['aao_remrk'];}
		if($post['aao_dt'] != ''){$update['aao_dt'] = date('Y-m-d',strtotime($post['aao_dt']));}
		if($post['sao_name'] != ''){$update['sao_name'] = $post['sao_name'];}
		if($post['sao_desig'] != ''){$update['sao_desig'] = $post['sao_desig'];}
		if($post['sao_remrk'] != ''){$update['sao_remrk'] = $post['sao_remrk'];}
		if($post['sao_dt'] != ''){$update['sao_dt'] = date('Y-m-d',strtotime($post['sao_dt']));}
		if($post['dag_name'] != ''){$update['dag_name'] = $post['dag_name'];}
		if($post['dag_desig'] != ''){$update['dag_desig'] = $post['dag_desig'];}
		if($post['dag_remrk'] != ''){$update['dag_remrk'] = $post['dag_remrk'];}
		if($post['dag_dt'] != ''){$update['dag_dt'] = date('Y-m-d',strtotime($post['dag_dt']));}
		if($post['pag_name'] != ''){$update['pag_name'] = $post['pag_name'];}
		if($post['pag_desig'] != ''){$update['pag_desig'] = $post['pag_desig'];}
		if($post['pag_remrk'] != ''){$update['pag_remrk'] = $post['pag_remrk'];}
		if($post['pag_dt'] != ''){$update['pag_dt'] = date('Y-m-d',strtotime($post['pag_dt']));}
		$update['update_dt'] = date('Y-m-d');
		
		if(!empty($update) && $id != ''){
			print_r($update);
			$this->db->where('pappl_id',$id)->update('employee_passport',$update);
		}
	}
	
	public function get_application_passport_list($limit_to = 0 ){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('employee_passport')
				 ->where ('appli_status !=','Cancelled')
				 ->order_by('appli_date','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->or_like('appli_date',$get['search']);
				$this->db->or_like('empid ',$get['search']);
				$this->db->or_like('name',$get['search']);
			$this->db->group_end();
		}
		$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	} 
	public function get_application_passport_list_edit($id = ''){
		$res = $this->db->select('*')
						->from('employee_passport')
						->where('pappl_id',$id)
						->get()
						->row_array();
		return $res;
	}
	public function update_application_passport_status($id = 0 ){
		$application = $this->input->post(array('empid','name','desig','appli_status','emp_pan'), TRUE);

		$update = array();
		if($application['appli_status'] != ''){$update['appli_status'] = $application['appli_status'];}
		if($application['appli_status'] == 'Recommended'){$update['appl_flag'] = 'R';}
		if($application['appli_status'] == 'Forwarded'){$update['appl_flag'] = 'S';}
		if(!empty($application['emp_pan'])){
			$emp = explode('@@@',$application['emp_pan']);
			$update['current_off_nm'] = isset($emp[0]) ? $emp[0] : '';
			$update['current_off_desig'] = isset($emp[1]) ? $emp[1] : '';
			$update['currently_with'] = isset($emp[2]) ? $emp[2] : '';
		}else{
			if($application['appli_status'] == 'Returned'){$update['currently_with'] = $application['empid'];}
			if($application['appli_status'] == 'Returned'){$update['current_off_nm'] = $application['name'];}
			if($application['appli_status'] == 'Returned'){$update['current_off_desig'] = $application['desig'];}
			$update['appl_flag'] = 'S';
		}
		if(!empty($update) && $id != ''){
			$this->db->where('pappl_id',$id)->update('employee_passport',$update);
		}
	} 
	public function getApplicationPassportByID($id = 0 ){
		$res = $this->db->select('*')->from('employee_passport')->where('pappl_id',$id)->get()->row_array();
		return $res;
	}
	public function deleteApplicationPassportByID($id = 0){
		$this->db->where('pappl_id',$id)->delete('employee_passport');
	}
	public function all_passport_applications_download(){
		$post = $this->input->post(array('date_from','date_to', 'pappli_yr'), TRUE);
		$res = $this->db->select('pa.*')
						->from('employee_passport pa')
						->where('pa.appli_status =','Submitted');
//						->where('e.office_code',$office);
		if($post['date_from'] != ''){
			$f_date = date('Y-m-d',strtotime($post['date_from']));
			$this->db->where('date(pa.appli_date) >= ',$f_date);
		}
		if($post['date_to'] != ''){
			$t_date = date('Y-m-d',strtotime($post['date_to']));
			$this->db->where('date(pa.appli_date) <= ',$t_date);
		}
		if($post['pappli_yr'] != ''){
			$this->db->where('pa.pappli_yr',$post['pappli_yr']);
		}			
		$res = $this->db->order_by('pa.appli_date','asc')
						->get()
						->result_array();
		return $res;
	}
	public function family_member_minor_passport($id = ''){
		$res = $this->db->select('*')
						->from('employee_passport_minor')
						->where('pp_appli_id',$id)
						->get()
						->result_array();
		return $res;
	}
	public function foreing_visit_future_records($empid = ''){
		$date = date('Y-m-d');
		$res = $this->db->select('*')
						->from('employee_foreign_visit')
						->where('empid',$empid)
						->where('date(visit_fm) >=',$date)
						->get()
						->result_array();
		return $res;
	}
	public function foreing_visit_fouryr_records($empid = ''){
		$date = date('Y-m-d', strtotime('-4 years'));
		$date1 = date('Y-m-d');
		$res = $this->db->select('*')
						->from('employee_foreign_visit')
						->where('empid',$empid)
						->where('date(visit_fm) >=',$date)
						->where('date(visit_fm) <=',$date1)
						->get()
						->result_array();
		return $res;
	}
	public function all_feedback_view($limit_to=0){
		$get = $this->input->get(array('search','visit_for'), TRUE);
		$this->db->select('*')
				 ->from('feedback')
				 ->where('status','Active')
				 ->order_by('feed_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('feed_id',$get['search']);
				$this->db->or_like('mobile',$get['search']);
			$this->db->group_end();
		}
		if($get['visit_for'] != ''){
			$this->db->group_start();
				$this->db->like('visit_for',$get['visit_for']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function all_feedback_monitor($limit_to=0){
		$get = $this->input->get(array('search','visit_for'), TRUE);
		$this->db->select('*')
				 ->from('feedback')
				  ->where('g_flag','F')
				 ->where('status','Process')
				 ->order_by('feed_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('feed_id',$get['search']);
				$this->db->or_like('mobile',$get['search']);
			$this->db->group_end();
		}
		if($get['visit_for'] != ''){
			$this->db->group_start();
				$this->db->like('visit_for',$get['visit_for']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function all_grievance_monitor($limit_to=0){
		$get = $this->input->get(array('search','visit_for'), TRUE);
		$this->db->select('*')
				 ->from('feedback')
				 ->where('g_flag','G')
				 ->where('status','Process')
				 ->order_by('feed_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('feed_id',$get['search']);
				$this->db->or_like('mobile',$get['search']);
			$this->db->group_end();
		}
		if($get['visit_for'] != ''){
			$this->db->group_start();
				$this->db->like('visit_for',$get['visit_for']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function FeedbackFilterByID($id){
		$update['status'] = 'Process';
		$this->db->where('feed_id',$id)->update('feedback',$update);
	}
	public function FeedbackClosedByID($id){
		$update['status'] = 'Close';
		$this->db->where('feed_id',$id)->update('feedback',$update);
	}
	public function update_dag_feedback_action($id=0){
		$post = $this->input->post(array('administration','administration_action_required','administration_action_taken','accounts','accounts_action_required','accounts_action_taken','fund','fund_action_required','fund_action_taken','pension','pension_action_required','pension_action_taken','status','dag_name','dag_desig','dag_dt'), TRUE);
		$update = array();
		if($post['administration'] != ''){
			$update['administration'] = $post['administration'];
		}
		$update['administration_action_required'] = $post['administration_action_required'];
		$update['administration_action_taken'] = $post['administration_action_taken'];
		if($post['accounts'] != ''){
			$update['accounts'] = $post['accounts'];
		}
		$update['accounts_action_required'] = $post['accounts_action_required'];
		$update['accounts_action_taken'] = $post['accounts_action_taken'];
		if($post['fund'] != ''){
			$update['fund'] = $post['fund'];
		}
		$update['fund_action_required'] = $post['fund_action_required'];
		$update['fund_action_taken'] = $post['fund_action_taken'];
		if($post['pension'] != ''){
			$update['pension'] = $post['pension'];
		}
		$update['pension_action_required'] = $post['pension_action_required'];
		$update['pension_action_taken'] = $post['pension_action_taken'];
		$update['status'] = $post['status'];
		$update['dag_name'] = $post['dag_name'];
		$update['dag_desig'] = $post['dag_desig'];
		$update['dag_dt'] = date('Y-m-d');
		
		if(!empty($update) && $id != ''){
			$this->db->where('feed_id',$id)->update('feedback',$update);
		}
	}
	
	public function add_new_grievance(){
		$post =  $this->input->post(array('feed_date','name','email','mobile','visit_for','ppo_no_file_id_application_no','gpf_no','office','details','eoffice_rpt_no','eoffice_file_no','eoffice_rpt_dt','section','charge','pagsec_no','pagsec_dt','dagsec_no','dagsec_dt','g_flag','status','griv_cat','due_date','gr_entry_date','administration_action_required','fund_action_required','fund_action_required','pension_action_required'), TRUE);
	
		$post['feed_date'] = !empty($post['feed_date']) ? date('Y-m-d',strtotime($post['feed_date'])) : '';
		$post['eoffice_rpt_dt'] = !empty($post['eoffice_rpt_dt']) ? date('Y-m-d',strtotime($post['eoffice_rpt_dt'])) : '';
		$post['due_date'] = !empty($post['due_date']) ? date('Y-m-d',strtotime($post['due_date'])) : '';
		$post['pagsec_dt'] = !empty($post['pagsec_dt']) ? date('Y-m-d',strtotime($post['pagsec_dt'])) : '';
		$post['dagsec_dt'] = !empty($post['dagsec_dt']) ? date('Y-m-d',strtotime($post['dagsec_dt'])) : '';
		$post['g_flag'] = 'G';
		$post['status'] = 'Process';
		$post['gr_entry_date'] = date('Y-m-d H:i:s');

		if( $this->input->post('visit_for') =='General' || 'visit_for'=='Administrative'){
			$post['administration'] = 'Yes';
		}
		if($this->input->post('visit_for') =='Accounts'){
			$post['accounts'] = 'Yes';
		}
		if($this->input->post('visit_for')=='Provident Fund'){
			$post['fund'] = 'Yes';
		}
		if($this->input->post('visit_for')=='Pension'){
			$post['pension'] = 'Yes';
		}
		$this->db->insert('feedback',$post);
		return true;
	}
	public function update_new_grievance($id= ''){
		$post =  $this->input->post(array('feed_date','name','email','mobile','visit_for','ppo_no_file_id_application_no','gpf_no','office','details','eoffice_rpt_no','eoffice_file_no','eoffice_rpt_dt','section','charge','pagsec_no','pagsec_dt','dagsec_no','dagsec_dt','g_flag','status'), TRUE);
		$update = array();
		
		$update['feed_date'] = !empty($post['feed_date']) ? date('Y-m-d',strtotime($post['feed_date'])) : '';
		$update['name'] = $post['name'];
		$update['email'] = $post['email'];
		$update['mobile'] = $post['mobile'];
		$update['visit_for'] = $post['visit_for'];
		$update['ppo_no_file_id_application_no'] = $post['ppo_no_file_id_application_no'];
		$update['gpf_no'] = $post['gpf_no'];
		$update['office'] = $post['office'];
		$update['details'] = $post['details'];
		$update['eoffice_rpt_no'] = $post['eoffice_rpt_no'];
		$update['eoffice_file_no'] = $post['eoffice_file_no'];
		$update['eoffice_rpt_dt'] = !empty($post['eoffice_rpt_dt']) ? date('Y-m-d',strtotime($post['eoffice_rpt_dt'])) : '';
		$update['section'] = $post['section'];
		$update['charge'] = $post['charge'];
		$update['pagsec_no'] = $post['pagsec_no'];
		$update['pagsec_dt'] = !empty($post['pagsec_dt']) ? date('Y-m-d',strtotime($post['pagsec_dt'])) : '';
		$update['dagsec_no'] = $post['dagsec_no'];
		$update['dagsec_dt'] = !empty($post['dagsec_dt']) ? date('Y-m-d',strtotime($post['dagsec_dt'])) : '';
		$update['g_flag'] = 'G';
		$update['status'] = 'Active';

		if(!empty($update) && $id != ''){
			$this->db->where('feed_id',$id)->update('feedback',$update);
		}
	}
	public function get_invoice_all($limit_to = 0 ){
		$get = $this->input->get(array('date_from', 'date_to','budget_cat','fin_year','invsl_no', 'search'), TRUE);
		$this->db->select('*')
						->from('emd_bg_invoice_details')
						->where('recd_type','OTH')
//						->where('fin_yr','2013-2014')
						->order_by('fin_yr','desc')
						->order_by('invoice_id','desc');
						
		if($get['date_from'] != ''){
			$f_date = date('Y-m-d',strtotime($get['date_from']));
			$this->db->where('date(entry_dt) >= ',$f_date);
		}
		if($get['date_to'] != ''){
			$t_date = date('Y-m-d',strtotime($get['date_to']));
			$this->db->where('date(entry_dt) <= ',$t_date);
		}
		if($get['budget_cat'] != ''){
			$this->db->like('budg_cat',$get['budget_cat']);
		}
		if($get['fin_year'] != ''){
			$this->db->like('fin_yr',$get['fin_year']);
		}
		if($get['invsl_no'] != ''){
			$this->db->where('invsl_no',$get['invsl_no']);
		}
		if($get['search'] != ''){
			$this->db->like('bill_amt',$get['search'])
					 ->or_like('inv_no',$get['search'])
					 ->or_like('status',$get['search']);
		}
		
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}	
	public function get_proc_reg($limit_to = 0 ){
		$get = $this->input->get(array('date_from', 'date_to', 'vendor_nm','emd_bg_no', 'search'), TRUE);
		$this->db->select('*')
						->from('emd_bg_register ot')
						->where('bill_type','OT')
						->order_by('emdbg_rid','desc');
						
		if($get['date_from'] != ''){
			$f_date = date('Y-m-d',strtotime($get['date_from']));
			$this->db->where('date(bill_dt) >= ',$f_date);
		}
		if($get['date_to'] != ''){
			$t_date = date('Y-m-d',strtotime($get['date_to']));
			$this->db->where('date(bill_dt) <= ',$t_date);
		}
		if($get['vendor_nm'] != ''){
			$this->db->like('vendor_name',$get['vendor_nm']);
		}
		if($get['emd_bg_no'] != ''){
			$this->db->like('emd_bg_no',$get['emd_bg_no']);
		}
		if($get['search'] != ''){
			$this->db->like('dd_no',$get['search'])
					 ->or_like('bill_no',$get['search'])
					 ->or_like('amount',$get['search']);
		}
		
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_emdbg_all($limit_to = 0 ){
		$get = $this->input->get(array('date_from', 'date_to', 'vendor_nm','emdbg_type','sl_no', 'search'), TRUE);
		$this->db->select('*')
						->from('emd_bg_details ot')
						->order_by('entry_dt','desc');
						
		if($get['date_from'] != ''){
			$f_date = date('Y-m-d',strtotime($get['date_from']));
			$this->db->where('date(entry_dt) >= ',$f_date);
		}
		if($get['date_to'] != ''){
			$t_date = date('Y-m-d',strtotime($get['date_to']));
			$this->db->where('date(entry_dt) <= ',$t_date);
		}
		if($get['vendor_nm'] != ''){
			$this->db->like('vend_nm',$get['vendor_nm']);
		}
		if($get['emdbg_type'] != ''){
			$this->db->like('emdbg_type',$get['emdbg_type']);
		}
		if($get['sl_no'] != ''){
			$this->db->where('sl_no',$get['sl_no']);
		}
		if($get['search'] != ''){
			$this->db->like('bank_nm',$get['search'])
					 ->or_like('dd_cq_no',$get['search'])
					 ->or_like('status',$get['search']);
		}
		
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_emdbg_consu($limit_to = 0 ){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
						->from('emd_bg_consu')
						->where('item_for !=','SOFTWARE')
						->order_by('itm_id','desc');
						
		if($get['search'] != ''){
			$this->db->group_start()
					 ->like('item_cat',$get['search'])
					 ->or_like('item_for',$get['search'])
					 ->or_like('item_desc',$get['search'])
					 ->or_like('remk',$get['search'])
					 ->group_end();
		}
		
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_emdbg_soft($limit_to = 0 ){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
						->from('emd_bg_consu')
						->where('item_for','SOFTWARE')
						->order_by('itm_id','asc');
						
		if($get['search'] != ''){
			$this->db->group_start()
					 ->like('item_cat',$get['search'])
					 ->or_like('item_for',$get['search'])
					 ->or_like('item_desc',$get['search'])
					 ->or_like('media_type',$get['search'])		 
					 ->or_like('remk',$get['search'])
					 ->group_end();
		}
		
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_emdbg_stock($limit_to = 0 ){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
						->from('emd_bg_consu_stock')
						->order_by('stk_id','desc');
						
		if($get['search'] != ''){
			$this->db->like('po_no',$get['search'])
					 ->or_like('item_desc',$get['search'])
					 ->or_like('remk',$get['search']);
		}
		
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_emdbg_issue($limit_to = 0 ){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
						->from('emd_bg_consu_issue')
						->order_by('iss_id','desc');
						
		if($get['search'] != ''){
			$this->db->like('sec_nm',$get['search'])
					 ->or_like('item_desc',$get['search'])
					 ->or_like('remk',$get['search']);
		}
		
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_emdbg_reg($limit_to = 0 ){
		$get = $this->input->get(array('date_from', 'date_to', 'vendor_nm','emd_bg_no', 'search'), TRUE);
		$this->db->select('*')
						->from('emd_bg_register ot')
						->order_by('bill_dt','desc');
						
		if($get['date_from'] != ''){
			$f_date = date('Y-m-d',strtotime($get['date_from']));
			$this->db->where('date(bill_dt) >= ',$f_date);
		}
		if($get['date_to'] != ''){
			$t_date = date('Y-m-d',strtotime($get['date_to']));
			$this->db->where('date(bill_dt) <= ',$t_date);
		}
		if($get['vendor_nm'] != ''){
			$this->db->like('vendor_name',$get['vendor_nm']);
		}
		if($get['emd_bg_no'] != ''){
			$this->db->like('emd_bg_no',$get['emd_bg_no']);
		}
		if($get['search'] != ''){
			$this->db->like('dd_no',$get['search'])
					 ->or_like('bill_no',$get['search'])
					 ->or_like('amount',$get['search']);
		}
		
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_emdbg_budget($limit_to = 0 ){
		$get = $this->input->get(array('date_from', 'date_to', 'fin_year','budgt_catg','bsl_no', 'search'), TRUE);
		$this->db->select('*')
						->from('emd_bg_budget')
						->order_by('fin_yr','desc')
						->order_by('ballot_id','desc');
						
		if($get['date_from'] != ''){
			$f_date = date('Y-m-d',strtotime($get['date_from']));
			$this->db->where('date(entry_dt) >= ',$f_date);
		}
		if($get['date_to'] != ''){
			$t_date = date('Y-m-d',strtotime($get['date_to']));
			$this->db->where('date(entry_dt) <= ',$t_date);
		}
		if($get['fin_year'] != ''){
			$this->db->like('fin_yr',$get['fin_year']);
		}
		if($get['budgt_catg'] != ''){
			$this->db->like('budgt_catg',$get['budgt_catg']);
		}
		if($get['search'] != ''){
			$this->db->like('budgt_amt',$get['search'])
					 ->or_like('allot_amt',$get['search'])
					 ->or_like('budgt_catg',$get['search']);
		}
		if($get['bsl_no'] != ''){
			$this->db->where('bsl_no',$get['bsl_no']);
		}
		
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function add_new_fin_year(){
		$post =  $this->input->post(array('fin_year','start_dt','end_dt'), TRUE);
		$post['start_dt'] = !empty($post['start_dt']) ? date('Y-m-d',strtotime($post['start_dt'])) : '';
		$post['end_dt'] = !empty($post['end_dt']) ? date('Y-m-d',strtotime($post['end_dt'])) : '';
		
		if(!empty($post)){
		$this->db->insert('fin_years',$post);
		}
		return true;
	}
	public function add_new_bank_br(){
		$post =  $this->input->post(array('bank_name','branch_code','ifsc_code','address'), TRUE);
		if(!empty($post)){
		$this->db->insert('bank_list',$post);
		}
		return true;
	}
	public function add_new_vendor(){
		$post =  $this->input->post(array('vendor_nm','amc','vendor_add','ven_email','ven_phno','rep_nm','mbno','rep_mail','repr_nm','ph_no','repr_mail'), TRUE);
		if(!empty($post)){
		$this->db->insert('vendor_list',$post);
		}
		return true;
	}
	
	public function get_all_vendors(){
		$res = $this->db->select('distinct vendor_nm',false)
						->from('vendor_list')
						->order_by('vendor_nm','asc')
						->get()
						->result_array();
		return $res;
	}
	public function get_all_finyears(){
		$res = $this->db->select('distinct fin_year',false)
						->from('fin_years')
						->order_by('fin_year','desc')
						->get()
						->result_array();
		return $res;
	}
	public function get_bank_list(){
		$res = $this->db->select('*')
						->from('bank_list')
						->order_by('bank_name','asc')
						->get()
						->result_array();
		return $res;
	}
	public function get_hw_location_list(){
		$res = $this->db->select('distinct placed',false)
						->from('emd_hw_inventory')
						->order_by('placed','asc')
						->get()
						->result_array();
		return $res;
	}
	public function get_emdbg_ById($id){
		$res = $this->db->select('*')
						->from('emd_bg_details')
						->where('emdbg_id',$id)
						->get()
						->row_array();
		return $res;
	} 
	public function get_invoice_ById($id){
		$res = $this->db->select('*')
						->from('emd_bg_invoice_details')
						->where('invoice_id',$id)
						->get()
						->row_array();
		return $res;
	} 
	public function add_new_invoice_detail($empid = '', $bank_nm =''){
		$post =  $this->input->post(array('invsl_no','recd_type','inward_no','fin_yr','budg_cat','trans_type','entry_dt','chall_no','chall_dt','inv_no','inv_dt','invoc_amt','niq_no','niq_dt','po_letter_no','po_letter_dt',
		'purpos','vend_nm','vend_add','bill_no','bill_dt','bill_amt','paid_amnt','bank_nm','bank_ifsc','bank_acno','file_no','file_dt','status','gem_pm','autho','autho_dt','remk','user'), TRUE);
		
		$mn = date('m');
		$dy = date('d');
		$yr=date('Y');
		
		if($mn <= 3 && $dy <= 31 ){
			$cfyr=$yr - 1;
		}else{
			$cfyr=$yr;
		}
		$fyr=$cfyr.$cfyr+1;
		
//		$post['invsl_no'] = 'OTH'.$fyr.$post['invsl_no'];
		$post['invsl_no'] = 'OTH'.$post['invsl_no'];
		$post['recd_type'] = 'OTH';
		$post['entry_dt'] = !empty($post['entry_dt']) ? date('Y-m-d',strtotime($post['entry_dt'])) : '';
		$post['niq_dt'] = !empty($post['niq_dt']) ? date('Y-m-d',strtotime($post['niq_dt'])) : '';
		$post['chall_dt'] = !empty($post['chall_dt']) ? date('Y-m-d',strtotime($post['chall_dt'])) : '';
		$post['inv_dt'] = !empty($post['inv_dt']) ? date('Y-m-d',strtotime($post['inv_dt'])) : '';
		$post['niq_dt'] = !empty($post['niq_dt']) ? date('Y-m-d',strtotime($post['niq_dt'])) : '';
		$post['po_letter_dt'] = !empty($post['po_letter_dt']) ? date('Y-m-d',strtotime($post['po_letter_dt'])) : '';
		$post['bill_dt'] = !empty($post['bill_dt']) ? date('Y-m-d',strtotime($post['bill_dt'])) : '';
		$post['file_dt'] = !empty($post['file_dt']) ? date('Y-m-d',strtotime($post['file_dt'])) : '';
		$post['autho_dt'] = !empty($post['autho_dt']) ? date('Y-m-d',strtotime($post['autho_dt'])) : '';
		$post['user'] = $empid ;
		$post['upload_dt'] = date('Y-m-d H:i:s');

		if(is_array($bank_nm)){
			foreach($bank_nm as $bank_ifsc=>$bank_nm){
				$post['bank_ifsc'] = $bank_ifsc ;
				$post['bank_nm'] = $bank_nm ;
			}
		}

		if(!empty($post)){
			$this->db->insert('emd_bg_invoice_details',$post);
		}
		return true;
	}
	public function update_invoice_detail($id = '', $empid = ''){
		$post =  $this->input->post(array('invsl_no','recd_type','inward_no','fin_yr','budg_cat','trans_type','entry_dt','chall_no','chall_dt','inv_no','inv_dt','invoc_amt','niq_no','niq_dt','po_letter_no','po_letter_dt',
		'purpos','vend_nm','vend_add','bill_no','bill_dt','bill_amt','paid_amnt','bank_nm','bank_ifsc','bank_acno','file_no','file_dt','status','autho','autho_dt','remk','user'), TRUE);
		
		$update = array();
		
		if(!empty($post['invsl_no'])){$update['invsl_no'] =  $post['invsl_no'];}
		if(!empty($post['inward_no'])){$update['inward_no'] =  $post['inward_no'];}
		if(!empty($post['fin_yr'])){$update['fin_yr'] =  $post['fin_yr'];}
		if(!empty($post['budg_cat'])){$update['budg_cat'] =  $post['budg_cat'];}
		if(!empty($post['trans_type'])){$update['trans_type'] =  $post['trans_type'];}
		$update['entry_dt'] = $post['entry_dt'] !='00-00-0000' ? date('Y-m-d',strtotime($post['entry_dt'])) : '0000-00-00';
		if(!empty($post['chall_no'])){$update['chall_no'] =  $post['chall_no'];}
		$update['chall_dt'] = $post['chall_dt'] !='00-00-0000' ? date('Y-m-d',strtotime($post['chall_dt'])) : '0000-00-00';
		if(!empty($post['inv_no'])){$update['inv_no'] =  $post['inv_no'];}
		$update['inv_dt'] = $post['inv_dt'] !='00-00-0000' ? date('Y-m-d',strtotime($post['inv_dt'])) : '0000-00-00';
		if(!empty($post['invoc_amt'])){$update['invoc_amt'] =  $post['invoc_amt'];}
		if(!empty($post['niq_no'])){$update['niq_no'] =  $post['niq_no'];}
		$update['niq_dt'] = $post['niq_dt'] !='00-00-0000' ? date('Y-m-d',strtotime($post['niq_dt'])) : '0000-00-00';
		if(!empty($post['po_letter_no'])){$update['po_letter_no'] =  $post['po_letter_no'];}
		$update['po_letter_dt'] = $post['po_letter_dt'] !='00-00-0000' ? date('Y-m-d',strtotime($post['po_letter_dt'])) : '0000-00-00';
		if(!empty($post['purpos'])){$update['purpos'] =  $post['purpos'];}
		if(!empty($post['vend_nm'])){$update['vend_nm'] =  $post['vend_nm'];}
		if(!empty($post['vend_add'])){$update['vend_add'] =  $post['vend_add'];}
		if(!empty($post['bill_no'])){$update['bill_no'] =  $post['bill_no'];}
		$update['bill_dt'] = $post['bill_dt'] !='00-00-0000' ? date('Y-m-d',strtotime($post['bill_dt'])) : '0000-00-00';
		if(!empty($post['bill_amt'])){$update['bill_amt'] =  $post['bill_amt'];}
		if(!empty($post['paid_amnt'])){$update['paid_amnt'] =  $post['paid_amnt'];}
		if(!empty($post['bank_nm'])){$update['bank_nm'] =  $post['bank_nm'];}
		if(!empty($post['bank_ifsc'])){$update['bank_ifsc'] =  $post['bank_ifsc'];}
		if(!empty($post['bank_acno'])){$update['bank_acno'] =  $post['bank_acno'];}
		if(!empty($post['file_no'])){$update['file_no'] =  $post['file_no'];}
		$update['file_dt'] = $post['file_dt'] !='00-00-0000' ? date('Y-m-d',strtotime($post['file_dt'])) : '0000-00-00';
		if(!empty($post['status'])){$update['status'] =  $post['status'];}
		if(!empty($post['autho'])){$update['autho'] =  $post['autho'];}
		$update['autho_dt'] = $post['autho_dt'] !='00-00-0000' ? date('Y-m-d',strtotime($post['autho_dt'])) : '0000-00-00';
		If(!empty($post['remk'])){$update['remk'] =  $post['remk'];}
		
		if(!empty($post['remk'])){$update['remk'] =  $post['remk'];}
		$update['user'] =  $empid ;

		if(!empty($update) && $id != ''){
			$this->db->where('invoice_id',$id)->update('emd_bg_invoice_details',$update);
		}
	}
	public function add_new_budget_allotment($empid = '', $bank_nm =''){
		$post =  $this->input->post(array('entry_dt','sl_no','bsl_no','fin_yr','budgt_catg','trans_type','buget_ref_no','buget_ref_dt','budgt_amt','vendor_name','appr_no','appr_dt','allot_no','allot_dt','allot_amt','descrip','user'), TRUE);
		
		$mn = date('m');
		$dy = date('d');
		$yr=date('Y');
		
		if($mn <= 3 && $dy <= 31 ){
			$cfyr=$yr - 1;
		}else{
			$cfyr=$yr;
		}
		$fyr=$cfyr.$cfyr+1;
		
		$post['bsl_no'] = $fyr.$post['bsl_no'];
		$post['entry_dt'] = date('Y-m-d');
		$post['buget_ref_dt'] = !empty($post['buget_ref_dt']) ? date('Y-m-d',strtotime($post['buget_ref_dt'])) : '';
		$post['appr_dt'] = !empty($post['appr_dt']) ? date('Y-m-d',strtotime($post['appr_dt'])) : '';
		$post['allot_dt'] = !empty($post['allot_dt']) ? date('Y-m-d',strtotime($post['allot_dt'])) : '';
		$post['user'] = $empid ;
		$post['upload_dt'] = date('Y-m-d H:i:s');

		if(!empty($post)){
			$this->db->insert('emd_bg_budget',$post);
		}
		return true;
	}
	public function update_emdbg_budget_allotment($id = '', $empid = ''){
		$post =  $this->input->post(array('entry_dt','bsl_no','fin_yr','budgt_catg','trans_type','buget_ref_no','buget_ref_dt','budgt_amt','vendor_name','appr_no','appr_dt','allot_no','allot_dt','allot_amt','descrip','user'), TRUE);
		
		$update = array();
		
		$update['entry_dt'] = $post['entry_dt'] !='00-00-0000' ? date('Y-m-d',strtotime($post['entry_dt'])) : '0000-00-00';
		$bsl_no =  $post['bsl_no'];
		if(!empty($post['fin_yr'])){$update['fin_yr'] =  $post['fin_yr'];}
		if(!empty($post['budgt_catg'])){$update['budgt_catg'] =  $post['budgt_catg'];}
		if(!empty($post['trans_type'])){$update['trans_type'] =  $post['trans_type'];}
		if(!empty($post['buget_ref_no'])){$update['buget_ref_no'] =  $post['buget_ref_no'];}
		$update['buget_ref_dt'] = $post['buget_ref_dt'] !='00-00-0000' ? date('Y-m-d',strtotime($post['buget_ref_dt'])) : '0000-00-00';
		if(!empty($post['budgt_amt'])){$update['budgt_amt'] =  $post['budgt_amt'];}
		if(!empty($post['appr_no'])){$update['appr_no'] =  $post['appr_no'];}
		$update['appr_dt'] = $post['appr_dt'] !='00-00-0000' ? date('Y-m-d',strtotime($post['appr_dt'])) : '0000-00-00';
		if(!empty($post['allot_no'])){$update['allot_no'] =  $post['allot_no'];}
		$update['allot_dt'] = $post['allot_dt'] !='00-00-0000' ? date('Y-m-d',strtotime($post['allot_dt'])) : '0000-00-00';
		if(!empty($post['allot_amt'])){$update['allot_amt'] =  $post['allot_amt'];}
		if(!empty($post['vendor_name'])){$update['vendor_name'] =  $post['vendor_name'];}
		if(!empty($post['descrip'])){$update['descrip'] =  $post['descrip'];}

		$update['user'] =  $empid ;

		if(!empty($update) && $id != ''){
			$this->db->where('ballot_id',$id)->where('bsl_no',$bsl_no)->update('emd_bg_budget',$update);
		}
	}
	public function add_new_emdbg_detail($empid = '', $bank_nm =''){
		$post =  $this->input->post(array('sl_no','emdbg_type','entry_dt','fin_yr','niq_no','niq_dt','vend_nm','vend_add','dd_cq_no','dd_cq_dt',
		'bank_nm','bank_ifsc','amt','valid_from','valid_to','pao_letter','pao_letter_dt','status','refund_dt','refund_ref','refund_ref_dt','autho','autho_dt','remk','user'), TRUE);

		if($post['emdbg_type']=='Earnest Money'){
			$post['rec_type'] = 'EMD';
			$post['sl_no'] = 'EMD'.$post['sl_no'];
		}elseif($post['emdbg_type']=='Bank Guarantee'){
			$post['rec_type'] = 'BG';
			$post['sl_no'] = 'BG'.$post['sl_no'];
		}elseif($post['emdbg_type']=='Security Deposit'){
			$post['rec_type'] = 'SD';
			$post['sl_no'] = 'SD'.$post['sl_no'];
		}elseif($post['emdbg_type']=='Performance Security'){
			$post['rec_type'] = 'PD';
			$post['sl_no'] = 'PD'.$post['sl_no'];
		}else{
			$post['rec_type'] = 'OT';
			$post['sl_no'] = 'OT'.$post['sl_no'];
		}
		
		$post['entry_dt'] = !empty($post['entry_dt']) ? date('Y-m-d',strtotime($post['entry_dt'])) : '';
		$post['niq_dt'] = !empty($post['niq_dt']) ? date('Y-m-d',strtotime($post['niq_dt'])) : '';
		$post['dd_cq_dt'] = !empty($post['dd_cq_dt']) ? date('Y-m-d',strtotime($post['dd_cq_dt'])) : '';
		$post['valid_from'] = !empty($post['valid_from']) ? date('Y-m-d',strtotime($post['valid_from'])) : '';
		$post['valid_to'] = !empty($post['valid_to']) ? date('Y-m-d',strtotime($post['valid_to'])) : '';
		$post['pao_letter_dt'] = !empty($post['pao_letter_dt']) ? date('Y-m-d',strtotime($post['pao_letter_dt'])) : '';
		$post['refund_dt'] = !empty($post['refund_dt']) ? date('Y-m-d',strtotime($post['refund_dt'])) : '';
		$post['refund_ref_dt'] = !empty($post['refund_ref_dt']) ? date('Y-m-d',strtotime($post['refund_ref_dt'])) : '';
		$post['autho_dt'] = !empty($post['autho_dt']) ? date('Y-m-d',strtotime($post['autho_dt'])) : '';
		$post['user'] = $empid ;
		$post['upload_dt'] = date('Y-m-d H:i:s');

		if(is_array($bank_nm)){
			foreach($bank_nm as $ifsc_code=>$bank_nm){
				$post['bank_ifsc'] = $ifsc_code ;
				$post['bank_nm'] = $bank_nm ;
				
			}
		}

		if(!empty($post)){
		$this->db->insert('emd_bg_details',$post);
		}
		return true;
	}
	
	public function update_emdbg_detail($id = '', $empid = ''){
		$post =  $this->input->post(array('valid_from','valid_to','pao_letter','pao_letter_dt','status','refund_dt','refund_ref','refund_ref_dt','autho','autho_dt','remk','user'), TRUE);
		$update = array();
		
		$update['valid_from'] = $post['valid_from'] !='00-00-0000' ? date('Y-m-d',strtotime($post['valid_from'])) : '0000-00-00';
		$update['valid_to'] = $post['valid_to'] !='00-00-0000' ? date('Y-m-d',strtotime($post['valid_to'])) : '0000-00-00';
		if(!empty($post['pao_letter'])){$update['pao_letter'] =  $post['pao_letter'];}
		$update['pao_letter_dt'] = $post['pao_letter_dt'] !='00-00-0000' ? date('Y-m-d',strtotime($post['pao_letter_dt'])) : '0000-00-00';
		if(!empty($post['status'])){$update['status'] =  $post['status'];}
		$update['refund_dt'] = $post['refund_dt'] !='00-00-0000' ? date('Y-m-d',strtotime($post['refund_dt'])) : '0000-00-00';
		if(!empty($post['refund_ref'])){$update['refund_ref'] =  $post['refund_ref'];}
		$update['refund_ref_dt'] = $post['refund_ref_dt'] !='00-00-0000' ? date('Y-m-d',strtotime($post['refund_ref_dt'])) : '0000-00-00';
		If(!empty($post['autho'])){$update['autho'] =  $post['autho'];}
		$update['autho_dt'] = $post['autho_dt'] !='00-00-0000' ? date('Y-m-d',strtotime($post['autho_dt'])) : '0000-00-00';
		if(!empty($post['remk'])){$update['remk'] =  $post['remk'];}
		$update['user'] =  $empid ;

		if(!empty($update) && $id != ''){
			$this->db->where('emdbg_id',$id)->update('emd_bg_details',$update);
		}
	}
	
	public function add_new_emdbg_bill($empid = ''){
		$post =  $this->input->post(array('emd_bg_no','bill_type','budgt_cat','trans_type','gem_pm','bill_no','bill_dt','fin_yr','vendor_name','dd_no','dd_dt','amount','paid_amt','authority','authority_dt','file_dt','file_no','payment_ref','payment_ref_dt'), TRUE);

		$post['bill_type'] = substr($post['emd_bg_no'],0,2);
		$post['bill_dt'] = !empty($post['bill_dt']) ? date('Y-m-d',strtotime($post['bill_dt'])) : '';
		$post['dd_dt'] = !empty($post['dd_dt']) ? date('Y-m-d',strtotime($post['dd_dt'])) : '';
		$post['authority_dt'] = !empty($post['authority_dt']) ? date('Y-m-d',strtotime($post['authority_dt'])) : '';
		$post['file_dt'] = !empty($post['file_dt']) ? date('Y-m-d',strtotime($post['file_dt'])) : '';
		$post['payment_ref_dt'] = !empty($post['payment_ref_dt']) ? date('Y-m-d',strtotime($post['payment_ref_dt'])) : '';
		$post['user'] = $empid ;
		$post['upload_dt'] = date('Y-m-d H:i:s');
		
		if(!empty($post)){
		$this->db->insert('emd_bg_register',$post);
		}
		return true;
	}
	
	public function add_new_emdbg_consu($empid = '', $item_id = ''){
		$post =  $this->input->post(array('item_id','item_desc','item_for','item_cat','item_make','item_box','media_type','pur_dt','stk_bal','remk'), TRUE);

		$post['pur_dt'] = !empty($post['pur_dt']) ? date('Y-m-d',strtotime($post['pur_dt'])) : '0000-00-00';
		$post['user'] = $empid ;
		$post['upload_dt'] = date('Y-m-d H:i:s');
		
		if(!empty($post)){
			$this->db->insert('emd_bg_consu',$post);
		}
		return true;
	}
	public function add_new_emdbg_consu_soft($empid = '', $item_id = ''){
		$post =  $this->input->post(array('item_id','item_for','item_desc','item_cat','item_make','item_box','media_type','no_media','cd_dvd_no','no_license','cost','pur_dt','stk_bal','remk'), TRUE);

		$post['pur_dt'] = !empty($post['pur_dt']) ? date('Y-m-d',strtotime($post['pur_dt'])) : '0000-00-00';
		$post['user'] = $empid ;
		$post['upload_dt'] = date('Y-m-d H:i:s');
		
		if(!empty($post)){
			$this->db->insert('emd_bg_consu',$post);
		}
		return true;
	}
	public function add_new_emdbg_stock($empid = '', $item_id = ''){
		$post =  $this->input->post(array('recd_id','fin_yr','recpt_dt','po_no','po_dt','vend_nm','item_id','item_desc','stk_qty','ob_bal','cl_bal','remk'), TRUE);

		foreach($item_id as $item_id=>$item_desc){
			$res = $this->db->select('stk_bal')
						 ->from('emd_bg_consu')
						 ->where('item_id',$item_id)
						 ->get()
						 ->row_array();
				if(empty($res)){
					return ($res);
					
				} 
			
			$post['ob_bal'] = $res['stk_bal'];
			$post['cl_bal'] = $post['ob_bal'] + $post['stk_qty'];
			$post['item_id'] = $item_id ;
			$post['item_desc'] = $item_desc ;
			$post['recpt_dt'] = !empty($post['recpt_dt']) ? date('Y-m-d',strtotime($post['recpt_dt'])) : '0000-00-00';
			$post['po_dt'] = !empty($post['po_dt']) ? date('Y-m-d',strtotime($post['po_dt'])) : '';
			$post['fin_yr'] = date('Y',strtotime($post['po_dt']));
			$post['user'] = $empid ;
			$post['upload_dt'] = date('Y-m-d H:i:s');

			if(!empty($post)){
				$this->db->insert('emd_bg_consu_stock',$post);
			}
			$update['stk_bal'] =  $post['cl_bal'];
			$update['pur_dt'] = date('Y-m-d');
			if(!empty($update) && $item_id != ''){
				$this->db->where('itm_id',$item_id)->where('item_id',$item_id)->update('emd_bg_consu',$update);
			}
			return true;
		}
	}
	public function add_new_emdbg_issue($empid = '', $item_id=''){
		$post =  $this->input->post(array('red_id','fin_yr','iss_dt','sec_nm','item_id','item_desc','iss_qty','ob_bal','cl_bal','remk'), TRUE);
		
		foreach($item_id as $item_id=>$item_desc){
			$res = $this->db->select('stk_bal')
						 ->from('emd_bg_consu')
						 ->where('item_id',$item_id)
						 ->get()
						 ->row_array();
				if(empty($res)){
					return ($res);
					
				} 

			$post['ob_bal'] = $res['stk_bal'];
			$post['cl_bal'] = $post['ob_bal'] - $post['iss_qty'];
			$post['item_id'] = $item_id ;
			$post['item_desc'] = $item_desc ;
			$post['fin_yr'] = date('Y',strtotime($post['iss_dt']));
			$post['iss_dt'] = !empty($post['iss_dt']) ? date('Y-m-d',strtotime($post['iss_dt'])) : '0000-00-00';
			$post['user'] = $empid ;
			$post['upload_dt'] = date('Y-m-d H:i:s');	

			if(!empty($post)){
				$this->db->insert('emd_bg_consu_issue',$post);
			}
			$update['stk_bal'] =  $post['cl_bal'];
			$update['pur_dt'] = date('Y-m-d');
			if(!empty($update) && $item_id != ''){
				$this->db->where('itm_id',$item_id)->where('item_id',$item_id)->update('emd_bg_consu',$update);
			}
			return true;
		}
	}
	public function get_emdbg_reg_ById($id){
		$res = $this->db->select('*')
						->from('emd_bg_register')
						->where('emdbg_rid',$id)
						->get()
						->row_array();
		return $res;
	}
	public function get_emdbg_consu_ById($id){
		$res = $this->db->select('*')
						->from('emd_bg_consu')
						->where('itm_id',$id)
						->get()
						->row_array();
		return $res;
	}
	public function get_emdbg_stock_ById($id){
		$res = $this->db->select('*')
						->from('emd_bg_consu_stock')
						->where('stk_id',$id)
						->get()
						->row_array();
		return $res;
	}
	public function get_emdbg_issue_ById($id){
		$res = $this->db->select('*')
						->from('emd_bg_consu_issue')
						->where('iss_id',$id)
						->get()
						->row_array();
		return $res;
	}
	public function get_emdbg_budget_ById($id){
		$res = $this->db->select('*')
						->from('emd_bg_budget')
						->where('ballot_id',$id)
						->get()
						->row_array();
		return $res;
	}
	public function update_emdbg_reg_detail($id = '', $empid = ''){
		$post =  $this->input->post(array('fin_yr','emd_bg_no','bill_type','budgt_cat','trans_type','bill_no','bill_dt','vendor_name','dd_no','dd_dt','amount','paid_amt','authority','authority_dt','file_no','file_dt','payment_ref','payment_ref_dt'), TRUE);
		$update = array();
		$emdbgno= $post['emd_bg_no'];
		$update['bill_type'] = substr($post['emd_bg_no'],0,2);
		if(!empty($post['fin_yr'])){$update['fin_yr'] =  $post['fin_yr'];}
		if(!empty($post['budgt_cat'])){$update['budgt_cat'] =  $post['budgt_cat'];}
		if(!empty($post['trans_type'])){$update['trans_type'] =  $post['trans_type'];}
		if(!empty($post['bill_no'])){$update['bill_no'] =  $post['bill_no'];}		
		$update['bill_dt'] = $post['bill_dt'] !='00-00-0000' ? date('Y-m-d',strtotime($post['bill_dt'])) : '0000-00-00';
		if(!empty($post['vendor_name'])){$update['vendor_name'] =  $post['vendor_name'];}
		if(!empty($post['dd_no'])){$update['dd_no'] =  $post['dd_no'];}	
		$update['dd_dt'] = $post['dd_dt'] !='00-00-0000' ? date('Y-m-d',strtotime($post['dd_dt'])) : '0000-00-00';		
		if(!empty($post['amount'])){$update['amount'] =  $post['amount'];}
		if(!empty($post['paid_amt'])){$update['paid_amt'] =  $post['paid_amt'];}
		if(!empty($post['authority'])){$update['authority'] =  $post['authority'];}
		$update['authority_dt'] = $post['authority_dt'] !='00-00-0000' ? date('Y-m-d',strtotime($post['authority_dt'])) : '0000-00-00';
		If(!empty($post['file_no'])){$update['file_no'] =  $post['file_no'];}
		$update['file_dt'] = $post['file_dt'] !='00-00-0000' ? date('Y-m-d',strtotime($post['file_dt'])) : '0000-00-00';
		if(!empty($post['payment_ref'])){$update['payment_ref'] =  $post['payment_ref'];}
		$update['payment_ref_dt'] = $post['payment_ref_dt'] !='00-00-0000' ? date('Y-m-d',strtotime($post['payment_ref_dt'])) : '0000-00-00';
		$update['user'] =  $empid ;

		if(!empty($update) && $id != ''){
			$this->db->where('emdbg_rid',$id)->where('emd_bg_no',$emdbgno)->update('emd_bg_register',$update);
		}
	}
	public function update_emdbg_consu_detail($id = '', $empid = ''){
		$post =  $this->input->post(array('item_id','item_desc','item_for','item_cat','item_make','item_box','media_type','no_media','cd_dvd_no','no_license','cost','pur_dt','stk_bal','remk','user','upload_dt'), TRUE);
		$update = array();
		$item_id= $post['item_id'];
		if(!empty($post['item_desc'])){$update['item_desc'] =  $post['item_desc'];}
		if(!empty($post['item_for'])){$update['item_for'] =  $post['item_for'];}
		if(!empty($post['item_cat'])){$update['item_cat'] =  $post['item_cat'];}
		if(!empty($post['item_make'])){$update['item_make'] =  $post['item_make'];}
		if(!empty($post['item_box'])){$update['item_box'] =  $post['item_box'];}
		if(!empty($post['media_type'])){$update['media_type'] =  $post['media_type'];}
		if(!empty($post['no_media'])){$update['no_media'] =  $post['no_media'];}
		if(!empty($post['cd_dvd_no'])){$update['cd_dvd_no'] =  $post['cd_dvd_no'];}
		if(!empty($post['no_license'])){$update['no_license'] =  $post['no_license'];}
		if(!empty($post['cost'])){$update['cost'] =  $post['cost'];}
		if(!empty($post['cost'])){
			$update['pur_dt'] = $post['pur_dt'] !='00-00-0000' ? date('Y-m-d',strtotime($post['pur_dt'])) : '0000-00-00';
		}else{
			$update['pur_dt'] = date('Y-m-d');
		}
		$update['stk_bal'] = $post['stk_bal'] !='0' ? $post['stk_bal'] : '0';
		if(!empty($post['remk'])){$update['remk'] =  $post['remk'];}
		$update['user'] =  $empid ;
		$update['upload_dt'] = date('Y-m-d H:i:s');
		if(!empty($update) && $id != ''){
			$this->db->where('itm_id',$id)->where('item_id',$item_id)->update('emd_bg_consu',$update);
		}
	}
	public function update_emdbg_stock_detail($id = '', $empid = ''){
		$post =  $this->input->post(array('recd_id','fin_yr','recpt_dt','po_no','po_dt','vend_nm','remk'), TRUE);
		$update = array();
		$recd_id= $post['recd_id'];
		if(!empty($post['recpt_dt'])){
			$update['recpt_dt'] = $post['recpt_dt'] !='00-00-0000' ? date('Y-m-d',strtotime($post['recpt_dt'])) : '0000-00-00';
		}
		if(!empty($post['po_no'])){$update['po_no'] =  $post['po_no'];}
		if(!empty($post['po_dt'])){
			$update['po_dt'] = $post['po_dt'] !='00-00-0000' ? date('Y-m-d',strtotime($post['po_dt'])) : '0000-00-00';
			$update['fin_yr'] = date('Y',strtotime($post['po_dt']));
		}
		if(!empty($post['vend_nm'])){$update['vend_nm'] =  $post['vend_nm'];}
		if(!empty($post['remk'])){$update['remk'] =  $post['remk'];}
		$update['user'] =  $empid ;
		$update['upload_dt'] = date('Y-m-d H:i:s');
		if(!empty($update) && $id != ''){
			print_r($update);
			$this->db->where('stk_id',$id)->where('recd_id',$recd_id)->update('emd_bg_consu_stock',$update);
		}
	}	
	public function update_emdbg_issue_detail($id = '', $empid = ''){
		$post =  $this->input->post(array('red_id','fin_yr','iss_dt','sec_nm','remk'), TRUE);
		$update = array();
		$red_id= $post['red_id'];
		if(!empty($post['iss_dt'])){
			$update['iss_dt'] = $post['iss_dt'] !='00-00-0000' ? date('Y-m-d',strtotime($post['iss_dt'])) : '0000-00-00';
			$update['fin_yr'] = date('Y',strtotime($post['iss_dt']));
		}
		if(!empty($post['sec_nm'])){$update['sec_nm'] =  $post['sec_nm'];}
		if(!empty($post['remk'])){$update['remk'] =  $post['remk'];}
		$update['user'] =  $empid ;
		$update['upload_dt'] = date('Y-m-d H:i:s');
		if(!empty($update) && $id != ''){
			$this->db->where('iss_id',$id)->where('red_id',$red_id)->update('emd_bg_consu_issue',$update);
		}
	}	
	
	public function get_inout_hard_records($limit_to = 0 ){
		$get = $this->input->get(array('date_from','date_to','vendor','amc_yr','search'), TRUE);
		
		$vid= $get['vendor'];
		$data['vendor'] = $this->emp_model->get_vendor_ById($vid);
		$vendor = trim($data['vendor']['vendor_nm']);
		
		$this->db->select('ci.*,cr.*')
						->from('complaint_info ci')
						->join('comp_inout_records cr','ci.comp_no = cr.compt_no','left')
						->order_by('compt_no','desc');
					
		if($get['date_from'] != ''){
			$f_date = date('Y-m-d',strtotime($get['date_from']));
			$this->db->where('date(cr.out_date) >= ',$f_date);
		}
		if($get['date_to'] != ''){
			$t_date = date('Y-m-d',strtotime($get['date_to']));
			$this->db->where('date(cr.out_date) <= ',$t_date);
		}
			
		if($vendor != ''){
			$this->db->where('cr.vendor',$vendor);
		}
		if($get['amc_yr'] != ''){
			$this->db->where('ci.amc_yr',$get['amc_yr']);
		}
		if($get['search'] != ''){
			$this->db->group_start()
					->like('ci.mach_no',$get['search'])
					->or_like('ci.comp_no',$get['search'])
					->or_like('cr.status',$get['search'])
					->group_end();
		}
		
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_all_amc_vendors(){
		$res = $this->db->select('vend_id, vendor_nm',false)
						->from('vendor_list')
						->where('amc','Yes')
						->order_by('vendor_nm','asc')
						->get()
						->result_array();
		return $res;
	}
	public function get_vendor_ById($id){
		$res = $this->db->select('vendor_nm')
						->from('vendor_list')
						->where('vend_id',$id)
						->get()
						->row_array();
		return $res;
	} 
	public function get_all_compno_list(){
		$res = $this->db->select('comp_no')
						->from('complaint_info')
						->order_by('cmp_id','desc')
						->order_by('amc_yr','desc')
						->get()
						->result_array();
		return $res;
	}
	public function get_all_emdbgno_list(){
		$res = $this->db->select('sl_no')
						->from('emd_bg_details')
						->order_by('emdbg_id','desc')
						->get()
						->result_array();
		return $res;
	}	
	public function get_all_emdbg_invoiceno_list(){
		$res = $this->db->select('distinct invsl_no', false)
						->from('emd_bg_invoice_details')
						->order_by('invoice_id','asc')
						->get()
						->result_array();
		return $res;
	}	
	public function add_hardware_comp($empid = ''){
		$post =  $this->input->post(array('yr_sl_no','item','brand','descp','section','mach_no','amc_yr','remk'), TRUE);
		$post['user'] = $empid ;
		$cno = $post['yr_sl_no'];
		$mn = date('m');
		$dy = date('d');
		$yr=date('Y');
		
		if($mn <= 3 && $dy <= 31 ){
			$cfyr=$yr - 1;
		}else{
			$cfyr=$yr;
		}

		$fyr=$cfyr.$cfyr+1;
		$post['comp_no'] = $fyr.$cno;
		$post['entry_date'] = date('Y-m-d');
		$post['upload_dt'] = date('Y-m-d H:i:s');
		if(!empty($post)){
		$this->db->insert('complaint_info',$post);
		}
		return true;
	}
	public function add_hardware_inout($empid = ''){
		$post =  $this->input->post(array('compt_no','out_date','vendor','vendor_rep_nm','recpt_date','status','standby_info'), TRUE);
		$post['user'] = $empid ;
		$post['out_date'] = !empty($post['out_date']) ? date('Y-m-d',strtotime($post['out_date'])) : '';
		$post['recpt_date'] = date('Y-m-d');
		$post['upload_dt'] = date('Y-m-d H:i:s');
		if(!empty($post)){
		$this->db->insert('comp_inout_records',$post);
		}
		return true;
	}
	public function get_compinfo_record($id=0){
		return  $this->db->select('*')
						 ->from('complaint_info')
						 ->where('comp_no',$id)
						 ->get()
						 ->row_array();
	}
	public function get_inout_record($id=0){
		return  $this->db->select('*')
						 ->from('comp_inout_records')
						 ->where('compt_no',$id)
						 ->get()
						 ->row_array();
	}
	public function update_cominfo_inoutrecords($id=0,$empid = ''){
		$compinfo  = $this->input->post(array('yr_sl_no','item','brand','descp','section','mach_no','amc_yr','remk','user'), TRUE);
		
		$update = array();
		if($compinfo['yr_sl_no'] != ''){$update['yr_sl_no'] = $compinfo['yr_sl_no'];}
		if($compinfo['item'] != ''){$update['item'] = $compinfo['item'];}
		if($compinfo['brand'] != ''){$update['brand'] = $compinfo['brand'];}
		if($compinfo['descp'] != ''){$update['descp'] = $compinfo['descp'];}
		if($compinfo['section'] != ''){$update['section'] = $compinfo['section'];}
		if($compinfo['mach_no'] != ''){$update['mach_no'] = $compinfo['mach_no'];}
		if($compinfo['amc_yr'] != ''){$update['amc_yr'] = $compinfo['amc_yr'];}
		if($compinfo['remk'] != ''){$update['remk'] = $compinfo['remk'];}
		$update['user'] = $empid ;
	
		if(!empty($update) && $id != ''){
			$this->db->where('comp_no',$id)->update('complaint_info',$update);
		}
		
		$inout  = $this->input->post(array('compt_no','out_date','vendor','vendor_rep_nm','recpt_date','status','standby_info','user'), TRUE);

		$update1 = array();

		if($inout['out_date'] != ''){$update1['out_date'] = date('Y-m-d',strtotime($inout['out_date']));}
		if($inout['vendor'] != ''){$update1['vendor'] = $inout['vendor'];}
		if($inout['vendor_rep_nm'] != ''){$update1['vendor_rep_nm'] = $inout['vendor_rep_nm'];}
		if($inout['recpt_date'] != ''){$update1['recpt_date'] = date('Y-m-d',strtotime($inout['recpt_date']));}
		if($inout['status'] != ''){$update1['status'] = $inout['status'];}
		if($inout['standby_info'] != ''){$update1['standby_info'] = $inout['standby_info'];}
		$update1['user'] = $empid ;

		if(!empty($update1) && $id != ''){
			$this->db->where('compt_no',$id)->update('comp_inout_records',$update1);
		}
	}
	
	public function hardware_pending_pdf($vnd = ''){
		$res=$this->db->select('ci.*,cr.*')
				->from('complaint_info ci')
				->join('comp_inout_records cr','ci.comp_no = cr.compt_no','left')
				->where('cr.status','pending')
				->where('cr.vendor',$vnd)
				->order_by('compt_no','desc')
				->get()
				->result_array();
		return $res;
	}

	public function get_budget_report_alot_cons($fin_yr = ''){
		$res = $this->db->select('SUM(allot_amt) alot_cons_amt')
					->from('emd_bg_budget')
					->where('fin_yr',$fin_yr)
					->group_start()
					->like('trans_type','CONSUMABLES')
					->or_like('budgt_catg','LAN')
					->group_end()
					->get()
					->row_array();
		return $res;
	}
	public function get_budget_report_alot_amc($fin_yr = ''){
		$res = $this->db->select('SUM(allot_amt) alot_amc_amt')
					->from('emd_bg_budget')
					->where('fin_yr',$fin_yr)
					->like('budgt_catg','AMC')
					->get()
					->row_array();
		return $res;
	}
	public function get_budget_report_alot_hw($fin_yr = ''){
		$res = $this->db->select('SUM(allot_amt) alot_hw_amt')
					->from('emd_bg_budget')
					->where('fin_yr',$fin_yr)
					->like('budgt_catg','HARDWARE')
					->get()
					->row_array();
		return $res;
	}
	public function get_budget_report_alot_sw($fin_yr = ''){
		$res = $this->db->select('SUM(allot_amt) alot_sw_amt')
					->from('emd_bg_budget')
					->where('fin_yr',$fin_yr)
					->like('budgt_catg','SOFTWARE')
					->get()
					->row_array();
		return $res;
	}
	public function get_budget_report_alot_sms($fin_yr = ''){
		$res = $this->db->select('SUM(allot_amt) alot_sms_amt')
					->from('emd_bg_budget')
					->where('fin_yr',$fin_yr)
					->like('budgt_catg','SMS')
					->get()
					->row_array();
		return $res;
	}
	public function get_budget_report_alot_ict($fin_yr = ''){
		$res = $this->db->select('SUM(allot_amt) alot_ict_amt')
					->from('emd_bg_budget')
					->where('fin_yr',$fin_yr)
					->like('budgt_catg','ICT')
					->get()
					->row_array();
		return $res;
	}
	public function get_budget_report_alot_oios($fin_yr = ''){
		$res = $this->db->select('SUM(allot_amt) alot_oios_amt')
					->from('emd_bg_budget')
					->where('fin_yr',$fin_yr)
					->like('budgt_catg','OIOS')
					->get()
					->row_array();
		return $res;
	}
	public function get_budget_report_alot_furni($fin_yr = ''){
		$res = $this->db->select('SUM(allot_amt) alot_furni_amt')
					->from('emd_bg_budget')
					->where('fin_yr',$fin_yr)
					->like('budgt_catg','FURNITURE')
					->get()
					->row_array();
		return $res;
	}
	public function get_budget_report_alot_machiry($fin_yr = ''){
		$res = $this->db->select('SUM(allot_amt) alot_machi_amt')
					->from('emd_bg_budget')
					->where('fin_yr',$fin_yr)
					->like('budgt_catg','MACHINERY')
					->get()
					->row_array();
		return $res;
	}
	public function get_budget_report_alot_other($fin_yr = ''){
		$res = $this->db->select('SUM(allot_amt) alot_oth_amt')
					->from('emd_bg_budget')
					->where('fin_yr',$fin_yr)
					->like('budgt_catg','OTHER')
					->get()
					->row_array();
		return $res;
	}
	
	public function get_budget_report_cons($fin_yr = ''){
		$res = $this->db->select('SUM(bill_amt) cons_amt')
					->from('emd_bg_invoice_details')
					->where('fin_yr',$fin_yr)
					->group_start()
					->like('budg_cat','CONSUMABLES')
					->or_like('budg_cat','LAN')
					->group_end()
					->get()
					->row_array();
		return $res;
	}
	public function get_budget_report_amc($fin_yr = ''){
		$res = $this->db->select('SUM(bill_amt) amc_amt')
					->from('emd_bg_invoice_details')
					->where('fin_yr',$fin_yr)
					->like('budg_cat','AMC')
					->get()
					->row_array();
		return $res;
	}
	public function get_budget_report_hw($fin_yr = ''){
		$res = $this->db->select('SUM(bill_amt) hw_amt')
					->from('emd_bg_invoice_details')
					->where('fin_yr',$fin_yr)
					->like('budg_cat','HARDWARE')
					->get()
					->row_array();
		return $res;
	}
	public function get_budget_report_sw($fin_yr = ''){
		$res = $this->db->select('SUM(bill_amt) sw_amt')
					->from('emd_bg_invoice_details')
					->where('fin_yr',$fin_yr)
					->like('budg_cat','SOFTWARE')
					->get()
					->row_array();
		return $res;
	}
	public function get_budget_report_sms($fin_yr = ''){
		$res = $this->db->select('SUM(bill_amt) sms_amt')
					->from('emd_bg_invoice_details')
					->where('fin_yr',$fin_yr)
					->like('budg_cat','SMS')
					->get()
					->row_array();
		return $res;
	}
	public function get_budget_report_ict($fin_yr = ''){
		$res = $this->db->select('SUM(bill_amt) ict_amt')
					->from('emd_bg_invoice_details')
					->where('fin_yr',$fin_yr)
					->like('budg_cat','ICT')
					->get()
					->row_array();
		return $res;
	}
	public function get_budget_report_oios($fin_yr = ''){
		$res = $this->db->select('SUM(bill_amt) oios_amt')
					->from('emd_bg_invoice_details')
					->where('fin_yr',$fin_yr)
					->like('budg_cat','OIOS')
					->get()
					->row_array();
		return $res;
	}
	public function get_budget_report_funi($fin_yr = ''){
		$res = $this->db->select('SUM(bill_amt) furni_amt')
					->from('emd_bg_invoice_details')
					->where('fin_yr',$fin_yr)
					->like('budg_cat','FURNITURE')
					->get()
					->row_array();
		return $res;
	}
	public function get_budget_report_machiry($fin_yr = ''){
		$res = $this->db->select('SUM(bill_amt) machi_amt')
					->from('emd_bg_invoice_details')
					->where('fin_yr',$fin_yr)
					->like('budg_cat','MACHINERY')
					->get()
					->row_array();
		return $res;
	}
	public function get_budget_report_other($fin_yr = ''){
		$res = $this->db->select('SUM(bill_amt) oth_amt')
					->from('emd_bg_invoice_details')
					->where('fin_yr',$fin_yr)
					->like('budg_cat','OTHER')
					->get()
					->row_array();
		return $res;
	}

	public function get_emdbg_pending_return($vendor = ''){
		$res=$this->db->select('*')
				->from('emd_bg_details')
				->where('vend_nm',$vendor)
				->where('status','Deposited')
				->order_by('entry_dt','desc')
				->get()
				->result_array();
		return $res;
	}
	public function employee_hw_invtentory_list($limit_to = 0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('emd_hw_inventory')
				 ->order_by('id','desc');
		if($get['search'] != ''){
				$this->db->like('hw_number',$get['search']);
				$this->db->or_like('unique_id_no',$get['search']);
				$this->db->or_like('id',$get['search']);
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_hw_inventory_records($limit_to = 0 ){
		$get = $this->input->get(array('date_from','date_to','placed','type','search'), TRUE);
	
		$this->db->select('*')
						->from('emd_hw_inventory')
						->order_by('id','desc');
					
		if($get['date_from'] != ''){
			$f_date = date('Y-m-d',strtotime($get['date_from']));
			$this->db->where('date(date_of_purchase) >= ',$f_date);
		}
		if($get['date_to'] != ''){
			$t_date = date('Y-m-d',strtotime($get['date_to']));
			$this->db->where('date(date_of_purchase) <= ',$t_date);
		}
		if($get['type'] != ''){
			$this->db->where('type',$get['type']);
		}
		if($get['placed'] != ''){
			$this->db->where('placed',$get['placed']);
		}
		if($get['search'] != ''){
			$this->db->group_start()
					->like('hw_number',$get['search'])
					->or_like('id',$get['search'])
					->group_end();
		}
		
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}	
	
} // End of class