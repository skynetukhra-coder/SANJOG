<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Video extends CI_Controller {
	function __construct() {
       parent::__construct();
		$this->lang->load('main','english');
		$this->load->model('video_model');
		if($this->session->userdata('language_id')){
			$this->language_id = $this->session->userdata('language_id');
		}else{
			$this->language_id = 1;
		}
	}
	public function index(){
		$data['video_agae'] = $this->video_model->get_office_video('AGAE');
		$data['video_aggssa'] = $this->video_model->get_office_video('AGGSSA');
		$data['video_agersa'] = $this->video_model->get_office_video('AGERSA');
		$this->load->view('layout/header');
		$this->load->view('pages/video',$data);
		$this->load->view('layout/footer');
		//$this->load->view('layout/video_js');
	}
	public function video(){
		$this->load->helper('directory');
		$data['videos'] = directory_map('./userfiles/files/videos/');
		$this->load->view('layout/header');
		$this->load->view('pages/video',$data);
		$this->load->view('layout/footer');
	}
}
