<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Testmail extends CI_Controller {
	function __construct(){
		parent::__construct();
		if (!is_cli() && !$this->session->userdata('admin_details')) {
			show_404();
		}
		$this->lang->load('main','english');
		$this->load->model('page_model');
		$this->load->library('p_mail');
		if($this->session->userdata('language_id')){
			$this->language_id = $this->session->userdata('language_id');
		}else{
			$this->language_id = 1;
		}
	}

	public function index(){
	
		$mail = new PHPMailer\PHPMailer\PHPMailer();
//		$email='sushantak2005@gmail.com';
//		$subject="One Time Password";
//		$msg="Test Mail for OTP";

//echo !extension_loaded('openssl')?"Not Available":"Available";   //To whether OpenSSL is available or Nor
			// Server settings
//			$mail->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug output
			$mail->SMTPDebug = 2; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
			
			$mail->SMTPOptions = array(
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			);

			
			$mail->isSMTP();
			$mail->Host = 'relay.nic.in';
			$mail->SMTPAuth = true;

			$mail->SMTPSecure = 'tls'; // ssl is depracated
//			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
			$mail->Port = 587;   //25 or 465

			$mail->Username = 'itsc-agae-wb@nic.in'; // YOUR email ID
			$mail->Password = 'Itsc#2014$'; // YOUR Email password

			// Sender and recipient settings
			$mail->setFrom('itsc-agae-wb@nic.in', 'Pr. AG(A&E), WB');
			$mail->addAddress('sushantak2005@gmail.com','User');
//			$mail->addReplyTo('example@gmail.com', 'Sender Name'); // to set the reply to

			// Setting the email content
			$mail->IsHTML(true);
			$mail->Subject = 'One Time Password';
			$mail->Body = 'HTML message body. <b>Gmail</b> SMTP email body.';
			$mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';

			if(!$mail->send()){
				echo "Mailer Error: " . $mail->ErrorInfo;
			}else{
				echo "Message sent!";
			}
	}

/*
	public function index(){
	
		$mail = new PHPMailer\PHPMailer\PHPMailer();
//		$email='sushantak2005@gmail.com';
//		$subject="One Time Password";
//		$msg="Test Mail for OTP";
		try {
			// Server settings
//			$mail->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug output
			$mail->SMTPDebug = 2; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
			
			$mail->SMTPOptions = array(
				'ssl' => array(
					'verify_peer' => false,
					'verify_peer_name' => false,
					'allow_self_signed' => true
				)
			);
			
			$mail->isSMTP();
			$mail->Host = 'relay.nic.in';
			$mail->SMTPAuth = true;

			$mail->SMTPSecure = 'tls'; // ssl is depracated
//			$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
			$mail->Port = 25;

			$mail->Username = 'itsc-agae-wb@nic.in'; // YOUR Email ID
			$mail->Password = 'Itsc#2014$'; // YOUR Email password

			// Sender and recipient settings
			$mail->setFrom('itsc-agae-wb@nic.in', 'Pr. AG(A&E), WB');
			$mail->addAddress('sushantak2005@gmail.com','User');
//			$mail->addReplyTo('example@gmail.com', 'Sender Name'); // to set the reply to

			// Setting the email content
			$mail->IsHTML(true);
			$mail->Subject = 'One Time Password';
			$mail->Body = 'HTML message body. <b>Gmail</b> SMTP email body.';
			$mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';

			$mail->send();
			echo "Email message sent.";
		} catch (Exception $e) {
			echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
		}
	}
*/	


}
