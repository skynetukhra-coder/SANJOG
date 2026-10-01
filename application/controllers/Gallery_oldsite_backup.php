<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gallery extends CI_Controller {
	function __construct() {
       parent::__construct();
		$this->lang->load('main','english');
		$this->load->model('gallery_model');
		if($this->session->userdata('language_id')){
			$this->language_id = $this->session->userdata('language_id');
		}else{
			$this->language_id = 1;
		}
	}
	public function index(){
		$data['gallery_agae'] = $this->gallery_model->get_office_gallery('AGAE');
		$data['gallery_aggssa'] = $this->gallery_model->get_office_gallery('AGGSSA');
		$data['gallery_agersa'] = $this->gallery_model->get_office_gallery('AGERSA');
		$this->load->view('layout/header');
		$this->load->view('pages/gallery',$data);
		$this->load->view('layout/footer');
		//$this->load->view('layout/gallery_js');
	}
	public function video(){
		$this->load->model('video_model');
		$data['video_agae'] = $this->video_model->get_office_video('AGAE');
		$data['video_aggssa'] = $this->video_model->get_office_video('AGGSSA');
		$data['video_agersa'] = $this->video_model->get_office_video('AGERSA');
		$this->load->view('layout/header');
		$this->load->view('pages/video',$data);
		$this->load->view('layout/footer');
	}
}
