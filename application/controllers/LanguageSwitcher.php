<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class LanguageSwitcher extends CI_Controller
{
    public function __construct() {
        parent::__construct();     
    }
 
    function switchLang($language = "") {
        
        $language = ($language != "") ? $language : "english";
        $this->session->set_userdata('site_lang', $language);
        $l_details = $this->db->get_where('language',array('language_code'=>$language))->row_array();
		if(!empty($l_details)){
			$this->session->set_userdata('language_id', $l_details['language_id']);
		}else{
			$this->session->set_userdata('language_id', 1);
		}
       exit;
    }
}