<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pensioners_copy_download extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->lang->load('main','english');
		$this->load->model('pension_model');
		if($this->session->userdata('language_id')){
			$this->language_id = $this->session->userdata('language_id');
		}else{
			$this->language_id = 1;
		}
		
	}
	
	public function ppo(){
		$this->load->library('m_pdf');
		$data = array();
		$html = $this->load->view('pages/pensioners_copy_download/ppo',$data, true); //load the pdf_output.php by passing our data and get all data in $html varriable.
		$pdfFilePath ='ppo_'.time().".pdf";
		$pdf = $this->m_pdf->generate();
		$pdf->SetWatermarkText('THIS IS FOR INFORMATION ONLY');
		$pdf->watermark_font = 'DejaVuSansCondensed';
		$pdf->showWatermarkText = true;
		$pdf->WriteHTML($html,0);
		//$pdf->Output($pdfFilePath, "D");
		$pdf->Output();
		//$this->load->view('pages/pensioners_copy_download/ppo',$data); 
	}
	public function fppo(){
		$this->load->library('m_pdf');
		$data = array();
		$html = $this->load->view('pages/pensioners_copy_download/fppo',$data, true); //load the pdf_output.php by passing our data and get all data in $html varriable.
		$pdfFilePath ='ppo_'.time().".pdf";
		$pdf = $this->m_pdf->generate();
		$pdf->SetWatermarkText('THIS IS FOR INFORMATION ONLY');
		$pdf->watermark_font = 'DejaVuSansCondensed';
		$pdf->showWatermarkText = true;
		$pdf->WriteHTML($html,0);
		//$pdf->Output($pdfFilePath, "D");
		$pdf->Output();
		//$this->load->view('pages/pensioners_copy_download/ppo',$data); 
	}
}// End of Class
