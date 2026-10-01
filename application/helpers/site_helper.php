<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (! function_exists('get_date')){
    function get_date($date = '') {
		if(trim($date) != '' && $date != '0000-00-00' && $date != '0000-00-00 00:00:00' && $date != null){
			return date(DATE_FORMAT,strtotime($date));
		}
		return '' ;
    }   
}
if (! function_exists('get_datepicker_date')){
    function get_datepicker_date($date = '') {
		if(trim($date) && $date != '0000-00-00' && $date != '0000-00-00 00:00:00' && $date != null){
			return date('d-m-Y',strtotime($date));
		}
		return '00-00-0000' ;
    }   
}
if (! function_exists('get_display_date')){
    function get_display_date($date = '') {
		if(trim($date) && $date != '0000-00-00' && $date != '0000-00-00 00:00:00' && $date != null){
			return date('d-m-Y',strtotime($date));
		}
		return '00/00/0000' ;
    }   
}
if (! function_exists('getAge')){
	function getAge($dob){ 
/*		$asOnDate = date('Y-m-d');         
		$birthdate = new DateTime(date("Y-m-d",  strtotime($dob)));
		$today= new DateTime(date("Y-m-d",  strtotime($asOnDate)));           
		$age = $birthdate->diff($today)->y;
		return $age;
*/
		$ageY = intval(date('Y', time() - strtotime($dob))) - 1970;
		return ( $ageY.' Years ');
		
	}
}
if (! function_exists('getAgeFull')){
	function getAgeFull($dob){ 
	date_default_timezone_set("Asia/Jakarta"); /* can change with others time zone */
	/* $y = year, $m = month, $d = day */
	$y = date('Y',  strtotime($dob));
	$m = date('m',  strtotime($dob));
	$d = date('d',  strtotime($dob));
	
	$ageY = date("Y")-intval($y);
	$ageM = date("n")-intval($m);
	$ageD = date("j")-intval($d);

	if ($ageD < 0){
		$ageD = $ageD += date("t");
		$ageM--;
		}
	if ($ageM < 0){
		$ageM+=12;
		$ageY--;
		}
	if ($ageY < 0){ $ageD = $ageM = $ageY = -1; }
//	return array( 'y'=>$ageY, 'm'=>$ageM, 'd'=>$ageD );	
	return ( $ageY.' Years '.$ageM.' Months '.$ageD.' Days');
	}
}
if (! function_exists('getAgeOn')){
	function getAgeOn($dob,$as_on){ 
	date_default_timezone_set("Asia/Jakarta"); /* can change with others time zone */
	/* $y = year, $m = month, $d = day */
	$y = date('Y',  strtotime($dob));
	$m = date('m',  strtotime($dob));
	$d = date('d',  strtotime($dob));
	
	$Yr = date('Y',  strtotime($as_on));
	$Mth = date('m',  strtotime($as_on));
	$dy = date('d',  strtotime($as_on));
	
	$ageY = $Yr-intval($y);
	$ageM = $Mth-intval($m);
	$ageD = $dy-intval($d);

	if ($ageD < 0){
		$ageD = $ageD += date("t");
		$ageM--;
		}
	if ($ageM < 0){
		$ageM+=12;
		$ageY--;
		}
	if ($ageY < 0){ $ageD = $ageM = $ageY = -1; }
//	return array( 'y'=>$ageY, 'm'=>$ageM, 'd'=>$ageD );	
	return ( $ageY.' Years '.$ageM.' Months '.$ageD.' Days');
	}
}
if (! function_exists('getTotalService')){
	function getTotalService($dor, $doapp){ 
	date_default_timezone_set("Asia/Jakarta"); /* can change with others time zone */
	/* $y = year, $m = month, $d = day */
	$y = date('Y',  strtotime($dor));
	$m = date('m',  strtotime($dor));
	$d = date('d',  strtotime($dor));
	
	$Yr = date('Y',  strtotime($doapp));
	$Mth = date('m',  strtotime($doapp));
	$Dy = date('d',  strtotime($doapp));
	
	$ageY = $y-intval($Yr);
	$ageM = $m-intval($Mth);
	$ageD = $d-intval($Dy);

	if ($ageD < 0){
		$ageD = $ageD += date("t");
		$ageM--;
		}
	if ($ageM < 0){
		$ageM+=12;
		$ageY--;
		}
	if ($ageY < 0){ $ageD = $ageM = $ageY = -1; }
//	return array( 'y'=>$ageY, 'm'=>$ageM, 'd'=>$ageD );	
	return ( $ageY.' Years '.$ageM.' Months '.$ageD.' Days');
	}
}
if (! function_exists('getServiceLeft')){
	function getServiceLeft($dor){ 
	date_default_timezone_set("Asia/Jakarta"); /* can change with others time zone */
	/* $y = year, $m = month, $d = day */
	$y = date('Y',  strtotime($dor));
	$m = date('m',  strtotime($dor));
	$d = date('d',  strtotime($dor));
	
	$Yr = date('Y');
	$Mth = date('m');
	$Dy = date('j');
	
	$ageY = $y-intval($Yr);
	$ageM = $m-intval($Mth);
	$ageD = $d-intval($Dy);

	if ($ageD < 0){
		$ageD = $ageD += date("t");
		$ageM--;
		}
	if ($ageM < 0){
		$ageM+=12;
		$ageY--;
		}
	if ($ageY < 0){ $ageD = $ageM = $ageY = -1; }
//	return array( 'y'=>$ageY, 'm'=>$ageM, 'd'=>$ageD );	
	return ( $ageY.' Years '.$ageM.' Months '.$ageD.' Days');
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
if (! function_exists('write_to_file')){
	function write_to_file($subject="",$msg="",$send_to='') {
		$CI =& get_instance(); 
		$CI->load->helper('file');
		//$string = read_file('otp.txt');
		write_file("otp.txt", "$subject \n $msg \n $send_to", "r+"); // this is from file helper
    } 
}
/*
if (! function_exists('send_OTP')){
	function send_OTP($email='',$mobile='') {
		$otp = rand(123456,987654);
		$CI =& get_instance(); 
		$CI->session->set_userdata('o_t_p_resnd',array('mobile'=>$mobile,'email'=>$email));
		$CI->session->set_userdata('agot',$otp);
		$CI->session->mark_as_temp('agot', 120); // in seconds
		$CI->session->set_userdata('count_time',time());
		$CI->session->mark_as_temp('count_time', 120); // in seconds
		$msg = "$otp is your One Time Password for authentication. --O/o the Pr.AG (A&E), WB.";
		$subject = "OTP from AG Bengal";
		if($mobile!='')
		{
		$ch = curl_init();
//		$baseURL = "https://smsgw.sms.gov.in/failsafe/HttpLink?username=agwb.otp&pin=3mpxqh7p";
		$baseURL = "https://smsgw.sms.gov.in/failsafe/HttpLink?username=agwb.otp&pin=3mpxqh7p&dlt_entity_id=1101717500000028128&dlt_template_id=1107160578107992207";
		$replyTo = "AGAEWB";
		$recipient = $mobile;
		$messageBody = $msg;
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
		curl_close($ch);
		}
		if($email!='')
		{
		send_email($subject,$msg,$email);
		}
    } 
}
*/
/*

// php mail() function to send email
---------------------------------------------------------------- by Karmick
if (! function_exists('send_email')){
	function send_email($subject="",$msg="",$email='') {
		//$to = 'gautamallada@gmail.com,'.$to.',sushantak2005@gmail.com,karmicksol207@gmail.com';
		$to = $email;
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

below  ---------------------------------------------------------------by SUSHANTA
*/
if (! function_exists('validate_OTP')){
	function validate_OTP($otp='') {
		$CI =& get_instance(); 
		if($CI->session->userdata('agot')){
			if($CI->session->userdata('agot') == $otp){
				return true;
			}else{
				return false;  //"true" here will allow to access without validation of OTP
			}
		}
		return false;
    } 
}
if (! function_exists('validate_PASS')){
	function validate_PASS($pass='') {
		if(!empty($pass)){
			$errors = '';
			if (strlen($pass) < 8 || strlen($pass) > 16) {
				$errors = "Password should be min 8 characters and max 16 characters";
			}
			if (!preg_match("/\d/", $pass)) {
				$errors = "Password should contain at least one digit";
			}
			if (!preg_match("/[A-Z]/", $pass)) {
				$errors = "Password should contain at least one Capital Letter";
			}
			if (!preg_match("/[a-z]/", $pass)) {
				$errors = "Password should contain at least one small Letter";
			}
			if (!preg_match("/\W/", $pass)) {
				$errors = "Password should contain at least one special character";
			}
			if (preg_match("/\s/", $pass)) {
				$errors = "Password should not contain any white space";
			}
		}
		return $errors;
    } 
}

if (! function_exists('get_fp_authority')){
	function get_fp_authority($series='',$ac_code='') {
		$CI =& get_instance();
		$res = $CI->db->get_where('gpf_fp_authority',array('series'=>$series,'ac_code'=>$ac_code));
		if($res->num_rows() > 0){
			return '<a href="'.base_url().'ddo/fp_authority/'.$series.'/'.$ac_code.'" target="_new"><img src="'.SITE_BASE_URL.'assets/images/PDF.png" style="max-height:40px;"/></a>';
		}
		return 'Not available';
    } 
}

if (! function_exists('send_SMS')){
	function send_SMS($baseURL='',$mobile='',$msg="") {
		$subject = "SMS from AG Bengal";
		$ch = curl_init();
//		$baseURL = "https://smsgw.sms.gov.in/failsafe/HttpLink?username=agwb.otp&pin=3mpxqh7p";
		$replyTo = "AGAEWB";
		$recipient = preg_replace('/\s+/', '', $mobile);
		$messageBody = $msg;
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
		curl_close($ch);
    } 
}

if (! function_exists('send_email')){
	function send_email($subject="",$msg="",$email='') {
			$CI =& get_instance(); 
			$CI->load->library('p_mail');
			
			$message = '<html><body>';
			$message .= '</body><br> Sir / Madam,</br></html>';
			$message .= '</body><br> </br></html>' ;
			$message .= '</body><br>' .$msg. ' </br></html>' ;
			$message .= '</body><br> -- </br></html>' ;
			$message .= '</body><br> With regards, </br></html>';
			$message .= '</body><br> </br></html>' ;
			$message .= '</body><br> IT Team </br></html>';
			$message .= '</body><br> O/o the Pr.AG(A&E),West Bengal </br></html>';
			$message .= '</body><br> Treasury Buildings,</br></html>';
			$message .= '</body><br> 2 Govt. Place (West),</br></html>';
			$message .= '</body><br> Kolkata 700001</br></html>';
			$message .= '</body><br> Ph No: (033) 2213-8031</br></html>';
			
			$mail = new PHPMailer\PHPMailer\PHPMailer();
			// Server settings
//			$mail->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug output
			$mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
			$mail->SMTPOptions = array(
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			);
			
			$mail->isSMTP();
			$mail->Host = 'relay.nic.in'; //  smtp.mail.gov.in	//NIC smtp mail server
			$mail->SMTPAuth = true;
//			$mail->SMTPSecure = 'tls'; // ssl is depracated
			$mail->SMTPSecure = 'ssl'; // 
//			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
			$mail->Port = 25;	// 465  // NIC smtp mail server port
			
			$mail->Username = 'itsc-agae-wb@nic.in'; // Sender email ID
			$mail->Password = 'Itsc#2014$'; // Sender email password or app password

			// Sender and recipient settings
			$mail->setFrom('itsc-agae-wb@nic.in', 'Pr. AG(A&E), WB');
			$mail->addAddress ($email,'Employee');	// Receipent mail id 
//			$mail->addReplyTo('itsc-agae-wb@nic.in', 'Pr. AG(A&E), WB'); // to set the reply to

			// Setting the email content
			$mail->IsHTML(true);
			$mail->Subject = $subject;
			$mail->Body = $message;		//HTML message body
			$mail->AltBody = $message;	//Plain text message body for non-HTML email client

			if(!$mail->send()){
				echo "Mailer Error: " . $mail->ErrorInfo;
			}else{
				//echo "Email message sent!";
			}
    } 
}

if (! function_exists('send_Demail')){
	function send_Demail($email='') {
		
			$subject = "Office Order / Document from Pr. AG(A&E) West Bengal";
			$msg = "Login to office website to view the Office Order / Document issued to you.";
			
			if($email!='')
			{
			send_email($subject,$msg,$email);
			} 
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
		$baseURL = "https://smsgw.sms.gov.in/failsafe/HttpLink?username=agwb.otp&pin=3mpxqh7p&dlt_entity_id=1101717500000028128&dlt_template_id=1107160578107992207";
		$msg = "$otp is your One Time Password for authentication. --O/o the Pr.AG (A&E), WB.";
		$subject = "OTP from AG Bengal";
		if($mobile!='')
		{
		send_SMS($baseURL,$mobile,$msg);
		}
		if($email!='')
		{
		send_email($subject,$msg,$email);
		}
    } 
}

if (! function_exists('send_OSMS')){
	function send_OSMS($mobile='') {
		$baseURL = "https://smsgw.sms.gov.in/failsafe/HttpLink?username=agwb.otp&pin=3mpxqh7p&dlt_entity_id=1101717500000028128&dlt_template_id=1107160578100042691";
		$msg = "Login to office website for Office Order issued to you. --O/o the Pr.AG(A&E),WB";
		if($mobile!='')
		{
		send_SMS($baseURL,$mobile,$msg);
		}
    } 
}
if (! function_exists('send_BSMS')){
	function send_BSMS($empname='',$mobile='') {
		$baseURL = "https://smsgw.sms.gov.in/failsafe/HttpLink?username=agwb.otp&pin=3mpxqh7p&dlt_entity_id=1101717500000028128&dlt_template_id=1107169173230605687";
		$msg = "Dear $empname, Wish you a very Happy Birthday and many happy returns of the day.  May this year bring more happiness and success in your life. --O/o the Pr.AG(A&E),WB";
		if($mobile!='')
		{
		send_SMS($baseURL,$mobile,$msg);
		}
    } 
}
if (! function_exists('send_NYSMS')){
	function send_NYSMS($empname='',$mobile='') {
		$baseURL = "https://smsgw.sms.gov.in/failsafe/HttpLink?username=agwb.otp&pin=3mpxqh7p&dlt_entity_id=1101717500000028128&dlt_template_id=1107170367837099220";
		$msg = "On the joyous occasion of New Year 2024, I convey warm greetings and good wishes to you and your family. I wish everyone a happy and prosperous New Year 2024. - Shri Atul Prakash, Accountant General.";
		if($mobile!='')
		{
		send_SMS($baseURL,$mobile,$msg);
		}
    } 
}


if (! function_exists('send_TSMS')){
	function send_TSMS($mobile='') {
		$baseURL = "https://smsgw.sms.gov.in/failsafe/HttpLink?username=agwb.otp&pin=3mpxqh7p&dlt_entity_id=1101717500000028128&dlt_template_id=1107160578093874705";
		$msg = "Login to office website for Training Order issued to you. --O/o the Pr.AG(A&E),WB";
		if($mobile!='')
		{
		send_SMS($baseURL,$mobile,$msg);
		}
    } 
}

if (! function_exists('send_DSMS')){
	function send_DSMS($mobile='') {
		$baseURL = "https://smsgw.sms.gov.in/failsafe/HttpLink?username=agwb.otp&pin=3mpxqh7p&dlt_entity_id=1101717500000028128&dlt_template_id=1107160578113990562";
		$msg = "Please Login to Pr. AG(A&E),WB's website for the document issued in respect of your department. --O/o the Pr.AG(A&E),WB";
		if($mobile!='')
		{
		send_SMS($baseURL,$mobile,$msg);
		}
    } 
}

