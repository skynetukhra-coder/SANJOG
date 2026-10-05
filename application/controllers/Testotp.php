<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testotp extends CI_Controller {
	function __construct(){
		parent::__construct();
		if (!is_cli() && !$this->session->userdata('admin_details')) {
			show_404();
		}
		$this->lang->load('main','english');
		$this->load->model('page_model');
		if($this->session->userdata('language_id')){
			$this->language_id = $this->session->userdata('language_id');
		}else{
			$this->language_id = 1;
		}
	}
	public function simple(){
		$messageBody = "simple test otp Test message sent via SMS platform using";
		$msg = urlencode($messageBody);
		$mobile = "919674014635";
		$url = "http://smsgw.sms.gov.in/failsafe/HttpLink?username=agwb.otp&pin=3mpxqh7p&message=$msg&mnumber=$mobile&signature=AGAEWB";			
		$ch = curl_init($url);
		$result = curl_exec($ch);
		echo '<pre>';
		print_r(curl_getinfo($ch));
		curl_close($ch);
	}		
	public function index(){ 
		header('Content-Type: text/plain; charset=utf-8');
		$ch = curl_init();
		if (function_exists("curl_init")) echo "curl exists";
//		$baseURL = "https://smsgw.sms.gov.in/failsafe/HttpLink?username=agwb.otp&pin=3mpxqh7p";
		$baseURL = "https://smsgw.sms.gov.in/failsafe/HttpLink?username=agwb.otp&pin=3mpxqh7p&dlt_entity_id=1101717500000028128&dlt_template_id=1107160578107992207";
		$replyTo = "AGAEWB";
		$recipient = "9903383016";
		$messageBody = "OTP, Test DLT message --PR.AG(A&E),WB";
		// URL encode message body
		$messageBody = urlencode($messageBody);
		$URI = $baseURL;
		$URI .= "&message=" . $messageBody;		
		$URI .= "&mnumber=" . $recipient;
		$URI .= "&signature=" . $replyTo;
		
		 // Set URL to connect to
		 curl_setopt($ch, CURLOPT_URL, $URI);
		// curl_setopt($ch, CURLOPT_FAILONERROR, true);
		 // Set header supression
		 curl_setopt($ch, CURLOPT_HEADER, true);
		 curl_setopt($ch, CURLOPT_NOBODY, true);
		 // Disable SSL peer verification
		 //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		 // Indicate that the message should be returned to a variable
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Make request
		 $content = curl_exec($ch);
		 $code = curl_getinfo($ch,CURLINFO_HTTP_CODE);
		 $error_msg = "No error";
		 if(curl_error($ch)){
			 $error_msg = curl_error($ch);
		 }
		//print responses
		var_dump($code);
		var_dump($content);
		var_dump(curl_getinfo($ch));
		var_dump($error_msg);
		// Clean up
		curl_close($ch);
	}
	
}
