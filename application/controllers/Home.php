<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->lang->load('main','english');
		$this->load->model('page_model');
		if($this->session->userdata('language_id')){
			$this->language_id = $this->session->userdata('language_id');
		}else{
			$this->language_id = 1;
		}
	}
	public function index(){
		$data['about_us'] = $this->page_model->getPageByURL($this->language_id,'about-us');
		$data['blocks'] = $this->page_model->getAllBlocks($this->language_id);
		$data['whats_new'] = $this->common_model->get_whats_new_display('AGAE');
		$data['gssa_whats_new'] = $this->common_model->get_whats_new_display('AGGSSA');
		$data['esra_whats_new'] = $this->common_model->get_whats_new_display('AGERSA');
		$data['language_id'] = $this->language_id;
		$this->load->view('layout/header');
		$this->load->view('pages/home',$data);
		$this->load->view('layout/footer');
	}
	public function screen_reader_access(){
		$this->load->view('layout/header');
		$lang = !empty($this->language_id) ? $this->language_id : 1;
		$this->load->view('pages/screen_reader_access_'.$lang);
		$this->load->view('layout/footer');
	}
	public function on_this_site(){
		$data['about_us'] = $this->page_model->getPageByURL($this->language_id,'about-us');
		$data['blocks'] = $this->page_model->getAllBlocks($this->language_id);
		$this->load->view('layout/header');
		$this->load->view('pages/home',$data);
		$this->load->view('layout/footer');
	}
	public function gpf_form(){
		
	}
	public function test(){
		$this->load->library('m_pdf');
		$html = $this->load->view('pages/test',$data, true); //load the pdf_output.php by passing our data and get all data in $html varriable.
		$pdfFilePath ="gpf_form".time().".pdf";
		$pdf = $this->m_pdf->generate();
		$pdf->SetWatermarkText('THIS IS FOR INFORMATION ONLY');
		$pdf->watermark_font = 'DejaVuSansCondensed';
		$pdf->showWatermarkText = true;
		$pdf->WriteHTML($html,0);
		//$pdf->Output($pdfFilePath, "D");
		$pdf->Output();
	}
}// End of Class
