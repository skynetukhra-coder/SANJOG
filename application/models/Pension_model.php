<?php
class Pension_model extends CI_Model {

	function __construct(){
		parent::__construct();
		if($this->session->userdata('language_id')){
			$this->language_id = $this->session->userdata('language_id');
		}else{
			$this->language_id = 1;
		}
	}
	
	public function get_admin_case_status($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('pension_case')
				 ->order_by('p_c_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->where('appln_pk',$get['search']);
				$this->db->or_where('file_no',$get['search']);
				$this->db->or_where('application_no',$get['search']);
				$this->db->or_where('appln_first_name',$get['search']);
				$this->db->or_where('pnsr_name',$get['search']);
				$this->db->or_where('designation',$get['search']);
				$this->db->or_where('pension_class',$get['search']);
				$this->db->or_where('case_type',$get['search']);
				$this->db->or_where('status_des',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_admin_case_status_details($id=0){
		return  $this->db->select('*')
						 ->from('pension_case')
						 ->where('application_no',$id)
						 ->get()
						 ->row_array();
	}
	
	public function get_admin_pension($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('pension')
				 ->order_by('pns_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->where('apa_appln_pk',$get['search']);
				$this->db->or_where('apa_appln_pk',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_admin_pensioner_spouse($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('pensioner_spouse')
				 ->order_by('ps_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->where('apf_appln_pk',$get['search']);
				$this->db->or_where('spouse_name',$get['search']);
				$this->db->or_where('relationship',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_admin_dispatched_status($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('pension_case_dispatch')
				 ->order_by('p_d_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->where('inout_appln_pk',$get['search']);
				$this->db->or_where('inout_no',$get['search']);
				$this->db->or_where('inout_out_type',$get['search']);
				$this->db->or_where('inout_dispatch_artical_no',$get['search']);
				$this->db->or_where('f_get_lov_name_inout_dispatch_mode',$get['search']);
				$this->db->or_where('inout_sndr_name',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
		
	}
	public function get_admin_case_dispatched_details($id=0,$type=''){
		return $this->db->select('pc.application_no,pd.*')
						->from('pension_case_dispatch pd')
						->join('pension_case pc','pc.appln_pk = pd.inout_appln_pk')
						->where('pd.inout_appln_pk',$id)
						->where('pd.inout_out_type',$type)
						->get()
						->row_array();
	}
	public function get_admin_return_status($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('pension_case_return_reason')
				 ->order_by('p_r_r_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->where('apr_pk',$get['search']);
				$this->db->or_where('apr_appln_pk',$get['search']);
				$this->db->or_where('apr_reject_reason',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_admin_pensioner_ppo_no($limit_to=0){
		$get = $this->input->get(array('apa_appln_pk','ppo_no'), TRUE);
		$this->db->select('*')
				 ->from('pension_to_ppo')
				 ->order_by('p_p_id','desc');
		if($get['apa_appln_pk'] != ''){
			$this->db->where('apa_appln_pk',$get['apa_appln_pk']);
		}
		if($get['ppo_no'] != ''){
			$this->db->where('ppo_no',$get['ppo_no']);
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function getPPO_ByID($id,$office='AGAE'){
		return $this->db->select('*')->from('agb_pension_to_ppo')->where('p_p_id',$id)->get()->row_array();
	}
	public function deletePPO_ByID($id){
		$this->db->where('p_p_id',$id)->delete('agb_pension_to_ppo');
	}
	public function get_duplicate_ppo_list(){
		$res = $this->db->select('p_p_id, apa_appln_pk, COUNT(apa_appln_pk)')
						->from('agb_pension_to_ppo')
						->group_by ('apa_appln_pk')
						->having ('COUNT(apa_appln_pk) >', 1);						
		$res = $this->db->order_by('apa_appln_pk','asc')
						->get()
						->result_array();
		return $res;
	}
	public function pensioner_auth(){
		$post = $this->input->post(array('application_no'), TRUE);
		if($post['application_no'] != ''){
			$this->db->where('application_no',$post['application_no']);
		}else{
			$msg = "Wrong Credentials.";
			return array('success'=>false,'msg'=>$msg);
		}
		//$this->db->where('lower(status_des)','finalized');
		$results = $this->db->select('*')->from('pension_case')->order_by('p_c_id','desc')->get()->row_array();
		if(empty($results)){
			$msg = "Wrong Credentials.";
			return array('success'=>false,'msg'=>$msg);
		}
		$status_des = trim(strtolower($results['status_des']));
		if(isset($results['status_des']) && $status_des != 'finalized'){
			$msg = "This case status is ".$results['status_des'];
			return array('success'=>false,'msg'=>$msg);
		}
		if(isset($results['mobile_no']) && empty($results['mobile_no']) && isset($results['mobile_num']) && empty($results['mobile_num'])){
			$msg = "You do not submited your mobile no. Please submit mobile no to edppen-agae-wb@nic.in";
			return array('success'=>false,'msg'=>$msg);
		}
		$pension_class = trim(strtolower($results['pension_class']));
		if(isset($results['pension_class']) && $pension_class != 'superannuation pension' && $pension_class != 'family pension' && $pension_class != 'cp case' && $pension_class != 'ad-hoc family pension' ){
			$msg = "This pension class is ".strtolower($results['pension_class']);
			return array('success'=>false,'msg'=>$msg);
		}
		$case_type = trim(strtolower($results['case_type']));
		if(isset($results['case_type']) && $case_type != 'regular case (service pension)' && $case_type != 'family pension case'){
			$msg = "This case status is ".$results['case_type'];
			return array('success'=>false,'msg'=>$msg);
		}
		if(isset($results['f_get_lov_name_apen_catg']) && trim(strtolower($results['f_get_lov_name_apen_catg'])) != 'state'){
			$msg = "This case category in ".$results['f_get_lov_name_apen_catg'];
			return array('success'=>false,'msg'=>$msg);
		}
		return array('success'=>true,'msg'=>"Submit OTP",'details'=>$results);
	}
	public function get_pension_case_details($application_no = 0){
		$results = $this->db->select('pc.*,ppo.ppo_no')->from('pension_case pc')->join('pension_to_ppo ppo','pc.appln_pk = ppo.apa_appln_pk','left')->where('application_no',$application_no)->get()->result_array();
		return $results;
	}
	public function get_pension_return_details($application_no = 0){
		$results = $this->db->select('pr.*')
							->from('pension_case_return_reason pr')
							->join('pension_case pc','pc.appln_pk = pr.apr_appln_pk')
							->where('pc.application_no',$application_no)
							->get()->result_array();
		return $results;
	}
	public function get_pension_dispatched_details($application_no = 0){
		$results = $this->db->select('pd.*')
							->from('pension_case_dispatch pd')
							->join('pension_case pc','pc.appln_pk = pd.inout_appln_pk')
							->where('pc.application_no',$application_no)
							->get()->result_array();
		return $results;
	}
	public function get_pension_details($application_no = 0){
		$results = $this->db->select('p.*')
							->from('pension p')
							->join('pension_case pc','pc.appln_pk = p.apa_appln_pk')
							->where('pc.application_no',$application_no)
							->get()->result_array();
		return $results;
	}
	public function get_spouce_details($application_no = 0){
		$results = $this->db->select('ps.*')
							->from('pensioner_spouse ps')
							->join('pension_case pc','pc.appln_pk = ps.apf_appln_pk')
							->where('pc.application_no',$application_no)
							->get()->result_array();
		return $results;
	}
/*
	public function get_pension_case_status(){
		$post = $this->input->post(array('application_no', 'mobile', 'fname', 'doa', 'dob'), TRUE);
		if($post['application_no'] != ''){
			$this->db->where('application_no',$post['application_no']);
		}else if($post['mobile'] != ''){
			$this->db->group_start();
				$this->db->where('mobile_no',$post['mobile']);
				$this->db->or_where('mobile_num',$post['mobile']);
			$this->db->group_end();
		}else if($post['fname'] != '' && $post['doa'] != '' &&  $post['dob'] != ''){
			$this->db->where('appln_first_name',trim($post['fname']));
			$this->db->where('date(apen_doa)',date('Y-m-d',strtotime(str_replace('/','-',$post['doa']))));
			$this->db->where('date(apen_dob)',date('Y-m-d',strtotime(str_replace('/','-',$post['dob']))));
		}else{
			return array();
		}
		$results = $this->db->select('pc.*,ppo.ppo_no')->from('pension_case pc')->join('pension_to_ppo ppo','pc.appln_pk = ppo.apa_appln_pk','left')->get()->result_array();
		return $results;
	}
*/

	public function get_pension_case_status($application_no = '', $mobile = '', $fname = ''){
//		$post = $this->input->post(array('application_no', 'mobile', 'fname', 'doa', 'dob'), TRUE);		
		$post = $this->input->post(array('doa', 'dob'), TRUE);		
		
		if(is_numeric($application_no)){
			$this->db->where('application_no',$application_no);
		}else if(is_numeric($mobile)){
			$this->db->group_start();
				$this->db->where('mobile_no',$mobile);
				$this->db->or_where('mobile_num',$mobile);
			$this->db->group_end();
		}else if($fname != '' && $post['doa'] != '' &&  $post['dob'] != ''){
			$this->db->where('appln_first_name',trim($fname));
			$this->db->where('date(apen_doa)',date('Y-m-d',strtotime(str_replace('/','-',$post['doa']))));
			$this->db->where('date(apen_dob)',date('Y-m-d',strtotime(str_replace('/','-',$post['dob']))));
		}else{
			return array();
		}
		$results = '';
		if(is_numeric($application_no) != '' || is_numeric($mobile) != '' || $fname != ''){
			$results = $this->db->select('pc.*,ppo.ppo_no')->from('pension_case pc')->join('pension_to_ppo ppo','pc.appln_pk = ppo.apa_appln_pk','left')->get()->result_array();
		}
		return $results;
	}
	
	public function get_pension_case_return($case_id = 0){
		if(is_numeric($case_id)){
			$results = $this->db->select('*')->from('pension_case_return_reason')->where('apr_appln_pk',$case_id)->get()->result_array();
		}
		return $results;
	}
	public function get_pension_case_dispatched($case_id = 0){
		if(is_numeric($case_id)){
			$results = $this->db->select('*')->from('pension_case_dispatch')->where('inout_appln_pk',$case_id)->get()->result_array();
		}
		return $results;
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
				 ->where('transf_group','PENSION')
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
				 ->where('order_group','PENSION')
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
				 ->where('e.present_group','PENSION')
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
	public function pension_appli_add($update=array()){
		if(empty($update)){return 0;} 
		$this->db->insert('pension_payment',$update);
		return $this->db->insert_id();
	}
	public function get_pension_payment_records($limit_to=0){
		$get = $this->input->get(array('search'), TRUE);
		$this->db->select('*')
				 ->from('pension_payment')
				 ->order_by('appl_id','desc');
		if($get['search'] != ''){
			$this->db->group_start();
				$this->db->like('full_name',$get['search']);
				$this->db->or_like('ppo_no',$get['search']);
			$this->db->group_end();
		}
	   	$total_records = $this->db->count_all_results('', FALSE);
		$results = $this->db->limit(ADMIN_PAGINATION_DATA_PER_PAGE,$limit_to) // fron config/constants.php
							->get()
							->result_array();
		return array('total'=>$total_records,'results'=>$results);
	}
	public function get_payment_records_download(){
		$post = $this->input->post(array('date_from','date_to','report_type','tr_nm'), TRUE);
		$res = $this->db->select('pp.*')
						->from('pension_payment pp');
						
		if($post['date_from'] != ''){
			$f_date = date('Y-m-d',strtotime($post['date_from']));
			$this->db->where('date(pp.upload_dt) >= ',$f_date);
		}
		if($post['date_to'] != ''){
			$t_date = date('Y-m-d',strtotime($post['date_to']));
			$this->db->where('date(pp.upload_dt) <= ',$t_date);
		}
		$res = $this->db->order_by('pp.upload_dt','desc')
						->get()
						->result_array();
		return $res;
	}
	
	
	
}// End of class