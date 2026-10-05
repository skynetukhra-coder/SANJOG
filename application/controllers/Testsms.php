<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testsms extends CI_Controller {
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
	public function index(){ 
		header('Content-Type: text/plain; charset=utf-8');
		$ch = curl_init();
		if (function_exists("curl_init")) echo "curl exists";
//		$baseURL = "https://smsgw.sms.gov.in/failsafe/HttpLink?username=agwb.otp&pin=3mpxqh7p";
//		$baseURL = "https://smsgw.sms.gov.in/failsafe/HttpLink?username=agwb.otp&pin=3mpxqh7p&dlt_entity_id=1101717500000028128";
		$baseURL = "https://smsgw.sms.gov.in/failsafe/HttpLink?username=agwb.otp&pin=3mpxqh7p&signature=1105159557631197527&dlt_entity_id=1101717500000028128";
		$replyTo = "AGAEWB";
		$recipient = "919903383016";
		$messageBody = "Test DLT message SMS --PR.AG(A&E),WB";
		// URL encode message body
		$messageBody = urlencode($messageBody);
		$URI = $baseURL;
		$URI .= "&message=" . $messageBody;		
		$URI .= "&mnumber=" . $recipient;
		$URI .= "&signature=" . $replyTo;
		
		 // Set URL to connect to
		 curl_setopt($ch, CURLOPT_URL, $URI);
		 curl_setopt($ch, CURLOPT_FAILONERROR, true);
		 // Set header supression
		 curl_setopt($ch, CURLOPT_HEADER, 0);
		 // Disable SSL peer verification
		 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		 // Indicate that the message should be returned to a variable
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// Make request
		 $content = curl_exec($ch);
		 $error_msg = "No error";
		 if(curl_error($ch)){
			 $error_msg = curl_error($ch);
		 }
		//print responses
		var_dump($content);
		var_dump(curl_getinfo($ch));
		var_dump($error_msg);
		// Clean up
		curl_close($ch);
	}
/*	
	public function nic(){
		if(function_exists('curl_init'))
		{
			$mob=919932302080;
			$tst='test sms';
			$uid=urlencode("agwb.otp");
			$pass=urlencode("3mpxqh7p");
			$send=urlencode("AGAEWB"); // 6 characters long SENDERID
			$dest=urlencode($mob);
			$msg=urlencode($tst);
			$url="https://smsgw.sms.gov.in/failsafe/HttpLink?";
			$data = "username=$uid&pin=$pass&message=$msg&mnumber=$dest&signature=$send";
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,2);
			curl_setopt($ch, CURLOPT_CAINFO,'/etc/pki/tls/certs/ca-bundle.crt');
			if (curl_errno($ch)) echo 'Curl error: ' . curl_error($ch);
			else {
				$curl_output =curl_exec($ch);
                                echo 'output: '; 
				print_r($curl_output);
			}
                        var_dump(curl_getinfo($ch));
			curl_close($ch); 
		}           
	}
*/
}
