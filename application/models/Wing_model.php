<?php
class Wing_model extends CI_Model {

	function __construct(){
		parent::__construct();
	}
	public function getTenderNoticeByID($id = 0,$office='AGAE'){
		$res = $this->db->select('*')->from('tender_notice')->where('tender_id',$id)->where('office',$office)->get()->row_array();
		return $res;
	}
	public function addTenderNotice($update_array=array()){
		if(empty($update_array)){return 0;} 
		$this->db->insert('tender_notice',$update_array);
		return $this->db->insert_id();
	}
	public function updateTenderNotice($id = 0, $update_array=array()){
		if(empty($update_array)){return $id;} 
		$this->db->where('tender_id',$id)->update('tender_notice',$update_array);
		return $id;
	}
	public function deleteTenderNoticeByID($id = 0){
		$this->db->where('tender_id',$id)->delete('tender_notice');
	}
	public function getCircularOfficeOrderByID($id = 0,$office='AGAE'){
		$res = $this->db->select('*')->from('circular_office_order')->where('cor_id',$id)->where('office',$office)->get()->row_array();
		return $res;
	}
	public function addCircularOfficeOrder($update_array=array()){
		if(empty($update_array)){return 0;} 
		$this->db->insert('circular_office_order',$update_array);
		return $this->db->insert_id();
	}
	public function updateCircularOfficeOrder($id = 0, $update_array=array(),$office='AGAE'){
		if(empty($update_array)){return $id;} 
		$this->db->where('cor_id',$id)->where('office',$office)->update('circular_office_order',$update_array);
		return $id;
	}
	public function deleteCircularOfficeOrderByID($id = 0){
		$this->db->where('cor_id',$id)->delete('circular_office_order');
	}
	
	public function get_admin_circular_office_order($limit_to=0,$office='AGAE'){
		$get = $this->input->get(array('search', 'wing'), TRUE);
		$this->db->select('*')
				 ->from('circular_office_order')
				 ->where('office',$office)
				 ->order_by('cor_id','desc');
//ADD
         if($get['wing'] != ''&& strtolower($get['wing']) != 'all'){
			$this->db->where('wing',$get['wing']);
		}
		if($get['search'] != ''){
			$this->db->like('wing',$get['search']);
		}

//END
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}

	public function getApplicationExamByID($id = 0 ){
		$res = $this->db->select('*')->from('employee_application')->where('appl_id',$id)->get()->row_array();
		return $res;
	}
	public function deleteApplicationExamByID($id = 0){
		$this->db->where('appl_id',$id)->delete('employee_application');
	}
	
	public function get_pension_circular_office_order($limit_to=0,$office='AGAE'){
		$get = $this->input->get(array('search', 'wing'), TRUE);
		$this->db->select('*')
				 ->from('circular_office_order')
				 ->where('office',$office)
				 ->where('wing','pension')
				 ->order_by('cor_id','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_gpf_circular_office_order($limit_to=0,$office='AGAE'){
		$get = $this->input->get(array('search', 'wing'), TRUE);
		$this->db->select('*')
				 ->from('circular_office_order')
				 ->where('office',$office)
				 ->where('wing','fund')
				 ->order_by('cor_id','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_accounts_circular_office_order($limit_to=0,$office='AGAE'){
		$get = $this->input->get(array('search', 'wing'), TRUE);
		$this->db->select('*')
				 ->from('circular_office_order')
				 ->where('office',$office)
				 ->where('wing','accounts')
				 ->order_by('cor_id','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_dacadre_circular_office_order($limit_to=0,$office='AGAE'){
		$get = $this->input->get(array('search', 'wing'), TRUE);
		$this->db->select('*')
				 ->from('circular_office_order')
				 ->where('office',$office)
				 ->where('wing','da_cadre')
				 ->order_by('cor_id','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}


	
	public function get_admin_tender_notice($limit_to=0,$office = 'AGAE'){
		$get = $this->input->get(array('search', 'wing'), TRUE);
		$this->db->select('*')
				 ->from('tender_notice')
				 ->where('office',$office)
				 ->order_by('tender_id','desc');
		if($get['wing'] != ''&& strtolower($get['wing']) != 'all'){
			$this->db->where('wing',$get['wing']);
		}
		if($get['search'] != ''){
			$this->db->like('description',$get['search']);
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function department_details($id=0){
		return  $this->db->select('*')
						 ->from('department_master')
						 ->where('users',$id)
						 ->get()
						 ->row_array();
	}
	public function update_department($id=0){
		$post = $this->input->post(array('users','grnt_cd','grnt_d','user_name','user_desig','emailid','mb_no','password'), TRUE);
		$update = array();
		$update['users'] = $post['users'];
		$update['grnt_cd'] = $post['grnt_cd'];
		$update['grnt_d'] = $post['grnt_d'];
		$update['user_name'] = $post['user_name'];
		$update['user_desig'] = $post['user_desig'];
		$update['emailid'] = $post['emailid'];
		$update['mb_no'] = $post['mb_no'];
		if($post['password'] != ''){$update['password'] = md5($post['password']);}
		if(!empty($update) && $id != ''){
			$this->db->where('users',$id)->update('department_master',$update);
		}
	}
	public function get_admin_treasury($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('treasury_master')
				 ->order_by('users','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('users',$get['search']);
				$this->db->or_like('tr_cd',$get['search']);
				$this->db->or_like('tr_nm',$get['search']);
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
	public function treasury_details($id=0){
		return  $this->db->select('*')
						 ->from('treasury_master')
						 ->where('users',$id)
						 ->get()
						 ->row_array();
	}
	public function update_treasury_files($id=0,$update=array()){
		if(empty($update)){return;}
		$res = $this->db->select('*')->from('treasury_files')->where('tr_cd',$id)->get();
		if($res->num_rows() > 0){
			$this->db->where('tr_cd',$id)->update('treasury_files',$update);
		}else{
			$this->db->insert('treasury_files',$update);
		}
	}
	
	public function update_treasury($id=0){
		$post = $this->input->post(array('users','user_name','user_desig','tr_nm','emailid','mb_no','password'), TRUE);
		$update = array();
		$update['users'] = $post['users'];
		$update['user_name'] = $post['user_name'];
		$update['user_desig'] = $post['user_desig'];
		$update['tr_nm'] = $post['tr_nm'];
		$update['emailid'] = $post['emailid'];
		$update['mb_no'] = $post['mb_no'];
		if($post['password'] != ''){$update['password'] = md5($post['password']);}
		if(!empty($update) && $id != ''){
			$this->db->where('users',$id)->update('treasury_master',$update);
		}
	}
	public function get_admin_department($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('department_master')
				 ->order_by('grnt_cd','asc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('users',$get['search']);
				$this->db->or_like('grnt_cd',$get['search']);
				$this->db->or_like('grnt_d',$get['search']);
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
	public function get_admin_da_cadre($limit_to=0){
		$this->db->select('*')
				 ->from('da_cadre_master')
				 ->order_by('dac_id','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function get_admin_monthly_file($limit_to=0){
		$this->db->select('*')
				 ->from('accounts_monthly')
				 ->order_by('acm_id','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_admin_quarterly_file($limit_to=0){
		$this->db->select('*')
				 ->from('accounts_quarterly')
				 ->order_by('acq_id','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_admin_yearly_file($limit_to=0){
		$this->db->select('*')
				 ->from('accounts_yearly')
				 ->order_by('acy_id','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function get_all_office_order($limit_to=0,$office = 'AGAE'){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('office_order')
				 ->where('office',$office)
				 ->order_by('order_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('wing',$get['search']);
				$this->db->or_like('title',$get['search']);
				$this->db->or_like('details',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function all_office_order_flag_update($id){
		$update['i_flag'] = 'Y';
		$this->db->where('order_id',$id)->update('office_order',$update);
	}
	public function all_office_order_flag_off($id){
		$update['i_flag'] = '';
		$this->db->where('order_id',$id)->update('office_order',$update);
	}
	public function get_admin_all_circular($limit_to=0,$office = 'AGAE',$wing = 'administration',$title='All Circular'){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('office_order')
				 ->where('office',$office)
				 ->where('wing',$wing)
				 ->where('status','Active')
				 ->where('title',$title)
				 ->order_by('order_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('title',$get['search']);
				$this->db->or_like('details',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_office_order($limit_to=0,$office = 'AGAE',$wing = 'administration'){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('office_order')
				 ->where('office',$office)
				 ->where('wing',$wing)
				 ->where('status','Active')
				 ->where('title !=','Form-16')
				 ->order_by('order_id','desc');

		if($get['search'] != ''){	
//				$this->db->where('order_id',$get['search']);
				$this->db->group_start();
				$this->db->like('title',$get['search']);
				$this->db->or_like('details',$get['search']);
				$this->db->or_like('order_id',$get['search']);
			$this->db->group_end();
		}

	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_office_order_byId($limit_to=0,$id = '' ){
		$this->db->select('*')
				 ->from('office_order')
				 ->where('office','AGAE')
				 ->where('order_id',$id )
				 ->order_by('order_id','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_adminiii_all_circular($limit_to=0,$office = 'AGAE',$wing = 'administration',$title='All Circular'){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('office_order')
				 ->where('office',$office)
				 ->where('wing',$wing)
				 ->where('status','Active')
				 ->where('title',$title)
				 ->order_by('order_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('title',$get['search']);
				$this->db->or_like('details',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_adminiii_office_order($limit_to=0,$office = 'AGAE',$wing = 'administration'){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('office_order')
				 ->where('office',$office)
				 ->where('wing',$wing)
				 ->where('status','Active')
				 ->where('title !=','Form-16')
				 ->order_by('order_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('title',$get['search']);
				$this->db->or_like('details',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_accounts_all_circular($limit_to=0,$office = 'AGAE',$wing = 'accounts',$title='All Circular'){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('office_order')
				 ->where('office',$office)
				 ->where('wing',$wing)
				 ->where('status','Active')
				 ->where('title',$title)
				 ->order_by('order_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('title',$get['search']);
				$this->db->or_like('details',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_accounts_office_order($limit_to=0,$office = 'AGAE',$wing = 'accounts'){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('office_order')
				 ->where('office',$office)
				 ->where('wing',$wing)
				 ->where('status','Active')
				 ->order_by('order_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('title',$get['search']);
				$this->db->or_like('details',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_fund_all_circular($limit_to=0,$office = 'AGAE',$wing = 'fund',$title='All Circular'){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('office_order')
				 ->where('office',$office)
				 ->where('wing',$wing)
				 ->where('status','Active')
				 ->where('title',$title)
				 ->order_by('order_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('title',$get['search']);
				$this->db->or_like('details',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_fund_office_order($limit_to=0,$office = 'AGAE',$wing = 'fund'){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('office_order')
				 ->where('office',$office)
				 ->where('wing',$wing)
				 ->where('status','Active')
				 ->order_by('order_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('title',$get['search']);
				$this->db->or_like('details',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_pension_all_circular($limit_to=0,$office = 'AGAE',$wing = 'pension',$title='All Circular'){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('office_order')
				 ->where('office',$office)
				 ->where('wing',$wing)
				 ->where('status','Active')
				 ->where('title',$title)
				 ->order_by('order_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('title',$get['search']);
				$this->db->or_like('details',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_pension_office_order($limit_to=0,$office = 'AGAE',$wing = 'pension'){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('office_order')
				 ->where('office',$office)
				 ->where('wing',$wing)
				 ->where('status','Active')
				 ->order_by('order_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('title',$get['search']);
				$this->db->or_like('details',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function get_record_all_circular($limit_to=0,$office = 'AGAE',$wing = 'record',$title='All Circular'){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('office_order')
				 ->where('office',$office)
				 ->where('wing',$wing)
				 ->where('status','Active')
				 ->where('title',$title)
				 ->order_by('order_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('title',$get['search']);
				$this->db->or_like('details',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_record_office_order($limit_to=0,$office = 'AGAE',$wing = 'record'){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('office_order')
				 ->where('office',$office)
				 ->where('wing',$wing)
				 ->where('status','Active')
				 ->order_by('order_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('title',$get['search']);
				$this->db->or_like('details',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_wm_all_circular($limit_to=0,$office = 'AGAE',$wing = 'da_cadre',$title='All Circular'){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('office_order')
				 ->where('office',$office)
				 ->where('wing',$wing)
				 ->where('status','Active')
				 ->where('title',$title)
				 ->order_by('order_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('title',$get['search']);
				$this->db->or_like('details',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_wm_office_order($limit_to=0,$office = 'AGAE',$wing = 'da_cadre'){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('office_order')
				 ->where('office',$office)
				 ->where('wing',$wing)
				 ->where('status','Active')
				 ->order_by('order_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('title',$get['search']);
				$this->db->or_like('details',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_pao_office_order($limit_to=0,$office = 'AGAE'){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('office_order')
				 ->where('office',$office)
				 ->where('title','GPF Statement')
				 ->order_by('order_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('ord_empid',$get['search']);
				$this->db->or_like('title',$get['search']);
				$this->db->or_like('details',$get['search']);
				$this->db->or_like('attachment',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function get_doc_office_order($limit_to=0,$office = 'AGAE'){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('office_order')
				 ->where('office',$office)
				 ->where('title','Service Book')
//				 ->where('ord_empid','-')
				 ->order_by('order_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('ord_empid',$get['search']);
				$this->db->or_like('title',$get['search']);
				$this->db->or_like('details',$get['search']);
				$this->db->or_like('attachment',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function get_apar_office_order($limit_to=0,$office = 'AGAE'){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('office_order')
				 ->where('office',$office)
//				 ->where('ord_empid','-')
				 ->where('title','APAR Booklet')
				 ->order_by('order_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('ord_empid',$get['search']);
				$this->db->or_like('title',$get['search']);
				$this->db->or_like('details',$get['search']);
				$this->db->or_like('attachment',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function getOfficeOrderByID($id,$office='AGAE'){
		return $this->db->select('*')->from('office_order')->where('order_id',$id)->where('office',$office)->get()->row_array();
	}
	public function getOfficeOrderToEmployees($id){
		$res =  $this->db->select('group_concat(empid) as emp_ids')
		     ->from('office_order_to_employee')
			 ->where('emp_order_id',$id)
			 ->get()->row_array();
		return !empty($res) ? explode(',',$res['emp_ids']) : array();
	}
	public function addOfficeOrder($update){
		$this->db->insert('office_order',$update);
		return $this->db->insert_id();
	}
	public function deleteOfficeOrderByID($id){
		$this->db->where('order_id',$id)->delete('office_order');
		$this->db->where('emp_order_id',$id)->delete('office_order_to_employee');
	}
	
	public function add_office_order_to_employee($id,$emp_concerned){
		if(is_array($emp_concerned)){
			foreach($emp_concerned as $empid=>$mobile){
				send_OSMS($mobile); // from helper
				$this->db->insert('office_order_to_employee',array('emp_order_id'=>$id,'empid'=>$empid));
			}
		}
	}
	public function updateOfficeOrder($id,$update,$office='AGAE'){
		$this->db->where('order_id',$id)->where('office',$office)->update('office_order',$update);
		return $this->db->insert_id();
	}
	
	public function update_office_order_to_employee($id,$emp_concerned){
		if(is_array($emp_concerned)){
			$this->db->where('emp_order_id',$id)->delete('office_order_to_employee');
			foreach($emp_concerned as $empid=>$mobile){
				send_OSMS($mobile); // from helper
				$this->db->insert('office_order_to_employee',array('emp_order_id'=>$id,'empid'=>$empid));
			}
		}
	}
	public function getEmployeeOfficeOrderByID($id = 0){
		$res = $this->db->select('*')->from('office_order_to_employee')->where('eord_id',$id)->get()->row_array();
		return $res;
	}
	
	public function delete_employee_office_OrderByID($id = 0){
		$this->db->where('eord_id',$id)->delete('office_order_to_employee');
	}
	
	
	public function get_circular_office_order($limit_to = 0,$office='AGAE'){
		$get = $this->input->get(array('date_from', 'date_to', 'wing', 'title'), TRUE);
		$this->db->select('*')
				 ->from('circular_office_order')
				 ->where('office',$office);
		if($get['date_from'] != ''){
			$f_date = date('Y-m-d',strtotime($get['date_from']));
			$this->db->where('date(date) >= ',$f_date);
		}
		if($get['date_to'] != ''){
			$t_date = date('Y-m-d',strtotime($get['date_to']));
			$this->db->where('date(date) <= ',$t_date);
		}
		if($get['wing'] != ''){
			$this->db->where('wing',$get['wing']);
		}
		if($get['title'] != ''){
			$this->db->like('description',$get['title']);
		}
		$this->db->order_by('cor_id','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	
	
	public function get_tender_notice($limit_to = 0,$office = 'AGAE'){
		$get = $this->input->get(array('date_from', 'date_to', 'wing', 'title'), TRUE);
		$this->db->select('*')
				 ->from('tender_notice')
				 ->where('office',$office);
		if($get['date_from'] != ''){
			$f_date = date('Y-m-d',strtotime($get['date_from']));
			$this->db->where('date(date) >= ',$f_date);
		}
		if($get['date_to'] != ''){
			$t_date = date('Y-m-d',strtotime($get['date_to']));
			$this->db->where('date(date) <= ',$t_date);
		}
		if($get['wing'] != ''){
			$this->db->where('wing',$get['wing']);
		}
		if($get['title'] != ''){
			$this->db->like('description',$get['title']);
		}
		$this->db->order_by('tender_id','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_treasury_files($id=0){
		$res = $this->db->select('*')->from('treasury_files')->where('tr_cd',$id)->get()->row_array();
		return $res;
	}
	
	
	public function get_all_deprtment_users_list($users = 0){
		$results =  $this->db->select('*')
							 ->from('department_master d')
							 ->order_by('d.grnt_d')
							 ->get()
							 ->result_array();
		return $results;
	}

public function get_treasury_obsuspense($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('treasury_obsuspense')
				 ->order_by('ob_recd_id', 'desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('treasury_code',$get['search']);
				$this->db->or_like('fin_year',$get['search']);
				$this->db->or_like('major_head',$get['search']);
				$this->db->or_like('voucher_challan',$get['search']);
				$this->db->or_like('gross',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_treasury_misclassification($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('treasury_misclassification')
				 ->order_by('mc_rec_id', 'desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('tr_cd',$get['search']);
				$this->db->or_like('yr_ta',$get['search']);
				$this->db->or_like('mjh_cd',$get['search']);
				$this->db->or_like('tv_tc_no',$get['search']);
				$this->db->or_like('amt_paid',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_treasury_treasury_correction_slips($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('treasury_correction_slips')
				 ->order_by('cs_record_id', 'desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('tr_cd',$get['search']);
				$this->db->or_like('yr_ta',$get['search']);
				$this->db->or_like('tv_tc_no',$get['search']);
				$this->db->or_like('amt_paid',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
//-------For adding files to department
	
	public function get_department_files($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('department_files')
				 ->order_by('file_id', 'desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('dept_cd',$get['search']);
				$this->db->or_like('title',$get['search']);
				$this->db->or_like('details',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function add_Department_Files($update){
		$this->db->insert('department_files',$update);
		return $this->db->insert_id();
	}
	
	public function update_Department_Files($id,$update){
		$this->db->where('file_id',$id)->update('department_files',$update);
		return $this->db->insert_id();
	}
	
	
	public function add_DepartmentFilesToDept($id,$dusers_concerned){
		if(is_array($dusers_concerned)){
			foreach($dusers_concerned as $dusers=>$val){
				$this->db->insert('department_files_to_dept',array('dfiles_id'=>$id,'dusers'=>$dusers));
			}
		}
	}
	
	public function update_DepartmentFilesToDept($id,$dusers_concerned){
		if(is_array($dusers_concerned)){
			$this->db->where('dfiles_id',$id)->delete('department_files_to_dept');
			foreach($dusers_concerned as $dusers=>$val){
				$this->db->insert('department_files_to_dept',array('dfiles_id'=>$id,'dusers'=>$dusers));
			}
		}
	}
	
	public function delete_DepartmentFilesToDept($id){
		$this->db->where('file_id',$id)->delete('department_files');
		$this->db->where('dfiles_id',$id)->delete('department_files_to_dept');
	}

	
	public function getDepartmentFilesByID($id){
		return $this->db->select('*')
						->from('department_files')
						->where('file_id',$id)
						->get()
						->row_array();
	}
	public function getDepartmentInvstByID($id){
		return $this->db->select('*')
						->from('department_investment')
						->where('recd_id',$id)
						->get()
						->row_array();
	}
	public function getDepartmentGiaByID($id){
		return $this->db->select('*')
						->from('department_gia')
						->where('recd_id',$id)
						->get()
						->row_array();
	}
	public function getDepartmentAcdcByID($id){
		return $this->db->select('*')
						->from('department_acdc')
						->where('recd_id',$id)
						->get()
						->row_array();
	}

	public function get_DepartmentFilesToDept($id){
		$res =  $this->db->select('group_concat(dusers) as dusers')
						 ->from('department_files_to_dept')
						 ->where('dfiles_id',$id)
						 ->get()
						 ->row_array();
		return !empty($res) ? explode(',',$res['dusers']) : array();
	}
	
	public function deleteDepartmentFilesByID($id){
		$this->db->where('file_id',$id)->delete('department_files');
		$this->db->where('dfiles_id',$id)->delete('department_files_to_dept');
	}
	public function get_department_investment($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('department_investment')
				 ->order_by('recd_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('yr_ta',$get['search']);
				$this->db->or_like('tr_mn',$get['search']);
				$this->db->or_like('tr_cd',$get['search']);
				$this->db->or_like('ddo',$get['search']);
				$this->db->or_like('tv_tc_no',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function deleteDepartmentInvestmentByID($id){
		$this->db->where('recd_id',$id)->delete('department_investment');
	}
		public function department_investment_record($id=0){
		return  $this->db->select('*')
						 ->from('department_investment')
						 ->where('recd_id',$id)
						 ->get()
						 ->row_array();
	}
	
	public function update_department_investment($id=0){
		$post = $this->input->post(array('invst_category'), TRUE);
		$update = array();
		$update['invst_category'] = '';
		
		if(!empty($update) && $id != ''){
			$this->db->where('recd_id',$id)->update('department_investment',$update);
		}
	}
	
	
	public function get_department_gia($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('department_gia')
				 ->order_by('recd_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('grnt_cd',$get['search']);
				$this->db->or_like('tr_cd',$get['search']);
				$this->db->or_like('ddo',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function deleteDepartmentGiaByID($id){
		$this->db->where('recd_id',$id)->delete('department_investment');
	}
	
	public function get_department_acdc($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('department_acdc')
				 ->order_by('recd_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('fin_yr',$get['search']);
				$this->db->or_like('tr_mn',$get['search']);
				$this->db->or_like('tr_cd',$get['search']);
				$this->db->or_like('ddo',$get['search']);
				$this->db->or_like('tv_tc_no',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function deleteDepartmentAcDcByID($id){
		$this->db->where('recd_id',$id)->delete('department_acdc');
	}
	
	public function get_department_loan_advance($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('department_loan_advance')
				 ->order_by('la_recd_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('yr_ta',$get['search']);
				$this->db->or_like('tr_mn',$get['search']);
				$this->db->or_like('tr_cd',$get['search']);
				$this->db->or_like('ddo',$get['search']);
				$this->db->or_like('tv_tc_no',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function department_loan_advance_record($id=0){
		return  $this->db->select('*')
						 ->from('department_loan_advance')
						 ->where('la_recd_id',$id)
						 ->get()
						 ->row_array();
	}
	
	public function update_department_loan_advance($id=0){
		$post = $this->input->post(array('dept_old_remark','dept_remark'), TRUE);
		$update = array();
		$update['dept_old_remark'] = $post['dept_old_remark'];
		$update['dept_remark'] = $post['dept_remark'];
		
		if(!empty($update) && $id != ''){
			$this->db->where('la_recd_id',$id)->update('department_loan_advance',$update);
		}
	}
	
//-------For adding files to treasury

public function get_all_treasury_users_list($users = 0){
		$results =  $this->db->select('*')
							 ->from('treasury_master t')
							 ->order_by('t.tr_nm','asc')
							 ->get()
							 ->result_array();
		return $results;
	}
	public function get_treasury_reports($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('treasury_report')
				 ->order_by('report_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('tr_cd',$get['search']);
				$this->db->or_like('tr_nm',$get['search']);
				$this->db->or_like('report_type',$get['search']);
				$this->db->or_like('report_desc',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_treasury_outstanding_paras($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('treasury_ir_paras')
				 ->order_by('para_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('tr_cd',$get['search']);
				$this->db->or_like('para_year',$get['search']);
				$this->db->or_like('para_month',$get['search']);
				$this->db->or_like('para_desc',$get['search']);
				$this->db->or_like('para_status',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_treasury_corrction_memo_id($id=0){
		return  $this->db->select('*')
						 ->from('treasury_correction_slips')
						 ->where('cs_record_id',$id)
						 ->get()
						 ->row_array();
	}
	public function get_treasury_outstanding_paras_id($id=0){
		return  $this->db->select('*')
						 ->from('treasury_ir_paras')
						 ->where('para_id',$id)
						 ->get()
						 ->row_array();
	}
	
	public function update_treasury_correction_momo($id=0){
		$post = $this->input->post(array('incorp_month','incorp_year','action_status','update_dt'), TRUE);
		$update = array();
		$update['incorp_month'] = $post['incorp_month'];
		$update['incorp_year'] = $post['incorp_year'];
		$update['action_status'] = $post['action_status'];
		$update['update_dt'] = date('Y-m-d H:i:s');
		
		if(!empty($update) && $id != ''){
			$this->db->where('cs_record_id',$id)->update('treasury_correction_slips',$update);
		}
	}
	
	public function update_treasury_outstanding_para($id=0){
		$post = $this->input->post(array('try_ref_no','try_ref_date','try_ir_remark','para_status','update_dt'), TRUE);
		$update = array();
		$update['try_ref_no'] = $post['try_ref_no'];
		$update['try_ref_date'] = !empty($post['try_ref_date']) ? date('Y-m-d',strtotime($post['try_ref_date'])) : '';
		$update['try_ir_remark'] = $post['try_ir_remark'];
		$update['para_status'] = $post['para_status'];
		$update['update_dt'] = date('Y-m-d H:i:s');
		
		if(!empty($update) && $id != ''){
			$this->db->where('para_id',$id)->update('treasury_ir_paras',$update);
		}
	}
		
	public function get_treasury_reports_download(){
		$post = $this->input->post(array('date_from','date_to','report_type','tr_nm'), TRUE);
		$res = $this->db->select('tr.*')
						->from('treasury_report tr');
						
		if($post['date_from'] != ''){
			$f_date = date('Y-m-d',strtotime($post['date_from']));
			$this->db->where('date(tr.upload_dt) >= ',$f_date);
		}
		if($post['date_to'] != ''){
			$t_date = date('Y-m-d',strtotime($post['date_to']));
			$this->db->where('date(tr.upload_dt) <= ',$t_date);
		}
		if($post['report_type'] != ''){
			$this->db->where('tr.report_type',$post['report_type']);
		}	
		if($post['tr_nm'] != ''){
			$this->db->where('tr.tr_nm',$post['tr_nm']);
		}
		$res = $this->db->order_by('tr.upload_dt','desc')
						->get()
						->result_array();
		return $res;
	}
	public function get_treasury_misclassification_download(){
		$post = $this->input->post(array('tr_cd','yr_ta','tr_mn'), TRUE);
		$res = $this->db->select('tm.*')
						->from('treasury_misclassification tm');
						
		if($post['tr_cd'] != ''){
			$this->db->where('tm.tr_cd',$post['tr_cd']);
		}
		if($post['yr_ta'] != ''){
			$this->db->where('tm.yr_ta',$post['yr_ta']);
		}
		if($post['tr_mn'] != ''){
			$this->db->where('tm.tr_mn',$post['tr_mn']);
		}						
		$res = $this->db->order_by('tm.upload_dt','desc')
						->get()
						->result_array();
		return $res;
	}
	public function get_treasury_correctionslip_download(){
		$post = $this->input->post(array('tr_cd','yr_ta','tr_mn'), TRUE);
		$res = $this->db->select('tcs.*')
						->from('treasury_correction_slips tcs');
						
		if($post['tr_cd'] != ''){
			$this->db->where('tcs.tr_cd',$post['tr_cd']);
		} 
		if($post['yr_ta'] != ''){
			$this->db->where('tcs.yr_ta',$post['yr_ta']);
		}
		if($post['tr_mn'] != ''){
			$this->db->where('tcs.tr_mn',$post['tr_mn']);
		}	
		
		$res = $this->db->order_by('tcs.upload_dt','desc')
						->get()
						->result_array();
		return $res;
	}
	public function get_treasury_outstanding_paras_download(){
		$post = $this->input->post(array('tr_cd','para_year','para_month'), TRUE);
		$res = $this->db->select('tp.*')
						->from('treasury_ir_paras tp');
						
		if($post['tr_cd'] != ''){
			$this->db->where('tp.tr_cd',$post['tr_cd']);
		}
		if($post['para_year'] != ''){
			$this->db->where('tp.para_year',$post['para_year']);
		}
		if($post['para_month'] != ''){
			$this->db->where('tp.para_month',$post['para_month']);
		}	
		
		$res = $this->db->order_by('tp.upload_dt','desc')
						->get()
						->result_array();
		return $res;
	}
	
		public function get_all_treasury_orders($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('treasury_orders')
				 ->where('order_type','All Circular')
				 ->or_where('order_type','Treasury Review Report')
				 ->order_by('file_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('order_type',$get['search']);
				$this->db->or_like('title',$get['search']);
				$this->db->or_like('details',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_treasury_concerned_orders($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('treasury_orders')
				 ->where('order_type','Document')
				 ->or_where('order_type','Inspection Report')
				 ->order_by('file_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('treasury_code',$get['search']);
				$this->db->or_like('order_type',$get['search']);
				$this->db->or_like('title',$get['search']);
				$this->db->or_like('details',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function add_treasury_orders($update){
		$this->db->insert('treasury_orders',$update);
		return $this->db->insert_id();
	}
	
	public function update_treasury_orders($id,$update){
		$this->db->where('file_id',$id)->update('treasury_orders',$update);
		return $this->db->insert_id();
	}
	
	public function add_treasury_report($update){
		$this->db->insert('treasury_report',$update);
		return $this->db->insert_id();
	}
	
	public function update_treasury_report($id,$update){
		$this->db->where('file_id',$id)->update('treasury_report',$update);
		return $this->db->insert_id();
	}
	
	
	
	
	public function add_TreasuryOrddrsToTry($id,$tusers_concerned){
		if(is_array($tusers_concerned)){
			foreach($tusers_concerned as $tusers=>$val){
				$this->db->insert('treasury_orders_to_try',array('tfiles_id'=>$id,'tusers'=>$tusers));
			}
		}
	}
	
	public function update_TreasuryOrddrsToTry($id,$tusers_concerned){
		if(is_array($tusers_concerned)){
			$this->db->where('tfiles_id',$id)->delete('treasury_orders_to_try');
			foreach($tusers_concerned as $tusers=>$val){
				$this->db->insert('treasury_orders_to_try',array('tfiles_id'=>$id,'tusers'=>$tusers));
			}
		}
	}
	public function delete_TreasuryOrddrsToTry($id){
		$this->db->where('file_id',$id)->delete('treasury_orders');
		$this->db->where('tfiles_id',$id)->delete('treasury_orders_to_try');
	}

	
	public function getTreasuryOrdersByID($id){
		return $this->db->select('*')
						->from('treasury_orders')
						->where('file_id',$id)
						->get()
						->row_array();
	}
	
	public function getTreasuryReportByID($id){
		return $this->db->select('*')
						->from('treasury_report')
						->where('report_id',$id)
						->get()
						->row_array();
	}
	
	public function get_TreasuryOrddrsToTry($id){
		$res =  $this->db->select('tfiles_id')
						 ->from('treasury_orders_to_try')
						 ->where('tfiles_id',$id)
						 ->get()
						 ->row_array();
		return !empty($res) ? explode(',',$res['tfiles_id']) : array();
	}
	
	public function deleteTreasuryOrddrsByID($id){
		$this->db->where('file_id',$id)->delete('treasury_orders');
		$this->db->where('tfiles_id',$id)->delete('treasury_orders_to_try');
	}
	
//---exam_results 

public function getExamResultsByID($id = 0,$office='AGAE'){
		$res = $this->db->select('*')->from('exam_results')->where('ror_id',$id)->where('office',$office)->get()->row_array();
		return $res;
	}
	public function addExamResults($update_array=array()){
		if(empty($update_array)){return 0;} 
		$this->db->insert('exam_results',$update_array);
		return $this->db->insert_id();
	}
	public function updateExamResults($id = 0, $update_array=array(),$office='AGAE'){
		if(empty($update_array)){return $id;} 
		$this->db->where('ror_id',$id)->where('office',$office)->update('exam_results',$update_array);
		return $id;
	}
	public function deleteExamResultsByID($id = 0){
		$this->db->where('ror_id',$id)->delete('exam_results');
	}
	
	public function get_exam_result($limit_to = 0,$office='AGAE'){
		$get = $this->input->get(array('date_from', 'date_to', 'wing', 'title'), TRUE);
		$this->db->select('*')
				 ->from('exam_results')
				 ->where('office',$office);
		if($get['date_from'] != ''){
			$f_date = date('Y-m-d',strtotime($get['date_from']));
			$this->db->where('date(date) >= ',$f_date);
		}
		if($get['date_to'] != ''){
			$t_date = date('Y-m-d',strtotime($get['date_to']));
			$this->db->where('date(date) <= ',$t_date);
		}
		if($get['wing'] != ''){
			$this->db->where('wing',$get['wing']);
		}
		if($get['title'] != ''){
			$this->db->like('description',$get['title']);
		}
		$this->db->order_by('ror_id','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	public function get_dacadare_exam_result($limit_to = 0,$office='AGAE', $wing = 'da_cadre'){
		$get = $this->input->get(array('date_from', 'date_to', 'wing', 'title'), TRUE);
		$this->db->select('*')
				 ->from('exam_results')
				 ->where('office',$office)
				 ->where('wing',$wing);
		if($get['date_from'] != ''){
			$f_date = date('Y-m-d',strtotime($get['date_from']));
			$this->db->where('date(date) >= ',$f_date);
		}
		if($get['date_to'] != ''){
			$t_date = date('Y-m-d',strtotime($get['date_to']));
			$this->db->where('date(date) <= ',$t_date);
		}
		if($get['wing'] != ''){
			$this->db->where('wing',$get['wing']);
		}
		if($get['title'] != ''){
			$this->db->like('description',$get['title']);
		}
		$this->db->order_by('ror_id','desc');
	   	$total_records = $this->db->count_all_results('', FALSE);
		
		$results = $this->db->limit(PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}

	public function get_accounts_exam_result($limit_to=0,$office='AGAE'){
		$get = $this->input->get(array('search', 'wing'), TRUE);
		$this->db->select('*')
				 ->from('exam_results')
				 ->where('office',$office)
				 ->order_by('ror_id','desc');

         if($get['wing'] != ''&& strtolower($get['wing']) != 'all'){
			$this->db->where('wing',$get['wing']);
		}
		if($get['search'] != ''){
			$this->db->like('wing',$get['search']);
		}

	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	
	
	
}// End of class