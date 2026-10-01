<?php
class Accounts_model extends CI_Model {

	function __construct(){
		parent::__construct();
		if($this->session->userdata('language_id')){
			$this->language_id = $this->session->userdata('language_id');
		}else{
			$this->language_id = 1;
		}
	}
	public function department_login($code = '',$pass = ''){
		$res = $this->db->select('*')
						->from('department_master')
						->where('users',$code)
						->where('password',md5($pass))
						->get()
						->row_array();
		return $res;
	}
	public function update_department_last_login($code = ''){
		$post = $this->input->post(array('last_login'), TRUE);
		$update = array();
		$update['last_login'] = date('Y-m-d H:i:s');	
		if(!empty($update)){
			$this->db->where('users',$code)->update('department_master',$update);
			return true;
		}
		return false;
	}
	public function get_department_profile($code = ''){
		$res = $this->db->select('*')
						->from('department_master')
						->where('grnt_cd',$code)
						->get()
						->row_array();
		return $res;
	}
	public function get_department_recon_file($code = ''){
		$res = $this->db->select('*')
						->from('department_master')
						->where('users',$code)
						->get()
						->row_array();
		return $res;
	}
	public function update_department_profile($code = ''){
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
			$this->db->where('grnt_cd',$code)->update('department_master',$update);
			return true;
		}
		return false;
	}
	public function treasury_login($code = '',$pass = ''){
		$res = $this->db->select('*')
						->from('treasury_master')
						->where('users',$code)
						->where('password',md5($pass))
						->get()
						->row_array();
		return $res;
	}
	public function update_treasury_last_login($code = ''){
		$post = $this->input->post(array('last_login'), TRUE);
		$update = array();
		$update['last_login'] = date('Y-m-d H:i:s');	
		if(!empty($update)){
			$this->db->where('users',$code)->update('treasury_master',$update);
			return true;
		}
		return false;
	}
	public function get_treasury_profile($code = ''){
		$res = $this->db->select('*')
						->from('treasury_master')
						->where('users',$code)
						->get()
						->row_array();
		return $res;
	}
	public function update_treasury_profile($code = ''){
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
			$this->db->where('users',$code)->update('treasury_master',$update);
			return true;
		}
		return false;
	}
	public function department_registration(){
		$post =  $this->input->post(array('users','mobile'), TRUE);
		$users = $post['users'];
		$mobile = $post['mobile'];
		$res = $this->db->select('*')
						->from('department_master')
						->where('users',$users)
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
			$msg = "You do not submited your mobile no. Please submit mobile no to edpacc-agae-wb@nic.in.";
			return array('success'=>false,'msg'=>$msg);
		}
		return array('success'=>true,'msg'=>"Reset your password",'details'=>$res);
	}
	public function department_forgot_password(){
		$post =  $this->input->post(array('users','mobile'), TRUE);
		$users = $post['users'];
		$mobile = $post['mobile'];
		$res = $this->db->select('*')
						->from('department_master')
						->where('users',$users)
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
			$msg = "You do not submited your mobile no. Please submit mobile no to edpacc-agae-wb@nic.in.";
			return array('success'=>false,'msg'=>$msg);
		}
		return array('success'=>true,'msg'=>"Reset your password",'details'=>$res);
	}
	public function department_reset_password($users='',$pass=''){
		$this->db->where('users',$users)->update('department_master',array('password'=>md5($pass)));
	}
	public function treasury_registration(){
		$post =  $this->input->post(array('users','mobile'), TRUE);
		$users = $post['users'];
		$mobile = $post['mobile'];
		$res = $this->db->select('*')
						->from('treasury_master')
						->where('users',$users)
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
			$msg = "You do not submited your mobile no. Please submit mobile no to edpacc-agae-wb@nic.in.";
			return array('success'=>false,'msg'=>$msg);
		}
		return array('success'=>true,'msg'=>"Reset your password",'details'=>$res);
	}
	public function treasury_forgot_password(){
		$post =  $this->input->post(array('users','mobile'), TRUE);
		$users = $post['users'];
		$mobile = $post['mobile'];
		$res = $this->db->select('*')
						->from('treasury_master')
						->where('users',$users)
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
			$msg = "You do not submited your mobile no. Please submit mobile no to edpacc-agae-wb@nic.in.";
			return array('success'=>false,'msg'=>$msg);
		}
		return array('success'=>true,'msg'=>"Reset your password",'details'=>$res);
	}
	public function treasury_reset_password($treasury_code='',$pass=''){
		$this->db->where('users',$treasury_code)->update('treasury_master',array('password'=>md5($pass)));
	}
	
// department******************	
	public function get_department_civil_accounts($limit_to = 0 ){
		$get = $this->input->get(array('dmonth', 'dyear', 'details'), TRUE);
		$this->db->select('*')
				 ->from('department_files')
				 ->where('order_type','Civil Accounts');
		if($get['dmonth'] != ''){
			$this->db->where('dmonth',$get['dmonth']);
		}
		if($get['dyear'] != ''){
			$this->db->where('dyear',$get['dyear']);
		}
		if($get['details'] != ''){
			$this->db->like('details',$get['details']);
		}
		$this->db->order_by('order_date','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}	
	public function get_department_expenditure_report($limit_to = 0 ){
		$get = $this->input->get(array('dmonth', 'dyear', 'details'), TRUE);
		$this->db->select('*')
				 ->from('department_files')
				 ->where('order_type','Expenditure');
		if($get['dmonth'] != ''){
			$this->db->where('dmonth',$get['dmonth']);
		}
		if($get['dyear'] != ''){
			$this->db->where('dyear',$get['dyear']);
		}
		if($get['details'] != ''){
			$this->db->like('details',$get['details']);
		}
		$this->db->order_by('order_date','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}	
	public function get_department_appreciation_note($limit_to = 0 ){
		$get = $this->input->get(array('dmonth', 'dyear', 'details'), TRUE);
		$this->db->select('*')
				 ->from('department_files')
				 ->where('order_type','Appreciation Note');
		if($get['dmonth'] != ''){
			$this->db->where('dmonth',$get['dmonth']);
		}
		if($get['dyear'] != ''){
			$this->db->where('dyear',$get['dyear']);
		}
		if($get['details'] != ''){
			$this->db->like('details',$get['details']);
		}
		$this->db->order_by('order_date','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}	
	
	public function get_department_office_orders($limit_to = 0 ){
		$get = $this->input->get(array('date_from', 'date_to', 'dyear', 'details'), TRUE);
		$this->db->select('*')
				 ->from('department_files')
				 ->where('order_type','Order');
		if($get['date_from'] != ''){
			$f_date = date('Y-m-d',strtotime($get['date_from']));
			$this->db->where('date(order_date) >= ',$f_date);
		}
		if($get['date_to'] != ''){
			$t_date = date('Y-m-d',strtotime($get['date_to']));
			$this->db->where('date(order_date) <= ',$t_date);
		}
		if($get['dyear'] != ''){
			$this->db->where('dyear',$get['dyear']);
		}
		if($get['details'] != ''){
			$this->db->like('details',$get['details']);
		}
		$this->db->order_by('order_date','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}	
	
	public function get_department_office_documents($limit_to = 0 ,$dusers = ''){
		$get = $this->input->get(array('date_from', 'date_to', 'dyear', 'details'), TRUE);
		$this->db->select('*')
				 ->from('department_files df')
				 ->join('department_files_to_dept u','u.dfiles_id = df.file_id')
				 ->where('u.dusers',$dusers)
				 ->where('order_type','Document');
		if($get['date_from'] != ''){
			$f_date = date('Y-m-d',strtotime($get['date_from']));
			$this->db->where('date(order_date) >= ',$f_date);
		}
		if($get['date_to'] != ''){
			$t_date = date('Y-m-d',strtotime($get['date_to']));
			$this->db->where('date(order_date) <= ',$t_date);
		}
		if($get['dyear'] != ''){
			$this->db->where('dyear',$get['dyear']);
		}
		if($get['details'] != ''){
			$this->db->like('details',$get['details']);
		}
		$this->db->order_by('order_date','desc');
		
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}	
	
	public function get_department_reconciliaion_documents($limit_to = 0 ,$dusers = ''){
		$get = $this->input->get(array('date_from', 'date_to', 'dyear', 'details'), TRUE);
		$this->db->select('*')
				 ->from('department_files df')
				 ->join('department_files_to_dept u','u.dfiles_id = df.file_id')
				 ->where('u.dusers',$dusers)
				 ->where('order_type','Reconciliation');
		if($get['date_from'] != ''){
			$f_date = date('Y-m-d',strtotime($get['date_from']));
			$this->db->where('date(order_date) >= ',$f_date);
		}
		if($get['date_to'] != ''){
			$t_date = date('Y-m-d',strtotime($get['date_to']));
			$this->db->where('date(order_date) <= ',$t_date);
		}
		if($get['dyear'] != ''){
			$this->db->where('dyear',$get['dyear']);
		}
		if($get['details'] != ''){
			$this->db->like('details',$get['details']);
		}
		$this->db->order_by('order_date','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}	
	public function fetch_dept_records_by_id($id = ''){
		$res = $this->db->select('df.*')
						->from('department_files df')
						->where('df.file_id',$id)
						->get()
						->row_array();
		return $res;
	}
	public function fetch_dept_investment_by_id($id = ''){
		$res = $this->db->select('df.*')
						->from('department_investment df')
						->where('df.recd_id',$id)
						->get()
						->row_array();
		return $res;
	}
	public function fetch_dept_gia_by_id($id = ''){
		$res = $this->db->select('df.*')
						->from('department_gia df')
						->where('df.recd_id',$id)
						->get()
						->row_array();
		return $res;
	}
	public function fetch_dept_loan_advance_by_id($id = ''){
		$res = $this->db->select('df.*')
						->from('department_loan_advance df')
						->where('df.la_recd_id',$id)
						->get()
						->row_array();
		return $res;
	}
	
	public function fetch_try_obsuspense_records_by_id($id = ''){
		$res = $this->db->select('obs.*')
						->from('treasury_obsuspense obs')
						->where('obs.ob_recd_id',$id)
						->get()
						->row_array();
		return $res;
	}
		
	public function fetch_try_correction_slip_records_by_id($id = ''){
		$res = $this->db->select('tcs.*')
						->from('treasury_correction_slips tcs')
						->where('tcs.cs_record_id',$id)
						->get()
						->row_array();
		return $res;
	}
	public function fetch_try_misclassification_records_by_id($id = ''){
		$res = $this->db->select('tm.*')
						->from('treasury_misclassification tm')
						->where('tm.mc_rec_id',$id)
						->get()
						->row_array();
		return $res;
	}
	
	public function update_dept_reconciliation_records($id = 0, $users = '', $grnt_cd = ''){
		$post = $this->input->post(array('dept_remark','dept_attachment','action_status','dept_user','dept_code','dept_official_name','dept_official_desig','dept_official_contact','dept_date'), TRUE);
		$update = array();
/*		
		if($post['dept_attachment'] != null){
			$update['dept_attachment'] = $post['dept_attachment'];
		}

		if($post['dept_remark'] != ''){
			$update['dept_remark'] = $post['dept_remark'];
		}else{
			$update['dept_remark'] = 'Agreed';	
		}
*/		
		if($post['dept_attachment'] !== ''){
			$update['dept_attachment'] = $post['dept_attachment'];
		}
		
		$update['action_status'] = $post['action_status'];
		$update['dept_remark'] = $post['dept_remark'];
		$update['dept_user'] = $users;
		$update['dept_code'] = $grnt_cd;
		$update['dept_official_name'] = $post['dept_official_name'];
		$update['dept_official_desig'] = $post['dept_official_desig'];
		$update['dept_official_contact'] = $post['dept_official_contact'];
		$update['dept_date'] = !empty($post['dept_date']) ? date('Y-m-d',strtotime($post['dept_date'])) : '';
		
		if(!empty($update) && $id != ''){
			$this->db->where('file_id',$id)->update('department_files',$update);	
		}
		
		return 0;
	}
	public function get_department_warnings_documents($limit_to = 0 ,$dusers = ''){
		$get = $this->input->get(array('date_from', 'date_to', 'dyear', 'details'), TRUE);
		$this->db->select('*')
				 ->from('department_files df')
				 ->join('department_files_to_dept u','u.dfiles_id = df.file_id')
				 ->where('u.dusers',$dusers)
				 ->where('order_type','Warning Slip');
		if($get['date_from'] != ''){
			$f_date = date('Y-m-d',strtotime($get['date_from']));
			$this->db->where('date(order_date) >= ',$f_date);
		}
		if($get['date_to'] != ''){
			$t_date = date('Y-m-d',strtotime($get['date_to']));
			$this->db->where('date(order_date) <= ',$t_date);
		}
		if($get['dyear'] != ''){
			$this->db->where('dyear',$get['dyear']);
		}
		if($get['details'] != ''){
			$this->db->like('details',$get['details']);
		}
		$this->db->order_by('order_date','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}	
	/*	FOR PDF UPLOAD OPTION

	public function get_department_acdc_bills_documents($limit_to = 0 ,$dusers = ''){
		$get = $this->input->get(array('dmonth', 'dyear', 'details'), TRUE);
		$this->db->select('*')
				 ->from('department_files df')
				 ->join('department_files_to_dept u','u.dfiles_id = df.file_id')
				 ->where('u.dusers',$dusers)
				 ->where('order_type','AC DC Bills');
		if($get['dmonth'] != ''){
			$this->db->where('dmonth',$get['dmonth']);
		}
		if($get['dyear'] != ''){
			$this->db->where('dyear',$get['dyear']);
		}
		if($get['details'] != ''){
			$this->db->like('details',$get['details']);
		}
		$this->db->order_by('order_date','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}	
*/
	public function get_department_acdc_bills_documents($limit_to = 0, $grnt_cd = '' ){
		$get = $this->input->get(array('fin_yr', 'tr_mn','tv_tc_no','ddo',), TRUE);
		$this->db->select('*')
				 ->from('department_acdc')
				 ->where('grnt_cd',$grnt_cd);
//				 ->or_where('grnt_cd','00');
		if($get['fin_yr'] != ''){
			$this->db->where('fin_yr',$get['fin_yr']);
		}
		if($get['tr_mn'] != ''){
			$this->db->where('tr_mn',$get['tr_mn']);
		}
		if($get['tv_tc_no'] != ''){
			$this->db->where('tv_tc_no',$get['tv_tc_no']);
		}
		if($get['ddo'] != ''){
			$this->db->like('ddo',$get['ddo']);
		}
		$this->db->order_by('grnt_cd','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_department_investment($limit_to = 0, $grnt_cd = '' ){
		$get = $this->input->get(array('yr_ta', 'tr_mn','tv_tc_no','ddo',), TRUE);
		$this->db->select('*')
				 ->from('department_investment')
				 ->where('grnt_cd',$grnt_cd);
		if($get['yr_ta'] != ''){
			$this->db->where('yr_ta',$get['yr_ta']);
		}
		if($get['tr_mn'] != ''){
			$this->db->where('tr_mn',$get['tr_mn']);
		}
		if($get['tv_tc_no'] != ''){
			$this->db->where('tv_tc_no',$get['tv_tc_no']);
		}
		if($get['ddo'] != ''){
			$this->db->like('ddo',$get['ddo']);
		}
		$this->db->order_by('recd_id','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function update_dept_investment_records($id = 0, $users = ''){
		$post = $this->input->post(array('invst_category','share_no','share_face_val','govt_percentagee','dividend_recpt','interest_recpt','dept_remark','dept_user','dept_official_name','dept_official_desig','dept_official_contact','dept_date'), TRUE);
		$update = array();
		$update['invst_category'] = $post['invst_category'];
		$update['share_no'] = $post['share_no'];
		$update['share_face_val'] = $post['share_face_val'];
		$update['govt_percentagee'] = $post['govt_percentagee'];
		$update['dividend_recpt'] = $post['dividend_recpt'];
		$update['interest_recpt'] = $post['interest_recpt'];
		$update['dept_remark'] = $post['dept_remark'];
		$update['dept_user'] = $users;
		$update['dept_official_name'] = $post['dept_official_name'];
		$update['dept_official_desig'] = $post['dept_official_desig'];
		$update['dept_official_contact'] = $post['dept_official_contact'];
		$update['dept_date'] = !empty($post['dept_date']) ? date('Y-m-d',strtotime($post['dept_date'])) : '';
		$update['update_dt'] = date('Y-m-d H:i:s');
		if(!empty($update) && $id != ''){
			$this->db->where('recd_id',$id)->update('department_investment',$update);	
		}
		
		return 0;
	}
	
	public function get_department_gia_uc($limit_to = 0, $grnt_cd = '' ){
		$get = $this->input->get(array('fin_yr', 'tr_mn','tv_tc_no','ddo',), TRUE);
		$this->db->select('*')
				 ->from('department_gia')
				 ->where('grnt_cd',$grnt_cd);
		if($get['fin_yr'] != ''){
			$this->db->where('fin_yr',$get['fin_yr']);
		}
		if($get['tr_mn'] != ''){
			$this->db->where('tr_mn',$get['tr_mn']);
		}
		if($get['tv_tc_no'] != ''){
			$this->db->where('tv_tc_no',$get['tv_tc_no']);
		}
		if($get['ddo'] != ''){
			$this->db->like('ddo',$get['ddo']);
		}
		$this->db->order_by('fin_yr','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function update_dept_gia_records($id = 0, $users = ''){
		$post = $this->input->post(array('credit_to_bank','uc_ref_no','uc_ref_date','utilised_amt','dept_remark','dept_user','dept_official_name','dept_official_desig','dept_official_contact','dept_date'), TRUE);
		$update = array();
		$update['credit_to_bank'] = !empty($post['credit_to_bank']) ? $post['credit_to_bank']: '';
		$update['uc_ref_no'] = !empty($post['uc_ref_no']) ? $post['uc_ref_no']: '';
		$update['uc_ref_date'] = !empty($post['uc_ref_date']) ? date('Y-m-d',strtotime($post['uc_ref_date'])) : '';
		$update['utilised_amt'] = !empty($post['utilised_amt']) ? $post['utilised_amt']: '';
		$update['dept_remark'] = !empty($post['dept_remark']) ? $post['dept_remark']: '';
		$update['dept_user'] = $users;
		$update['dept_official_name'] = $post['dept_official_name'];
		$update['dept_official_desig'] = $post['dept_official_desig'];
		$update['dept_official_contact'] = $post['dept_official_contact'];
		$update['dept_date'] = !empty($post['dept_date']) ? date('Y-m-d',strtotime($post['dept_date'])) : '';
		
		if(!empty($update) && $id != ''){
			$this->db->where('recd_id',$id)->update('department_gia',$update);	
		}
		
		return 0;
	}
	
	
	public function get_department_loan_advance($limit_to = 0, $grnt_cd = '' ){
		$get = $this->input->get(array('fin_yr', 'tr_mn','tv_tc_no','ddo',), TRUE);
		$this->db->select('*')
				 ->from('department_loan_advance')
				 ->where('grnt_cd',$grnt_cd);
		if($get['fin_yr'] != ''){
			$this->db->where('fin_yr',$get['fin_yr']);
		}
		if($get['tr_mn'] != ''){
			$this->db->where('tr_mn',$get['tr_mn']);
		}
		if($get['tv_tc_no'] != ''){
			$this->db->where('tv_tc_no',$get['tv_tc_no']);
		}
		if($get['ddo'] != ''){
			$this->db->like('ddo',$get['ddo']);
		}
		$this->db->order_by('la_recd_id','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function update_dept_loan_adv_records($id = 0, $users = ''){
		$records = $this->input->post(array('dept_remark','dept_attachment','dept_user','dept_official_name','dept_official_desig','dept_official_contact','dept_date'), TRUE);
		
		$update = array();
		if($records['dept_remark'] != ''){$update['dept_remark'] = $records['dept_remark'];}
		if($records['dept_attachment'] != ''){$update['dept_attachment'] = $records['dept_attachment'];}
		$update['dept_user'] = $users;
		$update['dept_official_name'] = $records['dept_official_name'];
		$update['dept_official_desig'] = $records['dept_official_desig'];
		$update['dept_official_contact'] = $records['dept_official_contact'];
		$update['dept_date'] = !empty($records['dept_date']) ? date('Y-m-d',strtotime($records['dept_date'])) : '';		
		$update['update_dt'] = date('Y-m-d H:i:s');
		
		if(!empty($update) && $id != ''){
			$this->db->where('la_recd_id',$id)->update('department_loan_advance',$update);	
		}
		
		return 0;
	}
	public function get_all_demand_no_list(){
		$res = $this->db->select ('grnt_cd')
						->from('department_master')
						->order_by('grnt_cd','asc')
						->group_by('grnt_cd')
						->get()
						->result_array();
		return $res;
	}
	public function get_all_invst_fin_yr_list(){
		$res = $this->db->select ('yr_ta')
						->from('department_investment')
						->order_by('yr_ta','asc')
						->group_by('yr_ta')
						->get()
						->result_array();
		return $res;
	}
	public function get_all_acdc_fin_yr_list(){
		$res = $this->db->select ('fin_yr')
						->from('department_acdc')
						->order_by('fin_yr','asc')
						->group_by('fin_yr')
						->get()
						->result_array();
		return $res;
	}
	public function get_all_gia_fin_yr_list(){
		$res = $this->db->select ('fin_yr')
						->from('department_gia')
						->order_by('fin_yr','asc')
						->group_by('fin_yr')
						->get()
						->result_array();
		return $res;
	}
	
	public function get_all_obsuspense_fin_yr_list(){
		$res = $this->db->select ('fin_year')
						->from('treasury_obsuspense')
						->order_by('fin_year','asc')
						->group_by('fin_year')
						->get()
						->result_array();
		return $res;
	}
	
	public function get_all_misclassification_fin_yr_list(){
		$res = $this->db->select ('yr_ta')
						->from('treasury_misclassification')
						->order_by('yr_ta','asc')
						->group_by('yr_ta')
						->get()
						->result_array();
		return $res;
	}
	public function get_treasury_name($users=''){
		$res = $this->db->select ('tr_nm')
						->from('treasury_master')
						->where('tr_cd',$users)
						->order_by('tr_nm','asc')
						->group_by('tr_nm')
						->get()
						->result_array();
		return $res;
	}
	public function get_all_district_list(){
		$res = $this->db->select ('dist_name')
						->from('district_master')
						->order_by('dist_name','asc')
						->group_by('dist_name')
						->get()
						->result_array();
		return $res;
	}
	public function get_all_treasury_list(){
		$res = $this->db->select ('tr_nm')
						->from('treasury_master')
						->order_by('tr_nm','asc')
						->group_by('tr_nm')
						->get()
						->result_array();
		return $res;
	}
	public function get_all_treasury_code_list(){
		$res = $this->db->select ('tr_cd')
						->from('treasury_master')
						->order_by('tr_cd','asc')
						->group_by('tr_cd')
						->get()
						->result_array();
		return $res;
	}
	public function get_all_treasury_report_list(){
		$res = $this->db->select ('report_type')
						->from('treasury_report')
						->order_by('report_type','asc')
						->group_by('report_type')
						->get()
						->result_array();
		return $res;
	}
	public function get_investment_download($office_code = 'AGAE',$status='Active'){
		$post = $this->input->post(array('grnt_cd','fin_yr','tr_mn'), TRUE);
		
		$res = $this->db->select('em.*')
						->from('department_investment em');
//						->where('em.status',$status);
		if($post['grnt_cd'] != ''){
			$this->db->where('em.grnt_cd',$post['grnt_cd']);
		}
		if($post['fin_yr'] != ''){
			$this->db->where('em.fin_yr',$post['fin_yr']);
		}
		if($post['tr_mn'] != ''){
			$this->db->where('em.tr_mn',$post['tr_mn']);
		}
		
		$res = $this->db->order_by('em.grnt_cd','asc')
						->get()
						->result_array();
		return $res;
	}		
	public function get_gia_download($office_code = 'AGAE',$status='Active'){
		$post = $this->input->post(array('grnt_cd','fin_yr','tr_mn'), TRUE);
		
		$res = $this->db->select('em.*')
						->from('department_gia em');
//						->where('em.status',$status);
		if($post['grnt_cd'] != ''){
			$this->db->where('em.grnt_cd',$post['grnt_cd']);
		}
		if($post['fin_yr'] != ''){
			$this->db->where('em.fin_yr',$post['fin_yr']);
		}
		if($post['tr_mn'] != ''){
			$this->db->where('em.tr_mn',$post['tr_mn']);
		}
		
		$res = $this->db->order_by('em.grnt_cd','asc')
						->get()
						->result_array();
		return $res;
	}	
	public function get_treasury_review_report($limit_to = 0 ){
		$post = $this->input->post(array('dyear'), TRUE);
		$this->db->select('*')
						->from('treasury_orders')
						->where('order_type','Treasury Review Report');
		
		if($post['dyear'] != ''){
			$this->db->where('dyear',$post['dyear']);
		}
		
		$this->db->order_by('file_id','desc');
		
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}

	public function get_treasury_office_orders($limit_to = 0 ){
		$get = $this->input->get(array('date_from','date_to','dyear','details'), TRUE);
		$this->db->select('*')
						->from('treasury_orders')
						->where('order_type','All Circular');
		
		if($get['date_from'] != ''){
			$f_date = date('Y-m-d',strtotime($get['date_from']));
			$this->db->where('date(order_date) >= ',$f_date);
		}
		if($get['date_to'] != ''){
			$t_date = date('Y-m-d',strtotime($get['date_to']));
			$this->db->where('date(order_date) <= ',$t_date);
		}
		if($get['dyear'] != ''){
			$this->db->where('dyear',$get['dyear']);
		}
		if($get['details'] != ''){
			$this->db->like('details',$get['details']);
		}
		
		$this->db->order_by('file_id','desc');
		
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function get_treasury_office_documents($limit_to = 0, $tusers = '' ){
		$get = $this->input->get(array('date_from','date_to','dyear','details'), TRUE);
		$this->db->select('*')
						->from('treasury_orders ot')
						->join('treasury_orders_to_try e','e.tfiles_id = ot.file_id')
						->where('e.tusers',$tusers)
						->where('order_type','Document');
		if($get['date_from'] != ''){
			$f_date = date('Y-m-d',strtotime($get['date_from']));
			$this->db->where('date(order_date) >= ',$f_date);
		}
		if($get['date_to'] != ''){
			$t_date = date('Y-m-d',strtotime($get['date_to']));
			$this->db->where('date(order_date) <= ',$t_date);
		}
		if($get['dyear'] != ''){
			$this->db->where('dyear',$get['dyear']);
		}
		if($get['details'] != ''){
			$this->db->like('details',$get['details']);
		}
		
		$this->db->order_by('file_id','desc')
				 ->group_by('ot.file_id');
		
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_treasury_office_matrix($limit_to = 0, $tusers = '' ){
		$get = $this->input->get(array('dmonth','dyear','details'), TRUE);
		$this->db->select('*')
						->from('treasury_orders ot')
						->join('treasury_orders_to_try e','e.tfiles_id = ot.file_id')
						->where('e.tusers',$tusers)
						->where('order_type','Document');

		if($get['dmonth'] != ''){
			$this->db->where('dmonth',$get['dmonth']);
		}
		if($get['dyear'] != ''){
			$this->db->where('dyear',$get['dyear']);
		}
		if($get['details'] != ''){
			$this->db->like('details',$get['details']);
		}
		
		$this->db->order_by('file_id','desc')
				 ->group_by('ot.file_id');
		
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_treasury_office_inspection_report($limit_to = 0, $tusers = '' ){
		$post = $this->input->post(array('dmonth','dyear'), TRUE);
		$this->db->select('*')
						->from('treasury_orders ot')
						->join('treasury_orders_to_try e','e.tfiles_id = ot.file_id')
						->where('e.tusers',$tusers)
						->where('order_type','Inspection Report');
		if($post['dmonth'] != ''){
			$this->db->where('dmonth',$post['dmonth']);
		}
		if($post['dyear'] != ''){
			$this->db->where('dyear',$post['dyear']);
		}
		$this->db->order_by('file_id','desc')
				 ->group_by('ot.file_id');
		
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_treasury_reports_all($limit_to = 0, $users = '' ){
		$get = $this->input->get(array('report_year', 'report_month'), TRUE);
		$this->db->select('*')
						->from('treasury_report')
						->where('tr_cd',$users);
						
		if($get['report_year'] != ''){
			$this->db->where('report_year',$get['report_year']);
		}
		if($get['report_month'] != ''){
			$this->db->where('report_month',$get['report_month']);
		}
		
		$this->db->order_by('report_id','desc');
		
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function get_tresury_obsuspense_records($limit_to = 0, $treasury_code = '' ){
		$get = $this->input->get(array('fin_year', 'month_tr'), TRUE);
		$this->db->select('*')
				 ->from('treasury_obsuspense')
				 ->where('treasury_code',$treasury_code);
//				 ->or_where('ob_recd_id','00');
				 
		if($get['fin_year'] != ''){
			$this->db->where('fin_year',$get['fin_year']);
		}
		if($get['month_tr'] != ''){
			$this->db->where('month_tr',$get['month_tr']);
		}
		
		$this->db->order_by('ob_recd_id','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function update_try_obsuspense_records($id = 0, $users = ''){
		$post = $this->input->post(array('try_remark','try_attachment','try_official_name','try_official_desig','try_official_contact','try_date','action_status','update_dt'), TRUE);
		$update = array();

		if($post['try_attachment'] !== ''){
			$update['try_attachment'] = $post['try_attachment'];
		}
		$update['try_user'] = $users;
		$update['try_remark'] = $post['try_remark'];
		$update['try_official_name'] = $post['try_official_name'];
		$update['try_official_desig'] = $post['try_official_desig'];
		$update['try_official_contact'] = $post['try_official_contact'];
		$update['try_date'] = !empty($post['try_date']) ? date('Y-m-d',strtotime($post['try_date'])) : '';
		$update['action_status'] = 'Uploaded';
		$update['update_dt'] = date('Y-m-d H:i:s');
		
		if(!empty($update) && $id != ''){
			$this->db->where('ob_recd_id',$id)->where('treasury_code',$users)->update('treasury_obsuspense',$update);	
		}
		
		return 0;
	}
	public function update_try_misclassification_records($id = 0, $users = ''){
		$post = $this->input->post(array('try_remark','try_official_name','try_official_desig','try_official_contact','try_date','action_status','update_dt'), TRUE);
		$update = array();

		$update['try_remark'] = $post['try_remark'];
		$update['try_official_name'] = $post['try_official_name'];
		$update['try_official_desig'] = $post['try_official_desig'];
		$update['try_official_contact'] = $post['try_official_contact'];
		$update['try_date'] = !empty($post['try_date']) ? date('Y-m-d',strtotime($post['try_date'])) : '';
		$update['action_status'] = 'Updated';
		$update['update_dt'] = date('Y-m-d H:i:s');
		
		if(!empty($update) && $id != ''){
			$this->db->where('mc_rec_id',$id)->where('tr_cd',$users)->update('treasury_misclassification',$update);	
		}
		
		return 0;
	}
	public function get_tresury_outsttanding_paras($limit_to = 0, $tr_cd = '' ){
		$get = $this->input->get(array('para_year', 'para_month','para_status'), TRUE);
		$this->db->select('*')
				 ->from('treasury_ir_paras')
				 ->where('tr_cd',$tr_cd);
//				 ->where('para_status','Pending')
//				 ->or_where('record_id','00');
				 
		if($get['para_year'] != ''){
			$this->db->where('para_year',$get['para_year']);
		}
		if($get['para_month'] != ''){
			$this->db->where('para_month',$get['para_month']);
		}
		if($get['para_status'] != ''){
			$this->db->where('para_status',$get['para_status']);
		}
		$this->db->order_by('para_id','asc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_tresury_misclassification_records($limit_to = 0, $tr_cd = '' ){
		$get = $this->input->get(array('yr_ta', 'tr_mn'), TRUE);
		$this->db->select('*')
				 ->from('treasury_misclassification')
				 ->where('tr_cd',$tr_cd);
//				 ->or_where('mc_rec_id','00');
				 
		if($get['yr_ta'] != ''){
			$this->db->where('yr_ta',$get['yr_ta']);
		}
		if($get['tr_mn'] != ''){
			$this->db->where('tr_mn',$get['tr_mn']);
		}
		
		$this->db->order_by('mc_rec_id','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_tresury_all_correctionslip_records($limit_to = 0, $tr_cd = '' ){
		$get = $this->input->get(array('yr_ta', 'tr_mn'), TRUE);
		$this->db->select('*')
				 ->from('treasury_correction_slips')
				 ->where('tr_cd',$tr_cd);
//				 ->or_where('cs_record_id','00');
				 
		if($get['yr_ta'] != ''){
			$this->db->where('yr_ta',$get['yr_ta']);
		}
		if($get['tr_mn'] != ''){
			$this->db->where('tr_mn',$get['tr_mn']);
		}
		
		$this->db->order_by('cs_record_id','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function add_try_correction_slip($users = ''){
		$post =  $this->input->post(array('tr_cd','tr_name','yr_ta','tr_mn','lop_cac','mjh_cd','smjh_cd','mih_cd','sbh_cd','dtlh_cd','sdtlh_cd','tv_tc_no','cv_cd','amt_ded_add','lop_cac_amt','actual_amt','reasons','upload_dt','try_lop_cac','mjh_cd_new','smjh_cd_new','mih_cd_new','sbh_cd_new','dtlh_cd_new','sdtlh_cd_new','try_tv_tc_no','cv_cd_new','try_amt_ded_add','try_lop_cac_amt','try_actual_amt','try_remark','try_attachment','try_official_name','try_official_desig','try_official_contact','try_date','action_status','update_dt'), TRUE);
		$post['tr_cd'] = $users;
		$post['upload_dt'] = date('Y-m-d H:i:s');
		$post['try_date'] = !empty($post['try_date']) ? date('Y-m-d',strtotime($post['try_date'])) : '';
		$post['update_dt'] =  date('Y-m-d H:i:s');
		$post['action_status'] = 'Submitted';

		$this->db->insert('treasury_correction_slips',$post);
		return true;
	}
	
	public function get_treasury_status_dashboard(){
		$results =  $this->db->select('*')
							 ->from('agb_treasury_status')
							 ->order_by('tr_nm')
							 ->get()
							 ->result_array();
		return $results;
	}

	public function get_treasury_status_try_list(){
		$results =  $this->db->select('m.tr_cd,tr_nm')
							 ->from('treasury_master m')
//							 ->where('m.tr_cd', 'UDC')
							 ->get()
							 ->result_array();
		return $results;
	}


	public function get_treasury_status_misclass(){
		$results =  $this->db->select('tr_cd,count(*) misc')
							 ->from('treasury_misclassification')
							 ->where('action_status', 'Pending')
							 ->group_by('tr_cd')
							 ->order_by('tr_cd')
							 ->get()
							 ->result_array();
		return $results;
	}
	
	public function get_treasury_status_obsuspense(){
		$results =  $this->db->select('treasury_code tr_cd,count(*) obsc')
							 ->from('treasury_obsuspense')
							 ->where('action_status', 'Pending')
							 ->group_by('tr_cd')
							 ->order_by('tr_cd')
							 ->get()
							 ->result_array();
		return $results;
	}
	
	public function get_treasury_status_paras(){
		$results =  $this->db->select('tr_cd,count(*) parac')
							 ->from('treasury_ir_paras')
							 ->where('para_status', 'Pending')
							 ->group_by('tr_cd')
							 ->order_by('tr_cd')
							 ->get()
							 ->result_array();
		return $results;
	}
	
	public function get_treasury_status_cmomos(){
		$results =  $this->db->select('tr_cd,count(*) memos')
							 ->from('treasury_correction_slips')
							 ->group_by('tr_cd')
							 ->order_by('tr_cd')
							 ->get()
							 ->result_array();
		return $results;
	}
	
	public function get_all_treasury_status_dashboard(){
		$results =  $this->db->select('m.tr_cd,m.tr_nm,sum(tm.mflag) misc,sum(ob.obflag) obc,sum(cs.cflag) csc, count(ip.pflag) ipc')
							 ->from('treasury_master m')
							 ->join('treasury_misclassification tm','tm.tr_cd = m.tr_cd','left')
							 ->join('treasury_obsuspense ob','ob.treasury_code = m.tr_cd','left')
						     ->join('treasury_correction_slips cs','cs.tr_cd = m.tr_cd','left')
						     ->join('treasury_ir_paras ip','ip.tr_cd = m.tr_cd','left')
//							 ->where('m.tr_cd', $users)
//							 ->where('tm.action_status', 'Pending')
//							 ->where('ob.action_status', 'Pending')
//							 ->where('ip.para_status', 'Pending')
							 ->group_by('m.tr_cd')
							 ->order_by('m.tr_nm')
							 ->get()
							 ->result_array();
		return $results;
	}
	
	public function add_Try_list_ToTreasuryStatus($try_list){
		if(is_array($try_list)){
			foreach($try_list as $tr_cd=>$tr_nm){
				$this->db->insert('treasury_status',array('tr_cd'=>$tr_cd,'tr_nm'=>$tr_nm));
			}
		}
	}
	public function update_misclass_ToTreasuryStatus($misclass){
		if(is_array($misclass)){
			foreach($misclass as $tr_cd=>$misc){
				$this->db->where('tr_cd',$tr_cd)->update('treasury_status',array('misclass_no'=>$misc));
			}
		}
	}
	public function update_obsuspens_ToTreasuryStatus($obsuspens){
		if(is_array($obsuspens)){
			foreach($obsuspens as $tr_cd=>$obsc){
				$this->db->where('tr_cd',$tr_cd)->update('treasury_status',array('obsusp_no'=>$obsc));
			}
		}
	}
	public function update_irparas_ToTreasuryStatus($irparas){
		if(is_array($irparas)){
			foreach($irparas as $tr_cd=>$parac){
				$this->db->where('tr_cd',$tr_cd)->update('treasury_status',array('irpara_no'=>$parac));
			}
		}
	}
	public function update_cmemos_ToTreasuryStatus($cmemos){
		if(is_array($cmemos)){
			foreach($cmemos as $tr_cd=>$memos){
				$this->db->where('tr_cd',$tr_cd)->update('treasury_status',array('cmemo_no'=>$memos));
			}
		}
	}
	
	public function get_all_treasury_insp_records($limit_to=0,$office = 'AGAE',$wing = 'administration'){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('treasury_inspection_master')
//				 ->where('office',$office)
//				 ->where('wing',$wing)
				 ->order_by('tinsp_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('fin_year',$get['search']);
				$this->db->or_like('tr_nm',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function get_employee_inspection_records($limit_to = 0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('employee_treasury_inspection')
				 ->order_by('insp_rec_id','desc');
		
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('try_insp_id',$get['search']);
				$this->db->or_like('empid',$get['search']);
				$this->db->or_like('name',$get['search']);
				$this->db->or_like('try_insp_year',$get['search']);
				$this->db->or_like('try_insp_month',$get['search']);
				$this->db->or_like('insp_party_nos',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function get_all_inspection_ids(){
		$res = $this->db->select ('try_insp_id')
						->from('treasury_inspection_master')
						->order_by('try_insp_id','desc')
						->group_by('try_insp_id')
						->get()
						->result_array();
		return $res;
	}
	
	public function get_all_treasuries_inspected(){
		$res = $this->db->select ('treasury_nm')
						->from('employee_treasury_inspection')
						->order_by('treasury_nm','desc')
						->group_by('treasury_nm')
						->get()
						->result_array();
		return $res;
	}
	public function get_last_inspection_id(){
		$res = $this->db->select ('upload_dt,max(tinsp_id) max_id')
						->from('treasury_inspection_master')
						->get()
						->row_array();
		return $res;
	}
	
	public function get_all_employees_try_inspection($office = 'AGAE'){
		$post = $this->input->post(array('try_insp_year','try_insp_month', 'treasury_nm'), TRUE);
		$res = $this->db->select('et.*')
						->from('employee_treasury_inspection et');
		if($post['try_insp_year'] != ''){
			$this->db->where('et.try_insp_year',$post['try_insp_year']);
		}	
		if($post['try_insp_month'] != ''){
			$this->db->where('et.try_insp_month',$post['try_insp_month']);
		}	
		if($post['treasury_nm'] != ''){
			$this->db->where('et.treasury_nm',$post['treasury_nm']);
		}							
		$res = $this->db->order_by('et.insp_rec_id','asc')
						->get()
						->result_array();
		return $res;
	}
	
	public function get_inspection_order_print($id = 0){
		return  $this->db->select('*')
						 ->from('treasury_inspection_master')
						 ->where('try_insp_id',$id)
						 ->get()
						 ->row_array();
	}
	
	public function get_emp_inspectors_list($id = 0){
		$res = $this->db->select('*')
				->from('employee_treasury_inspection')
				->where('try_insp_prg_id',$id)
				->order_by('name','desc')
				->get()
				->result_array();
		return $res;
	}
	public function get_try_inspection_master_details($id=0){
		return  $this->db->select('*')
						 ->from('treasury_inspection_master')
						 ->where('tinsp_id',$id)
						 ->get()
						 ->row_array();
	}
	public function get_try_inspection_record_details($id=0){
		return  $this->db->select('*')
						 ->from('employee_treasury_inspection')
						 ->where('insp_rec_id',$id)
						 ->get()
						 ->row_array();
	}
	
	public function update_inspection_master_record($id=0){
		$post = $this->input->post(array('insp_year','insp_month','tr_nm','dist_nm','period_under_insp','insp_party_no','insp_from','insp_to','insp_days','distance_hq','report_hq','insp_order','order_date','try_ir_no','try_ir_date','nos_ir_paras','ir_file_link'), TRUE);
		$update = array();
		$update['insp_year'] = $post['insp_year'];
		$update['insp_month'] = $post['insp_month'];
		$update['tr_nm'] = $post['tr_nm'];
		$update['dist_nm'] = $post['dist_nm'];
		$update['period_under_insp'] = $post['period_under_insp'];
		$update['insp_party_no'] = $post['insp_party_no'];
		$update['insp_from'] = !empty($post['insp_from']) ? date('Y-m-d',strtotime($post['insp_from'])) : '';
		$update['insp_to'] = !empty($post['insp_to']) ? date('Y-m-d',strtotime($post['insp_to'])) : '';
		$update['insp_days'] = $post['insp_days'];
		$update['distance_hq'] = $post['distance_hq'];
		$update['report_hq'] = !empty($post['report_hq']) ? date('Y-m-d',strtotime($post['report_hq'])) : '';
		$update['insp_order'] = $post['insp_order'];
		$update['order_date'] = !empty($post['order_date']) ? date('Y-m-d',strtotime($post['order_date'])) : '';
		$update['try_ir_no'] = $post['try_ir_no'];
		$update['try_ir_date'] = !empty($post['try_ir_date']) ? date('Y-m-d',strtotime($post['try_ir_date'])) : '';
		$update['nos_ir_paras'] = $post['nos_ir_paras'];
		$update['ir_file_link'] = $post['ir_file_link'];
		
		if(!empty($update) && $id != ''){
			$this->db->where('tinsp_id',$id)->update('treasury_inspection_master',$update);
		}
	}
	
	public function update_treasury_inspector_record($id=0){
		$post = $this->input->post(array('advance_bill_no','adv_bill_date','adv_bill_amt','bill_no','bill_date','bill_amt','insp_status'), TRUE);
		$update = array();
		$update['advance_bill_no'] = $post['advance_bill_no'];
		$update['adv_bill_date'] = !empty($post['adv_bill_date']) ? date('Y-m-d',strtotime($post['adv_bill_date'])) : '';
		$update['adv_bill_amt'] = $post['adv_bill_amt'];
		$update['bill_no'] = $post['bill_no'];
		$update['bill_date'] = !empty($post['bill_date']) ? date('Y-m-d',strtotime($post['bill_date'])) : '';
		$update['bill_amt'] = $post['bill_amt'];
		$update['insp_status'] = $post['insp_status'];
		
		if(!empty($update) && $id != ''){
			$this->db->where('insp_rec_id',$id)->update('employee_treasury_inspection',$update);
		}
	}
	
	public function getInspectionPrgByID($id){
		return $this->db->select('*')
				->from('treasury_inspection_master')
				->where('try_insp_id',$id)
//				->where('office',$office)
				->get()
				->row_array();
	}
	
	public function getInspectionPrgToEmployees($id){
		$res =  $this->db->select('group_concat(empid) as emp_ids')
		     ->from('treasury_inspection_to_employee')
			 ->where('inspection_id',$id)
			 ->get()->row_array();
		return !empty($res) ? explode(',',$res['emp_ids']) : array();
	}
	
	public function add_inspection_to_employee($id,$emp_concerned){
		if(is_array($emp_concerned)){
			$email = '';
			foreach($emp_concerned as $empid=>$mobile){
				send_OSMS($mobile); // from helper
				$this->db->insert('treasury_inspection_to_employee',array('inspection_id'=>$id,'empid'=>$empid));
			}
		}
	}
	public function update_inspection_to_employee($id,$emp_concerned){
		if(is_array($emp_concerned)){
			foreach($emp_concerned as $empid=>$mobile){
				$this->db->where('inspection_id',$id)->where('empid',$empid)->delete('treasury_inspection_to_employee');
				send_OSMS($mobile); // from helper
				$this->db->insert('treasury_inspection_to_employee',array('inspection_id'=>$id,'empid'=>$empid));
			}
		}
	}
	
	public function emp_inspection_details_record( $try_insp_prg_id = '', $emp_concerned = ''){
		// sql 1	
		$res2 = $this->db->select('*')
						 ->from('treasury_inspection_master')
						 ->where('try_insp_id',$try_insp_prg_id)
						 ->get()
						 ->row_array();
		if(empty($res2)){
			return array($res2);
		}
		// sql 2
	if(is_array($emp_concerned)){
		foreach($emp_concerned as $empid=>$mobile){
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
						 ->from('employee_treasury_inspection')
						 ->where('empid',$empid)
						 ->where('try_insp_prg_id',$try_insp_prg_id)
						 ->get()
						 ->row_array();
		if(empty($res4)){
				$this->db->insert('employee_treasury_inspection',array('try_insp_prg_id'=>$try_insp_prg_id,'try_insp_year'=>$res['insp_year'],'try_insp_month'=>$res['insp_month'],'try_insp_order'=>$res['insp_order'],'insp_order_date'=>$res['order_date'],
				'insp_party_nos'=>$res['insp_party_no'],'treasury_nm'=>$res['tr_nm'],'dist_nam'=>$res['dist_nm'],'period_under_inspct'=>$res['period_under_insp'],'description'=>$res['description'],'try_insp_from'=>$res['insp_from'],'try_insp_to'=>$res['insp_to'],
				'insp_days'=>$res['insp_days'],'insp_assign_dt'=>$res['inps_assign_dt'],
				'empid'=>$empid,'name'=>$res['empname'],'desig'=>$res['desig'],'group_nm'=>$res['group_name'],'emp_section'=>$res['section'],'office_nm'=>$res['office'],
				'officer_name'=>$res['officer_name'],'officer_desig'=>$res['officer_desig'],'sign_tag'=>$res['sign_tag']));
		}
		}
	}	
	return true;

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
				 ->where('transf_group','ACCOUNTS')
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
				 ->where('order_group','ACCOUNTS')
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
				 ->where('e.present_group','ACCOUNTS')
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
	
}// End of class