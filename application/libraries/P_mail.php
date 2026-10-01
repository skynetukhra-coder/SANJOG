<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class p_mail {
    
    function __construct()
    {
        $CI = & get_instance();
		
		include_once APPPATH.'/third_party/PHPMailer/src/Exception.php';
		include_once APPPATH.'/third_party/PHPMailer/src/PHPMailer.php';
		include_once APPPATH.'/third_party/PHPMailer/src/SMTP.php';
        //log_message('Debug', 'PHPMailer class is loaded.');
    }
 
	
}