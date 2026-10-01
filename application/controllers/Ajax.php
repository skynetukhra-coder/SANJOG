<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {
	function __construct(){
		parent::__construct();
	}
	public function change_theam($theam){
		if($theam == 'black'){
			$this->session->set_userdata('site_theme','black');
		}else{
			$this->session->set_userdata('site_theme','blue');
		}
	}
	public function increase_font(){
		$this->session->set_userdata('set_font','increase');
	}
	public function decrese_font(){
		$this->session->set_userdata('set_font','decrese');
	}
	public function default_font(){
		$this->session->unset_userdata('set_font');
	}
	public function regenerate_captcha(){
		$captcha = get_captcha();
		$res = array(
					'success'	=> true,
					'image'		=> 'captcha/'.$captcha['filename']
				);
		echo json_encode($res);
	}
	public function resend_otp(){
		$data['csrf'] = array(
				'name' => $this->security->get_csrf_token_name(),
				'hash' => $this->security->get_csrf_hash()
		);
		if($this->session->has_userdata('o_t_p_resnd')){
			$o_t_p_resnd = $this->session->userdata('o_t_p_resnd');
			$mobile = $o_t_p_resnd['mobile'];
			$email  = $o_t_p_resnd['email'];
			send_OTP($email,$mobile);
			$otp_time =  $this->session->userdata('count_time');
			$now = time();
			$seconds = $now - $otp_time;
			$min = intval($seconds / 60);
			$sec = ($seconds - (($min) * 60));
			$remaining_min = (2 - $min) >= 0 ? (2 - $min): 0;
			$remaining_sec = (60 - $sec) >= 0 ? (60 - $sec): 0;
			
			$arr = array('success'=>true,'msg'=>'OTP successfully send','mint'=>$remaining_min,'sec'=>$remaining_sec);
			echo json_encode($arr);
			exit;
		}	
		$arr = array('success'=>false,'msg'=>'OTP not send');
		echo json_encode($arr);	
	}
}// End of Class
