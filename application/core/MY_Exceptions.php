<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class MY_Exceptions extends CI_Exceptions {

    public function __construct() {
        parent::__construct();
    }


    public function show_404($page = '', $log_error = TRUE) {
		
        $CI =& get_instance();
		if(substr_count($_SERVER['REQUEST_URI'],"/".ADMIN_BASE) > 0 ){
			$CI->load->view('agadmin/layout/header');
			$CI->load->view('agadmin/pages/pagenotfound');
			$CI->load->view('agadmin/layout/footer');
		}else{
		 	$CI->load->view('layout/header');
			$CI->load->view('pages/pagenotfound');
			$CI->load->view('layout/footer');
		}
        echo $CI->output->get_output();
        exit;
    }
	
	public function show_admin_404() {
        $CI =& get_instance();
        $CI->load->view('agadmin/layout/header');
		$CI->load->view('agadmin/pages/pagenotfound');
		$CI->load->view('agadmin/layout/footer');
        echo $CI->output->get_output();
        exit;
    }

}