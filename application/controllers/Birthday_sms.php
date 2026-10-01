<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Birthday_sms extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('emp_model');
		$this->language_id = 1;
	}
	/*
		Bithday SMS sending php page for scheduling through corns.
	 */
	public function index()
	{
		$empname = 'SUSHANTA';
		$mobile = '9903383016';
		send_BSMS($empname,$mobile); // from helper
/*		
		$check_sms = $this->emp_model->check_BirthDaySMS();
			if(empty($check_sms)){
				$sms_count = 0;
				$emp_sms = $this->emp_model->SendBirthDaySMS();

				foreach($emp_sms as $empname=>$mobile){
//					send_BSMS($empname,$mobile); // from helper	
					$sms_count = $sms_count +1;
				}
				$post = array(
							'sms_no'	=> $sms_count,
							'sent_dt'	=> date('Y-m-d H:i:s')
				);
//				$this->emp_model->add_bsms_tracker($post);			
			}
*/			
	}

}
