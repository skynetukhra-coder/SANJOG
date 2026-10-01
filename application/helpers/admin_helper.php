<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_gpf_subscribers_name')){
    function get_gpf_subscribers_name($series = '',$ac_code) {
		$ci=& get_instance();
        $res = $ci->db->select('fst_nme,mid_nme,lst_nme')
						->from('subscriber_master')
						->where('series',$series)
						->where('ac_code',$ac_code)
						->get()
						->row_array();
		if(!empty($res)){
			return $res['fst_nme'].' '.$res['mid_nme'].' '.$res['lst_nme'];
		}
		return '';
    }   
}

if ( ! function_exists('is_employee_applied_form')){
    function is_employee_applied_form($emp_id = 0) {
		$ci=& get_instance();
        $res = $ci->db->get_where('employee_application',array('emp_id'=>$emp_id));
		return $res->num_rows() > 0 ? true : false; 
    }   
}

if ( ! function_exists('getTreasuryTotalFile')){
    function getTreasuryTotalFile($tr_cd = 0) {
		$ci=& get_instance();
        $res = $ci->db->get_where('treasury_files',array('tr_cd'=>$tr_cd));
		if($res->num_rows() == 0){
			return 0;
		}
		$flag=0;
		$row = $res->row_array();
		if(isset($row['ins_prog_file_1']) && trim($row['ins_prog_file_1']) != '')$flag++;
		if(isset($row['ins_prog_file_2']) && trim($row['ins_prog_file_2']) != '')$flag++;
		if(isset($row['ins_prog_file_3']) && trim($row['ins_prog_file_3']) != '')$flag++;
		if(isset($row['ins_report_file_1']) && trim($row['ins_report_file_1']) != '')$flag++;
		if(isset($row['ins_report_file_2']) && trim($row['ins_report_file_2']) != '')$flag++;
		if(isset($row['ins_report_file_3']) && trim($row['ins_report_file_3']) != '')$flag++;
		if(isset($row['outs_para_file_1']) && trim($row['outs_para_file_1']) != '')$flag++;
		if(isset($row['outs_para_file_2']) && trim($row['outs_para_file_2']) != '')$flag++;
		if(isset($row['outs_para_file_3']) && trim($row['outs_para_file_3']) != '')$flag++;
		if(isset($row['annual_report_file_1']) && trim($row['annual_report_file_1']) != '')$flag++;
		if(isset($row['annual_report_file_2']) && trim($row['annual_report_file_2']) != '')$flag++;
		if(isset($row['annual_report_file_3']) && trim($row['annual_report_file_3']) != '')$flag++;
		return $flag;
    }   
}
if ( ! function_exists('get_gpf_fp_authority_nominee')){
    function get_gpf_fp_authority_nominee($authority_no = 0) {
		$ci=& get_instance();
        $res = $ci->db->get_where('gpf_fp_authority',array('authority_no'=>$authority_no));
		if($res->num_rows() == 0){
			return '';
		}
		$flag=0;
		$result = $res->result_array();
		$nomi = array();
		foreach($result as $row){
			$nomi[] = $row['nominee_name'].' ('.$row['nominee_guardian_name'].')';
		}
		return implode('<br/>',$nomi);
    }   
}