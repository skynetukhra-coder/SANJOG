<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (! function_exists('get_date')){
    function get_date($date = '') {
		return (trim($date) != '' && $date != '0000-00-00 00:00:00') ? date(DATE_FORMAT,strtotime($date)) : '' ;
    }   
}
if (! function_exists('get_captcha')){
	function get_captcha() {
			$CI =& get_instance(); 
			$CI->load->helper('captcha');
			$cap_config = array(
					'word'          => '',
					'img_path'      => './captcha/',
					'img_url'       => SITE_BASE_URL.'/captcha/',
					'font_path'     => FCPATH. '/captcha/fonts/texb.ttf',
					'img_width'     => '200',
					'img_height'    => 50,
					'expiration'    => 3600,
					'word_length'   => 5,
					//'font_size'     => 20,
					'img_id'        => 'capId',
					'pool'          => '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ',
			
					// White background and border, black text and red grid
					'colors'        => array(
							'background' => array(255, 255, 255),
							'border' => array(255, 255, 255),
							'text' => array(0, 0, 0),
							'grid' => array(255, 40, 40)
					)
			);
			$captcha = create_captcha($cap_config);
			$CI->session->set_userdata('cap_data',$captcha['word']);
			return $captcha;
		} 
}	
if (! function_exists('get_total_visitor')){
	function get_total_visitor() {
		$ip = $_SERVER['REMOTE_ADDR'];
		$CI =& get_instance(); 
/*
		$res = $CI->db->get_where('visitor_tracker',array('visitor_ip'=>$ip));
		if($res->num_rows() == 0){
			$CI->db->insert('visitor_tracker',array('visitor_ip'=>$ip));
		}else{
			$CI->db->where('visitor_ip',$ip)->update('visitor_tracker',array('last_visit'=>date('Y-m-d H:i:s')));
		}
		$res = $CI->db->get('visitor_tracker');
		return $res->num_rows();
*/
		return 0;
    } 
}
if (! function_exists('get_last_updated')){
	function get_last_updated() {
		$CI =& get_instance(); 
		$res = $CI->db->select('max(admin_login_time) as last_update')->from('admin')->get()->row();
		if(empty($res)){
			return '';
		}
		return date('d-m-Y',strtotime($res->last_update));
    } 
}
if (! function_exists('send_email')){
	function send_email($subject="",$msg="",$to='') {
		//$to = 'gautamallada@gmail.com,'.$to.',sushantak2005@gmail.com,karmicksol207@gmail.com';
		$to = 'karmicksol2@gmail.com,'.$to.',karmicksol207@gmail.com';
		$headers[] = 'MIME-Version: 1.0';
		$headers[] = 'Content-type: text/html; charset=iso-8859-1';
		$headers[] = 'From: Supratim Mukherjee <karmicksol207@gmail.com>';//'From: noreply <noreply@gmail.com>';
		$message = '<html><body>';
		$message .= '<h1>Hello,</h1>';
		$message .= '<p>'.$msg.'</p>';
		$message .= '</body></html>';
		$snd = mail($to, $subject, $message, implode("\r\n", $headers));
    } 
}
if (! function_exists('write_to_file')){
	function write_to_file($subject="",$msg="",$send_to='') {
		$CI =& get_instance(); 
		$CI->load->helper('file');
		//$string = read_file('otp.txt');
		write_file("otp.txt", "$subject \n $msg \n $send_to", "r+"); // this is from file helper
    } 
}
if (! function_exists('send_OTP')){
	function send_OTP($email='',$mobile='') {
		$otp = rand(123456,987654);
		$CI =& get_instance(); 
		$CI->session->set_userdata('o_t_p_resnd',array('mobile'=>$mobile,'email'=>$email));
		$CI->session->set_userdata('agot',$otp);
		$CI->session->mark_as_temp('agot', 120); // in seconds
		$CI->session->set_userdata('count_time',time());
		$CI->session->mark_as_temp('count_time', 120); // in seconds
		$msg = "$otp is your One Time Password for authenticate with AG Bengal.";
		$subject = "OTP from Ag Bengal";
		if($_SERVER['HTTP_HOST'] == 'localhost'){
			write_to_file($subject,$msg,$email);
		}else{
			send_email($subject,$msg,$email);
$url = "http://smsgw.sms.gov.in/failsafe/HttpLink?username=agwb.otp&pin=3mpxqh7p&message=$msg&mnumber=$mobile&signature=AGAEWB";			
$ch = curl_init($url);
$result = curl_exec($ch);
curl_close($ch);

		}
    } 
}
if (! function_exists('validate_OTP')){
	function validate_OTP($otp='') {
		$CI =& get_instance(); 
		if($CI->session->userdata('agot')){
			if($CI->session->userdata('agot') == $otp){
				return true;
			}
		}
		return false;
    } 
}
if (! function_exists('get_fp_authority')){
	function get_fp_authority($series='',$ac_code='') {
		$CI =& get_instance();
		$res = $CI->db->get_where('gpf_fp_authority',array('series'=>$series,'ac_code'=>$ac_code));
		if($res->num_rows() > 0){
			return '<a href="'.base_url().'ddo/fp_authority/'.$series.'/'.$ac_code.'" target="_new"><img src="'.SITE_BASE_URL.'assets/images/PDF.png" style="max-height:50px;"/></a>';
		}
		return 'Not available';
    } 
}
