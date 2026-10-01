<?php
class Gpf_model extends CI_Model {

	function __construct(){
		parent::__construct();
		if($this->session->userdata('language_id')){
			$this->language_id = $this->session->userdata('language_id');
		}else{
			$this->language_id = 1;
		}
	}
	
	public function get_admin_subscribers($limit_to=0){
		$get = $this->input->get(array('search','series','ac_code'), TRUE);
		$this->db->select('*')
				 ->from('subscriber_master')
				 ->order_by('subs_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('year_from',$get['search']);
				$this->db->or_like('year_to',$get['search']);
				$this->db->or_like('series',$get['search']);
				$this->db->or_like('ac_code',$get['search']);
				$this->db->or_like('mhcd',$get['search']);
				$this->db->or_like('emp_code',$get['search']);
				$this->db->or_like('fst_nme',$get['search']);
				$this->db->or_like('cur_ddo',$get['search']);
			$this->db->group_end();
		}
		if($get['series'] != ''){
			$this->db->where('series',$get['series']);
		}
		if($get['ac_code'] != ''){
			$this->db->where('ac_code',$get['ac_code']);
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function update_subscribers($ac_code = '',$series=''){
		$post = $this->input->post(array('emp_code','fst_nme','dob','nm_father_e','date_o_join','allot_dt','basic_pay','nomination','cur_ddo','email_id','mobile_no','dor','auto_account_no','nomination_copy','password'), TRUE);
		$update = array();
		$update['emp_code'] = $post['emp_code'];
		$update['fst_nme'] = $post['fst_nme'];
		$update['dob'] = $post['dob'];
		$update['nm_father_e'] = $post['nm_father_e'];
		$update['date_o_join'] = $post['date_o_join'];
		$update['allot_dt'] = $post['allot_dt'];
		$update['basic_pay'] = $post['basic_pay'];
		$update['nomination'] = $post['nomination'];
		$update['cur_ddo'] = $post['cur_ddo'];
		$update['email_id'] = $post['email_id'];
		$update['mobile_no'] = $post['mobile_no'];
		$update['dor'] = $post['dor'];
		$update['auto_account_no'] = $post['auto_account_no'];
		$update['nomination_copy'] = $post['nomination_copy'];
		if($post['password'] != ''){$update['password'] = md5($post['password']);}
		if(!empty($update)){
			$this->db->where('ac_code',$ac_code)->where('series',$series)->update('subscriber_master',$update);
		}
	}
	public function update_subscriber_active($id){
		$update['account_active'] = 'Y';
		$this->db->where('subs_id',$id)->update('subscriber_master',$update);
	}
	public function update_subscriber_deactive($id){
		$update['account_active'] = 'No';
		$this->db->where('subs_id',$id)->update('subscriber_master',$update);
	}
	public function get_admin_ledger($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('gpf_ledger')
				 ->order_by('ledger_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('year',$get['search']);
				$this->db->or_like('series',$get['search']);
				$this->db->or_like('ac_code',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_admin_ddo($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('ddo_master')
				 ->order_by('d_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('ddo_cd',$get['search']);
				$this->db->or_like('ddo_desc',$get['search']);
				$this->db->or_like('tr_cd',$get['search']);
				$this->db->or_like('emailid',$get['search']);
				$this->db->or_like('mb_no',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_admin_fp_authority($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('gpf_fp_authority')
				 ->group_by('request_no')
				 ->order_by('fp_a_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->where('subscriber_name',$get['search']);
				$this->db->or_where('alias_name',$get['search']);
				$this->db->or_where('concat(series,"/WB/",ac_code)',$get['search']);
				$this->db->or_where('authority_no',$get['search']);
				$this->db->or_where('letter_no',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_fp_authority_by_request_no($request_no=0){
		$results  = $this->db->select('*')
							 ->from('gpf_fp_authority')
							 ->where('request_no',$request_no)
							 ->get()
							 ->result_array();
		return $results;
	}
	
	public function get_admin_case_status($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('gpf_case_status')
				 ->order_by('c_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('f_year',$get['search']);
				$this->db->or_like('gpf_ac_no',$get['search']);
				$this->db->or_like('subs_name',$get['search']);
				$this->db->or_like('designation',$get['search']);
				$this->db->or_like('case_type',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function search_user_case_status($gpf_ac = ''){
		$res = $this->db->select('*')
						->from('gpf_case_status')
						->where('gpf_ac_no',$gpf_ac)
						->get()
						->row_array();
		return $res;
	}
	public function get_part_1_data($limit_to=0){
		$get = $this->input->get(array('search','series','ac_code'), TRUE);
		$this->db->select('*')
				 ->from('gpf')
				 ->order_by('gpf_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('fyear',$get['search']);
				$this->db->or_like('series',$get['search']);
				$this->db->or_like('ac_code',$get['search']);
				$this->db->or_like('try',$get['search']);
				$this->db->or_like('sub_name',$get['search']);
				$this->db->or_like('ddo_name',$get['search']);
			$this->db->group_end();
		}
		if($get['series'] != ''){
			$this->db->where('series',$get['series']);
		}
		if($get['ac_code'] != ''){
			$this->db->where('ac_code',$get['ac_code']);
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_part_1_data_temp($limit_to=0){
		$get = $this->input->get(array('search','series','ac_code'), TRUE);
		$this->db->select('*')
				 ->from('gpf_dumy')
				 ->order_by('gpf_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('fyear',$get['search']);
				$this->db->or_like('series',$get['search']);
				$this->db->or_like('ac_code',$get['search']);
				$this->db->or_like('try',$get['search']);
				$this->db->or_like('sub_name',$get['search']);
				$this->db->or_like('ddo_name',$get['search']);
			$this->db->group_end();
		}
		if($get['series'] != ''){
			$this->db->where('series',$get['series']);
		}
		if($get['ac_code'] != ''){
			$this->db->where('ac_code',$get['ac_code']);
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_part_2_data($limit_to=0){
		$get = $this->input->get(array('search','series','ac_code'), TRUE);
		$this->db->select('*')
				 ->from('gpf_transaction')
				 ->order_by('gpf_transaction_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('fyear',$get['search']);
				$this->db->or_like('series',$get['search']);
				$this->db->or_like('ac_code',$get['search']);
				$this->db->or_like('month',$get['search']);
				$this->db->or_like('sub_year',$get['search']);
				$this->db->or_like('sub',$get['search']);
			$this->db->group_end();
		}
		if($get['series'] != ''){
			$this->db->where('series',$get['series']);
		}
		if($get['ac_code'] != ''){
			$this->db->where('ac_code',$get['ac_code']);
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_part_2_data_temp($limit_to=0){
		$get = $this->input->get(array('search','series','ac_code'), TRUE);
		$this->db->select('*')
				 ->from('gpf_transaction_dumy')
				 ->order_by('gpf_transaction_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('fyear',$get['search']);
				$this->db->or_like('series',$get['search']);
				$this->db->or_like('ac_code',$get['search']);
				$this->db->or_like('month',$get['search']);
				$this->db->or_like('sub_year',$get['search']);
				$this->db->or_like('sub',$get['search']);
			$this->db->group_end();
		}
		if($get['series'] != ''){
			$this->db->where('series',$get['series']);
		}
		if($get['ac_code'] != ''){
			$this->db->where('ac_code',$get['ac_code']);
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function get_part_3_data($limit_to=0){
		$get = $this->input->get(array('search','series','ac_code'), TRUE);
		$this->db->select('*')
				 ->from('gpf_summary')
				 ->order_by('gpf_summary_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('fyear',$get['search']);
				$this->db->or_like('series',$get['search']);
				$this->db->or_like('ac_code',$get['search']);
			$this->db->group_end();
		}
		if($get['series'] != ''){
			$this->db->where('series',$get['series']);
		}
		if($get['ac_code'] != ''){
			$this->db->where('ac_code',$get['ac_code']);
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_part_3_data_temp($limit_to=0){
		$get = $this->input->get(array('search','series','ac_code'), TRUE);
		$this->db->select('*')
				 ->from('gpf_summary_dumy')
				 ->order_by('gpf_summary_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('fyear',$get['search']);
				$this->db->or_like('series',$get['search']);
				$this->db->or_like('ac_code',$get['search']);
			$this->db->group_end();
		}
		if($get['series'] != ''){
			$this->db->where('series',$get['series']);
		}
		if($get['ac_code'] != ''){
			$this->db->where('ac_code',$get['ac_code']);
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_part_4_data($limit_to=0){
		$get = $this->input->get(array('search','series','ac_code'), TRUE);
		$this->db->select('*')
				 ->from('gpf_missing_credits')
				 ->order_by('gpf_missing_credits_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('fyear',$get['search']);
				$this->db->or_like('series',$get['search']);
				$this->db->or_like('ac_code',$get['search']);
				$this->db->or_like('month',$get['search']);
			$this->db->group_end();
		}
		if($get['series'] != ''){
			$this->db->where('series',$get['series']);
		}
		if($get['ac_code'] != ''){
			$this->db->where('ac_code',$get['ac_code']);
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_part_4_data_temp($limit_to=0){
		$get = $this->input->get(array('search','series','ac_code'), TRUE);
		$this->db->select('*')
				 ->from('gpf_missing_credits_dumy')
				 ->order_by('gpf_missing_credits_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('fyear',$get['search']);
				$this->db->or_like('series',$get['search']);
				$this->db->or_like('ac_code',$get['search']);
				$this->db->or_like('month',$get['search']);
			$this->db->group_end();
		}
		if($get['series'] != ''){
			$this->db->where('series',$get['series']);
		}
		if($get['ac_code'] != ''){
			$this->db->where('ac_code',$get['ac_code']);
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_part_5_data($limit_to=0){
		$this->db->select('*')
				 ->from('gpf_section')
				 ->order_by('sec_off_id','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_gpf_tax_data($limit_to=0){
		$get = $this->input->get(array('search','series','accode'), TRUE);
		$this->db->select('*')
				 ->from('agb_gpf_tax_nontax')
				 ->order_by('gpf_tax_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('fyear',$get['search']);
				$this->db->or_like('series',$get['search']);
				$this->db->or_like('accode',$get['search']);
			$this->db->group_end();
		}
		if($get['series'] != ''){
			$this->db->where('series',$get['series']);
		}
		if($get['accode'] != ''){
			$this->db->where('accode',$get['accode']);
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function get_rate_of_interest($limit_to=0){
		$this->db->select('*')
				 ->from('rate_of_interest')
				 ->order_by('int_id','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function subscriber_login($gpf_account = '',$series = '',$dob = ''){
		$res = $this->db->select('*')
						->from('subscriber_master')
						->where('ac_code',$gpf_account)
						->where('series',$series)
						->where('date(dob)',date('Y-m-d',strtotime($dob)))
						->get()
						->row_array();
		if(empty($res)){
			return array('success'=>false,'msg'=>'Wrong Credentials!');
		}
		if(isset($res['mobile_no']) && empty($res['mobile_no'])){
			$msg = "You do not submited your mobile no. Please submit mobile no to edpfnd-agae-wb@nic.in.";
			return array('success'=>false,'msg'=>$msg);
		}
		return array('success'=>true,'msg'=>"SUbmit OTP",'details'=>$res);
	}
	
	public function subscriber_password_login($gpf_account = '',$series = '',$dob = '',$pass = ''){
		$res = $this->db->select('*')
						->from('subscriber_master')
						->where('ac_code',$gpf_account)
						->where('series',$series)
						->where('date(dob)',date('Y-m-d',strtotime($dob)))
						->where('password',md5($pass))
						->get()
						->row_array();
		return $res;
	}
	public function subscriber_login_allowed($gpf_account = '',$series = '',$dob = ''){
		$res = $this->db->select('account_active')
						->from('subscriber_master')
						->where('ac_code',$gpf_account)
						->where('series',$series)
						->where('date(dob)',date('Y-m-d',strtotime($dob)))
						->get()
						->row_array();
		return $res;
	}
	public function update_subscriber_last_login($gpf_account = '',$series = '',$dob = ''){
		$post = $this->input->post(array('last_login'), TRUE);
		$update = array();
		$update['last_login'] = date('Y-m-d H:i:s');	
		if(!empty($update)){
			$this->db->where('ac_code',$gpf_account)
					 ->where('series',$series)
					 ->where('date(dob)',date('Y-m-d',strtotime($dob)))
					 ->update('subscriber_master',$update);
			return true;
		}
		return false;
	}
	public function get_subscriber_profile($series = '', $ac_code = '', $dob = ''){
		$res = $this->db->select('*')
						->from('subscriber_master')
						->where('series',$series)
						->where('ac_code',$ac_code)
						->where('date(dob)',date('Y-m-d',strtotime($dob)))
						->get()
						->row_array();
		return $res;
	}
	public function update_subscriber_profile($series = '', $ac_code = '', $dob = ''){
		$post = $this->input->post(array('cur_ddo','emp_code','email_id', 'password','profile_updated'), TRUE);
		$update = array();
		if($post['cur_ddo'] != ''){
			$update['cur_ddo'] = $post['cur_ddo'];
		}
		if($post['emp_code'] != ''){
			$update['emp_code'] = $post['emp_code'];
		}
		if($post['email_id'] != ''){
			$update['email_id'] = $post['email_id'];
		}
		if($post['password'] != ''){
			$update['password'] = md5($post['password']);
		}
		$update['profile_updated'] = date('Y-m-d H:i:s');
		
		if(!empty($update) &&  $series != '' && $ac_code != ''){
			$this->db->where('series',$series)->where('ac_code',$ac_code)->where('dob',$dob)->update('subscriber_master',$update);
			return true;
		}
		return false;
	}
	
	public function get_subscribers_profile_download(){
		$post = $this->input->post(array('date_from','date_to'), TRUE);
		
		$res = $this->db->select('fst_nme,mid_nme,lst_nme,dob,sex,series,ac_code,mhcd,cur_ddo,emp_code,mobile_no,email_id,profile_updated') //select('fst_nme,mid_nme,lst_nme,dob,sex,series,ac_code,mhcd,emp_code,mobile_no,email_id')
						->from('subscriber_master');
						
		if($post['date_from'] != ''){
			$f_date = date('Y-m-d',strtotime($post['date_from']));
			$this->db->where('date(profile_updated) >= ',$f_date);
		}
		if($post['date_to'] != ''){
			$t_date = date('Y-m-d',strtotime($post['date_to']));
			$this->db->where('date(profile_updated) <= ',$t_date);
		}
		
		$res = $this->db->order_by('fst_nme','asc')
						->get()
						->result_array();
		return $res;
	}	
	
	public function get_subscriber_details($subs_id = 0){
		$res = $this->db->select('*')
						->from('subscriber_master')
						->where('subs_id',$subs_id)
						->get()
						->row_array();
		return $res;
	}
	public function get_subscriber_data($ac_code = '',$series=''){
		$res = $this->db->select('*')
						->from('subscriber_master')
						->where('ac_code',$ac_code)
						->where('series',$series)
//						->where('date(fyear)',$year)
						->get()
						->row_array();
		return $res;
	}
	public function ddo_login($code = '',$pass = ''){
		$res = $this->db->select('*')
						->from('ddo_master')
						->where('ddo_cd',$code)
						->where('password',md5($pass))
						->get()
						->row_array();
		return $res;
	}
	public function update_ddo_last_login($code = ''){
		$post = $this->input->post(array('last_login'), TRUE);
		$update = array();
		$update['last_login'] = date('Y-m-d H:i:s');	
		if(!empty($update)){
			$this->db->where('ddo_cd',$code)->update('ddo_master',$update);
			return true;
		}
		return false;
	}
	public function get_ddo_subscribers($code = ''){
		$res = $this->db->select('max(fyear) as fyear,subscriber_master.fst_nme,subscriber_master.series,subscriber_master.ac_code')
						->from('subscriber_master')
						->join('gpf','subscriber_master.series = gpf.series AND subscriber_master.ac_code = gpf.ac_code')
						->where('subscriber_master.cur_ddo',$code)
						->group_by('gpf.series,gpf.ac_code')
						->order_by('fst_nme')
						->get()
						->result_array();
		return $res;
	}
	public function get_ddo_profile($code = ''){
		$result = $this->db->select('*')->from('ddo_master')->where('ddo_cd',$code)->get()->row_array();
		return $result;
	}
	public function update_ddo_profile($code = ''){
		$post = $this->input->post(array('user_name','user_desig','email', 'phone', 'password'), TRUE);
		$update = array();
		if($post['user_name'] != ''){
			$update['user_name'] = $post['user_name'];
		}
		if($post['user_desig'] != ''){
			$update['user_desig'] = $post['user_desig'];
		}
		if($post['email'] != ''){
			$update['emailid'] = $post['email'];
		}
		if($post['phone'] != ''){
			$update['mb_no'] = $post['phone'];
		}
		if($post['password'] != ''){
			$update['password'] = md5($post['password']);
		}
		if(!empty($update) && $code != ''){
			$this->db->where('ddo_cd',$code)->update('ddo_master',$update);
			return true;
		}
		return false;
	}
	public function get_all_series_code(){
		$res = $this->db->select('distinct series',false)
						->from('subscriber_master')
						->get()
						->result_array();
		return $res;
	}
	public function get_subscribers_financial_years($ac_code = '',$series = '',$year = ''){
		$res = $this->db->select('fyear')
						->from('gpf_summary')
						->where('ac_code',$ac_code)
						->where('series',$series)
						->where('date(fyear)',$year)
						->order_by('fyear','desc')
						->limit(40)
						->get()
						->result_array();
		return $res;
	}
	public function get_subscribers_financial_years_TaxNonTax($ac_code = '',$series = '',$year = ''){
		$res = $this->db->select('*')
						->from('gpf_tax_nontax')
						->where('accode',$ac_code)
						->where('series',$series)
						->where('date(fyear)',$year)
						->get()
						->result_array();
		return $res;
	}
	public function get_subscribers_financial_years_TaxNonTax_pdf($ac_code = '',$series = '',$year = ''){
		$res = $this->db->select('*')
						->from('gpf_tax_nontax')
						->where('accode',$ac_code)
						->where('series',$series)
						->where('date(fyear)',$year)
						->get()
						->row_array();
		return $res;
	}
	public function get_subscribers_part_1($ac_code = '',$series = '',$year = ''){
		$res = $this->db->select('*')
						->from('gpf')
						->where('ac_code',$ac_code)
						->where('series',$series)
						->where('date(fyear)',$year)
						->get()
						->row_array();
		return $res;
	}
	public function get_subscribers_part_2($ac_code = '',$series = '',$year = ''){
		$res = $this->db->select('*')
						->from('gpf_transaction')
						->where('ac_code',$ac_code)
						->where('series',$series)
						->where('fyear',$year)
						->order_by('sub_year','asc')
						->order_by('month','asc')
						->get()
						->result_array();
		return $res;
	}
	public function get_subscribers_part_3($ac_code = '',$series = '',$year = ''){
		$res = $this->db->select('*')
						->from('gpf_summary')
						->where('ac_code',$ac_code)
						->where('series',$series)
						->where('fyear',$year)
						->get()
						->row_array();
		return $res;
	}
	public function get_subscribers_part_4($ac_code = '',$series = '',$year = ''){
		$res = $this->db->select('*')
						->from('gpf_missing_credits')
						->where('ac_code',$ac_code)
						->where('series',$series)
						->where('date(fyear)',$year)
						->get()
						->row_array();
		return $res;
	}
	public function get_subscribers_missing_credits($ac_code = '',$series = '',$limit = 0){
		$res = $this->db->select('*')
						->from('agb_missingcr')
						->where('accno',$ac_code)
						->where('series',$series)
						->where('crdr_flag != ', 'Y')
						->order_by('misscrdr','desc')
						->order_by('misscdmnth','asc')
						->get()
						->result_array();
		return $res;
	}
/*	
	public function get_subscribers_missing_credits($ac_code = '',$series = ''){
		$res = $this->db->select('*')
						->from('gpf_missing_credits')
						->where('ac_code',$ac_code)
						->where('series',$series)
						->get()
						->result_array();
		return $res;
	}
*/
	public function getMissingCrDrByID($id = 0,$office='AGAE'){
		$res = $this->db->select('*')->from('missingcr')->where('id',$id)->get()->row_array();
		return $res;
	}
	public function deleteMissingCrDrByID($id = 0){
		$this->db->where('id',$id)->delete('missingcr');
	}
	public function getPart2TranByID($id = 0,$office='AGAE'){
		$res = $this->db->select('*')->from('gpf_transaction')->where('gpf_transaction_id',$id)->get()->row_array();
		return $res;
	}
	public function deletegetPart2TranByID($id = 0){
		$this->db->where('gpf_transaction_id',$id)->delete('gpf_transaction');
	}
	
	public function get_subscribers_final_payment_authority($ac_code = '',$series = ''){
		$res = $this->db->select('*')
						->from('gpf_fp_authority')
						->where('ac_code',$ac_code)
						->where('series',$series)
						->order_by('authority_no')
						->get()
						->result_array();
		return $res;
	}
	public function get_subscribers_final_payment_authority_group($ac_code = '',$series = ''){
		$res = $this->db->select('*')
						->from('gpf_fp_authority')
						->where('ac_code',$ac_code)
						->where('series',$series)
						->order_by('authority_no')
						->group_by('authority_no')
						->get()
						->result_array();
		return $res;
	}
	public function ddo_fp_authority($ddo_code='',$ac_code = '',$series = ''){
		$res = $this->db->select('*')
						->from('gpf_fp_authority')
						->where('ac_code',$ac_code)
						->where('series',$series)
						->where('ddo_code',$ddo_code)
						->order_by('authority_no')
						->group_by('authority_no')
						->get()
						->result_array();
		return $res;
	}
	//Hirani
	public function get_final_payment_nominee($authority_no = '',$series = '', $ac_code = ''){
		$res = $this->db->select('nominee_name,nom_sh_details,nom_type,nominee_guardian_name,amt_topay')
						->from('gpf_fp_authority')
						->where('authority_no',$authority_no)
						->where('series',$series)
						->where('ac_code',$ac_code)
						->where('nominee_name !=','')
						->order_by('nom_type')
						->get()
						->result_array();
		return $res;
	}
	//Hirani
	public function get_subscribers_ledger($ac_code = '',$series = ''){
		// Calculate year
		$cur_month = date('m');
		$cur_year = date('Y');
		if($cur_month >= 4){ //april onwards
			$year = $cur_year;
		}else{
			$year = $cur_year - 1;
		}
		
		$res = $this->db->select('*')
						->from('gpf_ledger')
						->where('ac_code',$ac_code)
						->where('series',$series)
						->where('year',$year)
						->get()
						->result_array();
		return $res;
	}
	public function get_rates_of_interest(){
		$res = $this->db->select('*')
						->from('rate_of_interest')
						->order_by('int_id','desc')
						->get()
						->result_array();
		return $res;
	}
	public function get_rates_of_interest_last_15_years(){
		$year = date('Y') - 15;
		$res = $this->db->select('*')
						->from('rate_of_interest')
						->where('year(intrst_from) >=',$year)
						->order_by('intrst_to','desc')
						->get()
						->result_array();
		return $res;
	}
	public function search_rates_of_interest_by_year($year = ''){
		if($year == '') return ;
		$res = $this->db->select('*')
						->from('rate_of_interest')
						->where('year(intrst_from)',$year)
						->or_where('year(intrst_to)',$year)
						->order_by('intrst_to','asc')
						->get()
						->result_array();
		return $res;
	}
	public function ddo_registration(){
		$post =  $this->input->post(array('ddo_code','mobile'), TRUE);
		$ddo_code = $post['ddo_code'];
		$mobile = $post['mobile'];
		$res = $this->db->select('*')
						->from('ddo_master')
						->where('ddo_cd',$ddo_code)
						->get()
						->row_array();
		if(empty($res)){
			return array('success'=>false,'msg'=>'Wrong Credentials!');
		}
		if(isset($res['password']) && !empty($res['password'])){
			$msg = "You have already registered.";
			return array('success'=>false,'msg'=>$msg);
		}	
		if(isset($res['mb_no']) && empty($res['mb_no'])){
			$msg = "You do not submited your mobile no. Please submit mobile no to edpfnd-agae-wb@nic.in.";
			return array('success'=>false,'msg'=>$msg);
		}
		return array('success'=>true,'msg'=>"Reset your password",'details'=>$res);
	}
	public function ddo_forgot_password(){
		$post =  $this->input->post(array('ddo_code','mobile'), TRUE);
		$ddo_code = $post['ddo_code'];
		$mobile = $post['mobile'];
		$res = $this->db->select('*')
						->from('ddo_master')
						->where('ddo_cd',$ddo_code)
						->get()
						->row_array();
		if(empty($res)){
			return array('success'=>false,'msg'=>'Sorry! No records found.');
		}
		if(isset($res['password']) && empty($res['password'])){
			$msg = "Your account is not registered.";
			return array('success'=>false,'msg'=>$msg);
		}	
		if(isset($res['mb_no']) && empty($res['mb_no'])){
			$msg = "You do not submited your mobile no. Please submit mobile no to edpfnd-agae-wb@nic.in.";
			return array('success'=>false,'msg'=>$msg);
		}
		return array('success'=>true,'msg'=>"Reset your password",'details'=>$res);
	}
	
	public function ddo_reset_password($ddo_code='',$pass=''){
		$this->db->where('ddo_cd',$ddo_code)->update('ddo_master',array('password'=>md5($pass)));
	}
	
	public function get_ddo_files_sub_all($limit_to = 0, $series = '', $ac_code = '' ){
		$get = $this->input->get(array('sub_ac_code', 'drec_year', 'drec_month'), TRUE);
		$this->db->select('*')
						->from('ddo_files')
						->where('sub_series',$series)
						->where('sub_ac_code',$ac_code);
						
		if($get['sub_ac_code'] != ''){
			$this->db->where('sub_ac_code',$get['sub_ac_code']);
		}
		if($get['drec_year'] != ''){
			$this->db->where('drec_year',$get['drec_year']);
		}
		if($get['drec_month'] != ''){
			$this->db->where('drec_month',$get['drec_month']);
		}
		
		$this->db->order_by('ddo_rec_id','desc');
		
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function get_ddo_gpfacno_all($limit_to = 0, $users = '' ){
		$get = $this->input->get(array('sub_ac_code', 'drec_year', 'drec_month'), TRUE);
		$this->db->select('*')
						->from('ddo_files')
						->where('ddo_cd',$users)
						->where('drec_type','GPF No Allotment');
						
		if($get['sub_ac_code'] != ''){
			$this->db->where('sub_ac_code',$get['sub_ac_code']);
		}
		if($get['drec_year'] != ''){
			$this->db->where('drec_year',$get['drec_year']);
		}
		if($get['drec_month'] != ''){
			$this->db->where('drec_month',$get['drec_month']);
		}
		
		$this->db->order_by('ddo_rec_id','desc');
		
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_ddo_nominations_all($limit_to = 0, $users = '' ){
		$get = $this->input->get(array('sub_ac_code','drec_year', 'drec_month'), TRUE);
		$this->db->select('*')
						->from('ddo_files')
						->where('ddo_cd',$users)
						->where('drec_type','Nomination');
		if($get['sub_ac_code'] != ''){
			$this->db->where('sub_ac_code',$get['sub_ac_code']);
		}
		if($get['drec_year'] != ''){
			$this->db->where('drec_year',$get['drec_year']);
		}
		if($get['drec_month'] != ''){
			$this->db->where('drec_month',$get['drec_month']);
		}
		
		$this->db->order_by('ddo_rec_id','desc');
		
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
		public function get_ddo_missings_all($limit_to = 0, $users = '' ){
		$get = $this->input->get(array('sub_ac_code','drec_year', 'drec_month'), TRUE);
		$this->db->select('*')
						->from('ddo_files')
						->where('ddo_cd',$users)
						->where('drec_type','Missing Credit')
						->or_where('drec_type','Missing Debit');
						
		if($get['sub_ac_code'] != ''){
			$this->db->where('sub_ac_code',$get['sub_ac_code']);
		}
		if($get['drec_year'] != ''){
			$this->db->where('drec_year',$get['drec_year']);
		}
		if($get['drec_month'] != ''){
			$this->db->where('drec_month',$get['drec_month']);
		}
		
		$this->db->order_by('ddo_rec_id','desc');
		
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_subscriber_cur_ddo($series = '',$ac_code = ''){
		$res = $this->db->select('*')
						->from('subscriber_master')
						->where('series',$series)
						->where('ac_code',$ac_code)
						->order_by('subs_id','desc')
						->get()
						->result_array();
		return $res;
	}
	public function get_subscriber_by_id($id = ''){
		$res = $this->db->select('sm.*')
						->from('subscriber_master sm')
						->where('sm.subs_id',$id)
						->get()
						->row_array();
		return $res;
	}
	public function updatesubscriber_ddo_record($id = 0, $users = ''){
		$post = $this->input->post(array('cur_ddo','emp_code'), TRUE);	//,'ddo_remark','ddo_user','ddo_official_name','ddo_official_desig','ddo_official_contact','ddo_date'
		$update = array();
		$update['cur_ddo'] = $post['cur_ddo'];		
		$update['emp_code'] = $post['emp_code'];
/*
		$update['ddo_remark'] = $post['dept_remark'];
		$update['ddo_user'] = $users;
		$update['ddo_official_name'] = $post['dept_official_name'];
		$update['ddo_official_desig'] = $post['dept_official_desig'];
		$update['ddo_official_contact'] = $post['dept_official_contact'];
		$update['ddo_date'] = !empty($post['dept_date']) ? date('Y-m-d',strtotime($post['dept_date'])) : '';
*/		
		if(!empty($update) && $id != ''){
			$this->db->where('subs_id',$id)->update('subscriber_master',$update);	
		}
		
		return 0;
	}
	
	public function add_ddo_files_record($update){
		$this->db->insert('ddo_files',$update);
		return $this->db->insert_id();
	}
	
	public function update_ddo_files_record($id,$update){
		$this->db->where('ddo_rec_id',$id)->update('ddo_files',$update);
		return $this->db->insert_id();
	}
	
	public function get_all_ddo_documents($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('ddo_files')
				 ->order_by('ddo_rec_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('ddo_cd',$get['search']);
				$this->db->or_like('drec_month',$get['search']);
				$this->db->or_like('drec_year',$get['search']);
				$this->db->or_like('sub_series',$get['search']);
				$this->db->or_like('sub_ac_code',$get['search']);
				$this->db->or_like('drec_type',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_all_ddo_list(){
		$res = $this->db->select ('ddo_cd')
						->from('ddo_master')
						->order_by('ddo_cd','asc')
						->group_by('ddo_cd')
						->get()
						->result_array();
		return $res;
	}
	public function get_ddo_file_by_id($id=0){
		return  $this->db->select('*')
						 ->from('ddo_files')
						 ->where('ddo_rec_id',$id)
						 ->get()
						 ->row_array();
	}
	
	public function update_ddo_files_record_by_id($id=0){
		$post = $this->input->post(array('ag_remark','drecd_status','update_dt'), TRUE);
		$update = array();
		$update['ag_remark'] = $post['ag_remark'];
		$update['drecd_status'] = $post['drecd_status'];
		$update['update_dt'] = date('Y-m-d H:i:s');
		
		if(!empty($update) && $id != ''){
			$this->db->where('ddo_rec_id',$id)->update('ddo_files',$update);
		}
	}

	public function get_all_bos_signatures($limit_to=0,$office = 'AGAE',$wing = 'administration'){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('gpf_series_signature')
				 ->order_by('statement_year','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('series',$get['search']);
				$this->db->or_like('statement_year',$get['search']);
				$this->db->or_like('officer_name',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}

	public function getSignatureTagByID($id = 0){
		$res = $this->db->select('*')->from('gpf_series_signature')->where('sec_off_id',$id)->get()->row_array();
		return $res;
	}
	public function addSignatureTag($update_array=array()){
		if(empty($update_array)){return 0;} 
		$this->db->insert('gpf_series_signature',$update_array);
		return $this->db->insert_id();
	}
	public function updateSignatureTag($id = 0, $update_array=array()){
		if(empty($update_array)){return $id;} 
		$this->db->where('sec_off_id',$id)->update('gpf_series_signature',$update_array);
		return $id;
	}
	
	public function get_last_signature_id(){
		$res = $this->db->select ('max(sec_off_id) max_id')
						->from('gpf_series_signature')
						->get()
						->row_array();
		return $res;
	}
	public function get_branch_officer_sign($series = '',$year = ''){
		$res = $this->db->select ('officer_name,officer_name_hindi,sign_tag')
						->from('gpf_series_signature')
						->where('series',$series)
						->where('statement_year',$year)
						->get()
						->row_array();
		return $res;
	}
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
		public function get_transfer_master($limit_to=0,$office = 'AGAE',$wing = 'administration'){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('section_transfer_master')
				 ->where('transf_group','FUND')
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
				 ->where('order_group','FUND')
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
	public function get_admin_section_allotted($limit_to = 0, $office = 'AGAE', $id = ''){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('e.*,a.*')
				 ->from('section_allotment_details e')
				 ->join('section_allotment_to_emp a','a.empid_inch_bo = e.empid','right')
				 ->where('e.present_group','FUND')
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
	
	
	public function getmh($postData){
		$response = array();
		if(isset($postData['mh']) ){
			$this->db->select('*');
			$wherecond = "((mjrhddesc like '%" . $postData['mh'] . "%') OR (mjrhd like '%" . $postData['mh'] . "%'))";
			$this->db->where($wherecond);
			$records = $this->db->get('mjrhead')->result();
			foreach($records as $row ){
				$response[] = array("value"=>$row->mjrhd,"label"=>$row->mjrhddesc);
			}
		}
		return $response;
	}
	
	public function gettry($postData){
		$response = array();
		if(isset($postData['tryt']) ){
			$this->db->select('*');
			$wherecond = "((tr_cd like '%" . $postData['tryt'] . "%') OR (tr_nm like '%" . $postData['tryt'] . "%'))";
			$this->db->where($wherecond);
			$records = $this->db->get('treasury_master')->result();
			foreach($records as $row ){
				$response[] = array("value"=>$row->tr_cd,"label"=>$row->tr_nm);
			}
		}
		return $response;
	}
	
	public function getddo($postData){
		$response = array();
		if(isset($postData['ddo']) ){
			$this->db->select('*');
			$wherecond = "((ddo_cd like '%" . $postData['ddo'] . "%') OR (ddo_desc like '%" . $postData['ddo'] . "%'))";
			$this->db->where($wherecond);
			$records = $this->db->get('ddo_master')->result();
			foreach($records as $row ){
				$response[] = array("value"=>$row->ddo_cd,"label"=>$row->ddo_desc);
			}
		}
		return $response;
	}
	public function get_mjh_head_list($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('mjrhead')
				 ->order_by('mjrhd','asc');				 
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->where('mjrhd',$get['search']);
				$this->db->or_where('mjrhddesc',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}	
	/*
	public function get_missingcr($limit_to=0){
		$get = $this->input->get(array('search','series','accno'), TRUE);
		$ord = 'STR_TO_DATE(concat_ws("01/" , misscrdr), "%d/%m/%Y")';
		$this->db->select('*')
				 ->from('missingcr')
				 ->order_by('series','asc')
				 ->order_by('accno','asc')
				 ->order_by('misscrdr','desc')
				 ->order_by('misscdmnth','desc');				
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->where('series',$get['search']);
				$this->db->or_where('accno',$get['search']);
				$this->db->or_where('misscrdr',$get['search']);
				$this->db->or_where('misscdmnth',$get['search']);
				$this->db->or_where('remarks',$get['search']);
			$this->db->group_end();
		}
		if($get['series'] != ''){
			$this->db->where('series',$get['series']);
		}
		if($get['accno'] != ''){
			$this->db->where('accno',$get['accno']);
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	*/
	//Hirani
	public function get_missingcr($limit_to=0){
		$get = $this->input->get(array('search','series','accno'), TRUE);
		$ord = 'STR_TO_DATE(concat_ws("01/" , misscrdr), "%d/%m/%Y")';
		$this->db->select('*')
				 ->from('missingcr')
				 ->where('crdr_flag','N')
				 ->order_by("'$ord'",'desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->where('series',$get['search']);
				$this->db->or_where('accno',$get['search']);
				$this->db->or_where('misscrdr',$get['search']);
				$this->db->or_where('misscdmnth',$get['search']);
				$this->db->or_where('remarks',$get['search']);
			$this->db->group_end();
		}
		if($get['series'] != ''){
			$this->db->where('series',$get['series']);
		}
		if($get['accno'] != ''){
			$this->db->where('accno',$get['accno']);
		}

	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
//Hirani
	public function get_missingcract($limit_to=0){
		$get = $this->input->get(array('search','date_filter','vstatus'), TRUE);
		$dt = date('Y-m-d');
		$dt_prev = date('Y-m-d',(strtotime('-1 day', strtotime($dt))));
		$this->db->select('*')
				 ->from('missingcr_reply')
				 ->where('reply_sts !=','C')
				 ->where('reply_sts !=','R')
//				 ->where('date(reply_date) = ', $dt_prev)
//				 ->where('date(reply_date) = ','2022-01-01')
				 ->order_by('id','desc');				 
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->where('series',$get['search']);
				$this->db->or_where('accno',$get['search']);
				$this->db->or_where('misscrdr',$get['search']);
				$this->db->or_where('misscdmnth',$get['search']);
			$this->db->group_end();
		}
		if($get['date_filter'] != ''){
			$find_date = date('Y-m-d',strtotime($get['date_filter']));
			$this->db->where('date(reply_date) = ',$find_date);
		}
		if($get['vstatus'] !=''){
			$this->db->where('reply_sts',$get['vstatus']);
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function get_missingcract_dt($limit_to=0, $reply_date = ''){
		$post = $this->input->post(array('search'), TRUE);
		$this->db->select('*')
				 ->from('missingcr_reply')
				 ->where('reply_sts !=','C')
				 ->where('reply_sts !=','R')
				 ->where('date(reply_date) = ', $reply_date)
				 ->order_by('id','desc');				 
		if($post['search'] != ''){
			$this->db->group_start();
				$this->db->where('series',$post['search']);
				$this->db->or_where('accno',$post['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function get_missingcract_all($limit_to=0){
		$get = $this->input->get(array('search','date_filter','vstatus'), TRUE);
		$this->db->select('*')
				 ->from('missingcr_reply')
				 ->order_by('id','desc');				 
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->where('series',$get['search']);
				$this->db->or_where('accno',$get['search']);
				$this->db->or_where('misscrdr',$get['search']);
				$this->db->or_where('misscdmnth',$get['search']);
			$this->db->group_end();
		}
		if($get['date_filter'] != ''){
			$find_date = date('Y-m-d',strtotime($get['date_filter']));
			$this->db->where('date(reply_date) = ',$find_date);
		}
		if($get['vstatus'] != ''){
			$this->db->where('reply_sts',$get['vstatus']);
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}

	public function get_missing_reports_download(){
		$post = $this->input->post(array('date_from','date_to','rstatus'), TRUE);

		$res = $this->db->select('Series,AccountNo,Missing_Month,Major_Head,Pay_Head,Treasury_Code,Treasury,DDO_Code,DDO,Subs_Amount,Refund_Amount,TV_No,TV_Date,Status,Subscriber_Remarks,Office_Remarks,Reply_Dt,Clear_Dt') 
								//select('fst_nme,mid_nme,lst_nme,dob,sex,series,ac_code,mhcd,emp_code,mobile_no,email_id')
						->from('missing_action_view');				
		if($post['date_from'] != ''){
			$f_date = date('Y-m-d',strtotime($post['date_from']));
			$this->db->where('date(Clear_Dt) >= ',$f_date);
		}
		if($post['date_to'] != ''){
			$t_date = date('Y-m-d',strtotime($post['date_to']));
			$this->db->where('date(Clear_Dt) <= ',$t_date);
		}
		if($post['rstatus'] != ''){
			$this->db->where('Status',$post['rstatus']);
		}
		$res = $this->db->order_by('date(Clear_Dt)','asc')
				->get()
				->result_array();
		return $res;		
	}
/*	
	public function get_missing_reports_download(){
		$post = $this->input->post(array('date_from','date_to','rstatus'), TRUE);

		$res = $this->db->select('*') 
						->from('agb_missingcr_reply');				
		if($post['date_from'] != ''){
			$f_date = date('Y-m-d',strtotime($post['date_from']));
			$this->db->where('date(clear_date) >= ',$f_date);
		}
		if($post['date_to'] != ''){
			$t_date = date('Y-m-d',strtotime($post['date_to']));
			$this->db->where('date(clear_date) <= ',$t_date);
		}
		if($post['rstatus'] != ''){
			$this->db->where('reply_sts',$post['rstatus']);
		}
		$res = $this->db->order_by('date(clear_date)','asc')
				->get()
				->result_array();
		return $res;	
	}	
*/

//digilocker function for ePPO,eGPO and eCPO
	public function get_ppo_gpo_cpo_certificate($application_no = ''){
        $res = $this->db->select('*')
                        ->from('pension_case')
                        ->where('application_no',$application_no)
                        ->get()
                        ->row_array();
        return $res;
    }
	
	
	
	
}// End of class